<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpKeyword {
  public $table_name, $post_keywords_table_name;

  public function __construct() {
    global $wpdb;
    $this->table_name = "{$wpdb->prefix}prli_keywords";
    $this->post_keywords_table_name = "{$wpdb->prefix}prli_post_keywords";
  }

  public function create($keyword,$link_id) {
    global $wpdb;

    $query_str = "
      INSERT INTO {$this->table_name}
        (text, link_id, created_at)
      VALUES
        (%s,%d,NOW())
    ";

    $query = $wpdb->prepare(
      $query_str,
      $keyword,
      $link_id
    );

    $query_results = $wpdb->query($query);

    if($query_results) {
      return $wpdb->insert_id;
    }
    else {
      return false;
    }
  }

  public function get_removed_keywords($link_id, $keywords) {
    global $wpdb;

    $keywords = array_map(create_function('$kw', 'return trim($kw);'), $keywords);

    $q = $wpdb->prepare("
        SELECT kw.*
          FROM {$this->table_name} AS kw
         WHERE kw.link_id=%d
      ",
      $link_id
    );
    $kws = $wpdb->get_results($q);

    $removed_ids = array();
    if(is_array($kws) && !empty($kws)) {
      foreach($kws as $kw) {
        if(!in_array($kw->text, $keywords)) {
          $removed_ids[] = $kw->id;
        }
      }
    }

    return $removed_ids;
  }

  public function delete_removed_keywords($link_id, $keywords) {
    global $wpdb;

    $keywords = explode(',',$keywords);

    $removed_ids = $this->get_removed_keywords($link_id, $keywords);

    if(!empty($removed_ids)) {
      $idstr = implode(',', $removed_ids);

      // Clear the index of these keywords
      $q = "
        DELETE FROM {$this->post_keywords_table_name}
         WHERE keyword_id IN ({$idstr})
      ";
      $wpdb->query($q);

      // Clear the keywords themselves
      $q = "
        DELETE FROM {$this->table_name}
         WHERE id IN ({$idstr})
      ";
      $wpdb->query($q);
    }
  }

  public function get_added_keywords($link_id, $keywords) {
    global $wpdb;

    $keywords = array_map(create_function('$kw', 'return trim($kw);'), $keywords);

    $q = $wpdb->prepare("
        SELECT text
          FROM {$this->table_name} AS kw
         WHERE kw.link_id=%d
      ",
      $link_id
    );
    $kws = $wpdb->get_col($q);

    return array_diff($keywords, $kws);
  }

  public function create_added_keywords($link_id, $keywords) {
    $keywords = explode(',',$keywords);

    $added_keywords = $this->get_added_keywords($link_id, $keywords);

    // Create the new keywords
    foreach($added_keywords as $added_keyword) {
      if(!empty($added_keyword)) { //Don't save an empty keyword
        $this->create(trim($added_keyword), $link_id);
      }
    }
  }

  public function updateLinkKeywords($link_id,$keywords) {
    // Get rid of the old keywords
    //$this->destroyByLinkId($link_id);

    $this->delete_removed_keywords($link_id, $keywords);
    $this->create_added_keywords($link_id, $keywords);
  }

  public function destroy( $id ) {
    global $wpdb;
    $query_str = "DELETE FROM {$this->table_name} WHERE id=%d";
    $query = $wpdb->prepare($query_str,$id);
    return $wpdb->query($query);
  }

  public function destroyByLinkId( $link_id ) {
    global $wpdb;
    $query_str = "DELETE FROM {$this->table_name} WHERE link_id=%d";
    $query = $wpdb->prepare($query_str,$link_id);
    return $wpdb->query($query);
  }

  public function getOne( $id, $return_type = OBJECT ) {
    global $wpdb;
    $query_str = "SELECT * FROM {$this->table_name} WHERE id=%d";
    $query = $wpdb->prepare($query_str,$id);
    return $wpdb->get_row($query, $return_type);
  }

  public function getAllByLinkId( $link_id, $return_type = OBJECT ) {
    global $wpdb;
    $query_str = "SELECT * FROM {$this->table_name} WHERE link_id=%d ORDER BY text";
    $query = $wpdb->prepare($query_str,$link_id);
    return $wpdb->get_results($query, $return_type);
  }

  public function getTextByLinkId( $link_id ) {
    $keywords = $this->getAllByLinkId( $link_id );

    $keywords_array = array();
    foreach($keywords as $keyword)
      $keywords_array[] = stripslashes(htmlspecialchars($keyword->text));

    return implode( ', ', $keywords_array );
  }

  public function getAllUniqueKeywordsText() {
    global $wpdb;
    $query = "SELECT DISTINCT text FROM {$this->table_name}";
    return $wpdb->get_col($query, 0);
  }

  public function getAll($where = '', $return_type = OBJECT) {
    global $wpdb, $prli_utils;
    $query_str = "SELECT * FROM {$this->table_name}" . $prli_utils->prepend_and_or_where(' WHERE', $where) . " ORDER BY text";
    return $wpdb->get_results($query_str, $return_type);
  }

  // Returns an array of links that have this keyword
  public function getLinksByKeyword($keyword) {
    global $wpdb;
    $query_str = "SELECT link_id FROM {$this->table_name} WHERE text=%s";
    $query = $wpdb->prepare($query_str,$keyword);
    return $wpdb->get_col($query,0);
  }

  public function request_url_matches_url($url) {
    $url_pattern = $url;
    $url_pattern = preg_replace('!^https?!','^https?',$url_pattern); // http / https
    $url_pattern = preg_replace('!\/\\?!','/?\\?',$url_pattern); // optional trailing slash
    $url_pattern = preg_replace('!\/$!','/?',$url_pattern); // optional trailing slash

    $request_url = PrliUtils::full_request_url();

    return preg_match('!' . preg_quote($url_pattern, '!') . '!', $request_url);
  }

  private function format_keywords_array($keywords) {
    $links_array = array();

    foreach($keywords as $keyword) {
      // Filter out keywords that have a url matching the current uri
      if(!$this->request_url_matches_url($keyword->link_url)) {
        if(!isset($links_array[$keyword->keyword])) {
          $links_array[$keyword->keyword] = array();
        }

        $links_array[$keyword->keyword][] = (object)array('url' => $keyword->url, 'title' => stripslashes($keyword->title));
      }
    }

    return $links_array;
  }

  /** This will get all of the keywords to urls for the given post.
    * This is also where our smart-caching will come into play.
    */
  public function get_post_keywords_lookup($post_id) {
    static $kws;

    if(!isset($kws)) {
      $kws = array();
    }

    if(!isset($kws[$post_id])) {
      $index_keywords = get_option('plp_index_keywords', false);
      if(empty($index_keywords)) { return $this->getKeywordToLinksArray($post_id); }

      global $wpdb, $prli_link, $prli_blogurl;

      $q = "
        SELECT kw.text as keyword,
               li.name as title,
               li.url as link_url,
               li.id as link_id,
               CONCAT(%s,li.slug) AS url
          FROM {$prli_link->table_name} li
          JOIN {$this->table_name} kw
            ON li.id=kw.link_id
          JOIN {$this->post_keywords_table_name} AS pkw
            ON kw.id = pkw.keyword_id
         WHERE pkw.post_id=%d
           AND kw.text <> %s
         ORDER BY CHAR_LENGTH(kw.text) DESC,
               kw.text ASC
      ";

      $struct = PrliUtils::get_permalink_pre_slug_uri();
      $q = $wpdb->prepare($q, $prli_blogurl.$struct, $post_id, '');

      $keywords = $wpdb->get_results($q);

      $kws[$post_id] = $this->format_keywords_array($keywords);
    }

    return $kws[$post_id];
  }

  public function getKeywordToLinksArray($post_id = false) {
    static $kws;

    //Don't return keywords that link back to the current post
    $and_str = ($post_id) ? "AND li.url NOT LIKE '%" . parse_url(get_permalink($post_id), PHP_URL_PATH) . "'" : '';

    if(!isset($kws)) {
      global $wpdb, $prli_link, $plp_keyword, $prli_blogurl;

      $struct = PrliUtils::get_permalink_pre_slug_uri();
      $query = "
        SELECT kw.text as keyword,
               li.name as title,
               li.url as link_url,
               li.id as link_id,
               CONCAT(%s,li.slug) AS url
          FROM {$prli_link->table_name} li
          JOIN {$plp_keyword->table_name} kw
            ON li.id=kw.link_id
         WHERE kw.text <> %s
         {$and_str}
         ORDER BY CHAR_LENGTH(kw.text) DESC,
               kw.text ASC
      ";

      $query = $wpdb->prepare($query, $prli_blogurl.$struct, '');
      $keywords = $wpdb->get_results($query);

      $kws = $this->format_keywords_array($keywords);
    }

    return $kws;
  }

  // Pagination Methods
  public function getRecordCount($where="") {
    global $wpdb, $prli_utils;
    $query_str = "SELECT COUNT(*) FROM {$this->table_name}" . $prli_utils->prepend_and_or_where(' WHERE', $where);
    return $wpdb->get_var($query_str);
  }

  public function getPageCount($p_size, $where="") {
    return ceil((int)$this->getRecordCount($where) / (int)$p_size);
  }

  public function getPage($current_p, $p_size, $where = "", $return_type = OBJECT) {
    global $wpdb, $prli_utils;

    $end_index = $current_p * $p_size;
    $start_index = $end_index - $p_size;

    $query_str = "
      SELECT * FROM {$this->table_name}" .
       $prli_utils->prepend_and_or_where(' WHERE', $where) . "
       ORDER BY text
       LIMIT {$start_index},{$p_size}
    ";

    $results = $wpdb->get_results($query, $return_type);

    return $results;
  }

  public function post_has_post_keywords($post_id) {
    global $wpdb;

    $q = "
      SELECT COUNT(*)
        FROM {$this->post_keywords_table_name}
       WHERE post_id=%d
    ";
    $q = $wpdb->prepare($q, $post_id);
    $count = (int)$wpdb->get_var($q);

    return ($count > 0);
  }

  public function link_has_post_keywords($link_id) {
    global $wpdb;

    $q = "
      SELECT COUNT(*)
        FROM {$this->post_keywords_table_name} AS pkw
       WHERE pkw.keyword_id IN (
         SELECT kw.id
           FROM {$this->table_name} AS kw
          WHERE kw.link_id=%d
       )
    ";
    $q = $wpdb->prepare($q, $link_id);
    $count = (int)$wpdb->get_var($q);

    return ($count > 0);
  }

  public function delete_post_keywords_by_post_id($post_id) {
    global $wpdb;

    $q = "
      DELETE FROM {$this->post_keywords_table_name}
       WHERE post_id=%d
    ";
    $q = $wpdb->prepare($q, $post_id);

    return $wpdb->query($q);
  }

  public function delete_post_keywords_by_link_id($link_id) {
    global $wpdb, $prli_link_meta;

    // Delete ALL postmeta so we can start updating for this link
    //delete_post_meta($post_id, '_plp_post_keywords_updated_at');

    $q = "
      DELETE FROM {$this->post_keywords_table_name} AS pkw
       WHERE pkw.keyword_id IN (
         SELECT kw.id
           FROM {$this->table_name} AS kw
          WHERE kw.link_id=%d
       )
    ";
    $q = $wpdb->prepare($q, $link_id);

    return $wpdb->query($q);
  }

  // ENSURE NO LINKS WITH NULL updated_at
  // SET any links with null as updated_at to current time
  public function update_links_with_null_updated_at () {
    global $wpdb, $prli_link;

    $now = date('Y-m-d H:i:s');

    $q = "
      UPDATE {$prli_link->table_name}
         SET updated_at=%s
       WHERE updated_at IS NULL
    ";
    $q = $wpdb->prepare($q, $now);

    return $wpdb->query($q);
  }

  // SELECT posts where updated_at < than max link updated_at
  public function get_indexable_posts ($max_count=100) {
    global $wpdb, $plp_options, $prli_link;

    $this->update_links_with_null_updated_at();

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(kw.created_at)
        FROM {$this->table_name} AS kw
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Order to get oldest / null entries updated first
    $q = $wpdb->prepare("
      SELECT ID
        FROM {$wpdb->posts} AS p
        LEFT JOIN {$wpdb->postmeta} AS pm
          ON p.ID=pm.post_id
         AND pm.meta_key='_plp_post_keywords_updated_at'
       WHERE p.post_status = 'publish'
         AND p.post_type IN ({$valid_types})
         AND (
           pm.meta_value IS NULL
           OR pm.meta_value < %s
         )
       ORDER BY pm.meta_value ASC,p.post_date DESC
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
    global $wpdb, $plp_options, $prli_link;

    $this->update_links_with_null_updated_at();

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(kw.created_at)
        FROM {$this->table_name} AS kw
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
         AND cm.meta_key='_plp_comment_keywords_updated_at'
       WHERE c.comment_approved=1
         AND (
           cm.meta_value IS NULL
           OR cm.meta_value < %s
         )
       ORDER BY cm.meta_value ASC,c.comment_date DESC
       LIMIT 100
      ",
      $max_updated_at
    );
    $comments = $wpdb->get_col($q);

    return $comments;
  }

  private function get_post_grouped_keywords ($post_id) {
    static $kws;

    if(!isset($kws)) {
      $kws = array();
    }

    if(!isset($kws[$post_id])) {
      global $wpdb, $prli_link, $plp_options;

      $valid_types = $plp_options->autocreate_valid_types();
      $valid_types = "'".implode("', '", $valid_types)."'";

      $q = "
        SELECT * FROM (
          SELECT kw.text, MIN(kw.id) AS id
            FROM {$this->table_name} AS kw
            JOIN {$wpdb->posts} AS p
              ON p.ID=%d
            LEFT JOIN {$wpdb->postmeta} AS pm
              ON pm.post_id=p.ID
             AND pm.meta_key='_plp_post_keywords_updated_at'
           WHERE p.post_status='publish'
             AND p.post_type IN ({$valid_types})
             AND (
                   pm.meta_value IS NULL
                   OR pm.meta_value < kw.created_at
                 )
           GROUP BY kw.text
         ) as k
         ORDER BY CHAR_LENGTH(k.text) DESC, k.text ASC
      ";
      $q = $wpdb->prepare($q, $post_id);

      $kws[$post_id] = $wpdb->get_results($q);
    }

    return $kws[$post_id];
  }

  private function get_comment_grouped_keywords ($comment_id) {
    static $kws;

    if(!isset($kws)) {
      $kws = array();
    }

    if(!isset($kws[$comment_id])) {
      global $wpdb, $prli_link, $plp_options;

      $valid_types = $plp_options->autocreate_valid_types();
      $valid_types = "'".implode("', '", $valid_types)."'";

      $q = "
        SELECT * FROM (
          SELECT kw.text, MIN(kw.id) AS id
            FROM {$this->table_name} AS kw
            JOIN {$wpdb->comments} AS c
              ON c.comment_ID=%d
            JOIN {$wpdb->posts} AS p
              ON p.ID=c.comment_post_ID
            LEFT JOIN {$wpdb->commentmeta} AS cm
              ON cm.comment_id=c.comment_ID
             AND cm.meta_key='_plp_comment_keywords_updated_at'
           WHERE c.comment_approved=1
             AND p.post_status='publish'
             AND p.post_type IN ({$valid_types})
             AND (
                   cm.meta_value IS NULL
                   OR cm.meta_value < kw.created_at
                 )
           GROUP BY kw.text
         ) as k
         ORDER BY CHAR_LENGTH(k.text) DESC, k.text ASC
      ";
      $q = $wpdb->prepare($q, $comment_id);

      $kws[$comment_id] = $wpdb->get_results($q);
    }

    return $kws[$comment_id];
  }

  // Figure out keywords applicable to this post and index them appropriately
  public function index_post ($post_id) {
    global $plp_options;
    $kws = $this->get_post_grouped_keywords($post_id);
    $post_content = strip_tags(PrliUtils::get_post_content($post_id));
    $this->index_content($post_id, $kws, $post_content);
    update_post_meta($post_id, '_plp_post_keywords_updated_at', PrliUtils::now());
  }

  public function index_comment ($comment_id) {
    global $plp_options;
    $kws = $this->get_comment_grouped_keywords($comment_id);
    $comment_content = strip_tags(get_comment_text($comment_id));
    $comment = get_comment($comment_id);
    $this->index_content($comment->comment_post_ID, $kws, $comment_content);
    update_comment_meta($comment_id, '_plp_comment_keywords_updated_at', PrliUtils::now());
  }

  private function index_content ($post_id, &$kws, &$content) {
    $kw_ids = array();
    foreach($kws as $kw) {
      if(preg_match('/\b'.preg_quote($kw->text).'\b/i', $content)) {
        $kw_ids[] = $kw->id;
      }
    }

    // Add all keywords in one swath
    return $this->add_post_keywords($post_id, $kw_ids);
  }

  public function get_post_keywords_by_post_id ($post_id) {
    global $wpdb;

    $q = "
      SELECT pkw.keyword_id
        FROM {$this->post_keywords_table_name} AS pkw
       WHERE pkw.post_id=%d
    ";
    $q = $wpdb->prepare($q, $post_id);

    return $wpdb->get_col($q);
  }

  public function add_post_keywords ($post_id, $keyword_ids) {
    global $wpdb;

    if(empty($keyword_ids)) { return false; }

    // We got a unique index folks so we just ignore dups yo
    // But we just want to grab one random keyword to insert here
    $q = "
      INSERT IGNORE INTO {$this->post_keywords_table_name}
        (post_id, keyword_id)
      VALUES
    ";

    $vals = array();
    foreach($keyword_ids as $keyword_id) {
      // Not sure how this would ever be un-true but let's make sure it doesn't happen
      if($keyword_id > 0 && $post_id > 0) {
        $vals[] = $wpdb->prepare("(%d, %d)", $post_id, $keyword_id);
      }
    }

    // No values to insert? Let's bail.
    if(empty($vals)) { return false; }

    $q .= implode(',',$vals);

    return $wpdb->query($q);
  }

  // How many posts out of all are indexed
  public function posts_indexed () {
    global $wpdb, $prli_link, $plp_options;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(kw.created_at)
        FROM {$this->table_name} AS kw
    ";
    $max_updated_at = $wpdb->get_var($q);

    // Num un-indexed posts
    $q = $wpdb->prepare("
      SELECT COUNT(*)
        FROM {$wpdb->posts} AS p
        LEFT JOIN {$wpdb->postmeta} AS pm
          ON p.ID=pm.post_id
         AND pm.meta_key='_plp_post_keywords_updated_at'
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
    global $wpdb, $prli_link, $plp_options;

    $valid_types = $plp_options->autocreate_valid_types();
    $valid_types = "'".implode("', '", $valid_types)."'";

    $q = "
      SELECT max(kw.created_at)
        FROM {$this->table_name} AS kw
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
         AND cm.meta_key='_plp_comment_keywords_updated_at'
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

