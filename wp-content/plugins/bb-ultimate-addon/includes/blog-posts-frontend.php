<?php
/**
 * Blog Posts frontend content
 *
 * @package Blog Post
 */

?>
<div class="uabb-blog-post-content">
	<?php
	FLPostGridModule::schema_meta();
	echo do_shortcode( FLThemeBuilderFieldConnections::parse_shortcodes( $settings->uabb_custom_post_layout->html ) );
	?>
</div>
