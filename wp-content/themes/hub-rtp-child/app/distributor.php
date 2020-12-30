<?php

namespace App;

/**
 * Set original date as the post date for distributed content
 */
add_filter('dt_push_post_args', function ($new_post_args, $post, $args) {
    $new_post_args['post_date'] = $post->post_date;
    return $new_post_args;
}, 10, 3);

/**
 * Remove draft option for distributing posts
 */
add_filter('dt_allow_as_draft_distribute', function ($as_draft, $connection, $post) {
    return false;
}, 10, 3);

/**
 * Redirect distributed posts to the original post
 */
add_filter('template_redirect', function () {
    global $post;

    // Don't do this on blog, category, search, or calendar pages
    if (!is_home() && !is_archive() && !is_search() && !is_page('calendar')) {
        $orig_post_url = get_post_meta($post->ID, 'dt_original_post_url', true);
        $orig_deleted = get_post_meta($post->ID, 'dt_original_post_deleted', true);

        if (!empty($orig_post_url) && $orig_deleted !== 1) {
            wp_redirect($orig_post_url, '301');
            die;
        }
    }
});
