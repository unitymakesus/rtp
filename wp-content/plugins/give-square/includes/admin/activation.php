<?php
/**
 * Give Square Gateway Activation
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
 * Plugins row action links
 *
 * @param array $actions An array of plugin action links.
 *
 * @since 1.0.0
 *
 * @return array An array of updated action links.
 */
function give_square_plugin_action_links( $actions ) {

	$new_actions = array(
		'settings' => sprintf(
			'<a href="%1$s">%2$s</a>',
			admin_url( 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings' ),
			__( 'Settings', 'give-square' )
		),
	);

	return array_merge( $new_actions, $actions );
}

add_filter( 'plugin_action_links_' . GIVE_SQUARE_BASENAME, 'give_square_plugin_action_links' );


/**
 * Plugin row meta links
 *
 * @param array $plugin_meta An array of the plugin's metadata.
 * @param string $plugin_file Path to the plugin file, relative to the plugins directory.
 *
 * @since 1.0.0
 *
 * @return array
 */
function give_square_plugin_row_meta( $plugin_meta, $plugin_file ) {

	if ( $plugin_file !== GIVE_SQUARE_BASENAME ) {
		return $plugin_meta;
	}

	$new_meta_links = array(
		sprintf(
			'<a href="%1$s" target="_blank">%2$s</a>',
			esc_url( add_query_arg( array(
					'utm_source'   => 'plugins-page',
					'utm_medium'   => 'plugin-row',
					'utm_campaign' => 'admin',
				), 'http://docs.givewp.com/addon-square' )
			),
			__( 'Documentation', 'give-square' )
		),
		sprintf(
			'<a href="%1$s" target="_blank">%2$s</a>',
			esc_url( add_query_arg( array(
					'utm_source'   => 'plugins-page',
					'utm_medium'   => 'plugin-row',
					'utm_campaign' => 'admin',
				), 'https://givewp.com/addons/' )
			),
			__( 'Add-ons', 'give-square' )
		),
	);

	return array_merge( $plugin_meta, $new_meta_links );
}

add_filter( 'plugin_row_meta', 'give_square_plugin_row_meta', 10, 2 );

/**
 * Displays the "Give Square Connect" banner.
 *
 * @since 1.0.0
 *
 * @return bool
 */
function give_square_connect_maybe_show_banner() {

	// Don't show if already connected.
	if ( give_square_is_connected() ) {
		return false;
	}

	// Don't show if user wants to use their own API key.
	if ( give_square_is_manual_api_keys_enabled() ) {
		return false;
	}

	// Don't show if on the payment settings section.
	if ( 'square-settings' === give_get_current_setting_section() ) {
		return false;
	}

	// Don't show for non-admins.
	if ( ! current_user_can( 'update_plugins' ) ) {
		return false;
	}

	// Is the notice temporarily dismissed?
	if ( give_square_is_connect_notice_dismissed() ) {
		return false;
	}

	$connect_button = give_square_connect_button();

	$message = sprintf(
		/* translators: 1. Connect Bold Text, 2. Connect Intro Text, 3. Dismiss Text, 4. Connect button html */
		'<strong>%1$s</strong> %2$s %3$s',
		__( 'Square Connect:', 'give-square' ),
		__( 'You\'re almost ready to start accepting online donations.', 'give-square' ),
		$connect_button
	);

	Give()->notices->register_notice( array(
		'id'               => 'give-square-connect-banner',
		'description'      => $message,
		'type'             => 'warning',
		'dismissible_type' => 'user',
		'dismiss_interval' => 'shortly',
	) );

	return true;

}

add_action( 'admin_notices', 'give_square_connect_maybe_show_banner' );

/**
 * This function will show notice when business location is not set.
 *
 * @since 1.0.0
 *
 * @return void
 */
function give_square_business_location_notice() {

	if (
		'square-settings' !== give_get_current_setting_section() &&
		give_square_is_connected() &&
		false === give_square_get_location_id()
	) {
		echo sprintf(
			/* translators: 1. Connect Bold Text */
			'<div class="notice notice-error"><p>%1$s <a href="%2$s">%3$s</a></p></div>',
			esc_html__( 'Give - Square is almost ready. Please', 'give-square' ),
			esc_url_raw( admin_url() . 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings' ),
			esc_html__( 'set your business location.', 'give-square' )
		);
	}
}

add_action( 'admin_notices', 'give_square_business_location_notice' );
