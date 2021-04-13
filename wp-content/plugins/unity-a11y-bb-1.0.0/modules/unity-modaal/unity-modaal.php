<?php

class UnityModaalModule extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Modaal', 'unity-a11y-bb' ),
            'description' => __( 'A button that opens an accessible Modaal dialog window.', 'unity-a11y-bb' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Unity', 'unity-a11y-bb' ),
            'dir'         => UNITY_A11Y_BB_DIR . 'modules/unity-modaal/',
            'url'         => UNITY_A11Y_BB_URL . 'modules/unity-modaal/',
        ]);

        /**
         * CSS
         */
        $this->add_css('modaal-css', 'https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css');

        /**
         * JS
         */
        $this->add_js('modaal-js', 'https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js', ['jquery']);
        $this->add_js('unity-modaal-js', asset_path('scripts/unity-modaal.js'), ['jquery', 'modaal-js'], null, true);
    }
}

FLBuilder::register_module( 'UnityModaalModule', [
    'unity-modaal-general' => [
        'title'    => __( 'General', 'unity-a11y-bb' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', 'unity-a11y-bb' ),
                'fields' => [
                    'cta_text' => [
                        'type'  => 'text',
                        'label' => __( 'CTA Text', 'unity-a11y-bb' ),
                    ],
                    'cta_target' => [
                        'type'  => 'text',
                        'help'  => 'Optional: provide an ID to target from the call to action button. This overrides the default auto-generated ID for the link’s href.',
                        'label' => __( 'CTA Target', 'unity-a11y-bb' ),
                    ],
                    'modaal_id' => [
                        'type'  => 'text',
                        'help'  => 'Optional: set an ID for targeting the inline content. This overrides the default auto-generated ID for targeting the inline content.',
                        'label' => __( 'Modaal ID', 'unity-a11y-bb' ),
                    ],
                    'modaal_content' => [
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'wpautop'       => false,
                        'label'         => __( 'Modaal Content', 'unity-a11y-bb' ),
                    ],
                ],
            ],
        ],
    ],
    'unity-modaal-style' => [
        'title'    => __( 'Style', 'unity-a11y-bb' ),
        'sections' => [
            'style'  => [
                'title'  => '',
                'fields' => [
                    'align'        => [
                        'type'    => 'align',
                        'label'   => __( 'Align', 'unity-a11y-bb' ),
                        'default' => 'left',
                    ],
                ],
            ],
        ],
    ],
] );
