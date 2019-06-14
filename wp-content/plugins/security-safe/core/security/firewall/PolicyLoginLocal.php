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

        if ( $setting ) {
            /**
             * @todo  hook into something better than init to be more acurate
             */ 
            add_action( 'init', array( $this, 'force_local' ) );

        }
        

	} // __construct()



    /**
     * This forces the user to actually be on the website when authenticating.
     * @since  0.2.0
     */ 
    function log_threats() {

        $this->setting_on = true;
        $this->force_local();

    } // log_threats()


    /**
     * This forces the user to actually be on the website when authenticating.
     * @since  0.2.0
     */ 
    function force_local() {

        // If Attempt to Login
        if ( strpos( $_SERVER['REQUEST_URI'], 'wp-login.php' ) !== false && isset( $_POST['log'] ) && isset( $_POST['pwd'] ) ) {

            $args = [];
            $args['type'] = 'logins';

            // If Refferrer is not set or does not contain site's domain name
            if ( ! isset( $_SERVER['HTTP_REFERER'] ) || ! $_SERVER['HTTP_REFERER'] ) {

                $args['details'] = 'Empty REFERER in server headers. [' . __LINE__ . ']';
                $this->block( $args );

            } else if ( ! isset( $_SERVER['HTTP_HOST'] ) || ! $_SERVER['HTTP_HOST'] ) {

                $args['details'] = 'Empty HOST in server headers. [' . __LINE__ . ']';
                $this->block( $args );
                
            } else if ( strpos( $_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'] ) === false ) {

                $args['details'] = 'REFERER is not from HOST. [' . __LINE__ . ']';
                $this->block( $args );

            }

        } // login

    } // force_local()


} // PolicyLoginLocal()
