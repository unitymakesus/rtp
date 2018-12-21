<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

// DEPRECATED
class PlpTwitterController extends PrliBaseController {
  public function load_hooks() {
    // Gracefully deprecated shortcode
    add_shortcode('tweetbadge', array($this,'the_tweetbadge'));
  }
}

// Template Tag for Tweet Badge
function the_tweetbadge() {
  // No longer supported
}

// Template Tag for Tweet Comments
// Gracefully ignore comments if this tag is in use
function the_tweet_comments() {
  // No longer supported
}

