<?php
	/**
	 * Modaal Module - Front End
	 */
?>

<div class="rtp-cta align-<?php echo $settings->cta_align; ?>">
  <?php if ($settings->cta_type == 'link') { ?>
    <a href="<?php echo $settings->cta_link; ?>">
      <span class="text"><?php echo $settings->cta_text; ?></span>
      <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span>
    </a>
  <?php } ?>

  <?php if ($settings->cta_type == 'modaal') { ?>
    <a class="modaal" href="#modal-<?php echo $id; ?>">
      <span class="text"><?php echo $settings->cta_text; ?></span>
      <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span>
    </a>
    <div id="modal-<?php echo $id; ?>" style="display:none;">
    	<?php echo $settings->modaal_content; ?>
    </div>
  <?php } ?>
</div>
