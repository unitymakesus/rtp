<?php
/**
 * Accordion WAI-ARIA (modified and adapted for Beaver Builder)
 *
 * based on:
 * @link https://www.w3.org/TR/wai-aria-practices-1.1/examples/accordion/accordion.html
 * @link https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *
 * @class FLAccordionModule
 */
class FLAccordionModule extends FLBuilderModule {

    /**
     * @method __construct
     */
    public function __construct() {
        parent::__construct(array(
            'name'            => __( 'Accordion', 'fl-builder' ),
            'description'     => __( 'Display a collapsible accordion of items.', 'fl-builder' ),
            'category'        => __( 'Layout', 'fl-builder' ),
            'partial_refresh' => true,
            'icon'            => 'layout.svg',
        ));
    }

    /**
     * Ensure backwards compatibility with old settings.
     *
     * @since 2.2
     * @param object $settings A module settings object.
     * @param object $helper A settings compatibility helper.
     * @return object
     */
    public function filter_settings( $settings, $helper ) {
        if ( isset( $settings->border_color ) ) {
            $settings->item_border          = array();
            $settings->item_border['style'] = 'solid';
            $settings->item_border['color'] = $settings->border_color;
            $settings->item_border['width'] = array(
                'top'    => '1',
                'right'  => '1',
                'bottom' => '1',
                'left'   => '1',
            );
            unset( $settings->border_color );
        }
        return $settings;
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLAccordionModule', array(
    'items' => array(
        'title'    => __( 'Items', 'fl-builder' ),
        'sections' => array(
            'general' => array(
                'title'  => '',
                'fields' => array(
                    'items' => array(
                        'type'         => 'form',
                        'label'        => __( 'Item', 'fl-builder' ),
                        'form'         => 'accordion_items_form', // ID from registered form below
                        'preview_text' => 'label', // Name of a field to use for the preview text
                        'multiple'     => true,
                    ),
                ),
            ),
        ),
    ),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('accordion_items_form', array(
    'title' => __( 'Add Item', 'fl-builder' ),
    'tabs'  => array(
        'general' => array(
            'title'    => __( 'General', 'fl-builder' ),
            'sections' => array(
                'general' => array(
                    'title'  => '',
                    'fields' => array(
                        'label' => array(
                            'type'        => 'text',
                            'label'       => __( 'Label', 'fl-builder' ),
                            'connections' => array( 'string' ),
                        ),
                    ),
                ),
                'content' => array(
                    'title'  => __( 'Content', 'fl-builder' ),
                    'fields' => array(
                        'content' => array(
                            'type'        => 'editor',
                            'label'       => '',
                            'wpautop'     => false,
                            'connections' => array( 'string' ),
                        ),
                    ),
                ),
            ),
        ),
    ),
));
