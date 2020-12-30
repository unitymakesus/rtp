<?php
/**
 *  UABB Pricing Table Module front-end file
 *
 *  @package UABB Pricing Table Module
 */

if ( 'yes' === $settings->add_legend ) {
	$columns = count( $settings->pricing_columns ) + 1;
} else {
	$columns = count( $settings->pricing_columns );
}

?>

<div class="uabb-module-content uabb-pricing-table">

	<?php
	if ( 'yes' === $settings->add_legend ) {
		?>

	<div class="uabb-pricing-table-col-<?php echo esc_attr( $columns ); ?> uabb-pricing-table-outter-0 uabb-pricing-legend-box">
		<div class="uabb-pricing-table-column uabb-pricing-table-column-0">
			<div class="uabb-pricing-table-inner-wrap">
				<<?php echo esc_attr( $settings->title_typography_tag_selection ); ?> class="uabb-pricing-table-title">&nbsp;</<?php echo esc_attr( $settings->title_typography_tag_selection ); ?>>
				<<?php echo esc_attr( $settings->price_typography_tag_selection ); ?> class="uabb-pricing-table-price">
					&nbsp;
					<span class="uabb-pricing-table-duration">&nbsp;</span>
				</<?php echo esc_attr( $settings->price_typography_tag_selection ); ?>>
				<ul class="uabb-pricing-table-features">
					<?php
					if ( ! empty( $settings->legend_column->features ) ) {
						foreach ( $settings->legend_column->features as $feature ) :
							?>
													<?php if ( '' !== trim( $feature ) ) : ?>
						<li><?php echo trim( $feature ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
					<?php endif; ?>
											<?php
					endforeach;
					};
					?>
				</ul>
			</div>
		</div>
	</div>

		<?php
	}
	$cnt = count( $settings->pricing_columns );
	for ( $i = 0; $i < $cnt; $i++ ) :

		if ( ! is_object( $settings->pricing_columns[ $i ] ) ) {
			continue;
		}
		$pricing_column = $settings->pricing_columns[ $i ];
		$layout         = 'uabb-duration-layout-' . $pricing_column->duration_position;

		?>
	<div class="uabb-pricing-table-col-<?php echo esc_attr( $columns ); ?> uabb-pricing-table-outter-<?php echo esc_attr( $i + 1 ); ?> uabb-pricing-element-box">
		<div class="uabb-pricing-table-column uabb-pricing-table-column-<?php echo esc_attr( $i + 1 ); ?>">
			<?php
			if ( 'yes' === $settings->pricing_columns[ $i ]->set_featured ) {
				?>
			<<?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_tag_selection ); ?> class="uabb-featured-pricing-box"><?php echo $settings->pricing_columns[ $i ]->featured_text; ?></<?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_tag_selection ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php
			}
			?>
			<div class="uabb-pricing-table-inner-wrap">
			<?php if ( 'icon' === $pricing_column->title_icon_setting ) { ?>
				<span class="uabb-price-table-title-icon"><i class="<?php echo esc_attr( $pricing_column->title_icon ); ?>" aria-hidden="true"></i>
							</span>
					<?php } ?>
				<<?php echo esc_attr( $settings->title_typography_tag_selection ); ?> class="uabb-pricing-table-title"><?php echo $pricing_column->title; ?></<?php echo esc_attr( $settings->title_typography_tag_selection ); // @codingStandardsIgnoreLine. ?>>

				<?php if ( 'above' === $settings->price_position ) { ?>
					<<?php echo esc_attr( $settings->price_typography_tag_selection ); ?> class="uabb-pricing-table-price">
					<?php if ( 'yes' === $pricing_column->set_sale_price && ! empty( $pricing_column->original_price ) ) { ?>
							<span class="uabb-price-table-original-price uabb-price-typo-excluded"><?php echo wp_kses_post( $pricing_column->original_price ); ?></span>
					<?php } ?> 
					<?php echo $pricing_column->price; // @codingStandardsIgnoreLine. ?>
					<?php
					if ( '' !== $pricing_column->duration ) {
						?>
						<span class="uabb-pricing-table-duration <?php echo esc_attr( $layout ); ?>"><?php echo $pricing_column->duration; // @codingStandardsIgnoreLine. ?></span>
						<?php
					}
					?>
					</<?php echo esc_attr( $settings->price_typography_tag_selection ); ?>>
				<?php } ?>
				<ul class="uabb-pricing-table-features">
					<?php
					if ( ! empty( $pricing_column->features ) ) :
						$count = count( $pricing_column->features );
						for ( $j = 0; $j < $count; $j++ ) :
							?>
							<?php if ( '' !== trim( $pricing_column->features[ $j ] ) ) : ?>
						<li>
								<?php
								if ( 'yes' === $settings->add_legend && 'yes' === $settings->responsive_size ) :
									if ( isset( $settings->legend_column->features[ $j ] ) ) :
										?>
										<span class="uabb-pricing-ledgend">
											<?php echo $settings->legend_column->features[ $j ]; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</span>
										<?php
										endif;
							endif;
								?>
								<?php if ( 'before' === $pricing_column->icon_position ) { ?>

									<?php if ( 'icon' === $pricing_column->image_type ) { ?>
							<span class="uabb-feature-list-icon uabb-price-table-icon-before"><i class="<?php echo esc_attr( $pricing_column->icon ); ?>" aria-hidden="true"></i>
							</span>
					<?php } ?>
								<?php echo $pricing_column->features[ $j ]; // @codingStandardsIgnoreLine. ?>
					<?php } else { ?>
								<?php echo $pricing_column->features[ $j ]; // @codingStandardsIgnoreLine. ?>
									<?php if ( 'icon' === $pricing_column->image_type ) { ?>
							<span class="uabb-feature-list-icon uabb-price-table-icon-after"><i class="<?php echo esc_attr( $pricing_column->icon ); ?>" aria-hidden="true"></i>
							</span>
					<?php } ?>
						<?php } ?>

						</li>
						<?php endif; ?>
						<?php endfor; ?>
					<?php endif; ?> 
				</ul>
				<?php if ( 'below' === $settings->price_position ) { ?>
					<<?php echo esc_attr( $settings->price_typography_tag_selection ); ?> class="uabb-pricing-table-price">
					<?php if ( 'yes' === $pricing_column->set_sale_price && ! empty( $pricing_column->original_price ) ) { ?>
							<span class="uabb-price-table-original-price uabb-price-typo-excluded"><?php echo wp_kses_post( $pricing_column->original_price ); ?></span>
					<?php } ?> 
					<?php echo $pricing_column->price; // @codingStandardsIgnoreLine. ?>
					<?php
					if ( '' !== $pricing_column->duration ) {
						?>
						<span class="uabb-pricing-table-duration <?php echo esc_attr( $layout ); ?>"><?php echo $pricing_column->duration; // @codingStandardsIgnoreLine. ?></span>
						<?php
					}
					?>
					</<?php echo esc_attr( $settings->price_typography_tag_selection ); ?>>
				<?php } ?>
				<?php ( 'yes' === $settings->pricing_columns[ $i ]->show_button ) ? $module->render_button( $i ) : ''; ?>
				<?php do_action( 'uabb_price_box_button', $i ); ?>
			</div>
		</div>
		<?php
		if ( isset( $settings->pricing_columns[ $i ]->ribbon_style ) && 'none' !== $settings->pricing_columns[ $i ]->ribbon_style ) {
			?>
		<div class="uabb-price-box-ribbon-<?php echo esc_attr( $columns ); ?> uabb-ribbon-<?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_style ); ?> uabb-ribbon-<?php echo esc_attr( $settings->pricing_columns[ $i ]->horizontal_pos ); ?>">
			<div class="uabb-price-box-ribbon-content"><?php echo wp_kses_post( $settings->pricing_columns[ $i ]->ribbon_title ); ?></div>
		</div>
		<?php } ?>
	</div>
		<?php

	endfor;
	?>
</div>
