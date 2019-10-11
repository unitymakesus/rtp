<?php
/**
 * Render JavaScript to check function the various settings of module
 *
 * @package UABB Info Circle Module
 */

?>

jQuery(document).ready(function() {

	new UABBInfoCircle({
		id: '<?php echo $id; ?>',
		autoplay: '<?php echo $settings->autoplay; ?>',
		interval: '<?php echo ( '' != trim( $settings->autoplay_time ) ) && ( $settings->autoplay_time > 0 ) ? $settings->autoplay_time : '15'; ?>',
		initial_animation: '<?php echo $settings->initial_animation; ?>',
		responsive_nature: '<?php echo $settings->responsive_nature; ?>',
		breakpoint: '<?php echo ( '' != trim( $settings->breakpoint ) ) ? $settings->breakpoint : $global_settings->medium_breakpoint; ?>',
	});
});
