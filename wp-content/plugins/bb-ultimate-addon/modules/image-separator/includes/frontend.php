<?php
/**
 *  UABB Image Separator Module front-end file
 *
 *  @package UABB Image Separator Module
 */

	$classes = $module->get_classes();
	$src     = $module->get_src();
	$alt     = $module->get_alt();
?>
<div class="uabb-module-content uabb-imgseparator-wrap">
	<?php if ( 'yes' === $settings->enable_link ) : ?>
	<a class="imgseparator-link" href="<?php echo $settings->link; ?>" target="<?php echo esc_attr( $settings->link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, 0, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>></a>
	<?php endif; ?>
	<div class="uabb-image-separator uabb-image
	<?php
	if ( ! empty( $settings->image_style ) ) {
		echo ' uabb-image-crop-' . esc_attr( $settings->image_style );}
	?>
	" itemscope itemtype="https://schema.org/ImageObject">
		<img class="<?php echo esc_attr( $classes ); ?> <?php echo ( '0' === $settings->img_animation_repeat ) ? 'infinite' : ''; ?>" src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" itemprop="image"/>
	</div>
</div>
