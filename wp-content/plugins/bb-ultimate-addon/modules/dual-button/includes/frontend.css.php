<?php
/**
 * Register the module's CSS file for Dual Button module
 *
 * @package UABB Dual Button Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->button_border_color = UABB_Helper::uabb_colorpicker( $settings, 'button_border_color' );

$settings->_btn_one_back_color       = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_back_color', true );
$settings->_btn_one_back_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_back_hover_color', true );

$settings->_btn_two_back_color       = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_back_color', true );
$settings->_btn_two_back_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_back_hover_color', true );

$settings->divider_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_color' );

$settings->divider_background_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_background_color', true );


$settings->divider_border_color = UABB_Helper::uabb_colorpicker( $settings, 'divider_border_color' );

$settings->_btn_one_text_color       = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_text_color' );
$settings->_btn_one_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_one_text_hover_color' );


$settings->_btn_two_text_color       = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_text_color' );
$settings->_btn_two_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, '_btn_two_text_hover_color' );

$settings->button_border_width     = ( '' != $settings->button_border_width ) ? $settings->button_border_width : '2';
$settings->img_icon_width_btn_one  = ( '' != $settings->img_icon_width_btn_one ) ? $settings->img_icon_width_btn_one : '30';
$settings->img_icon_width_btn_two  = ( '' != $settings->img_icon_width_btn_two ) ? $settings->img_icon_width_btn_two : '30';
$settings->dual_button_width       = ( '' != $settings->dual_button_width ) ? $settings->dual_button_width : '100';
$settings->dual_button_height      = ( '' != $settings->dual_button_height ) ? $settings->dual_button_height : '45';
$settings->dual_button_radius      = ( '' != $settings->dual_button_radius ) ? $settings->dual_button_radius : '0';
$settings->spacing_between_buttons = ( '' != $settings->spacing_between_buttons ) ? $settings->spacing_between_buttons : '10';
?>
/* Global Style */

