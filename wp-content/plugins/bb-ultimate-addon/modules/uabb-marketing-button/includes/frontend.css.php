<?php
/**
 * UABB Button Module front-end CSS php file
 *
 * @package UABB Button Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->bg_color                  = UABB_Helper::uabb_colorpicker( $settings, 'bg_color', true );
$settings->bg_hover_color            = UABB_Helper::uabb_colorpicker( $settings, 'bg_hover_color', true );
$settings->text_color                = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->text_hover_color          = UABB_Helper::uabb_colorpicker( $settings, 'text_hover_color' );
$settings->subtitle_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'subtitle_text_color' );
$settings->subtitle_text_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'subtitle_text_hover_color' );
$settings->icon_color                = UABB_Helper::uabb_colorpicker( $settings, 'icon_color' );
?>
<?php if ( 'top' === $settings->icon_vertical_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_after {
		align-self: flex-start;
	}
<?php } ?>
<?php if ( 'all_before' === $settings->icon_position || 'all_after' === $settings->icon_position ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-button-width-custom .uabb-button {
		display: inline-flex;
		text-align: center;
		max-width: 100%;
		justify-content: center;
		align-items: center;
	}
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-align-icon-all_before {
	float: left;
	align-self: center;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-align-icon-all_after {
	float: right;
	align-self: center;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap-all_before {
	display: inline-flex;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap-all_after {
	display: inline-flex;
	flex-direction: row-reverse;
}
<?php if ( ! $version_bb_check ) { ?>
	<?php
	$settings->font_family = (array) $settings->font_family;
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited{
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
	if ( 'default' === $settings->style ) {

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
				'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title, .fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
		<?php if ( 'default' !== $settings->subtitle_font_family['family'] && 'default' !== $settings->subtitle_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->subtitle_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->subtitle_font_size_unit ) ) {
			echo ( '' !== $settings->subtitle_font_size_unit ) ? 'font-size:' . esc_attr( $settings->subtitle_font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->subtitle_line_height_unit ) ) {
				echo ( '' !== $settings->subtitle_line_height_unit ) ? 'line-height:' . esc_attr( $settings->subtitle_line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->subtitle_letter_spacing ) ) {
			echo ( '' !== $settings->subtitle_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->subtitle_letter_spacing ) . 'px;' : '';
		}
		if ( isset( $settings->subtitle_transform ) ) {
			echo ( '' !== $settings->subtitle_transform ) ? 'text-transform:' . esc_attr( $settings->subtitle_transform ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( 'default' === $settings->style ) {

		$button_typo_subtitle = uabb_theme_button_typography( $settings->button_typo_subtitle );

		$settings->button_typo_subtitle            = ( array_key_exists( 'desktop', $button_typo_subtitle ) ) ? $button_typo_subtitle['desktop'] : $settings->button_typo_subtitle;
		$settings->button_typo_subtitle_medium     = ( array_key_exists( 'tablet', $button_typo_subtitle ) ) ? $button_typo_subtitle['tablet'] : $settings->button_typo_subtitle_medium;
		$settings->button_typo_subtitle_responsive = ( array_key_exists( 'mobile', $button_typo_subtitle ) ) ? $button_typo_subtitle['mobile'] : $settings->button_typo_subtitle_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_typo_subtitle',
				'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading, .fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php
	if ( 'default' !== $settings->style ) {

		if ( isset( $settings->padding_top ) && isset( $settings->padding_right ) && isset( $settings->padding_bottom ) && isset( $settings->padding_left ) ) {
			if ( isset( $settings->padding_top ) ) {
				echo ( '' !== $settings->padding_top ) ? 'padding-top:' . esc_attr( $settings->padding_top ) . 'px;' : 'padding-top:10px;';
			}
			if ( isset( $settings->padding_right ) ) {
				echo ( '' !== $settings->padding_right ) ? 'padding-right:' . esc_attr( $settings->padding_right ) . 'px;' : 'padding-right:40px;';
			}
			if ( isset( $settings->padding_bottom ) ) {
				echo ( '' !== $settings->padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->padding_bottom ) . 'px;' : 'padding-bottom:10px;';
			}
			if ( isset( $settings->padding_left ) ) {
				echo ( '' !== $settings->padding_left ) ? 'padding-left:' . esc_attr( $settings->padding_left ) . 'px;' : 'padding-left:40px;';
			}
		}
	} else {
		$is_padding_empty = UABB_Helper::uabb_dimention_css( $settings, 'padding', 'padding' );

		if ( ! empty( $is_padding_empty ) ) {
			echo esc_attr( $is_padding_empty );
		} else {
			echo esc_attr( uabb_theme_padding_css_genreated( 'desktop' ) );
		}
	}
	if ( 'custom' === $settings->width ) {
		if ( isset( $settings->custom_width ) ) {
			echo ( '' !== $settings->custom_width ) ? 'width:' . esc_attr( $settings->custom_width ) . 'px;' : '';
		}
		if ( isset( $settings->custom_height ) ) {
			echo ( '' !== $settings->custom_height ) ? 'min-height:' . esc_attr( $settings->custom_height ) . 'px;' : '';
		}
	}
	?>
}
<?php if ( 'custom' === $settings->width ) { ?>
	html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
	html.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
		line-height: <?php echo esc_attr( $settings->custom_height ); ?>px;
	}
<?php } ?>

<?php if ( ! empty( $settings->text_color ) && 'default' !== $settings->style ) { ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited * {
	color: <?php echo esc_attr( $settings->text_color ); ?>;
}
<?php } ?>
<?php if ( 'default' === $settings->style ) { ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited * {
	color: <?php echo esc_attr( uabb_theme_default_button_text_color( $settings->text_color ) ); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->subtitle_text_color ) && 'default' !== $settings->style ) { ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited * {
	color: <?php echo esc_attr( $settings->subtitle_text_color ); ?>;
}
<?php } ?>
<?php if ( 'default' === $settings->style ) { ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited * {
	color: <?php echo esc_attr( uabb_theme_default_button_text_color( $settings->subtitle_text_color ) ); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->bg_hover_color ) && 'gradient' !== $settings->style && 'default' !== $settings->style ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-button:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button.uabb-marketing-button-wrap-before.uabb-marketing-btn__link:hover {
		background: <?php echo esc_attr( $settings->bg_hover_color ); ?>;
	}
<?php } ?>
<?php if ( 'default' === $settings->style ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-button:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button.uabb-marketing-button-wrap-before.uabb-marketing-btn__link:hover {
		background: <?php echo esc_attr( uabb_theme_default_button_bg_hover_color( $settings->bg_hover_color ) ); ?>;
	}
<?php } ?>

<?php if ( ! empty( $settings->text_hover_color ) && 'default' !== $settings->style ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover * {
	color: <?php echo esc_attr( $settings->text_hover_color ); ?>;
}
<?php endif; ?>
<?php if ( 'default' === $settings->style ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:hover * {
	color: <?php echo esc_attr( uabb_theme_default_button_text_hover_color( $settings->text_hover_color ) ); ?>;
}
<?php endif; ?>
<?php if ( ! empty( $settings->subtitle_text_hover_color ) && 'default' !== $settings->style ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover * {
	color: <?php echo esc_attr( $settings->subtitle_text_hover_color ); ?>;
}
<?php endif; ?>
<?php if ( 'default' === $settings->style ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:hover * {
	color: <?php echo esc_attr( uabb_theme_default_button_text_hover_color( $settings->subtitle_text_hover_color ) ); ?>;
}
<?php endif; ?>
<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link, .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php
	if ( 'default' !== $settings->style ) {
		if ( isset( $settings->border_style ) ) {
			echo ( '' !== $settings->border_style ) ? 'border-style:' . esc_attr( $settings->border_style ) . ';' : '';
		}
		if ( isset( $settings->border_size ) ) {
			echo ( '' !== $settings->border_size ) ? 'border-width:' . esc_attr( $settings->border_size ) . 'px;' : '';
		}
		if ( isset( $settings->border_color ) ) {
			echo ( '' !== $settings->border_color ) ? 'border-color:' . esc_attr( $settings->border_color ) . ';' : '';
		}
		if ( isset( $settings->border_radius ) ) {
			echo ( '' !== $settings->border_radius ) ? 'border-radius:' . esc_attr( $settings->border_radius ) . 'px;' : '';
		}
	} else {
		if ( isset( $settings->border_style ) ) {
			echo ( '' !== $settings->border_style ) ? 'border-style:' . esc_attr( $settings->border_style ) . ';' : 'border-style:solid;';
		}
		if ( isset( $settings->border_size ) && ! empty( $settings->border_size ) ) {
			echo ( '' !== $settings->border_size ) ? 'border-width:' . esc_attr( $settings->border_size ) . 'px;' : '';
		} else {

			$border_width = uabb_theme_button_border_width( '' );

			echo ( is_array( $border_width ) && array_key_exists( 'top', $border_width ) ) ? 'border-top-width:' . esc_attr( $border_width['top'] ) . 'px;' : '';
			echo ( is_array( $border_width ) && array_key_exists( 'left', $border_width ) ) ? 'border-left-width:' . esc_attr( $border_width['left'] ) . 'px;' : '';
			echo ( is_array( $border_width ) && array_key_exists( 'right', $border_width ) ) ? 'border-right-width:' . esc_attr( $border_width['right'] ) . 'px;' : '';
			echo ( is_array( $border_width ) && array_key_exists( 'bottom', $border_width ) ) ? 'border-bottom-width:' . esc_attr( $border_width['bottom'] ) . 'px;' : '';
		}
		if ( isset( $settings->border_color ) ) {

			echo ( '' !== $settings->border_color ) ? 'border-color:' . esc_attr( $settings->border_color ) . ';' : esc_attr( uabb_theme_border_color( '' ) ) . ';';
		}
		if ( isset( $settings->border_radius ) ) {

			echo ( '' !== $settings->border_radius ) ? 'border-radius:' . esc_attr( $settings->border_radius ) . 'px;' : esc_attr( uabb_theme_button_border_radius( '' ) ) . 'px;';
		}
	}
	?>
	}
	<?php
} else {

	if ( 'default' === $settings->style ) {
		$settings->border = uabb_theme_border( $settings->border );
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'border',
				'selector'     => ".fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link,.fl-node-$id .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited",
			)
		);
	}
}
?>
<?php // Button Style. ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
	<?php

	if ( 'flat' === $settings->style ) {
		echo ( '' !== $settings->bg_color ) ? 'background:' . esc_attr( $settings->bg_color ) . ';' : '';
	} elseif ( 'transparent' === $settings->style ) {
		echo 'background:transparent;';
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->style ) {
			?>
		background:<?php echo esc_attr( FLBuilderColor::gradient( $settings->gradient ) ); ?>;
			<?php
		}
	}
	if ( 'default' === $settings->style ) {
		echo ( '' !== $settings->bg_color ) ? 'background:' . esc_attr( $settings->bg_color ) . ';' : 'background:' . esc_attr( uabb_theme_default_button_bg_color( '' ) ) . ';';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button .uabb-marketing-title {
	<?php
	if ( isset( $settings->title_margin_bottom ) ) {
		echo ( '' !== $settings->title_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->title_margin_bottom ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-button .uabb-button-icon {
	<?php
	if ( isset( $settings->icon_width ) ) {
		echo ( '' !== $settings->icon_width ) ? 'font-size:' . esc_attr( $settings->icon_width ) . 'px;' : '';
	}
	if ( isset( $settings->icon_color ) ) {
		echo ( '' !== $settings->icon_color ) ? 'color:' . esc_attr( $settings->icon_color ) . '' : '';
	}
	?>
}
<?php if ( 'before' === $settings->icon_position || 'all_before' === $settings->icon_position ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-buttons-icon-innerwrap.uabb-marketing-button-icon-before {
		<?php
		if ( isset( $settings->img_icon_spacing ) ) {
			echo ( '' !== $settings->img_icon_spacing ) ? 'margin-right:' . esc_attr( $settings->img_icon_spacing ) . 'px;' : '';
			echo 'margin-left:0;';
		}
		?>
	}
	<?php
} elseif ( 'after' === $settings->icon_position || 'all_after' === $settings->icon_position ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-icon.uabb-marketing-button-icon-all_after,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-buttons-icon-innerwrap.uabb-marketing-button-icon-after {
		<?php
		if ( isset( $settings->img_icon_spacing ) ) {
			echo ( '' !== $settings->img_icon_spacing ) ? 'margin-left:' . esc_attr( $settings->img_icon_spacing ) . 'px;' : '';
			echo 'margin-right:0;';
		}
		?>
	}
<?php } ?>
<?php if ( $global_settings->responsive_enabled ) { ?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
			<?php
			if ( 'default' !== $settings->style ) {
				if ( isset( $settings->padding_top_medium ) && isset( $settings->padding_right_medium ) && isset( $settings->padding_bottom_medium ) && isset( $settings->padding_left_medium ) ) {
					if ( isset( $settings->padding_top_medium ) ) {
						echo ( '' !== $settings->padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->padding_top_medium ) . 'px;' : 'padding-top:10px;';
					}
					if ( isset( $settings->padding_right_medium ) ) {
						echo ( '' !== $settings->padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->padding_right_medium ) . 'px;' : 'padding-right:40px;';
					}
					if ( isset( $settings->padding_bottom_medium ) ) {
						echo ( '' !== $settings->padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->padding_bottom_medium ) . 'px;' : 'padding-bottom:10px;';
					}
					if ( isset( $settings->padding_left_medium ) ) {
						echo ( '' !== $settings->padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->padding_left_medium ) . 'px;' : 'padding-left:40px;';
					}
				}
			} else {
				$is_padding_empty_medium = UABB_Helper::uabb_dimention_css( $settings, 'padding', 'padding', 'medium' );

				if ( ! empty( $is_padding_empty_medium ) ) {
					echo esc_attr( $is_padding_empty_medium );
				} else {
					echo esc_attr( uabb_theme_padding_css_genreated( 'tablet' ) );
				}
			}
			?>
		}
		<?php if ( $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited {
				<?php
				if ( isset( $settings->font_size_unit_medium ) ) {
					echo ( '' !== $settings->font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->line_height_unit_medium ) ) {
						echo ( '' !== $settings->line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->line_height_unit ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
				<?php
				if ( isset( $settings->subtitle_font_size_unit_medium ) ) {
					echo ( '' !== $settings->subtitle_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->subtitle_line_height_unit_medium ) ) {
						echo ( '' !== $settings->subtitle_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->subtitle_line_height_unit ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap.uabb-marketing-button-reponsive-<?php echo esc_attr( $settings->mob_align ); ?> {
			text-align: <?php echo esc_attr( $settings->mob_align ); ?>;
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link:visited {
			<?php
			if ( 'default' !== $settings->style ) {
				if ( isset( $settings->padding_top_responsive ) && isset( $settings->padding_right_responsive ) && isset( $settings->padding_bottom_responsive ) && isset( $settings->padding_left_responsive ) ) {
					if ( isset( $settings->padding_top_responsive ) ) {
						echo ( '' !== $settings->padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->padding_top_responsive ) . 'px;' : 'padding-top:10px;';
					}
					if ( isset( $settings->padding_right_responsive ) ) {
						echo ( '' !== $settings->padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->padding_right_responsive ) . 'px;' : 'padding-right:40px;';
					}
					if ( isset( $settings->padding_bottom_responsive ) ) {
						echo ( '' !== $settings->padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->padding_bottom_responsive ) . 'px;' : 'padding-bottom:10px;';
					}
					if ( isset( $settings->padding_left_responsive ) ) {
						echo ( '' !== $settings->padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->padding_left_responsive ) . 'px;' : 'padding-left:40px;';
					}
				}
			} else {
				$is_padding_empty_responsive = UABB_Helper::uabb_dimention_css( $settings, 'padding', 'padding', 'responsive' );

				if ( ! empty( $is_padding_empty_responsive ) ) {
					echo esc_attr( $is_padding_empty_responsive );
				} else {
					echo esc_attr( uabb_theme_padding_css_genreated( 'mobile' ) );
				}
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-title:visited {
			<?php
			if ( isset( $settings->font_size_unit_responsive ) ) {
				echo ( '' !== $settings->font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->font_size_unit_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				echo ( '' !== $settings->line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->line_height_unit_responsive ) . 'em;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-marketing-button-wrap .uabb-marketing-btn__link .uabb-marketing-subheading:visited {
			<?php
			if ( isset( $settings->subtitle_font_size_unit_responsive ) ) {
				echo ( '' !== $settings->subtitle_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->subtitle_font_size_unit_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->subtitle_line_height_unit_responsive ) ) {
				echo ( '' !== $settings->subtitle_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->subtitle_line_height_unit_responsive ) . 'em;' : '';
			}
			?>
		}
	}
<?php } ?>
