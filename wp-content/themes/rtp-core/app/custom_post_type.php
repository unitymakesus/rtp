<?php

namespace App;

function create_post_type() {
  $argsPeople = array(
    'labels' => array(
				'name' => 'People',
				'singular_name' => 'Person',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Person',
				'edit' => 'Edit',
				'edit_item' => 'Edit Person',
				'new_item' => 'New Person',
				'view_item' => 'View Person',
				'search_items' => 'Search People',
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
  register_post_type( 'rtp-people', $argsPeople );
}
add_action( 'init', __NAMESPACE__.'\\create_post_type' );

function create_taxonomies() {

	$argsPeopleCategories = array(
		'labels' => array(
			'name' => __( 'Teams' ),
			'singular_name' => __( 'Team' )
		),
		'publicly_queryable' => true,
		'show_ui' => true,
    'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'hierarchical' => true,
		'rewrite' => false
	);
	register_taxonomy('rtp-team', 'rtp-people', $argsPeopleCategories);

}
add_action( 'init', __NAMESPACE__.'\\create_taxonomies' );

/**
 * Add custom capabilities for MEC plugin
 */
function change_capabilities( $args, $post_type ){

  if ( 'mec-events' == $post_type ) {
    $args['capabilities'] = array(
      'edit_post' => 'edit_mecevent',
      'edit_posts' => 'edit_mecevents',
      'edit_others_posts' => 'edit_other_mecevents',
      'publish_posts' => 'publish_mecevents',
      'read_post' => 'read_mecevent',
      'read_private_posts' => 'read_private_mecevents',
      'delete_post' => 'delete_mecevent'
    );
  }

  return $args;
}
add_filter( 'register_post_type_args', __NAMESPACE__ . '\\change_capabilities' , 10, 2 );

/**
 * Custom capability for distributor plugin
 */
apply_filters( 'dt_push_capabilities', 'distribute_content' );
