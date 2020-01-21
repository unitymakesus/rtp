<?php
/**
 * UABB initial setup
 *
 * @since 1.1.0.4
 * @package UABB Initial Setup
 */

/**
 * This class initializes UABB Init
 *
 * @class UABB_Init
 */
class UABB_Init {

	/**
	 * Variable for UABB opotions
	 *
	 * @var string $uabb_options
	 */
	public static $uabb_options;

	/**
	 *  Constructor
	 */
	public function __construct() {

		if ( class_exists( 'FLBuilder' ) ) {

			/**
			 *  For Performance
			 *  Set UABB static object to store data from database.
			 */
			self::set_uabb_options();

			add_filter( 'fl_builder_settings_form_defaults', array( $this, 'uabb_global_settings_form_defaults' ), 10, 2 );
			// Load all the required files of bb-ultimate-addon.
			self::includes();
			add_action( 'init', array( $this, 'init' ) );

			add_action( 'customize_preview_init', array( $this, 'uabb_customizer_save' ), 11 );

			// Enqueue scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 100 );

			add_action( 'wp_head', array( $this, 'uabb_render_scripts' ) );

			add_action( 'admin_notices', array( $this, 'update_bb_notice' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'load_uabb_admin_notice_js' ) );

			add_action( 'wp_ajax_dismissed_notice_handler', array( $this, 'load_uabb_ajax_notice_handler' ) );

			add_action( 'wp_ajax_dismissed_login_notice_handler', array( $this, 'load_uabb_ajax_login_notice_handler' ) );

		} else {

			// disable UABB activation ntices in admin panel.
			define( 'BSF_UABB_NOTICES', false );

			// Display admin notice for activating beaver builder.
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
		}

	}

	/**
	 * Function that includes js files for admin area
	 *
	 * @since 1.13.0
	 */
	function load_uabb_admin_notice_js() {
		wp_register_script( 'uabb-admin-notice-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-admin-notice.js', false, BB_ULTIMATE_ADDON_VER );
	}

	/**
	 * AJAX handler to store the state of dismissible notices.
	 *
	 * @since 1.13.0
	 */
	function load_uabb_ajax_notice_handler() {

		check_ajax_referer( 'uabb-admin-nonce', 'dismiss_nonce' );
		// Request the dismissed value.
		$dismissed = sanitize_text_field( $_REQUEST['dismissed'] );
		// Store it in the options table.
		update_option( 'dismiss-admin-notice', $dismissed );
	}
	/**
	 * AJAX handler to store the state of dismissible notices.
	 *
	 * @since 1.24.2
	 */
	function load_uabb_ajax_login_notice_handler() {

		check_ajax_referer( 'uabb-admin-nonce', 'dismiss_login_nonce' );
		// Request the dismissed value.
		$dismissed = sanitize_text_field( $_REQUEST['dismissed'] );
		// Store it in the options table.
		update_option( 'dismiss-admin-login-notice', $dismissed );
	}

	/**
	 * Function that includes necessary files
	 *
	 * @since x.x.x
	 */
	function includes() {

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-update.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-compatibility.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-backward.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-helper.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-cloud-templates.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings-multisite.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-template-ajax.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-functions.php';
		// Attachment Fields.
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-attachment.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-blog-posts.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-wpml.php';

		// Advanced Menu Walker.
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-menu-walker.php';

		// fields.
		require_once BB_ULTIMATE_ADDON_DIR . 'fields/config.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-branding.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-graupi-branding.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings-form.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/helper.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-extended-row-column.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-ui-panel.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'includes/row.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'includes/column.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/class-uabb-batch-process.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'lib/notices/class-astra-notices.php';

		// Load the appropriate text-domain.
		$this->load_plugin_textdomain();

	}

	/**
	 *   For Performance.
	 *   Set UABB static object to store data from database.
	 */
	static function set_uabb_options() {
		self::$uabb_options = array(
			'fl_builder_uabb'          => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb', true ),
			'fl_builder_uabb_branding' => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_branding', false ),
			'uabb_global_settings'     => get_option( '_uabb_global_settings' ),

			'fl_builder_uabb_modules'  => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_modules', false ),
		);
	}

	/**
	 * Function that renders UABB Global Settings form defaults
	 *
	 * @since x.x.x
	 * @param array  $defaults gets the array for the form defaults.
	 * @param string $form_type gets an array to check the form type.
	 */
	function uabb_global_settings_form_defaults( $defaults, $form_type ) {

		if ( ( ! apply_filters( 'uabb_global_support', true ) || class_exists( 'FLCustomizer' ) || function_exists( 'generate_customize_register' ) ) && 'uabb-global' == $form_type ) {

			$defaults->enable_global = 'no';

		}

		return $defaults; // Must be returned!.
	}

