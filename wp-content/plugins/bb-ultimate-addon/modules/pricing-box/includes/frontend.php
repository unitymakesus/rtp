<?php
/**
 *  UABB Pricing Table Module front-end file
 *
 *  @package UABB Pricing Table Module
 */

if ( 'yes' == $settings->add_legend ) {
	$columns = count( $settings->pricing_columns ) + 1;
} else {
	$columns = count( $settings->pricing_columns );
}

?>

<div class="uabb-module-content uabb-pricing-table">

	<?php
	if ( 'yes' == $settings->add_legend ) {
		?>

	<div class="uabb-pricing-table-col-<?php echo $columns; ?> uabb-pricing-table-outter-0 uabb-pricing-legend-box">
		<div class="uabb-pricing-table-column uabb-pricing-table-column-0">
			<div class="uabb-pricing-table-inner-wrap">
				<<?php echo $settings->title_typography_tag_selection; ?> class="uabb-pricing-table-title">&nbsp;</<?php echo $settings->title_typography_tag_selection; ?>>
				<<?php echo $settings->price_typography_tag_selection; ?> class="uabb-pricing-table-price">
					&nbsp;
					<span class="uabb-pricing-table-duration">&nbsp;</span>
				</<?php echo $settings->price_typography_tag_selection; ?>>
				<ul class="uabb-pricing-table-features">
					<?php
					if ( ! empty( $settings->legend_column->features ) ) {
						foreach ( $settings->legend_column->features as $feature ) :
							?>
													<?php if ( '' != trim( $feature ) ) : ?>
						<li><?php echo trim( $feature ); ?></li>
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

	for ( $i = 0; $i < count( $settings->pricing_columns ); $i++ ) :

		if ( ! is_object( $settings->pricing_columns[ $i ] ) ) {
			continue;
		}

		$pricingColumn = $settings->pricing_columns[ $i ];

		?>
	<div class="uabb-pricing-table-col-<?php echo $columns; ?> uabb-pricing-table-outter-<?php echo $i + 1; ?> uabb-pricing-element-box">
		<div class="uabb-pricing-table-column uabb-pricing-table-column-<?php echo $i + 1; ?>">
			<?php
			if ( 'yes' == $settings->pricing_columns[ $i ]->set_featured ) {
				?>
			<<?php echo $settings->pricing_columns[ $i ]->featured_tag_selection; ?> class="uabb-featured-pricing-box"><?php echo $settings->pricing_columns[ $i ]->featured_text; ?></<?php echo $settings->pricing_columns[ $i ]->featured_tag_selection; ?>>
				<?php
			}
			?>
			<div class="uabb-pricing-table-inner-wrap">
				<<?php echo $settings->title_typography_tag_selection; ?> class="uabb-pricing-table-title"><?php echo $pricingColumn->title; ?></<?php echo $settings->title_typography_tag_selection; ?>>
				<<?php echo $settings->price_typography_tag_selection; ?> class="uabb-pricing-table-price">
					<?php echo $pricingColumn->price; ?>
					<?php
					if ( '' != $pricingColumn->duration ) {
						?>
					<span class="uabb-pricing-table-duration"><?php echo $pricingColumn->duration; ?></span>
						<?php
					}
					?>
				</<?php echo $settings->price_typography_tag_selection; ?>>
				<ul class="uabb-pricing-table-features">
					<?php
					if ( ! empty( $pricingColumn->features ) ) :
						for ( $j = 0; $j < count( $pricingColumn->features ); $j++ ) :
							?>
							<?php if ( '' != trim( $pricingColumn->features[ $j ] ) ) : ?>
						<li>
								<?php
								if ( 'yes' == $settings->add_legend && 'yes' == $settings->responsive_size ) :
									if ( isset( $settings->legend_column->features[ $j ] ) ) :
										?>
										<span class="uabb-pricing-ledgend">
											<?php echo $settings->legend_column->features[ $j ]; ?>
										</span>
										<?php
										endif;
							endif;
								?>

								<?php echo $pricingColumn->features[ $j ]; ?>
						</li>
						<?php endif; ?>
						<?php endfor; ?>
					<?php endif; ?> 
				</ul>
				<?php ( 'yes' == $settings->pricing_columns[ $i ]->show_button ) ? $module->render_button( $i ) : ''; ?>
				<?php do_action( 'uabb_price_box_button', $i ); ?>
			</div>
		</div>
	</div>
		<?php

	endfor;
	?>
</div>
