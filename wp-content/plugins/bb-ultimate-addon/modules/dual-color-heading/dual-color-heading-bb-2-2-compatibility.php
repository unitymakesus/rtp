<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Dual Color Heading Module
 */

FLBuilder::register_module(
	'UABBDualColorModule', array(
		'dual_color'      => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_color_first_heading'  => array( // Section.
					'title'  => __( 'First Heading', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'first_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'First Heading', 'uabb' ),
							'default'     => 'I love ',
							'class'       => 'uabb-first-heading',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-first-heading-text',
							),
							'help'        => __( 'Enter first part of heading.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'first_heading_link' => array(
							'type'          => 'link',
							'label'         => __( 'First Heading Link', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'dual_color_second_heading' => array( // Section.
					'title'  => __( 'Second Heading', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'second_heading_text' => array(
							'type'        => 'text',
							'label'       => __( 'Second Heading', 'uabb' ),
							'default'     => 'this website!',
							'class'       => 'uabb-second-heading',
							'description' => '',
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-second-heading-text',
							),
							'help'        => __( 'Enter second part of heading.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'second_heading_link' => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'show_nofollow' => true,
							'show_target'   => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'dual_color'                => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'add_spacing_option'       => array(
							'type'    => 'select',
							'label'   => __( 'Spacing Between Headings', 'uabb' ),
							'default' => 'no',
							'class'   => 'dual-color-spacing-option',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'heading_margin' ),
								),
								'no'  => array(
									'fields' => array(),
								),
							),
							'help'    => __( 'Adjust spacing between first & second part of heading.', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-first-heading-text',
								'property' => 'margin-right',
								'unit'     => 'px',
							),

						),
						'heading_margin'           => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '10',
							'size'        => '8',
							'class'       => 'uabb-add-spacing',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'help'        => __( 'Enter value for the spacing between first & second heading.', 'uabb' ),
						),
						'first_heading_color'      => array(
							'type'        => 'color',
							'label'       => __( 'First Heading Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text',
								'property' => 'color',
							),
							'help'        => __( 'Select color for first part of heading.', 'uabb' ),
						),
						'second_heading_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Second Heading Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text',
								'property' => 'color',
							),
							'help'        => __( 'Select color for second part of heading.', 'uabb' ),
						),
						'responsive_compatibility' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'help'    => __( 'There might be responsive issues for long texts. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb' ),
							'default' => '',
							'options' => array(
								''                         => __( 'None', 'uabb' ),
								'uabb-responsive-mobile'   => __( 'Small Devices', 'uabb' ),
								'uabb-responsive-medsmall' => __( 'Medium & Small Devices', 'uabb' ),
							),
						),
					),
				),
			),
		),

		'dual_typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'dual_typography' => array(
					'title'  => __( 'Headings', 'uabb' ),
					'fields' => array(
						'dual_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Select Tag', 'uabb' ),
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
						'dual_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-dual-color-heading *',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
