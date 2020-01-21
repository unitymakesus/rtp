<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Table Module
 */

FLBuilder::register_module(
	'UABBTable', array(
		'headrow'        => array(
			'title'    => __( 'Table Header', 'uabb' ),
			'sections' => array(
				'new_feature' => array(
					'title'  => __( 'Table Source', 'uabb' ),
					'fields' => array(
						'table_type' => array(
							'type'    => 'select',
							'label'   => __( 'Select Table Source', 'uabb' ),
							'default' => 'manual',
							'options' => array(
								'manual' => __( 'Manual', 'uabb' ),
								'file'   => __( 'CSV File', 'uabb' ),
							),
							'toggle'  => array(
								'manual' => array(
									'sections' => array( 'general' ),
									'tabs'     => array( 'bodyrows' ),
								),
								'file'   => array(
									'fields' => array( 'file_src' ),
								),
							),
						),
						'file_src'   => array(
							'type'        => 'uabb-file',
							'label'       => __( 'Upload CSV File', 'uabb' ),
							'show_remove' => true,
							'description' => UABBTable::get_description( 'file_src' ),
						),
					),
				),
				'general'     => array(
					'title'  => __( 'Heading Row', 'uabb' ),
					'fields' => array(
						'thead_row' => array(
							'type'         => 'form',
							'label'        => __( 'Item', 'uabb' ),
							'form'         => 'thead_row_form',
							'preview_text' => 'heading',
							'multiple'     => true,
							'default'      => array(
								array(
									'head_action' => 'row',
									'heading'     => 'Name',
								),
								array(
									'head_action' => 'cell',
									'heading'     => 'Designation',
								),
								array(
									'head_action' => 'cell',
									'heading'     => 'Office',
								),
							),
						),
					),
				),
			),
		),
		'bodyrows'       => array(
			'title'    => __( 'Table Content', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => __( 'Body Content', 'uabb' ),
					'fields' => array(
						'tbody_row' => array(
							'type'         => 'form',
							'label'        => __( 'Item', 'uabb' ),
							'form'         => 'tbody_row_form',
							'preview_text' => 'features',
							'multiple'     => true,
							'default'      => array(
								array(
									'action'   => 'row',
									'features' => 'Mr. John Doe',
								),
								array(
									'action'   => 'cell',
									'features' => 'Software Developer',
								),
								array(
									'action'   => 'cell',
									'features' => 'Tokyo',
								),
								array(
									'action'   => 'row',
									'features' => 'Ms. Cara Wagner',
								),
								array(
									'action'   => 'cell',
									'features' => 'Integration Specialist',
								),
								array(
									'action'   => 'cell',
									'features' => 'London',
								),
								array(
									'action'   => 'row',
									'features' => 'Mr. Bruno Stevens',
								),
								array(
									'action'   => 'cell',
									'features' => 'WordPress Developer',
								),
								array(
									'action'   => 'cell',
									'features' => 'New York',
								),
							),
						),
					),
				),
			),
		),
		'extra_features' => array(
			'title'    => __( 'Features', 'uabb' ),
			'sections' => array(
				'enable_sort'   => array(
					'title'  => __( 'Sorting', 'uabb' ),
					'fields' => array(
						'show_sort' => array(
							'type'        => 'select',
							'label'       => __( 'Sortable Table', 'uabb' ),
							'default'     => 'no',
							'help'        => __( 'Sort table entries on the click of table headings.', 'uabb' ),
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'description' => UABBTable::get_description( 'show_sort' ),
						),
					),
				),
				'enable_search' => array(
					'title'  => __( 'Search Field', 'uabb' ),
					'fields' => array(
						'show_search'  => array(
							'type'    => 'select',
							'label'   => __( 'Searchable Table', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Search table entries easily.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'sections' => array( '' ),
								),
								'yes' => array(
									'fields'   => array( 'search_label' ),
									'sections' => array( 'filter_typography' ),
								),
							),
						),
						'search_label' => array(
							'type'        => 'text',
							'label'       => __( 'Search Placeholder Label', 'uabb' ),
							'placeholder' => __( 'Search...', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'enable_filter' => array(
					'title'  => __( 'Entries Dropdown', 'uabb' ),
					'fields' => array(
						'show_entries'           => array(
							'type'    => 'select',
							'label'   => __( 'Show Entries Dropdown', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Controls the number of entries in a table.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'sections' => array( '' ),
								),
								'yes' => array(
									'fields'   => array( 'show_entries_label', 'show_entries_all_label' ),
									'sections' => array( 'filter_typography' ),
								),
							),
						),
						'show_entries_label'     => array(
							'type'        => 'text',
							'label'       => __( 'Show Entries Label', 'uabb' ),
							'placeholder' => __( 'Show Entries', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'show_entries_all_label' => array(
							'type'        => 'text',
							'label'       => __( 'All Label', 'uabb' ),
							'default'     => __( 'All', 'uabb' ),
							'placeholder' => __( 'All', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'style'          => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'spacing'           => array(
					'title'  => __( 'Header Settings', 'uabb' ),
					'fields' => array(
						'row_heading_color'            => array(
							'type'        => 'color',
							'label'       => __( 'Heading Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.uabb-table-header .table-header-th, .uabb-table-header .table-header-th .thead-th-context, .table-header-th .th-style',
							),
						),
						'row_heading_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Heading Background Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'important' => true,
								'selector'  => '.uabb-table-header .table-header-th',
							),
						),
						'header_cell_padding'          => array(
							'type'    => 'unit',
							'label'   => __( 'Header Cells Padding', 'uabb' ),
							'default' => '15',
							'size'    => '8',
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
								'selector'  => '.uabb-table-inner-wrap .uabb-table-header .table-header-th',
								'property'  => 'padding',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'table_data_border_size'       => array(
							'type'        => 'unit',
							'label'       => __( 'Header Cells Border Size', 'uabb' ),
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
								'type'      => 'css',
								'selector'  => '.uabb-table-inner-wrap .uabb-table-header .table-header-th',
								'property'  => 'border-width',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'table_data_border_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Header Cells Border Color', 'uabb' ),
							'default'     => '000000',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-table-inner-wrap .uabb-table-header .table-header-th',
								'property'  => 'border-color',
								'important' => true,
								'important' => true,
							),
						),
					),
				),
				'body_styles'       => array(
					'title'  => __( 'Body Settings', 'uabb' ),
					'fields' => array(
						'strip_effect'                 => array(
							'type'    => 'select',
							'label'   => __( 'Enable Striped Effect', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Enable striped effect to highlight odd and even rows with different background colors.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'fields' => array( 'table_foreground_outside' ),
								),
								'yes' => array(
									'fields' => array( 'odd_properties_bg', 'even_properties_bg' ),
								),
							),
						),
						'table_foreground_outside'     => array(
							'type'        => 'color',
							'label'       => __( 'Rows Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'important' => true,
								'selector'  => '.uabb-table-features .tbody-row',
							),
						),
						'odd_properties_bg'            => array(
							'type'        => 'color',
							'label'       => __( 'Odd Rows Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'important' => true,
								'selector'  => '.uabb-table-features .tbody-row:nth-child(odd)',
							),
						),
						'even_properties_bg'           => array(
							'type'        => 'color',
							'label'       => __( 'Even Rows Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'important' => true,
								'selector'  => '.uabb-table-features .tbody-row:nth-child(even)',
							),
						),
						'features_color'               => array(
							'type'        => 'color',
							'label'       => __( 'Rows Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.uabb-table-features .table-body-td, .uabb-table-features .table-body-td .td-style',
							),
						),
						'body_rows_text_hover'         => array(
							'type'        => 'color',
							'label'       => __( 'Row Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'body_rows_bg_hover'           => array(
							'type'        => 'color',
							'label'       => __( 'Row Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'body_cell_text_hover'         => array(
							'type'        => 'color',
							'label'       => __( 'Cell Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'body_cell_bg_hover'           => array(
							'type'        => 'color',
							'label'       => __( 'Cell Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'body_cell_padding'            => array(
							'type'    => 'unit',
							'label'   => __( 'Body Cells Padding', 'uabb' ),
							'default' => '15',
							'size'    => '8',
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
								'selector'  => '.uabb-table-inner-wrap .uabb-table-features .table-body-td',
								'property'  => 'padding',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'table_body_data_border_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Body Cells Border Size', 'uabb' ),
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
								'type'      => 'css',
								'selector'  => '.uabb-table-inner-wrap .uabb-table-features .table-body-td',
								'property'  => 'border-width',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'table_body_data_border_color' => array(
							'type'        => 'color',
							'label'       => __( 'Body Cells Border Color', 'uabb' ),
							'default'     => '000000',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-table-inner-wrap .uabb-table-features .table-body-td',
								'property'  => 'border-color',
								'important' => true,
							),
						),
					),
				),
				'head_image_styles' => array(
					'title'  => __( 'Header Image Settings', 'uabb' ),
					'fields' => array(
						'head_icons_global_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icons Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.uabb-table-header .table-header-th .before-icon, .uabb-table-header .table-header-th .after-icon',
							),
						),
						'head_icons_gloabl_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Icons Size', 'uabb' ),
							'default' => '15',
							'size'    => '8',
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
								'selector'  => '.uabb-table-header .table-header-th .before-icon, .uabb-table-header .table-header-th .after-icon',
								'property'  => 'font-size',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'head_image_gloabl_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Image Size', 'uabb' ),
							'default' => '50',
							'size'    => '8',
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
								'selector'  => '.uabb-table-header .table-header-th .thead-img',
								'property'  => 'width',
								'important' => true,
								'unit'      => 'px',
							),
						),
					),
				),
				'body_image_styles' => array(
					'title'  => __( 'Body Image Settings', 'uabb' ),
					'fields' => array(
						'body_icons_global_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icons Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.uabb-table-features .table-body-td .before-icon, .uabb-table-features .table-body-td .after-icon',
							),
						),
						'body_icons_gloabl_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Icons Size', 'uabb' ),
							'default' => '15',
							'size'    => '8',
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
								'selector'  => '.uabb-table-features .table-body-td .before-icon, .uabb-table-features .table-body-td .after-icon',
								'property'  => 'font-size',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'body_image_gloabl_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Image Size', 'uabb' ),
							'default' => '50',
							'size'    => '8',
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
								'selector'  => '.uabb-table-features .table-body-td .body-content-img',
								'property'  => 'width',
								'important' => true,
								'unit'      => 'px',
							),
						),
					),
				),
				'features_styles'   => array(
					'title'  => __( 'Entries Dropdown & Search Field', 'uabb' ),
					'fields' => array(
						'entries_label_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Label Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.entries-wrapper .lbl-entries',
							),
						),
						'entries_input_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Input Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.select-filter, .search-wrapper .search-input::placeholder',
							),
						),
						'entries_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Input Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'background',
								'important' => true,
								'selector'  => '.select-filter, .search-input',
							),
						),
						'entries_border_size'      => array(
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
								'type'      => 'css',
								'selector'  => '.select-filter, .search-input',
								'property'  => 'border-width',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'entries_border_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.select-filter, .search-input',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'entries_input_padding'    => array(
							'type'    => 'unit',
							'label'   => __( 'Input Padding', 'uabb' ),
							'default' => '10',
							'size'    => '8',
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
								'selector'  => '.select-filter, .search-input',
								'property'  => 'padding',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'entries_input_size'       => array(
							'type'    => 'unit',
							'label'   => __( 'Input Size', 'uabb' ),
							'size'    => '8',
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
								'selector'  => '.select-filter, .search-input',
								'property'  => 'width',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'entries_bottom_space'     => array(
							'type'    => 'unit',
							'label'   => __( 'Bottom Space', 'uabb' ),
							'size'    => '8',
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
								'selector'  => '.table-data',
								'property'  => 'margin-bottom',
								'important' => true,
								'unit'      => 'px',
							),
						),
					),
				),
			),
		),
		'all_typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'heading_typography' => array(
					'title'  => __( 'Headings', 'uabb' ),
					'fields' => array(
						'heading_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-table-wrapper .table-header-th',
								'imortant' => true,
							),
						),
					),
				),
				'content_typography' => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'content_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-table-wrapper .table-body-td',
								'important' => true,
							),
						),
					),
				),
				'filter_typography'  => array(
					'title'  => __( 'Entries Dropdown & Search Field', 'uabb' ),
					'fields' => array(
						'filter_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.entries-wrapper .lbl-entries, .entries-wrapper .select-filter, .search-input',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'      => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/table-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> Getting started article </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-add-table-content/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How to add Table Content? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/add-rows-and-columns-to-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How To Add Rows And Columns to the Table? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-merge-columns-and-rows-in-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How to Merge Columns and Rows in Table? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-style-the-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How to Style the Table? </a> </li>
								
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/override-global-settings-for-image-icon/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How to Override Global Settings for Image / Icon? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/create-table-by-uploading-csv/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> Create a Table by uploading CSV file click Here to read article for more. </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/facing-issues-with-csv-import/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> Facing issue with CSV importer? Please read this article for troubleshooting steps. </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/table-sortable-searchable-entry-dropdown/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> How to add Sortable and Searchable Table? How to Show Entries Dropdown? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'thead_row_form', array(
		'title' => __( 'Heading Cell', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'title'              => array(
						'title'  => __( 'Edit Heading Cell', 'uabb' ),
						'fields' => array(
							'head_action'       => array(
								'type'    => 'select',
								'label'   => __( 'Choose Action', 'uabb' ),
								'default' => 'row',
								'options' => array(
									'row'  => __( 'New Row', 'uabb' ),
									'cell' => __( 'New Cell', 'uabb' ),
								),
							),
							'heading'           => array(
								'type'        => 'text',
								'label'       => __( 'Content', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'head_advanced_opt' => array(
								'type'    => 'select',
								'label'   => __( 'Advanced Options', 'uabb' ),
								'default' => 'no',
								'help'    => __( 'Enable the Advanced options for additional styling, image / icon options, column and row spans etc.', 'uabb' ),
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'sections' => array( 'head_color_setting', 'col_span_setting', 'row_span_setting', 'head_icon_basic', 'head_link_basic', 'custom_col_width' ),
									),
								),
							),
						),
					),
					'head_color_setting' => array(
						'title'  => __( 'Styling', 'uabb' ),
						'fields' => array(
							'head_text_color' => array(
								'type'        => 'color',
								'label'       => __( 'Text Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'head_bg_color'   => array(
								'type'        => 'color',
								'label'       => __( 'Text Background Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
						),
					),
					'row_span_setting'   => array(
						'title'  => __( 'Row Span', 'uabb' ),
						'fields' => array(
							'head_row_span' => array(
								'type'        => 'unit',
								'label'       => __( 'Rowspan', 'uabb' ),
								'placeholder' => '1',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'description' => UABBTable::get_description( 'head_row_span' ),
							),
						),
					),
					'col_span_setting'   => array(
						'title'  => __( 'Column Span', 'uabb' ),
						'fields' => array(
							'head_col_span' => array(
								'type'        => 'unit',
								'label'       => __( 'Colspan', 'uabb' ),
								'placeholder' => '1',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'description' => UABBTable::get_description( 'head_col_span' ),
							),
						),
					),
					'custom_col_width'   => array(
						'title'  => __( 'Custom Column Width', 'uabb' ),
						'fields' => array(
							'custom_header_col_width' => array(
								'type'        => 'unit',
								'label'       => __( 'Enter Width (in px)', 'uabb' ),
								'size'        => '8',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'description' => UABBTable::get_description( 'custom_header_col_width' ),
							),
						),
					),
					'head_icon_basic'    => array(
						'title'  => __( 'Icon / Image', 'uabb' ),
						'fields' => array(
							'head_icon_type'       => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'  => __( 'None', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'fields' => array( 'head_icon', 'head_icon_img_width', 'head_icon_color', 'head_icon_position' ),
									),
									'photo' => array(
										'fields' => array( 'head_photo', 'head_photo_img_width', 'head_icon_position' ),
									),
								),
							),
							'head_icon'            => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'head_icon_img_width'  => array(
								'type'        => 'unit',
								'label'       => __( 'Icon Size', 'uabb' ),
								'placeholder' => '15',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'size'        => '8',
							),
							'head_icon_color'      => array(
								'type'        => 'color',
								'label'       => __( 'Icon Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'head_photo'           => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
							),
							'head_photo_img_width' => array(
								'type'        => 'unit',
								'label'       => __( 'Photo Width', 'uabb' ),
								'placeholder' => '50',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'size'        => '8',
							),
							'head_icon_position'   => array(
								'type'    => 'select',
								'label'   => __( 'Image Position', 'uabb' ),
								'default' => 'before',
								'options' => array(
									'before' => __( 'Before Text', 'uabb' ),
									'after'  => __( 'After Text', 'uabb' ),
								),
							),
						),
					),
					'head_link_basic'    => array(
						'title'  => __( 'Link', 'uabb' ),
						'fields' => array(
							'head_link' => array(
								'type'          => 'link',
								'show_target'   => true,
								'show_nofollow' => true,
								'label'         => __( 'Link', 'uabb' ),
								'placeholder'   => 'https://www.example.com',
								'preview'       => array(
									'type' => 'none',
								),
								'connections'   => array( 'url' ),
							),
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'tbody_row_form', array(
		'title' => __( 'Body Row / Cell', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'features'              => array(
						'title'  => __( 'Edit Body Row / Cell', 'uabb' ),
						'fields' => array(
							'action'            => array(
								'type'    => 'select',
								'label'   => __( 'Choose Action', 'uabb' ),
								'default' => 'row',
								'options' => array(
									'row'  => __( 'New Row', 'uabb' ),
									'cell' => __( 'New Cell', 'uabb' ),
								),
							),
							'features'          => array(
								'type'        => 'text',
								'label'       => __( 'Content', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'body_advanced_opt' => array(
								'type'    => 'select',
								'label'   => __( 'Advanced Options', 'uabb' ),
								'default' => 'no',
								'help'    => __( 'Enable the Advanced options for additional styling, image / icon options, column and row spans etc.', 'uabb' ),
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'sections' => array( 'body_color_setting', 'body_row_span_setting', 'body_col_span_setting', 'body_icon_basic', 'body_link_basic' ),
									),
									'no'  => array(),
								),
							),
						),
					),
					'body_color_setting'    => array(
						'title'  => __( 'Styling', 'uabb' ),
						'fields' => array(
							'body_text_color' => array(
								'type'        => 'color',
								'label'       => __( 'Text Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'body_bg_color'   => array(
								'type'        => 'color',
								'label'       => __( 'Text Background Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
						),
					),
					'body_row_span_setting' => array(
						'title'  => __( 'Row Span', 'uabb' ),
						'fields' => array(
							'body_row_span' => array(
								'type'        => 'unit',
								'label'       => __( 'Rowspan', 'uabb' ),
								'placeholder' => '1',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'description' => UABBTable::get_description( 'body_row_span' ),
							),
						),
					),
					'body_col_span_setting' => array(
						'title'  => __( 'Column Span', 'uabb' ),
						'fields' => array(
							'body_col_span' => array(
								'type'        => 'unit',
								'label'       => __( 'Colspan', 'uabb' ),
								'placeholder' => '1',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'description' => UABBTable::get_description( 'body_col_span' ),
							),
						),
					),
					'body_icon_basic'       => array(
						'title'  => __( 'Icon / Image', 'uabb' ),
						'fields' => array(
							'body_icon_type'       => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'  => __( 'None', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'fields' => array( 'body_icon', 'body_icon_img_width', 'body_icon_color', 'body_icon_position' ),
									),
									'photo' => array(
										'fields' => array( 'body_photo', 'body_photo_img_width', 'body_icon_position' ),
									),
								),
							),
							'body_icon'            => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'body_icon_img_width'  => array(
								'type'        => 'unit',
								'label'       => __( 'Icon Size', 'uabb' ),
								'placeholder' => '15',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'size'        => '8',
							),
							'body_icon_color'      => array(
								'type'        => 'color',
								'label'       => __( 'Icon Color', 'uabb' ),
								'show_reset'  => true,
								'show_alpha'  => true,
								'connections' => array( 'color' ),
							),
							'body_photo'           => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
							),
							'body_photo_img_width' => array(
								'type'        => 'unit',
								'label'       => __( 'Photo Width', 'uabb' ),
								'placeholder' => '50',
								'units'       => array( 'px' ),
								'slider'      => array(
									'px' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'size'        => '8',
							),
							'body_icon_position'   => array(
								'type'    => 'select',
								'label'   => __( 'Image Position', 'uabb' ),
								'default' => 'before',
								'options' => array(
									'before' => __( 'Before Text', 'uabb' ),
									'after'  => __( 'After Text', 'uabb' ),
								),
							),
						),
					),
					'body_link_basic'       => array(
						'title'  => __( 'Link', 'uabb' ),
						'fields' => array(
							'body_link' => array(
								'type'          => 'link',
								'show_target'   => true,
								'show_nofollow' => true,
								'label'         => __( 'Link', 'uabb' ),
								'placeholder'   => 'https://www.example.com',
								'preview'       => array(
									'type' => 'none',
								),
								'connections'   => array( 'url' ),
							),
						),
					),
				),
			),
		),
	)
);
