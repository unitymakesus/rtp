<?php
/** no direct access **/
defined('MECEXEC') or die();

// Generating javascript code of countdown module
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    var mec_fes_form_ajax = false;
    jQuery("#mec_fes_form").on("submit", function(event)
    {
        event.preventDefault();

        // Hide the message
        jQuery("#mec_fes_form_message").removeClass("mec-success").removeClass("mec-success").html("").hide();

        // Add loading Class to the form
        jQuery("#mec_fes_form").addClass("mec-fes-loading");

        // Fix WordPress editor issue
        jQuery("#mec_fes_content-html").click();
        jQuery("#mec_fes_content-tmce").click();

        // Abort previous request
        if(mec_fes_form_ajax) mec_fes_form_ajax.abort();

        var data = jQuery("#mec_fes_form").serialize();
        mec_fes_form_ajax = jQuery.ajax(
        {
            type: "POST",
            url: "'.admin_url('admin-ajax.php', NULL).'",
            data: data,
            dataType: "JSON",
            success: function(response)
            {
                // Remove the loading Class from the form
                jQuery("#mec_fes_form").removeClass("mec-fes-loading");

                if(response.success == "1")
                {
                    // Show the message
                    jQuery("#mec_fes_form_message").removeClass("mec-success").addClass("mec-success").html(response.message).css("display","inline-block");

                    // Set the event id
                    jQuery(".mec-fes-post-id").val(response.data.post_id);

                    // Hide the form so it cannot be resubmitted
                    jQuery(".mec-fes-form-cntt").hide();
                    jQuery(".mec-fes-form-sdbr").hide();
                    jQuery(".mec-fes-submit-wide").hide();

                }
                else
                {
                    // Show the message
                    jQuery("#mec_fes_form_message").removeClass("mec-error").addClass("mec-error").html(response.message).css("display","inline-block");
                    
                    // Remove the loading Class from the form
                    jQuery("#mec_fes_form").removeClass("mec-fes-loading");

                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // Remove the loading Class from the form
                jQuery("#mec_fes_form").removeClass("mec-fes-loading");
            }
        });
    });
});

function mec_fes_upload_featured_image()
{
    var fd = new FormData();
    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_featured_image_file").prop("files")[0]);

    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        jQuery("#mec_fes_thumbnail").val(data.data.url);
        jQuery("#mec_featured_image_file").val("");
        jQuery("#mec_fes_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
        jQuery("#mec_fes_remove_image_button").removeClass("mec-util-hidden");
    });

    return false;
}

function mec_fes_upload_location_thumbnail()
{
    var fd = new FormData();

    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_fes_location_thumbnail_file").prop("files")[0]);

    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        jQuery("#mec_fes_location_thumbnail").val(data.data.url);
        jQuery("#mec_fes_location_thumbnail_file").val("");
        jQuery("#mec_fes_location_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
        jQuery("#mec_fes_location_remove_image_button").removeClass("mec-util-hidden");
    });

    return false;
}

function mec_fes_upload_organizer_thumbnail()
{
    var fd = new FormData();

    fd.append("action", "mec_fes_upload_featured_image");
    fd.append("_wpnonce", "'.wp_create_nonce('mec_fes_upload_featured_image').'");
    fd.append("file", jQuery("#mec_fes_organizer_thumbnail_file").prop("files")[0]);

    jQuery.ajax(
    {
        url: "'.admin_url('admin-ajax.php', NULL).'",
        type: "POST",
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false
    })
    .done(function(data)
    {
        jQuery("#mec_fes_organizer_thumbnail").val(data.data.url);
        jQuery("#mec_fes_organizer_thumbnail_file").val("");
        jQuery("#mec_fes_organizer_thumbnail_img").html("<img src=\""+data.data.url+"\" />");
        jQuery("#mec_fes_organizer_remove_image_button").removeClass("mec-util-hidden");
    });

    return false;
}
</script>';

