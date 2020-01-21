<?php
/**
 *  UABB Woo Products Module file
 *
 *  @package UABB Woo Products Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();

$pg_bg_hover_color = ( false === strpos( $settings->pg_bg_hover_color, 'rgb' ) ) ? '#' . $settings->pg_bg_hover_color : $settings->pg_bg_hover_color;

$pg_border_hover_color = ( false === strpos( $settings->pg_border_hover_color, 'rgb' ) ) ? '#' . $settings->pg_border_hover_color : $settings->pg_border_hover_color;

$pg_border_color = ( false === strpos( $settings->pg_border_color, 'rgb' ) ) ? '#' . $settings->pg_border_color : $settings->pg_border_color;

$sale_flash_bg_color = ( false === strpos( $settings->sale_flash_bg_color, 'rgb' ) ) ? '#' . $settings->sale_flash_bg_color : $settings->sale_flash_bg_color;

$rating_color = ( false === strpos( $settings->rating_color, 'rgb' ) ) ? '#' . $settings->rating_color : $settings->rating_color;

$add_cart_color = ( false === strpos( $settings->add_cart_color, 'rgb' ) ) ? '#' . $settings->add_cart_color : $settings->add_cart_color;

$add_cart_hover_color = ( false === strpos( $settings->add_cart_hover_color, 'rgb' ) ) ? '#' . $settings->add_cart_hover_color : $settings->add_cart_hover_color;

$add_cart_bg_color = ( false === strpos( $settings->add_cart_bg_color, 'rgb' ) ) ? '#' . $settings->add_cart_bg_color : $settings->add_cart_bg_color;

$add_cart_bg_hover_color = ( false === strpos( $settings->add_cart_bg_hover_color, 'rgb' ) ) ? '#' . $settings->add_cart_bg_hover_color : $settings->add_cart_bg_hover_color;

$new_arrow_color = ( false === strpos( $settings->arrow_color, 'rgb' ) ) ? '#' . $settings->arrow_color : $settings->arrow_color;

?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
	padding-right: calc( <?php echo $settings->columns_gap; ?>px/2 );
	padding-left: calc( <?php echo $settings->columns_gap; ?>px/2 );

	<?php if ( 'grid' === $settings->layout ) { ?>
		margin-bottom: <?php echo $settings->rows_gap; ?>px;
	<?php } ?>
}

/* Pagination */
.fl-node-<?php echo $id; ?> nav.uabb-woocommerce-pagination {
	text-align: <?php echo $settings->pg_alignment; ?>;
}

.fl-node-<?php echo $id; ?> nav.uabb-woocommerce-pagination ul li > .page-numbers {
	color: <?php echo ( false === strpos( $settings->pg_color, 'rgb' ) ) ? '#' . $settings->pg_color : $settings->pg_color; ?>;
	background: <?php echo ( false === strpos( $settings->pg_bg_color, 'rgb' ) ) ? '#' . $settings->pg_bg_color : $settings->pg_bg_color; ?>;
	border-color: <?php echo uabb_theme_base_color( $pg_border_color ); ?>;
}

