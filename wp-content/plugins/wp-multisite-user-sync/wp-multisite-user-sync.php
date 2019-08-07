<?php
/*
Plugin Name: WP Multisite User Sync
Description: This plugin can sync/unsync users from one site (blog) to the other sites (blogs) in your WordPress Multisite network.
Version:     1.1.0
Author:      Obtain Infotech
Author URI:  http://www.obtaininfotech.com/
License:     GPL2
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'restricted access' );
}

if ( ! function_exists( 'wmus_admin_include_css_and_js' ) ) {
    add_action( 'admin_enqueue_scripts', 'wmus_admin_include_css_and_js' );
    function wmus_admin_include_css_and_js() {
        
        /* admin script */
        wp_register_script( 'wmus-script', plugin_dir_url( __FILE__ ) . 'assets/js/wmus-script.js', array( 'jquery' ) );
        wp_enqueue_script( 'wmus-script' );
    }
}

if ( ! function_exists( 'wmus_user_sync_unsync' ) ) {
    add_action( 'show_user_profile', 'wmus_user_sync_unsync' );
    add_action( 'edit_user_profile', 'wmus_user_sync_unsync' );
    function wmus_user_sync_unsync() {
        
        global $wpdb;
        
        $current_user = wp_get_current_user();  
        if ( $current_user != null ) {
            $current_user_role = $current_user->roles[0];
        } 

        $wmus_user_roles = get_site_option( 'wmus_user_roles' );
        if ( ! $wmus_user_roles ) {
            $wmus_user_roles = array();
        }
        
        if ( is_super_admin() || ( in_array( $current_user_role, $wmus_user_roles ) ) ) {
        ?>
            <h2><?php _e( 'WP  Multisite User Sync' ); ?></h2>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label><?php _e( 'Sync/Unsync?' ); ?></label></th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="wmus_sync_unsync" value="<?php echo esc_attr( '1' ); ?>" checked="checked" /><?php _e( 'Sync' ); ?>
                                </label>
                                <label>
                                    <input type="radio" name="wmus_sync_unsync" value="<?php echo esc_attr( '0' ); ?>" /><?php _e( 'Unsync' ); ?>
                                </label>
                            </fieldset>
                            <p class="description"><?php _e( 'Select sync/unsync.' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e( 'Sites' ); ?></label></th>
                        <td>
                            <label><input class="wmus-check-uncheck" type="checkbox" /><?php _e( 'All' ); ?></label>
                            <p class="description"><?php _e( 'Select/Deselect all sites.' ); ?></p>
                            <br>
                            <fieldset class="wmus-sites">
                                <?php
                                    $sites = $wpdb->get_results( "SELECT * FROM ".$wpdb->base_prefix."blogs" );                                       
                                    if ( $sites != null ) {
                                        $user_id = intval( $_REQUEST['user_id'] );
                                        foreach ( $sites as $key => $value ) {
                                            $checked = '';
                                            if ( is_user_member_of_blog( $user_id, $value->blog_id ) ) {
                                                $checked = ' checked="checked"';
                                            }

                                            $blog_details = get_blog_details( $value->blog_id );
                                            if ( ( $value->blog_id != get_current_blog_id() ) || ( is_network_admin() ) ) {
                                                ?>
                                                    <label><input name="wmus_blogs[]" type="checkbox" value="<?php echo esc_attr( $value->blog_id ); ?>"<?php echo $checked; ?>><?php echo $value->domain; echo $value->path; echo ' ('.$blog_details->blogname.')'; ?></label><br>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </fieldset>
                            <p class="description"><?php _e( 'Select destination sites you want to sync/unsync.' ); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php
        }
    }
}

if ( ! function_exists( 'wmus_user_sync_unsync_update' ) ) {
    add_action( 'edit_user_profile_update', 'wmus_user_sync_unsync_update' );
    add_action( 'profile_update', 'wmus_user_sync_unsync_update' );
    function wmus_user_sync_unsync_update( $user ) { 
        
        $current_user = wp_get_current_user();  
        if ( $current_user != null ) {
            $current_user_role = $current_user->roles[0];
        } 

        $wmus_user_roles = get_site_option( 'wmus_user_roles' );
        if ( ! $wmus_user_roles ) {
            $wmus_user_roles = array();
        }
        
        if ( is_super_admin() || ( in_array( $current_user_role, $wmus_user_roles ) ) ) {
            $wmus_blogs = ( isset( $_REQUEST['wmus_blogs'] ) ? $_REQUEST['wmus_blogs'] : array() );
            $wmus_sync_unsync = ( isset( $_REQUEST['wmus_sync_unsync'] ) ? intval( $_REQUEST['wmus_sync_unsync'] ) : 1 );
            if ( $wmus_blogs != null ) {
                $user_info = get_userdata( $user );            
                $user_id = $user;
                $role = $user_info->roles;       
                if ( $role != null ) {
                    $role = $user_info->roles[0];
                } else {
                    $role = 'subscriber';
                }

                if ( isset( $_REQUEST['role'] ) && $_REQUEST['role'] != null ) {
                    $role = sanitize_text_field( $_REQUEST['role'] );
                }
                
                $roles = get_editable_roles();
                if ( array_key_exists( $role, $roles ) ) {
                    foreach ( $wmus_blogs as $wmus_blog ) {                
                        $blog_id = $wmus_blog;
                        if ( $wmus_sync_unsync ) {
                            add_user_to_blog( $blog_id, $user_id, $role );
                        } else {
                            remove_user_from_blog( $user_id, $blog_id );
                        }
                    }
                }
            }
        }
    }
}

if ( ! function_exists( 'wmus_add_network_admin_menu' ) ) {
    add_action( 'network_admin_menu', 'wmus_add_network_admin_menu' );
    function wmus_add_network_admin_menu() {
        
        add_menu_page( 'WordPress Multisite User Sync', 'User Sync', 'manage_options', 'wordpress-multisite-user-sync', 'wmus_settings', 'dashicons-update' );      
    }
}

if ( ! function_exists( 'wmus_settings' ) ) {
    function wmus_settings() {
        
        global $wpdb;
        if ( isset( $_REQUEST['wmus_submit'] ) ) {
            $request = $_REQUEST;
            unset( $request['page'] );
            unset( $request['wmus_submit'] );
            if ( $request != null ) {
                foreach ( $request as $key => $value ) {
                    update_site_option( $key, $value );
                }
            }
        }

        $wmus_user_roles = get_site_option( 'wmus_user_roles' );
        ?>
            <div class="wrap">
                <h2><?php _e( 'WP Multisite User Sync Settings' ); ?></h2>
                <form method="post"> 
                <h3><?php _e( 'General' ); ?></h3>
                <hr>
                <table class="form-table">
                    <tbody> 
                        <tr>
                            <th scope="row"><?php _e( 'User Roles' ); ?></th>
                            <td>
                                <fieldset>
                                    <?php
                                        $checked = '';
                                        if ( ! $wmus_user_roles ) {
                                            $checked = ' checked="checked"';
                                        }
                                    ?>
                                    <label><input name="wmus_user_roles" type="checkbox" value="0"<?php echo $checked; ?>><?php _e( 'None' ); ?></label><br>
                                    <?php
                                        $roles = get_editable_roles();
                                        if ( $roles != null ) {
                                            foreach ( $roles as $key => $value ) {
                                                if ( $key != 'subscriber' ) {
                                                    $checked = '';
                                                    if ( $wmus_user_roles && in_array( $key, $wmus_user_roles ) ) {
                                                        $checked = ' checked="checked"';
                                                    }
                                                    ?>
                                                        <label><input name="wmus_user_roles[]" type="checkbox" value="<?php echo $key; ?>"<?php echo $checked; ?>><?php echo $value['name']; ?></label><br>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>                                                                          				
                                </fieldset>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery( document ).ready( function( $ ) {
                        $( 'input[type="checkbox"]' ).on( 'change', function() {
                            if ( $( this ).val() != 0 ) {
                                var fieldset = $( this ).closest( 'fieldset' );
                                $( 'input[type="checkbox"]', fieldset ).each( function() {
                                    if ( $( this ).val() == 0 ) {
                                        $( this ).prop('checked', false);
                                    }
                                });
                            } else {
                                var fieldset = $( this ).closest( 'fieldset' );
                                $( 'input[type="checkbox"]', fieldset ).each( function() {
                                    if ( $( this ).val() != 0 ) {
                                        $( this ).prop('checked', false);
                                    }
                                });
                            }                        
                        });
                    });
                </script>                
                <p class="submit"><input name="wmus_submit" class="button button-primary" value="<?php _e( 'Save Changes' ); ?>" type="submit"></p>
                </form>
            </div>
        <?php
    }
}