<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Contact Form 7 Module
 */

FLBuilder::register_module(
	'UABBContactForm7Module',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'form_section' => array(
					'fields' => array(
						'form_id'           => array(
							'type'    => 'select',
							'label'   => __( 'Select Form', 'uabb' ),
							'default' => uabb_cf7_get_form_id(),
							'options' => array(),
							'help'    => __( 'Choose the form that you want for this page for styling', 'uabb' ),
						),
						'cf_form_raw_nonce' => array(
							'type'    => 'text',
							'default' => wp_create_nonce( 'uabb-cf7-nonce' ),
						),
						'form_title'        => array(
							'type'    => 'text',
							'label'   => __( 'Form Title', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-cf7-form-title',
							),
						),
						'form_desc'         => array(
							'type'    => 'textarea',
							'label'   => __( 'Form Description', 'uabb' ),
							'default' => '',
							'rows'    => '5',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-cf7-form-desc',
							),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'form-general'               => array(
					'title'  => __( 'Form Style', 'uabb' ),
					'fields' => array(
						'form_bg_type'           => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
								'image'    => __( 'Image', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'form_bg_color', 'form_bg_color_opc', 'form_radius' ),
								),
								'image'    => array(
									'fields' => array( 'form_bg_img', 'form_bg_img_pos', 'form_bg_img_size', 'form_bg_img_repeat', 'form_radius' ),
								),
								'gradient' => array(
									'fields' => array( 'form_bg_gradient', 'form_radius' ),
								),
							),
							'help'    => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'form_bg_gradient'       => array(
							'type'    => 'uabb-gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => array(
								'color_one' => '',
								'color_two' => '',
								'direction' => 'left_right',
								'angle'     => '0',
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
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style',
								'property' => 'background',
							),
						),
						'form_bg_color_opc'      => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'placeholder' => '100',
							'maxlength'   => '3',
							'size'        => '5',
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
								'selector' => '.uabb-cf7-style',
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
										'selector' => '.uabb-cf7-form-title',
										'property' => 'text-align',
									),
									array(
										'selector' => '.uabb-cf7-form-desc',
										'property' => 'text-align',
									),
								),
							),
						),
					),
				),
				'input-size-align'           => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_background_type'      => array(
							'type'    => 'select',
							'label'   => __( 'Input Background Color', 'uabb' ),
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
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea, .uabb-cf7-style input[type=tel]',
								'property' => 'background',
							),
						),
						'input_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '100',
						),
						'input_text_align'           => array(
							'type'    => 'select',
							'label'   => __( 'Text Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style .wpcf7 form.wpcf7-form:not(input)',
								'property' => 'text-align',
							),
						),
						'input_field_height'         => array(
							'type'        => 'unit',
							'label'       => __( 'Height', 'uabb' ),
							'default'     => '',
							'size'        => '6',
							'description' => 'px',
							'placeholder' => 'auto',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea',
								'property' => 'height',
								'unit'     => 'px',
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
								'selector' => '.uabb-cf7-style textarea',
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
						'input_border_width_dimension' => array(
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
						'input_border_radius'          => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'input_border_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea',
								'property' => 'border-color',
							),
						),
						'input_border_active_color'    => array(
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
							'help'    => __( 'To use this option you need to select "Wrap each item with label element" in the Contact Form 7 checkbox and radio button settings or add use_label_element while creating both radio buttons and checkboxes.', 'uabb' ),
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
										'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
										'property' => 'width',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"]:checked + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"]:checked + span:before',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property' => 'border-color',
							),
						),
						'radio_btn_border_radius'    => array(
							'type'        => 'unit',
							'label'       => __( 'Radio Button Round Corners', 'uabb' ),
							'default'     => '50',
							'placeholder' => '50',
							'description' => 'px',
							'size'        => '10',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property' => 'border-radius',
								'unit'     => 'px',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before',
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
				'btn-style'         => array(
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
								'3d'          => __( '3D', 'uabb' ),
							),
							'toggle'  => array(
								'flat'        => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'transparent' => array(
									'fields' => array( 'btn_border_width', 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'gradient'    => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'3d'          => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'btn_width', 'btn_border_radius' ),
								),
								'default'     => array(
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'button_padding_dimension', 'button_border_style', 'button_border_width', 'button_border_radius', 'button_border_color', 'border_hover_color' ),
								),
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
						'btn_text_color'                 => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'color',
							),
						),
						'btn_text_hover_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Text Hover Color', 'uabb' ),
							'preview'    => array(
								'type' => 'none',
							),
							'default'    => '',
							'show_reset' => true,
						),

						'btn_background_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '0085ba',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'background',
							),
						),
						'btn_background_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '100',
						),
						'btn_background_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '0085ba',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'btn_background_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Hover Opacity', 'uabb' ),
							'placeholder' => '100',
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
							'preview'     => array(
								'type' => 'none',
							),
						),
						'hover_attribute'                => array(
							'type'    => 'select',
							'label'   => __( 'Apply Hover Color To', 'uabb' ),
							'default' => 'bg',
							'options' => array(
								'border' => __( 'Border', 'uabb' ),
								'bg'     => __( 'Background', 'uabb' ),
							),
							'width'   => '75px',
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
								'selector' => 'input[type=submit]',
							),
						),
						'btn_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'input[type=submit]',
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
								'selector' => 'input[type=submit]',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'btn_text_transform'   => array(
							'type'    => 'select',
							'label'   => __( 'Text Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'None', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'inherit'    => __( 'Inherit', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
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
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'btn-structure'     => array(
					'title'  => __( 'Button Structure', 'uabb' ),
					'fields' => array(
						'btn_width'                => array(
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
									'fields' => array( 'btn_align', 'btn_mob_align' ),
								),
								'full'   => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom' ),
								),
							),
						),
						'button_padding_dimension' => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border_style'      => array(
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
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-style',
							),
						),
						'button_border_width'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'button_border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'button_border_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-color',
							),
						),
						'border_hover_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-color',
							),
						),
						'btn_custom_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Width', 'uabb' ),
							'default'     => '200',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'btn_custom_height'        => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Height', 'uabb' ),
							'default'     => '45',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'btn_padding_top_bottom'   => array(
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
										'selector' => '.uabb-cf7-style input[type=submit]',
										'property' => 'padding-top',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-cf7-style input[type=submit]',
										'property' => 'padding-bottom',
										'unit'     => 'px',
									),
								),
							),
						),
						'btn_border_radius'        => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'btn_align'                => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'property' => 'text-align',
								'selector' => '.uabb-cf7-style input[type=submit]',
							),
						),
						'btn_margin_top'           => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'unit'     => 'px',
							),
						),
						'btn_margin_bottom'        => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-cf7-style input[type=submit]',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'error'      => array(
			'title'    => __( 'Error', 'uabb' ),
			'sections' => array(
				'input-msg-section'      => array(
					'title'  => __( 'Input Field Message', 'uabb' ),
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
					'title'  => __( 'Validation Message', 'uabb' ),
					'fields' => array(
						'validation_msg_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Message Color', 'uabb' ),
							'help'       => __( 'This color would be applied to validation message in input field', 'uabb' ),
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
							'options' => array(
								'h1'   => __( 'H1', 'uabb' ),
								'h2'   => __( 'H2', 'uabb' ),
								'h3'   => __( 'H3', 'uabb' ),
								'h4'   => __( 'H4', 'uabb' ),
								'h5'   => __( 'H5', 'uabb' ),
								'h6'   => __( 'H6', 'uabb' ),
								'div'  => __( 'Div', 'uabb' ),
								'p'    => __( 'p', 'uabb' ),
								'span' => __( 'span', 'uabb' ),
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
								'selector' => '.uabb-cf7-form-title',
							),
						),
						'form_title_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-title',
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
								'selector' => '.uabb-cf7-form-desc',
							),
						),
						'form_desc_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => '.uabb-cf7-form-desc',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=tel]::placeholder, input[type=email], input[type=email]::placeholder, input[type=text], input[type=text]::placeholder, input, input::placeholder, textarea, textarea::placeholder',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
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
								'selector' => 'input[type=tel], input[type=email], input[type=text], input, textarea',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'radio_checkbox_typography' => array(
					'title'  => __( 'Radio Button and CheckBox', 'uabb' ),
					'fields' => array(
						'radio_checkbox_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'radio_checkbox_color'          => array(
							'type'    => 'color',
							'label'   => __( 'Color', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
								'property' => 'color',
							),
						),
						'radio_checkbox_transform'      => array(
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);
