<?php
/**
 *  Photo Gallery Module front-end CSS php file
 *
 *  @package Photo Gallery Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->overlay_color                 = ( '' === $settings->overlay_color ) ? '000000' : $settings->overlay_color;
$settings->overlay_color                 = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );
$settings->caption_bg_color              = UABB_Helper::uabb_colorpicker( $settings, 'caption_bg_color', true );
$settings->color                         = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->overlay_icon_color            = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_color' );
$settings->filter_title_color            = UABB_Helper::uabb_colorpicker( $settings, 'filter_title_color', true );
$settings->cat_filter_color              = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_color', true );
$settings->cat_filter_bg_color           = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_bg_color', true );
$settings->cat_filter_hover_color        = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_hover_color', true );
$settings->cat_filter_bg_hover_color     = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_bg_hover_color', true );
$settings->cat_filter_border_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'cat_filter_border_hover_color', true );
$settings->photo_spacing                 = ( '' !== $settings->photo_spacing ) ? $settings->photo_spacing : '20';
$settings->caption_bg_color              = ( '' !== $settings->caption_bg_color ) ? $settings->caption_bg_color : '#f7f7f7';
$settings->load_more_bg_color            = UABB_Helper::uabb_colorpicker( $settings, 'load_more_bg_color', true );
$settings->load_more_text_color          = UABB_Helper::uabb_colorpicker( $settings, 'load_more_text_color', true );
$settings->load_more_text_hover_color    = UABB_Helper::uabb_colorpicker( $settings, 'load_more_text_hover_color', true );
$settings->load_more_bg_hover_color      = UABB_Helper::uabb_colorpicker( $settings, 'load_more_bg_hover_color', true );
$settings->border_hover_color            = UABB_Helper::uabb_colorpicker( $settings, 'border_hover_color', true );
$settings->img_shadow_color              = UABB_Helper::uabb_colorpicker( $settings, 'img_shadow_color', true );
$settings->img_shadow_color_hover        = UABB_Helper::uabb_colorpicker( $settings, 'img_shadow_color_hover', true );
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-content {
	margin: -<?php echo esc_attr( $settings->photo_spacing / 2 ); ?>px;
}

<?php if ( 'grid' === $settings->layout ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item {
		width: <?php echo esc_attr( 100 / $settings->grid_column ); ?>%;
		padding: <?php echo esc_attr( $settings->photo_spacing / 2 ); ?>px;
	}
	<?php if ( $settings->grid_column > 1 ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+1){
		clear: left;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+0){
		clear: right;
	}
	<?php } ?>
<?php } elseif ( 'masonary' === $settings->layout ) { ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-grid-sizer {
	width: <?php echo esc_attr( 100 / $settings->grid_column ); ?>%;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-item {
	width: <?php echo esc_attr( 100 / $settings->grid_column ); ?>%;
	padding: <?php echo esc_attr( $settings->photo_spacing / 2 ); ?>px;
}
<?php } ?>

<?php if ( 'lightbox' === $settings->click_action && ! empty( $settings->show_captions ) ) : ?>
.mfp-gallery img.mfp-img {
	padding: 40px 0;
}	

.mfp-counter {
	display: block !important;
}
<?php endif; ?>

<?php if ( 'none' !== $settings->hover_effects ) : ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask {
	background: <?php echo ( '' !== $settings->overlay_color ) ? esc_attr( $settings->overlay_color ) : 'rgba(0,0,0,.5)'; ?>;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask .uabb-overlay-icon i {
	color: <?php echo esc_attr( $settings->overlay_icon_color ); ?>;
	font-size: <?php echo ( $settings->overlay_icon_size ) ? esc_attr( $settings->overlay_icon_size ) : '16'; ?>px;
}
<?php endif; ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-caption {
	background-color: <?php echo esc_attr( $settings->caption_bg_color ); ?>;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-caption,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask .uabb-caption  {
	<?php if ( '' !== $settings->color ) : ?>
		color: <?php echo esc_attr( $settings->color ); ?>;
	<?php endif; ?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-caption,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask .uabb-caption  {
		<?php if ( 'Default' !== $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' === $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' !== $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size['desktop'] ); ?>px;
			<?php } ?>  

		<?php if ( isset( $settings->font_size['desktop'] ) && '' === $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] && '' === $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' === $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>
		<?php if ( 'none' !== $settings->transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'caption_font_typo',
				'selector'     => ".fl-node-$id .uabb-photo-gallery-caption,.fl-node-$id .uabb-background-mask .uabb-caption",
			)
		);
	}
}
?>

<?php if ( isset( $settings->pagination ) && 'none' !== $settings->pagination && 'no' === $settings->filterable_gallery_enable ) { ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-gallery-pagination {
	<?php if ( isset( $settings->load_more_align ) ) { ?>
		text-align: <?php echo esc_attr( $settings->load_more_align ); ?>;
	<?php } ?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-gallery-pagination.pagination-scroll {
	display: none;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-gallery-pagination .uabb-gallery-load-more {
	<?php if ( isset( $settings->load_more_bg_color ) && '' !== $settings->load_more_bg_color ) { ?>
		background-color: <?php echo esc_attr( $settings->load_more_bg_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_text_color ) && '' !== $settings->load_more_text_color ) { ?>
		color: <?php echo esc_attr( $settings->load_more_text_color ); ?>;
	<?php } ?>
}
	<?php
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Load More - Border.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'load_more_border',
				'selector'     => ".fl-node-$id .uabb-gallery-pagination .uabb-gallery-load-more",
			)
		);

		// Load More - Margin Top.
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'load_more_margin_top',
				'selector'     => ".fl-node-$id .uabb-gallery-pagination .uabb-gallery-load-more",
				'prop'         => 'margin-top',
				'unit'         => 'px',
			)
		);

		// Load More - Padding.
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'load_more_padding',
				'selector'     => ".fl-node-$id .uabb-gallery-pagination .uabb-gallery-load-more",
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'load_more_padding_top',
					'padding-right'  => 'load_more_padding_right',
					'padding-bottom' => 'load_more_padding_bottom',
					'padding-left'   => 'load_more_padding_left',
				),
			)
		);

		// Load More - Typography.
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'load_more_typo',
				'selector'     => ".fl-node-$id .uabb-gallery-pagination .uabb-gallery-load-more",
			)
		);
	}
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-gallery-pagination .uabb-gallery-load-more:hover {
	<?php if ( isset( $settings->load_more_bg_hover_color ) && ! empty( $settings->load_more_bg_hover_color ) ) { ?>
		background-color: <?php echo esc_attr( $settings->load_more_bg_hover_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_text_hover_color ) && ! empty( $settings->load_more_text_hover_color ) ) { ?>
		color: <?php echo esc_attr( $settings->load_more_text_hover_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->border_hover_color ) && ! empty( $settings->border_hover_color ) ) { ?>
		border-color: <?php echo esc_attr( $settings->border_hover_color ); ?>;
	<?php } ?>
}
<?php } ?>

<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-caption,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask .uabb-caption  {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' === $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' !== $settings->font_size['medium'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->font_size['medium'] ); ?>px;
				<?php } ?>  

				<?php if ( isset( $settings->font_size['medium'] ) && '' === $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>

		<?php if ( 'grid' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item {
				width: <?php echo esc_attr( 100 / $settings->medium_grid_column ); ?>%;
			}
			<?php if ( $settings->grid_column > 1 ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+1),
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+0) {
				clear: none;
			}
			<?php } ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->medium_grid_column ); ?>n+1){
				clear: left;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->medium_grid_column ); ?>n+0){
				clear: right;
			}
		<?php } elseif ( 'masonary' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-grid-sizer {
				width: <?php echo esc_attr( 100 / $settings->medium_grid_column ); ?>%;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-item {
				width: <?php echo esc_attr( 100 / $settings->medium_grid_column ); ?>%;
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-caption,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-background-mask .uabb-caption  {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
				<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' === $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' !== $settings->font_size['small'] ) { ?> 
					font-size: <?php echo esc_attr( $settings->font_size['small'] ); ?>px;
				<?php } ?>   

				<?php if ( isset( $settings->font_size['small'] ) && '' === $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] && '' === $settings->line_height_unit_responsive && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) { ?> 
					line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( 'grid' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item {
				width: <?php echo esc_attr( 100 / $settings->responsive_grid_column ); ?>%;
			}
			<?php if ( $settings->grid_column > 1 ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+1),
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->grid_column ); ?>n+0)
				<?php if ( $settings->grid_column !== $settings->medium_grid_column ) { ?>
			, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->medium_grid_column ); ?>n+1),
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->medium_grid_column ); ?>n+0) 
			<?php } ?> {
				clear: none;
			}
			<?php } ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->responsive_grid_column ); ?>n+1){
				clear: left;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item:nth-child(<?php echo esc_attr( $settings->responsive_grid_column ); ?>n+0){
				clear: right;
			}
		<?php } elseif ( 'masonary' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-grid-sizer {
				width: <?php echo esc_attr( 100 / $settings->responsive_grid_column ); ?>%;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-item {
				width: <?php echo esc_attr( 100 / $settings->responsive_grid_column ); ?>%;
			}
		<?php } ?>
		}
<?php } ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
	<?php
	if ( isset( $settings->cat_filter_padding_top ) && isset( $settings->cat_filter_padding_right ) && isset( $settings->cat_filter_padding_bottom ) && isset( $settings->cat_filter_padding_left ) ) {
		if ( isset( $settings->cat_filter_padding_top ) ) {

			echo ( '' !== $settings->cat_filter_padding_top ) ?
			'padding-top:' . esc_attr( $settings->cat_filter_padding_top ) . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_padding_right ) ) {
			echo ( '' !== $settings->cat_filter_padding_right ) ? 'padding-right:' . esc_attr( $settings->cat_filter_padding_right ) . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_padding_bottom ) ) {
			echo ( '' !== $settings->cat_filter_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->cat_filter_padding_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_padding_left ) ) {
			echo ( '' !== $settings->cat_filter_padding_left ) ? 'padding-left:' . esc_attr( $settings->cat_filter_padding_left ) . 'px;' : '';
		}
	}
	if ( isset( $settings->cat_filter_bet_spacing ) ) {
		echo ( '' !== $settings->cat_filter_bet_spacing ) ? 'margin-left:' . esc_attr( $settings->cat_filter_bet_spacing ) . 'px;' : '';
	}
	if ( isset( $settings->cat_filter_bet_spacing ) ) {
		echo ( '' !== $settings->cat_filter_bet_spacing ) ? 'margin-right:' . esc_attr( $settings->cat_filter_bet_spacing ) . 'px;' : '';
	}
	if ( isset( $settings->cat_filter_color ) ) {
		echo ( '' !== $settings->cat_filter_color ) ? 'color:' . esc_attr( $settings->cat_filter_color ) . ';' : '';
	}
	if ( isset( $settings->cat_filter_bg_color ) ) {

		echo ( '' !== $settings->cat_filter_bg_color ) ? 'background-color:' . esc_attr( $settings->cat_filter_bg_color ) . ';' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filters {
	<?php
	if ( isset( $settings->cat_filter_spacing ) ) {

		echo ( '' !== $settings->cat_filter_spacing ) ? 'margin-bottom:' . esc_attr( $settings->cat_filter_spacing ) . 'px;' : '';
	}
	?>
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter.uabb-filter__current{
	<?php
	if ( isset( $settings->cat_filter_hover_color ) ) {

		echo ( '' !== $settings->cat_filter_hover_color ) ? 'color:' . esc_attr( $settings->cat_filter_hover_color ) . ';' : '';
	}

	if ( isset( $settings->cat_filter_bg_hover_color ) ) {
		echo ( '' !== $settings->cat_filter_bg_hover_color ) ? 'background-color:' . esc_attr( $settings->cat_filter_bg_hover_color ) . ';' : '';
	}
	?>
}
<?php if ( 'yes' === $settings->show_filter_title && '' !== $settings->filters_heading_text ) { ?>
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-title-text {
			<?php if ( 'default' !== $settings->filter_title_font['family'] && 'default' !== $settings->filter_title_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->filter_title_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->filter_title_font_size_unit ) ) {
				echo ( '' !== $settings->filter_title_font_size_unit ) ? 'font-size:' . esc_attr( $settings->filter_title_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->filter_title_line_height_unit ) ) {
				echo ( '' !== $settings->filter_title_line_height_unit ) ? 'line-height:' . esc_attr( $settings->filter_title_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->filter_title_letter_spacing ) ) {
				echo ( '' !== $settings->filter_title_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->filter_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->filter_title_transform ) ) {
				echo ( '' !== $settings->filter_title_transform ) ? 'text-transform:' . esc_attr( $settings->filter_title_transform ) . ';' : '';
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
					'selector'     => ".fl-node-$id .uabb-photo-gallery-title-text",
				)
			);
		}
	}
	?>
<?php } ?>
<?php if ( isset( $settings->filter_title_color ) && '' !== $settings->filter_title_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-title-text {
		color:<?php echo esc_attr( $settings->filter_title_color ); ?>;
	}
<?php } ?>
/* css for Filterable Tabs*/
<?php if ( isset( $settings->cat_filter_align ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filters {
		text-align:<?php echo esc_attr( $settings->cat_filter_align ); ?>;
	}
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
			<?php if ( 'default' !== $settings->cat_font['family'] && 'default' !== $settings->cat_font['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->cat_font ); ?>
			<?php endif; ?>
			<?php
			if ( isset( $settings->cat_font_size_unit ) ) {
				echo ( '' !== $settings->cat_font_size_unit ) ? 'font-size:' . esc_attr( $settings->cat_font_size_unit ) . 'px;' : '';
			}
			if ( isset( $settings->cat_line_height_unit ) ) {
				echo ( '' !== $settings->cat_line_height_unit ) ? 'line-height:' . esc_attr( $settings->cat_line_height_unit ) . 'em;' : '';
			}
			if ( isset( $settings->cat_title_letter_spacing ) ) {
				echo ( '' !== $settings->cat_title_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->cat_title_letter_spacing ) . 'px;' : '';
			}
			if ( isset( $settings->cat_title_transform ) ) {
				echo ( '' !== $settings->cat_title_transform ) ? 'text-transform:' . esc_attr( $settings->cat_title_transform ) . ';' : '';
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
				'selector'     => ".fl-node-$id .uabb-photo__gallery-filter",
			)
		);
	}
}
?>
<?php
if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter{
		<?php
		if ( isset( $settings->cat_filter_border_style ) ) {
			echo ( '' !== $settings->cat_filter_border_style ) ? 'border-style:' . esc_attr( $settings->cat_filter_border_style ) . ';' : '';
		}
		if ( isset( $settings->cat_filter_border_width ) ) {
			echo ( '' !== $settings->cat_filter_border_width ) ? 'border-width:' . esc_attr( $settings->cat_filter_border_width ) . 'px;' : '';
		}
		if ( isset( $settings->cat_filter_border_color ) ) {
			echo ( '' !== $settings->cat_filter_border_color ) ? 'border-color:#' . esc_attr( $settings->cat_filter_border_color ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cat_filter_border',
				'selector'     => ".fl-node-$id .uabb-photo__gallery-filter",
			)
		);
	}
}
if ( isset( $settings->cat_filter_border_hover_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter.uabb-filter__current {
		border-color:<?php echo esc_attr( $settings->cat_filter_border_hover_color ); ?>;
	}
	<?php
}
?>
<?php if ( $global_settings->responsive_enabled ) { ?>
	/* CSS for medium Device */

	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-title-text {

				<?php
				if ( isset( $settings->filter_title_font_size_unit_medium ) ) {
					echo ( '' !== $settings->filter_title_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->filter_title_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->filter_title_line_height_unit_medium ) ) {
					echo ( '' !== $settings->filter_title_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->filter_title_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
				<?php
				if ( isset( $settings->cat_font_size_unit_medium ) ) {
					echo ( '' !== $settings->cat_font_size_unit_medium ) ? 'font-size:' . esc_attr( $settings->cat_font_size_unit_medium ) . 'px;' : '';
				}
				if ( isset( $settings->cat_line_height_unit_medium ) ) {
					echo ( '' !== $settings->cat_line_height_unit_medium ) ? 'line-height:' . esc_attr( $settings->cat_line_height_unit_medium ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
			<?php
			if ( isset( $settings->cat_filter_padding_top_medium ) && isset( $settings->cat_filter_padding_right_medium ) && isset( $settings->cat_filter_padding_bottom_medium ) && isset( $settings->cat_filter_padding_left_medium ) ) {
				if ( isset( $settings->cat_filter_padding_top_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_top_medium ) ?
						'padding-top:' . esc_attr( $settings->cat_filter_padding_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_right_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->cat_filter_padding_right_medium ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_bottom_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->cat_filter_padding_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_left_medium ) ) {
					echo ( '' !== $settings->cat_filter_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->cat_filter_padding_left_medium ) . 'px;' : '';
				}
			}
			if ( isset( $settings->cat_filter_bet_spacing_medium ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_medium ) ? 'margin-left:' . esc_attr( $settings->cat_filter_bet_spacing_medium ) . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_bet_spacing_medium ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_medium ) ? 'margin-right:' . esc_attr( $settings->cat_filter_bet_spacing_medium ) . 'px;' : '';
			}
			?>
		}
		<?php if ( isset( $settings->cat_filter_spacing_medium ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filters {
				<?php
				if ( isset( $settings->cat_filter_spacing_medium ) ) {
					echo ( '' !== $settings->cat_filter_spacing_medium ) ? 'margin-bottom :' . esc_attr( $settings->cat_filter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'grid' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item {
				padding: <?php echo intval( $settings->photo_spacing_medium ) / 2; ?>px;
			}
		<?php } elseif ( 'masonary' === $settings->layout ) { ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-item {
			padding: <?php echo intval( $settings->photo_spacing_medium ) / 2; ?>px;
		}
		<?php } ?>
	}
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-title-text {

				<?php
				if ( isset( $settings->filter_title_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->filter_title_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->filter_title_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->filter_title_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->filter_title_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->filter_title_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
				<?php
				if ( isset( $settings->cat_font_size_unit_responsive ) ) {
					echo ( '' !== $settings->cat_font_size_unit_responsive ) ? 'font-size:' . esc_attr( $settings->cat_font_size_unit_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->cat_line_height_unit_responsive ) ) {
					echo ( '' !== $settings->cat_line_height_unit_responsive ) ? 'line-height:' . esc_attr( $settings->cat_line_height_unit_responsive ) . 'em;' : '';
				}
				?>
			}
		<?php } ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filter {
			<?php
			if ( isset( $settings->cat_filter_padding_top_responsive ) && isset( $settings->cat_filter_padding_right_responsive ) && isset( $settings->cat_filter_padding_bottom_responsive ) && isset( $settings->cat_filter_padding_left_responsive ) ) {
				if ( isset( $settings->cat_filter_padding_top_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_top_responsive ) ?
						'padding-top:' . esc_attr( $settings->cat_filter_padding_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_right_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->cat_filter_padding_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->cat_filter_padding_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->cat_filter_padding_left_responsive ) ) {
					echo ( '' !== $settings->cat_filter_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->cat_filter_padding_left_responsive ) . 'px;' : '';
				}
			}
			if ( isset( $settings->cat_filter_bet_spacing_responsive ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_responsive ) ? 'margin-left:' . esc_attr( $settings->cat_filter_bet_spacing_responsive ) . 'px;' : '';
			}
			if ( isset( $settings->cat_filter_bet_spacing_responsive ) ) {
				echo ( '' !== $settings->cat_filter_bet_spacing_responsive ) ? 'margin-right:' . esc_attr( $settings->cat_filter_bet_spacing_responsive ) . 'px;' : '';
			}
			?>
		}
		<?php if ( isset( $settings->cat_filter_spacing_responsive ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo__gallery-filters {
				<?php
				if ( isset( $settings->cat_filter_spacing_responsive ) ) {
					echo ( '' !== $settings->cat_filter_spacing_responsive ) ? 'margin-bottom :' . esc_attr( $settings->cat_filter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( 'grid' === $settings->layout ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-item {
				padding: <?php echo intval( $settings->photo_spacing_responsive ) / 2; ?>px;
			}
		<?php } elseif ( 'masonary' === $settings->layout ) { ?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-masonary-item {
			padding: <?php echo intval( $settings->photo_spacing_responsive ) / 2; ?>px;
		}
		<?php } ?>
	}
	<?php
}

// Image Box Shadow CSS.
if ( 'yes' === $settings->img_drop_shadow ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-content {
		-webkit-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->img_shadow_color ); ?>;
		-moz-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->img_shadow_color ); ?>;
		-o-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->img_shadow_color ); ?>;
		box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr ); ?>px <?php echo esc_attr( $settings->img_shadow_color ); ?>;
		<?php if ( isset( $settings->img_shadow_hover_transition ) && 'yes' === $settings->img_hover_shadow ) { ?>
			-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			-moz-transition: -moz-box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			transition: box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			will-change: box-shadow;
		<?php } ?>
		}
<?php } ?>

<?php if ( 'yes' === $settings->img_hover_shadow ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-photo-gallery-content:hover {
		-webkit-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_hover ); ?>;
		-moz-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_hover ); ?>;
		-o-box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_hover ); ?>;
		box-shadow: <?php echo esc_attr( $settings->img_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_spr_hover ); ?>px <?php echo esc_attr( $settings->img_shadow_color_hover ); ?>;
		<?php if ( isset( $settings->img_shadow_hover_transition ) && 'yes' === $settings->img_hover_shadow ) { ?>
			-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			-moz-transition: -moz-box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			transition: box-shadow <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $settings->img_shadow_hover_transition ); ?>ms ease-in-out;
			will-change: box-shadow;
		<?php } ?>
	}
<?php } ?>
