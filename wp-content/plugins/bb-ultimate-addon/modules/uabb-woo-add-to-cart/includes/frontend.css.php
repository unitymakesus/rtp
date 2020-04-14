<?php
/**
 *  UABB Woo Add To Cart Module file
 *
 *  @package UABB Woo Add To Cart Module
 */

$version_bb_check   = UABB_Compatibility::$version_bb_check;
$border_hover_color = '';
$text_hover_color   = '';
$border_size        = '';
$bg_hover_color     = '';

$get_bg_color = ( false === strpos( $settings->bg_color, 'rgb' ) ) ? '#' . $settings->bg_color : $settings->bg_color;

$bg_color = uabb_theme_button_bg_color( $get_bg_color );

if ( 'transparent' === $settings->style ) {
	$border_size = ( '' !== trim( $settings->border_size ) ) ? $settings->border_size : '2';
} else {
	$border_size = 1;
}

// Border Color.
$border_color = ( false === strpos( $settings->bg_color, 'rgb' ) ) ? '#' . $settings->bg_color : $settings->bg_color;

$theme_border_color = uabb_theme_button_bg_color( $border_color );

if ( ! empty( $settings->bg_hover_color ) ) {
	$border_hover_color = ( false === strpos( $settings->bg_hover_color, 'rgb' ) ) ? '#' . $settings->bg_hover_color : $settings->bg_hover_color;

	$bg_hover_color = ( false === strpos( $settings->bg_hover_color, 'rgb' ) ) ? '#' . $settings->bg_hover_color : $settings->bg_hover_color;
} else {
	$border_hover_color = $bg_color;
	if ( 'default' !== $settings->style ) {
		$bg_hover_color = $bg_color;
	}
}

if ( ! empty( $settings->text_hover_color ) ) {
	$text_hover_color = ( false === strpos( $settings->text_hover_color, 'rgb' ) ) ? '#' . $settings->text_hover_color : $settings->text_hover_color;
} else {
	if ( 'default' !== $settings->style ) {
		$text_hover_color = '#ffffff';
	}
}

?>

<?php if ( 'left' === $settings->btn_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
		margin-left: 0;
		margin-right: auto;
	}
<?php } elseif ( 'right' === $settings->btn_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
		margin-left: auto;
		margin-right: 0;
	}
<?php } elseif ( 'center' === $settings->btn_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
		margin-left: auto;
		margin-right: auto;
	}
