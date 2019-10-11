<?php
/**
 *  UABB Hotspot file for WMPL
 *
 *  @package UABB Hotspot WPML Compatibility
 */

/**
 * Here WPML_UABB_Hotspot extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Hotspot
 */
class WPML_UABB_Hotspot extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Hotspot's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Hotspot.
	 */
	public function &get_items( $settings ) {
		return $settings->hotspot_marker;
	}

	/**
	 * Function that renders Hotspot's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'marker_text', 'tooltip_content', 'link' );
	}

	/**
	 * Function that renders title of the Hotspot module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Hotspot.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'marker_text':
				return esc_html__( 'Hotspot: Marker Text', 'uabb' );

			case 'tooltip_content':
				return esc_html__( 'Hotspot: Tooltip Content', 'uabb' );

			case 'link':
				return esc_html__( 'Hotspot: Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Hotspot fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'marker_text':
				return 'VISUAL';

			case 'tooltip_content':
				return 'VISUAL';

			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}

