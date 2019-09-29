<?php
add_action('network_admin_menu', 'misha_add_option_page');
function misha_add_option_page() {

	// есл отключено в настройках, то ничего добавлять не нужно
	if( get_site_option( 'hide_indexed_posts_page' ) == 'on' ) return;

    $hook = add_menu_page(
        __( "Multisite Posts", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN),
         __( "Multisite Posts", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN),
        'manage_network_options',
        'multisite_posts',
        'misha_show_all_multisite_posts',
        'dashicons-admin-post',
        5
    );

    /*add_action( "load-$hook", function () {
		add_screen_option( 'per_page', array(
			'label' => __( 'Number of items per page:' ),
			'default' => 20,
			'option' => 'mulsitite_posts_per_page', // название опции, будет записано в метаполе юзера
		) );
	} );


	// save before 'admin_menu'
	add_filter( 'set-screen-option', function( $status, $option, $value ){
		print_r( $option );exit;
		return ( $option == 'mulsitite_posts_per_page' ) ? (int) $value : $status;
	}, 10, 3 );*/

}



function misha_show_all_multisite_posts(){
?>
<div class="wrap">
<h1 class="wp-heading-inline"><?php _e( "Multisite Posts", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ?></h1>
<?php
	if( !empty( $_GET['s'] ) && $_GET['s'] )
		echo '<span class="subtitle">' . __( 'Search results for' ) . ' “' . $_GET['s'] . '”</span>';
?>
<hr class="wp-header-end">

<?php
/*
 * Post Statuses Tabs
 *
<h2 class="screen-reader-text">Filter posts list</h2><ul class="subsubsub">
	<li class="all"><a href="edit.php?post_type=post" class="current">All <span class="count">(14)</span></a> |</li>
	<li class="publish"><a href="edit.php?post_status=publish&amp;post_type=post">Published <span class="count">(13)</span></a> |</li>
	<li class="draft"><a href="edit.php?post_status=draft&amp;post_type=post">Draft <span class="count">(1)</span></a></li>
</ul>
*/ ?>

<form action="admin.php?page=multisite_posts" id="posts-filter" method="get" style="margin-top: -30px;">

<p class="search-box" style="margin-bottom: 10px;">
	<label class="screen-reader-text" for="post-search-input"><?php _e( 'Search Posts:' ) ?></label>
	<input type="search" id="post-search-input" name="s" value="<?php if( !empty( $_GET['s'] ) ) echo $_GET['s']; ?>">
	<input type="submit" id="search-submit" class="button" value="Search Posts">
</p>
	<input type="hidden" name="page" value="multisite_posts">
	<input type="hidden" name="post_status" class="post_status_page" value="all">
	<input type="hidden" name="post_type" class="post_type_page" value="post">
	<?php
		if( !empty( $_GET['orderby'] ) )
			echo '<input type="hidden" name="orderby" value="' . $_GET['orderby'] . '">';
		if( !empty( $_GET['order'] ) )
			echo '<input type="hidden" name="order" value="' . $_GET['order'] . '">';
	?>
	<div class="tablenav top">

<?php /*
<div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label><select name="action" id="bulk-action-selector-top">
				<option value="-1">Bulk Actions</option>
				<option value="edit" class="hide-if-no-js">Edit</option>
				<option value="trash">Move to Trash</option>
			</select>
			<input type="submit" id="doaction" class="button action" value="Apply">
</div>

<div class="alignleft actions">
		<label for="filter-by-date" class="screen-reader-text">Filter by date</label>
		<select name="m" id="filter-by-date">
			<option selected="selected" value="0">All dates</option>
		</select>
		<label class="screen-reader-text" for="cat">Filter by category</label><select name="cat" id="cat" class="postform">
			<option value="0">All Categories</option>
			<option class="level-0" value="55">Blog</option>
		</select>
		<input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
</div>
*/ ?>
<?php
	$args = array(
		'posts_per_page' => 20,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'any',
		'post_type' => 'any'
	);

	if( !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'title' )
		$args['orderby'] = 'title';

	if( !empty( $_GET['order'] ) && $_GET['order'] == 'asc' )
		$args['order'] = 'ASC';

	if( !empty( $_GET['s'] ) && $_GET['s'] )
		$args['s'] = $_GET['s'];

	if( !empty( $_GET['paged'] ) && $_GET['paged'] )
		$args['paged'] = $_GET['paged'];

	$q = new Network_Query( $args );

?>
<div class="tablenav-pages"><span class="displaying-num"><?php
	echo ( $q->found_posts == 1 ) ? $q->found_posts . ' item' : $q->found_posts . ' items';
?></span>

<?php misha_print_pagin( $q ); ?>

</div>
		<br class="clear">
	</div>


<h2 class="screen-reader-text">Posts list</h2><table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
		<?php /*<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td>*/ ?>
		<th scope="col" id="title" class="manage-column column-title column-primary <?php echo (!empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'sorted' : 'sortable' ?> <?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'desc' : 'asc' ?>"><a href="admin.php?page=multisite_posts&orderby=title&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'asc' : 'desc' ?>"><span><?php _e( 'Title' ) ?></span><span class="sorting-indicator"></span></a></th>
		<th scope="col" id="mishapostid" class="manage-column"><?php _e( 'Post ID' ) ?></th>
		<th scope="col" id="mishaposttype" class="manage-column"><?php _e( 'Post type', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) ?></th>
		<th scope="col" id="mishablogid" class="manage-column"><?php _e( 'Blog' ) ?></th>
		<th scope="col" id="date" class="manage-column column-date <?php echo (!empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'sorted' : 'sortable' ?> <?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'desc' : 'asc' ?>"><a href="admin.php?page=multisite_posts&orderby=date&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'asc' : 'desc' ?>"><span><?php _e('Date' ) ?></span><span class="sorting-indicator"></span></a></th>
	</tr>
	</thead>

	<tbody id="the-list">
		<?php
		if( $q->have_posts() ) :
		while( $q->have_posts() ) : $q->the_post();
			//$dashboard = get_blogaddress_by_id( $q->post->BLOG_ID );
			$blog_details = get_blog_details( $q->post->BLOG_ID );
			$dashboard = $blog_details->siteurl;

		?>
		<tr id="post-<?php echo $q->post->ID ?>" class="iedit author-self level-0 post-1170 type-post status-draft format-standard hentry category-uncategorized">
			<?php /* <th scope="row" class="check-column"><label class="screen-reader-text" for="cb-select-1170">Select (no title)</label>
			<input id="cb-select-1170" type="checkbox" name="post[]" value="1170">
			<div class="locked-indicator">
				<span class="locked-indicator-icon" aria-hidden="true"></span>
				<span class="screen-reader-text">“(no title)” is locked</span>
			</div>
			</th> */ ?>
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title"><div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="<?php echo $dashboard ?>/wp-admin/post.php?post=<?php echo $q->post->ID ?>&amp;action=edit"><?php echo $q->post->post_title ?></a></strong>

				<div class="row-actions">
					<span class="edit"><a href="<?php echo $dashboard ?>/wp-admin/post.php?post=<?php echo $q->post->ID ?>&amp;action=edit" aria-label="Edit “(no title)”"><?php _e('Edit') ?></a> | </span>
					<span class="trash"><a href="#" data-id="<?php echo $q->post->ID ?>" data-blogid="<?php echo $q->post->BLOG_ID ?>" class="multisitesubmitdelete" aria-label="Move “(no title)” to the Trash"><?php _e('Delete') ?></a> | </span>
					<span class="view"><a href="<?php echo $dashboard ?>/?p=<?php echo $q->post->ID ?>" rel="bookmark" aria-label="Preview “(no title)”"><?php _e('Preview') ?></a></span>
				</div>
			</td>
			<td><?php echo $q->post->ID ?></td>
			<td><?php echo $q->post->post_type ?></td>
			<td>#<?php echo $q->post->BLOG_ID ?> <a href="<?php echo $dashboard ?>/wp-admin"><?php echo $blog_details->blogname ?></a></td>
			<td class="date column-date" data-colname="Date"><?php misha_column_date( $q->post ) ?></td>
		</tr>
		<?php endwhile;
		else : ?>
		<tr class="no-items"><td class="colspanchange" colspan="4"><?php _e('No posts found.') ?></td></tr>
		<?php endif; ?>
	</tbody>

	<tfoot>
	<tr>
		<?php /*<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td>*/ ?>
		<th scope="col" id="title" class="manage-column column-title column-primary <?php echo (!empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'sorted' : 'sortable' ?> <?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'desc' : 'asc' ?>"><a href="admin.php?page=multisite_posts&orderby=title&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'title' ) ? 'asc' : 'desc' ?>"><span><?php _e( 'Title' ) ?></span><span class="sorting-indicator"></span></a></th>
		<th scope="col" id="mishapostid" class="manage-column"><?php _e( 'Post ID' ) ?></th>
		<th scope="col" id="mishaposttype" class="manage-column"><?php _e( 'Post type', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) ?></th>
		<th scope="col" id="mishablogid" class="manage-column"><?php _e( 'Blog' ) ?></th>
		<th scope="col" id="date" class="manage-column column-date <?php echo (!empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'sorted' : 'sortable' ?> <?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'desc' : 'asc' ?>"><a href="admin.php?page=multisite_posts&orderby=date&order=<?php echo (!empty($_GET['order']) && $_GET['order'] == 'desc' && !empty($_GET['orderby']) && $_GET['orderby'] == 'date' ) ? 'asc' : 'desc' ?>"><span><?php _e('Date' ) ?></span><span class="sorting-indicator"></span></a></th>
	</tr>
	</tfoot>

</table>
	<div class="tablenav bottom">

		<?php /* <div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="action2" id="bulk-action-selector-bottom">
				<option value="-1">Bulk Actions</option>
				<option value="edit" class="hide-if-no-js">Edit</option>
				<option value="trash">Move to Trash</option>
			</select>
			<input type="submit" id="doaction2" class="button action" value="Apply">
		</div> */ ?>
		<div class="alignleft actions">
		</div>
		<div class="tablenav-pages">
			<span class="displaying-num"><?php
				echo ( $q->found_posts == 1 ) ? $q->found_posts . ' item' : $q->found_posts . ' items';
			?></span>

			<?php echo misha_print_pagin( $q, true ); ?>

</div>
			<br class="clear">
		</div>

</form>

<div id="ajax-response"></div>
<br class="clear">
</div>
<?php
}



function misha_column_date( $post ) {
	global $mode;

	if ( '0000-00-00 00:00:00' === $post->post_date ) {
		$t_time = $h_time = __( 'Unpublished' );
		$time_diff = 0;
	} else {
		$t_time = get_the_time( __( 'Y/m/d g:i:s a' ), $post );
		$m_time = $post->post_date;
		$time = get_post_time( 'G', true, $post );

		$time_diff = time() - $time;

		if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS ) {
			$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
		} else {
			$h_time = mysql2date( __( 'Y/m/d' ), $m_time );
		}
	}

	if ( 'publish' === $post->post_status ) {
			$status = __( 'Published' );
		} elseif ( 'future' === $post->post_status ) {
			if ( $time_diff > 0 ) {
				$status = '<strong class="error-message">' . __( 'Missed schedule' ) . '</strong>';
			} else {
				$status = __( 'Scheduled' );
			}
		} else {
			$status = __( 'Last Modified' );
		}
	$status = apply_filters( 'post_date_column_status', $status, $post, 'date', $mode );

		if ( $status ) {
			echo $status . '<br />';
		}

		if ( 'excerpt' === $mode ) {
			/**
			 * Filters the published time of the post.
			 *
			 * If `$mode` equals 'excerpt', the published time and date are both displayed.
			 * If `$mode` equals 'list' (default), the publish date is displayed, with the
			 * time and date together available as an abbreviation definition.
			 *
			 * @since 2.5.1
			 *
			 * @param string  $t_time      The published time.
			 * @param WP_Post $post        Post object.
			 * @param string  $column_name The column name.
			 * @param string  $mode        The list display mode ('excerpt' or 'list').
			 */
			echo apply_filters( 'post_date_column_time', $t_time, $post, 'date', $mode );
		} else {

			/** This filter is documented in wp-admin/includes/class-wp-posts-list-table.php */
			echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'date', $mode ) . '</abbr>';
		}
}


