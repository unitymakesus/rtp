<?php

namespace App;

/**
 * Build an array of suite IDs and Vendor slugs who occupy them.
 * Used in the tooltip functionality of the map.
 */
function get_map_directory_index() {
    if (false === ($map_directory_index = get_transient('map_directory_index'))) {
        $map_directory_index = [];

        if (have_rows('vendor_map_suites')) :
            while (have_rows('vendor_map_suites')) : the_row();
                $suite_id = get_sub_field('id');
                $vendor_id = get_sub_field('vendor');
                $map_directory_index[$suite_id] = [
                    'name'      => get_the_title($vendor_id),
                    'vendor_id' => $vendor_id,
                    'category'  => get_vendor_term($vendor_id, 'vendor_category'),
                ];
            endwhile;
        endif;

        set_transient('map_directory_index', $map_directory_index, MONTH_IN_SECONDS);
    }

    return $map_directory_index;
}

/**
 * Return a tax term for a Vendor (for filtering).
 *
 * @param int $id
 * @param string $taxonomy
 *
 */
function get_vendor_term($id, $taxonomy) {
    if (!taxonomy_exists($taxonomy)) {
        return;
    }

    $term = '';
    $terms = get_the_terms($id, $taxonomy);

    if (!empty($terms)) {
        $term = array_shift($terms);
    }

    return is_object($term) ? $term->slug : '';
}
