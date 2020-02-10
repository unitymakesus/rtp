<?php
/**
 *  UABB Advanced Accordion front-end JS php file
 *
 *  @package UABB Advanced Accordion
 */

?>

(function($) {

	$(function() {

		new UABBAdvAccordion({
			id: '<?php echo esc_attr( $id ); ?>',
			close_icon: ' <?php $words = explode( ' ', $settings->close_icon ); $last_word = end( $words ); echo esc_attr( $settings->close_icon ); // @codingStandardsIgnoreLine. ?>',
			open_icon: '<?php $words = explode( ' ', $settings->open_icon ); $last_word = end( $words ); echo esc_attr( $settings->open_icon ); // @codingStandardsIgnoreLine. ?> ',
			icon_animation: '<?php echo esc_attr( $settings->icon_animation ); ?>',
			enable_first: '<?php echo esc_attr( $settings->enable_first ); ?>',
		});
	});

	<?php // Regexp for validating user input as ID : https://regex101.com/r/KGj6I6/1. ?>
	var pattern = new RegExp('^[\\w\\-]+$');

	var hashval = window.location.hash.substring(1);

	if ( pattern.test( hashval ) ) {

		var hashval_last_index = hashval.lastIndexOf('-');

		var tab_id = hashval.slice(0,hashval_last_index);

		var dataindex = hashval.slice(hashval_last_index+1 , hashval.length);

		if( tab_id !== '' ) {

		var tab_id = "#" + tab_id;

			if( jQuery( tab_id ).length > 0 ) {
				if( jQuery(tab_id).find( '.uabb-adv-accordion > .uabb-adv-accordion-item[data-index="' + dataindex + '"]' ) ) {

					jQuery('html, body').animate({
						scrollTop: jQuery( tab_id ).offset().top - 250
					}, 1000);
					var enable_first = '<?php echo esc_attr( $settings->enable_first ); ?>';
					if( !( parseInt( dataindex ) === 0 && enable_first === 'yes' ) ) {
						setTimeout(function(){
							jQuery( tab_id + ' .uabb-adv-accordion-button' ).eq(dataindex).trigger('click');
						}, 1000);
					}
				}
			}
		}
	}

})(jQuery);
