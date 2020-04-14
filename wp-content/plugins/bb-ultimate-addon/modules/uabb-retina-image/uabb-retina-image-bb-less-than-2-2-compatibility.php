<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Retina Image Module
 */

FLBuilder::register_module(
	'UABBRetinaImageModule',
	array(
		'general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'default_image'      => array( // Section.
					'title'  => 'Default Image', // Section Title.
					'fields' => array( // Section Fields.
						'default_img_source' => array(
							'type'    => 'select',
							'label'   => __( 'Image Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'default_img' ),
								),
								'url'     => array(
									'fields' => array( 'default_img_url' ),
								),
							),
						),
						'default_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Default Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'default_img_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Image URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-image.jpg',
							'connections' => array( 'string' ),
						),
					),
				),
				'retina_image'       => array( // Section.
					'title'  => 'Retina Image', // Section Title.
					'fields' => array( // Section Fields.
						'retina_img_source' => array(
							'type'    => 'select',
							'label'   => __( 'Image Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'retina_img' ),
								),
								'url'     => array(
									'fields' => array( 'retina_img_url' ),
								),
							),
						),
						'retina_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Retina Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'retina_img_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Image URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-image.jpg',
							'connections' => array( 'string' ),
						),
					),
				),
				'size_and_alignment' => array( // Section.
					'title'  => 'Size and Alignment', // Section Title.
					'fields' => array( // Section Fields.
						'photo_size'       => array(
							'type'        => 'unit',
							'label'       => __( 'Photo Size', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-content img',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'align'            => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-wrap, .uabb-retina-img-caption',
								'property' => 'text-align',
							),
						),
						'responsive_align' => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
					),
				),
				'caption'            => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'show_caption'   => array(
							'type'    => 'select',
							'label'   => __( 'Show Caption', 'uabb' ),
							'default' => '0',
							'options' => array(
								'0'              => __( 'None', 'uabb' ),
								'custom_caption' => __( 'Custom Caption', 'uabb' ),
							),
							'toggle'  => array(
								'0'              => array(),
								'custom_caption' => array(
									'fields'   => array( 'custom_caption' ),
									'sections' => array( 'caption_typo' ),
								),
							),
						),
						'custom_caption' => array(
							'type'        => 'text',
							'label'       => __( 'Custom Caption', 'uabb' ),
							'connections' => array( 'string' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-retina-img-caption',
							),
						),
					),
				),
				'link'               => array(
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'link_type'     => array(
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
									'fields' => array( 'link_url', 'link_target', 'link_nofollow' ),
								),
								'file' => array(),
								'page' => array(),
							),
							'help'    => __( 'Link type applies to how the image should be linked on click. You can choose a specific URL.', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'link_url'      => array(
							'type'        => 'link',
							'label'       => __( 'Link URL', 'uabb' ),
							'connections' => array( 'string', 'url' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'link_target'   => array(
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
						'link_nofollow' => array(
							'type'        => 'select',
							'label'       => __( 'Link Nofollow', 'uabb' ),
							'description' => '',
							'default'     => '0',
							'help'        => __( 'Enable this to make this link nofollow.', 'uabb' ),
							'options'     => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'   => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'image_style'  => array( // Section.
					'title'  => 'Image Style', // Section Title.
					'fields' => array( // Section Fields.
						'bg_size'                 => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'default'     => '',
							'help'        => __( 'Space between image and background', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-wrap .uabb-retina-img-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),

						'style_bg_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-wrap .uabb-retina-img-content',
								'property' => 'background-color',
							),
						),
						'style_bg_color_opc'      => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'bg_border_radius'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'default'     => '',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'hover_effect'            => array(
							'type'    => 'select',
							'label'   => __( 'Image Effect', 'uabb' ),
							'default' => 'opacity',
							'options' => array(
								'opacity'    => __( 'Opacity', 'uabb' ),
								'grayscale'  => __( 'Grayscale', 'uabb' ),
								'hue_rotate' => __( 'Hue Rotate', 'uabb' ),
								'simple'     => __( 'Simple', 'uabb' ),
							),
							'toggle'  => array(
								'opacity'    => array(
									'fields' => array( 'opacity', 'hover_opacity' ),
								),
								'grayscale'  => array(
									'fields' => array( 'img_grayscale_grayscale' ),
								),
								'hue_rotate' => array(
									'fields' => array( 'hue_deg', 'hover_hue_deg' ),
								),
								'simple'     => array(
									'fields' => array( 'img_grayscale_simple' ),
								),
							),
						),
						'opacity'                 => array(
							'type'        => 'unit',
							'label'       => __( 'Image Opacity', 'uabb' ),
							'default'     => '100',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '100',
						),
						'hover_opacity'           => array(
							'type'        => 'unit',
							'label'       => __( 'Image Hover Opacity', 'uabb' ),
							'default'     => '100',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '100',
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
						'hue_deg'                 => array(
							'type'    => 'unit',
							'label'   => __( 'Image Hue', 'uabb' ),
							'default' => '100',
							'units'   => array( 'deg', 'px' ),
							'slider'  => array(
								'deg' => array(
									'min'  => 0,
									'max'  => 360,
									'step' => 10,
								),
							),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'hover_hue_deg'           => array(
							'type'    => 'unit',
							'label'   => __( 'Image Hover Hue', 'uabb' ),
							'default' => '100',
							'units'   => array( 'deg', 'px' ),
							'slider'  => array(
								'deg' => array(
									'min'  => 0,
									'max'  => 360,
									'step' => 10,
								),
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
				'caption_typo' => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'tag'                   => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1' => 'h1',
								'h2' => 'h2',
								'h3' => 'h3',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
						),
						'font'                  => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
							),
						),
						'font_size_unit'        => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
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
						'line_height_unit'      => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
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
						'color'                 => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
							),
						),
						'transform'             => array(
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
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'        => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-retina-img-caption .uabb-retina-img-caption-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'heading_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-retina-img-caption',
								'unit'     => 'px',
							),
						),
						'heading_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-retina-img-caption',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);
