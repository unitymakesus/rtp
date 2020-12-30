<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Content extends Controller
{
    public static function siteBadge() {
        $post_id = get_the_ID();
        $site_id = get_post_meta($post_id, 'dt_original_blog_id', true);

        if (empty($site_id)) {
            $site_id = get_current_blog_id();
        }

        if ($site_id == 1) {
            $site_name = 'RTP';
        } else {
            $site_data = get_blog_details($site_id, true);
            $site_name = $site_data->blogname;
        }

        return $site_name;
    }
}
