<?php
	/**
	 * Figure Card Module - Front End
	 */

$classes = [
  'figure-card-' . $settings->structure,
  'badge-' . strtolower($settings->badge)
];

if ($settings->badge !== "RTP") {
  $badge = $settings->badge . ' RTP';
} else {
  $badge = $settings->badge;
}

if ($settings->structure == 'horizontal') {
  $classes[] = 'figure-align-' . $settings->image_align;
}
?>

<article class="figure-card <?php echo implode(' ', $classes); ?>">
  <div class="figure-card-img">
    <?php if ($settings->structure !== 'default') { ?>
  		<?php echo wp_get_attachment_image($settings->image, 'full', false, ['alt' => $settings->image_alt, 'itemprop' => 'image']); ?>
    <?php } ?>
  </div>

  <div class="card" itemprop="description">
    <?php if (!empty($settings->title)) : ?>
      <div class="card-badge"><span><?php echo $badge; ?></span></div>
      <h3 class="card-title" itemprop="name"><?php echo $settings->title; ?></h3>
    <?php endif; ?>
		<div class="card-content">
			<?php echo $settings->content; ?>
		</div>

    <?php if ($settings->enable_cta == 'block') { ?>
    	<div class="card-cta"><a class="a11y-link-wrap" href="<?php echo $settings->cta_link; ?>" target="<?php echo $settings->cta_link_target; ?>"><span class="text"><?php echo $settings->cta_text; ?></span> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
		<?php } ?>

    <?php if ($settings->enable_cta == 'modaal') { ?>
      <div class="card-cta"><a class="a11y-link-wrap modaal" href="#modal-<?php echo $id; ?>"><span class="text"><?php echo $settings->cta_text; ?></span> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
      <div id="modal-<?php echo $id; ?>" style="display:none;">
      	<?php echo $settings->modaal_content; ?>
      </div>
    <?php } ?>

  </div>

  <?php if ($settings->structure == 'vertical') { ?>
    <div class="pattern-background">
      <?php include(CBB_MODULES_DIR . 'assets/images/pattern-bracket.svg'); ?>
    </div>
  <?php } ?>
</article>
