<?php
/**
 *  UABB WP Forms Styler Module file
 *
 *  @package UABBWP Form Styler Module
 */

if ( ! function_exists( 'uabb_wpforms_titles' ) ) {

	/**
	 * Function to fetch Wp form
	 *
	 * @since
	 * @method uabb_wpforms_titles
	 */
	function uabb_wpforms_titles() {
		$field_options = array();

		if ( class_exists( 'WPForms_Pro' ) || class_exists( 'WPForms_Lite' ) ) {

			$args               = array(
				'post_type'      => 'wpforms',
				'posts_per_page' => -1,
			);
			$forms              = get_posts( $args );
			$field_options['0'] = 'Select';

			if ( $forms ) {
				foreach ( $forms as $form ) {
					$field_options[ $form->ID ] = $form->post_title;
				}
			}
		}

		if ( empty( $field_options ) ) {
			$field_options = array(
				'-1' => __( 'You have not added any WPForms yet.', 'uabb' ),
			);
		}

		return $field_options;
	}
	/**
	 * Function to get the form ID
	 *
	 * @since 0.0.1
	 * @method uabb_cf7_get_form_id
	 */
	function uabb_wpf_get_form_id() {
		if ( class_exists( 'WPForms_Pro' ) || class_exists( 'WPForms_Lite' ) ) {
			$args  = array(
				'post_type'      => 'wpforms',
				'posts_per_page' => -1,
			);
			$forms = get_posts( $args );

			if ( $forms ) {
				foreach ( $forms as $form ) {
					return $form->ID;
				}
			}
		}

		return -1;
	}
}
