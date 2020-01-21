<?php
/**
 *  UABB Modal Popup Module file
 *
 *  @package UABB Modal Popup Module
 */

/**
 * Function that initializes Modal Popup Module
 *
 * @class ModalPopupModule
 */
class ModalPopupModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Modal Popup Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'        => __( 'Modal Popup', 'uabb' ),
				'description' => __( 'Video Popup', 'uabb' ),
				'category'    => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'       => UABB_CAT,
				'dir'         => BB_ULTIMATE_ADDON_DIR . 'modules/modal-popup/',
				'url'         => BB_ULTIMATE_ADDON_URL . 'modules/modal-popup/',
				'icon'        => 'button.svg',
			)
		);

		$this->add_css( 'font-awesome-5' );
		$this->add_js( 'jquery-fitvids' );
		$this->add_js( 'uabbpopup-cookies', $this->url . 'js/js_cookie.js', array(), '', true );
	}

	/**
	 * Render Button
	 *
	 * @param var $module_id gets the id of the module.
	 */
	public function render_button( $module_id ) {
		$btn_settings = array(

			/* General Section */
			'text'                       => $this->settings->btn_text,

			/* Link Section */
			'link'                       => 'javascript:void(0)',
			'link_target'                => '_self',
			/* Style Section */
			'style'                      => $this->settings->btn_style,
			'border_size'                => $this->settings->btn_border_size,
			'transparent_button_options' => $this->settings->btn_transparent_button_options,
			'threed_button_options'      => $this->settings->btn_threed_button_options,
			'flat_button_options'        => $this->settings->btn_flat_button_options,

			/* Colors */
			'bg_color'                   => $this->settings->btn_bg_color,
			'bg_hover_color'             => $this->settings->btn_bg_hover_color,
			'text_color'                 => $this->settings->btn_text_color,
			'text_hover_color'           => $this->settings->btn_text_hover_color,

			/* Icon */
			'icon'                       => $this->settings->btn_icon,
			'icon_position'              => $this->settings->btn_icon_position,

			/* Structure */
			'width'                      => $this->settings->btn_width,
			'custom_width'               => $this->settings->btn_custom_width,
			'custom_height'              => $this->settings->btn_custom_height,
			'padding_top_bottom'         => $this->settings->btn_padding_top_bottom,
			'padding_left_right'         => $this->settings->btn_padding_left_right,
			'border_radius'              => $this->settings->btn_border_radius,
			'align'                      => $this->settings->btn_align,
			'mob_align'                  => $this->settings->btn_mob_align,

			'a_data'                     => 'data-modal=' . $module_id . ' ',
			'a_class'                    => 'uabb-trigger',
			'button_padding_dimension'   => ( isset( $this->settings->button_padding_dimension ) ) ? $this->settings->button_padding_dimension : '',
			'button_border'              => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
			'border_hover_color'         => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
		);
		FLBuilder::render_module_html( 'uabb-button', $btn_settings );
	}

	/**
	 * Get Modal Content
	 *
	 * @param object $settings gets the settings of the module.
	 */
	public function get_modal_content( $settings ) {
		$content_type = $settings->content_type;
		switch ( $content_type ) {
			case 'content':
				global $wp_embed;
				return wpautop( $wp_embed->autoembed( $settings->ct_content ) );
			break;
			case 'photo':
				if ( isset( $settings->ct_photo_src ) ) {
					$image_data = FLBuilderPhoto::get_attachment_data( $settings->ct_photo );
					$image_alt  = isset( $image_data->alt ) ? $image_data->alt : '';
					return '<img src="' . $settings->ct_photo_src . '" alt="' . $image_alt . '"/>';
				}
				return '<img src="" />';
			break;
			case 'video':
				global $wp_embed;
				return $wp_embed->autoembed( $settings->ct_video );
			break;
			case 'iframe':
				if ( 'yes' === $this->settings->async_iframe ) {
					return '<div class="uabb-modal-content-type-iframe" data-src="' . $settings->iframe_url . '" frameborder="0" allowfullscreen></div>';
				} else {
					return '<iframe src="' . $settings->iframe_url . '" class="uabb-content-iframe" frameborder="0" width="100%" height="100%" allowfullscreen></iframe>';
				}
				break;
			case 'saved_rows':
				return '[fl_builder_insert_layout id="' . $settings->ct_saved_rows . '" type="fl-builder-template"]';
			case 'saved_modules':
				return '[fl_builder_insert_layout id="' . $settings->ct_saved_modules . '" type="fl-builder-template"]';
			case 'saved_page_templates':
				return '[fl_builder_insert_layout id="' . $settings->ct_page_templates . '" type="fl-builder-template"]';
			break;
			case 'youtube':
				return $this->get_video_embed();
			case 'vimeo':
				return $this->get_video_embed();
			default:
				return;
			break;
		}
	}

	/**
	 * Get video Id
	 */
	public function get_video_embed() {
		if ( '' == $this->settings->video_url ) {
			return '';
		}

		$url            = $this->settings->video_url;
		$vid_id         = '';
		$html           = '';
		$related_videos = '';
		$html           = '<div class="uabb-video-wrap">';

		if ( 'youtube' === $this->settings->content_type ) {
			if ( preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches ) ) {
				$vid_id = $matches[1];
			}

			if ( 'yes' == $this->settings->youtube_related_videos ) {
				$related_videos = '&rel=0';
			} else {
				$related_videos = '';
			}
			if ( 'yes' == $this->settings->youtube_player_controls ) {
				$player_controls = '&controls=0';
			} else {
				$player_controls = '';
			}
			$thumb = 'https://i.ytimg.com/vi/' . $vid_id . '/hqdefault.jpg';

			$html .= '<div class="uabb-modal-iframe uabb-video-player" data-src="youtube" data-id="' . $vid_id . '" data-append="?version=3&enablejsapi=1' . $related_videos . $player_controls . '" data-thumb="' . $thumb . '"></div>';
		} elseif ( 'vimeo' === $this->settings->content_type ) {
			$vid_id = preg_replace( '/[^\/]+[^0-9]|(\/)/', '', rtrim( $url, '/' ) );
			$thumb  = '';
			if ( '' !== $vid_id && 0 !== $vid_id ) {
					$vimeo = unserialize( @file_get_contents( "https://vimeo.com/api/v2/video/$vid_id.php" ) );// @codingStandardsIgnoreStart
					$thumb = $vimeo[0]['thumbnail_large'];
				$html     .= '<div class="uabb-modal-iframe uabb-video-player" data-src="vimeo" data-id="' . $vid_id . '" data-append="?title=0&byline=0&portrait=0&badge=0" data-thumb="' . $thumb . '"></div>';
			}
		}
		$html .= '</div>';
		return $html;
	}

	/**
	 * Get Width and Height
	 */
	public function get_width_height() {
		$size['width']  = '';
		$size['height'] = '';
		if ( is_numeric( $this->settings->modal_width ) && $this->settings->modal_width > 0 ) {

			$temp_width = $this->settings->modal_width;

			$size['width'] = $temp_width;

			if ( '16_9' == $this->settings->video_ratio ) {
				$size['height'] = ( ( $temp_width / 16 ) * 9 );

			} else {
				$size['height'] = ( ( $temp_width / 4 ) * 3 );
			}
			return $size;
		}
		return false;
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

			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			$helper->handle_opacity_inputs( $settings, 'title_bg_color_opc', 'title_bg_color' );
			// For Title Typography.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {
				if ( isset( $settings->title_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit );
			}
			if ( isset( $settings->title_font_size_unit_medium ) ) {

				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_medium );
			}
			if ( isset( $settings->title_font_size_unit_responsive ) ) {

				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_responsive );
			}
			if ( isset( $settings->title_line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit );
			}
			if ( isset( $settings->title_line_height_unit_medium ) ) {

				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_medium );
			}
			if ( isset( $settings->title_line_height_unit_responsive ) ) {

				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_responsive );
			}
			if ( isset( $settings->title_transform ) ) {
				$settings->title_font_typo['text_transform'] = $settings->title_transform;
				unset( $settings->title_transform );
			}
			if ( isset( $settings->title_letter_spacing ) ) {
				$settings->title_font_typo['letter_spacing'] = array(
					'length' => $settings->title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->title_letter_spacing );
			}

			// For Content Font Typo.
			if ( ! isset( $settings->ct_content_font_typo ) || ! is_array( $settings->ct_content_font_typo ) ) {

				$settings->ct_content_font_typo            = array();
				$settings->ct_content_font_typo_medium     = array();
				$settings->ct_content_font_typo_responsive = array();
			}
			if ( isset( $settings->ct_content_font_family ) ) {

				if ( isset( $settings->ct_content_font_family['family'] ) ) {
					$settings->ct_content_font_typo['font_family'] = $settings->ct_content_font_family['family'];
					unset( $settings->ct_content_font_family['family'] );
				}
				if ( isset( $settings->ct_content_font_family['weight'] ) ) {
					if ( 'regular' == $settings->ct_content_font_family['weight'] ) {
						$settings->ct_content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->ct_content_font_typo['font_weight'] = $settings->ct_content_font_family['weight'];
					}
					unset( $settings->ct_content_font_family['weight'] );
				}
			}
			if ( isset( $settings->ct_content_font_size_unit ) ) {

				$settings->ct_content_font_typo['font_size'] = array(
					'length' => $settings->ct_content_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->ct_content_font_size_unit );
			}
			if ( isset( $settings->ct_content_font_size_unit_medium ) ) {

				$settings->ct_content_font_typo_medium['font_size'] = array(
					'length' => $settings->ct_content_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->ct_content_font_size_unit_medium );
			}
			if ( isset( $settings->ct_content_font_size_unit_responsive ) ) {

				$settings->ct_content_font_typo_responsive['font_size'] = array(
					'length' => $settings->ct_content_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->ct_content_font_size_unit_responsive );
			}
			if ( isset( $settings->ct_content_line_height_unit ) ) {

				$settings->ct_content_font_typo['line_height'] = array(
					'length' => $settings->ct_content_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->ct_content_line_height_unit );
			}
			if ( isset( $settings->ct_content_line_height_unit_medium ) ) {

				$settings->ct_content_font_typo_medium['line_height'] = array(
					'length' => $settings->ct_content_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->ct_content_line_height_unit_medium );
			}
			if ( isset( $settings->ct_content_line_height_unit_responsive ) ) {

				$settings->ct_content_font_typo_responsive['line_height'] = array(
					'length' => $settings->ct_content_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->ct_content_line_height_unit_responsive );
			}
			if ( isset( $settings->ct_transform ) ) {

				$settings->ct_content_font_typo['text_transform'] = $settings->ct_transform;
				unset( $settings->ct_transform );
			}
			if ( isset( $settings->ct_letter_spacing ) ) {

				$settings->ct_content_font_typo['letter_spacing'] = array(
					'length' => $settings->ct_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->ct_letter_spacing );
			}

			// For Text Font Typo.
			if ( ! isset( $settings->text_typo ) || ! is_array( $settings->text_typo ) ) {

				$settings->text_typo            = array();
				$settings->text_typo_medium     = array();
				$settings->text_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->text_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->text_typo['font_weight'] = 'normal';
					} else {
						$settings->text_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->text_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->text_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {

				$settings->text_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->text_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {

				$settings->text_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {

				$settings->text_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->text_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {

				$settings->text_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}

			// For Button Font Typo.
			if ( ! isset( $settings->btn_typo ) || ! is_array( $settings->btn_typo ) ) {

				$settings->btn_typo            = array();
				$settings->btn_typo_medium     = array();
				$settings->btn_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
			}
			if ( isset( $settings->btn_font_size_unit ) ) {

				$settings->btn_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {

				$settings->btn_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {

				$settings->btn_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->btn_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {

				$settings->btn_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {

				$settings->btn_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {
				$settings->btn_typo['text_btn_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->btn_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );

			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );

			$helper->handle_opacity_inputs( $settings, 'title_bg_color_opc', 'title_bg_color' );
			// For Title Typography.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {

				if ( isset( $settings->title_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
				if ( isset( $settings->title_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
			}

			if ( isset( $settings->title_font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Content Font Typo.
			if ( ! isset( $settings->ct_content_font_typo ) || ! is_array( $settings->ct_content_font_typo ) ) {

				$settings->ct_content_font_typo            = array();
				$settings->ct_content_font_typo_medium     = array();
				$settings->ct_content_font_typo_responsive = array();
			}
			if ( isset( $settings->ct_content_font_family ) ) {

				if ( isset( $settings->ct_content_font_family['family'] ) ) {
					$settings->ct_content_font_typo['font_family'] = $settings->ct_content_font_family['family'];
					unset( $settings->ct_content_font_family['family'] );
				}
				if ( isset( $settings->ct_content_font_family['weight'] ) ) {
					if ( 'regular' == $settings->ct_content_font_family['weight'] ) {
						$settings->ct_content_font_typo['font_weight'] = 'normal';
					} else {
						$settings->ct_content_font_typo['font_weight'] = $settings->ct_content_font_family['weight'];
					}
					unset( $settings->ct_content_font_family['weight'] );
				}
			}

			if ( isset( $settings->ct_content_font_size['small'] ) ) {
				$settings->ct_content_font_typo_responsive['font_size'] = array(
					'length' => $settings->ct_content_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->ct_content_font_size['medium'] ) ) {

				$settings->ct_content_font_typo_medium['font_size'] = array(
					'length' => $settings->ct_content_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->ct_content_font_size['desktop'] ) ) {
				$settings->ct_content_font_typo['font_size'] = array(
					'length' => $settings->ct_content_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->ct_content_line_height['small'] ) && isset( $settings->ct_content_font_size['small'] ) && 0 != $settings->ct_content_font_size['small'] ) {
				if ( is_numeric( $settings->ct_content_line_height['small'] ) && is_numeric( $settings->ct_content_font_size['small'] ) ) {
					$settings->ct_content_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->ct_content_line_height['small'] / $settings->ct_content_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->ct_content_line_height['medium'] ) && isset( $settings->ct_content_font_size['medium'] ) && 0 != $settings->ct_content_font_size['medium'] ) {
				if ( is_numeric( $settings->ct_content_line_height['medium'] ) && is_numeric( $settings->ct_content_font_size['medium'] ) ) {
					$settings->ct_content_font_typo_medium['line_height'] = array(
						'length' => round( $settings->ct_content_line_height['medium'] / $settings->ct_content_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->ct_content_line_height['desktop'] ) && isset( $settings->ct_content_font_size['desktop'] ) && 0 != $settings->ct_content_font_size['desktop'] ) {
				if ( is_numeric( $settings->ct_content_line_height['desktop'] ) && is_numeric( $settings->ct_content_font_size['desktop'] ) ) {
					$settings->ct_content_font_typo['line_height'] = array(
						'length' => round( $settings->ct_content_line_height['desktop'] / $settings->ct_content_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// For Text Font Typo.
			if ( ! isset( $settings->text_typo ) || ! is_array( $settings->text_typo ) ) {

				$settings->text_typo            = array();
				$settings->text_typo_medium     = array();
				$settings->text_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {
					$settings->text_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->text_typo['font_weight'] = 'normal';
					} else {
						$settings->text_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}

			if ( isset( $settings->font_size['small'] ) ) {
				$settings->text_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				$settings->text_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				$settings->text_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->text_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->text_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->text_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			// For Button Font Typo.
			if ( ! isset( $settings->btn_typo ) || ! is_array( $settings->btn_typo ) ) {

				$settings->btn_typo            = array();
				$settings->btn_typo_medium     = array();
				$settings->btn_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_typo['font_family'] = $settings->btn_font_family['family'];
					unset( $settings->btn_font_family['family'] );
				}
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
					unset( $settings->btn_font_family['weight'] );
				}
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				$settings->btn_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				$settings->btn_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				$settings->btn_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->title_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->title_spacing_dimension_top    = '';
				$settings->title_spacing_dimension_bottom = '';
				$settings->title_spacing_dimension_left   = '';
				$settings->title_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->title_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->title_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->title_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->title_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->title_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->title_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->title_spacing );
			}
			if ( isset( $settings->modal_spacing ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->modal_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->modal_spacing_dimension_top    = '';
				$settings->modal_spacing_dimension_bottom = '';
				$settings->modal_spacing_dimension_left   = '';
				$settings->modal_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->modal_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->modal_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->modal_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->modal_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->modal_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->modal_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->modal_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->modal_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->modal_spacing );
			}
			// Unset the old values.
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				unset( $settings->title_font_size['desktop'] );
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				unset( $settings->title_font_size['medium'] );
			}
			if ( isset( $settings->title_font_size['small'] ) ) {
				unset( $settings->title_font_size['small'] );
			}
			if ( isset( $settings->title_line_height['desktop'] ) ) {
				unset( $settings->title_line_height['desktop'] );
			}
			if ( isset( $settings->title_line_height['medium'] ) ) {
				unset( $settings->title_line_height['medium'] );
			}
			if ( isset( $settings->title_line_height['small'] ) ) {
				unset( $settings->title_line_height['small'] );
			}
			if ( isset( $settings->ct_content_font_size['desktop'] ) ) {
				unset( $settings->ct_content_font_size['desktop'] );
			}
			if ( isset( $settings->ct_content_font_size['medium'] ) ) {
				unset( $settings->ct_content_font_size['medium'] );
			}
			if ( isset( $settings->ct_content_font_size['small'] ) ) {
				unset( $settings->ct_content_font_size['small'] );
			}
			if ( isset( $settings->ct_content_line_height['desktop'] ) ) {
				unset( $settings->ct_content_line_height['desktop'] );
			}
			if ( isset( $settings->ct_content_line_height['medium'] ) ) {
				unset( $settings->ct_content_line_height['medium'] );
			}
			if ( isset( $settings->ct_content_line_height['small'] ) ) {
				unset( $settings->ct_content_line_height['small'] );
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				unset( $settings->font_size['desktop'] );
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				unset( $settings->font_size['medium'] );
			}
			if ( isset( $settings->font_size['small'] ) ) {
				unset( $settings->font_size['small'] );
			}
			if ( isset( $settings->line_height['desktop'] ) ) {
				unset( $settings->line_height['desktop'] );
			}
			if ( isset( $settings->line_height['medium'] ) ) {
				unset( $settings->line_height['medium'] );
			}
			if ( isset( $settings->line_height['small'] ) ) {
				unset( $settings->line_height['small'] );
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				unset( $settings->btn_font_size['desktop'] );
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				unset( $settings->btn_font_size['medium'] );
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				unset( $settings->btn_font_size['small'] );
			}
			if ( isset( $settings->btn_line_height['desktop'] ) ) {
				unset( $settings->btn_line_height['desktop'] );
			}
			if ( isset( $settings->btn_line_height['medium'] ) ) {
				unset( $settings->btn_line_height['medium'] );
			}
			if ( isset( $settings->btn_line_height['small'] ) ) {
				unset( $settings->btn_line_height['small'] );
			}
		}

		return $settings;
	}
}
$style1 = 'line-height: 1em; padding-bottom:5px;';
$style2 = 'line-height: 1em; padding-bottom:7px;';

$iframe_desc = sprintf( /* translators: %1$s: search term, %2$s: search term */
	__(
		'<div style="%2$s"> The related CSS and JS scripts will load on request.</div>
		<div style="%1$s">A loader will appear during loading of the iFrame.</div>', 'uabb'
	), $style1, $style2
);

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/modal-popup/modal-popup-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/modal-popup/modal-popup-bb-less-than-2-2-compatibility.php';
}
