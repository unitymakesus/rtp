<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB iHover Module
 */

FLBuilder::register_module(
	'iHoverModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array(
				'items' => array(
					'title'  => __( 'iHover Items', 'uabb' ), // Section Title.
					'fields' => array(
						'ihover_item' => array(
							'type'         => 'form',
							'label'        => __( 'iHover Item', 'uabb' ),
							'form'         => 'ihover_item_form',
							'preview_text' => 'title',
							'multiple'     => true,
						),
					),
				),
			),
		),
		'design'     => array( // Tab.
			'title'    => __( 'Design', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'alignment' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'align_param'               => array(
							'type'    => 'align',
							'label'   => __( 'iHover Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This is the overall alignment of iHover', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-ih-list',
								'property'  => 'text-align',
								'important' => true,
							),
						),
						'spacing'                   => array(
							'type'    => 'unit',
							'label'   => __( 'Spacing', 'uabb' ),
							'default' => '30',
							'size'    => '8',
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'help'    => __( 'Spacing between two iHovers', 'uabb' ),
						),
						'content_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Content Padding', 'uabb' ),
							'help'       => __( 'To manage the inner padding use this setting.', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
				'style'     => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'shape'                   => array(
							'type'    => 'select',
							'label'   => __( 'Thumbnail Shape', 'uabb' ),
							'default' => 'circle',
							'help'    => __( 'Select the shape of iHover image, we have used CSS to shape the image, for best output use relevant images', 'uabb' ),
							'options' => array(
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
							),
						),
						'height_width_options'    => array(
							'type'    => 'select',
							'label'   => __( 'Thumbnail Height & Width', 'uabb' ),
							'default' => 'default',
							'help'    => __( 'By selecting Custom, you can decide the height and width of iHover Box, by Default 250px height and width is applied', 'uabb' ),
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'fields' => array(),
								),
								'custom'  => array(
									'fields' => array( 'height_width' ),
								),
							),
						),
						'height_width'            => array(
							'type'    => 'unit',
							'label'   => __( 'Height / Width', 'uabb' ),
							'default' => '250',
							'size'    => '8',
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-ih-image-block, .uabb-ih-item, .uabb-ih-list-item',
										'property' => 'width',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-ih-image-block, .uabb-ih-item, .uabb-ih-list-item',
										'property' => 'height',
										'unit'     => 'px',
									),
								),
							),
						),
						'responsive_size'         => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Size', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Add responsive size for medium devices', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'fields' => array(),
								),
								'yes' => array(
									'fields' => array( 'height_width_responsive' ),
								),
							),
						),
						'height_width_responsive' => array(
							'type'    => 'unit',
							'label'   => __( 'Responsive Height / Width', 'uabb' ),
							'default' => '100',
							'size'    => '8',
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
								'selector'  => '.uabb-ih-heading',
								'important' => true,
							),
						),
					),
				),
				'desc_typography'  => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'desc_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-ih-description',
								'important' => true,
							),
						),
					),
				),
				'spacing_settings' => array( // Section.
					'title'  => __( 'Space Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'title_margin_top'        => array(
							'type'        => 'unit',
							'label'       => __( 'Title Top Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-heading',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'title_margin_bottom'     => array(
							'type'        => 'unit',
							'label'       => __( 'Title Bottom Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-heading',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'separator_margin_top'    => array(
							'type'        => 'unit',
							'label'       => __( 'Separator Top Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '7',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-divider-block',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'separator_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Separator Bottom Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '7',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-divider-block',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'desc_margin_top'         => array(
							'type'        => 'unit',
							'label'       => __( 'Description Top Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-description-block',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'desc_margin_bottom'      => array(
							'type'        => 'unit',
							'label'       => __( 'Description Bottom Margin', 'uabb' ),
							'size'        => '8',
							'placeholder' => '5',
							'class'       => '',
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-ih-description-block',
								'property' => 'margin-bottom',
								'unit'     => 'px',
							),
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
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/will-find-responsive-option-ihover-module/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=iHover-module" target="_blank" rel="noopener"> Where will I find the responsive option for the iHover module? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/facing-ihover-overlap-issue-resolve/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=iHover-module" target="_blank" rel="noopener"> Facing an iHover Overlap issue. How do I resolve it? </a> </li>

							 </ul>',
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
	'ihover_item_form',
	array(
		'title' => __( 'Add iHover Item', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => array(
					'general'     => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'photo' => array(
								'type'        => 'photo',
								'label'       => __( 'iHover Image', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
						),
					),
					'title'       => array( // Section.
						'title'  => __( 'Title', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'title' => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'default'     => 'iHover',
								'help'        => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
						),
					),
					'separator'   => array( // Section.
						'title'  => __( 'Title & Description Divider', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'separator_style' => array(
								'type'    => 'select',
								'label'   => __( 'Divider Style', 'uabb' ),
								'default' => 'solid',
								'help'    => __( 'Select the border style.', 'uabb' ),
								'options' => array(
									'none'   => __( 'None', 'uabb' ),
									'solid'  => __( 'Solid', 'uabb' ),
									'dashed' => __( 'Dashed', 'uabb' ),
									'dotted' => __( 'Dotted', 'uabb' ),
									'double' => __( 'Double', 'uabb' ),
									'inset'  => __( 'Inset', 'uabb' ),
									'outset' => __( 'Outset', 'uabb' ),
								),
								'toggle'  => array(
									'none'   => array(
										'fields' => array(),
									),
									'solid'  => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
									'dashed' => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
									'dotted' => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
									'double' => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
									'inset'  => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
									'outset' => array(
										'fields' => array( 'separator_size', 'separator_width', 'separator_color', 'separator_margin_top', 'separator_margin_bottom' ),
									),
								),
							),
							'separator_size'  => array(
								'type'        => 'unit',
								'label'       => __( 'Divider thickness', 'uabb' ),
								'default'     => '1',
								'size'        => '8',
								'placeholder' => __( 'Size of border', 'uabb' ),
								'class'       => '',
								'units'       => array( 'px' ),
								'help'        => __( 'Enter value in pixels.', 'uabb' ),
								'slider'      => array(
									'' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'separator_width' => array(
								'type'        => 'unit',
								'label'       => __( 'Divider Width', 'uabb' ),
								'default'     => '50',
								'size'        => '8',
								'placeholder' => __( 'Width of border', 'uabb' ),
								'class'       => '',
								'units'       => array( '%' ),
								'help'        => __( 'Enter value in percentage.', 'uabb' ),
								'slider'      => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
						),
					),
					'description' => array( // Section.
						'title'  => __( 'Description', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'description' => array(
								'type'          => 'editor',
								'media_buttons' => false,
								'rows'          => 10,
								'label'         => '',
								'default'       => __( 'Enter description text here.', 'uabb' ),
								'connections'   => array( 'string', 'html' ),
							),
						),
					),
					'link'        => array( // Section.
						'title'  => __( 'Link', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'on_click'    => array(
								'type'    => 'select',
								'label'   => __( 'On Click', 'uabb' ),
								'default' => 'do_nothing',
								'options' => array(
									'do_nothing' => __( 'Do Nothing', 'uabb' ),
									'link'       => __( 'Link', 'uabb' ),
								),
								'toggle'  => array(
									'do_nothing' => array(
										'fields' => array(),
									),
									'link'       => array(
										'fields' => array( 'link_url', 'link_target' ),
									),
								),
							),
							'link_url'    => array(
								'type'        => 'text',
								'label'       => __( 'Link URL', 'uabb' ),
								'placeholder' => __( 'URL', 'uabb' ),
								'connections' => array( 'url' ),
							),
							'link_target' => array(
								'type'    => 'select',
								'label'   => __( 'Link target', 'uabb' ),
								'default' => '_blank',
								'help'    => __( 'Description would appear in the selected tag', 'uabb' ),
								'options' => array(
									'_blank' => __( 'New Page', 'uabb' ),
									''       => __( 'Same Page', 'uabb' ),
								),
							),
						),
					),
				),
			),
			'hover'   => array( // Tab.
				'title'    => __( 'Design', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'effect' => array( // Section.
						'title'  => __( 'Effects and Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'effect'               => array(
								'type'    => 'select',
								'label'   => __( 'Effect', 'uabb' ),
								'default' => 'effect1',
								'options' => array(
									'effect1'  => __( 'Effect 1', 'uabb' ),
									'effect2'  => __( 'Effect 2', 'uabb' ),
									'effect3'  => __( 'Effect 3', 'uabb' ),
									'effect4'  => __( 'Effect 4', 'uabb' ),
									'effect5'  => __( 'Effect 5', 'uabb' ),
									'effect6'  => __( 'Effect 6', 'uabb' ),
									'effect7'  => __( 'Effect 7', 'uabb' ),
									'effect8'  => __( 'Effect 8', 'uabb' ),
									'effect9'  => __( 'Effect 9', 'uabb' ),
									'effect10' => __( 'Effect 10', 'uabb' ),
									'effect11' => __( 'Effect 11', 'uabb' ),
									'effect12' => __( 'Effect 12', 'uabb' ),
									'effect13' => __( 'Effect 13', 'uabb' ),
									'effect14' => __( 'Effect 14', 'uabb' ),
									'effect15' => __( 'Effect 15', 'uabb' ),
									'effect16' => __( 'Effect 16', 'uabb' ),
									'effect17' => __( 'Effect 17', 'uabb' ),
									'effect18' => __( 'Effect 18', 'uabb' ),
									'effect19' => __( 'Effect 19', 'uabb' ),
								),
								'toggle'  => array(
									'effect1'  => array(
										'fields' => array(),
									),
									'effect2'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect3'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect4'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect5'  => array(
										'fields' => array(),
									),
									'effect6'  => array(
										'fields' => array( 'advanced_effect2' ),
									),
									'effect7'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect8'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect9'  => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect10' => array(
										'fields' => array( 'advanced_effect3' ),
									),
									'effect11' => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect12' => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect13' => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect14' => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect15' => array(
										'fields' => array(),
									),
									'effect16' => array(
										'fields' => array( 'advanced_effect4' ),
									),
									'effect17' => array(
										'fields' => array(),
									),
									'effect18' => array(
										'fields' => array( 'advanced_effect1' ),
									),
									'effect19' => array(
										'fields' => array(),
									),
								),
							),
							'advanced_effect1'     => array(
								'type'    => 'select',
								'label'   => __( 'Hover Effect Direction', 'uabb' ),
								'default' => 'right_to_left',
								'options' => array(
									'right_to_left' => __( 'Towards Left', 'uabb' ),
									'left_to_right' => __( 'Towards Right', 'uabb' ),
									'bottom_to_top' => __( 'Towards Top', 'uabb' ),
									'top_to_bottom' => __( 'Towards Bottom', 'uabb' ),
								),
							),
							'advanced_effect2'     => array(
								'type'    => 'select',
								'label'   => __( 'Hover Effect Scale', 'uabb' ),
								'default' => 'scale_up',
								'options' => array(
									'scale_up'      => __( 'Scale Up', 'uabb' ),
									'scale_down'    => __( 'Scale Down', 'uabb' ),
									'scale_down_up' => __( 'Scale Down Up', 'uabb' ),
								),
							),
							'advanced_effect3'     => array(
								'type'    => 'select',
								'label'   => __( 'Hover Effect Direction', 'uabb' ),
								'default' => 'top_to_bottom',
								'options' => array(
									'top_to_bottom' => __( 'Towards Bottom', 'uabb' ),
									'bottom_to_top' => __( 'Towards Top', 'uabb' ),
								),
							),
							'advanced_effect4'     => array(
								'type'    => 'select',
								'label'   => __( 'Hover Effect Direction', 'uabb' ),
								'default' => 'left_to_right',
								'options' => array(
									'left_to_right' => __( 'Towards Right', 'uabb' ),
									'right_to_left' => __( 'Towards Left', 'uabb' ),
								),
							),
							'title_color'          => array(
								'type'        => 'color',
								'label'       => __( 'Title Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
							'description_color'    => array(
								'type'        => 'color',
								'label'       => __( 'Description Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
							'background_color'     => array(
								'type'        => 'color',
								'label'       => __( 'Background Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
							'background_color_opc' => array(
								'type'        => 'unit',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'units'       => array( '%' ),
								'maxlength'   => '3',
								'connections' => array( 'color' ),
								'size'        => '5',
								'slider'      => array(
									'%' => array(
										'min'  => 0,
										'max'  => 1000,
										'step' => 10,
									),
								),
							),
							'separator_color'      => array(
								'type'        => 'color',
								'label'       => __( 'Divider Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => array( 'color' ),
							),
						),
					),
					'border' => array( // Section.
						'title'  => __( 'Border', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'border_style_param' => array(
								'type'       => 'border',
								'label'      => __( 'Border', 'uabb' ),
								'responsive' => true,
								'default'    => array(
									'style' => 'solid',
									'color' => 'EFEFEF',
									'width' => array(
										'top'    => '25',
										'right'  => '25',
										'bottom' => '25',
										'left'   => '25',
									),
								),
								'preview'    => array(
									'type'     => 'css',
									'selector' => '',
								),
							),
						),
					),
				),
			),
		),
	)
);
