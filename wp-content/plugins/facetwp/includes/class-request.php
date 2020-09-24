<?php

class FacetWP_Request
{

    /* (array) FacetWP-related GET variables */
    public $url_vars = [];

    /* (mixed) The main query vars */
    public $query_vars = null;

    /* (boolean) FWP template shortcode? */
    public $is_shortcode = false;

    /* (boolean) Is a FacetWP refresh? */
    public $is_refresh = false;

    /* (boolean) Initial load? */
    public $is_preload = false;


    function __construct() {
        $this->intercept_request();
    }


    /**
     * If AJAX and the template is "wp", return the buffered HTML
     * Otherwise, store the GET variables for later use
     */
    function intercept_request() {
        $action = isset( $_POST['action'] ) ? sanitize_key( $_POST['action'] ) : '';

        $valid_actions = [
            'facetwp_refresh',
            'facetwp_autocomplete_load'
        ];

        $this->is_refresh = ( 'facetwp_refresh' == $action );
        $this->is_preload = ! in_array( $action, $valid_actions );
        $prefix = FWP()->helper->get_setting( 'prefix' );
        $is_css_tpl = isset( $_POST['data']['template'] ) && 'wp' == $_POST['data']['template'];

        // Disable the admin bar to prevent JSON issues
        if ( $this->is_refresh ) {
            add_filter( 'show_admin_bar', '__return_false' );
        }

        // Pageload
        if ( $this->is_preload ) {
            $features = [ 'paged', 'per_page', 'sort' ];
            $valid_names = wp_list_pluck( FWP()->helper->get_facets(), 'name' );
            $valid_names = array_merge( $valid_names, $features );

            // Store GET variables
            foreach ( $valid_names as $name ) {
                if ( isset( $_GET[ $prefix . $name ] ) && '' !== $_GET[ $prefix . $name ] ) {
                    $new_val = stripslashes_deep( $_GET[ $prefix . $name ] );
                    $new_val = in_array( $name, $features ) ? $new_val : explode( ',', $new_val );
                    $this->url_vars[ $name ] = $new_val;
                }
            }

            $this->url_vars = apply_filters( 'facetwp_preload_url_vars', $this->url_vars );
        }
        // Populate $_GET
        else {
            $data = stripslashes_deep( $_POST['data'] );

            if ( ! empty( $data['http_params']['get'] ) ) {
                foreach ( $data['http_params']['get'] as $key => $val ) {
                    if ( ! isset( $_GET[ $key ] ) ) {
                        $_GET[ $key ] = $val;
                    }
                }
            }
        }

        if ( $this->is_preload || $is_css_tpl ) {
            add_filter( 'posts_pre_query', [ $this, 'maybe_abort_query' ], 10, 2 );
            add_action( 'pre_get_posts', [ $this, 'sacrificial_lamb' ], 998 );
            add_action( 'pre_get_posts', [ $this, 'update_query_vars' ], 999 );
        }

        if ( ! $this->is_preload && $is_css_tpl && 'facetwp_autocomplete_load' != $action ) {
            add_action( 'shutdown', [ $this, 'inject_template' ], 0 );
            ob_start();
        }
    }


    /**
     * FacetWP runs the archive query before WP gets the chance.
     * This hook prevents the query from running twice, by letting us inject the
     * first query's posts (and counts) into the "main" query.
     */
    function maybe_abort_query( $posts, $query ) {
        $do_abort = apply_filters( 'facetwp_archive_abort_query', true, $query );
        $has_query_run = ( ! empty( FWP()->facet->query ) );

        if ( $do_abort && $has_query_run && isset( $this->query_vars ) ) {
            // Remove junk defaults from the end of this query's vars
            // E.g. cache_results, update_post_term_cache, update_post_meta_cache
            $query_vars = array_slice( $query->query_vars, 0, count( $this->query_vars ) );

            // Only intercept the identical query
            if ( $query_vars === $this->query_vars ) {
                $posts = FWP()->facet->query->posts;
                $query->found_posts = FWP()->facet->query->found_posts;
                $query->max_num_pages = FWP()->facet->query->max_num_pages;
            }
        }

        return $posts;
    }


    /**
     * Fixes https://core.trac.wordpress.org/ticket/40393
     */
    function sacrificial_lamb( $query ) {
    }


    /**
     * Force FacetWP to use the default WP query
     */
    function update_query_vars( $query ) {

        // Only run once
        if ( isset( $this->query_vars ) ) {
            return;
        }

        // Skip shortcode template
        if ( $this->is_shortcode ) {
            return;
        }

        // Skip admin
        if ( is_admin() && ! wp_doing_ajax() ) {
            return;
        }

        $is_main_query = ( $query->is_main_query() && ! $query->is_singular && ! $query->is_feed );
        $is_main_query = ( true === $query->get( 'suppress_filters', false ) ) ? false : $is_main_query; // skip get_posts()
        $is_main_query = ( wp_doing_ajax() && ! $this->is_refresh ) ? false : $is_main_query; // skip other ajax
        $is_main_query = ( '' !== $query->get( 'facetwp' ) ) ? (bool) $query->get( 'facetwp' ) : $is_main_query; // flag
        $is_main_query = apply_filters( 'facetwp_is_main_query', $is_main_query, $query );

        if ( $is_main_query ) {

            // Set the flag
            $query->set( 'facetwp', true );

            // Store the default WP query vars
            $this->query_vars = $query->query_vars;

            // Notify
            do_action( 'facetwp_found_main_query' );

            // Generate the FWP output
            $data = ( $this->is_preload ) ? $this->process_preload_data() : $this->process_post_data();
            $this->output = FWP()->facet->render( $data );

            // Set the updated query vars
            if ( ! $this->is_preload || ! empty( $this->url_vars ) ) {
                $query->query_vars = FWP()->facet->query_args;
            }

            if ( 'product_query' == $query->get( 'wc_query' ) ) {
                wc_set_loop_prop( 'total', FWP()->facet->pager_args['total_rows'] );
                wc_set_loop_prop( 'total_pages', FWP()->facet->pager_args['total_pages'] );
                wc_set_loop_prop( 'current_page', FWP()->facet->pager_args['page'] );
            }
        }
    }


