<?php
/**
 *  UABB Info Circle Module file
 *
 *  @package UABB Info Circle Module
 */

/**
 * Function that initializes Info Circle Module
 *
 * @class UABBInfoCircleModule
 */
class UABBInfoCircleModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Info Circle Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Info Circle', 'uabb' ),
				'description'     => __( 'Display a info circle.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/info-circle/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/info-circle/',
				'partial_refresh' => true,
				'icon'            => 'info-circle.svg',
			)
		);
		$this->add_css( 'uabb-animate', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-animate.css' );
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

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'outer_bg_color_opc', 'outer_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'info_bg_color_opc', 'info_bg_color' );

			// Font typo settings.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
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

				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
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
			$count = count( $settings->add_circle_item );
			for ( $i = 0; $i < $count; $i++ ) {

				if ( ! isset( $settings->add_circle_item[ $i ]->btn_font_typo ) || ! is_object( $settings->add_circle_item[ $i ]->btn_font_typo ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo            = new stdClass();
					$settings->add_circle_item[ $i ]->btn_font_typo_medium     = new stdClass();
					$settings->add_circle_item[ $i ]->btn_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_family ) ) {

					if ( isset( $settings->add_circle_item[ $i ]->btn_font_family->family ) ) {

						$settings->add_circle_item[ $i ]->btn_font_typo->font_family = $settings->add_circle_item[ $i ]->btn_font_family->family;
					}
					if ( isset( $settings->add_circle_item[ $i ]->btn_font_family->weight ) ) {

						if ( 'regular' === $settings->add_circle_item[ $i ]->btn_font_family->weight ) {
							$settings->add_circle_item[ $i ]->btn_font_typo->font_weight = 'normal';
						} else {
							$settings->add_circle_item[ $i ]->btn_font_typo->font_weight = $settings->add_circle_item[ $i ]->btn_font_family->weight;
						}
					}
					unset( $settings->add_circle_item[ $i ]->btn_font_family );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size_unit ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->add_circle_item[ $i ]->btn_font_size_unit );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size_unit_medium ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo_medium->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->add_circle_item[ $i ]->btn_font_size_unit_medium );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size_unit_responsive ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo_responsive->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->add_circle_item[ $i ]->btn_font_size_unit_responsive );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height_unit ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo->line_height = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->add_circle_item[ $i ]->btn_line_height_unit );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height_unit_medium ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo_medium->line_height = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->add_circle_item[ $i ]->btn_line_height_unit_medium );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height_unit_responsive ) ) {
					$settings->add_circle_item[ $i ]->btn_font_typo_responsive->line_height = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->add_circle_item[ $i ]->btn_line_height_unit_responsive );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_transform ) ) {
					$settings->add_circle_item[ $i ]->btn_font_typo->text_transform = $settings->add_circle_item[ $i ]->btn_transform;
					unset( $settings->add_circle_item[ $i ]->btn_transform );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_letter_spacing ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo->letter_spacing = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->add_circle_item[ $i ]->btn_letter_spacing );
				}
				$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
				$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'btn_bg_color_opc', 'btn_bg_color' );
				$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'inner_circle_bg_color_opc', 'inner_circle_bg_color' );
				if ( isset( $settings->add_circle_item[ $i ]->cta_link_nofollow ) ) {
					if ( '1' === $settings->add_circle_item[ $i ]->cta_link_nofollow || 'yes' === $settings->add_circle_item[ $i ]->cta_link_nofollow ) {
						$settings->add_circle_item[ $i ]->cta_link_nofollow = 'yes';
					}
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'outer_bg_color_opc', 'outer_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'info_bg_color_opc', 'info_bg_color' );
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {
						$settings->title_font_typo['font_family'] = $settings->font_family['family'];
						unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
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

				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
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
			if ( isset( $settings->desc_line_height ) && isset( $settings->desc_font_size['small'] ) && 0 !== $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			$count = count( $settings->add_circle_item );
			for ( $i = 0; $i < $count; $i++ ) {
				if ( ! isset( $settings->add_circle_item[ $i ]->btn_font_typo ) || ! is_object( $settings->add_circle_item[ $i ]->btn_font_typo ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo            = new stdClass();
					$settings->add_circle_item[ $i ]->btn_font_typo_medium     = new stdClass();
					$settings->add_circle_item[ $i ]->btn_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_family ) ) {

					if ( isset( $settings->add_circle_item[ $i ]->btn_font_family->family ) ) {

						$settings->add_circle_item[ $i ]->btn_font_typo->font_family = $settings->add_circle_item[ $i ]->btn_font_family->family;
					}
					if ( isset( $settings->add_circle_item[ $i ]->btn_font_family->weight ) ) {
						if ( 'regular' === $settings->add_circle_item[ $i ]->btn_font_family->weight ) {
							$settings->add_circle_item[ $i ]->btn_font_typo->font_weight = 'normal';
						} else {
							$settings->add_circle_item[ $i ]->btn_font_typo->font_weight = $settings->add_circle_item[ $i ]->btn_font_family->weight;
						}
					}
					unset( $settings->add_circle_item[ $i ]->btn_font_family );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) ) {

					$settings->add_circle_item[ $i ]->btn_font_typo->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->medium ) ) {
					$settings->add_circle_item[ $i ]->btn_font_typo_medium->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->small ) ) {
					$settings->add_circle_item[ $i ]->btn_font_typo_responsive->font_size = (object) array(
						'length' => $settings->add_circle_item[ $i ]->btn_font_size->small,
						'unit'   => 'px',
					);
				}

				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->desktop ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) && 0 !== $settings->add_circle_item[ $i ]->btn_font_size->desktop ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->desktop ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) ) {
						$settings->add_circle_item[ $i ]->btn_font_typo->line_height = (object) array(
							'length' => round( $settings->add_circle_item[ $i ]->btn_line_height->desktop / $settings->add_circle_item[ $i ]->btn_font_size->desktop, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->medium ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->medium ) && 0 !== $settings->add_circle_item[ $i ]->btn_font_size->medium ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->medium ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->medium ) ) {
						$settings->add_circle_item[ $i ]->btn_font_typo_medium->line_height = (object) array(
							'length' => round( $settings->add_circle_item[ $i ]->btn_line_height->medium / $settings->add_circle_item[ $i ]->btn_font_size->medium, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->small ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->small ) && 0 !== $settings->add_circle_item[ $i ]->btn_font_size->small ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->small ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->small ) ) {
						$settings->add_circle_item[ $i ]->btn_font_typo_responsive->line_height = (object) array(
							'length' => round( $settings->add_circle_item[ $i ]->btn_line_height->small / $settings->add_circle_item[ $i ]->btn_font_size->small, 2 ),
							'unit'   => 'em',
						);
					}
					$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
					$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'btn_bg_color_opc', 'btn_bg_color' );
					$helper->handle_opacity_inputs( $settings->add_circle_item[ $i ], 'inner_circle_bg_color_opc', 'inner_circle_bg_color' );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size ) ) {
					unset( $settings->add_circle_item[ $i ]->btn_font_size );
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height ) ) {
					unset( $settings->add_circle_item[ $i ]->btn_line_height );
				}
			}
			// unset value.
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
		}
		return $settings;
	}
	/**
	 * Function to get the icon for the Info Circle
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/info-circle/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/info-circle/icon/' . $icon );
		}
		return '';
	}

	/**
	 * Render Icon/Photo
	 *
	 * @method get_icons
	 * @param object $item gets the items for the module.
	 * @param string $active gets the value for the module.
	 */
	public function render_icon_image( $item, $active = '' ) {
		$photo_source = $item->photo_source;
		$photo        = $item->photo;
		$photo_url    = $item->photo_url;
		$photo_src    = ( isset( $item->photo_src ) ) ? $item->photo_src : '';

		if ( 'active-img' === $active && 'change-img' === $item->photo_active_type ) {
			$photo_source = $item->active_photo_source;
			$photo        = $item->active_photo;
			$photo_url    = $item->active_photo_url;
			$photo_src    = ( isset( $item->active_photo_src ) ) ? $item->active_photo_src : '';
		}

		$imageicon_array = array(
			/* General Section */
			'image_type'   => $item->image_type,

			/* Icon Basics */
			'icon'         => $item->icon,
			'icon_align'   => 'center',

			/* Image Basics */
			'photo_source' => $photo_source,
			'photo'        => $photo,
			'photo_url'    => $photo_url,
			'img_align'    => 'center',
			'image_style'  => $this->settings->thumb_style,
			'photo_src'    => $photo_src,
		);
		/* Render HTML Function */
		FLBuilder::render_module_html( 'image-icon', $imageicon_array );
	}

	/**
	 * Function that renders the CTA button for the module.
	 *
	 * @method render_button
	 * @param object $item gets the object for the button.
	 */
	public function render_cta( $item ) {

		if ( 'button' === $item->desc_cta_type ) {
			if ( ! UABB_Compatibility::$version_bb_check ) {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $item->cta_text,

					/* Link Section */
					'link'                                 => $item->cta_link,
					'link_target'                          => $item->cta_link_target,
					'link_nofollow'                        => ( isset( $item->cta_link_nofollow ) ) ? $item->cta_link_nofollow : '',
					/* Style Section */
					'style'                                => $item->btn_style,
					'border_size'                          => $item->btn_border_size,
					'transparent_button_options'           => $item->btn_transparent_button_options,
					'threed_button_options'                => $item->btn_threed_button_options,
					'flat_button_options'                  => $item->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $item->btn_bg_color,
					'bg_hover_color'                       => $item->btn_bg_hover_color,
					'text_color'                           => $item->btn_text_color,
					'text_hover_color'                     => $item->btn_text_hover_color,
					'hover_attribute'                      => $item->hover_attribute,

					/* Icon */
					'icon'                                 => $item->btn_icon,
					'icon_position'                        => $item->btn_icon_position,

					/* Structure */
					'width'                                => $item->btn_width,
					'custom_width'                         => $item->btn_custom_width,
					'custom_height'                        => $item->btn_custom_height,
					'padding_top_bottom'                   => $item->btn_padding_top_bottom,
					'padding_left_right'                   => $item->btn_padding_left_right,
					'border_radius'                        => $item->btn_border_radius,
					'align'                                => 'center',
					'mob_align'                            => 'center',

					/* Typography */
					'font_size'                            => ( isset( $item->btn_font_size ) ) ? $item->btn_font_size : '',
					'line_height'                          => ( isset( $item->btn_line_height ) ) ? $item->btn_line_height : '',
					'font_size_unit'                       => $item->btn_font_size_unit,
					'line_height_unit'                     => $item->btn_line_height_unit,
					'font_size_unit_medium'                => $item->btn_font_size_unit_medium,
					'line_height_unit_medium'              => $item->btn_line_height_unit_medium,
					'font_size_unit_responsive'            => $item->btn_font_size_unit_responsive,
					'line_height_unit_responsive'          => $item->btn_line_height_unit_responsive,
					'font_family'                          => $item->btn_font_family,
					'transform'                            => $item->btn_transform,
					'letter-spacing'                       => $item->btn_letter_spacing,
					'button_padding_dimension_top'         => ( isset( $item->button_padding_dimension_top ) ) ? $item->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $item->button_padding_dimension_left ) ) ? $item->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $item->button_padding_dimension_bottom ) ) ? $item->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $item->button_padding_dimension_right ) ) ? $item->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $item->button_padding_dimension_top_medium ) ) ? $item->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $item->button_padding_dimension_left_medium ) ) ? $item->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $item->button_padding_dimension_bottom_medium ) ) ? $item->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $item->button_padding_dimension_right_medium ) ) ? $item->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $item->button_padding_dimension_top_responsive ) ) ? $item->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $item->button_padding_dimension_left_responsive ) ) ? $item->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $item->button_padding_dimension_bottom_responsive ) ) ? $item->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $item->button_padding_dimension_right_responsive ) ) ? $item->button_padding_dimension_right_responsive : '',
					'button_border_style'                  => ( isset( $item->button_border_style ) ) ? $item->button_border_style : '',
					'button_border_width'                  => ( isset( $item->button_border_width ) ) ? $item->button_border_width : '',
					'button_border_radius'                 => ( isset( $item->button_border_radius ) ) ? $item->button_border_radius : '',
					'button_border_color'                  => ( isset( $item->button_border_color ) ) ? $item->button_border_color : '',

					'border_hover_color'                   => ( isset( $item->border_hover_color ) ) ? $item->border_hover_color : '',
				);
			} else {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $item->cta_text,

					/* Link Section */
					'link'                                 => $item->cta_link,
					'link_target'                          => $item->cta_link_target,
					'link_nofollow'                        => ( isset( $item->cta_link_nofollow ) ) ? $item->cta_link_nofollow : '',
					/* Style Section */
					'style'                                => $item->btn_style,
					'border_size'                          => $item->btn_border_size,
					'transparent_button_options'           => $item->btn_transparent_button_options,
					'threed_button_options'                => $item->btn_threed_button_options,
					'flat_button_options'                  => $item->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $item->btn_bg_color,
					'bg_hover_color'                       => $item->btn_bg_hover_color,
					'text_color'                           => $item->btn_text_color,
					'text_hover_color'                     => $item->btn_text_hover_color,
					'hover_attribute'                      => $item->hover_attribute,

					/* Icon */
					'icon'                                 => $item->btn_icon,
					'icon_position'                        => $item->btn_icon_position,

					/* Structure */
					'width'                                => $item->btn_width,
					'custom_width'                         => $item->btn_custom_width,
					'custom_height'                        => $item->btn_custom_height,
					'padding_top_bottom'                   => $item->btn_padding_top_bottom,
					'padding_left_right'                   => $item->btn_padding_left_right,
					'border_radius'                        => $item->btn_border_radius,
					'align'                                => 'center',
					'mob_align'                            => 'center',

					/* Typography */
					'font_size'                            => ( isset( $item->btn_font_size ) ) ? $item->btn_font_size : '',
					'line_height'                          => ( isset( $item->btn_line_height ) ) ? $item->btn_line_height : '',
					'button_typo'                          => ( isset( $item->btn_font_typo ) ) ? $item->btn_font_typo : '',
					'button_typo_medium'                   => ( isset( $item->btn_font_typo_medium ) ) ? $item->btn_font_typo_medium : '',
					'button_typo_responsive'               => ( isset( $item->btn_font_typo_responsive ) ) ? $item->btn_font_typo_responsive : '',

					'button_padding_dimension_top'         => ( isset( $item->button_padding_dimension_top ) ) ? $item->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $item->button_padding_dimension_left ) ) ? $item->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $item->button_padding_dimension_bottom ) ) ? $item->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $item->button_padding_dimension_right ) ) ? $item->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $item->button_padding_dimension_top_medium ) ) ? $item->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $item->button_padding_dimension_left_medium ) ) ? $item->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $item->button_padding_dimension_bottom_medium ) ) ? $item->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $item->button_padding_dimension_right_medium ) ) ? $item->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $item->button_padding_dimension_top_medium ) ) ? $item->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $item->button_padding_dimension_left_responsive ) ) ? $item->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $item->button_padding_dimension_bottom_responsive ) ) ? $item->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $item->button_padding_dimension_right_responsive ) ) ? $item->button_padding_dimension_right_responsive : '',
					'button_border'                        => ( isset( $item->button_border ) ) ? $item->button_border : '',
					'border_hover_color'                   => ( isset( $item->border_hover_color ) ) ? $item->border_hover_color : '',
				);
			}
			FLBuilder::render_module_html( 'uabb-button', $btn_settings );
		} else {
			echo '<a href="' . $item->cta_link . '" target="' . esc_attr( $item->cta_link_target ) . '" ' . wp_kses_post( BB_Ultimate_Addon_Helper::get_link_rel( $item->cta_link_target, $item->cta_link_nofollow, 0 ) ) . ' class="uabb-infoc-link" >' . $item->cta_text . '</a>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

/**
 * Get Responsive Breakpoint from Global Setting
 */
$default_breakpoint = ( trim( UABB_Model_Helper::$bb_global_settings->medium_breakpoint ) !== '' ) ? UABB_Model_Helper::$bb_global_settings->medium_breakpoint : '';

/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-circle/info-circle-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-circle/info-circle-bb-less-than-2-2-compatibility.php';
}
