<?php

namespace App;

/**
 * Add a special selector to specific form fields.
 */
add_filter('gform_field_css_class', function ($classes, $field, $form) {
    $field_types = ['text', 'email', 'phone', 'url'];

    if ($form['id'] === 1) {
        return $classes;
    }

    if (in_array($field->type, $field_types)) {
        $classes .= ' gfield--label-swap';
    }

    return $classes;
}, 10, 3);

/**
 * Add custom spinner for Gravity Forms AJAX.
 *
 * @param string $image_src
 */
add_filter('gform_ajax_spinner_url', function ($image_src) {
    return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
}, 10, 2);
