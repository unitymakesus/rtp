<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpPostOptions {
  public $requested_slug;

  public $hide_social_buttons;
  public $disable_replacements;

  public function __construct($options_array = array()) {
    // Set values from array
    foreach($options_array as $key => $value)
      $this->{$key} = $value;

    $this->set_default_options();
  }

  public function set_default_options() {
    if(!isset($this->requested_slug))
      $this->requested_slug = '';

    if(!isset($this->hide_social_buttons))
      $this->hide_social_buttons = 0;

    if(!isset($this->disable_replacements))
      $this->disable_replacements = 0;
  }

  public function validate() {
    global $prli_utils;
    $errors = array();

    if(!empty($this->requested_slug) and !$prli_utils->slugIsAvailable($this->requested_slug) )
      $errors[] = __("This pretty link slug is already taken, please choose a different one", 'pretty-link');

    return $errors;
  }

  // Just here as an alias for reverse compatibility
  public function get_stored_object($post_id) {
    return PlpOptions::get_options($post_id);
  }

  public function store($post_id) {
    if(!empty($post_id) and $post_id) {
      $storage_array = (array)$this;
      PrliUtils::update_prli_post_meta($post_id, '_prlipro-post-options', $storage_array);
    }
  }

  public static function get_options($post_id) {
    if(!empty($post_id) and $post_id) {
      $plp_post_options = PrliUtils::get_prli_post_meta($post_id,"_prlipro-post-options",true);

      if($plp_post_options) {
        if(is_string($plp_post_options))
          $plp_post_options = unserialize($plp_post_options);

        if(is_a($plp_post_options,'PlpPostOptions')) {
          $plp_post_options->set_default_options();
          $plp_post_options->store($post_id); // store will convert this back into an array
        }
        else if(is_array($plp_post_options))
          $plp_post_options = new PlpPostOptions($plp_post_options);
        else
          $plp_post_options = new PlpPostOptions();
      }
      else
        $plp_post_options = new PlpPostOptions();
    }
    else
      $plp_post_options = new PlpPostOptions();

    return $plp_post_options;
  }
}
