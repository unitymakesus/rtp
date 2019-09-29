<?php
/*
 * This file is part of True Multisite Indexer.
 * True Multisite Indexer is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * True Multisite Indexer is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with Foobar. If not, see http://www.gnu.org/licenses/.
 *
 * All the functions below based on existing WordPress functions but tweaked
 */
function network_the_title($before = '', $after = '', $echo = true) {
 	$title = network_get_the_title();

 	if ( strlen($title) == 0 )
 		return;

 	$title = $before . $title . $after;

 	if ( $echo )
 		echo $title;
 	else
 		return $title;
 }

 function network_the_title_attribute( $args = '' ) {
 	$title = network_get_the_title();

 	if ( strlen($title) == 0 )
 		return;

 	$defaults = array('before' => '', 'after' =>  '', 'echo' => true);
 	$r = wp_parse_args($args, $defaults);
 	extract( $r, EXTR_SKIP );

 	$title = $before . $title . $after;
 	$title = esc_attr(strip_tags($title));

 	if ( $echo )
 		echo $title;
 	else
 		return $title;
 }

 function network_get_the_title( $blog_id = 0, $id = 0 ) {

 	$network_post = &network_get_post( $blog_id, $id );

 	$title = isset($network_post->post_title) ? $network_post->post_title : '';
 	$id = isset($network_post->ID) ? $network_post->ID : (int) $id;

 	return apply_filters( 'network_the_title', $title, $id );
 }

 function network_get_the_title_rss() {
 	$title = network_get_the_title();
 	$title = apply_filters('network_the_title_rss', $title);
 	return $title;
 }

 function network_the_title_rss() {
 	echo network_get_the_title_rss();
 }

 function network_get_the_content_feed($feed_type = null) {
 	if ( !$feed_type )
 		$feed_type = get_default_feed();

 	$content = apply_filters('network_the_content', network_get_the_content());
 	$content = str_replace(']]>', ']]&gt;', $content);
 	return apply_filters('network_the_content_feed', $content, $feed_type);
 }

 function network_the_content_feed($feed_type = null) {
 	echo network_get_the_content_feed($feed_type);
 }

 function network_the_excerpt_rss() {
 	$output = network_get_the_excerpt();
 	echo apply_filters('network_the_excerpt_rss', $output);
 }

 function network_get_permalink( $blog_id = 0, $id = 0 ) {

 	$post = &network_get_post( $blog_id, $id );

 	if(!empty($post)) {
 		switch_to_blog( $post->BLOG_ID );
 		$permalink = get_permalink( $post->ID );
 		restore_current_blog();

 		return $permalink;
 	}
 }

 function network_the_permalink_rss() {
 	echo esc_url( apply_filters('network_the_permalink_rss', network_get_permalink() ));
 }

 function network_comments_link_feed() {
 	echo esc_url( network_get_comments_link() );
 }

 function network_get_comments_link() {
 	return network_get_permalink() . '#comments';
 }

 function network_get_post_comments_feed_link( $blog_id = 0, $id = 0 ) {

 	$post = &network_get_post( $blog_id, $id );

 	if(!empty($post)) {
 		switch_to_blog( $post->BLOG_ID );
 		$feedlink = get_post_comments_feed_link( $post->ID );
 		restore_current_blog();

 		return $feedlink;
 	}

 }

 function network_get_comments_number( $blog_id = 0, $id = 0 ) {

 	$post = &network_get_post( $blog_id, $id );

 	if(!empty($post)) {
 		switch_to_blog( $post->BLOG_ID );
 		$number = get_comments_number( $post->ID );
 		restore_current_blog();

 		return $number;
 	}

 }

 function network_get_object_terms( $blog_id, $object_ids, $taxonomies, $args = array()) {
 	global $wpdb;

 	if ( empty( $object_ids ) || empty( $taxonomies ) )
 		return array();

 	if ( !is_array($taxonomies) )
 		$taxonomies = array($taxonomies);

 	if ( !is_array($object_ids) )
 		$object_ids = array($object_ids);

 	$object_ids = array_map('intval', $object_ids);

 	$defaults = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
 	$args = wp_parse_args( $args, $defaults );

 	extract($args, EXTR_SKIP);

 	if ( 'count' == $orderby )
 		$orderby = 'tt.count';
 	else if ( 'name' == $orderby )
 		$orderby = 't.name';
 	else if ( 'slug' == $orderby )
 		$orderby = 't.slug';
 	else if ( 'term_group' == $orderby )
 		$orderby = 't.term_group';
 	else if ( 'term_order' == $orderby )
 		$orderby = 'tr.term_order';
 	else if ( 'none' == $orderby ) {
 		$orderby = '';
 		$order = '';
 	} else {
 		$orderby = 't.term_id';
 	}

 	// tt_ids queries can only be none or tr.term_taxonomy_id
 	if ( ('tt_ids' == $fields) && !empty($orderby) )
 		$orderby = 'tr.term_taxonomy_id';

 	if ( !empty($orderby) )
 		$orderby = "ORDER BY $orderby";

 	$order = strtoupper( $order );
 	if ( '' !== $order && ! in_array( $order, array( 'ASC', 'DESC' ) ) )
 		$order = 'ASC';

 	$taxonomies = "'" . implode("', '", $taxonomies) . "'";
 	$object_ids = implode(', ', $object_ids);

 	$select_this = '';
 	if ( 'all' == $fields )
 		$select_this = 't.*, tt.*';
 	else if ( 'ids' == $fields )
 		$select_this = 't.term_id';
 	else if ( 'names' == $fields )
 		$select_this = 't.name';
 	else if ( 'slugs' == $fields )
 		$select_this = 't.slug';
 	else if ( 'all_with_object_id' == $fields )
 		$select_this = 't.*, tt.*, tr.object_id';

 	$query = "SELECT $select_this FROM {$wpdb->base_prefix}network_terms AS t INNER JOIN {$wpdb->base_prefix}network_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN {$wpdb->base_prefix}network_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tr.blog_id = {$blog_id} AND tt.taxonomy IN ($taxonomies) AND tr.object_id IN ($object_ids) $orderby $order";

 	if ( 'all' == $fields || 'all_with_object_id' == $fields ) {
 		$terms = $wpdb->get_results($query);
 	} else if ( 'ids' == $fields || 'names' == $fields || 'slugs' == $fields ) {
 		$terms = $wpdb->get_col($query);
 	} else if ( 'tt_ids' == $fields ) {
 		$terms = $wpdb->get_col("SELECT tr.term_taxonomy_id FROM {$wpdb->base_prefix}network_term_relationships AS tr INNER JOIN {$wpdb->base_prefix}term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE  tr.blog_id = {$blog_id} AND tr.object_id IN ($object_ids) AND tt.taxonomy IN ($taxonomies) $orderby $order");
 	}

 	if ( ! $terms )
 		$terms = array();

 	return apply_filters('network_get_object_terms', $terms, $object_ids, $taxonomies, $args);
 }

 function network_term_is_tag( $tag ) {

 	$model = new multisiteIndexer();

 	return $model->term_is_tag( $tag );
 }

 function network_term_is_category( $cat ) {

 	$model = new multisiteIndexer();

 	return $model->term_is_category( $tag );

 }

 function network_get_the_terms( $blog_id, $id, $taxonomy ) {

 	$post = &network_get_post( (int) $blog_id, (int) $id);

 	$terms = network_get_object_terms( $post->BLOG_ID, $post->ID, $taxonomy );

 	$terms = apply_filters( 'network_get_the_terms', $terms, $id, $taxonomy );

 	if ( empty( $terms ) )
 		return false;

 	return $terms;
 }

 function network_get_the_category( $blog_id = 0, $id = 0 ) {

 	$categories = network_get_the_terms( $blog_id, $id, 'category' );
 	if ( ! $categories )
 		$categories = array();

 	$categories = array_values( $categories );

 	foreach ( array_keys( $categories ) as $key ) {
 		_make_cat_compat( $categories[$key] );
 	}

 	// Filter name is plural because we return alot of categories (possibly more than #13237) not just one
 	return apply_filters( 'network_get_the_categories', $categories );
 }

 function network_get_the_tags( $blog_id = 0, $id = 0 ) {
 	return apply_filters( 'network_get_the_tags', network_get_the_terms( $blog_id, $id, 'post_tag' ) );
 }

 function network_get_the_category_rss($type = null) {
 	if ( empty($type) )
 		$type = get_default_feed();

 	$categories = network_get_the_category();
 	$tags = network_get_the_tags();

 	$the_list = '';
 	$cat_names = array();

 	$filter = 'rss';
 	if ( 'atom' == $type )
 		$filter = 'raw';

 	if ( !empty($categories) ) foreach ( (array) $categories as $category ) {
 		$cat_names[] = sanitize_term_field('name', $category->name, $category->term_id, 'category', $filter);
 	}

 	if ( !empty($tags) ) foreach ( (array) $tags as $tag ) {
 		$cat_names[] = sanitize_term_field('name', $tag->name, $tag->term_id, 'post_tag', $filter);
 	}

 	$cat_names = array_unique($cat_names);

 	foreach ( $cat_names as $cat_name ) {
 		if ( 'rdf' == $type )
 			$the_list .= "\t\t<dc:subject><![CDATA[$cat_name]]></dc:subject>\n";
 		elseif ( 'atom' == $type )
 			$the_list .= sprintf( '<category scheme="%1$s" term="%2$s" />', esc_attr( apply_filters( 'get_bloginfo_rss', get_bloginfo( 'url' ) ) ), esc_attr( $cat_name ) );
 		else
 			$the_list .= "\t\t<category><![CDATA[" . @html_entity_decode( $cat_name, ENT_COMPAT, get_option('blog_charset') ) . "]]></category>\n";
 	}

 	return apply_filters('network_the_category_rss', $the_list, $type);
 }

 function network_the_category_rss($type = null) {
 	echo network_get_the_category_rss($type);
 }



 function network_the_ID() {
 	echo network_get_the_ID();
 }

 function network_get_the_ID() {
 	global $network_post;

 	return $network_post->ID;
 }


 function network_the_content($more_link_text = null, $stripteaser = false) {
 	$content = network_get_the_content($more_link_text, $stripteaser);
 	$content = apply_filters('network_the_content', $content);
 	$content = str_replace(']]>', ']]&gt;', $content);
 	echo $content;
 }

 function network_get_the_content($more_link_text = null, $stripteaser = false) {
 	global $network_post, $more, $page, $pages, $multipage, $preview;

 	if ( null === $more_link_text )
 		$more_link_text = __( '(more...)' );

 	$output = '';
 	$hasTeaser = false;

 	if ( $page > count($pages) ) // if the requested page doesn't exist
 		$page = count($pages); // give them the highest numbered page that DOES exist

 	$content = $pages[$page-1];
 	if ( preg_match('/<!--more(.*?)?-->/', $content, $matches) ) {
 		$content = explode($matches[0], $content, 2);
 		if ( !empty($matches[1]) && !empty($more_link_text) )
 			$more_link_text = strip_tags(wp_kses_no_null(trim($matches[1])));

 		$hasTeaser = true;
 	} else {
 		$content = array($content);
 	}
 	if ( (false !== strpos($network_post->post_content, '<!--noteaser-->') && ((!$multipage) || ($page==1))) )
 		$stripteaser = true;
 	$teaser = $content[0];
 	if ( $more && $stripteaser && $hasTeaser )
 		$teaser = '';
 	$output .= $teaser;
 	if ( count($content) > 1 ) {
 		if ( $more ) {
 			$output .= '<span id="more-' . $post->ID . '"></span>' . $content[1];
 		} else {
 			if ( ! empty($more_link_text) ) {
 				$output .= apply_filters( 'network_the_content_more_link', ' <a href="' . network_get_permalink( $network_post->BLOG_ID, $network_post->ID ) . "#more-{$network_post->ID}\" class=\"more-link\">$more_link_text</a>", $more_link_text );
 			}
 			$output = force_balance_tags($output);
 		}

 	}
 	if ( $preview ) // preview fix for javascript bug with foreign languages
 		$output =	preg_replace_callback('/\%u([0-9A-F]{4})/', '_convert_urlencoded_to_entities', $output);

 	return $output;
 }

 function network_the_excerpt() {
 	echo apply_filters('network_the_excerpt', network_get_the_excerpt());
 }

 function network_get_the_excerpt() {
 	global $network_post, $post;

 	$output = $network_post->post_excerpt;

 	// back up post as we need it later
 	$oldpost = $post;
 	// set the post to our network post
 	$post = $network_post;
 	// get the excerpt
 	$excerpt = apply_filters('get_the_excerpt', $output);
 	// reset the post variable in case it's needed elsewhere
 	$post = $oldpost;
 	// return the excerpt
 	return $excerpt;
 }

 function network_get_post_time( $d = 'U', $gmt = false, $post = null, $translate = false ) { // returns timestamp
 	global $network_post;

 	$post = &network_get_post( $network_post->BLOG_ID, $network_post->ID );

 	if ( $gmt )
 		$time = $post->post_date_gmt;
 	else
 		$time = $post->post_date;

 	$time = mysql2date($d, $time, $translate);
 	return apply_filters('network_get_post_time', $time, $d, $gmt);
 }

 function network_get_the_author() {

 	global $wpdb;

 	$post = &network_get_post();

 	if(!empty($post)) {
 		$author_id = $post->post_author;

 		$sql = $wpdb->prepare( "SELECT * FROM {$wpdb->users} WHERE ID = %d", $author_id );
 		$author = $wpdb->get_row( $sql );

 		if(is_object($author)) {
 			return $author->display_name;
 		} else {
 			return false;
 		}
 	}

 	return apply_filters('network_the_author', is_object($authordata) ? $authordata->display_name : null);
 }

 function network_get_the_author_id() {

 	global $wpdb;

 	$post = &network_get_post();

 	if(!empty($post)) {
 		$author_id = $post->post_author;

 		if(!empty($author_id)) {
 			return $author_id;
 		} else {
 			return false;
 		}
 	}

 	return apply_filters('network_the_author', is_object($authordata) ? $authordata->display_name : null);
 }

 function network_the_author() {
 	echo network_get_the_author();
 }

 function &network_get_post( $blog_id = 0, $network_post_id = 0, $output = OBJECT, $filter = 'raw') {
 	global $wpdb, $network_post;

 	$blog_id = (int) $blog_id;
 	$network_post_id = (int) $network_post_id;

 	if($blog_id == 0 && $network_post_id == 0 && is_object( $network_post )) {
 		$blog_id = $network_post->BLOG_ID;
 		$network_post_id = $network_post->ID;
 	}

 	if( is_object($network_post) && $network_post->BLOG_ID == $blog_id && $network_post->ID == $network_post_id ) {
 		$_network_post = $network_post;
 	} else {
 		$model = new multisiteIndexer();

 		$_network_post = $model->get_post( $blog_id, $network_post_id );
 		$_network_post = sanitize_post($_network_post, 'raw');
 	}

 	if ($filter != 'raw') {
 		$_network_post = sanitize_post($_network_post, $filter);
 	}

 	if ( $output == OBJECT ) {
 		return $_network_post;
 	} elseif ( $output == ARRAY_A ) {
 		$_network_post = get_object_vars($_network_post);
 		return $_network_post;
 	} elseif ( $output == ARRAY_N ) {
 		$_network_post = array_values(get_object_vars($_network_post));
 		return $_network_post;
 	} else {
 		return $_network_post;
 	}


 }

 function network_get_lastpostmodified( $timezone = 'server', $post_types = 'post'  ) {

 	global $wpdb;

 	$add_seconds_server = date('Z');

 	if(!is_array($post_types)) {
 		$post_types = array( $post_types );
 	}

 	$post_types = "'" . implode( "', '", $post_types ) . "'";

 	switch ( strtolower($timezone) ) {
 		case 'gmt':
 			$date = $wpdb->get_var("SELECT post_modified_gmt FROM {$wpdb->base_prefix}network_posts WHERE post_status = 'publish' AND post_type IN ({$post_types}) ORDER BY post_modified_gmt DESC LIMIT 1");
 			break;
 		case 'blog':
 			$date = $wpdb->get_var("SELECT post_modified FROM {$wpdb->base_prefix}network_posts WHERE post_status = 'publish' AND post_type IN ({$post_types}) ORDER BY post_modified_gmt DESC LIMIT 1");
 			break;
 		case 'server':
 			$date = $wpdb->get_var("SELECT DATE_ADD(post_modified_gmt, INTERVAL '$add_seconds_server' SECOND) FROM {$wpdb->base_prefix}network_posts WHERE post_status = 'publish' AND post_type IN ({$post_types}) ORDER BY post_modified_gmt DESC LIMIT 1");
 			break;
 	}

 	return $date;

 }

 /*
  * @Misha Rusrastyh
  * get_terms as it
  */
 function network_get_terms( $taxonomies, $args = '' ) {
         global $wpdb;
         $empty_array = array();

 		/* proverka taksonomii */
         $single_taxonomy = ! is_array( $taxonomies ) || 1 === count( $taxonomies );
         if ( ! is_array( $taxonomies ) ) {
                 $taxonomies = array( $taxonomies );
         }

     	/* parametri po umilchaniyu */
         $defaults = array('orderby' => 'name', 'order' => 'ASC',
                 'hide_empty' => false, 'exclude' => array(), 'include' => array(),
                 'number' => '', 'fields' => 'all', 'name' => '', 'slug' => '', 'parent' => '',
                 'name__like' => '', 'description__like' => '',
                'offset' => '', 'search' => '', 'cache_domain' => 'core' );
         $args = wp_parse_args( $args, $defaults );
         $args['number'] = absint( $args['number'] );
         $args['offset'] = absint( $args['offset'] );


         /**
          * Filter the terms query arguments.
          *
          * @since 3.1.0
          *
          * @param array $args       An array of arguments.
          * @param array $taxonomies An array of taxonomies.
          */
         $args = apply_filters( 'network_get_terms_args', $args, $taxonomies );




         // Avoid the query if the queried parent/child_of term has no descendants.

         $parent   = $args['parent'];



         // $args can be whatever, only use the args defined in defaults to compute the key
         /* otkluchil cache
         $filter_key = ( has_filter('list_terms_exclusions') ) ? serialize($GLOBALS['wp_filter']['list_terms_exclusions']) : '';
         $key = md5( serialize( wp_array_slice_assoc( $args, array_keys( $defaults ) ) ) . serialize( $taxonomies ) . $filter_key );
         $last_changed = wp_cache_get( 'last_changed', 'terms' );
         if ( ! $last_changed ) {
                 $last_changed = microtime();
                 wp_cache_set( 'last_changed', $last_changed, 'terms' );
         }
         $cache_key = "get_terms:$key:$last_changed";
         $cache = wp_cache_get( $cache_key, 'terms' );
         if ( false !== $cache ) {

                 /**
                  * Filter the given taxonomy's terms cache.
                  *
                  * @since 2.3.0
                  *
                  * @param array $cache      Cached array of terms for the given taxonomy.
                  * @param array $taxonomies An array of taxonomies.
                  * @param array $args       An array of arguments to get terms.
                  *
                 $cache = apply_filters( 'network_get_terms', $cache, $taxonomies, $args );
                 return $cache;
         }
         */

 		/* parametri sortirovki */
         $_orderby = strtolower( $args['orderby'] );
         if ( 'count' == $_orderby ) {
                 $orderby = 'tt.count';
         } elseif ( 'name' == $_orderby ) {
                 $orderby = 't.name';
         } elseif ( 'slug' == $_orderby ) {
                 $orderby = 't.slug';
         } elseif ( 'include' == $_orderby && ! empty( $args['include'] ) ) {
                 $include = implode( ',', array_map( 'absint', $args['include'] ) );
                 $orderby = "FIELD( t.term_local_id, $include )";
         } elseif ( 'term_group' == $_orderby ) {
                 $orderby = 't.term_group';
         } elseif ( 'description' == $_orderby ) {
                 $orderby = 'tt.description';
         } elseif ( 'none' == $_orderby ) {
                 $orderby = '';
         } elseif ( empty($_orderby) || 'id' == $_orderby ) {
                 $orderby = 't.term_local_id'; // sortirovka po local id
         } else {
                 $orderby = 't.name';
         }
         /**
          * Filter the ORDERBY clause of the terms query.
          *
          * @since 2.8.0
          *
          * @param string $orderby    ORDERBY clause of the terms query.
          * @param array  $args       An array of terms query arguments.
          * @param array  $taxonomies An array of taxonomies.
          */
         $orderby = apply_filters( 'network_get_terms_orderby', $orderby, $args, $taxonomies );


         $order = strtoupper( $args['order'] );
         if ( ! empty( $orderby ) ) {
                 $orderby = "ORDER BY $orderby";
         } else {
                 $order = '';
         }

         if ( '' !== $order && ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
                 $order = 'ASC';
         }

 		/* vkluchaem neobhodimie taksonomii */
         $where = "tt.taxonomy IN ('" . implode("', '", $taxonomies) . "')";

         $exclude = $args['exclude'];
         $include = $args['include'];

         $inclusions = '';
         if ( ! empty( $include ) ) {
                 $exclude = '';
                 $inclusions = implode( ',', wp_parse_id_list( $include ) );
         }

         if ( ! empty( $inclusions ) ) {
                 $inclusions = ' AND t.term_local_id IN ( ' . $inclusions . ' )';
                 $where .= $inclusions;
         }

         $exclusions = '';

         if ( ! empty( $exclude ) ) {
                 $exclusions = implode( ',', wp_parse_id_list( $exclude ) );
         }

         if ( ! empty( $exclusions ) ) {
                 $exclusions = ' AND t.term_local_id NOT IN (' . $exclusions . ')';
         } else {
                 $exclusions = '';
         }

         /**
          * Filter the terms to exclude from the terms query.
          *
          * @since 2.3.0
          *
          * @param string $exclusions NOT IN clause of the terms query.
          * @param array  $args       An array of terms query arguments.
          * @param array  $taxonomies An array of taxonomies.
          */
         $exclusions = apply_filters( 'network_list_terms_exclusions', $exclusions, $args, $taxonomies );

         if ( ! empty( $exclusions ) ) {
                 $where .= $exclusions;
         }


 		/* nazvanie taksonomii */
         if ( ! empty( $args['name'] ) ) {
                 if ( is_array( $args['name'] ) ) {
                         $name = array_map( 'sanitize_text_field', $args['name'] );
                         $where .= " AND t.name IN ('" . implode( "', '", array_map( 'esc_sql', $name ) ) . "')";
                 } else {
                         $name = sanitize_text_field( $args['name'] );
                         $where .= $wpdb->prepare( " AND t.name = %s", $name );
                 }
         }

 		/* yarlik taksonomii */
         if ( ! empty( $args['slug'] ) ) {
                 if ( is_array( $args['slug'] ) ) {
                         $slug = array_map( 'sanitize_title', $args['slug'] );
                         $where .= " AND t.slug IN ('" . implode( "', '", $slug ) . "')";
                 } else {
                         $slug = sanitize_title( $args['slug'] );
                         $where .= " AND t.slug = '$slug'";
                 }
         }

         if ( ! empty( $args['name__like'] ) ) {
                 $where .= $wpdb->prepare( " AND t.name LIKE %s", '%' . $wpdb->esc_like( $args['name__like'] ) . '%' );
         }

         if ( ! empty( $args['description__like'] ) ) {
                 $where .= $wpdb->prepare( " AND tt.description LIKE %s", '%' . $wpdb->esc_like( $args['description__like'] ) . '%' );
         }

         if ( '' !== $parent ) {
                 $parent = (int) $parent;
                 $where .= " AND tt.parent = '$parent'";
         }


         if ( $args['hide_empty'] ) {
                 $where .= ' AND tt.count > 0';
         }

         $number = $args['number'];
         $offset = $args['offset'];

         // offset
         if ( $number ) {
                 if ( $offset ) {
                         $limits = 'LIMIT ' . $offset . ',' . $number;
                 } else {
                         $limits = 'LIMIT ' . $number;
                 }
         } else {
                 $limits = '';
         }

         if ( ! empty( $args['search'] ) ) {
                 $like = '%' . $wpdb->esc_like( $args['search'] ) . '%';
                 $where .= $wpdb->prepare( ' AND ((t.name LIKE %s) OR (t.slug LIKE %s))', $like, $like );
         }

         $selects = array();
         switch ( $args['fields'] ) {
                 case 'all':
                         $selects = array( 't.*', 'tt.*' );
                         break;
                 case 'ids':
                 case 'id=>parent':
                         $selects = array( 't.term_local_id', 'tt.parent', 'tt.count', 'tt.taxonomy' );
                         break;
                 case 'names':
                         $selects = array( 't.term_id', 'tt.parent', 'tt.count', 't.name', 'tt.taxonomy' );
                         break;
                 case 'count':
                         $orderby = '';
                         $order = '';
                         $selects = array( 'COUNT(*)' );
                         break;
                 case 'id=>name':
                         $selects = array( 't.term_id', 't.name', 'tt.count', 'tt.taxonomy' );
                         break;
                 case 'id=>slug':
                         $selects = array( 't.term_id', 't.slug', 'tt.count', 'tt.taxonomy' );
                         break;
         }

         $_fields = $args['fields'];

         /**
          * Filter the fields to select in the terms query.
          *
          * Field lists modified using this filter will only modify the term fields returned
          * by the function when the `$fields` parameter set to 'count' or 'all'. In all other
          * cases, the term fields in the results array will be determined by the `$fields`
          * parameter alone.
          *
          * Use of this filter can result in unpredictable behavior, and is not recommended.
          *
          * @since 2.8.0
          *
          * @param array $selects    An array of fields to select for the terms query.
          * @param array $args       An array of term query arguments.
          * @param array $taxonomies An array of taxonomies.
          */
         $fields = implode( ', ', apply_filters( 'network_get_terms_fields', $selects, $args, $taxonomies ) );

         $join = "INNER JOIN {$wpdb->base_prefix}network_term_taxonomy AS tt ON t.term_id = tt.term_id";

         $pieces = array( 'fields', 'join', 'where', 'orderby', 'order', 'limits' );

         /**
          * Filter the terms query SQL clauses.
          *
          * @since 3.1.0
          *
          * @param array $pieces     Terms query SQL clauses.
          * @param array $taxonomies An array of taxonomies.
          * @param array $args       An array of terms query arguments.
          */
         $clauses = apply_filters( 'terms_clauses', compact( $pieces ), $taxonomies, $args );
         $fields = isset( $clauses[ 'fields' ] ) ? $clauses[ 'fields' ] : '';
         $join = isset( $clauses[ 'join' ] ) ? $clauses[ 'join' ] : '';
         $where = isset( $clauses[ 'where' ] ) ? $clauses[ 'where' ] : '';
         $orderby = isset( $clauses[ 'orderby' ] ) ? $clauses[ 'orderby' ] : '';
         $order = isset( $clauses[ 'order' ] ) ? $clauses[ 'order' ] : '';
         $limits = isset( $clauses[ 'limits' ] ) ? $clauses[ 'limits' ] : '';

         $query = "SELECT $fields FROM {$wpdb->base_prefix}network_terms AS t $join WHERE $where $orderby $order $limits";

         if ( 'count' == $_fields ) {
                 $term_count = $wpdb->get_var($query);
                 return $term_count;
         }

         $terms = $wpdb->get_results($query);

         /* otkluchil cache
         if ( 'all' == $_fields ) {
                 update_term_cache( $terms );
         }
         */

         if ( empty($terms) ) {
                 //wp_cache_add( $cache_key, array(), 'terms', DAY_IN_SECONDS );

                 /** This filter is documented in wp-includes/taxonomy.php */
                 $terms = apply_filters( 'network_get_terms', array(), $taxonomies, $args );
                 return $terms;
         }





         $_terms = array();
         if ( 'id=>parent' == $_fields ) {
                 foreach ( $terms as $term ) {
                         $_terms[ $term->term_id ] = $term->parent;
                 }
         } elseif ( 'ids' == $_fields ) {
                 foreach ( $terms as $term ) {
                         $_terms[] = $term->term_local_id;
                 }
         } elseif ( 'names' == $_fields ) {
                 foreach ( $terms as $term ) {
                         $_terms[] = $term->name;
                 }
         } elseif ( 'id=>name' == $_fields ) {
                 foreach ( $terms as $term ) {
                         $_terms[ $term->term_id ] = $term->name;
                 }
         } elseif ( 'id=>slug' == $_fields ) {
                 foreach ( $terms as $term ) {
                         $_terms[ $term->term_id ] = $term->slug;
                 }
         }

         if ( ! empty( $_terms ) ) {
                 $terms = $_terms;
         }

         if ( $number && is_array( $terms ) && count( $terms ) > $number ) {
                 $terms = array_slice( $terms, $offset, $number );
         }

         //wp_cache_add( $cache_key, $terms, 'terms', DAY_IN_SECONDS );

         /** This filter is documented in wp-includes/taxonomy */
         $terms = apply_filters( 'network_get_terms', $terms, $taxonomies, $args );
         return $terms;
 }

 /*
  * @rudrastyh vitaskivaem previlnij link na element taksonomii
  */
 function network_get_term_link( $term, $taxonomy='', $blog_id=null ){
 	if ( is_object($term) ) {
     	$blog_id = $term->blog_id;
     	$taxonomy = $term->taxonomy;
     	$term_id = intval($term->term_local_id);

     } else {
     	$term_id = $term;
     }
     switch_to_blog( $blog_id );
     $link = get_term_link( $term_id, $taxonomy );
     restore_current_blog();
     return $link;
 }

 function network_get_term( $blog_id, $term, $taxonomy = '', $output = OBJECT, $filter = 'raw') {
 	switch_to_blog( $blog_id );
 	$term = get_term( $term, $taxonomy, $output, $filter );
 	restore_current_blog();
 	return $term;
 }
