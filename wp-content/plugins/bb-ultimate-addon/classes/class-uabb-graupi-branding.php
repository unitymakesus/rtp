<?php
/**
 *  UABB Graupi Branding
 *
 *  UABB Graupi Branding File
 *
 *  @package Graupi Branding
 */

/**
 * This class initializes UABB Graupi Branding
 *
 * @class UABBGraupiBranding
 */
final class UABBGraupiBranding {

	/**
	 * Holds any category strings of modules.
	 *
	 * @since x.x.x
	 * @var $branding Branding
	 */
	public static $branding;
	/**
	 * Holds any category strings of modules.
	 *
	 * @since x.x.x
	 * @var $author_name author_name
	 */
	public static $author_name;
	/**
	 * Holds any category strings of modules.
	 *
	 * @since x.x.x
	 * @var $plugin_short_name plugin_short_name
	 */
	public static $plugin_short_name;
	/**
	 * Holds any category strings of modules.
	 *
	 * @since x.x.x
	 * @var $plugin_name plugin_name
	 */
	public static $plugin_name;
	/**
	 * Holds any category strings of modules.
	 *
	 * @since x.x.x
	 * @var $support_url support_url
	 */
	public static $support_url;

	/**
	 * Function that initializes files for Graupi
	 *
	 * @since x.x.x
	 */
	public static function init() {

		self::set_variables();
		if ( '' !== self::$author_name ) {
			add_filter( 'agency_updater_fullname', __CLASS__ . '::author_name' );
		}

		if ( '' !== self::$plugin_short_name ) {
			add_filter( 'agency_updater_shortname', __CLASS__ . '::plugin_short_name' );
		}

		if ( '' !== self::$plugin_name ) {
			add_filter( 'agency_updater_productname_uabb', __CLASS__ . '::plugin_name' );
		}

		if ( '' !== self::$support_url ) {
			add_filter( 'agency_updater_request_support', __CLASS__ . '::support_url' );
		}
	}

	/**
	 * Function that sets variables for GRAUPI branding
	 *
	 * @since x.x.x
	 */
	public static function set_variables() {
		self::$author_name       = '';
		self::$plugin_short_name = '';
		self::$plugin_name       = '';
		self::$support_url       = '';
		self::$branding          = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();

		if ( is_array( self::$branding ) ) {

			self::$author_name = ( array_key_exists( 'uabb-author-name', self::$branding ) ) ? self::$branding['uabb-author-name'] : '';
			self::$plugin_name = ( array_key_exists( 'uabb-plugin-name', self::$branding ) ) ? self::$branding['uabb-plugin-name'] : '';
			self::$support_url = ( array_key_exists( 'uabb-contact-support-url', self::$branding ) ) ? self::$branding['uabb-contact-support-url'] : '';

			if ( UABB_PREFIX !== 'UABB' ) {
				self::$plugin_short_name = UABB_PREFIX;
			}
		}
	}

	/**
	 * Replace : Brainstorm Force
	 */
	public static function author_name() {

		return self::$author_name;
	}

	/**
	 * Replace : Brainstorm
	 */
	public static function plugin_short_name() {

		return self::$plugin_short_name;
	}

	/**
	 * Replace : Ultimate addons for Beaver Builder
	 */
	public static function plugin_name() {

		return self::$plugin_name;
	}

	/**
	 * Replace : Support Url
	 */
	public static function support_url() {

		return self::$support_url;
	}
}

UABBGraupiBranding::init();
