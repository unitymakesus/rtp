<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Progress Bar Module
 */

FLBuilder::register_module(
	'ProgressBarModule',
	array(
		'elements'   => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'items'           => array(
					'title'  => __( 'Appearance', 'uabb' ), // Section Title.
					'fields' => array(
						'layout' => array(
							'type'    => 'select',
							'label'   => __( 'Bar Appearance', 'uabb' ),
							'default' => 'horizontal',
							'help'    => __( 'Select different layouts for Progress Bar', 'uabb' ),
							'options' => array(
								'horizontal'    => __( 'Horizontal', 'uabb' ),
								'vertical'      => __( 'Vertical', 'uabb' ),
								'circular'      => __( 'Circular', 'uabb' ),
								'semi-circular' => __( 'Semi Circular', 'uabb' ),
							),
							'toggle'  => array(
								'horizontal'    => array(
									'sections' => array( 'horizontal', 'text_typography', 'border' ),
									'fields'   => array( 'stripped' ),
								),
								'vertical'      => array(
									'sections' => array( 'vertical', 'text_typography', 'border' ),
									'fields'   => array( 'stripped', 'overall_alignment' ),
								),
								'circular'      => array(
									'sections' => array( 'circular', 'before_after_typography' ),
									'fields'   => array( 'overall_alignment' ),
								),
								'semi-circular' => array(
									'sections' => array( 'circular', 'before_after_typography' ),
									'fields'   => array( 'overall_alignment' ),
								),
							),
						),
					),
				),
				'circular_layout' => array(
					'title'  => __( 'Progress Bar Items', 'uabb' ),
					'fields' => array(
						'horizontal' => array(
							'type'         => 'form',
							'label'        => __( 'Progress Bar Item', 'uabb' ),
							'form'         => 'progress_bar_horizontal_item_form',
							'preview_text' => 'horizontal_number',
							'multiple'     => true,
						),
					),
				),
			),
		),
		'general'    => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'spacing_options' => array(
					'title'  => '',
					'fields' => array(
						'overall_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
						),
						'spacing'           => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '10',
							'size'        => '8',
							'help'        => __( 'Space between two progress bars', 'uabb' ),
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'stripped'          => array(
							'type'    => 'select',
							'label'   => __( 'Striped Selector', 'uabb' ),
							'default' => 'yes',
							'help'    => __( 'Enable to display stripes on progress, this option will only work if Progress type is color.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'horizontal'      => array(
					'title'  => __( 'Horizontal Style', 'uabb' ),
					'fields' => array(
						'horizontal_style'        => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select the different positons to display Progress Value and Number', 'uabb' ),
							'options' => array(
								'style1' => __( 'Number and Text Above the Progress Bar', 'uabb' ),
								'style2' => __( 'Number and Text Below the Progress Bar', 'uabb' ),
								'style3' => __( 'Number and Text Inside the Progress Bar', 'uabb' ),
								'style4' => __( 'Number Inside and Text Outside the Progress Bar', 'uabb' ),
							),
						),
						'text_position'           => array(
							'type'    => 'select',
							'label'   => __( 'Text Position', 'uabb' ),
							'default' => 'above',
							'options' => array(
								'above' => __( 'Above', 'uabb' ),
								'below' => __( 'Below', 'uabb' ),
							),
						),
						'horizontal_thickness'    => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'size'        => '8',
							'placeholder' => '20',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( 'This is basically the height', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-layout-horizontal .uabb-progress-box',
								'property' => 'height',
								'unit'     => 'px',
							),
						),
						'horizontal_space_above'  => array(
							'type'        => 'unit',
							'label'       => __( 'Space above title', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-title, .uabb-progress-value',
								'property'  => 'padding-top',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'horizontal_space_below'  => array(
							'type'        => 'unit',
							'label'       => __( 'Space Below Title', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-title, .uabb-progress-value',
								'property'  => 'padding-bottom',
								'important' => true,
								'unit'      => 'px',
							),
						),
						'horizontal_vert_padding' => array(
							'type'        => 'unit',
							'label'       => __( 'Vertical Padding', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-progress-title, .uabb-progress-value',
										'property'  => 'padding-top',
										'important' => true,
										'unit'      => 'px',
									),
									array(
										'selector'  => '.uabb-progress-title, .uabb-progress-value',
										'property'  => 'padding-bottom',
										'important' => true,
										'unit'      => 'px',
									),
								),
							),
						),
						'horizontal_horz_padding' => array(
							'type'        => 'unit',
							'label'       => __( 'Horizontal Padding', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-progress-title, .uabb-progress-value',
										'property'  => 'padding-left',
										'important' => true,
										'unit'      => 'px',
									),
									array(
										'selector'  => '.uabb-progress-title, .uabb-progress-value',
										'property'  => 'padding-right',
										'important' => true,
										'unit'      => 'px',
									),
								),
							),
						),
					),
				),
				'vertical'        => array(
					'title'  => __( 'Vertical Style', 'uabb' ),
					'fields' => array(
						'vertical_style'                => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select the different positons to display Progress Value and Number', 'uabb' ),
							'options' => array(
								'style1' => __( 'Number and Text Above the Progress Bar', 'uabb' ),
								'style2' => __( 'Number and Text Below the Progress Bar', 'uabb' ),
								'style3' => __( 'Number inside and Text below the Progress Bar', 'uabb' ),
							),
							'toggle'  => array(
								'style3' => array(
									'fields' => array( 'title_alignment' ),
								),
							),
						),
						'title_alignment'               => array(
							'type'    => 'align',
							'label'   => __( 'Title Alignment', 'uabb' ),
							'default' => 'center',
						),
						'vertical_thickness'            => array(
							'type'        => 'unit',
							'label'       => __( 'Height', 'uabb' ),
							'size'        => '8',
							'placeholder' => '200',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'vertical_width'                => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'size'        => '8',
							'placeholder' => '300',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'vertical_responsive'           => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Size', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Add responsive size for medium devices', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'vertical_responsive_thickness', 'vertical_responsive_width' ),
								),
							),
						),
						'vertical_responsive_thickness' => array(
							'type'        => 'unit',
							'label'       => __( 'Vertical Responsive Height', 'uabb' ),
							'size'        => '8',
							'placeholder' => '200',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'vertical_responsive_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Vertical Responsive Width', 'uabb' ),
							'size'        => '8',
							'placeholder' => '150',
							'units'       => array( 'px' ),
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
				'circular'        => array(
					'title'  => __( 'Circular Style', 'uabb' ),
					'fields' => array(
						'circular_thickness'        => array(
							'type'        => 'unit',
							'label'       => __( 'Circle Width', 'uabb' ),
							'size'        => '8',
							'placeholder' => '300',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'stroke_thickness'          => array(
							'type'        => 'unit',
							'label'       => __( 'Stroke Thickness', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( 'This is the thickness of stroke.', 'uabb' ),
						),
						'circular_responsive'       => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Size', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Add responsive size for medium devices', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'circular_responsive_width' ),
								),
							),
						),
						'circular_responsive_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Circle Responsive Width', 'uabb' ),
							'size'        => '8',
							'placeholder' => '200',
							'units'       => array( 'px' ),
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
				'border'          => array( // Section.
					'title'  => __( 'Border', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'progress_border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-wrap',
								'important' => true,
							),
						),
					),
				),
				'animation'       => array( // Section.
					'title'  => 'Animation', // Section Title.
					'fields' => array( // Section Fields.
						'animation_speed' => array(
							'type'        => 'unit',
							'label'       => __( 'Animation Speed', 'uabb' ),
							'size'        => '5',
							'placeholder' => '1',
							'units'       => array( 'Sec' ),
							'help'        => __( 'Number of seconds to complete the animation.', 'uabb' ),
						),
						'delay'           => array(
							'type'        => 'unit',
							'label'       => __( 'Animation Delay', 'uabb' ),
							'size'        => '5',
							'placeholder' => '1',
							'units'       => array( 'Sec' ),
						),
					),
				),
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'text_typography'         => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'text_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h4',
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
						'text_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-title',
								'important' => true,
							),
						),
						'text_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-title',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'before_after_typography' => array(
					'title'  => __( 'Before/After Text', 'uabb' ),
					'fields' => array(
						'before_after_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ba-text',
								'important' => true,
							),
						),
						'before_after_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ba-text',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'number_typography'       => array(
					'title'  => __( 'Progress Value', 'uabb' ),
					'fields' => array(
						'number_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-value, .uabb-percent-counter',
								'important' => true,
							),
						),
						'number_color' => array(
							'type'       => 'color',
							'label'      => __( 'Progress Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-progress-value, .uabb-percent-counter',
								'important' => true,
								'property'  => 'color',
							),
						),
					),
				),
			),
		),
	)
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'progress_bar_horizontal_item_form',
	array(
		'title' => __( 'Add Progress Bar Item', 'uabb' ),
		'tabs'  => array(
			'general' => array( // Tab.
				'title'    => __( 'Layout', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'circular' => array(
						'title'  => __( 'Progress Settings', 'uabb' ),
						'fields' => array(
							'horizontal_number'        => array(
								'type'        => 'unit',
								'label'       => __( 'Progress Value', 'uabb' ),
								'placeholder' => '80',
								'size'        => '8',
								'units'       => array( '%' ),
								'slider'      => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
								'connections' => array( 'string' ),
							),
							'circular_before_number'   => array(
								'type'        => 'text',
								'label'       => __( 'Text Before Number', 'uabb' ),
								'default'     => __( 'Before Text', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'circular_after_number'    => array(
								'type'        => 'text',
								'label'       => __( 'Text After Number', 'uabb' ),
								'default'     => __( 'After Text', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'horizontal_before_number' => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'default'     => __( 'Luck', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'general'  => array( // Section.
						'title'  => __( 'Style', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'progress_bg_type'       => array(
								'type'    => 'select',
								'label'   => __( 'Progress Type', 'uabb' ),
								'default' => 'color',
								'help'    => __( 'You can select one of the three background types: Color: simple one color background, Gradient: two color background or Image: single image or pattern.', 'uabb' ),
								'options' => array(
									'color'    => __( 'Color', 'uabb' ),
									'gradient' => __( 'Gradient', 'uabb' ),
									'image'    => __( 'Image', 'uabb' ),
								),
								'toggle'  => array(
									'color'    => array(
										'fields' => array( 'gradient_color' ),
									),
									'image'    => array(
										'fields' => array( 'progress_bg_img', 'progress_bg_img_pos', 'progress_bg_img_size', 'progress_bg_img_repeat' ),
									),
									'gradient' => array(
										'fields' => array( 'gradient_field' ),
									),
								),
							),
							'gradient_field'         => array(
								'type'    => 'uabb-gradient',
								'label'   => __( 'Gradient', 'uabb' ),
								'default' => array(
									'color_one' => '',
									'color_two' => '',
									'direction' => 'top_bottom',
									'angle'     => '0',
								),
							),
							'progress_bg_img'        => array(
								'type'        => 'photo',
								'label'       => __( 'Progress Image', 'uabb' ),
								'show_remove' => true,
							),
							'progress_bg_img_pos'    => array(
								'type'    => 'select',
								'label'   => __( 'Progress Image Position', 'uabb' ),
								'default' => 'center center',
								'options' => array(
									'left top'      => __( 'Left Top', 'uabb' ),
									'left center'   => __( 'Left Center', 'uabb' ),
									'left bottom'   => __( 'Left Bottom', 'uabb' ),
									'center top'    => __( 'Center Top', 'uabb' ),
									'center center' => __( 'Center Center', 'uabb' ),
									'center bottom' => __( 'Center Bottom', 'uabb' ),
									'right top'     => __( 'Right Top', 'uabb' ),
									'right center'  => __( 'Right Center', 'uabb' ),
									'right bottom'  => __( 'Right Bottom', 'uabb' ),
								),
							),
							'progress_bg_img_repeat' => array(
								'type'    => 'select',
								'label'   => __( 'Progress Image Repeat', 'uabb' ),
								'default' => 'repeat',
								'options' => array(
									'no-repeat' => __( 'No Repeat', 'uabb' ),
									'repeat'    => __( 'Repeat', 'uabb' ),
									'repeat-x'  => __( 'Repeat Horizontally', 'uabb' ),
									'repeat-y'  => __( 'Repeat Vertically', 'uabb' ),
								),
							),
							'progress_bg_img_size'   => array(
								'type'    => 'select',
								'label'   => __( 'Progress Image Size', 'uabb' ),
								'default' => 'initial',
								'options' => array(
									'contain' => __( 'Contain', 'uabb' ),
									'cover'   => __( 'Cover', 'uabb' ),
									'initial' => __( 'Initial', 'uabb' ),
									'inherit' => __( 'Inherit', 'uabb' ),
								),
							),
							'gradient_color'         => array(
								'type'       => 'color',
								'label'      => __( 'Progress Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'show_alpha' => true,
								'help'       => __( 'This is the animated progress color, that animates above background color.', 'uabb' ),
							),
							'background_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => 'e5e5e5',
								'show_reset' => true,
								'show_alpha' => true,
								'help'       => __( 'This color goes behind the progress color', 'uabb' ),
							),
						),
					),
				),
			),
		),
	)
);

