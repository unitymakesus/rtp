<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
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
							'type'       => 'color',
							'label'      => __( 'Box Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'help'       => __( 'Use this color only when you want same color for all Price Boxes and for unique color add in individual Price Box Items', 'uabb' ),
						),
						'foreground_outside_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
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
							'description' => 'px',
						),
						'features_align'         => array(
							'type'    => 'select',
							'label'   => __( 'Properties Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table li',
								'property' => 'text-align',
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
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
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
							'type'       => 'color',
							'label'      => __( 'Highlight Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'help'       => __( 'Use this color only when you want same color for Highlighted area and for unique color use Price Box Items.', 'uabb' ),
						),
						'column_background_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
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
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'border_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Box Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
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
							'description' => 'px',
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
							'description' => 'px',
						),
					),
				),
				'button_structure' => array(
					'title'  => __( 'Button Structure', 'uabb' ),
					'fields' => array(
						'btn_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '20',
							'size'        => '8',
							'description' => 'px',
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
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table .uabb-creative-button-wrap',
								'property' => 'margin-bottom',
								'unit'     => 'px',
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
						'title_typography_tag_selection'  => array(
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
						'title_typography_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-pricing-table-title',
							),
						),
						'title_typography_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-title',
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
						'title_typography_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-title',
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
						'title_transform'                 => array(
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
								'selector' => '.uabb-pricing-table-column .uabb-pricing-table-title',
								'property' => 'text-transform',
							),
						),
						'title_letter_spacing'            => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'price_typography'    => array(
					'title'  => __( 'Price', 'uabb' ),
					'fields' => array(
						'price_typography_tag_selection'  => array(
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
						'price_typography_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-pricing-table-price',
							),
						),
						'price_typography_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-price',
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
						'price_typography_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-price',
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
						'price_typography_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-price',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'duration_typography' => array(
					'title'  => __( 'Duration', 'uabb' ),
					'fields' => array(
						'duration_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-pricing-table-duration',
							),
						),
						'duration_typography_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-duration',
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
						'duration_typography_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-duration',
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
						'duration_typography_transform'   => array(
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
								'selector' => '.uabb-pricing-table-duration',
								'property' => 'text-transform',
							),
						),
						'duration_typography_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-duration',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'feature_typography'  => array(
					'title'  => __( 'Properties', 'uabb' ),
					'fields' => array(
						'feature_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-pricing-table-features li',
							),
						),
						'feature_typography_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-features li',
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
						'feature_typography_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-features li',
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
						'feature_content_transform'      => array(
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
								'selector' => '.uabb-pricing-table-features li',
								'property' => 'text-transform',
							),
						),
						'feature_content_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-pricing-table-features li',
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

