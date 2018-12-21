<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpUrlReplacement {
  public $post_urls_table_name;

  public function __construct() {
    global $wpdb;
    $this->post_urls_table_name = "{$wpdb->prefix}prli_post_urls";
  }

  /** This will get all of the keywords to urls for the given post.
    * This is also where our smart-caching will come into play.
    */
  public function get_post_urls_lookup($post_id) {
    static $urls;

    if(!isset($urls)) {
      $urls = array();
    }

    if(!isset($urls[$post_id])) {
      $index_keywords = get_option('plp_index_keywords', false);
      if(empty($index_keywords)) { return $this->getURLToLinksArray(); }

      global $wpdb, $prli_blogurl, $prli_link, $prli_link_meta;

      $q = "
        SELECT plm.meta_value AS replacement_url,
               CONCAT(%s,li.slug) AS url
          FROM {$prli_link->table_name} AS li
          JOIN {$prli_link_meta->table_name} AS plm
            ON li.id=plm.link_id
           AND plm.meta_key='prli-url-replacements'
          JOIN {$this->post_urls_table_name} AS pu
            ON plm.id = pu.url_id
         WHERE pu.post_id=%d
           AND plm.meta_value <> %s
      ";

      $struct = PrliUtils::get_permalink_pre_slug_uri();
      $q = $wpdb->prepare($q, $prli_blogurl.$struct, $post_id, '');

      $replacement_urls = $wpdb->get_results($q);

      $urls[$post_id] = $this->format_urls_array($replacement_urls);
    }

    return $urls[$post_id];
  }

  public function getURLToLinksArray() {
    static $urls;

    if(!isset($urls)) {
      global $wpdb, $prli_blogurl, $prli_link, $prli_link_meta;

      $struct = PrliUtils::get_permalink_pre_slug_uri();
      $query = "
        SELECT plm.meta_value as replacement_url,
               CONCAT(%s,li.slug) AS url
          FROM {$prli_link->table_name} li
          JOIN {$prli_link_meta->table_name} plm
            ON li.id = plm.link_id
         WHERE plm.meta_key='prli-url-replacements'
           AND plm.meta_value <> %s
      ";

      $query = $wpdb->prepare($query, $prli_blogurl . $struct, '');
      $replacement_urls = $wpdb->get_results($query);

      $urls = $this->format_urls_array($replacement_urls);
    }

    return $urls;
  }

  private function format_urls_array($replacement_urls) {
    if(!is_array($replacement_urls) || empty($replacement_urls)) { return array(); }

    $links_array = array();

    foreach($replacement_urls as $replacement_url) {
      if(isset($links_array[$replacement_url->replacement_url])) {
        $links_array[$replacement_url->replacement_url][] = $replacement_url->url;
      }
      else {
        $links_array[$replacement_url->replacement_url] = array($replacement_url->url);
      }
    }

    return $links_array;
  }

  private function get_post_grouped_urls ($post_id) {
    global $wpdb, $plp_options, $prli_link, $prli_link_meta;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT * FROM (
        SELECT plm.meta_value AS url,
               MIN(plm.id) AS id
          FROM {$prli_link_meta->table_name} AS plm
          JOIN {$wpdb->posts} AS p
            ON p.ID=%d
          LEFT JOIN {$wpdb->postmeta} AS pm
            ON pm.post_id=p.ID
           AND pm.meta_key='_plp_post_urls_updated_at'
         WHERE plm.meta_key='prli-url-replacements'
           AND p.post_status='publish'
           AND p.post_type IN ({$valid_types})
           AND (
                 pm.meta_value IS NULL
                 OR pm.meta_value < plm.created_at
               )
         GROUP BY plm.meta_value
       ) AS u
       ORDER BY CHAR_LENGTH(u.url) DESC, u.url ASC
    ";
    $q = $wpdb->prepare($q, $post_id);

    $urls = $wpdb->get_results($q);

    return $urls;
  }

  private function get_comment_grouped_urls ($comment_id) {
    global $wpdb, $plp_options, $prli_link, $prli_link_meta;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT * FROM (
        SELECT plm.meta_value AS url,
               MIN(plm.id) AS id
          FROM {$prli_link_meta->table_name} AS plm
          JOIN {$wpdb->comments} AS c
            ON c.comment_ID=%d
          JOIN {$wpdb->posts} AS p
            ON p.ID=c.comment_post_ID
          LEFT JOIN {$wpdb->commentmeta} AS cm
            ON cm.comment_id=c.comment_ID
           AND cm.meta_key='_plp_comment_urls_updated_at'
         WHERE plm.meta_key='prli-url-replacements'
           AND c.comment_approved=1
           AND p.post_status='publish'
           AND p.post_type IN ({$valid_types})
           AND (
                 cm.meta_value IS NULL
                 OR cm.meta_value < plm.created_at
               )
         GROUP BY plm.meta_value
       ) AS u
       ORDER BY CHAR_LENGTH(u.url) DESC, u.url ASC
    ";
    $q = $wpdb->prepare($q, $comment_id);

    $urls = $wpdb->get_results($q);

    return $urls;
  }

  public function index_post ($post_id) {
    global $plp_options;
    $urls = $this->get_post_grouped_urls($post_id);
    $post_content = PrliUtils::get_post_content($post_id);
    $this->index_content($post_id, $urls, $post_content);
    update_post_meta($post_id, '_plp_post_urls_updated_at', PrliUtils::now());
  }

  public function index_comment ($comment_id) {
    global $plp_options;
    $urls = $this->get_comment_grouped_urls($comment_id);
    $comment_content = get_comment_text($comment_id);
    $comment = get_comment($comment_id);
    $this->index_content($comment->comment_post_ID, $urls, $comment_content);
    update_comment_meta($comment_id, '_plp_comment_urls_updated_at', PrliUtils::now());
  }

  private function index_content ($post_id, &$urls, &$content) {
    $kw_ids = array();

    foreach($urls as $url) {
      if(preg_match('!\b'.preg_quote($url->url,'!').'\b!i', $content)) {
        $url_ids[] = $url->id;
      }
    }

    // Add all keywords in one swath
    return $this->add_post_urls($post_id, $url_ids);
  }

  private function add_post_urls ($post_id, $url_ids) {
    global $wpdb;

    if(empty($url_ids)) { return false; }

    // We got a unique index folks so we just ignore dups yo
    // But we just want to grab one random url to insert here
    $q = "
      INSERT IGNORE INTO {$this->post_urls_table_name}
        (post_id, url_id)
      VALUES
    ";

    $vals = array();
    foreach($url_ids as $url_id) {
      // Not sure how this would ever be un-true but let's make sure it doesn't happen
      if($url_id > 0 && $post_id > 0) {
        $vals[] = $wpdb->prepare("(%d, %d)", $post_id, $url_id);
      }
    }

    // No values to insert? Let's bail.
    if(empty($vals)) { return false; }

    $q .= implode(',',$vals);

    return $wpdb->query($q);
  }

  // SELECT posts where updated_at < than max link updated_at
  public function get_indexable_posts ($max_count=100) {
    global $wpdb, $plp_options, $prli_link, $prli_link_meta, $plp_keyword;

    $plp_keyword->update_links_with_null_updated_at();

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(plm.created_at)
        FROM {$prli_link_meta->table_name} AS plm
       WHERE plm.meta_key='prli-url-replacements'
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Order to get oldest / null entries updated first
    $q = $wpdb->prepare("
        SELECT ID
          FROM {$wpdb->posts} AS p
          LEFT JOIN {$wpdb->postmeta} AS pm
            ON p.ID=pm.post_id
           AND pm.meta_key='_plp_post_urls_updated_at'
         WHERE p.post_status = 'publish'
           AND p.post_type IN ({$valid_types})
           AND (
             pm.meta_value IS NULL
             OR pm.meta_value < %s
           )
         ORDER BY pm.meta_value ASC,
                  p.post_date DESC
         LIMIT %d
      ",
      $max_updated_at,
      $max_count
    );
    $posts = $wpdb->get_col($q);

    return $posts;
  }

  // SELECT posts where updated_at < than max link updated_at
  public function get_indexable_comments ($max_count=100) {
    global $wpdb, $plp_options, $prli_link, $prli_link_meta, $plp_keyword;

    $plp_keyword->update_links_with_null_updated_at();

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(plm.created_at)
        FROM {$prli_link_meta->table_name} AS plm
       WHERE plm.meta_key='prli-url-replacements'
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Order to get oldest / null entries updated first
    $q = $wpdb->prepare("
        SELECT c.comment_ID
          FROM {$wpdb->comments} AS c
         INNER JOIN {$wpdb->posts} AS p
            ON c.comment_post_ID=p.ID
           AND p.post_status = 'publish'
           AND p.post_type IN ({$valid_types})
          LEFT JOIN {$wpdb->commentmeta} AS cm
            ON c.comment_ID=cm.comment_id
           AND cm.meta_key='_plp_comment_urls_updated_at'
         WHERE c.comment_approved=1
           AND (
             cm.meta_value IS NULL
             OR cm.meta_value < %s
           )
         ORDER BY cm.meta_value ASC,c.comment_date DESC
         LIMIT %d
      ",
      $max_updated_at,
      $max_count
    );
    $comments = $wpdb->get_col($q);

    return $comments;
  }

  // How many posts out of all are indexed
  public function posts_indexed () {
    global $wpdb, $prli_link, $plp_options, $prli_link_meta;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(plm.created_at)
        FROM {$prli_link_meta->table_name} AS plm
       WHERE plm.meta_key='prli-url-replacements'
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Num un-indexed posts
    $q = $wpdb->prepare("
      SELECT COUNT(*)
        FROM {$wpdb->posts} AS p
        LEFT JOIN {$wpdb->postmeta} AS pm
          ON p.ID=pm.post_id
         AND pm.meta_key='_plp_post_urls_updated_at'
       WHERE p.post_status = 'publish'
         AND p.post_type IN ({$valid_types})
         AND (
           pm.meta_value IS NULL
           OR pm.meta_value < %s
         )
       ORDER BY pm.meta_value
      ",
      $max_updated_at
    );
    $unindexed = $wpdb->get_var($q);

    $q = "
      SELECT COUNT(*)
        FROM {$wpdb->posts} AS p
       WHERE p.post_status = 'publish'
         AND p.post_type IN ({$valid_types})
    ";
    $total = $wpdb->get_var($q);

    $indexed = ($total - $unindexed);

    return (object)compact('total', 'indexed', 'unindexed');
  }

  // How many comments out of all are indexed
  public function comments_indexed () {
    global $wpdb, $prli_link, $plp_options, $prli_link_meta;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(plm.created_at)
        FROM {$prli_link_meta->table_name} AS plm
       WHERE plm.meta_key='prli-url-replacements'
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Num un-indexed posts
    $q = $wpdb->prepare("
        SELECT COUNT(*)
          FROM {$wpdb->comments} AS c
         INNER JOIN {$wpdb->posts} AS p
            ON c.comment_post_ID=p.ID
           AND p.post_status = 'publish'
           AND p.post_type IN ({$valid_types})
          LEFT JOIN {$wpdb->commentmeta} AS cm
            ON c.comment_ID=cm.comment_id
           AND cm.meta_key='_plp_comment_urls_updated_at'
         WHERE c.comment_approved=1
           AND (
                 cm.meta_value IS NULL
                 OR cm.meta_value < %s
               )
         ORDER BY cm.meta_value
      ",
      $max_updated_at
    );
    $unindexed = $wpdb->get_var($q);

    $q = "
      SELECT COUNT(*)
        FROM {$wpdb->comments} AS c
       INNER JOIN {$wpdb->posts} AS p
          ON c.comment_post_ID=p.ID
         AND p.post_status = 'publish'
         AND p.post_type IN ({$valid_types})
       WHERE c.comment_approved=1
    ";
    $total = $wpdb->get_var($q);

    $indexed = ($total - $unindexed);

    return (object)compact('total', 'indexed', 'unindexed');
  }
}

