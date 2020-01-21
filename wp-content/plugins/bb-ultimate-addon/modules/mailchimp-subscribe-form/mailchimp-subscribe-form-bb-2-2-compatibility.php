<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Subscribe Form Module
 */

FLBuilder::register_module(
	'UABBSubscribeFormModule',
	array(
		'general'    => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'service_msg'   => array(
					'title'  => '',
					'fields' => array(
						'mailchimp_warning_msg' => array(
							'type'     => 'uabb-msgbox',
							'label'    => '',
							'msg_type' => 'warning',
							'content'  => $notice,
						),
					),
				),
				'service'       => array(
					'title'    => '',
					'file'     => plugin_dir_path( __FILE__ ) . 'includes/service-settings.php',
					'services' => 'autoresponder',
				),
				'heading'       => array(
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => array(
						'heading'    => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'SIGN UP NOW FOR A FREE COURSE', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-sf-heading',
							),
							'connections' => array( 'string', 'html' ),
						),
						'subheading' => array(
							'type'        => 'text',
							'label'       => __( 'Sub-Heading', 'uabb' ),
							'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-sf-subheading',
							),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'form_fields'   => array(
					'title'  => __( 'Form Fields', 'uabb' ),
					'fields' => array(
						'show_fname'        => array(
							'type'    => 'select',
							'label'   => __( 'Show First Name', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'fname_label' ),
								),
							),
						),
						'fname_label'       => array(
							'type'        => 'text',
							'label'       => __( 'First Name Placeholder', 'uabb' ),
							'placeholder' => __( 'Your Name', 'uabb' ),
						),
						'show_lname'        => array(
							'type'    => 'select',
							'label'   => __( 'Show Last Name', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'lname_label' ),
								),
							),
						),
						'lname_label'       => array(
							'type'        => 'text',
							'label'       => __( 'Last Name Placeholder', 'uabb' ),
							'placeholder' => __( 'Last Name', 'uabb' ),
						),
						'email_placeholder' => array(
							'type'        => 'text',
							'label'       => __( 'Email Placeholder', 'uabb' ),
							'placeholder' => __( 'Your Email', 'uabb' ),
						),
					),
				),
				'bottom_text'   => array(
					'title'  => __( 'Bottom Text', 'uabb' ),
					'fields' => array(
						'bottom_text' => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'rows'          => 6,
							'default'       => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
							'preview'       => array(
								'type'      => 'text',
								'selector'  => '.uabb-sf-bottom-text',
								'important' => true,
							),
						),
					),
				),
				'terms_section' => array(
					'title'  => __( 'Terms and Conditions Field', 'uabb' ),
					'fields' => array(
						'terms_checkbox'      => array(
							'type'    => 'select',
							'label'   => __( 'Terms and Conditions Checkbox', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'show' => __( 'Show', 'uabb' ),
								'hide' => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'show' => array(
									'fields'   => array( 'terms_checkbox_text', 'terms_text' ),
									'sections' => array( 'checkbox_typography', 'terms_typography', 'terms-checkbox-style' ),
								),
							),
						),
						'terms_checkbox_text' => array(
							'type'    => 'text',
							'label'   => __( 'Checkbox Text', 'uabb' ),
							'default' => __( 'I Accept the Terms and Conditions', 'uabb' ),
						),
						'terms_text'          => array(
							'type'          => 'editor',
							'label'         => 'Terms and Conditions',
							'default'       => __( 'Please go through the following terms and conditions carefully.', 'uabb' ),
							'media_buttons' => false,
							'rows'          => 8,
							'preview'       => array(
								'type'      => 'text',
								'selector'  => '.uabb-terms-text',
								'important' => true,
							),
							'connections'   => array( 'string' ),
						),
					),
				),
				'success'       => array(
					'title'  => __( 'Success', 'uabb' ),
					'fields' => array(
						'success_action'  => array(
							'type'    => 'select',
							'label'   => __( 'Success Action', 'uabb' ),
							'options' => array(
								'message'  => __( 'Show Message', 'uabb' ),
								'redirect' => __( 'Redirect', 'uabb' ),
							),
							'toggle'  => array(
								'message'  => array(
									'fields' => array( 'success_message' ),
								),
								'redirect' => array(
									'fields' => array( 'success_url' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'success_message' => array(
							'type'          => 'editor',
							'label'         => '',
							'media_buttons' => false,
							'rows'          => 8,
							'default'       => __( 'Thanks for subscribing! Please check your email for further instructions.', 'uabb' ),
							'preview'       => array(
								'type' => 'none',
							),
							'connections'   => array( 'string', 'html' ),
						),
						'success_url'     => array(
							'type'        => 'link',
							'label'       => __( 'Success URL', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'url' ),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'structure'            => array(
					'title'  => __( 'Alignment', 'uabb' ),
					'fields' => array(
						'overall_alignment'      => array(
							'type'    => 'align',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'left',
							'help'    => __( 'This is the overall content alignment', 'uabb' ),
						),
						'resp_overall_alignment' => array(
							'type'    => 'align',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'default',
							'help'    => __( 'This is the Responsive overall content alignment', 'uabb' ),
						),
						'padding_dimension'      => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'help'       => __( 'Apply padding to your element from all sides.', 'uabb' ),
							'responsive' => true,
						),
						'background_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form',
								'property'  => 'background',
								'important' => true,
							),
						),
						'layout'                 => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'stacked',
							'help'    => __( 'The appearance of the Subscribe Form', 'uabb' ),
							'options' => array(
								'stacked' => __( 'Stacked', 'uabb' ),
								'inline'  => __( 'Inline', 'uabb' ),
							),
							'toggle'  => array(
								'inline' => array(
									'fields' => array( 'responsive' ),
								),
							),
						),
						'responsive'             => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'default' => 'left',
							'help'    => __( 'There might be responsive issues with inline style. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb' ),
							'options' => array(
								'none'         => __( 'None', 'uabb' ),
								'small'        => __( 'Small Device', 'uabb' ),
								'small_medium' => __( 'Medium and Small Device', 'uabb' ),
							),
							'toggle'  => array(
								'small'        => array(
									'fields' => array( 'res_spacing' ),
								),
								'small_medium' => array(
									'fields' => array( 'res_spacing' ),
								),
							),
						),
						'res_spacing'            => array(
							'type'   => 'unit',
							'label'  => __( 'Responsive Spacing', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
							'help'   => __( 'Space between form fields in responsive view.', 'uabb' ),
						),
					),
				),
				'style'                => array(
					'title'  => __( 'Form Input Style', 'uabb' ),
					'fields' => array(
						'spacing'                => array(
							'type'    => 'unit',
							'label'   => __( 'Spacing', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'help'    => __( 'Space between form fields.', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-field',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'form_style'             => array(
							'type'    => 'select',
							'label'   => __( 'Form Style', 'uabb' ),
							'default' => 'style1',
							'options' => array(
								'style1' => __( 'Style 1', 'uabb' ),
								'style2' => __( 'Style 2', 'uabb' ),
							),
							'toggle'  => array(
								'style1' => array(
									'fields' => array( 'input_background_color', 'input_background_color_opc' ),
								),
							),
						),
						'input_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-field input, .uabb-form-field label, .uabb-subscribe-form input[type=text]::placeholder, .uabb-subscribe-form input[type=email]::placeholder',
								'property'  => 'color',
								'important' => true,
							),
						),
						'input_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-field input, .uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
								'property'  => 'background',
								'important' => true,
							),
						),
						'border_width'           => array(
							'type'    => 'unit',
							'label'   => __( 'Border Width', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-field input, .uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
								'property'  => 'border-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-field input, .uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'border_active_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Border Active Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => '',
							'show_reset'  => true,
						),
						'vertical_padding'       => array(
							'type'    => 'unit',
							'label'   => __( 'Vertical Padding', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-form-field input',
										'property'  => 'padding-top',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-form-field input',
										'property'  => 'padding-bottom',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'horizontal_padding'     => array(
							'type'    => 'unit',
							'label'   => __( 'Horizontal Padding', 'uabb' ),
							'default' => '',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-form-field input',
										'property'  => 'padding-left',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-form-field input',
										'property'  => 'padding-right',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
					),
				),
				'terms-checkbox-style' => array(
					'title'  => __( 'Terms Checkbox Style', 'uabb' ),
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
										'selector'  => '.uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
										'property'  => 'width',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
										'property'  => 'height',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'checkbox_bgcolor'        => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
								'property'  => 'background',
								'important' => true,
							),
						),
						'checkbox_selected_color' => array(
							'type'        => 'color',
							'label'       => __( 'Checked Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'checkbox_border_width'   => array(
							'type'    => 'unit',
							'label'   => __( 'Border Width', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-input-group .uabb-terms-label input[type="checkbox"] + span:before',
								'property'  => 'border-width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'checkbox_border_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-input-group .uabb-terms-label input[type="checkbox"] + span:before',
								'property'  => 'border-color',
								'important' => true,
							),
						),
						'checkbox_border_radius'  => array(
							'type'    => 'unit',
							'label'   => __( 'Checkbox Round Corners', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-input-group input[type="checkbox"] + span:before',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'button'     => array(
			'title'    => __( 'Button', 'uabb' ),
			'sections' => array(
				'btn-general'   => array(
					'title'  => __( 'General', 'uabb' ),
					'fields' => array(
						'btn_text'            => array(
							'type'    => 'text',
							'label'   => __( 'Text', 'uabb' ),
							'default' => __( 'Subscribe', 'uabb' ),
							'preview' => array(
								'type'      => 'text',
								'selector'  => '.uabb-form-button .uabb-button-text',
								'important' => true,
							),
						),
						'btn_processing_text' => array(
							'type'    => 'text',
							'label'   => __( 'Processing Text', 'uabb' ),
							'default' => 'Please Wait...',
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
				'btn-style'     => array(
					'title'  => __( 'Style', 'uabb' ),
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
							'toggle'  => array(
								'default'     => array(
									'fields' => array( 'button_padding_dimension', 'button_border', 'border_hover_color' ),
								),
								'gradient'    => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'transparent' => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'threed'      => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
								'flat'        => array(
									'fields' => array( 'btn_width', 'btn_border_radius' ),
								),
							),
						),
						'btn_border_size'                => array(
							'type'   => 'unit',
							'label'  => __( 'Border Size', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
						),
						'btn_transparent_button_options' => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
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
						'btn_flat_button_options'        => array(
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'                => __( 'None', 'uabb' ),
								'animate_to_left'     => __( 'Appear Icon From Right', 'uabb' ),
								'animate_to_right'    => __( 'Appear Icon From Left', 'uabb' ),
								'animate_from_top'    => __( 'Appear Icon From Top', 'uabb' ),
								'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
							),
						),
					),
				),
				'btn-icon'      => array( // Section.
					'title'  => __( 'Icons', 'uabb' ),
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
				'btn-colors'    => array( // Section.
					'title'  => __( 'Colors', 'uabb' ),
					'fields' => array(
						'btn_text_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-button .uabb-button-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'btn_text_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-form-button .uabb-button-wrap a',
										'property'  => 'border-color',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-button:not(.uabb-creative-transparent-btn) .uabb-form-button .uabb-button-wrap a',
										'property'  => 'background',
										'important' => true,
									),
								),
							),
						),
						'btn_bg_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'hover_attribute'      => array(
							'type'    => 'select',
							'label'   => __( 'Apply Hover Color To', 'uabb' ),
							'default' => 'bg',
							'options' => array(
								'border' => __( 'Border', 'uabb' ),
								'bg'     => __( 'Background', 'uabb' ),
							),
							'width'   => '75px',
						),
					),
				),
				'btn-structure' => array(
					'title'  => __( 'Structure', 'uabb' ),
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
							'type'    => 'unit',
							'label'   => __( 'Custom Width', 'uabb' ),
							'default' => '200',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'width',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'btn_custom_height'        => array(
							'type'    => 'unit',
							'label'   => __( 'Custom Height', 'uabb' ),
							'default' => '45',
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'min-height',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'btn_padding_top_bottom'   => array(
							'type'    => 'unit',
							'label'   => __( 'Padding Top/Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding-top',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding-bottom',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'btn_padding_left_right'   => array(
							'type'    => 'unit',
							'label'   => __( 'Padding Left/Right', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding-left',
										'unit'      => 'px',
										'important' => true,
									),
									array(
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding-right',
										'unit'      => 'px',
										'important' => true,
									),
								),
							),
						),
						'btn_border_radius'        => array(
							'type'    => 'unit',
							'label'   => __( 'Round Corners', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border-radius',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'heading_typography'    => array(
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => array(
						'heading_tag_selection' => array(
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
						'heading_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-sf-heading',
								'important' => true,
							),
						),
						'heading_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-sf-heading',
								'property' => 'color',
							),
						),
						'heading_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-sf-heading',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'subheading_typography' => array(
					'title'  => __( 'Sub Heading', 'uabb' ),
					'fields' => array(
						'subheading_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Tag', 'uabb' ),
							'default' => 'h6',
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
						'subheading_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-sf-subheading',
								'important' => true,
							),
						),
						'subheading_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-sf-subheading',
								'property'  => 'color',
								'important' => true,
							),
						),
						'subheading_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-bottom',
								'selector'  => '.uabb-sf-subheading',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'text_typography'       => array(
					'title'  => __( 'Bottom Text', 'uabb' ),
					'fields' => array(
						'text_font_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-sf-bottom-text',
								'important' => true,
							),
						),
						'text_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-sf-bottom-text',
								'property'  => 'color',
								'important' => true,
							),
						),
						'text_margin_top' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'property'  => 'margin-top',
								'selector'  => '.uabb-sf-bottom-text',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'input_typography'      => array(
					'title'  => __( 'Input Text', 'uabb' ),
					'fields' => array(
						'input_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'input[type="text"], input[type="email"], input[type="text"] ~ label, input[type="email"] ~ label',
								'important' => true,
							),
						),
					),
				),
				'btn_typography'        => array(
					'title'  => __( 'Button Text', 'uabb' ),
					'fields' => array(
						'button_font_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'a.uabb-button',
								'important' => true,
							),
						),
						'btn_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Top', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-wrap .uabb-form-button',
								'property'  => 'margin-top',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'btn_margin_bottom' => array(
							'type'    => 'unit',
							'label'   => __( 'Margin Bottom', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-form-wrap .uabb-form-button',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'checkbox_typography'   => array(
					'title'  => __( 'Checkbox Text', 'uabb' ),
					'fields' => array(
						'checkbox_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-terms-label',
								'important' => true,
							),
						),
						'checkbox_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-terms-label',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'terms_typography'      => array(
					'title'  => __( 'Terms and Conditions Text', 'uabb' ),
					'fields' => array(
						'terms_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-terms-text',
								'important' => true,
							),
						),
						'terms_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-subscribe-form .uabb-terms-text',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
