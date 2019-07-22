<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( !defined( 'ABSPATH' ) ) {
    die;
}
/**
 * Class Admin
 * @package SecuritySafe
 */
class Admin extends Security
{
    protected  $page ;
    /**
     * Admin constructor.
     */
    function __construct( $session )
    {
        // Run parent class constructor first
        parent::__construct( $session );
        $this->check_settings();
        // Display Admin Notices
        add_action( 'admin_notices', [ $this, 'display_notices' ] );
        // Load CSS / JS
        add_action( 'admin_init', [ $this, 'scripts' ] );
        // Body Class
        add_filter( 'admin_body_class', [ $this, 'admin_body_class' ] );
        // Create Admin Menus
        add_action( 'admin_menu', [ $this, 'admin_menus' ] );
        // Add Action Links
        add_filter( 'network_admin_plugin_action_links_security-safe/security-safe.php', [ $this, 'plugin_action_links' ] );
        add_filter( 'plugin_action_links_security-safe/security-safe.php', [ $this, 'plugin_action_links' ] );
    }
    
    // __construct()
    /**
     * Initializes admin scripts
     */
    public function scripts()
    {
        global  $pagenow ;
        $local_page = false;
        
        if ( isset( $_GET['page'] ) ) {
            // See if the page is one of ours
            $local_page = strpos( $_GET['page'], SECSAFE_SLUG );
            // Only load CSS and JS for our admin pages.
            
            if ( $local_page !== false ) {
                // Load CSS
                wp_register_style(
                    SECSAFE_SLUG . '-admin',
                    SECSAFE_URL_ADMIN_ASSETS . 'css/admin.css',
                    [],
                    SECSAFE_VERSION,
                    'all'
                );
                wp_enqueue_style( SECSAFE_SLUG . '-admin' );
                // Load JS
                wp_enqueue_script( 'common' );
                wp_enqueue_script( 'wp-lists' );
                wp_enqueue_script( 'postbox' );
                wp_enqueue_script(
                    SECSAFE_SLUG . '-admin',
                    SECSAFE_URL_ADMIN_ASSETS . 'js/admin.js',
                    [ 'jquery' ],
                    SECSAFE_VERSION,
                    true
                );
            }
            
            // $local_page
        }
    
    }
    
    //scripts()
    /**
     * Adds a class to the body tag
     * @since  0.2.0
     */
    public function admin_body_class( $classes )
    {
        $classes .= ' ' . SECSAFE_SLUG;
        return $classes;
    }
    
