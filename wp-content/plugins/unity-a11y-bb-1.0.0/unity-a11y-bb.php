<?php
/**
 * Plugin Name:       Unity Accessible Modules
 * Plugin URI:        https://github.com/unitymakesus/unity-a11y-bb
 * Description:       Custom, accessible modules for our page builder.
 * Version:           1.0.0
 * Author:            Unity Web Agency
 * Author URI:        https://unitywebagency.com
 * GitHub Plugin URI: unitymakesus/unity-a11y-bb
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       unity-a11y-bb
 * Domain Path:       /languages
 */

define('UNITY_A11Y_BB_VERSION', '1.0.0');
define('UNITY_A11Y_BB_DIR', plugin_dir_path(__FILE__));
define('UNITY_A11Y_BB_URL', plugins_url('/', __FILE__ ));

/**
 * Check for required WordPress plugins.
 *
 * @since    1.0.0
 */
add_action('admin_notices', function () {
    $requires = [];

    if (!is_plugin_active('bb-plugin/fl-builder.php')) {
        $required[] = [
            'link' => 'https://www.wpbeaverbuilder.com/',
            'name' => __('Beaver Builder', 'unity-a11y-bb'),
        ];
    }

    if (!empty($required)) {
        foreach ($required as $req) {
            ?>
            <div class="notice notice-error"><p>
                <?php printf(__('<b>%s Plugin</b>: <a href="%s" target="_blank" rel="noreferrer noopener">%s</a> must be installed and activated.', 'unity-a11y-bb'), __('Unity Accessible Modules', 'unity-a11y-bb'), $req['link'], $req['name']); ?>
            </p></div>
            <?php
        }
        deactivate_plugins(plugin_basename(__FILE__));
    }
});

/**
 * Instantiate our Beaver Builder module classes.
 *
 * @since    1.0.0
 */
add_action('init', function() {
    if (!class_exists('JsonManifest')) {
        require_once UNITY_A11Y_BB_DIR . 'classes/class-json-manifest.php';
    }

    if (class_exists('FLBuilder')) {
        require_once UNITY_A11Y_BB_DIR . 'modules/unity-jump-link/unity-jump-link.php';
        require_once UNITY_A11Y_BB_DIR . 'modules/unity-modaal/unity-modaal.php';
        require_once UNITY_A11Y_BB_DIR . 'modules/unity-modaal-gallery/unity-modaal-gallery.php';
    }
});

