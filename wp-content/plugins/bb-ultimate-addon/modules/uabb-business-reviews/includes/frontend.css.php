<?php
/**
 *  Frontend CSS php file for Business Review Module.
 *
 *  @package UABB Business Review Module's Frontend.css.php file.
 */

$version_bb_check = UABB_Compatibility::check_bb_version();

$settings->reviewer_name_color = UABB_Helper::uabb_colorpicker( $settings, 'reviewer_name_color', true );

$settings->reviewer_content_color = UABB_Helper::uabb_colorpicker( $settings, 'reviewer_content_color', true );

$settings->reviewer_date_color = UABB_Helper::uabb_colorpicker( $settings, 'reviewer_date_color', true );

$settings->rating_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'rating_icon_color', true );

$settings->stars_unmarked_color = UABB_Helper::uabb_colorpicker( $settings, 'stars_unmarked_color', true );

$settings->block_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'block_bg_color', true );
$settings->dots_color      = UABB_Helper::uabb_colorpicker( $settings, 'dots_color', true );
$settings->arrows_color    = UABB_Helper::uabb_colorpicker( $settings, 'arrows_color', true );
$settings->read_more_color = UABB_Helper::uabb_colorpicker( $settings, 'read_more_color', true );
if ( ! $version_bb_check ) {
	$settings->block_border_color = UABB_Helper::uabb_colorpicker( $settings, 'block_border_color', true );
}
?>
<?php if ( isset( $settings->read_more_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-reviews-read-more_wrap .uabb-reviews-read-more {
		<?php echo ( '' !== $settings->read_more_color ) ? 'color:' . $settings->read_more_color . ';' : ''; ?>
	}
	<?php
}
?>
<?php if ( isset( $settings->content_block_bottom_spacing ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content-wrap {
		<?php echo ( '' !== $settings->content_block_bottom_spacing ) ? 'margin-bottom:' . $settings->content_block_bottom_spacing . 'px;' : ''; ?>
	}
<?php } ?>
<?php
if ( 'yes' === $settings->reviewer_name ) {
	if ( isset( $settings->reviewer_name_color ) && '' != $settings->reviewer_name_color ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-reviewer-name,
		.fl-node-<?php echo $id; ?> .uabb-reviewer-name .uabb-reviewer-link {
			color:<?php echo $settings->reviewer_name_color; ?>;
		}
		<?php
	}
}
?>
<?php
if ( 'default' === $settings->review_date_type || 'relative' === $settings->review_date_type ) {
	if ( isset( $settings->reviewer_date_color ) && '' != $settings->reviewer_date_color ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-review-time {
			color:<?php echo $settings->reviewer_date_color; ?>;
		}
		<?php
	}
}
?>
<?php
if ( 'yes' === $settings->review_content ) {
	if ( isset( $settings->reviewer_content_color ) && '' != $settings->reviewer_content_color ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-review-content {
			color:<?php echo $settings->reviewer_content_color; ?>;
		}
		<?php
	}
}
?>
<?php if ( 'yes' === $settings->review_rating && 'custom' === $settings->select_star_style ) { ?>
	<?php if ( isset( $settings->rating_icon_color ) && '' != $settings->rating_icon_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-full {
		color:<?php echo $settings->rating_icon_color; ?>
	}
		<?php
}
if ( isset( $settings->stars_unmarked_color ) && '' != $settings->stars_unmarked_color ) {
		?>
	.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-empty {
		color:<?php echo $settings->stars_unmarked_color; ?>;
	}
		<?php
}
}
?>
<?php if ( isset( $settings->block_bg_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content,
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-default .uabb-review,
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-card .uabb-review {
		background-color:<?php echo $settings->block_bg_color; ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-arrow {
		<?php echo ( '' !== $settings->block_bg_color ) ? 'border-top-color:' . $settings->block_bg_color . ';' : ''; ?>
	}
	<?php
}
?>
<?php if ( isset( $settings->column_gap ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-review-wrap {
		<?php
		if ( isset( $settings->column_gap ) ) {

			echo ( '' !== $settings->column_gap ) ? 'padding-right:calc(' . $settings->column_gap / 2 . 'px);' : '';

			echo ( '' !== $settings->column_gap ) ? 'padding-left:calc(' . $settings->column_gap / 2 . 'px);' : '';

			echo ( '' !== $settings->column_gap ) ? 'margin-bottom:' . $settings->column_gap . 'px;' : '';
		}
		?>
	}
	<?php
}
?>
<?php if ( isset( $settings->row_gap ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-reviews-layout-grid .uabb-review-wrap {
		<?php
		if ( isset( $settings->row_gap ) ) {
			echo ( '' !== $settings->row_gap ) ? 'margin-bottom:' . $settings->row_gap . 'px;' : '';
		}
		?>
	}
<?php } ?>

/* CSS for  Rating and Revieer images  */
<?php

if ( ( 'yes' === $settings->review_rating ) || ( 'yes' === $settings->reviewer_image ) ) {
	if ( 'custom' === $settings->select_star_style ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-full ,
		.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-empty {
			<?php
			if ( isset( $settings->icon_size ) ) {
				echo ( '' !== $settings->icon_size ) ? 'font-size:' . $settings->icon_size . 'px;' : '';
				echo ( '' !== $settings->icon_size ) ? 'line-height:' . round( $settings->icon_size / $settings->icon_size, 2 ) . 'em;' : '';
			}
			?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-image {
		<?php
		if ( isset( $settings->image_size ) ) {
			echo ( '' !== $settings->image_size ) ? 'width:' . $settings->image_size . 'px;' : '';
			echo ( '' !== $settings->image_size ) ? 'height:' . $settings->image_size . 'px;' : '';
		}
		?>

	} 
<?php } ?>

/* css for name typography */
<?php
if ( ! $version_bb_check ) {
	?>
		.fl-node-<?php echo $id; ?> .uabb-review-content .uabb-reviews-read-more {
			<?php if ( 'default' !== $settings->readmore_font['family'] && 'default' !== $settings->readmore_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->readmore_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->readmore_font_size_unit ) ) {
				echo ( '' !== $settings->readmore_font_size_unit ) ? 'font-size:' . $settings->readmore_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->readmore_line_height_unit ) ) {
				echo ( '' !== $settings->readmore_line_height_unit ) ? 'line-height:' . $settings->readmore_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->readmore_title_letter_spacing ) ) {
				echo ( '' !== $settings->readmore_title_letter_spacing ) ? 'letter-spacing:' . $settings->readmore_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->readmore_title_transform ) ) {
				echo ( '' !== $settings->readmore_title_transform ) ? 'text-transform:' . $settings->readmore_title_transform . ';' : '';
			}
			?>
		}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'readmore_typography',
				'selector'     => ".fl-node-$id .uabb-reviews-read-more_wrap .uabb-reviews-read-more",
			)
		);
	}
}
?>
<?php if ( 'yes' === $settings->reviewer_name ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-reviewer-link,
		.fl-node-<?php echo $id; ?> .uabb-review-name {
			<?php if ( 'default' !== $settings->date_font['family'] && 'default' !== $settings->date_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->date_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->name_font_size_unit ) ) {
				echo ( '' !== $settings->name_font_size_unit ) ? 'font-size:' . $settings->name_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->name_line_height_unit ) ) {
				echo ( '' !== $settings->name_line_height_unit ) ? 'line-height:' . $settings->name_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->name_title_letter_spacing ) ) {
				echo ( '' !== $settings->name_title_letter_spacing ) ? 'letter-spacing:' . $settings->name_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->name_title_transform ) ) {
				echo ( '' !== $settings->name_title_transform ) ? 'text-transform:' . $settings->name_title_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'typography_name',
				'selector'     => ".fl-node-$id .uabb-reviewer-link, .fl-node-$id .uabb-review-name",
			)
		);
	}
}
}
?>

