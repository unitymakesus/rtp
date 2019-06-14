<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Interactive Banner 1 Module
 */

FLBuilder::register_module(
	'InteractiveBanner1Module', array(
		'general'    => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => __( 'Title', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_title' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Interactive Banner', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-ib1-title',
							),
						),
					),
				),
				'style'   => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Banner Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select appear effect for description text.', 'uabb' ),
							'options' => array(
								'style01' => __( 'Appear From Bottom', 'uabb' ),
								'style02' => __( 'Appear From Top', 'uabb' ),
								'style03' => __( 'Appear From Left', 'uabb' ),
								'style04' => __( 'Appear From Right', 'uabb' ),
								'style11' => __( 'Zoom In', 'uabb' ),
								'style12' => __( 'Zoom Out', 'uabb' ),
								'style13' => __( 'Zoom In-Out', 'uabb' ),
								'style21' => __( 'Jump From Left', 'uabb' ),
								'style22' => __( 'Jump From Right', 'uabb' ),
								'style31' => __( 'Pull From Bottom', 'uabb' ),
								'style32' => __( 'Pull From Top', 'uabb' ),
								'style33' => __( 'Pull From Left', 'uabb' ),
								'style34' => __( 'Pull From Right', 'uabb' ),
							),
						),
						'banner_image'             => array(
							'type'        => 'photo',
							'label'       => __( 'Banner Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'banner_height_options'    => array(
							'type'    => 'select',
							'label'   => __( 'Banner Height', 'uabb' ),
							'default' => 'default',
							'help'    => __( 'Control your banner height, by default - it depends on selected image size.', 'uabb' ),
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'banner_height', 'image_size_compatibility' ),
								),
							),
						),
						'banner_height'            => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Banner Height', 'uabb' ),
							'size'    => '8',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-ib1-block',
								'property'  => 'height',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'image_size_compatibility' => array(
							'type'    => 'select',
							'label'   => __( 'Image Responsive Compatibility', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'There might be responsive issues for certain image sizes. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'small'  => __( 'Small Devices', 'uabb' ),
								'medium' => __( 'Medium and Small Devices', 'uabb' ),
							),
						),
						'vertical_align'           => array(
							'type'    => 'select',
							'label'   => __( 'Vertical Center', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'hover'      => array( // Tab.
			'title'    => __( 'Hover', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'description' => array( // Section.
					'title'  => __( 'Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'banner_desc'              => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Enter description text here.', 'uabb' ),
							'preview'       => array(
								'type'     => 'text',
								'selector' => '.uabb-ib1-description',
							),
							'connections'   => array( 'string', 'html' ),
						),
						'overlay_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Background Overlay Color', 'uabb' ),
							'default'    => '808080',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-background',
								'property'  => 'background',
								'important' => true,
							),
						),
					),
				),
				'icon'        => array( // Section.
					'title'  => __( 'Icon Above Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'icon_color' => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'icon_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
					),
				),
				'link'        => array( // Section.
					'title'  => __( 'Call To Action Below Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'show_button' => array(
							'type'    => 'select',
							'label'   => __( 'CTA Link', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes'      => __( 'Button on Hover', 'uabb' ),
								'complete' => __( 'Complete Banner', 'uabb' ),
								'no'       => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'yes'      => array(
									'fields' => array( 'button' ),
								),
								'complete' => array(
									'fields' => array( 'cta_link', 'cta_link_target' ),
								),
							),
						),
						'button'      => array(
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						),
						'cta_link'    => array(
							'type'          => 'link',
							'default'       => '#',
							'label'         => __( 'Link', 'uabb' ),
							'help'          => __( 'The link applies to the entire module.', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'string', 'html' ),
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
								'selector'  => '.uabb-ib1-title',
								'important' => true,
							),

						),
						'title_typography_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'important' => true,
								'selector'  => '.uabb-ib1-title',
							),
						),
						'title_typography_title_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Title Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'background-color',
								'important' => true,
								'selector'  => '.uabb-ib1-title',
							),
						),
					),
				),
				'desc_typography'  => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_font_typo'        => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ib1-description',
								'important' => true,
							),
						),
						'desc_typography_color' => array(
							'type'       => 'color',
							'label'      => __( 'Description Text Color', 'uabb' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ib1-description',
								'property'  => 'color',
								'important' => true,
							),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
					),
				),
			),
		),
	)
);
