<?php
/**
 *  UABB Info Circle file for WMPL
 *
 *  @package UABB Info Circle WPML Compatibility
 */

/**
 * Here WPML_UABB_Info_Circle extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Info_Circle
 */
class WPML_UABB_Info_Circle extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Info Circle's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Info Circle.
	 */
	public function &get_items( $settings ) {
		return $settings->add_circle_item;
	}

	/**
	 * Function that renders Info Circle's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'circle_item_title', 'circle_item_description', 'cta_text', 'cta_link' );
	}

	/**
	 * Function that renders title of the Info Circle module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Info Circle.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'circle_item_title':
				return esc_html__( 'Info Circle: Title', 'uabb' );

			case 'circle_item_description':
				return esc_html__( 'Info Circle: Description', 'uabb' );

			case 'cta_text':
				return esc_html__( 'Info Circle: CTA Text', 'uabb' );

			case 'cta_link':
				return esc_html__( 'Info Circle: CTA Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Info Circle fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'circle_item_title':
				return 'LINE';

			case 'circle_item_description':
				return 'VISUAL';

			case 'cta_text':
				return 'LINE';

			case 'cta_link':
				return 'LINK';

			default:
				return '';
		}
	}
}

