<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }

require_once( SECSAFE_DIR_ADMIN_TABLES . '/Table.php' );

/**
 * Class TableAllowDeny
 * @package SecuritySafe
 */
final class TableAllowDeny extends Table {


    /**
     * Set the type of data to display
     * 
     * @since  2.0.0
     */
    protected function set_type() {

        $this->type = 'allow_deny';

    } // set_type()

    /**
     * Get a list of columns. The format is:
     * 'internal-name' => 'Title'
     *
     * @package WordPress
     * @since 3.1.0
     * @abstract
     *
     * @return array
     */
    function get_columns() {
        
        return [
            'cb'            => '<input type="checkbox" />',
            'date'          => __( 'Date Added', SECSAFE_SLUG ),
            'date_expire'   => __( 'Expires', SECSAFE_SLUG ),
            'ip'            => __( 'IP Address', SECSAFE_SLUG ),
            'status'        => __( 'Status', SECSAFE_SLUG ),
            'details'       => __( 'Details', SECSAFE_SLUG )
        ];

    } // get_columns()


    /**
     * Get the array of searchable columns in the database
     * @since  2.0.0
     * @return  array An unassociated array.
     */ 
    protected function get_searchable_columns() {
        
        return [ 
            'ip' 
        ];

    } // get_searchable_columns()


    /**
     * Get an associative array ( option_name => option_title ) with the list
     * of bulk actions available on this table.
     *
     * @package WordPress
     * @since 3.1.0
     *
     * @return array
     */
    function get_bulk_actions() {

        return [ 
            'delete' => __( 'Delete', SECSAFE_SLUG )
        ];

    } // get_bulk_actions()


    function extra_tools() {

        $this->add_ip_form();
        $this->search_box( __( 'Search IPs', SECSAFE_SLUG ), 'log' );

    } // extra_tools


    /**
     * Creates Add IP form for the Allow/Deny table
     * @return  html
     */ 
    protected function add_ip_form() {

        echo '<p class="add_ip_form"><input name="ip" type="text" value="" placeholder="' . __( 'IP Address', SECSAFE_SLUG ) . '"><select name="ip_rule"><option value="">- ' . __( 'Rule', SECSAFE_SLUG ) . ' -</option><option value="allow">' . __( 'allow', SECSAFE_SLUG ) . '</option><option value="deny">' . __( 'deny', SECSAFE_SLUG ) . '</option></select><select name="ip_expire"><option value="">- ' . __( 'Expires', SECSAFE_SLUG ) . ' -</option><option value="1">1 ' . __( 'day', SECSAFE_SLUG ) . '</option><option value="3">3 ' . __( 'days', SECSAFE_SLUG ) . '</option><option value="7">7 ' . __( 'days', SECSAFE_SLUG ) . '</option><option value="30">1 ' . __( 'month', SECSAFE_SLUG ) . '</option><option value="90">3 ' . __( 'months', SECSAFE_SLUG ) . '</option><option value="180">6 ' . __( 'months', SECSAFE_SLUG ) . '</option><option value="999">' . __( 'never', SECSAFE_SLUG ) . '</option></select><input type="submit" name="ip_submit" class="button" value="' . __( 'Add IP', SECSAFE_SLUG ) . '" /></p>';

    } // add_ip_form()


    /**
     * Handles the logic for adding an IP allow/deny rule to db
     */ 
    function add_ip() {

        global $wpdb, $SecuritySafe;

        if ( isset( $_REQUEST['ip'] ) && isset( $_REQUEST['ip_rule'] ) && isset( $_REQUEST['ip_expire'] ) ){

            $ip = filter_var( $_REQUEST['ip'], FILTER_VALIDATE_IP );
            $expire = filter_var( $_REQUEST['ip_expire'], FILTER_VALIDATE_INT );

            if ( $ip && $expire !== false) {

                // Valid IP Address
                
                $args = array();
                $args['date_expire'] = ( $expire == '999' ) ? '0000-00-00 00:00:00' : date( 'Y-m-d H:i:s', strtotime( "+". abs( $expire ) . " day" ) );
                $args['date'] = current_time('mysql');
                $args['ip'] = $ip;
                $args['status'] = ( $_REQUEST['ip_rule'] == 'deny' ) ? 'deny' : 'allow';
                $args['type'] = $type = 'allow_deny'; // Sanitized
                $table_main = Yoda::get_table_main(); // Sanitized

                $result = $this->is_ip_whitelisted( $ip );

                if ( $result ) {

                    $SecuritySafe->messages[] = [ __( 'IP address is already in the database.', SECSAFE_SLUG ), 2, 0 ];

                } else {

                    // Add data to DB and insert() is sanitized by WP
                    $wpdb->insert( $table_main, $args );

                    $SecuritySafe->messages[] = [ $ip . ' - ' . __( 'IP address added with ' . $args['status'] . ' rule.', SECSAFE_SLUG ), 0, 0 ];

                }

            } else {

                $SecuritySafe->messages[] = [ __( 'IP address or expiration not valid.', SECSAFE_SLUG ), 3, 0 ];

            }

        } else {

            if ( isset( $_REQUEST['ip'] ) ) {

                if ( !isset( $_REQUEST['ip_rule'] ) ) {

                    $SecuritySafe->messages[] = [ __( 'IP Addition failed. Rule not provided.', SECSAFE_SLUG ), 3, 0 ];

                } else if ( !isset( $_REQUEST['ip_expire'] ) ) {

                    $SecuritySafe->messages[] = [ __( 'IP Addition failed. Expiration not provided.', SECSAFE_SLUG ), 3, 0 ];

                }

            }

        }

        // Display Messages
        $SecuritySafe->display_notices();
        
    } // add_ip()


    protected function is_ip_whitelisted( $ip ) {

        global $wpdb;

        $ip = filter_var( $ip, FILTER_VALIDATE_IP );
        $table_main = Yoda::get_table_main(); // Sanitized

        // Verify the IP is not already in db
        $query = $wpdb->prepare( "SELECT ip FROM $table_main WHERE type = 'allow_deny' AND ip = '%s' LIMIT 1", $ip );
        $result = $wpdb->get_results( $query, ARRAY_A );

        return $result;

    } // is_ip_whitelisted()


    public function check_whitelist() {

        global $SecuritySafe;

        $ip = Yoda::get_ip();

        if ( $ip != '::1' ) {

            $whitelisted = $this->is_ip_whitelisted( $ip );

            if ( ! $whitelisted ) {

                $SecuritySafe->messages[] = [ __('Your IP', SECSAFE_SLUG ) . ': ' . $ip . ' - ' . __( 'We recommend adding your IP to the whitelist using the form below.', SECSAFE_SLUG ), 2, 0 ];

                // Display Messages
                $SecuritySafe->display_notices();
            }

        }

    } // check_whitelist()


} // TableAllowDeny()
