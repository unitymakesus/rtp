<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Login Form Module
 */

FLBuilder::register_module(
	'UABBLoginForm',
	array(
		'general'    => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'custom_wp_login_section'    => array( // Section.
					'title'  => __( 'Custom WP Login', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'wp_login_select'      => array(
							'type'    => 'select',
							'label'   => __( 'Enable Custom WP Login', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'username_label', 'username_placeholder', 'password_label', 'password_placeholder', 'input_field_width', 'form_end_text_spacing', 'label_bottom_margin', 'row_gap', 'columns_gap' ),
									'sections' => array( 'general_form_settings', 'input-style', 'checkbox_style', 'error_msg_style', 'wp_login_button_styling', 'after_submit_form_settings' ),
									'tabs'     => array( 'typography' ),
								),
							),
						),
						'username_label'       => array(
							'type'        => 'text',
							'label'       => __( 'Username Label', 'uabb' ),
							'default'     => 'Username or Email Address',
							'connections' => array( 'string', 'html' ),
						),
						'username_placeholder' => array(
							'type'        => 'text',
							'label'       => __( 'Username Placeholder', 'uabb' ),
							'default'     => 'Username or Email Address',
							'connections' => array( 'string', 'html' ),
						),
						'password_label'       => array(
							'type'        => 'text',
							'label'       => __( 'Password Label', 'uabb' ),
							'default'     => 'Password',
							'connections' => array( 'string', 'html' ),
						),
						'password_placeholder' => array(
							'type'        => 'text',
							'label'       => __( 'Password Placeholder', 'uabb' ),
							'default'     => 'Password',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'general_form_settings'      => array( // Section.
					'title'  => __( 'General Form Settings', 'uabb' ), // Section Title.
					'fields' => array(
						'lost_your_password_select'        => array(
							'type'    => 'select',
							'label'   => __( 'Enable Lost your password', 'uabb' ),
							'default' => 'disable',
							'options' => array(
								'enable'  => __( 'Yes', 'uabb' ),
								'disable' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'enable' => array(
									'fields'   => array( 'lost_your_password_text', 'lost_your_password_custom_select', 'form_end_text_spacing' ),
									'sections' => array( 'lost_your_pass_typography' ),
								),
							),
						),
						'lost_your_password_text'          => array(
							'type'        => 'text',
							'label'       => __( 'Lost your password Text', 'uabb' ),
							'default'     => 'Lost your password?',
							'connections' => array( 'string', 'html' ),
						),
						'lost_your_password_custom_select' => array(
							'type'    => 'select',
							'label'   => __( 'Lost your password URL', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'lost_your_password_url', '' ),
								),
							),
						),
						'lost_your_password_url'           => array(
							'type'        => 'link',
							'label'       => __( 'Custom Redirect URL', 'uabb' ),
							'default'     => '',
							'connections' => array( 'url' ),
						),
						'custom_link_select'               => array(
							'type'    => 'select',
							'label'   => __( 'Enable Regsiter Link', 'uabb' ),
							'default' => 'disable',
							'options' => array(
								'enable'  => __( 'Yes', 'uabb' ),
								'disable' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'enable' => array(
									'fields' => array( 'custom_link_text', 'custom_link_url' ),
								),
							),
						),
						'custom_link_text'                 => array(
							'type'        => 'text',
							'label'       => __( 'Custom Register Link Text', 'uabb' ),
							'default'     => 'Register | ',
							'connections' => array( 'string', 'html' ),
						),
						'custom_link_url'                  => array(
							'type'        => 'link',
							'label'       => __( 'Custom Register Link URL', 'uabb' ),
							'default'     => wp_registration_url(),
							'connections' => array( 'url' ),
						),
						'remember_me_select'               => array(
							'type'    => 'select',
							'label'   => __( 'Remember Me', 'uabb' ),
							'default' => 'enable',
							'options' => array(
								'enable'  => __( 'Enable', 'uabb' ),
								'disable' => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'enable' => array(
									'fields'   => array( 'remember_me_text' ),
									'sections' => array( 'checkbox_style' ),
								),
							),
						),
						'remember_me_text'                 => array(
							'type'        => 'text',
							'label'       => __( 'Remember Me Text', 'uabb' ),
							'default'     => 'Remember Me',
							'connections' => array( 'string', 'html' ),
						),
						'error_msg_select'                 => array(
							'type'    => 'select',
							'label'   => __( 'Error Message Position', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'top'    => __( 'Top of the Form', 'uabb' ),
								'bottom' => __( 'Bottom of the Form', 'uabb' ),
							),
						),
						'wp_login_btn_text'                => array(
							'type'        => 'text',
							'label'       => __( 'WP Login Button Text', 'uabb' ),
							'default'     => 'Log In',
							'connections' => array( 'string', 'html' ),
						),

					),
				),
				'after_submit_form_settings' => array( // Section.
					'title'  => __( 'Custom Redirects', 'uabb' ), // Section Title.
					'fields' => array(
						'wp_login_redirect_select'  => array(
							'type'    => 'select',
							'label'   => __( 'Redirect After Successful WordPress Login', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default Redirect URL', 'uabb' ),
								'custom'  => __( 'Custom Redirect URL', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'login_redirect_url' ),
								),
							),
						),
						'login_redirect_url'        => array(
							'type'        => 'link',
							'label'       => __( 'Custom Redirect URL', 'uabb' ),
							'default'     => '',
							'connections' => array( 'url' ),
						),
						'wp_logout_redirect_select' => array(
							'type'    => 'select',
							'label'   => __( 'Redirect After Successful WordPress Logout', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default Redirect URL', 'uabb' ),
								'custom'  => __( 'Custom Redirect URL', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'logout_redirect_url' ),
								),
							),
						),
						'logout_redirect_url'       => array(
							'type'        => 'link',
							'label'       => __( 'Custom Redirect URL', 'uabb' ),
							'default'     => '',
							'connections' => array( 'url' ),
						),
					),
				),
				'separator_settings'         => array( // Section.
					'title'  => __( 'Separator Settings', 'uabb' ), // Section Title.
					'fields' => array(
						'separator_select' => array(
							'type'    => 'select',
							'label'   => __( 'Separator', 'uabb' ),
							'default' => 'disable',
							'options' => array(
								'enable'  => __( 'Enable', 'uabb' ),
								'disable' => __( 'Disable', 'uabb' ),
							),
							'toggle'  => array(
								'enable' => array(
									'fields'   => array( 'separator_text' ),
									'sections' => array( 'separator_typography' ),
								),
							),
						),
						'separator_text'   => array(
							'type'        => 'text',
							'label'       => __( 'Separator Text', 'uabb' ),
							'default'     => 'OR',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'social'     => array( // Tab.
			'title'    => __( 'Social Login ', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'google'   => array( // Section.
					'title'  => __( 'Google', 'uabb' ), // SectionTitle.
					'fields' => array(

						'google_login_select' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Google Login', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'GoogleButton' ),
								),
							),
						),
					),
				),
				'facebook' => array( // Section.
					'title'  => __( 'Facebook', 'uabb' ), // Section Title.
					'fields' => array(
						'facebook_login_select' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Facebook Login', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'FacebookButton' ),
								),
							),
						),

					),
				),
			),
		),
		'style'      => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'form_style'              => array(
					'title'  => 'Form Style',
					'fields' => array(
						'form_bg_type'           => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'form_bg_color', 'form_bg_color_opc' ),
								),
								'gradient' => array(
									'fields' => array( 'form_bg_gradient' ),
								),
							),
						),
						'form_bg_gradient'       => array(
							'type'  => 'gradient',
							'label' => __( 'Gradient', 'uabb' ),
						),
						'form_bg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'form_spacing_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Form Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_align'             => array(
							'type'    => 'select',
							'label'   => __( 'Form Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'row_gap'                => array(
							'type'    => 'unit',
							'label'   => __( 'Row Gap', 'uabb' ),
							'slider'  => true,
							'default' => '10',
							'units'   => array( 'px' ),
						),
						'label_bottom_margin'    => array(
							'type'    => 'unit',
							'label'   => __( 'Label Bottom Spacing', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-label',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_end_text_spacing'  => array(
							'type'    => 'unit',
							'label'   => __( 'Lost your password Spacing', 'uabb' ),
							'slider'  => true,
							'default' => '5',
							'units'   => array( 'px' ),
						),
						'form_end_text_align'    => array(
							'type'    => 'select',
							'label'   => __( 'Lost your password Alignment', 'uabb' ),
							'default' => 'flex-start',
							'options' => array(
								'flex-start' => __( 'Left', 'uabb' ),
								'center'     => __( 'Center', 'uabb' ),
								'flex-end'   => __( 'Right', 'uabb' ),
							),
						),
					),
				),
				'input_style'             => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_field_width'         => array(
							'type'       => 'select',
							'label'      => __( 'Input Field Width', 'uabb' ),
							'responsive' => true,
							'default'    => '100',
							'options'    => array(
								'25'  => __( '25%', 'uabb' ),
								'34'  => __( '34%', 'uabb' ),
								'50'  => __( '50%', 'uabb' ),
								'66'  => __( '66%', 'uabb' ),
								'75'  => __( '75%', 'uabb' ),
								'100' => __( '100%', 'uabb' ),
							),
						),
						'input_padding'             => array(
							'type'       => 'dimension',
							'label'      => __( 'Input Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_background_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input',
								'property'  => 'background',
								'important' => true,
							),
						),
						'input_text_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input',
								'property'  => 'color',
								'important' => true,
							),
						),
						'input_border'              => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style'  => 'solid',
								'color'  => 'c4c4c4',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '2',
									'top_right'    => '2',
									'bottom_left'  => '2',
									'bottom_right' => '2',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input',
								'important' => true,
							),
						),
						'input_border_active_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Active Color', 'uabb' ),
							'default'     => 'a5afb8',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				'checkbox_style'          => array(
					'title'  => __( 'Checkbox Style', 'uabb' ),
					'fields' => array(
						'checkbox_size'           => array(
							'type'    => 'unit',
							'label'   => __( 'Size', 'uabb' ),
							'default' => '24',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group input[type="checkbox"] + span:before ',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group input[type="checkbox"] + span:before ',
										'property'  => 'height',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'checkbox_bgcolor'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group input[type="checkbox"] + span:before',
								'property'  => 'background',
								'important' => true,
							),
						),
						'checkbox_selected_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Checked Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'checkbox_border'         => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style'  => 'solid',
								'color'  => 'c4c4c4',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '2',
									'top_right'    => '2',
									'bottom_left'  => '2',
									'bottom_right' => '2',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group input[type="checkbox"] + span:before',
								'important' => true,
							),
						),
					),
				),
				'error_msg_style'         => array(
					'title'  => __( 'Error Message Style', 'uabb' ),
					'fields' => array(
						'errormsg_bgcolor'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'default'     => '#ffdfdf',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-error-message-wrap',
								'property'  => 'background',
								'important' => true,
							),
						),
						'errormsg_text_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '333333',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-error-message-wrap',
								'property'  => 'color',
								'important' => true,
							),
						),
						'errormsg_border'     => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style'  => 'solid',
								'color'  => 'ef9494',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '2',
									'top_right'    => '2',
									'bottom_left'  => '2',
									'bottom_right' => '2',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-error-message-wrap',
								'important' => true,
							),
						),
						'errormsg_padding'    => array(
							'type'       => 'dimension',
							'label'      => __( ' Padding', 'uabb' ),
							'default'    => '10',
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-error-message-wrap',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'wp_login_button_styling' => array( // Section.
					'title'  => __( 'WP Login Button Styling', 'uabb' ), // Section Title.
					'fields' => array(
						'wp_login_btn_col_width'           => array(
							'type'       => 'select',
							'label'      => __( 'Button Width', 'uabb' ),
							'responsive' => true,
							'default'    => '100',
							'options'    => array(
								'25'  => __( '25%', 'uabb' ),
								'34'  => __( '34%', 'uabb' ),
								'50'  => __( '50%', 'uabb' ),
								'66'  => __( '66%', 'uabb' ),
								'75'  => __( '75%', 'uabb' ),
								'100' => __( '100%', 'uabb' ),
							),
						),
						'wp_login_btn_align'               => array(
							'type'    => 'select',
							'label'   => __( 'Button Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'wp_login_btn_text_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'color',
								'important' => true,
							),
						),
						'wp_login_btn_text_hover_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'color',
								'important' => true,
							),
						),
						'wp_login_btn_background_type'     => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'options' => array(
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'wp_login_btn_background_color', 'wp_login_btn_background_hover_color' ),
								),
								'gradient' => array(
									'fields' => array( 'wp_login_btn_background_gradient' ),
								),
							),
						),
						'wp_login_btn_background_gradient' => array(
							'type'        => 'gradient',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Gradient', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'background',
								'important' => true,
							),
						),
						'wp_login_btn_background_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'background',
								'important' => true,
							),
						),
						'wp_login_btn_background_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'background',
								'important' => true,
							),
						),
						'wp_login_btn_padding'             => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'wp_login_button_border'           => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'important' => true,
							),
						),
						'wp_login_btn_top_margin'          => array(
							'type'    => 'unit',
							'label'   => __( 'Button Top Space', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'wp_login_btn_bottom_margin'       => array(
							'type'    => 'unit',
							'label'   => __( 'Button Bottom Space', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'socail_styling'          => array( // Section.
					'title'  => __( 'Social Buttons Styling', 'uabb' ), // Section Title.
					'fields' => array(

						'social_buttons_position'      => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'bottom',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							),
						),
						'social_buttons_layout'        => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline' => __( 'In-Line', 'uabb' ),
								'stack'  => __( 'Stack', 'uabb' ),
							),
						),
						'social_buttons_spacing'       => array(
							'type'    => 'unit',
							'label'   => __( 'Spacing', 'uabb' ),
							'slider'  => true,
							'default' => '5',
							'units'   => array( 'px' ),
						),
						'social_buttons_border_radius' => array(
							'type'   => 'unit',
							'label'  => __( 'Border Radius', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
						),
						'social_buttons_align'         => array(
							'type'    => 'select',
							'label'   => __( 'Social Buttons Alignment', 'uabb' ),
							'default' => 'flex-start',
							'options' => array(
								'flex-start' => __( 'Left', 'uabb' ),
								'center'     => __( 'Center', 'uabb' ),
								'flex-end'   => __( 'Right', 'uabb' ),
							),
						),
						'social_button_theme'          => array(
							'type'    => 'select',
							'label'   => __( 'Social Buttons Theme', 'uabb' ),
							'default' => 'dark',
							'options' => array(
								'dark'  => __( 'Dark', 'uabb' ),
								'light' => __( 'Light', 'uabb' ),
							),
						),
					),
				),
				'separator_styling'       => array( // Section.
					'title'  => __( 'Separator Styling', 'uabb' ), // Section Title.
					'fields' => array(

						'text_position'            => array(
							'type'        => 'unit',
							'label'       => __( 'Position', 'uabb' ),
							'help'        => __( 'Adjust the position of  Text. 0% for very left & 100% for very right.', 'uabb' ),
							'placeholder' => '50',
							'maxlength'   => '3',
							'size'        => '5',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( '%' ),
						),
						'text_spacing'             => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'help'        => __( 'Adjust the spacing between separator line edges & your Text.', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '2',
							'size'        => '5',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
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
						'separator_style'          => array(
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-style',
							),
						),
						'separator_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-color',
							),
						),
						'separator_height'         => array(
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-width',
								'unit'     => 'px',
							),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
							'help'        => __( 'Thickness of Border', 'uabb' ),
						),
						'separator_width'          => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'maxlength'   => '3',
							'size'        => '5',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( '%' ),
						),
						'separator_alignment'      => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
						),
						'separator_margin_top'     => array(
							'type'    => 'unit',
							'label'   => __( 'Separator Top Spacing', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-advanced-separator',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'separator_margin_bottom'  => array(
							'type'    => 'unit',
							'label'   => __( 'Separator Bottom Spacing', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-advanced-separator',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),

			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'input_typography'          => array(
					'title'  => __( 'Input Text', 'uabb' ),
					'fields' => array(
						'input_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input,.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input::placeholder',
								'important' => true,
							),
						),
					),
				),
				'button_typography'         => array(
					'title'  => __( 'WP Login Button Text', 'uabb' ),
					'fields' => array(
						'button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button',
								'important' => true,
							),
						),
					),
				),
				'label_typography'          => array(
					'title'  => __( 'Label Text', 'uabb' ),
					'fields' => array(
						'label_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-label , .uabb-lf-form-wrap .uabb-lf-checkbox-label',
								'important' => true,
							),
						),
						'label_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-label , .uabb-lf-form-wrap .uabb-lf-checkbox-label',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'lost_your_pass_typography' => array(
					'title'  => __( 'Lost your password Text', 'uabb' ),
					'fields' => array(
						'lost_your_pass_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-lost-your-pass-label',
								'important' => true,
							),
						),
						'lost_your_pass_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-lost-your-pass-label',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'error_msg_typography'      => array(
					'title'  => __( 'Error Message Text', 'uabb' ),
					'fields' => array(
						'errormsg_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-lf-form-wrap .uabb-lf-error-message-wrap',
								'important' => true,
							),
						),
					),
				),
				'separator_typography'      => array(
					'title'  => __( 'Separator Text', 'uabb' ),
					'fields' => array(
						'separator_text_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Title Tag', 'uabb' ),
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
						'separator_typo'               => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-divider-text',
								'important' => true,
							),
						),
						'separator_text_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-divider-text',
								'important' => true,
								'property'  => 'color',
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

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/introducing-login-form-module-for-beaver-builder/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=login-form-module" target="_blank" rel="noopener"> Getting started article </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/create-facebook-app-id-for-login-form-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=login-form-module" target="_blank" rel="noopener"> How to Create a Facebook App ID for Login Form Module? </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/create-google-client-id-for-login-form-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=login-form-module" target="_blank" rel="noopener"> How to Create a Google Client ID for Login Form Module? </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);


