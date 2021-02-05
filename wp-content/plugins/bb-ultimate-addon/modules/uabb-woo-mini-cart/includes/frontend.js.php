<?php
/**
 *  UABB Woo - Mini Cart Module front-end JS php file
 *
 *  @package UABBWooMiniCartModule
 */

?>

(function($) {
	$( document ).ready(function() {
		new UABBWooMiniCart({
			id: '<?php echo esc_attr( $id ); ?>',
			preview_cart: '<?php echo esc_attr( $settings->preview_cart ); ?>',
			cart_style: '<?php echo esc_attr( $settings->cart_style ); ?>',
			open_cart_on: '<?php echo esc_attr( $settings->open_cart_on ); ?>',
			esc_keypress: '<?php echo esc_attr( $settings->esc_keypress ); ?>',
			overlay_click: '<?php echo esc_attr( $settings->overlay_click ); ?>',
			isBuilderActive: <?php echo FLBuilderModel::is_builder_active() ? 'true' : 'false'; ?>
		});
	});
})(jQuery);
