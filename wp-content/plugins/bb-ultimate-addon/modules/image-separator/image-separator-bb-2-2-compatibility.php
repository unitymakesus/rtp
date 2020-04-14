<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Image Separator Module
 */

FLBuilder::register_module(
	'UABBImageSeparatorModule',
	array(
		'general'       => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				/* Image Basic Setting */
				'img_basic'    => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'photo'           => array(
							'type'        => 'photo',
							'label'       => __( 'Separator Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'img_size'        => array(
							'type'      => 'unit',
							'label'     => __( 'Desktop Size', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'help'      => __( 'Image size cannot be more than parent size.', 'uabb' ),
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'width',
								'important' => true,
								'unit'      => 'px',
							),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
						),
						'medium_img_size' => array(
							'type'      => 'unit',
							'label'     => __( 'Medium Device Size', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'help'      => __( 'Apply image size for medium devices. It will inherit desktop size if empty.', 'uabb' ),
							'preview'   => array(
								'type' => 'none',
							),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
						),
						'small_img_size'  => array(
							'type'      => 'unit',
							'label'     => __( 'Small Device Size', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'help'      => __( 'Apply image size for small devices. It will inherit medium size if empty.', 'uabb' ),
							'preview'   => array(
								'type' => 'none',
							),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
						),
					),
				),
				/* Image Style Section */
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
									'fields'   => array( 'img_bg_size', 'img_border_style', 'img_bg_border_radius' ),
								),
							),
						),
						/* Image Background Size */
						'img_bg_size'          => array(
							'type'      => 'unit',
							'label'     => __( 'Background Size', 'uabb' ),
							'help'      => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength' => '3',
							'size'      => '6',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'padding',
								'important' => true,
								'unit'      => 'px',
							),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
						),
						/* Border Style and Radius for Image */
						'img_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ), // Removed args 'Border type.', .
								'solid'  => __( 'Solid', 'uabb' ), // Removed args 'Border type.', .
								'dashed' => __( 'Dashed', 'uabb' ), // Removed args 'Border type.', .
								'dotted' => __( 'Dotted', 'uabb' ), // Removed args 'Border type.', .
								'double' => __( 'Double', 'uabb' ), // Removed args 'Border type.', .
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
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'border-style',
								'important' => true,
							),
						),
						'img_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'border-width',
								'important' => true,
								'unit'      => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
						),
						'img_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'border-radius',
								'important' => true,
								'unit'      => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
						),
					),
				),
				/* Image Colors */
				'img_colors'   => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						/* Background Color Dependent on Icon Style **/
						'img_bg_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'background',
								'important' => true,
							),
						),
						'img_bg_hover_color'     => array(
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

						/* Border Color Dependent on Border Style for Image */
						'img_border_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-image .uabb-photo-img',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'img_border_hover_color' => array(
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
					),
				),
				/* Image Style Section */
				'img_stucture' => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						/* Image Position */
						'image_position'    => array(
							'type'    => 'select',
							'label'   => __( 'Image Top / Bottom Position', 'uabb' ),
							'default' => 'bottom',
							'help'    => __( 'Select the position to display Image Separator', 'uabb' ),
							'options' => array(
								'bottom' => __( 'Bottom', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
							),
						),

						/* Image Gutter */
						'gutter'            => array(
							'type'        => 'unit',
							'label'       => __( 'Gutter', 'uabb' ),
							'placeholder' => '50',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( '50% is default. Increase to push the image outside or decrease to pull the image inside.', 'uabb' ),
							'units'       => array( '%' ),
						),

						'image_position_lr' => array(
							'type'    => 'align',
							'label'   => __( 'Image Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'Select the position to display Image Separator', 'uabb' ),
							'toggle'  => array(
								'left'  => array(
									'fields' => array( 'gutter_lr', 'responsive_center' ),
								),
								'right' => array(
									'fields' => array( 'gutter_lr', 'responsive_center' ),
								),
							),
						),

						/* Image Gutter */
						'gutter_lr'         => array(
							'type'        => 'unit',
							'label'       => __( 'Image Position from Left / Right', 'uabb' ),
							'placeholder' => '0',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( 'Provides more control to align image at specific position.', 'uabb' ),
							'units'       => array( '%' ),
						),

						'responsive_center' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'To view Image Separator center aligned on different devices use this setting', 'uabb' ),
							'options' => array(
								'none'  => __( 'Default', 'uabb' ),
								'small' => __( 'Small Device', 'uabb' ),
								'both'  => __( 'Small & Medium Devices', 'uabb' ),
							),
						),

						/* Link Toggle */
						'enable_link'       => array(
							'type'    => 'select',
							'label'   => __( 'Enable Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'link', 'link_target' ),
								),
							),
						),
						'link'              => array(
							'type'    => 'link',
							'label'   => __( 'Link', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'link_target'       => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'uabb' ),
							'default' => '_self',
							'options' => array(
								'_self'  => __( 'Same Window', 'uabb' ),
								'_blank' => __( 'New Window', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'animation_tab' => array( // Tab.
			'title'    => __( 'Animation', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'anim_general' => array(
					'title'  => '',
					'fields' => array(
						'img_animation'         => array(
							'type'    => 'select',
							'label'   => __( 'Animation', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Choose one of the animation types for Separator.', 'uabb' ),
							'options' => array(
								'no'                => __( 'No', 'uabb' ),
								'bounce'            => __( 'bounce', 'uabb' ),
								'flash'             => __( 'flash', 'uabb' ),
								'pulse'             => __( 'pulse', 'uabb' ),
								'rubberBand'        => __( 'rubberBand', 'uabb' ),
								'shake'             => __( 'shake', 'uabb' ),
								'headShake'         => __( 'headShake', 'uabb' ),
								'swing'             => __( 'swing', 'uabb' ),
								'tada'              => __( 'tada', 'uabb' ),
								'wobble'            => __( 'wobble', 'uabb' ),
								'jello'             => __( 'jello', 'uabb' ),
								'bounceIn'          => __( 'bounceIn', 'uabb' ),
								'bounceInDown'      => __( 'bounceInDown', 'uabb' ),
								'bounceInLeft'      => __( 'bounceInLeft', 'uabb' ),
								'bounceInRight'     => __( 'bounceInRight', 'uabb' ),
								'bounceInUp'        => __( 'bounceInUp', 'uabb' ),
								'fadeIn'            => __( 'fadeIn', 'uabb' ),
								'fadeInDown'        => __( 'fadeInDown', 'uabb' ),
								'fadeInDownBig'     => __( 'fadeInDownBig', 'uabb' ),
								'fadeInLeft'        => __( 'fadeInLeft', 'uabb' ),
								'fadeInLeftBig'     => __( 'fadeInLeftBig', 'uabb' ),
								'fadeInRight'       => __( 'fadeInRight', 'uabb' ),
								'fadeInRightBig'    => __( 'fadeInRightBig', 'uabb' ),
								'fadeInUp'          => __( 'fadeInUp', 'uabb' ),
								'fadeInUpBig'       => __( 'fadeInUpBig', 'uabb' ),
								'flipInX'           => __( 'flipInX', 'uabb' ),
								'flipInY'           => __( 'flipInY', 'uabb' ),
								'flipOutX'          => __( 'flipOutX', 'uabb' ),
								'flipOutY'          => __( 'flipOutY', 'uabb' ),
								'lightSpeedIn'      => __( 'lightSpeedIn', 'uabb' ),
								'rotateIn'          => __( 'rotateIn', 'uabb' ),
								'rotateInDownLeft'  => __( 'rotateInDownLeft', 'uabb' ),
								'rotateInDownRight' => __( 'rotateInDownRight', 'uabb' ),
								'rotateInUpLeft'    => __( 'rotateInUpLeft', 'uabb' ),
								'rotateInUpRight'   => __( 'rotateInUpRight', 'uabb' ),
								'rollIn'            => __( 'rollIn', 'uabb' ),
								'zoomIn'            => __( 'zoomIn', 'uabb' ),
								'zoomInDown'        => __( 'zoomInDown', 'uabb' ),
								'zoomInLeft'        => __( 'zoomInLeft', 'uabb' ),
								'zoomInRight'       => __( 'zoomInRight', 'uabb' ),
								'zoomInUp'          => __( 'zoomInUp', 'uabb' ),
								'slideInDown'       => __( 'slideInDown', 'uabb' ),
								'slideInLeft'       => __( 'slideInLeft', 'uabb' ),
								'slideInRight'      => __( 'slideInRight', 'uabb' ),
								'slideInUp'         => __( 'slideInUp', 'uabb' ),
							),
						),
						'img_animation_delay'   => array(
							'type'        => 'unit',
							'label'       => __( 'Animation Delay', 'uabb' ),
							'placeholder' => '0',
							'help'        => __( 'Delay the animation effect for seconds you entered.', 'uabb' ),
							'units'       => array( 'sec' ),
						),
						'img_animation_repeat'  => array(
							'type'        => 'unit',
							'label'       => __( 'Repeat Animation', 'uabb' ),
							'placeholder' => '1',
							'help'        => __( 'The animation effect will repeat to the count you enter. Enter 0 if you want to repeat it infinitely.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'units'       => array( 'times' ),
						),
						'img_viewport_position' => array(
							'type'        => 'unit',
							'label'       => __( 'Viewport Position', 'uabb' ),
							'placeholder' => '90',
							'help'        => __( 'The area of screen from top where animation effect will start working.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'units'       => array( '%' ),
						),
					),
				),
			),
		),
		'uabb_docs'     => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-use-the-image-separator-effectively/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=image-separator-module" target="_blank" rel="noopener"> How to use the Image Separator effectively? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
