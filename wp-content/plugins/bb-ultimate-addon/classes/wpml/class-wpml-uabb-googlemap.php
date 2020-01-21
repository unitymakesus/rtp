<?php
/**
 *  UABB Google Map file for WMPL
 *
 *  @package UABB Google Map WPML Compatibility
 */

/**
 * Here WPML_UABB_Googlemap extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Googlemap
 */
class WPML_UABB_Googlemap extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Google Map's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Google Map.
	 */
	public function &get_items( $settings ) {
		return $settings->uabb_gmap_addresses;
	}

	/**
	 * Function that renders Google Map's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'map_name', 'info_window_text' );
	}

	/**
	 * Function that renders title of the Google Map module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Google Map.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {

			case 'map_name':
				return esc_html__( 'Google Map : Map Name', 'uabb' );

			case 'info_window_text':
				return esc_html__( 'Google Map : Info Text', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Google Map fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'map_name':
				return 'LINE';

			case 'info_window_text':
				return 'VISUAL';

			default:
				return '';
		}
	}
}

