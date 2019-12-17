<?php
/**
 *  UABB Advanced Accordion file for WMPL
 *
 *  @package UABB Advanced Accordion WPML Compatibility
 */

/**
 * Here WPML_UABB_Accordion extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Accordion
 */
class WPML_UABB_Accordion extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Advanced Accordion's values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Advanced Accordion.
	 */
	public function &get_items( $settings ) {
		return $settings->acc_items;
	}

	/**
	 * Function that renders Advanced Accordion's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'acc_title', 'ct_content' );
	}

	/**
	 * Function that renders title of the Advanced Accordion module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Advanced Accordion.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'acc_title':
				return esc_html__( 'Accordion Item Label', 'uabb' );

			case 'ct_content':
				return esc_html__( 'Accordion Item Content', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Advanced Accordion's fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'acc_title':
				return 'LINE';

			case 'ct_content':
				return 'VISUAL';

			default:
				return '';
		}
	}
}

