<?php
/**
 *  UABB Caldera Forms Styler Module front-end JS php file.
 *
 *  @package UABB Caldera Forms Styler Module.
 */

?>

(function($) {
	$(function() {
		new UABBCalderaFormsStyler({
			id: "<?php echo esc_attr( $id ); ?>",
			error_msg_position: "<?php echo esc_attr( $settings->error_msg_position ); ?>",
		});
	});

})(jQuery);
