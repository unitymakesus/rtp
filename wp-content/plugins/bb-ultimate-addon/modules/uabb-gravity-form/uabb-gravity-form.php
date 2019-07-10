<?php
/**
 *  UABB Gravity Form Module file
 *
 *  @package UABB Gravity Form Module
 */

/**
 * Function that initializes UABB Gravity Form Module
 *
 * @class UABBGravityFormModule
 */
class UABBGravityFormModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Gravity Form module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Gravity Forms Styler', 'uabb' ),
				'description'     => __( 'Style your gravity form', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-gravity-form/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-gravity-form/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);

		add_filter( 'fl_builder_render_settings_field', array( $this, 'uabb_gravity_form_render_settings_field' ), 10, 3 );
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

			// Border style, color, and width.
			if ( isset( $settings->input_border_color ) ) {

				$settings->input_border            = array();
				$settings->input_border_medium     = array();
				$settings->input_border_responsive = array();
				$settings->input_border['style']   = 'solid';
				$settings->input_border['color']   = $settings->input_border_color;
				unset( $settings->input_border_color );
				if ( isset( $settings->input_border_width_dimension_top ) && isset( $settings->input_border_width_dimension_right ) && isset( $settings->input_border_width_dimension_bottom ) && isset( $settings->input_border_width_dimension_left ) ) {
					if ( empty( $settings->input_border_width_dimension_top ) && empty( $settings->input_border_width_dimension_right ) && empty( $settings->input_border_width_dimension_bottom ) && empty( $settings->input_border_width_dimension_left ) ) {

						$settings->input_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->input_border['width'] = array(
							'top'    => $settings->input_border_width_dimension_top,
							'right'  => $settings->input_border_width_dimension_right,
							'bottom' => $settings->input_border_width_dimension_bottom,
							'left'   => $settings->input_border_width_dimension_left,
						);
						unset( $settings->input_border_width_dimension_top );
						unset( $settings->input_border_width_dimension_right );
						unset( $settings->input_border_width_dimension_bottom );
						unset( $settings->input_border_width_dimension_left );
					}
				}
				if ( isset( $settings->input_border_width_dimension_top_responsive ) && isset( $settings->input_border_width_dimension_right_responsive ) && isset( $settings->input_border_width_dimension_bottom_responsive ) && isset( $settings->input_border_width_dimension_left_responsive ) ) {

					$settings->input_border_responsive['width'] = array(
						'top'    => $settings->input_border_width_dimension_top_responsive,
						'right'  => $settings->input_border_width_dimension_right_responsive,
						'bottom' => $settings->input_border_width_dimension_bottom_responsive,
						'left'   => $settings->input_border_width_dimension_left_responsive,
					);
					unset( $settings->input_border_width_dimension_top_responsive );
					unset( $settings->input_border_width_dimension_right_responsive );
					unset( $settings->input_border_width_dimension_bottom_responsive );
					unset( $settings->input_border_width_dimension_left_responsive );
				}
				if ( isset( $settings->input_border_width_dimension_top_medium ) && isset( $settings->input_border_width_dimension_right_medium ) && isset( $settings->input_border_width_dimension_bottom_medium ) && isset( $settings->input_border_width_dimension_left_medium ) ) {

					$settings->input_border_medium['width'] = array(
						'top'    => $settings->input_border_width_dimension_top_medium,
						'right'  => $settings->input_border_width_dimension_right_medium,
						'bottom' => $settings->input_border_width_dimension_bottom_medium,
						'left'   => $settings->input_border_width_dimension_left_medium,
					);
					unset( $settings->input_border_width_dimension_top_medium );
					unset( $settings->input_border_width_dimension_right_medium );
					unset( $settings->input_border_width_dimension_bottom_medium );
					unset( $settings->input_border_width_dimension_left_medium );
				}
				// Border radius.
				if ( isset( $settings->input_border_radius ) ) {
					$settings->input_border['radius'] = array(
						'top_left'     => $settings->input_border_radius,
						'top_right'    => $settings->input_border_radius,
						'bottom_left'  => $settings->input_border_radius,
						'bottom_right' => $settings->input_border_radius,
					);
					unset( $settings->input_border_radius );
				}
			}

			// Handle old check-box border settings.
			if ( isset( $settings->validation_border_color ) ) {

					$settings->validation_border = array();

				// Border style, color, and width.
				$settings->validation_border['color'] = $settings->validation_border_color;
				unset( $settings->validation_border_color );
				if ( isset( $settings->validation_border_type ) ) {
					$settings->validation_border['style'] = $settings->validation_border_type;
					unset( $settings->validation_border_type );
				}
				if ( isset( $settings->validation_border_width ) ) {
					if ( empty( $settings->validation_border_width ) ) {
						$settings->validation_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->validation_border['width'] = array(
							'top'    => $settings->validation_border_width,
							'right'  => $settings->validation_border_width,
							'bottom' => $settings->validation_border_width,
							'left'   => $settings->validation_border_width,
						);
						unset( $settings->validation_border_width );
					}
				}
				// Border radius.
				if ( isset( $settings->validation_border_radius ) ) {
					$settings->validation_border['radius'] = array(
						'top_left'     => $settings->validation_border_radius,
						'top_right'    => $settings->validation_border_radius,
						'bottom_left'  => $settings->validation_border_radius,
						'bottom_right' => $settings->validation_border_radius,
					);
					unset( $settings->validation_border_radius );
				}
			}

			// Handle color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_background_hover_color_opc', 'btn_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_background_color_opc', 'btn_background_color' );
			$helper->handle_opacity_inputs( $settings, 'form_bg_color_opc', 'form_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'validation_bg_color_opc', 'validation_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'input_background_color_opc', 'input_background_color' );

			// compatibility for Form title.
			if ( ! isset( $settings->form_title_font_typo ) || ! is_array( $settings->form_title_font_typo ) ) {

				$settings->form_title_font_typo            = array();
				$settings->form_title_font_typo_medium     = array();
				$settings->form_title_font_typo_responsive = array();
			}
			if ( isset( $settings->form_title_font_family ) ) {

				if ( isset( $settings->form_title_font_family['family'] ) ) {

					$settings->form_title_font_typo['font_family'] = $settings->form_title_font_family['family'];
					unset( $settings->form_title_font_family['family'] );
				}
				if ( isset( $settings->form_title_font_family['weight'] ) ) {

					if ( 'regular' == $settings->form_title_font_family['weight'] ) {
						$settings->form_title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_title_font_typo['font_weight'] = $settings->form_title_font_family['weight'];
					}
					unset( $settings->form_title_font_family['weight'] );
				}
			}
			if ( isset( $settings->form_title_font_size_unit ) ) {

				$settings->form_title_font_typo['font_size'] = array(
					'length' => $settings->form_title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->form_title_font_size_unit );
			}
			if ( isset( $settings->form_title_font_size_unit_medium ) ) {
				$settings->form_title_font_typo_medium['font_size'] = array(
					'length' => $settings->form_title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->form_title_font_size_unit_medium );
			}
			if ( isset( $settings->form_title_font_size_unit_responsive ) ) {
				$settings->form_title_font_typo_responsive['font_size'] = array(
					'length' => $settings->form_title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->form_title_font_size_unit_responsive );
			}
			if ( isset( $settings->form_title_line_height_unit ) ) {

				$settings->form_title_font_typo['line_height'] = array(
					'length' => $settings->form_title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->form_title_line_height_unit );
			}
			if ( isset( $settings->form_title_line_height_unit_medium ) ) {
				$settings->form_title_font_typo_medium['line_height'] = array(
					'length' => $settings->form_title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->form_title_line_height_unit_medium );
			}
			if ( isset( $settings->form_title_line_height_unit_responsive ) ) {
				$settings->form_title_font_typo_responsive['line_height'] = array(
					'length' => $settings->form_title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->form_title_line_height_unit_responsive );
			}
			if ( isset( $settings->form_title_transform ) ) {

				$settings->form_title_font_typo['text_transform'] = $settings->form_title_transform;
				unset( $settings->form_title_transform );
			}
			if ( isset( $settings->form_title_letter_spacing ) ) {

				$settings->form_title_font_typo['letter_spacing'] = array(
					'length' => $settings->form_title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->form_title_letter_spacing );
			}
			// compatibility for Form description.
			if ( ! isset( $settings->form_desc_font_typo ) || ! is_array( $settings->form_desc_font_typo ) ) {

				$settings->form_desc_font_typo            = array();
				$settings->form_desc_font_typo_medium     = array();
				$settings->form_desc_font_typo_responsive = array();
			}
			if ( isset( $settings->form_desc_font_family ) ) {

				if ( isset( $settings->form_desc_font_family['family'] ) ) {

					$settings->form_desc_font_typo['font_family'] = $settings->form_desc_font_family['family'];
					unset( $settings->form_desc_font_family['family'] );
				}
				if ( isset( $settings->form_desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->form_desc_font_family['weight'] ) {
						$settings->form_desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_desc_font_typo['font_weight'] = $settings->form_desc_font_family['weight'];
					}
					unset( $settings->form_desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->form_desc_font_size_unit ) ) {

				$settings->form_desc_font_typo['font_size'] = array(
					'length' => $settings->form_desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->form_desc_font_size_unit );
			}
			if ( isset( $settings->form_desc_font_size_unit_medium ) ) {
				$settings->form_desc_font_typo_medium['font_size'] = array(
					'length' => $settings->form_desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->form_desc_font_size_unit_medium );
			}
			if ( isset( $settings->form_desc_font_size_unit_responsive ) ) {

				$settings->form_desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->form_desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->form_desc_font_size_unit_responsive );
			}
			if ( isset( $settings->form_desc_line_height_unit ) ) {

				$settings->form_desc_font_typo['line_height'] = array(
					'length' => $settings->form_desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->form_desc_line_height_unit );
			}
			if ( isset( $settings->form_desc_line_height_unit_medium ) ) {
				$settings->form_desc_font_typo_medium['line_height'] = array(
					'length' => $settings->form_desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->form_desc_line_height_unit_medium );
			}
			if ( isset( $settings->form_desc_line_height_unit_responsive ) ) {
				$settings->form_desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->form_desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->form_desc_line_height_unit_responsive );
			}
			if ( isset( $settings->form_desc_transform ) ) {

				$settings->form_desc_font_typo['text_transform'] = $settings->form_desc_transform;
				unset( $settings->form_desc_transform );
			}
			if ( isset( $settings->form_desc_letter_spacing ) ) {

				$settings->form_desc_font_typo['letter_spacing'] = array(
					'length' => $settings->form_desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->form_desc_letter_spacing );
			}
			// compatibility for Form labels.
			if ( ! isset( $settings->form_label_font_typo ) || ! is_array( $settings->form_label_font_typo ) ) {

				$settings->form_label_font_typo            = array();
				$settings->form_label_font_typo_medium     = array();
				$settings->form_label_font_typo_responsive = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {

					$settings->form_label_font_typo['font_family'] = $settings->label_font_family['family'];
				}
				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->form_label_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_label_font_typo['font_weight'] = $settings->label_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->label_font_size_unit ) ) {

				$settings->form_label_font_typo['font_size'] = array(
					'length' => $settings->label_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit );
			}
			if ( isset( $settings->label_font_size_unit_medium ) ) {
				$settings->form_label_font_typo_medium['font_size'] = array(
					'length' => $settings->label_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit_medium );
			}
			if ( isset( $settings->label_font_size_unit_responsive ) ) {
				$settings->form_label_font_typo_responsive['font_size'] = array(
					'length' => $settings->label_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit_responsive );
			}
			if ( isset( $settings->label_line_height_unit ) ) {

				$settings->form_label_font_typo['line_height'] = array(
					'length' => $settings->label_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit );
			}
			if ( isset( $settings->label_line_height_unit_medium ) ) {
				$settings->form_label_font_typo_medium['line_height'] = array(
					'length' => $settings->label_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit_medium );
			}
			if ( isset( $settings->label_line_height_unit_responsive ) ) {
				$settings->form_label_font_typo_responsive['line_height'] = array(
					'length' => $settings->label_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit_responsive );
			}
			if ( isset( $settings->label_transform ) ) {

				$settings->form_label_font_typo['text_transform'] = $settings->label_transform;
				unset( $settings->label_transform );
			}
			if ( isset( $settings->label_letter_spacing ) ) {

				$settings->form_label_font_typo['letter_spacing'] = array(
					'length' => $settings->label_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->label_letter_spacing );
			}
			// compatibility for Form input (not input description).
			if ( ! isset( $settings->form_input_typo ) || ! is_array( $settings->form_input_typo ) ) {

				$settings->form_input_typo            = array();
				$settings->form_input_typo_medium     = array();
				$settings->form_input_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->form_input_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->form_input_typo['font_weight'] = 'normal';
					} else {
						$settings->form_input_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->form_input_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->form_input_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {

				$settings->form_input_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			// compatibility for input description.
			if ( ! isset( $settings->form_input_desc_typo ) || ! is_array( $settings->form_input_desc_typo ) ) {

				$settings->form_input_desc_typo = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {

					$settings->form_input_desc_typo['font_family'] = $settings->label_font_family['family'];
					unset( $settings->label_font_family['family'] );
				}
				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->form_input_desc_typo['font_weight'] = 'normal';
					} else {
						$settings->form_input_desc_typo['font_weight'] = $settings->label_font_family['weight'];
					}
					unset( $settings->label_font_family['weight'] );
				}
			}
			if ( isset( $settings->input_desc_font_size ) ) {

				$settings->form_input_desc_typo['font_size'] = array(
					'length' => $settings->input_desc_font_size,
					'unit'   => 'px',
				);
				unset( $settings->input_desc_font_size );
			}
			if ( isset( $settings->input_desc_line_height ) ) {

				$settings->form_input_desc_typo['line_height'] = array(
					'length' => $settings->input_desc_line_height,
					'unit'   => 'px',
				);
				unset( $settings->input_desc_line_height );
			}
			if ( isset( $settings->input_desc_transform ) ) {

				$settings->form_input_desc_typo['text_transform'] = $settings->input_desc_transform;

				unset( $settings->input_desc_transform );
			}
			if ( isset( $settings->input_desc_letter_spacing ) ) {

				$settings->form_input_desc_typo['letter_spacing'] = array(
					'length' => $settings->input_desc_letter_spacing,
					'unit'   => 'px',
				);

				unset( $settings->input_desc_letter_spacing );
			}

			// compatibility for validation message description.
			if ( ! isset( $settings->form_valid_msg_desc_typo ) || ! is_array( $settings->form_valid_msg_desc_typo ) ) {

				$settings->form_valid_msg_desc_typo            = array();
				$settings->form_valid_msg_desc_typo_medium     = array();
				$settings->form_valid_msg_desc_typo_responsive = array();
			}
			if ( isset( $settings->validation_msg_font_size ) ) {

				$settings->form_valid_msg_desc_typo['font_size'] = array(
					'length' => $settings->validation_msg_font_size,
					'unit'   => 'px',
				);

				unset( $settings->validation_msg_font_size );
			}
			if ( isset( $settings->validate_transform ) ) {

				$settings->form_valid_msg_desc_typo['text_transform'] = $settings->validate_transform;

				unset( $settings->validate_transform );
			}
			if ( isset( $settings->validate_letter_spacing ) ) {

				$settings->form_valid_msg_desc_typo['letter_spacing'] = array(
					'length' => $settings->validate_letter_spacing,
					'unit'   => 'px',
				);

				unset( $settings->validate_letter_spacing );
			}

			// compatibility for Radio check-box.
			if ( ! isset( $settings->radio_input_typo ) || ! is_array( $settings->radio_input_typo ) ) {

				$settings->radio_input_typo            = array();
				$settings->radio_input_typo_medium     = array();
				$settings->radio_input_typo_responsive = array();
			}
			if ( isset( $settings->radio_checkbox_font_family ) ) {

				if ( isset( $settings->radio_checkbox_font_family['family'] ) ) {

					$settings->radio_input_typo['font_family'] = $settings->radio_checkbox_font_family['family'];
					unset( $settings->radio_checkbox_font_family['family'] );
				}
				if ( isset( $settings->radio_checkbox_font_family['weight'] ) ) {

					if ( 'regular' == $settings->radio_checkbox_font_family['weight'] ) {
						$settings->radio_input_typo['font_weight'] = 'normal';
					} else {
						$settings->radio_input_typo['font_weight'] = $settings->radio_checkbox_font_family['weight'];
					}
					unset( $settings->radio_checkbox_font_family['weight'] );
				}
			}
			if ( isset( $settings->radio_checkbox_font_size_unit ) ) {

				$settings->radio_input_typo['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->radio_checkbox_font_size_unit );
			}
			if ( isset( $settings->radio_checkbox_font_size_unit_medium ) ) {
				$settings->radio_input_typo_medium['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->radio_checkbox_font_size_unit_medium );
			}
			if ( isset( $settings->radio_checkbox_font_size_unit_responsive ) ) {

				$settings->radio_input_typo_responsive['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->radio_checkbox_font_size_unit_responsive );
			}
			if ( isset( $settings->radio_checkbox_transform ) ) {

				$settings->radio_input_typo['text_transform'] = $settings->radio_checkbox_transform;
				unset( $settings->radio_checkbox_transform );
			}
			if ( isset( $settings->radio_checkbox_letter_spacing ) ) {

				$settings->radio_input_typo['letter_spacing'] = array(
					'length' => $settings->radio_checkbox_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->radio_checkbox_letter_spacing );
			}
			// compatibility for Form button.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
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
			if ( isset( $settings->btn_text_transform ) ) {
				$settings->button_font_typo['text_transform'] = $settings->btn_text_transform;
				unset( $settings->btn_text_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->button_font_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {
			// Handle color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_background_hover_color_opc', 'btn_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_background_color_opc', 'btn_background_color' );
			$helper->handle_opacity_inputs( $settings, 'form_bg_color_opc', 'form_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'validation_bg_color_opc', 'validation_bg_color' );

			// compatibility for validation message description.
			if ( ! isset( $settings->form_valid_msg_desc_typo ) || ! is_array( $settings->form_valid_msg_desc_typo ) ) {

				$settings->form_valid_msg_desc_typo            = array();
				$settings->form_valid_msg_desc_typo_medium     = array();
				$settings->form_valid_msg_desc_typo_responsive = array();
			}
			if ( isset( $settings->validation_msg_font_size ) ) {

				$settings->form_valid_msg_desc_typo['font_size'] = array(
					'length' => $settings->validation_msg_font_size,
					'unit'   => 'px',
				);
				unset( $settings->validation_msg_font_size );
			}

			// Handle old check-box border settings.
			if ( isset( $settings->validation_border_color ) ) {

					$settings->validation_border = array();

				// Border style, color, and width.
				$settings->validation_border['color'] = $settings->validation_border_color;
				unset( $settings->validation_border_color );
				if ( isset( $settings->validation_border_type ) ) {
					$settings->validation_border['style'] = $settings->validation_border_type;
					unset( $settings->validation_border_type );
				}
				if ( isset( $settings->validation_border_width ) ) {
					if ( empty( $settings->validation_border_width ) ) {
						$settings->validation_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->validation_border['width'] = array(
							'top'    => $settings->validation_border_width,
							'right'  => $settings->validation_border_width,
							'bottom' => $settings->validation_border_width,
							'left'   => $settings->validation_border_width,
						);
						unset( $settings->validation_border_width );
					}
				}
				// Border radius.
				if ( isset( $settings->validation_border_radius ) ) {
					$settings->validation_border['radius'] = array(
						'top_left'     => $settings->validation_border_radius,
						'top_right'    => $settings->validation_border_radius,
						'bottom_left'  => $settings->validation_border_radius,
						'bottom_right' => $settings->validation_border_radius,
					);
					unset( $settings->validation_border_radius );
				}
			}

			// Old button typo settings.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
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
			if ( isset( $settings->btn_text_transform ) ) {
				$settings->button_font_typo['text_transform'] = $settings->btn_text_transform;
				unset( $settings->btn_text_transform );
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				unset( $settings->btn_font_size['desktop'] );
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				unset( $settings->btn_font_size['medium'] );
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				unset( $settings->btn_font_size['small'] );
			}
			if ( isset( $settings->btn_line_height['desktop'] ) ) {
				unset( $settings->btn_line_height['desktop'] );
			}
			if ( isset( $settings->btn_line_height['medium'] ) ) {
				unset( $settings->btn_line_height['medium'] );
			}
			if ( isset( $settings->btn_line_height['small'] ) ) {
				unset( $settings->btn_line_height['small'] );
			}
			// Form title typo settings.
			if ( ! isset( $settings->form_title_font_typo ) || ! is_array( $settings->form_title_font_typo ) ) {

				$settings->form_title_font_typo            = array();
				$settings->form_title_font_typo_medium     = array();
				$settings->form_title_font_typo_responsive = array();
			}
			if ( isset( $settings->form_title_font_family ) ) {

				if ( isset( $settings->form_title_font_family['family'] ) ) {

					$settings->form_title_font_typo['font_family'] = $settings->form_title_font_family['family'];
					unset( $settings->form_title_font_family['family'] );
				}
				if ( isset( $settings->form_title_font_family['weight'] ) ) {

					if ( 'regular' == $settings->form_title_font_family['weight'] ) {
						$settings->form_title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_title_font_typo['font_weight'] = $settings->form_title_font_family['weight'];
					}
					unset( $settings->form_title_font_family['weight'] );
				}
			}
			if ( isset( $settings->form_title_font_size['desktop'] ) && ! isset( $settings->form_title_font_typo['font_size'] ) ) {
				$settings->form_title_font_typo['font_size'] = array(
					'length' => $settings->form_title_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_title_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->form_title_font_typo_medium['font_size'] = array(
					'length' => $settings->form_title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_title_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->form_title_font_typo_responsive['font_size'] = array(
					'length' => $settings->form_title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_title_line_height['desktop'] ) && isset( $settings->form_title_font_size['desktop'] ) && 0 != $settings->form_title_font_size['desktop'] && ! isset( $settings->form_title_line_height_unit ) ) {
				if ( is_numeric( $settings->form_title_line_height['desktop'] ) && is_numeric( $settings->form_title_font_size['desktop'] ) ) {
					$settings->form_title_font_typo['line_height'] = array(
						'length' => round( $settings->form_title_line_height['desktop'] / $settings->form_title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_title_line_height['medium'] ) && isset( $settings->form_title_font_size['medium'] ) && 0 != $settings->form_title_font_size['medium'] && ! isset( $settings->form_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_title_line_height['medium'] ) && is_numeric( $settings->form_title_font_size['medium'] ) ) {
					$settings->form_title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->form_title_line_height['medium'] / $settings->form_title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_title_line_height['small'] ) && isset( $settings->form_title_font_size['small'] ) && 0 != $settings->form_title_font_size['small'] && ! isset( $settings->form_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_title_line_height['small'] ) && is_numeric( $settings->form_title_font_size['small'] ) ) {
					$settings->form_title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->form_title_line_height['small'] / $settings->form_title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_title_font_size['desktop'] ) ) {
				unset( $settings->form_title_font_size['desktop'] );
			}
			if ( isset( $settings->form_title_font_size['medium'] ) ) {
				unset( $settings->form_title_font_size['medium'] );
			}
			if ( isset( $settings->form_title_font_size['small'] ) ) {
				unset( $settings->form_title_font_size['small'] );
			}
			if ( isset( $settings->form_title_line_height['desktop'] ) ) {
				unset( $settings->form_title_line_height['desktop'] );
			}
			if ( isset( $settings->form_title_line_height['medium'] ) ) {
				unset( $settings->form_title_line_height['medium'] );
			}
			if ( isset( $settings->form_title_line_height['small'] ) ) {
				unset( $settings->form_title_line_height['small'] );
			}
			// Form description typo settings.
			if ( ! isset( $settings->form_desc_font_typo ) || ! is_array( $settings->form_desc_font_typo ) ) {

				$settings->form_desc_font_typo            = array();
				$settings->form_desc_font_typo_medium     = array();
				$settings->form_desc_font_typo_responsive = array();
			}
			if ( isset( $settings->form_desc_font_family ) ) {

				if ( isset( $settings->form_desc_font_family['family'] ) ) {

					$settings->form_desc_font_typo['font_family'] = $settings->form_desc_font_family['family'];
					unset( $settings->form_desc_font_family['family'] );
				}
				if ( isset( $settings->form_desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->form_desc_font_family['weight'] ) {
						$settings->form_desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_desc_font_typo['font_weight'] = $settings->form_desc_font_family['weight'];
					}
					unset( $settings->form_desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->form_desc_font_size['desktop'] ) && ! isset( $settings->form_desc_font_typo['font_size'] ) ) {
				$settings->form_desc_font_typo['font_size'] = array(
					'length' => $settings->form_desc_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_desc_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->form_desc_font_typo_medium['font_size'] = array(
					'length' => $settings->form_desc_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_desc_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->form_desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->form_desc_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->form_desc_line_height['desktop'] ) && isset( $settings->form_desc_font_size['desktop'] ) && 0 != $settings->form_desc_font_size['desktop'] && ! isset( $settings->form_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->form_desc_line_height['desktop'] ) && is_numeric( $settings->form_desc_font_size['desktop'] ) ) {
					$settings->form_desc_font_typo['line_height'] = array(
						'length' => round( $settings->form_desc_line_height['desktop'] / $settings->form_desc_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_desc_line_height['medium'] ) && isset( $settings->form_desc_font_size['medium'] ) && 0 != $settings->form_desc_font_size['medium'] && ! isset( $settings->form_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_desc_line_height['medium'] ) && is_numeric( $settings->form_desc_font_size['medium'] ) ) {
					$settings->form_desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->form_desc_line_height['medium'] / $settings->form_desc_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_desc_line_height['small'] ) && isset( $settings->form_desc_font_size['small'] ) && 0 != $settings->form_desc_font_size['small'] && ! isset( $settings->form_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_desc_line_height['small'] ) && is_numeric( $settings->form_desc_font_size['small'] ) ) {
					$settings->form_desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->form_desc_line_height['small'] / $settings->form_desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_desc_font_size['desktop'] ) ) {
				unset( $settings->form_desc_font_size['desktop'] );
			}
			if ( isset( $settings->form_desc_font_size['medium'] ) ) {
				unset( $settings->form_desc_font_size['medium'] );
			}
			if ( isset( $settings->form_desc_font_size['small'] ) ) {
				unset( $settings->form_desc_font_size['small'] );
			}
			if ( isset( $settings->form_desc_line_height['desktop'] ) ) {
				unset( $settings->form_desc_line_height['desktop'] );
			}
			if ( isset( $settings->form_desc_line_height['medium'] ) ) {
				unset( $settings->form_desc_line_height['medium'] );
			}
			if ( isset( $settings->form_desc_line_height['small'] ) ) {
				unset( $settings->form_desc_line_height['small'] );
			}
			// Form label typo settings.
			if ( ! isset( $settings->form_label_font_typo ) || ! is_array( $settings->form_label_font_typo ) ) {

				$settings->form_label_font_typo            = array();
				$settings->form_label_font_typo_medium     = array();
				$settings->form_label_font_typo_responsive = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {

					$settings->form_label_font_typo['font_family'] = $settings->label_font_family['family'];
				}
				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->form_label_font_typo['font_weight'] = 'normal';
					} else {
						$settings->form_label_font_typo['font_weight'] = $settings->label_font_family['weight'];
					}
				}
			}
			if ( isset( $settings->label_font_size['desktop'] ) && ! isset( $settings->form_label_font_typo['font_size'] ) ) {
				$settings->form_label_font_typo['font_size'] = array(
					'length' => $settings->label_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->form_label_font_typo_medium['font_size'] = array(
					'length' => $settings->label_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->form_label_font_typo_responsive['font_size'] = array(
					'length' => $settings->label_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_line_height['desktop'] ) && isset( $settings->label_font_size['desktop'] ) && 0 != $settings->label_font_size['desktop'] && ! isset( $settings->label_line_height_unit ) ) {
				if ( is_numeric( $settings->label_line_height['desktop'] ) && is_numeric( $settings->label_font_size['desktop'] ) ) {
					$settings->form_label_font_typo['line_height'] = array(
						'length' => round( $settings->label_line_height['desktop'] / $settings->label_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->label_line_height['medium'] ) && isset( $settings->label_font_size['medium'] ) && 0 != $settings->label_font_size['medium'] && ! isset( $settings->label_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->label_line_height['medium'] ) && is_numeric( $settings->label_font_size['medium'] ) ) {
					$settings->form_label_font_typo_medium['line_height'] = array(
						'length' => round( $settings->label_line_height['medium'] / $settings->label_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->label_line_height['small'] ) && isset( $settings->label_font_size['small'] ) && 0 != $settings->label_font_size['small'] && ! isset( $settings->label_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->label_line_height['small'] ) && is_numeric( $settings->label_font_size['small'] ) ) {
					$settings->form_label_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->label_line_height['small'] / $settings->label_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->label_font_size['desktop'] ) ) {
				unset( $settings->label_font_size['desktop'] );
			}
			if ( isset( $settings->label_font_size['medium'] ) ) {
				unset( $settings->label_font_size['medium'] );
			}
			if ( isset( $settings->label_font_size['small'] ) ) {
				unset( $settings->label_font_size['small'] );
			}
			if ( isset( $settings->label_line_height['desktop'] ) ) {
				unset( $settings->label_line_height['desktop'] );
			}
			if ( isset( $settings->label_line_height['medium'] ) ) {
				unset( $settings->label_line_height['medium'] );
			}
			if ( isset( $settings->label_line_height['small'] ) ) {
				unset( $settings->label_line_height['small'] );
			}
			// Form inputs typo settings.
			if ( ! isset( $settings->form_input_typo ) || ! is_array( $settings->form_input_typo ) ) {

				$settings->form_input_typo            = array();
				$settings->form_input_typo_medium     = array();
				$settings->form_input_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->form_input_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->form_input_typo['font_weight'] = 'normal';
					} else {
						$settings->form_input_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->form_input_typo['font_size'] ) ) {
				$settings->form_input_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->form_input_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->form_input_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
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
			// Form radio check-box typo settings.
			if ( ! isset( $settings->radio_input_typo ) || ! is_array( $settings->radio_input_typo ) ) {

				$settings->radio_input_typo            = array();
				$settings->radio_input_typo_medium     = array();
				$settings->radio_input_typo_responsive = array();
			}
			if ( isset( $settings->radio_checkbox_font_family ) ) {

				if ( isset( $settings->radio_checkbox_font_family['family'] ) ) {

					$settings->radio_input_typo['font_family'] = $settings->radio_checkbox_font_family['family'];
					unset( $settings->radio_checkbox_font_family['family'] );
				}
				if ( isset( $settings->radio_checkbox_font_family['weight'] ) ) {

					if ( 'regular' == $settings->radio_checkbox_font_family['weight'] ) {
						$settings->radio_input_typo['font_weight'] = 'normal';
					} else {
						$settings->radio_input_typo['font_weight'] = $settings->radio_checkbox_font_family['weight'];
					}
					unset( $settings->radio_checkbox_font_family['weight'] );
				}
			}
			if ( isset( $settings->radio_checkbox_font_size['desktop'] ) && ! isset( $settings->radio_input_typo['font_size'] ) ) {
				$settings->radio_input_typo['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->radio_checkbox_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->radio_input_typo_medium['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->radio_checkbox_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->radio_input_typo_responsive['font_size'] = array(
					'length' => $settings->radio_checkbox_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->radio_checkbox_font_size['desktop'] ) ) {
				unset( $settings->radio_checkbox_font_size['desktop'] );
			}
			if ( isset( $settings->radio_checkbox_font_size['medium'] ) ) {
				unset( $settings->radio_checkbox_font_size['medium'] );
			}
			if ( isset( $settings->radio_checkbox_font_size['small'] ) ) {
				unset( $settings->radio_checkbox_font_size['small'] );
			}
			// compatibility for input description.
			if ( ! isset( $settings->form_input_desc_typo ) || ! is_array( $settings->form_input_desc_typo ) ) {

				$settings->form_input_desc_typo = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {

					$settings->form_input_desc_typo['font_family'] = $settings->label_font_family['family'];
					unset( $settings->label_font_family['family'] );
				}
				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->form_input_desc_typo['font_weight'] = 'normal';
					} else {
						$settings->form_input_desc_typo['font_weight'] = $settings->label_font_family['weight'];
					}
					unset( $settings->label_font_family['weight'] );
				}
			}
			if ( isset( $settings->input_desc_font_size ) ) {

				$settings->form_input_desc_typo['font_size'] = array(
					'length' => $settings->input_desc_font_size,
					'unit'   => 'px',
				);
				unset( $settings->input_desc_font_size );
			}
			if ( isset( $settings->input_desc_line_height ) ) {

				$settings->form_input_desc_typo['line_height'] = array(
					'length' => $settings->input_desc_line_height,
					'unit'   => 'px',
				);
				unset( $settings->input_desc_line_height );
			}
			// Handle dimension fields.
			if ( isset( $settings->form_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->form_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->form_spacing_dimension_top    = '';
				$settings->form_spacing_dimension_bottom = '';
				$settings->form_spacing_dimension_left   = '';
				$settings->form_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->form_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->form_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->form_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->form_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->form_spacing );
			}

			if ( isset( $settings->input_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_padding_dimension_top    = '';
				$settings->input_padding_dimension_bottom = '';
				$settings->input_padding_dimension_left   = '';
				$settings->input_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->input_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->input_padding );
			}
			// Border style, color, and width.
			if ( isset( $settings->input_border_color ) ) {
				$settings->input_border = array();

				$settings->input_border['style'] = 'solid';
				$settings->input_border['color'] = $settings->input_border_color;
				unset( $settings->input_border_color );
				if ( isset( $settings->input_border_width ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->input_border_width );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

					$input_border_width_dimension_top    = '';
					$input_border_width_dimension_bottom = '';
					$input_border_width_dimension_left   = '';
					$input_border_width_dimension_right  = '';

					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}
					for ( $i = 0; $i < count( $output ); $i++ ) {
						switch ( $output[ $i ][0] ) {
							case 'padding-top':
								$input_border_width_dimension_top = (int) $output[ $i ][1];
								break;
							case 'padding-bottom':
								$input_border_width_dimension_bottom = (int) $output[ $i ][1];
								break;
							case 'padding-right':
								$input_border_width_dimension_right = (int) $output[ $i ][1];
								break;
							case 'padding-left':
								$input_border_width_dimension_left = (int) $output[ $i ][1];
								break;
							case 'padding':
								$input_border_width_dimension_top    = (int) $output[ $i ][1];
								$input_border_width_dimension_bottom = (int) $output[ $i ][1];
								$input_border_width_dimension_left   = (int) $output[ $i ][1];
								$input_border_width_dimension_right  = (int) $output[ $i ][1];
								break;
						}
					}
				}
				if ( isset( $input_border_width_dimension_top ) && isset( $input_border_width_dimension_right ) && isset( $input_border_width_dimension_bottom ) && isset( $input_border_width_dimension_left ) ) {
					if ( empty( $input_border_width_dimension_top ) && empty( $input_border_width_dimension_right ) && empty( $input_border_width_dimension_bottom ) && empty( $input_border_width_dimension_left ) ) {
						$settings->input_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->input_border['width'] = array(
							'top'    => $input_border_width_dimension_top,
							'right'  => $input_border_width_dimension_right,
							'bottom' => $input_border_width_dimension_bottom,
							'left'   => $input_border_width_dimension_left,
						);
						unset( $input_border_width_dimension_top );
						unset( $input_border_width_dimension_right );
						unset( $input_border_width_dimension_bottom );
						unset( $input_border_width_dimension_left );

					}
				}
				if ( isset( $settings->input_border_radius ) ) {
					$settings->input_border['radius'] = array(
						'top_left'     => $settings->input_border_radius,
						'top_right'    => $settings->input_border_radius,
						'bottom_left'  => $settings->input_border_radius,
						'bottom_right' => $settings->input_border_radius,
					);
					unset( $settings->input_border_radius );
				}
			}
			if ( isset( $settings->validation_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->validation_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->validation_spacing_dimension_top    = '';
				$settings->validation_spacing_dimension_bottom = '';
				$settings->validation_spacing_dimension_left   = '';
				$settings->validation_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->validation_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->validation_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->validation_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->validation_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->validation_spacing );
			}
		}
		return $settings;
	}

	/**
	 * Function that renders settings field for the module
	 *
	 * @param string $field gets an string.
	 * @param string $name gets an string.
	 * @param object $settings gets the settings for the module.
	 */
	function uabb_gravity_form_render_settings_field( $field, $name, $settings ) {

		if ( isset( $settings->form_tab_index_option ) && $settings->form_tab_index_option > '1' ) {
			$settings->mul_form_option = 'true';
		}
		return $field;
	}
}

require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-gravity-form/includes/gf-function.php';

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-gravity-form/uabb-gravity-form-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-gravity-form/uabb-gravity-form-bb-less-than-2-2-compatibility.php';
}
