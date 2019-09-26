<?php
/**
 * List of Admin Filter Hooks.
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
 * Register Section for Gateway Settings.
 *
 * @param array $sections List of sections.
 *
 * @since 1.0.0
 *
 * @return mixed
 */
function give_square_register_sections( $sections ) {

	$sections['square-settings'] = __( 'Square Settings', 'give-square' );

	return $sections;
}

add_filter( 'give_get_sections_gateways', 'give_square_register_sections' );

/**
 * Add "Square" advanced settings.
 *
 * @param array $section List of sections.
 *
 * @since 1.0.0
 *
 * @return mixed
 */
function give_square_connect_add_advanced_section( $section ) {
	$section['square'] = __( 'Square', 'give-square' );

	return $section;
}

add_filter( 'give_get_sections_advanced', 'give_square_connect_add_advanced_section' );

/**
 * Add advanced Square settings.
 *
 * New tab under Settings > Advanced that allows users to use their own API key.
 *
 * @param array $settings List of settings.
 *
 * @since 1.0.0
 *
 * @return mixed
 */
function give_square_register_advanced_settings( $settings ) {

	$current_section = give_get_current_setting_section();

	// Bailout, if not a square section under advanced tab.
	if ( 'square' !== $current_section ) {
		return $settings;
	}

	// Disconnect Square OAuth API when manual API keys are enabled.
	if ( give_square_is_manual_api_keys_enabled() ) {
		give_square_disconnect_oauth();
	}

	switch ( $current_section ) {
		case 'square':
			$settings = array(
				array(
					'id'   => 'give_title_square_advanced',
					'type' => 'title',
				),
				array(
					'name'    => __( 'Square API Keys', 'give-square' ),
					'desc'    => __( 'Enable if you would like to use your own API keys instead of Square Connect via OAuth API.', 'give-square' ),
					'id'      => 'square_api_keys',
					'type'    => 'radio_inline',
					'default' => 'disabled',
					'options' => array(
						'enabled'  => __( 'Enabled', 'give-square' ),
						'disabled' => __( 'Disabled', 'give-square' ),
					),
				),
				array(
					'name'          => __( 'Square Styles', 'give-square' ),
					'desc'          => sprintf(
						'%1$s <a href="%2$s" target="_blank">%3$s</a>.',
						__( 'Edit the properties above to match the look and feel of your WordPress theme. These styles will be applied to Square Credit Card fields including Card Number, CVC and Expiration. Any valid CSS property can be defined, however, it must be formatted as JSON, not CSS. For more information on Styling Square CC fields please see this ', 'give-square' ),
						esc_url_raw( 'https://docs.connect.squareup.com/payments/sqpaymentform/overview' ),
						__( 'article', 'give-square' )
					),
					'wrapper_class' => 'give-square-styles-wrap',
					'id'            => 'square_styles',
					'type'          => 'textarea',
					'default'       => '{}',
				),
				array(
					'id'   => 'give_title_square_advanced',
					'type' => 'sectionend',
				),
			);
			break;
	} // End switch().


	// Output.
	return $settings;

}

add_filter( 'give_get_settings_advanced', 'give_square_register_advanced_settings', 10, 1 );

/**
 * This function is used to add a new cron interval
 *
 * @param array $schedules Cron Interval Schedules.
 *
 * @since 1.0.0
 *
 * @return mixed
 */
function give_square_add_monthly_cron_interval( $schedules ) {
	$schedules['monthly'] = array(
		'interval' => 2592000,
		'display'  => esc_html__( 'Monthly', 'give-square' ),
	);

	return $schedules;
}

add_filter( 'cron_schedules', 'give_square_add_monthly_cron_interval' );

