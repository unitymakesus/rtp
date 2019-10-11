<?php
/**
 *  UABBWooCategoriesModule front-end file
 *
 *  @package UABBWooCategoriesModule
 */

?>

<div class="uabb-woo-categories uabb-woo-categories-<?php echo $settings->layout; ?>">
	<div class="uabb-woocommerce">
		<div class="uabb-woo-categories-inner <?php echo $module->get_inner_classes(); ?>">
		<?php
			$module->query_product_categories();
		?>
		</div>
	</div>
</div>
