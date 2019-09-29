<?php
/*
 * Very experimental
 */
class mishaCustomSearch{

	function __construct(){

		/* exit if:
			no "s"
			global search option == off
			option == replace but individually the website is turned off
			option == widget but $_GET['msite'] is not exists
		*/
		if( !isset( $_GET['s'] )
		|| !get_site_option( 'postindexer_gsearch' )
		|| ( get_site_option( 'postindexer_gsearch' ) == 'replace' && 'yes' !== get_option( 'misha_network_search', 'no' ) )
		|| ( get_site_option( 'postindexer_gsearch' ) == 'widget' && ( !isset( $_GET['msite']) || $_GET['msite'] != 1 ) ) )
			return;

		add_action( 'template_redirect', array( $this, 'queryreplace' ));
		add_filter( 'post_link', array( $this, 'permalink' ), 10, 3 );
		add_filter( 'get_edit_post_link', array( $this, 'edit_link' ), 10, 3 );
		add_filter( 'pre_handle_404', array( $this, 'pagin404'), 1000, 2 );
		//add_filter( 'get_post_metadata', array( $this, 'thumb1'), 10, 4 );
		add_filter( 'post_thumbnail_html',array( $this, 'thumb2'), 10,5);
		//add_filter( 'get_the_terms',array( $this, 'terms'), 10,3);
		add_filter( 'the_category', array( $this, 'categories'), 10, 3 );
		add_filter( 'the_tags', array( $this, 'tags'), 10, 5 );
		add_filter( 'author_link', array( $this, 'author_url'), 10, 3 );
	}

	function queryreplace(){
		if( !isset( $_GET['s'] ) )
			return;

		global $wp_query;
		//print_r( $wp_query );
		$args = array(
			's' => get_search_query(),
			'post_type' => get_site_option( 'postindexer_globalposttypes', array( 'post' ) ),
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 )
		);
		//echo '###';
		$nq = new Network_Query( $args );
		//print_r( $nq );exit;
		$wp_query->posts = $nq->posts;
		$wp_query->post_count = $nq->post_count;
		$wp_query->found_posts = $nq->found_posts;
		$wp_query->query_vars = $nq->query_vars;
		$wp_query->max_num_pages = $nq->max_num_pages;
	}

	function permalink( $url, $post, $leavename=false ) {
		if( !isset( $_GET['s'] ) )
			return;
		//return print_r($post,true);
		//global $changed;
		if( !ms_is_switched() ) {

			switch_to_blog( $post->BLOG_ID );
				//$changed = 1;
				//$url = add_query_arg( time(), $post->BLOG_ID, get_permalink($post->ID) );
				$url = get_permalink($post->ID);

			restore_current_blog();
		}
		//$changed='';
		return $url;
	}

	function edit_link( $link, $post_id, $context ){
		if( !isset( $_GET['s'] ) )
			return;

		if( !ms_is_switched() ) {
			global $post;
			switch_to_blog( $post->BLOG_ID );
				$link = get_edit_post_link( $post->ID );
			restore_current_blog();

		}
		return $link;
	}

	function author_url( $link, $author_id, $author_nicename ) {
		if( !isset( $_GET['s'] ) )
			return;

		if( !ms_is_switched() ) {
			global $post;
			switch_to_blog( $post->BLOG_ID );
				$link = get_author_posts_url( $post->post_author );
			restore_current_blog();

		}
		return $link;
	}

	function thumb1( $null, $object_id, $meta_key, $single){
		if( !isset( $_GET['s'] ) )
			return;

			return 7;
		global $post;

		if( $meta_key == '_thumbnail_id' && $object_id == $post->ID && !ms_is_switched() ) {
			switch_to_blog( $post->BLOG_ID );
		}
	}

	function thumb2( $html, $post_id, $post_thumbnail_id, $size, $attr ){
		if( !isset( $_GET['s'] ) )
			return;

		if( !ms_is_switched() ) {
			global $post;
			switch_to_blog( $post->BLOG_ID );
				$html = get_the_post_thumbnail( $post->ID, $size, $attr );
			restore_current_blog();

		}
		return $html;
	}



	function terms( $terms, $post_id, $taxonomy ) {
		if( !isset( $_GET['s'] ) )
			return;

		global $post;

		if( !ms_is_switched() ) {

			switch_to_blog( $post->BLOG_ID );

				$terms = get_the_terms( $post, $taxonomy );

			restore_current_blog();
		}
		//$changed='';
		return $terms;
	}


	function categories( $thelist, $separator, $parents ) {
		if( !isset( $_GET['s'] ) )
			return;

		global $post;

		if( !ms_is_switched() ) {

			switch_to_blog( $post->BLOG_ID );

				$thelist = get_the_category_list($separator);

			restore_current_blog();
		}
		//$changed='';
		return $thelist;

	}

	function tags( $thelist, $before, $sep, $after, $id ) {
		if( !isset( $_GET['s'] ) )
			return;

		global $post;

		if( !ms_is_switched() ) {

			switch_to_blog( $post->BLOG_ID );

				$thelist = get_the_tag_list('', ', ');

			restore_current_blog();
		}
		//$changed='';
		return $thelist;

	}


	function pagin404( $false, $wp_query ) {
		if( !isset( $_GET['s'] ) )
			return;
		//print_r( $wp_query ); exit;
		return true;
	}
}


new mishaCustomSearch();
