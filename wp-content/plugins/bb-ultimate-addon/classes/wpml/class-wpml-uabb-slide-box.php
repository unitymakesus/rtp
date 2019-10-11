<?php
/**
 *  UABB Slide Box file for WMPL
 *
 *  @package UABB Slide Box WPML Compatibility
 */

/**
 * Here WPML_UABB_Slide_Box extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Slide_Box
 */
class WPML_UABB_Slide_Box extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Slide Box values
	 *
	 * @since 1.15.0
	 * @param object $settings an object to get values of Slide Box.
	 */
	public function &get_items( $settings ) {
		return $settings->button;
	}

	/**
	 * Function that renders Slide Box's fields value
	 *
	 * @since 1.15.0
	 */
	public function get_fields() {
		return array( 'text', 'link' );
	}

	/**
	 * Function that renders title of the Slide Box module
	 *
	 * @since 1.15.0
	 * @param array $field gets the translated field values of the Slide Box.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'text':
				return esc_html__( 'Slide Box: Button Text', 'uabb' );

			case 'link':
				return esc_html__( 'Slide Box: Button Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Slide Box fields values
	 *
	 * @since 1.15.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'text':
				return 'LINE';

			case 'link':
				return 'LINK';

			default:
				return '';
		}
	}
}
