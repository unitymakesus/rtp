<?php
/**
 * Plugin Name:       Custom Modules (Hub RTP)
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

define('CBB_HUB_VERSION', '1.0.0');
define('CBB_HUB_DIR', plugin_dir_path(__FILE__));
define('CBB_HUB_URL', plugins_url('/', __FILE__ ));

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
            'name' => __('Beaver Builder', 'cbb-hub-rtp'),
        ];
    }

    if (!empty($required)) {
        foreach ($required as $req) {
            ?>
            <div class="notice notice-error"><p>
                <?php printf(__('<b>%s Plugin</b>: <a href="%s" target="_blank" rel="noreferrer noopener">%s</a> must be installed and activated.', 'cbb-hub-rtp'), __('Cutom Modules Hub RTP', 'cbb-hub-rtp'), $req['link'], $req['name']); ?>
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
        require_once CBB_HUB_DIR . 'classes/class-json-manifest.php';
    }

    if (class_exists('FLBuilder')) {
        require_once CBB_HUB_DIR . 'modules/blog-feed/blog-feed.php';
        require_once CBB_HUB_DIR . 'modules/carousel/carousel.php';
    }
});

