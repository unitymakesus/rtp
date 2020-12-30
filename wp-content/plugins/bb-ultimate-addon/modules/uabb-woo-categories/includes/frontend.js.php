<?php
/**
 *  UABBWooCategoriesModule Module file
 *
 *  @package UABBWooCategoriesModule Module
 */

?>
(function($) {

	$( document ).ready(function() {

		new UABBWooCategories({
			id: '<?php echo esc_attr( $id ); ?>',
			layout: "<?php echo esc_attr( $settings->layout ); ?>",

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
			next_arrow: '<?php echo apply_filters( 'uabb_woo_categories_carousel_next_arrow_icon', 'fas fa-angle-right' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>',
			prev_arrow: '<?php echo apply_filters( 'uabb_woo_categories_carousel_previous_arrow_icon', 'fas fa-angle-left' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>',
		});
	});

})(jQuery);
