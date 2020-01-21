<?php
/**
 *  UABB How To file for WMPL
 *
 *  @package UABB How To WPML Compatibility
 */

/**
 * Here WPML_UABB_How_To extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_How_To
 */
class WPML_UABB_How_To extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders UABB How To values
	 *
	 * @since 1.24.0
	 * @param object $settings an object to get values of UABB How To.
	 */
	public function &get_items( $settings ) {
		return $settings->step_data;
	}

	/**
	 * Function that renders UABB How To fields value
	 *
	 * @since 1.24.0
	 */
	public function get_fields() {
		return array( 'uabb_how_to_title', 'description', 'total_time_text', 'estimated_cost_text', 'supply_title', 'uabb_supply', 'tool_title', 'uabb_tool', 'step_section_title', 'step_title', 'step_description', 'step_link' );
	}

	/**
	 * Function that renders title of the UABB How To module
	 *
	 * @since 1.24.0
	 * @param array $field gets the translated field values of the UABB How To.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'uabb_how_to_title':
				return esc_html__( 'UABB How To : Title', 'uabb' );

			case 'description':
				return esc_html__( 'UABB How To : Description', 'uabb' );

			case 'total_time_text':
				return esc_html__( 'UABB How To : Total Time Text', 'uabb' );

			case 'estimated_cost_text':
				return esc_html__( 'UABB How To : Estimated Cost Text', 'uabb' );

			case 'supply_title':
				return esc_html__( 'UABB How To : Supply Title', 'uabb' );

			case 'uabb_supply':
				return esc_html__( 'UABB How To : Supply', 'uabb' );

			case 'tool_title':
				return esc_html__( 'UABB How To : Tool Title', 'uabb' );

			case 'uabb_tool':
				return esc_html__( 'UABB How To : Tool', 'uabb' );

			case 'step_section_title':
				return esc_html__( 'UABB How To : Section Title', 'uabb' );

			case 'step_title':
				return esc_html__( 'UABB How To : Title', 'uabb' );

			case 'step_description':
				return esc_html__( 'UABB How To : Description', 'uabb' );

			case 'step_link':
				return esc_html__( 'UABB How To : Link', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the UABB How To fields values
	 *
	 * @since 1.24.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'uabb_how_to_title':
				return 'LINK';

			case 'description':
				return 'VISUAL';

			case 'total_time_text':
				return 'LINE';

			case 'estimated_cost_text':
				return 'LINE';

			case 'supply_title':
				return 'LINE';

			case 'uabb_supply':
				return 'LINE';

			case 'tool_title':
				return 'LINE';

			case 'uabb_tool':
				return 'LINE';

			case 'step_section_title':
				return 'LINE';

			case 'step_description':
				return 'VISUAL';

			case 'step_link':
				return 'LINE';

			default:
				return '';
		}
	}
}
