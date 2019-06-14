<?php
/**
 *  UABB Progess Bar file for WMPL
 *
 *  @package UABB Progess Bar WPML Compatibility
 */

/**
 * Here WPML_UABB_Progres_Bar extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Progres_Bar
 */
class WPML_UABB_Progres_Bar extends WPML_Beaver_Builder_Module_With_Items {
	/**
	 * Function that renders Progress Bar values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Progress Bar.
	 */
	public function &get_items( $settings ) {
		return $settings->horizontal;
	}

	/**
	 * Function that renders Progess Bar's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'circular_before_number', 'circular_after_number', 'horizontal_before_number' );
	}

	/**
	 * Function that renders title of the Progress Bar module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Progress Bar.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'circular_before_number':
				return esc_html__( 'Progress Bar: Text Before Number', 'uabb' );

			case 'circular_after_number':
				return esc_html__( 'Progress Bar: Text After Number', 'uabb' );

			case 'horizontal_before_number':
				return esc_html__( 'Progress Bar: Title', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Progress Bar fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'circular_before_number':
				return 'LINE';

			case 'circular_after_number':
				return 'LINE';

			case 'horizontal_before_number':
				return 'LINE';

			default:
				return '';
		}
	}
}

