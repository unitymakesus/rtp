<?php
/**
 *  UABB Image Carousel Module front-end JS php file
 *
 *  @package UABB Image Carousel Module
 */

?>

jQuery(document).ready(function( $ ) {
	var args = {
			id: '<?php echo $id; ?>',
			infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
			arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,

			desktop: <?php echo $settings->grid_column; ?>,
			medium: <?php echo $settings->medium_grid_column; ?>,
			small: <?php echo $settings->responsive_grid_column; ?>,

			slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
			autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
			autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
			small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
			medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
			next_arrow: '<?php echo apply_filters( 'uabb_image_carousel_next_arrow_icon', 'fas fa-angle-right' ); ?>',
			prev_arrow: '<?php echo apply_filters( 'uabb_image_carousel_previous_arrow_icon', 'fas fa-angle-left' ); ?>'
		};

	UABBImageCarousel_<?php echo $id; ?> = new UABBImageCarousel( args );

	$(window).on("load", function() {
		UABBImageCarousel_<?php echo $id; ?>._adaptiveImageHeight();
	});

	var UABBImageCarouselResize_<?php echo $id; ?>;
	$( window ).resize(function() {

		clearTimeout( UABBImageCarouselResize_<?php echo $id; ?> );
		UABBImageCarouselResize_<?php echo $id; ?> = setTimeout( UABBImageCarousel_<?php echo $id; ?>._adaptiveImageHeight, 500);
	});

	<?php if ( 'lightbox' == $settings->click_action ) : ?>
	$('.fl-node-<?php echo $id; ?> .uabb-image-carousel').magnificPopup({
		delegate: '.uabb-image-carousel-content a',
		closeBtnInside: false,
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
		},
		'image': {
			titleSrc: function(item) {
				<?php if ( 'below' == $settings->show_captions ) : ?>
					return item.el.data('caption');
				<?php elseif ( 'hover' == $settings->show_captions ) : ?>
					return item.el.data('caption');
				<?php endif; ?>
			}
		}
	});
	<?php endif; ?>
	$(function() {
		$( '.fl-node-<?php echo $id; ?> .uabb-gallery-img' )
			.on( 'mouseenter', function( e ) {
				$( this ).data( 'title', $( this ).attr( 'title' ) ).removeAttr( 'title' );
			} )
			.on( 'mouseleave', function( e ){
				$( this ).attr( 'title', $( this ).data( 'title' ) ).data( 'title', null );
			} );
	});

});
