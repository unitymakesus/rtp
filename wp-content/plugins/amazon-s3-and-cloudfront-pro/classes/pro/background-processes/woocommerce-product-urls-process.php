<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Background_Processes;

use DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item;
use DeliciousBrains\WP_Offload_Media\Pro\Integrations\Woocommerce;
use Exception;

class Woocommerce_Product_Urls_Process extends Background_Tool_Process {

	/**
	 * @var string
	 */
	protected $action = 'woocommerce_product_url';

	/**
	 * Process chunk of products
	 *
	 * @param array $attachments
	 * @param int   $blog_id
	 *
	 * @return array
	 *
	 * @throws \Exception
	 */
	protected function process_attachments_chunk( $attachments, $blog_id ) {
		foreach ( $attachments as $attachment_id ) {
			$this->handle_attachment( $attachment_id, $blog_id );
		}

		// We processed every item.
		return $attachments;
	}

	/**
	 * Process individual product or product variations by looking for downloadable
	 * files directly in the products meta data.
	 *
	 * @param int $product_id
	 * @param int $blog_id
	 *
	 * @return bool
	 * @throws \Exception
	 */
	protected function handle_attachment( $product_id, $blog_id ) {
		$woocommerce = new Woocommerce( $this->as3cf );

		// Get all the downloadable files for this post. Straight
		// from the DB to avoid filters
		$downloads = get_post_meta( $product_id, '_downloadable_files', true );

		// If we don't get an array, there's nothing we can do with
		// this product / variation
		if ( ! $downloads || ! is_array( $downloads ) ) {
			return true;
		}

		$updated = false;

		foreach ( $downloads as &$download ) {
			$stored_file   = $download['file'];
			$size          = null;
			$update_needed = false;

			// Is this our shortcode?
			$attachment_id = $woocommerce->get_attachment_id_from_shortcode( $stored_file );
			if ( $attachment_id ) {
				$atts          = $woocommerce->get_shortcode_atts( $stored_file );
				$update_needed = isset( $atts['id'] );
			}

			// Is this a local URL?
			if ( false === $attachment_id ) {
				$attachment_id = $this->as3cf->filter_local->get_attachment_id_from_url( $stored_file );
			}

			// Is it a remote URL we recognize?
			if ( false === $attachment_id ) {
				$attachment_id = $this->as3cf->filter_provider->get_attachment_id_from_url( $stored_file );
				$update_needed = true;
			}

			// If we can't identify an offloaded item we have to give up
			if ( false === $attachment_id ) {
				continue;
			}

			$as3cf_item = Media_Library_Item::get_by_source_id( $attachment_id );

			// We couldn't find an item for this $attachment_id
			if ( ! $as3cf_item ) {
				continue;
			}

			// Ensure that it's private on the provider
			$size   = $this->as3cf->filter_local->get_size_string_from_url( $attachment_id, $stored_file );
			$result = $this->as3cf->set_attachment_acl_on_provider( $attachment_id, $as3cf_item, true, $size );
			if ( is_wp_error( $result ) ) {
				$error_msg = sprintf( __( 'Error updating object ACL for media library item %s', 'amazon-s3-and-cloudfront' ), $attachment_id );
				$this->record_error( $blog_id, $attachment_id, $error_msg );
			}

			// If this is not a local URL already, we update:
			if ( $update_needed ) {
				$download['file'] = $this->as3cf->get_attachment_local_url_size( $attachment_id, $size );
				$updated          = true;
			}
		}

		if ( $updated ) {
			update_post_meta( $product_id, '_downloadable_files', $downloads );
		}

		return true;
	}

	/**
	 * Find all product and/or product variation IDs that have a _downloadable_files
	 * meta data item.
	 *
	 * @param int  $last_product_id
	 * @param int  $limit Maximum number of product IDs to return
	 * @param bool $count Just return the count, negates $limit, default false
	 *
	 * @return array|int
	 */
	protected function get_blog_attachments( $last_product_id, $limit, $count = false ) {
		global $wpdb;

		$args = array();

		if ( $count ) {
			$sql = 'SELECT COUNT(DISTINCT post_id)';
		} else {
			$sql = 'SELECT DISTINCT post_id';
		}

		$sql .= " FROM {$wpdb->postmeta} ";
		$sql .= " WHERE meta_key='_downloadable_files' ";

		if ( ! empty( $last_product_id ) ) {
			$sql    .= ' AND post_id < %d';
			$args[] = $last_product_id;
		}

		if ( ! $count ) {
			$sql    .= ' ORDER BY post_id DESC LIMIT %d';
			$args[] = $limit;
		}

		if ( count( $args ) > 0 ) {
			$sql = $wpdb->prepare( $sql, $args );
		}

		if ( $count ) {
			return $wpdb->get_var( $sql );
		} else {
			return array_map( 'intval', $wpdb->get_col( $sql ) );
		}
	}

	/**
	 * Called when background process has been cancelled.
	 */
	protected function cancelled() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has been paused.
	 */
	protected function paused() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has been resumed.
	 */
	protected function resumed() {
		// Do nothing at the moment.
	}

	/**
	 * Called when background process has completed.
	 */
	protected function completed() {
		// Do nothing at the moment.
	}

	/**
	 * Get complete notice message.
	 *
	 * @return string
	 */
	protected function get_complete_message() {
		return __( '<strong>WP Offload Media</strong> &mdash; Finished updating and verifying WooCommerce downloads.', 'amazon-s3-and-cloudfront' );
	}
}