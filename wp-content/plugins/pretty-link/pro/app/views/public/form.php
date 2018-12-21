<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

global $post;

$referral_url = PrliUtils::current_page_url();
$nonce = wp_nonce_field('update-options');
$target_url = (isset($_GET['url']))?$_GET['url']:'';

?>
<div id="prli_create_public_link">
  <form name="prli_public_form" class="prli_public_form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="hidden" name="action" value="plp-create-public-link" />
    <input type="hidden" name="referral-url" value="<?php echo $referral_url; ?>"/>
    <input type="hidden" name="redirect_type" value="<?php echo $redirect_type; ?>"/>
    <input type="hidden" name="track" value="<?php echo $track; ?>"/>
    <input type="hidden" name="group" value="<?php echo $group; ?>"/>

    <?php
      echo $nonce;

      if(isset($_GET['errors'])):
        $errors = unserialize(stripslashes($_GET['errors']));

        if( is_array($errors) && count($errors) > 0 ):
          ?>
          <div class="error">
            <ul>
              <?php foreach( $errors as $error ): ?>
                <li><strong><?php _e('ERROR:', 'pretty-link'); ?></strong> <?php echo $error; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php
        endif;

      endif;
    ?>

    <p class="prli_create_link_fields">
      <div class="plp-create-link-label"><?php echo $label; ?></div>
      <div class="plp-create-link-input"><input type="text" name="url" value="<?php echo $target_url; ?>" /></div>

      <?php if(!empty($button)): ?>
        <div class="plp-create-link-submit"><input type="submit" name="Submit" value="<?php echo $button; ?>" /></div>
      <?php endif; ?>
    </p>
  </form>
</div>

