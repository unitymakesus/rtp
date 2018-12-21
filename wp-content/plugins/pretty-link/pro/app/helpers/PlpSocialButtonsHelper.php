<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpSocialButtonsHelper {
  public static function get_social_buttons_bar($pretty_link_id) {
    global $prli_blogurl, $plp_options, $prli_link, $prli_link_meta;

    $pretty_link = $prli_link->getOne($pretty_link_id);

    if(is_object($pretty_link)) {
      $shorturl = apply_filters(
        'prli_social_bar_url',
        $prli_blogurl.PrliUtils::get_permalink_pre_slug_uri().$pretty_link->slug,
        $pretty_link_id
      );
    }
    else {
      return '';
    }

    // If there's no short url then don't show the badge
    if(empty($shorturl)) { return ''; }

    $tweet_message = PlpTwitterHelper::get_twitter_status_message($shorturl,$pretty_link->name);
    $tweet_message = urlencode(trim(strip_tags($tweet_message)));

    $encoded_url = urlencode($shorturl);
    $encoded_title = urlencode($pretty_link->name);

    $patterns = array( '/\{\{encoded_url\}\}/', '/\{\{encoded_title\}\}/', '/\{\{tweet_message\}\}/' );
    $replacements = compact( 'encoded_url', 'encoded_title', 'tweet_message' );

    $show_bar = false;

    $social_buttons = apply_filters('prli_social_bar_obj', $plp_options->social_buttons, $pretty_link, $shorturl, $replacements);

    ob_start();
    ?>
    <ul class="prli-social-buttons">
    <?php

    foreach($social_buttons as $b) {
      if( $b['checked'] ) {
        $show_bar = true; // if we have even one button, we show the social bar
        $button_url = preg_replace( $patterns, $replacements, $b['url'] );
        ?>
          <li>
            <a class="pl-social-<?php echo $b['slug']; ?>-button" href="<?php echo $button_url; ?>" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
              <i class="<?php echo $b['icon']; ?>"> </i>
            </a>
          </li>
        <?php
      }
    }

    ?>
    </ul>
    <?php

    $social_buttons = $show_bar ? ob_get_clean() : '';

    return apply_filters('prli_social_bar_html', $social_buttons, $pretty_link, $shorturl, $replacements);
  }
}

