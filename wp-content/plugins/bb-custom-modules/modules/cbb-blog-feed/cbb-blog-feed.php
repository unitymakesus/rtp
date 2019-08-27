<?php

class CbbBlogFeedModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Blog Feed', 'fl-builder' ),
			'description'     => __( 'A module that pulls in recent posts from the blog.', 'fl-builder' ),
			'icon'            => 'blog.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-blog-feed/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-blog-feed/'
		));

		// Include custom CSS
		$this->add_css('cbb-blog-feed', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'assets/icons/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'assets/icons/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	public function siteBadge($postID) {
    $siteID = get_post_meta($postID, 'dt_original_blog_id', true);

		if (empty($siteID)) {
			$current = get_current_site();
			$siteID = $current->id;
		}

    if ($siteID == 1) {
      $siteName = 'RTP';
    } else {
      $siteData = get_blog_details($siteID, true);
      $siteName = $siteData->blogname;
    }
    return $siteName;
  }

	public function featuredImage($post_id) {
		if (has_post_thumbnail($post_id)) {
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			echo get_the_post_thumbnail( $post_id, 'medium-square-thumbnail', ['alt' => $alt, 'itemprop' => 'image'] );
		} else {
			echo '<div class="placeholder"></div>';
		}
	}

}

/*
	Register the module
 */
FLBuilder::register_module( 'CbbBlogFeedModule', [
	'cbb-blog-feed-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-blog-feed' => [
				'title' => __( 'Content', 'cbb' ),
				'fields' => [
					'posts_per_page' => [
						'type'        => 'text',
						'label'       => __( 'Post Count', 'uabb' ),
						'help'        => __( 'Enter the total number of posts you want to display in module.', 'cbb' ),
						'default'     => '3',
						'size'        => '8',
						'placeholder' => '3',
					],
					'tax_post_category_matching' => [
						'type'    => 'select',
						'label'   => 'Blog Category',
						'help'    => __( 'Enter a comma separated list of categories. Only posts with these categories will be shown.', 'cbb' ),
						'options' => [
							'1' => __( 'Match these categories', 'cbb' ),
							'0' => __( 'Do not match these categories', 'cbb' )
						]
					],
					'tax_post_category' => [
						'type'   => 'suggest',
						'action' => 'fl_as_terms',
						'data'   => 'category',
						'label'  => '&nbsp',
					]
				]
			]
		]
	]
] );
?>
