<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC books class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_books extends MEC_base
{
    public $factory;
    public $main;
    public $db;
    public $book;
    public $PT;
    public $settings;

    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        // Import MEC Factory
        $this->factory = $this->getFactory();
        
        // Import MEC Main
        $this->main = $this->getMain();
        
        // Import MEC DB
        $this->db = $this->getDB();
        
        // Import MEC Book
        $this->book = $this->getBook();
        
        // MEC Book Post Type Name
        $this->PT = $this->main->get_book_post_type();
        
        // MEC Settings
        $this->settings = $this->main->get_settings();
    }
    
    /**
     * Initialize books feature
     * @author Webnus <info@webnus.biz>
     */
    public function init()
    {
        // PRO Version is required
        if(!$this->getPRO()) return false;

        // Show booking feature only if booking module is enabled
        if(!isset($this->settings['booking_status']) or (isset($this->settings['booking_status']) and !$this->settings['booking_status'])) return false;
        
        $this->factory->action('init', array($this, 'register_post_type'));
        $this->factory->action('add_meta_boxes_'.$this->PT, array($this, 'remove_taxonomies_metaboxes'));
        $this->factory->action('save_post', array($this, 'save_book'), 10);
        $this->factory->action('add_meta_boxes', array($this, 'register_meta_boxes'), 1);
        $this->factory->action('restrict_manage_posts', array($this, 'add_filters'));

        // Details Meta Box
        $this->factory->action('mec_book_metabox_details', array($this, 'meta_box_nonce'), 10);
        $this->factory->action('mec_book_metabox_details', array($this, 'meta_box_booking_form'), 10);
        $this->factory->action('mec_book_metabox_details', array($this, 'meta_box_booking_info'), 10);
        
        // Status Meta Box
        $this->factory->action('mec_book_metabox_status', array($this, 'meta_box_status_form'), 10);

        // Invoice Meta Box
        $this->factory->action('mec_book_metabox_status', array($this, 'meta_box_invoice'), 10);

        $this->factory->action('pre_get_posts', array($this, 'filter_query'));
        $this->factory->filter('manage_'.$this->PT.'_posts_columns', array($this, 'filter_columns'));
        $this->factory->filter('manage_edit-'.$this->PT.'_sortable_columns', array($this, 'filter_sortable_columns'));
        $this->factory->action('manage_'.$this->PT.'_posts_custom_column', array($this, 'filter_columns_content'), 10, 2);

        // Bulk Actions
        $this->factory->action('admin_footer-edit.php', array($this, 'add_bulk_actions'));
        $this->factory->action('load-edit.php', array($this, 'do_bulk_actions'));

        // Book Event form
        $this->factory->action('wp_ajax_mec_book_form', array($this, 'book'));
        $this->factory->action('wp_ajax_mec_book_form_upload_file', array($this, 'book'));

        $this->factory->action('wp_ajax_nopriv_mec_book_form', array($this, 'book'));

        // Tickets Availability
        $this->factory->action('wp_ajax_mec_tickets_availability', array($this, 'tickets_availability'));
        $this->factory->action('wp_ajax_nopriv_mec_tickets_availability', array($this, 'tickets_availability'));

        // Backend Booking Form
        $this->factory->action('wp_ajax_mec_bbf_date_tickets_booking_form', array($this, 'bbf_date_tickets_booking_form'));

        return true;
    }
    
    /**
     * Registers books post type and assign it to some taxonomies
     * @author Webnus <info@webnus.biz>
     */
    public function register_post_type()
    {
        register_post_type($this->PT,
            array(
                'labels'=>array
                (
                    'name'=>__('Bookings', 'mec'),
                    'singular_name'=>__('Booking', 'mec'),
                    'add_new'=>__('Add Booking', 'mec'),
                    'add_new_item'=>__('Add Booking', 'mec'),
                    'not_found'=>__('No bookings found!', 'mec'),
                    'all_items'=>__('Bookings', 'mec'),
                    'edit_item'=>__('Edit Bookings', 'mec'),
                    'not_found_in_trash'=>__('No bookings found in Trash!', 'mec')
                ),
                'public'=>false,
                'show_ui'=>(current_user_can('edit_others_posts') ? true : false),
                'show_in_menu'=>true,
                'show_in_admin_bar'=>false,
                'has_archive'=>false,
                'exclude_from_search'=>true,
                'publicly_queryable'=>false,
                'menu_icon'=>'dashicons-book',
                'menu_position'=>28,
                'supports'=>array('title', 'author'),
                'capabilities'=>array
                (
                    'read_post'=>'edit_dashboard',
                    'create_posts'=>'manage_options'
                ),
                'map_meta_cap'=>true
            )
        );
    }
    
    /**
     * Remove normal meta boxes for some taxonomies
     * @author Webnus <info@webnus.biz>
     */
    public function remove_taxonomies_metaboxes()
    {
        remove_meta_box('tagsdiv-mec_coupon', $this->PT, 'side');
    }
    
    /**
     * Registers 2 meta boxes for book data
     * @author Webnus <info@webnus.biz>
     */
    public function register_meta_boxes()
    {
        add_meta_box('mec_book_metabox_details', __('Book Details', 'mec'), array($this, 'meta_box_details'), $this->PT, 'normal', 'high');
        add_meta_box('mec_book_metabox_status', __('Status & Invoice', 'mec'), array($this, 'meta_box_status'), $this->PT, 'side', 'default');
    }
    
    /**
     * Show content of status meta box
     * @author Webnus <info@webnus.biz>
     * @param object $post
     */
    public function meta_box_status($post)
    {
        do_action('mec_book_metabox_status', $post);
    }

    /**
     * Show confirmation form
     * @author Webnus <info@webnus.biz>
     * @param $post
     */
    public function meta_box_status_form($post)
    {
        $confirmed = get_post_meta($post->ID, 'mec_confirmed', true);
        $verified = get_post_meta($post->ID, 'mec_verified', true);
        $event_id = get_post_meta($post->ID, 'mec_event_id', true);
    ?>
        <div class="mec-book-status-form">
            <div class="mec-row">
                <label for="mec_book_confirmation"><?php _e('Confirmation', 'mec'); ?></label>
                <select id="mec_book_confirmation" name="confirmation">
                    <option value="0"><?php _e('Pending', 'mec'); ?></option>
                    <option value="1" <?php echo (($confirmed == '1' or !$event_id) ? 'selected="selected"' : ''); ?>><?php _e('Confirmed', 'mec'); ?></option>
                    <option value="-1" <?php echo ($confirmed == '-1' ? 'selected="selected"' : ''); ?>><?php _e('Rejected', 'mec'); ?></option>
                </select>
            </div>
            <div class="mec-row">
                <label for="mec_book_verification"><?php _e('Verification', 'mec'); ?></label>
                <select id="mec_book_verification" name="verification">
                    <option value="0"><?php _e('Waiting', 'mec'); ?></option>
                    <option value="1" <?php echo (($verified == '1' or !$event_id) ? 'selected="selected"' : ''); ?>><?php _e('Verified', 'mec'); ?></option>
                    <option value="-1" <?php echo ($verified == '-1' ? 'selected="selected"' : ''); ?>><?php _e('Canceled', 'mec'); ?></option>
                </select>
            </div>
        </div>
    <?php
    }

    public function meta_box_invoice($post)
    {
        $transaction_id = get_post_meta($post->ID, 'mec_transaction_id', true);

        // Return if Transaction ID is not exists (Normally happens for new booking page)
        if(!$transaction_id) return false;
    ?>
        <p class="mec-book-invoice">
            <?php echo sprintf(__('Here, you can %s invoice of %s transaction.', 'mec'), '<a href="'.$this->book->get_invoice_link($transaction_id).'" target="_blank">'.__('download', 'mec').'</a>', '<strong>'.$transaction_id.'</strong>'); ?>
        </p>
    <?php
    }
    
    /**
     * Show content of details meta box
     * @author Webnus <info@webnus.biz>
     * @param object $post
     */
    public function meta_box_details($post)
    {
        do_action('mec_book_metabox_details', $post);
    }
    
    /**
     * Add a security nonce to the Add/Edit books page
     * @author Webnus <info@webnus.biz>
     */
    public function meta_box_nonce($post)
    {
        // Add a nonce field so we can check for it later.
        wp_nonce_field('mec_book_data', 'mec_book_nonce');
    }

    /**
     * Show book form
     * @author Webnus <info@webnus.biz>
     * @param $post
     * @return bool
     */
    public function meta_box_booking_form($post)
    {
        $meta = $this->main->get_post_meta($post->ID);

        $event_id = (isset($meta['mec_event_id']) and $meta['mec_event_id']) ? $meta['mec_event_id'] : 0;

        // The booking is saved so we will skip this form and show booking info instead.
        if($event_id) return false;

        // Events
        $events = $this->main->get_events();
        ?>
        <div class="info-msg"><?php _e('It will create a new booking under "Pay Locally" gateway.', 'mec'); ?></div>
        <div class="mec-book-form">
            <h3><?php _e('Booking Form', 'mec'); ?></h3>
            <div class="mec-form-row">
                <div class="mec-col-2">
                    <label for="mec_book_form_event_id"><?php _e('Event', 'mec'); ?></label>
                </div>
                <div class="mec-col-6">
                    <select id="mec_book_form_event_id" class="widefat" name="mec_event_id">
                        <option value="">-----</option>
                        <?php foreach($events as $event): ?>
                        <option value="<?php echo $event->ID; ?>"><?php echo $event->post_title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="mec_date_tickets_booking_form_container">
            </div>
            <input type="hidden" name="mec_is_new_booking" value="1" />
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function()
        {
            jQuery('#mec_book_form_event_id').on('change', function()
            {
                var event_id = this.value;

                jQuery.ajax(
                {
                    url: "<?php echo admin_url('admin-ajax.php', NULL); ?>",
                    data: "action=mec_bbf_date_tickets_booking_form&event_id="+event_id,
                    dataType: "json",
                    type: "GET",
                    success: function(response)
                    {
                        jQuery('#mec_date_tickets_booking_form_container').html(response.output);
                    },
                    error: function()
                    {
                        jQuery('#mec_date_tickets_booking_form_container').html('');
                    }
                });
            });
        });
        </script>
        <?php
    }
    
    /**
     * Show book details
     * @param object $post
     * @author Webnus <info@webnus.biz>
     * @return boolean
     */
    public function meta_box_booking_info($post)
    {
        $meta = $this->main->get_post_meta($post->ID);
        $event_id = (isset($meta['mec_event_id']) and $meta['mec_event_id']) ? $meta['mec_event_id'] : 0;

        // The booking is not saved so we will skip this and show booking form instead.
        if(!$event_id) return false;

        $tickets = get_post_meta($event_id, 'mec_tickets', true);

        $dates = isset($meta['mec_date']) ? explode(':', $meta['mec_date']) : array();
        $attendees = isset($meta['mec_attendees']) ? $meta['mec_attendees'] : (isset($meta['mec_attendee']) ? array($meta['mec_attendee']) : array());
        $reg_fields = $this->main->get_reg_fields($event_id);
    ?>
        <div class="mec-book-details">
            <h3><?php _e('Payment', 'mec'); ?></h3>
            <div class="mec-row">
                <strong><?php _e('Price', 'mec'); ?>: </strong>
                <span><?php echo $this->main->render_price(($meta['mec_price'] ? $meta['mec_price'] : 0)); ?></span>
            </div>
            <div class="mec-row">
                <strong><?php _e('Gateway', 'mec'); ?>: </strong>
                <span><?php echo ((isset($meta['mec_gateway_label']) and trim($meta['mec_gateway_label'])) ? __($meta['mec_gateway_label'], 'mec') : __('Unknown', 'mec')); ?></span>
            </div>
            <div class="mec-row">
                <strong><?php _e('Transaction ID', 'mec'); ?>: </strong>
                <span><?php echo ((isset($meta['mec_transaction_id']) and trim($meta['mec_transaction_id'])) ? __($meta['mec_transaction_id'], 'mec') : __('Unknown', 'mec')); ?></span>
            </div>
            <h3><?php echo __('Booking', 'mec'); ?></h3>
            <div class="mec-row">
                <strong><?php _e('Event', 'mec'); ?>: </strong>
                <span><?php echo ($event_id ? '<a href="'.get_permalink($event_id).'">'.get_the_title($event_id).'</a>' : __('Unknown', 'mec')); ?></span>
            </div>
            <div class="mec-row">
                <strong><?php _e('Date', 'mec'); ?>: </strong>
                <span><?php echo ((isset($dates[0]) and isset($dates[1])) ? sprintf(__('%s to %s', 'mec'), $this->main->render_date($dates[0]), $this->main->render_date($dates[1])) : __('Unknown', 'mec')); ?></span>
            </div>
            <div class="mec-row">
                <strong><?php _e('Total Attendees', 'mec'); ?>: </strong>
                <span><?php echo $this->book->get_total_attendees($post->ID); ?></span>
            </div>

            <?php if(isset($attendees['attachments']) && !empty($attendees['attachments'])): ?>
            <h3><?php _e('Attachments', 'mec'); ?></h3>
            <hr>
            <?php foreach($attendees['attachments'] as $attachment): ?>
            <div class="mec-attendee">            
                <?php if(!isset($attachment['error']) && $attachment['response'] === 'SUCCESS'): ?>
                    <?php
                        $a = getimagesize($attachment['url']);
                        $image_type = $a[2];
                        if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))):
                    ?>
                        <a href="<?php echo $attachment['url'] ?>" target="_blank">
                            <img src="<?php echo $attachment['url'] ?>" alt="<?php echo $attachment['filename'] ?>" title="<?php echo $attachment['filename'] ?>" style="max-width:250px;float: left;margin: 5px;">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo $attachment['url'] ?>" target="_blank"><?php echo $attachment['filename'] ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <div class="clear"></div>
            <?php endif; ?>

            <h3><?php _e('Attendees', 'mec'); ?></h3>
            <?php foreach($attendees as $key => $attendee): $reg_form = isset($attendee['reg']) ? $attendee['reg'] : array(); ?>
            <?php 
                if($key === 'attachments') continue;
                if(isset($attendee[0]['MEC_TYPE_OF_DATA'])) continue;
            ?>
            <hr>
            <div class="mec-attendee">
                <h4><strong><?php echo ((isset($attendee['name']) and trim($attendee['name'])) ? $attendee['name'] : '---'); ?></strong></h4>
                <div class="mec-row">
                    <strong><?php _e('Email', 'mec'); ?>: </strong>
                    <span><?php echo ((isset($attendee['email']) and trim($attendee['email'])) ? $attendee['email'] : '---'); ?></span>
                </div>
                <div class="mec-row">
                    <strong><?php echo $this->main->m('ticket', __('Ticket', 'mec')); ?>: </strong>
                    <span><?php echo ((isset($attendee['id']) and isset($tickets[$attendee['id']]['name'])) ? $tickets[$attendee['id']]['name'] : __('Unknown', 'mec')); ?></span>
                </div>
                <?php
                // Ticket Variations
                if(isset($attendee['variations']) and is_array($attendee['variations']) and count($attendee['variations']))
                {
                    $ticket_variations = $this->main->ticket_variations($event_id);
                    foreach($attendee['variations'] as $variation_id=>$variation_count)
                    {
                        if(!$variation_count or ($variation_count and $variation_count < 0)) continue;

                        $variation_title = (isset($ticket_variations[$variation_id]) and isset($ticket_variations[$variation_id]['title'])) ? $ticket_variations[$variation_id]['title'] : '';
                        if(!trim($variation_title)) continue;

                        echo '<div class="mec-row">
                            <span>+ '.$variation_title.'</span>
                            <span>('.$variation_count.')</span>
                        </div>';
                    }
                }
                ?>
                <?php foreach($reg_form as $field_id=>$value): $label = isset($reg_fields[$field_id]) ? $reg_fields[$field_id]['label'] : ''; $type = isset($reg_fields[$field_id]) ? $reg_fields[$field_id]['type'] : ''; ?>
                    <?php if($type == 'agreement'): ?>
                        <div class="mec-row">
                            <strong><?php echo sprintf(__($label, 'mec'), '<a href="'.get_the_permalink($reg_fields[$field_id]['page']).'">'.get_the_title($reg_fields[$field_id]['page']).'</a>'); ?>: </strong>
                            <span><?php echo ($value == '1' ? __('Yes', 'mec') : __('No', 'mec')); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="mec-row">
                            <strong><?php _e($label, 'mec'); ?>: </strong>
                            <span><?php echo (is_string($value) ? $value : (is_array($value) ? implode(', ', $value) : '---')); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php
    }
    
    /**
     * Filters columns of book feature
     * @author Webnus <info@webnus.biz>
     * @param array $columns
     * @return array
     */
    public function filter_columns($columns)
    {
        unset($columns['date']);
        unset($columns['author']);

        $columns['attendees'] = __('Attendees', 'mec');
        $columns['event'] = __('Event', 'mec');
        $columns['price'] = __('Price', 'mec');
        $columns['confirmation'] = __('Confirmation', 'mec');
        $columns['verification'] = __('Verification', 'mec');
        $columns['transaction'] = __('Transaction ID', 'mec');
        $columns['bdate'] = __('Book Date', 'mec');
        
        return $columns;
    }
    
    /**
     * Filters sortable columns of book feature
     * @author Webnus <info@webnus.biz>
     * @param array $columns
     * @return array
     */
    public function filter_sortable_columns($columns)
    {
        $columns['event'] = 'event';
        $columns['price'] = 'price';
        $columns['confirmation'] = 'confirmation';
        $columns['verification'] = 'verification';
        $columns['bdate'] = 'date';
        
        return $columns;
    }
    
    /**
     * Filters columns content of book feature
     * @author Webnus <info@webnus.biz>
     * @param string $column_name
     * @param int $post_id
     * @return string
     */
    public function filter_columns_content($column_name, $post_id)
    {
        if($column_name == 'event')
        {
            $event_id = get_post_meta($post_id, 'mec_event_id', true);

            $title = get_the_title($event_id);
            $tickets = get_post_meta($event_id, 'mec_tickets', true);

            $ticket_ids_str = get_post_meta($post_id, 'mec_ticket_id', true);
            $ticket_ids = explode(',', trim($ticket_ids_str, ', '));
            
            echo ($event_id ? '<a href="'.$this->main->add_qs_var('mec_event_id', $event_id).'">'.$title.'</a>' : '');
            foreach($ticket_ids as $ticket_id)
            {
                echo (isset($tickets[$ticket_id]['name']) ? ' - <a title="'.$this->main->m('ticket', __('Ticket', 'mec')).'" href="'.$this->main->add_qs_vars(array('mec_ticket_id'=>$ticket_id, 'mec_event_id'=>$event_id)).'">'.$tickets[$ticket_id]['name'].'</a>' : '');
            }
        }
        elseif($column_name == 'attendees')
        {
            echo '<strong>'.$this->book->get_total_attendees($post_id).'</strong>';
        }
        elseif($column_name == 'price')
        {
            $price = get_post_meta($post_id, 'mec_price', true);
            
            echo $this->main->render_price(($price ? $price : 0));
            echo ' '.get_post_meta($post_id, 'mec_gateway_label', true);
        }
        elseif($column_name == 'confirmation')
        {
            $confirmed = get_post_meta($post_id, 'mec_confirmed', true);
            
            echo '<a href="'.$this->main->add_qs_var('mec_confirmed', $confirmed).'">'.$this->main->get_confirmation_label($confirmed).'</a>';
        }
        elseif($column_name == 'verification')
        {
            $verified = get_post_meta($post_id, 'mec_verified', true);
            
            echo '<a href="'.$this->main->add_qs_var('mec_verified', $verified).'">'.$this->main->get_verification_label($verified).'</a>';
        }
        elseif($column_name == 'transaction')
        {
            $transaction_id = get_post_meta($post_id, 'mec_transaction_id', true);
            echo '<a href="'.$this->main->add_qs_var('mec_transaction_id', $transaction_id).'">'.$transaction_id.'</a>';
        }
        elseif($column_name == 'bdate')
        {
            echo '<a href="'.$this->main->add_qs_var('m', date('Ymd', get_post_time('U', false, $post_id))).'">'.get_the_date('', $post_id).'</a>';
        }
    }

    /**
     * @param WP_Query $query
     */
    public function filter_query($query)
    {
        if(!is_admin() or $query->get('post_type') != $this->PT) return;
        
        $orderby = $query->get('orderby');

        if($orderby == 'event')
        {
            $query->set('meta_key', 'mec_event_id');
            $query->set('orderby', 'mec_event_id');
        }
        elseif($orderby == 'booker')
        {
            $query->set('orderby', 'user_id');
        }
        elseif($orderby == 'price')
        {
            $query->set('meta_key', 'mec_price');
            $query->set('orderby', 'mec_price');
        }
        elseif($orderby == 'confirmation')
        {
            $query->set('meta_key', 'mec_confirmed');
            $query->set('orderby', 'mec_confirmed');
        }
        elseif($orderby == 'verification')
        {
            $query->set('meta_key', 'mec_verified');
            $query->set('orderby', 'mec_verified');
        }
        
        // Meta Query
        $meta_query = array();
        
        // Filter by Event ID
        if(isset($_REQUEST['mec_event_id']) and trim($_REQUEST['mec_event_id']))
        {
            $meta_query[] = array(
                'key'=>'mec_event_id',
                'value'=>sanitize_text_field($_REQUEST['mec_event_id']),
                'compare'=>'=',
                'type'=>'numeric'
            );
        }
        
        // Filter by Ticket ID
        if(isset($_REQUEST['mec_ticket_id']) and trim($_REQUEST['mec_ticket_id']))
        {
            $meta_query[] = array(
                'key'=>'mec_ticket_id',
                'value'=>','.sanitize_text_field($_REQUEST['mec_ticket_id']).',',
                'compare'=>'LIKE'
            );
        }
        
        // Filter by Transaction ID
        if(isset($_REQUEST['mec_transaction_id']) and trim($_REQUEST['mec_transaction_id']))
        {
            $meta_query[] = array(
                'key'=>'mec_transaction_id',
                'value'=>sanitize_text_field($_REQUEST['mec_transaction_id']),
                'compare'=>'='
            );
        }
        
        // Filter by Confirmation
        if(isset($_REQUEST['mec_confirmed']) and trim($_REQUEST['mec_confirmed']) != '')
        {
            $meta_query[] = array(
                'key'=>'mec_confirmed',
                'value'=>sanitize_text_field($_REQUEST['mec_confirmed']),
                'compare'=>'=',
                'type'=>'numeric'
            );
        }
        
        // Filter by Verification
        if(isset($_REQUEST['mec_verified']) and trim($_REQUEST['mec_verified']) != '')
        {
            $meta_query[] = array(
                'key'=>'mec_verified',
                'value'=>sanitize_text_field($_REQUEST['mec_verified']),
                'compare'=>'=',
                'type'=>'numeric'
            );
        }
        
        if(count($meta_query)) $query->set('meta_query', $meta_query);
    }
    
    public function add_filters($post_type)
    {
        if($post_type != $this->PT) return;
        
        $events = get_posts(array('post_type'=>$this->main->get_main_post_type(), 'post_status'=>'publish', 'posts_per_page'=>-1));
        $mec_event_id = isset($_REQUEST['mec_event_id']) ? sanitize_text_field($_REQUEST['mec_event_id']) : '';
        
        echo '<select name="mec_event_id">';
        echo '<option value="">'.__('Event', 'mec').'</option>';
        foreach($events as $event) echo '<option value="'.$event->ID.'" '.($mec_event_id == $event->ID ? 'selected="selected"' : '').'>'.$event->post_title.'</option>';
        echo '</select>';
        
        $mec_confirmed = isset($_REQUEST['mec_confirmed']) ? sanitize_text_field($_REQUEST['mec_confirmed']) : '';
        
        echo '<select name="mec_confirmed">';
        echo '<option value="">'.__('Confirmation', 'mec').'</option>';
        echo '<option value="1" '.($mec_confirmed == '1' ? 'selected="selected"' : '').'>'.__('Confirmed', 'mec').'</option>';
        echo '<option value="0" '.($mec_confirmed == '0' ? 'selected="selected"' : '').'>'.__('Pending', 'mec').'</option>';
        echo '<option value="-1" '.($mec_confirmed == '-1' ? 'selected="selected"' : '').'>'.__('Rejected', 'mec').'</option>';
        echo '</select>';
        
        $mec_verified = isset($_REQUEST['mec_verified']) ? sanitize_text_field($_REQUEST['mec_verified']) : '';
        
        echo '<select name="mec_verified">';
        echo '<option value="">'.__('Verification', 'mec').'</option>';
        echo '<option value="1" '.($mec_verified == '1' ? 'selected="selected"' : '').'>'.__('Verified', 'mec').'</option>';
        echo '<option value="0" '.($mec_verified == '0' ? 'selected="selected"' : '').'>'.__('Waiting', 'mec').'</option>';
        echo '<option value="-1" '.($mec_verified == '-1' ? 'selected="selected"' : '').'>'.__('Canceled', 'mec').'</option>';
        echo '</select>';
    }
    
    public function add_bulk_actions()
    {
        global $post_type;
 
        if($post_type == $this->PT)
        {
            ?>
            <script type="text/javascript">
            jQuery(document).ready(function()
            {
                <?php foreach(array('pending'=>__('Pending', 'mec'), 'confirm'=>__('Confirm', 'mec'), 'reject'=>__('Reject', 'mec'), 'csv-export'=>__('CSV Export', 'mec'), 'ms-excel-export'=>__('MS Excel Export', 'mec')) as $action=>$label): ?>
                jQuery('<option>').val('<?php echo $action; ?>').text('<?php echo $label; ?>').appendTo("select[name='action']");
                jQuery('<option>').val('<?php echo $action; ?>').text('<?php echo $label; ?>').appendTo("select[name='action2']");
                <?php endforeach; ?>
            });
            </script>
            <?php
        }
    }
    
    public function do_bulk_actions()
    {
        $wp_list_table = _get_list_table('WP_Posts_List_Table');
        
        $action = $wp_list_table->current_action();
        if(!$action) return false;
        
        $post_type = isset($_REQUEST['post_type']) ? sanitize_text_field($_REQUEST['post_type']) : 'post';
        if($post_type != $this->PT) return false;
        
        check_admin_referer('bulk-posts');
        
        switch($action)
        {
            case 'confirm':
                
                $post_ids = (isset($_REQUEST['post']) and is_array($_REQUEST['post'])) ? $_REQUEST['post'] : array();
                foreach($post_ids as $post_id) $this->book->confirm((int) $post_id);
                
                break;
            case 'pending':
                
                $post_ids = (isset($_REQUEST['post']) and is_array($_REQUEST['post'])) ? $_REQUEST['post'] : array();
                foreach($post_ids as $post_id) $this->book->pending((int) $post_id);
                
                break;
            case 'reject':
                
                $post_ids = (isset($_REQUEST['post']) and is_array($_REQUEST['post'])) ? $_REQUEST['post'] : array();
                foreach($post_ids as $post_id) $this->book->reject((int) $post_id);
                
                break;
            case 'csv-export':
                
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=bookings-'.md5(time().mt_rand(100, 999)).'.csv');

                $post_ids = (isset($_REQUEST['post']) and is_array($_REQUEST['post'])) ? $_REQUEST['post'] : array();

                $event_ids = array();
                foreach($post_ids as $post_id) $event_ids[] = get_post_meta($post_id, 'mec_event_id', true);
                $event_ids = array_unique($event_ids);

                $main_event_id = NULL;
                if(count($event_ids) == 1) $main_event_id = $event_ids[0];

                $columns = array(__('ID', 'mec'), __('Event', 'mec'), __('Date', 'mec'), $this->main->m('ticket', __('Ticket', 'mec')), __('Transaction ID', 'mec'), __('Total Price', 'mec'), __('Name', 'mec'), __('Email', 'mec'), __('Confirmation', 'mec'), __('Verification', 'mec'));

                $reg_fields = $this->main->get_reg_fields($main_event_id);
                foreach($reg_fields as $reg_field_key=>$reg_field)
                {
                    // Placeholder Keys
                    if(!is_numeric($reg_field_key)) continue;

                    $type = isset($reg_field['type']) ? $reg_field['type'] : '';
                    $label = isset($reg_field['label']) ? __($reg_field['label'], 'mec') : '';

                    if(trim($label) == '') continue;
                    if($type == 'agreement') $label = sprintf($label, get_the_title($reg_field['page']));

                    $columns[] = $label;
                }
                $columns[] = 'Attachments';
                $output = fopen('php://output', 'w');
                fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($output, $columns);
                
                foreach($post_ids as $post_id)
                {
                    $post_id = (int) $post_id;

                    $event_id = get_post_meta($post_id, 'mec_event_id', true);
                    $booker_id = get_post_field('post_author', $post_id);
                    $transaction_id = get_post_meta($post_id, 'mec_transaction_id', true);

                    $tickets = get_post_meta($event_id, 'mec_tickets', true);

                    $attendees = get_post_meta($post_id, 'mec_attendees', true);
                    if(!is_array($attendees) or (is_array($attendees) and !count($attendees))) $attendees = array(get_post_meta($post_id, 'mec_attendee', true));

                    $price = get_post_meta($post_id, 'mec_price', true);
                    $booker = get_userdata($booker_id);
                    
                    $confirmed = $this->main->get_confirmation_label(get_post_meta($post_id, 'mec_confirmed', true));
                    $verified = $this->main->get_verification_label(get_post_meta($post_id, 'mec_verified', true));
                    
                    $attachments = '';
                    if( isset( $attendees['attachments'] ) ) 
                    {
                        foreach ($attendees['attachments'] as $attachment) {
                            $attachments .= @$attachment['url'] . "\n";
                        }
                    }

                    foreach($attendees as $key => $attendee)
                    {
                        if ($key === 'attachments') {
                            continue;
                        }
                        if (isset($attendee[0]['MEC_TYPE_OF_DATA'])) {
                            continue;
                        }
                        
                        $ticket_id = isset($attendee['id']) ? $attendee['id'] : get_post_meta($post_id, 'mec_ticket_id', true);
                        $booking = array($post_id, get_the_title($event_id), get_the_date('', $post_id), (isset($tickets[$ticket_id]['name']) ? $tickets[$ticket_id]['name'] : __('Unknown', 'mec')), $transaction_id, $this->main->render_price(($price ? $price : 0)), (isset($attendee['name']) ? $attendee['name'] : (isset($booker->first_name) ? trim($booker->first_name.' '.$booker->last_name) : '')), (isset($attendee['email']) ? $attendee['email'] : @$booker->user_email), $confirmed, $verified);

                        $reg_form = isset($attendee['reg']) ? $attendee['reg'] : array();
                        foreach($reg_fields as $field_id=>$reg_field)
                        {
                            // Placeholder Keys
                            if(!is_numeric($field_id)) continue;

                            $label = isset($reg_field['label']) ? __($reg_field['label'], 'mec') : '';
                            if(trim($label) == '') continue;

                            $booking[] = isset($reg_form[$field_id]) ? ((is_string($reg_form[$field_id]) and trim($reg_form[$field_id])) ? $reg_form[$field_id] : (is_array($reg_form[$field_id]) ? implode(' | ', $reg_form[$field_id]) : '---')) : '';
                        }
                         if ($attachments) {
                            $booking[]  = $attachments;
                            $attachments = '';
                        }
                        fputcsv($output, $booking);
                    }
                }
                
                exit;
                
                break;
            case 'ms-excel-export':

                header('Content-Type: application/vnd.ms-excel; charset=utf-8');
                header('Content-Disposition: attachment; filename=bookings-'.md5(time().mt_rand(100, 999)).'.csv');
                
                $post_ids = (isset($_REQUEST['post']) and is_array($_REQUEST['post'])) ? $_REQUEST['post'] : array();

                $event_ids = array();
                foreach($post_ids as $post_id) $event_ids[] = get_post_meta($post_id, 'mec_event_id', true);
                $event_ids = array_unique($event_ids);

                $main_event_id = NULL;
                if(count($event_ids) == 1) $main_event_id = $event_ids[0];

                $columns = array(__('ID', 'mec'), __('Event', 'mec'), __('Date', 'mec'), $this->main->m('ticket', __('Ticket', 'mec')), __('Transaction ID', 'mec'), __('Total Price', 'mec'), __('Name', 'mec'), __('Email', 'mec'), __('Confirmation', 'mec'), __('Verification', 'mec'));

                $reg_fields = $this->main->get_reg_fields($main_event_id);
                foreach($reg_fields as $reg_field_key=>$reg_field)
                {
                    // Placeholder Keys
                    if(!is_numeric($reg_field_key)) continue;

                    $type = isset($reg_field['type']) ? $reg_field['type'] : '';

                    $label = isset($reg_field['label']) ? __($reg_field['label'], 'mec') : '';
                    if(trim($label) == '') continue;

                    if($type == 'agreement') $label = sprintf($label, get_the_title($reg_field['page']));

                    $columns[] = $label;
                }
                $columns[] = 'Attachments';
                $output = fopen('php://output', 'w');
                fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($output, $columns, "\t");
                
                foreach($post_ids as $post_id)
                {
                    $post_id = (int) $post_id;

                    $event_id = get_post_meta($post_id, 'mec_event_id', true);
                    $booker_id = get_post_field('post_author', $post_id);
                    $transaction_id = get_post_meta($post_id, 'mec_transaction_id', true);

                    $tickets = get_post_meta($event_id, 'mec_tickets', true);

                    $attendees = get_post_meta($post_id, 'mec_attendees', true);
                    if(!is_array($attendees) or (is_array($attendees) and !count($attendees))) $attendees = array(get_post_meta($post_id, 'mec_attendee', true));

                    $price = get_post_meta($post_id, 'mec_price', true);
                    $booker = get_userdata($booker_id);
                    
                    $confirmed = $this->main->get_confirmation_label(get_post_meta($post_id, 'mec_confirmed', true));
                    $verified = $this->main->get_verification_label(get_post_meta($post_id, 'mec_verified', true));

                     $attachments = '';
                    if( isset( $attendees['attachments'] ) ) 
                    {
                        foreach ($attendees['attachments'] as $attachment) {
                            $attachments .= @$attachment['url'] . " - ";
                        }
                    }

                    foreach($attendees as $key => $attendee)
                    {
                        if ($key === 'attachments') {
                            continue;
                        }
                        if (isset($attendee[0]['MEC_TYPE_OF_DATA'])) {
                            continue;
                        }
                        $ticket_id = isset($attendee['id']) ? $attendee['id'] : get_post_meta($post_id, 'mec_ticket_id', true);
                        $booking = array($post_id, get_the_title($event_id), get_the_date('', $post_id), (isset($tickets[$ticket_id]['name']) ? $tickets[$ticket_id]['name'] : __('Unknown', 'mec')), $transaction_id, $this->main->render_price(($price ? $price : 0)), (isset($attendee['name']) ? $attendee['name'] : (isset($booker->first_name) ? trim($booker->first_name.' '.$booker->last_name) : '')), (isset($attendee['email']) ? $attendee['email'] : $booker->user_email), $confirmed, $verified,$attachments);

                        $reg_form = isset($attendee['reg']) ? $attendee['reg'] : array();
                        foreach($reg_fields as $field_id=>$reg_field)
                        {
                            // Placeholder Keys
                            if(!is_numeric($field_id)) continue;

                            $label = isset($reg_field['label']) ? __($reg_field['label'], 'mec') : '';
                            if(trim($label) == '') continue;

                            $booking[] = isset($reg_form[$field_id]) ? ((is_string($reg_form[$field_id]) and trim($reg_form[$field_id])) ? $reg_form[$field_id] : (is_array($reg_form[$field_id]) ? implode(' | ', $reg_form[$field_id]) : '---')) : '';
                        }
                        if ($attachments) {
                            $booking[]  = $attachments;
                            $attachments = '';
                        }
                        fputcsv($output, $booking, "\t");
                    }
                }
                
                exit;
                
                break;
            default: return true;
        }
        
        wp_redirect('edit.php?post_type='.$this->PT);
        exit;
    }
    
    /**
     * Save book data from backend
     * @author Webnus <info@webnus.biz>
     * @param int $post_id
     * @return void
     */
    public function save_book($post_id)
    {
        // Check if our nonce is set.
        if(!isset($_POST['mec_book_nonce'])) return;

        // Verify that the nonce is valid.
        if(!wp_verify_nonce(sanitize_text_field($_POST['mec_book_nonce']), 'mec_book_data')) return;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) return;

        $is_new_booking = isset($_POST['mec_is_new_booking']) ? sanitize_text_field($_POST['mec_is_new_booking']) : 0;
        if($is_new_booking)
        {
            // Initialize Pay Locally Gateway to handle the booking
            $gateway = new MEC_gateway_pay_locally();

            // Register Attendee
            $attendee = isset($_POST['mec_attendee']) ? $_POST['mec_attendee'] : array();
            $user_id = $gateway->register_user($attendee);

            $attention_date = isset($_POST['mec_date']) ? sanitize_text_field($_POST['mec_date']) : '';
            $ex = explode(':', $attention_date);
            $date = trim($ex[0]);

            $name = isset($attendee['name']) ? $attendee['name'] : '';
            $ticket_id = isset($_POST['mec_ticket_id']) ? sanitize_text_field($_POST['mec_ticket_id']) : '';
            $event_id = isset($_POST['mec_event_id']) ? sanitize_text_field($_POST['mec_event_id']) : '';

            $tickets = array(array_merge($attendee, array('id'=>$ticket_id, 'count'=>1, 'variations'=>array(), 'reg'=>array())));
            $raw_tickets = array($ticket_id=>1);
            $event_tickets = get_post_meta($event_id, 'mec_tickets', true);

            $transaction = array();
            $transaction['tickets'] = $tickets;
            $transaction['date'] = $attention_date;
            $transaction['event_id'] = $event_id;

            // Calculate price of bookings
            $price_details = $this->book->get_price_details($raw_tickets, $event_id, $event_tickets, array());

            $transaction['price_details'] = $price_details;
            $transaction['total'] = $price_details['total'];
            $transaction['discount'] = 0;
            $transaction['price'] = $price_details['total'];
            $transaction['coupon'] = NULL;

            // Save The Transaction
            $transaction_id = $this->book->temporary($transaction);

            remove_action('save_post', array($this, 'save_book'), 10); // In order to don't create infinitive loop!
            $post_id = $this->book->add(array('ID'=>$post_id, 'post_author'=>$user_id, 'post_type'=>$this->PT, 'post_title'=>$name, 'post_date'=>$date), $transaction_id, ','.$ticket_id.',');

            update_post_meta($post_id, 'mec_attendees', $tickets);
            update_post_meta($post_id, 'mec_reg', (isset($attendee['reg']) ? $attendee['reg'] : array()));
            update_post_meta($post_id, 'mec_gateway', 'MEC_gateway_pay_locally');
            update_post_meta($post_id, 'mec_gateway_label', $gateway->label());

            // Fires after completely creating a new booking
            do_action('mec_booking_completed', $post_id);
        }

        $new_confirmation = isset($_POST['confirmation']) ? sanitize_text_field($_POST['confirmation']) : NULL;
        $new_verification = isset($_POST['verification']) ? sanitize_text_field($_POST['verification']) : NULL;
        
        $confirmed = get_post_meta($post_id, 'mec_confirmed', true);
        $verified = get_post_meta($post_id, 'mec_verified', true);
        
        // Change Confirmation Status
        if(!is_null($new_confirmation) and $new_confirmation != $confirmed)
        {
            switch($new_confirmation)
            {
                case '1':
                    
                    $this->book->confirm($post_id);
                    break;
                case '-1':
                    
                    $this->book->reject($post_id);
                    break;
                
                default:
                    
                    $this->book->pending($post_id);
                    break;
            }
        }
        
        // Change Verification Status
        if(!is_null($new_verification) and $new_verification != $verified)
        {
            switch($new_verification)
            {
                case '1':
                    
                    $this->book->verify($post_id);
                    break;
                case '-1':
                    
                    $this->book->cancel($post_id);
                    break;
                
                default:
                    
                    $this->book->waiting($post_id);
                    break;
            }
        }
    }
    
    /**
     * Process book steps from book form in frontend
     * @author Webnus <info@webnus.biz>
     */
    public function book()
    {
        $event_id = sanitize_text_field($_REQUEST['event_id']);
        
        // Check if our nonce is set.
        if(!isset($_REQUEST['_wpnonce'])) $this->main->response(array('success'=>0, 'message'=>__('Security nonce is missing.', 'mec'), 'code'=>'NONCE_MISSING'));

        // Verify that the nonce is valid.
        if(!wp_verify_nonce(sanitize_text_field($_REQUEST['_wpnonce']), 'mec_book_form_'.$event_id)) $this->main->response(array('success'=>0, 'message'=>__('Security nonce is invalid.', 'mec'), 'code'=>'NONCE_IS_INVALID'));

        if(!function_exists('wp_handle_upload')){
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        if ( isset(  $_FILES['book'] ) ) {
            $counter = 0;
            $attachments = [];
            $files = $_FILES['book'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    foreach ($files['name'][$key][1]['reg'] as $id => $reg) {
                        if ( ! empty ( $files['name'][$key][1]['reg'][$id] ) ) {
                            $file = array(
                                'name'     => $files['name'][$key][1]['reg'][$id],
                                'type'     => $files['type'][$key][1]['reg'][$id],
                                'tmp_name' => $files['tmp_name'][$key][1]['reg'][$id],
                                'error'    => $files['error'][$key][1]['reg'][$id],
                                'size'     => $files['size'][$key][1]['reg'][$id]
                            );
                            
                            $maxFileSize = isset($this->settings['upload_field_max_upload_size']) && $this->settings['upload_field_max_upload_size'] ? $this->settings['upload_field_max_upload_size'] * 1048576 : wp_max_upload_size();
                            if ( $file['error'] || $file['size'] > $maxFileSize) {
                                $this->main->response(array('success'=>0, 'message'=> '"'.$files['name'][$key][1]['reg'][$id] .'"<br />'.__('Uploaded file size exceeds the maximum allowed size.', 'mec')));
                                die();
                            }
                            
                            $extensions     = isset($this->settings['upload_field_mime_types']) && $this->settings['upload_field_mime_types'] ? explode(',', $this->settings['upload_field_mime_types']): ['jpeg','jpg','png','pdf'];
                            $file_extension = count(explode(".", $file['name'])) >= 2 ? end(explode(".", $file['name'])) : '';
                            $has_valid_type = false;

                            foreach ($extensions as $extension) {
                                if ($extension == $file_extension) {
                                    $has_valid_type = true;
                                    break;
                                }
                            }
                            if ( ! $has_valid_type ) {
                                $this->main->response(array('success'=>0, 'message'=> '"'.$files['name'][$key][1]['reg'][$id] .'"<br />'.__('Uploaded file type is not valid.', 'mec')));
                                die();
                            }
                            
                            $uploaded_file = wp_handle_upload($file, array('test_form' => false));
                            if( $uploaded_file && ! isset( $uploaded_file['error'] ) ) {
                                $attachments[$counter]['MEC_TYPE_OF_DATA'] = "attachment";
                                $attachments[$counter]['response'] = "SUCCESS";
                                $attachments[$counter]['filename'] = basename( $uploaded_file['url'] );
                                $attachments[$counter]['url'] = $uploaded_file['url'];
                                $attachments[$counter]['type'] = $uploaded_file['type'];
                            }
                            $counter++;
                        }
                    }
                }
            }
        }
        
        $step = sanitize_text_field($_REQUEST['step']);
        
        $book = $_REQUEST['book'];
        $date = isset($book['date']) ? $book['date'] : NULL;
        $tickets = isset($book['tickets']) ? $book['tickets'] : NULL;
        $uniqueid = isset($_REQUEST['uniqueid']) ? sanitize_text_field($_REQUEST['uniqueid']) : $event_id;
        
        if(is_null($date) or is_null($tickets)) $this->main->response(array('success'=>0, 'message'=>__('Invalid request.', 'mec'), 'code'=>'INVALID_REQUEST'));
        
        // Render libraary
        $render = $this->getRender();
        $rendered = $render->data($event_id, '');
        
        $event = new stdClass();
        $event->ID = $event_id;
        $event->data = $rendered;
        
        // Next Booking step
        $next_step = 'form';
        $response_data = array();
        
        switch($step)
        {
            case '1':
                
                $has_ticket = false;
                foreach($tickets as $ticket)
                {
                    if($ticket > 0)
                    {
                        $has_ticket = true;
                        break;
                    }
                }
                
                if(!$has_ticket) $this->main->response(array('success'=>0, 'message'=>__('Please select some tickets!', 'mec'), 'code'=>'NO_TICKET'));
                
                // Google recaptcha
                if($this->main->get_recaptcha_status('booking'))
                {
                    $g_recaptcha_response = isset($_REQUEST['g-recaptcha-response']) ? $_REQUEST['g-recaptcha-response'] : NULL;
                    if(!$this->main->get_recaptcha_response($g_recaptcha_response)) $this->main->response(array('success'=>0, 'message'=>__('Captcha is invalid. Please try again.', 'mec'), 'code'=>'CAPTCHA_IS_INVALID'));
                }
                
                $next_step = 'form';
                break;
            
            case '2':
                
                $raw_tickets = array();
                $raw_variations = array();
                $validated_tickets = array();

                // Apply first attendee information for all attendees
                $first_for_all = isset($book['first_for_all']) ? $book['first_for_all'] : 0;

                if($first_for_all)
                {
                    $first_attendee = NULL;

                    $rendered_tickets = array();
                    foreach($tickets as $ticket)
                    {
                        // Find first ticket
                        if(is_null($first_attendee)) $first_attendee = $ticket;

                        $ticket['name'] = $first_attendee['name'];
                        $ticket['email'] = $first_attendee['email'];
                        $ticket['reg'] = $first_attendee['reg'];
                        $ticket['variations'] = isset($first_attendee['variations']) ? $first_attendee['variations'] : array();

                        $rendered_tickets[] = $ticket;
                    }

                    $tickets = $rendered_tickets;
                }

                foreach($tickets as $ticket)
                {
                    if(isset($ticket['email']) and (trim($ticket['email']) == '' or !filter_var($ticket['email'], FILTER_VALIDATE_EMAIL))) continue;
                    if(!isset($ticket['name']) or (isset($ticket['name']) and trim($ticket['name']) == '')) continue;

                    if(!isset($raw_tickets[$ticket['id']])) $raw_tickets[$ticket['id']] = 1;
                    else $raw_tickets[$ticket['id']] += 1;

                    if(isset($ticket['variations']) and is_array($ticket['variations']) and count($ticket['variations']))
                    {
                        foreach($ticket['variations'] as $variation_id=>$variation_count)
                        {
                            if(!trim($variation_count)) continue;

                            if(!isset($raw_variations[$variation_id])) $raw_variations[$variation_id] = $variation_count;
                            else $raw_variations[$variation_id] += $variation_count;
                        }
                    }

                    $validated_tickets[] = $ticket;
                }
                
                // Attendee form is not filled correctly
                if(!count($validated_tickets)) $this->main->response(array('success'=>0, 'message'=>__('Please fill the form correctly. Email and Name fields are required!', 'mec'), 'code'=>'ATTENDEE_FORM_INVALID'));
                // Attachments
                if (isset($attachments)) {
                    $validated_tickets['attachments'] = $attachments;
                }

                // Tickets
                $event_tickets = isset($event->data->tickets) ? $event->data->tickets : array();

                // Booking Date
                $date_ex = explode(':', $book['date']);
                $occurrence = $date_ex[0];
                
                // Calculate price of bookings
                $price_details = $this->book->get_price_details($raw_tickets, $event_id, $event_tickets, $raw_variations, $occurrence);
                
                $book['tickets'] = $validated_tickets;
                $book['price_details'] = $price_details;
                $book['total'] = $price_details['total'];
                $book['discount'] = 0;
                $book['price'] = $price_details['total'];
                $book['coupon'] = NULL;

                $next_step = 'checkout';
                $transaction_id = $this->book->temporary($book);
                
                // the booking is free
                if($price_details['total'] == 0)
                {
                    $free_gateway = new MEC_gateway_free();
                    $free_gateway->do_transaction($transaction_id);
                    
                    $next_step = 'message';

                    if(isset($this->settings['booking_thankyou_page']) and trim($this->settings['booking_thankyou_page'])) $response_data['redirect_to'] = $this->book->get_thankyou_page($this->settings['booking_thankyou_page'], $transaction_id);

                    // Invoice Link
                    $response_data['invoice_link'] = $this->book->get_invoice_link($transaction_id);
                }
                
                break;
            
            case '3':
                
                $next_step = 'payment';
                break;
            
            case '4':
                
                $next_step = 'notifications';
                break;
        }
        
        $path = MEC::import('app.modules.booking.steps.'.$next_step, true, true);
        
        ob_start();
        include $path;
        $output = ob_get_clean();
        
        $this->main->response(array('success'=>1, 'output'=>$output, 'data'=>$response_data));
    }
    
    public function tickets_availability()
    {
        $event_id = isset($_REQUEST['event_id']) ? sanitize_text_field($_REQUEST['event_id']) : '';
        $date = isset($_REQUEST['date']) ? sanitize_text_field($_REQUEST['date']) : '';
        
        $ex = explode(':', $date);
        $date = $ex[0];
        
        $availability = $this->book->get_tickets_availability($event_id, $date);
        $prices = $this->book->get_tickets_prices($event_id, current_time('Y-m-d'), 'price_label');

        $this->main->response(array('success'=>1, 'availability'=>$availability, 'prices'=>$prices));
    }

    public function bbf_date_tickets_booking_form()
    {
        $event_id = isset($_REQUEST['event_id']) ? sanitize_text_field($_REQUEST['event_id']) : '';

        // Event is invalid!
        if(!trim($event_id)) $this->main->response(array('success'=>0, 'output'=>'<div class="warning-msg">'.__('Event is invalid. Please select an event.', 'mec').'</div>'));

        $tickets = get_post_meta($event_id, 'mec_tickets', true);

        $render = $this->getRender();
        $dates = $render->dates($event_id, NULL, 10);

        // Invalid Event, Tickets or Dates
        if(!is_array($tickets) or (is_array($tickets) and !count($tickets))) $this->main->response(array('success'=>0, 'output'=>'<div class="warning-msg">'.__('No ticket or future dates found for this event! Please try another event.', 'mec').'</div>'));

        // Date Option
        $date_options = '';
        foreach($dates as $date) $date_options .= '<option value="'.$date['start']['date'].':'.$date['end']['date'].'">'.$date['start']['date'].' - '.$date['end']['date'].'</option>';

        $output = '<div class="mec-form-row"><div class="mec-col-2"><label for="mec_book_form_date">'.__('Date', 'mec').'</label></div>';
        $output .= '<div class="mec-col-6"><select class="widefat" name="mec_date" id="mec_book_form_date">'.$date_options.'</select></div></div>';

        // Ticket option
        $ticket_options = '';
        foreach($tickets as $ticket_id => $ticket) $ticket_options .= '<option value="'.$ticket_id.'">'.$ticket['name'].'</option>';

        $output .= '<div class="mec-form-row"><div class="mec-col-2"><label for="mec_book_form_ticket_id">'.__('Ticket', 'mec').'</label></div>';
        $output .= '<div class="mec-col-6"><select class="widefat" name="mec_ticket_id" id="mec_book_form_ticket_id">'.$ticket_options.'</select></div></div>';

        // Booking Form
        $reg_fields = $this->main->get_reg_fields($event_id);

        $booking_form_options = '';
        $booking_form_options .= '<div class="mec-form-row"><div class="mec-col-2"><label for="mec_book_reg_field_name">'.__('Name', 'mec').'</label></div><div class="mec-col-6"><input class="widefat" id="mec_book_reg_field_name" type="text" name="mec_attendee[name]" value="" placeholder="'.__('Name', 'mec').'" required="required" /></div></div>';
        $booking_form_options .= '<div class="mec-form-row"><div class="mec-col-2"><label for="mec_book_reg_field_email">'.__('Email', 'mec').'</label></div><div class="mec-col-6"><input class="widefat" id="mec_book_reg_field_email" type="email" name="mec_attendee[email]" value="" placeholder="'.__('Email', 'mec').'" required="required" /></div></div>';

        if(count($reg_fields))
        {
            foreach($reg_fields as $reg_field_id=>$reg_field)
            {
                if(!is_numeric($reg_field_id) or !isset($reg_field['type'])) continue;

                $booking_form_options .= '<div class="mec-form-row">';

                if(isset($reg_field['label']) and $reg_field['type'] != 'agreement') $booking_form_options .= '<div class="mec-col-2"><label for="mec_book_reg_field_reg'.$reg_field_id.'">'.__($reg_field['label'], 'mec').'</label></div>';
                elseif(isset($reg_field['label']) and $reg_field['type'] == 'agreement') $booking_form_options .= '<div class="mec-col-2"></div>';

                $booking_form_options .= '<div class="mec-col-6">';
                $mandatory = (isset($reg_field['mandatory']) and $reg_field['mandatory']) ? true : false;

                if ($reg_field['type'] == 'text') {
                    $booking_form_options .= '<input class="widefat" id="mec_book_reg_field_reg'.$reg_field_id.'" type="text" name="mec_attendee[reg]['.$reg_field_id.']" value="" placeholder="'.__($reg_field['label'], 'mec').'" '.($mandatory ? 'required="required"' : '').' />';
                } elseif ($reg_field['type'] == 'email') {
                    $booking_form_options .= '<input class="widefat" id="mec_book_reg_field_reg'.$reg_field_id.'" type="email" name="mec_attendee[reg]['.$reg_field_id.']" value="" placeholder="'.__($reg_field['label'], 'mec').'" '.($mandatory ? 'required="required"' : '').' />';
                } elseif ($reg_field['type'] == 'tel') {
                    $booking_form_options .= '<input class="widefat" oninput="this.value=this.value.replace(/(?![0-9])./gmi,"")" id="mec_book_reg_field_reg'.$reg_field_id.'" type="tel" name="mec_attendee[reg]['.$reg_field_id.']" value="" placeholder="'.__($reg_field['label'], 'mec').'" '.($mandatory ? 'required="required"' : '').' />';
                } elseif ($reg_field['type'] == 'textarea') {
                    $booking_form_options .= '<textarea class="widefat" id="mec_book_reg_field_reg'.$reg_field_id.'" name="mec_attendee[reg]['.$reg_field_id.']" placeholder="'.__($reg_field['label'], 'mec').'" '.($mandatory ? 'required="required"' : '').'></textarea>';
                } elseif ($reg_field['type'] == 'p') {
                    $booking_form_options .= '<p>'.__($reg_field['content'], 'mec').'</p>';
                } elseif ($reg_field['type'] == 'select') {
                    $booking_form_options .= '<select class="widefat" id="mec_book_reg_field_reg'.$reg_field_id.'" name="mec_attendee[reg]['.$reg_field_id.']" placeholder="'.__($reg_field['label'], 'mec').'" '.($mandatory ? 'required="required"' : '').'>';
                    foreach($reg_field['options'] as $reg_field_option) $booking_form_options .= '<option value="'.esc_attr__($reg_field_option['label'], 'mec').'">'.__($reg_field_option['label'], 'mec').'</option>';
                    $booking_form_options .= '</select>';
                }
                elseif($reg_field['type'] == 'radio')
                {
                    foreach($reg_field['options'] as $reg_field_option)
                    {
                        $booking_form_options .= '<label for="mec_book_reg_field_reg'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])).'">
                            <input type="radio" id="mec_book_reg_field_reg'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])).'" name="mec_attendee[reg]['.$reg_field_id.']" value="'.__($reg_field_option['label'], 'mec').'" />
                            '.__($reg_field_option['label'], 'mec').'
                        </label>';
                    }
                }
                elseif($reg_field['type'] == 'checkbox')
                {
                    foreach($reg_field['options'] as $reg_field_option)
                    {
                        $booking_form_options .= '<label for="mec_book_reg_field_reg'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])).'">
                            <input type="checkbox" id="mec_book_reg_field_reg'.$reg_field_id.'_'.strtolower(str_replace(' ', '_', $reg_field_option['label'])).'" name="mec_attendee[reg]['.$reg_field_id.'][]" value="'.__($reg_field_option['label'], 'mec').'" />
                            '.__($reg_field_option['label'], 'mec').'
                        </label>';
                    }
                }
                elseif($reg_field['type'] == 'agreement')
                {
                    $booking_form_options .= '<label for="mec_book_reg_field_reg'.$reg_field_id.'">
                        <input type="checkbox" id="mec_book_reg_field_reg'.$reg_field_id.'" name="mec_attendee[reg]['.$reg_field_id.']" value="1" '.((!isset($reg_field['status']) or (isset($reg_field['status']) and $reg_field['status'] == 'checked')) ? 'checked="checked"' : '').' '.($mandatory ? 'required="required"' : '').' />
                        '.sprintf(__($reg_field['label'], 'mec'), '<a href="'.get_the_permalink($reg_field['page']).'" target="_blank">'.get_the_title($reg_field['page']).'</a>').'
                    </label>';
                }

                $booking_form_options .= '</div>';

                $booking_form_options .= '</div>';
            }
        }

        $output .= '<h3>'.__('Attendee Information', 'mec').'</h3>';
        $output .= $booking_form_options;

        $this->main->response(array('success' => 1, 'output' => $output));
    }
}