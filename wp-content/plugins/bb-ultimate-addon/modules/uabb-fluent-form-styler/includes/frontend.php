<?php
/**
 *  UABB WP Fluent Forms Styler front-end file
 *
 *  @package UABB WP Fluent Forms Styler
 */

?>

<div class="uabb-fluent-form-content">
<?php
// @codingStandardsIgnoreStart.
	if ( $settings->custom_title ) {
		?>
				<<?php echo esc_attr( $settings->title_tag_selection ); ?> class="uabb-ff-form-title"><?php echo $settings->custom_title; ?></<?php echo esc_attr( $settings->title_tag_selection ); ?>>
				<?php } ?>
			<?php if ( $settings->custom_description ) { ?>
				<p class="uabb-ff-form-description"><?php echo $settings->custom_description; ?></p>
				<?php
			}
?>
	<?php
	if ( $settings->select_form_field ) {
		echo do_shortcode( '[fluentform id=' . $settings->select_form_field . ']' );
	}
			// @codingStandardsIgnoreEnd.

	?>
</div>


