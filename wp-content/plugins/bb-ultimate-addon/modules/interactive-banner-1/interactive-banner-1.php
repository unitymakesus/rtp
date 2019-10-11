<?php
/**
 *  UABB Interactive Banner 1 Module file
 *
 *  @package UABB Interactive Banner 1 Module
 */

/**
 * Function that initializes Interactive Banner 1 Module
 *
 * @class InteractiveBanner1Module
 */
class InteractiveBanner1Module extends FLBuilderModule {

	/**
	 * Variable for Interactive Banner 1 module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = null;

	/**
	 * Constructor function that constructs default values for the Interactive Banner 1 Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Interactive Banner 1', 'uabb' ),
				'description'     => __( 'Interactive Banner 1', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-1/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/interactive-banner-1/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'ib-1.svg',
			)
		);
		$this->add_css( 'font-awesome-5' );
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

			$helper->handle_opacity_inputs( $settings, 'overlay_background_color_opc', 'overlay_background_color' );
			$helper->handle_opacity_inputs( $settings, 'title_typography_title_background_color_opc', 'title_typography_title_background_color' );

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {
				if ( isset( $settings->title_typography_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_typography_font_size_unit ) ) {

				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit );
			}
			if ( isset( $settings->title_typography_font_size_unit_medium ) ) {

				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_medium );
			}
			if ( isset( $settings->title_typography_font_size_unit_responsive ) ) {

				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->title_typography_line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit );
			}
			if ( isset( $settings->title_typography_line_height_unit_medium ) ) {

				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_medium );
			}
			if ( isset( $settings->title_typography_line_height_unit_responsive ) ) {

				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_responsive );
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
			if ( isset( $settings->banner_title_location ) ) {

				$settings->title_font_typo['text_align'] = $settings->banner_title_location;
				unset( $settings->banner_title_location );
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) ) {

				if ( isset( $settings->desc_typography_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
				}
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_typography_font_size_unit ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit );
			}
			if ( isset( $settings->desc_typography_font_size_unit_medium ) ) {

				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit_medium );
			}
			if ( isset( $settings->desc_typography_font_size_unit_responsive ) ) {

				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_typography_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit );
			}
			if ( isset( $settings->desc_typography_line_height_unit_medium ) ) {

				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit_medium );
			}
			if ( isset( $settings->desc_typography_line_height_unit_responsive ) ) {

				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit_responsive );
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
			if ( ! isset( $settings->button->button_typo ) || ! is_object( $settings->button->button_typo ) ) {
				$settings->button->button_typo            = new stdClass();
				$settings->button->button_typo_medium     = new stdClass();
				$settings->button->button_typo_responsive = new stdClass;
			}
			if ( isset( $settings->button->font_family ) ) {
				if ( isset( $settings->button->font_family->family ) ) {

					$settings->button->button_typo->font_family = $settings->button->font_family->family;
				}
				if ( isset( $settings->button->font_family->weight ) ) {
					if ( 'regular' == (string) $settings->button->font_family->weight ) {
						$settings->button->button_typo->font_weight = 'normal';
					} else {
						$settings->button->button_typo->font_weight = $settings->button->font_family->weight;
					}
				}
				unset( $settings->button->font_family );
			}
			if ( isset( $settings->button->font_size_unit ) ) {

				$settings->button->button_typo->font_size = (object) array(
					'length' => $settings->button->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->button->font_size_unit );
			}
			if ( isset( $settings->button->font_size_unit_medium ) ) {

				$settings->button->button_typo_medium->font_size = (object) array(
					'length' => $settings->button->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->button->font_size_unit_medium );
			}
			if ( isset( $settings->button->font_size_unit_responsive ) ) {

				$settings->button->button_typo_responsive->font_size = (object) array(
					'length' => $settings->button->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->button->font_size_unit_responsive );
			}
			if ( isset( $settings->button->line_height_unit ) ) {

				$settings->button->button_typo->line_height = (object) array(
					'length' => $settings->button->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->button->line_height_unit );
			}
			if ( isset( $settings->button->line_height_unit_medium ) ) {

				$settings->button->button_typo_medium->line_height = (object) array(
					'length' => $settings->button->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->button->line_height_unit_medium );
			}
			if ( isset( $settings->button->line_height_unit_responsive ) ) {

				$settings->button->button_typo_responsive->line_height = (object) array(
					'length' => $settings->button->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->button->line_height_unit_responsive );
			}
			if ( isset( $settings->button->transform ) ) {
				$settings->button->button_typo->text_transform = $settings->button->transform;
				unset( $settings->button->transform );
			}
			if ( isset( $settings->button->letter_spacing ) ) {
				$settings->button->button_typo->letter_spacing = (object) array(
					'length' => $settings->button->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->button->letter_spacing );
			}
			if ( isset( $settings->button->link_nofollow ) ) {
				if ( '1' == $settings->button->link_nofollow || 'yes' == $settings->button->link_nofollow ) {
					$settings->button->link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->cta_link_follow ) ) {
				$settings->cta_link_nofollow = ( '1' == $settings->cta_link_follow ) ? 'yes' : '';
				unset( $settings->cta_link_follow );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			$helper->handle_opacity_inputs( $settings, 'overlay_background_color_opc', 'overlay_background_color' );
			$helper->handle_opacity_inputs( $settings, 'title_typography_title_background_color_opc', 'title_typography_title_background_color' );

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {

				if ( isset( $settings->title_typography_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) ) {

				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->banner_title_location ) ) {

				$settings->title_font_typo['text_align'] = $settings->banner_title_location;
				unset( $settings->banner_title_location );
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) ) {

				if ( isset( $settings->desc_typography_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
				}
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['small'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 != $settings->desc_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 != $settings->desc_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 != $settings->desc_typography_font_size['small'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->button->button_typo ) || ! is_object( $settings->button->button_typo ) ) {
				$settings->button->button_typo            = new stdClass();
				$settings->button->button_typo_medium     = new stdClass();
				$settings->button->button_typo_responsive = new stdClass();
			}
			if ( isset( $settings->button->font_family ) ) {
				if ( isset( $settings->button->font_family->family ) ) {

					$settings->button->button_typo->font_family = $settings->button->font_family->family;
				}
				if ( isset( $settings->button->font_family->weight ) ) {
					if ( 'regular' == (string) $settings->button->font_family->weight ) {
						$settings->button->button_typo->font_weight = 'normal';
					} else {
						$settings->button->button_typo->font_weight = $settings->button->font_family->weight;
					}
				}
				unset( $settings->button->font_family );
			}
			if ( isset( $settings->button->font_size->desktop ) ) {
				$settings->button->button_typo->font_size = (object) array(
					'length' => $settings->button->font_size->desktop,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->button->font_size->medium ) ) {
				$settings->button->button_typo_medium->font_size = (object) array(
					'length' => $settings->button->font_size->medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->button->font_size->small ) ) {
				$settings->button->button_typo_responsive->font_size = (object) array(
					'length' => $settings->button->font_size->small,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 != $settings->button->font_size->desktop ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->button_typo->line_height = (object) array(
						'length' => round( $settings->button->line_height->desktop / $settings->button->font_size->desktop, 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 != $settings->button->font_size->medium ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->button_typo_medium->line_height = (object) array(
						'length' => round( $settings->button->line_height->medium / $settings->button->font_size->medium, 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 != $settings->button->font_size->small ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->button_typo_responsive->line_height = (object) array(
						'length' => round( $settings->button->line_height->small / $settings->button->font_size->small, 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->button->link_nofollow ) ) {
				if ( '1' == $settings->button->link_nofollow || 'yes' == $settings->button->link_nofollow ) {
					$settings->button->link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->cta_link_nofollow ) ) {
				$settings->cta_link_nofollow = ( '1' == $settings->cta_link_nofollow ) ? 'yes' : '';
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) ) {
				unset( $settings->title_typography_font_size['desktop'] );
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) ) {
				unset( $settings->title_typography_font_size['medium'] );
			}
			if ( isset( $settings->title_typography_font_size['small'] ) ) {
				unset( $settings->title_typography_font_size['small'] );
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) ) {
				unset( $settings->title_typography_line_height['desktop'] );
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) ) {
				unset( $settings->title_typography_line_height['medium'] );
			}
			if ( isset( $settings->title_typography_line_height['small'] ) ) {
				unset( $settings->title_typography_line_height['small'] );
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) ) {
				unset( $settings->desc_typography_font_size['desktop'] );
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) ) {
				unset( $settings->desc_typography_font_size['medium'] );
			}
			if ( isset( $settings->desc_typography_font_size['small'] ) ) {
				unset( $settings->desc_typography_font_size['small'] );
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) ) {
				unset( $settings->desc_typography_line_height['desktop'] );
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) ) {
				unset( $settings->desc_typography_line_height['medium'] );
			}
			if ( isset( $settings->desc_typography_line_height['small'] ) ) {
				unset( $settings->desc_typography_line_height['small'] );
			}
			if ( isset( $settings->button->font_size ) ) {
				unset( $settings->button->font_size );
			}
			if ( isset( $settings->button->line_height ) ) {
				unset( $settings->button->line_height );
			}
		}
		return $settings;
	}
	/**
	 * Function to get the icon for the Interactive Banner 1
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-1/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-1/icon/' . $icon;
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
	 * Function that gets the data for the Interactive Banner 1 module
	 *
	 * @method get_data
	 */
	public function get_data() {
		// Make sure we have a banner_image_src property.
		if ( ! isset( $this->settings->banner_image_src ) ) {
			$this->settings->banner_image_src = '';
		}

		// Cache the attachment data.
		$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->banner_image );
		if ( ! $this->data ) {

			// Photo source is set to "library".
			if ( is_object( $this->settings->banner_image_src ) ) {
				$this->data = $this->settings->banner_image_src;
			} else {
				$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->banner_image_src );
			}

