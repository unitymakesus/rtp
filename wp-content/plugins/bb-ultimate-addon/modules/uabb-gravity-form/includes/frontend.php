<?php
/**
 *  UABB Gravity Form Module front-end file
 *
 *  @package UABB Gravity Form Module
 */

?>

<div class="uabb-gf-style <?php echo 'uabb-gf-form-style1'; ?>">
	<?php
		$title       = '';
		$description = '';
	if ( 'yes' == $settings->form_title_option ) {
		if ( class_exists( 'GFAPI' ) ) {
			$form        = GFAPI::get_form( absint( $settings->form_id ) );
			$title       = $form['title'];
			$description = $form['description'];
		}
	} elseif ( 'no' == $settings->form_title_option ) {
		$title       = $settings->form_title;
		$description = $settings->form_desc;
	} else {
		$title       = '';
		$description = '';
	}
	if ( '' != $title ) {
		?>
		<<?php echo $settings->form_title_tag_selection; ?> class="uabb-gf-form-title"><?php echo $title; ?></<?php echo $settings->form_title_tag_selection; ?>>
	<?php } ?>

	<?php if ( '' != $description ) { ?>
		<p class="uabb-gf-form-desc"><?php echo $description; ?></p>
	<?php } ?>

	<?php
	if ( $settings->form_id ) {
		echo do_shortcode( '[gravityform id=' . absint( $settings->form_id ) . ' ajax=' . $settings->form_ajax_option . ' title="false" description="false" tabindex=' . $settings->form_tab_index_option . ']' );
	}
	?>
</div>
