<?php
/**
 *  Frontend CSS php file for Video Gallery module
 *
 *  @package Video Module's Frontend.css.php file
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->filter_title_color             = UABB_Helper::uabb_colorpicker( $settings, 'filter_title_color', true );
$settings->cat_filter_color               = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_color', true );
$settings->cat_filter_bg_color            = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_bg_color', true );
$settings->cat_filter_hover_color         = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_hover_color', true );
$settings->play_icon_color                = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_color', true );
$settings->play_icon_hover_color          = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_hover_color', true );
$settings->overlay_background_color       = UABB_Helper::uabb_colorpicker( $settings, 'overlay_background_color', true );
$settings->overlay_background_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_background_hover_color', true );
$settings->caption_color                  = UABB_Helper::uabb_colorpicker( $settings, 'caption_color', true );
$settings->dots_color                     = UABB_Helper::uabb_colorpicker( $settings, 'dots_color', true );
$settings->arrows_color                   = UABB_Helper::uabb_colorpicker( $settings, 'arrows_color', true );
$settings->tag_color                      = UABB_Helper::uabb_colorpicker( $settings, 'tag_color', true );
$settings->cat_filter_bg_hover_color      = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_bg_hover_color', true );

?>
<?php
if ( ! $version_bb_check ) {
	$settings->cat_filter_border_color        = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_border_color', true );
	$settings->cat_filter_border_color_active = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_border_color_active', true );
}
?>
<?php if ( isset( $settings->column_gap ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {
		<?php
		if ( isset( $settings->column_gap ) ) {
			echo ( '' !== $settings->column_gap ) ? 'padding-right:calc(' . $settings->column_gap / 2 . 'px);' : 'padding-right:calc( 10px/2 );';
			echo ( '' !== $settings->column_gap ) ? 'padding-left:calc(' . $settings->column_gap / 2 . 'px);' : 'padding-left:calc( 10px/2 );';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-vg__overlay{
		<?php
		if ( isset( $settings->column_gap ) ) {
			echo ( '' !== $settings->column_gap ) ? 'width:calc( 100% - ' . $settings->column_gap . 'px );' : '';
			echo ( '' !== $settings->column_gap ) ? 'left:calc(' . $settings->column_gap / 2 . 'px );' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap {

		<?php echo ( '' !== $settings->column_gap ) ? 'margin-left:calc(-' . $settings->column_gap / 2 . 'px );' : ''; ?>
		<?php echo ( '' !== $settings->column_gap ) ? 'margin-right:calc(-' . $settings->column_gap / 2 . 'px );' : ''; ?>
	}
<?php } ?>
<?php if ( isset( $settings->row_gap ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {
		<?php
		if ( isset( $settings->row_gap ) ) {
			echo ( '' !== $settings->row_gap ) ? 'padding-bottom:' . $settings->row_gap . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-vg__overlay {
		<?php
		if ( isset( $settings->row_gap ) ) {
			echo ( '' !== $settings->row_gap ) ? 'height: calc( 100% - ' . $settings->row_gap . 'px );' : '';
		}
		?>
	}
<?php } ?>

/* CSS for Title filter */
<?php if ( isset( $settings->filter_title_color ) && '' !== $settings->filter_title_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video-gallery-title-text {
		color:<?php echo $settings->filter_title_color; ?>;
	}
<?php } ?>
<?php if ( 'yes' === $settings->show_filter_title && '' !== $settings->filters_heading_text ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-title-text {
			<?php if ( 'default' !== $settings->filter_title_font['family'] && 'default' !== $settings->filter_title_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->filter_title_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->filter_title_font_size_unit ) ) {
				echo ( '' !== $settings->filter_title_font_size_unit ) ? 'font-size:' . $settings->filter_title_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->filter_title_line_height_unit ) ) {
				echo ( '' !== $settings->filter_title_line_height_unit ) ? 'line-height:' . $settings->filter_title_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->filter_title_letter_spacing ) ) {
				echo ( '' !== $settings->filter_title_letter_spacing ) ? 'letter-spacing:' . $settings->filter_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->filter_title_transform ) ) {
				echo ( '' !== $settings->filter_title_transform ) ? 'text-transform:' . $settings->filter_title_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'filter_font_typo',
					'selector'     => ".fl-node-$id .uabb-video-gallery-title-text",
				)
			);
	}
}
	?>
<?php } ?>
/* css for Filterable Tabs*/

