<?php
/**
 * Render the Frontend layout for Advanced Posts module.
 *
 * @package UABB Advanced Posts Module
 */

$uabb_args = $module->get_uabb_args();
$args      = $module->render_args();

$uabb_args = apply_filters( 'uabb_blog_posts_query_args', $args, $settings );

$module->set_uabb_args( $uabb_args );

$show_pagination = ( isset( $settings->show_pagination ) ) ? $settings->show_pagination : 'no';

$pagination = ( isset( $settings->pagination ) ) ? $settings->pagination : 'numbers';

if ( isset( $settings->offset ) ) {
	$settings->offset = ( ! is_int( (int) $settings->offset ) ) ? 0 : ( ( '' !== $settings->offset ) ? $settings->offset : 0 );
} else {
	$settings->offset = 0;
}
$settings->order_by       = $args['orderby'];
$settings->posts_per_page = $args['posts_per_page'];

if ( isset( $settings->data_source ) && 'main_query' === $settings->data_source && true === FL_BUILDER_LITE ) {
	global $wp_query;
	$the_query = clone $wp_query;
	$the_query->rewind_posts();
	$the_query->reset_postdata();
} else {

	$the_query = FLBuilderLoop::query( $settings );
	$module->set_uabb_args( array() );

	/*
	 * Refine blog post WP Query
	 */

	if ( 'carousel' !== $settings->is_carousel && 'yes' === $show_pagination && 'numbers' === $pagination ) {

		$settings->total_posts_switch = ( isset( $settings->total_posts_switch ) ? $settings->total_posts_switch : 'all' );

		$settings->total_posts = ( isset( $settings->total_posts ) ? ( ( '' !== $settings->total_posts ) ? $settings->total_posts : '10' ) : '10' );

		$total_posts = ( 'all' === $settings->total_posts_switch ) ? '-1' : $settings->total_posts;

		if ( $total_posts > 0 ) {
			$the_query->posts = array_slice( $the_query->posts, 0, $total_posts );
		} elseif ( 0 === $total_posts ) {
			$the_query->posts = array();
		}

		if ( 0 === $args['posts_per_page'] ) {
			$the_query->posts = array();
		}
	}
}


/*
 * Define columns as per Grids
 */

$col = ( 'carousel' !== $settings->is_carousel ) ? ( ( 'feed' === $settings->is_carousel ) ? 1 : $settings->post_per_grid ) : $settings->post_per_grid_desktop;

$col = ( 'carousel' === $settings->is_carousel ) ? $settings->post_per_grid_desktop : ( ( 'feed' === $settings->is_carousel ) ? 1 : $settings->post_per_grid );


/*
 * Render Mansonry Filter Buttons
 */

if ( 'masonary' === $settings->is_carousel || 'grid' === $settings->is_carousel ) {
	$module->render_masonary_filters( $the_query->posts );
}

