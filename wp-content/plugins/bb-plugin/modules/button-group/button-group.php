<?php

/**
 * @class FLButtonGroupModule
 */
class FLButtonGroupModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Button Group', 'fl-builder' ),
			'description'     => __( 'Renders a series of call to action buttons.', 'fl-builder' ),
			'category'        => __( 'Basic', 'fl-builder' ),
			'partial_refresh' => true,
			'icon'            => 'button.svg',
		));
	}

	/**
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		$this->add_js( 'jquery-magnificpopup' );
		$this->add_css( 'font-awesome-5' );
		$this->add_css( 'jquery-magnificpopup' );
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLButtonGroupModule', array(
	'buttons' => array(
		'title'    => __( 'Buttons', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title'  => '',
				'fields' => array(
					'items' => array(
						'type'         => 'form',
						'label'        => __( 'Button', 'fl-builder' ),
						'form'         => 'buttons_form', // ID from registered form below
						'preview_text' => 'text', // Name of a field to use for the preview text
						'multiple'     => true,
					),
				),
			),
		),
	),
	'style'   => array(
		'title'    => __( 'Style', 'fl-builder' ),
		'sections' => array(
			'style'  => array(
				'title'  => '',
				'fields' => array(
					'layout'        => array(
						'type'    => 'select',
						'label'   => __( 'Layout', 'fl-builder' ),
						'default' => 'horizotal',
						'options' => array(
							'horizontal' => __( 'Horizontal', 'fl-builder' ),
							'vertical'   => __( 'Vertical', 'fl-builder' ),
						),
						'toggle'  => array(
							'vertical' => array(
								'fields' => array( 'width' ),
							),
						),
					),
					'align'         => array(
						'type'       => 'align',
						'label'      => __( 'Align', 'fl-builder' ),
						'default'    => 'left',
						'responsive' => true,
					),
					'space_between' => array(
						'type'         => 'unit',
						'label'        => 'Space Between Buttons',
						'units'        => array(
							'px',
							'vw',
						),
						'default_unit' => 'px',
						'slider'       => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
						'default'      => 5,
					),
					'width'         => array(
						'type'    => 'select',
						'label'   => __( 'Width', 'fl-builder' ),
						'default' => 'full',
						'options' => array(
							'full'   => __( 'Full Width', 'fl-builder' ),
							'custom' => __( 'Custom', 'fl-builder' ),
						),
						'toggle'  => array(
							'custom' => array(
								'fields' => array( 'custom_width' ),
							),
						),
					),
					'custom_width'  => array(
						'type'    => 'unit',
						'label'   => __( 'Custom Width', 'fl-builder' ),
						'default' => '200',
						'slider'  => array(
							'px' => array(
								'min'  => 0,
								'max'  => 1000,
								'step' => 10,
							),
						),
						'units'   => array(
							'px',
							'vw',
							'%',
						),
					),
					'padding'       => array(
						'type'       => 'dimension',
						'label'      => __( 'Padding', 'fl-builder' ),
						'responsive' => true,
						'slider'     => true,
						'units'      => array( 'px' ),
					),
				),
			),
			'text'   => array(
				'title'  => __( 'Text', 'fl-builder' ),
				'fields' => array(
					'text_color'       => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
					),
					'text_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Hover Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
					),
					'typography'       => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'fl-builder' ),
						'responsive' => true,
					),
				),
			),
			'colors' => array(
				'title'  => __( 'Background', 'fl-builder' ),
				'fields' => array(
					'bg_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.fl-button-group-buttons a.fl-button',
							'property' => 'background-color',
						),
					),
					'bg_hover_color'    => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Hover Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.fl-button-group-buttons a.fl-button:hover',
							'property' => 'background-color',
						),
					),
					'style'             => array(
						'type'    => 'select',
						'label'   => __( 'Background Style', 'fl-builder' ),
						'default' => 'flat',
						'options' => array(
							'flat'     => __( 'Flat', 'fl-builder' ),
							'gradient' => __( 'Gradient', 'fl-builder' ),
						),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.fl-button-group-buttons a.fl-button:hover',
							'property' => 'background-color',
						),
					),
					'button_transition' => array(
						'type'    => 'select',
						'label'   => __( 'Background Animation', 'fl-builder' ),
						'default' => 'disable',
						'options' => array(
							'disable' => __( 'Disabled', 'fl-builder' ),
							'enable'  => __( 'Enabled', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
			'border' => array(
				'title'  => __( 'Border', 'fl-builder' ),
				'fields' => array(
					'border'             => array(
						'type'       => 'border',
						'label'      => __( 'Border', 'fl-builder' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.fl-button-group .fl-button-group-buttons a.fl-button',
						),
					),
					'border_hover_color' => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Border Hover Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'none',
						),
					),
				),
			),
		),
	),
));


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('buttons_form', array(
	'title' => __( 'Add Button', 'fl-builder' ),
	'tabs'  => array(
		'general' => array(
			'title'    => __( 'General', 'fl-builder' ),
			'sections' => array(
				'general'  => array(
					'title'  => '',
					'fields' => array(
						'text'           => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'fl-builder' ),
							'default'     => __( 'Click Here', 'fl-builder' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.fl-button-text',
							),
							'connections' => array( 'string' ),
						),
						'icon'           => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'fl-builder' ),
							'show_remove' => true,
							'show'        => array(
								'fields' => array( 'icon_position', 'icon_animation' ),
							),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_position'  => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'fl-builder' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'fl-builder' ),
								'after'  => __( 'After Text', 'fl-builder' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'icon_animation' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Visibility', 'fl-builder' ),
							'default' => 'disable',
							'options' => array(
								'disable' => __( 'Always Visible', 'fl-builder' ),
								'enable'  => __( 'Fade In On Hover', 'fl-builder' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'click_action'   => array(
							'type'    => 'select',
							'label'   => __( 'Click Action', 'fl-builder' ),
							'default' => 'link',
							'options' => array(
								'link'     => __( 'Link', 'fl-builder' ),
								'lightbox' => __( 'Lightbox', 'fl-builder' ),
							),
							'toggle'  => array(
								'link'     => array(
									'fields' => array( 'link' ),
								),
								'lightbox' => array(
									'sections' => array( 'lightbox' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'link'           => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'fl-builder' ),
							'placeholder'   => __( 'https://www.example.com', 'fl-builder' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'show_target'   => true,
							'show_download' => true,
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'url' ),
						),
					),
				),
				'lightbox' => array(
					'title'  => __( 'Lightbox Content', 'fl-builder' ),
					'fields' => array(
						'lightbox_content_type' => array(
							'type'    => 'select',
							'label'   => __( 'Content Type', 'fl-builder' ),
							'default' => 'html',
							'options' => array(
								'html'  => __( 'HTML', 'fl-builder' ),
								'video' => __( 'Video', 'fl-builder' ),
							),
							'preview' => array(
								'type' => 'none',
							),
							'toggle'  => array(
								'html'  => array(
									'fields' => array( 'lightbox_content_html' ),
								),
								'video' => array(
									'fields' => array( 'lightbox_video_link' ),
								),
							),
						),
						'lightbox_content_html' => array(
							'type'        => 'code',
							'editor'      => 'html',
							'label'       => '',
							'rows'        => '19',
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'string' ),
						),
						'lightbox_video_link'   => array(
							'type'        => 'text',
							'label'       => __( 'Video Link', 'fl-builder' ),
							'placeholder' => 'https://vimeo.com/122546221',
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'custom_field' ),
						),
					),
				),
			),
		),
		'style'   => array(
			'title'    => __( 'Style', 'fl-builder' ),
			'sections' => array(
				'style'  => array(
					'title'  => '',
					'fields' => array(
						'padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'fl-builder' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
						),
					),
				),
				'text'   => array(
					'title'  => __( 'Text', 'fl-builder' ),
					'fields' => array(
						'text_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'fl-builder' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'text_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'fl-builder' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'typography'       => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'fl-builder' ),
							'responsive' => true,
						),
					),
				),
				'colors' => array(
					'title'  => __( 'Background', 'fl-builder' ),
					'fields' => array(
						'bg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'fl-builder' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'bg_hover_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'fl-builder' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'style'             => array(
							'type'    => 'select',
							'label'   => __( 'Background Style', 'fl-builder' ),
							'default' => 'flat',
							'options' => array(
								'flat'     => __( 'Flat', 'fl-builder' ),
								'gradient' => __( 'Gradient', 'fl-builder' ),
							),
						),
						'button_transition' => array(
							'type'    => 'select',
							'label'   => __( 'Background Animation', 'fl-builder' ),
							'default' => 'disable',
							'options' => array(
								'disable' => __( 'Disabled', 'fl-builder' ),
								'enable'  => __( 'Enabled', 'fl-builder' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'border' => array(
					'title'  => __( 'Border', 'fl-builder' ),
					'fields' => array(
						'border'             => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'fl-builder' ),
							'responsive' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'border_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'fl-builder' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
	),
));
