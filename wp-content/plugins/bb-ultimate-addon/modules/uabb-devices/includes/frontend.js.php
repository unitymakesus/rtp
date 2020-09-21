<?php
/**
 *  Frontend JS php file for Devices Module.
 *
 *  @package UABB Devices Module Frontend.js.php file.
 */

?>
(function($) {

	var nodeclass = '.fl-node-' + '<?php echo esc_attr( $id ); ?>';

	$(".fl-node-<?php echo esc_attr( $id ); ?> .uabb-device-orientation .fas.fa-mobile").click(function(e){
		if( $( nodeclass + ' .uabb-device-wrap').hasClass('uabb-device-phone') || $( nodeclass + ' .uabb-device-wrap').hasClass('uabb-device-tablet') ) {

		if( $(this).hasClass( 'uabb-mobile-icon-portrait' ) ){
			$( nodeclass + ' .uabb-devices-wrapper').removeClass( 'uabb-device-orientation-portrait' );
			$( nodeclass + ' .uabb-devices-wrapper').addClass( 'uabb-device-orientation-landscape' );
			$(this).removeClass( 'uabb-mobile-icon-portrait' );
			$(this).addClass( 'uabb-mobile-icon-landscape' );
		}
		else if( $(this).hasClass( 'uabb-mobile-icon-landscape' ) ){
			$( nodeclass + ' .uabb-devices-wrapper').removeClass( 'uabb-device-orientation-landscape' );
			$( nodeclass + ' .uabb-devices-wrapper').addClass( 'uabb-device-orientation-portrait' );
			$(this).addClass( 'uabb-mobile-icon-portrait' );
			$(this).removeClass( 'uabb-mobile-icon-landscape' );
		}
	}
	});

	$( nodeclass + ' .uabb-device-switch-control .fas.fa-mobile-alt').click(function(e){
		$( nodeclass + ' .uabb-device-shape>img' ).attr('src','<?php echo esc_url( BB_ULTIMATE_ADDON_URL ); ?>modules/uabb-devices/includes/svg/phone.svg');
		$( nodeclass + ' .uabb-device-wrap').addClass('uabb-device-phone');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-desktop').removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-tablet-alt' ).removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-mobile-alt').addClass('active');
		$( nodeclass + ' .uabb-device-wrap').removeClass('uabb-device-tablet uabb-device-desktop');
		$( nodeclass + ' .uabb-device-orientation').show();
	});
	$( nodeclass + ' .uabb-device-switch-control .fas.fa-tablet-alt').click(function(e){
		$( nodeclass + ' .uabb-device-shape>img').attr('src','<?php echo esc_url( BB_ULTIMATE_ADDON_URL ); ?>modules/uabb-devices/includes/svg/tablet.svg');
		$( nodeclass + ' .uabb-device-wrap').addClass('uabb-device-tablet');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-desktop').removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-mobile-alt' ).removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-tablet-alt').addClass('active');
		$( nodeclass + ' .uabb-device-wrap').removeClass('uabb-device-phone uabb-device-desktop');
		$( nodeclass + ' .uabb-device-orientation').show();
	});
	$( nodeclass + ' .uabb-device-switch-control .fas.fa-desktop').click(function(e){
		$( nodeclass + ' .uabb-device-shape>img').attr('src','<?php echo esc_url( BB_ULTIMATE_ADDON_URL ); ?>modules/uabb-devices/includes/svg/desktop.svg');
		$( nodeclass + ' .uabb-device-wrap').addClass('uabb-device-desktop');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-tablet-alt').removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-mobile-alt' ).removeClass('active');
		$( nodeclass + ' .uabb-device-switch-control .fas.fa-desktop').addClass('active');
		$( nodeclass + ' .uabb-device-wrap').removeClass('uabb-device-phone uabb-device-tablet');
		$( nodeclass + ' .uabb-devices-wrapper').removeClass('uabb-device-orientation-landscape');
		$( nodeclass + ' .uabb-device-orientation').hide();
	});

	$(function() {
			new UABBDevices({
				id: '<?php echo esc_attr( $id ); ?>',
				device_type: '<?php echo esc_attr( $settings->device_type ); ?>',
				media_type: '<?php echo esc_attr( $settings->media_type ); ?>',
				autoplay: <?php echo esc_attr( ( 'yes' === $settings->autoplay_slider ) ? 'true' : 'false' ); ?>,
				infinite: <?php echo esc_attr( ( 'yes' === $settings->infinite_loop ) ? 'true' : 'false' ); ?>,
				arrows: <?php echo esc_attr( ( 'yes' === $settings->enable_arrows ) ? 'true' : 'false' ); ?>,
				next_arrow: '<?php echo esc_attr( 'fas fa-angle-right' ); ?>',
				prev_arrow: '<?php echo esc_attr( 'fas fa-angle-left' ); ?>',
				small_breakpoint: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
				medium_breakpoint: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>
			});
			var nodeclass = '.fl-node-' + '<?php echo esc_attr( $id ); ?>';
			var $video_obj = $(nodeclass + ' .uabb-video-player-source');
			var video = $(nodeclass + ' .uabb-video-player-source')[0];
			var playbtn = $(nodeclass + ' .uabb-player-controls-play');
			var rewindbtn = $(nodeclass + ' .uabb-player-controls-rewind');
			var controls = $(nodeclass + ' .uabb-video-player-controls');
			var control_bar = $(nodeclass + ' .uabb-player-controls-bar');
			var fs_control = $(nodeclass + ' .uabb-player-controls-fs');
			var isBuilderActive = <?php echo ( FLBuilderModel::is_builder_active() ) ? 'true' : 'false'; ?>;
			var restart_on_pause = false;
			if( ! isBuilderActive ){
				$(nodeclass + ' .uabb-player-controls-rewind.uabb-video-button').hide();
			}
			<?php
			if ( 'yes' === $settings->restart_on_pause ) {
				?>
					restart_on_pause = true;
				<?php
			}
			?>

			<?php
			if ( 'yes' === $settings->stop_others ) {
				?>
					$("video").on("play", function() {
						$("video").not(this).each(function(index, video) {
							plybtn = $(video).parent().find('.uabb-player-controls-play');
							plybtn.removeClass('fa-pause');
							plybtn.addClass('fa-play');
							video.pause();
						});
					});
				<?php
			}
			?>
			<?php
			if ( ! empty( $settings->hover_controls_color ) ) {
				?>
					$(nodeclass + ' .uabb-player-controls-bar').on("hover", function() {
						$(nodeclass + ' .uabb-player-control-progress').children().css('background', '<?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->hover_controls_color ) ); ?>');
					});
					<?php
			}
			?>

			//get HTML5 video time duration
			$video_obj.on('loadedmetadata', function() {
				<?php
				if ( 'yes' === $settings->mute && 'self_hosted' === $settings->video_src ) {
					?>
					$(nodeclass + ' .uabb-player-controls-volume-icon').trigger('click');
					<?php
				}
				if ( 'yes' === $settings->auto_play ) {
					?>
					playbtn.first().trigger('click');
					<?php
				}
				?>
				//playback speed.
				video.playbackRate = <?php echo esc_attr( $settings->playback_speed ); ?>;
				var date = new Date(null);
				date.setSeconds(video.duration); // specify value for SECONDS here
				var timeString = date.toISOString().substr(11, 8);
				$( nodeclass +' .uabb-player-controls-duration').text(timeString);
			});


			//update HTML5 video current play time
			$video_obj.on('timeupdate', function() {
				var currentPos = video.currentTime; //Get currenttime
				var maxduration = video.duration; //Get video duration
				var percentage = 100 * currentPos / maxduration; //in %
				$(nodeclass +' .uabb-player-controls-progress-time.uabb-player-control-progress-inner').css('width', percentage+'%');
				var date = new Date(null);
				date.setSeconds(video.currentTime); // specify value for SECONDS here
				timeString = date.toISOString().substr(11, 8);
				$(nodeclass +' .uabb-player-controls-time').text(timeString);
			});

			//on video play
			$video_obj.on('play', function() {
				controls.fadeOut();
				control_bar.fadeOut();
				$(nodeclass +' .uabb-video-player-cover.uabb-player-cover').css('opacity', '0');
			});

			//on video pause
			$video_obj.on('pause', function() {
				$(nodeclass + ' .uabb-player-controls-rewind.uabb-video-button').show();
			});


			if( ! isBuilderActive ){
				if ( $(video).length > 0 ) {
					$(nodeclass +' .uabb-device-media').hover(function(){
						controls.fadeIn();
						control_bar.fadeIn();
						$(nodeclass +' .uabb-video-player-cover.uabb-player-cover').css('opacity', '');
					},
					function(){
						controls.fadeOut();
						control_bar.fadeOut();
						$(nodeclass +' .uabb-video-player-cover.uabb-player-cover').css('opacity', '0');
					});
				}
			}

			//mute
			$(nodeclass + ' .uabb-player-controls-volume-icon').click(function() {
				if( $(this).hasClass('fa-volume-up') ){
					$(this).removeClass('fa-volume-up');
					$(this).addClass('fa-volume-mute');
				}
				else if( $(this).hasClass('fa-volume-mute') ){
					$(this).removeClass('fa-volume-mute');
					$(this).addClass('fa-volume-up');
				}
				video.muted = !video.muted;
				return false;
			});

			//volume bar

			var volumeDrag = false;   /* Drag status */
			$( nodeclass + ' .uabb-player-controls-volume-bar').mousedown(function(e) {
				volumeDrag = true;
				updateVolumeBar(e.pageX);
			});
			$(nodeclass + ' .uabb-player-controls-volume-bar').mouseup(function(e) {
				if(volumeDrag) {
					volumeDrag = false;
					updateVolumeBar(e.pageX);
				}
			});
			$(nodeclass + ' .uabb-player-controls-volume-bar').mousemove(function(e) {
				if(volumeDrag) {
					updateVolumeBar(e.pageX);
				}
			});

			//Update Volume Bar control
			var updateVolumeBar = function(x) {
				var volumebar = $( nodeclass + ' .uabb-player-controls-volume-bar');

				var position = x - volumebar.offset().left; //Click pos
				var volume = position / volumebar.width();
				var percentage = 100 * volume; //in %
				//Check within range
				if(volume > 1) {
					volume = 1;
					percentage = 100;
				}
				if(volume < 0) {
					volume = 0;
					percentage = 0;
				}

				//Update volume
				video.volume = volume;
				$( nodeclass +' .uabb-player-controls-volume-bar-amount.uabb-player-control-progress-inner').css('width', percentage+'%');
			};


			//Rewind control
			rewindbtn.on('click', function() {
				video.currentTime = 0;
				return false;
			});

			//Full screen control
			fs_control.on('click', function() {
				// go full-screen
				if (video.requestFullscreen) {
					video.requestFullscreen();
				} else if (video.webkitRequestFullscreen) {
					video.webkitRequestFullscreen();
				} else if (video.mozRequestFullScreen) {
					video.mozRequestFullScreen();
				} else if (video.msRequestFullscreen) {
					video.msRequestFullscreen();
				}
				return false;
			});

			var timeDrag = false;   /* Drag status */
			$( nodeclass + ' .uabb-player-controls-progress').mousedown(function(e) {
				timeDrag = true;
				updatebar(e.pageX);
			});
			$(nodeclass + ' .uabb-player-controls-progress').mouseup(function(e) {
				if(timeDrag) {
					timeDrag = false;
					updatebar(e.pageX);
				}
			});
			$(nodeclass + ' .uabb-player-controls-progress').mousemove(function(e) {
				if(timeDrag) {
					updatebar(e.pageX);
				}
			});

			//Update Progress Bar control
			var updatebar = function(x) {
				var progress = $( nodeclass + ' .uabb-player-controls-progress');
				var maxduration = video.duration; //Video duraiton
				var position = x - progress.offset().left; //Click pos
				var percentage = 100 * position / progress.width();

				//Check within range
				if(percentage > 100) {
					percentage = 100;
				}
				if(percentage < 0) {
					percentage = 0;
				}

				//Update progress bar and video currenttime
				video.currentTime = maxduration * percentage / 100;
				$(nodeclass +' .uabb-player-controls-progress-time.uabb-player-control-progress-inner').css('width', percentage+'%');


				<?php
				if ( 'yes' === $settings->end_at_last_frame && 'no' === $settings->loop ) {
					?>
					if( 100 === percentage ){
						plybtn = $( nodeclass + ' .uabb-player-controls-play');
						plybtn.removeClass('fa-pause');
						plybtn.addClass('fa-play');
					}
					<?php
				}
				?>
			};

			playbtn.on("click", function (e) {
				if ( $(nodeclass).find( '.uabb-video-iframe' ).length > 0 ) {
					$(nodeclass).find( '.uabb-video-iframe' )[0].src = $(nodeclass).find( '.uabb-video-iframe' )[0].src.replace('&autoplay=1', '');
					$(nodeclass).find( '.uabb-video-iframe' )[0].src = $(nodeclass).find( '.uabb-video-iframe' )[0].src.replace('autoplay=1', '');

					$(nodeclass).find( '.uabb-video-player-cover' ).fadeOut(800, function() {
						$(this).hide();
					});

					$(nodeclass).find( '.uabb-video-player-controls' ).hide();

					var iframeSrc = $(nodeclass).find( '.uabb-video-iframe' )[0].src.replace('&autoplay=0', '');

					iframeSrc = iframeSrc.replace('autoplay=0', '');

					var src = iframeSrc.split('#');
					iframeSrc = src[0] + '&autoplay=1';

					if ( 'undefined' !== typeof src[1] ) {
						iframeSrc += '#' + src[1];
					}

					$(nodeclass).find( '.uabb-video-iframe' )[0].src = iframeSrc;

				}
				else if ( $(video).length > 0 ) {
					if( $(this).hasClass('fa-play') ) {
						video.play();
						playbtn.removeClass('fa-play');
						playbtn.addClass('fa-pause');
					}
					else if( $(this).hasClass('fa-pause') ){
						video.pause();
						playbtn.removeClass('fa-pause');
						playbtn.addClass('fa-play');
						if ( restart_on_pause ) {
							video.currentTime = 0;
						}

					}
				}
				return false;
			});

			<?php
			if ( 'self_hosted' !== $settings->video_src && '' !== $settings->embed_cover_image_src && 'yes' === $settings->auto_play ) {
				?>
				if ( $(nodeclass).find( '.uabb-video-iframe' ).length > 0 ) {
					playbtn.first().click();
				}
				<?php
			}
			?>
		});

})(jQuery);
