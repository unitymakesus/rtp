<?php
/**
 * Plugin Name:       Custom Modules (Boxyard RTP)
 * Plugin URI:
 * Description:
 * Version:           1.0.0
 * Author:            Unity Web Agency
 * Author URI:        https://unitywebagency.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cbb-hub-rtp
 * Domain Path:       /languages
 */

define( 'CBB_BOXYARD_MODULES_DIR', plugin_dir_path( __FILE__ ) );
define( 'CBB_BOXYARD_MODULES_URL', plugins_url( '/', __FILE__ ) );

/**
 * Define Required plugins
 */
function cbb_boxyard_require_plugins() {
  $requires = array();

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

function cbb_boxyard_check_required_plugins() {
  add_action( 'admin_notices', 'cbb_boxyard_require_plugins' );
}

add_action( 'admin_init', 'cbb_boxyard_check_required_plugins' );

function load_custom_boxyard_modules() {
  if ( class_exists( 'FLBuilder' ) ) {
    require_once 'modules/cbb-navigation-card/cbb-navigation-card.php';
    require_once 'modules/cbb-text-card/cbb-text-card.php';
    // require_once 'modules/cbb-today-feed/cbb-today-feed.php'; // TODO: Extend or remove based on need in project.
  }
}
add_action( 'init', 'load_custom_boxyard_modules' );

/**
 * Allowlist modules across Beaver Builder.
 *
 * @param boolean $enables
 * @param object $instance
 */
add_filter( 'fl_builder_register_module', function($enabled, $instance) {
  $allowlist = [
    'heading',
    'photo',
    'video',
    'button',
    'rich-text',
    'accordion',
    'html',
    'uabb-image-carousel',
    'cbb-navigation-card',
    'cbb-text-card',
    'cbb-today-feed',
    'uabb-info-list',
    'uabb-photo',
    'separator',
  ];

  if ( !in_array( $instance->slug, $allowlist ) ) {
    return false;
  }

  return $enabled;
}, 10, 2 );
