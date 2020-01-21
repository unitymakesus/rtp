<?php
/**
 *  UABB How To Module front-end CSS php file
 *
 *   @package UABB How To Module
 */

	$version_bb_check                   = UABB_Compatibility::check_bb_version();
	$settings->box_bg_color             = UABB_Helper::uabb_colorpicker( $settings, 'box_bg_color', true );
	$settings->title_color              = UABB_Helper::uabb_colorpicker( $settings, 'title_color', true );
	$settings->description_color        = UABB_Helper::uabb_colorpicker( $settings, 'description_color', true );
	$settings->total_time_color         = UABB_Helper::uabb_colorpicker( $settings, 'total_time_color', true );
	$settings->estimated_cost_color     = UABB_Helper::uabb_colorpicker( $settings, 'estimated_cost_color', true );
	$settings->supply_title_color       = UABB_Helper::uabb_colorpicker( $settings, 'supply_title_color', true );
	$settings->supply_text_color        = UABB_Helper::uabb_colorpicker( $settings, 'supply_text_color', true );
	$settings->tool_title_color         = UABB_Helper::uabb_colorpicker( $settings, 'tool_title_color', true );
	$settings->tool_text_color          = UABB_Helper::uabb_colorpicker( $settings, 'tool_text_color', true );
	$settings->step_section_title_color = UABB_Helper::uabb_colorpicker( $settings, 'step_section_title_color', true );
	$settings->step_title_color         = UABB_Helper::uabb_colorpicker( $settings, 'step_title_color', true );
	$settings->step_description_color   = UABB_Helper::uabb_colorpicker( $settings, 'step_description_color', true );

// Box - Border.
if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container {
		<?php
		if ( isset( $settings->box_border_style ) ) {
			echo ( '' !== esc_attr( $settings->box_border_style ) ) ? 'border-style:' . esc_attr( $settings->box_border_style ) . ';' : '';
		}
		if ( isset( $settings->box_border_width ) ) {
			echo ( '' !== esc_attr( $settings->box_border_width ) ) ? 'border-width:' . esc_attr( $settings->box_border_width ) . 'px;' : '';
		}
		if ( isset( $settings->box_border_color ) ) {
			echo ( '' !== esc_attr( $settings->box_border_color ) ) ? 'border-color:' . esc_attr( $settings->box_border_color ) . ';' : '';
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
				'setting_name' => 'box_border',
				'selector'     => ".fl-node-$id .uabb-how-to-container",
			)
		);
	}
}

// Box - Padding.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container {
			<?php
			if ( isset( $settings->box_padding_top ) ) {
				echo ( '' !== esc_attr( $settings->box_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->box_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_left ) ) {
				echo ( '' !== esc_attr( $settings->box_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->box_padding_left ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_right ) ) {
				echo ( '' !== esc_attr( $settings->box_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->box_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_bottom ) ) {
				echo ( '' !== esc_attr( $settings->box_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->box_padding_bottom ) . 'px;' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'box_padding',
				'selector'     => ".fl-node-$id .uabb-how-to-container",
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'box_padding_top',
					'padding-right'  => 'box_padding_right',
					'padding-bottom' => 'box_padding_bottom',
					'padding-left'   => 'box_padding_left',
				),
			)
		);
	}
}

// Title - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-title {
			<?php if ( 'default' !== esc_attr( $settings->title_font_family['family'] ) && 'default' !== esc_attr( $settings->title_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->title_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->title_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->title_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->title_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->title_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->title_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->title_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->title_transform ) ) {
				echo ( '' !== esc_attr( $settings->title_transform ) ) ? 'text-transform:' . esc_attr( $settings->title_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_typography',
				'selector'     => ".fl-node-$id .uabb-how-to-title",
			)
		);
	}
}

// Description - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-description {
			<?php if ( 'default' !== esc_attr( $settings->description_font_family['family'] ) && 'default' !== esc_attr( $settings->description_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->description_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->description_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->description_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->description_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->description_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->description_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->description_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->description_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->description_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->description_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->description_transform ) ) {
				echo ( '' !== esc_attr( $settings->description_transform ) ) ? 'text-transform:' . esc_attr( $settings->description_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'description_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-description",
				)
			);
	}
}

