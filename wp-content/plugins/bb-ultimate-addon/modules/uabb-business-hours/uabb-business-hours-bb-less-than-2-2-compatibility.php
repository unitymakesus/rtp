<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
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
						'days_alignment'          => array(
							'type'    => 'select',
							'label'   => __( 'Day Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-day',
								'property' => 'text-align',
							),
						),
						'hours_alignment'         => array(
							'type'    => 'select',
							'label'   => __( 'Hours Alignment', 'uabb' ),
							'default' => 'right',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours',
								'property' => 'text-align',
							),
						),
						'row_spacing'             => array(
							'type'        => 'dimension',
							'label'       => 'Spacing',
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '10',
									'medium'     => '24',
									'responsive' => '16',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-wrap',
								'property' => 'padding',
								'unit'     => 'px',
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
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property' => 'border-top-style',
							),
						),
						'divider_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Divider Color', 'uabb' ),
							'default'    => 'dddddd',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property' => 'border-color',
							),
						),
						'divider_weight'          => array(
							'type'        => 'unit',
							'label'       => __( 'Divider Weight', 'uabb' ),
							'description' => 'px',
							'size'        => '5',
							'default'     => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container .uabb-business-hours-wrap:not(:first-child)',
								'property' => 'border-top-width',
								'unit'     => 'px',

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
								'type'     => 'css',
								'selector' => '.uabb-business-hours-wrap:nth-child(odd)',
								'property' => 'background-color',
							),
						),
						'striped_even_rows_color' => array(
							'type'       => 'color',
							'label'      => __( 'Striped Even Rows Color', 'uabb' ),
							'default'    => 'FFFFFF',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-wrap:nth-child(even)',
								'property' => 'background-color',
							),
						),
					),
				),
				'business_row_divider'   => array(
					'General' => '',
					'title'   => __( 'Box', 'uabb' ),
					'fields'  => array(
						'box_padding'          => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'background_color_all' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'FAFAFA',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container',
								'property' => 'background-color',
							),
						),
						'border_style_all'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Type', 'uabb' ),
							'default' => 'None',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'border_width', 'border_color' ),
								),
								'dotted' => array(
									'fields' => array( 'border_width', 'border_color' ),
								),
								'dashed' => array(
									'fields' => array( 'border_width', 'border_color' ),
								),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container',
								'property' => 'border-style',
							),
						),
						'border_width'         => array(
							'type'        => 'dimension',
							'label'       => __( 'Width', 'uabb' ),
							'size'        => '5',
							'default'     => '1',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => 'dddddd',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container',
								'property' => 'border-color',
							),
						),
						'border_radius'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours-container',
								'property' => 'border-radius',
								'unit'     => 'px',
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
						'days_font'            => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-business-day',
							),
						),
						'days_new_font_size'   => array(
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
								'selector' => '.uabb-business-day',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'days_new_line_height' => array(
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
								'selector' => '.uabb-business-day',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'days_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-business-day:not(.uabb-business-day-highlight)',
							),
						),
						'days_transform'       => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-day',
								'property' => 'text-transform',
							),
						),
						'days_decoration'      => array(
							'type'    => 'select',
							'label'   => __( 'Decoration', 'uabb' ),
							'default' => '',
							'options' => array(
								'none'         => __( 'None', 'uabb' ),
								'underline'    => __( 'Underline', 'uabb' ),
								'overline'     => __( 'Overline', 'uabb' ),
								'line-through' => __( 'Line Through', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-day',
								'property' => 'text-decoration',
							),
						),
						'days_letter_spacing'  => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-day',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'hours_typo' => array(
					'title'  => __( 'Hours', 'uabb' ),
					'fields' => array(
						'hours_font'            => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-business-hours',
							),
						),
						'hours_new_font_size'   => array(
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
								'selector' => '.uabb-business-hours',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'hours_new_line_height' => array(
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
								'selector' => '.uabb-business-hours',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'hours_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-business-hours:not(.uabb-business-hours-highlight)',
							),
						),
						'hours_transform'       => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours',
								'property' => 'text-transform',
							),

						),
						'hours_decoration'      => array(
							'type'    => 'select',
							'label'   => __( 'Decoration', 'uabb' ),
							'default' => '',
							'options' => array(
								'none'         => __( 'None', 'uabb' ),
								'underline'    => __( 'Underline', 'uabb' ),
								'overline'     => __( 'Overline', 'uabb' ),
								'line-through' => __( 'Line Through', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours',
								'property' => 'text-decoration',
							),
						),
						'hours_letter_spacing'  => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-business-hours',
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
