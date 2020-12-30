<?php
/**
 *  UABB Business Hour Module file
 *
 *  @package UABB Business Hour Module
 */

/**
 * Function that initializes UABB Business Hour Module
 *
 * @class UABBBusinessHours
 */
class UABBBusinessHours extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the UABB Business Hour module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Business Hours', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-hours/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-business-hours/',
				'editor_export'   => true,
				'enabled'         => true,
				'partial_refresh' => true,
				'icon'            => 'clock.svg',
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

			// Handle old border settings.
			if ( isset( $settings->border_color ) ) {

				$settings->border = array();

				// Border style, color, and width.
				if ( isset( $settings->border_style_all ) ) {
					$settings->border['style'] = $settings->border_style_all;
					unset( $settings->border_style_all );
				}
				if ( isset( $settings->border_color ) ) {
					$settings->border['color'] = $settings->border_color;
					unset( $settings->border_color );
				}
				if ( isset( $settings->border_width_top ) && isset( $settings->border_width_right ) && isset( $settings->border_width_bottom ) && isset( $settings->border_width_left ) ) {
					$settings->border['width'] = array(
						'top'    => $settings->border_width_top,
						'right'  => $settings->border_width_right,
						'bottom' => $settings->border_width_bottom,
						'left'   => $settings->border_width_left,
					);
					unset( $settings->border_width_top );
					unset( $settings->border_width_right );
					unset( $settings->border_width_bottom );
					unset( $settings->border_width_left );
				}
				// Border radius.
				if ( isset( $settings->border_radius ) ) {
					$settings->border['radius'] = array(
						'top_left'     => $settings->border_radius,
						'top_right'    => $settings->border_radius,
						'bottom_left'  => $settings->border_radius,
						'bottom_right' => $settings->border_radius,
					);
					unset( $settings->border_radius );
				}
			}

			// For overall day typography.
			if ( ! isset( $settings->day_font_typo ) || ! is_array( $settings->day_font_typo ) ) {

				$settings->day_font_typo            = array();
				$settings->day_font_typo_medium     = array();
				$settings->day_font_typo_responsive = array();
			}
			if ( isset( $settings->days_font ) ) {

				if ( isset( $settings->days_font['family'] ) ) {

					$settings->day_font_typo['font_family'] = $settings->days_font['family'];
					unset( $settings->days_font['family'] );
				}
				if ( isset( $settings->days_font['weight'] ) ) {

					if ( 'regular' === $settings->days_font['weight'] ) {
						$settings->day_font_typo['font_weight'] = 'normal';
					} else {
						$settings->day_font_typo['font_weight'] = $settings->days_font['weight'];
					}
					unset( $settings->days_font['weight'] );
				}
			}
			if ( isset( $settings->days_new_font_size ) ) {
				$settings->day_font_typo['font_size'] = array(
					'length' => $settings->days_new_font_size,
					'unit'   => 'px',
				);
				unset( $settings->days_new_font_size );
			}
			if ( isset( $settings->days_new_font_size_medium ) ) {
				$settings->day_font_typo_medium['font_size'] = array(
					'length' => $settings->days_new_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->days_new_font_size_medium );
			}
			if ( isset( $settings->days_new_font_size_responsive ) ) {
				$settings->day_font_typo_responsive['font_size'] = array(
					'length' => $settings->days_new_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->days_new_font_size_responsive );
			}
			if ( isset( $settings->days_new_line_height ) ) {

				$settings->day_font_typo['line_height'] = array(
					'length' => $settings->days_new_line_height,
					'unit'   => 'em',
				);
				unset( $settings->days_new_line_height );
			}
			if ( isset( $settings->days_new_line_height_medium ) ) {

				$settings->day_font_typo_medium['line_height'] = array(
					'length' => $settings->days_new_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->days_new_line_height_medium );
			}

			if ( isset( $settings->days_new_line_height_responsive ) ) {

				$settings->day_font_typo_responsive['line_height'] = array(
					'length' => $settings->days_new_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->days_new_line_height_responsive );
			}
			if ( isset( $settings->days_transform ) ) {
				$settings->day_font_typo['text_transform'] = $settings->days_transform;
				unset( $settings->days_transform );
			}
			if ( isset( $settings->days_decoration ) ) {
				$settings->day_font_typo['text_decoration'] = $settings->days_decoration;
				unset( $settings->days_decoration );
			}
			if ( isset( $settings->days_letter_spacing ) ) {
				$settings->day_font_typo['letter_spacing'] = array(
					'length' => $settings->days_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->days_letter_spacing );
			}
			if ( isset( $settings->days_alignment ) ) {
				$settings->day_font_typo['text_align'] = $settings->days_alignment;
				unset( $settings->days_alignment );
			}

			// For overall hours typography.
			if ( ! isset( $settings->hour_font_typo ) || ! is_array( $settings->hour_font_typo ) ) {

				$settings->hour_font_typo            = array();
				$settings->hour_font_typo_medium     = array();
				$settings->hour_font_typo_responsive = array();
			}
			if ( isset( $settings->hours_font ) ) {

				if ( isset( $settings->hours_font['family'] ) ) {

					$settings->hour_font_typo['font_family'] = $settings->hours_font['family'];
					unset( $settings->hours_font['family'] );
				}
				if ( isset( $settings->hours_font['weight'] ) ) {

					if ( 'regular' === $settings->hours_font['weight'] ) {
						$settings->hour_font_typo['font_weight'] = 'normal';
					} else {
						$settings->hour_font_typo['font_weight'] = $settings->hours_font['weight'];
					}
					unset( $settings->hours_font['weight'] );
				}
			}
			if ( isset( $settings->hours_new_font_size ) ) {

				$settings->hour_font_typo['font_size'] = array(
					'length' => $settings->hours_new_font_size,
					'unit'   => 'px',
				);
				unset( $settings->hours_new_font_size );
			}
			if ( isset( $settings->hours_new_font_size_medium ) ) {

				$settings->hour_font_typo_medium['font_size'] = array(
					'length' => $settings->hours_new_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->hours_new_font_size_medium );
			}
			if ( isset( $settings->hours_new_font_size_responsive ) ) {

				$settings->hour_font_typo_responsive['font_size'] = array(
					'length' => $settings->hours_new_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->hours_new_font_size_responsive );
			}
			if ( isset( $settings->hours_new_line_height ) ) {

				$settings->hour_font_typo['line_height'] = array(
					'length' => $settings->hours_new_line_height,
					'unit'   => 'em',
				);
				unset( $settings->hours_new_line_height );
			}
			if ( isset( $settings->hours_new_line_height_medium ) ) {
				$settings->hour_font_typo_medium['line_height'] = array(
					'length' => $settings->hours_new_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->hours_new_line_height_medium );
			}
			if ( isset( $settings->hours_new_line_height_responsive ) ) {
				$settings->hour_font_typo_responsive['line_height'] = array(
					'length' => $settings->hours_new_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->hours_new_line_height_responsive );
			}
			if ( isset( $settings->hours_transform ) ) {
				$settings->hour_font_typo['text_transform'] = $settings->hours_transform;
				unset( $settings->hours_transform );
			}
			if ( isset( $settings->hours_decoration ) ) {
				$settings->hour_font_typo['text_decoration'] = $settings->hours_decoration;
				unset( $settings->hours_decoration );
			}
			if ( isset( $settings->hours_letter_spacing ) ) {

				$settings->hour_font_typo['letter_spacing'] = array(
					'length' => $settings->hours_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->hours_letter_spacing );
			}
			if ( isset( $settings->hours_alignment ) ) {
				$settings->hour_font_typo['text_align'] = $settings->hours_alignment;
				unset( $settings->hours_alignment );
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-hours/uabb-business-hours-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-hours/uabb-business-hours-bb-less-than-2-2-compatibility.php';
}
