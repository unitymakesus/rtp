<?php
/**
 * Helper functions for BSF Core.
 * 
 * @author Brainstorm Force
 * @package bsf-core
 */

function get_api_site( $prefer_unsecure = false ) {

	if ( defined( 'BSF_API_URL' ) ) {
		$bsf_api_site = BSF_API_URL;
	} else {
		$bsf_api_site = 'http://support.brainstormforce.com/';

		if ( false == $prefer_unsecure && wp_http_supports( array( 'ssl' ) ) ) {
			$bsf_api_site = set_url_scheme( $bsf_api_site, 'https' );
		}
	}

	return $bsf_api_site;
}

function get_api_url( $prefer_unsecure = false ) {
	$url = get_api_site( $prefer_unsecure ) . 'wp-admin/admin-ajax.php';

	return $url;
}

if ( ! function_exists( 'bsf_convert_core_path_to_relative' ) ) {

	/**
	 * Depracate bsf_convert_core_path_to_relative() to in favour of bsf_core_url()
	 *
	 * @param  $path $path depracated
	 * @return String       URL of bsf-core directory.
	 */
	function bsf_convert_core_path_to_relative( $path ) {
		_deprecated_function( __FUNCTION__, '1.22.46', 'bsf_core_url' );

		return bsf_core_url( '' );
	}
}

if ( ! function_exists( 'bsf_core_url' ) ) {

	function bsf_core_url( $append = '' ) {
		$path       = wp_normalize_path( BSF_UPDATER_PATH );
		$theme_dir  = wp_normalize_path( get_template_directory() );
		$plugin_dir = wp_normalize_path( WP_PLUGIN_DIR );

		if ( strpos( $path, $theme_dir ) !== false ) {
			return rtrim( get_template_directory_uri() . '/admin/bsf-core/', '/' ) . $append;
		} elseif ( strpos( $path, $plugin_dir ) !== false ) {
			return rtrim( plugin_dir_url( BSF_UPDATER_FILE ), '/' ) . $append;
		} elseif ( strpos( $path, dirname( plugin_basename( BSF_UPDATER_FILE ) ) ) !== false ) {
			return rtrim( plugin_dir_url( BSF_UPDATER_FILE ), '/' ) . $append;
		}

		return false;
	}
}