<?php
if(!defined('ABSPATH')) die('You are not allowed to call this page directly.');

class PlpOptions {
  public $pages_auto;
  public $posts_auto;
  public $pages_group;
  public $posts_group;
  public $autocreate;

  public $default_social_buttons;
  public $social_buttons;
  public $social_buttons_placement;
  public $social_buttons_show_in_feed;
  public $social_buttons_padding;
  public $social_posts_buttons;
  public $social_pages_buttons;

  public $keyword_replacement_is_on;
  public $keywords_per_page;
  public $keyword_links_per_page;
  public $keyword_links_open_new_window;
  public $keyword_links_nofollow;
  public $keyword_link_custom_css;
  public $keyword_link_hover_custom_css;
  public $set_keyword_thresholds;
  public $keyword_enable_content_cache; // DEPRECATED
  public $replace_urls_with_pretty_links;
  public $replace_urls_with_pretty_links_blacklist;
  public $replace_keywords_in_comments;
  public $replace_keywords_in_feeds;
  public $enable_link_to_disclosures;
  public $disclosures_link_url;
  public $disclosures_link_text;
  public $disclosures_link_position;
  public $enable_keyword_link_disclosures;
  public $keyword_link_disclosure;

  public $use_prettylink_url;
  public $prettylink_url;

  public $min_role;

  public $allow_public_link_creation;
  public $use_public_link_display_page;
  public $public_link_display_page;

  public $prettybar_hide_attrib_link;
  public $prettybar_attrib_url;

  public $google_tracking;
  public $google_tracking_str;

  public $generate_qr_codes_str;
  public $generate_qr_codes;

  public $qr_code_links_str;
  public $qr_code_links;

  public $global_head_scripts_str;
  public $global_head_scripts;

  //Use a base slug prefix on all new links like out/ or go/ etc.
  public $base_slug_prefix_str;
  public $base_slug_prefix;

  //The number of characters to use in random slug generation.
  public $num_slug_chars_str;
  public $num_slug_chars;

  public function __construct($options_array=array()) {
    // Set values from array
    foreach($options_array as $key => $value) {
      $this->{$key} = $value;
    }

    $this->set_default_options();
  }

