<?php

class FacetWP_Integration_SearchWP
{

    public $search_terms;


    function __construct() {
        add_filter( 'facetwp_query_args', [ $this, 'query_args' ], 10, 2 );
        add_filter( 'facetwp_facet_filter_posts', [ $this, 'search_facet' ], 10, 2 );
        add_filter( 'facetwp_facet_search_engines', [ $this, 'search_engines' ] );
        add_filter( 'searchwp\native\args', [ $this, 'searchwp_native_args' ], 10, 2 );
    }


    /**
     * Prevent the default WP search from running when SearchWP is enabled
     * @since 1.3.2
     */
    function query_args( $args, $class ) {

        if ( $class->is_search ) {
            $this->search_terms = $args['s'];

            // Set "post__in" based on SWP_Query results
            $swp_query = new SWP_Query( [
                's'                 => $this->search_terms,
                'posts_per_page'    => 200,
                'fields'            => 'ids',
                'facetwp'           => true,
            ] );

            if ( empty( $args['post__in'] ) ) {
                $post_ids = $swp_query->posts;
            }
            else {
                $post_ids = [];
                $haystack = array_flip( $args['post__in'] );

                foreach ( $swp_query->posts as $post_id ) {
                    if ( isset( $haystack[ $post_id ] ) ) {
                        $post_ids[] = $post_id;
                    }
                }
            }

            $args['post__in'] = empty( $post_ids ) ? [ 0 ] : $post_ids;

            if ( empty( $args['post_type'] ) ) {
                $args['post_type'] = 'any';
                $args['post_status'] = 'any';
            }

            // Prevent WP core search from running
            unset( $args['s'] );
        }

        return $args;
    }


    /**
     * Trick SearchWP into running while ghosting core search
     * This hook is within `posts_pre_query`, i.e. before the query runs
     * @since 3.6.5
     */
    function searchwp_native_args( $args, $query ) {
        if ( ! empty( $this->search_terms ) ) {
            $args['s'] = $this->search_terms; // Trigger SearchWP
            $query->set( 's', $this->search_terms ); // Needed for get_search_query()
        }

        return $args;
    }


    /**
     * Intercept search facets using SearchWP engine
     * @since 2.1.5
     */
    function search_facet( $return, $params ) {
        $facet = $params['facet'];
        $selected_values = $params['selected_values'];
        $selected_values = is_array( $selected_values ) ? $selected_values[0] : $selected_values;
        $search_engine = isset( $facet['search_engine'] ) ? $facet['search_engine'] : '';

        if ( 'search' == $facet['type'] && 0 === strpos( $search_engine, 'swp_' ) ) {
            if ( empty( $selected_values ) ) {
                return 'continue';
            }

            $swp_query = new SWP_Query( [
                's'                 => $selected_values,
                'engine'            => substr( $search_engine, 4 ),
                'posts_per_page'    => 200,
                'fields'            => 'ids',
                'facetwp'           => true,
            ] );

            return $swp_query->posts;
        }

        return $return;
    }


    /**
     * Add engines to the search facet
     */
    function search_engines( $engines ) {

        if ( version_compare( SEARCHWP_VERSION, '4.0', '>=' ) ) {
            $settings = get_option( SEARCHWP_PREFIX . 'engines' );

            foreach ( $settings as $key => $info ) {
                $engines[ 'swp_' . $key ] = 'SearchWP - ' . $info['label'];
            }
        }
        else {
            $settings = get_option( SEARCHWP_PREFIX . 'settings' );

            foreach ( $settings['engines'] as $key => $info ) {
                $label = isset( $info['searchwp_engine_label'] ) ? $info['searchwp_engine_label'] : __( 'Default', 'fwp' );
                $engines[ 'swp_' . $key ] = 'SearchWP - ' . $label;
            }
        }

        return $engines;
    }
}


if ( defined( 'SEARCHWP_VERSION' ) && version_compare( SEARCHWP_VERSION, '2.6', '>=' ) ) {
    new FacetWP_Integration_SearchWP();
}
