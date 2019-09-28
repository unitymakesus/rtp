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
 * REMOVE WP EMOJI
 */
 remove_action('wp_head', 'print_emoji_detection_script', 7);
 remove_action('wp_print_styles', 'print_emoji_styles');
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );

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
 * Register options page
 */
 if( function_exists('acf_add_options_page') ) {
 	acf_add_options_page(array(
 		'page_title' 	=> 'Frontier 800 Schedule',
 		'menu_title'	=> 'Frontier 800 Schedule',
 		'menu_slug' 	=> 'schedule-settings',
 		'capability'	=> 'manage_options',
 		'redirect'		=> false
 	));
}


/**
 * Frontier 800 schedule shortcode
 */
add_shortcode('frontier-800-schedule', function($atts) {
	$regular = get_field('regular_schedule', 'option');

  $today = strtotime(current_time('Y-m-d'));
  $dayofweek = date('N', $today);

  $status = get_day_status($today);

  // If it's closed, when will it reopen?
  if ($status['closed'] == true) {
    $i = 1;

    $closed = $status['closed'];
    // Loop through upcoming days until it's open again
    while ($closed == true) {
      $day = strtotime("+$i Days", current_time('timestamp'));
      $nextopen = get_day_status($day);
      $closed = $nextopen['closed'];
      $i++;
    }

    $openday = date('l, F j, Y', $nextopen['schedule']);

    $schedule = "{$status['schedule']} We'll reopen at {$regular['open']} on $openday. Our regular hours on Mondays-Fridays are from {$regular['open']} to {$regular['close']}.";
  } else {
    $schedule = "Frontier 800 is open weekdays from {$regular['open']} to {$regular['close']}.";
  }

  return $schedule;
});

function get_day_status($test) {
  $exceptions = get_field('closed_days', 'option');
  $closed = false;

  // Is it a holiday?
  foreach($exceptions as $exception) {
    $date = strtotime($exception['date']);
    if ($test == $date) {
      $closed = true;
      $schedule = "Frontier 800 is closed today, {$exception['date']} {$exception['reason']} {$exception['fill_in_the_blank']}.";
      break;
    }
  }

  // Is it the weekend?
  if ($dayofweek > 5) {
    $closed = true;
    $schedule = 'Frontier 800 is closed for the weekend.';
  }

  if (!$closed) {
    $schedule = $test;
  }

  return array('closed' => $closed, 'schedule' => $schedule);
}

/**
 * Event Space Features Shortcode
 */
 add_shortcode('event-space', function($atts) {
   $features = shortcode_atts( array(
		'wifi' => '',
    'whiteboard' => '',
    'tv' => '',
    'hdmi' => '',
    'screen' => '',
    'projector' => '',
		'microphone' => '',
		'podium' => '',
    'layouts' => '',
		'sofa' => '',
    'seats' => ''
	), $atts );

  ob_start();

  foreach ($features as $icon => $feature) {
    if (!empty($feature)) {
      echo '<span class="event-space-feature feature-icon-'.$icon.'">'.$feature.'</span>';
    }
  }

  return ob_get_clean();
 });
