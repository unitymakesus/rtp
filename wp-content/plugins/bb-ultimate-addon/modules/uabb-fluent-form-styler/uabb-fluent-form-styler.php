<?php
/**
 * UABB WP Fluent Forms Styler File.
 *
 * @package UABB WP Fluent Forms Styler module.
 */

/**
 * Function that initializes UABB WP Fluent Forms Styler Module
 *
 * @class UABBFluentFormsStyler
 */
class UABBFluentFormsStyler extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'WP Fluent Forms Styler', 'uabb' ),
				'description'     => __( 'WP Fluent Forms Styler to style your WP Fluent Forms', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-fluent-form-styler/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-fluent-form-styler/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);
	}

	/**
	 * Get all forms of WP Fluent Forms plugin.
	 */
	public static function uabb_get_fluent_forms() {
		$options = array();

		if ( function_exists( 'wpFluentForm' ) ) {
			global $wpdb;
			$result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}fluentform_forms" );
			if ( $result ) {
				$options[0] = esc_html__( 'Select a form', 'uabb' );
				foreach ( $result as $form ) {
					$options[ $form->id ] = $form->title;
				}
			} else {
				$options[0] = esc_html__( 'No forms found!', 'uabb' );
			}
		}

		return $options;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBFluentFormsStyler',
	array(
		'form'           => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'select_form'          => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'select_form_field' => array(
							'type'    => 'select',
							'label'   => __( 'Select Form', 'uabb' ),
							'default' => '',
							'options' => UABBFluentFormsStyler::uabb_get_fluent_forms(),
						),
					),
				),
				'form_general_setting' => array(
					'title'  => __( 'Settings', 'uabb' ),
					'fields' => array(
						'custom_title'       => array(
							'type'        => 'text',
							'label'       => __( 'Custom Title', 'uabb' ),
							'default'     => '',
							'description' => '',
							'connections' => array( 'string' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-ff-form-title',
							),
						),
						'custom_description' => array(
							'type'        => 'textarea',
							'label'       => __( 'Custom Description', 'uabb' ),
							'default'     => '',
							'placeholder' => '',
							'rows'        => '6',
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-ff-form-description',
							),
						),
					),
				),
			),
		),
		'style'          => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'form_style'            => array( // Section.
					'title'  => 'Form', // Section Title.
					'fields' => array( // Section Fields.
						'form_bg_type'           => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'form_bg_color' ),
								),
								'gradient' => array(
									'fields' => array( 'form_bg_gradient' ),
								),
							),
						),
						'form_bg_gradient'       => array(
							'type'  => 'gradient',
							'label' => __( 'Gradient', 'uabb' ),
						),
						'form_bg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'form_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Form Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'ff_title_desc_align'    => array(
							'type'       => 'align',
							'label'      => __( 'Title & Description Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-fluent-form-content .uabb-ff-form-title',
										'property' => 'text-align',
									),
									array(
										'selector' => '.uabb-fluent-form-content .uabb-ff-form-description',
										'property' => 'text-align',
									),
								),
							),
						),
					),
				),
				'form_fields_style'     => array( // Section.
					'title'     => 'Form Fields', // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'field_padding'              => array(
							'type'       => 'dimension',
							'label'      => __( 'Field Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff-el-form-control',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_field_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Field Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff-el-form-control, .uabb-fluent-form-content .ff_net_table tbody tr td label ',
								'property'  => 'color',
								'important' => true,
							),
						),
						'field_bg_color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Field Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff-el-form-control',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'input_placeholder_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Placeholder Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff-el-form-control::-webkit-input-placeholder',
								'property'  => 'color',
								'important' => true,
							),
						),
						'label_color'                => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Label Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .ff-el-input--label label, .uabb-fluent-form-content .fluentform .ff-el-form-check-label',
								'property'  => 'color',
								'important' => true,
							),
						),
						'required_asterisk_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Required Asterisk Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .ff-el-input--label.ff-el-is-required.asterisk-right label:after',
								'property'  => 'color',
								'important' => true,
							),
						),
						'form_fields_border'         => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff-el-form-control',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'fields_border_active_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Active Color', 'uabb' ),
							'default'     => 'bbbbbb',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'field_active_bg_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Active Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'form_fields_spacing'        => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing Between Two Fields', 'uabb' ),
							'placeholder' => '0',
							'slider'      => true,
							'responsive'  => true,
							'units'       => array( 'px' ),
						),
						'label_bottom_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Label Bottom Spacing', 'uabb' ),
							'placeholder' => '0',
							'slider'      => true,
							'responsive'  => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'section_field_setting' => array( // Section.
					'title'     => __( 'Section Field', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'section_field_bg_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'transparent',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
								'property' => 'background-color',
							),
						),
						'section_title_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Title Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break .ff-el-section-title',
								'property' => 'color',
							),
						),
						'section_description_color' => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
								'property' => 'color',
							),
						),
						'section_field_border'      => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
								'property' => 'border',
							),
						),
						'section_field_margin'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Margin', 'uabb' ),
							'default'    => '0',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
						'section_field_padding'     => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '0',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'radio_cb_style'        => array(
					'title'     => __( 'Radio & Checkbox', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'override_checkbox_radio_style' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Custom Style', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'radio_cb_size', 'radio_cb_color', 'radio_cb_checked_color', 'radio_cb_border_width', 'radio_cb_border_color', 'radio_cb_radius', 'radio_cb_checkbox_radius', 'check_radio_items_spacing', 'radio_checkbox_color' ),
									'sections' => array( 'radio_checkbox_typography' ),
								),
							),
						),
						'radio_cb_size'                 => array(
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'default' => '15',
							'slider'  => true,
							'units'   => array( 'px' ),
							'class'   => '.uabb-fluent-form-content .fluentform input[type=checkbox], .uabb-fluent-form-content .fluentform input[type=radio]',
						),
						'radio_cb_color'                => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'dddddd',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform input[type=checkbox], .uabb-fluent-form-content .fluentform input[type=radio]',
								'property' => 'backgroun-color',
								'unit'     => 'px',
							),
						),
						'radio_cb_checked_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Checked Color', 'uabb' ),
							'default'     => '999999',
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
						'radio_checkbox_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Label Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform .ff-el-form-check-label',
								'property' => 'color',
							),
						),
						'radio_cb_border_width'         => array(
							'type'    => 'unit',
							'label'   => __( 'Border Width', 'uabb' ),
							'default' => '1',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform input[type=checkbox], .uabb-fluent-form-content .fluentform input[type=radio]',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'radio_cb_border_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform input[type=checkbox], .uabb-fluent-form-content .fluentform input[type=radio]',
								'property' => 'border-color',
								'unit'     => 'px',
							),
						),
						'check_radio_items_spacing'     => array(
							'type'    => 'unit',
							'label'   => __( 'Radio & Checkbox Items Spacing', 'uabb' ),
							'default' => '10',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'radio_cb_radius'               => array(
							'type'    => 'unit',
							'label'   => __( 'Radio Round Corners', 'uabb' ),
							'default' => '50',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'radio_cb_checkbox_radius'      => array(
							'type'    => 'unit',
							'label'   => __( 'Checkbox Round Corners', 'uabb' ),
							'default' => '0',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
					),
				),
				'star_rating_style'     => array( // Section.
					'title'     => 'Star Rating', // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'star_inactive_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Inactive Star Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-ratings.jss-ff-el-ratings svg',
								'property' => 'fill',
							),
						),
						'star_icon_selected_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Selected Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-ratings.jss-ff-el-ratings label.active svg',
								'property' => 'fill',
							),
						),
					),
				),
			),
		),
		'button_style'   => array(
			'title'    => __( 'Button', 'uabb' ),
			'sections' => array(
				'btn-structure'          => array(
					'title'  => __( 'Submit Button Structure', 'uabb' ),
					'fields' => array(
						'btn_width'         => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'button_align' ),
								),
								'custom' => array(
									'fields' => array( 'btn_custom_width', 'btn_custom_height', 'button_align' ),
								),
							),
						),
						'btn_custom_width'  => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Width', 'uabb' ),
							'default' => '200',
							'slider'  => true,
							'units'   => array( 'px' ),
							'slider'  => array(
								'step' => 10,
								'max'  => 1000,
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'btn_custom_height' => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Height', 'uabb' ),
							'default' => '45',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'button_align'      => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
						),
					),
				),
				'submit_button_style'    => array( // Section.
					'title'     => 'Submit Button', // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'button_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_bg_type'            => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'options' => array(
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'button_bg_color', 'button_bg_hover_color' ),
								),
								'gradient' => array(
									'fields' => array( 'button_bg_gradient' ),
								),
							),
						),
						'button_bg_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'button_bg_gradient'        => array(
							'type'  => 'gradient',
							'label' => __( 'Background Gradient', 'uabb' ),
						),
						'button_bg_hover_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_text_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property'  => 'color',
								'important' => true,
							),
						),
						'btn_text_hover_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'button_border'             => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => 'bbbbbb',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'btn_margin_top'            => array(
							'type'       => 'unit',
							'label'      => __( 'Margin Top', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button',
								'unit'     => 'px',
							),
						),
					),
				),
				'secondary_button_style' => array( // Section.
					'title'     => 'Secondary Buttons', // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'sec_button_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform span.ff_upload_btn.ff-btn, .uabb-fluent-form-content .fluentform button.ff-btn.ff-btn-secondary',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'sec_button_bg_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform span.ff_upload_btn.ff-btn, .uabb-fluent-form-content .fluentform button.ff-btn.ff-btn-secondary',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'sec_button_bg_hover_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'sec_btn_text_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform span.ff_upload_btn.ff-btn, .uabb-fluent-form-content .fluentform button.ff-btn.ff-btn-secondary',
								'property'  => 'color',
								'important' => true,
							),
						),
						'sec_btn_text_hover_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'sec_button_border'             => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform span.ff_upload_btn.ff-btn, .uabb-fluent-form-content .fluentform button.ff-btn.ff-btn-secondary',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'sec_button_border_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => 'bbbbbb',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
						),
					),
				),
			),
		),
		'Messages_style' => array(
			'title'    => __( 'Messages', 'uabb' ),
			'sections' => array(
				'form_error_styling'   => array( // Section.
					'title'  => __( 'Errors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'error_msg_sapcing'              => array(
							'type'       => 'unit',
							'label'      => __( 'Top Margin', 'uabb' ),
							'default'    => '',
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
						),
						'error_message_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-is-error .error',
								'property' => 'color',
							),
						),
						'error_input_field_border_color' => array(
							'type'        => 'color',
							'label'       => __( 'Input Field Border Color', 'uabb' ),
							'default'     => '1',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-is-error .ff-el-form-control',
								'property' => 'color',
							),
						),
						'error_input_field_border_width' => array(
							'type'    => 'unit',
							'label'   => __( 'Input Field Border Width', 'uabb' ),
							'default' => '1',
							'slider'  => true,
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-is-error .ff-el-form-control',
								'property' => 'border-width',
							),
						),
					),
				),
				'form_success_styling' => array( // Section.
					'title'  => __( 'Success Message', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'success_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-message-success',
								'property' => 'background-color',
							),
						),
						'success_msg_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-message-success',
								'property' => 'color',
							),
						),
						'success_message_border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-message-success',
								'property' => 'border',
							),
						),
					),
				),
			),
		),
		'typography'     => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'form_title_typography'        => array(
					'title'     => __( 'Form Title', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'title_tag_selection'      => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1'  => __( 'H1', 'uabb' ),
								'h2'  => __( 'H2', 'uabb' ),
								'h3'  => __( 'H3', 'uabb' ),
								'h4'  => __( 'H4', 'uabb' ),
								'h5'  => __( 'H5', 'uabb' ),
								'h6'  => __( 'H6', 'uabb' ),
								'div' => __( 'Div', 'uabb' ),
								'p'   => __( 'p', 'uabb' ),
							),
						),
						'form_title_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-title',
							),
						),
						'form_title_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-title',
								'property' => 'color',
							),
						),
						'form_title_bottom_margin' => array(
							'type'       => 'unit',
							'label'      => __( 'Bottom Margin', 'uabb' ),
							'default'    => '',
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'form_desc_typography'         => array(
					'title'     => __( 'Form Description', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'form_desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-description',
							),
						),
						'form_desc_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-description',
								'property' => 'color',
							),
						),
						'form_desc_bottom_margin' => array(
							'type'       => 'unit',
							'label'      => __( 'Bottom Margin', 'uabb' ),
							'default'    => '20',
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .uabb-ff-form-description',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'field_labels_typography'      => array( // Section.
					'title'     => __( 'Field Label', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'field_label_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .ff-el-input--label label',
								'important' => true,
							),
						),
					),
				),
				'input_placeholder_typography' => array( // Section.
					'title'     => __( 'Input Text / Placeholder', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'input_placeholder_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'uabb-fluent-form-content .fluentform .ff-el-form-control, .uabb-fluent-form-content table.ff-table.ff-checkable-grids.ff_flexible_table',
								'important' => true,
							),
						),
					),
				),
				'radio_checkbox_typography'    => array(
					'title'     => __( 'Radio Button and CheckBox', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'form_radio_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .fluentform .ff-el-form-check-label',
							),
						),
					),
				),
				'section_field_typography'     => array( // Section.
					'title'     => __( 'Section Field', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array(
						'section_title_typography'       => array(
							'type'       => 'typography',
							'label'      => __( 'Title Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break .ff-el-section-title',
							),
						),
						'section_description_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Description Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-fluent-form-content .ff-el-section-break',
							),
						),
					),
				),
				'button_typography'            => array( // Section.
					'title'     => __( 'Buttons', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fluent-form-content .fluentform .ff_submit_btn_wrapper button, .uabb-fluent-form-content .fluentform span.ff_upload_btn.ff-btn, .uabb-fluent-form-content .fluentform button.ff-btn.ff-btn-secondary',
								'important' => true,
							),
						),
					),
				),
				'error_msg_typo'               => array( // Section.
					'title'     => __( 'Error Message', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'error_msg_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .has-error .caldera_ajax_error_block span',
								'important' => true,
							),
						),
					),
				),
				'success_msg_typo'             => array( // Section.
					'title'     => __( 'Success Message', 'uabb' ), // Section Title.
					'collapsed' => true,
					'fields'    => array( // Section Fields.
						'success_msg_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid .alert-success',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'      => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="http://ultimatebeaver.com/docs/fluent-forms-styler/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=fluent-form-styler" target="_blank" rel="noopener"> Getting Started Article </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
