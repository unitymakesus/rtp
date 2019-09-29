<?php

if(!class_exists('multisiteindexerRebuild')) {

	class multisiteindexerRebuild {

		var $build = 1;
		var $rebuildperiod = '5mins';
		var $model;
		var $lockers;
		var $lock_folder;

		function __construct() {

			$this->model = new multisiteIndexer();

			$this->lockers = array();

			/* Основная функция, настраиващая расписание */
			add_action( 'init', array(&$this, 'set_up_schedule') );
			add_filter( 'cron_schedules', array(&$this, 'add_time_period') );

			// The cron action s
			add_action( 'postindexer_firstpass_cron', array( &$this, 'process_rebuild_firstpass') );
			add_action( 'postindexer_secondpass_cron', array( &$this, 'process_rebuild_secondpass') );

			add_action( 'postindexer_tagtidy_cron', array( &$this, 'process_tidy_tags') );
			add_action( 'postindexer_postmetatidy_cron', array( &$this, 'process_tidy_postmeta') );
			add_action( 'postindexer_agedpoststidy_cron', array( &$this, 'process_tidy_agedposts') );

		}

		function multisiteindexerRebuild() {
			$this->__construct();
		}

		/*
		 * Первая проходка
		 * берем количество сайтов 25
		 * проверяем каждый из них - индексируемый ли
		 * если да, обновляем его статус в очереди на ID макс поста
		 */
		function process_rebuild_firstpass($DEBUG = false) {

			$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Initializing...", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );


			/* First pass - loop through queue entries with a 0 in the rebuild_progress and set them up for the rebuild process */
			$queue = $this->model->get_justqueued_blogs();

			$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Processing %s queued items.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), count($queue) ) );

			if(!empty( $queue )) {


				foreach($queue as $item) {

					if( $this->model->is_blog_indexable( $item->blog_id ) ) {

						$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, is indexable.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), $item->blog_id ) );

						// Get the highest post_id
						$max_id = $this->model->get_highest_post_for_blog( $item->blog_id );
						if(!empty($max_id) && $max_id > 0) {
							// We have posts - record the highest current post id
							$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, Highest Post ID is %d", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $max_id ) );

							$this->model->update_blog_queue( $item->blog_id, $max_id );
						} else {
							// No posts, so we'll remove it from the queue
							$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, No Posts found removing from queue.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

							$this->model->remove_blog_from_queue( $item->blog_id );
						}
						// Remove existing posts because we are going to rebuild
						$this->model->remove_indexed_entries_for_blog( $item->blog_id );

					} else {
						// Remove the blog from the queue
						$this->debug_message( __('First Pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), sprintf( __("Blog: %d, is NOT indexable - removing from queue.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

						$this->model->remove_blog_from_queue( $item->blog_id );
					}

				}
			} else {

			}

			$this->debug_message( __('First Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Finished processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );


		}

		/*
		 * Вторая проходка
		 */
		function process_rebuild_secondpass($DEBUG = false) {


			$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Initializing...", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );



			/* получаем блоги, чей ребилд прогресс больше нуля */
			$queue = $this->model->get_rebuilding_blogs();
			$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Processing %d queued blogs.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), count($queue) ) );
			if(!empty($queue)) {

				/* для каждого из этих блогов */
				foreach( $queue as $item ) {

					/* ещё раз проверяем, индексируемый ли (надо ли??) */
					if( $this->model->is_blog_indexable( $item->blog_id ) ) {

						$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, is indexable.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

						/* переключаемся на блог и понеслась */
						$this->model->switch_to_blog( $item->blog_id );

						$posts = $this->model->get_posts_for_indexing( $item->blog_id, $item->rebuild_progress );
						if(!empty($posts)) {

							$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, Processing %d posts", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, count($posts) ) );

							foreach($posts as $key => $post) {
								// Check if the post should be indexed or not
								if($this->model->is_post_indexable( $post, $item->blog_id ) ) {

									$this->debug_message( __('Second Pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), sprintf( __("Blog: %d, Post ID: %d, Begin processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'] ) );



									// Get the local post ID
									$local_id = $post['ID'];
									// Add in the blog id to the post record
									$post['BLOG_ID'] = $item->blog_id;

									// Add the post record to the network tables
									$this->debug_message( __('Second Pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), sprintf( __("Blog: %d, Post ID: %d, Indexing post: %s", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'], $post['post_title'] ) );
									$this->model->index_post( $post );

									// Теперь индексируем postmeta для этого поста
									$this->debug_message( __('Second Pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), sprintf( __("Blog: %d, Post ID: %d, post metadata", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'] ) );

									$meta = $this->model->get_postmeta_for_indexing( $local_id, $item->blog_id );
									// Remove any existing ones that we are going to overwrite
									$this->model->remove_postmeta_for_post( $local_id );
									if(!empty($meta)) {
										foreach( $meta as $metakey => $postmeta ) {
											// Add in the blog_id to the table
											$postmeta['blog_id'] = $item->blog_id;
											// Add it to the network tables
											$this->model->index_postmeta( $postmeta );
										}
									}

									// Get the taxonomy for this local post
									$taxonomy = $this->model->get_taxonomy_for_indexing( $local_id, $item->blog_id );
									$this->debug_message( __FUNCTION__, print_r($taxonomy,true) );
									// Remove any existing ones that we are going to overwrite
									$this->debug_message( __FUNCTION__,  "calling remove_term_relationships_for_post: local_id[". $local_id ."]");

									$this->model->remove_term_relationships_for_post( $local_id, $item->blog_id);
									if(!empty($taxonomy)) {
										$taxonomy_out = '';
										foreach( $taxonomy as $taxkey => $tax ) {
											if (!empty($taxonomy_out)) $taxonomy_out .', ';
											$taxonomy_out .= $tax['name'];
										}
										//echo "taxonomy<pre>"; print_r($taxonomy); echo "</pre>";
										$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, Post ID: %d,  processing taxonomies: %s", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'], $taxonomy_out ) );

										foreach( $taxonomy as $taxkey => $tax ) {
											$tax['blog_id'] = $item->blog_id;
											$tax['object_id'] = $local_id;

											$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("BLog: %d, Post ID: %d, processing taxonomy: %s", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'], $tax['name'] ) );

											$this->model->index_tax( $tax );
										}
									} else {
										$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, Post ID: %d, no associated taxonomies", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'] ) );
									}
									$this->debug_message( __('Second Pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), sprintf( __("Blog: %d, Post ID: %d, End processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id, $post['ID'] ) );

								}

								// Update the rebuild queue with the next post to be processed
								$previous_id = (int) ($local_id - 1);
								if($previous_id > 0) {
									// We may still have posts to process
									$this->model->update_blog_queue( $item->blog_id, $previous_id );
								} else {
									// We've run out of posts now so remove us from the queue
									$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, No Posts left removing from queue.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

									$this->model->remove_blog_from_queue( $item->blog_id );
								}

							}
						} else {
							// We've run out of posts so remove our entry from the queue
							$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, No Posts left removing from queue.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

							$this->model->remove_blog_from_queue( $item->blog_id );
						}

						// Switch back from the blog
						$this->model->restore_current_blog();

					} else {
						// Remove the blog from the queue as something has changed
						$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Blog: %d, is NOT indexable removing from queue.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $item->blog_id ) );

						$this->model->remove_blog_from_queue( $item->blog_id );
						// Remove any existing posts in case we've already indexed them
						$this->model->remove_indexed_entries_for_blog( $item->blog_id );
					}

				}

			}

			$this->debug_message( __('Second Pass',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Finished processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );


		}



		/*
		 * Удаляет теги не привязанные ни к каким постам (осиротевшие)
		 */
		function process_tidy_tags($DEBUG = false) {

			/* $this->debug_message( __('Tags Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Initializing...", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

			// Remove any orphan tax entries from the table
			$this->debug_message( __('Tags Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Removing orphaned taxonomy entries", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );
			$this->model->remove_orphaned_tax_entries();
			// Recalculate the counts for the remaining tax entries
			$this->debug_message( __('Tags Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Recalculating taxonomy counts", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );
			$this->model->recalculate_tax_counts();

			/* $this->debug_message( __('Tags Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Finished processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

		}

		/*
		 * Удаляет post meta не привязанные ни к каким постам (осиротевшие)
		 */
		function process_tidy_postmeta($DEBUG = false) {

			/* $this->debug_message( __('Post Indexer Postmeta Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Initializing...", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

			$this->debug_message( __('Postmeta Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Removing orphaned post meta entries", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) );
			$this->model->remove_orphaned_postmeta_entries();

			/* $this->debug_message( __('Post Indexer Postmeta Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Finished processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

		}

		/*
		 * Удаляет старые посты
		 */
		function process_tidy_agedposts($DEBUG = false) {

			/* запуск */
			/* $this->debug_message( __('Aged Posts Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Initializing...", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

			/* получаем данные из настроек – за какой период времени посты уже оч стары */
			$agedposts = get_site_option( 'postindexer_agedposts', array( 'agedunit' => 1, 'agedperiod' => 'year' ) );

			/* отправляем в дебаг сообщение, что мы в процессе удаления и удаляем */
			$this->debug_message( __('Aged Posts Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), sprintf( __("Removing posts older than: %d %s", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), $agedposts['agedunit'], $agedposts['agedperiod'] ) );
			$this->model->remove_posts_older_than( $agedposts['agedunit'], $agedposts['agedperiod'] );

			/* $this->debug_message( __('Aged Posts Tidy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), __("Finished processing", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ); */

		}

		/*
		 * Регистрирует промежутки времени для Cron
		 */
		function add_time_period( $periods ) {

			if(!is_array($periods)) {
				$periods = array();
			}

			$periods['10mins'] = array( 'interval' => 300, 'display' => __('Every 10 Mins', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) );
			$periods['5mins'] = array( 'interval' => 100, 'display' => __('Every 5 Mins', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) );

			return $periods;
		}

		/*
		 * Самая главная функция, которая создает расписание
		 */
		function set_up_schedule() {

			if ( !wp_next_scheduled( 'postindexer_firstpass_cron' ) ) {
				wp_schedule_event( time(), $this->rebuildperiod, 'postindexer_firstpass_cron' );
			}

			if ( !wp_next_scheduled( 'postindexer_secondpass_cron' ) ) {
				wp_schedule_event( time() + 10 * MINUTE_IN_SECONDS, $this->rebuildperiod, 'postindexer_secondpass_cron' );
			}

			if ( !wp_next_scheduled( 'postindexer_tagtidy_cron' ) ) {
				wp_schedule_event( time() + 20 * MINUTE_IN_SECONDS, 'hourly', 'postindexer_tagtidy_cron' );
			}

			if ( !wp_next_scheduled( 'postindexer_postmetatidy_cron' ) ) {
				wp_schedule_event( time() + 30 * MINUTE_IN_SECONDS, 'hourly', 'postindexer_postmetatidy_cron' );
			}

			if ( !wp_next_scheduled( 'postindexer_agedpoststidy_cron' ) ) {
				wp_schedule_event( time() + 40 * MINUTE_IN_SECONDS, 'hourly', 'postindexer_agedpoststidy_cron' );
			}

		}

		function debug_message( $title, $message ) {
			if( function_exists('error_log') ) {
				$this->model->log_message( $title, $message );
				$this->model->clear_messages( 200 );
			}
		}

	}

}

new multisiteindexerRebuild();
