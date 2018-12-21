<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  $time_url = empty($time_url)?'{{time_url}}':esc_url_raw($time_url);
  $time_start = empty($time_start)?'{{time_start}}':esc_html($time_start);
  $time_end = empty($time_end)?'{{time_end}}':esc_html($time_end);
?>
<li>
  <div class="prli-sub-box prli-time-row">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Start Time:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-start-time-redirects-period',
                    __('Start of Time Period', 'pretty-link'),
                    __('This is where you\'ll enter the beginning of the time period for this redirect', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_time_start[]" class="prli_time_start prli-date-picker regular-text" value="<?php echo $time_start; ?>" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('End Time:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-end-time-redirects-period',
                    __('End of Time Period', 'pretty-link'),
                    __('This is where you\'ll enter the end of the time period for this redirect', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_time_end[]" class="prli_time_end prli-date-picker regular-text" value="<?php echo $time_end; ?>" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('URL:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-time-redirects-url',
                    __('Time Period Redirect URL', 'pretty-link'),
                    __('This is the URL that this Pretty Link will redirect to when the visitor visits the link in the associated time period.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_time_url[]" class="prli_time_url large-text" value="<?php echo $time_url; ?>" />
          </td>
        </tr>
      </tbody>
    </table>
    <div><a href="" class="prli_time_row_remove"><?php _e('Remove'); ?></a></div>
  </div>
</li>


