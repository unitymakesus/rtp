<?php
/**
 *  UABB Separator Module file
 *
 *  @package UABB Separator Module
 */

/**
 * Function that initializes UABB Separator Module
 *
 * @class UABBSeparatorModule
 */
class UABBSeparatorModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Separator module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Simple Separator', 'uabb' ),
				'description'     => __( 'A divider line to separate content.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-separator/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'minus.svg',
			)
		);
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->alignment ) ) {
				$settings->alignment = $settings->alignment;
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->alignment ) ) {
				$settings->alignment = $settings->alignment;
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/uabb-separator-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-separator/uabb-separator-bb-less-than-2-2-compatibility.php';
}
