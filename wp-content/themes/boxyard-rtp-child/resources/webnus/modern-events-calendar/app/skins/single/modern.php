<?php
/** no direct access **/
defined('MECEXEC') or die();
?>
<div class="mec-wrap <?php echo $event_colorskin; ?> clearfix <?php echo $this->html_class; ?>" id="mec_skin_<?php echo $this->uniqueid; ?>">
  <article class="row mec-single-event mec-single-modern">
    <!-- start breadcrumbs -->
    <?php
    $breadcrumbs_settings = $settings['breadcrumbs'];
    if($breadcrumbs_settings == '1'):
      $breadcrumbs = new MEC_skin_single; ?>
      <div class="mec-breadcrumbs mec-breadcrumbs-modern">
        <?php $breadcrumbs->MEC_breadcrumbs(get_the_ID()); ?>
      </div>
    <?php endif ;?>
    <!-- end breadcrumbs -->
    <div class="mec-single-event-bar">
      <?php
      // Event Date and Time
      if(isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start']))
      {
        ?>
        <div class="mec-single-event-date">
          <dt class="mec-date"><?php _e('Date', 'mec'); ?></dt>
          <dd><abbr class="mec-events-abbr"><?php echo $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end']) ? $event->date['end'] : NULL)), $this->date_format1); ?></abbr></dd>
        </div>

        <?php
        if(isset($event->data->meta['mec_hide_time']) and $event->data->meta['mec_hide_time'] == '0')
        {
          $time_comment = isset($event->data->meta['mec_comment']) ? $event->data->meta['mec_comment'] : '';
          $allday = isset($event->data->meta['mec_allday']) ? $event->data->meta['mec_allday'] : 0;
          ?>
          <div class="mec-single-event-time">
            <dt class="mec-time"><?php _e('Time', 'mec'); ?></dt>
            <i class="mec-time-comment"><?php echo (isset($time_comment) ? $time_comment : ''); ?></i>

            <?php if($allday == '0' and isset($event->data->time) and trim($event->data->time['start'])): ?>
              <dd><abbr class="mec-events-abbr"><?php echo $event->data->time['start']; ?><?php echo (trim($event->data->time['end']) ? ' - '.$event->data->time['end'] : ''); ?></abbr></dd>
            <?php else: ?>
              <dd><abbr class="mec-events-abbr"><?php _e('All of the day', 'mec'); ?></abbr></dd>
            <?php endif; ?>
          </div>
          <?php
        }
      }
      ?>

      <?php
      // Event Location
      if(isset($event->data->locations[$event->data->meta['mec_location_id']]) and !empty($event->data->locations[$event->data->meta['mec_location_id']]))
      {
        $location = $event->data->locations[$event->data->meta['mec_location_id']];
        ?>
        <div class="mec-single-event-location">
          <dt class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec')); ?></dt>
          <dd class="author fn org"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></dd>
        </div>
        <?php
      }
      ?>

      <?php
      // Event Cost
      if(isset($event->data->meta['mec_cost']) and $event->data->meta['mec_cost'] != '')
      {
        ?>
        <div class="mec-event-cost">
          <dt class="mec-cost"><?php echo $this->main->m('cost', __('Cost', 'mec')); ?></dt>
          <dd class="mec-events-event-cost"><?php echo (is_numeric($event->data->meta['mec_cost']) ? $this->main->render_price($event->data->meta['mec_cost']) : $event->data->meta['mec_cost']); ?></dd>
        </div>
        <?php
      }
      ?>
      <?php do_action('print_extra_costs', $event); ?>
      <?php
      // Event labels
      if(isset($event->data->labels) && !empty($event->data->labels))
      {
        $mec_items = count($event->data->labels);
        $mec_i = 0; ?>
        <div class="mec-single-event-label">
          <dt class="mec-cost"><?php echo $this->main->m('taxonomy_labels', __('Labels', 'mec')); ?></dt>
          <?php
          foreach($event->data->labels as $labels=>$label)
          {
            $seperator = (++$mec_i === $mec_items) ? '' : ',';
            echo '<dd style="color:' . $label['color'] . '">' . $label["name"] . $seperator . '</dd>';
          }
          ?>
        </div>
        <?php
      }
      ?>
      <?php
      // Event Categories
      if(isset($event->data->categories) and !empty($event->data->categories))
      {
        ?>
        <div class="mec-single-event-category">
          <dt class="mec-category"><?php echo $this->main->m('taxonomy_categories', __('Category', 'mec')); ?></dt>
          <?php
          foreach($event->data->categories as $category)
          {
            $icon = get_metadata('term', $category['id'], 'mec_cat_icon', true);
            $icon = isset($icon) && $icon != '' ? '<i class="'.$icon.' mec-color"></i>' : '<i class="mec-fa-angle-right"></i>';
            echo '<dd class="mec-events-event-categories">'. $category['name'] .'</dd>';
          }
          ?>
        </div>
        <?php
      }
      ?>
    </div>
    <div class="col-md-4">
      <div class="mec-events-event-image"><?php echo $event->data->thumbnails['full']; ?><?php do_action('mec_custom_dev_image_section', $event); ?></div>

      <!-- Register Booking Button -->
      <?php if($this->main->can_show_booking_module($event)): ?>
        <?php $data_lity = ''; if( isset($settings['single_booking_style']) and $settings['single_booking_style'] == 'modal' ) $data_lity = 'data-lity'; ?>
        <a class="mec-booking-button mec-bg-color <?php if( isset($settings['single_booking_style']) and $settings['single_booking_style'] != 'modal' ) echo 'simple-booking'; ?>" href="#mec-events-meta-group-booking-<?php echo $this->uniqueid; ?>" <?php echo $data_lity; ?>><?php echo esc_html($this->main->m('register_button', __('REGISTER', 'mec'))); ?></a>
      <?php elseif(isset($event->data->meta['mec_more_info']) and trim($event->data->meta['mec_more_info']) and $event->data->meta['mec_more_info'] != 'http://'): ?>
        <a class="mec-booking-button mec-bg-color" href="<?php echo $event->data->meta['mec_more_info']; ?>"><?php if(isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) echo esc_html(trim($event->data->meta['mec_more_info_title']), 'mec'); else echo esc_html($this->main->m('register_button', __('REGISTER', 'mec')));
          ?></a>
        <?php endif; ?>

        <!-- Speakers Module -->
        <?php echo $this->main->module('speakers.details', array('event'=>$event)); ?>

        <!-- Local Time Module -->
        <?php echo $this->main->module('local-time.details', array('event'=>$event)); ?>

        <div class="mec-event-meta mec-color-before">

          <?php
          // Event Organizer
          if(isset($event->data->organizers[$event->data->meta['mec_organizer_id']]) && !empty($event->data->organizers[$event->data->meta['mec_organizer_id']]))
          {
            $organizer = $event->data->organizers[$event->data->meta['mec_organizer_id']];
            ?>
            <div class="mec-single-event-organizer">
              <?php if(isset($organizer['thumbnail']) and trim($organizer['thumbnail'])): ?>
                <img class="mec-img-organizer" src="<?php echo esc_url($organizer['thumbnail']); ?>" alt="<?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?>">
              <?php endif; ?>
              <dt class="mec-events-single-section-title"><?php echo $this->main->m('taxonomy_organizer', __('Organizer', 'mec')); ?></dt>
              <?php if(isset($organizer['thumbnail'])): ?>
                <dd class="mec-organizer">
                  <?php echo (isset($organizer['name']) ? $organizer['name'] : ''); ?>
                </dd>
              <?php endif;
              if(isset($organizer['tel']) && !empty($organizer['tel'])): ?>
              <dd class="mec-organizer-tel">
                <i class="mec-sl-phone"></i>
                <?php _e('Phone', 'mec'); ?>
                <a href="tel:<?php echo $organizer['tel']; ?>"><?php echo $organizer['tel']; ?></a>
              </dd>
            <?php endif;
            if(isset($organizer['email']) && !empty($organizer['email'])): ?>
            <dd class="mec-organizer-email">
              <i class="mec-sl-envelope"></i>
              <?php _e('Email', 'mec'); ?>
              <a href="mailto:<?php echo $organizer['email']; ?>"><?php echo $organizer['email']; ?></a>
            </dd>
          <?php endif;
          if(isset($organizer['url']) && !empty($organizer['url']) and $organizer['url'] != 'http://'): ?>
          <dd class="mec-organizer-url">
            <i class="mec-sl-sitemap"></i>
            <?php _e('Website', 'mec'); ?>
            <span><a href="<?php echo (strpos($organizer['url'], 'http') === false ? 'http://'.$organizer['url'] : $organizer['url']); ?>" class="mec-color-hover" target="_blank"><?php echo $organizer['url']; ?></a></span>
          </dd>
        <?php endif; ?>
      </div>
      <?php
      $this->show_other_organizers($event); // Show Additional Organizers
    }

    // Front-End Submitter Contact Info
    ?>
    <?php if (isset($event->data->meta['fes_guest_email']) && isset($event->data->meta['fes_guest_name'])) : ?>
      <div class="mec-single-event-organizer">
        <dt class="mec-events-single-section-title">Event Contact</dt>
        <dd class="mec-organizer">
          <?php echo $event->data->meta['fes_guest_name']; ?>
        </dd>
        <dd class="mec-organizer-email">
          <?php if (function_exists('eae_encode_str')) : ?>
            <a href="mailto:<?php echo eae_encode_str($event->data->meta['fes_guest_email']); ?>"><?php echo eae_encode_str($event->data->meta['fes_guest_email']); ?></a>
          <?php endif; ?>
        </dd>
      </div>
    <?php endif; ?>

  </div>

  <!-- Export Module -->
  <?php echo $this->main->module('export.details', array('event'=>$event)); ?>

  <!-- Attendees List Module -->
  <?php echo $this->main->module('attendees-list.details', array('event'=>$event)); ?>

  <!-- Next Previous Module -->
  <?php echo $this->main->module('next-event.details', array('event'=>$event)); ?>

  <!-- Weather Module -->
  <?php echo $this->main->module('weather.details', array('event'=>$event)); ?>

  <!-- QRCode Module -->
  <?php echo $this->main->module('qrcode.details', array('event'=>$event)); ?>

  <!-- Links Module -->
  <?php echo $this->main->module('links.details', array('event'=>$event)); ?>

  <!-- Widgets -->
  <?php //dynamic_sidebar('mec-single-sidebar'); ?>

</div>
<div class="col-md-8">

  <div class="mec-event-content">
    <!-- <dt class="mec-single-title"><?php the_title(); ?></dt> -->
    <div class="mec-single-event-description mec-events-content">
        <?php the_content(); ?>
        <?php do_action('mec_custom_dev_content_section' , $event); ?>
        <?php if ($eventbrite_id = get_field('eventbrite_checkout_id')) : ?>
            <div id="eventbrite-widget-container-<?php echo $eventbrite_id; ?>"></div>
            <script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
            <script type="text/javascript">
                window.EBWidgets.createWidget({
                    widgetType: 'checkout',
                    eventId: '<?php echo $eventbrite_id; ?>',
                    iframeContainerId: 'eventbrite-widget-container-<?php echo $eventbrite_id; ?>',
                    iframeContainerHeight: 425,
                });
            </script>
        <?php endif; ?>
    </div>
  </div>

  <?php
  // Event Location
  if(isset($event->data->locations[$event->data->meta['mec_location_id']]) and !empty($event->data->locations[$event->data->meta['mec_location_id']]))
  {
    $location = $event->data->locations[$event->data->meta['mec_location_id']];
    ?>
    <div class="mec-single-event-location mec-frontbox">
        <div class="row">
            <div class="col m6">
                <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec')); ?><h3>
                <div class="author fn org"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
                <div class="location"><address class="mec-events-address"><p class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></p></address></div>
            </div>
            <div class="col m6">
                <?php if($location['thumbnail']): ?>
                <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
                <?php endif; ?>
            </div>
      </div>
    </div>

    <!-- Google Maps Module -->
    <div class="mec-events-meta-group mec-events-meta-group-gmap">
      <?php echo $this->main->module('googlemap.details', array('event'=>$this->events)); ?>
    </div>
    <?php
    $this->show_other_locations($event); // Show Additional Locations
  }
  ?>


</div>
</article>
</div>
<?php
$speakers = '""';
if(!empty($event->data->speakers))
{
  $speakers= [];
  foreach($event->data->speakers as $key => $value)
  {
    $speakers[] = array(
      "@type" 	=> "Person",
      "name"		=> $value['name'],
      "image"		=> $value['thumbnail'],
      "sameAs"	=> $value['facebook'],
    );
  }

  $speakers = json_encode($speakers);
}
?>
<script type="application/ld+json">
{
  "@context" 		: "http://schema.org",
  "@type" 		: "Event",
  "startDate" 	: "<?php echo !empty($event->data->meta['mec_date']['start']['date']) ? $event->data->meta['mec_date']['start']['date'] : '' ; ?>",
  "endDate" 		: "<?php echo !empty($event->data->meta['mec_date']['end']['date']) ? $event->data->meta['mec_date']['end']['date'] : '' ; ?>",
  <?php if(isset($location) and is_array($location)): ?>
  "location" 		:
  {
    "@type" 		: "Place",
    "name" 			: "<?php echo (isset($location['name']) ? $location['name'] : ''); ?>",
    "image"			: "<?php echo esc_url($location['thumbnail'] ); ?>",
    "address"		: "<?php echo (isset($location['address']) ? $location['address'] : ''); ?>"
  },
  <?php endif; ?>
  "offers": {
    "url": "<?php echo get_the_permalink(); ?>",
    "price": "<?php echo $event->data->meta['mec_cost'] ?>",
    "priceCurrency" : "<?php echo isset($settings['currency']) ? $settings['currency'] : ''; ?>"
  },
  "performer": <?php echo $speakers; ?>,
  "description" 	: "<?php  echo esc_html(preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', get_the_content())); ?>",
  "image" 		: "<?php echo esc_html($event->data->featured_image['full']); ?>",
  "name" 			: "<?php esc_html_e(get_the_title()); ?>",
  "url"			: "<?php the_permalink(); ?>"
}
</script>
