<?php
/**
 * Render the frontend content.
 *
 * @package UABB Dual Color Heading Module
 */

$first_heading_link_nofollow  = '';
$second_heading_link_nofollow = '';
$alignment                    = '';
if ( ! UABB_Compatibility::check_bb_version() ) {
	$alignment = $settings->dual_color_alignment;

} else {
	if ( isset( $settings->dual_typo['text_align'] ) ) {
		$alignment = $settings->dual_typo['text_align'];
	}
	$first_heading_link_nofollow = ( 'yes' == $settings->first_heading_link_nofollow ) ? '1' : '';

	$second_heading_link_nofollow = ( 'yes' == $settings->second_heading_link_nofollow ) ? '1' : '';
}
?>
<div class="uabb-module-content uabb-dual-color-heading <?php echo $alignment; ?> <?php echo $settings->responsive_compatibility; ?>">
	<?php
	echo '<' . $settings->dual_tag_selection . ' >';
	?>
	<?php if ( ! empty( $settings->first_heading_link ) ) : ?>
		<a href="<?php echo $settings->first_heading_link; ?>" title="<?php echo $settings->first_heading_text; ?>" target="<?php echo $settings->first_heading_link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->first_heading_link_target, $first_heading_link_nofollow, 1 ); ?>>
	<?php endif; ?>
	<span class="uabb-first-heading-text"><?php echo $settings->first_heading_text; ?></span>
	<?php if ( ! empty( $settings->first_heading_link ) ) : ?>
		</a>
	<?php endif; ?>

	<?php if ( ! empty( $settings->second_heading_link ) ) : ?>
		<a href="<?php echo $settings->second_heading_link; ?>" title="<?php echo $settings->second_heading_text; ?>" target="<?php echo $settings->second_heading_link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->second_heading_link_target, $second_heading_link_nofollow, 1 ); ?>>
	<?php endif; ?>
	<span class="uabb-second-heading-text"><?php echo $settings->second_heading_text; ?></span>
	<?php if ( ! empty( $settings->second_heading_link ) ) : ?>
		</a>
	<?php endif; ?>
	<?php echo '</' . $settings->dual_tag_selection . '>'; ?>
</div>


