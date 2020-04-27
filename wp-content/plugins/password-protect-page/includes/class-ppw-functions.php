<?php
/**
 * Check condition and include plugin.php file
 */
if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Check data before update setting
 *
 * @param array $request         Request data.
 * @param array $setting_keys    Keys need to check.
 * @param bool  $is_check_cookie Is check cookie.
 *
 * @return bool
 */
function ppw_free_is_setting_data_invalid( $request, $setting_keys, $is_check_cookie = true ) {
	if ( ppw_free_is_setting_keys_and_nonce_invalid( $request, PPW_Constants::GENERAL_FORM_NONCE ) ) {
		return true;
	}

	$settings = $request["settings"];
	foreach ( $setting_keys as $key ) {
		if ( ! array_key_exists( $key, $settings ) ) {
			return true;
		}
	}

	if ( ! $is_check_cookie ) {
		return false;
	}

	// Check regular expression.
	return ppw_core_validate_cookie_expiry( $settings[ PPW_Constants::COOKIE_EXPIRED ] );
}

/**
 * Check data before update entire site settings
 *
 * @param $request
 *
 * @return bool
 */
function ppw_free_is_entire_site_settings_data_invalid( $request ) {
	return ppw_free_is_setting_keys_and_nonce_invalid( $request, PPW_Constants::ENTIRE_SITE_FORM_NONCE );
}

/**
 * @param $request
 * @param $nonce_key
 *
 * @return bool
 */
function ppw_free_is_setting_keys_and_nonce_invalid( $request, $nonce_key ) {
	if ( ! array_key_exists( 'settings', $request ) ||
	     ! array_key_exists( 'security_check', $request ) ) {
		return true;
	}

	if ( ! wp_verify_nonce( $request['security_check'], $nonce_key ) ) {
		return true;
	}

	return false;
}

/**
 * Check error before create new password
 *
 * @param $request
 * @param $setting_keys
 *
 * @return bool
 */
