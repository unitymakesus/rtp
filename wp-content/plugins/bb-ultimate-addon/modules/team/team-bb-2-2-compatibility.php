<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 *  @package UABB Team Module
 */

FLBuilder::register_module(
	'UABBTeamModule', array(
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
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'width',
								'unit'      => 'px',
								'important' => true,
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
							'type'       => 'dimension',
							'label'      => __( 'Image Section Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-image',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'img_bg_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'help'        => __( 'For Image with padding, you can give background color for styling', 'uabb' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-image',
								'property'  => 'background',
								'important' => true,
							),
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
								'type'      => 'text',
								'selector'  => '.uabb-team-name-text',
								'important' => true,
							),
						),
						'designation' => array(
							'type'        => 'text',
							'label'       => __( 'Designation', 'uabb' ),
							'default'     => __( 'CEO, Example Inc.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-team-desgn-text',
								'important' => true,
							),
						),
						'description' => array(
							'type'        => 'textarea',
							'label'       => __( 'Description', 'uabb' ),
							'default'     => __( 'Use this space to tell a little about your team member. Make it interesting by mentioning his expertise, achievements, interests, hobbies and more.', 'uabb' ),
							'rows'        => '5',
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-team-desc-text',
								'important' => true,
							),
						),
					),
				),
				'text_style'  => array(
					'title'  => __( 'Content Style', 'uabb' ),
					'fields' => array(
						'text_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-content',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'text_bg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-content',
								'property'  => 'background',
								'important' => true,
							),
						),
						'text_alignment'         => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'Overall Content Alignment', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-content, .uabb-team-social',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'module_border_radius'   => array(
							'type'    => 'unit',
							'label'   => __( 'Box Radius', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-wrap',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'cta'         => array( // Section.
					'title'  => __( 'Custom Link', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'enable_custom_link' => array(
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
									'fields' => array( 'custom_link' ),
								),
							),
						),
						'custom_link'        => array(
							'type'          => 'link',
							'show_target'   => true,
							'show_nofollow' => true,
							'label'         => __( 'Link', 'uabb' ),
							'placeholder'   => 'http://www.example.com',
							'connections'   => array( 'url' ),
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
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'border-top-style',
								'important' => true,
							),
						),
						'separator_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'border-top-color',
								'important' => true,
							),
						),
						'separator_height'        => array(
							'type'    => 'unit',
							'label'   => __( 'Thickness', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'help'    => __( 'Adjust thickness of border.', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'border-top-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'separator_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'slider'      => true,
							'units'       => array( '%' ),
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
								'type'      => 'css',
								'selector'  => '.uabb-separator-parent',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'separator_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'separator_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
							'type'   => 'unit',
							'label'  => __( 'Size', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
						),
						'spacing'   => array(
							'type'   => 'unit',
							'label'  => __( 'Spacing Between Icons', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
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
							'type'   => 'unit',
							'label'  => __( 'Background Size', 'uabb' ),
							'help'   => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
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
							'type'   => 'unit',
							'label'  => __( 'Border Width', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
						),
						'icon_bg_border_radius' => array(
							'type'   => 'unit',
							'label'  => __( 'Border Radius', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
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
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'icon_hover_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						/* Background Color Dependent on Icon Style **/
						'icon_bg_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'icon_bg_color_opc'       => array(
							'type'   => 'unit',
							'label'  => __( 'Opacity', 'uabb' ),
							'slider' => true,
							'units'  => array( '%' ),
						),
						'icon_bg_hover_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_bg_hover_color_opc' => array(
							'type'   => 'unit',
							'label'  => __( 'Opacity', 'uabb' ),
							'slider' => true,
							'units'  => array( '%' ),
						),
						/* Border Color Dependent on Border Style for ICon */
						'icon_border_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'icon_border_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
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
						'name_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-name-text',
								'important' => true,
							),
						),
						'color'              => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-name-text, .uabb-team-name-text a',
								'property'  => 'color',
								'important' => true,
							),
						),
						'name_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-name-text',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'name_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-name-text',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'desg_typography' => array(
					'title'  => __( 'Designation', 'uabb' ),
					'fields' => array(
						'desg_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desgn-text',
								'important' => true,
							),
						),
						'desg_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desgn-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'desg_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desgn-text',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'desg_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desgn-text',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'desc_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desc-text',
								'important' => true,
							),
						),
						'desc_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desc-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'desc_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desc-text',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'desc_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-team-desc-text',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
	'uabb_social_icon_form', array(
		'title' => __( 'Add Icon', 'uabb' ),
		'tabs'  => array(
			'general' => array( // Tab.
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'general' => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'icon' => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
								'default'     => 'ua-icon ua-icon-linkedin-with-circle',
							),
							'link' => array(
								'type'          => 'link',
								'show_target'   => true,
								'show_nofollow' => true,
								'label'         => __( 'Link', 'uabb' ),
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
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'icohover_color'        => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'icobg_color'           => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'icobg_color_opc'       => array(
								'type'    => 'unit',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),
							'icobg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'icobg_hover_color_opc' => array(
								'type'    => 'unit',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
								'preview' => array(
									'type' => 'none',
								),
							),
							'icoborder_color'       => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Border Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'icoborder_hover_color' => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'preview'     => array(
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
