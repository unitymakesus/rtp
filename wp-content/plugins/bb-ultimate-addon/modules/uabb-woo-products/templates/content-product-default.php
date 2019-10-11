<?php
/**
 * UABB WooCommerce Products - Template.
 *
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php

$post_id    = $product->get_id();
$class      = array();
$classes    = array();
$classes[]  = 'post-' . $post_id;
$wc_classes = esc_attr( implode( ' ', wc_product_post_class( $classes, $class, $post_id ) ) );


$sale_flash      = $settings->sale_flash;
$featured_flash  = $settings->featured_flash;
$quick_view_type = $settings->quick_view;

$out_of_stock        = get_post_meta( $post_id, '_stock_status', true );
$out_of_stock_string = apply_filters( 'uabb_woo_out_of_stock_string', __( 'Out of stock', 'uabb' ) );

?>
<li class=" <?php echo $wc_classes; ?>">
	<div class="uabb-woo-product-wrapper">
		<?php

		echo '<div class="uabb-woo-products-thumbnail-wrap">';

		if ( 'none' !== $sale_flash || 'none' !== $featured_flash ) {

			$double_flash = '';

			if ( 'none' !== $sale_flash && 'none' !== $featured_flash ) {

				if ( $product->is_on_sale() ) {
					$double_flash = 'double-flash';
				}
			}

			echo '<div class="uabb-flash-container ' . $double_flash . '">';


			if ( 'none' !== $sale_flash ) {
				include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/loop/sale-flash.php';
			}

			if ( 'none' !== $featured_flash ) {
				include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/loop/featured-flash.php';
			}

			echo '</div>';
		}

			woocommerce_template_loop_product_link_open();
			woocommerce_template_loop_product_thumbnail();

		if ( 'swap' === $settings->image_hover_style ) {
			$this->woo_shop_product_flip_image();
		}

			woocommerce_template_loop_product_link_close();

		/* Out of stock */
		if ( 'outofstock' === $out_of_stock ) {
			echo '<span class="uabb-out-of-stock">' . esc_html( $out_of_stock_string ) . '</span>';
		}

		/* Quick View */
		if ( 'show' === $quick_view_type ) {

			echo '<div class="uabb-quick-view-btn" data-product_id="' . $post_id . '">';
				echo '<span class="uabb-qv-icon fa fa-eye"></span>';
				echo '<span class="uabb-qv-text">' . __( 'Quick View', 'uabb' ) . '</span>';
			echo '</div>';
		}


		echo '</div>';

		$shop_structure = array();

		if ( 'yes' === $settings->show_category ) {

			$shop_structure[] = 'category';
		}
		if ( 'yes' === $settings->show_title ) {

			$shop_structure[] = 'title';
		}
		if ( 'yes' === $settings->show_ratings ) {

			$shop_structure[] = 'ratings';
		}
		if ( 'yes' === $settings->show_price ) {

			$shop_structure[] = 'price';
		}
		if ( 'yes' === $settings->show_short_desc ) {

			$shop_structure[] = 'short_desc';
		}
		if ( 'yes' === $settings->show_add_to_cart ) {

			$shop_structure[] = 'add_cart';
		}

		$shop_structure = apply_filters(
			'uabb_woo_products_content_structure',
			$shop_structure
		);

		if ( is_array( $shop_structure ) && ! empty( $shop_structure ) ) {

			do_action( 'uabb_woo_products_before_summary_wrap', $post_id, $settings );
			echo '<div class="uabb-woo-products-summary-wrap">';
			do_action( 'uabb_woo_products_summary_wrap_top', $post_id, $settings );

			foreach ( $shop_structure as $value ) {

				switch ( $value ) {
					case 'title':
						/**
						 * Add Product Title on shop page for all products.
						 */
						do_action( 'uabb_woo_products_title_before', $post_id, $settings );
						echo '<a href="' . esc_url( apply_filters( 'uabb_woo_title_link', get_the_permalink() ) ) . '" class="uabb-loop-product__link">';
							woocommerce_template_loop_product_title();
						echo '</a>';
						do_action( 'uabb_woo_products_title_after', $post_id, $settings );
						break;
					case 'price':
						/**
						 * Add Product Price on shop page for all products.
						 */
						do_action( 'uabb_woo_products_price_before', $post_id, $settings );
						woocommerce_template_loop_price();
						do_action( 'uabb_woo_products_price_after', $post_id, $settings );
						break;
					case 'ratings':
						/**
						 * Add rating on shop page for all products.
						 */
						do_action( 'uabb_woo_products_rating_before', $post_id, $settings );
						woocommerce_template_loop_rating();
						do_action( 'uabb_woo_products_rating_after', $post_id, $settings );
						break;
					case 'short_desc':
						do_action( 'uabb_woo_products_short_description_before', $post_id, $settings );
						$this->woo_shop_short_desc();
						do_action( 'uabb_woo_products_short_description_after', $post_id, $settings );
						break;
					case 'add_cart':
						do_action( 'uabb_woo_products_add_to_cart_before', $post_id, $settings );
						woocommerce_template_loop_add_to_cart();
						do_action( 'uabb_woo_products_add_to_cart_after', $post_id, $settings );
						break;
					case 'category':
						/**
						 * Add and/or Remove Categories from shop archive page.
						 */
						do_action( 'uabb_woo_products_category_before', $post_id, $settings );
						$this->woo_shop_parent_category();
						do_action( 'uabb_woo_products_category_after', $post_id, $settings );
						break;
					default:
						break;
				}
			}

			do_action( 'uabb_woo_products_summary_wrap_bottom', $post_id, $settings );
			echo '</div>';
			do_action( 'uabb_woo_products_after_summary_wrap', $post_id, $settings );
		}
		?>
	</div>
</li>
