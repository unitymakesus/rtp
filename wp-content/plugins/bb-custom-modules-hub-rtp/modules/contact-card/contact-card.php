<?php

class HubRTPContactCard extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Contact Card (Hub RTP)', '' ),
            'description' => __( '' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Layout', '' ),
            'dir'         => CBB_HUB_DIR . 'modules/contact-card/',
            'url'         => CBB_HUB_DIR . 'modules/contact-card/',
        ]);

        /**
         * CSS
         */
        $this->add_css('hub-rtp-contact-card-css', asset_path('styles/hub-rtp-contact-card.css'));
    }
}

FLBuilder::register_module('HubRTPContactCard', [
    'hub-rtp-contact-card-general' => [
        'title' => __( 'General', '' ),
        'sections' => [
            'hub-rtp-contact-card-content' => [
                'title' => __( 'Content', '' ),
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('Contact Name', ''),
                    ],
                    'email' => [
                        'type' => 'text',
                        'label' => __('Contact Email', ''),
                    ],
                    'logo' => [
                        'type' => 'photo',
                        'label' => __('Logo', ''),
                    ],
                ],
            ],
        ],
    ],
]);
