<?php
/**
 *  UABB Contact Form Module front-end CSS php file
 *
 *  @package UABB Contact Form Module
 */

?>
<?php

	$version_bb_check = UABB_Compatibility::check_bb_version();
	$converted        = UABB_Compatibility::check_old_page_migration();

	$settings->input_text_color           = UABB_Helper::uabb_colorpicker( $settings, 'input_text_color' );
	$settings->input_background_color     = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
	$settings->input_border_active_color  = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color' );
	$settings->btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
	$settings->btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
	$settings->btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
	$settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );

	$settings->label_color          = UABB_Helper::uabb_colorpicker( $settings, 'label_color' );
	$settings->form_bg_color        = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
	$settings->invalid_msg_color    = UABB_Helper::uabb_colorpicker( $settings, 'invalid_msg_color' );
	$settings->success_msg_color    = UABB_Helper::uabb_colorpicker( $settings, 'success_msg_color' );
	$settings->error_msg_color      = UABB_Helper::uabb_colorpicker( $settings, 'error_msg_color' );
	$settings->invalid_border_color = UABB_Helper::uabb_colorpicker( $settings, 'invalid_border_color' );
	$settings->checkbox_color       = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_color' );
	$settings->terms_color          = UABB_Helper::uabb_colorpicker( $settings, 'terms_color' );
?>
.fl-node-<?php echo $id; ?> {
	width: 100%;
}

