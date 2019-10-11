<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Contact Form Module
 */

$host = 'localhost';
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$host = $_SERVER['HTTP_HOST'];
}

$current_url = 'http://' . $host . strtok( $_SERVER['REQUEST_URI'], '?' );

$default_template_reg = sprintf(
	/* translators: %1$s: search term, translators: %2$s: search term */ __(
		'Thank you for registering with us! You can access your account at:
		<strong>User Name:</strong> [USERNAME]
<strong>Password:</strong> [PASSWORD]

----
You have received a new submission from %1$s
(%2$s)',
		'uabb'
	),
	get_bloginfo( 'name' ),
	$current_url
);

FLBuilder::register_module(
	'UABBRegistrationFormModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'name_section'         => array(
					'title'  => __( 'Form Field', 'uabb' ),
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
									'field_label'    => 'UserName ',
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
							'label'   => __( 'Display Asterisk Mark', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
						),
						'hide_form_logged'        => array(
							'type'    => 'select',
							'label'   => __( 'Hide Form from Logged in Users', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'logged_in_text' ),
								),
							),
						),
						'logged_in_text'          => array(
							'type'  => 'text',
							'label' => __( 'Message For Logged In Users', 'uabb' ),
						),
						'login_link'              => array(
							'type'    => 'select',
							'label'   => __( 'Login Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'login_link_text', 'login_link_to' ),
									'sections' => array( 'login_link_style', 'login_link_typography' ),
								),
							),
						),
						'login_link_text'         => array(
							'type'    => 'text',
							'label'   => __( 'Login Link Text', 'uabb' ),
							'default' => 'Login',
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
						),
						'lost_your_pass'          => array(
							'type'    => 'select',
							'label'   => __( 'Lost Your Password Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields'   => array( 'lost_link_text', 'lost_link_to' ),
									'sections' => array( 'login_link_style', 'lost_link_typography' ),
								),
							),
						),
						'lost_link_text'          => array(
							'type'    => 'text',
							'label'   => __( 'Lost Password Link Text', 'uabb' ),
							'default' => 'Lost Your Password?',
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
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
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
							'type'  => 'text',
							'label' => __( 'Redirect URL', 'uabb' ),
						),
						'send_mail_after_register' => array(
							'type'    => 'select',
							'label'   => __( 'Send Email ', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'tabs' => array( 'template' ),
								),
							),
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
							'type'    => 'text',
							'label'   => __( 'Success Message', 'uabb' ),
							'default' => 'Thank you for registering with us!',
						),
						'error_message'   => array(
							'type'    => 'text',
							'label'   => __( 'Error Message', 'uabb' ),
							'default' => 'Error: Something went wrong! Unable to complete the registration process.',
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
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
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
						'form_border_style'      => array(
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form',
								'property' => 'border-style',
							),
						),
						'form_border_width'      => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'form_border_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form',
								'property' => 'border-color',
							),
						),
						'columns_gap'            => array(
							'type'        => 'unit',
							'label'       => __( 'Columns Gap', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
						),
						'row_gap'                => array(
							'type'        => 'unit',
							'label'       => __( 'Row Gap', 'uabb' ),
							'default'     => '10',
							'description' => 'px',
						),
						'label_bottom_margin'    => array(
							'type'        => 'unit',
							'label'       => __( 'Label Bottom Spacing', 'uabb' ),
							'default'     => '',
							'slider'      => true,
							'description' => 'px',
							'preview'     => array(
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
							'type'        => 'dimension',
							'label'       => __( 'Input Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form',
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
								'selector'  => '.uabb-registration-form .uabb-input-group input',
								'property'  => 'color',
								'important' => true,
							),
						),
						'input_background_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-input-group input',
								'property'  => 'background',
								'important' => true,
							),
						),
						'input_border_style'        => array(
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'border-style',
							),
						),
						'input_border_width'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'input_border_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'border-color',
							),
						),
						'input_border_active_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Active Color', 'uabb' ),
							'default'     => 'bbbbbb',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'input_top_margin'          => array(
							'type'    => 'unit',
							'label'   => __( 'Input Top Margin', 'uabb' ),
							'slider'  => true,
							'default' => '10',
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-form-outter',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'input_bottom_margin'       => array(
							'type'    => 'unit',
							'label'   => __( 'Input Bottom Margin', 'uabb' ),
							'slider'  => true,
							'default' => '20',
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-form-outter',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'error-style'        => array(
					'title'  => __( 'Validation Style', 'uabb' ),
					'fields' => array(
						'success_msg_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Success Message Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'success_msg_border_style' => array(
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rf-success-message-wrap .uabb-rf-success-message',
								'property' => 'border-style',
							),
						),
						'success_msg_border_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rf-success-message-wrap .uabb-rf-success-message',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'success_msg_border_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-rf-success-message-wrap .uabb-rf-success-message',
								'property' => 'border-color',
							),
						),
						'success_msg_padding'      => array(
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
						'error_msg_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Error Message color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'pass_week_color'          => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Week Strength color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'pass_medium_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Medium Strength color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'pass_strong_color'        => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Password Medium Strength color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => 'none',
						),
						'pass_strength_align'      => array(
							'type'       => 'align',
							'label'      => __( 'Link Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
							'preview'    => 'none',
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
			'title'    => __( 'Button', 'uabb' ),
			'sections' => array(
				'button-style' => array(
					'title'  => __( 'Submit Button', 'uabb' ),
					'fields' => array(
						'btn_text' => array(
							'type'    => 'text',
							'label'   => __( 'Text', 'uabb' ),
							'default' => 'Submit',
						),
					),
				),
				'btn-style'    => array(
					'title'  => __( 'Button Style', 'uabb' ),
					'fields' => array(
						'btn_text_color'             => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'btn_text_hover_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
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
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
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
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
								'property'  => 'background',
								'important' => true,
							),
						),
						'btn_background_hover_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_align'                  => array(
							'type'    => 'select',
							'label'   => __( 'Button Width/Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'full'   => __( 'Full', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
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
								'selector'  => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border_style'        => array(
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
								'property' => 'border-style',
							),
						),
						'button_border_width'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'button_border_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'cccccc',
							'show_reset' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit',
								'property' => 'border-color',
							),
						),
						'btn_top_margin'             => array(
							'type'    => 'unit',
							'label'   => __( 'Input Top Margin', 'uabb' ),
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
							'label'   => __( 'Input Bottom Margin', 'uabb' ),
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
					'title'  => __( 'Email & Subject', 'uabb' ),
					'fields' => array(
						'email_subject'      => array(
							'type'    => 'text',
							'label'   => __( 'Email Subject', 'uabb' ),
							'default' => '[SUBJECT]',
							'help'    => __( 'The subject of email received, by default if you have enabled subject it would be shown by shortcode or you can manually add yourself', 'uabb' ),
						),
						'email_template_reg' => array(
							'type'        => 'textarea',
							'label'       => __( 'Message Body ', 'uabb' ),
							'rows'        => '10',
							'default'     => $default_template_reg,
							'description' => __( 'Here you can design the email you receive', 'uabb' ),
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
						'font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-registration-form .uabb-input-group input',
							),
						),
						'font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'text-transform',
							),
						),
						'letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-input-group input',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'button_typography'       => array(
					'title'  => __( 'Button Text', 'uabb' ),
					'fields' => array(
						'btn_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
							),
						),
						'btn_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'btn_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'btn_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
								'property' => 'text-transform',
							),
						),
						'btn_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'label_typography'        => array(
					'title'  => __( 'Label Text', 'uabb' ),
					'fields' => array(
						'label_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-registration-form label',
							),
						),
						'label_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form label',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'label_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form label',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'label_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form label',
								'property' => 'text-transform',
							),
						),
						'label_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-registration-form label',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'label_color'            => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form label',
								'property'  => 'color',
								'important' => true,
							),
						),
						'label_top_margin'       => array(
							'type'    => 'unit',
							'label'   => __( 'Label Top Margin', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form label',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'label_bottom_margin'    => array(
							'type'    => 'unit',
							'label'   => __( 'Label Bottom Margin', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-registration-form label',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'login_link_typography'   => array(
					'title'  => __( 'Login Link', 'uabb' ),
					'fields' => array(
						'login_link_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
							),
						),
						'login_link_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'login_link_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'login_link_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'text-transform',
							),
						),
						'login_link_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
					),
				),
				'form_message_typography' => array(
					'title'  => __( 'Login Link', 'uabb' ),
					'fields' => array(
						'message_link_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
							),
						),
						'message_link_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'message_link_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'message_link_transform'        => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => 'Default',
								'uppercase'  => 'UPPERCASE',
								'lowercase'  => 'lowercase',
								'capitalize' => 'Capitalize',
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'text-transform',
							),
						),
						'message_link_letter_spacing'   => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-rform-exteral-link-wrap .uabb-rform-exteral-link',
								'property' => 'letter-spacing',
								'unit'     => 'px',
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
					'description' => sprintf( /* translators: a%s: search term */ __( '<div style="line-height: 1em; margin-left:20px; background:#e4e7ea; padding:15px;"> Please register keys for your website at <a%s> <b>Google Admin Console </b> </a>. </div>', 'uabb' ), ' href="https://www.google.com/recaptcha/admin" target="_blank"' ),
					'fields'      => array(
						'uabb_recaptcha_toggle'     => array(
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
							'toggle'  => array(
								'show' => array(
									'fields' => array( 'uabb_recaptcha_theme', 'uabb_recaptcha_site_key', 'uabb_recaptcha_secret_key' ),
								),
							),
						),
						'uabb_recaptcha_site_key'   => array(
							'type'    => 'text',
							'label'   => __( 'Site Key', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type' => 'none',
							),
						),
						'uabb_recaptcha_secret_key' => array(
							'type'    => 'text',
							'label'   => __( 'Secret Key', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type' => 'none',
							),
						),
						'uabb_recaptcha_theme'      => array(
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
	)
);
// Add Form Items.
FLBuilder::register_settings_form(
	'uabb_registration_form',
	array(
		'title' => __( 'Edit Form Item', 'uabb' ),
		'tabs'  => array(
			'registration_form_item' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'form_basic' => array(
						'title'  => __( 'Registration Form', 'uabb' ),
						'fields' => array(
							'field_type'        => array(
								'type'    => 'select',
								'label'   => __( 'Field Type', 'uabb' ),
								'default' => 'user_login',
								'options' => array(
									'user_login'   => __( 'Username', 'uabb' ),
									'user_pass'    => __( 'Password', 'uabb' ),
									'confirm_pass' => __( 'Confirm Password', 'uabb' ),
									'user_email'   => __( 'User Email', 'uabb' ),
									'first_name'   => __( 'First Name', 'uabb' ),
									'last_name'    => __( 'Last Name', 'uabb' ),
								),
							),
							'field_label'       => array(
								'type'    => 'text',
								'label'   => __( 'Label', 'uabb' ),
								'default' => __( 'User Name', 'uabb' ),
							),
							'field_placeholder' => array(
								'type'    => 'text',
								'label'   => __( 'Placeholder', 'uabb' ),
								'default' => '',
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
						),
					),
				),
			),
		),
	)
);
