<?php
/**
 *  Photo Gallery Module front-end file
 *
 *  @package Photo Gallery Module
 */

if ( 'yes' === $settings->filterable_gallery_enable && 'none' === $settings->pagination ) {
	echo $module->render_gallery_filters(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	$filters     = $module->get_filter_values();
	$filter_data = wp_json_encode( array_keys( $filters ) );
}

if ( 'grid' === $settings->layout ) : ?>
	<div class="uabb-module-content uabb-photo-gallery uabb-gallery-grid<?php echo esc_attr( $settings->grid_column ); ?> <?php echo ( 'none' !== $settings->hover_effects ) ? esc_attr( $settings->hover_effects ) : ''; ?> <?php echo ( 'yes' === $settings->filterable_gallery_enable ) ? 'uabb-photo-gallery-filter-grid' : ''; ?>" data-nonce="<?php echo wp_kses_post( wp_create_nonce( 'uabb-photo-nonce' ) ); ?>" data-all-filters=<?php echo ( isset( $filter_data ) && 'none' === $settings->pagination ) ? wp_kses_post( $filter_data ) : ''; ?> >
		<?php
		foreach ( $module->get_photos() as $photo ) :
			$module->render_layout( $photo );
		endforeach;
		?>
	</div>
<?php else : ?>
<div class="uabb-masonary">
	<div class="uabb-masonary-content <?php echo ( 'none' !== $settings->hover_effects ) ? esc_attr( $settings->hover_effects ) : ''; ?> <?php echo ( 'yes' === $settings->filterable_gallery_enable ) ? 'uabb-photo-gallery-filter' : ''; ?>" data-nonce="<?php echo wp_kses_post( wp_create_nonce( 'uabb-photo-nonce' ) ); ?>" data-all-filters=<?php echo ( isset( $filter_data ) && 'none' === $settings->pagination ) ? wp_kses_post( $filter_data ) : ''; ?>>
		<div class="uabb-grid-sizer"></div>
		<?php
		foreach ( $module->get_photos() as $photo ) :
			$module->render_layout( $photo );
		endforeach;
		?>
	</div>
	<div class="fl-clear"></div>
</div>
	<?php
endif;

if ( ! empty( $settings->photos ) ) {
	?>
	<?php if ( isset( $settings->pagination ) && ( 'load_more' === $settings->pagination || 'scroll' === $settings->pagination ) ) { ?>
		<?php if ( ! empty( $settings->images_per_page ) && absint( $settings->images_per_page ) < count( $settings->photos ) ) { ?>
			<div class="uabb-gallery-pagination pagination-<?php echo esc_attr( $settings->pagination ); ?>">
				<a href="#" class="uabb-gallery-load-more"><?php echo $settings->load_more_text; ?></a> <?php //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php if ( 'scroll' === $settings->pagination ) { ?>
				<div class="uabb-gallery-loader" style="display: none;">
					<span class="uabb-grid-loader-icon"><img src="<?php echo esc_attr( BB_ULTIMATE_ADDON_URL ) . 'modules/photo-gallery/images/loader.svg'; ?>" style="height: 50px;"/></span>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
<?php } ?>
