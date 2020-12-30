<?php

class CbbBoxyardTextCardModule extends FLBuilderModule {
    public function __construct() {
        parent::__construct(array(
            'name'        => __( 'Text Card', 'fl-builder' ),
            'description' => __( 'A simple content box with border.', 'fl-builder' ),
            'icon'        => 'card.svg',
            'category'    => __( 'Layout', 'fl-builder' ),
            'dir'         => CBB_BOXYARD_MODULES_DIR . 'modules/cbb-text-card/',
            'url'         => CBB_BOXYARD_MODULES_URL . 'modules/cbb-text-card/',
        ));
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
FLBuilder::register_module('CbbBoxyardTextCardModule', [
    'cbb-text-card-general' => [
        'title'    => __( 'General', 'cbb' ),
        'sections' => [
            'cbb-text-card-content' => [
                'title'  => __( 'Content', 'cbb' ),
                'fields' => [
                    'text' => [
                        'type'          => 'editor',
                        'media_buttons' => false,
                        'label'         => __('Text', 'cbb'),
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
                ]
            ],
            'cbb-text-card-style' => [
                'title'  => __( 'Style', 'cbb' ),
                'fields' => [
                    'border_color' => [
                        'type'    => 'button-group',
                        'label'   => __('Border Color', 'cbb'),
                        'default' => 'slate',
                        'options' => [
                            'slate' => __('Slate', 'cbb'),
                            'red'   => __('Red', 'cbb'),
                            'none'  => __('None', 'cbb'),
                        ],
                    ],
                    'link_type' => [
                        'type'    => 'button-group',
                        'label'   => __('Link Type', 'cbb'),
                        'default' => 'text',
                        'options' => [
                            'text' => __('Text', 'cbb'),
                            'btn'  => __('Button', 'cbb'),
                        ],
                    ],
                ]
            ],
        ]
    ]
]);
