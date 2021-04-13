<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Integrations;

use DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item;
use Exception;
use \WC_Product;

class Woocommerce extends Integration {

	/**
	 * Keep track of URLs that we already transformed to remote URLs
	 * when product object was re-hydrated
	 *
	 * @var array
	 */
	private $re_hydrated_urls = array();

	/**
	 * Is installed?
	 *
	 * @return bool
	 */
	public static function is_installed() {
		if ( class_exists( 'WooCommerce' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Init integration.
	 */
	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'woocommerce_process_product_file_download_paths', array( $this, 'make_files_private_on_provider' ), 10, 3 );
		add_filter( 'woocommerce_file_download_path', array( $this, 'woocommerce_file_download_path' ), 20, 1 );
		add_action( 'woocommerce_admin_process_product_object', array( $this, 'woocommerce_admin_process_product_object' ), 10, 1 );
		add_action( 'woocommerce_admin_process_variation_object', array( $this, 'woocommerce_admin_process_product_object' ), 10, 1 );
		add_action( 'woocommerce_download_file_as3cf', array( $this, 'download_file' ), 10, 2 );
		add_filter( 'woocommerce_file_download_method', array( $this, 'add_download_method' ) );
	}

	/**
	 * Enqueue scripts
	 *
	 * @return void
	 */
	public function admin_scripts() {
		$screen = get_current_screen();

		if ( in_array( $screen->id, array( 'product', 'edit-product' ) ) ) {
			if ( ! $this->as3cf->is_pro_plugin_setup( true ) ) {
				// Don't allow new shortcodes if Pro not set up
				return;
			}

			wp_enqueue_media();
			$this->as3cf->enqueue_script( 'as3cf-woo-script', 'assets/js/pro/integrations/woocommerce', array(
				'jquery',
				'wp-util',
			) );

			wp_localize_script( 'as3cf-woo-script', 'as3cf_woo', array(
				'strings' => array(
					'media_modal_title'  => __( 'Select Downloadable File', 'as3cf-woocommerce' ),
					'media_modal_button' => __( 'Insert File', 'as3cf-woocommerce' ),
					'input_placeholder'  => __( 'Retrieving...', 'as3cf-woocommerce' ),
				),
				'nonces'  => array(
					'is_amazon_provider_attachment' => wp_create_nonce( 'as3cf_woo_is_amazon_provider_attachment' ),
				),
			) );
		}
	}

	/**
	 * Make file private on Amazon S3.
	 *
	 * @param int   $post_id
	 * @param int   $variation_id
	 * @param array $files
	 *
	 * @return array
	 */
	public function make_files_private_on_provider( $post_id, $variation_id, $files ) {
		$new_attachments = array();
		$size            = null;
		$post_id         = $variation_id > 0 ? $variation_id : $post_id;

		foreach ( $files as $file ) {
			$attachment_id = (int) $this->as3cf->filter_local->get_attachment_id_from_url( $file['file'] );
			if ( ! $attachment_id ) {
				// Attachment id could not be determined, ignore
				continue;
			}

			$size              = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $file['file'] );
			$new_attachments[] = $attachment_id . '-' . $size;

			$as3cf_item = Media_Library_Item::get_by_source_id( $attachment_id );

			if ( ! $as3cf_item ) {
				// Not offloaded, ignore.
				continue;
			}

			if ( $this->as3cf->is_pro_plugin_setup( true ) ) {
				// Only set new files as private if the Pro plugin is setup
				$as3cf_item = $this->as3cf->set_attachment_acl_on_provider( $attachment_id, $as3cf_item, true, $size );
				if ( $as3cf_item && ! is_wp_error( $as3cf_item ) ) {
					$this->as3cf->make_acl_admin_notice( $as3cf_item, $size );
				}
			}
		}

		$this->maybe_make_removed_files_public( $post_id, $new_attachments );

		return $files;
	}

	/**
	 * Maybe rewrite WooCommerce product file value to provider URL.
	 *
	 * @handles woocommerce_file_download_path
	 *
	 * @param string $file
	 *
	 * @return string
	 */
	public function woocommerce_file_download_path( $file ) {
		$size       = null;
		$remote_url = false;

		// Is it a local URL  ?
		$attachment_id = (int) $this->as3cf->filter_local->get_attachment_id_from_url( $file );
		if ( $attachment_id > 0 ) {
			$size       = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $file );
			$remote_url = $this->as3cf->get_attachment_url( $attachment_id, null, $size );
		}

		// Is it our shortcode ?
		$atts = $this->get_shortcode_atts( $file );
		if ( isset( $atts['id'] ) ) {
			$attachment_id = (int) $this->get_attachment_id_from_shortcode( $file );
			if ( $attachment_id > 0 ) {
				$remote_url = $this->as3cf->get_attachment_url( $attachment_id );
			}
		}

		if ( false !== $remote_url ) {
			$this->re_hydrated_urls[ $remote_url ] = array(
				'id'   => $attachment_id,
				'size' => $size,
			);

			return $remote_url;
		}

