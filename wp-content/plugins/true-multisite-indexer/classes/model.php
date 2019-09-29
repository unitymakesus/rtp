<?php

// A class that contains the database functions used within the post indexer plugin

if(!class_exists('multisiteIndexer')) {

	class multisiteIndexer {

		var $db;

		// tables list
		var $tables = array( 'network_posts', 'network_rebuildqueue', 'network_postmeta', 'network_terms', 'network_term_taxonomy', 'network_term_relationships', 'network_log' );

		// old table variables
		var $site_posts;
		var $term_counts;
		var $site_terms;
		var $site_term_relationships;

		// new table variables
		var $network_posts;
		var $network_rebuildqueue;
		var $network_postmeta;
		var $network_terms;
		var $network_term_taxonomy;
		var $network_term_relationships;
		var $network_log;

		// variable to identify if we've switched blogs or not
		var $on_blog_id = 0;

		var $global_post_types;

		var $global_post_statuses;

		function __construct() {

			global $wpdb;

			$this->db =& $wpdb;

			foreach($this->tables as $table) {
				$this->$table = $this->db->base_prefix . $table;
			}

			// Set the global / default post types that we will be using
			$this->global_post_types = get_site_option( 'postindexer_globalposttypes', array( 'post' ) );

			$this->global_post_statuses = get_site_option( 'postindexer_globalpoststatuses', array( 'publish', 'inherit' ) );

		}

		function multisiteIndexer() {
			$this->__construct();
		}

		/*
		 * Функция получает N последних блогов начиная с тех, которые поставлены на ребилд раньше
		 * возвращает в виде массива для каждого ID блога, дату и прогресс
		 */
		function get_justqueued_blogs( $limit = 25 ) {

			$sql = $this->db->prepare("SELECT * FROM {$this->network_rebuildqueue} WHERE rebuild_progress = 0 ORDER BY rebuild_updatedate ASC LIMIT %d", $limit );
			$queue = $this->db->get_results( $sql );

			return $queue;
		}

		/*
		 * Функция получает N последних блогов, чей прогресс неравен нулю
		 * прогресс = ID поста
		 * возвращает в виде массива для каждого ID блога, дату и прогресс
		 */
		function get_rebuilding_blogs( $limit = 5 ) {

			$sql = $this->db->prepare("SELECT * FROM {$this->network_rebuildqueue} WHERE rebuild_progress > 0 ORDER BY rebuild_updatedate ASC LIMIT %d", $limit );
			$queue = $this->db->get_results( $sql );

			return $queue;

		}

		function blogs_for_rebuilding() {

			$sql = "SELECT count(*) as rebuildblogs FROM {$this->network_rebuildqueue}";

			$var = $this->db->get_var( $sql );

			if(empty($var) || $var == 0) {
				return false;
			} else {
				return true;
			}
		}

		// Rebuild blogs

		function rebuild_blog( $blog_id ) {

			$this->insert_or_update( $this->network_rebuildqueue, array( 'blog_id' => $blog_id, 'rebuild_updatedate' => current_time('mysql'), 'rebuild_progress' => 0 ) );

		}

		function rebuild_all_blogs() {

			global $site_id;

			$sql = "DELETE FROM {$this->network_rebuildqueue}";
			$this->db->query( $sql );

			if(!empty($site_id) && $site_id != 0) {
				$sql = $this->db->prepare( "INSERT INTO {$this->network_rebuildqueue} SELECT blog_id, timestamp(now()), 0 FROM {$this->db->blogs} where site_id = %d", $site_id );
			} else {
				$sql = "INSERT INTO {$this->network_rebuildqueue} SELECT blog_id, timestamp(now()), 0 FROM {$this->db->blogs}";
			}

			$this->db->query( $sql );

		}

		function is_in_rebuild_queue( $blog_id ) {

			$sql = $this->db->prepare( "SELECT * FROM {$this->network_rebuildqueue} WHERE blog_id = %d", $blog_id );

			$row = $this->db->get_row( $sql );

			if( !empty($row) && $row->blog_id == $blog_id ) {
				return true;
			} else {
				return false;
			}

		}

		/*
		 * Функция проверяет, доступен ли блог для индексации
		 * сначала проверяем "postindexer_active" в таблице конкретного блога
		 * затем - если статус блога Архив, Удален, Для взрослых, то не индексируем
		 * возвращает true, если блог доступен для индекса
		 */
		function is_blog_indexable( $blog_id ) {

			/* переключаемся на нужный блог */
			$this->switch_to_blog( $blog_id );
			/* проверяем настройки блога – доступен ли для индекса */
			$indexing = get_option( 'postindexer_active', 'yes' );

			/* если индекс включен но блог либо удален либо помечен спамным, то отключаем нафик */
			if( $indexing == 'yes' && ( get_blog_status( $blog_id, 'archived') == '1' || get_blog_status( $blog_id, 'mature') == '1' || get_blog_status( $blog_id, 'spam') == '1' || get_blog_status( $blog_id, 'deleted') == '1' ) ) {
				$indexing = 'no';
			}

			$this->restore_current_blog();

			return ( $indexing == 'yes' ) ? true : false;

		}

		/*
		 * Просто запрещает индексацию
		 * обновляет опцию блога
		 * удаляем блог из очереди
		 * удаляет проиндексированные элементы
		 */
		function disable_indexing_for_blog( $blog_id ) {

			update_blog_option( $blog_id, 'postindexer_active', 'no' );
			$this->remove_blog_from_queue( $blog_id );
			$this->remove_indexed_entries_for_blog( $blog_id );

		}

		/*
		 * Разрешает индексацию в опциях
		 * автоматически ставит ребилд
		 */
		function enable_indexing_for_blog( $blog_id ) {

			update_blog_option( $blog_id, 'postindexer_active', 'yes' );
			$this->rebuild_blog( $blog_id );

		}

		/*
		 * Функция, удаляющая всю проиндексированную информацию конкретного блога
		 */
		function remove_indexed_entries_for_blog( $blog_id ) {

			$this->db->query( $this->db->prepare( "DELETE FROM {$this->network_posts} WHERE BLOG_ID = %d", $blog_id ) );
			$this->db->query( $this->db->prepare( "DELETE FROM {$this->network_postmeta} WHERE blog_id = %d", $blog_id ) );
			$this->db->query( $this->db->prepare( "DELETE FROM {$this->network_term_relationships} WHERE blog_id = %d", $blog_id ) );

		}

		/*
		 * Просто удаляет блог из очереди на индексацию
		 */
		function remove_blog_from_queue( $blog_id ) {

			$this->db->query( $this->db->prepare( "DELETE FROM {$this->network_rebuildqueue} WHERE blog_id = %d", $blog_id ) );

		}

		/*
		 * Обновляет статус прогресса, обычно ID текущего поста
		 */
		function update_blog_queue( $blog_id, $progress ) {

			$this->db->update( $this->network_rebuildqueue, array('rebuild_progress' => $progress, 'rebuild_updatedate' => current_time('mysql')), array('blog_id' => $blog_id) );

		}

		function get_highest_post_for_blog( $blog_id = false ) {

			if($blog_id !== false) $this->switch_to_blog( $blog_id );

			$max_id = $this->db->get_var( "SELECT MAX(ID) as max_id FROM {$this->db->posts}" );

			if($blog_id !== false) $this->restore_current_blog();

			return $max_id;
		}

		/*
		 * Получаем 5 постов определенного блога для индесации, которые опубликованы,
		 * чей тип постов включен для индексации,
		 * а также те, кто не защищен паролем
		 * сортировка по ID по уменьшению и начинаем с $startat
		 */
		function get_posts_for_indexing( $blog_id = false, $startat = 0 ) {

			if($blog_id !== false) $this->switch_to_blog( $blog_id );

			$posttypes = get_option( 'postindexer_posttypes', $this->global_post_types );
			$poststatuses = get_option( 'postindexer_poststatuses', $this->global_post_statuses );

			/* берем следующие 5 постов */
			$sql = $this->db->prepare( "SELECT * FROM {$this->db->posts} WHERE ID <= %d AND post_status IN ('" . implode("','", $poststatuses) . "') AND post_type IN ('" . implode("','", $posttypes) . "') AND post_password = '' ORDER BY ID DESC LIMIT %d", $startat, 5 );

			$posts = $this->db->get_results( $sql, ARRAY_A );

			if($blog_id !== false) $this->restore_current_blog();

			return $posts;
		}

		function get_post_for_indexing( $post_id, $blog_id = false, $restrict = true ) {

			if($blog_id !== false) $this->switch_to_blog( $blog_id );

			if( $restrict === true ) {
				$posttypes = get_option( 'postindexer_posttypes', $this->global_post_types );
				// та же тема для статусов постов
				$poststatuses = get_option( 'postindexer_poststatuses', $this->global_post_statuses );

				// Get the post to work with that is published, in the selected post types and not password protected
				$sql = $this->db->prepare( "SELECT * FROM {$this->db->posts} WHERE ID = %d AND post_status IN ('" . implode("','", $poststatuses) . "') AND post_type IN ('" . implode("','", $posttypes) . "') AND post_password = ''", $post_id );
				$post = $this->db->get_row( $sql, ARRAY_A );
			} else {
				$sql = $this->db->prepare( "SELECT * FROM {$this->db->posts} WHERE ID = %d", $post_id );
				$post = $this->db->get_row( $sql, ARRAY_A );
			}

			if($blog_id !== false) $this->restore_current_blog();

			return $post;
		}

		/*
		 * Получаем все postmeta для поста
		 * при индексации не используем такие вещи, как '_edit_last', '_edit_lock', '_encloseme', '_pingme'
		 */
		function get_postmeta_for_indexing( $post_id, $blog_id = false ) {

			if($blog_id !== false) $this->switch_to_blog( $blog_id );

			// Get the post meta for this local post
			$metasql = $this->db->prepare( "SELECT * FROM {$this->db->postmeta} WHERE post_id = %d AND meta_key NOT IN ('_edit_last', '_edit_lock', '_encloseme', '_pingme')", $post_id );
			$meta = $this->db->get_results( $metasql, ARRAY_A );

			if($blog_id !== false) $this->restore_current_blog();

			return $meta;

		}

		/* @rudrastyh polichenie vseh taksonomij dlya indeksacii */

		function get_taxonomy_for_indexing( $post_id, $blog_id = false  ) {

			if($blog_id !== false)  $this->switch_to_blog( $blog_id );

			$taxsql = $this->db->prepare( "SELECT t.term_id, t.name, t.slug, t.term_group, tt.term_taxonomy_id, tt.taxonomy, tt.description, tt.parent, tr.term_order FROM {$this->db->terms} AS t INNER JOIN {$this->db->term_taxonomy} AS tt ON t.term_id = tt.term_id INNER JOIN {$this->db->term_relationships} AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id WHERE tr.object_id = %d", $post_id );
			$tax = $this->db->get_results( $taxsql, ARRAY_A );

			if($blog_id !== false)  $this->restore_current_blog();

			return $tax;

		}

		function is_post_indexable( $post, $blog_id = false ) {

			if($blog_id !== false) $this->switch_to_blog( $blog_id );

			$posttypes = get_option( 'postindexer_posttypes', $this->global_post_types );
			// мой хук для внедрения новых статусов постов
			$poststatuses = get_option( 'postindexer_poststatuses', $this->global_post_statuses );

			// Checking for inherit here as well so we can get the media attachments for the post
			if( in_array( $post['post_type'], $posttypes ) && in_array( $post['post_status'], $poststatuses ) && $post['post_password'] == '' ) {
				$indexing = 'yes';
				//Do not insert aged posts.
				$agedposts = get_site_option( 'postindexer_agedposts', array( 'agedunit' => 1, 'agedperiod' => 'year' ) );
				$post_timestamp = strtotime($post['post_date']);
				$post_age_limit = strtotime('-'.$agedposts['agedunit'].' '.$agedposts['agedperiod']);
				if($post_timestamp < $post_age_limit){
					$indexing = 'no';
				}
		} else {
				$indexing = 'no';
			}

			if($blog_id !== false) $this->restore_current_blog();

			$indexing = apply_filters('postindexer_is_post_indexable', $indexing, $post, $blog_id);

			if($indexing == 'yes') {
				return true;
			} else {
				return false;
			}

		}

		/*
		 * Функция добавляющая пост в network_posts
		 */
		function index_post( $post ) {

			// небольшая проверка на несуществующие таблицы в БД
			// позволяет устранить ошибки, если пользователь в своё время повеселился в базе данных
			foreach( $post as $key=>$value ) {
				if( !in_array( $key, array( 'ID','post_author','post_date','post_date_gmt','post_content','post_title','post_excerpt','post_status','comment_status','ping_status','post_password','post_name','to_ping','pinged','post_modified','post_modified_gmt','post_content_filtered','post_parent','guid','menu_order','post_type','post_mime_type','comment_count','BLOG_ID' ) ) )
					unset( $post[$key] );
			}

			// всё ок - выполняем SQL-запрос на добавление поста
			$this->insert_or_update( $this->network_posts, $post );

		}

		/*
		 * Функция добавляющая postmeta в network_postmeta
		 */
		function index_postmeta( $postmeta ) {

			// небольшая проверка на несуществующие таблицы в БД
			// позволяет устранить ошибки, если пользователь в своё время повеселился в базе данных
			foreach( $postmeta as $key=>$value ) {
				if( !in_array( $key, array( 'blog_id','meta_id','post_id','meta_key','meta_value') ) )
					unset( $postmeta[$key] );
			}

			$this->insert_or_update( $this->network_postmeta, $postmeta );

		}

		/* @rudrastyh funkciya indeksacii termina */
		function index_tax( $tax ) {

			//if( $tax['parent'] == 0 ) {

				$term_id = $this->insert_or_get_term( $tax['name'], $tax['slug'], $tax['term_group'], $tax['term_id'], $tax['blog_id'] );
				if(!empty($term_id)) {
					$term_taxonomy_id = $this->insert_or_get_taxonomy( $term_id, $tax['taxonomy'], $tax['description'], $tax['parent'] );

					// Now that we have the taxonomy_id and the post_id we can insert the relationship
					$this->insert_or_update( $this->network_term_relationships, array( 'blog_id' => $tax['blog_id'], 'object_id' => $tax['object_id'], 'term_taxonomy_id' => $term_taxonomy_id, 'term_order' => $tax['term_order'] ) );
				}


			//} else {
			//	// There is a parent tax, we are not going to do anything more advanced with it, but this part of the if statement is here in case we want to later.
			//	$term_id = $this->insert_or_get_term( $tax['name'], $tax['slug'], $tax['term_group'], $tax['term_id'], $tax['blog_id'] );
			//	if(!empty($term_id)) {
			//		$term_taxonomy_id = $this->insert_or_get_taxonomy( $term_id, $tax['taxonomy'], $tax['description'], 0 );

			//		// Now that we have the taxonomy_id and the post_id we can insert the relationship
			//		$this->insert_or_update( $this->network_term_relationships, array( 'blog_id' => $tax['blog_id'], 'object_id' => $tax['object_id'], 'term_taxonomy_id' => $term_taxonomy_id, 'term_order' => $tax['term_order'] ) );
			//	}
			//}

		}

		function remove_postmeta_for_post( $post_id, $blog_id = false ) {

			if( $blog_id == false ) {
				$blog_id = $this->db->blogid;
			}

			// Remove all the networked postmeta for the blog id
			$this->db->query( $this->db->prepare( "DELETE FROM {$this->network_postmeta} WHERE blog_id = %d AND post_id = %d", $blog_id, $post_id ) );

		}

		function remove_term_relationships_for_post( $post_id, $blog_id = false ) {

			//$this->log_message( __FUNCTION__, "post_id[". $post_id."] blog_id[". $blog_id ."]" );
			//global $current_blog;
			//$this->log_message( __FUNCTION__, "current_blog<pre>". print_r($current_blog, true)."</pre> blog_id[". $blog_id ."]" );

			if( $blog_id == false ) {
				$blog_id = $this->db->blogid;
			}

			// Remove all the networked term relationship information for the blog_id
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_term_relationships} WHERE blog_id = %d AND object_id = %d", $blog_id, $post_id );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );

		}

		/*
		 * Удаление конкретного поста из индекса конкретного блога
		 * пост мета и привязка к терминам удаляется в том числе
		 */
		function remove_indexed_entry_for_blog( $post_id, $blog_id = false ) {

			// если ID блога не передан, берется текущий из wpdb
			if( $blog_id == false ) {
				$blog_id = $this->db->blogid;
			}

			// Remove all the networked posts for the blog id
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_posts} WHERE BLOG_ID = %d AND ID = %d", $blog_id, $post_id );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );

			// Remove all the networked postmeta for the blog id
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_postmeta} WHERE blog_id = %d AND post_id = %d", $blog_id, $post_id );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );

			// Remove all the networked term relationship information for the blog_id
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_term_relationships} WHERE blog_id = %d AND object_id = %d", $blog_id, $post_id );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );

			do_action( 'postindexer_remove_indexed_post', $post_id, $blog_id );
		}

		function remove_orphaned_postmeta_entries() {

			//$sql = $this->db->prepare( "DELETE FROM {$this->network_postmeta} WHERE " );

		}

		function remove_orphaned_tax_entries() {

			// Remove any taxonomy entries that aren't in a relationship
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_term_taxonomy} WHERE term_taxonomy_id NOT IN ( SELECT term_taxonomy_id FROM {$this->network_term_relationships} ) LIMIT %d", 50 );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );
			//$this->log_message( __FUNCTION__, 'query<pre>'. print_r($this->db, true) ."</pre>" );

			// Remove any terms that aren't in a taxonomy
			$sql_str = $this->db->prepare( "DELETE FROM {$this->network_terms} WHERE term_id NOT IN ( SELECT term_id FROM {$this->network_term_taxonomy} ) LIMIT %d", 50 );
			//$this->log_message( __FUNCTION__, $sql_str );
			$this->db->query( $sql_str );
			//$this->log_message( __FUNCTION__, 'query<pre>'. print_r($this->db, true) ."</pre>" );

		}

		function remove_posts_older_than( $unit, $period ) {

			switch($period) {
				case 'hour':
				case 'day':
				case 'week':
				case 'month':
				case 'year':
								$period = strtoupper($period);
			}

			$sql = $this->db->prepare( "SELECT BLOG_ID, ID FROM {$this->network_posts} WHERE DATE_ADD(post_date, INTERVAL %d " . $period . ") < CURRENT_DATE() LIMIT %d", $unit, 50 );
			$posts = $this->db->get_results( $sql );

			if(!empty($posts)) {
				foreach($posts as $post) {
					$this->remove_indexed_entry_for_blog( $post->ID, $post->BLOG_ID );
				}
			}


		}

		function recalculate_tax_counts() {

			// Calculate and update the counts for the tax terms
			$sql = $this->db->prepare( "SELECT tr.term_taxonomy_id, count(*) as calculatedcount, tt.count FROM {$this->network_term_relationships} AS tr INNER JOIN {$this->network_term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id GROUP BY tr.term_taxonomy_id HAVING calculatedcount != tt.count LIMIT %d", 50 );

			$counts = $this->db->get_results( $sql, ARRAY_A );
			if(!empty( $counts )) {
				foreach( $counts as $count ) {
					$this->db->update( $this->network_term_taxonomy, array( 'count' => $count['calculatedcount'] ), array( 'term_taxonomy_id' => $count['term_taxonomy_id'] ) );
				}
			}

		}

		/* @rudrastyh polichenie ili vivod termina */

		function insert_or_get_term( $name, $slug, $term_group, $term_local_id, $blog_id ) {

			$sql = $this->db->prepare( "SELECT term_id FROM " . $this->db->base_prefix . "network_terms WHERE name = %s AND slug = %s AND term_group = %d AND term_local_id = %d AND blog_id = %d", $name, $slug, $term_group, $term_local_id, $blog_id );
			$term_id = $this->db->get_var( $sql );

			/* esli ne suschestvuet, dobavlyaem */
			if( empty($term_id) ) {

				/*
				 * Polylang injection #1
				 * применяем фильтр, который будет вычислять язык, либо вообще его не будет
				 */
				$language = apply_filters( 'network_local_term_language', '', $term_local_id, $blog_id );

				$this->db->insert( $this->db->base_prefix . "network_terms", array( 'name' => $name, 'slug' => $slug, 'term_group' => $term_group,'term_local_id' => $term_local_id,'blog_id' => $blog_id, 'term_language' => $language  ) );
				$term_id = $this->db->insert_id;
				$this->log_message( __FUNCTION__, 'Language:' . $language . '; Name:' . $name . '; Blog ID' . $blog_id . '; Term Insert ID '  . $term_id );
			}

			return $term_id;

		}

		function insert_or_get_taxonomy( $term_id, $taxonomy, $description, $parent ) {

			$sql = $this->db->prepare( "SELECT term_taxonomy_id FROM " . $this->db->base_prefix . "network_term_taxonomy WHERE term_id = %d AND taxonomy = %s AND description = %s AND parent = %d",$term_id, $taxonomy, $description, $parent );
			$term_taxonomy_id = $this->db->get_var( $sql );

			if(empty($term_taxonomy_id)) {
				// We nned to insert the taxonomy as we don't have one
				$this->db->insert( $this->db->base_prefix . "network_term_taxonomy", array( 'term_id' => $term_id, 'taxonomy' => $taxonomy, 'description' => $description, 'parent' => $parent, 'count' => 1 ) );
				$term_taxonomy_id = $this->db->insert_id;
			}

			return $term_taxonomy_id;

		}

		// Insert on duplicate update function
		function insert_or_update( $table, $query ) {

				$fields = array_keys($query);
				$formatted_fields = array();
				foreach ( $fields as $field ) {
					$form = '%s';
					$formatted_fields[] = $form;
				}
				$sql = "INSERT INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES ('" . implode( "','", $formatted_fields ) . "')";
				$sql .= " ON DUPLICATE KEY UPDATE ";

				$dup = array();
				foreach($fields as $field) {
					$dup[] = "`" . $field . "` = VALUES(`" . $field . "`)";
				}

				$sql .= implode(',', $dup);

				$sql_str = $this->db->prepare( $sql, $query );
				/*$this->log_message( __FUNCTION__, $sql_str );*/
				return $this->db->query( $sql_str  );

		}

		function switch_to_blog( $blog_id ) {

			if( $blog_id != $this->db->blogid ) {
				$this->on_blog_id = $blog_id;
				switch_to_blog( $blog_id );
			}

		}

		function restore_current_blog() {

			if( $this->on_blog_id != 0 ) {
				$this->on_blog_id = 0;
				restore_current_blog();
			}

		}

		/*
		 * Получение всех используемых типов постов для блога
		 * SELECT DISTINCT получение только различных значений
		 */
		function get_active_post_types( $blog_id = false ) {

			if( $blog_id != false ) {
				$this->switch_to_blog( $blog_id );
			}

			$sql = "SELECT DISTINCT post_type FROM {$this->db->posts}";

			$post_types = $this->db->get_col( $sql );

			if( $blog_id != false ) {
				$this->restore_current_blog( );
			}

			return $post_types;

		}

		// Useful functions
		function &get_post( $blog_id, $network_post_id ) {

			$sql = $this->db->prepare( "SELECT * FROM {$this->network_posts} WHERE BLOG_ID = %d AND ID = %d", $blog_id, $network_post_id );
			$results = $this->db->get_row( $sql, OBJECT );

			return $results;

		}

		function term_is_tag( $term ) {

			$sql = $this->db->prepare( "SELECT taxonomy FROM {$this->network_term_taxonomy} AS tt INNER JOIN {$this->network_terms} AS t ON tt.term_id = t.term_id WHERE t.slug = %s", $term );
			$taxonomy = $this->db->get_var( $sql );

			if(!empty($taxonomy) && $taxonomy == 'post_tag') {
				return true;
			} else {
				return false;
			}

		}

		function term_is_category( $term ) {

			$sql = $this->db->prepare( "SELECT taxonomy FROM {$this->network_term_taxonomy} AS tt INNER JOIN {$this->network_terms} AS t ON tt.term_id = t.term_id WHERE t.slug = %s", $term );
			$taxonomy = $this->db->get_var( $sql );

			if(!empty($taxonomy) && $taxonomy == 'category') {
				return true;
			} else {
				return false;
			}

		}

		function log_message( $title, $msg ) {
			$title .= ' ('. getmypid() .')';
			$this->db->insert( $this->network_log, array( 'log_title' => $title, 'log_details' => $msg, 'log_datetime' => current_time('mysql') ) );
		}

		function clear_messages( $keep = 25 ) {

			$ids = $this->db->get_col( $this->db->prepare( "SELECT id FROM {$this->network_log} ORDER BY id DESC LIMIT %d", $keep ) );
			$ids = "'" . implode("','", $ids) . "'";

			$sql = $this->db->prepare( "DELETE FROM {$this->network_log} WHERE id NOT IN (" . $ids . ") LIMIT %d", 50 );

			$this->db->query( $sql );
		}

		function get_log_messages( $show = 25 ) {
			$sql = $this->db->prepare( "SELECT * FROM {$this->network_log} ORDER BY id DESC LIMIT %d", $show );

			return $this->db->get_results( $sql );
		}

		function get_summary_post_types() {

			$sql = "SELECT post_type, count(*) AS post_type_count FROM {$this->network_posts} GROUP BY post_type ORDER BY post_type_count DESC";

			return $this->db->get_results( $sql );

		}

		function get_summary_blog_totals() {

			$sql = "SELECT BLOG_ID, count(*) AS blog_count FROM {$this->network_posts} GROUP BY BLOG_ID ORDER BY blog_count DESC LIMIT 15";

			return $this->db->get_results( $sql );

		}

		/* vitaskivam obchee kolichestvo indeksirovannish postov */
		function get_summary_by_blog_id_and_post_type( $blog_id, $post_type = 'post') {

			$sql = "SELECT count(*) FROM {$this->network_posts} WHERE BLOG_ID='$blog_id' AND post_type='$post_type'";

			return $this->db->get_var( $sql );

		}

		function get_summary_blog_post_type_totals( $ids = array() ) {

			$ids = $this->db->get_col( "SELECT BLOG_ID, count(*) AS blog_count FROM {$this->network_posts} GROUP BY BLOG_ID ORDER BY blog_count DESC LIMIT 15" );
			$ids = "'" . implode("','", $ids) . "'";

			$sql = "SELECT BLOG_ID, post_type, count(*) AS blog_type_count FROM {$this->network_posts} WHERE BLOG_ID IN (" . $ids . ") GROUP BY BLOG_ID, post_type ORDER BY blog_id, post_type DESC LIMIT 15";

			return $this->db->get_results( $sql );

		}

		function get_summary_single_site_blog_post_type_totals( $id ) {

			$sql = $this->db->prepare( "SELECT BLOG_ID, post_type, count(*) AS blog_type_count FROM {$this->network_posts} WHERE BLOG_ID = %d GROUP BY BLOG_ID, post_type ORDER BY blog_id, post_type DESC LIMIT %d", $id, 15 );

			return $this->db->get_results( $sql );

		}

		function get_summary_recently_indexed() {

			$sql = $this->db->prepare( "SELECT * FROM {$this->network_posts} ORDER BY post_modified_gmt DESC LIMIT %d", 25 );

			return $this->db->get_results( $sql );

		}

		/* @rudrastyh nedavno proindeksirovannie termini */
		function get_summary_recently_indexed_terms() {

			$sql = $this->db->prepare( "SELECT * FROM {$this->network_terms} AS t1 LEFT JOIN {$this->network_term_taxonomy} AS t2 ON t1.term_id = t2.term_taxonomy_id ORDER BY t1.term_id DESC LIMIT %d ", 25 );

			return $this->db->get_results( $sql );

		}

		function get_summary_sites_in_queue() {

			$sql = "SELECT count(*) AS inqueue FROM {$this->network_rebuildqueue}";

			return $this->db->get_var( $sql );

		}

		function get_summary_sites_in_queue_processing() {

			$sql = $this->db->prepare( "SELECT count(*) AS inqueue FROM {$this->network_rebuildqueue} WHERE rebuild_progress > %d", 0 );

			return $this->db->get_var( $sql );

		}

		function get_summary_sites_in_queue_not_processing() {

			$sql = $this->db->prepare( "SELECT count(*) AS inqueue FROM {$this->network_rebuildqueue} WHERE rebuild_progress = %d", 0 );

			return $this->db->get_var( $sql );

		}

		function get_summary_sites_in_queue_finish_next_pass() {

			$sql = $this->db->prepare( "SELECT count(*) AS inqueue FROM {$this->network_rebuildqueue} WHERE rebuild_progress > 0 AND rebuild_progress <= %d", 5 );

			return $this->db->get_var( $sql );

		}

	}

}
