<?php

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Get home URL
 *
 * @return string
 */
function ppw_core_get_home_url_with_ssl() {
	return is_ssl() ? home_url( '/', 'https' ) : home_url( '/' );
}

/**
 * Get current role
 *
 * @return array
 */
function ppw_core_get_current_role() {
	if ( ! is_user_logged_in() ) {
		return array();
	}

	$current_user = wp_get_current_user();
	if ( is_multisite() && is_super_admin( $current_user->ID ) ) {
		return array( 'administrator' );
	}

	return $current_user->roles;
}

/**
 * Get settings
 *
 * @param $name_settings
 * @param $blog_id
 *
 * @return mixed
 */
function ppw_core_get_settings( $name_settings, $blog_id = false ) {
	$settings       = ! $blog_id ? get_option( PPW_Constants::GENERAL_OPTIONS, false ) : get_blog_option( $blog_id, PPW_Constants::GENERAL_OPTIONS, false );
	$default_result = null;
	if ( ! $settings ) {
		return $default_result;
	}

	$options = json_decode( $settings );
	if ( ! isset( $options->$name_settings ) ) {
		return $default_result;
	}

	return $options->$name_settings;
}

/**
 * Get settings entire site
 *
 * @param $name_settings
 *
 * @return mixed
 */
function ppw_core_get_settings_entire_site( $name_settings ) {
	$settings       = get_option( PPW_Constants::ENTIRE_SITE_OPTIONS, false );
	$default_result = null;
	$options        = ppw_free_fix_serialize_data( $settings, false );
	if ( empty( $options ) || ! isset( $options[ $name_settings ] ) ) {
		return $default_result;
	}

	return $options[ $name_settings ];
}

/**
 * Get setting type is bool
 *
 * @param $name_settings
 * @param $blog_id
 *
 * @return bool
 */
function ppw_core_get_setting_type_bool( $name_settings, $blog_id = false ) {
	$setting = ppw_core_get_settings( $name_settings, $blog_id );

	return 'true' === $setting || '1' === $setting;
}

/**
 * Get setting type is string
 *
 * @param string $name_settings The setting name.
 *
 * @return string
 */
function ppw_core_get_setting_type_string( $name_settings ) {
	$setting = ppw_core_get_settings( $name_settings );

	return is_string( $setting ) ? $setting : '';
}

/**
 * Get setting type is array
 *
 * @param $name_settings
 *
 * @return array
 */
function ppw_core_get_setting_type_array( $name_settings ) {
	$setting = ppw_core_get_settings( $name_settings );

	return ! is_array( $setting ) ? array() : $setting;
}

/**
 * Get setting entire site type is bool
 *
 * @param $name_settings
 *
 * @return bool
 */
function ppw_core_get_setting_entire_site_type_bool( $name_settings ) {
	return 'true' === ppw_core_get_settings_entire_site( $name_settings );
}

/**
 * Get setting entire site type is string
 *
 * @param $name_settings
 *
 * @return string
 */
function ppw_core_get_setting_entire_site_type_string( $name_settings ) {
	$setting = ppw_core_get_settings_entire_site( $name_settings );

	return is_string( $setting ) ? $setting : '';
}

/**
 * Get setting entire site type is array
 *
 * @param $name_settings
 *
 * @return array
 */
function ppw_core_get_setting_entire_site_type_array( $name_settings ) {
	$setting = ppw_core_get_settings_entire_site( $name_settings );

	return ! is_array( $setting ) ? array() : $setting;
}

function ppw_core_get_query_param() {
	$current_url = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$query_str   = parse_url( $current_url, PHP_URL_QUERY );
	parse_str( $query_str, $query_params );

	return $query_params;
}

/**
 * Render form login
 *
 * @return mixed
 */
