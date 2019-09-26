<?php
/**
 * Give Square Gateway Filters
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
 * Register the payment gateway.
 *
 * @param array $gateways List of Payment Gateways.
 *
 * @since 1.0.0
 *
 * @return array
 */
function give_square_register_gateway( $gateways ) {

	$gateways['square'] = array(
		'admin_label'    => __( 'Square Gateway', 'give-square' ),
		'checkout_label' => __( 'Credit Card', 'give-square' ),
	);

	return $gateways;
}

add_filter( 'give_payment_gateways', 'give_square_register_gateway' );

/**
 * This function will remove ZIP as a required field on processing donation.
 *
 * @param array $required_fields List of required fields.
 *
 * @since 1.0.0
 *
 * @return mixed
 */
function give_square_remove_zip_required_fields( $required_fields ) {

	unset( $required_fields['card_zip'] );

	return $required_fields;

}

add_filter( 'give_donation_form_required_fields', 'give_square_remove_zip_required_fields' );