/* Form Style */
.fl-node-<?php echo $id; ?> .uabb-contact-form {
	<?php if ( 'color' == $settings->form_bg_type ) { ?>
		background-color: <?php echo $settings->form_bg_color; ?>;
	<?php } elseif ( 'image' == $settings->form_bg_type ) { ?>
		background-image: url(<?php echo FLBuilderPhoto::get_attachment_data( $settings->form_bg_img )->url; ?>);
		background-position: <?php echo $settings->form_bg_img_pos; ?>;
		background-size: <?php echo $settings->form_bg_img_size; ?>;
		background-repeat: <?php echo $settings->form_bg_img_repeat; ?>;
	<?php } elseif ( 'gradient' == $settings->form_bg_type ) { ?>
		<?php UABB_Helper::uabb_gradient_css( $settings->form_bg_gradient ); ?>
	<?php } ?>
	<?php
	if ( 'yes' === $converted || '' != $settings->form_spacing_dimension_top && isset( $settings->form_spacing_dimension_top ) && isset( $settings->form_spacing_dimension_bottom ) && '' != $settings->form_spacing_dimension_bottom && isset( $settings->form_spacing_dimension_left ) && '' != $settings->form_spacing_dimension_left && isset( $settings->form_spacing_dimension_right ) && '' != $settings->form_spacing_dimension_right ) {
		if ( isset( $settings->form_spacing_dimension_top ) ) {
			echo ( '' != $settings->form_spacing_dimension_top ) ? 'padding-top:' . $settings->form_spacing_dimension_top . 'px;' : '';
		}
		if ( isset( $settings->form_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->form_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom . 'px;' : '';
		}
		if ( isset( $settings->form_spacing_dimension_left ) ) {
			echo ( '' != $settings->form_spacing_dimension_left ) ? 'padding-left:' . $settings->form_spacing_dimension_left . 'px;' : '';
		}
		if ( isset( $settings->form_spacing_dimension_right ) ) {
			echo ( '' != $settings->form_spacing_dimension_right ) ? 'padding-right:' . $settings->form_spacing_dimension_right . 'px;' : '';
		}
	} elseif ( isset( $settings->form_spacing ) && '' != $settings->form_spacing && isset( $settings->form_spacing_dimension_top ) && '' == $settings->form_spacing_dimension_top && isset( $settings->form_spacing_dimension_bottom ) && '' == $settings->form_spacing_dimension_bottom && isset( $settings->form_spacing_dimension_left ) && '' == $settings->form_spacing_dimension_left && isset( $settings->form_spacing_dimension_right ) && '' == $settings->form_spacing_dimension_right ) {
		echo $settings->form_spacing;
		?>
		;
	<?php } ?>

	<?php if ( '' != $settings->form_radius ) { ?>
		border-radius:<?php echo ( '' != $settings->form_radius ) ? $settings->form_radius : '0'; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message-required {
	background: <?php echo $settings->invalid_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message span {
	color: <?php echo $settings->invalid_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-success,
.fl-node-<?php echo $id; ?> .uabb-success-none,
.fl-node-<?php echo $id; ?> .uabb-success-msg {
	color: <?php echo $settings->success_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-send-error,
.fl-node-<?php echo $id; ?> .uabb-contact-error {
	color: <?php echo $settings->error_msg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-success-none,
.fl-node-<?php echo $id; ?> .uabb-success-msg,
.fl-node-<?php echo $id; ?> .uabb-send-error,
.fl-node-<?php echo $id; ?> .uabb-contact-error {
	text-align: <?php echo $settings->error_msg_alignment; ?>;
}


.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error textarea,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=text],
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-error input[type=email] {
	border-color: <?php echo $settings->invalid_border_color; ?>;
}

/* Input Fields CSS */
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap input,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap textarea {
	<?php if ( '' != $settings->input_vertical_padding ) { ?>
	padding-top: <?php echo $settings->input_vertical_padding; ?>px;
	padding-bottom: <?php echo $settings->input_vertical_padding; ?>px;
	<?php } ?>
	<?php if ( '' != $settings->input_horizontal_padding ) { ?>
	padding-left: <?php echo $settings->input_horizontal_padding; ?>px;
	padding-right: <?php echo $settings->input_horizontal_padding; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-form-error-message::before {
	<?php if ( '' != $settings->input_horizontal_padding ) { ?>
	right: <?php echo $settings->input_horizontal_padding; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:focus,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-checkbox span:before {

	text-align: <?php echo $settings->input_text_align; ?>;
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
	<?php if ( '' != $settings->input_background_color ) { ?>
		background: <?php echo $settings->input_background_color; ?>;
	<?php } ?>
}

<?php
if ( ! $version_bb_check ) {

	$settings->input_border_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color' );

	$settings->input_border_width = ( '' != $settings->input_border_width ) ? $settings->input_border_width : '1';
	?>

	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-checkbox span:before {

		border-radius: 0;
		border-color: <?php echo uabb_theme_text_color( $settings->input_border_color ); ?>;
		border-width: <?php echo $settings->input_border_width; ?>px;
	}

	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Input Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_border',
				'selector'     => ".fl-node-$id .uabb-contact-form .uabb-input-group-wrap input, .fl-node-$id .uabb-contact-form .uabb-input-group-wrap textarea, .fl-node-$id .uabb-contact-form .uabb-terms-checkbox span:before",
			)
		);
	}
}
?>

<?php if ( '' != $settings->input_border_active_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:active,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input:focus,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea:active,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap textarea:focus,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-checkbox span:focus:before,
	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-checkbox span:active:before {
		border-color: <?php echo $settings->input_border_active_color; ?>;
	}
<?php } ?>

/* Placeholder Colors */

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input::-webkit-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea::-webkit-input-placeholder {
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input:-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea:-moz-placeholder { 		/* Firefox 18- */
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input::-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea::-moz-placeholder {  	/* Firefox 19+ */
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error input:-ms-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group .uabb-error textarea:-ms-input-placeholder {
	color: <?php echo $settings->invalid_msg_color; ?> !important;
}


.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input::-webkit-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea::-webkit-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input:-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea:-moz-placeholder { 		/* Firefox 18- */
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
	opacity: 1;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input::-moz-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea::-moz-placeholder {  	/* Firefox 19+ */
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
	opacity: 1;
}

.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group input:-ms-input-placeholder,
.fl-node-<?php echo $id; ?> .uabb-input-group-wrap .uabb-input-group textarea:-ms-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->input_text_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-form-outter {
	<?php echo ( '' != $settings->input_top_margin ) ? 'margin-top: ' . $settings->input_top_margin . 'px;' : ''; ?>
	<?php echo ( '' != $settings->input_bottom_margin ) ? 'margin-bottom: ' . $settings->input_bottom_margin . 'px;' : 'margin-bottom: 10px;'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-form-outter-textarea {
	<?php echo ( '' != $settings->textarea_top_margin ) ? 'margin-top: ' . $settings->textarea_top_margin . 'px;' : ''; ?>
	<?php echo ( '' != $settings->textarea_bottom_margin ) ? 'margin-bottom: ' . $settings->textarea_bottom_margin . 'px;' : 'margin-bottom: 10px;'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-submit-btn {
	<?php echo ( '' != $settings->btn_top_margin ) ? 'margin-top: ' . $settings->btn_top_margin . 'px;' : 'margin-top: 0;'; ?>

	<?php echo ( '' != $settings->btn_bottom_margin ) ? 'margin-bottom: ' . $settings->btn_bottom_margin . 'px;' : 'margin-bottom: 0;'; ?>
}

/* Label */

.fl-node-<?php echo $id; ?> .uabb-contact-form label {
	<?php echo ( '' != $settings->label_top_margin ) ? 'margin-top: ' . $settings->label_top_margin . 'px;' : ''; ?>
	<?php echo ( '' != $settings->label_bottom_margin ) ? 'margin-bottom: ' . $settings->label_bottom_margin . 'px;' : ''; ?>
}

.fl-node-<?php echo $id; ?> .uabb-input-group.uabb-recaptcha > .uabb-grecaptcha {
	<?php echo ( '' != $settings->input_top_margin ) ? 'margin-top: ' . $settings->input_top_margin . 'px;' : ''; ?>
	<?php echo ( '' != $settings->input_bottom_margin ) ? 'margin-bottom: ' . $settings->input_bottom_margin . 'px;' : 'margin-bottom: 10px;'; ?>
}

/* Button CSS */
<?php
$settings->btn_background_color       = uabb_theme_button_bg_color( $settings->btn_background_color );
$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );
$settings->btn_text_color             = uabb_theme_button_text_color( $settings->btn_text_color );
$settings->btn_text_hover_color       = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );

$settings->btn_border_width = ( isset( $settings->btn_border_width ) && '' != $settings->btn_border_width ) ? $settings->btn_border_width : '2';

// Border Size & Border Color.
if ( 'transparent' == $settings->btn_style ) {
	$border_size        = $settings->btn_border_width;
	$border_color       = $settings->btn_background_color;
	$border_hover_color = $settings->btn_background_hover_color;
}

// Background Gradient.
if ( 'gradient' == $settings->btn_style ) {
	if ( ! empty( $settings->btn_background_color ) ) {
		$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'lighten' );
	}
	if ( ! empty( $settings->btn_background_hover_color ) ) {
		$bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_hover_color ), 30, 'lighten' );
	}
}

if ( '' != $settings->msg_height ) {
	?>

.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {
	min-height: <?php echo $settings->msg_height; ?>px;
}

	<?php
}
if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
	?>
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit i {
	<?php
	echo ( '' != $settings->btn_icon && 'before' == $settings->btn_icon_position ) ? 'margin-right: 8px;' : '';
	echo ( '' != $settings->btn_icon && 'after' == $settings->btn_icon_position ) ? 'margin-left: 8px;' : '';
	?>
}
	<?php
}
?>
<?php
if ( 'default' === $settings->btn_style ) {

	$settings->button_border = uabb_theme_border( $settings->button_border );

	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-builder-content .fl-node-$id .uabb-module-content.uabb-contact-form .uabb-contact-form-submit",
			)
		);
	}
	?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit:hover {
		<?php echo ( '' != $settings->border_hover_color ) ? 'border-color:#' . $settings->border_hover_color . ';' : 'border-color:' . uabb_theme_border_hover_color( '' ) . ';'; ?>
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit i,
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-contact-form-submit span {
	display: inline-block;
	vertical-align: middle;
}

<?php
if ( 'full' != $settings->btn_align ) {
	?>
.fl-node-<?php echo $id; ?> .uabb-submit-btn {
	text-align: <?php echo $settings->btn_align; ?>;
}
<?php } ?>
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit .uabb-contact-form-button-text {
	color: <?php echo uabb_theme_text_color( $settings->btn_text_color ); ?>;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit {
	<?php if ( 'default' !== $settings->btn_style ) { ?>
		border-radius: <?php echo  ( '' != $settings->btn_radius ) ? $settings->btn_radius : '4'; ?>px;
	<?php } ?>
	<?php if ( 'flat' == $settings->btn_style ) { ?>
		background: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
	<?php } elseif ( 'transparent' == $settings->btn_style ) { ?>
		background-color: rgba(0, 0, 0, 0);
		border-style: solid;
		border-color: <?php echo $border_color; ?>;
		border-width: <?php echo $settings->btn_border_width; ?>px;
	<?php } elseif ( 'gradient' == $settings->btn_style ) { ?>
		background: -moz-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%, <?php echo $settings->btn_background_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_grad_start; ?>), color-stop(100%,<?php echo $settings->btn_background_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_grad_start; ?> 0%,<?php echo $settings->btn_background_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_grad_start; ?>', endColorstr='<?php echo $settings->btn_background_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php } elseif ( '3d' == $settings->btn_style ) { ?>
		position: relative;
		-webkit-transition: none;
		-moz-transition: none;
				transition: none;
		background: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
		<?php $shadow_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_color ), 30, 'darken' ); ?>
		box-shadow: 0 6px <?php echo $shadow_color; ?>;
	<?php } ?>
	<?php if ( 'full' == $settings->btn_align ) { ?>
		width:100%;
	<?php } ?>
	<?php
	echo uabb_theme_padding_css_genreated( 'desktop' );
	?>
	<?php
	echo ( '' != $settings->btn_vertical_padding ) ? 'padding-top: ' . $settings->btn_vertical_padding . 'px;padding-bottom: ' . $settings->btn_vertical_padding . 'px;' : '';
	echo ( '' != $settings->btn_horizontal_padding ) ? 'padding-left: ' . $settings->btn_horizontal_padding . 'px;padding-right: ' . $settings->btn_horizontal_padding . 'px;' : '';
	?>
}
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit:hover .uabb-contact-form-button-text {
	<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
	<?php } ?>
}
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit:hover {
	<?php if ( 'flat' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_background_hover_color ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
		<?php } ?>
	<?php } elseif ( 'transparent' == $settings->btn_style ) { ?>

		border-style: solid;
		border-color: <?php echo $border_hover_color; ?>;

		<?php
		if ( 'border' != $settings->hover_attribute ) {
			?>
			background:<?php echo $border_hover_color; ?>;
			<?php
		}
		?>

		border-width: <?php echo $settings->btn_border_width; ?>px;
	<?php } elseif ( 'gradient' == $settings->btn_style ) { ?>

		background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $settings->btn_background_hover_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->btn_background_hover_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->btn_background_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php } elseif ( '3d' == $settings->btn_style ) { ?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>

}


.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit:active {
	<?php if ( '3d' == $settings->btn_style ) { ?>
		top: 6px;
		box-shadow: 0 0px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>
}


/* Input fields typography CSS */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-contact-form input,
	.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {

		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>

			font-size: <?php echo $settings->font_size_unit; ?>px;

			<?php if ( '' == $settings->line_height_unit && '' != $settings->font_size_unit ) : ?>
				line-height: <?php echo $settings->font_size_unit + 2; ?>px;
			<?php endif; ?>
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
			line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->font_size['desktop'] ) && '' == $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] && '' == $settings->line_height_unit ) { ?>
		line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' != $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' == $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->transform ) : ?>
			text-transform: <?php echo $settings->transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_typo',
				'selector'     => ".fl-node-$id .uabb-contact-form .uabb-input-group-wrap input, .fl-node-$id .uabb-contact-form .uabb-input-group-wrap textarea",
			)
		);
	}
}
?>

