<?php
/**
 * UABB Content Toggle Module front-end JS php file
 *
 *   @package UABB Content Toggle Module
 */

?>

jQuery(document).ready(function(){
	new UABBContentToggle({
		id: '<?php echo esc_attr( $id ); ?>',
		select_switch_style: '<?php echo esc_attr( $settings->select_switch_style ); ?>',
		content1_section: '<?php echo esc_attr( $settings->cont1_section ); ?>',
		content2_section: '<?php echo esc_attr( $settings->cont2_section ); ?>',
	});
});
