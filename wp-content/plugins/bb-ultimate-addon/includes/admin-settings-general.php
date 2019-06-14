<?php
/**
 * General Settings Page
 *
 * @package UABB General Settings
 */

?>
<div id="fl-uabb-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e( 'General Settings', 'uabb' ); ?></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<?php

				$hidden_class        = '';
				$uabb                = BB_Ultimate_Addon_Helper::get_builder_uabb();
				$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
				$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

				$is_load_templates   = '';
				$is_load_panels      = '';
				$uabb_live_preview   = '';
				$uabb_google_map_api = '';
				$uabb_colorpicker    = '';
				$uabb_beta_updates   = '';

			if ( is_array( $uabb ) ) {
				$is_load_panels      = ( array_key_exists( 'load_panels', $uabb ) && 1 == $uabb['load_panels'] ) ? ' checked' : '';
				$uabb_live_preview   = ( array_key_exists( 'uabb-live-preview', $uabb ) && 1 == $uabb['uabb-live-preview'] ) ? ' checked' : '';
				$uabb_google_map_api = ( array_key_exists( 'uabb-google-map-api', $uabb ) ) ? $uabb['uabb-google-map-api'] : '';

				$uabb_beta_updates = ( array_key_exists( 'uabb-enable-beta-updates', $uabb ) && 1 == $uabb['uabb-enable-beta-updates'] ) ? ' checked' : '';
			}
			?>

			<?php
			if ( class_exists( 'FLBuilderUIContentPanel' ) ) {
				$hidden_class = 'uabb-hidden';
			}
			?>
			<!-- Load Panels -->
			<div class="uabb-form-setting <?php echo $hidden_class; ?>">
				<h4><?php _e( 'Enable UI Design', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php _e( 'Enable this setting for applying UI effects such as - Section panel, Search box etc. to frontend page builder. ', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						_e( 'Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/how-to-enable-disable-beaver-builders-ui/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=ui-design"><?php _e( 'this article', 'uabb' ); ?></a>
						<?php
						_e( ' for more information.', 'uabb' );
					endif;
					?>
				</p>
				<label>					
					<input type="checkbox" class="uabb-enabled-panels" name="uabb-enabled-panels" value="" <?php echo $is_load_panels; ?> ><?php _e( 'Enable UI Design', 'uabb' ); ?>
				</label>
			</div>

			<!-- Load Panels -->
			<div class="uabb-form-setting <?php echo $hidden_class; ?>">
				<h4><?php _e( 'Enable Live Preview', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php _e( 'Enable this setting to see live preview of a page without leaving the editor.', 'uabb' ); ?></p>
				<label>					
					<input type="checkbox" class="uabb-live-preview" name="uabb-live-preview" value="" <?php echo $uabb_live_preview; ?> ><?php _e( 'Enable Live Preview', 'uabb' ); ?>
				</label>
			</div>

			<!-- Beta Version -->
			<div class="uabb-form-setting">
				<h4><?php echo _e( 'Allow Beta Updates', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php _e( 'Enable this option to receive update notifications for beta versions.', 'uabb' ); ?></p>
				<label>					
					<input type="checkbox" class="uabb-enable-beta-updates" name="uabb-enable-beta-updates" value="" <?php echo $uabb_beta_updates; ?> ><?php _e( 'Enable Beta Updates', 'uabb' ); ?>
				</label>
			</div>
			<br/><hr/>

			<!-- Google Map API Key -->
			<p></p>
			<div class="uabb-form-setting">
				<h4><?php _e( 'Google Map API Key', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php _e( 'This setting is required if you wish to use Google Map module in your website.', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						_e( 'Need help to get Google map API key? Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/how-to-create-google-api-key-in-uabb-google-map-element/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=google-map"><?php _e( 'this article', 'uabb' ); ?></a>.</p>
						<?php
					endif;
					?>
				</p>
				<input type="text" class="uabb-google-map-api" name="uabb-google-map-api" value="<?php echo $uabb_google_map_api; ?>" class="uabb-wp-text uabb-google-map-api" />
			</div>				
			<p></p>
		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
		</p>

		<?php wp_nonce_field( 'uabb', 'fl-uabb-nonce' ); ?>

	</form>
</div>
