<?php
/**
 *  UABB Creative Link file for WMPL
 *
 *  @package UABB Creative Link WPML Compatibility
 */

/**
 * Here WPML_UABB_Creative_Link extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Creative_Link
 */
class WPML_UABB_Creative_Link extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Creative Link's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Creative Link.
	 */
	public function &get_items( $settings ) {
		return $settings->screens;
	}

	/**
	 * Function that renders Creative Link's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'title', 'link' );
	}

	/**
	 * Function that renders title of the Creative Link module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Creative Link.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return esc_html__( 'Creative Link: Title', 'uabb' );

			case 'link':
				return esc_html__( 'Creative Link: Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Creative Link's fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}

