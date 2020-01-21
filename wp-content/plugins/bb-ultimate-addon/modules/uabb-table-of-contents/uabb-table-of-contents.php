<?php
/**
 *  UABB Table of Content Module file
 *
 *  @package UABB Table of Contents
 */

/**
 * Function that initializes UABB Table of Content Module
 *
 * @class UABBTableofContents
 */
class UABBTableofContents extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Table of Content Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Table of Contents', 'uabb' ),
				'description'     => __( 'Table of Contents to display content', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table-of-contents/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-table-of-contents/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'toc.svg',
			)
		);
		$this->add_js( 'uabbtableofcontents', $this->url . 'js/jquery.toc.js', array(), '', true );
		$this->add_css( 'font-awesome-5' );

	}

	/**
	 * Function to get the icon for the Table of Contents
	 *
	 * @since 1.23.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
		// check if $icon is referencing an included icon.
		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table-of-contents/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table-of-contents/icon/' . $icon;
		}
		if ( file_exists( $path ) ) {
			$remove_icon = apply_filters( 'uabb_remove_svg_icon', false, 10, 1 );
			if ( true === $remove_icon ) {
				return;
			} else {
				return file_get_contents( $path );
			}
		} else {
			return '';
		}
	}

	/**
	 * Function that renders separator pos
	 *
	 * @since 1.23.0
	 * @param string $pos gets the position of the separator.
	 */
	public function render_separator( $pos ) {

		$version_bb_check = UABB_Compatibility::check_bb_version();

		if ( $version_bb_check ) {

			if ( 'none' !== $this->settings->separator_style && $this->settings->separator_position === $pos ) {

				$position = '0';
				if ( 'center' === $this->settings->alignment ) {
					$position = '50';
				} elseif ( 'right' === $this->settings->alignment ) {
					$position = '100';
				}
				$line_color      = uabb_theme_base_color( $this->settings->separator_line_color );
				$separator_array = array(
					/* General Section */
					'separator' => $this->settings->separator_style,
					'style'     => $this->settings->separator_line_style,
					'color'     => $line_color,
					'height'    => $this->settings->separator_line_height,
					'width'     => ( '' !== $this->settings->separator_line_width ) ? $this->settings->separator_line_width : '30',

				);

				FLBuilder::render_module_html( 'advanced-separator', $separator_array );
			}
		} else {

			if ( 'none' !== $this->settings->separator_style && $this->settings->separator_position === $pos ) {

				$position = '0';
				if ( 'center' === $this->settings->alignment ) {
					$position = '50';
				} elseif ( 'right' === $this->settings->alignment ) {
					$position = '100';
				}
				$line_color      = uabb_theme_base_color( $this->settings->separator_line_color );
				$separator_array = array(
					/* General Section */
					'separator' => $this->settings->separator_style,
					'style'     => $this->settings->separator_line_style,
					'color'     => $line_color,
					'height'    => $this->settings->separator_line_height,
					'width'     => ( '' !== $this->settings->separator_line_width ) ? $this->settings->separator_line_width : '30',

				);

				FLBuilder::render_module_html( 'advanced-separator', $separator_array );
			}
		}
	}

}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table-of-contents/uabb-table-of-contents-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table-of-contents/uabb-table-of-contents-bb-less-than-2-2-compatibility.php';
}
