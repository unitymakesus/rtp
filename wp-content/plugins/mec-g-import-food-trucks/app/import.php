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
  $options = get_option( 'mecft_options' );
  $count = 0;

  $client = new Google_Client();
  $client->setAccessType('offline');
  $client->setApplicationName("MEC Food Trucks Import");
  $client->setDeveloperKey($options['mecft_api_key']);
  $client->setRedirectUri('http://localhost:3000/wp-admin/options-general.php?page=mecft');
  $client->setScopes(Google_Service_Sheets::SPREADSHEETS);

  // Set up Google Sheets Service
  $service = new Google_Service_Sheets($client);
  $spreadsheetId = $options['mecft_sheet_id'];

  // Get sheets that are labeled with this year and next (e.g. 2019 and 2020)
  $years = [
    date('Y'),
    date('Y', strtotime('+1 year'))
  ];

  // Test the connection
  try {
    $sheet = $service->spreadsheets_values->get($spreadsheetId, $year);
  } catch(Exception $e) {
    $e->getMessage();
    return $e->getMessage;
  }

  // Delete all upcoming food truck events from MEC
  deleteExistingEvents();

  // Go through sheets one at a time
  foreach ($years as $year) {
    // Query the service for the results
    $sheet = $service->spreadsheets_values->get($spreadsheetId, $year);

    // Set the beginning and end dates that should be imported.
    $last_midnight = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $notBefore = date('U', $last_midnight);
    $notAfter = date('U', mktime(0, 0, 0, 12, 31, 2500));

    // Process the rows
    $data = $sheet->getValues();
    $numAdded = syncToCalendar($data, $notBefore, $notAfter, $options);

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
 * @param  array $options   Plugin options
 * @return [type]            [description]
 */
function syncToCalendar($data, $notBefore, $notAfter, $options) {
  $numAdded = 0;
  $eventsAdded = false;

  // Initialize MEC libraries
  $main = MEC::getInstance('app.libraries.main');
  $db = $main->getDB();

  // Map headers to indices
  $idxMap = createIdxMap($data[0]);
  array_shift($data);

  // Get properly formatted events
  $cleanEvents = cleanData($data, $idxMap, $notBefore, $notAfter, $options);

  // Loop through properly formatted events to finally add/update
  foreach ($cleanEvents as $event) {

    // Set up custom event title and description for daily trucks and rodeos
    if (empty($event['rodeo'])) {
      $title = $options['mecft_default_daily_title'] . ': ' . $event['title'];
      $description = $options['mecft_default_daily_desc'] . "\n\nToday's truck is: <a href='" . $event['website'] . "' target='_blank' rel='noopener'>" . $event['title'] . "</a>";
      $img = $options['mecft_default_daily_img'];
      $truck = $event['title'];
      $location_id = '1197'; // Frontier 800
    } else {
      $title = $options['mecft_default_rodeo_title'];
      $description = $options['mecft_default_rodeo_desc'] . "\n\nRodeo trucks include:\n<ul>";
      $img = $options['mecft_default_rodeo_img'];
      $truck = json_encode($trucks);
      $location_id = '1198';  // Frontier 600

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
      'organizer_id'=>$organizer_id,
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
    wp_set_object_terms($post_id, (int) '1201', 'mec_organizer');

    // Set categories to the post (Food Trucks)
    wp_set_object_terms($post_id, (int) '1202', 'mec_category');

    // Set featured image / thumbnail to the post
    if($img) set_post_thumbnail($post_id, $img);

    // Increase count of # added
    $numAdded ++;
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
 * @param  array  $options   Plugin options
 * @return array             Cleaned up events for import
 */
function cleanData($data, $idxMap, $notBefore, $notAfter, $options) {

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
    $sheetEvent['ridx'] = $rdix;

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

    // Wrangle rodeo trucks into single event
    if (!empty($sheetEvent['rodeo'])) {

      // Only set these variables for the first rodeo row in a series
      if ($rodex == false) {
        $rodex = $ridx;
        $rodate = $starttime;
      }

      // Check the date is the same as the previous rodeo row
      if ($rodate == $starttime) {
        // Add truck from this row to the first rodeo row in group
        $cleanEvents[$rodex]['trucks'][] = [
          'title' => $sheetEvent['title'],
          'website' => $sheetEvent['website']
        ];

        // Set title of rodeo event
        $cleanEvents[$rodex]['title'] = $options['mecft_default_rodeo_title'];
      }

      // If this is a subsequent rodeo row
      if ($rodex !== $ridx) {
        // Remove this row
        // unset($data[$ridx]);
        continue;
      }

    } else {
      // Reset rodeo variables to catch the next ones
      $rodex = false;
      $rodate = false;
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
 * Delete all upcoming food truck events from calendar
 * @param  [type]  $value [description]
 * @return boolean        [description]
 */
function deleteExistingEvents() {
  global $wpdb;
  $category = get_term_by('slug', 'food-trucks', 'mec_category');
  $last_midnight = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  $notBefore = date('U', $last_midnight);

  $sql = "SELECT $wpdb->posts.ID FROM $wpdb->posts
            LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
            INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
            INNER JOIN wp_mec_dates AS mecd ON ($wpdb->posts.ID = mecd.post_id)
            WHERE 1=1
            AND ($wpdb->term_taxonomy.term_id IN (%d))
            AND $wpdb->posts.post_type = %s
            AND $wpdb->posts.post_status = %s
            AND mecd.tstart > %d
            ORDER BY mecd.tstart";
  $query = $wpdb->prepare($sql, $category->term_id, 'mec-events', 'publish', $notBefore);
  $results = $wpdb->get_results($query);

  // Permanently delete (bypass trash) all these events
  foreach ($results as $post) {
    wp_delete_post($post->ID, true);
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
