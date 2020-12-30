<?php

class HubRTPCarousel extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Carousel (Hub RTP)', '' ),
            'description' => __( '' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Layout', '' ),
            'dir'         => CBB_HUB_DIR . 'modules/carousel/',
            'url'         => CBB_HUB_DIR . 'modules/carousel/',
        ]);

        /**
         * CSS
         */
        $this->add_css('cbb-hub-rtp-carousel-css', asset_path('styles/hub-rtp-carousel.css'));

        /**
         * JS
         */
        $this->add_js('cbb-hub-rtp-carousel-js', asset_path('scripts/hub-rtp-carousel.js'), [], null, true);
    }
}

FLBuilder::register_module('HubRTPCarousel', [
    'hub-rtp-carousel-general' => [
        'title'    => __( 'General', '' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', '' ),
                'fields' => [
                    'images' => [
                        'type' => 'multiple-photos',
                        'label' => __( 'Images', '' ),
                    ],
                    'text' => [
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'label'         => __( 'Text', '' ),
                    ],
                ],
            ],
            'style' => [
                'title'  => __( 'Style', '' ),
                'fields' => [
                    'align_text_content' => [
                        'type' => 'button-group',
                        'label' => __('Align Text Content'),
                        'default' => 'left',
                        'options' => [
                            'left' => __('Left'),
                            'right' => __('Right'),
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
