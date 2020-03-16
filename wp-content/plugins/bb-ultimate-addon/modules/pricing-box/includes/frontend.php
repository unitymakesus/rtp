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
		$pricingColumn = $settings->pricing_columns[ $i ]; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase

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
				<<?php echo esc_attr( $settings->title_typography_tag_selection ); ?> class="uabb-pricing-table-title"><?php echo $pricingColumn->title; ?></<?php echo esc_attr( $settings->title_typography_tag_selection ); // @codingStandardsIgnoreLine. ?>>
				<<?php echo esc_attr( $settings->price_typography_tag_selection ); ?> class="uabb-pricing-table-price">
					<?php echo $pricingColumn->price; // @codingStandardsIgnoreLine. ?>
					<?php
					if ( '' !== $pricingColumn->duration ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
						?>
					<span class="uabb-pricing-table-duration"><?php echo $pricingColumn->duration; // @codingStandardsIgnoreLine. ?></span>
						<?php
					}
					?>
				</<?php echo esc_attr( $settings->price_typography_tag_selection ); ?>>
				<ul class="uabb-pricing-table-features">
					<?php
					if ( ! empty( $pricingColumn->features ) ) : // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
						$count = count( $pricingColumn->features ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
						for ( $j = 0; $j < $count; $j++ ) :
							?>
							<?php if ( '' !== trim( $pricingColumn->features[ $j ] ) ) : // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase ?>
						<li>
								<?php
								if ( 'yes' === $settings->add_legend && 'yes' === $settings->responsive_size ) :
									if ( isset( $settings->legend_column->features[ $j ] ) ) : // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
										?>
										<span class="uabb-pricing-ledgend">
											<?php echo $settings->legend_column->features[ $j ]; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</span>
										<?php
										endif;
							endif;
								?>

								<?php echo $pricingColumn->features[ $j ]; // @codingStandardsIgnoreLine. ?>
						</li>
						<?php endif; ?>
						<?php endfor; ?>
					<?php endif; ?> 
				</ul>
				<?php ( 'yes' === $settings->pricing_columns[ $i ]->show_button ) ? $module->render_button( $i ) : ''; ?>
				<?php do_action( 'uabb_price_box_button', $i ); ?>
			</div>
		</div>
	</div>
		<?php

	endfor;
	?>
</div>
