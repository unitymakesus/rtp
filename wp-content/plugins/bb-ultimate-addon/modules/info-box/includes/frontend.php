<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info Box Module
 */

$nofollow = '';
$target   = '';
if ( isset( $settings->link_nofollow ) ) {
	$nofollow = $settings->link_nofollow;
}
if ( isset( $settings->link_target ) ) {
	$target = $settings->link_target;
}
$stacked_class = '';
if ( 'none' !== $settings->image_type ) {
	if ( 'right' === $settings->img_icon_position ) {
		if ( 'stack' === $settings->mobile_view ) {
			if ( 'reversed' === $settings->stacking_order ) {
				$stacked_class = 'uabb-reverse-order';
			}
		}
	}
}
?>
<div class="uabb-module-content <?php echo wp_kses_post( $module->get_classname() ); ?> <?php echo esc_attr( $stacked_class ); ?>">
	<div class="uabb-infobox-left-right-wrap">
	<?php
	if ( 'module' === $settings->cta_type && ! empty( $settings->link ) ) {
		echo '<a href="' . $settings->link . '" target="' . esc_attr( $target ) . '" ' . wp_kses_post( BB_Ultimate_Addon_Helper::get_link_rel( $target, $nofollow, 0 ) ) . ' class="uabb-infobox-module-link"></a>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	// Image left.
	$module->render_image( 'left' );
	// phpcs:ignore Squiz.PHP.EmbeddedPhp.ContentAfterEnd
	?><div class="uabb-infobox-content"> 
			<?php
			// Image above title.
			$module->render_image( 'above-title' );
			// Title.
			$module->render_title();
			// Image below title.
			$module->render_image( 'below-title' );
			// Separator.
			$module->render_separator();

			if ( '' !== $settings->text || 'link' === $settings->cta_type || 'button' === $settings->cta_type ) {
				?>
			<div class="uabb-infobox-text-wrap">
				<?php
				// Text.
				$module->render_text();
				// Link CTA.
				$module->render_link();
				// Button CTA.
				$module->render_button();
				?>
			</div> 
				<?php
			}
			?>
		</div><?php // @codingStandardsIgnoreLine.
		// Image right.
		$module->render_image( 'right' );
		?>
	</div>
</div>