function ppw_core_render_login_form() {
	/**
	 * Get value for Password Form
	 */
	global $post;
	$post_id                     = $post->ID;
	$query_params                = ppw_core_get_query_param();
	$wrong_password              = array_key_exists( PPW_Constants::WRONG_PASSWORD_PARAM, $query_params ) && 'true' === $query_params[ PPW_Constants::WRONG_PASSWORD_PARAM ];
	$default_wrong_error_message = apply_filters( PPW_Constants::HOOK_MESSAGE_ENTERING_WRONG_PASSWORD, PPW_Constants::DEFAULT_WRONG_PASSWORD_MESSAGE );
	$instruction_text            = apply_filters( PPW_Constants::HOOK_MESSAGE_PASSWORD_FORM, PPW_Constants::DEFAULT_FORM_MESSAGE );
	$label                       = 'pwbox-' . ( empty( $post_id ) ? rand() : $post_id );
	$submit_label                = wp_kses_post( get_theme_mod( 'ppwp_form_button_label', PPW_Constants::DEFAULT_SUBMIT_LABEL ) );
	$password_label              = wp_kses_post( get_theme_mod( 'ppwp_form_instructions_password_label', PPW_Constants::DEFAULT_PASSWORD_LABEL ) );
	$place_holder                = wp_kses_post( get_theme_mod( 'ppwp_form_instructions_placeholder', PPW_Constants::DEFAULT_PLACEHOLDER ) );
	$headline_text               = wp_kses_post( get_theme_mod( 'ppwp_form_instructions_headline', PPW_Constants::DEFAULT_HEADLINE_TEXT ) );
	$form_message                = wp_kses_post( get_theme_mod( 'ppwp_form_instructions_text', $instruction_text ) );
	$show_password               = get_theme_mod( 'ppwp_form_instructions_is_show_password', PPW_Constants::DEFAULT_IS_SHOW_PASSWORD ) ? '<input id="ppw_' . $post_id . '" onclick="ppwShowPassword(' . $post_id . ')" type="checkbox"> Show password' : '';

	/**
	 * Generate Password Form.
	 */
	$wrong_password_message = sprintf(
		'<div class="ppwp-wrong-pw-error ppw-ppf-error-msg">%1$s</div>',
		wp_kses_post( get_theme_mod( 'ppwp_form_error_message_text', $default_wrong_error_message ) )
	);
	$wrong_message          = $wrong_password ? $wrong_password_message : '';
	$default_element        = '<div class="ppw-ppf-input-container">
						<h3 class="ppw-ppf-headline">' . $headline_text . '</h3>
						<div class="ppw-ppf-desc">' . __( $form_message ) . '</div>
						<p>
							<label for="' . $label . '">' . $password_label . ' <input placeholder="' . $place_holder . '" name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . $submit_label . '" />
						</p>' . $show_password . '</div>' .
	                          $wrong_message;

	$form_content = apply_filters( PPW_Constants::HOOK_CUSTOM_PASSWORD_FORM, $default_element, $post_id, $wrong_message );
	$script       = '
		<script>
	        function ppwShowPassword(postId) {
	            const ppwBox = jQuery(\'#pwbox-\' + postId);
	            if (jQuery(\'#ppw_\' + postId).prop(\'checked\')) {
	                ppwBox.attr({"type": \'text\',});
	            } else {
	                ppwBox.attr({"type": \'password\',});
	            }
	        }
		</script>
		';
	$output       = '<form action="' . esc_url( site_url( 'wp-login.php?action=ppw_postpass', 'login_post' ) ) . '" class="ppw-post-password-form post-password-form" method="post">'
	                . $form_content
	                . '<input type="hidden" name="post_id" value="' . $post_id . '" />'
	                . '</form>'
	                . $script;

	return $output;
}

/**
 * Get all post types
 *
 * @param string $output Value to output
 *
 * @return array Array Post types
 *
 */
function ppw_core_get_all_post_types( $output = 'objects' ) {
	$args       = array(
		'public' => true,
	);
	$post_types = get_post_types( $args, $output );
	unset( $post_types['attachment'] );

	return $post_types;
}

/**
 * Get unit time
 *
 * @param $password_cookie_expired
 *
 * @return int
 */
function ppw_core_get_unit_time( $password_cookie_expired ) {
	$time_die = explode( " ", $password_cookie_expired );
	$unit     = 0;
	if ( count( $time_die ) === 2 ) {
		if ( $time_die[1] === "minutes" ) {
			$unit = 60;
		} else if ( $time_die[1] === "hours" ) {
			$unit = 3600;
		} else if ( $time_die[1] === "days" ) {
			$unit = 86400;
		}
	}

	return $unit;
}

/**
 * Get all posts password protected by WordPress
 *
 * @return mixed
 */
function ppw_core_get_posts_password_protected_by_wp() {
	$posts_type = apply_filters( PPW_Constants::HOOK_POST_TYPES, array( 'page', 'post' ) );

	return get_posts( array(
		'post_status'  => 'publish',
		'post_type'    => $posts_type,
		'numberposts'  => - 1,
		'has_password' => true,
	) );
}

/**
 * Check Pro version activated and license valid
 *
 * @return bool
 */
function is_pro_active_and_valid_license() {
	if ( ! is_plugin_active( PPW_Constants::PRO_DIRECTORY ) && ! is_plugin_active( PPW_Constants::DEV_PRO_DIRECTORY ) ) {
		return false;
	}
	$license_key      = get_option( 'wp_protect_password_license_key', '' );
	$is_valid_license = get_option( 'wp_protect_password_licensed' );

	return ! empty( $license_key ) && ( '1' === $is_valid_license || true === $is_valid_license );
}

/**
 * Load the pro libs.
 */
function ppw_core_load_pro_lib() {
	if ( is_dir( WP_PLUGIN_DIR . '/' . PPW_Constants::PRO_ROOT_DIR ) ) {
		require_once WP_PLUGIN_DIR . '/' . PPW_Constants::PRO_ROOT_DIR . '/yme-plugin-update-checker/plugin-update-checker.php';
	} elseif ( is_dir( WP_PLUGIN_DIR . '/' . PPW_Constants::DEV_PRO_ROOT_DIR ) ) {
		require_once WP_PLUGIN_DIR . '/' . PPW_Constants::DEV_PRO_ROOT_DIR . '/yme-plugin-update-checker/plugin-update-checker.php';
	}
}

/**
 *
 * @param $cookie_expired
 *
 * @return bool
 */
function ppw_core_validate_cookie_expiry( $cookie_expired ) {
	$cookie_expired_array = explode( ' ', $cookie_expired );
	if ( 2 !== count( $cookie_expired_array ) ) {
		return true;
	}

	$value = $cookie_expired_array[0];
	if ( ! intval( $value ) ) {
		return true;
	}

	$int_val = intval( $value );
	if ( $int_val <= 0 ) {
		return true;
	}

	$unit       = $cookie_expired_array[1];
	$max_cookie = 365;
	switch ( $unit ) {
		case 'days':
			return $int_val > $max_cookie;
		case 'hours':
			return $int_val > $max_cookie * 24;
		case 'minutes':
			return $int_val > $max_cookie * 24 * 60;
		default:
			return true;
	}
}

/**
 * Get param in url
 *
 * @param $url
 *
 * @return mixed
 */
function ppw_core_get_param_in_url( $url ) {
	$query_str = parse_url( $url, PHP_URL_QUERY );
	parse_str( $query_str, $query_params );

	return $query_params;
}

/**
 * Clean data in post meta
 *
 * @param      $meta_key
 * @param bool $blog_prefix
 *
 * @return mixed
 */
function ppw_core_delete_data_in_post_meta_by_meta_key( $meta_key, $blog_prefix = false ) {
	global $wpdb;
	$table_post_meta = ! $blog_prefix ? $wpdb->prefix . 'postmeta' : $blog_prefix . 'postmeta';

	return $wpdb->delete( $table_post_meta, array(
		'meta_key' => $meta_key,
	) );
}

/**
 * Clear cache for Cache plugin, includes: WP Super Cache, WP Fastest Cache and W3 Total Cache
 *
 * @param int|string $post_id The post ID.
 */
function ppw_core_clear_cache_by_id( $post_id ) {
	// Clear cache for WP Super Cache plugin.
	if ( function_exists( 'prune_super_cache' ) && function_exists( 'get_supercache_dir' ) ) {
		global $blog_cache_dir;
		prune_super_cache( $blog_cache_dir, true );
		prune_super_cache( get_supercache_dir(), true );
	}

	// Clear cache for WP Fastest Cache plugin.
	do_action( 'wpfc_clear_post_cache_by_id', false, $post_id );

	// Clear cache for W3 Total Cache plugin.
	do_action( 'w3tc_flush_url', get_permalink( $post_id ) );
}

/**
 * Get default post options for feature "hide protect content"
 *
 * @param string $post_type The post type.
 *
 * @return array
 */
function ppw_core_get_default_post_options( $post_type ) {
	$default_options = array();
	if ( ppw_core_check_yoast_seo_turn_on_site_maps() ) {
		$default_options = array(
			PPW_Constants::XML_YOAST_SEO_SITEMAPS,
		);
	}

	switch ( $post_type ) {
		case 'page':
			$default_page_options = array(
				PPW_Constants::FRONT_PAGE,
				PPW_Constants::EVERYWHERE_PAGE,
				PPW_Constants::SEARCH_RESULTS,
			);

			return array_merge( $default_options, $default_page_options );
		case 'post':
			$default_post_options = array(
				PPW_Constants::FRONT_PAGE,
				PPW_Constants::CATEGORY_PAGE,
				PPW_Constants::TAG_PAGE,
				PPW_Constants::AUTHOR_PAGE,
				PPW_Constants::ARCHIVES_PAGE,
				PPW_Constants::NEXT_PREVIOUS,
				PPW_Constants::RECENT_POST,
				PPW_Constants::SEARCH_RESULTS,
				PPW_Constants::FEEDS,
			);

			return array_merge( $default_options, $default_post_options );
		default:
			return array();
	}
}

/**
 * Get post options for feature "Hide protect content"
 *
 * @param string $post_type The post type.
 *
 * @return array
 */
function ppw_core_get_position_hide_post( $post_type ) {
	$options = array();
	if ( ppw_core_check_yoast_seo_turn_on_site_maps() ) {
		$options = array(
			array(
				'value' => PPW_Constants::XML_YOAST_SEO_SITEMAPS,
				'label' => esc_html__( 'XML sitemaps', 'password-protect-page' ),
			),
		);
	}

	switch ( $post_type ) {
		case 'page':
			$page_options = array(
				array(
					'value' => PPW_Constants::FRONT_PAGE,
					'label' => esc_html__( 'Front page', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::EVERYWHERE_PAGE,
					'label' => esc_html__( 'Everywhere pages are listed', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::SEARCH_RESULTS,
					'label' => esc_html__( 'Search results', 'password-protect-page' ),
				),
			);

			return array_merge( $options, $page_options );
		case 'post':
			$post_options = array(
				array(
					'value' => PPW_Constants::FRONT_PAGE,
					'label' => esc_html__( 'Front page', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::CATEGORY_PAGE,
					'label' => esc_html__( 'Category pages', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::TAG_PAGE,
					'label' => esc_html__( 'Tag pages', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::AUTHOR_PAGE,
					'label' => esc_html__( 'Author pages', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::ARCHIVES_PAGE,
					'label' => esc_html__( 'Archives', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::NEXT_PREVIOUS,
					'label' => esc_html__( 'Next & Previous', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::RECENT_POST,
					'label' => esc_html__( 'Recent posts', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::SEARCH_RESULTS,
					'label' => esc_html__( 'Search results', 'password-protect-page' ),
				),
				array(
					'value' => PPW_Constants::FEEDS,
					'label' => esc_html__( 'RSS', 'password-protect-page' ),
				),
			);

			return array_merge( $options, $post_options );
		default:
			return array();
	}
}

/**
 * Check site maps in Yoast SEO plugin
 *
 * @return bool
 */
function ppw_core_check_yoast_seo_turn_on_site_maps() {
	if ( ! is_plugin_active( 'wordpress-seo/wp-seo.php' ) && ! is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) {
		return false;
	}

	if ( ! method_exists( 'WPSEO_Options', 'get' ) ) {
		return false;
	}

	return WPSEO_Options::get( 'enable_xml_sitemap' );
}

/**
 * Get post type for feature hide protected content
 *
 * @return array
 */
function ppw_core_get_post_type_for_hide_protect_content() {
	$post_types = array_filter(
		array_map(
			function ( $type ) {
				return array(
					'value' => $type->name,
					'label' => $type->label,
				);
			},
			ppw_core_get_all_post_types()
		),
		function ( $type ) {
			return 'post' !== $type['value'] && 'page' !== $type['value'];
		}
	);

	array_unshift(
		$post_types,
		array(
			'value' => 'page_post',
			'label' => 'Pages & Posts',
		)
	);

	return array_values( $post_types );
}

/**
 * Check logic and add query
 *
 * @param string $position          The position, example: front page, category, tag,....
 * @param array  $position_selected List position selected.
 * @param array  $protected_ids     List ids protected.
 * @param string $where             The WHERE clause of the query.
 * @param string $type              page/post.
 *
 * @return string
 */
function ppw_core_add_query_by_position( $position, $position_selected, $protected_ids, $where, $type ) {
	if ( ! in_array( $position, $position_selected, true ) ) {
		return $where;
	}
	global $wpdb;
	foreach ( $protected_ids as $id ) {
		if ( get_post_type( $id ) !== $type ) {
			continue;
		}
		$where .= " AND {$wpdb->posts}.ID != {$id}";
	}

	return $where;
}

/**
 * Check logic and add query for posts
 *
 * @param array  $position_selected List position selected.
 * @param array  $protected_ids     all ids protected.
 * @param string $where             The WHERE clause of the query.
 * @param string $type              page/post.
 *
 * @return string
 */
function ppw_core_handle_logic_add_query( $position_selected, $protected_ids, $where, $type ) {
	// Hide posts protected in home page.
	if ( is_home() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::FRONT_PAGE, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in category page.
	if ( is_category() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::CATEGORY_PAGE, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in search results page.
	if ( is_search() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::SEARCH_RESULTS, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in tag page.
	if ( is_tag() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::TAG_PAGE, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in author page.
	if ( is_author() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::AUTHOR_PAGE, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in archive page.
	if ( is_date() && is_archive() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::ARCHIVES_PAGE, $position_selected, $protected_ids, $where, $type );
	}
	// Hide posts protected in feeds.
	if ( is_feed() ) {
		$where = ppw_core_add_query_by_position( PPW_Constants::FEEDS, $position_selected, $protected_ids, $where, $type );
	}

	return $where;
}

/**
 * Check condition and push post_id/page_id protected to list exclude in site maps
 *
 * @param array  $position_selected List position selected.
 * @param array  $protected_ids     List ids protected.
 * @param array  $ids               List page_id/post_id exclude in Yoast SEO XML Sitemaps.
 * @param string $type              page/post.
 *
 * @return array
 */
function ppw_core_list_posts_exclude_in_site_maps( $position_selected, $protected_ids, $ids, $type ) {
	if ( ! in_array( PPW_Constants::XML_YOAST_SEO_SITEMAPS, $position_selected, true ) ) {
		return $ids;
	}
	foreach ( $protected_ids as $id ) {
		if ( get_post_type( $id ) !== $type ) {
			continue;
		}
		array_push( $ids, $id );
	}

	return $ids;
}

/**
 * Get positions selected for feature "Hide Protected Content"
 * Default full options, if user customs then follow options in DB.
 *
 * @param string $post_type The post type.
 *
 * @return array
 */
function ppw_core_get_options_selected( $post_type ) {
	$ppw_type_selected        = ppw_core_get_setting_type_array( PPW_Constants::HIDE_SELECTED . $post_type );
	$default_options_selected = apply_filters( PPW_Constants::HOOK_CUSTOM_DEFAULT_OPTIONS_HIDE_PROTECTED_POST, ppw_core_get_default_post_options( $post_type ), $post_type );

	return empty( $ppw_type_selected ) ? $default_options_selected : $ppw_type_selected;
}

/**
 * Render UI for feature "Hide Protected Content"
 *
 * @param array $ppw_post_types List post types.
 */
function ppw_core_check_logic_before_render_ui( $ppw_post_types ) {
	foreach ( $ppw_post_types as $ppw_post_type ) {
		if ( 'page_post' !== $ppw_post_type['value'] ) {
			$is_pro_activated = apply_filters( PPW_Constants::HOOK_IS_PRO_ACTIVATE, false );
			if ( $is_pro_activated ) {
				$ppw_type             = $ppw_post_type['value'];
				$ppw_is_hide          = ppw_core_get_setting_type_bool( PPW_Constants::HIDE_PROTECTED . $ppw_type );
				$ppw_options_selected = ppw_core_get_options_selected( $ppw_type );
				$ppw_options          = apply_filters( PPW_Constants::HOOK_CUSTOM_POSITIONS_HIDE_PROTECTED_POST, ppw_core_get_position_hide_post( $ppw_type ), $ppw_type );
				ppw_core_ui_hide_protected_content( $ppw_is_hide, $ppw_options, $ppw_options_selected, $ppw_type, $ppw_post_type['label'] );
			}
		} else {
			foreach ( PPW_Constants::DEFAULT_POST_TYPE as $ppw_type ) {
				$ppw_label            = $ppw_type . 's';
				$ppw_is_hide          = ppw_core_get_setting_type_bool( PPW_Constants::HIDE_PROTECTED . $ppw_type );
				$ppw_options_selected = ppw_core_get_options_selected( $ppw_type );
				$ppw_options          = apply_filters( PPW_Constants::HOOK_CUSTOM_POSITIONS_HIDE_PROTECTED_POST, ppw_core_get_position_hide_post( $ppw_type ), $ppw_type );
				ppw_core_ui_hide_protected_content( $ppw_is_hide, $ppw_options, $ppw_options_selected, $ppw_type, $ppw_label );
			}
		}
	}
}

/**
 * Render UI for feature Hide Protected Content
 *
 * @param bool   $ppw_hide     On/Off option "Hide protected pages/posts from the following places".
 * @param array  $ppw_options  All options of pages/posts.
 * @param array  $ppw_selected All option selected of pages/post.
 * @param string $ppw_type     type is Page/Post.
 * @param string $ppw_label    Label of Page/Post.
 */
function ppw_core_ui_hide_protected_content( $ppw_hide, $ppw_options, $ppw_selected, $ppw_type, $ppw_label ) {
	$checked      = $ppw_hide ? esc_attr( 'checked' ) : '';
	$hide_element = $ppw_hide ? '' : esc_attr( 'ppw_hide_element' );
	$required     = $ppw_hide ? esc_attr( 'required' ) : '';
	$options      = '';
	foreach ( $ppw_options as $ppw_page_option ) {
		$post_selected = in_array( $ppw_page_option['value'], $ppw_selected, true ) ? esc_attr( 'selected' ) : '';
		$value         = esc_attr( $ppw_page_option['value'] );
		$label         = $ppw_page_option['label'];
		$options       .= "<option $post_selected value='$value' >$label</option>";
	}
	// translators: %s: Subtitle.
	$sub_title = sprintf( __( 'Exclude the password protected %s from the following views', 'password-protect-page' ), strtolower( $ppw_label ) );
	echo "
		<tr class='ppw_wrap_$ppw_type ppw_hide_protect_content' style='display: none'>
			<td></td>
			<td>
				<div class='ppw-wrap-hide-file-protected'>
					<label class='pda_switch ppw-label-hide-file-protected'>
						<input type='checkbox' id='ppw_hide_protected_{$ppw_type}' $checked />
						<span class='pda-slider round'></span>
					</label>
					<p class='ppw-wrap-des-hide-file-protected'>
						$sub_title
					</p>
				</div>
				<div id='ppw_wrap_hide_selected_{$ppw_type}' class='ppw-wrap-select2-hide-file-protected $hide_element'>
					<select $required id='ppw_hide_selected_{$ppw_type}' multiple='multiple' class='ppwp_select2'>
						$options			
					</select>
				</div>
			</td>
		</tr>
	";
}