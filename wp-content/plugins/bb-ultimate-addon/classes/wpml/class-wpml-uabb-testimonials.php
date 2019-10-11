<?php
/**
 *  UABB testimonials file for WMPL
 *
 *  @package UABB Testimonials WPML Compatibility
 */

/**
 * Here WPML_UABB_Testimonials extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Testimonials
 */
class WPML_UABB_Testimonials extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders testimonials values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of testimonials.
	 */
	public function &get_items( $settings ) {
		return $settings->testimonials;
	}

	/**
	 * Function that renders testimonials fields
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'testimonial_author', 'testimonial_designation', 'testimonial' );
	}

	/**
	 * Function that renders title of the Testimonials module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the testimonials.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'testimonial_author':
				return esc_html__( 'Testimonials : Author Name', 'uabb' );

			case 'testimonial_designation':
				return esc_html__( 'Testimonials : Designation', 'uabb' );

			case 'testimonial':
				return esc_html__( 'Testimonial', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Testimonials values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'testimonial_author':
				return 'LINE';

			case 'testimonial_designation':
				return 'LINE';

			case 'testimonial':
				return 'VISUAL';

			default:
				return '';
		}
	}
}

