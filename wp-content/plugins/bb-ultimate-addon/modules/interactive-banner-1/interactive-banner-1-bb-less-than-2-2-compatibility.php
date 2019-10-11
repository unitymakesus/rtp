<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
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
						'banner_title'          => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Interactive Banner', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-ib1-title',
							),
						),
						'banner_title_location' => array(
							'type'    => 'select',
							'label'   => __( 'Title Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-title',
								'property' => 'text-align',
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
							'type'        => 'unit',
							'label'       => __( 'Custom Banner Height', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-block',
								'property' => 'height',
								'unit'     => 'px',
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
						'banner_desc'                  => array(
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
						'overlay_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Overlay Color', 'uabb' ),
							'default'    => '808080',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-background',
								'property' => 'background',
							),
						),
						'overlay_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
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
						),
						'icon_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
					),
				),
				'link'        => array( // Section.
					'title'  => __( 'Call To Action Below Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'show_button'     => array(
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
									'fields' => array( 'cta_link', 'cta_link_target', 'cta_link_follow' ),
								),
							),
						),
						'button'          => array(
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						),
						'cta_link'        => array(
							'type'        => 'link',
							'default'     => '#',
							'label'       => __( 'Link', 'uabb' ),
							'help'        => __( 'The link applies to the entire module.', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'string', 'html' ),
						),
						'cta_link_target' => array(
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
						'cta_link_follow' => array(
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
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title_typography' => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'title_typography_tag_selection'  => array(
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
						'title_typography_font_family'    => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-ib1-title',
							),
						),
						'title_typography_font_size_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-title',
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
								'selector' => '.uabb-ib1-title',
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
						'title_typography_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-ib1-title',
							),
						),
						'title_typography_title_background_color' => array(
							'type'       => 'color',
							'label'      => __( 'Title Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'property' => 'background-color',
								'selector' => '.uabb-ib1-title',
							),
						),
						'title_typography_title_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
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
								'selector' => '.uabb-ib1-title',
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
								'selector' => '.uabb-ib1-title',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'desc_typography'  => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_typography_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-ib1-description',
							),
						),
						'desc_typography_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-description',
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
						'desc_typography_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-description',
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
						'desc_typography_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Description Text Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-description',
								'property' => 'color',
							),
							'default'    => '',
							'show_reset' => true,
						),
						'desc_transform'                   => array(
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
								'selector' => '.uabb-ib1-description',
								'property' => 'text-transform',
							),
						),
						'desc_letter_spacing'              => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ib1-description',
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
