<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpPostsController extends PrliBaseController {
  public function load_hooks() {
    add_filter('the_content', array($this, 'run_autocreate'), 9); //This priority should be lower than social button bars
    add_action('save_post', array($this,'save_postdata'), 10, 3); // Manual update post
    add_action('transition_post_status', array($this,'transition_post_status'), 10, 3); // Publishing Scheduled content, etc.
    add_action('xmlrpc_publish_post', array($this,'xmlrpc_publish_post'), 10, 1); // Publishing Via XML-RPC
    add_action('wp_enqueue_scripts', array($this,'enqueue_scripts'));
    add_shortcode('post-pretty-link', array($this,'get_pretty_link'));

    //This trim_empty_replacement_rows can go at some point in the future after we think everyone has upgraded to 2.0.0+
    //This is an attempt to boost some query performance on keyword/url replacements
    add_action('admin_init', array($this, 'trim_empty_replacement_rows'));

    add_action('plp_admin_menu', array($this, 'admin_menu'), 10, 1);
  }

  public function enqueue_scripts() {
    global $post, $plp_options;

    if(!isset($post)) { return; }

    $post_types = $plp_options->get_post_types();

    $ac = $plp_options->autocreate_option($post->post_type);

    if($ac->enabled && $ac->socbtns) {
      wp_enqueue_style('prli-fontello-animation',
                       PRLI_VENDOR_LIB_URL.'/fontello/css/animation.css',
                       array(), PRLI_VERSION);
      wp_enqueue_style('prli-fontello-pretty-link',
                       PRLI_VENDOR_LIB_URL.'/fontello/css/pretty-link.css',
                       array('prli-fontello-animation'), PRLI_VERSION);
      wp_enqueue_style('prlipro-post', PLP_CSS_URL . '/prlipro-post.css');
      wp_enqueue_style('prlipro-social', PRLI_CSS_URL . '/social_buttons.css', array('prli-fontello-animation','prli-fontello-pretty-link'));
    }
  }

  public function admin_menu($role) {
    global $plp_options;

    $post_types = $plp_options->get_post_types();

    foreach($post_types as $post_type) {
      $ac = $plp_options->autocreate_option($post_type);

      // Show the meta box on post edit pages for auto generated pretty links
      if($ac->enabled) {
        add_meta_box('prlipro', __('Pretty Links Pro', 'pretty-link'), 'PlpPostsHelper::post_sidebar', $post_type, 'side', 'high');
      }

      if(($ac->enabled && $ac->socbtns) || $plp_options->keyword_replacement_is_on) {
        add_meta_box('prlipro_options', __('Pretty Links Pro Options', 'pretty-link'), 'PlpPostsHelper::post_options', $post_type, 'normal');
      }
    }
  }

  public function transition_post_status($new_status, $old_status, $post) {
    if($old_status != $new_status && $new_status == 'publish') {
      $this->publish_post($post->ID, 'auto');
    }
  }

  public function xmlrpc_publish_post($post_id) {
    $this->publish_post($post_id, 'auto');
  }

  public function publish_post($post_id, $type = 'manual') {
    $post = get_post($post_id);
    $this->save_postdata($post_id, $post, false, $type);
    $permalink = get_permalink($post_id); //Not sure what this is for?
  }

  public function save_postdata($post_id, $post, $update, $type = 'manual') {
    global $plp_options, $plp_keyword;

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
    }

    if(defined('DOING_AJAX')) {
      $type = 'auto';
    }

    if(!$post_id || !isset($post->ID) || !$post->ID) { return $post_id; }

    if(!current_user_can('edit_post', $post_id) && $type != 'auto') { return $post_id; }

    $ac = $plp_options->autocreate_option($post->post_type);
    $plp_post_options = PlpPostOptions::get_options($post_id);
    $plp_post_options->requested_slug = isset($_REQUEST['prli_req_slug'])?$_REQUEST['prli_req_slug']:$plp_post_options->requested_slug;

    //Make sure a nonce is set so we don't wipe these options out when the post is being bulk edited
    if(wp_verify_nonce((isset($_POST['plp_nonce']))?$_POST['plp_nonce']:'', 'plp_nonce'.wp_salt())) {
      $plp_post_options->hide_social_buttons   = isset($_REQUEST['hide_social_buttons']);
      $plp_post_options->disable_replacements  = isset($_REQUEST['disable_replacements']);
    }

    $plp_post_options->store($post_id);

    $this->auto_create_pretty_link($post_id, $post);

    // Delete all the post keywords for this link to be rebuilt by our wp-cron task
    $plp_keyword->delete_post_keywords_by_post_id($post_id);

    delete_post_meta($post_id, '_plp_post_keywords_updated_at');
    delete_post_meta($post_id, '_plp_post_urls_updated_at');
  }

  public function auto_create_pretty_link($post_id, $post) {
    global $plp_options, $prli_link, $prli_utils, $plp_options, $prli_link_meta;

    $ac = $plp_options->autocreate_option($post->post_type);

    if(!$ac->enabled) { return; }

    if($post && $post->post_status == "publish") {
      $default_group = $ac->group;
      $default_group = (is_numeric($default_group)?$default_group:0);

      $plp_post_options = PlpPostOptions::get_options($post_id);

      $pretty_link_id = PrliUtils::get_prli_post_meta($post_id,"_pretty-link",true);

      $new_link = false;
      // Try to find a pretty link that is using this link already
      if(!$pretty_link_id) {
        $new_link = true;
        $pretty_link_id = $prli_link->find_first_target_url(get_permalink($post_id));
      }

      $pretty_link = $prli_link->getOne($pretty_link_id);

      if(empty($pretty_link) || !$pretty_link) {
        $slug = (($prli_utils->slugIsAvailable($plp_post_options->requested_slug))?$plp_post_options->requested_slug:'');
        $pl_insert_id = prli_create_pretty_link( get_permalink($post_id),
                                                 $slug, // slug should be default?
                                                 addslashes($post->post_title),
                                                 addslashes($post->post_excerpt),
                                                 $default_group // Default Group
                                               );

        $new_pretty_link = $prli_link->getOne($pl_insert_id);

        if(isset($post->ID) && !empty($post->ID) && $post->ID) {
          PrliUtils::update_prli_post_meta($post->ID,'_pretty-link',$new_pretty_link->id,true);
        }
      }
      else {
        prli_update_pretty_link( $pretty_link_id,
                                 get_permalink($post_id),
                                 $pretty_link->slug,
                                 addslashes($post->post_title),
                                 addslashes($post->post_excerpt),
                                 $default_group
                               );

        // Still update the post meta
        if(isset($post_id) && !empty($post_id) && $post_id) {
          PrliUtils::update_prli_post_meta($post_id,'_pretty-link',$pretty_link_id,true);
        }
      }
    }
  }

  // shortcode for displaying the pretty link for the post/page
  public function get_pretty_link() {
    global $post, $plp_options, $prli_blogurl, $prli_link, $wp_query, $prli_link_meta;

    $ac = $plp_options->autocreate_option($post->post_type);

    // Don't show until published
    if($post->post_status != 'publish' ||
       // only show button if enabled and links are being generated
       ((is_single() || is_archive() || $wp_query->is_posts_page) && !$ac->enabled)) {
      return '';
    }

    $pretty_link_id = PrliUtils::get_prli_post_meta($post->ID,"_pretty-link",true);
    $pretty_link = $prli_link->getOne($pretty_link_id);
    $shorturl = $prli_blogurl.PrliUtils::get_permalink_pre_slug_uri().$pretty_link->slug;

    return $shorturl;
  }

  //This trim_empty_replacement_rows can go at some point in the future after we think everyone has upgraded to 2.0.0+
  //This is an attempt to boost some query performance on keyword/url replacements
  public function trim_empty_replacement_rows() {
    global $wpdb, $prli_link_meta, $plp_keyword;

    //This only ever needs to be run once, since I fixed the code that was causing the blank rows in the first place
    if(!get_option('prli_empty_replacement_rows_cleanup', false)) {
      $wpdb->query("DELETE FROM {$plp_keyword->table_name} WHERE text IS NULL OR text = ''");
      $wpdb->query("DELETE FROM {$prli_link_meta->table_name} WHERE meta_key = 'prli-url-replacements' AND (meta_value IS NULL OR meta_value = '')");
      update_option('prli_empty_replacement_rows_cleanup', true);
    }
  }

  //Should move this to WP CRON at some point and have this done in batches, instead of one at a time via the_content like it is currently happening
  public function run_autocreate($content = '') {
    global $post, $prli_utils, $prli_link, $prli_link_meta, $plp_options;

    //No post object or type or published status?
    if(!isset($post) || !$post instanceof WP_Post || (int)$post->ID <= 0 || !isset($post->post_type) || $post->post_status != "publish") {
      return $content;
    }

    $ac = $plp_options->autocreate_option($post->post_type);

    if($ac->enabled) {
      $group = $ac->group;

      $plp_post_options = PlpPostOptions::get_options($post->ID);
      $pretty_link_id = PrliUtils::get_prli_post_meta($post->ID, '_pretty-link', true);

      // Try to find a pretty link that is using this link already
      if(!$pretty_link_id) {
        $pretty_link_id = $prli_link->find_first_target_url(get_permalink($post->ID));
      }

      $pretty_link = $prli_link->getOne($pretty_link_id);

      if(empty($pretty_link) or !$pretty_link) {
        $slug = (($prli_utils->slugIsAvailable($plp_post_options->requested_slug))?$plp_post_options->requested_slug:'');
        $pl_insert_id = prli_create_pretty_link(
                          get_permalink($post->ID),
                          $slug,
                          addslashes($post->post_title),
                          addslashes($post->post_excerpt),
                          $group
                        );
        $new_pretty_link = $prli_link->getOne($pl_insert_id);

        PrliUtils::update_prli_post_meta($post->ID, '_pretty-link', $new_pretty_link->id, true);
      }
      else {
        prli_update_pretty_link(
          $pretty_link_id,
          get_permalink($post->ID),
          $pretty_link->slug,
          addslashes($post->post_title),
          addslashes($post->post_excerpt),
          $group
        );

        PrliUtils::update_prli_post_meta($post->ID, '_pretty-link', $pretty_link_id, true);
      }
    }

    return $content;
  }
} //End Class

// Template Tag for displaying the pretty link for the post/page
function the_prettylink() {
  $ctrl = new PlpPostsController();
  echo $ctrl->get_pretty_link();
}
