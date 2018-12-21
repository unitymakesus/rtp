<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  $tech_url = empty($tech_url)?'{{tech_url}}':esc_url_raw($tech_url);
  $tech_device = empty($tech_device)?'{{tech_device}}':esc_html($tech_device);
  $tech_os = empty($tech_os)?'{{tech_os}}':esc_html($tech_os);
  $tech_browser = empty($tech_browser)?'{{tech_browser}}':esc_html($tech_browser);
?>
<li>
  <div class="prli-sub-box prli-tech-row">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Device:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-tech-redirects-device',
                    __('Technology Redirection Device', 'pretty-link'),
                    __('<b>Desktop</b> will match on any conventional laptop or desktop computer.<br/><br/><b>Mobile</b> will match on any phone, tablet or other portable device.<br/><br/><b>Phone</b> will match on any phone or similarly small device.<br/><br/><b>Tablet</b> will match on any tablet sized device.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <select name="prli_tech_device[]" class="prli_tech_device">
              <option value="any" <?php selected($tech_device,'any'); ?>><?php _e('Any'); ?></option>
              <option value="desktop" <?php selected($tech_device,'desktop'); ?>><?php _e('Desktop'); ?></option>
              <option value="mobile" <?php selected($tech_device,'mobile'); ?>><?php _e('Mobile'); ?></option>
              <option value="phone" <?php selected($tech_device,'phone'); ?>><?php _e('Phone'); ?></option>
              <option value="tablet" <?php selected($tech_device,'tablet'); ?>><?php _e('Tablet'); ?></option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('Operating System:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-tech-redirects-os',
                    __('Technology Redirection OS', 'pretty-link'),
                    __('Use this dropdown to select which Operating System this redirect will match on.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <select name="prli_tech_os[]" class="prli_tech_os">
              <option value="any" <?php selected($tech_os,'any'); ?>><?php _e('Any'); ?></option>
              <option value="android" <?php selected($tech_os,'android'); ?>><?php _e('Android'); ?></option>
              <option value="ios" <?php selected($tech_os,'ios'); ?>><?php _e('iOS'); ?></option>
              <option value="linux" <?php selected($tech_os,'linux'); ?>><?php _e('Linux'); ?></option>
              <option value="macosx" <?php selected($tech_os,'macosx'); ?>><?php _e('Mac'); ?></option>
              <option value="win" <?php selected($tech_os,'win'); ?>><?php _e('Windows'); ?></option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('Browser:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-tech-redirects-browser',
                    __('Technology Redirection Browser', 'pretty-link'),
                    __('Use this dropdown to select which Browser this redirect will match on.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <select name="prli_tech_browser[]" class="prli_tech_browser">
              <option value="any" <?php selected($tech_browser,'any'); ?>><?php _e('Any'); ?></option>
              <option value="silk" <?php selected($tech_browser,'silk'); ?>><?php _e('Amazon Silk'); ?></option>
              <option value="android" <?php selected($tech_browser,'android'); ?>><?php _e('Android'); ?></option>
              <option value="chrome" <?php selected($tech_browser,'chrome'); ?>><?php _e('Chrome'); ?></option>
              <option value="chromium" <?php selected($tech_browser,'chromium'); ?>><?php _e('Chromium'); ?></option>
              <option value="edge" <?php selected($tech_browser,'edge'); ?>><?php _e('Edge'); ?></option>
              <option value="firefox" <?php selected($tech_browser,'firefox'); ?>><?php _e('Firefox'); ?></option>
              <option value="ie" <?php selected($tech_browser,'ie'); ?>><?php _e('Internet Explorer'); ?></option>
              <option value="kindle" <?php selected($tech_browser,'kindle'); ?>><?php _e('Kindle'); ?></option>
              <option value="opera" <?php selected($tech_browser,'opera'); ?>><?php _e('Opera'); ?></option>
              <option value="coast" <?php selected($tech_browser,'coast'); ?>><?php _e('Opera Coast'); ?></option>
              <option value="safari" <?php selected($tech_browser,'safari'); ?>><?php _e('Safari'); ?></option>
            </select>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('URL:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-tech-redirects-url',
                    __('Technology Redirection URL', 'pretty-link'),
                    __('This is the URL that this Pretty Link will redirect to if the visitor\'s device, os and browser match the settings here.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_tech_url[]" class="prli_tech_url large-text" value="<?php echo $tech_url; ?>" />
          </td>
        </tr>
      </tbody>
    </table>
    <div><a href="" class="prli_tech_row_remove"><?php _e('Remove'); ?></a></div>
  </div>
</li>