		return $file;
	}

	/**
	 * Maybe rewrite WooCommerce product file URLs to local URLs.
	 *
	 * @handles woocommerce_admin_process_product_object
	 * @handles woocommerce_admin_process_variation_object
	 *
	 * @param WC_Product $product
	 */
	public function woocommerce_admin_process_product_object( $product ) {
		$downloads = $product->get_downloads();
		foreach ( $downloads as $download ) {
			$url = $download->get_file();

			// Is this a shortcode ?
			$attachment_id = (int) $this->get_attachment_id_from_shortcode( $url );
			// If not, is it a remote URL?
			if ( ! $attachment_id ) {
				$attachment_id = (int) $this->as3cf->filter_provider->get_attachment_id_from_url( $url );
			}

			if ( $attachment_id > 0 ) {
				$size = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $url );
				$url  = $this->as3cf->get_attachment_local_url_size( $attachment_id, $size );
				$download->set_file( $url );
			}
		}
	}

	/**
	 * Get attachment id from shortcode.
	 *
	 * @param string $shortcode
	 *
	 * @return int|bool
	 */
	public function get_attachment_id_from_shortcode( $shortcode ) {
		$atts = $this->get_shortcode_atts( $shortcode );

		if ( isset( $atts['id'] ) ) {
			return intval( $atts['id'] );
		}

		if ( ! isset( $atts['bucket'] ) || ! isset( $atts['object'] ) ) {
			return false;
		}

		return Media_Library_Item::get_source_id_by_bucket_and_path( $atts['bucket'], $atts['object'] );
	}

	/**
	 * Get shortcode atts.
	 *
	 * @param string $shortcode
	 *
	 * @return array
	 */
	public function get_shortcode_atts( $shortcode ) {
		$shortcode = trim( stripcslashes( $shortcode ) );
		$shortcode = ltrim( $shortcode, '[' );
		$shortcode = rtrim( $shortcode, ']' );
		$shortcode = shortcode_parse_atts( $shortcode );

		return $shortcode;
	}

	/**
	 * Remove private ACL from S3 if no longer used by WooCommerce.
	 *
	 * @param int   $post_id
	 * @param array $new_attachments List of attachments. Attachment id AND size on the format "$id-$size"
	 *
	 * @return void
	 */
	protected function maybe_make_removed_files_public( $post_id, $new_attachments ) {
		$old_files       = get_post_meta( $post_id, '_downloadable_files', true );
		$old_attachments = array();
		$size            = null;

		if ( is_array( $old_files ) ) {
			foreach ( $old_files as $old_file ) {
				$attachment_id = (int) $this->as3cf->filter_local->get_attachment_id_from_url( $old_file['file'] );
				if ( $attachment_id > 0 ) {
					$size = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $old_file['file'] );

					$old_attachments[] = $attachment_id . '-' . $size;
				}
			}
		}

		$removed_attachments = array_diff( $old_attachments, $new_attachments );

		if ( empty( $removed_attachments ) ) {
			return;
		}

		global $wpdb;

		foreach ( $removed_attachments as $attachment ) {
			$parts         = explode( '-', $attachment );
			$attachment_id = (int) $parts[0];
			$size          = empty( $parts[1] ) ? null : $parts[1];
			$as3cf_item    = Media_Library_Item::get_by_source_id( $attachment_id );

			if ( ! $as3cf_item ) {
				// Not offloaded, ignore.
				continue;
			}

			$local_url = \AS3CF_Utils::reduce_url( strval( $this->as3cf->get_attachment_local_url_size( $attachment_id, $size ) ) );

			$file   = \AS3CF_Utils::is_full_size( $size ) ? null : wp_basename( $as3cf_item->path( $size ) );
			$bucket = preg_quote( $as3cf_item->bucket(), '@' );
			$key    = preg_quote( $as3cf_item->key( $file ), '@' );
			$url    = preg_quote( $local_url, '@' );

			// Check the attachment isn't used by other downloads
			$sql = $wpdb->prepare( "
				SELECT meta_value
				FROM $wpdb->postmeta
				WHERE post_id != %d
				AND meta_key = %s
				AND (meta_value LIKE %s OR meta_value like %s)
			", $post_id, '_downloadable_files', '%amazon_s3%', '%' . $local_url . '%' );

			$results = $wpdb->get_results( $sql, ARRAY_A );

			foreach ( $results as $result ) {
				// WP Offload Media
				if ( preg_match( '@\[amazon_s3\sid=[\'\"]*' . $attachment_id . '[\'\"]*\]@', $result['meta_value'] ) ) {
					continue 2;
				}

				// Official WooCommerce S3 addon
				if ( preg_match( '@\[amazon_s3\sobject=[\'\"]*' . $key . '[\'\"]*\sbucket=[\'\"]*' . $bucket . '[\'\"]*\]@', $result['meta_value'] ) ) {
					continue 2;
				}
				if ( preg_match( '@\[amazon_s3\sbucket=[\'\"]*' . $bucket . '[\'\"]*\sobject=[\'\"]*' . $key . '[\'\"]*\]@', $result['meta_value'] ) ) {
					continue 2;
				}

				if ( preg_match( '@' . $url . '@', $result['meta_value'] ) ) {
					continue 2;
				}
			}

			// Set ACL to public
			$as3cf_item = $this->as3cf->set_attachment_acl_on_provider( $attachment_id, $as3cf_item, false, $size );

			if ( $as3cf_item && ! is_wp_error( $as3cf_item ) ) {
				$this->as3cf->make_acl_admin_notice( $as3cf_item, $size );
			}
		}
	}

	/**
	 * Add download method to WooCommerce.
	 *
	 * @return string
	 */
	public function add_download_method() {
		return 'as3cf';
	}

	/**
	 * Use S3 secure link to download file.
	 *
	 * @param string $file_path
	 * @param int    $filename
	 *
	 * @return void
	 */
	public function download_file( $file_path, $filename ) {
		$size          = null;
		$attachment_id = 0;

		/*
		 * Is this a remote URL that we already handled when the product object
		 * was re-hydrated?
		 */
		if ( isset( $this->re_hydrated_urls[ $file_path ] ) ) {
			$attachment_id = $this->re_hydrated_urls[ $file_path ]['id'];
			$size          = $this->re_hydrated_urls[ $file_path ]['size'];
		}

		/*
		 * Is this a shortcode that resolves to an attachment?
		 */
		if ( ! $attachment_id ) {
			$attachment_id = (int) $this->get_attachment_id_from_shortcode( $file_path );
		}

		/*
		 * If no attachment was found via shortcode, it's possible that
		 * $file_path is a URL to the local version of an offloaded item
		 */
		if ( ! $attachment_id ) {
			$attachment_id = (int) $this->as3cf->filter_local->get_attachment_id_from_url( $file_path );
			if ( $attachment_id > 0 ) {
				$size = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $file_path );
			}
		}

		$expires = apply_filters( 'as3cf_woocommerce_download_expires', 5 );

		$file_data = array(
			'name' => $filename,
			'file' => $file_path,
		);

		if ( ! $attachment_id || ! Media_Library_Item::get_by_source_id( $attachment_id ) ) {
			/*
			This addon is meant to be a drop-in replacement for the
			WooCommerce Amazon S3 Storage extension. The latter doesn't encourage people
			to add the file to the Media Library, so even though we can't get an
			attachment ID for the shortcode, we should still serve the download
			if the shortcode contains the `bucket` and `object` attributes.
			*/
			$atts = $this->get_shortcode_atts( $file_path );

			if ( isset( $atts['bucket'] ) && isset( $atts['object'] ) ) {
				$bucket_setting = $this->as3cf->get_setting( 'bucket' );

				if ( $bucket_setting === $atts['bucket'] ) {
					$region = $this->as3cf->get_setting( 'region' );
				} else {
					$region = $this->as3cf->get_bucket_region( $atts['bucket'], true );
				}

				try {
					$expires    = time() + $expires;
					$headers    = apply_filters( 'as3cf_woocommerce_download_headers', array( 'ResponseContentDisposition' => 'attachment' ), $file_data );
					$secure_url = $this->as3cf->get_provider_client( $region, true )->get_object_url( $atts['bucket'], $atts['object'], $expires, $headers );
				} catch ( Exception $e ) {
					return;
				}

				add_filter( 'wp_die_handler', array( $this, 'set_wp_die_handler' ) );
				header( 'Location: ' . $secure_url );
				wp_die();
			}

			// Handle shortcode inputs where the file has been removed from S3
			// Parse the url, shortcodes do not return a host
			$url = parse_url( $file_path );

			if ( ! isset( $url['host'] ) ) {
				$file_path = wp_get_attachment_url( $attachment_id );
				$filename  = wp_basename( $file_path );
			}

			// File not on S3, trigger WooCommerce saved download method
			$method = get_option( 'woocommerce_file_download_method', 'force' );
			do_action( 'woocommerce_download_file_' . $method, $file_path, $filename );

			return;
		}

		$file_data['attachment_id'] = $attachment_id;
		$headers                    = apply_filters( 'as3cf_woocommerce_download_headers', array( 'ResponseContentDisposition' => 'attachment' ), $file_data );
		$secure_url                 = $this->as3cf->get_secure_attachment_url( $attachment_id, $expires, $size, $headers, true );

		add_filter( 'wp_die_handler', array( $this, 'set_wp_die_handler' ) );
		header( 'Location: ' . $secure_url );
		wp_die();
	}

	/**
	 * Filter handler for set_wp_die_handler.
	 *
	 * @param $handler
	 *
	 * @return array
	 */
	public function set_wp_die_handler( $handler ) {
		return array( $this, 'woocommerce_die_handler' );
	}

	/**
	 * Replacement for the default wp_die() handler
	 */
	public function woocommerce_die_handler() {
		exit;
	}
}
