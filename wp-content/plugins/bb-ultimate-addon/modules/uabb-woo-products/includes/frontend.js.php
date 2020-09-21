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
			id: '<?php echo esc_attr( $id ); ?>',
			ajaxurl: "<?php echo wp_kses_post( admin_url( 'admin-ajax.php' ) ); ?>",
			is_cart: <?php echo esc_attr( is_cart() ? 'true' : 'false' ); ?>,
			view_cart: '<?php echo esc_attr__( 'View cart', 'uabb' ); ?>',
			cart_url: '<?php echo esc_url( apply_filters( 'uabb_woocommerce_add_to_cart_redirect', wc_get_cart_url() ) ); ?>',
			layout: "<?php echo esc_attr( $settings->layout ); ?>",
			skin: "<?php echo esc_attr( $settings->skin ); ?>",
			next_arrow: '<?php echo apply_filters( 'uabb_woo_products_carousel_next_arrow_icon', 'fas fa-angle-right' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>',
			prev_arrow: '<?php echo apply_filters( 'uabb_woo_products_carousel_previous_arrow_icon', 'fas fa-angle-left' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>',

			/* Slider */
			infinite: <?php echo esc_attr( ( 'yes' === $settings->infinite_loop ) ? 'true' : 'false' ); ?>,
			dots: <?php echo esc_attr( ( 'yes' === $settings->enable_dots ) ? 'true' : 'false' ); ?>,
			arrows: <?php echo esc_attr( ( 'yes' === $settings->enable_arrow ) ? 'true' : 'false' ); ?>,
			desktop: <?php echo esc_attr( $settings->slider_columns_new ); ?>,
			medium: <?php echo esc_attr( $settings->slider_columns_new_medium ); ?>,
			small: <?php echo esc_attr( $settings->slider_columns_new_responsive ); ?>,
			slidesToScroll: <?php echo esc_attr( ( '' !== $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1 ); ?>,
			autoplay: <?php echo esc_attr( ( 'yes' === $settings->autoplay ) ? 'true' : 'false' ); ?>,
			autoplaySpeed: <?php echo esc_attr( ( '' !== $settings->animation_speed ) ? $settings->animation_speed : '1000' ); ?>,
			small_breakpoint: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
			medium_breakpoint: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>,
			module_settings: <?php echo wp_json_encode( $settings ); ?>
		});

	});

})(jQuery);
