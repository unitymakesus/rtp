<?php
/**
 *  UABB WP Forms Styler Module front-end CSS php file
 *
 * @package UABB WP Forms Styler Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;

$settings->form_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );

$settings->input_background_color        = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
$settings->input_background_active_color = UABB_Helper::uabb_colorpicker( $settings, 'input_background_active_color', true );
$settings->input_border_active_color     = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color', true );
$settings->field_description_color       = UABB_Helper::uabb_colorpicker( $settings, 'field_description_color', true );
$settings->required_asterisk_color       = UABB_Helper::uabb_colorpicker( $settings, 'required_asterisk_color', true );

$settings->btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color', true );
$settings->btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color', true );
$settings->btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
$settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );

/* Typography Colors */

$settings->form_title_color = UABB_Helper::uabb_colorpicker( $settings, 'form_title_color', true );
$settings->form_desc_color  = UABB_Helper::uabb_colorpicker( $settings, 'form_desc_color', true );

$settings->label_color     = UABB_Helper::uabb_colorpicker( $settings, 'label_color', true );
$settings->sub_label_color = UABB_Helper::uabb_colorpicker( $settings, 'sub_label_color', true );

/* Input Color */
$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color', true );

$settings->input_msg_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_msg_color', true );
$settings->validation_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_msg_color', true );
$settings->validation_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'validation_bg_color', true );

$settings->radio_check_size          = ( isset( $settings->radio_check_size ) && '' !== $settings->radio_check_size ) ? $settings->radio_check_size : '';
$settings->radio_check_border_width  = ( isset( $settings->radio_check_border_width ) && '' !== $settings->radio_check_border_width ) ? $settings->radio_check_border_width : '';
$settings->radio_check_custom_option = ( isset( $settings->radio_check_custom_option ) && '' !== $settings->radio_check_custom_option ) ? $settings->radio_check_custom_option : '';
$settings->checkbox_border_radius    = ( isset( $settings->checkbox_border_radius ) && '' !== $settings->checkbox_border_radius ) ? $settings->checkbox_border_radius : '';
$settings->input_msg_font_size       = ( isset( $settings->input_msg_font_size ) && '' !== $settings->input_msg_font_size ) ? $settings->input_msg_font_size : '';
$settings->validation_msg_font_size  = ( isset( $settings->validation_msg_font_size ) && '' !== $settings->validation_msg_font_size ) ? $settings->validation_msg_font_size : '';

if ( ! $version_bb_check ) {
	$settings->input_border_radius     = ( isset( $settings->input_border_radius ) && '' !== $settings->input_border_radius ) ? $settings->input_border_radius : '';
	$settings->validation_border_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_border_color' );
	$settings->input_border_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color', true );
}

?>

<?php if ( $settings->display_labels ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label {
		display: <?php echo esc_attr( $settings->display_labels ); ?>;
	}
<?php } ?>

<?php if ( $settings->display_sub_labels ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-sublabel {
		display: <?php echo esc_attr( $settings->display_sub_labels ); ?>;
	}
<?php } ?>

/* Form Style */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler  {

	<?php if ( 'color' === $settings->form_bg_type ) { ?>
		background-color: <?php echo esc_attr( $settings->form_bg_color ); ?>;
	<?php } elseif ( 'image' === $settings->form_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->form_bg_img )->url ) ) { ?>
		background-image: url(<?php echo esc_attr( FLBuilderPhoto::get_attachment_data( $settings->form_bg_img )->url ); ?>);
		background-position: <?php echo esc_attr( $settings->form_bg_img_pos ); ?>;
		background-size: <?php echo esc_attr( $settings->form_bg_img_size ); ?>;
		background-repeat: <?php echo esc_attr( $settings->form_bg_img_repeat ); ?>;
		<?php
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->form_bg_type ) {
			?>
		background:<?php echo esc_attr( FLBuilderColor::gradient( $settings->form_gradient ) ); ?>;
			<?php
		}
	}

	?>

	<?php
	if ( isset( $settings->form_spacing_dimension_top ) ) {
		echo ( '' !== $settings->form_spacing_dimension_top ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top ) . 'px;' : 'padding-top: 20px;';
	}
	if ( isset( $settings->form_spacing_dimension_bottom ) ) {
		echo ( '' !== $settings->form_spacing_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom ) . 'px;' : 'padding-bottom: 20px;';
	}
	if ( isset( $settings->form_spacing_dimension_left ) ) {
		echo ( '' !== $settings->form_spacing_dimension_left ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left ) . 'px;' : 'padding-left: 20px;';
	}
	if ( isset( $settings->form_spacing_dimension_right ) ) {
		echo ( '' !== $settings->form_spacing_dimension_right ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right ) . 'px;' : 'padding-right: 20px;';
	}
	?>
}


<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler {
			<?php
			if ( isset( $settings->form_radius ) ) {
				echo ( '' !== $settings->form_radius ) ? 'border-radius:' . esc_attr( $settings->form_radius ) . 'px;' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_border',
				'selector'     => ".fl-node-$id .uabb-wpf-styler",
			)
		);
	}
}
?>


