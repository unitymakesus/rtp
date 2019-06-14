<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Heading Module
 */

?>

<div class="uabb-module-content <?php echo $module->get_classname(); ?>">
	<div class="uabb-cta-text">
		<<?php echo $settings->title_tag_selection; ?> class="uabb-cta-title"><?php echo $settings->title; ?></<?php echo $settings->title_tag_selection; ?>>

		<?php if ( '' != $settings->text ) { ?>
		<span class="uabb-cta-text-content uabb-text-editor"><?php echo $settings->text; ?></span>
		<?php } ?>

	</div>
	<div class="uabb-cta-button">
		<?php $module->render_button(); ?>
	</div>
</div>
