<?php

class CbbBackgroundVideoModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Background Video', 'fl-builder' ),
			'description'     => __( 'A module that displays an accessible background video.', 'fl-builder' ),
			'icon'            => 'video.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-bg-video-plyr/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-bg-video-plyr/'
		));

		// Include custom CSS and JS
		$this->add_css('cbb-bg-video-plyr', CBB_MODULES_URL . 'dist/styles/cbb-bg-video-plyr.css');
		$this->add_js('cbb-bg-video-plyr-polyfills', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL');
		$this->add_js('cbb-bg-video-plyr', CBB_MODULES_URL . 'dist/scripts/cbb-bg-video-plyr.js');
	}
}

/*
	Register the module
 */
FLBuilder::register_module( 'CbbBackgroundVideoModule', [
	'cbb-background-video-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-background-video' => [
				'title' => __( 'Content', 'cbb' ),
				'fields' => [
					'vimeo_link'   => [
						'type'        => 'text',
						'label'       => __( 'Vimeo URL'),
						'help'        => __( 'Please enter a valid Vimeo video URL.' ),
					],
				]
			]
		]
	]
] );
