<?php
/** no direct access **/
defined('MECEXEC') or die();
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
            ?>
            <article data-style="<?php echo $label_style; ?>" class="mec-event-article <?php echo $this->get_event_classes($event); ?>">
                <div class="mec-event-image"><?php echo $event->data->thumbnails['thumbnail']; ?></div>
                <?php if(trim($start_time)): ?><div class="mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo $start_time.(trim($end_time) ? ' - '.$end_time : ''); ?></div><?php endif; ?>
                <h4 class="mec-event-title"><a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']); ?>"><?php echo $event->data->title; ?></a><?php echo $event_color; ?></h4><div class="mec-event-detail"><?php echo (isset($location['name']) ? $location['name'] : ''); ?></div>
            </article>
        <?php endforeach; ?>
        <?php else: ?>
            <article class="mec-event-article"><div class="mec-daily-view-no-event mec-no-event"><?php _e('No event', 'mec'); ?></div></article>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<div class="mec-event-footer"></div>