    // admin_body_class()
    /**
     * Creates Admin Menus
     */
    public function admin_menus()
    {
        $page = [];
        // Add the menu page
        $page['menu_title'] = SECSAFE_NAME;
        $page['title'] = SECSAFE_NAME . ' Dashboard';
        $page['capability'] = 'activate_plugins';
        $page['slug'] = SECSAFE_SLUG;
        $page['function'] = [ $this, 'page_dashboard' ];
        $page['icon_url'] = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iODMuNDExcHgiIGhlaWdodD0iOTQuMTNweCIgdmlld0JveD0iMC4wMDEgMzQ4LjkzNSA4My40MTEgOTQuMTMiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMC4wMDEgMzQ4LjkzNSA4My40MTEgOTQuMTMiDQoJIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPHBhdGggZmlsbD0iI0YyNjQxOSIgZD0iTTgzLjI3MSwzNTYuODk2YzAsMC0yMC41NjItNy45NjEtNDEuNjI4LTcuOTYxYy0yMS4wNjcsMC00MS42MjksNy45NjEtNDEuNjI5LDcuOTYxDQoJCXMtMC43OTUsMzAuMDMsMTAuMDMyLDUxLjgwNGMxMC44MjUsMjEuNzcxLDMyLjA5OSwzNC4zNjUsMzIuMDk5LDM0LjM2NXMyMS4wNzgtMTMuMjI3LDMyLjEtMzYuODU0DQoJCUM4NS4yNjYsMzgyLjU4MSw4My4yNzEsMzU2Ljg5Niw4My4yNzEsMzU2Ljg5NnogTTUuMjksMzYxLjgxNGwwLjAzOC0xLjQ4M2wxLjQwNi0wLjQ4MWMwLjQ0OS0wLjE1NCw3LjQzMS0yLjUwNywxNi45NTktNC4xOQ0KCQljLTIuMTU0LDEuMjcxLTQuMjQ0LDIuNzc1LTUuNjQyLDMuODk5Yy01LjU0OSw0LjQ1NC0xMC4wMTgsOS4wOTktMTIuNDg4LDExLjgzMUM1LjIwMSwzNjUuOTM1LDUuMjgsMzYyLjIwOSw1LjI5LDM2MS44MTR6DQoJCSBNNi4wMTIsMzc2LjYzMWMyLjQ2OCwyLjM1LDYuODU1LDUuNzk1LDEzLjc2Nyw4Ljg2OWMxMS40MDgsNS4wNzIsMjEuODIyLDcuMTc2LDIxLjgyMiw3LjE3NnM4LjgxLTIuNTYxLDE4LjA2MS03LjkyNg0KCQlzMTEuNTI2LTcuNTg4LDExLjUyNi03LjU4OHMtMTMuMjkzLDAuNzA3LTI0LjA4LTEuMTQ5Yy0xMi45MTktMi4yMjQtMTcuMzI1LTUuNDQtMTcuMzI1LTUuNDRzNC40MDYtNC4wNjIsMTAuNDI1LTcuNjY2DQoJCWM2LjMxNC0zLjc3NywxMy45MzctNi43NDIsMTYuNTQ1LTcuNzA5YzEwLjkzOCwxLjY3NiwxOS4yNzMsNC40ODQsMTkuNzY0LDQuNjUzbDEuMzM2LDAuNDU0bDAuMTA0LDEuNDA4DQoJCWMwLjAzMywwLjQ1NSwwLjQxMyw2LjAwMi0wLjMwNCwxMy44NzljLTIuNzUyLDIuNjUtMTMuMzc0LDEyLjAzMS0zMi41OTgsMTkuMTk5Yy0xOC4zNTQsNi44NDQtMjkuOTA2LDguNzU2LTMyLjQ4NCw5LjEyNQ0KCQlDOC42OTUsMzk0Ljk2Myw2Ljg2NiwzODQuNzYsNi4wMTIsMzc2LjYzMXogTTY5LjMyLDQwNi40ODljLTMuODQ4LDIuNDA2LTEyLjA2Nyw3LjA2MS0yMy41MzQsMTAuOTENCgkJYy0xMi41NDYsNC4yMTUtMTguNDY4LDUuMzAxLTIwLjM1OSw1LjU2NmMtMC42OTMtMC43MjktMS4zODUtMS40OTQtMi4wNzUtMi4yODVjMi40MDUtMC41OTIsMTEuNzkzLTIuOTk4LDIzLjkwMy03LjM0Ng0KCQljMTEuMDU4LTMuOTY5LDIwLjU1NS05LjgyNiwyNC42MTctMTIuNTFjLTAuNDczLDEuMTg4LTAuOTc5LDIuMzc3LTEuNTI2LDMuNTU3QzcwLjAxNCw0MDUuMDk4LDY5LjY3LDQwNS43OTcsNjkuMzIsNDA2LjQ4OXoiLz4NCjwvZz4NCjwvc3ZnPg0K';
        $page['position'] = '999';
        add_menu_page(
            $page['title'],
            $page['menu_title'],
            $page['capability'],
            $page['slug'],
            $page['function'],
            $page['icon_url'],
            $page['position']
        );
        $this->add_submenu_pages( $page );
    }
    
