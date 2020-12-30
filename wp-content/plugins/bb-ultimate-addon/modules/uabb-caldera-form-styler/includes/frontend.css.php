<?php
/**
 *  UABB Caldera Forms Styler Module front-end CSS php file
 *
 *   @package UABB Caldera Forms Styler Module
 */

	$settings->form_title_color              = UABB_Helper::uabb_colorpicker( $settings, 'form_title_color', true );
	$settings->form_desc_color               = UABB_Helper::uabb_colorpicker( $settings, 'form_desc_color', true );
	$settings->field_bg_color                = UABB_Helper::uabb_colorpicker( $settings, 'field_bg_color', true );
	$settings->fields_border_active_color    = UABB_Helper::uabb_colorpicker( $settings, 'fields_border_active_color', true );
	$settings->label_color                   = UABB_Helper::uabb_colorpicker( $settings, 'label_color', true );
	$settings->placeholder_color             = UABB_Helper::uabb_colorpicker( $settings, 'placeholder_color', true );
	$settings->field_desc_color              = UABB_Helper::uabb_colorpicker( $settings, 'field_desc_color', true );
	$settings->required_asterisk_color       = UABB_Helper::uabb_colorpicker( $settings, 'required_asterisk_color', true );
	$settings->button_bg_color               = UABB_Helper::uabb_colorpicker( $settings, 'button_bg_color', true );
	$settings->button_bg_hover_color         = UABB_Helper::uabb_colorpicker( $settings, 'button_bg_hover_color', true );
	$settings->btn_text_color                = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color', true );
	$settings->btn_text_hover_color          = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color', true );
	$settings->button_border_hover_color     = UABB_Helper::uabb_colorpicker( $settings, 'button_border_hover_color', true );
	$settings->error_msg_color               = UABB_Helper::uabb_colorpicker( $settings, 'error_msg_color', true );
	$settings->error_msg_bg_color            = UABB_Helper::uabb_colorpicker( $settings, 'error_msg_bg_color', true );
	$settings->error_label_color             = UABB_Helper::uabb_colorpicker( $settings, 'error_label_color', true );
	$settings->error_highlight_border_color  = UABB_Helper::uabb_colorpicker( $settings, 'error_highlight_border_color', true );
	$settings->success_msg_color             = UABB_Helper::uabb_colorpicker( $settings, 'success_msg_color', true );
	$settings->success_bg_color              = UABB_Helper::uabb_colorpicker( $settings, 'success_bg_color', true );
	$settings->form_bg_color                 = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
	$settings->checkbox_radio_bgcolor        = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_radio_bgcolor', true );
	$settings->checkbox_radio_selected_color = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_radio_selected_color', true );
	$settings->checkbox_radio_text_color     = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_radio_text_color', true );
	$settings->star_icon_selected_color      = UABB_Helper::uabb_colorpicker( $settings, 'star_icon_selected_color', true );
	$settings->star_icon_border_color        = UABB_Helper::uabb_colorpicker( $settings, 'star_icon_border_color', true );


	// Button Background Gradient.
if ( ! empty( $settings->button_bg_color ) ) {
	$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->button_bg_color ), 30, 'lighten' );
}

