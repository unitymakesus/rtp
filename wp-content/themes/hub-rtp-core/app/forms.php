<?php

namespace App;

/**
 * Add a special selector to specific form fields.
 */
add_filter('gform_field_css_class', function($classes, $field, $form) {
  $field_types = ['text', 'email', 'phone', 'url'];

  if ($form['id'] === 1) {
    return $classes;
  }

  if (in_array($field->type, $field_types)) {
    $classes .= ' gfield--label-swap';
  }

  return $classes;
}, 10, 3);
