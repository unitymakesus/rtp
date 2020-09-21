<?php
/**
 *  UABBWooAddToCartModule front-end JS php file
 *
 *  @package UABBWooAddToCartModule
 */

?>

(function($) {

	$( document ).ready(function() {

		new UABBWooAddToCart({
			id: '<?php echo esc_attr( $id ); ?>',
			cart_redirect: '<?php echo esc_attr( $settings->auto_redirect ); ?>',
			is_cart: <?php echo esc_attr( is_cart() ? 'true' : 'false' ); ?>,
			cart_url: '<?php echo esc_url( apply_filters( 'uabb_woocommerce_add_to_cart_redirect', wc_get_cart_url() ) ); ?>'
		});
	});

})(jQuery);
