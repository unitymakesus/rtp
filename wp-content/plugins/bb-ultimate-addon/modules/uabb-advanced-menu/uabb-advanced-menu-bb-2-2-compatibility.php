<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 *  @package UABB Creative Menu
 */

FLBuilder::register_module(
	'UABBCreativeMenu', array(
		'general'    => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'wp_menu'                       => UABBCreativeMenu::render_menus(),
						'creative_menu_layout'          => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
								'accordion'  => __( 'Accordion', 'uabb' ),
								'expanded'   => __( 'Expanded', 'uabb' ),
							),
							'toggle'  => array(
								'horizontal' => array(
									'fields' => array( 'creative_submenu_hover_toggle', 'menu_align' ),
								),
								'vertical'   => array(
									'fields' => array( 'creative_submenu_hover_toggle' ),
								),
								'accordion'  => array(
									'fields' => array( 'creative_submenu_click_toggle', 'creative_menu_collapse' ),
								),
							),
						),
						'creative_submenu_hover_toggle' => array(
							'type'    => 'select',
							'label'   => __( 'Submenu Icon', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'arrows' => __( 'Arrows', 'uabb' ),
								'plus'   => __( 'Plus Sign', 'uabb' ),
								'none'   => __( 'None', 'uabb' ),
							),
						),
						'creative_submenu_click_toggle' => array(
							'type'    => 'select',
							'label'   => __( 'Submenu Icon click', 'uabb' ),
							'default' => 'arrows',
							'options' => array(
								'arrows' => __( 'Arrows', 'uabb' ),
								'plus'   => __( 'Plus Sign', 'uabb' ),
							),
						),
						'creative_menu_collapse'        => array(
							'type'    => 'select',
							'label'   => __( 'Collapse Inactive', 'uabb' ),
							'default' => '1',
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Choosing yes will keep only one item open at a time. Choosing no will allow multiple items to be open at the same time.', 'uabb' ),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'menu'       => array( // Tab.
			'title'    => __( 'Menu', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'                       => array( // Section.
					'title'  => __( 'Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'creative_menu_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Menu Alignment', 'uabb' ),
							'default' => 'center',
						),
						'creative_menu_link_margin_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Link Margin', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .menu > li',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'creative_menu_link_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Link Padding', 'uabb' ),
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu.uabb-menu-default .menu > li > a,.uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container > a,.uabb-creative-menu.off-canvas .menu > li > a,.uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a,.uabb-creative-menu.full-screen .menu > li > a,.uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'creative_menu_color_settings'  => array( // Section.
					'title'  => __( 'Color Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'creative_menu_link_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Link Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => '',
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > .uabb-has-submenu-container > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a span.uabb-menu-toggle:before, .uabb-creative-menu.uabb-menu-default .menu > li > a, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a, .uabb-creative-menu.uabb-menu-default .menu > li > a span.menu-item-text, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a span.menu-item-text, .uabb-creative-menu.uabb-menu-default .menu > li > a span.menu-item-text:before, .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container a span.menu-item-text:before',
								'property'  => 'color',
								'important' => true,
							),
						),
						'creative_menu_link_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Link Hover Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => '',
							'show_reset'  => true,
						),
						'creative_menu_background_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'creative_menu_background_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
					),
				),
				'creative_menu_border_settings' => array( // Section.
					'title'  => __( 'Border Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'menu_border'                      => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .menu > li > a, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a',
								'important' => true,
							),
						),
						'creative_menu_border_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .menu > li > a:hover, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a:hover, .uabb-creative-menu .menu > li > a:focus, .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a:focus',
								'property'  => 'border-color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'submenu'    => array( // Tab.
			'title'    => __( 'Submenu', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'creative_menu_submenu_style'         => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'creative_submenu_link_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-menu .sub-menu > li > a, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
								'property' => 'padding',
								'unit'     => 'px',
							),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
						),
						'submenu_width' => array(
							'type'    => 'unit',
							'label'   => __( 'Width', 'uabb' ),
							'default' => '220',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu:not(.off-canvas) :not(.full-screen) .sub-menu',
								'property'  => 'min-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'creative_menu_submenu_color'         => array(
					'title'  => __( 'Color Settings', 'uabb' ),
					'fields' => array(
						'creative_submenu_link_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'label'       => __( 'Link Color', 'uabb' ),
							'default'     => '333333',
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.sub-menu > li > a *, .sub-menu > li > .uabb-has-submenu-container > a *,.uabb-creative-menu .sub-menu > li.uabb-creative-menu > a > span',
								'property'  => 'color',
								'important' => true,
							),
						),
						'creative_submenu_link_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Link Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
						),
						'creative_submenu_background_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'edecec',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'creative_submenu_background_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => 'f5f5f5',
							'show_reset'  => true,
							'show_alpha'  => true,
						),
					),
				),
				'creative_menu_shadow_style'          => array(
					'title'  => __( 'Shadow Settings', 'uabb' ),
					'fields' => array(
						'creative_submenu_drop_shadow'  => array(
							'type'    => 'select',
							'label'   => __( 'Drop Shadow', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'creative_submenu_shadow_color_hor', 'creative_submenu_shadow_color_ver', 'creative_submenu_shadow_color_blur', 'creative_submenu_shadow_color_spr', 'creative_submenu_shadow_color', 'creative_submenu_shadow_color_opc' ),
								),
							),
						),
						'creative_submenu_shadow_color_hor' => array(
							'type'    => 'unit',
							'label'   => __( 'Horizontal Length', 'uabb' ),
							'default' => '2',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'creative_submenu_shadow_color_ver' => array(
							'type'    => 'unit',
							'label'   => __( 'Vertical Length', 'uabb' ),
							'default' => '2',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'creative_submenu_shadow_color_blur' => array(
							'type'    => 'unit',
							'label'   => __( 'Blur Radius', 'uabb' ),
							'default' => '4',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'creative_submenu_shadow_color_spr' => array(
							'type'    => 'unit',
							'label'   => __( 'Spread Radius', 'uabb' ),
							'default' => '1',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
						'creative_submenu_shadow_color' => array(
							'type'        => 'color',
							'label'       => __( 'Shadow Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => '000000',
							'show_reset'  => true,
						),
						'creative_submenu_shadow_color_opc' => array(
							'type'        => 'unit',
							'label'       => __( 'Shadow Color Opacity', 'uabb' ),
							'default'     => '30',
							'placeholder' => '100',
							'slider'      => true,
							'units'       => array( '%' ),
						),

					),
				),
				'creative_submenu_border_settings'    => array( // Section.
					'title'  => __( 'Border Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'creative_submenu_border_settings_option' => array(
							'type'    => 'select',
							'label'   => __( 'Show Border', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'submenu_border' ),
								),
							),
						),
						'submenu_border' => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'	 => array(
								'style'		=> 'solid',
								'color'		=> '000000',
								'width'		=> array(
									'top'	 => '1',
									'right'	 => '1',
									'bottom' => '1',
									'left'	 => '1',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .sub-menu',
								'important' => true,
							),
						),
					),
				),
				'creative_submenu_separator_settings' => array(
					'title'  => __( 'Separator Settings', 'uabb' ),
					'fields' => array(
						'creative_submenu_separator_settings_option' => array(
							'type'    => 'select',
							'label'   => __( 'Show Separator', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'creative_submenu_separator_style', 'creative_submenu_separator_size', 'creative_submenu_separator_color' ),
								),
							),
						),
						'creative_submenu_separator_style' => array(
							'type'    => 'select',
							'label'   => __( 'Separator Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .sub-menu > li',
								'property'  => 'border-bottom-style',
								'important' => true,
							),
						),
						'creative_submenu_separator_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Separator Size', 'uabb' ),
							'default' => '1',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .sub-menu > li, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
								'property'  => 'border-bottom-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'creative_submenu_separator_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Separator Color', 'uabb' ),
							'default'     => 'e3e2e3',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .sub-menu > li, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
								'property'  => 'border-bottom-color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'responsive' => array( // Tab.
			'title'    => __( 'Responsive', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'creative_menu_responsive_navigation_style' => array(
					'title'  => __( 'Responsive Navigation', 'uabb' ),
					'fields' => array(
						'creative_menu_mobile_toggle'      => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Navigation', 'uabb' ),
							'default' => 'hamburger',
							'options' => array(
								'hamburger'       => __( 'Hamburger Icon', 'uabb' ),
								'hamburger-label' => __( 'Hamburger Icon + Label', 'uabb' ),
								'text'            => __( 'Menu Button', 'uabb' ),
								'expanded'        => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'hamburger'       => array(
									'fields'   => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color', 'creative_menu_navigation_alignment' ),
									'sections' => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' ),
								),
								'hamburger-label' => array(
									'fields'   => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color', 'creative_menu_mobile_toggle_text', 'creative_menu_navigation_alignment' ),
									'sections' => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' ),
								),
								'text'            => array(
									'fields'   => array( 'creative_mobile_menu_type', 'creative_menu_mobile_breakpoint', 'creative_menu_responsive_alignment', 'creative_menu_mobile_toggle_color', 'creative_menu_mobile_toggle_text', 'creative_menu_navigation_alignment' ),
									'sections' => array( 'creative_menu_responsive_mobile_style', 'creative_menu_responsive_style' ),
								),
								'expanded'        => array(
									'fields'   => array( 'creative_menu_responsive_alignment' ),
									'sections' => array( 'creative_menu_responsive_style' ),
								),
							),
						),
						'creative_menu_mobile_toggle_text' => array(
							'type'        => 'text',
							'label'       => __( 'Navigation Label', 'uabb' ),
							'default'     => '',
							'placeholder' => __( 'Menu', 'uabb' ),
							'connections' => array( 'string' ),
						),
						'creative_menu_mobile_toggle_color' => array(
							'type'        => 'color',
							'label'       => __( 'Navigation Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu-mobile-toggle',
								'property'  => 'color',
								'important' => true,
							),
						),
						'creative_menu_navigation_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Navigation Alignment', 'uabb' ),
							'default' => 'center',
							'responsive' => true,
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu-mobile-toggle-container, .uabb-creative-menu-mobile-toggle-container > .uabb-creative-menu-mobile-toggle.text',
								'property'  => 'text-align',
								'important' => true,
							),
						),
					),
				),
				'creative_menu_responsive_mobile_style' => array(
					'title'  => __( 'Responsive Layout', 'uabb' ),
					'fields' => array(
						'creative_mobile_menu_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Layout', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default'     => __( 'Accordion', 'uabb' ),
								'full-screen' => __( 'Overlay', 'uabb' ),
								'off-canvas'  => __( 'Off Canvas', 'uabb' ),
								'below-row'   => __( 'Below Row', 'uabb' ),
							),
							'toggle'  => array(
								'off-canvas'  => array(
									'fields'   => array( 'creative_menu_responsive_link_color', 'creative_menu_responsive_link_hover_color', 'creative_menu_responsive_link_border_color', 'creative_menu_offcanvas_direction', 'creative_menu_animation_speed', 'creative_menu_responsive_overlay_bg_color', 'creative_menu_responsive_overlay_padding_dimension', 'creative_menu_close_icon_size', 'creative_menu_close_icon_color', 'creative_menu_responsive_overlay_color', 'creative_menu_off_canvas_shadow', 'creative_menu_responsive_toggle' ),
									'sections' => array( 'creative_menu_responsive_close_style' ),
								),
								'full-screen' => array(
									'fields'   => array( 'creative_menu_responsive_link_color', 'creative_menu_responsive_link_hover_color', 'creative_menu_responsive_link_border_color', 'creative_menu_full_screen_effects', 'creative_menu_animation_speed', 'creative_menu_responsive_overlay_bg_color', 'creative_menu_close_icon_size', 'creative_menu_close_icon_color', 'creative_menu_responsive_toggle' ),
									'sections' => array( 'creative_menu_responsive_close_style' ),
								),
							),
						),
						'creative_menu_full_screen_effects' => array(
							'type'    => 'select',
							'label'   => __( 'Effects', 'uabb' ),
							'default' => 'fade',
							'options' => array(
								'fade'       => __( 'Fade', 'uabb' ),
								'slide-down' => __( 'Slide Down', 'uabb' ),
								'scale'      => __( 'Scale', 'uabb' ),
								'door'       => __( 'Door', 'uabb' ),
							),
						),
						'creative_menu_offcanvas_direction' => array(
							'type'    => 'select',
							'label'   => __( 'Direction', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'From Left', 'uabb' ),
								'right' => __( 'From Right', 'uabb' ),
							),
						),
						'creative_menu_animation_speed'   => array(
							'type'    => 'unit',
							'label'   => __( 'Animation Speed', 'uabb' ),
							'default' => 500,
							'slider'  => true,
							'units'   => array( 'ms' ),
						),
						'creative_menu_mobile_breakpoint' => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Breakpoint', 'uabb' ),
							'default' => 'mobile',
							'options' => array(
								'always'        => __( 'Display on All Devices', 'uabb' ),
								'medium-mobile' => __( 'Display on Medium & Small Devices Only', 'uabb' ),
								'mobile'        => __( 'Display on Small Devices Only', 'uabb' ),
								'custom'        => __( 'Enter Custom Breakpoint', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields'   => array( 'custom_breakpoint' ),
									'sections' => array(),
								),
							),
						),
						'custom_breakpoint'               => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Breakpoint', 'uabb' ),
							'default' => '768',
							'slider'  => true,
							'units'   => array( 'px' ),
						),
					),
				),
				'creative_menu_responsive_style'        => array(
					'title'  => __( 'Styling', 'uabb' ),
					'fields' => array(
						'creative_menu_responsive_overlay_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'creative_menu_responsive_link_color' => array(
							'type'        => 'color',
							'label'       => __( 'Link Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-creative-menu.full-screen .menu li a span.menu-item-text, .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a span.menu-item-text, .uabb-creative-menu.off-canvas .menu li a span.menu-item-text, .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-item-text',
										'property'  => 'color',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-menu-toggle:before, .uabb-creative-menu.off-canvas .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before, .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-menu-toggle:before,
									.uabb-creative-menu.off-canvas .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
									 .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-menu-toggle:before, .uabb-creative-menu.full-screen .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before',
										'property'  => 'color',
										'important' => true,
									),
								),
							),
						),
						'creative_menu_responsive_link_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Link Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
						),
						'creative_menu_responsive_link_border_color' => array(
							'type'        => 'color',
							'label'       => __( 'Submenu Separator Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu.full-screen .sub-menu li, .uabb-creative-menu.off-canvas .sub-menu li',
								'property'  => 'border-bottom-color',
								'important' => true,
							),
						),
						'creative_menu_responsive_overlay_color' => array(
							'type'        => 'color',
							'label'       => __( 'Off Canvas Overlay Color', 'uabb' ),
							'default'     => 'rgba(0,0,0,0)',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'creative_menu_responsive_overlay_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Off Canvas Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
						),
						'creative_menu_off_canvas_shadow' => array(
							'type'    => 'select',
							'label'   => __( 'Off Canvas Shadow', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'creative_menu_off_canvas_shadow_color' ),
								),
							),
						),
						'creative_menu_off_canvas_shadow_color' => array(
							'type'        => 'color',
							'label'       => __( 'Off Canvas Shadow Color', 'uabb' ),
							'default'     => 'rgba(0,0,0,.5)',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
						),
						'creative_menu_responsive_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
						),
						'creative_menu_responsive_toggle' => array(
							'type'    => 'select',
							'label'   => __( 'Submenu Icon', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'arrows'  => __( 'Arrows', 'uabb' ),
								'plus'    => __( 'Plus Sign', 'uabb' ),
							),
						),
					),
				),
				'creative_menu_responsive_close_style'  => array(
					'title'  => __( 'Close Icon', 'uabb' ),
					'fields' => array(
						'creative_menu_close_icon_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Close Icon Size', 'uabb' ),
							'placeholder' => '30',
							'slider'      => true,
							'units'       => array( 'px' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-close-btn',
										'property'  => 'font-size',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:before, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:after',
										'property'  => 'height',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'creative_menu_close_icon_color' => array(
							'type'        => 'color',
							'label'       => __( 'Close Icon Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:before, .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn:after',
										'property'  => 'background-color',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn',
										'property'  => 'color',
										'important' => true,
									),
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
				'link_typography'         => array(
					'title'  => __( 'Menu Typography', 'uabb' ),
					'fields' => array(
						'creative_menu_link_typo'      => array(
							'type'    => 'select',
							'label'   => __( 'Typography', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'creative_menu_link_font_typo' ),
								),
							),
						),
						'creative_menu_link_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.menu > li > a, .menu > li > .uabb-has-submenu-container > a, .uabb-creative-menu-mobile-toggle-label',
								'important' => true,
							),
						),
					),
				),
				'submenu_link_typography' => array(
					'title'  => __( 'Submenu Typography', 'uabb' ),
					'fields' => array(
						'creative_submenu_link_typogarphy' => array(
							'type'    => 'select',
							'label'   => __( 'Typography', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'creative_submenu_link_font_typo' ),
								),
							),
						),
						'creative_submenu_link_font_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-menu .sub-menu a, .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a',
								'important' => true,
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
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/overlay-effect-advanced-menu/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=advanced-menu-module" target="_blank" rel="noopener"> Overlay Effect in Advanced Menu </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/off-canvas-effect-advanced-menu/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=advanced-menu-module" target="_blank" rel="noopener"> Off Canvas Effect in Advanced Menu </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);
