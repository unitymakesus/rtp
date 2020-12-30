<?php
/**
 *  UABB Social Share Module front-end file
 *
 *  @package UABB Social Share Module
 */

global $post;

$class              = '';
$class_medium       = '';
$class_responsive   = '';
$social_share_align = '';
if ( 'floating' !== $settings->display_position ) {
	$class            = 'uabb-ss-column-' . $settings->column;
	$class_medium     = 'uabb-ss-column-medium-' . $settings->column_medium;
	$class_responsive = 'uabb-ss-column-responsive-' . $settings->column_responsive;

	$social_share_align = 'uabb-ss-align-' . $settings->share_alignment;
	if ( $settings->share_alignment_medium ) {
		$social_share_align .= ' uabb-ss-medium-align-' . $settings->share_alignment_medium;
	}
	if ( $settings->share_alignment_responsive ) {
		$social_share_align .= ' uabb-ss-responsive-align-' . $settings->share_alignment_responsive;
	}
}
if ( 'floating' === $settings->display_position && 'default' !== $settings->skins && FLBuilderModel::is_builder_active() ) { ?>
	<div class="uabb-builder-msg" style="text-align: center;">
		<h5><?php esc_html_e( 'UABB Share Button - ', 'uabb' ); ?><?php echo esc_html( $id ); ?></h5>
		<p><?php esc_html_e( 'Click here to edit the "Floating Share Button" settings. This text will not be visible on frontend.', 'uabb' ); ?></p>
	</div>
	<?php
}
?>
<div class="uabb-social-share-wrap uabb-social-share-<?php echo esc_attr( $settings->icon_struc_align ); ?> uabb-ss <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $class_medium ); ?> <?php echo esc_attr( $class_responsive ); ?>">
<?php
if ( 'default' !== $settings->skins ) {
	?>
		<div class="uabb-ss-wrap <?php echo esc_attr( $social_share_align ); ?> uabb-ss-<?php echo esc_attr( $settings->skins ); ?> uabb-ss-view-<?php echo esc_attr( $settings->share_view ); ?> uabb-ss-shape-<?php echo esc_attr( $settings->share_shape ); ?> uabb-ss-color-<?php echo esc_attr( $settings->color_style ); ?> uabb-style-<?php echo esc_attr( $settings->display_position ); ?> uabb-floating-align-<?php echo esc_attr( $settings->floating_alignment ); ?>">
	<?php
}
$icon_count = 1;
if ( count( $settings->social_icons ) > 0 ) {

	foreach ( $settings->social_icons as $icon ) {

		if ( ! is_object( $icon ) ) {
			continue;
		}
		$url         = 'javascript:void(0);';
		$title       = ''; //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
		$social_icon = $icon;


		if ( ( isset( $_SERVER['HTTPS'] ) && ! empty( $_SERVER['HTTPS'] ) && 'off' !== strtolower( $_SERVER['HTTPS'] ) ) || 443 === $_SERVER['SERVER_PORT'] ) {
			$current_page = rawurlencode( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		} else {
			$current_page = rawurlencode( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		}

		switch ( $icon->social_share_type ) {
			case 'facebook':
				$url         = 'https://www.facebook.com/sharer.php?u=' . $current_page;
				$share_title = __( 'Facebook', 'uabb' );
				$share_icon  = 'fab fa-facebook';
				break;

			case 'twitter':
				$url         = 'https://twitter.com/share?url=' . $current_page;
				$share_title = __( 'Twitter', 'uabb' );
				$share_icon  = 'fab fa-twitter';
				break;

			case 'pinterest':
				if ( '' === $icon->fallback_image ) {
					$pin_thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$pin_image_url = $pin_thumb['0'];
				} else {
					$pin_image_url = $icon->fallback_image_src;
				}
				$url         = 'https://www.pinterest.com/pin/create/link/?url=' . $current_page . '&media=' . $pin_image_url;
				$share_title = __( 'Pinterest', 'uabb' );
				$share_icon  = 'fab fa-pinterest';
				break;

			case 'linkedin':
				$url         = 'https://www.linkedin.com/shareArticle?url=' . $current_page;
				$share_title = __( 'Linkedin', 'uabb' );
				$share_icon  = 'fab fa-linkedin';
				break;

			case 'digg':
				$url         = 'http://digg.com/submit?url=' . $current_page;
				$share_title = __( 'Digg', 'uabb' );
				$share_icon  = 'fab fa-digg';
				break;

			case 'blogger':
				$url         = 'https://www.blogger.com/blog_this.pyra?t&amp;u=' . $current_page;
				$share_title = __( 'blogger', 'uabb' );
				$share_icon  = 'fab fa-blogger';
				break;

			case 'reddit':
				$url         = 'https://reddit.com/submit?url=' . $current_page;
				$share_title = __( 'Reddit', 'uabb' );
				$share_icon  = 'fab fa-reddit';
				break;

			case 'stumbleupon':
				$url         = 'https://www.stumbleupon.com/submit?url=' . $current_page;
				$share_title = __( 'Stumbleupon', 'uabb' );
				$share_icon  = 'fab fa-stumbleupon';
				break;

			case 'tumblr':
				$url         = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $current_page;
				$share_title = __( 'Tumblr', 'uabb' );
				$share_icon  = 'fab fa-tumblr';
				break;

			case 'myspace':
				$url         = 'https://myspace.com/post?u=' . $current_page;
				$share_title = __( 'My Space', 'uabb' );
				break;

			case 'email':
				$url         = 'mailto:?body=' . $current_page;
				$share_title = __( 'Email', 'uabb' );
				$share_icon  = 'fas fa-envelope';
				break;

			case 'whatsapp':
				$url         = 'https://api.whatsapp.com/send?text=' . $current_page;
				$share_title = __( 'WhatsApp', 'uabb' );
				$share_icon  = 'fab fa-whatsapp';
				break;

			case 'telegram':
				$url         = 'https://telegram.me/share/url?url=' . $current_page;
				$share_title = __( 'Telegram', 'uabb' );
				$share_icon  = 'fab fa-telegram';
				break;

			case 'vk':
				$pin_thumb   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$pin_url     = $pin_thumb['0'];
				$url         = 'https://vkontakte.ru/share.php?url=' . $current_page . '&title=' . $title . '&image=' . $pin_url;
				$share_title = __( 'VK', 'uabb' );
				$share_icon  = 'fab fa-vk';
				break;

			case 'odnoklassniki':
				$pin_thumb   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$pin_url     = $pin_thumb['0'];
				$url         = 'https://connect.ok.ru/offer?url=' . $current_page . '&title=' . $title . '&imageUrl=' . $pin_url;
				$share_title = __( 'OK', 'uabb' );
				$share_icon  = 'fab fa-odnoklassniki';
				break;

			case 'delicious':
				$share_link  = 'https://del.icio.us/save?url=' . $current_page . '&title=' . $title;
				$share_title = __( 'Delicious', 'uabb' );
				$share_icon  = 'fab fa-delicious';
				break;

			case 'pocket':
				$url         = 'https://getpocket.com/edit?url=' . $current_page;
				$share_title = __( 'Pocket', 'uabb' );
				$share_icon  = 'fab fa-get-pocket';
				break;

			case 'xing':
				$url         = 'https://www.xing.com/app/user?op=share&url=' . $current_page;
				$share_title = __( 'Xing', 'uabb' );
				$share_icon  = 'fab fa-xing';
				break;

			case 'skype':
				$url         = 'https://web.skype.com/share?url=' . $current_page;
				$share_title = __( 'Skype', 'uabb' );
				$share_icon  = 'fab fa-skype';
				break;

			case 'print':
				$url         = 'javascript:print()';
				$share_title = __( 'Print', 'uabb' );
				$share_icon  = 'fa fab fa-print';
				break;

			case 'buffer':
				$url         = 'https://bufferapp.com/add?url=' . $current_page;
				$share_title = __( 'Buffer', 'uabb' );
				$share_icon  = 'fab fa-buffer';
				break;
		}
		if ( 'default' === $settings->skins ) {
			if ( 'email' === $icon->social_share_type ) {
				echo '<div class="uabb-social-share-link-wrap"><a class="uabb-social-share-link uabb-social-share-' . esc_attr( $icon_count ) . '" href="' . esc_url( $url ) . '" target="_self" >';
			} else {
				echo '<div class="uabb-social-share-link-wrap"><a class="uabb-social-share-link uabb-social-share-' . esc_attr( $icon_count ) . '" href="' . esc_url( $url ) . '" target="_blank" onclick="window.open(this.href,\'social-share\',\'left=20,top=20,width=500,height=500,toolbar=1,resizable=0\');return false;">';
			}

			$imageicon_array = array(

				/* General Section */
				'image_type'            => $icon->image_type,

				/* Icon Basics */
				'icon'                  => ( isset( $icon->icon ) && '' !== $icon->icon ) ? $icon->icon : $share_icon,
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
		} else {
			?>
			<div class="uabb-ss-grid-item uabb-ss-animation-<?php echo esc_attr( $settings->hover_animation ); ?> uabb-ss-button-<?php echo esc_attr( $icon->social_share_type ); ?>">
				<div class="uabb-ss-grid-button">
					<a class= "uabb-ss-grid-button-link" href="<?php echo esc_url( $url ); ?>" target="_blank" onclick="window.open(this.href,'social-share','left=20,top=20,width=500,height=500,toolbar=1,resizable=0');return false;">
						<?php if ( 'icon' === $settings->share_view || 'icon-text' === $settings->share_view ) { ?>
						<span class="uabb-ss-icon">
							<?php if ( '' !== $icon->icon ) { ?>
							<i class="<?php echo $icon->icon; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" aria-hidden="true"></i>
						<?php } else { ?>
							<i class="<?php echo $share_icon; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" aria-hidden="true"></i>
						<?php } ?>
						</span>
					<?php } ?>

					<?php if ( 'icon-text' === $settings->share_view || 'text' === $settings->share_view ) { ?>
						<div class="uabb-ss-button-text">
								<div class="uabb-ss-button-title"><?php echo esc_attr( $share_title ); ?></div>
						</div>
					<?php } ?>
					</a>
				</div>
			</div>
			<?php
		}
		$icon_count++;
	}
}
if ( 'default' !== $settings->skins ) {
	?>
	</div>
<?php } ?>
</div>

