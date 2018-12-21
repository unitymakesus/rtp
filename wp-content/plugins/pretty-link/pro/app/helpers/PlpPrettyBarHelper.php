<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

// PrettyBar stuff here of course
class PlpPrettyBarHelper {
  public static function render_prettybar($slug) {
    global $prli_blogurl, $prli_link, $prli_options, $prli_blogname, $prli_blogdescription, $target_url;

    if($link = $prli_link->getOneFromSlug( $slug )) {
      $bar_image = $prli_options->prettybar_image_url;
      $bar_background_image = $prli_options->prettybar_background_image_url;
      $bar_color = $prli_options->prettybar_color;
      $bar_text_color = $prli_options->prettybar_text_color;
      $bar_link_color = $prli_options->prettybar_link_color;
      $bar_visited_color = $prli_options->prettybar_visited_color;
      $bar_hover_color = $prli_options->prettybar_hover_color;
      $bar_show_title = $prli_options->prettybar_show_title;
      $bar_show_description = $prli_options->prettybar_show_description;
      $bar_show_share_links = $prli_options->prettybar_show_share_links;
      $bar_show_target_url_link = $prli_options->prettybar_show_target_url_link;
      $bar_title_limit = (int)$prli_options->prettybar_title_limit;
      $bar_desc_limit = (int)$prli_options->prettybar_desc_limit;
      $bar_link_limit = (int)$prli_options->prettybar_link_limit;

      $target_url = $link->url;

      $shortened_title = stripslashes(substr($prli_blogname,0,$bar_title_limit));
      $shortened_desc  = stripslashes(substr($prli_blogdescription,0,$bar_desc_limit));
      $shortened_link  = stripslashes(substr($target_url,0,$bar_link_limit));

      if(strlen($prli_blogname) > $bar_title_limit) {
        $shortened_title .= "...";
      }

      if(strlen($prli_blogdescription) > $bar_desc_limit) {
        $shortened_desc .= "...";
      }

      if(strlen($target_url) > $bar_link_limit) {
        $shortened_link .= "...";
      }

      require(PLP_VIEWS_PATH . '/links/prettybar.php');
    }
  }
}

