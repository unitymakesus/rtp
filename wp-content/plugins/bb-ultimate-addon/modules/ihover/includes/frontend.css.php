<?php
/**
 *  UABB iHover Module front-end CSS php file
 *
 *  @package UABB iHover Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->title_margin_top        = '' !== trim( $settings->title_margin_top ) ? $settings->title_margin_top : '5';
$settings->title_margin_bottom     = '' !== trim( $settings->title_margin_bottom ) ? $settings->title_margin_bottom : '5';
$settings->separator_margin_top    = '' !== trim( $settings->separator_margin_top ) ? $settings->separator_margin_top : '7';
$settings->separator_margin_bottom = '' !== trim( $settings->separator_margin_bottom ) ? $settings->separator_margin_bottom : '7';
$settings->desc_margin_top         = '' !== trim( $settings->desc_margin_top ) ? $settings->desc_margin_top : '5';
$settings->desc_margin_bottom      = '' !== trim( $settings->desc_margin_bottom ) ? $settings->desc_margin_bottom : '5';

?>

<?php $height_width = ( 'custom' === $settings->height_width_options ) ? $settings->height_width : '250'; ?>

<?php
if ( count( $settings->ihover_item ) > 0 ) {
	$count = count( $settings->ihover_item );
	for ( $i = 0; $i < $count; $i++ ) {
		if ( is_object( $settings->ihover_item[ $i ] ) ) {

			$settings->ihover_item[ $i ]->title_color       = UABB_Helper::uabb_colorpicker( $settings->ihover_item[ $i ], 'title_color' );
			$settings->ihover_item[ $i ]->description_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[ $i ], 'description_color' );
			$settings->ihover_item[ $i ]->separator_color   = UABB_Helper::uabb_colorpicker( $settings->ihover_item[ $i ], 'separator_color' );
			$settings->ihover_item[ $i ]->separator_color   = ( '' !== $settings->ihover_item[ $i ]->separator_color ) ? $settings->ihover_item[ $i ]->separator_color : '#fafafa';
			$settings->ihover_item[ $i ]->background_color  = UABB_Helper::uabb_colorpicker( $settings->ihover_item[ $i ], 'background_color', true );
			if ( ! $version_bb_check ) {
				if ( 'none' !== $settings->ihover_item[ $i ]->border_style ) {
					$settings->ihover_item[ $i ]->border_color = UABB_Helper::uabb_colorpicker( $settings->ihover_item[ $i ], 'border_color', true );
					$settings->ihover_item[ $i ]->border_color = ( '' !== $settings->ihover_item[ $i ]->border_color ) ? $settings->ihover_item[ $i ]->border_color : '#EFEFEF';
					?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> .uabb-ih-wrapper {
							border-style: <?php echo esc_attr( $settings->ihover_item[ $i ]->border_style ); ?>;
							border-width: <?php echo esc_attr( $settings->ihover_item[ $i ]->border_size ); ?>px;
							border-color: <?php echo esc_attr( $settings->ihover_item[ $i ]->border_color ); ?>;
						}
					<?php
				}
			} else {
				// Item Border.
				FLBuilderCSS::border_field_rule(
					array(
						'settings'     => $settings->ihover_item[ $i ],
						'setting_name' => 'border_style_param',
						'selector'     => ".fl-node-$id .uabb-ih-item-$i .uabb-ih-wrapper",
					)
				);
			}
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> .uabb-ih-info-back {
				background-color: 
				<?php echo esc_attr( uabb_theme_base_color( $settings->ihover_item[ $i ]->background_color ) ); ?>;
			}
			<?php
			if ( '' !== $settings->ihover_item[ $i ]->title_color ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> .uabb-ih-heading,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> a.uabb-ih-link .uabb-ih-heading {
					<?php
					echo ( '' !== $settings->ihover_item[ $i ]->title_color ) ? 'color:' . esc_attr( $settings->ihover_item[ $i ]->title_color ) . ';' : '';
					?>
				}
				<?php
			}

			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> .uabb-ih-description,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> a .uabb-ih-description {
				color: 
				<?php echo esc_attr( uabb_theme_text_color( $settings->ihover_item[ $i ]->description_color ) ); ?>;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-content {
				<?php
				if ( 'yes' === $converted || '' !== $settings->content_padding_dimension_top && isset( $settings->content_padding_dimension_top ) && isset( $settings->content_padding_dimension_bottom ) && '' !== $settings->content_padding_dimension_bottom && isset( $settings->content_padding_dimension_left ) && '' !== $settings->content_padding_dimension_left && isset( $settings->content_padding_dimension_right ) && '' !== $settings->content_padding_dimension_right ) {
					if ( isset( $settings->content_padding_dimension_top ) ) {
						echo ( '' !== $settings->content_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->content_padding_dimension_top ) . 'px;' : '';
					}
					if ( isset( $settings->content_padding_dimension_bottom ) ) {
						echo ( '' !== $settings->content_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->content_padding_dimension_bottom ) . 'px;' : '';
					}
					if ( isset( $settings->content_padding_dimension_left ) ) {
						echo ( '' !== $settings->content_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->content_padding_dimension_left ) . 'px;' : '';
					}
					if ( isset( $settings->content_padding_dimension_right ) ) {
						echo ( '' !== $settings->content_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->content_padding_dimension_right ) . 'px;' : '';
					}
				} elseif ( isset( $settings->content_padding ) && '' !== $settings->content_padding && isset( $settings->content_padding_dimension_top ) && '' === $settings->content_padding_dimension_top && isset( $settings->content_padding_dimension_bottom ) && '' === $settings->content_padding_dimension_bottom && isset( $settings->content_padding_dimension_left ) && '' === $settings->content_padding_dimension_left && isset( $settings->content_padding_dimension_right ) && '' === $settings->content_padding_dimension_right ) {
					?>
						<?php echo esc_attr( $settings->content_padding ); ?>;
					<?php } ?>
			}

			<?php
			if ( 'none' !== $settings->ihover_item[ $i ]->separator_style ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item-<?php echo esc_attr( $i ); ?> .uabb-ih-line {
					border-top-style: <?php echo esc_attr( $settings->ihover_item[ $i ]->separator_style ); ?>;
					border-top-color: <?php echo esc_attr( $settings->ihover_item[ $i ]->separator_color ); ?>;
					width: <?php echo esc_attr( $settings->ihover_item[ $i ]->separator_width ); ?>%;
					height: <?php echo esc_attr( $settings->ihover_item[ $i ]->separator_size ); ?>px;
					border-top-width: <?php echo esc_attr( $settings->ihover_item[ $i ]->separator_size ); ?>px;
				}

				<?php
			}
		}
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-container ul.uabb-ih-list li.uabb-ih-list-item {
	<?php if ( is_numeric( $settings->spacing ) ) { ?>
		margin: <?php echo esc_attr( ( $settings->spacing / 2 ) ); ?>px;
	<?php } ?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-align-<?php echo esc_attr( $settings->align ); ?> {
		text-align: <?php echo esc_attr( $settings->align ); ?>;
	}
<?php } else { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-align-<?php echo esc_attr( $settings->align_param ); ?> {
		text-align: <?php echo esc_attr( $settings->align_param ); ?>;
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-image-block,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-list-item {
	height: <?php echo esc_attr( $height_width ); ?>px;
	width: <?php echo esc_attr( $height_width ); ?>px;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-heading,
.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-ih-link .uabb-ih-heading {
		<?php
		echo 'margin-top: ' . esc_attr( $settings->title_margin_top ) . 'px;';

		echo 'margin-bottom: ' . esc_attr( $settings->title_margin_bottom ) . 'px;';
		?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-heading,
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-ih-link .uabb-ih-heading {
		<?php
		if ( 'Default' !== $settings->title_typography_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->title_typography_font_family );
		}
		?>

		<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit ) && '' !== $settings->title_typography_font_size_unit ) { ?>
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
		<?php if ( 'none' !== $settings->title_typography_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->title_typography_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->title_typography_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->title_typography_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_font_typo',
				'selector'     => ".fl-node-$id .uabb-ih-heading,.fl-node-$id a.uabb-ih-link .uabb-ih-heading",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-description,
	.fl-node-<?php echo esc_attr( $id ); ?> a .uabb-ih-description {
		<?php
		if ( 'Default' !== $settings->desc_typography_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->desc_typography_font_family );
		}
		?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit ) && '' !== $settings->desc_typography_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit ); ?>px;     
		<?php } elseif ( isset( $settings->desc_typography_font_size_unit ) && '' === $settings->desc_typography_font_size_unit && isset( $settings->desc_typography_font_size['desktop'] ) && '' !== $settings->desc_typography_font_size['desktop'] ) { ?>
				font-size: <?php echo esc_attr( $settings->desc_typography_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->desc_typography_font_size['desktop'] ) && '' === $settings->desc_typography_font_size['desktop'] && isset( $settings->desc_typography_line_height['desktop'] ) && '' !== $settings->desc_typography_line_height['desktop'] && '' === $settings->desc_typography_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->desc_typography_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit ) && '' !== $settings->desc_typography_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit ); ?>em; 
		<?php } elseif ( isset( $settings->desc_typography_line_height_unit ) && '' === $settings->desc_typography_line_height_unit && isset( $settings->desc_typography_line_height['desktop'] ) && '' !== $settings->desc_typography_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_typography_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->desc_typography_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->desc_typography_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->desc_typography_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->desc_typography_letter_spacing ); ?>px;    
		<?php endif; ?>

	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-ih-description,.fl-node-$id a .uabb-ih-description",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-description-block {
	margin-top: <?php echo esc_attr( $settings->desc_margin_top ); ?>px;
	margin-bottom: <?php echo esc_attr( $settings->desc_margin_bottom ); ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-divider-block {
	margin-top: <?php echo esc_attr( $settings->separator_margin_top ); ?>px;
	margin-bottom: <?php echo esc_attr( $settings->separator_margin_bottom ); ?>px;
}

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-content {
			<?php
			if ( isset( $settings->content_padding_dimension_top_medium ) ) {
				echo ( '' !== $settings->content_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->content_padding_dimension_top_medium ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_bottom_medium ) ) {
				echo ( '' !== $settings->content_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->content_padding_dimension_bottom_medium ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_left_medium ) ) {
				echo ( '' !== $settings->content_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->content_padding_dimension_left_medium ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_right_medium ) ) {
				echo ( '' !== $settings->content_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->content_padding_dimension_right_medium ) . 'px;' : '';
			}
			?>
		}

		<?php if ( 'yes' === $settings->responsive_size ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-image-block,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-list-item {
				height: <?php echo esc_attr( $settings->height_width_responsive ); ?>px;
				width: <?php echo esc_attr( $settings->height_width_responsive ); ?>px;
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-description,
			.fl-node-<?php echo esc_attr( $id ); ?> a .uabb-ih-description {

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit_medium ) && '' !== $settings->desc_typography_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->desc_typography_font_size_unit_medium ) && '' === $settings->desc_typography_font_size_unit_medium && isset( $settings->desc_typography_font_size['medium'] ) && '' !== $settings->desc_typography_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->desc_typography_font_size['medium'] ) && '' === $settings->desc_typography_font_size['medium'] && isset( $settings->desc_typography_line_height['medium'] ) && '' !== $settings->desc_typography_line_height['medium'] && '' === $settings->desc_typography_line_height_unit_medium && '' === $settings->desc_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit_medium ) && '' !== $settings->desc_typography_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit_medium ); ?>em;  
				<?php } elseif ( isset( $settings->desc_typography_line_height_unit_medium ) && '' === $settings->desc_typography_line_height_unit_medium && isset( $settings->desc_typography_line_height['medium'] ) && '' !== $settings->desc_typography_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['medium'] ); ?>px;
				<?php } ?>

			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-heading,
			.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-ih-link .uabb-ih-heading {

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_medium ) && '' !== $settings->title_typography_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->title_typography_font_size_unit_medium ) && '' === $settings->title_typography_font_size_unit_medium && isset( $settings->title_typography_font_size['medium'] ) && '' !== $settings->title_typography_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->title_typography_font_size['medium'] ) && '' === $settings->title_typography_font_size['medium'] && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] && '' === $settings->title_typography_line_height_unit_medium && '' === $settings->title_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_medium ) && '' !== $settings->title_typography_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_medium ); ?>em;  
				<?php } elseif ( isset( $settings->title_typography_line_height_unit_medium ) && '' === $settings->title_typography_line_height_unit_medium && isset( $settings->title_typography_line_height['medium'] ) && '' !== $settings->title_typography_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['medium'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
	}

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-content {
			<?php
			if ( isset( $settings->content_padding_dimension_top_responsive ) ) {
				echo ( '' !== $settings->content_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->content_padding_dimension_top_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_bottom_responsive ) ) {
				echo ( '' !== $settings->content_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->content_padding_dimension_bottom_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_left_responsive ) ) {
				echo ( '' !== $settings->content_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->content_padding_dimension_left_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->content_padding_dimension_right_responsive ) ) {
				echo ( '' !== $settings->content_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->content_padding_dimension_right_responsive ) . 'px;' : '';
			}
			?>
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-description,
			.fl-node-<?php echo esc_attr( $id ); ?> a .uabb-ih-description {

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_font_size_unit_responsive ) && '' !== $settings->desc_typography_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size_unit_responsive ); ?>px;  
				<?php } elseif ( $settings->desc_typography_font_size_unit_responsive && '' === $settings->desc_typography_font_size_unit_responsive && isset( $settings->desc_typography_font_size['small'] ) && '' !== $settings->desc_typography_font_size['small'] ) { ?>
					font-size: <?php echo esc_attr( $settings->desc_typography_font_size['small'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->desc_typography_font_size['small'] ) && '' === $settings->desc_typography_font_size['small'] && isset( $settings->desc_typography_line_height['small'] ) && '' !== $settings->desc_typography_line_height['small'] && '' === $settings->desc_typography_line_height_unit_responsive && '' === $settings->desc_typography_line_height_unit_medium && '' === $settings->desc_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->desc_typography_line_height_unit_responsive ) && '' !== $settings->desc_typography_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->desc_typography_line_height_unit_responsive ) && '' === $settings->desc_typography_line_height_unit_responsive && isset( $settings->desc_typography_line_height['small'] ) && '' !== $settings->desc_typography_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->desc_typography_line_height['small'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-heading,
			.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-ih-link .uabb-ih-heading {

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_font_size_unit_responsive ) && '' !== $settings->title_typography_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size_unit_responsive ); ?>px;  
				<?php } elseif ( $settings->title_typography_font_size_unit_responsive && '' === $settings->title_typography_font_size_unit_responsive && isset( $settings->title_typography_font_size['small'] ) && '' !== $settings->title_typography_font_size['small'] ) { ?>
					font-size: <?php echo esc_attr( $settings->title_typography_font_size['small'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->title_typography_font_size['small'] ) && '' === $settings->title_typography_font_size['small'] && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] && '' === $settings->title_typography_line_height_unit_responsive && '' === $settings->title_typography_line_height_unit_medium && '' === $settings->title_typography_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->title_typography_line_height_unit_responsive ) && '' !== $settings->title_typography_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->title_typography_line_height_unit_responsive ) && '' === $settings->title_typography_line_height_unit_responsive && isset( $settings->title_typography_line_height['small'] ) && '' !== $settings->title_typography_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->title_typography_line_height['small'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php
		if ( 'yes' === $settings->responsive_size ) {
			?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-image-block,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-item,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ih-list-item {
			<?php
			echo ( '' !== $settings->height_width_responsive ) ? 'height: ' . esc_attr( $settings->height_width_responsive ) . 'px;' : '';
			echo ( '' !== $settings->height_width_responsive ) ? 'width: ' . esc_attr( $settings->height_width_responsive ) . 'px;' : '';
			?>
			max-width: 100%;
		}
			<?php
		}
		?>
	}
	<?php
}
?>
