<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB WP Forms Styler Module
 */

FLBuilder::register_module(
	'UABBWpFormStylerModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'select_form'  => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'wp_form_id' => array(
							'type'    => 'select',
							'label'   => __( 'Select Form', 'uabb' ),
							'default' => uabb_wpf_get_form_id(),
							'options' => array(),
							'help'    => __( 'Choose a form that you wish to style', 'uabb' ),
						),
					),
				),
				'form_section' => array(
					'title'  => __( 'Settings', 'uabb' ),
					'fields' => array(
						'wp_custom_desc'     => array(
							'type'    => 'select',
							'label'   => __( 'Title & Description', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
								'no'      => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'custom'  => array(
									'fields'   => array( 'wp_form_title', 'wp_form_desc', 'title_desc_align' ),
									'sections' => array( 'form_title_typography', 'form_desc_typography' ),
								),
								'default' => array(
									'fields'   => array( 'title_desc_align' ),
									'sections' => array( 'form_title_typography', 'form_desc_typography' ),
								),
							),
						),
						'wp_form_title'      => array(
							'type'        => 'text',
							'label'       => __( 'Form Title', 'uabb' ),
							'placeholder' => __( 'Enter the Form Title here ...', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-wpf-form-title',
							),
						),
						'wp_form_desc'       => array(
							'type'        => 'textarea',
							'label'       => __( 'Form Description', 'uabb' ),
							'placeholder' => __( 'Enter the Description here ...', 'uabb' ),
							'rows'        => '5',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-wpf-form-desc',
							),
						),
						'display_labels'     => array(
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
						'display_sub_labels' => array(
							'type'    => 'select',
							'label'   => __( 'Sub-Labels', 'uabb' ),
							'default' => 'block',
							'options' => array(
								'block' => __( 'Show', 'uabb' ),
								'none'  => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'block' => array(
									'sections' => array( 'sub_label_typography' ),
								),
							),
							'help'    => __( ' It works if Sub-labels are not hidden in the back-end', 'uabb' ),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Form Style', 'uabb' ),
			'sections' => array(
				'form_background'      => array(
					'title'  => __( 'Form Background', 'uabb' ),
					'fields' => array(
						'form_bg_type'       => array(
							'type'        => 'select',
							'label'       => __( 'Background Type', 'uabb' ),
							'default'     => 'none',
							'connections' => array( 'color' ),
							'options'     => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
								'image'    => __( 'Image', 'uabb' ),
							),
							'toggle'      => array(
								'color'    => array(
									'fields' => array( 'form_bg_color', 'form_radius' ),
								),
								'image'    => array(
									'fields' => array( 'form_bg_img', 'form_bg_img_pos', 'form_bg_img_size', 'form_bg_img_repeat', 'form_radius' ),
								),
								'gradient' => array(
									'fields' => array( 'form_gradient', 'form_radius' ),
								),
							),
							'help'        => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'form_gradient'      => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'background',
							),
						),
						'form_bg_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'form_bg_img_pos'    => array(
							'type'    => 'select',
							'label'   => __( 'Background Position', 'uabb' ),
							'default' => 'center center',
							'options' => array(
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							),
						),
						'form_bg_img_repeat' => array(
							'type'    => 'select',
							'label'   => __( 'Background Repeat', 'uabb' ),
							'default' => 'repeat',
							'options' => array(
								'no-repeat' => __( 'No Repeat', 'uabb' ),
								'repeat'    => __( 'Repeat All', 'uabb' ),
								'repeat-x'  => __( 'Repeat Horizontally', 'uabb' ),
								'repeat-y'  => __( 'Repeat Vertically', 'uabb' ),
							),
						),
						'form_bg_img_size'   => array(
							'type'    => 'select',
							'label'   => __( 'Background Size', 'uabb' ),
							'default' => 'cover',
							'options' => array(
								'contain' => __( 'Contain', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'initial' => __( 'Initial', 'uabb' ),
								'inherit' => __( 'Inherit', 'uabb' ),
							),
						),
						'form_bg_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'background',
							),
						),
					),
				),
				'form_border_settings' => array( // Section.
					'title'  => __( 'Form Border', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'form_border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'border',
							),
						),
					),
				),
				'form_corners_padding' => array( // Section.
					'title'  => __( 'Form Padding', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'form_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'title_desc_align'       => array(
							'type'    => 'align',
							'label'   => __( 'Title & Description Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-wpf-form-title,.wpforms-form .wpforms-title',
										'property' => 'text-align',
									),
									array(
										'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
										'property' => 'text-align',
									),
								),
							),
						),
					),
				),
			),
		),
		'input'      => array(
			'title'    => __( 'Input Style', 'uabb' ),
			'sections' => array(
				'input-size-align'           => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_background_type'   => array(
							'type'    => 'select',
							'label'   => __( 'Input Background type', 'uabb' ),
							'default' => 'color',
							'options' => array(
								'color'       => __( 'Color', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'color' => array(
									'fields' => array( 'input_background_color' ),
								),
							),
						),
						'input_background_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler input[type=email], .uabb-wpf-styler input[type=text], .uabb-wpf-styler input[type=url], .uabb-wpf-styler input[type=number], .uabb-wpf-styler input[type=date], .uabb-wpf-styler select, .uabb-wpf-styler textarea, .uabb-wpf-styler input[type=tel], .uabb-wpf-styler .wpforms-form input[type=password]',
								'property' => 'background',
							),
						),
						'field_description_color' => array(
							'type'        => 'color',
							'label'       => __( 'Field Description Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field-description, .uabb-wpf-styler .wpforms-form .wpforms-field-html',
								'property' => 'color',
							),
						),
						'required_asterisk_color' => array(
							'type'        => 'color',
							'label'       => __( 'Required Asterisk Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-required-label',
								'property' => 'color',
							),
						),
						'textarea_height'         => array(
							'type'    => 'unit',
							'label'   => __( 'Textarea Height', 'uabb' ),
							'default' => 'auto',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler textarea',
								'property' => 'height',
								'unit'     => 'px',
							),
						),
						'input_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Input Padding', 'uabb' ),
							'default'    => '12',
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
						),
					),
				),
				'input-border-style'         => array(
					'title'  => __( 'Input Border Style', 'uabb' ),
					'fields' => array(
						'input_border'                  => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'solid',
								'color' => 'cccccc',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler input[type=email], .uabb-wpf-styler input[type=text], .uabb-wpf-styler input[type=url], .uabb-wpf-styler input[type=number], .uabb-wpf-styler input[type=date], .uabb-wpf-styler .wpforms-form input[type=password], .uabb-wpf-styler select, .uabb-wpf-styler textarea',
							),
						),
						'input_background_active_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Active Color', 'uabb' ),
							'default'     => 'bbbbbb',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'input_border_active_color'     => array(
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
					),
				),
				'input-radio-checkbox-style' => array(
					'title'  => __( 'Radio and Checkbox Style', 'uabb' ),
					'fields' => array(
						'radio_check_custom_option'  => array(
							'type'    => 'select',
							'label'   => __( 'Use Custom Style', 'uabb' ),
							'default' => 'false',
							'help'    => __( 'To use this option you need to select "Wrap each item with label element" in the WPForms checkbox and radio button settings or add use_label_element while creating both radio buttons and checkboxes.', 'uabb' ),
							'options' => array(
								'true'  => __( 'Yes', 'uabb' ),
								'false' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'true' => array(
									'fields'   => array( 'radio_check_size', 'radio_check_bgcolor', 'radio_check_selected_color', 'radio_check_border_width', 'radio_check_border_color', 'radio_check_border_active_color', 'radio_btn_border_radius', 'checkbox_border_radius', 'radio_checkbox_font_size', 'radio_checkbox_color' ),
									'sections' => array( 'radio_checkbox_typography' ),
								),
							),
						),
						'radio_check_size'           => array(
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'default' => '20',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-wpf-styler .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
										'property' => 'width',
										'unit'     => 'px',

									),
									array(
										'selector' => '.uabb-wpf-styler .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
										'property' => 'height',
										'unit'     => 'px',
									),
								),
							),
						),
						'radio_check_bgcolor'        => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'DEDEDE',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'background',
							),
						),
						'radio_check_selected_color' => array(
							'type'        => 'color',
							'label'       => __( 'Checked Color', 'uabb' ),
							'default'     => '3A3A3A',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"]:checked + label:before',
								'property' => 'background',
							),
						),
						'radio_check_border_width'   => array(
							'type'    => 'unit',
							'label'   => __( 'Border Width', 'uabb' ),
							'default' => '1',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'radio_check_border_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => 'CCCCCC',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'border-color',
							),
						),
						'check_radio_items_spacing'  => array(
							'type'    => 'unit',
							'label'   => __( 'Radio & Checkbox Items Spacing', 'uabb' ),
							'default' => '10',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field-radio li:not(:last-child), .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox ul li:not(:last-child), .uabb-wpf-styler .wpforms-form .wpforms-field-payment-multiple li:not(:last-child)',
										'property' => 'margin-bottom',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-wpf-styler .wpforms-field-radio.wpforms-list-inline ul li:not(:last-child), .uabb-wpf-styler .wpforms-field-checkbox.wpforms-list-inline ul li:not(:last-child), .uabb-wpf-styler .wpforms-field-payment-multiple.wpforms-list-inline li:not(:last-child)',
										'property' => 'margin-right',
										'unit'     => 'px',
									),
								),
							),
						),
						'checkbox_border_radius'     => array(
							'type'    => 'unit',
							'label'   => __( 'Checkbox Round Corners', 'uabb' ),
							'default' => '0',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'button'     => array(
			'title'    => __( 'Button', 'uabb' ),
			'sections' => array(
				'btn-style'     => array(
					'title'  => __( 'Button Style', 'uabb' ),
					'fields' => array(
						'btn_style'        => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'flat'        => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'transparent' => array(
									'fields' => array( 'btn_border_width', 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'gradient'    => array(
									'fields' => array( 'btn_gradient', 'btn_width', 'btn_border_radius' ),
								),
								'default'     => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_padding', 'button_border', 'border_hover_color', 'btn_background_color' ),
								),
							),
						),
						'btn_border_width' => array(
							'type'    => 'unit',
							'label'   => __( 'Border Width', 'uabb' ),
							'default' => '2',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
					),
				),
				'btn-colors'    => array(
					'title'  => __( 'Button Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'             => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'color',
							),
						),
						'btn_gradient'               => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'background',
							),
						),
						'btn_text_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_background_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'btn_background_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'btn-structure' => array(
					'title'  => __( 'Button Structure', 'uabb' ),
					'fields' => array(
						'btn_width'              => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'help'    => __( 'Choose a custom width according to the parent column width. Button wider than a column might cut off.', 'uabb' ),
							'options' => array(
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_padding' ),
								),
								'full'   => array(
									'fields' => array( 'btn_padding' ),
								),
								'custom' => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom' ),
								),
							),
						),
						'btn_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'button_border'          => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_custom_width'       => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Width', 'uabb' ),
							'default' => '200',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'btn_custom_height'      => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Height', 'uabb' ),
							'default' => '45',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'btn_padding_top_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Padding Top/Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
										'property' => 'padding-top',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
										'property' => 'padding-bottom',
										'unit'     => 'px',
									),
								),
							),
						),
						'btn_border_radius'      => array(
							'type'    => 'unit',
							'label'   => __( 'Round Corners', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'btn_align'              => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
						),
						'btn_margin_top'         => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),

							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'unit'     => 'px',
							),
						),
						'btn_margin_bottom'      => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'message'    => array(
			'title'    => __( 'Error Message', 'uabb' ),
			'sections' => array(
				'input-msg-section'      => array(
					'title'  => __( 'Field Validation', 'uabb' ),
					'fields' => array(
						'input_msg_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Message Color', 'uabb' ),
							'default'     => 'ce0000',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'input_msg_font_size'      => array(
							'type'    => 'unit',
							'label'   => __( 'Message Font Size', 'uabb' ),
							'default' => '12',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'input_msg_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
						),
						'input_msg_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'validation-msg-section' => array(
					'title'  => __( 'Success Message', 'uabb' ),
					'fields' => array(
						'validation_msg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Message Color', 'uabb' ),
							'help'        => __( 'This color would be applied to Success Message in input field', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'validation_msg_font_size'     => array(
							'type'    => 'unit',
							'label'   => __( 'Message Font Size', 'uabb' ),
							'default' => '15',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'validation_bg_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'validation_border'            => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
						),
						'validation_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Message Padding', 'uabb' ),
							'default'    => '10',
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
						),
						'validate_transform'           => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
						),
						'validate_letter_spacing'      => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'form_title_typography'     => array(
					'title'  => __( 'Form Title', 'uabb' ),
					'fields' => array(
						'wp_form_title_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h3',
							'help'    => __(
								'Heading tag will be applied to a custom heading only.
The default heading will inherit tag from WPForms plugin itself
',
								'uabb'
							),
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
						'form_title_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
							),
						),
						'form_title_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
								'property' => 'color',
							),
						),
						'form_title_bottom_margin'    => array(
							'type'    => 'unit',
							'label'   => __( 'Bottom Margin', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'form_desc_typography'      => array(
					'title'  => __( 'Form Description', 'uabb' ),
					'fields' => array(
						'form_desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
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
								'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
								'property' => 'color',
							),
						),
						'form_desc_bottom_margin' => array(
							'type'    => 'unit',
							'label'   => __( 'Bottom Margin', 'uabb' ),
							'default' => '20',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'label_typography'          => array(
					'title'  => __( 'Form Label', 'uabb' ),
					'fields' => array(
						'form_label_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label, .uabb-wpf-styler span.wpforms-page-indicator-page-title',
							),
						),
						'label_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label, .uabb-wpf-styler span.wpforms-page-indicator-page-title',
								'property' => 'color',
							),
						),
					),
				),
				'sub_label_typography'      => array(
					'title'  => __( 'Form Sub Label', 'uabb' ),
					'fields' => array(
						'form_sub_label_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field-sublabel',
							),
						),
						'sub_label_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field-sublabel',
								'property' => 'color',
							),
						),
					),
				),
				'input_typography'          => array(
					'title'  => __( 'Input Fields', 'uabb' ),
					'fields' => array(
						'form_input_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
							),
						),
						'color'               => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'input[type=tel], input[type=tel]::placeholder, input[type=email], input[type=email]::placeholder, input[type=text], input[type=text]::placeholder, input, input::placeholder, textarea, textarea::placeholder, .wpforms-single-item-price',
								'property' => 'color',
							),
						),
						'input_top_margin'    => array(
							'type'    => 'unit',
							'label'   => __( 'Input Top Margin', 'uabb' ),
							'default' => '0',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => 'input[type=tel], input[type=email], input[type=text],input[type=password], input, textarea, .wpforms-single-item-price, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'input_bottom_margin' => array(
							'type'    => 'unit',
							'label'   => __( 'Input Bottom Margin', 'uabb' ),
							'default' => '10',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => 'input[type=tel], input[type=email], input[type=text],input[type=password], input, textarea, .wpforms-single-item-price',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'radio_checkbox_typography' => array(
					'title'  => __( 'Radio Button and CheckBox', 'uabb' ),
					'fields' => array(
						'form_radio_typo'      => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label',
							),
						),
						'radio_checkbox_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label',
								'property' => 'color',
							),
						),
					),
				),
				'button_typography'         => array(
					'title'  => __( 'Submit Button', 'uabb' ),
					'fields' => array(
						'form_button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
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
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/wpforms-styler-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=wp-form-styler" target="_blank" rel="noopener"> How to Set Fields in wpf Styler Module? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/unable-to-see-wpforms-styler-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=wp-form-styler" target="_blank" rel="noopener"> Unable to see the WPForms Styler Module in UABB? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/styling-controls-in-wpforms-styler-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=wp-form-styler" target="_blank" rel="noopener"> Styling WP Forms Radio Buttons and Checkboxes </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-display-your-form-in-a-single-line/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=wp-form-styler" target="_blank" rel="noopener"> How to Display Your Form in a Single Line using WPForms Styler Module? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
