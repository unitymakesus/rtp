<?php
/**
 * Calls the Google Sheets API to get the list of food trucks
 * then imports them into Modern Events Calendar
 *
 * These functions are converted to PHP from Javascript
 * https://github.com/Davepar/gcalendarsync
 *
 */


/**
 * Gets data from Google Sheets
 * @return string     Success or error message
 */
function mecft_import() {
  $connect = get_option( 'mecft_connect' );

  $client = new Google_Client();
  $client->setAccessType('offline');
  $client->setApplicationName("MEC Food Trucks Import");
  $client->setDeveloperKey($connect['mecft_connect_api_key']);
  $client->setRedirectUri('https://frontier.rtp.org/wp-admin/options-general.php?page=mecft');
  $client->setScopes(Google_Service_Sheets::SPREADSHEETS);

  // Set up Google Sheets Service
  $service = new Google_Service_Sheets($client);
  $spreadsheetId = $connect['mecft_connect_sheet_id'];

  // Get sheets that are labeled with this year and next (e.g. 2019 and 2020)
  $years = [
    date('Y'),
    date('Y', strtotime('+1 year'))
  ];

  // Test the connection
  try {
    $sheet = $service->spreadsheets_values->get($spreadsheetId, $years[0]);
  } catch(Exception $e) {
    error_log(print_r($e, true));
    return 'There was an error importing events. Please contact support@unitymakes.us.';
  }

  // Delete all upcoming food truck events from MEC
  deleteExistingEvents();
  $count = 0;

  // Go through sheets one at a time
  foreach ($years as $year) {
    // Query the service for the results
    $sheet = $service->spreadsheets_values->get($spreadsheetId, $year);

    // Set the beginning and end dates that should be imported.
    date_default_timezone_set('America/New_York');
    $last_midnight = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $notBefore = date('U', $last_midnight);
    // error_log('to import: ' . $notBefore);
    $notAfter = date('U', mktime(0, 0, 0, 12, 31, 2500));

    // Process the rows
    $data = $sheet->getValues();
    $numAdded = syncToCalendar($data, $notBefore, $notAfter);

    $count = $count + $numAdded;
  }

  return $count . ' events imported!';
}

// Pulls from spreadsheet and inserts into calendar
/**
 * Pulls from spreadhseet and inserts into calendar
 * @param  array $data      Google Sheet Data
 * @param  int   $notBefore Unix time of last midnight
 * @param  int   $notAfter  Unix time of the end of the year 2500
 * @return int              Number of added events
 */
function syncToCalendar($data, $notBefore, $notAfter) {
  $numAdded = 0;
  $eventsAdded = false;

  $settings_daily = get_option('mecft_daily');
  $settings_rodeo = get_option('mecft_rodeo');

  // Initialize MEC libraries
  $main = MEC::getInstance('app.libraries.main');

  // Map headers to indices
  $idxMap = createIdxMap($data[0]);
  array_shift($data);

  // Get properly formatted events
  $cleanEvents = cleanData($data, $idxMap, $notBefore, $notAfter);

  // Loop through properly formatted events to finally add/update
  foreach ($cleanEvents as $event) {

    // Set up custom event title and description for daily trucks and rodeos
    if (empty($event['rodeo'])) {
      $title = $settings_daily['mecft_default_daily_title'] . ': ' . $event['title'];
      $description = $settings_daily['mecft_default_daily_desc'] . "\n\nToday's truck is: <a href='" . $event['website'] . "' target='_blank' rel='noopener'>" . $event['title'] . "</a>";
      $img = $settings_daily['mecft_default_daily_img'];
      $truck = $event['title'];
      $location_id = 24; // Frontier 800
    } else {
      $title = $settings_rodeo['mecft_default_rodeo_title'];
      $description = $settings_rodeo['mecft_default_rodeo_desc'] . "\n\nRodeo trucks include:\n<ul>";
      $img = $settings_rodeo['mecft_default_rodeo_img'];
      $truck = json_encode($trucks);
      $location_id = 752;  // Frontier 700 | Parking Lot

      foreach ($event['trucks'] as $truck) {
        $description .= '<li><a href="' . $truck['website'] . '" target="_blank" rel="noopener">';
        $description .= $truck['title'];
        $description .= '</a></li>';
      }
    }

    $date_start = $event['starttime'];
    $start_date = date('Y-m-d', $date_start);
    $start_hour = date('g', $date_start);
    $start_minutes = date('i', $date_start);
    $start_ampm = date('a', $date_start);

    $date_end = $event['endtime'];
    $end_date = date('Y-m-d', $date_end);
    $end_hour = date('g', $date_end);
    $end_minutes = date('i', $date_end);
    $end_ampm = date('a', $date_end);

    $args = array(
      'title'=>$title,
      'content'=>$description,
      'location_id'=>$location_id,
      'organizer_id'=>27,
      'date'=>array(
        'start'=>array(
          'date'=>$start_date,
          'hour'=>$start_hour,
          'minutes'=>$start_minutes,
          'ampm'=>$start_ampm,
        ),
        'end'=>array(
          'date'=>$end_date,
          'hour'=>$end_hour,
          'minutes'=>$end_minutes,
          'ampm'=>$end_ampm,
        ),
        'repeat'=>array(),
        'allday'=>false,
        'comment'=>'',
        'hide_time'=>0,
        'hide_end_time'=>0,
      ),
      'start'=>$start_date,
      'start_time_hour'=>$start_hour,
      'start_time_minutes'=>$start_minutes,
      'start_time_ampm'=>$start_ampm,
      'end'=>$end_date,
      'end_time_hour'=>$end_hour,
      'end_time_minutes'=>$end_minutes,
      'end_time_ampm'=>$end_ampm,
      'repeat_status'=>0,
      'repeat_type'=>'',
      'interval'=>NULL,
      'finish'=>$end_date,
      'year'=>NULL,
      'month'=>NULL,
      'day'=>NULL,
      'week'=>NULL,
      'weekday'=>NULL,
      'weekdays'=>NULL,
      'meta'=>array
      (
          'mec_source'=>'mecft',
          'mec_truck' => $truck,
      )
    );

    // Insert the event into MEC
    $post_id = $main->save_event($args);

    // Set location to the post
    if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

    // Set organizer to the post (RTP)
    wp_set_object_terms($post_id, (int) 27, 'mec_organizer');

    // Set categories to the post (Food Trucks)
    wp_set_object_terms($post_id, (int) 18, 'mec_category');

    // Set featured image / thumbnail to the post
    if($img) set_post_thumbnail($post_id, $img);

    // Increase count of # added
    $numAdded ++;

    // error_log('Original');
    // error_log(print_r($args, true));

    syndicateToMain($post_id, $args);
  }

  return $numAdded;
}

