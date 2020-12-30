<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Video Gallery Module
 */

FLBuilder::register_module(
	'UABBVideoGallery',
	array(
		'video_gallery'             => array(
			'title'    => __( 'Video', 'uabb' ),
			'sections' => array(
				'gallery'                => array(
					'title'  => __( 'Gallery', 'uabb' ),
					'fields' => array(
						'form_gallery' => array(
							'type'         => 'form',
							'label'        => __( 'Video', 'uabb' ),
							'form'         => 'uabb_video_gallery_form',
							'multiple'     => true,
							'preview_text' => 'title',
							'default'      => array(
								array(
									'video_type'   => 'youtube',
									'youtube_link' => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
									'title'        => 'First Video',
									'tags'         => 'YouTube',
								),
								array(
									'video_type'   => 'vimeo',
									'youtube_link' => 'https://vimeo.com/274860274',
									'title'        => 'Second Video',
									'tags'         => 'Vimeo',
								),
								array(
									'video_type'   => 'wistia',
									'youtube_link' => '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>',
									'title'        => 'Third Video',
									'tags'         => 'Wistia',
								),
								array(
									'video_type'   => 'vimeo',
									'youtube_link' => 'https://vimeo.com/274860274',
									'title'        => 'Fourth Video',
									'tags'         => 'Vimeo',

								),
								array(
									'video_type'   => 'youtube',
									'youtube_link' => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
									'title'        => 'Fifth Video',
									'tags'         => 'YouTube',

								),
								array(
									'video_type'   => 'wistia',
									'youtube_link' => '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>',
									'title'        => 'Sixth Video',
									'tags'         => 'Wistia',
								),
							),
						),
					),
				),
				'general'                => array(
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'layout'          => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'grid',
							'options' => array(
								'grid'     => __( 'Grid', 'uabb' ),
								'carousel' => __( 'Carousel', 'uabb' ),
							),
							'toggle'  => array(
								'grid'     => array(
									'sections' => array( 'section_filter_content' ),
								),
								'carousel' => array(
									'sections' => array( 'section_slider_options' ),
								),
							),
						),
						'gallery_columns' => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'maxlength'  => '5',
							'size'       => '6',
							'responsive' => array(
								'default' => array(
									'default'    => '3',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
						),
						'video_ratio'     => array(
							'type'    => 'select',
							'label'   => __( 'Aspect Ratio', 'uabb' ),
							'default' => '16_9',
							'options' => array(
								'16_9' => __( '16:9', 'uabb' ),
								'4_3'  => __( '4:3', 'uabb' ),
								'3_2'  => __( '3:2', 'uabb' ),
							),
						),
						'click_action'    => array(
							'type'    => 'select',
							'label'   => __( 'Click Action', 'uabb' ),
							'default' => 'lightbox',
							'options' => array(
								'lightbox' => __( 'Play in Lightbox', 'uabb' ),
								'inline'   => __( 'Play Inline', 'uabb' ),
							),
						),
						'gallery_rand'    => array(
							'type'    => 'select',
							'label'   => __( 'Ordering', 'uabb' ),
							'default' => '',
							'options' => array(
								''     => __( 'Default', 'uabb' ),
								'rand' => __( 'Random', 'uabb' ),
							),
						),
					),
				),
				'section_filter_content' => array(
					'title'  => __( 'Filterable Tabs', 'uabb' ),
					'fields' => array(
						'show_filter'           => array(
							'type'    => 'select',
							'label'   => __( 'Filterable Video Gallery', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'filters_all_text', 'default_filter_switch', 'show_filter_title' ),
									'sections' => array( 'section_typography_cat_filters' ),
								),
							),
						),
						'filters_all_text'      => array(
							'type'        => 'text',
							'label'       => __( '"All" Tab Label', 'uabb' ),
							'default'     => __( 'All', 'uabb' ),
							'placeholder' => __( 'All', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'default_filter_switch' => array(
							'type'    => 'select',
							'label'   => __( 'Default Tab on Page Load', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'First', 'uabb' ),
								'yes' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'default_filter' ),
								),
							),
						),
						'default_filter'        => array(
							'type'        => 'text',
							'label'       => __( 'Enter Category Name', 'uabb' ),
							'help'        => __( 'Enter the category name that you wish to set as a default on page load.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'show_filter_title'     => array(
							'type'    => 'select',
							'label'   => __( 'Title for Filterable Tab', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'filters_heading_text' ),
									'sections' => array( 'section_title_typography' ),
								),
							),
						),
						'filters_heading_text'  => array(
							'type'        => 'text',
							'label'       => __( 'Title Text', 'uabb' ),
							'default'     => __( 'My Videos', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'section_slider_options' => array(
					'title'  => __( 'Carousel', 'uabb' ),
					'fields' => array(
						'slides_to_scroll' => array(
							'type'       => 'unit',
							'label'      => __( 'Slides To Scroll', 'uabb' ),
							'default'    => '1',
							'maxlength'  => '5',
							'size'       => '6',
							'responsive' => array(
								'default' => array(
									'default'    => '1',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'enable_dots'      => array(
							'type'    => 'select',
							'label'   => __( 'Enable Dots', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'dots_size', 'dots_color' ),
								),
							),
						),
						'enable_arrow'     => array(
							'type'    => 'select',
							'label'   => __( 'Enable arrow', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'arrows_size', 'arrows_color', 'arrow_border_radius', 'arrows_border_size' ),
								),
							),
						),
						'autoplay'         => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'autoplay_speed', 'pause_on_hover' ),
								),
							),
						),
						'autoplay_speed'   => array(
							'type'        => 'unit',
							'label'       => __( 'Autoplay Speed', 'uabb' ),
							'default'     => '5000',
							'description' => __( 'ms', 'uabb' ),
						),
						'pause_on_hover'   => array(
							'type'    => 'select',
							'label'   => __( 'Pause on Hover', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'infinite'         => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'transition_speed' => array(
							'type'        => 'unit',
							'label'       => __( 'Transition Speed', 'uabb' ),
							'default'     => '500',
							'description' => __( 'ms', 'uabb' ),
						),
					),
				),
			),
		),
		'section_design_layout'     => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'spacing_issue'               => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'column_gap' => array(
							'type'        => 'unit',
							'label'       => __( 'Columns Gap', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'default' => array(
									'default'    => '10',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'row_gap'    => array(
							'type'        => 'unit',
							'label'       => __( 'Rows Gap', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'default' => array(
									'default'    => '10',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
				'section_style_title_filters' => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'filter_title_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Title Color', 'uabb' ),
							'show_alpha'  => 'true',
							'show_resset' => 'true',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-title-text',
								'property' => 'color',
							),
						),
						'filters_tab_heading_stack' => array(
							'type'    => 'select',
							'label'   => __( 'Stack On', 'uabb' ),
							'default' => 'mobile',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'tablet' => __( 'Tablet', 'uabb' ),
								'mobile' => __( 'Mobile', 'uabb' ),
							),
							'help'    => __( 'Choose at what breakpoint the Title & Filter Tabs will stack.', 'uabb' ),
						),
					),
				),
				'section_style_cat_filters'   => array(
					'title'  => __( 'Filterable Tabs', 'uabb' ),
					'fields' => array(
						'cat_filter_align'               => array(
							'type'    => 'select',
							'label'   => __( 'Tab Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filters',
								'property' => 'text-align',
							),
						),
						'cat_filter_padding'             => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'cat_filter_bet_spacing'         => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing Between Tabs', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),

						),
						'cat_filter_spacing'             => array(
							'type'        => 'unit',
							'label'       => __( 'Tabs Bottom Spacing', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'cat_filter_color'               => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'show_alpha' => 'true',
							'show_reset' => 'true',
							'default'    => '',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'color',
							),
						),
						'cat_filter_hover_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Text Active / Hover', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter.uabb-filter__current',
								'property' => 'color',
							),
						),
						'cat_filter_bg_color_border'     => array(
							'type'    => 'select',
							'label'   => __( 'Background Color / Border ', 'uabb' ),
							'default' => 'background_color',
							'options' => array(
								'background_color' => __( 'Background Color', 'uabb' ),
								'border'           => __( 'Bottom Border', 'uabb' ),
							),
							'toggle'  => array(
								'background_color' => array(
									'fields' => array( 'cat_filter_bg_color', 'cat_filter_bg_hover_color' ),
								),
								'border'           => array(
									'fields' => array( 'cat_filter_border_type', 'cat_filter_border', 'cat_filter_border_color', 'cat_filter_border_active_type', 'cat_filter_border_active', 'cat_filter_border_color_active' ),
								),
							),
						),
						'cat_filter_bg_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'show_reset' => 'true',
							'default'    => '',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'background',
							),
						),
						'cat_filter_bg_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Background Active / Hover Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'default'    => '00b524',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter.uabb-filter__current',
								'property' => 'background-color',
							),
						),
						'cat_filter_border_type'         => array(
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filters',
								'property' => 'border-bottom-style',
							),
						),
						'cat_filter_border'              => array(
							'type'    => 'unit',
							'label'   => __( 'Bottom Border width', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filters',
								'property' => 'border-bottom-width',
								'unit'     => 'px',
							),
						),
						'cat_filter_border_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Bottom Border Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filters',
								'property' => 'border-color',
							),
						),
						'cat_filter_border_active_type'  => array(
							'type'    => 'select',
							'label'   => __( 'Active Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter:hover,.uabb-video__gallery-filter.uabb-filter__current',
								'property' => 'border-bottom-style',
							),
						),
						'cat_filter_border_active'       => array(
							'type'    => 'unit',
							'label'   => __( 'Active Bottom Border Width ', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter:hover,.uabb-video__gallery-filter.uabb-filter__current',
								'property' => 'border-bottom-width',
								'unit'     => 'px',
							),
						),
						'cat_filter_border_color_active' => array(
							'type'       => 'color',
							'label'      => __( ' Active Bottom Border Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter:hover,.uabb-video__gallery-filter.uabb-filter__current',
								'property' => 'border-color',
							),
						),
					),
				),
				'section_design_play'         => array(
					'title'  => __( 'Play Button', 'uabb' ),
					'fields' => array(
						'play_source'           => array(
							'type'    => 'select',
							'label'   => __( 'Image/Icon', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'img'     => __( 'Image', 'uabb' ),
								'icon'    => __( 'Icon', 'uabb' ),
							),
							'toggle'  => array(
								'img'     => array(
									'fields' => array( 'play_img' ),
								),
								'icon'    => array(
									'fields' => array( 'play_icon', 'play_icon_color', 'play_icon_hover_color' ),
								),
								'default' => array(
									'fields' => array( 'play_icon_color', 'play_icon_hover_color' ),
								),
							),
						),
						'play_img'              => array(
							'type'        => 'photo',
							'label'       => __( 'Select Image', 'uabb' ),
							'show_reset'  => 'true',
							'connections' => array( 'photo' ),
						),
						'play_icon'             => array(
							'type'       => 'icon',
							'label'      => __( 'Select Icon', 'uabb' ),
							'default'    => 'far fa-play-circle',
							'show_reset' => 'true',
						),
						'play_icon_size'        => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'default'     => '60',
							'description' => 'px',
							'responsive'  => array(
								'default' => array(
									'default'    => '60',
									'medium'     => '',
									'responsive' => '',
								),
							),

						),
						'hover_animation'       => array(
							'type'    => 'select',
							'label'   => __( 'Hover Animation', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'None', 'uabb' ),
								'sink'       => __( 'Sink', 'uabb' ),
								'float'      => __( 'Float', 'uabb' ),
								'pulse-grow' => __( 'Pulse-Grow', 'uabb' ),
								'shrink'     => __( 'Shrink', 'uabb' ),
								'pulse'      => __( 'Pulse', 'uabb' ),
							),
						),
						'play_icon_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'default'    => '',
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-video__content i,.uabb-vg__play i.uabb-vg__play-icon',
										'property' => 'color',
									),
									array(
										'selector' => '.uabb-video-gallery-icon-bg',
										'property' => 'fill',
									),
								),
							),
						),
						'play_icon_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type' => 'none',
							),
						),
					),
				),
				'section_design_caption'      => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'overlay_background_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Overlay Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-vg__overlay',
								'property' => 'background-color',
							),
						),
						'overlay_background_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Overlay Hover Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type' => 'none',
							),
						),
						'show_caption'                   => array(
							'type'    => 'select',
							'label'   => __( 'Show Caption on Hover', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'caption_color', 'caption_font', 'caption_font_size_unit', 'caption_line_height_unit', 'caption_letter_spacing', 'caption_transform' ),
									'sections' => array( 'section_typography_caption' ),
								),
							),
						),
						'caption_color'                  => array(
							'type'       => 'color',
							'label'      => __( 'Caption Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__caption',
								'property' => 'color',
							),
						),
						'show_tag'                       => array(
							'type'    => 'select',
							'label'   => __( 'Show Category on Hover', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'tag_color', 'tag_font', 'tag_font_size_unit', 'tag_line_height_unit', 'tag_letter_spacing', 'tag_transform' ),
									'sections' => array( 'section_typography_tag' ),
								),
							),
						),
						'tag_color'                      => array(
							'type'       => 'color',
							'label'      => __( 'Category Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__tags',
								'property' => 'color',
							),
						),
					),
				),
				'section_style_navigation'    => array(
					'title'  => __( 'Navigation', 'uabb' ),
					'fields' => array(
						'arrows_size'         => array(
							'type'        => 'unit',
							'label'       => __( 'Arrows Size', 'uabb' ),
							'description' => 'px',
						),
						'arrows_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Arrows Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-video-gallery-wrap.slick-slider .slick-arrow i',
										'property' => 'color',
									),
									array(
										'selector' => '.uabb-video-gallery-wrap.slick-slider .slick-arrow',
										'property' => 'border-color',
									),
								),
							),
						),
						'arrows_border_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Arrows Border Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-wrap.slick-slider .slick-arrow',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'arrow_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-wrap.slick-slider .slick-arrow',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'dots_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Dots Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-wrap .slick-dots li button:before',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'dots_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Dots Color', 'uabb' ),
							'show_alpha' => 'true',
							'show_reset' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-wrap .slick-dots li button:before,.uabb-video-gallery-wrap ul.slick-dots li.slick-active button:before',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
		'section_Typography_layout' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'section_title_typography'       => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'filter_title_tag'              => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1'  => __( 'H1', 'uabb' ),
								'h2'  => __( 'H2', 'uabb' ),
								'h3'  => __( 'H3', 'uabb' ),
								'h4'  => __( 'H4', 'uabb' ),
								'h5'  => __( 'H5', 'uabb' ),
								'h6'  => __( 'H6', 'uabb' ),
								'div' => __( 'div', 'uabb' ),
								'p'   => __( 'p', 'uabb' ),
							),
						),
						'filter_title_font'             => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-video-gallery-title-text',
							),
						),
						'filter_title_font_size_unit'   => array(
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
								'selector' => '.uabb-video-gallery-title-text',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'filter_title_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
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
								'selector' => '.uabb-video-gallery-title-text',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'filter_title_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-title-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'filter_title_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video-gallery-title-text',
								'property' => 'text-transform',
							),
						),
					),
				),
				'section_typography_cat_filters' => array(
					'title'  => __( 'Filterable Tabs', 'uabb' ),
					'fields' => array(
						'cat_font'                 => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-video__gallery-filter',
							),
						),
						'cat_font_size_unit'       => array(
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
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'cat_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
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
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'cat_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'cat_title_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__gallery-filter',
								'property' => 'text-transform',
							),
						),
					),
				),
				'section_typography_caption'     => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'caption_font'             => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-video__caption',
							),
						),
						'caption_font_size_unit'   => array(
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
								'selector' => '.uabb-video__caption',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'caption_line_height_unit' => array(
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
								'selector' => '.uabb-video__caption',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'caption_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video__caption',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'caption_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__caption',
								'property' => 'text-transform',
							),
						),
					),
				),
				'section_typography_tag'         => array(
					'title'  => __( 'Category', 'uabb' ),
					'fields' => array(
						'tag_font'             => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-video__tags',
							),
						),
						'tag_font_size_unit'   => array(
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
								'selector' => '.uabb-video__tags',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'tag_line_height_unit' => array(
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
								'selector' => '.uabb-video__tags',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'tag_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video__tags',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'tag_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video__tags',
								'property' => 'text-transform',
							),
						),
					),
				),
			),
		),
	)
);

