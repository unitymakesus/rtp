<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<?php $prli_blogurl = esc_html($prli_blogurl); ?>

<div class="prli-page" id="custom-bookmarklet">
  <div class="prli-page-title"><?php _e('Custom Bookmarklet:', 'pretty-link'); ?></div>
  <strong><span id="prlipro-custom-bookmarklet-link"><a class="button button-primary" href="<?php echo PrliLink::bookmarklet_link(); ?>" style="vertical-align:middle;"><?php _e('Get Pretty Link', 'pretty-link'); ?></a></span></strong>&nbsp;&nbsp;
  <?php PrliAppHelper::info_tooltip( 'prli-custom-bookmarklet-instructions',
                                      __('Customize Pretty Link Bookmarklet', 'pretty-link'),
                                      __('Alter the options below to customize this Bookmarklet. As you modify the label, redirect type, tracking and group, you will see this bookmarklet update -- when the settings are how you want them, drag the bookmarklet into your toolbar. You can create as many bookmarklets as you want each with different settings.') );
  ?>
  <div>&nbsp;</div>
  <p><strong><?php _e('Pretty Link Options', 'pretty-link'); ?></strong></p>
  <form id="prlipro-custom-bookmarklet-form">
    <p>
      <label for="prlipro-bookmarklet-label" class="plp-bookmarklet-col-1"><?php _e('Label:', 'pretty-link'); ?></label>
        <input id="prlipro-bookmarklet-label" type="text" size="25" value="<?php _e('Get Pretty Link'); ?>" />
      </label>
    </p>
    <p>
      <label for="prlipro-bookmarklet-redirect-type" class="plp-bookmarklet-col-1"><?php _e('Redirection:', 'pretty-link'); ?></label>
      <?php PrliLinksHelper::redirect_type_dropdown('prlipro-bookmarklet-redirect-type','',array(__('Default') => -1)); ?>
    </p>
    <p>
      <label for="prlipro-bookmarklet-track" class="plp-bookmarklet-col-1"><?php _e('Tracking:', 'pretty-link'); ?></label>
      <select id="prlipro-bookmarklet-track" name="prlipro-bookmarklet-track?>">
        <option value="-1"><?php _e('Default', 'pretty-link'); ?>&nbsp;</option>
        <option value="1"><?php _e('Yes', 'pretty-link'); ?>&nbsp;</option>
        <option value="0"><?php _e('No', 'pretty-link'); ?>&nbsp;</option>
      </select>
    </p>
    <p>
      <label for="prlipro-bookmarklet-group" class="plp-bookmarklet-col-1"><?php _e('Group:', 'pretty-link'); ?></label>
      <select id="prlipro-bookmarklet-group" name="prlipro-bookmarklet-group?>">
        <option value="-1"><?php _e('None', 'pretty-link'); ?>&nbsp;</option>
        <?php
        $groups = prli_get_all_groups();
        foreach($groups as $g):
          ?><option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?>&nbsp;</option><?php
        endforeach;
        ?>
      </select>
    </p>
  </form>
</div>