    //admin_menus()
    /**
     * Get all admin pages as an array
     * @return  array An array of all the admin pages
     * @uses  get_category_pages()
     * @since  0.1.0
     */
    private function get_admin_pages()
    {
        // All Admin Pages
        return $this->get_category_pages();
    }
    
    // get_admin_pages()
    /**
     * Get Category Pages
     * @return  $pages array
     * @since  0.2.0
     */
    private function get_category_pages( $disabled = false )
    {
        // All Category Pages
        $pages = [
            'plugin'      => __( 'Plugin', SECSAFE_SLUG ),
            'privacy'     => __( 'Privacy', SECSAFE_SLUG ),
            'files'       => __( 'Files', SECSAFE_SLUG ),
            'user-access' => __( 'User Access', SECSAFE_SLUG ),
            'content'     => __( 'Content', SECSAFE_SLUG ),
            'firewall'    => __( 'Firewall', SECSAFE_SLUG ),
        ];
        // Remove Specific Menus
        if ( !$disabled ) {
            unset( $pages['plugin'] );
        }
        return $pages;
    }
    
    // get_category_pages()
    /**
     * Creates all the subpages for the menu
     * @param array $subpages
     * @since  0.1.0
     */
    private function add_submenu_pages( $page = false )
    {
        $subpages = $this->get_admin_pages();
        foreach ( $subpages as $slug => $title ) {
            $slug_uscore = str_replace( '-', '_', $slug );
            add_submenu_page(
                $page['slug'],
                // Parent Slug
                $page['menu_title'] . ' ' . $title,
                // Page Title
                $title,
                // Menu Title
                $page['capability'],
                // Capability
                $page['slug'] . '-' . $slug,
                // Menu Slug
                [ $this, 'page_' . $slug_uscore ]
            );
        }
    }
    
    // add_submenu_pages()
    /**
     * Gets the admin page
     * @param  string $title The title of the submenu
     * @since  0.2.0
     */
    private function get_page( $page_slug = false )
    {
        
        if ( $page_slug ) {
            // Format Title
            $title_camel = str_replace( ' ', '', $page_slug );
            // Include Admin Page
            require_once SECSAFE_DIR_ADMIN_PAGES . '/AdminPage.php';
            require_once SECSAFE_DIR_ADMIN_PAGES . '/AdminPage' . $title_camel . '.php';
            // Class For The Page
            $class = __NAMESPACE__ . '\\AdminPage' . $title_camel;
            $page_slug = strtolower( $page_slug );
            // Get Page Specific Settings
            $page_settings = $this->settings[$page_slug];
            
            if ( is_array( $page_settings ) ) {
                $this->page = new $class( $page_settings );
                $this->display_page();
            }
            
            // is_array()
        } else {
            Janitor::log( 'ERROR: Parameter title is empty.', __FILE__, __LINE__ );
        }
    
    }
    
    // get_page()
    /**
     * Wrapper for creating Dashboard page
     * @since  0.1.0
     */
    public function page_dashboard()
    {
        $this->get_page( 'General' );
    }
    
    // page_dashboard()
    /**
     * Wrapper for creating Privacy page
     * @since  0.2.0
     */
    public function page_privacy()
    {
        $this->get_page( 'Privacy' );
    }
    
    // page_privacy()
    /**
     * Wrapper for creating Files page
     * @since  0.2.0
     */
    public function page_files()
    {
        $this->get_page( 'Files' );
    }
    
    // page_files()
    /**
     * Wrapper for creating Content page
     * @since  0.2.0
     */
    public function page_content()
    {
        $this->get_page( 'Content' );
    }
    
    // page_content()
    /**
     * Wrapper for creating User Access page
     * @since  0.2.0
     */
    public function page_user_access()
    {
        $this->get_page( 'Access' );
    }
    
    // page_user_access()
    /**
     * Wrapper for creating Firewall page
     * @since  0.2.0
     */
    public function page_firewall()
    {
        $this->get_page( 'Firewall' );
    }
    
