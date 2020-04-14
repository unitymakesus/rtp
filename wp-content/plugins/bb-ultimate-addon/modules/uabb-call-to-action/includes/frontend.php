<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

?>

<div class="uabb-module-content <?php echo wp_kses_post( $module->get_classname() ); ?>">
	<div class="uabb-cta-text">
		<<?php echo esc_attr( $settings->title_tag_selection ); ?> class="uabb-cta-title"><?php echo $settings->title; ?></<?php echo esc_attr( $settings->title_tag_selection ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

		<?php if ( '' !== $settings->text ) { ?>
		<span class="uabb-cta-text-content uabb-text-editor"><?php echo $settings->text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php } ?>

	</div>
	<div class="uabb-cta-button">
		<?php $module->render_button(); ?>
	</div>
</div>
