<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpOptionsController extends PrliBaseController {
  public $opt_fields;

  public function load_hooks() {
    add_action('prli_admin_options_nav', array($this, 'nav'));
    add_action('prli_admin_general_options', array($this, 'general'));
    add_action('prli_admin_options_pages', array($this, 'display'));

    add_filter( 'prli-validate-options', array($this, 'validate') );
    add_filter( 'prli-update-options', array($this, 'update') );
    add_filter( 'prli-store-options', array($this, 'store') );

    $this->opt_fields = array(
      'hidden_field_name' => 'prlipro_update_options',
      'pages_auto' => 'prli_pages_auto',
      'posts_auto' => 'prli_posts_auto',
      'pages_group' => 'prli_pages_group',
      'posts_group' => 'prli_posts_group',
      'autocreate' => 'prli_autocreate',
      'social_buttons' => 'prli_social_buttons',
      'social_buttons_placement' => 'prli_social_buttons_placement',
      'social_buttons_padding' => 'prli_social_buttons_padding',
      'social_buttons_show_in_feed' => 'prli_social_buttons_show_in_feed',
      'social_posts_buttons' => 'prli_social_posts_buttons',
      'social_pages_buttons' => 'prli_social_pages_buttons',
      'keyword_replacement_is_on' => 'prli_keyword_replacement_is_on',
      'keywords_per_page' => 'prli_keywords_per_page',
      'keyword_links_per_page' => 'prli_keyword_links_per_page',
      'keyword_links_open_new_window' => 'prli_keyword_links_open_new_window',
      'keyword_links_nofollow' => 'prli_keyword_links_nofollow',
      'keyword_link_custom_css' => 'prli_keyword_link_custom_css',
      'keyword_link_hover_custom_css' => 'prli_keyword_link_hover_custom_css',
      'set_keyword_thresholds' => 'prli_set_keyword_thresholds',
      'replace_urls_with_pretty_links' => 'prli_replace_urls_with_pretty_links',
      'replace_urls_with_pretty_links_blacklist' => 'prli_replace_urls_with_pretty_links_blacklist',
      'replace_keywords_in_comments' => 'prli_replace_keywords_in_comments',
      'replace_keywords_in_feeds' => 'prli_replace_keywords_in_feeds',
      'enable_link_to_disclosures' => 'prli_enable_link_to_disclosures',
      'disclosures_link_url' => 'prli_disclosures_link_url',
      'disclosures_link_text' => 'prli_disclosures_link_text',
      'disclosures_link_position' => 'prli_disclosures_link_position',
      'enable_keyword_link_disclosures' => 'prli_enable_keyword_link_disclosures',
      'keyword_link_disclosure' => 'prli_keyword_link_disclosure',
      'use_prettylink_url' => 'prli_use_prettylink_url',
      'prettylink_url' => 'prli_prettylink_url',
      'minimum_access_role' => 'prli_min_role',
      'allow_public_link_creation' => 'prli_allow_public_link_creation',
      'use_public_link_display_page' => 'prli_use_public_link_display_page',
      'public_link_display_page' => 'prli_public_link_display_page',
      'prettybar_image_url' => 'prli_prettybar_image_url',
      'prettybar_background_image_url' => 'prli_prettybar_background_image_url',
      'prettybar_color' => 'prli_prettybar_color',
      'prettybar_text_color' => 'prli_prettybar_text_color',
      'prettybar_link_color' => 'prli_prettybar_link_color',
      'prettybar_hover_color' => 'prli_prettybar_hover_color',
      'prettybar_visited_color' => 'prli_prettybar_visited_color',
      'prettybar_show_title' => 'prli_prettybar_show_title',
      'prettybar_show_description' => 'prli_prettybar_show_description',
      'prettybar_show_share_links' => 'prli_prettybar_show_share_links',
      'prettybar_show_target_url_link' => 'prli_prettybar_show_target_url_link',
      'prettybar_title_limit' => 'prli_prettybar_title_limit',
      'prettybar_desc_limit' => 'prli_prettybar_desc_limit',
      'prettybar_link_limit' => 'prli_prettybar_link_limit',
      'prettybar_hide_attrib_link' => 'prettybar_hide_attrib_link',
      'prettybar_attrib_url' => 'prettybar_attrib_url'
    );
  }

  public function display() {
    global $prli_options, $plp_options;

    extract($this->opt_fields);

    $index_keywords = get_option('plp_index_keywords', false);

    require_once(PLP_VIEWS_PATH.'/options/form.php');
  }

  public function nav() {
    require_once(PLP_VIEWS_PATH.'/options/nav.php');
  }

  public function general() {
    global $plp_options;

    extract($this->opt_fields);

    require_once(PLP_VIEWS_PATH.'/options/general.php');
  }

  public function validate($errors=array()) {
    extract( $this->opt_fields );

    // Validate This
    //if( !empty($params[ $prettybar_link_limit ]) && !preg_match( "#^[0-9]*$#", $params[ $prettybar_link_limit ] ) )
    //  $errors[] = __("PrettyBar Link Character Limit must be a number", 'pretty-link');

    if( isset($_POST[$set_keyword_thresholds]) && empty($_POST[ $keywords_per_page ]) ) {
      $errors[] = __('Keywords Per Page is required', 'pretty-link');
    }

    if( isset($_POST[$set_keyword_thresholds]) && empty($_POST[ $keyword_links_per_page ]) ) {
      $errors[] = __('Keyword Links Per Page is required', 'pretty-link');
    }

    if( isset($_POST[ $use_prettylink_url ]) &&
        !preg_match('/^http.?:\/\/.*\..*[^\/]$/', $_POST[ $prettylink_url ] )) {
      $errors[] = __('You need to enter a valid Pretty Link Base URL now that you have selected "Use an alternate base url for your Pretty Links"', 'pretty-link');
    }

    if( isset($_POST[ $use_public_link_display_page ]) &&
        !preg_match('/^http.?:\/\/.*\..*[^\/]$/', $_POST[ $public_link_display_page ] ) ) {
      $errors[] = __('You need to enter a valid Public Link Display URL now that you have selected "Use a custom public link display page"', 'pretty-link');
    }

    if( !isset($_POST['prettybar_hide_attrib_link']) &&
        !empty($_POST['prlipro-attrib-url']) &&
        !preg_match('/^http.?:\/\/.*\..*$/', $_POST['prlipro-attrib-url'] ) ) {
      $errors[] = __("Pretty Bar Attribution URL must be a correctly formatted URL", 'pretty-link');
    }

    return $errors;
  }

  public function update($params) {
    global $prli_options, $plp_options;

    extract( $this->opt_fields );

    // Read their posted value
    $plp_options->pages_auto = (int)isset($params[ $pages_auto ]);
    $plp_options->posts_auto = (int)isset($params[ $posts_auto ]);
    $plp_options->pages_group = $params[ $pages_group ];
    $plp_options->posts_group = $params[ $posts_group ];

    // This won't be set if the user has no public CPTs in place
    $plp_options->autocreate = (isset($params[$autocreate]) ? $params[$autocreate] : array());

    //$plp_options->social_buttons = $params[ $social_buttons ];
    $new_social_buttons = $plp_options->default_social_buttons;
    foreach( $new_social_buttons as $btn_name => $btn ) {
      $new_social_buttons[$btn_name]['checked']=false;
    }

    if(!empty($params) && is_array($params[$social_buttons])) {
      foreach( array_reverse( $params[ $social_buttons ] ) as $btn_name => $btn_checked ) {
        $btn = $new_social_buttons[$btn_name];
        $btn['checked'] = true;
        unset($new_social_buttons[$btn_name]);
        array_unshift($new_social_buttons,$btn);
      }
    }

    $plp_options->social_buttons = array_values($new_social_buttons);
    $plp_options->social_buttons_placement = $params[ $social_buttons_placement ];
    $plp_options->social_buttons_show_in_feed = (int)isset($params[ $social_buttons_show_in_feed ]);
    //$plp_options->social_buttons_padding = $params[ $social_buttons_padding ];
    $plp_options->social_posts_buttons = (int)isset($params[ $social_posts_buttons ]);
    $plp_options->social_pages_buttons = (int)isset($params[ $social_pages_buttons ]);
    $plp_options->keyword_replacement_is_on = (int)isset($params[ $keyword_replacement_is_on ]);
    $plp_options->keyword_links_open_new_window = (int)isset($params[ $keyword_links_open_new_window ]);
    $plp_options->keyword_links_nofollow = (int)isset($params[ $keyword_links_nofollow ]);
    $plp_options->keyword_link_custom_css = $params[ $keyword_link_custom_css ];
    $plp_options->keyword_link_hover_custom_css = $params[ $keyword_link_hover_custom_css ];
    $plp_options->replace_urls_with_pretty_links = (int)isset($params[ $replace_urls_with_pretty_links ]);

    $plp_options->replace_urls_with_pretty_links_blacklist = $params[ $replace_urls_with_pretty_links_blacklist ];
    $this->filter_domain_blacklist(); //Get rid of user entered garbage to make sure out input is valid

    $plp_options->replace_keywords_in_comments = (int)isset($params[ $replace_keywords_in_comments ]);
    $plp_options->replace_keywords_in_feeds = (int)isset($params[ $replace_keywords_in_feeds ]);
    $plp_options->enable_link_to_disclosures = (int)isset($params[ $enable_link_to_disclosures ]);
    $plp_options->disclosures_link_url = $params[ $disclosures_link_url ];
    $plp_options->disclosures_link_text = stripslashes($params[ $disclosures_link_text ]);
    $plp_options->disclosures_link_position = $params[ $disclosures_link_position ];
    $plp_options->enable_keyword_link_disclosures = (int)isset($params[$enable_keyword_link_disclosures]);
    $plp_options->keyword_link_disclosure = $params[$keyword_link_disclosure];
    $plp_options->set_keyword_thresholds = (int)isset($params[ $set_keyword_thresholds ]);
    $plp_options->keywords_per_page = $params[ $keywords_per_page ];
    $plp_options->keyword_links_per_page = $params[ $keyword_links_per_page ];
    $plp_options->use_prettylink_url = (int)isset($params[ $use_prettylink_url ]);
    $plp_options->prettylink_url = $params[ $prettylink_url ];
    $plp_options->min_role = $params[ $minimum_access_role ];
    $plp_options->allow_public_link_creation = (int)isset($params[ $allow_public_link_creation ]);
    $plp_options->use_public_link_display_page = (int)isset($params[ $use_public_link_display_page ]);
    $plp_options->public_link_display_page = $params[ $public_link_display_page ];
    $prli_options->prettybar_image_url = stripslashes($_POST[ $prettybar_image_url ]);
    $prli_options->prettybar_background_image_url = stripslashes($_POST[ $prettybar_background_image_url ]);
    $prli_options->prettybar_color = stripslashes($_POST[ $prettybar_color ]);
    $prli_options->prettybar_text_color = stripslashes($_POST[ $prettybar_text_color ]);
    $prli_options->prettybar_link_color = stripslashes($_POST[ $prettybar_link_color ]);
    $prli_options->prettybar_hover_color = stripslashes($_POST[ $prettybar_hover_color ]);
    $prli_options->prettybar_visited_color = stripslashes($_POST[ $prettybar_visited_color ]);
    $prli_options->prettybar_show_title = (int)isset($_POST[ $prettybar_show_title ]);
    $prli_options->prettybar_show_description = (int)isset($_POST[ $prettybar_show_description ]);
    $prli_options->prettybar_show_share_links = (int)isset($_POST[ $prettybar_show_share_links ]);
    $prli_options->prettybar_show_target_url_link = (int)isset($_POST[ $prettybar_show_target_url_link ]);
    $prli_options->prettybar_title_limit = stripslashes($_POST[ $prettybar_title_limit ]);
    $prli_options->prettybar_desc_limit = stripslashes($_POST[ $prettybar_desc_limit ]);
    $prli_options->prettybar_link_limit = stripslashes($_POST[ $prettybar_link_limit ]);
    $plp_options->prettybar_hide_attrib_link = (int)isset($params[ $prettybar_hide_attrib_link ]);
    $plp_options->prettybar_attrib_url = $params[ $prettybar_attrib_url ];

    update_option('plp_index_keywords', isset($params['plp_index_keywords']));
  }

  //Filters the user entered garbage to make sure these are valid domains
  public function filter_domain_blacklist() {
    global $plp_options;

    $new_ops = '';
    $lines = preg_split('/[\r\n]+/', $plp_options->replace_urls_with_pretty_links_blacklist, -1, PREG_SPLIT_NO_EMPTY);

    if(!empty($lines)) {
      foreach($lines as $line) {
        if($domain = parse_url($line, PHP_URL_HOST)) {
          $scheme = parse_url($line, PHP_URL_SCHEME) . "://";
          $new_ops .= $scheme.$domain."\n";
        }
      }
    }

    $plp_options->replace_urls_with_pretty_links_blacklist = $new_ops;
  }

  public function store() {
    global $plp_options;

    // Save the posted value in the database
    $plp_options->store();
  }
} //End class
