<?php
/**
 *  Frontend CSS php file for Registration Form Module
 *
 *  @package Registration Module's Frontend.css.php file
 */

$version_bb_check                     = UABB_Compatibility::check_bb_version();
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
?>
<?php
// Alignment.
if ( ! $version_bb_check ) {
	if ( isset( $settings->login_link_align ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-rform-exteral-link-wrap {
			<?php echo ( '' !== $settings->login_link_align ) ? 'text-align:' . $settings->login_link_align . ';' : ''; ?>
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
		.fl-node-<?php echo $id; ?> .uabb-registration-form-pass-verify {
			<?php echo ( '' !== $settings->pass_strength_align ) ? 'text-align:' . $settings->pass_strength_align . ';' : ''; ?>
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
	.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group:nth-child(even):not(.uabb-rf-column-desktop_100):not( .uabb-rf-column-medium_100 ):not(.uabb-rf-column-responsive_100):not(.uabb-recaptcha):not(.uabb-rf-success-message-wrap) {
		<?php
			echo ( '' !== $settings->columns_gap ) ? 'padding-left: calc(' . $settings->columns_gap . 'px/2);' : '';
		?>
	}
<?php } ?>
<?php
if ( isset( $settings->columns_gap ) ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group:nth-child(odd):not(.uabb-rf-column-desktop_100):not( .uabb-rf-column-medium_100 ):not(.uabb-rf-column-responsive_100):not(.uabb-recaptcha):not(.uabb-rf-success-message-wrap) {
		<?php
			echo ( '' !== $settings->columns_gap ) ? 'padding-right: calc(' . $settings->columns_gap . 'px/2);' : '';
		?>
	}
<?php
}
?>
<?php
if ( isset( $settings->row_gap ) ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group {
		<?php
			echo ( '' !== $settings->row_gap ) ? 'margin-bottom:' . $settings->row_gap . 'px;' : '';
		?>
	}
<?php
}
if ( isset( $settings->label_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo $id; ?> .uabb-registration-form label {
		<?php
			echo ( '' !== $settings->label_color ) ? 'color:' . $settings->label_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->label_bottom_margin ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form input {
		<?php
			echo ( '' !== $settings->label_bottom_margin ) ? 'margin-top:' . $settings->label_bottom_margin . 'px;' : '';
		?>
	}
<?php
}
?>
.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
	<?php
	if ( isset( $settings->success_msg_color ) ) {
		echo ( '' !== $settings->success_msg_color ) ? 'color:' . $settings->success_msg_color . ';' : '';
	}
	if ( isset( $settings->success_msg_padding_top ) ) {
		echo ( '' !== $settings->success_msg_padding_top ) ? 'padding-top:' . $settings->success_msg_padding_top . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_right ) ) {
		echo ( '' !== $settings->success_msg_padding_right ) ? 'padding-right:' . $settings->success_msg_padding_right . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_left ) ) {
		echo ( '' !== $settings->success_msg_padding_left ) ? 'padding-left:' . $settings->success_msg_padding_left . 'px;' : '';
	}
	if ( isset( $settings->success_msg_padding_bottom ) ) {
		echo ( '' !== $settings->success_msg_padding_bottom ) ? 'padding-bottom:' . $settings->success_msg_padding_bottom . 'px;' : '';
	}
	?>
}
<?php
if ( isset( $settings->pass_strong_color ) ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form-pass-verify.strong {
		<?php
			echo ( '' !== $settings->pass_strong_color ) ? 'color:' . $settings->pass_strong_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->pass_medium_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form-pass-verify.good {
		<?php
			echo ( '' !== $settings->pass_medium_color ) ? 'color:' . $settings->pass_medium_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->pass_week_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form-pass-verify.short {
		<?php
			echo ( '' !== $settings->pass_week_color ) ? 'color:' . $settings->pass_week_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->login_link_hover_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link:hover {
		<?php
			echo ( '' !== $settings->login_link_hover_color ) ? 'color:' . $settings->login_link_hover_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->login_link_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link {
		<?php
			echo ( '' !== $settings->login_link_color ) ? 'color:' . $settings->login_link_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->btn_bottom_margin ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn {
		<?php
			echo ( '' !== $settings->btn_bottom_margin ) ? 'margin-bottom:' . $settings->btn_bottom_margin . 'px;' : '';
		?>
	}
<?php
}
if ( isset( $settings->btn_top_margin ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn {
		<?php
			echo ( '' !== $settings->btn_top_margin ) ? 'margin-top:' . $settings->btn_top_margin . 'px;' : '';
		?>
	}
<?php
}
?>
<?php if ( 'color' === $settings->btn_background_type ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
		<?php
		if ( isset( $settings->btn_background_color ) ) {
			echo ( '' !== $settings->btn_background_color ) ? 'background:' . $settings->btn_background_color . ';' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit:hover {
		<?php
		if ( isset( $settings->btn_background_hover_color ) ) {
			echo ( '' !== $settings->btn_background_hover_color ) ? 'background:' . $settings->btn_background_hover_color . ';' : '';
		}
		?>
	}	
<?php } else { ?>
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_background_gradient ) ) {
				echo ( '' !== $settings->btn_background_gradient ) ? 'background:' . FLBuilderColor::gradient( $settings->btn_background_gradient ) . ';' : '';
			}
			?>
		}
<?php
}
if ( isset( $settings->btn_text_hover_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text:hover {
		<?php
			echo ( '' !== $settings->btn_text_hover_color ) ? 'color:' . $settings->btn_text_hover_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->btn_text_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button-text {
		<?php
			echo ( '' !== $settings->btn_text_color ) ? 'color:' . $settings->btn_text_color . ';' : '';
		?>
	}
<?php
}
if ( isset( $settings->invalid_border_color ) ) {
?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group .uabb-registration-form-error input {
		<?php
			echo ( '' !== $settings->invalid_border_color ) ? 'border-color:' . $settings->invalid_border_color . ';' : '';
		?>
	}
<?php } if ( isset( $settings->error_msg_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-registration_form-error-message-required {
		<?php
			echo ( '' !== $settings->error_msg_color ) ? 'color:' . $settings->error_msg_color . ';' : '';
		?>
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form {
	<?php
	if ( isset( $settings->form_border_style ) ) {
		echo ( '' !== $settings->form_border_style ) ? 'border-style:' . $settings->form_border_style . ';' : '';
	}
	if ( isset( $settings->form_border_width ) ) {
		echo ( '' !== $settings->form_border_width ) ? 'border-width:' . $settings->form_border_width . 'px;' : '';
	}
	if ( isset( $settings->form_border_color ) ) {
		echo ( '' !== $settings->form_border_color ) ? 'border-color:' . $settings->form_border_color . ';' : '';
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
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group-wrap input:active,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group-wrap input:focus,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group-wrap textarea:active,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group-wrap textarea:focus,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-terms-checkbox span:focus:before,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-terms-checkbox span:active:before {
		border-color: <?php echo $settings->input_border_active_color; ?>;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_border_style ) ) {
		echo ( '' !== $settings->input_border_style ) ? 'border-style:' . $settings->input_border_style . ';' : '';
	}
	if ( isset( $settings->input_border_width ) ) {
		echo ( '' !== $settings->input_border_width ) ? 'border-width:' . $settings->input_border_width . 'px;' : '';
	}
	if ( isset( $settings->input_border_color ) ) {
		echo ( '' !== $settings->input_border_color ) ? 'border-color:' . $settings->input_border_color . ';' : '';
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
.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
	<?php
	if ( isset( $settings->button_border_style ) ) {
		echo ( '' !== $settings->button_border_style ) ? 'border-style:' . $settings->button_border_style . ';' : '';
	}
	if ( isset( $settings->button_border_width ) ) {
		echo ( '' !== $settings->button_border_width ) ? 'border-width:' . $settings->button_border_width . 'px;' : '';
	}
	if ( isset( $settings->button_border_color ) ) {
		echo ( '' !== $settings->button_border_color ) ? 'border-color:' . $settings->button_border_color . ';' : '';
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
	.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
		<?php
		if ( isset( $settings->success_msg_border_style ) ) {
			echo ( '' !== $settings->success_msg_border_style ) ? 'border-style:' . $settings->success_msg_border_style . ';' : '';
		}
		if ( isset( $settings->success_msg_border_width ) ) {
			echo ( '' !== $settings->success_msg_border_width ) ? 'border-width:' . $settings->success_msg_border_width . 'px;' : '';
		}
		if ( isset( $settings->success_msg_border_color ) ) {
			echo ( '' !== $settings->success_msg_border_color ) ? 'border-color:' . $settings->success_msg_border_color . ';' : '';
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
.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn.uabb-registration-form-submit {
	<?php
	if ( isset( $settings->btn_padding_top ) ) {
		echo ( '' !== $settings->btn_padding_top ) ? 'padding-top:' . $settings->btn_padding_top . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_left ) ) {
		echo ( '' !== $settings->btn_padding_left ) ? 'padding-left:' . $settings->btn_padding_left . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_right ) ) {
		echo ( '' !== $settings->btn_padding_right ) ? 'padding-right:' . $settings->btn_padding_right . 'px;' : '';
	}
	if ( isset( $settings->btn_padding_bottom ) ) {
		echo ( '' !== $settings->btn_padding_bottom ) ? 'padding-bottom:' . $settings->btn_padding_bottom . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-registration-form input::placeholder,
.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_text_color ) ) {
		echo ( '' !== $settings->input_text_color ) ? 'color:' . $settings->input_text_color . ';' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
	<?php
	if ( isset( $settings->input_padding_top ) ) {
		echo ( '' !== $settings->input_padding_top ) ? 'padding-top:' . $settings->input_padding_top . 'px;' : '';
	}
	if ( isset( $settings->input_padding_left ) ) {
		echo ( '' !== $settings->input_padding_left ) ? 'padding-left:' . $settings->input_padding_left . 'px;' : '';
	}
	if ( isset( $settings->input_padding_right ) ) {
		echo ( '' !== $settings->input_padding_right ) ? 'padding-right:' . $settings->input_padding_right . 'px;' : '';
	}
	if ( isset( $settings->input_padding_bottom ) ) {
		echo ( '' !== $settings->input_padding_bottom ) ? 'padding-bottom:' . $settings->input_padding_bottom . 'px;' : '';
	}
	if ( isset( $settings->input_background_color ) ) {
		echo ( '' !== $settings->input_background_color ) ? 'background:' . $settings->input_background_color . ';' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-registration-form { 
	<?php
	if ( isset( $settings->form_spacing_dimension_top ) ) {
		echo ( '' !== $settings->form_spacing_dimension_top ) ? 'padding-top:' . $settings->form_spacing_dimension_top . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_left ) ) {
		echo ( '' !== $settings->form_spacing_dimension_left ) ? 'padding-left:' . $settings->form_spacing_dimension_left . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_right ) ) {
		echo ( '' !== $settings->form_spacing_dimension_right ) ? 'padding-right:' . $settings->form_spacing_dimension_right . 'px;' : '';
	}
	if ( isset( $settings->form_spacing_dimension_bottom ) ) {
		echo ( '' !== $settings->form_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom . 'px;' : '';
	}
	if ( isset( $settings->form_bg_color ) && 'color' === $settings->form_bg_type ) {
		echo ( '' !== $settings->form_bg_color ) ? 'background:' . $settings->form_bg_color . ';' : '';
	}
	if ( isset( $settings->form_bg_gradient ) && 'gradient' === $settings->form_bg_type ) {
		echo ( '' !== $settings->form_bg_gradient ) ? 'background:' . FLBuilderColor::gradient( $settings->form_bg_gradient ) . ';' : '';
	}

	?>
}
<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-registration_form-error-message-required,
		.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php if ( 'default' !== $settings->message_link_font_family['family'] && 'default' !== $settings->message_link_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->message_link_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->message_link_font_size_unit ) ) {
				echo ( '' !== $settings->message_link_font_size_unit ) ? 'font-size:' . $settings->message_link_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->message_link_line_height_unit ) ) {
				echo ( '' !== $settings->message_link_line_height_unit ) ? 'line-height:' . $settings->message_link_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->message_link_letter_spacing ) ) {
				echo ( '' !== $settings->message_link_letter_spacing ) ? 'letter-spacing:' . $settings->message_link_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->message_link_transform ) ) {
				echo ( '' !== $settings->message_link_transform ) ? 'text-transform:' . $settings->message_link_transform . ';' : '';
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
		.fl-node-<?php echo $id; ?> .uabb-rform-exteral-link-wrap .uabb-rform-exteral-link {
			<?php if ( 'default' !== $settings->login_link_font_family['family'] && 'default' !== $settings->login_link_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->login_link_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->login_link_font_size_unit ) ) {
				echo ( '' !== $settings->login_link_font_size_unit ) ? 'font-size:' . $settings->login_link_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->login_link_line_height_unit ) ) {
				echo ( '' !== $settings->login_link_line_height_unit ) ? 'line-height:' . $settings->login_link_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->login_link_letter_spacing ) ) {
				echo ( '' !== $settings->login_link_letter_spacing ) ? 'letter-spacing:' . $settings->login_link_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->login_link_transform ) ) {
				echo ( '' !== $settings->login_link_transform ) ? 'text-transform:' . $settings->login_link_transform . ';' : '';
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
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text {
			<?php if ( 'default' !== $settings->btn_font_family['family'] && 'default' !== $settings->btn_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->btn_font_family ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->btn_font_size_unit ) ) {
				echo ( '' !== $settings->btn_font_size_unit ) ? 'font-size:' . $settings->btn_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->btn_line_height_unit ) ) {
				echo ( '' !== $settings->btn_line_height_unit ) ? 'line-height:' . $settings->btn_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->btn_letter_spacing ) ) {
				echo ( '' !== $settings->btn_letter_spacing ) ? 'letter-spacing:' . $settings->btn_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->btn_transform ) ) {
				echo ( '' !== $settings->btn_transform ) ? 'text-transform:' . $settings->btn_transform . ';' : '';
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
				'selector'     => ".fl-node-$id .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
		<?php if ( 'default' !== $settings->font_family['family'] && 'default' !== $settings->font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->font_size_unit ) ) {
			echo ( '' !== $settings->font_size_unit ) ? 'font-size:' . $settings->font_size_unit . 'px;' : '';
		}
		if ( isset( $settings->line_height_unit ) ) {
			echo ( '' !== $settings->line_height_unit ) ? 'line-height:' . $settings->line_height_unit . 'em;' : '';
		}
		if ( isset( $settings->letter_spacing ) ) {
			echo ( '' !== $settings->letter_spacing ) ? 'letter-spacing:' . $settings->letter_spacing . 'px;' : '';
		}
		if ( isset( $settings->transform ) ) {
			echo ( '' !== $settings->transform ) ? 'text-transform:' . $settings->transform . ';' : '';
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
	.fl-node-<?php echo $id; ?> .uabb-registration-form input::placeholder,
	.fl-node-<?php echo $id; ?> .uabb-registration-form label {
		<?php if ( 'default' !== $settings->label_font_family['family'] && 'default' !== $settings->label_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->label_font_size_unit ) ) {
			echo ( '' !== $settings->label_font_size_unit ) ? 'font-size:' . $settings->label_font_size_unit . 'px;' : '';
		}
		if ( isset( $settings->label_line_height_unit ) ) {
			echo ( '' !== $settings->label_line_height_unit ) ? 'line-height:' . $settings->label_line_height_unit . 'em;' : '';
		}
		if ( isset( $settings->label_letter_spacing ) ) {
			echo ( '' !== $settings->label_letter_spacing ) ? 'letter-spacing:' . $settings->label_letter_spacing . 'px;' : '';
		}
		if ( isset( $settings->label_transform ) ) {
			echo ( '' !== $settings->label_transform ) ? 'text-transform:' . $settings->label_transform . ';' : '';
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

	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text {
				<?php
				if ( isset( $settings->btn_font_size_unit_medium ) ) {
					echo ( '' !== $settings->btn_font_size_unit_medium ) ? 'font-size:' . $settings->btn_font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_unit_medium ) ) {
					echo ( '' !== $settings->btn_line_height_unit_medium ) ? 'line-height:' . $settings->btn_line_height_unit_medium . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
				<?php
				if ( isset( $settings->font_size_medium ) ) {
					echo ( '' !== $settings->font_size_medium ) ? 'font-size:' . $settings->font_size_medium . 'px;' : '';
				}
				if ( isset( $settings->line_height_medium ) ) {
					echo ( '' !== $settings->line_height_medium ) ? 'line-height:' . $settings->line_height_medium . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form label {
				<?php
				if ( isset( $settings->label_font_size_medium ) ) {
					echo ( '' !== $settings->label_font_size_medium ) ? 'font-size:' . $settings->label_font_size_medium . 'px;' : '';
				}
				if ( isset( $settings->label_line_height_medium ) ) {
					echo ( '' !== $settings->label_line_height_medium ) ? 'line-height:' . $settings->label_line_height_medium . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-registration_form-error-message-required,
			.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
				<?php
				if ( isset( $settings->message_link_font_size_medium ) ) {
					echo ( '' !== $settings->message_link_font_size_medium ) ? 'font-size:' . $settings->message_link_font_size_medium . 'px;' : '';
				}
				if ( isset( $settings->message_link_line_height_medium ) ) {
					echo ( '' !== $settings->message_link_line_height_medium ) ? 'line-height:' . $settings->message_link_line_height_medium . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php
			if ( isset( $settings->success_msg_padding_top_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_top_medium ) ? 'padding-top:' . $settings->success_msg_padding_top_medium . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_right_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_right_medium ) ? 'padding-right:' . $settings->success_msg_padding_right_medium . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_left_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_left_medium ) ? 'padding-left:' . $settings->success_msg_padding_left_medium . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_bottom_medium ) ) {
				echo ( '' !== $settings->success_msg_padding_bottom_medium ) ? 'padding-bottom:' . $settings->success_msg_padding_bottom_medium . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form { 
			<?php
			if ( isset( $settings->form_spacing_dimension_top_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->form_spacing_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->form_spacing_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->form_spacing_dimension_right_medium . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom_medium . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
			<?php
			if ( isset( $settings->input_padding_top_medium ) ) {
				echo ( '' !== $settings->input_padding_top_medium ) ? 'padding-top:' . $settings->input_padding_top_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_left_medium ) ) {
				echo ( '' !== $settings->input_padding_left_medium ) ? 'padding-left:' . $settings->input_padding_left_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_right_medium ) ) {
				echo ( '' !== $settings->input_padding_right_medium ) ? 'padding-right:' . $settings->input_padding_right_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_bottom_medium ) ) {
				echo ( '' !== $settings->input_padding_bottom_medium ) ? 'padding-bottom:' . $settings->input_padding_bottom_medium . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_padding_top_medium ) ) {
				echo ( '' !== $settings->btn_padding_top_medium ) ? 'padding-top:' . $settings->btn_padding_top_medium . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_left_medium ) ) {
				echo ( '' !== $settings->btn_padding_left_medium ) ? 'padding-left:' . $settings->btn_padding_left_medium . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_right_medium ) ) {
				echo ( '' !== $settings->btn_padding_right_medium ) ? 'padding-right:' . $settings->btn_padding_right_medium . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_bottom_medium ) ) {
				echo ( '' !== $settings->btn_padding_bottom_medium ) ? 'padding-bottom:' . $settings->btn_padding_bottom_medium . 'px;' : '';
			}
			?>
		}
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-button-text {
				<?php
				if ( isset( $settings->btn_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->btn_font_size_unit_responsive ) ? 'font-size:' . $settings->btn_font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->btn_line_height_unit_responsive ) ? 'line-height:' . $settings->btn_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
				<?php
				if ( isset( $settings->font_size_unit_responsive ) ) {
					echo ( '' !== $settings->font_size_unit_responsive ) ? 'font-size:' . $settings->font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->line_height_unit_responsive ) ) {
					echo ( '' !== $settings->line_height_unit_responsive ) ? 'line-height:' . $settings->line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form label {
				<?php
				if ( isset( $settings->label_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->label_font_size_unit_responsive ) ? 'font-size:' . $settings->label_font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->label_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->label_line_height_unit_responsive ) ? 'line-height:' . $settings->label_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-registration_form-error-message-required,
			.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
				<?php
				if ( isset( $settings->message_link_font_size_responsive ) ) {
					echo ( '' !== $settings->message_link_font_size_responsive ) ? 'font-size:' . $settings->message_link_font_size_responsive . 'px;' : '';
				}
				if ( isset( $settings->message_link_line_height_responsive ) ) {
					echo ( '' !== $settings->message_link_line_height_responsive ) ? 'line-height:' . $settings->message_link_line_height_responsive . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-rf-success-message-wrap .uabb-rf-success-message {
			<?php
			if ( isset( $settings->success_msg_padding_top_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_top_responsive ) ? 'padding-top:' . $settings->success_msg_padding_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_right_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_right_responsive ) ? 'padding-right:' . $settings->success_msg_padding_right_responsive . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_left_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_left_responsive ) ? 'padding-left:' . $settings->success_msg_padding_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->success_msg_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->success_msg_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->success_msg_padding_bottom_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form { 
			<?php
			if ( isset( $settings->form_spacing_dimension_top_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->form_spacing_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->form_spacing_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->form_spacing_dimension_right_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-input-group input {
			<?php
			if ( isset( $settings->input_padding_top_responsive ) ) {
				echo ( '' !== $settings->input_padding_top_responsive ) ? 'padding-top:' . $settings->input_padding_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_left_responsive ) ) {
				echo ( '' !== $settings->input_padding_left_responsive ) ? 'padding-left:' . $settings->input_padding_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_right_responsive ) ) {
				echo ( '' !== $settings->input_padding_right_responsive ) ? 'padding-right:' . $settings->input_padding_right_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->input_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->input_padding_bottom_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-registration-form .uabb-submit-btn .uabb-registration-form-button .uabb-registration-form-submit {
			<?php
			if ( isset( $settings->btn_padding_top_responsive ) ) {
				echo ( '' !== $settings->btn_padding_top_responsive ) ? 'padding-top:' . $settings->btn_padding_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_left_responsive ) ) {
				echo ( '' !== $settings->btn_padding_left_responsive ) ? 'padding-left:' . $settings->btn_padding_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_right_responsive ) ) {
				echo ( '' !== $settings->btn_padding_right_responsive ) ? 'padding-right:' . $settings->btn_padding_right_responsive . 'px;' : '';
			}
			if ( isset( $settings->btn_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->btn_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->btn_padding_bottom_responsive . 'px;' : '';
			}
			?>
		}
	}
<?php } ?>
