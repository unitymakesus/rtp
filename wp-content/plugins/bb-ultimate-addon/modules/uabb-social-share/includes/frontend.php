<?php
/**
 *  UABB Social Share Module front-end file
 *
 *  @package UABB Social Share Module
 */

?>
<div class="uabb-social-share-wrap uabb-social-share-<?php echo $settings->icon_struc_align; ?>">
<?php
$icon_count = 1;
if ( count( $settings->social_icons ) > 0 ) {

	foreach ( $settings->social_icons as $icon ) {

		if ( ! is_object( $icon ) ) {
			continue;
		}
		$url = 'javascript:void(0);';

		if ( ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && 'off' !== strtolower( $_SERVER['HTTPS'] ) ) || 443 == $_SERVER['SERVER_PORT'] ) {
			$current_page = urlencode( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		} else {
			$current_page = urlencode( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		}

		switch ( $icon->social_share_type ) {
			case 'facebook':
							$url = 'https://www.facebook.com/sharer.php?u=' . $current_page;
				break;

			case 'twitter':
							$url = 'https://twitter.com/share?url=' . $current_page;
				break;

			case 'google':
							$url = 'https://plus.google.com/share?url=' . $current_page;
				break;

			case 'pinterest':
							$url = 'https://pinterest.com/pin/create/link/?url=' . $current_page;
				break;
			case 'linkedin':
							$url = 'https://www.linkedin.com/shareArticle?url=' . $current_page;
				break;

			case 'digg':
							$url = 'http://digg.com/submit?url=' . $current_page;
				break;

			case 'blogger':
							$url = 'https://www.blogger.com/blog_this.pyra?t&amp;u=' . $current_page;
				break;

			case 'reddit':
							$url = 'https://reddit.com/submit?url=' . $current_page;
				break;

			case 'stumbleupon':
							$url = 'https://www.stumbleupon.com/submit?url=' . $current_page;
				break;

			case 'tumblr':
							$url = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $current_page;
				break;

			case 'myspace':
							$url = 'https://myspace.com/post?u=' . $current_page;
				break;

			case 'email':
							$url = 'mailto:?body=' . $current_page;
				break;

		}

		if ( 'email' == $icon->social_share_type ) {
			echo '<div class="uabb-social-share-link-wrap"><a class="uabb-social-share-link uabb-social-share-' . $icon_count . '" href="' . $url . '" target="_self" >';
		} else {
			echo '<div class="uabb-social-share-link-wrap"><a class="uabb-social-share-link uabb-social-share-' . $icon_count . '" href="' . $url . '" target="_blank" onclick="window.open(this.href,\'social-share\',\'left=20,top=20,width=500,height=500,toolbar=1,resizable=0\');return false;">';
		}

		$imageicon_array = array(

			/* General Section */
			'image_type'            => $icon->image_type,

			/* Icon Basics */
			'icon'                  => $icon->icon,
			'icon_align'            => 'center',

			/* Image Basics */
			'photo_source'          => 'library',
			'photo'                 => $icon->photo,
			'photo_url'             => '',
			'img_align'             => 'center',
			'photo_src'             => ( isset( $icon->photo_src ) ) ? $icon->photo_src : '',

			/* Icon Style */
			'icon_style'            => $settings->icoimage_style,
			'icon_bg_size'          => $settings->bg_size,
			'icon_border_style'     => $settings->border_style,
			'icon_border_width'     => $settings->border_width,
			'icon_bg_border_radius' => $settings->bg_border_radius,

			/* Image Style */
			'image_style'           => $settings->icoimage_style,
			'img_bg_size'           => $settings->bg_size,
			'img_border_style'      => $settings->border_style,
			'img_border_width'      => $settings->border_width,
			'img_bg_border_radius'  => $settings->bg_border_radius,

			/* Preset Color variable new */
			'icon_color_preset'     => 'preset1',
			'icon_three_d'          => $settings->three_d,

		);

		FLBuilder::render_module_html( 'image-icon', $imageicon_array );
		echo '</a></div>';
		$icon_count = $icon_count + 1;
	}
}

?>
</div>
