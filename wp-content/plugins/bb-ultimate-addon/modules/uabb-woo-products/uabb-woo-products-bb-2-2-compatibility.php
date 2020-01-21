<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
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
							'type'    => 'unit',
							'label'   => __( 'Products Per Page', 'uabb' ),
							'default' => '8',
							'units'   => array( 'Products' ),
							'slider'  => true,
						),
						'grid_columns_new' => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of products to be displayed at a time.', 'uabb' ),
							'units'      => array( 'Columns' ),
							'slider'     => true,
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
							'type'    => 'unit',
							'label'   => __( 'Total Products', 'uabb' ),
							'default' => '8',
							'units'   => array( 'Products' ),
							'slider'  => true,
						),
						'slider_columns_new'     => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of products to be displayed at a time.', 'uabb' ),
							'units'      => array( 'Columns' ),
							'slider'     => true,
							'responsive' => array(
								'default' => array(
									'default'    => '4',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
						),
						'slides_to_scroll'       => array(
							'type'   => 'unit',
							'label'  => __( 'Products to Scroll', 'uabb' ),
							'help'   => __( 'Choose number of products you want to scroll at a time.', 'uabb' ),
							'units'  => array( 'Products' ),
							'slider' => true,
						),
						'autoplay'               => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay Products Scroll', 'uabb' ),
							'help'    => __( 'Enables auto play of products.', 'uabb' ),
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
							'units'       => array( 'MS' ),
							'slider'      => true,
						),
						'infinite_loop'          => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'help'    => __( 'Enable this to scroll products in infinite loop.', 'uabb' ),
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
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Arrow Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'arrow_background_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Arrow Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'arrow_color_border'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Arrow Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'arrow_border_size'      => array(
							'type'    => 'unit',
							'label'   => __( 'Border Size', 'uabb' ),
							'default' => '1',
							'units'   => array( 'px' ),
							'slider'  => array(
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
							'type'       => 'unit',
							'label'      => __( 'Columns Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => true,
						),
						'rows_gap'    => array(
							'type'       => 'unit',
							'label'      => __( 'Rows Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => true,
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
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
						),
						'mobile_align'           => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
						'content_around_spacing' => array(
							'type'    => 'dimension',
							'label'   => __( 'Spacing Around Content', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-products-summary-wrap',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
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
							'type'    => 'unit',
							'label'   => __( 'Flash Size', 'uabb' ),
							'default' => '3',
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'sale_flash_padding'  => array(
							'type'    => 'dimension',
							'label'   => __( 'Padding', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-sale-flash-wrap .uabb-onsale',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'sale_flash_margin'   => array(
							'type'    => 'dimension',
							'label'   => __( 'Margin', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-sale-flash-wrap .uabb-onsale',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'sale_flash_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-sale-flash-wrap .uabb-onsale',
								'important' => true,
							),
						),
						'sale_flash_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-sale-flash-wrap .uabb-onsale',
								'important' => true,
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
							'type'    => 'unit',
							'label'   => __( 'Flash Size', 'uabb' ),
							'default' => '3',
							'units'   => array( 'em' ),
							'slider'  => true,
						),
						'featured_flash_padding'  => array(
							'type'    => 'dimension',
							'label'   => __( 'Padding', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-featured',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'featured_flash_margin'   => array(
							'type'    => 'dimension',
							'label'   => __( 'Margin', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-featured',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'featured_flash_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-woocommerce .uabb-featured',
								'important' => true,
							),
						),
						'featured_flash_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-woocommerce .uabb-featured',
								'important' => true,
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
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'add_cart_padding_left_right' => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'add_cart_margin_bottom'      => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
								'unit'      => 'px',
								'important' => true,
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
							'type'    => 'align',
							'label'   => __( 'Pagination Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'pg_color'              => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property'  => 'color',
								'important' => true,
							),
						),
						'pg_hover_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Active / Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property'  => 'color',
								'important' => true,
							),
						),
						'pg_bg_color'           => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property'  => 'background',
								'important' => true,
							),
						),
						'pg_bg_hover_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Active / Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property'  => 'background',
								'important' => true,

							),
						),
						'pg_border_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li > .page-numbers',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'pg_border_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Active / Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'nav.uabb-woocommerce-pagination ul li .page-numbers:focus, nav.uabb-woocommerce-pagination ul li .page-numbers:hover, nav.uabb-woocommerce-pagination ul li span.current',
								'property'  => 'border-color',
								'important' => true,
							),
						),
					),
				),
				'spacing_style_sec'        => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'cat_margin_bottom'    => array(
							'type'    => 'unit',
							'label'   => __( 'Category Margin Bottom', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce .uabb-woo-product-category',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'title_margin_bottom'  => array(
							'type'    => 'unit',
							'label'   => __( 'Title Margin Bottom', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce .woocommerce-loop-product__title',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'rating_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Rating Margin Bottom', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce .star-rating',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'price_margin_bottom'  => array(
							'type'        => 'unit',
							'label'       => __( 'Price Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce li.product .price',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'desc_margin_bottom'   => array(
							'type'    => 'unit',
							'label'   => __( 'Desc Margin Bottom', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-woocommerce .uabb-woo-products-description',
								'unit'      => 'px',
								'important' => true,
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
						'woo_cat_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-woo-product-category',
								'important' => true,
							),
						),
						'cat_color'         => array(
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
					),
				),
				'title_typo'          => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'woo_title_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-loop-product__link, .uabb-woocommerce .woocommerce-loop-product__title',
								'important' => true,
							),
						),
						'title_color'         => array(
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
						'title_hover_color'   => array(
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
					),
				),
				'price_typo'          => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'woo_price_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce li.product .price',
								'important' => true,
							),
						),
						'price_color'         => array(
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
					),
				),
				'desc_typo'           => array(
					'title'  => __( 'Short Description', 'uabb' ),
					'fields' => array(
						'woo_desc_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-woo-products-description',
								'important' => true,
							),
						),
						'desc_color'         => array(
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
					),
				),
				'add_cart_typo'       => array(
					'title'  => __( 'Add to Cart', 'uabb' ),
					'fields' => array(
						'woo_cart_font_typo'      => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-woo-products-summary-wrap .button',
								'important' => true,
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
					),
				),
				'sale_flash_typo'     => array(
					'title'  => __( 'Sale Flash', 'uabb' ),
					'fields' => array(
						'woo_sale_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-sale-flash-wrap .uabb-onsale',
								'important' => true,
							),
						),
					),
				),
				'featured_flash_typo' => array(
					'title'  => __( 'Featured Flash', 'uabb' ),
					'fields' => array(
						'woo_flash_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woocommerce .uabb-featured',
								'important' => true,
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
			),
		),
		'uabb_docs'     => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/woo-products-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> Getting started article </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-set-grid-and-carousel-layout-for-woocommerce-products/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> How to set Grid and Carousel layout for WooCommerce products? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-display-exact-woocommerce-product-with-query-builder/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> How to display exact WooCommerce product with Query Builder? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-set-featured-products-in-woocommerce/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> How to Set Featured Products in WooCommerce? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-enable-quick-view-for-woocommerce-products/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> How to enable Quick View for WooCommerce Products? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-exclude-woocommerce-products-with-woo-products-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> How to Exclude WooCommerce Products with Woo-Products Module? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/filters-actions-for-woocommerce-products/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-products-module" target="_blank" rel="noopener"> Filters/Actions for WooCommerce Products </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
