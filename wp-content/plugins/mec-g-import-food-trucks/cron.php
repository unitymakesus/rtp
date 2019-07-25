<?php

/**
 *  Customize cron job from Modern Events Calendar plugin
 *  @link /wp-content/plugins/modern-events-calendar/app/crons/g-import.php
 */

// WP Initiatlizing
function mec_find_wordpress_base_path()
{
    $dir = dirname(__FILE__);

    do
    {
        if(file_exists($dir.'/wp-config.php')) return $dir;
    }
    while($dir = realpath($dir.'/..'));

    return NULL;
}

error_log('hi');

define('BASE_PATH', mec_find_wordpress_base_path().'/');
define('WP_USE_THEMES', false);

global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require(BASE_PATH.'wp-load.php');

// MEC libraries
$main = MEC::getInstance('app.libraries.main');
$db = $main->getDB();

// Get MEC IX options
$ix = $main->get_ix_options();

// Auto sync is disabled
if(!isset($ix['sync_g_import']) or (isset($ix['sync_g_import']) and !$ix['sync_g_import'])) exit(__('Auto Google Calendar import is disabled!', 'mec'));

$api_key = isset($ix['google_import_api_key']) ? $ix['google_import_api_key'] : NULL;
$calendar_id = isset($ix['google_import_calendar_id']) ? $ix['google_import_calendar_id'] : NULL;

if(!trim($api_key) or !trim($calendar_id)) exit(__('Both of API key and Calendar ID are required!', 'mec'));

$client = new Google_Client();
$client->setApplicationName('Modern Events Calendar');
$client->setAccessType('online');
$client->setScopes(array('https://www.googleapis.com/auth/calendar.readonly'));
$client->setDeveloperKey($api_key);

$service = new Google_Service_Calendar($client);

try
{
    // Timezone
    $timezone = $main->get_timezone();

    $args = array();
    $args['timeMin'] = date('c', strtotime('Today'));
    $args['maxResults'] = 500;

    $response = $service->events->listEvents($calendar_id, $args);

    // Imported Events
    $posts = array();

    foreach($response->getItems() as $event)
    {
        // There is not title for event
        if(trim($event->getSummary()) == '') continue;

        try
        {
            $event = $service->events->get($calendar_id, $event->id, array('timeZone' => $timezone));
        }
        catch(Exception $e)
        {
            continue;
        }

        // Event Title and Content
        $title = $event->getSummary();
        $description = $event->getDescription();
        $gcal_ical_uid = $event->getICalUID();
        $gcal_id = $event->getId();

        // Event Start Date and Time
        $start = $event->getStart();

        $g_start_date = $start->getDate();
        $g_start_datetime = $start->getDateTime();

        $date_start = new DateTime((trim($g_start_datetime) ? $g_start_datetime : $g_start_date));
        $start_date = $date_start->format('Y-m-d');
        $start_hour = 11;
        $start_minutes = '30';
        $start_ampm = 'AM';

        // Event End Date and Time
        $end = $event->getEnd();

        $g_end_date = $end->getDate();
        $g_end_datetime = $end->getDateTime();

        $date_end = new DateTime((trim($g_end_datetime) ? $g_end_datetime : $g_end_date));
        $end_date = $date_end->format('Y-m-d');
        $end_hour = 1;
        $end_minutes = '30';
        $end_ampm = 'PM';

        // Date fixeroos
        // It's a one day single event but google sends 2020-12-12 as end date if start date is 2020-12-11
        if(trim($g_end_datetime) == '' and date('Y-m-d', strtotime('-1 day', strtotime($end_date))) == $start_date)
        {
            $end_date = $start_date;
        }

        // Event location
        if ($date_start->format('D') == 'Fri') {
          $location_id = '1198';  // Frontier 600
        } else {
          $location_id = '1197'; // Frontier 800
        }

        // Event Organizer
        $organizer_id = '1201'; // RTP

        // Label/Host
        $label_id = '1205'; // RTP

        // Category
        $category_id = '1202';  // Food Trucks

        // Link to Food Truck Website
        $more_info = $event->getLocation();

        $repeat_status = 0;
        $g_recurrence_rule = '';
        $repeat_type = '';
        $interval = NULL;
        $finish = $end_date;
        $year = NULL;
        $month = NULL;
        $day = NULL;
        $week = NULL;
        $weekday = NULL;
        $weekdays = NULL;

        $args = array
        (
            'title'=>$title,
            'content'=>$description,
            'location_id'=>$location_id,
            'organizer_id'=>$organizer_id,
            'date'=>array
            (
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
                'allday'=>$allday,
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
            'repeat_status'=>$repeat_status,
            'repeat_type'=>$repeat_type,
            'interval'=>$interval,
            'finish'=>$finish,
            'year'=>$year,
            'month'=>$month,
            'day'=>$day,
            'week'=>$week,
            'weekday'=>$weekday,
            'weekdays'=>$weekdays,
            'meta'=>array
            (
                'mec_source'=>'google-calendar',
                'mec_gcal_ical_uid'=>$gcal_ical_uid,
                'mec_gcal_id'=>$gcal_id,
                'mec_gcal_calendar_id'=>$calendar_id,
                'mec_g_recurrence_rule'=>$g_recurrence_rule,
                'mec_allday'=>$allday,
                'mec_more_info'=>$more_info,
                'mec_more_info_title'=>__('Food Truck Website', 'mec'),
                'mec_more_info_target'=>'_blank',
            )
        );

        $post_id = $db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$gcal_id' AND `meta_key`='mec_gcal_id'", 'loadResult');

        // Insert the event into MEC
        $post_id = $main->save_event($args, $post_id);

        // Add it to the imported posts
        $posts[] = $post_id;

        // Set location to the post
        if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

        // Set organizer to the post
        if($organizer_id) wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');

        // Set label to the post
        if($label_id) wp_set_object_terms($post_id, (int) $label_id, 'mec_label');

        // Set categories to the post
        if($category_id) wp_set_object_terms($post_id, (int) $category_id, 'mec_category');

    }

    echo sprintf(__('%s google events imported/updated.', 'mec'), count($posts));
    exit;
}
catch(Exception $e)
{
    $error = $e->getMessage();
    exit($error);
}
