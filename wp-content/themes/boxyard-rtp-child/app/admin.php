<?php

namespace App;

/**
 * ACF Local JSON
 * @source https://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/save_json', function () {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    if (is_child_theme()) {
        $paths[] = get_template_directory() . '/acf-json';
    }

    return $paths;
});

/**
 * ACF Options
 * @source https://www.advancedcustomfields.com/resources/acf_add_options_page/
 */
add_action('acf/init', function () {
    if ( function_exists('acf_add_options_page') ) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug'  => 'theme-options-settings',
            'capability' => 'manage_options',
            'redirect'   => false,
        ]);
    }
});

/**
 * Delete the map directory transient if its ACF field is modified.
 */
add_filter('acf/update_value/name=vendor_map_suites', function ($value, $post_id, $field) {
    delete_transient('map_directory_index');

    return $value;
}, 10, 3);

/**
 * Delete the map directory transient if a vendor is modified.
 */
add_action('save_post_vendor', function ($post_id, $post, $update) {
    delete_transient('map_directory_index');
}, 10, 3);

/**
 * Only show published items in Post Object fields.
 */
add_filter('acf/fields/post_object/query/', function ($args, $field, $post_id) {
    $args['post_status'] = ['publish'];

    return $args;
}, 10, 3);

/**
 * Allow "unfiltered_html" for Administrators and Editors in Beaver Builder.
 *
 * @source https://docs.wpbeaverbuilder.com/beaver-builder/troubleshooting/common-issues/error-settings-not-saved/
 */
add_filter('fl_builder_ui_js_config', function ($config) {
    $user = wp_get_current_user();
    $role = $user->roles[0];
    if ($role == 'administrator' || $role == 'editor') {
        $config['userCaps']['unfiltered_html'] = true;
    }

    return $config;
}, 10, 1);
