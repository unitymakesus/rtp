<?php
/**
 * Modules page in the WordPress backend
 *
 * @package Render UABB Modules page in the UABB Modules Menu
 */

$branding_short_name = BB_Ultimate_Addon_Helper::get_uabb_branding();

if ( is_callable( 'FLBuilderWhiteLabel::get_branding' ) ) {
	$bb_branding_short_name = FLBuilderWhiteLabel::get_branding();
} else {
	$bb_branding_short_name = __( 'Beaver Builder', 'uabb' );
}

?>
<div id="fl-uabb-modules-form" class="fl-settings-form uabb-modules-fl-settings-form">

	<h3 class="fl-settings-form-header"><?php esc_attr_e( 'Enabled Modules', 'uabb' ); ?></h3>

	<form id="uabb-modules-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-modules' ); ?>" method="post">

		<div class="fl-settings-form-content">

			<p><?php esc_attr_e( 'Check or uncheck modules and extensions below to enable or disable them.', 'uabb' ); ?></p>

			<p><?php echo sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */ wp_kses_post( __( '<strong> Note: </strong> If you are unable to find the %1$s Modules under the %1$s Group on frontend, please make sure that you have enabled the modules from the below list and also from the <a href="%3$s"> %2$s modules list</a>.', 'uabb' ) ), esc_attr( $branding_short_name ), esc_attr( $bb_branding_short_name ), esc_url( admin_url( 'options-general.php?page=fl-builder-settings#modules' ) ) ); ?></p>

			<?php

			$modules_array     = BB_Ultimate_Addon_Helper::get_all_modules();
			$extenstions_array = BB_Ultimate_Addon_Helper::get_all_extenstions();
			$enabled_modules   = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
			$checked           = in_array( 'all', $enabled_modules, true ) ? 'checked' : '';
			$uabb_options      = UABB_Init::$uabb_options['fl_builder_uabb'];

			unset( $modules_array['image-icon'] );
			unset( $modules_array['advanced-separator'] );
			unset( $modules_array['uabb-separator'] );
			unset( $modules_array['uabb-button'] );
			?>
			<label>
				<input class="uabb-module-all-cb" type="checkbox" name="uabb-modules[all]" value="all" <?php echo esc_attr( $checked ); ?> />
				<?php echo esc_attr( _ex( 'All', 'Plugin setup page: Modules.', 'uabb' ) ); ?>
			</label>
			<h3><?php /* translators: %s: search term */ echo sprintf( esc_attr__( '%s Modules', 'uabb' ), esc_attr( UABB_PREFIX ) ); ?></h3>
			<?php foreach ( $modules_array as $slug => $name ) : ?>
					<?php
						$checked = '';
					if ( array_key_exists( $slug, $enabled_modules ) && 'false' !== $enabled_modules[ $slug ] ) {
						$checked = 'checked';
					}
					?>
					<p>
						<label>
							<input class="uabb-module-cb" type="checkbox" name="uabb-modules[<?php echo esc_attr( $slug ); ?>]" value="<?php echo esc_attr( $slug ); ?>" <?php echo esc_attr( $checked ); ?> />
							<?php echo esc_attr( $name ); ?>
						</label>
					</p>
			<?php endforeach; ?>
			<h3><?php /* translators: %s: search term */ echo sprintf( esc_attr__( '%s Extensions', 'uabb' ), esc_attr( UABB_PREFIX ) ); ?></h3>

			<?php foreach ( $extenstions_array as $slug => $name ) : ?>
					<?php
						$checked = 'checked';
					if ( ! empty( $uabb_options ) && array_key_exists( $slug, $uabb_options ) ) {
						if ( 1 !== (int) $uabb_options[ $slug ] ) {
							$checked = '';
						}
					}
					?>
					<p>
						<label>
							<input class="uabb-module-cb" type="checkbox" name="<?php echo esc_attr( $slug ); ?>" value="<?php echo esc_attr( $slug ); ?>" <?php echo esc_attr( $checked ); ?> />
							<?php echo esc_attr( $name ); ?>
						</label>
					</p>
			<?php endforeach; ?>
		</div>
		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Module Settings', 'uabb' ); ?>" />
			<?php wp_nonce_field( 'uabb-modules', 'fl-uabb-modules-nonce' ); ?>
		</p>
	</form>
</div>
