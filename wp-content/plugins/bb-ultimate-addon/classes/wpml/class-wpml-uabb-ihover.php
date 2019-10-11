<?php
/**
 *  UABB iHover file for WMPL
 *
 *  @package UABB iHover WPML Compatibility
 */

/**
 * Here WPML_UABB_Ihover extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Ihover
 */
class WPML_UABB_Ihover extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders iHover's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of iHover.
	 */
	public function &get_items( $settings ) {
		return $settings->ihover_item;
	}

	/**
	 * Function that renders iHover's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'title', 'description', 'link_url' );
	}

	/**
	 * Function that renders title of the iHover module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the iHover.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return esc_html__( 'ihover : Title', 'uabb' );

			case 'description':
				return esc_html__( 'ihover : Description', 'uabb' );

			case 'link_url':
				return esc_html__( 'ihover : Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the iHover fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			case 'description':
				return 'VISUAL';

			case 'link_url':
				return 'LINK';

			default:
				return '';
		}
	}
}

