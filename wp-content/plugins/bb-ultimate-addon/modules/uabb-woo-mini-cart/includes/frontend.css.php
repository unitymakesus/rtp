<?php
/**
 *  UABB Woo - Mini Cart Module front-end CSS php file
 *
 *   @package UABB Woo - Mini Cart Module
 */

$settings->cart_icon_color           = UABB_Helper::uabb_colorpicker( $settings, 'cart_icon_color', true );
$settings->cart_btn_txt_color        = UABB_Helper::uabb_colorpicker( $settings, 'cart_btn_txt_color', true );
$settings->badge_color               = UABB_Helper::uabb_colorpicker( $settings, 'badge_color', true );
$settings->badge_bg_color            = UABB_Helper::uabb_colorpicker( $settings, 'badge_bg_color', true );
$settings->cart_bg_color             = UABB_Helper::uabb_colorpicker( $settings, 'cart_bg_color', true );
$settings->subtotal_color            = UABB_Helper::uabb_colorpicker( $settings, 'subtotal_color', true );
$settings->subtotal_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'subtotal_bg_color', true );
$settings->cart_title_color          = UABB_Helper::uabb_colorpicker( $settings, 'cart_title_color', true );
$settings->cart_title_bg_color       = UABB_Helper::uabb_colorpicker( $settings, 'cart_title_bg_color', true );
$settings->cart_msg_color            = UABB_Helper::uabb_colorpicker( $settings, 'cart_msg_color', true );
$settings->cart_msg_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'cart_msg_bg_color', true );
$settings->empty_msg_color           = UABB_Helper::uabb_colorpicker( $settings, 'empty_msg_color', true );
$settings->item_name_color           = UABB_Helper::uabb_colorpicker( $settings, 'item_name_color', true );
$settings->item_qty_price_color      = UABB_Helper::uabb_colorpicker( $settings, 'item_qty_price_color', true );
$settings->remove_icon_color         = UABB_Helper::uabb_colorpicker( $settings, 'remove_icon_color', true );
$settings->view_btn_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'view_btn_text_color', true );
$settings->view_btn_text_hov_color   = UABB_Helper::uabb_colorpicker( $settings, 'view_btn_text_hov_color', true );
$settings->view_btn_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'view_btn_bg_color', true );
$settings->view_btn_bg_hov_color     = UABB_Helper::uabb_colorpicker( $settings, 'view_btn_bg_hov_color', true );
$settings->view_btn_border_hov_color = UABB_Helper::uabb_colorpicker( $settings, 'view_btn_border_hov_color', true );
$settings->checkout_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'checkout_text_color', true );
$settings->checkout_text_hov_color   = UABB_Helper::uabb_colorpicker( $settings, 'checkout_text_hov_color', true );
$settings->checkout_bg_color         = UABB_Helper::uabb_colorpicker( $settings, 'checkout_bg_color', true );
$settings->checkout_bg_hov_color     = UABB_Helper::uabb_colorpicker( $settings, 'checkout_bg_hov_color', true );
$settings->checkout_border_hov_color = UABB_Helper::uabb_colorpicker( $settings, 'checkout_border_hov_color', true );
$settings->overlay_color             = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

if ( ( 'modal' === $settings->cart_style || 'off-canvas' === $settings->cart_style ) && isset( $settings->overlay_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-off-canvas-wrap,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-modal-wrap {
		<?php
			echo ( '' !== $settings->overlay_color ) ? 'background-color: ' . esc_attr( $settings->overlay_color ) . ';' : '';
		?>
	}
	<?php
}
if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( 'modal' === $settings->cart_style && isset( $settings->modal_height ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'modal_height',
				'selector'     => ".fl-node-$id .uabb-cart-style-modal",
				'prop'         => 'height',
				'unit'         => 'px',
			)
		);
	}
}

