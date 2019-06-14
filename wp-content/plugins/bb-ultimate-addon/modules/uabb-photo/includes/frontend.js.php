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
