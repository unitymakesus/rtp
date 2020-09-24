<?php

namespace App;


add_action('init', function() {
    /**
     * Register custom post types.
     */
    $post_types = [
        [
        'slug'        => 'vendor',
        'single_name' => __('Vendor', 'sage'),
        'plural_name' => __('Vendors', 'sage'),
        'menu_icon'   => 'dashicons-location',
        'has_archive' => false,
        'rewrite'     => ['slug' => 'vendors'],
        ],
    ];

    if (empty($post_types)) {
        return;
    }

    /**
     * Loop through post types and register each one.
     */
    foreach ($post_types as $type) {
        $labels = [
            'name'                => $type['plural_name'],
            'singular_name'       => $type['single_name'],
            'menu_name'           => $type['plural_name'],
            'name_admin_bar'      => $type['single_name'],
            'parent_item_colon'   => 'Parent '. $type['single_name'] .':',
            'all_items'           => 'All '. $type['plural_name'],
            'add_new_item'        => 'Add New '. $type['single_name'],
            'add_new'             => 'Add New',
            'new_item'            => 'New Item',
            'edit_item'           => 'Edit '. $type['single_name'],
            'update_item'         => 'Update Item',
            'view_item'           => 'View Item',
            'search_items'        => 'Search Item',
            'not_found'           => 'Not found',
            'not_found_in_trash'  => 'Not found in Trash',
        ];

        /**
         * Use default args if none are provided.
         */
        $supports = $type['supports'] ?? ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'];
        $hierarchical = $type['hierarchical'] ?? false;
        $public = $type['public'] ?? true;
        $show_ui = $type['show_ui'] ?? true;
        $show_in_menu = $type['show_in_menu'] ?? true;
        $show_in_rest = $type['show_in_rest'] ?? false;
        $menu_position = $type['menu_position'] ?? 5;
        $menu_icon = $type['menu_icon'] ?? 'dashicons-admin-generic';
        $show_in_admin_bar = $type['show_in_admin_bar'] ?? true;
        $show_in_nav_menus = $type['show_in_nav_menus'] ?? true;
        $can_export = $type['can_export'] ?? true;
        $has_archive = $type['has_archive'] ?? true;
        $exclude_from_search = $type['exclude_from_search'] ?? false;
        $publicly_queryable = $type['publicly_queryable'] ?? true;
        $capability_type = $type['capability_type'] ?? 'post';
        $map_meta_cap = $type['map_meta_cap'] ?? null;
        $rewrite = $type['rewrite'] ?? ['slug' => $type['slug']];
        $taxonomies = $type['taxonomies'] ?? [];
        $rest_base = $type['rest_base'] ?? false;


        /**
         * Register!
         */
        register_post_type($type['slug'], [
            'labels'              => $labels,
            'supports'            => $supports,
            'hierarchical'        => $hierarchical,
            'public'              => $public,
            'show_ui'             => $show_ui,
            'show_in_menu'        => $show_in_menu,
            'show_in_rest'        => $show_in_rest,
            'menu_position'       => $menu_position,
            'menu_icon'           => $menu_icon,
            'show_in_admin_bar'   => $show_in_admin_bar,
            'show_in_nav_menus'   => $show_in_nav_menus,
            'can_export'          => $can_export,
            'has_archive'         => $has_archive,
            'exclude_from_search' => $exclude_from_search,
            'publicly_queryable'  => $publicly_queryable,
            'capability_type'     => $capability_type,
            'map_meta_cap'        => $map_meta_cap,
            'rewrite'             => $rewrite,
            'taxonomies'          => $taxonomies,
            'rest_base'           => $rest_base,
        ]);
    }

    /**
	 * Add custom taxonomies here.
	 */
    $taxis = [
        [
            'slug'        => 'vendor_category',
            'single_name' => __('Category', 'sage'),
            'plural_name' => __('Categories', 'sage'),
            'object_type' => 'vendor',
            'rewrite'     => ['slug' => 'vendor-category'],
        ],
        [
            'slug'        => 'vendor_prompt_question',
            'single_name' => __('Prompt Question', 'sage'),
            'plural_name' => __('Prompt Questions', 'sage'),
            'object_type' => 'vendor',
            'rewrite'     => ['slug' => 'vendor-prompt-question'],
        ],
    ];

    if (empty($taxis)) {
        return;
    }

    /**
     * Loop through taxonomies and register each one.
     */
    foreach ($taxis as $taxi) {
        $labels = [
            'name'              => $taxi['plural_name'],
            'singular_name'     => $taxi['single_name'],
            'search_items'      => 'Search '. $taxi['plural_name'],
            'all_items'         => 'All '. $taxi['plural_name'],
            'parent_item'       => 'Parent '. $taxi['single_name'],
            'parent_item_colon' => 'Parent '. $taxi['single_name'] .':',
            'edit_item'         => 'Edit '. $taxi['single_name'],
            'update_item'       => 'Update '. $taxi['single_name'],
            'view_item'         => 'View '. $taxi['single_name'],
            'add_new_item'      => 'Add New '. $taxi['single_name'],
            'new_item_name'     => 'New '. $taxi['single_name'] .' Name',
            'menu_name'         => $taxi['plural_name'],
            'not_found'         => 'No ' . strtolower($taxi['plural_name']) . ' found.'
        ];

        /**
         * Use default args if none are provided.
         */
        $hierarchical = $taxi['hierarchical'] ?? true;
        $public = $taxi['public'] ?? true;
        $show_ui = $taxi['show_ui'] ?? true;
        $show_admin_column = $taxi['show_admin_column'] ?? true;
        $query_var = $taxi['query_var'] ?? true;
        $rewrite = $taxi['rewrite'] ?? ['slug' => $taxi['slug']];
        $show_in_menu = $taxi['show_in_menu'] ?? true;
        $meta_box_cb = $taxi['meta_box_cb'] ?? null;

        /**
         * Register taxonomy.
         */
        register_taxonomy($taxi['slug'], $taxi['object_type'], [
            'hierarchical'      => $hierarchical,
            'public'            => $public,
            'labels'            => $labels,
            'show_ui'           => $show_ui,
            'show_admin_column' => $show_admin_column,
            'query_var'         => $query_var,
            'rewrite'           => $rewrite,
            'show_in_menu'      => $show_in_menu,
            'meta_box_cb'       => $meta_box_cb,
        ]);
    }
});
