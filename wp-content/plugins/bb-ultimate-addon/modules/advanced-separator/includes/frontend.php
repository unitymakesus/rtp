<?php
/**
 *  UABB Advanced Separator Module front-end file
 *
 *  @package UABB Advanced Separator Module
 */

?>

<div class="uabb-module-content uabb-separator-parent">

	<?php if ( 'line_icon' === $settings->separator || 'line_image' === $settings->separator || 'line_text' === $settings->separator ) { ?>
		<div class="uabb-separator-wrap <?php echo 'uabb-separator-' . esc_attr( $settings->alignment ); ?> <?php echo ( 'line_text' === $settings->separator ) ? esc_attr( $settings->responsive_compatibility ) : ''; ?>">
			<div class="uabb-separator-line uabb-side-left">
				<span></span>
			</div>

			<div class="uabb-divider-content uabbi-divider">
				<?php $module->render_image(); ?>
				<?php
				if ( 'line_text' === $settings->separator ) {
						echo '<' . esc_attr( $settings->text_tag_selection ) . ' class="uabb-divider-text">' . $settings->text_inline . '</' . esc_attr( $settings->text_tag_selection ) . '>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>

			<div class="uabb-separator-line uabb-side-right">
				<span></span>
			</div> 
		</div>
	<?php } ?>

	<?php if ( 'line' === $settings->separator ) { ?>
		<div class="uabb-separator"></div>
	<?php } ?>
</div>
