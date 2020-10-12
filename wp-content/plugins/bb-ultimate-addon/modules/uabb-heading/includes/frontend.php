<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

if ( isset( $settings->link_nofollow ) && UABB_Compatibility::$version_bb_check ) {
	$link_nofollow = $settings->link_nofollow;
} else {
	$link_nofollow = 0;
}
?>

<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo esc_attr( $settings->alignment ); ?> <?php echo esc_attr( ( 'line_text' === $settings->separator_style ) ? $settings->responsive_compatibility : '' ); ?>">
<?php if ( 'yes' === ( $settings->background_text ) ) { ?>
<div class="uabb-background-heading-wrap" data-background-text="<?php echo $settings->bg_heading_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
<?php } ?>
	<?php $module->render_separator( 'top' ); ?>

	<?php if ( 'bottom' === $settings->desc_position ) { ?>

	<<?php echo esc_attr( $settings->tag ); ?> class="uabb-heading">
		<?php if ( ! empty( $settings->link ) ) : ?>
		<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo esc_attr( $settings->link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php endif; ?>
		<span class="uabb-heading-text"><?php echo $settings->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php if ( ! empty( $settings->link ) ) : ?>
		</a>
		<?php endif; ?>
	</<?php echo esc_attr( $settings->tag ); ?>>
	<?php } ?>

	<?php if ( '' !== $settings->description && 'top' === $settings->desc_position ) : ?>
	<div class="uabb-subheading uabb-text-editor">
		<?php echo $settings->description; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<?php endif; ?>

	<?php $module->render_separator( 'center' ); ?>

	<?php if ( '' !== $settings->description && 'bottom' === $settings->desc_position ) : ?>
	<div class="uabb-subheading uabb-text-editor">
		<?php echo $settings->description; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<?php endif; ?>

	<?php if ( 'top' === $settings->desc_position ) { ?>

	<<?php echo esc_attr( $settings->tag ); ?> class="uabb-heading">
		<?php if ( ! empty( $settings->link ) ) : ?>
		<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo esc_attr( $settings->link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<?php endif; ?>
		<span class="uabb-heading-text"><?php echo $settings->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php if ( ! empty( $settings->link ) ) : ?>
		</a>
		<?php endif; ?>
	</<?php echo esc_attr( $settings->tag ); ?>>
	<?php } ?>
	<?php $module->render_separator( 'bottom' ); ?>
<?php if ( 'yes' === ( $settings->background_text ) ) { ?>
	</div>
<?php } ?>
</div>
