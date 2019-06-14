<?php
/**
 *  UABB Contact Form Module front-end JS php file
 *
 * @package UABB Contact Form Module
 */

?>

(function($) {

	$(function() {

		new UABBContactForm({
			id: "<?php echo $id; ?>",
			uabb_ajaxurl: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			name_required: "<?php echo $settings->name_required; ?>",
			email_required: "<?php echo $settings->email_required; ?>",
			subject_required: "<?php echo $settings->subject_required; ?>",
			phone_required: "<?php echo $settings->phone_required; ?>",
			msg_required: "<?php echo $settings->msg_required; ?>",
			button_text: "<?php echo $settings->btn_text; ?>"
		});
	});

})(jQuery);
