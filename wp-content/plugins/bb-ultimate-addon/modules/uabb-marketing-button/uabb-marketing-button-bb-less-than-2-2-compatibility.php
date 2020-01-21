<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
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
							'default'     => __( 'Click Here', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'sub_title' => array(
							'type'        => 'text',
							'label'       => __( 'Sub Title', 'uabb' ),
							'default'     => __( 'Lorem ipsum dolor sit amet.', 'uabb' ),
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
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'align', 'mob_align' ),
								),
								'full'   => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'align', 'mob_align', 'custom_width', 'custom_height', 'padding' ),
								),
							),
						),
						'custom_width'        => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Width', 'uabb' ),
							'default'     => '200',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'custom_height'       => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Height', 'uabb' ),
							'default'     => '45',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'padding'             => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'default' => array(
									'default'    => '10',
									'medium'     => '10',
									'responsive' => '10',
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
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap',
								'property' => 'text-align',
							),
						),
						'mob_align'           => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
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
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'default'     => array(
									'fields' => array( 'bg_color', 'bg_hover_color' ),
								),
								'flat'        => array(
									'fields' => array( 'bg_color', 'bg_hover_color' ),
								),
								'transparent' => array(
									'fields' => array( 'bg_hover_color' ),
								),
							),
						),
						'bg_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'fafafa',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
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
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'border_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap uabb-marketing-btn__link',
								'property' => 'border-style',
							),
						),
						'border_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'default'     => '1',
							'size'        => '8',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap uabb-marketing-btn__link',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap uabb-marketing-btn__link',
								'property' => 'border-color',
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
							'show_remove' => true,
							'default'     => 'fas fa-external-link-alt',
						),
						'icon_width'          => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '20',
							'default'     => '17',
							'description' => 'px',
							'size'        => '8',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-button i',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'icon_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'after',
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
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'This is the spacing between Icon and Title.', 'uabb' ),
						),
						'icon_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-marketing-button-wrap .uabb-marketing-button i',
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
				'typography' => array(
					'title'  => __( 'Title Typography', 'uabb' ),
					'fields' => array(
						'font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
							),
						),
						'font_size_unit'   => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'line_height_unit' => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'transform'        => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
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
							'label'       => __( 'Hover Color', 'uabb' ),
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
				'typography' => array(
					'title'  => __( 'Description Typography', 'uabb' ),
					'fields' => array(
						'subtitle_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
							),
						),
						'subtitle_font_size_unit'   => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'subtitle_line_height_unit' => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'subtitle_transform'        => array(
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
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
								'property' => 'text-transform',
							),
						),
						'subtitle_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'subtitle_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'subtitle_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
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
					),
				),
			),
		),
	)
);

