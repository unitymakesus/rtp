<?php
/**
 *  UABB Heading Module front-end CSS php file
 *
 *  @package UABB Heading Module
 */

	$version_bb_check = UABB_Compatibility::check_bb_version();

	$settings->color                   = UABB_Helper::uabb_colorpicker( $settings, 'color' );
	$settings->toc_bg_color            = UABB_Helper::uabb_colorpicker( $settings, 'toc_bg_color', true );
	$settings->toc_content_color       = UABB_Helper::uabb_colorpicker( $settings, 'toc_content_color', true );
	$settings->toc_content_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'toc_content_hover_color', true );
	$settings->toc_toggle_color        = UABB_Helper::uabb_colorpicker( $settings, 'toc_toggle_color', true );
	$settings->toc_toggle_hover_color  = UABB_Helper::uabb_colorpicker( $settings, 'toc_toggle_hover_color', true );
	$settings->toggle_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'toggle_bg_color', true );
	$settings->toggle_bg_hover_color   = UABB_Helper::uabb_colorpicker( $settings, 'toggle_bg_hover_color', true );
	$settings->scroll_icon_color       = UABB_Helper::uabb_colorpicker( $settings, 'scroll_icon_color', true );
	$settings->scroll_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'scroll_bg_color', true );

	$settings->toc_margin_bottom       = ( '' !== trim( $settings->toc_margin_bottom ) ) ? $settings->toc_margin_bottom : '';
	$settings->space_between_contents  = ( '' !== trim( $settings->space_between_contents ) ) ? $settings->space_between_contents : '';
	$settings->separator_margin_bottom = ( '' !== trim( $settings->separator_margin_bottom ) ) ? $settings->separator_margin_bottom : '';

?>

	<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc {
			<?php
			if ( isset( $settings->alignment ) ) {
				echo ( '' !== $settings->alignment ) ? 'text-align:' . $settings->alignment . ';' : '';
			}
			?>
			}

			<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::responsive_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'alignment',
					'selector'     => ".fl-node-$id .uabb-parent-wrapper-toc",
					'prop'         => 'text-align',
				)
			);
	}
}
	?>
	<?php if ( ! $version_bb_check ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc .uabb-module-content.uabb-separator-parent {
		<?php
		if ( isset( $settings->sep_alignment ) ) {
			echo ( '' !== $settings->sep_alignment ) ? 'text-align:' . $settings->sep_alignment . ';' : '';
		}
		?>
		}

			<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::responsive_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'sep_alignment',
					'selector'     => ".fl-node-$id .uabb-parent-wrapper-toc .uabb-module-content.uabb-separator-parent",
					'prop'         => 'text-align',
				)
			);
	}
}
	?>
<?php
if ( 'none' !== $settings->separator_style ) {

	$position = '0';

	if ( 'center' === $settings->alignment ) {
		$position = '50';
	} elseif ( 'right' === $settings->alignment ) {
		$position = '100';
	}

	$line_color = uabb_theme_base_color( $settings->separator_line_color );

	if ( $version_bb_check ) {
		$separator_array = array(
			/* General Section */
			'separator' => $settings->separator_style,
			'style'     => $settings->separator_line_style,
			'color'     => $line_color,
			'height'    => $settings->separator_line_height,
			'width'     => ( '' !== $settings->separator_line_width ) ? $settings->separator_line_width : '30',

		);
	} else {
		$separator_array = array(
			/* General Section */
			'separator' => $settings->separator_style,
			'style'     => $settings->separator_line_style,
			'color'     => $line_color,
			'height'    => $settings->separator_line_height,
			'width'     => ( '' !== $settings->separator_line_width ) ? $settings->separator_line_width : '30',

		);
	}

		/* CSS Render Function */
		FLBuilder::render_module_css( 'advanced-separator', $id, $separator_array );
}
?>
/* General CSS */

