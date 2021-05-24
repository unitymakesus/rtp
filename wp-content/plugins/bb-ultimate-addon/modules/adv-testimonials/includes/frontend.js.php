<?php
/**
 * Render JavaScript to check function the various settings of module
 *
 * @package UABB Advanced Testimonials Module
 */

?>

(function($) {

var arrObj = new Array();

<?php
$next_arrow = apply_filters( 'uabb_testimonials_next_arrow_icon', 'fa fa-chevron-right' );
$prev_arrow = apply_filters( 'uabb_testimonials_previous_arrow_icon', 'fa fa-chevron-left' );

if ( 'slider' === $settings->tetimonial_layout ) {
	$settings->pause = ( '' !== trim( $settings->pause ) ) ? $settings->pause : '10';
	$settings->speed = ( '' !== trim( $settings->speed ) ) ? $settings->speed : '0.5';
	?>
	// Clear the controls in case they were already created.
	jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slider-next').empty();
	jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slider-prev').empty();

	// Create the slider.
	var testimonial_<?php echo esc_attr( $id ); ?> = jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-testimonials').bxSlider({
		autoStart : <?php echo esc_attr( $settings->auto_play ); ?>,
		auto : true,
		<?php if ( $settings->auto_play && $settings->auto_hover ) { ?>
		autoHover: true,
		<?php } ?>
		adaptiveHeight: <?php echo esc_attr( $settings->adaptive_height ); ?>,
		pause : <?php echo esc_attr( $settings->pause ) * 1000; ?>,
		mode : '<?php echo esc_attr( $settings->transition ); ?>',
		speed : <?php echo esc_attr( $settings->speed ) * 1000; ?>,
		pager : <?php echo ( 'wide' === $settings->navigation || 'compact-wide' === $settings->navigation ) ? 1 : 0; ?>,
		nextSelector : '.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slider-next',
		prevSelector : '.fl-node-<?php echo esc_attr( $id ); ?> .uabb-slider-prev',
		nextText: '<i class="<?php echo esc_attr( $next_arrow ); ?>"></i>',
		prevText: '<i class="<?php echo esc_attr( $prev_arrow ); ?>"></i>',
		controls : <?php echo ( 'compact' === $settings->navigation || 'compact-wide' === $settings->navigation ) ? 1 : 0; ?>,
		onSliderLoad: function() {
			jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-testimonials').addClass('uabb-testimonials-loaded');
		}
	});

	arrObj['testimonial_<?php echo esc_attr( $id ); ?>'] = testimonial_<?php echo esc_attr( $id ); ?>;


	/* Modal Click Trigger */
	UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {
		if(jQuery(selector).find('.uabb-testimonials') ){
			setTimeout(function() {
				testimonial_<?php echo esc_attr( $id ); ?>.reloadSlider();
			}, 250);
		}
	});

	/* Modal Click Trigger */
	UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
		if( jQuery(selector).find('.uabb-testimonials') ){
			setTimeout(function() {
				var child_id = jQuery(selector).find('.fl-module-adv-testimonials').data('node');
				if( child_id !== null && arrObj['testimonial_' + child_id] !== undefined ) {
					arrObj['testimonial_' + child_id].reloadSlider();
				}
			}, 250);
		}
	});

	/* Modal Click Trigger */
	UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
		if( jQuery(selector).find('.uabb-testimonials') ){
			setTimeout(function() {
				var child_id = jQuery(selector).find('.fl-module-adv-testimonials').data('node');
				if( child_id !== null && arrObj['testimonial_' + child_id] !== undefined ) {
					arrObj['testimonial_' + child_id].reloadSlider();
				}
			}, 250);
		}
	});

	jQuery(window).on('load', function() {
		testimonial_<?php echo esc_attr( $id ); ?>.reloadSlider();
	});
	<?php
}
?>
	<?php
	if ( 'box' === $settings->tetimonial_layout && 'yes' === $settings->icon_position_half_box && 'top' === $settings->testimonial_image_position ) {
		?>

		function testimonial_<?php echo esc_attr( $id ); ?>() {
			var testimonial_node_class = jQuery( '.fl-node-<?php echo esc_attr( $id ); ?>' ),
				image_height = testimonial_node_class.find('.uabb-testimonial-photo.uabb_half_top').innerHeight(),
				image_half_height = parseInt(image_height)/2,
				image_half_height_extra = image_half_height + 20;

				testimonial_node_class.find('.uabb-module-content.uabb_half_top').css( 'padding-top', image_half_height );
				testimonial_node_class.find('.uabb-testimonial-info.uabb_half_top').css( 'padding-top', image_half_height_extra );
		};

		jQuery(document).ready( function() {
			testimonial_<?php echo esc_attr( $id ); ?>();
		});

		jQuery(window).on('load', function() {
			testimonial_<?php echo esc_attr( $id ); ?>();
		});

		jQuery(window).resize(function() {
			testimonial_<?php echo esc_attr( $id ); ?>();
		});
		<?php
	}
	?>
})(jQuery);