?>
<div class="uabb-module-content uabb-blog-posts <?php echo wp_kses_post( ( 'carousel' === $settings->is_carousel ) ? 'uabb-blog-posts-carousel' : ( ( 'grid' === $settings->is_carousel ) ? 'uabb-blog-posts-grid' : '' ) ); ?> uabb-post-grid-<?php echo esc_attr( $col ); ?> <?php echo ( 'masonary' === $settings->is_carousel ) ? ' uabb-blog-posts-masonary ' : ''; ?>">
	<?php
	$class = '';

	$condition = ( is_array( $the_query->posts ) || is_object( $the_query->posts ) ) ? count( $the_query->posts ) : '';

	for ( $i = 0; $i < $condition; $i++ ) {
		setup_postdata( $the_query->posts[ $i ] );
		$the_query->the_post();

		if ( 'masonary' === $settings->is_carousel || 'grid' === $settings->is_carousel ) {
			$blog_post_type    = ( isset( $settings->post_type ) ) ? $settings->post_type : 'post';
			$object_taxonomies = get_object_taxonomies( $blog_post_type );
			if ( ! empty( $object_taxonomies ) ) {
				$cat = 'masonary_filter_' . $blog_post_type; //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				if ( isset( $settings->$cat ) ) {
					if ( -1 !== (int) $settings->$cat ) {
						$category_detail = wp_get_post_terms( $the_query->posts[ $i ]->ID, $settings->$cat );
						$class           = '';
						if ( count( $category_detail ) > 0 ) {
							foreach ( $category_detail as $cat_details ) {
								$class .= ' uabb-masonary-cat-' . $cat_details->term_id . ' ';
							}
						}
					}
				}
			}
		}


		$top_featured_image_content = $module->render_featured_image( $the_query->posts[ $i ], $i );

		$left_featured_image_content       = $module->render_featured_image( $the_query->posts[ $i ], $i, 'left' );
		$background_featured_image_content = $module->render_featured_image( $the_query->posts[ $i ], $i, 'background' );
		$right_featured_image_content      = $module->render_featured_image( $the_query->posts[ $i ], $i, 'right' );

		$left_hide_class = ( '' === $left_featured_image_content && '' === $right_featured_image_content ) ? 'uabb-empty-img' : '';

		do_action( 'uabb_blog_posts_before_post', $the_query->posts[ $i ]->ID, $settings );
		?>
	<div class="uabb-blog-posts-col-<?php echo esc_attr( $col ); ?> uabb-post-wrapper <?php echo ( 'masonary' === $settings->is_carousel ) ? ' uabb-blog-posts-masonary-item-' . esc_attr( $module->node ) . ' ' : ''; ?> <?php echo ( 'masonary' === $settings->is_carousel || 'grid' === $settings->is_carousel ) ? esc_attr( $class ) : ''; ?> <?php echo ( 'grid' === $settings->is_carousel ) ? ' uabb-blog-posts-grid-item-' . esc_attr( $module->node ) . ' ' : ''; ?>">
		<?php
		if ( 'box' === $settings->cta_type ) {
			echo '<a href="' . get_permalink( $the_query->posts[ $i ]->ID ) . '" target="' . esc_attr( $settings->link_target ) . '" ' . wp_kses_post( BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $settings->link_nofollow, 0 ) ) . ' class="uabb-blog-post-element-link"></a>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
		<div class="uabb-blog-posts-shadow clearfix">

			<div class="uabb-blog-post-inner-wrap <?php echo 'uabb-thumbnail-position-' . esc_attr( $settings->blog_image_position ); ?> <?php echo ( 'img,title,meta,content,cta' !== $settings->layout_sort_order ) ? 'uabb-blog-reordered' : ''; ?> <?php echo esc_attr( $left_hide_class ); ?>">
			<?php
			if ( isset( $settings->post_layout ) && 'custom' === $settings->post_layout && defined( 'FL_THEME_BUILDER_DIR' ) ) {
				include BB_ULTIMATE_ADDON_DIR . 'includes/' . $module->slug . '-frontend.php';
			} else {
				echo ( substr( $settings->layout_sort_order, 0, 3 ) === 'img' ) ? wp_kses_post( $top_featured_image_content ) : '';
				echo wp_kses_post( $left_featured_image_content );
				echo wp_kses_post( $background_featured_image_content );
				$module->render_blog_content( $the_query->posts[ $i ], $i );
				echo wp_kses_post( $right_featured_image_content );
				echo ( substr( $settings->layout_sort_order, -3 ) === 'img' ) ? wp_kses_post( $top_featured_image_content ) : '';
			}
			?>
			</div>
		</div>
	</div>
		<?php
		do_action( 'uabb_blog_posts_after_post', $the_query->posts[ $i ]->ID, $settings );
	}

	?>
	<?php if ( 'grid' === $settings->is_carousel ) : ?>
	<div class="uabb-post-grid-sizer"></div>
	<?php endif; ?>
</div>
<?php

/*
 *  Render Pagination
 */

if ( 'carousel' !== $settings->is_carousel && 'yes' === $show_pagination ) {
	$blog_post_type = ( isset( $settings->post_type ) ) ? $settings->post_type : 'post';
	$cat            = 'masonary_filter_' . $blog_post_type; //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	$do_pagination  = ( isset( $settings->$cat ) ) ? ( ( -1 === (int) $settings->$cat ) ? true : false ) : true;

	if ( 'masonary' === $settings->is_carousel ) {
		if ( true === $do_pagination ) {
			?>
		<div class="uabb-blogs-pagination"
			<?php
			if ( 'scroll' === $pagination ) {
				echo ' style="display:none;"';}
			?>
		>
			<?php $module->render_pagination( $the_query ); ?>
		</div>
			<?php
		}
	} else {
		?>
		<div class="uabb-blogs-pagination"
		<?php
		if ( 'scroll' === $pagination ) {
			echo ' style="display:none;"';}
		?>
		>
			<?php $module->render_pagination( $the_query ); ?>
		</div>
		<?php
	}
}

// Render the empty message.
if ( empty( $the_query->posts ) ) :
	?>
<div class="fl-post-grid-empty">
	<p><?php echo $settings->no_results_message; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	<?php if ( $settings->show_search ) : ?>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
	<?php
endif;

wp_reset_postdata();

?>
