<?php
/**
 *  UABB Image Icon Module front-end Js php file
 *
 *  @package UABB Image Icon Module
 */

?>
jQuery(function($) {
	$(function() {
		$( '.fl-node-<?php echo $id; ?> .uabb-photo-img' )
			.on( 'mouseenter', function( e ) {
				$( this ).data( 'title', $( this ).attr( 'title' ) ).removeAttr( 'title' );
			} )
			.on( 'mouseleave', function( e ){
				$( this ).attr( 'title', $( this ).data( 'title' ) ).data( 'title', null );
			} );
	});
});
