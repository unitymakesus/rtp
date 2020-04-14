<?php
/**
 *  UABB Woo Products Module front-end file
 *
 *  @package UABB Woo Products Module
 */

?>

<div class="uabb-woo-products uabb-woo-products-<?php echo esc_attr( $settings->layout ); ?> uabb-woo-products-<?php echo esc_attr( $settings->skin ); ?>" data-nonce=<?php echo wp_kses_post( wp_create_nonce( 'uabb-woo-nonce' ) ); ?> >
	<div class="uabb-woocommerce">
		<div class="uabb-woo-products-inner <?php echo wp_kses_post( $module->get_inner_classes() ); ?>">
		<?php
			$module->render_query();

			$query = $module->get_query();

		if ( ! $query->have_posts() ) {
			return;
		}

			$module->render_loop_args();
			$module->render_woo_loop_start();
				$module->render_woo_loop();
			$module->render_woo_loop_end();
			$module->render_pagination_structure();
			$module->render_reset_loop();
		?>
		</div>
	</div>

	<?php $module->quick_view_modal(); ?>
</div>