/* Input Fields CSS */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea {

	<?php
	if ( isset( $settings->input_padding_dimension_top ) ) {
		echo ( '' !== $settings->input_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->input_padding_dimension_top ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_dimension_bottom ) ) {
		echo ( '' !== $settings->input_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_dimension_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_dimension_left ) ) {
		echo ( '' !== $settings->input_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->input_padding_dimension_left ) . 'px;' : '';
	}
	if ( isset( $settings->input_padding_dimension_right ) ) {
		echo ( '' !== $settings->input_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->input_padding_dimension_right ) . 'px;' : '';
	}

	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea {
	<?php
	if ( isset( $settings->textarea_height ) ) {
		echo ( '' !== $settings->textarea_height ) ? 'height:' . esc_attr( $settings->textarea_height ) . 'px;' : '';

	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus {
	-webkit-appearance: menulist !important;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]::placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea::placeholder{
	color: <?php echo esc_attr( $settings->color ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:focus {

	color: <?php echo esc_attr( $settings->color ); ?>;
	<?php
	$bgcolor = '';
	if ( 'color' === $settings->input_background_type ) {
		$bgcolor = ( '' !== $settings->input_background_color ) ? $settings->input_background_color : '';
	} else {
		$bgcolor = 'transparent';
	}
	?>
	background: <?php echo esc_attr( $bgcolor ); ?>;
}
.fl-node-<?php echo esc_attr( $id ); ?> .wpforms-single-item-price{
	color: <?php echo esc_attr( $settings->color ); ?>;

}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler select,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=tel],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=email],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=text],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=url],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=number],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=date],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler input[type=password],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler textarea,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler select:focus {

		<?php
		if ( isset( $settings->input_border_radius ) ) {
			echo ( '' !== $settings->input_border_radius ) ? 'border-radius:' . esc_attr( $settings->input_border_radius ) . 'px;' : '';
		}
		if ( isset( $settings->input_border_color ) ) {
			echo ( '' !== $settings->input_border_color ) ? 'border-color:' . esc_attr( $settings->input_border_color ) : '';
		}
		?>
		border-style: solid;
		<?php
		if ( isset( $settings->input_border_width_dimension_top ) ) {
			echo ( '' !== $settings->input_border_width_dimension_top ) ? 'border-top-width:' . esc_attr( $settings->input_border_width_dimension_top ) . 'px;' : '';
		}
		if ( isset( $settings->input_border_width_dimension_bottom ) ) {
			echo ( '' !== $settings->input_border_width_dimension_bottom ) ? 'border-bottom-width:' . esc_attr( $settings->input_border_width_dimension_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->input_border_width_dimension_left ) ) {
			echo ( '' !== $settings->input_border_width_dimension_left ) ? 'border-left-width:' . esc_attr( $settings->input_border_width_dimension_left ) . 'px;' : '';
		}
		if ( isset( $settings->input_border_width_dimension_right ) ) {
			echo ( '' !== $settings->input_border_width_dimension_right ) ? 'border-right-width:' . esc_attr( $settings->input_border_width_dimension_right ) . 'px;' : '';
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
					'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form select, .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=tel], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=email], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=text], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=url], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=number], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=date], .fl-node-$id .uabb-wpf-styler .wpforms-form textarea",
				)
			);
	}
}

if ( isset( $settings->input_border_active_color ) && '' !== $settings->input_border_active_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:focus {

		border-color: <?php echo esc_attr( $settings->input_border_active_color ); ?>;
	}
<?php } ?>
<?php
if ( isset( $settings->input_background_active_color ) && '' !== $settings->input_background_active_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:active,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:focus {
		background: <?php echo esc_attr( $settings->input_background_active_color ); ?>;
	}
<?php } ?>


/* Placeholder Colors */

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form ::-webkit-input-placeholder,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form :-moz-placeholder,        /* Firefox 18- */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form ::-moz-placeholder,       /* Firefox 18- */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form :-ms-input-placeholder{
	color: <?php echo esc_attr( $settings->color ); ?>;
}



<?php
if ( 'true' === $settings->radio_check_custom_option ) {
	$font_size = $settings->radio_check_size / 1.2;
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] {
			position: absolute;
		visibility: hidden;
}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label:before {

		background: #<?php echo esc_attr( $settings->radio_check_bgcolor ); ?>;
		border: <?php echo esc_attr( $settings->radio_check_border_width ); ?>px solid #<?php echo esc_attr( $settings->radio_check_border_color ); ?>;
		width: <?php echo esc_attr( $settings->radio_check_size ); ?>px;
		height: <?php echo esc_attr( $settings->radio_check_size ); ?>px;

	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"]:checked + label:before {
		content: "\2714";
		font-size: calc(<?php echo esc_attr( $font_size ); ?>px - <?php echo esc_attr( $settings->radio_check_border_width ); ?>px );
		color: #<?php echo esc_attr( $settings->radio_check_selected_color ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label:before {
		border-radius: <?php echo esc_attr( $settings->checkbox_border_radius ); ?>px;
	}


	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"]:checked + label:before {
		background: #<?php echo esc_attr( $settings->radio_check_selected_color ); ?>;
		box-shadow: inset 0 0 0 4px #<?php echo esc_attr( $settings->radio_check_bgcolor ); ?>;
	}

	<?php
}
?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="checkbox"] + label,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field input[type="radio"] + label {
	<?php
	if ( 'true' === $settings->radio_check_custom_option ) {
		if ( '' !== $settings->radio_checkbox_color ) :
			?>
			color: #<?php echo esc_attr( $settings->radio_checkbox_color ); ?>;
			<?php
		endif;
	}
	?>
}
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-field-radio.wpforms-list-inline ul li:not(:last-child),
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-field-checkbox.wpforms-list-inline ul li:not(:last-child),
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-field-payment-multiple.wpforms-list-inline li:not(:last-child) {

		<?php echo ( '' !== $settings->check_radio_items_spacing ) ? 'margin-right: ' . esc_attr( $settings->check_radio_items_spacing ) . 'px !important;' : ''; ?>
		margin-bottom: 0 !important;

}
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-radio li:not(:last-child),
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox ul li:not(:last-child),
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-payment-multiple li:not(:last-child){
	<?php echo ( '' !== $settings->check_radio_items_spacing ) ? 'margin-bottom: ' . esc_attr( $settings->check_radio_items_spacing ) . 'px !important;' : ''; ?>

}

