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

			id: "<?php echo esc_attr( $id ); ?>",
			uabb_ajaxurl: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
			name_required: "<?php echo esc_attr( $settings->name_required ); ?>",
			email_required: "<?php echo esc_attr( $settings->email_required ); ?>",
			subject_required: "<?php echo esc_attr( $settings->subject_required ); ?>",
			phone_required: "<?php echo esc_attr( $settings->phone_required ); ?>",
			msg_required: "<?php echo esc_attr( $settings->msg_required ); ?>",
			msg_toggle: "<?php echo esc_attr( $settings->msg_toggle ); ?>",
			button_text: "<?php echo esc_attr( $settings->btn_text ); ?>",
			recaptcha_version: '<?php echo esc_attr( $settings->uabb_recaptcha_version ); ?>',
		});
	});
})(jQuery);
