<?php
/**
 *  UABB Gravity Form Module front-end JS php file
 *
 *  @package UABB Gravity Form Module
 */

?>

jQuery(document).ready(function() {
	new UABBGravityFormModule ({
		id: '<?php echo esc_attr( $id ); ?>',
		form_ajax: '<?php echo esc_attr( $settings->form_ajax_option ); ?>',

		});

});
