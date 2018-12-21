<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  $geo_url = empty($geo_url)?'{{geo_url}}':esc_url_raw($geo_url);
  $geo_countries = empty($geo_countries)?'{{geo_countries}}':esc_html($geo_countries);
?>
<li>
  <div class="prli-sub-box prli-geo-row">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <?php _e('Countries:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-geo-redirects-countries',
                    __('Technology Redirection Countries', 'pretty-link'),
                    __('This is a comma-separated list of countries that this redirect will match on. Just start typing a country\'s name and an autocomplete dropdown will appear to select from. Once a country is selected, feel free to start typing the name of another country. You can add as many as you\'d like this redirect to match on', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_geo_countries[]" class="prli_geo_countries large-text" value="<?php echo $geo_countries; ?>" autocomplete="off"/>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <?php _e('URL:'); ?>
            <?php PrliAppHelper::info_tooltip(
                    'prli-link-pro-geo-redirects-url',
                    __('Geographic Redirection URL', 'pretty-link'),
                    __('This is the URL that this Pretty Link will redirect to if the visitor\'s country match the settings here.', 'pretty-link')
                  ); ?>
          </th>
          <td>
            <input type="text" name="prli_geo_url[]" class="prli_geo_url large-text" value="<?php echo $geo_url; ?>" />
          </td>
        </tr>
      </tbody>
    </table>
    <div><a href="" class="prli_geo_row_remove"><?php _e('Remove'); ?></a></div>
  </div>
</li>

