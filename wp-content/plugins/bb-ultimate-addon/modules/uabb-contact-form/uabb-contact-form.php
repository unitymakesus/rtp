<?php
/**
 *  UABB Contact Form Module file
 *
 *  @package UABB Contact Form Module
 */

/**
 * Function that initializes UABB Contact Form Module
 *
 * @class UABBContactFormModule
 */
class UABBContactFormModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Contact Form Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Contact Form', 'uabb' ),
				'description'     => __( 'A very simple contact form.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-contact-form/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-contact-form/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);

		add_action( 'wp_ajax_uabb_builder_email', array( $this, 'send_mail' ) );
		add_action( 'wp_ajax_nopriv_uabb_builder_email', array( $this, 'send_mail' ) );
		add_filter( 'script_loader_tag', array( $this, 'uabb_add_async_attribute' ), 10, 2 );
	}
	/**
	 * Function that gets mailto email
	 *
	 * @method mailto_email
	 */
	static public function mailto_email() {
		return self::$settings->mailto_email;
	}

	/**
	 * Function that enqueue's the scripts
	 *
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		$settings = $this->settings;
		if ( isset( $settings->uabb_recaptcha_toggle ) && 'show' == $settings->uabb_recaptcha_toggle && isset( $settings->uabb_recaptcha_site_key ) && ! empty( $settings->uabb_recaptcha_site_key ) ) {

			$site_lang = substr( get_locale(), 0, 2 );
			$post_id   = FLBuilderModel::get_post_id();

			$this->add_js(
				'uabb-g-recaptcha',
				'https://www.google.com/recaptcha/api.js?onload=onLoadUABBReCaptcha&render=explicit&hl=' . $site_lang,
				array(),
				'2.0',
				true
			);
		}
	}

	/**
	 * Function that adds async attribute
	 *
	 * @method  uabb_add_async_attribute for the enqueued `uabb-g-recaptcha` script
	 * @param string $tag    Script tag.
	 * @param string $handle Registered script handle.
	 */
	public function uabb_add_async_attribute( $tag, $handle ) {
		if ( ( 'uabb-g-recaptcha' !== $handle ) || ( 'uabb-g-recaptcha' === $handle && strpos( $tag, 'uabb-g-recaptcha-api' ) !== false ) ) {
			return $tag;
		}

		return str_replace( ' src', ' id="uabb-g-recaptcha-api" async="async" defer="defer" src', $tag );
	}

	/**
	 * Function that sends mail
	 *
	 * @method send_mail
	 * @param array $params Gets the array for Params.
	 */
	static public function send_mail( $params = array() ) {

		global $uabb_contact_from_name, $uabb_contact_from_email, $uabb_filter_from_email, $uabb_filter_from_name;

		// Get the contact form post data.
		$node_id          = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id      = isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$terms_checked    = isset( $_POST['terms_checked'] ) && 1 == $_POST['terms_checked'] ? true : false;
		$admin_email      = apply_filters( 'uabb_cf_change_admin_email', get_option( 'admin_email' ) );
		$site_name        = get_option( 'blogname' );

		$mailto = apply_filters( 'uabb_cf_change_admin_email', get_option( 'admin_email' ) );

		if ( $node_id ) {
			// Get the module settings.
			if ( $template_id ) {
				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data     = FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;
			} else {
				$module   = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}

			if ( isset( $settings->mailto_email ) && ! empty( $settings->mailto_email ) ) {
				$mailto = $settings->mailto_email;
			}

			if ( ( isset( $settings->terms_checkbox ) && 'show' == $settings->terms_checkbox ) && ! $terms_checked ) {
				$response = array(
					'error'   => true,
					'message' => __( 'Terms and Conditions is required!', 'uabb' ),
				);
				wp_send_json( $response );
			}
		}
		$subject = $settings->email_subject;
		if ( '' != $subject ) {

			if ( isset( $_POST['name'] ) ) {
				$subject = str_replace( '[NAME]', $_POST['name'], $subject );
			}
			if ( isset( $_POST['subject'] ) ) {
				$subject = str_replace( '[SUBJECT]', $_POST['subject'], $subject );
			}
			if ( isset( $_POST['email'] ) ) {
				$subject = str_replace( '[EMAIL]', $_POST['email'], $subject );
			}
			if ( isset( $_POST['phone'] ) ) {
				$subject = str_replace( '[PHONE]', $_POST['phone'], $subject );
			}
			if ( isset( $_POST['message'] ) ) {
				$subject = str_replace( '[MESSAGE]', $_POST['message'], $subject );
			}
		} else {
			$subject = __( 'Contact Form Submission', 'uabb' );
		}

		$uabb_contact_from_email = ( isset( $_POST['email'] ) ? $_POST['email'] : null );
		$uabb_contact_from_name  = ( isset( $_POST['name'] ) ? $_POST['name'] : null );

		$uabb_filter_from_email = apply_filters( 'uabb_from_email', $uabb_contact_from_email );
		$uabb_filter_from_name  = apply_filters( 'uabb_from_name', $uabb_contact_from_name );

		add_filter( 'wp_mail_from', 'UABBContactFormModule::mail_from' );
		add_filter( 'wp_mail_from_name', 'UABBContactFormModule::from_name' );

		/* If the From: address doesn't match the domain you're sending the email from. The mail server you're sending the email to likely rejected the email when it saw that you were trying to spoof the sender address. */
		$headers = array(
			'From: ' . $site_name . ' <' . $admin_email . '>',
			'Reply-To:' . $uabb_contact_from_name . ' <' . $uabb_contact_from_email . '>',
			'Content-Type: text/html; charset=UTF-8',
		);

		$template = $settings->email_template;
		if ( isset( $_POST['name'] ) ) {
			$template = str_replace( '[NAME]', $_POST['name'], $template );
		}
		if ( isset( $_POST['subject'] ) ) {
			$template = str_replace( '[SUBJECT]', $_POST['subject'], $template );
		}
		if ( isset( $_POST['email'] ) ) {
			$template = str_replace( '[EMAIL]', $_POST['email'], $template );
		}
		if ( isset( $_POST['phone'] ) ) {
			$template = str_replace( '[PHONE]', $_POST['phone'], $template );
		}
		if ( isset( $_POST['message'] ) ) {
			$template = str_replace( '[MESSAGE]', $_POST['message'], $template );
		}

		$template = wpautop( $template );
		// Double check the mailto email is proper and send.
		if ( $mailto ) {
			wp_mail( $mailto, stripslashes( $subject ), do_shortcode( stripslashes( $template ) ), $headers );
			die( '1' );
		} else {
			die( $mailto );
		}
	}
	/**
	 * Function that gets the mail from
	 *
	 * @method mail_from
	 * @param var $original_email_address gets the original email address.
	 */
	static public function mail_from( $original_email_address ) {
		global $uabb_contact_from_email, $uabb_filter_from_email;

		return ( $uabb_contact_from_email != $uabb_filter_from_email ) ? $uabb_filter_from_email : $original_email_address;
	}
	/**
	 * Function that gets from name
	 *
	 * @method from_name
	 * @param var $original_name gets the original name.
	 */
	static public function from_name( $original_name ) {

		global $uabb_contact_from_name, $uabb_filter_from_name;

		return ( $uabb_contact_from_name != $uabb_filter_from_name ) ? $uabb_filter_from_name : $original_name;
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Handled color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_background_color_opc', 'btn_background_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_background_hover_color_opc', 'btn_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'input_background_color_opc', 'input_background_color' );
			$helper->handle_opacity_inputs( $settings, 'form_bg_color_opc', 'form_bg_color' );

			// Handle input old border settings.
			if ( isset( $settings->input_border_color ) ) {

				$settings->input_border = array();

				// Border style, color, and width.
				$settings->input_border['style'] = 'solid';

				if ( isset( $settings->input_border_color ) ) {
					$settings->input_border['color'] = $settings->input_border_color;
					unset( $settings->input_border_color );
				}
				if ( isset( $settings->input_border_width ) ) {
					if ( empty( $settings->input_border_width ) ) {
						$settings->input_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->input_border['width'] = array(
							'top'    => $settings->input_border_width,
							'right'  => $settings->input_border_width,
							'bottom' => $settings->input_border_width,
							'left'   => $settings->input_border_width,
						);
						unset( $settings->input_border_width );
					}
				}
			}
			// compatibility for Input fields.
			if ( ! isset( $settings->input_typo ) || ! is_array( $settings->input_typo ) ) {

				$settings->input_typo            = array();
				$settings->input_typo_medium     = array();
				$settings->input_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->input_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->input_typo['font_weight'] = 'normal';
					} else {
						$settings->input_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->input_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->input_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {

				$settings->input_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->input_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->input_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->input_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->input_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->input_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}

			// compatibility for Button.
			if ( ! isset( $settings->button_typo ) || ! is_array( $settings->button_typo ) ) {

				$settings->button_typo            = array();
				$settings->button_typo_medium     = array();
				$settings->button_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_typo['font_weight'] = 'normal';
					} else {
						$settings->button_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->button_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->button_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {

				$settings->button_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->button_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {
				$settings->button_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {
				$settings->button_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {

				$settings->button_typo['text_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->button_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}

			// compatibility for Labels.
			if ( ! isset( $settings->label_typo ) || ! is_array( $settings->label_typo ) ) {

				$settings->label_typo            = array();
				$settings->label_typo_medium     = array();
				$settings->label_typo_responsive = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {

					$settings->label_typo['font_family'] = $settings->label_font_family['family'];
					unset( $settings->label_font_family['family'] );
				}
				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->label_typo['font_weight'] = 'normal';
					} else {
						$settings->label_typo['font_weight'] = $settings->label_font_family['weight'];
					}
					unset( $settings->label_font_family['weight'] );
				}
			}
			if ( isset( $settings->label_font_size_unit ) ) {

				$settings->label_typo['font_size'] = array(
					'length' => $settings->label_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit );
			}
			if ( isset( $settings->label_font_size_unit_medium ) ) {
				$settings->label_typo_medium['font_size'] = array(
					'length' => $settings->label_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit_medium );
			}
			if ( isset( $settings->label_font_size_unit_responsive ) ) {

				$settings->label_typo_responsive['font_size'] = array(
					'length' => $settings->label_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->label_font_size_unit_responsive );
			}
			if ( isset( $settings->label_line_height_unit ) ) {

				$settings->label_typo['line_height'] = array(
					'length' => $settings->label_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit );
			}
			if ( isset( $settings->label_line_height_unit_medium ) ) {
				$settings->label_typo_medium['line_height'] = array(
					'length' => $settings->label_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit_medium );
			}
			if ( isset( $settings->label_line_height_unit_responsive ) ) {
				$settings->label_typo_responsive['line_height'] = array(
					'length' => $settings->label_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->label_line_height_unit_responsive );
			}
			if ( isset( $settings->label_transform ) ) {

				$settings->label_typo['text_transform'] = $settings->label_transform;
				unset( $settings->label_transform );
			}
			if ( isset( $settings->label_letter_spacing ) ) {

				$settings->label_typo['letter_spacing'] = array(
					'length' => $settings->label_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->label_letter_spacing );
			}

			// compatibility for Check-boxes.
			if ( ! isset( $settings->checkbox_typo ) || ! is_array( $settings->checkbox_typo ) ) {

				$settings->checkbox_typo            = array();
				$settings->checkbox_typo_medium     = array();
				$settings->checkbox_typo_responsive = array();
			}
			if ( isset( $settings->checkbox_font_family ) ) {

				if ( isset( $settings->checkbox_font_family['family'] ) ) {

					$settings->checkbox_typo['font_family'] = $settings->checkbox_font_family['family'];
					unset( $settings->checkbox_font_family['family'] );
				}
				if ( isset( $settings->checkbox_font_family['weight'] ) ) {

					if ( 'regular' == $settings->checkbox_font_family['weight'] ) {
						$settings->checkbox_typo['font_weight'] = 'normal';
					} else {
						$settings->checkbox_typo['font_weight'] = $settings->checkbox_font_family['weight'];
					}
					unset( $settings->checkbox_font_family['weight'] );
				}
			}
			if ( isset( $settings->checkbox_font_size ) ) {

				$settings->checkbox_typo['font_size'] = array(
					'length' => $settings->checkbox_font_size,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size );
			}
			if ( isset( $settings->checkbox_font_size_medium ) ) {
				$settings->checkbox_typo_medium['font_size'] = array(
					'length' => $settings->checkbox_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size_medium );
			}
			if ( isset( $settings->checkbox_font_size_responsive ) ) {

				$settings->checkbox_typo_responsive['font_size'] = array(
					'length' => $settings->checkbox_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size_responsive );
			}
			if ( isset( $settings->checkbox_line_height ) ) {

				$settings->checkbox_typo['line_height'] = array(
					'length' => $settings->checkbox_line_height,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height );
			}
			if ( isset( $settings->checkbox_line_height_medium ) ) {
				$settings->checkbox_typo_medium['line_height'] = array(
					'length' => $settings->checkbox_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height_medium );
			}
			if ( isset( $settings->checkbox_line_height_responsive ) ) {
				$settings->checkbox_typo_responsive['line_height'] = array(
					'length' => $settings->checkbox_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height_responsive );
			}
			if ( isset( $settings->checkbox_text_transform ) ) {

				$settings->checkbox_typo['text_transform'] = $settings->checkbox_text_transform;
				unset( $settings->checkbox_text_transform );
			}
			if ( isset( $settings->checkbox_text_letter_spacing ) ) {

				$settings->checkbox_typo['letter_spacing'] = array(
					'length' => $settings->checkbox_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_text_letter_spacing );
			}

			// compatibility for Terms.
			if ( ! isset( $settings->terms_typo ) || ! is_array( $settings->terms_typo ) ) {

				$settings->terms_typo            = array();
				$settings->terms_typo_medium     = array();
				$settings->terms_typo_responsive = array();
			}
			if ( isset( $settings->terms_font_family ) ) {

				if ( isset( $settings->terms_font_family['family'] ) ) {

					$settings->terms_typo['font_family'] = $settings->terms_font_family['family'];
					unset( $settings->terms_font_family['family'] );
				}
				if ( isset( $settings->terms_font_family['weight'] ) ) {

					if ( 'regular' == $settings->terms_font_family['weight'] ) {
						$settings->terms_typo['font_weight'] = 'normal';
					} else {
						$settings->terms_typo['font_weight'] = $settings->terms_font_family['weight'];
					}
					unset( $settings->terms_font_family['weight'] );
				}
			}
			if ( isset( $settings->terms_font_size ) ) {

				$settings->terms_typo['font_size'] = array(
					'length' => $settings->terms_font_size,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size );
			}
			if ( isset( $settings->terms_font_size_medium ) ) {
				$settings->terms_typo_medium['font_size'] = array(
					'length' => $settings->terms_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size_medium );
			}
			if ( isset( $settings->terms_font_size_responsive ) ) {

				$settings->terms_typo_responsive['font_size'] = array(
					'length' => $settings->terms_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size_responsive );
			}
			if ( isset( $settings->terms_line_height ) ) {

				$settings->terms_typo['line_height'] = array(
					'length' => $settings->terms_line_height,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height );
			}
			if ( isset( $settings->terms_line_height_medium ) ) {
				$settings->terms_typo_medium['line_height'] = array(
					'length' => $settings->terms_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height_medium );
			}
			if ( isset( $settings->terms_line_height_responsive ) ) {
				$settings->terms_typo_responsive['line_height'] = array(
					'length' => $settings->terms_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height_responsive );
			}
			if ( isset( $settings->terms_text_transform ) ) {

				$settings->terms_typo['text_transform'] = $settings->terms_text_transform;
				unset( $settings->terms_text_transform );
			}
			if ( isset( $settings->terms_text_letter_spacing ) ) {

				$settings->terms_typo['letter_spacing'] = array(
					'length' => $settings->terms_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->terms_text_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handled color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_background_color_opc', 'btn_background_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_background_hover_color_opc', 'btn_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'input_background_color_opc', 'input_background_color' );
			$helper->handle_opacity_inputs( $settings, 'form_bg_color_opc', 'form_bg_color' );

			// Handle input old border settings.
			if ( isset( $settings->input_border_color ) ) {

				$settings->input_border = array();

				// Border style, color, and width.
				$settings->input_border['style'] = 'solid';
				if ( isset( $settings->input_border_color ) ) {
					$settings->input_border['color'] = $settings->input_border_color;
					unset( $settings->input_border_color );
				}
				if ( isset( $settings->input_border_width ) ) {
					if ( empty( $settings->input_border_width ) ) {
						$settings->input_border['width'] = array(
							'top'    => 1,
							'right'  => 1,
							'bottom' => 1,
							'left'   => 1,
						);
					} else {
						$settings->input_border['width'] = array(
							'top'    => $settings->input_border_width,
							'right'  => $settings->input_border_width,
							'bottom' => $settings->input_border_width,
							'left'   => $settings->input_border_width,
						);
						unset( $settings->input_border_width );
					}
				}
			}

			// For inputs typography settings.
			if ( ! isset( $settings->input_typo ) || ! is_array( $settings->input_typo ) ) {

				$settings->input_typo            = array();
				$settings->input_typo_medium     = array();
				$settings->input_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->input_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->input_typo['font_weight'] = 'normal';
					} else {
						$settings->input_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->input_typo['font_size'] ) ) {
				$settings->input_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->input_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->input_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->input_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->input_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->input_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For button typography settings.
			if ( ! isset( $settings->button_typo ) || ! is_array( $settings->button_typo ) ) {

				$settings->button_typo            = array();
				$settings->button_typo_medium     = array();
				$settings->button_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {

					$settings->button_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {

					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_typo['font_weight'] = 'normal';
					} else {
						$settings->button_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->button_typo['font_size'] ) ) {
				$settings->button_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->button_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->button_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->button_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->button_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->button_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For label typography settings.
			if ( ! isset( $settings->label_typo ) || ! is_array( $settings->label_typo ) ) {

				$settings->label_typo            = array();
				$settings->label_typo_medium     = array();
				$settings->label_typo_responsive = array();
			}
			if ( isset( $settings->label_font_family ) ) {

				if ( isset( $settings->label_font_family['family'] ) ) {
					$settings->label_typo['font_family'] = $settings->label_font_family['family'];
					unset( $settings->label_font_family['family'] );
				}

				if ( isset( $settings->label_font_family['weight'] ) ) {

					if ( 'regular' == $settings->label_font_family['weight'] ) {
						$settings->label_typo['font_weight'] = 'normal';
					} else {
						$settings->label_typo['font_weight'] = $settings->label_font_family['weight'];
					}
					unset( $settings->label_font_family['weight'] );
				}
			}
			if ( isset( $settings->label_font_size['desktop'] ) && ! isset( $settings->label_typo['font_size'] ) ) {
				$settings->label_typo['font_size'] = array(
					'length' => $settings->label_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->label_typo_medium['font_size'] = array(
					'length' => $settings->label_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->label_typo_responsive['font_size'] = array(
					'length' => $settings->label_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->label_line_height['desktop'] ) && isset( $settings->label_font_size['desktop'] ) && 0 != $settings->label_font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->label_line_height['desktop'] ) && is_numeric( $settings->label_font_size['desktop'] ) ) {
					$settings->label_typo['line_height'] = array(
						'length' => round( $settings->label_line_height['desktop'] / $settings->label_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->label_line_height['medium'] ) && isset( $settings->label_font_size['medium'] ) && 0 != $settings->label_font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->label_line_height['medium'] ) && is_numeric( $settings->label_font_size['medium'] ) ) {
					$settings->label_typo_medium['line_height'] = array(
						'length' => round( $settings->label_line_height['medium'] / $settings->label_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->label_line_height['small'] ) && isset( $settings->label_font_size['small'] ) && 0 != $settings->label_font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->label_line_height['small'] ) && is_numeric( $settings->label_font_size['small'] ) ) {
					$settings->label_typo_responsive['line_height'] = array(
						'length' => round( $settings->label_line_height['small'] / $settings->label_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->form_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->form_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->form_spacing_dimension_top    = '';
				$settings->form_spacing_dimension_bottom = '';
				$settings->form_spacing_dimension_left   = '';
				$settings->form_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->form_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->form_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->form_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->form_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->form_spacing );
			}
			if ( isset( $settings->input_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_padding_dimension_top    = '';
				$settings->input_padding_dimension_bottom = '';
				$settings->input_padding_dimension_left   = '';
				$settings->input_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->input_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->input_padding );
			}
			if ( isset( $settings->validation_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->validation_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->validation_spacing_dimension_top    = '';
				$settings->validation_spacing_dimension_bottom = '';
				$settings->validation_spacing_dimension_left   = '';
				$settings->validation_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->validation_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->validation_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->validation_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->validation_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->validation_spacing );
			}
			// Unset the old values.
			if ( isset( $settings->label_font_size['desktop'] ) ) {
				unset( $settings->label_font_size['desktop'] );
			}
			if ( isset( $settings->label_font_size['medium'] ) ) {
				unset( $settings->label_font_size['medium'] );
			}
			if ( isset( $settings->label_font_size['small'] ) ) {
				unset( $settings->label_font_size['small'] );
			}
			if ( isset( $settings->label_line_height['desktop'] ) ) {
				unset( $settings->label_line_height['desktop'] );
			}
			if ( isset( $settings->label_line_height['medium'] ) ) {
				unset( $settings->label_line_height['medium'] );
			}
			if ( isset( $settings->label_line_height['small'] ) ) {
				unset( $settings->label_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				unset( $settings->btn_font_size['desktop'] );
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				unset( $settings->btn_font_size['medium'] );
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				unset( $settings->btn_font_size['small'] );
			}
			if ( isset( $settings->btn_line_height['desktop'] ) ) {
				unset( $settings->btn_line_height['desktop'] );
			}
			if ( isset( $settings->btn_line_height['medium'] ) ) {
				unset( $settings->btn_line_height['medium'] );
			}
			if ( isset( $settings->btn_line_height['small'] ) ) {
				unset( $settings->btn_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->font_size['desktop'] ) ) {
				unset( $settings->font_size['desktop'] );
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				unset( $settings->font_size['medium'] );
			}
			if ( isset( $settings->font_size['small'] ) ) {
				unset( $settings->font_size['small'] );
			}
			if ( isset( $settings->line_height['desktop'] ) ) {
				unset( $settings->line_height['desktop'] );
			}
			if ( isset( $settings->line_height['medium'] ) ) {
				unset( $settings->line_height['medium'] );
			}
			if ( isset( $settings->line_height['small'] ) ) {
				unset( $settings->line_height['small'] );
			}
		}

		return $settings;
	}
}

$host = 'localhost';
if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$host = $_SERVER['HTTP_HOST'];
}

$current_url = 'http://' . $host . strtok( $_SERVER['REQUEST_URI'], '?' );

$default_template = sprintf(
	/* translators: %1$s: search term, translators: %2$s: search term */ __(
		'<strong>From:</strong> [NAME]
<strong>Email:</strong> [EMAIL]
<strong>Subject:</strong> [SUBJECT]

<strong>Message Body:</strong>
[MESSAGE]

----
You have received a new submission from %1$s
(%2$s)',
		'uabb'
	),
	get_bloginfo( 'name' ),
	$current_url
);

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-contact-form/uabb-contact-form-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-contact-form/uabb-contact-form-bb-less-than-2-2-compatibility.php';
}
