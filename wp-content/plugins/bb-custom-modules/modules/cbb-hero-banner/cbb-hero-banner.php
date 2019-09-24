<?php

class CbbHeroBannerModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Hero Banner', 'fl-builder' ),
			'description'     => __( 'A module for a page hero that includes a banner with an optional CTA', 'fl-builder' ),
			'icon'            => 'banner.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-hero-banner/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-hero-banner/'
		));

		// Include custom CSS
		$this->add_css('cbb-hero-banner', CBB_MODULES_URL . 'dist/styles/cbb-hero-banner.css');
	}

	/**
	 * Function to get the icon for the Figure Card module
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
FLBuilder::register_module( 'CbbHeroBannerModule', [
	'cbb-hero-banner-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-hero-banner-hero' => [
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
			],
			'cbb-hero-banner-banner' => [
				'title' => __( 'Banner', 'cbb' ),
				'fields' => [
					'badge' => [
						'type' => 'select',
						'label' => __('Badge', 'cbb'),
						'default' => 'RTP',
						'options' => [
							'RTP' => 'RTP',
							'Hub RTP' => 'Hub RTP',
							'Boxyard RTP' => 'Boxyard RTP',
							'Frontier RTP' => 'Frontier RTP',
							'STEM RTP' => 'STEM RTP'
						]
					],
					'title' => [
						'type' => 'text',
						'label' => __('Banner Text', 'cbb'),
					],
					'content' => [
						'type' => 'editor',
						'label' => __('Content (optional)', 'cbb'),
						'media_buttons' => false,
						'rows' => 4,
					]
				]
			],
			'cbb-hero-banner-cta' => [
				'title' => __( 'Call To Action', 'cbb' ),
				'fields' => [
					'enable_cta' => [
						'type' => 'select',
						'label' => __('Call To Action', 'cbb'),
						'default' => 'none',
						'options' => [
							'none' => __('No', 'cbb'),
							'block' => __('Yes', 'cbb'),
						],
						'toggle' => [
							'none' => [],
							'block' => [
								'fields' => ['cta_text', 'cta_link']
							]
						]
					],
					'cta_text' => [
						'type' => 'text',
						'label' => __('CTA Text', 'cbb'),
					],
					'cta_link' => [
						'type' => 'link',
						'label' => __('CTA Link', 'cbb'),
					]
				]
			]
		]
	]
] );

?>