<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox input[type='checkbox'] + label,
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-radio input[type='radio'] + label
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-payment-multiple li label {
	{
		<?php
		if ( 'true' === $settings->radio_check_custom_option ) {
			if ( 'Default' !== $settings->radio_checkbox_font_family['family'] ) :
				?>
				<?php
				FLBuilderFonts::font_css( $settings->radio_checkbox_font_family );
			endif;
			?>

			<?php if ( isset( $settings->radio_checkbox_font_size_unit ) && '' !== $settings->radio_checkbox_font_size_unit ) : ?>
				font-size: <?php echo esc_attr( $settings->radio_checkbox_font_size_unit ); ?>px;
			<?php endif; ?>

			<?php if ( 'none' !== $settings->radio_checkbox_transform ) : ?>
				text-transform: <?php echo esc_attr( $settings->radio_checkbox_transform ); ?>;
			<?php endif; ?>esc_attr( 

			<?php if ( '' !== $settings->radio_checkbox_letter_spacing ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->radio_checkbox_letter_spacing ); ?>px;
			<?php endif; ?>
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_radio_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox input[type='checkbox'] + label, .fl-node-$id .uabb-wpf-styler .wpforms-form .wpforms-field-radio input[type='radio'] + label, .fl-node-$id .uabb-wpf-styler.wpforms-form .wpforms-field-payment-multiple li label",
			)
		);
	}
}
?>
<?php if ( ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) && 'default' !== $settings->btn_style ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
		<?php
		if ( isset( $settings->btn_padding_top ) ) {
			echo ( '' !== $settings->btn_padding_top ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top ) . 'px;' : '';
		}
		if ( isset( $settings->btn_padding_bottom ) ) {
			echo ( '' !== $settings->btn_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->btn_padding_left ) ) {
			echo ( '' !== $settings->btn_padding_left ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left ) . 'px;' : '';
		}
		if ( isset( $settings->btn_padding_right ) ) {
			echo ( '' !== $settings->btn_padding_right ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right ) . 'px;' : '';
		}
		?>
	}
<?php } ?>
<?php
/* Button CSS */
$settings->btn_border_width           = ( isset( $settings->btn_border_width ) && '' !== $settings->btn_border_width ) ? $settings->btn_border_width : '';
$settings->btn_background_color       = ( isset( $settings->btn_background_color ) && '' !== $settings->btn_background_color ) ? $settings->btn_background_color : '';
$settings->btn_background_hover_color = ( isset( $settings->btn_background_hover_color ) && '' !== $settings->btn_background_hover_color ) ? $settings->btn_background_hover_color : '';
$settings->btn_border_radius          = ( isset( $settings->btn_border_radius ) && '' !== $settings->btn_border_radius ) ? $settings->btn_border_radius : '';
$settings->btn_text_color             = ( isset( $settings->btn_text_color ) && '' !== $settings->btn_text_color ) ? $settings->btn_text_color : '';

$settings->btn_background_color       = uabb_theme_button_bg_color( $settings->btn_background_color );
$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );
$settings->btn_text_color             = uabb_theme_button_text_color( $settings->btn_text_color );
$settings->btn_text_hover_color       = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );


$border_color       = '';
$border_hover_color = '';
// Border Size & Border Color.
if ( 'transparent' === $settings->btn_style ) {
	$border_color       = esc_attr( $settings->btn_background_color );
	$border_hover_color = esc_attr( $settings->btn_background_hover_color );
}

