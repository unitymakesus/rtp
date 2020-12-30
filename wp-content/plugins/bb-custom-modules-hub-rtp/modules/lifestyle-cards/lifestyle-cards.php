<?php

class HubRTPLifestyleCards extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Lifestyle Cards (Hub RTP)', '' ),
            'description' => __( '' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Layout', '' ),
            'dir'         => CBB_HUB_DIR . 'modules/lifestyle-cards/',
            'url'         => CBB_HUB_DIR . 'modules/lifestyle-cards/',
        ]);

        /**
         * CSS
         */
        $this->add_css('cbb-hub-rtp-lifestyle-cards-css', asset_path('styles/hub-rtp-lifestyle-cards.css'));

        /**
         * JS
         */
        $this->add_js('cbb-hub-rtp-lifestyle-cards-js', asset_path('scripts/hub-rtp-lifestyle-cards.js'), [], null, true);
    }
}

FLBuilder::register_module('HubRTPLifestyleCards', [
    'hub-rtp-lifestyle-cards-general' => [
        'title'    => __( 'General', '' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', '' ),
                'fields' => [
                    'cards' => [
                        'type'         => 'form',
                        'label'        => __( 'Card', 'fl-builder' ),
                        'form'         => 'lifestyle_cards_form',        // ID from registered form below
                        'preview_text' => 'label',                       // Name of a field to use for the preview text
                        'multiple'     => true,
                    ],
                ],
            ],
        ],
    ],
]);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('lifestyle_cards_form', [
    'title' => __('Add Card', 'fl-builder'),
    'tabs'  => [
        'general' => [
            'title'    => __('General', 'fl-builder'),
            'sections' => [
                'general' => [
                    'title'  => '',
                    'fields' => [
                        'label' => [
                            'type'  => 'text',
                            'label' => __('Label', 'fl-builder'),
                        ],
                    ],
                ],
                'content' => [
                    'title'  => __('Content', 'fl-builder'),
                    'fields' => [
                        'background_image' => [
                            'type'  => 'photo',
                            'label' => __('Background Image', ''),
                        ],
                        'heading' => [
                            'type'  => 'text',
                            'label' => __('Heading', ''),
                        ],
                        'text' => [
                            'type'          => 'editor',
                            'label'         => __('Text', ''),
                            'media_buttons' => false,
                        ],
                        'icon' => [
                            'type'  => 'photo',
                            'label' => __('Icon', ''),
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
