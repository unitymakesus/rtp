<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC single class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_skin_single extends MEC_skins
{
    /**
     * @var string
     */
    public $skin = 'single';

    public $uniqueid;
    public $date_format1;
    
    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Registers skin actions into WordPress
     * @author Webnus <info@webnus.biz>
     */
    public function actions()
    {
        $this->factory->action('wp_ajax_mec_load_single_page', array($this, 'load_single_page'));
        $this->factory->action('wp_ajax_nopriv_mec_load_single_page', array($this, 'load_single_page'));
    }
    
    /**
     * Initialize the skin
     * @author Webnus <info@webnus.biz>
     * @param array $atts
     */
    public function initialize($atts)
    {
        $this->atts = $atts;

        // MEC Settings
        $this->settings = $this->main->get_settings();
        
        // Date Formats
        $this->date_format1 = (isset($this->settings['single_date_format1']) and trim($this->settings['single_date_format1'])) ? $this->settings['single_date_format1'] : 'M d Y';

        // Single Event Layout
        $this->layout = isset($this->atts['layout']) ? $this->atts['layout'] : NULL;
        
        // Search Form Status
        $this->sf_status = false;
        
        // HTML class
        $this->html_class = '';
        if(isset($this->atts['html-class']) and trim($this->atts['html-class']) != '') $this->html_class = $this->atts['html-class'];
        
        // From Widget
        $this->widget = (isset($this->atts['widget']) and trim($this->atts['widget'])) ? true : false;
        
        // Init MEC
        $this->args['mec-skin'] = $this->skin;
        
        $this->id = isset($this->atts['id']) ? $this->atts['id'] : 0;
        $this->uniqueid = mt_rand(1000, 10000);
        $this->maximum_dates = isset($this->atts['maximum_dates']) ? $this->atts['maximum_dates'] : 6;
    }

    /**
     * Breadcrumbs On Single
     * @author Webnus <info@webnus.biz>
     */    
    public function MEC_breadcrumbs($page_id)
    {	
        $breadcrumbs_icon = '<i class="mec-color mec-sl-arrow-right"></i>'; // breadcrumbs_icon between crumbs
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        global $post;
        $homeURL = esc_url(home_url('/'));
        echo '<div class="mec-address"><a href="' . esc_url($homeURL) . '"> ' . __('Home', 'mec') . ' </a> ' . $breadcrumbs_icon . ' ';
        $get_mec_archive_title = new MEC_main;
        $crumbs_title = $get_mec_archive_title->get_archive_title();
        $MEC_CPT = get_post_type_object(get_post_type());
        $slug = $MEC_CPT->rewrite;
        echo '<a href="' . $homeURL . $slug['slug'] . '/">' . $crumbs_title . '</a>';
        if ($showCurrent == 1) echo ' ' . $breadcrumbs_icon . ' ' . '<span class="mec-current">' . get_the_title($page_id) . '</span></div>';
    }

    /**
     * Search and returns the filtered events
     * @author Webnus <info@webnus.biz>
     * @return array of objects
     */
    public function search()
    {
        // Original Event ID for Multilingual Websites
        $original_event_id = $this->main->get_original_event($this->id);

        $events = array();
        $rendered = $this->render->data($this->id, (isset($this->atts['content']) ? $this->atts['content'] : ''));

        // Event Repeat Type
        $repeat_type = !empty($rendered->meta['mec_repeat_type']) ?  $rendered->meta['mec_repeat_type'] : '';

        $occurrence = isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : date('Y-m-d');
        
        if(strtotime($occurrence) and in_array($repeat_type, array('certain_weekdays', 'custom_days'))) $occurrence = date('Y-m-d', strtotime($occurrence));
        elseif(strtotime($occurrence)) $occurrence = date('Y-m-d', strtotime('-1 day', strtotime($occurrence)));
        else $occurrence = NULL;

        $data = new stdClass();
        $data->ID = $this->id;
        $data->data = $rendered;

        // Get Event Dates
        $dates = $this->render->dates($this->id, $rendered, $this->maximum_dates, $occurrence);

        // Remove First Date if it is already started!
        if(!isset($_GET['occurrence']) or (isset($_GET['occurrence']) and !trim($_GET['occurrence'])))
        {
            $start_date = (isset($dates[0]['start']) and isset($dates[0]['start']['date'])) ? $dates[0]['start']['date'] : current_time('Y-m-d');

            $s_time = '';
            $s_time .= sprintf("%02d", $dates[0]['start']['hour']).':';
            $s_time .= sprintf("%02d", $dates[0]['start']['minutes']);
            $s_time .= trim($dates[0]['start']['ampm']);

            $start_time = date('D M j Y G:i:s', strtotime($start_date.' '.$s_time));

            $d1 = new DateTime($start_time);
            $d2 = new DateTime(current_time("D M j Y G:i:s"));

            if($d1 < $d2)
            {
                unset($dates[0]);

                // Get Event Dates
                $dates = $this->render->dates($this->id, $rendered, $this->maximum_dates);
            }
        }

        $data->dates = $dates;
        $data->date = isset($data->dates[0]) ? $data->dates[0] : array();

        // Set some data from original event in multilingual websites
        if($this->id != $original_event_id)
        {
            $original_tickets = get_post_meta($original_event_id, 'mec_tickets', true);

            $rendered_tickets = array();
            foreach($original_tickets as $ticket_id=>$original_ticket)
            {
                if(!isset($data->data->tickets[$ticket_id])) continue;
                $rendered_tickets[$ticket_id] = array(
                    'name' => $data->data->tickets[$ticket_id]['name'],
                    'description' => $data->data->tickets[$ticket_id]['description'],
                    'price' => $original_ticket['price'],
                    'price_label' => $original_ticket['price_label'],
                    'limit' => $original_ticket['limit'],
                    'unlimited' => $original_ticket['unlimited'],
                );
            }

            if(count($rendered_tickets)) $data->data->tickets = $rendered_tickets;
            else $data->data->tickets = $original_tickets;

            $data->ID = $original_event_id;
            $data->dates = $this->render->dates($original_event_id, $rendered, $this->maximum_dates, $occurrence);
            $data->date = isset($data->dates[0]) ? $data->dates[0] : array();
        }

        $events[] = $data;
        return $events;
    }

    public function get_event_mec($event_ID)
    {
        // Original Event ID for Multilingual Websites
        $original_event_id = $this->main->get_original_event($event_ID);

        $events = array();
        $rendered = $this->render->data($event_ID, (isset($this->atts['content']) ? $this->atts['content'] : ''));

        // Event Repeat Type
        $repeat_type = !empty($rendered->meta['mec_repeat_type']) ?  $rendered->meta['mec_repeat_type'] : '';

        $occurrence = isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : NULL;
        
        if(strtotime($occurrence) and in_array($repeat_type, array('certain_weekdays', 'custom_days'))) $occurrence = date('Y-m-d', strtotime($occurrence));
        elseif(strtotime($occurrence)) $occurrence = date('Y-m-d', strtotime('-1 day', strtotime($occurrence)));
        else $occurrence = NULL;

        $data = new stdClass();
        $data->ID = $event_ID;
        $data->data = $rendered;
        $data->dates = $this->render->dates($event_ID, $rendered, $this->maximum_dates, $occurrence);
        $data->date = isset($data->dates[0]) ? $data->dates[0] : array();

        // Set some data from original event in multilingual websites
        if($event_ID != $original_event_id)
        {
            $original_tickets = get_post_meta($original_event_id, 'mec_tickets', true);

            $rendered_tickets = array();
            foreach($original_tickets as $ticket_id=>$original_ticket)
            {
                if(!isset($data->data->tickets[$ticket_id])) continue;
                $rendered_tickets[$ticket_id] = array(
                    'name' => $data->data->tickets[$ticket_id]['name'],
                    'description' => $data->data->tickets[$ticket_id]['description'],
                    'price' => $original_ticket['price'],
                    'price_label' => $original_ticket['price_label'],
                    'limit' => $original_ticket['limit'],
                    'unlimited' => $original_ticket['unlimited'],
                );
            }

            if(count($rendered_tickets)) $data->data->tickets = $rendered_tickets;
            else $data->data->tickets = $original_tickets;

            $data->ID = $original_event_id;
            $data->dates = $this->render->dates($original_event_id, $rendered, $this->maximum_dates, $occurrence);
            $data->date = isset($data->dates[0]) ? $data->dates[0] : array();
        }

        $events[] = $data;
        return $events;
    }
    
    /**
     * Load Single Event Page for AJAX requert
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function load_single_page()
    {
        $id = isset($_GET['id']) ? sanitize_text_field($_GET['id']) : 0;
        $layout = isset($_GET['layout']) ? sanitize_text_field($_GET['layout']) : 'm1';
        
        // Initialize the skin
        $this->initialize(array('id'=>$id, 'layout'=>$layout));
        
        // Fetch the events
        $this->fetch();
        
        // Return the output
        echo $this->output();
        exit;
    }

    /**
     * @author Webnus <info@webnus.biz>
     * @param string $k
     * @param array $arr
     * @return mixed
     */
    public function found_value($k, $arr)
    {
        $dummy = new Mec_Single_Widget();
        $settings = $dummy->get_settings(); 

        $arr = end($settings);
        $ids = array();

        if(is_array($arr) or is_object($arr))
        {
            foreach($arr as $key=>$value)
            {
                if($key === $k) $ids[] = $value;
            }
        }

        return isset($ids[0]) ? $ids[0] : array();
    }

    /**
     * @param object $event
     * @return void
     */
    public function show_other_organizers($event)
    {
        $additional_organizers_status = (!isset($this->settings['additional_organizers']) or (isset($this->settings['additional_organizers']) and $this->settings['additional_organizers'])) ? true : false;
        if(!$additional_organizers_status) return;

        $organizers = array();
        foreach($event->data->organizers as $o) if($o['id'] != $event->data->meta['mec_organizer_id']) $organizers[] = $o;

        if(!count($organizers)) return;
        ?>
        <div class="mec-single-event-additional-organizers">
            <h3 class="mec-events-single-section-title"><?php echo $this->main->m('other_organizers', __('Other Organizers', 'mec')); ?></h3>
            <?php foreach($organizers as $organizer): if($organizer['id'] == $event->data->meta['mec_organizer_id']) continue; ?>
                <div class="mec-single-event-additional-organizer">
                    <?php if(isset($organizer['thumbnail']) and trim($organizer['thumbnail'])): ?>
                        <img class="mec-img-organizer" src="<?php echo esc_url($organizer['thumbnail']); ?>" alt="<?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?>">
                    <?php endif; ?>
                    <?php if(isset($organizer['thumbnail'])): ?>
                        <dd class="mec-organizer">
                            <i class="mec-sl-home"></i>
                            <h6><?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?></h6>
                        </dd>
                    <?php endif;
                    if(isset($organizer['tel']) && !empty($organizer['tel'])): ?>
                        <dd class="mec-organizer-tel">
                            <i class="mec-sl-phone"></i>
                            <h6><?php _e('Phone', 'mec'); ?></h6>
                            <a href="tel:<?php echo $organizer['tel']; ?>"><?php echo $organizer['tel']; ?></a>
                        </dd>
                    <?php endif;
                    if(isset($organizer['email']) && !empty($organizer['email'])): ?>
                        <dd class="mec-organizer-email">
                            <i class="mec-sl-envelope"></i>
                            <h6><?php _e('Email', 'mec'); ?></h6>
                            <a href="mailto:<?php echo $organizer['email']; ?>"><?php echo $organizer['email']; ?></a>
                        </dd>
                    <?php endif;
                    if(isset($organizer['url']) && !empty($organizer['url']) and $organizer['url'] != 'http://'): ?>
                        <dd class="mec-organizer-url">
                            <i class="mec-sl-sitemap"></i>
                            <h6><?php _e('Website', 'mec'); ?></h6>
                            <span><a href="<?php echo (strpos($organizer['url'], 'http') === false ? 'http://'.$organizer['url'] : $organizer['url']); ?>" class="mec-color-hover" target="_blank"><?php echo $organizer['url']; ?></a></span>
                        </dd>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
     * @param object $event
     * @return void
     */
    public function show_other_locations($event)
    {
        $additional_locations_status = (!isset($this->settings['additional_locations']) or (isset($this->settings['additional_locations']) and $this->settings['additional_locations'])) ? true : false;
        if(!$additional_locations_status) return;

        $locations = array();
        foreach($event->data->locations as $o) if($o['id'] != $event->data->meta['mec_location_id']) $locations[] = $o;

        if(!count($locations)) return;
        ?>
        <div class="mec-single-event-additional-locations">
            <?php $i = 2 ?>
            <?php foreach($locations as $location): if($location['id'] == $event->data->meta['mec_location_id']) continue; ?>
                <div class="mec-single-event-location">
                    <?php if($location['thumbnail']): ?>
                    <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
                    <?php endif; ?>
                    <i class="mec-sl-location-pin"></i>
                    <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec')); ?> <?php echo $i; ?></h3>
                    <dd class="author fn org"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></dd>
                    <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></span></address></dd>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
     * @param object $event
     * @return void
     */
    public function show_hourly_schedules($event)
    {
        if(isset($event->data->hourly_schedules) and is_array($event->data->hourly_schedules) and count($event->data->hourly_schedules)):

        // Status of Speakers Feature
        $speakers_status = (!isset($this->settings['speakers_status']) or (isset($this->settings['speakers_status']) and !$this->settings['speakers_status'])) ? false : true;
        $speakers = array();
        ?>
        <div class="mec-event-schedule mec-frontbox">
            <h3 class="mec-schedule-head mec-frontbox-title"><?php _e('Hourly Schedule','mec'); ?></h3>
            <?php foreach($event->data->hourly_schedules as $day): ?>
                <?php if(count($event->data->hourly_schedules) >= 1 and isset($day['title'])): ?>
                    <h4 class="mec-schedule-part"><?php echo $day['title']; ?></h4>
                <?php endif; ?>
                <div class="mec-event-schedule-content">
                    <?php foreach($day['schedules'] as $schedule): ?>
                    <dl>
                        <dt class="mec-schedule-time"><span class="mec-schedule-start-time mec-color"><?php echo $schedule['from']; ?></span> - <span class="mec-schedule-end-time mec-color"><?php echo $schedule['to']; ?></span> </dt>
                        <dt class="mec-schedule-title"><?php echo $schedule['title']; ?></dt>
                        <dt class="mec-schedule-description"><?php echo $schedule['description']; ?></dt>

                        <?php if($speakers_status and isset($schedule['speakers']) and is_array($schedule['speakers']) and count($schedule['speakers'])): ?>
                        <dt class="mec-schedule-speakers">
                            <h6><?php echo $this->main->m('taxonomy_speakers', __('Speakers:', 'mec')); ?></h6>
                            <?php $speaker_count = count($schedule['speakers']);  $i = 0; ?>
                            <?php foreach($schedule['speakers'] as $speaker_id): $speaker = get_term($speaker_id); array_push($speakers, $speaker_id); ?>
                            <a class="mec-color-hover mec-hourly-schedule-speaker-lightbox" href="#mec_hourly_schedule_speaker_lightbox_<?php echo $speaker->term_id; ?>" data-lity><?php echo $speaker->name; ?></a><?php if( ++$i != $speaker_count ) echo ","; ?>
                            <?php endforeach; ?>
                        </dt>
                        <?php endif; ?>
                    </dl>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <?php if(count($speakers)): $speakers = array_unique($speakers); foreach($speakers as $speaker_id): $speaker = get_term($speaker_id); ?>
            <div class="lity-hide mec-hourly-schedule-speaker-info" id="mec_hourly_schedule_speaker_lightbox_<?php echo $speaker->term_id; ?>">
                <!-- Speaker Thumbnail -->
                <?php if($thumbnail = trim(get_term_meta($speaker->term_id, 'thumbnail', true))): ?>
                <div class="mec-hourly-schedule-speaker-thumbnail">
                    <img src="<?php echo $thumbnail; ?>" alt="<?php echo $speaker->name; ?>">
                </div>
                <?php endif; ?>
                <div class="mec-hourly-schedule-speaker-details">
                    <!-- Speaker Name -->
                    <div class="mec-hourly-schedule-speaker-name">
                        <?php echo $speaker->name; ?>
                    </div>
                    <!-- Speaker Job Title -->
                    <?php if($job_title = trim(get_term_meta($speaker->term_id, 'job_title', true))): ?>
                    <div class="mec-hourly-schedule-speaker-job-title mec-color">
                        <?php echo $job_title; ?>
                    </div>
                    <?php endif; ?>
                    <div class="mec-hourly-schedule-speaker-contact-information">
                        <!-- Speaker Telephone -->
                        <?php if($tel = trim(get_term_meta($speaker->term_id, 'tel', true))): ?>
                            <a href="tel:<?php echo $tel; ?>"><i class="mec-fa-phone"></i></a>
                        <?php endif; ?>
                        <!-- Speaker Email -->
                        <?php if($email = trim(get_term_meta($speaker->term_id, 'email', true))): ?>
                            <a href="mailto:<?php echo $email; ?>" target="_blank"><i class="mec-fa-envelope"></i></a>
                        <?php endif; ?>
                        <!-- Speaker Facebook page -->
                        <?php if($facebook = trim(get_term_meta($speaker->term_id, 'facebook', true))): ?>
                        <a href="<?php echo $facebook; ?>" target="_blank"><i class="mec-fa-facebook"></i></a>
                        <?php endif; ?>
                        <!-- Speaker Twitter -->
                        <?php if($twitter = trim(get_term_meta($speaker->term_id, 'twitter', true))): ?>
                        <a href="<?php echo $twitter; ?>" target="_blank"><i class="mec-fa-twitter"></i></a>
                        <?php endif; ?>
                        <!-- Speaker Google Plus -->
                        <?php if($instagram = trim(get_term_meta($speaker->term_id, 'instagram', true))): ?>
                        <a href="<?php echo $instagram; ?>" target="_blank"><i class="mec-fa-instagram"></i></a>
                        <?php endif; ?>
                    </div>
                    <!-- Speaker Description -->
                    <?php if(trim($speaker->description)): ?>
                    <div class="mec-hourly-schedule-speaker-description">
                        <?php echo $speaker->description; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <?php endif;
    }
}