    // page_firewall()
    /**
     * Wrapper for creating Backups page
     * @since  0.2.0
     */
    public function page_backups()
    {
        $this->get_page( 'Backups' );
    }
    
    // page_backups()
    /**
     * Page template
     * @return string
     * @since  0.2.0
     */
    protected function display_page()
    {
        $page = $this->page;
        ?>
        <div class="wrap">

            <div class="intro">
                            
                <h1><?php 
        echo  $page->title ;
        // Must be sanitized and translated when set
        ?></h1>
                
                <p class="desc"><?php 
        echo  $page->description ;
        // Must be sanitized and translated when set
        ?></p>
            
                <a href="<?php 
        echo  SECSAFE_URL_MORE_INFO ;
        ?>" target="_blank" class="ss-logo"><img src="<?php 
        echo  SECSAFE_URL_ADMIN_ASSETS ;
        ?>img/logo.svg" alt="<?php 
        echo  SECSAFE_NAME ;
        ?>"><br /><span class="version"><?php 
        $version = false;
        $version_pro = sprintf( __( 'Pro Version %s', SECSAFE_SLUG ), SECSAFE_VERSION );
        $version_pro_free = sprintf( __( '%1$s free features only %2$s', SECSAFE_SLUG ), '<br />(', ')' );
        $version = ( $version ? $version : sprintf( __( 'Version %s', SECSAFE_SLUG ), SECSAFE_VERSION ) );
        echo  $version ;
        ?></span></a>

            </div><!-- .intro -->

            <?php 
        $this->display_heading_menu();
        $page->display_tabs();
        // Build action URL
        $action_url = 'admin.php?page=' . $page->slug;
        $action_url .= ( isset( $_GET['tab'] ) ? '&tab=' . sanitize_text_field( $_GET['tab'] ) : '' );
        $enctype = ( isset( $_GET['tab'] ) && $_GET['tab'] == 'export-import' ? ' enctype="multipart/form-data"' : '' );
        ?>

            <form method="post" action="<?php 
        echo  admin_url( $action_url ) ;
        ?>"<?php 
        echo  $enctype ;
        ?>>
    
                <div class="all-tab-content">

                    <?php 
        $page->display_tabs_content();
        $tabs_with_sidebars = [ 'settings', 'export-import', 'debug' ];
        
        if ( !isset( $_GET['tab'] ) || isset( $_GET['tab'] ) && in_array( $_GET['tab'], $tabs_with_sidebars ) ) {
            ?>
                        <div id="sidebar" class="sidebar">

                            <div class="follow-us widget">
                                <p><a href="<?php 
            echo  SECSAFE_URL_TWITTER ;
            ?>" class="icon-twitter" target="_blank"><?php 
            printf( __( 'Follow %s', SECSAFE_SLUG ), SECSAFE_NAME );
            ?></a></p>
                            </div>
                            <?php 
            
            if ( security_safe()->is_not_paying() ) {
                ?>
                            <div class="upgrade-pro widget">
                                
                                <h5><?php 
                _e( 'Get More Features', SECSAFE_SLUG );
                ?></h5>
                                <p><?php 
                _e( 'Pro features give you more control and save you time.', SECSAFE_SLUG );
                ?></p>
                                <p class="cta"><a href="<?php 
                echo  SECSAFE_URL_MORE_INFO_PRO ;
                ?>" target="_blank" class="icon-right-open"><?php 
                _e( 'Upgrade to Pro!', SECSAFE_SLUG );
                ?></a></p>
                            </div>
                            <?php 
            }
            
            ?>
                            <div class="rate-us widget">
                                <h5><?php 
            printf( __( 'Like %s?', SECSAFE_SLUG ), SECSAFE_NAME );
            ?></h5>
                                <p><?php 
            _e( 'Share your positive experience!', SECSAFE_SLUG );
            ?></p>
                                <p class="cta ratings"><a href="<?php 
            echo  SECSAFE_URL_WP_REVIEWS ;
            ?>" target="_blank" class="rate-stars"><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span></a></p>
                            </div>
                        </div>
                    <?php 
        }
        
        ?>

                    <div id="tab-content-footer" class="footer tab-content"></div>

                </div><!-- .all-tab-content -->

            </form>

            <div class="wrap-footer full clear">

                <hr />

                <p><?php 
        printf( __( 'If you like %1$s, please <a href="%2$s" target="_blank">post a review</a>.', SECSAFE_SLUG ), SECSAFE_NAME, SECSAFE_URL_WP_REVIEWS_NEW );
        ?></p>
            
                <p><?php 
        printf( __( 'Need help? Visit the <a href="%1$s" target="_blank">support forum</a>', SECSAFE_SLUG ), SECSAFE_URL_WP );
        ?>.</p>
                
                <p><?php 
        // Display
        $start = SECSAFE_TIME_START;
        $end = microtime( true );
        echo  round( ($end - $start) * 1000 ) ;
        ?>ms</p>
            </div>
        </div><!-- .wrap -->
        <?php 
    }
    
