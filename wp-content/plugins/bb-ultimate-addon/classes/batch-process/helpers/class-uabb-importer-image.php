<?php
/**
 * UABB Batch Process
 *
 * @package UABB
 * @since 1.20.2
 */

if ( ! class_exists( 'UABB_Import_Image' ) ) :

	/**
	 * UABB Importer.
	 *
	 * @since 1.20.2
	 */
	class UABB_Import_Image {

		/**
		 * Instance
		 *
		 * @since 1.20.2
		 * @var object Class object.
		 * @access private
		 */
		private static $instance;

		/**
		 * Images IDs
		 *
		 * @var array   The Array of already image IDs.
		 * @since 1.20.2
		 */
		private $already_imported_ids = array();

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

			if ( ! function_exists( 'WP_Filesystem' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			WP_Filesystem();
		}

		/**
		 * Process Image Download
		 *
		 * @since 1.20.2
		 * @param  array $attachments Attachment array.
		 * @return array              Attachment array.
		 */
		public function process( $attachments ) {

			$downloaded_images = array();

			foreach ( $attachments as $key => $attachment ) {
				$downloaded_images[] = $this->import( $attachment );
			}

			return $downloaded_images;
		}

		/**
		 * Get Hash Image.
		 *
		 * @since 1.20.2
		 * @param  string $attachment_url Attachment URL.
		 * @return string                 Hash string.
		 */
		private function get_hash_image( $attachment_url ) {
			return sha1( $attachment_url );
		}

		/**
		 * Get Saved Image.
		 *
		 * @since 1.20.2
		 * @param  string $attachment   Attachment Data.
		 * @return string                 Hash string.
		 */
		private function get_saved_image( $attachment ) {

			if ( apply_filters( 'uabb_image_importer_skip_image', false, $attachment ) ) {

				return $attachment;
			}

			global $wpdb;

			// Already imported? Then return!.
			if ( isset( $this->already_imported_ids[ $attachment['id'] ] ) ) {

				return $this->already_imported_ids[ $attachment['id'] ];
			}

			// 1. Is already imported in Batch Import Process?.
			$post_id = $wpdb->get_var(
				$wpdb->prepare(
					'SELECT `post_id` FROM `' . $wpdb->postmeta . '`
						WHERE `meta_key` = \'_uabb_image_hash\'
							AND `meta_value` = %s
					;',
					$this->get_hash_image( $attachment['url'] )
				)
			);
			// 2. Is image already imported though XML?.
			if ( empty( $post_id ) ) {
				// Get file name without extension.
				// To check it exist in attachment.
				$filename = basename( $attachment['url'] );

				$post_id = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT post_id FROM {$wpdb->postmeta}
							WHERE meta_key = '_wp_attached_file'
							AND meta_value LIKE %s
						",
						'%/' . $filename . '%' ) // @codingStandardsIgnoreLine.
				);
			}

			if ( $post_id ) {
				$new_attachment                                  = array(
					'id'  => $post_id,
					'url' => wp_get_attachment_url( $post_id ),
				);
				$this->already_imported_ids[ $attachment['id'] ] = $new_attachment;

				return $new_attachment;
			}

			return false;
		}

		/**
		 * Import Image
		 *
		 * @since 1.20.2
		 * @param  array $attachment Attachment array.
		 * @return array              Attachment array.
		 */
		public function import( $attachment ) {

			$saved_image = $this->get_saved_image( $attachment );

			if ( $saved_image ) {

				return $saved_image;
			}
			$response      = wp_safe_remote_get( $attachment['url'], array( 'timeout' => 300 ) );
			$response_code = wp_remote_retrieve_response_code( $response );
			$file_content  = wp_remote_retrieve_body( $response );

			if ( is_wp_error( $response ) ) {
				/* translators: %1$s is error message and %2$s is image URL */
				error_log( sprintf( __( 'Failed ! WP error - %1$s - %2$s', 'uabb' ), $response->get_error_message(), $attachment['url'] ) );

				return $attachment;

			} elseif ( 200 !== $response_code ) {
				/* translators: %1$s is  response code and %2$s is image URL */
				error_log( sprintf( __( 'Failed ! Invalid Response Code - %1$s ! Expected Response Code 200 - %2$s', 'uabb' ), $response_code, $attachment['url'] ) );

				return $attachment;

			} elseif ( empty( $file_content ) ) {

				/* translators: %1$s is image URL */
				error_log( sprintf( __( 'Failed ! Empty Image Content - %1$s', 'uabb' ), $attachment['url'] ) );

				return $attachment;
			}

			// Extract the file name and extension from the URL.
			$filename = basename( $attachment['url'] );

			$upload = wp_upload_bits(
				$filename,
				null,
				$file_content
			);

			$post = array(
				'post_title' => $filename,
				'guid'       => $upload['url'],
			);

			$info = wp_check_filetype( $upload['file'] );

			if ( $info ) {
				$post['post_mime_type'] = $info['type'];
			} else {
				// For now just return the origin attachment.
				return $attachment;
			}

			$post_id = wp_insert_attachment( $post, $upload['file'] );
			wp_update_attachment_metadata(
				$post_id,
				wp_generate_attachment_metadata( $post_id, $upload['file'] )
			);
			if ( array_key_exists( 'caption', $attachment ) ) {
				$image_meta = array(
					'ID'           => $post_id,
					'post_excerpt' => $attachment['caption'],
				);
				// Update the post into the database.
				wp_update_post( $image_meta );
			}
			update_post_meta( $post_id, '_uabb_image_hash', $this->get_hash_image( $attachment['url'] ) );

			$new_attachment = array(
				'id'  => $post_id,
				'url' => $upload['url'],
			);

			$this->already_imported_ids[ $attachment['id'] ] = $new_attachment;

			return $new_attachment;
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method.
	 */
	UABB_Import_Image::get_instance();

endif;