/* Button typography CSS */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {
		<?php $uabb_theme_btn_family = apply_filters( 'uabb_theme_button_font_family', '' ); ?>

		<?php if ( uabb_theme_button_letter_spacing( '' ) != '' ) { ?>
		letter-spacing: <?php echo uabb_theme_button_letter_spacing( '' ); ?>;
		<?php } ?>

		<?php if ( uabb_theme_button_text_transform( '' ) != '' ) { ?>
		text-transform: <?php echo uabb_theme_button_text_transform( '' ); ?>;
		<?php } ?>

		<?php if ( 'Default' != $settings->btn_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->btn_font_family ); ?>
		<?php else : ?>
			<?php if ( isset( $uabb_theme_btn_family['family'] ) ) { ?>
			font-family: <?php echo $uabb_theme_btn_family['family']; ?>;
			<?php } ?>

			<?php if ( isset( $uabb_theme_btn_family['weight'] ) ) { ?>
			font-weight: <?php echo $uabb_theme_btn_family['weight']; ?>;
			<?php } ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) { ?>
			font-size: <?php echo $settings->btn_font_size_unit; ?>px;
			<?php if ( '' == $settings->btn_line_height_unit && '' != $settings->btn_font_size_unit ) { ?>
				line-height: <?php echo $settings->btn_font_size_unit + 2; ?>px;
			<?php } else { ?>
				<?php if ( uabb_theme_button_font_size( '' ) != '' ) { ?>
					font-size: <?php echo uabb_theme_button_font_size( '' ); ?>;
				<?php } ?>
				<?php
}
} elseif ( isset( $settings->btn_font_size_unit ) && '' == $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] ) {
			?>
			<?php if ( isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) { ?>
				font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
				line-height: <?php echo $settings->btn_font_size['desktop'] + 2; ?>px;
					<?php } ?>
			<?php } ?>

		<?php if ( 'none' != $settings->btn_transform ) : ?>
			text-transform: <?php echo $settings->btn_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->btn_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->btn_letter_spacing; ?>px;
		<?php endif; ?>

		<?php if ( isset( $settings->btn_font_size['desktop'] ) && '' == $settings->btn_font_size['desktop'] && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] && '' == $settings->btn_line_height_unit ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit ) && '' != $settings->btn_line_height_unit ) { ?>
		line-height: <?php echo $settings->btn_line_height_unit; ?>em;
		<?php } else { ?>
				<?php if ( uabb_theme_button_line_height( '' ) != '' ) { ?>
					line-height: <?php echo uabb_theme_button_line_height( '' ); ?>;
				<?php } ?>
		<?php } ?>

		<?php if ( 'yes' !== $converted && isset( $settings->btn_line_height_unit ) && '' == $settings->btn_line_height_unit && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( 'default' === $settings->btn_style ) {

		$button_typo = uabb_theme_button_typography( $settings->button_typo );

		$settings->button_typo            = ( array_key_exists( 'desktop', $button_typo ) ) ? $button_typo['desktop'] : $settings->button_typo;
		$settings->button_typo_medium     = ( array_key_exists( 'tablet', $button_typo ) ) ? $button_typo['tablet'] : $settings->button_typo_medium;
		$settings->button_typo_responsive = ( array_key_exists( 'mobile', $button_typo ) ) ? $button_typo['mobile'] : $settings->button_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo',
				'selector'     => ".fl-node-$id .uabb-contact-form-submit",
			)
		);
	}
}
?>

