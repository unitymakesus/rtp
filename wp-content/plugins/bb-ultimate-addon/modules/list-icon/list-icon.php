<?php
/**
 *  UABB Icon List Module file
 *
 *  @package UABB Icon List Module
 */

/**
 * Function that initializes Icon List Module
 *
 * @class UABBIconListModule
 */
class UABBIconListModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Icon List Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'List Icon', 'uabb' ),
				'description'     => __( 'Display a group of linked Font Awesome icons.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/list-icon/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/list-icon/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'star-filled.svg',
			)
		);
	}

	/**
	 * Function that renders the image
	 *
	 * @method render_image
	 */
	public function render_image() {
		/* Render Html */

		/* Render HTML "$settings" Array */

		$imageicon_array = array(

			/* General Section */
			'image_type'            => $this->settings->image_type,

			/* Icon Basics */
			'icon'                  => $this->settings->icon,
			'icon_size'             => $this->settings->icon_size,
			'icon_align'            => '',

			/* Image Basics */
			'photo_source'          => $this->settings->photo_source,
			'photo'                 => $this->settings->photo,
			'photo_url'             => $this->settings->photo_url,
			'img_size'              => $this->settings->img_size,
			'img_align'             => '',
			'photo_src'             => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '',

			/* Icon Style */
			'icon_style'            => $this->settings->icon_style,
			'icon_bg_size'          => $this->settings->icon_bg_size,
			'icon_border_style'     => $this->settings->icon_border_style,
			'icon_border_width'     => $this->settings->icon_border_width,
			'icon_bg_border_radius' => $this->settings->icon_bg_border_radius,

			/* Image Style */
			'image_style'           => $this->settings->image_style,
			'img_bg_size'           => $this->settings->img_bg_size,
			'img_border_style'      => $this->settings->img_border_style,
			'img_border_width'      => $this->settings->img_border_width,
			'img_bg_border_radius'  => $this->settings->img_bg_border_radius,
		);

		/* Render HTML Function */
		echo '<div class="uabb-callout-outter">';
		FLBuilder::render_module_html( 'image-icon', $imageicon_array );
		echo '</div>';
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Handle opacity field.
			$helper->handle_opacity_inputs( $settings, 'icon_bg_hover_color_opc', 'icon_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'icon_bg_color_opc', 'icon_bg_color' );

			// For typography settings.
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->typography_font_family ) ) {
				if ( isset( $settings->typography_font_family['family'] ) ) {
					$settings->font_typo['font_family'] = $settings->typography_font_family['family'];
					unset( $settings->typography_font_family['family'] );
				}
				if ( isset( $settings->typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->typography_font_family['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->typography_font_family['weight'];
					}
					unset( $settings->typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->typography_font_size_unit ) ) {
				$settings->font_typo['font_size'] = array(
					'length' => $settings->typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->typography_font_size_unit );
			}
			if ( isset( $settings->typography_font_size_unit_medium ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->typography_font_size_unit_medium );
			}
			if ( isset( $settings->typography_font_size_unit_responsive ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->typography_font_size_unit_responsive );
			}
			if ( isset( $settings->typography_line_height_unit ) ) {

				$settings->font_typo['line_height'] = array(
					'length' => $settings->typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->typography_line_height_unit );
			}
			if ( isset( $settings->typography_line_height_unit_medium ) ) {

				$settings->font_typo_medium['line_height'] = array(
					'length' => $settings->typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->typography_line_height_unit_medium );
			}
			if ( isset( $settings->typography_line_height_unit_responsive ) ) {

				$settings->font_typo_responsive['line_height'] = array(
					'length' => $settings->typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->typography_line_height_unit_responsive );
			}
			if ( isset( $settings->typography_transform ) ) {
				$settings->font_typo['text_transform'] = $settings->typography_transform;
				unset( $settings->typography_transform );
			}
			if ( isset( $settings->typography_letter_spacing ) ) {
				$settings->font_typo['letter_spacing'] = array(
					'length' => $settings->typography_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->typography_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle opacity field.
			$helper->handle_opacity_inputs( $settings, 'icon_bg_hover_color_opc', 'icon_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'icon_bg_color_opc', 'icon_bg_color' );

			// For old param typography settings.
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->typography_font_family ) && '' !== $settings->typography_font_family ) {
				if ( isset( $settings->typography_font_family['family'] ) ) {
					$settings->font_typo['font_family'] = $settings->typography_font_family['family'];
					unset( $settings->typography_font_family['family'] );
				}
				if ( isset( $settings->typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->typography_font_family['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->typography_font_family['weight'];
					}
					unset( $settings->typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->typography_font_size['small'] ) && ! isset( $settings->font_typo_responsive['font_size'] ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->typography_font_size['medium'] ) && ! isset( $settings->font_typo_medium['font_size'] ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->typography_font_size['desktop'] ) && ! isset( $settings->font_typo['font_size'] ) ) {

				$settings->font_typo['font_size'] = array(
					'length' => $settings->typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->typography_line_height['desktop'] ) && isset( $settings->typography_font_size['desktop'] ) && 0 != $settings->typography_font_size['desktop'] && ! isset( $settings->font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->typography_line_height['desktop'] ) && is_numeric( $settings->typography_font_size['desktop'] ) ) {
					$settings->font_typo['line_height'] = array(
						'length' => round( $settings->typography_line_height['desktop'] / $settings->typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->typography_line_height['medium'] ) && isset( $settings->typography_font_size['medium'] ) && 0 != $settings->typography_font_size['medium'] && ! isset( $settings->font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->typography_line_height['medium'] ) && is_numeric( $settings->typography_font_size['medium'] ) ) {
					$settings->font_typo_medium['line_height'] = array(
						'length' => round( $settings->typography_line_height['medium'] / $settings->typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->typography_line_height['small'] ) && isset( $settings->typography_font_size['small'] ) && 0 != $settings->typography_font_size['small'] && ! isset( $settings->font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->typography_line_height['small'] ) && is_numeric( $settings->typography_font_size['small'] ) ) {
					$settings->font_typo_responsive['line_height'] = array(
						'length' => round( $settings->typography_line_height['small'] / $settings->typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->typography_font_size['desktop'] ) ) {
				unset( $settings->typography_font_size['desktop'] );
			}
			if ( isset( $settings->typography_font_size['medium'] ) ) {
				unset( $settings->typography_font_size['medium'] );
			}
			if ( isset( $settings->typography_font_size['small'] ) ) {
				unset( $settings->typography_font_size['small'] );
			}
			if ( isset( $settings->typography_line_height['desktop'] ) ) {
				unset( $settings->typography_line_height['desktop'] );
			}
			if ( isset( $settings->typography_line_height['medium'] ) ) {
				unset( $settings->typography_line_height['medium'] );
			}
			if ( isset( $settings->typography_line_height['small'] ) ) {
				unset( $settings->typography_line_height['small'] );
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/list-icon/list-icon-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/list-icon/list-icon-bb-less-than-2-2-compatibility.php';
}
