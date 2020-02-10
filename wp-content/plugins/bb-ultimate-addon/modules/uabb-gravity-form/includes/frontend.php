<?php
/**
 *  UABB Gravity Form Module front-end file
 *
 *  @package UABB Gravity Form Module
 */

?>

<div class="uabb-gf-style <?php echo 'uabb-gf-form-style1'; ?>">
	<?php
		$form_title  = ''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$description = '';
	if ( 'yes' === $settings->form_title_option ) {
		if ( class_exists( 'GFAPI' ) ) {
			$form        = GFAPI::get_form( absint( $settings->form_id ) );
			$form_title  = $form['title']; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$description = $form['description'];
		}
	} elseif ( 'no' === $settings->form_title_option ) {
		$form_title  = $settings->form_title; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$description = $settings->form_desc;
	} else {
		$form_title  = ''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$description = '';
	}
	if ( '' !== $form_title ) {
		?>
		<<?php echo esc_attr( $settings->form_title_tag_selection ); ?> class="uabb-gf-form-title"><?php echo wp_kses_post( $form_title ); ?></<?php echo esc_attr( $settings->form_title_tag_selection ); ?>>
	<?php } ?>

	<?php if ( '' !== $description ) { ?>
		<p class="uabb-gf-form-desc"><?php echo wp_kses_post( $description ); ?></p>
	<?php } ?>

	<?php
	if ( $settings->form_id ) {
		echo do_shortcode( '[gravityform id=' . absint( $settings->form_id ) . ' ajax=' . $settings->form_ajax_option . ' title="false" description="false" tabindex=' . $settings->form_tab_index_option . ']' );
	}
	?>
</div>
