<?php

class CbbEventsFeedModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Events Feed', 'fl-builder' ),
			'description'     => __( 'A module that pulls in upcoming events from the calendar.', 'fl-builder' ),
			'icon'            => 'format-aside.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-events-feed/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-events-feed/'
		));

		// Include custom CSS
		$this->add_css('cbb-figure-card', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
		$this->add_css('cbb-blog-events-feeds', CBB_MODULES_URL . 'dist/styles/cbb-blog-events-feeds.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'modules/cbb-events-feed/images/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'modules/cbb-events-feed/images/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	public function siteBadge() {
    $postID = get_the_ID();
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

		if ($settings->type == 'cbb-events-feed') {

			$limit = (int)$settings->posts_per_page;
			$show_ended = $settings->show_ended;

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

			// Start searching today
			$today = strtotime(current_time('Y-m-d'));

			// Search til 1 year from now
			$end = date('Y-m-t', strtotime('+1 Year', $today));
			if(date('H:i:s', strtotime($end)) == '00:00:00') $end .= ' 23:59:59';
			$one_year_away = strtotime($end);

			// Get MEC events!
			$dates = $this->get_ids_for_query($today, $one_year_away, $show_ended);
			$events = $this->get_events($limit, $dates, $operator, $tax_post_category);

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

?>
