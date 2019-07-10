<?php

class CbbRTPSplashModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'RTP Splash', 'fl-builder' ),
			'description'     => __( 'A scroll-interactive splash screen', 'fl-builder' ),
			'icon'            => 'tide.svg',
			'category'        => __( 'Extra Additions', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-rtp-splash/',
			'url'             => CBB_MODULES_DIR . 'modules/cbb-rtp-splash/'
		));

		// Include custom CSS
		$this->add_css('cbb-rtp-splash', CBB_MODULES_DIR . '/dist/styles/cbb-rtp-splash/css');
	}

	/**
	 * Function to get the icon for the RTP Splash module
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'cbb-rtp-splash/icon/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'cbb-rtp-splash/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

}

?>
