<?php
/**
 *  UABBWooCategoriesModule loop settings file
 *
 *  @package UABBWooCategoriesModule
 */

FLBuilderModel::default_settings(
	$settings,
	array(
		'filter_rule'       => 'all',
		'order_by'          => 'name',
		'order'             => 'DESC',
		'display_cat_desc'  => 'no',
		'display_empty_cat' => 'no',
	)
);

$settings = apply_filters( 'fl_builder_loop_settings', $settings );  // Allow extension of default Values.

do_action( 'uabb_woo_categories_products_loop_settings_before_form', $settings ); // e.g Add custom FLBuilder::render_settings_field().

?>
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title">
			<span class="fl-builder-settings-title-text-wrap"><?php esc_attr_e( 'Filter', 'uabb' ); ?></span>
		</h3>
		<?php foreach ( FLBuilderLoop::post_types() as $slug => $type ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>

			<?php
			if ( 'product' !== $slug ) {
				continue;
			}
			?>

			<table class="fl-form-table fl-custom-query-filter fl-custom-query-<?php echo esc_attr( $slug ); ?>-filter" style="display:table;">
			<?php

			// Filter Rule.
			FLBuilder::render_settings_field(
				'filter_rule',
				array(
					'type'    => 'select',
					'label'   => __( 'Filter Rule', 'uabb' ),
					'options' => array(
						'all'     => __( 'Show All', 'uabb' ),
						'top'     => __( 'Only Top Level', 'uabb' ),
						'include' => __( 'Match These Categories', 'uabb' ),
						'exclude' => __( 'Exclude These Categories', 'uabb' ),
					),
					'toggle'  => array(
						'include' => array(
							'fields' => array( 'tax_product_product_cat' ),
						),
						'exclude' => array(
							'fields' => array( 'tax_product_product_cat' ),
						),
					),
				),
				$settings
			);

			// Taxonomies.
			$taxonomies = FLBuilderLoop::taxonomies( $slug );


			foreach ( $taxonomies as $tax_slug => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

				if ( 'product_cat' !== $tax_slug ) {
					continue;
				}

				FLBuilder::render_settings_field(
					'tax_' . $slug . '_' . $tax_slug,
					array(
						'type'   => 'suggest',
						'action' => 'fl_as_terms',
						'data'   => $tax_slug,
						'label'  => $tax->label,
						'help'   => sprintf( /* translators: %s: search term */ __( 'Enter a list of %1$s.', 'uabb' ), $tax->label ),
					),
					$settings
				);
			}

			FLBuilder::render_settings_field(
				'display_cat_desc',
				array(
					'type'    => 'select',
					'label'   => __( 'Display Category Description', 'uabb' ),
					'default' => 'no',
					'options' => array(
						'yes' => __( 'Yes', 'uabb' ),
						'no'  => __( 'No', 'uabb' ),
					),
					'toggle'  => array(
						'yes' => array(
							'sections' => array( 'desc_style_sec', 'desc_typo' ),
						),
					),
				),
				$settings
			);

			FLBuilder::render_settings_field(
				'display_empty_cat',
				array(
					'type'    => 'select',
					'label'   => __( 'Display Empty Categories', 'uabb' ),
					'default' => 'no',
					'options' => array(
						'yes' => __( 'Yes', 'uabb' ),
						'no'  => __( 'No', 'uabb' ),
					),
				),
				$settings
			);

			// Order by.
			FLBuilder::render_settings_field(
				'order_by',
				array(
					'type'    => 'select',
					'label'   => __( 'Order By', 'uabb' ),
					'default' => 'name',
					'options' => array(
						'name'        => __( 'Name', 'uabb' ),
						'slug'        => __( 'Slug', 'uabb' ),
						'count'       => __( 'Count', 'uabb' ),
						'description' => __( 'Description', 'uabb' ),
						'menu_order'  => __( 'Menu Order', 'uabb' ),
					),
				),
				$settings
			);

			// Order.
			FLBuilder::render_settings_field(
				'order',
				array(
					'type'    => 'select',
					'label'   => __( 'Order', 'uabb' ),
					'default' => 'DESC',
					'options' => array(
						'DESC' => __( 'Descending', 'uabb' ),
						'ASC'  => __( 'Ascending', 'uabb' ),
					),
				),
				$settings
			);

			?>
			</table>
		<?php endforeach; ?>
	</div>
</div>
<?php
do_action( 'uabb_woo_categories_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field().
