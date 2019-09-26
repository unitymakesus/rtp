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

	// Bail out, if Square is not connected using Connect API.
	if ( ! give_square_is_connected() ) {
		return false;
	}

	$site_url     = site_url();
	$access_token = Give_Square_Gateway::get_access_token();

	$response = wp_remote_retrieve_body(
		wp_safe_remote_get(
			esc_url_raw(
				sprintf(
					/* translators: 1. Site URL 2. Access Token */
					'https://connect.givewp.com/square/connect.php?action=renew&return_uri=%1$s&access_token=%2$s',
					$site_url,
					$access_token
				)
			)
		)
	);

	// Disconnect OAuth, if error renewing the access token,
	if ( 'error_renew_token_failed' === $response ) {
		Give()->logs->add(
			__( 'Square Error', 'give-square' ),
			__( 'Unable to renew the access token. Please reconnect with your Square account.', 'give-square' ),
			'',
			'api_request'
		);
		give_square_disconnect_oauth();
		return false;
	}

	// Match access token and update the expires_at date of access token.
	if ( is_array( $response ) && $response['access_token'] === $access_token ) {
		give_update_option( 'give_square_live_expires_at', $response['expires_at'] );
	}

	return true;

}

add_action( 'give_weekly_scheduled_events', 'give_square_renew_access_token' );
