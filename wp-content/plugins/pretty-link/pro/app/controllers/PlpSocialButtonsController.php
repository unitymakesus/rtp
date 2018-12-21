<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpSocialButtonsController extends PrliBaseController {
  public function load_hooks() {
    add_filter('the_content', array($this, 'add_social_buttons_to_content'), 1000); //WARNING - This priority must be higher than keyword replacements
    add_filter('get_the_excerpt', array($this, 'excerpt_remove_social_buttons'), 1);
    add_shortcode('social_buttons_bar', array($this,'social_buttons_bar'));
  }

  public function social_buttons_bar() {
    global $post, $plp_options, $wp_query;

    if(!isset($post) || !isset($post->ID)) { return ''; }

    $plp_post_options = PlpPostOptions::get_options($post->ID);
    $ac = $plp_options->autocreate_option($post->post_type);

    if(get_post_status($post->ID) != 'publish' || // Don't show until published
       $plp_post_options->hide_social_buttons || // Don't show if post is hidden
       (is_feed() && !$plp_options->social_buttons_show_in_feed) || // Only show in feed if option checked
       !$ac->enabled || !$ac->socbtns) // Only show if links enabled and social button
    { return ''; }

    $pretty_link_id = PrliUtils::get_prli_post_meta($post->ID,"_pretty-link",true);

    return PlpSocialButtonsHelper::get_social_buttons_bar($pretty_link_id);
  }

  // Puts a tweet this button on each post
  public function add_social_buttons_to_content($content) {
    global $plp_options;

    if($plp_options->social_buttons_placement == 'none') {
      return $content;
    }

    $social_buttons = $this->social_buttons_bar();

    if(!empty($social_buttons)) {
      if($plp_options->social_buttons_placement == 'bottom') {
        return "{$content}{$social_buttons}";
      }
      else if($plp_options->social_buttons_placement == 'top') {
        return "{$social_buttons}{$content}";
      }
      else if($plp_options->social_buttons_placement == 'top-and-bottom') {
        return "{$social_buttons}{$content}{$social_buttons}";
      }
    }
    else {
      return $content;
    }
  }

  public function excerpt_remove_social_buttons($excerpt) {
    if(!is_feed()) { remove_filter('the_content', array($this,'add_social_buttons_to_content')); }
    return $excerpt;
  }
}

// The template tag for social buttons
function the_social_buttons_bar() {
  $ctrl = new PlpSocialButtonsController();
  echo $this->social_buttons_bar();
}

