<?php
/**
 *  Registration Form Module file
 *
 *  @package Registration Form Module
 */

$uabb_password_match_error_message = apply_filters( 'uabb_reg_form_password_match_error_message', __( 'The specified password do not match!', 'uabb' ) );
$uabb_email_invalid_error_message  = apply_filters( 'uabb_reg_form_email_invalid_error_message', __( 'Email Invalid', 'uabb' ) );
$uabb_required_field_error_message = apply_filters( 'uabb_reg_form_required_field_error_message', __( 'This Field is required', 'uabb' ) );
?>
jQuery(document).ready(function() {
	new UABBRegistrationFormModule({
		id: '<?php echo $id; ?>',
		uabb_ajaxurl: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
		check_password_strength: '<?php echo $settings->check_password_strength; ?>',
		redirect_after_register: '<?php echo $settings->redirect_after_register; ?>',
		redirect_after_link: '<?php echo $settings->redirect_after_link; ?>',
		recaptcha_version: '<?php echo $settings->uabb_recaptcha_version; ?>',
		password_match_err_msg: '<?php echo esc_attr( $uabb_password_match_error_message ); ?>',
		email_invalid_err_msg: '<?php echo esc_attr( $uabb_email_invalid_error_message ); ?>',
		required_field_err_msg: '<?php echo esc_attr( $uabb_required_field_error_message ); ?>',
	});
});