/* Divider Styles */
<?php if ( 'default' === $settings->dual_button_style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
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
		?>
	}
	<?php
		$settings->button_border = uabb_theme_border( $settings->button_border );

	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-node-$id .uabb-btn.uabb-btn-one,.fl-node-$id .uabb-btn.uabb-btn-two",
			)
		);
	}
	?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one {
		background: <?php echo uabb_theme_default_button_bg_color( $settings->_btn_one_back_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one:hover {
		background: <?php echo uabb_theme_default_button_bg_hover_color( $settings->_btn_one_back_hover_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
		background: <?php echo uabb_theme_default_button_bg_color( $settings->_btn_two_back_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two:hover {
		background: <?php echo uabb_theme_default_button_bg_hover_color( $settings->_btn_two_back_hover_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one:hover,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two:hover {
		border-color:<?php echo uabb_theme_border_hover_color( $settings->border_hover_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn-one .uabb-btn-one-text:hover,
	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one:hover,
	.fl-node-<?php echo $id; ?> .uabb-btn-one:hover {
		color: <?php echo uabb_theme_default_button_text_hover_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn-two .uabb-btn-two-text:hover,
	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two:hover,
	.fl-node-<?php echo $id; ?> .uabb-btn-two:hover {
		color: <?php echo uabb_theme_default_button_text_hover_color( $settings->_btn_two_text_hover_color ); ?>;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo $id; ?> .uabb-middle-text {
	<?php if ( 'none' != $settings->_divider_transform ) : ?>
		text-transform: <?php echo $settings->_divider_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->_divider_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->_divider_letter_spacing; ?>px;
	<?php endif; ?>

	<?php if ( 'text' == $settings->divider_options && 'Default' != $settings->_divider_font_family['family'] ) { ?>
		<?php UABB_Helper::uabb_font_css( $settings->_divider_font_family ); ?>
	<?php } ?>

	/* Calculated Divider Setting */
	<?php
		$tb_padding   = '';
		$lr_padding   = '';
		$sm_pad_value = '';
		$mul_logic    = '';
		$div_fn_size  = '';
		$fn_calc      = '';
	if ( ( 'none' != $settings->divider_options && 'custom' == $settings->dual_button_width_type ) || ( isset( $settings->_divider_font_size['desktop'] ) && '' != $settings->_divider_font_size['desktop'] || '' != $settings->_divider_font_size_unit ) ) :
		if ( ( '' != $settings->dual_button_pad_top_bot || '' != $settings->dual_button_pad_lef_rig ) || ( isset( $settings->_divider_font_size['desktop'] ) && '' != $settings->_divider_font_size['desktop'] || '' != $settings->_divider_font_size_unit && 'text' == $settings->divider_options ) ) :
			$tb_padding   = (int) $settings->dual_button_pad_top_bot * 2;
			$lr_padding   = (int) $settings->dual_button_pad_lef_rig * 2;
			$sm_pad_value = ( min( $tb_padding, $lr_padding ) );
			if ( '' == $settings->dual_button_pad_lef_rig ) {
				$sm_pad_value = $tb_padding;
			}

			if ( '' == $settings->dual_button_pad_top_bot ) {
				$sm_pad_value = $lr_padding;
			}

			$mul_logic = $sm_pad_value * 1.25;
			$fn_calc   = $mul_logic;
			if ( 'text' == $settings->divider_options ) {
				if ( isset( $settings->_divider_font_size_unit ) && '' != $settings->_divider_font_size_unit ) {
					$div_fn_size = $settings->_divider_font_size_unit * 2;
				} else {
					$div_fn_size = $settings->_divider_font_size['desktop'] * 2;
				}
				$fn_calc = ( max( $div_fn_size, $mul_logic ) );
			}
			?>

			width: <?php echo $fn_calc; ?>px;
			height: <?php echo $fn_calc; ?>px;
			line-height: <?php echo $fn_calc; ?>px;

		<?php endif; ?>


	<?php endif; ?>

	<?php if ( 'text' == $settings->divider_options && isset( $settings->_divider_font_size_unit ) ) { ?>

		<?php if ( isset( $settings->_divider_font_size_unit ) && '' != $settings->_divider_font_size_unit ) : ?>
			font-size: <?php echo $settings->_divider_font_size_unit; ?>px;
		<?php endif; ?>

	<?php } ?>

	overflow:hidden;
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => '_divider_typo',
				'selector'     => ".fl-node-$id .uabb-middle-text",
			)
		);
	}

	$tb_padding   = '';
	$lr_padding   = '';
	$sm_pad_value = '';
	$mul_logic    = '';
	$div_fn_size  = '';
	$fn_calc      = '';
	?>

	.fl-node-<?php echo $id; ?>  .uabb-dual-button .uabb-middle-text {
	<?php
	if ( ( 'none' != $settings->divider_options && 'custom' == $settings->dual_button_width_type ) || isset( $settings->_divider_typo['font_size']['length'] ) ) :

		if ( ( '' != $settings->dual_button_pad_top_bot || '' != $settings->dual_button_pad_lef_rig ) || isset( $settings->_divider_typo['font_size']['length'] ) && is_numeric( $settings->_divider_typo['font_size']['length'] ) && 'text' == $settings->divider_options ) :
			$tb_padding   = (int) $settings->dual_button_pad_top_bot * 2;
			$lr_padding   = (int) $settings->dual_button_pad_lef_rig * 2;
			$sm_pad_value = ( min( $tb_padding, $lr_padding ) );
			if ( '' == $settings->dual_button_pad_lef_rig ) {
				$sm_pad_value = $tb_padding;
			}

			if ( '' == $settings->dual_button_pad_top_bot ) {
				$sm_pad_value = $lr_padding;
			}

			$mul_logic = $sm_pad_value * 1.25;
			$fn_calc   = $mul_logic;
			if ( 'text' == $settings->divider_options ) {
				if ( isset( $settings->_divider_typo['font_size']['length'] ) && '' != $settings->_divider_typo['font_size']['length'] ) {
					$div_fn_size = $settings->_divider_typo['font_size']['length'] * 2;
				}
				$fn_calc = ( max( $div_fn_size, $mul_logic ) );
			}
			?>

			width: <?php echo $fn_calc; ?>px;
			height: <?php echo $fn_calc; ?>px;
			line-height: <?php echo $fn_calc; ?>px;

		<?php endif; ?>

	<?php endif; ?>
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-middle-text {
	color: <?php echo uabb_theme_base_color( $settings->divider_color ); ?>;
	background: <?php echo uabb_theme_base_color( $settings->divider_background_color ); ?>;
	<?php if ( '' != $settings->divider_border ) { ?>
		border-color: <?php echo uabb_theme_base_color( $settings->divider_border_color ); ?>;
		border-width: <?php echo ( '' != $settings->divider_border_width ) ? $settings->divider_border_width : '1'; ?>px;
		<?php if ( '' != $settings->divider_border ) { ?>
		border-style: <?php echo $settings->divider_border; ?>;
		<?php } ?>
	<?php } ?>
	border-radius: <?php echo ( '' != $settings->divider_border_radius ) ? $settings->divider_border_radius : '50'; ?>px;
}

/* Button general settings */
<?php if ( 'left' == $settings->dual_button_align ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button {
		justify-content: flex-start;
	}
<?php } if ( 'right' == $settings->dual_button_align ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button {
		justify-content: flex-end;
	}
<?php } if ( 'center' == $settings->dual_button_align ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button {
		justify-content: center;
	}
<?php } ?>

/* Button Full Width */
<?php if ( 'full' == $settings->dual_button_width_type ) { ?>
.fl-node-<?php echo $id; ?> .uabb-dual-button-wrapper {
	width: 100%;
}
<?php } ?>

/* Button Custom Width and Else Padding */
<?php if ( 'custom' == $settings->dual_button_width_type ) { ?>
	<?php if ( 'horizontal' == $settings->dual_button_type ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-dual-button-wrapper {
		width: <?php echo intval( $settings->dual_button_width ) * 2; ?>px;
	}
	<?php } elseif ( 'vertical' == $settings->dual_button_type ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-dual-button-wrapper {
		width: <?php echo $settings->dual_button_width; ?>px;
	}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
		<?php
		if ( '' != $settings->dual_button_pad_top_bot || '' != $settings->dual_button_pad_lef_rig ) {
			if ( '' != $settings->dual_button_pad_top_bot ) {
				?>
			padding-top: <?php echo $settings->dual_button_pad_top_bot; ?>px;
			padding-bottom: <?php echo $settings->dual_button_pad_top_bot; ?>px;
			<?php } ?>
			<?php if ( '' != $settings->dual_button_pad_lef_rig ) { ?>
			padding-left: <?php echo $settings->dual_button_pad_lef_rig; ?>px;
			padding-right: <?php echo $settings->dual_button_pad_lef_rig; ?>px;
			<?php } ?>
		<?php } ?>

		min-height: <?php echo $settings->dual_button_height; ?>px;
	}
	<?php
} else {
	?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
		<?php
		echo uabb_theme_padding_css_genreated( 'desktop' );
		?>
	}
	<?php
}
?>

/* General Radius */


/* General Border Only for Transparent */
<?php if ( 'transparent' == $settings->dual_button_style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
		border-width: <?php echo $settings->button_border_width; ?>px;
		border-style: <?php echo $settings->dual_button_border_style; ?>;
		border-color: <?php echo uabb_theme_base_color( $settings->button_border_color ); ?>;
	}

	<?php
	if ( 'horizontal' == $settings->dual_button_type ) {
		if ( 'no' != $settings->join_buttons ) {
			?>
		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
			border-left: 0;
		}
			<?php
		}
		?>
		.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-middle-text {
			right: <?php echo intval( $settings->button_border_width ) / 2; ?>px;
		}
	<?php } ?>

	<?php if ( 'vertical' == $settings->dual_button_type ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
			border-top: 0;
		}
	<?php } ?>
<?php } ?>

/* Default Styles Button Text and Backgrund Styles */
/* Button 1 */
.fl-node-<?php echo $id; ?> .uabb-btn-one {
	background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_color ); ?>;
	display: block;
}

.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}
.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}
<?php if ( 'default' !== $settings->dual_button_style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn-one:hover {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two:hover{
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-middle-text {
	color: <?php echo uabb_theme_base_color( $settings->divider_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-btn-one .uabb-btn-one-text,
.fl-node-<?php echo $id; ?> .uabb-btn-one .uabb-imgicon-wrap .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}

/* Button 2 */
.fl-node-<?php echo $id; ?> .uabb-btn-two {
	background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_color ); ?>;
	display: block;
}

.fl-node-<?php echo $id; ?> .uabb-btn-two .uabb-btn-two-text,
.fl-node-<?php echo $id; ?> .uabb-btn-two .uabb-imgicon-wrap .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}



/************* Global Hover Styles *****************/
<?php if ( 'flat' == $settings->dual_button_style ) { ?>

	/* Button Text and Backgrund Hover Styles */
	.fl-node-<?php echo $id; ?> .uabb-btn-one:hover {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-one:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id; ?> .uabb-btn-one:hover .uabb-imgicon-wrap .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}

	/* Button Two Hover Style */
	.fl-node-<?php echo $id; ?> .uabb-btn-two:hover {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two:hover .uabb-btn-two-text,
	.fl-node-<?php echo $id; ?> .uabb-btn-two:hover .uabb-imgicon-wrap .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}

<?php } ?>

/* Global Hover Style Ends **/

/************************************ End of Global Style ************************************/

/* Horizontal Style */
<?php if ( 'horizontal' == $settings->dual_button_type ) { ?>
	<?php if ( 'default' !== $settings->dual_button_style ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one {
			border-top-left-radius: <?php echo $settings->dual_button_radius; ?>px;
			border-bottom-left-radius: <?php echo $settings->dual_button_radius; ?>px;
		}
		.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
			border-top-right-radius: <?php echo $settings->dual_button_radius; ?>px;
			border-bottom-right-radius: <?php echo $settings->dual_button_radius; ?>px;
		}
	<?php } ?>

	<?php if ( 'full' == $settings->dual_button_width_type || 'custom' == $settings->dual_button_width_type ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-btn-horizontal {
			width: 50%;
		}
	<?php } ?>

<?php } ?>

/* End of Horizontal Style */

/* Vertical Style */
<?php if ( 'vertical' == $settings->dual_button_type ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-vertical .uabb-btn.uabb-btn-one {
		border-top-left-radius: <?php echo $settings->dual_button_radius; ?>px;
		border-top-right-radius: <?php echo $settings->dual_button_radius; ?>px;
	}
	.fl-node-<?php echo $id; ?> .uabb-vertical .uabb-btn.uabb-btn-two {
		border-bottom-left-radius: <?php echo $settings->dual_button_radius; ?>px;
		border-bottom-right-radius: <?php echo $settings->dual_button_radius; ?>px;
	}

	<?php if ( 'full' == $settings->dual_button_width_type ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-btn-vertical {
			width: 100%;
		}
	<?php } ?>
<?php } ?>

/* End of Vertical Style */

/* Transparent Styles - Button Text and Backgrund Styles */
<?php if ( 'transparent' == $settings->dual_button_style ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-btn-one.<?php echo 'uabb-' . $settings->transparent_button_options; ?>,
	.fl-node-<?php echo $id; ?> .uabb-btn-two.<?php echo 'uabb-' . $settings->transparent_button_options; ?> {
		background: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-one.<?php echo 'uabb-' . $settings->transparent_button_options; ?> .uabb-btn-one-text {
		color: <?php echo uabb_theme_base_color( $settings->_btn_one_text_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.<?php echo 'uabb-' . $settings->transparent_button_options; ?> .uabb-btn-two-text {
		color: <?php echo uabb_theme_base_color( $settings->_btn_two_text_color ); ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-one.<?php echo 'uabb-' . $settings->transparent_button_options; ?>:hover .uabb-btn-one-text {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	/* Code To change icon color on hover */
	<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn-one.<?php echo 'uabb-' . $settings->transparent_button_options; ?>:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		position: relative;
		z-index: 1;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	.fl-node-<?php echo $id; ?> .uabb-btn-two.<?php echo 'uabb-' . $settings->transparent_button_options; ?>:hover .uabb-btn-two-text {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	/* Code To change icon color on hover Button Two*/
	<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn-two.<?php echo 'uabb-' . $settings->transparent_button_options; ?>:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		position: relative;
		z-index: 1;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */

	<?php if ( 'transparent-fade' == $settings->transparent_button_options ) { ?>
		/* Fade Background */
		/* Button Text and Backgrund Hover Styles */

		.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fade:hover {
			background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		}
		/* Code To change icon color on hover */
		<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fade:hover .uabb-icon i {
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
		}
		<?php } ?>
		/* Code To change icon color on hover Ends */

		.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fade:hover {
			background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		}

		/* Code To change icon color on hover Button Two*/
		<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fade:hover .uabb-icon i {
			color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
		}
		<?php } ?>
		/* Code To change icon color on hover Button Two Ends */
	<?php } ?>


	<?php if ( 'transparent-fill-top' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Top */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-top:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-top:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-bottom' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Bottom */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-bottom:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-bottom:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-left' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Left */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-left:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-left:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-right' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Right */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-right:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-right:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-center' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Center */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-center:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		width: 100%;
		height: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-center:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		width: 100%;
		height: 100%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-diagonal' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Diagonal */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-diagonal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 260%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-diagonal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 260%;
	}
	<?php } ?>

	<?php if ( 'transparent-fill-horizontal' == $settings->transparent_button_options ) { ?>
	/* Fill Background From Horizontal */
	/* Button Text and Backgrund Hover Styles */

	.fl-node-<?php echo $id; ?> .uabb-btn-one.uabb-transparent-fill-horizontal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_one_back_hover_color ); ?>;
		height: 100%;
		width: 100%;
	}

	.fl-node-<?php echo $id; ?> .uabb-btn-two.uabb-transparent-fill-horizontal:hover:after {
		background: <?php echo uabb_theme_base_color( $settings->_btn_two_back_hover_color ); ?>;
		height: 100%;
		width: 100%;
	}
	<?php } ?>
<?php } ?>

/* Gradient Styles - Button Text and Backgrund Styles */
<?php if ( 'gradient' == $settings->dual_button_style ) { ?>
	<?php
	/* Calculate colors for gradient button one simple */
	$_btn_one_grad_back_color = uabb_theme_base_color( $settings->_btn_one_back_color );
	$_btn_one_bg_grad_start   = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $_btn_one_grad_back_color ), 30, 'lighten' );

	/* Calculate colors for gradient button one hover */
	if ( '' != $settings->_btn_one_back_hover_color ) {
		$_btn_one_bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->_btn_one_back_hover_color ), 30, 'lighten' );
	}

	/* Calculate colors for gradient button two simple */

	$_btn_two_grad_back_color = uabb_theme_base_color( $settings->_btn_two_back_color );
	$_btn_two_bg_grad_start   = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $_btn_two_grad_back_color ), 30, 'lighten' );

	/* Calculate colors for gradient button two hover */
	if ( '' != $settings->_btn_two_back_hover_color ) {
		$_btn_two_bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( $settings->_btn_two_back_hover_color ), 30, 'lighten' );
	}

	?>

