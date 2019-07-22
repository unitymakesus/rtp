<?php
	/**
	 * Figure Card Module - Front End
	 */

$classes = [
  'figure-card-' . $settings->structure,
  'badge-' . strtolower($settings->badge)
];

if ($settings->structure == 'horizontal') {
  $classes[] = 'figure-align-' . $settings->image_align;
}
?>

<article class="figure-card <?php echo implode(' ', $classes); ?>">
  <?php if ($settings->structure !== 'default') { ?>
		<?php echo wp_get_attachment_image($settings->image, 'full', false, ['alt' => $settings->image_alt, 'itemprop' => 'image']); ?>
  <?php } ?>

  <div class="card" itemprop="description">
    <div class="card-badge"><span><?php echo $settings->badge; ?></span></div>
    <h3 class="card-title" itemprop="name"><?php echo $settings->title; ?></h3>

		<div class="card-content">
			<?php echo $settings->content; ?>
		</div>

		<?php if ($settings->enable_cta == 'block') { ?>
    	<div class="card-cta"><a href="<?php echo $settings->cta_link; ?>"><span><?php echo $settings->cta_text; ?></span> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-figure-card/images/arrow-right.svg'); ?></span></a></div>
		<?php } ?>

  </div>

  <?php if ($settings->structure == 'vertical') { ?>
    <div class="pattern-background">
      <?php include(CBB_MODULES_DIR . 'modules/cbb-figure-card/includes/pattern-bracket.php'); ?>
    </div>
  <?php } ?>
</article>
