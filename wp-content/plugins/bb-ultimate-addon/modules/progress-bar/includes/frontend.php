<?php
/**
 *  UABB Progress Bar Module front-end file
 *
 *  @package UABB Progress Bar Module
 */

?>

<div class="uabb-module-content uabb-pb-container">
	<ul class="uabb-pb-list <?php echo ( 'yes' == $settings->vertical_responsive ) ? 'uabb-responsive-list' : ''; ?>">
		<?php
		if ( count( $settings->horizontal ) > 0 ) {
			for ( $i = 0; $i < count( $settings->horizontal ); $i++ ) {
				$tmp = $settings->horizontal;
				if ( is_object( $tmp[ $i ] ) ) {
					$style                        = ( 'horizontal' == $settings->layout ) ? $settings->horizontal_style : $settings->vertical_style;
					$tmp[ $i ]->horizontal_number = ( '' != $tmp[ $i ]->horizontal_number ) ? $tmp[ $i ]->horizontal_number : '80';
					?>
		<li>
			<div class="uabb-progress-bar-wrapper uabb-vertical-center uabb-layout-<?php echo $settings->layout; ?> uabb-progress-bar-style-<?php echo $style; ?> uabb-progress-bar-<?php echo $i; ?>" data-number="<?php echo  ( 'circular' != $settings->layout ) ? $tmp[ $i ]->horizontal_number : ''; ?>">
					<?php
					if ( 'horizontal' == $settings->layout ) {
						$module->render_horizontal_content( $tmp[ $i ], 'style1', '', $i );
						$module->render_horizontal_content( $tmp[ $i ], 'style4', 'above', $i );
						$module->render_horizontal_progress_bar( $tmp[ $i ], $i );
						$module->render_horizontal_content( $tmp[ $i ], 'style2', '', $i );
						$module->render_horizontal_content( $tmp[ $i ], 'style4', 'below', $i );
					} elseif ( 'vertical' == $settings->layout ) {
						$module->render_vertical_content( $tmp[ $i ], 'style1', $i );
						$module->render_vertical_progress_bar( $tmp[ $i ], $i );
						$module->render_vertical_content( $tmp[ $i ], 'style2', $i );
						$module->render_vertical_content( $tmp[ $i ], 'style3', $i );
					} elseif ( 'circular' == $settings->layout ) {
						?>
				<div class="uabb-percent-wrap">
					<span class="uabb-percent-before-text uabb-ba-text"><?php echo $tmp[ $i ]->circular_before_number; ?></span>
					<div class="uabb-percent-counter">0%</div>
					<span class="uabb-percent-after-text uabb-ba-text"><?php echo $tmp[ $i ]->circular_after_number; ?></span>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo $tmp[ $i ]->horizontal_number; ?>">
						<?php $module->render_circle_progress_bar( $tmp[ $i ], $i ); ?>
				</div>
						<?php
					} elseif ( 'semi-circular' == $settings->layout ) {
						?>
				<div class="uabb-percent-wrap">

					<div class="uabb-percent-counter">0%</div>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo $tmp[ $i ]->horizontal_number; ?>">
						<?php $module->render_semi_circle_progress_bar( $tmp[ $i ], $i ); ?>

				</div>
				<span class="uabb-semi-progress-before uabb-ba-text"><?php echo $tmp[ $i ]->circular_before_number; ?></span>
				<span class="uabb-semi-progress-after uabb-ba-text"><?php echo $tmp[ $i ]->circular_after_number; ?></span>
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
