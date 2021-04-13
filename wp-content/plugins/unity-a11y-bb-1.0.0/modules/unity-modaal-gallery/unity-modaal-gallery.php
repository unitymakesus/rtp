<?php

class UnityModaalGalleryModule extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Modaal Gallery', 'unity-a11y-bb' ),
            'description' => __( 'A button that opens an accessible Modaal dialog window with multiple images.', 'unity-a11y-bb' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Unity', 'unity-a11y-bb' ),
            'dir'         => UNITY_A11Y_BB_DIR . 'modules/unity-modaal-gallery/',
            'url'         => UNITY_A11Y_BB_URL . 'modules/unity-modaal-gallery/',
        ]);

        /**
         * CSS
         */
        $this->add_css('modaal-css', 'https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css');
        $this->add_css('unity-modaal-gallery-css', asset_path('styles/unity-modaal-gallery.css'));

        /**
         * JS
         */
        $this->add_js('modaal-js', 'https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js', ['jquery']);
        $this->add_js('unity-modaal-gallery-js', asset_path('scripts/unity-modaal-gallery.js'), ['jquery', 'modaal-js'], null, true);
    }
}

FLBuilder::register_module( 'UnityModaalGalleryModule', [
    'unity-modaal-gallery-general' => [
        'title'    => __( 'General', 'unity-a11y-bb' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', 'unity-a11y-bb' ),
                'fields' => [
                    'images' => [
                        'type'          => 'multiple-photos',
                        'label'         => __( 'Gallery', 'unity-a11y-bb' ),
                    ],
                ],
            ],
        ],
    ],
] );