.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-gradient {
	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%, <?php echo $_btn_one_grad_back_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_one_bg_grad_start; ?>), color-stop(100%,<?php echo $_btn_one_grad_back_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_one_bg_grad_start; ?> 0%,<?php echo $_btn_one_grad_back_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_one_bg_grad_start; ?>', endColorstr='<?php echo $_btn_one_grad_back_color; ?>',GradientType=0 );
}
.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-gradient {
	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%, <?php echo $_btn_two_grad_back_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_two_bg_grad_start; ?>), color-stop(100%,<?php echo $_btn_two_grad_back_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_two_bg_grad_start; ?> 0%,<?php echo $_btn_two_grad_back_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_two_bg_grad_start; ?>', endColorstr='<?php echo $_btn_two_grad_back_color; ?>',GradientType=0 );
}

	<?php if ( '' != $settings->_btn_one_back_hover_color ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-gradient:hover {

	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%, <?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_one_bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->_btn_one_back_hover_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_one_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_one_back_hover_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_one_bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->_btn_one_back_hover_color; ?>',GradientType=0 );
}
<?php } ?>

	<?php if ( '' != $settings->_btn_two_back_hover_color ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-gradient:hover {

	/* FF3.6+ */
	background: -moz-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%, <?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* Chrome,Safari4+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $_btn_two_bg_hover_grad_start; ?>), color-stop(100%,<?php echo $settings->_btn_two_back_hover_color; ?>));

	/* Chrome10+,Safari5.1+ */
	background: -webkit-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* Opera 11.10+ */
	background: -o-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* IE10+ */
	background: -ms-linear-gradient(top,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* W3C */
	background: linear-gradient(to bottom,  <?php echo $_btn_two_bg_hover_grad_start; ?> 0%,<?php echo $settings->_btn_two_back_hover_color; ?> 100%);

	/* IE6-9 */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $_btn_two_bg_hover_grad_start; ?>', endColorstr='<?php echo $settings->_btn_two_back_hover_color; ?>',GradientType=0 );
}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-gradient:hover .uabb-btn-one-text {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}

