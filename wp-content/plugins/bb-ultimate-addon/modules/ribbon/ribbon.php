<?php
/**
 *  UABB Ribbon Module file
 *
 *  @package UABB Ribbon Module
 */

/**
 * Function that initializes UABB Ribbon Module
 *
 * @class RibbonModule
 */
class RibbonModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Ribbon Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Ribbon', 'uabb' ),
				'description'     => __( 'Ribbon', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/ribbon/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'ribbon.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the Progress Bar
	 *
	 * @method get_icon
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/icon/' . $icon;
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

			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) ) {

				if ( isset( $settings->text_font_family['family'] ) ) {

					$settings->font_typo['font_family'] = $settings->text_font_family['family'];
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {

					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->ribbon_align ) ) {
				$settings->ribbon_align = $settings->ribbon_align;
			}
			if ( isset( $settings->text_font_size_unit ) ) {
				$settings->font_typo['font_size'] = array(
					'length' => $settings->text_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size_unit_medium ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size_unit_responsive ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_line_height_unit ) ) {

				$settings->font_typo['line_height'] = array(
					'length' => $settings->text_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->text_line_height_unit_medium ) ) {

				$settings->font_typo_medium['line_height'] = array(
					'length' => $settings->text_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->text_line_height_unit_responsive ) ) {

				$settings->font_typo_responsive['line_height'] = array(
					'length' => $settings->text_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->text_transform ) ) {
				$settings->font_typo['text_transform'] = $settings->text_transform;
			}
			if ( isset( $settings->text_letter_spacing ) ) {
				$settings->font_typo['letter_spacing'] = array(
					'length' => $settings->text_letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font ) ) {
				unset( $settings->font );
				unset( $settings->text_font_size_unit );
				unset( $settings->text_font_size_unit_medium );
				unset( $settings->text_font_size_unit_responsive );
				unset( $settings->text_line_height_unit );
				unset( $settings->text_line_height_unit_medium );
				unset( $settings->text_line_height_unit_responsive );
				unset( $settings->text_transform );
				unset( $settings->text_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) && '' !== $settings->text_font_family ) {

				if ( isset( $settings->text_font_family['family'] ) ) {

					$settings->font_typo['font_family'] = $settings->text_font_family['family'];
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {

					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->ribbon_align ) ) {
				$settings->ribbon_align = $settings->ribbon_align;
			}
			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->font_typo_responsive['font_size'] ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->font_typo_medium['font_size'] ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->font_typo['font_size'] ) ) {

				$settings->font_typo['font_size'] = array(
					'length' => $settings->text_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->font_typo['line_height'] = array(
						'length' => round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->font_typo_medium['line_height'] = array(
						'length' => round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->font_typo_responsive['line_height'] = array(
						'length' => round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->font ) ) {
				unset( $settings->font );
				unset( $settings->text_font_size );
				unset( $settings->text_line_height );
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
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/ribbon-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/ribbon/ribbon-bb-less-than-2-2-compatibility.php';
}
