<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB How to Module
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
							'default'     => 'How to configure HowTo Schema in UABB ?',
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
							'help'    => __( 'How much Cost of this process.', 'uabb' ),
						),
						'currency_iso_code'   => array(
							'type'        => 'text',
							'label'       => __( 'Country ISO Code', 'uabb' ),
							'default'     => 'USD',
							'size'        => 5,
							'connections' => array( 'string', 'html' ),
							'description' => __( '<span style="font-size:15px;">Click <a href="https://en.wikipedia.org/wiki/List_of_circulating_currencies" target="_blank" rel="noopener"><b>here</b> to find your country\'s ISO code.</a></span>', 'uabb' ),
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
							'label'       => __( 'Tool', 'uabb' ),
							'multiple'    => true,
							'default'     => array( ' - A Computer.', ' - Internet connection.', ' - Google Structured data testing Tool.' ),
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
							'default'     => 'Steps to configure the How-to module: ',
							'connections' => array( 'string', 'html' ),
						),
						'step_data'          => array(
							'type'         => 'form',
							'label'        => __( 'Step', 'uabb' ),
							'form'         => 'uabb_how_to_steps',
							'default'      => array(
								array(
									'step_title'       => 'Step 1 : Enter the HowTo schema title you want.',
									'step_description' => '    Enter the title to your HowTo Schema',
								),
								array(
									'step_title'       => 'Step 2 : Enter the HowTo schema Description and Add a relevant Image.',
									'step_description' => '    Enter the HowTo Description with a relevant image to your description.',
								),
								array(
									'step_title'       => 'Step 3 : Configure the Advanced settings. ie Total Time, Extimated Cost, Supply, Title',
									'step_description' => '   Under the Advanced settings for HowTo Schema
														        - Total Time required to perform all the given instructions.
														        - Estimated Cost for the consumables/ supplies needed for the  instructions.
														        - Supply needed to be consumed when performing the actions/directions.
														        - A Tool used but not consumed for the operation.',
								),
								array(
									'step_title'       => 'Step 4 : Enter the Steps for your HowTo schema. ',
									'step_description' => '    Steps for your HowTo Schema instructions it can be a single step (text, document or video) or an ordered list of steps (itemList) of HowToStep.',
								),
								array(
									'step_title'       => 'Step 5 : Manage the Styling and Typography of the module. ',
									'step_description' => '    Style your HowTo Schema with various styling options to display your HowTo Schema.',
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
						'box_align'    => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
						),
						'box_bg_color' => array(
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
						'box_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '40',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'box_border'   => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-container',
								'property' => 'border',
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
							'type'       => 'unit',
							'label'      => __( 'Margin Bottom', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Margin Bottom', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Width', 'uabb' ),
							'default'    => '',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image img',
								'property' => 'width',
							),
						),
						'image_align'         => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => '',
						),
						'image_padding'       => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image',
								'property' => 'padding',
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
						'image_border'        => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-image img',
								'property' => 'border',
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
							'type'       => 'unit',
							'label'      => __( 'Total Time Margin Bottom', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Estimated Cost Margin Bottom', 'uabb' ),
							'default'    => '25',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Supply Title Margin Bottom', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Supply Text Spacing', 'uabb' ),
							'default'    => '0',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Tool Title Margin Bottom', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Tool Text Spacing', 'uabb' ),
							'default'    => '0',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'type'       => 'unit',
							'label'      => __( 'Section Title Margin Bottom', 'uabb' ),
							'default'    => '20',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'steps_spacing'             => array(
							'type'       => 'unit',
							'label'      => __( 'Steps Spacing', 'uabb' ),
							'default'    => '15',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
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
							'slider'     => true,
							'responsive' => true,
						),
						'step_image_spacing'        => array(
							'type'       => 'unit',
							'label'      => __( 'Image Spacing', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
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
							'type'       => 'unit',
							'label'      => __( 'Step Title Margin Bottom', 'uabb' ),
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
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
						'title_tag'        => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h1',
							'options' => array(
								'h1' => 'H1',
								'h2' => 'H2',
								'h3' => 'H3',
								'h4' => 'H4',
								'h5' => 'H5',
								'h6' => 'H6',
							),
						),
						'title_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-title',
							),
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-description',
							),
						),
					),
				),
				'advanced_typography'    => array(
					'title'  => __( 'Advanced Options', 'uabb' ),
					'fields' => array(
						'total_time_typography'     => array(
							'type'       => 'typography',
							'label'      => __( 'Total Time Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-total-time',
							),
						),
						'estimated_cost_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Estimated Cost Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-estimated-cost',
							),
						),
						'supply_title_tag'          => array(
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
						'supply_title_typography'   => array(
							'type'       => 'typography',
							'label'      => __( 'Supply Title Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-supply-title',
							),
						),
						'supply_text_typography'    => array(
							'type'       => 'typography',
							'label'      => __( 'Supply Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-supply',
							),
						),
						'tool_title_tag'            => array(
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
						'tool_title_typography'     => array(
							'type'       => 'typography',
							'label'      => __( 'Tool Title Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-tool-title',
							),
						),
						'tool_text_typography'      => array(
							'type'       => 'typography',
							'label'      => __( 'Tool Text Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-tool',
							),
						),
					),
				),
				'step_typography'        => array(
					'title'  => __( 'Steps', 'uabb' ),
					'fields' => array(
						'step_section_title_tag'        => array(
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
						'step_section_title_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Section Title Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-section-title',
							),
						),
						'step_title_typography'         => array(
							'type'       => 'typography',
							'label'      => __( 'Step Title Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-title',
							),
						),
						'step_description_typography'   => array(
							'type'       => 'typography',
							'label'      => __( 'Step Description Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-how-to-step-description',
							),
						),
					),
				),
			),
		),
		'uabb_docs'      => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/introducing-how-to-schema-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=how-to-schema-module" target="_blank" rel="noopener"> Getting started article </a> </li>
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
