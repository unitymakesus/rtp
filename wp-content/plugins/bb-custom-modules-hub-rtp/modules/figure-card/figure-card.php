<?php

class HubRTPFigureCard extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Figure Card (Hub RTP)', '' ),
            'description' => __( '' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Layout', '' ),
            'dir'         => CBB_HUB_DIR . 'modules/figure-card/',
            'url'         => CBB_HUB_DIR . 'modules/figure-card/',
        ]);

        /**
         * CSS
         */
        $this->add_css('hub-rtp-figure-card-css', asset_path('styles/hub-rtp-figure-card.css'));
    }
}

FLBuilder::register_module('HubRTPFigureCard', [
    'hub-rtp-figure-card-general' => [
        'title' => __( 'General', '' ),
        'sections' => [
            'hub-rtp-figure-card-structure' => [
                'title' => __('Layout', ''),
                'fields' => [
                    'image' => [
                        'type' => 'photo',
                        'label' => __('Image', ''),
                    ],
                    'image_align' => [
                        'type' => 'select',
                        'label' => __('Image Alignment', ''),
                        'default' => 'left',
                        'options' => [
                            'left' => __('Left', ''),
                            'right' => __('Right', '')
                        ]
                    ]
                ]
            ],
            'hub-rtp-figure-card-content' => [
                'title' => __( 'Content', '' ),
                'fields' => [
                    'content' => [
                        'type' => 'editor',
                        'label' => '',
                        'media_buttons' => false,
                        'rows' => 4,
                    ]
                ]
            ],
        ]
    ]
]);
