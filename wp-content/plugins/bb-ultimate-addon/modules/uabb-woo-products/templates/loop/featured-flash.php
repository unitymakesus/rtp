<?php
/**
 * UABB WooCommerce Products - Featured Flash.
 *
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;

$featured_text = __( 'New', 'uabb' );

if ( 'custom' === $settings->featured_flash && '' !== $settings->featured_flash_content ) {
	$featured_text = $settings->featured_flash_content;
}

?>
<?php if ( $product->is_featured() ) : ?>

	<?php echo apply_filters( 'uabb_woo_products_featured_flash', '<div class="uabb-featured-flash-wrap"><span class="uabb-featured">' . esc_html( $featured_text ) . '</span></div>', $post, $product ); ?>

	<?php
endif;

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
