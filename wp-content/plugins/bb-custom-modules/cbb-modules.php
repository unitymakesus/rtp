<?php

/**
 * Plugin Name: Beaver Builder - Custom Modules
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Unity Digital Agency
 */

// Custom modules
define( 'CBB_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'CBB_MODULES_URL', plugins_url( '/', __FILE__ ) );

function load_custom_modules() {
  if ( class_exists( 'FLBuilder' ) ) {
    // RTP Splash Feature
    require_once 'modules/cbb-rtp-splash/cbb-rtp-splash.php';
    FLBuilder::register_module( 'CbbRTPSplashModule', [
      'cbb-rtp-splash-general' => [
        'title' => __( 'General', 'fl-builder' ),
        'description' => __('Landing Text: "Where People + Ideas Converge"<br />To change the landing text, please contact Unity at support@unitymakes.us.', 'fl-builder'),
        'sections' => [
          'cbb-rtp-splash-hero' => [
            'title' => __( 'Hero', 'fl-builder' ),
            'fields' => [
              'cbb_rtp_splash_hero_badge' => [
                'type' => 'text',
                'label' => __('Hero Badge', 'fl-builder'),
              ],
              'cbb_rtp_splash_hero_title' => [
                'type' => 'text',
                'label' => __('Hero Banner Title', 'fl-builder'),
              ],
              'cbb_rtp_splash_hero_cta_text' => [
                'type' => 'text',
                'label' => __('Hero CTA Text', 'fl-builder'),
              ],
              'cbb_rtp_splash_hero_cta_link' => [
                'type' => 'link',
                'label' => __('Hero CTA Link', 'fl-builder'),
              ],
              'cbb_rtp_splash_hero_image' => [
                'type' => 'photo',
                'label' => __('Hero Image', 'fl-builder'),
              ],
              'cbb_rtp_splash_hero_image_alt' => [
                'type' => 'text',
                'label' => __('Hero Image Alt Text', 'fl-builder'),
              ]
            ]
          ],
        ]
      ]
    ] );
    //
    // FLBuilder::register_settings_form('card_content', array(
    //   'title' => __('Editorial Card', 'fl-builder'),
    //   'tabs'  => array(
    //     'general'      => array(
    //       'title'         => __('General', 'fl-builder'),
    //       'sections'      => array(
    //         'general'       => array(
    //           'title'         => '',
    //           'fields'        => array(
    //             'card_title'     => array(
    //               'type'          => 'text',
    //               'label'         => __( 'Title', 'fl-builder' ),
    //             ),
    //             'card_text'     => array(
    //               'type'          => 'text',
    //               'label'         => __( 'Content', 'fl-builder' ),
    //             ),
    //             'card_link'     => array(
    //               'type'          => 'link',
    //               'label'         => __( 'Link', 'fl-builder' ),
    //             ),
    //             'card_background' => array(
    //               'type'          => 'photo',
    //               'label'         => __('Background Image', 'fl-builder'),
    //               'show_remove'   => false,
    //             ),
    //             'card_icon' => array(
    //               'type'          => 'icon',
    //               'label'         => __( 'Icon', 'fl-builder' ),
    //               'show_remove'   => true
    //             ),
    //           )
    //         ),
    //       )
    //     )
    //   )
    // ));
    //
    // // Editorial Cards
    // require_once 'cbb-editorial-cards/cbb-editorial-cards.php';
    // FLBuilder::register_module( 'CbbEditorialCardsModule', array(
    //   'general-tab'      => array(
    //     'title'         => __( 'General', 'fl-builder' ),
    //     'sections'      => array(
    //       'source-section'  => array(
    //         'title'         => __( 'Source', 'fl-builder' ),
    //         'fields'        => array(
    //           'cards' => array(
    //             'type'          => 'form',
    //             'label'         => __('Editorial Card', 'fl-builder'),
    //             'form'          => 'card_content',
    //             'preview_text'  => 'label',
    //             'multiple'     => true,
    //           ),
    //         )
    //       ),
    //     )
    //   )
    // ) );

  }
}
add_action( 'init', 'load_custom_modules' );

// Disable modules we don't ever want to use
function cbb_disable_modules( $enabled, $instance ) {
  $disable = array(
    'photo',
    'content-slider',
    'cbb-editorial-cards',
    'gallery',
    'icon',
    'icon-group',
    'map',
    'slideshow',
    'testimonials',
    'cta',
    'callout',
    'contact-form',
    'menu',
    'social-buttons',
    'subscribe-form',
    'pricing-table',
    'sidebar',
    'tabs',
    'numbers',
    'post-grid',
    'post-carousel',
    'cbb-latest-masonry',
    'post-slider',
    'advanced-tabs',
    'uabb-business-hours',
    'uabb-heading',
    'info-table',
    'interactive-banner-1',
    'list-icon',
    'uabb-separator',
    'team',
    'uabb-video',
    'uabb-advanced-menu',
    'advanced-separator',
    'creative-link',
    'dual-button',
    'dual-color-heading',
    'fancy-text',
    'image-separator',
    'info-circle',
    'progress-bar',
    'uabb-countdown',
    'uabb-image-carousel',
    'uabb-button',
    'uabb-contact-form7',
    'uabb-call-to-action',
    'uabb-contact-form',
    'modal-popup',
    'ribbon',
    'mailchimp-subscribe-form',
  );
  if ( in_array( $instance->slug, $disable ) ) {
    return false;
  }
  return $enabled;
}
add_filter( 'fl_builder_register_module', 'cbb_disable_modules', 10, 2 );