function ppw_free_error_before_create_password( $request, $setting_keys ) {
	if ( ppw_free_is_setting_keys_and_nonce_invalid( $request, PPW_Constants::META_BOX_NONCE ) ) {
		return true;
	}

	$settings = $request["settings"];
	foreach ( $setting_keys as $key ) {
		if ( ! array_key_exists( $key, $settings ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Validate password type is global
 *
 * @param $new_global_passwords
 * @param $current_global_passwords
 * @param $current_roles_password
 */
function ppw_free_validate_password_type_global( $new_global_passwords, $current_global_passwords, $current_roles_password ) {
	if ( count( $new_global_passwords ) < 1 && empty( $current_global_passwords ) ) {
		wp_send_json(
			array(
				'is_error' => true,
				'message'  => PPW_Constants::EMPTY_PASSWORD,
			),
			400
		);
		wp_die();
	}

	$global_validate = ppw_free_check_duplicate_global_password( $new_global_passwords, $current_roles_password );
	if ( $global_validate ) {
		wp_send_json(
			array(
				'is_error' => true,
				'message'  => PPW_Constants::DUPLICATE_PASSWORD,
			),
			400
		);
		wp_die();
	}
}

/**
 * Check case duplicate password type is global
 *
 * @param $new_global_passwords
 * @param $current_roles_password
 *
 * @return bool
 */
function ppw_free_check_duplicate_global_password( $new_global_passwords, $current_roles_password ) {
	if ( empty( $current_roles_password ) ) {
		return false;
	}
	$password_duplicate = array_intersect( $new_global_passwords, array_values( $current_roles_password ) );

	return ! empty( $password_duplicate );
}

/**
 * Validate password type is role
 *
 * @param $role_selected
 * @param $new_role_password
 * @param $current_global_passwords
 * @param $current_roles_password
 */
function ppw_free_validate_password_type_role( $role_selected, $new_role_password, $current_global_passwords, $current_roles_password ) {
	if ( '' === $new_role_password && ( ! isset( $current_roles_password[ $role_selected ] ) || '' === $current_roles_password[ $role_selected ] ) ) {
		wp_send_json(
			array(
				'is_error' => true,
				'message'  => PPW_Constants::EMPTY_PASSWORD,
			),
			400
		);
		wp_die();
	}

	$role_validate = ppw_free_check_duplicate_role_password( $new_role_password, $current_global_passwords );
	if ( $role_validate ) {
		wp_send_json(
			array(
				'is_error' => true,
				'message'  => PPW_Constants::DUPLICATE_PASSWORD,
			),
			400
		);
		wp_die();
	}
}

/**
 * Check case duplicate password type is role
 *
 * @param $new_role_password
 * @param $current_global_passwords
 *
 * @return bool
 */
function ppw_free_check_duplicate_role_password( $new_role_password, $current_global_passwords ) {
	if ( empty( $current_global_passwords ) ) {
		return false;
	}
	$new_role_password = wp_unslash( $new_role_password );

	return in_array( $new_role_password, $current_global_passwords );
}

/**
 * Get all page and post
 *
 * @return array
 */
function ppw_free_get_all_page_post() {
	return array_merge( get_pages(), get_posts( array( 'post_status' => 'publish', 'numberposts' => - 1 ) ) );
}

/**
 * Helper to fix serialized data
 * TODO: write UT for this important function
 *
 * @param $raw_data
 * @param $is_un_slashed
 *
 * @return array
 */
function ppw_free_fix_serialize_data( $raw_data, $is_un_slashed = true ) {
	if ( ! $raw_data ) {
		return array();
	}

	$serialize_raw_data = @unserialize( $raw_data );
	if ( false === $serialize_raw_data ) {
		return $raw_data;
	}

	return $is_un_slashed ? wp_unslash( $serialize_raw_data ) : $serialize_raw_data;
}

/**
 * @param $cookie
 * @param $expiration
 *
 * @return bool
 */
function ppw_free_bypass_cache_with_cookie_for_pro_version( $cookie, $expiration ) {
	if ( defined( 'COOKIEHASH' ) ) {
		$cookie_hash = preg_quote( constant( 'COOKIEHASH' ) );
	}
	setcookie( PPW_Constants::WP_POST_PASS . $cookie_hash, $cookie, $expiration, COOKIEPATH, COOKIE_DOMAIN );

	return true;
}

/**
 * Check custom login form is showing to avoid conflict with the_password_form default of WordPress.
 *  - Check post type is default type ( post or page )
 *  - Do not show login form product type because we handled it in PPW Pro version. ( woocommerce_before_single_product
 *  hook )
 *  - If Pro version is active then we check protection type in setting to show login form
 *
 * @param string $post_type Post Type of Post.
 *
 * @return bool True|False Is show login form.
 */
function ppw_is_post_type_selected_in_setting( $post_type ) {
	/**
	 * Check default post type
	 * Free & Pro version default: post and page type.
	 */
	if ( 'post' === $post_type || 'page' === $post_type ) {
		return true;
	}

	$is_handle_old_product_type = apply_filters( PPW_Constants::HOOK_HANDLE_BEFORE_RENDER_WOO_PRODUCT, 'product' === $post_type, $post_type );
	if ( $is_handle_old_product_type || ! class_exists( 'PPW_Pro_Constants' ) ) {
		return false;
	}
	$post_type_selected = ppw_core_get_setting_type_array( PPW_Pro_Constants::WPP_WHITELIST_COLUMN_PROTECTIONS );

	/**
	 * Check post type in setting which user selected.
	 */
	return in_array( $post_type, $post_type_selected, true );
}

/**
 * Get post_id from referer url if Post data is not exist post_id.
 *
 * @return int post_id Post ID, 0 if post id not exist.
 */
function ppw_get_post_id_from_request() {
	if ( isset( $_POST['post_id'] ) ) {
		return wp_unslash( $_POST['post_id'] );
	}
	/**
	 * Make sure http referer on server.
	 * Not make exception in url_to_postid.
	 */
	if ( ! isset( $_SERVER['HTTP_REFERER'] ) ) {
		return 0;
	}

	// Get post id from referer url.
	return url_to_postid( $_SERVER['HTTP_REFERER'] );
}

/**
 * WP introduced is_wp_version_compatible function from version 5.2.0 only.
 * (https://developer.wordpress.org/reference/functions/is_wp_version_compatible/)
 * Need to write the helper by our-self.
 *
 * @param string $required Version to check.
 *
 * @return bool
 */
function ppw_is_wp_version_compatible( $required ) {
	return empty( $required ) || version_compare( get_bloginfo( 'version' ), $required, '>=' );
}

/**
 * Get page title for home, category, tag or post
 *
 * @return string
 */
function ppw_get_page_title() {
	$site_title       = get_bloginfo( 'title' );
	$site_description = get_bloginfo( 'description' );
	$post_title       = wp_title( '', false ); // Post title, category tile, tag title.
	$dash_score_site  = '' === $site_title || '' === $site_description ? '' : ' – ';
	$dash_score_post  = '' === $site_title || '' === $post_title ? '' : ' – ';

	return is_home() || is_front_page()
		? sprintf( '%1$s%2$s%3$s', $site_title, $dash_score_site, $site_description )
		: sprintf( '%1$s%2$s%3$s', $post_title, $dash_score_post, $site_title );
}

/**
 * Get post excerpt if post is protected via Settings.
 *
 * @param WP_Post $post            Post WordPress Object.
 * @param string  $content         Content of post.
 * @param bool    $is_show_excerpt Is show excerpt.
 * @return string
 */
function ppw_handle_protected_content( $post, $content, $is_show_excerpt ) {
	if ( $is_show_excerpt && $post->post_excerpt ) {
		$content = $post->post_excerpt . $content;
	}

	if ( ! preg_match( '/name=.+post_id/mi', $content ) ) {
		$content = '<em>[This is password-protected.]</em>';

		return apply_filters( 'the_ppw_password_message', $content );
	}

	return $content;
}

/**
 * Helper function to get Pro version.
 */
function ppw_get_pro_version() {
	if ( ! defined( 'PPW_PRO_VERSION' ) ) {
		return '';
	}

	return PPW_PRO_VERSION;
}
