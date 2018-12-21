<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

// PrettyBar stuff here of course
class PlpPrettyBarController extends PrliBaseController {
  public $field_names;

  public function __construct() {
    $this->field_names = array(
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
      'prettybar_link_limit' => 'prli_prettybar_link_limit'
    );
  }

  public function load_hooks() {
    add_filter('prli-display-attrib-link', array($this,'display_attrib_link'));
    add_filter('prli-validate-options', array($this,'validate'));
    add_action('prli-store-options', array($this,'update'));
  }

  public function display_attrib_link($link_html) {
    global $plp_options;

    if( $plp_options->prettybar_hide_attrib_link == 1 ) { return ''; }

    if( !empty($plp_options->prettybar_attrib_url) ) {
      $link_html = preg_replace("#https://prettylinks.com/plp/pretty-bar/powered-by#",$plp_options->prettybar_attrib_url,$link_html);
    }

    return $link_html;
  }

  public function validate($errors) {
    global $prli_options;

    extract($this->field_names);

    if( !empty($_POST[$prettybar_image_url]) && !preg_match('/^http.?:\/\/.*\..*$/', $_POST[$prettybar_image_url] ) ) {
      $errors[] = __("Logo Image URL must be a correctly formatted URL", 'pretty-link');
    }

    if( !empty($_POST[$prettybar_background_image_url]) && !preg_match('/^http.?:\/\/.*\..*$/', $_POST[$prettybar_background_image_url] ) ) {
      $errors[] = __("Background Image URL must be a correctly formatted URL", 'pretty-link');
    }

    $color_pattern = "/^#?[0-9a-fA-F]{6}$/";

    if( !empty($_POST[ $prettybar_color ]) && !preg_match( $color_pattern, $_POST[ $prettybar_color ] ) ) {
      $errors[] = __("PrettyBar Background Color must be an actual RGB Value", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_text_color ]) && !preg_match( $color_pattern, $_POST[ $prettybar_text_color ] ) ) {
      $errors[] = __("PrettyBar Text Color must be an actual RGB Value", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_link_color ]) && !preg_match( $color_pattern, $_POST[ $prettybar_link_color ] ) ) {
      $errors[] = __("PrettyBar Link Color must be an actual RGB Value", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_hover_color ]) && !preg_match( $color_pattern, $_POST[ $prettybar_hover_color ] ) ) {
      $errors[] = __("PrettyBar Hover Color must be an actual RGB Value", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_visited_color ]) && !preg_match( $color_pattern, $_POST[ $prettybar_visited_color ] ) ) {
      $errors[] = __("PrettyBar Hover Color must be an actual RGB Value", 'pretty-link');
    }

    if( empty($_POST[ $prettybar_title_limit ]) ) {
      $errors[] = __("PrettyBar Title Character Limit must not be blank", 'pretty-link');
    }

    if( empty($_POST[ $prettybar_desc_limit ]) ) {
      $errors[] = __("PrettyBar Description Character Limit must not be blank", 'pretty-link');
    }

    if( empty($_POST[ $prettybar_link_limit ]) ) {
      $errors[] = __("PrettyBar Link Character Limit must not be blank", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_title_limit ]) && !preg_match( "#^[0-9]*$#", $_POST[ $prettybar_title_limit ] ) ) {
      $errors[] = __("PrettyBar Title Character Limit must be a number", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_desc_limit ]) && !preg_match( "#^[0-9]*$#", $_POST[ $prettybar_desc_limit ] ) ) {
      $errors[] = __("PrettyBar Description Character Limit must be a number", 'pretty-link');
    }

    if( !empty($_POST[ $prettybar_link_limit ]) && !preg_match( "#^[0-9]*$#", $_POST[ $prettybar_link_limit ] ) ) {
      $errors[] = __("PrettyBar Link Character Limit must be a number", 'pretty-link');
    }

    return $errors;
  }

  public function update($errors) {
    global $prli_options;

    extract($this->field_names);

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
  }
}

