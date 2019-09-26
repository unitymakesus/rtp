<?php
/**
 * Plugin Name: Give - Square
 * Plugin URI:  https://givewp.com/addons/square/
 * Description: Adds support to accept donations via the Square Payment gateway.
 * Version:     1.0.4
 * Author:      GiveWP
 * Author URI:  https://givewp.com
 * Text Domain: give-square
 * Domain Path: /languages
 * GitHub URI: https://github.com/impress-org/give-square.git
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Give_Square' ) ) :

	/**
	 * Class Give_Square.
	 *
	 * @since 1.0.0
	 */
	class Give_Square {

		/**
		 * Create Single Give Square Instance.
		 *
		 * @var $instance
		 */
		private static $instance;


		/**
		 * Notices (array)
		 *
		 * @since 1.0.0
		 *
		 * @var array
		 */
		public $notices = array();

		/**
		 * Returns single instance of this class.
		 *
		 * @since 1.0.0
		 *
		 * @return Give_Square
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
				self::$instance->setup();
			}

			return self::$instance;
		}

		/**
		 * Setup Give Square.
		 *
		 * @since  1.0.0
		 * @access private
		 */
		private function setup() {

			// Setup constants.
			$this->setup_constants();

			// Give init hook.
			add_action( 'give_init', array( $this, 'init' ), 10 );
			add_action( 'admin_init', array( $this, 'check_environment' ), 999 );
			add_action( 'admin_notices', array( $this, 'admin_notices' ), 15 );
		}

		/**
		 * Initialize Plugin after plugins loaded.
		 *
		 * @since 1.0.0
		 */
		public function init() {

			// Load Text Domain for Give - Square Integration.
			load_plugin_textdomain( 'give-square', false, GIVE_SQUARE_BASENAME . '/languages' );
			$this->licensing();

			if ( ! $this->get_environment_warning() ) {
				return;
			}

			$this->includes();
			$this->activation_banner();

		}

		/**
		 * Setup Constants.
		 *
		 * @since 1.0.0
		 */
		public function setup_constants() {

			if ( ! defined( 'GIVE_SQUARE_VERSION' ) ) {
				define( 'GIVE_SQUARE_VERSION', '1.0.3' );
			}

			if ( ! defined( 'GIVE_SQUARE_MIN_GIVE_VER' ) ) {
				define( 'GIVE_SQUARE_MIN_GIVE_VER', '2.4.0' );
			}

			if ( ! defined( 'GIVE_SQUARE_MIN_PHP_VERSION' ) ) {
				define( 'GIVE_SQUARE_MIN_PHP_VERSION', '5.4' );
			}

			if ( ! defined( 'GIVE_SQUARE_PLUGIN_FILE' ) ) {
				define( 'GIVE_SQUARE_PLUGIN_FILE', __FILE__ );
			}

			if ( ! defined( 'GIVE_SQUARE_PLUGIN_DIR' ) ) {
				define( 'GIVE_SQUARE_PLUGIN_DIR', dirname( GIVE_SQUARE_PLUGIN_FILE ) );
			}

			if ( ! defined( 'GIVE_SQUARE_PLUGIN_URL' ) ) {
				define( 'GIVE_SQUARE_PLUGIN_URL', plugin_dir_url( GIVE_SQUARE_PLUGIN_FILE ) );
			}

			if ( ! defined( 'GIVE_SQUARE_BASENAME' ) ) {
				define( 'GIVE_SQUARE_BASENAME', plugin_basename( GIVE_SQUARE_PLUGIN_FILE ) );
			}

		}

		/**
		 * Include Required Files.
		 *
		 * @since 1.0.0
		 */
		private function includes() {

			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/admin/activation.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/admin/admin-actions.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/admin/admin-filters.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/admin/upgrade-functions.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/vendor/autoload.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/actions.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/filters.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/helpers.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/scripts.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/class-give-square-customer.php';
			require_once GIVE_SQUARE_PLUGIN_DIR . '/includes/class-give-square-gateway.php';

		}

		/**
		 * Plugin Licensing.
		 *
		 * @since 1.0.0
		 */
		public function licensing() {
			if ( class_exists( 'Give_License' ) ) {
				new Give_License( GIVE_SQUARE_PLUGIN_FILE, 'Square Gateway', GIVE_SQUARE_VERSION, 'WordImpress', 'square_license_key' );
			}
		}

		/**
		 * Check plugin environment.
		 *
		 * @since  1.0.0
		 * @access public
		 *
		 * @return bool
		 */
		public function check_environment() {

			// Flag to check whether plugin file is loaded or not.
			$is_working = true;

			// Load plugin helper functions.
			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once ABSPATH . '/wp-admin/includes/plugin.php';
			}

			// Check if Give Core plugin is active or not.
			$is_give_active = defined( 'GIVE_PLUGIN_BASENAME' ) ? is_plugin_active( GIVE_PLUGIN_BASENAME ) : false;

			if ( empty( $is_give_active ) ) {

				// Show admin notice.
				$this->add_admin_notice(
					'prompt_give_activate',
					'error',
					sprintf(
						/* translators: 1. Strong Text, 2. Intro Text, 3. URL, 4. Plugin Name, 5. End Text. */
						'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s',
						__( 'Activation Error:', 'give-square' ),
						__( 'You must have the', 'give-square' ),
						esc_url_raw( 'https://givewp.com' ),
						__( 'Give', 'give-square' ),
						__( 'plugin installed and activated for Give - Square to activate.', 'give-square' )
					)
				);
				$is_working = false;
			}

			return $is_working;
		}

		/**
		 * Check plugin for Give environment.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return bool
		 */
		public function get_environment_warning() {

			// Flag to check whether plugin file is loaded or not.
			$is_working = true;

			// Verify dependency cases.
			if (
				defined( 'GIVE_VERSION' )
				&& version_compare( GIVE_VERSION, GIVE_SQUARE_MIN_GIVE_VER, '<' )
			) {

				// Display notice when minimum Give Core plugin version is not found.
				$this->add_admin_notice(
					'prompt_give_incompatible',
					'error',
					sprintf(
						/* translators: 1. Strong Text, 2. Intro Text, 3. URL, 4. Plugin Name, 5. Plugin Text, 6. Plugin Version, 7. End Text */
						'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s %6$s %7$s',
						__( 'Activation Error:', 'give-square' ),
						__( 'You must have the', 'give-square' ),
						esc_url_raw( 'https://givewp.com' ),
						__( 'Give', 'give-square' ),
						__( 'core version', 'give-square' ),
						GIVE_SQUARE_MIN_GIVE_VER,
						__( 'for the Give - Square add-on to activate.', 'give-square' )
					)
				);

				$is_working = false;
			}

			if ( version_compare( phpversion(), GIVE_SQUARE_MIN_PHP_VERSION, '<' ) ) {
				$this->add_admin_notice(
					'prompt_give_incompatible',
					'error',
					sprintf(
						/* translators: 1. Strong Text, 2. Intro Text, 3. URL, 4. PHP text, 5. Min Plugin Version, 6. End Text */
						'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s %6$s',
						__( 'Activation Error:', 'give-square' ),
						__( 'You must have the', 'give-square' ),
						esc_url_raw( 'https://givewp.com/documentation/core/requirements/' ),
						__( 'PHP version', 'give-square' ),
						GIVE_SQUARE_MIN_PHP_VERSION,
						__( 'or above for the Give - Square gateway add-on to activate.', 'give-square' )
					)
				);

				$is_working = false;
			}

			return $is_working;
		}

		/**
		 * Allow this class and other classes to add notices.
		 *
		 * @since 1.0.0
		 *
		 * @param string $slug    Admin Notice Slug.
		 * @param string $class   Admin Notice Type.
		 * @param string $message Admin Notice Message.
		 */
		public function add_admin_notice( $slug, $class, $message ) {
			$this->notices[ $slug ] = array(
				'class'   => $class,
				'message' => $message,
			);
		}

		/**
		 * Display admin notices.
		 *
		 * @since 1.0.0
		 */
		public function admin_notices() {

			$allowed_tags = array(
				'a'      => array(
					'href'  => array(),
					'title' => array(),
					'class' => array(),
					'id'    => array(),
				),
				'br'     => array(),
				'em'     => array(),
				'span'   => array(
					'class' => array(),
				),
				'strong' => array(),
			);

			foreach ( (array) $this->notices as $notice_key => $notice ) {
				echo "<div class='" . esc_attr( $notice['class'] ) . "'><p>";
				echo wp_kses( $notice['message'], $allowed_tags );
				echo '</p></div>';
			}

		}

		/**
		 * Show activation banner for this add-on.
		 *
		 * @since 1.0.0
		 *
		 * @return bool
		 */
		public function activation_banner() {

			// Check for activation banner inclusion.
			if (
				! class_exists( 'Give_Addon_Activation_Banner' )
				&& file_exists( GIVE_PLUGIN_DIR . 'includes/admin/class-addon-activation-banner.php' )
			) {
				include GIVE_PLUGIN_DIR . 'includes/admin/class-addon-activation-banner.php';
			}

			// Initialize activation welcome banner.
			if ( class_exists( 'Give_Addon_Activation_Banner' ) ) {

				// Only runs on admin.
				$args = array(
					'file'              => GIVE_SQUARE_PLUGIN_FILE,
					'name'              => __( 'Square Gateway', 'give-square' ),
					'version'           => GIVE_SQUARE_VERSION,
					'settings_url'      => admin_url( 'edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=square-settings' ),
					'documentation_url' => 'http://docs.givewp.com/addon-square',
					'support_url'       => 'https://givewp.com/support/',
					'testing'           => false,
				);
				new Give_Addon_Activation_Banner( $args );
			}

			return true;
		}

	}

endif; // End if class_exists check.

if ( ! function_exists( 'give_square' ) ) {

	/**
	 * Returns class object instance.
	 *
	 * @since 1.0.0
	 *
	 * @return Give_Square bool|object
	 */
	function give_square() {
		return Give_Square::get_instance();
	}

	give_square();
}
