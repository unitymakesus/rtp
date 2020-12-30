<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Heading Module
 */

FLBuilder::register_module(
	'UABBHeadingModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'          => array(
					'title'  => '',
					'fields' => array(
						'heading' => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Design is a funny word', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-heading-text',
							),
							'connections' => array( 'string', 'html' ),
						),
						'link'    => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'description'      => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description' => array(
							'type'        => 'editor',
							'label'       => '',
							'rows'        => 7,
							'default'     => '',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'advanced_section' => array(
					'title'  => __( 'Advanced Option', 'uabb' ),
					'fields' => array(
						'background_text' => array(
							'type'    => 'select',
							'label'   => __( 'Background Text', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'bg_heading_text', 'bg_text_typo' ),
									'sections' => array( 'background_color' ),
								),
							),
						),
						'bg_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Background', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'structure'        => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'desc_position'      => array(
							'type'    => 'select',
							'label'   => __( 'Description Position', 'uabb' ),
							'default' => 'bottom',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'alignment'          => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This is the overall alignment and would apply to all Heading elements', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-heading-wrapper .uabb-heading, .uabb-heading-wrapper .uabb-subheading *',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'r_custom_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'The alignment will apply on Mobile', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-heading-wrapper .uabb-heading, .uabb-heading-wrapper .uabb-subheading *',
								'property'  => 'text-align',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Separator', 'uabb' ),
			'sections' => array(
				'separator'            => array(
					'title'  => __( 'Separator', 'uabb' ),
					'fields' => array(
						'separator_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Separator Style', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => __( 'None', 'uabb' ),
								'line'       => __( 'Line', 'uabb' ),
								'line_icon'  => __( 'Line With Icon', 'uabb' ),
								'line_image' => __( 'Line With Image', 'uabb' ),
								'line_text'  => __( 'Line With Text', 'uabb' ),
							),
							'toggle'  => array(
								'line'       => array(
									'sections' => array( 'separator_line' ),
									'fields'   => array( 'separator_position' ),
								),
								'line_icon'  => array(
									'sections' => array( 'separator_line', 'separator_icon_basic' ),
									'fields'   => array( 'separator_position', 'seprator_padding' ),
								),
								'line_image' => array(
									'sections' => array( 'separator_line', 'separator_img_basic' ),
									'fields'   => array( 'separator_position', 'seprator_padding' ),
								),
								'line_text'  => array(
									'sections' => array( 'separator_line', 'separator_text', 'separator_text_typography' ),
									'fields'   => array( 'separator_position', 'seprator_padding' ),
								),
							),
						),
						'separator_position' => array(
							'type'    => 'select',
							'label'   => __( 'Separator Position', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Between Heading & Description', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
					),
				),
				'separator_icon_basic' => array( // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon'                 => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'icon_size'            => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property'  => 'font-size',
								'unit'      => 'px',
								'important' => true,
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
						),
						'separator_icon_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'separator_img_basic'  => array( // Section.
					'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'photo_source'        => array(
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'uabb' ),
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
						'photo'               => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_url'           => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'img_size'            => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '50',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
						),
						'responsive_img_size' => array(
							'type'    => 'unit',
							'label'   => __( 'Responsive Size', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'help'    => __( 'Image size below medium devices. Leave it blank if you want to keep same size', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'separator_text'       => array(
					'title'  => __( 'Text', 'uabb' ),
					'fields' => array(
						'text_inline'              => array(
							'type'        => 'text',
							'connections' => array( 'string' ),
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'Ultimate',
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-divider-text',
								'important' => true,
							),
						),
						'responsive_compatibility' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'help'    => __( 'There might be responsive issues for long texts. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb' ),
							'default' => '',
							'options' => array(
								''                         => __( 'None', 'uabb' ),
								'uabb-responsive-mobile'   => __( 'Small Devices', 'uabb' ),
								'uabb-responsive-medsmall' => __( 'Medium & Small Devices', 'uabb' ),
							),
						),
					),
				),
				'separator_line'       => array(
					'title'  => __( 'Line Style', 'uabb' ), // tab title.
					'fields' => array(
						'separator_line_style'  => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator, .uabb-separator-line > span',
								'property'  => 'border-top-style',
								'important' => true,
							),
						),
						'separator_line_color'  => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator, .uabb-separator-line > span',
								'property'  => 'border-top-color',
								'important' => true,
							),
						),
						'separator_line_height' => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'help'        => __( 'Thickness of Border', 'uabb' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator, .uabb-separator-line > span',
								'property'  => 'border-top-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'separator_line_width'  => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '30',
							'slider'      => array(
								'%' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'       => array( '%' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator-wrap',
								'property'  => 'width',
								'unit'      => '%',
								'important' => true,
							),
						),
						'seprator_padding'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-divider-content',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'heading_typo'              => array(
					'collapsed' => true,
					'title'     => __( 'Heading', 'uabb' ),
					'fields'    => array(
						'color'                 => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
								'important' => true,
							),
						),
						'heading_bg_type'       => array(
							'type'        => 'select',
							'label'       => __( 'Background Type', 'uabb' ),
							'default'     => 'color',
							'connections' => array( 'color' ),
							'options'     => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Clip-Gradient', 'uabb' ),
								'image'    => __( 'Clip-Image', 'uabb' ),
							),
							'toggle'      => array(
								'color'    => array(
									'fields' => array( 'bg_color' ),
								),
								'image'    => array(
									'fields' => array( 'heading_bg_img', 'heading_bg_img_pos', 'heading_bg_img_size', 'heading_bg_img_repeat', 'bg_attachment' ),
								),
								'gradient' => array(
									'fields' => array( 'heading_gradient' ),
								),
							),
							'help'        => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'heading_gradient'      => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-heading .uabb-heading-text',
								'property' => 'background',
							),
						),
						'heading_bg_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'heading_bg_img_pos'    => array(
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
						'heading_bg_img_repeat' => array(
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
						'bg_attachment'         => array(
							'type'    => 'select',
							'label'   => __( 'Attachment', 'uabb' ),
							'default' => 'scroll',
							'options' => array(
								'scroll' => __( 'Scroll', 'uabb' ),
								'fixed'  => __( 'Fixed', 'uabb' ),
							),
							'help'    => __( 'Attachment will specify how the image reacts when scrolling a page. When scrolling is selected, the image will scroll with page scrolling. This is the default setting. Fixed will allow the image to scroll within the background if fill is selected in the scale setting.', 'uabb' ),
						),
						'heading_bg_img_size'   => array(
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
						'bg_color'              => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Heading Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
							),
						),
						'heading_padding'       => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'heading_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-top',
								'selector'  => '.uabb-heading',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'heading_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-heading',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'tag'                   => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1' => 'h1',
								'h2' => 'h2',
								'h3' => 'h3',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
						),
						'font_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.fl-module-content.fl-node-content .uabb-heading,.fl-module-content.fl-node-content .uabb-heading .uabb-heading-text',
								'important' => true,
							),
						),
					),
				),
				'description_typo'          => array(
					'collapsed' => true,
					'title'     => __( 'Description', 'uabb' ),
					'fields'    => array(
						'desc_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.fl-module-content.fl-node-content .uabb-subheading, .fl-module-content.fl-node-content .uabb-subheading *',
								'important' => true,
							),
						),
						'desc_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-text-editor, .uabb-text-editor p',
								'important' => true,
							),
						),
						'desc_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '15',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-top',
								'selector'  => '.uabb-subheading',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'desc_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-subheading',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'background_color'          => array( // Section.
					'collapsed' => true,
					'title'     => __( 'Background Text', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'bg_text_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Background Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-module-content.uabb-heading-wrapper .uabb-background-heading-wrap::before',
								'property'  => 'color',
								'important' => true,
							),
						),
						'head_horizental_position' => array(
							'type'       => 'unit',
							'label'      => __( 'Horizontal Position', 'uabb' ),
							'responsive' => true,
							'units'      => array(
								'px',
								'%',
							),
							'slider'     => array(
								'px' => array(
									'min' => -100,
									'max' => 200,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-heading-wrapper .uabb-background-heading-wrap::before',
								'property' => 'left',
							),
						),
						'head_vertical_position'   => array(
							'type'       => 'unit',
							'label'      => __( 'Vertical Position', 'uabb' ),
							'responsive' => true,
							'units'      => array(
								'px',
								'%',
							),
							'slider'     => array(
								'px' => array(
									'min' => -100,
									'max' => 200,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-heading-wrapper .uabb-background-heading-wrap::before',
								'property' => 'top',
							),
						),
						'bg_text_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Background Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-module-content.uabb-heading-wrapper .uabb-background-heading-wrap::before',
								'important' => true,
							),
						),
					),
				),
				'separator_text_typography' => array(
					'collapsed' => true,
					'title'     => __( 'Separator Text Typography', 'uabb' ),
					'fields'    => array(
						'separator_text_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Text Tag', 'uabb' ),
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
						'separator_font_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-divider-text',
								'important' => true,
							),
						),
						'separator_text_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-divider-text',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
