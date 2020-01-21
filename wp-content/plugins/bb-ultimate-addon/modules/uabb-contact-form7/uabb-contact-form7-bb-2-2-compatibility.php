<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Contact Form 7 Module
 */

FLBuilder::register_module(
	'UABBContactForm7Module', array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'form_section' => array(
					'fields' => array(
						'form_id'    => array(
							'type'    => 'select',
							'label'   => __( 'Select Form', 'uabb' ),
							'default' => uabb_cf7_get_form_id(),
							'options' => array(),
							'help'    => __( 'Choose the form that you want for this page for styling', 'uabb' ),
						),
						'form_title' => array(
							'type'    => 'text',
							'label'   => __( 'Form Title', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'      => 'text',
								'selector'  => '.uabb-cf7-form-title',
								'important' => true,
							),
						),
						'form_desc'  => array(
							'type'    => 'textarea',
							'label'   => __( 'Form Description', 'uabb' ),
							'default' => '',
							'rows'    => '5',
							'preview' => array(
								'type'      => 'text',
								'selector'  => '.uabb-cf7-form-desc',
								'important' => true,
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
									'fields' => array( 'form_bg_color', 'form_radius' ),
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
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style',
								'property'  => 'background',
								'important' => true,
							),
						),
						'form_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Form Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => array(
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
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '0',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_text_align'        => array(
							'type'    => 'align',
							'label'   => __( 'Title & Description Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-cf7-form-title',
										'property'  => 'text-align',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-cf7-form-desc',
										'property'  => 'text-align',
										'important' => true,
									),
								),
							),
						),
					),
				),
				'input-size-align'           => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_background_type'   => array(
							'type'    => 'select',
							'label'   => __( 'Input Background Color', 'uabb' ),
							'default' => 'bg',
							'default' => 'color',
							'width'   => '75px',
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea, .uabb-cf7-style input[type=tel]',
								'property'  => 'background',
								'important' => true,
							),
						),
						'input_text_align'        => array(
							'type'    => 'align',
							'label'   => __( 'Text Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7 form.wpcf7-form:not(input)',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'input_field_height'      => array(
							'type'        => 'unit',
							'label'       => __( 'Height', 'uabb' ),
							'default'     => '',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => 'auto',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea',
								'property'  => 'height',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'textarea_height'         => array(
							'type'        => 'unit',
							'label'       => __( 'Textarea Height', 'uabb' ),
							'default'     => '',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => 'auto',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style textarea',
								'property'  => 'height',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Input Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
						),
					),
				),
				'input-border-style'         => array(
					'title'  => __( 'Input Border Style', 'uabb' ),
					'fields' => array(
						'input_border'              => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'	 => array(
								'style'		=> 'solid',
								'color'		=> 'cccccc',
								'width'		=> array(
									'top' 	 => '1',
									'right'	 => '1',
									'bottom' => '1',
									'left'	 => '1',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=email], .uabb-cf7-style input[type=text], .uabb-cf7-style input[type=url], .uabb-cf7-style input[type=number], .uabb-cf7-style input[type=date], .uabb-cf7-style select, .uabb-cf7-style textarea',
								'important' => true,
							),
						),
						'input_border_active_color' => array(
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
							'placeholder' => '20',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
										'property'  => 'height',
										'unit'      => 'px',
										'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property'  => 'background',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"]:checked + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"]:checked + span:before',
								'property'  => 'background',
								'important' => true,
							),
						),
						'radio_check_border_width'   => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'default'     => '1',
							'placeholder' => '1',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property'  => 'border-width',
								'unit'      => 'px',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'radio_btn_border_radius'    => array(
							'type'        => 'unit',
							'label'       => __( 'Radio Button Round Corners', 'uabb' ),
							'default'     => '50',
							'placeholder' => '50',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-radio input[type="radio"] + span:before',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'checkbox_border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Checkbox Round Corners', 'uabb' ),
							'default'     => '0',
							'placeholder' => '0',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
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
								'default'	  => __( 'Default', 'uabb' ),
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
									'fields' => array( 'btn_background_hover_color', 'btn_text_hover_color', 'button_padding_dimension', 'button_border', 'border_hover_color' ),
								),
							),
						),
						'btn_border_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'default'     => '2',
							'placeholder' => '2',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'btn-colors'        => array(
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'color',
								'important' => true,
							),
						),
						'btn_text_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
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
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'background',
								'important' => true,
							),
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
						'hover_attribute'            => array(
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
						'form_button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'input[type=submit]',
								'important' => true,
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
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'   => array(
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'width',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'btn_custom_height'      => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Height', 'uabb' ),
							'default' => '45',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'min-height',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'btn_padding_top_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => uabb_theme_button_vertical_padding( '' ),
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-cf7-style input[type=submit]',
										'property'  => 'padding-top',
										'important' => true,
										'unit'      => 'px',
									),
									array(
										'selector'  => '.uabb-cf7-style input[type=submit]',
										'property'  => 'padding-bottom',
										'important' => true,
										'unit'      => 'px',
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'property'  => 'border-radius',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'btn_align'              => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'      => 'css',
								'property'  => 'text-align',
								'important' => true,
								'selector'  => '.uabb-cf7-style input[type=submit]',
							),
						),
						'btn_margin_top'         => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-top',
								'important' => true,
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'unit'      => 'px',
							),
						),
						'btn_margin_bottom'      => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'important' => true,
								'selector'  => '.uabb-cf7-style input[type=submit]',
								'unit'      => 'px',
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
							'type'        => 'color',
							'label'       => __( 'Message Color', 'uabb' ),
							'default'     => 'ce0000',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'input_msg_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Message Font Size', 'uabb' ),
							'default'     => '12',
							'slider'      => true,
							'units'       => array( 'px' ),
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
							'slider'      => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'validation-msg-section' => array(
					'title'  => __( 'Validation Message', 'uabb' ),
					'fields' => array(
						'validation_msg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Message Color', 'uabb' ),
							'help'        => __( 'This color would be applied to validation message in input field', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'validation_msg_font_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Message Font Size', 'uabb' ),
							'default'     => '15',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '15',
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
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => array(
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
						'form_title_tag_selection' => array(
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
						'form_title_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-title',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-title',
								'property'  => 'color',
								'important' => true,
							),
						),
						'form_title_bottom_margin' => array(
							'type'    => 'unit',
							'label'   => __( 'Bottom Margin', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-title',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-desc',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-desc',
								'property'  => 'color',
								'important' => true,
							),
						),
						'form_desc_bottom_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom Margin', 'uabb' ),
							'default'     => '',
							'placeholder' => '20',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cf7-form-desc',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7 form.wpcf7-form:not(input)',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7 form.wpcf7-form:not(input)',
								'property'  => 'color',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => 'input[type=tel], input[type=email], input[type=text], input, textarea',
								'important' => true,
							),
						),
						'color'               => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'input[type=tel], input[type=tel]::placeholder, input[type=email], input[type=email]::placeholder, input[type=text], input[type=text]::placeholder, input, input::placeholder, textarea, textarea::placeholder',
								'property'  => 'color',
								'important' => true,
							),
						),
						'input_top_margin'    => array(
							'type'        => 'unit',
							'label'       => __( 'Input Top Margin', 'uabb' ),
							'default'     => '',
							'placeholder' => '0',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'input[type=tel], input[type=email], input[type=text], input, textarea',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_bottom_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Input Bottom Margin', 'uabb' ),
							'default'     => '',
							'placeholder' => '10',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'input[type=tel], input[type=email], input[type=text], input, textarea',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
								'type'      => 'css',
								'selector'  => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
								'important' => true,
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
								'selector' => '.uabb-cf7-style .wpcf7-checkbox input[type="checkbox"] + span, .uabb-cf7-style .wpcf7-radio input[type="radio"] + span',
								'property' => 'color',
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

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/set-multiple-column-fields-in-cf7-styler-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=cf7-styler-module" target="_blank" rel="noopener"> How to Set Multiple Column Fields in CF7 Styler Module? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/styling-contact-form-7-radio-buttons-checkboxes/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=cf7-styler-module" target="_blank" rel="noopener"> Styling Contact Form 7 Radio Buttons and Checkboxes </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
