<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package Photo Gallery Module
 */

FLBuilder::register_module(
	'UABBPhotoGalleryModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'             => array(
					'title'  => '',
					'fields' => array(
						'layout'        => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'collage',
							'options' => array(
								'grid'     => __( 'Grid', 'uabb' ),
								'masonary' => __( 'Masonry', 'uabb' ),
							),
						),
						'photos'        => array(
							'type'        => 'multiple-photos',
							'label'       => __( 'Photos', 'uabb' ),
							'connections' => array( 'multiple-photos' ),
						),
						'photo_size'    => array(
							'type'    => 'select',
							'label'   => __( 'Photo Size', 'uabb' ),
							'default' => 'medium',
							'options' => apply_filters(
								'uabb_photo_gallery_image_sizes',
								array(
									'thumbnail' => __( 'Thumbnail', 'uabb' ),
									'medium'    => __( 'Medium', 'uabb' ),
									'full'      => __( 'Full', 'uabb' ),
								)
							),
						),
						'photo_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Photo Spacing', 'uabb' ),
							'mode'        => 'padding',
							'placeholder' => '20',
							'size'        => '5',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'photo_order'   => array(
							'type'    => 'select',
							'label'   => __( 'Display Order', 'uabb' ),
							'default' => 'normal',
							'options' => array(
								'normal' => __( 'Normal', 'uabb' ),
								'random' => __( 'Random', 'uabb' ),
							),
							'toggle'  => array(
								'grid'     => array(
									'fields' => array(),
								),
								'masonary' => array(
									'fields' => array(),
								),
							),
						),
					),
				),
				'column_settings'     => array(
					'title'  => __( 'Number of Photos to Show', 'uabb' ),
					'fields' => array(
						'grid_column'            => array(
							'type'    => 'select',
							'label'   => __( 'Desktop Grid', 'uabb' ),
							'default' => '4',
							'help'    => __( 'This is how many images you want to show at one time on desktop.', 'uabb' ),
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
						),
						'medium_grid_column'     => array(
							'type'    => 'select',
							'label'   => __( 'Medium Device Grid', 'uabb' ),
							'default' => '4',
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
							'help'    => __( 'This is how many images you want to show at one time on tablet devices.', 'uabb' ),
						),
						'responsive_grid_column' => array(
							'type'    => 'select',
							'label'   => __( 'Small Device Grid', 'uabb' ),
							'default' => '4',
							'options' => array(
								'1'  => __( '1 Column', 'uabb' ),
								'2'  => __( '2 Columns', 'uabb' ),
								'3'  => __( '3 Columns', 'uabb' ),
								'4'  => __( '4 Columns', 'uabb' ),
								'5'  => __( '5 Columns', 'uabb' ),
								'6'  => __( '6 Columns', 'uabb' ),
								'7'  => __( '7 Columns', 'uabb' ),
								'8'  => __( '8 Columns', 'uabb' ),
								'9'  => __( '9 Columns', 'uabb' ),
								'10' => __( '10 Columns', 'uabb' ),
							),
							'help'    => __( 'This is how many images you want to show at one time on mobile devices.', 'uabb' ),
						),
					),
				),
				'photo_settings'      => array(
					'title'  => __( 'Photo Settings', 'uabb' ),
					'fields' => array(
						'show_captions'       => array(
							'type'    => 'select',
							'label'   => __( 'Show Captions', 'uabb' ),
							'default' => 'hover',
							'options' => array(
								'0'     => __( 'Never', 'uabb' ),
								'hover' => __( 'On Hover', 'uabb' ),
								'below' => __( 'Below Photo', 'uabb' ),
							),
							'help'    => __( 'The caption pulls from whatever text you put in the caption area in the media manager for each image.', 'uabb' ),
							'toggle'  => array(
								'hover' => array(
									'tabs' => array( 'typography' ),
								),
								'below' => array(
									'tabs'   => array( 'typography' ),
									'fields' => array( 'caption_bg_color', 'caption_bg_color_opc' ),
								),
							),
						),
						'click_action'        => array(
							'type'    => 'select',
							'label'   => __( 'Click Action', 'uabb' ),
							'default' => 'lightbox',
							'options' => array(
								'none'     => _x( 'None', 'Click action.', 'uabb' ),
								'lightbox' => __( 'Lightbox', 'uabb' ),
								'link'     => __( 'Photo Link', 'uabb' ),
								'cta-link' => __( 'Custom Link', 'uabb' ),
							),
							'toggle'  => array(
								'link'     => array(
									'fields' => array( 'click_action_target' ),
								),
								'cta-link' => array(
									'fields' => array( 'click_action_target' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'click_action_target' => array(
							'type'    => 'select',
							'label'   => __( 'Link Target', 'uabb' ),
							'help'    => __( 'Controls where CTA link will open after click.', 'uabb' ),
							'default' => '_blank',
							'options' => array(
								'_self'  => __( 'Same Window', 'uabb' ),
								'_blank' => __( 'New Window', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'filterable_settings' => array(
					'title'  => __( 'Filterable Photo Gallery', 'uabb' ),
					'fields' => array(
						'filterable_gallery_enable' => array(
							'type'    => 'select',
							'label'   => __( 'Filterable Photo Gallery', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Enable', 'uabb' ),
								'no'  => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'filters_all_text', 'default_filter_switch', 'show_filter_title' ),
									'sections' => array( 'section_style_cat_filters', 'section_typography_cat_filters' ),
								),
							),
						),
						'filters_all_text'          => array(
							'type'        => 'text',
							'label'       => __( '"All" Tab Label', 'uabb' ),
							'default'     => 'All',
							'connections' => array( 'string', 'html' ),
						),
						'default_filter_switch'     => array(
							'type'    => 'select',
							'label'   => __( 'Default Tab on Page Load', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'First', 'uabb' ),
								'yes' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'default_filter' ),
								),
							),
						),
						'default_filter'            => array(
							'type'        => 'text',
							'label'       => __( 'Enter Default Category Name', 'uabb' ),
							'help'        => __( 'Enter the category name that you wish to set as a default on page load.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'show_filter_title'         => array(
							'type'    => 'select',
							'label'   => __( 'Title for Filterable Tabs', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Enable', 'uabb' ),
								'no'  => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'filters_heading_text' ),
									'sections' => array( 'section_title_typography', 'section_style_title_filters' ),
								),
								'no'  => array(
									'fields' => array( 'cat_filter_align' ),
								),
							),
						),
						'filters_heading_text'      => array(
							'type'        => 'text',
							'label'       => __( 'Title Text', 'uabb' ),
							'default'     => __( 'My photos', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'general'                     => array(
					'title'  => '',
					'fields' => array(
						'hover_effects' => array(
							'type'    => 'select',
							'label'   => __( 'Image Hover Effect', 'uabb' ),
							'default' => 'zoom-in',
							'options' => array(
								'none'        => __( 'None', 'uabb' ),
								'from-left'   => __( 'Overlay From Left', 'uabb' ),
								'from-right'  => __( 'Overlay From Right', 'uabb' ),
								'from-top'    => __( 'Overlay From Top', 'uabb' ),
								'from-bottom' => __( 'Overlay From Bottom', 'uabb' ),
								'zoom-in'     => __( 'Zoom In', 'uabb' ),
								'zoom-out'    => __( 'Zoom Out', 'uabb' ),
							),
							'toggle'  => array(
								'from-left'   => array(
									'sections' => array( 'overlay' ),
								),
								'from-right'  => array(
									'sections' => array( 'overlay' ),
								),
								'from-top'    => array(
									'sections' => array( 'overlay' ),
								),
								'from-bottom' => array(
									'sections' => array( 'overlay' ),
								),
								'zoom-in'     => array(
									'sections' => array( 'overlay' ),
								),
								'zoom-out'    => array(
									'sections' => array( 'overlay' ),
								),
							),
							'preview' => 'none',
						),
					),
				),
				'overlay'                     => array(
					'title'  => __( 'Overlay', 'uabb' ),
					'fields' => array(
						'overlay_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'default'     => '000000',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'icon'               => array(
							'type'    => 'select',
							'label'   => __( 'Overlay Icon', 'uabb' ),
							'default' => '0',
							'options' => array(
								'1' => __( 'Enable', 'uabb' ),
								'0' => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'1' => array(
									'fields' => array( 'overlay_icon', 'overlay_icon_size', 'overlay_icon_color' ),
								),
							),
							'preview' => 'none',
						),
						'overlay_icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Overlay Icon', 'uabb' ),
							'preview'     => 'none',
							'show_remove' => true,
						),
						'overlay_icon_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Overlay Icon Size', 'uabb' ),
							'placeholder' => '16',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => array( 'px' ),
							'preview'     => 'none',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'overlay_icon_color' => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Icon Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => 'none',
						),
					),
				),
				'section_style_cat_filters'   => array(
					'title'  => __( 'Filterable Tabs', 'uabb' ),
					'fields' => array(
						'cat_filter_align'              => array(
							'type'    => 'align',
							'label'   => __( 'Tab Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filters',
								'property' => 'text-align',
							),
						),
						'cat_filter_padding'            => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'cat_filter_bet_spacing'        => array(
							'type'       => 'unit',
							'label'      => __( 'Spacing Between Tabs', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),

						),
						'cat_filter_spacing'            => array(
							'type'       => 'unit',
							'label'      => __( 'Tabs Bottom Spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filters',
								'property' => 'margin-bottom',
							),
						),
						'cat_filter_color'              => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'show_alpha'  => 'true',
							'connections' => array( 'color' ),
							'show_reset'  => 'true',
							'default'     => '',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter',
								'property' => 'color',
							),
						),
						'cat_filter_hover_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Text Active / Hover', 'uabb' ),
							'show_reset'  => 'true',
							'connections' => array( 'color' ),
							'show_alpha'  => 'true',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter.uabb-filter__current',
								'property' => 'color',
							),
						),
						'cat_filter_bg_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => 'true',
							'connections' => array( 'color' ),
							'default'     => '',
							'show_alpha'  => 'true',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter',
								'property' => 'background',
							),
						),
						'cat_filter_bg_hover_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Background Active / Hover Color', 'uabb' ),
							'show_reset'  => 'true',
							'connections' => array( 'color' ),
							'show_alpha'  => 'true',
							'default'     => '00b524',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter.uabb-filter__current',
								'property' => 'background-color',
							),
						),
						'cat_filter_border'             => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter',
							),
						),
						'cat_filter_border_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Active / Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_resset' => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo__gallery-filter.uabb-filter__current',
								'property' => 'border-color',
							),
						),
					),
				),
				'section_style_title_filters' => array(
					'title'  => __( 'Title for Filterable Tabs settings', 'uabb' ),
					'fields' => array(
						'filter_title_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Title Color', 'uabb' ),
							'show_alpha'  => 'true',
							'show_resset' => 'true',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-photo-gallery-title-text',
								'property' => 'color',
							),
						),
						'filters_tab_heading_stack' => array(
							'type'    => 'select',
							'label'   => __( 'Stack On', 'uabb' ),
							'default' => 'mobile',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'tablet' => __( 'Tablet', 'uabb' ),
								'mobile' => __( 'Mobile', 'uabb' ),
							),
							'help'    => __( 'Choose at what breakpoint the Title & Filter Tabs will stack.', 'uabb' ),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'typography'                     => array(
					'title'  => __( 'Caption', 'uabb' ),
					'fields' => array(
						'tag_selection'     => array(
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
						'caption_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo-gallery-caption',
								'important' => true,
							),
						),
						'color'             => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo-gallery-caption',
								'property'  => 'color',
								'important' => true,
							),
						),
						'caption_bg_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo-gallery-caption',
								'property'  => 'background',
								'important' => true,
							),
						),
					),
				),
				'section_typography_cat_filters' => array(
					'title'  => __( 'Filterable Tabs', 'uabb' ),
					'fields' => array(
						'cat_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo__gallery-filter',
								'important' => true,
							),
						),
					),
				),
				'section_title_typography'       => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'filter_title_tag' => array(
							'type'    => 'select',
							'label'   => __( 'HTML Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
								'h1'  => __( 'H1', 'uabb' ),
								'h2'  => __( 'H2', 'uabb' ),
								'h3'  => __( 'H3', 'uabb' ),
								'h4'  => __( 'H4', 'uabb' ),
								'h5'  => __( 'H5', 'uabb' ),
								'h6'  => __( 'H6', 'uabb' ),
								'div' => __( 'div', 'uabb' ),
								'p'   => __( 'p', 'uabb' ),
							),
						),
						'filter_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-photo-gallery-title-text',
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
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/add-custom-links-photo-gallery-images/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=photo-gallery-module" target="_blank" rel="noopener"> How to Add Custom Links to Photo Gallery images? </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/filterable-photo-gallery-with-uabb/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=photo-gallery-module" target="_blank" rel="noopener"> Design Filterable Photo Gallery with UABB </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/set-categories-for-images/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=photo-gallery-module" target="_blank" rel="noopener"> How to Set Categories for Images? </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/custom-filterable-tab-on-page-load/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=photo-gallery-module" target="_blank" rel="noopener"> How to Display Specific Filterable Tab as a Default on Page Load? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
