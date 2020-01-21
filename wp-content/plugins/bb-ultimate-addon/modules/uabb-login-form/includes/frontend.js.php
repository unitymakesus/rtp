<?php
/**
 *  Frontend CSS php file for Login Form Module.
 *
 *  @package UABB Login Form Module Frontend.css.php file.
 */

$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

if ( is_array( $uabb_setting_options ) ) {

	$uabb_social_google_redirect_url   = ( array_key_exists( 'uabb-social-google-redirect-url', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-google-redirect-url'] : '';
	$uabb_social_facebook_redirect_url = ( array_key_exists( 'uabb-social-facebook-redirect-url', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-facebook-redirect-url'] : '';
	$uabb_social_facebook_app_id       = ( array_key_exists( 'uabb-social-facebook-app-id', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-facebook-app-id'] : '';
	$uabb_social_google_client_id      = ( array_key_exists( 'uabb-social-google-client-id', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-social-google-client-id'] : '';
}

?>
(function($) {
	$(function() {
		new UABBLoginForm({
		id: "<?php echo esc_attr( $id ); ?>",
		uabb_lf_ajaxurl: "<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>",
		uabb_lf_settings_url: "<?php echo esc_url( admin_url( 'options-general.php?page=uabb-builder-settings#uabb-social' ) ); ?>",
		uabb_lf_wp_form_redirect_toggle: "<?php echo esc_attr( $settings->wp_login_redirect_select ); ?>",
		uabb_lf_wp_form_redirect_login_url: "<?php echo esc_url( $settings->login_redirect_url ); ?>",	
		uabb_lf_dashboard_url: "<?php echo esc_url( get_dashboard_url() ); ?>", 
		uabb_lf_google_redirect_url: "<?php echo ! empty( $uabb_social_google_redirect_url ) ? esc_url( $uabb_social_google_redirect_url ) : ''; ?>",
		uabb_lf_facebook_redirect_url: "<?php echo ! empty( $uabb_social_facebook_redirect_url ) ? esc_url( $uabb_social_facebook_redirect_url ) : ''; ?>",
		uabb_social_facebook_app_id: "<?php echo ! empty( $uabb_social_facebook_app_id ) ? esc_attr( $uabb_social_facebook_app_id ) : ''; ?>",
		uabb_social_google_client_id: "<?php echo ! empty( $uabb_social_google_client_id ) ? esc_attr( $uabb_social_google_client_id ) : ''; ?>",
		google_login_select: "<?php echo ! empty( $settings->google_login_select ) ? esc_attr( $settings->google_login_select ) : ''; ?>",
		facebook_login_select: "<?php echo ! empty( $settings->facebook_login_select ) ? esc_attr( $settings->facebook_login_select ) : ''; ?>",	
		uabb_lf_username_empty_err_msg: "<?php _e( 'Error: The Username field should not be Empty.', 'uabb' ); ?>",
		uabb_lf_password_empty_err_msg: "<?php _e( 'Error: The Password field should not be Empty.', 'uabb' ); ?>",
		uabb_lf_both_empty_err_msg: "<?php _e( 'Error: The Username and Password fields should not be Empty.', 'uabb' ); ?>",
		uabb_lf_username_invalid_err_msg: "<?php _e( 'Error: The Username you have entered is Invalid', 'uabb' ); ?>",
		uabb_lf_password_invalid_err_msg: "<?php _e( 'Error: The Password you have entered is Invalid.', 'uabb' ); ?>"
		});
	});

})(jQuery);
