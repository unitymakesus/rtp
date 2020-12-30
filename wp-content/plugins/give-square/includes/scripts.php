<?php
/**
 * Enqueue and Dequeue Scripts
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
 * Add Scripts to FrontEnd.
 *
 * @since 1.0.0
 */
function give_square_add_scripts() {

	// Bail out, if Square gateway is not active.
	if ( ! give_is_gateway_active( 'square' ) ) {
		return;
	}

	$host = give_square_get_host();

	wp_register_script( 'give-square-payment-form', "https://js.{$host}/v2/paymentform", array(), GIVE_SQUARE_VERSION );
	wp_enqueue_script( 'give-square-payment-form' );

	wp_register_script( 'give-square-frontend', GIVE_SQUARE_PLUGIN_URL . 'assets/dist/js/frontend.js', array( 'jquery', 'give-square-payment-form' ), GIVE_SQUARE_VERSION );
	wp_enqueue_script( 'give-square-frontend' );

	$localise_vars = apply_filters(
		'give_square_localise_vars',
		array(
			'applicationID'          => give_square_get_application_id(),
			'locationID'             => give_square_get_location_id(),
			'inputStyles'            => give_square_get_input_styles(),
			'cardNumberPlaceholder'  => __( 'Card Number', 'give-square' ),
			'cvcPlaceholder'         => __( 'Security Code', 'give-square' ),
			'cardExpiryPlaceholder'  => __( 'MM/YY', 'give-square' ),
			'postalCodePlaceholder'  => __( 'Postal Code', 'give-square' ),
			'unsupportedBrowserText' => __( 'The browser you are using is not supported. Please try another browser.', 'give-square' ),
		)
	);
	wp_localize_script( 'give-square-frontend', 'giveSquareLocaliseVars', $localise_vars );

}

add_action( 'wp_enqueue_scripts', 'give_square_add_scripts' );

/**
 * Add Stylesheets.
 *
 * @since 1.0.0
 */
function give_square_add_stylesheets() {

	// Bail out, if Square gateway is not active.
	if ( ! give_is_gateway_active( 'square' ) ) {
		return;
	}

	wp_register_style( 'give-square-frontend', GIVE_SQUARE_PLUGIN_URL . 'assets/dist/css/frontend.css', '', GIVE_SQUARE_VERSION );
	wp_enqueue_style( 'give-square-frontend' );
}

add_action( 'wp_enqueue_scripts', 'give_square_add_stylesheets' );

/**
 * Add Stylesheets to Admin.
 *
 * @since 1.0.0
 */
function give_square_add_admin_stylesheets() {

	wp_register_style( 'give-square-admin', GIVE_SQUARE_PLUGIN_URL . 'assets/dist/css/admin.css', '', GIVE_SQUARE_VERSION );
	wp_enqueue_style( 'give-square-admin' );


}

add_action( 'admin_enqueue_scripts', 'give_square_add_admin_stylesheets' );

/**
 * Add Scripts to Admin.
 *
 * @since 1.0.0
 */
function give_square_add_admin_scripts() {

	wp_register_script( 'give-square-admin', GIVE_SQUARE_PLUGIN_URL . 'assets/dist/js/admin.js', array( 'jquery' ), GIVE_SQUARE_VERSION );
	wp_enqueue_script( 'give-square-admin' );

	$localise_vars = array(
		'disconnect_square_title'   => __( 'Confirm Disconnect?', 'give-square' ),
		'ajaxNonce'                 => wp_create_nonce( 'give_square_ajax_nonce' ),
	);
	wp_localize_script( 'give-square-admin', 'giveSquareAdminLocaliseVars', $localise_vars );

}

add_action( 'admin_enqueue_scripts', 'give_square_add_admin_scripts' );