// Add Video Gallery Items.
FLBuilder::register_settings_form(
	'uabb_video_gallery_form',
	array(
		'title' => __( 'Add Gallery Item', 'uabb' ),
		'tabs'  => array(
			'video_gallery_item' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'video_gallery_basic' => array(
						'title'  => __( 'Video Gallery', 'uabb' ),
						'fields' => array(
							'video_type'         => array(
								'type'    => 'select',
								'label'   => __( 'Video Type', 'uabb' ),
								'default' => 'youtube',
								'options' => array(
									'youtube' => __( 'YouTube', 'uabb' ),
									'vimeo'   => __( 'Vimeo', 'uabb' ),
									'wistia'  => __( 'Wistia', 'uabb' ),

								),
								'toggle'  => array(
									'youtube' => array(
										'fields' => array( 'youtube_link', 'yt_thumbnail_size' ),
									),
									'vimeo'   => array(
										'fields' => array( 'vimeo_link' ),
									),
									'wistia'  => array(
										'fields' => array( 'wistia_link' ),
									),
								),
							),
							'youtube_link'       => array(
								'type'        => 'text',
								'label'       => __( 'Link', 'uabb' ),
								'default'     => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
								'connections' => array( 'url' ),
								'description' => UABBVideoGallery::get_description( 'youtube_link' ),
							),
							'vimeo_link'         => array(
								'type'        => 'text',
								'label'       => __( 'Link', 'uabb' ),
								'default'     => 'https://vimeo.com/274860274',
								'connections' => array( 'url' ),
								'description' => UABBVideoGallery::get_description( 'vimeo_link' ),
							),
							'wistia_link'        => array(
								'type'        => 'text',
								'label'       => __( 'Link', 'uabb' ),
								'default'     => '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>',
								'description' => UABBVideoGallery::get_description( 'wistia_link' ),
								'connections' => array( 'url' ),
							),
							'title'              => array(
								'type'        => 'text',
								'label'       => __( 'Caption', 'uabb' ),
								'default'     => 'First Video',
								'help'        => __( 'This title will be for the Videos.', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'tags'               => array(
								'type'        => 'text',
								'label'       => __( 'Categories', 'uabb' ),
								'default'     => 'YouTube',
								'help'        => __( 'Add comma separated categories. These categories will be shown for filteration.', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'custom_placeholder' => array(
								'type'    => 'select',
								'label'   => __( 'Thumbnail', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'yes' => __( 'Custom Thumbnail', 'uabb' ),
									'no'  => __( 'Default Thumbnail', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'placeholder_image' ),
									),
									'no'  => array(
										'fields' => array( 'yt_thumbnail_size' ),
									),
								),
							),
							'yt_thumbnail_size'  => array(
								'type'    => 'select',
								'label'   => __( 'Thumbnail Size', 'uabb' ),
								'default' => 'hqdefault',
								'options' => array(
									'maxresdefault' => __( 'Maximum Resolution', 'uabb' ),
									'hqdefault'     => __( 'High Quality', 'uabb' ),
									'mqdefault'     => __( 'Medium Quality', 'uabb' ),
									'sddefault'     => __( 'Standard Quality', 'uabb' ),
								),
							),
							'placeholder_image'  => array(
								'type'        => 'photo',
								'label'       => __( 'Select Image', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
						),
					),
				),
			),
		),
	)
);
