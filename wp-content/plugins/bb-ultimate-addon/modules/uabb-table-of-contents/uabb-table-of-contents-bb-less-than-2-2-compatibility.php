<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Table of Contents Module
 */

FLBuilder::register_module(
	'UABBTableofContents',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'                => array(
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => array(
						'heading_title' => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Table of Contents', 'uabb' ),
							'connections' => array( 'string' ),
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-toc-heading',
								'important' => true,
							),
						),
					),
				),
				'select_heading_display' => array(
					'title'  => __( 'Select heading to display', 'uabb' ),
					'fields' => array(
						'heading_one'        => array(
							'type'    => 'select',
							'label'   => __( 'H1', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'heading_two'        => array(
							'type'    => 'select',
							'label'   => __( 'H2', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'heading_three'      => array(
							'type'    => 'select',
							'label'   => __( 'H3', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'heading_four'       => array(
							'type'    => 'select',
							'label'   => __( 'H4', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'heading_five'       => array(
							'type'    => 'select',
							'label'   => __( 'H5', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'heading_six'        => array(
							'type'    => 'select',
							'label'   => __( 'H6', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'bullet_icon'        => array(
							'type'    => 'select',
							'label'   => __( 'Enable List style', 'uabb' ),
							'default' => 'unordered_list',
							'options' => array(
								'none'           => __( 'None', 'uabb' ),
								'unordered_list' => __( 'Unordered List', 'uabb' ),
								'ordered_list'   => __( 'Ordered List', 'uabb' ),
							),
						),
						'separator_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Separator', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none' => __( 'No', 'uabb' ),
								'line' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'line' => array(
									'sections' => array( 'separator_line' ),
									'fields'   => array( 'separator_position' ),
								),
							),
						),
						'separator_position' => array(
							'type'    => 'select',
							'label'   => __( 'Separator Position', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Between Heading & Contents', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
					),
				),
				'toc_scroll'             => array(
					'title'  => __( 'Scroll Effect', 'uabb' ),
					'fields' => array(
						'scroll-animation' => array(
							'type'    => 'select',
							'label'   => __( 'Smooth Scroll', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Smooth scroll upto destination.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'scroll_effect', 'scroll_top', 'scroll_offset' ),
								),
							),
						),
						'scroll_effect'    => array(
							'type'        => 'unit',
							'label'       => __( 'Scroll Animation Delay (ms)', 'uabb' ),
							'description' => 'ms',
							'help'        => __( 'Set the delay animation for scroll effect in milliseconds', 'uabb' ),
							'size'        => '500',
							'units'       => 'ms',
						),
						'scroll_offset'    => array(
							'type'        => 'unit',
							'label'       => __( 'Smooth Scroll Offset (px)', 'uabb' ),
							'help'        => __( 'Set the offset coordinates for scroll effect in px', 'uabb' ),
							'description' => 'ms',
							'size'        => '100',
							'units'       => 'px',
						),
						'scroll_top'       => array(
							'type'    => 'select',
							'label'   => __( 'Enable Scroll to Top', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'This will add a Scroll to Top arrow at the bottom of page', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'hide_show_contents'     => array(
					'title'  => __( 'Collapsible', 'uabb' ),
					'fields' => array(
						'show_button'     => array(
							'type'    => 'select',
							'label'   => __( 'Make Content Collapsible', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'toc_toggle_settings' ),
									'fields'   => array( 'icon', 'icon_size' ),
								),
							),
						),
						'toc_collpseable' => array(
							'type'    => 'select',
							'label'   => __( 'Keep Collapsed Initally', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'icon'            => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'ua-icon ua-icon-chevron-down2',
							'show_remove' => true,
						),
						'icon_size'       => array(
							'type'       => 'unit',
							'label'      => __( 'Icon Size', 'uabb' ),
							'default'    => '30',
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-icon',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'general_style'        => array( // Section.
					'title'  => __( 'Container Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'toc_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-toc-container',
								'property' => 'background',
							),
						),
						'toc_width'    => array(
							'type'       => 'unit',
							'label'      => __( 'Width', 'uabb' ),
							'default'    => 'auto',
							'responsive' => true,
							'units'      => array( '%' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-toc-container',
								'property' => 'width',
								'unit'     => '%',
							),
						),
						'alignment'    => array(
							'type'       => 'align',
							'label'      => __( 'Overall Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-parent-wrapper-toc',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'toc_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-toc-container',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'toc_border'   => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-toc-container',
								'property' => 'border',
							),
						),
					),
				),
				'separator_line'       => array(
					'title'  => __( 'Separator Style', 'uabb' ), // tab title.
					'fields' => array(
						'separator_line_style'    => array(
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
						'separator_line_color'    => array(
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
						'separator_line_height'   => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
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
						'separator_line_width'    => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '30',
							'units'       => array( '%' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator, .uabb-separator-line > span',
								'property'  => 'width',
								'unit'      => '%',
								'important' => true,
							),
						),
						'separator_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Separator Margin Bottom', 'uabb' ),
							'default' => '15',
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'unit'     => 'px',
							),
						),
					),
				),
				'toc_heading_settings' => array( // Section.
					'title'  => __( ' Heading', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.fl-module-content.fl-node-content .uabb-toc-heading',
								'important' => true,
							),
						),
						'toc_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-heading-block, .uabb-toc-heading',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'toc_content_settings' => array( // Section.
					'title'  => __( ' Contents', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'toc_content_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-toc-content-heading a',
								'important' => true,
							),
						),
						'toc_content_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'space_between_contents'  => array(
							'type'        => 'unit',
							'label'       => __( 'Space Between Contents', 'uabb' ),
							'placeholder' => '15',
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.toc-lists li:not(:last-child)',
										'property' => 'padding-bottom',
										'unit'     => 'px',
									),
									array(
										'selector' => '.toc-lists li ul, .toc-lists li ol',
										'property' => 'padding-top',
										'unit'     => 'px',
									),
								),
							),
						),
					),
				),
				'toc_toggle_settings'  => array( // Section.
					'title'  => __( ' Contents Toggle', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'toc_toggle_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-hide-show',
								'important' => true,
							),
						),
						'toc_toggle_hover_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'toggle_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'efefef',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-hide-show',
								'property' => 'background',
							),
						),
						'toc_toggle_padding'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-hide-show',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'toc_toggle_border_style' => array(
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
								'selector' => '.uabb-hide-show',
								'property' => 'border-style',
							),
						),
						'toc_toggle_border_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-hide-show',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'toc_toggle_border_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-hide-show',
								'property' => 'border-color',
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'heading_typo'  => array(
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => array(
						'font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.fl-module-content.fl-node-content .uabb-toc-heading',
								'important' => true,
							),
						),
					),
				),
				'contents_typo' => array(
					'title'  => __( 'Contents', 'uabb' ),
					'fields' => array(
						'desc_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-toc-content-heading a',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
