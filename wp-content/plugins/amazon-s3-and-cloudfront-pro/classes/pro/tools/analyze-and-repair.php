<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Tools;

use DeliciousBrains\WP_Offload_Media\Pro\Background_Tool;

abstract class Analyze_And_Repair extends Background_Tool {

	/**
	 * @var string
	 */
	protected $tool_key = 'analyze_and_repair';

	/**
	 * Initialize the tool.
	 */
	public function init() {
		parent::init();

		if ( ! $this->as3cf->is_pro_plugin_setup() ) {
			return;
		}

		add_action( 'as3cfpro_load_assets', array( $this, 'load_assets' ) );
	}

	/**
	 * Get the details for the sidebar block
	 *
	 * @return array|bool
	 */
	protected function get_sidebar_block_args() {
		if ( ! $this->as3cf->is_pro_plugin_setup() ) {
			return false;
		}

		return parent::get_sidebar_block_args();
	}

	/**
	 * Load assets.
	 */
	public function load_assets() {
		parent::load_assets();

		$this->as3cf->enqueue_script( "as3cf-pro-analyze-and-repair-script", "assets/js/pro/tools/analyze-and-repair", array(
			'jquery',
			'wp-util',
		) );
	}

	/**
	 * Should render.
	 *
	 * @return bool
	 */
	public function should_render() {
		if ( false !== static::show_tool_constant() && constant( static::show_tool_constant() ) ) {
			return true;
		}

		return $this->is_queued() || $this->is_processing() || $this->is_paused() || $this->is_cancelled();
	}

	/**
	 * Get title text.
	 *
	 * @return string
	 */
	public function get_title_text() {
		return __( 'Analyze &amp; Repair', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Get button text.
	 *
	 * @return string
	 */
	public function get_button_text() {
		return __( 'Analyze &amp; Repair', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Get queued status text.
	 *
	 * @return string
	 */
	public function get_queued_status() {
		return __( 'Analyzing and repairing offload metadata.', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Message for error notice
	 *
	 * @param null $message Optional message to override the default for the tool.
	 *
	 * @return string
	 */
	protected function get_error_notice_message( $message = null ) {
		$title   = __( 'Analyze &amp; Repair Errors', 'amazon-s3-and-cloudfront' );
		$message = empty( $message ) ? __( 'Previous attempts at analyzing and repairing your offload metadata have resulted in errors.', 'amazon-s3-and-cloudfront' ) : $message;

		return sprintf( '<strong>%s</strong> &mdash; %s', $title, $message );
	}
}