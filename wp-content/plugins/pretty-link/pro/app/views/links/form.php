<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<table class="form-table">
  <tbody>
    <tr>
      <th scope="row">
        <?php _e('Expire', 'pretty-link'); ?>
        <?php PrliAppHelper::info_tooltip(
                'plp-expire',
                __('Expire Link', 'pretty-link'),
                __('Set this link to expire after a specific date or number of clicks.', 'pretty-link')
              ); ?>
      </th>
      <td>
        <input class="prli-toggle-checkbox" data-box="plp-expire" type="checkbox" name="enable_expire" <?php checked($enable_expire != 0); ?> />
      </td>
    </tr>
  </tbody>
</table>
<div class="prli-sub-box-white plp-expire">
  <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <?php _e('Expire After'); ?>
          <?php PrliAppHelper::info_tooltip(
                  'plp-expire-type',
                  __('Expiration Type', 'pretty-link'),
                  __('Select the type of expiration you want for this link.<br/><br/><b>Date</b> Select this option if you\'d like to expire your link after a certain date.<br/><br/><b>Clicks</b>: Select this option to expire this link after it has been clicked a specific number of times.')
                ); ?>
        </th>
        <td>
          <select id="plp_expire_type" name="expire_type" class="prli-toggle-select" data-date-box="plp-date-expire" data-clicks-box="plp-clicks-expire">
            <option value="date" <?php selected($expire_type, 'date'); ?>><?php _e('Date'); ?></option>
            <option value="clicks" <?php selected($expire_type, 'clicks'); ?>><?php _e('Clicks'); ?></option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="prli-sub-box plp-clicks-expire">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Clicks', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'plp-clicks-expire',
                    __('Number of Clicks', 'pretty-link'),
                    __('Enter the number of times this link can be clicked before it expires.<br/><br/><b>Note: Expirations based on clicks wouldn\'t work properly if you had tracking turned off for this link so as long as this is set to Clicks, Pretty Link will ensure tracking is turned on for this link as well.</b>', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="number" name="expire_clicks" class="small-text" value="<?php echo esc_html($expire_clicks); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="prli-sub-box plp-date-expire">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Date', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'plp-expire-date',
                    __('Expiration Date', 'pretty-link'),
                    __('Enter a date here in the format YYYY-MM-DD to set when this link should expire.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" class="prli-date-picker regular-text" name="expire_date" value="<?php echo esc_html($expire_date); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>


  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <?php _e('Expired Redirect', 'pretty-link'); ?>
          <?php PrliAppHelper::info_tooltip(
                  'plp-enable-expired-url',
                  __('Redirect to URL when Expired', 'pretty-link'),
                  __('When this link expires, do you want to redirect to a specific URL. You can use this to redirect to a page you\'ve setup to indicate that the link is expired.<br/><br/><b>Note: If this is not set the link will throw a 404 error when expired</b>.', 'pretty-link')
                ); ?>
        </th>
        <td>
          <input class="prli-toggle-checkbox" data-box="plp-expired-url" type="checkbox" name="enable_expired_url" <?php checked($enable_expired_url != 0); ?> />
        </td>
      </tr>
    </tbody>
  </table>
  <div class="prli-sub-box plp-expired-url">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('URL', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'plp-expired-url',
                    __('Expired URL', 'pretty-link'),
                    __('This is the URL that this link will redirect to after the expiration date above.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="expired_url" class="large-text" value="<?php echo esc_html($expired_url); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php if( $plp_options->keyword_replacement_is_on ): ?>
<table class="form-table">
  <tbody>
    <tr>
      <th scope="row">
        <?php _e('Keywords', 'pretty-link'); ?>
        <?php PrliAppHelper::info_tooltip(
                'prli-link-pro-options-keywords',
                __('Auto-Replace Keywords', 'pretty-link'),
                __('Enter a comma separated list of keywords / keyword phrases that you\'d like to replace with this link in your Posts &amp; Pages.', 'pretty-link')); ?>
      </th>
      <td>
        <input type="text" name="keywords" class="large-text" value="<?php echo esc_html($keywords); ?>" />
      </td>
    </tr>
    <tr>
      <th scope="row">
        <?php _e('URL Replacements', 'pretty-link'); ?>
        <?php PrliAppHelper::info_tooltip(
                'prli-link-pro-options-url-replacements',
                __('Auto-Replace URLs', 'pretty-link'),
                __('Enter a comma separated list of the URLs that you\'d like to replace with this Pretty Link in your Posts &amp; Pages. These must be formatted as URLs for example: <code>http://example.com</code> or <code>http://example.com?product_id=53</code>', 'pretty-link')
              ); ?>
      </th>
      <td>
        <input type="text" name="url_replacements" class="large-text" value="<?php echo esc_html($url_replacements); ?>" />
      </td>
    </tr>
  </tbody>
</table>
<?php endif; ?>

<table class="form-table">
  <tbody>
    <tr>
      <th scope="row">
        <?php _e('Head Scripts', 'pretty-link'); ?>
        <?php PrliAppHelper::info_tooltip(
                'prli-link-pro-options-head-scripts',
                __('Head Scripts', 'pretty-link'),
                __("Useful for adding Google Analytics tracking, Facebook retargeting pixels, or any other kind of tracking script to the HTML head for this pretty link.<br/><br/>These scripts will be in addition to any global one's you've defined in the options.<br/><br/><b>NOTE:</b> This does NOT work with 301, 302 and 307 type redirects.", 'pretty-link')); ?>
      </th>
      <td>
        <textarea name="head-scripts" class="large-text"><?php echo stripslashes($head_scripts); ?></textarea>
      </td>
    </tr>
  </tbody>
</table>

<table class="form-table">
  <tbody>
    <tr>
      <th scope="row">
        <?php _e('Dynamic Redirection'); ?>
        <?php PrliAppHelper::info_tooltip(
                'prli-link-pro-options-dynamic-redirection-options',
                __('Dynamic Redirection Options', 'pretty-link'),
                __('These powerful options are available to give you dynamic control over redirection for this pretty link.')
              ); ?>
      </th>
      <td>
        <select id="plp_dynamic_redirection" name="dynamic_redirection" class="prli-toggle-select" data-rotate-box="prli-link-rotate" data-geo-box="prli-link-geo" data-tech-box="prli-link-tech" data-time-box="prli-link-time">
          <option value="none" <?php selected($dynamic_redirection, 'none'); ?>><?php _e('None'); ?></option>
          <option value="rotate" <?php selected($dynamic_redirection, 'rotate'); ?>><?php _e('Rotation'); ?></option>
          <option value="geo" <?php selected($dynamic_redirection, 'geo'); ?>><?php _e('Geographic'); ?></option>
          <option value="tech" <?php selected($dynamic_redirection, 'tech'); ?>><?php _e('Technology'); ?></option>
          <option value="time" <?php selected($dynamic_redirection, 'time'); ?>><?php _e('Time'); ?></option>
        </select>
      </td>
    </tr>
  </tbody>
</table>

<div class="prli-sub-box-white prli-link-rotate">
  <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
  <h3>
    <?php _e('Target URL Rotations', 'pretty-link'); ?>
    <?php PrliAppHelper::info_tooltip(
            'prli-link-pro-target-url-rotations',
            __('Target URL Rotations', 'pretty-link'),
            __('Enter the Target URLs that you\'d like to rotate through when this Pretty Link is Clicked. These must be formatted as URLs example: <code>http://example.com</code> or <code>http://example.com?product_id=53</code>', 'pretty-link')
          ); ?>
  </h3>
  <ol id="prli_link_rotations">
    <li>
      <input readonly="true" type="text" class="regular-text" value="<?php echo (!empty($target_url)?esc_html($target_url):__('Target URL (above)')); ?>" />
      <?php _e('weight:', 'pretty-link'); ?>
      <?php PlpLinksHelper::rotation_weight_dropdown((($target_url_weight == 0 || !empty($target_url_weight))?$target_url_weight:'100'),'target_url_weight'); ?>
    </li>
    <?php
      for($i=0;$i<count($url_rotations);$i++) {
        $rotation = ((isset($url_rotations[$i]) && !empty($url_rotations[$i]))?esc_html($url_rotations[$i]):'');
        $weight   = (isset($url_rotation_weights[$i])?$url_rotation_weights[$i]:0);
        PlpLinksHelper::rotation_row($rotation, $weight, 'url_rotations[]', 'url_rotation_weights[]');
      }
    ?>
  </ol>
  <div><a id="prli_add_link_rotation" href=""><?php _e('Add Link Rotation'); ?></a></div>

  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <?php _e('Split Test', 'pretty-link'); ?>
          <?php PrliAppHelper::info_tooltip(
                  'prli-link-pro-split-test',
                  __('Split Test This Link', 'pretty-link'),
                  __('Split testing will enable you to track the effectiveness of several links against each other. This works best when you have multiple link rotation URLs entered.', 'pretty-link')
                ); ?>
        </th>
        <td>
          <input class="prli-toggle-checkbox" data-box="prlipro-split-test-goal-link" type="checkbox" name="enable_split_test" <?php checked($enable_split_test != 0); ?> />
        </td>
      </tr>
    </tbody>
  </table>

  <div class="prli-sub-box prlipro-split-test-goal-link">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Goal Link', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-split-test-goal-link',
                    __('Goal Link for Split Test', 'pretty-link'),
                    __('This is the goal link for your split test.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <select name="split_test_goal_link">
              <?php
              for($i = 0; $i < count($links); $i++) {
                $link = $links[$i];
                ?>
                <option value="<?php echo $link->id; ?>" <?php selected($split_test_goal_link == $link->id); ?>>
                  <?php printf(
                    __('id: %1$s | slug: %3$s | name: %2$s%4$s'),
                    $link->id,
                    substr(stripslashes($link->name),0,25),
                    $link->slug,
                    (!empty($link->group_name) ? sprintf(' | group: %s', substr(stripslashes($link->group_name),0,25)) : '')
                  ); ?>
                </option>
                <?php
              }
              ?>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="prli-sub-box-white prli-link-geo">
  <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
  <h3>
    <?php _e('Geographic Redirects', 'pretty-link'); ?>
    <?php PrliAppHelper::info_tooltip(
            'prli-link-pro-geo-redirects',
            __('Geographic Redirects', 'pretty-link'),
            __('This will enable you to setup specific target urls that this pretty link will redirect to based on the country of the person visiting the url.', 'pretty-link')
          ); ?>
  </h3>
  <ul class="prli_geo_rows">
  </ul>
  <div><a href="" class="prli_geo_row_add"><?php _e('Add'); ?></a></div>
</div>
<div class="prli-sub-box-white prli-link-tech">
  <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
  <h3>
    <?php _e('Technology Redirects', 'pretty-link'); ?>
    <?php PrliAppHelper::info_tooltip(
            'prli-link-pro-tech-redirects',
            __('Technology Redirects', 'pretty-link'),
            __('This will allow you to redirect based on your visitor\'s device, operating system and/or browser', 'pretty-link')
          ); ?>
  </h3>
  <ul class="prli_tech_rows">
  </ul>
  <div><a href="" class="prli_tech_row_add"><?php _e('Add'); ?></a></div>
</div>
<div class="prli-sub-box-white prli-link-time">
  <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
  <h3>
    <?php _e('Time Period Redirects', 'pretty-link'); ?>
    <?php PrliAppHelper::info_tooltip(
            'prli-link-pro-time-redirects',
            __('Time Period Redirects', 'pretty-link'),
            __('This will allow you to redirect based on the time period in which your visitor visits this link.<br/><br/><b>Note: If your visitor doesn\'t visit the link during any of the specified time periods set here, they\'ll simply be redirected to the main target url.</b>', 'pretty-link')
          ); ?>
  </h3>
  <ul class="prli_time_rows">
  </ul>
  <div><a href="" class="prli_time_row_add"><?php _e('Add'); ?></a></div>
</div>

