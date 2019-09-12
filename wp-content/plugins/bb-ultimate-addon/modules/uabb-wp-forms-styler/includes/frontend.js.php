<?php
/**
 *  UABB WP Forms Styler Module front-end js php file
 *
 * @package UABB WP Forms Styler Module
 */

?>
jQuery(document).ready(function() {

	nodeClass = '.fl-node-<?php echo $id; ?>';

	if ( ! jQuery( nodeClass + ' .uabb-wpf-styler .wpforms-container').hasClass( 'inline-fields' ) ) {
		jQuery( nodeClass + ' .uabb-wpf-styler .wpforms-container .wpforms-field-container').css( 'width', '100%' );
	}

});
