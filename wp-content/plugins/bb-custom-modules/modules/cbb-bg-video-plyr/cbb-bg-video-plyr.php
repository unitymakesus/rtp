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
		$this->add_js('cbb-bg-video-plyr', CBB_MODULES_URL . 'dist/scripts/cbb-bg-video-plyr.js');
	}

	/**
	 * Check if an oEmbed is YouTube or Vimeo.
	 * @param $url | string
	 */
	public function identify_oembed_service($url) {
		if (preg_match('%youtube|youtu\.be%i', $url)) {
			return 'youtube';
		} elseif (preg_match('%vimeo%i', $url)) {
			return 'vimeo';
		}

		return null;
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
					'video_type'   => [
						'type'    => 'select',
						'label'   => __( 'Video Type' ),
						'default' => 'vimeo',
						'options' => [
							'vimeo'   => __( 'Vimeo' ),
							'youtube' => __( 'YouTube' ),
						],
						'toggle'  => [
							'youtube' => [
								'fields'   => ['youtube_link', 'end', 'start'],
								'sections' => ['video_option'],
								'tabs'     => ['yt_subscribe_bar'],
							],
							'vimeo'   => [
								'fields'   => ['vimeo_link', 'start'],
								'sections' => ['vimeo_option'],
							],
						],
					],
					'vimeo_link'   => [
						'type'        => 'text',
						'label'       => __( 'Vimeo URL'),
						'default'     => 'https://vimeo.com/274860274',
						'connections' => ['url'],
					],
					'youtube_link' => [
						'type'        => 'text',
						'label'       => __( 'YouTube URL' ),
						'default'     => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
						'connections' => ['url'],
					],
				]
			]
		]
	]
] );