if ( isset( $settings->hor_floating_position ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-style-floating .uabb-mini-cart-btn {
		left: <?php echo esc_attr( $settings->hor_floating_position ); ?>%;
		right: unset;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-style-floating.uabb-mini-cart-floating-right .uabb-mini-cart-btn {
		right: <?php echo esc_attr( $settings->hor_floating_position ); ?>%;
		left: unset;
	}
	<?php
}

if ( isset( $settings->ver_floating_position ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-style-floating .uabb-mini-cart-btn {
		top: <?php echo esc_attr( $settings->ver_floating_position ); ?>%;
	}
	<?php
}

if ( 'yes' === $settings->show_badge ) {
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-btn-badge,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-header-badge {
	<?php if ( 'circle' === $settings->badge_style ) { ?>
		border-radius: 100px;
	<?php } elseif ( 'square' === $settings->badge_style ) { ?>
		border-radius: 0;
		<?php
	}

	if ( isset( $settings->badge_color ) && '' !== $settings->badge_color ) {
		?>
		color: <?php echo esc_attr( $settings->badge_color ); ?>;
		<?php
	}

	if ( isset( $settings->badge_bg_color ) && '' !== $settings->badge_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->badge_bg_color ); ?>;
		<?php
	}
	?>
	}
	<?php
} elseif ( 'no' === $settings->show_badge ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-header-badge {
			border-radius: 100px;

		<?php
		if ( isset( $settings->badge_color ) && '' !== $settings->badge_color ) {
			?>
			color: <?php echo esc_attr( $settings->badge_color ); ?>;
			<?php
		}

		if ( isset( $settings->badge_bg_color ) && '' !== $settings->badge_bg_color ) {
			?>
			background-color: <?php echo esc_attr( $settings->badge_bg_color ); ?>;
			<?php
		}
		?>
	}
	<?php
}

if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->badge_space ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'badge_space',
				'selector'     => ".fl-node-$id .uabb-mini-cart-header-badge, .fl-node-$id .uabb-cart-btn-badge",
				'prop'         => 'margin-left',
				'unit'         => 'px',
			)
		);
	}
}

