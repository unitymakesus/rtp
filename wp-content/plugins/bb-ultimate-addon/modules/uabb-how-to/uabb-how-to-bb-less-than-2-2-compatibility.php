<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB How To Module
 */

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBHowTo',
	array(
		'general'        => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'         => array(
					'title'  => 'General Settings',
					'fields' => array(
						'uabb_how_to_title' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'default'     => 'How to configure How To Schema in UABB ?',
						),
						'description'       => array(
							'type'        => 'editor',
							'label'       => '',
							'rows'        => 1,
							'connections' => array( 'string', 'html', 'url' ),
							'default'     => 'So to get started, you will just need to drag-n-drop the How-to module in the Beaver Builder editor.
The How-to module can basically be used on How-to pages which contains a How-to in their title and contains steps to achieve certain requirements.',
						),
						'image'             => array(
							'type'        => 'photo',
							'label'       => __( 'Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'show_advanced'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Advanced Options', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'advanced_option', 'advanced_style', 'advanced_typography' ),
								),
							),
						),
					),
				),
				'advanced_option' => array(
					'title'  => __( 'Advanced Settings', 'uabb' ),
					'fields' => array(
						'total_time_text'     => array(
							'type'        => 'text',
							'label'       => __( 'Total Time Text', 'uabb' ),
							'default'     => 'Time Needed:',
							'connections' => array( 'string', 'html' ),
						),
						'total_time'          => array(
							'type'    => 'unit',
							'label'   => __( 'Total Time', 'uabb' ),
							'units'   => array( 'minutes' ),
							'default' => '30',
							'help'    => __( 'How much time this process will take in Minutes.', 'uabb' ),
						),
						'estimated_cost_text' => array(
							'type'        => 'text',
							'label'       => __( 'Estimated Cost Text', 'uabb' ),
							'default'     => 'Total Cost:',
							'connections' => array( 'string', 'html' ),
						),
						'estimated_cost'      => array(
							'type'    => 'unit',
							'label'   => __( 'Estimated cost', 'uabb' ),
							'default' => '69',
							'help'    => __( 'How much Cost of this.', 'uabb' ),
						),
						'currency_iso_code'   => array(
							'type'        => 'text',
							'label'       => __( 'Country ISO Code', 'uabb' ),
							'default'     => 'USD',
							'size'        => 5,
							'connections' => array( 'string', 'html' ),
							'description' => __( 'For your country ISO code <a href="https://en.wikipedia.org/wiki/List_of_circulating_currencies" target="_blank" rel="noopener"><b style="color: #0000ff;">Click here</b></a>', 'uabb' ),
						),
						'add_supply'          => array(
							'type'    => 'select',
							'label'   => __( 'Add Supply', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'supply_title', 'uabb_supply', 'supply_title_color', 'supply_title_margin', 'supply_text_color', 'supply_text_margin', 'supply_title_typography', 'supply_text_typography', 'supply_title_tag' ),
								),
							),
						),
						'supply_title'        => array(
							'type'        => 'text',
							'label'       => __( 'Supply Title', 'uabb' ),
							'default'     => 'Things Needed ?',
							'connections' => array( 'string', 'html' ),
						),
						'uabb_supply'         => array(
							'type'        => 'text',
							'connections' => array( 'string', 'html' ),
							'label'       => __( 'Supply', 'uabb' ),
							'default'     => array( ' - A WordPress Website.', ' - Beaver builder plugin.', ' - UABB Plugin' ),
							'multiple'    => true,
							'connections' => array( 'string', 'html' ),
						),
						'add_tool'            => array(
							'type'    => 'select',
							'label'   => __( 'Add Tools', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'tool_title', 'uabb_tool', 'tool_title_color', 'tool_title_margin', 'tool_text_color', 'tool_text_margin', 'tool_title_typography', 'tool_text_typography', 'tool_title_tag' ),
								),
							),
						),
						'tool_title'          => array(
							'type'        => 'text',
							'label'       => __( 'Tool Title', 'uabb' ),
							'default'     => 'Required tools:',
							'connections' => array( 'string', 'html' ),
						),
						'uabb_tool'           => array(
							'type'        => 'text',
							'connections' => array( 'string', 'html' ),
							'label'       => __( 'Tool', 'uabb' ),
							'default'     => array( ' - A Computer.', ' - Internet connection.', ' - Google Structured data testing Tool.' ),
							'multiple'    => true,
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'step_form'       => array(
					'title'  => __( 'Steps', 'uabb' ),
					'fields' => array(
						'step_section_title' => array(
							'type'        => 'text',
							'label'       => __( 'Section Title', 'uabb' ),
							'default'     => 'Steps to configure the How To module: ',
							'connections' => array( 'string', 'html' ),
						),
						'step_data'          => array(
							'type'         => 'form',
							'label'        => __( 'Add Steps', 'uabb' ),
							'form'         => 'uabb_how_to_steps',
							'default'      => array(
								array(
									'step_title'       => 'Step 1 : Enter the How To schema title you want.',
									'step_description' => '    Enter the title to your How To Schema',
								),
								array(
									'step_title'       => 'Step 2 : Enter the How To schema Description and Add a relevant Image.',
									'step_description' => '    Enter the How To Description with a relevant image to your description.',
								),
								array(
									'step_title'       => 'Step 3 : Configure the Advanced settings. ie Total Time, Extimated Cost, Supply, Title',
									'step_description' => '   Under the Advanced settings for How To Schema
														        - Total Time required to perform all the given instructions.
														        - Estimated Cost for the consumables/ supplies needed for the  instructions.
														        - Supply needed to be consumed when performing the actions/directions.
														        - A Tool used but not consumed for the operation.',
								),
								array(
									'step_title'       => 'Step 4 : Enter the Steps for your How To schema. ',
									'step_description' => '    Steps for your How to Schema instructions it can be a single step (text, document or video) or an ordered list of steps (itemList) of HowToStep.',
								),
								array(
									'step_title'       => 'Step 5 : Manage the Styling and Typography of the module. ',
									'step_description' => '    Style your How to Schema with various styling options to display your How to Schema.',
								),
							),
							'preview_text' => 'step_title',
							'multiple'     => true,

						),
					),
				),
			),
		),
		'style_tab'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'box_style'         => array(
					'title'  => __( 'Box Style', 'uabb' ),
					'fields' => array(
						'box_align'        => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'help'    => __( 'The overall alignment of Box', 'uabb' ),
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'box_bg_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '#f5f5f5',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'background-color',
							),
						),
						'box_padding'      => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'default'     => '40',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'box_border_style' => array(
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
								'selector' => '.uabb-how-to-container',
								'property' => 'border-style',
							),
						),
						'box_border_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'box_border_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'border-color',
							),
						),
					),
				),
				'title_style'       => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
								'property' => 'color',
							),
						),
						'title_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'default'     => '20',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'description_style' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
								'property' => 'color',
							),
						),
						'description_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'image_style'       => array(
					'title'  => __( 'Image', 'uabb' ),
					'fields' => array(
						'image_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image img',
								'property' => 'width',
							),
						),
						'image_align'         => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'help'    => __( 'The overall alignment of Image', 'uabb' ),
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'image_padding'       => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'image_border_style'  => array(
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
								'selector' => '.uabb-how-to-image img',
								'property' => 'border-style',
							),
						),
						'image_border_width'  => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image img',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'image_margin_bottom' => array(
							'type'       => 'unit',
							'label'      => __( 'Image Margin Bottom', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'image_border_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image img',
								'property' => 'border-color',
							),
						),
					),
				),
				'advanced_style'    => array(
					'title'  => __( 'Advanced Options', 'uabb' ),
					'fields' => array(
						'total_time_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Total Time Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
								'property' => 'color',
							),
						),
						'total_time_margin'         => array(
							'type'        => 'unit',
							'label'       => __( 'Total Time Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'estimated_cost_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Estimated Cost Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
								'property' => 'color',
							),
						),
						'estimated_cost_margin'     => array(
							'type'        => 'unit',
							'label'       => __( 'Estimated Cost Margin Bottom', 'uabb' ),
							'default'     => '25',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'supply_title_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Supply Title Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
								'property' => 'color',
							),
						),
						'supply_title_margin'       => array(
							'type'        => 'unit',
							'label'       => __( 'Supply Title Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'supply_text_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Supply Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
								'property' => 'color',
							),
						),
						'supply_text_margin'        => array(
							'type'        => 'unit',
							'label'       => __( 'Supply Text Spacing', 'uabb' ),
							'default'     => '0',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'supply_text_margin_bottom' => array(
							'type'       => 'unit',
							'label'      => __( 'Supply Text Margin Bottom', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'tool_title_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Tool Title Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
								'property' => 'color',
							),
						),
						'tool_title_margin'         => array(
							'type'        => 'unit',
							'label'       => __( 'Tool Title Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'tool_text_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Tool Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
								'property' => 'color',
							),
						),
						'tool_text_margin'          => array(
							'type'        => 'unit',
							'label'       => __( 'Tool Text Spacing', 'uabb' ),
							'default'     => '0',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'tool_text_margin_bottom'   => array(
							'type'       => 'unit',
							'label'      => __( 'Tool Text Margin Bottom', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'step_style'        => array(
					'title'  => __( 'Steps', 'uabb' ),
					'fields' => array(
						'step_section_title_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Section Title Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
								'property' => 'color',
							),
						),
						'step_section_title_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Section Title Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'steps_spacing'             => array(
							'type'        => 'unit',
							'label'       => __( 'Steps Spacing', 'uabb' ),
							'default'     => '30',
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'step_image_width'          => array(
							'type'       => 'unit',
							'label'      => __( 'Image Width', 'uabb' ),
							'default'    => '40',
							'units'      => array( '%' ),
							'responsive' => true,
						),
						'step_image_spacing'        => array(
							'type'        => 'unit',
							'label'       => __( 'Image Spacing', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
						),
						'step_image_align'          => array(
							'type'    => 'select',
							'label'   => __( 'Image Alignment', 'uabb' ),
							'default' => 'row',
							'options' => array(
								'row'         => 'Right',
								'row-reverse' => 'Left',
								'column'      => 'Bottom',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-wrap',
								'property' => 'flex-direction',
							),
						),
						'step_title_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Step Title Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-title',
								'property' => 'color',
							),
						),
						'step_title_margin'         => array(
							'type'        => 'unit',
							'label'       => __( 'Step Title Margin Bottom', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => true,
						),
						'step_description_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Step Description Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-description',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
		'typography_tab' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typography'       => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-title',
							),
						),
						'title_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
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
						'title_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
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
						'title_transform'        => array(
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
								'selector' => '.uabb-how-to-title',
								'property' => 'text-transform',
							),
						),
						'title_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-description',
							),
						),
						'description_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
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
						'description_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
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
						'description_transform'        => array(
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
								'selector' => '.uabb-how-to-description',
								'property' => 'text-transform',
							),
						),
						'description_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'advanced_typography'    => array(
					'title'  => __( 'Advanced Options', 'uabb' ),
					'fields' => array(
						'total_time_font_family'          => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-total-time',
							),
						),
						'total_time_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
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
						'total_time_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
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
						'total_time_transform'            => array(
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
								'selector' => '.uabb-how-to-total-time',
								'property' => 'text-transform',
							),
						),
						'total_time_letter_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'estimated_cost_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-estimated-cost',
							),
						),
						'estimated_cost_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
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
						'estimated_cost_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
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
						'estimated_cost_transform'        => array(
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
								'selector' => '.uabb-how-to-estimated-cost',
								'property' => 'text-transform',
							),
						),
						'estimated_cost_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'supply_title_tag'                => array(
							'type'    => 'select',
							'label'   => __( 'Supply Title HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
						),
						'supply_title_font_family'        => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-supply-title',
							),
						),
						'supply_title_font_size_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
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
						'supply_title_line_height_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
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
						'supply_title_transform'          => array(
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
								'selector' => '.uabb-how-to-supply-title',
								'property' => 'text-transform',
							),
						),
						'supply_title_letter_spacing'     => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'supply_text_font_family'         => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-supply',
							),
						),
						'supply_text_font_size_unit'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
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
						'supply_text_line_height_unit'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
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
						'supply_text_transform'           => array(
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
								'selector' => '.uabb-supply',
								'property' => 'text-transform',
							),
						),
						'supply_text_letter_spacing'      => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'tool_title_tag'                  => array(
							'type'    => 'select',
							'label'   => __( 'Tool Title HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
						),
						'tool_title_font_family'          => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-tool-title',
							),
						),
						'tool_title_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
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
						'tool_title_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
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
						'tool_title_transform'            => array(
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
								'selector' => '.uabb-how-to-tool-title',
								'property' => 'text-transform',
							),
						),
						'tool_title_letter_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'tool_text_font_family'           => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-tool',
							),
						),
						'tool_text_font_size_unit'        => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
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
						'tool_text_line_height_unit'      => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
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
						'tool_text_transform'             => array(
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
								'selector' => '.uabb-tool',
								'property' => 'text-transform',
							),
						),
						'tool_text_letter_spacing'        => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'step_typography'        => array(
					'title'  => __( 'Steps', 'uabb' ),
					'fields' => array(
						'step_section_title_tag'          => array(
							'type'    => 'select',
							'label'   => __( 'Step Section Title HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
						),
						'step_section_title_font_family'  => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-step-section-title',
							),
						),
						'step_section_title_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
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
						'step_section_title_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
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
						'step_section_title_transform'    => array(
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
								'selector' => '.uabb-how-to-step-section-title',
								'property' => 'text-transform',
							),
						),
						'step_section_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'step_title_font_family'          => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-step-title',
							),
						),
						'step_title_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-title',
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
						'step_title_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-title',
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
						'step_title_transform'            => array(
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
								'selector' => '.uabb-how-to-step-title',
								'property' => 'text-transform',
							),
						),
						'step_title_letter_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'step_description_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-how-to-step-description',
							),
						),
						'step_description_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-description',
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
						'step_description_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-description',
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
						'step_description_transform'      => array(
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
								'selector' => '.uabb-how-to-step-description',
								'property' => 'text-transform',
							),
						),
						'step_description_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-description',
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
	'uabb_how_to_steps',
	array(
		'title' => __( 'Add Step', 'uabb' ),
		'tabs'  => array(
			'step_general' => array(
				'title'    => __( 'Step', 'uabb' ),
				'sections' => array(
					'step_general' => array(
						'title'       => '',
						'description' => $notice,
						'fields'      => array(
							'step_title'       => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'step_description' => array(
								'type'        => 'editor',
								'label'       => __( 'Description', 'uabb' ),
								'rows'        => 2,
								'connections' => array( 'string', 'html', 'url' ),
							),
							'step_image'       => array(
								'type'        => 'photo',
								'label'       => __( 'Image', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
							'step_link'        => array(
								'type'          => 'link',
								'label'         => __( 'Link', 'uabb' ),
								'connections'   => array( 'url' ),
								'show_target'   => true,
								'show_nofollow' => true,
							),
						),
					),
				),
			),
		),
	)
);

