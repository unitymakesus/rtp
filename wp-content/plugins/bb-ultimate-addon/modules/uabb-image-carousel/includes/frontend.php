<?php
/**
 *  UABB Image Carousel Module file
 *
 *  @package UABB Image Carousel Module
 */

?>

<div class="uabb-module-content uabb-image-carousel uabb-img-col-<?php echo esc_attr( $settings->grid_column ); ?> <?php echo ( 'none' !== $settings->hover_effects ) ? esc_attr( $settings->hover_effects ) : ''; ?>">
																			<?php
																			foreach ( $module->get_photos() as $photo ) :
																				?>
	<div class="uabb-image-carousel-item <?php echo ( ( 'none' !== $settings->click_action ) && ! empty( $photo->link ) ) ? 'uabb-image-carousel-link' : ''; ?>">
		<div class="uabb-image-carousel-content">
																				<?php if ( 'none' !== $settings->click_action ) : ?>
																					<?php
																					$click_action_link   = '';
																					$click_action_target = '_self';
																					if ( 'lightbox' === $settings->click_action && ! empty( $photo->link ) ) {
																						$click_action_link   = $photo->link;
																						$click_action_target = '_self';
																					} elseif ( 'cta-link' === $settings->click_action && ! empty( $photo->cta_link ) ) {
																						$click_action_link   = $photo->cta_link;
																						$click_action_target = ( isset( $settings->click_action_target ) ) ? $settings->click_action_target : '_blank';

																					}
																					?>
			<a href="<?php echo $click_action_link; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" target="<?php echo esc_attr( $click_action_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $click_action_target, $settings->click_action_nofollow, 1 ); ?> data-caption="<?php echo esc_attr( $photo->caption ); ?>">
			<?php endif; ?>

																						<?php
																						if ( 'yes' === $settings->lazyload ) {
																							$img_src = 'data-lazy="' . $photo->src . '"';
																						} else {
																							$img_src = 'src="' . $photo->src . '"';
																						}
																						?>

			<img class="uabb-gallery-img" 
																				<?php echo wp_kses_post( $img_src ); ?> alt="<?php echo esc_attr( $photo->alt ); ?>" title="<?php echo esc_attr( $photo->title ); ?>"/>

																				<?php if ( 'none' !== $settings->hover_effects ) : ?>
				<!-- Overlay Wrapper -->
				<div class="uabb-background-mask <?php echo esc_attr( $settings->hover_effects ); ?>">
					<div class="uabb-inner-mask">

																					<?php if ( 'hover' === $settings->show_captions ) : ?>
							<<?php echo esc_attr( $settings->tag_selection ); ?> class="uabb-caption">
																						<?php echo wp_kses_post( $photo->caption ); ?>
							</<?php echo esc_attr( $settings->tag_selection ); ?>>
						<?php endif; ?>

																					<?php if ( '1' === $settings->icon && '' !== $settings->overlay_icon ) : ?>
						<div class="uabb-overlay-icon">
							<i class="<?php echo esc_attr( $settings->overlay_icon ); ?>" ></i>
						</div>
						<?php endif; ?>

					</div>
				</div> <!-- Overlay Wrapper Closed -->
			<?php endif; ?>
																				<?php if ( 'none' !== $settings->click_action ) : ?>
			</a>
			<?php endif; ?>
																				<?php if ( $photo && ! empty( $photo->caption ) && 'hover' === $settings->show_captions && 'none' === $settings->hover_effects ) : ?>
			<<?php echo esc_attr( $settings->tag_selection ); ?> class="uabb-image-carousel-caption uabb-image-carousel-caption-hover" itemprop="caption"><?php echo wp_kses_post( $photo->caption ); ?></<?php echo esc_attr( $settings->tag_selection ); ?>>
			<?php endif; ?>
		</div>
																				<?php if ( $photo && ! empty( $photo->caption ) && 'below' === $settings->show_captions ) : ?>
		<<?php echo esc_attr( $settings->tag_selection ); ?> class="uabb-image-carousel-caption uabb-image-carousel-caption-below" itemprop="caption"><?php echo wp_kses_post( $photo->caption ); ?></<?php echo esc_attr( $settings->tag_selection ); ?>>
		<?php endif; ?>
	</div>
																				<?php
	endforeach;
																			?>
</div>
