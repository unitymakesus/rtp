<?php
/**
 *  UABB Pricing Table Module front-end CSS php file
 *
 *  @package UABB Pricing Table Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->foreground_outside = UABB_Helper::uabb_colorpicker( $settings, 'foreground_outside', true );

$settings->column_background = UABB_Helper::uabb_colorpicker( $settings, 'column_background', true );
$settings->border_color      = UABB_Helper::uabb_colorpicker( $settings, 'border_color' );

if ( 'yes' === $settings->add_legend ) {
	$settings->legend_column->foreground = UABB_Helper::uabb_colorpicker( $settings->legend_column, 'foreground', true );

	$settings->legend_column->even_properties_bg = UABB_Helper::uabb_colorpicker( $settings->legend_column, 'even_properties_bg', true );
	$settings->legend_column->legend_color       = UABB_Helper::uabb_colorpicker( $settings->legend_column, 'legend_color' );
}

$foreground_outside = ( '' !== $settings->foreground_outside ) ? 'background: ' . esc_attr( $settings->foreground_outside ) : 'background: #f7f7f7';
?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-creative-button-wrap {
	margin-top: <?php echo ( '' !== $settings->btn_margin_top ) ? esc_attr( $settings->btn_margin_top ) : '20'; ?>px;
	margin-bottom: <?php echo ( '' !== $settings->btn_margin_bottom ) ? esc_attr( $settings->btn_margin_bottom ) : '20'; ?>px;
}

<?php

if ( 'yes' === $settings->add_legend ) {
	$columns = count( $settings->pricing_columns ) + 1;
} else {
	$columns = count( $settings->pricing_columns );
}
?>

<?php
if ( 'yes' === $settings->show_spacing && '' !== $settings->spacing ) {
	?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-col-<?php echo esc_attr( $columns ); ?> {
	padding: 0 <?php echo esc_attr( ( $settings->spacing / 2 ) ) . 'px'; ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table {
	margin: 0 -<?php echo esc_attr( ( $settings->spacing / 2 ) ); ?>px;
}
	<?php
}
?>
<?php
if ( 'yes' === $settings->add_legend ) {
	$l_bg_color = ( '' !== $settings->legend_column->foreground ) ? $settings->legend_column->foreground : ( ( '' !== $settings->foreground_outside ) ? $settings->foreground_outside : '#f7f7f7' );
	if ( '' !== $l_bg_color ) {
		?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-0 .uabb-pricing-table-column-0 {
		background: <?php echo esc_attr( $l_bg_color ); ?>;
	}
		<?php
	}
}

if ( 'yes' === $settings->show_spacing ) {
	$border_size = ( '' !== $settings->border_size ) ? $settings->border_size : 1;
	if ( 'none' !== $settings->border_style ) {
		?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-0 .uabb-pricing-table-column-0 {
		<?php echo ( 'none' !== $settings->border_style ) ? 'border: ' . esc_attr( $border_size ) . 'px ' . esc_attr( $settings->border_style ) . ' ' . esc_attr( $settings->border_color ) : ''; ?>
}
		<?php
	} else {
		?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-0 .uabb-pricing-table-column-0 {
		<?php echo ( '' !== $settings->border_radius ) ? 'border-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-radius: 1px;'; ?>
}
		<?php
	}
	?>
	<?php
} else {
	if ( 'none' === $settings->border_style ) {
		?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-0 .uabb-pricing-table-column-0 {
		<?php
		echo ( '' !== $settings->border_radius ) ? 'border-top-left-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-top-left-radius: 1px;';
		echo ( '' !== $settings->border_radius ) ? 'border-bottom-left-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-bottom-left-radius: 1px;';
		?>
}
		<?php
	}
}
?>

<?php
if ( 'yes' === $settings->add_legend ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-0 .uabb-pricing-table-features li:nth-child(even) {
		<?php echo ( '' !== $settings->legend_column->even_properties_bg ) ? 'background: ' . esc_attr( $settings->legend_column->even_properties_bg ) . ';' : ''; ?>
	}
	<?php
}
?>

.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-0 .uabb-button-wrap {
	visibility: hidden;
}

<?php
if ( 'no' === $settings->show_spacing ) {
	$border_size = ( '' !== $settings->border_size ) ? $settings->border_size : 1;
	if ( 'none' !== $settings->border_style ) {
		?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table {
		<?php
		echo ( 'none' !== $settings->border_style ) ? 'border: ' . esc_attr( $border_size ) . 'px ' . esc_attr( $settings->border_style ) . ' ' . esc_attr( $settings->border_color ) : '';
		?>
}
		<?php
	} else {
		?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table {
		<?php echo ( '' !== $settings->border_radius ) ? 'border-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-radius: 1px;'; ?>
}
		<?php
	}
	?>
	<?php
}

$border_size = ( '' !== $settings->border_size ) ? $settings->border_size : 1;
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-featured-pricing-box {
	bottom: 100%;
	<?php if ( 'yes' !== $settings->responsive_size ) { ?>
		bottom: calc(100% + <?php echo esc_attr( $border_size ); ?>px);
	<?php } ?>
}

/*Fix when price is NOT highlighted*/
<?php if ( 'title' === $settings->highlight || 'none' === $settings->highlight ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-0 .uabb-pricing-table-price {
	margin-bottom: 0;
	padding-bottom: 0;
}
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-0 .uabb-pricing-table-features {
	margin-top: 10px;
}
<?php endif; ?>

/*Fix when NOTHING is highlighted*/
<?php if ( 'none' === $settings->highlight ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-0 .uabb-pricing-table-title {
	padding-bottom: 0;
}

<?php endif; ?>

<?php if ( isset( $settings->list_icon_size ) && '' !== $settings->list_icon_size ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-price-table-icon-before,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-price-table-icon-after {
		font-size: <?php echo esc_attr( $settings->list_icon_size ); ?>px;
	}
<?php } ?>

<?php if ( isset( $settings->title_icon_size ) && '' !== $settings->title_icon_size ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-price-table-title-icon {
		font-size: <?php echo esc_attr( $settings->title_icon_size ); ?>px;
	}
<?php } ?>

<?php if ( isset( $settings->title_icon_spacing ) && '' !== $settings->title_icon_spacing ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-price-table-title-icon {
		margin-right: <?php echo esc_attr( $settings->title_icon_spacing ); ?>px;
	}
<?php } ?>

<?php
$is_featured_set = false;
// Loop through and style each pricing box.
$count = count( $settings->pricing_columns );
for ( $i = 0; $i < $count; $i++ ) :

	if ( ! is_object( $settings->pricing_columns[ $i ] ) ) {
		continue;
	}

		$pricing_column = $settings->pricing_columns[ $i ];
	// Pricing Box Settings.
	if ( ! $version_bb_check ) {

		$settings->pricing_columns[ $i ]->featured_font_family = (array) $settings->pricing_columns[ $i ]->featured_font_family;
	}

			$settings->pricing_columns[ $i ]->foreground = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'foreground', true );

			$settings->pricing_columns[ $i ]->even_properties_bg = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'even_properties_bg', true );

			$settings->pricing_columns[ $i ]->featured_f_background_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'featured_f_background_color', true );

			$settings->pricing_columns[ $i ]->features_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'features_color' );

			$settings->pricing_columns[ $i ]->featured_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'featured_color' );

			$settings->pricing_columns[ $i ]->title_typography_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'title_typography_color' );

			$settings->pricing_columns[ $i ]->price_typography_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'price_typography_color' );

			$settings->pricing_columns[ $i ]->original_price_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'original_price_color' );

			$settings->pricing_columns[ $i ]->duration_typography_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'duration_typography_color' );

			$settings->pricing_columns[ $i ]->highlight_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'highlight_color' );

			$settings->pricing_columns[ $i ]->list_icon_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'list_icon_color' );

			$settings->pricing_columns[ $i ]->title_icon_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'title_icon_color' );

	if ( isset( $settings->list_icon_spacing ) && '' !== $settings->list_icon_spacing ) {
		if ( 'before' === $settings->pricing_columns[ $i ]->icon_position ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-table-icon-before {
				margin-right: <?php echo esc_attr( $settings->list_icon_spacing ); ?>px;
			}
			<?php
		}
		if ( 'after' === $settings->pricing_columns[ $i ]->icon_position ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-table-icon-after {
				margin-left: <?php echo esc_attr( $settings->list_icon_spacing ); ?>px;
			}
			<?php
		}
	}
	if ( ! empty( $settings->pricing_columns[ $i ]->list_icon_color ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-feature-list-icon {
			color: <?php echo esc_attr( $settings->pricing_columns[ $i ]->list_icon_color ); ?>;
		}
		<?php
	}
	if ( ! empty( $settings->pricing_columns[ $i ]->title_icon_color ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-table-title-icon {
			color: <?php echo esc_attr( $settings->pricing_columns[ $i ]->title_icon_color ); ?>;
		}
		<?php
	}

	if ( 'stacked' === $settings->pricing_columns[ $i ]->title_icon_position ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-table-title-icon {
			display: block;
		}
	<?php } ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-table-original-price {
		<?php echo ( '' !== $settings->pricing_columns[ $i ]->original_price_color ) ? 'color: ' . esc_attr( $settings->pricing_columns[ $i ]->original_price_color ) . ';' : ''; ?>
	}

	<?php
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings->pricing_columns[ $i ],
				'setting_name' => 'list_box_padding',
				'selector'     => ".fl-node-$id .uabb-pricing-table-outter-" . ( $i + 1 ) . ' .uabb-pricing-table-features',
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'list_box_padding_top',
					'padding-right'  => 'list_box_padding_right',
					'padding-bottom' => 'list_box_padding_bottom',
					'padding-left'   => 'list_box_padding_left',
				),
			)
		);
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings->pricing_columns[ $i ],
				'setting_name' => 'list_item_padding',
				'selector'     => ".fl-node-$id .uabb-pricing-table-outter-" . ( $i + 1 ) . ' .uabb-pricing-table-features li',
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'list_item_padding_top',
					'padding-right'  => 'list_item_padding_right',
					'padding-bottom' => 'list_item_padding_bottom',
					'padding-left'   => 'list_item_padding_left',
				),
			)
		);
	}

	if ( 'yes' === $settings->pricing_columns[ $i ]->price_box_shadow ) {

		$box_shadow_color = ( false === strpos( $settings->pricing_columns[ $i ]->box_shadow_color, 'rgb' ) ) ? '#' . $settings->pricing_columns[ $i ]->box_shadow_color : $settings->pricing_columns[ $i ]->box_shadow_color;
		?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-column {
			-webkit-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_spr ); ?>px <?php echo esc_attr( $box_shadow_color ); ?>;
			-moz-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_spr ); ?>px <?php echo esc_attr( $box_shadow_color ); ?>;
			-o-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_spr ); ?>px <?php echo esc_attr( $box_shadow_color ); ?>;
			box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->box_shadow_color_spr ); ?>px <?php echo esc_attr( $box_shadow_color ); ?>;
		}

		<?php
	}

	if ( 'yes' === $settings->pricing_columns[ $i ]->set_featured ) {
		$is_featured_set = true;

		if ( 'no' === $settings->pricing_columns[ $i ]->show_button ) {
			?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-features li:last-child {
						margin-bottom: 0;
					}		
					<?php
		}
		?>
					.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {
			<?php
				echo 'color: ' . esc_attr( uabb_theme_text_color( $settings->pricing_columns[ $i ]->featured_color ) ) . ';';
				echo 'background: ' . esc_attr( uabb_theme_base_color( $settings->pricing_columns[ $i ]->featured_f_background_color ) ) . ';';
			?>
					}
			<?php if ( ! $version_bb_check ) { ?>
				.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {

				<?php
				if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_font_size_unit ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size_unit ) {
					?>
	font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size_unit ); ?>px;
				<?php } elseif ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit ) && '' === $settings->pricing_columns[ $i ]->featured_font_size_unit && isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size->desktop ) { ?>
	font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size->desktop ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && is_object( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && '' === $settings->pricing_columns[ $i ]->featured_font_size->desktop && isset( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && is_object( $settings->pricing_columns[ $i ]->featured_line_height->desktop && '' !== $settings->pricing_columns[ $i ]->featured_line_height->desktop && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit ) ) { ?>
	line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->desktop ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_line_height_unit ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height_unit ); ?>em;
				<?php } elseif ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit ) && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit && isset( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height->desktop ) { ?>
	line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->desktop ); ?>px;
				<?php } ?>

				<?php if ( 'none' !== $settings->pricing_columns[ $i ]->featured_transform ) : ?>
	text-transform: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_transform ); ?>;
				<?php endif; ?>

				<?php if ( '' !== $settings->pricing_columns[ $i ]->featured_letter_spacing ) : ?>
	letter-spacing: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_letter_spacing ); ?>px;
				<?php endif; ?>

				<?php

				echo ( 'Default' !== $settings->pricing_columns[ $i ]->featured_font_family['family'] ) ? 'font-family: ' . esc_attr( $settings->pricing_columns[ $i ]->featured_font_family['family'] ) . ';' : '';
				echo ( 'default' !== $settings->pricing_columns[ $i ]->featured_font_family['weight'] ) ? 'font-weight: ' . esc_attr( $settings->pricing_columns[ $i ]->featured_font_family['weight'] ) . ';' : '';
				?>
}
				<?php
			} else {
				if ( class_exists( 'FLBuilderCSS' ) ) {
					FLBuilderCSS::typography_field_rule(
						array(
							'settings'     => $settings->pricing_columns[ $i ],
							'setting_name' => 'featured_typo',
							'selector'     => ".fl-builder-content .fl-node-$id .uabb-pricing-table-column-" . ( $i + 1 ) . ' .uabb-featured-pricing-box',
						)
					);
				}
			}
			?>
		<?php
		if ( $global_settings->responsive_enabled ) { // Global Setting If started.
			?>
				@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
					<?php if ( ! $version_bb_check ) { ?>
					.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {

						<?php if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ) && '' === $settings->pricing_columns[ $i ]->featured_font_size_unit_medium && isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size->medium ) { ?>
						font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size->medium ); ?>px;
					<?php } ?>

						<?php if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && is_object( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && '' === $settings->pricing_columns[ $i ]->featured_font_size->medium && isset( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && is_object( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height->medium && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->medium ); ?>px;
					<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ); ?>em;
					<?php } elseif ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit_medium && isset( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height->medium ) { ?>
						line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->medium ); ?>px;
					<?php } ?>

					}
				<?php } else { ?>
					.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {
						<?php
						if ( isset( $settings->pricing_columns[ $i ]->featured_typo_medium->font_size->length ) ) {
							echo 'font-size:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_medium->font_size->length ) . 'px;';
						}
						if ( isset( $settings->pricing_columns[ $i ]->featured_typo_medium->line_height->length ) ) {
							echo 'line-height:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_medium->line_height->length ) . 'em;';
						}
						if ( isset( $settings->pricing_columns[ $i ]->featured_typo_medium->letter_spacing->length ) ) {
							echo 'letter-spacing:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_medium->letter_spacing->length ) . 'px;';
						}
						if ( isset( $settings->pricing_columns[ $i ]->featured_typo_medium->text_transform ) ) {
							echo 'text-transform:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_medium->text_transform ) . ';';
						}
						?>
					}
				<?php } ?>
				}

				@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
					<?php if ( ! $version_bb_check ) { ?>
					.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {

						<?php if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) { ?>
							font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ); ?>px;
							<?php if ( '' === $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive && '' !== $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive + 2 ); ?>px;
								<?php
							}
						} elseif ( isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) && '' === $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive && isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) && '' !== $settings->pricing_columns[ $i ]->featured_font_size->small ) {
							?>
							font-size: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size->small ); ?>px;
							line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_font_size->small + 2 ); ?>px;
						<?php } ?>

						<?php if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) && is_object( $settings->pricing_columns[ $i ]->featured_font_size->small ) && '' === $settings->pricing_columns[ $i ]->featured_font_size->small && isset( $settings->pricing_columns[ $i ]->featured_line_height->small ) && is_object( $settings->pricing_columns[ $i ]->featured_line_height->small ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height->small && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->small ); ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ); ?>em;
						<?php } elseif ( isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) && '' === $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive && isset( $settings->pricing_columns[ $i ]->featured_line_height->small ) && '' !== $settings->pricing_columns[ $i ]->featured_line_height->small ) { ?>
							line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->featured_line_height->small ); ?>px;
						<?php } ?>

					}
					<?php } else { ?>
						.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {
							<?php
							if ( isset( $settings->pricing_columns[ $i ]->featured_typo_responsive->font_size->length ) ) {
								echo 'font-size:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_responsive->font_size->length ) . 'px;';
							}
							if ( isset( $settings->pricing_columns[ $i ]->featured_typo_responsive->line_height->length ) ) {
								echo 'line-height:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_responsive->line_height->length ) . 'em;';
							}
							if ( isset( $settings->pricing_columns[ $i ]->featured_typo_responsive->letter_spacing->length ) ) {
								echo 'letter-spacing:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_responsive->letter_spacing->length ) . 'px;';
							}
							if ( isset( $settings->pricing_columns[ $i ]->featured_typo_responsive->text_transform ) ) {
								echo 'text-transform:' . esc_attr( $settings->pricing_columns[ $i ]->featured_typo_responsive->text_transform ) . ';';
							}
							?>
						}
				<?php } ?>
				}
					<?php
		}
	}
	?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> {
			<?php echo esc_attr( ( '' !== $settings->pricing_columns[ $i ]->foreground ) ? 'background: ' . $settings->pricing_columns[ $i ]->foreground : $foreground_outside ); ?>;
			<?php
			if ( 'yes' === $settings->show_spacing ) {
				$border_size = ( '' !== $settings->border_size ) ? $settings->border_size : 1;
				if ( 'none' !== $settings->border_style ) {
					echo 'border: ' . esc_attr( $border_size ) . 'px ' . esc_attr( $settings->border_style ) . ' ' . esc_attr( $settings->border_color );
				} else {
					echo ( '' !== $settings->border_radius ) ? 'border-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-radius: 1px;';
				}
				?>
				<?php
			} else {
				if ( 'none' === $settings->border_style ) {
					if ( ( $i + 1 ) === count( $settings->pricing_columns ) ) {
						echo ( '' !== $settings->border_radius ) ? 'border-top-right-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-top-right-radius: 1px;';
						echo ( '' !== $settings->border_radius ) ? 'border-bottom-right-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : 'border-bottom-right-radius: 1px;';
					}
				}
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> {
			<?php
			if ( isset( $settings->box_padding_top ) ) {
				echo ( '' !== $settings->box_padding_top ) ? 'padding-top:' . esc_attr( $settings->box_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_right ) ) {
				echo ( '' !== $settings->box_padding_right ) ? 'padding-right:' . esc_attr( $settings->box_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_bottom ) ) {
				echo ( '' !== $settings->box_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->box_padding_bottom ) . 'px;' : '';
			}
			if ( isset( $settings->box_padding_left ) ) {
				echo ( '' !== $settings->box_padding_left ) ? 'padding-left:' . esc_attr( $settings->box_padding_left ) . 'px;' : '';
			}
			?>
		}
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?>.uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> {
				<?php
				if ( isset( $settings->box_padding_top_medium ) ) {
					echo ( '' !== $settings->box_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->box_padding_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_right_medium ) ) {
					echo ( '' !== $settings->box_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->box_padding_right_medium ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_bottom_medium ) ) {
					echo ( '' !== $settings->box_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->box_padding_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_left_medium ) ) {
					echo ( '' !== $settings->box_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->box_padding_left_medium ) . 'px;' : '';
				}
				?>
			}
		}
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> {
				<?php
				if ( isset( $settings->box_padding_top_responsive ) ) {
					echo ( '' !== $settings->box_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->box_padding_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_right_responsive ) ) {
					echo ( '' !== $settings->box_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->box_padding_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->box_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->box_padding_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->box_padding_left_responsive ) ) {
					echo ( '' !== $settings->box_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->box_padding_left_responsive ) . 'px;' : '';
				}
				?>
			}
		}
		<?php
		if ( 'yes' === $settings->responsive_size ) {
			$size = ( '' !== $settings->resp_size ) ? $settings->resp_size : '768';
			?>
		@media all and ( min-width: <?php echo esc_attr( $size ); ?>px ) {
			<?php
			$border_size = ( '' !== $settings->border_size ) ? $settings->border_size : 1;
			if ( 'none' !== $settings->border_style ) {
				?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-featured-pricing-box {
						border: <?php echo esc_attr( $border_size ) . 'px ' . esc_attr( $settings->border_style ) . ' ' . esc_attr( $settings->border_color ); ?>;
						border-bottom: 0;
						width: 100%;
						<?php $total_border = intval( $border_size ) * 2; ?>
						<?php
						if ( 'yes' !== $settings->show_spacing ) {

							if ( isset( $settings->pricing_columns[ $i + 1 ] ) ) {

								if ( $i < count( $settings->pricing_columns ) && 'yes' === $settings->pricing_columns[ $i + 1 ]->set_featured ) {
									$total_border -= intval( $border_size );
									?>
									margin: auto;
									border-right: 0;
								<?php } else { ?>
									margin-left: 0;
									<?php
								}
							} else {
								?>
								margin-left: 0;
								<?php
							}
							if ( isset( $settings->pricing_columns[ $i - 1 ] ) ) {
								if ( $i > 0 && 'yes' === $settings->pricing_columns[ $i - 1 ]->set_featured ) {
									$total_border -= intval( $border_size );
									?>
									margin: auto;
									border-left: 0;
								<?php } else { ?>
									margin-left: -<?php echo esc_attr( $border_size ); ?>px;
									<?php
								}
							} else {
								?>
								margin-left: -<?php echo esc_attr( $border_size ); ?>px;
								<?php
							}
						} else {
							?>
							margin-left: -<?php echo esc_attr( $border_size ); ?>px;
												<?php } ?>
						width: calc( 100% + <?php echo esc_attr( $total_border ); ?>px );
					}
			<?php } ?>
			}
		<?php } ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-features li:nth-child(even) {
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->even_properties_bg ) ? 'background: ' . esc_attr( $settings->pricing_columns[ $i ]->even_properties_bg ) . ';' : ''; ?>
		}

		<?php
		if ( '' !== $settings->pricing_columns[ $i ]->features_color ) {
			?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-features li {
			color: <?php echo esc_attr( $settings->pricing_columns[ $i ]->features_color ); ?>;
		}
			<?php
		}
		?>

		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-title {
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->title_typography_color ) ? 'color: ' . esc_attr( $settings->pricing_columns[ $i ]->title_typography_color ) . ';' : ''; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-duration {
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->duration_typography_color ) ? 'color: ' . esc_attr( $settings->pricing_columns[ $i ]->duration_typography_color ) . ';' : ''; ?>
		}

		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-price {
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->price_typography_color ) ? 'color: ' . esc_attr( $settings->pricing_columns[ $i ]->price_typography_color ) . ';' : ''; ?>
		}

		<?php $highlight_color = ( '' !== $settings->pricing_columns[ $i ]->highlight_color ) ? $settings->pricing_columns[ $i ]->highlight_color : esc_attr( uabb_theme_base_color( $settings->column_background, true ) ); ?>

		/*Pricing Box Highlight*/
		<?php if ( 'price' === $settings->highlight ) : ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-price {
			background: <?php echo esc_attr( $highlight_color ); ?>;
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->price_typography_color ) ? 'color: ' . esc_attr( uabb_theme_text_color( $settings->pricing_columns[ $i ]->price_typography_color ) ) . ';' : ''; ?>
		}
		<?php elseif ( 'title' === $settings->highlight ) : ?>

		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-title {
			background: <?php echo esc_attr( $highlight_color ); ?>;
			<?php echo ( '' !== $settings->pricing_columns[ $i ]->title_typography_color ) ? 'color: ' . esc_attr( uabb_theme_text_color( $settings->pricing_columns[ $i ]->title_typography_color ) ) . ';' : ''; ?>
		}
		<?php endif; ?>

		/*Fix when price is NOT highlighted*/
		<?php if ( 'title' === $settings->highlight || 'none' === $settings->highlight ) : ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-price {
			margin-bottom: 0;
			padding-bottom: 0;
		}
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-features {
			margin-top: 10px;
		}

		<?php endif; ?>

		/*Fix when NOTHING is highlighted*/
		<?php if ( 'none' === $settings->highlight ) : ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-title {
			padding-bottom: 0;
		}
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-<?php echo esc_attr( $i ) + 1; ?> .uabb-pricing-table-price,
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column-0 .uabb-pricing-table-price {
			padding: 25px 0 1px;
		}

		<?php endif; ?>

	<?php
	if ( 'yes' === $settings->pricing_columns[ $i ]->show_button ) {
		$btn_id = $id . ' .uabb-pricing-table-outter-' . ( $i + 1 );

		if ( ! $version_bb_check ) {
			$font_size = ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit ) ) ? $settings->pricing_columns[ $i ]->button_typography_font_size_unit : $settings->pricing_columns[ $i ]->button_typography_font_size;

			$line_height = ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit ) ) ? $settings->pricing_columns[ $i ]->button_typography_line_height_unit : $settings->pricing_columns[ $i ]->button_typography_line_height;

			$button = array(
				'icon'                                     => $settings->pricing_columns[ $i ]->btn_icon,
				'icon_position'                            => $settings->pricing_columns[ $i ]->btn_icon_position,
				'style'                                    => $settings->pricing_columns[ $i ]->btn_style,
				'border_size'                              => $settings->pricing_columns[ $i ]->btn_border_size,
				'transparent_button_options'               => $settings->pricing_columns[ $i ]->btn_transparent_button_options,
				'threed_button_options'                    => $settings->pricing_columns[ $i ]->btn_threed_button_options,
				'flat_button_options'                      => $settings->pricing_columns[ $i ]->btn_flat_button_options,
				'bg_color'                                 => $settings->pricing_columns[ $i ]->btn_bg_color,
				'bg_hover_color'                           => $settings->pricing_columns[ $i ]->btn_bg_hover_color,
				'bg_color_opc'                             => $settings->pricing_columns[ $i ]->btn_bg_color_opc,
				'bg_hover_color_opc'                       => $settings->pricing_columns[ $i ]->btn_bg_hover_color_opc,
				'text_color'                               => $settings->pricing_columns[ $i ]->btn_text_color,
				'text_hover_color'                         => $settings->pricing_columns[ $i ]->btn_text_hover_color,
				'hover_attribute'                          => $settings->pricing_columns[ $i ]->hover_attribute,
				'width'                                    => $settings->pricing_columns[ $i ]->btn_width,
				'custom_width'                             => $settings->pricing_columns[ $i ]->btn_custom_width,
				'custom_height'                            => $settings->pricing_columns[ $i ]->btn_custom_height,
				'padding_top_bottom'                       => $settings->pricing_columns[ $i ]->btn_padding_top_bottom,
				'padding_left_right'                       => $settings->pricing_columns[ $i ]->btn_padding_left_right,
				'border_radius'                            => $settings->pricing_columns[ $i ]->btn_border_radius,
				'align'                                    => '',
				'mob_align'                                => '',
				'font_family'                              => $settings->pricing_columns[ $i ]->button_typography_font_family,
				'font_size'                                => ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size ) ) ? $settings->pricing_columns[ $i ]->button_typography_font_size : '',
				'line_height'                              => ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height ) ) ? $settings->pricing_columns[ $i ]->button_typography_line_height : '',
				'font_size_unit'                           => $settings->pricing_columns[ $i ]->button_typography_font_size_unit,
				'line_height_unit'                         => $settings->pricing_columns[ $i ]->button_typography_line_height_unit,
				'font_size_unit_medium'                    => $settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium,
				'line_height_unit_medium'                  => $settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium,
				'font_size_unit_responsive'                => $settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive,
				'line_height_unit_responsive'              => $settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive,
				'transform'                                => $settings->pricing_columns[ $i ]->button_transform,
				'letter_spacing'                           => $settings->pricing_columns[ $i ]->button_letter_spacing,
				'button_padding_dimension_top'             => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right_responsive : '',
				'button_border_style'                      => ( isset( $settings->pricing_columns[ $i ]->button_border_style ) ) ? $settings->pricing_columns[ $i ]->button_border_style : '',
				'button_border_width'                      => ( isset( $settings->pricing_columns[ $i ]->button_border_width ) ) ? $settings->pricing_columns[ $i ]->button_border_width : '',
				'button_border_radius'                     => ( isset( $settings->pricing_columns[ $i ]->button_border_radius ) ) ? $settings->pricing_columns[ $i ]->button_border_radius : '',
				'button_border_color'                      => ( isset( $settings->pricing_columns[ $i ]->button_border_color ) ) ? $settings->pricing_columns[ $i ]->button_border_color : '',
				'border_hover_color'                       => ( isset( $settings->pricing_columns[ $i ]->border_hover_color ) ) ? $settings->pricing_columns[ $i ]->border_hover_color : '',
			);
		} else {
			$button = array(
				'icon'                                     => $settings->pricing_columns[ $i ]->btn_icon,
				'icon_position'                            => $settings->pricing_columns[ $i ]->btn_icon_position,
				'style'                                    => $settings->pricing_columns[ $i ]->btn_style,
				'border_size'                              => $settings->pricing_columns[ $i ]->btn_border_size,
				'transparent_button_options'               => $settings->pricing_columns[ $i ]->btn_transparent_button_options,
				'threed_button_options'                    => $settings->pricing_columns[ $i ]->btn_threed_button_options,
				'flat_button_options'                      => $settings->pricing_columns[ $i ]->btn_flat_button_options,
				'bg_color'                                 => $settings->pricing_columns[ $i ]->btn_bg_color,
				'bg_hover_color'                           => $settings->pricing_columns[ $i ]->btn_bg_hover_color,
				'bg_color_opc'                             => $settings->pricing_columns[ $i ]->btn_bg_color_opc,
				'bg_hover_color_opc'                       => $settings->pricing_columns[ $i ]->btn_bg_hover_color_opc,
				'text_color'                               => $settings->pricing_columns[ $i ]->btn_text_color,
				'text_hover_color'                         => $settings->pricing_columns[ $i ]->btn_text_hover_color,
				'hover_attribute'                          => $settings->pricing_columns[ $i ]->hover_attribute,
				'width'                                    => $settings->pricing_columns[ $i ]->btn_width,
				'custom_width'                             => $settings->pricing_columns[ $i ]->btn_custom_width,
				'custom_height'                            => $settings->pricing_columns[ $i ]->btn_custom_height,
				'padding_top_bottom'                       => $settings->pricing_columns[ $i ]->btn_padding_top_bottom,
				'padding_left_right'                       => $settings->pricing_columns[ $i ]->btn_padding_left_right,
				'border_radius'                            => $settings->pricing_columns[ $i ]->btn_border_radius,
				'align'                                    => '',
				'mob_align'                                => '',
				'font_size'                                => ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size ) ) ? $settings->pricing_columns[ $i ]->button_typography_font_size : '',
				'line_height'                              => ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height ) ) ? $settings->pricing_columns[ $i ]->button_typography_line_height : '',
				'button_typo'                              => ( isset( $settings->pricing_columns[ $i ]->button_typo ) ) ? $settings->pricing_columns[ $i ]->button_typo : '',

				'button_typo_medium'                       => ( isset( $settings->pricing_columns[ $i ]->button_typo_medium ) ) ? $settings->pricing_columns[ $i ]->button_typo_medium : '',

				'button_typo_responsive'                   => ( isset( $settings->pricing_columns[ $i ]->button_typo_responsive ) ) ? $settings->pricing_columns[ $i ]->button_typo_responsive : '',
				'button_padding_dimension_top'             => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right_medium ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_top_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_left_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $settings->pricing_columns[ $i ]->button_padding_dimension_right_responsive ) ) ? $settings->pricing_columns[ $i ]->button_padding_dimension_right_responsive : '',
				'button_border'                            => ( isset( $settings->pricing_columns[ $i ]->button_border ) ) ? $settings->pricing_columns[ $i ]->button_border : '',
				'border_hover_color'                       => ( isset( $settings->pricing_columns[ $i ]->border_hover_color ) ) ? $settings->pricing_columns[ $i ]->border_hover_color : '',
			);
		}
		FLBuilder::render_module_css( 'uabb-button', $btn_id, $button );
	}
	?>

	<?php
