<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Countdown Module
 */

FLBuilder::register_module(
	'UABBCountdownModule', array(
		'general'         => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'timer_type'             => array(
							'type'    => 'select',
							'label'   => __( 'Timer Type', 'uabb' ),
							'default' => 'fixed',
							'class'   => '',
							'options' => array(
								'fixed'     => __( 'Fixed', 'uabb' ),
								'evergreen' => __( 'Evergreen', 'uabb' ),
							),
							'toggle'  => array(
								'fixed'     => array(
									'fields' => array( 'fixed_date', 'fixed_timer_action' ),
								),
								'evergreen' => array(
									'fields' => array( 'evergreen_date', 'evergreen_timer_action' ),
								),
							),
						),
						'time_zone'              => array(
							'type'    => 'timezone',
							'label'   => __( 'Time Zone', 'uabb' ),
							'default' => '',
							'class'   => '',
						),
						'fixed_date'             => array(
							'type'    => 'uabb-normal-date',
							'label'   => __( 'Select Date & Time', 'uabb' ),
							'default' => '',
							'class'   => '',
						),
						'evergreen_date'         => array(
							'type'    => 'uabb-evergreen-date',
							'label'   => __( 'Expire Countdown In', 'uabb' ),
							'default' => '',
							'foo'     => 'bar',
						),
						'fixed_timer_action'     => array(
							'type'    => 'select',
							'label'   => __( 'Action After Timer Expiry', 'uabb' ),
							'default' => 'none',
							'class'   => '',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'hide'     => __( 'Hide Timer', 'uabb' ),
								'msg'      => __( 'Display Message', 'uabb' ),
								'redirect' => __( 'Redirect User to New URL', 'uabb' ),
							),
						),
						'evergreen_timer_action' => array(
							'type'    => 'select',
							'label'   => __( 'Action After Timer Expiry', 'uabb' ),
							'default' => 'none',
							'class'   => '',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'hide'     => __( 'Hide Timer', 'uabb' ),
								'reset'    => __( 'Reset Timer', 'uabb' ),
								'msg'      => __( 'Display Message', 'uabb' ),
								'redirect' => __( 'Redirect User to New URL', 'uabb' ),
							),
						),
						'expire_message'         => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'rows'          => 6,
							'default'       => __( 'Enter message text here.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
						),
						'redirect_link'          => array(
							'type'          => 'link',
							'label'         => __( 'Enter URL', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
						),
					),
				),
				'message' => array(
					'title'  => __( 'Expiry Message Settings', 'uabb' ),
					'fields' => array(
						'message_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-countdown-expire-message',
								'important' => true,
							),
						),
						'message_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Choose Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-countdown-expire-message',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'style'           => array( // Tab.
			'title'    => __( 'Styling', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'align_section' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'counter_alignment'  => array(
							'type'    => 'Align',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'      => 'css',
								'property'  => 'text-align',
								'selector'  => '.uabb-countdown-fixed-timer, .uabb-countdown-evergreen-timer',
								'important' => true,
							),
						),
						'space_between_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Space Between Timer Unit & Digit', 'uabb' ),
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'timer_out_spacing'  => array(
							'type'        => 'unit',
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'label'       => __( 'Space Between Elements', 'uabb' ),
							'help'        => __( 'This option controls the left-right spacing of each Countdown Element.', 'uabb' ),
							'class'       => '',
						),
					),
				),
				'style'         => array( // Section.
					'title'  => __( 'Timer Digit Styling', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'timer_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Digit Area Shape', 'uabb' ),
							'default' => 'normal',
							'class'   => '',
							'options' => array(
								'normal' => __( 'Normal', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'normal' => array(
									'fields' => array( 'normal_options' ),
								),
								'circle' => array(
									'fields' => array( 'digit_area_width', 'digit_border_color', 'timer_background_color', 'timer_background_color_opc', 'digit_area_width_desk', 'digit_area_width_med', 'digit_area_width_small', 'digit_border_width', 'digit_border_style', 'unit_position' ),
								),
								'square' => array(
									'fields' => array( 'digit_area_width', 'digit_border_color', 'timer_background_color', 'timer_background_color_opc', 'digit_area_width_desk', 'digit_area_width_med', 'digit_area_width_small', 'digit_border_width', 'digit_border_style', 'unit_position' ),
								),
								'custom' => array(
									'fields' => array( 'digit_area_width', 'digit_border_color', 'digit_border_radius', 'timer_background_color', 'timer_background_color_opc', 'digit_area_width_desk', 'digit_area_width_med', 'digit_area_width_small', 'digit_border_width', 'digit_border_style', 'unit_position' ),
								),
							),
						),
						'timer_background_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Digit Background Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-countdown-digit-wrapper',
								'important' => true,
							),
						),
						'digit_area_width'       => array(
							'type'        => 'unit',
							'units'       => array( 'px' ),
							'placeholder' => '100',
							'label'       => __( 'Digit Area Width', 'uabb' ),
							'class'       => '',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'digit_border_radius'    => array(
							'type'   => 'unit',
							'label'  => __( 'Digit Border Radius', 'uabb' ),
							'class'  => '',
							'units'  => array( 'px' ),
							'slider' => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'digit_border_style'     => array(
							'type'        => 'select',
							'label'       => __( 'Digit Border Style', 'uabb' ),
							'description' => '',
							'default'     => 'solid',
							'options'     => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
						),
						'digit_border_width'     => array(
							'type'   => 'unit',
							'label'  => __( 'Digit Border Width', 'uabb' ),
							'class'  => '',
							'units'  => array( 'px' ),
							'slider' => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'digit_border_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Digit Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'count_animation'        => array(
							'type'    => 'select',
							'label'   => __( 'On Count Animation', 'uabb' ),
							'default' => 'none',
							'class'   => '',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'flash'  => __( 'Flash', 'uabb' ),
								'shake'  => __( 'Shake', 'uabb' ),
								'bounce' => __( 'Bounce', 'uabb' ),
								'pulse'  => __( 'Pulse', 'uabb' ),
							),
						),
					),
				),
				'unit_style'    => array( // Section.
					'title'  => __( 'Timer Unit Styling', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'unit_position'   => array(
							'type'    => 'select',
							'label'   => __( 'Timer Unit Position', 'uabb' ),
							'default' => 'outside',
							'class'   => '',
							'options' => array(
								'inside'  => __( 'Inside Digit Area', 'uabb' ),
								'outside' => __( 'Outside Digit Area', 'uabb' ),
							),
							'toggle'  => array(
								'inside'  => array(
									'fields' => array( 'inside_options' ),
								),
								'outside' => array(
									'fields' => array( 'outside_options' ),
								),
							),
						),
						'inside_options'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Position', 'uabb' ),
							'default' => 'in_below',
							'class'   => '',
							'options' => array(
								'in_below' => __( 'Below Digit', 'uabb' ),
								'in_above' => __( 'Above Digit', 'uabb' ),
							),
						),
						'outside_options' => array(
							'type'    => 'select',
							'label'   => __( 'Select Position', 'uabb' ),
							'default' => 'in_below',
							'class'   => '',
							'options' => array(
								'out_below' => __( 'Below Digit', 'uabb' ),
								'out_above' => __( 'Above Digit', 'uabb' ),
								'out_right' => __( 'Right Side of Digit', 'uabb' ),
								'out_left'  => __( 'Left Side of Digit', 'uabb' ),
							),
						),
						'normal_options'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Position', 'uabb' ),
							'default' => 'normal_below',
							'class'   => '',
							'options' => array(
								'normal_below' => __( 'Below Digit', 'uabb' ),
								'normal_above' => __( 'Above Digit', 'uabb' ),
							),
						),
					),
				),
				'timer_string'  => array( // Section.
					'title'  => __( 'Timer Strings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'year_string'           => array(
							'type'        => 'select',
							'label'       => __( 'Years', 'uabb' ),
							'description' => '',
							'default'     => 'Y',
							'options'     => array(
								'Y' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'year_custom_label'     => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'year_plural_label'     => array(
							'type'        => 'text',
							'label'       => __( 'Years Label ( Plural )', 'uabb' ),
							'placeholder' => __( 'Years', 'uabb' ),
							'description' => '',
						),
						'year_singular_label'   => array(
							'type'        => 'text',
							'label'       => __( 'Year Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Year', 'uabb' ),
						),


						// Months.
						'month_string'          => array(
							'type'        => 'select',
							'label'       => __( 'Months', 'uabb' ),
							'description' => '',
							'default'     => 'O',
							'options'     => array(
								'O' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'month_custom_label'    => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'month_plural_label'    => array(
							'type'        => 'text',
							'label'       => __( 'Months Label ( Plural )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Months', 'uabb' ),
						),
						'month_singular_label'  => array(
							'type'        => 'text',
							'label'       => __( 'Month Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Month', 'uabb' ),
						),

						// Days.
						'day_string'            => array(
							'type'        => 'select',
							'label'       => __( 'Days', 'uabb' ),
							'description' => '',
							'default'     => 'D',
							'options'     => array(
								'D' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'day_custom_label'      => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'day_plural_label'      => array(
							'type'        => 'text',
							'label'       => __( 'Days Label ( Plural )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Days', 'uabb' ),
						),
						'day_singular_label'    => array(
							'type'        => 'text',
							'label'       => __( 'Day Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Day', 'uabb' ),
						),

						// Hours.
						'hour_string'           => array(
							'type'        => 'select',
							'label'       => __( 'Hours', 'uabb' ),
							'description' => '',
							'default'     => 'H',
							'options'     => array(
								'H' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'hour_custom_label'     => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'hour_plural_label'     => array(
							'type'        => 'text',
							'label'       => __( 'Hours Label ( Plural )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Hours', 'uabb' ),
						),
						'hour_singular_label'   => array(
							'type'        => 'text',
							'label'       => __( 'Hour Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Hour', 'uabb' ),
						),

						// Minutes.
						'minute_string'         => array(
							'type'        => 'select',
							'label'       => __( 'Minutes', 'uabb' ),
							'description' => '',
							'default'     => 'M',
							'options'     => array(
								'M' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'minute_custom_label'   => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'minute_plural_label'   => array(
							'type'        => 'text',
							'label'       => __( 'Minutes Label ( Plural )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Minutes', 'uabb' ),
						),
						'minute_singular_label' => array(
							'type'        => 'text',
							'label'       => __( 'Minute Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Minute', 'uabb' ),
						),

						// Seconds.
						'second_string'         => array(
							'type'        => 'select',
							'label'       => __( 'Seconds', 'uabb' ),
							'description' => '',
							'default'     => 'S',
							'options'     => array(
								'S' => __( 'Enable', 'uabb' ),
								''  => __( 'Disable', 'uabb' ),
							),
						),
						'second_custom_label'   => array(
							'type'        => 'select',
							'label'       => __( 'Custom Label', 'uabb' ),
							'description' => '',
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'second_plural_label'   => array(
							'type'        => 'text',
							'label'       => __( 'Seconds Label ( Plural )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Seconds', 'uabb' ),
						),
						'second_singular_label' => array(
							'type'        => 'text',
							'label'       => __( 'Second Label ( Singular )', 'uabb' ),
							'description' => '',
							'placeholder' => __( 'Second', 'uabb' ),
						),
					),
				),
			),
		),
		'countdown_style' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'digit_typography' => array(
					'title'  => __( 'Timer Digit', 'uabb' ),
					'fields' => array(
						'digit_tag_selection' => array(
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
						'digit_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-count-down-digit',
								'important' => true,
							),
						),
						'digit_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Choose Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-count-down-digit',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'unit_typography'  => array(
					'title'  => __( 'Timer Unit', 'uabb' ),
					'fields' => array(
						'unit_tag_selection' => array(
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
						'unit_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-count-down-unit',
								'important' => true,
							),
						),
						'unit_color'         => array(
							'type'       => 'color',
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'label'      => __( 'Choose Color', 'uabb' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-count-down-unit',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
