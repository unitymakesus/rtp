<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info Banner Module
 */

if ( empty( $settings->banner_image ) ) {
	$settings->banner_image_src = '';
}

$banner_image_alt = $module->get_alt();

$info_banner_id = wp_rand( 1000, 9999 );
?>

<div class="uabb-module-content uabb-ultb3-box <?php echo esc_attr( $settings->banner_image_effect ); ?>">
	<?php
	if ( 'module' === $settings->cta_type && ! empty( $settings->link ) ) {
		echo '<a href="' . $settings->link . '" target="' . esc_attr( $settings->link_target ) . '" ' . wp_kses_post( BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $settings->link_nofollow, 0 ) ) . ' class="uabb-infobanner-module-link"></a>';//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
	}

	if ( isset( $settings->banner_image_src ) ) {
		if ( '' !== $settings->banner_image_src ) {
			if ( '' !== $settings->overlay_color ) {
				?>
				<div class="uabb-ultb3-box-overlay"></div>
			<?php } ?>
			<img class="uabb-ultb3-img <?php echo esc_attr( $settings->banner_image_alignemnt ); ?>" alt="<?php echo esc_attr( $banner_image_alt ); ?>" src="<?php echo esc_url( $settings->banner_image_src ); ?>">
			<?php
		}
	}
	?>

	<div id="info-banner-<?php echo esc_attr( $info_banner_id ); ?>" class="uabb-ultb3-info <?php echo esc_attr( $settings->banner_alignemnt ); ?>" data-animation-delay="03">

		<?php

		echo '<' . esc_attr( $settings->tag_selection ) . ' class="uabb-ultb3-title">';
		echo $settings->banner_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</' . esc_attr( $settings->tag_selection ) . '>';

		?>

		<div class="uabb-ultb3-desc uabb-text-editor">
			<?php
				global $wp_embed;
				echo wpautop( $wp_embed->autoembed( $settings->banner_desc ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>

		<?php
		if ( 'link' === $settings->cta_type || 'button' === $settings->cta_type ) {
			// Link CTA.
			$module->render_link();
			// Button CTA.
			$module->render_button();
		}
		?>
	</div>
</div>
