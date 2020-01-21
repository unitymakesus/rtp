<?php
/**
 *  Photo Gallery Module front-end file
 *
 *  @package Photo Gallery Module
 */

$click_action_target = ( isset( $settings->click_action_target ) ) ? $settings->click_action_target : '_blank'; ?>
<?php
if ( 'yes' == $settings->filterable_gallery_enable ) {
	echo $module->render_gallery_filters();
}
?>
<?php
$filters     = $module->get_filter_values();
$filter_data = json_encode( array_keys( $filters ) );
?>
<?php if ( 'grid' == $settings->layout ) : ?>
	<div class="uabb-module-content uabb-photo-gallery uabb-gallery-grid<?php echo $settings->grid_column; ?> <?php echo ( 'none' != $settings->hover_effects ) ? $settings->hover_effects : ''; ?> <?php echo ( 'yes' == $settings->filterable_gallery_enable ) ? 'uabb-photo-gallery-filter-grid' : ''; ?>" data-all-filters=<?php echo ( isset( $filter_data ) ) ? $filter_data : ''; ?> >
<?php
$category = '';
foreach ( $module->get_photos() as $photo ) :

	if ( isset( $photo->category ) ) {
		$category = $photo->category;
	}

	$tags = explode( ',', strtolower( $category ) );

	$tags = array_map( 'trim', $tags );

	$string = str_replace( ' ', '-', $tags );

	$string = preg_replace( '/[^A-Za-z0-9\-]/', '', $string );

	$cat_slug = implode( ' ', $string );
	?>
		<div class="uabb-photo-gallery-item <?php echo ( isset( $cat_slug ) ) ? $cat_slug : ''; ?> uabb-photo-item-grid">
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

				<img class="uabb-gallery-img" src="<?php echo $photo->src; ?>" alt="<?php echo $photo->alt; ?>" title="<?php echo $photo->title; ?>" />
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
	<div class="uabb-masonary-content <?php echo ( 'none' != $settings->hover_effects ) ? $settings->hover_effects : ''; ?> <?php echo ( 'yes' == $settings->filterable_gallery_enable ) ? 'uabb-photo-gallery-filter' : ''; ?>" data-all-filters=<?php echo ( isset( $filter_data ) ) ? $filter_data : ''; ?>>
		<div class="uabb-grid-sizer"></div>
		<?php foreach ( $module->get_photos() as $photo ) : ?>
			<?php
			$category = '';
			if ( isset( $photo->category ) ) {
				$category = $photo->category;
			}
			$tags = explode( ',', strtolower( $category ) );

			$tags = array_map( 'trim', $tags );

			$string = str_replace( ' ', '-', $tags );

			$string = preg_replace( '/[^A-Za-z0-9\-]/', '', $string );

			$cat_slug = implode( ' ', $string );
			?>
		<div class="uabb-masonary-item <?php echo ( isset( $cat_slug ) ) ? $cat_slug : ''; ?> uabb-photo-item">
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

				<img class="uabb-gallery-img" src="<?php echo $photo->src; ?>" alt="<?php echo $photo->alt; ?>" title="<?php echo $photo->title; ?>"/>
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
