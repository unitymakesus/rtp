<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB FAQ
 */

FLBuilder::register_module(
	'UABBFAQModule',
	array(
		'items'           => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'faq_section'      => array(
					'title'  => __( 'FAQ', 'uabb' ),
					'fields' => array(
						'faq_items' => array(
							'type'         => 'form',
							'label'        => __( 'FAQ', 'uabb' ),
							'form'         => 'uabb_faq_form', // ID from registered form below.
							'preview_text' => 'faq_question', // Name of a field to use for the preview text.
							'multiple'     => true,
							'default'      => array(
								array(
									'faq_question' => 'How Can I Set up the FAQ Module?',
									'faq_answer'   => 'You can drag-and-drop it like any other Beaver Builder module. Then add all your questions with respective answers. That’s it! You can then customize the FAQ section with design settings.',
								),
								array(
									'faq_question' => 'How to Enable Schema with FAQ Module?',
									'faq_answer'   => 'In a module, you will find an option to enable schema support. Once you enable this option, FAQ schema will be automatically added to your page. In case you are using an external plugin to add schema you can keep it disabled.',
								),
								array(
									'faq_question' => 'What Kind of Schema Does This Module Add?',
									'faq_answer'   => 'The module follows Google guidelines and adds FAQ schema.',
								),
							),
						),
					),
				),
				'schema_section'   => array(
					'title'  => __( 'Schema Markup', 'uabb' ),
					'fields' => array(
						'enable_schema' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Schema Markup', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'settings_section' => array(
					'title'  => __( 'Settings', 'uabb' ),
					'fields' => array(
						'faq_layout'       => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'accordion',
							'options' => array(
								'accordion' => __( 'Accordion', 'uabb' ),
								'grid'      => __( 'Grid', 'uabb' ),
							),
							'toggle'  => array(
								'accordion' => array(
									'fields'   => array( 'faq_collapse', 'faq_enable_first', 'faq_item_margin', 'faq_title_bg_hover_color' ),
									'sections' => array( 'title_icon' ),
								),
								'grid'      => array(
									'fields' => array( 'columns', 'row_gap', 'column_gap', 'faq_equal_height' ),
								),
							),
						),
						'columns'          => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'responsive' => array(
								'default' => array(
									'default'    => '3',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
							'slider'     => array(
								'step' => 1,
								'max'  => 6,
							),
						),
						'faq_collapse'     => array(
							'type'    => 'select',
							'label'   => __( 'Inactive Other Items', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'faq_enable_first' => array(
							'type'    => 'select',
							'label'   => __( 'Expand First Item', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'faq_title_style' => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'spacing_style' => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'layout_style'         => array(
							'type'    => 'select',
							'label'   => __( 'Enable Box Style', 'uabb' ),
							'default' => 'accordion_style',
							'options' => array(
								'accordion_style' => __( 'No', 'uabb' ),
								'box_style'       => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'box_style'       => array(
									'fields' => array( 'style_border_param', 'style_background_col' ),
								),
								'accordion_style' => array(
									'fields' => array( 'faq_title_bg_color', 'faq_title_bg_hover_color', 'faq_border_param', 'answers_bg_color', 'answers_border' ),
								),
							),
						),
						'row_gap'              => array(
							'type'       => 'unit',
							'label'      => __( 'Row Gap', 'uabb' ),
							'default'    => '10',
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
						'column_gap'           => array(
							'type'       => 'unit',
							'label'      => __( 'Column Gap', 'uabb' ),
							'default'    => '10',
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
						'faq_equal_height'     => array(
							'type'    => 'select',
							'label'   => __( 'Equal Height', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
						'style_background_col' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f6f6f6',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb__faq-layout-grid.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item-wrap,.uabb__faq-layout-accordion.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item',
								'property' => 'background',
							),
						),
						'style_border_param'   => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'none',
								'color' => '',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb__faq-layout-grid.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item-wrap,.uabb__faq-layout-accordion.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module .uabb-faq-item',
							),
						),
					),
				),
				'title_style'   => array(
					'title'  => __( 'Questions', 'uabb' ),
					'fields' => array(
						'faq_title_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-item .uabb-faq-questions .uabb-faq-question-label',
								'property' => 'color',
							),
						),
						'faq_title_hover_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Text Active/Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-faq-question-label',
								'property' => 'color',
							),
						),
						'faq_title_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f6f6f6',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-questions',
								'property' => 'background',
							),
						),
						'faq_title_bg_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover/Focus Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'faq_item_margin'          => array(
							'type'       => 'unit',
							'label'      => __( 'Item Spacing', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-item',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'faq_item_padding'         => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-questions',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'faq_border_param'         => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'none',
								'color' => '',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-questions',
							),
						),
					),
				),
				'answers_style' => array(
					'title'  => __( 'Answers', 'uabb' ),
					'fields' => array(
						'answers_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'color',
							),
						),
						'answers_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'background',
							),
						),
						'answers_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'answers_border'   => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'none',
								'color' => '',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
							),
						),
					),
				),
				'title_icon'    => array(
					'title'  => __( 'Icon', 'uabb' ),
					'fields' => array(
						'close_icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Close Icon', 'uabb' ),
							'default'     => 'fas fa-plus',
							'show_remove' => true,
						),
						'open_icon'        => array(
							'type'        => 'icon',
							'label'       => __( 'Open Icon', 'uabb' ),
							'default'     => 'fas fa-minus',
							'show_remove' => true,
						),
						'icon_size'        => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '16',
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '5',
							'slider'      => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-button-icon',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'icon_position'    => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
						'icon_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-button-icon',
								'property' => 'color',
							),
						),
						'icon_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Active/Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-faq-button-icon',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
		'acc_typography'  => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typogrphy'   => array(
					'title'  => __( 'Questions', 'uabb' ),
					'fields' => array(
						'tag_selection'   => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h4',
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
						'title_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-faq-question-label',
								'important' => true,
							),
						),
					),
				),
				'content_typogrphy' => array(
					'title'  => __( 'Answers', 'uabb' ),
					'fields' => array(
						'content_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-faq-content',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'       => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/faq/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=faq-module" target="_blank" rel="noopener"> Getting started article </a> </li>
							 </ul>',
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
	'uabb_faq_form',
	array(
		'title' => __( 'Add FAQ', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'general' => array(
						'title'  => '',
						'fields' => array(
							'faq_question' => array(
								'type'        => 'text',
								'label'       => __( 'Question', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'faq_answer'   => array(
								'type'        => 'editor',
								'label'       => __( 'Answer', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
				),
			),
		),
	)
);
