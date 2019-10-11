<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    if (is_home()) {
      $classes[] = 'archive';
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    // return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});


/**
 * Render MEC templates using Blade
 */
add_filter('template_include', function ($template) {
    if (is_single() && get_post_type() == 'mec-events') {
        $blade_template = locate_template('single-mec-events.blade.php');
        return ($blade_template) ? $blade_template : $template;
    }

    if (is_tax() && get_post_type() == 'mec-events') {
      $blade_template = locate_template('taxonomy-mec-category.blade.php');
      return ($blade_template) ? $blade_template : $template;
    }

    return $template;
}, 100);


/**
 * Render page using Blade
 */
 add_filter('template_include', function ($template) {
     collect(['get_header', 'wp_head'])->each(function ($tag) {
         ob_start();
         do_action($tag);
         $output = ob_get_clean();
         remove_all_actions($tag);
         add_action($tag, function () use ($output) {
             echo $output;
         });
     });

     $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
         return apply_filters("sage/template/{$class}/data", $data, $template);
     }, []);
     if ($template) {
         echo template($template, $data);
         return get_stylesheet_directory().'/index.php';
     }

     return $template;
 }, PHP_INT_MAX);


 /**
  * Render comments.blade.php
  */
  add_filter('comments_template', function ($comments_template) {
      $comments_template = str_replace(
          [get_stylesheet_directory(), get_template_directory()],
          '',
          $comments_template
      );

      $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
          return apply_filters("sage/template/{$class}/data", $data, $comments_template);
      }, []);

      $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

      if ($theme_template) {
          echo template($theme_template, $data);
          return get_stylesheet_directory().'/index.php';
      }

      return $comments_template;
  }, 100);

/**
 * Setup sidebar
 */
add_filter('sage/display_sidebar', function ($display) {
  static $display;

  isset($display) || $display = in_array(true, [
    // The sidebar will be displayed if any of the following return true
    // is_singular('post'),
    // is_home(),
    // is_date(),
    // is_category()
  ]);

  return $display;
});

/**
 * Remove prefixes from category and tag archive titles
 */
add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  }
  return $title;
});

/**
 * If there's a subtitle, auto add it after the titles
 */
if ( ! is_admin() ) { // Don't touch anything inside of the WordPress Dashboard, yet.
	add_filter( 'the_title', function($title, $id = null) {
    /**
     * Which globals will we need?
     */
    global $post;

    /**
     * Check if $post is set. There's a chance that this can
     * be NULL on search results pages with zero results.
     */
    if ( ! isset( $post ) ) {
    	return $title;
    }

    /**
     * Make sure we're not touching any of the titles in the Dashboard
     * This filtering should only happen on the front end of the site.
     */
    if ( is_admin() ) {
    	return $title;
    }

    /**
     * Bail early if ACF isn't active
     */
    if ( !function_exists('get_field') ) {
      return $title;
    }

    /**
     * Bail early if no subtitle has been set for the post.
     */
    $post_id = (int) absint( $post->ID ); // post ID should always be a non-negative integer
    $subtitle = (string) html_entity_decode( get_field('subtitle'), ENT_QUOTES );

    if ( empty($subtitle) ) {
    	return $title;
    }

		/**
		 * Make sure we're in The Loop.
		 *
		 * @see in_the_loop()
		 * @link http://codex.wordpress.org/Function_Reference/in_the_loop
		 *
		 * @since 1.0.0
		 */
		if ( ! in_the_loop() ) {
			return $title;
		}

    /**
     * Let theme authors modify the subtitle markup, in case spans aren't appropriate
     * for what they are trying to do with their themes.
     *
     * The reason that spans are being used is because HTML does not have a dedicated
     * mechanism for marking up subheadings, alternative titles, or taglines. There
     * are suggested alternatives from the World Wide Web Consortium (W3C); among them
     * are spans, which work well for what we're trying to do with titles in WordPress.
     * See the linked documentation for more information.
     *
     * @link http://www.w3.org/html/wg/drafts/html/master/common-idioms.html#sub-head
     *
     * @since 1.0.0
     */
    $subtitle_markup = apply_filters(
    	'subtitle_markup',
    	array(
    		'before' => '<span class="entry-subtitle">',
    		'after'  => '</span>',
    	)
    );

    $subtitle = $subtitle_markup['before'] . $subtitle . $subtitle_markup['after'];

    /**
     * Put together the final title and subtitle set
     *
     * @since 1.0.0
     */
    $title = '<span class="entry-title-primary">' . $title . '</span> ' . $subtitle;

    return $title;
  }, 10, 2 );
}

