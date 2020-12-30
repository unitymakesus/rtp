<?php
/**
 *  UABB Devices Module file
 *
 *  @package UABB Devices Module
 */

/**
 * Function that initializes UABB Devices Module
 *
 * @class UABBDevices
 */
class UABBDevices extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {

		parent::__construct(
			array(
				'name'            => __( 'Devices', 'uabb' ),
				'description'     => __( 'Devices Module', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-devices/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-devices/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'uabb-devices.svg',
			)
		);
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );
		$this->add_css( 'font-awesome-5' );
	}

	/**
	 * Function to get the icon for the Devices
	 *
	 * @since 1.27.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-devices/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-devices/icon/' . $icon );
		}
		return '';
	}

		/**
		 * Function that updates the settings
		 *
		 * @method update
		 * @param object $settings {object}.
		 */
	public function update( $settings ) {
		// Cache the photo data if using the WordPress media library.
		$settings->photo_data = $this->get_wordpress_photos();

		return $settings;
	}

		/**
		 * Function to get photos
		 *
		 * @method get_photos
		 */
	public function get_photos() {
		// WordPress.
		return $this->get_wordpress_photos();
	}

		/**
		 * Function to get WordPress photos
		 *
		 * @method get_wordpress_photos
		 */
	public function get_wordpress_photos() {
		$photos   = array();
		$ids      = $this->settings->photos;
		$medium_w = get_option( 'medium_size_w' );
		$large_w  = get_option( 'large_size_w' );

		if ( empty( $this->settings->photos ) ) {
			return $photos;
		}

		foreach ( $ids as $id ) {

			$photo = FLBuilderPhoto::get_attachment_data( $id );

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo ) {

				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				} elseif ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				} elseif ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				} else {
					continue;
				}
			}

			$data = new stdClass();

			// Only use photos who have the sizes object.
			if ( isset( $photo->sizes ) ) {

				// Photo data object.
				$data->id          = $id;
				$data->alt         = $photo->alt;
				$data->caption     = $photo->caption;
				$data->description = $photo->description;
				$data->title       = $photo->title;

				// Collage photo src.
				$photo_size = 'full';

				if ( -1 !== $id && '' !== $id ) {
					if ( isset( $photo_size ) ) {
						$temp      = wp_get_attachment_image_src( $id, $photo_size );
						$data->src = $temp[0];
					}
				}

				// Photo Link.
				if ( isset( $photo->sizes->large ) ) {
					$data->link = $photo->sizes->large->url;
				} else {
					$data->link = $photo->sizes->full->url;
				}

				// Push the photo data.
				$photos[ $id ] = $data;
			}

			/* Add Custom field attachment data to object */
			$cta_link       = get_post_meta( $id, 'uabb-cta-link', true );
			$data->cta_link = $cta_link;
		}

		return $photos;
	}
}

$notice = '';
if ( ! UABB_Compatibility::$version_bb_check ) {
	$style  = 'line-height: 1.45em; color: #a94442;';
	$notice = sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
		__( '<span style="%1$s">This module is not compatible with Beaver Builder version less than 2.2. To use the module, please install Beaver Builder version 2.2 or greater.</span>', 'uabb' ),
		$style
	);
}

$style1 = 'line-height: 1em; padding-bottom:5px;';
$style2 = 'line-height: 1em; padding-bottom:7px;';

$iframe_desc = sprintf( /* translators: %1$s: search term, %2$s: search term */
	__(
		'<div style="%2$s"> The related CSS and JS scripts will load on request.</div>
		<div style="%1$s">A loader will appear during loading of the iFrame.</div>',
		'uabb'
	),
	$style1,
	$style2
);

/*
 * Register the module and its form settings.
 *
 */

