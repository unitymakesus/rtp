<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Pricing Table Module
 */

FLBuilder::register_module(
	'UABBPricingTableModule',
	array(
		'columns'        => array(
			'title'    => __( 'Price Boxes', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'add_legend'      => array(
							'type'    => 'select',
							'label'   => __( 'Add Legend Box', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'legend_column' ),
								),
								'no'  => array(
									'fields' => array(),
								),
							),
							'help'    => __( 'Legend Box can be used to highlight the features that you are comparing in price box columns.', 'uabb' ),
						),
						'legend_column'   => array(
							'type'         => 'form',
							'label'        => __( 'Legend Box', 'uabb' ),
							'form'         => 'legend_column_form',
							'preview_text' => 'legend_align',
							'multiple'     => false,
						),
						'pricing_columns' => array(
							'type'         => 'form',
							'label'        => __( 'Price Box', 'uabb' ),
							'form'         => 'pricing_table_column_form',
							'preview_text' => 'title',
							'multiple'     => true,
						),
					),
				),
			),
		),
		'style'          => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'spacing'          => array(
					'title'  => '',
					'fields' => array(
						'foreground_outside'     => array(
							'type'        => 'color',
							'label'       => __( 'Box Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'help'        => __( 'Use this color only when you want same color for all Price Boxes and for unique color add in individual Price Box Items', 'uabb' ),
						),
						'foreground_outside_opc' => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'show_spacing'           => array(
							'type'    => 'select',
							'label'   => __( 'Add Spacing', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Add space between price box', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'spacing' ),
								),
							),
						),
						'spacing'                => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'box_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
						),
					),
				),
				'general'          => array(
					'collapsed' => true,
					'title'     => __( 'General', 'uabb' ),
					'fields'    => array(
						'price_position'        => array(
							'type'    => 'select',
							'label'   => __( 'Price Position', 'uabb' ),
							'default' => 'above',
							'options' => array(
								'above' => __( 'Above Features List', 'uabb' ),
								'below' => __( 'Below Features List', 'uabb' ),
							),
						),
						'highlight'             => array(
							'type'    => 'select',
							'label'   => __( 'Highlight', 'uabb' ),
							'default' => 'price',
							'options' => array(
								'price' => __( 'Price', 'uabb' ),
								'title' => __( 'Title', 'uabb' ),
								'none'  => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'price' => array(
									'fields' => array( 'column_background', 'column_background_opc' ),
								),
								'title' => array(
									'fields' => array( 'column_background', 'column_background_opc' ),
								),
							),
							'help'    => __( 'To attract user attention you can Highlight Price or Title.', 'uabb' ),
						),
						'column_background'     => array(
							'type'        => 'color',
							'label'       => __( 'Highlight Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'help'        => __( 'Use this color only when you want same color for Highlighted area and for unique color use Price Box Items.', 'uabb' ),
						),
						'column_background_opc' => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'%' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'border_style'          => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(
									'fields' => array( 'border_radius' ),
								),
								'solid'  => array(
									'fields' => array( 'border_size', 'border_color' ),
								),
								'dashed' => array(
									'fields' => array( 'border_size', 'border_color' ),
								),
								'dotted' => array(
									'fields' => array( 'border_size', 'border_color' ),
								),
								'double' => array(
									'fields' => array( 'border_size', 'border_color' ),
								),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table',
								'property' => 'border-style',
							),
						),
						'border_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Box Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table',
								'property' => 'border-color',
							),
						),
						'border_radius'         => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'responsive_size'       => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Breakpoint', 'uabb' ),
							'default' => 'yes',
							'help'    => __( 'Enter the resolution at which you want Price Boxes to appear in stack layout.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'resp_size' ),
								),
							),
						),
						'resp_size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '767',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
				'button_structure' => array(
					'collapsed' => true,
					'title'     => __( 'Button Structure', 'uabb' ),
					'fields'    => array(
						'btn_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '20',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table .uabb-creative-button-wrap',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'btn_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '20',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table .uabb-creative-button-wrap',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'icon_style'       => array(
					'collapsed' => true,
					'title'     => __( 'Feature List Icon Style', 'uabb' ),
					'fields'    => array(
						'list_icon_size'    => array(
							'type'    => 'unit',
							'label'   => __( 'Icon / Image Size', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'size'    => '8',
							'default' => '20',
						),
						'list_icon_spacing' => array(
							'type'    => 'unit',
							'label'   => __( 'Icon Spacing', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'size'    => '8',
							'default' => '5',
						),
						'icon_hover_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'title_icon_style' => array(
					'collapsed' => true,
					'title'     => __( 'Title Icon Style', 'uabb' ),
					'fields'    => array(
						'title_icon_size'        => array(
							'type'    => 'unit',
							'label'   => __( 'Icon / Image Size', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'size'    => '8',
							'default' => '40',
						),
						'title_icon_spacing'     => array(
							'type'    => 'unit',
							'label'   => __( 'Icon Spacing', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'size'    => '8',
							'default' => '10',
						),
						'title_icon_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'all_typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typography'    => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_typography_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h4',
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
						'title_typo'                     => array(
							'type'       => 'typography',
							'label'      => __( 'Font Family', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-pricing-table-title',
								'important' => true,
							),
						),
					),
				),
				'price_typography'    => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'price_typography_tag_selection' => array(
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
						'price_typo'                     => array(
							'type'       => 'typography',
							'label'      => __( 'Font Family', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-pricing-table-price',
								'important' => true,
							),
						),
					),
				),
				'duration_typography' => array(
					'title'  => __( 'Duration', 'uabb' ),
					'fields' => array(
						'duration_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Font Family', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-pricing-table-duration',
								'important' => true,
							),
						),
					),
				),
				'feature_typography'  => array(
					'title'  => __( 'Properties', 'uabb' ),
					'fields' => array(
						'feature_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-pricing-table-features li',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'pricing_table_column_form',
	array(
		'title' => __( 'Add Price Box', 'uabb' ),
		'tabs'  => array(
			'general'           => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'feature'            => array(
						'title'  => '',
						'fields' => array(
							'set_featured'  => array(
								'type'    => 'select',
								'label'   => __( 'Set as Featured', 'uabb' ),
								'default' => 'no',
								'help'    => __( 'Enable to display this column as featured. Featured column will have additional label making it more visible.', 'uabb' ),
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'tabs' => array( 'typography' ),
									),
									'no'  => array(
										'fields'   => array(),
										'sections' => array(),
									),
								),
							),
							'featured_text' => array(
								'type'        => 'text',
								'label'       => __( 'Featured Text', 'uabb' ),
								'default'     => __( 'Best Value', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'title'              => array(
						'title'  => __( 'Title', 'uabb' ),
						'fields' => array(
							'title'             => array(
								'type'        => 'text',
								'label'       => __( 'Title Text', 'uabb' ),
								'default'     => __( 'Consultation Pack', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'price'             => array(
								'type'        => 'text',
								'label'       => __( 'Price Value', 'uabb' ),
								'default'     => __( '$99', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'set_sale_price'    => array(
								'type'    => 'select',
								'label'   => __( 'Offering Discount?', 'uabb' ),
								'default' => 'no',
								'help'    => __( 'Enable to display the Offering discount price', 'uabb' ),
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'original_price', 'original_price_color' ),
									),
								),
							),
							'original_price'    => array(
								'type'        => 'text',
								'label'       => __( 'Original Price', 'uabb' ),
								'default'     => __( '$149', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'duration'          => array(
								'type'        => 'text',
								'label'       => __( 'Duration', 'uabb' ),
								'default'     => __( '/ Hour', 'uabb' ),
								'placeholder' => __( '/ Hour', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'duration_position' => array(
								'type'    => 'select',
								'label'   => __( 'Duration Position', 'uabb' ),
								'default' => 'beside',
								'options' => array(
									'below'  => __( 'Below', 'uabb' ),
									'beside' => __( 'Beside', 'uabb' ),
								),
							),
						),
					),
					'price-box'          => array(
						'title'  => __( 'Price Box', 'uabb' ),
						'fields' => array(
							'title_typography_color'    => array(
								'type'        => 'color',
								'label'       => __( 'Title Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'price_typography_color'    => array(
								'type'        => 'color',
								'label'       => __( 'Price Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'original_price_color'      => array(
								'type'        => 'color',
								'label'       => __( 'Original Price Color', 'uabb' ),
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'duration_typography_color' => array(
								'type'        => 'color',
								'label'       => __( 'Duration Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'highlight_color'           => array(
								'type'        => 'color',
								'label'       => __( 'Highlight Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_alpha'  => true,
								'show_reset'  => true,
								'help'        => __( 'Use this color only when you want same color for Highlighted area and for unique color use Price Box Items.', 'uabb' ),
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-pricing-table-price',
									'property' => 'background',
								),
							),
							'highlight_color_opc'       => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'units'     => array( '%' ),
							),
							'foreground'                => array(
								'type'        => 'color',
								'label'       => __( 'Box Background Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'help'        => __( 'Select the background for specific Price Box. Keep default for global background color.', 'uabb' ),
							),
							'foreground_opc'            => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'units'     => array( '%' ),
							),
						),
					),
					'features'           => array(
						'title'  => __( 'List of Properties', 'uabb' ),
						'fields' => array(
							'features'          => array(
								'type'        => 'text',
								'label'       => '',
								'default'     => __( 'Feature 1', 'uabb' ),
								'placeholder' => __( 'One feature per line.', 'uabb' ),
								'multiple'    => true,
								'connections' => array( 'string', 'html' ),
							),
							'features_color'    => array(
								'type'        => 'color',
								'label'       => __( 'List Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'help'        => __( 'Define properties color', 'uabb' ),
							),
							'list_box_padding'  => array(
								'type'       => 'dimension',
								'label'      => __( 'Box Padding', 'uabb' ),
								'slider'     => true,
								'units'      => array( 'px' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-creative-button-wrap a',
									'property'  => 'padding',
									'unit'      => 'px',
									'important' => true,
								),
							),
							'list_item_padding' => array(
								'type'       => 'dimension',
								'label'      => __( 'Item Padding', 'uabb' ),
								'slider'     => true,
								'units'      => array( 'px' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-creative-button-wrap a',
									'property'  => 'padding',
									'unit'      => 'px',
									'important' => true,
								),
							),
						),
					),
					'even_properties'    => array(
						'title'  => __( 'Even Properties', 'uabb' ),
						'fields' => array(
							'even_properties_bg'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => 'ffffff',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
								'help'        => __( 'Choose even properties background color', 'uabb' ),
							),
							'even_properties_bg_opc' => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'units'     => array( '%' ),
							),
						),
					),
					'ribbon_section'     => array(
						'title'  => __( 'Ribbon', 'uabb' ),
						'fields' => array(
							'ribbon_style'             => array(
								'type'    => 'select',
								'label'   => __( 'Style', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'corner'   => __( 'Corner Ribbon', 'uabb' ),
									'circular' => __( 'Circular Ribbon', 'uabb' ),
									'flag'     => __( 'Flag Ribbon', 'uabb' ),
									'none'     => __( 'None', 'uabb' ),
								),
								'toggle'  => array(
									'corner'   => array(
										'fields'   => array( 'ribbon_title', 'horizontal_pos', 'ribbon_distance', 'ribbon_bg_color', 'ribbon_text_color', 'ribbon_box_shadow' ),
										'sections' => array( 'ribbon_typography' ),
									),
									'circular' => array(
										'fields'   => array( 'ribbon_title', 'horizontal_pos', 'ribbon_size', 'ribbon_bg_color', 'ribbon_text_color', 'ribbon_box_shadow' ),
										'sections' => array( 'ribbon_typography' ),
									),
									'flag'     => array(
										'fields'   => array( 'ribbon_title', 'ribbon_top_distance', 'ribbon_bg_color', 'ribbon_text_color', 'ribbon_box_shadow', 'ribbon_padding' ),
										'sections' => array( 'ribbon_typography' ),
									),
								),
							),
							'ribbon_title'             => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'default'     => __( 'New', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'horizontal_pos'           => array(
								'type'    => 'select',
								'label'   => __( 'Horizontal Position', 'uabb' ),
								'default' => 'right',
								'options' => array(
									'left'  => __( 'Left', 'uabb' ),
									'right' => __( 'Right', 'uabb' ),
								),
							),
							'ribbon_distance'          => array(
								'type'      => 'unit',
								'label'     => __( 'Distance', 'uabb' ),
								'default'   => '35',
								'units'     => array( 'px' ),
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'ribbon_size'              => array(
								'type'      => 'unit',
								'label'     => __( 'Size', 'uabb' ),
								'default'   => '4',
								'units'     => array( 'em' ),
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'px' => array(
										'min'  => 1,
										'max'  => 20,
										'step' => 0.1,
									),
								),
							),
							'ribbon_top_distance'      => array(
								'type'      => 'unit',
								'label'     => __( 'Top Distance', 'uabb' ),
								'default'   => '',
								'units'     => array( '%' ),
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 10,
									),
								),
							),
							'ribbon_bg_color'          => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'ribbon_text_color'        => array(
								'type'        => 'color',
								'label'       => __( 'Text Color', 'uabb' ),
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'ribbon_padding'           => array(
								'type'       => 'dimension',
								'label'      => __( 'Padding', 'uabb' ),
								'slider'     => true,
								'units'      => array( 'px' ),
								'responsive' => true,
							),
							'ribbon_box_shadow'        => array(
								'type'    => 'select',
								'label'   => __( 'Enable Box Shadow', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'ribbon_shadow_color_hor', 'ribbon_shadow_color_ver', 'ribbon_shadow_color_blur', 'ribbon_shadow_color_spr', 'ribbon_shadow_color' ),
									),
								),
							),
							'ribbon_shadow_color_hor'  => array(
								'type'   => 'unit',
								'label'  => __( 'Horizontal Length', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'ribbon_shadow_color_ver'  => array(
								'type'   => 'unit',
								'label'  => __( 'Vertical Length', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'ribbon_shadow_color_blur' => array(
								'type'   => 'unit',
								'label'  => __( 'Blur Radius', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'ribbon_shadow_color_spr'  => array(
								'type'   => 'unit',
								'label'  => __( 'Spread Radius', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'ribbon_shadow_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Shadow Color', 'uabb' ),
								'default'    => 'rgba(168,168,168,0.5)',
								'show_reset' => true,
								'show_alpha' => true,
							),
						),
					),
					'box_shadow_section' => array(
						'title'  => __( 'Box Shadow', 'uabb' ),
						'fields' => array(
							'price_box_shadow'      => array(
								'type'    => 'select',
								'label'   => __( 'Enable Box Shadow for Price Box', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'box_shadow_color_hor', 'box_shadow_color_ver', 'box_shadow_color_blur', 'box_shadow_color_spr', 'box_shadow_color' ),
									),
								),
							),
							'box_shadow_color_hor'  => array(
								'type'   => 'unit',
								'label'  => __( 'Horizontal Length', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'box_shadow_color_ver'  => array(
								'type'   => 'unit',
								'label'  => __( 'Vertical Length', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'box_shadow_color_blur' => array(
								'type'   => 'unit',
								'label'  => __( 'Blur Radius', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'box_shadow_color_spr'  => array(
								'type'   => 'unit',
								'label'  => __( 'Spread Radius', 'uabb' ),
								'size'   => '5',
								'units'  => array( 'px' ),
								'slider' => array(
									'px' => array(
										'min'  => 0,
										'max'  => 100,
										'step' => 1,
									),
								),
							),
							'box_shadow_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Shadow Color', 'uabb' ),
								'default'    => 'rgba(168,168,168,0.5)',
								'show_reset' => true,
								'show_alpha' => true,
							),
						),
					),
				),
			),
			'feature_list_icon' => array(
				'title'    => __( 'Icon', 'uabb' ),
				'sections' => array(
					'title'            => array(
						'title'  => __( 'Feature List icon', 'uabb' ),
						'fields' => array(
							'image_type' => array(
								'type'    => 'select',
								'label'   => __( 'Enable Icon', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none' => __( 'No', 'uabb' ), // Removed args 'Image type.',.
									'icon' => __( 'Yes', 'uabb' ),
								),
								'toggle'  => array(
									'icon' => array(
										'sections' => array( 'icon_basic', 'icon_style' ),
									),
								),
							),
						),
					),
					/* Icon Basic Setting */
					'icon_basic'       => array( // Section.
						'title'  => __( 'Feature List icon Settings', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icon'            => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'list_icon_color' => array(
								'type'        => 'color',
								'show_alpha'  => true,
								'label'       => __( 'Icon Color', 'uabb' ),
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
							'icon_position'   => array(
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
					'title_icon'       => array( // Section.
						'title'  => __( 'Title Icon', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'title_icon_setting' => array(
								'type'    => 'select',
								'label'   => __( 'Enable Title Icon', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none' => __( 'No', 'uabb' ), // Removed args 'Image type.',.
									'icon' => __( 'Yes', 'uabb' ),
								),
								'toggle'  => array(
									'icon' => array(
										'sections' => array( 'title_icon_basic', 'title_icon_style' ),
									),
								),
							),
						),
					),
					'title_icon_basic' => array( // Section.
						'title'  => __( 'Title Icon Settings', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'title_icon'          => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'title_icon_color'    => array(
								'type'        => 'color',
								'show_alpha'  => true,
								'label'       => __( 'Icon Color', 'uabb' ),
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
							'title_icon_position' => array(
								'type'    => 'select',
								'label'   => __( 'Icon Position', 'uabb' ),
								'default' => 'inline',
								'options' => array(
									'inline'  => __( 'Inline', 'uabb' ),
									'stacked' => __( 'Stacked', 'uabb' ),
								),
							),
						),
					),
				),
			),
			'button'            => array(
				'title'    => __( 'Button', 'uabb' ),
				'sections' => array(
					'general'           => array(
						'title'  => '',
						'fields' => array(
							'show_button' => array(
								'type'    => 'select',
								'label'   => __( 'Show Button', 'uabb' ),
								'default' => 'yes',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'sections' => array( 'btn-style', 'btn-colors', 'btn-structure', 'btn-icon', 'btn-link', 'btn-general', 'button_typography' ),
									),
								),
							),
						),
					),
					'btn-general'       => array( // Section.
						'title'  => __( 'General', 'uabb' ),
						'fields' => array(
							'btn_text' => array(
								'type'        => 'text',
								'label'       => __( 'Text', 'uabb' ),
								'default'     => __( 'Get Started', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'btn-link'          => array( // Section.
						'title'  => __( 'Link', 'uabb' ),
						'fields' => array(
							'btn_link' => array(
								'type'          => 'link',
								'label'         => __( 'Link', 'uabb' ),
								'placeholder'   => 'http://www.example.com',
								'connections'   => array( 'url' ),
								'preview'       => array(
									'type' => 'none',
								),
								'show_target'   => true,
								'show_nofollow' => true,
							),
						),
					),
					'btn-style'         => array(
						'title'  => __( 'Style', 'uabb' ),
						'fields' => array(
							'btn_style'                 => array(
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
								'toggle'  => array(
									'default'     => array(
										'fields' => array( 'button_padding_dimension', 'button_border', 'border_hover_color' ),
									),
									'gradient'    => array(
										'fields' => array( 'btn_width', 'btn_border_radius' ),
									),
									'transparent' => array(
										'fields' => array( 'btn_width', 'btn_border_radius' ),
									),
									'threed'      => array(
										'fields' => array( 'btn_width', 'btn_border_radius' ),
									),
									'flat'        => array(
										'fields' => array( 'btn_width', 'btn_border_radius' ),
									),
								),
							),
							'btn_border_size'           => array(
								'type'        => 'unit',
								'label'       => __( 'Border Size', 'uabb' ),
								'units'       => array( 'px' ),
								'maxlength'   => '3',
								'size'        => '5',
								'placeholder' => '2',
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_transparent_button_options' => array(
								'type'    => 'select',
								'label'   => __( 'Hover Styles', 'uabb' ),
								'default' => 'transparent-fade',
								'options' => array(
									'none'                 => __( 'None', 'uabb' ),
									'transparent-fade'     => __( 'Fade Background', 'uabb' ),
									'transparent-fill-top' => __( 'Fill Background From Top', 'uabb' ),
									'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
									'transparent-fill-left' => __( 'Fill Background From Left', 'uabb' ),
									'transparent-fill-right' => __( 'Fill Background From Right', 'uabb' ),
									'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
									'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
									'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
								),
							),
							'btn_threed_button_options' => array(
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
							'btn_flat_button_options'   => array(
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
					'btn-icon'          => array( // Section.
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
					'btn-colors'        => array( // Section.
						'title'  => __( 'Colors', 'uabb' ),
						'fields' => array(
							'btn_text_color'         => array(
								'type'        => 'color',
								'label'       => __( 'Text Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'btn_text_hover_color'   => array(
								'type'        => 'color',
								'label'       => __( 'Text Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
								'preview'     => array(
									'type' => 'none',
								),
							),
							'btn_bg_color'           => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'btn_bg_color_opc'       => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'units'     => array( '%' ),
							),

							'btn_bg_hover_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Hover Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'preview'     => array(
									'type' => 'none',
								),
							),
							'btn_bg_hover_color_opc' => array(
								'type'      => 'text',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'units'     => array( '%' ),
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
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
					'btn-structure'     => array(
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
								'type'       => 'dimension',
								'label'      => __( 'Padding', 'uabb' ),
								'slider'     => true,
								'units'      => array( 'px' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-creative-button-wrap a',
									'property'  => 'padding',
									'unit'      => 'px',
									'important' => true,
								),
							),
							'button_border'            => array(
								'type'    => 'border',
								'label'   => __( 'Border', 'uabb' ),
								'slider'  => true,
								'units'   => array( 'px' ),
								'preview' => array(
									'type'      => 'css',
									'selector'  => '.uabb-creative-button-wrap a',
									'property'  => 'border',
									'unit'      => 'px',
									'important' => true,
								),
							),
							'border_hover_color'       => array(
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
							'btn_custom_width'         => array(
								'type'      => 'unit',
								'label'     => __( 'Custom Width', 'uabb' ),
								'default'   => '200',
								'maxlength' => '3',
								'size'      => '4',
								'units'     => array( 'px' ),
								'slider'    => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_custom_height'        => array(
								'type'      => 'unit',
								'label'     => __( 'Custom Height', 'uabb' ),
								'default'   => '45',
								'maxlength' => '3',
								'size'      => '4',
								'units'     => array( 'px' ),
								'slider'    => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_padding_top_bottom'   => array(
								'type'        => 'unit',
								'label'       => __( 'Padding Top/Bottom', 'uabb' ),
								'placeholder' => '0',
								'maxlength'   => '3',
								'size'        => '4',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_padding_left_right'   => array(
								'type'        => 'unit',
								'label'       => __( 'Padding Left/Right', 'uabb' ),
								'placeholder' => '0',
								'maxlength'   => '3',
								'size'        => '4',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_border_radius'        => array(
								'type'      => 'unit',
								'label'     => __( 'Round Corners', 'uabb' ),
								'maxlength' => '3',
								'size'      => '4',
								'units'     => array( 'px' ),
								'slider'    => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'btn_custom_class'         => array(
								'type'        => 'text',
								'label'       => __( 'Custom Class', 'uabb' ),
								'default'     => '',
								'connections' => array( 'string', 'html' ),
								'preview'     => array(
									'type' => 'none',
								),
							),
						),
					),
					'button_typography' => array(
						'title'  => __( 'Button Settings', 'uabb' ),
						'fields' => array(
							'button_typo' => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-button',
									'important' => true,
								),
							),
						),
					),
				),
			),
			'typography'        => array(
				'title'    => __( 'Typography', 'uabb' ),
				'sections' => array(
					'featured_text_typography' => array(
						'title'  => __( 'Featured Text', 'uabb' ),
						'fields' => array(
							'featured_tag_selection'      => array(
								'type'    => 'select',
								'label'   => __( 'Tag', 'uabb' ),
								'default' => 'h4',
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
							'featured_typo'               => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,

							),
							'featured_color'              => array(
								'type'        => 'color',
								'label'       => __( 'Featured Text Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'featured_f_background_color' => array(
								'type'        => 'color',
								'label'       => __( 'Featured Text Background Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'featured_f_background_color_opc' => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'units'     => array( '%' ),
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
						),
					),
					'ribbon_typography'        => array(
						'title'  => __( 'Ribbon Settings', 'uabb' ),
						'fields' => array(
							'ribbon_typo' => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,
							),
						),
					),
				),
			),
		),
	)
);


FLBuilder::register_settings_form(
	'legend_column_form',
	array(
		'title' => __( 'Add Legend Box', 'uabb' ),
		'tabs'  => array(
			'general'    => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'features'        => array(
						'title'  => _x( 'Legends', 'Price legends displayed in price box.', 'uabb' ),
						'fields' => array(
							'legend_align'   => array(
								'type'    => 'align',
								'label'   => __( 'Alignment', 'uabb' ),
								'default' => 'right',
							),
							'foreground'     => array(
								'type'        => 'color',
								'label'       => __( 'Box Background Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
							'foreground_opc' => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'units'     => array( '%' ),
								'maxlength' => '3',
								'size'      => '5',
								'slider'    => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
						),
					),
					'list'            => array(
						'title'  => __( 'List of Properties', 'uabb' ),
						'fields' => array(
							'features' => array(
								'type'        => 'text',
								'label'       => '',
								'placeholder' => __( 'One legend per line.', 'uabb' ),
								'multiple'    => true,
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'even_properties' => array(
						'title'  => __( 'Even Properties', 'uabb' ),
						'fields' => array(
							'even_properties_bg'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => 'ffffff',
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
								'help'        => __( 'Choose even properties background color', 'uabb' ),
							),
							'even_properties_bg_opc' => array(
								'type'      => 'unit',
								'label'     => __( 'Opacity', 'uabb' ),
								'default'   => '',
								'maxlength' => '3',
								'size'      => '5',
								'units'     => array( '%' ),
								'slider'    => array(
									'%' => array(
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
			'typography' => array(
				'title'    => __( 'Typography', 'uabb' ),
				'sections' => array(
					'legend_typography' => array(
						'title'  => __( 'Legend', 'uabb' ),
						'fields' => array(
							'legend_typo'  => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,
							),
							'legend_color' => array(
								'type'        => 'color',
								'label'       => __( 'Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_reset'  => true,
								'show_alpha'  => true,
							),
						),
					),
				),
			),
		),
	)
);
