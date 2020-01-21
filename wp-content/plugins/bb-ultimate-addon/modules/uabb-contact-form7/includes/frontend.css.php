<?php
/**
 *  UABB Contact Form 7 Module front-end CSS php file
 *
 * @package UABB Contact Form 7 Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->form_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );

$settings->input_background_color    = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
$settings->input_border_active_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color' );

$settings->btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
$settings->btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
$settings->btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
$settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );

/* Typography Colors */

$settings->form_title_color = UABB_Helper::uabb_colorpicker( $settings, 'form_title_color' );
$settings->form_desc_color  = UABB_Helper::uabb_colorpicker( $settings, 'form_desc_color' );

$settings->label_color = UABB_Helper::uabb_colorpicker( $settings, 'label_color' );
/* Input Color */
$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );

$settings->input_msg_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_msg_color' );
$settings->validation_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_msg_color' );
$settings->validation_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'validation_bg_color', true );

$settings->radio_check_size         = ( isset( $settings->radio_check_size ) && '' != $settings->radio_check_size ) ? $settings->radio_check_size : 20;
$settings->radio_check_border_width = ( isset( $settings->radio_check_border_width ) && '' != $settings->radio_check_border_width ) ? $settings->radio_check_border_width : 1;
$settings->radio_btn_border_radius  = ( isset( $settings->radio_btn_border_radius ) && '' != $settings->radio_btn_border_radius ) ? $settings->radio_btn_border_radius : 50;
$settings->checkbox_border_radius   = ( isset( $settings->checkbox_border_radius ) && '' != $settings->checkbox_border_radius ) ? $settings->checkbox_border_radius : 0;
$settings->input_msg_font_size      = ( isset( $settings->input_msg_font_size ) && '' != $settings->input_msg_font_size ) ? $settings->input_msg_font_size : 12;
$settings->validation_msg_font_size = ( isset( $settings->validation_msg_font_size ) && '' != $settings->validation_msg_font_size ) ? $settings->validation_msg_font_size : 15;

if ( ! $version_bb_check ) {
	$settings->input_border_radius     = ( isset( $settings->input_border_radius ) && '' != $settings->input_border_radius ) ? $settings->input_border_radius : 0;
	$settings->validation_border_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_border_color' );
	$settings->input_border_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color' );
}

?>
.fl-node-<?php echo $id; ?> {
	width: 100%;
}

/* Form Style */
.fl-node-<?php echo $id; ?> .uabb-cf7-style {
	<?php if ( 'color' == $settings->form_bg_type ) { ?>
		background-color: <?php echo $settings->form_bg_color; ?>;
	<?php } elseif ( 'image' == $settings->form_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->form_bg_img )->url ) ) { ?>
		background-image: url(<?php echo FLBuilderPhoto::get_attachment_data( $settings->form_bg_img )->url; ?>);
		background-position: <?php echo $settings->form_bg_img_pos; ?>;
		background-size: <?php echo $settings->form_bg_img_size; ?>;
		background-repeat: <?php echo $settings->form_bg_img_repeat; ?>;
	<?php } elseif ( 'gradient' == $settings->form_bg_type ) { ?>
		<?php UABB_Helper::uabb_gradient_css( $settings->form_bg_gradient ); ?>
	<?php } ?>

	<?php
	if ( 'yes' === $converted || isset( $settings->form_spacing_dimension_top ) && isset( $settings->form_spacing_dimension_bottom ) && isset( $settings->form_spacing_dimension_left ) && isset( $settings->form_spacing_dimension_right ) ) {
		if ( isset( $settings->form_spacing_dimension_top ) ) {
			echo ( '' != $settings->form_spacing_dimension_top ) ? 'padding-top:' . $settings->form_spacing_dimension_top . 'px;' : 'padding-top: 20px;';
		}
		if ( isset( $settings->form_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->form_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->form_spacing_dimension_bottom . 'px;' : 'padding-bottom: 20px;';
		}
		if ( isset( $settings->form_spacing_dimension_left ) ) {
			echo ( '' != $settings->form_spacing_dimension_left ) ? 'padding-left:' . $settings->form_spacing_dimension_left . 'px;' : 'padding-left: 20px;';
		}
		if ( isset( $settings->form_spacing_dimension_right ) ) {
			echo ( '' != $settings->form_spacing_dimension_right ) ? 'padding-right:' . $settings->form_spacing_dimension_right . 'px;' : 'padding-right: 20px;';
		}
	} elseif ( isset( $settings->form_spacing ) && '' != $settings->form_spacing && isset( $settings->form_spacing_dimension_top ) && '' == $settings->form_spacing_dimension_top && isset( $settings->form_spacing_dimension_bottom ) && '' == $settings->form_spacing_dimension_bottom && isset( $settings->form_spacing_dimension_left ) && '' == $settings->form_spacing_dimension_left && isset( $settings->form_spacing_dimension_right ) && '' == $settings->form_spacing_dimension_right ) {
		echo $settings->form_spacing;
		?>
		;
	<?php } ?>

	<?php if ( '' != $settings->form_radius ) { ?>
		border-radius:<?php echo $settings->form_radius; ?>px;
	<?php } ?>
}

