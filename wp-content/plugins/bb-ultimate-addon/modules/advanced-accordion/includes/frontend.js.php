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
			id: '<?php echo $id; ?>',
			close_icon: ' <?php $words = explode( ' ', $settings->close_icon ); $lastWord = end( $words ); echo $settings->close_icon; ?>',
			open_icon: '<?php $words = explode( ' ', $settings->open_icon ); $lastWord = end( $words ); echo $settings->open_icon; ?> ',
			icon_animation: '<?php echo $settings->icon_animation; ?>',
			enable_first: '<?php echo $settings->enable_first; ?>',
		});
	});

	var hashval = window.location.hash,
		hashvalarr = hashval.split( "-" ),
		dataindex = hashvalarr[hashvalarr.length-1],
		tab_id = hashval.replace( '-' + dataindex, '' );
	if( tab_id != '' ) {
		if( jQuery( tab_id ).length > 0 ) {
			if( jQuery(tab_id).find( '.uabb-adv-accordion > .uabb-adv-accordion-item[data-index="' + dataindex + '"]' ) ) {

				jQuery('html, body').animate({
					scrollTop: jQuery( tab_id ).offset().top - 250
				}, 1000);
				var enable_first = '<?php echo $settings->enable_first; ?>';
				if( !( parseInt( dataindex ) == 0 && enable_first == 'yes' ) ) {
					setTimeout(function(){
						jQuery( tab_id + ' .uabb-adv-accordion-button' ).eq(dataindex).trigger('click');
					}, 1000);
				}
			}
		}
	}
	
})(jQuery);
