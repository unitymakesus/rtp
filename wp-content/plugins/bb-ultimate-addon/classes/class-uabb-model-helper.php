<?php
/**
 *  UABB Model Helper
 *
 *  Helper functions, actions & filter hooks etc.
 *
 *  @package UABB Model Helper
 */

if ( ! class_exists( 'UABB_Model_Helper' && FLBuilderModel::is_builder_active() ) ) {

	/**
	 * This class initializes UABB Model Helper class
	 *
	 * @class UABB_Model_Helper
	 */
	class UABB_Model_Helper {
		/**
		 * Variable for BB global Settings
		 *
		 * @var string $bb_global_settings
		 */
		public static $bb_global_settings;

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		public function __construct() {

			// Initialize BB Global Setting static variable.
			self::$bb_global_settings = FLBuilderModel::get_global_settings();
		}

		/**
		 * Get Templates based on category
		 *
		 * @param string $type gets the type of the layout.
		 */
		public static function get_post_template( $type = 'layout' ) {
			$posts = get_posts(
				array(
					'post_type'      => 'fl-builder-template',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => '-1',
					'tax_query'      => array(
						array(
							'taxonomy' => 'fl-builder-template-type',
							'field'    => 'slug',
							'terms'    => $type,
						),
					),
				)
			);

			$templates = array();

			foreach ( $posts as $post ) {

				$templates[] = array(
					'id'     => $post->ID,
					'name'   => $post->post_title,
					'global' => get_post_meta( $post->ID, '_fl_builder_template_global', true ),
				);
			}

			return $templates;
		}


		/**
		 *  Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since   1.1.0.1
		 */
		public static function get_saved_page_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
				$page_templates = self::get_post_template( 'layout' );
				$options        = array();

				if ( count( $page_templates ) ) {
					foreach ( $page_templates as $page_template ) {
						$options[ $page_template['id'] ] = $page_template['name'];
					}
				} else {
					$options['no_template'] = 'It seems that, you have not saved any template yet.';
				}
				return $options;
			}
		}

		/**
		 *  Get - Saved row templates
		 *
		 * @return  $option_array
		 * @since   1.1.0.1
		 */
		public static function get_saved_row_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {

				$saved_rows = self::get_post_template( 'row' );
				$options    = array();
				if ( count( $saved_rows ) ) {
					foreach ( $saved_rows as $saved_row ) {
						$options[ $saved_row['id'] ] = $saved_row['name'];
					}
				} else {
					$options['no_template'] = 'It seems that, you have not saved any template yet.';
				}
				return $options;
			}
		}

		/**
		 *  Get - Saved module templates
		 *
		 * @return  $option_array
		 * @since   1.1.0.1
		 */
		public static function get_saved_module_template() {
			if ( FLBuilderModel::node_templates_enabled() ) {
				$saved_modules = self::get_post_template( 'module' );
				$options       = array();
				if ( count( $saved_modules ) ) {
					foreach ( $saved_modules as $saved_module ) {
						$options[ $saved_module['id'] ] = $saved_module['name'];
					}
				} else {
					$options['no_template'] = 'It seems that, you have not saved any template yet.';
				}
				return $options;
			}
		}
	}
	new UABB_Model_Helper();
}
