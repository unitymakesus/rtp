<?php
/**
 *  UABB Devices Module front-end file
 *
 *  @package UABB Devices Module
 */

$device_class                  = '';
$device_type_class             = '';
$has_orientation_control_class = '';
$scrollable_class              = '';
$image_fit_class               = '';
$image_slider_class            = '';

if ( '' !== $settings->image_src ) {
	$image_src = $settings->image_src;
} else {
	$image_src = BB_ULTIMATE_ADDON_URL . 'modules/uabb-devices/images/default-image.jpg';
}

$svg_src = BB_ULTIMATE_ADDON_URL . 'modules/uabb-devices/includes/svg/' . $settings->device_type . '.svg';

if ( 'landscape' === $settings->orientation && ( 'phone' === $settings->device_type || 'tablet' === $settings->device_type ) ) {
	$device_class = 'uabb-device-orientation-landscape';
} else {
	$device_class = 'uabb-device-orientation-portrait';
}


switch ( $settings->device_type ) {
	case 'phone':
		$device_type_class = 'uabb-device-phone';
		break;
	case 'tablet':
		$device_type_class = 'uabb-device-tablet';
		break;
	case 'laptop':
		$device_type_class = 'uabb-device-laptop';
		break;
	case 'desktop':
		$device_type_class = 'uabb-device-desktop';
		break;
	case 'window':
		$device_type_class = 'uabb-device-window';
		break;
}

if ( 'show' === $settings->orientation_control && ( 'phone' === $settings->device_type || 'tablet' === $settings->device_type ) ) {
	$has_orientation_control_class = ' has-orientation-control';
}

if ( 'yes' === $settings->scroll_on_hover ) {
	$scrollable_class = 'uabb-scrollable';
}

if ( isset( $settings->image_fit ) && '' !== $settings->image_fit && 'image' === $settings->media_type ) {
	$image_fit_class = 'uabb-image-fit';
}

