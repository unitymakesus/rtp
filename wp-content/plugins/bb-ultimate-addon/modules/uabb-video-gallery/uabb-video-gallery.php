<?php
/**
 *  UABB Video Gallery Module file
 *
 *  @package UABB Video Gallery Module
 */

/**
 * Function that initializes UABB Video Gallery Module
 *
 * @class UABBVideoGallery
 */
class UABBVideoGallery extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Social Share module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Video  Gallery', 'uabb' ),
				'description'     => __( 'Video Gallery', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video-gallery/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-video-gallery/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'video-gallery.svg',
			)
		);
		$this->add_js( 'isotope', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-masonary.js', array( 'jquery' ), '', true );
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );
		$this->add_js( 'imagesloaded-uabb', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/imagesloaded.min.js', array( 'jquery' ), '', true );
		$this->add_js( 'jquery-magnificpopup' );
		$this->add_css( 'jquery-magnificpopup' );
		$this->add_css( 'font-awesome-5' );
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
			if ( ! isset( $settings->filter_font_typo ) || ! is_array( $settings->filter_font_typo ) ) {

				$settings->filter_font_typo            = array();
				$settings->filter_font_typo_medium     = array();
				$settings->filter_font_typo_responsive = array();
			}
			if ( isset( $settings->filter_title_font ) ) {

				if ( isset( $settings->filter_title_font['family'] ) ) {

					$settings->filter_font_typo['font_family'] = $settings->filter_title_font['family'];
					unset( $settings->filter_title_font['family'] );
				}
				if ( isset( $settings->filter_title_font['weight'] ) ) {

					if ( 'regular' == $settings->filter_title_font['weight'] ) {
						$settings->filter_font_typo['font_weight'] = 'normal';
					} else {
						$settings->filter_font_typo['font_weight'] = $settings->filter_title_font['weight'];
					}
					unset( $settings->filter_title_font['weight'] );
				}
			}
			if ( isset( $settings->filter_title_font_size_unit ) ) {

				$settings->filter_font_typo['font_size'] = array(
					'length' => $settings->filter_title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->filter_title_font_size_unit );
			}
			if ( isset( $settings->filter_title_font_size_unit_medium ) ) {
				$settings->filter_font_typo_medium['font_size'] = array(
					'length' => $settings->filter_title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->filter_title_font_size_unit_medium );
			}
			if ( isset( $settings->filter_title_font_size_unit_responsive ) ) {
				$settings->filter_font_typo_responsive['font_size'] = array(
					'length' => $settings->filter_title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->filter_title_font_size_unit_responsive );
			}
			if ( isset( $settings->filter_title_line_height_unit ) ) {

				$settings->filter_font_typo['line_height'] = array(
					'length' => $settings->filter_title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->filter_title_line_height_unit );
			}
			if ( isset( $settings->filter_title_line_height_unit_medium ) ) {
				$settings->filter_font_typo_medium['line_height'] = array(
					'length' => $settings->filter_title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->filter_title_line_height_unit_medium );
			}
			if ( isset( $settings->filter_title_line_height_unit_responsive ) ) {
				$settings->filter_font_typo_responsive['line_height'] = array(
					'length' => $settings->filter_title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->filter_title_line_height_unit_responsive );
			}
			if ( isset( $settings->filter_title_transform ) ) {

				$settings->filter_font_typo['text_transform'] = $settings->filter_title_transform;
				unset( $settings->filter_title_transform );
			}
			if ( isset( $settings->filter_title_letter_spacing ) ) {

				$settings->filter_font_typo['letter_spacing'] = array(
					'length' => $settings->filter_title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->filter_title_letter_spacing );
			}
			if ( ! isset( $settings->cat_font_typo ) || ! is_array( $settings->cat_font_typo ) ) {

				$settings->cat_font_typo            = array();
				$settings->cat_font_typo_medium     = array();
				$settings->cat_font_typo_responsive = array();
			}
			if ( isset( $settings->cat_font ) ) {

				if ( isset( $settings->cat_font['family'] ) ) {

					$settings->cat_font_typo['font_family'] = $settings->cat_font['family'];
					unset( $settings->cat_font['family'] );
				}
				if ( isset( $settings->cat_font['weight'] ) ) {

					if ( 'regular' == $settings->cat_font['weight'] ) {
						$settings->cat_font_typo['font_weight'] = 'normal';
					} else {
						$settings->cat_font_typo['font_weight'] = $settings->cat_font['weight'];
					}
					unset( $settings->cat_font['weight'] );
				}
			}
			if ( isset( $settings->cat_font_size_unit ) ) {

				$settings->cat_font_typo['font_size'] = array(
					'length' => $settings->cat_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size_unit );
			}
			if ( isset( $settings->cat_font_size_unit_medium ) ) {
				$settings->cat_font_typo_medium['font_size'] = array(
					'length' => $settings->cat_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size_unit_medium );
			}
			if ( isset( $settings->cat_font_size_unit_responsive ) ) {
				$settings->cat_font_typo_responsive['font_size'] = array(
					'length' => $settings->cat_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size_unit_responsive );
			}
			if ( isset( $settings->cat_line_height_unit ) ) {

				$settings->cat_font_typo['line_height'] = array(
					'length' => $settings->cat_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height_unit );
			}
			if ( isset( $settings->cat_line_height_unit_medium ) ) {
				$settings->cat_font_typo_medium['line_height'] = array(
					'length' => $settings->cat_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height_unit_medium );
			}
			if ( isset( $settings->cat_line_height_unit_responsive ) ) {
				$settings->cat_font_typo_responsive['line_height'] = array(
					'length' => $settings->cat_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height_unit_responsive );
			}
			if ( isset( $settings->cat_title_transform ) ) {

				$settings->cat_font_typo['text_transform'] = $settings->cat_title_transform;
				unset( $settings->cat_title_transform );
			}
			if ( isset( $settings->cat_title_letter_spacing ) ) {

				$settings->cat_font_typo['letter_spacing'] = array(
					'length' => $settings->cat_title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->cat_title_letter_spacing );
			}
			if ( ! isset( $settings->caption_font_typo ) || ! is_array( $settings->caption_font_typo ) ) {

				$settings->caption_font_typo            = array();
				$settings->caption_font_typo_medium     = array();
				$settings->caption_font_typo_responsive = array();
			}
			if ( isset( $settings->caption_font ) ) {

				if ( isset( $settings->caption_font['family'] ) ) {

					$settings->caption_font_typo['font_family'] = $settings->caption_font['family'];
					unset( $settings->caption_font['family'] );
				}
				if ( isset( $settings->caption_font['weight'] ) ) {

					if ( 'regular' == $settings->caption_font['weight'] ) {
						$settings->caption_font_typo['font_weight'] = 'normal';
					} else {
						$settings->caption_font_typo['font_weight'] = $settings->caption_font['weight'];
					}
					unset( $settings->caption_font['weight'] );
				}
			}
			if ( isset( $settings->caption_font_size_unit ) ) {

				$settings->caption_font_typo['font_size'] = array(
					'length' => $settings->caption_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->caption_font_size_unit );
			}
			if ( isset( $settings->caption_font_size_unit_medium ) ) {
				$settings->caption_font_typo_medium['font_size'] = array(
					'length' => $settings->caption_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->caption_font_size_unit_medium );
			}
			if ( isset( $settings->caption_font_size_unit_responsive ) ) {
				$settings->caption_font_typo_responsive['font_size'] = array(
					'length' => $settings->caption_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->caption_font_size_unit_responsive );
			}
			if ( isset( $settings->caption_line_height_unit ) ) {

				$settings->caption_font_typo['line_height'] = array(
					'length' => $settings->caption_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->caption_line_height_unit );
			}
			if ( isset( $settings->caption_line_height_unit_medium ) ) {
				$settings->caption_font_typo_medium['line_height'] = array(
					'length' => $settings->caption_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->caption_line_height_unit_medium );
			}
			if ( isset( $settings->caption_line_height_unit_responsive ) ) {
				$settings->caption_font_typo_responsive['line_height'] = array(
					'length' => $settings->caption_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->caption_line_height_unit_responsive );
			}
			if ( isset( $settings->caption_transform ) ) {

				$settings->caption_font_typo['text_transform'] = $settings->caption_transform;
				unset( $settings->caption_transform );
			}
			if ( isset( $settings->caption_letter_spacing ) ) {

				$settings->caption_font_typo['letter_spacing'] = array(
					'length' => $settings->caption_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->caption_letter_spacing );
			}
			if ( ! isset( $settings->tag_font_typo ) || ! is_array( $settings->tag_font_typo ) ) {

				$settings->tag_font_typo            = array();
				$settings->tag_font_typo_medium     = array();
				$settings->tag_font_typo_responsive = array();
			}
			if ( isset( $settings->tag_font ) ) {

				if ( isset( $settings->tag_font['family'] ) ) {

					$settings->tag_font_typo['font_family'] = $settings->tag_font['family'];
					unset( $settings->tag_font['family'] );
				}
				if ( isset( $settings->tag_font['weight'] ) ) {

					if ( 'regular' == $settings->tag_font['weight'] ) {
						$settings->tag_font_typo['font_weight'] = 'normal';
					} else {
						$settings->tag_font_typo['font_weight'] = $settings->tag_font['weight'];
					}
					unset( $settings->tag_font['weight'] );
				}
			}
			if ( isset( $settings->tag_font_size_unit ) ) {

				$settings->tag_font_typo['font_size'] = array(
					'length' => $settings->tag_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->tag_font_size_unit );
			}
			if ( isset( $settings->tag_font_size_unit_medium ) ) {
				$settings->tag_font_typo_medium['font_size'] = array(
					'length' => $settings->tag_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->tag_font_size_unit_medium );
			}
			if ( isset( $settings->tag_font_size_unit_responsive ) ) {
				$settings->tag_font_typo_responsive['font_size'] = array(
					'length' => $settings->tag_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->tag_font_size_unit_responsive );
			}
			if ( isset( $settings->tag_line_height_unit ) ) {

				$settings->tag_font_typo['line_height'] = array(
					'length' => $settings->tag_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->tag_line_height_unit );
			}
			if ( isset( $settings->tag_line_height_unit_medium ) ) {
				$settings->tag_font_typo_medium['line_height'] = array(
					'length' => $settings->tag_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->tag_line_height_unit_medium );
			}
			if ( isset( $settings->tag_line_height_unit_responsive ) ) {
				$settings->tag_font_typo_responsive['line_height'] = array(
					'length' => $settings->tag_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->tag_line_height_unit_responsive );
			}
			if ( isset( $settings->tag_transform ) ) {

				$settings->tag_font_typo['text_transform'] = $settings->tag_transform;
				unset( $settings->tag_transform );
			}
			if ( isset( $settings->tag_letter_spacing ) ) {

				$settings->tag_font_typo['letter_spacing'] = array(
					'length' => $settings->tag_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->tag_letter_spacing );
			}
			if ( isset( $settings->cat_filter_border_color ) ) {

				$settings->cat_filter_border_param = array();
				if ( isset( $settings->cat_filter_border_type ) ) {
					$settings->cat_filter_border_param['style'] = $settings->cat_filter_border_type;
					unset( $settings->cat_filter_border_type );
				}
				$settings->cat_filter_border_param['color'] = $settings->cat_filter_border_color;
				if ( isset( $settings->cat_filter_border ) ) {
					$settings->cat_filter_border_param['width'] = array(
						'bottom' => $settings->cat_filter_border,
					);
					unset( $settings->cat_filter_border );
				}
				unset( $settings->cat_filter_border_color );
			}
			if ( isset( $settings->cat_filter_border_color_active ) ) {
				$settings->cat_filter_border_active_param = array();

				if ( isset( $settings->cat_filter_border_active_type ) ) {
					$settings->cat_filter_border_active_param['style'] = $settings->cat_filter_border_active_type;
					unset( $settings->cat_filter_border_active_type );
				}

				$settings->cat_filter_border_active_param['color'] = $settings->cat_filter_border_color_active;

				if ( isset( $settings->cat_filter_border_active ) ) {
					$settings->cat_filter_border_active_param['width'] = array(
						'bottom' => $settings->cat_filter_border_active,
					);
					unset( $settings->cat_filter_border_active );
				}
				unset( $settings->cat_filter_border_color_active );
			}
			if ( isset( $settings->cat_filter_align ) ) {
				$settings->cat_filter_align_param = $settings->cat_filter_align;
				unset( $settings->cat_filter_align );
			}
		}
		return $settings;
	}

	/**
	 * Function to get the icon for the Video Gallery
	 *
	 * @since 1.13.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video-gallery/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video-gallery/icon/' . $icon;
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
	 * Render Placeholder Image HTML.
	 *
	 * @param Array $item Current video array.
	 * @since 1.13.0
	 * @access public
	 */
	public function get_placeholder_image( $item ) {
		$url       = '';
		$vid_id    = '';
		$video_url = '';

		if ( 'youtube' === $item->video_type ) {
			$video_url = $item->youtube_link;
		} elseif ( 'vimeo' === $item->video_type ) {
			$video_url = $item->vimeo_link;
		} elseif ( 'wistia' === $item->video_type ) {
			$video_url = $item->wistia_link;
		}

		if ( 'youtube' === $item->video_type ) {
			if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches ) ) {
				$vid_id = $matches[1];
			}
		} elseif ( 'vimeo' === $item->video_type ) {

			$vid_id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $video_url, '/' ) );
		} elseif ( 'wistia' === $item->video_type ) {

			$vid_id = $this->getStringBetween( $video_url, 'wvideo=', '"' );
		}

		if ( 'yes' === $item->custom_placeholder ) {

			$url = $item->placeholder_image_src;

		} else {
			if ( 'youtube' === $item->video_type ) {

				$url = 'https://i.ytimg.com/vi/' . $vid_id . '/' . apply_filters( 'uabb_vg_youtube_image_quality', $item->yt_thumbnail_size ) . '.jpg';
			} elseif ( 'vimeo' === $item->video_type ) {
				if ( '' !== $vid_id && 0 !== $vid_id ) {
					$vimeo = unserialize( file_get_contents( "https://vimeo.com/api/v2/video/$vid_id.php" ) );
					$url   = $vimeo[0]['thumbnail_large'];
				}
			} elseif ( 'wistia' === $item->video_type ) {

				$url = 'https://embedwistia-a.akamaihd.net/deliveries/' . $this->getStringBetween( $video_url, 'deliveries/', '?' );
			}
		}
		return array(
			'url'      => $url,
			'video_id' => $vid_id,
		);
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
	 * Render Play Button.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function get_play_button() {

		if ( 'default' === $this->settings->play_source ) {
			?>
			<svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="uabb-video-gallery-icon-bg" d="m .66,37.62 c 0,0 .66,4.70 2.70,6.77 2.58,2.71 5.98,2.63 7.49,2.91 5.43,.52 23.10,.68 23.12,.68 .00,-1.3e-5 14.29,-0.02 23.81,-0.71 1.32,-0.15 4.22,-0.17 6.81,-2.89 2.03,-2.07 2.70,-6.77 2.70,-6.77 0,0 .67,-5.52 .67,-11.04 l 0,-5.17 c 0,-5.52 -0.67,-11.04 -0.67,-11.04 0,0 -0.66,-4.70 -2.70,-6.77 C 62.03,.86 59.13,.84 57.80,.69 48.28,0 34.00,0 34.00,0 33.97,0 19.69,0 10.18,.69 8.85,.84 5.95,.86 3.36,3.58 1.32,5.65 .66,10.35 .66,10.35 c 0,0 -0.55,4.50 -0.66,9.45 l 0,8.36 c .10,4.94 .66,9.45 .66,9.45 z" fill="#1f1f1e"></path><path d="m 26.96,13.67 18.37,9.62 -18.37,9.55 -0.00,-19.17 z" fill="#fff"></path><path d="M 45.02,23.46 45.32,23.28 26.96,13.67 43.32,24.34 45.02,23.46 z" fill="#ccc"></path></svg>
			<?php
		} elseif ( 'icon' === $this->settings->play_source ) {
			?>
			<i class="<?php echo $this->settings->play_icon . ' uabb-animation-' . $this->settings->hover_animation; ?> uabb-vg__play-icon"></i>
			<?php
		} elseif ( 'img' === $this->settings->play_source ) {

			$url = $this->settings->play_img_src;

			?>
				<img class="uabb-vg__play-image <?php echo 'uabb-animation-' . $this->settings->hover_animation; ?>" src="<?php echo $url; ?>" />
			<?php
		}
	}
	/**
	 * Render Tag Classes.
	 *
	 * @param Array $item Current video array.
	 * @since 1.13.0
	 * @access public
	 */
	public function get_tag_class( $item ) {
		$tags = explode( ',', $item->tags );
		$tags = array_map( 'trim', $tags );

		$tags_array = array();

		foreach ( $tags as $key => $value ) {
			$tags_array[ $this->clean( $value ) ] = $value;
		}

		return $tags_array;
	}
	/**
	 * Clean string - Removes spaces and special chars.
	 *
	 * @since 1.13.0
	 * @param String $string String to be cleaned.
	 * @return array Google Map languages List.
	 */
	public function clean( $string ) {

		// Replaces all spaces with hyphens.
		$string = str_replace( ' ', '-', $string );

		// Removes special chars.
		$string = preg_replace( '/[^A-Za-z0-9\-]/', '', $string );

		// Turn into lower case characters.
		return strtolower( $string );
	}
	/**
	 * Render Gallery Data.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function render_gallery_inner_data() {

		$gallery     = $this->settings->form_gallery;
		$new_gallery = array();
		$href        = '';
		if ( 'rand' === $this->settings->gallery_rand ) {
			$keys = array_keys( $gallery );
			shuffle( $keys );

			foreach ( $keys as $key ) {

				$new_gallery[ $key ] = $gallery[ $key ];

			}
		} else {
			$new_gallery = $gallery;
		}

		foreach ( $new_gallery as $index => $item ) {

			if ( 'youtube' === $item->video_type ) {

				$href = $item->youtube_link;

			} elseif ( 'vimeo' === $item->video_type ) {

				$href = $item->vimeo_link;

			} elseif ( 'wistia' === $item->video_type ) {
				$wistia_id = $this->getStringBetween( $item->wistia_link, 'wvideo=', '"' );
				$video_url = 'https://fast.wistia.net/embed/iframe/' . $wistia_id . '?videoFoam=true';
				$href      = $video_url . '&autoplay=1';

			}

			$url = $this->get_placeholder_image( $item );

			if ( 'yes' === $this->settings->show_filter && 'grid' === $this->settings->layout ) {

				if ( '' !== $item->tags ) {

					$tags     = $this->get_tag_class( $item );
					$tags_key = implode( ' ', array_keys( $tags ) );
				}
			}
			if ( 'youtube' === $item->video_type ) {
				$vurl = 'https://www.youtube.com/embed/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
			} elseif ( 'vimeo' === $item->video_type ) {
				$vurl = 'https://player.vimeo.com/video/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
			} elseif ( 'wistia' === $item->video_type ) {
				$vurl = $video_url . '&autoplay=1';
			}
			if ( 'inline' !== $this->settings->click_action ) {
					$html = '<a href="' . $href . '" data-fancybox="uabb-video-gallery" data-url="' . $vurl . '"class="uabb-video-gallery-fancybox uabb-vg__play_full ">';
			} else {
				if ( 'youtube' === $item->video_type ) {
					$vurl = 'https://www.youtube.com/embed/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
				} elseif ( 'vimeo' === $item->video_type ) {
					$vurl = 'https://player.vimeo.com/video/' . $url['video_id'] . '?autoplay=1&version=3&enablejsapi=1';
				} elseif ( 'wistia' === $item->video_type ) {

					$vurl = $video_url . '&autoplay=1';
				}
				$html = '<a href="' . $href . '" class="uabb-clickable uabb-vg__play_full" data-url="' . $vurl . '">';
			}

			?>
			<div  class="uabb-video__gallery-item <?php echo ( isset( $tags_key ) ) ? $tags_key : ''; ?> ">
				<div class="uabb-video__gallery-iframe" style="background-image:url('<?php echo $url['url']; ?>');">
					<?php echo $html; ?>
						<div class="uabb-video__content-wrap">
							<div class="uabb-video__content">
								<?php $this->get_caption( $item ); ?>
									<div class="uabb-vg__play <?php echo ( 'default' === $this->settings->play_source ) ? 'uabb-animation-' . $this->settings->hover_animation : ''; ?>">
										<?php $this->get_play_button(); ?>
									</div>
									<?php $this->get_tag( $item ); ?>
							</div>
						</div>
					<?php echo '</a>'; ?>
				</div>
				<div class="uabb-vg__overlay"></div>
			</div>
			<?php
		}
	}
	/**
	 * Returns the Caption HTML.
	 *
	 * @param Array $item Current video array.
	 * @since 1.13.0
	 * @access public
	 */
	public function get_caption( $item ) {

		if ( '' == $item->title ) {
			return '';
		}
		if ( 'yes' !== $this->settings->show_caption ) {
			return '';
		}
		?>
		<h4 class="uabb-video__caption"><?php echo $item->title; ?></h4>
		<?php
	}
	/**
	 * Returns the Filter HTML.
	 *
	 * @param Array $item Current video array.
	 * @since 1.13.0
	 * @access public
	 */
	public function get_tag( $item ) {

		if ( '' == $item->tags ) {
			return '';
		}
		if ( 'yes' !== $this->settings->show_tag ) {
			return '';
		}
		?>
		<span class="uabb-video__tags"><?php echo $item->tags; ?></span>
		<?php
	}
	/**
	 * Get Filter taxonomy array.
	 *
	 * Returns the Filter array of objects.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function get_filter_values() {

		$filters = array();

		if ( ! empty( $this->settings->form_gallery ) ) {

			foreach ( $this->settings->form_gallery as $key => $value ) {

				$tags = $this->get_tag_class( $value );

				if ( ! empty( $tags ) ) {

					$filters = array_unique( array_merge( $filters, $tags ) );
				}
			}
		}

		return $filters;
	}
	/**
	 * Get Filters.
	 *
	 * Returns the Filter HTML.
	 *
	 * @since 1.13.0
	 * @access public
	 */
	public function render_gallery_filters() {

		$filters = $this->get_filter_values();

		$filters = apply_filters( 'uabb_video_gallery_filters', $filters );
		$default = '';

		if ( 'yes' === $this->settings->default_filter_switch && '' !== $this->settings->default_filter ) {

			$default = '.' . trim( $this->settings->default_filter );
			$default = strtolower( str_replace( ' ', '-', $default ) );

		}
		?>
		<div class="uabb-video-gallery-filters-wrap">
			<?php if ( 'yes' === $this->settings->show_filter_title ) { ?>
				<div class="uabb-video-gallery-title-filters">
					<div class="uabb-video-gallery-title">
						<<?php echo $this->settings->filter_title_tag; ?> class="uabb-video-gallery-title-text"><?php echo $this->settings->filters_heading_text; ?></<?php echo $this->settings->filter_title_tag; ?>>
					</div>
			<?php } ?>
					<ul class="uabb-video__gallery-filters" data-default="
					<?php
					echo ( isset( $default ) ) ? $default : '';
					?>
					">
						<li class="uabb-video__gallery-filter uabb-filter__current" data-filter="*">
						<?php
						echo ( '' !== $this->settings->filters_all_text ) ? $this->settings->filters_all_text : __( 'All', 'uabb' );
						?>
						</li>
						<?php foreach ( $filters as $key => $value ) { ?>
							<li class="uabb-video__gallery-filter" data-filter="<?php echo '.' . $key; ?>">
								<?php echo $value; ?>
							</li>
						<?php } ?>
					</ul>
				<?php if ( 'yes' === $this->settings->show_filter_title ) { ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
	/**
	 * Render Buttons output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.13.0
	 * @access protected
	 */
	public function render() {

		if ( 'yes' === $this->settings->show_filter && 'grid' === $this->settings->layout && 'carousel' !== $this->settings->layout ) {

			$filters = $this->get_filter_values();

			$filter_data = json_encode( array_keys( $filters ) );
				$this->render_gallery_filters();
			?>
			<div class="uabb-video-gallery-wrap uabb-video-gallery-filter uabb-vg__layout-<?php echo $this->settings->layout; ?> uabb-vg__action-<?php echo $this->settings->click_action; ?> uabb-aspect-ratio-<?php echo $this->settings->video_ratio; ?>" data-action ="<?php echo $this->settings->click_action; ?>" data-layout="<?php echo $this->settings->layout; ?>" data-all-filters=<?php echo ( isset( $filter_data ) ) ? $filter_data : ''; ?>>
				<?php $this->render_gallery_inner_data(); ?>
			</div>
			<?php
		} else {
			?>

			<div class="uabb-video-gallery-wrap uabb-vg__layout-<?php echo $this->settings->layout; ?> uabb-vg__action-<?php echo $this->settings->click_action; ?> uabb-aspect-ratio-<?php echo $this->settings->video_ratio; ?>" data-action ="<?php echo $this->settings->click_action; ?>" data-layout="<?php echo $this->settings->layout; ?>">
			<?php $this->render_gallery_inner_data(); ?>

			</div>
			<?php
		}
	}
	/**
	 * Get help descriptions.
	 *
	 * @since 1.13.0
	 * @access public
	 * @param string $field which fetches field name.
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
					'<div style="%1$s">Make sure you add the actual URL of the video and not the categorized URL.</div>
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
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video-gallery/uabb-video-gallery-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-video-gallery/uabb-video-gallery-bb-less-than-2-2-compatibility.php';
}