/* Code To change icon color on hover */
	<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-gradient:hover .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}
<?php } ?>
/* Code To change icon color on hover Ends */

.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-gradient:hover .uabb-btn-two-text {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}

/* Code To change icon color on hover Button Two*/
	<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-gradient:hover .uabb-icon i {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}
<?php } ?>
/* Code To change icon color on hover Button Two Ends */

<?php } ?>

/* Flat Styles - Button Text and Backgrund Styles */
<?php if ( 'flat' == $settings->dual_button_style ) { ?>

	<?php if ( 'animate_to_right' == $settings->flat_button_options ) { ?>
	/* Animate Icon To Right */
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-imgicon-wrap {
		left: 0;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-btn-two-text {
		-webkit-transform: translateX(200%);
		-moz-transform: translateX(200%);
		-ms-transform: translateX(200%);
		-o-transform: translateX(200%);
		transform: translateX(200%);
	}

	/* Code To change icon color on hover */
		<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_right:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
		<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_right:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

	<?php if ( 'animate_to_left' == $settings->flat_button_options ) { ?>
	/* Animate Icon To Left */
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-imgicon-wrap {
		right: 0;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-btn-two-text {
		-webkit-transform: translateX(-200%);
		-moz-transform: translateX(-200%);
		-ms-transform: translateX(-200%);
		-o-transform: translateX(-200%);
		transform: translateX(-200%);
	}

	/* Code To change icon color on hover */
		<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_to_left:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
		<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_to_left:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

	<?php if ( 'animate_from_top' == $settings->flat_button_options ) { ?>

	/* Animate Icon From Top */
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-imgicon-wrap {
		top: 0;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-btn-two-text {
		-webkit-transform: translateY(500px);
		-moz-transform: translateY(500px);
		-ms-transform: translateY(500px);
		-o-transform: translateY(500px);
		transform: translateY(500px);
	}

	/* Code To change icon color on hover */
		<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_top:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
		<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_top:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

	<?php if ( 'animate_from_bottom' == $settings->flat_button_options ) { ?>
	/* Animate Icon From Bottom */
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-imgicon-wrap,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-imgicon-wrap {
		bottom: 0;
	}
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-btn-one-text,
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-btn-two-text {
		-webkit-transform: translateY(-500px);
		-moz-transform: translateY(-500px);
		-ms-transform: translateY(-500px);
		-o-transform: translateY(-500px);
		transform: translateY(-500px);
	}

	/* Code To change icon color on hover */
		<?php if ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one.uabb-animate_from_bottom:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Ends */

	/* Code To change icon color on hover Button Two*/
		<?php if ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two.uabb-animate_from_bottom:hover .uabb-icon i {
		color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
	}
	<?php } ?>
	/* Code To change icon color on hover Button Two Ends */
<?php } ?>

<?php } ?>

/* Image Icon Styling */
<?php
if ( ( '' != $settings->image_type_btn_one || '' != $settings->image_type_btn_two ) && ( ( isset( $settings->photo_btn_one_src ) && '' != $settings->photo_btn_one_src ) || ( isset( $settings->icon_btn_one ) && '' != $settings->icon_btn_one ) || ( isset( $settings->photo_btn_two_src ) && '' != $settings->photo_btn_two_src ) || ( isset( $settings->icon_btn_two ) && '' != $settings->icon_btn_two ) ) ) {

	if ( isset( $settings->photo_btn_one_src ) ) {
		$photo_btn_one_src = $settings->photo_btn_one_src; } else {
		$photo_btn_one_src = ''; }

		if ( isset( $settings->photo_btn_two_src ) ) {
			$photo_btn_two_src = $settings->photo_btn_two_src; } else {
			$photo_btn_two_src = ''; }

			$btn_one_fl_id = $id . ' .uabb-btn-one-img-icon';
			$btn_two_fl_id = $id . ' .uabb-btn-two-img-icon';

			$btn_one_icon_color       = uabb_theme_button_text_color( $settings->_btn_one_text_color );
			$btn_two_icon_color       = uabb_theme_button_text_color( $settings->_btn_two_text_color );
			$btn_one_icon_hover_color = uabb_theme_button_text_color( $settings->_btn_one_text_hover_color );
			$btn_two_icon_hover_color = uabb_theme_button_text_color( $settings->_btn_two_text_hover_color );

			?>
	<?php if ( 'icon' == $settings->image_type_btn_one ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn-one-img-icon .uabb-icon i,
.fl-node-<?php echo $id; ?> .uabb-btn-one-img-icon .uabb-icon i:before {
	font-size: <?php echo $settings->img_icon_width_btn_one; ?>px;
	height: auto;
	width: auto;
	line-height: <?php echo $settings->img_icon_width_btn_one; ?>px;
	height: <?php echo $settings->img_icon_width_btn_one; ?>px;
	width: <?php echo $settings->img_icon_width_btn_one; ?>px;
	text-align: center;
}
<?php } elseif ( 'photo' == $settings->image_type_btn_one ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn-one-img-icon .uabb-img-src {
	width: <?php echo $settings->img_icon_width_btn_one; ?>px;
}
<?php } ?>

	<?php if ( 'icon' == $settings->image_type_btn_two ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn-two-img-icon .uabb-icon i,
.fl-node-<?php echo $id; ?> .uabb-btn-two-img-icon .uabb-icon i:before {
	font-size: <?php echo $settings->img_icon_width_btn_two; ?>px;
	height: auto;
	width: auto;
	line-height: <?php echo $settings->img_icon_width_btn_two; ?>px;
	height: <?php echo $settings->img_icon_width_btn_two; ?>px;
	width: <?php echo $settings->img_icon_width_btn_two; ?>px;
	text-align: center;
}

<?php } elseif ( 'photo' == $settings->image_type_btn_two ) { ?>
.fl-node-<?php echo $id; ?> .uabb-btn-two-img-icon .uabb-img-src {
	width: <?php echo $settings->img_icon_width_btn_two; ?>px;
}
<?php } ?>

	<?php
	if ( ( 'flat' == $settings->dual_button_style && 'none' == $settings->flat_button_options ) ||
	( 'gradient' == $settings->dual_button_style ) || ( 'transparent' == $settings->dual_button_style ) ) {
		?>

.fl-node-<?php echo $id; ?> .before.uabb-btn-one-img-icon,
.fl-node-<?php echo $id; ?> .before.uabb-btn-two-img-icon {
	margin-right: 10px;
}

.fl-node-<?php echo $id; ?> .after.uabb-btn-one-img-icon,
.fl-node-<?php echo $id; ?> .after.uabb-btn-two-img-icon {
	margin-left: 10px;
}
	<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-btn-one-img-icon .uabb-imgicon-wrap .uabb-icon i,
.fl-node-<?php echo $id; ?> .uabb-btn-two-img-icon .uabb-imgicon-wrap .uabb-icon i {
	background: none;
}

<?php } ?>

<?php
if ( 'horizontal' == $settings->dual_button_type && 'no' == $settings->join_buttons ) {
	?>

.fl-node-<?php echo $id; ?> .uabb-dual-button-one {
	margin-right: <?php echo $settings->spacing_between_buttons; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one,
.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	border-radius: <?php echo $settings->dual_button_radius; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_color ); ?>;
}
.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn-one:hover {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_one_text_hover_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn-two:hover {
	color: <?php echo uabb_theme_button_text_color( $settings->_btn_two_text_hover_color ); ?>;
}


	<?php
}
?>

/* Horizontal Responsive */
<?php if ( 'horizontal' == $settings->dual_button_type ) { ?>

	<?php if ( 'yes' == $settings->responive_dual_button ) { ?>
/*Responsive Horizontal Style */
@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

		<?php if ( 'full' == $settings->dual_button_width_type || 'custom' == $settings->dual_button_width_type ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-btn-horizontal {
			width: 100%;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-horizontal {
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.fl-node-<?php echo $id; ?> .uabb-dual-button .uabb-middle-text {
		top: 100%;
		left: 50%;
		right: auto;
		webkit-transform: translate(-50%,-50%);
		-moz-transform: translate(-50%,-50%);
		-o-transform: translate(-50%,-50%);
		-ms-transform: translate(-50%,-50%);
		transform: translate(-50%,-50%);
	}

	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one {
		border-top-left-radius: <?php echo $settings->dual_button_radius; ?>px;
		border-top-right-radius: <?php echo $settings->dual_button_radius; ?>px;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}
	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-bottom-left-radius: <?php echo $settings->dual_button_radius; ?>px;
		border-bottom-right-radius: <?php echo $settings->dual_button_radius; ?>px;
	}

		<?php if ( 'transparent' == $settings->dual_button_style ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one,
		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {

			border-width: <?php echo $settings->button_border_width; ?>px;
			border-style: <?php echo $settings->dual_button_border_style; ?>;
			border-color: <?php echo uabb_theme_base_color( $settings->button_border_color ); ?>;

		}
			<?php
			if ( 'horizontal' == $settings->dual_button_type && 'no' != $settings->join_buttons ) {
				?>
		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {
			border-top: 0;
		}
				<?php
			}
}
		?>

		<?php
		if ( 'horizontal' == $settings->dual_button_type && 'no' == $settings->join_buttons ) {
			?>
	.fl-node-<?php echo $id; ?> .uabb-dual-button-one {
		margin-right: 0;
		margin-bottom: <?php echo $settings->spacing_between_buttons; ?>px;
	}

	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-one,
	.fl-node-<?php echo $id; ?> .uabb-horizontal .uabb-btn.uabb-btn-two {
		border-radius: <?php echo $settings->dual_button_radius; ?>px;
	}
			<?php
		}
		?>
}
	<?php } ?>
<?php } ?>

<?php
/* Typography style starts here  */
if ( ! $version_bb_check ) {
	if ( 'Default' != $settings->_btn_one_font_family['family'] || isset( $settings->_btn_one_font_size['desktop'] ) || isset( $settings->_btn_one_line_height['desktop'] ) || isset( $settings->_btn_one_font_size_unit ) || isset( $settings->_btn_one_line_height_unit ) || isset( $settings->_btn_one_text_transform ) || isset( $settings->_btn_one_text_letter_spacing ) ) {
		?>

			.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one {

				<?php if ( 'Default' != $settings->_btn_one_font_family['family'] ) : ?>
					<?php UABB_Helper::uabb_font_css( $settings->_btn_one_font_family ); ?>
				<?php endif; ?>

				<?php if ( 'yes' === $converted || isset( $settings->_btn_one_font_size_unit ) && '' != $settings->_btn_one_font_size_unit ) { ?>
					font-size: <?php echo $settings->_btn_one_font_size_unit; ?>px;
				<?php } elseif ( isset( $settings->_btn_one_font_size_unit ) && '' == $settings->_btn_one_font_size_unit && isset( $settings->_btn_one_font_size['desktop'] ) && '' != $settings->_btn_one_font_size['desktop'] ) { ?>
					font-size: <?php echo $settings->_btn_one_font_size['desktop']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->_btn_one_font_size['desktop'] ) && '' == $settings->_btn_one_font_size['desktop'] && isset( $settings->_btn_one_line_height['desktop'] ) && '' != $settings->_btn_one_line_height['desktop'] && '' == $settings->_btn_one_line_height_unit ) { ?>
					line-height: <?php echo $settings->_btn_one_line_height['desktop']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->_btn_one_line_height_unit ) && '' != $settings->_btn_one_line_height_unit ) { ?>
					line-height: <?php echo $settings->_btn_one_line_height_unit; ?>em;
				<?php } elseif ( isset( $settings->_btn_one_line_height_unit ) && '' == $settings->_btn_one_line_height_unit && isset( $settings->_btn_one_line_height['desktop'] ) && '' != $settings->_btn_one_line_height['desktop'] ) { ?>
					line-height: <?php echo $settings->_btn_one_line_height['desktop']; ?>px;
				<?php } ?>

				<?php if ( 'none' != $settings->_btn_one_text_transform ) : ?>
					text-transform: <?php echo $settings->_btn_one_text_transform; ?>;
				<?php endif; ?>

				<?php if ( '' != $settings->_btn_one_text_letter_spacing ) : ?>
					letter-spacing: <?php echo $settings->_btn_one_text_letter_spacing; ?>px;
				<?php endif; ?>
			}
	<?php } ?>
	<?php
} else {
	if ( 'default' === $settings->dual_button_style ) {

		$_btn_one_typo                      = uabb_theme_button_typography( $settings->_btn_one_typo );
		$settings->_btn_one_typo            = ( array_key_exists( 'desktop', $_btn_one_typo ) ) ? $_btn_one_typo['desktop'] : $settings->_btn_one_typo;
		$settings->_btn_one_typo_medium     = ( array_key_exists( 'tablet', $_btn_one_typo ) ) ? $_btn_one_typo['tablet'] : $settings->_btn_one_typo_medium;
		$settings->_btn_one_typo_responsive = ( array_key_exists( 'mobile', $_btn_one_typo ) ) ? $_btn_one_typo['mobile'] : $settings->_btn_one_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => '_btn_one_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-btn-one-text",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	<?php
	if ( 'Default' != $settings->_btn_two_font_family['family'] || isset( $settings->_btn_two_font_size['desktop'] ) || isset( $settings->_btn_two_line_height['desktop'] ) || isset( $settings->_btn_two_font_size_unit ) || isset( $settings->_btn_two_line_height_unit ) || isset( $settings->_btn_two_text_transform ) || isset( $settings->_btn_two_text_letter_spacing ) ) {
		?>

		.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {

			<?php if ( 'Default' != $settings->_btn_two_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->_btn_two_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->_btn_two_font_size_unit ) && '' != $settings->_btn_two_font_size_unit ) { ?>
				font-size: <?php echo $settings->_btn_two_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->_btn_two_font_size_unit ) && '' == $settings->_btn_two_font_size_unit && isset( $settings->_btn_two_font_size['desktop'] ) && '' != $settings->_btn_two_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->_btn_two_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->_btn_two_font_size['desktop'] ) && '' == $settings->_btn_two_font_size['desktop'] && isset( $settings->_btn_two_line_height['desktop'] ) && '' != $settings->_btn_two_line_height['desktop'] && '' == $settings->_btn_two_line_height_unit ) { ?>
				line-height: <?php echo $settings->_btn_two_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->_btn_two_line_height_unit ) && '' != $settings->_btn_two_line_height_unit ) { ?>
				line-height: <?php echo $settings->_btn_two_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->_btn_two_line_height_unit ) && '' == $settings->_btn_two_line_height_unit && isset( $settings->_btn_two_line_height['desktop'] ) && '' != $settings->_btn_two_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->_btn_two_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->_btn_two_text_transform ) : ?>
				text-transform: <?php echo $settings->_btn_two_text_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->_btn_two_text_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->_btn_two_text_letter_spacing; ?>px;
			<?php endif; ?>
		}

	<?php } ?>
	<?php
} else {
	if ( 'default' === $settings->dual_button_style ) {

		$_btn_two_typo = uabb_theme_button_typography( $settings->_btn_two_typo );

		$settings->_btn_two_typo            = ( array_key_exists( 'desktop', $_btn_two_typo ) ) ? $_btn_two_typo['desktop'] : $settings->_btn_two_typo;
		$settings->_btn_two_typo_medium     = ( array_key_exists( 'tablet', $_btn_two_typo ) ) ? $_btn_two_typo['tablet'] : $settings->_btn_two_typo_medium;
		$settings->_btn_two_typo_responsive = ( array_key_exists( 'mobile', $_btn_two_typo ) ) ? $_btn_two_typo['mobile'] : $settings->_btn_two_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => '_btn_two_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-btn-two-text",
			)
		);
	}
}
?>

