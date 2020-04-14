<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB FAQ
 */

FLBuilder::register_module(
	'UABBFAQModule',
	array(
		'items'           => array(
			'title'    => __( 'FAQ', 'uabb' ),
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
									'fields' => array( 'columns', 'row_gap', 'column_gap' ),
								),
							),
						),
						'columns'          => array(
							'type'    => 'unit',
							'label'   => __( 'Columns', 'uabb' ),
							'default' => '3',
						),
						'faq_collapse'     => array(
							'type'    => 'select',
							'label'   => __( 'Inactive Other Items', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'uabb' ),
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
							'help'    => __( 'Choosing yes will expand the first item by default.', 'uabb' ),
						),
					),
				),
			),
		),
		'faq_title_style' => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'spacing_style' => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'layout_style'         => array(
							'type'    => 'select',
							'label'   => __( 'Enable Box Style', 'uabb' ),
							'default' => 'no',
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
						'style_border_type'    => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module',
								'property' => 'border-style',
							),
						),
						'style_border'         => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module',
								'property' => 'border-top-width',
								'unit'     => 'px',
							),
						),
						'style_border_radius'  => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '0',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'style_border_color'   => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module',
								'property' => 'border-color',
							),
						),
						'style_background_col' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'f6f6f6',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-layout-box_style .uabb-module-content.uabb-faq-module',
								'property' => 'background',
							),
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
						'row_gap'              => array(
							'type'        => 'unit',
							'label'       => __( 'Row Gap', 'uabb' ),
							'default'     => '10',
							'responsive'  => true,
							'description' => 'px',
						),
						'column_gap'           => array(
							'type'        => 'unit',
							'label'       => __( 'Column Gap', 'uabb' ),
							'default'     => '10',
							'responsive'  => true,
							'description' => 'px',
						),
					),
				),
				'title_style'   => array(
					'title'  => __( 'Question', 'uabb' ),
					'fields' => array(
						'faq_title_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-item .uabb-faq-questions .uabb-faq-question-label',
								'property' => 'color',
							),
						),
						'faq_title_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color/Active Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-faq-question-label',
								'property' => 'color',
							),
						),
						'faq_title_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'f6f6f6',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-questions',
								'property' => 'background',
							),
						),
						'faq_title_bg_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover/Focus Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
						),
						'faq_item_margin'          => array(
							'type'        => 'unit',
							'label'       => __( 'Item Spacing', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'slider'      => true,
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-item',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'faq_item_padding'         => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'slider'      => true,
							'responsive'  => true,
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-questions',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'title_border_type'        => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'border-style',
							),
						),
						'title_border'             => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'border-top-width',
								'unit'     => 'px',
							),
						),
						'title_border_radius'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '0',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'title_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'border-color',
							),
						),
					),
				),
				'answers_style' => array(
					'title'  => __( 'Answers', 'uabb' ),
					'fields' => array(
						'answers_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'color',
							),
						),
						'answers_bg_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'background',
							),
						),
						'answers_padding'       => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'slider'      => true,
							'responsive'  => true,
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'content_border_type'   => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'border-style',
							),
						),
						'content_border'        => array(
							'type'        => 'unit',
							'label'       => __( 'Top Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'border-top-width',
								'unit'     => 'px',
							),
						),
						'content_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '0',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'content_border_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'border-color',
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
							'description' => 'px',
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
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-button-icon',
								'property' => 'color',
							),
						),
						'icon_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color/Active Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
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
					'title'  => __( 'Question', 'uabb' ),
					'fields' => array(
						'tag_selection'    => array(
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
						'font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-faq-question-label',
							),
						),
						'font_size_unit'   => array(
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
								'selector' => '.uabb-faq-question-label',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'line_height_unit' => array(
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
								'selector' => '.uabb-faq-question-label',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'transform'        => array(
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
								'selector' => '.uabb-faq-question-label',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-question-label',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'content_typogrphy' => array(
					'title'  => __( 'Answers', 'uabb' ),
					'fields' => array(
						'content_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-faq-content',
							),
						),
						'content_font_size_unit'   => array(
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
								'selector' => '.uabb-faq-content',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'content_line_height_unit' => array(
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
								'selector' => '.uabb-faq-content',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'content_transform'        => array(
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
								'selector' => '.uabb-faq-content',
								'property' => 'text-transform',
							),
						),
						'content_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-faq-content',
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
								'default'     => __( 'What is a FAQ?', 'uabb' ),
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
