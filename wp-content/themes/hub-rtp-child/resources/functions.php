<?php

namespace App;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  // Enqueue scripts and styles
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);
