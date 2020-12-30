<?php
/**
 *  UABB Social Share Module file
 *
 *  @package UABB Social Share Module
 */

/**
 * Function that initializes UABB Social Share Module
 *
 * @class UABBSocialShare
 */
class UABBSocialShare extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Social Share module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Social Share', 'uabb' ),
				'description'     => __( 'Social Share', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$extra_additions ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-social-share/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-social-share/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'share-alt2.svg',
			)
		);
		$this->add_css( 'font-awesome-5' );

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

		$version_bb_check        = UABB_Compatibility::$version_bb_check;
		$page_migrated           = UABB_Compatibility::$uabb_migration;
		$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {

			// Handle opacity backward compatibility.
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->align ) ) {
				$settings->align = $settings->align;
			}
			if ( isset( $settings->responsive_align ) ) {
				$settings->responsive_align = $settings->responsive_align;
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Handle opacity backward compatibility.
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->align ) ) {
				$settings->align = $settings->align;
			}
			if ( isset( $settings->responsive_align ) ) {
				$settings->responsive_align = $settings->responsive_align;
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-social-share/uabb-social-share-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-social-share/uabb-social-share-bb-less-than-2-2-compatibility.php';
}