  public function set_default_options() {
    if(!isset($this->pages_auto))
      $this->pages_auto = 0;

    if(!isset($this->posts_auto))
      $this->posts_auto = 0;

    if(!isset($this->pages_group))
      $this->pages_group = '';

    if(!isset($this->posts_group))
      $this->posts_group = '';

    if(!isset($this->autocreate)) {
      $this->autocreate = array();
    }

    $this->default_social_buttons = array(
      'facebook' => array(
        'label' => __('Facebook'),
        'checked' => false,
        'slug' => 'facebook',
        'icon' => 'pl-icon-facebook',
        'url' => 'http://www.facebook.com/sharer.php?u={{encoded_url}}&t={{encoded_title}}'
      ),
      'twitter' => array(
        'label' => __('Twitter'),
        'checked' => false,
        'slug' => 'twitter',
        'icon' => 'pl-icon-twitter',
        'url' => 'http://twitter.com/home?status={{tweet_message}}'
      ),
      'gplus' => array(
        'label' => __('Google+'),
        'checked' => false,
        'slug' => 'gplus',
        'icon' => 'pl-icon-gplus',
        'url' => 'https://plus.google.com/share?url={{encoded_url}}'
      ),
      'pinterest' => array(
        'label' => __('Pinterest'),
        'checked' => false,
        'slug' => 'pinterest',
        'icon' => 'pl-icon-pinterest',
        'url' => 'http://pinterest.com/pin/create/button/?url={{encoded_url}}&description={{encoded_title}}"'
      ),
      'linkedin' => array(
        'label' => __('LinkedIn'),
        'checked' => false,
        'slug' => 'linkedin',
        'icon' => 'pl-icon-linkedin',
        'url' => 'http://www.linkedin.com/shareArticle?mini=true&url={{encoded_url}}&title={{encoded_title}}'
      ),
      'reddit' => array(
        'label' => __('Reddit'),
        'checked' => false,
        'slug' => 'reddit',
        'icon' => 'pl-icon-reddit',
        'url' => 'http://reddit.com/submit?url={{encoded_url}}&title={{encoded_title}}'
      ),
      'stumbleupon' => array(
        'label' => __('StumbleUpon'),
        'checked' => false,
        'slug' => 'stumbleupon',
        'icon' => 'pl-icon-stumbleupon',
        'url' => 'http://www.stumbleupon.com/submit?url={{encoded_url}}&title={{encoded_title}}'
      ),
      'digg' => array(
        'label' => __('Digg'),
        'checked' => false,
        'slug' => 'digg',
        'icon' => 'pl-icon-digg',
        'url' => 'http://digg.com/submit?phase=2&url={{encoded_url}}&title={{encoded_title}}'
      ),
      'email' => array(
        'label' => __('Email'),
        'checked' => false,
        'slug' => 'email',
        'icon' => 'pl-icon-email',
        'url' => 'mailto:?subject={{encoded_title}}&body={{encoded_title}}%20{{encoded_url}}'
      )
    );

    if(!isset($this->social_buttons)) {
      $this->social_buttons = array_values( $this->default_social_buttons );
    }
    else {
      // If it's the old-style array then refactor it
      if( isset($this->social_buttons['facebook']) ) {
        $new_social_buttons = array_values( $this->default_social_buttons );

        foreach( $new_social_buttons as $i => $values ) {
          if( isset( $this->social_buttons[$values['slug']] ) ) {
            $new_social_buttons[$i]['checked'] = ($values==='on');
          }
        }

        $this->social_buttons = $new_social_buttons;
      }
    }

    if(!isset($this->social_buttons_placement))
      $this->social_buttons_placement = 'bottom';

    if(!isset($this->social_buttons_show_in_feed))
      $this->social_buttons_show_in_feed = 0;

    if(!isset($this->social_buttons_padding))
      $this->social_buttons_padding = '10';

    if(!isset($this->social_posts_buttons))
      $this->social_posts_buttons = 0;

    if(!isset($this->social_pages_buttons))
      $this->social_pages_buttons = 0;

    if(!isset($this->keyword_replacement_is_on))
      $this->keyword_replacement_is_on = 1;

    if(!isset($this->keywords_per_page))
      $this->keywords_per_page = 3;

    if(!isset($this->keyword_links_per_page))
      $this->keyword_links_per_page = 2;

    if(!isset($this->keyword_links_open_new_window))
      $this->keyword_links_open_new_window = 0;

    if(!isset($this->keyword_links_nofollow))
      $this->keyword_links_nofollow = 0;

    if(!isset($this->keyword_link_custom_css))
      $this->keyword_link_custom_css = '';

    if(!isset($this->keyword_link_hover_custom_css))
      $this->keyword_link_hover_custom_css = '';

    if(!isset($this->set_keyword_thresholds))
      $this->set_keyword_thresholds = 0;

    // DEPRECATED
    $this->keyword_enable_content_cache = 0;

    if(!isset($this->replace_urls_with_pretty_links))
      $this->replace_urls_with_pretty_links = 0;
    if(!isset($this->replace_urls_with_pretty_links_blacklist))
      $this->replace_urls_with_pretty_links_blacklist = '';
    if(!isset($this->replace_keywords_in_comments))
      $this->replace_keywords_in_comments = 0;
    if(!isset($this->replace_keywords_in_feeds))
      $this->replace_keywords_in_feeds = 0;
    if(!isset($this->enable_link_to_disclosures)) {
      $this->enable_link_to_disclosures = 0;
    }
    if(!isset($this->disclosures_link_url)) {
      $this->disclosures_link_url = '';
    }
    if(!isset($this->disclosures_link_text)) {
      $this->disclosures_link_text = __('Affiliate Link Disclosures','pretty-link');
    }
    if(!isset($this->disclosures_link_position)) {
      $this->disclosures_link_position = 'bottom';
    }
    if(!isset($this->enable_keyword_link_disclosures)) {
      $this->enable_keyword_link_disclosures = 0;
    }
    if(!isset($this->keyword_link_disclosure)) {
      $this->keyword_link_disclosure = __('(aff)');
    }

    if(!isset($this->use_prettylink_url))
      $this->use_prettylink_url = 0;

    if(!isset($this->prettylink_url))
      $this->prettylink_url = '';

    //manage_options = ADMIN
    //delete_pages = EDITOR
    //publish_posts = AUTHOR
    //edit_posts = CONTRIBUTOR
    //read = SUBSCRIBER
    if(!isset($this->min_role))
      $this->min_role = 'manage_options';

    if(!isset($this->allow_public_link_creation))
      $this->allow_public_link_creation = 0;

    if(!isset($this->use_public_link_display_page))
      $this->use_public_link_display_page = 0;

    if(!isset($this->public_link_display_page))
      $this->public_link_display_page = '';

    if(!isset($this->prettybar_hide_attrib_link))
      $this->prettybar_hide_attrib_link = 0;

    if(!isset($this->prettybar_attrib_url))
      $this->prettybar_attrib_url = '';

    $this->google_tracking_str = 'prlipro-google-tracking';
    if(!isset($this->google_tracking))
      $this->google_tracking = 0;

    $this->generate_qr_codes_str = 'prlipro-generate-qr-codes';
    if(!isset($this->generate_qr_codes))
      $this->generate_qr_codes = 0;

    $this->qr_code_links_str = 'prlipro-code-links';
    $this->qr_code_links = 0;
    /* TODO: We're going to just comment this out for now
    if(!isset($this->qr_code_links))
      $this->qr_code_links = 0;
    */

    $this->global_head_scripts_str = 'prlipro-global-head-scripts';
    if(!isset($this->global_head_scripts) || empty($this->global_head_scripts))
      $this->global_head_scripts = '';

    $this->base_slug_prefix_str = 'prlipro-base-slug-prefix';
    if(!isset($this->base_slug_prefix))
      $this->base_slug_prefix = '';

    $this->num_slug_chars_str = 'prlipro-num-slug-chars';
    if(!isset($this->num_slug_chars))
      $this->num_slug_chars = 4;
  }