?>
<?php if ( 'default' === $settings->btn_style ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
			<?php
			if ( isset( $settings->button_border_style ) ) {
				echo ( '' !== $settings->button_border_style && 'none' !== $settings->button_border_style ) ? 'border-style:' . esc_attr( $settings->button_border_style ) . ';' : 'border-style:solid;';
			}
			if ( isset( $settings->button_border_width ) && ! empty( $settings->button_border_width ) ) {
				echo ( '' !== $settings->button_border_width ) ? 'border-width:' . esc_attr( $settings->button_border_width ) . 'px;' : '';
			} else {

				$border_width = uabb_theme_button_border_width( '' );

				echo ( is_array( $border_width ) && array_key_exists( 'top', $border_width ) ) ? 'border-top-width:' . esc_attr( $border_width['top'] ) . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'left', $border_width ) ) ? 'border-left-width:' . esc_attr( $border_width['left'] ) . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'right', $border_width ) ) ? 'border-right-width:' . esc_attr( $border_width['right'] ) . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'bottom', $border_width ) ) ? 'border-bottom-width:' . esc_attr( $border_width['bottom'] ) . 'px;' : '';
			}
			if ( isset( $settings->button_border_radius ) ) {
				echo ( '' !== $settings->button_border_radius ) ? 'border-radius:' . esc_attr( $settings->button_border_radius ) . 'px;' : 'border-radius:' . esc_attr( uabb_theme_button_border_radius( '' ) ) . 'px;';
			}
			if ( isset( $settings->button_border_color ) ) {
				echo ( '' !== $settings->button_border_color ) ? 'border-color:#' . esc_attr( $settings->button_border_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_color( '' ) ) . ';';
			}
			?>
		}
		<?php
	} else {

		$settings->button_border = uabb_theme_border( $settings->button_border );

		if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'button_border',
					'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form button[type=submit]:hover,.fl-node-$id .uabb-wpf-styler .wpforms-form .wpforms-page-button:hover,.fl-node-$id .uabb-wpf-styler .wpforms-form button[type=submit],.fl-node-$id .uabb-wpf-styler .wpforms-form .wpforms-page-button",
				)
			);
		}
	}
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-form button[type=submit]:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-form .wpforms-page-button:hover {
		<?php echo ( '' !== $settings->border_hover_color ) ? 'border-color:#' . esc_attr( $settings->border_hover_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_hover_color( '' ) ) . ';'; ?>
		<?php echo ( '' !== $settings->btn_text_hover_color ) ? 'color:' . esc_attr( $settings->btn_text_hover_color ) . ';' : ''; ?>
		background:<?php echo esc_attr( uabb_theme_default_button_bg_hover_color( $settings->btn_background_hover_color ) ); ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button { 

		background:<?php echo esc_attr( uabb_theme_default_button_bg_color( $settings->btn_background_color ) ); ?>
	}
	<?php if ( ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) && 'default' === $settings->btn_style ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
			<?php
			if ( isset( $settings->btn_padding_top ) ) {
				echo ( '' !== $settings->btn_padding_top ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'desktop', 'top' ) ) . ';';
			}
			if ( isset( $settings->btn_padding_bottom ) ) {
				echo ( '' !== $settings->btn_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'desktop', 'bottom' ) ) . ';';
			}
			if ( isset( $settings->btn_padding_left ) ) {
				echo ( '' !== $settings->btn_padding_left ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'desktop', 'left' ) ) . ';';
			}
			if ( isset( $settings->btn_padding_right ) ) {
				echo ( '' !== $settings->btn_padding_right ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'desktop', 'right' ) ) . ';';
			}
			?>
		}
	<?php } ?>
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button{
	<?php if ( 'center' === $settings->btn_align ) { ?>
			margin-left: auto;
			margin-right: auto;
	<?php } elseif ( 'right' === $settings->btn_align ) { ?>
			margin-left: auto;
			margin-right: 0;
	<?php } ?>

	<?php if ( '' !== $settings->btn_border_radius ) { ?>
		border-radius: <?php echo esc_attr( $settings->btn_border_radius ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->btn_margin_top ) && '' !== $settings->btn_margin_top ) { ?>
		margin-top: <?php echo esc_attr( $settings->btn_margin_top ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->btn_margin_bottom ) && '' !== $settings->btn_margin_bottom ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->btn_margin_bottom ); ?>px;
	<?php } ?>

	<?php if ( 'flat' === $settings->btn_style ) { ?>
		background: <?php echo esc_attr( $settings->btn_background_color ); ?>;
		border: none;
	<?php } elseif ( 'transparent' === $settings->btn_style ) { ?>
		background-color: Transparent;
		border-style: solid;
		border-color: <?php echo esc_attr( $border_color ); ?>;
		border-width: <?php echo esc_attr( $settings->btn_border_width ); ?>px;
		<?php
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->btn_style ) {
			?>
		background:<?php echo esc_attr( FLBuilderColor::gradient( $settings->btn_gradient ) ); ?>;
		border: none;
			<?php
		}
	}
	?>

	color: <?php echo esc_attr( $settings->btn_text_color ); ?>;

	<?php if ( 'full' === $settings->btn_width ) { ?>
		width:100%;
		<?php
	} elseif ( 'custom' === $settings->btn_width ) {

		$padding_top_bottom = ( '' !== $settings->btn_padding_top_bottom ) ? $settings->btn_padding_top_bottom : uabb_theme_button_vertical_padding( '' );
		?>

		padding-top: <?php echo esc_attr( $padding_top_bottom ); ?>px;
		padding-bottom: <?php echo esc_attr( $padding_top_bottom ); ?>px;
		<?php if ( '' !== $settings->btn_custom_width ) { ?>
			width: <?php echo esc_attr( $settings->btn_custom_width ); ?>px;
		<?php } ?>

		<?php if ( '' !== $settings->btn_custom_height ) { ?>
			min-height: <?php echo esc_attr( $settings->btn_custom_height ); ?>px;
		<?php } ?>

		<?php } ?>
	}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit]:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button:hover {
	<?php if ( 'flat' === $settings->btn_style ) { ?>
		<?php if ( '' !== $settings->btn_text_hover_color ) { ?>
		color: <?php echo esc_attr( $settings->btn_text_hover_color ); ?>;
		<?php } ?>

		<?php if ( '' !== $settings->btn_background_hover_color ) { ?>
		background: <?php echo esc_attr( $settings->btn_background_hover_color ); ?>;
		border: none;
		<?php } ?>
	<?php } elseif ( 'transparent' === $settings->btn_style ) { ?>
		<?php if ( '' !== $settings->btn_text_hover_color ) { ?>
		color: <?php echo esc_attr( $settings->btn_text_hover_color ); ?>;
			<?php
		}
		?>
	background-color: Transparent;
		border-style: solid;
		background-clip: padding-box;
		border-color:<?php echo esc_attr( $border_hover_color ); ?>;
		border-width: <?php echo esc_attr( $settings->btn_border_width ); ?>px;
		<?php
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->btn_style ) {
			?>
		border: none;
			<?php
		}
	}
	?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=file],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea,
.fl-node-<?php echo esc_attr( $id ); ?> .wpforms-single-item-price {
	<?php echo ( '' !== $settings->input_top_margin ) ? 'margin-top: ' . esc_attr( $settings->input_top_margin ) . 'px;' : ''; ?>
	<?php echo ( '' !== $settings->input_bottom_margin ) ? 'margin-bottom: ' . esc_attr( $settings->input_bottom_margin ) . 'px;' : ''; ?>
}