<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-contact-form label {
		<?php if ( '' != $settings->label_color ) : ?>
			color: <?php echo $settings->label_color; ?>;
		<?php endif; ?>
	}

	/* Button typography CSS */
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-contact-form label {
			<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->label_font_size_unit ) && '' != $settings->label_font_size_unit ) { ?>
				font-size: <?php echo $settings->label_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->label_font_size_unit ) && '' == $settings->label_font_size_unit && isset( $settings->label_font_size['desktop'] ) && '' != $settings->label_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->label_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->label_font_size['desktop'] ) && '' == $settings->label_font_size['desktop'] && isset( $settings->label_line_height['desktop'] ) && '' != $settings->label_line_height['desktop'] && '' == $settings->label_line_height_unit ) { ?>
				line-height: <?php echo $settings->label_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->label_line_height_unit ) && '' != $settings->label_line_height_unit ) { ?>
				line-height: <?php echo $settings->label_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->front_desc_line_height_unit ) && '' == $settings->front_desc_line_height_unit && isset( $settings->label_line_height['desktop'] ) && '' != $settings->label_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->label_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->label_transform ) : ?>
				text-transform: <?php echo $settings->label_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->label_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->label_letter_spacing; ?>px;
			<?php endif; ?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'label_typo',
					'selector'     => ".fl-node-$id .uabb-contact-form label",
				)
			);
	}
}
}
?>

