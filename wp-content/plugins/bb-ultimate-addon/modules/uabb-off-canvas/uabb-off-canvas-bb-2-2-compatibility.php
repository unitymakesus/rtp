<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Off Canvas
 */

FLBuilder::register_module(
	'UABBOffCanvasModule',
	array(
		'general'                    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'general'                    => array(
					'title'  => __( 'Content', 'uabb' ),
					'fields' => array(
						'preview_off_canvas' => array(
							'type'    => 'select',
							'label'   => __( 'Preview Off Canvas', 'uabb' ),
							'default' => '1',
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
							'help'    => __( 'If enabled, you will see preview of Off Canvas at backend. This option is just for preview purpose.', 'uabb' ),
						),
						'content_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Content Type', 'uabb' ),
							'default' => 'content',
							'options' => array(
								'content'              => __( 'Content', 'uabb' ),
								'menu'                 => __( 'Menu', 'uabb' ),
								'saved_rows'           => array(
									'label'   => __( 'Saved Rows', 'uabb' ),
									'premium' => true,
								),
								'saved_modules'        => array(
									'label'   => __( 'Saved Modules', 'uabb' ),
									'premium' => true,
								),
								'saved_page_templates' => array(
									'label'   => __( 'Saved Page Templates', 'uabb' ),
									'premium' => true,
								),
							),
							'toggle'  => array(
								'menu'                 => array(
									'fields'   => array( 'wp_menu', 'close_on_link' ),
									'sections' => array( 'section_menu_style', 'menu_typography' ),
								),
								'content'              => array(
									'fields'   => array( 'ct_content' ),
									'sections' => array( 'content_typography', 'section_content_style' ),
								),
								'saved_rows'           => array(
									'fields' => array( 'ct_saved_rows' ),
								),
								'saved_modules'        => array(
									'fields' => array( 'ct_saved_modules' ),
								),
								'saved_page_templates' => array(
									'fields' => array( 'ct_page_templates' ),
								),
							),
						),
						'wp_menu'            => UABBOffCanvasModule::render_menus(),
						'ct_content'         => array(
							'type'        => 'editor',
							'label'       => '',
							'default'     => 'Dignissim molestiae ipsam minima sunt, reiciendis aliqua consectetur! Qui euismod, ipsa. Illum cumque? Dis. Nisl erat temporibus? Nascetur arcu rerum donec, nonummy proin eveniet exercitationem! Nam, senectus, nihil! Interdum? Quasi ut quidem, urna suscipit tristique nunc, iaculis fermentum deleniti. Amet consectetuer nulla. Ducimus hic. Turpis dolores occaecat necessitatibus aute aliquam? Eveniet ultricies dictumst aliquet accusamus, officiis morbi sapien occaecati cras, aperiam vestibulum, officiis qui quidem minim scelerisque explicabo, mi inceptos pulvinar quo diamlorem phasellus ut fugit perferendis dui nesciunt nobis, venenatis egestas aliquet cubilia! Fringilla, a aliqua veritatis aliquid cubilia sed, natus? Venenatis asperiores, sapiente error erat do auctor mollitia.',
							'connections' => array( 'string', 'html' ),
						),
						'ct_saved_rows'      => array(
							'type'    => 'select',
							'label'   => __( 'Select Row', 'uabb' ),
							'options' => array(),
						),
						'ct_saved_modules'   => array(
							'type'    => 'select',
							'label'   => __( 'Select Module', 'uabb' ),
							'options' => array(),
						),
						'ct_page_templates'  => array(
							'type'    => 'select',
							'label'   => __( 'Select Page Template', 'uabb' ),
							'options' => array(),
						),
					),
				),
				'section_offcanvas_controls' => array(
					'title'  => __( 'Off - Canvas', 'uabb' ),
					'fields' => array(
						'offcanvas_width'    => array(
							'type'       => 'unit',
							'default'    => '300',
							'responsive' => true,
							'label'      => __( 'Width', 'uabb' ),
							'units'      => array( 'px', '%' ),
							'slider'     => array(
								'step' => 1,
								'max'  => 1000,
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas.uabb-off-canvas-show',
								'property' => 'width',
								'units'    => 'px',
							),
						),
						'offcanvas_position' => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
							),
						),
						'offcanvas_type'     => array(
							'type'    => 'select',
							'label'   => __( 'Animation Effect', 'uabb' ),
							'default' => 'noraml',
							'options' => array(
								'noraml' => __( 'Slide', 'uabb' ),
								'push'   => __( 'Push', 'uabb' ),
							),
						),
						'page_overlay'       => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'default'     => 'rgba(0,0,0,0.75)',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-offcanvas-overlay',
										'property' => 'background',
									),
								),
							),
						),
						'close_on_link'      => array(
							'type'    => 'select',
							'label'   => __( 'Close Off Canvas on Menu Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'section_close'              => array(
					'title'  => __( 'Close Button', 'uabb' ),
					'fields' => array(
						'close_icon'                 => array(
							'type'    => 'icon',
							'label'   => __( 'Icon', 'uabb' ),
							'default' => 'fas fa-times',
						),
						'close_inside_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Alignment', 'uabb' ),
							'default' => 'right-top',
							'options' => array(
								'left-top'  => __( 'Left Top', 'uabb' ),
								'right-top' => __( 'Right Top', 'uabb' ),
							),
						),
						'close_icon_size'            => array(
							'type'    => 'unit',
							'label'   => __( 'Icon Size', 'uabb' ),
							'default' => '20',
							'units'   => array( 'px' ),
							'slider'  => true,
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-close .uabb-offcanvas-close-icon',
								'property' => 'font-size',
								'units'    => 'px',
							),
						),
						'close_icon_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-close .uabb-offcanvas-close-icon',
								'property' => 'color',
							),
						),
						'close_icon_bg_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => 'efefef',
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-close',
								'property' => 'background',
							),
						),
						'close_icon_padding'         => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'close_icon_margin'          => array(
							'type'       => 'dimension',
							'label'      => __( 'Margin', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
						'esc_keypress'               => array(
							'type'    => 'select',
							'label'   => __( 'Close on ESC', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
						'overlay_click'              => array(
							'type'    => 'select',
							'label'   => __( 'Close on Overlay Click', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'offcanvas_display_settings' => array(
			'title'    => __( 'Display Settings', 'uabb' ),
			'sections' => array(
				'modal_sec'        => array( // Section.
					'fields' => array( // Section Fields.
						'offcanvas_on' => array(
							'type'    => 'select',
							'label'   => __( 'Display On', 'uabb' ),
							'default' => 'button',
							'options' => array(
								'icon'   => __( 'Icon', 'uabb' ),
								'photo'  => __( 'Image', 'uabb' ),
								'text'   => __( 'Text', 'uabb' ),
								'button' => __( 'Button', 'uabb' ),
								'custom' => __( 'Custom Class / ID', 'uabb' ),
							),
							'toggle'  => array(
								'icon'   => array(
									'fields'   => array( 'all_align' ),
									'sections' => array( 'offcanvas_icon' ),
								),
								'photo'  => array(
									'fields'   => array( 'all_align' ),
									'sections' => array( 'offcanvas_photo' ),
								),
								'text'   => array(
									'fields'   => array( 'all_align' ),
									'sections' => array( 'offcanvas_text', 'title_typography' ),
								),
								'button' => array(
									'sections' => array( 'btn-general', 'btn-link', 'btn-style', 'btn-icon', 'btn-colors', 'btn-structure', 'btn_typography' ),
								),
								'custom' => array(
									'sections' => array( 'offcanvas_custom' ),
								),
							),
						),
						'all_align'    => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'left',
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-photo-wrap,.uabb-offcanvas-text-wrap,.uabb-offcanvas-icon-wrap',
								'property' => 'text-align',
							),
							'help'       => __( 'To align Icon/Image/text use this settings', 'uabb' ),
						),
					),
				),
				'offcanvas_icon'   => array(
					'title'  => __( 'Icon', 'uabb' ),
					'fields' => array(
						'icon'                => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'fas fa-bars',
							'show_remove' => true,
						),
						'icon_size'           => array(
							'type'      => 'unit',
							'label'     => __( 'Size', 'uabb' ),
							'default'   => '30',
							'maxlength' => '5',
							'size'      => '6',
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-icon-wrap .uabb-offcanvas-icon',
								'property' => 'font-size',
								'units'    => 'px',
							),
						),
						'icon_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-icon-wrap .uabb-offcanvas-icon',
								'property' => 'color',
							),
						),
						'icon_hover_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-icon-wrap .uabb-offcanvas-icon',
								'property' => 'Background',
							),
						),
						'icon_bg_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_padding'        => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-icon-wrap .uabb-offcanvas-icon',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'offcanvas_photo'  => array(
					'title'  => __( 'Image', 'uabb' ),
					'fields' => array(
						'photo'              => array(
							'type'        => 'photo',
							'label'       => __( 'Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'img_size'           => array(
							'type'      => 'unit',
							'label'     => __( 'Size', 'uabb' ),
							'default'   => '',
							'maxlength' => '5',
							'size'      => '6',
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-photo-wrap .uabb-offcanvas-photo',
								'property' => 'width',
							),
						),
						'img_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Image Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-photo-wrap .uabb-offcanvas-photo',
								'property' => 'Background',
							),
						),
						'img_bg_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Image Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'img_padding'        => array(
							'type'       => 'unit',
							'label'      => __( 'Background Size', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-photo-wrap',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'offcanvas_text'   => array( // Section.
					'title'  => __( 'Text', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'offcanvas_text'   => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Click Here', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-offcanvas-text-wrap',
							),
						),
						'text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-text-wrap',
								'property' => 'color',
							),
						),
						'text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
					),
				),

				/* Button Start */
				'btn-general'      => array( // Section.
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'btn_text' => array(
							'type'        => 'text',
							'label'       => __( 'Button Text', 'uabb' ),
							'default'     => __( 'Click Here', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-creative-button-text',
							),
						),
					),
				),
				'btn-style'        => array(
					'title'  => __( 'Button Styles', 'uabb' ),
					'fields' => array(
						'btn_style'                      => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'class'   => 'creative_button_styles',
							'options' => array(
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'threed'      => __( '3D', 'uabb' ),
							),
						),
						'btn_border_size'                => array(
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '2',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'btn_transparent_button_options' => array(
							'type'    => 'select',
							'label'   => __( 'Background Hover Styles', 'uabb' ),
							'default' => 'transparent-fade',
							'options' => array(
								'none'                    => __( 'None', 'uabb' ),
								'transparent-fade'        => __( 'Fade Background', 'uabb' ),
								'transparent-fill-top'    => __( 'Fill Background From Top', 'uabb' ),
								'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
								'transparent-fill-left'   => __( 'Fill Background From Left', 'uabb' ),
								'transparent-fill-right'  => __( 'Fill Background From Right', 'uabb' ),
								'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
								'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
								'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
							),
						),
						'btn_threed_button_options'      => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'threed_down',
							'options' => array(
								'threed_down'    => __( 'Move Down', 'uabb' ),
								'threed_up'      => __( 'Move Up', 'uabb' ),
								'threed_left'    => __( 'Move Left', 'uabb' ),
								'threed_right'   => __( 'Move Right', 'uabb' ),
								'animate_top'    => __( 'Animate Top', 'uabb' ),
								'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
							),
						),
					),
				),
				'btn-icon'         => array( // Section.
					'title'  => __( 'Button Icons', 'uabb' ),
					'fields' => array(
						'btn_icon'          => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'btn_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
					),
				),
				'btn-colors'       => array( // Section.
					'title'  => __( 'Button Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '54595f',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a.uabb-button *',
								'property' => 'color',
							),
						),
						'btn_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'e0e0e0',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-flat-btn',
										'property' => 'background',
									),
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-transparent-btn',
										'property' => 'border-color',
									),
								),
							),
						),
						'btn_bg_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'btn-structure'    => array(
					'title'  => __( 'Button Structure', 'uabb' ),
					'fields' => array(
						'btn_width'                => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'btn_align', 'btn_mob_align' ),
								),
								'full'   => array(
									'fields' => array(),
								),
								'custom' => array(
									'fields' => array( 'btn_align', 'btn_mob_align', 'btn_custom_width', 'btn_custom_height', 'btn_padding_top_bottom', 'btn_padding_left_right' ),
								),
							),
						),
						'button_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_custom_width'         => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Width', 'uabb' ),
							'default'   => '200',
							'maxlength' => '3',
							'size'      => '4',
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'btn_custom_height'        => array(
							'type'      => 'unit',
							'label'     => __( 'Custom Height', 'uabb' ),
							'default'   => '45',
							'maxlength' => '3',
							'size'      => '4',
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'min-height',
								'unit'     => 'px',
							),
						),
						'btn_padding_top_bottom'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
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
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'padding-top',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'padding-bottom',
										'unit'     => 'px',
									),
								),
							),
						),
						'btn_padding_left_right'   => array(
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
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
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'padding-left',
										'unit'     => 'px',
									),
									array(
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'padding-right',
										'unit'     => 'px',
									),
								),
							),
						),
						'btn_border_radius'        => array(
							'type'      => 'unit',
							'label'     => __( 'Round Corners', 'uabb' ),
							'maxlength' => '3',
							'size'      => '4',
							'units'     => array( 'px' ),
							'slider'    => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'   => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'btn_align'                => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-modal-action-wrap, .uabb-button-wrap',
								'property' => 'text-align',
							),
						),
						'btn_mob_align'            => array(
							'type'    => 'align',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
						),
					),
				),
				/* Button End */
				'offcanvas_custom' => array( // Section.
					'title'  => __( 'Custom', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'off_canvas_custom' => array(
							'type'        => 'text',
							'label'       => __( 'Class and/or ID', 'uabb' ),
							'default'     => '',
							'placeholder' => '',
							'help'        => __( 'Add .Class and/or #ID to open your modal. Multiple ID or Classes separated by comma.', 'uabb' ),
						),
					),
				),
			),
		),
		'style'                      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'formatting'            => array(
					'title'  => __( 'Off Canvas', 'uabb' ),
					'fields' => array(
						'offcanvas_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas',
								'property' => 'background',
							),
						),
						'offcanvas_spacing'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Content Padding', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'section_content_style' => array(
					'title'  => __( 'Content Style', 'uabb' ),
					'fields' => array(
						'content_align'       => array(
							'type'    => 'align',
							'label'   => __( 'Content Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-text-content',
								'property' => 'text-align',
							),
						),
						'content_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Content Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-text-content',
								'property' => 'color',
							),
						),
						'content_color_hover' => array(
							'type'        => 'color',
							'label'       => __( 'Content Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
				'section_menu_style'    => array(
					'title'  => __( 'Menu', 'uabb' ),
					'fields' => array(
						'menu_padding'        => array(
							'type'       => 'dimension',
							'label'      => __( 'Link Padding', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'default'    => '10',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-menu .menu-item a',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'menu_margin'         => array(
							'type'       => 'dimension',
							'label'      => __( 'Link Margin', 'uabb' ),
							'maxlength'  => '3',
							'units'      => array( 'px' ),
							'size'       => '4',
							'default'    => '10',
							'responsive' => true,
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-content .uabb-offcanvas-menu li',
								'property' => 'margin',
								'unit'     => 'px',
							),
						),
						'menu_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Link Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-menu .menu-item a',
								'property' => 'color',
							),
						),
						'menu_color_hover'    => array(
							'type'        => 'color',
							'label'       => __( 'Link Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
						'menu_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Link Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-menu .menu-item a',
								'property' => 'background',
							),
						),
						'menu_bg_color_hover' => array(
							'type'        => 'color',
							'label'       => __( 'Link Background Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
			),
		),
		'creative_typography'        => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'content_typography' => array(
					'title'  => __( 'Content Typography', 'uabb' ),
					'fields' => array(
						'content_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-text-content',
							),
						),
					),
				),
				'menu_typography'    => array(
					'title'  => __( 'Menu Typography', 'uabb' ),
					'fields' => array(
						'menu_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-menu',
							),
						),
					),
				),
				'btn_typography'     => array(
					'title'  => __( 'Button Typography', 'uabb' ),
					'fields' => array(
						'btn_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a,.uabb-creative-button-wrap a:visited',
							),
						),
					),
				),
				'title_typography'   => array(
					'title'  => __( 'Off Canvas Appear On - Text Typography', 'uabb' ),
					'fields' => array(
						'title_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-offcanvas-text-wrap',
							),
						),
					),
				),
			),
		),
		'uabb_docs'                  => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/off-canvas-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=off-canvas-module" target="_blank" rel="noopener"> Getting started article </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/design-off-canvas-menu-for-beaver-builder/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=off-canvas-module" target="_blank" rel="noopener"> How to Design an Off-Canvas menu for Beaver Builder? ( Learn in 3 Easy Steps! ) </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/trigger-off-canvas-from-any-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=off-canvas-module" target="_blank" rel="noopener"> How to trigger Off-Canvas from any Beaver Builder module? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
