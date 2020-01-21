<?php
/**
 *  UABB Video Module front-end JS php file.
 *
 *  @package UABB Video Module
 */

?>
jQuery(document).ready(function() {
	new UABBVideo({
		id: '<?php echo $id; ?>',
		vsticky:'<?php echo ( 'yes' === $settings->enable_sticky ) ? true : false; ?>',
		sticky_hide_on:'<?php echo $settings->sticky_hide_on; ?>',
		small_breakpoint:<?php echo $global_settings->responsive_breakpoint; ?>,
		medium_breakpoint:<?php echo $global_settings->medium_breakpoint; ?>,
		stickybottom:<?php echo ( $settings->sticky_video_margin_bottom ) ? $settings->sticky_video_margin_bottom : '0'; ?>,
	});
});

