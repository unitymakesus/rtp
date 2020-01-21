<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Dual Button Module
 */

FLBuilder::register_module(
	'UABBDualButtonModule',
	array(
		'dual_button'            => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_button'         => array( // Section.
					'title'  => __( 'Button Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'dual_button_type'        => array(
							'type'    => 'select',
							'label'   => __( 'Button Type', 'uabb' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
							),
							'toggle'  => array(
								'horizontal' => array(
									'fields' => array( 'responive_dual_button', 'join_buttons' ),
								),
							),
						),
						'join_buttons'            => array(
							'type'    => 'select',
							'label'   => __( 'Join Button', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'spacing_between_buttons' => array(
							'type'        => 'unit',
							'label'       => __( 'Space between', 'uabb' ),
							'size'        => '6',
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dual_button_width_type'  => array(
							'type'    => 'select',
							'label'   => __( 'Button Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Auto', 'uabb' ),
								'full'   => __( 'Full width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'dual_button_align' ),
								),
								'custom' => array(
									'fields' => array( 'dual_button_align', 'dual_button_width', 'dual_button_height', 'dual_button_pad_top_bot', 'dual_button_pad_lef_rig' ),
								),
							),
						),
						'dual_button_width'       => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Width', 'uabb' ),
							'size'        => '6',
							'placeholder' => '100',
							'help'        => __( 'Custom Width of Single Button.', 'uabb' ),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dual_button_height'      => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Height', 'uabb' ),
							'size'        => '6',
							'placeholder' => '45',
							'help'        => __( 'Custom Height of Single Button.', 'uabb' ),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dual_button_pad_top_bot' => array(
							'type'   => 'unit',
							'label'  => __( 'Padding Top/Bottom', 'uabb' ),
							'size'   => '6',
							'units'  => array( 'px' ),
							'slider' => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dual_button_pad_lef_rig' => array(
							'type'   => 'unit',
							'label'  => __( 'Padding Left/Right', 'uabb' ),
							'size'   => '6',
							'units'  => array( 'px' ),
							'slider' => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dual_button_align'       => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
						),
						'dual_button_radius'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '0',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'responive_dual_button'   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Responsive Mode', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'help'    => __( 'Convert Horizontal style to Vertical style on Small Devices', 'uabb' ),
						),

					),
				),
				'dual_button_styles'  => array( // Section.
					'title'  => __( 'Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'dual_button_style'          => array(
							'type'    => 'select',
							'label'   => __( 'Button Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'transparent' => array(
									'sections' => array( 'dual_border_section' ),
									'fields'   => array( 'transparent_button_options' ),
								),
								'flat'        => array(
									'fields' => array( 'flat_button_options', '_btn_one_back_color', '_btn_two_back_color' ),
								),
								'gradient'    => array(
									'fields' => array( '_btn_one_back_color', '_btn_two_back_color' ),
								),
								'default'     => array(
									'fields' => array( 'button_padding_dimension', 'button_border', '_btn_one_back_color', '_btn_two_back_color', 'border_hover_color' ),
								),
							),
						),
						'button_padding_dimension'   => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-btn.uabb-btn-one,.uabb-btn.uabb-btn-two',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'              => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-btn.uabb-btn-one,.uabb-btn.uabb-btn-two',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'         => array(
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
						'transparent_button_options' => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'transparent-fade',
							'options' => array(
								'transparent-fade'        => __( 'Fade Background', 'uabb' ),
								'transparent-fill-top'    => __( 'Fill Background From Top', 'uabb' ),
								'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
								'transparent-fill-left'   => __( 'Fill Background From Left', 'uabb' ),
								'transparent-fill-right'  => __( 'Fill Background From Right', 'uabb' ),
								'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
								'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
								'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
							),
						),
						'flat_button_options'        => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'                => __( 'None', 'uabb' ),
								'animate_to_right'    => __( 'Appear Icon/Image From Left', 'uabb' ),
								'animate_to_left'     => __( 'Appear Icon/Image From Right', 'uabb' ),
								'animate_from_top'    => __( 'Appear Icon/Image From Top', 'uabb' ),
								'animate_from_bottom' => __( 'Appear Icon/Image From Bottom', 'uabb' ),
							),
						),
					),
				),
				'dual_border_section' => array( // Section.
					'title'  => __( 'Border Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'dual_button_border_style' => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
								'dashed' => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
								'dotted' => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
								'double' => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
								'inset'  => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
								'outset' => array(
									'fields' => array( 'button_border_color', 'button_border_width' ),
								),
							),
						),
						'button_border_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'button_border_width'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'size'        => '6',
							'placeholder' => '2',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),

					),
				),

			),
		),
		'dual_button_one'        => array( // Tab.
			'title'    => __( 'Button 1', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_button_one' => array( // Section.
					'title'  => __( 'Button 1 Options', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'button_one_title'          => array(
							'type'        => 'text',
							'label'       => __( 'Button Text', 'uabb' ),
							'placeholder' => 'Button One',
							'default'     => __( 'Check Demo', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-btn-one-text',
							),
						),
						'button_one_link'           => array(
							'type'          => 'link',
							'label'         => __( 'Button Link', 'uabb' ),
							'default'       => '#',
							'connections'   => array( 'url' ),
							'show_target'   => true,
							'show_nofollow' => true,
						),
						'button_one_class'          => array(
							'type'    => 'text',
							'label'   => __( 'Class', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type' => 'none',
							),
						),
						'_btn_one_back_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'_btn_one_back_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),

				/* Icon Image Param Code Starts */
				'type_general'    => array( // Section.
					'title'  => 'Image / Icon', // Section Title.
					'fields' => array( // Section Fields.
						'image_type_btn_one'     => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'  => __( 'None', 'uabb' ), // Removed args 'Image type.'.
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							),
							'toggle'  => array(
								'icon'  => array(
									'fields' => array( 'icon_btn_one', 'icon_position_btn_one', 'img_icon_width_btn_one' ),
								),
								'photo' => array(
									'fields' => array( 'photo_btn_one', 'icon_position_btn_one', 'img_icon_width_btn_one' ),
								),
							),
						),
						'icon_btn_one'           => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'photo_btn_one'          => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'icon_position_btn_one'  => array(
							'type'    => 'select',
							'label'   => __( 'Photo/Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
						'img_icon_width_btn_one' => array(
							'type'        => 'unit',
							'label'       => __( 'Photo/Icon Width', 'uabb' ),
							'placeholder' => '30',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
				/* Icon Image Param Code Ends */
			),
		),
		'dual_button_two'        => array( // Tab.
			'title'    => __( 'Button 2', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_button_two'      => array( // Section.
					'title'  => __( 'Button 2 Options', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'button_two_title'          => array(
							'type'        => 'text',
							'label'       => __( 'Button Text', 'uabb' ),
							'placeholder' => 'Button two',
							'default'     => __( 'Learn More', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-btn-two-text',
							),
						),

						'button_two_link'           => array(
							'type'          => 'link',
							'label'         => __( 'Button Link', 'uabb' ),
							'default'       => '#',
							'connections'   => array( 'url' ),
							'show_target'   => true,
							'show_nofollow' => true,
						),
						'button_two_class'          => array(
							'type'    => 'text',
							'label'   => __( 'Class', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type' => 'none',
							),
						),
						'_btn_two_back_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'_btn_two_back_hover_color' => array(
							'type'        => 'color',
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),

				/* Icon Image Param Code Starts */
				'type_general_btn_two' => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type_btn_two'     => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'  => __( 'None', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							),
							'toggle'  => array(
								'icon'  => array(
									'fields' => array( 'icon_btn_two', 'icon_position_btn_two', 'img_icon_width_btn_two' ),
								),
								'photo' => array(
									'fields' => array( 'photo_btn_two', 'icon_position_btn_two', 'img_icon_width_btn_two' ),
								),
							),
						),
						'icon_btn_two'           => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'photo_btn_two'          => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'icon_position_btn_two'  => array(
							'type'    => 'select',
							'label'   => __( 'Photo/Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
						'img_icon_width_btn_two' => array(
							'type'        => 'unit',
							'label'       => __( 'Photo/Icon Width', 'uabb' ),
							'placeholder' => '30',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),

					),
				),
				/* Icon Image Param Code Ends */
			),
		),
		'dual_button_divider'    => array( // Tab.
			'title'    => __( 'Divider', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_button_divider'     => array( // Section.
					'title'  => __( 'Divider Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'divider_options' => array(
							'type'    => 'select',
							'label'   => __( 'Select Divider', 'uabb' ),
							'default' => 'text',
							'options' => array(
								'none'  => __( 'None', 'uabb' ),
								'text'  => __( 'Text', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Image', 'uabb' ),
							),
							'toggle'  => array(
								'text'  => array(
									'sections' => array( 'dual_btn_divider_color', 'dual_btn_divider_border', 'divider_text' ),
									'fields'   => array( 'divider_text', 'divider_color' ),
								),
								'icon'  => array(
									'sections' => array( 'dual_btn_divider_color', 'dual_btn_divider_border' ),
									'fields'   => array( 'divider_icon', 'divider_color' ),
								),
								'photo' => array(
									'sections' => array( 'dual_btn_divider_border' ),
									'fields'   => array( 'divider_photo' ),
								),
							),
						),
						'divider_text'    => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'or',
							'connections' => array( 'string' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-middle-text',
							),
						),
						'divider_icon'    => array(
							'type'        => 'icon',
							'label'       => __( 'Select Icon', 'uabb' ),
							'show_remove' => true,
						),
						'divider_photo'   => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'connections' => array( 'photo' ),
						),
					),
				),
				'dual_btn_divider_color'  => array( // Section.
					'title'  => __( 'Divider Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'divider_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Text / Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'color',
							),
						),
						'divider_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'ffffff',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'background',
							),
						),
					),
				),
				'dual_btn_divider_border' => array( // Section.
					'title'  => __( 'Divider Border', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'divider_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'maxlength'   => '3',
							'placeholder' => '50',
							'size'        => '5',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'divider_border'        => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => '',
							'options' => array(
								''       => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
								'dashed' => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
								'dotted' => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
								'double' => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
								'inset'  => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
								'outset' => array(
									'fields' => array( 'divider_border_color', 'divider_border_width' ),
								),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'border-style',
							),
						),
						'divider_border_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'border-color',
							),
						),
						'divider_border_width'  => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
								'property' => 'border-width',
								'unit'     => 'px',
							),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),

					),
				),

			),
		),
		'dual_button_typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'typography_btn_one' => array(
					'title'  => __( 'Button 1', 'uabb' ),
					'fields' => array(
						'_btn_one_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-btn-one-text',
							),
						),
						'_btn_one_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-btn-one-text',
								'property' => 'color',
							),
						),
						'_btn_one_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'typography_btn_two' => array(
					'title'  => __( 'Button 2', 'uabb' ),
					'fields' => array(
						'_btn_two_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-btn-two-text',
							),
						),
						'_btn_two_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-btn-two-text',
								'property' => 'color',
							),
						),
						'_btn_two_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
					),
				),
				'divider_text'       => array(
					'title'  => __( 'Divider Text', 'uabb' ),
					'fields' => array(
						'_divider_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-middle-text',
							),
						),
					),
				),
			),
		),
	)
);
