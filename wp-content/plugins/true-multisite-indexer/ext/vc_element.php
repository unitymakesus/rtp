<?php

// if no class WPBakeryShortCode, do nothing, it means that Visual Composer is not enabled
if( class_exists( 'WPBakeryShortCode' ) && !class_exists( 'vcMishaMiltisitePosts' ) ) {

class vcMishaMiltisitePosts extends WPBakeryShortCode {

	function __construct() {

		// this function is for UI
		add_action( 'init', array( $this, 'vc_multisite_mapping' ) );

		// shortcode name should match the base parameter of vc_map() function
		add_shortcode( 'vc_misha_multisite', array( $this, 'vc_multisite_widget' ) );

	}

	// Element UI
	public function vc_multisite_mapping() {

		// Do nothing if VComposer is not enabled, we've already checked this but better safe than sorry :D
		if ( !defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// parameters of the block
		vc_map(

			array(
				'name' => 'Multisite Posts',
				'base' => 'vc_misha_multisite', // shortcode name as well
				'description' => 'Posts from specific blogs of your Network.',
				'category' => __('Content'), // you can use any custom category name
				'icon' => 'icon-wpb-wp', // we can set here the full URL of the image as well
				'params' => array(

					// first tab - General
					array(
						'type' => 'textfield', // types: wpbakery.atlassian.net/wiki/spaces/VC/pages/524332/vc+map#vc_map()-Availabletypevalues
						'heading' => __( 'Widget title', 'js_composer' ),
						'param_name' => 'widget_title',
						'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
						'group' => 'General',
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Number of posts', 'js_composer' ),
						'description' => __( 'Enter number of posts to display.', 'js_composer' ),
						'param_name' => 'number',
						'value' => get_option('posts_per_page'),
						'admin_label' => true,
						'group' => 'General',
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Display post date?', 'js_composer' ),
						'param_name' => 'show_date',
						'value' => array( __( 'Yes', 'js_composer' ) => true ),
						'description' => __( 'If checked, date will be displayed.', 'js_composer' ),
						'group' => 'General',
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
						'group' => 'General',
					),

					// second tab - Featured Image
					array(
						'type' => 'checkbox',
						'heading' => __( 'Display featured image?', 'js_composer' ),
						'param_name' => 'show_featured',
						'value' => array( __( 'Yes', 'js_composer' ) => true ),
						'description' => 'If checked, the featured image will be displayed.',
						'group' => 'Featured Image',
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Featured Image Size',
						'param_name' => 'featured_size',
						'description' => 'Select one of the registered image sizes.',
						'value' => get_intermediate_image_sizes(), // array of registered image sizes
						'group' => 'Featured Image',
					),

					// third tab - Blogs
					array(
						'type' => 'exploded_textarea',
						'heading' => 'Blog IDs',
						'param_name' => 'blog_id',
						'description' => 'Place each blog ID on a seperate line. Leave empty to show posts from all blogs.',
						'group' => 'Blogs',
					),

					// last tab - Post Types
					array(
						'type' => 'exploded_textarea',
						'heading' => 'Post Types',
						'param_name' => 'post_type',
						'description' => 'Place each post type on a seperate line. Default: post',
						'value' => 'post',
						'group' => 'Post Types',
					)

				)
			)
		);

	}

	// HTML of our widget
	public function vc_multisite_widget( $atts ) {

		// Let's compare parameters with defaults
		$atts = shortcode_atts( array(
			'blog_id' => '',
			'widget_title'   => '',
			'post_type'   => '',
			'number'   => get_option('posts_per_page'),
			'show_date' => false,
			'show_featured' => false,
			'featured_size' => '',
			'el_class' => ''
		), $atts );

		// Fill $html var with the content
		$html = '<div class="vc_multisite_posts wpb_content_element ' . $atts['el_class'] . '"><div class="widget widget_recent_entries">';

		if( $atts['widget_title'] ) {
			$html .= '<h2 class="widgettitle">' . $atts['widget_title'] . '</h2>';
		}

		$args = array(
			'posts_per_page' => $atts['number']
		);

		// apply blog IDs
		if( $atts['blog_id'] ) {
			$args['blog_id'] = explode(',',$atts['blog_id']);
		}

		// apply post types
		if( $atts['post_type'] ) {
			$args['post_type'] = explode(',',$atts['post_type']);
		}

		// just remind you, Network_Query is the part of this plugin https://rudrastyh.com/plugins/get-posts-from-all-blogs-in-multisite-network
		$q = new Network_Query( $args );

		if( $q->have_posts() ) :
			$html .= '<ul>';

			while( $q->have_posts() ) : $q->the_post();

				switch_to_blog( $q->post->BLOG_ID );
				$html .= '<li>';

				// if featured image is allowed
				if( $atts['show_featured'] == true && has_post_thumbnail( $q->post->ID ) ) {
					$html .= '<a style="border:0!important;margin-bottom: 8px;display: block;" href="' . get_permalink( $q->post->ID ) . '">' . get_the_post_thumbnail($q->post->ID, $atts['featured_size']) . '</a>';
				}

				$html .= '<a href="' . get_permalink( $q->post->ID ) . '">' . $q->post->post_title . '</a>';

				// if the post date should be displayed
				if( $atts['show_date'] == true ) {
					$html .= '<span class="post-date">' . get_the_date('', $q->post->ID) . '</span>';
				}

				$html .= '</li>';
				restore_current_blog();

			endwhile;

			$html .= '</ul>';
		else:
			$html .= '<p>No posts found</p>';
		endif;

		$html .= '</div></div>';

		return $html;

	}

}

new vcMishaMiltisitePosts();

}
