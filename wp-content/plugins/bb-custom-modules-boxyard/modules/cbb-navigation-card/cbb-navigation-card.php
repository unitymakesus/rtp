<?php

class CbbBoxyardNavigationCardModule extends FLBuilderModule {
    public function __construct() {
        parent::__construct(array(
            'name'        => __( 'Navigation Card', 'fl-builder' ),
            'description' => __( 'A navigation card module with background image.', 'fl-builder' ),
            'icon'        => 'card.svg',
            'category'    => __( 'Layout', 'fl-builder' ),
            'dir'         => CBB_BOXYARD_MODULES_DIR . 'modules/cbb-navigation-card/',
            'url'         => CBB_BOXYARD_MODULES_URL . 'modules/cbb-navigation-card/',
        ));

        // Include custom CSS
        // $this->add_css('cbb-navigation-card', CBB_MODULES_URL . 'dist/styles/cbb-navigation-card.css');
        // $this->add_js('cbb-cta', CBB_MODULES_URL . 'dist/scripts/cbb-cta.js');
    }

    /**
     * Function to get the icon for the Figure Card module
     *
     * @method get_icons
     * @param string $icon gets the icon for the module.
     */
    public function get_icon( $icon = '' ) {
        // check if $icon is referencing an included icon.
        if ( '' != $icon && file_exists( CBB_BOXYARD_MODULES_DIR . 'assets/icons/' . $icon ) ) {
            $path = CBB_BOXYARD_MODULES_DIR . 'assets/icons/' . $icon;
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
FLBuilder::register_module('CbbBoxyardNavigationCardModule', [
    'cbb-navigation-card-general' => [
        'title'    => __( 'General', 'cbb' ),
        'sections' => [
            'cbb-navigation-card-content' => [
                'title'  => __( 'Content', 'cbb' ),
                'fields' => [
                    'image' => [
                        'type'  => 'photo',
                        'label' => __('Image', 'cbb'),
                    ],
                    'link' => [
                        'type'        => 'link',
                        'label'       => __('Link', 'cbb'),
                        'show_target' => false,
                    ],
                    'link_text' => [
                        'type'        => 'text',
                        'label'       => __('Link Text', 'cbb'),
                    ],
                    'text' => [
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'label'         => __('Text', 'cbb'),
                    ],
                ]
            ],
        ]
    ]
]);
