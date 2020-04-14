<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABBWooCategoriesModule
 */

FLBuilder::register_module(
	'UABBWooCategoriesModule',
	array(
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
							'type'    => 'unit',
							'label'   => __( 'Categories Count', 'uabb' ),
							'default' => '8',
							'units'   => array( 'Categories' ),
							'slider'  => true,
						),
						'grid_columns_new' => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of categories to be displayed at a time.', 'uabb' ),
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
						'slider_categories'      => array(
							'type'    => 'unit',
							'label'   => __( 'Categories Count', 'uabb' ),
							'default' => '8',
							'units'   => array( 'Categories' ),
							'slider'  => true,
						),
						'slider_columns_new'     => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'help'       => __( 'Choose number of categories to be displayed at a time.', 'uabb' ),
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
							'type'        => 'unit',
							'label'       => __( 'Categories to Scroll', 'uabb' ),
							'help'        => __( 'Choose number of categories you want to scroll at a time.', 'uabb' ),
							'placeholder' => '1',
							'units'       => array( 'Categories' ),
							'slider'      => true,
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
							'units'       => array( 'MS' ),
							'slider'      => true,
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
							'type'       => 'unit',
							'label'      => __( 'Columns Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
						),
						'rows_gap'    => array(
							'type'       => 'unit',
							'label'      => __( 'Rows Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
						),
					),
				),
				'content_style_sec' => array( // Section.
					'title'  => __( 'Category Content', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'content_alignment'      => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
						),
						'mobile_align'           => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
						'content_around_spacing' => array(
							'type'       => 'dimension',
							'label'      => __( 'Spacing Around Content', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-categories li.product .uabb-category__title-wrap',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'content_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
								'important' => true,
							),
						),
						'content_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-woo-categories li.product .uabb-category__title-wrap',
								'important' => true,
							),
						),
						'content_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-woo-categories li.product-category > a:hover .woocommerce-loop-category__title, .uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap .uabb-count',
								'important' => true,
							),
						),
						'content_hover_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap',
								'important' => true,
							),
						),
					),
				),
				'desc_style_sec'    => array( // Section.
					'title'  => __( 'Category Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'desc_alignment'      => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
						),
						'desc_around_spacing' => array(
							'type'        => 'dimension',
							'label'       => __( 'Spacing Around Content', 'uabb' ),
							'description' => 'px',
							'slider'      => true,
							'responsive'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-categories .uabb-product-cat-desc',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'desc_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-woo-categories .uabb-term-description',
								'important' => true,
							),
						),
						'desc_bg_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-woo-categories .uabb-product-cat-desc',
								'important' => true,
							),
						),
						'desc_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-woo-categories li.product-category > a:hover .uabb-term-description',
								'important' => true,
							),
						),
						'desc_hover_bg_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'background',
								'selector'  => '.uabb-woo-categories li.product-category > a:hover .uabb-product-cat-desc',
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
				'content_typo' => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'category_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-categories li.product .woocommerce-loop-category__title, .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count',
								'important' => true,
							),
						),
					),
				),
				'desc_typo'    => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-categories .uabb-term-description',
								'important' => true,
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
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/woo-categories-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-categories-module" target="_blank" rel="noopener"> Getting started article </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-set-description-for-category-in-woocommerce/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-categories-module" target="_blank" rel="noopener"> How to Set Description for Category in WooCommerce? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
