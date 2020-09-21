<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Social Share Module
 */

FLBuilder::register_module(
	'UABBSocialShare',
	array(
		'social_shares' => array( // Tab.
			'title'    => __( 'Social Share', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title'   => array( // Section.
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
				'general' => array(
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'skins'              => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'  => __( 'Default', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
								'minimal'  => __( 'Minimal', 'uabb' ),
								'framed'   => __( 'Framed', 'uabb' ),
								'boxed'    => __( 'Boxed Icon', 'uabb' ),
								'flat'     => __( 'Flat', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'sections' => array( 'structure' ),
								),
								'framed'  => array(
									'fields' => array( 'width_border' ),
								),
								'boxed'   => array(
									'fields' => array( 'width_border' ),
								),
							),
						),
						'share_view'         => array(
							'type'    => 'select',
							'label'   => __( 'View', 'uabb' ),
							'default' => 'icon-text',
							'options' => array(
								'icon-text' => __( 'Icon & Text', 'uabb' ),
								'icon'      => __( 'Icon', 'uabb' ),
								'text'      => __( 'Text', 'uabb' ),
							),
							'toggle'  => array(
								'icon-text' => array(
									'fields'   => array( 'icon_size', 'text_hide_mobile' ),
									'sections' => array( 'title_settings' ),
								),
								'icon'      => array(
									'fields' => array( 'icon_size' ),
								),
								'text'      => array(
									'fields'   => array( 'text_padding' ),
									'sections' => array( 'title_settings' ),
								),
							),
						),
						'share_shape'        => array(
							'type'    => 'select',
							'label'   => __( 'Shape', 'uabb' ),
							'default' => 'icon-text',
							'help'    => __( 'When style is set to Minimal these shape will reflect on hover', 'uabb' ),
							'options' => array(
								'square'  => __( 'Square', 'uabb' ),
								'rounded' => __( 'Rounded', 'uabb' ),
								'circle'  => __( 'Circle', 'uabb' ),
							),
						),
						'column'             => array(
							'type'       => 'select',
							'label'      => __( 'Column', 'uabb' ),
							'default'    => 'auto',
							'options'    => array(
								'auto' => __( 'Auto', 'uabb' ),
								'1'    => __( '1', 'uabb' ),
								'2'    => __( '2', 'uabb' ),
								'3'    => __( '3', 'uabb' ),
								'4'    => __( '4', 'uabb' ),
								'5'    => __( '5', 'uabb' ),
								'6'    => __( '6', 'uabb' ),
							),
							'responsive' => true,
						),
						'share_alignment'    => array(
							'type'       => 'select',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'options'    => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'responsive' => true,
						),
						'display_position'   => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline'   => __( 'Inline', 'uabb' ),
								'floating' => __( 'Floating', 'uabb' ),
							),
							'toggle'  => array(
								'floating' => array(
									'fields' => array( 'floating_position', 'row_gap' ),
								),
								'inline'   => array(
									'fields' => array( 'share_alignment', 'column' ),
								),
							),
						),
						'floating_alignment' => array(
							'type'    => 'select',
							'label'   => __( 'Floating Alignment', 'uabb' ),
							'default' => 'right',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'         => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'structure'         => array( // Section.
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
				'social_skins'      => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'column_gap'        => array(
							'type'       => 'unit',
							'label'      => __( 'Column Gap', 'uabb' ),
							'default'    => 10,
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
						'row_gap'           => array(
							'type'       => 'unit',
							'label'      => __( 'Row Gap', 'uabb' ),
							'default'    => 10,
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
						'floating_position' => array(
							'type'       => 'unit',
							'label'      => __( 'Vertical Floating Position', 'uabb' ),
							'default'    => 25,
							'responsive' => true,
							'slider'     => true,
							'units'      => array( '%' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-social-share-wrap .uabb-style-floating',
								'property' => 'top',
								'unit'     => '%',
							),
						),
						'icon_img_size'     => array(
							'type'       => 'unit',
							'label'      => __( 'Icon Size', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-ss-icon i',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'width_border'      => array(
							'type'       => 'unit',
							'label'      => __( 'Border Width', 'uabb' ),
							'default'    => '2',
							'units'      => array( 'px' ),
							'slider'     => array(
								'min' => '1',
								'max' => '20',
							),
							'responsive' => true,
						),
						'button_height'     => array(
							'type'       => 'unit',
							'label'      => __( 'Button Height', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-social-share-wrap .uabb-ss-grid-button',
								'property' => 'height',
								'unit'     => 'px',
							),
						),
						'color_style'       => array(
							'type'    => 'select',
							'label'   => __( 'Color Style', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
						),
						'hover_animation'   => array(
							'type'    => 'select',
							'label'   => __( 'Hover Animation', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'None', 'uabb' ),
								'grow'        => __( 'Grow', 'uabb' ),
								'shrink'      => __( 'Shrink', 'uabb' ),
								'pulse'       => __( 'Pulse', 'uabb' ),
								'push'        => __( 'Push', 'uabb' ),
								'pop'         => __( 'Pop', 'uabb' ),
								'float'       => __( 'Float', 'uabb' ),
								'sink'        => __( 'Sink', 'uabb' ),
								'floatshadow' => __( 'Float Shadow', 'uabb' ),
							),
						),
					),
				),
				'social_color_skin' => array(
					'title'  => __( 'Color Skins', 'uabb' ),
					'fields' => array(
						'primary_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Primary Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-social-share-wrap .uabb-ss-flat .uabb-ss-grid-button, .uabb-social-share-wrap .uabb-ss-gradient .uabb-ss-grid-button, .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-icon',
										'property' => 'background',
									),
									array(
										'selector' => '.uabb-social-share-wrap .uabb-ss-minimal .uabb-ss-icon i',
										'property' => 'color',
									),
								),
							),
						),
						'primary_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Primary Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
						'secondary_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Secondary Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-social-share-wrap .uabb-ss-grid-button-link',
								'property' => 'color',
							),
						),
						'secondary_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Secondary Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
				'title_settings'    => array(
					'title'     => __( 'Social Share Text', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'text_hide_mobile'    => array(
							'type'    => 'select',
							'label'   => __( 'Hide on Mobile', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'title_typography'    => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-ss-button-title',
							),
						),
						'title_padding_left'  => array(
							'type'       => 'unit',
							'label'      => __( 'Padding Left', 'uabb' ),
							'default'    => '',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
						),
						'title_padding_right' => array(
							'type'       => 'unit',
							'label'      => __( 'Padding Right', 'uabb' ),
							'default'    => '',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'uabb_social_share_form',
	array(
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
									'facebook'      => __( 'Facebook', 'uabb' ),
									'twitter'       => __( 'Twitter', 'uabb' ),
									'pinterest'     => __( 'Pinterest', 'uabb' ),
									'linkedin'      => __( 'LinkedIn', 'uabb' ),
									'digg'          => __( 'Digg', 'uabb' ),
									'blogger'       => __( 'Blogger', 'uabb' ),
									'reddit'        => __( 'Reddit', 'uabb' ),
									'stumbleupon'   => __( 'StumbleUpon', 'uabb' ),
									'tumblr'        => __( 'Tumblr', 'uabb' ),
									'myspace'       => __( 'Myspace', 'uabb' ),
									'email'         => __( 'Email', 'uabb' ),
									'whatsapp'      => __( 'WhatsApp', 'uabb' ),
									'telegram'      => __( 'Telegram', 'uabb' ),
									'pocket'        => __( 'Pocket', 'uabb' ),
									'print'         => __( 'Print', 'uabb' ),
									'odnoklassniki' => __( 'OK', 'uabb' ),
									'vk'            => __( 'VK', 'uabb' ),
									'xing'          => __( 'Xing', 'uabb' ),
									'buffer'        => __( 'Buffer', 'uabb' ),
									'skype'         => __( 'Skype', 'uabb' ),
									'delicious'     => __( 'delicious', 'uabb' ),
								),
								'toggle'  => array(
									'pinterest' => array(
										'fields' => array( 'fallback_image' ),
									),
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
							'fallback_image'    => array(
								'type'        => 'photo',
								'label'       => __( 'Pintrest Fallback Image', 'uabb' ),
								'connections' => array( 'photo' ),
							),
							'icon'              => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => '',
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
								'type'        => 'color',
								'label'       => __( 'Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'icohover_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
								'preview'     => array(
									'type' => 'none',
								),
							),
							'bg_color'           => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'bg_hover_color'     => array(
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

							/* Border Color Dependent on Border Style for ICon */
							'border_color'       => array(
								'type'        => 'color',
								'label'       => __( 'Border Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'border_hover_color' => array(
								'type'        => 'color',
								'connections' => array( 'color' ),
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
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