<?php if ( 'no' !== $settings->wp_custom_desc ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-title,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-title {
			color: <?php echo esc_attr( $settings->form_title_color ); ?>;
			text-align: <?php echo esc_attr( $settings->title_desc_align ); ?>;

	margin: 0 0 <?php echo ( '' !== $settings->form_title_bottom_margin ) ? esc_attr( $settings->form_title_bottom_margin ) : ''; ?>px;

}
<?php } ?>
/* Typography CSS */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-title,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-title {
		<?php if ( 'no' !== $settings->wp_custom_desc ) { ?>
			<?php if ( 'Default' !== $settings->form_title_font_family['family'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->form_title_font_family ); ?>
		<?php endif; ?>

			<?php
			if ( isset( $settings->form_title_font_size_unit ) && '' !== $settings->form_title_font_size_unit ) {
				?>
			font-size: <?php echo esc_attr( $settings->form_title_font_size_unit ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->form_title_line_height_unit ) && '' !== $settings->form_title_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->form_title_line_height_unit ); ?>em;
		<?php } ?>

			<?php if ( 'none' !== $settings->form_title_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->form_title_transform ); ?>;
		<?php endif; ?>

			<?php if ( '' !== $settings->form_title_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->form_title_letter_spacing ); ?>px;
		<?php endif; ?>
	<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_title_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .uabb-wpf-form-title, .wpforms-form .wpforms-title",
			)
		);
	}
}
?>
<?php if ( 'no' !== $settings->wp_custom_desc ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-desc,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-description {
		color: <?php echo esc_attr( $settings->form_desc_color ); ?>;
		text-align: <?php echo esc_attr( $settings->title_desc_align ); ?>;

	margin: 0 0 <?php echo ( '' !== $settings->form_desc_bottom_margin ) ? esc_attr( $settings->form_desc_bottom_margin ) : ''; ?>px;

}
<?php } ?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-desc,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-description {
		<?php if ( 'no' !== $settings->wp_custom_desc ) { ?>
			<?php if ( 'Default' !== $settings->form_desc_font_family['family'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->form_desc_font_family ); ?>
		<?php endif; ?>

			<?php
			if ( isset( $settings->form_desc_font_size_unit ) && '' !== $settings->form_desc_font_size_unit ) {
				?>
			font-size: <?php echo esc_attr( $settings->form_desc_font_size_unit ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->form_desc_line_height_unit ) && '' !== $settings->form_desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->form_desc_line_height_unit ); ?>em;
		<?php } ?>

			<?php if ( 'none' !== $settings->form_desc_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->form_desc_transform ); ?>;
		<?php endif; ?>

			<?php if ( '' !== $settings->form_desc_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->form_desc_letter_spacing ); ?>px;
		<?php endif; ?>
	<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_desc_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .uabb-wpf-form-desc, .wpforms-form .wpforms-description",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea,
	.fl-node-<?php echo esc_attr( $id ); ?> .wpforms-single-item-price {

		<?php if ( 'Default' !== $settings->font_family['family'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;
		<?php } ?>

		<?php if ( 'none' !== $settings->transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_input_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form input[type=tel], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=email], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=text], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=url], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=number], .fl-node-$id .uabb-wpf-styler .wpforms-form input[type=date], .fl-node-$id .uabb-wpf-styler .wpforms-form select, .fl-node-$id .uabb-wpf-styler .wpforms-form textarea, .fl-node-$id .wpforms-single-item-price",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
		<?php
		if ( 'Default' !== $settings->btn_font_family['family'] ) {
				FLBuilderFonts::font_css( $settings->btn_font_family );
		}
		?>

		<?php if ( '' !== uabb_theme_button_letter_spacing( '' ) ) { ?>
		letter-spacing: <?php echo esc_attr( uabb_theme_button_letter_spacing( '' ) ); ?>;
		<?php } ?>

		<?php if ( 'none' !== $settings->btn_text_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->btn_text_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->btn_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->btn_letter_spacing ); ?>;
		<?php endif; ?>

		<?php if ( '' !== uabb_theme_button_text_transform( '' ) ) { ?>
			text-transform: <?php echo esc_attr( uabb_theme_button_text_transform( '' ) ); ?>;
		<?php } ?>

		<?php if ( 'Default' !== $settings->btn_font_family['family'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->btn_font_family ); ?>
		<?php else : ?>
			<?php if ( isset( $uabb_theme_btn_family['family'] ) ) { ?>
			font-family: <?php echo esc_attr( $uabb_theme_btn_family['family'] ); ?>;
			<?php } ?>

			<?php if ( isset( $uabb_theme_btn_family['weight'] ) ) { ?>
			font-weight: <?php echo esc_attr( $uabb_theme_btn_family['weight'] ); ?>;
			<?php } ?>
		<?php endif; ?>

		<?php
		if ( isset( $settings->btn_font_size_unit ) && '' !== $settings->btn_font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->btn_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->btn_font_size_unit ) && '' === $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' !== $settings->btn_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->btn_font_size_unit ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->btn_line_height_unit ) && '' !== $settings->btn_line_height_unit ) { ?>
		line-height: <?php echo esc_attr( $settings->btn_line_height_unit ); ?>em;
		<?php } else { ?>
				<?php if ( '' !== uabb_theme_button_line_height( '' ) ) { ?>
					line-height: <?php echo esc_attr( uabb_theme_button_line_height( '' ) ); ?>;
				<?php } ?>
		<?php } ?>

	}
	<?php
} else {
	if ( 'default' === $settings->btn_style ) {

		$form_button_typo = uabb_theme_button_typography( $settings->form_button_typo );

		$settings->form_button_typo            = ( array_key_exists( 'desktop', $form_button_typo ) ) ? $form_button_typo['desktop'] : $settings->form_button_typo;
		$settings->form_button_typo_medium     = ( array_key_exists( 'tablet', $form_button_typo ) ) ? $form_button_typo['tablet'] : $settings->form_button_typo_medium;
		$settings->form_button_typo_responsive = ( array_key_exists( 'mobile', $form_button_typo ) ) ? $form_button_typo['mobile'] : $settings->form_button_typo_responsive;
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_button_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form button[type=submit], .uabb-wpf-styler .wpforms-form .wpforms-page-button  ",
			)
		);
	}
}
?>
<?php if ( 'block' === $settings->display_labels ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler span.wpforms-page-indicator-page-title {

	<?php
	if ( isset( $settings->label_color ) ) {
		echo ( '' !== $settings->label_color ) ? 'color:' . esc_attr( $settings->label_color ) : '';
	}
	?>
}
<?php } ?>