if ( isset( $settings->cart_btn_align ) && '' !== $settings->cart_btn_align ) {
	?>
		<?php if ( 'left' === $settings->cart_btn_align ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-btn {
				justify-content: flex-start;
				margin: 0 auto 0 0;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-style-dropdown {
				left: 0;
			}
		<?php } elseif ( 'right' === $settings->cart_btn_align ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-btn {
				justify-content: flex-end;
				margin: 0 0 0 auto;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-style-dropdown {
				right: 0;
			}
		<?php } elseif ( 'center' === $settings->cart_btn_align ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-btn {
				justify-content: center;
				margin: 0 auto 0 auto;
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-style-dropdown {
				left: 0;
				right: 0;
				margin: auto;
			}
		<?php } ?>
	<?php
}

if ( isset( $settings->cart_icon_color ) && '' !== $settings->cart_icon_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-cart-btn-icon,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-header-icon {
		color: <?php echo esc_attr( $settings->cart_icon_color ); ?>;
	}
	<?php
}

if ( isset( $settings->cart_btn_txt_color ) && '' !== $settings->cart_btn_txt_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-text {
		color: <?php echo esc_attr( $settings->cart_btn_txt_color ); ?>;
	}
	<?php
}

if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->cart_icon_size ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_icon_size',
				'selector'     => ".fl-node-$id .uabb-cart-btn-icon, .fl-node-$id .uabb-mini-cart-header-icon",
				'prop'         => 'font-size',
				'unit'         => 'px',
			)
		);
	}

	if ( 'icon-text' === $settings->btn_style && isset( $settings->cart_icon_space ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_icon_space',
				'selector'     => ".fl-node-$id .uabb-mini-cart-text",
				'prop'         => 'margin-left',
				'unit'         => 'px',
			)
		);
	}

	if ( isset( $settings->cart_width ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_width',
				'selector'     => ".fl-node-$id .uabb-mini-cart-content",
				'prop'         => 'width',
				'unit'         => 'px',
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-content {
<?php
if ( 'color' === $settings->cart_bg_type ) {
	if ( isset( $settings->cart_bg_color ) ) {

		echo ( ! empty( $settings->cart_bg_color ) ) ? 'background:' . esc_attr( $settings->cart_bg_color ) . ';' : '';
	}
} elseif ( 'gradient' === $settings->cart_bg_type ) {
	if ( isset( $settings->cart_bg_gradient ) ) {

		echo ( ! empty( $settings->cart_bg_gradient ) ) ? 'background:' . esc_attr( FLBuilderColor::gradient( $settings->cart_bg_gradient ) ) . ';' : '';
	}
} elseif ( 'image' === $settings->cart_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->cart_bg_img )->url ) ) {
	?>
	background-image: url(<?php echo esc_attr( FLBuilderPhoto::get_attachment_data( $settings->cart_bg_img )->url ); ?>);
	background-position: <?php echo esc_attr( $settings->cart_bg_img_pos ); ?>;
	background-size: <?php echo esc_attr( $settings->cart_bg_img_size ); ?>;
	background-repeat: <?php echo esc_attr( $settings->cart_bg_img_repeat ); ?>;
	<?php
}

if ( isset( $settings->cart_margin_left ) && '' !== $settings->cart_margin_left ) {
	?>
	margin-left: <?php echo esc_attr( $settings->cart_margin_left ); ?>px;
	<?php
}

if ( isset( $settings->cart_margin_top ) && '' !== $settings->cart_margin_top ) {
	?>
	margin-top: <?php echo esc_attr( $settings->cart_margin_top ); ?>px;
	<?php
}
?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->cart_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_border',
				'selector'     => ".fl-node-$id .uabb-mini-cart-content",
			)
		);
	}

	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'cart_padding',
			'selector'     => ".fl-node-$id .uabb-mini-cart-content",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'cart_padding_top',
				'padding-right'  => 'cart_padding_right',
				'padding-bottom' => 'cart_padding_bottom',
				'padding-left'   => 'cart_padding_left',
			),
		)
	);
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-header-text {
	<?php if ( isset( $settings->subtotal_color ) && '' !== $settings->subtotal_color ) { ?>
		color: <?php echo esc_attr( $settings->subtotal_color ); ?>;
		<?php
	}
	if ( isset( $settings->subtotal_bg_color ) && '' !== $settings->subtotal_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->subtotal_bg_color ); ?>;
		<?php
	}
	?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->subtotal_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'subtotal_border',
				'selector'     => ".fl-node-$id .uabb-mini-cart-header-text",
			)
		);
	}

	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'subtotal_padding',
			'selector'     => ".fl-node-$id .uabb-mini-cart-header-text",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'subtotal_padding_top',
				'padding-right'  => 'subtotal_padding_right',
				'padding-bottom' => 'subtotal_padding_bottom',
				'padding-left'   => 'subtotal_padding_left',
			),
		)
	);
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-message {
	<?php if ( isset( $settings->cart_msg_color ) && '' !== $settings->cart_msg_color ) { ?>
		color: <?php echo esc_attr( $settings->cart_msg_color ); ?>;
		<?php
	}
	if ( isset( $settings->cart_msg_bg_color ) && '' !== $settings->cart_msg_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->cart_msg_bg_color ); ?>;
		<?php
	}
	if ( isset( $settings->cart_msg_align ) && '' !== $settings->cart_msg_align ) {
		?>
		text-align: <?php echo esc_attr( $settings->cart_msg_align ); ?>;
	<?php } ?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'cart_msg_padding',
			'selector'     => ".fl-node-$id .uabb-mini-cart-message",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'cart_msg_padding_top',
				'padding-right'  => 'cart_msg_padding_right',
				'padding-bottom' => 'cart_msg_padding_bottom',
				'padding-left'   => 'cart_msg_padding_left',
			),
		)
	);
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-mini-cart-title {
	<?php if ( isset( $settings->cart_title_color ) && '' !== $settings->cart_title_color ) { ?>
		color: <?php echo esc_attr( $settings->cart_title_color ); ?>;
		<?php
	}
	if ( isset( $settings->cart_title_bg_color ) && '' !== $settings->cart_title_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->cart_title_bg_color ); ?>;
		<?php
	}
	if ( isset( $settings->cart_title_align ) && '' !== $settings->cart_title_align ) {
		?>
		text-align: <?php echo esc_attr( $settings->cart_title_align ); ?>;
	<?php } ?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'cart_title_padding',
			'selector'     => ".fl-node-$id .uabb-mini-cart-title",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'cart_title_padding_top',
				'padding-right'  => 'cart_title_padding_right',
				'padding-bottom' => 'cart_title_padding_bottom',
				'padding-left'   => 'cart_title_padding_left',
			),
		)
	);
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart__empty-message {
	<?php if ( isset( $settings->empty_msg_color ) && '' !== $settings->empty_msg_color ) { ?>
		color: <?php echo esc_attr( $settings->empty_msg_color ); ?>;
		<?php
	}
	if ( isset( $settings->empty_msg_align ) && '' !== $settings->empty_msg_align ) {
		?>
		text-align: <?php echo esc_attr( $settings->empty_msg_align ); ?>;
	<?php } ?>
}

