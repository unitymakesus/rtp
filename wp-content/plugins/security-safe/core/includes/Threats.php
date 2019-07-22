<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }


/**
 * Class Threats.
 * @package SecuritySafe
 * @since 2.0.0
 */
class Threats {

    /**
     * Determines if the username is a threat
     * @since  2.0.0
     * @return  boolean
     */ 
    public static function is_username( $username ) {

        $bad = [
            'admin' => '',
            'administrator' => '',
            'wordpress' => '',
            'manager' => '',
            'adm' => '',
            'admin1' => '',
            'hostname' => '',
            'qwerty' => '',
            'root' => '',
            'support' => '',
            'sysadmin' => '',
            'test' => '',
            'testuser' => '',
            'user' => '',
        ];

        return isset( $bad[ $username ] ) ? 1 : 0;

    } // is_username()

    /**
     * Determines if the filename is a threat
     * @since  2.0.0
     * @return  boolean
     */ 
    public static function is_filename( $filename ) {

        $threat = 0;

        if ( strpos( $filename, '.' ) !== false ) {

            $matches_name = [
                'wp-config',
                'readme',
                'webconfig',
                'cgi-bin'
            ];

            // Check for filename matches
            foreach ( $matches_name as $key => $name ) {

                $threat = ( strpos( $filename, $name ) !== false ) ? 1 : $threat;

                if ( $threat ) { break; }

            } // foreach()

            // Check File Extentions
            if ( ! $threat ) {

                $length = strlen( $filename );
                $ext_len = [ 4, 5, 7, 3 ]; // ordered in popularity
                $ext = false;

                $matches_ext = [
                    '.zip' => '', // 4
                    '.bzip' => '', // 5
                    '.tar'  => '', // 4
                    '.tar.gz' => '', // 7
                    '.gz'   => '', // 3
                    '.bak' => '' // 4
                ];

                foreach( $ext_len as $l ) {

                    if ( $length >= $l ) {

                        $ext = substr( $filename, -$l );

                        $threat = ( isset( $matches_ext[ $ext ] ) ) ? 1 : $threat;

                        if ( $threat ) { break; }

                    }

                } // foreach()

            }

        }

        return $threat;

    } // is_filename()


    /**
     * Determines if the filename is a threat
     * @since  2.0.0
     * @return  boolean
     */ 
    public static function is_uri( $uri ) {

        /**
         * @todo finish detect uri threats 
         */

        return 0;

    } // is_uri()


    /**
     * Determines if the 404 error is a threat
     * @since  2.0.0
     * @return  boolean
     */ 
    public static function is_404() {

        $uri = filter_var( $_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL );

        $filename = explode( '/', $uri );
        $filename = end( $filename );

        $threat = Threats::is_filename( $filename );

        if ( ! $threat ) {

            // Check if the uri matches sketchy patterns
            $threat = Threats::is_uri( $uri );
        
        }
        
        return $threat;

    } // is_404()


    /**
     * This forces the user to actually be on the website when authenticating.
     * @since  0.2.0
     */ 
    public static function is_login() {

        if ( ! isset( $_SERVER['HTTP_HOST'] ) || ! $_SERVER['HTTP_HOST'] ) {

            // If Host is not set
            return 1;
        
        } else if ( ! isset( $_SERVER['HTTP_REFERER'] ) || ! $_SERVER['HTTP_REFERER'] ) {

            // If Refferrer is not set
            return 1;

        } else if ( strpos( $_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME'] ) === false ) {

            // If Refferrer does not contain site's domain name
            return 1;

        }

        // Default No
        return 0;

    } // is_login()


} // Threats()