endfor;

if ( $is_featured_set ) {
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
	padding-top: 40px;
}
	<?php
}
?>

/* Pricing Box Typography {Desktop} */

<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-title {

	<?php
	if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit ) && '' !== $settings->title_typography_font_size_unit ) {
		?>
	font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit ); ?>px;
	<?php } elseif ( isset( $settings->title_typography_font_size_unit ) && '' === $settings->title_typography_font_size_unit && isset( $settings->title_typography_font_size['desktop'] ) && '' !== $settings->title_typography_font_size['desktop'] ) { ?>
	font-size: <?php echo esc_attr( $settings->title_typography_font_size['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->title_typography_font_size['desktop'] ) && '' === $settings->title_typography_font_size['desktop'] && isset( $settings->title_typography_line_height['desktop'] ) && '' !== $settings->title_typography_line_height['desktop'] && '' === $settings->title_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->title_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit ) && '' !== $settings->title_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit ); ?>em;
	<?php } elseif ( isset( $settings->title_typography_line_height_unit ) && '' === $settings->title_typography_line_height_unit && isset( $settings->title_typography_line_height['desktop'] ) && '' !== $settings->title_typography_line_height['desktop'] ) { ?>
	line-height: <?php echo esc_attr( $settings->title_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'none' !== $settings->title_transform ) : ?>
	text-transform: <?php echo esc_attr( $settings->title_transform ); ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->title_letter_spacing ) : ?>
	letter-spacing: <?php echo esc_attr( $settings->title_letter_spacing ); ?>px;
	<?php endif; ?>

	<?php echo ( 'Default' !== $settings->title_typography_font_family['family'] ) ? 'font-family: ' . esc_attr( $settings->title_typography_font_family['family'] ) . ';' : ''; ?>
	<?php echo ( 'default' !== $settings->title_typography_font_family['weight'] ) ? 'font-weight: ' . esc_attr( $settings->title_typography_font_family['weight'] ) . ';' : ''; ?>
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-pricing-table-title",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-price {

	<?php
	if ( 'yes' === $converted || isset( $settings->price_typography_font_size_unit ) && '' !== $settings->price_typography_font_size_unit ) {
		?>
	font-size: <?php echo esc_attr( $settings->price_typography_font_size_unit ); ?>px;
	<?php } elseif ( isset( $settings->price_typography_font_size_unit ) && '' === $settings->price_typography_font_size_unit && isset( $settings->price_typography_font_size['desktop'] ) && '' !== $settings->price_typography_font_size['desktop'] ) { ?>
	font-size: <?php echo esc_attr( $settings->price_typography_font_size['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->price_typography_font_size['desktop'] ) && '' === $settings->price_typography_font_size['desktop'] && isset( $settings->price_typography_line_height['desktop'] ) && '' !== $settings->price_typography_line_height['desktop'] && '' === $settings->price_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->price_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->price_typography_line_height_unit ) && '' !== $settings->price_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->price_typography_line_height_unit ); ?>em;
	<?php } elseif ( isset( $settings->price_typography_line_height_unit ) && '' === $settings->price_typography_line_height_unit && isset( $settings->price_typography_line_height['desktop'] ) && '' !== $settings->price_typography_line_height['desktop'] ) { ?>
	line-height: <?php echo esc_attr( $settings->price_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->price_typography_line_height_unit ) && '' !== $settings->price_typography_line_height_unit ) : ?>
	line-height: <?php echo esc_attr( $settings->price_typography_line_height_unit ); ?>em;
	<?php endif; ?>

	<?php if ( '' !== $settings->price_typography_letter_spacing ) { ?>
	letter-spacing: <?php echo esc_attr( $settings->price_typography_letter_spacing ); ?>px;
	<?php } ?>

	<?php echo ( 'Default' !== $settings->price_typography_font_family['family'] ) ? 'font-family: ' . esc_attr( $settings->price_typography_font_family['family'] ) . ';' : ''; ?>
	<?php echo ( 'default' !== $settings->price_typography_font_family['weight'] ) ? 'font-weight: ' . esc_attr( $settings->price_typography_font_family['weight'] ) . ';' : ''; ?>
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'price_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-pricing-table-price",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-duration {

	<?php
	if ( 'yes' === $converted || isset( $settings->duration_typography_font_size_unit ) && '' !== $settings->duration_typography_font_size_unit ) {
		?>
	font-size: <?php echo esc_attr( $settings->duration_typography_font_size_unit ); ?>px;
	<?php } elseif ( isset( $settings->duration_typography_font_size_unit ) && '' === $settings->duration_typography_font_size_unit && isset( $settings->duration_typography_font_size['desktop'] ) && '' !== $settings->duration_typography_font_size['desktop'] ) { ?>
	font-size: <?php echo esc_attr( $settings->duration_typography_font_size['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->duration_typography_font_size['desktop'] ) && '' === $settings->duration_typography_font_size['desktop'] && isset( $settings->duration_typography_line_height['desktop'] ) && '' !== $settings->duration_typography_line_height['desktop'] && '' === $settings->duration_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->duration_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->duration_typography_line_height_unit ) && '' !== $settings->duration_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->duration_typography_line_height_unit ); ?>em;
	<?php } elseif ( isset( $settings->duration_typography_line_height_unit ) && '' === $settings->duration_typography_line_height_unit && isset( $settings->duration_typography_line_height['desktop'] ) && '' !== $settings->duration_typography_line_height['desktop'] ) { ?>
	line-height: <?php echo esc_attr( $settings->duration_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'none' !== $settings->duration_typography_transform ) : ?>
	text-transform: <?php echo esc_attr( $settings->duration_typography_transform ); ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->duration_typography_letter_spacing ) : ?>
	letter-spacing: <?php echo esc_attr( $settings->duration_typography_letter_spacing ); ?>px;
	<?php endif; ?>

	<?php echo ( 'Default' !== $settings->duration_typography_font_family['family'] ) ? 'font-family: ' . esc_attr( $settings->duration_typography_font_family['family'] ) . ';' : ''; ?>
	<?php echo ( 'default' !== $settings->duration_typography_font_family['weight'] ) ? 'font-weight: ' . esc_attr( $settings->duration_typography_font_family['weight'] ) . ';' : ''; ?>
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'duration_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-pricing-table-duration",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table li {

text-align: <?php echo esc_attr( $settings->features_align ); ?>;

	<?php
	if ( 'yes' === $converted || isset( $settings->feature_typography_font_size_unit ) && '' !== $settings->feature_typography_font_size_unit ) {
		?>
	font-size: <?php echo esc_attr( $settings->feature_typography_font_size_unit ); ?>px;
	<?php } elseif ( isset( $settings->feature_typography_font_size_unit ) && '' === $settings->feature_typography_font_size_unit && isset( $settings->feature_typography_font_size['desktop'] ) && '' !== $settings->feature_typography_font_size['desktop'] ) { ?>
	font-size: <?php echo esc_attr( $settings->feature_typography_font_size['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( isset( $settings->feature_typography_font_size['desktop'] ) && '' === $settings->feature_typography_font_size['desktop'] && isset( $settings->feature_typography_line_height['desktop'] ) && '' !== $settings->feature_typography_line_height['desktop'] && '' === $settings->feature_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->feature_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->feature_typography_line_height_unit ) && '' !== $settings->feature_typography_line_height_unit ) { ?>
	line-height: <?php echo esc_attr( $settings->feature_typography_line_height_unit ); ?>em;
	<?php } elseif ( isset( $settings->feature_typography_line_height_unit ) && '' === $settings->feature_typography_line_height_unit && isset( $settings->feature_typography_line_height['desktop'] ) && '' !== $settings->feature_typography_line_height['desktop'] ) { ?>
	line-height: <?php echo esc_attr( $settings->feature_typography_line_height['desktop'] ); ?>px;
	<?php } ?>

	<?php if ( 'none' !== $settings->feature_content_transform ) : ?>
	text-transform: <?php echo esc_attr( $settings->feature_content_transform ); ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->feature_content_letter_spacing ) : ?>
	letter-spacing: <?php echo esc_attr( $settings->feature_content_letter_spacing ); ?>px;
	<?php endif; ?>

	<?php echo ( 'Default' !== $settings->feature_typography_font_family['family'] ) ? 'font-family: ' . esc_attr( $settings->feature_typography_font_family['family'] ) . ';' : ''; ?>
	<?php echo ( 'default' !== $settings->feature_typography_font_family['weight'] ) ? 'font-weight: ' . esc_attr( $settings->feature_typography_font_family['weight'] ) . ';' : ''; ?>
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'feature_typo',
				'selector'     => ".fl-node-$id .uabb-pricing-table-features li",
			)
		);
	}
}
?>

<?php
if ( 'yes' === $settings->add_legend ) {
	?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column-0 .uabb-pricing-table-features li,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column .uabb-pricing-table-features .uabb-pricing-ledgend {
			<?php echo ( 'Default' !== $settings->legend_column->legend_font_family->family ) ? 'font-family: ' . esc_attr( $settings->legend_column->legend_font_family )->family . ';' : ''; ?>
			<?php echo ( 'default' !== $settings->legend_column->legend_font_family->weight ) ? 'font-weight: ' . esc_attr( $settings->legend_column->legend_font_family )->weight . ';' : ''; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->legend_column->legend_font_size_unit ) && '' !== $settings->legend_column->legend_font_size_unit ) {
				?>
				font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size_unit ); ?>px;
			<?php } elseif ( isset( $settings->legend_column->legend_font_size_unit ) && '' === $settings->legend_column->legend_font_size_unit && isset( $settings->legend_column->legend_font_size->desktop ) && '' !== $settings->legend_column->legend_font_size->desktop ) { ?>
				font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size->desktop ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->legend_column->legend_font_size->desktop ) && '' === $settings->legend_column->legend_font_size->desktop && isset( $settings->legend_column->legend_line_height->desktop ) && '' !== $settings->legend_column->legend_line_height->desktop && '' === $settings->legend_column->legend_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->desktop ); ?>px;
			<?php } ?>


			<?php if ( 'yes' === $converted || isset( $settings->legend_column->legend_line_height_unit ) && '' !== $settings->legend_column->legend_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height_unit ); ?>em;
			<?php } elseif ( isset( $settings->legend_column->legend_line_height_unit ) && '' === $settings->legend_column->legend_line_height_unit && isset( $settings->legend_column->legend_line_height->desktop ) && '' !== $settings->legend_column->legend_line_height->desktop ) { ?>
				line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->desktop ); ?>px;
			<?php } ?>

			<?php if ( 'none' !== $settings->legend_column->legend_transform ) : ?>
				text-transform: <?php echo esc_attr( $settings->legend_column->legend_transform ); ?>;
			<?php endif; ?>

			<?php if ( '' !== $settings->legend_column->legend_letter_spacing ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->legend_column->legend_letter_spacing ); ?>px;
			<?php endif; ?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings->legend_column,
					'setting_name' => 'legend_typo',
					'selector'     => ".fl-node-$id .uabb-pricing-table .uabb-pricing-table-column-0 .uabb-pricing-table-features li,.fl-node-$id .uabb-pricing-table .uabb-pricing-table-column .uabb-pricing-table-features .uabb-pricing-ledgend",
				)
			);
		}
	}
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column-0 .uabb-pricing-table-features li {
		text-align: <?php echo esc_attr( $settings->legend_column->legend_align ); ?>;
		<?php
		if ( isset( $settings->legend_column->legend_feature_color ) ) {
			if ( '' !== $settings->legend_column->legend_feature_color && '' === $settings->legend_column->legend_color ) {
				$settings->legend_column->legend_feature_color = UABB_Helper::uabb_colorpicker( $settings->legend_column, 'legend_feature_color' );
				$settings->legend_column->legend_color         = $settings->legend_column->legend_feature_color;
				echo 'color: ' . esc_attr( $settings->legend_column->legend_color ) . ';';

			} else {
				echo ( '' !== $settings->legend_column->legend_color ) ? 'color: ' . esc_attr( $settings->legend_column->legend_color ) . ';' : '';
			}
		} else {
			echo ( '' !== $settings->legend_column->legend_color ) ? 'color: ' . esc_attr( $settings->legend_column->legend_color ) . ';' : '';
		}
		?>
		<?php echo ( '' !== $settings->legend_column->legend_color ) ? 'color: ' . esc_attr( $settings->legend_column->legend_color ) . ';' : ''; ?>
	}
