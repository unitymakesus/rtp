<?php
/**
 *  UABB Advanced Tabs file for WMPL
 *
 *  @package UABB Tabs WPML Compatibility
 */

/**
 * Here WPML_UABB_Tabs extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Tabs
 */
class WPML_UABB_Tabs extends WPML_Beaver_Builder_Module_With_Items {
	/**
	 * Function that renders Advanced Tabs values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Advanced Tabs.
	 */
	public function &get_items( $settings ) {
		return $settings->items;
	}

	/**
	 * Function that renders Tabs fields label
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
		return array( 'label', 'ct_content' );
	}

	/**
	 * Function that renders title of the Advanced Tabs module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Advanced Tabs.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'label':
				return esc_html__( 'Tabs Item Label', 'uabb' );

			case 'ct_content':
				return esc_html__( 'Tabs Item Content', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Advanced Tabs fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'label':
				return 'LINE';

			case 'ct_content':
				return 'VISUAL';

			default:
				return '';
		}
	}
}

