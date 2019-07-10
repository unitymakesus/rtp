<?php
/**
 *  UABB Creative Menu file
 *
 *  @package UABB Creative Menu
 */

/**
 * Function that initializes UABB Creative Menu
 *
 * @class UABBCreativeMenu
 */
class UABBCreativeMenu extends FLBuilderModule {
	/**
	 * Parent class constructor function that constructs default values for the Creative Menu
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Menu', 'uabb' ),
				'description'     => __( 'Advanced Menu', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-advanced-menu/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-advanced-menu/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'hamburger-menu.svg',
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
			// Handle old submenu border settings.
			if ( isset( $settings->creative_submenu_border_color ) ) {

				$settings->submenu_border            = array();
				$settings->submenu_border_medium     = array();
				$settings->submenu_border_responsive = array();

				// Border style, color, and width.
				if ( isset( $settings->creative_submenu_border_style ) ) {
					$settings->submenu_border['style'] = $settings->creative_submenu_border_style;
					unset( $settings->creative_submenu_border_style );
				}
				$settings->submenu_border['color'] = $settings->creative_submenu_border_color;
				unset( $settings->creative_submenu_border_color );

				if ( isset( $settings->creative_submenu_border_width_dimension_top ) && isset( $settings->creative_submenu_border_width_dimension_right ) && isset( $settings->creative_submenu_border_width_dimension_bottom ) && isset( $settings->creative_submenu_border_width_dimension_left ) ) {
						$settings->submenu_border['width'] = array(
							'top'    => $settings->creative_submenu_border_width_dimension_top,
							'right'  => $settings->creative_submenu_border_width_dimension_right,
							'bottom' => $settings->creative_submenu_border_width_dimension_bottom,
							'left'   => $settings->creative_submenu_border_width_dimension_left,
						);
					unset( $settings->creative_submenu_border_width_dimension_top );
					unset( $settings->creative_submenu_border_width_dimension_right );
					unset( $settings->creative_submenu_border_width_dimension_bottom );
					unset( $settings->creative_submenu_border_width_dimension_left );
				}

				if ( isset( $settings->creative_submenu_border_width_dimension_top_medium ) && isset( $settings->creative_submenu_border_width_dimension_right_medium ) && isset( $settings->creative_submenu_border_width_dimension_bottom_medium ) && isset( $settings->creative_submenu_border_width_dimension_left_medium ) ) {
						$settings->submenu_border_medium['width'] = array(
							'top'    => $settings->creative_submenu_border_width_dimension_top_medium,
							'right'  => $settings->creative_submenu_border_width_dimension_right_medium,
							'bottom' => $settings->creative_submenu_border_width_dimension_bottom_medium,
							'left'   => $settings->creative_submenu_border_width_dimension_left_medium,
						);
					unset( $settings->creative_submenu_border_width_dimension_top_medium );
					unset( $settings->creative_submenu_border_width_dimension_right_medium );
					unset( $settings->creative_submenu_border_width_dimension_bottom_medium );
					unset( $settings->creative_submenu_border_width_dimension_left_medium );
				}

				if ( isset( $settings->creative_submenu_border_width_dimension_top_responsive ) && isset( $settings->creative_submenu_border_width_dimension_right_responsive ) && isset( $settings->creative_submenu_border_width_dimension_bottom_responsive ) && isset( $settings->creative_submenu_border_width_dimension_left_responsive ) ) {
						$settings->submenu_border_responsive['width'] = array(
							'top'    => $settings->creative_submenu_border_width_dimension_top_responsive,
							'right'  => $settings->creative_submenu_border_width_dimension_right_responsive,
							'bottom' => $settings->creative_submenu_border_width_dimension_bottom_responsive,
							'left'   => $settings->creative_submenu_border_width_dimension_left_responsive,
						);
					unset( $settings->creative_submenu_border_width_dimension_top_responsive );
					unset( $settings->creative_submenu_border_width_dimension_right_responsive );
					unset( $settings->creative_submenu_border_width_dimension_bottom_responsive );
					unset( $settings->creative_submenu_border_width_dimension_left_responsive );
				}
			}

			// Handle old menu border settings.
			if ( isset( $settings->creative_menu_border_color ) ) {

				$settings->menu_border            = array();
				$settings->menu_border_medium     = array();
				$settings->menu_border_responsive = array();

				// Border style, color, and width.
				if ( isset( $settings->creative_menu_border_style ) ) {
					$settings->menu_border['style'] = $settings->creative_menu_border_style;
					unset( $settings->creative_menu_border_style );
				}
				$settings->menu_border['color'] = $settings->creative_menu_border_color;
				unset( $settings->creative_menu_border_color );

				if ( isset( $settings->creative_menu_border_width_dimension_top ) && isset( $settings->creative_menu_border_width_dimension_right ) && isset( $settings->creative_menu_border_width_dimension_bottom ) && isset( $settings->creative_menu_border_width_dimension_left ) ) {
						$settings->menu_border['width'] = array(
							'top'    => $settings->creative_menu_border_width_dimension_top,
							'right'  => $settings->creative_menu_border_width_dimension_right,
							'bottom' => $settings->creative_menu_border_width_dimension_bottom,
							'left'   => $settings->creative_menu_border_width_dimension_left,
						);
					unset( $settings->creative_menu_border_width_dimension_top );
					unset( $settings->creative_menu_border_width_dimension_right );
					unset( $settings->creative_menu_border_width_dimension_bottom );
					unset( $settings->creative_menu_border_width_dimension_left );
				}

				if ( isset( $settings->creative_menu_border_width_dimension_top_medium ) && isset( $settings->creative_menu_border_width_dimension_right_medium ) && isset( $settings->creative_menu_border_width_dimension_bottom_medium ) && isset( $settings->creative_menu_border_width_dimension_left_medium ) ) {
						$settings->menu_border_medium['width'] = array(
							'top'    => $settings->creative_menu_border_width_dimension_top_medium,
							'right'  => $settings->creative_menu_border_width_dimension_right_medium,
							'bottom' => $settings->creative_menu_border_width_dimension_bottom_medium,
							'left'   => $settings->creative_menu_border_width_dimension_left_medium,
						);
					unset( $settings->creative_menu_border_width_dimension_top_medium );
					unset( $settings->creative_menu_border_width_dimension_right_medium );
					unset( $settings->creative_menu_border_width_dimension_bottom_medium );
					unset( $settings->creative_menu_border_width_dimension_left_medium );
				}

				if ( isset( $settings->creative_menu_border_width_dimension_top_responsive ) && isset( $settings->creative_menu_border_width_dimension_right_responsive ) && isset( $settings->creative_menu_border_width_dimension_bottom_responsive ) && isset( $settings->creative_menu_border_width_dimension_left_responsive ) ) {
						$settings->menu_border_responsive['width'] = array(
							'top'    => $settings->creative_menu_border_width_dimension_top_responsive,
							'right'  => $settings->creative_menu_border_width_dimension_right_responsive,
							'bottom' => $settings->creative_menu_border_width_dimension_bottom_responsive,
							'left'   => $settings->creative_menu_border_width_dimension_left_responsive,
						);
					unset( $settings->creative_menu_border_width_dimension_top_responsive );
					unset( $settings->creative_menu_border_width_dimension_right_responsive );
					unset( $settings->creative_menu_border_width_dimension_bottom_responsive );
					unset( $settings->creative_menu_border_width_dimension_left_responsive );
				}
			}
			// For menu typography.
			if ( ! isset( $settings->creative_menu_link_font_typo ) || ! is_array( $settings->creative_menu_link_font_typo ) ) {

				$settings->creative_menu_link_font_typo            = array();
				$settings->creative_menu_link_font_typo_medium     = array();
				$settings->creative_menu_link_font_typo_responsive = array();
			}
			if ( isset( $settings->creative_menu_link_font_size ) || isset( $settings->creative_menu_link_text_transform ) || isset( $settings->creative_menu_link_letter_spacing ) || isset( $settings->creative_menu_link_font_family['family'] ) ) {

				if ( ( isset( $settings->creative_menu_link_font_size ) && 'custom' == $settings->creative_menu_link_font_size ) || ( isset( $settings->creative_menu_link_line_height ) && 'custom' == $settings->creative_menu_link_line_height ) || isset( $settings->creative_menu_link_text_transform ) || ( isset( $settings->creative_menu_link_letter_spacing ) && '' !== $settings->creative_menu_link_letter_spacing ) || ( isset( $settings->creative_menu_link_font_family['family'] ) && 'Default' !== $settings->creative_menu_link_font_family['family'] ) ) {

					$settings->creative_menu_link_typo = 'custom';
				}
			}
			if ( isset( $settings->creative_menu_link_font_family ) ) {

				if ( isset( $settings->creative_menu_link_font_family['family'] ) ) {

					$settings->creative_menu_link_font_typo['font_family'] = $settings->creative_menu_link_font_family['family'];
					unset( $settings->creative_menu_link_font_family['family'] );
				}
				if ( isset( $settings->creative_menu_link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->creative_menu_link_font_family['weight'] ) {
						$settings->creative_menu_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->creative_menu_link_font_typo['font_weight'] = $settings->creative_menu_link_font_family['weight'];
					}
					unset( $settings->creative_menu_link_font_family['weight'] );
				}
			}
			if ( isset( $settings->creative_menu_link_font_size_custom ) ) {

				$settings->creative_menu_link_font_typo['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_medium ) ) {
				$settings->creative_menu_link_font_typo_medium['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_responsive ) ) {
				$settings->creative_menu_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom ) ) {

				$settings->creative_menu_link_font_typo['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_medium ) ) {
				$settings->creative_menu_link_font_typo_medium['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_responsive ) ) {
				$settings->creative_menu_link_font_typo_responsive['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_text_transform ) ) {

				$settings->creative_menu_link_font_typo['text_transform'] = $settings->creative_menu_link_text_transform;
			}
			if ( isset( $settings->creative_menu_link_letter_spacing ) ) {
				$settings->creative_menu_link_font_typo['letter_spacing'] = array(
					'length' => $settings->creative_menu_link_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->creative_menu_link_letter_spacing );
			}
			// For submenu typography settings.
			if ( ! isset( $settings->creative_submenu_link_font_typo ) || ! is_array( $settings->creative_submenu_link_font_typo ) ) {

				$settings->creative_submenu_link_font_typo            = array();
				$settings->creative_submenu_link_font_typo_medium     = array();
				$settings->creative_submenu_link_font_typo_responsive = array();
			}
			if ( isset( $settings->creative_submenu_link_font_size ) || isset( $settings->creative_submenu_link_line_height ) || isset( $settings->creative_submenu_link_text_transform ) || isset( $settings->creative_submenu_link_letter_spacing ) || isset( $settings->creative_submenu_link_font_family['family'] ) ) {

				if ( ( isset( $settings->creative_submenu_link_font_size ) && 'custom' == $settings->creative_submenu_link_font_size ) || ( isset( $settings->creative_submenu_link_line_height ) && 'custom' == $settings->creative_submenu_link_line_height ) || ( isset( $settings->creative_submenu_link_text_transform ) && '' !== $settings->creative_submenu_link_text_transform ) || ( isset( $settings->creative_submenu_link_letter_spacing ) && '' !== $settings->creative_submenu_link_letter_spacing ) || ( isset( $settings->creative_submenu_link_font_family['family'] ) && 'Default' !== $settings->creative_submenu_link_font_family['family'] ) ) {

					$settings->creative_submenu_link_typogarphy = 'custom';
				}
			}
			if ( isset( $settings->creative_submenu_link_font_family ) ) {

				if ( isset( $settings->creative_submenu_link_font_family['family'] ) ) {

					$settings->creative_submenu_link_font_typo['font_family'] = $settings->creative_submenu_link_font_family['family'];
					unset( $settings->creative_submenu_link_font_family['family'] );
				}
				if ( isset( $settings->creative_submenu_link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->creative_submenu_link_font_family['weight'] ) {
						$settings->creative_submenu_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->creative_submenu_link_font_typo['font_weight'] = $settings->creative_submenu_link_font_family['weight'];
					}
					unset( $settings->creative_submenu_link_font_family['weight'] );
				}
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom ) ) {

				$settings->creative_submenu_link_font_typo['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_medium ) ) {
				$settings->creative_submenu_link_font_typo_medium['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_responsive ) ) {
				$settings->creative_submenu_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom ) ) {

				$settings->creative_submenu_link_font_typo['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_medium ) ) {
				$settings->creative_submenu_link_font_typo_medium['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_responsive ) ) {
				$settings->creative_submenu_link_font_typo_responsive['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_text_transform ) ) {

				$settings->creative_submenu_link_font_typo['text_transform'] = $settings->creative_submenu_link_text_transform;

			}
			if ( isset( $settings->creative_submenu_link_letter_spacing ) ) {

				$settings->creative_submenu_link_font_typo['letter_spacing'] = array(
					'length' => $settings->creative_submenu_link_letter_spacing,
					'unit'   => 'px',
				);
			}
			// Unset the old values.
			if ( isset( $settings->creative_menu_link_font_size_custom ) ) {
				unset( $settings->creative_menu_link_font_size_custom );
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_medium ) ) {
				unset( $settings->creative_menu_link_font_size_custom_medium );
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_responsive ) ) {
				unset( $settings->creative_menu_link_font_size_custom_responsive );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom ) ) {
				unset( $settings->creative_menu_link_line_height_custom );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_medium ) ) {
				unset( $settings->creative_menu_link_line_height_custom_medium );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_responsive ) ) {
				unset( $settings->creative_menu_link_line_height_custom_responsive );
			}
			if ( isset( $settings->creative_menu_link_text_transform ) ) {
				unset( $settings->creative_menu_link_text_transform );
			}
			if ( isset( $settings->creative_menu_link_letter_spacing ) ) {
				unset( $settings->creative_menu_link_letter_spacing );
			}
			// Unset the old values.
			if ( isset( $settings->creative_submenu_link_font_size_custom ) ) {
				unset( $settings->creative_submenu_link_font_size_custom );
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_medium ) ) {
				unset( $settings->creative_submenu_link_font_size_custom_medium );
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_responsive ) ) {
				unset( $settings->creative_submenu_link_font_size_custom_responsive );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom ) ) {
				unset( $settings->creative_submenu_link_line_height_custom );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_medium ) ) {
				unset( $settings->creative_submenu_link_line_height_custom_medium );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_responsive ) ) {
				unset( $settings->creative_submenu_link_line_height_custom_responsive );
			}
			if ( isset( $settings->creative_submenu_link_text_transform ) ) {
				unset( $settings->creative_submenu_link_text_transform );
			}
			if ( isset( $settings->creative_submenu_link_letter_spacing ) ) {
				unset( $settings->creative_submenu_link_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Menu margin setting.
			if ( isset( $settings->creative_menu_link_margin ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_link_margin );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->creative_menu_link_margin_dimension_top    = '';
				$settings->creative_menu_link_margin_dimension_bottom = '';
				$settings->creative_menu_link_margin_dimension_left   = '';
				$settings->creative_menu_link_margin_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'margin-top':
							$settings->creative_menu_link_margin_dimension_top = (int) $output[ $i ][1];
							break;
						case 'margin-bottom':
							$settings->creative_menu_link_margin_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'margin-right':
							$settings->creative_menu_link_margin_dimension_right = (int) $output[ $i ][1];
							break;
						case 'margin-left':
							$settings->creative_menu_link_margin_dimension_left = (int) $output[ $i ][1];
							break;
						case 'margin':
							$settings->creative_menu_link_margin_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_menu_link_margin );
			}

			// Menu link spacing.
			if ( isset( $settings->creative_menu_link_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_link_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_link_spacing_dimension_top    = '';
				$settings->creative_menu_link_spacing_dimension_bottom = '';
				$settings->creative_menu_link_spacing_dimension_right  = '';
				$settings->creative_menu_link_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_link_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_link_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_link_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_link_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_link_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_menu_link_spacing );
			}

			// Sub menu padding setting.
			if ( isset( $settings->creative_submenu_link_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_submenu_link_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_submenu_link_padding_dimension_top    = '';
				$settings->creative_submenu_link_padding_dimension_bottom = '';
				$settings->creative_submenu_link_padding_dimension_right  = '';
				$settings->creative_submenu_link_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_submenu_link_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_submenu_link_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_submenu_link_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_submenu_link_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_submenu_link_padding );
			}

			// Menu responsive overlay padding setting.
			if ( isset( $settings->creative_menu_responsive_overlay_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_responsive_overlay_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_responsive_overlay_padding_dimension_top    = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_bottom = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_right  = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_responsive_overlay_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_responsive_overlay_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_responsive_overlay_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_responsive_overlay_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_menu_responsive_overlay_padding );
			}

			// Handle old submenu border settings.
			if ( isset( $settings->creative_submenu_border_color ) ) {

				$settings->submenu_border = array();

				// Border style, color, and width.
				if ( isset( $settings->creative_submenu_border_style ) ) {
					$settings->submenu_border['style'] = $settings->creative_submenu_border_style;
					unset( $settings->creative_submenu_border_style );
				}
				$settings->submenu_border['color'] = $settings->creative_submenu_border_color;
				unset( $settings->creative_submenu_border_color );
				if ( isset( $settings->creative_submenu_border_width ) && ! isset( $settings->creative_submenu_border_width_dimension_top ) && ! isset( $settings->creative_submenu_border_width_dimension_bottom ) && ! isset( $settings->creative_submenu_border_width_dimension_left ) && ! isset( $settings->creative_submenu_border_width_dimension_right ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->creative_submenu_border_width );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
					$settings->creative_submenu_border_width_dimension_top    = '';
					$settings->creative_submenu_border_width_dimension_bottom = '';
					$settings->creative_submenu_border_width_dimension_right  = '';
					$settings->creative_submenu_border_width_dimension_left   = '';
					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}
					for ( $i = 0; $i < count( $output ); $i++ ) {
						switch ( $output[ $i ][0] ) {

							case 'padding-top':
								$submenu_border_top = (int) $output[ $i ][1];
								break;
							case 'padding-bottom':
								$submenu_border_bottom = (int) $output[ $i ][1];
								break;
							case 'padding-right':
								$submenu_border_right = (int) $output[ $i ][1];
								break;
							case 'padding-left':
								$submenu_border_left = (int) $output[ $i ][1];
								break;
							case 'padding':
								$submenu_border_top    = (int) $output[ $i ][1];
								$submenu_border_bottom = (int) $output[ $i ][1];
								$submenu_border_right  = (int) $output[ $i ][1];
								$submenu_border_left   = (int) $output[ $i ][1];
								break;
						}
					}
					if ( isset( $submenu_border_top ) && isset( $submenu_border_right ) && isset( $submenu_border_bottom ) && isset( $submenu_border_left ) ) {
						$settings->submenu_border['width'] = array(
							'top'    => $submenu_border_top,
							'right'  => $submenu_border_right,
							'bottom' => $submenu_border_bottom,
							'left'   => $submenu_border_left,
						);
						unset( $submenu_border_top );
						unset( $submenu_border_right );
						unset( $submenu_border_bottom );
						unset( $submenu_border_left );
					}
				}
			}

			// Handle old menu border settings.
			if ( isset( $settings->creative_menu_border_color ) ) {

				$settings->menu_border = array();

				// Border style, color, and width.
				if ( isset( $settings->creative_menu_border_style ) ) {
					if ( isset( $settings->creative_menu_border_style ) ) {
						$settings->menu_border['style'] = $settings->creative_menu_border_style;
						unset( $settings->creative_menu_border_style );
					}
					if ( isset( $settings->creative_menu_border_color ) ) {
						$settings->menu_border['color'] = $settings->creative_menu_border_color;
						unset( $settings->creative_menu_border_color );
					}

					if ( isset( $settings->creative_menu_border_width ) && ! isset( $settings->creative_menu_border_width_dimension_top ) && ! isset( $settings->creative_menu_border_width_dimension_bottom ) && ! isset( $settings->creative_menu_border_width_dimension_left ) && ! isset( $settings->creative_menu_border_width_dimension_right ) ) {

						$value = '';
						$value = str_replace( 'px', '', $settings->creative_menu_border_width );

						$output       = array();
						$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
						$settings->creative_menu_border_width_dimension_top    = '';
						$settings->creative_menu_border_width_dimension_bottom = '';
						$settings->creative_menu_border_width_dimension_right  = '';
						$settings->creative_menu_border_width_dimension_left   = '';
						foreach ( $uabb_default as $val ) {
							$new      = explode( ':', $val );
							$output[] = $new;
						}
						for ( $i = 0; $i < count( $output ); $i++ ) {
							switch ( $output[ $i ][0] ) {

								case 'padding-top':
									$menu_border_top = (int) $output[ $i ][1];
									break;
								case 'padding-bottom':
									$menu_border_bottom = (int) $output[ $i ][1];
									break;
								case 'padding-right':
									$menu_border_right = (int) $output[ $i ][1];
									break;
								case 'padding-left':
									$menu_border_left = (int) $output[ $i ][1];
									break;
								case 'padding':
									$menu_border_top    = (int) $output[ $i ][1];
									$menu_border_bottom = (int) $output[ $i ][1];
									$menu_border_left   = (int) $output[ $i ][1];
									$menu_border_right  = (int) $output[ $i ][1];
									break;
							}
						}
					}
					if ( isset( $menu_border_top ) && isset( $menu_border_right ) && isset( $menu_border_bottom ) && isset( $menu_border_left ) ) {
						$settings->menu_border['width'] = array(
							'top'    => $menu_border_top,
							'right'  => $menu_border_right,
							'bottom' => $menu_border_bottom,
							'left'   => $menu_border_left,
						);
						unset( $menu_border_top );
						unset( $menu_border_right );
						unset( $menu_border_bottom );
						unset( $menu_border_left );
					}
				}
			}
			// For menu typography settings.
			if ( ! isset( $settings->creative_menu_link_font_typo ) || ! is_array( $settings->creative_menu_link_font_typo ) ) {

				$settings->creative_menu_link_font_typo            = array();
				$settings->creative_menu_link_font_typo_medium     = array();
				$settings->creative_menu_link_font_typo_responsive = array();
			}
			if ( isset( $settings->creative_menu_link_font_size ) || isset( $settings->creative_menu_link_font_family['family'] ) ) {

				if ( ( isset( $settings->creative_menu_link_font_size ) && 'custom' == $settings->creative_menu_link_font_size ) || ( isset( $settings->creative_menu_link_line_height ) && 'custom' == $settings->creative_menu_link_line_height ) || ( isset( $settings->creative_menu_link_font_family['family'] ) && 'Default' != $settings->creative_menu_link_font_family['family'] ) ) {
					$settings->creative_menu_link_typo = 'custom';
				}
			}
			if ( isset( $settings->creative_menu_link_font_family ) ) {

				if ( isset( $settings->creative_menu_link_font_family['family'] ) ) {

					$settings->creative_menu_link_font_typo['font_family'] = $settings->creative_menu_link_font_family['family'];
					unset( $settings->creative_menu_link_font_family['family'] );
				}
				if ( isset( $settings->creative_menu_link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->creative_menu_link_font_family['weight'] ) {
						$settings->creative_menu_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->creative_menu_link_font_typo['font_weight'] = $settings->creative_menu_link_font_family['weight'];
					}
					unset( $settings->creative_menu_link_font_family['weight'] );
				}
			}
			if ( isset( $settings->creative_menu_link_font_size_custom ) ) {

				$settings->creative_menu_link_font_typo['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_medium ) ) {
				$settings->creative_menu_link_font_typo_medium['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_responsive ) ) {
				$settings->creative_menu_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->creative_menu_link_font_size_custom_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom ) ) {

				$settings->creative_menu_link_font_typo['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_medium ) ) {
				$settings->creative_menu_link_font_typo_medium['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_responsive ) ) {
				$settings->creative_menu_link_font_typo_responsive['line_height'] = array(
					'length' => $settings->creative_menu_link_line_height_custom_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_menu_link_text_transform ) ) {

				$settings->creative_menu_link_font_typo['text_transform'] = $settings->creative_menu_link_text_transform;

			}
			if ( isset( $settings->creative_menu_link_letter_spacing ) ) {

				$settings->creative_menu_link_font_typo['letter_spacing'] = array(
					'length' => $settings->creative_menu_link_letter_spacing,
					'unit'   => 'px',
				);
			}

			// For submenu typography settings.
			if ( ! isset( $settings->creative_submenu_link_font_typo ) || ! is_array( $settings->creative_submenu_link_font_typo ) ) {

				$settings->creative_submenu_link_font_typo            = array();
				$settings->creative_submenu_link_font_typo_medium     = array();
				$settings->creative_submenu_link_font_typo_responsive = array();
			}
			if ( isset( $settings->creative_submenu_link_font_size ) || isset( $settings->creative_submenu_link_line_height ) || isset( $settings->creative_submenu_link_font_family['family'] ) ) {

				if ( ( isset( $settings->creative_submenu_link_font_size ) && 'custom' == $settings->creative_submenu_link_font_size ) || ( isset( $settings->creative_submenu_link_line_height ) && 'custom' == $settings->creative_submenu_link_line_height ) || ( isset( $settings->creative_submenu_link_font_family['family'] ) && 'Default' != $settings->creative_submenu_link_font_family['family'] ) ) {
					$settings->creative_submenu_link_typogarphy = 'custom';
				}
			}
			if ( isset( $settings->creative_submenu_link_font_family ) ) {

				if ( isset( $settings->creative_submenu_link_font_family['family'] ) ) {

					$settings->creative_submenu_link_font_typo['font_family'] = $settings->creative_submenu_link_font_family['family'];
					unset( $settings->creative_submenu_link_font_family['family'] );
				}
				if ( isset( $settings->creative_submenu_link_font_family['weight'] ) ) {

					if ( 'regular' == $settings->creative_submenu_link_font_family['weight'] ) {
						$settings->creative_submenu_link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->creative_submenu_link_font_typo['font_weight'] = $settings->creative_submenu_link_font_family['weight'];
					}
					unset( $settings->creative_submenu_link_font_family['weight'] );
				}
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom ) ) {

				$settings->creative_submenu_link_font_typo['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_medium ) ) {
				$settings->creative_submenu_link_font_typo_medium['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_responsive ) ) {
				$settings->creative_submenu_link_font_typo_responsive['font_size'] = array(
					'length' => $settings->creative_submenu_link_font_size_custom_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom ) ) {

				$settings->creative_submenu_link_font_typo['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_medium ) ) {
				$settings->creative_submenu_link_font_typo_medium['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_responsive ) ) {
				$settings->creative_submenu_link_font_typo_responsive['line_height'] = array(
					'length' => $settings->creative_submenu_link_line_height_custom_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->creative_submenu_link_text_transform ) ) {

				$settings->creative_submenu_link_font_typo['text_transform'] = $settings->creative_submenu_link_text_transform;

			}
			if ( isset( $settings->creative_submenu_link_letter_spacing ) ) {

				$settings->creative_submenu_link_font_typo['letter_spacing'] = array(
					'length' => $settings->creative_submenu_link_letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->creative_submenu_link_padding ) && ! isset( $settings->creative_submenu_link_padding_dimension_top ) && ! isset( $settings->creative_submenu_link_padding_dimension_bottom ) && ! isset( $settings->creative_submenu_link_padding_dimension_right ) && ! isset( $settings->creative_submenu_link_padding_dimension_left ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_submenu_link_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_submenu_link_padding_dimension_top    = '';
				$settings->creative_submenu_link_padding_dimension_bottom = '';
				$settings->creative_submenu_link_padding_dimension_right  = '';
				$settings->creative_submenu_link_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_submenu_link_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_submenu_link_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_submenu_link_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_submenu_link_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_submenu_link_padding );
			}
			if ( isset( $settings->creative_submenu_border_width ) && ! isset( $settings->creative_submenu_border_width_dimension_top ) && ! isset( $settings->creative_submenu_border_width_dimension_bottom ) && ! isset( $settings->creative_submenu_border_width_dimension_right ) && ! isset( $settings->creative_submenu_border_width_dimension_left ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_submenu_border_width );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_submenu_border_width_dimension_top    = '';
				$settings->creative_submenu_border_width_dimension_bottom = '';
				$settings->creative_submenu_border_width_dimension_right  = '';
				$settings->creative_submenu_border_width_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_submenu_border_width_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_submenu_border_width_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_submenu_border_width_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_submenu_border_width_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_submenu_border_width_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_submenu_border_width );
			}
			if ( isset( $settings->creative_menu_responsive_overlay_padding ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_top ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_right ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_left ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_responsive_overlay_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_responsive_overlay_padding_dimension_top    = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_bottom = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_right  = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_responsive_overlay_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_responsive_overlay_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_responsive_overlay_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_responsive_overlay_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->creative_menu_responsive_overlay_padding );
			}
			// Unset the old values.
			if ( isset( $settings->creative_menu_link_font_size_custom ) ) {
				unset( $settings->creative_menu_link_font_size_custom );
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_medium ) ) {
				unset( $settings->creative_menu_link_font_size_custom_medium );
			}
			if ( isset( $settings->creative_menu_link_font_size_custom_responsive ) ) {
				unset( $settings->creative_menu_link_font_size_custom_responsive );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom ) ) {
				unset( $settings->creative_menu_link_line_height_custom );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_medium ) ) {
				unset( $settings->creative_menu_link_line_height_custom_medium );
			}
			if ( isset( $settings->creative_menu_link_line_height_custom_responsive ) ) {
				unset( $settings->creative_menu_link_line_height_custom_responsive );
			}
			if ( isset( $settings->creative_menu_link_text_transform ) ) {
				unset( $settings->creative_menu_link_text_transform );
			}
			if ( isset( $settings->creative_menu_link_letter_spacing ) ) {
				unset( $settings->creative_menu_link_letter_spacing );
			}
			// Unset the old values.
			if ( isset( $settings->creative_submenu_link_font_size_custom ) ) {
				unset( $settings->creative_submenu_link_font_size_custom );
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_medium ) ) {
				unset( $settings->creative_submenu_link_font_size_custom_medium );
			}
			if ( isset( $settings->creative_submenu_link_font_size_custom_responsive ) ) {
				unset( $settings->creative_submenu_link_font_size_custom_responsive );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom ) ) {
				unset( $settings->creative_submenu_link_line_height_custom );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_medium ) ) {
				unset( $settings->creative_submenu_link_line_height_custom_medium );
			}
			if ( isset( $settings->creative_submenu_link_line_height_custom_responsive ) ) {
				unset( $settings->creative_submenu_link_line_height_custom_responsive );
			}
			if ( isset( $settings->creative_submenu_link_text_transform ) ) {
				unset( $settings->creative_submenu_link_text_transform );
			}
			if ( isset( $settings->creative_submenu_link_letter_spacing ) ) {
				unset( $settings->creative_submenu_link_letter_spacing );
			}
		}
		return $settings;
	}
	/**
	 * Function that renders the menus
	 *
	 * @method render_menus
	 */
	public static function render_menus() {
		$nav_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$fields    = array(
			'type'   => 'select',
			'label'  => __( 'Menu', 'uabb' ),
			'helper' => __( 'Select a WordPress menu that you created in the admin under Appearance > Menus.', 'uabb' ),
		);

		if ( $nav_menus ) {

			foreach ( $nav_menus as $key => $menu ) {

				if ( 0 == $key ) {
					$fields['default'] = $menu->name;
				}

				$menus[ $menu->slug ] = $menu->name;
			}

			$fields['options'] = $menus;

		} else {
			$fields['options'] = array( '' => __( 'No Menus Found', 'uabb' ) );
		}

		return $fields;

	}

