<?php

namespace App;

/**
 * Output the Hub Office map with a Blade template.
 */
add_shortcode('hub-office-map', function () {
    ob_start();

    $template = 'partials/office-map';
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);

    echo template($template, $data);

    return ob_get_clean();
});
