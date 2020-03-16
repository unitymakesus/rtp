<?php
/**
 * Render the fronted content.
 *
 * @package UABB Info Circle Module
 */

$settings->autoplay_time = ( '' !== $settings->autoplay_time ) ? $settings->autoplay_time : '15'; ?>
<div class="uabb-module-content uabb-info-circle-wrap on-<?php echo esc_attr( $settings->info_trigger_type ); ?>" <?php echo ( 'yes' === $settings->autoplay ) ? 'data-interval-time="' . esc_attr( $settings->autoplay_time ) . '"' : ''; ?> data-active-animation="<?php echo esc_attr( $settings->active_animation ); ?>">

	<div class="uabb-info-circle uabb-info-circle-out"></div>
	<?php
		$circle_item_count = 0;
	foreach ( $settings->add_circle_item as $item ) {
		if ( ! is_object( $item ) ) {
			continue; }

		$circle_item_count++;
		$img_active_effect = ( 'none' !== $item->photo_active_type ) ? $item->photo_active_type : '';
		?>
			<div class="uabb-info-circle-icon-content uabb-ic-<?php echo esc_attr( $circle_item_count ); ?> <?php echo ( 1 === $circle_item_count ) ? 'active' : ''; ?>">

			<?php if ( 'hover' === $settings->info_trigger_type && ( 'icon' === $item->cta || 'both' === $item->cta ) ) : ?>
					<a href='<?php echo $item->cta_link; ?>' target='<?php echo esc_attr( $item->cta_link_target ); ?>' <?php BB_Ultimate_Addon_Helper::get_link_rel( $item->cta_link_target, $item->cta_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>> <!-- Link on Icon -->
				<?php endif; ?>

					<div class="uabb-info-circle uabb-info-circle-small uabb-circle-<?php echo esc_attr( $circle_item_count ); ?> <?php echo esc_attr( $img_active_effect ); ?>" data-circle-id="<?php echo esc_attr( $circle_item_count ); ?>">
						<div>
						<?php $module->render_icon_image( $item ); ?>
						<?php
						if ( 'photo' === $item->image_type && 'change-img' === $item->photo_active_type ) {
							$module->render_icon_image( $item, 'active-img' );
						}
						?>
						</div>
					</div>

				<?php if ( 'hover' === $settings->info_trigger_type && ( 'icon' === $item->cta || 'both' === $item->cta ) ) : ?>
					</a>
				<?php endif; ?>

				<div class="uabb-info-circle uabb-info-circle-in uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?>" <?php echo ( 1 === $circle_item_count ) ? 'style="display:block;"' : ''; ?>>
					<div class="uabb-info-circle-content">
						<?php if ( 'no' !== $settings->info_area_icon ) : ?>
							<?php $module->render_icon_image( $item ); ?>
						<?php endif; ?>

						<<?php echo esc_attr( $settings->tag_selection ); ?> class="uabb-info-circle-title"><?php echo $item->circle_item_title; ?></<?php echo esc_attr( $settings->tag_selection ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

						<?php if ( 'none' !== $settings->info_separator_style ) : ?>
							<span class="uabb-ic-separator"></span>
						<?php endif; ?>

						<div class="uabb-info-circle-desc uabb-text-editor">
						<?php echo $item->circle_item_description; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>

						<!-- CTA -->
						<?php if ( 'desc' === $item->cta || 'both' === $item->cta ) : ?>
							<div class='uabb-info-circle-cta uabb-info-circle-cta-<?php echo esc_attr( $item->desc_cta_type ); ?>'>
								<?php $module->render_cta( $item ); ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		<?php
	}
	?>

</div>

