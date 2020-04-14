<?php
/**
 *  UABB Interactive Banner 1 Module front-end file
 *
 *  @package UABB Interactive Banner 1 Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$nofollow         = '';
if ( $version_bb_check ) {
	if ( isset( $settings->cta_link_nofollow ) ) {
		$nofollow = $settings->cta_link_nofollow;
	}
} else {
	if ( isset( $settings->cta_link_follow ) ) {
		$nofollow = $settings->cta_link_follow;
	}
}
?>

<div class="uabb-module-content uabb-ib1-outter">
	<?php if ( 'complete' === $settings->show_button ) : ?>
	<a href="<?php echo $settings->cta_link; ?>" target="<?php echo esc_attr( $settings->cta_link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->cta_link_target, $nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php endif; ?>
	<div class="uabb-banner-<?php echo esc_attr( $settings->banner_style ); ?> <?php echo ( 'custom' === $settings->banner_height_options ) ? ( ( '' !== $settings->banner_height ) ? 'uabb-banner-block-custom-height' : '' ) : ''; ?> uabb-adjust-bottom-margin uabb-bb-box uabb-ib1-block <?php echo ( 'custom' === $settings->banner_height_options && 'yes' === $settings->image_size_compatibility ) ? 'uabb-ib1-img-compatibility' : ''; ?>" data-style="<?php echo esc_attr( $settings->banner_height_options ); ?>">
		<div class="uabb-image-wrap">
			<?php
			if ( isset( $settings->banner_image_src ) ) {
				if ( '' !== $settings->banner_image_src ) {
					?>
					<?php
					$alt = $module->get_alt();
					?>
			<img src="<?php echo esc_url( $settings->banner_image_src ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
					<?php
				}
			}
			?>
			<div class="mask uabb-background <?php echo ( isset( $settings->overlay_background_color ) ) ? 'opaque-background' : 'solid-background'; ?>">
				<div class="uabb-inner-mask">
					<?php
					if ( '' !== $settings->icon ) {
						?>
					<div class="uabb-back-icon">
						<?php $module->render_icon(); ?>
					</div>
						<?php
					}
					?>
					<div class="uabb-ib1-description uabb-text-editor">
					<?php echo $settings->banner_desc; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
					if ( '' !== $settings->button ) {
						$module->render_button();
					}
					?>
				</div>
			</div>
		</div>
		<?php
		if ( '' !== $settings->banner_title ) {
			if ( ! $version_bb_check ) {
				?>
				<<?php echo esc_attr( $settings->title_typography_tag_selection ); ?> class="uabb-ib1-title title-<?php echo esc_attr( $settings->banner_title_location ); ?>">
				<?php
			} else {
					$tag_class = 'center';
				if ( isset( $settings->title_font_typo['text_align'] ) ) {
					$tag_class = $settings->title_font_typo['text_align'];
				}
				?>
				<<?php echo esc_attr( $settings->title_typography_tag_selection ); ?> class="uabb-ib1-title title-<?php echo esc_attr( $tag_class ); ?>">
			<?php } ?>
			<?php echo $settings->banner_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</<?php echo esc_attr( $settings->title_typography_tag_selection ); ?>>
			<?php
		}
		?>
	</div>
	<?php if ( 'complete' === $settings->show_button ) : ?>
	</a>
	<?php endif; ?>
</div>