if ( method_exists( 'FLBuilder', 'fa5_pro_enabled' ) ) {
	if ( FLBuilder::fa5_pro_enabled() ) {
		?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-select-custom:after {
	font-family: 'Font Awesome 5 Pro';
}
		<?php
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form {

	<?php
	if ( 'color' === esc_attr( $settings->form_bg_type ) ) {
		if ( isset( $settings->form_bg_color ) ) {

			echo ( ! empty( $settings->form_bg_color ) ) ? 'background:' . esc_attr( $settings->form_bg_color ) . ';' : '';
		}
	} elseif ( 'gradient' === esc_attr( $settings->form_bg_type ) ) {
		if ( isset( $settings->form_bg_gradient ) ) {

			echo ( ! empty( $settings->form_bg_gradient ) ) ? 'background:' . esc_attr( FLBuilderColor::gradient( $settings->form_bg_gradient ) ) . ';' : '';
		}
	}
	?>
}
<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	// Form Padding - Settings.
	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'form_spacing_dimension',
			'selector'     => ".fl-node-$id .uabb-caf-form",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'form_spacing_dimension_top',
				'padding-right'  => 'form_spacing_dimension_right',
				'padding-bottom' => 'form_spacing_dimension_bottom',
				'padding-left'   => 'form_spacing_dimension_left',
			),
		)
	);
	if ( isset( $settings->form_border ) ) {
		// Form Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_border',
				'selector'     => ".fl-node-$id .uabb-caf-form",
			)
		);
	}
	// Field Padding - Settings.
	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'field_padding',
			'selector'     => ".fl-node-$id .uabb-caf-form input.form-control, .fl-node-$id .uabb-caf-form form input[type=text], .fl-node-$id .uabb-caf-form form textarea, .fl-node-$id .uabb-caf-form form input[type=password], .fl-node-$id .uabb-caf-form form input[type=email], .fl-node-$id .uabb-caf-form form input[type=url], .fl-node-$id .uabb-caf-form form input[type=date], .fl-node-$id .uabb-caf-form form input[type=month], .fl-node-$id .uabb-caf-form form input[type=time], .fl-node-$id .uabb-caf-form form input[type=datetime], .fl-node-$id .uabb-caf-form form input[type=datetime-local], .fl-node-$id .uabb-caf-form form input[type=week], .fl-node-$id .uabb-caf-form form input[type=number], .fl-node-$id .uabb-caf-form form input[type=search], .fl-node-$id .uabb-caf-form form input[type=tel], .fl-node-$id .uabb-caf-form form input[type=color], .fl-node-$id .uabb-caf-form form select",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'field_padding_top',
				'padding-right'  => 'field_padding_right',
				'padding-bottom' => 'field_padding_bottom',
				'padding-left'   => 'field_padding_left',
			),
		)
	);
	if ( isset( $settings->form_fields_border ) ) {
		// Field Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_fields_border',
				'selector'     => ".fl-node-$id .uabb-caf-form input.form-control, .fl-node-$id .uabb-caf-form form input[type=text], .fl-node-$id .uabb-caf-form form input[type=file], .fl-node-$id .uabb-caf-form form input[type=password], .fl-node-$id .uabb-caf-form form input[type=email], .fl-node-$id .uabb-caf-form form input[type=url], .fl-node-$id .uabb-caf-form form input[type=date], .fl-node-$id .uabb-caf-form form input[type=month], .fl-node-$id .uabb-caf-form form input[type=time], .fl-node-$id .uabb-caf-form form input[type=datetime], .fl-node-$id .uabb-caf-form form input[type=datetime-local], .fl-node-$id .uabb-caf-form form input[type=week], .fl-node-$id .uabb-caf-form form input[type=number], .fl-node-$id .uabb-caf-form form input[type=search], .fl-node-$id .uabb-caf-form form input[type=tel], .fl-node-$id .uabb-caf-form form input[type=color], .fl-node-$id .uabb-caf-form form select.form-control, .fl-node-$id .uabb-caf-form form textarea.form-control, .fl-node-$id .uabb-caf-form .trumbowyg-box, .fl-node-$id .uabb-caf-form .caldera-grid .ccselect2-container.form-control:hover, .fl-node-$id .uabb-caf-form .caldera-grid .ccselect2-container.form-control, .fl-node-$id .uabb-caf-form .caldera-grid .checkbox input[type=checkbox], .fl-node-$id .uabb-caf-form .caldera-grid .checkbox-inline input[type=checkbox], .fl-node-$id .uabb-caf-form .caldera-grid .radio input[type=radio] + span:before,.fl-node-$id .uabb-caf-form .caldera-grid .radio-inline input[type=radio] + span:before, .fl-node-$id .uabb-caf-form .live-gravatar span:nth-of-type(1)",
			)
		);
	}
	if ( isset( $settings->caf_title_desc_align ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'caf_title_desc_align',
				'selector'     => ".fl-node-$id .uabb-caf-form .uabb-caf-form-title,.fl-node-$id .uabb-caf-form .uabb-caf-form-desc",
				'prop'         => 'text-align',
			)
		);
	}
	if ( isset( $settings->form_title_bottom_margin ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_title_bottom_margin',
				'selector'     => ".fl-node-$id .uabb-caf-form .uabb-caf-form-title",
				'prop'         => 'margin-bottom',
				'unit'         => 'px',
			)
		);
	}
	if ( isset( $settings->form_desc_bottom_margin ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_desc_bottom_margin',
				'selector'     => ".fl-node-$id .uabb-caf-form .uabb-caf-form-desc",
				'prop'         => 'margin-bottom',
				'unit'         => 'px',
			)
		);
	}
	// Button Padding - Settings.
	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_padding',
			'selector'     => ".fl-node-$id .uabb-caf-form .caldera-grid input[type=submit], .fl-node-$id .uabb-caf-form .caldera-grid input[type=button], .fl-node-$id .uabb-caf-form .caldera-grid .cf-uploader-trigger, .fl-node-$id .uabb-caf-form .caldera-grid a.btn-default",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'button_padding_top',
				'padding-right'  => 'button_padding_right',
				'padding-bottom' => 'button_padding_bottom',
				'padding-left'   => 'button_padding_left',
			),
		)
	);

	if ( isset( $settings->button_border ) ) {
		// Button Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-node-$id .uabb-caf-form .caldera-grid input[type='submit'], .fl-node-$id .uabb-caf-form .caldera-grid .btn-default, .fl-node-$id .uabb-caf-form .caldera-grid .cf-uploader-trigger, .fl-node-$id .uabb-caf-form .caldera-grid .btn-success",
			)
		);
	}
}
?>

