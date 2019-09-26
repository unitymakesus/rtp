<?php
/**
 * Upgrade Functions
 *
 * @package    Give-Square
 * @subpackage Admin/Upgrades
 * @copyright  Copyright (c) 2019, GiveWP
 * @license    https://opensource.org/licenses/gpl-license GNU Public License
 * @since      1.0.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Perform automatic database upgrades when necessary.
 *
 * @since  1.0.2
 * @return void
 */
function give_square_do_automatic_upgrades() {
	
	$did_upgrade  = false;
	$version      = preg_replace( '/[^0-9.].*/', '', get_option( 'give_square_version' ) );
	
	if ( ! $version ) {
		// 1.0 is the first version to use this option so we must add it.
		$version = '1.0.0';
	}
	
	switch ( true ) {
		
		case version_compare( $version, '1.0.2', '<' ):
			give_v102_auto_upgrades();
			$did_upgrade = true;
			break;
			
	}
	
	if ( $did_upgrade || version_compare( $version, GIVE_SQUARE_VERSION, '<' ) ) {
		update_option( 'give_square_version', preg_replace( '/[^0-9.].*/', '', GIVE_SQUARE_VERSION ), false );
	}
}

add_action( 'init', 'give_square_do_automatic_upgrades', 0 );

/**
 * This function is an automatic upgrade routine to AES encrypt the test and live access tokens.
 *
 * @since 1.0.2
 */
function give_v102_auto_upgrades() {
	
	$test_access_token = give_get_option( 'give_square_sandbox_access_token' );
	$live_access_token = give_get_option( 'give_square_live_access_token' );
	
	// Update both test and live access token and store it after encrypting.
	give_update_option( 'give_square_sandbox_access_token', give_square_encrypt_string( $test_access_token ) );
	give_update_option( 'give_square_live_access_token', give_square_encrypt_string( $live_access_token ) );
	
}