<?php } ?>

<?php
if ( 'yes' === $settings->responsive_size ) {
	$size = ( '' !== $settings->resp_size ) ? $settings->resp_size : '767';
	?>
@media all and ( max-width: <?php echo esc_attr( $size ); ?>px ) {
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table {
		flex-direction: column;
		border: none;
		margin: 0;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-featured-pricing-box {
		position: static;
		padding: 10px 10px;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-element-box {
		width: 100%;
		float: none;
		margin: 0 0 1.5em 0;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-legend-box {
		display: none;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-features .uabb-pricing-ledgend {
		display: block;
		font-weight: bold;
	}

	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-col-<?php echo esc_attr( $columns ); ?> {
		padding: 0;
	}
}
	<?php
}

if ( $global_settings->responsive_enabled ) { // Responsive Typography.
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
	<?php if ( ! $version_bb_check ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-title {

			<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_medium ) && '' !== $settings->title_typography_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->title_typography_font_size_unit_medium ) && '' === $settings->title_typography_font_size_unit_medium && isset( $settings->title_typography_font_size['medium'] ) && '' !== $settings->title_typography_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->title_typography_font_size['medium'] ) && '' === $settings->title_typography_font_size['medium'] && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] && '' === $settings->title_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_medium ) && '' !== $settings->title_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->title_typography_line_height_unit_medium ) && '' === $settings->title_typography_line_height_unit_medium && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-price {

			<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_medium ) && '' !== $settings->title_typography_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->title_typography_font_size_unit_medium ) && '' === $settings->title_typography_font_size_unit_medium && isset( $settings->title_typography_font_size['medium'] ) && '' !== $settings->title_typography_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->price_typography_font_size['medium'] ) && '' === $settings->price_typography_font_size['medium'] && isset( $settings->price_typography_line_height['medium'] ) && '' !== $settings->price_typography_line_height['medium'] && '' === $settings->price_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height['medium'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->price_typography_line_height_unit_medium ) && '' !== $settings->price_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->price_typography_line_height_unit_medium ) && '' === $settings->price_typography_line_height_unit_medium && isset( $settings->price_typography_line_height['medium'] ) && '' !== $settings->price_typography_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-duration {

			<?php if ( 'yes' === $converted || isset( $settings->duration_typography_font_size_unit_medium ) && '' !== $settings->duration_typography_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->duration_typography_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->duration_typography_font_size_unit_medium ) && '' === $settings->duration_typography_font_size_unit_medium && isset( $settings->duration_typography_font_size['medium'] ) && '' !== $settings->duration_typography_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->duration_typography_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->duration_typography_font_size['medium'] ) && '' === $settings->duration_typography_font_size['medium'] && isset( $settings->duration_typography_line_height['medium'] ) && '' !== $settings->duration_typography_line_height['medium'] && '' === $settings->duration_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height['medium'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->duration_typography_line_height_unit_medium ) && '' !== $settings->duration_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->duration_typography_line_height_unit_medium ) && '' === $settings->duration_typography_line_height_unit_medium && isset( $settings->duration_typography_line_height['medium'] ) && '' !== $settings->duration_typography_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table li {

			<?php if ( 'yes' === $converted || isset( $settings->feature_typography_font_size_unit_medium ) && '' !== $settings->feature_typography_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->feature_typography_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->feature_typography_font_size_unit_medium ) && '' === $settings->feature_typography_font_size_unit_medium && isset( $settings->feature_typography_font_size['medium'] ) && '' !== $settings->feature_typography_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->feature_typography_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->feature_typography_font_size['medium'] ) && '' === $settings->feature_typography_font_size['medium'] && isset( $settings->feature_typography_line_height['medium'] ) && '' !== $settings->feature_typography_line_height['medium'] && '' === $settings->feature_typography_line_height_unit_medium ) : ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height['medium'] ); ?>px;
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->feature_typography_line_height_unit_medium ) && '' !== $settings->feature_typography_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->feature_typography_line_height_unit_medium ) && '' === $settings->feature_typography_line_height_unit_medium && isset( $settings->feature_typography_line_height['medium'] ) && '' !== $settings->feature_typography_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

		<?php
		if ( 'yes' === $settings->add_legend ) {
			if ( ! $version_bb_check ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column-0 .uabb-pricing-table-features li,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column .uabb-pricing-table-features .uabb-pricing-ledgend {

					<?php if ( 'yes' === $converted || isset( $settings->legend_column->legend_font_size_unit_medium ) && '' !== $settings->legend_column->legend_font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->legend_column->legend_font_size_unit_medium ) && '' === $settings->legend_column->legend_font_size_unit_medium && isset( $settings->legend_column->legend_font_size->medium ) && '' !== $settings->legend_column->legend_font_size->medium ) { ?>
						font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size->medium ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->legend_column->legend_font_size->medium ) && '' === $settings->legend_column->legend_font_size->medium && isset( $settings->legend_column->legend_line_height->medium ) && '' !== $settings->legend_column->legend_line_height->medium && '' === $settings->legend_column->legend_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->medium ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->legend_column->legend_line_height_unit_medium ) && '' !== $settings->legend_column->legend_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height_unit_medium ); ?>em;
					<?php } elseif ( isset( $settings->legend_column->legend_line_height_unit_medium ) && '' === $settings->legend_column->legend_line_height_unit_medium && isset( $settings->legend_column->legend_line_height->medium ) && '' !== $settings->legend_column->legend_line_height->medium ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->medium ); ?>px;
					<?php } ?>
				}
				<?php
			}
		}
		?>
	}

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {

	<?php if ( ! $version_bb_check ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-title {

			<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_responsive ) && '' !== $settings->title_typography_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->title_typography_font_size_unit_responsive ) && '' === $settings->title_typography_font_size_unit_responsive && isset( $settings->title_typography_font_size['small'] ) && '' !== $settings->title_typography_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->title_typography_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->title_typography_font_size['small'] ) && '' === $settings->title_typography_font_size['small'] && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] && '' === $settings->title_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_responsive ) && '' !== $settings->title_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->title_typography_line_height_unit_responsive ) && '' === $settings->title_typography_line_height_unit_responsive && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-column .uabb-pricing-table-price {

			<?php if ( 'yes' === $converted || isset( $settings->price_typography_font_size_unit_responsive ) && '' !== $settings->price_typography_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->price_typography_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->price_typography_font_size_unit_responsive ) && '' === $settings->price_typography_font_size_unit_responsive && isset( $settings->price_typography_font_size['small'] ) && '' !== $settings->price_typography_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->price_typography_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->price_typography_font_size['small'] ) && '' === $settings->price_typography_font_size['small'] && isset( $settings->price_typography_line_height['small'] ) && '' !== $settings->price_typography_line_height['small'] && '' === $settings->price_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height['small'] ); ?>px;
			<?php } ?>


			<?php if ( 'yes' === $converted || isset( $settings->price_typography_line_height_unit_responsive ) && '' !== $settings->price_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->price_typography_line_height_unit_responsive ) && '' === $settings->price_typography_line_height_unit_responsive && isset( $settings->price_typography_line_height['small'] ) && '' !== $settings->price_typography_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->price_typography_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-duration {

			<?php if ( 'yes' === $converted || isset( $settings->duration_typography_font_size_unit_responsive ) && '' !== $settings->duration_typography_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->duration_typography_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->duration_typography_font_size_unit_responsive ) && '' === $settings->duration_typography_font_size_unit_responsive && isset( $settings->duration_typography_font_size['small'] ) && '' !== $settings->duration_typography_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->duration_typography_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->duration_typography_font_size['small'] ) && '' === $settings->duration_typography_font_size['small'] && isset( $settings->duration_typography_line_height['small'] ) && '' !== $settings->duration_typography_line_height['small'] && '' === $settings->duration_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->duration_typography_line_height_unit_responsive ) && '' !== $settings->duration_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->duration_typography_line_height_unit_responsive ) && '' === $settings->duration_typography_line_height_unit_responsive && isset( $settings->duration_typography_line_height['small'] ) && '' !== $settings->duration_typography_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->duration_typography_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table li {

			<?php if ( 'yes' === $converted || isset( $settings->feature_typography_font_size_unit_responsive ) && '' !== $settings->feature_typography_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->feature_typography_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->feature_typography_font_size_unit_responsive ) && '' === $settings->feature_typography_font_size_unit_responsive && isset( $settings->feature_typography_font_size['small'] ) && '' !== $settings->feature_typography_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->feature_typography_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->feature_typography_font_size['small'] ) && '' === $settings->feature_typography_font_size['small'] && isset( $settings->feature_typography_line_height['small'] ) && '' !== $settings->feature_typography_line_height['small'] && '' === $settings->feature_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->feature_typography_line_height_unit_responsive ) && '' !== $settings->feature_typography_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->feature_typography_line_height_unit_responsive ) && '' === $settings->feature_typography_line_height_unit_responsive && isset( $settings->feature_typography_line_height['small'] ) && '' !== $settings->feature_typography_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->feature_typography_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

		<?php if ( 'yes' === $settings->add_legend ) : ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column-0 .uabb-pricing-table-features li,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table .uabb-pricing-table-column .uabb-pricing-table-features .uabb-pricing-ledgend {

					<?php if ( 'yes' === $converted || isset( $settings->legend_column->legend_font_size_unit_responsive ) && '' !== $settings->legend_column->legend_font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size_unit_responsive ); ?>px;
					<?php } elseif ( isset( $settings->legend_column->legend_font_size_unit_responsive ) && '' === $settings->legend_column->legend_font_size_unit_responsive && isset( $settings->legend_column->legend_font_size->small ) && '' !== $settings->legend_column->legend_font_size->small ) { ?>
						font-size: <?php echo esc_attr( $settings->legend_column->legend_font_size->small ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->legend_column->legend_font_size->small ) && '' === $settings->legend_column->legend_font_size->small && isset( $settings->legend_column->legend_line_height->small ) && '' !== $settings->legend_column->legend_line_height->small && '' === $settings->legend_column->legend_line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->small ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->legend_column->legend_line_height_unit_responsive ) && '' !== $settings->legend_column->legend_line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->legend_column->legend_line_height_unit_responsive ) && '' === $settings->legend_column->legend_line_height_unit_responsive && isset( $settings->legend_column->legend_line_height->small ) && '' !== $settings->legend_column->legend_line_height->small ) { ?>
						line-height: <?php echo esc_attr( $settings->legend_column->legend_line_height->small ); ?>px;
					<?php } ?>
				}
				<?php } ?>
		<?php endif; ?>
	}
