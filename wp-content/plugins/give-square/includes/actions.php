<?php
/**
 * Frontend Actions for Give Square Gateway
 *
 * @package   Give-Square
 * @copyright Copyright (c) 2018, GiveWP
 * @license   https://opensource.org/licenses/gpl-license GNU Public License
 * @since     1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Card Nonce Field to Card Form.
 *
 * @param int   $form_id Donation Form ID.
 * @param array $args    List of additional arguments.
 *
 * @since 1.0.0
 */
function give_square_add_card_nonce_field( $form_id, $args ) {

	$id_prefix = ! empty( $args['id_prefix'] ) ? $args['id_prefix'] : '';

	echo sprintf(
		'<input type="hidden" id="card-nonce-%1$s" name="card_nonce" value="%2$s"/>',
		esc_html( $id_prefix ),
		give_square_generate_card_nonce()
	);
}

add_action( 'give_square_after_cc_fields', 'give_square_add_card_nonce_field', 10, 2 );

/**
 * Add an errors div per form.
 *
 * @param int   $form_id Donation Form ID.
 * @param array $args    List of Donation Arguments.
 *
 * @access public
 * @since  1.0.0
 *
 * @return void
 */
function give_square_add_errors( $form_id, $args ) {
	echo '<div id="give-square-payment-errors-' . esc_html( $args['id_prefix'] ) . '"></div>';
}

add_action( 'give_donation_form_after_cc_form', 'give_square_add_errors', 8899, 2 );

/**
 * This function will be used to renew access token.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function give_square_renew_access_token() {

	$get_data = give_clean( $_GET );
	$mode = $get_data['mode'];

	if ( empty( $mode ) ) {
		$mode = give_square_get_test_mode_text();
	}

	// Bail out, if Square is not connected using Connect API.
	if (
		( 'test' === $mode && ! give_square_sandbox_is_connected() ) ||
		( 'live' === $mode && ! give_square_is_connected() )
	) {
		return false;
	}

	// Add renewal trigger date to show status.
	$current_datetime = date_i18n( 'Y-m-d H:i:s', current_time( 'timestamp' ) );

	$site_url      = site_url();
	$refresh_token = give_get_option( 'give_square_live_refresh_token', false );
	$connect_id    = give_get_option( 'give_square_live_connect_id', false );

	if ( 'test' === $mode ) {
		$refresh_token = give_get_option( 'give_square_sandbox_refresh_token', false );
		$connect_id    = give_get_option( 'give_square_sandbox_connect_id', false );

		give_update_option( 'give_square_renew_token_sandbox_trigger_date', $current_datetime );
	} else {
		give_update_option( 'give_square_renew_token_live_trigger_date', $current_datetime );
	}

	$response = wp_remote_retrieve_body(
		wp_safe_remote_get(
			esc_url_raw(
				sprintf(
					/* translators: 1. Site URL 2. Access Token 3. Connect ID 4. Mode */
					'https://connect.givewp.com/square/connect_%4$s.php?action=renew&return_uri=%1$s&refresh_token=%2$s&connect_id=%3$s',
					$site_url,
					$refresh_token,
					$connect_id,
					$mode
				)
			)
		)
	);

	$return_url = esc_url_raw( admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings&give-messages[]=square-renew-success' );
	$decoded_response = json_decode( $response );

	// Disconnect OAuth, if error renewing the access token,
	if ( 'error_renew_token_failed' === $decoded_response ) {
		Give()->logs->add(
			__( 'Square Error', 'give-square' ),
			__( 'Unable to renew the access token. Please reconnect with your Square account.', 'give-square' ),
			'',
			'api_request'
		);
		give_square_disconnect_oauth();
		$return_url = esc_url_raw( admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings&give-messages[]=square-renew-failure' );
	}

	// Match access token and update the expires_at date of access token.
	if ( is_object( $decoded_response ) ) {
		if ( 'live' === $mode ) {
			give_update_option( 'give_square_live_access_token', $decoded_response->access_token );
			give_update_option( 'give_square_live_expires_at', $decoded_response->expires_at );
		} else {
			give_update_option( 'give_square_sandbox_access_token', $decoded_response->access_token );
			give_update_option( 'give_square_sandbox_expires_at', $decoded_response->expires_at );
		}
	}

	wp_redirect( $return_url );
	return true;
}

add_action( 'give_weekly_scheduled_events', 'give_square_renew_access_token' );
add_action( 'give_square_renew_token', 'give_square_renew_access_token' );
