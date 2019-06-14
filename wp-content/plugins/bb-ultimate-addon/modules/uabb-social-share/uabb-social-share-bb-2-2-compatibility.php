<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Social Share Module
 */

FLBuilder::register_module(
	'UABBSocialShare', array(
		'social_shares' => array( // Tab.
			'title'    => __( 'Social Share', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'social_icons' => array(
							'type'         => 'form',
							'label'        => __( 'Social Share', 'uabb' ),
							'form'         => 'uabb_social_share_form',
							'preview_text' => 'social_share_type',
							'multiple'     => true,
						),
					),
				),
			),
		),
		'style'         => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'structure' => array( // Section.
					'title'  => __( 'Structure', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_struc_align' => array(
							'type'    => 'select',
							'label'   => __( 'Icon / Image Structure', 'uabb' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
							),
							'width'   => '70px',
						),
						'size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Icon / Image Size', 'uabb' ),
							'placeholder' => '40',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'spacing'          => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( 'To manage the space between Icons / Images use this option', 'uabb' ),
						),
						'align'            => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'The overall alignment of Icon', 'uabb' ),
						),
						'responsive_align' => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'default',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
						'icoimage_style'   => array(
							'type'    => 'select',
							'label'   => __( 'Icon / Image Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'border_style', 'bg_size', 'bg_border_radius', 'three_d' ),
								),
								'circle' => array(
									'fields' => array( 'three_d' ),
								),
								'square' => array(
									'fields' => array( 'three_d' ),
								),
							),
						),
						'bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon / Photo & Background edge', 'uabb' ),
							'placeholder' => '0',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ), // Removed args 'Border type.',.
								'solid'  => __( 'Solid', 'uabb' ), // Removed args 'Border type.',.
								'dashed' => __( 'Dashed', 'uabb' ), // Removed args 'Border type.',.
								'dotted' => __( 'Dotted', 'uabb' ), // Removed args 'Border type.',.
								'double' => __( 'Double', 'uabb' ), // Removed args 'Border type.',.
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
							),
						),
						'border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						),
						'bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						),
						'three_d'          => array(
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
			),
		),
	)
);

FLBuilder::register_settings_form(
	'uabb_social_share_form', array(
		'title' => __( 'Add Social Icon/Image', 'uabb' ),
		'tabs'  => array(
			'form_general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'general' => array(
						'title'  => '',
						'fields' => array(
							'social_share_type' => array(
								'type'    => 'select',
								'label'   => __( 'Social Share Type', 'uabb' ),
								'default' => 'facebook',
								'options' => array(
									'facebook'    => __( 'Facebook', 'uabb' ),
									'twitter'     => __( 'Twitter', 'uabb' ),
									'google'      => __( 'Google Plus', 'uabb' ),
									'pinterest'   => __( 'Pinterest', 'uabb' ),
									'linkedin'    => __( 'LinkedIn', 'uabb' ),
									'digg'        => __( 'Digg', 'uabb' ),
									'blogger'     => __( 'Blogger', 'uabb' ),
									'reddit'      => __( 'Reddit', 'uabb' ),
									'stumbleupon' => __( 'StumbleUpon', 'uabb' ),
									'tumblr'      => __( 'Tumblr', 'uabb' ),
									'myspace'     => __( 'Myspace', 'uabb' ),
									'email'       => __( 'Email', 'uabb' ),
								),
							),
							'image_type'        => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'icon',
								'options' => array(
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'fields' => array( 'icon', 'icocolor', 'icohover_color' ),
									),
									'photo' => array(
										'fields' => array( 'photo' ),
									),
								),
							),
							'icon'              => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-facebook-with-circle',
								'show_remove' => true,
							),
							'photo'             => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
						),
					),
				),
			),
			'form_style'   => array( // Tab.
				'title'    => __( 'Style', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'colors' => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icocolor'           => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'icohover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'bg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'bg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),

							/* Border Color Dependent on Border Style for ICon */
							'border_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'border_hover_color' => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'preview'     => array(
									'type' => 'none',
								),
							),
						),
					),
				),
			),
		),
	)
);
