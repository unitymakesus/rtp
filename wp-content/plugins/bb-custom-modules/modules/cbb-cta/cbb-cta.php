<?php

class CbbCTAModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Call to Action', 'fl-builder' ),
			'description'     => __( 'A call-to-action link', 'fl-builder' ),
			'icon'            => 'arrow.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-cta/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-cta/'
		));

		// Include custom CSS
		$this->add_css('cbb-cta', CBB_MODULES_URL . 'dist/styles/cbb-cta.css');
		$this->add_js('cbb-cta', CBB_MODULES_URL . 'dist/scripts/cbb-cta.js');
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
FLBuilder::register_module( 'CbbCTAModule', [
	'cbb-cta-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-cta' => [
				'title' => __( 'Call To Action', 'cbb' ),
				'fields' => [
					'cta_text' => [
						'type' => 'text',
						'label' => __('CTA Text', 'cbb'),
					],
					'cta_align' => array(
						'type'    => 'align',
						'label'   => 'Align',
						'default' => 'left',
					),
					'cta_type' => [
						'type' => 'select',
						'label' => __('Type', 'cbb'),
						'default' => 'link',
						'options' => [
							'link' => __('Link', 'cbb'),
							'modaal' => __('Popup', 'cbb')
						],
						'toggle' => [
							'none' => [],
							'link' => [
								'fields' => ['cta_link']
							],
							'modaal' => [
								'fields' => ['modaal_content']
							]
						]
					],
					'cta_link' => [
						'type' => 'link',
						'label' => __('CTA Link', 'cbb'),
					],
					'modaal_content' => [
						'type' => 'editor',
						'media_buttons' => false,
						'wpautop' => false,
						'label' => __('Popup Content', 'cbb')
					]
				]
			]
		]
	]
] );
?>
