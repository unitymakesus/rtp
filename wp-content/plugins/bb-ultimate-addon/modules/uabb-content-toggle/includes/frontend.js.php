<?php
/**
 * UABB Content Toggle Module front-end JS php file
 *
 *   @package UABB Content Toggle Module
 */

?>

jQuery(document).ready(function(){
	new UABBContentToggle({
		id: '<?php echo $id; ?>',
		select_switch_style: '<?php echo $settings->select_switch_style; ?>',
		content1_section: '<?php echo $settings->cont1_section; ?>',
		content2_section: '<?php echo $settings->cont2_section; ?>',
	});
});
