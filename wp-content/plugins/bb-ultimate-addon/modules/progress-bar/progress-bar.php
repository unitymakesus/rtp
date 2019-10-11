<?php
/**
 *  UABB Progress Bar Module file
 *
 *  @package UABB Progress Bar Module
 */

/**
 * Function that initializes UABB Progress Bar Module
 *
 * @class ProgressBarModule
 */
class ProgressBarModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Progress Bar Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Progress Bar', 'uabb' ),
				'description'     => __( 'Progress Bar', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/progress-bar/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/progress-bar/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'progress-bar.svg',
			)
		);

		$this->add_js( 'jquery-waypoints' );
	}

	/**
	 * Function to get the icon for the Progress Bar
	 *
	 * @method get_icon
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/progress-bar/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/progress-bar/icon/' . $icon;
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

			// Handle old border settings.
			if ( isset( $settings->border_color ) ) {

				$settings->progress_border = array();

				// Border style, color, and width.
				if ( isset( $settings->border_style ) ) {
					$settings->progress_border['style'] = $settings->border_style;
					unset( $settings->border_style );
				}
				if ( isset( $settings->border_color ) ) {
					$settings->progress_border['color'] = $settings->border_color;
					unset( $settings->border_color );
				}
				if ( isset( $settings->border_size ) ) {
					$settings->progress_border['width'] = array(
						'top'    => $settings->border_size,
						'right'  => $settings->border_size,
						'bottom' => $settings->border_size,
						'left'   => $settings->border_size,
					);

					unset( $settings->border_size );
				}
				// Border radius.
				if ( isset( $settings->border_radius ) ) {
					$settings->progress_border['radius'] = array(
						'top_left'     => $settings->border_radius,
						'top_right'    => $settings->border_radius,
						'bottom_left'  => $settings->border_radius,
						'bottom_right' => $settings->border_radius,
					);
					unset( $settings->border_radius );
				}
			}
			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );

			$helper->handle_opacity_inputs( $settings, 'gradient_color_opc', 'gradient_color' );

			// For Text Typo.
			if ( ! isset( $settings->text_typo ) || ! is_array( $settings->text_typo ) ) {

				$settings->text_typo            = array();
				$settings->text_typo_medium     = array();
				$settings->text_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) ) {
				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_typo['font_weight'] = 'normal';
					} else {
						$settings->text_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
			}
			if ( isset( $settings->text_font_size_unit ) ) {
				$settings->text_typo['font_size'] = array(
					'length' => $settings->text_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit );
			}
			if ( isset( $settings->text_font_size_unit_medium ) ) {

				$settings->text_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_medium );
			}
			if ( isset( $settings->text_font_size_unit_responsive ) ) {

				$settings->text_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_responsive );
			}
			if ( isset( $settings->text_line_height_unit ) ) {

				$settings->text_typo['line_height'] = array(
					'length' => $settings->text_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit );
			}
			if ( isset( $settings->text_line_height_unit_medium ) ) {

				$settings->text_typo_medium['line_height'] = array(
					'length' => $settings->text_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_medium );
			}
			if ( isset( $settings->text_line_height_unit_responsive ) ) {

				$settings->text_typo_responsive['line_height'] = array(
					'length' => $settings->text_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_responsive );
			}
			if ( isset( $settings->text_transform ) ) {
				$settings->text_typo['text_transform'] = $settings->text_transform;
				unset( $settings->text_transform );
			}
			if ( isset( $settings->text_letter_spacing ) ) {
				$settings->text_typo['letter_spacing'] = array(
					'length' => $settings->text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->text_letter_spacing );
			}
			// For Before/After Text Typo.
			if ( ! isset( $settings->before_after_typo ) || ! is_array( $settings->before_after_typo ) ) {

				$settings->before_after_typo            = array();
				$settings->before_after_typo_medium     = array();
				$settings->before_after_typo_responsive = array();
			}
			if ( isset( $settings->before_after_font_family ) ) {
				if ( isset( $settings->before_after_font_family['family'] ) ) {
					$settings->before_after_typo['font_family'] = $settings->before_after_font_family['family'];
					unset( $settings->before_after_font_family['family'] );
				}
				if ( isset( $settings->before_after_font_family['weight'] ) ) {
					if ( 'regular' == $settings->before_after_font_family['weight'] ) {
						$settings->before_after_typo['font_weight'] = 'normal';
					} else {
						$settings->before_after_typo['font_weight'] = $settings->before_after_font_family['weight'];
					}
					unset( $settings->before_after_font_family['weight'] );
				}
			}
			if ( isset( $settings->before_after_font_size_unit ) ) {

				$settings->before_after_typo['font_size'] = array(
					'length' => $settings->before_after_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->before_after_font_size_unit );
			}
			if ( isset( $settings->before_after_font_size_unit_medium ) ) {

				$settings->before_after_typo_medium['font_size'] = array(
					'length' => $settings->before_after_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->before_after_font_size_unit_medium );
			}
			if ( isset( $settings->before_after_font_size_unit_responsive ) ) {

				$settings->before_after_typo_responsive['font_size'] = array(
					'length' => $settings->before_after_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->before_after_font_size_unit_responsive );
			}
			if ( isset( $settings->before_after_line_height_unit ) ) {

				$settings->before_after_typo['line_height'] = array(
					'length' => $settings->before_after_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->before_after_line_height_unit );
			}
			if ( isset( $settings->before_after_line_height_unit_medium ) ) {

				$settings->before_after_typo_medium['line_height'] = array(
					'length' => $settings->before_after_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->before_after_line_height_unit_medium );
			}
			if ( isset( $settings->before_after_line_height_unit_responsive ) ) {

				$settings->before_after_typo_responsive['line_height'] = array(
					'length' => $settings->before_after_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->before_after_line_height_unit_responsive );
			}
			if ( isset( $settings->before_after_transform ) ) {

				$settings->before_after_typo['text_transform'] = $settings->before_after_transform;
				unset( $settings->before_after_transform );
			}
			if ( isset( $settings->before_after_letter_spacing ) ) {

				$settings->before_after_typo['letter_spacing'] = array(
					'length' => $settings->before_after_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->before_after_letter_spacing );
			}

			// For Progress Value Typo.
			if ( ! isset( $settings->number_typo ) || ! is_array( $settings->number_typo ) ) {

				$settings->number_typo            = array();
				$settings->number_typo_medium     = array();
				$settings->number_typo_responsive = array();
			}
			if ( isset( $settings->number_font_family ) ) {

				if ( isset( $settings->number_font_family['family'] ) ) {

					$settings->number_typo['font_family'] = $settings->number_font_family['family'];
					unset( $settings->number_font_family['family'] );
				}
				if ( isset( $settings->number_font_family['weight'] ) ) {

					if ( 'regular' == $settings->number_font_family['weight'] ) {
						$settings->number_typo['font_weight'] = 'normal';
					} else {
						$settings->number_typo['font_weight'] = $settings->number_font_family['weight'];
					}
					unset( $settings->number_font_family['weight'] );
				}
			}
			if ( isset( $settings->number_font_size_unit ) ) {

				$settings->number_typo['font_size'] = array(
					'length' => $settings->number_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->number_font_size_unit );
			}
			if ( isset( $settings->number_font_size_unit_medium ) ) {

				$settings->number_typo_medium['font_size'] = array(
					'length' => $settings->number_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->number_font_size_unit_medium );
			}
			if ( isset( $settings->number_font_size_unit_responsive ) ) {

				$settings->number_typo_responsive['font_size'] = array(
					'length' => $settings->number_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->number_font_size_unit_responsive );
			}
			if ( isset( $settings->number_line_height_unit ) ) {

				$settings->number_typo['line_height'] = array(
					'length' => $settings->number_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->number_line_height_unit );
			}
			if ( isset( $settings->number_line_height_unit_medium ) ) {

				$settings->number_typo_medium['line_height'] = array(
					'length' => $settings->number_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->number_line_height_unit_medium );
			}
			if ( isset( $settings->number_line_height_unit_responsive ) ) {

				$settings->number_typo_responsive['line_height'] = array(
					'length' => $settings->number_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->number_line_height_unit_responsive );
			}
			if ( isset( $settings->number_letter_spacing ) ) {

				$settings->number_typo['letter_spacing'] = array(
					'length' => $settings->number_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->number_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle old border settings.
			if ( isset( $settings->border_color ) ) {

				$settings->progress_border = array();

				if ( isset( $settings->border_style ) ) {
					$settings->progress_border['style'] = $settings->border_style;
					unset( $settings->border_style );
				}
				if ( isset( $settings->border_color ) ) {
					$settings->progress_border['color'] = $settings->border_color;
					unset( $settings->border_color );
				}
				if ( isset( $settings->border_size ) ) {
					$settings->progress_border['width'] = array(
						'top'    => $settings->border_size,
						'right'  => $settings->border_size,
						'bottom' => $settings->border_size,
						'left'   => $settings->border_size,
					);
					unset( $settings->border_size );
				}

				// Border radius.
				if ( isset( $settings->border_radius ) ) {
					$settings->progress_border['radius'] = array(
						'top_left'     => $settings->border_radius,
						'top_right'    => $settings->border_radius,
						'bottom_left'  => $settings->border_radius,
						'bottom_right' => $settings->border_radius,
					);
					unset( $settings->border_radius );
				}
			}

			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );

			$helper->handle_opacity_inputs( $settings, 'gradient_color_opc', 'gradient_color' );

			// For Text Typo.
			if ( ! isset( $settings->text_typo ) || ! is_array( $settings->text_typo ) ) {

				$settings->text_typo            = array();
				$settings->text_typo_medium     = array();
				$settings->text_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) ) {

				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_typo['font_weight'] = 'normal';
					} else {
						$settings->text_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
			}
			if ( isset( $settings->text_font_size['small'] ) ) {
				$settings->text_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['medium'] ) ) {
				$settings->text_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['desktop'] ) ) {
				$settings->text_typo['font_size'] = array(
					'length' => $settings->text_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_typo_responsive['line_height'] = array(
						'length' => round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_typo_medium['line_height'] = array(
						'length' => round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_typo['line_height'] = array(
						'length' => round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Before/After Text Typo.
			if ( ! isset( $settings->before_after_typo ) || ! is_array( $settings->before_after_typo ) ) {

				$settings->before_after_typo            = array();
				$settings->before_after_typo_medium     = array();
				$settings->before_after_typo_responsive = array();
			}
			if ( isset( $settings->before_after_font_family ) ) {

				if ( isset( $settings->before_after_font_family['family'] ) ) {
					$settings->before_after_typo['font_family'] = $settings->before_after_font_family['family'];
					unset( $settings->before_after_font_family['family'] );
				}
				if ( isset( $settings->before_after_font_family['weight'] ) ) {
					if ( 'regular' == $settings->before_after_font_family['weight'] ) {
						$settings->before_after_typo['font_weight'] = 'normal';
					} else {
						$settings->before_after_typo['font_weight'] = $settings->before_after_font_family['weight'];
					}
					unset( $settings->before_after_font_family['weight'] );
				}
			}

			if ( isset( $settings->before_after_font_size['small'] ) ) {
				$settings->before_after_typo_responsive['font_size'] = array(
					'length' => $settings->before_after_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->before_after_font_size['medium'] ) ) {
				$settings->before_after_typo_medium['font_size'] = array(
					'length' => $settings->before_after_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->before_after_font_size['desktop'] ) ) {
				$settings->before_after_typo['font_size'] = array(
					'length' => $settings->before_after_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->before_after_line_height['small'] ) && isset( $settings->before_after_font_size['small'] ) && 0 != $settings->before_after_font_size['small'] ) {
				if ( is_numeric( $settings->before_after_line_height['small'] ) && is_numeric( $settings->before_after_font_size['small'] ) ) {
					$settings->before_after_typo_responsive['line_height'] = array(
						'length' => round( $settings->before_after_line_height['small'] / $settings->before_after_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->before_after_line_height['medium'] ) && isset( $settings->before_after_font_size['medium'] ) && 0 != $settings->before_after_font_size['medium'] ) {
				if ( is_numeric( $settings->before_after_line_height['medium'] ) && is_numeric( $settings->before_after_font_size['medium'] ) ) {
					$settings->before_after_typo_medium['line_height'] = array(
						'length' => round( $settings->before_after_line_height['medium'] / $settings->before_after_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->before_after_line_height['desktop'] ) && isset( $settings->before_after_font_size['desktop'] ) && 0 != $settings->before_after_font_size['desktop'] ) {
				if ( is_numeric( $settings->before_after_line_height['desktop'] ) && is_numeric( $settings->before_after_font_size['desktop'] ) ) {
					$settings->before_after_typo['line_height'] = array(
						'length' => round( $settings->before_after_line_height['desktop'] / $settings->before_after_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Progress Value Typo.
			if ( ! isset( $settings->number_typo ) || ! is_array( $settings->number_typo ) ) {

				$settings->number_typo            = array();
				$settings->number_typo_medium     = array();
				$settings->number_typo_responsive = array();
			}
			if ( isset( $settings->number_font_family ) ) {
				if ( isset( $settings->number_font_family['family'] ) ) {

					$settings->number_typo['font_family'] = $settings->number_font_family['family'];
					unset( $settings->number_font_family['family'] );
				}
				if ( isset( $settings->number_font_family['weight'] ) ) {
					if ( 'regular' == $settings->number_font_family['weight'] ) {
						$settings->number_typo['font_weight'] = 'normal';
					} else {
						$settings->number_typo['font_weight'] = $settings->number_font_family['weight'];
					}
					unset( $settings->number_font_family['weight'] );
				}
			}
			if ( isset( $settings->number_font_size['small'] ) ) {
				$settings->number_typo_responsive['font_size'] = array(
					'length' => $settings->number_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->number_font_size['medium'] ) ) {
				$settings->number_typo_medium['font_size'] = array(
					'length' => $settings->number_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->number_font_size['desktop'] ) ) {
				$settings->number_typo['font_size'] = array(
					'length' => $settings->number_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->number_line_height['small'] ) && isset( $settings->number_font_size['small'] ) && 0 != $settings->number_font_size['small'] ) {
				if ( is_numeric( $settings->number_line_height['small'] ) && is_numeric( $settings->number_font_size['small'] ) ) {
					$settings->number_typo_responsive['line_height'] = array(
						'length' => round( $settings->number_line_height['small'] / $settings->number_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->number_line_height['medium'] ) && isset( $settings->number_font_size['medium'] ) && 0 != $settings->number_font_size['medium'] ) {
				if ( is_numeric( $settings->number_line_height['medium'] ) && is_numeric( $settings->number_font_size['medium'] ) ) {
					$settings->number_typo_medium['line_height'] = array(
						'length' => round( $settings->number_line_height['medium'] / $settings->number_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->number_line_height['desktop'] ) && isset( $settings->number_font_size['desktop'] ) && 0 != $settings->number_font_size['desktop'] ) {
				if ( is_numeric( $settings->number_line_height['desktop'] ) && is_numeric( $settings->number_font_size['desktop'] ) ) {
					$settings->number_typo['line_height'] = array(
						'length' => round( $settings->number_line_height['desktop'] / $settings->number_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			// Unset the old values.
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
			// Unset the old values.
			if ( isset( $settings->before_after_font_size['desktop'] ) ) {
				unset( $settings->before_after_font_size['desktop'] );
			}
			if ( isset( $settings->before_after_font_size['medium'] ) ) {
				unset( $settings->before_after_font_size['medium'] );
			}
			if ( isset( $settings->before_after_font_size['small'] ) ) {
				unset( $settings->before_after_font_size['small'] );
			}
			if ( isset( $settings->before_after_line_height['desktop'] ) ) {
				unset( $settings->before_after_line_height['desktop'] );
			}
			if ( isset( $settings->before_after_line_height['medium'] ) ) {
				unset( $settings->before_after_line_height['medium'] );
			}
			if ( isset( $settings->before_after_line_height['small'] ) ) {
				unset( $settings->before_after_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->number_font_size['desktop'] ) ) {
				unset( $settings->number_font_size['desktop'] );
			}
			if ( isset( $settings->number_font_size['medium'] ) ) {
				unset( $settings->number_font_size['medium'] );
			}
			if ( isset( $settings->number_font_size['small'] ) ) {
				unset( $settings->number_font_size['small'] );
			}
			if ( isset( $settings->number_line_height['desktop'] ) ) {
				unset( $settings->number_line_height['desktop'] );
			}
			if ( isset( $settings->number_line_height['medium'] ) ) {
				unset( $settings->number_line_height['medium'] );
			}
			if ( isset( $settings->number_line_height['small'] ) ) {
				unset( $settings->number_line_height['small'] );
			}
		}

		return $settings;
	}

	/**
	 * Function to render Horizontal Content
	 *
	 * @method render_horizontal_content
	 * @param object $obj gets the object for the content.
	 * @param string $style gets the value for various styles.
	 * @param var    $position gets the positon for the content.
	 * @param var    $i gets the value for the content.
	 */
	public function render_horizontal_content( $obj, $style = '', $position = '', $i ) {

		if ( $this->settings->horizontal_style == $style ) {
			if ( 'style4' == $style ) {
				if ( $this->settings->text_position == $position ) {

					echo '<div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                        <' . $this->settings->text_tag_selection . ' class="uabb-progress-title">' . $obj->horizontal_before_number . '</' . $this->settings->text_tag_selection . '>
                    </div>';
				}
			} elseif ( 'style3' != $style ) {

				echo '<div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                        <' . $this->settings->text_tag_selection . ' class="uabb-progress-title">' . $obj->horizontal_before_number . '</' . $this->settings->text_tag_selection . '>
                        <div class="uabb-progress-value">0%</div>
                    </div>';
			}
		}
	}

	/**
	 * Function to render Horizontal Progress Bar Content
	 *
	 * @method render_horizontal_progress_bar
	 * @param object $obj gets the object for the content.
	 * @param var    $i gets the value for the content.
	 */
	public function render_horizontal_progress_bar( $obj, $i ) {
		if ( 'style3' == $this->settings->horizontal_style ) {
			echo '<div class="uabb-progress-wrap">
                    <div class="uabb-progress-box">
                        <div class="uabb-progress-bar"></div>
                        <div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                            <' . $this->settings->text_tag_selection . ' class="uabb-progress-title">' . $obj->horizontal_before_number . '</' . $this->settings->text_tag_selection . '>
                            <div class="uabb-progress-value">0%</div>
                        </div>
                    </div>
                </div>';
		} elseif ( 'style4' == $this->settings->horizontal_style ) {
			echo '<div class="uabb-progress-wrap">
                    <div class="uabb-progress-box">
                        <div class="uabb-progress-bar"></div>
                        <div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                            <div class="uabb-progress-value"><span>0%</span></div>
                        </div>
                    </div>
                </div>';
		} else {
			echo '<div class="uabb-progress-wrap">
                    <div class="uabb-progress-box">
                        <div class="uabb-progress-bar"></div>
                    </div>
                </div>';
		}
	}

	/**
	 * Function to render Vertical Content
	 *
	 * @method render_vertical_content
	 * @param object $obj gets the object for the content.
	 * @param string $style gets the value for various styles.
	 * @param var    $i gets the value for the content.
	 */
	public function render_vertical_content( $obj, $style = '', $i ) {

		if ( $this->settings->vertical_style == $style ) {
			if ( 'style3' != $style ) {
				echo '<div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                        <' . $this->settings->text_tag_selection . ' class="uabb-progress-title">' . $obj->horizontal_before_number . '</' . $this->settings->text_tag_selection . '>
                        <div class="uabb-progress-value">0%</div>
                    </div>';
			} else {
				echo '<div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                        <' . $this->settings->text_tag_selection . ' class="uabb-progress-title">' . $obj->horizontal_before_number . '</' . $this->settings->text_tag_selection . '>
                    </div>';
			}
		}
	}

	/**
	 * Function to render Vertical Progree Bar Content
	 *
	 * @method render_vertical_progress_bar
	 * @param object $obj gets the object for the content.
	 * @param var    $i gets the value for the content.
	 */
	public function render_vertical_progress_bar( $obj, $i ) {
		if ( 'style3' == $this->settings->vertical_style ) {
			echo '<div class="uabb-progress-wrap">
                    <div class="uabb-progress-box">
                        <div class="uabb-progress-bar"></div>
                        <div class="uabb-progress-info uabb-progress-bar-info-' . $i . '">
                            <div class="uabb-progress-value">0%</div>
                        </div>
                    </div>
                </div>';
		} else {
			echo '<div class="uabb-progress-wrap">
                    <div class="uabb-progress-box">
                        <div class="uabb-progress-bar"></div>
                    </div>
                </div>';
		}
	}

	/**
	 * Function to render Circle Progree Bar Content
	 *
	 * @method render_circle_progress_bar
	 * @param object $obj gets the object for the content.
	 */
	public function render_circle_progress_bar( $obj ) {

		$obj->background_color = UABB_Helper::uabb_colorpicker( $obj, 'background_color', true );
		$obj->gradient_color   = UABB_Helper::uabb_colorpicker( $obj, 'gradient_color', true );

		$stroke_thickness = ( '' != $this->settings->stroke_thickness ) ? $this->settings->stroke_thickness : '10';
		$width            = ! empty( $this->settings->circular_thickness ) ? $this->settings->circular_thickness : 300;
		$pos              = ( $width / 2 );
		$radius           = $pos - 10;
		$dash             = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '' );

		$html = '<svg class="svg" viewBox="0 0 ' . $width . ' ' . $width . '" version="1.1" preserveAspectRatio="xMinYMin meet">
            <circle class="uabb-bar-bg" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill=" ' . $obj->background_color . ' " stroke-dasharray="' . $dash . '" stroke-dashoffset="0"></circle>
            <circle class="uabb-bar" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '" transform="rotate(-90.1 ' . $pos . ' ' . $pos . ')"></circle>
        </svg>';
		$txt  = '<svg class="svg" viewBox="0 0 ' . $width . ' ' . $width . '" version="1.1" preserveAspectRatio="xMinYMin meet">
            <circle class="uabb-bar-bg" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill=" ' . $obj->background_color . ' " stroke-dasharray="' . $dash . '" stroke-dashoffset="0" ></circle>
            <circle class="uabb-bar" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '"></circle>
        </svg>';

		echo $html;
	}

	/**
	 * Function to render Semi Circle Progree Bar Content
	 *
	 * @method render_semi_circle_progress_bar
	 * @param object $obj gets the object for the content.
	 */
	public function render_semi_circle_progress_bar( $obj ) {

		$obj->background_color = UABB_Helper::uabb_colorpicker( $obj, 'background_color', true );
		$obj->gradient_color   = UABB_Helper::uabb_colorpicker( $obj, 'gradient_color', true );

		$stroke_thickness = ( '' != $this->settings->stroke_thickness ) ? $this->settings->stroke_thickness : '10';
		$width            = ! empty( $this->settings->circular_thickness ) ? $this->settings->circular_thickness : 300;
		$pos              = ( $width / 2 );
		$radius           = $pos - ( $stroke_thickness / 2 );
		$dash             = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '' );

		$html = '<svg class="svg" viewBox="0 0 ' . $width . ' ' . $pos . '" version="1.1" preserveAspectRatio="xMinYMin meet">
            <circle class="uabb-bar-bg" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill=" ' . $obj->background_color . ' " stroke-dasharray="' . $dash . '" stroke-dashoffset="0"></circle>
            <circle class="uabb-bar" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '" transform="rotate(-180 ' . $pos . ' ' . $pos . ')"></circle>
        </svg>';
		echo $html;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/progress-bar/progress-bar-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/progress-bar/progress-bar-bb-less-than-2-2-compatibility.php';
}
