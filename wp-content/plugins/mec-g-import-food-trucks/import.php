<?php
/**
 * Calls the Google Sheets API to get the list of Food Trucks
 * These functions are converted to PHP from the Javascript https://github.com/Davepar/gcalendarsync
 */
function mecft_import() {
  require MECFT_PLUGIN_DIR . 'vendor/autoload.php';

  $mecft_options = get_option( 'mecft_options' );

  // Set up Google Client with API Key
  $client = new Google_Client();
  $client->setApplicationName("MEC Food Trucks Import");
  $client->setDeveloperKey($mecft_options['mecft_api_key']);
  $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
  $client->setAccessType('online');

  // Set up Google Sheets Service
  $service = new Google_Service_Sheets($client);
  $spreadsheetId = $mecft_options['mecft_sheet_id'];

  // Get sheets that are labeled with this year and next (e.g. 2019 and 2020)
  $ranges = [
    date('Y'),
    date('Y', strtotime('+1 year'))
  ];

  // Query the service for the results
  $result = $service->spreadsheets_values->batchGet($spreadsheetId, ['ranges' => $ranges]);
  $ranges = $result->getValueRanges();

  $last_midnight = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

  // Set the beginning and end dates that should be imported.
  $beginDate = date('U', $last_midnight);
  $endDate = date('U', mktime(0, 0, 0, 12, 31, 2500));

  // Go through ranges one at a time
  foreach ($ranges as $range) {
    $data = $range->getValues();
    $map = syncToCalendar($data, $beginDate, $endDate);
  }


  return $map;
}

// Creates a mapping array between spreadsheet column and event field name
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

// Converts a spreadsheet row into an object containing event-related fields
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

// Tests if value is a valid date
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

// Pulls from spreadsheet and inserts into calendar
function syncToCalendar($data) {

  $numAdded = 0;
  $numUpdates = 0;
  $eventsAdded = false;

  // Map headers to indices
  $idxMap = createIdxMap($data[0]);
  array_shift($data);

  // Loop through spreadsheet rows
  for ($ridx = 0; $ridx < sizeof($data); $ridx++) {
    $sheetEvent = reformatEvent($data[$ridx], $idxMap);

    // Convert date to unixtime


    // Skip blank rows with blank/invalid date
    if (!isDate($sheetEvent['date'])) {
      continue;
    }

    // if ()
  }

  return $sheetEvent;
}
