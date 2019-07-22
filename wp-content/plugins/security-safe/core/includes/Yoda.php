<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( !defined( 'ABSPATH' ) ) {
    die;
}
/**
 * Class Yoda - Whats up, Yoda knows.
 * @package SecuritySafe
 * @since 2.0.0
 */
class Yoda
{
    /**
     * Yoda constructor.
     */
    // Construct, Yoda does not.
    /** 
     * Constant variables, this method sets.
     * @since  2.0.0
     */
    static function set_constants()
    {
        define( 'SECSAFE_NAME', 'WP Security Safe' );
        define( 'SECSAFE_NAME_PRO', SECSAFE_NAME . ' Pro' );
        define( 'SECSAFE_SLUG', 'security-safe' );
        define( 'SECSAFE_OPTIONS', 'securitysafe_options' );
        define( 'SECSAFE_DB_FIREWALL', 'sovstack_logs' );
        define( 'SECSAFE_DB_STATS', 'sovstack_stats' );
        define( 'SECSAFE_DIR_SECURITY', SECSAFE_DIR_CORE . '/security' );
        define( 'SECSAFE_DIR_PRIVACY', SECSAFE_DIR_SECURITY . '/privacy' );
        define( 'SECSAFE_DIR_FIREWALL', SECSAFE_DIR_SECURITY . '/firewall' );
        define( 'SECSAFE_DIR_ADMIN', SECSAFE_DIR_CORE . '/admin' );
        define( 'SECSAFE_DIR_ADMIN_INCLUDES', SECSAFE_DIR_ADMIN . '/includes' );
        define( 'SECSAFE_DIR_ADMIN_PAGES', SECSAFE_DIR_ADMIN . '/pages' );
        define( 'SECSAFE_DIR_ADMIN_TABLES', SECSAFE_DIR_ADMIN . '/tables' );
        define( 'SECSAFE_DIR_LANG', dirname( plugin_basename( SECSAFE_FILE ) ) . '/languages/' );
        define( 'SECSAFE_URL', plugin_dir_url( SECSAFE_FILE ) );
        define( 'SECSAFE_URL_ASSETS', SECSAFE_URL . 'core/assets/' );
        define( 'SECSAFE_URL_ADMIN_ASSETS', SECSAFE_URL . 'core/admin/assets/' );
        define( 'SECSAFE_URL_AUTHOR', 'https://sovstack.com/' );
        define( 'SECSAFE_URL_MORE_INFO', 'https://wpsecuritysafe.com/' );
        define( 'SECSAFE_URL_MORE_INFO_PRO', admin_url( 'admin.php?page=security-safe-pricing' ) );
        define( 'SECSAFE_URL_TWITTER', 'https://twitter.com/wpsecuritysafe' );
        define( 'SECSAFE_URL_WP', 'https://wordpress.org/plugins/security-safe/' );
        define( 'SECSAFE_URL_WP_REVIEWS', SECSAFE_URL_WP . '#reviews' );
        define( 'SECSAFE_URL_WP_REVIEWS_NEW', SECSAFE_URL_WP . 'reviews/#new-post' );
    }
    
    // set_constants()
    /**
     * Retrieves the array of data types
     * @since  2.0.0
     */
    static function get_types()
    {
        return array(
            '404s',
            'logins',
            'comments',
            'allow_deny',
            'activity',
            'blocked',
            'threats'
        );
    }
    
    // get_types()
    /**
     * Retrieves the visitor's IP address
     * @since  2.0.0
     */
    static function get_ip()
    {
        $ip = false;
        if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && $_SERVER['HTTP_CLIENT_IP'] ) {
            $ip = filter_var( $_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP );
        }
        if ( !$ip && isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && $_SERVER['HTTP_X_FORWARDED_FOR'] ) {
            $ip = filter_var( $_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP );
        }
        if ( !$ip && isset( $_SERVER['HTTP_X_FORWARDED'] ) && $_SERVER['HTTP_X_FORWARDED'] ) {
            $ip = filter_var( $_SERVER['HTTP_X_FORWARDED'], FILTER_VALIDATE_IP );
        }
        if ( !$ip && isset( $_SERVER['HTTP_FORWARDED_FOR'] ) && $_SERVER['HTTP_FORWARDED_FOR'] ) {
            $ip = filter_var( $_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP );
        }
        if ( !$ip && isset( $_SERVER['HTTP_FORWARDED'] ) && $_SERVER['HTTP_FORWARDED'] ) {
            $ip = filter_var( $_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP );
        }
        if ( !$ip && isset( $_SERVER['REMOTE_ADDR'] ) && $_SERVER['REMOTE_ADDR'] ) {
            $ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP );
        }
        if ( !$ip ) {
            $ip = 'UNKNOWN';
        }
        return $ip;
    }
    
    // get_ip()
    /**
     * Gets the User Agent of the current session
     * @since  2.1.0
     */
    static function get_user_agent()
    {
        $ua = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '' );
        $ua = ( defined( 'DOING_CRON' ) ? 'WP Cron' : $ua );
        return $ua;
    }
    
    // get_user_agent()
    static function is_whitelisted()
    {
        return defined( 'SECSAFE_WHITELISTED' );
    }
    
    // is_whitelisted()
    static function is_blacklisted()
    {
        return defined( 'SECSAFE_BLACKLISTED' );
    }
    
    // is_blacklisted()
    /**
     * Retrieves the name of the table for firewall
     * @since  2.0.0
     */
    static function get_table_main()
    {
        global  $wpdb ;
        return $wpdb->prefix . SECSAFE_DB_FIREWALL;
    }
    
    // get_table_main()
    /**
     * Retrieves the name of the table for stats
     * @since  2.0.0
     */
    static function get_table_stats()
    {
        global  $wpdb ;
        return $wpdb->prefix . SECSAFE_DB_STATS;
    }
    
    // get_table_stats()
    /**
     * Retrieves the limit of data types
     * @since  2.0.0
     */
    static function get_display_limits( $type, $mx = false )
    {
        Janitor::log( 'get_display_limits()' );
        
        if ( in_array( $type, Self::get_types() ) ) {
            Janitor::log( 'get_display_limits(): Valid Type' );
            $limits = array(
                '404s'       => 500,
                'logins'     => 100,
                'allow_deny' => 10,
                'activity'   => 1000,
            );
            return $limits[$type];
        }
        
        Janitor::log( 'get_display_limits(): Default' );
        // Default lowest value / false
        return 0;
    }

}
// Yoda()