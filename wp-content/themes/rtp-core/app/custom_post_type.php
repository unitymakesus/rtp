<?php

namespace App;

function create_post_type() {
  $argsTeam = array(
    'labels' => array(
				'name' => 'Team',
				'singular_name' => 'Team Member',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Team Member',
				'edit' => 'Edit',
				'edit_item' => 'Edit Team Member',
				'new_item' => 'New Team Member',
				'view_item' => 'View Team Member',
				'search_items' => 'Search Team',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
    ),
    'public' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_nav_menus' => false,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-groups',
    'capability_type' => 'page',
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'revisions',
      'page-attributes',
      'thumbnail'
    ),
    'has_archive' => false,
    'rewrite' => array(
      'slug' => 'bio'
    )
  );
  register_post_type( 'rtp-team', $argsTeam );
}
add_action( 'init', __NAMESPACE__.'\\create_post_type' );

function create_taxonomies() {

	$argsTeamCategories = array(
		'labels' => array(
			'name' => __( 'Types' ),
			'singular_name' => __( 'Type' )
		),
		'publicly_queryable' => true,
		'show_ui' => true,
    'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'hierarchical' => true,
		'rewrite' => false
	);
	register_taxonomy('rtp-team-category', 'rtp-team', $argsTeamCategories);

}
add_action( 'init', __NAMESPACE__.'\\create_taxonomies' );
