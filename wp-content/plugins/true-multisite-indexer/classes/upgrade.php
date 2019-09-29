<?php
/**
 * Updater Class
 * Within a multisite environment this class works in two cases: 1) activated for MS 2) activated on first website of MS
 *
 * @version 7.4
 * @author Misha Rudrastyh
 */
if( !class_exists( 'mishaUpgrade2' ) ) {
	class mishaUpgrade2{

		public $enable_caches = true;
		public $update_host = 'https://rudrastyh.com';

		function __construct( $update_slug, $plugin_slug, $plugin_id, $version, $text_domain, $license_link = array() ){

			// params from outside
			$this->version = $version;
			$this->update_slug = $update_slug;
			$this->plugin_slug = $plugin_slug;
			$this->plugin_id = $plugin_id;
			$this->text_domain = $text_domain;
			$this->license_link = $license_link;
			// our update hooks
			add_filter('plugins_api', array($this, 'info'), 20, 3);
			//add_filter( 'plugins_api_result', array( $this, 'debug_api'), 9999 );
			add_filter('site_transient_update_plugins', array( $this, 'update')); //WP 3.0+
			add_action( 'upgrader_process_complete', array( $this, 'after_update' ), 10, 2 );
			// добавляется именно в конце сообщения плагина
			add_action( 'in_plugin_update_message-' . $plugin_slug . '/' . $plugin_slug . '.php', array( $this, 'update_message' ), 10, 2 );
			//add_action( 'after_plugin_row_' . $plugin_slug . '/' . $plugin_slug . '.php', array( $this, 'updmessage' ), 10, 3 );
			// очищаем кэш при обновлении емайл админка
			add_action( 'update_option_admin_email', array( $this, 'clear_update_cache'), 10, 2 );
			add_filter( 'plugin_row_meta', array($this, 'check_for_updates_link'), 10, 4);
			add_action( 'admin_init', array( $this, 'manual_check') );
			// сообщение для страниц настроек плагина
			add_action( 'admin_notices', array( $this, 'notice') );
			add_action( 'network_admin_notices', array( $this, 'notice') );
			#### to do – то ж само для мультисайта
			add_action( 'admin_post_flush_transients_' . $plugin_slug, array( $this, 'flush_transients') );

		}
		/*
		 *
		 * WordPress Multisite
		 *
		 */
		/*
		 * Прежде всего функция, которая дает нам наш лицензионный ключ
		 */
		function get_license(){
			// если мультисайт, то вытаскиваем основную настройку, если нет, то локальную
			// какой смысл локально прописывать ключ, если локальные пользователя не могут обновлять плагины всё равно
			// BackWard Compatibility: пытаемся вернуть локальную настройку если мультисайтовая не указана
			if( is_multisite() ) {
				return ( ( $x = get_site_option('_misha_' . $this->plugin_slug . '_license_key') ) ? $x : '' );
			} else {
				return ( ( $x = get_option('_misha_' . $this->plugin_slug . '_license_key') ) ? $x : '' );
			}
		}

		/* мультисайтовский кэш get */
		function get_transient( $transient ) {
			return is_multisite() ? get_site_transient( $transient ) : get_transient( $transient );
		}

		/* мультисайтовский кэш set */
		function set_transient( $transient, $value, $expiration = 0 ) {
			return is_multisite() ? set_site_transient( $transient, $value, $expiration ) : set_transient( $transient, $value, $expiration );
		}

		/* мультисайтовский кэш delete */
		function delete_transient( $transient ) {
			return is_multisite() ? delete_site_transient( $transient ) : delete_transient( $transient );
		}

		/* ссылка на страницу лицензии */
		function get_license_config_link() {
			$admin_url = ( isset( $this->license_link['network'] ) && $this->license_link['network'] ) ? network_admin_url('settings.php') : ( (is_multisite() && function_exists('get_network') )? get_admin_url( get_network()->site_id, 'options-general.php' ) : admin_url( 'options-general.php' ) );
			return add_query_arg( array(
			 'page' => $this->license_link['page']
		 	), $admin_url );
		}

		/* функция проверки лицензии */
		function get_license_status(){

			// если мы можем подключить запрос, только тогда можно получить и статус, всего их три
			if( $remote = $this->request() ){
				$body = json_decode( $remote['body'] );

				// active
				if( !empty( $body->download_url ) ) {
					return 'ok';
				}

				// not_exists
				if( isset( $body->not_exist ) && $body->not_exist == 'yes' ) {
					return 'not_exist';
				}

				// во всех остальных случаях – expired
				return 'expired';

			}
			return false;
	 	}

		/* функция вывода уведомлений о том, чтолицуху надо обновить, на страницах настроек плагинов*/
		function notice(){

			$screen = get_current_screen();
			$license = $this->get_license();
			$license_status = $this->get_license_status();

			// сначала проверяем страницу, если находимся на левых, то ничего не выводим
			if(
				isset( $screen->id )
				&& (
					$screen->id == 'settings_page_' . $this->license_link['page']
					|| isset( $this->license_link['network'] ) && $this->license_link['network'] == true && $screen->id == 'settings_page_' . $this->license_link['page'] . '-network'
				)
			) {

				// потом в зависимости от того установлена или истекла лицензия, выводим два разных message
				if( !$license ) {

					?><div class="notice notice-error"><p><?php _e( 'Please set your license key below, so you can receive the latest updates and your website will remain fast and secure. It is your billing email or PayPal email if you paid by PayPal.', $this->text_domain ) ?></p></div><?php

				} elseif( $license_status == 'not_exist' ) {

					?><div class="notice notice-error"><p><?php _e( 'Sorry, but it seems like your license key is incorrect. It should be your billing email or PayPal email if you paid by PayPal.', $this->text_domain ) ?></p></div><?php

				} elseif( $license_status == 'expired' ) {

					// так как мы хотим вставить лицензию в notice
					$license = substr_replace( $license, '*****', - ( strlen($license) - 3 ) );

					$renewal_url = add_query_arg( array(
						'plugin_id' => $this->plugin_id,
						'email' => $this->get_license(),
					), untrailingslashit( $this->update_host ) . '/checkout' );

					?><div class="notice notice-error"><p><?php
						echo sprintf(
							__('Please renew your %1$s license, so you can receive the latest plugin updates and your website will remain fast and secure. If you\'ve already renewed it, but still see this message, please <a href="%2$s">click here</a> to refresh.'),
							'<strong>'.$license.'</strong>',
							wp_nonce_url( add_query_arg( array( 'action' => 'flush_transients_' . $this->plugin_slug ), admin_url('admin-post.php') ), 'flush_transients' )
						);

					?><br /><a href="<?php echo $renewal_url ?>" class="button" style="margin-top:10px"><?php _e('Renew', $this->text_domain ) ?></a></p></div><?php

				}


				// небольшой сообщение для обновлений кэша
				if( isset( $_GET['saved'] ) && $_GET['saved'] == 'flush_transients' ) {
					?><div class="notice notice-success"><p><?php _e( 'Cache has been refreshed.', $this->text_domain ) ?></p></div><?php
				}

			}

		}
		/*
		 * Make request to json on the server, cache it or not
		 */
		function request(){

			if ( $this->enable_caches === false || ( false == $remote = $this->get_transient( 'misha_upgrade_' . $this->update_slug ) ) ) {
				$remote = wp_remote_get( add_query_arg( array(
					'plg' => $this->plugin_id,
					'e' => urlencode( $this->get_license() )
				), $this->update_host . '/infojson.php' ), array( 'timeout' => 10, 'headers' => array( 'Accept' => 'application/json' ) ) );

				if ( !is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && !empty($remote['body']) ) {
						$this->set_transient( 'misha_upgrade_' . $this->update_slug, $remote, 43200 ); // half a day cache
				} else {
					return false;
				}
			}
			return $remote;

		}

		/*
		 * Удаление кэша и редирект на настройки плагина
		 */
		function flush_transients(){

			check_admin_referer( 'flush_transients' );
			$this->delete_transient( 'misha_upgrade_' . $this->update_slug );

			wp_safe_redirect( add_query_arg( array(
				'page' => $this->license_link['page'],
				'saved' => 'flush_transients'
			), ( ( isset( $this->license_link['network'] ) && $this->license_link['network'] == true ) ? network_admin_url('settings.php') : admin_url('options-general.php') ) ) );

			exit;

		}
		/*
		 * Delete cache just after plugin has been updated
		 */
		function after_update( $upgrader_object, $options ) {
			if ( $options['action'] == 'update' && $options['type'] === 'plugin' )  {
				$this->delete_transient( 'misha_upgrade_' . $this->update_slug );
			}
		}

		/*
		 * Returns the object of plugin information
		 * $res empty at this step
		 * $action 'plugin_information'
		 * $args stdClass Object ( [slug] => woocommerce [is_ssl] => [fields] => Array ( [banners] => 1 [reviews] => 1 [downloaded] => [active_installs] => 1 ) [per_page] => 24 [locale] => en_US )
		 */
		function info( $res, $action, $args ){


			if( $action !== 'plugin_information' )
				return false;

			if( $this->plugin_slug !== $args->slug )
				return $res;



			if( $remote = $this->request() ){
				$remote = json_decode( $remote['body'] );
				$res = new stdClass();
				$res->name = $remote->name;
				$res->slug = $this->plugin_slug;
				$res->version = $remote->version;
				$res->tested = $remote->tested;
				$res->requires = $remote->requires;
				$res->author = '<a href="https://rudrastyh.com">Misha Rudrastyh</a>';
				$res->author_profile = 'https://profiles.wordpress.org/rudrastyh';
				$res->download_link = $remote->download_url;
				$res->trunk = $remote->download_url;
				$res->last_updated = $remote->last_updated;
				$res->sections = array(
					//'description' => $remote->sections->description,
					//'installation' => $remote->sections->installation,
					'changelog' => $remote->sections->changelog
				);
				if( !empty( $remote->sections->screenshots ) ) {
					$res->sections['screenshots'] = $remote->sections->screenshots;
				}

				$res->banners = array(
					'low' => $this->update_host . '/plg_api_upd/' . $this->update_slug . '/banner-772x250.jpg',
	            	'high' => $this->update_host . '/plg_api_upd/' . $this->update_slug . '/banner-1544x500.jpg'
				);
				return $res;
			}

			return false;

		}

			function update( $transient ){
			if ( empty($transient->checked ) ) {
	            return $transient;
	        }
	        //echo '<pre>' . print_r( $transient, true ) . '</pre>';exit;


			if ( $remote = $this->request() ){
				$remote = json_decode( $remote['body'] );
				if( $remote && version_compare( $this->version, $remote->version, '<' )
				&& version_compare($remote->requires, get_bloginfo('version'), '<' ) ) {
					$res = new stdClass();
					$res->slug = $this->plugin_slug;
					$res->plugin = $this->plugin_slug . '/' . $this->plugin_slug . '.php';
					$res->new_version = $remote->version;
					$res->tested = $remote->tested;
					$res->package = $remote->download_url; // return '' to disable updates
					$res->url = $remote->homepage;
					$res->compatibility = new stdClass();
	           		$transient->response[$res->plugin] = $res;
	           		//$transient->checked[$res->plugin] = $remote->version;
	           	}

			}
	        //echo '<pre>' . print_r( $transient, true ) . '</pre>';
	        //exit;
	        return $transient;
				}


			// function debug_api( $r ){
			// 	echo '<pre>';print_r( $r );echo '</pre>';
			// 	exit;
			// }

			function update_message( $plugin_info_array, $plugin_info_object ) {
				if( empty( $plugin_info_array['package'] ) ) {

					$renewal_url = add_query_arg( array(
						'plugin_id' => $this->plugin_id,
						'email' => $this->get_license(),
					), untrailingslashit( $this->update_host ) . '/checkout' );

					printf( __( ' Please&nbsp;<a href="%1$s" target="_blank">renew&nbsp;your&nbsp;license</a>&nbsp;to&nbsp;update. And make sure that you set your license key in <a href="%2$s">plugin settings</a>.', $this->text_domain ), $renewal_url, $this->get_license_config_link() );
				}
			}

			/*
			 * Очистка кэша после изменения admin_email в админке
			 */
			function clear_update_cache( $old_value, $value ){
				$this->delete_transient( 'misha_upgrade_' . $this->update_slug );
			}

			/*
			 * Функция check for update для очистки кэша
			 */
			function check_for_updates_link( $plugin_meta, $plugin_file, $plugin_data = null, $status = null ){

					// faq | support | check for updates links
					if ( $plugin_file == ( $this->plugin_slug . '/' . $this->plugin_slug . '.php' ) && current_user_can('update_plugins') ) {



						$plugin_meta[] = sprintf('<a href="https://rudrastyh.com/faq" target="_blank">%s</a>', __('FAQ', $this->text_domain ) );
						$plugin_meta[] = sprintf('<a href="https://rudrastyh.com/support" target="_blank">%s</a>', __('Support', $this->text_domain ) );

						/*
						 * если мы используем апдейтер для мультисайта, то нужно выводить ссылку проверки обновлений только:
						 * 1) Network Dashboard
						 * 2) main site
						 */
						if( is_multisite() ) {
							$screen = get_current_screen();
							if( $screen->id !== 'plugins-network' && !is_main_site( get_current_blog_id() ) ) {
								return $plugin_meta;
							}
						}


						$plugin_meta[] = sprintf('<a href="%s">%s</a>', esc_attr( wp_nonce_url( add_query_arg(
							'misha_refresh_update_cache',
							$this->plugin_slug,
							( is_multisite() ? network_admin_url('plugins.php') : admin_url('plugins.php') ) ), 'upgrade_link_nonce' ) ), __('Check for updates', $this->text_domain ) );
							/* проверка на мультисайт всё равно нужна т.к. мы можем кликать на ссылку с главного блога */

					}

					return $plugin_meta;

			}
			function manual_check(){
				if( isset($_GET['misha_refresh_update_cache']) && $_GET['misha_refresh_update_cache'] == $this->plugin_slug && current_user_can('update_plugins') && check_admin_referer('upgrade_link_nonce') ) {
					$this->delete_transient( 'misha_upgrade_' . $this->update_slug );
				}

			}

	}
}
