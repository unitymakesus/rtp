<?php
/**
 * UABB Caldera Forms Styler File.
 *
 * @package UABB UABB Caldera Forms Styler module.
 */

/**
 * Function that initializes UABB Caldera Forms Styler Module
 *
 * @class UABBCalderaFormsStyler
 */
class UABBCalderaFormsStyler extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Caldera Forms Styler', 'uabb' ),
				'description'     => __( 'Caldera Forms Styler Module', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-caldera-form-styler/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-caldera-form-styler/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);
	}

}

$notice = '';
if ( ! UABB_Compatibility::$version_bb_check ) {
	$style  = 'line-height: 1.45em; color: #a94442;';
	$notice = sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
		__( '<span style="%1$s">This module is not compatible with Beaver Builder version less than 2.2. To use the module, please install Beaver Builder version 2.2 or greater.</span>', 'uabb' ),
		$style
	);
}

/*
 * Register the module and its form settings.
 *
 */
FLBuilder::register_module(
	'UABBCalderaFormsStyler',
	array(
		'general'    => array( // Tab.
			'title'       => __( 'General', 'uabb' ), // Tab title.
			'description' => $notice,
			'sections'    => array( // Tab Sections.
				'select_form'  => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'caf_form_id'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Form', 'uabb' ),
							'options' => array(),
							'help'    => __( 'Choose a form that you wish to style', 'uabb' ),
						),
						'caf_form_raw' => array(
							'type'    => 'raw',
							'content' => '<div class="uabb-module-raw" data-uabb-module-nonce=' . wp_create_nonce( 'uabb-caf-nonce' ) . '></div>',
						),
					),
				),
				'form_section' => array(
					'title'  => __( 'Settings', 'uabb' ),
					'fields' => array(
						'caf_custom_desc' => array(
							'type'    => 'select',
							'label'   => __( 'Add Title & Description', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'caf_form_title', 'caf_form_desc', 'caf_title_desc_align' ),
									'sections' => array( 'form_title_typography', 'form_desc_typography' ),
								),
							),
						),
						'caf_form_title'  => array(
							'type'        => 'text',
							'label'       => __( 'Form Title', 'uabb' ),
							'placeholder' => __( 'Enter the Form Title here ...', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-caf-form-title',
							),
						),
						'caf_form_desc'   => array(
							'type'        => 'textarea',
							'label'       => __( 'Form Description', 'uabb' ),
							'placeholder' => __( 'Enter the Description here ...', 'uabb' ),
							'rows'        => '5',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-caf-form-desc',
							),
						),
						'display_labels'  => array(
							'type'    => 'select',
							'label'   => __( 'Labels', 'uabb' ),
							'default' => 'block',
							'options' => array(
								'block' => __( 'Show', 'uabb' ),
								'none'  => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'block' => array(
									'sections' => array( 'label_typography' ),
								),
							),
							'help'    => __( ' It works if labels are not hidden in the back-end', 'uabb' ),
						),
					),
				),
			),
		),
		'style'      => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'form_style'              => array( // Section.
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
								'selector'  => '.uabb-caf-form',
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
								'selector'  => '.uabb-caf-form',
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
								'selector'  => '.uabb-caf-form',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'caf_title_desc_align'   => array(
							'type'       => 'align',
							'label'      => __( 'Title & Description Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
							'preview'    => array(
								'type' => 'refresh',
							),
						),
					),
				),
				'form_fields_style'       => array( // Section.
					'title'  => 'Form Fields', // Section Title.
					'fields' => array( // Section Fields.
						'field_size'                 => array(
							'type'    => 'select',
							'label'   => __( 'Field Size', 'uabb' ),
							'default' => 'box',
							'options' => array(
								'extra_small' => __( 'Extra Small', 'uabb' ),
								'small'       => __( 'Small', 'uabb' ),
								'medium'      => __( 'Medium', 'uabb' ),
								'large'       => __( 'Large', 'uabb' ),
								'extra_large' => __( 'Extra Large', 'uabb' ),
							),
						),
						'field_padding'              => array(
							'type'       => 'dimension',
							'label'      => __( 'Field Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form input.form-control, .uabb-caf-form form input[type="text"], .uabb-caf-form form textarea, .uabb-caf-form form input[type="password"], .uabb-caf-form form input[type="email"], .uabb-caf-form form input[type="url"], .uabb-caf-form form input[type="date"], .uabb-caf-form form input[type="month"], .uabb-caf-form form input[type="time"], .uabb-caf-form form input[type="datetime"], .uabb-caf-form form input[type="datetime-local"], .uabb-caf-form form input[type="week"], .uabb-caf-form form input[type="number"], .uabb-caf-form form input[type="search"], .uabb-caf-form form input[type="tel"], .uabb-caf-form form input[type="color"], .uabb-caf-form form select',
								'property'  => 'padding',
								'unit'      => 'px',
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
								'type'      => 'refresh',
								'selector'  => '.uabb-caf-form .caldera-grid .form-control, .uabb-caf-form form input[type="text"], .uabb-caf-form form input[type="password"], .uabb-caf-form form input[type="email"], .uabb-caf-form form input[type="url"], .uabb-caf-form form input[type="date"], .uabb-caf-form form input[type="month"], .uabb-caf-form form input[type="time"], .uabb-caf-form form input[type="datetime"], .uabb-caf-form form input[type="datetime-local"], .uabb-caf-form form input[type="week"], .uabb-caf-form form input[type="number"], .uabb-caf-form form input[type="search"], .uabb-caf-form form input[type="tel"], .uabb-caf-form form input[type="color"], .uabb-caf-form form select, .uabb-caf-form form textarea, .uabb-caf-form .trumbowyg-box, .uabb-caf-form .trumbowyg-editor, .uabb-caf-form .caldera-grid .form-control .ccselect2-choice, .uabb-caf-form .caldera-grid form input[type=checkbox], .uabb-caf-form .caldera-grid form input[type=radio] + span:before, .uabb-caf-form input[type=file]',
								'property'  => 'background-color',
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
								'selector'  => '.uabb-caf-form label',
								'property'  => 'color',
								'important' => true,
							),
						),
						'placeholder_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Input Text / Placeholder Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form input:not([type=submit]):not([type=checkbox]):not([type=radio]) , .uabb-caf-form textarea, .uabb-caf-form select, .uabb-caf-form .caldera-grid form input[type=checkbox]:checked:after, .uabb-caf-form .ccselect2-chosen, form .trumbowyg-editor, .uabb-caf-form form input::placeholder, .uabb-caf-form form textarea::placeholder, .uabb-caf-form .uabb-caf-select-custom:after',
								'property'  => 'color',
								'important' => true,
							),
						),
						'field_desc_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Field Description Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .help-block, .uabb-caf-form .has-error .help-block',
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
								'selector'  => '.uabb-caf-form .field_required',
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
								'selector'  => '.uabb-caf-form input.form-control, .uabb-caf-form form input[type=text], .uabb-caf-form form input[type=file], .uabb-caf-form form input[type=password], .uabb-caf-form form input[type=email], .uabb-caf-form form input[type=url], .uabb-caf-form form input[type=date], .uabb-caf-form form input[type=month], .uabb-caf-form form input[type=time], .uabb-caf-form form input[type=datetime], .uabb-caf-form form input[type=datetime-local], .uabb-caf-form form input[type=week], .uabb-caf-form form input[type=number], .uabb-caf-form form input[type=search], .uabb-caf-form form input[type=tel], .uabb-caf-form form input[type=color], .uabb-caf-form form select.form-control, .uabb-caf-form form textarea.form-control, .uabb-caf-form .trumbowyg-box, .uabb-caf-form .caldera-grid .ccselect2-container.form-control:hover, .uabb-caf-form .caldera-grid .ccselect2-container.form-control, .uabb-caf-form .caldera-grid .checkbox input[type=checkbox], .uabb-caf-form .caldera-grid .checkbox-inline input[type=checkbox], .uabb-caf-form .caldera-grid .radio input[type=radio] + span:before,.uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before, .uabb-caf-form .live-gravatar span:nth-of-type(1)',
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
						'disable_shadow_effect'      => array(
							'type'    => 'select',
							'label'   => __( 'Disable Field Shadow Effect', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'form_fields_align'          => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
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
						'desc_top_spacing'           => array(
							'type'        => 'unit',
							'label'       => __( 'Description Top Spacing', 'uabb' ),
							'placeholder' => '0',
							'slider'      => true,
							'responsive'  => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'submit_button_style'     => array( // Section.
					'title'  => 'Button', // Section Title.
					'fields' => array( // Section Fields.
						'button_align'              => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
						),
						'button_size'               => array(
							'type'    => 'select',
							'label'   => __( 'Size', 'uabb' ),
							'default' => 'medium',
							'options' => array(
								'extra_small' => __( 'Extra Small', 'uabb' ),
								'small'       => __( 'Small', 'uabb' ),
								'medium'      => __( 'Medium', 'uabb' ),
								'large'       => __( 'Large', 'uabb' ),
								'extra_large' => __( 'Extra Large', 'uabb' ),
							),
						),
						'button_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form input[type="submit"], .uabb-caf-form input[type="button"], .uabb-caf-form .cf-uploader-trigger, .uabb-caf-form a.btn-default',
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
								'selector'  => '.uabb-caf-form input[type="submit"], .uabb-caf-form .btn-default, .uabb-caf-form .cf-uploader-trigger',
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
								'selector'  => '.uabb-caf-form input[type="submit"], .uabb-caf-form .btn-default, .uabb-caf-form .cf-uploader-trigger',
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
								'selector'  => '.uabb-caf-form input[type="submit"], .uabb-caf-form .btn-default, .uabb-caf-form .cf-uploader-trigger',
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
					),
				),
				'radio_checkbox_style'    => array( // Section.
					'title'  => 'Radio & Checkbox', // Section Title.
					'fields' => array( // Section Fields.
						'override_checkbox_radio_style' => array(
							'type'    => 'select',
							'label'   => __( 'Override Current Style', 'uabb' ),
							'default' => 'box',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'checkbox_radio_size', 'checkbox_radio_bgcolor', 'checkbox_radio_selected_color', 'checkbox_border', 'radio_border' ),
								),
							),
						),
						'checkbox_radio_size'           => array(
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'default' => '24',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-caf-form .caldera-grid form .checkbox input[type=checkbox] , .uabb-caf-form .caldera-grid form .checkbox-inline input[type=checkbox] , .uabb-caf-form .caldera-grid .radio input[type=radio] + span:before , .uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before ',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-caf-form .caldera-grid form .checkbox input[type=checkbox] , .uabb-caf-form .caldera-grid form .checkbox-inline input[type=checkbox] , .uabb-caf-form .caldera-grid .radio input[type=radio] + span:before , .uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before ',
										'property'  => 'height',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'checkbox_radio_bgcolor'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid form .checkbox input[type=checkbox] , .uabb-caf-form .caldera-grid form .checkbox-inline input[type=checkbox] , .uabb-caf-form .caldera-grid .radio input[type=radio] + span:before , .uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before ',
								'property'  => 'background',
								'important' => true,
							),
						),
						'checkbox_radio_selected_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Checked Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'checkbox_radio_text_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Label Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form.uabb-caf-radio-custom .checkbox label, .uabb-caf-form.uabb-caf-radio-custom .radio label, .uabb-caf-form.uabb-caf-radio-custom label.checkbox-inline, .uabb-caf-form.uabb-caf-radio-custom label.radio-inline',
								'property'  => 'color',
								'important' => true,
							),
						),
						'checkbox_border'               => array(
							'type'    => 'border',
							'label'   => __( 'Checkbox Border', 'uabb' ),
							'default' => array(
								'style'  => 'solid',
								'color'  => 'c4c4c4',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '2',
									'top_right'    => '2',
									'bottom_left'  => '2',
									'bottom_right' => '2',
								),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid form .checkbox input[type=checkbox] , .uabb-caf-form .caldera-grid form .checkbox-inline input[type=checkbox] ',
								'important' => true,
							),
						),
						'radio_border'                  => array(
							'type'    => 'border',
							'label'   => __( 'Radio Border', 'uabb' ),
							'default' => array(
								'style'  => 'solid',
								'color'  => 'c4c4c4',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '30',
									'top_right'    => '30',
									'bottom_left'  => '30',
									'bottom_right' => '30',
								),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid .radio input[type=radio] + span:before , .uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before ',
								'important' => true,
							),
						),
					),
				),
				'star_rating_style'       => array( // Section.
					'title'  => 'Star Rating', // Section Title.
					'fields' => array( // Section Fields.
						'star_rating_size'         => array(
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'default' => '20',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid form .raty-star-on, .uabb-caf-form .caldera-grid form .raty-star-off',
								'property'  => 'font-size',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'star_icon_border_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid form .raty-star-off',
								'property'  => 'color',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid form .raty-star-on',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'success_error_msg_style' => array( // Section.
					'title'  => 'Success / Error Message', // Section Title.
					'fields' => array( // Section Fields.
						'error_msg_position'           => array(
							'type'    => 'select',
							'label'   => __( 'Error Message Position', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'      => __( 'Default', 'uabb' ),
								'bottom_right' => __( 'Bottom Right Side of Field', 'uabb' ),
							),
							'toggle'  => array(
								'default'      => array(
									'fields' => array(),
								),
								'bottom_right' => array(
									'fields' => array( 'error_msg_bg_color' ),
								),
							),
						),
						'error_msg_color'              => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Error Message Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .has-error .caldera_ajax_error_block span',
								'property'  => 'color',
								'important' => true,
							),
						),
						'error_msg_bg_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Error Message Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'error_label_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Error Label Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .has-error label',
								'property'  => 'color',
								'important' => true,
							),
						),
						'error_highlight_border_color' => array(
							'type'       => 'color',
							'label'      => __( 'Highlight Border Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.has-error input.form-control,  form .has-error input[type="text"],  form .has-error input[type="password"],  form .has-error input[type="email"],  form .has-error input[type="url"],  form .has-error input[type="date"],  form .has-error input[type="month"],  form .has-error input[type="time"],  form .has-error input[type="datetime"],  form .has-error input[type="datetime-local"],  form .has-error input[type="week"],  form .has-error input[type="number"],  form .has-error input[type="search"],  form .has-error input[type="tel"],  form .has-error input[type="color"],  form .has-error select,  form .has-error textarea,  .has-error .trumbowyg-box,  .has-error .caldera-grid .ccselect2-container.form-control.parsley-error:hover,  .caldera-grid .ccselect2-container.form-control.parsley-error,  .caldera-grid .has-error.cf-toggle-switch .cf-toggle-group-buttons>a,  .uabb-caf-form .has-error .checkbox input[type=checkbox],  .uabb-caf-form .has-error .checkbox-inline input[type=checkbox],  .uabb-caf-form .has-error .radio input[type=radio] + span:before,  .uabb-caf-form .has-error .radio-inline input[type=radio] + span:before,  .uabb-caf-form .has-error input[type="file"]',
								'property'  => 'border-color',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'success_msg_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Success Message Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid .alert-success',
								'property'  => 'color',
								'important' => true,
							),
						),
						'success_bg_color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Success Message Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .caldera-grid .alert-success',
								'property'  => 'background',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'form_title_typography'        => array(
					'title'  => __( 'Form Title', 'uabb' ),
					'fields' => array(
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
								'selector' => '.uabb-caf-form-title',
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
								'selector' => '.uabb-caf-form-title',
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
								'selector' => '.uabb-caf-form-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'form_desc_typography'         => array(
					'title'  => __( 'Form Description', 'uabb' ),
					'fields' => array(
						'form_desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-caf-form-desc',
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
								'selector' => '.uabb-caf-form-desc',
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
								'selector' => '.uabb-caf-form-desc',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'field_labels_typography'      => array( // Section.
					'title'  => 'Field Label', // Section Title.
					'fields' => array( // Section Fields.
						'field_label_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form label',
								'important' => true,
							),
						),
					),
				),
				'input_placeholder_typography' => array( // Section.
					'title'  => 'Input Text / Placeholder', // Section Title.
					'fields' => array( // Section Fields.
						'input_placeholder_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form input:not([type=submit]) , .uabb-caf-form textarea',
								'important' => true,
							),
						),
					),
				),
				'button_typography'            => array( // Section.
					'title'  => 'Button', // Section Title.
					'fields' => array( // Section Fields.
						'button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-caf-form .form-group input[type="submit"], .uabb-caf-form .form-group input[type="button"], .uabb-caf-form .btn-default, .uabb-caf-form .btn-success, .uabb-caf-form .cf-uploader-trigger',
								'important' => true,
							),
						),
					),
				),
				'error_message_typography'     => array( // Section.
					'title'  => 'Error Message', // Section Title.
					'fields' => array( // Section Fields.
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
				'success_message_typography'   => array( // Section.
					'title'  => 'Success Message', // Section Title.
					'fields' => array( // Section Fields.
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
		'uabb_docs'  => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/caldera-forms-styler/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=caldera-form-styler" target="_blank" rel="noopener"> Getting Started Article </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/unable-to-see-caldera-form-styler-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=caldera-form-styler" target="_blank" rel="noopener"> Unable to See Caldera Forms Styler Module? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);

