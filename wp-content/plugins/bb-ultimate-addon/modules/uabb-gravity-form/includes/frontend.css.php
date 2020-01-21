<?php
/**
 *  UABB Gravity Form Module front-end CSS php file
 *
 *  @package UABB Gravity Form Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->form_bg_color          = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
$settings->input_background_color = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );

$settings->input_border_active_color = UABB_Helper::uabb_colorpicker( $settings, 'input_border_active_color' );

$settings->btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_color' );
$settings->btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_text_hover_color' );
$settings->btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_color', true );
$settings->btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'btn_background_hover_color', true );
$settings->radio_check_bgcolor = UABB_Helper::uabb_colorpicker( $settings, 'radio_check_bgcolor', true );

/* Typography Colors */

$settings->form_title_color = UABB_Helper::uabb_colorpicker( $settings, 'form_title_color' );
$settings->form_desc_color  = UABB_Helper::uabb_colorpicker( $settings, 'form_desc_color' );

$settings->label_color = UABB_Helper::uabb_colorpicker( $settings, 'label_color' );
/* Input Color */
$settings->color = UABB_Helper::uabb_colorpicker( $settings, 'color' );

$settings->input_msg_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_msg_color' );
$settings->validation_msg_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_msg_color' );
$settings->validation_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'validation_bg_color', true );

$settings->radio_check_size            = ( '' != $settings->radio_check_size ) ? $settings->radio_check_size : 20;
$settings->radio_check_border_width    = ( '' != $settings->radio_check_border_width ) ? $settings->radio_check_border_width : 1;
$settings->radio_btn_border_radius     = ( '' != $settings->radio_btn_border_radius ) ? $settings->radio_btn_border_radius : 50;
$settings->checkbox_border_radius      = ( '' != $settings->checkbox_border_radius ) ? $settings->checkbox_border_radius : 0;
$settings->input_msg_font_size         = ( '' != $settings->input_msg_font_size ) ? $settings->input_msg_font_size : 12;
$settings->input_success_msg_font_size = ( '' != $settings->input_success_msg_font_size ) ? $settings->input_success_msg_font_size : 15;
$settings->input_top_margin            = ( '' != $settings->input_top_margin ) ? $settings->input_top_margin : 10;
$settings->input_bottom_margin         = ( '' != $settings->input_bottom_margin ) ? $settings->input_bottom_margin : 15;

if ( ! $version_bb_check ) {
	$settings->input_border_color      = UABB_Helper::uabb_colorpicker( $settings, 'input_border_color' );
	$settings->validation_border_color = UABB_Helper::uabb_colorpicker( $settings, 'validation_border_color' );
}
?>
.fl-node-<?php echo $id; ?> {
	width: 100%;
}

/* Form Style */
.fl-node-<?php echo $id; ?> .uabb-gf-style {

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

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper form .gform_body input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .gform_wrapper textarea,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container select,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {

	<?php
	if ( 'yes' === $converted || isset( $settings->input_padding_dimension_top ) && isset( $settings->input_padding_dimension_bottom ) && isset( $settings->input_padding_dimension_left ) && isset( $settings->input_padding_dimension_right ) ) {
		if ( isset( $settings->input_padding_dimension_top ) ) {
			echo ( '' != $settings->input_padding_dimension_top ) ? 'padding-top:' . $settings->input_padding_dimension_top . 'px;' : 'padding-top: 15px;';
		}
		if ( isset( $settings->input_padding_dimension_bottom ) ) {
			echo ( '' != $settings->input_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->input_padding_dimension_bottom . 'px;' : 'padding-bottom: 15px;';
		}
		if ( isset( $settings->input_padding_dimension_left ) ) {
			echo ( '' != $settings->input_padding_dimension_left ) ? 'padding-left:' . $settings->input_padding_dimension_left . 'px;' : 'padding-left: 15px;';
		}
		if ( isset( $settings->input_padding_dimension_right ) ) {
			echo ( '' != $settings->input_padding_dimension_right ) ? 'padding-right:' . $settings->input_padding_dimension_right . 'px;' : 'padding-right: 15px;';
		}
	} elseif ( isset( $settings->input_padding ) && '' != $settings->input_padding && isset( $settings->input_padding_dimension_top ) && '' == $settings->input_padding_dimension_top && isset( $settings->input_padding_dimension_bottom ) && '' == $settings->input_padding_dimension_bottom && isset( $settings->input_padding_dimension_left ) && '' == $settings->input_padding_dimension_left && isset( $settings->input_padding_dimension_right ) && '' == $settings->input_padding_dimension_right ) {
		$settings->input_padding = ( isset( $settings->input_padding ) && '' != $settings->input_padding ) ? $settings->input_padding : 15;
		echo $settings->input_padding;
		?>
		;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel],
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email],
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text],
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url],
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number],
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date],
	.fl-node-<?php echo $id; ?> .uabb-gf-style select,
	.fl-node-<?php echo $id; ?> .uabb-gf-style textarea,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style select:focus,
	.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:focus,
	.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single,
	.fl-node-<?php echo $id; ?> .chosen-container .chosen-container-single .chosen-container-active .chosen-with-drop,
	.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-active.chosen-with-drop .chosen-single,
	.fl-node-<?php echo $id; ?> .gform_wrapper .chosen-container .chosen-drop {
		<?php if ( isset( $settings->input_border_radius ) ) { ?>
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
		} elseif ( isset( $settings->uabb_input_border_width ) && is_array( $settings->uabb_input_border_width ) && isset( $settings->input_border_width_dimension_top ) && '' == $settings->input_border_width_dimension_top && isset( $settings->input_border_width_dimension_bottom ) && '' == $settings->input_border_width_dimension_bottom && isset( $settings->input_border_width_dimension_left ) && '' == $settings->input_border_width_dimension_left && isset( $settings->input_border_width_dimension_right ) && '' == $settings->input_border_width_dimension_right ) {
			?>
			<?php
				$str = '0;';
			if ( is_array( $settings->uabb_input_border_width ) ) {
				if ( 'collapse' == $settings->uabb_input_border_width['simplify'] ) {
					$str = ( '' != $settings->uabb_input_border_width['all'] ) ? $settings->uabb_input_border_width['all'] . 'px;' : '1;';
				} else {
					$str  = ( '' != $settings->uabb_input_border_width['top'] ) ? $settings->uabb_input_border_width['top'] . 'px ' : '1 ';
					$str .= ( '' != $settings->uabb_input_border_width['right'] ) ? $settings->uabb_input_border_width['right'] . 'px ' : '1 ';
					$str .= ( '' != $settings->uabb_input_border_width['bottom'] ) ? $settings->uabb_input_border_width['bottom'] . 'px ' : '1 ';
					$str .= ( '' != $settings->uabb_input_border_width['left'] ) ? $settings->uabb_input_border_width['left'] . 'px ' : '1;';
				}
			}
			?>
				border-width: <?php echo $str; ?>
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'input_border',
					'selector'     => ".fl-node-$id .uabb-gf-style input[type=tel], .fl-node-$id .uabb-gf-style input[type=email], .fl-node-$id .uabb-gf-style input[type=text], .fl-node-$id .uabb-gf-style input[type=url], .fl-node-$id .uabb-gf-style input[type=number], .fl-node-$id .uabb-gf-style input[type=date],
    .fl-node-$id .uabb-gf-style select, .fl-node-$id .uabb-gf-style textarea, .fl-node-$id .uabb-gf-style select:focus,
    .fl-node-$id .uabb-gf-style textarea:focus, .fl-node-$id .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single, .fl-node-$id .chosen-container .chosen-container-single .chosen-container-active .chosen-with-drop, .fl-node-$id .gform_wrapper .ginput_container_select .chosen-container-active.chosen-with-drop .chosen-single, .fl-node-$id .gform_wrapper .chosen-container .chosen-drop",
				)
			);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-gf-style select,
