<?php
	/**
	 * RTP Splash Module - Front End
	 */
?>

<div id="landing-graphic">
	<div id="landing-graphic-pin" class="landing-graphic-pin">
		<svg id="svg-text" viewBox="0 0 325 126">
			<defs>
				<linearGradient id="rtp-gradient" x1="0" x2="100%" y1="0" y2="0" gradientUnits="userSpaceOnUse" >
					<stop stop-color="#4B9CD3" offset="0%"/>
					<stop stop-color="#012169" offset="33%"/>
					<stop stop-color="#82052A" offset="66%"/>
					<stop stop-color="#CC0000" offset="99%"/>
				</linearGradient>
			</defs>
			<text fill="url(#rtp-gradient)">
				<tspan id="svg-where" font-size="40" x="10" y="40">Where</tspan>
				<tspan id="svg-people" font-size="40" x="10" dy="35">People</tspan>
				<tspan id="svg-plus" font-size="40" dx="6" dy="0">+</tspan>
				<tspan id="svg-ideas" font-size="40" dx="6" dy="0">Ideas</tspan>
				<tspan id="svg-converge" font-size="40" x="10" dy="35">Converge</tspan>
			</text>
			<rect id="svg-bar" fill="url(#rtp-gradient)" x="50%" y="46" width="0" height="30" />
		</svg>
	</div>

	<div id="landing-graphic-swipe" class="landing-graphic-swipe">
		<img src="<?php echo $settings->cbb_rtp_splash_hero_image_src; ?>" alt="<?php echo $settings->cbb_rtp_splash_hero_image_alt; ?>" />
		<div id="landing-banner-wrapper" class="landing-banner-wrapper">
			<div class="landing-banner-gradient">
				<div class="badge"><span><?php echo $settings->cbb_rtp_splash_hero_badge; ?></span></div>
				<h1><?php echo $settings->cbb_rtp_splash_hero_title; ?></h1>
			</div>
			<div class="cta-anchor-bar"><a href="<?php echo $settings->cbb_rtp_splash_hero_cta_link; ?>"><?php echo $settings->cbb_rtp_splash_hero_cta_text; ?> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-rtp-splash/images/arrow-right.svg'); ?></span></a></div>
		</div>
	</div>
</div>
