<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }

/**
 * Class PolicyLoginLocal
 * @package SecuritySafe
 */
class PolicyLoginLocal extends Firewall {

    var $setting_on = false;

    /**
     * PolicyLoginLocal constructor.
     */
	function __construct( $setting = false ) {

        // Run parent class constructor first
        parent::__construct();

        if ( $setting && ! defined('XMLRPC_REQUEST') ) {

            add_action( 'login_form', [ $this, 'add_nonce' ] );
            add_filter( 'authenticate', [ $this, 'verify_nonce' ], 30, 3 );

        }
        

	} // __construct()


    /**
     * This adds a nonce to the login form.
     * @since  2.2.0
     */ 
    function add_nonce() {

        wp_nonce_field( 'login-local-' . SECSAFE_SLUG );

    } // add_nonce()


    /**
     * Verifies the nonce
     * @since  2.2.0
     */ 
    function verify_nonce( $user, $username, $password ) {

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            $nonce = ( isset( $_POST['_wpnonce'] ) ) ? $_POST['_wpnonce'] : false;

            if ( ! $nonce ) {

                $error = __( 'Error: Local login required and Nonce missing.', SECSAFE_SLUG ) . '[' . __LINE__ . ']';
            
            } else if ( ! isset( $_POST['_wp_http_referer'] ) ) {

                $error = __( 'Error: Local login required and Referer missing.', SECSAFE_SLUG ) . '[' . __LINE__ . ']';

            } else {

                // Check nonce
                if ( ! wp_verify_nonce( $nonce, 'login-local-' . SECSAFE_SLUG ) ) {

                    $error = __( 'Error: Local login required and Nonce not valid.', SECSAFE_SLUG ) . '[' . __LINE__ . ']';

                }
                
            }
        
            if ( isset( $error ) ) {

                $args = [];
                $args['type'] = 'logins';
                $args['details'] = $error;
                $args['username'] = filter_var( $username, FILTER_SANITIZE_STRING );

                // Block the attempt
                $this->block( $args );

            }

        }
     
        return $user;
    
    } // verify_nonce()


} // PolicyLoginLocal()