function misha_print_pagin( $query, $noinput = false ){

	// do nothing if only one page
	if( $query->max_num_pages < 2 )
		return;

	$current_page = $query->query_vars['paged'] ? $query->query_vars['paged'] : 1;

	?><span class="pagination-links"><?php

	// first arrow
	if( $current_page == 1 || $current_page == 2 ) {
		echo '<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>';
	} else {
		echo '<a class="prev-page" href="' . $_SERVER['REQUEST_URI'] . '&paged=1"><span class="screen-reader-text">' . _('First page') . '</span><span aria-hidden="true">&laquo;</span></a>';
	}

	if( $current_page == 1 ) {
		echo ' <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>';
	} else {
		echo ' <a class="prev-page" href="' . $_SERVER['REQUEST_URI'] . '&paged=' . ( $current_page - 1 ) . '"><span class="screen-reader-text">' . _('Previous page') . '</span><span aria-hidden="true">‹</span></a>';
	}
	?>


	<span class="paging-input">
		<label for="current-page-selector" class="screen-reader-text"><?php _e('Current Page') ?></label>
		<?php if( $noinput == false ) : ?>
			<input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo $current_page ?>" size="1" aria-describedby="table-paging">
		<?php endif; ?>
		<span class="tablenav-paging-text"><?php if( $noinput == true ) echo $current_page ?> of <span class="total-pages"><?php echo $query->max_num_pages ?></span></span>
	</span>

	<?php
	// Last arrows

	if( $current_page == $query->max_num_pages ) {
		echo '<span class="tablenav-pages-navspan" aria-hidden="true">›</span>';
	} else {
		echo '<a class="next-page" href="' . $_SERVER['REQUEST_URI'] . '&paged=' . ( $current_page + 1 ) . '"><span class="screen-reader-text">' . _('Next page') . '</span><span aria-hidden="true">›</span></a>';
	}

	if( $current_page == $query->max_num_pages || $current_page == ($query->max_num_pages - 1) ) {
		echo ' <span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>';
	} else {
		echo ' <a class="last-page" href="' . $_SERVER['REQUEST_URI'] . '&paged=' . $query->max_num_pages . '"><span class="screen-reader-text">' . _('Last page') . '</span><span aria-hidden="true">&raquo;</span></a>';
	}

}



add_action( 'admin_footer', 'misha_move_trash' );
function misha_move_trash(){
?><script>
jQuery(function($){
$('.multisitesubmitdelete').click(function(){
	var link = $(this),
		li = link.parent().parent().parent().parent(),
		title = li.find('.row-title').text();

	link.text('Moving to trash...');

	$.ajax({
		method:'POST',
		url: ajaxurl,
		data: 'action=multisitetotrash&id=' + link.attr('data-id') + '&blogid=' + link.attr('data-blogid') + '&_wpnonce=<?php echo wp_create_nonce( "misha_post_to_trash" ) ?>',
		success : function( data ) {

			li.css('background','#ffafaf').fadeOut(300, function(){
				li.removeAttr('style').html('<td colspan="4" class="plugin-update colspanchange"><strong>' + title + '</strong> was successfully moved to trash.</td>').show();
			});

		}
	});

	return false;
});

});
</script><?php
}



add_action('wp_ajax_multisitetotrash', 'misha_ajax_to_trash');
function misha_ajax_to_trash(){

	check_ajax_referer( 'misha_post_to_trash', $_POST['_wpnonce'] );

	switch_to_blog( $_POST['blogid'] );
	wp_trash_post( $_POST['id'] );
	echo 'ok';
	die;

}
