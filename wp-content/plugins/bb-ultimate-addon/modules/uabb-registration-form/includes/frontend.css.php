<?php
/**
 *  Frontend CSS php file for Registration Form Module
 *
 *  @package Registration Module's Frontend.css.php file
 */

$version_bb_check                     = UABB_Compatibility::$version_bb_check;
$settings->form_bg_color              = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
$settings->input_background_color     = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
$settings->input_text_color           = UABB_Helper::uabb_colorpicker( $settings, 'input_text_color', true );
$settings->error_msg_color            = UABB_Helper::uabb_colorpicker( $settings, 'error_msg_color', true );
$settings->btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color', true );
$settings->btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
$settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );
$settings->btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color', true );
$settings->login_link_color           = UABB_Helper::uabb_colorpicker( $settings, 'login_link_color', true );
$settings->login_link_hover_color     = UABB_Helper::uabb_colorpicker( $settings, 'login_link_hover_color', true );
$settings->pass_week_color            = UABB_Helper::uabb_colorpicker( $settings, 'pass_week_color', true );
$settings->pass_medium_color          = UABB_Helper::uabb_colorpicker( $settings, 'pass_medium_color', true );
$settings->pass_strong_color          = UABB_Helper::uabb_colorpicker( $settings, 'pass_strong_color', true );
$settings->success_msg_color          = UABB_Helper::uabb_colorpicker( $settings, 'success_msg_color', true );
$settings->input_border_active_color  = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color', true );
$settings->label_color                = UABB_Helper::uabb_colorpicker( $settings, 'label_color', true );
$settings->checkbox_bgcolor           = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_bgcolor', true );
$settings->checkbox_selected_color    = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_selected_color', true );
$settings->checkbox_border_color      = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_border_color', true );
$settings->checkbox_text_color        = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_text_color', true );
$settings->terms_text_color           = UABB_Helper::uabb_colorpicker( $settings, 'terms_text_color', true );

?>

