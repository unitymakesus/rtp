<?php
/**
 * Intializes row settings' file
 *
 * @package Row settings
 */

/**
 * Function that registers necessary row's settings file
 *
 * @since 1.4.6
 */
function uabb_row_settings_init() {

	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-settings.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-css.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-js.php';

	uabb_row_register_settings();
	uabb_row_render_css();
	uabb_row_render_js();
}

$module  = UABB_Init::$uabb_options['fl_builder_uabb'];
$rowgrad = isset( $module['uabb-row-gradient'] ) ? $module['uabb-row-gradient'] : true;
if ( $rowgrad ) {
	uabb_row_settings_init();
}
