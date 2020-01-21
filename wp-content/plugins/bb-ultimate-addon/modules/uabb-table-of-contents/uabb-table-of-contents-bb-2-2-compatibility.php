<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Table of Contents Module
 */

FLBuilder::register_module(
	'UABBTableofContents',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'                        => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'heading_title' => array(
							'type'        => 'text',
							'label'       => __( 'Enter Title Text', 'uabb' ),
							'default'     => __( 'Table of Contents', 'uabb' ),
							'connections' => array( 'string' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-toc-heading',
							),
						),
					),
				),
				'Select heading tags to display' => array(
					'title'  => __( 'Contents', 'uabb' ),
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
							'label'   => __( 'Select List style', 'uabb' ),
							'default' => 'unordered_list',
							'options' => array(
								'none'           => __( 'None', 'uabb' ),
								'unordered_list' => __( 'Bullets', 'uabb' ),
								'ordered_list'   => __( 'Numbers', 'uabb' ),
							),
						),
						'separator_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Enable Separator', 'uabb' ),
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
				'toc_scroll'                     => array(
					'title'  => __( 'Scroll', 'uabb' ),
					'fields' => array(
						'scroll_animation' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Smooth Scroll', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Smooth scroll upto destination.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'scroll_effect', 'scroll_offset' ),
									'sections' => array( 'scroll_top_settings' ),
								),
							),
						),
						'scroll_effect'    => array(
							'type'    => 'unit',
							'label'   => __( 'Scroll Animation Delay', 'uabb' ),
							'default' => '500',
							'help'    => __( 'Set the delay animation for scroll effect in milliseconds', 'uabb' ),
							'units'   => array( 'ms' ),
							'slider'  => array(
								'step' => 10,
								'max'  => 2000,
							),
						),
						'scroll_offset'    => array(
							'type'   => 'unit',
							'label'  => __( 'Smooth Scroll Offset', 'uabb' ),
							'units'  => array( 'px' ),
							'help'   => __( 'Set the offset coordinates for scroll effect in px', 'uabb' ),
							'slider' => array(
								'step' => 10,
								'max'  => 1000,
							),
						),
						'scroll_top'       => array(
							'type'    => 'select',
							'label'   => __( 'Enable Scroll to Top', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'This will add a Scroll to Top arrow at the bottom-right of the page', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'scroll_top_settings' ),
								),
							),
						),
					),
				),
				'hide_show_contents'             => array(
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
									'fields'   => array( 'icon', 'icon_size', 'toc_collpseable' ),
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
							'slider'     => array(
								'px' => array(
									'min' => 0,
									'max' => 100,
								),
							),
							'units'      => array( 'px' ),
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
							'default'     => 'f4f4f4',
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
							'slider'     => array(
								'%' => array(
									'min' => 0,
									'max' => 100,
								),
							),
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
						'separator_line_width'    => array(
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
								'selector'  => '.uabb-separator, .uabb-separator-line > span',
								'property'  => 'width',
								'unit'      => '%',
								'important' => true,
							),
						),
						'sep_alignment'           => array(
							'type'       => 'align',
							'label'      => __( 'Seprator Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-parent-wrapper-toc .uabb-module-content.uabb-separator-parent',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'separator_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Separator Margin Bottom', 'uabb' ),
							'default' => '15',
							'slider'  => array(
								'px' => array(
									'min' => 0,
									'max' => 100,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-separator-parent',
								'unit'     => 'px',
							),
						),
					),
				),
				'toc_heading_settings' => array( // Section.
					'title'  => __( ' Title ', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.fl-module-content.fl-node-content .uabb-toc-heading',
							),
						),
						'toc_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'default' => '15',
							'slider'  => array(
								'px' => array(
									'min' => 0,
									'max' => 100,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-heading-block, .uabb-toc-heading',
								'unit'     => 'px',
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
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-toc-content-heading a, #uabb-toc-togglecontents, .uabb-toc-empty-note',
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
							'type'    => 'unit',
							'label'   => __( 'Space Between Contents', 'uabb' ),
							'default' => '10',
							'slider'  => array(
								'px' => array(
									'min' => 0,
									'max' => 100,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
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
						'toc_toggle_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-toggle-toc',
							),
						),
						'toc_toggle_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'toggle_bg_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-toggle-toc',
								'property' => 'background',
							),
						),
						'toggle_bg_hover_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'toc_toggle_padding'     => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-toggle-toc',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'toc_toggle_border'      => array(
							'type'       => 'border',
							'label'      => __( 'Icon Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-toggle-toc',
								'property' => 'border',
							),
						),
					),
				),
				'scroll_top_settings'  => array( // Section.
					'title'  => __( ' Scroll To Top', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'scroll_icon_color' => array(
							'type'        => 'color',
							'default'     => 'fcfcfc',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-toc-scroll-icon',
							),
						),
						'scroll_bg_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => '282828',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-toc-scroll-icon',
								'property' => 'background',
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
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-heading-block, .uabb-toc-heading',
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
								'type'     => 'css',
								'selector' => '.uabb-toc-content-heading a, .uabb-toc-empty-note',
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
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/introducing-table-of-contents-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-of-contents" target="_blank" rel="noopener"> Introducing Table Of Contents Module. </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/exclude-specific-headings-from-table-of-contents/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-of-contents" target="_blank" rel="noopener"> How to Exclude Specific Headings from Table of Contents? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
