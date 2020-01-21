<?php
/**
 *  UABB Image Carousel Module front-end CSS php file
 *
 *  @package UABB Image Carousel Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->overlay_color      = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );
$settings->color              = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->caption_bg_color   = UABB_Helper::uabb_colorpicker( $settings, 'caption_bg_color', true );
$settings->overlay_icon_color = UABB_Helper::uabb_colorpicker( $settings, 'overlay_icon_color' );

$settings->photo_spacing    = ( '' != $settings->photo_spacing ) ? $settings->photo_spacing : '20';
$settings->caption_bg_color = ( '' != $settings->caption_bg_color ) ? $settings->caption_bg_color : '#f7f7f7';

$settings->arrow_color            = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color' );
$settings->arrow_background_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_background_color', true );
$settings->arrow_color_border     = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_border' );
?>

.fl-node-<?php echo $id; ?> .uabb-image-carousel {
	margin: -<?php echo $settings->photo_spacing / 2; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-image-carousel-item {
	width: <?php echo 100 / $settings->grid_column; ?>%;
	padding: <?php echo $settings->photo_spacing / 2; ?>px;
}

/* Arrow Style */

.fl-node-<?php echo $id; ?> .slick-prev i,
.fl-node-<?php echo $id; ?> .slick-next i,
.fl-node-<?php echo $id; ?> .slick-prev i:hover,
.fl-node-<?php echo $id; ?> .slick-next i:hover,
.fl-node-<?php echo $id; ?> .slick-prev i:focus,
.fl-node-<?php echo $id; ?> .slick-next i:focus {
	outline: none;
	<?php
	$color               = uabb_theme_base_color( $settings->arrow_color );
			$arrow_color = ( '' != $color ) ? $color : '#fff';
	?>
	color: <?php echo $arrow_color; ?>;
	<?php
	switch ( $settings->arrow_style ) {
		case 'square':
			?>
				background: <?php echo ( '' != $settings->arrow_background_color ) ? $settings->arrow_background_color : '#efefef'; ?>;
			<?php
			break;

		case 'circle':
			?>
				border-radius: 50%;
				background: <?php echo ( '' != $settings->arrow_background_color ) ? $settings->arrow_background_color : '#efefef'; ?>;
			<?php
			break;

		case 'square-border':
			?>
				border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border; ?>;
			<?php
			break;

		case 'circle-border':
			?>
				border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border; ?>;
				border-radius: 50%;
			<?php
			break;
	}
	?>
}

<?php if ( 'inside' == $settings->arrow_position ) { ?>
	.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-prev,
	.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-next {
		left: <?php echo $settings->photo_spacing / 2; ?>px;

	}
	.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-next,
	.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-prev
	{
		right: <?php echo $settings->photo_spacing / 2; ?>px;
		transform: translate(50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:hover,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:focus,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:focus,
	.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:hover {
		width: 28px;
		height: 28px;
		line-height: 28px;
	}
<?php } ?>

<?php if ( 'lightbox' == $settings->click_action && ! empty( $settings->show_captions ) ) : ?>
.mfp-gallery img.mfp-img {
	padding: 40px 0;
}	

.mfp-counter {
	display: block !important;
}
<?php endif; ?>

<?php if ( 'none' != $settings->hover_effects ) : ?>
.fl-node-<?php echo $id; ?> .uabb-background-mask {
	background: <?php echo ( '' != $settings->overlay_color ) ? $settings->overlay_color : 'rgba(0,0,0,.5)'; ?>;
}
.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-overlay-icon i {
	color: <?php echo $settings->overlay_icon_color; ?>;
	font-size: <?php echo ( $settings->overlay_icon_size ) ? $settings->overlay_icon_size : '16'; ?>px;
}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption {
	background-color: <?php echo $settings->caption_bg_color; ?>;
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
	.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>
			font-size: <?php echo $settings->font_size_unit; ?>px;		
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->font_size['desktop'] ) && '' == $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] && '' == $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' != $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height_unit; ?>em;	
		<?php } elseif ( isset( $settings->line_height_unit ) && '' == $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->transform ) : ?>
			text-transform: <?php echo $settings->transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'img_typo',
				'selector'     => ".fl-node-$id .uabb-image-carousel-caption,.fl-node-$id .uabb-background-mask .uabb-caption",
			)
		);
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {
	<?php if ( '' != $settings->color ) : ?>
		color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}
<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
			.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
					font-size: <?php echo $settings->font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->font_size['medium'] ) && '' == $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
							line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->line_height_unit_medium; ?>em;	
				<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
					line-height: <?php echo $settings->line_height['medium']; ?>px;
				<?php } ?>
			}
		<?php } ?>
	}
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

		.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-prev,
		.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-next {
			left: <?php echo $settings->photo_spacing / 2; ?>px;
		}
		.fl-node-<?php echo $id; ?> div.uabb-image-carousel .slick-next,
		.fl-node-<?php echo $id; ?> [dir='rtl'] div.uabb-image-carousel .slick-prev
		{
			right: <?php echo $settings->photo_spacing / 2; ?>px;
			transform: translate(50%, -50%);
		}
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:hover,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-prev i:focus,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:focus,
		.fl-node-<?php echo $id; ?> .uabb-image-carousel .slick-next i:hover {
			width: 20px;
			height: 20px;
			line-height: 20px;
			font-size: 15px;
		}
		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-image-carousel-caption,
			.fl-node-<?php echo $id; ?> .uabb-background-mask .uabb-caption  {

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->font_size_unit_responsive; ?>px;	
				<?php } elseif ( $settings->font_size_unit_responsive && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
					font-size: <?php echo $settings->font_size['small']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->font_size['small'] ) && '' == $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
							line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
					line-height: <?php echo $settings->line_height['small']; ?>px;
				<?php } ?>
			}
		<?php } ?>
	}
<?php } ?>
