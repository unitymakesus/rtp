<?php
/**
 *  UABB Business Review Module front-end JS php file.
 *
 *  @package Business Review Module
 */

?>
jQuery(document).ready(function() {
	new UABBBusinessReview({
		id: '<?php echo $id; ?>',
		review_layout:'<?php echo $settings->review_layout; ?>',
		slidesToShow:<?php echo ( $settings->gallery_columns ) ? $settings->gallery_columns : '3'; ?>,
		slidesToScroll :<?php echo ( $settings->slides_to_scroll ) ? $settings->slides_to_scroll : '1'; ?>,
		autoplaySpeed:<?php echo ( $settings->autoplay_speed ) ? $settings->autoplay_speed : '5000'; ?>,
		autoplay:<?php echo ( 'yes' === $settings->autoplay ) ? 'true' : 'false'; ?>,
		infinite:<?php echo ( 'yes' === $settings->infinite ) ? 'true' : 'false'; ?>,
		pauseOnHover:<?php echo ( 'yes' === $settings->pause_on_hover ) ? 'true' : 'false'; ?>,
		speed:<?php echo ( $settings->transition_speed ) ? $settings->transition_speed : '500'; ?>,
		arrows:<?php echo ( 'arrows' === $settings->navigation || 'both' === $settings->navigation ) ? 'true' : 'false'; ?>,
		dots:<?php echo ( 'dots' === $settings->navigation || 'both' === $settings->navigation ) ? 'true' : 'false'; ?>,
		small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
		medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
		medium:<?php echo ( $settings->gallery_columns_medium ); ?>,
		small:<?php echo ( $settings->gallery_columns_responsive ); ?>,
		slidesToScroll_medium :<?php echo ( $settings->slides_to_scroll_medium ) ? $settings->slides_to_scroll_medium : '1'; ?>,
		slidesToScroll_small :<?php echo ( $settings->slides_to_scroll_responsive ) ? $settings->slides_to_scroll_responsive : '1'; ?>,
		equal_height_box: '<?php echo $settings->equal_height; ?>',
		skin_type: '<?php echo $settings->_skin; ?>',
		next_arrow: '<?php echo apply_filters( 'uabb_business_reviews_carousel_next_arrow_icon', 'fas fa-angle-right' ); ?>',
		prev_arrow: '<?php echo apply_filters( 'uabb_business_reviews_carousel_previous_arrow_icon', 'fas fa-angle-left' ); ?>'
	});

});
