<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Counter Module
 */

FLBuilder::register_module(
	'UABBNumbersModule',
	array(
		'general'    => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				/* Counter Genral Setting */
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'layout'              => array(
							'type'    => 'select',
							'label'   => __( 'Counter Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'Only Numbers', 'uabb' ),
								'circle'      => __( 'Circle Counter', 'uabb' ),
								'semi-circle' => __( 'Semicircle Counter', 'uabb' ),
								'bars'        => __( 'Bars Counter', 'uabb' ),
							),
							'toggle'  => array(
								'default'     => array(
									'sections' => array( 'separator', 'overall_structure' ),
									'tabs'     => array( 'imageicon' ),
									'fields'   => array( 'align', 'number_top_margin', 'before_number_text', 'after_number_text' ),
								),
								'circle'      => array(
									'sections' => array( 'circle_bar_style', 'separator', 'overall_structure' ),
									'tabs'     => array( 'imageicon' ),
									'fields'   => array( 'align', 'number_top_margin', 'before_number_text', 'after_number_text' ),
								),
								'bars'        => array(
									'sections' => array( 'bar_style' ),
									'fields'   => array( 'number_position', 'number_top_margin', 'before_number_text', 'after_number_text' ),
								),
								'semi-circle' => array(
									'sections' => array( 'circle_bar_style', 'overall_structure' ),
									'fields'   => array( 'align', 'before_counter_text', 'after_counter_text' ),
								),
							),
						),
						'number_type'         => array(
							'type'    => 'select',
							'label'   => __( 'Number Range', 'uabb' ),
							'default' => 'percent',
							'options' => array(
								'percent'  => __( 'In Percentage ( Out of 100% )', 'uabb' ),
								'standard' => __( 'Custom Range ( Define your own range )', 'uabb' ),
							),
							'toggle'  => array(
								'standard' => array(
									'fields' => array( 'number_prefix', 'number_suffix', 'number_format' ),
								),
							),
						),
						'number'              => array(
							'type'        => 'unit',
							'label'       => __( 'Counter Number', 'uabb' ),
							'size'        => '5',
							'placeholder' => '100',
							'help'        => 'Enter counter value',
							'connections' => array( 'html' ),

						),
						'max_number'          => array(
							'type'        => 'unit',
							'label'       => __( 'Out Off', 'uabb' ),
							'size'        => '5',
							'help'        => __( 'The total number of units for this counter. For example, if the Number is set to 250 and the Total is set to 500, the counter will animate to 50%.', 'uabb' ),
							'connections' => array( 'html' ),
						),
						'number_format'       => array(
							'type'    => 'select',
							'label'   => __( 'Counter Number Format', 'uabb' ),
							'default' => 'comma',
							'options' => array(
								'comma'  => __( 'Comma Delimiter', 'uabb' ),
								'locale' => __( 'WordPress Locale based Delimiter', 'uabb' ),
								'none'   => __( 'Number without Delimiter', 'uabb' ),
							),
							'help'    => __( 'Control the delimiters of entered number.', 'uabb' ),
						),
						'number_position'     => array(
							'type'    => 'select',
							'label'   => __( 'Number Position', 'uabb' ),
							'size'    => '5',
							'help'    => __( 'Where to display the number in relation to the bar.', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'none'    => __( 'None', 'uabb' ),
								'default' => __( 'Inside Bar', 'uabb' ),
								'above'   => __( 'Above Bar', 'uabb' ),
								'below'   => __( 'Below Bar', 'uabb' ),
							),
						),
						'before_number_text'  => array(
							'type'        => 'text',
							'label'       => __( 'Text Above Number', 'uabb' ),
							'size'        => '20',
							'help'        => __( 'Text to appear above the number. Leave it empty for none.', 'uabb' ),
							'connections' => array( 'html', 'string' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-number-before-text',
							),
						),
						'before_counter_text' => array(
							'type'    => 'text',
							'label'   => __( 'Text Before Counter', 'uabb' ),
							'size'    => '20',
							'help'    => __( 'Text to appear before counter. Leave it empty for none.', 'uabb' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-counter-before-text',
							),
						),
						'after_number_text'   => array(
							'type'        => 'text',
							'label'       => __( 'Text Below Number', 'uabb' ),
							'size'        => '20',
							'help'        => __( 'Text to appear below the number. Leave it empty for none.', 'uabb' ),
							'connections' => array( 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-number-after-text',
							),
						),
						'after_counter_text'  => array(
							'type'    => 'text',
							'label'   => __( 'Text After Counter', 'uabb' ),
							'size'    => '20',
							'help'    => __( 'Text to appear after counter. Leave it empty for none.', 'uabb' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-counter-after-text',
							),
						),
						'number_prefix'       => array(
							'type'  => 'text',
							'label' => __( 'Number Prefix', 'uabb' ),
							'size'  => '10',
							'help'  => __( 'For example, if your number is US$ 10, your prefix would be "US$ ".', 'uabb' ),
						),
						'number_suffix'       => array(
							'type'  => 'text',
							'label' => __( 'Number Suffix', 'uabb' ),
							'size'  => '10',
							'help'  => __( 'For example, if your number is 10%, your prefix would be "%".', 'uabb' ),
						),
					),
				),
			),
		),
		'style'      => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'circle_bar_style'      => array(
					'title'  => __( 'Circle Bar Styles', 'uabb' ),
					'fields' => array(
						'circle_width'        => array(
							'type'        => 'unit',
							'label'       => __( 'Circle Size', 'uabb' ),
							'placeholder' => '300',
							'maxlength'   => '4',
							'size'        => '4',
							'description' => 'px',
						),
						'circle_dash_width'   => array(
							'type'        => 'unit',
							'label'       => __( 'Circle Stroke Size', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.semi-circle-svg circle ,.svg circle, .svg-bar',
								'property' => 'stroke-width',
								'unit'     => 'px',
							),
						),

						'circle_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Circle Foreground Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.semi-circle-svg .uabb-bar, .svg .uabb-bar',
								'property' => 'stroke',
							),
						),
						'circle_color_opc'    => array(
							'type'        => 'text',
							'label'       => __( 'Foreground Circle Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'circle_bg_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Circle Background Color', 'uabb' ),
							'default'    => 'fafafa',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.semi-circle-svg .uabb-bar-bg, .svg .uabb-bar-bg',
								'property' => 'stroke',
							),
						),
						'circle_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Background Circle Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
					),
				),
				'overall_structure'     => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'align' => array(
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
					),
				),
				'margin_style'          => array(
					'title'  => __( 'Number Margins', 'uabb' ),
					'fields' => array(
						'number_top_margin'    => array(
							'type'        => 'unit',
							'label'       => __( 'Number Top Margin', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'number_bottom_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Number Bottom Margin', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-string',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'seprator_margin_style' => array(
					'title'  => __( 'Separator Margins', 'uabb' ),
					'fields' => array(
						'separator_top_margin'    => array(
							'type'        => 'unit',
							'label'       => __( 'Separator Top Margin', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'separator_bottom_margin' => array(
							'type'        => 'unit',
							'label'       => __( 'Separator Bottom Margin', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
					),
				),
				'img_icon_margins'      => array(
					'title'  => __( 'Image / Icon Margins', 'uabb' ),
					'fields' => array(
						'img_icon_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Top', 'uabb' ),
							'placeholder' => '',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'img_icon_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom', 'uabb' ),
							'placeholder' => '',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
					),
				),
				'bar_style'             => array(
					'title'  => __( 'Bar Styles', 'uabb' ),
					'fields' => array(
						'bar_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Bar Foreground Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'bar_color_opc'    => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'bar_bg_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Bar Background Color', 'uabb' ),
							'default'    => 'fafafa',
							'show_reset' => true,
						),
						'bar_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
					),
				),
				'separator'             => array( // Section.
					'title'  => __( 'Separator ( Below Number )', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'show_separator'      => array(
							'type'    => 'select',
							'label'   => __( 'Show separator', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'separator_color', 'separator_height', 'separator_width', 'separator_style', 'separator_top_margin', 'separator_bottom_margin' ),
									'sections' => array( 'seprator_margin_style' ),
								),
								'no'  => array(),
							),
						),
						'separator_style'     => array(
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
						),
						'separator_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Separator Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-color',
							),
						),
						'separator_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'size'        => '5',
							'placeholder' => '1',
							'description' => 'px',
							'help'        => __( 'Adjust thickness of border.', 'uabb' ),
						),
						'separator_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'size'        => '5',
							'placeholder' => '100',
							'description' => '%',
						),
						'separator_alignment' => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'inherit',
							'options' => array(
								'inherit' => __( 'Default', 'uabb' ),
								'left'    => __( 'Left', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
							),
						),
					),
				),
				'animation'             => array( // Section.
					'title'  => __( 'Counter Animation', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'animation_speed' => array(
							'type'        => 'unit',
							'label'       => __( 'Animation Speed', 'uabb' ),
							'size'        => '5',
							'placeholder' => '1',
							'description' => __( 'second(s)', 'uabb' ),
							'help'        => __( 'Number of seconds to complete the animation.', 'uabb' ),
						),
						'delay'           => array(
							'type'        => 'unit',
							'label'       => __( 'Animation Delay', 'uabb' ),
							'size'        => '5',
							'placeholder' => '1',
							'description' => __( 'second(s)', 'uabb' ),
						),
					),
				),
			),
		),
		'imageicon'  => array(
			'title'    => __( 'Image / Icon', 'uabb' ),
			'sections' => array(
				'type_general' => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type'        => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'  => __( 'None', 'uabb' ), // Removed args 'Image type.',.
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							),
							'class'   => 'class_image_type',
							'toggle'  => array(
								'icon'  => array(
									'sections' => array( 'icon_basic', 'icon_style', 'icon_colors' ),
								),
								'photo' => array(
									'sections' => array( 'img_basic', 'img_style' ),
								),
							),
						),
						'img_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'above-title',
							'help'    => __( 'Image Icon position', 'uabb' ),
							'options' => array(
								'above-title' => __( 'Above Heading', 'uabb' ),
								'below-title' => __( 'Below Heading', 'uabb' ),
								'left-title'  => __( 'Left of Heading', 'uabb' ),
								'right-title' => __( 'Right of Heading', 'uabb' ),
								'left'        => __( 'Left of Text and Heading', 'uabb' ),
								'right'       => __( 'Right of Text and Heading', 'uabb' ),
							),
							'toggle'  => array(
								'above-title' => array(
									'fields' => array( 'align' ),
								),
								'below-title' => array(
									'fields' => array( 'align' ),
								),
								'left-title'  => array(
									'section' => array( 'overall_structure' ),
								),
							),
						),
						'circle_position'   => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'above-title',
							'options' => array(
								'above-title' => __( 'Above Heading', 'uabb' ),
								'below-title' => __( 'Below Heading', 'uabb' ),
							),
						),
					),
				),
				'icon_basic'   => array( // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon'      => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'icon_size' => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
					),
				),
				/* Image Basic Setting */
				'img_basic'    => array( // Section.
					'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'photo_source' => array(
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'photo' ),
								),
								'url'     => array(
									'fields' => array( 'photo_url' ),
								),
							),
						),
						'photo'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'img_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '150',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						),
					),
				),
				'icon_style'   => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						/* Icon Style */
						'icon_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'  => array(
								'simple' => array(
									'fields' => array(),
								),
								'circle' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'square' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'custom' => array(
									'fields' => array( 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'icon_border_style' ),
								),
							),
						),

						/* Icon Background SIze */
						'icon_bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
						),

						/* Border Style and Radius for Icon */
						'icon_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
							),
						),
						'icon_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'icon_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '20',
						),
					),
				),
				'img_style'    => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						/* Image Style */
						'image_style'          => array(
							'type'    => 'select',
							'label'   => __( 'Image Style', 'uabb' ),
							'default' => 'simple',
							'help'    => __( 'Circle and Square style will crop your image in 1:1 ratio', 'uabb' ),
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'class'   => 'uabb-image-icon-style',
							'toggle'  => array(
								'simple' => array(
									'fields' => array(),
								),
								'circle' => array(
									'fields' => array(),
								),
								'square' => array(
									'fields' => array(),
								),
								'custom' => array(
									'sections' => array( 'img_colors' ),
									'fields'   => array( 'img_bg_size', 'img_border_style', 'img_border_width', 'img_bg_border_radius' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'img_border_style' ),
								),

							),
						),

						/* Image Background Size */
						'img_bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
							'preview'     => array(
								'type' => 'refresh',
							),
						),

						/* Border Style and Radius for Image */
						'img_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
							),
						),
						'img_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'img_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						),
					),
				),
				'icon_colors'  => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.

						/* Style Options */
						'icon_color_preset'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => array(
								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							),
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						),
						/* Icon Color */
						'icon_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property' => 'color',
							),
						),
						'icon_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),

						/* Background Color Dependent on Icon Style **/
						'icon_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'icon_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'icon_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'icon_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						/* Border Color Dependent on Border Style for ICon */
						'icon_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'icon_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),

						/* Gradient Color Option */
						'icon_three_d'            => array(
							'type'    => 'select',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => '0',
							'options' => array(
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
				'img_colors'   => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						/* Background Color Dependent on Icon Style **/
						'img_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'img_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'img_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'img_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						/* Border Color Dependent on Border Style for Image */
						'img_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'img_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'number_typography'  => array(
					'title'  => __( 'Number Text', 'uabb' ),
					'fields' => array(
						'num_tag_selection'    => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h2',
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
						'num_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-number-string',
							),
						),
						'num_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-string',
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
						'num_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-string',
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
						'num_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-number-string',
								'property' => 'color',
							),
						),
						'letter_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-string',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'ba_text_typography' => array(
					'title'  => __( 'Before - After Text', 'uabb' ),
					'fields' => array(
						'ba_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
							),
						),
						'ba_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
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
						'ba_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
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
						'ba_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
								'property' => 'color',
							),
						),
						'ba_transform'        => array(
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
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
								'property' => 'text-transform',
							),
						),
						'ba_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-number-before-text, .uabb-number-after-text, .uabb-counter-before-text, .uabb-counter-after-text',
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
