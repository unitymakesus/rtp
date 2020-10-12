<?php
/**
 *  UABB Dual Color Heading Module file
 *
 *  @package UABB Dual Color Heading Module
 */

/**
 * Function that initializes UABB Dual Color Heading Module
 *
 * @class UABBDualColorModule
 */
class UABBDualColorModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Dual Color Heading module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Dual Color Headings', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/dual-color-heading/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/dual-color-heading/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true, // Defaults to false and can be omitted.
				'icon'            => 'text.svg',
			)
		);

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

		$version_bb_check        = UABB_Compatibility::$version_bb_check;
		$page_migrated           = UABB_Compatibility::$uabb_migration;
		$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {

			if ( ! isset( $settings->dual_typo ) || ! is_array( $settings->dual_typo ) ) {

				$settings->dual_typo            = array();
				$settings->dual_typo_medium     = array();
				$settings->dual_typo_responsive = array();
			}
			if ( isset( $settings->dual_font_family ) ) {
				if ( isset( $settings->dual_font_family['weight'] ) ) {
					if ( 'regular' === $settings->dual_font_family['weight'] ) {
						$settings->dual_typo['font_weight'] = 'normal';
					} else {
						$settings->dual_typo['font_weight'] = $settings->dual_font_family['weight'];
					}
					unset( $settings->dual_font_family['weight'] );
				}
				if ( isset( $settings->dual_font_family['family'] ) ) {
					$settings->dual_typo['font_family'] = $settings->dual_font_family['family'];
					unset( $settings->dual_font_family['family'] );
				}
			}
			if ( isset( $settings->dual_font_size_unit ) ) {

				$settings->dual_typo['font_size'] = array(
					'length' => $settings->dual_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->dual_font_size_unit );
			}
			if ( isset( $settings->dual_font_size_unit_medium ) ) {
				$settings->dual_typo_medium['font_size'] = array(
					'length' => $settings->dual_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->dual_font_size_unit_medium );
			}
			if ( isset( $settings->dual_font_size_unit_responsive ) ) {
				$settings->dual_typo_responsive['font_size'] = array(
					'length' => $settings->dual_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->dual_font_size_unit_responsive );
			}
			if ( isset( $settings->dual_line_height_unit ) ) {

				$settings->dual_typo['line_height'] = array(
					'length' => $settings->dual_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->dual_line_height_unit );
			}
			if ( isset( $settings->dual_line_height_unit_medium ) ) {
				$settings->dual_typo_medium['line_height'] = array(
					'length' => $settings->dual_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->dual_line_height_unit_medium );
			}
			if ( isset( $settings->dual_line_height_unit_responsive ) ) {
				$settings->dual_typo_responsive['line_height'] = array(
					'length' => $settings->dual_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->dual_line_height_unit_responsive );
			}
			if ( isset( $settings->dual_transform ) ) {
				$settings->dual_typo['text_transform'] = $settings->dual_transform;
				unset( $settings->dual_transform );
			}
			if ( isset( $settings->dual_letter_spacing ) ) {
				$settings->dual_typo['letter_spacing'] = array(
					'length' => $settings->dual_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->dual_letter_spacing );
			}
			if ( isset( $settings->dual_color_alignment ) ) {
				$settings->dual_typo['text_align'] = $settings->dual_color_alignment;
				unset( $settings->dual_color_alignment );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {
			if ( ! isset( $settings->dual_typo ) || ! is_array( $settings->dual_typo ) ) {

				$settings->dual_typo            = array();
				$settings->dual_typo_medium     = array();
				$settings->dual_typo_responsive = array();
			}
			if ( isset( $settings->dual_font_family ) ) {
				if ( isset( $settings->dual_font_family['weight'] ) ) {
					if ( 'regular' === $settings->dual_font_family['weight'] ) {
						$settings->dual_typo['font_weight'] = 'normal';
					} else {
						$settings->dual_typo['font_weight'] = $settings->dual_font_family['weight'];
					}
					unset( $settings->dual_font_family['weight'] );
				}
				if ( isset( $settings->dual_font_family['family'] ) ) {
					$settings->dual_typo['font_family'] = $settings->dual_font_family['family'];
					unset( $settings->dual_font_family['family'] );
				}
			}
			if ( isset( $settings->dual_font_size['desktop'] ) ) {
				$settings->dual_typo['font_size'] = array(
					'length' => $settings->dual_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->dual_font_size['medium'] ) ) {
				$settings->dual_typo_medium['font_size'] = array(
					'length' => $settings->dual_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->dual_font_size['small'] ) ) {
				$settings->dual_typo_responsive['font_size'] = array(
					'length' => $settings->dual_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->dual_line_height['desktop'] ) && isset( $settings->dual_font_size['desktop'] ) && 0 !== $settings->dual_font_size['desktop'] ) {
				if ( is_numeric( $settings->dual_line_height['desktop'] ) && is_numeric( $settings->dual_font_size['desktop'] ) ) {
					$settings->dual_typo['line_height'] = array(
						'length' => round( $settings->dual_line_height['desktop'] / $settings->dual_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->dual_line_height['medium'] ) && isset( $settings->dual_font_size['medium'] ) && 0 !== $settings->dual_font_size['medium'] ) {
				if ( is_numeric( $settings->dual_line_height['medium'] ) && is_numeric( $settings->dual_font_size['medium'] ) ) {
					$settings->dual_typo_medium['line_height'] = array(
						'length' => round( $settings->dual_line_height['medium'] / $settings->dual_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->dual_line_height['small'] ) && isset( $settings->dual_font_size['small'] ) && 0 !== $settings->dual_font_size['small'] ) {
				if ( is_numeric( $settings->dual_line_height['small'] ) && is_numeric( $settings->dual_font_size['small'] ) ) {
					$settings->dual_typo_responsive['line_height'] = array(
						'length' => round( $settings->dual_line_height['small'] / $settings->dual_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->dual_color_alignment ) ) {
				$settings->dual_typo['text_align'] = $settings->dual_color_alignment;
				unset( $settings->dual_color_alignment );
			}
			if ( isset( $settings->dual_font_size['desktop'] ) ) {
				unset( $settings->dual_font_size['desktop'] );
			}
			if ( isset( $settings->dual_font_size['medium'] ) ) {
				unset( $settings->dual_font_size['medium'] );
			}
			if ( isset( $settings->dual_font_size['small'] ) ) {
				unset( $settings->dual_font_size['small'] );
			}
			if ( isset( $settings->dual_line_height['desktop'] ) ) {
				unset( $settings->dual_line_height['desktop'] );
			}
			if ( isset( $settings->dual_line_height['medium'] ) ) {
				unset( $settings->dual_line_height['medium'] );
			}
			if ( isset( $settings->dual_line_height['small'] ) ) {
				unset( $settings->dual_line_height['small'] );
			}
		}
		return $settings;
	}
}

/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/dual-color-heading/dual-color-heading-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/dual-color-heading/dual-color-heading-bb-less-than-2-2-compatibility.php';
}
