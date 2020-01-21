<?php
/**
 *  UABB Team Module front-end file
 *
 *  @package UABB Team Module
 */

?>
<?php

$grayscale_class = '';
if ( 'simple' == $settings->photo_style ) {
	if ( 'yes' != $settings->img_grayscale_simple ) {
		$grayscale_class = 'uabb-img-color-gray';
	} else {
		$grayscale_class = '';
	}
} elseif ( 'grayscale' == $settings->photo_style ) {
	if ( 'yes' != $settings->img_grayscale_grayscale ) {
		$grayscale_class = 'uabb-img-grayscale uabb-img-gray-color';
	} else {
		$grayscale_class = 'uabb-img-grayscale';
	}
}

?>

<div class="uabb-module-content uabb-team-wrap">
	<div class="uabb-team-member-wrap">
		<div class="uabb-team-image <?php echo $grayscale_class; ?>">
		<?php
			// Render Team Image.
			$module->render_image();
		?>
		</div> 
		<?php
			$module->render_separator( 'below_image' );
		?>
		<div class="uabb-team-content">
		<?php
			// Text.
			$module->render_name();
			$module->render_separator( 'below_name' );
			$module->render_desgn();
			$module->render_separator( 'below_desg' );
			$module->render_desc();
			$module->render_separator( 'below_desc' );
		?>
			<?php if ( 'yes' == $settings->enable_social_icons ) { ?>
				<div class="uabb-team-social">
				<?php
					$module->render_social_icons();
				?>
				</div> 
			<?php } ?>
		</div>
	</div>
</div>
