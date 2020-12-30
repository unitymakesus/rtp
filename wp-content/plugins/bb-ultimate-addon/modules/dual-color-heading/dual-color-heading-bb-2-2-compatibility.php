<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Dual Color Heading Module
 */

FLBuilder::register_module(
	'UABBDualColorModule',
	array(
		'dual_color'      => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_color_first_heading'  => array( // Section.
					'title'  => __( 'Before text', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'first_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'I love ',
							'class'       => 'uabb-first-heading',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-first-heading-text',
							),
							'help'        => __( 'Enter first part of heading.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'first_heading_link' => array(
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
				'dual_color_second_heading' => array( // Section.
					'title'  => __( 'Highlighted Text', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'second_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'this website!',
							'class'       => 'uabb-second-heading',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-second-heading-text',
							),
							'help'        => __( 'Enter second part of heading.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'second_heading_link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'show_nofollow' => true,
							'show_target'   => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'advanced_section'          => array(
					'title'  => __( 'Advanced Option', 'uabb' ),
					'fields' => array(
						'after_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'After Text', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-after-heading-text',
							),
							'help'        => __( 'Enter the after part of both heading.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'bg_text'            => array(
							'type'    => 'select',
							'label'   => __( 'Background Text', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'bg_heading', 'bg_link', 'bg_text_typo' ),
									'sections' => array( 'background_color' ),
								),
							),
						),
						'bg_heading'         => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'Background',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'Heading_style'   => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'genral_style'     => array( // Section.
					'collapsed' => true,
					'title'     => __( 'General Styling', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'dual_head_alignment'      => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
							'help'       => __( 'This is the overall alignment and would apply to all Heading elements', 'uabb' ),
						),
						'layout_option'            => array(
							'type'    => 'select',
							'label'   => __( 'Dual Heading Layout', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline' => __( 'Inline', 'uabb' ),
								'block'  => __( 'Stack', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'inline' => array( 'responsive_compatibility' ),
								),
							),
						),
						'add_spacing_option'       => array(
							'type'    => 'select',
							'label'   => __( 'Spacing Between Headings', 'uabb' ),
							'default' => 'no',
							'class'   => 'dual-color-spacing-option',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'heading_margin' ),
								),
								'no'  => array(
									'fields' => array(),
								),
							),
							'help'    => __( 'Adjust spacing between first & second part of heading.', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-first-heading-text',
								'property' => 'margin-right',
								'unit'     => 'px',
							),

						),
						'heading_margin'           => array(
							'type'       => 'unit',
							'label'      => __( 'Spacing', 'uabb' ),
							'default'    => '10',
							'responsive' => true,
							'size'       => '8',
							'class'      => 'uabb-add-spacing',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'      => array( 'px' ),
							'help'       => __( 'Enter value for the spacing between first & second heading.', 'uabb' ),
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
				'dual_color'       => array( // Section.
					'collapsed' => true,
					'title'     => __( 'Before Text', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'first_heading_color'         => array(
							'type'        => 'color',
							'label'       => __( 'First Heading Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text',
								'property' => 'color',
							),
							'help'        => __( 'Select color for first part of heading.', 'uabb' ),
						),
						'first_heading_padding'       => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-first-heading-text',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'first_heading_bg_type'       => array(
							'type'        => 'select',
							'label'       => __( 'Background Type', 'uabb' ),
							'default'     => 'none',
							'connections' => array( 'color' ),
							'options'     => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Clip-Gradient', 'uabb' ),
								'image'    => __( 'Clip-Image', 'uabb' ),
							),
							'toggle'      => array(
								'color'    => array(
									'fields' => array( 'first_heading_bg_color', 'first_heading_radius' ),
								),
								'image'    => array(
									'fields' => array( 'first_heading_bg_img', 'first_heading_bg_img_pos', 'first_heading_bg_img_size', 'first_heading_bg_img_repeat', 'first_heading_radius', 'first_bg_attachment' ),
								),
								'gradient' => array(
									'fields' => array( 'first_heading_gradient', 'first_heading_radius' ),
								),
							),
							'help'        => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'first_heading_gradient'      => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text',
								'property' => 'background',
							),
						),
						'first_heading_bg_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'first_heading_bg_img_pos'    => array(
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
						'first_heading_bg_img_repeat' => array(
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
						'first_bg_attachment'         => array(
							'type'    => 'select',
							'label'   => __( 'Attachment', 'uabb' ),
							'default' => 'scroll',
							'options' => array(
								'scroll' => __( 'Scroll', 'uabb' ),
								'fixed'  => __( 'Fixed', 'uabb' ),
							),
							'help'    => __( 'Attachment will specify how the image reacts when scrolling a page. When scrolling is selected, the image will scroll with page scrolling. This is the default setting. Fixed will allow the image to scroll within the background if fill is selected in the scale setting.', 'uabb' ),
						),
						'first_heading_bg_img_size'   => array(
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
						'first_heading_bg_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text',
								'property' => 'background',
							),
						),
					),
				),
				'second_color'     => array( // Section.
					'collapsed' => true,
					'title'     => __( 'Highlighted Text', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'second_heading_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Second Heading Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text',
								'property' => 'color',
							),
							'help'        => __( 'Select color for second part of heading.', 'uabb' ),
						),
						'second_heading_padding'    => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'second_head_bg_type'       => array(
							'type'        => 'select',
							'label'       => __( 'Background Type', 'uabb' ),
							'default'     => 'none',
							'connections' => array( 'color' ),
							'options'     => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Clip-Gradient', 'uabb' ),
								'image'    => __( 'Clip-Image', 'uabb' ),
							),
							'toggle'      => array(
								'color'    => array(
									'fields' => array( 'second_head_bg_color', 'second_head_radius' ),
								),
								'image'    => array(
									'fields' => array( 'second_head_bg_img', 'second_head_bg_img_pos', 'second_head_bg_img_size', 'second_head_bg_img_repeat', 'second_head_radius', 'second_bg_attachment' ),
								),
								'gradient' => array(
									'fields' => array( 'second_head_gradient', 'second_head_radius' ),
								),
							),
							'help'        => __( 'You can select one of the three background types:<br />Color: simple one color background, <br />Gradient: two color background or <br />Image: single image or pattern.', 'uabb' ),
						),
						'second_head_gradient'      => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-second-heading-text',
								'property' => 'background',
							),
						),
						'second_head_bg_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
						),
						'second_head_bg_img_pos'    => array(
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
						'second_head_bg_img_repeat' => array(
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
						'second_head_bg_img_size'   => array(
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
						'second_bg_attachment'      => array(
							'type'    => 'select',
							'label'   => __( 'Attachment', 'uabb' ),
							'default' => 'scroll',
							'options' => array(
								'scroll' => __( 'Scroll', 'uabb' ),
								'fixed'  => __( 'Fixed', 'uabb' ),
							),
							'help'    => __( 'Attachment will specify how the image reacts when scrolling a page. When scrolling is selected, the image will scroll with page scrolling. This is the default setting. Fixed will allow the image to scroll within the background if fill is selected in the scale setting.', 'uabb' ),
						),
						'second_head_bg_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text',
								'property' => 'background',
							),
						),
					),
				),
				'after_color'      => array( // Section.
					'collapsed' => true,
					'title'     => __( 'After Text', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'after_heading_color'   => array(
							'type'        => 'color',
							'label'       => __( 'After text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-after-heading-text',
								'property' => 'color',
							),
							'help'        => __( 'Select color for after text of heading.', 'uabb' ),
						),
						'after_heading_padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-after-heading-text',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'heading_spacing'       => array(
							'type'       => 'unit',
							'label'      => __( 'Heading Spacing', 'uabb' ),
							'responsive' => true,
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'      => array( 'px' ),
						),
						'after_head_bg_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'default'  => '10',
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-after-heading-text',
								'property' => 'background',
							),
						),
					),
				),
				'background_color' => array( // Section.
					'collapsed' => true,
					'title'     => __( 'Background Text', 'uabb' ), // Section Title.
					'fields'    => array( // Section Fields.
						'bg_heading_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Background Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-bg-heading-wrap::before',
								'property'  => 'color',
								'important' => true,
							),
						),
						'horizental_position' => array(
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
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-bg-heading-wrap::before',
								'property' => 'left',
							),
						),
						'vertical_position'   => array(
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
								'selector' => '.uabb-module-content.uabb-dual-color-heading .uabb-bg-heading-wrap::before',
								'property' => 'top',
							),
						),
					),
				),
			),
		),
		'dual_typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_typography' => array(
					'title'  => __( 'Headings', 'uabb' ),
					'fields' => array(
						'dual_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Select Tag', 'uabb' ),
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
						'dual_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Before text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-dual-color-heading *, .uabb-dual-color-heading .uabb-first-heading-text',
							),
						),
						'second_typo'        => array(
							'type'       => 'typography',
							'label'      => __( 'Highlighted Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-dual-color-heading .uabb-second-heading-text',
								'important' => true,
							),
						),
						'after_text_typo'    => array(
							'type'       => 'typography',
							'label'      => __( 'After Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-dual-color-heading .uabb-after-heading-text',
								'important' => true,
							),
						),
						'bg_text_typo'       => array(
							'type'       => 'typography',
							'label'      => __( 'Background Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-bg-heading-wrap::before',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