/**
 * Prevent certain pages loading WP External Link plugin
 */
add_action( 'wpel_apply_settings', function () {

  // Exclude Beaver Builder editor pages
  if ( strpos($_SERVER['REQUEST_URI'], '?fl_builder') !== false ) {
    return false;
  }

  // Exclude directory pages that use FacetWP
  if (is_page_template('templates/page-directory.php') || is_page('directory-map')) {
    return false;
  }

  return true;
}, 10 );

/**
 * Add class to navigation links so WP External Links plugin can ignore them
 */
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
  $atts['class'] = 'menu-link';

  return $atts;
}, 10, 3);

/**
 * Set original date as the post date for distributed content
 */
add_filter('dt_push_post_args', function($new_post_args, $post, $args) {
  $new_post_args['post_date'] = $post->post_date;
  return $new_post_args;
}, 10, 3);

/**
 * Remove draft option for distributing posts
 */
add_filter('dt_allow_as_draft_distribute', function($as_draft, $connection, $post) {
  return false;
}, 10, 3);

/**
 * Redirect distributed posts to the original post
 */
add_filter('template_redirect', function() {
  global $post;

  // Don't do this on blog, category, search, or calendar pages
  if (!is_home() && !is_archive() && !is_search() && !is_page('calendar')) {
    $orig_post_url = get_post_meta($post->ID, 'dt_original_post_url', true);
    $orig_deleted = get_post_meta($post->ID, 'dt_original_post_deleted', true);

    if (!empty($orig_post_url) && $orig_deleted !== 1) {
      wp_redirect($orig_post_url, '301');
      die;
    }
  }

});

/**
 * Set sender email address for Gravity Forms
 */
add_filter( 'gform_notification', function($notification, $form, $entry) {

  $notification['fromName'] = 'RTP Website';
  $notification['from'] = 'info@rtp.org';

  return $notification;

}, 10, 3 );


/**
 * Save new distributed event posts as an MEC event
 * @param  int   $new_post_id   Post ID on target site
 * @param  int   $post_id       Post ID on original site
 * @param  array $args          Args passed to wp_insert_post
 * @param  NetworkSiteConnection   $connection    Distributor's connection
 */
add_action( 'dt_push_post', function($new_post_id, $post_id, $args, $connection) {
  error_log($new_post_id);

  // Creating array for inserting in mec_events table
  $mec_event = array(
    'post_id' => $new_post_id,
    'start' => get_post_meta($new_post_id, 'mec_start_date', true),
    'end' => get_post_meta($new_post_id, 'mec_end_date', true),
    'repeat' => get_post_meta($new_post_id, 'mec_repeat_status', true),
    'rinterval' => get_post_meta($new_post_id, 'mec_repeat_interval', true),
    'year' => NULL,
    'month' => NULL,
    'day' => NULL,
    'week' => NULL,
    'weekday' => NULL,
    'weekdays' => implode(',', get_post_meta($new_post_id, 'mec_certain_weekdays', true)),
    'days' => get_post_meta($new_post_id, 'mec_in_days', true),
    'not_in_days' => get_post_meta($new_post_id, 'mec_not_in_days', true),
    'time_start' => get_post_meta($new_post_id, 'mec_start_day_seconds', true),
    'time_end' => get_post_meta($new_post_id, 'mec_end_day_seconds', true),
  );

  if (get_post_type($new_post_id) == 'mec-events') {
    $main = \MEC::getInstance('app.libraries.main');
    // $e = $main->save_event($args, $new_post_id);
    $db = $main->getDB();

    $q1 = "";
    $q2 = "";

    foreach($mec_event as $key=>$value) {
        $q1 .= "`$key`,";

        if(is_null($value)) $q2 .= "NULL,";
        else $q2 .= "'$value',";
    }

    $db->q("INSERT INTO `#__mec_events` (".trim($q1, ', ').") VALUES (".trim($q2, ', ').")", 'INSERT');

    $repeat_type = get_post_meta($new_post_id, 'mec_repeat_type', true);
    $schedule = $main->getSchedule();
    $schedule->reschedule($new_post_id, $schedule->get_reschedule_maximum($repeat_type));
  }
}, 10, 4 );
