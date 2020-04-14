<?php
/**
 *  UABB Advanced Accordion module file
 *
 *  @package UABB Advanced Accordion
 */

/**
 * Function that initializes UABB Advanced Accordion Module
 *
 * @class UABBAdvancedAccordionModule
 */
class UABBAdvancedAccordionModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Accordion module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Accordion', 'uabb' ),
				'description'     => __( 'Display a collapsible accordion of items.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-accordion/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-accordion/',
				'partial_refresh' => true,
				'icon'            => 'layout.svg',
			)
		);

		add_filter( 'fl_builder_render_settings_field', array( $this, 'uabb_accordion_render_settings_field' ), 10, 3 );

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
		$version_bb_check        = UABB_Compatibility::$version_bb_check;
		$page_migrated           = UABB_Compatibility::$uabb_migration;
		$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;
		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {
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
			if ( isset( $settings->title_align ) ) {
				$settings->title_font_typo['text_align'] = $settings->title_align;
				unset( $settings->title_align );
			}
			if ( ! isset( $settings->content_font_typo ) || ! is_array( $settings->content_font_typo ) ) {

				$settings->content_font_typo            = array();
				$settings->content_font_typo_medium     = array();
				$settings->content_font_typo_responsive = array();
			}
			if ( isset( $settings->content_align ) ) {
				$settings->content_font_typo['text_align'] = $settings->content_align;
				unset( $settings->content_align );
			}
			if ( isset( $settings->content_font_family ) ) {
				if ( isset( $settings->content_font_family['weight'] ) ) {
					if ( 'regular' === $settings->content_font_family['weight'] ) {
						$settings->content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->content_font_typo['font_weight'] = $settings->content_font_family['weight'];
					}
					unset( $settings->content_font_family['weight'] );
				}
				if ( isset( $settings->content_font_family['family'] ) ) {

					$settings->content_font_typo['font_family'] = $settings->content_font_family['family'];
					unset( $settings->content_font_family['family'] );
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
			if ( isset( $settings->title_border_color ) ) {
				$settings->title_border_param          = array();
				$settings->title_border_param['color'] = $settings->title_border_color;
				if ( isset( $settings->title_border_type ) ) {
					$settings->title_border_param['style'] = $settings->title_border_type;
					unset( $settings->title_border_type );
				}
				if ( isset( $settings->title_border_top ) || isset( $settings->title_border_bottom ) || isset( $settings->title_border_left ) || isset( $settings->title_border_right ) ) {
					$settings->title_border_param['width'] = array(
						'top'    => $settings->title_border_top,
						'right'  => $settings->title_border_right,
						'bottom' => $settings->title_border_bottom,
						'left'   => $settings->title_border_left,
					);
				}
				if ( isset( $settings->title_border_radius ) ) {
					$settings->title_border_param['radius'] = array(
						'top_left'     => $settings->title_border_radius,
						'top_right'    => $settings->title_border_radius,
						'bottom_left'  => $settings->title_border_radius,
						'bottom_right' => $settings->title_border_radius,
					);
					unset( $settings->title_border_radius );
				}
			}
			if ( isset( $settings->content_border_color ) ) {

				$settings->content_border_param = array();

				$settings->content_border_param['color'] = $settings->content_border_color;
				if ( isset( $settings->title_border_type ) ) {
					$settings->content_border_param['style'] = $settings->content_border_type;
					unset( $settings->title_border_type );
				}
				if ( isset( $settings->content_border_top ) || isset( $settings->content_border_bottom ) || isset( $settings->content_border_left ) || isset( $settings->content_border_right ) ) {
					$settings->content_border_param['width'] = array(
						'top'    => $settings->content_border_top,
						'right'  => $settings->content_border_right,
						'bottom' => $settings->content_border_bottom,
						'left'   => $settings->content_border_left,
					);
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
			}
			if ( isset( $settings->title_border_color ) ) {
				unset( $settings->title_border_color );
			}
			if ( isset( $settings->title_border_top ) ) {
				unset( $settings->title_border_top );
			}
			if ( isset( $settings->title_border_bottom ) ) {
				unset( $settings->title_border_bottom );
			}
			if ( isset( $settings->title_border_left ) ) {
				unset( $settings->title_border_left );
			}
			if ( isset( $settings->title_border_right ) ) {
				unset( $settings->title_border_right );
			}
			if ( isset( $settings->content_border_color ) ) {
				unset( $settings->content_border_color );
			}
			if ( isset( $settings->content_border_top ) ) {
				unset( $settings->content_border_top );
			}
			if ( isset( $settings->content_border_bottom ) ) {
				unset( $settings->content_border_bottom );
			}
			if ( isset( $settings->content_border_left ) ) {
				unset( $settings->content_border_left );
			}
			if ( isset( $settings->content_border_right ) ) {
				unset( $settings->content_border_right );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {
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
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 !== $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_align ) ) {
				$settings->title_font_typo['text_align'] = $settings->title_align;
				unset( $settings->title_align );
			}
			if ( ! isset( $settings->content_font_typo ) || ! is_array( $settings->content_font_typo ) ) {

				$settings->content_font_typo            = array();
				$settings->content_font_typo_medium     = array();
				$settings->content_font_typo_responsive = array();
			}
			if ( isset( $settings->content_font_family ) ) {
				if ( isset( $settings->content_font_family['weight'] ) ) {
					if ( 'regular' === $settings->content_font_family['weight'] ) {
						$settings->content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->content_font_typo['font_weight'] = $settings->content_font_family['weight'];
					}
					unset( $settings->content_font_family['weight'] );
				}
				if ( isset( $settings->content_font_family['family'] ) ) {
					$settings->content_font_typo['font_family'] = $settings->content_font_family['family'];
					unset( $settings->content_font_family['family'] );
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
			if ( isset( $settings->content_line_height['small'] ) && isset( $settings->content_font_size['small'] ) && 0 !== $settings->content_font_size['small'] && ! isset( $settings->content_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->content_line_height['small'] ) && is_numeric( $settings->content_font_size['small'] ) ) {
					$settings->content_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->content_line_height['small'] / $settings->content_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->content_align ) ) {
				$settings->content_font_typo['text_align'] = $settings->content_align;
				unset( $settings->content_align );
			}
			if ( isset( $settings->title_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->title_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->title_spacing_dimension_top    = '';
				$settings->title_spacing_dimension_bottom = '';
				$settings->title_spacing_dimension_left   = '';
				$settings->title_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				$output = count( $output );
				for ( $i = 0; $i < $count; $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->title_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->title_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->title_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->title_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->title_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->title_spacing );
			}
			if ( isset( $settings->content_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_spacing_dimension_top    = '';
				$settings->content_spacing_dimension_bottom = '';
				$settings->content_spacing_dimension_left   = '';
				$settings->content_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				$count = count( $output );
				for ( $i = 0; $i < $count; $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->content_spacing );
			}
			if ( isset( $settings->title_border_color ) ) {
				$settings->title_border_param          = array();
				$settings->title_border_param['color'] = $settings->title_border_color;
				if ( $settings->title_border_type ) {
					$settings->title_border_param['style'] = $settings->title_border_type;
					unset( $settings->title_border_type );
				}

				if ( isset( $settings->title_border_top ) || isset( $settings->title_border_bottom ) || isset( $settings->title_border_left ) || isset( $settings->title_border_right ) ) {
					$settings->title_border_param['width'] = array(
						'top'    => $settings->title_border_top,
						'right'  => $settings->title_border_right,
						'bottom' => $settings->title_border_bottom,
						'left'   => $settings->title_border_left,
					);
				}
				if ( isset( $settings->title_border_radius ) ) {
					$settings->title_border_param['radius'] = array(
						'top_left'     => $settings->title_border_radius,
						'top_right'    => $settings->title_border_radius,
						'bottom_left'  => $settings->title_border_radius,
						'bottom_right' => $settings->title_border_radius,
					);
					unset( $settings->title_border_radius );
				}
			}
			if ( isset( $settings->content_border_color ) ) {

				$settings->content_border_param = array();

				$settings->content_border_param['color'] = $settings->content_border_color;
				if ( isset( $settings->title_border_type ) ) {
					$settings->content_border_param['style'] = $settings->content_border_type;
					unset( $settings->title_border_type );
				}
				if ( isset( $settings->content_border_top ) || isset( $settings->content_border_bottom ) || isset( $settings->content_border_left ) || isset( $settings->content_border_right ) ) {
					$settings->content_border_param['width'] = array(
						'top'    => $settings->content_border_top,
						'right'  => $settings->content_border_right,
						'bottom' => $settings->content_border_bottom,
						'left'   => $settings->content_border_left,
					);
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
			}
			if ( isset( $settings->content_border_color ) ) {
				unset( $settings->content_border_color );
			}
			if ( isset( $settings->content_border_top ) ) {
				unset( $settings->content_border_top );
			}
			if ( isset( $settings->content_border_bottom ) ) {
				unset( $settings->content_border_bottom );
			}
			if ( isset( $settings->content_border_left ) ) {
				unset( $settings->content_border_left );
			}
			if ( isset( $settings->content_border_right ) ) {
				unset( $settings->content_border_right );
			}
			if ( isset( $settings->title_border_color ) ) {
				unset( $settings->title_border_color );
			}
			if ( isset( $settings->title_border_top ) ) {
				unset( $settings->title_border_top );
			}
			if ( isset( $settings->title_border_bottom ) ) {
				unset( $settings->title_border_bottom );
			}
			if ( isset( $settings->title_border_left ) ) {
				unset( $settings->title_border_left );
			}
			if ( isset( $settings->title_border_right ) ) {
				unset( $settings->title_border_right );
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
	 * Function that renders Accordion's settings field
	 *
	 * @since x.x.x
	 * @param array  $field gets the field value for the accordion settings.
	 * @param string $name gets an string for the module.
	 * @param object $settings gets an object for the settings.
	 */
	public function uabb_accordion_render_settings_field( $field, $name, $settings ) {

		if ( isset( $field['form'] ) && 'uabb_advAccordion_items_form' === $field['form'] ) {

			foreach ( $settings->acc_items as $acc_item ) {

				if ( is_object( $acc_item ) && isset( $acc_item->acc_content ) && '' === $acc_item->ct_content ) {
					$acc_item->ct_content = $acc_item->acc_content;
				}
			}
		}

		return $field;
	}

	/**
	 * Function that renders Accordion's Content
	 *
	 * @since x.x.x
	 * @param object $settings gets an object for the settings.
	 */
	public function get_accordion_content( $settings ) {
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

	/**
	 * Function that renders Accordion's Icon
	 *
	 * @since x.x.x
	 * @param object $pos gets an object for the icon's settings.
	 */
	public function render_icon( $pos ) {
		if ( $pos === $this->settings->icon_position && ( '' !== $this->settings->open_icon || '' !== $this->settings->close_icon ) ) {

			if ( 'none' === $this->settings->icon_animation ) {
				$output  = '<div class="uabb-adv-accordion-icon-wrap" tabindex="0" >';
				$output .= '<i class="uabb-adv-accordion-button-icon ' . $this->settings->close_icon . '"></i>';
				$output .= '</div>';
			} else {
				$output  = '<div class="uabb-adv-accordion-icon-wrap uabb-adv-' . $this->settings->icon_animation . '" tabindex="0" >';
				$output .= '<div class="uabb-adv-accordion-icon-animation">';

				if ( 'push-out-top' === $this->settings->icon_animation || 'push-out-left' === $this->settings->icon_animation ) {
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-open-icon ' . $this->settings->open_icon . '"></i>';
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-close-icon ' . $this->settings->close_icon . '"></i>';
				} elseif ( 'push-out-bottom' === $this->settings->icon_animation || 'push-out-right' === $this->settings->icon_animation ) {
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-close-icon ' . $this->settings->close_icon . '"></i>';
					$output .= '<i class="uabb-adv-accordion-button-icon uabb-adv-accordion-open-icon ' . $this->settings->open_icon . '"></i>';
				}

				$output .= '</div>';
				$output .= '</div>';
			}
			return $output;
		}
		return '';
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::$version_bb_check ) {

	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-accordion/advanced-accordion-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-accordion/advanced-accordion-bb-less-than-2-2-compatibility.php';
}