<?php if ( 'none' !== $settings->review_date_type ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-review-time {
			<?php if ( 'default' !== $settings->date_font['family'] && 'default' !== $settings->date_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->date_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->date_font_size_unit ) ) {
				echo ( '' !== $settings->date_font_size_unit ) ? 'font-size:' . $settings->date_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->date_line_height_unit ) ) {
				echo ( '' !== $settings->date_line_height_unit ) ? 'line-height:' . $settings->date_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->date_title_letter_spacing ) ) {
				echo ( '' !== $settings->date_title_letter_spacing ) ? 'letter-spacing:' . $settings->date_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->date_title_transform ) ) {
				echo ( '' !== $settings->date_title_transform ) ? 'text-transform:' . $settings->date_title_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'date_time_typography',
				'selector'     => ".fl-node-$id .uabb-review-time",
			)
		);
	}
}
}
?>
/* css for review content typography */
<?php if ( 'yes' === $settings->review_content ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-review-content {
			<?php if ( 'default' !== $settings->content_font['family'] && 'default' !== $settings->content_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->content_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->content_font_size_unit ) ) {
				echo ( '' !== $settings->content_font_size_unit ) ? 'font-size:' . $settings->content_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->content_line_height_unit ) ) {
				echo ( '' !== $settings->content_line_height_unit ) ? 'line-height:' . $settings->content_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->content_title_letter_spacing ) ) {
				echo ( '' !== $settings->content_title_letter_spacing ) ? 'letter-spacing:' . $settings->content_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->content_title_transform ) ) {
				echo ( '' !== $settings->content_title_transform ) ? 'text-transform:' . $settings->content_title_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'content_typography',
				'selector'     => ".fl-node-$id .uabb-review-content",
			)
		);
	}
}
}
?>

