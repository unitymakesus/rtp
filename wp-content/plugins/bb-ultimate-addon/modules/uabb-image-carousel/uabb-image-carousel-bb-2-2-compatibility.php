<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Image Carousel Module
 */

FLBuilder::register_module(
	'UABBImageCarouselModule', array(
		'general'         => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'       => array(
					'title'  => '',
					'fields' => array(
						'photos'        => array(
							'type'        => 'multiple-photos',
							'label'       => __( 'Photos', 'uabb' ),
							'connections' => array( 'multiple-photos' ),
						),
						'photo_size'    => array(
							'type'    => 'select',
							'label'   => __( 'Photo Size', 'uabb' ),
							'default' => 'medium',
							'options' => apply_filters(
								'uabb_image_carousel_sizes', array(
									'thumbnail' => __( 'Thumbnail', 'uabb' ),
									'medium'    => __( 'Medium', 'uabb' ),
									'full'      => __( 'Full', 'uabb' ),
								)
							),
						),
						'photo_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Photo Spacing', 'uabb' ),
							'mode'        => 'padding',
							'placeholder' => '20',
							'size'        => '5',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
				'show_images'   => array(
					'title'  => __( 'Number of Photo to Show', 'uabb' ),
					'fields' => array(
						'grid_column'            => array(
							'type'    => 'select',
							'label'   => __( 'Desktop Grid', 'uabb' ),
							'default' => '4',
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
							'help'    => __( 'This is how many images you want to show at one time on desktop.', 'uabb' ),
						),
						'medium_grid_column'     => array(
							'type'    => 'select',
							'label'   => __( 'Medium Device Grid', 'uabb' ),
							'default' => '4',
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
							'help'    => __( 'This is how many images you want to show at one time on tablet devices.', 'uabb' ),
						),
						'responsive_grid_column' => array(
							'type'    => 'select',
							'label'   => __( 'Small Device Grid', 'uabb' ),
							'default' => '4',
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
							'help'    => __( 'This is how many images you want to show at one time on mobile devices.', 'uabb' ),
						),
					),
				),
				'image_setting' => array(
					'title'  => __( 'Photo Settings', 'uabb' ),
					'fields' => array(
						'show_captions'         => array(
							'type'    => 'select',
							'label'   => __( 'Show Captions', 'uabb' ),
							'default' => 'hover',
							'options' => array(
								'0'     => __( 'Never', 'uabb' ),
								'hover' => __( 'On Hover', 'uabb' ),
								'below' => __( 'Below Photo', 'uabb' ),
							),
							'help'    => __( 'The caption pulls from whatever text you put in the caption area in the media manager for each image.', 'uabb' ),
							'toggle'  => array(
								'hover' => array(
									'tabs' => array( 'typography' ),
								),
								'below' => array(
									'tabs'   => array( 'typography' ),
									'fields' => array( 'caption_bg_color', 'caption_bg_color_opc' ),
								),
							),
						),
						'click_action'          => array(
							'type'    => 'select',
							'label'   => __( 'Click Action', 'uabb' ),
							'default' => 'lightbox',
							'options' => array(
								'none'     => _x( 'None', 'Click action.', 'uabb' ),
								'lightbox' => __( 'Lightbox', 'uabb' ),
								'cta-link' => __( 'Photo Custom Link', 'uabb' ),
							),
							'toggle'  => array(
								'cta-link' => array(
									'fields' => array( 'click_action_target', 'click_action_nofollow' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),

						'click_action_target'   => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'uabb' ),
							'help'    => __( 'Controls where CTA link will open after click.', 'uabb' ),
							'default' => '_blank',
							'options' => array(
								'_self'  => __( 'Same Window', 'uabb' ),
								'_blank' => __( 'New Window', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'click_action_nofollow' => array(
							'type'    => 'select',
							'label'   => __( 'Link nofollow', 'uabb' ),
							'default' => '0',
							'help'    => __( 'Enable this to make this link nofollow.', 'uabb' ),
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'carousel_filter' => array(
			'title'    => __( 'Carousel', 'uabb' ),
			'sections' => array(
				'carousel_filter' => array(
					'title'  => __( 'Carousel Filter', 'uabb' ),
					'fields' => array(
						'slides_to_scroll' => array(
							'type'        => 'text',
							'label'       => __( 'Images to Scroll', 'uabb' ),
							'help'        => __( 'This is how many images you want to scroll at a time.', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
						),
						'autoplay'         => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay Image Scroll', 'uabb' ),
							'help'    => __( 'Enables auto play of images.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'animation_speed' ),
								),
							),
						),
						'animation_speed'  => array(
							'type'        => 'text',
							'label'       => __( 'Autoplay Speed', 'uabb' ),
							'help'        => __( 'Enter the time interval to scroll image automatically.', 'uabb' ),
							'placeholder' => '1000',
							'size'        => '8',
							'description' => 'ms',
						),
						'infinite_loop'    => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'help'    => __( 'Enable this to scroll images in infinite loop.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
						),
						'lazyload'         => array(
							'type'    => 'select',
							'label'   => __( 'Enable Lazy Load', 'uabb' ),
							'help'    => __( 'Enable this to load the image as soon as user slide to it.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_arrow'     => array(
							'type'    => 'select',
							'label'   => __( 'Enable Arrows', 'uabb' ),
							'help'    => __( 'Enable Next/Prev arrows to your carousel slider.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'arrow_section' ),
								),
							),
						),
					),
				),
				'arrow_section'   => array(
					'title'  => '',
					'fields' => array(
						'arrow_position'             => array(
							'type'    => 'select',
							'label'   => __( 'Arrow Position', 'uabb' ),
							'default' => 'outside',
							'options' => array(
								'outside' => __( 'Outside', 'uabb' ),
								'inside'  => __( 'Inside', 'uabb' ),
							),
						),
						'arrow_style'                => array(
							'type'    => 'select',
							'label'   => __( 'Arrow Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'square'        => __( 'Square Background', 'uabb' ),
								'circle'        => __( 'Circle Background', 'uabb' ),
								'square-border' => __( 'Square Border', 'uabb' ),
								'circle-border' => __( 'Circle Border', 'uabb' ),
							),
							'toggle'  => array(
								'square-border' => array(
									'fields' => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' ),
								),
								'circle-border' => array(
									'fields' => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' ),
								),
								'square'        => array(
									'fields' => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' ),
								),
								'circle'        => array(
									'fields' => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' ),
								),
							),
						),
						'arrow_color'                => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.slick-prev i, .slick-next i',
								'property' => 'color',
							),
						),
						'arrow_background_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.slick-prev i, .slick-next i',
								'property' => 'background',
							),
						),
						'arrow_background_color_opc' => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'%' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'arrow_color_border'         => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Border Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
						),
						'arrow_border_size'          => array(
							'type'       => 'unit',
							'label'      => __( 'Border Size', 'uabb' ),
							'default'    => '1',
							'units'      => array( 'px' ),
							'size'       => '8',
							'max_lenght' => '3',
							'slider'     => array(
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
		'style'           => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'hover_effects' => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'zoom-in',
							'options' => array(
								'none'        => __( 'None', 'uabb' ),
								'from-left'   => __( 'Overlay From Left', 'uabb' ),
								'from-right'  => __( 'Overlay From Right', 'uabb' ),
								'from-top'    => __( 'Overlay From Top', 'uabb' ),
								'from-bottom' => __( 'Overlay From Bottom', 'uabb' ),
								'zoom-in'     => __( 'Zoom In', 'uabb' ),
								'zoom-out'    => __( 'Zoom Out', 'uabb' ),
							),
							'toggle'  => array(
								'from-left'   => array(
									'sections' => array( 'overlay' ),
								),
								'from-right'  => array(
									'sections' => array( 'overlay' ),
								),
								'from-top'    => array(
									'sections' => array( 'overlay' ),
								),
								'from-bottom' => array(
									'sections' => array( 'overlay' ),
								),
								'zoom-in'     => array(
									'sections' => array( 'overlay' ),
								),
								'zoom-out'    => array(
									'sections' => array( 'overlay' ),
								),
							),
							'preview' => 'none',
						),
					),
				),
				'overlay' => array(
					'title'  => __( 'Overlay', 'uabb' ),
					'fields' => array(
						'overlay_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'preview'     => 'none',
							'connections' => array( 'color' ),
							'default'     => '000000',
							'show_reset'  => true,
						),
						'overlay_color_opc'  => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '70',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'%' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'icon'               => array(
							'type'    => 'select',
							'label'   => __( 'Overlay Icon', 'uabb' ),
							'default' => '0',
							'options' => array(
								'1' => __( 'Enable', 'uabb' ),
								'0' => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'1' => array(
									'fields' => array( 'overlay_icon', 'overlay_icon_size', 'overlay_icon_color' ),
								),
							),
							'preview' => 'none',
						),
						'overlay_icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Overlay Icon', 'uabb' ),
							'preview'     => 'none',
							'show_remove' => true,
						),
						'overlay_icon_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Overlay Icon Size', 'uabb' ),
							'placeholder' => '16',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => 'none',
						),
						'overlay_icon_color' => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Icon Color', 'uabb' ),
							'preview'     => 'none',
							'connections' => array( 'color' ),
							'default'     => '',
							'show_reset'  => true,
						),
					),
				),
			),
		),
		'typography'      => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'typography' => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'tag_selection'        => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h3',
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
						'img_typo'             => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-image-carousel-caption',
								'important' => true,
							),
						),
						'color'                => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image-carousel-caption',
								'property' => 'color',
							),
						),
						'caption_bg_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image-carousel-caption',
								'property' => 'background',
							),
						),
						'caption_bg_color_opc' => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'%' => array(
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
		'uabb_docs'       => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/uabb-filter-reference/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=Image-Carousel-module#module:-image-carousel" target="_blank" rel="noopener"> Filters Reference for Image Carousel module </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
