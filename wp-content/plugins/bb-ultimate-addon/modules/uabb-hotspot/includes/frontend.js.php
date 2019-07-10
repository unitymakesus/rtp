<?php
/**
 *  UABB Heading Module front-end JS php file.
 *
 *  @package UABB Heading Module.
 */

?>
(function($) {
	var document_width, document_height;
	// start the jquery function 
	jQuery(document).ready( function() {
	document_width  = $( document ).width();
	document_height = $( document ).height();
		<?php
		$photo_src = ( 'url' != $settings->photo_source ) ? ( ( isset( $settings->photo_src ) && '' != $settings->photo_src ) ? $settings->photo_src : '' ) : ( ( '' != $settings->photo_url ) ? $settings->photo_url : '' );

		if ( isset( $photo_src ) ) {
			if ( '' != $photo_src ) {
				if ( 'yes' === $settings->hotspot_tour ) {

					$interval = $settings->tour_interval;
					if ( empty( $interval ) ) {
						$tour_interval = 4000;
					} else {
						$tour_interval = $interval * 1000;
					}
					?>
					new UABB_Hotspot({
						node            : '<?php echo $id; ?>',
						hotspot_tour	: '<?php echo $settings->hotspot_tour; ?>',
						repeat			: '<?php echo $settings->hotspot_tour_repeat; ?>',
						action_autoplay : '<?php echo $settings->autoplay_options; ?>', 
						autoplay        : '<?php echo $settings->hotspot_tour_autoplay; ?>',  
						length          : '<?php echo count( $settings->hotspot_marker ); ?>',
						isElEditMode    : '<?php echo FLBuilderModel::is_builder_active(); ?>',
						tour_interval	: '<?php echo $tour_interval; ?>',
						overlay     	: '<?php echo ( 'click' == $settings->autoplay_options ) ? 'yes' : 'no'; ?>',
					});
					<?PHP

				} elseif ( count( $settings->hotspot_marker ) > 0 ) {
					for ( $i = 0; $i < count( $settings->hotspot_marker ); $i++ ) {

						if ( 'hover' == $settings->hotspot_marker[ $i ]->tooltip_trigger_on ) {

							if ( 'text' != $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
								?>
								jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-wrap .uabb-imgicon-wrap').hover(function(event){
									event.stopPropagation();

									var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');
								   
									selector.addClass('uabb-hotspot-hover');		

								}, function(event) {
									event.stopPropagation();

									var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');

									selector.removeClass('uabb-hotspot-hover');				
								});
								<?php
							} else {
								?>

								jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-wrap').hover(function(event){
									event.stopPropagation();

									var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');
									selector.addClass('uabb-hotspot-hover');

								}, function(event) {
									event.stopPropagation();

									var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');

									selector.removeClass('uabb-hotspot-hover');

								});
								<?php
							}
						} elseif ( 'always' === $settings->hotspot_marker[ $i ]->tooltip_trigger_on ) {
							?>
							var selector = jQuery( '.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>' );
							if ( selector.hasClass( 'uabb-hotspot-hover' ) ) {
								selector.removeClass('uabb-hotspot-hover');
							} else {
								selector.addClass('uabb-hotspot-hover');
							}
						<?php
						} elseif ( 'click' === $settings->hotspot_marker[ $i ]->tooltip_trigger_on ) {

							if ( 'text' != $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
								?>
								jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-wrap .uabb-imgicon-wrap').click(function(event){
									event.stopPropagation();

									var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');

									if( selector.hasClass( 'uabb-hotspot-hover' ) ){
										selector.removeClass('uabb-hotspot-hover');
									} else {
										selector.addClass('uabb-hotspot-hover');
									}

								});
								<?php
							} else {
								?>
							jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-wrap').click(function(event){
								event.stopPropagation();

								var selector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>');

								if( selector.hasClass( 'uabb-hotspot-hover' ) ){
									selector.removeClass('uabb-hotspot-hover');
								} else {
									selector.addClass('uabb-hotspot-hover');
								}

							});
								<?php
							}
						}
						?>

						/* Code to hide all tooltip when clicked outside the element */
						<?php

						if ( 'always' !== $settings->hotspot_marker[ $i ]->tooltip_trigger_on ) {
						?>
						jQuery( 'body' ).click( function( event ) {
							if(  !jQuery(event.target).is('.fl-node-<?php echo $id; ?> .uabb-hotspot-item') && !jQuery(event.target).closest('.fl-node-<?php echo $id; ?> .uabb-hotspot-item').length ) {

								var bselector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item');

								if( bselector.hasClass( 'uabb-hotspot-hover' ) ){
									bselector.removeClass('uabb-hotspot-hover');
								}										
							}
						} );

						jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-wrap <?php echo ( 'text' != $settings->hotspot_marker[ $i ]->hotspot_marker_type ) ? '.uabb-imgicon-wrap' : ''; ?>').click(function(event){
							event.stopPropagation();

							var removeSelector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item').not(".fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>");

							removeSelector.removeClass('uabb-hotspot-hover');

						});
						<?php
						}
					}
				}
			}
		}
		?>

		responsiveTooltipShift();
	});

	jQuery(document).on("load", function() {
		document_width = $( document ).width();
		document_height = $( document ).height();
		responsiveTooltipShift();
	});

	jQuery(window).resize( function() {
		if( document_width != $( document ).width() || document_height != $( document ).height() ) {
			document_width = $( document ).width();
			document_height = $( document ).height();
			responsiveTooltipShift();
		}
	});

	function responsiveTooltipShift() {
		<?php
		$photo_src = ( 'url' != $settings->photo_source ) ? ( ( isset( $settings->photo_src ) && '' != $settings->photo_src ) ? $settings->photo_src : '' ) : ( ( '' != $settings->photo_url ) ? $settings->photo_url : '' );

		if ( isset( $photo_src ) ) {
			if ( '' != $photo_src ) {
				if ( count( $settings->hotspot_marker ) > 0 ) {
					for ( $i = 0; $i < count( $settings->hotspot_marker ); $i++ ) {
						?>
						var tooltip_style = '<?php echo $settings->hotspot_marker[ $i ]->tooltip_style; ?>',
							itemSelector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?>'),
							tooltip_content_position = '<?php echo $settings->hotspot_marker[ $i ]->tooltip_content_position; ?>',
							itemPosition = itemSelector.offset(),
							outerContainerWidth = window.innerWidth,
							tooltipSelector = jQuery('.fl-node-<?php echo $id; ?> .uabb-hotspot-item-<?php echo $i; ?> .uabb-hotspot-tooltip-content');

						var tooltipWidth = tooltipSelector.outerWidth(true);

						if( tooltip_style != 'round' ) {
							if( 'left' == tooltip_content_position ) {
								//console.log('left - '+itemPosition.left);
								if( itemPosition.left <= ( tooltipWidth + 5 ) ) {
									itemSelector.find('.uabb-hotspot-tooltip').removeClass('uabb-tooltip-left');
									itemSelector.find('.uabb-hotspot-tooltip').addClass('uabb-tooltip-right');
								} else {
									itemSelector.find('.uabb-hotspot-tooltip').removeClass('uabb-tooltip-right');
									itemSelector.find('.uabb-hotspot-tooltip').addClass('uabb-tooltip-left');
								}
							}
							if( tooltip_style == 'curved' ) {
								tooltipWidth += 42;
							}

							if( 'right' == tooltip_content_position ) {
								//console.log(tooltipWidth + 45);
								//console.log('right - '+( outerContainerWidth - itemPosition.left ));
								if( ( outerContainerWidth - itemPosition.left ) <= ( tooltipWidth + 45 ) ) {
									itemSelector.find('.uabb-hotspot-tooltip').removeClass('uabb-tooltip-right');
									itemSelector.find('.uabb-hotspot-tooltip').addClass('uabb-tooltip-left');
								} else {
									itemSelector.find('.uabb-hotspot-tooltip').removeClass('uabb-tooltip-left');
									itemSelector.find('.uabb-hotspot-tooltip').addClass('uabb-tooltip-right');
								}
							}
						}
						itemSelector = '';
						<?php
					}
				}
			}
		}
		?>
	}



})(jQuery);
