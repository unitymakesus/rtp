<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Fancy Text Module
 */

FLBuilder::register_module(
	'UABBFancyTextModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'effect_type' => array(
							'type'    => 'select',
							'label'   => __( 'Effect', 'uabb' ),
							'default' => 'type',
							'options' => array(
								'type'       => __( 'Type', 'uabb' ),
								'slide_up'   => __( 'Slide Up', 'uabb' ),
								'clip'       => __( 'Clip', 'uabb' ),
								'flip'       => __( 'Flip', 'uabb' ),
								'swirl'      => __( 'Swirl', 'uabb' ),
								'blinds'     => __( 'Blinds', 'uabb' ),
								'drop-in'    => __( 'Drop-in', 'uabb' ),
								'wave'       => __( 'Wave', 'uabb' ),
								'slide'      => __( 'Push', 'uabb' ),
								'slide-down' => __( 'Slide Down', 'uabb' ),
							),
							'toggle'  => array(
								'type'     => array(
									'fields' => array( 'typing_speed', 'back_speed', 'start_delay', 'back_delay', 'enable_loop', 'show_cursor', 'cursor_text', 'cursor_blink', 'min_height' ),
								),
								'slide_up' => array(
									'fields' => array( 'animation_speed', 'pause_time', 'show_items', 'pause_hover' ),
								),
								'clip'     => array(
									'fields' => array( 'duration_reveal', 'animation_revel' ),
								),
								'swirl'    => array(
									'fields' => array( 'letter_delay' ),
								),
								'blinds'   => array(
									'fields' => array( 'letter_delay' ),
								),
								'wave'     => array(
									'fields' => array( 'letter_delay' ),
								),
							),
							'help'    => __( 'Select the effect for fancy text.', 'uabb' ),

						),
						'prefix'      => array(
							'type'        => 'text',
							'label'       => __( 'Prefix', 'uabb' ),
							'default'     => '',
							'help'        => __( 'String placed before fancy text.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-fancy-text-prefix',
							),
						),
						'fancy_text'  => array(
							'type'        => 'textarea',
							'label'       => __( 'Fancy Text', 'uabb' ),
							'default'     => '',
							'rows'        => '5',
							'help'        => __( 'String with fancy effects. You can add multiple strings by adding each string on a new line.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'suffix'      => array(
							'type'        => 'text',
							'label'       => __( 'Suffix', 'uabb' ),
							'default'     => '',
							'help'        => __( 'String placed at the end of fancy text.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-fancy-text-suffix',
							),
						),
					),
				),
				'effect'  => array(
					'title'  => __( 'Effect', 'uabb' ),
					'fields' => array(
						'typing_speed'    => array(
							'type'      => 'unit',
							'label'     => __( 'Typing Speed', 'uabb' ),
							'default'   => '80',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
							'help'      => __( 'Speed of typing effect. The time to appear single character of word.', 'uabb' ),
						),
						'back_speed'      => array(
							'type'      => 'unit',
							'label'     => __( 'Backspeed', 'uabb' ),
							'default'   => '50',
							'maxlength' => '6',
							'units'     => array( 'ms' ),
							'size'      => '8',
							'help'      => __( 'Speed of backspace effect. The time to disappear single character of word.', 'uabb' ),
						),
						'start_delay'     => array(
							'type'      => 'unit',
							'label'     => __( 'Start Delay', 'uabb' ),
							'default'   => '0',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
							'help'      => __( 'Delay for the start of type effect. If set to 5000, the first string will appear after 5 seconds.', 'uabb' ),
						),
						'back_delay'      => array(
							'type'      => 'unit',
							'label'     => __( 'Back Delay', 'uabb' ),
							'default'   => '2000',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
							'help'      => __( 'Delay for the start of backspace effect. If set to 5000, the string will remain visible for 5 seconds before backspace effect.', 'uabb' ),
						),
						'enable_loop'     => array(
							'type'    => 'select',
							'label'   => __( 'Enable Loop', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( "Select 'Yes' if type effect should be played continuously.", 'uabb' ),
						),
						'show_cursor'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Cursor', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'cursor_text', 'cursor_blink' ),
								),
							),
							'help'    => __( "Select 'Yes' if you want to display cursor at the end of fancy text & before suffix.", 'uabb' ),
						),
						'cursor_text'     => array(
							'type'      => 'text',
							'label'     => __( 'Cursor Text', 'uabb' ),
							'default'   => '|',
							'maxlength' => '2',
							'size'      => '8',
							'help'      => __( 'Enter the text / symbol for your cursor. e.g. Vertical Pipe Symbol ( | )', 'uabb' ),
							'preview'   => array(
								'type'     => 'text',
								'selector' => '.typed-cursor',
							),
						),
						'cursor_blink'    => array(
							'type'    => 'select',
							'label'   => __( 'Cursor Blink Effect', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'animation_speed' => array(
							'type'      => 'unit',
							'label'     => __( 'Animation Speed', 'uabb' ),
							'default'   => '500',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
							'help'      => __( 'Speed of fancy text transition.', 'uabb' ),
						),
						'pause_time'      => array(
							'type'      => 'unit',
							'label'     => __( 'Pause Time', 'uabb' ),
							'default'   => '2000',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
							'help'      => __( 'Delay before scrolling to next fancy text.', 'uabb' ),
						),
						'pause_hover'     => array(
							'type'    => 'select',
							'label'   => __( 'Pause on Hover', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'When mouse is over fancy text, it should pause slide effect.', 'uabb' ),
						),
						'animation_delay' => array(
							'type'      => 'unit',
							'label'     => __( 'Animation Delay', 'uabb' ),
							'default'   => '2500',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
						),
						'duration_reveal' => array(
							'type'      => 'unit',
							'label'     => __( 'Animation Revel Duaration', 'uabb' ),
							'default'   => '600',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
						),
						'animation_revel' => array(
							'type'      => 'unit',
							'label'     => __( 'Animation Revel time', 'uabb' ),
							'default'   => '1500',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
						),
						'letter_delay'    => array(
							'type'      => 'unit',
							'label'     => __( 'Letters Animation Delay', 'uabb' ),
							'default'   => '50',
							'maxlength' => '6',
							'size'      => '8',
							'units'     => array( 'ms' ),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'structure' => array(
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => array(
						'alignment'    => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-fancy-text-wrap',
								'property' => 'text-align',
							),
							'help'    => __( 'Select alignment for complete element.', 'uabb' ),
						),
						'space_prefix' => array(
							'type'      => 'unit',
							'label'     => __( 'Space After Prefix', 'uabb' ),
							'default'   => '5',
							'maxlength' => '6',
							'size'      => '8',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-fancy-text-prefix',
								'property' => 'margin-right',
								'unit'     => 'px',
							),
							'help'      => __( 'Space between Prefix and Fancy Text.', 'uabb' ),
						),
						'space_suffix' => array(
							'type'      => 'unit',
							'label'     => __( 'Space Before Suffix', 'uabb' ),
							'default'   => '5',
							'maxlength' => '6',
							'size'      => '8',
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'     => array( 'px' ),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-fancy-text-suffix',
								'property' => 'margin-left',
								'unit'     => 'px',
							),
							'help'      => __( 'Space between Fancy Text and Suffix.', 'uabb' ),
						),
						'min_height'   => array(
							'type'        => 'unit',
							'label'       => __( 'Minimum Height', 'uabb' ),
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
							'help'        => __( 'If your text is long and dropping down to next line then apply minimum height to prevent page to jump. Keep it empty for default', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fancy-text-wrap',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'text_tag'               => array(
					'title'  => __( 'Full Text', 'uabb' ),
					'fields' => array(
						'text_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Title Tag', 'uabb' ),
							'default' => 'h2',
							'options' => array(
								'h1' => __( 'H1', 'uabb' ),
								'h2' => __( 'H2', 'uabb' ),
								'h3' => __( 'H3', 'uabb' ),
								'h4' => __( 'H4', 'uabb' ),
								'h5' => __( 'H5', 'uabb' ),
								'h6' => __( 'H6', 'uabb' ),
								'p'  => __( 'P', 'uabb' ),
							),
						),
					),
				),
				'static_text_typography' => array(
					'title'  => __( 'Prefix / Suffix Text', 'uabb' ),
					'fields' => array(
						'static_text_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fancy-text-prefix, .uabb-fancy-text-suffix',
								'important' => true,
							),
						),
						'color'            => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-module-content .uabb-fancy-text-wrap .uabb-fancy-text-prefix, .uabb-module-content .uabb-fancy-text-wrap .uabb-fancy-text-suffix',
								'property' => 'color',
							),
						),
					),
				),
				'fancy_text_typography'  => array(
					'title'  => __( 'Fancy Text', 'uabb' ),
					'fields' => array(
						'fancy_text_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-fancy-text-wrap .uabb-fancy-text-main, .uabb-fancy-text-wrap .uabb-fancy-text-dynamic-wrapper',
								'important' => true,
							),
						),
						'fancy_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-fancy-text-wrap .uabb-fancy-text-main, .uabb-fancy-text-wrap .uabb-fancy-text-dynamic-wrapper.uabb-fancy-text-wrapper',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
	)
);
