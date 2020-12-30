<?php
/**
 * Render the frontend content.
 *
 * @package UABB Dual Color Heading Module
 */

$first_heading_link_nofollow  = '';
$second_heading_link_nofollow = '';
$alignment                    = '';
$layout                       = 'uabb-heading-layout-' . $settings->layout_option;
$dual_align                   = 'uabb-heading-align-' . $settings->dual_head_alignment;

if ( ! UABB_Compatibility::$version_bb_check ) {
	$alignment = $settings->dual_color_alignment;

} else {
	if ( isset( $settings->dual_typo['text_align'] ) ) {
		$alignment = $settings->dual_typo['text_align'];
	}
	$first_heading_link_nofollow = ( 'yes' === $settings->first_heading_link_nofollow ) ? '1' : '';

	$second_heading_link_nofollow = ( 'yes' === $settings->second_heading_link_nofollow ) ? '1' : '';
}
?>
<div class="uabb-module-content uabb-dual-color-heading <?php echo esc_attr( $alignment ); ?> <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( $dual_align ); ?> <?php echo esc_attr( $settings->responsive_compatibility ); ?>">
<?php
	echo '<' . esc_attr( $settings->dual_tag_selection ) . ' >';
?>
<?php if ( 'yes' === ( $settings->bg_text ) ) { ?>
<div class="uabb-bg-heading-wrap" data-background-text="<?php echo $settings->bg_heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
<?php } ?>

	<?php if ( ! empty( $settings->first_heading_link ) ) : ?>
		<a href="<?php echo $settings->first_heading_link; ?>" title="<?php echo $settings->first_heading_text; ?>" target="<?php echo esc_attr( $settings->first_heading_link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->first_heading_link_target, $first_heading_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php endif; ?>
	<span class="uabb-first-heading-text"><?php echo $settings->first_heading_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php if ( ! empty( $settings->first_heading_link ) ) : ?>
		</a>
	<?php endif; ?>

	<?php if ( ! empty( $settings->second_heading_link ) ) : ?>
		<a href="<?php echo $settings->second_heading_link; ?>" title="<?php echo $settings->second_heading_text; ?>" target="<?php echo esc_attr( $settings->second_heading_link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->second_heading_link_target, $second_heading_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php endif; ?>
	<span class="uabb-second-heading-text"><?php echo $settings->second_heading_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php if ( ! empty( $settings->second_heading_link ) ) : ?>
		</a>
	<?php endif; ?>
	<?php if ( ! empty( $settings->after_heading_text ) ) { ?>
	<span class="uabb-after-heading-text"><?php echo $settings->after_heading_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php } ?>
	<?php if ( 'yes' === ( $settings->bg_text ) ) { ?>
	</div>
<?php } ?>
	<?php echo '</' . esc_attr( $settings->dual_tag_selection ) . '>'; ?>	
</div>
