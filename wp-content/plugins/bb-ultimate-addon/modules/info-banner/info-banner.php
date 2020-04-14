<?php
/**
 *  UABB Info Banner Module file
 *
 *  @package UABB Info Banner Module
 */

/**
 * Function that initializes Info Banner Module
 *
 * @class InfoBannerModule
 */
class InfoBannerModule extends FLBuilderModule {

	/**
	 * Variable for Info Banner module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = null;

	/**
	 * Constructor function that constructs default values for the Info Banner Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Info Banner', 'uabb' ),
				'description'     => __( 'Info Banner', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/info-banner/',
				'partial_refresh' => true,
				'icon'            => 'info-banner.svg',
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

			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' === $settings->link_nofollow || 'yes' === $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->font_family['weight'];

					}
					unset( $settings->font_family['weight'] );
				}
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {

				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {

				$settings->title_font_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {

				$settings->title_font_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {
				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_family['weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
			}
			if ( isset( $settings->desc_font_size_unit ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit );
			}
			if ( isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_medium );
			}
			if ( isset( $settings->desc_font_size_unit_responsive ) ) {

				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit );
			}
			if ( isset( $settings->desc_line_height_unit_medium ) ) {
				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_medium );
			}
			if ( isset( $settings->desc_line_height_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {

				$settings->desc_font_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );

			}
			if ( isset( $settings->desc_letter_spacing ) ) {

				$settings->desc_font_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->tbtn_font_family ) ) {

				if ( isset( $settings->tbtn_font_family['weight'] ) ) {
					if ( 'regular' === $settings->tbtn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->tbtn_font_family['weight'];

					}
				}
				if ( isset( $settings->tbtn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->tbtn_font_family['family'];
				}
				unset( $settings->tbtn_font_family );
			}
			if ( isset( $settings->tbtn_font_size_unit ) ) {

				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->tbtn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->tbtn_font_size_unit );
			}
			if ( isset( $settings->tbtn_font_size_unit_medium ) ) {
				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->tbtn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->tbtn_font_size_unit_medium );
			}
			if ( isset( $settings->tbtn_font_size_unit_responsive ) ) {

				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->tbtn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->tbtn_font_size_unit_responsive );
			}
			if ( isset( $settings->tbtn_line_height_unit ) ) {

				$settings->btn_font_typo['line_height'] = array(
					'length' => $settings->tbtn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->tbtn_line_height_unit );
			}
			if ( isset( $settings->tbtn_line_height_unit_medium ) ) {

				$settings->btn_font_typo_medium['line_height'] = array(
					'length' => $settings->tbtn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->tbtn_line_height_unit_medium );
			}
			if ( isset( $settings->tbtn_line_height_unit_responsive ) ) {

				$settings->btn_font_typo_responsive['line_height'] = array(
					'length' => $settings->tbtn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->tbtn_line_height_unit_responsive );
			}
			if ( isset( $settings->tbtn_content_transform ) ) {

				$settings->btn_font_typo['text_transform'] = $settings->tbtn_content_transform;
				unset( $settings->tbtn_content_transform );
			}
			if ( isset( $settings->tbtn_content_letter_spacing ) ) {

				$settings->btn_font_typo['letter_spacing'] = array(
					'length' => $settings->tbtn_content_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->tbtn_content_letter_spacing );
			}
			if ( ! isset( $settings->link_font_typo ) || ! is_array( $settings->link_font_typo ) ) {

				$settings->link_font_typo            = array();
				$settings->link_font_typo_medium     = array();
				$settings->link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {
				if ( isset( $settings->link_font_family['weight'] ) ) {
					if ( 'regular' === $settings->link_font_family['weight'] ) {
						$settings->link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
				if ( isset( $settings->link_font_family['family'] ) ) {
					$settings->link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset( $settings->link_font_family['family'] );
				}
			}
			if ( isset( $settings->link_font_size_unit ) ) {

				$settings->link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit );
			}
			if ( isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_medium );
			}
			if ( isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_responsive );
			}
			if ( isset( $settings->link_line_height_unit ) ) {

				$settings->link_font_typo['line_height'] = array(
					'length' => $settings->link_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit );
			}
			if ( isset( $settings->link_line_height_unit_medium ) ) {
				$settings->link_font_typo_medium['line_height'] = array(
					'length' => $settings->link_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_medium );
			}
			if ( isset( $settings->link_line_height_unit_responsive ) ) {
				$settings->link_font_typo_responsive['line_height'] = array(
					'length' => $settings->link_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_responsive );
			}
			if ( isset( $settings->link_transform ) ) {

				$settings->link_font_typo['text_transform'] = $settings->link_transform;
				unset( $settings->link_transform );
			}
			if ( isset( $settings->link_letter_spacing ) ) {

				$settings->link_font_typo['letter_spacing'] = array(
					'length' => $settings->link_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->link_letter_spacing );
			}

			// handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' === $settings->btn_link_nofollow || 'yes' === $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' === $settings->link_nofollow || 'yes' === $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}

			// handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->font_family['weight'];

					}
					unset( $settings->font_family['weight'] );
				}
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 !== $settings->font_size['desktop'] ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 !== $settings->font_size['medium'] ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 !== $settings->font_size['small'] ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_family['weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
			}
			if ( isset( $settings->desc_font_size['desktop'] ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['medium'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['small'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 !== $settings->desc_font_size['desktop'] ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 !== $settings->desc_font_size['medium'] ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 !== $settings->desc_font_size['small'] ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->tbtn_font_family ) ) {

				if ( isset( $settings->tbtn_font_family['weight'] ) ) {
					if ( 'regular' === $settings->tbtn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->tbtn_font_family['weight'];
					}
				}
				if ( isset( $settings->tbtn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->tbtn_font_family['family'];
				}
				unset( $settings->tbtn_font_family );
			}
			if ( isset( $settings->tbtn_font_size['desktop'] ) ) {
				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->tbtn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->tbtn_font_size['medium'] ) ) {
				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->tbtn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->tbtn_font_size['small'] ) ) {
				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->tbtn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->tbtn_line_height['desktop'] ) && isset( $settings->tbtn_font_size['desktop'] ) && 0 !== $settings->tbtn_font_size['desktop'] ) {
				if ( is_numeric( $settings->tbtn_line_height['desktop'] ) && is_numeric( $settings->tbtn_font_size['desktop'] ) ) {
					$settings->btn_font_typo['line_height'] = array(
						'length' => round( $settings->tbtn_line_height['desktop'] / $settings->tbtn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->tbtn_line_height['medium'] ) && isset( $settings->tbtn_font_size['medium'] ) && 0 !== $settings->tbtn_font_size['medium'] ) {
				if ( is_numeric( $settings->tbtn_line_height['medium'] ) && is_numeric( $settings->tbtn_font_size['medium'] ) ) {
					$settings->btn_font_typo_medium['line_height'] = array(
						'length' => round( $settings->tbtn_line_height['medium'] / $settings->tbtn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->tbtn_line_height['small'] ) && isset( $settings->tbtn_font_size['small'] ) && 0 !== $settings->tbtn_font_size['small'] ) {
				if ( is_numeric( $settings->tbtn_line_height['small'] ) && is_numeric( $settings->tbtn_font_size['small'] ) ) {
					$settings->btn_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->tbtn_line_height['small'] / $settings->tbtn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->link_font_typo ) || ! is_array( $settings->link_font_typo ) ) {

				$settings->link_font_typo            = array();
				$settings->link_font_typo_medium     = array();
				$settings->link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {

				if ( isset( $settings->link_font_family['weight'] ) ) {
					if ( 'regular' === $settings->link_font_family['weight'] ) {
						$settings->link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
				if ( isset( $settings->link_font_family['family'] ) ) {
					$settings->link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset( $settings->link_font_family['family'] );
				}
			}
			if ( isset( $settings->link_font_size['desktop'] ) ) {
				$settings->link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['medium'] ) ) {
				$settings->link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['small'] ) ) {
				$settings->link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 !== $settings->link_font_size['desktop'] ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_font_typo['line_height'] = array(
						'length' => round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 !== $settings->link_font_size['medium'] ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_font_typo_medium['line_height'] = array(
						'length' => round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 !== $settings->link_font_size['desktop'] ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' === $settings->btn_link_nofollow || 'yes' === $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				unset( $settings->font_size['desktop'] );
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				unset( $settings->font_size['medium'] );
			}
			if ( isset( $settings->font_size['small'] ) ) {
				unset( $settings->font_size['small'] );
			}
			if ( isset( $settings->line_height['desktop'] ) ) {
				unset( $settings->line_height['desktop'] );
			}
			if ( isset( $settings->line_height['medium'] ) ) {
				unset( $settings->line_height['medium'] );
			}
			if ( isset( $settings->line_height['small'] ) ) {
				unset( $settings->line_height['small'] );
			}
			if ( isset( $settings->desc_font_size['desktop'] ) ) {
				unset( $settings->desc_font_size['desktop'] );
			}
			if ( isset( $settings->desc_font_size['medium'] ) ) {
				unset( $settings->desc_font_size['medium'] );
			}
			if ( isset( $settings->desc_font_size['small'] ) ) {
				unset( $settings->desc_font_size['small'] );
			}
			if ( isset( $settings->desc_line_height['desktop'] ) ) {
				unset( $settings->desc_line_height['desktop'] );
			}
			if ( isset( $settings->desc_line_height['medium'] ) ) {
				unset( $settings->desc_line_height['medium'] );
			}
			if ( isset( $settings->desc_line_height['small'] ) ) {
				unset( $settings->desc_line_height['small'] );
			}
			if ( isset( $settings->tbtn_font_size ) ) {
				unset( $settings->tbtn_font_size );
			}
			if ( isset( $settings->tbtn_line_height ) ) {
				unset( $settings->tbtn_line_height );
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
		}
		return $settings;
	}
	/**
	 * Function to get the icon for the Info Banner
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/icon/' . $icon );
		}
		return '';
	}

	/**
	 * Function that gets the settigs for the module
	 *
	 * @method update
	 * @param object $settings gets the settings.
	 */
	public function update( $settings ) {
		// Make sure we have a photo_src property.
		if ( ! isset( $settings->banner_image_src ) ) {
			$settings->banner_image_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data( $settings->banner_image );

		if ( $data ) {
			$settings->data = $data;
		}

		return $settings;
	}

	/**
	 * Function that gets the data for the module.
	 *
	 * @method get_data
	 */
	public function get_data() {
		if ( ! $this->data ) {

			$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->banner_image );

			// Data object is empty, use the settings cache.
			if ( ! $this->data && isset( $this->settings->data ) ) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * Function that gets the alt value for the module
	 *
	 * @method get_alt
	 */
	public function get_alt() {
		$photo = $this->get_data();

		if ( ! empty( $photo->alt ) ) {
			return esc_html( $photo->alt );
		} else {
			return '';
		}
	}

	/**
	 * Function that renders the link for the Info Banner module
	 *
	 * @method render_link
	 */
	public function render_link() {
		if ( 'link' === $this->settings->cta_type ) {
			echo '<a href="' . esc_url( $this->settings->link ) . '" target="' . esc_attr( $this->settings->link_target ) . '" ' . wp_kses_post( BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $this->settings->link_nofollow, 0 ) ) . ' class="uabb-infobanner-cta-link">' . esc_attr( $this->settings->cta_text ) . '</a>';
		}
	}

	/**
	 * Function that renders the button for the module
	 *
	 * @method render_button
	 */
	public function render_button() {
		if ( 'button' === $this->settings->cta_type ) {
			if ( ! UABB_Compatibility::$version_bb_check ) {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $this->settings->btn_text,

					/* Link Section */
					'link'                                 => $this->settings->btn_link,
					'link_target'                          => $this->settings->btn_link_target,
					'link_nofollow'                        => $this->settings->btn_link_nofollow,

					/* Style Section */
					'style'                                => $this->settings->btn_style,
					'border_size'                          => $this->settings->btn_border_size,
					'transparent_button_options'           => $this->settings->btn_transparent_button_options,
					'threed_button_options'                => $this->settings->btn_threed_button_options,
					'flat_button_options'                  => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $this->settings->btn_bg_color,
					'bg_hover_color'                       => $this->settings->btn_bg_hover_color,
					'text_color'                           => $this->settings->btn_text_color,
					'text_hover_color'                     => $this->settings->btn_text_hover_color,
					'hover_attribute'                      => $this->settings->hover_attribute,

					/* Icon */
					'icon'                                 => $this->settings->btn_icon,
					'icon_position'                        => $this->settings->btn_icon_position,

					/* Structure */
					'width'                                => $this->settings->btn_width,
					'custom_width'                         => $this->settings->btn_custom_width,
					'custom_height'                        => $this->settings->btn_custom_height,
					'padding_top_bottom'                   => $this->settings->btn_padding_top_bottom,
					'padding_left_right'                   => $this->settings->btn_padding_left_right,
					'border_radius'                        => $this->settings->btn_border_radius,
					'align'                                => $this->settings->banner_alignemnt,
					'mob_align'                            => '',

					'font_family'                          => $this->settings->tbtn_font_family,
					'font_size'                            => ( isset( $this->settings->tbtn_font_size ) ) ? $this->settings->tbtn_font_size : '',
					'line_height'                          => ( isset( $this->settings->tbtn_line_height ) ) ? $this->settings->tbtn_line_height : '',
					'font_size_unit'                       => $this->settings->tbtn_font_size_unit,
					'line_height_unit'                     => $this->settings->tbtn_line_height_unit,
					'font_size_unit_medium'                => $this->settings->tbtn_font_size_unit_medium,
					'line_height_unit_medium'              => $this->settings->tbtn_line_height_unit_medium,
					'font_size_unit_responsive'            => $this->settings->tbtn_font_size_unit_responsive,
					'line_height_unit_responsive'          => $this->settings->tbtn_line_height_unit_responsive,
					'transform'                            => $this->settings->tbtn_content_transform,
					'letter_spacing'                       => $this->settings->tbtn_content_letter_spacing,
					'button_padding_dimension_top'         => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
					'button_border_style'                  => ( isset( $this->settings->button_border_style ) ) ? $this->settings->button_border_style : '',
					'button_border_width'                  => ( isset( $this->settings->button_border_width ) ) ? $this->settings->button_border_width : '',
					'button_border_radius'                 => ( isset( $this->settings->button_border_radius ) ) ? $this->settings->button_border_radius : '',
					'button_border_color'                  => ( isset( $this->settings->button_border_color ) ) ? $this->settings->button_border_color : '',

					'border_hover_color'                   => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
				);
			} else {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $this->settings->btn_text,

					/* Link Section */
					'link'                                 => $this->settings->btn_link,
					'link_target'                          => $this->settings->btn_link_target,
					'link_nofollow'                        => $this->settings->btn_link_nofollow,

					/* Style Section */
					'style'                                => $this->settings->btn_style,
					'border_size'                          => $this->settings->btn_border_size,
					'transparent_button_options'           => $this->settings->btn_transparent_button_options,
					'threed_button_options'                => $this->settings->btn_threed_button_options,
					'flat_button_options'                  => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $this->settings->btn_bg_color,
					'bg_hover_color'                       => $this->settings->btn_bg_hover_color,
					'text_color'                           => $this->settings->btn_text_color,
					'text_hover_color'                     => $this->settings->btn_text_hover_color,
					'hover_attribute'                      => $this->settings->hover_attribute,

					/* Icon */
					'icon'                                 => $this->settings->btn_icon,
					'icon_position'                        => $this->settings->btn_icon_position,

					/* Structure */
					'width'                                => $this->settings->btn_width,
					'custom_width'                         => $this->settings->btn_custom_width,
					'custom_height'                        => $this->settings->btn_custom_height,
					'padding_top_bottom'                   => $this->settings->btn_padding_top_bottom,
					'padding_left_right'                   => $this->settings->btn_padding_left_right,
					'border_radius'                        => $this->settings->btn_border_radius,
					'align'                                => $this->settings->banner_alignemnt,
					'mob_align'                            => '',
					'font_size'                            => ( isset( $this->settings->tbtn_font_size ) ) ? $this->settings->tbtn_font_size : '',
					'line_height'                          => ( isset( $this->settings->tbtn_line_height ) ) ? $this->settings->tbtn_line_height : '',

					'button_typo'                          => ( isset( $this->settings->btn_font_typo ) ) ? $this->settings->btn_font_typo : '',
					'button_typo_medium'                   => ( isset( $this->settings->btn_font_typo_medium ) ) ? $this->settings->btn_font_typo_medium : '',
					'button_typo_responsive'               => ( isset( $this->settings->btn_font_typo_responsive ) ) ? $this->settings->btn_font_typo_responsive : '',
					'button_padding_dimension_top'         => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
					'button_border'                        => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
					'border_hover_color'                   => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
				);
			}
			FLBuilder::render_module_html( 'uabb-button', $btn_settings );
		}
	}
}

/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/info-banner-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-banner/info-banner-bb-less-than-2-2-compatibility.php';
}
