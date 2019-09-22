<?php

class CbbFigureCardModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Card', 'fl-builder' ),
			'description'     => __( 'A card module that includes a badge and optional CTA', 'fl-builder' ),
			'icon'            => 'card.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-figure-card/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-figure-card/'
		));

		// Include custom CSS
		$this->add_css('cbb-figure-card', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
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
FLBuilder::register_module( 'CbbFigureCardModule', [
	'cbb-figure-card-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-figure-card-structure' => [
				'title' => __('Layout', 'cbb'),
				'fields' => [
					'structure' => [
						'type' => 'select',
						'label' => __('Layout', 'cbb'),
						'default' => 'default',
						'options' => [
							'default' => __('Background Image', 'cbb'),
							'vertical' => __('Vertical', 'cbb'),
							'horizontal' => __('Horizontal', 'cbb')
						],
						'toggle' => [
							'default' => [],
							'vertical' => [
								'fields' => ['image', 'image_alt', 'image_align']
							],
							'horizontal' => [
								'fields' => ['image', 'image_alt', 'image_align']
							]
						]
					],
					'image' => [
						'type' => 'photo',
						'label' => __('Image', 'cbb'),
					],
					'image_alt' => [
						'type' => 'text',
						'label' => __('Image Alt Text', 'cbb'),
					],
					'image_align' => [
						'type' => 'select',
						'label' => __('Image Alignment', 'cbb'),
						'default' => 'left',
						'options' => [
							'left' => __('Left', 'cbb'),
							'right' => __('Right', 'cbb')
						]
					]
				]
			],
			'cbb-figure-card-title' => [
				'title' => __( 'Title', 'cbb' ),
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
						'label' => __('Title', 'cbb'),
					]
				]
			],
			'cbb-figure-card-content' => [
				'title' => __( 'Content', 'cbb' ),
				'fields' => [
					'content' => [
						'type' => 'editor',
						'label' => '',
						'media_buttons' => false,
						'rows' => 4,
					]
				]
			],
			'cbb-figure-card-cta' => [
				'title' => __( 'Call To Action', 'cbb' ),
				'fields' => [
					'enable_cta' => [
						'type' => 'select',
						'label' => __('Call To Action', 'cbb'),
						'default' => 'none',
						'options' => [
							'none' => __('None', 'cbb'),
							'block' => __('Link', 'cbb'),
							'modaal' => __('Popup', 'cbb')
						],
						'toggle' => [
							'none' => [],
							'block' => [
								'fields' => ['cta_text', 'cta_link']
							],
							'modaal' => [
								'fields' => ['cta_text', 'modaal_content']
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
