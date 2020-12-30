<?php
/**
 * General Settings Page
 *
 * @package UABB General Settings
 */

?>
<div id="fl-uabb-form" class="fl-settings-form uabb-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php esc_attr_e( 'General Settings', 'uabb' ); ?></h3>

	<form id="uabb-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<?php

				$hidden_class        = '';
				$uabb                = BB_Ultimate_Addon_Helper::get_builder_uabb();
				$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
				$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

				$is_load_templates     = '';
				$is_load_panels        = '';
				$uabb_live_preview     = '';
				$uabb_google_map_api   = '';
				$uabb_colorpicker      = '';
				$uabb_beta_updates     = '';
				$uabb_yelp_api_key     = '';
				$google_status         = '';
				$yelp_status           = '';
				$uabb_google_place_api = '';


			if ( is_array( $uabb ) ) {
				$is_load_panels      = ( array_key_exists( 'load_panels', $uabb ) && 1 === $uabb['load_panels'] ) ? ' checked' : '';
				$uabb_live_preview   = ( array_key_exists( 'uabb-live-preview', $uabb ) && 1 === $uabb['uabb-live-preview'] ) ? ' checked' : '';
				$uabb_google_map_api = ( array_key_exists( 'uabb-google-map-api', $uabb ) ) ? $uabb['uabb-google-map-api'] : '';

				$uabb_beta_updates     = ( array_key_exists( 'uabb-enable-beta-updates', $uabb ) && 1 === (int) $uabb['uabb-enable-beta-updates'] ) ? ' checked' : '';
				$uabb_yelp_api_key     = ( array_key_exists( 'uabb-yelp-api-key', $uabb ) ) ? $uabb['uabb-yelp-api-key'] : '';
				$uabb_google_place_api = ( array_key_exists( 'uabb-google-place-api', $uabb ) ) ? $uabb['uabb-google-place-api'] : '';

			}
				$api_key_status = BB_Ultimate_Addon_Helper::api_key_status();

			if ( is_array( $api_key_status ) ) {

				$google_status = ( array_key_exists( 'google_status_code', $api_key_status ) ) ? $api_key_status['google_status_code'] : '';
				$yelp_status   = ( array_key_exists( 'yelp_status_code', $api_key_status ) ) ? $api_key_status['yelp_status_code'] : '';
			}
			?>

			<?php
			if ( class_exists( 'FLBuilderUIContentPanel' ) ) {
				$hidden_class = 'uabb-hidden';
			}
			?>
			<!-- Load Panels -->
			<div class="uabb-form-setting <?php echo esc_attr( $hidden_class ); ?>">
				<h4><?php esc_attr_e( 'Enable UI Design', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php esc_attr_e( 'Enable this setting for applying UI effects such as - Section panel, Search box etc. to frontend page builder. ', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						esc_attr_e( 'Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/how-to-enable-disable-beaver-builders-ui/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=ui-design"><?php esc_attr_e( 'this article', 'uabb' ); ?></a>
						<?php
						esc_attr_e( ' for more information.', 'uabb' );
					endif;
					?>
				</p>
				<label>
					<input type="checkbox" class="uabb-enabled-panels" name="uabb-enabled-panels" value="" <?php echo esc_attr( $is_load_panels ); ?> ><?php esc_attr_e( 'Enable UI Design', 'uabb' ); ?>
				</label>
			</div>

			<!-- Load Panels -->
			<div class="uabb-form-setting <?php echo esc_attr( $hidden_class ); ?>">
				<h4><?php esc_attr_e( 'Enable Live Preview', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php esc_attr_e( 'Enable this setting to see live preview of a page without leaving the editor.', 'uabb' ); ?></p>
				<label>
					<input type="checkbox" class="uabb-live-preview" name="uabb-live-preview" value="" <?php echo esc_attr( $uabb_live_preview ); ?> ><?php esc_attr_e( 'Enable Live Preview', 'uabb' ); ?>
				</label>
			</div>

			<!-- Beta Version -->
			<div class="uabb-form-setting">
				<h4><?php esc_attr_e( 'Allow Beta Updates', 'uabb' ); ?></h4>
				<p class="uabb-admin-help"><?php esc_attr_e( 'Enable this option to receive update notifications for beta versions.', 'uabb' ); ?></p>
				<label>
					<input type="checkbox" class="uabb-enable-beta-updates" name="uabb-enable-beta-updates" value="" <?php echo esc_attr( $uabb_beta_updates ); ?> ><?php esc_attr_e( 'Enable Beta Updates', 'uabb' ); ?>
				</label>
			</div>
			<br/><hr/>

			<!-- Google Map API Key -->
			<p></p>
			<div class="uabb-form-setting">
				<h4><?php esc_attr_e( 'Google Map API Key', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php esc_attr_e( 'This setting is required if you wish to use Google Map module in your website.', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						esc_attr_e( 'Need help to get Google map API key? Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/how-to-create-google-api-key-in-uabb-google-map-element/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=google-map"><?php esc_attr_e( 'this article', 'uabb' ); ?></a>.</p>
						<?php
					endif;
					?>
				</p>
				<input type="text" class="uabb-google-map-api" name="uabb-google-map-api" value="<?php echo esc_attr( $uabb_google_map_api ); ?>" class="uabb-wp-text uabb-google-map-api" />
			</div>
			<p></p>

			<p></p>
			<div class="uabb-form-setting">
				<h4><?php esc_attr_e( 'Business Reviews - Google Places API Key', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php esc_attr_e( 'This setting is required if you wish to use Business Reviews module in your website.', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						esc_attr_e( 'Need help to get Google Places API Key? Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/how-to-get-google-places-api-key/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=business-reviews"><?php esc_attr_e( 'this article', 'uabb' ); ?></a>.</p>
						<?php
					endif;
					?>
				</p>
				<div class="uabb-api-info-msg">
			<span class="dashicons dashicons-warning"></span>
			<?php echo( sprintf( /* translators: %s: doc link */ wp_kses_post( __( 'Google now requires an active billing account associated with your API Key. Click %1$s here %2$s to enable billing.', 'uabb' ) ), '<a class="uabb-notice-link" href="https://console.cloud.google.com/projectselector2/billing/enable" target="_blank">', '</a>' ) ); ?>
			</div>
				<input type="text" class="uabb-google-place-api uabb-wp-text" name="uabb-google-place-api" value="<?php echo esc_attr( $uabb_google_place_api ); ?>" />
				<?php if ( 'yes' === $google_status ) { ?>
					<div class="uabb-key-success"><?php esc_attr_e( 'Google Places API Key is authenticated correctly.', 'uabb' ); ?></div>
				<?php } elseif ( 'no' === $google_status ) { ?>
						<div class="uabb-key-warning"><?php esc_attr_e( 'Google Places API Key you have entered is incorrect.', 'uabb' ); ?></div>
				<?php } ?>
			</div>
			<p></p>

			<div class="uabb-form-setting">
				<h4><?php esc_attr_e( 'Business Reviews - Yelp API Key', 'uabb' ); ?></h4>
				<p class="uabb-admin-help">
					<?php esc_attr_e( 'This setting is required if you wish to use Yelp reviews in our site.', 'uabb' ); ?>
					<?php
					if ( empty( $branding_name ) && empty( $branding_short_name ) ) :
						esc_attr_e( 'Need help to get Yelp API key? Read ', 'uabb' );
						?>
						<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/find-yelp-api-key/?utm_source=uabb-pro-dashboard&utm_medium=general-settings-screen&utm_campaign=business-reviews"><?php esc_attr_e( 'this article', 'uabb' ); ?></a>.</p>
						<?php
					endif;
					?>
				</p>
				<input type="text" name="uabb-yelp-api-key" value="<?php echo esc_attr( $uabb_yelp_api_key ); ?>" class="uabb-wp-text uabb-yelp-api-key"/>
				<?php if ( 'yes' === $yelp_status ) { ?>
					<div class="uabb-key-success"><?php esc_attr_e( 'Entered Yelp API key is authenticated correctly.', 'uabb' ); ?></div>
				<?php } elseif ( 'no' === $yelp_status ) { ?>
						<div class="uabb-key-warning"><?php esc_attr_e( 'Yelp API key you have entered is incorrect.', 'uabb' ); ?></div>
				<?php } ?>
			</div>

		</div>

		<p class="submit">
			<input type="submit" name="fl-save-uabb" class="button-primary" value="<?php esc_attr_e( 'Save Settings', 'uabb' ); ?>" />
		</p>

		<?php wp_nonce_field( 'uabb', 'fl-uabb-nonce' ); ?>

	</form>
</div>
