<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 *  @package UABB Hotspot Module
 */

FLBuilder::register_settings_form(
	'hotspot_coordinates_form', array(
		'title' => __( 'Markers', 'uabb' ),
		'tabs'  => array(
			'general'    => array(
				'title'    => __( 'Co-Ordinates', 'uabb' ),
				'sections' => array(
					'coordinates' => array(
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'co_ordinates' => array(
								'type'  => 'uabb-draggable',
								'label' => '',
							),
						),
					),
				),
			),
			'marker'     => array(
				'title'    => __( 'Marker', 'uabb' ),
				'sections' => array(
					'general'           => array(
						'title'  => __( 'Marker Type', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'hotspot_marker_type' => array(
								'type'    => 'select',
								'label'   => __( 'Marker Type', 'uabb' ),
								'default' => 'text',
								'options' => array(
									'text'  => __( 'Text', 'uabb' ),
									'photo' => __( 'Image', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
								),
								'toggle'  => array(
									'text'  => array(
										'sections' => array( 'marker' ),
									),
									'photo' => array(
										'sections' => array( 'img_basic', 'img_style', 'hotspot_animation' ),
									),
									'icon'  => array(
										'sections' => array( 'icon_basic', 'icon_style', 'icon_colors', 'hotspot_animation' ),
									),
								),
							),
						),
					),
					'marker'            => array(
						'title'  => __( 'Marker Text', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'marker_text' => array(
								'type'          => 'editor',
								'media_buttons' => false,
								'rows'          => 10,
								'label'         => __( 'Marker Text', 'uabb' ),
								'default'       => __( 'Marker', 'uabb' ),
								'connections'   => array( 'string', 'html' ),
							),
						),
					),
					'icon_basic'        => array( // Section.
						'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icon'      => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'icon_size' => array(
								'type'      => 'unit',
								'label'     => __( 'Size', 'uabb' ),
								'default'   => '30',
								'maxlength' => '5',
								'size'      => '6',
								'slider'    => true,
								'units'     => array( 'px' ),
							),
						),
					),
					'img_basic'         => array( // Section.
						'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'photo_source' => array(
								'type'    => 'select',
								'label'   => __( 'Photo Source', 'uabb' ),
								'default' => 'library',
								'options' => array(
									'library' => __( 'Media Library', 'uabb' ),
									'url'     => __( 'URL', 'uabb' ),
								),
							),
							'photo'        => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
							'photo_url'    => array(
								'type'        => 'text',
								'label'       => __( 'Photo URL', 'uabb' ),
								'placeholder' => 'http://www.example.com/my-photo.jpg',
							),
							'img_size'     => array(
								'type'    => 'unit',
								'label'   => __( 'Size', 'uabb' ),
								'slider'  => true,
								'units'   => array( 'px' ),
								'default' => '30',
							),
						),
					),
					'icon_style'        => array(
						'title'  => 'Style',
						'fields' => array(
							/* Icon Style */
							'icon_style'            => array(
								'type'    => 'select',
								'label'   => __( 'Icon Background Style', 'uabb' ),
								'default' => 'simple',
								'options' => array(
									'simple' => __( 'Simple', 'uabb' ),
									'circle' => __( 'Circle Background', 'uabb' ),
									'square' => __( 'Square Background', 'uabb' ),
									'custom' => __( 'Design your own', 'uabb' ),
								),
							),
							/* Icon Background SIze */
							'icon_bg_size'          => array(
								'type'        => 'unit',
								'label'       => __( 'Background Size', 'uabb' ),
								'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
								'placeholder' => '30',
								'slider'      => true,
								'units'       => array( 'px' ),
							),
							/* Border Style and Radius for Icon */
							'icon_border_style'     => array(
								'type'    => 'select',
								'label'   => __( 'Border Style', 'uabb' ),
								'default' => 'none',
								'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
								'options' => array(
									'none'   => __( 'None', 'uabb' ), // Removed args 'Border type.',.
									'solid'  => __( 'Solid', 'uabb' ), // Removed args 'Border type.',.
									'dashed' => __( 'Dashed', 'uabb' ), // Removed args 'Border type.',.
									'dotted' => __( 'Dotted', 'uabb' ), // Removed args 'Border type.',.
									'double' => __( 'Double', 'uabb' ), // Removed args 'Border type.',.
								),
								'toggle'  => array(
									'solid'  => array(
										'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
									),
									'dashed' => array(
										'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
									),
									'dotted' => array(
										'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
									),
									'double' => array(
										'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
									),
								),
							),
							'icon_border_width'     => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'slider'      => true,
								'units'       => array( 'px' ),
								'placeholder' => '1',
							),
							'icon_bg_border_radius' => array(
								'type'        => 'unit',
								'label'       => __( 'Border Radius', 'uabb' ),
								'slider'      => true,
								'units'       => array( 'px' ),
								'placeholder' => '20',
							),
						),
					),
					'img_style'         => array(
						'title'  => 'Style',
						'fields' => array(
							/* Image Style */
							'image_style'          => array(
								'type'    => 'select',
								'label'   => __( 'Image Style', 'uabb' ),
								'default' => 'simple',
								'help'    => __( 'Circle and Square style will crop your image in 1:1 ratio', 'uabb' ),
								'options' => array(
									'simple' => __( 'Simple', 'uabb' ),
									'circle' => __( 'Circle', 'uabb' ),
									'square' => __( 'Square', 'uabb' ),
									'custom' => __( 'Design your own', 'uabb' ),
								),
								'class'   => 'uabb-image-icon-style',
							),

							/* Image Background Size */
							'img_bg_size'          => array(
								'type'   => 'unit',
								'label'  => __( 'Background Size', 'uabb' ),
								'help'   => __( 'Spacing between Image edge & Background edge', 'uabb' ),
								'slider' => true,
								'units'  => array( 'px' ),
							),

							/* Border Style and Radius for Image */
							'img_border_style'     => array(
								'type'    => 'select',
								'label'   => __( 'Border Style', 'uabb' ),
								'default' => 'none',
								'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
								'options' => array(
									'none'   => __( 'None', 'uabb' ), // Removed args 'Border type.',.
									'solid'  => __( 'Solid', 'uabb' ), // Removed args 'Border type.',.
									'dashed' => __( 'Dashed', 'uabb' ), // Removed args 'Border type.',.
									'dotted' => __( 'Dotted', 'uabb' ), // Removed args 'Border type.',.
									'double' => __( 'Double', 'uabb' ), // Removed args 'Border type.',.
								),
								'toggle'  => array(
									'solid'  => array(
										'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
									),
									'dashed' => array(
										'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
									),
									'dotted' => array(
										'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
									),
									'double' => array(
										'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
									),
								),
							),
							'img_border_width'     => array(
								'type'        => 'unit',
								'label'       => __( 'Border Width', 'uabb' ),
								'slider'      => true,
								'units'       => array( 'px' ),
								'placeholder' => '1',
							),
							'img_bg_border_radius' => array(
								'type'        => 'unit',
								'label'       => __( 'Border Radius', 'uabb' ),
								'slider'      => true,
								'units'       => array( 'px' ),
								'placeholder' => '0',
							),
						),
					),
					'icon_colors'       => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.

							/* Style Options */
							'icon_color_preset'       => array(
								'type'    => 'select',
								'label'   => __( 'Icon Color Presets', 'uabb' ),
								'default' => 'preset1',
								'options' => array(
									'preset1' => __( 'Preset 1', 'uabb' ),
									'preset2' => __( 'Preset 2', 'uabb' ),
								),
								'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
							),
							/* Icon Color */
							'icon_color'              => array(
								'type'        => 'color',
								'label'       => __( 'Icon Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'icon_hover_color'        => array(
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

							/* Background Color Dependent on Icon Style **/
							'icon_bg_color'           => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'icon_bg_color_opc'       => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),
							'icon_bg_hover_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
								'preview'     => array(
									'type' => 'none',
								),
							),
							'icon_bg_hover_color_opc' => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),

							/* Border Color Dependent on Border Style for ICon */
							'icon_border_color'       => array(
								'type'        => 'color',
								'label'       => __( 'Border Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'icon_border_hover_color' => array(
								'type'        => 'color',
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),

							/* Gradient Color Option */
							'icon_three_d'            => array(
								'type'    => 'select',
								'label'   => __( 'Gradient', 'uabb' ),
								'default' => '0',
								'options' => array(
									'0' => __( 'No', 'uabb' ),
									'1' => __( 'Yes', 'uabb' ),
								),
							),
						),
					),
					'img_colors'        => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							/* Background Color Dependent on Icon Style **/
							'img_bg_color'           => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'img_bg_color_opc'       => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),
							'img_bg_hover_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
								'preview'     => array(
									'type' => 'none',
								),
							),
							'img_bg_hover_color_opc' => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),

							/* Border Color Dependent on Border Style for Image */
							'img_border_color'       => array(
								'type'        => 'color',
								'label'       => __( 'Border Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'img_border_hover_color' => array(
								'type'        => 'color',
								'label'       => __( 'Border Hover Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
						),
					),
					'hotspot_animation' => array(
						'title'  => __( 'Animation', 'uabb' ),
						'fields' => array(
							'show_animation'  => array(
								'type'    => 'select',
								'label'   => __( 'Show Animation', 'uabb' ),
								'default' => 'no',
								'help'    => __( 'If enabled this animation will be shown depending on Trigger selected in Action tab. Default will be on Hover', 'uabb' ),
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'animation_color' ),
									),
								),
							),
							'animation_color' => array(
								'type'        => 'color',
								'label'       => __( 'Animation Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
						),
					),
				),
			),
			'action'     => array(
				'title'    => __( 'Action', 'uabb' ),
				'sections' => array(
					'on_click_action' => array(
						'title'  => __( 'Action', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'on_click_action' => array(
								'type'    => 'select',
								'label'   => __( 'On Click Action', 'uabb' ),
								'default' => 'tooltip',
								'options' => array(
									'tooltip' => __( 'Tooltip', 'uabb' ),
									'link'    => __( 'Link', 'uabb' ),
								),
								'toggle'  => array(
									'tooltip' => array(
										'sections' => array( 'tooltip_content', 'tooltip_typography' ),
									),
									'link'    => array(
										'sections' => array( 'link_section' ),
									),
								),
							),
						),
					),
					'tooltip_content' => array(
						'title'  => __( 'Tooltip Content', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'tooltip_content'           => array(
								'type'          => 'editor',
								'media_buttons' => false,
								'rows'          => 10,
								'label'         => __( 'Tooltip Content', 'uabb' ),
								'default'       => __( 'This is a tooltip', 'uabb' ),
								'connections'   => array( 'string', 'html' ),
							),
							'tooltip_style'             => array(
								'type'    => 'select',
								'label'   => __( 'Tooltip Style', 'uabb' ),
								'default' => 'classic',
								'options' => array(
									'classic' => __( 'Classic', 'uabb' ),
									'curved'  => __( 'Curved', 'uabb' ),
									'round'   => __( 'Round', 'uabb' ),
								),
							),
							'tooltip_content_position'  => array(
								'type'    => 'select',
								'label'   => __( 'Tooltip Text Position', 'uabb' ),
								'default' => 'top',
								'options' => array(
									'top'    => __( 'Top', 'uabb' ),
									'bottom' => __( 'Bottom', 'uabb' ),
									'left'   => __( 'Left', 'uabb' ),
									'right'  => __( 'Right', 'uabb' ),
								),
							),
							'tooltip_trigger_on'        => array(
								'type'    => 'select',
								'label'   => __( 'Trigger On', 'uabb' ),
								'default' => 'hover',
								'options' => array(
									'hover' => __( 'Hover', 'uabb' ),
									'click' => __( 'Click', 'uabb' ),
								),
							),
							'tooltip_padding_dimension' => array(
								'type'       => 'dimension',
								'label'      => __( 'Tooltip Padding', 'uabb' ),
								'help'       => __( 'Manage the outside spacing of tooltip area.', 'uabb' ),
								'slider'     => true,
								'units'      => array( 'px' ),    // optional.
								'responsive' => array(
									'placeholder' => array(
										'default'    => '15',
										'medium'     => '',
										'responsive' => '',
									),
								),
							),
						),
					),
					'link_section'    => array(
						'title'  => __( 'Action Link', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'link'   => array(
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'placeholder' => 'http://www.example.com',
								'connections' => array( 'url' ),
							),
							'target' => array(
								'type'    => 'select',
								'label'   => __( 'Target', 'uabb' ),
								'default' => '',
								'options' => array(
									'_blank' => __( 'New Page', 'uabb' ),
									''       => __( 'Same Page', 'uabb' ),
								),
							),
						),
					),
				),
			),
			'typography' => array(
				'title'    => __( 'Typography', 'uabb' ),
				'sections' => array(
					'text_typography'    => array(
						'title'  => __( 'Marker Text', 'uabb' ),
						'fields' => array(
							'text_font_typo'               => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-hotspot-text, .uabb-hotspot-text *',
									'important' => true,
								),
							),
							'text_typography_color'        => array(
								'type'        => 'color',
								'label'       => __( 'Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'text_typography_active_color' => array(
								'type'        => 'color',
								'label'       => __( 'Hover/Active Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'text_typography_bg_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'text_typography_bg_color_opc' => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),
							'text_typography_bg_active_color' => array(
								'type'        => 'color',
								'label'       => __( 'Background Hover/Active Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'text_typography_bg_active_color_opc' => array(
								'type'    => 'text',
								'label'   => __( 'Opacity', 'uabb' ),
								'default' => '',
								'slider'  => true,
								'units'   => array( '%' ),
							),
						),
					),
					'tooltip_typography' => array(
						'title'  => __( 'Tooltip', 'uabb' ),
						'fields' => array(
							'tooltip_font_typo' => array(
								'type'       => 'typography',
								'label'      => __( 'Typography', 'uabb' ),
								'responsive' => true,
								'preview'    => array(
									'type'      => 'css',
									'selector'  => '.uabb-hotspot-tooltip-content, .uabb-hotspot-tooltip-content *',
									'important' => true,
								),
							),
							'tooltip_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Tooltip Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
								'show_alpha'  => true,
							),
							'tooltip_bg_color'  => array(
								'type'        => 'color',
								'label'       => __( 'Tooltip Background Color', 'uabb' ),
								'default'     => '',
								'connections' => array( 'color' ),
								'show_alpha'  => true,
								'show_reset'  => true,
							),
						),
					),
				),
			),
		),
	)
);

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBHotspot', array(
		'general'        => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'photo_source' => array(
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'uabb' ),
							'default' => 'library',
							'options' => array(
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'library' => array(
									'fields' => array( 'photo' ),
								),
								'url'     => array(
									'fields' => array( 'photo_url', 'caption' ),
								),
							),
						),
						'photo'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'photo_size'   => array(
							'type'    => 'unit',
							'label'   => __( 'Photo Size', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-hotspot-container',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'photo_url'    => array(
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
					),
				),

			),
		),
		'marker_section' => array( // Tab.
			'title'    => __( 'Marker', 'uabb' ), // Tab title.
			'sections' => array(
				'hotspot_markers' => array( // Section.
					'title'  => __( 'Marker', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'hotspot_marker' => array(
							'type'         => 'form',
							'form'         => 'hotspot_coordinates_form',
							'label'        => __( 'Markers', 'uabb' ),
							'preview_text' => 'hotspot_marker_type', // ID of a field to use for the preview.
							'multiple'     => true,
						),
					),
				),
			),
		),
	)
);
