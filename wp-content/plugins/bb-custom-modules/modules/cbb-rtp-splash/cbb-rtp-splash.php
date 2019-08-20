<?php

/*
	Create class for magic RTP home splash interactive scrolling wow
 */
class CbbRTPSplashModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'RTP Splash', 'fl-builder' ),
			'description'     => __( 'A scroll-interactive splash screen', 'fl-builder' ),
			'icon'            => 'splash.svg',
			'category'        => __( 'Extra Additions', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-rtp-splash/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-rtp-splash/'
		));

		// Include custom CSS and JS
		$this->add_css('cbb-hero-banner', CBB_MODULES_URL . 'dist/styles/cbb-hero-banner.css');
		$this->add_css('cbb-rtp-splash', CBB_MODULES_URL . 'dist/styles/cbb-rtp-splash.css');
		$this->add_js('cbb-rtp-splash', CBB_MODULES_URL . 'dist/scripts/cbb-rtp-splash.js');
	}

	/**
	 * Function to get the icon for the RTP Splash module
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'assets/icons/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'assets/icons/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

}

/*
	Register the module
 */
FLBuilder::register_module( 'CbbRTPSplashModule', [
	'cbb-rtp-splash-general' => [
		'title' => __( 'General', 'cbb' ),
		'description' => __('Landing Text: "Where People + Ideas Converge"<br />To change the landing text, please contact Unity at support@unitymakes.us.', 'cbb'),
		'sections' => [
			'cbb-rtp-splash-banner' => [
				'title' => __( 'Banner', 'cbb' ),
				'fields' => [
					'badge' => [
						'type' => 'select',
						'label' => __('Badge', 'cbb'),
						'default' => 'RTP',
						'options' => [
							'RTP' => 'RTP',
							'Hub' => 'Hub RTP',
							'Boxyard' => 'Boxyard RTP',
							'Frontier' => 'Frontier RTP',
							'STEM' => 'STEM RTP'
						]
					],
					'title' => [
						'type' => 'text',
						'label' => __('Banner Text', 'cbb'),
					],
				]
			],
			'cbb-rtp-splash-cta' => [
				'title' => __('Call To Action', 'cbb'),
				'fields' => [
					'cta_text' => [
						'type' => 'text',
						'label' => __('CTA Text', 'cbb'),
					],
					'cta_link' => [
						'type' => 'link',
						'label' => __('CTA Link', 'cbb'),
					],
				]
			],
			'cbb-rtp-splash-hero' => [
				'title' => __('Image', 'cbb'),
				'fields' => [
					'image' => [
						'type' => 'photo',
						'label' => __('Hero Image', 'cbb'),
					],
					'image_alt' => [
						'type' => 'text',
						'label' => __('Hero Image Alt Text', 'cbb'),
					]
				]
			]
		]
	]
] );

?>
