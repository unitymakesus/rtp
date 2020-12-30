<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Before After Slider Module
 */

FLBuilder::register_module(
	'UABBBeforeaftersliderModule',
	array(
		'general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'       => array( // Section.
					'title'  => __( 'Before', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'before_image'      => array(
							'type'    => 'select',
							'label'   => __( 'Select Before Image', 'uabb' ),
							'default' => 'library',
							'help'    => __( 'Image dimensions should be same to work slider properly', 'uabb' ),
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'before_photo' ),
								),
								'url'     => array(
									'fields' => array( 'before_photo_url' ),
								),
							),
						),
						'before_photo'      => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'before_photo_url'  => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'before_label_text' => array(
							'type'        => 'text',
							'label'       => __( 'Before Label Text', 'uabb' ),
							'placeholder' => __( 'Before', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'general_after' => array( // Section.
					'title'  => __( 'After', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						// After Image.
						'after_image'      => array(
							'type'    => 'select',
							'label'   => __( 'Select After Image', 'uabb' ),
							'default' => 'library',
							'help'    => __( 'Image dimensions should be same to work slider properly', 'uabb' ),
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'after_photo' ),
								),
								'url'     => array(
									'fields' => array( 'after_photo_url' ),
								),
							),
						),
						'after_photo'      => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'after_photo_url'  => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'after_label_text' => array(
							'type'        => 'text',
							'label'       => __( 'After Label Text', 'uabb' ),
							'placeholder' => __( 'After', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'style'   => array( // Tab.
			'title'    => __( 'Styling', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'style' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'before_after_orientation' => array(
							'type'    => 'select',
							'label'   => __( 'Before After Orientation', 'uabb' ),
							'default' => 'horizontal',
							'class'   => '',
							'options' => array(
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
							),
							'toggle'  => array(
								'horizontal' => array(
									'fields' => array( 'slider_label_position' ),
								),
								'vertical'   => array(
									'fields' => array( 'slider_vertical_label_position' ),
								),
							),
						),
						'overall_alignment'        => array(
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'move_on_hover'            => array(
							'type'        => 'select',
							'label'       => __( 'Move on Hover', 'uabb' ),
							'description' => '',
							'default'     => 'false',
							'options'     => array(
								'true'  => __( 'Yes', 'uabb' ),
								'false' => __( 'No', 'uabb' ),
							),
							'toggle'      => array(
								'false' => array(
									'fields' => array( 'handle_back_overlay', 'handle_back_overlay_opc' ),
								),
							),
						),
						'initial_offset'           => array(
							'type'    => 'select',
							'label'   => __( 'Comparison Handle Initial Offset', 'uabb' ),
							'default' => '0.5',
							'options' => array(
								'0.0' => __( '0.0', 'uabb' ),
								'0.1' => __( '0.1', 'uabb' ),
								'0.2' => __( '0.2', 'uabb' ),
								'0.3' => __( '0.3', 'uabb' ),
								'0.4' => __( '0.4', 'uabb' ),
								'0.5' => __( '0.5', 'uabb' ),
								'0.6' => __( '0.6', 'uabb' ),
								'0.7' => __( '0.7', 'uabb' ),
								'0.8' => __( '0.8', 'uabb' ),
								'0.9' => __( '0.9', 'uabb' ),
							),
						),
						'handle_color'             => array(
							'type'       => 'color',
							'label'      => __( 'Comparison Handle Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'handle_thickness'         => array(
							'type'        => 'unit',
							'size'        => 8,
							'label'       => __( 'Comparison Handle Thickness', 'uabb' ),
							'placeholder' => '5',
							'description' => 'px',
						),
						'handle_back_overlay'      => array(
							'type'       => 'color',
							'label'      => __( 'Slider Overlay Color', 'uabb' ),
							'default'    => '000000',
							'show_reset' => true,
							'help'       => __( 'The slider overlay color will be displayed on mouse hover.', 'uabb' ),
						),
						'handle_back_overlay_opc'  => array(
							'type'        => 'text',
							'label'       => __( 'Overlay Color Opacity', 'uabb' ),
							'default'     => '50',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'advance_opt'              => array(
							'type'        => 'select',
							'label'       => __( 'Display Advance Options', 'uabb' ),
							'description' => '',
							'default'     => '',
							'options'     => array(
								'Y' => __( 'Yes', 'uabb' ),
								''  => __( 'No', 'uabb' ),
							),
							'toggle'      => array(
								'Y' => array(
									'fields' => array( 'handle_circle_width', 'shadow_opt', 'handle_triangle_color', 'handle_triangle_size', 'handle_radius' ),
								),
							),
						),
						'handle_circle_width'      => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Comparison Circle Width', 'uabb' ),
							'placeholder' => '40',
							'description' => 'px',
						),
						'handle_radius'            => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Comparison Circle Radius', 'uabb' ),
							'placeholder' => '100',
							'description' => 'px',
						),
						'handle_triangle_size'     => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Comparison Triangle Size', 'uabb' ),
							'placeholder' => __( '6', 'uabb' ),
							'description' => 'px',
						),
						'handle_triangle_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Comparison Triangle Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'shadow_opt'               => array(
							'type'        => 'select',
							'label'       => __( 'Comparison Handle Shadow', 'uabb' ),
							'description' => '',
							'default'     => '',
							'options'     => array(
								'Y' => __( 'Yes', 'uabb' ),
								''  => __( 'No', 'uabb' ),
							),
							'toggle'      => array(
								'Y' => array(
									'fields' => array( 'handle_shadow', 'handle_shadow_color' ),
								),
							),
						),
						'handle_shadow'            => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Comparison Handle Shadow Size', 'uabb' ),
							'placeholder' => '5',
							'description' => 'px',
						),
						'handle_shadow_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Comparison Handle Shadow Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
			),
		),
		'label'   => array( // Tab.
			'title'    => __( 'Label', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'label_typography' => array(
					'title'  => __( 'Label Typography', 'uabb' ),
					'fields' => array(
						'slider_font_family'             => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-count-down-digit',
							),
						),
						'slider_font_size_unit'          => array(
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
						),
						'slider_line_height_unit'        => array(
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
						),
						'slider_color'                   => array(
							'type'       => 'color',
							'label'      => __( 'Label Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-count-down-digit',
								'property' => 'color',
							),
							'default'    => '',
							'show_reset' => true,
						),
						'slider_label_back_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Label Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'slider_label_position'          => array(
							'type'    => 'select',
							'label'   => __( 'Label Position', 'uabb' ),
							'default' => 'center',
							'class'   => '',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'slider_vertical_label_position' => array(
							'type'    => 'select',
							'label'   => __( 'Label Position', 'uabb' ),
							'default' => 'center',
							'class'   => '',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'slider_transform'               => array(
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
								'selector' => '.uabb-count-down-digit',
								'property' => 'text-transform',
							),
						),
						'slider_label_padding'           => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Label Padding', 'uabb' ),
							'placeholder' => '10',
							'description' => 'px',
						),
						'slider_label_letter_spacing'    => array(
							'type'        => 'unit',
							'size'        => '2',
							'label'       => __( 'Label Letter Spacing', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
						),
					),
				),
			),
		),
	)
);
