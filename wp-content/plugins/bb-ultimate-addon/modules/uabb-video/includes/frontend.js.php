<?php
/**
 *  UABB Video Module front-end JS php file
 *
 *  @package UABB Video Module
 */

?>
jQuery(document).ready(function() {
	new UABBVideo({
		id: '<?php echo $id; ?>',
	});
});
