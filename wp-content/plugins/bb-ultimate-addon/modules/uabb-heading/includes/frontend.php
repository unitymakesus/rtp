<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

if ( isset( $settings->link_nofollow ) && UABB_Compatibility::check_bb_version() ) {
	$link_nofollow = $settings->link_nofollow;
} else {
	$link_nofollow = 0;
}
?>
<div class="uabb-module-content uabb-heading-wrapper uabb-heading-align-<?php echo $settings->alignment; ?> <?php echo ( 'line_text' == $settings->separator_style ) ? $settings->responsive_compatibility : ''; ?>">
		<?php $module->render_separator( 'top' ); ?>
	<<?php echo $settings->tag; ?> class="uabb-heading">
		<?php if ( ! empty( $settings->link ) ) : ?>
		<a href="<?php echo $settings->link; ?>" title="<?php echo $settings->heading; ?>" target="<?php echo $settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $link_nofollow, 1 ); ?>>
		<?php endif; ?>
		<span class="uabb-heading-text"><?php echo $settings->heading; ?></span>
		<?php if ( ! empty( $settings->link ) ) : ?>
		</a>
		<?php endif; ?>
	</<?php echo $settings->tag; ?>>
	<?php $module->render_separator( 'center' ); ?>
	<?php if ( '' != $settings->description ) : ?>
	<div class="uabb-subheading uabb-text-editor">
		<?php echo $settings->description; ?>
	</div>
	<?php endif; ?>
	<?php $module->render_separator( 'bottom' ); ?>
</div>
