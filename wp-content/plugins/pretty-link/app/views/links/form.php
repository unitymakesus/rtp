<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<?php
  if(isset($values['link_id']) && $values['link_id'] > 0) {
    ?>
      <input type="hidden" name="link_id" value="<?php echo esc_attr($values['link_id']); ?>" />
    <?php
  }

  $link_nonce = wp_create_nonce(PrliLink::$nonce_str . wp_salt());
?>

<input type="hidden" name="<?php echo esc_attr(PrliLink::$nonce_str); ?>" value="<?php echo esc_attr($link_nonce); ?>" />

<div id="pretty_link_errors" class="prli-hidden">
  <p><!-- This is where our errors will show up --></p>
</div>

<table class="prli-settings-table">
  <tr class="prli-mobile-nav">
    <td colspan="2">
      <a href="" class="prli-toggle-nav"><i class="pl-icon-menu"> </i></a>
    </td>
  </tr>
  <tr>
    <td class="prli-settings-table-nav">
      <ul class="prli-sidebar-nav">
        <li><a data-id="basic"><?php esc_html_e('Basic', 'pretty-link'); ?></a></li>
        <li><a data-id="advanced"><?php esc_html_e('Advanced', 'pretty-link'); ?></a></li>
        <li><a data-id="pro"><?php esc_html_e('Pro', 'pretty-link'); ?></a></li>
        <?php do_action('prli_admin_link_nav'); ?>
      </ul>
    </td>
    <td class="prli-settings-table-pages">
      <div class="prli-page" id="basic">
        <?php require(PRLI_VIEWS_PATH . '/links/form_basic.php'); ?>
      </div>
      <div class="prli-page" id="advanced">
        <?php require(PRLI_VIEWS_PATH . '/links/form_advanced.php'); ?>
      </div>
      <div class="prli-page" id="pro">
        <?php require(PRLI_VIEWS_PATH . '/links/form_pro.php'); ?>
      </div>
    </td>
  </tr>
</table>