<?php if ( 'show' == $settings->terms_checkbox ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-label {
		<?php if ( isset( $settings->checkbox_color ) && '' != $settings->checkbox_color ) : ?>

			transition: color 300ms ease;
			color: <?php echo ( false === strpos( $settings->checkbox_color, 'rgb' ) ) ? $settings->checkbox_color : $settings->checkbox_color; ?>;
		<?php endif; ?>
	}

	/* Check-boxes typography CSS */
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-label {

			<?php if ( 'Default' != $settings->checkbox_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->checkbox_font_family ); ?>
			<?php endif; ?>

			<?php if ( isset( $settings->checkbox_font_size ) && '' != $settings->checkbox_font_size ) : ?>
				font-size: <?php echo $settings->checkbox_font_size; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->checkbox_line_height ) && '' != $settings->checkbox_line_height ) : ?>
				line-height: <?php echo $settings->checkbox_line_height; ?>em;
			<?php endif; ?>

			<?php if ( 'none' != $settings->checkbox_text_transform ) : ?>
				text-transform: <?php echo $settings->checkbox_text_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->checkbox_text_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->checkbox_text_letter_spacing; ?>px;
			<?php endif; ?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'checkbox_typo',
					'selector'     => ".fl-node-$id .uabb-contact-form .uabb-terms-label",
				)
			);
	}
}
}
?>

