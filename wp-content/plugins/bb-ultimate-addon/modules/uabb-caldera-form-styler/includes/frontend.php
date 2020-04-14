<?php
/**
 *  UABB Caldera Forms Styler front-end file
 *
 *  @package UABB Caldera Forms Styler
 */

$field_size_class               = '';
$button_size_class              = '';
$button_align_class             = '';
$button_align_class_tablet      = '';
$button_align_class_mobile      = '';
$form_fields_align_class        = '';
$form_fields_align_class_tablet = '';
$form_fields_align_class_mobile = '';

/* Input Size class */
if ( isset( $settings->field_size ) && ! empty( $settings->field_size ) ) {

	if ( 'extra_small' === $settings->field_size ) {

		$field_size_class = 'uabb-caf-input-size-xs';
	}
	if ( 'small' === $settings->field_size ) {

		$field_size_class = 'uabb-caf-input-size-sm';
	}
	if ( 'medium' === $settings->field_size ) {

		$field_size_class = 'uabb-caf-input-size-md';
	}
	if ( 'large' === $settings->field_size ) {

		$field_size_class = 'uabb-caf-input-size-lg';
	}
	if ( 'extra_large' === $settings->field_size ) {

		$field_size_class = 'uabb-caf-input-size-xl';
	}
}
/* Submit Button Size class */
if ( isset( $settings->button_size ) && ! empty( $settings->button_size ) ) {

	if ( 'extra_small' === $settings->button_size ) {

		$button_size_class = 'uabb-caf-btn-size-xs';
	}
	if ( 'small' === $settings->button_size ) {

		$button_size_class = 'uabb-caf-btn-size-sm';
	}
	if ( 'medium' === $settings->button_size ) {

		$button_size_class = 'uabb-caf-btn-size-md';
	}
	if ( 'large' === $settings->button_size ) {

		$button_size_class = 'uabb-caf-btn-size-lg';
	}
	if ( 'extra_large' === $settings->button_size ) {

		$button_size_class = 'uabb-caf-btn-size-xl';
	}
}

if ( isset( $settings->button_align ) && ! empty( $settings->button_align ) ) {

	$button_align_class = 'uabb-caf-button-' . $settings->button_align;

}

if ( isset( $settings->button_align_medium ) && ! empty( $settings->button_align_medium ) ) {

	$button_align_class_tablet = 'uabb-caf-button-tablet-' . $settings->button_align_medium;

}

if ( isset( $settings->button_align_responsive ) && ! empty( $settings->button_align_responsive ) ) {

	$button_align_class_mobile = 'uabb-caf-button-mobile-' . $settings->button_align_responsive;

}

if ( isset( $settings->form_fields_align ) && ! empty( $settings->form_fields_align ) ) {

	$form_fields_align_class = 'uabb-field-' . $settings->form_fields_align;

}

if ( isset( $settings->form_fields_align_medium ) && ! empty( $settings->form_fields_align_medium ) ) {

	$form_fields_align_class_tablet = 'uabb-field-tablet-' . $settings->form_fields_align_medium;

}

if ( isset( $settings->form_fields_align_responsive ) && ! empty( $settings->form_fields_align_responsive ) ) {

	$form_fields_align_class_mobile = 'uabb-field-mobile-' . $settings->form_fields_align_responsive;

}

if ( empty( $settings->caf_form_id ) || '0' === $settings->caf_form_id ) { ?>

	<div class="uabb-form-editor-message"><?php esc_html_e( 'Please select a Caldera Form.', 'uabb' ); ?></div>

<?php } else { ?>
	<div class="uabb-caldera-form-wrapper">
		<div class="uabb-caf-form 
		<?php
		echo esc_attr( $field_size_class );
		echo ' ' . esc_attr( $button_size_class );
		echo ' ' . esc_attr( $button_align_class );
		echo ' ' . esc_attr( $button_align_class_tablet );
		echo ' ' . esc_attr( $button_align_class_mobile );
		echo ' ' . esc_attr( $form_fields_align_class );
		echo ' ' . esc_attr( $form_fields_align_class_tablet );
		echo ' ' . esc_attr( $form_fields_align_class_mobile );
		if ( 'yes' === $settings->override_checkbox_radio_style ) {

			echo ' uabb-caf-radio-custom';
		}
		if ( 'yes' === $settings->disable_shadow_effect ) {

			echo ' uabb-caf-shadow-yes';
		}
		?>
		">
		<?php
		if ( 'yes' === $settings->caf_custom_desc ) {
			if ( $settings->caf_form_title ) {
				?>
				<<?php echo esc_attr( $settings->title_tag_selection ); ?> class="uabb-caf-form-title"><?php echo $settings->caf_form_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></<?php echo esc_attr( $settings->title_tag_selection ); ?>>
				<?php } ?>
			<?php if ( $settings->caf_form_desc ) { ?>
				<p class="uabb-caf-form-desc"><?php echo $settings->caf_form_desc; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php
			}
		}
		?>
			<?php echo do_shortcode( '[caldera_form id="' . $settings->caf_form_id . '" ]' ); ?>
		</div>
	</div>	
<?php } ?>
