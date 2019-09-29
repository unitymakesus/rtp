<?php

if ( !class_exists( 'multisiteindexerAdmin' ) ) {

	class multisiteindexerAdmin {

		var $build = 1;

		// The class holder for the db class
		var $db;

		// The post indexer model
		var $model;

		var $global_post_types;

		var $global_post_statuses;

		var $base_url;

		function __construct() {

			global $wpdb;

			$this->db = $wpdb;
			$this->model = new multisiteIndexer();
			$this->base_url = plugins_url( '/', dirname( __FILE__ ) );
			$this->page = 'multisite_indexer';
			$this->page2 = 'multisite_index_settings';
			$this->global_post_types = get_site_option( 'postindexer_globalposttypes', array( 'post' ) );
			$this->global_post_statuses = get_site_option( 'postindexer_globalpoststatuses', array( 'publish', 'inherit' ) );

			/*
			 * Create new tab in particular website settings
			 */
			add_filter( 'network_edit_site_nav_links', array( $this, 'add_tab' ) );
			/*
			 * Create and save option pages
			 */
			add_action( 'network_admin_menu', array( $this, 'add_admin_page' ) );
			add_action( 'load-settings_page_' . $this->page, array( $this, 'process_admin_page' ) );
			add_action( 'current_screen', array( $this, 'validate_tab' ) );
			add_action( 'network_admin_edit_updateindexsettings', array( $this, 'process_index_page' ) );
			/*
			 * Основные уведомления по работе плагина для суперадминов
			 */
			add_action( 'network_admin_notices', array(&$this, 'admin_notices') );
			/*
			 * Немного стилей и скриптов
			 */
			add_action( 'admin_head', array( $this, 'css' ) );
			/*
			 * Ссылка на настройки плагина
			 */
			add_filter( 'plugin_action_links_true-multisite-indexer/true-multisite-indexer.php', array( $this, 'link_to_settings' ) );
 			add_filter( 'network_admin_plugin_action_links_true-multisite-indexer/true-multisite-indexer.php', array( $this, 'link_to_settings' ) );
			/*
			 * Супер классные виджеты
			 */
			add_action('wp_network_dashboard_setup', array( $this, 'dashboard_widgets' ) );
			/*
			 * Тут и локализация подключается
			 */
			add_action( 'plugins_loaded', array(&$this, 'load_textdomain'));


			/*
			 * Интеграция с sites page
			 */
			/* Чисто уведомления, по сути можно это всё отключить и останутся только Settings Saved что годно */
			add_filter( 'network_sites_updated_message_disableindexing', array( $this, 'message_disableindexing' ) );
			add_filter( 'network_sites_updated_message_enableindexing', array( $this, 'message_enableindexing' ) );
			add_filter( 'network_sites_updated_message_rebuildindexing', array( $this, 'message_rebuildindexing' ) );
			/* добавляем колонки */
			add_filter( 'wpmu_blogs_columns', array( $this, 'sites_columns' ), 99 );
			add_action( 'manage_sites_custom_column', array( $this, 'sites_columns_data' ), 99, 2 );

			/* сохранение попапа */
			add_action( 'wpmuadminedit', array( $this, 'process_sites_page' ) );

			/*
			 * Два хука, обрабатывающие сохранение/удаление постов
			 */
			add_action( 'save_post', array( $this, 'index_post' ), 99, 2 );
			add_action( 'delete_post', array( $this, 'delete_post' ), 99 );

			/**
			 * Separate hooks for attachments
			 */
			add_action( 'add_attachment', array( $this, 'index_post' ), 99 );
			add_action( 'edit_attachment', array( $this, 'index_post' ), 99 );

			/**
			 * Remove a blog from index while status changed or removed
			 * @author Misha Rudrastyh
			 */
			if( version_compare( get_bloginfo('version'), '5.1.0', '>=' ) ) {
				add_action( 'wp_uninitialize_site', array( $this, 'remove_from_index' ) ); // WP_Site object is passed
				add_action( 'wp_update_site', array( $this, 'remove_from_index_based_on_status' ), 20, 2 );
			} else {
				add_action( 'make_spam_blog', array( $this, 'remove_from_index' ) );
				add_action( 'archive_blog', array( $this, 'remove_from_index' ) );
				add_action( 'mature_blog', array( $this, 'remove_from_index' ) );
				add_action( 'deactivate_blog', array( $this, 'remove_from_index' ) );
				add_action( 'delete_blog', array( $this, 'remove_from_index' ) );
			}

			add_action( 'blog_privacy_selector', array( $this, 'check_privacy' ) );


		}

		/*------------------------------------------------------------------------
		---Functions------------------------------------------------------------
		------------------------------------------------------------------------*/
		/*
		 * Add new Index tab
		 */
		function add_tab( $tabs ){

			$tabs['site-multisite-index'] = array(
				'label' => __( 'Index', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ),
				'url' => 'sites.php?page='.$this->page2,
				'cap' => 'manage_sites'
			);
			return $tabs;

		}
		/*
		 * Добавляется само меню
		 */
		function add_admin_page() {
			add_submenu_page( 'settings.php', __( 'Network Index', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), __( 'Index', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), 'manage_network_options', $this->page, array( $this, 'handle_admin_page' ) );
			add_submenu_page( 'sites.php', 'Index', 'Index', 'manage_network_options', $this->page2, array( $this, 'handle_index_page' ) );
		}
		function handle_admin_page() {

			$current_tab = !empty( $_GET['tab'] ) ? $_GET['tab'] : 'globaloptions';
			$tabs = array(
				'globaloptions' => __('Globals', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ),
				'rebuildindex' => __('Rebuild Index', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ),
				'log' => __('Debug log', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ),
				'license' => __('License', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN )
			);


			/* немного стилей непосредственно для этой страницы и начало HTML  */
			?><style>#mishamultioptions h1{padding:0}#mishamultioptions form p.description{margin-top:20px}#mishamultioptions h1+.notice{margin-top:20px}</style>
			<div id="mishamultioptions" class="wrap nosubsub"><h1></h1><h2 class="nav-tab-wrapper"><?php

				foreach( $tabs as $tab => $name ){
					echo "<a class='nav-tab" . ( ( $tab == $current_tab ) ? ' nav-tab-active' : '' ) . "' href='?page=" . $this->page . "&tab=$tab'>$name</a>";
				}

			?></h2><form method="post" action=""><?php

				/* если ребилд уже в процессе, то показываем сообщение, причем на всех вкладках */
				if($this->model->blogs_for_rebuilding()) {
					echo '<div id="multisiteindexnotice" class="notice notice-info"><p><span class="dashicons dashicons-clock" style="font-size: 16px;line-height: 19px;"></span>&nbsp;&nbsp;' . __('Indexing is currently in process.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) . '</p></div>';
				}
				/* возможно нужно отобразить одно из следующих сообщение */
				if ( isset($_GET['saved']) ) {
					if( $_GET['saved'] == 2 ) {
						echo '<div id="message" class="updated fade"><p>' . __('Rebuilding of the Post Index has been scheduled.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) . '</p></div>';
					}else if( $_GET['saved'] == 1 ) {
						echo '<div id="message" class="updated fade"><p>' . __('Your settings have been updated.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) . '</p></div>';
					}
				}

				wp_nonce_field('true_multisite_options');
				echo '<input type="hidden" name="action" value="true_multisite_' . $current_tab . '" />';

				switch($current_tab) {
					/*
					 * Вкладка Rebuild Index
					 */
					case 'rebuildindex':
						?><p class='description'><?php _e('You can rebuild the Post Index by clicking on the <strong>Rebuild Index</strong> button below.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></p>
						<p class='description'><?php _e("Note: This may take a considerable amount of time and could impact the performance of your server.",TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></p>
						<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Rebuild Index',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?>" /></p>
						<?php
						break;
					/*
					 * Вкладка Log
					 */
					case 'log':
						?><p class='description'><?php _e("Showing the most recent <strong>200</strong> log entries.",TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) ?></p>
						<table class="form-table"><tbody><?php
								$logs = $this->model->get_log_messages( 200 );
								if(!empty($logs)) {
									$class = 'alt';
									foreach($logs as $log) {
										echo '<tr class="logentry ' . $class . '"><td valign=top><strong>' . $log->log_title . '</strong><br/>' . $log->log_details . '</td><td valign=top align=right>' . $log->log_datetime . '</td></tr>';
										$class = ( $class == '' ) ? 'alt' : '';
									}
								}
						?></tbody></table><?php
						break;
					/*
					 * Вкладка Основных настроек
					 */
					case 'globaloptions':
						?><p class="description"><?php echo sprintf(__("The settings below allow you to set the defaults for all the sites in your network and processing that will take place across your entire index. You can override some of these settings on a site by site basis via the <a href=%s>Sites admin page</a>.",TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), network_admin_url('sites.php') ); ?></p>
						<table class="form-table"><tbody>
							<tr valign="top">
								<th scope="row"><label for="post_types"><?php _e('Default Post Types',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></th>
								<td><textarea id="post_types" name="post_types" cols="80" rows="5"><?php echo implode("\n", $this->global_post_types); ?></textarea><br /><span class="description"><?php _e('These are the default post types that will be indexed by the plugin. Place each post type on a seperate line.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="post_statuses"><?php _e('Default Post Statuses',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></th>
								<td><textarea id="post_statuses" name="post_statuses" cols="80" rows="5"><?php echo implode("\n", $this->global_post_statuses); ?></textarea><br/><span class="description"><?php _e('These are the default post statuses that will be indexed by the plugin. Place each post status on a seperate line. <br />Please be careful if you want to change it.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></span></td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="agedperiod"><?php _e('Remove indexed posts older than',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></th>
								<td><?php $agedposts = get_site_option( 'postindexer_agedposts', array( 'agedunit' => 1, 'agedperiod' => 'year' ) ); ?>
									<select name='agedunit'><?php
										for($n = 1; $n <= 365; $n++) {
											?><option value='<?php echo $n; ?>' <?php selected($n, $agedposts['agedunit']); ?>><?php echo $n; ?></option><?php
										}
									?></select>&nbsp;
									<select name='agedperiod'>
										<option value='hour' <?php selected('hour', $agedposts['agedperiod']); ?>><?php _e('Hour(s)',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
										<option value='day' <?php selected('day', $agedposts['agedperiod']); ?>><?php _e('Day(s)',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
										<option value='week' <?php selected('week', $agedposts['agedperiod']); ?>><?php _e('Week(s)',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
										<option value='month' <?php selected('month', $agedposts['agedperiod']); ?>><?php _e('Month(s)',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
										<option value='year' <?php selected('year', $agedposts['agedperiod']); ?>><?php _e('Year(s)',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
									</select>&nbsp;<br/>
									<span class="description"><?php _e('Posts older than this time span will be removed from the global index.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="gsearch"><?php _e('Global Search <sup>beta</sup>',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></th>
								<td><?php $gsearch = get_site_option( 'postindexer_gsearch' ); ?>
									<select id="gsearch" name='gsearch'>
										<option value=''><?php _e('Off', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></option>
										<option value='widget' <?php selected('widget', $gsearch); ?>><?php _e('Add the Global Search widget',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
										<option value='replace' <?php selected('replace', $gsearch); ?>><?php _e('Replace the default WordPress search',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></option>
									</select>&nbsp;<br/>
									<span class="description"><?php _e('If you don\'t like to mess with the code, this feature allows you to add the Global Search widget on your website<br />or to replace default WordPress search results with the global search results.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><label for="gsearch"><?php _e('Indexed Posts Page',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></th>
								<td><label><input type="checkbox" name="hide_indexed_posts_page" <?php checked('on', get_site_option( 'hide_indexed_posts_page' ) ) ?> />&nbsp;<?php _e('Hide from Network Dashboard',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></label></td>
							</tr>
						</tbody></table>
						<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p><?php
						break;
					/*
					 * Вкладка Лицензии
					 */
					case 'license':
						?><p class="description"><?php _e('License key is required to receive the latest plugin updates. Please note, that your license key is the billing email you purchased the plugin with (If you did it with PayPal, it is your PayPal email). If you don\'t set anything here, your main website email will be used.', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></p>
						<table class="form-table"><tbody>
							<tr>
								<th scope="row"><label for="mishmul_license_key"><?php _e('License key', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></label></th>
								<td><input type="email" id="mishmul_license_key" name="mishmul_license_key" value="<?php echo get_site_option('_misha_true-multisite-indexer_license_key') ?>" placeholder="<?php echo get_site_option('admin_email') ?>"></td>
							</tr>
						</tbody></table>
						<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p><?php
						break;
				}
			?></form></div><!-- #mishamultioptions --><?php
		}
		function process_admin_page() {
			/* если не существует экшена, не делаем ничего*/
			if(!isset($_POST['action'])) return;
			/* nonce check */
			check_admin_referer('true_multisite_options');

			switch( $_POST['action'] ) {
				/* process rebuild index tab */
				case 'true_multisite_rebuildindex':
					$this->model->rebuild_all_blogs();
					wp_safe_redirect( add_query_arg( array( 'saved' => 2 ), wp_get_referer() ) );
					exit;
					break;
				/* process global options tab */
				case 'true_multisite_globaloptions':
					update_site_option( 'postindexer_globalposttypes', array_map('trim', explode("\n", $_POST['post_types'] ) ) );
					update_site_option( 'postindexer_globalpoststatuses', array_map('trim', explode("\n", $_POST['post_statuses'] )) );
					update_site_option( 'postindexer_agedposts', array( 'agedunit' => (int) $_POST['agedunit'], 'agedperiod' => $_POST['agedperiod'] ) );
					update_site_option( 'postindexer_gsearch', $_POST['gsearch'] );
					$hide_indexed_posts_page = isset( $_POST['hide_indexed_posts_page'] ) ? $_POST['hide_indexed_posts_page'] : '';
					update_site_option( 'hide_indexed_posts_page', $hide_indexed_posts_page );
					wp_safe_redirect( add_query_arg( array( 'saved' => 1 ), wp_get_referer() ) );
					exit;
					break;
				/* process license tab */
				case 'true_multisite_license' :
					if( !empty( $_POST['mishmul_license_key'] ) && $_POST['mishmul_license_key'] ) {
						// _misha_{plugin slug}_license_key
						update_site_option( '_misha_true-multisite-indexer_license_key', $_POST['mishmul_license_key'] );
					} else {
						delete_site_option( '_misha_true-multisite-indexer_license_key' );
					}
					
					delete_site_transient( 'misha_upgrade_mul470e2_9t8t' );
					wp_safe_redirect( add_query_arg( array( 'saved' => 1 ), wp_get_referer() ) );
					exit;
					break;
			}
		}

		/*
		 * now let's handle particular index pages
		 */
		function handle_index_page(){

			$id = $_REQUEST['id'];
			$details = get_site( $id );

			?><div class="wrap">
				<h1 id="edit-site"><?php echo sprintf( __( 'Edit Site: %s' ), esc_html( $details->blogname ) ) ?></h1>
				<p class="edit-site-actions"><a href="<?php echo esc_url( get_home_url( $id, '/' ) ) ?>">Visit</a> | <a href="<?php echo esc_url( get_admin_url( $id ) ) ?>">Dashboard</a></p>
 			<?php

				network_edit_site_nav( array(
					'blog_id'  => $id,
					'selected' => 'site-multisite-index'
				) );

			?><style>
				#menu-site .wp-submenu li.wp-first-item{
					font-weight:600;
				}
				#menu-site .wp-submenu li.wp-first-item a{
					color:#fff;
				}
			</style>
			<script>
			jQuery(function($){
				$('#postindexer_active').change(function(){
					if( $(this).val() == 'yes' ) {
						$('#postindexer_posttypes_tr').show();
					} else {
						$('#postindexer_posttypes_tr').hide();
					}
				});
			});
			</script>
			<form method="post" action="edit.php?action=updateindexsettings"><?php
				wp_nonce_field( 'misha-update-index'.$id );
				?><input type="hidden" name="id" value="<?php echo $id ?>" />
				<table class="form-table">
					<tr>
						<th scope="row"><label for="postindexer_active"><?php _e('Indexing', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></label></th>
						<td>
							<?php $indexing = get_blog_option( $id, 'postindexer_active', 'yes' ); ?>
							<select name="postindexer_active" id="postindexer_active">
								<option value="yes" <?php selected( $indexing, 'yes' ); ?>><?php _e('Enabled', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></option>
								<option value="no" <?php selected( $indexing, 'no' ); ?>><?php _e('Disabled', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="postindexer_posttypes_tr" <?php if( $indexing == 'no' ) echo ' style="display:none"' ?>>
						<th scope="row"><?php _e("Post Types",TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th>
						<td>
							<?php
								$indexingtypes = get_blog_option( $id, 'postindexer_posttypes', $this->global_post_types );
								// was: $post_types = get_post_types( '' , 'objects' );
								if( $post_types = $this->model->get_active_post_types() ) :
							?>
							<fieldset>
								<?php
								foreach( $post_types as $post_type ) {
									echo '<label><input type="checkbox" name="postindexer_posttypes[]" value="' . $post_type . '" ' . ( in_array($post_type, $indexingtypes) ? 'checked="checked"' : '' ) . ' />&nbsp;' . $post_type . '</label><br/>';
								}
								?>
							</fieldset>
							<p class="description"><?php _e('Select post types you would like to be indexed for this site.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<?php if( get_site_option( 'postindexer_gsearch' ) == 'replace' ): ?>
						<tr>
							<th><?php _e('Global Search', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></th>
							<td>
								<?php $nsearch = get_blog_option( $id, 'misha_network_search', 'no' ); ?>
								<select name="misha_network_search" id="misha_network_search">
									<option value="yes" <?php selected( $nsearch, 'yes' ); ?>><?php _e('Enabled', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></option>
									<option value="no" <?php selected( $nsearch, 'no' ); ?>><?php _e('Disabled', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></option>
								</select>
								<p class='description'><?php _e('The default search results for this site will be automatically replaced with the global search results. This functionality is still experimental and isn\'t supported by some themes.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></p>
							</td>
						</tr>
					<?php endif; ?>
				</table>
				<?php submit_button() ?>
			</form></div><?php


		}

		function validate_tab(){
			$screen = get_current_screen();
			if( $screen->id !== 'sites_page_' . $this->page2 . '-network' ) {
				return;
			}

			// $id is a blog ID
			$id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

			if ( ! $id ) {
				wp_die( __('Invalid site ID.') );
			}

			$details = get_site( $id );
			if ( ! $details ) {
				wp_die( __( 'The requested site does not exist.' ) );
			}
		}

		function process_index_page(){

			if( empty( $_POST['id'] ) ) return;

			$blog_id = $_POST['id'];

			check_admin_referer('misha-update-index'.$blog_id); // security check

			/* indexing */
			if( $_POST['postindexer_active'] == 'yes') {
				$indexing = get_blog_option( $blog_id, 'postindexer_active', 'yes' );
				// the index will be set to rebuild so we do not want to do it another time
				if($indexing != 'yes') {
					$this->model->enable_indexing_for_blog( $blog_id );
				}
			} elseif( $_POST['postindexer_active'] == 'no' ) {
					$this->model->disable_indexing_for_blog( $blog_id );
			}

			/* Post types */
			$post_types = !empty( $_POST['postindexer_posttypes'] ) ? $_POST['postindexer_posttypes'] : array();
			array_map('trim', $post_types);
			update_blog_option( $blog_id, 'postindexer_posttypes', array_values( $post_types ) );


			/* global search */
			if( isset( $_POST['misha_network_search'] ) ) {
				if( $_POST['misha_network_search'] == 'yes' ) {
					update_blog_option( $blog_id, 'misha_network_search', 'yes' );
				} else {
					update_blog_option( $blog_id, 'misha_network_search', 'no' );
				}
			}

			wp_redirect( add_query_arg( array(
				'page' => $this->page2,
				'id' => $blog_id,
				'updated' => true ), network_admin_url('sites.php')
			));

			exit;

		}


		/*
		 * Notices
		 */
		function admin_notices() {
			if ( isset($_GET['page']) && $_GET['page'] == $this->page ) {
				if ((defined('DISABLE_WP_CRON')) && (DISABLE_WP_CRON == true)) {
					echo '<div id="post-indexer-error" class="error"><p>' . __('Your site has <strong>DISABLE_WP_CRON</strong> defined as <strong>true</strong>. In most cases this means the plugin may not properly index your site(s) as it relies on the WordPress scheduler (WP_Cron). If you are running an alternate cron you can ignore this message.', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) . '</p></div>';
				}
				//echo '<pre>';print_r(_get_cron_array());echo '</pre>';
				$cron_array = _get_cron_array();
				foreach( $cron_array as $key=>$value ) :
					if( time() > $key + 500 ) {
						echo '<div id="post-indexer-error" class="error" style="margin:10px 0;"><p><strong>It looks like some of WP_Cron (WordPress scheduler) jobs are past due.</strong><br /> In most cases this means the plugin will index well only new posts you publish. If it is OK for you, just ignore this message.<br />If you need old posts to be indexed, you should fix the Cron scheduler on your server &mdash; please contact your server technical support &mdash; they should help with this.</p></div>';
						break;
					}
				endforeach;
			}
			if( isset($_GET['page']) && $_GET['page'] == $this->page2 && isset( $_GET['updated'] )  ) {
				echo '<div id="message" class="updated notice is-dismissible"><p>' . __('Site index settings updated.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) . '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
			}
		}

		/*
		 * CSS for network widgets etc
		 */
		function css(){
			?><style>
			.network_index_most_indexed ul{margin:10px 0 0;display:inline-block;width:100%}
			.network_index_most_indexed ul li{width:50%;float:left;margin-bottom:10px;color:#82878c}
			.network_index_most_indexed ul li:before{color:#82878c;font:400 20px/1 dashicons;speak:none;display:inline-block;position:relative;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-decoration:none!important;vertical-align:top;content:"\f159";padding:0 8px 0 0}
			.network_index_most_indexed ul li.post-count:before{content:"\f109"}
			.network_index_most_indexed ul li.page-count:before{content:"\f105"}
			.network_index_most_indexed ul li.product-count:before{content:"\f174"}
			.network_index_most_indexed ul li.tmi-blog-count:before{content:"\f319"}
			#misha_network_index_stat .inside div{margin:15px 0}
			#misha_network_index_stat .inside div:last-child{margin-bottom:0}
			tr.logentry.alt{background-color:#eee}
			tr.logentry{border:1px solid #ccc}
			div.postbox{margin-top:5px;margin-bottom:15px;background:#fff}
			div.postbox div.inside{}
			.network_rebuild_q_summary table{margin-top:5px;width:100%;margin-bottom:5px}
			.network_rebuild_q_summary table tbody tr td.heading{text-align:right;width:20%;line-height:1.4em;padding:5px 5px 5px 10px}
			tr.spacer,td.spacer{background-color:#ececec}
			div.inside div.table table tbody tr td.spacer span{text-shadow:0 1px 0 #FFFFFF;font-size:12px;color:#000;line-height:1.4em;margin-left:10px;font-style:normal;font-weight:bold}
			div.table table tbody tr td p{padding-left:10px;padding-top:0px;margin-top:0px;margin-bottom:0px}
			.network_rebuild_q_summary table tbody tr td{color:#82878c;line-height:1.4em;padding-right:5px;padding-top:5px;padding-bottom:5px;vertical-align:top}
			.network_rebuild_q_summary table tbody tr td span{font-size:11px;font-style:italic}
			h2.hndle2 {font-size: 14px;padding: 8px 12px;margin: 0;line-height: 1.4;border-bottom: 1px solid #eee;}
			div.postbox div.inside p{padding:5px 0;margin:5px 0}
			div.postbox div.inside div.line{display:block;border-top:1px solid #dfdfdf;width:100%}
			#last-indexed-stats table.widefat td{padding-top:5px;padding-bottom:5px}
			div.smallrebuildclock{display:inline-block;width:16px;height:16px;background-position:center center}
			#multisiteindexnotice{margin:10px 0}
			#true_blog_id{width: 70px}
			#menu-site .wp-submenu li a[href="sites.php?page=<?php echo $this->page2 ?>"]{
				display:none;
			}
			</style><?php
		}

		/*
		 * Просто ссылка на настройки со страницы плагинов, но только если у чела есть права
		 */
		function link_to_settings( $links ){
			if( current_user_can( 'manage_network_options' ) ) {
				$links = array_merge( array( '<a href="' . network_admin_url( 'settings.php?page=' . $this->page ) . '">' . __('Settings') . '</a>' ), $links );
			}
			return $links;
		}

		/*
		 * Network Dashboard Widgets
		 */
		function dashboard_widgets(){
			wp_add_dashboard_widget('misha_network_index_stat', __('Network Index Statistics',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), array( $this, 'dash_widget_stats' ) );
			add_meta_box('misha_network_index_recent_posts',  __('Recently Indexed Posts',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), array( $this, 'dash_widget_posts' ), 'dashboard-network', 'side', 'high' );
			add_meta_box('misha_network_index_recent_terms',  __('Recently Indexed Terms',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN), array( $this, 'dash_widget_terms' ), 'dashboard-network', 'side', 'high' );
		}
		function dash_widget_stats(){
			// предположим, что никаких данных у нас нет, то в дальнейшем нужно вывести сообщение, а не пустые тейблы
			$no_data_available = true;
			$post_type_counts = $this->model->get_summary_post_types();
			if( !empty( $post_type_counts ) ) :
				$no_data_available = false;
				?>
				<div class="network_index_most_indexed">
					<h3><?php _e('Indexed Post Types', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) ?></h3>
					<ul><?php
						foreach($post_type_counts as $cpt) {
							echo '<li class="' . $cpt->post_type . '-count">' . $cpt->post_type_count . ' ' . $cpt->post_type . '</li>';
						}
					?></ul>
				</div><?php
			endif;
			$blog_counts = $this->model->get_summary_blog_totals();
			if( !empty( $blog_counts ) ) :
				$no_data_available = false;
					?><div class="network_rebuild_q_summary">
						<h3><?php _e('Most Indexed Sites', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ) ?></h3>
						<table><tbody><?php
							foreach($blog_counts as $bc) {
								echo '<tr><td class="first">' . $bc->blog_count . '</td><td>' . get_blog_option( $bc->BLOG_ID, 'blogname') . '</td></tr>';
							}
						?></tbody></table>
					</div><?php
			endif;
			if($this->model->blogs_for_rebuilding()) :
				$no_data_available = false;
				?><div class="network_rebuild_q_summary">
					<h3><?php _e('Current Rebuild Queue Summary', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></h3>
					<table><tbody>
						<tr><td class="first"><?php echo $this->model->get_summary_sites_in_queue(); ?></td><td><?php _e('Sites in queue', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></td></tr>
						<tr><td class="first"><?php echo $this->model->get_summary_sites_in_queue_processing(); ?></td><td><?php _e('Sites currently being processed', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></td></tr>
						<tr><td class="first"><?php echo $this->model->get_summary_sites_in_queue_not_processing(); ?></td><td><?php _e('Sites awaiting processing', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></td></tr>
						<tr><td class="first"><?php echo $this->model->get_summary_sites_in_queue_finish_next_pass(); ?></td><td><?php _e('Sites will complete processing on next pass', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ); ?></td></tr>
					</tbody></table>
				</div><?php
			endif;
			// и в самом конце, если данных нет, то выводим сообщение с предложением о ребилде индекса
			if( $no_data_available == true ) :
				echo sprintf( __("No data available. Try to rebuild index on <a href='%s'>this page</a>.", TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), network_admin_url('settings.php?page=' . $this->page . '&amp;tab=rebuildindex'));
			endif;
		}
		function dash_widget_posts(){

			// сначала вытаскиваем недавно индексируемый посты
			$recent = $this->model->get_summary_recently_indexed();
			// только если они существуют, то выводим таблицу
			if(!empty($recent)) :
			?>
			<table class='widefat'>
				<thead><tr><th scope="col"><?php _e('Post Title',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Post Type',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Site',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th></tr></thead>
				<tfoot><tr><th scope="col"><?php _e('Post Title',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Post Type',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Site',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th></tr></tfoot>
				<tbody><?php
					$class = 'alt';
					foreach( $recent as $r ) :
						switch_to_blog( $r->BLOG_ID );
							?><tr class='<?php echo $class; ?>'>
								<td style='width: 50%;' valign=top><a href='<?php echo get_option( 'home' ); ?>/wp-admin/post.php?post=<?php echo $r->ID ?>&amp;action=edit'><?php echo $r->post_title; ?></a></td>
								<td style='width: 25%;'><?php echo $r->post_type ?></td>
								<td style='width: 25%;' valign=top><a href='<?php echo get_option( 'home' ); ?>/wp-admin'><?php echo get_option( 'blogname' ); ?></a></td>
							</tr><?php
						restore_current_blog();
						$class = ( $class == '' ) ? 'alt' : '';
					endforeach;
				?></tbody></table><?php
				else :
					_e( 'No posts have been indexed yet.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
				endif;
		}
		function dash_widget_terms(){
			// сначала вытаскиваем недавно индексируемый термины
			$recent = $this->model->get_summary_recently_indexed_terms();
			// только если они существуют, то выводим таблицу
			if(!empty($recent)) :
			?>
			<table class='widefat'>
				<thead><tr><th scope="col"><?php _e('Term Name',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Taxonomy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Site',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th></tr></thead>
				<tfoot><tr><th scope="col"><?php _e('Term Name',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Taxonomy',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th><th scope="col"><?php _e('Site',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></th></tr></tfoot>
				<tbody><?php
					$class = 'alt';
					foreach( $recent as $r ) :
						//print_r( $r );
						switch_to_blog( $r->blog_id );
							?><tr class='<?php echo $class; ?>'>
								<td style='width: 50%;' valign=top><a href='<?php echo get_option( 'home' ); ?>/wp-admin/edit-tags.php?action=edit&amp;taxonomy=<?php echo $r->taxonomy; ?>&amp;tag_ID=<?php echo $r->term_local_id; ?>'><?php echo $r->name; ?></a></td>
								<td style='width: 25%;'><?php echo $r->taxonomy; ?></td>
								<td style='width: 25%;' valign=top><a href='<?php echo get_option( 'home' ); ?>/wp-admin'><?php echo get_option( 'blogname' ); ?></a></td>
							</tr><?php
						restore_current_blog();
						$class = ( $class == '' ) ? 'alt' : '';
					endforeach;
				?></tbody></table><?php
				else :
					_e( 'No terms have been indexed yet. Please note, that empty terms won\'t be indexed.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
				endif;
		}

		/*
		 * Тут и локализация подключается
		 */
		function load_textdomain() {
			//echo dirname( plugin_basename( __FILE__ ) ) . '/lang/'; exit;
			if (preg_match('/mu\-plugin/', PLUGINDIR) > 0) {
			load_muplugin_textdomain( TRUE_MULTISITE_INDEXER_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/../lang/' );
			} else {
				load_plugin_textdomain( TRUE_MULTISITE_INDEXER_TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/../lang/' );
			}
		}

		/*------------------------------------------------------------------------
		------------------------Sites page---------------------------------------
		------------------------------------------------------------------------*/
		/*
		 * Кастомные красивые уведомления, сейчас возможно было обойтись и без них, но в будущем могут пригодиться
		 */
		function message_disableindexing(){
			return __('Indexing disabled for the requested site.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
		}
		function message_enableindexing(){
			return __('Indexing enabled for the requested site.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
		}
		function message_rebuildindexing(){
			return __('Index scheduled for rebuilding for the requested site.',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
		}

		/*
		 * Колонки
		 */
		function sites_columns( $columns ) {
			$columns['true_blog_id'] = __('Blog ID', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
 			$columns['true_indexer'] = __('Indexing', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN);
 			return $columns;
 		}
 		function sites_columns_data( $column_name, $blog_id ) {
			switch( $column_name ) :
				case 'true_blog_id':{
					echo $blog_id;
					break;
				}
				case 'true_indexer':{
	 				$indexing = get_blog_option( $blog_id, 'postindexer_active', 'yes' );
	 				if( $indexing == 'yes' ) {

	 					// Find out if this is in the queue
	 					if($this->model->is_in_rebuild_queue( $blog_id )) {
	 						echo '<span class="dashicons dashicons-clock" style="font-size: 16px;line-height: 19px;"></span>';
	 					}
	 					$posttypes = get_blog_option( $blog_id, 'postindexer_posttypes', $this->global_post_types );
	 					$printtypes = array();
	 					foreach ($posttypes as $posttype ){
	 						$printtypes[] = $posttype . ' (' . $this->model->get_summary_by_blog_id_and_post_type($blog_id, $posttype) . ')';
	 					}
	 					echo implode(', ', $printtypes);
	 					$h = '';
	 					if( get_site_option( 'postindexer_gsearch' ) == 'replace' )
	 						$h = '&amp;height=455';
	 					?>
	 					<div class="row-actions">
	 						<span class="disable">
	 							<a class='postindexersitedisablelink' href='<?php echo wp_nonce_url( network_admin_url("sites.php?action=disablesitepostindexer&amp;blog_id=" . $blog_id . ""), 'disable_site_postindexer_' . $blog_id); ?>'><?php _e('Disable',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></a>
	 						</span> |
	 						<span class="rebuild">
	 							<a class='postindexersiterebuildlink' href='<?php echo wp_nonce_url( network_admin_url("sites.php?action=rebuildsitepostindexer&amp;blog_id=" . $blog_id . ""), 'rebuild_site_postindexer_' . $blog_id); ?>'><?php _e('Rebuild',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></a>
	 						</span>
	 					</div>
	 					<?php
	 				} else {
	 					_e('Not Indexing', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN );
	 					?>
	 					<div class="row-actions">
	 						<span class="enable">
	 							<a class='postindexersiteenablelink' href='<?php echo wp_nonce_url( network_admin_url("sites.php?action=enablesitepostindexer&amp;blog_id=" . $blog_id . ""), 'enable_site_postindexer_' . $blog_id); ?>'><?php _e('Enable',TRUE_MULTISITE_INDEXER_TEXT_DOMAIN); ?></a>
	 						</span>
	 					</div>
	 					<?php
	 				}
					break;
 				}
				default:{
					break;
				}
			endswitch;
 		}

		/*
		 * Обработка всех действий на Sites page
		 */
		function process_sites_page() {
			/* ??? пока не уверен, нужна ли тут проверка */
			if ( !current_user_can( 'manage_sites' ) )
				wp_die( __( 'You do not have permission to access this page.' ) );

			/* если не существует action, то не происходит ничего */
			if( isset( $_GET['action'] ) && isset( $_GET['blog_id'] ) && $_GET['blog_id'] != '0' ) :
				$blog_id = $_GET['blog_id'];
				switch($_GET['action']) :
					case 'disablesitepostindexer':
						check_admin_referer('disable_site_postindexer_' . $blog_id);
						$this->model->disable_indexing_for_blog( $blog_id );
						wp_safe_redirect( add_query_arg( array( 'updated' => 'disableindexing' ), wp_get_referer() ) );
						break;
					case 'enablesitepostindexer':
						check_admin_referer('enable_site_postindexer_' . $blog_id);
						$this->model->enable_indexing_for_blog( $blog_id );
						wp_safe_redirect( add_query_arg( array( 'updated' => 'enableindexing' ), wp_get_referer() ) );
						break;
					case 'rebuildsitepostindexer':
						check_admin_referer('rebuild_site_postindexer_' . $blog_id);
						$this->model->rebuild_blog( $blog_id );
						wp_safe_redirect( add_query_arg( array( 'updated' => 'rebuildindexing' ), wp_get_referer() ) );
						break;
					default:
						break;
				endswitch;
			endif;
		}

		/*
		 * Функция, индексирующая определённый пост
		 */
		function index_post( $post_id, $post = '' ) {



			/* проверяем, этот блог вообще индесируем?*/
			if( $this->model->is_blog_indexable( $this->db->blogid ) ) {
				// For this we will grab the post regardless if it is one we want to index so we can remove non-indexable ones
				$post = $this->model->get_post_for_indexing( $post_id, false, false );
				// print_r( $post ); echo $post_id; exit;
				if( !empty($post) ) {
					// Check if we are a revision, and if so then grab the proper post
					if( $post['post_type'] == 'revision' && ((int) $post['post_parent'] > 0) ) {
						// Grab the parent_id and then grab that post
						$post_id = (int) $post['post_parent'];
						$post = $this->model->get_post_for_indexing( $post_id, false, false );
					}
					// Check if the post should be indexed or not
					if($this->model->is_post_indexable( $post ) ) {
						// Get the local post ID
						$local_id = $post['ID'];
						// Add in the blog id to the post record
						$post['BLOG_ID'] = $this->db->blogid;
						// Add the post record to the network tables
						$this->model->index_post( $post );
						// Get the post meta for this local post
						$meta = $this->model->get_postmeta_for_indexing( $local_id );
						// Remove any existing ones that we are going to overwrite
						$this->model->remove_postmeta_for_post( $local_id );
						if(!empty($meta)) {
							foreach( $meta as $metakey => $postmeta ) {
								// Add in the blog_id to the table
								$postmeta['blog_id'] = $this->db->blogid;
								// Add it to the network tables
								$this->model->index_postmeta( $postmeta );
							}
						}

						// $this->model->log_message( 'test log message', 'ok' );
						// Get the taxonomy for this local post
						$taxonomy = $this->model->get_taxonomy_for_indexing( $local_id );
						// Remove any existing ones that we are going to overwrite
						$this->model->remove_term_relationships_for_post( $local_id, $this->db->blogid );
						if(!empty($taxonomy)) {
							foreach( $taxonomy as $taxkey => $tax ) {
								$tax['blog_id'] = $this->db->blogid;
								$tax['object_id'] = $local_id;
								$this->model->index_tax( $tax );
							}
						}
					} else {
						// The post isn't indexable so we should try to remove it in case it already exists and we're just updating it
						$this->delete_post( $post_id );
					}
				}
			} else {
				// Remove any existing posts in case we've already indexed them
				if( isset( $item ) ) {
					$this->model->remove_indexed_entries_for_blog( $item->blog_id );
				}
			}
		}

		/*
		 * Функция, удаляющая определённый пост
		 */
		function delete_post( $post_id ) {
			$this->model->remove_indexed_entry_for_blog( $post_id, $this->db->blogid );
		}

		/**
		 * Remove a blog from Index
		 *
		 * @param object|int $blog Blog ID or WP_Site object
		 * @author Misha Rudrastyh
		 */
		function remove_from_index( $blog ) {

			// we can pass objects here
			if ( is_object( $blog ) ) {
				$blog = $blog->blog_id;
			}

			// Remove the blog from the queue in case it is still in there
			$this->model->remove_blog_from_queue( $blog );
			// Remove any existing entries in the network index
			$this->model->remove_indexed_entries_for_blog( $blog );
		}

		/**
		 * Remove blog from Index depending on status change
		 *
		 * @param object $new_blog WP_Site object
		 * @param object $old_blog WP_Site object
		 * @author Misha Rudrastyh
		 */
		function remove_from_index_based_on_status( $new_blog, $old_blog ) {
			// Deactivated / Spam / Archived / Mature
			if( $new_blog->deleted && !$old_blog->deleted
				|| $new_blog->spam && !$old_blog->spam
				|| $new_blog->archived && !$old_blog->archived
				|| $new_blog->mature && !$old_blog->mature
			) {
				$this->remove_from_index( $new_blog->blog_id );
			}
		}


		function check_privacy() {

                        $settings_updated = isset($_GET['settings-updated'])? $_GET['settings-updated']: false;

			if ($settings_updated ===true  ) {
				$blog_public = get_blog_status( $this->db->blogid, 'public');
				if( $blog_public != '1') {
					$this->remove_from_index( $this->db->blogid );
				}
			}

		}


	}
}

new multisiteindexerAdmin();
