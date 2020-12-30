<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 *  @package UABB Content Toggle Module
 */

$nonce = wp_create_nonce( 'uabb-module-nonce' );

FLBuilder::register_module(
	'UABBContentToggleModule',
	array(
		'general_content1' => array(
			'title'    => __( 'Content 1', 'uabb' ),
			'sections' => array(
				'content1' => array(
					'fields' => array(
						'cont1_heading'        => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => 'Heading 1',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-rbs-head-1',
							),
							'connections' => array( 'string', 'html' ),
						),
						'cont1_section'        => array(
							'type'        => 'select',
							'label'       => __( 'Section', 'uabb' ),
							'description' => '',
							'default'     => 'content',
							'options'     => array(
								'content'              => __( 'Content', 'uabb' ),
								'saved_rows'           => array(
									'label'   => __( 'Saved Rows', 'uabb' ),
									'premium' => true,
								),
								'saved_modules'        => array(
									'label'   => __( 'Saved Modules', 'uabb' ),
									'premium' => true,
								),
								'saved_page_templates' => array(
									'label'   => __( 'Saved Page Templates', 'uabb' ),
									'premium' => true,
								),
							),
							'toggle'      => array(
								'content'              => array(
									'fields' => array( 'content_editor' ),
								),
								'saved_rows'           => array(
									'fields' => array( 'cont1_saved_rows' ),
								),
								'saved_modules'        => array(
									'fields' => array( 'cont1_saved_modules' ),
								),
								'saved_page_templates' => array(
									'fields' => array( 'cont1_page_templates' ),
								),
							),
						),
						'content_editor'       => array(
							'type'        => 'editor',
							'default'     => 'This is your first content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-rbs-toggle-sections .uabb-rbs-content-1',
							),
							'wpautop'     => false,
							'connections' => array( 'string', 'html' ),
						),
						'ct_raw_nonce'         => array(
							'type'    => 'text',
							'default' => $nonce,
						),
						'cont1_saved_rows'     => array(
							'type'    => 'select',
							'label'   => __( 'Select Row', 'uabb' ),
							'options' => array(),
						),
						'cont1_saved_modules'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Module', 'uabb' ),
							'options' => array(),
						),
						'cont1_page_templates' => array(
							'type'    => 'select',
							'label'   => __( 'Select Page Template', 'uabb' ),
							'options' => array(),
						),
					),
				),
			),
		),
		'general_content2' => array( // Tab.
			'title'    => __( 'Content 2', 'uabb' ),
			'sections' => array(
				'content2' => array(
					'fields' => array(
						'cont2_heading'        => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => 'Heading 2',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-rbs-head-2',
							),
							'connections' => array( 'string', 'html' ),
						),
						'cont2_section'        => array(
							'type'        => 'select',
							'label'       => __( 'Section', 'uabb' ),
							'description' => '',
							'default'     => 'content_head2',
							'options'     => array(
								'content_head2'       => __( 'Content', 'uabb' ),
								'saved_rows_head2'    => array(
									'label'   => __( 'Saved Rows', 'uabb' ),
									'premium' => true,
								),
								'saved_modules_head2' => array(
									'label'   => __( 'Saved Modules', 'uabb' ),
									'premium' => true,
								),
								'saved_page_templates_head2' => array(
									'label'   => __( 'Saved Page Templates', 'uabb' ),
									'premium' => true,
								),
							),
							'toggle'      => array(
								'content_head2'       => array(
									'fields' => array( 'content2_editor' ),
								),
								'saved_rows_head2'    => array(
									'fields' => array( 'cont2_saved_rows' ),
								),
								'saved_modules_head2' => array(
									'fields' => array( 'cont2_saved_modules' ),
								),
								'saved_page_templates_head2' => array(
									'fields' => array( 'cont2_page_templates' ),
								),
							),
						),
						'content2_editor'      => array(
							'type'        => 'editor',
							'default'     => 'This is your second content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-rbs-toggle-sections .uabb-rbs-content-2',
							),
							'wpautop'     => false,
							'connections' => array( 'string', 'html' ),
						),
						'ct2_raw_nonce'        => array(
							'type'    => 'text',
							'default' => $nonce,
						),
						'cont2_saved_rows'     => array(
							'type'    => 'select',
							'label'   => __( 'Select Row', 'uabb' ),
							'options' => array(),
						),
						'cont2_saved_modules'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Module', 'uabb' ),
							'options' => array(),
						),
						'cont2_page_templates' => array(
							'type'    => 'select',
							'label'   => __( 'Select Page Template', 'uabb' ),
							'options' => array(),
						),
					),
				),
			),
		),
		'style'            => array( // Tab.
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'switcher' => array(
					'title'  => __( 'Switcher', 'uabb' ),
					'fields' => array(
						'default_display'     => array(
							'type'        => 'select',
							'label'       => __( 'Default Display', 'uabb' ),
							'help'        => __( 'Select the content you wish to display first.', 'uabb' ),
							'description' => '',
							'default'     => 'off',
							'options'     => array(
								'off' => __( 'Content 1', 'uabb' ),
								'on'  => __( 'Content 2', 'uabb' ),
							),
						),
						'select_switch_style' => array(
							'type'        => 'select',
							'label'       => __( 'Switch Style', 'uabb' ),
							'description' => '',
							'default'     => 'round1',
							'options'     => array(
								'round1'    => __( 'Round 1', 'uabb' ),
								'round2'    => __( 'Round 2', 'uabb' ),
								'rectangle' => __( 'Rectangle', 'uabb' ),
								'label_box' => __( 'Label Box', 'uabb' ),
							),
							'toggle'      => array(
								'label_box' => array(
									'fields' => array( 'label_box_off', 'label_box_on' ),
								),
							),
						),
						'label_box_on'        => array(
							'type'        => 'text',
							'label'       => __( 'ON Text field', 'uabb' ),
							'default'     => 'ON',
							'placeholder' => 'ON',
							'connections' => array( 'string', 'html' ),
						),
						'label_box_off'       => array(
							'type'        => 'text',
							'label'       => __( 'OFF Text field', 'uabb' ),
							'default'     => 'OFF',
							'placeholder' => 'OFF',
							'connections' => array( 'string', 'html' ),
						),
						'color1'              => array(
							'type'       => 'color',
							'label'      => __( 'Color 1', 'uabb' ),
							'default'    => '72da67',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-rbs-slider, .uabb-label-box-switch, .uabb-clickable switch2:before, .uabb-toggle input[type="checkbox"] + label:before',
										'property' => 'background-color',
									),
									array(
										'selector' => '.uabb-toggle input[type="checkbox"]:not(:checked) + label:after',
										'property' => 'border-color',
									),
								),
							),
						),
						'color2'              => array(
							'type'       => 'color',
							'label'      => __( 'Color 2', 'uabb' ),
							'default'    => 'dfd9ea',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-label-box-inactive .uabb-label-box-switch, .uabb-rbs-switch:checked + .uabb-rbs-slider, .uabb-rbs-switch:focus + .uabb-rbs-slider, .uabb-toggle input[type="checkbox"]:checked + label:before',
										'property' => 'background-color',
									),
									array(
										'selector' => '.uabb-toggle input[type="checkbox"]:checked + label:after',
										'property' => 'border-color',
									),
								),
							),
						),
						'controller_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Controller Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-rbs-slider:after, .uabb-rbs-slider:before, .uabb-toggle input[type="checkbox"] + label:after',
										'property' => 'background-color',
									),
									array(
										'selector' => 'span.uabb-label-box-switch',
										'property' => 'color',
									),
								),
							),
						),
						'switch_size'         => array(
							'type'        => 'unit',
							'label'       => __( 'Switch Size', 'uabb' ),
							'default'     => '15',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-main-btn',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '15',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
				'heading'  => array(
					'title'  => __( 'Headings', 'uabb' ),
					'fields' => array(
						'html_tag'                  => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h5',
							'options' => array(
								'h1' => __( 'H1', 'uabb' ),
								'h2' => __( 'H2', 'uabb' ),
								'h3' => __( 'H3', 'uabb' ),
								'h4' => __( 'H4', 'uabb' ),
								'h5' => __( 'H5', 'uabb' ),
								'h6' => __( 'H6', 'uabb' ),
							),
						),
						'alignment'                 => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'flex-start' => __( 'Left', 'uabb' ),
								'center'     => __( 'Center', 'uabb' ),
								'flex-end'   => __( 'Right', 'uabb' ),
							),
						),
						'heading_layout'            => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'stack'  => __( 'Stack', 'uabb' ),
								'inline' => __( 'Inline', 'uabb' ),
							),
						),
						'heading_responsive_layout' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Layout', 'uabb' ),
							'default' => 'inherit',
							'options' => array(
								'inherit' => __( 'Inherit', 'uabb' ),
								'stack'   => __( 'Stack', 'uabb' ),
								'inline'  => __( 'Inline', 'uabb' ),
							),
						),
						'advanced'                  => array(
							'type'    => 'select',
							'label'   => __( 'Advanced', 'uabb' ),
							'default' => 'off',
							'options' => array(
								'on'  => __( 'Yes', 'uabb' ),
								'off' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'on' => array(
									'fields' => array( 'background_color', 'border_type', 'border_radius', 'padding' ),
								),
							),
						),
						'background_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'background-color',
							),
						),
						'border_type'               => array(
							'type'    => 'select',
							'label'   => __( 'Border Type', 'uabb' ),
							'default' => 'None',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'border-style',
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'border_width_head', 'border_color_head' ),
								),
								'double' => array(
									'fields' => array( 'border_width_head', 'border_color_head' ),
								),
								'dotted' => array(
									'fields' => array( 'border_width_head', 'border_color_head' ),
								),
								'dashed' => array(
									'fields' => array( 'border_width_head', 'border_color_head' ),
								),
							),
						),
						'border_width_head'         => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color_head'         => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'border-color',
							),
						),
						'border_radius'             => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'padding'                   => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '24',
									'responsive' => '16',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'content'  => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'advanced_sec'         => array(
							'type'    => 'select',
							'label'   => __( 'Advanced', 'uabb' ),
							'default' => 'off',
							'options' => array(
								'on'  => __( 'Yes', 'uabb' ),
								'off' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'on' => array(
									'fields' => array( 'background_color_sec', 'border_type_sec', 'border_radius_sec', 'padding_sec' ),
								),
							),
						),
						'background_color_sec' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'background-color',
							),
						),
						'border_type_sec'      => array(
							'type'    => 'select',
							'label'   => __( 'Border Type', 'uabb' ),
							'default' => 'None',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'border-style',
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'border_width_sec', 'border_color_sec' ),
								),
								'double' => array(
									'fields' => array( 'border_width_sec', 'border_color_sec' ),
								),
								'dotted' => array(
									'fields' => array( 'border_width_sec', 'border_color_sec' ),
								),
								'dashed' => array(
									'fields' => array( 'border_width_sec', 'border_color_sec' ),
								),
							),
						),
						'border_width_sec'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color_sec'     => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'border-color',
							),
						),
						'border_radius_sec'    => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'padding_sec'          => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '24',
									'responsive' => '16',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle-sections',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'spacing'  => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'button_heading_size' => array(
							'type'        => 'unit',
							'label'       => __( 'Button & Headings Spacing', 'uabb' ),
							'default'     => '20',
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '20',
									'medium'     => '20',
									'responsive' => '20',
								),
							),
						),
						'content_headings'    => array(
							'type'        => 'unit',
							'label'       => __( 'Content Top Spacing', 'uabb' ),
							'default'     => '25',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-toggle',
								'property' => 'margin-bottom',
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
					),
				),
			),
		),

		'typography'       => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'heading1'      => array(
					'title'  => __( 'Heading 1', 'uabb' ),
					'fields' => array(
						'head1_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rbs-head-1',
							),
						),
						'head1_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'default'     => '',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-1',
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
						'head1_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-1',
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
						'head1_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-1',
								'property' => 'color',
							),
						),
						'head1_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-1',
								'property' => 'text-transform',
							),
						),
						'head1_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-1',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'heading2'      => array(
					'title'  => __( 'Heading 2', 'uabb' ),
					'fields' => array(
						'head2_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rbs-head-2',
							),
						),
						'head2_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-2',
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
						'head2_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-2',
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
						'head2_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-2',
								'property' => 'color',
							),
						),
						'head2_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'inherit',
							'options' => array(
								'inherit'    => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-2',
								'property' => 'text-transform',
							),
						),
						'head2_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-head-2',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'content1_typo' => array(
					'title'  => __( 'content 1', 'uabb' ),
					'fields' => array(
						'section1_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
							),
						),
						'section1_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'default'     => '',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
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
						'section1_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
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
						'section1_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
								'property' => 'color',
							),
						),
						'section1_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
								'property' => 'text-transform',
							),
						),
						'section1_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-1,.uabb-rbs-section-1',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'content2_typo' => array(
					'title'  => __( 'content 2', 'uabb' ),
					'fields' => array(
						'section2_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
							),
						),
						'section2_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'default'     => '',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
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
						'section2_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
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
						'section2_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
								'property' => 'color',
							),
						),
						'section2_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
								'property' => 'text-transform',
							),
						),
						'section2_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rbs-content-2,.uabb-rbs-section-2',
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
