<?php
/**
 *  UABB CTA Module file
 *
 *  @package UABB CTA Module
 */

/**
 * Function that initializes UABB CTA Module
 *
 * @class UABBCtaModule
 */
class UABBCtaModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the CTA Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Call to Action', 'uabb' ),
				'description'     => __( 'Display a heading, subheading and a button.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-call-to-action/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-call-to-action/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'megaphone.svg',
			)
		);
	}

	/**
	 * Function that gets the class name
	 *
	 * @method get_classname
	 */
	public function get_classname() {
		$classname = 'uabb-cta-wrap uabb-cta-' . $this->settings->layout;

		if ( 'stacked' === $this->settings->layout ) {
			$classname .= ' uabb-cta-' . $this->settings->alignment;
		}

		return $classname;
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

			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			if ( ! isset( $settings->title_typo ) || ! is_array( $settings->title_typo ) ) {

				$settings->title_typo            = array();
				$settings->title_typo_medium     = array();
				$settings->title_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {

				if ( isset( $settings->title_font_family['family'] ) ) {

					$settings->title_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {

					if ( 'regular' === $settings->title_font_family['weight'] ) {
						$settings->title_typo['font_weight'] = 'normal';
					} else {
						$settings->title_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size_unit ) ) {
				$settings->title_typo['font_size'] = array(
					'length' => $settings->title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit );
			}
			if ( isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_medium );
			}
			if ( isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_responsive );
			}
			if ( isset( $settings->title_line_height_unit ) ) {

				$settings->title_typo['line_height'] = array(
					'length' => $settings->title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit );
			}
			if ( isset( $settings->title_line_height_unit_medium ) ) {
				$settings->title_typo_medium['line_height'] = array(
					'length' => $settings->title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_medium );
			}
			if ( isset( $settings->title_line_height_unit_responsive ) ) {
				$settings->title_typo_responsive['line_height'] = array(
					'length' => $settings->title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_responsive );
			}
			if ( isset( $settings->title_transform ) ) {
				$settings->title_typo['text_transform'] = $settings->title_transform;
				unset( $settings->title_transform );
			}
			if ( isset( $settings->title_letter_spacing ) ) {
				$settings->title_typo['letter_spacing'] = array(
					'length' => $settings->title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->title_letter_spacing );
			}
			// For Subheading Font Typography.
			if ( ! isset( $settings->subhead_typo ) || ! is_array( $settings->subhead_typo ) ) {

				$settings->subhead_typo            = array();
				$settings->subhead_typo_medium     = array();
				$settings->subhead_typo_responsive = array();
			}
			if ( isset( $settings->subhead_font_family ) ) {

				if ( isset( $settings->subhead_font_family['family'] ) ) {

					$settings->subhead_typo['font_family'] = $settings->subhead_font_family['family'];
					unset( $settings->subhead_font_family['family'] );
				}
				if ( isset( $settings->subhead_font_family['weight'] ) ) {

					if ( 'regular' === $settings->subhead_font_family['weight'] ) {
						$settings->subhead_typo['font_weight'] = 'normal';
					} else {
						$settings->subhead_typo['font_weight'] = $settings->subhead_font_family['weight'];
					}
					unset( $settings->subhead_font_family['weight'] );
				}
			}
			if ( isset( $settings->subhead_font_size_unit ) ) {

				$settings->subhead_typo['font_size'] = array(
					'length' => $settings->subhead_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit );
			}
			if ( isset( $settings->subhead_font_size_unit_medium ) ) {
				$settings->subhead_typo_medium['font_size'] = array(
					'length' => $settings->subhead_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit_medium );
			}
			if ( isset( $settings->subhead_font_size_unit_responsive ) ) {

				$settings->subhead_typo_responsive['font_size'] = array(
					'length' => $settings->subhead_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->subhead_font_size_unit_responsive );
			}
			if ( isset( $settings->subhead_line_height_unit ) ) {

				$settings->subhead_typo['line_height'] = array(
					'length' => $settings->subhead_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit );
			}
			if ( isset( $settings->subhead_line_height_unit_medium ) ) {
				$settings->subhead_typo_medium['line_height'] = array(
					'length' => $settings->subhead_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit_medium );
			}
			if ( isset( $settings->subhead_line_height_unit_responsive ) ) {
				$settings->subhead_typo_responsive['line_height'] = array(
					'length' => $settings->subhead_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->subhead_line_height_unit_responsive );
			}
			if ( isset( $settings->subhead_transform ) ) {

				$settings->subhead_typo['text_transform'] = $settings->subhead_transform;
				unset( $settings->subhead_transform );
			}
			if ( isset( $settings->subhead_letter_spacing ) ) {

				$settings->subhead_typo['letter_spacing'] = array(
					'length' => $settings->subhead_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->subhead_letter_spacing );
			}

			// For Button Font Typography.
			if ( ! isset( $settings->btn_typo ) || ! is_array( $settings->btn_typo ) ) {

				$settings->btn_typo            = array();
				$settings->btn_typo_medium     = array();
				$settings->btn_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->btn_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' === $settings->btn_font_family['weight'] ) {
						$settings->btn_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->btn_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->btn_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {
				$settings->btn_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {
				$settings->btn_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {
				$settings->btn_typo['text_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {
				$settings->btn_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}
			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' === $settings->btn_link_nofollow || 'yes' === $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' === $settings->btn_link_nofollow || 'yes' === $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			if ( ! isset( $settings->title_typo ) || ! is_array( $settings->title_typo ) ) {

				$settings->title_typo            = array();
				$settings->title_typo_medium     = array();
				$settings->title_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {

				if ( isset( $settings->title_font_family['family'] ) ) {

					$settings->title_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {

					if ( 'regular' === $settings->title_font_family['weight'] ) {
						$settings->title_typo['font_weight'] = 'normal';
					} else {
						$settings->title_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size['small'] ) ) {
				$settings->title_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				$settings->title_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				$settings->title_typo['font_size'] = array(
					'length' => $settings->title_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 !== $settings->title_font_size['small'] ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 !== $settings->title_font_size['medium'] ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_typo_medium['line_height'] = array(
						'length' => round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 !== $settings->title_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_typo['line_height'] = array(
						'length' => round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Subheading Font Typography.
			if ( ! isset( $settings->subhead_typo ) || ! is_array( $settings->subhead_typo ) ) {

				$settings->subhead_typo            = array();
				$settings->subhead_typo_medium     = array();
				$settings->subhead_typo_responsive = array();
			}
			if ( isset( $settings->subhead_font_family ) ) {

				if ( isset( $settings->subhead_font_family['family'] ) ) {

					$settings->subhead_typo['font_family'] = $settings->subhead_font_family['family'];
					unset( $settings->subhead_font_family['family'] );
				}
				if ( isset( $settings->subhead_font_family['weight'] ) ) {

					if ( 'regular' === $settings->subhead_font_family['weight'] ) {
						$settings->subhead_typo['font_weight'] = 'normal';
					} else {
						$settings->subhead_typo['font_weight'] = $settings->subhead_font_family['weight'];
					}
					unset( $settings->subhead_font_family['weight'] );
				}
			}
			if ( isset( $settings->subhead_font_size['small'] ) ) {
				$settings->subhead_typo_responsive['font_size'] = array(
					'length' => $settings->subhead_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subhead_font_size['medium'] ) ) {
				$settings->subhead_typo_medium['font_size'] = array(
					'length' => $settings->subhead_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subhead_font_size['desktop'] ) ) {
				$settings->subhead_typo['font_size'] = array(
					'length' => $settings->subhead_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->subhead_line_height['small'] ) && isset( $settings->subhead_font_size['small'] ) && 0 !== $settings->subhead_font_size['small'] ) {
				if ( is_numeric( $settings->subhead_line_height['small'] ) && is_numeric( $settings->subhead_font_size['small'] ) ) {
					$settings->subhead_typo['line_height'] = array(
						'length' => round( $settings->subhead_line_height['small'] / $settings->subhead_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subhead_line_height['medium'] ) && isset( $settings->subhead_font_size['medium'] ) && 0 !== $settings->subhead_font_size['medium'] ) {
				if ( is_numeric( $settings->subhead_line_height['medium'] ) && is_numeric( $settings->subhead_font_size['medium'] ) ) {
					$settings->subhead_typo_medium['line_height'] = array(
						'length' => round( $settings->subhead_line_height['medium'] / $settings->subhead_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subhead_line_height['desktop'] ) && isset( $settings->subhead_font_size['desktop'] ) && 0 !== $settings->subhead_font_size['desktop'] ) {
				if ( is_numeric( $settings->subhead_line_height['desktop'] ) && is_numeric( $settings->subhead_font_size['desktop'] ) ) {
					$settings->subhead_typo['line_height'] = array(
						'length' => round( $settings->subhead_line_height['desktop'] / $settings->subhead_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Button Font Typography.
			if ( ! isset( $settings->btn_typo ) || ! is_array( $settings->btn_typo ) ) {

				$settings->btn_typo            = array();
				$settings->btn_typo_medium     = array();
				$settings->btn_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->btn_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' === $settings->btn_font_family['weight'] ) {
						$settings->btn_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				$settings->btn_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				$settings->btn_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				$settings->btn_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 !== $settings->btn_font_size['small'] ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 !== $settings->btn_font_size['medium'] ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 !== $settings->btn_font_size['desktop'] ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_link_nofollow ) ) {
				if ( '1' === $settings->btn_link_nofollow || 'yes' === $settings->btn_link_nofollow ) {
					$settings->btn_link_nofollow = 'yes';
				}
			}
			// Unset the old values.
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
			// Unset the old values.
			if ( isset( $settings->btn_font_size ) ) {
				unset( $settings->btn_font_size );
			}
			if ( isset( $settings->btn_line_height ) ) {
				unset( $settings->btn_line_height );
			}
			// Unset the old values.
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
		}

		return $settings;
	}

	/**
	 * Function that renders the button
	 *
	 * @method render_button
	 */
	public function render_button() {

		$version_bb_check = UABB_Compatibility::$version_bb_check;

		if ( $version_bb_check ) {

			$link_nofollow = '';

			$link_nofollow = ( 'yes' === $this->settings->btn_link_nofollow && isset( $this->settings->btn_link_nofollow ) ) ? '1' : '';

			$btn_adv_typo = '';

			if ( isset( $this->settings->btn_typo['font_family'] ) && isset( $this->settings->btn_typo['font_weight'] ) ) {

				$btn_adv_typo = array(
					'family' => $this->settings->btn_typo['font_family'],
					'weight' => $this->settings->btn_typo['font_weight'],
				);
			}

			$btn_settings = array(

				/* General Section */
				'text'                                     => $this->settings->btn_text,

				/* Link Section */
				'link'                                     => $this->settings->btn_link,
				'link_target'                              => $this->settings->btn_link_target,
				'link_nofollow'                            => $link_nofollow,

				/* Style Section */
				'style'                                    => $this->settings->btn_style,
				'border_size'                              => $this->settings->btn_border_size,
				'transparent_button_options'               => $this->settings->btn_transparent_button_options,
				'threed_button_options'                    => $this->settings->btn_threed_button_options,
				'flat_button_options'                      => $this->settings->btn_flat_button_options,

				/* Colors */
				'bg_color'                                 => $this->settings->btn_bg_color,
				'bg_hover_color'                           => $this->settings->btn_bg_hover_color,
				'text_color'                               => $this->settings->btn_text_color,
				'text_hover_color'                         => $this->settings->btn_text_hover_color,

				/* Icon */
				'icon'                                     => $this->settings->btn_icon,
				'icon_position'                            => $this->settings->btn_icon_position,

				/* Structure */
				'width'                                    => $this->settings->btn_width,
				'custom_width'                             => $this->settings->btn_custom_width,
				'custom_height'                            => $this->settings->btn_custom_height,
				'padding_top_bottom'                       => $this->settings->btn_padding_top_bottom,
				'padding_left_right'                       => $this->settings->btn_padding_left_right,
				'border_radius'                            => $this->settings->btn_border_radius,
				'align'                                    => '',
				'mob_align'                                => '',

				/* Typography */
				'font_size'                                => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
				'line_height'                              => ( isset( $this->settings->btn_line_height ) ) ? $this->settings->btn_line_height : '',
				'button_typo'                              => ( isset( $this->settings->btn_typo ) ) ? $this->settings->btn_typo : '',
				'button_typo_medium'                       => ( isset( $this->settings->btn_typo_medium ) ) ? $this->settings->btn_typo_medium : '',
				'button_typo_responsive'                   => ( isset( $this->settings->btn_typo_responsive ) ) ? $this->settings->btn_typo_responsive : '',
				'button_padding_dimension_top'             => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
				'button_border'                            => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
				'border_hover_color'                       => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',

			);

		} else {

			$btn_settings = array(

				/* General Section */
				'text'                                     => $this->settings->btn_text,

				/* Link Section */
				'link'                                     => $this->settings->btn_link,
				'link_target'                              => $this->settings->btn_link_target,
				'link_nofollow'                            => $this->settings->btn_link_nofollow,

				/* Style Section */
				'style'                                    => $this->settings->btn_style,
				'border_size'                              => $this->settings->btn_border_size,
				'transparent_button_options'               => $this->settings->btn_transparent_button_options,
				'threed_button_options'                    => $this->settings->btn_threed_button_options,
				'flat_button_options'                      => $this->settings->btn_flat_button_options,

				/* Colors */
				'bg_color'                                 => $this->settings->btn_bg_color,
				'bg_hover_color'                           => $this->settings->btn_bg_hover_color,
				'text_color'                               => $this->settings->btn_text_color,
				'text_hover_color'                         => $this->settings->btn_text_hover_color,

				/* Icon */
				'icon'                                     => $this->settings->btn_icon,
				'icon_position'                            => $this->settings->btn_icon_position,

				/* Structure */
				'width'                                    => $this->settings->btn_width,
				'custom_width'                             => $this->settings->btn_custom_width,
				'custom_height'                            => $this->settings->btn_custom_height,
				'padding_top_bottom'                       => $this->settings->btn_padding_top_bottom,
				'padding_left_right'                       => $this->settings->btn_padding_left_right,
				'border_radius'                            => $this->settings->btn_border_radius,
				'align'                                    => '',
				'mob_align'                                => '',

				/* Typography */
				'font_size'                                => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
				'line_height'                              => ( isset( $this->settings->btn_line_height ) ) ? $this->settings->btn_line_height : '',
				'font_size_unit'                           => $this->settings->btn_font_size_unit,
				'line_height_unit'                         => $this->settings->btn_line_height_unit,
				'font_size_unit_medium'                    => $this->settings->btn_font_size_unit_medium,
				'line_height_unit_medium'                  => $this->settings->btn_line_height_unit_medium,
				'font_size_unit_responsive'                => $this->settings->btn_font_size_unit_responsive,
				'line_height_unit_responsive'              => $this->settings->btn_line_height_unit_responsive,
				'font_family'                              => $this->settings->btn_font_family,
				'transform'                                => $this->settings->btn_transform,
				'letter_spacing'                           => $this->settings->btn_letter_spacing,
				'button_padding_dimension_top'             => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
				'button_border_style'                      => ( isset( $this->settings->button_border_style ) ) ? $this->settings->button_border_style : '',
				'button_border_width'                      => ( isset( $this->settings->button_border_width ) ) ? $this->settings->button_border_width : '',
				'button_border_radius'                     => ( isset( $this->settings->button_border_radius ) ) ? $this->settings->button_border_radius : '',
				'button_border_color'                      => ( isset( $this->settings->button_border_color ) ) ? $this->settings->button_border_color : '',

				'border_hover_color'                       => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
			);
		}

		FLBuilder::render_module_html( 'uabb-button', $btn_settings );
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-call-to-action/uabb-call-to-action-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-call-to-action/uabb-call-to-action-bb-less-than-2-2-compatibility.php';
}
