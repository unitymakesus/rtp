<?php
/** no direct access **/
defined('MECEXEC') or die();
$settings = $this->main->get_settings();
?>
<ul class="mec-daily-view-dates-events">
    <?php foreach($this->events as $date=>$events): ?>
    <li class="mec-daily-view-date-events mec-util-hidden" id="mec_daily_view_date_events<?php echo $this->id; ?>_<?php echo date('Ymd', strtotime($date)); ?>">
        <?php if(count($events)): ?>
        <?php foreach($events as $event): ?>
            <?php
                $location = isset($event->data->locations[$event->data->meta['mec_location_id']])? $event->data->locations[$event->data->meta['mec_location_id']] : array();
                $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                $end_time = (isset($event->data->time) ? $event->data->time['end'] : '');
                $event_color =  isset($event->data->meta['mec_color'])?'<span class="event-color" style="background: #'.$event->data->meta['mec_color'].'"></span>':'';
                $label_style = '';

                // Check for sold out event tickets if sold out is shown sold out label
                $event_id = (isset($event->ID)) ?  intval($event->ID) : 0;
                $startDate = !empty($event->data->meta['mec_date']['start']['date'] ) ? $event->data->meta['mec_date']['start']['date'] : '';
                $endDate = !empty($event->data->meta['mec_date']['end']['date'] ) ? $event->data->meta['mec_date']['end']['date'] : '' ;
                $event_start_date = !empty($event->date['start']['date']) ? $event->date['start']['date'] : '';
                $event_end_date = !empty($event->date['end']['date']) ? $event->date['end']['date'] : '';
                $is_soldout = $this->main->is_soldout($event_id, $event_start_date);
                $dynamic_period = $this->main->date_diff($event_start_date, $event_end_date)->d;

                if($dynamic_period >= 0)
                {
                    $static_period = (!isset($static_period)) ? $this->main->date_diff($startDate, $endDate)->d : $static_period;

                    // For events no multiple days but repeating is multiple days
                    $static_period = ($dynamic_period > $static_period) ? $dynamic_period : $static_period;

                    // For compare next days of start point events
                    $level = abs($static_period - $dynamic_period);

                    // For events multiple days repeating
                    if(($dynamic_period < ($static_period)) and (($dynamic_period) >= 0) and $this->main->is_soldout($event_id,
                    date('Y-m-d',strtotime("- {$level}day", strtotime($event_start_date))))) $is_soldout = true;
                }
                
                if ( !empty($event->data->labels) ):
                foreach( $event->data->labels as $label)
                {
                    if(!isset($label['style']) or (isset($label['style']) and !trim($label['style']))) continue;
                    if ( $label['style']  == 'mec-label-featured' )
                    {
                        $label_style = esc_html__( 'Featured' , 'mec' );
                    } 
                    elseif ( $label['style']  == 'mec-label-canceled' )
                    {
                        $label_style = esc_html__( 'Canceled' , 'mec' );
                    }
                }
                endif;
                $speakers = '""';
                if ( !empty($event->data->speakers)) 
                {
                    $speakers= [];
                    foreach ($event->data->speakers as $key => $value) {
                        $speakers[] = array(
                            "@type" 	=> "Person",
                            "name"		=> $value['name'],
                            "image"		=> $value['thumbnail'],
                            "sameAs"	=> $value['facebook'],
                        );
                    } 
                    $speakers = json_encode($speakers);
                }
            $schema_settings = isset( $settings['schema'] ) ? $settings['schema'] : '';
            if($schema_settings == '1' ):
            ?>
            <script type="application/ld+json">
            {
                "@context" 		: "http://schema.org",
                "@type" 		: "Event",
                "startDate" 	: "<?php echo !empty( $event->data->meta['mec_date']['start']['date'] ) ? $event->data->meta['mec_date']['start']['date'] : '' ; ?>",
                "endDate" 		: "<?php echo !empty( $event->data->meta['mec_date']['end']['date'] ) ? $event->data->meta['mec_date']['end']['date'] : '' ; ?>",
                "location" 		:
                {
                    "@type" 		: "Place",
                    "name" 			: "<?php echo (isset($location['name']) ? $location['name'] : ''); ?>",
                    "image"			: "<?php echo (isset($location['thumbnail']) ? esc_url($location['thumbnail'] ) : '');; ?>",
                    "address"		: "<?php echo (isset($location['address']) ? $location['address'] : ''); ?>"
                },
                "offers": {
                    "url": "<?php echo $event->data->permalink; ?>",
                    "price": "<?php echo isset($event->data->meta['mec_cost']) ? $event->data->meta['mec_cost'] : '' ; ?>",
                    "priceCurrency" : "<?php echo isset($settings['currency']) ? $settings['currency'] : ''; ?>"
                },
                "performer": <?php echo $speakers; ?>,
                "description" 	: "<?php  echo esc_html(preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', $event->data->post->post_content)); ?>",
                "image" 		: "<?php echo !empty($event->data->featured_image['full']) ? esc_html($event->data->featured_image['full']) : '' ; ?>",
                "name" 			: "<?php esc_html_e($event->data->title); ?>",
                "url"			: "<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"
            }
            </script>
            <?php endif; ?>
            <article data-style="<?php echo $label_style; ?>" class="mec-event-article <?php echo $this->get_event_classes($event); ?>">
                <div class="mec-event-image"><?php echo $event->data->thumbnails['thumbnail']; ?></div>
                <?php if(trim($start_time)): ?><div class="mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo $start_time.(trim($end_time) ? ' - '.$end_time : ''); ?></div><?php endif; ?>
                <?php 
                    $sold_out_css_class = ($is_soldout) ? ' mec-event-title-soldout' : '';
                    $sold_out = ($is_soldout) ? ' <span class=soldout>' . __('Sold Out', 'mec') . '</span> ' : ''; 
                ?>
                <h4 class="mec-event-title <?php echo $sold_out_css_class; ?>"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $sold_out.$event_color; ?></h4><div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </article>
        <?php endforeach; ?>
        <?php else: ?>
            <article class="mec-event-article"><div class="mec-daily-view-no-event mec-no-event"><?php _e('No event', 'mec'); ?></div></article>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<div class="mec-event-footer"></div>