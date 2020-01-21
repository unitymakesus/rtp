<?php
/**
 *  UABB Woo-Categories Module file
 *
 *  @package UABB Woo-Categories Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$new_arrow_color  = ( false === strpos( $settings->arrow_color, 'rgb' ) ) ? '#' . $settings->arrow_color : $settings->arrow_color;

if ( ! isset( $settings->display_cat_desc ) ) {
	$settings->display_cat_desc = 'no';
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
	padding-right: calc( <?php echo $settings->columns_gap; ?>px/2 );
	padding-left: calc( <?php echo $settings->columns_gap; ?>px/2 );

	<?php if ( 'grid' === $settings->layout ) { ?>
		margin-bottom: <?php echo $settings->rows_gap; ?>px;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap {
	text-align: <?php echo $settings->content_alignment; ?>;
	color: <?php echo ( false === strpos( $settings->content_color, 'rgb' ) ) ? '#' . $settings->content_color : $settings->content_color; ?>;
	background: <?php echo ( false === strpos( $settings->content_bg_color, 'rgb' ) ) ? '#' . $settings->content_bg_color : $settings->content_bg_color; ?>;
	<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding' ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .woocommerce-loop-category__title,
.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count {

	color: <?php echo ( false === strpos( $settings->content_color, 'rgb' ) ) ? '#' . $settings->content_color : $settings->content_color; ?>;
}

<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .woocommerce-loop-category__title,
	.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count {

		<?php
		if ( 'Default' !== $settings->content_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->content_font );
		}
		?>

		font-size: <?php echo $settings->content_font_size; ?>px;

		line-height: <?php echo $settings->content_line_height; ?>em;

		<?php if ( '' != $settings->content_transform ) { ?>
			text-transform: <?php echo $settings->content_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->content_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->content_letter_spacing; ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'category_typo',
				'selector'     => ".fl-node-$id .uabb-woo-categories li.product .woocommerce-loop-category__title, .fl-node-$id .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product-category > a:hover .woocommerce-loop-category__title,
.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap .uabb-count {
	color: <?php echo ( false === strpos( $settings->content_hover_color, 'rgb' ) ) ? '#' . $settings->content_hover_color : $settings->content_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product-category > a:hover .uabb-category__title-wrap {
	background: <?php echo ( false === strpos( $settings->content_hover_bg_color, 'rgb' ) ) ? '#' . $settings->content_hover_bg_color : $settings->content_hover_bg_color; ?>;
}

<?php if ( 'yes' === $settings->display_cat_desc ) { ?>
.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-product-cat-desc {
	<?php echo UABB_Helper::uabb_dimention_css( $settings, 'desc_around_spacing', 'padding' ); ?>;
	background: <?php echo ( false === strpos( $settings->desc_bg_color, 'rgb' ) ) ? '#' . $settings->desc_bg_color : $settings->desc_bg_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-term-description {
	text-align: <?php echo $settings->desc_alignment; ?>;
	color: <?php echo ( false === strpos( $settings->desc_color, 'rgb' ) ) ? '#' . $settings->desc_color : $settings->desc_color; ?>;
}

	<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-term-description {

		font-size: <?php echo $settings->desc_font_size; ?>px;

		line-height: <?php echo $settings->desc_line_height; ?>em;

		<?php if ( '' != $settings->desc_transform ) { ?>
			text-transform: <?php echo $settings->desc_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->desc_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->desc_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->desc_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->desc_font );
		}
		?>
	}
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'description_typo',
				'selector'     => ".fl-node-$id .uabb-woo-categories .uabb-term-description",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product-category > a:hover .uabb-term-description {
	color: <?php echo ( false === strpos( $settings->desc_hover_color, 'rgb' ) ) ? '#' . $settings->desc_hover_color : $settings->desc_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product-category > a:hover .uabb-product-cat-desc {
	background: <?php echo ( false === strpos( $settings->desc_hover_bg_color, 'rgb' ) ) ? '#' . $settings->desc_hover_bg_color : $settings->desc_hover_bg_color; ?>;
}
<?php } ?>



<?php if ( 'carousel' === $settings->layout ) { ?>
/* Slider */
.fl-node-<?php echo $id; ?> .uabb-woo-categories-carousel .slick-arrow i {
	<?php
	$color       = uabb_theme_base_color( $new_arrow_color );
	$arrow_color = ( '' != $color ) ? $color : '#fff';
	?>
	color: <?php echo $arrow_color; ?>;
	<?php
	switch ( $settings->arrow_style ) {
		case 'square':
		case 'circle':
			?>
	background: <?php echo ( false === strpos( $settings->arrow_background_color, 'rgb' ) ) ? '#' . $settings->arrow_background_color : $settings->arrow_background_color; ?>;
			<?php
			break;
		case 'square-border':
		case 'circle-border':
			?>
	border: <?php echo $settings->arrow_border_size; ?>px solid;
	border-color: <?php echo ( false === strpos( $settings->arrow_color_border, 'rgb' ) ) ? '#' . $settings->arrow_color_border : $settings->arrow_color_border; ?>;
			<?php
			break;
	}
	?>
}
<?php } ?>


