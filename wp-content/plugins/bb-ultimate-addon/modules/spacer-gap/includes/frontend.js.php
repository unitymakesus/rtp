<?php
/**
 *  UABB Spacer Gap Module front-end JS php file
 *
 *  @package UABB Spacer Gap Module
 */

?>
jQuery(document).ready(function(){
	new UABBSpacerGap({
		id: '<?php echo esc_attr( $id ); ?>',
		desktop_space: '<?php echo esc_attr( $settings->desktop_space ); ?>',
		medium_device: '<?php echo esc_attr( $settings->medium_device ); ?>',
		small_device: '<?php echo esc_attr( $settings->small_device ); ?>',
	});
});
