<?php
/**
 *  UABB Before After Slider Module front-end JS php file
 *
 *  @package UABB Before After Slider Module
 */

?>

(function($) {

	var document_width, document_height;

	var args = {
			id : '<?php echo $id; ?>',
			before_after_orientation : '<?php echo $settings->before_after_orientation; ?>',
			initial_offset : '<?php echo $settings->initial_offset; ?>',
			move_on_hover : '<?php echo $settings->move_on_hover; ?>',
		};


	jQuery(document).ready(function($){

		document_width = jQuery( document ).width();
		document_height = jQuery( document ).height();

		new UABBBeforeAfterSlider( args );
		jQuery(window).trigger('resize');

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			var child_id = jQuery( selector + ' .fl-module-uabb-beforeafterslider' ).data('node');

			if( child_id != '' ) {

				jQuery(window).trigger('resize');
			}
		});

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {

			var child_id = jQuery( selector + ' .fl-module-uabb-beforeafterslider' ).data('node');

			if( '' != child_id ) {

				jQuery(window).trigger('resize');
			}
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {

			var child_id = jQuery( selector + ' .fl-module-uabb-beforeafterslider' ).data('node');

			if( '' != child_id ) {

				jQuery(window).trigger('resize');
			}

		});
	});

	jQuery(window).load(function() {

		setTimeout(function(){

			new UABBBeforeAfterSlider( args );
			jQuery(window).trigger('resize');

		}, 500);

	});

	jQuery(window).resize(function(){

		if( document_width != jQuery( document ).width() || document_height != jQuery( document ).height() ) {

			document_width = jQuery( document ).width();
			document_height = jQuery( document ).height();

			jQuery( ".baslider-<?php echo $id; ?>" ).css( 'width', '' );
			jQuery( ".baslider-<?php echo $id; ?>" ).css( 'height', '' );

			max = -1;
			jQuery( ".baslider-<?php echo $id; ?> img" ).each(function() {
				if( max < jQuery(this).width() ) {
					max = jQuery(this).width();
				}
			});
			jQuery( ".baslider-<?php echo $id; ?>" ).css( 'width', max + 'px' );
		}

	});

	new UABBBeforeAfterSlider( args );
	jQuery(window).trigger('resize');

})( jQuery );
