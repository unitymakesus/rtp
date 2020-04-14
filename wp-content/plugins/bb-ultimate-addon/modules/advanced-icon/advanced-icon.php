<?php
/**
 *  UABB Advanced Icon Module file
 *
 *  @package UABB Advanced Icon Module
 */

/**
 * Function that initializes UABB Advanced Icon Module
 *
 * @class UABBAdvancedIconModule
 */
class UABBAdvancedIconModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Icon module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Advanced Icons', 'uabb' ),
				'description'     => __( 'Display a group of Image / Icons.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/advanced-icon/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'star-filled.svg',
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

		$version_bb_check        = UABB_Compatibility::$version_bb_check;
		$page_migrated           = UABB_Compatibility::$uabb_migration;
		$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {
			// Handling each icon's list.
			foreach ( $settings->icons as $icon ) {

				if ( isset( $icon->link_nofollow ) ) {
					if ( '1' === $icon->link_nofollow || 'yes' === $icon->link_nofollow ) {
						$icon->link_nofollow = 'yes';
					}
				}
				$helper->handle_opacity_inputs( $icon, 'bg_hover_color_opc', 'bg_hover_color' );
				$helper->handle_opacity_inputs( $icon, 'bg_color_opc', 'bg_color' );
			}
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );

			// Handle opacity fields.
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Handling each icon's list.
			foreach ( $settings->icons as $icon ) {

				if ( isset( $icon->link_nofollow ) ) {
					if ( '1' === $icon->link_nofollow || 'yes' === $icon->link_nofollow ) {
						$icon->link_nofollow = 'yes';
					}
				}
				$helper->handle_opacity_inputs( $icon, 'bg_hover_color_opc', 'bg_hover_color' );
				$helper->handle_opacity_inputs( $icon, 'bg_color_opc', 'bg_color' );
			}
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			// Handle opacity fields.
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */
if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/advanced-icon-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/advanced-icon/advanced-icon-bb-less-than-2-2-compatibility.php';
}