FLBuilder::register_module(
	'UABBDevices',
	array(
		'general' => array(
			'title'       => __( 'General', 'uabb' ),
			'description' => $notice,
			'sections'    => array(
				'device'         => array(
					'title'  => 'Device',
					'fields' => array(
						'device_type'         => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'phone',
							'options' => array(
								'phone'   => __( 'Phone', 'uabb' ),
								'tablet'  => __( 'Tablet', 'uabb' ),
								'laptop'  => __( 'Laptop', 'uabb' ),
								'desktop' => __( 'Desktop', 'uabb' ),
								'window'  => __( 'Window', 'uabb' ),
							),
							'toggle'  => array(
								'phone'   => array(
									'fields' => array( 'orientation', 'orientation_control', 'scroll_on_hover', 'vertical_alignment', 'device_control' ),
								),
								'tablet'  => array(
									'fields' => array( 'orientation', 'orientation_control', 'scroll_on_hover', 'vertical_alignment', 'device_control' ),
								),
								'laptop'  => array(
									'fields' => array( 'scroll_on_hover', 'vertical_alignment' ),
								),
								'desktop' => array(
									'fields' => array( 'scroll_on_hover', 'vertical_alignment', 'device_control' ),
								),
								'window'  => array(
									'fields' => array( 'scroll_on_hover', 'vertical_alignment' ),
								),
							),
						),
						'media_type'          => array(
							'type'    => 'select',
							'label'   => __( 'Media Type', 'uabb' ),
							'default' => 'image',
							'options' => array(
								'image'  => __( 'Image', 'uabb' ),
								'video'  => __( 'Video', 'uabb' ),
								'slider' => __( 'Image Slider', 'uabb' ),
								'iframe' => __( 'Iframe', 'uabb' ),
							),
							'toggle'  => array(
								'image'  => array(
									'sections' => array( 'image' ),
								),
								'video'  => array(
									'sections' => array( 'video', 'video_options', 'video_overlay' ),
									'fields'   => array( 'aspect_ratio', 'video_src' ),
								),
								'slider' => array(
									'sections' => array( 'image_slider' ),
								),
								'iframe' => array(
									'sections' => array( 'iframe_setting' ),
								),
							),
						),
						'orientation'         => array(
							'type'    => 'select',
							'label'   => __( 'Orientation', 'uabb' ),
							'default' => 'portrait',
							'options' => array(
								'portrait'  => __( 'Portrait', 'uabb' ),
								'landscape' => __( 'Landscape', 'uabb' ),
							),
						),
						'orientation_control' => array(
							'type'    => 'select',
							'label'   => __( 'Orientation Control', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'show' => __( 'Show', 'uabb' ),
								'hide' => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'show' => array(
									'fields' => array( 'orientation_control_color', 'orientation_hover_color', 'orientation_control_size' ),
								),
							),
							'help'    => __( 'Adds control to switch between Portrait and Landscape mode on frontend.', 'uabb' ),

						),
						'device_control'      => array(
							'type'    => 'select',
							'label'   => __( 'Device Control', 'uabb' ),
							'default' => 'hide',
							'options' => array(
								'show' => __( 'Show', 'uabb' ),
								'hide' => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'show' => array(
									'fields' => array( 'device_control_color', 'device_control_hover_color', 'device_control_active_color', 'device_control_size' ),
								),
							),
							'help'    => __( 'Adds control to switch between Phone, Tablet and Desktop devices on frontend.', 'uabb' ),

						),
						'alignment'           => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
							'preview'    => array(
								'type'     => 'refresh',
								'selector' => '.uabb-devices-wrapper',
								'property' => 'text-align',
							),
						),
						'max_width'           => array(
							'type'         => 'unit',
							'label'        => __( 'Maximum Width', 'uabb' ),
							'units'        => array( '%', 'px' ),
							'default_unit' => '%',
							'slider'       => true,
							'preview'      => array(
								'type'     => 'refresh',
								'property' => 'width',
								'selector' => '.uabb-device-wrap',
							),
							'responsive'   => 'true',
						),
					),
				),
				'image'          => array(
					'title'  => 'Image',
					'fields' => array(
						'image'               => array(
							'type'        => 'photo',
							'label'       => __( 'Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'image_fit'           => array(
							'type'    => 'select',
							'label'   => __( 'Fit Type', 'uabb' ),
							'default' => 'cover',
							'options' => array(
								'cover'   => __( 'Cover', 'uabb' ),
								'contain' => __( 'Contain', 'uabb' ),
								'auto'    => __( 'Auto', 'uabb' ),
							),
						),
						'scroll_on_hover'     => array(
							'type'    => 'select',
							'label'   => __( 'Scroll On Hover', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'fields' => array( 'vertical_alignment' ),
								),
								'yes' => array(
									'fields' => array( 'transition_duration' ),
								),
							),
						),
						'transition_duration' => array(
							'type'    => 'unit',
							'label'   => __( 'Transition Duration', 'uabb' ),
							'default' => 3,
							'slider'  => array(
								'min'  => 1,
								'max'  => 10,
								'step' => 1,
							),
							'units'   => array( 'seconds' ),
							'help'    => __( 'Specify Transition Duration (in seconds)', 'uabb' ),
						),
						'vertical_alignment'  => array(
							'type'    => 'select',
							'label'   => __( 'Vertical Alignment', 'uabb' ),
							'default' => 'middle',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'center' => __( 'Middle', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'top_offset' ),
								),
							),

						),
						'top_offset'          => array(
							'type'         => 'unit',
							'label'        => __( 'Top Offset', 'uabb' ),
							'units'        => array( '%' ),
							'default_unit' => '%',
							'slider'       => true,
							'preview'      => array(
								'type'     => 'css',
								'selector' => '.uabb-device-media-screen',
								'property' => 'top',
							),
						),
					),
				),
				'video'          => array(
					'title'  => 'Video',
					'fields' => array(
						'video_src'         => array(
							'type'    => 'select',
							'label'   => __( 'Video Source', 'uabb' ),
							'default' => 'youtube',
							'options' => array(
								'youtube'     => __( 'Youtube', 'uabb' ),
								'vimeo'       => __( 'Vimeo', 'uabb' ),
								'wistia'      => __( 'Wistia', 'uabb' ),
								'self_hosted' => __( 'Self Hosted / URL', 'uabb' ),
							),
							'toggle'  => array(
								'youtube'     => array(
									'fields' => array( 'yt_autoplay', 'youtube_url', 'controls', 'start_time', 'end_time', 'modestbranding', 'yt_privacy', 'rel', 'yt_mute' ),
								),
								'vimeo'       => array(
									'fields' => array( 'vimeo_autoplay', 'start_time', 'vimeo_url', 'vimeo_loop', 'vimeo_title', 'vimeo_portrait', 'vimeo_byline' ),
								),
								'wistia'      => array(
									'fields' => array( 'wistia_autoplay', 'wistia_url', 'wistia_playbar', 'wistia_loop', 'wistia_mute' ),
								),
								'self_hosted' => array(
									'sections' => array( 'display', 'volume', 'video_interface', 'video_buttons' ),
									'fields'   => array( 'mute', 'auto_play', 'video_type', 'loop', 'stop_others', 'restart_on_pause', 'end_at_last_frame', 'playback_speed', 'button_spacing' ),
								),
							),
						),
						'youtube_url'       => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'placeholder' => __( 'Enter YouTube URL', 'uabb' ),
							'default'     => 'https://www.youtube.com/watch?v=HJRzUQMhJMQ',
							'connections' => array( 'url' ),
						),
						'vimeo_url'         => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'placeholder' => __( 'Enter Viemo URL', 'uabb' ),
							'default'     => 'https://vimeo.com/274860274',
							'connections' => array( 'url' ),
						),
						'wistia_url'        => array(
							'type'        => 'text',
							'label'       => __( 'Link', 'uabb' ),
							'placeholder' => __( 'Enter Wistia URL', 'uabb' ),
							'default'     => '<p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2"><img src="https://embedwistia-a.akamaihd.net/deliveries/53eec5fa72737e60aa36731b57b607a7c0636f52.webp?image_play_button_size=2x&amp;image_crop_resized=960x540&amp;image_play_button=1&amp;image_play_button_color=54bbffe0" width="400" height="225" style="width: 400px; height: 225px;"></a></p><p><a href="https://pratikc.wistia.com/medias/gyvkfithw2?wvideo=gyvkfithw2">Video Placeholder - Brainstorm Force - pratikc</a></p>',
							'connections' => array( 'url' ),
						),
						'aspect_ratio'      => array(
							'type'    => 'select',
							'label'   => __( 'Aspect Ratio', 'uabb' ),
							'default' => '1_1',
							'options' => array(
								'16_9' => __( '16:9', 'uabb' ),
								'4_3'  => __( '4:3', 'uabb' ),
								'3_2'  => __( '3:2', 'uabb' ),
								'1_1'  => __( '1:1', 'uabb' ),
							),
						),
						'video_type'        => array(
							'type'    => 'select',
							'label'   => __( 'Video Type', 'uabb' ),
							'default' => 'mp4',
							'options' => array(
								'mp4'  => __( 'MP4', 'uabb' ),
								'm4v'  => __( 'M4V', 'uabb' ),
								'ogg'  => __( 'OGG', 'uabb' ),
								'webm' => __( 'WEBM', 'uabb' ),
							),
							'toggle'  => array(
								'mp4'  => array(
									'fields' => array( 'mp4_video_source' ),
								),
								'm4v'  => array(
									'fields' => array( 'm4v_video_source' ),
								),
								'ogg'  => array(
									'fields' => array( 'ogg_video_source' ),
								),
								'webm' => array(
									'fields' => array( 'webm_video_source' ),
								),
							),
						),
						'mp4_video_source'  => array(
							'type'    => 'select',
							'label'   => __( 'Video Source', 'uabb' ),
							'default' => 'url',
							'options' => array(
								'file' => __( 'File', 'uabb' ),
								'url'  => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'file' => array(
									'fields' => array( 'mp4_video' ),
								),
								'url'  => array(
									'fields' => array( 'mp4_video_url' ),
								),
							),
						),
						'mp4_video_url'     => array(
							'type'        => 'link',
							'label'       => __( 'URL', 'uabb' ),
							'connections' => array( 'url' ),
						),
						'mp4_video'         => array(
							'type'  => 'video',
							'label' => __( 'Video Source', 'uabb' ),
						),
						'm4v_video_source'  => array(
							'type'    => 'select',
							'label'   => __( 'Video Source', 'uabb' ),
							'default' => 'url',
							'options' => array(
								'file' => __( 'File', 'uabb' ),
								'url'  => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'file' => array(
									'fields' => array( 'm4v_video' ),
								),
								'url'  => array(
									'fields' => array( 'm4v_video_url' ),
								),
							),
						),
						'm4v_video_url'     => array(
							'type'        => 'link',
							'label'       => __( 'URL', 'uabb' ),
							'connections' => array( 'url' ),
						),
						'm4v_video'         => array(
							'type'  => 'video',
							'label' => __( 'Video Source', 'uabb' ),
						),
						'ogg_video_source'  => array(
							'type'    => 'select',
							'label'   => __( 'Video Source', 'uabb' ),
							'default' => 'url',
							'options' => array(
								'file' => __( 'File', 'uabb' ),
								'url'  => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'file' => array(
									'fields' => array( 'ogg_video' ),
								),
								'url'  => array(
									'fields' => array( 'ogg_video_url' ),
								),
							),
						),
						'ogg_video_url'     => array(
							'type'        => 'link',
							'label'       => __( 'URL', 'uabb' ),
							'connections' => array( 'url' ),
						),
						'ogg_video'         => array(
							'type'  => 'video',
							'label' => __( 'Video Source', 'uabb' ),
						),
						'webm_video_source' => array(
							'type'    => 'select',
							'label'   => __( 'Video Source', 'uabb' ),
							'default' => 'url',
							'options' => array(
								'file' => __( 'File', 'uabb' ),
								'url'  => __( 'URL', 'uabb' ),
							),
							'toggle'  => array(
								'file' => array(
									'fields' => array( 'webm_video' ),
								),
								'url'  => array(
									'fields' => array( 'webm_video_url' ),
								),
							),
						),
						'webm_video_url'    => array(
							'type'        => 'link',
							'label'       => __( 'URL', 'uabb' ),
							'connections' => array( 'url' ),
						),
						'webm_video'        => array(
							'type'  => 'video',
							'label' => __( 'Video Source', 'uabb' ),
						),
					),
				),
				'video_options'  => array(
					'title'  => 'Video Options',
					'fields' => array(
						'auto_play'         => array(
							'type'    => 'select',
							'label'   => __( 'Auto Play', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'yt_autoplay'       => array(
							'type'    => 'select',
							'label'   => __( 'Auto Play', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'vimeo_autoplay'    => array(
							'type'    => 'select',
							'label'   => __( 'Auto Play', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'wistia_autoplay'   => array(
							'type'    => 'select',
							'label'   => __( 'Auto Play', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'mute'              => array(
							'type'    => 'select',
							'label'   => __( 'Mute', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'yt_mute'           => array(
							'type'    => 'select',
							'label'   => __( 'Mute', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'wistia_mute'       => array(
							'type'    => 'select',
							'label'   => __( 'Mute', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'loop'              => array(
							'type'    => 'select',
							'label'   => __( 'Loop', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'vimeo_loop'        => array(
							'type'    => 'select',
							'label'   => __( 'Loop', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'wistia_loop'       => array(
							'type'    => 'select',
							'label'   => __( 'Loop', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'controls'          => array(
							'type'    => 'select',
							'label'   => __( 'Controls', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'start_time'        => array(
							'type'   => 'unit',
							'label'  => __( 'Start Time', 'uabb' ),
							'slider' => true,
							'units'  => array( 'seconds' ),
							'help'   => __( 'Specify start time (in seconds)', 'uabb' ),
						),
						'end_time'          => array(
							'type'   => 'unit',
							'label'  => __( 'End Time', 'uabb' ),
							'slider' => true,
							'units'  => array( 'seconds' ),
							'help'   => __( 'Specify end time (in seconds)', 'uabb' ),
						),
						'modestbranding'    => array(
							'type'    => 'select',
							'label'   => __( 'Modest Branding', 'uabb' ),
							'help'    => __( 'This option lets you use a YouTube player that does not show a YouTube logo.', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'yt_privacy'        => array(
							'type'    => 'select',
							'label'   => __( 'Privacy Mode', 'uabb' ),
							'help'    => __( "When you turn on privacy mode, YouTube won't store information about visitors on your website unless they play the video.", 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'rel'               => array(
							'type'    => 'select',
							'label'   => __( 'Suggested Video', 'uabb' ),
							'options' => array(
								'no'  => __( 'Current Video Channel', 'uabb' ),
								'yes' => __( 'Any Video', 'uabb' ),
							),
						),
						'vimeo_title'       => array(
							'type'    => 'select',
							'label'   => __( 'Intro Title', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'vimeo_portrait'    => array(
							'type'    => 'select',
							'label'   => __( 'Intro Portrait', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
						'vimeo_byline'      => array(
							'type'    => 'select',
							'label'   => __( 'Intro Byline', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						), // till here for embedded url.
						'stop_others'       => array(
							'type'    => 'select',
							'label'   => __( 'Stop Others', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'Stop all other videos on page when this video is played.', 'uabb' ),
						),
						'restart_on_pause'  => array(
							'type'    => 'select',
							'label'   => __( 'Restart On Pause', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),

						'end_at_last_frame' => array(
							'type'    => 'select',
							'label'   => __( 'End at last frame', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'End the video at the last frame instead of showing the first one.', 'uabb' ),
						),
						'playback_speed'    => array(
							'type'    => 'unit',
							'label'   => __( 'Playback Speed', 'uabb' ),
							'default' => '1',
							'slider'  => array(
								'min'  => 0.1,
								'max'  => 5,
								'step' => 0.01,
							),
						),
						'wistia_playbar'    => array(
							'type'    => 'select',
							'label'   => __( 'Show Playbar', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'yes' => __( 'Show', 'uabb' ),
								'no'  => __( 'Hide', 'uabb' ),
							),
						),
					),
				),
				'image_slider'   => array(
					'title'  => 'Image Slider',
					'fields' => array(
						'photos'          => array(
							'type'        => 'multiple-photos',
							'label'       => __( 'Photos', 'uabb' ),
							'connections' => array( 'multiple-photos' ),
						),
						'autoplay_slider' => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'infinite_loop'   => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'enable_arrows'   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Arrows', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'sections' => array( 'arrow_section' ),
								),
							),
						),
					),
				),
				'arrow_section'  => array(
					'title'  => '',
					'fields' => array(
						'arrow_style'                => array(
							'type'    => 'select',
							'label'   => __( 'Arrow Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'square'        => __( 'Square Background', 'uabb' ),
								'circle'        => __( 'Circle Background', 'uabb' ),
								'square-border' => __( 'Square Border', 'uabb' ),
								'circle-border' => __( 'Circle Border', 'uabb' ),
							),
							'toggle'  => array(
								'square-border' => array(
									'fields' => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' ),
								),
								'circle-border' => array(
									'fields' => array( 'arrow_color', 'arrow_color_border', 'arrow_border_size' ),
								),
								'square'        => array(
									'fields' => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' ),
								),
								'circle'        => array(
									'fields' => array( 'arrow_color', 'arrow_background_color', 'arrow_background_color_opc' ),
								),
							),
						),
						'arrow_color'                => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.slick-prev i, .slick-next i',
								'property' => 'color',
							),
						),
						'arrow_background_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.slick-prev i, .slick-next i',
								'property' => 'background',
							),
						),
						'arrow_background_color_opc' => array(
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'units'     => array( '%' ),
							'maxlength' => '3',
							'size'      => '5',
							'slider'    => array(
								'%' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'arrow_color_border'         => array(
							'type'        => 'color',
							'label'       => __( 'Arrow Border Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
						),
						'arrow_border_size'          => array(
							'type'       => 'unit',
							'label'      => __( 'Border Size', 'uabb' ),
							'default'    => '1',
							'units'      => array( 'px' ),
							'size'       => '8',
							'max_lenght' => '3',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
					),
				),
				'display'        => array(
					'title'  => 'Display',
					'fields' => array(
						'show_buttons'    => array(
							'type'    => 'select',
							'label'   => __( 'Show Buttons', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_bar'        => array(
							'type'    => 'select',
							'label'   => __( 'Show Bar', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_rewind'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Rewind', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_time'       => array(
							'type'    => 'select',
							'label'   => __( 'Show Time', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_progress'   => array(
							'type'    => 'select',
							'label'   => __( 'Show Progress', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_duration'   => array(
							'type'    => 'select',
							'label'   => __( 'Show Duration', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_fullscreen' => array(
							'type'    => 'select',
							'label'   => __( 'Show Fullscreen', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'volume'         => array(
					'title'  => 'Volume',
					'fields' => array(
						'show_volume'      => array(
							'type'    => 'select',
							'label'   => __( 'Show Volume', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'show_volume_icon', 'show_volume_bar' ),
								),
								'no'  => array(
									'fields' => array( '' ),
								),
							),
						),
						'show_volume_icon' => array(
							'type'    => 'select',
							'label'   => __( 'Show Volume Icon', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_volume_bar'  => array(
							'type'    => 'select',
							'label'   => __( 'Show Volume Bar', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'initial_volume'   => array(
							'type'    => 'unit',
							'label'   => __( 'Initial Volume', 'uabb' ),
							'default' => '.8',
							'slider'  => array(
								'min'  => 0,
								'max'  => 1,
								'step' => 0.01,
							),
						),
					),
				),
				'iframe_setting' => array( // Section.
					'title'  => __( 'iFrame Setting', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'iframe_url'    => array(
							'type'        => 'text',
							'label'       => __( 'URL', 'uabb' ),
							'connections' => array( 'url' ),
						),
						'iframe_height' => array(
							'type'        => 'unit',
							'label'       => __( 'Height of iFrame', 'uabb' ),
							'default'     => '360',
							'placeholder' => 'auto',
							'maxlength'   => '6',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'help'        => __( 'Keep this empty for auto', 'uabb' ),
						),
						'async_iframe'  => array(
							'type'        => 'select',
							'label'       => __( 'Async iFrame Load', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'        => __( 'Enabling this option will reduce the page size and page loading time. ', 'uabb' ),
							'description' => $iframe_desc,
						),
					),
				),
			),
		),
		'style'   => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'device'          => array( // Section.
					'title'  => __( 'Device', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'style'                       => array(
							'type'    => 'select',
							'label'   => __( 'Choose Skin', 'uabb' ),
							'default' => 'black',
							'options' => array(
								'black'      => __( 'Black', 'uabb' ),
								'silver'     => __( 'Silver', 'uabb' ),
								'white'      => __( 'White', 'uabb' ),
								'rose_gold'  => __( 'Rose Gold', 'uabb' ),
								'gold'       => __( 'Gold', 'uabb' ),
								'space_grey' => __( 'Space Grey', 'uabb' ),
							),
						),
						'orientation_control_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Orientation Control Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-device-orientation .fa-mobile',
							),
							'connections' => array( 'color' ),
						),
						'orientation_hover_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Orientation Control Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'color' ),
						),
						'orientation_control_size'    => array(
							'type'       => 'unit',
							'label'      => __( 'Orientation Control Size', 'uabb' ),
							'units'      => array( 'px' ),
							'default'    => '28',
							'slider'     => array(
								'min'  => 20,
								'max'  => 100,
								'step' => 1,
							),
							'responsive' => true,
						),
						'device_control_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Device Control Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-device-switch-control i',
							),
							'connections' => array( 'color' ),
						),
						'device_control_hover_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Device Control Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type' => 'none',
							),
							'connections' => array( 'color' ),
						),
						'device_control_active_color' => array(
							'type'        => 'color',
							'label'       => __( 'Device Control Active Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-device-switch-control i.active',
							),
							'connections' => array( 'color' ),
						),
						'device_control_size'         => array(
							'type'       => 'unit',
							'label'      => __( 'Device Control Size', 'uabb' ),
							'units'      => array( 'px' ),
							'default'    => '28',
							'slider'     => array(
								'min'  => 20,
								'max'  => 100,
								'step' => 1,
							),
							'responsive' => true,
						),

					),
				),
				'video_overlay'   => array( // Section.
					'title'  => __( 'Video Overlay', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'video_overlay'      => array(
							'type'    => 'select',
							'label'   => __( 'Overlay Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'             => __( 'None', 'uabb' ),
								'image'            => __( 'Image', 'uabb' ),
								'b_color'          => __( 'Color', 'uabb' ),
								'both_image_color' => __( 'Both Image and Color', 'uabb' ),
							),
							'toggle'  => array(
								'image'            => array(
									'fields' => array( 'embed_cover_image', 'overlay_opacity' ),
								),
								'b_color'          => array(
									'fields' => array( 'overlay_background', 'overlay_opacity' ),
								),
								'both_image_color' => array(
									'fields' => array( 'embed_cover_image', 'overlay_background', 'overlay_opacity' ),
								),
							),
						),
						'embed_cover_image'  => array(
							'type'        => 'photo',
							'label'       => __( 'Overlay Image', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'overlay_background' => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'     => 'refresh',
								'property' => 'background-color',
								'selector' => '.uabb-devices-content .uabb-video-player-cover.uabb-player-cover:after',
							),
							'connections' => array( 'color' ),
						),
						'overlay_opacity'    => array(
							'type'    => 'unit',
							'label'   => __( 'Opacity', 'uabb' ),
							'slider'  => array(
								'min'  => 0,
								'max'  => 1,
								'step' => 0.01,
							),
							'preview' => array(
								'type'     => 'css',
								'property' => 'opacity',
								'selector' => '.uabb-video-player-cover.uabb-player-cover',
							),
							'help'    => __( 'Select value between 0 and 1.', 'uabb' ),
						),

					),
				),
				'video_interface' => array( // Section.
					'title'  => __( 'Video Interface', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'controls_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Controls Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'color',
										'selector' => '.uabb-video-button, .uabb-player-controls-bar',
									),
									array(
										'property' => 'background',
										'selector' => '.uabb-player-control-progress-inner, .uabb-player-control-progress-outer',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'controls_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Controls Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'background',
										'selector' => '.uabb-video-button, .uabb-player-controls-bar',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'controls_opacity'        => array(
							'type'    => 'unit',
							'label'   => __( 'Controls Opacity', 'uabb' ),
							'slider'  => array(
								'min'  => 0,
								'max'  => 1,
								'step' => 0.01,
							),
							'preview' => array(
								'type'     => 'css',
								'property' => 'opacity',
								'selector' => '.uabb-player-controls-bar, .uabb-video-button',
							),
							'help'    => __( 'Select value between 0 and 1.', 'uabb' ),
						),
						'hover_controls_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Hover Controls Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'color',
										'selector' => '.uabb-video-button:hover, .uabb-player-controls-bar:hover',
									),
									array(
										'property' => 'background',
										'selector' => '.uabb-player-control-progress-inner:hover, .uabb-player-control-progress-outer:hover',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'hover_controls_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Hover Controls Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'background',
										'selector' => '.uabb-video-button:hover, .uabb-player-controls-bar:hover',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'hover_controls_opacity'  => array(
							'type'    => 'unit',
							'label'   => __( 'Hover Controls Opacity', 'uabb' ),
							'slider'  => array(
								'min'  => 0,
								'max'  => 1,
								'step' => 0.01,
							),
							'preview' => array(
								'type'     => 'css',
								'property' => 'opacity',
								'selector' => '.uabb-player-controls-bar:hover, .uabb-video-button:hover',
							),
							'help'    => __( 'Select value between 0 and 1.', 'uabb' ),
						),
						'bar_border_radius'       => array(
							'type'    => 'unit',
							'label'   => __( 'Progress Bar Border Radius', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => true,
							'preview' => array(
								'type'     => 'css',
								'property' => 'border-radius',
								'selector' => '.uabb-player-controls-bar .uabb-player-control-progress-outer, .uabb-player-controls-bar .uabb-player-control-progress-inner',
								'unit'     => 'px',
							),
						),

					),
				),
				'video_buttons'   => array( // Section.
					'title'       => __( 'Video Buttons', 'uabb' ), // Section Title.
					'description' => __( 'Select Overlay image for Youtube, Vimeo, Wistia', 'uabb' ),
					'fields'      => array( // Section Fields.
						'button_size'                    => array(
							'type'       => 'unit',
							'label'      => __( 'Size', 'uabb' ),
							'slider'     => array(
								'min'  => 20,
								'max'  => 50,
								'step' => 1,
							),
							'responsive' => true,
						),
						'button_controls_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'color',
										'selector' => '.uabb-video-button',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'button_controls_bg_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'background',
										'selector' => '.uabb-video-button',
									),
								),
							),
							'connections' => array( 'color' ),
						),
						'hover_button_controls_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Hover Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
						'hover_button_controls_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Hover Background Color', 'uabb' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'connections' => array( 'color' ),
						),
						'button_border'                  => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video-button',
							),
						),
						'hover_button_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Hover Border', 'uabb' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-video-button:hover',
							),
						),
						'button_spacing'                 => array(
							'type'       => 'unit',
							'label'      => __( 'Spacing', 'uabb' ),
							'default'    => 3,
							'slider'     => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'responsive' => true,
							'preview'    => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'margin-left',
										'selector' => '.uabb-video-button',
										'unit'     => 'px',
									),
									array(
										'property' => 'margin-right',
										'selector' => '.uabb-video-button',
										'unit'     => 'px',
									),
								),
							),
						),
						'button_padding'                 => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'default'     => 10,
							'unit'        => 'px',
							'slider'      => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'property' => 'padding',
										'selector' => '.uabb-video-button',
										'unit'     => 'px',
									),
								),
							),
							'responsive'  => true,
						),
					),
				),
			),
		),

	)
);
