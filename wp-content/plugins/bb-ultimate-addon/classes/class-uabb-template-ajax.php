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
}
UABB_Template_Ajax::init();
