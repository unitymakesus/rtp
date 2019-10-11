<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Video Module
 */

FLBuilder::register_module(
	'UABBVideo',
	array(
		'general'          => array(
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'       => array( // Section.
					'title'  => __( 'Video', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'video_type'   => array(
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
									'fields'   => array( 'youtube_link', 'end', 'start' ),
									'sections' => array( 'video_option' ),
									'tabs'     => array( 'yt_subscribe_bar' ),
								),
								'vimeo'   => array(
									'fields'   => array( 'vimeo_link', 'start' ),
									'sections' => array( 'vimeo_option' ),
								),
								'wistia'  => array(
									'fields'   => array( 'wistia_link' ),
									'sections' => array( 'wistia_option' ),
								),
							),
						),
						'youtube_link' => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'default'     => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
							'description' => UABBVideo::get_description( 'youtube_link' ),
							'connections' => array( 'url' ),
						),
						'vimeo_link'   => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'default'     => 'https://vimeo.com/274860274',
							'description' => UABBVideo::get_description( 'vimeo_link' ),
							'connections' => array( 'url' ),
						),
						'wistia_link'  => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'default'     => '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>',
							'description' => UABBVideo::get_description( 'wistia_link' ),
							'connections' => array( 'url' ),
						),
						'start'        => array(
							'type'        => 'unit',
							'label'       => __( 'Start Time', 'uabb' ),
							'default'     => '',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'sec',
							'help'        => __( 'Specify a start time (in seconds).', 'uabb' ),
						),
						'end'          => array(
							'type'        => 'unit',
							'label'       => __( 'End Time', 'uabb' ),
							'default'     => '',
							'max-length'  => '5',
							'size'        => '6',
							'description' => 'sec',
							'help'        => __( 'Specify a End time (in seconds).', 'uabb' ),
						),
						'aspect_ratio' => array(
							'type'    => 'select',
							'label'   => __( 'Aspect Ratio', 'uabb' ),
							'default' => '16_9',
							'options' => array(
								'16_9' => __( '16:9', 'uabb' ),
								'4_3'  => __( '4:3', 'uabb' ),
								'3_2'  => __( '3:2', 'uabb' ),
								'1:1'  => __( '1:1', 'uabb' ),
							),
						),
					),
				),
				'video_option'  => array(
					'title'  => __( 'Video Options', 'uabb' ),
					'fields' => array(
						'yt_autoplay'       => array(
							'type'    => 'select',
							'label'   => __( 'AutoPlay', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no' => array(
									'tabs' => array( 'thumbnail' ),
								),
							),
							'help'    => __( 'Thumbnail will not display if AutoPlay mode is enabled. ', 'uabb' ),
						),
						'yt_suggested'      => array(
							'type'    => 'select',
							'label'   => __( 'Suggested Videos', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'no'  => __( 'Hide', 'uabb' ),
								'yes' => __( 'Show', 'uabb' ),
							),
						),
						'yt_controls'       => array(
							'type'    => 'select',
							'label'   => __( 'Player Control', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'no'  => __( 'Current Video Channel', 'uabb' ),
								'yes' => __( 'Any Random Video', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'yt_modestbranding' ),
								),
							),
						),
						'yt_mute'           => array(
							'type'    => 'select',
							'label'   => __( 'Mute', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'yt_modestbranding' => array(
							'type'    => 'select',
							'label'   => __( 'Modest Branding', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'This option lets you use a YouTube player that does not show a YouTube logo.', 'uabb' ),
						),
						'yt_privacy'        => array(
							'type'    => 'select',
							'label'   => __( 'Privacy Mode', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( "When you turn on privacy mode, YouTube won't store information about visitors on your website unless they play the video.", 'uabb' ),
						),
					),
				),
				'vimeo_option'  => array(
					'title'  => __( 'Video option', 'uabb' ),
					'fields' => array(
						'vimeo_autoplay' => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no' => array(
									'tabs' => array( 'thumbnail' ),
								),
							),
							'help'    => __( 'Thumbnail will not display if AutoPlay mode is enabled.', 'uabb' ),
						),
						'vimeo_loop'     => array(
							'type'    => 'select',
							'label'   => __( 'Loop', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Choose a video to play continuously in a loop. The video will automatically start again after reaching the end.', 'uabb' ),
						),
						'vimeo_title'    => array(
							'type'    => 'select',
							'label'   => __( 'Intro Title', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
							'help'    => __( 'Displays title of the video.', 'uabb' ),
						),
						'vimeo_portrait' => array(
							'type'    => 'select',
							'label'   => __( 'Intro Portrait', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
							'help'    => __( 'Displays the author’s profile image.', 'uabb' ),
						),
						'vimeo_byline'   => array(
							'type'    => 'select',
							'label'   => __( 'Intro Byline', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
							'help'    => __( 'Displays the author’s name of the video.', 'uabb' ),
						),
						'vimeo_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Controls Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
						),
					),
				),
				'wistia_option' => array(
					'title'  => __( 'Video Options', 'uabb' ),
					'fields' => array(
						'wistia_autoplay' => array(
							'type'    => 'select',
							'label'   => __( 'AutoPlay', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no' => array(
									'tabs' => array( 'thumbnail' ),
								),
							),
							'help'    => __( 'Thumbnail will not display if AutoPlay mode is enabled. ', 'uabb' ),
						),
						'wistia_loop'     => array(
							'type'    => 'select',
							'label'   => __( 'Loop', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Choose a video to play continuously in a loop. The video will automatically start again after reaching the end.', 'uabb' ),
						),
						'wistia_controls' => array(
							'type'    => 'select',
							'label'   => __( 'Show Playbar', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'wistia_mute'     => array(
							'type'    => 'select',
							'label'   => __( 'Mute', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'thumbnail'        => array(
			'title'    => __( 'Thumbnail', 'uabb' ),
			'sections' => array(
				'section_image_overlay' => array(
					'title'  => __( 'Thumbnail & Overlay', 'uabb' ),
					'fields' => array(
						'show_image_overlay'  => array(
							'type'    => 'select',
							'label'   => __( 'Thumbnail', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Custom Thumbnail', 'uabb' ),
								'no'  => __( 'Default Thumbnail', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'image_overlay' ),
								),
								'no'  => array(
									'fields' => array( 'yt_thumbnail_size' ),
								),
							),
						),
						'yt_thumbnail_size'   => array(
							'type'    => 'select',
							'label'   => __( 'Default Thumbnail Size', 'uabb' ),
							'default' => 'maxresdefault',
							'options' => array(
								'maxresdefault' => __( 'Maximum Resolution', 'uabb' ),
								'hqdefault'     => __( 'High Quality', 'uabb' ),
								'mqdefault'     => __( 'Medium Quality', 'uabb' ),
								'sddefault'     => __( 'Standard Quality', 'uabb' ),
							),
						),
						'image_overlay'       => array(
							'type'        => 'photo',
							'label'       => __( 'Select Custom Thumbnail', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'image_overlay_color' => array(
							'type'       => 'color',
							'label'      => __( 'Overlay color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__outer-wrap:before',
								'property' => 'background',
							),
						),
						'video_double_click'  => array(
							'type'    => 'select',
							'label'   => __( 'Enable Double Click on Mobile', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Enable this option if you are not able to see custom thumbnail or overlay color on Mobile.', 'uabb' ),
						),
					),
				),
				'section_play_icon'     => array(
					'title'  => __( 'Play Button', 'uabb' ),
					'fields' => array(
						'play_source'                => array(
							'type'    => 'select',
							'label'   => __( 'Image/Icon', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'image'   => __( 'Image', 'uabb' ),
								'icon'    => __( 'Icon', 'uabb' ),
								'default' => __( 'Default', 'uabb' ),
							),
							'toggle'  => array(
								'image'   => array(
									'fields' => array(
										'play_img',
										'play_img_size',
									),
								),
								'icon'    => array(
									'fields' => array( 'play_icon', 'play_icon', 'play_icon_color', 'play_icon_hover_color' ),
								),
								'default' => array(
									'fields' => array(
										'play_default_icon_bg',
										'play_default_icon_bg_hover',
									),
								),
							),
						),
						'play_img'                   => array(
							'type'        => 'photo',
							'label'       => __( 'Select Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'play_icon'                  => array(
							'type'        => 'icon',
							'label'       => __( 'Select Icon', 'uabb' ),
							'default'     => 'far fa-play-circle',
							'show_remove' => true,
						),
						'play_icon_size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'default'     => '75',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						),
						'play_default_icon_bg'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-youtube-icon-bg,.uabb-vimeo-icon-bg',
								'property' => 'fill',
							),
						),
						'play_default_icon_bg_hover' => array(
							'type'       => 'color',
							'label'      => __( 'Hover Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type' => 'none',
							),
						),
						'play_icon_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video__play-icon',
								'property' => 'color',
							),
						),
						'play_icon_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type' => 'none',
							),
						),
						'hover_animation'            => array(
							'type'    => 'select',
							'label'   => __( 'Hover Animation', 'uabb' ),
							'default' => '',
							'options' => array(
								''                => __( 'None', 'uabb' ),
								'float'           => __( 'Float', 'uabb' ),
								'sink'            => __( 'Sink', 'uabb' ),
								'wobble-vertical' => __( 'Wobble Vertical', 'uabb' ),
							),
						),
					),
				),
			),
		),

		'sticky_video'     => array(
			'title'    => __( 'Sticky Video', 'uabb' ),
			'sections' => array(
				'section_sticky_enable'       => array(
					'title'  => __( 'Sticky Video Settings ', 'uabb' ),
					'fields' => array(
						'enable_sticky'      => array(
							'type'    => 'select',
							'label'   => __( 'Enable Sticky Video', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'sticky_alignment', 'sticky_video_width', 'sticky_hide_on' ),
									'sections' => array( 'section_background_sticky', 'section_sticky_close_button', 'heading_sticky_info_bar' ),
								),
								'no'  => array(
									'fields' => array( 'disable_sticky' ),
								),
							),
						),
						'sticky_alignment'   => array(
							'type'    => 'select',
							'label'   => __( 'Sticky Alignment', 'uabb' ),
							'default' => '',
							'options' => array(
								'top_left'     => __( ' Top Left', 'uabb' ),
								'top_right'    => __( ' Top Right ', 'uabb' ),
								'center_left'  => __( 'Center Left', 'uabb' ),
								'center_right' => __( 'Center Right', 'uabb' ),
								'bottom_left'  => __( 'Bottom Left', 'uabb' ),
								'bottom_right' => __( 'Bottom Right', 'uabb' ),
							),
						),
						'sticky_video_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Video Width', 'uabb' ),
							'default'     => '360',
							'placeholder' => 'auto',
							'maxlength'   => '6',
							'size'        => '8',
							'discription' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '360',
									'medium'     => '',
									'responsive' => '250',
								),
							),
						),
						'sticky_hide_on'     => array(
							'type'    => 'select',
							'label'   => __( 'Hide Sticky Video on', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'    => __( 'None', 'uabb' ),
								'desktop' => __( 'Desktop', 'uabb' ),
								'tablet'  => __( 'Tablet', 'uabb' ),
								'mobile'  => __( 'Mobile', 'uabb' ),
								'both'    => __( 'Tablet + Mobile', 'uabb' ),
							),
						),
					),
				),
				'section_background_sticky'   => array(
					'title'  => __( 'Background', 'uabb' ),
					'fields' => array(
						'sticky_video_margin'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Spacing from Edges', 'uabb' ),
							'responsive' => true,
							'help'       => __( 'Note: This is spacing around the sticky video with respect to the Alignment chosen.', 'uabb' ),
						),


						'sticky_video_padding' => array(
							'type'        => 'dimension',
							'label'       => __( 'Background Size', 'uabb' ),
							'responsive'  => true,
							'description' => 'px',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-bar',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),

						'sticky_video_color'   => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-sticky-content',
								'property' => 'background',
							),
						),
					),
				),
				'section_sticky_close_button' => array( // Section.
					'title'  => __( 'Close Button', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'enable_sticky_close_button' => array(
							'type'    => 'select',
							'label'   => __( 'Icon', 'uabb' ),
							'default' => 'icon',
							'options' => array(
								'icon' => __( 'Icon', 'uabb' ),
								'none' => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'icon' => array(
									'fields' => array( 'sticky_close_icon', 'sticky_close_icon_color', 'sticky_close_icon_bgcolor', 'sticky_hide_on' ),
								),
							),
						),

						'sticky_close_icon'          => array(
							'type'        => 'icon',
							'label'       => __( 'Select Icon', 'uabb' ),
							'default'     => 'fas fa-times',
							'show_remove' => true,
						),

						'sticky_close_icon_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '25',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',

						),
						'sticky_close_icon_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-close',
								'property' => 'color',
							),
						),
						'sticky_close_icon_bgcolor'  => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-close',
								'property' => 'color',
							),
						),
					),

				),
				'heading_sticky_info_bar'     => array(
					'title'  => __( 'Info Bar', 'uabb' ),
					'fields' => array(
						'sticky_info_bar_enable'     => array(
							'type'    => 'select',
							'label'   => __( 'Enable', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Enable this option to display the informative text under Sticky video.', 'uabb' ),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'sticky_info_bar_text', 'sticky_info_bar_color', 'sticky_info_bar_bgcolor', 'sticky_info_bar_padding' ),
								),
								'no'  => array(
									'fields' => array( 'disable_sticky' ),
								),
							),
						),

						'sticky_info_bar_text'       => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'placeholder' => __( 'This is info bar', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-video-sticky-infobar',
							),
						),

						'sticky_text_font'           => array(
							'type'    => 'font',
							'label'   => __( 'Font', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-video-sticky-infobar',
							),
						),
						'sticky_text_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-infobar',
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
						'sticky_text_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-infobar',
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
						'sticky_text_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-infobar',
								'property' => 'letter-spacing',
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
						'sticky_text_transform'      => array(
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
								'selector' => '.uabb-video-sticky-infobar',
								'property' => 'text-transform',
							),
						),

						'sticky_info_bar_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-infobar',
								'property' => 'color',
							),
						),
						'sticky_info_bar_bgcolor'    => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-video-sticky-infobar',
								'property' => 'color',
							),
						),
						'sticky_info_bar_padding'    => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-video-sticky-padding',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'yt_subscribe_bar' => array(
			'title'    => __( 'YouTube Subscribe Bar', 'uabb' ),
			'sections' => array(
				'enable_subscribe_bar'    => array(
					'title'  => __( 'YouTube Subscribe Bar', 'uabb' ),
					'fields' => array(
						'yt_subscribe_enable' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Subscribe Bar', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'select_options', 'yt_subscribe_text' ),
									'sections' => array( 'subscribe_field_options' ),
								),
							),
						),
						'select_options'      => array(
							'type'    => 'select',
							'label'   => __( 'Select Channel ID/Channel Name', 'uabb' ),
							'default' => 'channel_id',
							'options' => array(
								'channel_id'   => __( 'Channel ID', 'uabb' ),
								'channel_name' => __( 'Channel Name', 'uabb' ),
							),
							'toggle'  => array(
								'channel_name' => array(
									'fields' => array( 'yt_channel_name' ),
								),
								'channel_id'   => array(
									'fields' => array( 'yt_channel_id' ),
								),
							),
						),
						'yt_channel_name'     => array(
							'type'        => 'text',
							'label'       => __( 'YouTube Channel Name', 'uabb' ),
							'default'     => 'TheBrainstormForce',
							'description' => UABBVideo::get_description( 'yt_channel_name' ),
						),
						'yt_channel_id'       => array(
							'type'        => 'text',
							'label'       => __( 'YouTube Channel ID', 'uabb' ),
							'default'     => 'UCtFCcrvupjyaq2lax_7OQQg',
							'description' => UABBVideo::get_description( 'yt_channel_id' ),
						),
						'yt_subscribe_text'   => array(
							'type'        => 'text',
							'label'       => __( 'Subscribe to channel text', 'uabb' ),
							'default'     => 'Subscribe to our YouTube Channel',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'subscribe_field_options' => array(
					'title'  => __( 'Settings', 'uabb' ),
					'fields' => array(
						'show_count'                    => array(
							'type'    => 'select',
							'label'   => __( 'Show Subscribers Count', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
						'subscribe_text_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '
								.uabb-subscribe-bar-prefix',
								'property' => 'color',
							),
						),
						'subscribe_text_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '1b1b1b',
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-bar',
								'property' => 'background-color',
							),
						),
						'subscribe_text_font'           => array(
							'type'    => 'font',
							'label'   => __( 'Font', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-subscribe-bar-prefix',
							),
						),
						'subscribe_text_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font size', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-bar-prefix',
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
						'subscribe_text_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'default'     => '',
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-bar-prefix',
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
						'subscribe_text_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-bar-prefix',
								'property' => 'letter-spacing',
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
						'subscribe_text_transform'      => array(
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
								'selector' => '.uabb-subscribe-bar-prefix',
								'property' => 'text-transform',
							),
						),
						'subscribe_padding'             => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-bar',
								'property' => 'padding',
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
						'subscribe_bar_responsive'      => array(
							'type'    => 'select',
							'label'   => __( 'Stack on', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'    => __( 'None', 'uabb' ),
								'desktop' => __( 'Desktop', 'uabb' ),
								'tablet'  => __( 'Tablet', 'uabb' ),
								'mobile'  => __( 'Mobile', 'uabb' ),
							),
							'toggle'  => array(
								'desktop' => array(
									'fields' => array( 'subscribe_bar_spacing' ),
								),
								'tablet'  => array(
									'fields' => array( 'subscribe_bar_spacing' ),
								),
								'mobile'  => array(
									'fields' => array( 'subscribe_bar_spacing' ),
								),
							),
						),
						'subscribe_bar_spacing'         => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-subscribe-responsive-desktop .uabb-subscribe-bar-prefix',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);