    // display_page()
    /**
     * Display Heading Menu
     * @since  0.2.0
     */
    protected function display_heading_menu()
    {
        $menus = $this->get_category_pages( true );
        echo  '<ul class="featured-menu">' ;
        foreach ( $menus as $k => $l ) {
            $class = $k;
            
            if ( $k == 'plugin' ) {
                $href = 'href="admin.php?page=' . SECSAFE_SLUG . '"';
            } else {
                
                if ( $k == 'firewall' ) {
                    // No settings, so we must define tab
                    $href = 'href="admin.php?page=' . SECSAFE_SLUG . '-' . $k . '&tab=blocked"';
                } else {
                    $href = 'href="admin.php?page=' . SECSAFE_SLUG . '-' . $k . '"';
                }
            
            }
            
            // Highlight Active Menu
            
            if ( $_GET['page'] == SECSAFE_SLUG && $k == 'plugin' ) {
                $active = ' active';
            } else {
                $active = ( strpos( $_GET['page'], $k ) !== false ? ' active' : '' );
            }
            
            $class .= $active;
            // Convert All Menus to A Single Line
            $l = ( $l == __( 'User Access', SECSAFE_SLUG ) ? __( 'Access', SECSAFE_SLUG ) : $l );
            echo  '<li><a ' . $href . 'class="icon-' . $class . '"><span>' . $l . '</span></a></li>' ;
        }
        // foreach
        echo  '</ul>' ;
    }
    
    // display_heading_menu()
    /**
     * Displays all messages
     * @since  0.2.0
     */
    public function display_notices( $skip = false )
    {
        if ( !$skip ) {
            // Register / Display Admin Notices
            $this->all_notices();
        }
        if ( SECSAFE_DEBUG ) {
            $this->messages[] = [ sprintf( __( '%s: Plugin Debug Mode is on.', SECSAFE_SLUG ), SECSAFE_NAME ), 1, 0 ];
        }
        // SECSAFE_DEBUG
        
        if ( is_array( $this->messages ) ) {
            foreach ( $this->messages as $m ) {
                $message = ( isset( $m[0] ) ? $m[0] : false );
                $status = ( isset( $m[1] ) ? $m[1] : 0 );
                $dismiss = ( isset( $m[2] ) ? $m[2] : 0 );
                if ( $message ) {
                    // Display Message
                    $this->admin_notice( $message, $status, $dismiss );
                }
                // $message
            }
            // foreach ()
            // Reset Messages
            $this->messages = [];
        }
        
        // is_array()
    }
    
