<?php
/**
 *  UABB WP Forms Styler  Module front-end file
 *
 *  @package UABB WP Forms Styler Module
 */

?>
<div class="uabb-wpf-styler ">
	<?php
	if ( 'default' === $settings->wp_custom_desc ) {
		$settings->wp_form_title = true;
		$settings->wp_form_desc  = true;
	} elseif ( 'custom' === $settings->wp_custom_desc ) {
		if ( $settings->wp_form_title ) {
			?>
			<<?php echo $settings->wp_form_title_tag_selection; ?> class="uabb-wpf-form-title"><?php echo $settings->wp_form_title; ?></<?php echo $settings->wp_form_title_tag_selection; ?>>
		<?php } ?>
		<?php if ( $settings->wp_form_desc ) { ?>
			<p class="uabb-wpf-form-desc"><?php echo $settings->wp_form_desc; ?></p>
			<?php
}
	}

	if ( $settings->wp_form_id ) {
		echo do_shortcode( '[wpforms id=' . $settings->wp_form_id . ' title=' . $settings->wp_form_title . ' description=' . $settings->wp_form_desc . ']' );
	}
	?>
</div>
