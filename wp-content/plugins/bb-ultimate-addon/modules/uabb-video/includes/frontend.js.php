<?php
/**
 *  UABB Video Module front-end JS php file.
 *
 *  @package UABB Video Module
 */

?>
jQuery(document).ready(function() {
	new UABBVideo({
		id: '<?php echo esc_attr( $id ); ?>',
		vsticky:'<?php echo ( 'yes' === $settings->enable_sticky ) ? true : false; ?>',
		sticky_hide_on:'<?php echo esc_attr( $settings->sticky_hide_on ); ?>',
		small_breakpoint:<?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
		medium_breakpoint:<?php echo esc_attr( $global_settings->medium_breakpoint ); ?>,
		stickybottom:<?php echo esc_attr( ( $settings->sticky_video_margin_bottom ) ? $settings->sticky_video_margin_bottom : '0' ); ?>,
	});
});

