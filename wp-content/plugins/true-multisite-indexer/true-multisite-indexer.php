<?php
/*
Plugin Name: True Multisite Indexer
Plugin URI: https://rudrastyh.com/plugins/get-posts-from-all-blogs-in-multisite-network
Description: Indexes all posts across your network and brings them into one spot – a very powerful tool that you use as a base to display posts in different ways or to manage your network.
Author: Misha Rudrastyh
Version: 5.4.1
Author URI: https://rudrastyh.com
Network: true
*/

// +----------------------------------------------------------------------+
// | Copyright Misha Rudrastyh (https://rudrastyh.com/)                                |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+


// locale
define( 'TRUE_MULTISITE_INDEXER_TEXT_DOMAIN', 'network_indexer' );

// plugin core
require_once dirname(__FILE__) . '/inc/functions.php';
require_once dirname(__FILE__) . '/classes/model.php';
require_once dirname(__FILE__) . '/classes/query.php';
require_once dirname(__FILE__) . '/classes/rebuild.php';
require_once dirname(__FILE__) . '/classes/admin.php';
require_once dirname(__FILE__) . '/classes/upgrade.php';

// plugin extras
require_once dirname(__FILE__) . '/ext/polylang.php';
require_once dirname(__FILE__) . '/ext/posts.php';
require_once dirname(__FILE__) . '/ext/widgets/recent-posts.php';
require_once dirname(__FILE__) . '/ext/globalsearch.php';
if( get_site_option( 'postindexer_gsearch' ) == 'widget' ) include_once dirname(__FILE__) . '/ext/widgets/search.php';

// vc composer el
add_action( 'vc_before_init', 'misha_vc_element' );
function misha_vc_element() {
	include_once dirname(__FILE__) . '/ext/vc_element.php';
}

// activate updater
new mishaUpgrade2( 'mul470e2_9t8t', 'true-multisite-indexer', 1272, '5.4.1', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN, array( 'page' => 'multisite_indexer', 'network' => true ) );

/*
 * При обновлении плагина:
 *
add_action( 'upgrader_process_complete', 'rudr_tmi_plugin_updated',10, 2);

function rudr_tmi_plugin_updated( $upgrader_object, $options ) {
	print_r($upgrader_object);

	if( $options['action'] == 'update' && $options['type'] == 'plugin' && is_array($options['plugins']) && in_array('true-multisite-indexer/true-multisite-indexer.php', $options['plugins'])) {
		global $wpdb;
		$result = $wpdb->get_results("SHOW COLUMNS FROM {$wpdb->base_prefix}network_terms LIKE 'term_language'");
		if( empty( $result ) ) {
			$wpdb->query("ALTER TABLE {$wpdb->base_prefix}network_terms ADD term_language tinytext after blog_id" );
		}
	}
}
/*
 * При активации плагина:
 * 1.проверка совместимости
 * 2.установка таблиц в БД
 * 3. при апгрейде добавляем в таблицу колонку
 */
register_activation_hook( __FILE__, 'rudr_tmi_plugin_activate' );

