<?php

class CbbTodayFeedModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Today Feed', 'fl-builder' ),
			'description'     => __( 'A module that pulls in today\'s events from the calendar and Frontier building schedule.', 'fl-builder' ),
			'icon'            => 'today.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-today-feed/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-today-feed/'
		));

		// Include custom CSS
		$this->add_css('cbb-figure-card', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
		$this->add_css('cbb-blog-events-feeds', CBB_MODULES_URL . 'dist/styles/cbb-blog-events-feeds.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'assets/icons/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'assets/icons/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	/**
	 * Function to get the badge label
	 *
	 * @return string $siteName shows the site of the original content
	 */
	public function siteBadge($postID) {
    $siteID = get_post_meta($postID, 'dt_original_blog_id', true);
    if ($siteID == 1) {
      $siteName = 'RTP';
    } else {
      $siteData = get_blog_details($siteID, true);
      $siteName = $siteData->blogname;
    }
    return $siteName;
  }

	/**
	 * Query MEC events
	 *
	 * @param object $settings from the module
	 * @return array of events
   */
	public function query_events($settings) {

		if ($settings->type == 'cbb-today-feed') {

			$limit = (int)$settings->posts_per_page;
			$show_ended = true;

			// Does this need a category query?
			if ($settings->tax_post_category_matching !== "1") {
				$operator = 'NOT IN';
			} else {
				$operator = 'IN';
			}

			if (!empty($settings->tax_post_category)) {
				$tax_post_category = $settings->tax_post_category;
			} else {
				$tax_post_category = false;
			}

			date_default_timezone_set(get_option('timezone_string'));

			// Start searching today
			$today = strtotime(current_time('Y-m-d'));

			// Search til the end of today!
			if(date('H:i:s', $today) == '00:00:00') $end .= ' 23:59:59';
			$end_of_today = strtotime($end);

			// Get MEC events!
			$dates = $this->get_ids_for_query($today, $end_of_today, $show_ended);
			$events = $this->get_events($limit, $dates, $operator, $tax_post_category);
			$found = sizeof($events);

			// Get more upcoming events if there are not enough to fill out the view
			if ($found < $limit) {

				// Add "plan ahead" placeholder
				$events[] = "Coming up...";
				$found ++;

				// Set new limit for query
				$newlimit = $limit - $found;

				// Start searching tomorrow
				$tomorrow = strtotime('+1 Day', $today);

				// Search til one month from now
				$end = date('Y-m-t', strtotime('+1 Month', $today));
				if(date('H:i:s', strtotime($end)) == '00:00:00') $end .= ' 23:59:59';
				$one_month_away = strtotime($end);

				$moredates = $this->get_ids_for_query($tomorrow, $one_month_away, $show_ended);
				$moreevents = $this->get_events($newlimit, $moredates, $operator, $tax_post_category);

				$events = array_merge($events, $moreevents);
			}

			return $events;

		}

	}

	/**
	 * Build the query to get MEC events
	 *
	 * @param  integer $seconds_start
	 * @param  integer $seconds_end
	 * @param	 bool    $show_ended
	 * @return array   $dates
	 */
	private function get_ids_for_query($seconds_start, $seconds_end, $show_ended) {
		global $wpdb;
		$dates = array();

		$prefix = $wpdb->get_blog_prefix($site);

		// Get matching dates for any events in the database
		$sql = "SELECT * FROM {$prefix}mec_dates
						WHERE (`tstart`>=%d AND `tend`<=%d) OR (`tstart`<=%d AND `tend`>=%d) OR (`tstart`<=%d AND `tend`>=%d)
						AND 1=1 ORDER BY `tstart` ASC";

		$query = $wpdb->prepare($sql, $seconds_start, $seconds_end, $seconds_end, $seconds_end, $seconds_start, $seconds_start, $order);
		$mec_dates = $wpdb->get_results($query);

		// Create array of dates with post IDs to query
		foreach ($mec_dates as $mec_date) {
		  $s = strtotime($mec_date->dstart);
		  $e = strtotime($mec_date->dend);

			// Hide Events Based on End Time
			if (!$show_ended) {
				$now = time();
			  if($now >= $mec_date->tend) continue;
			}

			// Get array of dates
			$d = date('Y-m-d', $s);
		  $dates[$d][] = $mec_date->post_id;
		}

		return $dates;
	}

	/**
	 * Build the query to get MEC events
	 * @param  [type] $limit             [description]
	 * @param  [type] $dates             [description]
	 * @param  [type] $operator          [description]
	 * @param  [type] $tax_post_category [description]
	 * @return [type]                    [description]
	 */
	private function get_events($limit, $dates, $operator, $tax_post_category) {
		$found = 0;
		$events = array();

		$query_args = array(
			'post_type' => 'mec-events',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'posts_per_page' => '-1',
			'meta_key' => 'mec_start_date',
		);

		foreach ($dates as $date=>$IDs) {

			$query_args['post__in'] = $IDs;

			if (!empty($tax_post_category)) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'mec_category',
						'field' => 'term_id',
						'terms' => $tax_post_category,
						'operator' => $operator
					)
				);
			}

			$query = new WP_Query($query_args);
			$results = $query->posts;

			foreach ($results as $result) {
				$events[] = array(
					'date' => $date,
					'result' => $result
				);

				$found = sizeof($events);

				// Exit if we have found enough posts
				if ($found >= $limit) break 2;
			}
		}

		return $events;

	}

}

/*
	Register the module
 */
FLBuilder::register_module( 'CbbTodayFeedModule', [
	'cbb-today-feed-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-today-feed' => [
				'title' => __( 'Content', 'cbb' ),
				'fields' => [
					'posts_per_page' => [
						'type'        => 'text',
						'label'       => __( 'Post Count', 'uabb' ),
						'help'        => __( 'Enter the total number of events you want to display in module.', 'cbb' ),
						'default'     => '3',
						'size'        => '8',
						'placeholder' => '3',
					],
					'tax_post_category_matching' => [
						'type'    => 'select',
						'label'   => 'Event Category',
						'help'    => __( 'Enter a comma separated list of categories. Only posts with these categories will be shown.', 'cbb' ),
						'options' => [
							'1' => __( 'Match these categories', 'cbb' ),
							'0' => __( 'Do not match these categories', 'cbb' )
						]
					],
					'tax_post_category' => [
						'type'   => 'suggest',
						'action' => 'fl_as_terms',
						'data'   => 'mec_category',
						'label'  => '&nbsp',
					]
				]
			]
		]
	]
] );
?>
