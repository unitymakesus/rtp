<?php

class CbbFigureCardModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Card', 'fl-builder' ),
			'description'     => __( 'A card module that includes a badge and optional CTA', 'fl-builder' ),
			'icon'            => 'tide.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-figure-card/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-figure-card/'
		));

		// Include custom CSS
		$this->add_css('cbb-figure-card', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
	}

	/**
	 * Function to get the icon for the RTP Splash module
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'cbb-figure-card/images/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'cbb-figure-card/images/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

}

?>
