<?php
/**
 * Social Form Settings
 *
 * @package Social Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );
?>
<div id="fl-uabb-social-form" class="fl-settings-form uabb-social-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'Social Login', 'uabb' ); ?></h3>

	<form id="uabb-social-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-social' ); ?>" method="post">
		<div class="fl-settings-form-content">
			<?php
			$uabb = BB_Ultimate_Addon_Helper::get_builder_uabb();

			if ( is_array( $uabb ) ) {

				$uabb_social_google_client_id      = ( array_key_exists( 'uabb-social-google-client-id', $uabb ) ) ? $uabb['uabb-social-google-client-id'] : '';
				$uabb_social_facebook_app_id       = ( array_key_exists( 'uabb-social-facebook-app-id', $uabb ) ) ? $uabb['uabb-social-facebook-app-id'] : '';
				$uabb_social_facebook_app_secret   = ( array_key_exists( 'uabb-social-facebook-app-secret', $uabb ) ) ? $uabb['uabb-social-facebook-app-secret'] : '';
				$uabb_social_google_redirect_url   = ( array_key_exists( 'uabb-social-google-redirect-url', $uabb ) ) ? $uabb['uabb-social-google-redirect-url'] : '';
				$uabb_social_facebook_redirect_url = ( array_key_exists( 'uabb-social-facebook-redirect-url', $uabb ) ) ? $uabb['uabb-social-facebook-redirect-url'] : '';
			}
			?>
			<div class="uabb-form-setting">
				<h4><?php _e( 'Google', 'uabb' ); ?></h4>
					<p class="uabb-admin-help">
						<?php _e( 'If you wish to enable Google login option with Login Form Module, enter your client ID below.', 'uabb' ); ?>
						<?php
						if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
							_e( 'Refer', 'uabb' );
							?>
							<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/create-google-client-id-for-login-form-module/?utm_source=uabb-pro-dashboard&utm_medium=social-settings-screen&utm_campaign=login-form"><?php _e( 'article', 'uabb' ); ?></a>
							<?php _e( 'to get client ID.', 'uabb' ); ?>
							</p>
							<?php
						endif;
						?>
					</p>
					<p class="uabb-admin-help"><?php _e( 'Client ID', 'uabb' ); ?></p>		
					<input type="text" class="regular-text uabb-social-google-client-id" name="uabb-social-google-client-id" value="<?php echo $uabb_social_google_client_id; ?>" /><br/>
					<label class="uabb-social-error uabb-social-google-id-err"><?php _e( 'This field is required.', 'uabb' ); ?></label><br/>
					<p class="uabb-admin-help">
						<?php _e( 'Set a link to redirect the user after a successful login.', 'uabb' ); ?>
					</p>
					<p class="uabb-admin-help">
						<?php _e( 'Note: Because of security reasons, you can ONLY use your current domain here.', 'uabb' ); ?>	
					</p>
					<p class="uabb-admin-help"><?php _e( 'Redirect URL', 'uabb' ); ?></p>		
					<input type="text" class="regular-text uabb-social-google-redirect-url" name="uabb-social-google-redirect-url" value="<?php echo $uabb_social_google_redirect_url; ?>" /><br/>
					<label class="uabb-social-error uabb-social-google-url-err"><?php _e( 'This field is required.', 'uabb' ); ?></label><br/>
			</div>
			<br/><hr/>
			<div class="uabb-form-setting">
				<h4><?php _e( 'Facebook', 'uabb' ); ?></h4>
					<p class="uabb-admin-help">
						<?php _e( 'If you wish to enable Facebook login option with Login Form Module, enter your APP ID below.', 'uabb' ); ?>
						<?php
						if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
							_e( 'Refer', 'uabb' );
							?>
							<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/create-facebook-app-id-for-login-form-module/?utm_source=uabb-pro-dashboard&utm_medium=social-settings-screen&utm_campaign=login-form"><?php _e( 'article', 'uabb' ); ?></a>
							<?php _e( 'to get APP ID.', 'uabb' ); ?>
							</p>
							<?php
						endif;
						?>
					</p>
					<p class="uabb-admin-help"><?php _e( 'App ID', 'uabb' ); ?></p>	
					<input type="text" class="regular-text uabb-social-facebook-app-id" name="uabb-social-facebook-app-id" value="<?php echo $uabb_social_facebook_app_id; ?>" /><br/>
					<label class="uabb-social-error uabb-social-facebook-id-err"><?php _e( 'This field is required.', 'uabb' ); ?></label><br/>
					<p class="uabb-admin-help">
						<?php
						if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
							_e( 'Refer', 'uabb' );
							?>
							<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/create-facebook-app-id-for-login-form-module/#step-3:-how-to-get-the-app-secret-id-/?utm_source=uabb-pro-dashboard&utm_medium=social-settings-screen&utm_campaign=login-form"><?php _e( 'article', 'uabb' ); ?></a>
							<?php _e( 'to get APP Secret.', 'uabb' ); ?>
							</p>
							<?php
						endif;
						?>
					</p>
					<p class="uabb-admin-help"><?php _e( 'App Secret', 'uabb' ); ?></p>	
					<input type="text" class="regular-text uabb-social-facebook-app-secret" name="uabb-social-facebook-app-secret" value="<?php echo $uabb_social_facebook_app_secret; ?>" /><br/>
					<label class="uabb-social-error uabb-social-facebook-secret-err"><?php _e( 'This field is required.', 'uabb' ); ?></label><br/>
					<p class="uabb-admin-help">
						<?php _e( 'Set a link to redirect the user after a successful login.', 'uabb' ); ?>
					</p>
					<p class="uabb-admin-help">
						<?php _e( 'Note: Because of security reasons, you can ONLY use your current domain here.', 'uabb' ); ?>	
					</p>
					<p class="uabb-admin-help"><?php _e( 'Redirect URL', 'uabb' ); ?></p>		
					<input type="text" class="regular-text uabb-social-facebook-redirect-url" name="uabb-social-facebook-redirect-url" value="<?php echo $uabb_social_facebook_redirect_url; ?>" /><br/>
					<label class="uabb-social-error uabb-social-facebook-url-err"><?php _e( 'This field is required.', 'uabb' ); ?></label><br/>
			</div>
			<p class="submit">
				<input type="submit" id="uabb-lf-settings-submit" name="fl-save-uabb" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
			</p>

		<?php wp_nonce_field( 'uabb', 'fl-uabb-social-nonce' ); ?>
		</div>
	</form>
</div>

