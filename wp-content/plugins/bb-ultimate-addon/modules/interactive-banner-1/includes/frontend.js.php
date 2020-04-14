<?php
/**
 *  UABB Interactive Banner 1 Module front-end JS php file
 *
 *  @package UABB Interactive Banner 1 Module
 */

$settings->image_size_compatibility = ( isset( $settings->image_size_compatibility ) ) ? $settings->image_size_compatibility : 'none'; ?>

(function ( $, window, undefined ) {
	$(window).on( 'load', function(a){
		jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block').each(function(index, value){
			<?php
			if ( 'custom' === $settings->banner_height_options && 'none' !== $settings->image_size_compatibility ) {
				if ( 'small' === $settings->image_size_compatibility ) {
					?>
			if( jQuery( document ).width() <= parseInt( '<?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>' ) ) {
				jQuery( this ).removeClass( "uabb-banner-block-custom-height" );
			}
					<?php
				}
				if ( 'medium' === $settings->image_size_compatibility ) {
					?>
			if( jQuery( document ).width() <= parseInt( '<?php echo esc_attr( $global_settings->medium_breakpoint ); ?>' ) ) {
				jQuery( this ).removeClass( "uabb-banner-block-custom-height" );
			}
					<?php
				}
			}
			?>

			if( jQuery( this ).hasClass( "uabb-banner-block-custom-height" ) ) {
				var heading_ht = jQuery(this).find('.uabb-ib1-title').outerHeight();
				var custom_ht = jQuery(this).outerHeight();
				var ht = ( custom_ht - heading_ht );
				jQuery(this).find(".uabb-background").css('height', ht);
				if( jQuery( this ).width() > jQuery( this ).height() ) {
					jQuery( this ).find('.uabb-image-wrap img').css( 'width', '100%' );
					jQuery( this ).find('.uabb-image-wrap img').css( 'height', 'auto' );
				}
			}

			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$(this).click(function(){
					//event.stopPropagation();
					if( jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block').hasClass( 'uabb-ib1-hover' ) ){
						jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block').removeClass('uabb-ib1-hover');
					} else {
						jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block').addClass('uabb-ib1-hover');
					}
				});
			}
		});
	});

	if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
		var is_touch_device = false;
	else
		var is_touch_device = true;

	if(!is_touch_device){
		jQuery('.uabb-ib1-block').hover(function(event){
			event.stopPropagation();
			jQuery(this).addClass('uabb-ib1-hover');
		},function(event){
			event.stopPropagation();
			jQuery(this).removeClass('uabb-ib1-hover');
		});
	}

	$(window).on( 'resize', function(a){
		jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ib1-block').each(function(index, value){
			<?php
			if ( 'custom' === $settings->banner_height_options && 'none' !== $settings->image_size_compatibility ) {
				if ( 'small' === $settings->image_size_compatibility ) {
					?>
			if( jQuery( document ).width() <= parseInt( '<?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>' ) ) {
				jQuery( this ).removeClass( "uabb-banner-block-custom-height" );
				jQuery( this ).find('.uabb-image-wrap img').css( 'width', '' );
				jQuery( this ).find('.uabb-image-wrap img').css( 'height', '' );
			} else {
				if( jQuery( this ).data('style') === 'custom' ) {
					jQuery( this ).addClass( "uabb-banner-block-custom-height" );
				}
			}
					<?php
				}
				if ( 'medium' === $settings->image_size_compatibility ) {
					?>
			if( jQuery( document ).width() <= parseInt( '<?php echo esc_attr( $global_settings->medium_breakpoint ); ?>' ) ) {
				jQuery( this ).removeClass( "uabb-banner-block-custom-height" );
				jQuery( this ).find('.uabb-image-wrap img').css( 'width', '' );
				jQuery( this ).find('.uabb-image-wrap img').css( 'height', '' );
			} else {
				if( jQuery( this ).data('style') === 'custom' ) {
					jQuery( this ).addClass( "uabb-banner-block-custom-height" );
				}
			}
					<?php
				}
			}
			?>

			if( jQuery( this ).hasClass( "uabb-banner-block-custom-height" ) ) {
				var heading_ht = jQuery(this).find('.uabb-ib1-title').outerHeight();
				var custom_ht = jQuery(this).outerHeight();
				var ht = ( custom_ht - heading_ht );
				jQuery(this).find(".uabb-background").css('height', ht);
				if( jQuery( this ).width() > jQuery( this ).height() ) {
					jQuery( this ).find('.uabb-image-wrap img').css( 'width', '100%' );
					jQuery( this ).find('.uabb-image-wrap img').css( 'height', 'auto' );
				} else {
					jQuery( this ).find('.uabb-image-wrap img').css( 'width', 'auto' );
					jQuery( this ).find('.uabb-image-wrap img').css( 'height', '100%' );
				}
			}
		});
	});

}(jQuery, window));
