<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABBWooAddToCartModule
 */

FLBuilder::register_module(
	'UABBWooAddToCartModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						// Posts.
						'product_id'    => array(
							'type'   => 'suggest',
							'action' => 'fl_as_posts',
							'data'   => 'product',
							'label'  => __( 'Product', 'uabb' ),
							'help'   => __( 'Enter the Product.', 'uabb' ),
							'limit'  => 1,
						),
						'quantity'      => array(
							'type'    => 'unit',
							'label'   => __( 'Quantity', 'uabb' ),
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
						'auto_redirect' => array(
							'type'    => 'select',
							'label'   => __( 'Auto Redirect to Cart Page', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Select Yes to redirect to cart page after the product gets added to cart.', 'uabb' ),

						),
					),
				),
				'button'  => array(
					'title'  => __( 'Button', 'uabb' ),
					'fields' => array(
						'btn_text'          => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Add to Cart', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-atc-btn-text',
							),
							'connections' => array( 'string', 'html' ),
						),
						'btn_align'         => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center'  => __( 'Center', 'uabb' ),
								'left'    => __( 'Left', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'justify' => __( 'Justify', 'uabb' ),
							),
						),
						'mobile_align'      => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center'  => __( 'Center', 'uabb' ),
								'left'    => __( 'Left', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'justify' => __( 'Justify', 'uabb' ),
							),
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
						),
						'btn_padding'       => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .button',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'border_radius'     => array(
							'type'    => 'unit',
							'label'   => __( 'Round Corners', 'uabb' ),
							'size'    => '4',
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart a',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
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
						'btn_icon_spacing'  => array(
							'type'    => 'unit',
							'label'   => __( 'Icon Spacing', 'uabb' ),
							'default' => '',
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
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'style'      => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'style'                      => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'class'   => 'creative_button_styles',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								''            => __( 'Flat', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'transparent' => array(
									'fields' => array( 'border_size', 'transparent_button_options' ),
								),
								'transparent' => array(
									'fields' => array( 'button_border', 'border_hover_color' ),
								),
							),
						),
						'button_border'              => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .button',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'border_size'                => array(
							'type'    => 'unit',
							'label'   => __( 'Border Size', 'uabb' ),
							'default' => '2',
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'transparent_button_options' => array(
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
					),
				),
				'btn_colors' => array(
					'title'  => __( 'Button Colors', 'uabb' ),
					'fields' => array(
						'text_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .button',
								'property'  => 'color',
								'important' => true,
							),
						),
						'text_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Text Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'bg_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'important' => true,
								'rules'     => array(
									array(
										'selector' => '.uabb-woo-add-to-cart .uabb-adc-normal-btn',
										'property' => 'background',
									),
									array(
										'selector' => '.uabb-woo-add-to-cart .uabb-creative-transparent-btn',
										'property' => 'border-color',
									),
								),
							),
						),
						'bg_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'view_cart_color'       => array(
							'type'       => 'color',
							'label'      => __( 'View Cart Text', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .added_to_cart',
								'property'  => 'color',
								'important' => true,
							),
						),

						'view_cart_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'View Cart Hover Text', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .added_to_cart:hover',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'btn_typography' => array(
					'title'  => __( 'Button', 'uabb' ),
					'fields' => array(
						'button_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-woo-add-to-cart .button',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'  => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-add-woocommerce-add-to-cart-button-on-the-page/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-add-to-cart-module" target="_blank" rel="noopener"> How to add WooCommerce Add To Cart button on the page? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
