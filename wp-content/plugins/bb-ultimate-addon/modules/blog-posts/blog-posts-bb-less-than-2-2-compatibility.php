<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Advanced Posts Module
 */

FLBuilder::register_module(
	'BlogPostsModule',
	array(
		'general'          => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'         => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array(
						'is_carousel' => array(
							'type'    => 'select',
							'label'   => __( 'Post Appearance', 'uabb' ),
							'default' => 'grid',
							'help'    => __( 'This is how your posts you want to display.', 'uabb' ),
							'options' => array(
								'carousel' => __( 'Carousel', 'uabb' ),
								'grid'     => __( 'Grid', 'uabb' ),
								'feed'     => __( 'Feeds', 'uabb' ),
								'masonary' => __( 'Masonry', 'uabb' ),
							),
							'toggle'  => array(
								'masonary' => array(
									'fields' => array( 'mesonry_equal_height' ),
								),
							),
						),
					),
				),
				'grid_filter'     => array(
					'title'  => __( 'Number of Posts to Show ', 'uabb' ),
					'fields' => array(
						'post_per_grid'         => array(
							'type'    => 'select',
							'label'   => __( 'Desktop', 'uabb' ),
							'help'    => __( 'This is how many grid columns you want to show.', 'uabb' ),
							'default' => '3',
							'options' => array(
								'1' => __( '1 Column', 'uabb' ),
								'2' => __( '2 Columns', 'uabb' ),
								'3' => __( '3 Columns', 'uabb' ),
								'4' => __( '4 Columns', 'uabb' ),
								'5' => __( '5 Columns', 'uabb' ),
								'6' => __( '6 Columns', 'uabb' ),
								'7' => __( '7 Columns', 'uabb' ),
								'8' => __( '8 Columns', 'uabb' ),
							),
						),
						'post_per_grid_desktop' => array(
							'type'    => 'select',
							'label'   => __( 'Desktop', 'uabb' ),
							'default' => '3',
							'help'    => __( 'This is how many posts you want to show at one time on desktop.', 'uabb' ),
							'options' => array(
								'1' => __( '1 Column', 'uabb' ),
								'2' => __( '2 Columns', 'uabb' ),
								'3' => __( '3 Columns', 'uabb' ),
								'4' => __( '4 Columns', 'uabb' ),
								'5' => __( '5 Columns', 'uabb' ),
								'6' => __( '6 Columns', 'uabb' ),
								'7' => __( '7 Columns', 'uabb' ),
								'8' => __( '8 Columns', 'uabb' ),
							),
						),
						'post_per_grid_medium'  => array(
							'type'    => 'select',
							'label'   => __( 'Medium Devices', 'uabb' ),
							'default' => '2',
							'help'    => __( 'This is how many posts you want to show at one time on tablet devices.', 'uabb' ),
							'options' => array(
								'1' => __( '1 Column', 'uabb' ),
								'2' => __( '2 Columns', 'uabb' ),
								'3' => __( '3 Columns', 'uabb' ),
								'4' => __( '4 Columns', 'uabb' ),
								'5' => __( '5 Columns', 'uabb' ),
								'6' => __( '6 Columns', 'uabb' ),
								'7' => __( '7 Columns', 'uabb' ),
								'8' => __( '8 Columns', 'uabb' ),
							),
						),
						'post_per_grid_small'   => array(
							'type'    => 'select',
							'label'   => __( 'Small Devices', 'uabb' ),
							'default' => '1',
							'help'    => __( 'This is how many posts you want to show at a time on mobile devices.', 'uabb' ),
							'options' => array(
								'1' => __( '1 Column', 'uabb' ),
								'2' => __( '2 Columns', 'uabb' ),
								'3' => __( '3 Columns', 'uabb' ),
								'4' => __( '4 Columns', 'uabb' ),
							),
						),
					),
				),
				'carousel_filter' => array(
					'title'  => __( 'Carousel Filter', 'uabb' ),
					'fields' => array(
						'slides_to_scroll'           => array(
							'type'        => 'unit',
							'label'       => __( 'Posts to Scroll', 'uabb' ),
							'help'        => __( 'This is how many posts you want to scroll at a time.', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
						),
						'autoplay'                   => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay Post Scroll', 'uabb' ),
							'help'    => __( 'Enables auto play of posts.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'animation_speed' ),
								),
							),
						),
						'animation_speed'            => array(
							'type'        => 'unit',
							'label'       => __( 'Autoplay Speed', 'uabb' ),
							'help'        => __( 'Enter the time interval to scroll post automatically.', 'uabb' ),
							'placeholder' => '1000',
							'size'        => '8',
							'description' => __( 'ms', 'uabb' ),
						),
						'infinite_loop'              => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'help'    => __( 'Enable this to scroll posts in infinite loop.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'lazyload'                   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Lazy Load', 'uabb' ),
							'help'    => __( 'Enable this to load the image as soon as user slide to it.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_arrow'               => array(
							'type'    => 'select',
							'label'   => __( 'Enable Arrows', 'uabb' ),
							'help'    => __( 'Enable Next/Prev arrows to your carousel slider.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_dots'                => array(
							'type'    => 'select',
							'label'   => __( 'Enable Dots', 'uabb' ),
							'help'    => __( 'Enable Dots for the navigation', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'post_dots_size', 'post_dots_color' ),
								),
							),
						),
						'arrow_position'             => array(
							'type'    => 'select',
							'label'   => __( 'Arrow Position', 'uabb' ),
							'default' => 'outside',
							'options' => array(
								'outside' => __( 'Outside', 'uabb' ),
								'inside'  => __( 'Inside', 'uabb' ),
							),
						),
						'icon_left'                  => array(
							'type'        => 'icon',
							'label'       => __( 'Left Arrow Icon', 'uabb' ),
							'show_remove' => true,
						),
						'icon_right'                 => array(
							'type'        => 'icon',
							'label'       => __( 'Right Arrow Icon', 'uabb' ),
							'show_remove' => true,
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
							'type'       => 'color',
							'label'      => __( 'Arrow Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'arrow_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'arrow_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'arrow_color_border'         => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'arrow_border_size'          => array(
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'default'     => '1',
							'description' => 'px',
							'size'        => '8',
							'max_length'  => '3',
						),
						'post_dots_size'             => array(
							'type'    => 'unit',
							'label'   => __( 'Dots Size', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => true,
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts .slick-dots li button:before',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'post_dots_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Dots Color', 'uabb' ),
							'show_alpha'  => 'true',
							'show_reset'  => 'true',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts ul.slick-dots li button:before, .uabb-blog-post ul.slick-dots li.slick-active button:before',
								'property' => 'color',
							),
						),
					),
				),
				'uabb_message'    => array(
					'title'  => __( 'Message', 'uabb' ),
					'fields' => array(
						'no_results_message' => array(
							'type'    => 'text',
							'label'   => __( 'No Results Message', 'uabb' ),
							'default' => __( "Sorry, we couldn't find any posts. Please try a different search.", 'uabb' ),
						),
						'show_search'        => array(
							'type'    => 'select',
							'label'   => __( 'Show Search', 'uabb' ),
							'default' => '1',
							'options' => array(
								'1' => __( 'Show', 'uabb' ),
								'0' => __( 'Hide', 'uabb' ),
							),
							'help'    => __( 'Shows the search form if no posts are found.', 'uabb' ),
						),
					),
				),
			),
		),
		'post_type_filter' => array(
			'title' => __( 'Query', 'uabb' ),
			'file'  => plugin_dir_path( __FILE__ ) . 'includes/loop-settings.php',
		),
		'uabb_controls'    => array(
			'title'    => __( 'Controls', 'uabb' ),
			'sections' => array(
				'image_settings'   => array(
					'title'  => __( 'Featured Image', 'uabb' ),
					'fields' => array(
						'show_featured_image'        => array(
							'type'    => 'select',
							'label'   => __( 'Display Featured Image', 'uabb' ),
							'help'    => __( 'Enable this to display featured image of posts in a module.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'featured_image_size'        => array(
							'type'    => 'select',
							'label'   => __( 'Featured Image Size', 'uabb' ),
							'default' => 'medium',
							'help'    => __( 'Select featured image size. *For custom size - please clear page builder cache to take changes in effect.', 'uabb' ),
							'options' => apply_filters(
								'uabb_blog_posts_featured_image_sizes',
								array(
									'full'      => __( 'Full', 'uabb' ),
									'large'     => __( 'Large', 'uabb' ),
									'medium'    => __( 'Medium', 'uabb' ),
									'thumbnail' => __( 'Thumbnail', 'uabb' ),
									'custom'    => __( 'Custom', 'uabb' ),
								)
							),
						),
						'featured_image_size_width'  => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Image Width', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
						),
						'featured_image_size_height' => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Image Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
				'title_settings'   => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'show_title' => array(
							'type'    => 'select',
							'label'   => __( 'Display Title', 'uabb' ),
							'help'    => __( 'Enable this to display title of posts in a module.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'title_typography' ),
								),
							),
						),
					),
				),
				'meta_settings'    => array(
					'title'  => __( 'Post Meta', 'uabb' ),
					'fields' => array(
						'show_meta'       => array(
							'type'    => 'select',
							'label'   => __( 'Display Meta Information', 'uabb' ),
							'help'    => __( 'Enable this to display post meta information in a module.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'meta_typography' ),
								),
							),
						),
						'show_author'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Author', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_date'       => array(
							'type'    => 'select',
							'label'   => __( 'Show Date', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'date_format' ),
								),
							),
						),
						'date_format'     => array(
							'type'    => 'select',
							'label'   => __( 'Date Format', 'uabb' ),
							'default' => 'M j, Y',
							'options' => array(
								'M j, Y' => date_i18n( 'M j, Y' ),
								'F j, Y' => date_i18n( 'F j, Y' ),
								'm/d/Y'  => date_i18n( 'm/d/Y' ),
								'm-d-Y'  => date_i18n( 'm-d-Y' ),
								'm.d.Y'  => date_i18n( 'm.d.Y' ),
								'd M Y'  => date_i18n( 'd M Y' ),
								'd F Y'  => date_i18n( 'd F Y' ),
								'd-m-Y'  => date_i18n( 'd-m-Y' ),
								'd.m.Y'  => date_i18n( 'd.m.Y' ),
								'd/m/Y'  => date_i18n( 'd/m/Y' ),
								'Y-m-d'  => date_i18n( 'Y-m-d' ),
								'Y.m.d'  => date_i18n( 'Y.m.d' ),
								'Y/m/d'  => date_i18n( 'Y/m/d' ),
								'M, Y'   => date_i18n( 'M, Y' ),
								'M Y'    => date_i18n( 'M Y' ),
								'F, Y'   => date_i18n( 'F, Y' ),
								'F Y'    => date_i18n( 'F Y' ),
							),
						),
						'show_categories' => array(
							'type'    => 'select',
							'label'   => __( 'Show Categories', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_tags'       => array(
							'type'    => 'select',
							'label'   => __( 'Show Tags', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_comments'   => array(
							'type'    => 'select',
							'label'   => __( 'Show Comments', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'excerpt_settings' => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'show_excerpt'       => array(
							'type'    => 'select',
							'label'   => __( 'Display Content', 'uabb' ),
							'help'    => __( 'Enable this to display content of posts in a module.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'content_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Content Type', 'uabb' ),
							'default' => 'excerpt',
							'options' => array(
								'excerpt' => __( 'Excerpt', 'uabb' ),
								'content' => __( 'Full Content', 'uabb' ),
								'custom'  => __( 'Custom Word Count', 'uabb' ),
							),
							'toggle'  => array(
								'excerpt' => array(
									'fields' => array( 'strip_content_html' ),
								),
								'content' => array(
									'fields' => array( 'strip_content_html' ),
								),
								'custom'  => array(
									'fields' => array( 'excerpt_count' ),
								),
							),
						),
						'strip_content_html' => array(
							'type'    => 'select',
							'label'   => __( 'Remove Line Breaks', 'uabb' ),
							'help'    => __( 'Enable this to display content without paragraphs and line breaks.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'excerpt_count'      => array(
							'type'    => 'unit',
							'label'   => __( 'Excerpt Count', 'uabb' ),
							'help'    => __( 'Enter the value to limit post content words. Keep it empty for default excerpt', 'uabb' ),
							'default' => '18',
							'size'    => '8',
						),
					),
				),
				'cta'              => array(
					'title'  => __( 'Call to Action', 'uabb' ),
					'fields' => array(
						'cta_type'      => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'help'    => __( 'Select the call to action type for your posts.', 'uabb' ),
							'default' => 'link',
							'options' => array(
								'none'   => _x( 'None', 'Call to action.', 'uabb' ),
								'link'   => __( 'Text', 'uabb' ),
								'button' => __( 'Button', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(),
								'link'   => array(
									'fields'   => array( 'cta_text', 'link_target' ),
									'sections' => array( 'link_typography' ),
								),
								'button' => array(
									'sections' => array( 'btn-colors', 'btn-icon', 'btn-style', 'btn-structure', 'btn_typography' ),
									'fields'   => array( 'btn_text', 'link_target' ),
								),

							),
						),
						'cta_text'      => array(
							'type'    => 'text',
							'label'   => __( 'Enter Text', 'uabb' ),
							'help'    => __( 'Enter the text for your call to action link.', 'uabb' ),
							'default' => __( 'Read More', 'uabb' ),
						),
						'btn_text'      => array(
							'type'    => 'text',
							'label'   => __( 'Enter Text', 'uabb' ),
							'help'    => __( 'Enter the text for your call to action button.', 'uabb' ),
							'default' => __( 'Click Here', 'uabb' ),
						),
						'link_target'   => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'uabb' ),
							'help'    => __( 'Controls where CTA link will open after click.', 'uabb' ),
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
							'label'       => __( 'Link nofollow', 'uabb' ),
							'description' => '',
							'default'     => '0',
							'help'        => __( 'Enable this to make this link nofollow', 'uabb' ),
							'options'     => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'btn-style'        => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'btn_style'                      => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'class'   => 'creative_button_styles',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'threed'      => __( '3D', 'uabb' ),
							),
						),
						'btn_border_size'                => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '2',
						),
						'btn_transparent_button_options' => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'transparent-fade',
							'options' => array(
								'none'                    => __( 'None', 'uabb' ),
								'transparent-fade'        => __( 'Fade Background', 'uabb' ),
								'transparent-fill-top'    => __( 'Fill Background From Top', 'uabb' ),
								'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
								'transparent-fill-left'   => __( 'Fill Background From Left', 'uabb' ),
								'transparent-fill-right'  => __( 'Fill Background From Right', 'uabb' ),
								'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
								'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
								'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
							),
						),
						'btn_threed_button_options'      => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'threed_down',
							'options' => array(
								'threed_down'    => __( 'Move Down', 'uabb' ),
								'threed_up'      => __( 'Move Up', 'uabb' ),
								'threed_left'    => __( 'Move Left', 'uabb' ),
								'threed_right'   => __( 'Move Right', 'uabb' ),
								'animate_top'    => __( 'Animate Top', 'uabb' ),
								'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
							),
						),
						'btn_flat_button_options'        => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'                => __( 'None', 'uabb' ),
								'animate_to_left'     => __( 'Appear Icon From Right', 'uabb' ),
								'animate_to_right'    => __( 'Appear Icon From Left', 'uabb' ),
								'animate_from_top'    => __( 'Appear Icon From Top', 'uabb' ),
								'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
							),
						),
					),
				),
				'btn-icon'         => array( // Section.
					'title'  => __( 'Icons', 'uabb' ),
					'fields' => array(
						'btn_icon'          => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'btn_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
					),
				),
				'btn-colors'       => array( // Section.
					'title'  => __( 'Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'btn_text_hover_color'   => array(
							'type'       => 'color',
							'label'      => __( 'Text Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'btn_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'btn_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'btn_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'hover_attribute'        => array(
							'type'    => 'select',
							'label'   => __( 'Apply Hover Color To', 'uabb' ),
							'default' => 'bg',
							'options' => array(
								'border' => __( 'Border', 'uabb' ),
								'bg'     => __( 'Background', 'uabb' ),
							),
							'width'   => '75px',
						),
					),
				),
				'btn-structure'    => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'btn_width'                => array(
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
									'fields' => array( 'btn_align', 'btn_mob_align' ),
								),
								'full'   => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom', 'btn_padding_left_right' ),
								),
							),
						),
						'button_padding_dimension' => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border_style'      => array(
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
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-style',
							),
						),
						'button_border_width'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'button_border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'button_border_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-color',
							),
						),
						'border_hover_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'btn_custom_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Width', 'uabb' ),
							'default'     => '200',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'btn_custom_height'        => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Height', 'uabb' ),
							'default'     => '45',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'btn_padding_top_bottom'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'btn_padding_left_right'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'btn_border_radius'        => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
					),
				),
			),
		),
		'layout'           => array(
			'title'    => __( 'Layout', 'uabb' ), // Tab title.
			'sections' => array( // Tab Section.
				'post_styles'     => array(
					'title'  => __( 'Post Layout Sort Order', 'uabb' ),
					'fields' => array(
						'blog_image_position' => array(
							'type'    => 'select',
							'label'   => __( 'Image Position', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'top'        => __( 'Stacked', 'uabb' ),
								'left'       => __( 'Left', 'uabb' ),
								'right'      => __( 'Right', 'uabb' ),
								'background' => __( 'Background', 'uabb' ),
							),
							'toggle'  => array(
								'background' => array(
									'fields' => array( 'overlay_color', 'overlay_color_opc' ),
								),
							),
						),
						'overlay_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Overlay Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'overlay_color_opc'   => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'mobile_structure'    => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline' => __( 'Inline', 'uabb' ),
								'stack'  => __( 'Stack', 'uabb' ),
							),
						),
						'layout_sort_order'   => array(
							'type'    => 'uabb-sortable',
							'label'   => __( 'Layout Sort', 'uabb' ),
							'default' => 'img,title,meta,content,cta',
							'options' => array(
								'img'     => __( 'Featured Image', 'uabb' ),
								'title'   => __( 'Title', 'uabb' ),
								'meta'    => __( 'Meta', 'uabb' ),
								'content' => __( 'Content', 'uabb' ),
								'cta'     => __( 'CTA', 'uabb' ),
							),
						),
					),
				),
				'meta_sort_order' => array(
					'title'  => __( 'Post Meta Sort Order', 'uabb' ),
					'fields' => array(
						'meta_sort_order' => array(
							'type'    => 'uabb-sortable',
							'label'   => __( 'Meta Layout Sort', 'uabb' ),
							'default' => 'author,date,taxonomy,comment',
							'options' => array(
								'author'   => __( 'Author', 'uabb' ),
								'date'     => __( 'Date', 'uabb' ),
								'taxonomy' => __( 'Taxonomy', 'uabb' ),
								'comment'  => __( 'Comment', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'            => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'alignment'             => array(
					'title'  => __( 'Content Basic Styling', 'uabb' ),
					'fields' => array(
						'overall_alignment'         => array(
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'help'    => __( 'Controls the content alignment of each individual post.', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content',
								'property' => 'text-align',
							),
						),
						'overall_padding_dimension' => array(
							'type'        => 'dimension',
							'label'       => __( 'Overall Padding', 'uabb' ),
							'help'        => __( 'Manage the outside spacing of entire area of post.', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-inner-wrap',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '0',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'element_space'             => array(
							'type'        => 'unit',
							'label'       => __( 'Space Between Posts', 'uabb' ),
							'size'        => '8',
							'placeholder' => '15',
							'description' => 'px',
							'help'        => __( 'Manage the spacing between two posts.', 'uabb' ),
						),
						'below_element_space'       => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom Spacing', 'uabb' ),
							'size'        => '8',
							'placeholder' => '30',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-wrapper',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'show_box_shadow'           => array(
							'type'    => 'select',
							'label'   => __( 'Show Box Shadow', 'uabb' ),
							'help'    => __( 'Enable this to display box shadow for each individual post.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_date_box'             => array(
							'type'    => 'select',
							'label'   => __( 'Show Date Box', 'uabb' ),
							'help'    => __( 'Enable this to display date box at top left corner of each individual post.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'date_box_format' ),
									'sections' => array( 'date_typography' ),
								),
							),
						),
						'date_box_format'           => array(
							'type'    => 'select',
							'label'   => __( 'Date Format', 'uabb' ),
							'default' => 'M j, Y',
							'options' => array(
								'M j Y' => date_i18n( 'M j Y' ),
								'F j Y' => date_i18n( 'F j Y' ),
								'm d Y' => date_i18n( 'm d Y' ),
								'd m Y' => date_i18n( 'd m Y' ),
								'Y m d' => date_i18n( 'Y m d' ),
							),
						),
						'equal_height_box'          => array(
							'type'    => 'select',
							'label'   => __( 'Equal Height Boxes', 'uabb' ),
							'help'    => __( 'Enable this to display all posts with same height.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'mesonry_equal_height'      => array(
							'type'    => 'select',
							'label'   => __( 'Masonry Equal Height', 'uabb' ),
							'help'    => __( 'Enable this to display all posts with same height.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'style'                 => array(
					'title'  => __( 'Content Area Styling', 'uabb' ),
					'fields' => array(
						'content_padding_dimension'    => array(
							'type'        => 'dimension',
							'label'       => __( 'Content Padding', 'uabb' ),
							'help'        => __( 'Manage the outside spacing of content area of post.', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'content_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Content Background Color', 'uabb' ),
							'default'    => 'f6f6f6',
							'help'       => __( 'Controls the background color of content area (Area below the featured image).', 'uabb' ),
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-shadow',
								'property' => 'background',
							),
						),
						'content_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'content_border_type'          => array(
							'type'    => 'select',
							'label'   => __( 'Border Type', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-shadow',
								'property' => 'border-style',
							),
						),
						'conetnt_border_width'         => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-shadow',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'content_border_radius'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-shadow',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'content_border_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-shadow',
								'property' => 'border-color',
							),
						),

					),
				),
				'pagination_setting'    => array(
					'title'  => __( 'Pagination', 'uabb' ),
					'fields' => array(
						'show_pagination'      => array(
							'type'    => 'select',
							'label'   => __( 'Show Pagination', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'pagination' ),
								),
							),
						),
						'pagination'           => array(
							'type'    => 'select',
							'label'   => __( 'Pagination Style', 'uabb' ),
							'default' => 'numbers',
							'options' => array(
								'numbers' => __( 'Numbers', 'uabb' ),
								'scroll'  => __( 'Scroll', 'uabb' ),
							),
							'toggle'  => array(
								'numbers' => array(
									'sections' => array( 'pagination_style' ),
								),
								'scroll'  => array(
									'fields' => array( 'show_paginate_loader' ),
								),
							),
						),
						'show_paginate_loader' => array(
							'type'    => 'select',
							'label'   => __( 'Show Loader', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'posts_per_page'       => array(
							'type'        => 'unit',
							'label'       => __( 'Posts Per Page', 'uabb' ),
							'placeholder' => '10',
							'size'        => '8',
						),
					),
				),
				'pagination_style'      => array(
					'title'  => __( 'Pagination Style', 'uabb' ),
					'fields' => array(
						'pagination_alignment'            => array(
							'type'    => 'select',
							'label'   => __( 'Pagination Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-blogs-pagination ul',
								'property' => 'text-align',
							),
						),
						'pagination_style'                => array(
							'type'    => 'select',
							'label'   => __( 'Pagination Button Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'square'        => __( 'Flat', 'uabb' ),
								'square-border' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'square-border' => array(
									'fields' => array( 'pagination_color', 'pagination_color_border', 'pagination_active_color_border', 'pagination_active_color', 'pagination_border_size', 'pagination_border_style' ),
								),
								'square'        => array(
									'fields' => array(
										'pagination_color',
										'pagination_hover_color',
										'pagination_active_color',
										'pagination_background_color',
										'pagination_background_color_opc',
										'pagination_hover_background_color',
										'pagination_hover_background_color_opc',
										'pagination_active_background_color',
										'pagination_active_background_color_opc',
									),
								),
							),
						),
						'pagination_border_style'         => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
						),
						'pagination_border_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '2',
							'description' => 'px',
							'size'        => '8',
							'max_length'  => '3',
						),
						'pagination_color'                => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blogs-pagination li a.page-numbers',
								'property' => 'color',
							),
						),
						'pagination_hover_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'pagination_active_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Active Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blogs-pagination li span.page-numbers.current',
								'property' => 'color',
							),
						),
						'pagination_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blogs-pagination li a.page-numbers',
								'property' => 'background',
							),
						),
						'pagination_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'pagination_hover_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'pagination_hover_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'pagination_active_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Active Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blogs-pagination li span.page-numbers.current',
								'property' => 'background',
							),
						),
						'pagination_active_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'pagination_color_border'         => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'pagination_active_color_border'  => array(
							'type'       => 'color',
							'label'      => __( 'Border Active Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
				'masonary_style'        => array(
					'title'  => __( 'Taxonomy Filter Button Styling', 'uabb' ),
					'fields' => array(
						'masonary_overall_alignment'       => array(
							'type'    => 'select',
							'label'   => __( 'Button Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'help'    => __( 'Controls the alignment of filter button\'s section.', 'uabb' ),
						),
						'masonary_bottom_spacing'          => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom Spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '40',
							'size'        => '8',
							'help'        => __( 'Use this setting to manage the space between filters and post.', 'uabb' ),
						),
						'masonary_padding_dimension'       => array(
							'type'        => 'dimension',
							'label'       => __( 'Button Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '12',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'masonary_button_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Button Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'square'        => __( 'Flat', 'uabb' ),
								'square-border' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'square-border' => array(
									'fields' => array( 'masonary_text_color', 'masonary_color_border', 'masonary_active_color_border', 'masonary_active_color', 'masonary_border_size', 'masonary_border_style' ),
								),
								'square'        => array(
									'fields' => array(
										'masonary_text_color',
										'masonary_text_hover_color',
										'masonary_active_color',
										'masonary_background_color',
										'masonary_background_color_opc',
										'masonary_background_hover_color',
										'masonary_background_hover_color_opc',
										'masonary_background_active_color',
										'masonary_background_active_color_opc',
									),
								),
							),
						),
						'masonary_border_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
						),
						'masonary_border_size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '2',
							'size'        => '8',
						),
						'masonary_border_radius'           => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '2',
							'size'        => '8',
						),
						'masonary_text_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_text_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Hover Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_active_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Active Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_background_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_background_color_opc'    => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'masonary_background_hover_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Hover Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_background_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'masonary_background_active_color' => array(
							'type'       => 'color',
							'label'      => __( 'Active Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_background_active_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'masonary_color_border'            => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'masonary_active_color_border'     => array(
							'type'       => 'color',
							'label'      => __( 'Border Active Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
				'masonary_select_style' => array(
					'title'  => __( 'Drop-down Taxonomy Filter Styling', 'uabb' ),
					'fields' => array(
						'selfilter_width'             => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'selfilter_overall_alignment' => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'help'    => __( 'Controls the alignment of section.', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-masonary-filters-wrapper',
								'property' => 'text-align',
							),
						),
						'selfilter_bottom_spacing'    => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom Spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '40',
							'size'        => '8',
							'help'        => __( 'Use this setting to manage the space between filters and post.', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'selfilter_border_enable'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Border', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'selfilter_border_style', 'selfilter_border_size', 'selfilter_border_radius', 'selfilter_color_border' ),
								),
							),
						),
						'selfilter_border_style'      => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'border-style',
							),
						),
						'selfilter_border_size'       => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'default'     => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'selfilter_border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'placeholder' => '2',
							'size'        => '8',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'selfilter_color_border'      => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'border-color',
							),
						),
						'selfilter_background_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters',
								'property' => 'background',
							),
						),
					),
				),
			),
		),
		'typography'       => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title_typography'                        => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_tag_selection'    => array(
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
						'title_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-post-heading a',
							),
						),
						'title_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-heading a',
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
						'title_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-heading a',
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
						'title_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-post-heading a',
								'property' => 'color',
							),
						),
						'transform'              => array(
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
								'selector' => '.uabb-post-heading a',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'         => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-heading a',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'desc_typography'                         => array(
					'title'  => __( 'Description / Excerpt / Content', 'uabb' ),
					'fields' => array(
						'desc_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-blog-posts-description',
							),
						),
						'desc_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-description',
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
						'desc_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-description',
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
						'desc_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-description',
								'property' => 'color',
							),
						),
						'desc_transform'        => array(
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
								'selector' => '.uabb-blog-posts-description',
								'property' => 'text-transform',
							),
						),
						'desc_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-posts-description',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'meta_typography'                         => array(
					'title'  => __( 'Post Meta', 'uabb' ),
					'fields' => array(
						'meta_tag_selection'    => array(
							'type'    => 'select',
							'label'   => __( 'Meta Tag', 'uabb' ),
							'default' => 'h5',
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
						'meta_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-post-meta',
							),
						),
						'meta_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-meta a,.uabb-post-meta',
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
						'meta_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-meta',
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
						'meta_text_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Meta Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-post-meta',
								'property' => 'color',
							),
						),
						'meta_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Meta Link Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-post-meta a',
								'property' => 'color',
							),
						),
						'meta_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Meta Link Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'meta_transform'        => array(
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
								'selector' => '.uabb-post-meta a',
								'property' => 'text-transform',
							),
						),
						'meta_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-post-meta a',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'date_typography'                         => array(
					'title'  => __( 'Date Box', 'uabb' ),
					'fields' => array(
						'date_tag_selection'        => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h2',
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
						'date_font_family'          => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-posted-on',
							),
						),
						'date_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-posted-on',
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
						'date_color'                => array(
							'type'       => 'color',
							'label'      => __( 'Date Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-posted-on',
								'property' => 'color',
							),
						),
						'date_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Date Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-posted-on',
								'property' => 'background',
							),
						),
						'date_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'date_transform'            => array(
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
								'selector' => '.uabb-posted-on',
								'property' => 'text-transform',
							),
						),
						'date_letter_spacing'       => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-posted-on',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),

					),
				),
				'link_typography'                         => array(
					'title'  => __( 'Call to Action', 'uabb' ),
					'fields' => array(
						'link_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-read-more-text a',
							),
						),
						'link_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content .uabb-read-more-text a',
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
						'link_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content .uabb-read-more-text a',
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
						'link_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Link Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content .uabb-read-more-text a',
								'property' => 'color',
							),
						),
						'link_more_arrow_color' => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content .uabb-read-more-text span',
								'property' => 'color',
							),
						),
						'link_transform'        => array(
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
								'selector' => '.uabb-blog-post-content .uabb-read-more-text a',
								'property' => 'text-transform',
							),
						),
						'link_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-blog-post-content .uabb-read-more-text a',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),

					),
				),
				'btn_typography'                          => array(
					'title'  => __( 'CTA Button', 'uabb' ),
					'fields' => array(
						'btn_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => 'a.uabb-button',
							),
						),
						'btn_font_size_unit'   => array(
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
						'btn_line_height_unit' => array(
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
						'btn_transform'        => array(
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
								'selector' => 'a.uabb-button',
								'property' => 'text-transform',
							),
						),
						'btn_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'a.uabb-button',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'taxonomy_filter_select_field_typography' => array(
					'title'  => __( 'Taxonomy Filter', 'uabb' ),
					'fields' => array(
						'taxonomy_filter_select_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => 'select.uabb-masonary-filters, ul.uabb-masonary-filters',
							),
						),
						'taxonomy_filter_select_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters, ul.uabb-masonary-filters',
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
						'taxonomy_filter_select_color' => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters, ul.uabb-masonary-filters li',
								'property' => 'color',
							),
						),
						'taxonomy_transform'           => array(
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
								'selector' => 'select.uabb-masonary-filters, ul.uabb-masonary-filters li',
								'property' => 'text-transform',
							),
						),
						'taxonomy_letter_spacing'      => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'select.uabb-masonary-filters, ul.uabb-masonary-filters li',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);
