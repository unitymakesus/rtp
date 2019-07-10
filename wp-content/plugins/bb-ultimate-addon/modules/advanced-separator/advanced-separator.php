<?php
/**
 *  UABB Advanced Separator Module file
 *
 *  @package UABB Advanced Separator Module
 */

/**
 * Function that initializes UABB Advanced Separator Module
 *
 * @class AdvancedSeparatorModule
 */
class AdvancedSeparatorModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Separator module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Separator', 'uabb' ),
				'description'     => __( 'A divider line to separate content.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-separator/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-separator/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'minus.svg',
			)
		);
	}

	/**
	 * Function that renders Image for the Separator Module
	 *
	 * @method render_image
	 */
	public function render_image() {
		if ( 'line_image' == $this->settings->separator || 'line_icon' == $this->settings->separator ) {
			$imageicon_array = array(

				/* General Section */
				'image_type'            => ( 'line_image' == $this->settings->separator ) ? 'photo' : ( ( 'line_icon' == $this->settings->separator ) ? 'icon' : '' ),

				/* Icon Basics */
				'icon'                  => $this->settings->icon,
				'icon_size'             => $this->settings->icon_size,
				'icon_align'            => 'center',

				/* Image Basics */
				'photo_source'          => $this->settings->photo_source,
				'photo'                 => $this->settings->photo,
				'photo_url'             => $this->settings->photo_url,
				'img_size'              => $this->settings->img_size,
				'img_align'             => 'center',
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
			if ( 'line_image' == $this->settings->separator ) {
				echo '<div class="uabb-image-outter-wrap">';
			}
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			if ( 'line_image' == $this->settings->separator ) {
				echo '</div>';
			}
		}
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

			if ( ! isset( $settings->text_font_typo ) || ! is_array( $settings->text_font_typo ) ) {

				$settings->text_font_typo            = array();
				$settings->text_font_typo_medium     = array();
				$settings->text_font_typo_responsive = array();
			}

			if ( isset( $settings->text_font_family ) ) {
				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_font_typo['font_weight'] = 'normal';
					} else {
						$settings->text_font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_font_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
			}
			if ( isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_typo['font_size'] = array(
					'length' => $settings->text_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit );
			}
			if ( isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_medium );
			}
			if ( isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_responsive );
			}
			if ( isset( $settings->text_line_height_unit ) ) {

				$settings->text_font_typo['line_height'] = array(
					'length' => $settings->text_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit );
			}
			if ( isset( $settings->text_line_height_unit_medium ) ) {
				$settings->text_font_typo_medium['line_height'] = array(
					'length' => $settings->text_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_medium );
			}
			if ( isset( $settings->text_line_height_unit_responsive ) ) {
				$settings->text_font_typo_responsive['line_height'] = array(
					'length' => $settings->text_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_responsive );
			}
			if ( isset( $settings->text_transform ) ) {
				$settings->text_font_typo['text_transform'] = $settings->text_transform;
				unset( $settings->text_transform );
			}
			if ( isset( $settings->text_letter_spacing ) ) {
				$settings->text_font_typo['letter_spacing'] = array(
					'length' => $settings->text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->text_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			if ( ! isset( $settings->text_font_typo ) || ! is_array( $settings->text_font_typo ) ) {

				$settings->text_font_typo            = array();
				$settings->text_font_typo_medium     = array();
				$settings->text_font_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) ) {

				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_font_typo['font_weight'] = 'normal';
					} else {
						$settings->text_font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_font_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
			}
			if ( isset( $settings->text_font_size['small'] ) ) {
				$settings->text_font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['medium'] ) ) {
				$settings->text_font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['desktop'] ) ) {
				$settings->text_font_typo['font_size'] = array(
					'length' => $settings->text_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_font_typo['line_height'] = array(
						'length' => round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_font_typo_medium['line_height'] = array(
						'length' => round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_font_size['desktop'] ) ) {
				unset( $settings->text_font_size['desktop'] );
			}
			if ( isset( $settings->text_font_size['medium'] ) ) {
				unset( $settings->text_font_size['medium'] );
			}
			if ( isset( $settings->text_font_size['small'] ) ) {
				unset( $settings->text_font_size['small'] );
			}
			if ( isset( $settings->text_line_height['desktop'] ) ) {
				unset( $settings->text_line_height['desktop'] );
			}
			if ( isset( $settings->text_line_height['medium'] ) ) {
				unset( $settings->text_line_height['medium'] );
			}
			if ( isset( $settings->text_line_height['small'] ) ) {
				unset( $settings->text_line_height['small'] );
			}
		}

		return $settings;
	}
}

/*
* Condition to verify Beaver Builder version.
* And accordingly render the required form settings file.
*/

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-separator/advanced-separator-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-separator/advanced-separator-bb-less-than-2-2-compatibility.php';
}