<?php if ( isset( $settings->item_name_color ) && '' !== $settings->item_name_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart li.woocommerce-mini-cart-item.mini_cart_item > a:nth-child(2) {
		color: <?php echo esc_attr( $settings->item_name_color ); ?>;
	}
	<?php
}

if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->item_img_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'item_img_border',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail",
			)
		);
	}
}

if ( isset( $settings->item_qty_price_color ) && '' !== $settings->item_qty_price_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart-item.mini_cart_item span.quantity {
		color: <?php echo esc_attr( $settings->item_qty_price_color ); ?>;
	}
	<?php
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart ul.woocommerce-mini-cart.cart_list.product_list_widget li a.remove.remove_from_cart_button {
	<?php if ( isset( $settings->remove_icon_size ) && '' !== $settings->remove_icon_size ) { ?>
		width: calc(<?php echo esc_attr( $settings->remove_icon_size ); ?>px + 24px);
		height: calc(<?php echo esc_attr( $settings->remove_icon_size ); ?>px + 24px);
		font-size: calc(<?php echo esc_attr( $settings->remove_icon_size ); ?>px + 5px);
	<?php } ?>

	<?php if ( isset( $settings->remove_icon_color ) && '' !== $settings->remove_icon_color ) { ?>
		color: <?php echo esc_attr( $settings->remove_icon_color ); ?>;
	<?php } ?>
}
<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->remove_icon_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'remove_icon_border',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart ul.woocommerce-mini-cart.cart_list.product_list_widget li a.remove.remove_from_cart_button",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout) {
	<?php if ( isset( $settings->view_btn_text_color ) && '' !== $settings->view_btn_text_color ) { ?>
		color: <?php echo esc_attr( $settings->view_btn_text_color ); ?>;
		<?php
	}
	if ( isset( $settings->view_btn_bg_color ) && '' !== $settings->view_btn_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->view_btn_bg_color ); ?>;
		<?php
	}

	if ( isset( $settings->view_btn_box_shadow ) && 'yes' === $settings->view_btn_box_shadow ) {
		$view_btn_shadow_color = ( false === strpos( $settings->view_btn_shadow_color, 'rgb' ) ) ? '#' . $settings->view_btn_shadow_color : $settings->view_btn_shadow_color;
		?>

		-webkit-box-shadow: <?php echo esc_attr( $settings->view_btn_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_spr ); ?>px <?php echo esc_attr( $view_btn_shadow_color ); ?>;
		-moz-box-shadow: <?php echo esc_attr( $settings->view_btn_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_spr ); ?>px <?php echo esc_attr( $view_btn_shadow_color ); ?>;
		-o-box-shadow: <?php echo esc_attr( $settings->view_btn_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_spr ); ?>px <?php echo esc_attr( $view_btn_shadow_color ); ?>;
		box-shadow: <?php echo esc_attr( $settings->view_btn_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->view_btn_shadow_color_spr ); ?>px <?php echo esc_attr( $view_btn_shadow_color ); ?>;
		<?php
	}
	?>
}

