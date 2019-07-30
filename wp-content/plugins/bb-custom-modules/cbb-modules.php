<?php

/**
 * Plugin Name: Beaver Builder - Custom Modules
 * Description: Custom modules for the Beaver Builder Plugin.
 * Version: 1.0
 * Author: Unity Digital Agency
 */

define( 'CBB_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'CBB_MODULES_URL', plugins_url( '/', __FILE__ ) );

/**
 * Define Required plugins
 */
function cbb_require_plugins() {
  $requireds = array();

	if ( !is_plugin_active('bb-plugin/fl-builder.php') ) {
    $requireds[] = array(
      'link' => 'https://www.wpbeaverbuilder.com/',
      'name' => 'Beaver Builder'
    );
  }

  if ( !empty($requireds) ) {
    foreach ($requireds as $req) {
  		?>
  		<div class="notice notice-error"><p>
  			<?php printf(
  				__('<b>%s Plugin</b>: <a target="_blank" href="%s">%s</a> must be installed and activated.', 'mecft'),
  	      'Beaver Builder - Custom Modules Deactivated',
          $req['link'],
          $req['name']
  			); ?>
  		</p></div>
  		<?php
    }
    deactivate_plugins( plugin_basename( __FILE__ ) );
  }
}

function cbb_check_required_plugins() {
  add_action( 'admin_notices', 'cbb_require_plugins' );
}

add_action( 'admin_init', 'cbb_check_required_plugins' );

function load_custom_modules() {
  if ( class_exists( 'FLBuilder' ) ) {
    // RTP Splash Feature
    require_once 'modules/cbb-rtp-splash/cbb-rtp-splash.php';
    FLBuilder::register_module( 'CbbRTPSplashModule', [
      'cbb-rtp-splash-general' => [
        'title' => __( 'General', 'cbb' ),
        'description' => __('Landing Text: "Where People + Ideas Converge"<br />To change the landing text, please contact Unity at support@unitymakes.us.', 'cbb'),
        'sections' => [
          'cbb-rtp-splash-banner' => [
            'title' => __( 'Banner', 'cbb' ),
            'fields' => [
              'badge' => [
                'type' => 'text',
                'label' => __('Badge', 'cbb'),
              ],
              'title' => [
                'type' => 'text',
                'label' => __('Banner Text', 'cbb'),
              ],
            ]
          ],
          'cbb-rtp-splash-cta' => [
            'title' => __('Call To Action', 'cbb'),
            'fields' => [
              'cta_text' => [
                'type' => 'text',
                'label' => __('CTA Text', 'cbb'),
              ],
              'cta_link' => [
                'type' => 'link',
                'label' => __('CTA Link', 'cbb'),
              ],
            ]
          ],
          'cbb-rtp-splash-hero' => [
            'title' => __('Image', 'cbb'),
            'fields' => [
              'image' => [
                'type' => 'photo',
                'label' => __('Hero Image', 'cbb'),
              ],
              'image_alt' => [
                'type' => 'text',
                'label' => __('Hero Image Alt Text', 'cbb'),
              ]
            ]
          ]
        ]
      ]
    ] );

    // Figure Card Module
    require_once 'modules/cbb-figure-card/cbb-figure-card.php';
    FLBuilder::register_module( 'CbbFigureCardModule', [
      'cbb-figure-card-general' => [
        'title' => __( 'General', 'cbb' ),
        'sections' => [
          'cbb-figure-card-structure' => [
            'title' => __('Layout', 'cbb'),
            'fields' => [
              'structure' => [
                'type' => 'select',
                'label' => __('Layout', 'cbb'),
                'default' => 'default',
                'options' => [
                  'default' => __('Background Image', 'cbb'),
                  'vertical' => __('Vertical', 'cbb'),
                  'horizontal' => __('Horizontal', 'cbb')
                ]
              ],
              'image' => [
                'type' => 'photo',
                'label' => __('Image', 'cbb'),
              ],
              'image_alt' => [
                'type' => 'text',
                'label' => __('Image Alt Text', 'cbb'),
              ],
              'image_align' => [
                'type' => 'select',
                'label' => __('Image Alignment', 'cbb'),
                'default' => 'left',
                'options' => [
                  'left' => __('Left', 'cbb'),
                  'right' => __('Right', 'cbb')
                ]
              ]
            ]
          ],
          'cbb-figure-card-title' => [
            'title' => __( 'Title', 'cbb' ),
            'fields' => [
              'badge' => [
                'type' => 'select',
                'label' => __('Badge', 'cbb'),
                'default' => 'RTP',
                'options' => [
                  'RTP' => 'RTP',
                  'Hub' => 'Hub',
                  'Boxyard' => 'Boxyard',
                  'Frontier' => 'Frontier',
                  'STEM' => 'STEM'
                ]
              ],
              'title' => [
                'type' => 'text',
                'label' => __('Title', 'cbb'),
              ]
            ]
          ],
          'cbb-figure-card-content' => [
            'title' => __( 'Content', 'cbb' ),
            'fields' => [
              'content' => [
                'type' => 'editor',
                'label' => '',
                'media_buttons' => false,
                'rows' => 4,
              ]
            ]
          ],
          'cbb-figure-card-cta' => [
            'title' => __( 'Call To Action', 'cbb' ),
            'fields' => [
              'enable_cta' => [
                'type' => 'select',
                'label' => __('Call To Action', 'cbb'),
                'default' => 'none',
                'options' => [
                  'none' => __('No', 'cbb'),
                  'block' => __('Yes', 'cbb'),
                ]
              ],
              'cta_text' => [
                'type' => 'text',
                'label' => __('CTA Text', 'cbb'),
              ],
              'cta_link' => [
                'type' => 'link',
                'label' => __('CTA Link', 'cbb'),
              ]
            ]
          ]
        ]
      ]
    ] );

    // FLBuilder::register_settings_form('card_content', array(
    //   'title' => __('Editorial Card', 'cbb'),
    //   'tabs'  => array(
    //     'general'      => array(
    //       'title'         => __('General', 'cbb'),
    //       'sections'      => array(
    //         'general'       => array(
    //           'title'         => '',
    //           'fields'        => array(
    //             'card_title'     => array(
    //               'type'          => 'text',
    //               'label'         => __( 'Title', 'cbb' ),
    //             ),
    //             'card_text'     => array(
    //               'type'          => 'text',
    //               'label'         => __( 'Content', 'cbb' ),
    //             ),
    //             'card_link'     => array(
    //               'type'          => 'link',
    //               'label'         => __( 'Link', 'cbb' ),
    //             ),
    //             'card_background' => array(
    //               'type'          => 'photo',
    //               'label'         => __('Background Image', 'cbb'),
    //               'show_remove'   => false,
    //             ),
    //             'card_icon' => array(
    //               'type'          => 'icon',
    //               'label'         => __( 'Icon', 'cbb' ),
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
    //     'title'         => __( 'General', 'cbb' ),
    //     'sections'      => array(
    //       'source-section'  => array(
    //         'title'         => __( 'Source', 'cbb' ),
    //         'fields'        => array(
    //           'cards' => array(
    //             'type'          => 'form',
    //             'label'         => __('Editorial Card', 'cbb'),
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
    // 'tabs',
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
