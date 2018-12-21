<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpTwitterHelper {
  public static function get_twitter_status_message($pretty_link_url, $pretty_link_name, $tweet_format="{%title%} {%url%}") {
    global $plp_options;

    //ADDED BY PAUL 1.5.5 - fix for $29.99 being in post title
    $pretty_link_name = str_replace("$", "%24", $pretty_link_name);

    $tweet_message = preg_replace("#\{\%title\%\}#", stripslashes($pretty_link_name), $tweet_format);
    $tweet_message = preg_replace("#\{\%url\%\}#", $pretty_link_url, $tweet_message);

    // 120 to leave room for retweeting a 140 char tweet
    if(strlen($tweet_message) > 120) {
      $non_title_size = strlen($tweet_message) - strlen($pretty_link_name);
      $title_size = 120 - $non_title_size;
      $link_title = substr($pretty_link_name, 0, $title_size);
      $tweet_message = preg_replace("#\{\%title\%\}#", stripslashes($link_title), $tweet_format);
      $tweet_message = preg_replace("#\{\%url\%\}#", $pretty_link_url, $tweet_message);
    }

    return $tweet_message;
  }
}

