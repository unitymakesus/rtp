<?php

namespace App;

/**
* Theme customizer
*/
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {

});

/**
* Customizer JS
*/
add_action('customize_preview_init', function () {
  // wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

add_action('customize_controls_enqueue_scripts', function () {
  // wp_enqueue_script('sage/customizer-panel.js', asset_path('scripts/customizer-panel.js'), [], null, true);
});
