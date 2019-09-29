<?php
add_filter( 'network_local_term_language', 'network_get_term_language', 10, 3 );

function network_get_term_language( $language, $term_local_id, $blog_id ){

	// в первую очередь переключаемся на локальный блог и проверяем, активен ли плагин Polylang для него
	switch_to_blog( $blog_id );

	//require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$language = '';
	// если плагин активен, то будем определять язык, иначе пусть остаётся пустой
	if ( function_exists( 'pll_get_term_language' ) ) {

		// вытащить language достаточно просто
		// $langs = wp_get_object_terms( $term_local_id, 'term_language', array( 'update_term_meta_cache' => false ) );
		// $language = $langs[0]->slug;
		if( $language = pll_get_term_language( $term_local_id ) ) {
			$language = 'pll_' . $language;
		}

	} else {
		// ок функции не существует, значит это не polylang pro, я так понимаю, идем тогда другим путем
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'polylang/polylang.php' ) ) {
			$langs = wp_get_object_terms( $term_local_id, 'term_language', array( 'update_term_meta_cache' => false ) );
			$language = $langs[0]->slug;
		}

	}

	restore_current_blog();

	return $language;

}

/*
 * @Misha Rusrastyh
 * get_terms as it
 */
function network_get_translated_terms( $taxonomies, $args = '', $languages ) {
	/* эта функция доступна НЕ только если установлен плагин Polylang, поэтому параметр с языком обязательный */

	global $wpdb;
	$empty_array = array();

	/* 1. сначала обычная проверка таксономий, массив это или нет */
	$single_taxonomy = ! is_array( $taxonomies ) || 1 === count( $taxonomies );
	if ( ! is_array( $taxonomies ) ) {
		$taxonomies = array( $taxonomies );
	}

	/* 2. проверка относительно языка, могут передать массив, а могут и нет */
	if( !empty( $languages ) ) {
		if( is_array( $languages ) ) {
			$languages = "'pll_" . implode("','pll_",$languages) . "'";
		} else {
			$languages = "'pll_" . $languages . "'";
		}
	}

	/* 3. обычный мерджинг параметров с параметрами по умолчанию, absint() типо для доп защиты? */
	$defaults = array('orderby' => 'name', 'order' => 'ASC','hide_empty' => false, 'exclude' => array(), 'include' => array(),'number' => '', 'fields' => 'all', 'name' => '', 'slug' => '', 'parent' => '','name__like' => '', 'description__like' => '','offset' => '', 'search' => '', 'cache_domain' => 'core' );
 	$args = wp_parse_args( $args, $defaults );
	$args['number'] = absint( $args['number'] );
	$args['offset'] = absint( $args['offset'] );
	$parent = $args['parent'];

	/* 4. тут можно замутить фильтр типо network_get_terms_args, но обойдутся */

	/* 5. тут можно замутить кэш также, но обойдутся пока что */

	/* 6. о да, начинаем мутить наш query, сначала ORDERBY, с языками тут никакой связи, так что пофиг вообще */
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

	/* 7. опять-таки, можно отфильтровать orderby через network_get_terms_orderby, но как-нибудь потом */

	/* 8. ORDER – тоже без изменений */
	$order = strtoupper( $args['order'] );
	// если $orderby не пустой, то мы просто добавляем к нему ORDER BY, если пустой, то в $order нет смысла!
	if ( ! empty( $orderby ) ) {
		$orderby = "ORDER BY $orderby";
	} else {
		$order = '';
	}
	if ( '' !== $order && ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
		$order = 'ASC';
	}

	/* 8. EXCLUDE, INCLUDE – следующий пункт об этих двух параметрах */
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
	if ( ! empty( $exclusions ) ) {
		$where .= $exclusions;
	}

	/* 9. Обрабатываем следующий параметр name */
	if ( ! empty( $args['name'] ) ) {
		if ( is_array( $args['name'] ) ) {
			$name = array_map( 'sanitize_text_field', $args['name'] );
			$where .= " AND t.name IN ('" . implode( "', '", array_map( 'esc_sql', $name ) ) . "')";
		} else {
			$name = sanitize_text_field( $args['name'] );
			$where .= $wpdb->prepare( " AND t.name = %s", $name );
		}
	}

	/* 9. slug */
	if ( ! empty( $args['slug'] ) ) {
		if ( is_array( $args['slug'] ) ) {
			$slug = array_map( 'sanitize_title', $args['slug'] );
			$where .= " AND t.slug IN ('" . implode( "', '", $slug ) . "')";
		} else {
			$slug = sanitize_title( $args['slug'] );
			$where .= " AND t.slug = '$slug'";
		}
	}

	/* 10. name__like */
	if ( ! empty( $args['name__like'] ) ) {
		$where .= $wpdb->prepare( " AND t.name LIKE %s", '%' . $wpdb->esc_like( $args['name__like'] ) . '%' );
	}

	/* 11. description__like */
	if ( ! empty( $args['description__like'] ) ) {
		$where .= $wpdb->prepare( " AND tt.description LIKE %s", '%' . $wpdb->esc_like( $args['description__like'] ) . '%' );
	}

	/* 12. parent */
	if ( '' !== $parent ) {
		$parent = (int) $parent;
		$where .= " AND tt.parent = '$parent'";
	}

	/* 13. hide_empty */
	if ( $args['hide_empty'] ) {
		$where .= ' AND tt.count > 0';
	}

	/* 14. number и offset */
	$number = $args['number'];
	$offset = $args['offset'];
	if ( $number ) {
		if ( $offset ) {
			$limits = 'LIMIT ' . $offset . ',' . $number;
		} else {
			$limits = 'LIMIT ' . $number;
		}
	} else {
		$limits = '';
	}

	/* 15. search */
	if ( ! empty( $args['search'] ) ) {
		$like = '%' . $wpdb->esc_like( $args['search'] ) . '%';
 		$where .= $wpdb->prepare( ' AND ((t.name LIKE %s) OR (t.slug LIKE %s))', $like, $like );
	}

	/* 16. fields */
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
		$fields = implode( ', ', $selects );



		// // что если тут мы получим все OBJECT ids терминов этого языка
		// // select relationships object_id inner join terms ON term_taxonomy_id = term_id where term_slug = pll_en;
		// $ids = $wpdb->get_col("SELECT r.object_id FROM {$wpdb->base_prefix}network_term_relationships AS r INNER JOIN {$wpdb->base_prefix}network_terms AS t ON r.term_taxonomy_id = t.term_id WHERE t.slug = 'pll_en'" );
		// echo "<pre>";print_r($ids);echo '</pre><p>-----------------</p>';

		/* 17. дальше – лучше, тут уже создается сам SQL запрос */
		$join = "INNER JOIN {$wpdb->base_prefix}network_term_taxonomy AS tt ON t.term_id = tt.term_id";

		$pieces = array( 'fields', 'join', 'where', 'orderby', 'order', 'limits' );

		$clauses = compact( $pieces );

		$fields = isset( $clauses[ 'fields' ] ) ? $clauses[ 'fields' ] : '';
		$join = isset( $clauses[ 'join' ] ) ? $clauses[ 'join' ] : '';
		$where = isset( $clauses[ 'where' ] ) ? $clauses[ 'where' ] : '';
		$orderby = isset( $clauses[ 'orderby' ] ) ? $clauses[ 'orderby' ] : '';
		$order = isset( $clauses[ 'order' ] ) ? $clauses[ 'order' ] : '';
		$limits = isset( $clauses[ 'limits' ] ) ? $clauses[ 'limits' ] : '';

		//	$join .= " INNER JOIN {$wpdb->base_prefix}network_term_relationships AS pll_tr ON ( pll_tr.object_id = t.term_id AND pll_tr.blog_id = t.blog_id AND pll_tr.term_taxonomy_id = tt.term_taxonomy_id)";
		/* по сути достаточно будет добавить одно-единственное условие */
		if( !empty( $languages ) ) $where .= " AND t.term_language IN ({$languages})";

		$query = "SELECT $fields FROM {$wpdb->base_prefix}network_terms AS t $join WHERE $where $orderby $order $limits";
		//echo $query; exit;
		if ( 'count' == $_fields ) {
			$term_count = $wpdb->get_var($query);
			return $term_count;
		}

		$terms = $wpdb->get_results($query);

		return $terms;


}
