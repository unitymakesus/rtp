<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Button Module
 */

FLBuilder::register_module(
	'UABBMarketingButtonModule',
	array(
		'general'             => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'          => array(
					'title'  => '',
					'fields' => array(
						'title'     => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Subscribe Now', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'sub_title' => array(
							'type'        => 'text',
							'label'       => __( 'Description', 'uabb' ),
							'default'     => __( 'Get access to premium Features for FREE  for a year!', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),

					),
				),
				'link'             => array(
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'placeholder'   => 'http://www.example.com',
							'default'       => '#',
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'btn_html_element' => array(
					'title'  => __( 'HTML Element', 'uabb' ),
					'fields' => array(
						'custom_class' => array(
							'type'    => 'text',
							'label'   => __( 'Custom Class', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'style'               => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'formatting' => array(
					'title'  => __( 'Design', 'uabb' ),
					'fields' => array(
						'width'               => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Auto', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'align', 'mob_align' ),
								),
								'custom' => array(
									'fields' => array( 'align', 'mob_align', 'custom_width', 'custom_height' ),
								),
							),
						),
						'custom_width'        => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Width', 'uabb' ),
							'default'   => '200',
							'maxlength' => '3',
							'size'      => '4',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'custom_height'       => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Height', 'uabb' ),
							'default'   => '45',
							'maxlength' => '3',
							'size'      => '4',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'padding'             => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'title_margin_bottom' => array(
							'type'      => 'unit',
							'label'     => __( 'Space between Title & Description', 'uabb' ),
							'maxlength' => '3',
							'size'      => '4',
							'default'   => '5',
							'units'     => array( 'px' ),
							'slider'    => true,
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button .uabb-marketing-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'new_align'           => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap',
								'property' => 'text-align',
							),
						),
						'mob_align'           => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'colors'     => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'style'           => array(
							'type'    => 'select',
							'label'   => __( ' Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'default'     => array(
									'fields' => array( 'bg_color', 'bg_hover_color' ),
								),
								'flat'        => array(
									'fields' => array( 'bg_color', 'bg_hover_color' ),
								),
								'gradient'    => array(
									'fields' => array( 'gradient' ),
								),
								'transparent' => array(
									'fields' => array( 'bg_hover_color' ),
								),
							),
						),
						'gradient'        => array(
							'type'    => 'gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link,.uabb-marketing-button-wrap .uabb-marketing-btn__link:visited',
								'property' => 'background',
							),
						),
						'bg_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
										'property' => 'background',
									),
								),
							),
						),
						'bg_hover_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'border'          => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style'  => 'solid',
								'color'  => 'cccccc',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '',
									'top_right'    => '',
									'bottom_left'  => '',
									'bottom_right' => '',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link,.uabb-marketing-button-wrap .uabb-marketing-btn__link:visited',
							),
						),
						'hover_animation' => array(
							'type'    => 'select',
							'label'   => __( 'Hover Animation', 'uabb' ),
							'default' => '',
							'options' => array(
								''                => __( 'None', 'uabb' ),
								'float'           => __( 'Float', 'uabb' ),
								'sink'            => __( 'Sink', 'uabb' ),
								'wobble-vertical' => __( 'Wobble Vertical', 'uabb' ),
								'bounce-in'       => __( 'Bounce', 'uabb' ),
							),
						),
					),
				),
				'icon'       => array(
					'title'  => __( 'Icon', 'uabb' ),
					'fields' => array(
						'icon'                => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'fas fa-external-link-alt',
							'show_remove' => true,
						),
						'icon_width'          => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '20',
							'default'     => '17',
							'slider'      => true,
							'units'       => array( 'px' ),
							'size'        => '8',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-button .uabb-button-icon',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'icon_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before'     => __( 'Before Text', 'uabb' ),
								'after'      => __( 'After Text', 'uabb' ),
								'all_before' => __( 'Before Title & Description', 'uabb' ),
								'all_after'  => __( 'After Title & Description', 'uabb' ),
							),
							'toggle'  => array(
								'all_before' => array(
									'fields' => array( 'icon_vertical_align' ),
								),
								'all_after'  => array(
									'fields' => array( 'icon_vertical_align' ),
								),
							),
						),
						'icon_vertical_align' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Vertical Alignment', 'uabb' ),
							'default' => 'middle',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'middle' => __( 'Middle', 'uabb' ),
							),
						),
						'img_icon_spacing'    => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Spacing', 'uabb' ),
							'placeholder' => '20',
							'default'     => '8',
							'slider'      => 'true',
							'units'       => array( 'px' ),
							'size'        => '8',
							'help'        => __( 'This is the spacing between Icon and Title.', 'uabb' ),
						),
						'icon_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-marketing-button-wrap .uabb-marketing-button .uabb-button-icon',
										'property' => 'color',
									),
								),
							),
						),
					),
				),
			),
		),
		'creative_typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typography'    => array(
					'title'  => __( 'Title Typography', 'uabb' ),
					'fields' => array(
						'button_typo'      => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
							),
						),
						'text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Title Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
								'property' => 'color',
							),
						),
						'text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Title Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'subtitle_typography' => array(
					'title'  => __( 'Description Typography', 'uabb' ),
					'fields' => array(
						'button_typo_subtitle'      => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
							),
						),
						'subtitle_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
								'property' => 'color',
							),
						),
						'subtitle_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Description Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'uabb_docs'           => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/marketing-button/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=marketing-button-module" target="_blank" rel="noopener"> Getting started article </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
