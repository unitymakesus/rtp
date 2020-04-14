<?php
/**
 *  UABB Photo Module file
 *
 *  @package UABB Photo Module
 */

$photo   = $module->get_data();
$classes = $module->get_classes();
$src     = $module->get_src();
$link    = $module->get_link(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$alt     = $module->get_alt();
$attrs   = $module->get_attributes();
$title   = $module->get_title(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

$grayscale_class = '';
if ( 'simple' === $settings->hover_effect ) {
	if ( 'yes' !== $settings->img_grayscale_simple ) {
		$grayscale_class = 'uabb-img-color-gray';
	} else {
		$grayscale_class = '';
	}
} elseif ( 'style2' === $settings->hover_effect ) {
	if ( 'yes' !== $settings->img_grayscale_grayscale ) {
		$grayscale_class = 'uabb-img-grayscale uabb-img-gray-color';
	} else {
		$grayscale_class = 'uabb-img-grayscale';
	}
}
$link_url_nofollow = '';
$link_url_target   = '';
if ( UABB_Compatibility::$version_bb_check ) {
	if ( isset( $settings->link_url_target ) ) {
		$link_url_target = $settings->link_url_target;
	}
	if ( isset( $settings->link_url_nofollow ) ) {
		$link_url_nofollow = ( 'yes' === $settings->link_url_nofollow ) ? '1' : '';
	}
} else {
	if ( isset( $settings->link_target ) ) {
		$link_url_target = $settings->link_target;
	}
	if ( isset( $settings->link_nofollow ) ) {
		$link_url_nofollow = $settings->link_nofollow;
	}
}

?>
<div class="uabb-module-content uabb-photo
<?php
if ( ! empty( $settings->crop ) ) {
	echo ' uabb-photo-crop-' . esc_attr( $settings->crop );}
?>
uabb-photo-align-<?php echo esc_attr( $settings->align ); ?> uabb-photo-mob-align-<?php echo esc_attr( $settings->responsive_align ); ?>" itemscope itemtype="https://schema.org/ImageObject">
	<div class="uabb-photo-content <?php echo esc_attr( $grayscale_class ); ?>">

		<?php if ( ! empty( $link ) ) : ?>
		<a href="<?php echo $link; ?>" target="<?php echo esc_attr( $link_url_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $link_url_target, $link_url_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> itemprop="url">
		<?php endif; ?>
		<img class="<?php echo esc_attr( $classes ); ?>" src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $title ); ?>" itemprop="image" <?php echo wp_kses_post( $attrs ); ?> />

		<?php if ( $photo && ! empty( $photo->caption ) && 'hover' === $settings->show_caption ) : ?>
		<div class="uabb-photo-caption uabb-photo-caption-hover" itemprop="caption"><?php echo $photo->caption; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		<?php endif; ?>
		<?php if ( ! empty( $link ) ) : ?>
		</a>
		<?php endif; ?>
	</div>
	<?php if ( $photo && ! empty( $photo->caption ) && 'below' === $settings->show_caption ) : ?>
	<div class="uabb-photo-caption uabb-photo-caption-below" itemprop="caption"><?php echo $photo->caption; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
	<?php endif; ?>
</div>
