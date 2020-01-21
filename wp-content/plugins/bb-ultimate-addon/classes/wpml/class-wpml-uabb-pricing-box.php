<?php
/**
 *  UABB Price Box file for WMPL
 *
 *  @package UABB Price Box WPML Compatibility
 */

/**
 * Here WPML_UABB_Pricing_Box extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Pricing_Box
 */
class WPML_UABB_Pricing_Box extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Price Box values
	 *
	 * @since 1.15.0
	 * @param object $settings an object to get values of Price Box.
	 */
	public function &get_items( $settings ) {
		return $settings->pricing_columns;
	}

	/**
	 * Function that renders Price Box's fields value
	 *
	 * @since 1.15.0
	 */
	public function get_fields() {
		return array( 'featured_text', 'title', 'btn_text', 'btn_link' );
	}

	/**
	 * Function that renders title of the Price Box module
	 *
	 * @since 1.15.0
	 * @param array $field gets the translated field values of the Price Box.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'featured_text':
				return esc_html__( 'Pricing Box: Featured Text', 'uabb' );

			case 'title':
				return esc_html__( 'Pricing Box: Title', 'uabb' );

			case 'btn_text':
				return esc_html__( 'Pricing Box: Button Text', 'uabb' );

			case 'btn_link':
				return esc_html__( 'Pricing Box: Button Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Price Box fields values
	 *
	 * @since 1.15.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'featured_text':
				return 'LINE';

			case 'title':
				return 'LINE';

			case 'btn_text':
				return 'LINE';

			case 'btn_link':
				return 'LINK';

			default:
				return '';
		}
	}
}