	/**
	 * Function that gets toggle button
	 *
	 * @method get_toggle_button
	 */
	public function get_toggle_button() {

		$toggle = $this->settings->creative_menu_mobile_toggle;
		if ( isset( $toggle ) && 'expanded' != $toggle ) {

			if ( in_array( $toggle, array( 'hamburger', 'hamburger-label' ) ) ) {
				echo '<div class="uabb-creative-menu-mobile-toggle-container">';
				echo '<div class="uabb-creative-menu-mobile-toggle ' . $toggle . '"><div class="uabb-svg-container">';
				include 'img/hamburger-menu.svg';
				echo '</div>';

				if ( 'hamburger-label' == $toggle ) {
					echo '<span class="uabb-creative-menu-mobile-toggle-label">';
					echo ( isset( $this->settings->creative_menu_mobile_toggle_text ) && ! empty( $this->settings->creative_menu_mobile_toggle_text ) ) ? $this->settings->creative_menu_mobile_toggle_text : __( 'Menu', 'uabb' );
					echo '</span>';
				}

				echo '</div></div>';

			} elseif ( 'text' == $toggle ) {
				echo '<div class="uabb-creative-menu-mobile-toggle-container">';
				echo '<div class="uabb-creative-menu-mobile-toggle text"><span class="uabb-creative-menu-mobile-toggle-label">';
				echo ( isset( $this->settings->creative_menu_mobile_toggle_text ) && ! empty( $this->settings->creative_menu_mobile_toggle_text ) ) ? $this->settings->creative_menu_mobile_toggle_text : __( 'Menu', 'uabb' );
				echo '</span></div></div>';

			}
		}
	}

