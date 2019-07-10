<?php
/**
 *  UABB Price List file for WMPL
 *
 *  @package UABB Price List WPML Compatibility
 */

/**
 * Here WPML_UABB_Pricelist extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Pricelist
 */
class WPML_UABB_Pricelist extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Price List values
	 *
	 * @since 1.15.0
	 * @param object $settings an object to get values of Price List.
	 */
	public function &get_items( $settings ) {
		return $settings->add_list_item;
	}

	/**
	 * Function that renders Price List's fields value
	 *
	 * @since 1.15.0
	 */
	public function get_fields() {
		return array( 'price_list_item_title', 'price_list_item_url', 'price_list_item_description', 'price', 'original_price' );
	}

	/**
	 * Function that renders title of the Price List module
	 *
	 * @since 1.15.0
	 * @param array $field gets the translated field values of the Price List.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'price_list_item_title':
				return esc_html__( 'Price List: Title', 'uabb' );

			case 'price_list_item_url':
				return esc_html__( 'Price List : Link', 'uabb' );

			case 'price_list_item_description':
				return esc_html__( 'Price List : Description', 'uabb' );

			case 'price':
				return esc_html__( 'Price List : Regular Price', 'uabb' );

			case 'original_price':
				return esc_html__( 'Price List : Original Price', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Info List fields values
	 *
	 * @since 1.15.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'price_list_item_title':
				return 'LINE';

			case 'price_list_item_url':
				return 'LINK';

			case 'price_list_item_description':
				return 'VISUAL';

			case 'price':
				return 'LINE';

			case 'original_price':
				return 'LINE';

			default:
				return '';
		}
	}
}

