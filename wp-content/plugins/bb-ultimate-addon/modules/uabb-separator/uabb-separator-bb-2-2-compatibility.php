<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Separator Module
 */

FLBuilder::register_module(
	'UABBSeparatorModule',
	array(
		'general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'height'    => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'help'        => __( 'Thickness of Border', 'uabb' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'border-top-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'units'       => array(
								'%',
								'px',
								'vw',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'alignment' => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => 'true',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator-parent',
								'property'  => 'text-align',
								'important' => true,
							),
							'help'       => __( 'Align the border.', 'uabb' ),
						),
						'style'     => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-separator',
								'property'  => 'border-top-style',
								'important' => true,
							),
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
						),
					),
				),
			),
		),
	)
);
