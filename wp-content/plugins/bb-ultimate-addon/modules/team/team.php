<?php
/**
 *  UABB Team Module file
 *
 *  @package UABB Team Module
 */

/**
 * Function that initializes UABB Team Module
 *
 * @class UABBTeamModule
 */
class UABBTeamModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Team Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Team', 'uabb' ),
				'description'     => __( 'A Team module to show team member.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/team/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/team/',
				'partial_refresh' => true,
				'icon'            => 'team.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the team module
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/team/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/team/icon/' . $icon;
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

			if ( isset( $settings->custom_link_nofollow ) ) {
				if ( '1' == $settings->custom_link_nofollow || 'yes' == $settings->custom_link_nofollow ) {
					$settings->custom_link_nofollow = 'yes';
				}
			}
			// Handle opacity old values.
			$helper->handle_opacity_inputs( $settings, 'text_bg_color_opc', 'text_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );

			// For name typography settings.
			if ( ! isset( $settings->name_typo ) || ! is_array( $settings->name_typo ) ) {

				$settings->name_typo            = array();
				$settings->name_typo_medium     = array();
				$settings->name_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->name_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->name_typo['font_weight'] = 'normal';
					} else {
						$settings->name_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->name_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->name_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {
				$settings->name_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->name_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->name_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->name_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->name_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {

				$settings->name_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}

			// For designation typography settings.
			if ( ! isset( $settings->desg_typo ) || ! is_array( $settings->desg_typo ) ) {

				$settings->desg_typo            = array();
				$settings->desg_typo_medium     = array();
				$settings->desg_typo_responsive = array();
			}
			if ( isset( $settings->desg_font_family ) ) {

				if ( isset( $settings->desg_font_family['family'] ) ) {

					$settings->desg_typo['font_family'] = $settings->desg_font_family['family'];
					unset( $settings->desg_font_family['family'] );
				}
				if ( isset( $settings->desg_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desg_font_family['weight'] ) {
						$settings->desg_typo['font_weight'] = 'normal';
					} else {
						$settings->desg_typo['font_weight'] = $settings->desg_font_family['weight'];
					}
					unset( $settings->desg_font_family['weight'] );
				}
			}
			if ( isset( $settings->desg_font_size_unit ) ) {

				$settings->desg_typo['font_size'] = array(
					'length' => $settings->desg_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desg_font_size_unit );
			}
			if ( isset( $settings->desg_font_size_unit_medium ) ) {
				$settings->desg_typo_medium['font_size'] = array(
					'length' => $settings->desg_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desg_font_size_unit_medium );
			}
			if ( isset( $settings->desg_font_size_unit_responsive ) ) {
				$settings->desg_typo_responsive['font_size'] = array(
					'length' => $settings->desg_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desg_font_size_unit_responsive );
			}
			if ( isset( $settings->desg_line_height_unit ) ) {

				$settings->desg_typo['line_height'] = array(
					'length' => $settings->desg_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desg_line_height_unit );
			}
			if ( isset( $settings->desg_line_height_unit_medium ) ) {
				$settings->desg_typo_medium['line_height'] = array(
					'length' => $settings->desg_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desg_line_height_unit_medium );
			}
			if ( isset( $settings->desg_line_height_unit_responsive ) ) {
				$settings->desg_typo_responsive['line_height'] = array(
					'length' => $settings->desg_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desg_line_height_unit_responsive );
			}
			if ( isset( $settings->desg_transform ) ) {
				$settings->desg_typo['text_transform'] = $settings->desg_transform;
				unset( $settings->desg_transform );
			}
			if ( isset( $settings->desg_letter_spacing ) ) {

				$settings->desg_typo['letter_spacing'] = array(
					'length' => $settings->desg_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desg_letter_spacing );
			}

			// For description typography settings.
			if ( ! isset( $settings->desc_typo ) || ! is_array( $settings->desc_typo ) ) {

				$settings->desc_typo            = array();
				$settings->desc_typo_medium     = array();
				$settings->desc_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size_unit ) ) {

				$settings->desc_typo['font_size'] = array(
					'length' => $settings->desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit );
			}
			if ( isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_medium );
			}
			if ( isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_line_height_unit ) ) {

				$settings->desc_typo['line_height'] = array(
					'length' => $settings->desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit );
			}
			if ( isset( $settings->desc_line_height_unit_medium ) ) {
				$settings->desc_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_medium );
			}
			if ( isset( $settings->desc_line_height_unit_responsive ) ) {
				$settings->desc_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {
				$settings->desc_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );
			}
			if ( isset( $settings->desc_letter_spacing ) ) {

				$settings->desc_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			if ( isset( $settings->custom_link_nofollow ) ) {
				if ( '1' == $settings->custom_link_nofollow || 'yes' == $settings->custom_link_nofollow ) {
					$settings->custom_link_nofollow = 'yes';
				}
			}
			// Handle opacity old values.
			$helper->handle_opacity_inputs( $settings, 'text_bg_color_opc', 'text_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );

			// For name typography settings.
			if ( ! isset( $settings->name_typo ) || ! is_array( $settings->name_typo ) ) {

				$settings->name_typo            = array();
				$settings->name_typo_medium     = array();
				$settings->name_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->name_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->name_typo['font_weight'] = 'normal';
					} else {
						$settings->name_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->name_typo['font_size'] ) ) {

				$settings->name_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->name_typo_medium['font_size'] ) ) {
				$settings->name_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->name_typo_responsive['font_size'] ) ) {
				$settings->name_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->name_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->name_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->name_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For designation typography settings.
			if ( ! isset( $settings->desg_typo ) || ! is_array( $settings->desg_typo ) ) {

				$settings->desg_typo            = array();
				$settings->desg_typo_medium     = array();
				$settings->desg_typo_responsive = array();
			}
			if ( isset( $settings->desg_font_family ) ) {

				if ( isset( $settings->desg_font_family['family'] ) ) {

					$settings->desg_typo['font_family'] = $settings->desg_font_family['family'];
					unset( $settings->desg_font_family['family'] );
				}
				if ( isset( $settings->desg_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desg_font_family['weight'] ) {
						$settings->desg_typo['font_weight'] = 'normal';
					} else {
						$settings->desg_typo['font_weight'] = $settings->desg_font_family['weight'];
					}
					unset( $settings->desg_font_family['weight'] );
				}
			}
			if ( isset( $settings->desg_font_size['desktop'] ) && ! isset( $settings->desg_typo['font_size'] ) ) {

				$settings->desg_typo['font_size'] = array(
					'length' => $settings->desg_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desg_font_size['medium'] ) && ! isset( $settings->desg_typo_medium['font_size'] ) ) {
				$settings->desg_typo_medium['font_size'] = array(
					'length' => $settings->desg_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desg_font_size['small'] ) && ! isset( $settings->desg_typo_responsive['font_size'] ) ) {
				$settings->desg_typo_responsive['font_size'] = array(
					'length' => $settings->desg_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desg_line_height['desktop'] ) && isset( $settings->desg_font_size['desktop'] ) && 0 != $settings->desg_font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->desg_line_height['desktop'] ) && is_numeric( $settings->desg_font_size['desktop'] ) ) {
					$settings->desg_typo['line_height'] = array(
						'length' => round( $settings->desg_line_height['desktop'] / $settings->desg_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desg_line_height['medium'] ) && isset( $settings->desg_font_size['medium'] ) && 0 != $settings->desg_font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desg_line_height['medium'] ) && is_numeric( $settings->desg_font_size['medium'] ) ) {
					$settings->desg_typo_medium['line_height'] = array(
						'length' => round( $settings->desg_line_height['medium'] / $settings->desg_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desg_line_height['small'] ) && isset( $settings->desg_font_size['small'] ) && 0 != $settings->desg_font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desg_line_height['small'] ) && is_numeric( $settings->desg_font_size['small'] ) ) {
					$settings->desg_typo_responsive['line_height'] = array(
						'length' => round( $settings->desg_line_height['small'] / $settings->desg_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For description typography settings.
			if ( ! isset( $settings->desc_typo ) || ! is_array( $settings->desc_typo ) ) {

				$settings->desc_typo            = array();
				$settings->desc_typo_medium     = array();
				$settings->desc_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_typo['font_size'] ) ) {

				$settings->desc_typo['font_size'] = array(
					'length' => $settings->desc_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_typo_medium['font_size'] ) ) {
				$settings->desc_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_typo_responsive['font_size'] ) ) {
				$settings->desc_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_typo['line_height'] = array(
						'length' => round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->img_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->img_spacing );

				$output                                 = array();
				$uabb_default                           = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->img_spacing_dimension_top    = '';
				$settings->img_spacing_dimension_bottom = '';
				$settings->img_spacing_dimension_right  = '';
				$settings->img_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {

					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->img_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->img_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->img_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->img_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->img_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->img_spacing ) ) {
				unset( $settings->img_spacing );
			}
			if ( isset( $settings->text_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->text_spacing );

				$output                                  = array();
				$uabb_default                            = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->text_spacing_dimension_top    = '';
				$settings->text_spacing_dimension_bottom = '';
				$settings->text_spacing_dimension_right  = '';
				$settings->text_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->text_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->text_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->text_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->text_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->text_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->text_spacing ) ) {
				unset( $settings->text_spacing );
			}
			// Unset the old values.
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
			// Unset the old values.
			if ( isset( $settings->desg_font_size['desktop'] ) ) {
				unset( $settings->desg_font_size['desktop'] );
			}
			if ( isset( $settings->desg_font_size['medium'] ) ) {
				unset( $settings->desg_font_size['medium'] );
			}
			if ( isset( $settings->desg_font_size['small'] ) ) {
				unset( $settings->desg_font_size['small'] );
			}
			if ( isset( $settings->desg_line_height['desktop'] ) ) {
				unset( $settings->desg_line_height['desktop'] );
			}
			if ( isset( $settings->desg_line_height['medium'] ) ) {
				unset( $settings->desg_line_height['medium'] );
			}
			if ( isset( $settings->desg_line_height['small'] ) ) {
				unset( $settings->desg_line_height['small'] );
			}
			// Unset the old values.
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
		}

		return $settings;
	}

	/**
	 * Function that renders the image
	 *
	 * @method render_image
	 */
	public function render_image() {
		if ( isset( $this->settings->photo_src ) && '' != $this->settings->photo_src || isset( $this->settings->photo_url ) && '' != $this->settings->photo_url ) {
			/* Render Team Member Image */
			$imageicon_array = array(

				/* General Section */
				'image_type'            => 'photo',

				/* Icon Basics */
				'icon'                  => '',
				'icon_size'             => '',
				'icon_align'            => '',

				/* Image Basics */
				'photo_source'          => $this->settings->photo_source,
				'photo'                 => $this->settings->photo,
				'photo_url'             => $this->settings->photo_url,
				'img_size'              => $this->settings->img_size,
				'img_align'             => '',
				'photo_src'             => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '',

				/* Icon Style */
				'icon_style'            => '',
				'icon_bg_size'          => '',
				'icon_border_style'     => '',
				'icon_border_width'     => '',
				'icon_bg_border_radius' => '',

				/* Image Style */
				'image_style'           => $this->settings->image_style,
				'img_bg_size'           => '',
				'img_border_style'      => '',
				'img_border_width'      => '',
				'img_bg_border_radius'  => '',
			);

			/* Render HTML Function */
			echo ( isset( $this->settings->enable_custom_link ) && 'no' != $this->settings->enable_custom_link ) ? '<a href="' . $this->settings->custom_link . '" target ="' . $this->settings->custom_link_target . '">' : '';
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			echo ( isset( $this->settings->enable_custom_link ) && '' != $this->settings->enable_custom_link ) ? '</a>' : '';
		}
	}

	/**
	 * Function that renders name for the Team module.
	 *
	 * @method Render Name
	 */
	public function render_name() {
		if ( ! empty( $this->settings->name ) ) {
			$output  = '<div class="uabb-team-name" >';
			$output .= '<' . $this->settings->tag_selection . ' class="uabb-team-name-text">';
			$output .= ( isset( $this->settings->enable_custom_link ) && 'no' != $this->settings->enable_custom_link ) ? '<a href="' . $this->settings->custom_link . '" target ="' . $this->settings->custom_link_target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->custom_link_target, $this->settings->custom_link_nofollow, 0 ) . '>' . $this->settings->name . '</a>' : $this->settings->name;
			$output .= '</' . $this->settings->tag_selection . '>';
			$output .= '</div>';
			echo $output;
		}
	}

	/**
	 * Function that renders Designation
	 *
	 * @method Render Designation
	 */
	public function render_desgn() {
		if ( ! empty( $this->settings->designation ) ) {
			$output  = '<div class="uabb-team-desgn">';
			$output .= '<span class="uabb-team-desgn-text">' . $this->settings->designation . '</span>';
			$output .= '</div>';
			echo $output;
		}
	}

	/**
	 * Function that renders description
	 *
	 * @method Render Desc
	 */
	public function render_desc() {
		if ( ! empty( $this->settings->description ) ) {
			$output  = '<div class="uabb-team-desc">';
			$output .= '<span class="uabb-team-desc-text">' . $this->settings->description . '</span>';
			$output .= '</div>';
			echo $output;
		}
	}

	/**
	 * Function that renders Social Icons
	 *
	 * @method render_social_icons
	 */
	public function render_social_icons() {
		if ( 'yes' == $this->settings->enable_social_icons ) {
			$icon_count = 1;
			foreach ( $this->settings->icons as $icon ) {

				if ( isset( $icon->link ) ) {
					if ( isset( $icon->link_target ) ) {
						$icon->link_target = $icon->link_target;
					}

					if ( isset( $icon->link_nofollow ) ) {
						$icon->link_nofollow = $icon->link_nofollow;
					} else {
						$icon->link_nofollow = 0;
					}
				}

				if ( ! is_object( $icon ) ) {
					continue;
				}
				$icon->link_target = ( isset( $icon->link_target ) ) ? $icon->link_target : '_blank';
				echo '<a class="uabb-team-icon-link uabb-team-icon-' . $icon_count . '" href="' . $icon->link . '" target="' . $icon->link_target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $icon->link_target, $icon->link_nofollow, 0 ) . '>';
				$imageicon_array = array(

					/* General Section */
					'image_type'              => 'icon',

					/* Icon Basics */
					'icon'                    => $icon->icon,
					'icon_size'               => $this->settings->icon_size,
					'icon_align'              => 'center',

					/* Image Basics */
					'photo_source'            => '',
					'photo'                   => '',
					'photo_url'               => '',
					'img_size'                => '',
					'img_align'               => '',
					'photo_src'               => '',

					/* Icon Style */
					'icon_style'              => $this->settings->icon_style,
					'icon_bg_size'            => $this->settings->icon_bg_size,
					'icon_border_style'       => $this->settings->icon_border_style,
					'icon_border_width'       => $this->settings->icon_border_width,
					'icon_bg_border_radius'   => $this->settings->icon_bg_border_radius,

					/* Image Style */
					'image_style'             => '',
					'img_bg_size'             => '',
					'img_border_style'        => '',
					'img_border_width'        => '',
					'img_bg_border_radius'    => '',

					/* Preset Color variable new */
					'icon_color_preset'       => $this->settings->icon_color_preset,

					/* Icon Colors */
					'icon_color'              => ( ! empty( $icon->icocolor ) ) ? $icon->icocolor : $this->settings->icon_color,
					'icon_hover_color'        => ( ! empty( $icon->icohover_color ) ) ? $icon->icohover_color : $this->settings->icon_hover_color,
					'icon_bg_color'           => ( ! empty( $icon->icobg_color ) ) ? $icon->icobg_color : $this->settings->icon_bg_color,
					'icon_bg_hover_color'     => ( ! empty( $icon->icobg_hover_color ) ) ? $icon->icobg_hover_color : $this->settings->icon_bg_hover_color,
					'icon_border_color'       => ( ! empty( $icon->icoborder_color ) ) ? $icon->icoborder_color : $this->settings->icon_border_color,
					'icon_border_hover_color' => ( ! empty( $icon->icoborder_hover_color ) ) ? $icon->icoborder_hover_color : $this->settings->icon_border_hover_color,
					'icon_three_d'            => $this->settings->icon_three_d,

					/* Image Colors */
					'img_bg_color'            => '',
					'img_bg_hover_color'      => '',
					'img_border_color'        => '',
					'img_border_hover_color'  => '',
				);
				FLBuilder::render_module_html( 'image-icon', $imageicon_array );
				echo '</a>';
				$icon_count = $icon_count + 1;
			}
		}
	}

	/**
	 * Function that renders separator
	 *
	 * @method render_button
	 * @param var $pos gets the position for the separator.
	 */
	public function render_separator( $pos ) {

		if ( 'block' == $this->settings->enable_separator && ( $pos == $this->settings->separator_pos ) ) {
			$separator_settings = array(
				'color'     => $this->settings->separator_color,
				'height'    => $this->settings->separator_height,
				'width'     => $this->settings->separator_width,
				'alignment' => $this->settings->separator_alignment,
				'style'     => $this->settings->separator_style,
			);

			echo '<div class="uabb-team-separator">';
			FLBuilder::render_module_html( 'uabb-separator', $separator_settings );
			echo '</div>';
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/team/team-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/team/team-bb-less-than-2-2-compatibility.php';
}
