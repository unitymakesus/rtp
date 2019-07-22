<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }


/**
 * Class PolicyLogLogins
 * @package SecuritySafe
 * @since  2.0.0
 */
class PolicyLogLogins extends Firewall {


    /**
     * PolicyLogLogins constructor.
     */
	function __construct() {

        // Run parent class constructor first
        parent::__construct();

        add_action( 'wp_login_failed', array( $this, 'failed' ) ); 
        add_action( 'wp_login', array( $this, 'success' ), 10, 2 ); 

	} // __construct()


    /**
     * Logs a Failed Login Attempt
     * @since  2.0.0
     * @uses  $this->record
     */
    public function failed( $username ) {

        $this->record( $username, 'failed' );

    } // failed()


    /**
     * Logs a successful login
     * @since  2.0.0
     * @uses  $this->record
     */
    public function success( $username, $user ) {

        $this->record( $username, 'success' );

    } // success()


    /**
     * Logs the login attempt.
     * @since  2.0.0
     */ 
    private function record( $username, $status ) {

        // Compatible with WP Super Cache and W3 Total Cache
        if( ! defined('DONOTCACHEPAGE') ) {

            define( 'DONOTCACHEPAGE', true );
        
        }

        $args = [];
        $args['type'] = 'logins';
        $args['username'] = $username;
        $args['status'] = ( $status == 'success' ) ? 'success' : 'failed';

        if ( defined('XMLRPC_REQUEST') ) {

            $args['threats'] = 1;

            $args['details'] = ( $args['status'] == 'failed' ) ? 'XML-RPC Login Attempt.' : 'XML-RPC Login Successful.';
            
        }

        // Check usernames
        $args['threats'] = ( isset( $args['threats'] ) ) ? $args['threats'] : Threats::is_username( $username );

        // Check Login
        $args['threats'] = ( $args['threats'] ) ? $args['threats'] : Threats::is_login( $username );

        // Log Login Attempt
        $this->add_entry( $args );

    } // record()


    /**
     * Checks if IP has been blacklisted and if so, prevents the login attempt.
     * @since  2.0.0
     * @uses  $this->block
     */
    public function blacklist_check() {

        // If attempt to Login
        if ( strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false && isset( $_POST['log'] ) && isset( $_POST['pwd'] ) ) {

            if ( Yoda::is_blacklisted() ) { 
                
                // Block display of any 404 errors
                $this->block( 'logins', 'IP is blacklisted. [' . __LINE__ . ']' );

            }

        }

    } // blacklist_check()


} // PolicyLogLogins()