.fl-node-<?php echo $id; ?> .uabb-toc-container {

<?php
if ( isset( $settings->toc_bg_color ) ) {
	echo ( '' !== $settings->toc_bg_color ) ? 'background:' . $settings->toc_bg_color . ';' : '';
}
?>

<?php
if ( isset( $settings->toc_width ) ) {
	echo ( '' !== $settings->toc_width ) ? 'width:' . $settings->toc_width . '%;' : '';
}
?>
}

<?php
if ( isset( $settings->icon_size ) ) {
	?>
.fl-node-<?php echo $id; ?> .uabb-icon {
	<?php
		echo ( '' !== $settings->icon_size ) ? 'font-size:' . $settings->icon_size . 'px;' : '';
	?>
}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-toc-container {
	<?php
	if ( isset( $settings->toc_padding_top ) ) {
		echo ( '' !== $settings->toc_padding_top ) ? 'padding-top:' . $settings->toc_padding_top . 'px;' : '';
	}
	if ( isset( $settings->toc_padding_right ) ) {
		echo ( '' !== $settings->toc_padding_right ) ? 'padding-right:' . $settings->toc_padding_right . 'px;' : '';
	}
	if ( isset( $settings->toc_padding_bottom ) ) {
		echo ( '' !== $settings->toc_padding_bottom ) ? 'padding-bottom:' . $settings->toc_padding_bottom . 'px;' : '';
	}
	if ( isset( $settings->toc_padding_left ) ) {
		echo ( '' !== $settings->toc_padding_left ) ? 'padding-left:' . $settings->toc_padding_left . 'px;' : '';
	}
	?>
}

<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-toc-container {
			<?php
			if ( isset( $settings->toc_border_style ) ) {
				echo ( '' !== $settings->toc_border_style ) ? 'border-style:' . $settings->toc_border_style . ';' : '';
			}
			if ( isset( $settings->toc_border_width ) ) {
				echo ( '' !== $settings->toc_border_width ) ? 'border-width:' . $settings->toc_border_width . 'px;' : '';
			}
			if ( isset( $settings->toc_border_color ) ) {
				echo ( '' !== $settings->toc_border_color ) ? 'border-color:' . $settings->toc_border_color . ';' : '';
			}
			?>
		}

		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'toc_border',
				'selector'     => ".fl-node-$id .uabb-toc-container",
			)
		);
	}
}
?>

/* Toc Separator CSS */

<?php if ( isset( $settings->separator_margin_bottom ) ) { ?>
.fl-node-<?php echo $id; ?> .uabb-separator-parent {
		<?php
			echo ( '' !== $settings->separator_margin_bottom ) ? 'margin-bottom:' . $settings->separator_margin_bottom . 'px;' : '';
		?>
	}
<?php } ?>

/* Toc Heading CSS */
<?php if ( isset( $settings->toc_margin_bottom ) ) { ?>
.fl-node-<?php echo $id; ?> .uabb-heading-block,
	.fl-node-<?php echo $id; ?> .uabb-toc-heading {
		<?php
			echo ( '' !== $settings->toc_margin_bottom ) ? 'margin-bottom:' . $settings->toc_margin_bottom . 'px;' : '';
		?>
	}
<?php } ?>

/* Heading Color */
<?php if ( isset( $settings->color ) ) { ?>
.fl-node-<?php echo $id; ?> .fl-module-content.fl-node-content .uabb-toc-heading {
	<?php
		echo ( '' !== $settings->color ) ? 'color:' . $settings->color . ';' : '';
	?>
}
<?php } ?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-heading-block,
		.fl-node-<?php echo $id; ?> .uabb-toc-heading  {

		<?php if ( ! empty( $settings->font ) && 'Default' !== $settings->font['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font ); ?>
		<?php endif; ?>

		<?php
		if ( isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) {
			?>
			font-size: <?php echo $settings->font_size_unit; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height_unit; ?>em;
		<?php } ?>

		<?php if ( 'none' !== $settings->transform ) : ?>
			text-transform: <?php echo $settings->transform; ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'font_typo',
				'selector'     => ".fl-node-$id .uabb-heading-block, .fl-node-$id .uabb-toc-heading",
			)
		);
	}
}
?>

