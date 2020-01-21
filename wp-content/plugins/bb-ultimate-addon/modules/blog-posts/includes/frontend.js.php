<?php
/**
 * Render JavaScript to check function the various settings of module
 *
 * @package UABB Blog Posts Module
 */

?>(function($) {

	var document_width, document_height;
	<?php
		$post_type   = empty( $settings->post_type ) ? 'post' : $settings->post_type;
		$filter_type = 'uabb_masonary_filter_type_' . $post_type;
	?>
	var args = {
		id: '<?php echo $id; ?>',
		pagination: '<?php echo isset( $settings->pagination ) ? $settings->pagination : 'numbers'; ?>',
		is_carousel: '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>',
		infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
		arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,
		desktop: <?php echo ( '' != $settings->post_per_grid_desktop ) ? $settings->post_per_grid_desktop : 1; ?>,
		moduleUrl: '<?php echo BB_ULTIMATE_ADDON_URL . 'modules/' . $settings->type; ?>',
		medium: <?php echo ( '' != $settings->post_per_grid_medium ) ? $settings->post_per_grid_medium : 1; ?>,
		small: <?php echo ( '' != $settings->post_per_grid_small ) ? $settings->post_per_grid_small : 1; ?>,
		slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
		prevArrow: '<?php echo ( isset( $settings->icon_left ) && '' != $settings->icon_left ) ? $settings->icon_left : 'fas fa-angle-left'; ?>',
		nextArrow: '<?php echo ( isset( $settings->icon_right ) && '' != $settings->icon_right ) ? $settings->icon_right : 'fas fa-angle-right'; ?>',
		autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
		autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
		dots:<?php echo ( 'yes' === $settings->enable_dots ) ? 'true' : 'false'; ?>,
		small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
		medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
		equal_height_box: '<?php echo $settings->equal_height_box; ?>',
		uabb_masonary_filter_type: '<?php echo isset( $settings->$filter_type ) ? $settings->$filter_type : 'buttons'; ?>',
		mesonry_equal_height: '<?php echo isset( $settings->mesonry_equal_height ) ? $settings->mesonry_equal_height : 'no'; ?>',
		blog_image_position: '<?php echo $settings->blog_image_position; ?>'
	};

	jQuery(document).ready( function() {

		var hashval = window.location.hash,
			hashval = hashval.replace( '#' , '' );

		jQuery( '.uabb-masonary-filters .uabb-masonary-current' ).trigger('click');

		if( hashval != '' ) {

			jQuery('.fl-node-<?php echo $id; ?> .uabb-masonary-filters li').removeClass('uabb-masonary-current');

			jQuery('.fl-node-<?php echo $id; ?> .uabb-masonary-filters li[data-filter=".uabb-masonary-cat-' + hashval + '"]').addClass('uabb-masonary-current');

			jQuery( '.fl-node-<?php echo $id; ?> .uabb-masonary-filters .uabb-masonary-filter-<?php echo $id; ?>.uabb-masonary-current' ).trigger('click');
		}

		document_width = $( document ).width();
		document_height = $( document ).height();

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {

			var is_carousel = '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>';

			var child_id = jQuery(selector+' .fl-module-blog-posts').data('node');
			if( child_id != null ) {

				if( is_carousel == 'carousel' ) {
					jQuery( '.fl-node-' + child_id ).find( '.uabb-blog-posts-carousel' ).uabbslick('unslick');
				}

				var child_args = {
					id: child_id,
					is_carousel: '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>',
					infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
					arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,
					desktop: <?php echo ( '' != $settings->post_per_grid_desktop ) ? $settings->post_per_grid_desktop : 1; ?>,
					medium: <?php echo ( '' != $settings->post_per_grid_medium ) ? $settings->post_per_grid_medium : 1; ?>,
					small: <?php echo ( '' != $settings->post_per_grid_small ) ? $settings->post_per_grid_small : 1; ?>,
					slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
					autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
					autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
					small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
					medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
					equal_height_box: '<?php echo $settings->equal_height_box; ?>',
					blog_image_position: '<?php echo $settings->blog_image_position; ?>'
				};
				new UABBBlogPosts( child_args );
			}
		});

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {

			var is_carousel = '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>';

			var child_id = jQuery(selector+' .fl-module-blog-posts').data('node');
			if( child_id != null ) {

				if( is_carousel == 'carousel' ) {
					jQuery( '.fl-node-' + child_id ).find( '.uabb-blog-posts-carousel' ).uabbslick('unslick');
				}

				var child_args = {
					id: child_id,
					is_carousel: '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>',
					infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
					arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,
					desktop: <?php echo ( '' != $settings->post_per_grid_desktop ) ? $settings->post_per_grid_desktop : 1; ?>,
					medium: <?php echo ( '' != $settings->post_per_grid_medium ) ? $settings->post_per_grid_medium : 1; ?>,
					small: <?php echo ( '' != $settings->post_per_grid_small ) ? $settings->post_per_grid_small : 1; ?>,
					slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
					autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
					autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
					small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
					medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
					equal_height_box: '<?php echo $settings->equal_height_box; ?>',
					blog_image_position: '<?php echo $settings->blog_image_position; ?>'
				};
				new UABBBlogPosts( child_args );
			}
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			var is_carousel = '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>';

			var child_id = jQuery(selector+' .fl-module-blog-posts').data('node');
			if( child_id != null ) {

				if( is_carousel == 'carousel' ) {
					jQuery( '.fl-node-' + child_id ).find( '.uabb-blog-posts-carousel' ).uabbslick('unslick');
				}

				var child_args = {
					id: child_id,
					is_carousel: '<?php echo isset( $settings->is_carousel ) ? $settings->is_carousel : 'grid'; ?>',
					infinite: <?php echo ( 'yes' == $settings->infinite_loop ) ? 'true' : 'false'; ?>,
					arrows: <?php echo ( 'yes' == $settings->enable_arrow ) ? 'true' : 'false'; ?>,
					desktop: <?php echo ( '' != $settings->post_per_grid_desktop ) ? $settings->post_per_grid_desktop : 1; ?>,
					medium: <?php echo ( '' != $settings->post_per_grid_medium ) ? $settings->post_per_grid_medium : 1; ?>,
					small: <?php echo ( '' != $settings->post_per_grid_small ) ? $settings->post_per_grid_small : 1; ?>,
					slidesToScroll: <?php echo ( '' != $settings->slides_to_scroll ) ? $settings->slides_to_scroll : 1; ?>,
					autoplay: <?php echo ( 'yes' == $settings->autoplay ) ? 'true' : 'false'; ?>,
					autoplaySpeed: <?php echo ( '' != $settings->animation_speed ) ? $settings->animation_speed : '1000'; ?>,
					small_breakpoint: <?php echo $global_settings->responsive_breakpoint; ?>,
					medium_breakpoint: <?php echo $global_settings->medium_breakpoint; ?>,
					equal_height_box: '<?php echo $settings->equal_height_box; ?>',
					blog_image_position: '<?php echo $settings->blog_image_position; ?>'
				};
				new UABBBlogPosts( child_args );
			}

		});

	});

	jQuery(window).on("load", function() {

		new UABBBlogPosts( args );
	});

	jQuery(window).resize( function() {
		if( document_width != $( document ).width() || document_height != $( document ).height() ) {
			document_width = $( document ).width();
			document_height = $( document ).height();
			new UABBBlogPosts( args );
		}
	});

	new UABBBlogPosts( args );

})(jQuery);