<?php
if ( isset( $settings->caf_title_desc_align ) ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
			<?php echo ( 'left' === $settings->caf_title_desc_align ) ? 'margin-left: 12px;' : ''; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
			<?php echo ( 'right' === $settings->caf_title_desc_align ) ? 'margin-right: 12px;' : ''; ?>
		}
	<?php
}

if ( isset( $settings->field_bg_color ) ) {
	?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .form-control, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="text"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="password"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="email"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="url"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="date"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="month"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="time"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime-local"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="week"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="number"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="search"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="tel"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="color"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form select, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form textarea, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .trumbowyg-box, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .trumbowyg-editor, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .form-control .ccselect2-choice, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form input[type=checkbox], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form input[type=radio] + span:before, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input[type=file] { 

	<?php
	echo ( ! empty( $settings->field_bg_color ) ) ? 'background:' . esc_attr( $settings->field_bg_color ) . ';' : '';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid hr {
	<?php
	echo ( ! empty( $settings->field_bg_color ) ) ? 'border-color:' . esc_attr( $settings->field_bg_color ) . ';' : '';
	?>
}
<?php } ?>

<?php
if ( isset( $settings->fields_border_active_color ) && '' !== $settings->fields_border_active_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="text"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="file"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="color_picker"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="credit_card_cvc"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="password"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="email"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="url"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="date"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="month"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="time"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime-local"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="week"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="number"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="search"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="tel"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="color"]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form select:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form textarea.form-control:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .trumbowyg-box:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .ccselect2-container.form-control:hover:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .ccselect2-container.form-control:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .checkbox input[type=checkbox]:checked,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .checkbox-inline input[type=checkbox]:checked,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .radio input[type=radio]:checked + span:before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .radio-inline input[type=radio]:checked + span:before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="phone"]:focus {

		border-color: <?php echo esc_attr( $settings->fields_border_active_color ); ?>;
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label { 
	<?php

	if ( isset( $settings->label_color ) ) {

		echo ( ! empty( $settings->label_color ) ) ? 'color:' . esc_attr( $settings->label_color ) . ';' : '';
		if ( $settings->display_labels ) {
			?>
		display: <?php echo esc_attr( $settings->display_labels ); ?>;
			<?php
		}
	}
	?>
}

<?php if ( isset( $settings->form_fields_align ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label {
	<?php
		echo ( ! empty( $settings->form_fields_align ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align ) . ';' : '';
		echo 'width: 100%;';
	?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form span,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .file-prevent-overflow,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .live-gravatar,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input:not([type=submit]), .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form textarea {
	<?php
		echo ( ! empty( $settings->form_fields_align ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align ) . ';' : '';
	?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form select {
	<?php
		echo ( ! empty( $settings->form_fields_align ) ) ? 'text-align-last:' . esc_attr( $settings->form_fields_align ) . ';' : '';
	?>
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .form-group { 
	<?php

	if ( isset( $settings->form_fields_spacing ) ) {

		echo ( ! empty( $settings->form_fields_spacing ) ) ? 'margin-bottom:' . esc_attr( $settings->form_fields_spacing ) . 'px;' : '';

	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label.control-label { 
	<?php

	if ( isset( $settings->label_bottom_spacing ) ) {

		echo ( ! empty( $settings->label_bottom_spacing ) ) ? 'margin-bottom:' . esc_attr( $settings->label_bottom_spacing ) . 'px;' : '';

	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .help-block { 
	<?php

	if ( isset( $settings->desc_top_spacing ) ) {

		echo ( ! empty( $settings->desc_top_spacing ) ) ? 'margin-top:' . esc_attr( $settings->desc_top_spacing ) . 'px;' : '';

	}
	?>
}

<?php

if ( isset( $settings->placeholder_color ) ) {
	?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input.form-control, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="text"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="password"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="email"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="url"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="date"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="month"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="time"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="file"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="datetime-local"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="week"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="number"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="search"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="tel"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input[type="color"], 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form select, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form textarea, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form input[type=checkbox]:checked:after, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .ccselect2-chosen, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .trumbowyg-editor, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form input::placeholder, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form textarea::placeholder { 
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'color:' . esc_attr( $settings->placeholder_color ) . ';' : '';
	echo 'opacity: 1;';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-select-custom:after,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-radio-custom:after {
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'color:' . esc_attr( $settings->placeholder_color ) . ';' : '';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .rangeslider__fill {
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'background:' . esc_attr( $settings->placeholder_color ) . '!important;' : '';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-cancel,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-heart-off, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-heart-on, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-face-off, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-face-on, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-dot-off, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .raty-dot-on {
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'color:' . esc_attr( $settings->placeholder_color ) . '!important;' : '';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success.active, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success:active, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success:focus, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success:hover, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .open .dropdown-toggle.btn-success, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success {
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'background-color:' . esc_attr( $settings->placeholder_color ) . ';' : '';
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid input[type="radio"]:checked + span:before {
	<?php

	echo ( ! empty( $settings->placeholder_color ) ) ? 'background-color:' . esc_attr( $settings->placeholder_color ) . ';' : '';
	echo 'box-shadow:inset 0px 0px 0px 4px ' . esc_attr( $settings->field_bg_color ) . ';';
	?>
}

<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .help-block, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .help-block {
	<?php
	if ( isset( $settings->field_desc_color ) ) {
		echo ( ! empty( $settings->field_desc_color ) ) ? 'color:' . esc_attr( $settings->field_desc_color ) . ';' : '';
	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .field_required,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-forms-consent-field span { 
	<?php

	if ( isset( $settings->required_asterisk_color ) ) {

		echo ( ! empty( $settings->required_asterisk_color ) ) ? 'color:' . esc_attr( $settings->required_asterisk_color ) . '!important ;' : '';

	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid input[type="submit"], .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .btn-default, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .cf-uploader-trigger { 
	<?php
	if ( 'color' === esc_attr( $settings->button_bg_type ) ) {
		if ( isset( $settings->button_bg_color ) ) {

			echo ( ! empty( $settings->button_bg_color ) ) ? 'background:' . esc_attr( $settings->button_bg_color ) . ';' : '';

		}
	} elseif ( 'gradient' === esc_attr( $settings->button_bg_type ) ) {

		if ( ! empty( $settings->button_bg_color ) ) {
			?>
		background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $settings->button_bg_color ); ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $settings->button_bg_color ); ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->button_bg_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->button_bg_color ); ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->button_bg_color ); ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $settings->button_bg_color ); ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $settings->button_bg_color ); ?>',GradientType=0 ); /* IE6-9 */
			<?php
		}
		if ( isset( $settings->button_bg_gradient ) ) {

			echo ( ! empty( $settings->button_bg_gradient ) ) ? 'background:' . esc_attr( FLBuilderColor::gradient( $settings->button_bg_gradient ) ) . ';' : '';
		}
	}

	if ( isset( $settings->btn_text_color ) ) {

		echo ( ! empty( $settings->btn_text_color ) ) ? 'color:' . esc_attr( $settings->btn_text_color ) . ';' : '';

	}
	?>
}

<?php if ( isset( $settings->button_border_hover_color ) && '' !== $settings->button_border_hover_color ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid input[type="submit"]:hover, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .btn-default:hover, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .cf-uploader-trigger:hover, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .cf-toggle-switch .btn-success, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .cf-toggle-switch .btn-success:hover {
		border-color: <?php echo esc_attr( $settings->button_border_hover_color ); ?>;
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input[type="submit"]:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .btn-default:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-uploader-trigger:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .cf-toggle-switch .btn-success:hover {
	<?php
	if ( isset( $settings->btn_text_hover_color ) ) {
		echo ( ! empty( $settings->btn_text_hover_color ) ) ? 'color:' . esc_attr( $settings->btn_text_hover_color ) . ';' : '';
	}
	if ( isset( $settings->button_bg_hover_color ) ) {
		echo ( ! empty( $settings->button_bg_hover_color ) ) ? 'background:' . esc_attr( $settings->button_bg_hover_color ) . ';' : '';
	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .caldera_ajax_error_block, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .caldera_ajax_error_block {
	<?php

	if ( isset( $settings->error_msg_color ) ) {

		echo ( ! empty( $settings->error_msg_color ) ) ? 'color:' . esc_attr( $settings->error_msg_color ) . ';' : '';

	}
	?>
}

<?php if ( 'bottom_right' === $settings->error_msg_position ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .caldera_ajax_error_block span {
	<?php
	if ( isset( $settings->error_msg_bg_color ) ) {
		echo ( ! empty( $settings->error_msg_bg_color ) ) ? 'background-color:' . esc_attr( $settings->error_msg_bg_color ) . ';' : '';
	}
	?>
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error label {
	<?php

	if ( isset( $settings->error_label_color ) ) {

		echo ( ! empty( $settings->error_label_color ) ) ? 'color:' . esc_attr( $settings->error_label_color ) . ';' : '';

	}
	?>
}

<?php

if ( isset( $settings->error_highlight_border_color ) ) {
	?>

.fl-node-<?php echo esc_attr( $id ); ?> .has-error input.form-control,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="text"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="password"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="email"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="url"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="date"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="month"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="time"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="datetime"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="datetime-local"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="week"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="number"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="search"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="tel"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error input[type="color"],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form form .has-error textarea.form-control,
.fl-node-<?php echo esc_attr( $id ); ?> .has-error .trumbowyg-box,
.fl-node-<?php echo esc_attr( $id ); ?> .has-error .caldera-grid .ccselect2-container.form-control.parsley-error:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .caldera-grid .ccselect2-container.form-control.parsley-error,
.fl-node-<?php echo esc_attr( $id ); ?> .caldera-grid .has-error.cf-toggle-switch .cf-toggle-group-buttons>a,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .checkbox input[type=checkbox],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .checkbox-inline input[type=checkbox],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .radio input[type=radio] + span:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error .radio-inline input[type=radio] + span:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .has-error input[type="file"] {
	<?php

	echo ( ! empty( $settings->error_highlight_border_color ) ) ? 'border-color:' . esc_attr( $settings->error_highlight_border_color ) . ';' : '';
	?>
}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .alert-success {
	<?php

	if ( isset( $settings->success_msg_color ) ) {

		echo ( ! empty( $settings->success_msg_color ) ) ? 'color:' . esc_attr( $settings->success_msg_color ) . ';' : '';

	}
	if ( isset( $settings->success_bg_color ) ) {

		echo ( ! empty( $settings->success_bg_color ) ) ? 'background:' . esc_attr( $settings->success_bg_color ) . ';' : '';

	}
	?>
}

<?php
if ( isset( $settings->checkbox_radio_size ) ) {
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .checkbox input[type=checkbox],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .checkbox-inline input[type=checkbox],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .radio input[type=radio] + span:before, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .radio-inline input[type=radio] + span:before {
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_size ) ) ? 'height:' . esc_attr( $settings->checkbox_radio_size ) . 'px;' : '';
	echo ( '' !== esc_attr( $settings->checkbox_radio_size ) ) ? 'width:' . esc_attr( $settings->checkbox_radio_size ) . 'px;' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form input[type=checkbox]:checked:after {
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_size ) ) ? 'font-size: calc( ' . esc_attr( $settings->checkbox_radio_size ) . 'px / 1.2 );' : '';
	?>
}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .radio input[type=radio] + span:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .radio-inline input[type=radio] + span:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .checkbox input[type=checkbox],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .checkbox-inline input[type=checkbox] {	
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_bgcolor ) ) ? 'background-color:' . esc_attr( $settings->checkbox_radio_bgcolor ) . ';' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form .checkbox input[type=checkbox]:after,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .checkbox-inline input[type=checkbox]:after {	
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_selected_color ) ) ? 'color:' . esc_attr( $settings->checkbox_radio_selected_color ) . ';' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form .radio input[type=radio]:checked + span:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form .radio-inline input[type=radio]:checked + span:before {
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_selected_color ) ) ? 'background-color:' . esc_attr( $settings->checkbox_radio_selected_color ) . ';' : '';
	echo 'box-shadow:inset 0px 0px 0px 4px ' . esc_attr( $settings->checkbox_radio_bgcolor ) . ';';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .checkbox label,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom .radio label,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom label.checkbox-inline, 
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-radio-custom label.radio-inline {
	<?php
	echo ( '' !== esc_attr( $settings->checkbox_radio_text_color ) ) ? 'color:' . esc_attr( $settings->checkbox_radio_text_color ) . ';' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form .raty-star-on,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form .raty-star-off {
	<?php
	echo ( '' !== esc_attr( $settings->star_rating_size ) ) ? 'font-size:' . esc_attr( $settings->star_rating_size ) . 'px;' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid form .raty-star-off {
	<?php
	echo ( '' !== esc_attr( $settings->star_icon_border_color ) ) ? 'color:' . esc_attr( $settings->star_icon_border_color ) . ';' : '';
	?>
}

<?php if ( isset( $settings->star_icon_selected_color ) ) { ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-input-size-xs .caldera-grid form .raty-star-on,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-input-size-sm .caldera-grid form .raty-star-on,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-input-size-md .caldera-grid form .raty-star-on,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-input-size-lg .caldera-grid form .raty-star-on,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form.uabb-caf-input-size-xl .caldera-grid form .raty-star-on {
	color: <?php echo esc_attr( $settings->star_icon_selected_color ); ?> !important;
}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
	<?php
	echo ( '' !== esc_attr( $settings->form_title_color ) ) ? 'color:' . esc_attr( $settings->form_title_color ) . ';' : '';
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc {
	<?php
	echo ( '' !== esc_attr( $settings->form_desc_color ) ) ? 'color:' . esc_attr( $settings->form_desc_color ) . ';' : '';
	?>
}

<?php

if ( class_exists( 'FLBuilderCSS' ) ) {

	if ( isset( $settings->checkbox_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'checkbox_border',
				'selector'     => ".fl-node-$id .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form .checkbox input[type=checkbox] ,.fl-node-$id .uabb-caf-form.uabb-caf-radio-custom .caldera-grid form .checkbox-inline input[type=checkbox] ",
			)
		);
	}

	if ( isset( $settings->radio_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'radio_border',
				'selector'     => ".fl-node-$id .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .radio input[type=radio] + span:before ,.fl-node-$id .uabb-caf-form.uabb-caf-radio-custom .caldera-grid .radio-inline input[type=radio] + span:before",
			)
		);
	}

	if ( isset( $settings->form_title_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_title_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form .uabb-caf-form-title",
			)
		);
	}

	if ( isset( $settings->form_desc_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_desc_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form .uabb-caf-form-desc",
			)
		);
	}

	if ( isset( $settings->form_desc_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_desc_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form uabb-caf-form-desc",
			)
		);
	}

	if ( isset( $settings->field_label_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'field_label_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form label",
			)
		);
	}

	if ( isset( $settings->input_placeholder_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_placeholder_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form input:not([type=submit]):not([type='checkbox']):not([type='radio']) ,.fl-node-$id .uabb-caf-form textarea,.fl-node-$id .uabb-caf-form select",
			)
		);
	}

	if ( isset( $settings->button_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form .form-group input[type='submit'], .fl-node-$id .uabb-caf-form .form-group input[type='button'], .fl-node-$id .uabb-caf-form .btn-default, .fl-node-$id .uabb-caf-form .btn-success, .fl-node-$id .uabb-caf-form .cf-uploader-trigger",
			)
		);
	}

	if ( isset( $settings->error_msg_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'error_msg_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form .has-error .caldera_ajax_error_block span",
			)
		);
	}

	if ( isset( $settings->success_msg_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'success_msg_typo',
				'selector'     => ".fl-node-$id .uabb-caf-form .caldera-grid .alert-success",
			)
		);
	}
}
?>

<?php if ( $global_settings->responsive_enabled ) { ?>

	/* CSS for medium Device */

	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

	<?php if ( isset( $settings->form_fields_align_medium ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label {
		<?php
			echo ( ! empty( $settings->form_fields_align_medium ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align_medium ) . ';' : '';
			echo 'width: 100%;';
		?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form span,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .file-prevent-overflow,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .live-gravatar,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input:not([type=submit]), .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form textarea {
		<?php
			echo ( ! empty( $settings->form_fields_align_medium ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align_medium ) . ';' : '';
		?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form select {
		<?php
			echo ( ! empty( $settings->form_fields_align_medium ) ) ? 'text-align-last:' . esc_attr( $settings->form_fields_align_medium ) . ';' : '';
		?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .form-group { 
		<?php

		if ( isset( $settings->form_fields_spacing_medium ) ) {

			echo ( ! empty( $settings->form_fields_spacing_medium ) ) ? 'margin-bottom:' . esc_attr( $settings->form_fields_spacing_medium ) . 'px;' : '';
		}
		?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label.control-label { 
		<?php

		if ( isset( $settings->label_bottom_spacing_medium ) ) {

			echo ( ! empty( $settings->label_bottom_spacing_medium ) ) ? 'margin-bottom:' . esc_attr( $settings->label_bottom_spacing_medium ) . 'px;' : '';

		}
		?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .help-block { 
		<?php

		if ( isset( $settings->desc_top_spacing_medium ) ) {

			echo ( ! empty( $settings->desc_top_spacing_medium ) ) ? 'margin-top:' . esc_attr( $settings->desc_top_spacing_medium ) . 'px;' : '';

		}
		?>
		}
		<?php if ( isset( $settings->caf_title_desc_align_medium ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
			<?php echo ( 'left' === $settings->caf_title_desc_align_medium ) ? 'margin-left: 12px;' : ''; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
			<?php echo ( 'right' === $settings->caf_title_desc_align_medium ) ? 'margin-right: 12px;' : ''; ?>
		}
			<?php
		}
	}
	?>
	}

	/* CSS for mobile Device */

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

		<?php if ( isset( $settings->form_fields_align_responsive ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label {
			<?php
			echo ( ! empty( $settings->form_fields_align_responsive ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align_responsive ) . ';' : '';
			echo 'width: 100%;';
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form span,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .file-prevent-overflow,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .caldera-grid .live-gravatar,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form input:not([type=submit]), .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form textarea {
			<?php
			echo ( ! empty( $settings->form_fields_align_responsive ) ) ? 'text-align:' . esc_attr( $settings->form_fields_align_responsive ) . ';' : '';
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form select {
			<?php
			echo ( ! empty( $settings->form_fields_align_responsive ) ) ? 'text-align-last:' . esc_attr( $settings->form_fields_align_responsive ) . ';' : '';
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .form-group { 
			<?php

			if ( isset( $settings->form_fields_spacing_responsive ) ) {

				echo ( ! empty( $settings->form_fields_spacing_responsive ) ) ? 'margin-bottom:' . esc_attr( $settings->form_fields_spacing_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form label.control-label { 
			<?php

			if ( isset( $settings->label_bottom_spacing_responsive ) ) {

				echo ( ! empty( $settings->label_bottom_spacing_responsive ) ) ? 'margin-bottom:' . esc_attr( $settings->label_bottom_spacing_responsive ) . 'px;' : '';

			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .help-block { 
			<?php

			if ( isset( $settings->desc_top_spacing_responsive ) ) {

				echo ( ! empty( $settings->desc_top_spacing_responsive ) ) ? 'margin-top:' . esc_attr( $settings->desc_top_spacing_responsive ) . 'px;' : '';

			}
			?>
		}
			<?php if ( isset( $settings->caf_title_desc_align_responsive ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
				<?php echo ( 'left' === $settings->caf_title_desc_align_responsive ) ? 'margin-left: 12px;' : ''; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-desc, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-caf-form .uabb-caf-form-title {
				<?php echo ( 'right' === $settings->caf_title_desc_align_responsive ) ? 'margin-right: 12px;' : ''; ?>
		}
				<?php
			}
		}
		?>
	}
<?php } ?>