/* Input Fields CSS */
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style form select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style form textarea {

	<?php
	if ( 'yes' === $converted || isset( $settings->input_padding_dimension_top ) && isset( $settings->input_padding_dimension_bottom ) && isset( $settings->input_padding_dimension_left ) && isset( $settings->input_padding_dimension_right ) ) {
		if ( isset( $settings->input_padding_dimension_top ) ) {
			echo ( '' != $settings->input_padding_dimension_top ) ? 'padding-top:' . $settings->input_padding_dimension_top . 'px;' : 'padding-top: 10px;';
		}
		if ( isset( $settings->input_padding_dimension_bottom ) ) {
			echo ( '' != $settings->input_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->input_padding_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
		}
		if ( isset( $settings->input_padding_dimension_left ) ) {
			echo ( '' != $settings->input_padding_dimension_left ) ? 'padding-left:' . $settings->input_padding_dimension_left . 'px;' : 'padding-left: 10px;';
		}
		if ( isset( $settings->input_padding_dimension_right ) ) {
			echo ( '' != $settings->input_padding_dimension_right ) ? 'padding-right:' . $settings->input_padding_dimension_right . 'px;' : 'padding-right: 10px;';
		}
	} elseif ( isset( $settings->input_padding ) && '' != $settings->input_padding && isset( $settings->input_padding_dimension_top ) && '' == $settings->input_padding_dimension_top && isset( $settings->input_padding_dimension_bottom ) && '' == $settings->input_padding_dimension_bottom && isset( $settings->input_padding_dimension_left ) && '' == $settings->input_padding_dimension_left && isset( $settings->input_padding_dimension_right ) && '' == $settings->input_padding_dimension_right ) {
		$settings->input_padding = ( isset( $settings->input_padding ) && '' != $settings->input_padding ) ? $settings->input_padding : 10;
		echo $settings->input_padding;
		?>
		;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {
	<?php if ( '' != $settings->textarea_height ) { ?>
	height: <?php echo $settings->textarea_height; ?>px;
	<?php } ?>
}


.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style select {
	<?php
	if ( '' != $settings->input_field_height ) {
		?>
		height: <?php echo $settings->input_field_height; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus {
	-webkit-appearance: menulist !important;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea,
.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
	outline: none;
	text-align: <?php echo $settings->input_text_align; ?>;
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
	<?php
	$bgcolor = '';
	if ( 'color' == $settings->input_background_type ) {
		$bgcolor = ( '' != $settings->input_background_color ) ? $settings->input_background_color : '';
	} else {
		$bgcolor = 'transparent';
	}
	?>
	background: <?php echo $bgcolor; ?>;
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus {

		<?php if ( '' != $settings->input_border_radius ) { ?>
			border-radius: <?php echo $settings->input_border_radius; ?>px;
		<?php } ?>

		border-style: solid;
		border-color: <?php echo uabb_theme_text_color( $settings->input_border_color ); ?>;
		<?php
		if ( 'yes' === $converted || isset( $settings->input_border_width_dimension_top ) && isset( $settings->input_border_width_dimension_bottom ) && isset( $settings->input_border_width_dimension_left ) && isset( $settings->input_border_width_dimension_right ) ) {
			if ( isset( $settings->input_border_width_dimension_top ) ) {
				echo ( '' != $settings->input_border_width_dimension_top ) ? 'border-top-width:' . $settings->input_border_width_dimension_top . 'px;' : 'border-top-width: 1px;';
			}
			if ( isset( $settings->input_border_width_dimension_bottom ) ) {
				echo ( '' != $settings->input_border_width_dimension_bottom ) ? 'border-bottom-width:' . $settings->input_border_width_dimension_bottom . 'px;' : 'border-bottom-width: 1px;';
			}
			if ( isset( $settings->input_border_width_dimension_left ) ) {
				echo ( '' != $settings->input_border_width_dimension_left ) ? 'border-left-width:' . $settings->input_border_width_dimension_left . 'px;' : 'border-left-width: 1px;';
			}
			if ( isset( $settings->input_border_width_dimension_right ) ) {
				echo ( '' != $settings->input_border_width_dimension_right ) ? 'border-right-width:' . $settings->input_border_width_dimension_right . 'px;' : 'border-right-width: 1px;';
			}
		} elseif ( isset( $settings->uabb_input_border_width ) && '' != $settings->uabb_input_border_width && isset( $settings->input_border_width_dimension_top ) && '' == $settings->input_border_width_dimension_top && isset( $settings->input_border_width_dimension_bottom ) && '' == $settings->input_border_width_dimension_bottom && isset( $settings->input_border_width_dimension_left ) && '' == $settings->input_border_width_dimension_left && isset( $settings->input_border_width_dimension_right ) && '' == $settings->input_border_width_dimension_right ) {
						$str = '';
			if ( is_array( $settings->uabb_input_border_width ) ) {
				if ( 'collapse' == $settings->uabb_input_border_width['simplify'] ) {
					if ( '' == $settings->uabb_input_border_width['all'] || '0' == $settings->uabb_input_border_width['all'] ) {
						$settings->uabb_input_border_width['all'] = '0';
					}
							$str = $settings->uabb_input_border_width['all'] . 'px';
				} else {

					if ( '' == $settings->uabb_input_border_width['top'] || '0' == $settings->uabb_input_border_width['top'] ) {
						$settings->uabb_input_border_width['top'] = '0';
					}
					if ( '' == $settings->uabb_input_border_width['bottom'] || '0' == $settings->uabb_input_border_width['bottom'] ) {
						$settings->uabb_input_border_width['bottom'] = '0';
					}
					if ( '' == $settings->uabb_input_border_width['right'] || '0' == $settings->uabb_input_border_width['right'] ) {
						$settings->uabb_input_border_width['right'] = '0';
					}
					if ( '' == $settings->uabb_input_border_width['left'] || '0' == $settings->uabb_input_border_width['left'] ) {
						$settings->uabb_input_border_width['left'] = '0';
					}

						$str  = ( '' != $settings->uabb_input_border_width['top'] ) ? $settings->uabb_input_border_width['top'] . 'px ' : '0 ';
						$str .= ( '' != $settings->uabb_input_border_width['right'] ) ? $settings->uabb_input_border_width['right'] . 'px ' : '0 ';
						$str .= ( '' != $settings->uabb_input_border_width['bottom'] ) ? $settings->uabb_input_border_width['bottom'] . 'px ' : '0 ';
						$str .= ( '' != $settings->uabb_input_border_width['left'] ) ? $settings->uabb_input_border_width['left'] . 'px ' : '0;';
				}
			}
			?>
					border-width: <?php echo $str; ?>
			<?php
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
					'selector'     => ".fl-node-$id .uabb-cf7-style select, .fl-node-$id .uabb-cf7-style input[type=tel], .fl-node-$id .uabb-cf7-style input[type=email], .fl-node-$id .uabb-cf7-style input[type=text], .fl-node-$id .uabb-cf7-style input[type=url], .fl-node-$id .uabb-cf7-style input[type=number], .fl-node-$id .uabb-cf7-style input[type=date], .fl-node-$id .uabb-cf7-style textarea",
				)
			);
	}
}

if ( '' != $settings->input_border_active_color ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style select:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:active,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
		border-color: <?php echo $settings->input_border_active_color; ?>;
	}
<?php } ?>

/* Placeholder Colors */

.fl-node-<?php echo $id; ?> .uabb-cf7-style ::-webkit-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style :-moz-placeholder {         /* Firefox 18- */
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style ::-moz-placeholder {    /* Firefox 19+ */
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style :-ms-input-placeholder {
	color: <?php echo uabb_theme_text_color( $settings->color ); ?>;
}

<?php
if ( 'true' == $settings->radio_check_custom_option ) {
	$font_size = $settings->radio_check_size / 1.3;
	?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] {
		display: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span:before,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span:before {
		content: '';
		background: #<?php echo $settings->radio_check_bgcolor; ?>;
		border: <?php echo $settings->radio_check_border_width; ?>px solid #<?php echo $settings->radio_check_border_color; ?>;
		display: inline-block;
		vertical-align: middle;
		width: <?php echo $settings->radio_check_size; ?>px;
		height: <?php echo $settings->radio_check_size; ?>px;
		padding: 2px;
		margin-right: 10px;
		text-align: center;
	}

	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox']:checked + span:before {
		content: "\2714";
		font-weight: bold;
		font-size: calc(<?php echo $font_size; ?>px - <?php echo $settings->radio_check_border_width; ?>px );
		padding-top: 0;
		color: #<?php echo $settings->radio_check_selected_color; ?>;
		line-height: 1.3;
	}

	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span:before {
		border-radius: <?php echo $settings->checkbox_border_radius; ?>px;
	}

	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio']:checked + span:before {
		background: #<?php echo $settings->radio_check_selected_color; ?>;
		box-shadow: inset 0px 0px 0px 4px #<?php echo $settings->radio_check_bgcolor; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span:before {
		border-radius: <?php echo $settings->radio_btn_border_radius; ?>px;
	}
	<?php
}
?>

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span,
.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
	<?php
	if ( 'true' == $settings->radio_check_custom_option ) {
		if ( '' != $settings->radio_checkbox_color ) :
			?>
			color: #<?php echo $settings->radio_checkbox_color; ?>;
			<?php
		endif;
	}
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span,
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
		<?php
		if ( 'true' == $settings->radio_check_custom_option ) {
			if ( 'Default' != $settings->radio_checkbox_font_family['family'] ) :
				?>
				<?php
				UABB_Helper::uabb_font_css( $settings->radio_checkbox_font_family );
			endif;
			?>

			<?php if ( isset( $settings->radio_checkbox_font_size_unit ) && '' != $settings->radio_checkbox_font_size_unit ) : ?>
				font-size: <?php echo $settings->radio_checkbox_font_size_unit; ?>px;
			<?php endif; ?>

			<?php if ( 'none' != $settings->radio_checkbox_transform ) : ?>
				text-transform: <?php echo $settings->radio_checkbox_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->radio_checkbox_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->radio_checkbox_letter_spacing; ?>px;
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
				'selector'     => ".fl-node-$id .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span, .fl-node-$id .uabb-cf7-style .wpcf7-radio input[type='radio'] + span",
			)
		);
	}
}
?>

