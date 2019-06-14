<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABBWooCategoriesModule
 */

FLBuilder::register_module(
	'UABBWooCategoriesModule', array(
		'general'       => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'        => array(
					'title'  => '',
					'fields' => array(
						'layout' => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'grid',
							'options' => array(
								'grid'     => __( 'Grid', 'uabb' ),
								'carousel' => __( 'Carousel', 'uabb' ),
							),
							'toggle'  => array(
								'grid'     => array(
									'sections' => array( 'grid_options' ),
									'fields'   => array( 'rows_gap' ),
								),
								'carousel' => array(
									'sections' => array( 'slider_options' ),
								),
							),
						),
					),
				),
				'grid_options'   => array(
					'title'  => __( 'Grid Options', 'uabb' ),
					'fields' => array(
						'grid_categories'  => array(
							'type'        => 'unit',
							'label'       => __( 'Categories Count', 'uabb' ),
							'placeholder' => '-1',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '8',
						),
						'grid_columns_new' => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of categories to be displayed at a time.', 'uabb' ),
							'responsive' => array(
								'default' => array(
									'default'    => '4',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
						),
					),
				),
				'slider_options' => array(
					'title'  => __( 'Slider Options', 'uabb' ),
					'fields' => array(
						'slider_categories'      => array(
							'type'        => 'unit',
							'label'       => __( 'Categories Count', 'uabb' ),
							'placeholder' => '-1',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '8',
						),
						'slider_columns_new'     => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of categories to be displayed at a time.', 'uabb' ),
							'responsive' => array(
								'default' => array(
									'default'    => '4',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
						),
						'slides_to_scroll'       => array(
							'type'        => 'unit',
							'label'       => __( 'Categories to Scroll', 'uabb' ),
							'help'        => __( 'Choose number of categories you want to scroll at a time.', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
						),
						'autoplay'               => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay Categories Scroll', 'uabb' ),
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
						'animation_speed'        => array(
							'type'        => 'unit',
							'label'       => __( 'Autoplay Speed', 'uabb' ),
							'help'        => __( 'Enter the time interval to scroll post automatically.', 'uabb' ),
							'placeholder' => '1000',
							'size'        => '8',
							'description' => __( 'ms', 'uabb' ),
						),
						'infinite_loop'          => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'help'    => __( 'Enable this to scroll posts in infinite loop.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_dots'            => array(
							'type'    => 'select',
							'label'   => __( 'Enable Dots', 'uabb' ),
							'help'    => __( 'Enable Dots navigation below to your carousel slider.', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_arrow'           => array(
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
									'fields' => array( 'arrow_position', 'arrow_style', 'arrow_color', 'arrow_background_color', 'arrow_color_border', 'arrow_border_size' ),
								),
								'no'  => array(
									'fields' => array( '' ),
								),
							),
						),
						'arrow_position'         => array(
							'type'    => 'select',
							'label'   => __( 'Arrow Position', 'uabb' ),
							'default' => 'outside',
							'options' => array(
								'outside' => __( 'Outside', 'uabb' ),
								'inside'  => __( 'Inside', 'uabb' ),
							),
						),
						'arrow_style'            => array(
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
									'fields' => array( 'arrow_color', 'arrow_background_color' ),
								),
								'circle'        => array(
									'fields' => array( 'arrow_color', 'arrow_background_color' ),
								),
							),
						),
						'arrow_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'arrow_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'arrow_color_border'     => array(
							'type'       => 'color',
							'label'      => __( 'Arrow Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'arrow_border_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'default'     => '1',
							'description' => 'px',
							'size'        => '8',
							'max_length'  => '3',
						),
					),
				),
			),
		),
		'product_query' => array(
			'title' => __( 'Query', 'uabb' ),
			'file'  => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/includes/loop-settings.php',
		),
		'style'         => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'layout_style_sec'  => array( // Section.
					'title'  => __( 'Layout', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'columns_gap' => array(
							'type'        => 'unit',
							'label'       => __( 'Columns Gap', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'rows_gap'    => array(
							'type'        => 'unit',
							'label'       => __( 'Rows Gap', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
				'content_style_sec' => array( // Section.
					'title'  => __( 'Category Content', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'content_alignment'      => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'mobile_align'           => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
						'content_around_spacing' => array(
							'type'        => 'dimension',
							'label'       => __( 'Spacing Around Content', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories li.product .uabb-category__title-wrap',
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
						'content_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
							),
						),
						'content_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woo-categories li.product .uabb-category__title-wrap',
							),
						),
						'content_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woo-categories li.product-category > a:hover .woocommerce-loop-category__title, .uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap .uabb-count',
							),
						),
						'content_hover_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap',
							),
						),
					),
				),
				'desc_style_sec'    => array( // Section.
					'title'  => __( 'Category Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'desc_alignment'      => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'desc_around_spacing' => array(
							'type'        => 'dimension',
							'label'       => __( 'Spacing Around Content', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories .uabb-product-cat-desc',
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
						'desc_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woo-categories .uabb-term-description',
							),
						),
						'desc_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woo-categories .uabb-product-cat-desc',
							),
						),
						'desc_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woo-categories li.product-category > a:hover .uabb-term-description',
							),
						),
						'desc_hover_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woo-categories li.product-category > a:hover .uabb-product-cat-desc',
							),
						),
					),
				),
			),
		),
		'typography'    => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'content_typo' => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'content_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',

							),
						),
						'content_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
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
						'content_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
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
						'content_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
								'property' => 'text-transform',
							),
						),
						'content_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'desc_typo'    => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woo-categories .uabb-term-description',

							),
						),
						'desc_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories .uabb-term-description',
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
						'desc_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories .uabb-term-description',
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
						'desc_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'       => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories .uabb-term-description',
								'property' => 'text-transform',
							),
						),
						'desc_letter_spacing' => array(
							'type'        => 'text',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-categories .uabb-term-description',
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
