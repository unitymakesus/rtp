<?php
/**
 * WooCommerce - Quick View Modal
 *
 * @package UABB
 */

?>
<div class="uabb-quick-view-<?php echo esc_attr( $widget_id ); ?>">
	<div class="uabb-quick-view-bg"><div class="uabb-quick-view-loader"></div></div>
	<div id="uabb-quick-view-modal">
		<div class="uabb-content-main-wrapper"><?php /*Don't remove this html comment*/ ?><!--
		--><div class="uabb-content-main">
				<div class="uabb-lightbox-content">
					<div class="uabb-content-main-head">
						<a href="#" id="uabb-quick-view-close" class="uabb-quick-view-close-btn fa fa-close"></a>
					</div>
					<div id="uabb-quick-view-content" class="woocommerce single-product"></div>
				</div>
			</div>
		</div>
	</div>
</div>
