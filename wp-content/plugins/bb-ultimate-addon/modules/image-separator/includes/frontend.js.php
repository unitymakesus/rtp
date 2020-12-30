<?php
/**
 *  UABB Image Separator Module front-end JS php file
 *
 *  @package UABB Image Separator Module
 */

?>

(function($) {

	$(document).ready(function() {

		new UABBAnimation({
			id: '<?php echo esc_attr( $id ); ?>',
			animation_delay: '<?php echo ( '' !== $settings->img_animation_delay && '0' !== $settings->img_animation_delay ) ? esc_attr( $settings->img_animation_delay ) : ''; ?>',
			animation: '<?php echo esc_attr( ( 'no' === $settings->img_animation ) ? 'no' : 'animated ' . $settings->img_animation ); ?>',
			viewport_position: '<?php echo ( '' !== $settings->img_viewport_position ) ? esc_attr( $settings->img_viewport_position ) : '90'; ?>'

		});
	});

})(jQuery);
