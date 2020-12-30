<?php
/**
 *  UABB WP Forms Styler Module file
 *
 *  @package UABB WP Forms Styler Module
 */

/**
 * Function that initializes UABB WP Forms Styler Module
 *
 * @class UABBWpFormStylerModule
 */
class UABBWpFormStylerModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the WP Form Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'WPForms Styler ', 'uabb' ),
				'description'     => __( 'Style your WP Form', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-wp-forms-styler/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-wp-forms-styler/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);
	}


}

require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-wp-forms-styler/includes/wp-form-function.php';

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-wp-forms-styler/uabb-wp-forms-styler-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-wp-forms-styler/uabb-wp-forms-styler-bb-less-than-2-2-compatibility.php';
}
