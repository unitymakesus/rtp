<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Price List Module
 */

FLBuilder::register_module(
	'UABBPriceList',
	array(
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
							'type'    => 'align',
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
							'units'       => array( 'px' ),
							'size'        => '8',
							'placeholder' => '75',
							'slider'      => true,
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
							'type'    => 'select',
							'label'   => __( 'Connector Line Style', 'uabb' ),
							'default' => 'dotted',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'price_list_connector_width', 'price_list_connector_color', 'price_list_connector_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'price_list_connector_width', 'price_list_connector_color', 'price_list_connector_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'price_list_connector_width', 'price_list_connector_color', 'price_list_connector_hover_color' ),
								),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item .uabb-price-list-separator',
								'property'  => 'border-bottom-style',
								'important' => true,
							),
						),
						'price_list_connector_width'       => array(
							'type'      => 'unit',
							'label'     => __( 'Connector Thickness', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '3',
							'size'      => '6',
							'default'   => '1',
							'slider'    => 'true',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item .uabb-price-list-separator',
								'property'  => 'border-bottom-width',
								'important' => true,
							),
						),
						'price_list_connector_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Connector Line Color', 'uabb' ),
							'default'     => '000000',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item .uabb-price-list-separator',
								'property'  => 'border-bottom-color',
								'important' => true,
							),
						),
						'price_list_connector_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Connector Line Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
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
							'type'      => 'unit',
							'label'     => __( 'Space Between Price Items', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '3',
							'size'      => '6',
							'default'   => '20',
							'slider'    => 'true',
							'preview'   => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item:not(:last-child)',
								'property'  => 'margin-bottom',
								'important' => true,
							),
						),
						'space_between_img_content'        => array(
							'type'      => 'unit',
							'label'     => __( 'Space Between Image & Content', 'uabb' ),
							'units'     => array( 'px' ),
							'slider'    => true,
							'maxlength' => '3',
							'size'      => '6',
							'default'   => '0',
							'preview'   => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-price-list-left .uabb-price-list-image',
										'property'  => 'margin-right',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-price-list-right .uabb-price-list-image',
										'property'  => 'margin-left',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-price-list-top .uabb-price-list-image',
										'property'  => 'margin-bottom',
										'important' => true,
									),
								),
							),
						),
						'list_item_padding_dimension'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => 'true',
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item',
								'property'  => 'padding',
								'important' => true,
							),
						),
						'list_item_background_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item',
								'property'  => 'Background',
								'important' => true,
							),
						),
						'list_item_background_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'price_border'                     => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-item',
								'important' => true,
							),
						),
						'price_list_border_hover_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
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
							'type'    => 'unit',
							'label'   => __( 'Image Size', 'uabb' ),
							'default' => '150',
							'size'    => '8',
							'units'   => array( 'px' ),
							'slider'  => true,
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-price-list-image',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-price-list-image',
										'property'  => 'min-width',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'image_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '0',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-image img',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
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
						'heading_font_typo'   => array(
							'type'       => 'typography',
							'label'      => __( 'Title Typography', 'uabb' ),
							'responsive' => 'true',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-title',
								'important' => true,
							),
						),
						'heading_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Title Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-title',
								'property'  => 'color',
								'important' => true,
							),
						),
						'heading_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Title Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'heading_margin'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Title Margin', 'uabb' ),
							'default'    => '10',
							'size'       => '8',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'max_length' => '3',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-title',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_font_typo'   => array(
							'type'       => 'typography',
							'label'      => __( ' Description Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-description',
								'important' => true,
							),
						),
						'description_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-description',
								'property'  => 'color',
								'important' => true,
							),
						),
						'description_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Description Hover Color', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'description_margin'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Description Margin', 'uabb' ),
							'size'       => '8',
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'max_length' => '3',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-description',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'price_typography'       => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'price_font_typo'   => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-price,.uabb-price-list-discount-price',
								'important' => true,
							),
						),
						'price_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Price Color', 'uabb' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-list-price,.uabb-price-list-discount-price',
								'important' => true,
								'property'  => 'color',
							),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'price_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Price Hover Color', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'price_margin'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Price Margin', 'uabb' ),
							'size'       => '8',
							'default'    => '10',
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'max_length' => '3',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-price-wrapper',
								'important' => true,
								'property'  => 'margin',
								'unit'      => 'px',
							),
						),
					),
				),
			),
		),
		'uabb_docs'                 => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/price-list/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=price-list-module" target="_blank" rel="noopener"> Getting started article </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/minimum-height-option-in-price-list/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=price-list-module" target="_blank" rel="noopener"> How to use Minimum height option </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/set-different-image-positions/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=price-list-module" target="_blank" rel="noopener"> How to set different image positions? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/set-hover-colors-animation-for-price-list/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=price-list-module" target="_blank" rel="noopener"> How to set Hover Colors and Animation for Price List? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'price_list_item_form',
	array(
		'title' => __( 'Add List Item', 'uabb' ),
		'tabs'  => array(
			'price_list_item_general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'title'         => array(
						'title'  => __( 'General Settings', 'uabb' ),
						'fields' => array(
							'price_list_item_title'       => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'description' => '',
								'default'     => __( 'Product 1', 'uabb' ),
								'help'        => __( 'Provide a title for this Price list item.', 'uabb' ),
								'placeholder' => __( 'Title', 'uabb' ),
								'class'       => 'uabb-price-list-item-title',
								'connections' => array( 'string', 'html' ),
							),
							'price_list_item_url'         => array(
								'type'          => 'link',
								'label'         => __( 'Link', 'uabb' ),
								'connections'   => array( 'url' ),
								'show_target'   => true,
								'show_nofollow' => true,
							),
							'price_list_item_description' => array(
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
								'size'        => '8',
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
								'size'        => '8',
								'slider'      => true,
								'default'     => '$100',
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