<?php } ?>

/* Ribbon CSS Starts here */

<?php
// Loop through and style each pricing box.
$count = count( $settings->pricing_columns );
for ( $i = 0; $i < $count; $i++ ) {

	if ( ! is_object( $settings->pricing_columns[ $i ] ) ) {
		continue;
	}

	if ( isset( $settings->pricing_columns[ $i ]->ribbon_style ) && 'none' !== $settings->pricing_columns[ $i ]->ribbon_style ) {
		if ( 'corner' === $settings->pricing_columns[ $i ]->ribbon_style ) {
			if ( isset( $settings->pricing_columns[ $i ]->ribbon_distance ) && '' !== $settings->pricing_columns[ $i ]->ribbon_distance ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-ribbon-corner .uabb-price-box-ribbon-content {
					margin-top: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_distance ); ?>px;
					transform: translateY(-50%) translateX(-50%) translateX(<?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_distance ); ?>) rotate(-45deg);
				}
				<?php
			}
		}
		if ( 'circular' === $settings->pricing_columns[ $i ]->ribbon_style ) {
			if ( isset( $settings->pricing_columns[ $i ]->ribbon_size ) && '' !== $settings->pricing_columns[ $i ]->ribbon_size ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-ribbon-circular .uabb-price-box-ribbon-content {
					min-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_size ); ?>em;
					min-width: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_size ); ?>em;
					line-height: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_size ); ?>em;
					z-index: 1;
				}
				<?php
			}
		}
		if ( 'flag' === $settings->pricing_columns[ $i ]->ribbon_style ) {
			if ( isset( $settings->pricing_columns[ $i ]->ribbon_top_distance ) && '' !== $settings->pricing_columns[ $i ]->ribbon_top_distance ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-ribbon-flag .uabb-price-box-ribbon-content {
					top: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_top_distance ); ?>%;
				}
				<?php
			}
			if ( class_exists( 'FLBuilderCSS' ) ) {
				FLBuilderCSS::dimension_field_rule(
					array(
						'settings'     => $settings->pricing_columns[ $i ],
						'setting_name' => 'ribbon_padding',
						'selector'     => ".fl-node-$id .uabb-pricing-table-outter-" . ( $i + 1 ) . ' .uabb-ribbon-flag .uabb-price-box-ribbon-content',
						'unit'         => 'px',
						'props'        => array(
							'padding-top'    => 'ribbon_padding_top',
							'padding-right'  => 'ribbon_padding_right',
							'padding-bottom' => 'ribbon_padding_bottom',
							'padding-left'   => 'ribbon_padding_left',
						),
					)
				);
			}
		}

		$settings->pricing_columns[ $i ]->ribbon_bg_color     = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'ribbon_bg_color', true );
		$settings->pricing_columns[ $i ]->ribbon_text_color   = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'ribbon_text_color', true );
		$settings->pricing_columns[ $i ]->ribbon_shadow_color = UABB_Helper::uabb_colorpicker( $settings->pricing_columns[ $i ], 'ribbon_shadow_color', true );

		if ( ! empty( $settings->pricing_columns[ $i ]->ribbon_bg_color ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-box-ribbon-content {
				background-color: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_bg_color ); ?>;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-ribbon-flag .uabb-price-box-ribbon-content:before {
				border-left: 8px solid <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_bg_color ); ?>;
			}
			<?php
		}

		if ( ! empty( $settings->pricing_columns[ $i ]->ribbon_text_color ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-box-ribbon-content {
				color: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_text_color ); ?>;
			}
			<?php
		}

		if ( 'yes' === $settings->pricing_columns[ $i ]->ribbon_box_shadow ) {
			?>

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pricing-table-outter-<?php echo esc_attr( $i ) + 1; ?> .uabb-price-box-ribbon-content {
				-webkit-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color ); ?>;
				-moz-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color ); ?>;
				-o-box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color ); ?>;
				box-shadow: <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->pricing_columns[ $i ]->ribbon_shadow_color ); ?>;
			}

		<?php }

		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings->pricing_columns[ $i ],
					'setting_name' => 'ribbon_typo',
					'selector'     => ".fl-node-$id .uabb-pricing-table-outter-" . ( $i + 1 ) . ' .uabb-price-box-ribbon-content',
				)
			);
		}
	}
}
?>
