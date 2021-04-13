<?php

class UnityJumpLinkModule extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Jump Link', 'unity-a11y-bb' ),
            'description' => __( 'A better jump link with accessible focus management.', 'unity-a11y-bb' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Unity', 'unity-a11y-bb' ),
            'dir'         => UNITY_A11Y_BB_DIR . 'modules/unity-jump-link/',
            'url'         => UNITY_A11Y_BB_URL . 'modules/unity-jump-link/',
        ]);

        /**
         * JS
         */
        $this->add_js('unity-a11y-bb-jump', asset_path('scripts/unity-jump-link.js'), ['jquery'], null, true);
    }
}

FLBuilder::register_module('UnityJumpLinkModule', [
    'unity-jump-link-general' => [
        'title'    => __( 'General', 'unity-a11y-bb' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', 'unity-a11y-bb' ),
                'fields' => [
                    'cta_text' => [
                        'type'  => 'text',
                        'label' => __( 'CTA Text', 'unity-a11y-bb' ),
                    ],
                    'cta_link' => [
                        'type'  => 'link',
                        'label' => __( 'CTA Link', 'unity-a11y-bb' ),
                    ]
                ],
            ],
        ],
    ],
    'unity-jump-link-style' => [
        'title'    => __( 'Style', 'unity-a11y-bb' ),
        'sections' => [
            'style'  => [
                'title'  => '',
                'fields' => [
                    'align'        => [
                        'type'       => 'align',
                        'label'      => __( 'Align', 'unity-a11y-bb' ),
                        'default'    => 'left',
                    ],
                ],
            ],
        ],
    ],
]);
