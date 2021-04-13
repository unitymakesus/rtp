<?php

class CbbCustomPostsModules extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Custom Posts', 'fl-builder' ),
			'description'     => __( 'A module that pulls in posts, customizable to various content types.', 'fl-builder' ),
			'icon'            => 'format-aside.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-custom-posts/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-custom-posts/'
		));

		// Include custom CSS
		$this->add_css('cbb-custom-posts', CBB_MODULES_URL . 'dist/styles/cbb-custom-posts.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'modules/cbb-custom-posts/images/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'modules/cbb-custom-posts/images/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

}

?>
