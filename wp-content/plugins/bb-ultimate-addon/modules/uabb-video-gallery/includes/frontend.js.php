<?php
/**
 *  UABB Video Gallery Module file
 *
 *  @package UABB Video Gallery Module
 */

?>

jQuery(document).ready(function() {
	new UABBVideoGallery({
		id: '<?php echo esc_attr( $id ); ?>',
		layout:'<?php echo esc_attr( $settings->layout ); ?>',
		action:'<?php echo esc_attr( $settings->click_action ); ?>',
		slidesToShow:<?php echo esc_attr( ( $settings->gallery_columns ) ? $settings->gallery_columns : '4' ); ?>,
		slidesToScroll :<?php echo esc_attr( ( $settings->slides_to_scroll ) ? $settings->slides_to_scroll : '1' ); ?>,
		autoplaySpeed:<?php echo esc_attr( ( $settings->autoplay_speed ) ? $settings->autoplay_speed : '5000' ); ?>,
		autoplay:<?php echo esc_attr( ( 'yes' === $settings->autoplay ) ? 'true' : 'false' ); ?>,
		infinite:<?php echo esc_attr( ( 'yes' === $settings->infinite ) ? 'true' : 'false' ); ?>,
		pauseOnHover:<?php echo esc_attr( ( 'yes' === $settings->pause_on_hover ) ? 'true' : 'false' ); ?>,
		speed:<?php echo esc_attr( ( $settings->transition_speed ) ? $settings->transition_speed : '500' ); ?>,
		arrows:<?php echo esc_attr( ( 'yes' === $settings->enable_arrow ) ? 'true' : 'false' ); ?>,
		dots:<?php echo esc_attr( ( 'yes' === $settings->enable_dots ) ? 'true' : 'false' ); ?>,
		small_breakpoint: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
		medium_breakpoint: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>,
		medium:<?php echo esc_attr( ( $settings->gallery_columns_medium ) ); ?>,
		small:<?php echo esc_attr( ( $settings->gallery_columns_responsive ) ); ?>,
		slidesToScroll_medium :<?php echo esc_attr( ( $settings->slides_to_scroll_medium ) ? $settings->slides_to_scroll_medium : '1' ); ?>,
		slidesToScroll_small :<?php echo esc_attr( ( $settings->slides_to_scroll_responsive ) ? $settings->slides_to_scroll_responsive : '1' ); ?>,
		next_arrow: '<?php echo esc_attr( apply_filters( 'uabb_video_gallery_carousel_next_arrow_icon', 'fas fa-angle-right' ) ); ?>',
		prev_arrow: '<?php echo esc_attr( apply_filters( 'uabb_video_gallery_carousel_previous_arrow_icon', 'fas fa-angle-left' ) ); ?>',
	});
});
