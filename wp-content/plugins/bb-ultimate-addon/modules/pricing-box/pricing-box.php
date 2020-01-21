<?php
/**
 *  UABB Pricing Table Module file
 *
 *  @package UABB Pricing Table Module
 */

/**
 * Function that initializes UABB Pricing Table Module
 *
 * @class UABBPricingTableModule
 */
class UABBPricingTableModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Pricing Table Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Price Box', 'uabb' ),
				'description'     => __( 'A simple price box generator.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/pricing-box/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/pricing-box/',
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);
		$this->add_css( 'font-awesome-5' );
		add_filter( 'fl_builder_render_settings_field', array( $this, 'uabb_price_box_settings_field' ), 10, 3 );
	}

	/**
	 * Function that renders Price Box settings field
	 *
	 * @method  uabb_price_box_settings_field
	 * @param array  $field gets an array of settings field.
	 * @param array  $name an array to get the names.
	 * @param object $settings an object to get various settings.
	 */
	function uabb_price_box_settings_field( $field, $name, $settings ) {
		if ( isset( $settings->legend_column->legend_feature_color ) ) {
			if ( '' != $settings->legend_column->legend_feature_color && '' == $settings->legend_column->legend_color ) {
				$settings->legend_column->legend_color = $settings->legend_column->legend_feature_color;
			}
		}
		return $field;
	}

	/**
	 * Function that renders the button
	 *
	 * @method render_button
	 * @param var $column gets the value for the fields.
	 */
	public function render_button( $column ) {
		if ( ! UABB_Compatibility::check_bb_version() ) {
			$btn_settings = array(

				'text'                        => $this->settings->pricing_columns[ $column ]->btn_text,
				'link'                        => $this->settings->pricing_columns[ $column ]->btn_link,
				'link_target'                 => $this->settings->pricing_columns[ $column ]->btn_link_target,
				'link_nofollow'               => $this->settings->pricing_columns[ $column ]->btn_link_nofollow,
				'icon'                        => $this->settings->pricing_columns[ $column ]->btn_icon,
				'icon_position'               => $this->settings->pricing_columns[ $column ]->btn_icon_position,
				'style'                       => $this->settings->pricing_columns[ $column ]->btn_style,
				'border_size'                 => $this->settings->pricing_columns[ $column ]->btn_border_size,
				'transparent_button_options'  => $this->settings->pricing_columns[ $column ]->btn_transparent_button_options,
				'threed_button_options'       => $this->settings->pricing_columns[ $column ]->btn_threed_button_options,
				'flat_button_options'         => $this->settings->pricing_columns[ $column ]->btn_flat_button_options,
				'bg_color'                    => $this->settings->pricing_columns[ $column ]->btn_bg_color,
				'bg_hover_color'              => $this->settings->pricing_columns[ $column ]->btn_bg_hover_color,
				'text_color'                  => $this->settings->pricing_columns[ $column ]->btn_text_color,
				'text_hover_color'            => $this->settings->pricing_columns[ $column ]->btn_text_hover_color,
				'width'                       => $this->settings->pricing_columns[ $column ]->btn_width,
				'custom_width'                => $this->settings->pricing_columns[ $column ]->btn_custom_width,
				'custom_height'               => $this->settings->pricing_columns[ $column ]->btn_custom_height,
				'padding_top_bottom'          => $this->settings->pricing_columns[ $column ]->btn_padding_top_bottom,
				'padding_left_right'          => $this->settings->pricing_columns[ $column ]->btn_padding_left_right,
				'border_radius'               => $this->settings->pricing_columns[ $column ]->btn_border_radius,
				'custom_class'                => $this->settings->pricing_columns[ $column ]->btn_custom_class,
				'align'                       => '',
				'mob_align'                   => '',
				'font_family'                 => $this->settings->pricing_columns[ $column ]->button_typography_font_family,

				'font_size'                   => ( isset( $this->settings->pricing_columns[ $column ]->button_typography_font_size ) ) ? $this->settings->pricing_columns[ $column ]->button_typography_font_size : '',

				'line_height'                 => ( isset( $this->settings->pricing_columns[ $column ]->button_typography_line_height ) ) ? $this->settings->pricing_columns[ $column ]->button_typography_line_height : '',

				'font_size_unit'              => $this->settings->pricing_columns[ $column ]->button_typography_font_size_unit,
				'line_height_unit'            => $this->settings->pricing_columns[ $column ]->button_typography_line_height_unit,
				'font_size_unit_medium'       => $this->settings->pricing_columns[ $column ]->button_typography_font_size_unit_medium,
				'line_height_unit_medium'     => $this->settings->pricing_columns[ $column ]->button_typography_line_height_unit_medium,
				'font_size_unit_responsive'   => $this->settings->pricing_columns[ $column ]->button_typography_font_size_unit_responsive,
				'line_height_unit_responsive' => $this->settings->pricing_columns[ $column ]->button_typography_line_height_unit_responsive,

				'button_padding_dimension'    => ( isset( $this->settings->pricing_columns[ $column ]->button_padding_dimension ) ) ? $this->settings->pricing_columns[ $column ]->button_padding_dimension : '',
				'button_border_style'         => ( isset( $this->settings->pricing_columns[ $column ]->button_border_style ) ) ? $this->settings->pricing_columns[ $column ]->button_border_style : '',
				'button_border_width'         => ( isset( $this->settings->pricing_columns[ $column ]->button_border_width ) ) ? $this->settings->pricing_columns[ $column ]->button_border_width : '',
				'button_border_radius'        => ( isset( $this->settings->pricing_columns[ $column ]->button_border_radius ) ) ? $this->settings->pricing_columns[ $column ]->button_border_radius : '',
				'button_border_color'         => ( isset( $this->settings->pricing_columns[ $column ]->button_border_color ) ) ? $this->settings->pricing_columns[ $column ]->button_border_color : '',

				'border_hover_color'          => ( isset( $this->settings->pricing_columns[ $column ]->border_hover_color ) ) ? $this->settings->pricing_columns[ $column ]->border_hover_color : '',
			);
		} else {

			$btn_settings = array(

				'text'                       => $this->settings->pricing_columns[ $column ]->btn_text,
				'link'                       => $this->settings->pricing_columns[ $column ]->btn_link,
				'link_target'                => $this->settings->pricing_columns[ $column ]->btn_link_target,
				'link_nofollow'              => $this->settings->pricing_columns[ $column ]->btn_link_nofollow,
				'icon'                       => $this->settings->pricing_columns[ $column ]->btn_icon,
				'icon_position'              => $this->settings->pricing_columns[ $column ]->btn_icon_position,
				'style'                      => $this->settings->pricing_columns[ $column ]->btn_style,
				'border_size'                => $this->settings->pricing_columns[ $column ]->btn_border_size,
				'transparent_button_options' => $this->settings->pricing_columns[ $column ]->btn_transparent_button_options,
				'threed_button_options'      => $this->settings->pricing_columns[ $column ]->btn_threed_button_options,
				'flat_button_options'        => $this->settings->pricing_columns[ $column ]->btn_flat_button_options,
				'bg_color'                   => $this->settings->pricing_columns[ $column ]->btn_bg_color,
				'bg_hover_color'             => $this->settings->pricing_columns[ $column ]->btn_bg_hover_color,
				'text_color'                 => $this->settings->pricing_columns[ $column ]->btn_text_color,
				'text_hover_color'           => $this->settings->pricing_columns[ $column ]->btn_text_hover_color,
				'width'                      => $this->settings->pricing_columns[ $column ]->btn_width,
				'custom_width'               => $this->settings->pricing_columns[ $column ]->btn_custom_width,
				'custom_height'              => $this->settings->pricing_columns[ $column ]->btn_custom_height,
				'padding_top_bottom'         => $this->settings->pricing_columns[ $column ]->btn_padding_top_bottom,
				'padding_left_right'         => $this->settings->pricing_columns[ $column ]->btn_padding_left_right,
				'border_radius'              => $this->settings->pricing_columns[ $column ]->btn_border_radius,
				'custom_class'               => $this->settings->pricing_columns[ $column ]->btn_custom_class,
				'align'                      => '',
				'mob_align'                  => '',
				'font_size'                  => ( isset( $this->settings->pricing_columns[ $column ]->button_typography_font_size ) ) ? $this->settings->pricing_columns[ $column ]->button_typography_font_size : '',
				'line_height'                => ( isset( $this->settings->pricing_columns[ $column ]->button_typography_line_height ) ) ? $this->settings->pricing_columns[ $column ]->button_typography_line_height : '',
				'button_typo'                => ( isset( $this->settings->pricing_columns[ $column ]->button_typo ) ) ? $this->settings->pricing_columns[ $column ]->button_typo : '',

				'button_typo_medium'         => ( isset( $this->settings->pricing_columns[ $column ]->button_typo_medium ) ) ? $this->settings->pricing_columns[ $column ]->button_typo_medium : '',

				'button_typo_responsive'     => ( isset( $this->settings->pricing_columns[ $column ]->button_typo_responsive ) ) ? $this->settings->pricing_columns[ $column ]->button_typo_responsive : '',

				'button_padding_dimension'   => ( isset( $this->settings->pricing_columns[ $column ]->button_padding_dimension ) ) ? $this->settings->pricing_columns[ $column ]->button_padding_dimension : '',
				'button_border'              => ( isset( $this->settings->pricing_columns[ $column ]->button_border ) ) ? $this->settings->pricing_columns[ $column ]->button_border : '',
				'border_hover_color'         => ( isset( $this->settings->pricing_columns[ $column ]->border_hover_color ) ) ? $this->settings->pricing_columns[ $column ]->border_hover_color : '',
			);
		}
		FLBuilder::render_module_html( 'uabb-button', $btn_settings );
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

			// For Title typo.
			if ( ! isset( $settings->title_typo ) || ! is_array( $settings->title_typo ) ) {

				$settings->title_typo            = array();
				$settings->title_typo_medium     = array();
				$settings->title_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {
				if ( isset( $settings->title_typography_font_family['family'] ) ) {
					$settings->title_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_typography_font_family['weight'] ) {
						$settings->title_typo['font_weight'] = 'normal';
					} else {
						$settings->title_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit );
			}
			if ( isset( $settings->title_typography_font_size_unit_medium ) ) {

				$settings->title_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_medium );
			}
			if ( isset( $settings->title_typography_font_size_unit_responsive ) ) {

				$settings->title_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->title_typography_line_height_unit ) ) {

				$settings->title_typo['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit );
			}
			if ( isset( $settings->title_typography_line_height_unit_medium ) ) {

				$settings->title_typo_medium['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_medium );
			}
			if ( isset( $settings->title_typography_line_height_unit_responsive ) ) {

				$settings->title_typo_responsive['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_responsive );
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

			// For columns features title typo.
			if ( ! isset( $settings->feature_typo ) || ! is_array( $settings->feature_typo ) ) {

				$settings->feature_typo            = array();
				$settings->feature_typo_medium     = array();
				$settings->feature_typo_responsive = array();
			}
			if ( isset( $settings->feature_typography_font_family ) ) {
				if ( isset( $settings->feature_typography_font_family['family'] ) ) {
					$settings->feature_typo['font_family'] = $settings->feature_typography_font_family['family'];
					unset( $settings->feature_typography_font_family['family'] );
				}
				if ( isset( $settings->feature_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->feature_typography_font_family['weight'] ) {
						$settings->feature_typo['font_weight'] = 'normal';
					} else {
						$settings->feature_typo['font_weight'] = $settings->feature_typography_font_family['weight'];
					}
					unset( $settings->feature_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->feature_typography_font_size_unit ) ) {
				$settings->feature_typo['font_size'] = array(
					'length' => $settings->feature_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->feature_typography_font_size_unit );
			}
			if ( isset( $settings->feature_typography_font_size_unit_medium ) ) {

				$settings->feature_typo_medium['font_size'] = array(
					'length' => $settings->feature_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->feature_typography_font_size_unit_medium );
			}
			if ( isset( $settings->feature_typography_font_size_unit_responsive ) ) {

				$settings->feature_typo_responsive['font_size'] = array(
					'length' => $settings->feature_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->feature_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->feature_typography_line_height_unit ) ) {

				$settings->feature_typo['line_height'] = array(
					'length' => $settings->feature_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->feature_typography_line_height_unit );
			}
			if ( isset( $settings->feature_typography_line_height_unit_medium ) ) {

				$settings->feature_typo_medium['line_height'] = array(
					'length' => $settings->feature_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->feature_typography_line_height_unit_medium );
			}
			if ( isset( $settings->feature_typography_line_height_unit_responsive ) ) {

				$settings->feature_typo_responsive['line_height'] = array(
					'length' => $settings->feature_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->feature_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->feature_content_transform ) ) {
				$settings->feature_typo['text_transform'] = $settings->feature_content_transform;
				unset( $settings->feature_content_transform );
			}
			if ( isset( $settings->features_align ) ) {
				$settings->feature_typo['text_align'] = $settings->features_align;
				unset( $settings->features_align );
			}
			if ( isset( $settings->feature_content_letter_spacing ) ) {
				$settings->feature_typo['letter_spacing'] = array(
					'length' => $settings->feature_content_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->feature_content_letter_spacing );
			}

			// For Price Typo.
			if ( ! isset( $settings->price_typo ) || ! is_array( $settings->price_typo ) ) {

				$settings->price_typo            = array();
				$settings->price_typo_medium     = array();
				$settings->price_typo_responsive = array();
			}
			if ( isset( $settings->price_typography_font_family ) ) {
				if ( isset( $settings->price_typography_font_family['family'] ) ) {
					$settings->price_typo['font_family'] = $settings->price_typography_font_family['family'];
					unset( $settings->price_typography_font_family['family'] );
				}
				if ( isset( $settings->price_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->price_typography_font_family['weight'] ) {
						$settings->price_typo['font_weight'] = 'normal';
					} else {
						$settings->price_typo['font_weight'] = $settings->price_typography_font_family['weight'];
					}
					unset( $settings->price_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->price_typography_font_size_unit ) ) {

				$settings->price_typo['font_size'] = array(
					'length' => $settings->price_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->price_typography_font_size_unit );
			}
			if ( isset( $settings->price_typography_font_size_unit_medium ) ) {

				$settings->price_typo_medium['font_size'] = array(
					'length' => $settings->price_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->price_typography_font_size_unit_medium );
			}
			if ( isset( $settings->price_typography_font_size_unit_responsive ) ) {

				$settings->price_typo_responsive['font_size'] = array(
					'length' => $settings->price_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->price_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->price_typography_line_height_unit ) ) {

				$settings->price_typo['line_height'] = array(
					'length' => $settings->price_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->price_typography_line_height_unit );
			}
			if ( isset( $settings->price_typography_line_height_unit_medium ) ) {

				$settings->price_typo_medium['line_height'] = array(
					'length' => $settings->price_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->price_typography_line_height_unit_medium );
			}
			if ( isset( $settings->price_typography_line_height_unit_responsive ) ) {

				$settings->price_typo_responsive['line_height'] = array(
					'length' => $settings->price_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->price_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->price_typography_letter_spacing ) ) {

				$settings->price_typo['letter_spacing'] = array(
					'length' => $settings->price_typography_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->price_typography_letter_spacing );
			}

			// For Duration Typo.
			if ( ! isset( $settings->duration_typo ) || ! is_array( $settings->duration_typo ) ) {

				$settings->duration_typo            = array();
				$settings->duration_typo_medium     = array();
				$settings->duration_typo_responsive = array();
			}
			if ( isset( $settings->duration_typography_font_family ) ) {

				if ( isset( $settings->duration_typography_font_family['family'] ) ) {

					$settings->duration_typo['font_family'] = $settings->duration_typography_font_family['family'];
					unset( $settings->duration_typography_font_family['family'] );
				}
				if ( isset( $settings->duration_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->duration_typography_font_family['weight'] ) {
						$settings->duration_typo['font_weight'] = 'normal';
					} else {
						$settings->duration_typo['font_weight'] = $settings->duration_typography_font_family['weight'];
					}
					unset( $settings->duration_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->duration_typography_font_size_unit ) ) {

				$settings->duration_typo['font_size'] = array(
					'length' => $settings->duration_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->duration_typography_font_size_unit );
			}
			if ( isset( $settings->duration_typography_font_size_unit_medium ) ) {

				$settings->duration_typo_medium['font_size'] = array(
					'length' => $settings->duration_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->duration_typography_font_size_unit_medium );
			}
			if ( isset( $settings->duration_typography_font_size_unit_responsive ) ) {

				$settings->duration_typo_responsive['font_size'] = array(
					'length' => $settings->duration_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->duration_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->duration_typography_line_height_unit ) ) {

				$settings->duration_typo['line_height'] = array(
					'length' => $settings->duration_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->duration_typography_line_height_unit );
			}
			if ( isset( $settings->duration_typography_line_height_unit_medium ) ) {

				$settings->duration_typo_medium['line_height'] = array(
					'length' => $settings->duration_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->duration_typography_line_height_unit_medium );
			}
			if ( isset( $settings->duration_typography_line_height_unit_responsive ) ) {

				$settings->duration_typo_responsive['line_height'] = array(
					'length' => $settings->duration_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->duration_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->duration_typography_transform ) ) {
				$settings->duration_typo['text_transform'] = $settings->duration_typography_transform;
				unset( $settings->duration_typography_transform );
			}
			if ( isset( $settings->duration_typography_letter_spacing ) ) {

				$settings->duration_typo['letter_spacing'] = array(
					'length' => $settings->duration_typography_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->duration_typography_letter_spacing );
			}
			for ( $i = 0; $i < count( $settings->pricing_columns ); $i++ ) {

				if ( ! isset( $settings->pricing_columns[ $i ]->button_typo ) || ! is_object( $settings->pricing_columns[ $i ]->button_typo ) ) {

					$settings->pricing_columns[ $i ]->button_typo            = new stdClass();
					$settings->pricing_columns[ $i ]->button_typo_medium     = new stdClass();
					$settings->pricing_columns[ $i ]->button_typo_responsive = new stdClass();
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family ) ) {
					if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family->family ) ) {

						$settings->pricing_columns[ $i ]->button_typo->font_family = $settings->pricing_columns[ $i ]->button_typography_font_family->family;
					}
					if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family->weight ) ) {
						if ( 'regular' == $settings->pricing_columns[ $i ]->button_typography_font_family->weight ) {
							$settings->pricing_columns[ $i ]->button_typo->font_weight = 'normal';
						} else {
							$settings->pricing_columns[ $i ]->button_typo->font_weight = $settings->pricing_columns[ $i ]->button_typography_font_family->weight;
						}
					}
					unset( $settings->pricing_columns[ $i ]->button_typography_font_family );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit ) ) {

					$settings->pricing_columns[ $i ]->button_typo->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium ) ) {

					$settings->pricing_columns[ $i ]->button_typo_medium->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive ) ) {

					$settings->pricing_columns[ $i ]->button_typo_responsive->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit ) ) {

					$settings->pricing_columns[ $i ]->button_typo->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium ) ) {

					$settings->pricing_columns[ $i ]->button_typo_medium->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive ) ) {

					$settings->pricing_columns[ $i ]->button_typo_responsive->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_transform ) ) {
					$settings->pricing_columns[ $i ]->button_typo->text_transform = $settings->pricing_columns[ $i ]->button_transform;
					unset( $settings->pricing_columns[ $i ]->button_transform );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_letter_spacing ) ) {

					$settings->pricing_columns[ $i ]->button_typo->letter_spacing = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->button_letter_spacing );
				}
				if ( isset( $settings->pricing_columns[ $i ]->btn_link_nofollow ) ) {
					if ( '1' == $settings->pricing_columns[ $i ]->btn_link_nofollow || 'yes' == $settings->pricing_columns[ $i ]->btn_link_nofollow ) {
						$settings->pricing_columns[ $i ]->btn_link_nofollow = 'yes';
					}
				}
				if ( ! isset( $settings->pricing_columns[ $i ]->featured_typo ) || ! is_object( $settings->pricing_columns[ $i ]->featured_typo ) ) {

					$settings->pricing_columns[ $i ]->featured_typo            = new stdClass();
					$settings->pricing_columns[ $i ]->featured_typo_medium     = new stdClass();
					$settings->pricing_columns[ $i ]->featured_typo_responsive = new stdClass();
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_family ) ) {
					if ( isset( $settings->pricing_columns[ $i ]->featured_font_family->family ) ) {

						$settings->pricing_columns[ $i ]->featured_typo->font_family = $settings->pricing_columns[ $i ]->featured_font_family->family;
						unset( $settings->pricing_columns[ $i ]->featured_font_family->family );
					}
					if ( isset( $settings->pricing_columns[ $i ]->featured_font_family->weight ) ) {
						if ( 'regular' == $settings->pricing_columns[ $i ]->featured_font_family->weight ) {
							$settings->pricing_columns[ $i ]->featured_typo->font_weight = 'normal';
						} else {
							$settings->pricing_columns[ $i ]->featured_typo->font_weight = $settings->pricing_columns[ $i ]->featured_font_family->weight;
						}
						unset( $settings->pricing_columns[ $i ]->featured_font_family->weight );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit ) ) {

					$settings->pricing_columns[ $i ]->featured_typo->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->featured_font_size_unit );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ) ) {
					$settings->pricing_columns[ $i ]->featured_typo_medium->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) ) {

					$settings->pricing_columns[ $i ]->featured_typo_responsive->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit ) ) {

					$settings->pricing_columns[ $i ]->featured_typo->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->featured_line_height_unit );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) ) {
					$settings->pricing_columns[ $i ]->featured_typo_medium->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) ) {
					$settings->pricing_columns[ $i ]->featured_typo_responsive->line_height = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_transform ) ) {
					$settings->pricing_columns[ $i ]->featured_typo->text_transform = $settings->pricing_columns[ $i ]->featured_transform;
					unset( $settings->pricing_columns[ $i ]->featured_transform );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_letter_spacing ) ) {

					$settings->pricing_columns[ $i ]->featured_typo->letter_spacing = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->pricing_columns[ $i ]->featured_letter_spacing );
				}
				if ( ! isset( $settings->legend_column->legend_typo ) || ! is_object( $settings->legend_column->legend_typo ) ) {

					$settings->legend_column->legend_typo            = new stdClass();
					$settings->legend_column->legend_typo_medium     = new stdClass();
					$settings->legend_column->legend_typo_responsive = new stdClass();
				}
				if ( isset( $settings->legend_column->legend_font_family ) ) {
					if ( isset( $settings->legend_column->legend_font_family->family ) ) {

						$settings->legend_column->legend_typo->font_family = $settings->legend_column->legend_font_family->family;
						unset( $settings->legend_column->legend_font_family->family );
					}
					if ( isset( $settings->legend_column->legend_font_family->weight ) ) {
						if ( 'regular' == $settings->legend_column->legend_font_family->weight ) {
							$settings->legend_column->legend_typo->font_weight = 'normal';
						} else {
							$settings->legend_column->legend_typo->font_weight = $settings->legend_column->legend_font_family->weight;
						}
						unset( $settings->legend_column->legend_font_family->weight );
					}
				}
				if ( isset( $settings->legend_column->legend_font_size_unit ) ) {

					$settings->legend_column->legend_typo->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->legend_column->legend_font_size_unit );
				}
				if ( isset( $settings->legend_column->legend_font_size_unit_medium ) ) {

					$settings->legend_column->legend_typo_medium->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->legend_column->legend_font_size_unit_medium );
				}
				if ( isset( $settings->legend_column->legend_font_size_unit_responsive ) ) {

					$settings->legend_column->legend_typo_responsive->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->legend_column->legend_font_size_unit_responsive );
				}
				if ( isset( $settings->legend_column->legend_line_height_unit ) ) {

					$settings->legend_column->legend_typo->line_height = (object) array(
						'length' => $settings->legend_column->legend_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->legend_column->legend_line_height_unit );
				}
				if ( isset( $settings->legend_column->legend_line_height_unit_medium ) ) {

					$settings->legend_column->legend_typo_medium->line_height = (object) array(
						'length' => $settings->legend_column->legend_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->legend_column->legend_line_height_unit_medium );
				}
				if ( isset( $settings->legend_column->legend_line_height_unit_responsive ) ) {

					$settings->legend_column->legend_typo_responsive->line_height = (object) array(
						'length' => $settings->legend_column->legend_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->legend_column->legend_line_height_unit_responsive );
				}
				if ( isset( $settings->legend_column->legend_transform ) ) {
					$settings->legend_column->legend_typo->text_transform = $settings->legend_column->legend_transform;
					unset( $settings->legend_column->legend_transform );
				}
				if ( isset( $settings->legend_column->legend_letter_spacing ) ) {
					$settings->legend_column->legend_typo->letter_spacing = (object) array(
						'length' => $settings->legend_column->legend_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->legend_column->legend_letter_spacing );
				}
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// For Title typo.
			if ( ! isset( $settings->title_typo ) || ! is_array( $settings->title_typo ) ) {

				$settings->title_typo            = array();
				$settings->title_typo_medium     = array();
				$settings->title_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {

				if ( isset( $settings->title_typography_font_family['family'] ) ) {
					$settings->title_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_typography_font_family['weight'] ) {
						$settings->title_typo['font_weight'] = 'normal';
					} else {
						$settings->title_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}

			if ( isset( $settings->title_typography_font_size['small'] ) ) {
				$settings->title_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) ) {
				$settings->title_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) ) {
				$settings->title_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_typo_medium['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_typo['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For column features typo.
			if ( ! isset( $settings->feature_typo ) || ! is_array( $settings->feature_typo ) ) {

				$settings->feature_typo            = array();
				$settings->feature_typo_medium     = array();
				$settings->feature_typo_responsive = array();
			}
			if ( isset( $settings->feature_typography_font_family ) ) {

				if ( isset( $settings->feature_typography_font_family['family'] ) ) {
					$settings->feature_typo['font_family'] = $settings->feature_typography_font_family['family'];
					unset( $settings->feature_typography_font_family['family'] );
				}
				if ( isset( $settings->feature_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->feature_typography_font_family['weight'] ) {
						$settings->feature_typo['font_weight'] = 'normal';
					} else {
						$settings->feature_typo['font_weight'] = $settings->feature_typography_font_family['weight'];
					}
					unset( $settings->feature_typography_font_family['weight'] );
				}
			}

			if ( isset( $settings->feature_typography_font_size['small'] ) ) {
				$settings->feature_typo_responsive['font_size'] = array(
					'length' => $settings->feature_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->feature_typography_font_size['medium'] ) ) {
				$settings->feature_typo_medium['font_size'] = array(
					'length' => $settings->feature_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->feature_typography_font_size['desktop'] ) ) {
				$settings->feature_typo['font_size'] = array(
					'length' => $settings->feature_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->feature_typography_line_height['small'] ) && isset( $settings->feature_typography_font_size['small'] ) && 0 != $settings->feature_typography_font_size['small'] ) {
				if ( is_numeric( $settings->feature_typography_line_height['small'] ) && is_numeric( $settings->feature_typography_font_size['small'] ) ) {
					$settings->feature_typo_responsive['line_height'] = array(
						'length' => round( $settings->feature_typography_line_height['small'] / $settings->feature_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->feature_typography_line_height['medium'] ) && isset( $settings->feature_typography_font_size['medium'] ) && 0 != $settings->feature_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->feature_typography_line_height['medium'] ) && is_numeric( $settings->feature_typography_font_size['medium'] ) ) {
					$settings->feature_typo_medium['line_height'] = array(
						'length' => round( $settings->feature_typography_line_height['medium'] / $settings->feature_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->feature_typography_line_height['desktop'] ) && isset( $settings->feature_typography_font_size['desktop'] ) && 0 != $settings->feature_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->feature_typography_line_height['desktop'] ) && is_numeric( $settings->feature_typography_font_size['desktop'] ) ) {
					$settings->feature_typo['line_height'] = array(
						'length' => round( $settings->feature_typography_line_height['desktop'] / $settings->feature_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->features_align ) ) {
				$settings->feature_typo['text_align'] = $settings->features_align;
				unset( $settings->features_align );
			}

			// For Price Typo.
			if ( ! isset( $settings->price_typo ) || ! is_array( $settings->price_typo ) ) {

				$settings->price_typo            = array();
				$settings->price_typo_medium     = array();
				$settings->price_typo_responsive = array();
			}
			if ( isset( $settings->price_typography_font_family ) ) {

				if ( isset( $settings->price_typography_font_family['family'] ) ) {
					$settings->price_typo['font_family'] = $settings->price_typography_font_family['family'];
					unset( $settings->price_typography_font_family['family'] );
				}
				if ( isset( $settings->price_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->price_typography_font_family['weight'] ) {
						$settings->price_typo['font_weight'] = 'normal';
					} else {
						$settings->price_typo['font_weight'] = $settings->price_typography_font_family['weight'];
					}
					unset( $settings->price_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->price_typography_font_size['small'] ) ) {
				$settings->price_typo_responsive['font_size'] = array(
					'length' => $settings->price_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->price_typography_font_size['medium'] ) ) {
				$settings->price_typo_medium['font_size'] = array(
					'length' => $settings->price_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->price_typography_font_size['desktop'] ) ) {
				$settings->price_typo['font_size'] = array(
					'length' => $settings->price_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->price_typography_line_height['small'] ) && isset( $settings->price_typography_font_size['small'] ) && 0 != $settings->price_typography_font_size['small'] ) {
				if ( is_numeric( $settings->price_typography_line_height['small'] ) && is_numeric( $settings->price_typography_font_size['small'] ) ) {
					$settings->price_typo_responsive['line_height'] = array(
						'length' => round( $settings->price_typography_line_height['small'] / $settings->price_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->price_typography_line_height['medium'] ) && isset( $settings->price_typography_font_size['medium'] ) && 0 != $settings->price_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->price_typography_line_height['medium'] ) && is_numeric( $settings->price_typography_font_size['medium'] ) ) {
					$settings->price_typo_medium['line_height'] = array(
						'length' => round( $settings->price_typography_line_height['medium'] / $settings->price_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->price_typography_line_height['desktop'] ) && isset( $settings->price_typography_font_size['desktop'] ) && 0 != $settings->price_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->price_typography_line_height['desktop'] ) && is_numeric( $settings->price_typography_font_size['desktop'] ) ) {
					$settings->price_typo['line_height'] = array(
						'length' => round( $settings->price_typography_line_height['desktop'] / $settings->price_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Duration Typo.
			if ( ! isset( $settings->duration_typo ) || ! is_array( $settings->duration_typo ) ) {

				$settings->duration_typo            = array();
				$settings->duration_typo_medium     = array();
				$settings->duration_typo_responsive = array();
			}
			if ( isset( $settings->duration_typography_font_family ) ) {
				if ( isset( $settings->duration_typography_font_family['family'] ) ) {

					$settings->duration_typo['font_family'] = $settings->duration_typography_font_family['family'];
					unset( $settings->duration_typography_font_family['family'] );
				}
				if ( isset( $settings->duration_typography_font_family['weight'] ) ) {
					if ( 'regular' == $settings->duration_typography_font_family['weight'] ) {
						$settings->duration_typo['font_weight'] = 'normal';
					} else {
						$settings->duration_typo['font_weight'] = $settings->duration_typography_font_family['weight'];
					}
					unset( $settings->duration_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->duration_typography_font_size['small'] ) ) {
				$settings->duration_typo_responsive['font_size'] = array(
					'length' => $settings->duration_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->duration_typography_font_size['medium'] ) ) {
				$settings->duration_typo_medium['font_size'] = array(
					'length' => $settings->duration_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->duration_typography_font_size['desktop'] ) ) {
				$settings->duration_typo['font_size'] = array(
					'length' => $settings->duration_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->duration_typography_line_height['small'] ) && isset( $settings->duration_typography_font_size['small'] ) && 0 != $settings->duration_typography_font_size['small'] ) {
				if ( is_numeric( $settings->duration_typography_line_height['small'] ) && is_numeric( $settings->duration_typography_font_size['small'] ) ) {
					$settings->duration_typo_responsive['line_height'] = array(
						'length' => round( $settings->duration_typography_line_height['small'] / $settings->duration_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->duration_typography_line_height['medium'] ) && isset( $settings->duration_typography_font_size['medium'] ) && 0 != $settings->duration_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->duration_typography_line_height['medium'] ) && is_numeric( $settings->duration_typography_font_size['medium'] ) ) {
					$settings->duration_typo_medium['line_height'] = array(
						'length' => round( $settings->duration_typography_line_height['medium'] / $settings->duration_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->duration_typography_line_height['desktop'] ) && isset( $settings->duration_typography_font_size['desktop'] ) && 0 != $settings->duration_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->duration_typography_line_height['desktop'] ) && is_numeric( $settings->duration_typography_font_size['desktop'] ) ) {
					$settings->duration_typo['line_height'] = array(
						'length' => round( $settings->duration_typography_line_height['desktop'] / $settings->duration_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			for ( $i = 0; $i < count( $settings->pricing_columns ); $i++ ) {

				if ( ! isset( $settings->pricing_columns[ $i ]->button_typo ) || ! is_object( $settings->pricing_columns[ $i ]->button_typo ) ) {

					$settings->pricing_columns[ $i ]->button_typo            = new stdclass();
					$settings->pricing_columns[ $i ]->button_typo_medium     = new stdclass();
					$settings->pricing_columns[ $i ]->button_typo_responsive = new stdclass();
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family ) ) {
					if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family->family ) ) {

						$settings->pricing_columns[ $i ]->button_typo->font_family = $settings->pricing_columns[ $i ]->button_typography_font_family->family;
					}
					if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_family->weight ) ) {
						if ( 'regular' == $settings->pricing_columns[ $i ]->button_typography_font_family->weight ) {
							$settings->pricing_columns[ $i ]->button_typo->font_weight = 'normal';
						} else {
							$settings->pricing_columns[ $i ]->button_typo->font_weight = $settings->pricing_columns[ $i ]->button_typography_font_family->weight;
						}
					}
					unset( $settings->pricing_columns[ $i ]->button_typography_font_family );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) ) {

					$settings->pricing_columns[ $i ]->button_typo->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) ) {
					$settings->pricing_columns[ $i ]->button_typo_medium->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) ) {
					$settings->pricing_columns[ $i ]->button_typo_responsive->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->button_typography_font_size->small,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) ) {

						$settings->pricing_columns[ $i ]->button_typo->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop / $settings->pricing_columns[ $i ]->button_typography_font_size->desktop, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->medium ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->medium ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) ) {
						$settings->pricing_columns[ $i ]->button_typo_medium->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->button_typography_line_height->medium / $settings->pricing_columns[ $i ]->button_typography_font_size->medium, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->small ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->small ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->small ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) ) {
						$settings->pricing_columns[ $i ]->button_typo_responsive->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->button_typography_line_height->small / $settings->pricing_columns[ $i ]->button_typography_font_size->small, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size ) ) {

					unset( $settings->pricing_columns[ $i ]->button_typography_font_size );
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height ) ) {
					unset( $settings->pricing_columns[ $i ]->button_typography_line_height );
				}
				if ( ! isset( $settings->pricing_columns[ $i ]->featured_typo ) || ! is_object( $settings->pricing_columns[ $i ]->featured_typo ) ) {

					$settings->pricing_columns[ $i ]->featured_typo            = new stdClass();
					$settings->pricing_columns[ $i ]->featured_typo_medium     = new stdClass();
					$settings->pricing_columns[ $i ]->featured_typo_responsive = new stdClass();
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_family ) ) {
					if ( isset( $settings->pricing_columns[ $i ]->featured_font_family->family ) ) {

						$settings->pricing_columns[ $i ]->featured_typo->font_family = $settings->pricing_columns[ $i ]->featured_font_family->family;
						unset( $settings->pricing_columns[ $i ]->featured_font_family->family );
					}
					if ( isset( $settings->pricing_columns[ $i ]->featured_font_family->weight ) ) {
						if ( 'regular' == $settings->pricing_columns[ $i ]->featured_font_family->weight ) {
							$settings->pricing_columns[ $i ]->featured_typo->font_weight = 'normal';
						} else {
							$settings->pricing_columns[ $i ]->featured_typo->font_weight = $settings->pricing_columns[ $i ]->featured_font_family->weight;
						}
						unset( $settings->pricing_columns[ $i ]->featured_font_family->weight );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) ) {

					$settings->pricing_columns[ $i ]->featured_typo->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) ) {
					$settings->pricing_columns[ $i ]->featured_typo_medium->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) ) {
					$settings->pricing_columns[ $i ]->featured_typo_responsive->font_size = (object) array(
						'length' => $settings->pricing_columns[ $i ]->featured_font_size->small,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->desktop ) {

					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) ) {

						$settings->pricing_columns[ $i ]->featured_typo->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->featured_line_height->desktop / $settings->pricing_columns[ $i ]->featured_font_size->desktop, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->medium ) {

					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->medium ) ) {
						$settings->pricing_columns[ $i ]->featured_typo_medium->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->featured_line_height->medium / $settings->pricing_columns[ $i ]->featured_font_size->medium, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->small ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->small ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->small ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->small ) ) {
						$settings->pricing_columns[ $i ]->featured_typo_responsive->line_height = (object) array(
							'length' => round( $settings->pricing_columns[ $i ]->featured_line_height->small / $settings->pricing_columns[ $i ]->featured_font_size->small, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_font_size->desktop );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_font_size->medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_font_size->small );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_line_height->desktop );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->medium ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_line_height->medium );
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->small ) ) {
					unset( $settings->pricing_columns[ $i ]->featured_line_height->small );
				}
				if ( ! isset( $settings->legend_column->legend_typo ) || ! is_object( $settings->legend_column->legend_typo ) ) {

					$settings->legend_column->legend_typo            = new stdClass();
					$settings->legend_column->legend_typo_medium     = new stdClass();
					$settings->legend_column->legend_typo_responsive = new stdClass();
				}
				if ( isset( $settings->legend_column->legend_font_family ) ) {
					if ( isset( $settings->legend_column->legend_font_family->family ) ) {

						$settings->legend_column->legend_typo->font_family = $settings->legend_column->legend_font_family->family;
						unset( $settings->legend_column->legend_font_family->family );
					}
					if ( isset( $settings->legend_column->legend_font_family->weight ) ) {
						if ( 'regular' == $settings->legend_column->legend_font_family->weight ) {
							$settings->legend_column->legend_typo->font_weight = 'normal';
						} else {
							$settings->legend_column->legend_typo->font_weight = $settings->legend_column->legend_font_family->weight;
						}
						unset( $settings->legend_column->legend_font_family->weight );
					}
				}
				if ( isset( $settings->legend_column->legend_font_size->desktop ) ) {

					$settings->legend_column->legend_typo->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->legend_column->legend_font_size->medium ) ) {
					$settings->legend_column->legend_typo_medium->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->legend_column->legend_font_size->small ) ) {
					$settings->legend_column->legend_typo_responsive->font_size = (object) array(
						'length' => $settings->legend_column->legend_font_size->small,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->legend_column->legend_line_height->desktop ) && isset( $settings->legend_column->legend_font_size->desktop ) && 0 != $settings->legend_column->legend_font_size->desktop ) {

					if ( is_numeric( $settings->legend_column->legend_line_height->desktop ) && is_numeric( $settings->legend_column->legend_font_size->desktop ) ) {

						$settings->legend_column->legend_typo->line_height = (object) array(
							'length' => round( $settings->legend_column->legend_line_height->desktop / $settings->legend_column->legend_font_size->desktop, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->legend_column->legend_line_height->medium ) && isset( $settings->legend_column->legend_font_size->medium ) && 0 != $settings->legend_column->legend_font_size->medium ) {
					if ( is_numeric( $settings->legend_column->legend_line_height->medium ) && is_numeric( $settings->legend_column->legend_font_size->medium ) ) {
						$settings->legend_column->legend_typo_medium->line_height = (object) array(
							'length' => round( $settings->legend_column->legend_line_height->medium / $settings->legend_column->legend_font_size->medium, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->legend_column->legend_line_height->small ) && isset( $settings->legend_column->legend_font_size->small ) && 0 != $settings->legend_column->legend_font_size->small ) {
					if ( is_numeric( $settings->legend_column->legend_line_height->small ) && is_numeric( $settings->legend_column->legend_font_size->small ) ) {
						$settings->legend_column->legend_typo_responsive->line_height = (object) array(
							'length' => round( $settings->legend_column->legend_line_height->small / $settings->legend_column->legend_font_size->small, 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->legend_column->legend_font_size->desktop ) ) {
					unset( $settings->legend_column->legend_font_size->desktop );
				}
				if ( isset( $settings->legend_column->legend_font_size->medium ) ) {
					unset( $settings->legend_column->legend_font_size->medium );
				}
				if ( isset( $settings->legend_column->legend_font_size->small ) ) {
					unset( $settings->legend_column->legend_font_size->small );
				}
				if ( isset( $settings->legend_column->legend_line_height->desktop ) ) {
					unset( $settings->legend_column->legend_line_height->desktop );
				}
				if ( isset( $settings->legend_column->legend_line_height->medium ) ) {
					unset( $settings->legend_column->legend_line_height->medium );
				}
				if ( isset( $settings->legend_column->legend_line_height->small ) ) {
					unset( $settings->legend_column->legend_line_height->small );
				}
			}
			// Unset the old values.
			if ( isset( $settings->title_typography_font_size_unit['desktop'] ) ) {
				unset( $settings->title_typography_font_size_unit['desktop'] );
			}
			if ( isset( $settings->title_typography_font_size_unit['medium'] ) ) {
				unset( $settings->title_typography_font_size_unit['medium'] );
			}
			if ( isset( $settings->title_typography_font_size_unit['small'] ) ) {
				unset( $settings->title_typography_font_size_unit['small'] );
			}
			if ( isset( $settings->title_typography_line_height_unit['desktop'] ) ) {
				unset( $settings->title_typography_line_height_unit['desktop'] );
			}
			if ( isset( $settings->title_typography_line_height_unit['medium'] ) ) {
				unset( $settings->title_typography_line_height_unit['medium'] );
			}
			if ( isset( $settings->title_typography_line_height_unit['small'] ) ) {
				unset( $settings->title_typography_line_height_unit['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->feature_typography_font_size['desktop'] ) ) {
				unset( $settings->feature_typography_font_size['desktop'] );
			}
			if ( isset( $settings->feature_typography_font_size['medium'] ) ) {
				unset( $settings->feature_typography_font_size['medium'] );
			}
			if ( isset( $settings->feature_typography_font_size['small'] ) ) {
				unset( $settings->feature_typography_font_size['small'] );
			}
			if ( isset( $settings->feature_typography_line_height['desktop'] ) ) {
				unset( $settings->feature_typography_line_height['desktop'] );
			}
			if ( isset( $settings->feature_typography_line_height['medium'] ) ) {
				unset( $settings->feature_typography_line_height['medium'] );
			}
			if ( isset( $settings->feature_typography_line_height['small'] ) ) {
				unset( $settings->feature_typography_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->price_typography_font_size_unit['desktop'] ) ) {
				unset( $settings->price_typography_font_size_unit['desktop'] );
			}
			if ( isset( $settings->price_typography_font_size_unit['medium'] ) ) {
				unset( $settings->price_typography_font_size_unit['medium'] );
			}
			if ( isset( $settings->price_typography_font_size_unit['small'] ) ) {
				unset( $settings->price_typography_font_size_unit['small'] );
			}
			if ( isset( $settings->feature_typography_line_height['desktop'] ) ) {
				unset( $settings->feature_typography_line_height['desktop'] );
			}
			if ( isset( $settings->feature_typography_line_height['medium'] ) ) {
				unset( $settings->feature_typography_line_height['medium'] );
			}
			if ( isset( $settings->feature_typography_line_height['small'] ) ) {
				unset( $settings->feature_typography_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->duration_typography_font_size_unit['desktop'] ) ) {
				unset( $settings->duration_typography_font_size_unit['desktop'] );
			}
			if ( isset( $settings->duration_typography_font_size_unit['medium'] ) ) {
				unset( $settings->duration_typography_font_size_unit['medium'] );
			}
			if ( isset( $settings->duration_typography_font_size_unit['small'] ) ) {
				unset( $settings->duration_typography_font_size_unit['small'] );
			}
			if ( isset( $settings->duration_typography_line_height_unit['desktop'] ) ) {
				unset( $settings->duration_typography_line_height_unit['desktop'] );
			}
			if ( isset( $settings->duration_typography_line_height_unit['medium'] ) ) {
				unset( $settings->duration_typography_line_height_unit['medium'] );
			}
			if ( isset( $settings->duration_typography_line_height_unit['small'] ) ) {
				unset( $settings->duration_typography_line_height_unit['small'] );
			}
		}
		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/pricing-box/pricing-box-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/pricing-box/pricing-box-bb-less-than-2-2-compatibility.php';
}
