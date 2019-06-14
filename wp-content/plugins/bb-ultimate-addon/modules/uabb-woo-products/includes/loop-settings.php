<?php
/**
 *  UABB Woo Products Module loop settings file
 *
 *  @package UABB Woo Products Module
 */

FLBuilderModel::default_settings(
	$settings, array(
		'data_source' => 'custom_query',
		'post_type'   => 'product',
		'order_by'    => 'date',
		'order'       => 'DESC',
		'offset'      => 0,
		'users'       => '',
	)
);

$settings = apply_filters( 'fl_builder_loop_settings', $settings );  // Allow extension of default Values.

do_action( 'uabb_woo_products_loop_settings_before_form', $settings ); // e.g Add custom FLBuilder::render_settings_field().

?>
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title">
			<span class="fl-builder-settings-title-text-wrap"><?php _e( 'Custom Query', 'uabb' ); ?></span>
		</h3>
		<?php foreach ( FLBuilderLoop::post_types() as $slug => $type ) : ?>
			<table class="fl-form-table fl-custom-query-filter fl-custom-query-<?php echo $slug; ?>-filter"
																						<?php
																						if ( $slug == $settings->post_type ) {
																							echo 'style="display:table;"';}
																						?>
			>
			<?php

			// Posts.
			FLBuilder::render_settings_field(
				'posts_' . $slug, array(
					'type'     => 'suggest',
					'action'   => 'fl_as_posts',
					'data'     => $slug,
					'label'    => $type->label,
					'help'     => sprintf( /* translators: %s: search term */ __( 'Enter a list of %1$s.', 'uabb' ), $type->label ),
					'matching' => true,
				), $settings
			);

			// Taxonomies.
			$taxonomies = FLBuilderLoop::taxonomies( $slug );

			foreach ( $taxonomies as $tax_slug => $tax ) {

				FLBuilder::render_settings_field(
					'tax_' . $slug . '_' . $tax_slug, array(
						'type'     => 'suggest',
						'action'   => 'fl_as_terms',
						'data'     => $tax_slug,
						'label'    => $tax->label,
						'help'     => sprintf( /* translators: %s: search term */ __( 'Enter a list of %1$s.', 'uabb' ), $tax->label ),
						'matching' => true,
					), $settings
				);
			}

			?>
			</table>
		<?php endforeach; ?>
		<table class="fl-form-table">
		<?php

		// Author.
		FLBuilder::render_settings_field(
			'users', array(
				'type'     => 'suggest',
				'action'   => 'fl_as_users',
				'label'    => __( 'Authors', 'uabb' ),
				'help'     => __( 'Enter a list of authors usernames.', 'uabb' ),
				'matching' => true,
			), $settings
		);

		?>
		</table>
	</div>
	<div id="fl-builder-settings-section-general" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title">
			<span class="fl-builder-settings-title-text-wrap"><?php _e( 'Filter', 'uabb' ); ?></span>
		</h3>
		<table class="fl-form-table">
		<?php

		// Order.
		FLBuilder::render_settings_field(
			'filter_by', array(
				'type'    => 'select',
				'label'   => __( 'Filter By', 'uabb' ),
				'options' => array(
					''         => __( 'None', 'uabb' ),
					'sale'     => __( 'Sale', 'uabb' ),
					'featured' => __( 'Featured', 'uabb' ),
				),
			), $settings
		);

		// Order.
		FLBuilder::render_settings_field(
			'order', array(
				'type'    => 'select',
				'label'   => __( 'Order', 'uabb' ),
				'options' => array(
					'DESC' => __( 'Descending', 'uabb' ),
					'ASC'  => __( 'Ascending', 'uabb' ),
				),
			), $settings
		);

		// Order by.
		FLBuilder::render_settings_field(
			'order_by', array(
				'type'    => 'select',
				'label'   => __( 'Order By', 'uabb' ),
				'options' => array(
					'author'         => __( 'Author', 'uabb' ),
					'comment_count'  => __( 'Comment Count', 'uabb' ),
					'date'           => __( 'Date', 'uabb' ),
					'modified'       => __( 'Date Last Modified', 'uabb' ),
					'ID'             => __( 'ID', 'uabb' ),
					'menu_order'     => __( 'Menu Order', 'uabb' ),
					'meta_value'     => __( 'Meta Value (Alphabetical)', 'uabb' ),
					'meta_value_num' => __( 'Meta Value (Numeric)', 'uabb' ),
					'rand'           => __( 'Random', 'uabb' ),
					'title'          => __( 'Title', 'uabb' ),
				),
				'toggle'  => array(
					'meta_value'     => array(
						'fields' => array( 'order_by_meta_key' ),
					),
					'meta_value_num' => array(
						'fields' => array( 'order_by_meta_key' ),
					),
				),
			), $settings
		);

		// Meta Key.
		FLBuilder::render_settings_field(
			'order_by_meta_key', array(
				'type'  => 'text',
				'label' => __( 'Meta Key', 'uabb' ),
			), $settings
		);

		// Offset.
		FLBuilder::render_settings_field(
			'offset', array(
				'type'    => 'unit',
				'label'   => _x( 'Offset', 'How many products to skip.', 'uabb' ),
				'default' => '0',
				'size'    => '4',
				'help'    => __( 'Skip this many products that match the specified criteria.', 'uabb' ),
			), $settings
		);

		FLBuilder::render_settings_field(
			'exclude_self', array(
				'type'    => 'select',
				'label'   => __( 'Exclude Current Product', 'uabb' ),
				'default' => 'no',
				'help'    => __( 'Exclude the current product from the query.', 'uabb' ),
				'options' => array(
					'yes' => __( 'Yes', 'uabb' ),
					'no'  => __( 'No', 'uabb' ),
				),
			), $settings
		);

		?>
		</table>
	</div>
</div>
<?php
do_action( 'uabb_woo_products_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field().
