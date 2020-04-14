<?php
/**
 *  UABB FAQ file for WMPL
 *
 *  @package UABB FAQ WPML Compatibility
 */

/**
 * Here WPML_UABB_FAQ extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_FAQ
 */
class WPML_UABB_FAQ extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders UABB FAQ's values
	 *
	 * @since 1.25.0
	 * @param object $settings an object to get values of UABB FAQ.
	 */
	public function &get_items( $settings ) {
		return $settings->faq_items;
	}

	/**
	 * Function that renders UABB FAQ'S fields value
	 *
	 * @since 1.25.0
	 */
	public function get_fields() {
		return array( 'faq_question', 'faq_answer' );
	}

	/**
	 * Function that renders title of the UABB FAQ'S module
	 *
	 * @since 1.25.0
	 * @param array $field gets the translated field values of the UABB FAQ'S.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'faq_question':
				return esc_html__( 'Question', 'uabb' );

			case 'faq_answer':
				return esc_html__( 'Answer', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the UABB FAQ'S fields values
	 *
	 * @since 1.25.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'faq_question':
				return 'LINE';

			case 'faq_answer':
				return 'VISUAL';

			default:
				return '';
		}
	}
}