	/**
	 * Render menu class
	 *
	 * @method render_menu_class
	 * @param object $settings gets the settings for menu.
	 */
	public static function render_menu_class( $settings ) {

		if ( isset( $settings->creative_menu_layout ) ) {

			if ( in_array( $settings->creative_menu_layout, array( 'vertical', 'horizontal' ) ) && isset( $settings->creative_submenu_hover_toggle ) ) {
				$toggle = ' uabb-toggle-' . $settings->creative_submenu_hover_toggle;
			} elseif ( 'accordion' == $settings->creative_menu_layout && isset( $settings->creative_submenu_click_toggle ) ) {
				$toggle = ' uabb-toggle-' . $settings->creative_submenu_click_toggle;
			} else {
				$toggle = ' uabb-toggle-arrows';
			}
		} else {
				$toggle = ' uabb-toggle-arrows';
		}

		$layout = isset( $settings->creative_menu_layout ) ? 'uabb-creative-menu-' . $settings->creative_menu_layout : 'uabb-creative-menu-horizontal';

		$menu_class = 'menu ' . $layout . $toggle;

		return $menu_class;
	}

	/**
	 * Render menu breakpoint
	 *
	 * @method media_breakpoint
	 */
	public function media_breakpoint() {
		$global_settings   = FLBuilderModel::get_global_settings();
		$media_width       = $global_settings->responsive_breakpoint;
		$mobile_breakpoint = $this->settings->creative_menu_mobile_breakpoint;

		if ( isset( $mobile_breakpoint ) && 'expanded' != $this->settings->creative_menu_mobile_toggle ) {
			if ( 'medium-mobile' == $mobile_breakpoint ) {
				$media_width = $global_settings->medium_breakpoint;
			} elseif ( 'mobile' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = $global_settings->responsive_breakpoint;
			} elseif ( 'always' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = 'always';
			} elseif ( 'custom' == $this->settings->creative_menu_mobile_breakpoint ) {
				$media_width = $this->settings->custom_breakpoint;
			}
		}

		return $media_width;
	}

