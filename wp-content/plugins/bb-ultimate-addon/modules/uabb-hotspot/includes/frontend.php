<?php
/**
 *  UABB Hotspot Module front-end file.
 *
 *  @package UABB Hotspot Module.
 */

$photo_src      = ( 'url' !== $settings->photo_source ) ? ( ( isset( $settings->photo_src ) && '' !== $settings->photo_src ) ? $settings->photo_src : '' ) : ( ( '' !== $settings->photo_url ) ? $settings->photo_url : '' );
$alt            = $module->get_image_details();
$hide_nonactive = '';
if ( 'yes' === $settings->hotspot_tour ) {
	if ( 'yes' === $settings->hotspot_nonactive_markers ) {
		$hide_nonactive = 'uabb-hotspot-marker-nonactive';
	}
}

$next_label     = __( 'Next', 'uabb' );
$previous_label = __( 'Previous', 'uabb' );
$endtour_label  = __( 'End Tour', 'uabb' );
$next           = apply_filters( 'uabb_hotspot_next_label', $next_label, $settings );
$previous       = apply_filters( 'uabb_hotspot_previous_label', $previous_label, $settings );
$end            = apply_filters( 'uabb_hotspot_endtour_label', $endtour_label, $settings );

if ( isset( $photo_src ) ) {
	if ( '' !== $photo_src ) {
		?>
		<div class="uabb-module-content uabb-hotspot">
			<div class="uabb-hotspot-container">
			<img class="uabb-hotspot-image" src="<?php echo esc_url( $photo_src ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
			<div class="uabb-hotspot-items">
				<?php
				if ( count( $settings->hotspot_marker ) > 0 ) {
					$counter = 1;
					$count   = count( $settings->hotspot_marker );
					for ( $i = 0; $i < $count; $i++ ) {
						$settings->hotspot_marker[ $i ]->tooltip_bg_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'tooltip_bg_color' );
						?>
				<div class="uabb-hotspot-item-<?php echo esc_attr( $i ); ?> uabb-hotspot-item <?php echo esc_attr( $hide_nonactive ); ?>" data-name="<?php echo esc_attr( $i ); ?>" data-uabb-tour="<?php echo esc_attr( $counter ); ?>">
						<?php
						$hotspot_link = '';
						$target       = '';
						$hotspot_glow = '';
						if ( 'link' === $settings->hotspot_marker[ $i ]->on_click_action ) {
							$hotspot_link = ' href="' . $settings->hotspot_marker[ $i ]->link . '"';
							$target       = ' target="' . $settings->hotspot_marker[ $i ]->target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $settings->hotspot_marker[ $i ]->target, 0, 0 );
							$hotspot_tag  = 'a';
						} else {
							$hotspot_link = '';
							$target       = '';
							$hotspot_tag  = 'span';
						}
						?>
					<<?php echo esc_attr( $hotspot_tag ); ?> class="uabb-hotspot-tooltip uabb-tooltip-style-<?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_style ); ?> uabb-tooltip-<?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_content_position ); ?> " <?php echo $hotspot_link; ?> <?php echo wp_kses_post( $target ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php $module->render_image_icon( $i ); ?>
						<?php
						if ( 'tooltip' === $settings->hotspot_marker[ $i ]->on_click_action ) {
							?>
						<span class="uabb-hotspot-tooltip-content uabb-text-editor">
							<?php
							echo $settings->hotspot_marker[ $i ]->tooltip_content; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							if ( 'yes' === $settings->hotspot_tour ) {
								?>
								<span class="uabb-tour"><span class="uabb-actual-step"><?php echo esc_attr( $counter ); ?> <?php esc_attr_e( 'of', 'uabb' ); ?> <?php echo count( $settings->hotspot_marker ); ?>	</span>
									<ul class="uabb-hotspot-tour-tooltip-list-group" >
										<li class="uabb-hotspot-tour-tooltip-list-group-item">
											<a class="uabb-prev uabb-prev-<?php echo esc_attr( $i ); ?>" id='<?php echo esc_attr( $i ); ?>' data-tooltips-id="<?php echo esc_attr( $counter ); ?>"> &#171; <?php echo esc_attr( $previous ); ?></a>
										</li>
										<li class="uabb-hotspot-tour-tooltip-list-group-item">
											<a class="uabb-next uabb-next-<?php echo esc_attr( $i ); ?>" id='<?php echo esc_attr( $i ); ?>' data-tooltips-id="<?php echo esc_attr( $counter ); ?>"><?php echo esc_attr( $next ); ?> &#187; </a>
										</li>
									</ul>
								</span>
								<?php
								if ( 'yes' === $settings->hotspot_tour_autoplay && 'yes' === $settings->hotspot_tour_repeat ) {
									?>
										<span class="uabb-hotspot-end"><a class="uabb-tour-end" data-itemid="<?php echo esc_attr( $i ); ?>"><?php echo esc_attr( $end ); ?></a></span>
									<?php
								}
							}
							?>
							<?php
							if ( 'curved' === $settings->hotspot_marker[ $i ]->tooltip_style ) {
								?>
							<span class="uabb-hotspot-svg">
								<svg version="1.1" width="1.2em" height="1.2em" viewBox="0 0 80 80">
									<path fill="<?php echo wp_kses_post( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>" d="M80,0c0,0-5.631,14.445-25.715,27.213C29.946,42.688,12.79,33.997,3.752,30.417
										c-3.956-1.567-4.265,1.021-2.966,3.814C16.45,67.934,80,79.614,80,79.614l0,0V0z"/>
								</svg>
							</span>
								<?php
							} elseif ( 'round' === $settings->hotspot_marker[ $i ]->tooltip_style ) {
								?>
							<span class="uabb-hotspot-svg">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="20px" viewBox="0 0 30 20">
									<g>
										<path fill="<?php echo wp_kses_post( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>" d="M7.065,7.067C13.462,10.339,15,19.137,15,19.137V0H0C0,0,1.865,4.407,7.065,7.067z"/>
										<path fill="<?php echo wp_kses_post( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>" d="M15,0v19.137c0,0,1.537-8.797,7.936-12.07C28.135,4.407,30,0,30,0H15z"/>
									</g>
								</svg>
							</span>
								<?php
							} elseif ( 'sharp' === $settings->hotspot_marker[ $i ]->tooltip_style ) {
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
					</<?php echo esc_attr( $hotspot_tag ); ?>>
					</div>
						<?php
						$counter++;
					}
				}
				?>
			</div>
		<?php


		if ( 'yes' === $settings->hotspot_tour && 'yes' === $settings->hotspot_tour_autoplay && 'click' === $settings->autoplay_options ) {
			?>
			<div class="uabb-hotspot-overlay">
				<div class="uabb-overlay-button">
					<?php echo wp_kses_post( $module->render_button() ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
		<?php
	}
}
?>
