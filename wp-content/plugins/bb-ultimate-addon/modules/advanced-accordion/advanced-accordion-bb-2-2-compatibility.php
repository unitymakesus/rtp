<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Advanced Accordion
 */

FLBuilder::register_module(
	'UABBAdvancedAccordionModule', array(
		'items'             => array(
			'title'    => __( 'Items', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'acc_items' => array(
							'type'         => 'form',
							'label'        => __( 'Item', 'uabb' ),
							'form'         => 'uabb_advAccordion_items_form', // ID from registered form below.
							'preview_text' => 'acc_title', // Name of a field to use for the preview text.
							'multiple'     => true,
						),
					),
				),
			),
		),
		'acc_setting'       => array(
			'title'    => __( 'Settings', 'uabb' ),
			'sections' => array(
				'panel' => array(
					'title'  => '',
					'fields' => array(
						'collapse'     => array(
							'type'    => 'select',
							'label'   => __( 'Inactive Other Items', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
						'enable_first' => array(
							'type'    => 'select',
							'label'   => __( 'Expand First Item', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'help'    => __( 'Choosing yes will expand the first item by default.', 'uabb' ),
						),
					),
				),
			),
		),
		'acc_title_style'   => array(
			'title'    => __( 'Title', 'uabb' ),
			'sections' => array(
				'title_style'  => array(
					'title'  => __( 'Title Style', 'uabb' ),
					'fields' => array(
						'title_spacing_dimension'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							), // Optional.
							'responsive' => array(
								'placeholder' => array(
									'default'    => '15',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'title_margin'             => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing Between Titles', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '2',
							'size'        => '6',
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
								'selector' => '.uabb-adv-accordion-item',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
						'title_color'              => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button-label',
								'property' => 'color',
							),
						),
						'title_hover_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button-label',
								'property' => 'color',
							),
						),
						'title_bg_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f6f6f6',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
								'property' => 'background',
							),
						),
						'title_bg_color_opc'       => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'maxlength' => '3',
							'size'      => '5',
						),
						'title_bg_hover_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover/Focus Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button',
								'property' => 'background',
							),
						),
						'title_bg_hover_color_opc' => array(
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
					),
				),
				'title_border' => array(
					'title'  => __( 'Title Border', 'uabb' ),
					'fields' => array(
						'title_border_param' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'none',
								'color' => '',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button',
							),
						),
					),
				),
				'title_icon'   => array(
					'title'  => __( 'Title Icon', 'uabb' ),
					'fields' => array(
						'close_icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Close Icon', 'uabb' ),
							'default'     => 'fas fa-plus',
							'show_remove' => true,
						),
						'open_icon'        => array(
							'type'        => 'icon',
							'label'       => __( 'Open Icon', 'uabb' ),
							'default'     => 'fas fa-minus',
							'show_remove' => true,
						),
						'icon_size'        => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '16',
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '5',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button-icon',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'icon_position'    => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
						'icon_animation'   => array(
							'type'    => 'select',
							'label'   => __( 'Icon Animation', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'            => __( 'None', 'uabb' ),
								'push-out-top'    => __( 'Push Out from Top', 'uabb' ),
								'push-out-right'  => __( 'Push Out from Right', 'uabb' ),
								'push-out-bottom' => __( 'Push Out from Bottom', 'uabb' ),
								'push-out-left'   => __( 'Push Out from Left', 'uabb' ),
							),
						),
						'icon_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-button-icon',
								'property' => 'color',
							),
						),
						'icon_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover/Focus Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-item-active .uabb-adv-accordion-button-icon',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
		'acc_content_style' => array(
			'title'    => __( 'Content', 'uabb' ),
			'sections' => array(
				'content_style'   => array(
					'title'  => __( 'Content Style', 'uabb' ),
					'fields' => array(
						'content_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'responsive' => array(
								'placeholder' => array(
									'default'    => '20',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'content_color'             => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'color',
							),
						),
						'content_bg_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
								'property' => 'background',
							),
						),
						'content_bg_color_opc'      => array(
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
					),
				),
				'content-section' => array(
					'title'  => __( 'Content Border', 'uabb' ),
					'fields' => array(
						'content_border_param' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style' => 'none',
								'color' => '',
								'width' => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-adv-accordion-content',
							),
						),
					),
				),
			),
		),
		'acc_typography'    => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'title_typogrphy'   => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'tag_selection'   => array(
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
						'title_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-adv-accordion-button-label',
								'important' => true,
							),
						),
					),
				),
				'content_typogrphy' => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'content_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-adv-accordion-content',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'uabb_advAccordion_items_form', array(
		'title' => __( 'Add Item', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'general'      => array(
						'title'  => '',
						'fields' => array(
							'acc_title' => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'default'     => 'Nuper quisque evolvit praebebat turba hunc viseret foret vultus.',
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'content_type' => array(
						'title'  => __( 'Content', 'uabb' ),
						'fields' => array(
							'content_type'      => array(
								'type'    => 'select',
								'label'   => __( 'Type', 'uabb' ),
								'default' => 'content',
								'options' => array(
									'content'              => __( 'Content', 'uabb' ),
									'photo'                => __( 'Photo', 'uabb' ),
									'video'                => __( 'Video Embed Code', 'uabb' ),
									'saved_rows'           => array(
										'label'   => __( 'Saved Rows', 'uabb' ),
										'premium' => true,
									),
									'saved_modules'        => array(
										'label'   => __( 'Saved Modules', 'uabb' ),
										'premium' => true,
									),
									'saved_page_templates' => array(
										'label'   => __( 'Saved Page Templates', 'uabb' ),
										'premium' => true,
									),
								),
								'toggle'  => array(
									'content'              => array(
										'fields' => array( 'ct_content' ),
									),
									'photo'                => array(
										'fields' => array( 'ct_photo' ),
									),
									'video'                => array(
										'fields' => array( 'ct_video' ),
									),
									'saved_rows'           => array(
										'fields' => array( 'ct_saved_rows' ),
									),
									'saved_modules'        => array(
										'fields' => array( 'ct_saved_modules' ),
									),
									'saved_page_templates' => array(
										'fields' => array( 'ct_page_templates' ),
									),
								),
							),
							'ct_content'        => array(
								'type'        => 'editor',
								'label'       => '',
								'default'     => '',
								'connections' => array( 'string', 'html' ),
							),
							'ct_photo'          => array(
								'type'        => 'photo',
								'label'       => __( 'Select Photo', 'uabb' ),
								'show_remove' => true,
							),
							'ct_video'          => array(
								'type'  => 'textarea',
								'label' => __( 'Embed Code / URL', 'uabb' ),
								'rows'  => 6,
							),
							'ct_saved_rows'     => array(
								'type'    => 'select',
								'label'   => __( 'Select Row', 'uabb' ),
								'options' => array(),
							),
							'ct_saved_modules'  => array(
								'type'    => 'select',
								'label'   => __( 'Select Module', 'uabb' ),
								'options' => array(),
							),
							'ct_page_templates' => array(
								'type'    => 'select',
								'label'   => __( 'Select Page Template', 'uabb' ),
								'options' => array(),
							),
						),
					),
				),
			),
		),
	)
);