	/**
	 * Render responsive media
	 *
	 * @method get_responsive_media
	 * @param object $settings gets the settings for menu.
	 * @param object $module gets the modules settings.
	 */
	public function get_responsive_media( $settings, $module ) {

		if ( 'default' != $settings->creative_mobile_menu_type && 'below-row' != $settings->creative_mobile_menu_type ) {

			if ( 'full-screen' == $settings->creative_mobile_menu_type ) {
				$classes = '<div class="uabb-menu-overlay uabb-overlay-' . $settings->creative_menu_full_screen_effects . '"> <div class="uabb-menu-close-btn"></div>';
			} elseif ( 'off-canvas' == $settings->creative_mobile_menu_type ) {
				$classes = '<div class="uabb-off-canvas-menu uabb-menu-' . $settings->creative_menu_offcanvas_direction . '"> <div class="uabb-menu-close-btn">×</div>';
			}

			$module->get_toggle_button(); ?>
			<div class="uabb-creative-menu
			<?php
			if ( $settings->creative_menu_collapse ) {
				echo ' uabb-creative-menu-accordion-collapse';}
			?>
			<?php echo $settings->creative_mobile_menu_type; ?>">
				<div class="uabb-clear"></div>
				<?php echo $classes; ?>
				<?php echo $module->get_menu( $settings, $module ); ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Renders menu
	 *
	 * @method get_menu
	 * @param object $settings gets the settings for menu.
	 * @param object $module gets the modules settings.
	 */
	public function get_menu( $settings, $module ) {
		do_action( 'uabb_advanced_menu_before', $settings );
		?>
		<?php
		if ( ! empty( $settings->wp_menu ) ) {

			$defaults = array(
				'menu'       => $settings->wp_menu,
				'container'  => false,
				'menu_class' => $module->render_menu_class( $settings ),
				'walker'     => new Creative_Menu_Walker( $settings ),
			);

			wp_nav_menu( $defaults );
		}
		do_action( 'uabb_advanced_menu_after', $settings );
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-advanced-menu/uabb-advanced-menu-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-advanced-menu/uabb-advanced-menu-bb-less-than-2-2-compatibility.php';
}