<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler span.wpforms-page-indicator-page-title {
		<?php if ( 'block' === $settings->display_labels ) { ?>
			<?php if ( 'Default' !== $settings->label_font_family['family'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
		<?php endif; ?>

			<?php if ( isset( $settings->label_font_size_unit ) && '' !== $settings->label_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->label_font_size_unit ); ?>px;
		<?php } ?>

			<?php if ( isset( $settings->label_line_height_unit ) && '' !== $settings->label_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->label_line_height_unit ); ?>em;
		<?php } ?>

			<?php if ( 'none' !== $settings->label_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->label_transform ); ?>;
		<?php endif; ?>

			<?php if ( '' !== $settings->label_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->label_letter_spacing ); ?>px;
		<?php endif; ?>
	<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_label_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-container .wpforms-field-container .wpforms-field-label, .uabb-wpf-styler span.wpforms-page-indicator-page-title",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-sublabel {
	<?php if ( 'block' === $settings->display_sub_labels ) { ?>
		<?php
		if ( isset( $settings->sub_label_color ) ) {
			echo ( '' !== $settings->sub_label_color ) ? 'color:' . esc_attr( $settings->sub_label_color ) : '';
		}
		?>
<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-sublabel {
		<?php if ( 'block' === $settings->display_sub_labels ) { ?>
			<?php if ( 'Default' !== $settings->sub_label_font_family['family'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->sub_label_font_family ); ?>
		<?php endif; ?>

			<?php if ( isset( $settings->sub_label_font_size_unit ) && '' !== $settings->sub_label_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->sub_label_font_size_unit ); ?>px;
		<?php } ?>

			<?php if ( isset( $settings->sub_label_line_height_unit ) && '' !== $settings->sub_label_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->sub_label_line_height_unit ); ?>em;
		<?php } ?>

			<?php if ( 'none' !== $settings->sub_label_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->sub_label_transform ); ?>;
		<?php endif; ?>

			<?php if ( '' !== $settings->sub_label_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->sub_label_letter_spacing ); ?>px;
		<?php endif; ?>
	<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_sub_label_typo',
				'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-form .wpforms-field-sublabel ",
			)
		);
	}
}
?>

/* Field Description Color */

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-description,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-html {
	<?php
	if ( isset( $settings->field_description_color ) ) {
		echo ( '' !== $settings->field_description_color ) ? 'color:' . esc_attr( $settings->field_description_color ) : '';
	}
	?>

}
/* Required Asterisk Color */

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-required-label {

	<?php
	if ( isset( $settings->required_asterisk_color ) ) {
		echo ( '' !== $settings->required_asterisk_color ) ? 'color:' . esc_attr( $settings->required_asterisk_color ) : '';
	}
	?>

}

/* Error Styling */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container .wpforms-form label.wpforms-error,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-container-full .wpforms-form label.wpforms-error
{
	color: <?php echo esc_attr( $settings->input_msg_color ); ?>;
	font-size: <?php echo esc_attr( $settings->input_msg_font_size ); ?>px;

	<?php if ( 'none' !== $settings->input_msg_transform ) : ?>
		text-transform: <?php echo esc_attr( $settings->input_msg_transform ); ?>;
	<?php endif; ?>
	<?php
	if ( isset( $settings->input_msg_letter_spacing ) ) {
		echo ( '' !== $settings->input_msg_letter_spacing ) ? 'font-size:' . esc_attr( $settings->input_msg_letter_spacing ) . 'px;' : '';
	}
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-confirmation-container-full {

		<?php if ( isset( $settings->validation_border_type ) && '' !== $settings->validation_border_type ) { ?>
			<?php $settings->validation_border_width = '' !== $settings->validation_border_width ? $settings->validation_border_width : ''; ?>
				border: <?php echo esc_attr( $settings->validation_border_type ) . ' ' . esc_attr( $settings->validation_border_width ) . 'px ' . esc_attr( $settings->validation_border_color ) . ';'; ?>
		<?php } else { ?>
			border: none;
		<?php } ?>

		<?php
		if ( isset( $settings->validation_border_radius ) ) {
			echo ( '' !== $settings->validation_border_radius ) ? 'border-radius:' . esc_attr( $settings->validation_border_radius ) . 'px;' : '';
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
					'setting_name' => 'validation_border',
					'selector'     => ".fl-node-$id .uabb-wpf-styler .wpforms-confirmation-container-full,.fl-node-$id .uabb-wpf-styler .wpforms-confirmation-container",
				)
			);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-confirmation-container,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-confirmation-container-full {
	color: <?php echo esc_attr( $settings->validation_msg_color ); ?>;
		font-size: <?php echo esc_attr( $settings->validation_msg_font_size ); ?>px;

	<?php if ( 'none' !== $settings->validate_transform ) : ?>
		text-transform: <?php echo esc_attr( $settings->validate_transform ); ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->validate_letter_spacing ) : ?>
		letter-spacing: <?php echo esc_attr( $settings->validate_letter_spacing ); ?>px;
	<?php endif; ?>
		background: <?php echo esc_attr( $settings->validation_bg_color ); ?>;

	<?php
	if ( isset( $settings->validation_spacing_dimension_top ) ) {
		echo ( '' !== $settings->validation_spacing_dimension_top ) ? 'padding-top:' . esc_attr( $settings->validation_spacing_dimension_top ) . 'px;' : '';
	}
	if ( isset( $settings->validation_spacing_dimension_bottom ) ) {
		echo ( '' !== $settings->validation_spacing_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->validation_spacing_dimension_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->validation_spacing_dimension_left ) ) {
		echo ( '' !== $settings->validation_spacing_dimension_left ) ? 'padding-left:' . esc_attr( $settings->validation_spacing_dimension_left ) . 'px;' : '';
	}
	if ( isset( $settings->validation_spacing_dimension_right ) ) {
		echo ( '' !== $settings->validation_spacing_dimension_right ) ? 'padding-right:' . esc_attr( $settings->validation_spacing_dimension_right ) . 'px;' : '';
	}
	?>
}

