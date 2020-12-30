<?php
/**
 *  UABB Advanced Tabs Module file
 *
 *  @package UABB Advanced Tabs Module
 */

/**
 * Function that initializes UABB Advanced Tabs Module
 *
 * @class AdvancedTabsModule
 */
class AdvancedTabsModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Tabs module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Tabs', 'uabb' ),
				'description'     => __( 'Advanced Tabs', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-tabs/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-tabs/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'layout.svg',
			)
		);

		add_filter( 'fl_builder_render_settings_field', array( $this, 'uabb_tab_render_settings_field' ), 10, 3 );
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

					if ( 'regular' === $settings->title_font_family['weight'] ) {
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
			if ( ! isset( $settings->content_font_typo ) || ! is_array( $settings->content_font_typo ) ) {

				$settings->content_font_typo            = array();
				$settings->content_font_typo_medium     = array();
				$settings->content_font_typo_responsive = array();
			}
			if ( isset( $settings->content_font_family ) ) {

				if ( isset( $settings->content_font_family['family'] ) ) {

					$settings->content_font_typo['font_family'] = $settings->content_font_family['family'];
					unset( $settings->content_font_family['family'] );
				}
				if ( isset( $settings->content_font_family['weight'] ) ) {

					if ( 'regular' === $settings->content_font_family['weight'] ) {
						$settings->content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->content_font_typo['font_weight'] = $settings->content_font_family['weight'];
					}
					unset( $settings->content_font_family['weight'] );
				}
			}
			if ( isset( $settings->content_font_size_unit ) ) {

				$settings->content_font_typo['font_size'] = array(
					'length' => $settings->content_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size_unit );
			}
			if ( isset( $settings->content_font_size_unit_medium ) ) {
				$settings->content_font_typo_medium['font_size'] = array(
					'length' => $settings->content_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size_unit_medium );
			}
			if ( isset( $settings->content_font_size_unit_responsive ) ) {

				$settings->content_font_typo_responsive['font_size'] = array(
					'length' => $settings->content_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size_unit_responsive );
			}
			if ( isset( $settings->content_line_height_unit ) ) {

				$settings->content_font_typo['line_height'] = array(
					'length' => $settings->content_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height_unit );
			}
			if ( isset( $settings->content_line_height_unit_medium ) ) {
				$settings->content_font_typo_medium['line_height'] = array(
					'length' => $settings->content_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height_unit_medium );
			}
			if ( isset( $settings->content_line_height_unit_responsive ) ) {
				$settings->content_font_typo_responsive['line_height'] = array(
					'length' => $settings->content_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height_unit_responsive );
			}
			if ( isset( $settings->content_transform ) ) {

				$settings->content_font_typo['text_transform'] = $settings->content_transform;
				unset( $settings->content_transform );

			}
			if ( isset( $settings->content_letter_spacing ) ) {

				$settings->content_font_typo['letter_spacing'] = array(
					'length' => $settings->content_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->content_letter_spacing );
			}
			if ( isset( $settings->content_border_color ) ) {
				$settings->content_border_param = array();
				if ( isset( $settings->content_border_style ) ) {
					$settings->content_border_param['style'] = $settings->content_border_style;
					unset( $settings->content_border_style );
				}
				$settings->content_border_param['color'] = $settings->content_border_color;
				if ( isset( $settings->content_border_size ) ) {
					$settings->content_border_param['width'] = array(
						'top'    => $settings->content_border_size,
						'right'  => $settings->content_border_size,
						'bottom' => $settings->content_border_size,
						'left'   => $settings->content_border_size,
					);
					unset( $settings->content_border_size );
				}
				if ( isset( $settings->content_border_radius ) ) {
					$settings->content_border_param['radius'] = array(
						'top_left'     => $settings->content_border_radius,
						'top_right'    => $settings->content_border_radius,
						'bottom_left'  => $settings->content_border_radius,
						'bottom_right' => $settings->content_border_radius,
					);
					unset( $settings->content_border_radius );
				}
				unset( $settings->content_border_color );
			}
			if ( isset( $settings->tab_style_alignment ) ) {
				$settings->tab_style_align = $settings->tab_style_alignment;
				unset( $settings->tab_style_alignment );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {
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

					if ( 'regular' === $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 !== $settings->title_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 !== $settings->title_font_size['medium'] ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 !== $settings->title_font_size['small'] ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->content_font_typo ) || ! is_array( $settings->content_font_typo ) ) {

				$settings->content_font_typo            = array();
				$settings->content_font_typo_medium     = array();
				$settings->content_font_typo_responsive = array();
			}
			if ( isset( $settings->content_font_family ) ) {

				if ( isset( $settings->content_font_family['family'] ) ) {

					$settings->content_font_typo['font_family'] = $settings->content_font_family['family'];
					unset( $settings->content_font_family['family'] );
				}
				if ( isset( $settings->content_font_family['weight'] ) ) {

					if ( 'regular' === $settings->content_font_family['weight'] ) {
						$settings->content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->content_font_typo['font_weight'] = $settings->content_font_family['weight'];
					}
					unset( $settings->content_font_family['weight'] );
				}
			}
			if ( isset( $settings->content_font_size['desktop'] ) ) {

				$settings->content_font_typo['font_size'] = array(
					'length' => $settings->content_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->content_font_size['medium'] ) ) {
				$settings->content_font_typo_medium['font_size'] = array(
					'length' => $settings->content_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->content_font_size['small'] ) ) {
				$settings->content_font_typo_responsive['font_size'] = array(
					'length' => $settings->content_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->content_line_height['desktop'] ) && isset( $settings->content_font_size['desktop'] ) && 0 !== $settings->content_font_size['desktop'] ) {
				if ( is_numeric( $settings->content_line_height['desktop'] ) && is_numeric( $settings->content_font_size['desktop'] ) ) {
					$settings->content_font_typo['line_height'] = array(
						'length' => round( $settings->content_line_height['desktop'] / $settings->content_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->content_line_height['medium'] ) && isset( $settings->content_font_size['medium'] ) && 0 !== $settings->content_font_size['medium'] ) {
				if ( is_numeric( $settings->content_line_height['medium'] ) && is_numeric( $settings->content_font_size['medium'] ) ) {
					$settings->content_font_typo_medium['line_height'] = array(
						'length' => round( $settings->content_line_height['medium'] / $settings->content_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->content_line_height['small'] ) && isset( $settings->content_font_size['small'] ) && 0 !== $settings->content_font_size['small'] ) {
				if ( is_numeric( $settings->content_line_height['small'] ) && is_numeric( $settings->content_font_size['small'] ) ) {
					$settings->content_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->content_line_height['small'] / $settings->content_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->content_border_color ) ) {
				$settings->content_border_param = array();
				if ( isset( $settings->content_border_style ) ) {
					$settings->content_border_param['style'] = $settings->content_border_style;
					unset( $settings->content_border_style );
				}
				$settings->content_border_param['color'] = $settings->content_border_color;
				if ( isset( $settings->content_border_size ) ) {
					$settings->content_border_param['width'] = array(
						'top'    => $settings->content_border_size,
						'right'  => $settings->content_border_size,
						'bottom' => $settings->content_border_size,
						'left'   => $settings->content_border_size,
					);
					unset( $settings->content_border_size );
				}
				if ( isset( $settings->content_border_radius ) ) {
					$settings->content_border_param['radius'] = array(
						'top_left'     => $settings->content_border_radius,
						'top_right'    => $settings->content_border_radius,
						'bottom_left'  => $settings->content_border_radius,
						'bottom_right' => $settings->content_border_radius,
					);
					unset( $settings->content_border_radius );
				}
				unset( $settings->content_border_color );
			}
			if ( isset( $settings->tab_style_alignment ) ) {
				$settings->tab_style_align = $settings->tab_style_alignment;
				unset( $settings->tab_style_alignment );
			}
			if ( isset( $settings->tab_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->tab_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->tab_padding_dimension_top    = '';
				$settings->tab_padding_dimension_bottom = '';
				$settings->tab_padding_dimension_left   = '';
				$settings->tab_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				$count = count( $output );
				for ( $i = 0; $i < $count; $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->tab_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->tab_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->tab_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->tab_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->tab_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->tab_padding );
			}
			if ( isset( $settings->content_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				$count = count( $output );
				for ( $i = 0; $i < $count; $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->content_padding );
			}
			if ( isset( $settings->title_font_family['desktop'] ) ) {
				unset( $settings->title_font_family['desktop'] );
			}
			if ( isset( $settings->title_font_family['medium'] ) ) {
				unset( $settings->title_font_family['medium'] );
			}
			if ( isset( $settings->title_font_family['small'] ) ) {
				unset( $settings->title_font_family['small'] );
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
			if ( isset( $settings->content_font_size['desktop'] ) ) {
				unset( $settings->content_font_size['desktop'] );
			}
			if ( isset( $settings->content_font_size['medium'] ) ) {
				unset( $settings->content_font_size['medium'] );
			}
			if ( isset( $settings->content_font_size['small'] ) ) {
				unset( $settings->content_font_size['small'] );
			}
			if ( isset( $settings->content_line_height['desktop'] ) ) {
				unset( $settings->content_line_height['desktop'] );
			}
			if ( isset( $settings->content_line_height['medium'] ) ) {
				unset( $settings->content_line_height['medium'] );
			}
			if ( isset( $settings->content_line_height['small'] ) ) {
				unset( $settings->content_line_height['small'] );
			}
		}
		return $settings;
	}
	/**
	 * Function that renders Settings for the Advanced Tabs Module
	 *
	 * @method uabb_tab_render_settings_field
	 * @param array  $field gets the field value for the Tabs settings.
	 * @param string $name gets an string for the module.
	 * @param object $settings gets an object for the settings.
	 */
	public function uabb_tab_render_settings_field( $field, $name, $settings ) {

		if ( isset( $field['form'] ) && 'uabb_tab_items_form' === $field['form'] ) {

			foreach ( $settings->items as $item ) {

				if ( is_object( $item ) && isset( $item->content ) && '' === $item->ct_content ) {
					$item->ct_content = $item->content;
				}
			}
		}

		if ( isset( $settings->style ) && 'underline' === $settings->style ) {
			$settings->style         = 'topline';
			$settings->line_position = 'bottom';
		}

		return $field;
	}


	/**
	 * Function that renders Settings for the Advanced Tabs Module
	 *
	 * @method get_tab_content
	 * @param object $settings gets an object for the settings.
	 */
	public function get_tab_content( $settings ) {
		$content_type = $settings->content_type;
		switch ( $content_type ) {
			case 'content':
				global $wp_embed;
				return wpautop( $wp_embed->autoembed( $settings->ct_content ) );
			case 'photo':
				if ( isset( $settings->ct_photo_src ) ) {
					return '<img src="' . $settings->ct_photo_src . '" />';
				}
				return '<img src="" />';
			case 'video':
				global $wp_embed;
				return $wp_embed->autoembed( $settings->ct_video );
			case 'saved_rows':
				ob_start();
				echo '[fl_builder_insert_layout id="' . esc_attr( $settings->ct_saved_rows ) . '" type="fl-builder-template"]';
				return ob_get_clean();
			case 'saved_modules':
				ob_start();
				echo '[fl_builder_insert_layout id="' . esc_attr( $settings->ct_saved_modules ) . '" type="fl-builder-template"]';
				return ob_get_clean();
			case 'saved_page_templates':
				ob_start();
				echo '[fl_builder_insert_layout id="' . esc_attr( $settings->ct_page_templates ) . '" type="fl-builder-template"]';
				return ob_get_clean();
			default:
				return;
		}
	}
}

$default_breakpoint = ( trim( UABB_Model_Helper::$bb_global_settings->responsive_breakpoint ) !== '' ) ? UABB_Model_Helper::$bb_global_settings->responsive_breakpoint : '';

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-tabs/advanced-tabs-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-tabs/advanced-tabs-bb-less-than-2-2-compatibility.php';
}
