<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
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
							'type'        => 'unit',
							'label'       => __( 'Quantity', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '5',
							'size'        => '6',
							'default'     => '1',
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
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart .button',
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
						'border_radius'     => array(
							'type'        => 'unit',
							'label'       => __( 'Round Corners', 'uabb' ),
							'size'        => '4',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart a',
								'property' => 'border-radius',
								'unit'     => 'px',
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
							'type'        => 'unit',
							'label'       => __( 'Icon Spacing', 'uabb' ),
							'placeholder' => '8',
							'default'     => '',
							'description' => 'px',
							'size'        => '8',
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
							'default' => 'flat',
							'class'   => 'creative_button_styles',
							'options' => array(
								''            => __( 'Flat', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
							),
							'toggle'  => array(
								'transparent' => array(
									'fields' => array( 'border_size', 'transparent_button_options' ),
								),
							),
						),
						'border_size'                => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'default'     => '2',
							'placeholder' => '2',
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
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart .button',
								'property' => 'color',
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
								'type'  => 'css',
								'rules' => array(
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
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart .added_to_cart',
								'property' => 'color',
							),
						),

						'view_cart_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'View Cart Hover Text', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart .added_to_cart:hover',
								'property' => 'color',
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
						'font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-woo-add-to-cart .button',
							),
						),
						'font_size'      => array(
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
								'selector' => '.uabb-woo-add-to-cart .button',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'line_height'    => array(
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
								'selector' => '.uabb-woo-add-to-cart .button',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'transform'      => array(
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
								'selector' => '.uabb-woo-add-to-cart .button',
								'property' => 'text-transform',
							),
						),
						'letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-add-to-cart .button',
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
