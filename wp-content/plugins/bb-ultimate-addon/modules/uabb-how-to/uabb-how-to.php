<?php
/**
 *  UABB How To Module file
 *
 *  @package UABB How To Module
 */

/**
 * Function that initializes UABB How To Module
 *
 * @class UABBHowTo
 */
class UABBHowTo extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the How To module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'How-to Schema', 'uabb' ),
				'description'     => __( 'How-to Schema', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-how-to/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-how-to/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'how-to.svg',
			)
		);

	}

	/**
	 * Function to get the icon for the How to Module.
	 *
	 * @since 1.24.0
	 * @method get_icon
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-how-to/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-how-to/icon/' . $icon );
		}
		return '';
	}
}

$style  = 'line-height: 2.45em; color: #a94442; background:#e4e7ea;';
$notice = sprintf( /* translators: %1$s: search term */
		__( '<span class="uabb-settings-notice" style="%1$s">Note: We recommend you to fill all the fields else it may generate Schema errors / warnings for your page.</span>', 'uabb' ),
	$style
);


/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-how-to/uabb-how-to-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-how-to/uabb-how-to-bb-less-than-2-2-compatibility.php';
}