/**
 * Create mapping array between spreadsheet column and event field name
 * @param  array  $row  Data from Google Sheet
 * @return array      Index/Label mapping array
 */
function createIdxMap($row) {

  // Set up the row headers to translate into object keys
  $titleRowMap = [
    'date' => 'Date',
    'title' => 'Title',
    'website' => 'Website',
    'rodeo' => 'Rodeo',
  ];

  $idxMap = [];
  for ($idx = 0; $idx < sizeof($row); $idx++) {
    foreach ($titleRowMap as $titleKey => $titleVal) {
      if ($titleRowMap[$titleKey] == $row[$idx]) {
        $idxMap[] = $titleKey;
        break;
      }
    }
    if (sizeof($idxMap) <= $idx) {
      // Header field not in map, so add null
      $idxMap[] = null;
    }
  }
  return $idxMap;
}

/**
 * Creates a clean list of properly formatted events to import
 * @param  array  $data      Google Sheet Data
 * @param  array  $idxMap    Index/label mapping array
 * @param  int    $notBefore Unix time of last midnight
 * @param  int    $notAfter  Unix time of the end of the year 2500
 * @return array             Cleaned up events for import
 */
function cleanData($data, $idxMap, $notBefore, $notAfter) {

  $rodex = false;
  $rodate = false;
  $cleanEvents = [];

  // Loop through each row
  for ($ridx = 0; $ridx < sizeof($data); $ridx++) {

    // Format row as an event array
    $sheetEvent = reformatEvent($data[$ridx], $idxMap);

    // Skip rows with blank/invalid date or blank titles
    if (!isDate($sheetEvent['date']) || empty($sheetEvent['title'])) {
      continue;
    }

    // Set row index to array for future reference
    $sheetEvent['ridx'] = $ridx;

    // Set start time
    $date = new \DateTime($sheetEvent['date']);
    $date->setTime(11, 30);
    $starttime = $date->format('U');
    $sheetEvent['starttime'] = $starttime;

    // Set endtime
    $date->setTime(13, 30);
    $endtime = $date->format('U');
    $sheetEvent['endtime'] = $endtime;

    // Ignore events outside of begin/end range desired
    if ($starttime > $notAfter || $endtime < $notBefore) {
      continue;
    }

    // Ignore events that say "No truck"
    if (stripos($sheetEvent['title'], 'no truck') !== false) {
      continue;
    }

    // Ignore rodeos
    if (!empty($sheetEvent['rodeo'])) {
      continue;
    }

    // Create master array with clean data to import
    $cleanEvents[$ridx] = $sheetEvent;

  }

  return $cleanEvents;
}


/**
 * Convert row into an array with event fields
 * @param  array  $row    Data from Google Sheets
 * @param  array  $idxMap Index/label mapping array
 * @return array          Array with event fields
 */
function reformatEvent($row, $idxMap) {

  // Make sure arrays are the same size
  $idxMapSize = count($idxMap);
  $rowSize = count($row);
  if ($idxMapSize > $rowSize) {
    $more = $idxMapSize - $rowSize;
    for($i = 0; $i < $more; $i++) {
      $row[] = "";
    }
  }

  // Set values of $idxMap as the keys for $row
  $reformatted = array_combine($idxMap, $row);

  return $reformatted;
}

