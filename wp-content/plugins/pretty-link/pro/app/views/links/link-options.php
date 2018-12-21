<tr valign="top">
  <th scope="row">
    <label for="<?php echo $plp_options->base_slug_prefix_str; ?>"><?php _e('Base Slug Prefix'); ?></label>
    <?php PrliAppHelper::info_tooltip('prli-base-slug-prefix',
                                      __('Base Slug Prefix', 'pretty-link'),
                                      __("Use this to prefix all newly generated pretty links with a directory of your choice. For example set to <b>out</b> to make your pretty links look like http://site.com/<b>out</b>/xyz. Changing this option will NOT affect existing pretty links. If you do not wish to use a directory prefix, leave this text field blank. Whatever you type here will be sanitized and modified to ensure it is URL-safe. So <b>Hello World</b> might get changed to something like <b>hello-world</b> instead. Lowercase letters, numbers, dashes, and underscores are allowed.", 'pretty-link'));
    ?>
  </th>
  <td>
    <input type="text" name="<?php echo $plp_options->base_slug_prefix_str; ?>" class="regular-text" value="<?php echo stripslashes($plp_options->base_slug_prefix); ?>" />
  </td>
</tr>

<tr valign="top">
  <th scope="row">
    <label for="<?php echo $plp_options->num_slug_chars_str; ?>"><?php _e('Slug Character Count'); ?></label>
    <?php PrliAppHelper::info_tooltip('prli-num-slug-chars',
                                      __('Slug Character Count', 'pretty-link'),
                                      __("The number of characters to use when auto-generating a random slug for pretty links. The default is 4. You cannot use less than 2.", 'pretty-link'));
    ?>
  </th>
  <td>
    <input type="number" min="2" name="<?php echo $plp_options->num_slug_chars_str; ?>" value="<?php echo stripslashes($plp_options->num_slug_chars); ?>" />
  </td>
</tr>

<tr valign="top">
  <th scope="row">
    <label for="<?php echo $plp_options->google_tracking_str; ?>"><?php _e('Enable Google Analytics', 'pretty-link') ?></label>
    <?php PrliAppHelper::info_tooltip('prli-options-use-ga', __('Enable Google Analytics', 'pretty-link'),
                                      __("Requires Google Analyticator, Google Analytics by MonsterInsights (formerly Yoast), or the Google Analytics Plugin to be installed and configured on your site.", 'pretty-link'));
    ?>
  </th>
  <td>
    <input type="checkbox" name="<?php echo $plp_options->google_tracking_str; ?>" id="<?php echo $plp_options->google_tracking_str; ?>" <?php checked($plp_options->google_tracking); ?>/>
  </td>
</tr>

<tr valign="top">
  <th scope="row">
    <label for="<?php echo $plp_options->generate_qr_codes_str; ?>"><?php printf(__('Enable %sQR Codes%s', 'pretty-link'), '<a href="http://en.wikipedia.org/wiki/QR_code">', '</a>'); ?></label>
    <?php PrliAppHelper::info_tooltip('prli-options-generate-qr-codes',
                                      __('Generate QR Codes', 'pretty-link'),
                                      __("This will enable a link in your pretty link admin that will allow you to automatically download a QR Code for each individual Pretty Link.", 'pretty-link'));
    ?>
  </th>
  <td>
    <input type="checkbox" name="<?php echo $plp_options->generate_qr_codes_str; ?>" id="<?php echo $plp_options->generate_qr_codes_str; ?>" <?php checked($plp_options->generate_qr_codes); ?>/>
  </td>
</tr>

<tr valign="top">
  <th scope="row">
    <label for="<?php echo $plp_options->global_head_scripts_str; ?>"><?php _e('Global Head Scripts'); ?></label>
    <?php PrliAppHelper::info_tooltip('prli-options-global-head-scripts',
                                      __('Global Head Scripts', 'pretty-link'),
                                      __("Useful for adding Google Analytics tracking, Facebook retargeting pixels, or any other kind of tracking script to the HTML head.<br/><br/>What you enter in this box will be applied to all supported pretty links.<br/><br/><b>NOTE:</b> This does NOT work with 301, 302 and 307 type redirects.", 'pretty-link'));
    ?>
  </th>
  <td>
    <textarea name="<?php echo $plp_options->global_head_scripts_str; ?>" id="<?php echo $plp_options->global_head_scripts_str; ?>" class="large-text"><?php echo stripslashes($plp_options->global_head_scripts); ?></textarea>
  </td>
</tr>