<?php
// Alignment.
if ( ! $version_bb_check ) {
	if ( isset( $settings->login_link_align ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rform-exteral-link-wrap {
			<?php echo ( '' !== $settings->login_link_align ) ? 'text-align:' . esc_attr( $settings->login_link_align ) . ';' : ''; ?>
		}
		<?php
	}
} else {

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'login_link_align',
			'selector'     => ".fl-node-$id .uabb-rform-exteral-link-wrap",
			'prop'         => 'text-align',
		)
	);
}
if ( ! $version_bb_check ) {
	if ( isset( $settings->pass_strength_align ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-verify {
			<?php echo ( '' !== $settings->pass_strength_align ) ? 'text-align:' . esc_attr( $settings->pass_strength_align ) . ';' : ''; ?>
		}
		<?php
	}
} else {

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'pass_strength_align',
			'selector'     => ".fl-node-$id .uabb-registration-form-pass-verify",
			'prop'         => 'text-align',
		)
	);
}
?>
<?php
if ( isset( $settings->columns_gap ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-input-group-wrap .uabb-input-group:nth-child(even):not(.uabb-rf-column-desktop_100):not( .uabb-rf-column-medium_100 ):not(.uabb-rf-column-responsive_100):not(.uabb-recaptcha):not(.uabb-rf-success-message-wrap) {
		<?php
			echo ( '' !== $settings->columns_gap ) ? 'padding-left: calc(' . esc_attr( $settings->columns_gap ) . 'px/2);' : '';
		?>
	}
<?php } ?>
<?php
if ( isset( $settings->columns_gap ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-input-group-wrap .uabb-input-group:nth-child(odd):not(.uabb-rf-column-desktop_100):not( .uabb-rf-column-medium_100 ):not(.uabb-rf-column-responsive_100):not(.uabb-recaptcha):not(.uabb-rf-success-message-wrap) {
		<?php
			echo ( '' !== $settings->columns_gap ) ? 'padding-right: calc(' . esc_attr( $settings->columns_gap ) . 'px/2);' : '';
		?>
	}
	<?php
}
?>
<?php
if ( isset( $settings->row_gap ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-input-group-wrap .uabb-input-group {
		<?php
			echo ( '' !== $settings->row_gap ) ? 'margin-bottom:' . esc_attr( $settings->row_gap ) . 'px;' : '';
		?>
	}
	<?php
}
if ( isset( $settings->label_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form label {
		<?php
			echo ( '' !== $settings->label_color ) ? 'color:' . esc_attr( $settings->label_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->label_bottom_margin ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form input {
		<?php
			echo ( '' !== $settings->label_bottom_margin ) ? 'margin-top:' . esc_attr( $settings->label_bottom_margin ) . 'px;' : '';
		?>
	}
	<?php
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-match.success {
	<?php
	if ( isset( $settings->success_msg_color ) && '' !== $settings->success_msg_color ) {
		echo 'color:' . esc_attr( $settings->success_msg_color ) . ';';
	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-match.error {
	<?php
	if ( isset( $settings->error_msg_color ) && '' !== $settings->error_msg_color ) {
		echo 'color:' . esc_attr( $settings->error_msg_color ) . ';';
	}

	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
	<?php
	if ( isset( $settings->success_msg_color ) ) {
		echo ( '' !== $settings->success_msg_color ) ? 'color:' . esc_attr( $settings->success_msg_color ) . ';' : '';
	}
	if ( isset( $settings->success_msg_padding_top ) ) {
		echo ( '' !== $settings->success_msg_padding_top ) ? 'padding-top:' . esc_attr( $settings->success_msg_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_right ) ) {
		echo ( '' !== $settings->success_msg_padding_right ) ? 'padding-right:' . esc_attr( $settings->success_msg_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_left ) ) {
		echo ( '' !== $settings->success_msg_padding_left ) ? 'padding-left:' . esc_attr( $settings->success_msg_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_bottom ) ) {
		echo ( '' !== $settings->success_msg_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->success_msg_padding_bottom ) . 'px;' : '';
	}
	?>
}
<?php
if ( isset( $settings->pass_strong_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-verify.strong {
		<?php
			echo ( '' !== $settings->pass_strong_color ) ? 'color:' . esc_attr( $settings->pass_strong_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->pass_medium_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-verify.good {
		<?php
			echo ( '' !== $settings->pass_medium_color ) ? 'color:' . esc_attr( $settings->pass_medium_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->pass_week_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form-pass-verify.short {
		<?php
			echo ( '' !== $settings->pass_week_color ) ? 'color:' . esc_attr( $settings->pass_week_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->login_link_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link:hover {
		<?php
			echo ( '' !== $settings->login_link_hover_color ) ? 'color:' . esc_attr( $settings->login_link_hover_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->login_link_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link {
		<?php
			echo ( '' !== $settings->login_link_color ) ? 'color:' . esc_attr( $settings->login_link_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->btn_bottom_margin ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn {
		<?php
			echo ( '' !== $settings->btn_bottom_margin ) ? 'margin-bottom:' . esc_attr( $settings->btn_bottom_margin ) . 'px;' : '';
		?>
	}
	<?php
}
if ( isset( $settings->btn_top_margin ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn {
		<?php
			echo ( '' !== $settings->btn_top_margin ) ? 'margin-top:' . esc_attr( $settings->btn_top_margin ) . 'px;' : '';
		?>
	}
	<?php
}
?>
<?php if ( 'color' === $settings->btn_background_type ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
		<?php
		if ( isset( $settings->btn_background_color ) ) {
			echo ( '' !== $settings->btn_background_color ) ? 'background:' . esc_attr( $settings->btn_background_color ) . ';' : '';
		}
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit:hover {
		<?php
		if ( isset( $settings->btn_background_hover_color ) ) {
			echo ( '' !== $settings->btn_background_hover_color ) ? 'background:' . esc_attr( $settings->btn_background_hover_color ) . ';' : '';
		}
		?>
	}	
<?php } else { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_background_gradient ) ) {
				echo ( '' !== $settings->btn_background_gradient ) ? 'background:' . esc_attr( FLBuilderColor::gradient( $settings->btn_background_gradient ) ) . ';' : '';
			}
			?>
		}
	<?php
}
if ( isset( $settings->btn_text_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text:hover {
		<?php
			echo ( '' !== $settings->btn_text_hover_color ) ? 'color:' . esc_attr( $settings->btn_text_hover_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->btn_text_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text {
		<?php
			echo ( '' !== $settings->btn_text_color ) ? 'color:' . esc_attr( $settings->btn_text_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->invalid_border_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group .uabb-registration-form-error input {
		<?php
			echo ( '' !== $settings->invalid_border_color ) ? 'border-color:' . esc_attr( $settings->invalid_border_color ) . ';' : '';
		?>
	}
<?php } if ( isset( $settings->error_msg_color ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-registration_form-error-message-required,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-registration-form-error .uabb-registration-error {
		<?php
			echo ( '' !== $settings->error_msg_color ) ? 'color:' . esc_attr( $settings->error_msg_color ) . ';' : '';
		?>
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form {
	<?php
	if ( isset( $settings->form_border_style ) ) {
		echo ( '' !== $settings->form_border_style ) ? 'border-style:' . esc_attr( $settings->form_border_style ) . ';' : '';
	}
	if ( isset( $settings->form_border_width ) ) {
		echo ( '' !== $settings->form_border_width ) ? 'border-width:' . esc_attr( $settings->form_border_width ) . 'px;' : '';
	}
	if ( isset( $settings->form_border_color ) ) {
		echo ( '' !== $settings->form_border_color ) ? 'border-color:' . esc_attr( $settings->form_border_color ) . ';' : '';
	}
	?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_border',
				'selector'     => ".fl-node-$id .uabb-registration-form",
			)
		);
	}
}
?>
<?php if ( '' !== $settings->input_border_active_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap input:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap input:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap textarea:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap textarea:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-terms-checkbox span:focus:before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-terms-checkbox span:active:before {
		border-color: <?php echo esc_attr( $settings->input_border_active_color ); ?>;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_border_style ) ) {
		echo ( '' !== $settings->input_border_style ) ? 'border-style:' . esc_attr( $settings->input_border_style ) . ';' : '';
	}
	if ( isset( $settings->input_border_width ) ) {
		echo ( '' !== $settings->input_border_width ) ? 'border-width:' . esc_attr( $settings->input_border_width ) . 'px;' : '';
	}
	if ( isset( $settings->input_border_color ) ) {
		echo ( '' !== $settings->input_border_color ) ? 'border-color:' . esc_attr( $settings->input_border_color ) . ';' : '';
	}
	?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_border',
				'selector'     => ".fl-node-$id .uabb-registration-form .uabb-input-group input",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
	<?php
	if ( isset( $settings->button_border_style ) ) {
		echo ( '' !== $settings->button_border_style ) ? 'border-style:' . esc_attr( $settings->button_border_style ) . ';' : '';
	}
	if ( isset( $settings->button_border_width ) ) {
		echo ( '' !== $settings->button_border_width ) ? 'border-width:' . esc_attr( $settings->button_border_width ) . 'px;' : '';
	}
	if ( isset( $settings->button_border_color ) ) {
		echo ( '' !== $settings->button_border_color ) ? 'border-color:' . esc_attr( $settings->button_border_color ) . ';' : '';
	}
	?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-node-$id .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
		<?php
		if ( isset( $settings->success_msg_border_style ) ) {
			echo ( '' !== $settings->success_msg_border_style ) ? 'border-style:' . esc_attr( $settings->success_msg_border_style ) . ';' : '';
		}
		if ( isset( $settings->success_msg_border_width ) ) {
			echo ( '' !== $settings->success_msg_border_width ) ? 'border-width:' . esc_attr( $settings->success_msg_border_width ) . 'px;' : '';
		}
		if ( isset( $settings->success_msg_border_color ) ) {
			echo ( '' !== $settings->success_msg_border_color ) ? 'border-color:' . esc_attr( $settings->success_msg_border_color ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'success_msg_border',
				'selector'     => ".fl-node-$id .uabb-rf-success-message-wrap .uabb-rf-success-message",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
	<?php
	if ( isset( $settings->btn_padding_top ) ) {
		echo ( '' !== $settings->btn_padding_top ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_left ) ) {
		echo ( '' !== $settings->btn_padding_left ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_right ) ) {
		echo ( '' !== $settings->btn_padding_right ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_bottom ) ) {
		echo ( '' !== $settings->btn_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form input::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_text_color ) ) {
		echo ( '' !== $settings->input_text_color ) ? 'color:' . esc_attr( $settings->input_text_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_padding_top ) ) {
		echo ( '' !== $settings->input_padding_top ) ? 'padding-top:' . esc_attr( $settings->input_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_left ) ) {
		echo ( '' !== $settings->input_padding_left ) ? 'padding-left:' . esc_attr( $settings->input_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_right ) ) {
		echo ( '' !== $settings->input_padding_right ) ? 'padding-right:' . esc_attr( $settings->input_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_bottom ) ) {
		echo ( '' !== $settings->input_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->input_background_color ) ) {
		echo ( '' !== $settings->input_background_color ) ? 'background:' . esc_attr( $settings->input_background_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form { 
	<?php
	if ( isset( $settings->form_spacing_dimension_top ) ) {
		echo ( '' !== $settings->form_spacing_dimension_top ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top ) . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_left ) ) {
		echo ( '' !== $settings->form_spacing_dimension_left ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left ) . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_right ) ) {
		echo ( '' !== $settings->form_spacing_dimension_right ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right ) . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_bottom ) ) {
		echo ( '' !== $settings->form_spacing_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->form_bg_color ) && 'color' === $settings->form_bg_type ) {
		echo ( '' !== $settings->form_bg_color ) ? 'background:' . esc_attr( $settings->form_bg_color ) . ';' : '';
	}
	if ( isset( $settings->form_bg_gradient ) && 'gradient' === $settings->form_bg_type ) {
		echo ( '' !== $settings->form_bg_gradient ) ? 'background:' . esc_attr( FLBuilderColor::gradient( $settings->form_bg_gradient ) ) . ';' : '';
	}

	?>
}

<!--Terms and Conditions code starts here. -->
<?php if ( 'show' === $settings->terms_checkbox ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap .uabb-terms-label {
		color: <?php echo esc_attr( $settings->checkbox_text_color ); ?>;
	}

	/* Check-boxes typography CSS */
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-terms-label {

			<?php if ( 'Default' !== $settings->checkbox_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->checkbox_font_family ); ?>
			<?php endif; ?>

			<?php if ( isset( $settings->checkbox_font_size ) && '' !== $settings->checkbox_font_size ) : ?>
				font-size: <?php echo esc_attr( $settings->checkbox_font_size ); ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->checkbox_line_height ) && '' !== $settings->checkbox_line_height ) : ?>
				line-height: <?php echo esc_attr( $settings->checkbox_line_height ); ?>em;
			<?php endif; ?>

			<?php if ( 'none' !== $settings->checkbox_text_transform ) : ?>
				text-transform: <?php echo esc_attr( $settings->checkbox_text_transform ); ?>;
			<?php endif; ?>

			<?php if ( '' !== $settings->checkbox_text_letter_spacing ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->checkbox_text_letter_spacing ); ?>px;
			<?php endif; ?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'checkbox_typo',
					'selector'     => ".fl-node-$id .uabb-registration-form .uabb-terms-label",
				)
			);
		}
	}
}
?>

<?php if ( 'show' === $settings->terms_checkbox ) { ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-terms-text {
		<?php if ( isset( $settings->terms_text_color ) && '' !== $settings->terms_text_color ) { ?>
			color: <?php echo esc_attr( $settings->terms_text_color ); ?>;
		<?php } ?>

	}

	/* Terms typography CSS */
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-terms-text {

			<?php if ( 'Default' !== $settings->terms_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->terms_font_family ); ?>
			<?php endif; ?>

			<?php if ( isset( $settings->terms_font_size ) && '' !== $settings->terms_font_size ) : ?>
				font-size: <?php echo esc_attr( $settings->terms_font_size ); ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->terms_line_height ) && '' !== $settings->terms_line_height ) : ?>
				line-height: <?php echo esc_attr( $settings->terms_line_height ); ?>em;
			<?php endif; ?>

			<?php if ( 'none' !== $settings->terms_text_transform ) : ?>
				text-transform: <?php echo esc_attr( $settings->terms_text_transform ); ?>;
			<?php endif; ?>

			<?php if ( '' !== $settings->terms_text_letter_spacing ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->terms_text_letter_spacing ); ?>px;
			<?php endif; ?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'terms_typo',
					'selector'     => ".fl-node-$id .uabb-registration-form .uabb-terms-text",
				)
			);
		}
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap .uabb-terms-label {
	color: <?php echo esc_attr( $settings->checkbox_text_color ); ?>;
}
<?php
$font_size     = intval( $settings->checkbox_size );
$checked_width = $font_size - intval( $settings->checkbox_border_width );
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap .uabb-terms-label input[type="checkbox"] + span:before {
	<?php if ( isset( $settings->checkbox_bgcolor ) && '' !== $settings->checkbox_bgcolor ) : ?>
	background-color: <?php echo esc_attr( $settings->checkbox_bgcolor ); ?>;
	<?php endif; ?>
	border-width: <?php echo esc_attr( $settings->checkbox_border_width ); ?>px;
	border-color: <?php echo esc_attr( $settings->checkbox_border_color ); ?>;
	width: <?php echo esc_attr( $settings->checkbox_size ); ?>px;
	height: <?php echo esc_attr( $settings->checkbox_size ); ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap input[type="checkbox"]:checked + span:before {
	font-size: <?php echo esc_attr( $checked_width ); ?>px;
	line-height: <?php echo esc_attr( $checked_width ); ?>px;
	color: <?php echo esc_attr( $settings->checkbox_selected_color ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group-wrap input[type="checkbox"] + span:before {
	border-radius: <?php echo esc_attr( $settings->checkbox_border_radius ); ?>px;
}

/* Terms and Conditions code ends here */

<?php
if ( 'yes' === $settings->inline_btn_login_text && 'yes' === $settings->login_link && 'no' === $settings->lost_your_pass ) {
	if ( 'show' === $settings->terms_checkbox ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-input-group.uabb-terms-checkbox {
			width: 100%;
		}
<?php } ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
		display: inline;
		width: 50%;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-input-group.uabb-rform-exteral-link-wrap {
		width: 50%;
		margin-bottom: 0;
		margin-top: 10px;
		height: auto;
	}
	<?php
}

/* Typography responsive css */
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-registration_form-error-message-required,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php if ( 'default' !== $settings->message_link_font_family['family'] && 'default' !== $settings->message_link_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->message_link_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->message_link_font_size_unit ) ) {
				echo ( '' !== $settings->message_link_font_size_unit ) ? 'font-size:' . esc_attr( $settings->message_link_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->message_link_line_height_unit ) ) {
				echo ( '' !== $settings->message_link_line_height_unit ) ? 'line-height:' . esc_attr( $settings->message_link_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->message_link_letter_spacing ) ) {
				echo ( '' !== $settings->message_link_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->message_link_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->message_link_transform ) ) {
				echo ( '' !== $settings->message_link_transform ) ? 'text-transform:' . esc_attr( $settings->message_link_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'message_link_typo',
				'selector'     => ".fl-node-$id .uabb-rf-success-message-wrap .uabb-rf-success-message,.fl-node-$id .uabb-registration-form .uabb-registration_form-error-message-required",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link {
			<?php if ( 'default' !== $settings->login_link_font_family['family'] && 'default' !== $settings->login_link_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->login_link_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->login_link_font_size_unit ) ) {
				echo ( '' !== $settings->login_link_font_size_unit ) ? 'font-size:' . esc_attr( $settings->login_link_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->login_link_line_height_unit ) ) {
				echo ( '' !== $settings->login_link_line_height_unit ) ? 'line-height:' . esc_attr( $settings->login_link_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->login_link_letter_spacing ) ) {
				echo ( '' !== $settings->login_link_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->login_link_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->login_link_transform ) ) {
				echo ( '' !== $settings->login_link_transform ) ? 'text-transform:' . esc_attr( $settings->login_link_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'login_link_typo',
				'selector'     => ".fl-node-$id .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text {
			<?php if ( 'default' !== $settings->btn_font_family['family'] && 'default' !== $settings->btn_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->btn_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->btn_font_size_unit ) ) {
				echo ( '' !== $settings->btn_font_size_unit ) ? 'font-size:' . esc_attr( $settings->btn_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->btn_line_height_unit ) ) {
				echo ( '' !== $settings->btn_line_height_unit ) ? 'line-height:' . esc_attr( $settings->btn_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->btn_letter_spacing ) ) {
				echo ( '' !== $settings->btn_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->btn_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->btn_transform ) ) {
				echo ( '' !== $settings->btn_transform ) ? 'text-transform:' . esc_attr( $settings->btn_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo',
				'selector'     => ".fl-node-$id .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
		<?php if ( 'default' !== $settings->font_family['family'] && 'default' !== $settings->font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->font_size_unit ) ) {
			echo ( '' !== $settings->font_size_unit ) ? 'font-size:' . esc_attr( $settings->font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->line_height_unit ) ) {
			echo ( '' !== $settings->line_height_unit ) ? 'line-height:' . esc_attr( $settings->line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->letter_spacing ) ) {
			echo ( '' !== $settings->letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->letter_spacing ) . 'px;' : '';
		}
		if ( isset( $settings->transform ) ) {
			echo ( '' !== $settings->transform ) ? 'text-transform:' . esc_attr( $settings->transform ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_typo',
				'selector'     => ".fl-node-$id .uabb-registration-form .uabb-input-group input,.fl-node-$id .uabb-registration-form input::placeholder",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form label {
		<?php if ( 'default' !== $settings->label_font_family['family'] && 'default' !== $settings->label_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->label_font_size_unit ) ) {
			echo ( '' !== $settings->label_font_size_unit ) ? 'font-size:' . esc_attr( $settings->label_font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->label_line_height_unit ) ) {
			echo ( '' !== $settings->label_line_height_unit ) ? 'line-height:' . esc_attr( $settings->label_line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->label_letter_spacing ) ) {
			echo ( '' !== $settings->label_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->label_letter_spacing ) . 'px;' : '';
		}
		if ( isset( $settings->label_transform ) ) {
			echo ( '' !== $settings->label_transform ) ? 'text-transform:' . esc_attr( $settings->label_transform ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'label_typo',
				'selector'     => ".fl-node-$id .uabb-registration-form label,.fl-node-$id .uabb-registration-form input::placeholder",
			)
		);
	}
}
?>
<?php if ( $global_settings->responsive_enabled ) { ?>

	/* CSS for medium Device */

	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text {
				<?php
				if ( isset( $settings->btn_font_size_unit_medium ) ) {
					echo ( '' !== $settings->btn_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->btn_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_unit_medium ) ) {
					echo ( '' !== $settings->btn_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->btn_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
				<?php
				if ( isset( $settings->font_size_medium ) ) {
					echo ( '' !== $settings->font_size_medium ) ? 'font-size:' . esc_attr( $settings->font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->line_height_medium ) ) {
					echo ( '' !== $settings->line_height_medium ) ? 'line-height:' . esc_attr( $settings->line_height_medium ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form label {
				<?php
				if ( isset( $settings->label_font_size_medium ) ) {
					echo ( '' !== $settings->label_font_size_medium ) ? 'font-size:' . esc_attr( $settings->label_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->label_line_height_medium ) ) {
					echo ( '' !== $settings->label_line_height_medium ) ? 'line-height:' . esc_attr( $settings->label_line_height_medium ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-registration_form-error-message-required,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
				<?php
				if ( isset( $settings->message_link_font_size_medium ) ) {
					echo ( '' !== $settings->message_link_font_size_medium ) ? 'font-size:' . esc_attr( $settings->message_link_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->message_link_line_height_medium ) ) {
					echo ( '' !== $settings->message_link_line_height_medium ) ? 'line-height:' . esc_attr( $settings->message_link_line_height_medium ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php
			if ( isset( $settings->success_msg_padding_top_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->success_msg_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_right_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->success_msg_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_left_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->success_msg_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_bottom_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->success_msg_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form { 
			<?php
			if ( isset( $settings->form_spacing_dimension_top_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
			<?php
			if ( isset( $settings->input_padding_top_medium ) ) {
				echo ( '' !== $settings->input_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->input_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_left_medium ) ) {
				echo ( '' !== $settings->input_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->input_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_right_medium ) ) {
				echo ( '' !== $settings->input_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->input_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_bottom_medium ) ) {
				echo ( '' !== $settings->input_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_padding_top_medium ) ) {
				echo ( '' !== $settings->btn_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_left_medium ) ) {
				echo ( '' !== $settings->btn_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_right_medium ) ) {
				echo ( '' !== $settings->btn_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_bottom_medium ) ) {
				echo ( '' !== $settings->btn_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text {
				<?php
				if ( isset( $settings->btn_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->btn_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->btn_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->btn_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->btn_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
				<?php
				if ( isset( $settings->font_size_unit_responsive ) ) {
					echo ( '' !== $settings->font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->line_height_unit_responsive ) ) {
					echo ( '' !== $settings->line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form label {
				<?php
				if ( isset( $settings->label_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->label_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->label_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->label_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->label_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->label_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-registration_form-error-message-required,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
				<?php
				if ( isset( $settings->message_link_font_size_responsive ) ) {
					echo ( '' !== $settings->message_link_font_size_responsive ) ? 'font-size:' . esc_attr( $settings->message_link_font_size_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->message_link_line_height_responsive ) ) {
					echo ( '' !== $settings->message_link_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->message_link_line_height_responsive ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php
			if ( isset( $settings->success_msg_padding_top_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->success_msg_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_right_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->success_msg_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_left_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->success_msg_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->success_msg_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form { 
			<?php
			if ( isset( $settings->form_spacing_dimension_top_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-input-group input {
			<?php
			if ( isset( $settings->input_padding_top_responsive ) ) {
				echo ( '' !== $settings->input_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->input_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_left_responsive ) ) {
				echo ( '' !== $settings->input_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->input_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_right_responsive ) ) {
				echo ( '' !== $settings->input_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->input_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->input_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_padding_top_responsive ) ) {
				echo ( '' !== $settings->btn_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_left_responsive ) ) {
				echo ( '' !== $settings->btn_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_right_responsive ) ) {
				echo ( '' !== $settings->btn_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->btn_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
	}
	<?php
}
?>
