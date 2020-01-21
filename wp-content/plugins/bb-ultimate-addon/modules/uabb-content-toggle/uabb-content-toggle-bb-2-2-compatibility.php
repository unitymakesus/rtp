<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 *  @package UABB Content Toggle Module
 */

FLBuilder::register_module(
	'UABBContentToggleModule', array(
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
								'type'      => 'text',
								'selector'  => '.uabb-rbs-head-1',
								'important' => true,
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
								'type'      => 'text',
								'selector'  => '.uabb-rbs-toggle-sections .uabb-rbs-content-1',
								'important' => true,
							),
							'wpautop'     => false,
							'connections' => array( 'string', 'html' ),
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
								'type'      => 'text',
								'selector'  => '.uabb-rbs-head-2',
								'important' => true,
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
								'type'      => 'text',
								'selector'  => '.uabb-rbs-toggle-sections .uabb-rbs-content-2',
								'important' => true,
							),
							'wpautop'     => false,
							'connections' => array( 'string', 'html' ),
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
								'type'      => 'css',
								'rules'     => array(
									array(
										'selector' => '.uabb-rbs-slider, .uabb-label-box-switch, .uabb-clickable switch2:before, .uabb-toggle input[type="checkbox"] + label:before',
										'property' => 'background-color',
									),
									array(
										'selector' => '.uabb-toggle input[type="checkbox"]:not(:checked) + label:after',
										'property' => 'border-color',
									),
								),
								'important' => true,
							),
						),
						'color2'              => array(
							'type'       => 'color',
							'label'      => __( 'Color 2', 'uabb' ),
							'default'    => 'dfd9ea',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'rules'     => array(
									array(
										'selector' => '.uabb-label-box-inactive .uabb-label-box-switch, .uabb-rbs-switch:checked + .uabb-rbs-slider, .uabb-rbs-switch:focus + .uabb-rbs-slider, .uabb-toggle input[type="checkbox"]:checked + label:before',
										'property' => 'background-color',
									),
									array(
										'selector' => '.uabb-toggle input[type="checkbox"]:checked + label:after',
										'property' => 'border-color',
									),
								),
								'important' => true,
							),
						),
						'controller_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Controller Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'rules'     => array(
									array(
										'selector' => '.uabb-rbs-slider:after, .uabb-rbs-slider:before, .uabb-toggle input[type="checkbox"] + label:after',
										'property' => 'background-color',
									),
									array(
										'selector' => 'span.uabb-label-box-switch',
										'property' => 'color',
									),
								),
								'important' => true,
							),
						),
						'switch_size'         => array(
							'type'       => 'unit',
							'label'      => __( 'Switch Size', 'uabb' ),
							'default'    => '15',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-main-btn',
								'property'  => 'font-size',
								'unit'      => 'px',
								'important' => true,
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
									'fields' => array( 'background_color', 'head_border', 'padding' ),
								),
							),
						),
						'background_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'head_border'               => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle',
								'important' => true,
							),
						),
						'padding'                   => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array(
								'px',
								'em',
								'%',
							),
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '24',
									'responsive' => '16',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
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
									'fields' => array( 'background_color_sec', 'border', 'padding_sec' ),
								),
							),
						),
						'background_color_sec' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle-sections',
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
								'selector'  => '.uabb-rbs-toggle-sections',
								'important' => true,
							),
						),
						'padding_sec'          => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '24',
									'responsive' => '16',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle-sections',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'spacing'  => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'button_heading_size' => array(
							'type'       => 'unit',
							'label'      => __( 'Button & Headings Spacing', 'uabb' ),
							'default'    => '20',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'      => array( 'px' ),
						),
						'content_headings'    => array(
							'type'       => 'unit',
							'label'      => __( 'Content Top Spacing', 'uabb' ),
							'default'    => '25',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-toggle',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
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
						'head1_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-head-1',
								'important' => true,
							),
						),
						'head1_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-head-1',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'heading2'      => array(
					'title'  => __( 'Heading 2', 'uabb' ),
					'fields' => array(
						'head2_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-head-2',
								'important' => true,
							),
						),
						'head2_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-head-2',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'content1_typo' => array(
					'title'  => __( 'Content 1', 'uabb' ),
					'fields' => array(
						'desc1_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-content-1,.uabb-rbs-section-1',
								'important' => true,
							),
						),
						'section1_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-content-1,.uabb-rbs-section-1',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'content2_typo' => array(
					'title'  => __( 'Content 2', 'uabb' ),
					'fields' => array(
						'desc2_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-content-2, .uabb-rbs-section-2',
								'important' => true,
							),
						),
						'section2_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '202020',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rbs-content-2,.uabb-rbs-section-2',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'        => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/open-content-toggle-specific-section-from-remote-link/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=Content-Toggle-module" target="_blank" rel="noopener"> How to Open a Specific Section of Content Toggle from a Remote Link? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