<?php
/* Button CSS */
$settings->btn_background_color       = uabb_theme_button_bg_color( $settings->btn_background_color );
$settings->btn_background_hover_color = uabb_theme_button_bg_hover_color( $settings->btn_background_hover_color );
$settings->btn_text_color             = uabb_theme_button_text_color( $settings->btn_text_color );
$settings->btn_text_hover_color       = uabb_theme_button_text_hover_color( $settings->btn_text_hover_color );
$settings->btn_border_width           = ( isset( $settings->btn_border_width ) && '' != $settings->btn_border_width ) ? $settings->btn_border_width : '2';

$border_size = '';
$border_color = '';
$border_hover_color = '';
$bg_hover_grad_start = '';
$bg_grad_start = '';
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
?>
<?php if ( 'default' == $settings->btn_style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
		<?php 
		if ( isset( $settings->button_padding_dimension_top ) ) {
			echo ( '' != $settings->button_padding_dimension_top ) ? 'padding-top:' . $settings->button_padding_dimension_top . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'desktop', 'top' ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_bottom ) ) {
			echo ( '' != $settings->button_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom . 'px;' : 'padding-bottom:' . uabb_theme_padding_button( 'desktop', 'bottom' ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_left ) ) {
			echo ( '' != $settings->button_padding_dimension_left ) ? 'padding-left:' . $settings->button_padding_dimension_left . 'px;' : 'padding-left:' . uabb_theme_padding_button( 'desktop', 'left' ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_right ) ) {
			echo ( '' != $settings->button_padding_dimension_right ) ? 'padding-right:' . $settings->button_padding_dimension_right . 'px;' : 'padding-right:' . uabb_theme_padding_button( 'desktop', 'right' ) . ';';
		} 
		if ( isset( $settings->btn_background_color ) ) {
			echo ( '' != $settings->btn_background_color ) ? 'background:' . $settings->btn_background_color . ';' : '';
		}
		?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
			<?php 
			if ( isset( $settings->button_border_style ) ) {
				echo ( '' != $settings->button_border_style && 'none' !== $settings->button_border_style ) ? 'border-style:' . $settings->button_border_style . ';' : 'border-style:solid;';
			}
			if ( isset( $settings->button_border_width ) && ! empty( $settings->button_border_width ) ) {
				echo ( '' != $settings->button_border_width ) ? 'border-width:' . $settings->button_border_width . 'px;' : '';
			} else {

				$border_width = uabb_theme_button_border_width( '' );

				echo ( is_array( $border_width ) && array_key_exists( 'top', $border_width ) ) ? 'border-top-width:' . $border_width['top'] . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'left', $border_width ) ) ? 'border-left-width:' . $border_width['left'] . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'right', $border_width ) ) ? 'border-right-width:' . $border_width['right'] . 'px;' : '';
				echo ( is_array( $border_width ) && array_key_exists( 'bottom', $border_width ) ) ? 'border-bottom-width:' . $border_width['bottom'] . 'px;' : '';
			}
			if ( isset( $settings->button_border_radius ) ) {
				echo ( '' != $settings->button_border_radius ) ? 'border-radius:' . $settings->button_border_radius . 'px;' : 'border-radius:' . uabb_theme_button_border_radius( '' ) . 'px;';
			}
			if ( isset( $settings->button_border_color ) ) {
				echo ( '' != $settings->button_border_color ) ? 'border-color:#' . $settings->button_border_color . ';' : 'border-color:' . uabb_theme_border_color( '' ) . ';';
			}
			?>
		}
	<?php } else {
		$settings->button_border = uabb_theme_border( $settings->button_border );

		if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'button_border',
					'selector'     => ".fl-node-$id .uabb-cf7-style input[type=submit]",
				)
			);
		}
	} ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit]:hover {
	<?php echo ( '' != $settings->border_hover_color ) ? 'border-color:#' . $settings->border_hover_color . ';' : 'border-color:' . uabb_theme_border_hover_color( '' ) . ';'; ?>
	<?php echo ( '' != $settings->btn_text_hover_color ) ? 'color:' . $settings->btn_text_hover_color . ';' : ''; ?>
	<?php echo ( '' != $settings->btn_background_hover_color ) ? 'background:' . $settings->btn_background_hover_color . ';' : ''; ?>
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
	<?php if ( 'center' == $settings->btn_align ) { ?>
			margin-left: auto;
			margin-right: auto;
	<?php } elseif ( 'right' == $settings->btn_align ) { ?>
			margin-left: auto;
			margin-right: 0;
	<?php } ?>

	<?php if ( '' != $settings->btn_border_radius ) { ?>
		border-radius: <?php echo $settings->btn_border_radius; ?>px;
	<?php } ?>

	<?php if ( isset( $settings->btn_margin_top ) && '' != $settings->btn_margin_top ) { ?>
		margin-top: <?php echo $settings->btn_margin_top; ?>px;
	<?php } ?>

	<?php if ( isset( $settings->btn_margin_bottom ) && '' != $settings->btn_margin_bottom ) { ?>
		margin-bottom: <?php echo $settings->btn_margin_bottom; ?>px;
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

	color: <?php echo uabb_theme_text_color( $settings->btn_text_color ); ?>;

	<?php if ( 'full' == $settings->btn_width ) { ?>
		width:100%;
		<?php echo uabb_theme_padding_css_genreated( 'desktop' ); ?>
		<?php
} elseif ( 'custom' == $settings->btn_width ) {

	$padding_top_bottom = ( '' !== $settings->btn_padding_top_bottom ) ? $settings->btn_padding_top_bottom : uabb_theme_button_vertical_padding( '' );
	?>

		padding-top: <?php echo $padding_top_bottom; ?>px;
		padding-bottom: <?php echo $padding_top_bottom; ?>px;
	<?php if ( '' != $settings->btn_custom_width ) { ?>
			width: <?php echo $settings->btn_custom_width; ?>px;
		<?php } ?>

	<?php if ( '' != $settings->btn_custom_height ) { ?>
			min-height: <?php echo $settings->btn_custom_height; ?>px;
		<?php } ?>

	<?php } else { ?>
		<?php if ( 'default' !== $settings->btn_style ) { ?>
			<?php echo uabb_theme_padding_css_genreated( 'desktop' ); ?>
		<?php } ?>
	<?php } ?>

}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit]:hover {
	<?php if ( 'flat' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>

		<?php if ( '' != $settings->btn_background_hover_color ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
		<?php } ?>
	<?php } elseif ( 'transparent' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
			<?php
}
if ( 'border' == $settings->hover_attribute ) {
	?>
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
} else {
	?>
		background:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
}
?>
		border-style: solid;
		background-clip: padding-box;
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		border-width: <?php echo $settings->btn_border_width; ?>px;
	<?php } elseif ( 'gradient' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>

		background: -moz-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%, <?php echo $settings->btn_background_hover_color; ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->btn_background_hover_color; ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo $bg_hover_grad_start; ?> 0%,<?php echo $settings->btn_background_hover_color; ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->btn_background_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	<?php
} elseif ( '3d' == $settings->btn_style ) {
	$shadow_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->btn_background_hover_color ), 30, 'darken' );
	?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>
		<?php if ( '' != $settings->btn_background_hover_color ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
			<?php
}
}
?>
}