/* TOC contents Color */

	.fl-node-<?php echo $id; ?> .uabb-toc-content-heading a,
	.fl-node-<?php echo $id; ?> #uabb-toc-togglecontents,
	.fl-node-<?php echo $id; ?> .uabb-toc-empty-note {
		<?php
		if ( isset( $settings->toc_content_color ) ) {
			echo ( '' !== $settings->toc_content_color ) ? 'color:' . $settings->toc_content_color . ';' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-toc-content-heading a:hover {
		<?php
		if ( isset( $settings->toc_content_hover_color ) ) {
			echo ( '' !== $settings->toc_content_hover_color ) ? 'color:' . $settings->toc_content_hover_color . ';' : '';
		}
		?>
	}

.fl-node-<?php echo $id; ?> .toc-lists li:not(:last-child) {
	<?php
	if ( isset( $settings->space_between_contents ) ) {
		echo ( '' !== $settings->space_between_contents ) ? '	padding-bottom:' . $settings->space_between_contents . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .toc-lists li ul,
.fl-node-<?php echo $id; ?> .toc-lists li ol {
	<?php
	if ( isset( $settings->space_between_contents ) ) {
		echo ( '' !== $settings->space_between_contents ) ? '	padding-top:' . $settings->space_between_contents . 'px;' : '';
	}
	?>
}

/* TOC content toggle switch  */

.fl-node-<?php echo $id; ?> .uabb-toggle-toc {
	<?php
	if ( isset( $settings->toc_toggle_color ) ) {
		echo ( '' !== $settings->toc_toggle_color ) ? 'color:' . $settings->toc_toggle_color . ';' : '';
	}
	?>

	<?php
	if ( isset( $settings->toggle_bg_color ) ) {
		echo ( '' !== $settings->toggle_bg_color ) ? 'background:' . $settings->toggle_bg_color . ';' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-toggle-toc:hover {

	<?php
	if ( isset( $settings->toc_toggle_hover_color ) ) {
		echo ( '' !== $settings->toc_toggle_hover_color ) ? 'color:' . $settings->toc_toggle_hover_color . ';' : '';
	}
	?>

	<?php
	if ( isset( $settings->toggle_bg_hover_color ) ) {
		echo ( '' !== $settings->toggle_bg_hover_color ) ? 'background:' . $settings->toggle_bg_hover_color . ';' : '';
	}
	?>
}
.fl-node-<?php echo $id; ?> .uabb-toggle-toc {
	<?php
	if ( isset( $settings->toc_toggle_padding_top ) ) {
		echo ( '' !== $settings->toc_toggle_padding_top ) ? 'padding-top:' . $settings->toc_toggle_padding_top . 'px;' : '';
	}
	if ( isset( $settings->toc_toggle_padding_right ) ) {
		echo ( '' !== $settings->toc_toggle_padding_right ) ? 'padding-right:' . $settings->toc_toggle_padding_right . 'px;' : '';
	}
	if ( isset( $settings->toc_toggle_padding_bottom ) ) {
		echo ( '' !== $settings->toc_toggle_padding_bottom ) ? 'padding-bottom:' . $settings->toc_toggle_padding_bottom . 'px;' : '';
	}
	if ( isset( $settings->toc_toggle_padding_left ) ) {
		echo ( '' !== $settings->toc_toggle_padding_left ) ? 'padding-left:' . $settings->toc_toggle_padding_left . 'px;' : '';
	}
	?>
}
<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-toggle-toc {
			<?php
			if ( isset( $settings->toc_toggle_border_style ) ) {
				echo ( '' !== $settings->toc_toggle_border_style ) ? 'border-style:' . $settings->toc_toggle_border_style . ';' : '';
			}
			if ( isset( $settings->toc_toggle_border_width ) ) {
				echo ( '' !== $settings->toc_toggle_border_width ) ? 'border-width:' . $settings->toc_toggle_border_width . 'px;' : '';
			}
			if ( isset( $settings->toc_toggle_border_color ) ) {
				echo ( '' !== $settings->toc_toggle_border_color ) ? 'border-color:' . $settings->toc_toggle_border_color . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'toc_toggle_border',
				'selector'     => ".fl-node-$id .uabb-toggle-toc",
			)
		);
	}
}
?>

/* TOC Scroll to top */

.fl-node-<?php echo $id; ?> .uabb-toc-scroll-icon {
	<?php
	if ( isset( $settings->scroll_icon_color ) ) {
		echo ( '' !== $settings->scroll_icon_color ) ? 'color:' . $settings->scroll_icon_color . ';' : '';
	}
	?>

	<?php
	if ( isset( $settings->scroll_bg_color ) ) {
		echo ( '' !== $settings->scroll_bg_color ) ? 'background:' . $settings->scroll_bg_color . ';' : '';
	}
	?>
}
/* TOC contents Typography */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-toc-content-heading a,
	.fl-node-<?php echo $id; ?> .uabb-toc-empty-note {

		<?php if ( ! empty( $settings->desc_font_family ) && 'Default' !== $settings->desc_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
		<?php endif; ?>

		<?php if ( isset( $settings->desc_font_size_unit ) && '' !== $settings->desc_font_size_unit ) { ?>
			font-size: <?php echo $settings->desc_font_size_unit; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->desc_line_height_unit ) && '' !== $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->desc_line_height_unit; ?>em;
		<?php } ?>

		<?php if ( 'none' !== $settings->desc_transform ) : ?>
			text-transform: <?php echo $settings->desc_transform; ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->desc_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->desc_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-toc-content-heading a, .fl-node-$id .uabb-toc-empty-note",
			)
		);
	}
}
?>

<?php /* Global Setting If started */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?>

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

			/* For Medium Device */

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-heading-block,
					.fl-node-<?php echo $id; ?> .uabb-toc-heading  {
					<?php if ( isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->font_size_unit_medium; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height_unit_medium; ?>em;
					<?php } ?>

				}
				.fl-node-<?php echo $id; ?> .uabb-toc-content-heading a {

					<?php if ( isset( $settings->desc_font_size_unit_medium ) && '' !== $settings->desc_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->desc_font_size_unit_medium; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_line_height_unit_medium ) && '' !== $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->desc_line_height_unit_medium; ?>em;
					<?php } ?>
				}

				<?php if ( isset( $settings->alignment_medium ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc {
					<?php
					echo ( '' !== $settings->alignment_medium ) ? 'text-align:' . $settings->alignment_medium . ';' : '';
					?>
			}
			<?php } ?>

				<?php	if ( isset( $settings->sep_alignment_medium ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc .uabb-module-content.uabb-separator-parent {
					<?php
					echo ( '' !== $settings->sep_alignment_medium ) ? 'text-align:' . $settings->sep_alignment_medium . ';' : '';
					?>
			}
		<?php	} ?>
			<?php } ?>

			.fl-node-<?php echo $id; ?> .uabb-toc-container {
				<?php
				if ( isset( $settings->toc_padding_top_medium ) ) {
					echo ( '' !== $settings->toc_padding_top_medium ) ? 'padding-top:' . $settings->toc_padding_top_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_right_medium ) ) {
					echo ( '' !== $settings->toc_padding_right_medium ) ? 'padding-right:' . $settings->toc_padding_right_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_bottom_medium ) ) {
					echo ( '' !== $settings->toc_padding_bottom_medium ) ? 'padding-bottom:' . $settings->toc_padding_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_left_medium ) ) {
					echo ( '' !== $settings->toc_padding_left_medium ) ? 'padding-left:' . $settings->toc_padding_left_medium . 'px;' : '';
				}
				?>

				<?php
				if ( isset( $settings->toc_width_medium ) ) {
					echo ( '' !== $settings->toc_width_medium ) ? 'width:' . $settings->toc_width_medium . '%;' : '';
				}
				?>

			}


			.fl-node-<?php echo $id; ?> .uabb-toggle-toc {
				<?php
				if ( isset( $settings->toc_toggle_padding_top_medium ) ) {
					echo ( '' !== $settings->toc_toggle_padding_top_medium ) ? 'padding-top:' . $settings->toc_toggle_padding_top_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_right ) ) {
					echo ( '' !== $settings->toc_toggle_padding_right_medium ) ? 'padding-right:' . $settings->toc_toggle_padding_right_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_bottom_medium ) ) {
					echo ( '' !== $settings->toc_toggle_padding_bottom_medium ) ? 'padding-bottom:' . $settings->toc_toggle_padding_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_left_medium ) ) {
					echo ( '' !== $settings->toc_toggle_padding_left_medium ) ? 'padding-left:' . $settings->toc_toggle_padding_left_medium . 'px;' : '';
				}
				?>
			}

		<?php if ( isset( $settings->icon_size_medium ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-icon {
				<?php
					echo ( '' !== $settings->icon_size_medium ) ? 'font-size:' . $settings->icon_size_medium . 'px;' : '';
				?>
			}
		<?php	} ?>

		}

		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-heading-block,
					.fl-node-<?php echo $id; ?> .uabb-toc-heading  {

					<?php if ( isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
					<?php } ?>
				}

				.fl-node-<?php echo $id; ?> .uabb-toc-content-heading a {

					<?php if ( isset( $settings->desc_font_size_unit_responsive ) && '' !== $settings->desc_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->desc_font_size_unit_responsive; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_line_height_unit_responsive ) && '' !== $settings->desc_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->desc_line_height_unit_responsive; ?>em;
					<?php } ?>
				}

				<?php if ( isset( $settings->alignment_responsive ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc {
					<?php
					echo ( '' !== $settings->alignment_responsive ) ? 'text-align:' . $settings->alignment_responsive . ';' : '';
					?>
			}
			<?php } ?>

				<?php if ( isset( $settings->sep_alignment_responsive ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-parent-wrapper-toc .uabb-module-content.uabb-separator-parent {
					<?php
					echo ( '' !== $settings->sep_alignment_responsive ) ? 'text-align:' . $settings->sep_alignment_responsive . ';' : '';
					?>
		<?php	} ?>
	}
			<?php } ?>

			.fl-node-<?php echo $id; ?> .uabb-toc-container {
				<?php
				if ( isset( $settings->toc_padding_top_responsive ) ) {
					echo ( '' !== $settings->toc_padding_top_responsive ) ? 'padding-top:' . $settings->toc_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_right_responsive ) ) {
					echo ( '' !== $settings->toc_padding_right_responsive ) ? 'padding-right:' . $settings->toc_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->toc_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->toc_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_padding_left_responsive ) ) {
					echo ( '' !== $settings->toc_padding_left_responsive ) ? 'padding-left:' . $settings->toc_padding_left_responsive . 'px;' : '';
				}
				?>

				<?php
				if ( isset( $settings->toc_width_responsive ) ) {
					echo ( '' !== $settings->toc_width_responsive ) ? 'width:' . $settings->toc_width_responsive . '%;' : '';
				}
				?>
				}


			.fl-node-<?php echo $id; ?> .uabb-toggle-toc {
				<?php
				if ( isset( $settings->toc_toggle_padding_top_responsive ) ) {
					echo ( '' !== $settings->toc_toggle_padding_top_responsive ) ? 'padding-top:' . $settings->toc_toggle_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_right ) ) {
					echo ( '' !== $settings->toc_toggle_padding_right_responsive ) ? 'padding-right:' . $settings->toc_toggle_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->toc_toggle_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->toc_toggle_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->toc_toggle_padding_left_responsive ) ) {
					echo ( '' !== $settings->toc_toggle_padding_left_responsive ) ? 'padding-left:' . $settings->toc_toggle_padding_left_responsive . 'px;' : '';
				}
				?>
			}

			<?php if ( isset( $settings->icon_size_responsive ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-icon {
				<?php
					echo ( '' !== $settings->icon_size_responsive ) ? 'font-size:' . $settings->icon_size_responsive . 'px;' : '';
				?>
			}
			<?php } ?>

		}
	<?php
}
