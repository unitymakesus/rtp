<?php
/**
 *  Photo Gallery Module front-end file
 *
 *  @package Photo Gallery Module
 */

$click_action_target = ( isset( $settings->click_action_target ) ) ? $settings->click_action_target : '_blank';

if ( 'grid' == $settings->layout ) : ?>
<div class="uabb-module-content uabb-photo-gallery uabb-gallery-grid<?php echo $settings->grid_column; ?> <?php echo ( 'none' != $settings->hover_effects ) ? $settings->hover_effects : ''; ?>">
																			<?php
																			foreach ( $module->get_photos() as $photo ) :
																				?>
	<div class="uabb-photo-gallery-item <?php echo ( ( 'none' != $settings->click_action ) && ! empty( $photo->link ) ) ? 'uabb-photo-gallery-link' : ''; ?>">

		<div class="uabb-photo-gallery-content">		
																					<?php if ( 'none' != $settings->click_action ) : ?>
																						<?php
																						$click_action_link = '#';
																						if ( 'cta-link' == $settings->click_action ) {
																							if ( ! empty( $photo->cta_link ) ) {
																								$click_action_link = $photo->cta_link;
																							} elseif ( ! empty( $photo->link ) ) {
																								$click_action_link = $photo->link;
																							} else {
																								$click_action_link = '#';
																							}
																						} elseif ( 'cta-link' != $settings->click_action && ! empty( $photo->link ) ) {
																							$click_action_link = $photo->link;
																						}
																						?>
			<a href="<?php echo $click_action_link; ?>" target="<?php echo $click_action_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $click_action_target, 0, 1 ); ?> data-caption="<?php echo $photo->caption; ?>">
			<?php endif; ?>

			<img class="uabb-gallery-img" src="<?php echo $photo->src; ?>" alt="<?php echo $photo->alt; ?>" />
																						<?php if ( 'none' != $settings->hover_effects ) : ?>
				<!-- Overlay Wrapper -->
				<div class="uabb-background-mask <?php echo $settings->hover_effects; ?>">
					<div class="uabb-inner-mask">

																								<?php if ( 'hover' == $settings->show_captions ) : ?>
							<<?php echo $settings->tag_selection; ?> class="uabb-caption">
																									<?php echo $photo->caption; ?>
							</<?php echo $settings->tag_selection; ?>>
						<?php endif; ?>

																								<?php if ( '1' == $settings->icon && '' != $settings->overlay_icon ) : ?>
						<div class="uabb-overlay-icon">
							<i class="<?php echo $settings->overlay_icon; ?>" ></i>
						</div>
						<?php endif; ?>

					</div>
				</div> <!-- Overlay Wrapper Closed -->
			<?php endif; ?>

																						<?php if ( 'none' != $settings->click_action ) : ?>
			</a>
			<?php endif; ?>    
																						<?php if ( $photo && ! empty( $photo->caption ) && 'hover' == $settings->show_captions && 'none' == $settings->hover_effects ) : ?>
			<<?php echo $settings->tag_selection; ?> class="uabb-photo-gallery-caption uabb-photo-gallery-caption-hover" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
			<?php endif; ?>
		</div>
																						<?php if ( $photo && ! empty( $photo->caption ) && 'below' == $settings->show_captions ) : ?>
		<<?php echo $settings->tag_selection; ?> class="uabb-photo-gallery-caption uabb-photo-gallery-caption-below" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
		<?php endif; ?>
	</div>
																					<?php
	endforeach;
																			?>
</div>
<?php else : ?>
<div class="uabb-masonary">
	<div class="uabb-masonary-content <?php echo ( 'none' != $settings->hover_effects ) ? $settings->hover_effects : ''; ?>">
		<div class="uabb-grid-sizer"></div>
		<?php foreach ( $module->get_photos() as $photo ) : ?>
		<div class="uabb-masonary-item">
			<div class="uabb-photo-gallery-content <?php echo ( ( 'none' != $settings->click_action ) && ! empty( $photo->link ) ) ? 'uabb-photo-gallery-link' : ''; ?>">

				<?php if ( 'none' != $settings->click_action ) : ?>
					<?php
					$click_action_link = '#';
					if ( 'cta-link' == $settings->click_action ) {
						if ( ! empty( $photo->cta_link ) ) {
							$click_action_link = $photo->cta_link;
						} elseif ( ! empty( $photo->link ) ) {
							$click_action_link = $photo->link;
						} else {
							$click_action_link = '#';
						}
					} elseif ( 'cta-link' != $settings->click_action && ! empty( $photo->link ) ) {
						$click_action_link = $photo->link;
					}
					?>
				<a href="<?php echo $click_action_link; ?>" target="<?php echo $click_action_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $click_action_target, 0, 1 ); ?> data-caption="<?php echo $photo->caption; ?>">
				<?php endif; ?>

				<img class="uabb-gallery-img" src="<?php echo $photo->src; ?>" alt="<?php echo $photo->alt; ?>" />
				<?php if ( 'none' != $settings->hover_effects ) : ?>
				<!-- Overlay Wrapper -->
				<div class="uabb-background-mask <?php echo $settings->hover_effects; ?>">
					<div class="uabb-inner-mask">

						<?php if ( 'hover' == $settings->show_captions ) : ?>
							<<?php echo $settings->tag_selection; ?> class="uabb-caption">
								<?php echo $photo->caption; ?>
							</<?php echo $settings->tag_selection; ?>>
						<?php endif; ?>

						<?php if ( '1' == $settings->icon && '' != $settings->overlay_icon ) : ?>
						<div class="uabb-overlay-icon">
							<i class="<?php echo $settings->overlay_icon; ?>" ></i>
						</div>
						<?php endif; ?>

					</div>
				</div> <!-- Overlay Wrapper Closed -->
			<?php endif; ?>
				<?php if ( 'none' != $settings->click_action ) : ?>
				</a>
				<?php endif; ?>    
				<?php if ( $photo && ! empty( $photo->caption ) && 'hover' == $settings->show_captions && 'none' == $settings->hover_effects ) : ?>
				<<?php echo $settings->tag_selection; ?> class="uabb-photo-gallery-caption uabb-photo-gallery-caption-hover" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
				<?php endif; ?>
			</div>
			<?php if ( $photo && ! empty( $photo->caption ) && 'below' == $settings->show_captions ) : ?>
			<<?php echo $settings->tag_selection; ?> class="uabb-photo-gallery-caption uabb-photo-gallery-caption-below" itemprop="caption"><?php echo $photo->caption; ?></<?php echo $settings->tag_selection; ?>>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="fl-clear"></div>
</div>
<?php endif; ?>
