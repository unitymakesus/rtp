<?php
/**
 *  Registration Form Module file
 *
 *  @package Registration Form Module
 */

?>
jQuery(document).ready(function() {
	new UABBRegistrationFormModule({
		id: '<?php echo $id; ?>',
		uabb_ajaxurl: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
		check_password_strength: '<?php echo $settings->check_password_strength; ?>',
		redirect_after_register: '<?php echo $settings->redirect_after_register; ?>',
		redirect_after_link: '<?php echo $settings->redirect_after_link; ?>',
		recaptcha_version: '<?php echo $settings->uabb_recaptcha_version; ?>',
	});
});