if ( isset( $settings->media_type ) && '' !== $settings->media_type && 'slider' === $settings->media_type ) {
	$image_slider_class = 'uabb-image-slider uabb-img-col-1';
}
?>
<div class="uabb-devices-content">
	<div class="uabb-devices-wrapper <?php echo esc_attr( $device_class ); ?> ">
		<div class="uabb-device-wrap <?php echo esc_attr( $device_type_class ); ?>	">
			<div class="uabb-device <?php echo esc_attr( $has_orientation_control_class ); ?>">

				<div class="uabb-device-shape">
					<img src="<?php echo esc_url( $svg_src ); ?>" />
				</div>

				<div class="uabb-device-media <?php echo esc_attr( $image_fit_class . $image_slider_class ); ?>" >
					<div class="uabb-device-media-inner">
						<?php
						if ( 'image' === $settings->media_type ) {
							if ( 'portrait' === $settings->orientation ) {
								?>
								<div class="uabb-device-media-screen uabb-device-media-screen-image <?php echo esc_attr( $scrollable_class ); ?> ">
									<div class="uabb-device-media-screen-inner" style="background-image: url( <?php echo esc_url( $image_src ); ?> );">
									</div>
								</div>
								<?php
							} elseif ( 'landscape' === $settings->orientation ) {
								?>
								<div class="uabb-device-media-screen uabb-device-media-screen-landscape <?php echo esc_attr( $scrollable_class ); ?>">
									<div class="uabb-device-media-screen-inner" style="background-image: url( <?php echo esc_url( $image_src ); ?> );">
									</div>
								</div>
								<?php
							}
						} elseif ( 'video' === $settings->media_type ) {
							$video_url = '';
							switch ( $settings->video_type ) {
								case 'mp4':
									if ( 'url' === $settings->mp4_video_source ) {
										$video_url = "src=\"$settings->mp4_video_url\" type=\"video/mp4\"";
									} elseif ( 'file' === $settings->mp4_video_source ) {
										$video_url = wp_get_attachment_url( $settings->mp4_video );
										$video_url = "src=\"$video_url\" type=\"video/mp4\"";
									}
									break;
								case 'm4v':
									if ( 'url' === $settings->m4v_video_source ) {
										$video_url = "src=\"$settings->m4v_video_url\" type=\"video/x-m4v\"";
									} elseif ( 'file' === $settings->m4v_video_source ) {
										$video_url = wp_get_attachment_url( $settings->m4v_video );
										$video_url = "src=\"$video_url\" type=\"video/x-m4v\"";
									}
									break;
								case 'ogg':
									if ( 'url' === $settings->ogg_video_source ) {
										$video_url = "src=\"$settings->ogg_video_url\" type=\"video/ogg\"";
									} elseif ( 'file' === $settings->ogg_video_source ) {
										$video_url = wp_get_attachment_url( $settings->ogg_video );
										$video_url = "src=\"$video_url\" type=\"video/ogg\"";
									}
									break;
								case 'webm':
									if ( 'url' === $settings->webm_video_source ) {
										$video_url = "src=\"$settings->webm_video_url\" type=\"video/webm\"";
									} elseif ( 'file' === $settings->webm_video_source ) {
										$video_url = wp_get_attachment_url( $settings->webm_video );
										$video_url = "src=\"$video_url\" type=\"video/webm\"";
									}
									break;
							}

							$loop = '';
							if ( 'yes' === $settings->loop ) {
								$loop = 'loop';
							}

							?>
							<div  class="uabb-device-media-screen uabb-device-media-screen-video">
								<div class="uabb-device-media-screen-inner">
									<div class="uabb-video-player uabb-player">
										<?php if ( 'self_hosted' === $settings->video_src ) { ?>
											<video class="uabb-video-player-source uabb-player-source" poster="<?php echo esc_url( $settings->embed_cover_image_src ); ?>" <?php echo esc_attr( $loop ); ?> >
												<source <?php echo $video_url; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
											</video>
												<?php
										} else {
											?>
											<div class="uabb-video-iframe">
											<?php
												FLBuilder::render_module_html(
													'uabb-video',
													array(
														'video_type' => $settings->video_src,
														'youtube_link' => $settings->youtube_url,
														'vimeo_link' => $settings->vimeo_url,
														'wistia_link' => $settings->wistia_url,
														'start' => $settings->start_time,
														'end' => $settings->end_time,
														'aspect_ratio' => $settings->aspect_ratio,
														'yt_autoplay' => $settings->yt_autoplay,
														'vimeo_autoplay' => $settings->vimeo_autoplay,
														'wistia_autoplay' => $settings->wistia_autoplay,
														'yt_suggested' => $settings->rel,
														'yt_controls' => $settings->controls,
														'yt_mute' => $settings->yt_mute,
														'yt_modestbranding' => $settings->modestbranding,
														'yt_privacy' => $settings->yt_privacy,
														'vimeo_loop' => $settings->vimeo_loop,
														'vimeo_title' => $settings->vimeo_title,
														'vimeo_portrait' => $settings->vimeo_portrait,
														'vimeo_byline' => $settings->vimeo_byline,
														'wistia_muted' => $settings->wistia_mute,
														'wistia_loop' => $settings->wistia_loop,
													)
												);
											?>
											</div>
											<?php
										}
										?>
											<div class="uabb-video-player-cover uabb-player-cover">
											</div>
											<div class="uabb-video-player-controls uabb-player-controls">
												<div class="uabb-player-controls-overlay uabb-video-player-overlay">
													<div class="uabb-video-buttons">
														<?php if ( 'self_hosted' === $settings->video_src ) { ?>
															<i class="fas fa-redo uabb-player-controls-rewind uabb-video-button" title="<?php esc_attr_e( 'Rewind', 'uabb' ); ?>"></i>
															<i class="fas fa-play uabb-player-controls-play uabb-video-button" title="<?php esc_attr_e( 'Play / Pause', 'uabb' ); ?>"></i>
														<?php } ?>
													</div>
												</div>
											</div>
											<?php if ( 'self_hosted' === $settings->video_src ) { ?>
												<div class="uabb-player-controls-bar-wrapper uabb-video-player-controls-bar-wrapper">
													<div class="uabb-player-controls-bar">
														<i class="uabb-player-controls-rewind uabb-player-control-icon fas fa-redo" title="<?php esc_attr_e( 'Rewind', 'uabb' ); ?>"></i>
														<i class="uabb-player-controls-play uabb-player-control-icon fas fa-play" title="<?php esc_attr_e( 'Play / Pause', 'uabb' ); ?>"></i>

														<div class="uabb-player-control-indicator uabb-player-controls-time">00:00:00</div>

														<div class="uabb-player-controls-progress uabb-player-control-progress">
															<div class="uabb-player-control-progress-outer uabb-player-control-progress-track"></div>
															<div class="uabb-player-controls-progress-time uabb-player-control-progress-inner"></div>
														</div>

														<div class="uabb-player-controls-duration uabb-player-control-indicator">00:00:05</div>

														<div class="uabb-player-controls-volume">

															<i class="uabb-player-controls-volume-icon uabb-player-control-icon fas fa-volume-up" title="<?php esc_attr_e( 'Volume', 'uabb' ); ?>"></i>

															<div class="uabb-player-controls-volume-bar uabb-player-control-progress">
																<div class="uabb-player-controls-volume-bar-amount uabb-player-control-progress-inner" style="width: 100%;"></div>
																<div class="uabb-player-controls-volume-bar-track uabb-player-control-progress-outer uabb-player-control-progress-track"></div>
															</div>
														</div>
														<i class="uabb-player-controls-fs uabb-player-control-icon fas fa-expand" title="<?php esc_attr_e( 'Expand', 'uabb' ); ?>"></i>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<?php
						} elseif ( 'slider' === $settings->media_type ) {
							?>
							<div class="uabb-device-media-screen uabb-device-media-slider">
								<div class="uabb-device-media-screen-inner">
								<?php
								foreach ( $module->get_photos() as $photo ) {
									?>
									<div class="uabb-image-carousel-item">
										<div class="uabb-image-carousel-content">
										<?php
										$img_src = 'src="' . $photo->src . '"';
										?>
											<img class="uabb-gallery-img"
									<?php echo wp_kses_post( $img_src ); ?> alt="<?php echo esc_attr( $photo->alt ); ?>" title="<?php echo esc_attr( $photo->title ); ?>"/>
									</div>

								</div>

									<?php
								}
								?>
								</div>
							</div>
						<?php } elseif ( 'iframe' === $settings->media_type ) { ?>

							<div class="uabb-device-media-screen">
								<div class="uabb-device-media-screen-inner">

								<?php
								if ( 'yes' === $settings->async_iframe ) {
									echo '<div class="uabb-content-type-iframe" data-src="' . $settings->iframe_url . '" frameborder="0" allowfullscreen></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								} else {
									echo '<iframe src="' . $settings->iframe_url . '" class="uabb-content-iframe" frameborder="0" width="100%" height="100%" allowfullscreen></iframe>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								}
								?>
								</div>
								</div>
						<?php } ?>
						</div>
					</div>
			<?php
			if ( 'show' === $settings->orientation_control && ( 'phone' === $settings->device_type || 'tablet' === $settings->device_type ) ) {
				$mobile_icon_class = 'uabb-mobile-icon-portrait';
				if ( 'landscape' === $settings->orientation ) {
					$mobile_icon_class = 'uabb-mobile-icon-landscape';
				}
				?>
				<div class="uabb-device-orientation">
					<i class="<?php echo esc_attr( $mobile_icon_class ); ?> fas fa-mobile" aria-hidden="true"></i></div>
				<?php } ?>

			</div>
			<?php
			if ( 'show' === $settings->device_control && 'laptop' !== $settings->device_type && 'window' !== $settings->device_type ) {
				?>
				<div class="uabb-device-switch-control">
					<i class="fas fa-mobile-alt uabb-device-icon <?php echo ( 'phone' === $settings->device_type ) ? 'active' : ''; ?>" aria-hidden="true"></i>
					<i class="fas fa-tablet-alt uabb-device-icon <?php echo ( 'tablet' === $settings->device_type ) ? 'active' : ''; ?>" aria-hidden="true"></i>
					<i class="fas fa-desktop uabb-device-icon <?php echo ( 'desktop' === $settings->device_type ) ? 'active' : ''; ?>" aria-hidden="true"></i>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
