<?php

namespace App;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  // Unenqueue files from parent theme
  wp_dequeue_style('sage/main.css');
  wp_dequeue_script('sage/main.js');

  // Enqueue files for child theme (which include the above as imports)
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Enable plugins to manage the document title
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
 */
add_theme_support('title-tag');

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'social_links' => __('Social Links', 'sage')
]);

/**
 * Enable post thumbnails
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
 * Enable HTML5 markup support
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

/**
 * Enable selective refresh for widgets in customizer
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
 */
add_theme_support('customize-selective-refresh-widgets');

/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
add_theme_support( 'align-wide' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'wp-block-styles' );

/**
 * Enqueue editor styles for Gutenberg
 */
// function simple_editor_styles() {
//   wp_enqueue_style( 'simple-gutenberg-style', asset_path('styles/main.css') );
// }
// add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\simple_editor_styles' );

/**
 * Add image quality
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Enable logo uploader in customizer
 */
add_image_size('rtp-logo', 200, 200, false);
add_image_size('rtp-logo-2x', 400, 400, false);
add_theme_support('custom-logo', array(
  'size' => 'rtp-logo-2x'
));

/**
 * Add image sizes
 */
add_image_size('medium-square-thumbnail', 600, 600, true);

add_filter( 'image_size_names_choose', function( $sizes ) {
  return array_merge( $sizes, array(
    'medium-square-thumbnail' => __( 'Medium Square Thumbnail' ),
  ) );
} );

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ];
  register_sidebar([
    'name'          => __('Footer-Social-Left', 'sage'),
    'id'            => 'footer-social-left'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Social-Right', 'sage'),
    'id'            => 'footer-social-right'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Utility-Left', 'sage'),
    'id'            => 'footer-utility-left'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Utility-Right', 'sage'),
    'id'            => 'footer-utility-right'
  ] + $config);
});

/**
 * Add Shortcode for Directory Search
 */
add_shortcode('directory-search-filter', function($atts) {
  ob_start();
  ?>
  <form class="directory-search-filter" action="/directory-map/"  method="get">
    <div class="row">
      <div class="col s12 m6">
        <label for="fwp_search_directory">Search</label>
      	<input type="search" placeholder="Keywords" value="" name="fwp_search_directory" id="fwp_search_directory" aria-label="Keyword">
      </div>
      <div class="col s12 m6">
        <div class="filter-selects">
          <div class="label">Filter</div>
          <div class="dropdown">
            <select name="fwp_company_types" aria-label="Company Type" class="default">
              <option value="" selected>Company Type</option>
              <?php
                $topics = get_terms(['taxonomy' => 'rtp-company-type', 'hide_empty' => TRUE]);
                foreach ($topics as $t) {
                  echo '<option value="' . $t->slug . '">' . $t->name . ' (' . $t->count . ')</option>';
                }
              ?>
            </select>
          </div>
          <div class="dropdown">
            <select name="fwp_facility_types" aria-label="Facility Type" class="default">
              <option value="" selected>Facility Type</option>
              <?php
                $topics = get_terms(['taxonomy' => 'rtp-facility-type', 'hide_empty' => TRUE]);
                foreach ($topics as $t) {
                  echo '<option value="' . $t->slug . '">' . $t->name . ' (' . $t->count . ')</option>';
                }
              ?>
            </select>
          </div>
          <div class="dropdown">
            <select name="fwp_availability" aria-label="Real Estate" class="default">
              <option value="" selected>Real Estate</option>
              <?php
                $topics = get_terms(['taxonomy' => 'rtp-availability', 'hide_empty' => TRUE]);
                foreach ($topics as $t) {
                  echo '<option value="' . $t->slug . '">' . $t->name . ' (' . $t->count . ')</option>';
                }
              ?>
            </select>
          </div>
        </div>
      	<button type="submit">Explore the directory <span class="cta-arrow"></span></button>
      </div>
    </div>
  </form>
  <?php
  return ob_get_clean();
});


/**
 * Add Shortcode for Boxyard map in Annual Report
 */
add_shortcode('annual-report-boxyard', function($atts) {
  ob_start();
  ?>
  <section id="boxyard">
    <span class="screen-reader-text"><?= __('These vendors coming soon to Boxyard RTP!'); ?></span>
    <div class="map" style="background-image:url('<?= asset_path('images/boxyard-rtp-map.png'); ?>');"></div>
    <div class="boxes">
      <div class="box box-1" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-gameon.png'); ?>" alt="Game On Escapes & More" />
      </div>
      <div class="box box-2" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-uncorked.png'); ?>" alt="RTP Uncorked" />
      </div>
      <div class="box box-3"></div>
      <div class="box box-4" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-fullsteam.png'); ?>" alt="Fullsteam Brewery" />
      </div>
      <div class="box box-5"></div>
      <div class="box box-6" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-medicinemamas.png'); ?>" alt="Medicine Mamas" />
      </div>
      <div class="box box-7"></div>
      <div class="box box-8" tabindex="0">
        <img src="<?= asset_path('images/logos/logo-pouredpressed.png'); ?>" alt="Poured & Pressed" />
      </div>
      <div class="box box-9" aria-hidden="true">
        <img src="<?= asset_path('images/logos/logo-comingsoon.png'); ?>" alt="" />
      </div>
    </div>
  </section>
  <?php
  return ob_get_clean();
});

/**
 * Register options page
 */
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' => 'Site Announcements',
    'menu_title' => 'Site Announcements',
    'menu_slug'  => 'site-announcement-settings',
    'capability' => 'manage_options',
    'redirect'   => false,
    'icon_url'   => 'dashicons-megaphone',
  ));
}

/**
 * Event Space Features Shortcode
 */
add_shortcode('event-space', function ($atts) {
    $features = shortcode_atts(array(
        'wifi'               => '',
        'whiteboard'         => '',
        'tv'                 => '',
        'hdmi'               => '',
        'screen'             => '',
        'projector'          => '',
        'microphone'         => '',
        'podium'             => '',
        'sofa'               => '',
        'layouts'            => '',
        'seats'              => '',
        'video-conferencing' => '',
        'sound'              => '',
    ), $atts);

    ob_start();

    foreach ($features as $icon => $feature) {
        if (!empty($feature)) {
            echo '<span class="event-space-feature feature-icon-'.$icon.'">'.$feature.'</span>';
        }
    }

    return ob_get_clean();
});