    // display_notices()
    /**
     * Displays a message at the top of the screen.
     * @return  html code
     * @since  0.1.0
     */
    protected function admin_notice( $message, $status = 0, $dismiss = 0 )
    {
        // Set Classes
        $class = 'notice-success';
        $class = ( $status == 1 ? 'notice-info' : $class );
        $class = ( $status == 2 ? 'notice-warning' : $class );
        $class = ( $status == 3 ? 'notice-error' : $class );
        $class = 'active notice ' . $class;
        if ( $dismiss ) {
            $class .= ' is-dismissible';
        }
        // Each message must be sanitized when set due to variability of message types
        // $class is set above
        echo  '<div class="' . $class . '"><p>' . $message . '</p></div>' ;
    }
    
    //admin_notice()
    /**
     * Checks settings and determines whether they need to be reset to default
     * @since  0.1.0
     */
    function check_settings()
    {
        
        if ( isset( $_POST ) && !empty($_POST) ) {
            
            if ( isset( $_GET['page'] ) && strpos( $_GET['page'], SECSAFE_SLUG ) !== false && !in_array( $_GET['page'], [ 'security-safe-pricing', 'security-safe-account' ] ) ) {
                
                if ( !isset( $_GET['tab'] ) || $_GET['tab'] == 'settings' ) {
                    // Remove Reset Variable
                    if ( isset( $_GET['reset'] ) ) {
                        unset( $_GET['reset'] );
                    }
                    // Create Page Slug
                    $page_slug = filter_var( $_GET['page'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
                    $page_slug = str_replace( [ 'security-safe-', 'security-safe' ], '', $page_slug );
                    // Compensation For Oddball Scenarios
                    $page_slug = ( $page_slug == '' ? 'general' : $page_slug );
                    $page_slug = ( $page_slug == 'user-access' ? 'access' : $page_slug );
                    $this->post_settings( $page_slug );
                } else {
                    if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'export-import' ) {
                        
                        if ( isset( $_POST['export-settings'] ) ) {
                            $this->export_settings__premium_only();
                        } else {
                            if ( isset( $_POST['import-settings'] ) ) {
                                $this->import_settings__premium_only();
                            }
                        }
                    
                    }
                }
                
                // isset( $_GET['tab'] )
            }
            
            // isset( $_GET['page'] )
        } else {
            if ( isset( $_GET['page'] ) && $_GET['page'] == SECSAFE_SLUG && isset( $_GET['reset'] ) && $_GET['reset'] == 1 ) {
                // Reset On Plugin Settings Only
                $this->reset_settings();
            }
        }
        
        // isset( $_POST )
    }
    
    //check_settings()
    /**
     * This registers all the notices for later display
     * @since  2.0.0
     */
    protected function all_notices()
    {
        // Check if policies are turned off
        $this->policy_notices();
        // Display Notices on Our Plugin Pages Only
        if ( isset( $_GET['page'] ) && isset( $_GET['tab'] ) && $_GET['page'] == SECSAFE_SLUG && $_GET['tab'] == 'debug' ) {
            // Check if WP Cron is disabled
            
            if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON == true ) {
                $message = sprintf( __( '%s: WP Cron is disabled. This will affect the routine database table cleanup. Please setup a manual cron to trigger WP Cron daily or enable WP Cron.', SECSAFE_SLUG ), SECSAFE_NAME );
                $this->messages['firewall'] = [ $message, 2, 0 ];
            }
        
        }
    }
    
