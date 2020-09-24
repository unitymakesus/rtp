<?php

class CbbBoxyardTodayFeedModule extends FLBuilderModule {

    public function __construct() {
        parent::__construct(array(
            'name'            => __( 'Today Feed', 'fl-builder' ),
            'description'     => __( 'A module that pulls in today\'s events from the calendar and Frontier building schedule.', 'fl-builder' ),
            'icon'            => 'today.svg',
            'category'        => __( 'Layout', 'fl-builder' ),
            'dir'             => CBB_BOXYARD_MODULES_DIR . 'modules/cbb-today-feed/',
            'url'             => CBB_BOXYARD_MODULES_URL . 'modules/cbb-today-feed/'
        ));
    }

    /**
     * Query today's MEC events.
     */
    public function get_todays_events() {
        return new \WP_Query([
            'post_type'      => 'mec-events',
            'posts_per_page' => 1,
        ]);
    }
}

/*
    Register the module
*/
FLBuilder::register_module( 'CbbBoxyardTodayFeedModule', [
    'cbb-today-feed-general' => [
        'title' => __( 'General', 'cbb' ),
        'sections' => [
            'cbb-today-feed' => [
                'title' => __( 'Content', 'cbb' ),
                'fields' => [
                ]
            ]
        ]
    ]
] );