.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit]:active {
	<?php if ( '3d' == $settings->btn_style ) { ?>
		top: 6px;
		box-shadow: 0 0px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=file],
.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {
	<?php echo ( '' != $settings->input_top_margin ) ? 'margin-top: ' . $settings->input_top_margin . 'px;' : ''; ?>
	<?php echo ( '' != $settings->input_bottom_margin ) ? 'margin-bottom: ' . $settings->input_bottom_margin . 'px;' : 'margin-bottom: 10px;'; ?>
}

.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {
	<?php if ( '' != $settings->form_title_color ) : ?>
		color: <?php echo $settings->form_title_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->form_text_align; ?>;

	margin: 0 0 <?php echo ( '' != $settings->form_title_bottom_margin ) ? $settings->form_title_bottom_margin : '0'; ?>px;
}

/* Typography CSS */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {
		<?php if ( 'Default' != $settings->form_title_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->form_title_font_family ); ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->form_title_font_size_unit ) && '' != $settings->form_title_font_size_unit ) {
			?>
			font-size: <?php echo $settings->form_title_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->form_title_font_size_unit ) && '' == $settings->form_title_font_size_unit && isset( $settings->form_title_font_size['desktop'] ) && '' != $settings->form_title_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->form_title_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->form_title_font_size['desktop'] ) && '' == $settings->form_title_font_size['desktop'] && isset( $settings->form_title_line_height['desktop'] ) && '' != $settings->form_title_line_height['desktop'] && '' == $settings->form_title_line_height_unit ) { ?>
			line-height: <?php echo $settings->form_title_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->form_title_line_height_unit ) && '' != $settings->form_title_line_height_unit ) { ?>
			line-height: <?php echo $settings->form_title_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->form_title_line_height_unit ) && '' == $settings->form_title_line_height_unit && isset( $settings->form_title_line_height['desktop'] ) && '' != $settings->form_title_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->form_title_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->form_title_transform ) : ?>
			text-transform: <?php echo $settings->form_title_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->form_title_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->form_title_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_title_typo',
				'selector'     => ".fl-node-$id .uabb-cf7-style .uabb-cf7-form-title",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {
	<?php if ( '' != $settings->form_desc_color ) : ?>
		color: <?php echo $settings->form_desc_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->form_text_align; ?>;

	margin: 0 0 <?php echo ( '' != $settings->form_desc_bottom_margin ) ? $settings->form_desc_bottom_margin : '20'; ?>px;
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {
		<?php if ( 'Default' != $settings->form_desc_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->form_desc_font_family ); ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->form_desc_font_size_unit ) && '' != $settings->form_desc_font_size_unit ) {
			?>
			font-size: <?php echo $settings->form_desc_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->form_desc_font_size_unit ) && '' == $settings->form_desc_font_size_unit && isset( $settings->form_desc_font_size['desktop'] ) && '' != $settings->form_desc_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->form_desc_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->form_desc_font_size['desktop'] ) && '' == $settings->form_desc_font_size['desktop'] && isset( $settings->form_desc_line_height['desktop'] ) && '' != $settings->form_desc_line_height['desktop'] && '' == $settings->form_desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->form_desc_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->form_desc_line_height_unit ) && '' != $settings->form_desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->form_desc_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->form_desc_line_height_unit ) && '' == $settings->form_desc_line_height_unit && isset( $settings->form_desc_line_height['desktop'] ) && '' != $settings->form_desc_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->form_desc_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->form_desc_transform ) : ?>
			text-transform: <?php echo $settings->form_desc_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->form_desc_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->form_desc_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_desc_typo',
				'selector'     => ".fl-node-$id .uabb-cf7-style .uabb-cf7-form-desc",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
	.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
	.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea {

		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>
			font-size: <?php echo $settings->font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
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
				'setting_name' => 'form_input_typo',
				'selector'     => ".fl-node-$id .uabb-cf7-style input[type=tel], .fl-node-$id .uabb-cf7-style input[type=email], .fl-node-$id .uabb-cf7-style input[type=text], .fl-node-$id .uabb-cf7-style input[type=url], .fl-node-$id .uabb-cf7-style input[type=number], .fl-node-$id .uabb-cf7-style input[type=date], .fl-node-$id .uabb-cf7-style select, .fl-node-$id .uabb-cf7-style textarea",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
		<?php $uabb_theme_btn_family = apply_filters( 'uabb/theme/button_font_family', '' ); ?>

		<?php if ( '' != uabb_theme_button_letter_spacing( '' ) ) { ?>
		letter-spacing: <?php echo uabb_theme_button_letter_spacing( '' ); ?>;
		<?php } ?>

		<?php if ( 'none' != $settings->btn_text_transform ) : ?>
			text-transform: <?php echo $settings->btn_text_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->btn_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->btn_letter_spacing; ?>;
		<?php endif; ?>

		<?php if ( '' != uabb_theme_button_text_transform( '' ) ) { ?>
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

		<?php
		if ( 'yes' === $converted || isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) {
			?>
			font-size: <?php echo $settings->btn_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->btn_font_size_unit ) && '' == $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->btn_font_size_unit; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->btn_font_size['desktop'] ) && '' == $settings->btn_font_size['desktop'] && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] && '' == $settings->btn_line_height_unit ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit ) && '' != $settings->btn_line_height_unit ) { ?>
		line-height: <?php echo $settings->btn_line_height_unit; ?>em;
		<?php } else { ?>
				<?php if ( '' != uabb_theme_button_line_height( '' ) ) { ?>
					line-height: <?php echo uabb_theme_button_line_height( '' ); ?>;
				<?php } ?>
		<?php } ?>

		<?php if ( 'yes' != $converted && isset( $settings->btn_line_height_unit ) && '' == $settings->btn_line_height_unit && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>
	}
	<?php
} else {

	if ( 'default' === $settings->btn_style ) {

		$form_button_typo  = uabb_theme_button_typography( $settings->form_button_typo );

		$settings->form_button_typo            = ( array_key_exists( 'desktop', $form_button_typo ) ) ? $form_button_typo['desktop'] : $settings->form_button_typo;
		$settings->form_button_typo_medium     = ( array_key_exists( 'tablet', $form_button_typo ) ) ? $form_button_typo['tablet'] : $settings->form_button_typo_medium;
		$settings->form_button_typo_responsive = ( array_key_exists( 'mobile', $form_button_typo ) ) ? $form_button_typo['mobile'] : $settings->form_button_typo_responsive;
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_button_typo',
				'selector'     => ".fl-node-$id .uabb-cf7-style input[type=submit]",
			)
		);
	}
}
?>

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7 form.wpcf7-form:not(input) {
	<?php if ( '' != $settings->label_color ) : ?>
		color: <?php echo $settings->label_color; ?>;
	<?php endif; ?>

	text-align: <?php echo $settings->input_text_align; ?>;
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7 form.wpcf7-form:not(input) {
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
		<?php } elseif ( isset( $settings->label_line_height_unit ) && '' == $settings->label_line_height_unit && isset( $settings->label_line_height['desktop'] ) && '' != $settings->label_line_height['desktop'] ) { ?>
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
				'setting_name' => 'form_label_typo',
				'selector'     => ".fl-builder-content .fl-node-$id .uabb-cf7-style .wpcf7 form.wpcf7-form:not(input)",
			)
		);
	}
}
?>

