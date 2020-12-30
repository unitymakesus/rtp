<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public static function globalSiteAnnouncement() {
        $announcement = '';

        /**
         * TODO: Re-enable when migrated to a multisite setup.
         */
        // switch_to_blog(1);
        // if (get_field('global_site_announcement_enable', 'option')) {
        //     $announcement = get_field('global_site_announcement', 'option');
        // }
        // restore_current_blog();
        // $announcement = __('COVID-19 CLOSURES AND RESOURCES', 'sage');

        return $announcement;
    }

    public static function localSiteAnnouncement() {
        $announcement = '';

        if (get_field('local_site_announcement_enable', 'option')) {
            $announcement = get_field('local_site_announcement', 'option');
        }

        return $announcement;
    }
}
