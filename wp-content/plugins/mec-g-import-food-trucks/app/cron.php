<?php

/**
 *  Customize cron job from Modern Events Calendar plugin
 *  @link /wp-content/plugins/modern-events-calendar/app/crons/g-import.php
 */

/**
 * Initialize WP
 * @return string     WP Base Path
 */
function mecft_find_wordpress_base_path()
{
    $dir = dirname(__FILE__);

    do
    {
        if(file_exists($dir.'/wp-config.php')) return $dir;
    }
    while($dir = realpath($dir.'/..'));

    return NULL;
}

define( 'BASE_PATH', mecft_find_wordpress_base_path().'/' );
define( 'WP_USE_THEMES', false );

global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require BASE_PATH . 'wp-load.php';
require_once dirname( __FILE__ ) . '/import.php';

$options = get_option('mecft_connect');

/*
 Exit if cron is disabled
 */
if(!isset($options['mecft_connect_enable_cron']) or (isset($options['mecft_connect_enable_cron']) and !$options['mecft_connect_enable_cron'])) exit(__('Auto Google Calendar import is disabled!', 'mecft'));

mecft_import();

exit(__('Success!', 'mecft'));
