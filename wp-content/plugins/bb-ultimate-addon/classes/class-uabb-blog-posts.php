<?php
/**
 * UABB Blog Posts File
 *
 * @since 1.4.7
 * @package UABB Blog Posts
 */

if ( ! class_exists( 'UABB_Blog_Posts' ) ) {
	/**
	 * This class initializes UABB Blog Posts
	 *
	 * @class UABB_Blog_Posts
	 */
	final class UABB_Blog_Posts {

		/**
		 * Initializes blog posts.
		 *
		 * @since 1.4.7
		 * @return void
		 */
		static public function init() {
			// If themer active.
			if ( defined( 'FL_THEME_BUILDER_DIR' ) ) {
				add_filter( 'fl_builder_register_settings_form', __CLASS__ . '::blog_posts_settings', 10, 2 );
				add_filter( 'fl_builder_render_css', __CLASS__ . '::blog_posts_css', 10, 2 );
			}
		}

		/**
		 * Adds the custom code settings for blog posts module
		 * module layouts.
		 *
		 * @since 1.0
		 * @param array  $form Gets the forms array values.
		 * @param string $slug Gets the slug.
		 * @return array
		 */
		static public function blog_posts_settings( $form, $slug ) {
			if ( 'blog-posts' != $slug ) {
				return $form;
			}
			$form['general']['sections']['general']['fields']['post_layout'] = array(
				'type'    => 'select',
				'label'   => __( 'Post Layout', 'uabb' ),
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'uabb' ),
					'custom'  => __( 'Custom', 'uabb' ),
				),
				'toggle'  => array(
					'default' => array(
						'tabs'     => array( 'uabb_controls', 'layout' ),
						'sections' => array( 'btn_typography' ),
						'fields'   => array( 'show_date_box', 'date_tag_selection', 'title_tag_selection', 'meta_tag_selection', 'link_more_arrow_color' ),
					),
					'custom'  => array(
						'fields' => array( 'uabb_custom_post_layout' ),
					),
				),
			);

			$form['general']['sections']['general']['fields']['uabb_custom_post_layout'] = array(
				'type'         => 'form',
				'label'        => __( 'Custom Post Layout', 'uabb' ),
				'form'         => 'uabb_custom_post_layout',
				'preview_text' => null,
				'multiple'     => false,
			);

			FLBuilder::register_settings_form(
				'uabb_custom_post_layout', array(
					'title' => __( 'Custom Post Layout', 'uabb' ),
					'tabs'  => array(
						'html' => array(
							'title'    => __( 'HTML', 'uabb' ),
							'sections' => array(
								'html' => array(
									'title'  => '',
									'fields' => array(
										'html' => array(
											'type'        => 'code',
											'editor'      => 'html',
											'label'       => '',
											'rows'        => '18',
											'default'     => file_get_contents( BB_ULTIMATE_ADDON_DIR . 'includes/blog-posts-default-html.php' ),
											'preview'     => array(
												'type' => 'none',
											),
											'connections' => array( 'html', 'string' ),
										),
									),
								),
							),
						),
						'css'  => array(
							'title'    => __( 'CSS', 'uabb' ),
							'sections' => array(
								'css' => array(
									'title'  => '',
									'fields' => array(
										'css' => array(
											'type'    => 'code',
											'editor'  => 'css',
											'label'   => '',
											'rows'    => '18',
											'default' => '',
											'preview' => array(
												'type' => 'none',
											),
										),
									),
								),
							),
						),
					),
				)
			);

			return $form;
		}

		/**
		 * Renders custom CSS for the advanced posts module.
		 *
		 * @since 1.6.0
		 * @param string $css gets the CSS for the Blog Posts.
		 * @param array  $nodes gets the nodes array values.
		 * @return string
		 */
		static public function blog_posts_css( $css, $nodes ) {
			if ( ! class_exists( 'lessc' ) && file_exists( FL_THEME_BUILDER_DIR . 'classes/class-lessc.php' ) ) {
				require_once FL_THEME_BUILDER_DIR . 'classes/class-lessc.php';
			}

			if ( class_exists( 'lessc' ) ) {

				foreach ( $nodes['modules'] as $module ) {

					if ( ! is_object( $module ) ) {
						continue;
					} elseif ( 'blog-posts' != $module->settings->type ) {
						continue;
					} elseif ( 'custom' != $module->settings->post_layout ) {
						continue;
					}

					try {
						$less    = new lessc;
						$custom  = '.fl-node-' . $module->node . ' { ';
						$custom .= $module->settings->uabb_custom_post_layout->css;
						$custom .= ' }';
						$css    .= $less->compile( $custom );
					} catch ( Exception $e ) {
						$css .= $module->settings->uabb_custom_post_layout->css;
					}
				}
				return $css;
			}
		}
	}
	UABB_Blog_Posts::init();
}