			// Data object is empty, use the settings cache.
			if ( ! $this->data && isset( $this->settings->data ) ) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * Function that gets the alt for the Interactive Banner 1 module
	 *
	 * @method get_alt
	 */
	public function get_alt() {
		$photo = $this->get_data();

		if ( ! empty( $photo->alt ) ) {
			return htmlspecialchars( $photo->alt );
		} elseif ( ! empty( $photo->description ) ) {
			return htmlspecialchars( $photo->description );
		} elseif ( ! empty( $photo->caption ) ) {
			return htmlspecialchars( $photo->caption );
		} elseif ( ! empty( $photo->title ) ) {
			return htmlspecialchars( $photo->title );
		}
	}

	/**
	 * Function that renders the button for the Interactive Banner 1 module
	 *
	 * @method render_button
	 */
	public function render_button() {
		if ( 'yes' == $this->settings->show_button ) {
			if ( '' != $this->settings->button ) {
				echo '<div class="uabb-ib1-button-outter">';
				FLBuilder::render_module_html( 'uabb-button', $this->settings->button );
				echo '</div>';
			}
		}
	}

	/**
	 * Function that renders the Icon.
	 *
	 * @method render_icon
	 */
	public function render_icon() {
		if ( '' != $this->settings->icon ) {
			$imageicon_array = array(

				/* General Section */
				'image_type'            => 'icon',

				/* Icon Basics */
				'icon'                  => $this->settings->icon,
				'icon_size'             => $this->settings->icon_size,
				'icon_align'            => '',

				/* Image Basics */
				'photo_source'          => '',
				'photo'                 => '',
				'photo_url'             => '',
				'img_size'              => '',
				'img_align'             => '',
				'photo_src'             => '',

				/* Icon Style */
				'icon_style'            => '',
				'icon_bg_size'          => '',
				'icon_border_style'     => '',
				'icon_border_width'     => '',
				'icon_bg_border_radius' => '',

				/* Image Style */
				'image_style'           => '',
				'img_bg_size'           => '',
				'img_border_style'      => '',
				'img_border_width'      => '',
				'img_bg_border_radius'  => '',
			);
			/* Render HTML Function */
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-1/interactive-banner-1-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-1/interactive-banner-1-bb-less-than-2-2-compatibility.php';
}
