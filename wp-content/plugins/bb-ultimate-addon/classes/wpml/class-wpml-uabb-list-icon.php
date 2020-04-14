<?php
/**
 *  UABB List Icon file for WMPL
 *
 *  @package UABB List Icon WPML Compatibility
 */

/**
 * Here WPML_UABB_Listicon extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Listicon
 */
class WPML_UABB_Listicon extends WPML_Beaver_Builder_Module_With_Items {
	/**
	 * Function that renders List Icon values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of List Icon.
	 */
	public function &get_items( $settings ) {
		return $settings->list_items;
	}

	/**
	 * Function that renders List Icon's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'title' );
	}

	/**
	 * Function that renders title of the List Icon module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the List Icon.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return esc_html__( 'List Icon : Title', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the List Icon fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			default:
				return '';
		}
	}
}

