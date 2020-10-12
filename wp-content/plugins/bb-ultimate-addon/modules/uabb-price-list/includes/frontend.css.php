<?php
/**
 *  UABB Price List Module file
 *
 *  @package UABB Price List Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;

$settings->list_item_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'list_item_background_color' );
$settings->list_item_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'list_item_background_hover_color' );
$settings->heading_color                    = UABB_Helper::uabb_colorpicker( $settings, 'heading_color' );
$settings->heading_hover_color              = UABB_Helper::uabb_colorpicker( $settings, 'heading_hover_color' );
$settings->description_color                = UABB_Helper::uabb_colorpicker( $settings, 'description_color' );
$settings->description_hover_color          = UABB_Helper::uabb_colorpicker( $settings, 'description_hover_color' );
$settings->price_color                      = UABB_Helper::uabb_colorpicker( $settings, 'price_color' );
$settings->price_hover_color                = UABB_Helper::uabb_colorpicker( $settings, 'price_hover_color' );
$settings->price_list_connector_color       = UABB_Helper::uabb_colorpicker( $settings, 'price_list_connector_color' );
$settings->price_list_border_hover_color    = UABB_Helper::uabb_colorpicker( $settings, 'price_list_border_hover_color' );
$settings->price_list_connector_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'price_list_connector_hover_color' );


if ( ! $version_bb_check ) {
	$settings->price_list_border_color = UABB_Helper::uabb_colorpicker( $settings, 'price_list_border_color' );
}
if ( 'left' === $settings->image_position || 'right' === $settings->image_position ) { ?> 
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
		<?php
		if ( 'top' === $settings->vertical_alignment ) {
			echo 'align-items:flex-start;';
		}
		if ( 'bottom' === $settings->vertical_alignment ) {
			echo 'align-items:flex-end;';
		}
		if ( 'center' === $settings->vertical_alignment ) {
			echo ( '' !== $settings->vertical_alignment ) ? 'align-items:' . esc_attr( $settings->vertical_alignment ) . ';' : '';
		}
		?>
	}
	<?php
}
if ( 'right' === $settings->price_position ) {

	if ( 'left' === $settings->image_position || 'right' === $settings->image_position ) {
		?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item .uabb-price-list-separator {
		<?php
		if ( isset( $settings->price_list_connector_style ) ) {
			echo ( '' !== $settings->price_list_connector_style ) ? 'border-bottom-style:' . esc_attr( $settings->price_list_connector_style ) . ';' : '';
		}
		if ( isset( $settings->price_list_connector_width ) ) {
			echo ( '' !== $settings->price_list_connector_width ) ? 'border-bottom-width:' . esc_attr( $settings->price_list_connector_width ) . 'px;' : '';
		}
		if ( isset( $settings->price_list_connector_color ) ) {
			echo ( '' !== $settings->price_list_connector_color ) ? 'border-bottom-color:' . esc_attr( $settings->price_list_connector_color ) . ';' : '';
		}
		?>
		}
		<?php
	}
}
if ( isset( $settings->space_between_list_items ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:not(:last-child) {
		<?php
			echo( '' !== $settings->space_between_list_items ) ? 'margin-bottom:' . esc_attr( $settings->space_between_list_items ) . 'px;' : '';
		?>
	}
	<?php
}
if ( isset( $settings->price_list_connector_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover .uabb-price-list-separator {
		<?php
			echo( '' !== $settings->price_list_connector_hover_color ) ? 'border-bottom-color:' . esc_attr( $settings->price_list_connector_hover_color ) . ';' : '';
		?>
	}
	<?php
}
if ( 'yes' === $settings->pricelist_min_height ) {
	if ( isset( $settings->pricelist_height ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
			min-height: <?php echo esc_attr( $settings->pricelist_height ); ?>px;
		}
		<?php
	}
}
if ( isset( $settings->space_between_img_content ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-left .uabb-price-list-image {
		<?php
			echo( '' !== $settings->space_between_img_content ) ? 'margin-right:' . esc_attr( $settings->space_between_img_content ) . 'px;' : '';
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-right .uabb-price-list-image {
		<?php
			echo( '' !== $settings->space_between_img_content ) ? 'margin-left:' . esc_attr( $settings->space_between_img_content ) . 'px;' : '';
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-top .uabb-price-list-image {
		<?php
			echo( '' !== $settings->space_between_img_content ) ? 'margin-bottom:' . esc_attr( $settings->space_between_img_content ) . 'px;' : '';
		?>
	}
	<?php
}
if ( isset( $settings->list_item_background_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
		<?php
			echo( '' !== $settings->list_item_background_color ) ? 'background-color:' . esc_attr( $settings->list_item_background_color ) . ';' : '';
		?>
		<?php
		if ( isset( $settings->list_item_padding_dimension_top ) ) {
			echo( '' !== $settings->list_item_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->list_item_padding_dimension_top ) . 'px;' : '';
		}
		if ( isset( $settings->list_item_padding_dimension_left ) ) {
			echo( '' !== $settings->list_item_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->list_item_padding_dimension_left ) . 'px;' : '';
		}
		if ( isset( $settings->list_item_padding_dimension_right ) ) {
			echo( '' !== $settings->list_item_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->list_item_padding_dimension_right ) . 'px;' : '';
		}
		if ( isset( $settings->list_item_padding_dimension_bottom ) ) {
			echo( '' !== $settings->list_item_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->list_item_padding_dimension_bottom ) . 'px;' : '';
		}
		?>
	}
	<?php
}
if ( isset( $settings->list_item_background_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover {
		<?php
			echo( '' !== $settings->list_item_background_hover_color ) ? 'background-color:' . esc_attr( $settings->list_item_background_hover_color ) . ';' : '';
		?>
	}
	<?php
}

if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
		<?php
		if ( isset( $settings->price_list_border_type ) ) {
			echo ( '' !== $settings->price_list_border_type ) ? 'border-style:' . esc_attr( $settings->price_list_border_type ) . ';' : '';
		}
		if ( isset( $settings->price_list_border_width ) ) {
			echo( '' !== $settings->price_list_border_width ) ? 'border-width:' . esc_attr( $settings->price_list_border_width ) . 'px;' : '';
		}
		if ( isset( $settings->price_list_border_color ) ) {
			echo( '' !== $settings->price_list_border_color ) ? 'border-color:' . esc_attr( $settings->price_list_border_color ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'price_border',
			'selector'     => ".fl-node-$id .uabb-price-list-item",
		)
	);
}
if ( isset( $settings->price_list_border_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover {
		<?php
			echo( '' !== $settings->price_list_border_hover_color ) ? 'border-color:' . esc_attr( $settings->price_list_border_hover_color ) . ';' : '';
		?>
	}
	<?php
}

if ( isset( $settings->image_gloabl_size ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-image {
		<?php
			echo( '' !== $settings->image_gloabl_size ) ? 'width:' . esc_attr( $settings->image_gloabl_size ) . 'px;' : '';
			echo( '' !== $settings->image_gloabl_size ) ? 'min-width:' . esc_attr( $settings->image_gloabl_size ) . 'px;' : '';
		?>
	}
	<?php
}

if ( isset( $settings->image_border_radius ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-image img {
		<?php
			echo( '' !== $settings->image_border_radius ) ? 'border-radius:' . esc_attr( $settings->image_border_radius ) . 'px;' : '';
		?>
	}
	<?php
}

if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
		<?php if ( 'default' !== $settings->heading_font_family['family'] && 'default' !== $settings->heading_font_family['weight'] ) : ?>
					<?php FLBuilderFonts::font_css( $settings->heading_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->heading_font_size_unit ) ) {
			echo( '' !== $settings->heading_font_size_unit ) ? 'font-size:' . esc_attr( $settings->heading_font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->heading_line_height_unit ) ) {
			echo( '' !== $settings->heading_line_height_unit ) ? 'line-height:' . esc_attr( $settings->heading_line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->heading_transform ) ) {
			echo( '' !== $settings->heading_transform ) ? 'text-transform:' . esc_attr( $settings->heading_transform ) . ';' : '';
		}
		if ( isset( $settings->heading_letter_spacing ) ) {
			echo( '' !== $settings->heading_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->heading_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'heading_font_typo',
				'selector'     => ".fl-node-$id .uabb-price-list-title",
			)
		);
	}
}
if ( isset( $settings->heading_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
		<?php
			echo( '' !== $settings->heading_color ) ? 'color:' . esc_attr( $settings->heading_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->heading_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover .uabb-price-list-title {
		<?php
			echo( '' !== $settings->heading_hover_color ) ? 'color:' . esc_attr( $settings->heading_hover_color ) . ';' : '';
		?>
	}
	<?php
}
?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item .uabb-price-list-title {
		<?php
		if ( isset( $settings->heading_margin_top ) ) {
			echo( '' !== $settings->heading_margin_top ) ? 'margin-top:' . esc_attr( $settings->heading_margin_top ) . 'px;' : '';
		}
		if ( isset( $settings->heading_margin_bottom ) ) {
			echo( '' !== $settings->heading_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->heading_margin_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->heading_margin_left ) ) {
			echo( '' !== $settings->heading_margin_left ) ? 'margin-left:' . esc_attr( $settings->heading_margin_left ) . 'px;' : '';
		}
		if ( isset( $settings->heading_margin_right ) ) {
			echo( '' !== $settings->heading_margin_right ) ? 'margin-right:' . esc_attr( $settings->heading_margin_right ) . 'px;' : '';
		}
		?>
	}
<?php
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
		<?php if ( 'default' !== $settings->description_font_family['family'] && 'default' !== $settings->description_font_family['weight'] ) : ?>
					<?php FLBuilderFonts::font_css( $settings->description_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->description_font_size_unit ) ) {
			echo( '' !== $settings->description_font_size_unit ) ? 'font-size:' . esc_attr( $settings->description_font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->description_line_height_unit ) ) {
			echo( '' !== $settings->description_line_height_unit ) ? 'line-height:' . esc_attr( $settings->description_line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->description_transform ) ) {
			echo( '' !== $settings->description_transform ) ? 'text-transform:' . esc_attr( $settings->description_transform ) . '' : '';
		}
		if ( isset( $settings->description_letter_spacing ) ) {
			echo( '' !== $settings->description_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->description_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'description_font_typo',
				'selector'     => ".fl-node-$id .uabb-price-list-description",
			)
		);
	}
}
if ( isset( $settings->description_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
		<?php
			echo( '' !== $settings->description_color ) ? 'color:' . esc_attr( $settings->description_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->description_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover .uabb-price-list-description {
		<?php
			echo( '' !== $settings->description_hover_color ) ? 'color:' . esc_attr( $settings->description_hover_color ) . ';' : '';
		?>
	}
	<?php
}
?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
		<?php
		if ( isset( $settings->description_margin_top ) ) {
			echo( '' !== $settings->description_margin_top ) ? 'margin-top:' . esc_attr( $settings->description_margin_top ) . 'px;' : '';
		}
		if ( isset( $settings->description_margin_bottom ) ) {
			echo( '' !== $settings->description_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->description_margin_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->description_margin_left ) ) {
			echo( '' !== $settings->description_margin_left ) ? 'margin-left:' . esc_attr( $settings->description_margin_left ) . 'px;' : '';
		}
		if ( isset( $settings->description_margin_right ) ) {
			echo( '' !== $settings->description_margin_right ) ? 'margin-right:' . esc_attr( $settings->description_margin_right ) . 'px;' : '';
		}
		?>
	}
<?php
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-price,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-discount-price {
		<?php if ( 'default' !== $settings->price_font_family['family'] && 'default' !== $settings->price_font_family['weight'] ) : ?>
					<?php FLBuilderFonts::font_css( $settings->price_font_family ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->price_font_size_unit ) ) {
			echo( '' !== $settings->price_font_size_unit ) ? 'font-size:' . esc_attr( $settings->price_font_size_unit ) . 'px;' : '';
		}
		if ( isset( $settings->price_line_height_unit ) ) {
			echo( '' !== $settings->price_line_height_unit ) ? 'line-height:' . esc_attr( $settings->price_line_height_unit ) . 'em;' : '';
		}
		if ( isset( $settings->price_letter_spacing ) ) {
			echo( '' !== $settings->price_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->price_letter_spacing ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'price_font_typo',
				'selector'     => ".fl-node-$id .uabb-price-list-price ,.fl-node-$id .uabb-price-list-discount-price",
			)
		);
	}
}
if ( isset( $settings->price_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-price,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-discount-price {
		<?php
			echo( '' !== $settings->price_color ) ? 'color:' . esc_attr( $settings->price_color ) . ';' : '';
		?>
	}
	<?php
}
if ( isset( $settings->price_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover .uabb-price-list-price,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item:hover .uabb-price-list-discount-price {
		<?php
			echo( '' !== $settings->price_hover_color ) ? 'color:' . esc_attr( $settings->price_hover_color ) . ';' : '';
		?>
	}
	<?php
}
?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-wrapper {
		<?php
		if ( isset( $settings->price_margin_top ) ) {
			echo( '' !== $settings->price_margin_top ) ? 'margin-top:' . esc_attr( $settings->price_margin_top ) . 'px;' : '';
		}
		if ( isset( $settings->price_margin_bottom ) ) {
			echo( '' !== $settings->price_margin_bottom ) ? 'margin-bottom:' . esc_attr( $settings->price_margin_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->price_margin_left ) ) {
			echo( '' !== $settings->price_margin_left ) ? 'margin-left:' . esc_attr( $settings->price_margin_left ) . 'px;' : '';
		}
		if ( isset( $settings->price_margin_right ) ) {
			echo( '' !== $settings->price_margin_right ) ? 'margin-right:' . esc_attr( $settings->price_margin_right ) . 'px;' : '';
		}
		?>
	}
<?php
if ( $global_settings->responsive_enabled ) {
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
				<?php
				if ( isset( $settings->heading_font_size_unit_medium ) ) {
					echo( '' !== $settings->heading_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->heading_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->heading_line_height_unit_medium ) ) {
					echo( '' !== $settings->heading_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->heading_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
				<?php
				if ( isset( $settings->description_font_size_unit_medium ) ) {
					echo( '' !== $settings->description_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->description_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->description_line_height_unit_medium ) ) {
					echo( '' !== $settings->description_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->description_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-price,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-discount-price {
				<?php
				if ( isset( $settings->price_font_size_unit_medium ) ) {
					echo( '' !== $settings->price_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->price_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->price_line_height_unit_medium ) ) {
					echo( '' !== $settings->price_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->price_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
			<?php
			if ( isset( $settings->heading_margin_top_medium ) ) {
				echo( '' !== $settings->heading_margin_top_medium ) ? 'margin-top:' . esc_attr( $settings->heading_margin_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_bottom_medium ) ) {
				echo( '' !== $settings->heading_margin_bottom_medium ) ? 'margin-bottom:' . esc_attr( $settings->heading_margin_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_left_medium ) ) {
				echo( '' !== $settings->heading_margin_left_medium ) ? 'margin-left:' . esc_attr( $settings->heading_margin_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_right_medium ) ) {
				echo( '' !== $settings->heading_margin_right_medium ) ? 'margin-right:' . esc_attr( $settings->heading_margin_right_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
			<?php
			if ( isset( $settings->description_margin_top_medium ) ) {
				echo( '' !== $settings->description_margin_top_medium ) ? 'margin-top:' . esc_attr( $settings->description_margin_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_bottom_medium ) ) {
				echo( '' !== $settings->description_margin_bottom_medium ) ? 'margin-bottom:' . esc_attr( $settings->description_margin_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_left_medium ) ) {
				echo( '' !== $settings->description_margin_left_medium ) ? 'margin-left:' . esc_attr( $settings->description_margin_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_right_medium ) ) {
				echo( '' !== $settings->description_margin_right_medium ) ? 'margin-right:' . esc_attr( $settings->description_margin_right_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-wrapper {
			<?php
			if ( isset( $settings->price_margin_top_medium ) ) {
				echo( '' !== $settings->price_margin_top_medium ) ? 'margin-top:' . esc_attr( $settings->price_margin_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_bottom_medium ) ) {
				echo( '' !== $settings->price_margin_bottom_medium ) ? 'margin-bottom:' . esc_attr( $settings->price_margin_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_left_medium ) ) {
				echo( '' !== $settings->price_margin_left_medium ) ? 'margin-left:' . esc_attr( $settings->price_margin_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_right_medium ) ) {
				echo( '' !== $settings->price_margin_right_medium ) ? 'margin-right:' . esc_attr( $settings->price_margin_right_medium ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
			<?php
			if ( isset( $settings->list_item_padding_dimension_top_medium ) ) {
				echo( '' !== $settings->list_item_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->list_item_padding_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_left_medium ) ) {
				echo( '' !== $settings->list_item_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->list_item_padding_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_right_medium ) ) {
				echo( '' !== $settings->list_item_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->list_item_padding_dimension_right_medium ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_bottom_medium ) ) {
				echo( '' !== $settings->list_item_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->list_item_padding_dimension_bottom_medium ) . 'px;' : '';
			}
			?>
		}
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
				<?php
				if ( isset( $settings->heading_font_size_unit_responsive ) ) {
					echo( '' !== $settings->heading_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->heading_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->heading_line_height_unit_responsive ) ) {
					echo( '' !== $settings->heading_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->heading_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
				<?php
				if ( isset( $settings->description_font_size_unit_responsive ) ) {
					echo( '' !== $settings->description_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->description_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->description_line_height_unit_responsive ) ) {
					echo( '' !== $settings->description_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->description_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-price,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-discount-price {
				<?php
				if ( isset( $settings->price_font_size_unit_responsive ) ) {
					echo( '' !== $settings->price_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->price_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->price_line_height_unit_responsive ) ) {
					echo( '' !== $settings->price_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->price_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-title {
			<?php
			if ( isset( $settings->heading_margin_top_responsive ) ) {
				echo( '' !== $settings->heading_margin_top_responsive ) ? 'margin-top:' . esc_attr( $settings->heading_margin_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_bottom_responsive ) ) {
				echo( '' !== $settings->heading_margin_bottom_responsive ) ? 'margin-bottom:' . esc_attr( $settings->heading_margin_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_left_responsive ) ) {
				echo( '' !== $settings->heading_margin_left_responsive ) ? 'margin-left:' . esc_attr( $settings->heading_margin_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->heading_margin_right_responsive ) ) {
				echo( '' !== $settings->heading_margin_right_responsive ) ? 'margin-right:' . esc_attr( $settings->heading_margin_right_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-description {
			<?php
			if ( isset( $settings->description_margin_top_responsive ) ) {
				echo( '' !== $settings->description_margin_top_responsive ) ? 'margin-top:' . esc_attr( $settings->description_margin_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_bottom_responsive ) ) {
				echo( '' !== $settings->description_margin_bottom_responsive ) ? 'margin-bottom:' . esc_attr( $settings->description_margin_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_left_responsive ) ) {
				echo( '' !== $settings->description_margin_left_responsive ) ? 'margin-left:' . esc_attr( $settings->description_margin_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->description_margin_right_responsive ) ) {
				echo( '' !== $settings->description_margin_right_responsive ) ? 'margin-right:' . esc_attr( $settings->description_margin_right_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-wrapper {
			<?php
			if ( isset( $settings->price_margin_top_responsive ) ) {
				echo( '' !== $settings->price_margin_top_responsive ) ? 'margin-top:' . esc_attr( $settings->price_margin_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_bottom_responsive ) ) {
				echo( '' !== $settings->price_margin_bottom_responsive ) ? 'margin-bottom:' . esc_attr( $settings->price_margin_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_left_responsive ) ) {
				echo( '' !== $settings->price_margin_left_responsive ) ? 'margin-left:' . esc_attr( $settings->price_margin_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->price_margin_right_responsive ) ) {
				echo( '' !== $settings->price_margin_right_responsive ) ? 'margin-right:' . esc_attr( $settings->price_margin_right_responsive ) . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-price-list-item {
			<?php
			if ( isset( $settings->list_item_padding_dimension_top_responsive ) ) {
				echo( '' !== $settings->list_item_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->list_item_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_left_responsive ) ) {
				echo( '' !== $settings->list_item_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->list_item_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_right_responsive ) ) {
				echo( '' !== $settings->list_item_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->list_item_padding_dimension_right_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->list_item_padding_dimension_bottom_responsive ) ) {
				echo( '' !== $settings->list_item_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->list_item_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			?>
		}
	}
<?php } ?>