?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container {
	<?php if ( isset( $settings->box_bg_color ) ) { ?>
		background-color: <?php echo esc_attr( $settings->box_bg_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->box_align ) ) { ?>
		text-align: <?php echo esc_attr( $settings->box_align ); ?>;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-title {
	<?php if ( isset( $settings->title_color ) ) { ?>
		color: <?php echo esc_attr( $settings->title_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->title_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->title_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-description {
	<?php if ( isset( $settings->description_color ) ) { ?>
		color: <?php echo esc_attr( $settings->description_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->description_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->description_margin ); ?>px;
	<?php } ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image {
	text-align: <?php echo esc_attr( $settings->image_align ); ?>;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image .uabb-how-to-img-decs {
	<?php if ( isset( $settings->image_width ) ) { ?>
		width: <?php echo esc_attr( $settings->image_width ) . 'px;'; ?>;
	<?php } ?>
}

<?php

// Image - Border.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-image .uabb-how-to-img-decs {
		<?php
		if ( isset( $settings->image_border_style ) ) {
			echo ( '' !== esc_attr( $settings->image_border_style ) ) ? 'border-style:' . esc_attr( $settings->image_border_style ) . ';' : '';
		}
		if ( isset( $settings->image_border_width ) ) {
			echo ( '' !== esc_attr( $settings->image_border_width ) ) ? 'border-width:' . esc_attr( $settings->image_border_width ) . 'px;' : '';
		}
		if ( isset( $settings->image_border_color ) ) {
			echo ( '' !== esc_attr( $settings->image_border_color ) ) ? 'border-color:' . esc_attr( $settings->image_border_color ) . ';' : '';
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
					'setting_name' => 'image_border',
					'selector'     => ".fl-node-$id .uabb-how-to-image .uabb-how-to-img-decs",
				)
			);
	}
}

// Image - Padding.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-image {
			<?php
			if ( isset( $settings->image_padding_top ) ) {
				echo ( '' !== esc_attr( $settings->image_padding_top ) ) ? 'padding-top:' . esc_attr( $settings->image_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->image_padding_left ) ) {
				echo ( '' !== esc_attr( $settings->image_padding_left ) ) ? 'padding-left:' . esc_attr( $settings->image_padding_left ) . 'px;' : '';
			}
			if ( isset( $settings->image_padding_right ) ) {
				echo ( '' !== esc_attr( $settings->image_padding_right ) ) ? 'padding-right:' . esc_attr( $settings->image_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->image_padding_bottom ) ) {
				echo ( '' !== esc_attr( $settings->image_padding_bottom ) ) ? 'padding-bottom:' . esc_attr( $settings->image_padding_bottom ) . 'px;' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'image_padding',
				'selector'     => ".fl-node-$id .uabb-how-to-image",
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'image_padding_top',
					'padding-right'  => 'image_padding_right',
					'padding-bottom' => 'image_padding_bottom',
					'padding-left'   => 'image_padding_left',
				),
			)
		);
	}
}

// Total Time - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-total-time {
			<?php if ( 'default' !== esc_attr( $settings->total_time_font_family['family'] ) && 'default' !== esc_attr( $settings->total_time_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->total_time_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->total_time_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->total_time_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->total_time_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->total_time_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->total_time_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->total_time_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->total_time_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->total_time_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->total_time_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->total_time_transform ) ) {
				echo ( '' !== esc_attr( $settings->total_time_transform ) ) ? 'text-transform:' . esc_attr( $settings->total_time_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'total_time_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-total-time",
				)
			);
	}
}

// Estimated Cost - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-estimated-cost {
			<?php if ( 'default' !== esc_attr( $settings->estimated_cost_font_family['family'] ) && 'default' !== esc_attr( $settings->estimated_cost_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->estimated_cost_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->estimated_cost_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->estimated_cost_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->estimated_cost_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->estimated_cost_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->estimated_cost_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->estimated_cost_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->estimated_cost_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->estimated_cost_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->estimated_cost_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->estimated_cost_transform ) ) {
				echo ( '' !== esc_attr( $settings->estimated_cost_transform ) ) ? 'text-transform:' . esc_attr( $settings->estimated_cost_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'estimated_cost_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-estimated-cost",
				)
			);
	}
}
// Supply Title - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-supply-title {
			<?php if ( 'default' !== esc_attr( $settings->supply_title_font_family['family'] ) && 'default' !== esc_attr( $settings->supply_title_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->supply_title_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->supply_title_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->supply_title_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->supply_title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->supply_title_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->supply_title_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->supply_title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->supply_title_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->supply_title_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->supply_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->supply_title_transform ) ) {
				echo ( '' !== esc_attr( $settings->supply_title_transform ) ) ? 'text-transform:' . esc_attr( $settings->supply_title_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'supply_title_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-supply-title",
				)
			);
	}
}

