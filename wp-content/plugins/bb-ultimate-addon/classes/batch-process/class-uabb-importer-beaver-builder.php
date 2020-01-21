<?php
/**
 * Beaver Builder Importer
 *
 * @package UABB
 * @since 1.20.2
 */

if ( ! class_exists( 'UABB_Importer_Beaver_Builder' ) ) :

	/**
	 * UABB Import Beaver Builder
	 *
	 * @since 1.20.2
	 */
	class UABB_Importer_Beaver_Builder {

		/**
		 * Instance
		 *
		 * @since 1.20.2
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.20.2
		 * @return object initialized object of class.
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.20.2
		 */
		public function __construct() {
		}

		/**
		 * Update post meta.
		 *
		 * @since 1.20.2
		 * @param  integer $post_id Post ID.
		 * @return void
		 */
		public function import_single_post( $post_id = 0 ) {

			error_log( 'Start Processing Post .. ' . $post_id );

			$data = get_post_meta( $post_id, '_fl_builder_data', true );

			if ( ! empty( $data ) ) {

				$data = $this->get_import_data( $data );

				$after_hot_links_count = $this->check_hot_links( $data, 'after' );

				error_log( 'After Hot link count.....' );

				error_log( print_r( $after_hot_links_count, true ) );

				$this->failds_hot_links_posts( $after_hot_links_count, $post_id );

				error_log( 'Processing Completed Post... ' . $post_id );

				// Update page builder data.
				update_post_meta( $post_id, '_fl_builder_data', $data );
				update_post_meta( $post_id, '_fl_builder_draft', $data );

				// Clear the asset cache.
				FLBuilderModel::delete_all_asset_cache( $post_id );

				update_post_meta( $post_id, 'uabb_batch_complete_time', date( 'Y-m-d H:i:s' ) );

			} else {
				error_log( '(✕) Not have "Beaver Builder" Data. Post meta _fl_builder_data is empty!' );
			}
		}
		/**
		 * Update post meta.
		 *
		 * @since 1.20.2
		 * @param  array  $after_hot_links_count after processing hot link count.
		 * @param  string $post_id Faild post ID.
		 */
		public function failds_hot_links_posts( $after_hot_links_count, $post_id ) {

			if ( 0 !== $after_hot_links_count ) {

				$faild_posts_id = array();

				$faild_posts_id = get_option( 'uabb_batch_processing_faild_posts_id', array() );

				array_push( $faild_posts_id, $post_id );

				$faild_posts_id = array_unique( $faild_posts_id );

				update_option( 'uabb_batch_processing_faild_posts_id', $faild_posts_id );

			} else {

				$faild_posts_id = get_option( 'uabb_batch_processing_faild_posts_id', array() );

				if ( ! empty( $faild_posts_id ) && in_array( $post_id, $faild_posts_id ) ) {  // @codingStandardsIgnoreLine.

					//$key = array_keys( $faild_posts_id, $post_id );  // @codingStandardsIgnoreLine.

					foreach ( array_keys( $faild_posts_id, $post_id ) as $key ) {  // @codingStandardsIgnoreLine.
						unset( $faild_posts_id[ $key ] );
					}
					update_option( 'uabb_batch_processing_faild_posts_id', $faild_posts_id );
				}
			}
		}
		/**
		 * Check Hot link after posts processing.
		 *
		 * @since 1.20.2
		 * @param  array  $data Page builder data after processing.
		 * @param  string $message display message.
		 * @return mixed
		 */
		public function check_hot_links( $data, $message ) {

			$all_links = array();

			$iterator_data = new RecursiveIteratorIterator( new RecursiveArrayIterator( $data ) );

			foreach ( $iterator_data as $iterator_data_value ) {

				if ( substr( $iterator_data_value, 0, 4 ) === 'http' || substr( $iterator_data_value, 0, 4 ) === 'https' ) {
					$all_links[] = $iterator_data_value;
				}
			}

			$hot_link_count = 0;

			$image_links = array();

			$image_map = array();

			foreach ( $all_links as $key => $link ) {

				if ( preg_match( '/\.(jpg|jpeg|png|gif)/i', $link ) ) {

					$hot_link = $this->check_included_domains( $link );

					if ( true === $hot_link ) {

						$hot_link_count = $hot_link_count + 1;
					}
				}
			}

			return $hot_link_count;
		}
		/**
		 * Check Included Domains.
		 *
		 * @since 1.20.2
		 * @param  string $link    Hot link.
		 * @return mixed
		 */
		public function check_included_domains( $link ) {

			static $hot_link_count = 0;

			$included_domains = array(
				'sharkz.in',
				'brainstormforce',
				'templates.ultimatebeaver.com',
				'downloads.brainstormforce.com',
				'uabbtemplates2.sharkz.in',
				'uabb.sharkz.in',
			);

			foreach ( $included_domains as $key => $domain ) {

				if ( false !== strpos( $link, $domain ) ) {
					return true;
				}
			}

			return false;
		}
		/**
		 * Update post meta.
		 *
		 * @since 1.20.2
		 * @param  array $data    Page builder data.
		 * @return mixed
		 */
		public function get_import_data( $data ) {

			if ( empty( $data ) ) {
				return array();
			}

			foreach ( $data as $key => $el ) {

				// Import 'row' images.
				if ( 'row' === $el->type ) {
					$data[ $key ]->settings = self::import_row_images( $el->settings );
				}

				// Import 'module' images.
				if ( 'module' === $el->type ) {
					$data[ $key ]->settings = self::import_module_images( $el->settings );
				}

				// Import 'column' images.
				if ( 'column' === $el->type ) {
					$data[ $key ]->settings = self::import_column_images( $el->settings );
				}
			}

			return $data;
		}

		/**
		 * Import Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_module_images( $settings ) {

			switch ( $settings->type ) {
				case 'info-banner':
					$settings = self::import_info_banner( $settings );
					break;
				case 'flip-box':
					$settings = self::import_flip_box( $settings );
					break;
				case 'interactive-banner-1':
					$settings = self::import_interactive_banner( $settings );
					break;
				case 'interactive-banner-2':
					$settings = self::import_interactive_banner( $settings );
					break;
				case 'dual-button':
					$settings = self::import_dual_button( $settings );
					break;
				case 'uabb-beforeafterslider':
					$settings = self::import_uabb_before_after_slider( $settings );
					break;
				case 'progress-bar':
					$settings = self::import_progress_bar( $settings );
					break;
				case 'uabb-contact-form':
					$settings = self::import_uabb_contact_form( $settings );
					break;
				case 'uabb-contact-form7':
					$settings = self::import_uabb_contact_form( $settings );
					break;
				case 'uabb-gravity-form':
					$settings = self::import_uabb_contact_form( $settings );
					break;
				case 'photo-gallery':
					$settings = self::import_photo_gallery( $settings );
					break;
				case 'adv-testimonials':
					$settings = self::import_adv_testimonials( $settings );
					break;
				case 'google-map':
					$settings = self::import_google_map( $settings );
					break;
				case 'info-circle':
					$settings = self::import_info_circle( $settings );
					break;
				case 'video':
					$settings = self::import_video( $settings );
					break;
				case 'ihover':
					$settings = self::import_uabb_ihover( $settings );
					break;
				case 'info-list':
					$settings = self::import_info_list( $settings );
					break;
				default:
					$settings = self::import_photo( $settings );
					break;
			}

			/**
			 * 2) Set `$settings->data` for Only type 'image-icon'
			 *
			 * @todo Remove the condition `'image-icon' === $settings->type` if `$settings->data` is used only for the Image Icon.
			 */
			if (
			isset( $settings->data ) &&
			isset( $settings->photo ) && ! empty( $settings->photo ) &&
			'image-icon' === $settings->type
			) {
				$settings->data = FLBuilderPhoto::get_attachment_data( $settings->photo );
			}

			/**
			 * 3) Set `list item` module images.
			 */
			if ( isset( $settings->add_list_item ) ) {
				foreach ( $settings->add_list_item as $key => $value ) {
					$settings->add_list_item[ $key ] = self::import_photo( $value );
				}
			}

			return $settings;
		}
		/**
		 * Import Before After Slider and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_uabb_before_after_slider( $settings ) {

			if (
			( ! empty( $settings->before_photo ) && ! empty( $settings->before_photo_src ) )
			) {
				$image = array(
					'url' => $settings->before_photo_src,
					'id'  => $settings->before_photo,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->before_photo_src = $downloaded_image['url'];
				$settings->before_photo     = (string) $downloaded_image['id'];
			}
			if (
			( ! empty( $settings->after_photo ) && ! empty( $settings->after_photo_src ) )
			) {
				$image = array(
					'url' => $settings->after_photo_src,
					'id'  => $settings->after_photo,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->after_photo_src = $downloaded_image['url'];
				$settings->after_photo     = (string) $downloaded_image['id'];
			}

			return $settings;

		}
		/**
		 * Import Dual Button Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_dual_button( $settings ) {

			if (
			( ! empty( $settings->photo_btn_one ) && ! empty( $settings->photo_btn_one_src ) )
			) {
				$image = array(
					'url' => $settings->photo_btn_one_src,
					'id'  => $settings->photo_btn_one,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->photo_btn_one_src = $downloaded_image['url'];
				$settings->photo_btn_one     = (string) $downloaded_image['id'];
			}

			if (
			( ! empty( $settings->photo_btn_two ) && ! empty( $settings->photo_btn_two_src ) )
			) {
				$image = array(
					'url' => $settings->photo_btn_two_src,
					'id'  => $settings->photo_btn_two,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->photo_btn_two_src = $downloaded_image['url'];
				$settings->photo_btn_two     = (string) $downloaded_image['id'];
			}
			return $settings;

		}
		/**
		 * Import Interactive Banner-1 Interactive Banner-2 and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_interactive_banner( $settings ) {

			if (
			( ! empty( $settings->banner_image ) && ! empty( $settings->banner_image_src ) )
			) {
				$image = array(
					'url' => $settings->banner_image_src,
					'id'  => $settings->banner_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->banner_image_src = $downloaded_image['url'];
				$settings->banner_image     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->data ) ) {
				$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
			}
			return $settings;

		}
		/**
		 * Import Interactive Banner-1 Interactive Banner-2 and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_google_map( $settings ) {

			if (
			( ! empty( $settings->marker_img ) && ! empty( $settings->marker_img_src ) )
			) {
				$image = array(
					'url' => $settings->marker_img_src,
					'id'  => $settings->marker_img,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->marker_img_src = $downloaded_image['url'];
				$settings->marker_img     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->uabb_gmap_addresses ) ) {

				foreach ( $settings->uabb_gmap_addresses as $key => $value ) {
					if ( ! empty( $value->marker_img_src ) && ! empty( $value->marker_img ) ) {

						$image = array(
							'url' => $value->marker_img_src,
							'id'  => $value->marker_img,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->marker_img_src = $downloaded_image['url'];
						$value->marker_img     = (string) $downloaded_image['id'];
					}
				}
			}
			return $settings;
		}
		/**
		 * Import Interactive Banner-1 Interactive Banner-2 and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_info_circle( $settings ) {

			if (
			( ! empty( $settings->outer_bg_img_src ) && ! empty( $settings->outer_bg_img ) )
			) {
				$image = array(
					'url' => $settings->outer_bg_img_src,
					'id'  => $settings->outer_bg_img,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->outer_bg_img_src = $downloaded_image['url'];
				$settings->outer_bg_img     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->add_circle_item ) ) {

				foreach ( $settings->add_circle_item as $key => $value ) {

					if ( ! empty( $value->inner_circle_bg_img_src ) && ! empty( $value->inner_circle_bg_img ) ) {

						$image = array(
							'url' => $value->inner_circle_bg_img_src,
							'id'  => $value->inner_circle_bg_img,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->inner_circle_bg_img_src = $downloaded_image['url'];
						$value->inner_circle_bg_img     = (string) $downloaded_image['id'];
					}
					if ( ! empty( $value->photo_src ) && ! empty( $value->photo ) ) {

						$image = array(
							'url' => $value->photo_src,
							'id'  => $value->photo,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->photo_src = $downloaded_image['url'];
						$value->photo     = (string) $downloaded_image['id'];
					}
					if ( ! empty( $value->active_photo_src ) && ! empty( $value->active_photo ) ) {

						$image = array(
							'url' => $value->active_photo_src,
							'id'  => $value->active_photo,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->active_photo_src = $downloaded_image['url'];
						$value->active_photo     = (string) $downloaded_image['id'];
					}
				}
			}
			return $settings;
		}
		/**
		 * Import Interactive Banner-1 Interactive Banner-2 and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_uabb_ihover( $settings ) {

			if ( ! empty( $settings->ihover_item ) ) {

				foreach ( $settings->ihover_item as $key => $value ) {

					if ( ! empty( $value->photo_src ) && ! empty( $value->photo ) ) {

						$image = array(
							'url' => $value->photo_src,
							'id'  => $value->photo,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->photo_src = $downloaded_image['url'];
						$value->photo     = (string) $downloaded_image['id'];
					}
				}
			}
			return $settings;
		}
		/**
		 * Import Interactive Banner-1 Interactive Banner-2 and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_info_list( $settings ) {

			if ( ! empty( $settings->add_list_item ) ) {

				foreach ( $settings->add_list_item as $key => $value ) {

					if ( ! empty( $value->photo_src ) && ! empty( $value->photo ) ) {

						$image = array(
							'url' => $value->photo_src,
							'id'  => $value->photo,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->photo_src = $downloaded_image['url'];
						$value->photo     = (string) $downloaded_image['id'];
					}
				}
			}
			return $settings;
		}
		/**
		 * Import uabb contact form, CF7 Styler and Gravity Form Styler and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_uabb_contact_form( $settings ) {

			if (
			( ! empty( $settings->form_bg_img ) && ! empty( $settings->form_bg_img ) )
			) {
				$image = array(
					'url' => $settings->form_bg_img_src,
					'id'  => $settings->form_bg_img,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->form_bg_img_src = $downloaded_image['url'];
				$settings->form_bg_img     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->data ) ) {
				$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
			}
			return $settings;

		}
		/**
		 * Import Progress Bar and Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_progress_bar( $settings ) {

			if (
			( ! empty( $settings->progress_bg_img ) && ! empty( $settings->progress_bg_img_src ) )
			) {
				$image = array(
					'url' => $settings->progress_bg_img_src,
					'id'  => $settings->progress_bg_img,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->progress_bg_img_src = $downloaded_image['url'];
				$settings->progress_bg_img     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->data ) ) {
				$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
			}
			return $settings;

		}
		/**
		 * Import Info Banner Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_info_banner( $settings ) {

			if (
			( ! empty( $settings->banner_image ) && ! empty( $settings->banner_image_src ) )
			) {
				$image = array(
					'url' => $settings->banner_image_src,
					'id'  => $settings->banner_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->banner_image_src = $downloaded_image['url'];
				$settings->banner_image     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->data ) ) {
				$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
			}
			return $settings;

		}
		/**
		 * Import Flip Box Module Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Module settings object.
		 * @return object
		 */
		public static function import_flip_box( $settings ) {

			if (
			( ! empty( $settings->front_bg_image ) && ! empty( $settings->front_bg_image_src ) )
			) {
				$image = array(
					'url' => $settings->front_bg_image_src,
					'id'  => $settings->front_bg_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->front_bg_image_src = $downloaded_image['url'];
				$settings->front_bg_image     = (string) $downloaded_image['id'];
			}
			if (
			( ! empty( $settings->back_bg_image ) && ! empty( $settings->back_bg_image_src ) )
			) {
				$image = array(
					'url' => $settings->back_bg_image_src,
					'id'  => $settings->back_bg_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->back_bg_image_src = $downloaded_image['url'];
				$settings->back_bg_image     = (string) $downloaded_image['id'];
			}
			return $settings;

		}
		/**
		 * Import Column Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Column settings object.
		 * @return object
		 */
		public static function import_column_images( $settings ) {

			// 1) Set BG Images.
			$settings = self::import_bg_image( $settings );

			return $settings;
		}

		/**
		 * Import Row Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_row_images( $settings ) {
			// 1) Set BG Images.
			$settings = self::import_bg_image( $settings );

			return $settings;
		}

		/**
		 * Helper: Import BG Images.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_bg_image( $settings ) {

			if (
			( ! empty( $settings->bg_image ) && ! empty( $settings->bg_image_src ) )
			) {
				$image = array(
					'url' => $settings->bg_image_src,
					'id'  => $settings->bg_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->bg_image_src = $downloaded_image['url'];
				$settings->bg_image     = (string) $downloaded_image['id'];
			}
			if (
			( ! empty( $settings->bg_parallax_image ) && ! empty( $settings->bg_parallax_image_src ) )
			) {
				$image = array(
					'url' => $settings->bg_parallax_image_src,
					'id'  => $settings->bg_parallax_image,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->bg_parallax_image_src = $downloaded_image['url'];
				$settings->bg_parallax_image     = (string) $downloaded_image['id'];
			}
			if ( ! empty( $settings->ss_photos ) && ! empty( $settings->ss_photo_data ) ) {

				foreach ( $settings->ss_photos as $key => $value ) {

					$settings->ss_photo_data[ $value ]->x3largeURL;

					$image = array(
						'url' => $settings->ss_photo_data[ $value ]->x3largeURL,
						'id'  => $settings->ss_photos[ $key ],
					);

					$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

					$settings->ss_photo_data[ $value ]->x3largeURL = $downloaded_image['url'];

					$settings->ss_photo_data[ $value ]->largeURL = $downloaded_image['url'];

					$settings->ss_photo_data[ $value ]->thumbURL = $downloaded_image['url'];

					$settings->ss_photos[ $key ] = $downloaded_image['id'];
				}
				$settings->ss_photo_data = array_combine( $settings->ss_photos, $settings->ss_photo_data );
			}
			if ( ! empty( $settings->bg_video_fallback ) && ! empty( $settings->bg_video_fallback_src ) ) {

				$image = array(
					'url' => $settings->bg_video_fallback_src,
					'id'  => $settings->bg_video_fallback,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->bg_video_fallback_src = $downloaded_image['url'];
				$settings->bg_video_fallback     = (string) $downloaded_image['id'];
			}

			return $settings;
		}

		/**
		 * Helper: Import Photo.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_photo( $settings ) {

			if ( ! empty( $settings->photo ) && ! empty( $settings->photo_src ) ) {

				if ( isset( $settings->caption ) && ! empty( $settings->caption ) ) {

					$image = array(
						'url'     => $settings->photo_src,
						'id'      => $settings->photo,
						'caption' => $settings->caption,
					);
				} else {
					$image = array(
						'url' => $settings->photo_src,
						'id'  => $settings->photo,
					);
				}

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->photo_src = $downloaded_image['url'];
				$settings->photo     = (string) $downloaded_image['id'];

				if ( ! empty( $settings->data ) ) {
					$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
				}
				if ( ! empty( $settings->photo_data ) ) {
					$settings->photo_data = self::import_photo_data( $settings->photo_data, $downloaded_image['url'] );
				}
			}

			return $settings;
		}
		/**
		 * Helper: Import Photo Gallery.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_photo_gallery( $settings ) {

			if ( ! empty( $settings->photo_data ) ) {

				foreach ( $settings->photo_data as $key => $value ) {

					if ( ! empty( $value->src ) && ! empty( $value->id ) ) {

						if ( isset( $value->caption ) && ! empty( $value->caption ) ) {

							$image = array(
								'url'     => $value->src,
								'id'      => $value->id,
								'caption' => $value->caption,
							);
						} else {
							$image = array(
								'url' => $value->src,
								'id'  => $value->id,
							);
						}

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->src = $downloaded_image['url'];

						$value->id = $downloaded_image['id'];

						$value->link = $downloaded_image['url'];
					}
				}
				foreach ( $settings->photos as $key => $value ) {

					$photo_data = $settings->photo_data;

					$all_photo_data = $photo_data[ $value ];

					$photo = $settings->photos;

					$settings->photos[ $key ] = $all_photo_data->id;
				}
				$settings->photo_data = array_combine( $settings->photos, $settings->photo_data );
			}

			return $settings;
		}
		/**
		 * Helper: Import Photo Gallery.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_adv_testimonials( $settings ) {

			if ( ! empty( $settings->testimonials ) ) {

				foreach ( $settings->testimonials as $key => $value ) {

					if ( ! empty( $value->photo_src ) && ! empty( $value->photo ) ) {

						$image = array(
							'url' => $value->photo_src,
							'id'  => $value->photo,
						);

						$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

						$value->photo_src = $downloaded_image['url'];

						$value->photo = (string) $downloaded_image['id'];

						$value->photo_url = $downloaded_image['url'];
					}
				}
			}
			if ( ! empty( $settings->photo_noslider ) && ! empty( $settings->photo_noslider_src ) ) {

				$image = array(
					'url' => $settings->photo_noslider_src,
					'id'  => $settings->photo_noslider,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->photo_noslider_src = $downloaded_image['url'];
				$settings->photo_noslider     = (string) $downloaded_image['id'];

				if ( ! empty( $settings->data ) ) {
					$settings->data = self::import_photo_data( $settings->data, $downloaded_image['url'] );
				}
			}

			return $settings;
		}
		/**
		 * Helper: Import video.
		 *
		 * @since 1.20.2
		 * @param  object $settings Row settings object.
		 * @return object
		 */
		public static function import_video( $settings ) {

			if ( ! empty( $settings->poster ) && ! empty( $settings->poster_src ) ) {

				$image = array(
					'url' => $settings->poster_src,
					'id'  => $settings->poster,
				);

				$downloaded_image = UABB_Import_Image::get_instance()->import( $image );

				$settings->poster_src = $downloaded_image['url'];
				$settings->poster     = (string) $downloaded_image['id'];

				if ( ! empty( $settings->data ) ) {
					$settings->data = self::import_video_data( $settings->data, $downloaded_image['url'] );
				}
			}
			return $settings;
		}
		/**
		 * Helper: Import video data.
		 *
		 * @since 1.20.2
		 * @param  object $data Row settings object.
		 * @param  object $poster_src Row settings object.
		 * @return object
		 */
		public static function import_video_data( $data, $poster_src ) {

			if ( ! empty( $data->icon ) ) {

				$url = parse_url( $data->icon );

				unset( $url['scheme'] );

				$url['host'] = home_url();

				$src = implode( '', $url );

				$data->icon = $src;
			}
			if ( ! empty( $data->poster ) ) {
				$data->poster = $poster_src;
			}
			if ( ! empty( $data->image->src ) ) {

				$url = parse_url( $data->image->src );

				unset( $url['scheme'] );

				$url['host'] = home_url();

				$src = implode( '', $url );

				$data->image->src = $src;
			}
			if ( ! empty( $data->thumb->src ) ) {

				$url = parse_url( $data->thumb->src );

				unset( $url['scheme'] );

				$url['host'] = home_url();

				$src = implode( '', $url );

				$data->thumb->src = $src;
			}
			return $data;
		}
		/**
		 * Helper: Import Photo.
		 *
		 * @since 1.20.2
		 * @param  object $data photo settings object.
		 * @param  string $photo_src photo source.
		 * @return object
		 */
		public static function import_photo_data( $data, $photo_src ) {

			if ( ! empty( $data ) ) {

				if ( ! empty( $data->url ) ) {

					$data->url = $photo_src;
				}
				if ( ! empty( $data->icon ) ) {

					$url = parse_url( $data->icon );

					unset( $url['scheme'] );

					$url['host'] = home_url();

					$src = implode( '', $url );

					$data->icon = $src;
				}
				if ( isset( $data->sizes ) && ! empty( $data->sizes ) ) {
					foreach ( $data->sizes as $key => $value ) {

						if ( ! empty( $value->url ) ) {
							$value->url = $photo_src;
						}
					}
				}
			}
			return $data;
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method.
	 */
	UABB_Importer_Beaver_Builder::get_instance();

endif;