<?php if ( isset( $settings->space_bet_btns ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .button.checkout.wc-forward {
		margin-left: <?php echo esc_attr( $settings->space_bet_btns ); ?>px;
	}
	<?php
}

if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->view_btn_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'view_btn_border',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout):hover {
	<?php if ( isset( $settings->view_btn_text_hov_color ) && '' !== $settings->view_btn_text_hov_color ) { ?>
		color: <?php echo esc_attr( $settings->view_btn_text_hov_color ); ?>;
		<?php
	}
	if ( isset( $settings->view_btn_bg_hov_color ) && '' !== $settings->view_btn_bg_hov_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->view_btn_bg_hov_color ); ?>;
		<?php
	}
	if ( isset( $settings->view_btn_border_hov_color ) && '' !== $settings->view_btn_border_hov_color ) {
		?>
		border-color: <?php echo esc_attr( $settings->view_btn_border_hov_color ); ?>;
	<?php } ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout {
	<?php if ( isset( $settings->checkout_text_color ) && '' !== $settings->checkout_text_color ) { ?>
		color: <?php echo esc_attr( $settings->checkout_text_color ); ?>;
		<?php
	}
	if ( isset( $settings->checkout_bg_color ) && '' !== $settings->checkout_bg_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->checkout_bg_color ); ?>;
		<?php
	}

	if ( isset( $settings->checkout_box_shadow ) && 'yes' === $settings->checkout_box_shadow ) {
		$checkout_shadow_color = ( false === strpos( $settings->checkout_shadow_color, 'rgb' ) ) ? '#' . $settings->checkout_shadow_color : $settings->checkout_shadow_color;
		?>

		-webkit-box-shadow: <?php echo esc_attr( $settings->checkout_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_spr ); ?>px <?php echo esc_attr( $checkout_shadow_color ); ?>;
		-moz-box-shadow: <?php echo esc_attr( $settings->checkout_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_spr ); ?>px <?php echo esc_attr( $checkout_shadow_color ); ?>;
		-o-box-shadow: <?php echo esc_attr( $settings->checkout_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_spr ); ?>px <?php echo esc_attr( $checkout_shadow_color ); ?>;
		box-shadow: <?php echo esc_attr( $settings->checkout_shadow_color_hor ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_ver ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_blur ); ?>px <?php echo esc_attr( $settings->checkout_shadow_color_spr ); ?>px <?php echo esc_attr( $checkout_shadow_color ); ?>;
		<?php
	}
	?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {
	if ( isset( $settings->checkout_border ) ) {
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'checkout_border',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout:hover {
	<?php if ( isset( $settings->checkout_text_hov_color ) && '' !== $settings->checkout_text_hov_color ) { ?>
		color: <?php echo esc_attr( $settings->checkout_text_hov_color ); ?>;
		<?php
	}
	if ( isset( $settings->checkout_bg_hov_color ) && '' !== $settings->checkout_bg_hov_color ) {
		?>
		background-color: <?php echo esc_attr( $settings->checkout_bg_hov_color ); ?>;
		<?php
	}
	if ( isset( $settings->checkout_border_hov_color ) && '' !== $settings->checkout_border_hov_color ) {
		?>
		border-color: <?php echo esc_attr( $settings->checkout_border_hov_color ); ?>;
	<?php } ?>
}

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {

	if ( isset( $settings->cart_btn_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_btn_typo',
				'selector'     => ".fl-node-$id .uabb-mini-cart-text, .fl-node-$id .woocommerce-Price-amount.amount",
			)
		);
	}

	if ( isset( $settings->subtotal_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'subtotal_typo',
				'selector'     => ".fl-node-$id .uabb-mini-cart-header-text",
			)
		);
	}

	if ( isset( $settings->cart_title_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_title_typo',
				'selector'     => ".fl-node-$id .uabb-mini-cart-title",
			)
		);
	}

	if ( isset( $settings->cart_msg_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'cart_msg_typo',
				'selector'     => ".fl-node-$id .uabb-mini-cart-message",
			)
		);
	}

	if ( isset( $settings->empt_msg_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'empt_msg_typo',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart__empty-message",
			)
		);
	}

	if ( isset( $settings->item_name_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'item_name_typo',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart li.woocommerce-mini-cart-item.mini_cart_item > a:nth-child(2)",
			)
		);
	}

	if ( isset( $settings->item_qty_price_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'item_qty_price_typo',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart-item.mini_cart_item span.quantity",
			)
		);
	}

	if ( isset( $settings->view_cart_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'view_cart_typo',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)",
			)
		);
	}

	if ( isset( $settings->checkout_typo ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'checkout_typo',
				'selector'     => ".fl-node-$id .uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout",
			)
		);
	}
}
?>
