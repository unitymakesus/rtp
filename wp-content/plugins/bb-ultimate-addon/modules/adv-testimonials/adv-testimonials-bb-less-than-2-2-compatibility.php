<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package Advanced Testimonials
 */

FLBuilder::register_module(
	'UABBAdvancedTestimonialsModule',
	array(
		'general'                    => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'                   => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'tetimonial_layout' => array(
							'type'    => 'select',
							'label'   => __( 'Testimonial Layouts', 'uabb' ),
							'default' => 'slider',
							'class'   => 'uabb-testimonial-layout-selection',
							'options' => array(
								'slider' => __( 'Slider', 'uabb' ),
								'box'    => __( 'Box Layout', 'uabb' ),
							),
							'toggle'  => array(
								'slider' => array(
									'sections' => array( 'slider', 'slider_navigation' ),
									'tabs'     => array( 'testimonials' ),
									'fields'   => array( 'layout' ),
								),
								'box'    => array(
									'sections' => array( 'testimonial_title_section', 'testimonial_descr_section' ),
									'tabs'     => array( 'testimonial_image_noslider' ),
									'fields'   => array( 'layout_background', 'layout_background_opc', 'test_box_style' ),
								),
							),
						),
					),
				),
				'rating'                    => array(
					'title'  => __( 'Rating', 'uabb' ), // Section Title.
					'fields' => array(
						'enable_rating'   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Rating', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'rating_typography' ),
									'fields'   => array( 'rating_position' ),
								),
							),
						),
						'rating_position' => array(
							'type'    => 'select',
							'label'   => __( 'Rating Position', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Between Name & Designation', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'box_rating'      => array(
							'label'   => __( 'Testimonial Rating', 'uabb' ),
							'type'    => 'select',
							'default' => '5',
							'options' => array(
								'1' => __( '1', 'uabb' ),
								'2' => __( '2', 'uabb' ),
								'3' => __( '3', 'uabb' ),
								'4' => __( '4', 'uabb' ),
								'5' => __( '5', 'uabb' ),
							),
						),
					),
				),
				'slider'                    => array( // Section.
					'title'  => __( 'Slider Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'auto_play'       => array(
							'type'    => 'select',
							'label'   => __( 'Auto Play', 'uabb' ),
							'default' => '1',
							'options' => array(
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'1' => array(
									'fields' => array( 'pause', 'auto_hover' ),
								),
							),
						),
						'pause'           => array(
							'type'        => 'unit',
							'label'       => __( 'Delay', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'uabb' ),
						),
						'auto_hover'      => array(
							'type'    => 'select',
							'label'   => __( 'Pause on Hover', 'uabb' ),
							'default' => '1',
							'options' => array(
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							),
						),
						'transition'      => array(
							'type'    => 'select',
							'label'   => __( 'Transition', 'uabb' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => __( 'Slide', 'uabb' ),
								'fade'       => __( 'Fade', 'uabb' ),
							),
						),
						'speed'           => array(
							'type'        => 'unit',
							'label'       => __( 'Transition Speed', 'uabb' ),
							'placeholder' => '0.5',
							'maxlength'   => '4',
							'size'        => '5',
							'description' => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'uabb' ),
						),
						'adaptive_height' => array(
							'type'    => 'select',
							'label'   => __( 'Adaptive Height', 'uabb' ),
							'default' => 'false',
							'options' => array(
								'false' => __( 'No', 'uabb' ),
								'true'  => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
				'slider_navigation'         => array( // Section.
					'title'  => __( 'Navigation', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'navigation' => array(
							'type'    => 'select',
							'label'   => __( 'Navigation', 'uabb' ),
							'default' => 'wide',
							'options' => array(
								'compact'      => __( 'Show Arrow', 'uabb' ),
								'wide'         => __( 'Show Dots', 'uabb' ),
								'compact-wide' => __( 'Show Arrow and Dots', 'uabb' ),
							),
							'toggle'  => array(
								'compact'      => array(
									'sections' => array( 'slider_arrow' ),
								),
								'wide'         => array(
									'sections' => array( 'slider_dots' ),
								),
								'compact-wide' => array(
									'sections' => array( 'slider_arrow', 'slider_dots' ),
								),
							),
						),


					),
				),
				'slider_arrow'              => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						/* Arrow Fields */
						'arrow_style'          => array(
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
									'fields' => array( 'arrow_color', 'arrow_color_back', 'arrow_color_back_opc' ),
								),
								'circle'        => array(
									'fields' => array( 'arrow_color', 'arrow_color_back', 'arrow_color_back_opc' ),
								),
							),
						),
						'arrow_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.bx-prev i, .bx-next i',
								'property' => 'color',
							),
						),
						'arrow_color_back'     => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'arrow_color_back_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'arrow_color_border'   => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.bx-prev i, .bx-next i',
								'property' => 'border-color',
							),
						),
						'arrow_border_size'    => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'size'        => '8',
							'max_length'  => '3',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.bx-prev i, .bx-next i',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
					),
				),
				'slider_dots'               => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'dot_color' => array(
							'type'       => 'color',
							'label'      => __( 'Dot Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.bx-pager .bx-pager-item .bx-pager-link',
								'property' => 'background',
							),
						),
					),
				),

				/* Box Layout Options section */
				'testimonial_title_section' => array( // Section.
					'title'  => __( 'Title', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'testimonial_author_no_slider' => array(
							'type'        => 'text',
							'label'       => __( 'Author Name', 'uabb' ),
							'default'     => 'John Doe',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-testimonial-author-name',
							),
						),
						'testimonial_designation_no_slider' => array(
							'type'        => 'text',
							'label'       => __( 'Designation', 'uabb' ),
							'default'     => 'Designation',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-testimonial-author-designation',
							),
						),
					),
				),
				'testimonial_descr_section' => array( // Section.
					'title'  => __( 'Testimonial', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'testimonial_description' => array(
							'type'        => 'editor',
							'description' => '',
							'default'     => __( 'If you are looking for some awesome, knowledgeable people to work with, these are the guys I highly recommend. Their friendliness and result-driven approach is what I love about them.', 'uabb' ),
						),
					),
				),
			),
		),



		'testimonials'               => array( // Tab.
			'title'    => __( 'Testimonials', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'testimonials' => array(
							'type'         => 'form',
							'label'        => __( 'Testimonial', 'uabb' ),
							'form'         => 'uabb_testimonials_form', // ID from registered form below.
							'preview_text' => 'testimonial_author', // Name of a field to use for the preview text.
							'multiple'     => true,
						),
					),
				),
			),
		),
		'testimonial_image_noslider' => array( // Tab.
			'title'    => __( 'Image', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				/* Icon param Code */
				'type_general_noslider'   => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type_noslider' => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => array(
								'none'  => __( 'None', 'uabb' ), // Removed second 'Image type.'.
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							),
							'toggle'  => array(
								'icon'  => array(
									'sections' => array( 'icon_basic_noslider', 'img_icon_style_noslider' ),
								),
								'photo' => array(
									'sections' => array( 'img_basic_noslider', 'img_icon_style_noslider' ),
								),
							),
						),
					),
				),

				/* Icon Basic Setting */
				'icon_basic_noslider'     => array( // Section.
					'title'  => __( 'Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_noslider'       => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'ua-icon ua-icon-mustache',
							'show_remove' => true,
						),
						/* Icon Color */
						'icon_color_noslider' => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
				/* Image Basic Setting */
				'img_basic_noslider'      => array( // Section.
					'title'  => __( 'Image', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'photo_source_noslider' => array(
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'photo_noslider' ),
								),
								'url'     => array(
									'fields' => array( 'photo_url_noslider' ),
								),
							),
						),
						'photo_noslider'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_url_noslider'    => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
					),
				),

				/* Icon param Code Ends */
				'img_icon_style_noslider' => array(
					'title'  => __( 'Image / Icon Style ', 'uabb' ),
					'fields' => array(
						'testimonial_icon_image_size_noslider' => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '75',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'responsive_img_size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Responsive Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'Image size below medium devices. Leave it blank if you want to keep same size', 'uabb' ),
						),
						'testimonial_icon_style_noslider' => array(
							'type'        => 'select',
							'label'       => __( 'Image / Icon Background Style ', 'uabb' ),
							'default'     => 'circle',
							'description' => '',
							'options'     => array(
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'      => array(
								'circle' => array(
									'fields' => array(),
								),
								'square' => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'testimonial_icon_bg_color_noslider', 'testimonial_icon_bg_color_noslider_opc', 'testimonial_icon_bg_border_radius_noslider', 'testimonial_icon_bg_size_noslider' ),
								),
							),
						),

						'testimonial_icon_bg_color_noslider' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'testimonial_icon_bg_color_noslider_opc' => array(
							'type'        => 'unit',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'testimonial_icon_bg_border_radius_noslider' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '0',
							'description' => 'px',
						),
						'testimonial_icon_bg_size_noslider' => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '10',
							'description' => 'px',
						),
					),
				),
			),
		),

		'testimonial_style'          => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'testimonial_styles'           => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'testimonial_image_position' => array(
							'type'    => 'select',
							'label'   => __( 'Overall Position', 'uabb' ),
							'default' => 'top',
							'class'   => 'testimonial_over_all_position',
							'help'    => __( 'This is the overall position of Image/Icon/Text', 'uabb' ),
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
								'top'   => __( 'Center', 'uabb' ),
							),
							'toggle'  => array(
								'left'  => array(
									'fields' => array( 'content_alignment' ),
								),
								'right' => array(
									'fields' => array( 'content_alignment' ),
								),
							),
						),
						'content_alignment'          => array(
							'type'    => 'select',
							'label'   => __( 'Content Vertical Alignment', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
							),
						),
						'icon_position_half_box'     => array(
							'type'    => 'select',
							'label'   => __( 'Image Position', 'uabb' ),
							'class'   => 'testimonial_half_outside_opt',
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Box Edge', 'uabb' ),
								'no'  => __( 'Inside Box', 'uabb' ),
							),
						),
						'test_box_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Box Style', 'uabb' ),
							'default' => 'yes',
							'help'    => __( 'If enabled, the Box would have a default style', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'author_name_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Author Name Position', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'top'    => __( 'Above Description', 'uabb' ),
								'bottom' => __( 'Below Description', 'uabb' ),
							),
						),
						'layout_background'          => array(
							'type'       => 'color',
							'label'      => __( 'Box Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-testimonial',
										'property' => 'background',
									),
									array(
										'selector' => '.testimonial-arrow-down',
										'property' => 'border-top-color',
									),
								),
							),
						),
						'layout_background_opc'      => array(
							'type'        => 'unit',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'mobile_view'                => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline' => __( 'Inline', 'uabb' ),
								'stack'  => __( 'Stack', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),

				'testimonial_image_icon_width' => array(
					'title'  => __( 'Image / Icon Style ', 'uabb' ),
					'fields' => array(

						'testimonial_icon_image_size'   => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '75',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'responsive_img_size_slider'    => array(
							'type'        => 'unit',
							'label'       => __( 'Responsive Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'To resize Image below medium devices use this option. Leave it blank if you want to keep same size', 'uabb' ),
						),
						'testimonial_icon_style'        => array(
							'type'        => 'select',
							'label'       => __( 'Image / Icon Style ', 'uabb' ),
							'default'     => 'square',
							'description' => '',
							'options'     => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'      => array(
								'circle' => array(
									'fields' => array( 'testimonial_icon_bg_color', 'testimonial_icon_bg_color_opc' ),
								),
								'square' => array(
									'fields' => array( 'testimonial_icon_bg_color', 'testimonial_icon_bg_color_opc' ),
								),
								'custom' => array(
									'fields' => array( 'testimonial_icon_bg_color', 'testimonial_icon_bg_color_opc', 'testimonial_icon_bg_border_radius', 'testimonial_icon_bg_size' ),
								),
							),
						),

						'testimonial_icon_bg_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'testimonial_icon_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'testimonial_icon_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '0',
							'description' => 'px',
						),
						'testimonial_icon_bg_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '10',
							'description' => 'px',
						),
					),
				),
			),
		),

		'testimonial_typography'     => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'testimonial_heading'     => array(
					'title'  => __( 'Author', 'uabb' ),
					'fields' => array(
						'testimonial_heading_tag_selection' => array(
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
						'testimonial_heading_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-testimonial-author-name',
							),
						),
						'testimonial_heading_font_size_unit' => array(
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
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'testimonial_heading_line_height_unit' => array(
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
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'testimonial_heading_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'color',
							),
						),
						'testimonial_transform'           => array(
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
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'text-transform',
							),
						),
						'testimonial_letter_spacing'      => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'testimonial_heading_margin_top'  => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'testimonial_heading_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-name',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'rating_typography'       => array(
					'title'  => __( 'Rating', 'uabb' ),
					'fields' => array(
						'rating_font_size_unit' => array(
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
								'selector' => '.uabb-rating .uabb-rating__ico',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'rating_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rating .uabb-rating__ico',
								'property' => 'color',
							),
						),
					),
				),
				'testimonial_designation' => array(
					'title'  => __( 'Designation', 'uabb' ),
					'fields' => array(
						'testimonial_designation_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-testimonial-author-designation',
							),
						),
						'testimonial_designation_font_size_unit' => array(
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
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'testimonial_designation_line_height_unit' => array(
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
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'testimonial_designation_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'color',
							),
						),
						'testimonial_designation_transform' => array(
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
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'text-transform',
							),
						),
						'testimonial_designation_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'testimonial_designation_margin_top' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'testimonial_designation_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-designation',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'testimonial_description' => array(
					'title'  => __( 'Testimonial', 'uabb' ),
					'fields' => array(
						'testimonial_description_opt_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-testimonial-author-description *',
							),
						),
						'testimonial_description_opt_font_size_unit' => array(
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
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'testimonial_description_opt_line_height_unit' => array(
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
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'testimonial_description_opt_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'color',
								'unit'     => 'px',
							),
						),
						'testimonial_description_transform' => array(
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
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'text-transform',
							),
						),
						'testimonial_description_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'testimonial_description_opt_margin_top' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'padding-top',
								'unit'     => 'px',
							),
						),
						'testimonial_description_opt_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Bottom', 'uabb' ),
							'size'        => '8',
							'max-length'  => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-testimonial-author-description *',
								'property' => 'padding-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'uabb_testimonials_form',
	array(
		'title' => __( 'Add Testimonial', 'uabb' ),
		'tabs'  => array(
			'general'   => array( // Tab.
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'testimonial_title_section' => array( // Section.
						'title'  => __( 'Title', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'testimonial_author'      => array(
								'type'        => 'text',
								'label'       => __( 'Author Name', 'uabb' ),
								'default'     => 'John Doe',
								'description' => '',
								'connections' => array( 'string', 'html' ),
							),
							'slider_rating'           => array(
								'label'   => __( 'Testimonial Rating', 'uabb' ),
								'default' => '',
								'type'    => 'select',
								'default' => '1',
								'options' => array(
									'1' => __( '1', 'uabb' ),
									'2' => __( '2', 'uabb' ),
									'3' => __( '3', 'uabb' ),
									'4' => __( '4', 'uabb' ),
									'5' => __( '5', 'uabb' ),
								),
							),
							'testimonial_designation' => array(
								'type'        => 'text',
								'label'       => __( 'Designation', 'uabb' ),
								'default'     => 'Designation',
								'description' => '',
								'connections' => array( 'string', 'html' ),
							),

						),
					),
					'general'                   => array( // Section.
						'title'  => __( 'Testimonial', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'testimonial' => array(
								'type'        => 'editor',
								'label'       => '',
								'default'     => __( 'If you are looking for some awesome, knowledgeable people to work with, these are the guys I highly recommend. Their friendliness and result-driven approach is what I love about them.', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
				),
			),
			'photo_tab' => array( // Tab.
				'title'    => __( 'Image', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'type_general' => array( // Section.
						'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'image_type' => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'icon',
								'options' => array(
									'none'  => __( 'None', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'sections' => array( 'icon_basic', 'icon_style', 'icon_colors' ),
									),
									'photo' => array(
										'sections' => array( 'img_basic', 'img_style' ),
									),
								),
							),
						),
					),

					/* Icon Basic Setting */
					'icon_basic'   => array( // Section.
						'title'  => __( 'Icon', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icon'       => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-mustache',
								'show_remove' => true,
							),
							/* Icon Color */
							'icon_color' => array(
								'type'       => 'color',
								'label'      => __( 'Icon Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
						),
					),
					/* Image Basic Setting */
					'img_basic'    => array( // Section.
						'title'  => __( 'Image', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'photo_source' => array(
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
										'fields' => array( 'photo_url' ),
									),
								),
							),
							'photo'        => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
							'photo_url'    => array(
								'type'        => 'text',
								'label'       => __( 'Photo URL', 'uabb' ),
								'placeholder' => 'http://www.example.com/my-photo.jpg',
							),
						),
					),
				),
			),
		),
	)
);
