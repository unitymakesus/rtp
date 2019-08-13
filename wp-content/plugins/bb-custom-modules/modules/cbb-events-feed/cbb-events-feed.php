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
		global $wpdb;
		$dates = array();
		$limit = $settings->posts_per_page;

		if ($settings->type == 'cbb-events-feed') {

			// Build Query
			$prefix = $wpdb->get_blog_prefix($site);

			// Start searching today
			$today = current_time('Y-m-d');
			$seconds_start = strtotime($today);

			// Search til 2 years from now
			$end = date('Y-m-t', strtotime('+1 Year', strtotime($today)));
			if(date('H:i:s', strtotime($end)) == '00:00:00') $end .= ' 23:59:59';
			$seconds_end = strtotime($end);

			// Get matching dates for events in calendar
			$sql = "SELECT * FROM {$prefix}mec_dates
			        WHERE (`tstart`>=%d AND `tend`<=%d) OR (`tstart`<=%d AND `tend`>=%d) OR (`tstart`<=%d AND `tend`>=%d)
			        AND 1=1 ORDER BY `tstart` ASC";

			$query = $wpdb->prepare($sql, $seconds_start, $seconds_end, $seconds_end, $seconds_end, $seconds_start, $seconds_start, $order);
			$mec_dates = $wpdb->get_results($query);

			$dates = array();

			foreach ($mec_dates as $mec_date) {
			  $s = strtotime($mec_date->dstart);
			  $e = strtotime($mec_date->dend);

			  // Hide Events Based on End Time
				// $now = time();
			  // if($now >= $mec_date->tend) continue;

				// Get array of dates
				$d = date('Y-m-d', $s);
			  $dates[$d][] = $mec_date->post_id;

			}

			$query_args = array(
				'post_type' => 'mec-events',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'posts_per_page' => '3',
				'meta_key' => 'mec_start_date',
			);

			$found = 0;
			$events = array();

			foreach ($dates as $date=>$IDs) {

				$query_args['post__in'] = $IDs;

				if ($settings->tax_post_category_matching !== "1") {
					$operator = 'NOT IN';
				} else {
					$operator = 'IN';
				}

				if (!empty($settings->tax_post_category)) {
					$query_args['tax_query'] = array(
						array(
							'taxonomy' => 'mec_category',
							'field' => 'term_id',
							'terms' => $settings->tax_post_category,
							'operator' => $operator
						)
					);
				}

				$query = new WP_Query($query_args);

				$found += $query->found_posts;
				$results = $query->posts;

				foreach ($results as $result) {
					$events[] = array(
						'date' => $date,
						'result' => $result
					);
				}

				// Exit if we have found enough posts
				if ($found >= $limit) break;
			}

			return $events;

		}

	}

}

?>