<?php if ( ! $version_bb_check ) { ?>
	<?php if ( isset( $settings->cat_filter_align ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters {
			text-align:<?php echo $settings->cat_filter_align; ?>;
		}
	<?php } ?>
	<?php
} else {
	if ( isset( $settings->cat_filter_align_param ) ) {
		?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters {
				text-align:<?php echo $settings->cat_filter_align_param; ?>;
			}
	<?php } ?>
<?php } ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {
			<?php if ( 'default' !== $settings->cat_font['family'] && 'default' !== $settings->cat_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->cat_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->cat_font_size_unit ) ) {
				echo ( '' !== $settings->cat_font_size_unit ) ? 'font-size:' . $settings->cat_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->cat_line_height_unit ) ) {
				echo ( '' !== $settings->cat_line_height_unit ) ? 'line-height:' . $settings->cat_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->cat_title_letter_spacing ) ) {
				echo ( '' !== $settings->cat_title_letter_spacing ) ? 'letter-spacing:' . $settings->cat_title_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->cat_title_transform ) ) {
				echo ( '' !== $settings->cat_title_transform ) ? 'text-transform:' . $settings->cat_title_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'cat_font_typo',
					'selector'     => ".fl-node-$id  .uabb-video__gallery-filter",
				)
			);
	}
}
	?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {
		<?php
		if ( isset( $settings->cat_filter_padding_top ) && isset( $settings->cat_filter_padding_right ) && isset( $settings->cat_filter_padding_bottom ) && isset( $settings->cat_filter_padding_left ) ) {
			if ( isset( $settings->cat_filter_padding_top ) ) {

				echo ( '' !== $settings->cat_filter_padding_top ) ?
				'padding-top:' . $settings->cat_filter_padding_top . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_padding_right ) ) {
				echo ( '' !== $settings->cat_filter_padding_right ) ? 'padding-right:' . $settings->cat_filter_padding_right . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_padding_bottom ) ) {
				echo ( '' !== $settings->cat_filter_padding_bottom ) ? 'padding-bottom:' . $settings->cat_filter_padding_bottom . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_padding_left ) ) {
				echo ( '' !== $settings->cat_filter_padding_left ) ? 'padding-left:' . $settings->cat_filter_padding_left . 'px;' : '';
			}
		}
		if ( isset( $settings->cat_filter_bet_spacing ) ) {
			echo ( '' !== $settings->cat_filter_bet_spacing ) ? 'margin-left:' . $settings->cat_filter_bet_spacing . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_bet_spacing ) ) {
			echo ( '' !== $settings->cat_filter_bet_spacing ) ? 'margin-right:' . $settings->cat_filter_bet_spacing . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_color ) ) {
			echo ( '' !== $settings->cat_filter_color ) ? 'color:' . $settings->cat_filter_color . ';' : '';
		}
		if ( 'background_color' === $settings->cat_filter_bg_color_border ) {
			if ( isset( $settings->cat_filter_bg_color ) ) {

				echo ( '' !== $settings->cat_filter_bg_color ) ? 'background-color:' . $settings->cat_filter_bg_color . ';' : '';
			}
		}
		?>
	}
