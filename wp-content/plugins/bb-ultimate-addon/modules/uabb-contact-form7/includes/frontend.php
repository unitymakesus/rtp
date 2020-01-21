<?php
/**
 *  UABB Contact Form 7 Module front-end file
 *
 *  @package UABB Contact Form 7 Module
 */

?>

<div class="uabb-cf7-style <?php echo 'uabb-cf7-form-style1'; ?>">
	<?php if ( $settings->form_title ) { ?>
		<<?php echo $settings->form_title_tag_selection; ?> class="uabb-cf7-form-title"><?php echo $settings->form_title; ?></<?php echo $settings->form_title_tag_selection; ?>>
	<?php } ?>

	<?php if ( $settings->form_desc ) { ?>
		<p class="uabb-cf7-form-desc"><?php echo $settings->form_desc; ?></p>
		<?php
}
	?>
	<?php

	if ( $settings->form_id ) {
		echo do_shortcode( '[contact-form-7 id=' . absint( $settings->form_id ) . ']' );
	}
	?>

</div>
