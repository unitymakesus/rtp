<?php
/**
 * Calls the Google Sheets API to get the list of Food Trucks
 * @return [type] [description]
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
    $map = syncToCalendar($data);
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
  for ($i = 0; $i < sizeof($row); $i++) {
    $fieldFromHdr = $row[$i];
    foreach ($titleRowMap as $titleKey => $titleVal) {
      if ($titleRowMap[$titleKey] == $fieldFromHdr) {
        array_push($idxMap, $titleKey);
        break;
      }
    }
    if (sizeof($idxMap) <= $i) {
      // Header field not in map, so add null
      array_push($idxMap, null);
    }
  }
  return $idxMap;
}

// Pulls from spreadsheet and inserts into calendar
function syncToCalendar($data) {

  // Map headers to indices
  $idxMap = createIdxMap($data[0]);

  return $idxMap;
}