  public function store() {
    $storage_array = (array)$this;
    update_option( 'prlipro_options', $storage_array );
  }

  public function autocreate_option($post_type='post') {
    $opt = array(
      'enabled' => false,
      'group' => '',
      'socbtns' => false
    );

    if($post_type=='post') {
      $opt['enabled'] = !empty($this->posts_auto);
      $opt['group']   = $this->posts_group;
      $opt['socbtns'] = !empty($this->social_posts_buttons);
    }
    else if($post_type=='page') {
      $opt['enabled'] = !empty($this->pages_auto);
      $opt['group']   = $this->pages_group;
      $opt['socbtns'] = !empty($this->social_pages_buttons);
    }
    else {
      if(isset($this->autocreate[$post_type])) {
        $ac = $this->autocreate[$post_type];
        $opt['enabled'] = isset($ac['enabled']) && !empty($ac['enabled']);
        $opt['group']   = isset($ac['group']) ? $ac['group'] : '';
        $opt['socbtns'] = isset($ac['socbtns']) && !empty($ac['socbtns']);
      }
    }

    return (object)$opt;
  }

  public function autocreate_options() {
    $opts = array();
    $post_types = $this->get_post_types();

    foreach($post_types as $post_type) {
      $opts[$post_type] = $this->autocreate_option($post_type);
    }

    return (object)$opts;
  }

  public function autocreate_valid_types() {
    $valid_opts = array();
    $opts = $this->autocreate_options();

    foreach($opts as $post_type => $opt) {
      if($opt->enabled) {
        $valid_opts[] = $post_type;
      }
    }

    return $valid_opts;
  }

  public function get_post_types($include_page_and_post=true) {
    $post_types = get_post_types(array('_builtin'=>false,'public'=>true),'names','and');

    if($include_page_and_post) {
      $post_types['post'] = 'post';
      $post_types['page'] = 'page';
    }

    return $post_types;
  }

  public static function get_options() {
    $plp_options = get_option('prlipro_options');

    if($plp_options) {
      if(is_string($plp_options)) {
        $plp_options = unserialize($plp_options);
      }

      if(is_object($plp_options) && is_a($plp_options,'PlpOptions')) {
        $plp_options->set_default_options();
        $plp_options->store(); // store will convert this back into an array
      }
      else if(is_array($plp_options)) {
        $plp_options = new PlpOptions($plp_options);
      }
      else {
        $plp_options = new PlpOptions();
      }
    }
    else {
      $plp_options = new PlpOptions();
    }

    return $plp_options;
  }
}
