<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Price List Module
 */

FLBuilder::register_module(
	'UABBPriceList', array(
		'price_list_item'           => array(
			'title'    => __( 'List Item', 'uabb' ),
			'sections' => array(
				'price_list_general' => array(
					'title'  => __( 'List Section', 'uabb' ),
					'fields' => array(
						'add_price_list_item' => array(
							'type'         => 'form',
							'label'        => __( 'List Item', 'uabb' ),
							'form'         => 'price_list_item_form',
							'preview_text' => 'price_list_item_title',
							'multiple'     => true,
							'default'      => array(
								array(
									'price_list_item_title' => 'First Item',
									'price_list_item_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor.',
									'default_price' => '$10',
								),
								array(
									'price_list_item_title' => 'Second Item',
									'price_list_item_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor.',
									'default_price' => '$20',
								),
								array(
									'price_list_item_title' => 'Third Item',
									'price_list_item_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu erat, accumsan id imperdiet et, porttitor.',
									'default_price' => '$30',
								),
							),
						),
					),
				),
			),
		),
		'price_list_layout_section' => array(
			'title'    => __( 'Layout', 'uabb' ),
			'sections' => array(
				'price_list_general'   => array(
					'title'  => __( 'Layout Settings', 'uabb' ),
					'fields' => array(
						'image_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Image Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
								'top'   => __( 'Top', 'uabb' ),
							),
							'toggle'  => array(
								'left'  => array(
									'fields'   => array( 'price_position', 'vertical_alignment' ),
									'sections' => array( 'price_list_connector' ),
								),
								'right' => array(
									'fields'   => array( 'price_position', 'vertical_alignment' ),
									'sections' => array( 'price_list_connector' ),
								),
							),
						),
						'price_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Price Position', 'uabb' ),
							'default' => 'right',
							'options' => array(
								'right' => __( 'Right of Heading', 'uabb' ),
								'below' => __( 'Below Heading & Description', 'uabb' ),
							),
							'toggle'  => array(
								'right' => array(
									'sections' => array( 'price_list_connector' ),
								),
							),
						),
						'overall_alignment'    => array(
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'vertical_alignment'   => array(
							'type'    => 'select',
							'label'   => __( 'Image Vertical Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'center' => __( 'Middle', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'pricelist_min_height' => array(
							'type'    => 'select',
							'label'   => __( 'Minimum Height', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'pricelist_height' ),
								),
							),
						),
						'pricelist_height'     => array(
							'type'        => 'unit',
							'label'       => __( 'Enter Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'placeholder' => '75',
						),
						'enable_stack'         => array(
							'type'    => 'select',
							'label'   => __( 'Stack on', 'uabb' ),
							'default' => 'mobile',
							'options' => array(
								'mobile' => __( 'Mobile', 'uabb' ),
								'tablet' => __( 'Tablet', 'uabb' ),
								'none'   => __( 'None', 'uabb' ),
							),
						),
					),
				),
				'price_list_connector' => array( // Section.
					'title'  => __( 'Title Price Connector', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'price_list_connector_style'       => array(
							'type'        => 'select',
							'label'       => __( 'Connector Line Style', 'uabb' ),
							'description' => '',
							'default'     => 'solid',
							'options'     => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item .uabb-price-list-separator',
								'property' => 'border-bottom-style',
							),
						),
						'price_list_connector_width'       => array(
							'type'        => 'unit',
							'label'       => __( 'Connector Thickness', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'default'     => '1',
							'slider'      => 'true',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item .uabb-price-list-separator',
								'property' => 'border-bottom-width',
							),
						),
						'price_list_connector_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Connector Line Color', 'uabb' ),
							'default'    => '000000',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item .uabb-price-list-separator',
								'property' => 'border-bottom-color',
							),
						),
						'price_list_connector_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Connector Line Hover Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'price_list_style_section'  => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'list_item_basic_style' => array( // Section.
					'title'  => __( 'General', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'space_between_list_items'         => array(
							'type'        => 'unit',
							'label'       => __( 'Space Between Price Items', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'default'     => '20',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item:not(:last-child)',
								'property' => 'margin-bottom',
							),
						),
						'space_between_img_content'        => array(
							'type'        => 'unit',
							'label'       => __( 'Space Between Image & Content', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'default'     => '0',
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-price-list-left .uabb-price-list-image',
										'property' => 'margin-right',
									),
									array(
										'selector' => '.uabb-price-list-right .uabb-price-list-image',
										'property' => 'margin-left',
									),
									array(
										'selector' => '.uabb-price-list-top .uabb-price-list-image',
										'property' => 'margin-bottom',
									),
								),
							),
						),
						'list_item_padding_dimension'      => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item',
								'property'  => 'padding',
								'important' => true,
							),
						),
						'list_item_background_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item',
								'property' => 'Background',
							),
						),
						'list_item_background_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'price_list_border_type'           => array(
							'type'        => 'select',
							'label'       => __( 'Border Style', 'uabb' ),
							'description' => '',
							'default'     => 'none',
							'options'     => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
							'toggle'      => array(
								'solid'  => array(
									'fields' => array( 'price_list_border_width', 'price_list_border_color', 'price_list_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'price_list_border_width', 'price_list_border_color', 'price_list_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'price_list_border_width', 'price_list_border_color', 'price_list_border_hover_color' ),
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item',
								'property' => 'border-style',
							),
						),
						'price_list_border_width'          => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item',
								'property' => 'border-width',
							),
						),
						'price_list_border_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-item',
								'property' => 'border-color',
							),
						),
						'price_list_border_hover_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'price_list_hover_animation'       => array(
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
				'image_styles'          => array(
					'title'  => __( 'Image Section', 'uabb' ),
					'fields' => array(
						'image_gloabl_size'   => array(
							'type'        => 'unit',
							'label'       => __( 'Image Size', 'uabb' ),
							'default'     => '50',
							'size'        => '8',
							'description' => 'px',
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-price-list-image',
										'property' => 'width',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-price-list-image',
										'property' => 'min-width',
										'unit'     => 'px',
									),
								),
							),
						),
						'image_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '0',
							'size'        => '8',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-image img',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'price_list_typo'           => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title_typography'       => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'heading_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-price-list-title',
							),
						),
						'heading_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-title',
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
						'heading_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-title',
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
						'heading_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Title Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-title',
								'property' => 'color',
							),
						),
						'heading_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Title Hover Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'heading_transform'        => array(
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
								'selector' => '.uabb-price-list-title',
								'property' => 'text-transform',
							),
						),
						'heading_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'heading_margin'           => array(
							'type'       => 'dimension',
							'label'      => __( 'Title Margin', 'uabb' ),
							'default'    => '10',
							'size'       => '8',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'max_length' => '3',
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-title',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-price-list-description',
							),
						),
						'description_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-description',
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
						'description_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-description',
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
						'description_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Description Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-description',
								'property' => 'color',
							),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'description_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Description Hover Color', 'uabb' ),
							'preview'    => array(
								'type' => 'none',
							),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'description_transform'        => array(
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
								'selector' => '.uabb-price-list-description',
								'property' => 'text-transform',
							),
						),
						'description_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-description',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'description_margin'           => array(
							'type'        => 'dimension',
							'label'       => __( 'Description Margin', 'uabb' ),
							'default'     => '10',
							'size'        => '8',
							'description' => 'px',
							'max_length'  => '3',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-description',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
					),
				),
				'price_typography'       => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'price_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
							),
						),
						'price_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
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
						'price_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
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
						'price_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Description Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
								'property' => 'color',
							),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'price_hover_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Description Hover Color', 'uabb' ),
							'preview'    => array(
								'type' => 'none',
							),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'price_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'price_margin'           => array(
							'type'        => 'dimension',
							'label'       => __( 'Price Margin ', 'uabb' ),
							'size'        => '8',
							'default'     => '10',
							'description' => 'px',
							'max_length'  => '3',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-price-list-price,.uabb-price-list-discount-price',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'price_list_item_form', array(
		'title' => __( 'Add List Item', 'uabb' ),
		'tabs'  => array(
			'price_list_item_general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'title'         => array(
						'title'  => __( 'General Settings', 'uabb' ),
						'fields' => array(
							'price_list_item_title'        => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'description' => '',
								'default'     => __( 'Product 1', 'uabb' ),
								'help'        => __( 'Provide a title for this Price list item.', 'uabb' ),
								'placeholder' => __( 'Title', 'uabb' ),
								'class'       => 'uabb-price-list-item-title',
								'connections' => array( 'string', 'html' ),
							),
							'price_list_item_url'          => array(
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'connections' => array( 'url' ),
							),
							'price_list_item_link'         => array(
								'type'    => 'select',
								'label'   => __( 'Apply Link To', 'uabb' ),
								'default' => 'list-title',
								'options' => array(
									'list-title' => __( 'List Title', 'uabb' ),
									'icon'       => __( 'Image', 'uabb' ),
									'complete'   => __( 'Complete Box', 'uabb' ),
								),
							),
							'price_list_item_url_target'   => array(
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'default' => '_self',
								'options' => array(
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								),
							),
							'price_list_item_url_nofollow' => array(
								'type'        => 'select',
								'label'       => __( 'Link nofollow', 'uabb' ),
								'description' => '',
								'default'     => '0',
								'help'        => __( 'Enable this to make this link nofollow.', 'uabb' ),
								'options'     => array(
									'1' => __( 'Yes', 'uabb' ),
									'0' => __( 'No', 'uabb' ),
								),
							),
							'price_list_item_description'  => array(
								'type'          => 'editor',
								'label'         => '',
								'media_buttons' => false,
								'rows'          => 13,
								'connections'   => array( 'string', 'html' ),
							),
						),
					),
					'price_setting' => array(
						'title'  => __( 'Price Options', 'uabb' ),
						'fields' => array(
							'price'          => array(
								'type'        => 'text',
								'label'       => __( 'Price', 'uabb' ),
								'size'        => '5',
								'default'     => '$20',
								'connections' => array( 'string', 'html' ),
							),
							'discount_offer' => array(
								'type'    => 'select',
								'label'   => __( 'Offering Discount?', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'no'  => __( 'No', 'uabb' ),
									'yes' => __( 'Yes', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'original_price' ),
									),
								),
							),
							'original_price' => array(
								'type'        => 'text',
								'label'       => __( 'Original Price', 'uabb' ),
								'size'        => '5',
								'connections' => array( 'string', 'html' ),
							),
						),
					),
				),
			),
			'price_list_item_image'   => array(
				'title'    => __( 'Image', 'uabb' ),
				'sections' => array(
					/* Image Basic Setting */
					'img_basic' => array(
						'title'  => __( 'Image', 'uabb' ),
						'fields' => array(
							'image_type' => array(
								'type'    => 'select',
								'label'   => __( 'Photo Source', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'    => __( 'None', 'uabb' ),
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
							'photo'      => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
							'photo_url'  => array(
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
