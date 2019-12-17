<?php
/**
 *  UABB Advanced Icon file for WMPL
 *
 *  @package UABB Advanced Icon WPML Compatibility
 */

/**
 * Here WPML_UABB_AdvanceIcons extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_AdvanceIcons
 */
class WPML_UABB_AdvanceIcons extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Advanced Icon's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Advanced Icon.
	 */
	public function &get_items( $settings ) {
		return $settings->icons;
	}

	/**
	 * Function that renders Advanced Icon's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'link' );
	}

	/**
	 * Function that renders title of the Advanced Icon module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Advanced Icon.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'link':
				return esc_html__( 'Icon : Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Advanced Icon's fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}

