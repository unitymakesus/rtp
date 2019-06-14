<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Woo Products Module
 */

FLBuilder::register_module(
	'UABBWooProductsModule', array(
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
									'sections' => array( 'grid_options', 'pagination_style_sec' ),
									'fields'   => array( 'rows_gap' ),
								),
								'carousel' => array(
									'sections' => array( 'slider_options' ),
								),
							),
						),
						'skin'   => array(
							'type'    => 'select',
							'label'   => __( 'Skin', 'uabb' ),
							'default' => 'classic',
							'options' => array(
								'classic' => __( 'Classic', 'uabb' ),
								'modern'  => __( 'Modern', 'uabb' ),
							),
						),
					),
				),
				'grid_options'   => array(
					'title'  => __( 'Grid Options', 'uabb' ),
					'fields' => array(
						'grid_products'    => array(
							'type'        => 'unit',
							'label'       => __( 'Products Per Page', 'uabb' ),
							'placeholder' => '-1',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '8',
						),
						'grid_columns_new' => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of products to be displayed at a time.', 'uabb' ),
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
						'slider_products'        => array(
							'type'        => 'unit',
							'label'       => __( 'Total Products', 'uabb' ),
							'placeholder' => '-1',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '8',
						),
						'slider_columns_new'     => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of products to be displayed at a time.', 'uabb' ),
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
							'label'       => __( 'Posts to Scroll', 'uabb' ),
							'help'        => __( 'Choose number of posts you want to scroll at a time.', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
						),
						'autoplay'               => array(
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
						'animation_speed'        => array(
							'type'        => 'text',
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
			'file'  => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/includes/loop-settings.php',
		),
		'layout'        => array(
			'title'    => __( 'Layout', 'uabb' ),
			'sections' => array(
				'layout_style_sec' => array( // Section.
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
				'image_style_sec'  => array( // Section.
					'title'  => __( 'Image', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_hover_style' => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Style', 'uabb' ),
							'default' => '',
							'options' => array(
								''     => 'None',
								'swap' => 'Swap Images',
								'zoom' => 'Zoom Image',
							),
						),
					),
				),
				'content'          => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'show_category'    => array(
							'type'    => 'select',
							'label'   => __( 'Category', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'cat_typo' ),
								),
							),
						),
						'show_title'       => array(
							'type'    => 'select',
							'label'   => __( 'Title', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'title_typo' ),
								),
							),
						),
						'show_ratings'     => array(
							'type'    => 'select',
							'label'   => __( 'Ratings', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'rating_typo' ),
								),
							),
						),
						'show_price'       => array(
							'type'    => 'select',
							'label'   => __( 'Price', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'price_typo' ),
								),
							),
						),
						'show_short_desc'  => array(
							'type'    => 'select',
							'label'   => __( 'Short Description', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'desc_typo' ),
								),
							),
						),
						'show_add_to_cart' => array(
							'type'    => 'select',
							'label'   => __( 'Add to Cart', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'add_cart_typo' ),
								),
							),
						),
					),
				),
				'quick_view'       => array(
					'title'  => __( 'Quick View', 'uabb' ),
					'fields' => array(
						'quick_view' => array(
							'type'    => 'select',
							'label'   => __( 'Quick View', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'hide' => __( 'Hide', 'uabb' ),
								'show' => __( 'Show', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'         => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'content_style_sec'        => array( // Section.
					'title'  => __( 'Content', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'content_alignment'      => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
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
								'selector' => '.uabb-woo-products-summary-wrap',
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
					),
				),
				'sale_flash_style_sec'     => array( // Section.
					'title'  => __( 'Sale Flash', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'sale_flash'          => array(
							'type'    => 'select',
							'label'   => __( 'Flash', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'none'    => __( 'None', 'uabb' ),
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'sections' => array( 'sale_flash_typo' ),
									'fields'   => array( 'sale_flash_style', 'sale_flash_size', 'sale_flash_padding', 'sale_flash_margin', 'sale_flash_color', 'sale_flash_bg_color' ),
								),
								'custom'  => array(
									'sections' => array( 'sale_flash_typo' ),
									'fields'   => array( 'sale_flash_content', 'sale_flash_style', 'sale_flash_size', 'sale_flash_padding', 'sale_flash_margin', 'sale_flash_color', 'sale_flash_bg_color' ),
								),
							),
						),
						'sale_flash_content'  => array(
							'type'        => 'text',
							'label'       => __( 'Flash Content', 'uabb' ),
							'placeholder' => '-[value]%',
							'default'     => '-[value]%',
							'connections' => array( 'string', 'html' ),
						),
						'sale_flash_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Flash Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
							),
						),
						'sale_flash_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Flash Size', 'uabb' ),
							'placeholder' => '3',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '3',
						),
						'sale_flash_padding'  => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'sale_flash_margin'   => array(
							'type'        => 'dimension',
							'label'       => __( 'Margin', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
						'sale_flash_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
							),
						),
						'sale_flash_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
							),
						),
					),
				),
				'featured_flash_style_sec' => array( // Section.
					'title'  => __( 'Featured Flash', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'featured_flash'          => array(
							'type'    => 'select',
							'label'   => __( 'Flash', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'    => __( 'None', 'uabb' ),
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'sections' => array( 'featured_flash_typo' ),
									'fields'   => array( 'featured_flash_style', 'featured_flash_size', 'featured_flash_padding', 'featured_flash_margin', 'featured_flash_color', 'featured_flash_bg_color' ),
								),
								'custom'  => array(
									'sections' => array( 'featured_flash_typo' ),
									'fields'   => array( 'featured_flash_content', 'featured_flash_style', 'featured_flash_size', 'featured_flash_padding', 'featured_flash_margin', 'featured_flash_color', 'featured_flash_bg_color' ),
								),
							),
						),
						'featured_flash_content'  => array(
							'type'        => 'text',
							'label'       => __( 'Flash Content', 'uabb' ),
							'placeholder' => __( 'New', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'featured_flash_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Flash Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
							),
						),
						'featured_flash_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Flash Size', 'uabb' ),
							'placeholder' => '3',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '3',
						),
						'featured_flash_padding'  => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-featured',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'featured_flash_margin'   => array(
							'type'        => 'dimension',
							'label'       => __( 'Margin', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-featured',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
						'featured_flash_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-featured',
							),
						),
						'featured_flash_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woocommerce .uabb-featured',
							),
						),
					),
				),
				'add_cart_style_sec'       => array(
					'title'  => __( 'Add to Cart', 'uabb' ),
					'fields' => array(
						'add_cart_padding_top_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'add_cart_padding_left_right' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'add_cart_margin_bottom'      => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
								'unit'     => 'px',
							),
						),
					),
				),
				'pagination_style_sec'     => array( // Section.
					'title'  => __( 'Pagination', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'pagination_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => '',
							'options' => array(
								''              => __( 'None', 'uabb' ),
								'numbers'       => __( 'Numbers', 'uabb' ),
								'numbers_arrow' => __( 'Numbers + Pre/Next Arrow', 'uabb' ),
							),
							'toggle'  => array(
								'numbers'       => array(
									'fields' => array( 'pg_alignment', 'pg_color', 'pg_hover_color', 'pg_bg_color', 'pg_bg_hover_color', 'pg_border_color', 'pg_border_hover_color' ),
								),
								'numbers_arrow' => array(
									'fields' => array( 'pg_alignment', 'pg_color', 'pg_hover_color', 'pg_bg_color', 'pg_bg_hover_color', 'pg_border_color', 'pg_border_hover_color' ),
								),
							),
						),
						'pg_alignment'          => array(
							'type'    => 'select',
							'label'   => __( 'Pagination Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination',
								'property' => 'text-align',
							),
						),
						'pg_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property' => 'color',
							),
						),
						'pg_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Active / Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property' => 'color',
							),
						),
						'pg_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property' => 'background',
							),
						),
						'pg_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Active / Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property' => 'background',
							),
						),
						'pg_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property' => 'border-color',
							),
						),
						'pg_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Active / Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property' => 'border-color',
							),
						),
					),
				),
				'spacing_style_sec'        => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'cat_margin_bottom'    => array(
							'type'        => 'unit',
							'label'       => __( 'Category Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
								'unit'     => 'px',
							),
						),
						'title_margin_bottom'  => array(
							'type'        => 'unit',
							'label'       => __( 'Title Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
								'unit'     => 'px',
							),
						),
						'rating_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Rating Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce .star-rating',
								'unit'     => 'px',
							),
						),
						'price_margin_bottom'  => array(
							'type'        => 'unit',
							'label'       => __( 'Price Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce li.product .price',
								'unit'     => 'px',
							),
						),
						'desc_margin_bottom'   => array(
							'type'        => 'unit',
							'label'       => __( 'Desc Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'typography'    => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'cat_typo'            => array(
					'title'  => __( 'Category', 'uabb' ),
					'fields' => array(
						'cat_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',

							),
						),
						'cat_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
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
						'cat_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
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
						'cat_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
							),
						),
						'cat_transform'      => array(
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
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
								'property' => 'text-transform',
							),
						),
						'cat_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-product-category',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'title_typo'          => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woocommerce .uabb-loop-product__link, .uabb-woocommerce .woocommerce-loop-product__title',

							),
						),
						'title_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
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
						'title_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
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
						'title_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
							),
						),
						'title_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-loop-product__link:hover .woocommerce-loop-product__title',
							),
						),
						'title_transform'      => array(
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
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
								'property' => 'text-transform',
							),
						),
						'title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .woocommerce-loop-product__title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'rating_typo'         => array(
					'title'  => __( 'Rating', 'uabb' ),
					'fields' => array(
						'rating_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .star-rating, .uabb-woocommerce .star-rating::before',
							),
						),
					),
				),
				'price_typo'          => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'price_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woocommerce li.product .price',
							),
						),
						'price_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce li.product .price',
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
						'price_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce li.product .price',
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
						'price_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce li.product .price',
							),
						),
						'price_transform'      => array(
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
								'selector' => '.uabb-woocommerce li.product .price',
								'property' => 'text-transform',
							),
						),
						'price_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce li.product .price',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'desc_typo'           => array(
					'title'  => __( 'Short Description', 'uabb' ),
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
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
							),
						),
						'desc_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
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
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
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
						'desc_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
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
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
								'property' => 'text-transform',
							),
						),
						'desc_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-products-description',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'add_cart_typo'       => array(
					'title'  => __( 'Add to Cart', 'uabb' ),
					'fields' => array(
						'add_cart_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',

							),
						),
						'add_cart_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
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
						'add_cart_line_height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
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
						'add_cart_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
							),
						),
						'add_cart_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button:hover',
							),
						),
						'add_cart_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
							),
						),
						'add_cart_bg_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button:hover',
							),
						),
						'add_cart_transform'      => array(
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
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
								'property' => 'text-transform',
							),
						),
						'add_cart_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'sale_flash_typo'     => array(
					'title'  => __( 'Sale Flash', 'uabb' ),
					'fields' => array(
						'sale_flash_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
							),
						),
						'sale_flash_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
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
						'sale_flash_transform'      => array(
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
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
								'property' => 'text-transform',
							),
						),
						'sale_flash_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-sale-flash-wrap .uabb-onsale',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'featured_flash_typo' => array(
					'title'  => __( 'Featured Flash', 'uabb' ),
					'fields' => array(
						'featured_flash_font'           => array(
							'type'    => 'font',
							'default' => array(
								'family' => 'Default',
								'weight' => 300,
							),
							'label'   => __( 'Font', 'uabb' ),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woocommerce .uabb-featured',
							),
						),
						'featured_flash_font_size'      => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-featured',
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
						'featured_flash_transform'      => array(
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
								'selector' => '.uabb-woocommerce .uabb-featured',
								'property' => 'text-transform',
							),
						),
						'featured_flash_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woocommerce .uabb-featured',
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
