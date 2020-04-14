<?php
/**
 *  UABB Counter Module front-end JS php file
 *
 *  @package UABB Counter Module
 */

// set defaults.
$settings->number = trim( $settings->number );
$layout           = isset( $settings->layout ) ? $settings->layout : 'default';
$number_type      = isset( $settings->number_type ) ? $settings->number_type : 'percent';
$number_format    = isset( $settings->number_format ) ? $settings->number_format : 'comma';
$number_locale    = get_locale();
$speed            = ! empty( $settings->animation_speed ) && is_numeric( $settings->animation_speed ) ? $settings->animation_speed * 1000 : 1000;
$number           = ! empty( $settings->number ) && is_numeric( $settings->number ) ? $settings->number : 100;
$max              = ! empty( $settings->max_number ) && is_numeric( $settings->max_number ) ? $settings->max_number : $number;
$delay            = ! empty( $settings->delay ) && is_numeric( $settings->delay ) ? $settings->delay : 1;

?>

(function($) {

	$(function() {

		new UABBNumber({
			id: '<?php echo esc_attr( $id ); ?>',
			layout: '<?php echo esc_attr( $layout ); ?>',
			type: '<?php echo esc_attr( $number_type ); ?>',
			number: <?php echo esc_attr( $number ); ?>,
			numberFormat: '<?php echo esc_attr( $number_format ); ?>',
			locale: '<?php echo esc_attr( $number_locale ); ?>',
			max: <?php echo esc_attr( $max ); ?>,
			speed: <?php echo esc_attr( $speed ); ?>,
			delay: <?php echo esc_attr( $delay ); ?>,
		});

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo esc_attr( $id ); ?>',
				layout: '<?php echo esc_attr( $layout ); ?>',
				type: '<?php echo esc_attr( $number_type ); ?>',
				number: <?php echo esc_attr( $number ); ?>,
				max: <?php echo esc_attr( $max ); ?>,
				speed: <?php echo esc_attr( $speed ); ?>,
				delay: <?php echo esc_attr( $delay ); ?>,
			});
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo esc_attr( $id ); ?>',
				layout: '<?php echo esc_attr( $layout ); ?>',
				type: '<?php echo esc_attr( $number_type ); ?>',
				number: <?php echo esc_attr( $number ); ?>,
				max: <?php echo esc_attr( $max ); ?>,
				speed: <?php echo esc_attr( $speed ); ?>,
				delay: <?php echo esc_attr( $delay ); ?>,
			});
		});

		/* Modal Click Trigger */
		UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo esc_attr( $id ); ?>',
				layout: '<?php echo esc_attr( $layout ); ?>',
				type: '<?php echo esc_attr( $number_type ); ?>',
				number: <?php echo esc_attr( $number ); ?>,
				max: <?php echo esc_attr( $max ); ?>,
				speed: <?php echo esc_attr( $speed ); ?>,
				delay: <?php echo esc_attr( $delay ); ?>,
			});
		});

	});

})(jQuery);