<?php } elseif ( 'justify' === $settings->btn_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
		width: 100%;
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
	<?php
	$is_padding_empty = UABB_Helper::uabb_dimention_css( $settings, 'btn_padding', 'padding' );

	if ( ! empty( $is_padding_empty ) ) {
		echo esc_attr( $is_padding_empty );
	} else {
		if ( 'default' === $settings->style ) {
			echo esc_attr( uabb_theme_padding_css_genreated( 'desktop' ) );
		}
	}

	?>

	color: <?php echo esc_attr( ( false === strpos( $settings->text_color, 'rgb' ) ) ? '#' . $settings->text_color : $settings->text_color ); ?>;

	background: <?php echo esc_attr( $bg_color ); ?>;

	border-radius: <?php echo esc_attr( $settings->border_radius ); ?>px;

	<?php if ( 'transparent' === $settings->style ) : ?>
		border: <?php echo esc_attr( $border_size ); ?>px solid;
		border-color: <?php echo esc_attr( $theme_border_color ); ?>;
		background: none;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {

		font-size: <?php echo esc_attr( $settings->font_size ); ?>px;

		line-height: <?php echo esc_attr( $settings->line_height ); ?>em;

		<?php if ( '' !== $settings->transform ) { ?>
			text-transform: <?php echo esc_attr( $settings->transform ); ?>;
		<?php } ?>

		<?php if ( '' !== $settings->letter_spacing ) { ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php } ?>

		<?php
		if ( 'Default' !== $settings->font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->font_family );
		}
		?>
	}
	<?php
} else {
	if ( 'default' === $settings->style ) {

		$button_font_typo = uabb_theme_button_typography( $settings->button_font_typo );

		$settings->button_font_typo            = ( array_key_exists( 'desktop', $button_font_typo ) ) ? $button_font_typo['desktop'] : $settings->button_font_typo;
		$settings->button_font_typo_medium     = ( array_key_exists( 'tablet', $button_font_typo ) ) ? $button_font_typo['tablet'] : $settings->button_font_typo_medium;
		$settings->button_font_typo_responsive = ( array_key_exists( 'mobile', $button_font_typo ) ) ? $button_font_typo['mobile'] : $settings->button_font_typo_responsive;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_font_typo',
				'selector'     => ".fl-node-$id .uabb-woo-add-to-cart .button",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button:hover {
	color: <?php echo esc_attr( $text_hover_color ); ?>;
	background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;

	<?php if ( 'transparent' === $settings->style ) : ?>
		border: <?php echo esc_attr( $border_size ); ?>px solid <?php echo esc_attr( $border_hover_color ); ?>;
	<?php endif; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .uabb-atc-align-icon-before {
	margin-right: <?php echo esc_attr( $settings->btn_icon_spacing ); ?>px;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .uabb-atc-align-icon-after {
	margin-left: <?php echo esc_attr( $settings->btn_icon_spacing ); ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .added_to_cart {
	color: <?php echo esc_attr( ( false === strpos( $settings->view_cart_color, 'rgb' ) ) ? '#' . $settings->view_cart_color : $settings->view_cart_color ); ?>;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .added_to_cart:hover {
	color: <?php echo esc_attr( ( false === strpos( $settings->view_cart_hover_color, 'rgb' ) ) ? '#' . $settings->view_cart_hover_color : $settings->view_cart_hover_color ); ?>;
}

<?php /* Transparent New Style CSS*/ ?>
<?php
if ( 'transparent' === $settings->style ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover{
	<?php
	if ( 'none' === $settings->transparent_button_options ) {
		?>
			background:<?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-none-btn:hover .uabb-atc-icon-align {
		<?php if ( '' !== $settings->text_hover_color && 'FFFFFF' !== $settings->text_hover_color ) { ?>
			color: <?php echo esc_attr( ( false === strpos( $settings->text_hover_color, 'rgb' ) ) ? '#' . $settings->text_hover_color : $settings->text_hover_color ); ?>
		<?php } else { ?>
			color: <?php echo esc_attr( ( false === strpos( $settings->text_color, 'rgb' ) ) ? '#' . $settings->text_color : $settings->text_color ); ?>;
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn:hover .uabb-atc-btn-text,
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn:hover .uabb-atc-select-text {
		<?php if ( '' !== $settings->text_hover_color && 'FFFFFF' !== $settings->text_hover_color ) { ?>
			color: <?php echo esc_attr( ( false === strpos( $settings->text_hover_color, 'rgb' ) ) ? '#' . $settings->text_hover_color : $settings->text_hover_color ); ?>
		<?php } else { ?>
			color: <?php echo esc_attr( $text_hover_color ); ?>;
		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fade-btn:hover{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
	}

	/*transparent-fill-top*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-top-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		height: 100%;
	}

	/*transparent-fill-bottom*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-bottom-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		height: 100%;
	}

	/*transparent-fill-left*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-left-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		width: 100%;
	}
	/*transparent-fill-right*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-right-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		width: 100%;
	}

	/*transparent-fill-center*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-center-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		height: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
		width: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
	}

	/* transparent-fill-diagonal */
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-diagonal-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		height: 260%;
	}

	/*transparent-fill-horizontal*/
	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-horizontal-btn:hover:after{
		background: <?php echo esc_attr( uabb_theme_base_color( $bg_hover_color ) ); ?>;
		height: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
		width: calc( 100% + <?php echo esc_attr( $border_size ) . 'px'; ?> );
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-transparent-fill-diagonal-btn:hover {
		background: none;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> a.uabb-creative-transparent-btn.uabb-<?php echo esc_attr( $settings->transparent_button_options ); ?>-btn:hover .uabb-creative-button-text {
		color: <?php echo esc_attr( uabb_theme_button_text_color( $text_hover_color ) ); ?>;
		position: relative;
		z-index: 9;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-<?php echo esc_attr( $settings->transparent_button_options ); ?>-btn:hover .uabb-creative-button-icon {
		color: <?php echo esc_attr( uabb_theme_button_text_color( $text_hover_color ) ); ?>;
		position: relative;
		z-index: 9;
	}
	<?php
}
?>
<?php
if ( 'default' === $settings->style ) {
	$settings->button_border = uabb_theme_border( $settings->button_border );

	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'button_border',
				'selector'     => ".fl-node-$id .uabb-woo-add-to-cart .button",
			)
		);
	}
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button:hover {
		<?php echo ( '' !== $settings->border_hover_color ) ? 'border-color:#' . esc_attr( $settings->border_hover_color ) . ';' : 'border-color:' . esc_attr( uabb_theme_border_hover_color( '' ) ) . ';'; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button:hover {
		background: <?php echo esc_attr( uabb_theme_default_button_bg_hover_color( $bg_hover_color ) ); ?>;
		color: <?php echo esc_attr( uabb_theme_default_button_text_hover_color( $settings->text_hover_color ) ); ?>;
	}
	<?php

}
?>
<?php /* Global Setting If started */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?> 

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
				<?php
				$is_padding_empty_medium = UABB_Helper::uabb_dimention_css( $settings, 'btn_padding', 'padding', 'medium' );

				if ( ! empty( $is_padding_empty_medium ) ) {
					echo esc_attr( $is_padding_empty_medium );
				} else {
					if ( 'default' === $settings->style ) {
						echo esc_attr( uabb_theme_padding_css_genreated( 'tablet' ) );
					}
				}
				?>
			}

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
					font-size: <?php echo esc_attr( $settings->font_size_medium ); ?>px;
					line-height: <?php echo esc_attr( $settings->line_height_medium ); ?>em;
				}
			<?php } ?>
		}

		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
				<?php
				$is_padding_empty_responsive = UABB_Helper::uabb_dimention_css( $settings, 'btn_padding', 'padding', 'responsive' );

				if ( ! empty( $is_padding_empty_responsive ) ) {
					echo esc_attr( $is_padding_empty_responsive );
				} else {
					if ( 'default' === $settings->style ) {
						echo esc_attr( uabb_theme_padding_css_genreated( 'mobile' ) );
					}
				}
				?>
			}

			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
					font-size: <?php echo esc_attr( $settings->font_size_responsive ); ?>px;
					line-height: <?php echo esc_attr( $settings->line_height_responsive ); ?>em;
				}
			<?php } ?>

			<?php if ( 'left' === $settings->mobile_align ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button{
					margin-left: 0;
					margin-right: auto;
					width: auto;
				}
			<?php } elseif ( 'right' === $settings->mobile_align ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button{
					margin-left: auto;
					margin-right: 0;
					width: auto;
				}
			<?php } elseif ( 'center' === $settings->mobile_align ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button{
					margin-left: auto;
					margin-right: auto;
					width: auto;
				}
			<?php } elseif ( 'justify' === $settings->mobile_align ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-add-to-cart .button {
					width: 100%;
				}
			<?php } ?>
		}
	<?php
}
