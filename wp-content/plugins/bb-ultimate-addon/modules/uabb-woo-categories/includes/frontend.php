<?php
/**
 *  UABBWooCategoriesModule front-end file
 *
 *  @package UABBWooCategoriesModule
 */

?>

<div class="uabb-woo-categories uabb-woo-categories-<?php echo esc_attr( $settings->layout ); ?>">
	<div class="uabb-woocommerce">
		<div class="uabb-woo-categories-inner <?php echo wp_kses_post( $module->get_inner_classes() ); ?>">
		<?php
			$module->query_product_categories();
		?>
		</div>
	</div>
</div>
