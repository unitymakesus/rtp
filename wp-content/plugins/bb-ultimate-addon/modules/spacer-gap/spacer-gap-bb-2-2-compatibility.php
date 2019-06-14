<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Spacer Gap Module
 */

FLBuilder::register_module(
	'UABBSpacerGap', array(
		'spacer_gap_general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'spacer_gap_general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'desktop_space' => array(
							'type'        => 'unit',
							'label'       => __( 'Desktop', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'class'       => 'uabb-spacer-gap-desktop',
							'units'       => array( 'px' ),
							'help'        => __( 'This value will work for all devices.', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-spacer-gap-preview.uabb-spacer-gap',
								'property' => 'height',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'medium_device' => array(
							'type'    => 'unit',
							'label'   => __( 'Medium Device ( Tabs )', 'uabb' ),
							'default' => '',
							'size'    => '8',
							'class'   => 'uabb-spacer-gap-tab-landscape',
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'small_device'  => array(
							'type'    => 'unit',
							'label'   => __( 'Small Device ( Mobile )', 'uabb' ),
							'default' => '',
							'size'    => '8',
							'class'   => 'uabb-spacer-gap-mobile',
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
			),
		),
	)
);