/**
 * Delete all upcoming food truck events from Frontier calendar
 * @param  [type]  $value [description]
 * @return boolean        [description]
 */
function deleteExistingEvents() {
  global $wpdb;
  date_default_timezone_set('America/New_York');
  $last_midnight = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  $notBefore = date('U', $last_midnight);
  // error_log('to delete: ' . $notBefore);

  // Disable default Distributor deletion
  remove_action( 'before_delete_post', array( '\Distributor\InternalConnections\NetworkSiteConnection', 'separate_syndicated_on_delete' ) );
  remove_action( 'before_delete_post', array( '\Distributor\InternalConnections\NetworkSiteConnection', 'remove_distributor_post_from_original' ) );
  remove_action( 'wp_trash_post', array( '\Distributor\InternalConnections\NetworkSiteConnection', 'separate_syndicated_on_delete' ) );


  // Do this for Frontier and RTP (since posts are syndicated from Frontier to RTP)
  $sites = [2, 1];

  foreach ($sites as $site) {
    switch_to_blog($site);

    $prefix = $wpdb->get_blog_prefix($site);
    $category = get_term_by('slug', 'food-trucks', 'mec_category');
    $rodeo_cat = get_term_by('slug', 'rodeo', 'mec_category');

    $sql = "SELECT {$prefix}posts.ID FROM {$prefix}posts
            LEFT JOIN {$prefix}term_relationships ON ({$prefix}posts.ID = {$prefix}term_relationships.object_id)
            INNER JOIN {$prefix}term_taxonomy ON ({$prefix}term_relationships.term_taxonomy_id = {$prefix}term_taxonomy.term_taxonomy_id)
            INNER JOIN {$prefix}mec_dates ON ({$prefix}posts.ID = {$prefix}mec_dates.post_id)
            WHERE 1=1
            AND ({$prefix}term_taxonomy.term_id IN (%d))
            AND {$prefix}posts.ID NOT IN (
              SELECT object_id FROM {$prefix}term_relationships
              INNER JOIN {$prefix}term_taxonomy ON ({$prefix}term_relationships.term_taxonomy_id = {$prefix}term_taxonomy.term_taxonomy_id)
              WHERE term_id IN (%d)
            )
            AND {$prefix}posts.post_type = %s
            AND {$prefix}posts.post_status = %s
            AND {$prefix}mec_dates.tstart > %d
            ORDER BY {$prefix}mec_dates.tstart";
    $query = $wpdb->prepare($sql, $category->term_id, $rodeo_cat->term_id, 'mec-events', 'publish', $notBefore);
    // error_log($query);
    $results = $wpdb->get_results($query);

    // Permanently delete (bypass trash) all these events
    foreach ($results as $post) {
      wp_delete_post($post->ID, true);
      $wpdb->delete("{$prefix}mec_events", array('post_id' => $post->ID));
      $wpdb->delete("{$prefix}mec_dates", array('post_id' => $post->ID));
    }

    restore_current_blog();
  }
}

/**
 * Tests if value is a valid date
 * @param  string  $value test string
 * @return boolean
 */
function isDate($value) {
  if (!$value) {
    return false;
  }

  try {
    new \DateTime($value);
    return true;
  } catch (\Exception $e) {
    return false;
  }
}

/**
 * Use the Distributor plugin to syndicate these events to the main site calendar
 * @param  int  $post_id   ID of imported event
 */
function syndicateToMain($post_id, $args) {
  $site_id = 1;
  $connection = new \Distributor\InternalConnections\NetworkSiteConnection( get_site($site_id) );
  $args['post_status'] = 'publish';

  // error_log($post_id);

  // Set args for RTP site taxonomies
  $args['organizer_id'] = 1201;
  if ($args['location_id'] == 24) {
    $args['location_id'] = 1197;  // Frontier 800
  } elseif ($args['location_id'] == 23) {
    $args['location_id'] = 1215;   // Frontier 700 | Parking Lot
  }

  // error_log('Syndicated');
  // error_log(print_r($args, true));

  // Do not sync media
  add_filter('dt_push_post_media', function() {
    return false;
  });

  // Push to main site
	$remote_id = $connection->push( $post_id, $args );

  // error_log(print_r($remote_id, true));

	if ( ! is_wp_error( $remote_id ) ) {
		$origin_site = get_current_blog_id();

    // Record the main site's post id for this local post
    switch_to_blog( $site_id );
		$remote_url = get_permalink( $remote_id );
		$connection->log_sync( array( $post_id => $remote_id ), $origin_site );
		restore_current_blog();

		$connection_map['internal'][ $site_id ] = array(
			'post_id' => $remote_id,
			'time'    => time(),
		);

    update_post_meta( $post_id, 'dt_connection_map', $connection_map );
	}
}
