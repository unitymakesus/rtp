<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Team Module
 */

FLBuilder::register_module(
	'UABBTeamModule',
	array(
		'imageicon'            => array(
			'title'    => __( 'Image', 'uabb' ),
			'sections' => array(
				/* Image Basic Setting */
				'img_basic'  => array( // Section.
					'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'photo_source' => array(
							'type'    => 'select',
							'label'   => __( 'Member Image Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'photo' ),
								),
								'url'     => array(
									'fields' => array( 'photo_url' ),
								),
							),
						),
						'photo'        => array(
							'type'        => 'photo',
							'label'       => __( 'Member Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'img_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
					),
				),
				'img_styles' => array(
					'title'  => __( 'Image Style', 'uabb' ),
					'fields' => array(
						'image_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'simple',
							'help'    => __( 'Circle and Square style will crop your image in 1:1 ratio', 'uabb' ),
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
							),
							'class'   => 'uabb-image-icon-style',
						),
						'img_spacing_dimension'   => array(
							'type'        => 'dimension',
							'label'       => __( 'Image Section Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-image',
								'property' => 'padding',
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
						'img_bg_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'help'       => __( 'For Image with padding, you can give background color for styling', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-team-image',
								'property' => 'background',
							),
						),
						'img_bg_color_opc'        => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'photo_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Image Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple'    => __( 'Simple', 'uabb' ),
								'grayscale' => __( 'Grayscale', 'uabb' ),
							),
							'toggle'  => array(
								'simple'    => array(
									'fields' => array( 'img_grayscale_simple' ),
								),
								'grayscale' => array(
									'fields' => array( 'img_grayscale_grayscale' ),
								),
							),
						),
						'img_grayscale_simple'    => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes'        => __( 'Simple', 'uabb' ),
								'color_gray' => __( 'Grayscale on Hover', 'uabb' ),
							),
						),
						'img_grayscale_grayscale' => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes'        => __( 'Simple', 'uabb' ),
								'gray_color' => __( 'Color on Hover', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'team_text'            => array(
			'title'    => __( 'Information', 'uabb' ),
			'sections' => array(
				'member_info' => array(
					'title'  => __( 'Member Information', 'uabb' ),
					'fields' => array(
						'name'        => array(
							'type'        => 'text',
							'label'       => __( 'Name', 'uabb' ),
							'default'     => __( 'John Doe', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-team-name-text',
							),
						),
						'designation' => array(
							'type'        => 'text',
							'label'       => __( 'Designation', 'uabb' ),
							'default'     => __( 'CEO, Example Inc.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-team-desgn-text',
							),
						),
						'description' => array(
							'type'        => 'textarea',
							'label'       => __( 'Description', 'uabb' ),
							'default'     => __( 'Use this space to tell a little about your team member. Make it interesting by mentioning his expertise, achievements, interests, hobbies and more.', 'uabb' ),
							'rows'        => '5',
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-team-desc-text',
							),
						),
					),
				),
				'text_style'  => array(
					'title'  => __( 'Content Style', 'uabb' ),
					'fields' => array(
						'text_spacing_dimension' => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '15',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'text_bg_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-team-content',
								'property' => 'background',
							),
						),
						'text_bg_color_opc'      => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'text_alignment'         => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'Overall Content Alignment', 'uabb' ),
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-team-content, .uabb-team-social',
								'property' => 'text-align',
							),
						),
						'module_border_radius'   => array(
							'type'        => 'unit',
							'label'       => __( 'Box Radius', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-wrap',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
					),
				),
				'cta'         => array( // Section.
					'title'  => __( 'Custom Link', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'enable_custom_link'   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Custom Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
							'help'    => __( 'Add a custom link to employee page.', 'uabb' ),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'custom_link', 'custom_link_target', 'custom_link_nofollow' ),
								),
							),
						),
						'custom_link'          => array(
							'type'        => 'link',
							'label'       => __( 'Link', 'uabb' ),
							'placeholder' => 'http://www.example.com',
							'connections' => array( 'url' ),
						),
						'custom_link_target'   => array(
							'type'    => 'select',
							'label'   => __( 'Target', 'uabb' ),
							'default' => '',
							'options' => array(
								'_blank' => __( 'New Page', 'uabb' ),
								''       => __( 'Same Page', 'uabb' ),
							),
						),
						'custom_link_nofollow' => array(
							'type'        => 'select',
							'label'       => __( 'Link Nofollow', 'uabb' ),
							'description' => '',
							'default'     => '0',
							'help'        => __( 'Enable this to make this link nofollow.', 'uabb' ),
							'options'     => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'separator'   => array( // Section.
					'title'  => __( 'Separator', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'enable_separator'        => array(
							'type'    => 'select',
							'label'   => __( 'Separator', 'uabb' ),
							'default' => 'block',
							'options' => array(
								'none'  => __( 'No', 'uabb' ),
								'block' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'none'  => array(
									'fields' => array(),
								),
								'block' => array(
									'fields'   => array( 'separator_pos', 'separator_color', 'separator_height', 'separator_style', 'separator_width', 'separator_alignment', 'separator_margin_top', 'separator_margin_bottom' ),
									'sections' => array( 'separator_margins' ),
								),
							),
						),
						'separator_pos'           => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'below_desg',
							'options' => array(
								'below_name' => __( 'Below Name', 'uabb' ),
								'below_desg' => __( 'Below Designation', 'uabb' ),
								'below_desc' => __( 'Below Description', 'uabb' ),
							),
						),
						'separator_style'         => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-style',
							),
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
						),
						'separator_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-color',
							),
						),
						'separator_height'        => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-width',
								'unit'     => 'px',
							),
							'help'        => __( 'Adjust thickness of border.', 'uabb' ),
						),
						'separator_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'maxlength'   => '3',
							'size'        => '5',
							'description' => '%',
						),
						'separator_alignment'     => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'inherit',
							'options' => array(
								'inherit' => __( 'Default', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
								'left'    => __( 'Left', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-separator-parent',
								'property' => 'text-align',
							),
						),
						'separator_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'separator_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),

		'social_links_section' => array(
			'title'    => __( 'Social Links', 'uabb' ),
			'sections' => array(
				'social_icons_switch' => array(
					'title'  => '',
					'fields' => array(
						'enable_social_icons' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Social Icons', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'social_links', 'icon_basic', 'icon_style', 'icon_colors' ),
								),
							),
						),
					),
				),
				'social_links'        => array(
					'title'  => __( 'Social Icons', 'uabb' ),
					'fields' => array(
						'icons' => array(
							'type'         => 'form',
							'label'        => __( 'Icon', 'uabb' ),
							'form'         => 'uabb_social_icon_form', // ID from registered form below.
							'preview_text' => 'icon', // Name of a field to use for the preview text.
							'multiple'     => true,
						),
					),
				),
				'icon_basic'          => array( // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_size' => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						),
						'spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing Between Icons', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '2',
							'size'        => '6',
							'description' => 'px',
						),
					),
				),
				'icon_style'          => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						/* Icon Style */
						'icon_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'  => array(
								'simple' => array(
									'fields' => array(),
								),
								'circle' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'square' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'custom' => array(
									'fields' => array( 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'icon_border_style' ),
								),
							),
						),

						/* Icon Background SIze */
						'icon_bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
						),

						/* Border Style and Radius for Icon */
						'icon_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
							),
						),
						'icon_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						),
						'icon_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '20',
						),
					),
				),
				'icon_colors'         => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.

						/* Style Options */
						'icon_color_preset'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => array(
								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							),
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						),
						/* Icon Color */
						'icon_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'icon_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),

						/* Background Color Dependent on Icon Style **/
						'icon_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'icon_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'icon_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'icon_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						/* Border Color Dependent on Border Style for ICon */
						'icon_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'icon_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),

						/* Gradient Color Option */
						'icon_three_d'            => array(
							'type'    => 'select',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => '0',
							'options' => array(
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'typography'           => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'name_typography' => array(
					'title'  => __( 'Name', 'uabb' ),
					'fields' => array(
						'tag_selection'      => array(
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
						'font_family'        => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-team-name-text',
							),
						),
						'font_size_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text, .uabb-team-name-text a',
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
						'line_height_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text',
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
						'color'              => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text, .uabb-team-name-text a',
								'property' => 'color',
							),
						),
						'transform'          => array(
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
								'selector' => '.uabb-team-name-text',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'     => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'name_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'name_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-name-text',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'desg_typography' => array(
					'title'  => __( 'Designation', 'uabb' ),
					'fields' => array(
						'desg_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-team-desgn-text',
							),
						),
						'desg_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
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
						'desg_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
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
						'desg_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
								'property' => 'color',
							),
						),
						'desg_transform'        => array(
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
								'selector' => '.uabb-team-desgn-text',
								'property' => 'text-transform',
							),
						),
						'desg_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'desg_margin_top'       => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'desg_margin_bottom'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desgn-text',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'desc_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-team-desc-text',
							),
						),
						'desc_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
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
						'desc_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
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
						'desc_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
								'property' => 'color',
							),
						),
						'desc_transform'        => array(
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
								'selector' => '.uabb-team-desc-text',
								'property' => 'text-transform',
							),
						),
						'desc_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'desc_margin_top'       => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'desc_margin_bottom'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-team-desc-text',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'uabb_social_icon_form',
	array(
		'title' => __( 'Add Icon', 'uabb' ),
		'tabs'  => array(
			'general' => array( // Tab.
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'general' => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'icon'        => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
								'default'     => 'ua-icon ua-icon-linkedin-with-circle',
							),
							'link'        => array(
								'type'  => 'link',
								'label' => __( 'Link', 'uabb' ),
							),
							'link_target' => array(
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'help'    => __( 'Controls where link will open after click.', 'uabb' ),
								'default' => '_blank',
								'options' => array(
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								),
								'preview' => array(
									'type' => 'none',
								),
							),
						),
					),
				),
			),
			'style'   => array( // Tab.
				'title'    => __( 'Style', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'message' => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'social_message' => array(
								'type'     => 'uabb-msgbox',
								'msg_type' => 'info',
								'content'  => 'Below Background / Border color properties will work only when Icon background style is not simple.',
							),
						),
					),
					'colors'  => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icocolor'              => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'icohover_color'        => array(
								'type'       => 'color',
								'label'      => __( 'Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'icobg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'icobg_color_opc'       => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'icobg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'icobg_hover_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
								'preview'     => array(
									'type' => 'none',
								),
							),
							'icoborder_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),

							'icoborder_hover_color' => array(
								'type'       => 'color',
								'label'      => __( 'Border Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
						),
					),
				),
			),
		),
	)
);
