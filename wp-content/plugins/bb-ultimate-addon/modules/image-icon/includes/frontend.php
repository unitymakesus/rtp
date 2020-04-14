<?php
/**
 *  UABB Image Icon Module front-end file
 *
 *  @package UABB Image Icon Module
 */

if ( 'none' !== $settings->image_type && '' !== $settings->image_type ) { ?>
<div class="uabb-module-content uabb-imgicon-wrap"><?php /* Module Wrap */ ?>
	<?php /*Icon Html */ ?>
	<?php if ( 'icon' === $settings->image_type ) { ?>
		<span class="uabb-icon-wrap">
			<span class="uabb-icon">
				<i class="<?php echo wp_kses_post( $settings->icon ); ?>"></i>
			</span>
		</span>
	<?php } // Icon Html End. ?>

	<?php if ( 'photo' === $settings->image_type ) { // Photo Html. ?>
		<?php
			$classes     = $module->get_classes();
			$src         = $module->get_src();
			$alt         = $module->get_alt();
			$image_title = $module->get_title();
		?>
		<div class="uabb-image
		<?php
		if ( ! empty( $settings->image_style ) ) {
			echo ' uabb-image-crop-' . esc_attr( $settings->image_style );}
		?>
		" itemscope itemtype="https://schema.org/ImageObject">
			<div class="uabb-image-content">
				<img class="<?php echo esc_attr( $classes ); ?>" src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>" itemprop="image"/>
			</div>
		</div>

	<?php } // Photo Html End. ?>
	</div><?php /* End Module Wrap */ ?>
<?php } ?>
