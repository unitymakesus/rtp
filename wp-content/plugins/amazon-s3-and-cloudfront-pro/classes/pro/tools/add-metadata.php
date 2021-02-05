<?php

namespace DeliciousBrains\WP_Offload_Media\Pro\Tools;

use DeliciousBrains\WP_Offload_Media\Pro\Background_Processes\Background_Tool_Process;
use DeliciousBrains\WP_Offload_Media\Pro\Background_Processes\Add_Metadata_Process;
use DeliciousBrains\WP_Offload_Media\Pro\Background_Tool;
use DeliciousBrains\WP_Offload_Media\Pro\Tools\Analyze_And_Repair\Reverse_Add_Metadata;
use DeliciousBrains\WP_Offload_Media\Pro\Tools\Analyze_And_Repair\Verify_Add_Metadata;

class Add_Metadata extends Background_Tool {

	/**
	 * @var string
	 */
	protected $tool_key = 'add_metadata';

	/**
	 * @var array
	 */
	protected static $show_tool_constants = array(
		'AS3CF_SHOW_ADD_METADATA_TOOL',
	);

	/**
	 * Initialize Add_Metadata
	 */
	public function init() {
		parent::init();

		if ( ! $this->as3cf->is_pro_plugin_setup( true ) ) {
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
		if ( ! $this->as3cf->is_pro_plugin_setup( true ) ) {
			return false;
		}

		$last_started = get_site_option( $this->prefix . '_' . $this->get_tool_key() . '_last_started' );

		if ( empty( $last_started ) ) {
			return parent::get_sidebar_block_args();
		}

		$footer_content = '<p>';
		$footer_content .= '<a href="#" class="start" data-tool-override="reverse_add_metadata" title="' . Reverse_Add_Metadata::get_more_info_text() . '">Remove all metadata added by this tool</a>';
		$footer_content .= '<br><br>';
		$footer_content .= '<a href="#" class="start" data-tool-override="verify_add_metadata" title="' . Verify_Add_Metadata::get_more_info_text() . '">Find items with files missing in bucket and remove metadata, mark others verified</a>';
		$footer_content .= '</p>';

		$args = array(
			'footer_content' => htmlspecialchars( $footer_content ),
		);

		return array_merge( parent::get_sidebar_block_args(), $args );
	}

	/**
	 * Handle start.
	 */
	public function handle_start() {
		update_site_option( $this->prefix . '_' . $this->get_tool_key() . '_last_started', time() );

		parent::handle_start();
	}

	/**
	 * Load assets.
	 */
	public function load_assets() {
		parent::load_assets();

		$this->as3cf->enqueue_script( 'as3cf-pro-add-metadata-script', 'assets/js/pro/tools/add-metadata', array(
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
		return __( 'Add metadata for all media not offloaded', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Get more info text.
	 *
	 * @return string
	 */
	public static function get_more_info_text() {
		return htmlspecialchars( __( "If you already have your site's media in a bucket in the cloud, you can configure WP Offload Media for this bucket and storage paths, then run this tool to go through all your media that hasn't been offloaded yet and add the metadata WP Offload Media needs to manage your media in that bucket and rewrite URLs. After this tool runs, it will give you an undo option (remove all metadata added by this tool) and an option to go through all the media items that we added metadata for, check that the files exist in the bucket, and remove any new metadata where files are missing.", 'amazon-s3-and-cloudfront' ), ENT_QUOTES );
	}

	/**
	 * Get button text.
	 *
	 * @return string
	 */
	public function get_button_text() {
		return __( 'Add Metadata', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Get queued status text.
	 *
	 * @return string
	 */
	public function get_queued_status() {
		return __( 'Adding metadata to Media Library', 'amazon-s3-and-cloudfront' );
	}

	/**
	 * Message for error notice
	 *
	 * @param null $message Optional message to override the default for the tool.
	 *
	 * @return string
	 */
	protected function get_error_notice_message( $message = null ) {
		$title   = __( 'Add Metadata Errors', 'amazon-s3-and-cloudfront' );
		$message = empty( $message ) ? __( 'Previous attempts at adding metadata to your media library have resulted in errors.', 'amazon-s3-and-cloudfront' ) : $message;

		return sprintf( '<strong>%s</strong> &mdash; %s', $title, $message );
	}

	/**
	 * Get background process class.
	 *
	 * @return Background_Tool_Process|null
	 */
	protected function get_background_process_class() {
		return new Add_Metadata_Process( $this->as3cf, $this );
	}
}