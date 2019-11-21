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

    // Hero Banners
    require_once 'modules/cbb-hero-banner/cbb-hero-banner.php';

    // Figure Card Module
    require_once 'modules/cbb-figure-card/cbb-figure-card.php';

    // CTA Module
    require_once 'modules/cbb-cta/cbb-cta.php';

    // Blog Feed Module
    require_once 'modules/cbb-blog-feed/cbb-blog-feed.php';

    // Events Feed Module
    require_once 'modules/cbb-events-feed/cbb-events-feed.php';

    // Today Feed Module
    require_once 'modules/cbb-today-feed/cbb-today-feed.php';

    // People Module
    require_once 'modules/cbb-rtp-people/cbb-rtp-people.php';

    // Background Video
    require_once 'modules/cbb-bg-video-plyr/cbb-bg-video-plyr.php';
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
    // 'uabb-video',
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
