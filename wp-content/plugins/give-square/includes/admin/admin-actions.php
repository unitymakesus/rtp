<?php
/**
 * List of Admin Action Hooks.
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
 * Register Admin Settings.
 *
 * @param array $settings List of admin settings.
 *
 * @return array
 * @since 1.0.0
 *
 */
function give_square_register_settings( $settings ) {

	switch ( give_get_current_setting_section() ) {

		case 'square-settings':
			$settings = array(
				array(
					'id'   => 'give_title_square',
					'type' => 'title',
					'desc' => '',
				),
			);

			if ( ! give_square_is_manual_api_keys_enabled() ) {

				$settings[] = array(
					'name'          => __( 'Square Connection', 'give-square' ),
					'desc'          => __( 'Connect with Square account to start receiving donations through card payments.', 'give-square' ),
					'wrapper_class' => 'give-square-connect-field',
					'id'            => 'square-connect-field',
					'type'          => 'square_connect',
					'mode'          => 'live',
				);

				// Provide a dynamic description for the Live "Location" description.

				if ( ! give_get_option( 'give_square_business_location' )) {
					$location_description = sprintf(
					/* translators: 1. Connect Bold Text */
						'<span class="dashicons dashicons-warning" style="color:orange;position:relative;top:1px;"></span> <strong>%1$s</strong><br> %2$s',
						esc_html__( 'No Location Set', 'give-square' ),
						__( 'Set a location above to start accepting donations. You must have <a href="https://squareup.com/dashboard/locations" target="_blank">locations</a> set in Square and approved to accept credit cards.', 'give-square' )
					);
				} else {
					$location_description = __( 'The Square location displayed above is set to accept donations through this website. To change the location select from the choices in the dropdown above.', 'give-square' );
				}

				$settings[] = array(
					'name'          => __( 'Location', 'give-square' ),
					'desc'          => $location_description,
					'id'            => 'give_square_business_location',
					'type'          => 'location_select',
					'wrapper_class' => give_square_is_connected() ? 'give-square-business-location-wrap' : 'give-square-business-location-wrap give-hidden',
					'options'       => give_square_get_business_locations(),
					'mode'          => 'live',
				);

				$settings[] = array(
					'name'          => __( 'Renew Token', 'give-square' ),
					'desc'          => __( 'Clicking the button will renew the Square token when the renew token cron is not working properly.', 'give-square' ),
					'id'            => 'square_renew_token',
					'type'          => 'square_renew_token',
					'mode'          => 'live',
					'wrapper_class' => give_square_is_connected() ? '' : 'give-hidden',
				);

				$settings[] = array(
					'name'          => __( 'Square Connection - Sandbox', 'give-square' ),
					'desc'          => __( 'Connect with Square Sandbox account to start receiving donations through card payments.', 'give-square' ),
					'wrapper_class' => 'give-square-connect-sandbox-field',
					'id'            => 'square-connect-field',
					'type'          => 'square_connect',
					'mode'          => 'test',
				);

				$settings[] = array(
					'name'          => __( 'Location - Sandbox', 'give-square' ),
					'desc'          => __( 'Select the location you wish to link to this site. You must have <a href="https://squareupsandbox.com/dashboard/locations" target="_blank">locations</a> set in Square Sandbox account.', 'give-square' ),
					'id'            => 'give_square_sandbox_business_location',
					'type'          => 'location_select',
					'wrapper_class' => give_square_sandbox_is_connected() ? 'give-square-business-location-wrap' : 'give-square-business-location-wrap give-hidden',
					'options'       => give_square_get_business_locations( 'test' ),
					'mode'          => 'test',
				);

				$settings[] = array(
					'name'          => __( 'Renew Token - Sandbox', 'give-square' ),
					'desc'          => __( 'Clicking the button will renew the Square token when the renew token cron is not working properly.', 'give-square' ),
					'id'            => 'square_renew_token',
					'type'          => 'square_renew_token',
					'mode'          => 'test',
					'wrapper_class' => give_square_sandbox_is_connected() ? '' : 'give-hidden',
				);

			} else {

				$settings[] = array(
					'name'          => __( 'Live Application ID', 'give-square' ),
					'desc'          => __( 'Enter your live application id, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_live_application_id',
					'type'          => 'text',
					'wrapper_class' => 'give-square-live-application-id',
				);

				$settings[] = array(
					'name'          => __( 'Live Access Token', 'give-square' ),
					'desc'          => __( 'Enter your live access token, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_live_access_token',
					'type'          => 'api_key',
					'wrapper_class' => 'give-square-live-access-token',
				);

				$settings[] = array(
					'name'          => __( 'Live Location ID', 'give-square' ),
					'desc'          => __( 'Enter your live location id, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_live_location_id',
					'type'          => 'text',
					'wrapper_class' => 'give-square-live-location-id',
				);

				$settings[] = array(
					'name'          => __( 'SandBox Application ID', 'give-square' ),
					'desc'          => __( 'Enter your sandbox application id, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_sandbox_application_id',
					'type'          => 'text',
					'wrapper_class' => 'give-square-sandbox-application-id',
				);

				$settings[] = array(
					'name'          => __( 'SandBox Access Token', 'give-square' ),
					'desc'          => __( 'Enter your sandbox access token, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_sandbox_access_token',
					'type'          => 'api_key',
					'wrapper_class' => 'give-square-sandbox-access-token',
				);

				$settings[] = array(
					'name'          => __( 'SandBox Location ID', 'give-square' ),
					'desc'          => __( 'Enter your sandbox access token, found in your Square Account Settings.', 'give-square' ),
					'id'            => 'give_square_sandbox_location_id',
					'type'          => 'text',
					'wrapper_class' => 'give-square-sandbox-location-id',
				);

			} // End if().

			$settings[] = array(
				'name' => __( 'Collect Billing Details', 'give-square' ),
				'desc' => __( 'This option will enable the billing details section for Square which requires the donor\'s address to complete the donation. These fields are not required by Square to process the transaction, but you may have the need to collect the data.', 'give-square' ),
				'id'   => 'give_square_collect_billing_details',
				'type' => 'checkbox',
			);
			$settings[] = array(
				'name'  => __( 'Give Square Settings Docs Link', 'give-square' ),
				'id'    => 'give_square_settings_docs_link',
				'url'   => esc_url( 'http://docs.givewp.com/addon-square' ),
				'title' => __( 'Square Payment Gateway', 'give-square' ),
				'type'  => 'give_docs_link',
			);
			$settings[] = array(
				'id'   => 'give_title_square',
				'type' => 'sectionend',
			);

			break;

	} // End switch().

	return $settings;
}

add_filter( 'give_get_settings_gateways', 'give_square_register_settings' );

/**
 * Square Connect Field.
 *
 * @param array $attr Field Attributes.
 *
 * @since 1.0.0
 */
function give_square_connect_field( $attr ) {

	$mode                  = esc_attr( $attr['mode'] );
	$connect_id            = ( 'live' === $mode ) ?
		give_get_option( 'give_square_live_connect_id' ) :
		give_get_option( 'give_square_sandbox_connect_id' );
	$connection_status_css = (
		( 'live' === $mode && ! give_square_is_connected() ) ||
		( 'test' === $mode && ! give_square_sandbox_is_connected() )
	) ? 'give-square-not-connected' : 'give-square-connected';
	$disconnect_text       = ( 'live' === $mode ) ?
		__( 'Disconnect from Square', 'give-square' ) :
		__( 'Disconnect from Square Sandbox', 'give-square' );
	$disconnect_url        = sprintf(
		'https://connect.givewp.com/square/connect_%3$s.php?action=disconnect&return_uri=%1$s&merchant_id=%2$s&connect_id=%4$s',
		site_url(),
		give_square_get_merchant_id( $mode ),
		$mode,
		$connect_id
	);
	$disconnect_popup_text = sprintf(
	/* translators: %s Square Merchant ID */
		__( 'Are you sure you want to disconnect GiveWP from Square? If disconnected, this website and any others sharing the same Square account (%1$s) that are connected to the Square GiveWP App will need to reconnect in order to process donation payments.', 'give-square' ),
		give_square_get_merchant_id( $mode )
	);
	?>
	<tr valign="top" <?php echo ! empty( $attr['wrapper_class'] ) ? 'class="' . esc_attr( $attr['wrapper_class'] ) . '"' : ''; ?>>

		<th scope="row" class="titledesc">
			<label for="<?php echo esc_attr( $attr['id'] ); ?>">
				<?php echo esc_attr( $attr['name'] ); ?>
			</label>
		</th>

		<td class="give-forminp give-forminp-api_key <?php echo $connection_status_css; ?> ">
			<?php
			if (
				( 'live' === $mode && ! give_square_is_connected() ) ||
				( 'test' === $mode && ! give_square_sandbox_is_connected() )
			) {
				echo give_square_connect_button( $mode );
				?>
				<p class="give-field-description">
					<?php echo esc_html( $attr['desc'] ); ?>
				</p>
				<?php
			} else {
				?>
				<a
					href="<?php echo esc_url( $disconnect_url ); ?>"
					id="give-square-disconnect"
					class="button-primary"
					data-disconnect-popup-text="<?php echo $disconnect_popup_text; ?>"
				>
					<?php echo $disconnect_text; ?>
				</a>
				<?php
			}
			?>
		</td>

	</tr>
	<?php
}

add_action( 'give_admin_field_square_connect', 'give_square_connect_field' );

/**
 * Square Location Select Field.
 *
 * @param array $attr Field Attributes.
 *
 * @since 1.0.0
 */
function give_square_location_select_field( $attr ) {

	$option_value = give_get_option( $attr['id'], $attr['default'] );
	$refresh_url  = admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&give_action=square_refresh_locations&mode=' . $attr['mode'];
	?>
	<tr valign="top" class="<?php echo esc_html( $attr['wrapper_class'] ); ?>">
		<th scope="row" class="titledesc">
			<label for="<?php echo esc_attr( $attr['id'] ); ?>"><?php echo esc_attr( $attr['title'] ); ?></label>
		</th>
		<td class="give-forminp give-forminp-<?php echo esc_html( $attr['type'] ); ?>">
			<select
				name="<?php echo esc_attr( $attr['id'] ); ?>"
				id="<?php echo esc_attr( $attr['id'] ); ?>"
				style="<?php echo esc_attr( $attr['css'] ); ?>"
				class="<?php echo esc_attr( $attr['class'] ); ?>"
			>
				<?php
				if ( ! empty( $attr['options'] ) ) {
					foreach ( $attr['options'] as $key => $value ) {
						?>
						<option value="<?php echo esc_attr( $key ); ?>"
							<?php
							if ( is_array( $option_value ) ) {
								selected( in_array( $key, $option_value, true ), true );
							} else {
								selected( $option_value, $key );
							}
							?>
						>
							<?php echo esc_html( $value ); ?>
						</option>
						<?php
					}
				}
				?>
			</select>
			<a href="<?php echo esc_url_raw( $refresh_url ); ?>" class="button">
				<?php esc_html_e( 'Refresh', 'give-square' ); ?>
			</a>
			<div class="give-field-description">
				<?php echo wp_kses_post( $attr['desc'] ); ?>
			</div>
		</td>
	</tr>
	<?php
}

add_action( 'give_admin_field_location_select', 'give_square_location_select_field' );

/**
 * Store oAuth credentials.
 *
 * @param array $args List of arguments.
 *
 * @since 1.0.0
 *
 */
function give_square_store_oauth_credentials( $args ) {

	$mode = ! empty( $args['mode'] ) ? give_clean( $args['mode'] ) : false;

	if ( 'test' === $mode && ! give_square_sandbox_is_connected() ) {
		// Store for Sandbox purposes.
		give_update_option( 'give_square_sandbox_access_token', give_square_encrypt_string( $args['access_token'] ) );
		give_update_option( 'give_square_sandbox_application_id', $args['application_id'] );
		give_update_option( 'give_square_sandbox_expires_at', $args['expires_at'] );
		give_update_option( 'give_square_sandbox_merchant_id', $args['merchant_id'] );
		give_update_option( 'give_square_sandbox_token_type', $args['token_type'] );
		give_update_option( 'give_square_sandbox_refresh_token', $args['refresh_token'] );
		give_update_option( 'give_square_sandbox_connect_id', $args['connect_id'] );
		give_update_option( 'give_square_sandbox_is_connected', true );

		// Update Locations.
		give_square_get_business_locations( 'test' );

	} elseif ( 'live' === $mode && ! give_square_is_connected() ) {
		// Store for LIVE purposes.
		give_update_option( 'give_square_live_access_token', give_square_encrypt_string( $args['access_token'] ) );
		give_update_option( 'give_square_live_application_id', $args['application_id'] );
		give_update_option( 'give_square_live_expires_at', $args['expires_at'] );
		give_update_option( 'give_square_live_merchant_id', $args['merchant_id'] );
		give_update_option( 'give_square_live_token_type', $args['token_type'] );
		give_update_option( 'give_square_live_refresh_token', $args['refresh_token'] );
		give_update_option( 'give_square_live_connect_id', $args['connect_id'] );
		give_update_option( 'give_square_is_connected', true );

		// Update Locations.
		give_square_get_business_locations( 'live' );
	}
}

add_action( 'give_square_is_connected', 'give_square_store_oauth_credentials' );
// This action will be fire from gateway oauth. Check https://github.com/impress-org/gateway-oauth > square > connect.php for more information.

/**
 * Disconnect Square oAuth.
 *
 * @param array $args List of arguments.
 *
 * @since 1.0.0
 *
 */
function give_square_disconnect_oauth( $args = array() ) {

	$mode = ! empty( $args['mode'] ) ? give_clean( $args['mode'] ) : false;

	// If Square is not connected via oAuth then store the details fetched.
	if ( give_square_is_connected() && 'live' === $mode ) {
		// Delete LIVE details.
		give_delete_option( 'give_square_live_access_token' );
		give_delete_option( 'give_square_live_application_id' );
		give_delete_option( 'give_square_business_location' );
		give_delete_option( 'give_square_live_expires_at' );
		give_delete_option( 'give_square_live_merchant_id' );
		give_delete_option( 'give_square_live_token_type' );
		give_delete_option( 'give_square_live_refresh_token' );
		give_delete_option( 'give_square_live_connect_id' );
		give_delete_option( 'give_square_is_connected' );

		// Delete Locations List Cache when Square is disconnected.
		Give_Cache::delete( 'give_cache_square_locations_list' );
	}

	// If Square Sandbox is not connected via oAuth then store the details fetched.
	if ( give_square_sandbox_is_connected() && 'test' === $mode ) {
		// Delete Sandbox details.
		give_delete_option( 'give_square_sandbox_access_token' );
		give_delete_option( 'give_square_sandbox_application_id' );
		give_delete_option( 'give_square_sandbox_business_location' );
		give_delete_option( 'give_square_sandbox_expires_at' );
		give_delete_option( 'give_square_sandbox_merchant_id' );
		give_delete_option( 'give_square_sandbox_token_type' );
		give_delete_option( 'give_square_sandbox_refresh_token' );
		give_delete_option( 'give_square_sandbox_connect_id' );
		give_delete_option( 'give_square_sandbox_is_connected' );

		// Delete Locations List Cache when Square is disconnected.
		Give_Cache::delete( 'give_cache_square_sandbox_locations_list' );
	}

}

add_action( 'give_square_disconnect_oauth', 'give_square_disconnect_oauth' );
// This action will be fire from gateway oauth. Check https://github.com/impress-org/gateway-oauth > square > connect.php for more information.


/**
 * Register admin notices.
 *
 * @since 1.0.0
 */
function give_square_register_admin_notices() {

	// Bailout.
	if ( ! is_admin() ) {
		return;
	}

	// Add give message notices.
	$message_notices = give_get_admin_messages_key();
	if ( ! empty( $message_notices ) ) {
		foreach ( $message_notices as $message_notice ) {

			// Give settings notices and errors.
			if ( current_user_can( 'manage_give_settings' ) ) {
				switch ( $message_notice ) {
					case 'square-obtain-token-error':
						Give()->notices->register_notice(
							array(
								'id'          => 'give-square-obtain-token-error',
								'type'        => 'error',
								'description' => __( 'Unable to obtain token from Square to connect using oAuth API.', 'give-square' ),
								'show'        => true,
							)
						);
						break;

					case 'square-revoke-token-error':
						Give()->notices->register_notice(
							array(
								'id'          => 'give-square-revoke-token-error',
								'type'        => 'error',
								'description' => __( 'Unable to revoke token of a merchant from Square to disconnect using oAuth API.', 'give-square' ),
								'show'        => true,
							)
						);
						break;

					case 'square-renew-success':
						Give()->notices->register_notice(
							array(
								'id'          => 'give-square-renew-success',
								'type'        => 'success',
								'description' => __( '<strong>Token Renewed Successfully:</strong> The Square access token has been successfully refreshed.', 'give-square' ),
								'show'        => true,
							)
						);
						break;

					case 'square-renew-failure':
						Give()->notices->register_notice(
							array(
								'id'          => 'give-square-renew-failure',
								'type'        => 'error',
								'description' => __( 'Unable to renew token of a merchant from Square using oAuth API.', 'give-square' ),
								'show'        => true,
							)
						);
						break;

				}// End switch().
			}// End if().
		} // End foreach().
	} // End if().

}

add_action( 'admin_notices', 'give_square_register_admin_notices', - 1 );

/**
 * Refresh business locations list by deleting cache.
 *
 * @param array $args List of arguments.
 *
 * @return void
 * @since 1.0.0
 *
 */
function give_square_refresh_locations( $args ) {
	$mode = ! empty( $args['mode'] ) ? give_clean( $args['mode'] ) : 'live';

	if ( 'live' === $mode ) {
		Give_Cache::delete( 'give_cache_square_locations_list' );
	} elseif ( 'test' === $mode ) {
		Give_Cache::delete( 'give_cache_square_sandbox_locations_list' );
	}

	wp_safe_redirect( esc_url_raw( admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings' ) );
}

add_action( 'give_square_refresh_locations', 'give_square_refresh_locations' );

/**
 * Process refund in Square.
 *
 * @access public
 *
 * @param string $donation_id Payment ID.
 * @param string $new_status  New Donation Status.
 * @param string $old_status  Old Donation Status.
 *
 * @return      void
 * @since  1.0.0
 *
 */
function give_square_process_refund( $donation_id, $new_status, $old_status ) {

	// Only move forward if refund requested.
	$can_refund_in_square = ! empty( $_POST['give_square_opt_refund'] ) ? give_clean( $_POST['give_square_opt_refund'] ) : false; // WPCS: input var ok, sanitization ok, CSRF ok.
	if ( ! $can_refund_in_square ) {
		return;
	}

	// Verify statuses.
	$can_process_refund = 'publish' !== $old_status ? false : true;
	$can_process_refund = apply_filters( 'give_square_can_process_refund', $can_process_refund, $donation_id, $new_status, $old_status );

	// Bail out, if processing refund is not allowed.
	if ( false === $can_process_refund ) {
		return;
	}

	// Bail out, if already refunded.
	if ( 'refunded' !== $new_status ) {
		return;
	}

	$transaction_id = give_get_payment_transaction_id( $donation_id );

	// Bail out, if no transaction ID was found.
	if ( empty( $transaction_id ) ) {
		return;
	}

	// Set the Access Token prior to any API calls.
	$api_client = give_square_setup_api_config();

	$idempotency_key = give_get_meta( $donation_id, '_give_square_donation_idempotency_key', true );
	$amount_money    = give_square_prepare_donation_amount( give_format_amount( give_donation_amount( $donation_id ) ) );
	$refund_reason   = sprintf( __( 'Refund from GiveWP Admin on %s', 'give-square' ), get_bloginfo( 'url' ) );

	$refund_api             = new SquareConnect\Api\RefundsApi( $api_client );
	$refund_payment_request = new \SquareConnect\Model\RefundPaymentRequest();
	$refund_payment_request->setIdempotencyKey( $idempotency_key );
	$refund_payment_request->setPaymentId( $transaction_id );
	$refund_payment_request->setAmountMoney( $amount_money );
	$refund_payment_request->setReason( $refund_reason );

	try {
		$result    = $refund_api->refundPayment( $refund_payment_request );
		$refund_id = $result->getRefund()->getId();

		if ( $refund_id ) {
			give_insert_payment_note(
				$donation_id,
				sprintf(
				/* translators: 1. Refund ID */
					esc_html__( 'Payment refunded in Square: %s', 'give-square' ),
					$refund_id
				)
			);
		}
	} catch ( Exception $e ) {

		// Log it with DB.
		give_record_gateway_error(
			__( 'Square Error', 'give-square' ),
			sprintf(
			/* translators: 1. Error Message, 2. Exception Message, 3. Code Text, 4. Code Message. */
				'%1$s %2$s %3$s %4$s',
				__( 'The Square payment gateway returned an error while refunding a donation. Message:', 'give-square' ),
				$e->getMessage(),
				__( 'Code:', 'give-square' ),
				$e->getCode()
			)
		);

	}
}

add_action( 'give_update_payment_status', 'give_square_process_refund', 200, 3 );

/**
 * This function will display field to opt for refund in Square.
 *
 * @param int $donation_id Donation ID.
 *
 * @return void
 * @since 1.0.0
 *
 */
function give_square_opt_square_refund( $donation_id ) {

	$processed_gateway = Give()->payment_meta->get_meta( $donation_id, '_give_payment_gateway', true );

	// Bail out, if the donation is not processed with Square payment gateway.
	if ( 'square' !== $processed_gateway ) {
		return;
	}
	?>
	<div id="give-square-opt-refund-wrap" class="give-square-opt-refund give-admin-box-inside give-hidden">
		<p>
			<input type="checkbox" id="give-square-opt-refund" name="give_square_opt_refund" value="1"/>
			<label for="give-square-opt-refund">
				<?php esc_html_e( 'Refund Charge in Square?', 'give-square' ); ?>
			</label>
		</p>
	</div>

	<?php
}

add_action( 'give_view_donation_details_totals_after', 'give_square_opt_square_refund', 10, 1 );

/**
 * Given a transaction ID, generate a link to the Square transaction ID details
 *
 * @param string $transaction_id The Transaction ID.
 * @param int    $payment_id     The payment ID for this transaction.
 *
 * @return string                 A link to the Transaction details
 * @since  1.0.0
 *
 */
function give_square_link_transaction_id( $transaction_id, $payment_id ) {

	if ( $transaction_id == $payment_id ) {
		return $transaction_id;
	}

	$mode = give_get_meta( $payment_id, '_give_payment_mode', true );

	if ( 'test' === $mode ) {
		return $transaction_id;
	}

	// If empty transaction id then get transaction id from donation id.
	if ( empty( $transaction_id ) ) {
		$transaction_id = give_get_payment_transaction_id( $payment_id );
	}

	$transaction_link = sprintf(
		'<a href="%1$s" target="_blank">%2$s</a>',
		"https://squareup.com/dashboard/sales/transactions/{$transaction_id}/",
		$transaction_id
	);

	return apply_filters( 'give_square_link_donation_details_transaction_id', $transaction_link );

}

add_filter( 'give_payment_details_transaction_id-square', 'give_square_link_transaction_id', 10, 2 );

/**
 * Display notices for Square when necessary.
 *
 * @since 1.0.3
 */
function give_square_admin_notices() {

	$business_locations = give_square_get_business_locations();

	// Show error notice if business locations doesn't exists.
	if (
		is_array( $business_locations ) &&
		count( $business_locations ) <= 1 &&
		! give_square_is_manual_api_keys_enabled() && give_square_is_connected()
	) {
		Give()->notices->register_notice(
			array(
				'id'          => 'give-square-credit-card-processing-not-enabled-error',
				'description' => sprintf( __( '<strong>No Eligible Square Locations Found:</strong> The connected Square account does not contain any locations that have credit card processing enabled. Please configure a location that has credit card processing enabled and set it within the <a href="%1$s">gateway\'s settings screen</a>.', 'give-square' ),
					esc_url_raw( admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings' ) ),

				'type'        => 'error',
				'dismissible' => false,
			)
		);
	}
}

add_action( 'admin_notices', 'give_square_admin_notices' );


/**
 * Validate & Sanitize settings
 *
 * @sicne 1.0.3
 *
 * @param $value
 * @param $option
 *
 * @return mixed
 */
function give_square_admin_sanitize_settings( $value, $option ) {
	if ( ! $value || ! Give_Admin_Settings::is_setting_page( 'gateways', 'square-settings' ) ) {
		return $value;
	}

	if (
		in_array( $option['id'], array( 'give_square_live_access_token', 'give_square_sandbox_access_token' ) )
		&& $value !== give_get_option( $option['id'], '' )
	) {
		$value = give_square_encrypt_string( $value );
	}

	return $value;
}

add_action( 'give_admin_settings_sanitize_option', 'give_square_admin_sanitize_settings', 10, 2 );

/**
 * This AJAX function ensure that the Square account is disconnected properly.
 *
 * @return void
 * @since 1.0.4
 *
 */
function give_square_disconnect_connection() {

	// Bailout, if user can't manage Give settings.
	if ( ! current_user_can( 'manage_give_settings' ) ) {
		wp_send_json_error();
	}

	// Add security barrier.
	check_admin_referer( 'give_square_ajax_nonce', 'security' );

	// Delete Square Connection meta.
	give_delete_option( 'give_square_is_connected' );

	wp_send_json_success();
}

add_action( 'wp_ajax_square_disconnect_connection', 'give_square_disconnect_connection' );

/**
 * This function adds renew token notification under System Info.
 *
 * @param array $settings List of Give settings.
 *
 * @return void
 * @since 1.0.5
 *
 */
function give_square_add_renew_token_notification( $settings ) {
	$label = __( 'Square Token Renewal Date', 'give-square' );
	?>
	<tr>
		<td data-export-label="<?php echo $label; ?>">
			<?php echo $label; ?>:
		</td>
		<td class="help">
			<?php echo Give()->tooltips->render_help( __( 'Displays when the last Square refresh token renewal was triggered.', 'give-square' ) ); ?>
		</td>
		<td>
			<?php
			echo ! empty( $settings['give_square_renew_token_live_trigger_date'] ) ?
				$settings['give_square_renew_token_live_trigger_date'] :
				'N/A'
			?>
		</td>
	</tr>
	<?php
}

add_action( 'give_add_system_info_configuration', 'give_square_add_renew_token_notification' );

/**
 * This function will be used to display renew token field under advanced tab.
 *
 * @param array $attr List of attributes.
 *
 * @return void
 * @since 1.0.5
 *
 */
function give_square_renew_token_field( $attr ) {
	$renew_url = admin_url() . "edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings&give_action=square_renew_token&mode={$attr['mode']}";
	?>
	<tr valign="top" class="<?php echo esc_html( $attr['wrapper_class'] ); ?>">
		<th scope="row" class="titledesc">
			<label for="<?php echo esc_attr( $attr['id'] ); ?>"><?php echo esc_attr( $attr['title'] ); ?></label>
		</th>
		<td class="give-forminp give-forminp-<?php echo esc_html( $attr['type'] ); ?>">
			<a href="<?php echo esc_url_raw( $renew_url ); ?>" class="button">
				<?php echo esc_attr( $attr['name'] ); ?>
			</a>
			<p>
				<?php
				$live_refresh_date = give_get_option( 'give_square_renew_token_live_trigger_date' );
				$test_refresh_date = give_get_option( 'give_square_renew_token_sandbox_trigger_date' );

				echo sprintf(
					__( 'Renew Token Refresh Date: %1$s', 'give-square' ),
					'live' === $attr['mode'] ?
						( ! empty( $live_refresh_date ) ? $live_refresh_date : 'N/A' ) :
						( ! empty( $test_refresh_date ) ? $test_refresh_date : 'N/A' )
				);
				?>
			</p>
			<div class="give-field-description">
				<?php echo wp_kses_post( $attr['desc'] ); ?>
			</div>
		</td>
	</tr>
	<?php
}

add_action( 'give_admin_field_square_renew_token', 'give_square_renew_token_field' );

/**
 * This function is used to change the connection status when manual API settings changed.
 *
 * @param array  $update_options List of update options.
 * @param string $option_name    Option Name.
 * @param array  $old_options    List of old options.
 *
 * @return void
 * @since 1.1.0
 *
 */
function give_square_change_connection_status( $update_options, $option_name, $old_options ) {

	if (
		give_is_setting_enabled( $update_options['square_api_keys'] ) &&
		! give_is_setting_enabled( $old_options['square_api_keys'] ) &&
		( give_square_is_connected() || give_square_sandbox_is_connected() )
	) {
		// Flush out live mode oAuth settings.
		give_delete_option( 'give_square_is_connected' );
		give_delete_option( 'give_square_live_access_token' );
		give_delete_option( 'give_square_live_application_id' );
		give_delete_option( 'give_square_live_expires_at' );
		give_delete_option( 'give_square_live_merchant_id' );
		give_delete_option( 'give_square_live_token_type' );
		give_delete_option( 'give_square_live_refresh_token' );

		// Flush out sandbox mode oAuth settings.
		give_delete_option( 'give_square_sandbox_is_connected' );
		give_delete_option( 'give_square_sandbox_access_token' );
		give_delete_option( 'give_square_sandbox_application_id' );
		give_delete_option( 'give_square_sandbox_expires_at' );
		give_delete_option( 'give_square_sandbox_merchant_id' );
		give_delete_option( 'give_square_sandbox_token_type' );
		give_delete_option( 'give_square_sandbox_refresh_token' );
	}
}

add_action( 'give_save_settings_give_settings', 'give_square_change_connection_status', 10, 3 );



