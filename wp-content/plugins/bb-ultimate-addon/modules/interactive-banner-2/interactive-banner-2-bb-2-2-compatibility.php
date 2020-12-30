<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Interactive Banner 2 Module
 */

FLBuilder::register_module(
	'InteractiveBanner2Module',
	array(
		'style'       => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => __( 'Banner Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_style'           => array(
							'type'    => 'select',
							'label'   => __( 'Banner Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select appear effect for description text.', 'uabb' ),
							'options' => array(
								'style1'  => __( 'Style 1', 'uabb' ),
								'style2'  => __( 'Style 2', 'uabb' ),
								'style4'  => __( 'Style 3', 'uabb' ),
								'style5'  => __( 'Style 4', 'uabb' ),
								'style7'  => __( 'Style 5', 'uabb' ),
								'style8'  => __( 'Style 6', 'uabb' ),
								'style9'  => __( 'Style 7', 'uabb' ),
								'style10' => __( 'Style 8', 'uabb' ),
								'style11' => __( 'Style 9', 'uabb' ),
								'style13' => __( 'Style 10', 'uabb' ),
								'style14' => __( 'Style 11', 'uabb' ),
							),
							'toggle'  => array(
								'style5' => array(
									'fields' => array( 'title_background_color' ),
								),
							),
						),
						'title_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Title Background Color', 'uabb' ),
							'default'     => 'fafafa',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'banner_image'           => array(
							'type'        => 'photo',
							'label'       => __( 'Banner Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'banner_height'          => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Banner Height', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'help'    => __( 'How big would you like it?', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-new-ib',
								'property'  => 'height',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'img_overlay_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Image Overlay Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => '',
							'show_reset'  => true,
							'help'        => __( 'Use this color setting if you have a bright image and your text is not readable.', 'uabb' ),
						),
						'img_background_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Image Hover Overlay Color', 'uabb' ),
							'default'     => 'cccccc',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
					),
				),
				'link'    => array( // Section.
					'title'  => __( 'Link', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'link_url' => array(
							'type'          => 'link',
							'show_target'   => true,
							'show_nofollow' => true,
							'label'         => __( 'Link URL', 'uabb' ),
							'placeholder'   => __( 'URL', 'uabb' ),
							'connections'   => array( 'url' ),
						),
					),
				),
			),
		),
		'title'       => array( // Tab.
			'title'    => __( 'Title', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'          => array( // Section.
					'title'  => __( 'Title', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_title' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Interactive Banner 2', 'uabb' ),
							'preview'     => array(
								'type'      => 'text',
								'selector'  => '.uabb-new-ib-title',
								'important' => true,
							),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'title_typography' => array(
					'title'  => __( 'Title Typography', 'uabb' ),
					'fields' => array(
						'title_typography_tag_selection' => array(
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
						'title_font_typo'                => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-new-ib-title',
								'important' => true,
							),
						),
						'title_typography_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => '.uabb-new-ib-title',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'description' => array( // Tab.
			'title'    => __( 'Description', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'description'     => array( // Section.
					'title'  => __( 'Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_desc' => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => __( 'Description', 'uabb' ),
							'default'       => __( 'Enter description text here.', 'uabb' ),
							'preview'       => array(
								'type'      => 'text',
								'selector'  => '.uabb-new-ib-content',
								'important' => true,
							),
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
				'desc_typography' => array(
					'title'  => __( 'Description Typography', 'uabb' ),
					'fields' => array(
						'desc_font_typo'        => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-new-ib-content',
								'important' => true,
							),
						),
						'desc_typography_color' => array(
							'type'        => 'color',
							'label'       => __( 'Description Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-new-ib-content',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
