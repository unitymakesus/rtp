<?php
/**
 * Render JavaScript to check function the various settings of module
 *
 * @package UABB Info Circle Module
 */

?>

jQuery(document).ready(function() {

	new UABBInfoCircle({
		id: '<?php echo esc_attr( $id ); ?>',
		autoplay: '<?php echo esc_attr( $settings->autoplay ); ?>',
		interval: '<?php echo ( '' !== trim( $settings->autoplay_time ) ) && ( $settings->autoplay_time > 0 ) ? esc_attr( $settings->autoplay_time ) : '15'; ?>',
		initial_animation: '<?php echo esc_attr( $settings->initial_animation ); ?>',
		responsive_nature: '<?php echo esc_attr( $settings->responsive_nature ); ?>',
		breakpoint: '<?php echo esc_attr( ( '' !== trim( $settings->breakpoint ) ) ? $settings->breakpoint : $global_settings->medium_breakpoint ); ?>',
	});
});
