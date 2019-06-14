<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Photo Module
 */

FLBuilder::register_module(
	'UABBPhotoModule', array(
		'general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'photo_source'     => array(
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
									'fields' => array( 'photo_url', 'caption' ),
								),
							),
						),
						'photo'            => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_size'       => array(
							'type'    => 'unit',
							'label'   => __( 'Photo Size', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo-content img',
								'property'  => 'width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'photo_url'        => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'align'            => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'responsive_align' => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
					),
				),
				'caption' => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'show_caption' => array(
							'type'    => 'select',
							'label'   => __( 'Show Caption', 'uabb' ),
							'default' => '0',
							'options' => array(
								'0'     => __( 'Never', 'uabb' ),
								'hover' => __( 'On Hover', 'uabb' ),
								'below' => __( 'Below Photo', 'uabb' ),
							),
						),
						'caption'      => array(
							'type'    => 'text',
							'label'   => __( 'Caption', 'uabb' ),
							'preview' => array(
								'type'      => 'text',
								'selector'  => '.uabb-photo-caption',
								'important' => true,
							),
						),
					),
				),
				'link'    => array(
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'link_type' => array(
							'type'    => 'select',
							'label'   => __( 'Link Type', 'uabb' ),
							'options' => array(
								''         => _x( 'None', 'Link type.', 'uabb' ),
								'url'      => __( 'URL', 'uabb' ),
								'lightbox' => __( 'Lightbox', 'uabb' ),
								'file'     => __( 'Photo File', 'uabb' ),
								'page'     => __( 'Photo Page', 'uabb' ),
							),
							'toggle'  => array(
								''     => array(),
								'url'  => array(
									'fields' => array( 'link_url' ),
								),
								'file' => array(),
								'page' => array(),
							),
							'help'    => __( 'Link type applies to how the image should be linked on click. You can choose a specific URL, the individual photo or a separate page with the photo.', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'link_url'  => array(
							'type'          => 'link',
							'label'         => __( 'Link URL', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'style'   => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'style'                   => array(
							'type'    => 'select',
							'label'   => __( 'Photo Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple'    => __( 'Simple', 'uabb' ),
								'circle'    => __( 'Circle Background', 'uabb' ),
								'square'    => __( 'Square Background', 'uabb' ),
								'landscape' => __( 'Landscape', 'uabb' ),
								'panorama'  => __( 'Panorama', 'uabb' ),
								'portrait'  => __( 'Portrait', 'uabb' ),
								'custom'    => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'simple'    => array(
									'fields' => array(),
								),
								'circle'    => array(
									'fields' => array( 'style_bg_color', 'bg_size' ),
								),
								'square'    => array(
									'fields' => array( 'style_bg_color', 'bg_size' ),
								),
								'landscape' => array(
									'fields' => array( 'style_bg_color', 'bg_size' ),
								),
								'panorama'  => array(
									'fields' => array( 'style_bg_color', 'bg_size' ),
								),
								'portrait'  => array(
									'fields' => array( 'style_bg_color', 'bg_size' ),
								),
								'custom'    => array(
									'fields' => array( 'style_bg_color', 'bg_size', 'bg_border_radius' ),
								),
							),
						),

						'bg_size'                 => array(
							'type'    => 'unit',
							'label'   => __( 'Background Size', 'uabb' ),
							'default' => '',
							'help'    => __( 'Space between icon and background', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo .uabb-photo-content',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'style_bg_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_alpha' => true,
							'show_reset' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo .uabb-photo-content',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'bg_border_radius'        => array(
							'type'    => 'unit',
							'label'   => __( 'Border Radius ( For Background )', 'uabb' ),
							'default' => '',
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
						),
						'hover_effect'            => array(
							'type'    => 'select',
							'label'   => __( 'Image Effect', 'uabb' ),
							'default' => 'style1',
							'options' => array(
								'style1' => __( 'Opacity', 'uabb' ),
								'style2' => __( 'Grayscale', 'uabb' ),
								'style6' => __( 'Hue Rotate', 'uabb' ),
								'simple' => __( 'Simple', 'uabb' ),
							),
							'toggle'  => array(
								'style1' => array(
									'fields' => array( 'opacity', 'hover_opacity' ),
								),
								'style2' => array(
									'fields' => array( 'img_grayscale_grayscale' ),
								),
								'simple' => array(
									'fields' => array( 'img_grayscale_simple' ),
								),
							),
						),
						'opacity'                 => array(
							'type'    => 'unit',
							'label'   => __( 'Image Opacity', 'uabb' ),
							'default' => '100',
							'slider'  => array(
								'%' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'   => array( '%' ),
						),
						'hover_opacity'           => array(
							'type'    => 'unit',
							'label'   => __( 'Image Hover Opacity', 'uabb' ),
							'default' => '100',
							'slider'  => array(
								'%' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'   => array( '%' ),
						),
						'img_grayscale_simple'    => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes'        => 'Simple',
								'color_gray' => 'Grayscale on Hover',
							),
						),
						'img_grayscale_grayscale' => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes'        => 'Simple',
								'gray_color' => 'Color on Hover',
							),
						),
					),
				),
			),
		),
	)
);
