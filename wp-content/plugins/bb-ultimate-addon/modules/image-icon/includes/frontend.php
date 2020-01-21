<?php
/**
 *  UABB Image Icon Module front-end file
 *
 *  @package UABB Image Icon Module
 */

if ( 'none' != $settings->image_type && '' != $settings->image_type ) { ?>
<div class="uabb-module-content uabb-imgicon-wrap"><?php /* Module Wrap */ ?>
	<?php /*Icon Html */ ?>
	<?php if ( 'icon' == $settings->image_type ) { ?>
		<span class="uabb-icon-wrap">
			<span class="uabb-icon">
				<i class="<?php echo $settings->icon; ?>"></i>
			</span>
		</span>
	<?php } // Icon Html End. ?>

	<?php if ( 'photo' == $settings->image_type ) { // Photo Html. ?>
		<?php
			$classes = $module->get_classes();
			$src     = $module->get_src();
			$alt     = $module->get_alt();
			$title   = $module->get_title();


		?>
		<div class="uabb-image
		<?php
		if ( ! empty( $settings->image_style ) ) {
			echo ' uabb-image-crop-' . $settings->image_style;}
		?>
		" itemscope itemtype="https://schema.org/ImageObject">
			<div class="uabb-image-content">
				<img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>" itemprop="image"/>
			</div>
		</div>

	<?php } // Photo Html End. ?>
	</div><?php /* End Module Wrap */ ?>
<?php } ?>
