<?php
/**
 *  UABB Counter Module front-end JS php file
 *
 *  @package UABB Counter Module
 */

// set defaults.
$settings->number = trim( $settings->number );
$layout           = isset( $settings->layout ) ? $settings->layout : 'default';
$type             = isset( $settings->number_type ) ? $settings->number_type : 'percent';
$number_format    = isset( $settings->number_format ) ? $settings->number_format : 'comma';
$locale           = get_locale();
$speed            = ! empty( $settings->animation_speed ) && is_numeric( $settings->animation_speed ) ? $settings->animation_speed * 1000 : 1000;
$number           = ! empty( $settings->number ) && is_numeric( $settings->number ) ? $settings->number : 100;
$max              = ! empty( $settings->max_number ) && is_numeric( $settings->max_number ) ? $settings->max_number : $number;
$delay            = ! empty( $settings->delay ) && is_numeric( $settings->delay ) ? $settings->delay : 1;

?>

(function($) {

	$(function() {

		new UABBNumber({
			id: '<?php echo $id; ?>',
			layout: '<?php echo $layout; ?>',
			type: '<?php echo $type; ?>',
			number: <?php echo $number; ?>,
			numberFormat: '<?php echo $number_format; ?>',
			locale: '<?php echo $locale; ?>',
			max: <?php echo $max; ?>,
			speed: <?php echo $speed; ?>,
			delay: <?php echo $delay; ?>,
		});

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo $id; ?>',
				layout: '<?php echo $layout; ?>',
				type: '<?php echo $type; ?>',
				number: <?php echo $number; ?>,
				max: <?php echo $max; ?>,
				speed: <?php echo $speed; ?>,
				delay: <?php echo $delay; ?>,
			});
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo $id; ?>',
				layout: '<?php echo $layout; ?>',
				type: '<?php echo $type; ?>',
				number: <?php echo $number; ?>,
				max: <?php echo $max; ?>,
				speed: <?php echo $speed; ?>,
				delay: <?php echo $delay; ?>,
			});
		});

		/* Modal Click Trigger */
		UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {
			new UABBNumber({
				id: '<?php echo $id; ?>',
				layout: '<?php echo $layout; ?>',
				type: '<?php echo $type; ?>',
				number: <?php echo $number; ?>,
				max: <?php echo $max; ?>,
				speed: <?php echo $speed; ?>,
				delay: <?php echo $delay; ?>,
			});
		});

	});

})(jQuery);
