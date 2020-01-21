<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB CTA Module
 */

FLBuilder::register_module(
	'UABBCtaModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'title' => array(
					'title'  => '',
					'fields' => array(
						'title' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Call To Action', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-cta-title',
							),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'text'  => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'text' => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'rows'          => 8,
							'default'       => __( 'Enter description text here.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
							'preview'       => array(
								'type'     => 'text',
								'selector' => '.uabb-cta-text-content',
							),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'structure' => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'layout'    => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'stacked',
							'options' => array(
								'inline'  => __( 'Inline', 'uabb' ),
								'stacked' => __( 'Stacked', 'uabb' ),
							),
							'toggle'  => array(
								'inline'  => array(
									'sections' => array( 'inline_btn_structure' ),
								),
								'stacked' => array(
									'fields'   => array( 'alignment' ),
									'sections' => array( 'btn_structure' ),
								),
							),
						),
						'alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This is the overall content alignment', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-cta-left, .uabb-cta-wrap',
								'property' => 'text-align',
							),
						),
						'spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'help'        => __( 'Apply padding to your element from all sides.', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'bg_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content',
								'property' => 'background',
							),
						),
					),
				),
			),
		),
		'button'     => array(
			'title'    => __( 'Button', 'uabb' ),
			'sections' => array(
				'btn-general'   => array( // Section.
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'btn_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Click Here', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-button-text',
							),
						),
					),
				),
				'btn-link'      => array( // Section.
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'btn_link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'placeholder'   => 'http://www.example.com',
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'btn-style'     => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'btn_style'                      => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'class'   => 'creative_button_styles',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'threed'      => __( '3D', 'uabb' ),
							),
							'toggle'  => array(
								'default'     => array(
									'fields' => array( 'button_padding_dimension', 'button_border', 'border_hover_color' ),
								),
								'gradient'    => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'transparent' => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'threed'      => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'flat'        => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
							),
						),
						'btn_border_size'                => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '2',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_transparent_button_options' => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'transparent-fade',
							'options' => array(
								'none'                    => __( 'None', 'uabb' ),
								'transparent-fade'        => __( 'Fade Background', 'uabb' ),
								'transparent-fill-top'    => __( 'Fill Background From Top', 'uabb' ),
								'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
								'transparent-fill-left'   => __( 'Fill Background From Left', 'uabb' ),
								'transparent-fill-right'  => __( 'Fill Background From Right', 'uabb' ),
								'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
								'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
								'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
							),
						),
						'btn_threed_button_options'      => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'threed_down',
							'options' => array(
								'threed_down'    => __( 'Move Down', 'uabb' ),
								'threed_up'      => __( 'Move Up', 'uabb' ),
								'threed_left'    => __( 'Move Left', 'uabb' ),
								'threed_right'   => __( 'Move Right', 'uabb' ),
								'animate_top'    => __( 'Animate Top', 'uabb' ),
								'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
							),
						),
						'btn_flat_button_options'        => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'                => __( 'None', 'uabb' ),
								'animate_to_left'     => __( 'Appear Icon From Right', 'uabb' ),
								'animate_to_right'    => __( 'Appear Icon From Left', 'uabb' ),
								'animate_from_top'    => __( 'Appear Icon From Top', 'uabb' ),
								'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
							),
						),
					),
				),
				'btn-icon'      => array( // Section.
					'title'  => __( 'Icons', 'uabb' ),
					'fields' => array(
						'btn_icon'          => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'btn_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
					),
				),
				'btn-colors'    => array( // Section.
					'title'  => __( 'Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a *',
								'property' => 'color',
							),
						),
						'btn_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-flat-btn',
										'property' => 'background',
									),
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-transparent-btn',
										'property' => 'border-color',
									),
								),
							),
						),
						'btn_bg_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'hover_attribute'      => array(
							'type'    => 'select',
							'label'   => __( 'Apply Hover Color To', 'uabb' ),
							'default' => 'bg',
							'options' => array(
								'border' => __( 'Border', 'uabb' ),
								'bg'     => __( 'Background', 'uabb' ),
							),
							'width'   => '75px',
						),
					),
				),
				'btn-structure' => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'btn_width'                => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'btn_align', 'btn_mob_align' ),
								),
								'full'   => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom', 'btn_padding_left_right' ),
								),
							),
						),
						'button_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_custom_width'         => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Width', 'uabb' ),
							'default'   => '200',
							'maxlength' => '3',
							'size'      => '4',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'width',
								'unit'      => 'px',
								'important' => true,
							),
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_custom_height'        => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Height', 'uabb' ),
							'default'   => '45',
							'maxlength' => '3',
							'size'      => '4',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'height',
								'unit'      => 'px',
								'important' => true,
							),
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_padding_top_bottom'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_padding_left_right'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'preview'     => array(
								'type'      => 'css',
								'important' => true,
								'rules'     => array(
									array(
										'selector' => '.selector-1',
										'property' => 'padding-top',
										'unit'     => 'px',
									),
									array(
										'selector' => '.selector-2',
										'property' => 'padding-bottom',
										'unit'     => 'px',
									),
								),
							),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_border_radius'        => array(
							'type'      => 'unit',
							'label'     => __( 'Round Corners', 'uabb' ),
							'maxlength' => '3',
							'size'      => '4',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typography'   => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Title Tag', 'uabb' ),
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
						'title_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-cta-title',
								'important' => true,
							),
						),
						'title_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-cta-title',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'subhead_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'subhead_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-cta-text-content p',
								'important' => true,
							),
						),
						'subhead_color' => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cta-text-content p',
								'property' => 'color',
							),
						),
					),
				),
				'typography'         => array(
					'title'  => __( 'CTA Button Text', 'uabb' ),
					'fields' => array(
						'btn_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap a:visited',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