/* Error Styling */

.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-not-valid-tip {
	color: <?php echo $settings->input_msg_color; ?>;
	font-size: <?php echo $settings->input_msg_font_size; ?>px;

	<?php if ( 'none' != $settings->input_msg_transform ) : ?>
		text-transform: <?php echo $settings->input_msg_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->input_msg_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->input_msg_letter_spacing; ?>px;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-response-output {

		<?php if ( '' != $settings->validation_border_type ) { ?>
			<?php $settings->validation_border_width = '' != $settings->validation_border_width ? $settings->validation_border_width : '1'; ?>
				border: <?php echo $settings->validation_border_type . ' ' . $settings->validation_border_width . 'px ' . $settings->validation_border_color . ';'; ?>
		<?php } else { ?>
			border: none;
		<?php } ?>

		border-radius: <?php echo $settings->validation_border_radius; ?>px;
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'validation_border',
					'selector'     => ".fl-node-$id .uabb-cf7-style .wpcf7-response-output",
				)
			);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-response-output {
	color: <?php echo $settings->validation_msg_color; ?>;
	font-size: <?php echo $settings->validation_msg_font_size; ?>px;

	<?php if ( 'none' != $settings->validate_transform ) : ?>
		text-transform: <?php echo $settings->validate_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->validate_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->validate_letter_spacing; ?>px;
	<?php endif; ?>

	background: <?php echo $settings->validation_bg_color; ?>;

	<?php
	if ( 'yes' === $converted || isset( $settings->validation_spacing_dimension_top ) && isset( $settings->validation_spacing_dimension_bottom ) && isset( $settings->validation_spacing_dimension_left ) && isset( $settings->validation_spacing_dimension_right ) ) {
		if ( isset( $settings->validation_spacing_dimension_top ) ) {
			echo ( '' != $settings->validation_spacing_dimension_top ) ? 'padding-top:' . $settings->validation_spacing_dimension_top . 'px;' : 'padding-top: 10px;';
		}
		if ( isset( $settings->validation_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->validation_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->validation_spacing_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
		}
		if ( isset( $settings->validation_spacing_dimension_left ) ) {
			echo ( '' != $settings->validation_spacing_dimension_left ) ? 'padding-left:' . $settings->validation_spacing_dimension_left . 'px;' : 'padding-left: 10px;';
		}
		if ( isset( $settings->validation_spacing_dimension_right ) ) {
			echo ( '' != $settings->validation_spacing_dimension_right ) ? 'padding-right:' . $settings->validation_spacing_dimension_right . 'px;' : 'padding-right: 10px;';
		}
	} elseif ( isset( $settings->validation_spacing ) && '' != $settings->validation_spacing && isset( $settings->validation_spacing_dimension_top ) && '' == $settings->validation_spacing_dimension_top && isset( $settings->validation_spacing_dimension_bottom ) && '' == $settings->validation_spacing_dimension_bottom && isset( $settings->validation_spacing_dimension_left ) && '' == $settings->validation_spacing_dimension_left && isset( $settings->validation_spacing_dimension_right ) && '' == $settings->validation_spacing_dimension_right ) {
		echo $settings->validation_spacing;
		?>
		;
	<?php } ?>
}

/* Typography responsive css */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>

	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {

				<?php if ( 'yes' === $converted || isset( $settings->form_title_font_size_unit_medium ) && '' != $settings->form_title_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->form_title_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->form_title_font_size_unit_medium ) && '' == $settings->form_title_font_size_unit_medium && isset( $settings->form_title_font_size['medium'] ) && '' != $settings->form_title_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->form_title_font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_title_font_size['medium'] ) && '' == $settings->form_title_font_size['medium'] && isset( $settings->form_title_line_height['medium'] ) && '' != $settings->form_title_line_height['medium'] && '' == $settings->form_title_line_height_unit && '' == $settings->form_title_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->form_title_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->form_title_line_height_unit_medium ) && '' != $settings->form_title_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->form_title_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->form_title_line_height_unit_medium ) && '' == $settings->form_title_line_height_unit_medium && isset( $settings->form_title_line_height['medium'] ) && '' != $settings->form_title_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->form_title_line_height['medium']; ?>px;
				<?php } ?>
			}

			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span,
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
				<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>
					<?php if ( isset( $settings->radio_checkbox_font_size_unit_medium ) && '' != $settings->radio_checkbox_font_size_unit_medium ) : ?>
						font-size: <?php echo $settings->radio_checkbox_font_size_unit_medium; ?>px;
					<?php endif; ?>
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {

				<?php if ( 'yes' === $converted || isset( $settings->form_desc_font_size_unit_medium ) && '' != $settings->form_desc_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->form_desc_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->form_desc_font_size_unit_medium ) && '' == $settings->form_desc_font_size_unit_medium && isset( $settings->form_desc_font_size['medium'] ) && '' != $settings->form_desc_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->form_desc_font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_desc_font_size['medium'] ) && '' == $settings->form_desc_font_size['medium'] && isset( $settings->form_desc_line_height['medium'] ) && '' != $settings->form_desc_line_height['medium'] && '' == $settings->form_desc_line_height_unit && '' == $settings->form_desc_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->form_desc_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->form_desc_line_height_unit_medium ) && '' != $settings->form_desc_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->form_desc_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->form_desc_line_height_unit_medium ) && '' == $settings->form_desc_line_height_unit_medium && isset( $settings->form_desc_line_height['medium'] ) && '' != $settings->form_desc_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->form_desc_line_height['medium']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
					font-size: <?php echo $settings->font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->font_size_unit['medium'] ) && '' == $settings->font_size_unit['medium'] && isset( $settings->line_height_unit['medium'] ) && '' != $settings->line_height_unit['medium'] && '' == $settings->line_height_unit_unit && '' == $settings->line_height_unit_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height_unit['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
					line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {

				<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_medium ) && '' != $settings->btn_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->btn_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->btn_font_size_unit_medium ) && '' == $settings->btn_font_size_unit_medium && isset( $settings->btn_font_size['medium'] ) && '' != $settings->btn_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->btn_font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_font_size['medium'] ) && '' == $settings->btn_font_size['medium'] && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] && '' == $settings->btn_line_height_unit && '' == $settings->btn_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_medium ) && '' != $settings->btn_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->btn_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->btn_line_height_unit_medium ) && '' == $settings->btn_line_height_unit_medium && isset( $settings->btn_line_height['medium'] ) && '' != $settings->btn_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->btn_line_height['medium']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style form:not(input) {

				<?php if ( 'yes' === $converted || isset( $settings->label_font_size_unit_medium ) && '' != $settings->label_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->label_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->label_font_size_unit_medium ) && '' == $settings->label_font_size_unit_medium && isset( $settings->label_font_size['medium'] ) && '' != $settings->label_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->label_font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->label_font_size['medium'] ) && '' == $settings->label_font_size['medium'] && isset( $settings->label_line_height['medium'] ) && '' != $settings->label_line_height['medium'] && '' == $settings->label_line_height_unit && '' == $settings->label_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->label_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->label_line_height_unit_medium ) && '' != $settings->label_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->label_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->label_line_height_unit_medium ) && '' == $settings->label_line_height_unit_medium && isset( $settings->label_line_height['medium'] ) && '' != $settings->label_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->label_line_height['medium']; ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( 'default' == $settings->btn_style ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
				<?php 
				if ( isset( $settings->button_padding_dimension_top_medium ) ) {
					echo ( '' != $settings->button_padding_dimension_top_medium ) ? 'padding-top:' . $settings->button_padding_dimension_top_medium . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'tablet', 'top' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_bottom_medium ) ) {
					echo ( '' != $settings->button_padding_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom_medium . 'px;' : 'padding-bottom:' . uabb_theme_padding_button( 'tablet', 'bottom' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_left_medium ) ) {
					echo ( '' != $settings->button_padding_dimension_left_medium ) ? 'padding-left:' . $settings->button_padding_dimension_left_medium . 'px;' : 'padding-left:' . uabb_theme_padding_button( 'tablet', 'left' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_right_medium ) ) {
					echo ( '' != $settings->button_padding_dimension_right_medium ) ? 'padding-right:' . $settings->button_padding_dimension_right_medium . 'px;' : 'padding-right:' .  uabb_theme_padding_button( 'tablet', 'right' ) . ';';
				} 
				if ( isset( $settings->btn_background_color ) ) {
					echo ( '' != $settings->btn_background_color ) ? 'background:' . $settings->btn_background_color . ';' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-response-output {
			<?php
			if ( isset( $settings->validation_spacing_dimension_top_medium ) ) {
				echo ( '' != $settings->validation_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->validation_spacing_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_bottom_medium ) ) {
				echo ( '' != $settings->validation_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->validation_spacing_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_left_medium ) ) {
				echo ( '' != $settings->validation_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->validation_spacing_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_right_medium ) ) {
				echo ( '' != $settings->validation_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->validation_spacing_dimension_right_medium . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-cf7-style {
			<?php
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
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=tel],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=email],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=text],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=url],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=number],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=date],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form select,
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form textarea {
			<?php
			if ( isset( $settings->input_padding_dimension_top_medium ) ) {
				echo ( '' != $settings->input_padding_dimension_top_medium ) ? 'padding-top:' . $settings->input_padding_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_bottom_medium ) ) {
				echo ( '' != $settings->input_padding_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->input_padding_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_left_medium ) ) {
				echo ( '' != $settings->input_padding_dimension_left_medium ) ? 'padding-left:' . $settings->input_padding_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_right_medium ) ) {
				echo ( '' != $settings->input_padding_dimension_right_medium ) ? 'padding-right:' . $settings->input_padding_dimension_right_medium . 'px;' : '';
			}
			?>
		}

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
				<?php
				if ( isset( $settings->input_border_width_dimension_top_medium ) ) {
					echo ( '' != $settings->input_border_width_dimension_top_medium ) ? 'border-top-width:' . $settings->input_border_width_dimension_top_medium . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_bottom_medium ) ) {
					echo ( '' != $settings->input_border_width_dimension_bottom_medium ) ? 'border-bottom-width:' . $settings->input_border_width_dimension_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_left_medium ) ) {
					echo ( '' != $settings->input_border_width_dimension_left_medium ) ? 'border-left-width:' . $settings->input_border_width_dimension_left_medium . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_right_medium ) ) {
					echo ( '' != $settings->input_border_width_dimension_right_medium ) ? 'border-right-width:' . $settings->input_border_width_dimension_right_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
	}

	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-title {

				<?php if ( 'yes' === $converted || isset( $settings->form_title_font_size_unit_responsive ) && '' != $settings->form_title_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->form_title_font_size_unit_responsive; ?>px;
				<?php } elseif ( isset( $settings->form_title_font_size_unit_responsive ) && '' == $settings->form_title_font_size_unit_responsive && isset( $settings->form_title_font_size['small'] ) && '' != $settings->form_title_font_size['small'] ) { ?>
					font-size: <?php echo $settings->form_title_font_size['small']; ?>px;
				<?php } ?>
				<?php if ( isset( $settings->form_title_font_size['small'] ) && '' == $settings->form_title_font_size['small'] && isset( $settings->form_title_line_height['small'] ) && '' != $settings->form_title_line_height['small'] && '' == $settings->form_title_line_height_unit_responsive && '' == $settings->form_title_line_height_unit_medium && '' == $settings->form_title_line_height_unit ) { ?>
						line-height: <?php echo $settings->form_title_line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->form_title_line_height_unit_responsive ) && '' != $settings->form_title_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->form_title_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->form_title_line_height_unit_responsive ) && '' == $settings->form_title_line_height_unit_responsive && isset( $settings->form_title_line_height['small'] ) && '' != $settings->form_title_line_height['small'] ) { ?>
					line-height: <?php echo $settings->form_title_line_height['small']; ?>px;
				<?php } ?>
			}

			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-checkbox input[type='checkbox'] + span,
			.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-radio input[type='radio'] + span {
				<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>

					<?php if ( isset( $settings->radio_checkbox_font_size_unit_responsive ) && '' != $settings->radio_checkbox_font_size_unit_responsive ) : ?>
						font-size: <?php echo $settings->radio_checkbox_font_size_unit_responsive; ?>px;
					<?php endif; ?>

				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style .uabb-cf7-form-desc {

				<?php if ( 'yes' === $converted || isset( $settings->form_desc_font_size_unit_responsive ) && '' != $settings->form_desc_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->form_desc_font_size_unit_responsive; ?>px;
				<?php } elseif ( isset( $settings->form_desc_font_size_unit_responsive ) && '' == $settings->form_desc_font_size_unit_responsive && isset( $settings->form_desc_font_size['small'] ) && '' != $settings->form_desc_font_size['small'] ) { ?>
					font-size: <?php echo $settings->form_desc_font_size['small']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->form_desc_font_size['small'] ) && '' == $settings->form_desc_font_size['small'] && isset( $settings->form_desc_line_height['small'] ) && '' != $settings->form_desc_line_height['small'] && '' == $settings->form_desc_line_height_unit_responsive && '' == $settings->form_desc_line_height_unit_medium && '' == $settings->form_desc_line_height_unit ) { ?>
						line-height: <?php echo $settings->form_desc_line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->form_desc_line_height_unit_responsive ) && '' != $settings->form_desc_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->form_desc_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->form_desc_line_height_unit_responsive ) && '' == $settings->form_desc_line_height_unit_responsive && isset( $settings->form_desc_line_height['small'] ) && '' != $settings->form_desc_line_height['small'] ) { ?>
					line-height: <?php echo $settings->form_desc_line_height['small']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-contact-form textarea {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
				<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
					font-size: <?php echo $settings->font_size['small']; ?>px;
				<?php } ?>
				<?php if ( isset( $settings->font_size['small'] ) && '' == $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
						line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
					line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {

				<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit_responsive ) && '' != $settings->btn_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->btn_font_size_unit_responsive; ?>px;
				<?php } elseif ( isset( $settings->btn_font_size_unit_responsive ) && '' == $settings->btn_font_size_unit_responsive && isset( $settings->btn_font_size['small'] ) && '' != $settings->btn_font_size['small'] ) { ?>
					font-size: <?php echo $settings->btn_font_size['small']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->btn_font_size['small'] ) && '' == $settings->btn_font_size['small'] && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] && '' == $settings->btn_line_height_unit_responsive && '' == $settings->btn_line_height_unit_medium && '' == $settings->btn_line_height_unit ) { ?>
						line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->btn_line_height_unit_responsive ) && '' != $settings->btn_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->btn_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->btn_line_height_unit_responsive ) && '' == $settings->btn_line_height_unit_responsive && isset( $settings->btn_line_height['small'] ) && '' != $settings->btn_line_height['small'] ) { ?>
					line-height: <?php echo $settings->btn_line_height['small']; ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-cf7-style form:not(input) {

				<?php if ( 'yes' === $converted || isset( $settings->label_font_size_unit_responsive ) && '' != $settings->label_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->label_font_size_unit_responsive; ?>px;
				<?php } elseif ( isset( $settings->label_font_size_unit_responsive ) && '' == $settings->label_font_size_unit_responsive && isset( $settings->label_font_size['small'] ) && '' != $settings->label_font_size['small'] ) { ?>
					font-size: <?php echo $settings->label_font_size['small']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->label_font_size['small'] ) && '' == $settings->label_font_size['small'] && isset( $settings->label_line_height['small'] ) && '' != $settings->label_line_height['small'] && '' == $settings->label_line_height_unit_responsive && '' == $settings->label_line_height_unit_medium && '' == $settings->label_line_height_unit ) { ?>
						line-height: <?php echo $settings->label_line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->label_line_height_unit_responsive ) && '' != $settings->label_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->label_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->label_line_height_unit_responsive ) && '' == $settings->label_line_height_unit_responsive && isset( $settings->label_line_height['small'] ) && '' != $settings->label_line_height['small'] ) { ?>
					line-height: <?php echo $settings->label_line_height['small']; ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( 'default' == $settings->btn_style ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=submit] {
				<?php 
				if ( isset( $settings->button_padding_dimension_top_responsive ) ) {
					echo ( '' != $settings->button_padding_dimension_top_responsive ) ? 'padding-top:' . $settings->button_padding_dimension_top_responsive . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'mobile', 'top' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_bottom_responsive ) ) {
					echo ( '' != $settings->button_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom_responsive . 'px;' : 'padding-bottom:' . uabb_theme_padding_button( 'mobile', 'bottom' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_left_responsive ) ) {
					echo ( '' != $settings->button_padding_dimension_left_responsive ) ? 'padding-left:' . $settings->button_padding_dimension_left_responsive . 'px;' : 'padding-left:' . uabb_theme_padding_button( 'mobile', 'left' ) . ';';
				}
				if ( isset( $settings->button_padding_dimension_right_responsive ) ) {
					echo ( '' != $settings->button_padding_dimension_right_responsive ) ? 'padding-right:' . $settings->button_padding_dimension_right_responsive . 'px;' : 'padding-right:' .  uabb_theme_padding_button( 'mobile', 'right' ) . ';';
				} 
				if ( isset( $settings->btn_background_color ) ) {
					echo ( '' != $settings->btn_background_color ) ? 'background:' . $settings->btn_background_color . ';' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-cf7-style .wpcf7-response-output {
			<?php
			if ( isset( $settings->validation_spacing_dimension_top_responsive ) ) {
				echo ( '' != $settings->validation_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->validation_spacing_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->validation_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->validation_spacing_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_left_responsive ) ) {
				echo ( '' != $settings->validation_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->validation_spacing_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->validation_spacing_dimension_right_responsive ) ) {
				echo ( '' != $settings->validation_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->validation_spacing_dimension_right_responsive . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-cf7-style {
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

		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=tel],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=email],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=text],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=url],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=number],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form input[type=date],
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form select,
		.fl-node-<?php echo $id; ?> .uabb-cf7-style form textarea {
			<?php
			if ( isset( $settings->input_padding_dimension_top_responsive ) ) {
				echo ( '' != $settings->input_padding_dimension_top_responsive ) ? 'padding-top:' . $settings->input_padding_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->input_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->input_padding_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_left_responsive ) ) {
				echo ( '' != $settings->input_padding_dimension_left_responsive ) ? 'padding-left:' . $settings->input_padding_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->input_padding_dimension_right_responsive ) ) {
				echo ( '' != $settings->input_padding_dimension_right_responsive ) ? 'padding-right:' . $settings->input_padding_dimension_right_responsive . 'px;' : '';
			}
			?>
		}

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style select:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=tel]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=email]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=text]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=url]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=number]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style input[type=date]:focus,
			.fl-node-<?php echo $id; ?> .uabb-cf7-style textarea:focus {
				<?php
				if ( isset( $settings->input_border_width_dimension_top_responsive ) ) {
					echo ( '' != $settings->input_border_width_dimension_top_responsive ) ? 'border-top-width:' . $settings->input_border_width_dimension_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_bottom_responsive ) ) {
					echo ( '' != $settings->input_border_width_dimension_bottom_responsive ) ? 'border-bottom-width:' . $settings->input_border_width_dimension_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_left_responsive ) ) {
					echo ( '' != $settings->input_border_width_dimension_left_responsive ) ? 'border-left-width:' . $settings->input_border_width_dimension_left_responsive . 'px;' : '';
				}
				if ( isset( $settings->input_border_width_dimension_right_responsive ) ) {
					echo ( '' != $settings->input_border_width_dimension_right_responsive ) ? 'border-right-width:' . $settings->input_border_width_dimension_right_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>
	}
<?php } ?>