// Supply Text - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-supply {
			<?php if ( 'default' !== esc_attr( $settings->supply_text_font_family['family'] ) && 'default' !== esc_attr( $settings->supply_text_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->supply_text_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->supply_text_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->supply_text_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->supply_text_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->supply_text_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->supply_text_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->supply_text_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->supply_text_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->supply_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->supply_text_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->supply_text_transform ) ) {
				echo ( '' !== esc_attr( $settings->supply_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->supply_text_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'supply_text_typography',
					'selector'     => ".fl-node-$id .uabb-supply",
				)
			);
	}
}

// Tool Title - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-tool-title {
			<?php if ( 'default' !== esc_attr( $settings->tool_title_font_family['family'] ) && 'default' !== esc_attr( $settings->tool_title_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->tool_title_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->tool_title_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->tool_title_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->tool_title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->tool_title_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->tool_title_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->tool_title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->tool_title_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->tool_title_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->tool_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->tool_title_transform ) ) {
				echo ( '' !== esc_attr( $settings->tool_title_transform ) ) ? 'text-transform:' . esc_attr( $settings->tool_title_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'tool_title_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-tool-title",
				)
			);
	}
}

// Tool Text - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-tool {
			<?php if ( 'default' !== esc_attr( $settings->tool_text_font_family['family'] ) && 'default' !== esc_attr( $settings->tool_text_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->tool_text_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->tool_text_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->tool_text_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->tool_text_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->tool_text_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->tool_text_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->tool_text_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->tool_text_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->tool_text_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->tool_text_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->tool_text_transform ) ) {
				echo ( '' !== esc_attr( $settings->tool_text_transform ) ) ? 'text-transform:' . esc_attr( $settings->tool_text_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'tool_text_typography',
					'selector'     => ".fl-node-$id .uabb-tool",
				)
			);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-total-time {
	<?php if ( isset( $settings->total_time_color ) ) { ?>
		color: <?php echo esc_attr( $settings->total_time_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->total_time_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->total_time_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-estimated-cost {
	<?php if ( isset( $settings->estimated_cost_color ) ) { ?>
		color: <?php echo esc_attr( $settings->estimated_cost_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->estimated_cost_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->estimated_cost_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply-title {
	<?php if ( isset( $settings->supply_title_color ) ) { ?>
		color: <?php echo esc_attr( $settings->supply_title_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->supply_title_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->supply_title_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-supply {
	<?php if ( isset( $settings->supply_text_color ) ) { ?>
		color: <?php echo esc_attr( $settings->supply_text_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->supply_text_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->supply_text_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool-title {
	<?php if ( isset( $settings->tool_title_color ) ) { ?>
		color: <?php echo esc_attr( $settings->tool_title_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->tool_title_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->tool_title_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-tool {
	<?php if ( isset( $settings->tool_text_color ) ) { ?>
		color: <?php echo esc_attr( $settings->tool_text_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->tool_text_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->tool_text_margin ); ?>px;
	<?php } ?>
}
<?php
// Step Section Title - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-step-section-title {
			<?php if ( 'default' !== esc_attr( $settings->step_section_title_font_family['family'] ) && 'default' !== esc_attr( $settings->step_section_title_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->step_section_title_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->step_section_title_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_section_title_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->step_section_title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->step_section_title_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_section_title_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->step_section_title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->step_section_title_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->step_section_title_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->step_section_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->step_section_title_transform ) ) {
				echo ( '' !== esc_attr( $settings->step_section_title_transform ) ) ? 'text-transform:' . esc_attr( $settings->step_section_title_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'step_section_title_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-step-section-title",
				)
			);
	}
}

// Step Title - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-step-title {
			<?php if ( 'default' !== esc_attr( $settings->step_title_font_family['family'] ) && 'default' !== esc_attr( $settings->step_title_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->step_title_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->step_title_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_title_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->step_title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->step_title_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_title_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->step_title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->step_title_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->step_title_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->step_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->step_title_transform ) ) {
				echo ( '' !== esc_attr( $settings->step_title_transform ) ) ? 'text-transform:' . esc_attr( $settings->step_title_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'step_title_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-step-title",
				)
			);
	}
}

// Step Description - Typography.
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-step-description {
			<?php if ( 'default' !== esc_attr( $settings->step_description_font_family['family'] ) && 'default' !== esc_attr( $settings->step_description_font_family['weight'] ) ) : ?>
				<?php FLBuilderFonts::font_css( esc_attr( $settings->step_description_font_family ) ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->step_description_font_size_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_description_font_size_unit ) ) ? 'font-size:' . esc_attr( $settings->step_description_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->step_description_line_height_unit ) ) {
				echo ( '' !== esc_attr( $settings->step_description_line_height_unit ) ) ? 'line-height:' . esc_attr( $settings->step_description_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->step_description_letter_spacing ) ) {
				echo ( '' !== esc_attr( $settings->step_description_letter_spacing ) ) ? 'letter-spacing:' . esc_attr( $settings->step_description_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->step_description_transform ) ) {
				echo ( '' !== esc_attr( $settings->step_description_transform ) ) ? 'text-transform:' . esc_attr( $settings->step_description_transform ) . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {

			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'step_description_typography',
					'selector'     => ".fl-node-$id .uabb-how-to-step-description",
				)
			);
	}
}

?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step {
	<?php if ( isset( $settings->steps_spacing ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->steps_spacing ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-steps .uabb-how-to-step-section-title {
	<?php if ( isset( $settings->step_section_title_color ) ) { ?>
		color: <?php echo esc_attr( $settings->step_section_title_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->step_section_title_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->step_section_title_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step.uabb-has-img .uabb-how-to-step-content {
	<?php if ( isset( $settings->step_image_align ) && ( 'row' === $settings->step_image_align || 'row-reverse' === $settings->step_image_align ) ) { ?>
		width: <?php echo '100' - ( isset( $settings->step_image_width ) ? esc_attr( $settings->step_image_width ) : '0' ); ?>%;
	<?php } elseif ( isset( $settings->step_image_align ) && 'column' === $settings->step_image_align ) { ?>
		width: 100%;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step.uabb-has-img .uabb-how-to-step-image {
	<?php if ( isset( $settings->step_image_width ) ) { ?>
		width: <?php echo esc_attr( $settings->step_image_width ); ?>%;
	<?php } ?>
	<?php if ( isset( $settings->step_image_align ) && 'row' === $settings->step_image_align ) { ?>
		margin-left: <?php echo esc_attr( $settings->step_image_spacing ); ?>px;
	<?php } elseif ( isset( $settings->step_image_align ) && 'row-reverse' === $settings->step_image_align ) { ?>
		margin-right: <?php echo esc_attr( $settings->step_image_spacing ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step .uabb-how-to-step-title {
	<?php if ( isset( $settings->step_title_color ) ) { ?>
		color: <?php echo esc_attr( $settings->step_title_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->step_title_margin ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->step_title_margin ); ?>px;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step .uabb-how-to-step-description {
	<?php if ( isset( $settings->step_description_color ) ) { ?>
		color: <?php echo esc_attr( $settings->step_description_color ); ?>;
	<?php } ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step-wrap {
	<?php if ( isset( $settings->step_image_align ) ) { ?>
		flex-direction: <?php echo esc_attr( $settings->step_image_align ); ?>;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool {
<?php if ( isset( $settings->supply_text_margin_bottom ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->supply_text_margin_bottom ); ?>px;
<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply {
<?php if ( isset( $settings->tool_text_margin_bottom ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->tool_text_margin_bottom ); ?>px;
<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image {
<?php if ( isset( $settings->image_margin_bottom ) ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->image_margin_bottom ); ?>px;
<?php } ?>
}

<?php /* Global Setting If started */ ?>

<?php if ( $global_settings->responsive_enabled ) { ?>

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

			/* For Medium Device */
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-title {

				<?php if ( isset( $settings->title_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->title_margin_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-description {
				<?php if ( isset( $settings->description_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->description_margin_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image .uabb-how-to-img-decs {
				<?php if ( isset( $settings->image_width_medium ) ) { ?>
					width: <?php echo esc_attr( $settings->image_width_medium ) . 'px;'; ?>;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-total-time {

				<?php if ( isset( $settings->total_time_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->total_time_margin_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-estimated-cost {

				<?php if ( isset( $settings->estimated_cost_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->estimated_cost_margin_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply-title {

				<?php if ( isset( $settings->supply_title_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->supply_title_margin_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-supply {

				<?php if ( isset( $settings->supply_text_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->supply_text_margin_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool-title {

				<?php if ( isset( $settings->tool_title_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->tool_title_margin_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-tool {

				<?php if ( isset( $settings->tool_text_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->tool_text_margin_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step {
				<?php if ( isset( $settings->steps_spacing_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->steps_spacing_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-steps .uabb-how-to-step-section-title {
				<?php if ( isset( $settings->step_section_title_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->step_section_title_margin_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step.uabb-has-img .uabb-how-to-step-image {
				<?php if ( isset( $settings->step_image_width_medium ) ) { ?>
					width: <?php echo esc_attr( $settings->step_image_width_medium ); ?>%;
				<?php } ?>
				<?php if ( isset( $settings->step_image_align ) && 'row' === $settings->step_image_align ) { ?>
					margin-left: <?php echo esc_attr( $settings->step_image_spacing_medium ); ?>px;
				<?php } elseif ( isset( $settings->step_image_align ) && 'row-reverse' === $settings->step_image_align ) { ?>
					margin-right: <?php echo esc_attr( $settings->step_image_spacing_medium ); ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step .uabb-how-to-step-title {
				<?php if ( isset( $settings->step_title_margin_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->step_title_margin_medium ); ?>px;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool {
			<?php if ( isset( $settings->supply_text_margin_bottom_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->supply_text_margin_bottom_medium ); ?>px;
			<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply {
			<?php if ( isset( $settings->tool_text_margin_bottom_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->tool_text_margin_bottom_medium ); ?>px;
			<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image {
			<?php if ( isset( $settings->image_margin_bottom_medium ) ) { ?>
					margin-bottom: <?php echo esc_attr( $settings->image_margin_bottom_medium ); ?>px;
			<?php } ?>
			}
}
<?php /* Small Breakpoint media query */ ?>
@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

	/* For Small Device */

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-title {

		<?php if ( isset( $settings->title_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->title_margin_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-description {
		<?php if ( isset( $settings->description_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->description_margin_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image .uabb-how-to-img-decs {
		<?php if ( isset( $settings->image_width_responsive ) ) { ?>
			width: <?php echo esc_attr( $settings->image_width_responsive ) . 'px;'; ?>;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-total-time {

		<?php if ( isset( $settings->total_time_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->total_time_margin_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-estimated-cost {

		<?php if ( isset( $settings->estimated_cost_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->estimated_cost_margin_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply-title {

		<?php if ( isset( $settings->supply_title_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->supply_title_margin_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-supply {

		<?php if ( isset( $settings->supply_text_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->supply_text_margin_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool-title {

		<?php if ( isset( $settings->tool_title_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->tool_title_margin_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-tool {

		<?php if ( isset( $settings->tool_text_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->tool_text_margin_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step {
		<?php if ( isset( $settings->steps_spacing_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->steps_spacing_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-steps .uabb-how-to-step-section-title {
		<?php if ( isset( $settings->step_section_title_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->step_section_title_margin_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step.uabb-has-img .uabb-how-to-step-image {
		<?php if ( isset( $settings->step_image_width_responsive ) ) { ?>
			width: <?php echo esc_attr( $settings->step_image_width_responsive ); ?>%;
		<?php } ?>
		<?php if ( isset( $settings->step_image_align ) && 'row' === $settings->step_image_align ) { ?>
			margin-left: <?php echo esc_attr( $settings->step_image_spacing_responsive ); ?>px;
		<?php } elseif ( isset( $settings->step_image_align ) && 'row-reverse' === $settings->step_image_align ) { ?>
			margin-right: <?php echo esc_attr( $settings->step_image_spacing_responsive ); ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-step .uabb-how-to-step-title {
		<?php if ( isset( $settings->step_title_margin_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->step_title_margin_responsive ); ?>px;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-tool {
	<?php if ( isset( $settings->supply_text_margin_bottom_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->supply_text_margin_bottom_responsive ); ?>px;
	<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-supply {
	<?php if ( isset( $settings->tool_text_margin_bottom_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->tool_text_margin_bottom_responsive ); ?>px;
	<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-how-to-container .uabb-how-to-image {
	<?php if ( isset( $settings->image_margin_bottom_responsive ) ) { ?>
			margin-bottom: <?php echo esc_attr( $settings->image_margin_bottom_responsive ); ?>px;
	<?php } ?>
	}
}
<?php } ?>
