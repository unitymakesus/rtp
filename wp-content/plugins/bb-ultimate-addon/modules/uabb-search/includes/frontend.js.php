<?php
/**
 *  UABB Search Module front-end JS php file
 *
 *  @package UABB Search Module
 */

?>

(function($) {

	$(function() {
		new UABBSearchModule({
			id: '<?php echo esc_attr( $id ); ?>',
			display: '<?php echo esc_attr( $settings->display ); ?>',
			btnAction: '<?php echo esc_attr( $settings->btn_action ); ?>',
			enable_ajax: '<?php echo esc_attr( $settings->enable_ajax ); ?>',
			showCloseBtn: <?php echo 'show' === $settings->fs_close_button ? 'true' : 'false'; ?>,
		});
	});

})(jQuery);
