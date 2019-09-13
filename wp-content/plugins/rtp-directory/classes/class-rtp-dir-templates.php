<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RTP_Dir_Templates Class
 *
 * @class RTP_Dir_Templates
 * @version	1.0.0
 * @since 1.0.0
 * @package	RTP_Dir
 * @author Unity
 */
class RTP_Dir_Templates {
	/**
	 * RTP_Dir_Admin The single instance of RTP_Dir_Templates.
	 * @var 	  object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The array of templates that this plugin tracks.
   * @var     array
   * @access  protected
   * @since   1.0.0
	 */
	protected $templates;

	/**
	 * Main RTP_Dir_Templates Instance
	 *
	 * Ensures only one instance of RTP_Dir_Templates is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Main RTP_Dir_Templates instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

 	/**
 	 * Constructor function to set filters and admin functions
 	 * @access  public
 	 * @since   1.0.0
 	 */
 	public function __construct () {

		$this->templates = array();

		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// Add your templates to this array.
		$this->templates = array(
			'templates/page-directory.php' => 'RTP Directory',
		);

		// Add template for single company
		add_filter('single_template', array($this, 'single_location_templates'));

	}

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		$file = plugin_dir_path( dirname(__FILE__ ) ). get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

	/**
	 * Also add single-company template
	 */
	public function single_location_templates($template) {
		global $post;
		// Check active theme for template override
		$single_company_override = locate_template(['single-rtp-company.php', 'views/single-rtp-company.blade.php']);
		$single_facility_override = locate_template(['single-rtp-facility.php', 'views/single-rtp-facility.blade.php']);
		$single_site_override = locate_template(['single-rtp-site.php', 'views/single-rtp-site.blade.php']);
		$single_space_override = locate_template(['single-rtp-space.php', 'views/single-rtp-site.blade.php']);

		// Use default template set in this plugin if no overrides are set in theme
		if($post->post_type == 'rtp-company' && $single_company_override == '') {
			$template = plugin_dir_path( __FILE__ ).'../templates/single-rtp-company.php';
		} elseif ($post->post_type == 'rtp-facility' && $single_facility_override == '') {
			$template = plugin_dir_path( __FILE__ ).'../templates/single-rtp-facility.php';
		} elseif ($post->post_type == 'rtp-site' && $single_site_override == '') {
			$template = plugin_dir_path( __FILE__ ).'../templates/single-rtp-site.php';
		} elseif ($post->post_type == 'rtp-space' && $single_space_override == '') {
			$template = plugin_dir_path( __FILE__ ).'../templates/single-rtp-space.php';
		}

		return $template;
	}

}
