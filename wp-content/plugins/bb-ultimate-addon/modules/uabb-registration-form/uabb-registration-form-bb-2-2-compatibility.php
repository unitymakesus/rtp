<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Contact Form Module
 */

$style1                          = '<div style="line-height: 1.5em;  padding-top:15px;">';
$style2                          = '<div style="line-height: 1em; margin-left:20px; background:#e4e7ea; padding:15px;">';
$user_role_desc                  = $style1 . __( 'The default option will assign the user role as per the WordPress backend setting.', 'uabb' ) . '</div>';
$user_hide_form_desc             = $style1 . __( 'Enable this option if you wish to hide the form at the frontend from logged in users.', 'uabb' ) . '</div>';
$login_link_desc                 = $style1 . __( 'Add the “Login” link below the register button.', 'uabb' ) . '</div>';
$lost_pass_desc                  = $style1 . __( 'Add the “Lost Password” link below the register button.', 'uabb' ) . '</div>';
$enable_email_desc               = $style1 . __( 'On enabling this option, visit the Email tab to send a customized email to the user.', 'uabb' ) . '</div>';
$email_content_desc              = $style2 . __( 'Here you can design the Email Content user will receive.', 'uabb' ) . '</div>';
$register_website_recaptcha_desc = $style2 . __( 'Please register keys for your website at', 'uabb' );
$recaptcha_link                  = ' href="https://www.google.com/recaptcha/admin" target="_blank"';