/* Typography responsive layout starts here */

	<?php
	if ( $global_settings->responsive_enabled ) {
		// Global Setting If started.
		if ( ! $version_bb_check ) {
			if ( isset( $settings->_btn_one_font_size['medium'] ) || isset( $settings->_btn_one_line_height['medium'] ) || isset( $settings->_btn_two_font_size['medium'] ) || isset( $settings->_btn_two_line_height['medium'] ) || isset( $settings->_divider_font_size['medium'] ) || isset( $settings->_btn_one_font_size_unit_medium ) || isset( $settings->_btn_one_line_height_unit_medium ) || isset( $settings->_btn_two_font_size_unit_medium ) || isset( $settings->_btn_two_line_height_unit_medium ) || isset( $settings->_divider_font_size_unit_medium ) || isset( $settings->_btn_one_line_height_unit ) || isset( $settings->_btn_two_line_height_unit ) ) {
				?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

				<?php if ( isset( $settings->_btn_one_font_size['medium'] ) && '' != $settings->_btn_one_font_size['medium'] || isset( $settings->_btn_one_line_height['medium'] ) && '' != $settings->_btn_one_line_height['medium'] || isset( $settings->_btn_one_font_size_unit_medium ) || isset( $settings->_btn_one_line_height_unit_medium ) || isset( $settings->_btn_one_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one {

						<?php if ( 'yes' === $converted || isset( $settings->_btn_one_font_size_unit_medium ) && '' != $settings->_btn_one_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->_btn_one_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->_btn_one_font_size_unit_medium ) && '' == $settings->_btn_one_font_size_unit_medium && isset( $settings->_btn_one_font_size['medium'] ) && '' != $settings->_btn_one_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->_btn_one_font_size['medium']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->_btn_one_font_size['medium'] ) && '' == $settings->_btn_one_font_size['medium'] && isset( $settings->_btn_one_line_height['medium'] ) && '' != $settings->_btn_one_line_height['medium'] && '' == $settings->_btn_one_line_height_unit_medium && '' == $settings->_btn_one_line_height_unit ) { ?>
							line-height: <?php echo $settings->_btn_one_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->_btn_one_line_height_unit_medium ) && '' != $settings->_btn_one_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->_btn_one_line_height_unit_medium; ?>em;
						<?php } elseif ( isset( $settings->_btn_one_line_height_unit_medium ) && '' == $settings->_btn_one_line_height_unit_medium && isset( $settings->_btn_one_line_height['medium'] ) && '' != $settings->_btn_one_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->_btn_one_line_height['medium']; ?>px;
						<?php } ?>
					}
				<?php } ?>

				<?php if ( isset( $settings->_btn_two_font_size['medium'] ) && '' != $settings->_btn_two_font_size['medium'] || isset( $settings->_btn_two_line_height['medium'] ) || isset( $settings->_btn_two_font_size_unit_medium ) || isset( $settings->_btn_two_line_height_unit_medium ) || isset( $settings->_btn_two_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {

						<?php if ( 'yes' === $converted || isset( $settings->_btn_two_font_size_unit_medium ) && '' != $settings->_btn_two_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->_btn_two_font_size_unit_medium; ?>px;
						<?php } elseif ( $settings->_btn_two_font_size_unit_medium && '' == $settings->_btn_two_font_size_unit_medium && isset( $settings->_btn_two_font_size['medium'] ) && '' != $settings->_btn_two_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->_btn_two_font_size['medium']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->_btn_two_font_size['medium'] ) && '' == $settings->_btn_two_font_size['medium'] && isset( $settings->_btn_two_line_height['medium'] ) && '' != $settings->_btn_two_line_height['medium'] && '' == $settings->_btn_two_line_height_unit_medium && '' == $settings->_btn_two_line_height_unit ) { ?>
							line-height: <?php echo $settings->_btn_two_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->_btn_two_line_height_unit_medium ) && '' != $settings->_btn_two_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->_btn_two_line_height_unit_medium; ?>em;
						<?php } elseif ( isset( $settings->_btn_two_line_height_unit_medium ) && '' == $settings->_btn_two_line_height_unit_medium && isset( $settings->_btn_two_line_height['medium'] ) && '' != $settings->_btn_two_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->_btn_two_line_height['medium']; ?>px;
						<?php } ?>
					}
				<?php } ?>

				<?php if ( isset( $settings->_divider_font_size['medium'] ) && '' != $settings->_divider_font_size['medium'] || '' != $settings->_divider_font_size_unit_medium ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-middle-text {
						<?php if ( 'text' == $settings->divider_options && isset( $settings->_divider_font_size['medium'] ) && '' != $settings->_divider_font_size['medium'] || '' != $settings->_divider_font_size_unit_medium ) { ?>

							<?php if ( isset( $settings->_divider_font_size_unit_medium ) ) { ?>
								font-size: <?php echo $settings->_divider_font_size_unit_medium; ?>px;
								width: <?php echo $settings->_divider_font_size_unit_medium * 1.75; ?>px;
								height: <?php echo $settings->_divider_font_size_unit_medium * 1.75; ?>px;
								line-height: <?php echo $settings->_divider_font_size_unit_medium * 1.75; ?>px;
							<?php } else { ?>
								font-size: <?php echo $settings->_divider_font_size['medium']; ?>px;
								width: <?php echo $settings->_divider_font_size['medium'] * 1.75; ?>px;
								height: <?php echo $settings->_divider_font_size['medium'] * 1.75; ?>px;
								line-height: <?php echo $settings->_divider_font_size['medium'] * 1.75; ?>px;
							<?php } ?>

						<?php } ?>
					}
				<?php } ?>
			}
				<?php
			}

			if ( isset( $settings->_btn_one_font_size['small'] ) || isset( $settings->_btn_one_line_height['small'] ) || isset( $settings->_btn_two_font_size['small'] ) || isset( $settings->_btn_two_line_height['small'] ) || isset( $settings->_divider_font_size['small'] ) || isset( $settings->_btn_one_font_size_unit_responsive ) || isset( $settings->_btn_one_line_height_unit_responsive ) || isset( $settings->_btn_one_line_height_unit_medium ) || isset( $settings->_btn_one_line_height_unit ) || isset( $settings->_btn_two_font_size_unit_responsive ) || isset( $settings->_btn_two_line_height_unit_responsive ) || isset( $settings->_divider_font_size_unit_responsive ) || isset( $settings->_btn_two_line_height_unit_medium ) || isset( $settings->_btn_two_line_height_unit ) ) {
				?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

				<?php if ( isset( $settings->_btn_one_font_size['small'] ) || isset( $settings->_btn_one_line_height['small'] ) || isset( $settings->_btn_one_font_size_unit_responsive ) || isset( $settings->_btn_one_line_height_unit_responsive ) || isset( $settings->_btn_one_line_height_unit_medium ) || isset( $settings->_btn_one_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-one {

						<?php if ( 'yes' === $converted || isset( $settings->_btn_one_font_size_unit_responsive ) && '' != $settings->_btn_one_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->_btn_one_font_size_unit_responsive; ?>px;
						<?php } elseif ( $settings->_btn_one_font_size_unit_responsive && '' == $settings->_btn_one_font_size_unit_responsive && isset( $settings->_btn_one_font_size['small'] ) && '' != $settings->_btn_one_font_size['small'] ) { ?>
							font-size: <?php echo $settings->_btn_one_font_size['small']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->_btn_one_font_size['small'] ) && '' == $settings->_btn_one_font_size['small'] && isset( $settings->_btn_one_line_height['small'] ) && '' != $settings->_btn_one_line_height['small'] && '' == $settings->_btn_one_line_height_unit_responsive && '' == $settings->_btn_one_line_height_unit_medium && '' == $settings->_btn_one_line_height_unit ) : ?>
							line-height: <?php echo $settings->_btn_one_line_height['small']; ?>px;
						<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->_btn_one_line_height_unit_responsive ) && '' != $settings->_btn_one_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->_btn_one_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->_btn_one_line_height_unit_responsive ) && '' == $settings->_btn_one_line_height_unit_responsive && isset( $settings->_btn_one_line_height['small'] ) && '' != $settings->_btn_one_line_height['small'] ) { ?>
							line-height: <?php echo $settings->_btn_one_line_height['small']; ?>px;
						<?php } ?>

					}
				<?php } ?>

				<?php if ( isset( $settings->_btn_two_font_size['small'] ) || isset( $settings->_btn_two_line_height['small'] ) || isset( $settings->_btn_two_font_size_unit_responsive ) || isset( $settings->_btn_two_line_height_unit_responsive ) || isset( $settings->_btn_two_line_height_unit_medium ) || isset( $settings->_btn_two_line_height_unit ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-btn.uabb-btn-two {

						<?php if ( 'yes' === $converted || isset( $settings->_btn_two_font_size_unit_responsive ) && '' != $settings->_btn_two_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->_btn_two_font_size_unit_responsive; ?>px;
						<?php } elseif ( $settings->_btn_two_font_size_unit_responsive && '' == $settings->_btn_two_font_size_unit_responsive && isset( $settings->_btn_two_font_size['small'] ) && '' != $settings->_btn_two_font_size['small'] ) { ?>
							font-size: <?php echo $settings->_btn_two_font_size['small']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->_btn_two_font_size['small'] ) && '' == $settings->_btn_two_font_size['small'] && isset( $settings->_btn_two_line_height['small'] ) && '' != $settings->_btn_two_line_height['small'] && '' == $settings->_btn_two_line_height_unit_responsive && '' == $settings->_btn_two_line_height_unit_medium && '' == $settings->_btn_two_line_height_unit ) : ?>
							line-height: <?php echo $settings->_btn_two_line_height['small']; ?>px;
						<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->_btn_two_line_height_unit_responsive ) && '' != $settings->_btn_two_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->_btn_two_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->_btn_two_line_height_unit_responsive ) && '' == $settings->_btn_two_line_height_unit_responsive && isset( $settings->_btn_two_line_height['small'] ) && '' != $settings->_btn_two_line_height['small'] ) { ?>
							line-height: <?php echo $settings->_btn_two_line_height['small']; ?>px;
						<?php } ?>
						}
				<?php } ?>
				<?php if ( isset( $settings->_divider_font_size['small'] ) && '' != $settings->_divider_font_size['small'] || '' != $settings->_divider_font_size_unit_responsive ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-middle-text {
					<?php if ( 'text' == $settings->divider_options && isset( $settings->_divider_font_size['small'] ) && '' != $settings->_divider_font_size['small'] || '' != $settings->_divider_font_size_unit_responsive ) { ?>

						<?php if ( isset( $settings->_divider_font_size_unit_responsive ) ) { ?>
							font-size: <?php echo $settings->_divider_font_size_unit_responsive; ?>px;
							width: <?php echo $settings->_divider_font_size_unit_responsive * 1.75; ?>px;
							height: <?php echo $settings->_divider_font_size_unit_responsive * 1.75; ?>px;
							line-height: <?php echo $settings->_divider_font_size_unit_responsive * 1.75; ?>px;
						<?php } else { ?>
							font-size: <?php echo $settings->_divider_font_size['small']; ?>px;
							width: <?php echo $settings->_divider_font_size['small'] * 1.75; ?>px;
							height: <?php echo $settings->_divider_font_size['small'] * 1.75; ?>px;
							line-height: <?php echo $settings->_divider_font_size['small'] * 1.75; ?>px;
						<?php } ?>

					<?php } ?>
				}
			<?php } ?>				
			}
				<?php
			}
		} else {
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
				<?php if ( isset( $settings->_divider_typo_medium['font_size']['length'] ) && is_numeric( $settings->_divider_typo_medium['font_size']['length'] ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-middle-text {
						width: <?php echo $settings->_divider_typo_medium['font_size']['length'] * 1.75; ?>px;
						height: <?php echo $settings->_divider_typo_medium['font_size']['length'] * 1.75; ?>px;
						line-height: <?php echo $settings->_divider_typo_medium['font_size']['length'] * 1.75; ?>px;
					}
				<?php } ?>
			}
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				<?php if ( isset( $settings->_divider_typo_responsive['font_size']['length'] ) && is_numeric( $settings->_divider_typo_responsive['font_size']['length'] ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-middle-text {
						width: <?php echo $settings->_divider_typo_responsive['font_size']['length'] * 1.75; ?>px;
						height: <?php echo $settings->_divider_typo_responsive['font_size']['length'] * 1.75; ?>px;
						line-height: <?php echo $settings->_divider_typo_responsive['font_size']['length'] * 1.75; ?>px;
					}
				<?php } ?>
			}
			<?php
		}
	}
	?>
/* Typography responsive layout Ends here */