<?php if ( 'show' == $settings->terms_checkbox ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-text {
		<?php if ( isset( $settings->terms_color ) && '' != $settings->terms_color ) : ?>
		transition: color 300ms ease;
			color: <?php echo ( false === strpos( $settings->terms_color, 'rgb' ) ) ? $settings->terms_color : $settings->terms_color; ?>;
		<?php endif; ?>
	}

	/* Terms typography CSS */
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-text {

			<?php if ( 'Default' != $settings->terms_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->terms_font_family ); ?>
			<?php endif; ?>

			<?php if ( isset( $settings->terms_font_size ) && '' != $settings->terms_font_size ) : ?>
				font-size: <?php echo $settings->terms_font_size; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->terms_line_height ) && '' != $settings->terms_line_height ) : ?>
				line-height: <?php echo $settings->terms_line_height; ?>em;
			<?php endif; ?>

			<?php if ( 'none' != $settings->terms_text_transform ) : ?>
				text-transform: <?php echo $settings->terms_text_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->terms_text_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->terms_text_letter_spacing; ?>px;
			<?php endif; ?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'terms_typo',
					'selector'     => ".fl-node-$id .uabb-contact-form .uabb-terms-text",
				)
			);
	}
}
}
?>

<!-- Terms and Conditions code starts here -->

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input[type="checkbox"] + span:before {
	background: #fafafa;
}
<?php
$font_size     = intval( $settings->checkbox_size );
$checked_width = $font_size - intval( $settings->checkbox_border_width );
?>
.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input[type="checkbox"] {
	display: none;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-checkbox .checkbox-label {
	padding-left: 0px;
	-webkit-padding-start: 0px;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap .uabb-terms-label input[type="checkbox"] + span:before {
	content: '';
	<?php if ( isset( $settings->checkbox_bgcolor ) && '' != $settings->checkbox_bgcolor ) : ?>
		transition: background-color 300ms ease;
	background-color: <?php echo ( false === strpos( $settings->checkbox_bgcolor, 'rgb' ) ) ? '#' . $settings->checkbox_bgcolor : $settings->checkbox_bgcolor; ?>;
	<?php endif; ?>
	border-width: <?php echo $settings->checkbox_border_width; ?>px;
	border-color: #<?php echo $settings->checkbox_border_color; ?>;
	vertical-align: middle;
	width: <?php echo $settings->checkbox_size; ?>px;
	height: <?php echo $settings->checkbox_size; ?>px;
	padding: 2px;
	margin-right: 10px;
	text-align: center;
	display: inline-flex;
	align-items: center;
	align-content: center;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input[type="checkbox"]:checked + span:before {
	content: "\2714";
	font-weight: bold;
	font-size: <?php echo $checked_width; ?>px;
	line-height: <?php echo $checked_width; ?>px;
	padding-top: 2px;
	color: #<?php echo $settings->checkbox_selected_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-input-group-wrap input[type="checkbox"] + span:before {
	border-radius: <?php echo $settings->checkbox_border_radius; ?>px;
}

/* Terms and Conditions code ends here */

/* Typography responsive css */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>

	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-contact-form input,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->font_size_unit_medium; ?>px;
						<?php if ( '' != $settings->font_size_unit_medium && '' == $settings->line_height_unit_medium ) : ?>
							line-height: <?php echo $settings->font_size_unit_medium + 2; ?>px;
						<?php endif; ?>
				<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
					font-size: <?php echo $settings->font_size['medium']; ?>px;
					line-height: <?php echo $settings->font_size['medium'] + 2; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->font_size['medium'] ) && '' == $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
					line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
					line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php } ?>

			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-text {
				<?php if ( isset( $settings->terms_font_size_medium ) && '' != $settings->terms_font_size_medium ) : ?>
					font-size: <?php echo $settings->terms_font_size_medium; ?>px;
				<?php endif; ?>

				<?php if ( isset( $settings->terms_line_height_medium ) && '' != $settings->terms_line_height_medium ) : ?>
					line-height: <?php echo $settings->terms_line_height_medium; ?>em;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-label {
				<?php if ( isset( $settings->checkbox_font_size_medium ) && '' != $settings->checkbox_font_size_medium ) : ?>
					font-size: <?php echo $settings->checkbox_font_size_medium; ?>px;
				<?php endif; ?>

				<?php if ( isset( $settings->checkbox_line_height_medium ) && '' != $settings->checkbox_line_height_medium ) : ?>
					line-height: <?php echo $settings->checkbox_line_height_medium; ?>em;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {

				<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_medium ) && '' != $settings->btn_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->btn_font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->btn_line_height_unit_medium && '' != $settings->btn_font_size_unit_medium ) : ?>
							line-height: <?php echo $settings->btn_font_size_unit_medium + 2; ?>px;
						<?php endif; ?>
				<?php } elseif ( isset( $settings->btn_font_size_unit_medium ) && '' == $settings->btn_font_size_unit_medium && isset( $settings->btn_font_size['medium'] ) && '' != $settings->btn_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
					line-height: <?php echo $settings->btn_font_size['medium'] + 2; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_font_size['medium'] ) && '' == $settings->btn_font_size['medium'] && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit ) { ?>
					line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_medium ) && '' != $settings->btn_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->btn_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->btn_line_height_unit_medium ) && '' == $settings->btn_line_height_unit_medium && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php } ?>
			}

			<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-contact-form label {

					<?php if ( 'yes' === $converted || isset( $settings->label_font_size_unit_medium ) && '' != $settings->label_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->label_font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->label_line_height_unit_medium && '' != $settings->label_font_size_unit_medium ) : ?>
							line-height: <?php echo $settings->label_font_size_unit_medium + 2; ?>px;
						<?php endif; ?>
					<?php } elseif ( isset( $settings->label_font_size_unit_medium ) && '' == $settings->label_font_size_unit_medium && isset( $settings->label_font_size['medium'] ) && '' != $settings->label_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->label_font_size['medium']; ?>px;
						line-height: <?php echo $settings->label_font_size['medium'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->label_font_size['medium'] ) && '' == $settings->label_font_size['medium'] && isset( $settings->label_line_height['medium'] ) && '' != $settings->label_line_height['medium'] && '' == $settings->label_line_height_unit_medium && '' == $settings->label_line_height_unit ) { ?>
						line-height: <?php echo $settings->label_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->label_line_height_unit_medium ) && '' != $settings->label_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->label_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->label_line_height_unit_medium ) && '' == $settings->label_line_height_unit_medium && isset( $settings->label_line_height['medium'] ) && '' != $settings->label_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->label_line_height['medium']; ?>px;
					<?php } ?>
			}
				<?php
}
}
		?>

		.fl-node-<?php echo $id; ?> .uabb-contact-form {
			<?php

			if ( 'yes' === $converted || '' != $settings->form_spacing_dimension_top_medium && isset( $settings->form_spacing_dimension_top_medium ) && isset( $settings->form_spacing_dimension_bottom_medium ) && '' != $settings->form_spacing_dimension_bottom_medium && isset( $settings->form_spacing_dimension_left_medium ) && '' != $settings->form_spacing_dimension_left_medium && isset( $settings->form_spacing_dimension_right_medium ) && '' != $settings->form_spacing_dimension_right_medium ) {
				if ( isset( $settings->form_spacing_dimension_top_medium ) ) {
					echo ( '' != $settings->form_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->form_spacing_dimension_top_medium . 'px;' : '';
				}
				if ( isset( $settings->form_spacing_dimension_bottom_medium ) ) {
					echo ( '' != $settings->form_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->form_spacing_dimension_left_medium ) ) {
					echo ( '' != $settings->form_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->form_spacing_dimension_left_medium . 'px;' : '';
				}
				if ( isset( $settings->form_spacing_dimension_right_medium ) ) {
					echo ( '' != $settings->form_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->form_spacing_dimension_right_medium . 'px;' : '';
				}
			} elseif ( isset( $settings->form_spacing ) && '' != $settings->form_spacing && isset( $settings->form_spacing_dimension_top_medium ) && '' == $settings->form_spacing_dimension_top_medium && isset( $settings->form_spacing_dimension_bottom_medium ) && '' == $settings->form_spacing_dimension_bottom_medium && isset( $settings->form_spacing_dimension_left_medium ) && '' == $settings->form_spacing_dimension_left_medium && isset( $settings->form_spacing_dimension_right_medium ) && '' == $settings->form_spacing_dimension_right_medium ) {
				echo $settings->form_spacing;
				?>
				;
			<?php } ?>
		}
		<?php if ( empty( $settings->btn_vertical_padding ) && empty( $settings->btn_horizontal_padding ) && 'default' === $settings->btn_style ) { ?>
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit {
				<?php echo uabb_theme_padding_css_genreated( 'tablet' ); ?>
			}
		<?php } ?>

	}

	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-contact-form input,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
						<?php if ( '' == $settings->line_height_unit_responsive && '' != $settings->font_size_unit_responsive ) : ?>
							line-height: <?php echo $settings->font_size_unit_responsive + 2; ?>px;
						<?php endif; ?>
				<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
					font-size: <?php echo $settings->font_size['small']; ?>px;
					line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->font_size['small'] ) && '' == $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) : ?>
					line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php endif; ?>

				<?php if ( isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) : ?>
					line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-text {
				<?php if ( isset( $settings->terms_font_size_responsive ) && '' != $settings->terms_font_size_responsive ) : ?>
					font-size: <?php echo $settings->terms_font_size_responsive; ?>px;
				<?php endif; ?>

				<?php if ( isset( $settings->terms_line_height_responsive ) && '' != $settings->terms_line_height_responsive ) : ?>
					line-height: <?php echo $settings->terms_line_height_responsive; ?>em;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form .uabb-terms-label {
				<?php if ( isset( $settings->checkbox_font_size_responsive ) && '' != $settings->checkbox_font_size_responsive ) : ?>
					font-size: <?php echo $settings->checkbox_font_size_responsive; ?>px;
				<?php endif; ?>

				<?php if ( isset( $settings->checkbox_line_height_responsive ) && '' != $settings->checkbox_line_height_responsive ) : ?>
					line-height: <?php echo $settings->checkbox_line_height_responsive; ?>em;
				<?php endif; ?>

				<?php if ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
					line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php } else { ?>
					<?php if ( isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) : ?>
						line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
					<?php endif; ?>
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-contact-form-submit {

				<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_responsive ) && '' != $settings->btn_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->btn_font_size_unit_responsive; ?>px;
						<?php if ( '' == $settings->btn_line_height_unit_responsive && '' != $settings->btn_font_size_unit_responsive ) : ?>
							line-height: <?php echo $settings->btn_font_size_unit_responsive + 2; ?>px;
						<?php endif; ?>
				<?php } elseif ( isset( $settings->btn_font_size_unit_responsive ) && '' == $settings->btn_font_size_unit_responsive && isset( $settings->btn_font_size['small'] ) && '' != $settings->btn_font_size['small'] ) { ?>
					font-size: <?php echo $settings->btn_font_size['small']; ?>px;
					line-height: <?php echo $settings->btn_font_size['small'] + 2; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_font_size['small'] ) && '' == $settings->btn_font_size['small'] && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] && '' == $settings->btn_line_height_unit_responsive && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit ) : ?>
					line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php endif; ?>

				<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_responsive ) && '' != $settings->btn_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->btn_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->btn_line_height_unit_responsive ) && '' == $settings->btn_line_height_unit_responsive && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] ) { ?>
					line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php } ?>
			}

			<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-contact-form label {

					<?php if ( 'yes' === $converted || isset( $settings->label_font_size_unit_responsive ) && '' != $settings->label_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->label_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->label_font_size_unit_responsive ) && '' == $settings->label_font_size_unit_responsive && isset( $settings->label_font_size['small'] ) && '' != $settings->label_font_size['small'] ) { ?>
						font-size: <?php echo $settings->label_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->label_font_size['small'] ) && '' == $settings->label_font_size['small'] && isset( $settings->label_line_height['small'] ) && '' != $settings->label_line_height['small'] && '' == $settings->label_line_height_unit_responsive && '' == $settings->label_line_height_unit && '' == $settings->label_line_height_unit_medium ) : ?>
						line-height: <?php echo $settings->label_line_height['small']; ?>px;
					<?php endif; ?>

					<?php if ( 'yes' === $converted || isset( $settings->label_line_height_unit_responsive ) && '' != $settings->label_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->label_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->label_line_height_unit_responsive ) && '' == $settings->label_line_height_unit_responsive && isset( $settings->label_line_height['small'] ) && '' != $settings->label_line_height['small'] ) { ?>
						line-height: <?php echo $settings->label_line_height['small']; ?>px;
					<?php } ?>
				}
				<?php
}
}
		?>

		.fl-node-<?php echo $id; ?> .uabb-contact-form {
			<?php
			if ( isset( $settings->form_spacing_dimension_top_responsive ) ) {
				echo ( '' != $settings->form_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->form_spacing_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->form_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_left_responsive ) ) {
				echo ( '' != $settings->form_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->form_spacing_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->form_spacing_dimension_right_responsive ) ) {
				echo ( '' != $settings->form_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->form_spacing_dimension_right_responsive . 'px;' : '';
			}
			?>
		}
		<?php if ( empty( $settings->btn_vertical_padding ) && empty( $settings->btn_horizontal_padding ) && 'default' === $settings->btn_style ) { ?>
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-module-content.uabb-contact-form .uabb-contact-form-submit {
				<?php echo uabb_theme_padding_css_genreated( 'mobile' ); ?>
			}
		<?php } ?>
	}
	<?php
}
?>
