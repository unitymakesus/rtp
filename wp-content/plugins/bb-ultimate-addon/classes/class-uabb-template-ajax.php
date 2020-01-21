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
	static public function init() {
		add_action( 'wp_ajax_uabb_get_saved_templates', __CLASS__ . '::get_saved_templates' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_templates', __CLASS__ . '::get_saved_templates' );

		add_action( 'wp_ajax_uabb_get_saved_cf7', __CLASS__ . '::uabb_get_saved_cf7' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_cf7', __CLASS__ . '::uabb_get_saved_cf7' );

		add_action( 'wp_ajax_uabb_get_saved_gravity', __CLASS__ . '::uabb_get_saved_gravity' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_gravity', __CLASS__ . '::uabb_get_saved_gravity' );

		add_action( 'wp_ajax_uabb_get_saved_wpform', __CLASS__ . '::uabb_get_saved_wpform' );
		add_action( 'wp_ajax_nopriv_uabb_get_saved_wpform', __CLASS__ . '::uabb_get_saved_wpform' );
	}
	/**
	 * Get saved templates.
	 *
	 * @since 1.16.1
	 */
	static public function get_saved_templates() {
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

		echo json_encode( $response );
		die;
	}
	/**
	 * Get saved CF7 Form.
	 *
	 * @since 1.23.0
	 */
	static public function uabb_get_saved_cf7() {

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
			echo json_encode( $response );
			die;
		}
	}
	/**
	 * Get saved Gravity Form.
	 *
	 * @since 1.23.0
	 */
	static public function uabb_get_saved_gravity() {

		$field_options = array();

		global $wpdb;

		if ( class_exists( 'GFForms' ) ) {

			$options = '';

			$form_table_name = GFFormsModel::get_form_table_name();

			$id = 0;

			$forms = $wpdb->get_results( $wpdb->prepare( 'SELECT id, title FROM ' . $form_table_name . ' WHERE id != %d', $id ), object ); // @codingStandardsIgnoreLine.
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
			echo json_encode( $response );
			die;
		}
	}
	/**
	 * Get saved Wpform Form.
	 *
	 * @since 1.23.0
	 */
	static public function uabb_get_saved_wpform() {

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
			echo json_encode( $response );
			die;
		}
	}
}
UABB_Template_Ajax::init();