// Include javascript code into the footer
$this->factory->params('footer', $javascript);
?>
<div class="mec-fes-form">

    <form id="mec_fes_form" enctype="multipart/form-data">

        <?php
            $allday = get_post_meta($post_id, 'mec_allday', true);
            $comment = get_post_meta($post_id, 'mec_comment', true);
            $hide_time = get_post_meta($post_id, 'mec_hide_time', true);
            $hide_end_time = get_post_meta($post_id, 'mec_hide_end_time', true);

            $start_date = get_post_meta($post_id, 'mec_start_date', true);

            $start_time_hour = get_post_meta($post_id, 'mec_start_time_hour', true);
            if(trim($start_time_hour) == '') $start_time_hour = 8;

            $start_time_minutes = get_post_meta($post_id, 'mec_start_time_minutes', true);
            if(trim($start_time_minutes) == '') $start_time_minutes = 0;

            $start_time_ampm = get_post_meta($post_id, 'mec_start_time_ampm', true);
            if(trim($start_time_ampm) == '') $start_time_minutes = 'AM';

            $end_date = get_post_meta($post_id, 'mec_end_date', true);

            $end_time_hour = get_post_meta($post_id, 'mec_end_time_hour', true);
            if(trim($end_time_hour) == '') $end_time_hour = 6;

            $end_time_minutes = get_post_meta($post_id, 'mec_end_time_minutes', true);
            if(trim($end_time_minutes) == '') $end_time_minutes = 0;

            $end_time_ampm = get_post_meta($post_id, 'mec_end_time_ampm', true);
            if(trim($end_time_ampm) == '') $end_time_ampm = 'PM';

            $repeat_status = get_post_meta($post_id, 'mec_repeat_status', true);
            $repeat_type = get_post_meta($post_id, 'mec_repeat_type', true);

            $repeat_interval = get_post_meta($post_id, 'mec_repeat_interval', true);
            if(trim($repeat_interval) == '' and in_array($repeat_type, array('daily', 'weekly'))) $repeat_interval = 1;

            $certain_weekdays = get_post_meta($post_id, 'mec_certain_weekdays', true);
            if($repeat_type != 'certain_weekdays') $certain_weekdays = array();

            $in_days_str = get_post_meta($post_id, 'mec_in_days', true);
            $in_days = trim($in_days_str) ? explode(',', $in_days_str) : array();

            $mec_repeat_end = get_post_meta($post_id, 'mec_repeat_end', true);
            if(trim($mec_repeat_end) == '') $mec_repeat_end = 'never';

            $repeat_end_at_occurrences = get_post_meta($post_id, 'mec_repeat_end_at_occurrences', true);
            if(trim($repeat_end_at_occurrences) == '') $repeat_end_at_occurrences = 9;

            $repeat_end_at_date = get_post_meta($post_id, 'mec_repeat_end_at_date', true);
        ?>

        <div class="mec-fes-form-cntt">
            <div class="mec-meta-box-fields">
                <h4 id="mec_fes_title_label"><?php _e('Name of Event', 'mec'); ?> <abbr title="required">*</abbr></h4>
                <input aria-labelledby="mec_fes_title_label" type="text" name="mec[title]" id="mec_fes_title" value="<?php echo (isset($post->post_title) ? $post->post_title : ''); ?>" required="required" />
            </div>
            <div class="mec-meta-box-fields">
              <h4 id="mec_fes_content_label"><?php _e('Event Description', 'mec'); ?></h4>
                <?php wp_editor((isset($post->post_content) ? $post->post_content : ''), 'mec_fes_content', array('textarea_name'=>'mec[content]', 'media_buttons'=>false, 'textarea_rows'=>6, 'teeny'=>true)); ?>
            </div>
            <div class="mec-meta-box-fields" id="mec-date-time">
                <h4><?php _e('Date and Time', 'mec'); ?></h4>
                <div id="mec_meta_box_date_form">
                    <div class="mec-title">
                        <span class="mec-dashicons dashicons dashicons-calendar-alt"></span>
                        <label for="mec_start_date"><?php _e('Start Date', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <input type="text" name="mec[date][start][date]" id="mec_start_date" value="<?php echo esc_attr($start_date); ?>" placeholder="<?php _e('Start Date', 'mec'); ?>" class="" />
                        </div>
                        <div class="mec-col-6 mec-time-picker">
                            <?php if(isset($this->settings['time_format']) and $this->settings['time_format'] == 24): if($start_time_ampm == 'PM' and $start_time_hour != 12) $start_time_hour += 12; if($start_time_ampm == 'AM' and $start_time_hour == 12) $start_time_hour += 12; ?>
                              <label for="mec_start_hour" class="screen-reader-text">Start Time: Hour</label>
                              <select name="mec[date][start][hour]" id="mec_start_hour">
                                  <?php for($i=0; $i<=23; $i++): ?>
                                  <option <?php if($start_time_hour == $i) echo 'selected="selected"'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php endfor; ?>
                              </select>
                              <span class="time-dv">:</span>
                              <label for="mec_start_minutes" class="screen-reader-text">Start Time: Minutes</label>
                              <select name="mec[date][start][minutes]" id="mec_start_minutes">
                                  <?php for($i=0; $i<=11; $i++): ?>
                                  <option <?php if($start_time_minutes == ($i*5)) echo 'selected="selected"'; ?> value="<?php echo ($i*5); ?>"><?php echo sprintf("%02d", ($i*5)); ?></option>
                                  <?php endfor; ?>
                              </select>
                            <?php else: ?>
                              <label for="mec_start_hour" class="screen-reader-text">Start Time: Hour</label>
                              <select name="mec[date][start][hour]" id="mec_start_hour">
                                  <?php for($i=1; $i<=12; $i++): ?>
                                  <option <?php if($start_time_hour == $i) echo 'selected="selected"'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php endfor; ?>
                              </select>
                              <span class="time-dv">:</span>
                              <label for="mec_start_minutes" class="screen-reader-text">Start Time: Minutes</label>
                              <select name="mec[date][start][minutes]" id="mec_start_minutes">
                                  <?php for($i=0; $i<=11; $i++): ?>
                                  <option <?php if($start_time_minutes == ($i*5)) echo 'selected="selected"'; ?> value="<?php echo ($i*5); ?>"><?php echo sprintf("%02d", ($i*5)); ?></option>
                                  <?php endfor; ?>
                              </select>
                              <label for="mec_start_ampm" class="screen-reader-text">Start Time: AM or PM</label>
                              <select name="mec[date][start][ampm]" id="mec_start_ampm">
                                  <option <?php if($start_time_ampm == 'AM') echo 'selected="selected"'; ?> value="AM"><?php _e('AM', 'mec'); ?></option>
                                  <option <?php if($start_time_ampm == 'PM') echo 'selected="selected"'; ?> value="PM"><?php _e('PM', 'mec'); ?></option>
                              </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mec-title">
                        <span class="mec-dashicons dashicons dashicons-calendar-alt"></span>
                        <label for="mec_end_date"><?php _e('End Date', 'mec'); ?></label>
                    </div>
                    <div class="mec-form-row">
                        <div class="mec-col-4">
                            <input type="text" name="mec[date][end][date]" id="mec_end_date" value="<?php echo esc_attr($end_date); ?>" placeholder="<?php _e('End Date', 'mec'); ?>" class="" />
                        </div>
                        <div class="mec-col-6 mec-time-picker">
                            <?php if(isset($this->settings['time_format']) and $this->settings['time_format'] == 24): if($end_time_ampm == 'PM' and $end_time_hour != 12) $end_time_hour += 12; if($end_time_ampm == 'AM' and $end_time_hour == 12) $end_time_hour += 12; ?>
                              <label for="mec_end_hour" class="screen-reader-text">End Time: Hour</label>
                              <select name="mec[date][end][hour]" id="mec_end_hour">
                                  <?php for($i=0; $i<=23; $i++): ?>
                                  <option <?php if($end_time_hour == $i) echo 'selected="selected"'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php endfor; ?>
                              </select>
                              <span class="time-dv">:</span>
                              <label for="mec_end_minutes" class="screen-reader-text">End Time: Minutes</label>
                              <select name="mec[date][end][minutes]" id="mec_end_minutes">
                                  <?php for($i=0; $i<=11; $i++): ?>
                                  <option <?php if($end_time_minutes == ($i*5)) echo 'selected="selected"'; ?> value="<?php echo ($i*5); ?>"><?php echo sprintf("%02d", ($i*5)); ?></option>
                                  <?php endfor; ?>
                              </select>
                            <?php else: ?>
                              <label for="mec_end_hour" class="screen-reader-text">End Time: Hour</label>
                              <select name="mec[date][end][hour]" id="mec_end_hour">
                                  <?php for($i=1; $i<=12; $i++): ?>
                                  <option <?php if($end_time_hour == $i) echo 'selected="selected"'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                  <?php endfor; ?>
                              </select>
                              <span class="time-dv">:</span>
                              <label for="mec_end_minutes" class="screen-reader-text">End Time: Minutes</label>
                              <select name="mec[date][end][minutes]" id="mec_end_minutes">
                                  <?php for($i=0; $i<=11; $i++): ?>
                                  <option <?php if($end_time_minutes == ($i*5)) echo 'selected="selected"'; ?> value="<?php echo ($i*5); ?>"><?php echo sprintf("%02d", ($i*5)); ?></option>
                                  <?php endfor; ?>
                              </select>
                              <label for="mec_end_ampm" class="screen-reader-text">End Time: AM or PM</label>
                              <select name="mec[date][end][ampm]" id="mec_end_ampm">
                                  <option <?php if($end_time_ampm == 'AM') echo 'selected="selected"'; ?> value="AM"><?php _e('AM', 'mec'); ?></option>
                                  <option <?php if($end_time_ampm == 'PM') echo 'selected="selected"'; ?> value="PM"><?php _e('PM', 'mec'); ?></option>
                              </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php do_action('mec_fes_metabox_details', $post); ?>

            <?php /* Note feature is enabled */ if($this->main->is_note_visible(get_post_status($post_id))): $note = get_post_meta($post_id, 'mec_note', true); ?>
            <div class="mec-meta-box-fields" id="mec-event-note">
                <h4 id="mec-event-note-label"><?php _e('Note to reviewer', 'mec'); ?></h4>
                <div id="mec_meta_box_event_note">
                    <textarea name="mec[note]" aria-labelledby="mec-event-note-label"><?php echo $note; ?></textarea>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="mec-fes-form-sdbr">

            <!-- Guest Email and Name -->
            <?php if(!is_user_logged_in() and isset($this->settings['fes_guest_name_email']) and $this->settings['fes_guest_name_email']): ?>
            <?php
                $guest_email = get_post_meta($post_id, 'fes_guest_email', true);
                $guest_name = get_post_meta($post_id, 'fes_guest_name', true);
            ?>
            <div class="mec-meta-box-fields" id="mec-guest-email-link">
                <h4><?php _e('Contact Information', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_guest_name"><?php _e('Contact Name', 'mec'); ?> <abbr title="required">*</abbr></label>
                    <input class="mec-col-7" type="text" required="required" name="mec[fes_guest_name]" id="mec_guest_name" value="<?php echo esc_attr($guest_name); ?>" placeholder="<?php _e('eg. John Smith', 'mec'); ?>" />
                </div>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_guest_email"><?php _e('Contact Email', 'mec'); ?> <abbr title="required">*</abbr></label>
                    <input class="mec-col-7" type="email" required="required" name="mec[fes_guest_email]" id="mec_guest_email" value="<?php echo esc_attr($guest_email); ?>" placeholder="<?php _e('eg. yourname@gmail.com', 'mec'); ?>" />
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Links Section -->
            <?php if(!isset($this->settings['fes_section_event_links']) or (isset($this->settings['fes_section_event_links']) and $this->settings['fes_section_event_links'])): ?>
            <?php
                $read_more = get_post_meta($post_id, 'mec_read_more', true);
                $more_info = get_post_meta($post_id, 'mec_more_info', true);
                $more_info_title = get_post_meta($post_id, 'mec_more_info_title', true);
                $more_info_target = get_post_meta($post_id, 'mec_more_info_target', true);
            ?>
            <div class="mec-meta-box-fields" id="mec-event-links">
                <h4><?php _e('Event Link', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <label class="mec-col-2" for="mec_more_info_link"><?php echo $this->main->m('more_info_link', __('Link URL', 'mec')); ?></label>
                    <input class="mec-col-5" type="url" name="mec[more_info]" id="mec_more_info_link" value="<?php echo esc_attr($more_info); ?>" placeholder="<?php _e('https://', 'mec'); ?>" />
                    <label class="mec-col-2" for="mec_more_info_title"><?php _e('Link Text', 'mec'); ?></label>
                    <input class="mec-col-2" type="text" name="mec[more_info_title]" id="mec_more_info_title" value="<?php echo esc_attr($more_info_title); ?>" placeholder="<?php _e('RSVP', 'mec'); ?>" />
                    <input type="hidden" name="mec[more_info_target]" value="_blank">
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Cost Section -->
            <?php if(!isset($this->settings['fes_section_cost']) or (isset($this->settings['fes_section_cost']) and $this->settings['fes_section_cost'])): ?>
            <?php $cost = get_post_meta($post_id, 'mec_cost', true); ?>
            <div class="mec-meta-box-fields" id="mec-event-cost">
                <h4 id="mec_cost_label"><?php echo $this->main->m('event_cost', __('Event Cost', 'mec')); ?></h4>
                <div id="mec_meta_box_cost_form">
                    <div class="mec-form-row">
                        <input type="text" class="mec-col-6" name="mec[cost]" id="mec_cost" aria-labelledby="mec_cost_label" value="<?php echo esc_attr($cost); ?>" placeholder="<?php _e('Cost', 'mec'); ?>" />
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Featured Image Section -->
            <?php if(!isset($this->settings['fes_section_featured_image']) or (isset($this->settings['fes_section_featured_image']) and $this->settings['fes_section_featured_image'])): ?>
            <?php
                $attachment_id = get_post_thumbnail_id($post_id);
                $featured_image = wp_get_attachment_image_src($attachment_id, 'large');
                if(isset($featured_image[0])) $featured_image = $featured_image[0];
            ?>
            <div class="mec-meta-box-fields" id="mec-featured-image">
                <h4><?php _e('Event Image', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <div class="file-field input-field">
                      <div class="btn btn-small">
                        <span>File</span>
                        <input type="file" id="mec_featured_image_file" aria-label="Upload Image File" onchange="mec_fes_upload_featured_image();" />
                      </div>
                      <div class="file-path-wrapper">
                        <input readonly type="text" id="mec_fes_thumbnail" name="mec[featured_image]" value="<?php echo (trim($featured_image) ? $featured_image : ''); ?>" />
                      </div>
                    </div>
                    <span id="mec_fes_thumbnail_img"><?php echo (trim($featured_image) ? '<img src="'.$featured_image.'" />' : ''); ?></span>
                    <a id="mec_fes_remove_image_button" href="javascript:void(0)" class="<?php echo (trim($featured_image) ? '' : 'mec-util-hidden'); ?>"><?php _e('Remove Image', 'mec'); ?></a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Category Section -->
            <?php if(!isset($this->settings['fes_section_categories']) or (isset($this->settings['fes_section_categories']) and $this->settings['fes_section_categories'])): ?>
            <?php
                $post_categories = get_the_terms($post_id, 'mec_category');

                $categories = array();
                if($post_categories) foreach($post_categories as $post_category) $categories[] = $post_category->term_id;

                $category_terms = get_terms(array('taxonomy'=>'mec_category', 'hide_empty'=>false));
            ?>
            <?php if(count($category_terms)): ?>
            <div class="mec-meta-box-fields" id="mec-categories">
                <h4><?php echo $this->main->m('taxonomy_categories', __('Categories', 'mec')); ?></h4>
                <div class="mec-form-row">
                    <?php foreach($category_terms as $category_term): ?>
                    <label for="mec_fes_categories<?php echo $category_term->term_id; ?>">
                        <input type="checkbox" name="mec[categories][<?php echo $category_term->term_id; ?>]" id="mec_fes_categories<?php echo $category_term->term_id; ?>" value="1" <?php echo (in_array($category_term->term_id, $categories) ? 'checked="checked"' : ''); ?> />
                        <?php echo $category_term->name; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <!-- Event Label Section -->
            <?php
              $post_labels = get_the_terms($post_id, 'mec_label');

              $labels = array();
              if($post_labels) foreach($post_labels as $post_label) $labels[] = $post_label->term_id;

              $label_terms = get_terms(array('taxonomy'=>'mec_label', 'hide_empty'=>false));

              foreach($label_terms as $label_term):
                if ($label_term->slug == 'community') : ?>
                  <input type="hidden" name="mec[labels][<?php echo $label_term->term_id; ?>]" id="mec_fes_labels<?php echo $label_term->term_id; ?>" value="1" <?php echo (in_array($label_term->term_id, $labels) ? 'checked="checked"' : ''); ?> />
                  <?php
                endif;
              endforeach;
            ?>

            <?php if(!isset($this->settings['fes_section_labels']) or (isset($this->settings['fes_section_labels']) and $this->settings['fes_section_labels'])): ?>
            <?php
                $post_labels = get_the_terms($post_id, 'mec_label');

                $labels = array();
                if($post_labels) foreach($post_labels as $post_label) $labels[] = $post_label->term_id;

                $label_terms = get_terms(array('taxonomy'=>'mec_label', 'hide_empty'=>false));
            ?>
            <?php if(count($label_terms)): ?>
            <div class="mec-meta-box-fields" id="mec-labels">
                <h4><?php echo $this->main->m('taxonomy_labels', __('Labels', 'mec')); ?></h4>
                <div class="mec-form-row">
                    <?php foreach($label_terms as $label_term): ?>
                    <label for="mec_fes_labels<?php echo $label_term->term_id; ?>">
                        <input type="checkbox" name="mec[labels][<?php echo $label_term->term_id; ?>]" id="mec_fes_labels<?php echo $label_term->term_id; ?>" value="1" <?php echo (in_array($label_term->term_id, $labels) ? 'checked="checked"' : ''); ?> />
                        <?php echo $label_term->name; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <!-- Event Color Section -->
            <?php if(!isset($this->settings['fes_section_event_color']) or (isset($this->settings['fes_section_event_color']) and $this->settings['fes_section_event_color'])): ?>
            <?php
                $color = get_post_meta($post_id, 'mec_color', true);
                $available_colors = $this->main->get_available_colors();

                if(!trim($color)) $color = $available_colors[0];
            ?>
            <?php if(count($available_colors)): ?>
            <div class="mec-meta-box-fields" id="mec-event-color">
                <h4><?php _e('Event Color', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <div class="mec-form-row mec-available-color-row">
                        <input type="hidden" id="mec_event_color" name="mec[color]" value="#<?php echo $color; ?>" />
                        <?php foreach($available_colors as $available_color): ?>
                        <span class="mec-color <?php echo ($available_color == $color ? 'color-selected' : ''); ?>" onclick="mec_set_event_color('<?php echo $available_color; ?>');" style="background-color: #<?php echo $available_color; ?>"></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <!-- Event Tags Section -->
            <?php if(!isset($this->settings['fes_section_tags']) or (isset($this->settings['fes_section_tags']) and $this->settings['fes_section_tags'])): ?>
            <?php
                $post_tags = wp_get_post_tags($post_id);

                $tags = '';
                foreach($post_tags as $post_tag) $tags .= $post_tag->name.',';
            ?>
            <div class="mec-meta-box-fields" id="mec-tags">
                <h4><?php _e('Tags', 'mec'); ?></h4>
                <div class="mec-form-row">
                    <textarea name="mec[tags]" id="mec_fes_tags" placeholder="<?php esc_attr_e('Insert your desired tags, comma separated.', 'mec'); ?>"><?php echo (trim($tags) ? trim($tags, ', ') : ''); ?></textarea>
                </div>
            </div>
            <?php endif; ?>

            <!-- Event Speakers Section -->
            <?php if((isset($this->settings['speakers_status']) and $this->settings['speakers_status']) and isset($this->settings['fes_section_speaker']) and $this->settings['fes_section_speaker']): ?>
                <?php
                $post_speakers = get_the_terms($post_id, 'mec_speaker');

                $speakers = array();
                if($post_speakers) foreach($post_speakers as $post_speaker)
                {
                    if(!isset($post_speaker->term_id)) continue;
                    $speakers[] = $post_speaker->term_id;
                }

                $speaker_terms = get_terms(array('taxonomy'=>'mec_speaker', 'hide_empty'=>false));
                ?>
                <?php if(count($speaker_terms)): ?>
                    <div class="mec-meta-box-fields" id="mec-speakers">
                        <h4><?php echo $this->main->m('taxonomy_speakers', __('Speakers', 'mec')); ?></h4>
                        <div class="mec-form-row">
                            <?php foreach($speaker_terms as $speaker_term): ?>
                                <label for="mec_fes_speakers<?php echo $speaker_term->term_id; ?>">
                                    <input type="checkbox" name="mec[speakers][<?php echo $speaker_term->term_id; ?>]" id="mec_fes_speakers<?php echo $speaker_term->term_id; ?>" value="1" <?php echo (in_array($speaker_term->term_id, $speakers) ? 'checked="checked"' : ''); ?> />
                                    <?php echo $speaker_term->name; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="mec-form-row mec-fes-submit-wide">
            <?php if($this->main->get_recaptcha_status('fes')): ?><div class="mec-form-row mec-google-recaptcha"><div class="g-recaptcha" data-sitekey="<?php echo $this->settings['google_recaptcha_sitekey']; ?>"></div></div><?php endif; ?>
            <button class="mec-fes-sub-button" type="submit"><?php _e('Submit', 'mec'); ?></button>
            <div class="mec-util-hidden">
                <input type="hidden" name="mec[post_id]" value="<?php echo $post_id; ?>" id="mec_fes_post_id" class="mec-fes-post-id" />
                <input type="hidden" name="action" value="mec_fes_form" />
                <?php wp_nonce_field('mec_fes_form'); ?>
            </div>
        </div>
        <div class="mec-util-hidden" id="mec_fes_form_message"></div>
    </form>
</div>
