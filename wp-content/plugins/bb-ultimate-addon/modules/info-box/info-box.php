<?php
/**
 *  UABB Info Box Module file
 *
 *  @package UABB Info Box Module
 */

/**
 * Function that initializes Info Box Module
 *
 * @class UABBInfoBoxModule
 */
class UABBInfoBoxModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Info Box Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Info Box', 'uabb' ),
				'description'     => __( 'A heading and snippet of text with an optional link, icon and image.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/info-box/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/info-box/',
				'partial_refresh' => true,
				'icon'            => 'info-box.svg',
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

			// Handling opacity field.
			$helper->handle_opacity_inputs( $settings, 'icon_bg_color_opc', 'icon_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'icon_bg_hover_color_opc', 'icon_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );

			// For title prefix typography settings.
			if ( ! isset( $settings->prefix_font_typo ) || ! is_array( $settings->prefix_font_typo ) ) {

				$settings->prefix_font_typo            = array();
				$settings->prefix_font_typo_medium     = array();
				$settings->prefix_font_typo_responsive = array();
			}
			if ( isset( $settings->prefix_font_family ) ) {

				if ( isset( $settings->prefix_font_family['family'] ) ) {

					$settings->prefix_font_typo['font_family'] = $settings->prefix_font_family['family'];
					unset( $settings->prefix_font_family['family'] );
				}
				if ( isset( $settings->prefix_font_family['weight'] ) ) {

					if ( 'regular' == $settings->prefix_font_family['weight'] ) {
						$settings->prefix_font_typo['font_weight'] = 'normal';
					} else {
						$settings->prefix_font_typo['font_weight'] = $settings->prefix_font_family['weight'];
					}
					unset( $settings->prefix_font_family['weight'] );
				}
			}
			if ( isset( $settings->prefix_font_size_unit ) ) {
				$settings->prefix_font_typo['font_size'] = array(
					'length' => $settings->prefix_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->prefix_font_size_unit );
			}
			if ( isset( $settings->prefix_font_size_unit_medium ) ) {
				$settings->prefix_font_typo_medium['font_size'] = array(
					'length' => $settings->prefix_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->prefix_font_size_unit_medium );
			}
			if ( isset( $settings->prefix_font_size_unit_responsive ) ) {
				$settings->prefix_font_typo_responsive['font_size'] = array(
					'length' => $settings->prefix_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->prefix_font_size_unit_responsive );
			}
			if ( isset( $settings->prefix_line_height_unit ) ) {

				$settings->prefix_font_typo['line_height'] = array(
					'length' => $settings->prefix_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->prefix_line_height_unit );
			}
			if ( isset( $settings->prefix_line_height_unit_medium ) ) {
				$settings->prefix_font_typo_medium['line_height'] = array(
					'length' => $settings->prefix_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->prefix_line_height_unit_medium );
			}
			if ( isset( $settings->prefix_line_height_unit_responsive ) ) {
				$settings->prefix_font_typo_responsive['line_height'] = array(
					'length' => $settings->prefix_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->prefix_line_height_unit_responsive );
			}
			if ( isset( $settings->prefix_transform ) ) {
				$settings->prefix_font_typo['text_transform'] = $settings->prefix_transform;
				unset( $settings->prefix_transform );
			}
			if ( isset( $settings->prefix_letter_spacing ) ) {
				$settings->prefix_font_typo['letter_spacing'] = array(
					'length' => $settings->prefix_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->prefix_letter_spacing );
			}

			// For title typography settings.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {

				if ( isset( $settings->title_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {

					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size_unit ) ) {

				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit );
			}
			if ( isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_medium );
			}
			if ( isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_responsive );
			}
			if ( isset( $settings->title_line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit );
			}

			if ( isset( $settings->title_line_height_unit_medium ) ) {

				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_medium );
			}

			if ( isset( $settings->title_line_height_unit_responsive ) ) {

				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_responsive );
			}
			if ( isset( $settings->title_transform ) ) {

				$settings->title_font_typo['text_transform'] = $settings->title_transform;
				unset( $settings->title_transform );
			}
			if ( isset( $settings->title_letter_spacing ) ) {

				$settings->title_font_typo['letter_spacing'] = array(
					'length' => $settings->title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->title_letter_spacing );
			}

			// For description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->subhead_font_family ) ) {

				if ( isset( $settings->subhead_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->subhead_font_family['family'];
					unset( $settings->subhead_font_family['family'] );
				}
				if ( isset( $settings->subhead_font_family['weight'] ) ) {

					if ( 'regular' == $settings->subhead_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->subhead_font_family['weight'];
					}
					unset( $settings->subhead_font_family['weight'] );
				}
			}
			if ( isset( $settings->subhead_font_size_unit ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->subhead_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit );
			}
			if ( isset( $settings->subhead_font_size_unit_medium ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->subhead_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit_medium );
			}
			if ( isset( $settings->subhead_font_size_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->subhead_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit_responsive );
			}
			if ( isset( $settings->subhead_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->subhead_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit );
			}
			if ( isset( $settings->subhead_line_height_unit_medium ) ) {
				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->subhead_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit_medium );
			}
			if ( isset( $settings->subhead_line_height_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->subhead_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit_responsive );
			}
			if ( isset( $settings->subhead_transform ) ) {
				$settings->desc_font_typo['text_transform'] = $settings->subhead_transform;
				unset( $settings->subhead_transform );
			}
			if ( isset( $settings->subhead_letter_spacing ) ) {

				$settings->desc_font_typo['letter_spacing'] = array(
					'length' => $settings->subhead_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->subhead_letter_spacing );
			}

			// For CTA Link typography settings.
			if ( ! isset( $settings->cta_link_font_typo ) || ! is_array( $settings->cta_link_font_typo ) ) {

				$settings->cta_link_font_typo            = array();
				$settings->cta_link_font_typo_medium     = array();
				$settings->cta_link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {

				if ( isset( $settings->link_font_family['family'] ) ) {

					$settings->cta_link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset( $settings->link_font_family['family'] );
				}
				if ( isset( $settings->link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->link_font_family['weight'] ) {
						$settings->cta_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->cta_link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
			}
			if ( isset( $settings->link_font_size_unit ) ) {

				$settings->cta_link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit );
			}
			if ( isset( $settings->link_font_size_unit_medium ) ) {
				$settings->cta_link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_medium );
			}
			if ( isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->cta_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_responsive );
			}
			if ( isset( $settings->link_line_height_unit ) ) {

				$settings->cta_link_font_typo['line_height'] = array(
					'length' => $settings->link_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit );
			}
			if ( isset( $settings->link_line_height_unit_medium ) ) {
				$settings->cta_link_font_typo_medium['line_height'] = array(
					'length' => $settings->link_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_medium );
			}
			if ( isset( $settings->link_line_height_unit_responsive ) ) {
				$settings->cta_link_font_typo_responsive['line_height'] = array(
					'length' => $settings->link_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_responsive );
			}
			if ( isset( $settings->link_transform ) ) {
				$settings->cta_link_font_typo['text_transform'] = $settings->link_transform;
				unset( $settings->link_transform );
			}
			if ( isset( $settings->link_letter_spacing ) ) {
				$settings->cta_link_font_typo['letter_spacing'] = array(
					'length' => $settings->link_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->link_letter_spacing );
			}

			// For button typography settings.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->button_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->button_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->button_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->button_font_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {
				$settings->button_font_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {
				$settings->button_font_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {
				$settings->button_font_typo['text_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {
				$settings->button_font_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}
			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' == $settings->btn_link_nofollow || 'yes' == $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' == $settings->link_nofollow || 'yes' == $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handling opacity field.
			$helper->handle_opacity_inputs( $settings, 'icon_bg_color_opc', 'icon_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'icon_bg_hover_color_opc', 'icon_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );

			// For title prefix typography settings.
			if ( ! isset( $settings->prefix_font_typo ) || ! is_array( $settings->prefix_font_typo ) ) {

				$settings->prefix_font_typo            = array();
				$settings->prefix_font_typo_medium     = array();
				$settings->prefix_font_typo_responsive = array();
			}
			if ( isset( $settings->prefix_font_family ) ) {

				if ( isset( $settings->prefix_font_family['family'] ) ) {

					$settings->prefix_font_typo['font_family'] = $settings->prefix_font_family['family'];
					unset( $settings->prefix_font_family['family'] );
				}
				if ( isset( $settings->prefix_font_family['weight'] ) ) {

					if ( 'regular' == $settings->prefix_font_family['weight'] ) {
						$settings->prefix_font_typo['font_weight'] = 'normal';
					} else {
						$settings->prefix_font_typo['font_weight'] = $settings->prefix_font_family['weight'];
					}
					unset( $settings->prefix_font_family['weight'] );
				}
			}
			if ( isset( $settings->prefix_font_size['small'] ) && ! isset( $settings->prefix_font_typo_responsive['font_size'] ) ) {

				$settings->prefix_font_typo_responsive['font_size'] = array(
					'length' => $settings->prefix_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->prefix_font_size['medium'] ) && ! isset( $settings->prefix_font_typo_medium['font_size'] ) ) {

				$settings->prefix_font_typo_medium['font_size'] = array(
					'length' => $settings->prefix_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->prefix_font_size['desktop'] ) && ! isset( $settings->prefix_font_typo['font_size'] ) ) {

				$settings->prefix_font_typo['font_size'] = array(
					'length' => $settings->prefix_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->prefix_line_height['desktop'] ) && isset( $settings->prefix_font_size['desktop'] ) && 0 != $settings->prefix_font_size['desktop'] && ! isset( $settings->prefix_font_typo['line_height'] ) ) {

				if ( is_numeric( $settings->prefix_line_height['desktop'] ) && is_numeric( $settings->prefix_font_size['desktop'] ) ) {

					$settings->prefix_font_typo['line_height'] = array(
						'length' => round( $settings->prefix_line_height['desktop'] / $settings->prefix_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->prefix_line_height['medium'] ) && isset( $settings->prefix_font_size['medium'] ) && 0 != $settings->prefix_font_size['medium'] && ! isset( $settings->prefix_font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->prefix_line_height['medium'] ) && is_numeric( $settings->prefix_font_size['medium'] ) ) {
					$settings->prefix_font_typo_medium['line_height'] = array(
						'length' => round( $settings->prefix_line_height['medium'] / $settings->prefix_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->prefix_line_height['small'] ) && isset( $settings->prefix_font_size['small'] ) && 0 != $settings->prefix_font_size['small'] && ! isset( $settings->prefix_font_typo_responsive['line_height'] ) ) {

				if ( is_numeric( $settings->prefix_line_height['small'] ) && is_numeric( $settings->prefix_font_size['small'] ) ) {
					$settings->prefix_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->prefix_line_height['small'] / $settings->prefix_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For title typography settings.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {

				if ( isset( $settings->title_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {

					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_typo['font_size'] ) ) {

				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_typo_medium['font_size'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_typo_responsive['font_size'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {

					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {

					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {

				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->subhead_font_family ) ) {

				if ( isset( $settings->subhead_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->subhead_font_family['family'];
					unset( $settings->subhead_font_family['family'] );
				}
				if ( isset( $settings->subhead_font_family['weight'] ) ) {

					if ( 'regular' == $settings->subhead_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->subhead_font_family['weight'];
					}
					unset( $settings->subhead_font_family['weight'] );
				}
			}
			if ( isset( $settings->subhead_font_size['desktop'] ) && ! isset( $settings->desc_font_typo['font_size'] ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->subhead_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subhead_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->subhead_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subhead_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->subhead_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subhead_line_height['desktop'] ) && isset( $settings->subhead_font_size['desktop'] ) && 0 != $settings->subhead_font_size['desktop'] && ! isset( $settings->subhead_line_height_unit ) ) {
				if ( is_numeric( $settings->subhead_line_height['desktop'] ) && is_numeric( $settings->subhead_font_size['desktop'] ) ) {

					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->subhead_line_height['desktop'] / $settings->subhead_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subhead_line_height['medium'] ) && isset( $settings->subhead_font_size['medium'] ) && 0 != $settings->subhead_font_size['medium'] && ! isset( $settings->subhead_line_height_unit_medium ) ) {

				if ( is_numeric( $settings->subhead_line_height['medium'] ) && is_numeric( $settings->subhead_font_size['medium'] ) ) {

					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->subhead_line_height['medium'] / $settings->subhead_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subhead_line_height['small'] ) && isset( $settings->subhead_font_size['small'] ) && 0 != $settings->subhead_font_size['small'] && ! isset( $settings->subhead_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->subhead_line_height['small'] ) && is_numeric( $settings->subhead_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->subhead_line_height['small'] / $settings->subhead_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For CTA text link typography settings.
			if ( ! isset( $settings->cta_link_font_typo ) || ! is_array( $settings->cta_link_font_typo ) ) {

				$settings->cta_link_font_typo            = array();
				$settings->cta_link_font_typo_medium     = array();
				$settings->cta_link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {

				if ( isset( $settings->link_font_family['family'] ) ) {

					$settings->cta_link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset( $settings->link_font_family['family'] );
				}
				if ( isset( $settings->link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->link_font_family['weight'] ) {
						$settings->cta_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->cta_link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->cta_link_font_typo['font_size'] ) ) {
				$settings->cta_link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->cta_link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->cta_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->cta_link_font_typo['line_height'] = array(
						'length' => round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->cta_link_font_typo_medium['line_height'] = array(
						'length' => round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->cta_link_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For button typography settings.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->button_font_typo['font_size'] ) ) {
				$settings->button_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->button_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->button_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {

					$settings->button_font_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {

					$settings->button_font_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->button_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' == $settings->btn_link_nofollow || 'yes' == $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' == $settings->link_nofollow || 'yes' == $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->info_box_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->info_box_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->info_box_padding_dimension_top    = '';
				$settings->info_box_padding_dimension_bottom = '';
				$settings->info_box_padding_dimension_left   = '';
				$settings->info_box_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->info_box_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->info_box_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->info_box_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->info_box_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->info_box_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->info_box_padding );
			}
			if ( isset( $settings->prefix_font_size['desktop'] ) ) {
				unset( $settings->prefix_font_size['desktop'] );
			}
			if ( isset( $settings->prefix_font_size['medium'] ) ) {
				unset( $settings->prefix_font_size['medium'] );
			}
			if ( isset( $settings->prefix_font_size['small'] ) ) {
				unset( $settings->prefix_font_size['small'] );
			}
			if ( isset( $settings->prefix_line_height['desktop'] ) ) {
				unset( $settings->prefix_line_height['desktop'] );
			}
			if ( isset( $settings->prefix_line_height['medium'] ) ) {
				unset( $settings->prefix_line_height['medium'] );
			}
			if ( isset( $settings->prefix_line_height['small'] ) ) {
				unset( $settings->prefix_line_height['small'] );
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				unset( $settings->title_font_size['desktop'] );
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				unset( $settings->title_font_size['medium'] );
			}
			if ( isset( $settings->title_font_size['small'] ) ) {
				unset( $settings->title_font_size['small'] );
			}
			if ( isset( $settings->title_line_height['desktop'] ) ) {
				unset( $settings->title_line_height['desktop'] );
			}
			if ( isset( $settings->title_line_height['medium'] ) ) {
				unset( $settings->title_line_height['medium'] );
			}
			if ( isset( $settings->title_line_height['small'] ) ) {
				unset( $settings->title_line_height['small'] );
			}
			if ( isset( $settings->subhead_font_size['desktop'] ) ) {
				unset( $settings->subhead_font_size['desktop'] );
			}
			if ( isset( $settings->subhead_font_size['medium'] ) ) {
				unset( $settings->subhead_font_size['medium'] );
			}
			if ( isset( $settings->subhead_font_size['small'] ) ) {
				unset( $settings->subhead_font_size['small'] );
			}
			if ( isset( $settings->subhead_line_height['desktop'] ) ) {
				unset( $settings->subhead_line_height['desktop'] );
			}
			if ( isset( $settings->subhead_line_height['medium'] ) ) {
				unset( $settings->subhead_line_height['medium'] );
			}
			if ( isset( $settings->subhead_line_height['small'] ) ) {
				unset( $settings->subhead_line_height['small'] );
			}
			if ( isset( $settings->link_font_size['desktop'] ) ) {
				unset( $settings->link_font_size['desktop'] );
			}
			if ( isset( $settings->link_font_size['medium'] ) ) {
				unset( $settings->link_font_size['medium'] );
			}
			if ( isset( $settings->link_font_size['small'] ) ) {
				unset( $settings->link_font_size['small'] );
			}
			if ( isset( $settings->link_line_height['desktop'] ) ) {
				unset( $settings->link_line_height['desktop'] );
			}
			if ( isset( $settings->link_line_height['medium'] ) ) {
				unset( $settings->link_line_height['medium'] );
			}
			if ( isset( $settings->link_line_height['small'] ) ) {
				unset( $settings->link_line_height['small'] );
			}
			if ( isset( $settings->btn_font_size ) ) {
				unset( $settings->btn_font_size );
			}
			if ( isset( $settings->btn_line_height ) ) {
				unset( $settings->btn_line_height );
			}
		}

		return $settings;
	}
	/**
	 * Function to get the icon for the Info Box
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/info-box/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/info-box/icon/' . $icon;
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
	 * Function that gets the classname
	 *
	 * @method get_classname
	 */
	public function get_classname() {
		$classname = '';
		if ( 'photo' == $this->settings->image_type ) {
			if ( 'above-title' == $this->settings->img_icon_position || 'below-title' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-' . $this->settings->align;
				if ( '' != $this->settings->mobile_align ) {
					$classname .= ' infobox-responsive-' . $this->settings->mobile_align;
				}
			}

			if ( 'left-title' == $this->settings->img_icon_position || 'left' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-left';
			}
			if ( 'right-title' == $this->settings->img_icon_position || 'right' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-right';
			}
			$classname .= ' infobox-has-photo infobox-photo-' . $this->settings->img_icon_position;
		} elseif ( 'icon' == $this->settings->image_type ) {
			if ( 'above-title' == $this->settings->img_icon_position || 'below-title' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-' . $this->settings->align;
				if ( '' != $this->settings->mobile_align ) {
					$classname .= ' infobox-responsive-' . $this->settings->mobile_align;
				}
			}

			if ( 'left-title' == $this->settings->img_icon_position || 'left' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-left';
			}
			if ( 'right-title' == $this->settings->img_icon_position || 'right' == $this->settings->img_icon_position ) {
				$classname = 'uabb-infobox infobox-right';
			}
			$classname .= ' infobox-has-icon infobox-icon-' . $this->settings->img_icon_position;
		} else {
			$classname = 'uabb-infobox infobox-' . $this->settings->align;
			if ( '' != $this->settings->mobile_align ) {
				$classname .= ' infobox-responsive-' . $this->settings->mobile_align;
			}
		}

		return $classname;
	}

	/**
	 * Function that renders the title
	 *
	 * @method render_title
	 */
	public function render_title() {
		$flag = false;
		if ( ( 'photo' == $this->settings->image_type && 'left-title' == $this->settings->img_icon_position ) || ( 'icon' == $this->settings->image_type && 'left-title' == $this->settings->img_icon_position ) ) {
			echo '<div class="left-title-image">';
			$flag = true;
		}
		if ( ( 'photo' == $this->settings->image_type && 'right-title' == $this->settings->img_icon_position ) || ( 'icon' == $this->settings->image_type && 'right-title' == $this->settings->img_icon_position ) ) {
			echo '<div class="right-title-image">';
			$flag = true;
		}
		$this->render_image( 'left-title' );
		echo "<div class='uabb-infobox-title-wrap'>";
		if ( '' != $this->settings->heading_prefix ) {
			echo '<' . $this->settings->prefix_tag_selection . ' class="uabb-infobox-title-prefix">' . $this->settings->heading_prefix . '</' . $this->settings->prefix_tag_selection . '>';
		}

		if ( ! empty( $this->settings->title ) ) {
			echo '<' . $this->settings->title_tag_selection . ' class="uabb-infobox-title">';
			echo $this->settings->title;
			echo '</' . $this->settings->title_tag_selection . '>';
		}
		echo '</div>';
		$this->render_image( 'right-title' );

		if ( $flag ) {
			echo '</div>';
		}
	}

	/**
	 * Function that renders the text
	 *
	 * @method render_text
	 */
	public function render_text() {
		global $wp_embed;

		echo '<div class="uabb-infobox-text uabb-text-editor">' . wpautop( $wp_embed->autoembed( $this->settings->text ) ) . '</div>';
	}

	/**
	 * Function that renders the link
	 *
	 * @method render_link
	 */
	public function render_link() {
		if ( 'link' == $this->settings->cta_type ) {
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $this->settings->link_nofollow, 0 ) . ' class="uabb-infobox-cta-link">' . $this->settings->cta_text . '</a>';
		}
	}

	/**
	 * Function that renders the button
	 *
	 * @method render_button
	 */
	public function render_button() {

		if ( 'button' == $this->settings->cta_type ) {

			$version_bb_check = UABB_Compatibility::check_bb_version();

			if ( $version_bb_check ) {
				$target   = '';
				$nofollow = '';
				if ( isset( $this->settings->btn_link_target ) ) {
					$target = $this->settings->btn_link_target;
				}
				if ( isset( $this->settings->btn_link_nofollow ) ) {
					$nofollow = $this->settings->btn_link_nofollow;
				}
				if ( 'yes' == $this->settings->btn_link_nofollow ) {
					$nofollow = '1';
				}
				$btn_settings = array(

					/* General Section */
					'text'                       => $this->settings->btn_text,

					/* Link Section */
					'link'                       => $this->settings->btn_link,
					'link_target'                => $target,
					'link_nofollow'              => $nofollow,

					/* Style Section */
					'style'                      => $this->settings->btn_style,
					'border_size'                => $this->settings->btn_border_size,
					'transparent_button_options' => $this->settings->btn_transparent_button_options,
					'threed_button_options'      => $this->settings->btn_threed_button_options,
					'flat_button_options'        => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                   => $this->settings->btn_bg_color,
					'bg_hover_color'             => $this->settings->btn_bg_hover_color,
					'text_color'                 => $this->settings->btn_text_color,
					'text_hover_color'           => $this->settings->btn_text_hover_color,
					'hover_attribute'            => $this->settings->hover_attribute,

					/* Icon */
					'icon'                       => $this->settings->btn_icon,
					'icon_position'              => $this->settings->btn_icon_position,

					/* Structure */
					'width'                      => $this->settings->btn_width,
					'custom_width'               => $this->settings->btn_custom_width,
					'custom_height'              => $this->settings->btn_custom_height,
					'padding_top_bottom'         => $this->settings->btn_padding_top_bottom,
					'padding_left_right'         => $this->settings->btn_padding_left_right,
					'border_radius'              => $this->settings->btn_border_radius,
					'custom_class'               => $this->settings->custom_class,
					'align'                      => '',
					'mob_align'                  => '',

					/* Typography */

					'font_size'                  => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
					'button_typo'                => ( isset( $this->settings->button_font_typo ) ) ? $this->settings->button_font_typo : '',
					'button_typo_medium'         => ( isset( $this->settings->button_font_typo_medium ) ) ? $this->settings->button_font_typo_medium : '',
					'button_typo_responsive'     => ( isset( $this->settings->button_font_typo_responsive ) ) ? $this->settings->button_font_typo_responsive : '',
					'button_padding_dimension'   => ( isset( $this->settings->button_padding_dimension ) ) ? $this->settings->button_padding_dimension : '',
					'button_border'              => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
					'border_hover_color'         => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
				);
			} else {
				$target   = '';
				$nofollow = '';
				if ( isset( $this->settings->list_item_link_target ) ) {
					$target = $this->settings->list_item_link_target;
				}
				if ( isset( $this->settings->list_item_link_nofollow ) ) {
					$nofollow = $this->settings->list_item_link_nofollow;
				}

				$btn_settings = array(

					/* General Section */
					'text'                        => $this->settings->btn_text,

					/* Link Section */
					'link'                        => $this->settings->btn_link,
					'link_target'                 => $target,
					'link_nofollow'               => $nofollow,

					/* Style Section */
					'style'                       => $this->settings->btn_style,
					'border_size'                 => $this->settings->btn_border_size,
					'transparent_button_options'  => $this->settings->btn_transparent_button_options,
					'threed_button_options'       => $this->settings->btn_threed_button_options,
					'flat_button_options'         => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                    => $this->settings->btn_bg_color,
					'bg_hover_color'              => $this->settings->btn_bg_hover_color,
					'text_color'                  => $this->settings->btn_text_color,
					'text_hover_color'            => $this->settings->btn_text_hover_color,
					'hover_attribute'             => $this->settings->hover_attribute,

					/* Icon */
					'icon'                        => $this->settings->btn_icon,
					'icon_position'               => $this->settings->btn_icon_position,

					/* Structure */
					'width'                       => $this->settings->btn_width,
					'custom_width'                => $this->settings->btn_custom_width,
					'custom_height'               => $this->settings->btn_custom_height,
					'padding_top_bottom'          => $this->settings->btn_padding_top_bottom,
					'padding_left_right'          => $this->settings->btn_padding_left_right,
					'border_radius'               => $this->settings->btn_border_radius,
					'custom_class'                => $this->settings->custom_class,
					'align'                       => '',
					'mob_align'                   => '',

					/* Typography */

					'font_size'                   => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
					'font_size_unit'              => $this->settings->btn_font_size_unit,
					'font_size_unit_medium'       => $this->settings->btn_font_size_unit_medium,
					'font_size_unit_responsive'   => $this->settings->btn_font_size_unit_responsive,
					'line_height'                 => ( isset( $this->settings->btn_line_height ) ) ? $this->settings->btn_line_height : '',
					'line_height_unit'            => $this->settings->btn_line_height_unit,
					'line_height_unit_medium'     => $this->settings->btn_line_height_unit_medium,
					'line_height_unit_responsive' => $this->settings->btn_line_height_unit_responsive,
					'font_family'                 => $this->settings->btn_font_family,
					'transform'                   => $this->settings->btn_transform,
					'letter_spacing'              => $this->settings->btn_letter_spacing,
					'button_padding_dimension'    => ( isset( $this->settings->button_padding_dimension ) ) ? $this->settings->button_padding_dimension : '',
					'button_border_style'         => ( isset( $this->settings->button_border_style ) ) ? $this->settings->button_border_style : '',
					'button_border_width'         => ( isset( $this->settings->button_border_width ) ) ? $this->settings->button_border_width : '',
					'button_border_radius'        => ( isset( $this->settings->button_border_radius ) ) ? $this->settings->button_border_radius : '',
					'button_border_color'         => ( isset( $this->settings->button_border_color ) ) ? $this->settings->button_border_color : '',

					'border_hover_color'          => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
				);
			}

			echo '<div class="uabb-infobox-button">';
			FLBuilder::render_module_html( 'uabb-button', $btn_settings );
			echo '</div>';
		}
	}

	/**
	 * Function that renders the image
	 *
	 * @method render_image
	 * @param var $position gets the position of the image.
	 */
	public function render_image( $position ) {
		$set_pos = '';
		if ( 'icon' == $this->settings->image_type ) {
			$set_pos = $this->settings->img_icon_position;
		} elseif ( 'photo' == $this->settings->image_type ) {
			$set_pos = $this->settings->img_icon_position;
		}

		/* Render Image / icon */
		if ( $position == $set_pos ) {
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
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
		}
	}

	/**
	 * Function that renders the separator
	 *
	 * @method render_separator
	 */
	public function render_separator() {

		if ( 'block' == $this->settings->enable_separator ) {
			$separator_settings = array(
				'color'     => $this->settings->separator_color,
				'height'    => $this->settings->separator_height,
				'width'     => $this->settings->separator_width,
				'alignment' => $this->settings->separator_alignment,
				'style'     => $this->settings->separator_style,
			);

			echo '<div class="uabb-infobox-separator">';
			FLBuilder::render_module_html( 'uabb-separator', $separator_settings );
			echo '</div>';
		}
	}

}

/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-box/info-box-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-box/info-box-bb-less-than-2-2-compatibility.php';
}