FLBuilder::register_module(
	'UABBRegistrationFormModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'name_section'         => array(
					'title'  => __( 'Form Fields', 'uabb' ),
					'fields' => array(
						'form_field' => array(
							'type'         => 'form',
							'label'        => __( 'Form Field', 'uabb' ),
							'form'         => 'uabb_registration_form',
							'multiple'     => true,
							'preview_text' => 'field_type',
							'default'      => array(
								array(
									'field_type'     => 'user_login',
									'field_label'    => 'Username ',
									'field_required' => 'yes',
								),
								array(
									'field_type'     => 'user_email',
									'field_label'    => 'Email ',
									'field_required' => 'yes',
								),
								array(
									'field_type'     => 'user_pass',
									'field_label'    => 'Password ',
									'field_required' => 'yes',
								),
							),
						),
					),
				),
				'general_section'      => array(
					'title'  => __( 'General Form Settings', 'uabb' ),
					'fields' => array(
						'required_mark_label'     => array(
							'type'    => 'select',
							'label'   => __( 'Display Required Mark', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
						'new_user_role'           => array(
							'type'        => 'select',
							'label'       => __( 'New User Role', 'uabb' ),
							'default'     => 'default',
							'options'     => UABBRegistrationFormModule::get_user_roles(),
							'description' => $user_role_desc,
						),
						'hide_form_logged'        => array(
							'type'        => 'select',
							'label'       => __( 'Hide Form from Logged in Users', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'      => array(
								'yes' => array(
									'fields' => array( 'logged_in_text' ),
								),
							),
							'description' => $user_hide_form_desc,
						),
						'logged_in_text'          => array(
							'type'  => 'text',
							'label' => __( 'Message For Logged In Users', 'uabb' ),
						),
						'login_link'              => array(
							'type'        => 'select',
							'label'       => __( 'Login Link', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'description' => $login_link_desc,
							'toggle'      => array(
								'yes' => array(
									'fields'   => array( 'login_link_text', 'login_link_to' ),
									'sections' => array( 'login_link_style', 'login_link_typography' ),
								),
							),
						),
						'login_link_text'         => array(
							'type'        => 'text',
							'label'       => __( 'Login Link Text', 'uabb' ),
							'default'     => 'Login',
							'connections' => array( 'string', 'html' ),
						),
						'login_link_to'           => array(
							'type'    => 'select',
							'label'   => __( 'Login Link To', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'default' => __( 'Default WordPress Page', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'login_link_url' ),
								),
							),
						),
						'login_link_url'          => array(
							'type'          => 'link',
							'label'         => __( 'Custom URL', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'connections'   => array( 'url' ),
						),
						'lost_your_pass'          => array(
							'type'        => 'select',
							'label'       => __( 'Lost Your Password Link', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'description' => $lost_pass_desc,
							'toggle'      => array(
								'yes' => array(
									'fields'   => array( 'lost_link_text', 'lost_link_to' ),
									'sections' => array( 'login_link_style', 'lost_link_typography' ),
								),
							),
						),
						'lost_link_text'          => array(
							'type'        => 'text',
							'label'       => __( 'Lost Password Link Text', 'uabb' ),
							'default'     => 'Lost Your Password?',
							'connections' => array( 'string', 'html' ),
						),
						'lost_link_to'            => array(
							'type'    => 'select',
							'label'   => __( 'Lost Password Link To', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'default' => __( 'Default WordPress Page', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'lost_link_url' ),
								),
							),
						),
						'lost_link_url'           => array(
							'type'          => 'link',
							'label'         => __( 'Custom URL', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'connections'   => array( 'url' ),
						),
						'check_password_strength' => array(
							'type'    => 'select',
							'label'   => __( 'Enable Password Strength Checker', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'pass_week_color', 'pass_medium_color', 'pass_strong_color', 'pass_strength_align' ),
								),
							),
						),
						'enabled_label'           => array(
							'type'    => 'select',
							'label'   => __( 'Enable Label', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'label_typography' ),
								),
							),
						),
					),
				),
				'after_submit_action'  => array(
					'title'  => __( 'After Register Actions', 'uabb' ),
					'fields' => array(
						'redirect_after_register'  => array(
							'type'    => 'select',
							'label'   => __( 'Redirect After Register', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'redirect_after_link' ),
								),
							),
						),
						'redirect_after_link'      => array(
							'type'        => 'text',
							'label'       => __( 'Redirect URL', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'send_mail_after_register' => array(
							'type'        => 'select',
							'label'       => __( 'Send Email ', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'      => array(
								'yes' => array(
									'tabs' => array( 'template' ),
								),
							),
							'description' => $enable_email_desc,
						),
						'auto_login'               => array(
							'type'    => 'select',
							'label'   => __( 'Auto Login', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
				'sucess_error_message' => array(
					'title'  => __( 'Success / Error Messages', 'uabb' ),
					'fields' => array(
						'success_message' => array(
							'type'        => 'text',
							'label'       => __( 'Success Message', 'uabb' ),
							'default'     => 'Thank you for registering with us!',
							'connections' => array( 'string', 'html' ),
						),
						'error_message'   => array(
							'type'        => 'text',
							'label'       => __( 'Error Message', 'uabb' ),
							'default'     => 'Error: Something went wrong! Unable to complete the registration process.',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'form-style'         => array(
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
								'selector'  => '.uabb-registration-form',
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
								'selector'  => '.uabb-registration-form',
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
								'selector'  => '.uabb-registration-form',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'columns_gap'            => array(
							'type'    => 'unit',
							'label'   => __( 'Columns Gap', 'uabb' ),
							'default' => '10',
							'slider'  => true,
							'units'   => array( 'px' ),
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
								'selector'  => '.uabb-registration-form input',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'input-border-style' => array(
					'title'  => __( 'Input Style', 'uabb' ),
					'fields' => array(
						'input_padding'             => array(
							'type'       => 'dimension',
							'label'      => __( 'Input Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-input-group input',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_text_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '333333',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-input-group input,.uabb-registration-form input::placeholder',
								'property'  => 'color',
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
								'selector'  => '.uabb-registration-form .uabb-input-group input',
								'property'  => 'background',
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
								'selector'  => '.uabb-registration-form .uabb-input-group input',
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
				'error-style'        => array(
					'title'  => __( 'Validation Style', 'uabb' ),
					'fields' => array(
						'success_msg_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Success Message Color', 'uabb' ),
							'default'     => '008000',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => 'none',
						),
						'error_msg_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Error Message Color', 'uabb' ),
							'default'     => 'ff0000',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => 'none',
						),
						'success_msg_border'  => array(
							'type'       => 'border',
							'label'      => __( 'Success Message Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rf-success-message-wrap .uabb-rf-success-message',
								'important' => true,
							),
						),
						'success_msg_padding' => array(
							'type'       => 'dimension',
							'label'      => __( 'Success Message Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rf-success-message-wrap .uabb-rf-success-message',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'pass_week_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Weak Strength Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form-pass-verify.short',
								'property'  => 'color',
								'important' => true,
							),
						),
						'pass_medium_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Medium Strength Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form-pass-verify.strong',
								'property'  => 'color',
								'important' => true,
							),
						),
						'pass_strong_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Strong Strength Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form-pass-verify.good',
								'property'  => 'color',
								'important' => true,
							),
						),
						'pass_strength_align' => array(
							'type'        => 'align',
							'label'       => __( 'Password Strength Alignment', 'uabb' ),
							'default'     => 'center',
							'responsive'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form-pass-verify',
								'property'  => 'text-align',
								'important' => true,
							),
						),
					),
				),
				'login_link_style'   => array(
					'title'  => __( 'Login Link Style', 'uabb' ),
					'fields' => array(
						'login_link_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Link Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property'  => 'color',
								'important' => true,
							),
						),
						'login_link_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Link Hover Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
						),
						'login_link_align'       => array(
							'type'       => 'align',
							'label'      => __( 'Link Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
						),
					),
				),
			),
		),
		'button'     => array(
			'title'    => __( 'Register Button', 'uabb' ),
			'sections' => array(
				'button-style' => array(
					'title'  => __( 'Register Button', 'uabb' ),
					'fields' => array(
						'btn_text' => array(
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => 'Register',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'btn-style'    => array(
					'title'  => __( 'Button Style', 'uabb' ),
					'fields' => array(
						'btn_col_width'              => array(
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
						'btn_align'                  => array(
							'type'    => 'select',
							'label'   => __( 'Button Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'btn_text_color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'btn_text_hover_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_background_type'        => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'options' => array(
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'btn_background_color', 'btn_background_hover_color' ),
								),
								'gradient' => array(
									'fields' => array( 'btn_background_gradient' ),
								),
							),
						),
						'btn_background_gradient'    => array(
							'type'        => 'gradient',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Gradient', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit',
								'property'  => 'background',
								'important' => true,
							),
						),
						'btn_background_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit',
								'property'  => 'background',
								'important' => true,
							),
						),
						'btn_background_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_padding'                => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'              => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit',
								'important' => true,
							),
						),
						'btn_top_margin'             => array(
							'type'    => 'unit',
							'label'   => __( 'Button Top Space', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'btn_bottom_margin'          => array(
							'type'    => 'unit',
							'label'   => __( 'Button Bottom Space', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'template'   => array(
			'title'    => __( 'Email', 'uabb' ),
			'sections' => array(
				'email-subject' => array(
					'title'       => __( 'Email Subject & Message', 'uabb' ),
					'description' => $email_content_desc,
					'fields'      => array(
						'email_template'     => array(
							'type'    => 'select',
							'label'   => __( 'Email Template', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'email_subject', 'email_template_reg', 'email_content_type' ),
								),
							),
						),
						'email_subject'      => array(
							'type'    => 'text',
							'label'   => __( 'Email Subject', 'uabb' ),
							'default' => 'Thank you for registering with "UABB"!',
							'help'    => __( 'This is the Email Subject that will be shown to you when you receive the Custom email. You can manually edit the Subject as per your liking.', 'uabb' ),
						),
						'email_template_reg' => array(
							'type'    => 'textarea',
							'label'   => __( 'Message Body ', 'uabb' ),
							'default' => UABBRegistrationFormModule::default_email_template(),
							'rows'    => '10',
						),
						'email_content_type' => array(
							'type'    => 'select',
							'label'   => __( 'Send As', 'uabb' ),
							'options' => array(
								'html'  => __( 'HTML', 'uabb' ),
								'plain' => __( 'Plain', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'input_typography'        => array(
					'title'  => __( 'Input Text', 'uabb' ),
					'fields' => array(
						'input_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-input-group input,.uabb-registration-form input::placeholder',
								'important' => true,
							),
						),
					),
				),
				'button_typography'       => array(
					'title'  => __( 'Button Text', 'uabb' ),
					'fields' => array(
						'button_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text',
								'important' => true,
							),
						),
					),
				),
				'label_typography'        => array(
					'title'  => __( 'Label Text', 'uabb' ),
					'fields' => array(
						'label_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form label',
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
								'selector'  => '.uabb-registration-form label',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'login_link_typography'   => array(
					'title'  => __( 'Login Link', 'uabb' ),
					'fields' => array(
						'login_link_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'important' => true,
							),
						),
					),
				),
				'form_message_typography' => array(
					'title'  => __( 'Success & Error Messages', 'uabb' ),
					'fields' => array(
						'message_link_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-rf-success-message-wrap .uabb-rf-success-message,.uabb-registration-form .uabb-registration_form-error-message-required ',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'reCAPTCHA'  => array(
			'title'    => __( 'Anti-Spam Protection', 'uabb' ),
			'sections' => array(
				'honeypot_section'  => array(
					'title'  => __( 'Honeypot', 'uabb' ),
					'fields' => array(
						'honeypot_check' => array(
							'type'    => 'select',
							'label'   => __( ' Enable Honeypot', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'recaptcha_general' => array(
					'title'       => __( 'reCAPTCHA', 'uabb' ),
					'description' => sprintf( /* translators: a%s: search term */ ' %1$s <a%2$s> <b>Google Admin Console </b> </a>. </div>', $register_website_recaptcha_desc, $recaptcha_link ),
					'fields'      => array(
						'uabb_recaptcha_toggle'        => array(
							'type'    => 'select',
							'label'   => __( 'Enable reCAPTCHA', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'show' => __( 'Yes', 'uabb' ),
								'hide' => __( 'No', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'uabb_recaptcha_version'       => array(
							'type'    => 'select',
							'label'   => __( 'reCAPTCHA Version', 'uabb' ),
							'default' => 'v2',
							'options' => array(
								'v2' => __( 'v2', 'uabb' ),
								'v3' => __( 'v3', 'uabb' ),
							),
						),
						'uabb_badge_position'          => array(
							'type'    => 'select',
							'label'   => __( 'Badge Position', 'uabb' ),
							'options' => array(
								'bottomright' => __( 'Bottom Right', 'uabb' ),
								'bottomleft'  => __( 'Bottom Left', 'uabb' ),
								'inline'      => __( 'Inline', 'uabb' ),
							),
						),
						'uabb_v3_recaptcha_site_key'   => array(
							'type'        => 'text',
							'label'       => __( 'Site Key', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'uabb_recaptcha_site_key'      => array(
							'type'        => 'text',
							'label'       => __( 'Site Key', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'uabb_recaptcha_secret_key'    => array(
							'type'        => 'text',
							'label'       => __( 'Secret Key', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'uabb_v3_recaptcha_secret_key' => array(
							'type'        => 'text',
							'label'       => __( 'Secret Key', 'uabb' ),
							'connections' => array( 'string', 'html' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'uabb_v3_recaptcha_score'      => array(
							'type'    => 'unit',
							'label'   => __( 'reCAPTCHA Score', 'uabb' ),
							'default' => '0.5',
						),
						'uabb_recaptcha_theme'         => array(
							'type'    => 'select',
							'label'   => __( 'Theme', 'uabb' ),
							'default' => 'light',
							'options' => array(
								'light' => __( 'Light', 'uabb' ),
								'dark'  => __( 'Dark', 'uabb' ),
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

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/user-registration-form-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> Introducing User Registration Form Module. </a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/create-user-registration-form-using-beaver-builder/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> How to Create a Registration Form using Beaver Builder?</a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/create-user-registration-form-using-only-email-field/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> How to Create a User Registration Form with Only Email Field in Beaver Builder?</a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/user-registration-form-with-honeypot/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> Honeypot field in User Registration Form for Beaver Builder.</a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/user-registration-form-with-recaptcha/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> Google reCAPTCHA in User Registration Form for Beaver Builder.</a> </li>
								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/frequently-asked-questions-about-user-registration-forms/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=user-registration-form-module" target="_blank" rel="noopener"> Frequently Asked Questions about User Registration Forms.</a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);
// Add Form Items.
FLBuilder::register_settings_form(
	'uabb_registration_form',
	array(
		'title' => __( 'Edit Form Fields', 'uabb' ),
		'tabs'  => array(
			'registration_form_item' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'form_basic' => array(
						'title'  => __( 'Form Field', 'uabb' ),
						'fields' => array(
							'field_type'        => array(
								'type'    => 'select',
								'label'   => __( 'Field Type', 'uabb' ),
								'default' => 'user_login',
								'options' => array(
									'user_login'   => __( 'Username', 'uabb' ),
									'user_pass'    => __( 'Password', 'uabb' ),
									'confirm_pass' => __( 'Confirm Password', 'uabb' ),
									'user_email'   => __( 'Email', 'uabb' ),
									'first_name'   => __( 'First Name', 'uabb' ),
									'last_name'    => __( 'Last Name', 'uabb' ),
								),
							),
							'field_label'       => array(
								'type'        => 'text',
								'label'       => __( 'Label', 'uabb' ),
								'default'     => __( 'Username', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'field_placeholder' => array(
								'type'        => 'text',
								'label'       => __( 'Placeholder', 'uabb' ),
								'connections' => array( 'string', 'html' ),
							),
							'field_required'    => array(
								'type'    => 'select',
								'label'   => __( 'Required', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'no'  => __( 'No', 'uabb' ),
									'yes' => __( 'Yes', 'uabb' ),
								),
							),
							'field_width'       => array(
								'type'       => 'select',
								'label'      => __( 'Input Width', 'uabb' ),
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
						),
					),
				),
			),
		),
	)
);
