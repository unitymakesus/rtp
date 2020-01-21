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
			id: '<?php echo $id; ?>',
			cart_redirect: '<?php echo $settings->auto_redirect; ?>'
		});
	});

})(jQuery);