.fl-node-<?php echo $id; ?> nav.uabb-woocommerce-pagination ul li .page-numbers:focus,
.fl-node-<?php echo $id; ?> nav.uabb-woocommerce-pagination ul li .page-numbers:hover,
.fl-node-<?php echo $id; ?> nav.uabb-woocommerce-pagination ul li span.current {
	color: <?php echo ( false === strpos( $settings->pg_hover_color, 'rgb' ) ) ? '#' . $settings->pg_hover_color : $settings->pg_hover_color; ?>;
	background: <?php echo uabb_theme_base_color( $pg_bg_hover_color ); ?>;
	border-color: <?php echo uabb_theme_base_color( $pg_border_hover_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woo-products-summary-wrap {
	<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding' ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-sale-flash-wrap .uabb-onsale {

	color: <?php echo ( false === strpos( $settings->sale_flash_color, 'rgb' ) ) ? '#' . $settings->sale_flash_color : $settings->sale_flash_color; ?>;

	background: <?php echo uabb_theme_base_color( $sale_flash_bg_color ); ?>;

	min-width: <?php echo $settings->sale_flash_size; ?>em;

	min-height: <?php echo $settings->sale_flash_size; ?>em;

	line-height: <?php echo $settings->sale_flash_size; ?>em;

	<?php
	echo UABB_Helper::uabb_dimention_css( $settings, 'sale_flash_padding', 'padding' );
	echo UABB_Helper::uabb_dimention_css( $settings, 'sale_flash_margin', 'margin' );
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-sale-flash-wrap .uabb-onsale {

		font-size: <?php echo $settings->sale_flash_font_size; ?>px;

		<?php if ( '' != $settings->sale_flash_transform ) { ?>
			text-transform: <?php echo $settings->sale_flash_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->sale_flash_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->sale_flash_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->sale_flash_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->sale_flash_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_sale_font_typo',
				'selector'     => ".fl-node-$id .uabb-sale-flash-wrap .uabb-onsale",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-featured {

	color: <?php echo ( false === strpos( $settings->featured_flash_color, 'rgb' ) ) ? '#' . $settings->featured_flash_color : $settings->featured_flash_color; ?>;

	background: <?php echo ( false === strpos( $settings->featured_flash_bg_color, 'rgb' ) ) ? '#' . $settings->featured_flash_bg_color : $settings->featured_flash_bg_color; ?>;

	min-width: <?php echo $settings->featured_flash_size; ?>em;

	min-height: <?php echo $settings->featured_flash_size; ?>em;

	line-height: <?php echo $settings->featured_flash_size; ?>em;

	<?php
	echo UABB_Helper::uabb_dimention_css( $settings, 'featured_flash_padding', 'padding' );
	echo UABB_Helper::uabb_dimention_css( $settings, 'featured_flash_margin', 'margin' );
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-featured {

		font-size: <?php echo $settings->featured_flash_font_size; ?>px;

		<?php if ( '' != $settings->featured_flash_transform ) { ?>
			text-transform: <?php echo $settings->featured_flash_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->featured_flash_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->featured_flash_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->featured_flash_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->featured_flash_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_flash_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce .uabb-featured",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-product-category {

	color: <?php echo ( false === strpos( $settings->cat_color, 'rgb' ) ) ? '#' . $settings->cat_color : $settings->cat_color; ?>;

	<?php echo ( '' != $settings->cat_margin_bottom ) ? 'margin-bottom: ' . $settings->cat_margin_bottom . 'px;' : ''; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-product-category {

		font-size: <?php echo $settings->cat_font_size; ?>px;

		line-height: <?php echo $settings->cat_line_height; ?>em;

		<?php if ( '' != $settings->cat_transform ) { ?>
			text-transform: <?php echo $settings->cat_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->cat_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->cat_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->cat_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->cat_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_cat_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce .uabb-woo-product-category",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .woocommerce-loop-product__title {

	color: <?php echo ( false === strpos( $settings->title_color, 'rgb' ) ) ? '#' . $settings->title_color : $settings->title_color; ?>;

	<?php echo ( '' != $settings->title_margin_bottom ) ? 'margin-bottom: ' . $settings->title_margin_bottom . 'px;' : ''; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce .woocommerce-loop-product__title {

		font-size: <?php echo $settings->title_font_size; ?>px;

		line-height: <?php echo $settings->title_line_height; ?>em;

		<?php if ( '' != $settings->title_transform ) { ?>
			text-transform: <?php echo $settings->title_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->title_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->title_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->title_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->title_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_title_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce .woocommerce-loop-product__title",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-loop-product__link:hover .woocommerce-loop-product__title {
	color: <?php echo ( false === strpos( $settings->title_color, 'rgb' ) ) ? '#' . $settings->title_color : $settings->title_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woocommerce .star-rating,
.fl-node-<?php echo $id; ?> .uabb-woocommerce .star-rating::before {
	color: <?php echo uabb_theme_base_color( $rating_color ); ?>;
}

.fl-node-<?php echo $id; ?> .uabb-woocommerce .star-rating {
	<?php echo ( '' != $settings->rating_margin_bottom ) ? 'margin-bottom: ' . $settings->rating_margin_bottom . 'px;' : ''; ?>
}

.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product .price {

	color: <?php echo ( false === strpos( $settings->price_color, 'rgb' ) ) ? '#' . $settings->price_color : $settings->price_color; ?>;

	<?php echo ( '' != $settings->price_margin_bottom ) ? 'margin-bottom: ' . $settings->price_margin_bottom . 'px;' : ''; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product .price {

		font-size: <?php echo $settings->price_font_size; ?>px;

		line-height: <?php echo $settings->price_line_height; ?>em;

		<?php if ( '' != $settings->price_transform ) { ?>
			text-transform: <?php echo $settings->price_transform; ?>;
		<?php } ?>

		<?php if ( '' != $settings->price_letter_spacing ) { ?>
			letter-spacing: <?php echo $settings->price_letter_spacing; ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->price_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->price_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_price_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce li.product .price",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-description {

	color: <?php echo ( false === strpos( $settings->desc_color, 'rgb' ) ) ? '#' . $settings->desc_color : $settings->desc_color; ?>;

	<?php echo ( '' != $settings->desc_margin_bottom ) ? 'margin-bottom: ' . $settings->desc_margin_bottom . 'px;' : ''; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-description {

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
				'setting_name' => 'woo_desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce .uabb-woo-products-description",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-summary-wrap .button {

	color: <?php echo uabb_theme_button_text_color( $add_cart_color ); ?>;

	background: <?php echo uabb_theme_button_bg_color( $add_cart_bg_color ); ?>;

	padding-top: <?php echo uabb_theme_button_vertical_padding( $settings->add_cart_padding_top_bottom ); ?>px;
	padding-bottom: <?php echo uabb_theme_button_vertical_padding( $settings->add_cart_padding_top_bottom ); ?>px;
	padding-right: <?php echo uabb_theme_button_horizontal_padding( $settings->add_cart_padding_left_right ); ?>px;
	padding-left: <?php echo uabb_theme_button_horizontal_padding( $settings->add_cart_padding_left_right ); ?>px;

	<?php echo ( '' != $settings->add_cart_margin_bottom ) ? 'margin-bottom: ' . $settings->add_cart_margin_bottom . 'px;' : ''; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-summary-wrap .button {

		font-size: <?php echo uabb_theme_button_font_size( $settings->add_cart_font_size ); ?>px;
		line-height: <?php echo uabb_theme_button_line_height( $settings->add_cart_line_height ); ?>em;
		text-transform: <?php echo uabb_theme_button_text_transform( $settings->add_cart_transform ); ?>;
		letter-spacing: <?php echo uabb_theme_button_letter_spacing( $settings->add_cart_letter_spacing ); ?>px;
		<?php
		if ( 'Default' !== $settings->add_cart_font['family'] ) {
			UABB_Helper::uabb_font_css( $settings->add_cart_font );
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'woo_cart_font_typo',
				'selector'     => ".fl-node-$id .uabb-woocommerce .uabb-woo-products-summary-wrap .button",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-summary-wrap .button:hover {
	color: <?php echo uabb_theme_button_text_hover_color( $add_cart_hover_color ); ?>;
	background: <?php echo uabb_theme_button_bg_hover_color( $add_cart_bg_hover_color ); ?>;
}

/* Slider */
<?php if ( 'carousel' === $settings->layout ) { ?>
.fl-node-<?php echo $id; ?> .uabb-woo-products-carousel .slick-arrow i {
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

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-product-category {
					font-size: <?php echo $settings->cat_font_size_medium; ?>px;
					line-height: <?php echo $settings->cat_line_height_medium; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .woocommerce-loop-product__title {
					font-size: <?php echo $settings->title_font_size_medium; ?>px;
					line-height: <?php echo $settings->title_line_height_medium; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product .price {
					font-size: <?php echo $settings->price_font_size_medium; ?>px;
					line-height: <?php echo $settings->price_line_height_medium; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-description {
					font-size: <?php echo $settings->desc_font_size_medium; ?>px;
					line-height: <?php echo $settings->desc_line_height_medium; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-summary-wrap .button {
					font-size: <?php echo $settings->add_cart_font_size_medium; ?>px;
					line-height: <?php echo $settings->add_cart_line_height_medium; ?>em;
				}
			<?php } ?>

			.uabb-woo-products-grid .uabb-woo-product__column-tablet-1 ul.products li.product {
				width: 100%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-2 ul.products li.product {
				width: 50%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-3 ul.products li.product {
				width: 33.33%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-4 ul.products li.product {
				width: 25%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-5 ul.products li.product {
				width: 20%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-6 ul.products li.product {
				width: 16.66%;
			}

			.uabb-woo-products-grid .uabb-woo-product__column-tablet-1 ul.products li.product:nth-child(n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-2 ul.products li.product:nth-child(2n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-3 ul.products li.product:nth-child(3n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-4 ul.products li.product:nth-child(4n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-5 ul.products li.product:nth-child(5n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-6 ul.products li.product:nth-child(6n+1) {
				clear: left;
			}

			.uabb-woo-products-grid .uabb-woo-product__column-tablet-1 ul.products li.product:nth-child(n),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-2 ul.products li.product:nth-child(2n),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-3 ul.products li.product:nth-child(3n),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-4 ul.products li.product:nth-child(4n),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-5 ul.products li.product:nth-child(5n),
			.uabb-woo-products-grid .uabb-woo-product__column-tablet-6 ul.products li.product:nth-child(6n) {
				clear: right;
			}

			.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
				padding-right: calc( <?php echo $settings->columns_gap_medium; ?>px/2 );
				padding-left: calc( <?php echo $settings->columns_gap_medium; ?>px/2 );
				margin-bottom: <?php echo $settings->rows_gap_medium; ?>px;
			}

			.fl-node-<?php echo $id; ?> .uabb-woo-products-summary-wrap {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding', 'medium' ); ?>;
			}
		}

		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-product-category {
					font-size: <?php echo $settings->cat_font_size_responsive; ?>px;
					line-height: <?php echo $settings->cat_line_height_responsive; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .woocommerce-loop-product__title {
					font-size: <?php echo $settings->title_font_size_responsive; ?>px;
					line-height: <?php echo $settings->title_line_height_responsive; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product .price {
					font-size: <?php echo $settings->price_font_size_responsive; ?>px;
					line-height: <?php echo $settings->price_line_height_responsive; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-description {
					font-size: <?php echo $settings->desc_font_size_responsive; ?>px;
					line-height: <?php echo $settings->desc_line_height_responsive; ?>em;
				}

				.fl-node-<?php echo $id; ?> .uabb-woocommerce .uabb-woo-products-summary-wrap .button {
					font-size: <?php echo $settings->add_cart_font_size_responsive; ?>px;
					line-height: <?php echo $settings->add_cart_line_height_responsive; ?>em;
				}
			<?php } ?>

			.uabb-woo-products-grid .uabb-woo-product__column-mobile-1 ul.products li.product {
				width: 100%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-2 ul.products li.product {
				width: 50%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-3 ul.products li.product {
				width: 33.33%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-4 ul.products li.product {
				width: 25%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-5 ul.products li.product {
				width: 20%;
			}
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-6 ul.products li.product {
				width: 16.66%;
			}

			.uabb-woo-products-grid .uabb-woo-product__column-mobile-1 ul.products li.product:nth-child(n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-2 ul.products li.product:nth-child(2n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-3 ul.products li.product:nth-child(3n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-4 ul.products li.product:nth-child(4n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-5 ul.products li.product:nth-child(5n+1),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-6 ul.products li.product:nth-child(6n+1) {
				clear: left;
			}

			.uabb-woo-products-grid .uabb-woo-product__column-mobile-1 ul.products li.product:nth-child(n),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-2 ul.products li.product:nth-child(2n),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-3 ul.products li.product:nth-child(3n),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-4 ul.products li.product:nth-child(4n),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-5 ul.products li.product:nth-child(5n),
			.uabb-woo-products-grid .uabb-woo-product__column-mobile-6 ul.products li.product:nth-child(6n) {
				clear: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-woocommerce li.product {
				padding-right: calc( <?php echo $settings->columns_gap_responsive; ?>px/2 );
				padding-left: calc( <?php echo $settings->columns_gap_responsive; ?>px/2 );
				margin-bottom: <?php echo $settings->rows_gap_responsive; ?>px;
			}

			.fl-node-<?php echo $id; ?> .uabb-woo-products-summary-wrap {
				<?php echo UABB_Helper::uabb_dimention_css( $settings, 'content_around_spacing', 'padding', 'responsive' ); ?>;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-right li.product {
				text-align: right;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-right li.product .star-rating {
				margin-left: auto;
				margin-right: 0;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-left li.product {
				text-align: left;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-left li.product .star-rating {
				margin-left: 0;
				margin-right: auto;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-center li.product {
				text-align: center;
			}

			.uabb-woocommerce .uabb-woo--align-mobile-center li.product .star-rating {
				margin-left: auto;
				margin-right: auto;
			}
		}
	<?php
}
