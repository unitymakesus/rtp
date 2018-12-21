<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<div class="prli-page" id="replacements">
  <div class="prli-page-title"><?php _e('Keyword &amp; URL Auto Replacements Options'); ?></div>

  <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y" />

  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $keyword_replacement_is_on; ?>">
            <?php _e('Enable Replacements', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-keyword-replacement',
                                              __('Enable Keyword and URL Auto Replacement', 'pretty-link'),
                                              __('If checked, this will enable you to automatically replace keywords and/or URLs on your blog with pretty links. You will specify the specific keywords and urls from your Pretty Link edit page.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input class="prli-toggle-checkbox" data-box="pretty-link-keyword-replacement-options" type="checkbox" name="<?php echo $keyword_replacement_is_on; ?>" <?php checked($plp_options->keyword_replacement_is_on != 0); ?>/>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="prli-sub-box pretty-link-keyword-replacement-options">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $set_keyword_thresholds; ?>">
              <?php _e('Thresholds', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-keyword-replacement-thresholds',
                                                __('Set Keyword Replacement Thresholds', 'pretty-link'),
                                                __('Don\'t want to have too many keyword replacements per page? Select to set some reasonable keyword replacement thresholds.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input class="prli-toggle-checkbox" data-box="prli-set-replacement-thresholds" type="checkbox" name="<?php echo $set_keyword_thresholds; ?>" <?php checked($plp_options->set_keyword_thresholds != 0); ?>/>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="prli-sub-box-white prli-set-replacement-thresholds">
      <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="<?php echo $keywords_per_page; ?>">
                <?php echo __('Max Keywords', 'pretty-link'); ?>
                <?php PrliAppHelper::info_tooltip('prli-max-keywords',
                                                  __('Set Maximum Keywords per Page', 'pretty-link'),
                                                  __('Maximum number of unique keyword / keyphrases you can replace with Pretty Links per page.', 'pretty-link'));
                ?>
              </label>
            </th>
            <td>
              <input type="number" min="0" name="<?php echo $keywords_per_page; ?>" value="<?php echo $plp_options->keywords_per_page; ?>" />
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="<?php echo $keyword_links_per_page; ?>">
                <?php echo __('Max Replacements', 'pretty-link'); ?>
                <?php PrliAppHelper::info_tooltip('prli-max-replacements',
                                                  __('Set Maximum Replacements per Keyword', 'pretty-link'),
                                                  __('Maximum number of Pretty Link replacements per Keyword / Keyphrase.', 'pretty-link'));
                ?>
              </label>
            </th>
            <td>
              <input type="number" min="0" name="<?php echo $keyword_links_per_page; ?>" value="<?php echo $plp_options->keyword_links_per_page; ?>" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $keyword_links_open_new_window; ?>">
              <?php _e('Open in New Window', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-keyword-replacement-thresholds',
                                                __('Open Keyword Replacement Links in New Window', 'pretty-link'),
                                                __('Ensure that these keyword replacement links are opened in a separate window. <strong>Note:</strong> This does not apply to url replacements--only keyword replacements.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" name="<?php echo $keyword_links_open_new_window; ?>" <?php checked($plp_options->keyword_links_open_new_window != 0); ?>/>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $keyword_links_nofollow; ?>">
              <?php _e('Add No Follows', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-keyword-links-nofollow',
                                                __('Add \'nofollow\' attribute to all Keyword Pretty Links', 'pretty-link'),
                                                __('This adds the html <code>NOFOLLOW</code> attribute to all keyword replacement links. <strong>Note:</strong> This does not apply to url replacements--only keyword replacements.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" name="<?php echo $keyword_links_nofollow; ?>" <?php checked($plp_options->keyword_links_nofollow != 0); ?>/>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $keyword_link_custom_css; ?>">
              <?php _e('Custom CSS', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-keyword-custom-css',
                                                __('Add custom CSS to your keyword replacement links', 'pretty-link'),
                                                __('Add some custom formatting to your keyword pretty link replacements. <strong>Note:</strong> This does not apply to url replacements--only keyword replacements.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="text" class="regular-text" name="<?php echo $keyword_link_custom_css; ?>" value="<?php echo $plp_options->keyword_link_custom_css; ?>" />
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $keyword_link_hover_custom_css; ?>">
              <?php _e('Custom Hover CSS', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-keyword-custom-hover-css',
                                                __('Add custom hover CSS to your keyword replacement links', 'pretty-link'),
                                                __('Add some custom formatting to the hover attribute of your keyword pretty links. <strong>Note:</strong> This does not apply to url replacements--only keyword replacements.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="text" class="regular-text" name="<?php echo $keyword_link_hover_custom_css; ?>" value="<?php echo $plp_options->keyword_link_hover_custom_css; ?>" />
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $enable_link_to_disclosures; ?>">
              <?php _e('Link to Disclosures', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip(
                'prlipro-link-to-disclosures',
                __('Automatically Add a Link to Disclosures', 'pretty-link'),
                __('When enabled, this will add a link to your official affiliate link disclosure page to any page, post or custom post type that have any keyword or URL replacements. You\'ll also be able to customize the URL and position of the disclosure link.', 'pretty-link')
              );
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" class="prli-toggle-checkbox" data-box="prlipro-link-to-disclosures-page" name="<?php echo $enable_link_to_disclosures; ?>" <?php checked($plp_options->enable_link_to_disclosures != 0); ?> />
          </td>
        </tr>
        <tr valign="top" class="prlipro-link-to-disclosures-page">
          <td colspan="2">
            <div class="prli-sub-box-white" style="display: block;">
              <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
              <table class="form-table">
                <tbody>
                  <tr valign="top">
                    <th scope="row">
                      <label for="<?php echo $disclosures_link_url; ?>">
                        <?php _e('URL', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip(
                          'prlipro-disclosures-url',
                          __('Disclosures Link URL', 'pretty-link'),
                          __('This is the URL of the page that contains your official affiliate link disclosures. This URL will be used in the link that will be generated.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <input type="text" name="<?php echo $disclosures_link_url; ?>" class="regular-text" value="<?php echo stripslashes($plp_options->disclosures_link_url); ?>" />
                    </td>
                  </tr>
                  <tr valign="top">
                    <th scope="row">
                      <label for="<?php echo $disclosures_link_text; ?>">
                        <?php _e('Text', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip(
                          'prlipro-disclosures-link-text',
                          __('Disclosures Link Text', 'pretty-link'),
                          __('This is the text of the link to your disclosures. This text will be visible to your visitors when the link is displayed.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <input type="text" name="<?php echo $disclosures_link_text; ?>" class="regular-text" value="<?php echo stripslashes($plp_options->disclosures_link_text); ?>" />
                    </td>
                  </tr>
                  <tr valign="top">
                    <th scope="row">
                      <label for="<?php echo $disclosures_link_position; ?>">
                        <?php _e('Position', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip(
                          'prlipro-disclosures-link-position',
                          __('Disclosures Link Position', 'pretty-link'),
                          __('This is the position of the link to your disclosures in relation to your post content.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <select name="<?php echo $disclosures_link_position; ?>">
                        <option value="bottom" <?php selected('bottom',$plp_options->disclosures_link_position); ?>><?php _e('Bottom'); ?></option>
                        <option value="top" <?php selected('top',$plp_options->disclosures_link_position); ?>><?php _e('Top'); ?></option>
                        <option value="top_and_bottom" <?php selected('top_and_bottom',$plp_options->disclosures_link_position); ?>><?php _e('Top and Bottom'); ?></option>
                      </select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $enable_keyword_link_disclosures; ?>">
              <?php _e('Keyword Disclosures', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip(
                'prlipro-enable-keyword-link-disclosures',
                __('Automatically Add Affiliate Link Disclosures to Keyword Replacements', 'pretty-link'),
                __('When enabled, this will add an affiliate link disclosure next to each one of your keyword replacements. <b>Note:</b> This does not apply to url replacements--only keyword replacements.', 'pretty-link')
              );
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" class="prli-toggle-checkbox" data-box="prlipro-keyword-link-disclosure-page" name="<?php echo $enable_keyword_link_disclosures; ?>" <?php checked($plp_options->enable_keyword_link_disclosures != 0); ?> />
          </td>
        </tr>
        <tr valign="top" class="prlipro-keyword-link-disclosure-page">
          <td colspan="2">
            <div class="prli-sub-box-white" style="display: block;">
              <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
              <table class="form-table">
                <tbody>
                  <tr valign="top">
                    <th scope="row">
                      <label for="<?php echo $keyword_link_disclosure; ?>">
                        <?php _e('Disclosure Text', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip(
                          'prlipro-keyword-link-disclosure',
                          __('Keyword Link Disclosure Text', 'pretty-link'),
                          __('This is the text that will be added after each keyword replacement to indicate that the link is an affiliate link.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <input type="text" name="<?php echo $keyword_link_disclosure; ?>" class="regular-text" value="<?php echo stripslashes($plp_options->keyword_link_disclosure); ?>" />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $replace_urls_with_pretty_links; ?>">
              <?php _e('Replace All URLs', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-replace-urls',
                                                __('Replace All non-Pretty Link URLs With Pretty Link URLs', 'pretty-link'),
                                                __('This feature will take each url it finds and create or use an existing pretty link pointing to the url and replace it with the pretty link.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" class="prli-toggle-checkbox" data-box="prlipro-replace-all-urls-blacklist-page" name="<?php echo $replace_urls_with_pretty_links; ?>" <?php checked($plp_options->replace_urls_with_pretty_links != 0); ?> />
          </td>
        </tr>
        <tr valign="top" class="prlipro-replace-all-urls-blacklist-page">
          <td colspan="2">
            <div class="prli-sub-box-white" style="display: block;">
              <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
              <table class="form-table">
                <tbody>
                  <tr valign="top">
                    <th scope="row">
                      <label for="<?php echo $replace_urls_with_pretty_links_blacklist; ?>">
                        <?php _e('Domain Blacklist', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip('prli-replace-urls-blacklist',
                                                          __('Do not replace links from these domains', 'pretty-link'),
                                                          __("Any links on your site which point to domains you define here will not be replaced automatically with Pretty Links. Place one domain per line.<br/><br/>You MUST enter http:// or https:// in front of the domain names and do NOT include any /'s or other text after the domain name.<br/><br/>Proper entry example:<br/><b>https://www.google.com</b><br/><b>http://mysite.org</b><br/><br/>Improperly entered domains will be removed upon saving the Options.", 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <textarea name="<?php echo $replace_urls_with_pretty_links_blacklist; ?>" class="large-text" rows="5"><?php echo stripslashes($plp_options->replace_urls_with_pretty_links_blacklist); ?></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $replace_keywords_in_comments; ?>">
              <?php _e('Replace in Comments', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-replace-in-comments',
                                                __('Replace Keywords and URLs in Comments', 'pretty-link'),
                                                __('This option will enable the keyword / URL replacement routine to run in Comments.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" name="<?php echo $replace_keywords_in_comments; ?>" <?php checked($plp_options->replace_keywords_in_comments != 0); ?>/>
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="<?php echo $replace_keywords_in_feeds; ?>">
              <?php _e('Replace in Feeds', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-replace-in-feeds',
                                                __('Replace Keywords and URLs in Feeds', 'pretty-link'),
                                                __('This option will enable the keyword / URL replacement routine to run in RSS Feeds.<br/><strong>Note:</strong> This option can slow the load speed of your RSS feed -- unless used in conjunction with a caching plugin like W3 Total Cache or WP Super Cache.<br/><strong>Note #2</strong> This option will only work if you have "Full Text" selected in your General WordPress Reading settings.<br/><strong>Note #3:</strong> If this option is used along with "Replace Keywords and URLs in Comments" then your post comment feeds will have keywords replaced in them as well.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" name="<?php echo $replace_keywords_in_feeds; ?>" <?php checked($plp_options->replace_keywords_in_feeds != 0); ?>/>
          </td>
        </tr>
        <tr valign="top">
          <th valign="row">
            <label for="plp_index_keywords">
              <?php _e('Index Replacements', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('plp-index-keywords',
                __('Index Replacements', 'pretty-link'),
                __('This feature will index all of your keyword & URL replacements to dramatically improve performance.<br/><br/>If your site has a large number of replacements and/or posts then this feature may increase the load on your server temporarily and your replacements may not show up on your posts for a day or two initially (until all posts are indexed).<br/><br/><strong>Note:</strong> this feature requires the use of wp-cron.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="checkbox" class="prli-toggle-checkbox" data-box="plp-index-keywords" name="plp_index_keywords" <?php checked($index_keywords); ?> />
          </td>
        </tr>
        <tr valign="top" class="plp-index-keywords">
          <td colspan="2">
            <div class="prli-sub-box-white" style="display: block;">
              <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
              <table class="form-table">
                <tbody>
                  <tr valign="top">
                    <th scope="row">
                      <label>
                        <?php echo __('Keyword Index Status', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip('prli-kw-index-status',
                          __('Keyword Index Status', 'pretty-link'),
                          __('This shows how many posts have keywords indexed for and are ready for replacement.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <?php
                        global $plp_keyword;
                        $kwind = $plp_keyword->posts_indexed();
                        printf(__('%1$s out of %2$s Posts Indexed'), $kwind->indexed, $kwind->total);
                        if($plp_options->replace_keywords_in_comments) {
                          echo "<br/>";
                          $kwind = $plp_keyword->comments_indexed();
                          printf(__('%1$s out of %2$s Comments Indexed'), $kwind->indexed, $kwind->total);
                        }
                      ?>
                    </td>
                  </tr>
                  <tr valign="top">
                    <th scope="row">
                      <label>
                        <?php echo __('URL Index Status', 'pretty-link'); ?>
                        <?php PrliAppHelper::info_tooltip('prli-url-index-status',
                          __('URL Replacements Index Status', 'pretty-link'),
                          __('This shows how many posts have url replacements indexed for and are ready for replacement.', 'pretty-link'));
                        ?>
                      </label>
                    </th>
                    <td>
                      <?php
                        global $plp_url_replacement;
                        $kwind = $plp_url_replacement->posts_indexed();
                        printf(__('%1$s out of %2$s Posts Indexed'), $kwind->indexed, $kwind->total);
                        if($plp_options->replace_keywords_in_comments) {
                          echo "<br/>";
                          $kwind = $plp_url_replacement->comments_indexed();
                          printf(__('%1$s out of %2$s Comments Indexed'), $kwind->indexed, $kwind->total);
                        }
                      ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="prli-page" id="auto-create">
  <div class="prli-page-title"><?php _e('Auto-Create Shortlink Options'); ?></div>

  <?php
    PlpOptionsHelper::autocreate_post_options('post',
      $plp_options->posts_auto,
      $plp_options->posts_group,
      $plp_options->social_posts_buttons
    );

    PlpOptionsHelper::autocreate_post_options('page',
      $plp_options->pages_auto,
      $plp_options->pages_group,
      $plp_options->social_pages_buttons
    );

    PlpOptionsHelper::autocreate_all_cpt_options();
  ?>

</div>

<div class="prli-page" id="prettybar">
  <div class="prli-page-title"><?php _e('Pretty Bar Options'); ?></div>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_image_url; ?>">
            <?php _e('Image URL', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-image-url',
                                              __('Pretty Bar Image URL', 'pretty-link'),
                                              __('If set, this will replace the logo image on the Pretty Bar. The image that this URL references should be 48x48 Pixels to fit.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="large-text" name="<?php echo $prettybar_image_url; ?>" value="<?php echo $prli_options->prettybar_image_url; ?>"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_background_image_url; ?>">
            <?php _e('Background Image URL', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-background-image-url',
                                              __('Pretty Bar Background Image URL', 'pretty-link'),
                                              __('If set, this will replace the background image on Pretty Bar. The image that this URL references should be 65px tall - this image will be repeated horizontally across the bar.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="large-text" name="<?php echo $prettybar_background_image_url; ?>" value="<?php echo $prli_options->prettybar_background_image_url; ?>"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_color; ?>">
            <?php _e('Background Color', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-color',
                                              __('Pretty Bar Background Color', 'pretty-link'),
                                              __('This will alter the background color of the Pretty Bar if you haven\'t specified a Pretty Bar background image.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="plp-colorpicker" name="<?php echo $prettybar_color; ?>" value="<?php echo $prli_options->prettybar_color; ?>" size="8"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_text_color; ?>">
            <?php _e('Text Color', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-text-color',
                                              __('Pretty Bar Text Color', 'pretty-link'),
                                              __('If not set, this defaults to black (RGB value <code>#000000</code>) but you can change it to whatever color you like.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="plp-colorpicker" name="<?php echo $prettybar_text_color; ?>" value="<?php echo $prli_options->prettybar_text_color; ?>" size="8"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_link_color; ?>">
            <?php _e('Link Color', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-link-color',
                                              __('Pretty Bar Link Color', 'pretty-link'),
                                              __('If not set, this defaults to blue (RGB value <code>#0000ee</code>) but you can change it to whatever color you like.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="plp-colorpicker" name="<?php echo $prettybar_link_color; ?>" value="<?php echo $prli_options->prettybar_link_color; ?>" size="8"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_hover_color; ?>">
            <?php _e('Link Hover Color', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-link-hover-color',
                                              __('Pretty Bar Link Hover Color', 'pretty-link'),
                                              __('If not set, this defaults to RGB value <code>#ababab</code> but you can change it to whatever color you like.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="plp-colorpicker" name="<?php echo $prettybar_hover_color; ?>" value="<?php echo $prli_options->prettybar_hover_color; ?>" size="8"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_visited_color; ?>">
            <?php _e('Visited Link Color', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-visited-link-color',
                                              __('Pretty Bar Visited Link Color', 'pretty-link'),
                                              __('If not set, this defaults to RGB value <code>#551a8b</code> but you can change it to whatever color you like.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" class="plp-colorpicker" name="<?php echo $prettybar_visited_color; ?>" value="<?php echo $prli_options->prettybar_visited_color; ?>" size="8"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_title_limit; ?>">
            <?php _e('Title Char Limit', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-title-char-limit',
                                              __('Pretty Bar Title Char Limit', 'pretty-link'),
                                              __('If your Website has a long title then you may need to adjust this value so that it will all fit on the Pretty Bar. It is recommended that you keep this value to <code>30</code> characters or less so the Pretty Bar\'s format looks good across different browsers and screen resolutions.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" name="<?php echo $prettybar_title_limit; ?>" value="<?php echo $prli_options->prettybar_title_limit; ?>" size="4"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_desc_limit; ?>">
            <?php _e('Description Char Limit', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-desc-char-limit',
                                              __('Pretty Bar Description Char Limit', 'pretty-link'),
                                              __('If your Website has a long Description (tagline) then you may need to adjust this value so that it will all fit on the Pretty Bar. It is recommended that you keep this value to <code>40</code> characters or less so the Pretty Bar\'s format looks good across different browsers and screen resolutions.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" name="<?php echo $prettybar_desc_limit; ?>" value="<?php echo $prli_options->prettybar_desc_limit; ?>" size="4"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_link_limit; ?>">
            <?php _e('Target URL Char Limit', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-target-url-char-limit',
                                              __('Pretty Bar Target URL Char Limit', 'pretty-link'),
                                              __('If you link to a lot of large Target URLs you may want to adjust this value. It is recommended that you keep this value to <code>40</code> or below so the Pretty Bar\'s format looks good across different browsers and URL sizes', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="text" name="<?php echo $prettybar_link_limit; ?>" value="<?php echo $prli_options->prettybar_link_limit; ?>" size="4"/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_show_title; ?>">
            <?php _e('Show Title', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-show-title',
                                              __('Pretty Bar Show Title', 'pretty-link'),
                                              __('Make sure this is checked if you want the title of your blog (and link) to show up on the Pretty Bar.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $prettybar_show_title; ?>" <?php checked($prli_options->prettybar_show_title != 0); ?>/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_show_description; ?>">
            <?php _e('Show Description', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-show-description',
                                              __('Pretty Bar Show Description', 'pretty-link'),
                                              __('Make sure this is checked if you want your site description to show up on the Pretty Bar.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $prettybar_show_description; ?>" <?php checked($prli_options->prettybar_show_description != 0); ?>/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_show_share_links; ?>">
            <?php _e('Show Share Links', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-show-share-links',
                                              __('Pretty Bar Show Share Links', 'pretty-link'),
                                              __('Make sure this is checked if you want "share links" to show up on the Pretty Bar.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $prettybar_show_share_links; ?>" <?php checked($prli_options->prettybar_show_share_links != 0); ?>/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_show_target_url_link; ?>">
            <?php _e('Show Target URL', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-show-target-url-links',
                                              __('Pretty Bar Show Target URL Links', 'pretty-link'),
                                              __('Make sure this is checked if you want a link displaying the Target URL to show up on the Pretty Bar.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $prettybar_show_target_url_link; ?>" <?php checked($prli_options->prettybar_show_target_url_link != 0); ?>/>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $prettybar_hide_attrib_link; ?>">
            <?php _e('Hide Attribution Link', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-prettybar-hide-attrib-link',
                                              __('Hide Attribution Link', 'pretty-link'),
                                              __('Check this to hide the pretty link attribution link on the pretty bar.<br/><br/><strong>Wait, before you do this, you might want to leave this un-checked and set the alternate URL of this link to your <em>Pretty Links Pro</em> <a href="https://prettylinks.com/plp/options/aff-attribution">Affiliate URL</a> to earn a few bucks while you are at it.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $prettybar_hide_attrib_link; ?>" class="prli-toggle-checkbox" data-box="prettybar-attrib-url" data-reverse="true" <?php checked($plp_options->prettybar_hide_attrib_link != 0); ?>/>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="prli-sub-box prettybar-attrib-url">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $prettybar_attrib_url; ?>">
              <?php _e('Attribution URL', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-prettybar-attribution-url',
                                                __('Alternate Pretty Bar Attribution URL', 'pretty-link'),
                                                __('If set, this will replace the Pretty Bars attribution URL. This is a very good place to put your <em>Pretty Links Pro</em> <a href="https://prettylinks.com/plp/options/aff-attribution-2">Affiliate Link</a>.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input type="text" class="regular-text" name="<?php echo $prettybar_attrib_url; ?>" value="<?php echo $plp_options->prettybar_attrib_url; ?>"/>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="prli-page" id="social">
  <div class="prli-page-title"><?php _e('Social Buttons Options'); ?></div>
  <div>
    <label class="prli-label" for="<?php echo $social_buttons; ?>">
      <?php _e('Buttons', 'pretty-link'); ?>
      <?php PrliAppHelper::info_tooltip('prli-social-buttons',
                                        __('Social Buttons', 'pretty-link'),
                                        __('Select which buttons you want to be visible on the Social Buttons Bar.<br/><br/><code>Note:</code> In order for the Social Buttons Bar to be visible on Pages and or Posts, you must first enable it in the "Page &amp; Post Options" section above.', 'pretty-link'));
      ?>
    </label>

    <ul class="prli-social-button-checkboxes">
      <?php
      foreach( $plp_options->social_buttons as $b ) {
        ?>
        <li class="pl-social-<?php echo $b['slug']; ?>-button">
          <input type="checkbox" name="<?php echo "{$social_buttons}[{$b['slug']}]"; ?>" <?php checked($b['checked']); ?>/>
          <i class="<?php echo $b['icon']; ?>"> </i>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>
  <br/>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $social_buttons_placement; ?>">
            <?php _e('Buttons Placement', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-social-buttons-placement',
                                              __('Social Buttons Placement', 'pretty-link'),
                                              __('This determines where your Social Buttons Placement should appear in relation to content on Pages and/or Posts.<br/><br/><code>Note:</code> If you want this bar to appear then you must enable it in the "Page and Post Options" above.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input type="radio" name="<?php echo $social_buttons_placement; ?>" value="top" <?php checked($plp_options->social_buttons_placement, 'top'); ?>/><span class="prli-radio-text"><?php _e('Top', 'pretty-link'); ?></span><br/><br/>
          <input type="radio" name="<?php echo $social_buttons_placement; ?>" value="bottom" <?php checked($plp_options->social_buttons_placement, 'bottom'); ?>/><span class="prli-radio-text"><?php _e('Bottom', 'pretty-link'); ?></span><br/><br/>
          <input type="radio" name="<?php echo $social_buttons_placement; ?>" value="top-and-bottom" <?php checked($plp_options->social_buttons_placement, 'top-and-bottom'); ?>/><span class="prli-radio-text"><?php _e('Top and Bottom', 'pretty-link'); ?></span><br/><br/>
          <input type="radio" name="<?php echo $social_buttons_placement; ?>" value="none" <?php checked($plp_options->social_buttons_placement, 'none'); ?>/><span class="prli-radio-text"><?php _e('None', 'pretty-link'); ?></span>
          <?php PrliAppHelper::info_tooltip('prli-social-buttons-placement-none',
                                            __('Social Buttons Manual Placement', 'pretty-link'),
                                            __('If you select none, you can still show your Social Buttons by manually adding the <code>[social_buttons_bar]</code> shortcode to your blog posts or <code>&lt;?php the_social_buttons_bar(); ?&gt;</code> template tag to your WordPress Theme.', 'pretty-link'));
          ?>
        </td>
      </tr>
    </tbody>
  </table>

  <?php /*
  <table class="form-table prli-social-buttons-options">
    <tr class="form-field">
      <td valign="top" width="15%"><?php _e("Social Buttons Display Spacing:", $social_buttons_padding , 'pretty-link'); ?> </td>
      <td width="85%" class="pretty-link-social-buttons-padding-input">
        <input type="text" class="regular-text" name="<?php echo $social_buttons_padding; ?>" value="<?php echo $plp_options->social_buttons_padding; ?>" />px&nbsp; &nbsp;<span class="description"><?php _e('Determines the spacing (in pixels) between the buttons on the social buttons bar.', 'pretty-link'); ?></span>
      </td>
    </tr>
  </table>

  <h4><?php _e('Display Social Buttons in Feed:', 'pretty-link'); ?></h4>
  <div id="option-pane">
    <input type="checkbox" name="<?php echo $social_buttons_show_in_feed; ?>" <?php checked($plp_options->social_buttons_show_in_feed != 0); ?>/>&nbsp;<?php _e('Show Social Buttons in your RSS Feed', 'pretty-link'); ?>
  </div>
  */ ?>
</div>

<div class="prli-page" id="public-links">
  <div class="prli-page-title"><?php _e('Public Links Creation Options'); ?></div>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $allow_public_link_creation; ?>">
            <?php _e('Enable Public Links', 'pretty-link'); ?>
            <?php PrliAppHelper::info_tooltip('prli-enable-public-link-creation',
                                              __('Enable Public Link Creation on this Site', 'pretty-link'),
                                              __('This option will give you the ability to turn your website into a link shortening service for your users. Once selected, you can enable the Pretty Links Pro Sidebar Widget or just display the link creation form with the <code>[prli_create_form]</code> shortcode in any post or page on your website.', 'pretty-link'));
            ?>
          </label>
        </th>
        <td>
          <input class="prli-toggle-checkbox" data-box="use-public-link-display-page" type="checkbox" name="<?php echo $allow_public_link_creation; ?>" <?php checked($plp_options->allow_public_link_creation != 0); ?>/>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="prli-sub-box use-public-link-display-page">
    <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
    <table class="form-table">
      <tbody>
        <tr valign="top">
          <th scope="row">
            <label for="<?php echo $use_public_link_display_page; ?>">
              <?php _e('Use Display Page', 'pretty-link'); ?>
              <?php PrliAppHelper::info_tooltip('prli-use-public-link-display-page-info',
                                                __('Use Public Link Display Page', 'pretty-link'),
                                                __('When a link is created using the public form, the user is typically redirected to a simple page displaying their new pretty link. But, you can specify a page that you want them to be redirected to on your website, using your branding instead by selecting this box and entering the url of the page you want them to go to.', 'pretty-link'));
              ?>
            </label>
          </th>
          <td>
            <input class="prli-toggle-checkbox" data-box="prli-public-link-display-page" type="checkbox" name="<?php echo $use_public_link_display_page; ?>" <?php checked($plp_options->use_public_link_display_page != 0); ?>/>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="prli-sub-box-white prli-public-link-display-page">
      <div class="prli-arrow prli-white prli-up prli-sub-box-arrow"> </div>
      <table class="form-table">
        <tbody>
          <tr valign="top">
            <th scope="row">
              <label for="<?php echo $public_link_display_page; ?>">
                <?php _e('Display Page', 'pretty-link'); ?>
                <?php PrliAppHelper::info_tooltip('prli-public-link-display-page-info',
                                                  __('Public Pretty Link Creation Display URL', 'pretty-link'),
                                                  __('To set this up, create a new page on your WordPress site and make sure the <code>[prli_create_display]</code> appears somewhere on this page -- otherwise the link will never get created. Once this page is created, just enter the full URL to it here. Make sure this URL does npt end with a slash (/).', 'pretty-link'));
                ?>
              </label>
            </th>
            <td>
              <input type="text" class="regular-text" name="<?php echo $public_link_display_page; ?>" value="<?php echo $plp_options->public_link_display_page; ?>" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

