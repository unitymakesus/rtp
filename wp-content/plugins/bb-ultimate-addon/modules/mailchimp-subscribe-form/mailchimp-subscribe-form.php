<?php
/**
 * A module that adds a simple subscribe form to your layout
 * with third party optin integration.
 *
 * @since 1.5.2
 * @package UABB Subscribe Form Module
 */

/**
 * Function that initializes Subscribe Form Module
 *
 * @class UABBSubscribeFormModule
 */
class UABBSubscribeFormModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Icon List Module
	 *
	 * @since 1.5.2
	 * @return void
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Subscription Form', 'uabb' ),
				'description'     => __( 'Adds a simple subscribe form to your layout.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/mailchimp-subscribe-form/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/mailchimp-subscribe-form/',
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);

		add_action( 'wp_ajax_uabb_subscribe_form_submit', array( $this, 'submit' ) );
		add_action( 'wp_ajax_nopriv_uabb_subscribe_form_submit', array( $this, 'submit' ) );
	}

	/**
	 * Called via AJAX to submit the subscribe form.
	 *
	 * @since 1.5.2
	 */
	public function submit() {
		$fname            = isset( $_POST['fname'] ) ? sanitize_text_field( $_POST['fname'] ) : false;
		$lname            = isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname'] ) : false;
		$name             = ( isset( $fname ) || isset( $lname ) ) ? sanitize_text_field( $fname . ' ' . $lname ) : false;
		$email            = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$node_id          = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id      = isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$result           = array(
			'action'  => false,
			'error'   => false,
			'message' => false,
			'url'     => false,
		);

		if ( $email && $node_id ) {

			// Get the module settings.
			if ( $template_id ) {
				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data     = FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;
			} else {
				$module   = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}

			// Subscribe.
			$instance = FLBuilderServices::get_service_instance( $settings->service );
			$response = $instance->subscribe( $settings, $email, $name );

			// Check for an error from the service.
			if ( $response['error'] ) {
				$result['error'] = $response['error'];
			} else {
				// Setup the success data.
				$result['action'] = $settings->success_action;

				if ( 'message' == $settings->success_action ) {
					$result['message'] = $settings->success_message;
				} else {
					$result['url'] = $settings->success_url;
				}
			}
		} else {
			$result['error'] = __( 'There was an error subscribing. Please try again.', 'uabb' );
		}

		echo json_encode( $result );

		die();
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
			// Handle color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );
			$helper->handle_opacity_inputs( $settings, 'input_background_color_opc', 'input_background_color' );

			// compatibility for Heading.
			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {
				if ( isset( $settings->heading_font_family['family'] ) ) {
					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];
					unset( $settings->heading_font_family['family'] );
				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
					unset( $settings->heading_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size_unit ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit );
			}
			if ( isset( $settings->heading_font_size_unit_medium ) ) {

				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_medium );
			}
			if ( isset( $settings->heading_font_size_unit_responsive ) ) {

				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_responsive );
			}
			if ( isset( $settings->heading_line_height_unit ) ) {

				$settings->heading_font_typo['line_height'] = array(
					'length' => $settings->heading_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit );
			}
			if ( isset( $settings->heading_line_height_unit_medium ) ) {

				$settings->heading_font_typo_medium['line_height'] = array(
					'length' => $settings->heading_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_medium );
			}
			if ( isset( $settings->heading_line_height_unit_responsive ) ) {

				$settings->heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_responsive );
			}
			if ( isset( $settings->heading_transform ) ) {

				$settings->heading_font_typo['text_transform'] = $settings->heading_transform;
				unset( $settings->heading_transform );
			}
			if ( isset( $settings->heading_letter_spacing ) ) {

				$settings->heading_font_typo['letter_spacing'] = array(
					'length' => $settings->heading_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->heading_letter_spacing );
			}

			// compatibility for Subheading.
			if ( ! isset( $settings->subheading_font_typo ) || ! is_array( $settings->subheading_font_typo ) ) {

				$settings->subheading_font_typo            = array();
				$settings->subheading_font_typo_medium     = array();
				$settings->subheading_font_typo_responsive = array();
			}
			if ( isset( $settings->subheading_font_family ) ) {
				if ( isset( $settings->subheading_font_family['family'] ) ) {
					$settings->subheading_font_typo['font_family'] = $settings->subheading_font_family['family'];
					unset( $settings->subheading_font_family['family'] );
				}
				if ( isset( $settings->subheading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->subheading_font_family['weight'] ) {
						$settings->subheading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->subheading_font_typo['font_weight'] = $settings->subheading_font_family['weight'];
					}
					unset( $settings->subheading_font_family['weight'] );
				}
			}
			if ( isset( $settings->subheading_font_size_unit ) ) {

				$settings->subheading_font_typo['font_size'] = array(
					'length' => $settings->subheading_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->subheading_font_size_unit );
			}
			if ( isset( $settings->subheading_font_size_unit_medium ) ) {

				$settings->subheading_font_typo_medium['font_size'] = array(
					'length' => $settings->subheading_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->subheading_font_size_unit_medium );
			}
			if ( isset( $settings->subheading_font_size_unit_responsive ) ) {

				$settings->subheading_font_typo_responsive['font_size'] = array(
					'length' => $settings->subheading_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->subheading_font_size_unit_responsive );
			}
			if ( isset( $settings->subheading_line_height_unit ) ) {

				$settings->subheading_font_typo['line_height'] = array(
					'length' => $settings->subheading_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->subheading_line_height_unit );
			}
			if ( isset( $settings->subheading_line_height_unit_medium ) ) {

				$settings->subheading_font_typo_medium['line_height'] = array(
					'length' => $settings->subheading_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->subheading_line_height_unit_medium );
			}
			if ( isset( $settings->subheading_line_height_unit_responsive ) ) {

				$settings->subheading_font_typo_responsive['line_height'] = array(
					'length' => $settings->subheading_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->subheading_line_height_unit_responsive );
			}
			if ( isset( $settings->subheading_transform ) ) {

				$settings->subheading_font_typo['text_transform'] = $settings->subheading_transform;
				unset( $settings->subheading_transform );
			}
			if ( isset( $settings->subheading_letter_spacing ) ) {

				$settings->subheading_font_typo['letter_spacing'] = array(
					'length' => $settings->subheading_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->subheading_letter_spacing );
			}

			// compatibility for text description.
			if ( ! isset( $settings->text_font_typo ) || ! is_array( $settings->text_font_typo ) ) {

				$settings->text_font_typo            = array();
				$settings->text_font_typo_medium     = array();
				$settings->text_font_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) ) {
				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_font_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_font_typo['font_weight'] = 'normal';
					} else {
						$settings->text_font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
			}
			if ( isset( $settings->text_font_size_unit ) ) {

				$settings->text_font_typo['font_size'] = array(
					'length' => $settings->text_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit );
			}
			if ( isset( $settings->text_font_size_unit_medium ) ) {

				$settings->text_font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_medium );
			}
			if ( isset( $settings->text_font_size_unit_responsive ) ) {

				$settings->text_font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->text_font_size_unit_responsive );
			}
			if ( isset( $settings->text_line_height_unit ) ) {

				$settings->text_font_typo['line_height'] = array(
					'length' => $settings->text_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit );
			}
			if ( isset( $settings->text_line_height_unit_medium ) ) {

				$settings->text_font_typo_medium['line_height'] = array(
					'length' => $settings->text_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_medium );
			}
			if ( isset( $settings->text_line_height_unit_responsive ) ) {

				$settings->text_font_typo_responsive['line_height'] = array(
					'length' => $settings->text_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->text_line_height_unit_responsive );
			}
			if ( isset( $settings->text_transform ) ) {

				$settings->text_font_typo['text_transform'] = $settings->text_transform;
				unset( $settings->text_transform );
			}
			if ( isset( $settings->text_letter_spacing ) ) {

				$settings->text_font_typo['letter_spacing'] = array(
					'length' => $settings->text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->text_letter_spacing );
			}

			// compatibility for inputs.
			if ( ! isset( $settings->input_font_typo ) || ! is_array( $settings->input_font_typo ) ) {

				$settings->input_font_typo            = array();
				$settings->input_font_typo_medium     = array();
				$settings->input_font_typo_responsive = array();
			}
			if ( isset( $settings->input_font_family ) ) {
				if ( isset( $settings->input_font_family['family'] ) ) {
					$settings->input_font_typo['font_family'] = $settings->input_font_family['family'];
					unset( $settings->input_font_family['family'] );
				}
				if ( isset( $settings->input_font_family['weight'] ) ) {
					if ( 'regular' == isset( $settings->input_font_family['weight'] ) ) {
						$settings->input_font_typo['font_weight'] = 'normal';
					} else {
						$settings->input_font_typo['font_weight'] = $settings->input_font_family['weight'];
					}
					unset( $settings->input_font_family['weight'] );
				}
			}
			if ( isset( $settings->input_font_size_unit ) ) {

				$settings->input_font_typo['font_size'] = array(
					'length' => $settings->input_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->input_font_size_unit );
			}
			if ( isset( $settings->input_font_size_unit_medium ) ) {

				$settings->input_font_typo_medium['font_size'] = array(
					'length' => $settings->input_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->input_font_size_unit_medium );
			}
			if ( isset( $settings->input_font_size_unit_responsive ) ) {

				$settings->input_font_typo_responsive['font_size'] = array(
					'length' => $settings->input_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->input_font_size_unit_responsive );
			}
			if ( isset( $settings->input_line_height_unit ) ) {

				$settings->input_font_typo['line_height'] = array(
					'length' => $settings->input_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->input_line_height_unit );
			}
			if ( isset( $settings->input_line_height_unit_medium ) ) {

				$settings->input_font_typo_medium['line_height'] = array(
					'length' => $settings->input_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->input_line_height_unit_medium );
			}
			if ( isset( $settings->input_line_height_unit_responsive ) ) {

				$settings->input_font_typo_responsive['line_height'] = array(
					'length' => $settings->input_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->input_line_height_unit_responsive );
			}
			if ( isset( $settings->input_transform ) ) {

				$settings->input_font_typo['text_transform'] = $settings->input_transform;
				unset( $settings->input_transform );
			}
			if ( isset( $settings->input_letter_spacing ) ) {

				$settings->input_font_typo['letter_spacing'] = array(
					'length' => $settings->input_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->input_letter_spacing );
			}

			// compatibility for button.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->button_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {

				$settings->button_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {

				$settings->button_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->button_font_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {

				$settings->button_font_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {

				$settings->button_font_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {

				$settings->button_font_typo['text_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->button_font_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}

			// compatibility for check-box.
			if ( ! isset( $settings->checkbox_font_typo ) || ! is_array( $settings->checkbox_font_typo ) ) {

				$settings->checkbox_font_typo            = array();
				$settings->checkbox_font_typo_medium     = array();
				$settings->checkbox_font_typo_responsive = array();
			}
			if ( isset( $settings->checkbox_font_family ) ) {
				if ( isset( $settings->checkbox_font_family['family'] ) ) {

					$settings->checkbox_font_typo['font_family'] = $settings->checkbox_font_family['family'];
					unset( $settings->checkbox_font_family['family'] );
				}
				if ( isset( $settings->checkbox_font_family['weight'] ) ) {
					if ( 'regular' == $settings->checkbox_font_family['weight'] ) {
						$settings->checkbox_font_typo['font_weight'] = 'normal';
					} else {
						$settings->checkbox_font_typo['font_weight'] = $settings->checkbox_font_family['weight'];
					}
					unset( $settings->checkbox_font_family['weight'] );
				}
			}
			if ( isset( $settings->checkbox_font_size ) ) {

				$settings->checkbox_font_typo['font_size'] = array(
					'length' => $settings->checkbox_font_size,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size );
			}
			if ( isset( $settings->checkbox_font_size_medium ) ) {

				$settings->checkbox_font_typo_medium['font_size'] = array(
					'length' => $settings->checkbox_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size_medium );
			}
			if ( isset( $settings->checkbox_font_size_responsive ) ) {

				$settings->checkbox_font_typo_responsive['font_size'] = array(
					'length' => $settings->checkbox_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_font_size_responsive );
			}
			if ( isset( $settings->checkbox_line_height ) ) {

				$settings->checkbox_font_typo['line_height'] = array(
					'length' => $settings->checkbox_line_height,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height );
			}
			if ( isset( $settings->checkbox_line_height_medium ) ) {

				$settings->checkbox_font_typo_medium['line_height'] = array(
					'length' => $settings->checkbox_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height_medium );
			}
			if ( isset( $settings->checkbox_line_height_responsive ) ) {

				$settings->checkbox_font_typo_responsive['line_height'] = array(
					'length' => $settings->checkbox_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->checkbox_line_height_responsive );
			}
			if ( isset( $settings->checkbox_text_transform ) ) {

				$settings->checkbox_font_typo['text_transform'] = $settings->checkbox_text_transform;
				unset( $settings->checkbox_text_transform );
			}
			if ( isset( $settings->checkbox_text_letter_spacing ) ) {

				$settings->checkbox_font_typo['letter_spacing'] = array(
					'length' => $settings->checkbox_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->checkbox_text_letter_spacing );
			}

			// compatibility for terms.
			if ( ! isset( $settings->terms_font_typo ) || ! is_array( $settings->terms_font_typo ) ) {

				$settings->terms_font_typo            = array();
				$settings->terms_font_typo_medium     = array();
				$settings->terms_font_typo_responsive = array();
			}
			if ( isset( $settings->terms_font_family ) ) {
				if ( isset( $settings->terms_font_family['family'] ) ) {

					$settings->terms_font_typo['font_family'] = $settings->terms_font_family['family'];
					unset( $settings->terms_font_family['family'] );
				}
				if ( isset( $settings->terms_font_family['weight'] ) ) {
					if ( 'regular' == isset( $settings->terms_font_family['weight'] ) ) {
						$settings->terms_font_typo['font_weight'] = 'normal';
					} else {
						$settings->terms_font_typo['font_weight'] = $settings->terms_font_family['weight'];
					}
					unset( $settings->terms_font_family['weight'] );
				}
			}
			if ( isset( $settings->terms_font_size ) ) {

				$settings->terms_font_typo['font_size'] = array(
					'length' => $settings->terms_font_size,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size );
			}
			if ( isset( $settings->terms_font_size_medium ) ) {

				$settings->terms_font_typo_medium['font_size'] = array(
					'length' => $settings->terms_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size_medium );
			}
			if ( isset( $settings->terms_font_size_responsive ) ) {

				$settings->terms_font_typo_responsive['font_size'] = array(
					'length' => $settings->terms_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->terms_font_size_responsive );
			}
			if ( isset( $settings->terms_line_height ) ) {

				$settings->terms_font_typo['line_height'] = array(
					'length' => $settings->terms_line_height,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height );
			}
			if ( isset( $settings->terms_line_height_medium ) ) {

				$settings->terms_font_typo_medium['line_height'] = array(
					'length' => $settings->terms_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height_medium );
			}
			if ( isset( $settings->terms_line_height_responsive ) ) {

				$settings->terms_font_typo_responsive['line_height'] = array(
					'length' => $settings->terms_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->terms_line_height_responsive );
			}
			if ( isset( $settings->terms_text_transform ) ) {

				$settings->terms_font_typo['text_transform'] = $settings->terms_text_transform;
				unset( $settings->terms_text_transform );
			}
			if ( isset( $settings->terms_text_letter_spacing ) ) {

				$settings->terms_font_typo['letter_spacing'] = array(
					'length' => $settings->terms_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->terms_text_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {
			// Handle color opacity.
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'background_color_opc', 'background_color' );
			$helper->handle_opacity_inputs( $settings, 'input_background_color_opc', 'input_background_color' );

			// Heading typography settings.
			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) && '' !== $settings->heading_font_family ) {

				if ( isset( $settings->heading_font_family['family'] ) ) {
					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];
					unset( $settings->heading_font_family['family'] );
				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
					unset( $settings->heading_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_typo['font_size'] ) ) {
				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_font_typo['line_height'] = array(
						'length' => round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Subheading typography settings.
			if ( ! isset( $settings->subheading_font_typo ) || ! is_array( $settings->subheading_font_typo ) ) {

				$settings->subheading_font_typo            = array();
				$settings->subheading_font_typo_medium     = array();
				$settings->subheading_font_typo_responsive = array();
			}
			if ( isset( $settings->subheading_font_family ) && '' !== $settings->subheading_font_family ) {

				if ( isset( $settings->subheading_font_family['family'] ) ) {
					$settings->subheading_font_typo['font_family'] = $settings->subheading_font_family['family'];
					unset( $settings->subheading_font_family['family'] );
				}
				if ( isset( $settings->subheading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->subheading_font_family['weight'] ) {
						$settings->subheading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->subheading_font_typo['font_weight'] = $settings->subheading_font_family['weight'];
					}
					unset( $settings->subheading_font_family['weight'] );
				}
			}
			if ( isset( $settings->subheading_font_size['desktop'] ) && ! isset( $settings->subheading_font_typo['font_size'] ) ) {
				$settings->subheading_font_typo['font_size'] = array(
					'length' => $settings->subheading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subheading_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->subheading_font_typo_medium['font_size'] = array(
					'length' => $settings->subheading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subheading_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->subheading_font_typo_responsive['font_size'] = array(
					'length' => $settings->subheading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->subheading_line_height['desktop'] ) && isset( $settings->subheading_font_size['desktop'] ) && 0 != $settings->subheading_font_size['desktop'] && ! isset( $settings->subheading_line_height_unit ) ) {
				if ( is_numeric( $settings->subheading_line_height['desktop'] ) && is_numeric( $settings->subheading_font_size['desktop'] ) ) {
					$settings->subheading_font_typo['line_height'] = array(
						'length' => round( $settings->subheading_line_height['desktop'] / $settings->subheading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subheading_line_height['medium'] ) && isset( $settings->subheading_font_size['medium'] ) && 0 != $settings->subheading_font_size['medium'] && ! isset( $settings->subheading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->subheading_line_height['medium'] ) && is_numeric( $settings->subheading_font_size['medium'] ) ) {
					$settings->subheading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->subheading_line_height['medium'] / $settings->subheading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->subheading_line_height['small'] ) && isset( $settings->subheading_font_size['small'] ) && 0 != $settings->subheading_font_size['small'] && ! isset( $settings->subheading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->subheading_line_height['small'] ) && is_numeric( $settings->subheading_font_size['small'] ) ) {
					$settings->subheading_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->subheading_line_height['small'] / $settings->subheading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Text typography settings.
			if ( ! isset( $settings->text_font_typo ) || ! is_array( $settings->text_font_typo ) ) {

				$settings->text_font_typo            = array();
				$settings->text_font_typo_medium     = array();
				$settings->text_font_typo_responsive = array();
			}
			if ( isset( $settings->text_font_family ) && '' !== $settings->text_font_family ) {

				if ( isset( $settings->text_font_family['family'] ) ) {
					$settings->text_font_typo['font_family'] = $settings->text_font_family['family'];
					unset( $settings->text_font_family['family'] );
				}
				if ( isset( $settings->text_font_family['weight'] ) ) {
					if ( 'regular' == $settings->text_font_family['weight'] ) {
						$settings->text_font_typo['font_weight'] = 'normal';
					} else {
						$settings->text_font_typo['font_weight'] = $settings->text_font_family['weight'];
					}
					unset( $settings->text_font_family['weight'] );
				}
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_typo['font_size'] ) ) {
				$settings->text_font_typo['font_size'] = array(
					'length' => $settings->text_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->text_font_typo_medium['font_size'] = array(
					'length' => $settings->text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->text_font_typo_responsive['font_size'] = array(
					'length' => $settings->text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_font_typo['line_height'] = array(
						'length' => round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_font_typo_medium['line_height'] = array(
						'length' => round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Inputs typography settings.
			if ( ! isset( $settings->input_font_typo ) || ! is_array( $settings->input_font_typo ) ) {

				$settings->input_font_typo            = array();
				$settings->input_font_typo_medium     = array();
				$settings->input_font_typo_responsive = array();
			}
			if ( isset( $settings->input_font_family ) && '' !== $settings->input_font_family ) {

				if ( isset( $settings->input_font_family['family'] ) ) {
					$settings->input_font_typo['font_family'] = $settings->input_font_family['family'];
					unset( $settings->input_font_family['family'] );
				}
				if ( isset( $settings->input_font_family['weight'] ) ) {
					if ( 'regular' == isset( $settings->input_font_family['weight'] ) ) {
						$settings->input_font_typo['font_weight'] = 'normal';
					} else {
						$settings->input_font_typo['font_weight'] = $settings->input_font_family['weight'];
					}
					unset( $settings->input_font_family['weight'] );
				}
			}
			if ( isset( $settings->input_font_size['desktop'] ) && ! isset( $settings->input_font_typo['font_size'] ) ) {
				$settings->input_font_typo['font_size'] = array(
					'length' => $settings->input_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->input_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->input_font_typo_medium['font_size'] = array(
					'length' => $settings->input_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->input_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->input_font_typo_responsive['font_size'] = array(
					'length' => $settings->input_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->input_line_height['desktop'] ) && isset( $settings->input_font_size['desktop'] ) && 0 != $settings->input_font_size['desktop'] && ! isset( $settings->input_line_height_unit ) ) {
				if ( is_numeric( $settings->input_line_height['desktop'] ) && is_numeric( $settings->input_font_size['desktop'] ) ) {
					$settings->input_font_typo['line_height'] = array(
						'length' => round( $settings->input_line_height['desktop'] / $settings->input_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->input_line_height['medium'] ) && isset( $settings->input_font_size['medium'] ) && 0 != $settings->input_font_size['medium'] && ! isset( $settings->input_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->input_line_height['medium'] ) && is_numeric( $settings->input_font_size['medium'] ) ) {
					$settings->input_font_typo_medium['line_height'] = array(
						'length' => round( $settings->input_line_height['medium'] / $settings->input_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->input_line_height['small'] ) && isset( $settings->input_font_size['small'] ) && 0 != $settings->input_font_size['small'] && ! isset( $settings->input_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->input_line_height['small'] ) && is_numeric( $settings->input_font_size['small'] ) ) {
					$settings->input_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->input_line_height['small'] / $settings->input_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Button typography settings.
			if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

				$settings->button_font_typo            = array();
				$settings->button_font_typo_medium     = array();
				$settings->button_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) && '' !== $settings->btn_font_family ) {

				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->button_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->button_font_typo['font_weight'] = 'normal';
					} else {
						$settings->button_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->button_font_typo['font_size'] ) ) {
				$settings->button_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {

				$settings->button_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->button_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->button_font_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->button_font_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->button_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->padding_dimension_top    = '';
				$settings->padding_dimension_bottom = '';
				$settings->padding_dimension_left   = '';
				$settings->padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->padding_dimension_top    = (int) $output[ $i ][1];
							$settings->padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->padding_dimension_left   = (int) $output[ $i ][1];
							$settings->padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->padding );
			}

			// Unset the old values.
			if ( isset( $settings->btn_font_size ) ) {
				unset( $settings->btn_font_size );
			}
			if ( isset( $settings->btn_line_height ) ) {
				unset( $settings->btn_line_height );
			}
			if ( isset( $settings->input_font_size['desktop'] ) ) {
				unset( $settings->input_font_size['desktop'] );
			}
			if ( isset( $settings->input_font_size['medium'] ) ) {
				unset( $settings->input_font_size['medium'] );
			}
			if ( isset( $settings->input_font_size['small'] ) ) {
				unset( $settings->input_font_size['small'] );
			}
			if ( isset( $settings->input_line_height['desktop'] ) ) {
				unset( $settings->input_line_height['desktop'] );
			}
			if ( isset( $settings->input_line_height['medium'] ) ) {
				unset( $settings->input_line_height['medium'] );
			}
			if ( isset( $settings->input_line_height['small'] ) ) {
				unset( $settings->input_line_height['small'] );
			}
			if ( isset( $settings->text_font_size['desktop'] ) ) {
				unset( $settings->text_font_size['desktop'] );
			}
			if ( isset( $settings->text_font_size['medium'] ) ) {
				unset( $settings->text_font_size['medium'] );
			}
			if ( isset( $settings->text_font_size['small'] ) ) {
				unset( $settings->text_font_size['small'] );
			}
			if ( isset( $settings->text_line_height['desktop'] ) ) {
				unset( $settings->text_line_height['desktop'] );
			}
			if ( isset( $settings->text_line_height['medium'] ) ) {
				unset( $settings->text_line_height['medium'] );
			}
			if ( isset( $settings->text_line_height['small'] ) ) {
				unset( $settings->text_line_height['small'] );
			}
			if ( isset( $settings->subheading_font_size['desktop'] ) ) {
				unset( $settings->subheading_font_size['desktop'] );
			}
			if ( isset( $settings->subheading_font_size['medium'] ) ) {
				unset( $settings->subheading_font_size['medium'] );
			}
			if ( isset( $settings->subheading_font_size['small'] ) ) {
				unset( $settings->subheading_font_size['small'] );
			}
			if ( isset( $settings->subheading_line_height['desktop'] ) ) {
				unset( $settings->subheading_line_height['desktop'] );
			}
			if ( isset( $settings->subheading_line_height['medium'] ) ) {
				unset( $settings->subheading_line_height['medium'] );
			}
			if ( isset( $settings->subheading_line_height['small'] ) ) {
				unset( $settings->subheading_line_height['small'] );
			}
			if ( isset( $settings->heading_font_size['desktop'] ) ) {
				unset( $settings->heading_font_size['desktop'] );
			}
			if ( isset( $settings->heading_font_size['medium'] ) ) {
				unset( $settings->heading_font_size['medium'] );
			}
			if ( isset( $settings->heading_font_size['small'] ) ) {
				unset( $settings->heading_font_size['small'] );
			}
			if ( isset( $settings->heading_line_height ['desktop'] ) ) {
				unset( $settings->heading_line_height ['desktop'] );
			}
			if ( isset( $settings->heading_line_height ['medium'] ) ) {
				unset( $settings->heading_line_height ['medium'] );
			}
			if ( isset( $settings->heading_line_height ['small'] ) ) {
				unset( $settings->heading_line_height ['small'] );
			}
		}

		return $settings;
	}
}

$notice = '';
$p      = '#(\.0+)+($|-)#';
$ver1   = preg_replace( $p, '', FL_BUILDER_VERSION );
$ver2   = preg_replace( $p, '', '1.8.4' );
if ( version_compare( $ver1, $ver2 ) < 0 ) {
	$notice = __( 'Subscription Form requires Beaver Builder versions above 1.8.4. Make sure you use latest Beaver Builder to view best results.', 'uabb' );
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/mailchimp-subscribe-form/mailchimp-subscribe-form-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/mailchimp-subscribe-form/mailchimp-subscribe-form-bb-less-than-2-2-compatibility.php';
}
