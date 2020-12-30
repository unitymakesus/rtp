<?php
/**
 *  UABB Progress Bar Module front-end file
 *
 *  @package UABB Progress Bar Module
 */

?>

<div class="uabb-module-content uabb-pb-container">
	<ul class="uabb-pb-list <?php echo ( 'yes' === $settings->vertical_responsive ) ? 'uabb-responsive-list' : ''; ?>">
		<?php
		if ( count( $settings->horizontal ) > 0 ) {
			$count = count( $settings->horizontal );
			for ( $i = 0; $i < $count; $i++ ) {
				$tmp = $settings->horizontal;
				if ( is_object( $tmp[ $i ] ) ) {
					$style                        = ( 'horizontal' === $settings->layout ) ? $settings->horizontal_style : $settings->vertical_style;
					$tmp[ $i ]->horizontal_number = ( '' !== $tmp[ $i ]->horizontal_number ) ? $tmp[ $i ]->horizontal_number : '80';
					?>
		<li>
			<div class="uabb-progress-bar-wrapper uabb-vertical-center uabb-layout-<?php echo esc_attr( $settings->layout ); ?> uabb-progress-bar-style-<?php echo esc_attr( $style ); ?> uabb-progress-bar-<?php echo esc_attr( $i ); ?>" data-number="<?php echo ( 'circular' !== $settings->layout ) ? esc_attr( $tmp[ $i ]->horizontal_number ) : ''; ?>">
					<?php
					if ( 'horizontal' === $settings->layout ) {
						$module->render_horizontal_content( $i, $tmp[ $i ], 'style1' );
						$module->render_horizontal_content( $i, $tmp[ $i ], 'style4', 'above' );
						$module->render_horizontal_progress_bar( $tmp[ $i ], $i );
						$module->render_horizontal_content( $i, $tmp[ $i ], 'style2' );
						$module->render_horizontal_content( $i, $tmp[ $i ], 'style4', 'below' );
					} elseif ( 'vertical' === $settings->layout ) {
						$module->render_vertical_content( $i, $tmp[ $i ], 'style1' );
						$module->render_vertical_progress_bar( $tmp[ $i ], $i );
						$module->render_vertical_content( $i, $tmp[ $i ], 'style2' );
						$module->render_vertical_content( $i, $tmp[ $i ], 'style3' );
					} elseif ( 'circular' === $settings->layout ) {
						?>
				<div class="uabb-percent-wrap">
					<span class="uabb-percent-before-text uabb-ba-text"><?php echo $tmp[ $i ]->circular_before_number; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div class="uabb-percent-counter">0%</div>
					<span class="uabb-percent-after-text uabb-ba-text"><?php echo $tmp[ $i ]->circular_after_number; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo esc_attr( $tmp[ $i ]->horizontal_number ); ?>">
						<?php $module->render_circle_progress_bar( $tmp[ $i ], $i ); ?>
				</div>
						<?php
					} elseif ( 'semi-circular' === $settings->layout ) {
						?>
				<div class="uabb-percent-wrap">

					<div class="uabb-percent-counter">0%</div>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo esc_attr( $tmp[ $i ]->horizontal_number ); ?>">
						<?php $module->render_semi_circle_progress_bar( $tmp[ $i ], $i ); ?>

				</div>
				<span class="uabb-semi-progress-before uabb-ba-text"><?php echo $tmp[ $i ]->circular_before_number; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span class="uabb-semi-progress-after uabb-ba-text"><?php echo $tmp[ $i ]->circular_after_number; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<?php
					}
					?>
			</div>
		</li>
					<?php
				}
			}
		}
		?>
		</ul>
</div>
