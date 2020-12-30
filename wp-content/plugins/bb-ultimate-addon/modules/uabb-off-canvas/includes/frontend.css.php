<?php
/**
 * Off Canvas Module front-end CSS php file
 *
 * @package Off Canvas Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
if ( method_exists( 'FLBuilder', 'fa5_pro_enabled' ) ) {
	if ( FLBuilder::fa5_pro_enabled() ) {
		$font_family = 'Font Awesome 5 Pro';
	} else {
		$font_family = 'Font Awesome 5 Free';
	}
} else {
	$font_family = 'Font Awesome 5 Free';
}

$settings->page_overlay        = UABB_Helper::uabb_colorpicker( $settings, 'page_overlay', true );
$settings->menu_color          = UABB_Helper::uabb_colorpicker( $settings, 'menu_color', true );
$settings->menu_color_hover    = UABB_Helper::uabb_colorpicker( $settings, 'menu_color_hover', true );
$settings->offcanvas_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'offcanvas_bg_color', true );
$settings->icon_color          = UABB_Helper::uabb_colorpicker( $settings, 'icon_color', true );
$settings->close_icon_color    = UABB_Helper::uabb_colorpicker( $settings, 'close_icon_color', true );
$settings->close_icon_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'close_icon_bg_color', true );
$settings->text_color          = UABB_Helper::uabb_colorpicker( $settings, 'text_color', true );
$settings->text_hover_color    = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color', true );
$settings->content_color       = UABB_Helper::uabb_colorpicker( $settings, 'content_color', true );
$settings->content_color_hover = UABB_Helper::uabb_colorpicker( $settings, 'content_color_hover', true );
$settings->menu_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'menu_bg_color', true );
$settings->menu_bg_color_hover = UABB_Helper::uabb_colorpicker( $settings, 'menu_bg_color_hover', true );
$settings->icon_hover_color    = UABB_Helper::uabb_colorpicker( $settings, 'icon_hover_color', true );
$settings->icon_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'icon_bg_color', true );
$settings->icon_bg_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'icon_bg_hover_color', true );
$settings->img_bg_color        = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
$settings->img_bg_hover_color  = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_hover_color', true );
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close .uabb-offcanvas-close-icon {
	<?php
	if ( isset( $settings->close_icon_size ) ) {
		echo ( '' !== $settings->close_icon_size ) ? 'font-size:' . esc_attr( $settings->close_icon_size ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_color ) ) {
		echo ( '' !== $settings->close_icon_color ) ? 'color:' . esc_attr( $settings->close_icon_color ) . ';' : '';
	}
	?>
}
<?php if ( isset( $settings->offcanvas_width ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas {
		<?php echo ( '' !== $settings->offcanvas_width ) ? 'width:' . esc_attr( $settings->offcanvas_width ) . esc_attr( $settings->offcanvas_width_unit ) : ''; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-left {
		<?php echo ( '' !== $settings->offcanvas_width ) ? 'left: -' . esc_attr( $settings->offcanvas_width ) . esc_attr( $settings->offcanvas_width_unit ) : ''; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-right {
		<?php echo ( '' !== $settings->offcanvas_width ) ? 'right: -' . esc_attr( $settings->offcanvas_width ) . esc_attr( $settings->offcanvas_width_unit ) : ''; ?>
	}
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap {
	<?php
	if ( isset( $settings->all_align ) ) {
		echo ( '' !== $settings->all_align ) ? 'text-align:' . esc_attr( $settings->all_align ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap .uabb-offcanvas-photo {
	<?php
	if ( isset( $settings->img_size ) ) {
		echo ( '' !== $settings->img_size ) ? 'width:' . esc_attr( $settings->img_size ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap {
	<?php
	if ( isset( $settings->text_color ) ) {
		echo ( '' !== $settings->text_color ) ? 'color:' . esc_attr( $settings->text_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap:hover {
	<?php
	if ( isset( $settings->text_hover_color ) ) {
		echo ( '' !== $settings->text_hover_color ) ? 'color:' . esc_attr( $settings->text_hover_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-content {
	<?php
	if ( isset( $settings->content_align ) ) {
		echo ( '' !== $settings->content_align ) ? 'text-align:' . esc_attr( $settings->content_align ) . ';' : '';
	}
	if ( isset( $settings->content_color ) ) {
		echo ( '' !== $settings->content_color ) ? 'color:' . esc_attr( $settings->content_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-content:hover {
	<?php
	if ( isset( $settings->content_color_hover ) ) {
		echo ( '' !== $settings->content_color_hover ) ? 'color:' . esc_attr( $settings->content_color_hover ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap .uabb-offcanvas-icon {
	<?php
	if ( isset( $settings->icon_size ) ) {
		echo ( '' !== $settings->icon_size ) ? 'font-size:' . esc_attr( $settings->icon_size ) . 'px;' : '';
	}
	if ( isset( $settings->icon_color ) ) {
		echo ( '' !== $settings->icon_color ) ? 'color:' . esc_attr( $settings->icon_color ) . ';' : '';
	}
	if ( isset( $settings->icon_bg_color ) ) {
		echo ( '' !== $settings->icon_bg_color ) ? 'background:' . esc_attr( $settings->icon_bg_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap .uabb-offcanvas-icon:hover {
	<?php
	if ( isset( $settings->icon_hover_color ) ) {
		echo ( '' !== $settings->icon_hover_color ) ? 'color:' . esc_attr( $settings->icon_hover_color ) . ';' : '';
	}
	if ( isset( $settings->icon_bg_hover_color ) ) {
		echo ( '' !== $settings->icon_bg_hover_color ) ? 'background:' . esc_attr( $settings->icon_bg_hover_color ) . ';' : '';
	}
	?>
}
<?php
if ( isset( $settings->page_overlay ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-overlay {
		<?php
			echo ( '' !== $settings->page_overlay ) ? 'background:' . esc_attr( $settings->page_overlay ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->menu_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a {
	<?php echo ( '' !== $settings->menu_color ) ? 'color:' . esc_attr( $settings->menu_color ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->menu_color_hover ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a:hover {
	<?php echo ( '' !== $settings->menu_color_hover ) ? 'color:' . esc_attr( $settings->menu_color_hover ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->menu_bgcolor_hover ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a:hover {
	<?php echo ( '' !== $settings->menu_bgcolor_hover ) ? 'background-color:' . esc_attr( $settings->menu_bgcolor_hover ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->offcanvas_bg_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas {
	<?php echo ( '' !== $settings->offcanvas_bg_color ) ? 'background-color:' . esc_attr( $settings->offcanvas_bg_color ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->menu_bg_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a {
	<?php echo ( '' !== $settings->menu_bg_color ) ? 'background-color:' . esc_attr( $settings->menu_bg_color ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->menu_bg_color_hover ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a:hover {
	<?php echo ( '' !== $settings->menu_bg_color_hover ) ? 'background-color:' . esc_attr( $settings->menu_bg_color_hover ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->img_bg_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap .uabb-offcanvas-photo-content {
	<?php echo ( '' !== $settings->img_bg_color ) ? 'background-color:' . esc_attr( $settings->img_bg_color ) . ';' : ''; ?>
	}
	<?php
}
if ( isset( $settings->img_bg_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap .uabb-offcanvas-photo-content:hover {
	<?php echo ( '' !== $settings->img_bg_hover_color ) ? 'background-color:' . esc_attr( $settings->img_bg_hover_color ) . ';' : ''; ?>
	}
	<?php
}
if ( 'button' === $settings->offcanvas_on ) {
	$btn_settings = array(

		/* General Section */
		'text'                                       => $settings->btn_text,

		/* Link Section */
		'link'                                       => '',
		'link_target'                                => '',

		/* Style Section */
		'style'                                      => $settings->btn_style,
		'border_size'                                => $settings->btn_border_size,
		'transparent_button_options'                 => $settings->btn_transparent_button_options,
		'threed_button_options'                      => $settings->btn_threed_button_options,

		/* Colors */
		'bg_color'                                   => $settings->btn_bg_color,
		'bg_hover_color'                             => $settings->btn_bg_hover_color,
		'text_color'                                 => $settings->btn_text_color,
		'text_hover_color'                           => $settings->btn_text_hover_color,

		/* Icon */
		'icon'                                       => $settings->btn_icon,
		'icon_position'                              => $settings->btn_icon_position,

		/* Structure */
		'width'                                      => $settings->btn_width,
		'custom_width'                               => $settings->btn_custom_width,
		'custom_height'                              => $settings->btn_custom_height,
		'padding_top_bottom'                         => $settings->btn_padding_top_bottom,
		'padding_left_right'                         => $settings->btn_padding_left_right,
		'border_radius'                              => $settings->btn_border_radius,
		'align'                                      => $settings->btn_align,
		'mob_align'                                  => $settings->btn_mob_align,
		'button_padding_dimension_top'               => ( isset( $settings->button_padding_dimension_top ) ) ? $settings->button_padding_dimension_top : '',
		'button_padding_dimension_left'              => ( isset( $settings->button_padding_dimension_left ) ) ? $settings->button_padding_dimension_left : '',
		'button_padding_dimension_bottom'            => ( isset( $settings->button_padding_dimension_bottom ) ) ? $settings->button_padding_dimension_bottom : '',
		'button_padding_dimension_right'             => ( isset( $settings->button_padding_dimension_right ) ) ? $settings->button_padding_dimension_right : '',
		'button_padding_dimension_top_medium'        => ( isset( $settings->button_padding_dimension_top_medium ) ) ? $settings->button_padding_dimension_top_medium : '',
		'button_padding_dimension_left_medium'       => ( isset( $settings->button_padding_dimension_left_medium ) ) ? $settings->button_padding_dimension_left_medium : '',
		'button_padding_dimension_bottom_medium'     => ( isset( $settings->button_padding_dimension_bottom_medium ) ) ? $settings->button_padding_dimension_bottom_medium : '',
		'button_padding_dimension_right_medium'      => ( isset( $settings->button_padding_dimension_right_medium ) ) ? $settings->button_padding_dimension_right_medium : '',
		'button_padding_dimension_top_responsive'    => ( isset( $settings->button_padding_dimension_top_responsive ) ) ? $settings->button_padding_dimension_top_responsive : '',
		'button_padding_dimension_left_responsive'   => ( isset( $settings->button_padding_dimension_left_responsive ) ) ? $settings->button_padding_dimension_left_responsive : '',
		'button_padding_dimension_bottom_responsive' => ( isset( $settings->button_padding_dimension_bottom_responsive ) ) ? $settings->button_padding_dimension_bottom_responsive : '',
		'button_padding_dimension_right_responsive'  => ( isset( $settings->button_padding_dimension_right_responsive ) ) ? $settings->button_padding_dimension_right_responsive : '',
		'button_border'                              => ( isset( $settings->button_border ) ) ? $settings->button_border : '',
		'border_hover_color'                         => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',
	);
	/* CSS Render Function */
	FLBuilder::render_module_css( 'uabb-button', $id, $btn_settings );
}
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap {
		<?php
		if ( 'Default' !== $settings->title_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->title_font_family );
		}
		if ( isset( $settings->title_font_size ) ) {
			echo ( '' !== $settings->title_font_size ) ? 'font-size:' . esc_attr( $settings->title_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->title_line_height ) ) {
			echo ( '' !== $settings->title_line_height ) ? 'line-height:' . esc_attr( $settings->title_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->title_transform ) ) {
			echo ( '' !== $settings->title_transform ) ? 'text-transform:' . esc_attr( $settings->title_transform ) . ';' : '';
		}
		if ( isset( $settings->title_letter_spacing ) ) {
			echo ( '' !== $settings->title_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->title_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_typo',
				'selector'     => ".fl-node-$id .uabb-offcanvas-text-wrap",
			)
		);
	}
}
// Button Typography.
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button:visited {
		<?php
		if ( 'Default' !== $settings->btn_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->btn_font_family );
		}
		if ( isset( $settings->btn_font_size ) ) {
			echo ( '' !== $settings->btn_font_size ) ? 'font-size:' . esc_attr( $settings->btn_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->btn_line_height ) ) {
			echo ( '' !== $settings->btn_line_height ) ? 'line-height:' . esc_attr( $settings->btn_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->btn_transform ) ) {
			echo ( '' !== $settings->btn_transform ) ? 'text-transform:' . esc_attr( $settings->btn_transform ) . ';' : '';
		}
		if ( isset( $settings->btn_letter_spacing ) ) {
			echo ( '' !== $settings->btn_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->btn_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( 'default' === $settings->btn_style ) {
		$button_typo = uabb_theme_button_typography( $settings->btn_typo );

		$settings->btn_typo            = ( array_key_exists( 'desktop', $button_typo ) ) ? $button_typo['desktop'] : $settings->btn_typo;
		$settings->btn_typo_medium     = ( array_key_exists( 'tablet', $button_typo ) ) ? $button_typo['tablet'] : $settings->btn_typo_medium;
		$settings->btn_typo_responsive = ( array_key_exists( 'mobile', $button_typo ) ) ? $button_typo['mobile'] : $settings->btn_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'btn_typo',
				'selector'     => ".fl-node-$id .uabb-creative-button-wrap .uabb-button,.fl-node-$id .uabb-creative-button-wrap .uabb-button:visited",
			)
		);
	}
}
?>
<?php
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-content {
		<?php
		if ( 'Default' !== $settings->content_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->content_font_family );
		}
		if ( isset( $settings->content_font_size ) ) {
			echo ( '' !== $settings->content_font_size ) ? 'font-size:' . esc_attr( $settings->content_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->content_line_height ) ) {
			echo ( '' !== $settings->content_line_height ) ? 'line-height:' . esc_attr( $settings->content_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->content_transform ) ) {
			echo ( '' !== $settings->content_transform ) ? 'text-transform:' . esc_attr( $settings->content_transform ) . ';' : '';
		}
		if ( isset( $settings->content_letter_spacing ) ) {
			echo ( '' !== $settings->content_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->content_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'content_typo',
				'selector'     => ".fl-node-$id .uabb-offcanvas-$id .uabb-offcanvas-text-content",
			)
		);
	}
}
?>
<?php
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu {
		<?php
		if ( 'Default' !== $settings->menu_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->menu_font_family );
		}
		if ( isset( $settings->menu_font_size ) ) {
			echo ( '' !== $settings->menu_font_size ) ? 'font-size:' . esc_attr( $settings->menu_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->menu_line_height ) ) {
			echo ( '' !== $settings->menu_line_height ) ? 'line-height:' . esc_attr( $settings->menu_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->menu_transform ) ) {
			echo ( '' !== $settings->menu_transform ) ? 'text-transform:' . esc_attr( $settings->menu_transform ) . ';' : '';
		}
		if ( isset( $settings->menu_letter_spacing ) ) {
			echo ( '' !== $settings->menu_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->menu_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'menu_typo',
				'selector'     => ".fl-node-$id .uabb-offcanvas-menu",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap .uabb-offcanvas-photo-content {
	<?php
	if ( isset( $settings->img_padding ) ) {
		echo ( '' !== $settings->img_padding ) ? 'padding:' . esc_attr( $settings->img_padding ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap .uabb-offcanvas-icon {
	<?php
	if ( isset( $settings->icon_padding_top ) ) {
		echo ( '' !== $settings->icon_padding_top ) ? 'padding-top:' . esc_attr( $settings->icon_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->icon_padding_left ) ) {
		echo ( '' !== $settings->icon_padding_left ) ? 'padding-left:' . esc_attr( $settings->icon_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->icon_padding_right ) ) {
		echo ( '' !== $settings->icon_padding_right ) ? 'padding-right:' . esc_attr( $settings->icon_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->icon_padding_bottom ) ) {
		echo ( '' !== $settings->icon_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->icon_padding_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a {
	<?php
	if ( isset( $settings->menu_padding_top ) ) {
		echo ( '' !== $settings->menu_padding_top ) ? 'padding-top:' . esc_attr( $settings->menu_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->menu_padding_left ) ) {
		echo ( '' !== $settings->menu_padding_left ) ? 'padding-left:' . esc_attr( $settings->menu_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->menu_padding_right ) ) {
		echo ( '' !== $settings->menu_padding_right ) ? 'padding-right:' . esc_attr( $settings->menu_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->menu_padding_bottom ) ) {
		echo ( '' !== $settings->menu_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->menu_padding_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content .uabb-offcanvas-menu li {
	<?php
	if ( isset( $settings->menu_margin_top ) ) {
		echo ( '' !== $settings->menu_margin_top ) ? 'margin-top:' . esc_attr( $settings->menu_margin_top ) . 'px;' : '';
	}
	if ( isset( $settings->menu_margin_left ) ) {
		echo ( '' !== $settings->menu_margin_left ) ? 'margin-left:' . esc_attr( $settings->menu_margin_left ) . 'px;' : '';
	}
	if ( isset( $settings->menu_margin_right ) ) {
		echo ( '' !== $settings->menu_margin_right ) ? 'margin-right:' . esc_attr( $settings->menu_margin_right ) . 'px;' : '';
	}
	if ( isset( $settings->menu_margin_bottom ) ) {
		echo ( '' !== $settings->menu_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->menu_margin_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content {
	<?php
	if ( isset( $settings->offcanvas_spacing_top ) ) {
		echo ( '' !== $settings->offcanvas_spacing_top ) ? 'padding-top:' . esc_attr( $settings->offcanvas_spacing_top ) . 'px;' : '';
	}
	if ( isset( $settings->offcanvas_spacing_left ) ) {
		echo ( '' !== $settings->offcanvas_spacing_left ) ? 'padding-left:' . esc_attr( $settings->offcanvas_spacing_left ) . 'px;' : '';
	}
	if ( isset( $settings->offcanvas_spacing_right ) ) {
		echo ( '' !== $settings->offcanvas_spacing_right ) ? 'padding-right:' . esc_attr( $settings->offcanvas_spacing_right ) . 'px;' : '';
	}
	if ( isset( $settings->offcanvas_spacing_bottom ) ) {
		echo ( '' !== $settings->offcanvas_spacing_bottom ) ? 'padding-bottom:' . esc_attr( $settings->offcanvas_spacing_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
	<?php
	if ( isset( $settings->close_icon_padding_top ) ) {
		echo ( '' !== $settings->close_icon_padding_top ) ? 'padding-top:' . esc_attr( $settings->close_icon_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_padding_left ) ) {
		echo ( '' !== $settings->close_icon_padding_left ) ? 'padding-left:' . esc_attr( $settings->close_icon_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_padding_right ) ) {
		echo ( '' !== $settings->close_icon_padding_right ) ? 'padding-right:' . esc_attr( $settings->close_icon_padding_right ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_padding_bottom ) ) {
		echo ( '' !== $settings->close_icon_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->close_icon_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_bg_color ) ) {
		echo ( '' !== $settings->close_icon_bg_color ) ? 'background:' . esc_attr( $settings->close_icon_bg_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
	<?php
	if ( isset( $settings->close_icon_margin_top ) ) {
		echo ( '' !== $settings->close_icon_margin_top ) ? 'margin-top:' . esc_attr( $settings->close_icon_margin_top ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_margin_left ) ) {
		echo ( '' !== $settings->close_icon_margin_left ) ? 'margin-left:' . esc_attr( $settings->close_icon_margin_left ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_margin_right ) ) {
		echo ( '' !== $settings->close_icon_margin_right ) ? 'margin-right:' . esc_attr( $settings->close_icon_margin_right ) . 'px;' : '';
	}
	if ( isset( $settings->close_icon_margin_bottom ) ) {
		echo ( '' !== $settings->close_icon_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->close_icon_margin_bottom ) . 'px;' : '';
	}
	?>
}

<?php
if ( isset( $settings->submenu_toggle ) && 'none' || $settings->submenu_toggle ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .uabb-has-submenu > .sub-menu {
	display: none;
}
	<?php
}
/* Toggle - Arrows */
if ( 'arrows' === $settings->submenu_toggle ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .uabb-menu-toggle {
		float: right;
		padding-left: 10px;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .uabb-menu-toggle:before {
		content: '\f107';
		font-family: '<?php echo esc_attr( $font_family ); ?>';
		z-index: 1;
		font-size: inherit;
		line-height: 0;
		font-weight: 900;
	}
	<?php

	/* Toggle - Plus */
} elseif ( 'plus' === $settings->submenu_toggle ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .uabb-menu-toggle {
		float: right;
		padding-left: 10px;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .uabb-menu-toggle:before {
		content: '\f067';
		font-family: '<?php echo esc_attr( $font_family ); ?>';
		font-size: 0.7em;
		z-index: 1;
		font-weight: 900;
	}
	<?php
}

if ( $global_settings->responsive_enabled ) {
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php
		if ( ! $version_bb_check ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button:visited {
				<?php
				if ( isset( $settings->btn_font_size_medium ) ) {
					echo ( '' !== $settings->btn_font_size_medium ) ? 'font-size:' . esc_attr( $settings->btn_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_medium ) ) {
					echo ( '' !== $settings->btn_line_height_medium ) ? 'line-height:' . esc_attr( $settings->btn_line_height_medium ) . 'em;' : '';
				}
				if ( isset( $settings->btn_letter_spacing_medium ) ) {
					echo ( '' !== $settings->btn_letter_spacing_medium ) ? 'letter-spacing:' . esc_attr( $settings->btn_letter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-content {
				<?php
				if ( isset( $settings->content_font_size_medium ) ) {
					echo ( '' !== $settings->content_font_size_medium ) ? 'font-size:' . esc_attr( $settings->content_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->content_line_height_medium ) ) {
					echo ( '' !== $settings->content_line_height_medium ) ? 'line-height:' . esc_attr( $settings->content_line_height_medium ) . 'em;' : '';
				}
				if ( isset( $settings->content_letter_spacing_medium ) ) {
					echo ( '' !== $settings->content_letter_spacing_medium ) ? 'letter-spacing:' . esc_attr( $settings->content_letter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu {
				<?php
				if ( isset( $settings->menu_font_size_medium ) ) {
					echo ( '' !== $settings->menu_font_size_medium ) ? 'font-size:' . esc_attr( $settings->menu_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->menu_line_height_medium ) ) {
					echo ( '' !== $settings->menu_line_height_medium ) ? 'line-height:' . esc_attr( $settings->menu_line_height_medium ) . 'em;' : '';
				}
				if ( isset( $settings->menu_letter_spacing_medium ) ) {
					echo ( '' !== $settings->menu_letter_spacing_medium ) ? 'letter-spacing:' . esc_attr( $settings->menu_letter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap {
				<?php
				if ( isset( $settings->title_font_size_medium ) ) {
					echo ( '' !== $settings->title_font_size_medium ) ? 'font-size:' . esc_attr( $settings->title_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->title_line_height_medium ) ) {
					echo ( '' !== $settings->title_line_height_medium ) ? 'line-height:' . esc_attr( $settings->title_line_height_medium ) . 'em;' : '';
				}
				if ( isset( $settings->title_letter_spacing_medium ) ) {
					echo ( '' !== $settings->title_letter_spacing_medium ) ? 'letter-spacing:' . esc_attr( $settings->title_letter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
			<?php
		}
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content {
			<?php
			if ( isset( $settings->offcanvas_spacing_top_medium ) ) {
				echo ( '' !== $settings->offcanvas_spacing_top_medium ) ? 'padding-top:' . esc_attr( $settings->offcanvas_spacing_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_left_medium ) ) {
				echo ( '' !== $settings->offcanvas_spacing_left_medium ) ? 'padding-left:' . esc_attr( $settings->offcanvas_spacing_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_right_medium ) ) {
				echo ( '' !== $settings->offcanvas_spacing_right_medium ) ? 'padding-right:' . esc_attr( $settings->offcanvas_spacing_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_bottom_medium ) ) {
				echo ( '' !== $settings->offcanvas_spacing_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->offcanvas_spacing_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a {
			<?php
			if ( isset( $settings->menu_padding_top_medium ) ) {
				echo ( '' !== $settings->menu_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->menu_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_left_medium ) ) {
				echo ( '' !== $settings->menu_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->menu_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_right_medium ) ) {
				echo ( '' !== $settings->menu_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->menu_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_bottom_medium ) ) {
				echo ( '' !== $settings->menu_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->menu_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
			<?php
			if ( isset( $settings->close_icon_padding_top_medium ) ) {
				echo ( '' !== $settings->close_icon_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->close_icon_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_left_medium ) ) {
				echo ( '' !== $settings->close_icon_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->close_icon_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_right_medium ) ) {
				echo ( '' !== $settings->close_icon_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->close_icon_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_bottom_medium ) ) {
				echo ( '' !== $settings->close_icon_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->close_icon_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content .uabb-offcanvas-menu li {
			<?php
			if ( isset( $settings->menu_margin_top_medium ) ) {
				echo ( '' !== $settings->menu_margin_top_medium ) ? 'margin-top:' . esc_attr( $settings->menu_margin_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_left_medium ) ) {
				echo ( '' !== $settings->menu_margin_left_medium ) ? 'margin-left:' . esc_attr( $settings->menu_margin_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_right_medium ) ) {
				echo ( '' !== $settings->menu_margin_right_medium ) ? 'margin-right:' . esc_attr( $settings->menu_margin_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_bottom_medium ) ) {
				echo ( '' !== $settings->menu_margin_bottom_medium ) ? 'margin-bottom:' . esc_attr( $settings->menu_margin_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		<?php if ( isset( $settings->offcanvas_width_medium ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas {
				<?php echo ( '' !== $settings->offcanvas_width_medium ) ? 'width:' . esc_attr( $settings->offcanvas_width_medium ) . esc_attr( $settings->offcanvas_width_medium_unit ) : ''; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-left {
				<?php echo ( '' !== $settings->offcanvas_width_medium ) ? 'left: -' . esc_attr( $settings->offcanvas_width_medium ) . esc_attr( $settings->offcanvas_width_medium_unit ) : ''; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-right {
				<?php echo ( '' !== $settings->offcanvas_width_medium ) ? 'right: -' . esc_attr( $settings->offcanvas_width_medium ) . esc_attr( $settings->offcanvas_width_medium_unit ) : ''; ?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
			<?php
			if ( isset( $settings->close_icon_margin_top_medium ) ) {
				echo ( '' !== $settings->close_icon_margin_top_medium ) ? 'margin-top:' . esc_attr( $settings->close_icon_margin_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_left_medium ) ) {
				echo ( '' !== $settings->close_icon_margin_left_medium ) ? 'margin-left:' . esc_attr( $settings->close_icon_margin_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_right_medium ) ) {
				echo ( '' !== $settings->close_icon_margin_right_medium ) ? 'margin-right:' . esc_attr( $settings->close_icon_margin_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_bottom_medium ) ) {
				echo ( '' !== $settings->close_icon_margin_bottom_medium ) ? 'margin-bottom:' . esc_attr( $settings->close_icon_margin_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap .uabb-offcanvas-icon {
			<?php
			if ( isset( $settings->icon_padding_top_medium ) ) {
				echo ( '' !== $settings->icon_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->icon_padding_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_left_medium ) ) {
				echo ( '' !== $settings->icon_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->icon_padding_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_right_medium ) ) {
				echo ( '' !== $settings->icon_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->icon_padding_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_bottom_medium ) ) {
				echo ( '' !== $settings->icon_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->icon_padding_bottom_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap {
			<?php
			if ( isset( $settings->img_padding_medium ) ) {
				echo ( '' !== $settings->img_padding_medium ) ? 'padding:' . esc_attr( $settings->img_padding_medium ) . 'px;' : '';
			}
			?>
		}
		<?php if ( $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap {
				<?php
				if ( isset( $settings->all_align_medium ) ) {
					echo ( '' !== $settings->all_align_medium ) ? 'text-align:' . esc_attr( $settings->all_align_medium ) . ';' : '';
				}
				?>
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php
		if ( ! $version_bb_check ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-creative-button-wrap .uabb-button:visited {
				<?php
				if ( isset( $settings->btn_font_size_responsive ) ) {
					echo ( '' !== $settings->btn_font_size_responsive ) ? 'font-size:' . esc_attr( $settings->btn_font_size_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->btn_line_height_responsive ) ) {
					echo ( '' !== $settings->btn_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->btn_line_height_responsive ) . 'em;' : '';
				}
				if ( isset( $settings->btn_letter_spacing_responsive ) ) {
					echo ( '' !== $settings->btn_letter_spacing_responsive ) ? 'letter-spacing:' . esc_attr( $settings->btn_letter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-content {
				<?php
				if ( isset( $settings->content_font_size_responsive ) ) {
					echo ( '' !== $settings->content_font_size_responsive ) ? 'font-size:' . esc_attr( $settings->content_font_size_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->content_line_height_responsive ) ) {
					echo ( '' !== $settings->content_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->content_line_height_responsive ) . 'em;' : '';
				}
				if ( isset( $settings->content_letter_spacing_responsive ) ) {
					echo ( '' !== $settings->content_letter_spacing_responsive ) ? 'letter-spacing:' . esc_attr( $settings->content_letter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu {
				<?php
				if ( isset( $settings->menu_font_size_responsive ) ) {
					echo ( '' !== $settings->menu_font_size_responsive ) ? 'font-size:' . esc_attr( $settings->menu_font_size_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->menu_line_height_responsive ) ) {
					echo ( '' !== $settings->menu_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->menu_line_height_responsive ) . 'em;' : '';
				}
				if ( isset( $settings->menu_letter_spacing_responsive ) ) {
					echo ( '' !== $settings->menu_letter_spacing_responsive ) ? 'letter-spacing:' . esc_attr( $settings->menu_letter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap {
				<?php
				if ( isset( $settings->title_font_size_responsive ) ) {
					echo ( '' !== $settings->title_font_size_responsive ) ? 'font-size:' . esc_attr( $settings->title_font_size_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->title_line_height_responsive ) ) {
					echo ( '' !== $settings->title_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->title_line_height_responsive ) . 'em;' : '';
				}
				if ( isset( $settings->title_letter_spacing_responsive ) ) {
					echo ( '' !== $settings->title_letter_spacing_responsive ) ? 'letter-spacing:' . esc_attr( $settings->title_letter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
			<?php
		}
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content {
			<?php
			if ( isset( $settings->offcanvas_spacing_top_responsive ) ) {
				echo ( '' !== $settings->offcanvas_spacing_top_responsive ) ? 'padding-top:' . esc_attr( $settings->offcanvas_spacing_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_left_responsive ) ) {
				echo ( '' !== $settings->offcanvas_spacing_left_responsive ) ? 'padding-left:' . esc_attr( $settings->offcanvas_spacing_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_right_responsive ) ) {
				echo ( '' !== $settings->offcanvas_spacing_right_responsive ) ? 'padding-right:' . esc_attr( $settings->offcanvas_spacing_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->offcanvas_spacing_bottom_responsive ) ) {
				echo ( '' !== $settings->offcanvas_spacing_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->offcanvas_spacing_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-menu .menu-item a {
			<?php
			if ( isset( $settings->menu_padding_top_responsive ) ) {
				echo ( '' !== $settings->menu_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->menu_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_left_responsive ) ) {
				echo ( '' !== $settings->menu_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->menu_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_right_responsive ) ) {
				echo ( '' !== $settings->menu_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->menu_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->menu_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->menu_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
			<?php
			if ( isset( $settings->close_icon_padding_top_responsive ) ) {
				echo ( '' !== $settings->close_icon_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->close_icon_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_left_responsive ) ) {
				echo ( '' !== $settings->close_icon_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->close_icon_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_right_responsive ) ) {
				echo ( '' !== $settings->close_icon_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->close_icon_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->close_icon_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->close_icon_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-content .uabb-offcanvas-menu li {
			<?php
			if ( isset( $settings->menu_margin_top_responsive ) ) {
				echo ( '' !== $settings->menu_margin_top_responsive ) ? 'margin-top:' . esc_attr( $settings->menu_margin_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_left_responsive ) ) {
				echo ( '' !== $settings->menu_margin_left_responsive ) ? 'margin-left:' . esc_attr( $settings->menu_margin_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_right_responsive ) ) {
				echo ( '' !== $settings->menu_margin_right_responsive ) ? 'margin-right:' . esc_attr( $settings->menu_margin_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->menu_margin_bottom_responsive ) ) {
				echo ( '' !== $settings->menu_margin_bottom_responsive ) ? 'margin-bottom:' . esc_attr( $settings->menu_margin_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		<?php if ( isset( $settings->offcanvas_width_responsive ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas {
				<?php echo ( '' !== $settings->offcanvas_width_responsive ) ? 'width:' . esc_attr( $settings->offcanvas_width_responsive ) . esc_attr( $settings->offcanvas_width_responsive_unit ) : ''; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-left {
				<?php echo ( '' !== $settings->offcanvas_width_responsive ) ? 'left: -' . esc_attr( $settings->offcanvas_width_responsive ) . esc_attr( $settings->offcanvas_width_responsive_unit ) : ''; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-parent-wrapper .uabb-offcanvas-position-at-right {
				<?php echo ( '' !== $settings->offcanvas_width_responsive ) ? 'right: -' . esc_attr( $settings->offcanvas_width_responsive ) . esc_attr( $settings->offcanvas_width_responsive_unit ) : ''; ?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-close-icon-wrapper .uabb-offcanvas-close {
			<?php
			if ( isset( $settings->close_icon_margin_top_responsive ) ) {
				echo ( '' !== $settings->close_icon_margin_top_responsive ) ? 'margin-top:' . esc_attr( $settings->close_icon_margin_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_left_responsive ) ) {
				echo ( '' !== $settings->close_icon_margin_left_responsive ) ? 'margin-left:' . esc_attr( $settings->close_icon_margin_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_right_responsive ) ) {
				echo ( '' !== $settings->close_icon_margin_right_responsive ) ? 'margin-right:' . esc_attr( $settings->close_icon_margin_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->close_icon_margin_bottom_responsive ) ) {
				echo ( '' !== $settings->close_icon_margin_bottom_responsive ) ? 'margin-bottom:' . esc_attr( $settings->close_icon_margin_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap .uabb-offcanvas-icon {
			<?php
			if ( isset( $settings->icon_padding_top_responsive ) ) {
				echo ( '' !== $settings->icon_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->icon_padding_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_left_responsive ) ) {
				echo ( '' !== $settings->icon_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->icon_padding_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_right_responsive ) ) {
				echo ( '' !== $settings->icon_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->icon_padding_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->icon_padding_bottom_responsive ) ) {
				echo ( '' !== $settings->icon_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->icon_padding_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap {
			<?php
			if ( isset( $settings->img_padding_responsive ) ) {
				echo ( '' !== $settings->img_padding_responsive ) ? 'padding:' . esc_attr( $settings->img_padding_responsive ) . 'px;' : '';
			}
			?>
		}
		<?php if ( $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-photo-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-text-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-offcanvas-icon-wrap {
				<?php
				if ( isset( $settings->all_align_responsive ) ) {
					echo ( '' !== $settings->all_align_responsive ) ? 'text-align:' . esc_attr( $settings->all_align_responsive ) . ';' : '';
				}
				?>
			}
		<?php } ?>
	}
	<?php
}
