<?php
/**
 *  UABB Creative Link Module front-end file
 *
 *  @package UABB Creative Link Module
 */

global $wp;

$current_url = home_url( add_query_arg( array(), $wp->request ) );
?>
<div class="uabb-module-content uabb-cl-wrap">
	<ul class="uabb-cl-ul">
	<?php
	if ( count( $settings->screens ) > 0 ) {
		foreach ( $settings->screens as $screen ) {
			$screen_link = isset( $screen->link ) ? $screen->link : '';
			$url         = rtrim( $screen_link, '/' );
			if ( $url == $current_url ) {
				$current_class = 'uabb-current-creative-link';
			} else {
				$current_class = '';
			}

			$target   = '';
			$nofollow = '';
			if ( UABB_Compatibility::check_bb_version() ) {

				if ( isset( $screen->link ) ) {
					if ( isset( $screen->link_target ) ) {
						$target = $screen->link_target;
					}
					if ( isset( $screen->link_nofollow ) ) {
						$nofollow = $screen->link_nofollow;
					}
				}
			} else {
				if ( isset( $screen->link ) ) {
					if ( isset( $screen->target ) ) {
						$target = $screen->target;
					}
					if ( isset( $screen->nofollow ) ) {
						$nofollow = $screen->nofollow;
					}
				}
			}

			?>
		<li class="uabb-creative-link uabb-cl-<?php echo $settings->link_style; ?> <?php echo $current_class; ?>">
			<<?php echo $settings->link_typography_tag_selection; ?> class="uabb-cl-heading">
				<a href="<?php echo $screen_link; ?>" target="<?php echo $target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $target, $nofollow, 1 ); ?> data-hover="<?php echo $screen->title; ?>"><?php $module->render_text( $screen->title ); ?></a>
			</<?php echo $settings->link_typography_tag_selection; ?>>
		</li>
			<?php
		}
	}
	?>
	</ul>
</div>
