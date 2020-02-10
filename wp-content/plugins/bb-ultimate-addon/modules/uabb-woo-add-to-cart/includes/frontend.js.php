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
			cart_redirect: '<?php echo esc_attr( $settings->auto_redirect ); ?>'
		});
	});

})(jQuery);
