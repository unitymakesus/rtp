<?php

class CbbBlogFeedModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'Blog Feed', 'fl-builder' ),
			'description'     => __( 'A module that pulls in recent posts from the blog.', 'fl-builder' ),
			'icon'            => 'format-aside.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-blog-feed/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-blog-feed/'
		));

		// Include custom CSS
		$this->add_css('cbb-blog-feed', CBB_MODULES_URL . 'dist/styles/cbb-blog-feed.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'modules/cbb-blog-feed/images/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'modules/cbb-blog-feed/images/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	public function siteBadge() {
    $postID = get_the_ID();
    $siteID = get_post_meta($postID, 'dt_original_blog_id', true);
    if ($siteID == 1) {
      $siteName = 'RTP';
    } else {
      $siteData = get_blog_details($siteID, true);
      $siteName = $siteData->blogname;
    }
    return $siteName;
  }

}

?>
