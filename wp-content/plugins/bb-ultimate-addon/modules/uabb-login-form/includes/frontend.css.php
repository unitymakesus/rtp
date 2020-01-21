<?php
/**
 *  Frontend CSS php file for Login Form Module.
 *
 *  @package UABB Login Form Module Frontend.css.php file.
 */

$version_bb_check                              = UABB_Compatibility::check_bb_version();
$settings->wp_login_btn_text_color             = UABB_Helper::uabb_colorpicker( $settings, 'wp_login_btn_text_color', true );
$settings->wp_login_btn_text_hover_color       = UABB_Helper::uabb_colorpicker( $settings, 'wp_login_btn_text_hover_color', true );
$settings->wp_login_btn_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'wp_login_btn_background_color', true );
$settings->wp_login_btn_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'wp_login_btn_background_hover_color', true );
$settings->form_bg_color                       = UABB_Helper::uabb_colorpicker( $settings, 'form_bg_color', true );
$settings->input_text_color                    = UABB_Helper::uabb_colorpicker( $settings, 'input_text_color', true );
$settings->input_background_color              = UABB_Helper::uabb_colorpicker( $settings, 'input_background_color', true );
$settings->label_color                         = UABB_Helper::uabb_colorpicker( $settings, 'label_color', true );
$settings->lost_your_pass_color                = UABB_Helper::uabb_colorpicker( $settings, 'lost_your_pass_color', true );
$settings->errormsg_bgcolor                    = UABB_Helper::uabb_colorpicker( $settings, 'errormsg_bgcolor', true );
$settings->errormsg_text_color                 = UABB_Helper::uabb_colorpicker( $settings, 'errormsg_text_color', true );
$settings->checkbox_bgcolor                    = UABB_Helper::uabb_colorpicker( $settings, 'checkbox_bgcolor', true );
/* Render Separator CSS */
if ( 'enable' === esc_attr( $settings->separator_select ) ) {

	if ( $version_bb_check ) {

		$separator_array = array(

			'separator'                => 'line_text',
			'text_inline'              => isset( $settings->separator_text ) ? $settings->separator_text : '',
			'text_tag_selection'       => isset( $settings->separator_text_tag_selection ) ? $settings->separator_text_tag_selection : '',
			'text_font_typo'           => isset( $settings->separator_typo ) ? $settings->separator_typo : '',
			'text_color'               => isset( $settings->separator_text_color ) ? $settings->separator_text_color : '',
			'icon_photo_position'      => isset( $settings->text_position ) ? $settings->text_position : '',
			'icon_spacing'             => isset( $settings->text_spacing ) ? $settings->text_spacing : '',
			'responsive_compatibility' => isset( $settings->responsive_compatibility ) ? $settings->responsive_compatibility : '',
			'color'                    => isset( $settings->separator_color ) ? $settings->separator_color : '',
			'height'                   => ( '' !== trim( $settings->separator_height ) ) ? $settings->separator_height : '1',
			'width'                    => ( '' !== trim( $settings->separator_width ) ) ? $settings->separator_width : '100',
			'alignment'                => isset( $settings->separator_alignment ) ? $settings->separator_alignment : '',
			'style'                    => isset( $settings->separator_style ) ? $settings->separator_style : '',
		);
	} else {

		$separator_array = array(

			'separator'                => 'line_text',
			'text_inline'              => isset( $settings->separator_text ) ? $settings->separator_text : '',
			'text_tag_selection'       => isset( $settings->separator_text_tag_selection ) ? $settings->separator_text_tag_selection : '',
			'text_color'               => isset( $settings->separator_text_color ) ? $settings->separator_text_color : '',
			'icon_photo_position'      => isset( $settings->text_position ) ? $settings->text_position : '',
			'icon_spacing'             => isset( $settings->text_spacing ) ? $settings->text_spacing : '',
			'responsive_compatibility' => isset( $settings->responsive_compatibility ) ? $settings->responsive_compatibility : '',
			'color'                    => isset( $settings->separator_color ) ? $settings->separator_color : '',
			'height'                   => ( '' !== trim( $settings->separator_height ) ) ? $settings->separator_height : '1',
			'width'                    => ( '' !== trim( $settings->separator_width ) ) ? $settings->separator_width : '100',
			'alignment'                => isset( $settings->separator_alignment ) ? $settings->separator_alignment : '',
			'style'                    => isset( $settings->separator_style ) ? $settings->separator_style : '',
			'text_font_family'         => isset( $settings->separator_font_family ) ? $settings->separator_font_family : '',
			'text_font_size'           => isset( $settings->separator_font_size ) ? $settings->separator_font_size : '',
			'text_font_size_unit'      => isset( $settings->separator_font_size_unit ) ? $settings->separator_font_size_unit : '',
			'text_line_height'         => isset( $settings->separator_line_height ) ? $settings->separator_line_height : '',
			'text_line_height_unit'    => isset( $settings->separator_line_height_unit ) ? $settings->separator_line_height_unit : '',
			'text_transform'           => isset( $settings->separator_text_transform ) ? $settings->separator_text_transform : '',
			'text_letter_spacing'      => isset( $settings->separator_text_letter_spacing ) ? $settings->separator_text_letter_spacing : '',
		);
	}

	FLBuilder::render_module_css(
		'advanced-separator',
		$id,
		$separator_array
	);

	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-advanced-separator {
		margin-top: <?php echo ( '' !== trim( esc_attr( $settings->separator_margin_top ) ) ) ? esc_attr( $settings->separator_margin_top ) : '20'; ?>px;
		margin-bottom: <?php echo ( '' !== trim( esc_attr( $settings->separator_margin_bottom ) ) ) ? esc_attr( $settings->separator_margin_bottom ) : '20'; ?>px;
	}
	<?php
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-login-form {
	<?php
	if ( isset( $settings->form_align ) ) {
					echo ( '' !== esc_attr( $settings->form_align ) ) ? 'text-align:' . esc_attr( $settings->form_align ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-login-form .uabb-lf-input-group .uabb-lf-form-input {
	<?php
	if ( isset( $settings->form_align ) ) {
					echo ( '' !== esc_attr( $settings->form_align ) ) ? 'text-align:' . esc_attr( $settings->form_align ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-submit-button {
	<?php if ( isset( $settings->wp_login_btn_text_color ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_text_color ) ) ? 'color:' . esc_attr( $settings->wp_login_btn_text_color ) . ';' : '';

}
	?>
	<?php if ( 'color' === esc_attr( $settings->wp_login_btn_background_type ) ) { ?>
		<?php if ( isset( $settings->wp_login_btn_background_color ) ) { ?>
			<?php
			echo ( ! empty( $settings->wp_login_btn_background_color ) ) ? 'background:' . esc_attr( $settings->wp_login_btn_background_color ) . ';' : '';

}
		?>
<?php } elseif ( 'gradient' === esc_attr( $settings->wp_login_btn_background_type ) ) { ?>
		<?php if ( isset( $settings->wp_login_btn_background_gradient ) ) { ?>
			<?php
			echo ( ! empty( $settings->wp_login_btn_background_gradient ) ) ? 'background:' . FLBuilderColor::gradient( $settings->wp_login_btn_background_gradient ) . ';' : '';

}
		?>
<?php } ?>
	<?php if ( isset( $settings->wp_login_btn_padding_top ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->wp_login_btn_padding_top ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->wp_login_btn_padding_right ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->wp_login_btn_padding_right ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->wp_login_btn_padding_bottom ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->wp_login_btn_padding_bottom ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->wp_login_btn_padding_left ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->wp_login_btn_padding_left ) . 'px;' : '';

}
	?>
	<?php if ( ! $version_bb_check ) { ?>
			<?php
			if ( isset( $settings->wp_login_border_style ) ) {
				echo ( '' !== esc_attr( $settings->wp_login_border_style ) ) ? 'border-style:' . esc_attr( $settings->wp_login_border_style ) . ';' : '';
			}
			if ( isset( $settings->wp_login_border_width ) ) {
				echo ( '' !== esc_attr( $settings->wp_login_border_width ) ) ? 'border-width:' . esc_attr( $settings->wp_login_border_width ) . 'px;' : '';
			}
			if ( isset( $settings->wp_login_border_color ) ) {
				echo ( '' !== esc_attr( $settings->wp_login_border_color ) ) ? 'border-color:' . esc_attr( $settings->wp_login_border_color ) . ';' : '';
			}
			if ( isset( $settings->wp_login_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->wp_login_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->wp_login_border_radius ) . 'px;' : '';
			}
} else {
	if ( class_exists( 'FLBuilderCSS' ) && isset( $settings->wp_login_button_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'wp_login_button_border',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-submit-button",
			)
		);
	}
}
	?>
	<?php if ( isset( $settings->wp_login_btn_top_margin ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_top_margin ) ) ? 'margin-top:' . esc_attr( $settings->wp_login_btn_top_margin ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->wp_login_btn_bottom_margin ) ) { ?>
		<?php
		echo ( ! empty( $settings->wp_login_btn_bottom_margin ) ) ? 'margin-bottom:' . esc_attr( $settings->wp_login_btn_bottom_margin ) . 'px;' : '';

}
	?>

}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-submit-button:hover {
		<?php if ( isset( $settings->wp_login_btn_text_hover_color ) ) { ?>
			<?php
			echo ( ! empty( $settings->wp_login_btn_text_hover_color ) ) ? 'color:' . esc_attr( $settings->wp_login_btn_text_hover_color ) . ';' : '';

}
		?>
		<?php if ( isset( $settings->wp_login_btn_background_hover_color ) ) { ?>
			<?php
			echo ( ! empty( $settings->wp_login_btn_background_hover_color ) ) ? 'background:' . esc_attr( $settings->wp_login_btn_background_hover_color ) . ';' : '';

}
		?>


}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap {
	<?php if ( 'color' === esc_attr( $settings->form_bg_type ) ) { ?>
		<?php if ( isset( $settings->form_bg_color ) ) { ?>
			<?php
			echo ( ! empty( $settings->form_bg_color ) ) ? 'background:' . esc_attr( $settings->form_bg_color ) . ';' : '';

}
		?>
<?php } elseif ( 'gradient' === esc_attr( $settings->form_bg_type ) ) { ?>
		<?php if ( isset( $settings->form_bg_gradient ) ) { ?>
			<?php
			echo ( ! empty( $settings->form_bg_gradient ) ) ? 'background:' . FLBuilderColor::gradient( $settings->form_bg_gradient ) . ';' : '';

}
		?>
<?php } ?>
	<?php if ( isset( $settings->form_spacing_dimension_top ) ) { ?>
		<?php
		echo ( ! empty( $settings->form_spacing_dimension_top ) ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->form_spacing_dimension_right ) ) { ?>
		<?php
		echo ( ! empty( $settings->form_spacing_dimension_right ) ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->form_spacing_dimension_bottom ) ) { ?>
		<?php
		echo ( ! empty( $settings->form_spacing_dimension_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->form_spacing_dimension_left ) ) { ?>
		<?php
		echo ( ! empty( $settings->form_spacing_dimension_left ) ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left ) . 'px;' : '';

}
	?>
	<?php if ( ! $version_bb_check ) { ?>
			<?php
			if ( isset( $settings->form_border_style ) ) {
				echo ( '' !== esc_attr( $settings->form_border_style ) ) ? 'border-style:' . esc_attr( $settings->form_border_style ) . ';' : '';
			}
			if ( isset( $settings->form_border_width ) ) {
				echo ( '' !== esc_attr( $settings->form_border_width ) ) ? 'border-width:' . esc_attr( $settings->form_border_width ) . 'px;' : '';
			}
			if ( isset( $settings->form_border_color ) ) {
				echo ( '' !== esc_attr( $settings->form_border_color ) ) ? 'border-color:' . esc_attr( $settings->form_border_color ) . ';' : '';
			}
			if ( isset( $settings->form_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->form_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->form_border_radius ) . 'px;' : '';
			}
} else {
	if ( class_exists( 'FLBuilderCSS' ) && isset( $settings->form_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'form_border',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap",
			)
		);
	}
}
	?>


}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-row {

	<?php
	if ( isset( $settings->row_gap ) ) {
		echo ( ! empty( $settings->row_gap ) ) ? 'margin-bottom:' . esc_attr( $settings->row_gap ) . 'px;' : '';
	}

	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-label {
	<?php
	if ( isset( $settings->label_bottom_margin ) ) {
		echo ( ! empty( $settings->label_bottom_margin ) ) ? 'margin-bottom:' . esc_attr( $settings->label_bottom_margin ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-label ,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-checkbox-label
{
	<?php if ( ! $version_bb_check ) { ?>
				<?php if ( 'default' !== esc_attr( $settings->label_font_family['family'] ) && 'default' !== esc_attr( $settings->label_font_family['weight'] ) ) : ?>
					<?php FLBuilderFonts::font_css( esc_attr( $settings->label_font_family ) ); ?>
				<?php endif; ?>
				<?php
				if ( isset( $settings->label_font_size ) ) {
					echo ( '' !== esc_attr( $settings->label_font_size ) ) ? 'font-size:' . esc_attr( $settings->label_font_size ) . 'px;' : '';
				}
				if ( isset( $settings->label_line_height ) ) {
					echo ( '' !== esc_attr( $settings->label_line_height ) ) ? 'line-height:' . esc_attr( $settings->label_line_height ) . 'em;' : '';
				}
				if ( isset( $settings->label_text_letter_spacing ) ) {
					echo ( '' !== esc_attr( $settings->label_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->label_text_letter_spacing ) . 'px;' : '';
				}
				if ( isset( $settings->label_text_transform ) ) {
					echo ( '' !== esc_attr( $settings->label_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->label_text_transform ) . ';' : '';
				}
				?>
			<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'label_typo',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-label , .fl-node-$id .uabb-lf-form-wrap .uabb-lf-checkbox-label",
			)
		);
	}
}
	?>
	<?php if ( isset( $settings->label_color ) ) { ?>
		<?php
		echo ( ! empty( $settings->label_color ) ) ? 'color:' . esc_attr( $settings->label_color ) . ';' : '';

}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-form-input {

	<?php if ( isset( $settings->input_padding_top ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->input_padding_top ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->input_padding_right ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->input_padding_right ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->input_padding_bottom ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->input_padding_left ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->input_padding_left ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->input_text_color ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_text_color ) ) ? 'color:' . esc_attr( $settings->input_text_color ) . ';' : '';

}
	?>
	<?php if ( isset( $settings->input_background_color ) ) { ?>
		<?php
		echo ( ! empty( $settings->input_background_color ) ) ? 'background:' . esc_attr( $settings->input_background_color ) . ';' : '';

}
	?>
	<?php if ( ! $version_bb_check ) { ?>
			<?php
			if ( isset( $settings->input_border_style ) ) {
				echo ( '' !== esc_attr( $settings->input_border_style ) ) ? 'border-style:' . esc_attr( $settings->input_border_style ) . ';' : '';
			}
			if ( isset( $settings->input_border_width ) ) {
				echo ( '' !== esc_attr( $settings->input_border_width ) ) ? 'border-width:' . esc_attr( $settings->input_border_width ) . 'px;' : '';
			}
			if ( isset( $settings->input_border_color ) ) {
				echo ( '' !== esc_attr( $settings->input_border_color ) ) ? 'border-color:' . esc_attr( $settings->input_border_color ) . ';' : '';
			}
			if ( isset( $settings->input_border_radius ) ) {
				echo ( '' !== esc_attr( $settings->input_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->input_border_radius ) . 'px;' : '';
			}
} else {
	if ( class_exists( 'FLBuilderCSS' ) && isset( $settings->input_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_border',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-form-input",
			)
		);
	}
}
	?>
}
	<?php if ( isset( $settings->input_border_active_color ) ) { ?>
		<?php if ( '' !== esc_attr( $settings->input_border_active_color ) ) { ?>
			.fl-node-$id .uabb-lf-form-wrap .uabb-lf-form-input input:active,
			.fl-node-$id .uabb-lf-form-wrap .uabb-lf-form-input input:focus {
				border-color: <?php echo esc_attr( $settings->input_border_active_color ); ?>;
			}
			<?php
}
}
	?>


.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-social-login-wrap .uabb-lf-google-button-wrap { 
	<?php

	if ( isset( $settings->social_buttons_spacing ) ) {
		echo ( ( ! empty( $settings->social_buttons_spacing ) && ( ! empty( $settings->social_buttons_layout ) ) && 'inline' === esc_attr( $settings->social_buttons_layout ) ) ) ? 'margin-right: calc(' . esc_attr( $settings->social_buttons_spacing ) . 'px/2);' : '';
	}
	if ( isset( $settings->social_buttons_spacing ) ) {
		echo ( ( ! empty( $settings->social_buttons_spacing ) && ( ! empty( $settings->social_buttons_layout ) ) && 'stack' === esc_attr( $settings->social_buttons_layout ) ) ) ? 'margin-bottom: calc(' . esc_attr( $settings->social_buttons_spacing ) . 'px/2);' : '';
	}

	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-social-login-wrap .uabb-google-content-wrapper { 
	<?php

	if ( isset( $settings->social_buttons_border_radius ) ) {
		echo ( '' !== esc_attr( $settings->social_buttons_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->social_buttons_border_radius ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-social-login-wrap {		
		<?php
		if ( isset( $settings->social_buttons_align ) && isset( $settings->social_buttons_layout ) ) {

			if ( ! empty( $settings->social_buttons_align ) && ( 'stack' !== esc_attr( $settings->social_buttons_layout ) ) ) {
				?>

				justify-content: <?php echo esc_attr( $settings->social_buttons_align ); ?>
					<?php
			}
			if ( ! empty( $settings->social_buttons_align ) && ( 'inline' !== esc_attr( $settings->social_buttons_layout ) ) ) {

				if ( 'flex-start' === esc_attr( $settings->social_buttons_align ) ) {

					$settings->social_buttons_align = 'left';
				}
				if ( 'flex-end' === esc_attr( $settings->social_buttons_align ) ) {

					$settings->social_buttons_align = 'right';
				}
				?>

				text-align: <?php echo esc_attr( $settings->social_buttons_align ); ?>
					<?php
			}
		}
		?>

}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-social-login-wrap .uabb-lf-facebook-button-wrap { 
	<?php

	if ( isset( $settings->social_buttons_spacing ) ) {
		echo ( ( ! empty( $settings->social_buttons_spacing ) && ( ! empty( $settings->social_buttons_layout ) ) && 'inline' === esc_attr( $settings->social_buttons_layout ) ) ) ? 'margin-left: calc(' . esc_attr( $settings->social_buttons_spacing ) . 'px/2);' : '';
	}
	if ( isset( $settings->social_buttons_spacing ) ) {
		echo ( ( ! empty( $settings->social_buttons_spacing ) && ( ! empty( $settings->social_buttons_layout ) ) && 'stack' === esc_attr( $settings->social_buttons_layout ) ) ) ? 'margin-top: calc(' . esc_attr( $settings->social_buttons_spacing ) . 'px/2);' : '';
	}

	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-social-login-wrap .uabb-facebook-content-wrapper { 
	<?php

	if ( isset( $settings->social_buttons_border_radius ) ) {
		echo ( '' !== esc_attr( $settings->social_buttons_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->social_buttons_border_radius ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-login-form .uabb-lf-submit-button-wrap {	
		<?php

		if ( isset( $settings->wp_login_btn_align ) ) {

			if ( ! empty( $settings->wp_login_btn_align ) ) {
				?>

				text-align: <?php echo esc_attr( $settings->wp_login_btn_align ); ?>
				<?php
			}
		}
		?>
} 

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-lost-your-pass-label {
		<?php if ( ! $version_bb_check ) { ?>
				<?php if ( 'default' !== esc_attr( $settings->lost_your_pass_font_family['family'] ) && 'default' !== esc_attr( $settings->lost_your_pass_font_family['weight'] ) ) : ?>
					<?php FLBuilderFonts::font_css( esc_attr( $settings->lost_your_pass_font_family ) ); ?>
				<?php endif; ?>
				<?php
				if ( isset( $settings->lost_your_pass_font_size ) ) {
					echo ( '' !== esc_attr( $settings->lost_your_pass_font_size ) ) ? 'font-size:' . esc_attr( $settings->lost_your_pass_font_size ) . 'px;' : '';
				}
				if ( isset( $settings->lost_your_pass_line_height ) ) {
					echo ( '' !== esc_attr( $settings->lost_your_pass_line_height ) ) ? 'line-height:' . esc_attr( $settings->lost_your_pass_line_height ) . 'em;' : '';
				}
				if ( isset( $settings->lost_your_pass_text_letter_spacing ) ) {
					echo ( '' !== esc_attr( $settings->lost_your_pass_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->lost_your_pass_text_letter_spacing ) . 'px;' : '';
				}
				if ( isset( $settings->lost_your_pass_text_transform ) ) {
					echo ( '' !== esc_attr( $settings->lost_your_pass_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->lost_your_pass_text_transform ) . ';' : '';
				}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'lost_your_pass_typo',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-lost-your-pass-label",
			)
		);
	}
}
		?>
		<?php if ( isset( $settings->lost_your_pass_color ) ) { ?>	
			<?php
			echo ( ! empty( $settings->lost_your_pass_color ) ) ? 'color:' . esc_attr( $settings->lost_your_pass_color ) . ';' : '';

}
		?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button {
		<?php if ( ! $version_bb_check ) { ?>
				<?php if ( 'default' !== esc_attr( $settings->button_font_family['family'] ) && 'default' !== esc_attr( $settings->button_font_family['weight'] ) ) : ?>
					<?php FLBuilderFonts::font_css( esc_attr( $settings->button_font_family ) ); ?>
				<?php endif; ?>
				<?php
				if ( isset( $settings->button_font_size ) ) {
					echo ( '' !== esc_attr( $settings->button_font_size ) ) ? 'font-size:' . esc_attr( $settings->button_font_size ) . 'px;' : '';
				}
				if ( isset( $settings->button_line_height ) ) {
					echo ( '' !== esc_attr( $settings->button_line_height ) ) ? 'line-height:' . esc_attr( $settings->button_line_height ) . 'em;' : '';
				}
				if ( isset( $settings->button_text_letter_spacing ) ) {
					echo ( '' !== esc_attr( $settings->button_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->button_text_letter_spacing ) . 'px;' : '';
				}
				if ( isset( $settings->button_text_transform ) ) {
					echo ( '' !== esc_attr( $settings->button_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->button_text_transform ) . ';' : '';
				}
				?>
			<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-submit-button",
			)
		);
	}
}
		?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input,.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input::placeholder {
		<?php if ( ! $version_bb_check ) { ?>
				<?php if ( 'default' !== esc_attr( $settings->input_font_family['family'] ) && 'default' !== esc_attr( $settings->input_font_family['weight'] ) ) : ?>
					<?php FLBuilderFonts::font_css( esc_attr( $settings->input_font_family ) ); ?>
				<?php endif; ?>
				<?php
				if ( isset( $settings->input_font_size ) ) {
					echo ( '' !== esc_attr( $settings->input_font_size ) ) ? 'font-size:' . esc_attr( $settings->input_font_size ) . 'px;' : '';
				}
				if ( isset( $settings->input_line_height ) ) {
					echo ( '' !== esc_attr( $settings->input_line_height ) ) ? 'line-height:' . esc_attr( $settings->input_line_height ) . 'em;' : '';
				}
				if ( isset( $settings->input_text_letter_spacing ) ) {
					echo ( '' !== esc_attr( $settings->input_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->input_text_letter_spacing ) . 'px;' : '';
				}
				if ( isset( $settings->input_text_transform ) ) {
					echo ( '' !== esc_attr( $settings->input_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->input_text_transform ) . ';' : '';
				}
				?>
			<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'input_typo',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input,.uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-form-input::placeholder",
			)
		);
	}
}
		?>
		<?php if ( isset( $settings->input_text_color ) ) { ?>	
			<?php
			echo ( ! empty( $settings->input_text_color ) ) ? 'color:' . esc_attr( $settings->input_text_color ) . ';' : '';

}
		?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-end-text-wrap {		
		<?php

		if ( isset( $settings->form_end_text_align ) ) {

			if ( ! empty( $settings->form_end_text_align ) ) {
				?>

				justify-content: <?php echo esc_attr( $settings->form_end_text_align ); ?>
					<?php
			}
		}
		?>

}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-end-text-wrap .uabb-lf-lost-password { 
	<?php

	if ( isset( $settings->form_end_text_spacing ) ) {
		echo ( ! empty( $settings->form_end_text_spacing ) ) ? 'margin-left: calc(' . esc_attr( $settings->form_end_text_spacing ) . 'px/2);' : '';
	}

	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-end-text-wrap .uabb-lf-custom-link { 
	<?php


	if ( isset( $settings->form_end_text_spacing ) ) {
		echo ( ! empty( $settings->form_end_text_spacing ) ) ? 'margin-right: calc(' . esc_attr( $settings->form_end_text_spacing ) . 'px/2);' : '';
	}

	?>
}


.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-error-message-wrap {
		<?php if ( ! $version_bb_check ) { ?>
				<?php
				if ( isset( $settings->errormsg_border_style ) ) {
					echo ( '' !== esc_attr( $settings->errormsg_border_style ) ) ? 'border-style:' . esc_attr( $settings->errormsg_border_style ) . ';' : '';
				}
				if ( isset( $settings->errormsg_border_width ) ) {
					echo ( '' !== esc_attr( $settings->errormsg_border_width ) ) ? 'border-width:' . esc_attr( $settings->errormsg_border_width ) . 'px;' : '';
				}
				if ( isset( $settings->errormsg_border_color ) ) {
					echo ( '' !== esc_attr( $settings->errormsg_border_color ) ) ? 'border-color:' . esc_attr( $settings->errormsg_border_color ) . ';' : '';
				}
				if ( isset( $settings->errormsg_border_radius ) ) {
					echo ( '' !== esc_attr( $settings->errormsg_border_radius ) ) ? 'border-radius:' . esc_attr( $settings->errormsg_border_radius ) . 'px;' : '';
				}
} else {
	if ( class_exists( 'FLBuilderCSS' ) && isset( $settings->errormsg_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'errormsg_border',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-error-message-wrap",
			)
		);
	}
}
		?>
	<?php if ( isset( $settings->errormsg_bgcolor ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_bgcolor ) ) ? 'background:' . esc_attr( $settings->errormsg_bgcolor ) . ';' : '';

}
	?>
	<?php if ( isset( $settings->errormsg_text_color ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_text_color ) ) ? 'color:' . esc_attr( $settings->errormsg_text_color ) . ';' : '';

}
	?>
	<?php if ( isset( $settings->errormsg_padding_top ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->errormsg_padding_top ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->errormsg_padding_right ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->errormsg_padding_right ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->errormsg_padding_bottom ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->errormsg_padding_bottom ) . 'px;' : '';

}
	?>
	<?php if ( isset( $settings->errormsg_padding_left ) ) { ?>
		<?php
		echo ( ! empty( $settings->errormsg_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->errormsg_padding_left ) . 'px;' : '';

}
	?>
	<?php if ( ! $version_bb_check ) { ?>
			<?php if ( 'default' !== esc_attr( $settings->errormsg_font_family['family'] ) && 'default' !== esc_attr( $settings->errormsg_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->errormsg_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->errormsg_font_size ) ) {
				echo ( '' !== esc_attr( $settings->errormsg_font_size ) ) ? 'font-size:' . esc_attr( $settings->errormsg_font_size ) . 'px;' : '';
			}
			if ( isset( $settings->errormsg_line_height ) ) {
				echo ( '' !== esc_attr( $settings->errormsg_line_height ) ) ? 'line-height:' . esc_attr( $settings->errormsg_line_height ) . 'em;' : '';
			}
			if ( isset( $settings->errormsg_text_transform ) ) {
				echo ( '' !== esc_attr( $settings->errormsg_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->errormsg_text_transform ) . 'px;' : '';
			}
			if ( isset( $settings->errormsg_text_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->errormsg_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->errormsg_text_letter_spacing ) . ';' : '';
			}
			?>
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'errormsg_typo',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-error-message-wrap",
			)
		);
	}
}
	?>
}

<?php
$font_size     = intval( esc_attr( $settings->checkbox_size ) );
$checked_width = $font_size - intval( esc_attr( $settings->checkbox_border['width']['top'] ) );

?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-checkbox-label input[type='checkbox'] + span:before {	
	font-size: <?php echo esc_attr( $checked_width ); ?>px;
	line-height: <?php echo esc_attr( $checked_width ); ?>px;
	color: #<?php echo esc_attr( $settings->checkbox_selected_color ); ?>;
	<?php if ( isset( $settings->checkbox_bgcolor ) && '' !== $settings->checkbox_bgcolor ) : ?>	
	background-color: <?php echo esc_attr( $settings->checkbox_bgcolor ); ?>;
	<?php endif; ?>
	width: <?php echo esc_attr( $settings->checkbox_size ); ?>px;
	height: <?php echo esc_attr( $settings->checkbox_size ); ?>px;
	<?php

	if ( class_exists( 'FLBuilderCSS' ) && isset( $settings->checkbox_border ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'checkbox_border',
				'selector'     => ".fl-node-$id .uabb-lf-form-wrap .uabb-lf-input-group .uabb-lf-checkbox-label input[type='checkbox'] + span:before ",
			)
		);
	}
	?>
}
<?php if ( $global_settings->responsive_enabled ) { ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap {
			<?php
			if ( isset( $settings->form_spacing_dimension_top_medium ) ) {
				echo ( ! empty( $settings->form_spacing_dimension_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_medium ) . 'px;' : '';
			}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_right_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->form_spacing_dimension_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_bottom_medium ) ) { ?>
			<?php
			echo ( ! empty( $settings->form_spacing_dimension_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_left_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->form_spacing_dimension_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_medium ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-error-message-wrap {
			<?php if ( isset( $settings->errormsg_padding_top_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->errormsg_padding_top_medium ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->errormsg_padding_right_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->errormsg_padding_right_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->errormsg_padding_bottom_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->errormsg_padding_bottom_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->errormsg_padding_left_medium ) ) { ?>
			<?php
				echo ( ! empty( $settings->errormsg_padding_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->errormsg_padding_left_medium ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-submit-button {

			<?php if ( isset( $settings->wp_login_btn_padding_top_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->wp_login_btn_padding_top_medium ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_right_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->wp_login_btn_padding_right_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_bottom_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->wp_login_btn_padding_bottom_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_left_medium ) ) { ?>
			<?php
				echo ( ! empty( $settings->wp_login_btn_padding_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->wp_login_btn_padding_left_medium ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-form-input {
			<?php if ( isset( $settings->input_padding_top_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_top_medium ) ) ? 'padding-top:' . esc_attr( $settings->input_padding_top_medium ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->input_padding_right_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_right_medium ) ) ? 'padding-right:' . esc_attr( $settings->input_padding_right_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->input_padding_bottom_medium ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_bottom_medium ) ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom_medium ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->input_padding_left_medium ) ) { ?>
			<?php
				echo ( ! empty( $settings->input_padding_left_medium ) ) ? 'padding-left:' . esc_attr( $settings->input_padding_left_medium ) . 'px;' : '';

}
?>
		}
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap {
			<?php
			if ( isset( $settings->form_spacing_dimension_top_responsive ) ) {
				echo ( ! empty( $settings->form_spacing_dimension_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->form_spacing_dimension_top_responsive ) . 'px;' : '';
			}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_right_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->form_spacing_dimension_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->form_spacing_dimension_right_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_bottom_responsive ) ) { ?>
			<?php
			echo ( ! empty( $settings->form_spacing_dimension_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->form_spacing_dimension_bottom_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->form_spacing_dimension_left_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->form_spacing_dimension_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->form_spacing_dimension_left_responsive ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-error-message-wrap {
			<?php if ( isset( $settings->errormsg_padding_top_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->errormsg_padding_top_responsive ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->errormsg_padding_right_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->errormsg_padding_right_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->errormsg_padding_bottom_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->errormsg_padding_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->errormsg_padding_bottom_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->errormsg_padding_left_responsive ) ) { ?>
			<?php
				echo ( ! empty( $settings->errormsg_padding_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->errormsg_padding_left_responsive ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-submit-button {

			<?php if ( isset( $settings->wp_login_btn_padding_top_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->wp_login_btn_padding_top_responsive ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_right_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->wp_login_btn_padding_right_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_bottom_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->wp_login_btn_padding_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->wp_login_btn_padding_bottom_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->wp_login_btn_padding_left_responsive ) ) { ?>
			<?php
				echo ( ! empty( $settings->wp_login_btn_padding_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->wp_login_btn_padding_left_responsive ) . 'px;' : '';

}
?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-lf-form-wrap .uabb-lf-form-input {
			<?php if ( isset( $settings->input_padding_top_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_top_responsive ) ) ? 'padding-top:' . esc_attr( $settings->input_padding_top_responsive ) . 'px;' : '';
}
			?>
			<?php if ( isset( $settings->input_padding_right_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_right_responsive ) ) ? 'padding-right:' . esc_attr( $settings->input_padding_right_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->input_padding_bottom_responsive ) ) { ?>
				<?php
				echo ( ! empty( $settings->input_padding_bottom_responsive ) ) ? 'padding-bottom:' . esc_attr( $settings->input_padding_bottom_responsive ) . 'px;' : '';

}
			?>
			<?php if ( isset( $settings->input_padding_left_responsive ) ) { ?>
			<?php
				echo ( ! empty( $settings->input_padding_left_responsive ) ) ? 'padding-left:' . esc_attr( $settings->input_padding_left_responsive ) . 'px;' : '';

}
?>
		}
	}
<?php } ?>
