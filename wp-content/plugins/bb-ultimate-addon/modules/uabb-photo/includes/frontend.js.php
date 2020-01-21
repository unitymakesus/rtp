<?php
/**
 *  UABB Photo Module file
 *
 *  @package UABB Photo Module
 */

?>

<?php if ( 'lightbox' == $settings->link_type ) : ?>
jQuery(function() {
	jQuery('.fl-node-<?php echo $id; ?> a').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false
	});
});
<?php endif; ?>
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