<?php if ( isset( $settings->cat_filter_hover_color ) || isset( $settings->cat_filter_bg_color_border ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter:hover,
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter.uabb-filter__current{
		<?php
		if ( isset( $settings->cat_filter_hover_color ) ) {

			echo ( '' !== $settings->cat_filter_hover_color ) ? 'color:' . $settings->cat_filter_hover_color . ';' : '';
		}
		if ( 'background_color' == $settings->cat_filter_bg_color_border ) {

			if ( isset( $settings->cat_filter_bg_hover_color ) ) {
				echo ( '' !== $settings->cat_filter_bg_hover_color ) ? 'background-color:' . $settings->cat_filter_bg_hover_color . ';' : '';
			}
		}
		?>
	}
<?php } ?>
<?php if ( isset( $settings->cat_filter_spacing ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters{
		<?php
		if ( isset( $settings->cat_filter_spacing ) ) {
			echo ( '' !== $settings->cat_filter_spacing ) ? 'margin-bottom :' . $settings->cat_filter_spacing . 'px;' : '';
		}
		?>
	}
<?php } ?>
/* CSS for play icon */
<?php if ( isset( $settings->play_img ) || isset( $settings->play_icon ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__content i,
	.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
		<?php
		if ( isset( $settings->play_icon_size ) ) {
			echo ( '' !== $settings->play_icon_size ) ? 'font-size:' . $settings->play_icon_size . 'px;' : '';
			echo ( '' !== $settings->play_icon_size ) ? 'line-height:' . round( $settings->play_icon_size / $settings->play_icon_size, 2 ) . 'em;' : '';
			echo ( '' !== $settings->play_icon_size ) ? 'height:' . $settings->play_icon_size . 'px;' : '';
			echo ( '' !== $settings->play_icon_size ) ? 'width:' . $settings->play_icon_size . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-video__content img.uael-vg__play-image,
	.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
		<?php
		if ( isset( $settings->play_icon_size ) ) {
			echo ( '' !== $settings->play_icon_size ) ? 'width:' . $settings->play_icon_size . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-vg__play i.uabb-vg__play-icon{
		<?php
		if ( isset( $settings->play_icon_size ) ) {

			echo ( '' !== $settings->play_icon_size ) ? 'line-height:' . round( $settings->play_icon_size / $settings->play_icon_size, 2 ) . 'em;' : '';
			echo ( '' !== $settings->play_icon_size ) ? 'height:' . $settings->play_icon_size . 'px;' : '';
			echo ( '' !== $settings->play_icon_size ) ? 'width:' . $settings->play_icon_size . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-vg__play img.uabb-vg__play-image{
		<?php
		if ( isset( $settings->play_icon_size ) ) {
			echo ( '' !== $settings->play_icon_size ) ? 'width:' . $settings->play_icon_size . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-vg__play{
		<?php
		if ( isset( $settings->play_icon_size ) ) {
			echo ( '' !== $settings->play_icon_size ) ? 'width:' . $settings->play_icon_size . 'px;' : '';
		}
		?>
}
	.fl-node-<?php echo $id; ?> .uabb-video__content i,
	.fl-node-<?php echo $id; ?> .uabb-vg__play i.uabb-vg__play-icon{
		<?php
		if ( isset( $settings->play_icon_color ) ) {
			echo ( '' !== $settings->play_icon_color ) ? 'color:' . $settings->play_icon_color . ';' : '';
		}
		?>
	}
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-item:hover .uabb-vg__play i.uabb-vg__play-icon,
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-item:hover .uabb-video__content i{
		<?php
		if ( isset( $settings->play_icon_hover_color ) ) {
			echo ( '' !== $settings->play_icon_hover_color ) ? 'color:' . $settings->play_icon_hover_color . ';' : '';
		}
		?>
	}
<?php } ?>
/* CSS for Content */
<?php if ( isset( $settings->overlay_background_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-vg__overlay{
		<?php
		if ( isset( $settings->overlay_background_color ) ) {
			echo ( '' !== $settings->overlay_background_color ) ? 'background-color:' . $settings->overlay_background_color . ';' : '';
		}
		?>
	}
<?php } ?>
<?php if ( isset( $settings->overlay_background_hover_color ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__gallery-item:hover .uabb-vg__overlay{
		<?php
		if ( isset( $settings->overlay_background_hover_color ) ) {
			echo ( '' !== $settings->overlay_background_hover_color ) ? 'background-color:' . $settings->overlay_background_hover_color . ';' : '';
		}
		?>
	}
<?php } ?>
<?php if ( 'yes' == $settings->show_caption ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__caption {
		<?php
		if ( isset( $settings->caption_color ) ) {
			echo ( '' !== $settings->caption_color ) ? 'color:' . $settings->caption_color . ';' : '';
		}
		?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-video__caption {
			<?php
			if ( 'default' !== $settings->caption_font['family'] && 'default' !== $settings->caption_font['weight'] ) :
				FLBuilderFonts::font_css( $settings->caption_font );
			endif;
			if ( isset( $settings->caption_font_size_unit ) ) {
				echo ( '' !== $settings->caption_font_size_unit ) ? 'font-size:' . $settings->caption_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->caption_line_height_unit ) ) {
				echo ( '' !== $settings->caption_line_height_unit ) ? 'line-height:' . $settings->caption_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->caption_letter_spacing ) ) {
				echo ( '' !== $settings->caption_letter_spacing ) ? 'letter-spacing:' . $settings->caption_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->caption_transform ) ) {
				echo ( '' !== $settings->caption_transform ) ? 'text-transform:' . $settings->caption_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'caption_font_typo',
					'selector'     => ".fl-node-$id .uabb-video__caption",
				)
			);
	}
}
	?>
<?php } ?>
<?php if ( 'yes' == $settings->show_tag ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__tags {
		<?php
		if ( isset( $settings->tag_color ) ) {
			echo ( '' !== $settings->tag_color ) ? 'color:' . $settings->tag_color . ';' : '';
		}
		?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-video__tags {
			<?php
			if ( 'default' !== $settings->tag_font['family'] && 'default' !== $settings->tag_font['weight'] ) :
				FLBuilderFonts::font_css( $settings->tag_font );
			endif;
			if ( isset( $settings->tag_font_size_unit ) ) {
				echo ( '' !== $settings->tag_font_size_unit ) ? 'font-size:' . $settings->tag_font_size_unit . 'px;' : '';
			}
			if ( isset( $settings->tag_line_height_unit ) ) {
				echo ( '' !== $settings->tag_line_height_unit ) ? 'line-height:' . $settings->tag_line_height_unit . 'em;' : '';
			}
			if ( isset( $settings->tag_letter_spacing ) ) {
				echo ( '' !== $settings->tag_letter_spacing ) ? 'letter-spacing:' . $settings->tag_letter_spacing . 'px;' : '';
			}
			if ( isset( $settings->tag_transform ) ) {
				echo ( '' !== $settings->tag_transform ) ? 'text-transform:' . $settings->tag_transform . ';' : '';
			}
			?>
		}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'tag_font_typo',
					'selector'     => ".fl-node-$id .uabb-video__tags",
				)
			);
	}
}
	?>
<?php } ?>

<?php
if ( 'carousel' === $settings->layout && 'yes' === $settings->enable_arrow ) {
	if ( isset( $settings->arrows_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-prev i,
		.fl-node-<?php echo $id; ?> .slick-slider .slick-next i{
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
		.fl-node-<?php echo $id; ?> .slick-slider .slick-next:before{
			<?php echo ( '' !== $settings->arrows_color ) ? 'color:' . $settings->arrows_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow{
			<?php echo ( '' !== $settings->arrows_color ) ? 'border-color:' . $settings->arrows_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow i{
			<?php echo ( '' !== $settings->arrows_color ) ? 'color:' . $settings->arrows_color . ';' : ''; ?>
		}
		<?php
	}
	if ( isset( $settings->arrows_border_size ) && ( '' !== $settings->arrows_border_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow{
			<?php echo ( '' !== $settings->arrows_border_size ) ? 'border-width:' . $settings->arrows_border_size . 'px;' : ''; ?>
		}
		<?php
	}
	if ( isset( $settings->arrow_border_radius ) && ( '' !== $settings->arrow_border_radius ) ) {
		?>
		.fl-node-<?php echo $id; ?> .slick-slider .slick-arrow{
		<?php echo ( '' !== $settings->arrow_border_radius ) ? 'border-radius:' . $settings->arrow_border_radius . 'px;' : ''; ?>
		}
		<?php
	}
}
?>
<?php

if ( 'carousel' === $settings->layout && 'yes' === $settings->enable_dots ) {

	if ( '' !== $settings->dots_size && isset( $settings->dots_size ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap .slick-dots li button:before {
			<?php echo ( '' !== $settings->dots_size ) ? 'font-size:' . $settings->dots_size . 'px;' : ''; ?>
		}
		<?php
	}

	if ( '' !== $settings->dots_color && isset( $settings->dots_color ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap .slick-dots li button:before {
			<?php echo ( '' !== $settings->dots_color ) ? 'color:' . $settings->dots_color . ';' : ''; ?>
		}
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap ul.slick-dots li.slick-active button:before {
			<?php echo ( '' !== $settings->dots_color ) ? 'color:' . $settings->dots_color . ';' : ''; ?>
			opacity:1;
		}
		<?php
	}

	?>
<?php } ?>

<?php if ( 'border' === $settings->cat_filter_bg_color_border ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		<?php if ( isset( $settings->cat_filter_border ) && isset( $settings->cat_filter_border_type ) && isset( $settings->cat_filter_border_color ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters {
				border-bottom:
				<?php
				echo $settings->cat_filter_border . 'px';
				echo ' ';
				echo $settings->cat_filter_border_type;
				echo ' ';
				echo $settings->cat_filter_border_color;
				?>
				;
			}
		<?php } ?>
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'cat_filter_border_param',
					'selector'     => ".fl-node-$id .uabb-video__gallery-filters",
				)
			);
	}
}
	?>
	<?php if ( ! $version_bb_check ) { ?>
		<?php if ( isset( $settings->cat_filter_border_active ) && isset( $settings->cat_filter_border_active_type ) && isset( $settings->cat_filter_border_color ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter:hover,
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter.uabb-filter__current {

				border-bottom:
				<?php
				echo $settings->cat_filter_border_active . 'px';
				echo ' ';
				echo $settings->cat_filter_border_active_type;
				echo ' ';
				echo $settings->cat_filter_border_color_active;
				?>
				;
			}
		<?php } ?>
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'cat_filter_border_active_param',
					'selector'     => ".fl-node-$id .uabb-video__gallery-filter:hover,.fl-node-$id .uabb-video__gallery-filter.uabb-filter__current",
				)
			);
	}
}
	?>
<?php } ?>

<?php if ( $global_settings->responsive_enabled ) { ?>

	/* CSS for medium Device */

	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

		<?php if ( isset( $settings->column_gap_medium ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {
				<?php
				if ( isset( $settings->column_gap_medium ) ) {
					echo ( '' !== $settings->column_gap_medium ) ? 'padding-right:calc(' . $settings->column_gap_medium / 2 . 'px);' : '';
					echo ( '' !== $settings->column_gap_medium ) ? 'padding-left:calc(' . $settings->column_gap_medium / 2 . 'px);' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap {
				<?php
				if ( isset( $settings->column_gap_medium ) ) {

					echo ( '' !== $settings->column_gap_medium ) ? 'margin-right:calc(-' . $settings->column_gap_medium / 2 . 'px);' : '';
					echo ( '' !== $settings->column_gap_medium ) ? 'margin-left:calc(-' . $settings->column_gap_medium / 2 . 'px);' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-vg__overlay{
				<?php
				if ( isset( $settings->column_gap_medium ) ) {
					echo ( '' !== $settings->column_gap_medium ) ? 'width:calc( 100% - ' . $settings->column_gap_medium . 'px );' : '';
					echo ( '' !== $settings->column_gap_medium ) ? 'left:calc(' . $settings->column_gap_medium / 2 . 'px );' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->row_gap_medium ) ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {
				<?php
				if ( isset( $settings->row_gap_medium ) ) {
					echo ( '' !== $settings->row_gap_medium ) ? 'padding-bottom:' . $settings->row_gap_medium . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo $id; ?> .uabb-vg__overlay {
				<?php
				if ( isset( $settings->row_gap_medium ) ) {
					echo ( '' !== $settings->row_gap_medium ) ? 'height: calc( 100% - ' . $settings->row_gap_medium . 'px );' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video-gallery-title-text {

				<?php
				if ( isset( $settings->filter_title_font_size_unit_medium ) ) {
					echo ( '' !== $settings->filter_title_font_size_unit_medium ) ? 'font-size:' . $settings->filter_title_font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->filter_title_line_height_unit_medium ) ) {
					echo ( '' !== $settings->filter_title_line_height_unit_medium ) ? 'line-height:' . $settings->filter_title_line_height_unit_medium . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {
				<?php
				if ( isset( $settings->cat_font_size_unit_medium ) ) {
					echo ( '' !== $settings->cat_font_size_unit_medium ) ? 'font-size:' . $settings->cat_font_size_unit_medium . 'px;' : '';
				}
				if ( isset( $settings->cat_line_height_unit_medium ) ) {
					echo ( '' !== $settings->cat_line_height_unit_medium ) ? 'line-height:' . $settings->cat_line_height_unit_medium . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {
			<?php
			if ( isset( $settings->cat_filter_padding_top_medium ) && isset( $settings->cat_filter_padding_right_medium ) && isset( $settings->cat_filter_padding_bottom_medium ) && isset( $settings->cat_filter_padding_left_medium ) ) {
				if ( isset( $settings->cat_filter_padding_top_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_top_medium ) ?
						'padding-top:' . $settings->cat_filter_padding_top_medium . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_right_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_right_medium ) ? 'padding-right:' . $settings->cat_filter_padding_right_medium . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_bottom_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_bottom_medium ) ? 'padding-bottom:' . $settings->cat_filter_padding_bottom_medium . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_left_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_left_medium ) ? 'padding-left:' . $settings->cat_filter_padding_left_medium . 'px;' : '';
				}
			}
			if ( isset( $settings->cat_filter_bet_spacing_medium ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_medium ) ? 'margin-left:' . $settings->cat_filter_bet_spacing_medium . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_bet_spacing_medium ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_medium ) ? 'margin-right:' . $settings->cat_filter_bet_spacing_medium . 'px;' : '';
			}
			?>
		}
		<?php if ( 'yes' == $settings->show_caption ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__caption {

					<?php
					if ( isset( $settings->caption_font_size_unit_medium ) ) {
						echo ( '' !== $settings->caption_font_size_unit_medium ) ? 'font-size:' . $settings->caption_font_size_unit_medium . 'px;' : '';
					}
					if ( isset( $settings->caption_line_height_unit_medium ) ) {
						echo ( '' !== $settings->caption_line_height_unit_medium ) ? 'line-height:' . $settings->caption_line_height_unit_medium . 'em;' : '';
					}
					?>
				}
		<?php } ?>
		<?php } ?>
		<?php if ( 'yes' === $settings->show_tag ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__tags {
					<?php
					if ( isset( $settings->tag_font_size_unit_medium ) ) {
						echo ( '' !== $settings->tag_font_size_unit_medium ) ? 'font-size:' . $settings->tag_font_size_unit_medium . 'px;' : '';
					}
					if ( isset( $settings->tag_line_height_unit_medium ) ) {
						echo ( '' !== $settings->tag_line_height_unit_medium ) ? 'line-height:' . $settings->tag_line_height_unit_medium . 'em;' : '';
					}
					?>
				}
			<?php } ?>
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			<?php if ( isset( $settings->cat_filter_spacing_medium ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters{
					<?php
					if ( isset( $settings->cat_filter_spacing_medium ) ) {
						echo ( '' !== $settings->cat_filter_spacing_medium ) ? 'margin-bottom :' . $settings->cat_filter_spacing_medium . 'px;' : '';
					}
					?>
				}
			<?php } ?>
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-video__content i,
		.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
		<?php
		if ( isset( $settings->play_icon_size_medium ) ) {
			echo ( '' !== $settings->play_icon_size_medium ) ? 'font-size:' . $settings->play_icon_size_medium . 'px;' : '';
			echo ( '' !== $settings->play_icon_size_medium ) ? 'line-height:' . round( $settings->play_icon_size_medium / $settings->play_icon_size_medium, 2 ) . 'em;' : '';
			echo ( '' !== $settings->play_icon_size_medium ) ? 'height:' . $settings->play_icon_size_medium . 'px;' : '';
			echo ( '' !== $settings->play_icon_size_medium ) ? 'width:' . $settings->play_icon_size_medium . 'px;' : '';
		}
		?>
		}
		.fl-node-<?php echo $id; ?> .uabb-video__content img.uael-vg__play-image,
		.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
		<?php
		if ( isset( $settings->play_icon_size_medium ) ) {
			echo ( '' !== $settings->play_icon_size_medium ) ? 'width:' . $settings->play_icon_size_medium . 'px;' : '';
		}
		?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play i.uabb-vg__play-icon{
			<?php
			if ( isset( $settings->play_icon_size_medium ) ) {

				echo ( '' !== $settings->play_icon_size_medium ) ? 'line-height:' . round( $settings->play_icon_size_medium / $settings->play_icon_size_medium, 2 ) . 'em;' : '';
				echo ( '' !== $settings->play_icon_size_medium ) ? 'height:' . $settings->play_icon_size_medium . 'px;' : '';
				echo ( '' !== $settings->play_icon_size_medium ) ? 'width:' . $settings->play_icon_size_medium . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play img.uabb-vg__play-image{
			<?php
			if ( isset( $settings->play_icon_size_medium ) ) {
				echo ( '' !== $settings->play_icon_size_medium ) ? 'width:' . $settings->play_icon_size_medium . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play{
			<?php
			if ( isset( $settings->play_icon_size_medium ) ) {
				echo ( '' !== $settings->play_icon_size_medium ) ? 'width:' . $settings->play_icon_size_medium . 'px;' : '';
			}
			?>
		}
		<?php if ( 'grid' === $settings->layout ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-1 .uabb-video__gallery-item:nth-child(n+1),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-2 .uabb-video__gallery-item:nth-child(2n+1),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-3 .uabb-video__gallery-item:nth-child(3n+1),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-4 .uabb-video__gallery-item:nth-child(4n+1),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-5 .uabb-video__gallery-item:nth-child(5n+1),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-6 .uabb-video__gallery-item:nth-child(6n+1) {
				clear: left;
		}

		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-1 .uabb-video__gallery-item:nth-child(n),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-2 .uabb-video__gallery-item:nth-child(2n),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-3 .uabb-video__gallery-item:nth-child(3n),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-4 .uabb-video__gallery-item:nth-child(4n),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-5 .uabb-video__gallery-item:nth-child(5n),
		.fl-node-<?php echo $id; ?> .uabb-video-gallery-tablet__column-6 .uabb-video__gallery-item:nth-child(6n) {
			clear: right;
		}
<?php } ?>

	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		/* CSS for responsive */
		<?php if ( isset( $settings->column_gap_responsive ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {
					<?php
					if ( isset( $settings->column_gap_responsive ) ) {

						echo ( '' !== $settings->column_gap_responsive ) ? 'padding-right:calc(' . $settings->column_gap_responsive / 2 . 'px);' : '';

						echo ( '' !== $settings->column_gap_responsive ) ? 'padding-left: calc(' . $settings->column_gap_responsive / 2 . 'px);' : '';
					}
					?>
				}
				.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap {

					<?php echo ( '' !== $settings->column_gap_responsive ) ? 'margin-left:calc(-' . $settings->column_gap_responsive / 2 . 'px );' : ''; ?>
					<?php echo ( '' !== $settings->column_gap_responsive ) ? 'margin-right:calc(-' . $settings->column_gap_responsive / 2 . 'px );' : ''; ?>
				}
				.fl-node-<?php echo $id; ?> .uabb-vg__overlay {
					<?php
					if ( isset( $settings->column_gap_responsive ) ) {
						echo ( '' !== $settings->column_gap_responsive ) ? 'width:calc( 100% - ' . $settings->column_gap_responsive . 'px );' : '';
						echo ( '' !== $settings->column_gap_responsive ) ? 'left:calc(' . $settings->column_gap_responsive / 2 . 'px );' : '';
					}
					?>
				}
		<?php } ?>
		<?php if ( isset( $settings->row_gap_responsive ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__gallery-item {

					<?php
					if ( isset( $settings->row_gap_responsive ) ) {
						echo ( '' !== $settings->row_gap_responsive ) ? 'padding-bottom:' . $settings->row_gap_responsive . 'px;' : '';
					}
					?>
				}
				.fl-node-<?php echo $id; ?> .uabb-vg__overlay {
					<?php
					if ( isset( $settings->row_gap_responsive ) ) {
						echo ( '' !== $settings->row_gap_responsive ) ? 'height: calc( 100% - ' . $settings->row_gap_responsive . 'px );' : '';
					}
					?>
				}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video-gallery-title-text {

				<?php
				if ( isset( $settings->filter_title_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->filter_title_font_size_unit_responsive ) ? 'font-size:' . $settings->filter_title_font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->filter_title_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->filter_title_line_height_unit_responsive ) ? 'line-height:' . $settings->filter_title_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {
				<?php
				if ( isset( $settings->cat_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->cat_font_size_unit_responsive ) ? 'font-size:' . $settings->cat_font_size_unit_responsive . 'px;' : '';
				}
				if ( isset( $settings->cat_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->cat_line_height_unit_responsive ) ? 'line-height:' . $settings->cat_line_height_unit_responsive . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-video__gallery-filter {

			<?php

			if ( isset( $settings->cat_filter_padding_top_responsive ) && isset( $settings->cat_filter_padding_right_responsive ) && isset( $settings->cat_filter_padding_bottom_responsive ) && isset( $settings->cat_filter_padding_left_responsive ) ) {
				if ( isset( $settings->cat_filter_padding_top_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_top_responsive ) ?
						'padding-top:' . $settings->cat_filter_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_right_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_right_responsive ) ? 'padding-right:' . $settings->cat_filter_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->cat_filter_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_left_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_left_responsive ) ? 'padding-left:' . $settings->cat_filter_padding_left_responsive . 'px;' : '';
				}
			}
			if ( isset( $settings->cat_filter_bet_spacing_responsive ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_responsive ) ? 'margin-left:' . $settings->cat_filter_bet_spacing_responsive . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_bet_spacing_responsive ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_responsive ) ? 'margin-right:' . $settings->cat_filter_bet_spacing_responsive . 'px;' : '';
			}

			?>
		}
		<?php if ( 'yes' === $settings->show_caption ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__caption {

					<?php
					if ( isset( $settings->caption_font_size_unit_responsive ) ) {
						echo ( '' !== $settings->caption_font_size_unit_responsive ) ? 'font-size:' . $settings->caption_font_size_unit_responsive . 'px;' : '';
					}
					if ( isset( $settings->caption_line_height_unit_responsive ) ) {
						echo ( '' !== $settings->caption_line_height_unit_responsive ) ? 'line-height:' . $settings->caption_line_height_unit_responsive . 'em;' : '';
					}
					?>
				}
			<?php } ?>
		<?php } ?>
		<?php if ( 'yes' === $settings->show_tag ) { ?>
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__tags {
					<?php
					if ( isset( $settings->tag_font_size_unit_responsive ) ) {
						echo ( '' !== $settings->tag_font_size_unit_responsive ) ? 'font-size:' . $settings->tag_font_size_unit_responsive . 'px;' : '';
					}
					if ( isset( $settings->tag_line_height_unit_responsive ) ) {
						echo ( '' !== $settings->tag_line_height_unit_responsive ) ? 'line-height:' . $settings->tag_line_height_unit_responsive . 'em;' : '';
					}
					?>
				}
			<?php } ?>
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			<?php if ( isset( $settings->cat_filter_spacing_responsive ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-video__gallery-filters{
					<?php
					if ( isset( $settings->cat_filter_spacing_responsive ) ) {
						echo ( '' !== $settings->cat_filter_spacing_responsive ) ? 'margin-bottom :' . $settings->cat_filter_spacing_responsive . 'px;' : '';
					}
					?>
				}
			<?php } ?>
		<?php } ?>
		.fl-node-<?php echo $id; ?> .uabb-video__content i,
		.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
			<?php
			if ( isset( $settings->play_icon_size_responsive ) ) {
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'font-size:' . $settings->play_icon_size_responsive . 'px;' : '';
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'line-height:' . round( $settings->play_icon_size_responsive / $settings->play_icon_size, 2 ) . 'em;' : '';
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'height:' . $settings->play_icon_size_responsive . 'px;' : '';
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'width:' . $settings->play_icon_size_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-video__content img.uael-vg__play-image,
		.fl-node-<?php echo $id; ?> .uabb-video__content .uabb-vg__play{
			<?php
			if ( isset( $settings->play_icon_size_responsive ) ) {
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'width:' . $settings->play_icon_size_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play i.uabb-vg__play-icon{
			<?php
			if ( isset( $settings->play_icon_size_responsive ) ) {

				echo ( '' !== $settings->play_icon_size_responsive ) ? 'line-height:' . round( $settings->play_icon_size_responsive / $settings->play_icon_size_responsive, 2 ) . 'em;' : '';
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'height:' . $settings->play_icon_size_responsive . 'px;' : '';
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'width:' . $settings->play_icon_size_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play img.uabb-vg__play-image{
			<?php
			if ( isset( $settings->play_icon_size_responsive ) ) {
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'width:' . $settings->play_icon_size_responsive . 'px;' : '';
			}
			?>
		}
		.fl-node-<?php echo $id; ?> .uabb-vg__play{
			<?php
			if ( isset( $settings->play_icon_size_responsive ) ) {
				echo ( '' !== $settings->play_icon_size_responsive ) ? 'width:' . $settings->play_icon_size_responsive . 'px;' : '';
			}
			?>
		}
	}
<?php } ?>
<?php if ( 'carousel' === $settings->layout ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video-gallery-wrap {
		position: relative;
	}
<?php } ?>

<?php
if ( 'default' === $settings->play_source ) {
	if ( isset( $settings->play_icon_color ) ) {
		?>
			.fl-node-<?php echo $id; ?> .uabb-video-gallery-icon-bg {
				<?php echo ( '' != $settings->play_icon_color ) ? 'fill:' . $settings->play_icon_color . ';' : 'fill: rgba(31,31,31,0.81);'; ?>
			}
		<?php
	}
	if ( isset( $settings->play_icon_hover_color ) ) {
		?>
			.fl-node-<?php echo $id; ?> .uabb-video__gallery-item:hover .uabb-video-gallery-icon-bg {
			<?php	echo ( '' != $settings->play_icon_hover_color ) ? 'fill:' . $settings->play_icon_hover_color . ';' : 'fill:#cc181e;'; ?>
			}
		<?php
	}
}
?>
