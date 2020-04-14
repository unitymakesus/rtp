<?php
/**
 * Backward compatibility.
 *
 * @since 1.14.0
 * @package BB Version Check
 */

if ( ! class_exists( 'UABB_Compatibility' ) ) {

	/**
	 * UABB_Plugin_Backward initial setup
	 *
	 * @since 1.14.0
	 */
	class UABB_Compatibility {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Holds BB current version.
		 *
		 * @since 1.14.0
		 * @var $version_bb_check
		 */
		public static $version_bb_check;

		/**
		 * Holds uabb migration status.
		 *
		 * @since 1.14.0
		 * @var $uabb_migration
		 */
		public static $uabb_migration;

		/**
		 * Holds BB new page status.
		 *
		 * @since 1.14.0
		 * @var $stable_version_new_page
		 */
		public static $stable_version_new_page;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'uabb_compatibility_init' ) );
		}
		/**
		 * Adding the UABB Compatibility.
		 *
		 * @since 1.14.0
		 */
		public function uabb_compatibility_init() {

			/**
			 * Check the BB's New version.
			 *
			 * @since 1.14.0
			 */
			if ( null === self::$version_bb_check ) {

				$bb_builder_version = substr_replace( FL_BUILDER_VERSION, '', strpos( FL_BUILDER_VERSION, '-' ) );

				if ( '' !== $bb_builder_version ) {
					self::$version_bb_check = version_compare( $bb_builder_version, '2.2', '>=' );
				} else {
					self::$version_bb_check = version_compare( FL_BUILDER_VERSION, '2.2', '>=' );
				}
			}

			/**
			 * Check if the page is created before UABB version 1.6.9 and is successfully migrated in between version 1.7.0 - version 1.13.2
			 *
			 * @since 1.3.0
			 */
			if ( null === self::$uabb_migration ) {

				$post_id = get_the_ID();

				self::$uabb_migration = get_post_meta( $post_id, '_uabb_converted', true );
			}

			/**
			 * Check if the page is created in between UABB version 1.7.0 - version 1.13.2
			 *
			 * @since 1.14.0
			 */

			if ( null === self::$stable_version_new_page ) {

				$post_id = get_the_ID();

				self::$stable_version_new_page = get_post_meta( $post_id, '_uabb_version', true );

				if ( '' !== self::$stable_version_new_page ) {
					self::$stable_version_new_page = 'yes';
				}
			}
		}
	}
}

UABB_Compatibility::get_instance();
