<?php
/**
 *  UABB Before After Slider Module front-end file
 *
 *  @package UABB Before After Slider Module
 */

?>

<div class="uabb-module-content uabb-before-after-slider">
	<div class="uabb-module-content before-after-slider">
		<div class="uabb-ba-container baslider-<?php echo esc_attr( $module->node ); ?> uabb-label-position-<?php echo esc_attr( ( 'vertical' !== $settings->before_after_orientation ) ? $settings->slider_label_position : $settings->slider_vertical_label_position ); ?> <?php echo ( 'true' === $settings->move_on_hover ) ? 'uabb-move-on-hover' : ''; ?>" 
															<?php
															if ( isset( $settings->before_after_orientation ) && 'vertical' === $settings->before_after_orientation ) {
																echo "data-orientation='vertical'"; }
															?>
		>
			<?php if ( 'url' === $settings->before_image ) { ?>
				<?php if ( isset( $settings->before_photo_url ) && '' !== $settings->before_photo_url ) { ?>
					<img class="uabb-before-img" src="<?php echo $settings->before_photo_url; ?>" alt="<?php echo $settings->before_label_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"/>
				<?php } ?>
			<?php } else { ?>
				<?php if ( isset( $settings->before_photo_src ) && '' !== $settings->before_photo_src ) { ?>
					<img class="uabb-before-img" src="<?php echo $settings->before_photo_src; ?>" alt="<?php echo $settings->before_label_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"/>
				<?php } ?>
			<?php } ?>

			<?php if ( 'url' === $settings->after_image ) { ?>
				<?php if ( isset( $settings->after_photo_url ) && '' !== $settings->after_photo_url ) { ?>
					<img class="uabb-before-img" src="<?php echo $settings->after_photo_url; ?>" alt="<?php echo $settings->after_label_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"/>
				<?php } ?>
			<?php } else { ?>
				<?php if ( isset( $settings->after_photo_src ) && '' !== $settings->after_photo_src ) { ?>
					<img class="uabb-before-img" src="<?php echo $settings->after_photo_src; ?>" alt="<?php echo $settings->after_label_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"/>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
