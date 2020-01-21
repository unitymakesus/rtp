<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Business Hours Module
 */

FLBuilder::register_module(
	'UABBBusinessHours', array(
		'business-hours-info'       => array(
			'title'    => __( 'Content', 'uabb' ),
			'sections' => array(
				'info_list_general' => array(
					'title'  => '',
					'fields' => array(
						'businessHours' => array(
							'type'         => 'form',
							'label'        => __( 'Day', 'uabb' ),
							'form'         => 'uabb_business_hours_form',
							'preview_text' => 'days',
							'multiple'     => true,
							'default'      => array(
								array(
									'days'  => 'Monday',
									'hours' => '8:30 AM - 7:30 PM',
								),
								array(
									'days'  => 'Tuesday',
									'hours' => '8:30 AM - 7:30 PM',
								),
								array(
									'days'  => 'Wednesday',
									'hours' => '8:30 AM - 7:30 PM',
								),
								array(
									'days'  => 'Thursday',
									'hours' => '8:30 AM - 7:30 PM',
								),
								array(
									'days'  => 'Friday',
									'hours' => '8:30 AM - 7:30 PM',
								),
								array(
									'days'  => 'Saturday',
									'hours' => 'Closed',
								),
								array(
									'days'  => 'Sunday',
									'hours' => 'Closed',
								),
							),
						),
					),
				),
			),
		),
		'business-style'            => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'business_style_spacing' => array(
					'General' => '',
					'title'   => __( 'Row', 'uabb' ),
					'fields'  => array(
						'row_spacing'             => array(
							'type'    => 'dimension',
							'label'   => 'Spacing',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-wrap',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'row_divider'             => array(
							'type'    => 'select',
							'label'   => __( 'Divider', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'divider_style', 'divider_color', 'divider_weight' ),
								),
							),
						),
						'divider_style'           => array(
							'type'    => 'select',
							'label'   => __( 'Divider Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property'  => 'border-top-style',
								'important' => true,
							),
						),
						'divider_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Divider Color', 'uabb' ),
							'default'    => 'dddddd',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'divider_weight'          => array(
							'type'    => 'unit',
							'label'   => __( 'Divider Weight', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'default' => '1',
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property'  => 'border-top-width',
								'unit'      => 'px',
								'important' => true,

							),
						),
						'striped_effect'          => array(
							'type'    => 'select',
							'label'   => __( 'Striped Effect', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'striped_odd_rows_color', 'striped_even_rows_color' ),
								),
							),
						),
						'striped_odd_rows_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Striped Odd Rows Color', 'uabb' ),
							'default'    => 'eaeaea',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-wrap:nth-child(odd)',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'striped_even_rows_color' => array(
							'type'       => 'color',
							'label'      => __( 'Striped Even Rows Color', 'uabb' ),
							'default'    => 'FFFFFF',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-wrap:nth-child(even)',
								'property'  => 'background-color',
								'important' => true,
							),
						),
					),
				),
				'business_row_divider'   => array(
					'General' => '',
					'title'   => __( 'Box', 'uabb' ),
					'fields'  => array(
						'box_padding'          => array(
							'type'    => 'dimension',
							'label'   => __( 'Padding', 'uabb' ),
							'slider'  => true,
							'default' => '10',
							'units'   => array( 'px' ),
						),
						'background_color_all' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'FAFAFA',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-container',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'border'               => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours-container',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'business-hours-typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'day_typo'   => array(
					'title'  => __( 'Day', 'uabb' ),
					'fields' => array(
						'day_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-day',
								'important' => true,
							),
						),
						'days_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-business-day:not(.uabb-business-day-highlight)',
								'important' => true,
							),
						),
					),
				),
				'hours_typo' => array(
					'title'  => __( 'Hours', 'uabb' ),
					'fields' => array(
						'hour_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-business-hours',
								'important' => true,
							),
						),
						'hours_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-business-hours:not(.uabb-business-hours-highlight)',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'                 => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/business-hours-module-in-uabb/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-hours-module" target="_blank" rel="noopener"> Getting started article </a> </li>
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
	'uabb_business_hours_form', array(
		'title' => __( 'Add Hours Data', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'business_hours_title_section'   => array(
						'title'  => __( 'Title', 'uabb' ),
						'fields' => array(
							'days'  => array(
								'type'        => 'text',
								'label'       => __( 'Enter Day', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'hours' => array(
								'type'        => 'text',
								'label'       => __( 'Enter Time', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'business_hours_styling_section' => array(
						'title'  => __( 'Styling', 'uabb' ),
						'fields' => array(
							'highlight_styling' => array(
								'type'    => 'select',
								'label'   => __( 'Style This Day', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'day_color', 'hour_color', 'background_color' ),
									),
								),
							),
							'day_color'         => array(
								'type'       => 'color',
								'label'      => __( 'Day Color', 'uabb' ),
								'default'    => 'db6159',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'hour_color'        => array(
								'type'       => 'color',
								'label'      => __( 'Time Color', 'uabb' ),
								'default'    => 'db6159',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'background_color'  => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
							),
						),
					),
				),
			),
		),
	)
);
