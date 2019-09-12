<?php
/** no direct access **/
defined('MECEXEC') or die();

// MEC Render
$render = $this->getRender();

// The Query
$query = new WP_Query(array(
    'post_type'=>$this->PT,
    'author'=>get_current_user_id(),
    'posts_per_page'=>'-1',
    'post_status'=>array('pending', 'draft', 'future', 'publish'),
    'orderby'=>'post_date',
    'order'=>'DESC',
));

$id = 1;
?>
<div class="mec-profile">
    <?php if($query->have_posts()): ?>
    <table class="mec-profile-bookings">
        <tr>
            <td>
                <?php esc_html_e('#' , 'mec'); ?>
            </td>
            <td>
                <?php esc_html_e('Event' , 'mec'); ?>
            </td>
            <td>
                <?php esc_html_e('Date' , 'mec'); ?>
            </td>
            <td>
                <?php esc_html_e('Status' , 'mec'); ?>
            </td>
            <td>
                <?php esc_html_e('Attendees' , 'mec'); ?>
            </td>
            <td>
                <?php esc_html_e('Invoice' , 'mec'); ?>
            </td>
        </tr>
        <?php while($query->have_posts()): $query->the_post(); $ID = get_the_ID(); ?>
        <?php
            $transaction_id = $this->book->get_transaction_id_book_id($ID);
            $event_id = get_post_meta($ID, 'mec_event_id', true);
            $ticket_ids = get_post_meta($ID, 'mec_ticket_id', true);

            $confirmed = get_post_meta($ID, 'mec_confirmed', true);
            if($confirmed == '1') $status_class = 'mec-book-confirmed';
            elseif($confirmed == '-1') $status_class = 'mec-book-rejected';
            else $status_class = 'mec-book-pending';
            $transaction = $this->book->get_transaction($transaction_id);
            $dates = isset($transaction['date']) ? explode(':', $transaction['date']) : array(date('Y-m-d'), date('Y-m-d'));
            $event = $render->data($event_id);
        ?>
        <tr id="mec_profile_booking_<?php echo $ID; ?>">
            <td>
                <span class="mec-event-id"><?php echo $id; ?></span>
            </td>
            <td>
                <span class="mec-event-title"><?php echo $event->title; ?></span>
            </td>
            <td>
                 <span class="mec-event-date">
                    <?php echo trim($dates[0].' '.(isset($event->time['start']) ? $event->time['start'] : '').' - '.(($dates[0] != $dates[1]) ? $dates[1].' ' : '').(isset($event->time['end']) ? $event->time['end'] : ''), '- '); ?>
                </span>
            </td>
            <td>
                <span class="mec-event-status <?php echo $status_class;?>">
                    <?php echo $this->main->get_confirmation_label($confirmed); ?>
                </span>
            </td>
            <td>
                <a class="mec-booking-number-of-attendees" href="#mec_profile_booking_<?php echo $ID; ?>" data-lity>
                    <?php echo sprintf(__('<i class="mec-sl-eye"></i> %s', 'mec'), ((is_array($transaction) and isset($transaction['tickets'])) ? count($transaction['tickets']) : 0)); ?>
                </a>
            </td>
            <td>
                <span class="mec-profile-bookings-view-invoice"><a target="_blank" href="<?php echo $this->book->get_invoice_link($transaction_id); ?>"><i class="mec-sl-cloud-download"></i></a></span>
            </td>
        </tr>
        <div id="mec_profile_booking_<?php echo $ID; ?>" class="mec-booking-attendees lity-hide">
            <div class="mec-booking-attendees-wrapper">
                <div class="mec-booking-attendees-head">
                    <span class="mec-booking-attendee-id">
                        <?php esc_html_e('#' , 'mec'); ?>
                    </span>
                    <span class="mec-booking-attendee-name">
                        <?php esc_html_e('Name' , 'mec'); ?> 
                    </span>
                    <span class="mec-booking-attendee-email">
                        <?php esc_html_e('Email' , 'mec'); ?>
                    </span>
                    <span class="mec-booking-attendee-ticket">
                        <?php esc_html_e('Ticket' , 'mec'); ?>
                    </span>
                    <span class="mec-booking-attendee-ticket-variations">
                        <?php esc_html_e('Variations' , 'mec'); ?>
                    </span>
                </div>
                <?php
                // Attendees
                if(isset($transaction['tickets']) and is_array($transaction['tickets']) and count($transaction['tickets']))
                {
                    $person_id = 1;
                    foreach($transaction['tickets'] as $attendee)
                    {
                        echo '<div class="mec-booking-attendees-head-content">';
                        echo '<span class="mec-booking-attendee-id">'.$person_id.'</span>';
                        echo '<span class="mec-booking-attendee-name">'.$attendee['name'].'</span>';
                        echo '<span class="mec-booking-attendee-email">'.$attendee['email'].'</span>';
                        echo '<span class="mec-booking-attendee-ticket">'.((isset($event->tickets[$attendee['id']]) ? $event->tickets[$attendee['id']]['name'] : '').' '.(isset($event->tickets[$attendee['id']]) ? $event->tickets[$attendee['id']]['price_label'] : '')).'</span>';
                        // Ticket Variations
                        echo '<span class="mec-booking-attendee-ticket-variations">';
                        if(isset($attendee['variations']) and is_array($attendee['variations']) and count($attendee['variations']))
                        {
                            $ticket_variations = $this->main->ticket_variations($event_id);
                            foreach($attendee['variations'] as $variation_id=>$variation_count)
                            {
                                if(!$variation_count or ($variation_count and $variation_count < 0)) continue;

                                $variation_title = (isset($ticket_variations[$variation_id]) and isset($ticket_variations[$variation_id]['title'])) ? $ticket_variations[$variation_id]['title'] : '';
                                if(!trim($variation_title)) continue;

                                echo '<span class="mec-booking-attendee-ticket-variations-title">'.'+ '.$variation_title.' ('.$variation_count.')'.'</span>';
                            }
                        } else {
                            echo '-';
                        }
                        echo '</span>';
                        $person_id++;
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <?php $id++; endwhile; wp_reset_postdata(); // Restore original Post Data ?>
    </table>
    <?php else: ?>
    <p><?php echo __('No bookings found!', 'mec'); ?></p>
    <?php endif; ?>
</div>