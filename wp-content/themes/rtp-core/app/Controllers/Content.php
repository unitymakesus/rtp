<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Content extends Controller
{

  public static function siteBadge() {
    $postID = get_the_ID();
    $siteID = get_post_meta($postID, 'dt_original_blog_id', true);
    if ($siteID == 1) {
      $siteName = 'RTP';
    } else {
      $siteData = get_blog_details($siteID, true);
      $siteName = $siteData->blogname;
    }
    return $siteName;
  }

}
