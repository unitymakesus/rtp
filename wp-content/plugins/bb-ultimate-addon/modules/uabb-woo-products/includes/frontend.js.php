<?php
/**
 *  UABB Woo Products Module front-end JS php file
 *
 *  @package UABB Woo Products Module
 */

?>

(function($) {

	$( document ).ready(function() {

		new UABBWooProducts({
			id: '<?php echo $id; ?>',
			ajaxurl: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			layout: "<?php echo $settings->layout; ?>",
			skin: "<?php echo $settings->skin; ?>",
			next_arrow: '<?php echo apply_filters( 'uabb_woo_products_carousel_next_arrow_icon', 'fas fa-angle-right' ); ?>',
			prev_arrow: '<?php echo apply_filters( 'uabb_woo_products_carousel_previous_arrow_icon', 'fas fa-angle-left' ); ?>',

			/* Slider */
			infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
			dots: <?php echo ( 'yes' == $settings->enable_dots ) ? 'true' : 'false'; ?>,
			arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,
			desktop: <?php echo $settings->slider_columns_new; ?>,
			medium: <?php echo $settings->slider_columns_new_medium; ?>,
			small: <?php echo $settings->slider_columns_new_responsive; ?>,
			slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
			autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
			autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
			small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
			medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
			module_settings: <?php echo json_encode( $settings ); ?>
		});

	});

})(jQuery);