<?php /* Global Setting If started */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?> 

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

			.uabb-woo-categories .uabb-woo-cat__column-tablet-1 li.product {
				width: 100%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-tablet-2 li.product {
				width: 50%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-tablet-3 li.product {
				width: 33.33%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-tablet-4 li.product {
				width: 25%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-tablet-5 li.product {
				width: 20%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-tablet-6 li.product {
				width: 16.66%;
			}

			.uabb-woo-categories .uabb-woo-cat__column-tablet-1 li.product:nth-child(n+1),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-2 li.product:nth-child(2n+1),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-3 li.product:nth-child(3n+1),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-4 li.product:nth-child(4n+1),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-5 li.product:nth-child(5n+1),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-6 li.product:nth-child(6n+1) {
				clear: left;
			}

			.uabb-woo-categories .uabb-woo-cat__column-tablet-1 li.product:nth-child(n),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-2 li.product:nth-child(2n),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-3 li.product:nth-child(3n),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-4 li.product:nth-child(4n),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-5 li.product:nth-child(5n),
			.uabb-woo-categories .uabb-woo-cat__column-tablet-6 li.product:nth-child(6n) {
				clear: right;
			}

			.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
				padding-right: calc( <?php echo $settings->columns_gap_medium; ?>px/2 );
				padding-left: calc( <?php echo $settings->columns_gap_medium; ?>px/2 );
				margin-bottom: <?php echo $settings->rows_gap_medium; ?>px;
			}

			.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding', 'medium' ); ?>;
			}

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .woocommerce-loop-category__title,
				.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count {
					font-size: <?php echo $settings->content_font_size_medium; ?>px;
					line-height: <?php echo $settings->content_line_height_medium; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-term-description {
					font-size: <?php echo $settings->desc_font_size_medium; ?>px;
					line-height: <?php echo $settings->desc_line_height_medium; ?>em;
				}
			<?php } ?>

			<?php if ( 'yes' === $settings->display_cat_desc ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-product-cat-desc {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'desc_around_spacing', 'padding', 'medium' ); ?>;
			}
			<?php } ?>
		}

		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

			.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap {
				text-align: <?php echo $settings->mobile_align; ?>;
			}

			.uabb-woo-categories .uabb-woo-cat__column-mobile-1 li.product {
				width: 100%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-mobile-2 li.product {
				width: 50%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-mobile-3 li.product {
				width: 33.33%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-mobile-4 li.product {
				width: 25%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-mobile-5 li.product {
				width: 20%;
			}
			.uabb-woo-categories .uabb-woo-cat__column-mobile-6 li.product {
				width: 16.66%;
			}

			.uabb-woo-categories .uabb-woo-cat__column-mobile-1 li.product:nth-child(n+1),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-2 li.product:nth-child(2n+1),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-3 li.product:nth-child(3n+1),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-4 li.product:nth-child(4n+1),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-5 li.product:nth-child(5n+1),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-6 li.product:nth-child(6n+1) {
				clear: left;
			}

			.uabb-woo-categories .uabb-woo-cat__column-mobile-1 li.product:nth-child(n),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-2 li.product:nth-child(2n),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-3 li.product:nth-child(3n),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-4 li.product:nth-child(4n),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-5 li.product:nth-child(5n),
			.uabb-woo-categories .uabb-woo-cat__column-mobile-6 li.product:nth-child(6n) {
				clear: right;
			}

			.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
				padding-right: calc( <?php echo $settings->columns_gap_responsive; ?>px/2 );
				padding-left: calc( <?php echo $settings->columns_gap_responsive; ?>px/2 );
				margin-bottom: <?php echo $settings->rows_gap_responsive; ?>px;
			}

			.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding', 'responsive' ); ?>;
			}

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .woocommerce-loop-category__title,
				.fl-node-<?php echo $id; ?> .uabb-woo-categories li.product .uabb-category__title-wrap .uabb-count {
					font-size: <?php echo $settings->content_font_size_responsive; ?>px;
					line-height: <?php echo $settings->content_line_height_responsive; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-term-description {
					font-size: <?php echo $settings->desc_font_size_responsive; ?>px;
					line-height: <?php echo $settings->desc_line_height_responsive; ?>em;
				}
			<?php } ?>

			<?php if ( 'yes' === $settings->display_cat_desc ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-woo-categories .uabb-product-cat-desc {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'desc_around_spacing', 'padding', 'responsive' ); ?>;
			}
			<?php } ?>
		}
	<?php
}