    /**
     * Process the AJAX $_POST data
     * This gets passed into FWP()->facet->render()
     */
    function process_post_data() {
        $data = stripslashes_deep( $_POST['data'] );
        $facets = json_decode( $data['facets'], true );
        $extras = isset( $data['extras'] ) ? $data['extras'] : [];
        $frozen_facets = isset( $data['frozen_facets'] ) ? $data['frozen_facets'] : [];

        $params = [
            'facets'            => [],
            'template'          => $data['template'],
            'frozen_facets'     => $frozen_facets,
            'http_params'       => $data['http_params'],
            'extras'            => $extras,
            'soft_refresh'      => (int) $data['soft_refresh'],
            'is_bfcache'        => (int) $data['is_bfcache'],
            'first_load'        => (int) $data['first_load'], // skip the template?
            'paged'             => (int) $data['paged'],
        ];

        foreach ( $facets as $facet_name => $selected_values ) {
            $params['facets'][] = [
                'facet_name'        => $facet_name,
                'selected_values'   => $selected_values,
            ];
        }

        return $params;
    }


    /**
     * On initial pageload, preload the data
     * 
     * This gets called twice; once in the template shortcode (to grab only the template)
     * and again in FWP()->display->front_scripts() to grab everything else.
     * 
     * Two calls are needed for timing purposes; the template shortcode often renders
     * before some or all of the other FacetWP-related shortcodes.
     */
    function process_preload_data( $template_name = false, $overrides = [] ) {

        if ( false === $template_name ) {
            $template_name = isset( $this->template_name ) ? $this->template_name : 'wp';
        }

        $this->template_name = $template_name;

        // Is this a template shortcode?
        $this->is_shortcode = ( 'wp' != $template_name );

        $params = [
            'facets'            => [],
            'template'          => $template_name,
            'http_params'       => [
                'get'       => $_GET,
                'uri'       => FWP()->helper->get_uri(),
                'url_vars'  => $this->url_vars,
            ],
            'frozen_facets'     => [],
            'soft_refresh'      => 1, // skip the facets
            'is_preload'        => 1,
            'is_bfcache'        => 0,
            'first_load'        => 0, // load the template
            'extras'            => [],
            'paged'             => 1,
        ];

        // Support "/page/X/" on preload
        if ( ! empty( $this->query_vars['paged'] ) ) {
            $params['paged'] = (int) $this->query_vars['paged'];
        }

        foreach ( $this->url_vars as $key => $val ) {
            if ( 'paged' == $key ) {
                $params['paged'] = $val;
            }
            elseif ( 'per_page' == $key ) {
                $params['extras']['per_page'] = $val;
            }
            elseif ( 'sort' == $key ) {
                $params['extras']['sort'] = $val;
            }
            else {
                $params['facets'][] = [
                    'facet_name' => $key,
                    'selected_values' => $val,
                ];
            }
        }

        // Override the defaults
        $params = array_merge( $params, $overrides );

        return $params;
    }


    /**
     * This gets called from FWP()->display->front_scripts(), when we finally
     * know which shortcodes are on the page.
     * 
     * Since we already got the template HTML on the first process_preload_data() call,
     * this time we're grabbing everything but the template.
     * 
     * The return value of this method gets passed into the 2nd argument of
     * process_preload_data().
     */
    function process_preload_overrides( $items ) {
        $overrides = [];
        $url_vars = FWP()->request->url_vars;

        foreach ( $items['facets'] as $name ) {
            $selected_values = isset( $url_vars[ $name ] ) ? $url_vars[ $name ] : [];

            $overrides['facets'][] = [
                'facet_name' => $name,
                'selected_values' => $selected_values,
            ];
        }

        if ( isset( $items['extras']['counts'] ) ) {
            $overrides['extras']['counts'] = true;
        }
        if ( isset( $items['extras']['pager'] ) ) {
            $overrides['extras']['pager'] = true;
        }
        if ( isset( $items['extras']['per_page'] ) ) {
            $per_page = isset( $url_vars['per_page'] ) ? $url_vars['per_page'] : 'default';
            $overrides['extras']['per_page'] = $per_page;
        }
        if ( isset( $items['extras']['sort'] ) ) {
            $sort = isset( $url_vars['sort'] ) ? $url_vars['sort'] : 'default';
            $overrides['extras']['sort'] = $sort;
        }

        $overrides['soft_refresh'] = 0; // load the facets
        $overrides['first_load'] = 1; // skip the template

        return $overrides;
    }


    /**
     * Inject the page HTML into the JSON response
     * We'll cherry-pick the content from the HTML using front.js
     */
    function inject_template() {
        $html = ob_get_clean();

        // Throw an error
        if ( empty( $this->output['settings'] ) ) {
            $html = __( 'FacetWP was unable to auto-detect the post listing', 'fwp' );
        }
        // Grab the <body> contents
        else {
            preg_match( "/<body(.*?)>(.*?)<\/body>/s", $html, $matches );

            if ( ! empty( $matches ) ) {
                $html = trim( $matches[2] );
            }
        }

        $this->output['template'] = $html;
        do_action( 'facetwp_inject_template', $this->output );
        wp_send_json( $this->output );
    }
}