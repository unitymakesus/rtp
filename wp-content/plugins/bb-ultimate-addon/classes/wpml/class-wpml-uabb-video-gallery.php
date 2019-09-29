<?php
/**
 *  UABB Video Gallery file for WMPL
 *
 *  @package UABB Video Gallery WPML Compatibility
 */

/**
 * Here WPML_UABB_VideoGallery extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_VideoGallery
 */
class WPML_UABB_VideoGallery extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Video Gallery values
	 *
	 * @since 1.13.0
	 * @param object $settings an object to get values of Video Gallery.
	 */
	public function &get_items( $settings ) {
		return $settings->form_gallery;
	}

	/**
	 * Function that renders Video Gallery fields value
	 *
	 * @since 1.13.0
	 */
	public function get_fields() {
		return array( 'youtube_link', 'vimeo_link', 'title', 'tags', 'filters_all_text', 'default_filter', 'filters_heading_text' );
	}

	/**
	 * Function that renders title of the Video Gallery module
	 *
	 * @since 1.13.0
	 * @param array $field gets the translated field values of the Video Gallery.
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'youtube_link':
				return esc_html__( 'Video Gallery : YouTube Link', 'uabb' );

			case 'vimeo_link':
				return esc_html__( 'Video Gallery : Vimeo Link', 'uabb' );

			case 'title':
				return esc_html__( 'Video Gallery : Caption', 'uabb' );

			case 'tags':
				return esc_html__( 'Video Gallery : Categories', 'uabb' );

			case 'filters_all_text':
				return esc_html__( 'Video Gallery : "All" Tab Label', 'uabb' );

			case 'default_filter':
				return esc_html__( 'Video Gallery : Category Name', 'uabb' );

			case 'filters_heading_text':
				return esc_html__( 'Video Gallery : Title Text', 'uabb' );

			default:
				return '';
		}
	}

	/**
	 * Function that renders editor type of the Video Gallery fields values
	 *
	 * @since 1.13.0
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'youtube_link':
				return 'LINK';

			case 'vimeo_link':
				return 'LINK';

			case 'title':
				return 'LINE';

			case 'tags':
				return 'LINE';

			case 'filters_all_text':
				return 'LINE';

			case 'default_filter':
				return 'LINE';

			case 'filters_heading_text':
				return 'LINE';

			default:
				return '';
		}
	}
}
