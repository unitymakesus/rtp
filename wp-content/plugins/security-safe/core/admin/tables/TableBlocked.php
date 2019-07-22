<?php

namespace SovereignStack\SecuritySafe;

// Prevent Direct Access
if ( ! defined( 'ABSPATH' ) ) { die; }

require_once( SECSAFE_DIR_ADMIN_TABLES . '/Table.php' );

/**
 * Class TableBlocked
 * @package SecuritySafe
 */
final class TableBlocked extends Table {


    /**
     * Set the type of data to display
     * 
     * @since  2.0.0
     */
    protected function set_type() {

        $this->type = 'blocked';

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
            'date'          => __( 'Date', SECSAFE_SLUG ),
            'uri'           => __( 'URL', SECSAFE_SLUG ),
            'user_agent'    => __( 'User Agent', SECSAFE_SLUG ),
            'referer'       => __( 'HTTP Referer', SECSAFE_SLUG ),
            'ip'            => __( 'IP Address', SECSAFE_SLUG ),
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
            'uri',
            'ip',
            'referer'
        ];

    } // get_searchable_columns()


    /**
     * Add filters and per_page options
     */ 
    protected function bulk_actions( $which = '' ) {

        $this->bulk_actions_load( $which );

    } // bulk_actions()


    public function display_charts() {

        if ( $this->hide_charts() ) { return; }

        $days = 7;
        $days_ago = $days - 1;

        echo '
        <div class="table">
            <div class="tr">

                <div class="chart chart-blocked-line td td-8 center">

                    <h3>' . __( 'Threats Over The Past', SECSAFE_SLUG ) . ' ' . $days . ' ' . __( 'Days', SECSAFE_SLUG ) . '</h3>
                    <div id="chart-line"></div>

                </div><div class="chart chart-blocked-guage td td-4 center">

                    <h3>Threats Blocked</h3>
                    <div id="chart-guage"></div>

                </div>

            </div>
        </div>';

        $charts = [];

        $columns = [
                        [
                            'id'            => 'threats',
                            'color'         => '#f6c600',
                            'type'          => 'area-spline',
                            'db'            => 'threats'
                        ],
                        [
                            'id'            => 'blocked',
                            'color'         => '#0073aa',
                            'type'          => 'area-spline',
                            'db'            => 'blocked'
                        ],
                    ];

        $charts[] = [ 
            'id'            => 'chart-line',
            'type'          => 'line',
            'columns'       => $columns,
            'y-label'       => '# Threats'
        ];

        $charts[] = [ 
            'id'            => 'chart-guage',
            'type'          => 'guage',
            'columns'       => $columns
        ];

        $args = [
            'date_start'    => date('Y-m-d 00:00:00', strtotime('-' . $days_ago . ' days') ),
            'date_end'      => date( 'Y-m-d 23:59:59', time() ),
            'date_days'     => $days, 
            'date_days_ago' => $days_ago,
            'charts'        => $charts
        ];
        

        // Load Charts
        Admin::load_charts( $args );

    } // display_charts()


} // TableBlocked()
