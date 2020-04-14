<?php
/**
 *  UABB Subscribe Form Module front-end JS php file
 *
 *  @package UABB Subscribe Form Module
 */

?>

(function($) {

	$(function() {
		jQuery( document ).ready(function($) {
			new UABBSubscribeFormModule({
				id: '<?php echo esc_attr( $id ); ?>',
				btn_width: '<?php echo esc_attr( $settings->btn_width ); ?>',
				btn_padding: '<?php echo esc_attr( uabb_theme_button_vertical_padding( '' ) ); ?>',
				layout: '<?php echo esc_attr( $settings->layout ); ?>',
			});
		});

	});
})(jQuery);