/* For border block css */

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content,
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-default .uabb-review,
	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-card .uabb-review {
		<?php
		if ( isset( $settings->block_border_style ) ) {
			echo ( '' !== $settings->block_border_style ) ? 'border-style:' . $settings->block_border_style . ';' : '';
		}
		if ( isset( $settings->block_border_width ) ) {
			echo ( '' !== $settings->block_border_width ) ? 'border-width:' . $settings->block_border_width . 'px;' : '';
		}
		if ( isset( $settings->block_border_color ) ) {
			echo ( '' !== $settings->block_border_color ) ? 'border-color:' . $settings->block_border_color . ';' : '';
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
				'setting_name' => 'block_border',
				'selector'     => ".fl-node-$id .uabb-reviews-skin-default .uabb-review,.fl-node-$id .uabb-reviews-skin-card .uabb-review,.fl-node-$id .uabb-reviews-skin-bubble .uabb-review-content",
			)
		);
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-arrow-border {
	<?php
	if ( isset( $settings->block_border['color'] ) ) {
		echo 'border-top-color:#' . $settings->block_border['color'] . ';';
	}
	?>

}
<?php if ( 'yes' === $settings->reviewer_name ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-review .uabb-reviewer-name {
		<?php
		if ( isset( $settings->reviewer_name_spacing ) ) {
			echo 'margin-bottom:' . $settings->reviewer_name_spacing . 'px';
		}
		?>
	}
<?php } ?>


	<?php if ( 'yes' === $settings->review_content ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-content {
		<?php
		if ( isset( $settings->content_spacing ) ) {
			echo ( '' !== $settings->content_spacing ) ? 'margin-bottom:' . $settings->content_spacing . 'px ;' : '';
		}
		?>
	}
<?php } ?>
	<?php if ( 'yes' === $settings->review_rating ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-rating__wrapper {
		<?php
		if ( isset( $settings->star_spacing ) ) {
			echo ( '' !== $settings->star_spacing ) ? 'margin-bottom:' . $settings->star_spacing . 'px' : '';
		}
		?>
	}
<?php } ?>

	<?php if ( 'yes' === $settings->review_date ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-time {
		<?php
		if ( isset( $settings->date_spacing ) ) {
			echo ( '' !== $settings->date_spacing ) ? 'margin-bottom:' . $settings->date_spacing . 'px' : '';
		}
		?>
	}
<?php } ?>

