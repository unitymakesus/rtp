<?php
/**
 *  UABB Dual Button Module file
 *
 *  @package UABB Dual Button Module
 */

/**
 * Function that initializes UABB Dual Button Module
 *
 * @class UABBDualButtonModule
 */
class UABBDualButtonModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Dual Button module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Dual Button', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/dual-button/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/dual-button/',
				'partial_refresh' => true,
				'icon'            => 'button.svg',
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

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Handle opacity field.
			$helper->handle_opacity_inputs( $settings, '_btn_one_back_color_opc', '_btn_one_back_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_one_back_hover_color_opc', '_btn_one_back_hover_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_two_back_hover_color_opc', '_btn_two_back_hover_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_two_back_color_opc', '_btn_two_back_color' );
			$helper->handle_opacity_inputs( $settings, 'divider_background_color_opc', 'divider_background_color' );

			// For Dual Button one typo.
			if ( isset( $settings->dual_button_align ) ) {
				$settings->dual_button_align = $settings->dual_button_align;
			}
			if ( ! isset( $settings->_btn_one_typo ) || ! is_array( $settings->_btn_one_typo ) ) {

				$settings->_btn_one_typo            = array();
				$settings->_btn_one_typo_medium     = array();
				$settings->_btn_one_typo_responsive = array();
			}
			if ( isset( $settings->_btn_one_font_family ) ) {
				if ( 'regular' == $settings->_btn_one_font_family['weight'] ) {
					$settings->_btn_one_typo['font_weight'] = 'normal';
				} else {
					$settings->_btn_one_typo['font_weight'] = $settings->_btn_one_font_family['weight'];
				}
				$settings->_btn_one_typo['font_family'] = $settings->_btn_one_font_family['family'];

			}
			if ( isset( $settings->_btn_one_font_size_unit ) ) {
				$settings->_btn_one_typo['font_size'] = array(
					'length' => $settings->_btn_one_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_one_font_size_unit_medium ) ) {
				$settings->_btn_one_typo_medium['font_size'] = array(
					'length' => $settings->_btn_one_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_one_font_size_unit_responsive ) ) {
				$settings->_btn_one_typo_responsive['font_size'] = array(
					'length' => $settings->_btn_one_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_one_line_height_unit ) ) {

				$settings->_btn_one_typo['line_height'] = array(
					'length' => $settings->_btn_one_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_one_line_height_unit_medium ) ) {
				$settings->_btn_one_typo_medium['line_height'] = array(
					'length' => $settings->_btn_one_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_one_line_height_unit_responsive ) ) {
				$settings->_btn_one_typo_responsive['line_height'] = array(
					'length' => $settings->_btn_one_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_one_text_transform ) ) {
				$settings->_btn_one_typo['text_transform'] = $settings->_btn_one_text_transform;
			}
			if ( isset( $settings->_btn_one_text_letter_spacing ) ) {
				$settings->_btn_one_typo['letter_spacing'] = array(
					'length' => $settings->_btn_one_text_letter_spacing,
					'unit'   => 'px',
				);
			}
			// For Dual Button Two Typo.
			if ( ! isset( $settings->_btn_two_typo ) || ! is_array( $settings->_btn_two_typo ) ) {

				$settings->_btn_two_typo            = array();
				$settings->_btn_two_typo_medium     = array();
				$settings->_btn_two_typo_responsive = array();
			}
			if ( isset( $settings->_btn_two_font_family ) ) {
				if ( 'regular' == $settings->_btn_two_font_family['weight'] ) {
					$settings->_btn_two_typo['font_weight'] = 'normal';
				} else {
					$settings->_btn_two_typo['font_weight'] = $settings->_btn_two_font_family['weight'];
				}
				$settings->_btn_two_typo['font_family'] = $settings->_btn_two_font_family['family'];
			}
			if ( isset( $settings->_btn_two_font_size_unit ) ) {

				$settings->_btn_two_typo['font_size'] = array(
					'length' => $settings->_btn_two_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_two_font_size_unit_medium ) ) {
				$settings->_btn_two_typo_medium['font_size'] = array(
					'length' => $settings->_btn_two_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_two_font_size_unit_responsive ) ) {
				$settings->_btn_two_typo_responsive['font_size'] = array(
					'length' => $settings->_btn_two_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_two_line_height_unit ) ) {

				$settings->_btn_two_typo['line_height'] = array(
					'length' => $settings->_btn_two_line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_two_line_height_unit_medium ) ) {
				$settings->_btn_two_typo_medium['line_height'] = array(
					'length' => $settings->_btn_two_line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_two_line_height_unit_responsive ) ) {
				$settings->_btn_two_typo_responsive['line_height'] = array(
					'length' => $settings->_btn_two_line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->_btn_two_text_transform ) ) {

				$settings->_btn_two_typo['text_transform'] = $settings->_btn_two_text_transform;

			}
			if ( isset( $settings->_btn_two_text_letter_spacing ) ) {

				$settings->_btn_two_typo['letter_spacing'] = array(
					'length' => $settings->_btn_two_text_letter_spacing,
					'unit'   => 'px',
				);
			}

			// For Dual Button Separator.
			if ( ! isset( $settings->_divider_typo ) || ! is_array( $settings->_divider_typo ) ) {

				$settings->_divider_typo            = array();
				$settings->_divider_typo_medium     = array();
				$settings->_divider_typo_responsive = array();
			}
			if ( isset( $settings->_divider_font_family ) ) {
				if ( 'regular' == $settings->_divider_font_family['weight'] ) {
					$settings->_divider_typo['font_weight'] = 'normal';
				} else {
					$settings->_divider_typo['font_weight'] = $settings->_divider_font_family['weight'];
				}
				$settings->_divider_typo['font_family'] = $settings->_divider_font_family['family'];
			}
			if ( isset( $settings->_divider_font_size_unit ) ) {

				$settings->_divider_typo['font_size'] = array(
					'length' => $settings->_divider_font_size_unit,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_divider_font_size_unit_medium ) ) {
				$settings->_divider_typo_medium['font_size'] = array(
					'length' => $settings->_divider_font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_divider_font_size_unit_responsive ) ) {
				$settings->_divider_typo_responsive['font_size'] = array(
					'length' => $settings->_divider_font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_divider_transform ) ) {
				$settings->_divider_typo['text_transform'] = $settings->_divider_transform;
			}
			if ( isset( $settings->_divider_letter_spacing ) ) {

				$settings->_divider_typo['letter_spacing'] = array(
					'length' => $settings->_divider_letter_spacing,
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->_btn_one_font_family ) ) {
				unset( $settings->_btn_one_font_family );
				unset( $settings->_btn_one_font_size_unit );
				unset( $settings->_btn_one_font_size_unit_medium );
				unset( $settings->_btn_one_font_size_unit_responsive );
				unset( $settings->_btn_one_line_height_unit );
				unset( $settings->_btn_one_line_height_unit_medium );
				unset( $settings->_btn_one_line_height_unit_responsive );
				unset( $settings->_btn_one_text_transform );
				unset( $settings->_btn_one_text_letter_spacing );
			}
			if ( isset( $settings->_btn_two_font_family ) ) {
				unset( $settings->_btn_two_font_family );
				unset( $settings->_btn_two_font_size_unit );
				unset( $settings->_btn_two_font_size_unit_medium );
				unset( $settings->_btn_two_font_size_unit_responsive );
				unset( $settings->_btn_two_line_height_unit );
				unset( $settings->_btn_two_line_height_unit_medium );
				unset( $settings->_btn_two_line_height_unit_responsive );
				unset( $settings->_btn_two_text_transform );
				unset( $settings->_btn_two_text_letter_spacing );
			}
			if ( isset( $settings->_divider_font_family ) ) {
				unset( $settings->_divider_font_family );
				unset( $settings->_divider_font_size_unit );
				unset( $settings->_divider_font_size_unit_medium );
				unset( $settings->_divider_font_size_unit_responsive );
				unset( $settings->_divider_transform );
				unset( $settings->_divider_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle opacity field.
			$helper->handle_opacity_inputs( $settings, '_btn_one_back_color_opc', '_btn_one_back_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_one_back_hover_color_opc', '_btn_one_back_hover_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_two_back_hover_color_opc', '_btn_two_back_hover_color' );
			$helper->handle_opacity_inputs( $settings, '_btn_two_back_color_opc', '_btn_two_back_color' );
			$helper->handle_opacity_inputs( $settings, 'divider_background_color_opc', 'divider_background_color' );

			// For Dual Button one typo.
			if ( isset( $settings->dual_button_align ) ) {
				$settings->dual_button_align = $settings->dual_button_align;
			}
			if ( ! isset( $settings->_btn_one_typo ) || ! is_array( $settings->_btn_one_typo ) ) {

				$settings->_btn_one_typo            = array();
				$settings->_btn_one_typo_medium     = array();
				$settings->_btn_one_typo_responsive = array();
			}
			if ( isset( $settings->_btn_one_font_family ) ) {

				if ( 'regular' == $settings->_btn_one_font_family['weight'] ) {
					$settings->_btn_one_typo['font_weight'] = 'normal';
				} else {
					$settings->_btn_one_typo['font_weight'] = $settings->_btn_one_font_family['weight'];
				}
				$settings->_btn_one_typo['font_family'] = $settings->_btn_one_font_family['family'];
			}

			if ( isset( $settings->_btn_one_font_size['small'] ) ) {
				$settings->_btn_one_typo['font_size'] = array(
					'length' => $settings->_btn_one_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_one_font_size['medium'] ) ) {
				$settings->_btn_one_typo_medium['font_size'] = array(
					'length' => $settings->_btn_one_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_one_font_size['desktop'] ) ) {
				$settings->_btn_one_typo['font_size'] = array(
					'length' => $settings->_btn_one_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->_btn_one_line_height['small'] ) && isset( $settings->_btn_one_font_size['small'] ) && 0 != $settings->_btn_one_font_size['small'] ) {
				if ( is_numeric( $settings->_btn_one_line_height['small'] ) && is_numeric( $settings->_btn_one_font_size['small'] ) ) {
					$settings->_btn_one_typo_responsive['line_height'] = array(
						'length' => round( $settings->_btn_one_line_height['small'] / $settings->_btn_one_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->_btn_one_line_height['medium'] ) && isset( $settings->_btn_one_font_size['medium'] ) && 0 != $settings->_btn_one_font_size['medium'] ) {
				if ( is_numeric( $settings->_btn_one_line_height['medium'] ) && is_numeric( $settings->_btn_one_font_size['medium'] ) ) {
					$settings->_btn_one_typo_medium['line_height'] = array(
						'length' => round( $settings->_btn_one_line_height['medium'] / $settings->_btn_one_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->_btn_one_line_height['desktop'] ) && isset( $settings->_btn_one_font_size['desktop'] ) && 0 != $settings->_btn_one_font_size['desktop'] ) {
				if ( is_numeric( $settings->_btn_one_line_height['desktop'] ) && is_numeric( $settings->_btn_one_font_size['desktop'] ) ) {
					$settings->_btn_one_typo['line_height'] = array(
						'length' => round( $settings->_btn_one_line_height['desktop'] / $settings->_btn_one_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Dual Button Two Typo.
			if ( ! isset( $settings->_btn_two_typo ) || ! is_array( $settings->_btn_two_typo ) ) {

				$settings->_btn_two_typo            = array();
				$settings->_btn_two_typo_medium     = array();
				$settings->_btn_two_typo_responsive = array();
			}
			if ( isset( $settings->_btn_two_font_family ) ) {

				if ( 'regular' == $settings->_btn_two_font_family['weight'] ) {
					$settings->_btn_two_typo['font_weight'] = 'normal';
				} else {
					$settings->_btn_two_typo['font_weight'] = $settings->_btn_two_font_family['weight'];
				}
				$settings->_btn_two_typo['font_family'] = $settings->_btn_two_font_family['family'];
			}

			if ( isset( $settings->_btn_two_font_size['small'] ) ) {
				$settings->_btn_two_typo_responsive['font_size'] = array(
					'length' => $settings->_btn_two_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_two_font_size['medium'] ) ) {
				$settings->_btn_two_typo_medium['font_size'] = array(
					'length' => $settings->_btn_two_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_btn_two_font_size['desktop'] ) ) {
				$settings->_btn_two_typo['font_size'] = array(
					'length' => $settings->_btn_two_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->_btn_two_line_height['small'] ) && isset( $settings->_btn_two_font_size['small'] ) && 0 != $settings->_btn_two_font_size['small'] ) {
				if ( is_numeric( $settings->_btn_two_line_height['small'] ) && is_numeric( $settings->_btn_two_font_size['small'] ) ) {
					$settings->_btn_two_typo['line_height'] = array(
						'length' => round( $settings->_btn_two_line_height['small'] / $settings->_btn_two_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->_btn_two_line_height['medium'] ) && isset( $settings->_btn_two_font_size['medium'] ) && 0 != $settings->_btn_two_font_size['medium'] ) {
				if ( is_numeric( $settings->_btn_two_line_height['medium'] ) && is_numeric( $settings->_btn_two_font_size['medium'] ) ) {
					$settings->_btn_two_typo_medium['line_height'] = array(
						'length' => round( $settings->_btn_two_line_height['medium'] / $settings->_btn_two_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->_btn_two_line_height['desktop'] ) && isset( $settings->_btn_two_font_size['desktop'] ) && 0 != $settings->_btn_two_font_size['desktop'] ) {
				if ( is_numeric( $settings->_btn_two_line_height['desktop'] ) && is_numeric( $settings->_btn_two_font_size['desktop'] ) ) {
					$settings->_btn_two_typo['line_height'] = array(
						'length' => round( $settings->_btn_two_line_height['desktop'] / $settings->_btn_two_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Dual Button Separator.
			if ( ! isset( $settings->_divider_typo ) || ! is_array( $settings->_divider_typo ) ) {

				$settings->_divider_typo            = array();
				$settings->_divider_typo_medium     = array();
				$settings->_divider_typo_responsive = array();
			}
			if ( isset( $settings->_divider_font_family ) ) {
				if ( 'regular' == $settings->_divider_font_family['weight'] ) {
					$settings->_divider_typo['font_weight'] = 'normal';
				} else {
					$settings->_divider_typo['font_weight'] = $settings->_divider_font_family['weight'];
				}
				$settings->_divider_typo['font_family'] = $settings->_divider_font_family['family'];

			}
			if ( isset( $settings->_divider_font_size['small'] ) ) {
				$settings->_divider_typo_responsive['font_size'] = array(
					'length' => $settings->_divider_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_divider_font_size['medium'] ) ) {

				$settings->_divider_typo_medium['font_size'] = array(
					'length' => $settings->_divider_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->_divider_font_size['desktop'] ) ) {
				$settings->_divider_typo['font_size'] = array(
					'length' => $settings->_divider_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->_btn_one_font_family ) ) {
				unset( $settings->_btn_one_font_family );
				unset( $settings->_btn_one_font_size );
				unset( $settings->_btn_one_line_height );
			}
			if ( isset( $settings->_btn_two_font_family ) ) {
				unset( $settings->_btn_two_font_family );
				unset( $settings->_btn_two_font_size );
				unset( $settings->_btn_two_line_height );
			}
			if ( isset( $settings->_divider_font_family ) ) {
				unset( $settings->_divider_font_family );
				unset( $settings->_divider_font_size );
			}
		}
		return $settings;
	}

	/**
	 * Function that renders own Image Icon
	 *
	 * @param array $image_icon_arr gets an array for the own icon.
	 */
	function render_own_imgicon( $image_icon_arr ) {
		$image_icon_arr = (object) $image_icon_arr;
		$output         = '';
		if ( 'none' != $image_icon_arr->image_type ) {
			$output = '<div class="uabb-imgicon-wrap">';
			if ( 'icon' == $image_icon_arr->image_type ) {
				$output .= '<span class="uabb-icon-wrap">';
				$output .= '<span class="uabb-icon">';
				$output .= '<i class="' . $image_icon_arr->icon . '"></i>';
				$output .= '</span>';
				$output .= '</span>';
			} // Icon Html End.

			if ( 'photo' == $image_icon_arr->image_type ) { // Photo Html.
				$src     = isset( $image_icon_arr->photo_src ) ? $image_icon_arr->photo_src : '';
				$output .= '<div class="uabb-image-simple">';
				$output .= '<div class="uabb-image-content">';
				$output .= '<img class="uabb-img-src" src="' . $src . '"/>';
				$output .= '</div>';
				$output .= '</div>';

			} // Photo Html End.
			$output .= '</div>'; /* End Module Wrap */
			echo $output;
		}
	}

	/**
	 * Function that renders Image Icon
	 *
	 * @param array $image_icon_arr gets an array for the Image icon.
	 */
	function render_image_icon( $image_icon_arr ) {
		$image_icon_arr  = (object) $image_icon_arr;
		$imageicon_array = array(

			/* General Section */
			'image_type'            => $image_icon_arr->image_type,

			/* Icon Basics */
			'icon'                  => $image_icon_arr->icon,
			'icon_size'             => '30',
			'icon_align'            => 'center',

			/* Image Basics */
			'photo_source'          => $image_icon_arr->photo_source,
			'photo'                 => $image_icon_arr->photo,
			'photo_url'             => $image_icon_arr->photo_url,
			'img_size'              => '30',
			'img_align'             => 'center',
			'photo_src'             => ( isset( $image_icon_arr->photo_src ) ) ? $image_icon_arr->photo_src : '',

			/* Icon Style */
			'icon_style'            => '',
			'icon_bg_size'          => '',
			'icon_border_style'     => '',
			'icon_border_width'     => '',
			'icon_bg_border_radius' => '0',

			/* Image Style */
			'image_style'           => '',
			'img_bg_size'           => '',
			'img_border_style'      => '',
			'img_border_width'      => '',
			'img_bg_border_radius'  => '0',
		);
		/* Render HTML Function */
		FLBuilder::render_module_html( 'image-icon', $imageicon_array );
	}

	/**
	 * Function that renders Image Icon CSS
	 *
	 * @param int   $id gets an integer for the id.
	 * @param array $image_icon_arr gets an array for the Image icon's CSS.
	 */
	function render_image_icon_css( $id, $image_icon_arr ) {
		$image_icon_arr  = (object) $image_icon_arr;
		$imageicon_array = array(

			/* General Section */
			'image_type'              => $image_icon_arr->image_type,

			/* Icon Basics */
			'icon'                    => $image_icon_arr->icon,
			'icon_size'               => $image_icon_arr->icon_size,
			'icon_align'              => 'center',

			/* Image Basics */
			'photo_source'            => $image_icon_arr->photo_source,
			'photo'                   => $image_icon_arr->photo,
			'photo_url'               => $image_icon_arr->photo_url,
			'img_size'                => $image_icon_arr->img_size,
			'img_align'               => 'center',
			'photo_src'               => ( isset( $image_icon_arr->photo_src ) ) ? $image_icon_arr->photo_src : '',

			/* Icon Style */
			'icon_style'              => '',
			'icon_bg_size'            => '',
			'icon_border_style'       => '',
			'icon_border_width'       => '',
			'icon_bg_border_radius'   => '0',

			/* Image Style */
			'image_style'             => '',
			'img_bg_size'             => '',
			'img_border_style'        => '',
			'img_border_width'        => '',
			'img_bg_border_radius'    => '0',

			/* Icon Colors */
			'icon_color'              => $image_icon_arr->icon_color,
			'icon_hover_color'        => $image_icon_arr->icon_hover_color,
			'icon_bg_color'           => '',
			'icon_bg_hover_color'     => '',
			'icon_border_color'       => '',
			'icon_border_hover_color' => '',
			'icon_three_d'            => '',

			/* Image Colors */
			'img_bg_color'            => '',
			'img_bg_hover_color'      => '',
			'img_border_color'        => '',
			'img_border_hover_color'  => '',
		);
		/* CSS Render Function */
		FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/dual-button/dual-button-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/dual-button/dual-button-bb-less-than-2-2-compatibility.php';
}
