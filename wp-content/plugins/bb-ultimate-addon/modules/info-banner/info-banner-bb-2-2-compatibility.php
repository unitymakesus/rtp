<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Info Banner Module
 */

FLBuilder::register_module(
	'InfoBannerModule',
	array(
		'banner'     => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'     => array( // Section.
					'title'  => __( 'Info Banner', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_title' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Info Banner', 'uabb' ),
							'help'        => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-ultb3-title',
							),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'description' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'banner_desc' => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => __( 'Description', 'uabb' ),
							'default'       => '<p>' . __( 'Enter description text here.', 'uabb' ) . '</p>',
							'preview'       => array(
								'type'     => 'text',
								'selector' => '.uabb-ultb3-desc',
							),
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
				'styles'      => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'background_color'             => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f2f2f2',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-box',
								'property' => 'background',
							),
						),
						'banner_alignemnt'             => array(
							'type'    => 'select',
							'label'   => __( 'Information Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'uabb-ultb3-align-left'   => __( 'Left', 'uabb' ),
								'uabb-ultb3-align-center' => __( 'Center', 'uabb' ),
								'uabb-ultb3-align-right'  => __( 'Right', 'uabb' ),
							),
						),
						'min_height_switch'            => array(
							'type'    => 'select',
							'label'   => __( 'Minimum Height', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Default', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'min_height', 'vertical_align' ),
								),
							),
						),
						'min_height'                   => array(
							'type'        => 'unit',
							'label'       => __( 'Enter Height', 'uabb' ),
							'units'       => array( 'px' ),
							'maxlength'   => '4',
							'size'        => '5',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'placeholder' => 'auto',
							'help'        => __( 'Apply minimum height to complete Info Banner. It will useful when multiple Info Banner are in same row.', 'uabb' ),
						),
						'vertical_align'               => array(
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'middle',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'middle' => __( 'Middle', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'responsive_min_height_switch' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Minimum Height', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Default', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'responsive_min_height', 'responsive_vertical_align' ),
								),
							),
							'help'    => __( 'It will apply minimum height in mobile devices', 'uabb' ),
						),
						'responsive_min_height'        => array(
							'type'        => 'unit',
							'label'       => __( 'Enter Height', 'uabb' ),
							'units'       => array( 'px' ),
							'maxlength'   => '4',
							'size'        => '5',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'placeholder' => 'auto',
							'help'        => __( 'Apply minimum height to complete Info Banner. It will useful in mobile when multiple Info Banner are in same row.', 'uabb' ),
						),
						'responsive_vertical_align'    => array(
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'middle',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'middle' => __( 'Middle', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'image'      => array( // Tab.
			'title'    => __( 'Image', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'   => array( // Section.
					'title'  => __( 'Image', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_image'           => array(
							'type'        => 'photo',
							'label'       => __( 'Banner Image', 'uabb' ),
							'show_remove' => true,
							'help'        => __( 'The image that would be appear as Background. Make sure overlay color you\'ve chosen must be transparent, to work this setting.', 'uabb' ),
							'connections' => array( 'photo' ),
						),
						'banner_image_alignemnt' => array(
							'type'    => 'select',
							'label'   => __( 'Image Alignment', 'uabb' ),
							'default' => 'uabb-ultb3-img-center',
							'options' => array(
								'uabb-ultb3-img-top-left'  => __( 'Top Left', 'uabb' ),
								'uabb-ultb3-img-top-center' => __( 'Top Center', 'uabb' ),
								'uabb-ultb3-img-top-right' => __( 'Top Right', 'uabb' ),
								'uabb-ultb3-img-center-left' => __( 'Center Left', 'uabb' ),
								'uabb-ultb3-img-center'    => __( 'Center', 'uabb' ),
								'uabb-ultb3-img-center-right' => __( 'Center Right', 'uabb' ),
								'uabb-ultb3-img-bottom-left' => __( 'Bottom Left', 'uabb' ),
								'uabb-ultb3-img-bottom-center' => __( 'Bottom Center', 'uabb' ),
								'uabb-ultb3-img-bottom-right' => __( 'Bottom Right', 'uabb' ),
							),
						),
						'overlay_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'responsive_nature'      => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Nature', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Default', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'res_medium_width', 'res_small_width' ),
								),
							),
							'help'    => __( 'The breakpoints of Medium and Small device is decided form BB-Global Settings', 'uabb' ),
						),
						'res_medium_width'       => array(
							'type'        => 'unit',
							'label'       => __( 'Medium Device Width', 'uabb' ),
							'units'       => array( 'px' ),
							'maxlength'   => '4',
							'size'        => '5',
							'placeholder' => 'auto',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'res_small_width'        => array(
							'type'        => 'unit',
							'label'       => __( 'Small Device Width', 'uabb' ),
							'units'       => array( 'px' ),
							'maxlength'   => '4',
							'size'        => '5',
							'placeholder' => 'auto',
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
				'animation' => array( // Section.
					'title'  => __( 'Animation', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_image_effect' => array(
							'type'    => 'select',
							'label'   => __( 'Effect', 'uabb' ),
							'default' => '',
							'options' => array(
								''                    => __( 'No Effect', 'uabb' ),
								'uabb-ib-slide-up'    => __( 'Slide Up', 'uabb' ),
								'uabb-ib-slide-down'  => __( 'Slide Down', 'uabb' ),
								'uabb-ib-slide-left'  => __( 'Slide Left', 'uabb' ),
								'uabb-ib-slide-right' => __( 'Slide Right', 'uabb' ),
								'uabb-ib-zoom-in'     => __( 'Zoom In', 'uabb' ),
								'uabb-ib-zoom-out'    => __( 'Zoom Out', 'uabb' ),
								'uabb-ib-pan'         => __( 'Pan', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'cta'        => array(
			'title'    => __( 'Link', 'uabb' ),
			'sections' => array(
				'cta'           => array(
					'title'  => __( 'Call to Action', 'uabb' ),
					'fields' => array(
						'cta_type' => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => _x( 'None', 'Call to action.', 'uabb' ),
								'link'   => __( 'Text', 'uabb' ),
								'button' => __( 'Button', 'uabb' ),
								'module' => __( 'Link To Module', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(),
								'link'   => array(
									'fields'   => array( 'cta_text' ),
									'sections' => array( 'link', 'link_typography' ),
								),
								'button' => array(
									'sections' => array( 'btn-general', 'btn-icon', 'btn-link', 'btn-colors', 'btn-style', 'btn-structure', 'btn_typography' ),
								),
								'module' => array(
									'sections' => array( 'link' ),
								),

							),
						),
						'cta_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Read More', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-infobanner-cta-link',
							),
						),
					),
				),
				'btn-general'   => array( // Section.
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'btn_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Click Here', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-creative-button-text',
							),
						),
					),
				),
				'btn-link'      => array( // Section.
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'btn_link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'placeholder'   => 'http://www.example.com',
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'btn-style'     => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'btn_style'                      => array(
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
						'btn_border_size'                => array(
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
						'btn_threed_button_options'      => array(
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
						'btn_flat_button_options'        => array(
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
				'btn-icon'      => array( // Section.
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
				'btn-colors'    => array( // Section.
					'title'  => __( 'Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a, .uabb-creative-button-wrap span',
								'property' => 'color',
							),
						),
						'btn_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'btn_bg_hover_color'   => array(
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
						'hover_attribute'      => array(
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
				'btn-structure' => array(
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
					),
				),
				'link'          => array(
					'title'  => __( 'Link', 'uabb' ),
					'fields' => array(
						'link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'help'          => __( 'The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'uabb' ),
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title_typography' => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'tag_selection'       => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h3',
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
						'title_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ultb3-title',
								'important' => true,
							),
						),
						'color'               => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-title',
								'property' => 'color',
							),
						),
						'title_margin_top'    => array(
							'type'      => 'unit',
							'label'     => __( 'Margin Top', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '4',
							'size'      => '8',
							'default'   => '0',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-title',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'title_margin_bottom' => array(
							'type'      => 'unit',
							'label'     => __( 'Margin Bottom', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '4',
							'size'      => '8',
							'default'   => '0',
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-title',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
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
				'desc_typography'  => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ultb3-desc',
								'important' => true,
							),
						),
						'desc_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-desc',
								'property' => 'color',
							),
						),
						'desc_margin_top'    => array(
							'type'      => 'unit',
							'label'     => __( 'Margin Top', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '4',
							'size'      => '8',
							'default'   => '0',
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-desc',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'desc_margin_bottom' => array(
							'type'      => 'unit',
							'label'     => __( 'Margin Bottom', 'uabb' ),
							'units'     => array( 'px' ),
							'maxlength' => '4',
							'size'      => '8',
							'default'   => '0',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-ultb3-desc',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
						),
					),
				),
				'btn_typography'   => array(
					'title'  => __( 'Button', 'uabb' ),
					'fields' => array(
						'btn_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'a.uabb-button',
								'important' => true,
							),
						),
					),
				),
				'link_typography'  => array(
					'title'  => __( 'Link Text', 'uabb' ),
					'fields' => array(
						'link_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-infobanner-cta-link',
								'important' => true,
							),
						),
						'link_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Link Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-infobanner-cta-link',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
	)
);
