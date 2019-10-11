<?php
/**
 *  Off Canvas Module Module file
 *
 *  @package Off Canvas Module Module
 */

?>
jQuery(document).ready(function() {
	new UABBOffCanvasModule({
		id: '<?php echo $id; ?>',
		overlay_click: '<?php echo $settings->overlay_click; ?>',
		esc_keypress: '<?php echo $settings->esc_keypress; ?>',
		preview_off_canvas: '<?php echo $settings->preview_off_canvas; ?>',
		offcanvas_on: '<?php echo $settings->offcanvas_on; ?>',
		offcanvas_custom: '<?php echo $settings->off_canvas_custom; ?>',
		close_on: '<?php echo $settings->close_on_link; ?>',
	});

});