/* Typography responsive css */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>

	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-title,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-title{

				<?php if ( isset( $settings->form_title_font_size_unit_medium ) && '' !== $settings->form_title_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->form_title_font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_title_line_height_unit_medium ) && '' !== $settings->form_title_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->form_title_line_height_unit_medium ); ?>em;
				<?php } ?>

			}

			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox input[type='checkbox'] + label,
			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-radio input[type='radio'] + label {
				<?php if ( 'true' === $settings->radio_check_custom_option ) { ?>
					<?php if ( isset( $settings->radio_checkbox_font_size_unit_medium ) && '' !== $settings->radio_checkbox_font_size_unit_medium ) : ?>
						font-size: <?php echo esc_attr( $settings->radio_checkbox_font_size_unit_medium ); ?>px;
					<?php endif; ?>
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-desc,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-description {

				<?php if ( isset( $settings->form_desc_font_size_unit_medium ) && '' !== $settings->form_desc_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->form_desc_font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_desc_line_height_unit_medium ) && '' !== $settings->form_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->form_desc_line_height_unit_medium ); ?>em;
				<?php } ?>

			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form textarea {

				<?php if ( isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button  {

				<?php if ( isset( $settings->btn_font_size_unit_medium ) && '' !== $settings->btn_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->btn_font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_line_height_unit_medium ) && '' !== $settings->btn_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->btn_line_height_unit_medium ); ?>em;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form form:not(input) {

				<?php if ( isset( $settings->label_font_size_unit_medium ) && '' !== $settings->label_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->label_font_size_unit_medium ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->label_line_height_unit_medium ) && '' !== $settings->label_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->label_line_height_unit_medium ); ?>em;
				<?php } ?>
			}
		<?php } ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-confirmation-container-full {
			<?php
			if ( isset( $settings->validation_spacing_dimension_top_medium ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->validation_spacing_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->validation_spacing_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_left_medium ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->validation_spacing_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_right_medium ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->validation_spacing_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}
		<?php if ( ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) && 'default' !== $settings->btn_style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
				<?php
				if ( isset( $settings->btn_padding_top_medium ) ) {
					echo ( '' !== $settings->btn_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->btn_padding_bottom_medium ) ) {
					echo ( '' !== $settings->btn_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->btn_padding_left_medium ) ) {
					echo ( '' !== $settings->btn_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_medium ) . 'px;' : '';
				}
				if ( isset( $settings->btn_padding_right_medium ) ) {
					echo ( '' !== $settings->btn_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_medium ) . 'px;' : '';
				}
				?>
			} 
		<?php } ?>
		<?php if ( ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) && 'default' === $settings->btn_style ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
				<?php
				if ( isset( $settings->btn_padding_top_medium ) ) {
					echo ( '' !== $settings->btn_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_medium ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'tablet', 'top' ) ) . ';';
				}
				if ( isset( $settings->btn_padding_bottom_medium ) ) {
					echo ( '' !== $settings->btn_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_medium ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'tablet', 'bottom' ) ) . ';';
				}
				if ( isset( $settings->btn_padding_left_medium ) ) {
					echo ( '' !== $settings->btn_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_medium ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'tablet', 'left' ) ) . ';';
				}
				if ( isset( $settings->btn_padding_right_medium ) ) {
					echo ( '' !== $settings->btn_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_medium ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'tablet', 'right' ) ) . ';';
				}
				?>
			}
		<?php } ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler {
			<?php
			if ( isset( $settings->form_spacing_dimension_top_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_medium ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea {
			<?php

			if ( isset( $settings->input_padding_dimension_top_medium ) ) {
				echo ( '' !== $settings->input_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->input_padding_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->input_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_left_medium ) ) {
				echo ( '' !== $settings->input_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->input_padding_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_right_medium ) ) {
				echo ( '' !== $settings->input_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->input_padding_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:focus {
				<?php
				if ( isset( $settings->input_border_width_dimension_top_medium ) ) {
					echo ( '' !== $settings->input_border_width_dimension_top_medium ) ? 'border-top-width:' . esc_attr( $settings->input_border_width_dimension_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_bottom_medium ) ) {
					echo ( '' !== $settings->input_border_width_dimension_bottom_medium ) ? 'border-bottom-width:' . esc_attr( $settings->input_border_width_dimension_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_left_medium ) ) {
					echo ( '' !== $settings->input_border_width_dimension_left_medium ) ? 'border-left-width:' . esc_attr( $settings->input_border_width_dimension_left_medium ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_right_medium ) ) {
					echo ( '' !== $settings->input_border_width_dimension_right_medium ) ? 'border-right-width:' . esc_attr( $settings->input_border_width_dimension_right_medium ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>

	}

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-title,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-title{

				<?php if ( isset( $settings->form_title_font_size_unit_responsive ) && '' !== $settings->form_title_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->form_title_font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_title_line_height_unit_responsive ) && '' !== $settings->form_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->form_title_line_height_unit_responsive ); ?>em;
				<?php } ?>

			}

			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-checkbox input[type='checkbox'] + label,
			.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-field-radio input[type='radio'] + label {
				<?php if ( 'true' === $settings->radio_check_custom_option ) { ?>

					<?php if ( isset( $settings->radio_checkbox_font_size_unit_responsive ) && '' !== $settings->radio_checkbox_font_size_unit_responsive ) : ?>
						font-size: <?php echo esc_attr( $settings->radio_checkbox_font_size_unit_responsive ); ?>px;
					<?php endif; ?>

				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .uabb-wpf-form-desc,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-description{

				<?php if ( isset( $settings->form_desc_font_size_unit_responsive ) && '' !== $settings->form_desc_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->form_desc_font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_desc_line_height_unit_responsive ) && '' !== $settings->form_desc_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->form_desc_line_height_unit_responsive ); ?>em;
				<?php } ?>

			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-contact-form textarea {

				<?php if ( isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button{

				<?php if ( isset( $settings->btn_font_size_unit_responsive ) && '' !== $settings->btn_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->btn_font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_line_height_unit_responsive ) && '' !== $settings->btn_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->btn_line_height_unit_responsive ); ?>em;
				<?php } ?>

			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form form:not(input) {

				<?php if ( isset( $settings->label_font_size_unit_responsive ) && '' !== $settings->label_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->label_font_size_unit_responsive ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->label_line_height_unit_responsive ) && '' !== $settings->label_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->label_line_height_unit_responsive ); ?>em;
				<?php } ?>
			}
		<?php } ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-confirmation-container-full {
			<?php
			if ( isset( $settings->validation_spacing_dimension_top_responsive ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->validation_spacing_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->validation_spacing_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_left_responsive ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->validation_spacing_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_right_responsive ) ) {
				echo ( '' !== $settings->validation_spacing_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->validation_spacing_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler {
			<?php
			if ( isset( $settings->form_spacing_dimension_top_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_responsive ) ) {
				echo ( '' !== $settings->form_spacing_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}
			<?php if ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
					<?php
					if ( isset( $settings->btn_padding_top_responsive ) ) {
						echo ( '' !== $settings->btn_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_responsive ) . 'px;' : '';
					}
					if ( isset( $settings->btn_padding_bottom_responsive ) ) {
						echo ( '' !== $settings->btn_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_responsive ) . 'px;' : '';
					}
					if ( isset( $settings->btn_padding_left_responsive ) ) {
						echo ( '' !== $settings->btn_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_responsive ) . 'px;' : '';
					}
					if ( isset( $settings->btn_padding_right_responsive ) ) {
						echo ( '' !== $settings->btn_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_responsive ) . 'px;' : '';
					}
					?>
				}
			<?php } ?>
			<?php if ( ( 'full' === $settings->btn_width || 'auto' === $settings->btn_width ) && 'default' === $settings->btn_style ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form button[type=submit],
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form .wpforms-page-button {
					<?php
					if ( isset( $settings->btn_padding_top_responsive ) ) {
						echo ( '' !== $settings->btn_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->btn_padding_top_responsive ) . 'px;' : 'padding-top:' . esc_attr( uabb_theme_padding_button( 'mobile', 'top' ) ) . ';';
					}
					if ( isset( $settings->btn_padding_bottom_responsive ) ) {
						echo ( '' !== $settings->btn_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->btn_padding_bottom_responsive ) . 'px;' : 'padding-bottom:' . esc_attr( uabb_theme_padding_button( 'mobile', 'bottom' ) ) . ';';
					}
					if ( isset( $settings->btn_padding_left_responsive ) ) {
						echo ( '' !== $settings->btn_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->btn_padding_left_responsive ) . 'px;' : 'padding-left:' . esc_attr( uabb_theme_padding_button( 'mobile', 'left' ) ) . ';';
					}
					if ( isset( $settings->btn_padding_right_responsive ) ) {
						echo ( '' !== $settings->btn_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->btn_padding_right_responsive ) . 'px;' : 'padding-right:' . esc_attr( uabb_theme_padding_button( 'mobile', 'right' ) ) . ';';
					}
					?>
				}
			<?php } ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea  {
			<?php
			if ( isset( $settings->input_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->input_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->input_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->input_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->input_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->input_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->input_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->input_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password],
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form select:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=tel]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=email]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=text]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=url]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=number]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=date]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form input[type=password]:focus,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-wpf-styler .wpforms-form textarea:focus {
				<?php
				if ( isset( $settings->input_border_width_dimension_top_responsive ) ) {
					echo ( '' !== $settings->input_border_width_dimension_top_responsive ) ? 'border-top-width:' . esc_attr( $settings->input_border_width_dimension_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_bottom_responsive ) ) {
					echo ( '' !== $settings->input_border_width_dimension_bottom_responsive ) ? 'border-bottom-width:' . esc_attr( $settings->input_border_width_dimension_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_left_responsive ) ) {
					echo ( '' !== $settings->input_border_width_dimension_left_responsive ) ? 'border-left-width:' . esc_attr( $settings->input_border_width_dimension_left_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_right_responsive ) ) {
					echo ( '' !== $settings->input_border_width_dimension_right_responsive ) ? 'border-right-width:' . esc_attr( $settings->input_border_width_dimension_right_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
	}
<?php } ?>