.fl-node-<?php echo $id; ?> .uabb-gf-style textarea,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style select:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:focus,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single,
.fl-node-<?php echo $id; ?> .chosen-container .chosen-container-single .chosen-container-active .chosen-with-drop,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-active.chosen-with-drop .chosen-single,
.fl-node-<?php echo $id; ?> .gform_wrapper .chosen-container .chosen-drop {

	outline: none;

	line-height: 1.3;

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

<?php if ( '' != $settings->input_border_active_color ) { ?>
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style select:focus,
.fl-node-<?php echo $id; ?> .uabb-gf-style select:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:focus,
.fl-node-<?php echo $id; ?> .gform_wrapper .chosen-container-active.chosen-with-drop .chosen-single,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-active.chosen-with-drop .chosen-single {
	border-color: <?php echo $settings->input_border_active_color; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .gfield_description {

	<?php if ( $settings->input_description_color ) { ?>
		color: #<?php echo $settings->input_description_color; ?>;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .gfield_description {

		<?php $settings->input_desc_font_size = ( '' != $settings->input_desc_font_size ) ? $settings->input_desc_font_size : 12; ?>

		<?php if ( $settings->input_desc_font_size ) { ?>
			font-size: <?php echo $settings->input_desc_font_size; ?>px;
		<?php } ?>

		<?php if ( $settings->input_desc_line_height ) { ?>
			line-height: <?php echo $settings->input_desc_line_height; ?>px;
		<?php } ?>

		<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'none' != $settings->input_desc_transform ) : ?>
			text-transform: <?php echo $settings->input_desc_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->input_desc_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->input_desc_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_input_desc_typo',
				'selector'     => ".fl-node-$id .gform_wrapper .gfield .gfield_description",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container span label {
	<?php if ( $settings->label_color ) { ?>
		color: <?php echo $settings->label_color; ?>;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container span label {

		<?php if ( 'Default' != $settings->label_font_family['family'] ) { ?>
			<?php FLBuilderFonts::font_css( $settings->label_font_family ); ?>
		<?php } ?>
	}
<?php } else { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container span label {

		<?php if ( isset( $settings->form_label_font_typo['font_family'] ) && isset( $settings->form_label_font_typo['font_weight'] ) ) { ?>
			font-family: <?php echo $settings->form_label_font_typo['font_family']; ?>;
			font-weight: <?php echo $settings->form_label_font_typo['font_weight']; ?>;
		<?php } ?>
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_checkbox .gfield_checkbox li, 
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_radio .gfield_radio li {
	<?php if ( $settings->input_text_align ) { ?>
		text-align: <?php echo $settings->input_text_align; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_radio li label, 
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_checkbox li label {

	<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>
		<?php if ( $settings->radio_checkbox_color ) { ?>
			color: #<?php echo $settings->radio_checkbox_color; ?>;
			<?php
}
} elseif ( 'false' == $settings->radio_check_custom_option ) {
	?>
		<?php if ( '' != $settings->label_color ) : ?>
			color: <?php echo $settings->label_color; ?>;
			<?php
		endif;
}
?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_radio li label, 
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_checkbox li label {

		<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>
			<?php if ( 'Default' != $settings->radio_checkbox_font_family['family'] ) { ?>
				<?php FLBuilderFonts::font_css( $settings->radio_checkbox_font_family ); ?>
			<?php } ?>

			<?php if ( isset( $settings->radio_checkbox_font_size_unit ) && '' != $settings->radio_checkbox_font_size_unit ) : ?>
				font-size: <?php echo $settings->radio_checkbox_font_size_unit; ?>px;
			<?php endif; ?>

		<?php } elseif ( 'false' == $settings->radio_check_custom_option ) { ?>     

			<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
			<?php endif; ?>

		<?php } ?>

		<?php if ( '' != $settings->radio_checkbox_transform ) : ?>
			text-transform: <?php echo $settings->radio_checkbox_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->radio_checkbox_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->radio_checkbox_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'radio_input_typo',
				'selector'     => ".fl-node-$id .uabb-gf-style .gform_wrapper .gfield_radio li label, .fl-node-$id .uabb-gf-style .gform_wrapper .gfield_checkbox li label",
			)
		);
	}
}
?>

<?php
if ( 'true' == $settings->radio_check_custom_option ) {
	$font_size = $settings->radio_check_size / 1.3;
	?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_checkbox .gfield_checkbox input[type='checkbox'], 
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_radio .gfield_radio input[type='radio'] {
		display: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_checkbox .gfield_checkbox input[type='checkbox'] + label:before,
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_radio .gfield_radio input[type='radio'] + label:before {
		content: '';
		background: <?php echo $settings->radio_check_bgcolor; ?>;
		border: <?php echo $settings->radio_check_border_width; ?>px solid #<?php echo $settings->radio_check_border_color; ?>;
		display: inline-block;
		vertical-align: middle;
		width: <?php echo $settings->radio_check_size; ?>px;
		height: <?php echo $settings->radio_check_size; ?>px;
		padding: 2px;
		margin-right: 10px;
		text-align: center;
	}

	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_checkbox .gfield_checkbox input[type='checkbox']:checked + label:before {
		content: "\2714";
		font-weight: bold;
		font-size: calc(<?php echo $font_size; ?>px - <?php echo $settings->radio_check_border_width; ?>px );
		padding-top: 0;
		color: #<?php echo $settings->radio_check_selected_color; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_checkbox .gfield_checkbox input[type='checkbox'] + label:before {
		border-radius: <?php echo $settings->checkbox_border_radius; ?>px;
	}

	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_radio .gfield_radio input[type='radio']:checked + label:before {
		background: #<?php echo $settings->radio_check_selected_color; ?>;
		box-shadow: inset 0px 0px 0px 4px <?php echo $settings->radio_check_bgcolor; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_body .ginput_container_radio .gfield_radio input[type='radio'] + label:before {
		border-radius: <?php echo $settings->radio_btn_border_radius; ?>px;
	}

	<?php
}
?>


<?php
/* Placeholder Colors  */
if ( $settings->placeholder_color && 'block' == $settings->input_placeholder_display ) {
	?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-webkit-input-placeholder,
	.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single, 
	.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select select {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-moz-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-moz-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-ms-input-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-webkit-input-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-moz-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-moz-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-ms-input-placeholder {
		color: #<?php echo $settings->placeholder_color; ?>;
	}
<?php } ?>

<?php if ( 'none' == $settings->input_placeholder_display ) { ?>
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-webkit-input-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-moz-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input::-moz-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:-ms-input-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-webkit-input-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-moz-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea::-moz-placeholder {
	color: transparent;
	opacity: 0;
}
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea:-ms-input-placeholder {
	color: transparent;
	opacity: 0;
}
<?php } ?>


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

$bg_grad_start       = '';
$bg_hover_grad_start = '';
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
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {
		<?php 
		if ( isset( $settings->button_padding_dimension_top ) ) {
			echo ( '' != $settings->button_padding_dimension_top ) ? 'padding-top:' . $settings->button_padding_dimension_top . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'desktop', 'top' ) . ';';
		}
		if ( isset( $settings->button_padding_dimension_bottom ) ) {
			echo ( '' != $settings->button_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom . 'px;' : 'padding-bottom:' .uabb_theme_padding_button( 'desktop', 'bottom' ) . ';';
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
		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {
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
					'selector'     => ".fl-node-$id .uabb-gf-style .gform_wrapper .gform_footer input[type=submit], .fl-node-$id .uabb-gf-style .gform_page .gform_page_footer input[type=button],.fl-node-$id .uabb-gf-style .gform_page .gform_page_footer input[type=submit]",
				)
			);
		}
	} ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit]:hover,
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button]:hover,
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit]:hover {
		<?php echo ( '' != $settings->border_hover_color ) ? 'border-color:#' . $settings->border_hover_color . ';' : 'border-color:' . uabb_theme_border_hover_color( '' ) . ';'; ?>
		<?php echo ( '' != $settings->btn_text_hover_color ) ? 'color:' . $settings->btn_text_hover_color . ';' : ''; ?>
		<?php echo ( '' != $settings->btn_background_hover_color ) ? 'background:' . $settings->btn_background_hover_color . ';' : ''; ?>
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer {
	text-align: <?php echo $settings->btn_align; ?>;
	<?php if ( 'none' == $settings->typo_show_label ) { ?>
		margin: 0;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {

	<?php if ( '' != $settings->btn_border_radius ) { ?>
		border-radius: <?php echo $settings->btn_border_radius; ?>px;
	<?php } ?>

	<?php if ( 'flat' == $settings->btn_style ) { ?>
		background: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
		border-color: <?php echo uabb_theme_base_color( $settings->btn_background_color ); ?>;
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
		<?php echo uabb_theme_padding_css_genreated( 'desktop' ); ?>;
		width:100%;
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

	<?php } ?>

}

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit]:hover,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button]:hover,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit]:hover {
	<?php if ( 'flat' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>

		<?php if ( '' != $settings->btn_background_hover_color ) { ?>
		background: <?php echo $settings->btn_background_hover_color; ?>;
		border-color: <?php echo $settings->btn_background_hover_color; ?>;
		<?php } ?>
	<?php } elseif ( 'transparent' == $settings->btn_style ) { ?>
		<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		border-style: solid;
		border-width: <?php echo $settings->btn_border_width; ?>px;
			<?php
}
if ( 'border' == $settings->hover_attribute ) {
	?>
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
} else {
	?>
		background:<?php echo 'padding-box ' . uabb_theme_base_color( $border_hover_color ); ?>;
		border-color:<?php echo uabb_theme_base_color( $border_hover_color ); ?>;
		<?php
}
?>
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
	<?php if ( '' != $settings->btn_text_hover_color ) { ?>
		color: <?php echo $settings->btn_text_hover_color; ?>;
		<?php } ?>
		top: 2px;
		box-shadow: 0 4px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
		background: <?php echo uabb_theme_base_color( $settings->btn_background_hover_color ); ?>;
	<?php } ?>
}


.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button]:active,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit]:active {
	<?php if ( '3d' == $settings->btn_style ) { ?>
		top: 6px;
		box-shadow: 0 0px <?php echo uabb_theme_base_color( $shadow_color ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number],
.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date],
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield select,
.fl-node-<?php echo $id; ?> .uabb-gf-style textarea,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .ginput_container_checkbox,
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .ginput_container_radio,
.gform_wrapper .ginput_container_select .chosen-container-single {
	<?php if ( '' != $settings->input_top_margin ) { ?>
		margin-top:<?php echo $settings->input_top_margin; ?>px !important;
	<?php } ?>
	<?php if ( '' != $settings->input_bottom_margin ) { ?>
		margin-bottom:<?php echo $settings->input_bottom_margin; ?>px !important;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style .ginput_container_textarea textarea {
	<?php if ( '' != $settings->textarea_height ) { ?>
	height: <?php echo $settings->textarea_height; ?>px;
	<?php } ?>
}

/* Typography CSS */

.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-title {

	display: <?php echo ( 'none' == $settings->typo_show_title ) ? 'none' : 'block'; ?>;

	<?php if ( 'block' == $settings->typo_show_title ) { ?>
		<?php if ( '' != $settings->form_title_color ) : ?>
			color: <?php echo $settings->form_title_color; ?>;
		<?php endif; ?>

		text-align: <?php echo $settings->form_text_align; ?>;

		margin: 0 0 <?php echo ( '' != $settings->form_title_bottom_margin ) ? $settings->form_title_bottom_margin : '0'; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style p.uabb-gf-form-desc {

	display: <?php echo ( 'none' == $settings->typo_show_desc ) ? 'none' : 'block'; ?>;

	<?php if ( 'block' == $settings->typo_show_desc ) { ?>
		text-align: <?php echo $settings->form_text_align; ?>;

		<?php if ( '' != $settings->form_desc_color ) { ?>
			color: <?php echo $settings->form_desc_color; ?>;
		<?php } ?>

		margin: 0 0 <?php echo ( '' != $settings->form_desc_bottom_margin ) ? $settings->form_desc_bottom_margin : '20'; ?>px;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-title {

		display: <?php echo ( 'none' == $settings->typo_show_title ) ? 'none' : 'block'; ?>;

		<?php if ( 'block' == $settings->typo_show_title ) { ?>

			<?php if ( 'Default' != $settings->form_title_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->form_title_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->form_title_font_size_unit ) && '' != $settings->form_title_font_size_unit ) { ?>
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

		<?php } ?>
	}
<?php } else { ?>
	<?php
	if ( 'block' == $settings->typo_show_title ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'form_title_font_typo',
					'selector'     => ".fl-node-$id .uabb-gf-style .uabb-gf-form-title",
				)
			);
		}
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-desc {

		display: <?php echo ( 'none' == $settings->typo_show_desc ) ? 'none' : 'block'; ?>;

		<?php if ( 'block' == $settings->typo_show_desc ) { ?>

			<?php if ( 'Default' != $settings->form_desc_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->form_desc_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->form_desc_font_size_unit ) && '' != $settings->form_desc_font_size_unit ) { ?>
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

		<?php } ?>
	}
<?php } else { ?>
	<?php
	if ( 'block' == $settings->typo_show_desc ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'form_desc_font_typo',
					'selector'     => ".fl-node-$id .uabb-gf-style .uabb-gf-form-desc",
				)
			);
		}
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .gfield input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield input:focus,
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield select,
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield textarea,
	.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {

		<?php if ( 'Default' != $settings->font_family['family'] ) { ?>
			<?php FLBuilderFonts::font_css( $settings->font_family ); ?>
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>
			font-size: <?php echo $settings->font_size_unit; ?>px;   
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_input_typo',
				'selector'     => ".fl-node-$id .gfield input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']), .fl-node-$id .gform_wrapper .gfield input:focus, .fl-node-$id .gform_wrapper .gfield select, .fl-node-$id .gform_wrapper .gfield textarea, .fl-node-$id .ginput_container_select .chosen-container-single .chosen-single",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-gf-style input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .uabb-gf-style select,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {
	<?php if ( '' == $settings->input_field_height ) { ?>
		height: auto;
	<?php } else { ?>
		height: <?php echo $settings->input_field_height; ?>px
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {
	margin-right : 0;
	<?php if ( isset( $settings->btn_margin_top ) && '' != $settings->btn_margin_top ) { ?>
		margin-top: <?php echo $settings->btn_margin_top; ?>px;
	<?php } ?>

	<?php if ( isset( $settings->btn_margin_bottom ) && '' != $settings->btn_margin_bottom ) { ?>
		margin-bottom: <?php echo $settings->btn_margin_bottom; ?>px;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {

		<?php $uabb_theme_btn_family = apply_filters( 'uabb/theme/button_font_family', '' ); ?>

		<?php if ( '' != uabb_theme_button_letter_spacing( '' ) ) { ?>
			letter-spacing: <?php echo uabb_theme_button_letter_spacing( '' ); ?>;
		<?php } ?>

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

		<?php if ( 'yes' === $converted || isset( $settings->btn_font_size_unit ) && '' != $settings->btn_font_size_unit ) { ?>
			font-size: <?php echo $settings->btn_font_size_unit; ?>px; 
		<?php } else { ?>
				<?php if ( '' != uabb_theme_button_line_height( '' ) ) { ?>
					font-size: <?php echo uabb_theme_button_font_size( '' ); ?>;
				<?php } ?>
		<?php } ?>

		<?php if ( 'yes' !== $converted && isset( $settings->btn_font_size_unit ) && '' == $settings->btn_font_size_unit && isset( $settings->btn_font_size['desktop'] ) && '' != $settings->btn_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->btn_font_size['desktop']; ?>px;
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

		<?php if ( 'yes' !== $converted && isset( $settings->btn_line_height_unit ) && '' == $settings->btn_line_height_unit && isset( $settings->btn_line_height['desktop'] ) && '' != $settings->btn_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->btn_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->btn_text_transform ) : ?>
			text-transform: <?php echo $settings->btn_text_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->btn_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->btn_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if (  'default' === $settings->btn_style ) {
		
		$button_font_typo  = uabb_theme_button_typography( $settings->button_font_typo );

		$settings->button_font_typo            = ( array_key_exists( 'desktop', $button_font_typo ) ) ? $button_font_typo['desktop'] : $settings->button_font_typo;
		$settings->button_font_typo_medium     = ( array_key_exists( 'tablet', $button_font_typo ) ) ? $button_font_typo['tablet'] : $settings->button_font_typo_medium;
		$settings->button_font_typo_responsive = ( array_key_exists( 'mobile', $button_font_typo ) ) ? $button_font_typo['mobile'] : $settings->button_font_typo_responsive;
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_font_typo',
				'selector'     => ".fl-node-$id .uabb-gf-style .gform_wrapper .gform_footer input[type=submit], .fl-node-$id .uabb-gf-style .gform_page .gform_page_footer input[type=button], .fl-node-$id .uabb-gf-style .gform_page .gform_page_footer input[type=submit]",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-gf-style form .gform_body .gfield_label {
	display: <?php echo ( 'none' == $settings->typo_show_label ) ? 'none' : 'block'; ?>;

	<?php if ( 'block' == $settings->typo_show_label ) { ?>
		<?php if ( '' != $settings->label_color ) : ?>
			color: <?php echo $settings->label_color; ?>;
		<?php endif; ?>

		text-align: <?php echo $settings->input_text_align; ?>;
	<?php } ?>    
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style form .gform_body .gfield_label {

		display: <?php echo ( 'none' == $settings->typo_show_label ) ? 'none' : 'block'; ?>;

		<?php if ( 'block' == $settings->typo_show_label ) { ?>

			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
					<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
				<?php endif; ?>
			<?php } else { ?>
				<?php if ( isset( $settings->form_label_font_typo['font_family'] ) ) : ?>
					<?php UABB_Helper::uabb_font_css( $settings->form_label_font_typo['font_family'] ); ?>
				<?php endif; ?>
			<?php } ?>

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

		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_label_font_typo',
				'selector'     => ".fl-node-$id .uabb-gf-style form .gform_body .gfield_label",
			)
		);
	}
}
?>

<?php if ( 'none' == $settings->typo_show_label ) { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .gfield_description {
		margin-bottom: 20px;
	}
	.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container span label {
		display: <?php echo $settings->typo_show_label; ?>;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .validation_message {

	color: <?php echo $settings->input_msg_color; ?>;
	font-size: <?php echo $settings->input_msg_font_size; ?>px;

	<?php if ( 'none' != $settings->input_error_transform ) : ?>
		text-transform: <?php echo $settings->input_error_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->input_error_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->input_error_letter_spacing; ?>px;
	<?php endif; ?>
}

.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper div.validation_error {

	color: <?php echo $settings->validation_msg_color; ?>;

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

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper div.validation_error {

		<?php $settings->validation_msg_font_size = ( '' != $settings->validation_msg_font_size ) ? $settings->validation_msg_font_size : 15; ?>

		line-height: 1.5em;

		font-size: <?php echo $settings->validation_msg_font_size; ?>px;

		<?php if ( 'none' != $settings->validate_transform ) : ?>
			text-transform: <?php echo $settings->validate_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->validate_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->validate_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_valid_msg_desc_typo',
				'selector'     => ".fl-node-$id .uabb-gf-style .gform_wrapper div.validation_error",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper div.validation_error {
		<?php $settings->validation_border_width = ( '' != $settings->validation_border_width ) ? $settings->validation_border_width : 1; ?>
		<?php if ( '' != $settings->validation_border_type ) { ?>
			<?php $settings->validation_border_width = '' != $settings->validation_border_width ? $settings->validation_border_width : '2'; ?>
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
				'selector'     => ".fl-node-$id .uabb-gf-style .gform_wrapper div.validation_error",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .validation_error,
	.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error,
	.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning {

		<?php $settings->validation_border_width = ( '' != $settings->validation_border_width ) ? $settings->validation_border_width : 1; ?>

		border-top: <?php echo $settings->validation_border_type . ' ' . $settings->validation_border_width . 'px ' . $settings->validation_border_color . ';'; ?>

		border-bottom: <?php echo $settings->validation_border_type . ' ' . $settings->validation_border_width . 'px ' . $settings->validation_border_color . ';'; ?>

		<?php if ( ! isset( $settings->validation_border_color ) || empty( $settings->validation_border_color ) ) { ?>
			border: none;
			padding-top: 0;
			padding-bottom: 0;
		<?php } ?>
	}
<?php } else { ?>
	.fl-node-<?php echo $id; ?> .gform_wrapper .validation_error,
	.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error,
	.fl-node-<?php echo $id; ?> .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning {
			<?php if ( isset( $settings->validation_border['width']['top'] ) ) { ?>
				border-top: <?php echo $settings->validation_border['width']['top']; ?>
			<?php } ?>
			<?php if ( isset( $settings->validation_border['width']['bottom'] ) ) { ?>
				border-bottom: <?php echo $settings->validation_border['width']['bottom']; ?>
			<?php } ?>
		<?php if ( ! isset( $settings->validation_border['color'] ) || empty( $settings->validation_border['color'] ) ) { ?>
			border: none;
			padding-top: 0;
			padding-bottom: 0;
		<?php } ?>
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield.gfield_error .gfield_label {
	<?php if ( $settings->input_error_label_color && 'yes' == $settings->input_error_display ) { ?>
	color: #<?php echo $settings->input_error_label_color; ?>;
	<?php } ?>
	margin-left: 0;
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield.gfield_error {
	<?php if ( $settings->input_error_back_color && 'yes' == $settings->input_error_display ) { ?>
		background-color: <?php echo '#' . $settings->input_error_back_color; ?>;
		Width: 100%;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error .ginput_container select,
.fl-node-<?php echo $id; ?> .gform_wrapper .gfield_error .ginput_container textarea,
.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single { 
	<?php if ( $settings->input_error_border_color && 'yes' == $settings->input_error_display ) { ?>
		border-color: <?php echo '#' . $settings->input_error_border_color; ?>;
	<?php } ?>
	<?php if ( $settings->input_error_border_width >= 0 && 'yes' == $settings->input_error_display ) { ?>
		border-width: <?php echo $settings->input_error_border_width; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> #gform_confirmation_message_<?php echo $settings->form_id; ?> {
	font-family: inherit;
	margin-top: 10px;
	<?php if ( $settings->input_success_msg_color ) { ?>
		color: <?php echo '#' . $settings->input_success_msg_color; ?>;
	<?php } ?>
	<?php if ( '' != $settings->input_success_msg_font_size ) { ?>
		font-size: <?php echo $settings->input_success_msg_font_size; ?>px;
	<?php } ?>
	<?php if ( 'none' != $settings->input_success_msg_transform ) : ?>
		text-transform: <?php echo $settings->input_success_msg_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->input_success_msg_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->input_success_msg_letter_spacing; ?>px;
	<?php endif; ?>
}

/* Typography responsive css */
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_radio li label, 
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_checkbox li label {

				<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>

					<?php if ( 'Default' != $settings->radio_checkbox_font_family['family'] ) { ?>
						<?php FLBuilderFonts::font_css( $settings->radio_checkbox_font_family ); ?>
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->radio_checkbox_font_size_unit_medium ) && '' != $settings->radio_checkbox_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->radio_checkbox_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->radio_checkbox_font_size_unit_medium ) && '' == $settings->radio_checkbox_font_size_unit_medium && isset( $settings->radio_checkbox_font_size['medium'] ) && '' != $settings->radio_checkbox_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->radio_checkbox_font_size['medium']; ?>px;
					<?php } ?> 

					<?php if ( $settings->radio_checkbox_color ) { ?>
						color: #<?php echo $settings->radio_checkbox_color; ?>;
					<?php } ?>
				<?php } elseif ( 'false' == $settings->radio_check_custom_option ) { ?>		

					<?php if ( ! $version_bb_check ) { ?>
						<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
							<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
						<?php endif; ?>
					<?php } else { ?>
						<?php if ( isset( $settings->form_label_font_typo['font_family'] ) ) : ?>
							<?php UABB_Helper::uabb_font_css( $settings->form_label_font_typo['font_family'] ); ?>
						<?php endif; ?>
					<?php } ?>

					<?php if ( '' != $settings->label_color ) : ?>
						color: <?php echo $settings->label_color; ?>;
					<?php endif; ?>

				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-title {

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

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .gfield_radio li label, 
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .gfield_checkbox li label {
				<?php if ( isset( $settings->radio_checkbox_font_size['medium'] ) && '' != $settings->radio_checkbox_font_size['medium'] && 'true' == $settings->radio_check_custom_option ) : ?>
					font-size: <?php echo $settings->radio_checkbox_font_size['medium']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-desc {

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

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> select,
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> textarea,
			.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {

				<?php if ( isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) : ?>
					font-size: <?php echo $settings->font_size_unit_medium; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {

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
			.fl-node-<?php echo $id; ?> .uabb-gf-style form:not(input) {

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

		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper div.validation_error {

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

			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-gf-style select,
			.fl-node-<?php echo $id; ?> .uabb-gf-style textarea,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style select:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:focus,
			.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {
				<?php
				if ( ! $version_bb_check ) {
					if ( isset( $settings->input_border_width_dimension_top_medium ) ) {
						echo ( '' != $settings->input_border_width_dimension_top_medium ) ? 'padding-top:' . $settings->input_border_width_dimension_top_medium . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_bottom_medium ) ) {
						echo ( '' != $settings->input_border_width_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->input_border_width_dimension_bottom_medium . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_left_medium ) ) {
						echo ( '' != $settings->input_border_width_dimension_left_medium ) ? 'padding-left:' . $settings->input_border_width_dimension_left_medium . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_right_medium ) ) {
						echo ( '' != $settings->input_border_width_dimension_right_medium ) ? 'padding-right:' . $settings->input_border_width_dimension_right_medium . 'px;' : '';
					}
				} else {

					if ( isset( $settings->input_border_medium['width']['top'] ) ) {
						echo ( '' != $settings->input_border_medium['width']['top'] ) ? 'padding-top:' . $settings->input_border_medium['width']['top'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_medium['width']['bottom'] ) ) {
						echo ( '' != $settings->input_border_medium['width']['bottom'] ) ? 'padding-bottom:' . $settings->input_border_medium['width']['bottom'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_medium['width']['left'] ) ) {
						echo ( '' != $settings->input_border_medium['width']['left'] ) ? 'padding-left:' . $settings->input_border_medium['width']['left'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_medium['width']['right'] ) ) {
						echo ( '' != $settings->input_border_medium['width']['right'] ) ? 'padding-right:' . $settings->input_border_medium['width']['right'] . 'px;' : '';
					}
				}
				?>
			}

		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper form .gform_body input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
		.fl-node-<?php echo $id; ?> .gform_wrapper textarea,
		.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container select,
		.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {
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

		.fl-node-<?php echo $id; ?> .uabb-gf-style {
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
		<?php if ( 'default' == $settings->btn_style ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {
				<?php 
					if ( isset( $settings->button_padding_dimension_top_medium ) ) {
						echo ( '' != $settings->button_padding_dimension_top_medium ) ? 'padding-top:' . $settings->button_padding_dimension_top_medium . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'tablet', 'top' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_bottom_medium ) ) {
						echo ( '' != $settings->button_padding_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom_medium . 'px;' : 'padding-bottom:' .uabb_theme_padding_button( 'tablet', 'bottom' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_left_medium ) ) {
						echo ( '' != $settings->button_padding_dimension_left_medium ) ? 'padding-left:' . $settings->button_padding_dimension_left_medium . 'px;' : 'padding-left:' . uabb_theme_padding_button( 'tablet', 'left' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_right_medium ) ) {
						echo ( '' != $settings->button_padding_dimension_right_medium ) ? 'padding-right:' . $settings->button_padding_dimension_right_medium . 'px;' : 'padding-right:' . uabb_theme_padding_button( 'tablet', 'right' ) . ';';
					} 
				?>
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

		<?php if ( ! $version_bb_check ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_radio li label, 
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield_checkbox li label {
				<?php if ( 'true' == $settings->radio_check_custom_option ) { ?>

					<?php if ( 'Default' != $settings->radio_checkbox_font_family['family'] ) { ?>
						<?php FLBuilderFonts::font_css( $settings->radio_checkbox_font_family ); ?>
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->radio_checkbox_font_size_unit_responsive ) && '' != $settings->radio_checkbox_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->radio_checkbox_font_size_unit_responsive; ?>px;      
					<?php } elseif ( isset( $settings->radio_checkbox_font_size_unit_responsive ) && '' == $settings->radio_checkbox_font_size_unit_responsive && isset( $settings->radio_checkbox_font_size['small'] ) && '' != $settings->radio_checkbox_font_size['small'] ) { ?>
						font-size: <?php echo $settings->radio_checkbox_font_size['small']; ?>px;
					<?php } ?>
					<?php if ( $settings->radio_checkbox_color ) { ?>
						color: #<?php echo $settings->radio_checkbox_color; ?>;
					<?php } ?>
				<?php } elseif ( 'false' == $settings->radio_check_custom_option ) { ?>		

					<?php if ( ! $version_bb_check ) { ?>
						<?php if ( 'Default' != $settings->label_font_family['family'] ) : ?>
							<?php UABB_Helper::uabb_font_css( $settings->label_font_family ); ?>
						<?php endif; ?>
					<?php } else { ?>
						<?php if ( isset( $settings->form_label_font_typo['font_family'] ) ) : ?>
							<?php UABB_Helper::uabb_font_css( $settings->form_label_font_typo['font_family'] ); ?>
						<?php endif; ?>
					<?php } ?>

					<?php if ( '' != $settings->label_color ) : ?>
						color: <?php echo $settings->label_color; ?>;
					<?php endif; ?>
				<?php } ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-title {

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

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .gfield_radio li label, 
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gfield .gfield_checkbox li label {
				<?php if ( isset( $settings->radio_checkbox_font_size['small'] ) && '' != $settings->radio_checkbox_font_size['small'] && 'true' == $settings->radio_check_custom_option ) : ?>
					font-size: <?php echo $settings->radio_checkbox_font_size['small']; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .uabb-gf-form-desc {

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
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> select,
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> textarea,
			.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {

				<?php if ( isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) : ?>
					font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
				<?php endif; ?>
			}

			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper <?php echo '#gform_' . $settings->form_id; ?> .gform_footer input[type=submit],
			.fl-node-<?php echo $id; ?> .uabb-gf-style <?php echo '#gform_' . $settings->form_id; ?> .gform_page .gform_page_footer input[type=button],
			.fl-node-<?php echo $id; ?> .uabb-gf-style <?php echo '#gform_' . $settings->form_id; ?> .gform_page .gform_page_footer input[type=submit] {

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

			.fl-node-<?php echo $id; ?> .uabb-gf-style form:not(input) {

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

		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper div.validation_error {

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
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number],
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date],
			.fl-node-<?php echo $id; ?> .uabb-gf-style select,
			.fl-node-<?php echo $id; ?> .uabb-gf-style textarea,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=tel]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=email]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=text]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=url]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=number]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style input[type=date]:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style select:focus,
			.fl-node-<?php echo $id; ?> .uabb-gf-style textarea:focus,
			.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {
				<?php
				if ( ! $version_bb_check ) {
					if ( isset( $settings->input_border_width_dimension_top_responsive ) ) {
						echo ( '' != $settings->input_border_width_dimension_top_responsive ) ? 'padding-top:' . $settings->input_border_width_dimension_top_responsive . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_bottom_responsive ) ) {
						echo ( '' != $settings->input_border_width_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->input_border_width_dimension_bottom_responsive . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_left_responsive ) ) {
						echo ( '' != $settings->input_border_width_dimension_left_responsive ) ? 'padding-left:' . $settings->input_border_width_dimension_left_responsive . 'px;' : '';
					}
					if ( isset( $settings->input_border_width_dimension_right_responsive ) ) {
						echo ( '' != $settings->input_border_width_dimension_right_responsive ) ? 'padding-right:' . $settings->input_border_width_dimension_right_responsive . 'px;' : '';
					}
				} else {

					if ( isset( $settings->input_border_responsive['width']['top'] ) ) {
						echo ( '' != $settings->input_border_responsive['width']['top'] ) ? 'padding-top:' . $settings->input_border_responsive['width']['top'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_responsive['width']['bottom'] ) ) {
						echo ( '' != $settings->input_border_responsive['width']['bottom'] ) ? 'padding-bottom:' . $settings->input_border_responsive['width']['bottom'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_responsive['width']['left'] ) ) {
						echo ( '' != $settings->input_border_responsive['width']['left'] ) ? 'padding-left:' . $settings->input_border_responsive['width']['left'] . 'px;' : '';
					}
					if ( isset( $settings->input_border_responsive['width']['right'] ) ) {
						echo ( '' != $settings->input_border_responsive['width']['right'] ) ? 'padding-right:' . $settings->input_border_responsive['width']['right'] . 'px;' : '';
					}
				}
				?>
			}

		.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper form .gform_body input:not([type='radio']):not([type='checkbox']):not([type='submit']):not([type='button']):not([type='image']):not([type='file']),
		.fl-node-<?php echo $id; ?> .gform_wrapper textarea,
		.fl-node-<?php echo $id; ?> .gform_wrapper .gfield .ginput_container select,
		.fl-node-<?php echo $id; ?> .gform_wrapper .ginput_container_select .chosen-container-single .chosen-single {
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

		.fl-node-<?php echo $id; ?> .uabb-gf-style {
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
		<?php if ( 'default' == $settings->btn_style ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_wrapper .gform_footer input[type=submit],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=button],
			.fl-node-<?php echo $id; ?> .uabb-gf-style .gform_page .gform_page_footer input[type=submit] {
				<?php 
					if ( isset( $settings->button_padding_dimension_top_responsive ) ) {
						echo ( '' != $settings->button_padding_dimension_top_responsive ) ? 'padding-top:' . $settings->button_padding_dimension_top_responsive . 'px;' : 'padding-top:' . uabb_theme_padding_button( 'mobile', 'top' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_bottom_responsive ) ) {
						echo ( '' != $settings->button_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->button_padding_dimension_bottom_responsive . 'px;' : 'padding-bottom:' .uabb_theme_padding_button( 'mobile', 'bottom' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_left_responsive ) ) {
						echo ( '' != $settings->button_padding_dimension_left_responsive ) ? 'padding-left:' . $settings->button_padding_dimension_left_responsive . 'px;' : 'padding-left:' . uabb_theme_padding_button( 'mobile', 'left' ) . ';';
					}
					if ( isset( $settings->button_padding_dimension_right_responsive_responsive ) ) {
						echo ( '' != $settings->button_padding_dimension_right_responsive ) ? 'padding-right:' . $settings->button_padding_dimension_right_responsive . 'px;' : 'padding-right:' . uabb_theme_padding_button( 'mobile', 'right' ) . ';';
					} 
				?>
			}
		<?php } ?>
	}
	<?php
}
?>