FLBuilder::register_settings_form(
	'pricing_table_column_form',
	array(
		'title' => __( 'Add Price Box', 'uabb' ),
		'tabs'  => array(
			'general'    => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'feature'         => array(
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
										'fields' => array( 'featured_text' ),
										'tabs'   => array( 'typography' ),
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
					'title'           => array(
						'title'  => __( 'Title', 'uabb' ),
						'fields' => array(
							'title'    => array(
								'type'        => 'text',
								'label'       => __( 'Title Text', 'uabb' ),
								'default'     => __( 'Consultation Pack', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'price'    => array(
								'type'        => 'text',
								'label'       => __( 'Price Value', 'uabb' ),
								'default'     => __( '$99', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'duration' => array(
								'type'        => 'text',
								'label'       => __( 'Duration', 'uabb' ),
								'default'     => __( '/ Hour', 'uabb' ),
								'placeholder' => __( '/ Hour', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'price-box'       => array(
						'title'  => __( 'Price Box', 'uabb' ),
						'fields' => array(
							'title_typography_color'    => array(
								'type'       => 'color',
								'label'      => __( 'Title Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'price_typography_color'    => array(
								'type'       => 'color',
								'label'      => __( 'Price Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'duration_typography_color' => array(
								'type'       => 'color',
								'label'      => __( 'Duration Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'highlight_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Highlight Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'help'       => __( 'Use this color only when you want same color for Highlighted area and for unique color use Price Box Items.', 'uabb' ),
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-pricing-table-price',
									'property' => 'background',
								),
							),
							'highlight_color_opc'       => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'foreground'                => array(
								'type'       => 'color',
								'label'      => __( 'Box Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'help'       => __( 'Select the background for specific Price Box. Keep default for global background color.', 'uabb' ),
							),
							'foreground_opc'            => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
						),
					),
					'features'        => array(
						'title'  => __( 'List of Properties', 'uabb' ),
						'fields' => array(
							'features'       => array(
								'type'        => 'text',
								'label'       => '',
								'default'     => __( 'Feature 1', 'uabb' ),
								'placeholder' => __( 'One feature per line.', 'uabb' ),
								'multiple'    => true,
								'connections' => array( 'string', 'html' ),
							),
							'features_color' => array(
								'type'       => 'color',
								'label'      => __( 'List Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'help'       => __( 'Define properties color', 'uabb' ),
							),
						),
					),
					'even_properties' => array(
						'title'  => __( 'Even Properties', 'uabb' ),
						'fields' => array(
							'even_properties_bg'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
								'help'       => __( 'Choose even properties background color', 'uabb' ),
							),
							'even_properties_bg_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
						),
					),
				),
			),
			'button'     => array(
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
							'btn_link'          => array(
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'placeholder' => 'http://www.example.com',
								'connections' => array( 'url' ),
								'preview'     => array(
									'type' => 'none',
								),
							),
							'btn_link_target'   => array(
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'default' => '_self',
								'options' => array(
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								),
								'preview' => array(
									'type' => 'none',
								),
							),
							'btn_link_nofollow' => array(
								'type'        => 'select',
								'label'       => __( 'Link nofollow', 'uabb' ),
								'description' => '',
								'default'     => '0',
								'help'        => __( 'Enable this to make this link nofollow', 'uabb' ),
								'options'     => array(
									'1' => __( 'Yes', 'uabb' ),
									'0' => __( 'No', 'uabb' ),
								),
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
							),
							'btn_border_size'           => array(
								'type'        => 'unit',
								'label'       => __( 'Border Size', 'uabb' ),
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '5',
								'placeholder' => '2',
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
								'type'       => 'color',
								'label'      => __( 'Text Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'btn_text_hover_color'   => array(
								'type'       => 'color',
								'label'      => __( 'Text Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_bg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'btn_bg_color_opc'       => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),

							'btn_bg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_bg_hover_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
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
								'type'        => 'dimension',
								'label'       => __( 'Padding', 'uabb' ),
								'description' => 'px',
								'responsive'  => true,
								'preview'     => array(
									'type'      => 'css',
									'selector'  => '.uabb-creative-button-wrap a',
									'property'  => 'padding',
									'unit'      => 'px',
									'important' => true,
								),
							),
							'button_border_style'      => array(
								'type'    => 'select',
								'label'   => __( 'Bottom Border Type', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'   => __( 'None', 'uabb' ),
									'solid'  => __( 'Solid', 'uabb' ),
									'dashed' => __( 'Dashed', 'uabb' ),
									'dotted' => __( 'Dotted', 'uabb' ),
									'double' => __( 'Double', 'uabb' ),
								),
								'preview' => array(
									'type'     => 'css',
									'selector' => '.uabb-creative-button-wrap a',
									'property' => 'border-style',
								),
							),
							'button_border_width'      => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'placeholder' => '1',
								'description' => 'px',
								'maxlength'   => '2',
								'size'        => '6',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-creative-button-wrap a',
									'property' => 'border-width',
									'unit'     => 'px',
								),
							),
							'button_border_radius'     => array(
								'type'        => 'unit',
								'label'       => __( 'Border Radius', 'uabb' ),
								'placeholder' => '1',
								'description' => 'px',
								'maxlength'   => '2',
								'size'        => '6',
								'preview'     => array(
									'type'     => 'css',
									'selector' => '.uabb-creative-button-wrap a',
									'property' => 'border-radius',
									'unit'     => 'px',
								),
							),
							'button_border_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type'     => 'css',
									'selector' => '.uabb-creative-button-wrap a',
									'property' => 'border-color',
								),
							),
							'border_hover_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'btn_custom_width'         => array(
								'type'        => 'unit',
								'label'       => __( 'Custom Width', 'uabb' ),
								'default'     => '200',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_custom_height'        => array(
								'type'        => 'unit',
								'label'       => __( 'Custom Height', 'uabb' ),
								'default'     => '45',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_padding_top_bottom'   => array(
								'type'        => 'unit',
								'label'       => __( 'Padding Top/Bottom', 'uabb' ),
								'placeholder' => '0',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_padding_left_right'   => array(
								'type'        => 'unit',
								'label'       => __( 'Padding Left/Right', 'uabb' ),
								'placeholder' => '0',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_border_radius'        => array(
								'type'        => 'unit',
								'label'       => __( 'Round Corners', 'uabb' ),
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
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
							'button_typography_font_family' => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
								'preview' => array(
									'type'     => 'font',
									'selector' => '.uabb-button',
								),
							),
							'button_typography_font_size_unit' => array(
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
							),
							'button_typography_line_height_unit' => array(
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
							),
							'button_transform'      => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
							),
							'button_letter_spacing' => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
							),
						),
					),
				),
			),
			'typography' => array(
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
							'featured_font_family'        => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
							),
							'featured_font_size_unit'     => array(
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
							),
							'featured_line_height_unit'   => array(
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
							),
							'featured_color'              => array(
								'type'       => 'color',
								'label'      => __( 'Featured Text Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'featured_f_background_color' => array(
								'type'       => 'color',
								'label'      => __( 'Featured Text Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'featured_f_background_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'featured_transform'          => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
							),
							'featured_letter_spacing'     => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
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
								'type'    => 'select',
								'label'   => __( 'Alignment', 'uabb' ),
								'default' => 'right',
								'options' => array(
									'center' => __( 'Center', 'uabb' ),
									'left'   => __( 'Left', 'uabb' ),
									'right'  => __( 'Right', 'uabb' ),
								),
							),
							'foreground'     => array(
								'type'       => 'color',
								'label'      => __( 'Box Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'foreground_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
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
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
								'help'       => __( 'Choose even properties background color', 'uabb' ),
							),
							'even_properties_bg_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
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
							'legend_font_family'      => array(
								'type'    => 'font',
								'label'   => __( 'Font Family', 'uabb' ),
								'default' => array(
									'family' => 'Default',
									'weight' => 'Default',
								),
							),
							'legend_font_size_unit'   => array(
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
							),
							'legend_line_height_unit' => array(
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
							),
							'legend_color'            => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'legend_transform'        => array(
								'type'    => 'select',
								'label'   => __( 'Transform', 'uabb' ),
								'default' => '',
								'options' => array(
									''           => 'Default',
									'uppercase'  => 'UPPERCASE',
									'lowercase'  => 'lowercase',
									'capitalize' => 'Capitalize',
								),
							),
							'legend_letter_spacing'   => array(
								'type'        => 'unit',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'placeholder' => '0',
								'size'        => '5',
								'description' => 'px',
							),
						),
					),
				),
			),
		),
	)
);
