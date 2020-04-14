<?php
/**
 *  UABB Template Ajax.
 *
 * @since 1.16.1
 * @package Template Ajax
 */

/**
 * This class initializes UABB Template Ajax
 *
 * @class UABB_Template_Ajax
 */
class UABB_Template_Ajax {

	/**
	 * Initializes actions.
	 *
	 * @since 1.16.1
	 * @return void
	 */
	public static function init() {
		add_action( 'wp_ajax_uabb_get_saved_templates', __CLASS__ . '::get_saved_templates' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_templates', __CLASS__ . '::get_saved_templates' );

		add_action( 'wp_ajax_uabb_get_saved_cf7', __CLASS__ . '::uabb_get_saved_cf7' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_cf7', __CLASS__ . '::uabb_get_saved_cf7' );

		add_action( 'wp_ajax_uabb_get_saved_gravity', __CLASS__ . '::uabb_get_saved_gravity' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_gravity', __CLASS__ . '::uabb_get_saved_gravity' );

		add_action( 'wp_ajax_uabb_get_saved_wpform', __CLASS__ . '::uabb_get_saved_wpform' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_wpform', __CLASS__ . '::uabb_get_saved_wpform' );

		add_action( 'wp_ajax_uabb_get_saved_caf', __CLASS__ . '::uabb_get_saved_caf' );
	}
	/**
	 * Get saved templates.
	 *
	 * @since 1.16.1
	 */
	public static function get_saved_templates() {

		check_ajax_referer( 'uabb-module-nonce', 'nonce' );

			$response = array(
				'success' => false,
				'data'    => array(),
			);

			$args = array(
				'post_type'      => 'fl-builder-template',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
			);

			if ( isset( $_POST['type'] ) && ! empty( $_POST['type'] ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'fl-builder-template-type',
						'field'    => 'slug',
						'terms'    => $_POST['type'],
					),
				);
			}

			$posts = get_posts( $args );

			$options = '';

			if ( count( $posts ) ) {
				foreach ( $posts as $post ) {
					$options .= '<option value="' . $post->ID . '">' . $post->post_title . '</option>';
				}

				$response = array(
					'success' => true,
					'data'    => $options,
				);
			} else {
				$response = array(
					'success' => true,
					'data'    => '<option value="" disabled>' . __( 'No templates found!', 'uabb' ) . '</option>',
				);
			}

			wp_send_json( $response );
	}
	/**
	 * Get saved CF7 Form.
	 *
	 * @since 1.23.0
	 */
	public static function uabb_get_saved_cf7() {

		check_ajax_referer( 'uabb-cf7-nonce', 'nonce' );

		$field_options = array();

		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$options = '';
			$args    = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			);
			$forms   = get_posts( $args );

			if ( count( $forms ) ) {
				foreach ( $forms as $form ) {
					$options .= '<option value="' . $form->ID . '">' . $form->post_title . '</option>';
				}

				$response = array(
					'success' => true,
					'data'    => $options,
				);

			} else {
				$response = array(
					'success' => true,
					'data'    => '<option value="" disabled>' . __( 'You have not added any Contact Form 7 yet.', 'uabb' ) . '</option>',
				);
			}
			wp_send_json( $response );
		}
	}
	/**
	 * Get saved Gravity Form.
	 *
	 * @since 1.23.0
	 */
	public static function uabb_get_saved_gravity() {

		check_ajax_referer( 'uabb-gf-nonce', 'nonce' );

		$field_options = array();

		global $wpdb;

		if ( class_exists( 'GFForms' ) ) {

			$options = '';

			$form_table_name = GFFormsModel::get_form_table_name();

			$id = 0;

			$forms = $wpdb->get_results( $wpdb->prepare( 'SELECT id, title FROM ' . $form_table_name . ' WHERE id != %d', $id ), object );// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
			if ( count( $forms ) ) {

				foreach ( $forms as $form ) {

					$field_options[ $form->id ] = $form->title;

					$options .= '<option value="' . $form->id . '">' . $form->title . '</option>';
				}
				$response = array(
					'success' => true,
					'data'    => $options,
				);
			} else {
				$response = array(
					'success' => true,
					'data'    => '<option value="" disabled>' . __( 'You have not added any Gravity Forms yet.', 'uabb' ) . '</option>',
				);
			}
			wp_send_json( $response );
		}
	}
	/**
	 * Get saved Wpform Form.
	 *
	 * @since 1.23.0
	 */
	public static function uabb_get_saved_wpform() {

		check_ajax_referer( 'uabb-wpf-nonce', 'nonce' );

		$field_options = array();

		if ( class_exists( 'WPForms_Pro' ) || class_exists( 'WPForms_Lite' ) ) {
			$options            = '';
			$args               = array(
				'post_type'      => 'wpforms',
				'posts_per_page' => -1,
			);
			$forms              = get_posts( $args );
			$field_options['0'] = 'Select';

			if ( count( $forms ) ) {

				foreach ( $forms as $form ) {

					$options .= '<option value="' . $form->ID . '">' . $form->post_title . '</option>';
				}
				$response = array(
					'success' => true,
					'data'    => $options,
				);
			} else {

				$response = array(
					'success' => true,
					'data'    => '<option value="" disabled>' . __( 'You have not added any WPForms yet.', 'uabb' ) . '</option>',
				);
			}
			wp_send_json( $response );
		}
	}
	/**
	 * Get saved Caldera Form.
	 *
	 * @since 1.26.0
	 */
	public static function uabb_get_saved_caf() {

		check_ajax_referer( 'uabb-caf-nonce', 'nonce' );
		$options = array();

		if ( class_exists( 'Caldera_Forms_Forms' ) ) {

			$forms         = \Caldera_Forms_Forms::get_forms( true );
			$options['0']  = 'Select';
			$field_options = '';
			if ( ! empty( $forms ) ) {
				foreach ( $forms as $form ) {
					if ( is_array( $form ) && ! empty( $form['ID'] ) && ! empty( $form['name'] ) ) {
						$options[ $form['ID'] ] = $form['name'];
					}
				}
			}
			if ( count( $options ) ) {

				foreach ( $options as $form_id => $form_name ) {

					$field_options .= '<option value="' . $form_id . '">' . $form_name . '</option>';
				}
				$response = array(
					'success' => true,
					'data'    => $field_options,
				);
			} else {

				$response = array(
					'success' => true,
					'data'    => '<option value="" disabled>' . __( 'You have not added any Caldera Forms yet.', 'uabb' ) . '</option>',
				);
			}
			wp_send_json( $response );
		}
	}

}
UABB_Template_Ajax::init();
