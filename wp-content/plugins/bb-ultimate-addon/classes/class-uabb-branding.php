<?php
/**
 * White labeling for the builder.
 *
 * @since 1.8
 * @package White Labeling for UABB
 */

/**
 * This class initializes UABB Branding
 *
 * @class UABBBranding
 */
final class UABBBranding {

	/**
	 * Function that initializes necessary filters
	 *
	 * @return void
	 */
	static public function init() {
		add_filter( 'all_plugins', __CLASS__ . '::plugins_page' );
		add_filter( 'fl_builder_ui_js_strings', __CLASS__ . '::add_js_string' );
	}

	/**
	 * Branding addon on the plugins page.
	 *
	 * @since 1.0.0.1
	 * @param array $plugins An array data for each plugin.
	 * @return array
	 */
	static public function plugins_page( $plugins ) {

		$branding = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
		$basename = plugin_basename( BB_ULTIMATE_ADDON_DIR . 'bb-ultimate-addon.php' );

		if ( isset( $plugins[ $basename ] ) && is_array( $branding ) ) {

			$plugin_name = ( array_key_exists( 'uabb-plugin-name', $branding ) ) ? $branding['uabb-plugin-name'] : '';
			$plugin_desc = ( array_key_exists( 'uabb-plugin-desc', $branding ) ) ? $branding['uabb-plugin-desc'] : '';
			$author_name = ( array_key_exists( 'uabb-author-name', $branding ) ) ? $branding['uabb-author-name'] : '';
			$author_url  = ( array_key_exists( 'uabb-author-url', $branding ) ) ? $branding['uabb-author-url'] : '';

			if ( '' != $plugin_name ) {
				$plugins[ $basename ]['Name']  = $plugin_name;
				$plugins[ $basename ]['Title'] = $plugin_name;
			}

			if ( '' != $plugin_desc ) {
				$plugins[ $basename ]['Description'] = $plugin_desc;
			}

			if ( '' != $author_name ) {
				$plugins[ $basename ]['Author']     = $author_name;
				$plugins[ $basename ]['AuthorName'] = $author_name;
			}

			if ( '' != $author_url ) {
				$plugins[ $basename ]['AuthorURI'] = $author_url;
				$plugins[ $basename ]['PluginURI'] = $author_url;
			}
		}
		return $plugins;
	}

	/**
	 * UABB Global js String
	 *
	 * @param string $js_strings gets the strigns file to UABB.
	 */
	static public function add_js_string( $js_strings ) {

		if ( UABB_PREFIX == 'UABB' ) {
			$js_strings['uabbGlobalSettings'] = esc_attr__( 'UABB - Global Settings', 'uabb' );
			$js_strings['uabbKnowledgeBase']  = esc_attr__( 'UABB - Knowledge Base', 'uabb' );
			$js_strings['uabbContactSupport'] = esc_attr__( 'UABB - Contact Support', 'uabb' );
		} else {
			$js_strings['uabbGlobalSettings'] = sprintf( /* translators: %s: search term */
				esc_attr__( '%s - Global Settings', 'uabb' ),
				UABB_PREFIX
			);

			$js_strings['uabbKnowledgeBase'] = sprintf( /* translators: %s: search term */
				esc_attr__( '%s - Knowledge Base', 'uabb' ),
				UABB_PREFIX
			);

			$js_strings['uabbContactSupport'] = sprintf( /* translators: %s: search term */
				esc_attr__( '%s - Contact Support', 'uabb' ),
				UABB_PREFIX
			);
		}

		$uabb = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
		if ( is_array( $uabb ) ) {
			$uabb_knowledge_base_url             = ( array_key_exists( 'uabb-knowledge-base-url', $uabb ) && '' != $uabb['uabb-knowledge-base-url'] ) ? $uabb['uabb-knowledge-base-url'] : 'https://www.ultimatebeaver.com/docs/?utm_source=uabb-pro-dashboard&utm_medium=editor&utm_campaign=knowledge-base-help-link';
			$uabb_contact_support_url            = ( array_key_exists( 'uabb-contact-support-url', $uabb ) && '' != $uabb['uabb-contact-support-url'] ) ? $uabb['uabb-contact-support-url'] : 'https://www.ultimatebeaver.com/contact/?utm_source=uabb-pro-dashboard&utm_medium=editor&utm_campaign=contact-help-link';
			$js_strings['uabbKnowledgeBaseUrl']  = $uabb_knowledge_base_url;
			$js_strings['uabbContactSupportUrl'] = $uabb_contact_support_url;
		} else {
			$js_strings['uabbKnowledgeBaseUrl']  = 'https://www.ultimatebeaver.com/docs/?utm_source=uabb-pro-dashboard&utm_medium=editor&utm_campaign=knowledge-base-help-link';
			$js_strings['uabbContactSupportUrl'] = 'https://www.ultimatebeaver.com/contact/?utm_source=uabb-pro-dashboard&utm_medium=editor&utm_campaign=contact-help-link';
		}
		return $js_strings;
	}
}

UABBBranding::init();