    // all_notices()
    /**
     * Sets notices for policies that are disabled as a group.
     * @since  1.1.10
     */
    protected function policy_notices()
    {
        // All Plugin Policies
        
        if ( !isset( $this->settings['general']['on'] ) || $this->settings['general']['on'] != "1" ) {
            $message = sprintf( __( '%s: All security policies are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
            $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe' ? '' : ' ' . sprintf( __( 'You can enable them in <a href="%1$s">Plugin Settings</a>. If you are experiencing an issue, <a href="%2$s">reset your settings.</a>', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe&tab=settings#settings' ), admin_url( 'admin.php?page=security-safe&reset=1' ) ) );
            $this->messages['general'] = [ $message, 2, 0 ];
        } else {
            // Privacy Policies
            
            if ( !isset( $this->settings['privacy']['on'] ) || $this->settings['privacy']['on'] != "1" ) {
                $message = sprintf( __( '%s: All privacy policies are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-privacy' ? '' : ' ' . sprintf( __( 'You can enable them at the top of <a href="%s">Privacy Settings</a>.', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe-privacy&tab=settings#settings' ) ) );
                $this->messages['privacy'] = [ $message, 2, 0 ];
            }
            
            // privacy
            // Files Policies
            
            if ( !isset( $this->settings['files']['on'] ) || $this->settings['files']['on'] != "1" ) {
                $message = sprintf( __( '%s: All file policies are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-files' ? '' : ' ' . sprintf( __( 'You can enable them at the top of <a href="%s">File Settings</a>.', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe-files&tab=settings#settings' ) ) );
                $this->messages['files'] = [ $message, 2, 0 ];
            }
            
            // files
            // Access Policies
            
            if ( !isset( $this->settings['access']['on'] ) || $this->settings['access']['on'] != "1" ) {
                $message = sprintf( __( '%s: All user access policies are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-user-access' ? '' : ' ' . sprintf( __( 'You can enable them at the top of <a href="%s">User Access Settings</a>.', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe-user-access&tab=settings#settings' ) ) );
                $this->messages['access'] = [ $message, 2, 0 ];
            }
            
            // access
            // Content Policies
            
            if ( !isset( $this->settings['content']['on'] ) || $this->settings['content']['on'] != "1" ) {
                $message = sprintf( __( '%s: All content policies are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-content' ? '' : ' ' . sprintf( __( 'You can enable them at the top of <a href="%s">Content Settings</a>.', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe-content&tab=settings#settings' ) ) );
                $this->messages['content'] = [ $message, 2, 0 ];
            }
            
            // content
            // Firewall Policies
            
            if ( !isset( $this->settings['firewall']['on'] ) || $this->settings['firewall']['on'] != "1" ) {
                $message = sprintf( __( '%s: The firewall is disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-firewall' ? '' : ' ' . sprintf( __( 'You can enable it at the top of <a href="%s">Firewall Settings</a>.', SECSAFE_SLUG ), admin_url( 'admin.php?page=security-safe-firewall&tab=settings#settings' ) ) );
                $this->messages['firewall'] = [ $message, 2, 0 ];
            }
            
            // firewall
            /*================================================
                            // Backups Policies
                            if ( ! isset( $this->settings['backups']['on'] ) || $this->settings['backups']['on'] != "1" ) {
            
                                $message = sprintf( __( '%s: Backups are disabled.', SECSAFE_SLUG ), SECSAFE_NAME );
            
                                $message .= ( isset( $_GET['page'] ) && $_GET['page'] == 'security-safe-backups' ) ? '' : ' You can enable them at the top of <a href="admin.php?page=security-safe-backups&tab=settings#settings">Backup Settings</a>.';
            
                                $this->messages['backups'] = [ $message, 2, 0 ];
            
                            } // backups
                    
                    ============================================= */
        }
        
        // endif
    }
    
    /**
     * Plugin action links filter
     *
     * @param array $links Array of links for each plugin
     * @return array
     * @since  1.2.0
     */
    function plugin_action_links( $links )
    {
        // Add Link
        array_unshift( $links, '<a style="color: #f56e28;" href="' . SECSAFE_URL_WP_REVIEWS_NEW . '">' . __( 'Rate Us', SECSAFE_SLUG ) . '</a>' );
        return $links;
    }
    
    // plugin_action_links
    /**
     * Loads dependents for the chart.
     *
     * @since 2.0.0
     */
    static function load_charts( $args )
    {
        require_once SECSAFE_DIR_ADMIN_INCLUDES . '/Charts.php';
        Charts::display_charts( $args );
    }

}
// Admin()