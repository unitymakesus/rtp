<?php
/**
 *  UABB Video file
 *
 *  @package UABB Video Module
 */

/**
 * Function that initializes UABB Video Module
 *
 * @class UABBVideo
 */
class UABBVideo extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Video module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Video', 'uabb' ),
				'description'     => __( 'Video', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-video/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'video-player.svg',
			)
		);
		$this->add_js( 'jquery-waypoints' );
		$this->add_js( 'jquery-ui-draggable' );
	}
	/**
	 * Function to get the icon for the Info Circle
	 *
	 * @since 1.11.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video/icon/' . $icon;
		}
		if ( file_exists( $path ) ) {
			$remove_icon = apply_filters( 'uabb_remove_svg_icon', false, 10, 1 );
			if ( true === $remove_icon ) {
				return;
			} else {
				return file_get_contents( $path );
			}
		} else {
			return '';
		}
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// compatibility for Subscribe bar.
			if ( ! isset( $settings->subscribe_font_typo ) || ! is_array( $settings->subscribe_font_typo ) ) {

				$settings->subscribe_font_typo            = array();
				$settings->subscribe_font_typo_medium     = array();
				$settings->subscribe_font_typo_responsive = array();
			}
			if ( isset( $settings->subscribe_text_font ) ) {

				if ( isset( $settings->subscribe_text_font['family'] ) ) {

					$settings->subscribe_font_typo['font_family'] = $settings->subscribe_text_font['family'];
					unset( $settings->subscribe_text_font['family'] );
				}
				if ( isset( $settings->subscribe_text_font['weight'] ) ) {

					if ( 'regular' == $settings->subscribe_text_font['weight'] ) {
						$settings->subscribe_font_typo['font_weight'] = 'normal';
					} else {
						$settings->subscribe_font_typo['font_weight'] = $settings->subscribe_text_font['weight'];
					}
					unset( $settings->subscribe_text_font['weight'] );
				}
			}
			if ( isset( $settings->subscribe_text_font_size ) ) {

				$settings->subscribe_font_typo['font_size'] = array(
					'length' => $settings->subscribe_text_font_size,
					'unit'   => 'px',
				);
				unset( $settings->subscribe_text_font_size );
			}
			if ( isset( $settings->subscribe_text_font_size_medium ) ) {
				$settings->subscribe_font_typo_medium['font_size'] = array(
					'length' => $settings->subscribe_text_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->subscribe_text_font_size_medium );
			}
			if ( isset( $settings->subscribe_text_font_size_responsive ) ) {
				$settings->subscribe_font_typo_responsive['font_size'] = array(
					'length' => $settings->subscribe_text_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->subscribe_text_font_size_responsive );
			}
			if ( isset( $settings->subscribe_text_line_height ) ) {

				$settings->subscribe_font_typo['line_height'] = array(
					'length' => $settings->subscribe_text_line_height,
					'unit'   => 'em',
				);
				unset( $settings->subscribe_text_line_height );
			}
			if ( isset( $settings->subscribe_text_line_height_medium ) ) {
				$settings->subscribe_font_typo_medium['line_height'] = array(
					'length' => $settings->subscribe_text_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->subscribe_text_line_height_medium );
			}
			if ( isset( $settings->subscribe_text_line_height_responsive ) ) {
				$settings->subscribe_font_typo_responsive['line_height'] = array(
					'length' => $settings->subscribe_text_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->subscribe_text_line_height_responsive );
			}
			if ( isset( $settings->subscribe_text_transform ) ) {

				$settings->subscribe_font_typo['text_transform'] = $settings->subscribe_text_transform;
				unset( $settings->subscribe_text_transform );
			}
			if ( isset( $settings->subscribe_text_letter_spacing ) ) {

				$settings->subscribe_font_typo['letter_spacing'] = array(
					'length' => $settings->subscribe_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->subscribe_text_letter_spacing );
			}

			// compatibility for Sticky content bar.
			if ( ! isset( $settings->subscribe_font_typo ) || ! is_array( $settings->subscribe_font_typo ) ) {

				$settings->subscribe_font_typo            = array();
				$settings->subscribe_font_typo_medium     = array();
				$settings->subscribe_font_typo_responsive = array();
			}
			if ( isset( $settings->sticky_text_font ) ) {

				if ( isset( $settings->sticky_text_font['family'] ) ) {

					$settings->sticky_font_typo['font_family'] = $settings->sticky_text_font['family'];
					unset( $settings->sticky_text_font['family'] );
				}
				if ( isset( $settings->sticky_text_font['weight'] ) ) {

					if ( 'regular' == $settings->sticky_text_font['weight'] ) {
						$settings->sticky_font_typo['font_weight'] = 'normal';
					} else {
						$settings->sticky_font_typo['font_weight'] = $settings->sticky_text_font['weight'];
					}
					unset( $settings->sticky_text_font['weight'] );
				}
			}
			if ( isset( $settings->sticky_text_font_size ) ) {

				$settings->sticky_font_typo['font_size'] = array(
					'length' => $settings->sticky_text_font_size,
					'unit'   => 'px',
				);
				unset( $settings->sticky_text_font_size );
			}
			if ( isset( $settings->sticky_text_font_size_medium ) ) {
				$settings->sticky_font_typo_medium['font_size'] = array(
					'length' => $settings->sticky_text_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->sticky_text_font_size_medium );
			}
			if ( isset( $settings->sticky_text_font_size_responsive ) ) {
				$settings->sticky_font_typo_responsive['font_size'] = array(
					'length' => $settings->sticky_text_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->sticky_text_font_size_responsive );
			}
			if ( isset( $settings->sticky_text_line_height ) ) {

				$settings->sticky_font_typo['line_height'] = array(
					'length' => $settings->sticky_text_line_height,
					'unit'   => 'em',
				);
				unset( $settings->sticky_text_line_height );
			}
			if ( isset( $settings->sticky_text_line_height_medium ) ) {
				$settings->sticky_font_typo_medium['line_height'] = array(
					'length' => $settings->sticky_text_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->sticky_text_line_height_medium );
			}
			if ( isset( $settings->sticky_text_line_height_responsive ) ) {
				$settings->sticky_font_typo_responsive['line_height'] = array(
					'length' => $settings->sticky_text_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->sticky_text_line_height_responsive );
			}
			if ( isset( $settings->sticky_text_transform ) ) {

				$settings->sticky_font_typo['text_transform'] = $settings->sticky_text_transform;
				unset( $settings->sticky_text_transform );
			}
			if ( isset( $settings->sticky_text_letter_spacing ) ) {

				$settings->sticky_font_typo['letter_spacing'] = array(
					'length' => $settings->sticky_text_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->sticky_text_letter_spacing );
			}
		}
		return $settings;
	}
	/**
	 * Returns Video URL.
	 *
	 * @param string $url Video URL.
	 * @param string $from From compare string.
	 * @param string $to To compare string.
	 * @since 1.21.0
	 * @access protected
	 */
	protected function getStringBetween( $url, $from, $to ) {
		$sub = substr( $url, strpos( $url, $from ) + strlen( $from ), strlen( $url ) );
		$id  = substr( $sub, 0, strpos( $sub, $to ) );

		return $id;
	}
	/**
	 * Returns Video ID.
	 *
	 * @since 1.11.0
	 * @access public
	 */
	public function get_video_id() {

		$id         = '';
		$video_type = $this->settings->video_type;

		if ( 'youtube' === $video_type ) {
			$url = $this->settings->youtube_link;
			if ( preg_match( '~^(?:https?://)? (?:www[.])?(?:youtube[.]com/watch[?]v=|youtu[.]be/)([^&]{11})~x', $url ) ) {
				if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches ) ) {
					$id = $matches[1];
				}
			}
		} elseif ( 'vimeo' === $video_type ) {
			$url = $this->settings->vimeo_link;
			if ( preg_match( '/https?:\/\/(?:www\.)?vimeo\.com\/\d{8}/', $url ) ) {
				$id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $url, '/' ) );
			}
		} elseif ( 'wistia' === $video_type ) {
			$url = $this->settings->wistia_link;
			$id  = $this->getStringBetween( $url, 'wvideo=', '"' );

		}
		return $id;
	}
	/**
	 * Returns Video URL.
	 *
	 * @param array  $params Video Param array.
	 * @param string $id Video ID.
	 * @since 1.11.0
	 * @access public
	 */
	public function get_url( $params, $id ) {

		if ( 'vimeo' == $this->settings->video_type ) {
			$url = 'https://player.vimeo.com/video/';
		} elseif ( 'youtube' === $this->settings->video_type ) {
			$cookie = '';

			if ( 'yes' == $this->settings->yt_privacy ) {
				$cookie = '-nocookie';
			}
			$url = 'https://www.youtube' . $cookie . '.com/embed/';
		} elseif ( 'wistia' === $this->settings->video_type ) {

			$url = 'https://fast.wistia.net/embed/iframe/';

		}

		$url = add_query_arg( $params, $url . $id );

		$url .= ( empty( $params ) ) ? '?' : '&';

		$url .= 'autoplay=1';

		if ( 'vimeo' == $this->settings->video_type && '' != $this->settings->start ) {
			$time = date( 'H\hi\ms\s', $this->settings->start );

			$url .= '#t=' . $time;
		}

		$url = apply_filters( 'uabb_video_url_filter', $url, $id );

		return $url;
	}
	/**
	 * Returns Video Thumbnail Image.
	 *
	 * @param string $id Video ID.
	 * @since 1.11.0
	 * @access public
	 */
	public function get_video_thumb( $id ) {
		$id = $this->get_video_id();
		if ( '' == $this->get_video_id() ) {
			return '';
		}
		if ( 'yes' === $this->settings->show_image_overlay ) {
			$thumb = $this->settings->image_overlay_src;
		} else {
			if ( 'youtube' === $this->settings->video_type ) {
				$thumb = 'https://i.ytimg.com/vi/' . $id . '/' . apply_filters( 'uabb_video_youtube_image_quality', $this->settings->yt_thumbnail_size ) . '.jpg';
			} elseif ( 'vimeo' === $this->settings->video_type ) {
				$vimeo = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$id.php" ) );
				$thumb = str_replace( '_640', '_840', $vimeo[0]['thumbnail_large'] );
			} elseif ( 'wistia' === $this->settings->video_type ) {
				$url   = $this->settings->wistia_link;
				$thumb = 'https://embedwistia-a.akamaihd.net/deliveries/' . $this->getStringBetween( $url, 'deliveries/', '?' );
			}
		}
		return $thumb;
	}

	/**
	 * Returns custom thumbnails alt values.
	 *
	 * @since 1.16.6
	 * @access public
	 * @method get_alt_tag
	 */
	public function get_alt_tag() {
		$alt = '';
		if ( isset( $this->settings->image_overlay ) ) {
			$photo_data = FLBuilderPhoto::get_attachment_data( $this->settings->image_overlay );
			$alt        = ( isset( $photo_data->alt ) && '' !== $photo_data->alt ) ? "alt ='$photo_data->alt'" : '';
		}
		return apply_filters( 'uabb_video_alt_tag', $alt );
	}

	/**
	 * Returns Vimeo Headers.
	 *
	 * @param string $id Video ID.
	 * @since 1.11.0
	 * @access public
	 */
	public function get_header_wrap( $id ) {

		if ( 'vimeo' != $this->settings->video_type ) {
			return;
		}
		$id = $this->get_video_id();
		if ( isset( $id ) && '' != $id ) {
			if ( 'yes' == $this->settings->vimeo_portrait ||
			'yes' == $this->settings->vimeo_title ||
			'yes' == $this->settings->vimeo_byline
			) {
				$vimeo = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$id.php" ) );
				?>
			<div class="uabb-vimeo-wrap">
				<?php if ( 'yes' == $this->settings->vimeo_portrait ) { ?>
				<div class="uabb-vimeo-portrait">
					<a href="<?php $vimeo[0]['user_url']; ?>"><img src="<?php echo $vimeo[0]['user_portrait_huge']; ?>"></a>
				</div>
			<?php } ?>
				<?php
				if ( 'yes' == $this->settings->vimeo_title || 'yes' == $this->settings->vimeo_byline ) {
					?>
				<div class="uabb-vimeo-headers">
					<?php if ( 'yes' == $this->settings->vimeo_title ) { ?>
						<div class="uabb-vimeo-title">
							<a href="<?php $this->settings->vimeo_link; ?>"><?php echo $vimeo[0]['title']; ?></a>
						</div>
					<?php } ?>
					<?php if ( 'yes' == $this->settings->vimeo_byline ) { ?>
						<div class="uabb-vimeo-byline">
							<?php _e( 'from ', 'uabb' ); ?> <a href="<?php $this->settings->vimeo_link; ?>"><?php echo $vimeo[0]['user_name']; ?></a>
						</div>
					<?php } ?>
				</div>
				<?php } ?>
				</div>
			<?php } ?>
			<?php
		}
	}
	/**
	 * Render Video.
	 *
	 * @since 1.11.0
	 * @access public
	 */
	public function get_video_embed() {
		$id          = $this->get_video_id();
		$embed_param = $this->get_embed_params();
		$src         = $this->get_url( $embed_param, $id );
		if ( 'yes' == $this->settings->video_double_click ) {
			$device = false;
		} else {
			$device = ( false !== ( stripos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' ) ) ? true : false );
		}

		if ( 'youtube' == $this->settings->video_type ) {
			$autoplay = ( 'yes' == $this->settings->yt_autoplay ) ? '1' : '0';
		} elseif ( 'vimeo' == $this->settings->video_type ) {
			$autoplay = ( 'yes' == $this->settings->vimeo_autoplay ) ? '1' : '0';
		} elseif ( 'wistia' == $this->settings->video_type ) {
			$autoplay = ( 'yes' == $this->settings->wistia_autoplay ) ? '1' : '0';
		}
		if ( 'default' == $this->settings->play_source ) {
			if ( 'youtube' == $this->settings->video_type ) {
				$html = '<svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="uabb-youtube-icon-bg" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e"></path><path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path><path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path></svg>';
			}
			if ( 'vimeo' === $this->settings->video_type ) {
				$html = '<svg version="1.1" height="100%" width="100%"  viewBox="0 14.375 95 66.25"><path class="uabb-vimeo-icon-bg" d="M12.5,14.375c-6.903,0-12.5,5.597-12.5,12.5v41.25c0,6.902,5.597,12.5,12.5,12.5h70c6.903,0,12.5-5.598,12.5-12.5v-41.25c0-6.903-5.597-12.5-12.5-12.5H12.5z"/><polygon fill="#FFFFFF" points="39.992,64.299 39.992,30.701 62.075,47.5 "/></svg>';
			}
			if ( 'wistia' === $this->settings->video_type ) {
				$html = '<button class="uabb-video-wistia-play w-big-play-button w-css-reset-button-important w-vulcan-v2-button"><svg x="0px" y="0px" viewBox="0 0 125 80" enable-background="new 0 0 125 80" focusable="false" alt="" style="fill: rgb(255, 255, 255); height: 100%; left: 0px; stroke-width: 0px; top: 0px; width: 100%;"><rect fill-rule="evenodd" clip-rule="evenodd" fill="none" width="125" height="80"></rect><polygon fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" points="53,22 53,58 79,40"></polygon></svg></button>';
			}
		} elseif ( 'icon' == $this->settings->play_source ) {
			$html = '';
		} else {
			$thumb = $this->settings->play_img_src;
			$html  = '<img src="' . $thumb . '" />';
		}

		?>
		<div class="uabb-video uabb-aspect-ratio-<?php echo $this->settings->aspect_ratio; ?>  uabb-subscribe-responsive-<?php echo $this->settings->subscribe_bar_responsive; ?> uabb-video-sticky-<?php echo $this->settings->sticky_alignment; ?>">
			<div class="uabb-video__outer-wrap <?php echo ( 'yes' == $this->settings->sticky_info_bar_enable ) ? 'uabb-sticky-infobar-wrap' : ''; ?>" data-autoplay="<?php echo $autoplay; ?>" data-device="<?php echo $device; ?> ">
				<?php $this->get_header_wrap( $id ); ?>
				<div class="uabb-video-inner-wrap">
					<div class="uabb-video__play" data-src="<?php echo $src; ?>">
						<img class="uabb-video__thumb" src="<?php echo $this->get_video_thumb( $id ); ?>" <?php echo $this->get_alt_tag(); ?> />
						<div class="uabb-video__play-icon <?php echo ( 'icon' == $this->settings->play_source ) ? $this->settings->play_icon : ''; ?> uabb-animation-<?php echo $this->settings->hover_animation; ?>">
							<?php echo $html; ?>
						</div>
					</div>
					<?php
					if ( 'yes' === $this->settings->enable_sticky && 'none' !== $this->settings->enable_sticky_close_button ) {
						?>
					<div class="uabb-video-sticky-close">
						<?php
						if ( 'icon' == $this->settings->enable_sticky_close_button ) {
							$_icon = $this->settings->sticky_close_icon;
							echo '<i class="' . $_icon . '"></i>';
						}
						?>
					</div>
					<?php } ?>
					<?php if ( 'yes' == $this->settings->sticky_info_bar_enable && '' != $this->settings->sticky_info_bar_text ) { ?>
						<div class="uabb-video-sticky-infobar"><?php echo $this->settings->sticky_info_bar_text; ?></div>
					<?php } ?>

				</div>
			</div>
			<?php
			if ( 'youtube' == $this->settings->video_type && 'yes' == $this->settings->yt_subscribe_enable ) {
				$channel_name = ( '' != $this->settings->yt_channel_name ) ? $this->settings->yt_channel_name : '';

				$channel_id = ( '' != $this->settings->yt_channel_id ) ? $this->settings->yt_channel_id : '';

				$youtube_text = ( '' != $this->settings->yt_subscribe_text ) ? $this->settings->yt_subscribe_text : '';

				$subscriber_count = ( 'yes' == $this->settings->show_count ) ? 'default' : 'hidden';
				?>
			<div class="uabb-subscribe-bar">
				<div class="uabb-subscribe-bar-prefix"><?php echo $youtube_text; ?></div>
				<div class="uabb-subscribe-content">
					<script src="https://apis.google.com/js/platform.js"></script> <!-- Need to be enqueued from someplace else -->
				<?php if ( 'channel_name' == $this->settings->select_options ) { ?>
					<div class="g-ytsubscribe" data-channel="<?php echo $channel_name; ?>" data-count="<?php echo $subscriber_count; ?>"></div>
				<?php } elseif ( 'channel_id' == $this->settings->select_options ) { ?>
					<div class="g-ytsubscribe" data-channelid="<?php echo $channel_id; ?>" data-count="<?php echo $subscriber_count; ?>"></div>
				<?php } ?>
				</div>
			</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	/**
	 * Render Video output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.11.0
	 * @access public
	 */
	public function render() {
		if ( '' === $this->settings->youtube_link && 'youtube' === $this->settings->video_type ) {
			return '';
		}
		if ( '' === $this->settings->vimeo_link && 'vimeo' === $this->settings->video_type ) {
			return '';
		}
		if ( '' === $this->settings->vimeo_link && 'wistia' === $this->settings->video_type ) {
			return '';
		}
		$this->get_video_embed();
	}


	/**
	 * Get embed params.
	 *
	 * Retrieve video widget embed parameters.
	 *
	 * @since 1.11.0
	 * @access public
	 *
	 * @return array Video embed parameters.
	 */
	public function get_embed_params() {
		$params = array();
		if ( 'youtube' === $this->settings->video_type ) {
			$youtube_options = array( 'autoplay', 'rel', 'controls', 'mute', 'modestbranding' );
			foreach ( $youtube_options as $option ) {
				if ( 'autoplay' == $option ) {
					if ( 'yes' === $this->settings->yt_autoplay ) {
						$params[ $option ] = '1';
					}
					continue;
				}
				if ( 'rel' == $option ) {
					$value             = ( 'yes' === $this->settings->yt_suggested ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'controls' == $option ) {
					$value             = ( 'yes' === $this->settings->yt_controls ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'mute' == $option ) {
					$value             = ( 'yes' === $this->settings->yt_mute ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'modestbranding' == $option ) {
					$value             = ( 'yes' === $this->settings->yt_modestbranding ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				$params['start'] = $this->settings->start;
				$params['end']   = $this->settings->end;
			}
		}
		if ( 'vimeo' === $this->settings->video_type ) {
			$vimeo_options = array( 'autoplay', 'loop', 'title', 'portrait', 'byline' );

			foreach ( $vimeo_options as $option ) {
				if ( 'autoplay' == $option ) {
					if ( 'yes' === $this->settings->vimeo_autoplay ) {
						$params[ $option ] = '1';
					}
					continue;
				}
				if ( 'loop' === $option ) {
					$value             = ( 'yes' === $this->settings->vimeo_loop ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'title' === $option ) {
					$value             = ( 'yes' === $this->settings->vimeo_title ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'portrait' === $option ) {
					$value             = ( 'yes' === $this->settings->vimeo_portrait ) ? '1' : '0';
					$params[ $option ] = $value;
				}
				if ( 'byline' === $option ) {
					$value             = ( 'yes' === $this->settings->vimeo_byline ) ? '1' : '0';
					$params[ $option ] = $value;
				}
			}
			$params['color']     = str_replace( '#', '', $this->settings->vimeo_color );
			$params['autopause'] = '0';
		}
		if ( 'wistia' === $this->settings->video_type ) {

			$wistia_options = array( 'autoplay', 'playbar', 'muted', 'loop' );

			foreach ( $wistia_options as $option ) {

				if ( 'autoplay' === $option ) {
					if ( 'yes' === $this->settings->wistia_autoplay ) {
						$params[ $option ] = '1';
					}
					continue;
				}

				if ( 'loop' === $option ) {
					if ( 'yes' === $this->settings->wistia_loop ) {
						$params['endVideoBehavior'] = 'loop';
					}
					continue;
				}
				if ( 'playbar' === $option ) {
					$value             = ( 'yes' === $this->settings->wistia_playbar ) ? 'true' : 'false';
					$params[ $option ] = $value;
				}
				if ( 'muted' === $option ) {
					$value             = ( 'yes' === $this->settings->wistia_muted ) ? 'true' : 'false';
					$params[ $option ] = $value;
				}
			}

			$params['videoFoam'] = 'true';
		}
		return $params;
	}

	/**
	 * Get help descriptions.
	 *
	 * @since 1.13.0
	 * @param string $field gets the module field name.
	 * @access public
	 */
	public static function get_description( $field ) {

		$style1 = 'line-height: 1em; padding-bottom:5px;';
		$style2 = 'line-height: 1em; padding-bottom:7px;';

		if ( 'youtube_link' === $field ) {

			$youtube_link_desc = sprintf( /* translators: %s: search term */
				__(
					'<div style="%2$s"> Make sure you add the actual URL of the video and not the share URL.</div>
				<div style="%1$s"><b> Valid URL : </b>  https://www.youtube.com/watch?v=HJRzUQMhJMQ</div>
				<div style="%1$s"> <b> Invalid URL : </b> https://youtu.be/HJRzUQMhJMQ</div>',
					'uabb'
				),
				$style1,
				$style2
			);

			return $youtube_link_desc;

		} elseif ( 'vimeo_link' === $field ) {

			$vimeo_link_desc = sprintf( /* translators: %s: search term */
				__(
					'<div style="%1$s">Make sure you add the actual URL of the video and not the share URL.</div>
				<div style="%1$s"><b> Valid URL : </b>  https://vimeo.com/274860274</div>
				<div style="%1$s"> <b> Invalid URL : </b> https://vimeo.com/channels/staffpicks/274860274</div>',
					'uabb'
				),
				$style1
			);

			return $vimeo_link_desc;
		} elseif ( 'wistia_link' === $field ) {

			$wistia_link_desc = sprintf( /* translators: %s: search term */
				__(
					'<div style="%1$s">Go to your Wistia video, right click, "Copy Link & Thumbnail" and paste here.</div>',
					'uabb'
				),
				$style1
			);

			return $wistia_link_desc;
		}

		$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
		$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

		if ( empty( $branding_name ) && empty( $branding_short_name ) ) {

			if ( 'yt_channel_id' === $field ) {

				$youtube_channel_id = sprintf( __( 'Click <a href="https://www.ultimatebeaver.com/docs/how-to-find-youtube-channel-name-and-channel-id/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=video-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to know how to find your YouTube Channel ID.', 'uabb' ) );

				return $youtube_channel_id;
			}
		} else {

			$youtube_channel_id = sprintf( __( 'Click <a href="https://support.google.com/youtube/answer/3250431?hl=en" target="_blank" rel="noopener"> <strong> here</strong> </a> to know how to find your YouTube Channel ID.', 'uabb' ) );

			return $youtube_channel_id;
		}

		if ( empty( $branding_name ) && empty( $branding_short_name ) ) {

			if ( 'yt_channel_name' === $field ) {

				$youtube_channel_name = sprintf( __( 'Click <a href="https://www.ultimatebeaver.com/docs/how-to-find-youtube-channel-name-and-channel-id/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=video-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to know how to find your YouTube Channel Name.', 'uabb' ) );

				return $youtube_channel_name;
			}
		} else {

			$youtube_channel_name = sprintf( __( 'Click <a href="https://support.google.com/youtube/answer/3250431?hl=en" target="_blank" rel="noopener"> <strong> here</strong> </a> to know how to find your YouTube Channel Name.', 'uabb' ) );

			return $youtube_channel_name;
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video/uabb-video-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video/uabb-video-bb-less-than-2-2-compatibility.php';
}
