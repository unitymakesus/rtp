<?php
/**
 *  UABB Google Map Module front-end file
 *
 *  @package UABB Google Map Module
 */

$gerror               = false;
$style                = '';
$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];
if ( ! isset( $uabb_setting_options['uabb-google-map-api'] ) || ( isset( $uabb_setting_options['uabb-google-map-api'] ) && empty( $uabb_setting_options['uabb-google-map-api'] ) ) ) {
	$gerror = true;
	$style  = 'style="position: relative"';
} ?>

<div class='uabb-module-content uabb-google-map-wrapper' id="uabb-google-map" <?php echo wp_kses_post( $style ); ?> >

	<?php if ( true === $gerror && current_user_can( 'delete_users' ) ) { ?>
	<div class='uabb-google-map-error' style="line-height: 1.5em;padding: 50px;text-align: center;position: absolute;top: 50%;width: 100%;left: 50%;transform: translate(-50%,-50%);">
		<span style=" line-height: 1.45em;"> <?php esc_attr_e( 'It seems that you have not yet configured Google Map API key. To display advanced Google map, please set up API key in', 'uabb' ); ?> <a href="<?php echo wp_kses_post( admin_url( 'options-general.php?page=uabb-builder-settings#uabb' ) ); ?>" class="uabb-google-map-notice" target="_blank" rel="noopener"><span style="font-weight:bold;"><?php esc_attr_e( 'General Settings', 'uabb' ); ?></span></a></span>.
	</div>
	<?php } ?>
</div>
