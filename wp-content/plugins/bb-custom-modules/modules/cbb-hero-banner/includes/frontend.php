<?php
	/**
	 * RTP Splash Module - Front End
	 */

$classes = [
 'badge-' . strtolower($settings->badge)
];

if ($settings->badge !== "RTP") {
 $badge = $settings->badge . ' RTP';
} else {
 $badge = $settings->badge;
}
?>

<div class="home-hero-wrapper">
	<div class="home-hero">
		<img src="<?php echo $settings->image_src; ?>" alt="<?php echo $settings->image_alt; ?>" />
	</div>
	<div class="home-banner-wrapper">
		<div class="home-banner">
			<div class="banner-badge"><span><?php echo $settings->badge; ?></span></div>
			<div class="banner-content">
				<h1><?php echo $settings->title; ?></h1>
					<?php echo $settings->content; ?>
			</div>
		</div>
		<div class="banner-cta"><a href="<?php echo $settings->cta_link; ?>"><span><?php echo $settings->cta_text; ?></span> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
	</div>
</div>
