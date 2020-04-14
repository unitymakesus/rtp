<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB WP Forms Styler Module
 */

FLBuilder::register_module(
	'UABBWpFormStylerModule',
	array(
		'general' => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'select_form'  => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'wp_form_id'        => array(
							'type'        => 'select',
							'label'       => __( 'Select Form', 'uabb' ),
							'default'     => uabb_wpf_get_form_id(),
							'options'     => array(),
							'connections' => array( 'string' ),
							'help'        => __( 'Choose a form that you wish to style', 'uabb' ),
						),
						'wp_form_raw_nonce' => array(
							'type'    => 'text',
							'default' => wp_create_nonce( 'uabb-wpf-nonce' ),
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
								'type'      => 'text',
								'selector'  => '.uabb-wpf-form-title',
								'important' => true,
							),
						),
						'wp_form_desc'       => array(
							'type'        => 'textarea',
							'label'       => __( 'Form Description', 'uabb' ),
							'placeholder' => __( 'Enter the Description here ...', 'uabb' ),
							'rows'        => '5',
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-wpf-form-desc',
								'important' => true,
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
		'style'   => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'form-general' => array(
					'title'  => __( 'Form Style', 'uabb' ),
					'fields' => array(
						'form_bg_type'           => array(
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
									'fields' => array( 'form_bg_color', 'form_bg_color_opc', 'form_radius' ),
								),
								'image'    => array(
									'fields' => array( 'form_bg_img', 'form_bg_img_pos', 'form_bg_img_size', 'form_bg_img_repeat', 'form_radius' ),
								),
								'gradient' => array(
									'fields' => array( 'gradient', 'form_radius' ),
								),
							),
							'help'        => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'gradient'               => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'background',
							),
						),
						'form_bg_img'            => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'form_bg_img_pos'        => array(
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
						'form_bg_img_repeat'     => array(
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
						'form_bg_img_size'       => array(
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
						'form_bg_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'efefef',
							'show_alpha' => true,
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'background',
							),
						),
						'form_spacing_dimension' => array(
							'type'        => 'dimension',
							'label'       => __( 'Form Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '20',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'form_radius'            => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'default'     => '',
							'maxlength'   => '4',
							'size'        => '6',
							'description' => 'px',
							'placeholder' => '0',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'form_text_align'        => array(
							'type'    => 'select',
							'label'   => __( 'Title & Description Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
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
		'Input'   => array(
			'title'    => __( 'Input', 'uabb' ),
			'sections' => array(
				'input-size-align'           => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_background_type'      => array(
							'type'    => 'select',
							'label'   => __( 'Input Background Type', 'uabb' ),
							'default' => 'bg',
							'options' => array(
								'color'       => __( 'Color', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'color' => array(
									'fields' => array( 'input_background_color', 'input_background_color_opc' ),
								),
							),
							'default' => 'color',
							'width'   => '75px',
						),
						'input_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_alpha' => true,
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler input[type=email], .uabb-wpf-styler input[type=text], .uabb-wpf-styler input[type=url], .uabb-wpf-styler input[type=number], .uabb-wpf-styler input[type=date], .uabb-wpf-styler select, .uabb-wpf-styler textarea, .uabb-wpf-styler input[type=tel], .uabb-wpf-styler .wpforms-form input[type=password]',
								'property' => 'background',
							),
						),
						'input_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '100',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'field_description_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Field Description Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field-description, .uabb-wpf-styler .wpforms-form .wpforms-field-sublabel, .uabb-wpf-styler .wpforms-form .wpforms-field-html',
								'property' => 'color',
							),
						),
						'required_asterisk_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Required Asterisk Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-required-label',
								'property' => 'color',
							),
						),
						'textarea_height'            => array(
							'type'        => 'unit',
							'label'       => __( 'Textarea Height', 'uabb' ),
							'default'     => '',
							'size'        => '6',
							'description' => 'px',
							'placeholder' => 'auto',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler textarea',
								'property' => 'height',
								'unit'     => 'px',
							),
						),
						'input_padding_dimension'    => array(
							'type'        => 'dimension',
							'label'       => __( 'Input Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '10',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
				'input-border-style'         => array(
					'title'  => __( 'Input Border Style', 'uabb' ),
					'fields' => array(
						'input_border_width_dimension'  => array(
							'type'        => 'dimension',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '1',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'input_border_radius'           => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler input[type=email], .uabb-wpf-styler input[type=text], .uabb-wpf-styler input[type=url], .uabb-wpf-styler input[type=number], .uabb-wpf-styler input[type=date], .uabb-wpf-styler .wpforms-form input[type=password], .uabb-wpf-styler select, .uabb-wpf-styler textarea',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'input_border_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler input[type=email], .uabb-wpf-styler input[type=text], .uabb-wpf-styler input[type=url], .uabb-wpf-styler input[type=number], .uabb-wpf-styler input[type=date], .uabb-wpf-styler select, .uabb-wpf-styler textarea',
								'property' => 'border-color',
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
							'type'       => 'color',
							'label'      => __( 'Border Active Color', 'uabb' ),
							'default'    => 'bbbbbb',
							'preview'    => array(
								'type' => 'none',
							),
							'show_reset' => true,
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
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'default'     => '20',
							'size'        => '10',
							'placeholder' => '20',
							'preview'     => array(
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
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'DEDEDE',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'background',
							),
						),
						'radio_check_selected_color' => array(
							'type'       => 'color',
							'label'      => __( 'Checked Color', 'uabb' ),
							'default'    => '3A3A3A',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'background',
							),
						),
						'radio_check_border_width'   => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'default'     => '1',
							'placeholder' => '1',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'radio_check_border_color'   => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'CCCCCC',
							'show_reset' => true,
							'preview'    => array(
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
										'selector'  => '.uabb-wpf-styler .wpforms-form .wpforms-field-radio li:not(:last-child), .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox ul li:not(:last-child), .uabb-wpf-styler .wpforms-form .wpforms-field-payment-multiple li:not(:last-child)',
										'property'  => 'margin-bottom',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-wpf-styler .wpforms-field-radio.wpforms-list-inline ul li:not(:last-child), .uabb-wpf-styler .wpforms-field-checkbox.wpforms-list-inline ul li:not(:last-child), .uabb-wpf-styler .wpforms-field-payment-multiple.wpforms-list-inline li:not(:last-child)',
										'property'  => 'margin-right',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'checkbox_border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Checkbox Round Corners', 'uabb' ),
							'default'     => '0',
							'description' => 'px',
							'size'        => '10',
							'placeholder' => '0',
							'preview'     => array(
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
		'button'  => array(
			'title'      => __( 'Button', 'uabb' ),
			'sections'   => array(
				'btn-style' => array(
					'title'             => __( 'Button Style', 'uabb' ),
					'fields'            => array(
						'btn_style' => array(
							'type'             => 'select',
							'label'            => __( 'Style', 'uabb' ),
							'default'          => 'default',
							'options'          => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
							),
							'toggle'           => array(
								'flat'        => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color' ),
								),
								'transparent' => array(
									'fields' => array( 'btn_border_width', 'btn_background_hover_color', 'btn_text_hover_color' ),
								),
								'gradient'    => array(
									'fields' => array( 'btn_gradient' ),
								),
								'default'     => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_padding', 'button_border_style', 'button_border_width', 'button_border_radius', 'button_border_color', 'border_hover_color' ),
								),
							),
							'btn_border_width' => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'default'     => '2',
								'placeholder' => '2',
								'maxlength'   => '3',
								'size'        => '6',
								'description' => 'px',
							),
						),
					),
					'btn-colors'        => array(
						'title'  => __( 'Button Colors', 'uabb' ),
						'fields' => array(
							'btn_text_color'             => array(
								'type'       => 'color',
								'label'      => __( 'Text Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'color',
								),
							),
							'btn_text_hover_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Text Hover Color', 'uabb' ),
								'preview'    => array(
									'type' => 'none',
								),
								'default'    => '',
								'show_reset' => true,
							),

							'btn_background_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '0085ba',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'background',
								),
							),
							'btn_gradient'               => array(
								'type'    => 'gradient',
								'label'   => __( 'Gradient', 'uabb' ),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit]:hover, .uabb-wpf-styler .wpforms-form .wpforms-page-button:hover',
									'property' => 'background',
								),
							),
							'btn_background_hover_color' => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '0085ba',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
						),
					),
					'button_typography' => array(
						'title'  => __( 'Button Text', 'uabb' ),
						'fields' => array(
							'btn_font_family'      => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								),
							),
							'btn_font_size_unit'   => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'font-size',
									'unit'     => 'px',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'btn_line_height_unit' => array(
								'type'        => 'unit',
								'label'       => __( 'Line Height', 'uabb' ),
								'description' => 'em',
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'line-height',
									'unit'     => 'em',
								),
							),
							'btn_text_transform'   => array(
								'type'    => 'select',
								'label'   => __( 'Text Transform', 'uabb' ),
								'options' => array(
									''           => __( 'None', 'uabb' ),
									'capitalize' => __( 'Capitalize', 'uabb' ),
									'uppercase'  => __( 'UPPERCASE', 'uabb' ),
									'lowercase'  => __( 'lowercase', 'uabb' ),
									'inherit'    => __( 'Inherit', 'uabb' ),
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'text-transform',
								),
							),
							'btn_letter_spacing'   => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'letter-spacing',
									'unit'     => 'px',
								),
							),
						),
					),
					'btn-structure'     => array(
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
										'fields' => array( 'btn_align', 'btn_mob_align' ),
									),
									'custom' => array(
										'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom' ),
									),
								),
							),
							'btn_padding'            => array(
								'type'        => 'dimension',
								'label'       => __( 'Padding', 'uabb' ),
								'responsive'  => true,
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'padding',
									'unit'     => 'px',
								),
							),
							'button_border_style'    => array(
								'type'    => 'select',
								'label'   => __( 'Bottom Border Type', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'   => __( 'None', 'uabb' ),
									'solid'  => __( 'Solid', 'uabb' ),
									'dashed' => __( 'Dashed', 'uabb' ),
									'dotted' => __( 'Dotted', 'uabb' ),
									'double' => __( 'Double', 'uabb' ),
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'border-style',
								),
							),
							'button_border_width'    => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'placeholder' => '1',
								'description' => 'px',
								'maxlength'   => '2',
								'size'        => '6',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'border-width',
									'unit'     => 'px',
								),
							),
							'button_border_radius'   => array(
								'type'        => 'unit',
								'label'       => __( 'Border Radius', 'uabb' ),
								'placeholder' => '1',
								'description' => 'px',
								'maxlength'   => '2',
								'size'        => '6',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'border-radius',
									'unit'     => 'px',
								),
							),
							'button_border_color'    => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'border-color',
								),
							),
							'border_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'border-color',
								),
							),
							'btn_custom_width'       => array(
								'type'        => 'unit',
								'label'       => __( 'Custom Width', 'uabb' ),
								'default'     => '200',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'width',
									'unit'     => 'px',
								),
							),
							'btn_custom_height'      => array(
								'type'        => 'unit',
								'label'       => __( 'Custom Height', 'uabb' ),
								'default'     => '45',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'property' => 'min-height',
									'unit'     => 'px',
								),
							),
							'btn_padding_top_bottom' => array(
								'type'        => 'unit',
								'label'       => __( 'Padding Top/Bottom', 'uabb' ),
								'placeholder' => uabb_theme_button_vertical_padding( '' ),
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
								'preview'     => array(
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
								'type'        => 'unit',
								'label'       => __( 'Round Corners', 'uabb' ),
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
								'preview'     => array(
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
								'preview' => array(
									'type'     => 'css',
									'property' => 'text-align',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
								),
							),
							'btn_margin_top'         => array(
								'type'        => 'unit',
								'label'       => __( 'Margin Top', 'uabb' ),
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'property' => 'margin-top',
									'selector' => '.uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button',
									'unit'     => 'px',
								),
							),
							'btn_margin_bottom'      => array(
								'type'        => 'unit',
								'label'       => __( 'Margin Bottom', 'uabb' ),
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
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
						'title'  => __( 'Field Validaion', 'uabb' ),
						'fields' => array(
							'input_msg_color'          => array(
								'type'       => 'color',
								'label'      => __( 'Message Color', 'uabb' ),
								'default'    => 'ce0000',
								'show_reset' => true,
							),
							'input_msg_font_size'      => array(
								'type'        => 'unit',
								'label'       => __( 'Message Font Size', 'uabb' ),
								'default'     => '12',
								'maxlength'   => '4',
								'size'        => '6',
								'description' => 'px',
								'placeholder' => '12',
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
								'size'        => '5',
								'description' => 'px',
							),
						),
					),
					'validation-msg-section' => array(
						'title'  => __( 'Success Message', 'uabb' ),
						'fields' => array(
							'validation_msg_color'         => array(
								'type'       => 'color',
								'label'      => __( 'Message Color', 'uabb' ),
								'help'       => __( 'This color would be applied to Success Message in input field', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'validation_msg_font_size'     => array(
								'type'        => 'unit',
								'label'       => __( 'Message Font Size', 'uabb' ),
								'default'     => '15',
								'maxlength'   => '4',
								'size'        => '6',
								'description' => 'px',
								'placeholder' => '15',
							),
							'validation_bg_color'          => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'validation_bg_color_opc'      => array(
								'type'        => 'text',
								'label'       => __( 'Background Color Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'placeholder' => '100',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'validation_border_type'       => array(
								'type'    => 'select',
								'label'   => __( 'Type', 'uabb' ),
								'default' => 'solid',
								'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
								'options' => array(
									''       => _x( 'None', 'Border type.', 'uabb' ),
									'solid'  => _x( 'Solid', 'Border type.', 'uabb' ),
									'dashed' => _x( 'Dashed', 'Border type.', 'uabb' ),
									'dotted' => _x( 'Dotted', 'Border type.', 'uabb' ),
									'double' => _x( 'Double', 'Border type.', 'uabb' ),
								),
								'toggle'  => array(
									''       => array(
										'fields' => array(),
									),
									'solid'  => array(
										'fields' => array( 'validation_border_width', 'validation_border_color' ),
									),
									'dashed' => array(
										'fields' => array( 'validation_border_width', 'validation_border_color' ),
									),
									'dotted' => array(
										'fields' => array( 'validation_border_width', 'validation_border_color' ),
									),
									'double' => array(
										'fields' => array( 'validation_border_width', 'validation_border_color' ),
									),
								),
							),
							'validation_border_width'      => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'default'     => '1',
								'placeholder' => '1',
								'description' => 'px',
								'maxlength'   => '2',
								'size'        => '6',
							),
							'validation_border_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => 'cccccc',
								'help'       => __( 'If the validation is not right then this color would be applied to input border', 'uabb' ),
								'show_reset' => true,
							),
							'validation_border_radius'     => array(
								'type'        => 'unit',
								'label'       => __( 'Round Corners', 'uabb' ),
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'validation_spacing_dimension' => array(
								'type'        => 'dimension',
								'label'       => __( 'Message Padding', 'uabb' ),
								'description' => 'px',
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '10',
										'medium'     => '',
										'responsive' => '',
									),
								),
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
								'size'        => '5',
								'description' => 'px',
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
							'form_title_tag_selection'    => array(
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
							'form_title_font_family'      => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
								),
							),
							'form_title_font_size_unit'   => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
									'property' => 'font-size',
									'unit'     => 'px',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'form_title_line_height_unit' => array(
								'type'        => 'unit',
								'label'       => __( 'Line Height', 'uabb' ),
								'description' => 'em',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
									'property' => 'line-height',
									'unit'     => 'em',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'form_title_color'            => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-title',
									'property' => 'color',
								),
							),
							'form_title_transform'        => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
									'property' => 'text-transform',
								),
							),
							'form_title_letter_spacing'   => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-title, .wpforms-form .wpforms-title',
									'property' => 'letter-spacing',
									'unit'     => 'px',
								),
							),
							'form_title_bottom_margin'    => array(
								'type'        => 'unit',
								'label'       => __( 'Bottom Margin', 'uabb' ),
								'default'     => '',
								'placeholder' => '0',
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'preview'     => array(
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
							'form_desc_font_family'      => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
								),
							),
							'form_desc_font_size_unit'   => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-desc',
									'property' => 'font-size',
									'unit'     => 'px',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'form_desc_line_height_unit' => array(
								'type'        => 'unit',
								'label'       => __( 'Line Height', 'uabb' ),
								'description' => 'em',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
									'property' => 'line-height',
									'unit'     => 'em',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'form_desc_color'            => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
									'property' => 'color',
								),
							),
							'form_desc_transform'        => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
									'property' => 'text-transform',
								),
							),
							'form_desc_letter_spacing'   => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-form-desc, .wpforms-form .wpforms-description',
									'property' => 'letter-spacing',
									'unit'     => 'px',
								),
							),
							'form_desc_bottom_margin'    => array(
								'type'        => 'unit',
								'label'       => __( 'Bottom Margin', 'uabb' ),
								'default'     => '',
								'placeholder' => '20',
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'preview'     => array(
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
							'label_font_family'      => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => 'label',
								),
							),
							'label_font_size_unit'   => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'label',
									'property' => 'font-size',
									'unit'     => 'px',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'label_line_height_unit' => array(
								'type'        => 'unit',
								'label'       => __( 'Line Height', 'uabb' ),
								'description' => 'em',
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'label',
									'property' => 'line-height',
									'unit'     => 'em',
								),
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
							'label_color'            => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => 'label',
									'property' => 'color',
								),
							),
							'label_transform'        => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => 'label',
									'property' => 'text-transform',
								),
							),
							'label_letter_spacing'   => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'label',
									'property' => 'letter-spacing',
									'unit'     => 'px',
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
									'type'      => 'css',
									'selector'  => '.uabb-wpf-styler .wpforms-form .wpforms-field-sublabel',
									'important' => true,
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
									'type'      => 'css',
									'selector'  => '.uabb-wpf-styler .wpforms-form .wpforms-field-sublabel',
									'property'  => 'color',
									'important' => true,
								),
							),
						),
					),
					'input_typography'          => array(
						'title'  => __( 'Input Fields', 'uabb' ),
						'fields' => array(
							'font_family'         => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
								),
							),
							'font_size_unit'      => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
									'property' => 'font-size',
									'unit'     => 'px',
								),
							),
							'line_height_unit'    => array(
								'type'        => 'unit',
								'label'       => __( 'Line Height', 'uabb' ),
								'description' => 'em',
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
									'property' => 'line-height',
									'unit'     => 'em',
								),
							),
							'color'               => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=tel]::placeholder, input[type=email], input[type=email]::placeholder, input[type=text], input[type=text]::placeholder, input, input::placeholder, textarea, textarea::placeholder, .wpforms-single-item-price',
									'property' => 'color',
								),
							),
							'transform'           => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
									'property' => 'text-transform',
								),
							),
							'letter_spacing'      => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea, .wpforms-single-item-price',
									'property' => 'letter-spacing',
									'unit'     => 'px',
								),
							),
							'input_top_margin'    => array(
								'type'        => 'unit',
								'label'       => __( 'Input Top Margin', 'uabb' ),
								'default'     => '',
								'placeholder' => '0',
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'preview'     => array(
									'type'     => 'css',
									'selector' => 'input[type=tel], input[type=email], input[type=text],input[type=password], input, textarea, .wpforms-single-item-price, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before, .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before',
									'property' => 'margin-top',
									'unit'     => 'px',
								),
							),
							'input_bottom_margin' => array(
								'type'        => 'unit',
								'label'       => __( 'Input Bottom Margin', 'uabb' ),
								'default'     => '',
								'placeholder' => '10',
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'preview'     => array(
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
							'radio_checkbox_font_family' => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => '.uabb-wpf-styler .wpwpf-checkbox input[type="checkbox"] + span, .uabb-wpf-styler .wpwpf-radio input[type="radio"] + span',
								),
							),
							'radio_checkbox_font_size_unit' => array(
								'type'        => 'unit',
								'label'       => __( 'Font Size', 'uabb' ),
								'description' => 'px',
								'responsive'  => array(
									'placeholder' => array(
										'default'    => '',
										'medium'     => '',
										'responsive' => '',
									),
								),
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpwpf-checkbox input[type="checkbox"] + span, .uabb-wpf-styler .wpwpf-radio input[type="radio"] + span',
									'property' => 'font-size',
									'unit'     => 'px',
								),
							),
							'radio_checkbox_color'       => array(
								'type'    => 'color',
								'label'   => __( 'Color', 'uabb' ),
								'default' => '',
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpwpf-checkbox input[type="checkbox"] + span, .uabb-wpf-styler .wpwpf-radio input[type="radio"] + span',
									'property' => 'color',
								),
							),
							'radio_checkbox_transform'   => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpwpf-checkbox input[type="checkbox"] + span, .uabb-wpf-styler .wpwpf-radio input[type="radio"] + span',
									'property' => 'text-transform',
								),
							),
							'radio_checkbox_letter_spacing' => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-wpf-styler .wpwpf-checkbox input[type="checkbox"] + span, .uabb-wpf-styler .wpwpf-radio input[type="radio"] + span',
									'property' => 'letter-spacing',
									'unit'     => 'px',
								),
							),
						),
					),
				),
			),
		),
	)
);
