<?php
/**
 *  UABB Hotspot Module front-end file
 *
 *  @package UABB Hotspot Module
 */

$photo_src = ( 'url' != $settings->photo_source ) ? ( ( isset( $settings->photo_src ) && '' != $settings->photo_src ) ? $settings->photo_src : '' ) : ( ( '' != $settings->photo_url ) ? $settings->photo_url : '' );
$alt       = $module->get_image_details();

if ( isset( $photo_src ) ) {
	if ( '' != $photo_src ) {
		?>
	<div class="uabb-module-content uabb-hotspot">
		<div class="uabb-hotspot-container">
			<img class="uabb-hotspot-image" src="<?php echo $photo_src; ?>" alt="<?php echo $alt; ?>">
			<div class="uabb-hotspot-items">
				<?php
				if ( count( $settings->hotspot_marker ) > 0 ) {
					for ( $i = 0; $i < count( $settings->hotspot_marker ); $i++ ) {
						$settings->hotspot_marker[ $i ]->tooltip_bg_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'tooltip_bg_color' );
						?>
				<div class="uabb-hotspot-item-<?php echo $i; ?> uabb-hotspot-item">
						<?php
						$link   = '';
						$target = '';
						if ( 'link' == $settings->hotspot_marker[ $i ]->on_click_action ) {
							$link   = ' href="' . $settings->hotspot_marker[ $i ]->link . '"';
							$target = ' target="' . $settings->hotspot_marker[ $i ]->target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $settings->hotspot_marker[ $i ]->target, 0, 0 );
							$tag    = 'a';
						} else {
							$link   = '';
							$target = '';
							$tag    = 'span';
						}
						?>
					<<?php echo $tag; ?> class="uabb-hotspot-tooltip uabb-tooltip-style-<?php echo $settings->hotspot_marker[ $i ]->tooltip_style; ?> uabb-tooltip-<?php echo $settings->hotspot_marker[ $i ]->tooltip_content_position; ?>" <?php echo $link; ?> <?php echo $target; ?>>
						<?php $module->render_image_icon( $i ); ?>
						<?php
						if ( 'tooltip' == $settings->hotspot_marker[ $i ]->on_click_action ) {
							?>
						<span class="uabb-hotspot-tooltip-content uabb-text-editor">
							<?php echo $settings->hotspot_marker[ $i ]->tooltip_content; ?>
							<?php
							if ( 'curved' == $settings->hotspot_marker[ $i ]->tooltip_style ) {
								?>
							<span class="uabb-hotspot-svg">
								<svg version="1.1" width="1.2em" height="1.2em" viewBox="0 0 80 80">
									<path fill="<?php echo uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ); ?>" d="M80,0c0,0-5.631,14.445-25.715,27.213C29.946,42.688,12.79,33.997,3.752,30.417
										c-3.956-1.567-4.265,1.021-2.966,3.814C16.45,67.934,80,79.614,80,79.614l0,0V0z"/>
								</svg>
							</span>
								<?php
							} elseif ( 'round' == $settings->hotspot_marker[ $i ]->tooltip_style ) {
								?>
							<span class="uabb-hotspot-svg">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="20px" viewBox="0 0 30 20">
									<g>
										<path fill="<?php echo uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ); ?>" d="M7.065,7.067C13.462,10.339,15,19.137,15,19.137V0H0C0,0,1.865,4.407,7.065,7.067z"/>
										<path fill="<?php echo uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ); ?>" d="M15,0v19.137c0,0,1.537-8.797,7.936-12.07C28.135,4.407,30,0,30,0H15z"/>
									</g>
								</svg>
							</span>
								<?php
							} elseif ( 'sharp' == $settings->hotspot_marker[ $i ]->tooltip_style ) {
								?>
							<span class="uabb-hotspot-svg">
								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="120px" preserveAspectRatio="none" viewBox="0 0 60 120">
									<path fill="#ffffff" d="M55.451-0.043C55.451-0.043,66.059-41.066,55.451-0.043C51.069,16.9,0.332,119.498,0.332,119.498
									S43.365,18.315,39.532-0.043c-4.099-19.616,0,0,0,0"/>
								</svg>
							</span>
								<?php
							}
							?>
						</span>
							<?php
						}
						?>
					</<?php echo $tag; ?>>
				</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
		<?php
	}
}
?>
