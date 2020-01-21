<?php
/**
 * UABB Batch Process
 *
 * @package UABB
 * @since 1.20.2
 */

if ( ! class_exists( 'UABB_Batch_Process' ) ) :

	/**
	 * UABB_Batch_Process
	 *
	 * @since 1.20.2
	 */
	class UABB_Batch_Process {

		/**
		 * Instance
		 *
		 * @since 1.20.2
		 * @var object Class object.
		 * @access private
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @since 1.20.2
		 * @var object Class object.
		 * @access private
		 */
		private $is_processed = false;

		/**
		 * Instance
		 *
		 * @since 1.20.2
		 * @var object Class object.
		 * @access private
		 */
		private $batch_instance_bb;

		/**
		 * Images URL Mapping
		 *
		 * From the content we downlaod the images and create the image mapping array
		 * which contain the key as a old image url and the value as a new image url.
		 *
		 * @since 1.20.2
		 * @var object Class object.
		 * @access public
		 */
		public static $all_image_links = array();

		/**
		 * Initiator
		 *
		 * @since 1.20.2
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.20.2
		 */
		public function __construct() {

			// Core Helpers - Image.
			require_once ABSPATH . 'wp-admin/includes/image.php';

			// Core Helpers - Batch Processing.
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/helpers/class-uabb-importer-image.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/helpers/class-wp-async-request.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/helpers/class-wp-background-process.php';

			require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/class-uabb-importer-beaver-builder.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/batch-process/class-uabb-importer-beaver-builder-batch.php';
			$this->batch_instance_bb = new UABB_Importer_Beaver_Builder_Batch();

			add_action( 'wp_ajax_uabb_update_hotlink_images', array( $this, 'update_hotlink_images' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'batch_process_scripts' ) );
			add_action( 'admin_notices', array( $this, 'register_notices' ) );
			add_action( 'uabb_import_complete', array( $this, 'complete_batch_import' ) );
			add_filter( 'upload_mimes', array( $this, 'custom_upload_mimes' ) );
			add_filter( 'wp_prepare_attachment_for_js', array( $this, 'add_svg_image_support' ), 10, 3 );
			add_filter( 'uabb_image_importer_skip_image', array( $this, 'included_domains' ), 10, 2 );
			add_filter( 'fl_builder_override_apply_template', array( $this, 'process_render_template_dat_file' ), 10, 2 );
			add_filter( 'fl_builder_override_apply_node_template', array( $this, 'process_render_module_dat_file' ), 10, 2 );
			add_action( 'init', array( $this, 'retry_update_hotlink_images' ) );
		}
		/**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.20.2
		 * @param Hook $hook get the hooks for the styles.
		 */
		function batch_process_scripts( $hook ) {

			wp_enqueue_script( 'uabb-batch-process', BB_ULTIMATE_ADDON_URL . 'assets/js/batch-process.js', array( 'jquery' ), null, true );
			$vars = array(
				'_nonce'         => wp_create_nonce( 'uabb-template-cloud-nonce' ),
				'started_notice' => '<div class="notice-content">' . __( 'We will notify you once the process is complete.', 'uabb' ) . '</div>',
			);
			wp_localize_script( 'uabb-batch-process', 'UABB_Batch_Process_Vars', $vars );
		}
		/**
		 * Strat the Batch Processing.
		 *
		 * @since 1.20.2
		 * @return Void
		 */
		function update_hotlink_images() {

			check_ajax_referer( 'uabb-template-cloud-nonce', 'security' );
			error_log( 'Batch Started' );

			$batch_started = get_option( 'uabb_batch_process_started', false );

			if ( $batch_started ) {
				wp_send_json_success();
			}

			// Set flag.
			update_option( 'uabb_batch_process_started', true );

			// Take a backup first.
			$dir_info = UABB_Cloud_Templates::get_instance()->create_local_dir( 'bb-ultimate-addon/backup' );

			// Get all BB supported post types.
			$post_types = FLBuilderModel::get_post_types();

			if ( empty( $post_types ) ) {
				return;
			}

			foreach ( $post_types as $key => $post_type ) {
				$query_args = array(
					'post_type'      => $post_type,

					// Query performance optimization.
					'fields'         => 'ids',
					'no_found_rows'  => true,
					'posts_per_page' => -1,
				);
				$query      = new WP_Query( $query_args );

				if ( $query->posts ) {

					foreach ( $query->posts as $key => $post_id ) {

						// BB Enabled? If yes the proceed.
						if ( get_post_meta( $post_id, '_fl_builder_enabled', true ) ) {

							$data = get_post_meta( $post_id, '_fl_builder_data', true );
							// Backup first!
							// Save the backup.
							$check_file_created = fl_builder_filesystem()->file_put_contents( $dir_info['path'] . '/' . $post_id . '.dat', serialize( get_post_meta( $post_id, '_fl_builder_data', true ) ) );

							if ( true !== $check_file_created || empty( $dir_info ) ) {
								update_post_meta( $post_id, '_uabb_batch_backup_fl_builder_data', $data );
							}
							// Add to queue for process image download.
							$this->batch_instance_bb->push_to_queue( $post_id );
						}
					}

					// Dispatch Queue.
					$this->batch_instance_bb->save()->dispatch();
				}
			}

			wp_send_json_success();
		}
		/**
		 * Restrat the Batch Processing.
		 *
		 * @since 1.20.2
		 */
		function retry_update_hotlink_images() {

			$faild_links = get_option( 'uabb_batch_processing_faild_posts_id', false );

			$try_count = get_option( 'uabb-batch-process-try-hotlinks', 1 );

			$show_notice = get_transient( 'uabb_display_retry_notice' );

			$batch_complete = get_option( 'uabb_batch_process_complete', false );

			if ( ! empty( $faild_links ) && 3 >= $try_count && 'uabb_batch_process_complete' !== $show_notice && true == $batch_complete ) {

				error_log( 'Batch Retry Started......' . $try_count );

				delete_option( 'uabb_batch_process_complete', false );
				delete_transient( 'uabb-batch-process-start' );
				delete_option( 'uabb_batch_process_started', false );
				delete_user_meta( get_current_user_id(), 'uabb-batch-process-start', true );
				delete_transient( 'uabb-batch-process-complete' );
				delete_user_meta( get_current_user_id(), 'uabb-batch-process-complete', true );

				$batch_started = get_option( 'uabb_batch_process_started', false );

				// Set try 3 Times.
				$try_count = $try_count + 1;
				update_option( 'uabb-batch-process-try-hotlinks', $try_count );

				if ( $batch_started ) {
					wp_send_json_success();
				}
				// Set flag.
				update_option( 'uabb_batch_process_started', true );

				$faild_posts = get_option( 'uabb_batch_processing_faild_posts_id', false );

				if ( ! empty( $faild_posts ) ) {

					foreach ( $faild_posts as $id ) {

						// Add to queue for process image download.
						$this->batch_instance_bb->push_to_queue( $id );
					}
					// Dispatch Queue.
					$this->batch_instance_bb->save()->dispatch();
				}
			}

		}

		/**
		 * Batch Process.
		 *
		 * @since 1.20.2
		 */
		function register_notices() {

			$batch_started       = get_option( 'uabb_batch_process_started', false );
			$link                = '';
			$branding_name       = '';
			$branding_short_name = '';

			$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
			$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

			if ( empty( $branding_name ) && empty( $branding_short_name ) ) {

				$link = sprintf( /* translators: %1$s: search term */
				__( '%1$s <a href=" https://www.ultimatebeaver.com/docs/background-process-in-uabb/?utm_source=uabb-pro-backend&utm_medium=wordpress-screen&utm_campaign=batch-process-notice">%2$s</a> %3$s.', 'uabb' ), 'Read about', 'background process', 'in detail' );
			}
			if ( empty( $branding_name ) ) {
				$branding_name = __( 'Ultimate Addons for Beaver Builder', 'uabb' );
			}
			if ( empty( $branding_short_name ) ) {
				$branding_short_name = 'UABB';
			}

			$_journey_details = get_option( '_journey_details' );

			$current_version = $_journey_details['0']['current_version'];

			$version_compare = version_compare( '1.20.2', $current_version, '<' );

			$notice_dismissed = get_option( 'uabb_batch_notice_dismissed', 'no' );

			if ( ! $batch_started && ! $version_compare && 'no' === $notice_dismissed ) {
				Astra_Notices::add_notice(
					array(
						'id'                         => 'uabb-batch-process-start',
						'type'                       => 'info',
						'message'                    => '<div class="notice-content" style="margin:0;"><p style="margin-top:0;">Hello! ' . $branding_name . ' version 1.20.2 includes a background process to change all the HotLink Image URLs. This will download images from the ' . $branding_short_name . ' Template Cloud and upload it to your media library. ' . $link . '</p><a href="#" class="uabb-replace-hotlink-images button button-primary">Import Images</a><a href="#" class="astra-notice-close astra-review-notice button" style="margin-left: 10px;">Remind Me Later</a> <p style="margin-bottom:0;"> <b>If ' . $branding_short_name . ' Cloud Template is not used on the website please ignore this notice.</b></p></div>',
						'repeat-notice-after'        => MONTH_IN_SECONDS,
						'priority'                   => 10,
						'display-with-other-notices' => true,
					)
				);
			}

			$batch_complete = get_option( 'uabb_batch_process_complete', false );

			if ( $batch_complete ) {
				Astra_Notices::add_notice(
					array(
						'id'                         => 'uabb-batch-process-complete',
						'type'                       => 'info',
						'message'                    => '<div class="notice-content">' . __( 'Process Completed.', 'uabb' ) . '</div>',
						'display-with-other-notices' => false,
					)
				);
			}
		}
		/**
		 * Applies a user defined template instead of a core template.
		 * Called from the fl_builder_override_apply_template filter.
		 *
		 * @since 1.20.2
		 *
		 * @param bool  $override Whether an override has been applied or not.
		 * @param array $args An array of args from the filter.
		 * @return bool
		 */
		function process_render_module_dat_file( $override, $args = array() ) {

			if ( $override ) {
				return $override;
			}

			// Is already processed then return defaults.
			if ( true === $this->is_processed ) {
				return $override;
			}

			// Set module processed flag.
			$this->is_processed = true;

			if ( ! $args['template_post_id'] && $args['template'] ) {

				// Not brainstorm user in dat file then return default.
				if ( isset( $args['template']->author ) && 'brainstormforce' !== $args['template']->author ) {
					return $override;
				}

				// Only move forward if we have template nodes.
				if ( isset( $args['template']->nodes ) ) {

					// Download all images from the data.
					$template = new StdClass();

					$template->nodes = UABB_Importer_Beaver_Builder::get_instance()->get_import_data( $args['template']->nodes );

					$template->settings = $args['template']->settings;
					$template->type     = 'row';
					$template->global   = false;

					return FLBuilderModel::apply_node_template( $args['template_id'], $args['parent_id'], $args['position'], $template );
				}
			}

			return $override;
		}

		/**
		 * Applies a user defined template instead of a core template.
		 * Called from the fl_builder_override_apply_template filter.
		 *
		 * @since 1.20.2
		 *
		 * @param bool  $override Whether an override has been applied or not.
		 * @param array $args An array of args from the filter.
		 * @return bool
		 */
		function process_render_template_dat_file( $override, $args = array() ) {

			if ( $override ) {
				return $override;
			}

			$template = FLBuilderModel::get_template( $args['index'], $args['type'] );

			// Not brainstorm user in dat file then return default.
			if ( isset( $template->author ) && 'brainstormforce' !== $template->author ) {
				return $override;
			}

			// Only move forward if we have template nodes.
			if ( isset( $template->nodes ) ) {

				// Download all images from the data.
				$template->nodes = UABB_Importer_Beaver_Builder::get_instance()->get_import_data( $template->nodes );

				return FLBuilderModel::apply_user_template( $template, $args['append'] );

			}

			return $override;
		}
		/**
		 * Check the Domains.
		 *
		 * @since 1.20.2
		 * @param bool  $default returns default.
		 * @param array $attachment An array of Image.
		 * @return bool
		 */
		function included_domains( $default, $attachment ) {

			$included_domains = array(
				'sharkz.in',
				'brainstormforce',
				'templates.ultimatebeaver.com',
				'downloads.brainstormforce.com',
				'uabbtemplates2.sharkz.in',
				'uabb.sharkz.in',
			);

			foreach ( $included_domains as $key => $domain ) {
				if ( false !== strpos( $attachment['url'], $domain ) ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * Added .svg files as supported format in the uploader.
		 *
		 * @since 1.20.2
		 *
		 * @param array $mimes Already supported mime types.
		 */
		public function custom_upload_mimes( $mimes ) {

			// Allow SVG files.
			$mimes['svg']  = 'image/svg+xml';
			$mimes['svgz'] = 'image/svg+xml';

			// Allow XML files.
			$mimes['xml'] = 'text/xml';

			return $mimes;
		}

		/**
		 * Add SVG image support
		 *
		 * @since 1.20.2
		 *
		 * @param array  $response    Attachment response.
		 * @param object $attachment Attachment object.
		 * @param array  $meta        Attachment meta data.
		 */
		function add_svg_image_support( $response, $attachment, $meta ) {
			if ( ! function_exists( 'simplexml_load_file' ) ) {
				return $response;
			}

			if ( ! empty( $response['sizes'] ) ) {
				return $response;
			}

			if ( 'image/svg+xml' !== $response['mime'] ) {
				return $response;
			}

			$svg_path = get_attached_file( $attachment->ID );

			$dimensions = self::get_svg_dimensions( $svg_path );

			$response['sizes'] = array(
				'full' => array(
					'url'         => $response['url'],
					'width'       => $dimensions->width,
					'height'      => $dimensions->height,
					'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait',
				),
			);

			return $response;
		}

		/**
		 * Get SVG Dimensions
		 *
		 * @since 1.20.2
		 *
		 * @param  string $svg SVG file path.
		 * @return array      Return SVG file height & width for valid SVG file.
		 */
		public static function get_svg_dimensions( $svg ) {

			$svg = simplexml_load_file( $svg );

			if ( false === $svg ) {
				$width  = '0';
				$height = '0';
			} else {
				$attributes = $svg->attributes();
				$width      = (string) $attributes->width;
				$height     = (string) $attributes->height;
			}

			return (object) array(
				'width'  => $width,
				'height' => $height,
			);
		}

		/**
		 * Batch Process Complete.
		 *
		 * @return void
		 */
		public function complete_batch_import() {

			error_log( 'Complete' );

			update_option( 'uabb_batch_process_complete', true );

			update_option( 'batch_complete_time_date', date( 'Y-m-d H:i:s' ) );

			$faild_links = get_option( 'uabb_batch_processing_faild_posts_id', false );

			if ( ! empty( $faild_links ) ) {
				set_transient( 'uabb_display_retry_notice', 'uabb_batch_process_complete', DAY_IN_SECONDS );
			}
			// Clear all cache.
			FLBuilderModel::delete_asset_cache_for_all_posts();

			error_log( '(✓) BATCH Process Complete!' );
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method.
	 */
	UABB_Batch_Process::get_instance();

endif;
