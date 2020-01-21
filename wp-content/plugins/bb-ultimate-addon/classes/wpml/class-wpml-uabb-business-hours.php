<?php
/**
 *  UABB Business Hours file for WMPL
 *
 *  @package UABB Business Hours WPML Compatibility
 */

/**
 * Here WPML_UABB_Business_Hours extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Business_Hours
 */
class WPML_UABB_Business_Hours extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Business Hours values
	 *
	 * @since 1.20.0
	 * @param object $settings an object to get values of Business Hours.
	 */
	public function &get_items( $settings ) {
		return $settings->businessHours; // @codingStandardsIgnoreLine.
	}

	/**
	 * Function that renders Business Hours fields value
	 *
	 * @since 1.20.0
	 */
	public function get_fields() {
		return array( 'days', 'hours' );
	}

	/**
	 * Function that renders title of the Business Hours module
	 *
	 * @since 1.20.0
	 * @param array $field gets the translated field values of the Business Hours.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'days':
				return esc_html__( 'Business Hours : Enter Day', 'uabb' );

			case 'hours':
				return esc_html__( 'Business Hours : Enter Time', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Business Hours fields values
	 *
	 * @since 1.20.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'days':
				return 'LINK';

			case 'hours':
				return 'LINK';

			default:
				return '';
		}
	}
}
