<?php
/**
 *  UABB Retina Image Module file
 *
 *  @package UABB Retina Image Module
 */

	$version_bb_check = UABB_Compatibility::check_bb_version();

	$settings->color          = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'bg_color' );
	$settings->style_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'style_bg_color', true );

	$settings->caption_margin_top    = ( '' !== trim( $settings->caption_margin_top ) ) ? $settings->caption_margin_top : '0';
	$settings->caption_margin_bottom = ( '' !== trim( $settings->caption_margin_bottom ) ) ? $settings->caption_margin_bottom : '15';
?>

/* Global Alignment CSS */
<?php if ( isset( $settings->align ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-retina-img-wrap, .fl-node-<?php echo $id; ?> .uabb-retina-img-caption {
		<?php echo ( '' !== $settings->align ) ? 'text-align:' . $settings->align . ';' : ''; ?>
	}
	<?php
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img {
		<?php
		if ( isset( $settings->photo_size ) ) {
			echo ( '' !== $settings->photo_size ) ? 'width:' . $settings->photo_size . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'photo_size',
			'selector'     => ".fl-node-$id .uabb-retina-img-content .uabb-retina-img",
			'prop'         => 'width',
		)
	);
}
?>

.fl-node-<?php echo $id; ?> .uabb-retina-img-content {
	<?php
	if ( isset( $settings->style_bg_color ) ) {
		echo ( '' !== $settings->style_bg_color ) ? 'background-color:' . $settings->style_bg_color . ';' : '';
	}
	if ( isset( $settings->bg_border_radius ) ) {
		echo ( '' !== $settings->bg_border_radius ) ? 'border-radius:' . $settings->bg_border_radius . 'px;' : '';
	}
	if ( isset( $settings->bg_size ) ) {
		echo ( '' !== $settings->bg_size ) ? 'padding:' . $settings->bg_size . 'px;' : '';
	}
	?>
}

.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img {
	<?php
	if ( isset( $settings->bg_border_radius ) ) {
		?>
		border-radius: <?php echo intval( $settings->bg_border_radius ) - intval( $settings->bg_size ); ?>px;
		<?php
	}
	?>
}

.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {
	<?php
	if ( isset( $settings->caption_padding_top ) ) {
		echo ( '' !== $settings->caption_padding_top ) ? 'padding-top:' . $settings->caption_padding_top . 'px;' : '';
	}
	if ( isset( $settings->caption_padding_right ) ) {
		echo ( '' !== $settings->caption_padding_right ) ? 'padding-right:' . $settings->caption_padding_right . 'px;' : '';
	}
	if ( isset( $settings->caption_padding_bottom ) ) {
		echo ( '' !== $settings->caption_padding_bottom ) ? 'padding-bottom:' . $settings->caption_padding_bottom . 'px;' : '';
	}
	if ( isset( $settings->caption_padding_left ) ) {
		echo ( '' !== $settings->caption_padding_left ) ? 'padding-left:' . $settings->caption_padding_left . 'px;' : '';
	}
	?>
}

<?php if ( isset( $settings->bg_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {
		<?php echo ( '' !== $settings->bg_color ) ? 'background:' . $settings->bg_color : ''; ?>
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-retina-img-caption {
	<?php
	if ( isset( $settings->caption_margin_top ) ) {
		echo ( '' !== $settings->caption_margin_top ) ? 'margin-top:' . $settings->caption_margin_top . 'px;' : '';
	}
	if ( isset( $settings->caption_margin_bottom ) ) {
		echo ( '' !== $settings->caption_margin_bottom ) ? 'margin-bottom:' . $settings->caption_margin_bottom . 'px;' : '';
	}
	?>
}

/* Caption Color */
.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {
	<?php
	if ( isset( $settings->color ) ) {
		echo ( '' !== $settings->color ) ? 'color:' . $settings->color . ';' : '';
	}
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-retina-img-caption,
	.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {

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
				'setting_name' => 'font_typo',
				'selector'     => ".fl-node-$id .uabb-retina-img-caption,.fl-node-$id .uabb-retina-img-caption .uabb-retina-img-caption-text",
			)
		);
	}
}
?>

<?php if ( 'opacity' === $settings->hover_effect ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img {
		<?php if ( isset( $settings->opacity ) ) { ?>
			opacity: <?php echo ( '' !== $settings->opacity ) ? $settings->opacity / 100 : 100; ?>; 
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img:hover {
		<?php if ( isset( $settings->hover_opacity ) ) { ?>
			opacity: <?php echo ( '' !== $settings->hover_opacity ) ? $settings->hover_opacity / 100 : 100; ?>; 
		<?php } ?>
	}
	<?php
} elseif ( 'hue_rotate' === $settings->hover_effect ) {
	?>
		.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img {
			<?php
			if ( isset( $settings->hue_deg ) ) {
				?>
				-webkit-filter: hue-rotate(<?php echo $settings->hue_deg; ?>deg);
				<?php
			}
			if ( isset( $settings->hue_deg ) ) {
				?>
				filter: hue-rotate(<?php echo $settings->hue_deg; ?>deg);
				<?php
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img:hover {
			<?php
			if ( isset( $settings->hover_hue_deg ) ) {
				?>
				-webkit-filter: hue-rotate(<?php echo $settings->hover_hue_deg; ?>deg);
				<?php
			}
			if ( isset( $settings->hover_hue_deg ) ) {
				?>
				filter: hue-rotate(<?php echo $settings->hover_hue_deg; ?>deg);
				<?php
			}
			?>
		}
<?php } ?>

<?php
if ( 'simple' === $settings->hover_effect ) {
	if ( 'color_gray' === $settings->img_grayscale_simple ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img:hover {
			-webkit-filter: grayscale(100%);
			-webkit-filter: gray;
			filter: grayscale(100%);
			filter: gray;
		}
		<?php
	} elseif ( 'color_hue' === $settings->img_grayscale_simple ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img:hover {
			<?php
			if ( isset( $settings->hover_hue_deg ) ) {
				?>
				-webkit-filter: hue-rotate(<?php echo $settings->hover_hue_deg; ?>deg);
				<?php
			}
			if ( isset( $settings->hover_hue_deg ) ) {
				?>
				filter: hue-rotate(<?php echo $settings->hover_hue_deg; ?>deg);
				<?php
			}
			?>
		}
		<?php
	}
} elseif ( 'grayscale' === $settings->hover_effect ) {
	if ( 'yes' !== $settings->img_grayscale_grayscale ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-retina-img-content .uabb-retina-img:hover {
			-webkit-filter: grayscale(1%);
			filter: grayscale(1%);
		}
		<?php
	}
}
?>

<?php if ( $global_settings->responsive_enabled ) { ?>
	<?php if ( $version_bb_check ) { ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-retina-img-wrap, .fl-node-<?php echo $id; ?> .uabb-retina-img-caption {
			<?php
			if ( isset( $settings->align_medium ) ) {
				echo ( '' !== $settings->align_medium ) ? 'text-align:' . $settings->align_medium . ';' : '';
			}
			?>
			}
			.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {
				<?php
				if ( isset( $settings->caption_padding_top_medium ) ) {
					echo ( '' !== $settings->caption_padding_top_medium ) ? 'padding-top:' . $settings->caption_padding_top_medium . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_right_medium ) ) {
					echo ( '' !== $settings->caption_padding_right_medium ) ? 'padding-right:' . $settings->caption_padding_right_medium . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_bottom_medium ) ) {
					echo ( '' !== $settings->caption_padding_bottom_medium ) ? 'padding-bottom:' . $settings->caption_padding_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_left_medium ) ) {
					echo ( '' !== $settings->caption_padding_left_medium ) ? 'padding-left:' . $settings->caption_padding_left_medium . 'px;' : '';
				}
				?>
			}
		}
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-retina-img-wrap, .fl-node-<?php echo $id; ?> .uabb-retina-img-caption {
			<?php
			if ( isset( $settings->align_responsive ) ) {
				echo ( '' !== $settings->align_responsive ) ? 'text-align:' . $settings->align_responsive . ';' : '';
			}
			?>
			}
			.fl-node-<?php echo $id; ?> .uabb-retina-img-caption .uabb-retina-img-caption-text {
				<?php
				if ( isset( $settings->caption_padding_top_responsive ) ) {
					echo ( '' !== $settings->caption_padding_top_responsive ) ? 'padding-top:' . $settings->caption_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_right_responsive ) ) {
					echo ( '' !== $settings->caption_padding_right_responsive ) ? 'padding-right:' . $settings->caption_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->caption_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->caption_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->caption_padding_left_responsive ) ) {
					echo ( '' !== $settings->caption_padding_left_responsive ) ? 'padding-left:' . $settings->caption_padding_left_responsive . 'px;' : '';
				}
				?>
			}
		}
	<?php } ?>
<?php } ?>