function rudr_tmi_plugin_activate() {
	/* подключаем необходимый файл только при надобности */
	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	}
	/* делаем проверку, что не стоит другой индексирующий плагин, если стоит - сообщение об этом */
	if ( is_plugin_active_for_network( 'post-indexer/post-indexer.php' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( 'This plugin has a conflict with your currently installed <b>Post Indexer</b> plugin. Please deactivate it and try again. Sorry about that.' );
	}
	/*
	 * sozdaem tablici v mysql
	 */
	global $wpdb;
	if ( ! empty($wpdb->charset) ) {
		$charset_collate = "DEFAULT CHARACTER SET " . $wpdb->charset;
	}
	if ( ! empty($wpdb->collate) ) {
		$charset_collate .= " COLLATE " . $wpdb->collate;
	}


	/* network_log */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_log` (
		 `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
		 `log_title` varchar(250) DEFAULT NULL,
		 `log_details` text,
		 `log_datetime` datetime DEFAULT NULL,
		 PRIMARY KEY (`id`)
	) $charset_collate;";
	$wpdb->query( $sql );

	/* network_posts */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_posts` (
		 `BLOG_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
		 `ID` bigint(20) unsigned NOT NULL,
		 `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
		 `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		 `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		 `post_content` longtext NOT NULL,
		 `post_title` text NOT NULL,
		 `post_excerpt` text NOT NULL,
		 `post_status` varchar(20) NOT NULL DEFAULT 'publish',
		 `comment_status` varchar(20) NOT NULL DEFAULT 'open',
		 `ping_status` varchar(20) NOT NULL DEFAULT 'open',
		 `post_password` varchar(20) NOT NULL DEFAULT '',
		 `post_name` varchar(200) NOT NULL DEFAULT '',
		 `to_ping` text NOT NULL,
		 `pinged` text NOT NULL,
		 `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		 `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		 `post_content_filtered` longtext NOT NULL,
		 `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
		 `guid` varchar(255) NOT NULL DEFAULT '',
		 `menu_order` int(11) NOT NULL DEFAULT '0',
		 `post_type` varchar(20) NOT NULL DEFAULT 'post',
		 `post_mime_type` varchar(100) NOT NULL DEFAULT '',
		 `comment_count` bigint(20) NOT NULL DEFAULT '0',
		 PRIMARY KEY (`BLOG_ID`,`ID`),
		 KEY `post_name` (`post_name`),
		 KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
		 KEY `post_parent` (`post_parent`),
		  KEY `post_author` (`post_author`)
	) $charset_collate;";
	$wpdb->query( $sql );

	/* network_rebuildqueue */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_rebuildqueue` (
	  `blog_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `rebuild_updatedate` timestamp NULL DEFAULT NULL,
	  `rebuild_progress` bigint(20) unsigned DEFAULT NULL,
	  PRIMARY KEY (`blog_id`)
	) $charset_collate;";
	$wpdb->query( $sql );

	/* network_postmeta */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_postmeta` (
	  `blog_id` bigint(20) unsigned NOT NULL,
	  `meta_id` bigint(20) unsigned NOT NULL,
	  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
	  `meta_key` varchar(255) DEFAULT NULL,
	  `meta_value` longtext,
	  PRIMARY KEY (`blog_id`,`meta_id`),
	  KEY `post_id` (`post_id`),
	  KEY `meta_key` (`meta_key`)
	) $charset_collate;";
	$wpdb->query( $sql );

	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_terms` (
	  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `name` varchar(200) NOT NULL DEFAULT '',
	  `slug` varchar(200) NOT NULL DEFAULT '',
	  `term_group` bigint(10) NOT NULL DEFAULT '0',
	  `term_local_id` bigint(10) NOT NULL DEFAULT '0',
	  `blog_id` bigint(10) NOT NULL DEFAULT '0',
		`term_language` tinytext,
	  PRIMARY KEY (`term_id`),
	  KEY `name` (`name`)
	) $charset_collate;";
	$wpdb->query( $sql );
	/* network_term_taxonomy */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_term_taxonomy` (
	  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
	  `taxonomy` varchar(32) NOT NULL DEFAULT '',
	  `description` longtext NOT NULL,
	  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
	  `count` bigint(20) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`term_taxonomy_id`),
	  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
	  KEY `taxonomy` (`taxonomy`)
	) $charset_collate;";
	$wpdb->query( $sql );

	/* network_term_relationships */
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->base_prefix . "network_term_relationships` (
	  `blog_id` bigint(20) unsigned NOT NULL,
	  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
	  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
	  `term_order` int(11) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`blog_id`,`object_id`,`term_taxonomy_id`),
	  KEY `term_taxonomy_id` (`term_taxonomy_id`)
	) $charset_collate;";
	$wpdb->query( $sql );


	$result = $wpdb->get_results("SHOW COLUMNS FROM {$wpdb->base_prefix}network_terms LIKE 'term_language'");
	if( empty( $result ) ) {
		$wpdb->query("ALTER TABLE {$wpdb->base_prefix}network_terms ADD term_language tinytext after blog_id" );
	}

}