<?php if ( 'yes' === $settings->reviewer_image ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-image,
	.fl-node-<?php echo $id; ?> .uabb-review-image-all_left .uabb-review-image,
	.fl-node-<?php echo $id; ?> .uabb-review-image-left .uabb-review-image {
		<?php
		if ( isset( $settings->reviewer_image_spacing ) ) {
			echo ( '' !== $settings->reviewer_image_spacing ) ? 'margin-right:' . $settings->reviewer_image_spacing . 'px' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-review-image-top .uabb-review-image {
		<?php
		if ( isset( $settings->reviewer_image_spacing ) ) {
			echo ( '' !== $settings->reviewer_image_spacing ) ? 'margin-bottom:' . $settings->reviewer_image_spacing . 'px' : '';
		}
		?>
	}
<?php } ?>
<?php if ( isset( $settings->block_padding_top ) && isset( $settings->block_padding_right ) && isset( $settings->block_padding_bottom ) && isset( $settings->block_padding_left ) ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-reviews-skin-card .uabb-review,
		.fl-node-<?php echo $id; ?> .uabb-reviews-skin-default .uabb-review,
		.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content {
			<?php
			if ( isset( $settings->block_padding_top ) ) {
				echo ( '' !== $settings->block_padding_top ) ? 'padding-top:' . $settings->block_padding_top . 'px;' : '';
			}
			if ( isset( $settings->block_padding_right ) ) {
				echo ( '' !== $settings->block_padding_right ) ? 'padding-right:' . $settings->block_padding_right . 'px;' : '';
			}
			if ( isset( $settings->block_padding_bottom ) ) {
				echo ( '' !== $settings->block_padding_bottom ) ? 'padding-bottom:' . $settings->block_padding_bottom . 'px;' : '';
			}
			if ( isset( $settings->block_padding_left ) ) {
				echo ( '' !== $settings->block_padding_left ) ? 'padding-left:' . $settings->block_padding_left . 'px;' : '';
			}
			?>
		}
<?php } ?>
<?php
if ( 'carousel' === $settings->review_layout ) {
	if ( isset( $settings->arrows_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-prev i,
		.fl-node-<?php echo $id; ?> .slick-slider .slick-next i {
			<?php
				echo ( '' !== $settings->arrows_size ) ? 'font-size:' . $settings->arrows_size . 'px;' : '';
				echo ( '' !== $settings->arrows_size ) ? 'line-height:' . $settings->arrows_size . 'px;' : '';
				echo ( '' !== $settings->arrows_size ) ? 'width:' . $settings->arrows_size . 'px;' : '';
				echo ( '' !== $settings->arrows_size ) ? 'height:' . $settings->arrows_size . 'px;' : '';
			?>
		}
		<?php
	}
	if ( isset( $settings->arrows_color ) && ( '' !== $settings->arrows_color ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-prev:before,
		.fl-node-<?php echo $id; ?> .slick-slider .slick-next:before {
			<?php echo ( '' !== $settings->arrows_color ) ? 'color:' . $settings->arrows_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow {
			<?php echo ( '' !== $settings->arrows_color ) ? 'border-color:' . $settings->arrows_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow i {
			<?php echo ( '' !== $settings->arrows_color ) ? 'color:' . $settings->arrows_color . ';' : ''; ?>
		}
		<?php
	}
	if ( isset( $settings->arrows_border_size ) && ( '' !== $settings->arrows_border_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow {
			<?php echo ( '' !== $settings->arrows_border_size ) ? 'border-width:' . $settings->arrows_border_size . 'px;' : ''; ?>
		}
		<?php
	}
	if ( isset( $settings->arrow_border_radius ) && ( '' !== $settings->arrow_border_radius ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow {
		<?php echo ( '' !== $settings->arrow_border_radius ) ? 'border-radius:' . $settings->arrow_border_radius . 'px;' : ''; ?>
		}
		<?php
	}
}
?>
<?php
if ( 'carousel' === $settings->review_layout ) {

	if ( '' !== $settings->dots_size && isset( $settings->dots_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-reviews-module-wrap .slick-dots li button:before {
			<?php echo ( '' !== $settings->dots_size ) ? 'font-size:' . $settings->dots_size . 'px;' : ''; ?>
		}
		<?php
	}

	if ( '' !== $settings->dots_color && isset( $settings->dots_color ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-reviews-module-wrap .slick-dots li button:before {
			<?php echo ( '' !== $settings->dots_color ) ? 'color:' . $settings->dots_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .uabb-reviews-module-wrap ul.slick-dots li.slick-active button:before {
			<?php echo ( '' !== $settings->dots_color ) ? 'color:' . $settings->dots_color . ';' : ''; ?>
			opacity:1;
		}
		<?php
	}

	?>
<?php } ?>

<?php if ( $global_settings->responsive_enabled ) { ?>

	@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

		<?php if ( 'yes' === $settings->reviewer_name ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review .uabb-reviewer-name {
				<?php
				if ( isset( $settings->reviewer_name_spacing_medium ) ) {
					echo ( '' !== $settings->reviewer_name_spacing_medium ) ? 'margin-bottom:' . $settings->reviewer_name_spacing_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->content_block_bottom_spacing_medium ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content-wrap {
				<?php echo ( '' !== $settings->content_block_bottom_spacing_medium ) ? 'margin-bottom:' . $settings->content_block_bottom_spacing_medium . 'px;' : ''; ?>
			}
		<?php } ?>

		<?php if ( 'yes' === $settings->review_content ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-content {
				<?php
				if ( isset( $settings->content_spacing_medium ) ) {
					echo ( '' !== $settings->content_spacing_medium ) ? 'margin-bottom:' . $settings->content_spacing_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->reviewer_image ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-image,
			.fl-node-<?php echo $id; ?> .uabb-review-image-all_left .uabb-review-image,
			.fl-node-<?php echo $id; ?> .uabb-review-image-left .uabb-review-image {
				<?php
				if ( isset( $settings->reviewer_image_spacing_medium ) ) {
					echo ( '' !== $settings->reviewer_image_spacing_medium ) ? 'margin-right:' . $settings->reviewer_image_spacing_medium . 'px' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-review-image-top .uabb-review-image {
				<?php
				if ( isset( $settings->reviewer_image_spacing_medium ) ) {
					echo ( '' !== $settings->reviewer_image_spacing_medium ) ? 'margin-bottom:' . $settings->reviewer_image_spacing_medium . 'px' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->review_rating ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-rating__wrapper {
				<?php
				if ( isset( $settings->star_spacing_medium ) ) {
					echo ( '' !== $settings->star_spacing_medium ) ? 'margin-bottom:' . $settings->star_spacing_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->review_content ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-time {
				<?php
				if ( isset( $settings->date_spacing_medium ) ) {
					echo ( '' !== $settings->date_spacing_medium ) ? 'margin-bottom:' . $settings->date_spacing_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->column_gap ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-wrap {
				<?php
				if ( isset( $settings->column_gap_medium ) ) {
					echo ( '' !== $settings->column_gap_medium ) ? 'padding-right:calc(' . $settings->column_gap_medium / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
					echo ( '' !== $settings->column_gap_medium ) ? 'padding-left:calc(' . $settings->column_gap_medium / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->row_gap ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-wrap {
				<?php
				if ( isset( $settings->row_gap_medium ) ) {
					echo ( '' !== $settings->row_gap_medium ) ? 'margin-bottom:' . $settings->row_gap_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		/* CSS for  Rating and Revieer images  */

		<?php
		if ( ( 'yes' === $settings->review_rating ) || ( 'yes' === $settings->reviewer_image ) ) {
			if ( 'custom' === $settings->select_star_style ) {
				?>
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-full ,
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-empty {
					<?php
					if ( isset( $settings->icon_size_medium ) ) {
						echo ( '' !== $settings->icon_size_medium ) ? 'font-size:' . $settings->icon_size_medium . 'px;' : '';
						echo ( '' !== $settings->icon_size_medium ) ? 'line-height:' . round( $settings->icon_size_medium / $settings->icon_size_medium, 2 ) . 'em;' : '';
						echo ( '' !== $settings->icon_size_medium ) ? 'height:' . $settings->icon_size_medium . 'px;' : '';
						echo ( '' !== $settings->icon_size_medium ) ? 'width:' . $settings->icon_size_medium . 'px;' : '';
					}
					?>
				}
			<?php } ?>
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-image {
					<?php
					if ( isset( $settings->image_size_medium ) ) {
						echo ( '' !== $settings->image_size_medium ) ? 'width:' . $settings->image_size_medium . 'px;' : '';
						echo ( '' !== $settings->image_size_medium ) ? 'height:' . $settings->image_size_medium . 'px;' : '';
					}
					?>

				} 
		<?php } ?>
		/* css for name typography */
		<?php if ( 'yes' === $settings->reviewer_name ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-reviewer-name {
					<?php
					if ( isset( $settings->name_font_size_unit_medium ) ) {
						echo ( '' !== $settings->name_font_size_unit_medium ) ? 'font-size:' . $settings->name_font_size_unit_medium . 'px;' : '';
					}
					if ( isset( $settings->name_line_height_unit_medium ) ) {
						echo ( '' !== $settings->name_line_height_unit_medium ) ? 'line-height:' . $settings->name_line_height_unit_medium . 'em;' : '';
					}
					?>
				}
				<?php
}
}
		?>
		/* css for Date typography */
		<?php if ( 'none' !== $settings->review_date_type ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-review-time {
					<?php
					if ( isset( $settings->date_font_size_unit_medium ) ) {
						echo ( '' !== $settings->date_font_size_unit_medium ) ? 'font-size:' . $settings->date_font_size_unit_medium . 'px;' : '';
					}
					if ( isset( $settings->date_line_height_unit_medium ) ) {
						echo ( '' !== $settings->date_line_height_unit_medium ) ? 'line-height:' . $settings->date_line_height_unit_medium . 'em;' : '';
					}
					?>
				}
				<?php
}
}
		?>
		/* css for review content typography */
		<?php if ( 'yes' === $settings->review_content ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-review-content {
					<?php
					if ( isset( $settings->content_font_size_unit_medium ) ) {
						echo ( '' !== $settings->content_font_size_unit_medium ) ? 'font-size:' . $settings->content_font_size_unit_medium . 'px;' : '';
					}
					if ( isset( $settings->content_line_height_unit_medium ) ) {
						echo ( '' !== $settings->content_line_height_unit_medium ) ? 'line-height:' . $settings->content_line_height_unit_medium . 'em;' : '';
					}
					?>
				}
				<?php
}
}
		?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-content .uabb-reviews-read-more {
				<?php
				if ( isset( $settings->readmore_font_size_unit_medium ) ) {
					echo ( '' !== $settings->readmore_font_size_unit_medium ) ? 'font-size:' . $settings->readmore_font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->readmore_line_height_unit_medium ) ) {
					echo ( '' !== $settings->readmore_line_height_unit_medium ) ? 'line-height:' . $settings->readmore_line_height_unit_medium . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->block_padding_top_medium ) && isset( $settings->block_padding_right_medium ) && isset( $settings->block_padding_bottom_medium ) && isset( $settings->block_padding_left_medium ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-reviews-skin-card .uabb-review,
				.fl-node-<?php echo $id; ?> .uabb-reviews-skin-default .uabb-review,
				.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content {
					<?php
					if ( isset( $settings->block_padding_top_medium ) ) {
						echo ( '' !== $settings->block_padding_top_medium ) ? 'padding-top:' . $settings->block_padding_top_medium . 'px;' : '';
					}
					if ( isset( $settings->block_padding_right_medium ) ) {
						echo ( '' !== $settings->block_padding_right_medium ) ? 'padding-right:' . $settings->block_padding_right_medium . 'px;' : '';
					}
					if ( isset( $settings->block_padding_bottom_medium ) ) {
						echo ( '' !== $settings->block_padding_bottom_medium ) ? 'padding-bottom:' . $settings->block_padding_bottom_medium . 'px;' : '';
					}
					if ( isset( $settings->block_padding_left_medium ) ) {
						echo ( '' !== $settings->block_padding_left_medium ) ? 'padding-left:' . $settings->block_padding_left_medium . 'px;' : '';
					}
					?>
				}
		<?php } ?>        
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
		<?php if ( isset( $settings->content_block_bottom_spacing_responsive ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content-wrap {
				<?php echo ( '' !== $settings->content_block_bottom_spacing_responsive ) ? 'margin-bottom:' . $settings->content_block_bottom_spacing_responsive . 'px;' : ''; ?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->reviewer_name ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-reviewer-name {
					<?php
					if ( isset( $settings->reviewer_name_spacing_responsive ) ) {
						echo ( '' !== $settings->reviewer_name_spacing_responsive ) ? 'margin-bottom:' . $settings->reviewer_name_spacing_responsive . 'px;' : '';
					}
					?>
				}
		<?php } ?>
		<?php if ( 'yes' === $settings->review_content ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-content {
				<?php
				if ( isset( $settings->content_spacing_responsive ) ) {
					echo ( '' !== $settings->content_spacing_responsive ) ? 'margin-bottom:' . $settings->content_spacing_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->reviewer_image ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-image,
			.fl-node-<?php echo $id; ?> .uabb-review-image-all_left .uabb-review-image,
			.fl-node-<?php echo $id; ?> .uabb-review-image-left .uabb-review-image {
				<?php
				if ( isset( $settings->reviewer_image_spacing_responsive ) ) {
					echo ( '' !== $settings->reviewer_image_spacing_responsive ) ? 'margin-right:' . $settings->reviewer_image_spacing_responsive . 'px' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-review-image-top .uabb-review-image {
				<?php
				if ( isset( $settings->reviewer_image_spacing_responsive ) ) {
					echo ( '' !== $settings->reviewer_image_spacing_responsive ) ? 'margin-bottom:' . $settings->reviewer_image_spacing_responsive . 'px' : '';
				}
				?>
			}
		<?php } ?>

		<?php if ( 'yes' === $settings->review_rating ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-rating__wrapper {
				<?php
				if ( isset( $settings->star_spacing_responsive ) ) {
					echo ( '' !== $settings->star_spacing_responsive ) ? 'margin-bottom:' . $settings->star_spacing_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'yes' === $settings->review_date ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-time {
				<?php
				if ( isset( $settings->date_spacing_responsive ) ) {
					echo ( '' !== $settings->date_spacing_responsive ) ? 'margin-bottom:' . $settings->date_spacing_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>

		<?php if ( isset( $settings->column_gap ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-wrap {
				<?php
				if ( isset( $settings->column_gap_responsive ) ) {
					echo ( '' !== $settings->column_gap_responsive ) ? 'padding-right:calc(' . $settings->column_gap_responsive / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
					echo ( '' !== $settings->column_gap_responsive ) ? 'padding-left:calc(' . $settings->column_gap_responsive / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->row_gap ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-wrap {
				<?php
				if ( isset( $settings->row_gap_responsive ) ) {
					echo ( '' !== $settings->row_gap_responsive ) ? 'padding-bottom:' . $settings->row_gap_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		/* CSS for  Rating and Revieer images  */
		<?php
		if ( ( 'yes' === $settings->review_rating ) || ( 'yes' === $settings->reviewer_image ) ) {
			if ( 'custom' === $settings->select_star_style ) {
				?>
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-full ,
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-star-empty {
					<?php
					if ( isset( $settings->icon_size_responsive ) ) {
						echo ( '' !== $settings->icon_size_responsive ) ? 'font-size:' . $settings->icon_size_responsive . 'px;' : '';
						echo ( '' !== $settings->icon_size_responsive ) ? 'line-height:' . round( $settings->icon_size_responsive / $settings->icon_size_responsive, 2 ) . 'em;' : '';
						echo ( '' !== $settings->icon_size_responsive ) ? 'height:' . $settings->icon_size_responsive . 'px;' : '';
						echo ( '' !== $settings->icon_size_responsive ) ? 'width:' . $settings->icon_size_responsive . 'px;' : '';
					}
					?>
				}
				<?php } ?>
				.fl-node-<?php echo $id; ?> .uabb-review .uabb-review-image {
					<?php
					if ( isset( $settings->image_size_responsive ) ) {
						echo ( '' !== $settings->image_size_responsive ) ? 'width:' . $settings->image_size_responsive . 'px;' : '';
						echo ( '' !== $settings->image_size_responsive ) ? 'height:' . $settings->image_size_responsive . 'px;' : '';
					}
					?>

				} 
		<?php } ?>
		<?php if ( 'yes' === $settings->reviewer_name ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				<?php
				if ( isset( $settings->name_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->name_line_height_unit_responsive ) ? 'font-size:' . $settings->name_line_height_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->name_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->name_line_height_unit_responsive ) ? 'line-height:' . $settings->name_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
				<?php
}
}
		?>
		<?php if ( 'none' !== $settings->review_date_type ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-review-time {
					<?php
					if ( isset( $settings->date_font_size_unit_responsive ) ) {
						echo ( '' !== $settings->date_font_size_unit_responsive ) ? 'font-size:' . $settings->date_font_size_unit_responsive . 'px;' : '';
					}
					if ( isset( $settings->date_line_height_unit_responsive ) ) {
						echo ( '' !== $settings->date_line_height_unit_responsive ) ? 'line-height:' . $settings->date_line_height_unit_responsive . 'em;' : '';
					}
					?>
				}
				<?php
}
}
		?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-review-content .uabb-reviews-read-more {
				<?php
				if ( isset( $settings->readmore_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->readmore_font_size_unit_responsive ) ? 'font-size:' . $settings->readmore_font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->readmore_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->readmore_line_height_unit_responsive ) ? 'line-height:' . $settings->readmore_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		/* css for review content typography */
		<?php if ( 'yes' === $settings->review_content ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-review-content {
					<?php
					if ( isset( $settings->content_font_size_unit_responsive ) ) {
						echo ( '' !== $settings->content_font_size_unit_responsive ) ? 'font-size:' . $settings->content_font_size_unit_responsive . 'px;' : '';
					}
					if ( isset( $settings->content_line_height_unit_responsive ) ) {
						echo ( '' !== $settings->content_line_height_unit_responsive ) ? 'line-height:' . $settings->content_line_height_unit_responsive . 'em;' : '';
					}
					?>
				}
				<?php
}
}
		?>
	<?php if ( isset( $settings->block_padding_top_responsive ) && isset( $settings->block_padding_right_responsive ) && isset( $settings->block_padding_bottom_responsive ) && isset( $settings->block_padding_left_responsive ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-card .uabb-review,
			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-default .uabb-review,
			.fl-node-<?php echo $id; ?> .uabb-reviews-skin-bubble .uabb-review-content {
				<?php
				if ( isset( $settings->block_padding_top_responsive ) ) {
					echo ( '' !== $settings->block_padding_top_responsive ) ? 'padding-top:' . $settings->block_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->block_padding_right_responsive ) ) {
					echo ( '' !== $settings->block_padding_right_responsive ) ? 'padding-right:' . $settings->block_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->block_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->block_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->block_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->block_padding_left_responsive ) ) {
					echo ( '' !== $settings->block_padding_left_responsive ) ? 'padding-left:' . $settings->block_padding_left_responsive . 'px;' : '';
				}
				?>
			}
	<?php } ?>
	}
	<?php
}