	/**
	 * Function that initializes init function
	 *
	 * @since x.x.x
	 */
	function init() {

		if ( apply_filters( 'uabb_global_support_form', true ) && class_exists( 'FLBuilderAJAX' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-integration.php';
		}

		add_filter( 'bsf_allow_beta_updates_uabb', array( $this, 'uabb_beta_updates_check' ) );
		add_filter( 'bsf_license_not_activate_message_uabb', array( $this, 'license_not_active_message' ), 10, 3 );

		if ( class_exists( 'FLCustomizer' ) ) {
			$uabb_global_style = UABB_Global_Styling::get_uabb_global_settings();

			if ( ( isset( $uabb_global_style->enable_global ) && ( 'no' == $uabb_global_style->enable_global ) ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-bbtheme-global-integration.php';
			}
		} elseif ( function_exists( 'generate_customize_register' ) ) {
			$uabb_global_style = UABB_Global_Styling::get_uabb_global_settings();

			if ( ( isset( $uabb_global_style->enable_global ) && ( 'no' == $uabb_global_style->enable_global ) ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-generatepress-global-integration.php';
			}
		}

		// Nested forms.
		require_once BB_ULTIMATE_ADDON_DIR . 'objects/fl-nested-form-button.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-iconfonts.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-model-helper.php';

		$this->load_modules();
	}

	/**
	 * Function that renders license not active message
	 *
	 * @since x.x.x
	 * @param array  $not_activate gets the HTML if license not active.
	 * @param string $license_status_class gets the license status class.
	 * @param string $license_not_activate_message gets an string to display the message.
	 */
	public function license_not_active_message( $not_activate, $license_status_class, $license_not_activate_message ) {
		$not_activate = '<span class="license-error-heading ' . $license_status_class . ' ' . $license_not_activate_message . '">UPDATES UNAVAILABLE! Please enter your license key below to enable automatic updates.</span>';

		return $not_activate;
	}

	/**
	 * Function that saves UABB customizer settings
	 *
	 * @since x.x.x
	 */
	public function uabb_customizer_save() {
		if ( isset( UABB_Init::$uabb_options['uabb_global_settings']['enable_global'] ) && ( 'no' == UABB_Init::$uabb_options['uabb_global_settings']['enable_global'] ) ) {
			if ( class_exists( 'FLCustomizer' ) ) {
				new UABB_BBThemeGlobalIntegration();
			}
			FLBuilderModel::delete_asset_cache_for_all_posts();
		}
	}

	/**
	 * Function that renders UABB's Text-domain
	 *
	 * @since 1.4.6
	 */
	function load_plugin_textdomain() {
		// Traditional WordPress plugin locale filter.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'uabb' );

		// Setup paths to current locale file.
		$mofile_global = trailingslashit( WP_LANG_DIR ) . 'plugins/bb-ultimate-addon/' . $locale . '.mo';
		$mofile_local  = trailingslashit( BB_ULTIMATE_ADDON_DIR ) . 'languages/' . $locale . '.mo';

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/plugins/bb-ultimate-addon/ folder.
			return load_textdomain( 'uabb', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/bb-ultimate-addon/languages/ folder.
			return load_textdomain( 'uabb', $mofile_local );
		}

		// Nothing found.
		return false;
	}

	/**
	 * Function that loads UABB's scripts
	 *
	 * @since x.x.x
	 */
	function load_scripts() {

		$uabb_localize = apply_filters(
			'uabb_js_localize',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);

		wp_localize_script( 'jquery', 'uabb', $uabb_localize );

		if ( FLBuilderModel::is_builder_active() ) {

			wp_enqueue_style( 'uabb-builder-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-builder.css', array() );
			wp_enqueue_script( 'uabb-builder-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-builder.js', array( 'jquery' ), '', true );

			$uabb_options = UABB_Init::$uabb_options['fl_builder_uabb'];

			if ( is_array( $uabb_options ) ) {
				if ( array_key_exists( 'load_panels', $uabb_options ) ) {
					if ( 1 == $uabb_options['load_panels'] ) {
						wp_enqueue_style( 'uabb-builder-css111', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-ui.css', array() );
					}
				}
			}

			if ( apply_filters( 'uabb_global_support_form', true ) ) {

				wp_localize_script( 'uabb-builder-js', 'uabb_global', array( 'show_global_button' => true ) );

				$uabb = UABB_Global_Styling::get_uabb_global_settings();

				if ( isset( $uabb->enable_global ) && ( 'no' == $uabb->enable_global ) ) {
					wp_localize_script( 'uabb-builder-js', 'uabb_presets', array( 'show_presets' => true ) );
				}
			}
		}

		/* RTL Support */
		if ( is_rtl() ) {
			wp_enqueue_style( 'uabb-rtl-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-rtl.css', array() );
		}

	}

	/**
	 * Function that renders admin notices
	 *
	 * @since 1.12.0
	 */
	public static function get_branding_name() {

		$name          = 'Ultimate Addons For Beaver Builder';
		$branding_name = get_option( '_fl_builder_uabb_branding' );

		if ( is_array( $branding_name ) && array_key_exists( 'uabb-plugin-name', $branding_name ) && '' != $branding_name['uabb-plugin-name'] ) {
			$name = $branding_name['uabb-plugin-name'];
		}

		return $name;
	}

	/**
	 * Function that renders admin notices
	 *
	 * @since x.x.x
	 */
	function admin_notices() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
			|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		$name = self::get_branding_name();

		echo '<div class="notice notice-error">';
		echo '<p>The <strong>' . $name . '</strong> ' . __( 'plugin requires', 'uabb' ) . " <strong><a href='" . $url . "'>Beaver Builder</strong></a>" . __( ' plugin installed & activated.', 'uabb' ) . '</p>';
		echo '</div>';
	}

	/**
	 * Function that render admin notice for updating BB
	 *
	 * @since 1.11.0
	 */
	function update_bb_notice() {

		$name                            = self::get_branding_name();
		$bb_stable_version               = '2.0.7';
		$branding_name                   = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
		$branding_short_name             = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );
		$is_dismissed                    = get_option( 'dismiss-admin-notice', false );
		$is_dismissed_login              = get_option( 'dismiss-admin-login-notice', false );
		$uabb_social_facebook_app_id     = '';
		$uabb_social_facebook_app_secret = '';
		$admin_link                      = admin_url( 'options-general.php?page=uabb-builder-settings#uabb-social' );

		$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

		if ( is_array( $uabb_setting_options ) ) {

			$uabb_social_facebook_app_id     = ( array_key_exists( 'uabb-social-facebook-app-id', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-facebook-app-id'] : '';
			$uabb_social_facebook_app_secret = ( array_key_exists( 'uabb-social-facebook-app-secret', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-facebook-app-secret'] : '';
		}

		// Added in version 1.12.1 to enqueue admin notice scripts in admin area.
		if ( version_compare( $bb_stable_version, FL_BUILDER_VERSION, '>' ) || ( isset( $uabb_social_facebook_app_id ) && ! empty( $uabb_social_facebook_app_id ) && empty( $uabb_social_facebook_app_secret ) ) ) {
			wp_enqueue_script( 'uabb-admin-notice-js' );
		}

		// Added in version 1.12.1 to check the value if the admin notice is dismissed.
		if ( false === $is_dismissed ) {
			if ( version_compare( $bb_stable_version, FL_BUILDER_VERSION, '>' ) ) {
				// Added in version 1.12.1 to verify if Branding name is added.
				if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
					echo '<div data-nonce="' . wp_create_nonce( 'uabb-admin-nonce' ) . '" class="notice notice-error notice-warn uabb-admin-dismiss-notice is-dismissible">';
					echo sprintf( '<p> The <strong>%1$s</strong> plugin requires minimum %2$s version of the Beaver Builder plugin. Refer following <a href="https://www.ultimatebeaver.com/docs/fix-for-php-fatal-error-after-updating-uabb/" target="_blank"> link</a> on how to resolve this issue.</p>', $name, $bb_stable_version );
					echo '</div>';
				} else {
					echo '<div data-nonce="' . wp_create_nonce( 'uabb-admin-nonce' ) . '" class="notice notice-error notice-warn uabb-admin-dismiss-notice is-dismissible">';
					echo sprintf( '<p> The <strong>%1$s</strong> plugin requires minimum %2$s version of the Beaver Builder plugin.</p>', $name, $bb_stable_version );
					echo '</div>';
				}
			}
		}
		if ( false == $is_dismissed_login ) {
			if ( isset( $uabb_social_facebook_app_id ) && ! empty( $uabb_social_facebook_app_id ) && empty( $uabb_social_facebook_app_secret ) ) {
				// Added in version 1.12.1 to verify if Branding name is added.
				if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
					echo '<div data-nonce="' . wp_create_nonce( 'uabb-admin-nonce' ) . '" class="notice notice-error notice-warn uabb-admin-login-dismiss-notice is-dismissible">';
					echo sprintf(
						'<p> With new <strong>%1$s </strong>version 1.24.2 it is mandatory to add a Facebook App Secret Key <a href="%2$s">here</a> for the Login Form widget. This is to ensure extra security for the widget. <br><br>
In case your existing login form is not displaying Facebook login option, adding the App Secret Key will fix it.  ', $name, esc_url( $admin_link )
					);
					echo '</div>';
				} else {
					echo '<div data-nonce="' . wp_create_nonce( 'uabb-admin-nonce' ) . '" class="notice notice-error notice-warn uabb-admin-login-dismiss-notice is-dismissible">';
					echo sprintf(
						'<p> With new <strong>%1$s </strong>version 1.24.2 it is mandatory to add a Facebook App Secret Key <a href="%2$s">here</a> for the Login Form widget. This is to ensure extra security for the widget. <br><br>
In case your existing login form is not displaying Facebook login option, adding the App Secret Key will fix it.  ', $branding_name, esc_url( $admin_link )
					);
					echo '</div>';
				}
			}
		}

	}

	/**
	 * Function that renders UABB Beta Updates Check
	 *
	 * @since x.x.x
	 */
	function uabb_beta_updates_check() {
		$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];

		$beta_enable = isset( $uabb['uabb-enable-beta-updates'] ) ? $uabb['uabb-enable-beta-updates'] : false;

		if ( true == $beta_enable ) {
			return true;
		}

		return false;
	}

	/**
	 * Function that loads the modules.
	 *
	 * @since x.x.x
	 */
	function load_modules() {

		$enable_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();

		$is_child_theme = is_child_theme();
		$child_dir      = get_stylesheet_directory() . '/bb-ultimate-addon/modules/';
		$theme_dir      = get_template_directory() . '/bb-ultimate-addon/modules/';
		$addon_dir      = BB_ULTIMATE_ADDON_DIR . 'modules/';

		foreach ( $enable_modules as $file => $name ) {

			if ( 'false' == $name ) {
				continue;
			}

			$module_path = $file . '/' . $file . '.php';
			$child_path  = $child_dir . $module_path;
			$theme_path  = $theme_dir . $module_path;
			$addon_path  = $addon_dir . $module_path;

			$admin_backend = apply_filters( 'enable_uabb_modules_backend', true, 10, 1 );

			$enable_backend = '';

			if ( true === $admin_backend ) {
				$enable_backend = true;
			} elseif ( false === $admin_backend ) {
				$enable_backend = ! is_admin();
			}
			// Check for the module class in a child theme.
			if ( $is_child_theme && file_exists( $child_path ) && $enable_backend ) {
				require_once $child_path;
			} elseif ( file_exists( $theme_path ) && $enable_backend ) {
				// Check for the module class in a parent theme.
				require_once $theme_path;
			} elseif ( file_exists( $addon_path ) && $enable_backend ) {
				// Check for the module class in the builder directory.
				require_once $addon_path;
			}
		}
	}

	/**
	 * Custom inline scripts.
	 *
	 * @since 1.6.8
	 * @return void
	 */
	public function uabb_render_scripts() {
		$branding      = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
		$branding_name = 'UABB';
		if ( is_array( $branding ) && array_key_exists( 'uabb-plugin-short-name', $branding ) && '' != $branding['uabb-plugin-short-name'] ) {
			$branding_name = $branding['uabb-plugin-short-name'];
		}

		if ( FLBuilderModel::is_builder_active() ) {
			?>
			<style>
				form[class*="fl-builder-adv-testimonials"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-advanced-accordion"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-advanced-icon"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-advanced-separator"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-advanced-tabs"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-blog-posts"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-creative-link"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-dual-button"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-dual-color-heading"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-fancy-text"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-flip-box"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-google-map"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-ihover"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-image-icon"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-image-separator"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-info-banner"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-info-box"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-info-circle"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-info-list"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-info-table"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-interactive-banner-1"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-interactive-banner-2"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-list-icon"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-mailchimp-subscribe-form"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-modal-popup"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-photo-gallery"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-pricing-box"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-progress-bar"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-ribbon"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-slide-box"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-spacer-gap"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-team"] .fl-lightbox-header h1:before,
				form[class*="fl-builder-uabb-"] .fl-lightbox-header h1:before {
					content: "<?php echo $branding_name; ?> " !important;
					position: relative;
					display: inline-block;
					margin-right: 5px;
				}
			</style>
			<?php
		}
	}
}

/**
 * Initialize the class only after all the plugins are loaded.
 */
function init_uabb() {
	$uabb_init = new UABB_Init();
}

add_action( 'plugins_loaded', 'init_uabb' );


