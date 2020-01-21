<?php
/**
 *  UABB Business Review file
 *
 *  @package UABB Business Review Module
 */

/**
 * Function that initializes uabb Video Module
 *
 * @Class uabbBusinessReview
 */
class UabbBusinessReview extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the uabb Business Review module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Business Reviews', 'uabb' ),
				'description'     => __( 'Business Reviews', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-reviews/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-business-reviews/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'business-reviews.svg',
			)
		);
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );
		$this->add_css( 'font-awesome-5' );

	}
	/**
	 * Function to get the icon for the Video Gallery
	 *
	 * @since 1.18.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-reviews/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-reviews/icon/' . $icon;
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
	 * Get Reviews array with the same key for Google & Yelp.
	 *
	 * @since 1.18.0
	 * @param array $settings The settings object.
	 * @return the layout of Google reviews.
	 * @access public
	 */
	public function get_review_data( $settings ) {

		$reviews        = array();
		$custom_reviews = array();

		if ( 'google' == $settings->review_source ) {

			$reviews = $this->get_google_reviews( $settings );
			$reviews = $this->get_merged_reviews_array( 'google', $reviews, $settings );

		} elseif ( 'yelp' == $settings->review_source ) {

			$reviews = $this->get_yelp_reviews( $settings );
			$reviews = $this->get_merged_reviews_array( 'yelp', $reviews, $settings );

		} elseif ( 'all' == $settings->review_source ) {

			$google_reviews = $this->get_google_reviews( $settings );
			$yelp_reviews   = $this->get_yelp_reviews( $settings );

			$google_reviews = $this->get_merged_reviews_array( 'google', $google_reviews, $settings );
			$yelp_reviews   = $this->get_merged_reviews_array( 'yelp', $yelp_reviews, $settings );

			if ( empty( $google_reviews ) || empty( $yelp_reviews ) ) {
				return;
			}
			/* Merge reviews array elements inalternative order */
			if ( ! empty( $google_reviews ) ) {
				for ( $i = 0; $i < count( $google_reviews ); $i++ ) {
					$reviews[] = $google_reviews[ $i ];
					if ( isset( $yelp_reviews[ $i ] ) ) {

						$reviews[] = $yelp_reviews[ $i ];
					}
				}
			}

			$reviews = array_filter( $reviews );
		}
		return $reviews;
	}

	/**
	 * Get Reviews array with the same key for Google & Yelp.
	 *
	 * @since 1.18.0
	 * @param string $type The reviews source.
	 * @param array  $reviews The reviews array.
	 * @param array  $settings The settings object.
	 * @return the merged array of Google & Yelp reviews.
	 * @access public
	 */
	public function get_merged_reviews_array( $type, $reviews, $settings ) {
		$custom_reviews    = array();
		$min_rating_filter = false;

		if ( 'no' !== $settings->reviews_min_rating ) {
			$min_rating_filter = true;
		}
		if ( empty( $reviews ) ) {
			return;
		} else {

			foreach ( $reviews as $key => $value ) {

				if ( 'google' === $type ) {
					$user_review_url = explode( '/reviews', $value->author_url );
					array_pop( $user_review_url );
					$review_url = $user_review_url[0] . '/place/' . $settings->google_place_id;

					$review['source']                    = 'google';
					$review['author_name']               = $value->author_name;
					$review['author_url']                = $value->author_url;
					$review['profile_photo_url']         = $value->profile_photo_url;
					$review['rating']                    = $value->rating;
					$review['relative_time_description'] = $value->relative_time_description;
					$review['text']                      = $value->text;
					$review['time']                      = $value->time;
					$review['review_url']                = $review_url;
				}
				if ( 'yelp' === $type ) {
					$review['source']                    = 'yelp';
					$review['author_name']               = $value->user->name;
					$review['author_url']                = $value->user->profile_url;
					$review['profile_photo_url']         = $value->user->image_url;
					$review['rating']                    = $value->rating;
					$review['relative_time_description'] = '';
					$review['text']                      = $value->text;
					$review['time']                      = $value->time_created;
					$review['review_url']                = $value->url;
				}

				if ( $min_rating_filter ) {
					if ( $value->rating >= $settings->reviews_min_rating ) {
						array_push( $custom_reviews, $review );
					}
				} else {
					array_push( $custom_reviews, $review );
				}
			}
		}
		return $custom_reviews;

	}

	/**
	 * Getting an google API key from DB.
	 *
	 * @since 1.18.0
	 * @access public
	 */
	public function get_google_api_key() {

		$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

		if ( is_array( $uabb_setting_options ) && array_key_exists( 'uabb-google-place-api', $uabb_setting_options ) && '' !== $uabb_setting_options['uabb-google-place-api'] ) {

			return $uabb_setting_options['uabb-google-place-api'];

		} else {
			?>
			<div class="uabb-module-content" id="uabb-google-api-key">
				<?php if ( current_user_can( 'delete_users' ) ) { ?>
				<div>
					<span > <?php _e( 'It seems that you have not yet configured Google Place API key. To display Google Reviews, please set up API key in', 'uabb' ); ?>
						<a href="<?php echo admin_url( 'options-general.php?page=uabb-builder-settings#uabb' ); ?>" class="uabb-google-map-notice" target="_blank" rel="noopener">
							<span class="uabb-google-key-ref-link"><?php _e( 'General Settings', 'uabb' ); ?></span>
						</a>
					</span>
				</div>
				<?php } ?>
			</div>
			<?php
			return false;
		}
	}
	/**
	 * Gets JSON Data from Google.
	 *
	 * @since 1.18.0
	 * @param array $settings The settings object.
	 * @return the layout of Google reviews.
	 * @access public
	 */
	public function get_google_api_call( $settings ) {

		$place_id = $settings->google_place_id;

		if ( '' === $place_id ) {
			return;
		}

		$api_key = $this->get_google_api_key();

		if ( '' === $api_key || null === $api_key || false === $api_key ) {
			return;
		}
		$add_query_arg = apply_filters( 'uabb_reviews_google_url_filter', array(
			'key'     => $api_key,
			'placeid' => $place_id,
		) );

		$url = add_query_arg( $add_query_arg,
			'https://maps.googleapis.com/maps/api/place/details/json'
		);

		$url = esc_url_raw( $url );

		$reviews = '';

		$transient_name = 'uabb_reviews_' . $place_id;

		$result = get_transient( $transient_name );

		$expire_time = $settings->set_transient_time;

		$expire_time = apply_filters( 'uabb_reviews_expire_time', $expire_time, $settings );

		if ( false === $result ) {

			$result = wp_remote_post(
				$url,
				array(
					'method'      => 'POST',
					'timeout'     => 60,
					'httpversion' => '1.0',
					'sslverify'   => false,
				)
			);

			$result = wp_encode_emoji( $result['body'] );

			set_transient( $transient_name, $result, $expire_time );
		}

		$final_result = $result;

		if ( ! empty( $final_result ) ) {

			return $final_result;
		} else {
			return false;
		}
	}
	/**
	 * Gets JSON Data from Google.
	 *
	 * @since 1.18.0
	 * @param array $settings The settings object.
	 * @return the layout of Google reviews.
	 * @access public
	 */
	public function get_google_reviews( $settings ) {

		$place_id = $settings->google_place_id;

		if ( '' === $place_id ) {
			return;
		}

		$result = $this->get_google_api_call( $settings );

		if ( false === $result || null === $result ) {

			return;
		}

		$is_editor = FLBuilderModel::is_builder_active();

		$transient_name = 'uabb_reviews_' . $place_id;

		$admin_link = admin_url( 'options-general.php?page=uabb-builder-settings#uabb' );

		$result = json_decode( $result );

		if ( is_wp_error( $result ) ) {

			$error_message = $result->get_error_message();

			if ( $is_editor ) {
				/* translators: %1$s doc link */
				echo sprintf( '<span class="uabb-reviews-notice-message">' . __( 'Something went wrong while fetching Google reviews:', 'uabb' ) . '%1$s </span>', $error_message );
			}
			delete_transient( $transient_name );
			return;
		}

		$result_status = ( isset( $result->status ) ) ? $result->status : '';

		if ( $is_editor ) {

			switch ( $result_status ) {

				case 'OK':
					if ( ! property_exists( $result->result, 'reviews' ) ) {
						echo '<span>' . __( 'Something went wrong: Seems like the Google place you have selected does not have any reviews.', 'uabb' ) . '</span>';
						delete_transient( $transient_name );
						return false;
					}
					break;

				case 'OVER_QUERY_LIMIT':
					echo '<span>' . __( 'Something went wrong: You have exceeded the usage limits.', 'uabb' ) . '</span>';
					delete_transient( $transient_name );
					return false;
					break;

				case 'REQUEST_DENIED':
					/* translators: %s: search term */
					echo sprintf( '<span class="uabb-google-api-key-error">' . __( 'Something went wrong: The invalid API key is entered. Please configure the API key from', 'uabb' ) . '<a href="%s" target="_blank" rel="noopener"> here </a>.</span>', $admin_link );
						delete_transient( $transient_name );
					return false;
					break;

				case 'UNKNOWN_ERROR':
					echo '<span>' . __( 'Something went wrong: Seems like a server-side error; Please try again later.', 'uabb' ) . '</span>';
					delete_transient( $transient_name );
					return false;
					break;

				case 'ZERO_RESULTS':
				case 'INVALID_REQUEST':
					echo '<span>' . __( 'Something went wrong: The invalid Place ID is entered.', 'uabb' ) . '</span>';
					delete_transient( $transient_name );
					return false;
					break;

				default:
					delete_transient( $transient_name );
					return false;
					break;
			}
		}
		if ( 'OK' === $result_status ) {
			if ( property_exists( $result->result, 'reviews' ) && ! empty( $result->result->reviews ) ) {
				$reviews = $result->result->reviews;
			}
		} else {
			return;
		}
		return $reviews;
	}
	/**
	 * Gets JSON Data from Yelp.
	 *
	 * @since 1.18.0
	 * @param array $settings The settings object.
	 * @return the layout of Yelp reviews.
	 * @access public
	 */
	public function get_yelp_reviews( $settings ) {

		$is_editor = FLBuilderModel::is_builder_active();

		$admin_link = admin_url( 'options-general.php?page=uabb-builder-settings#uabb' );

		$business_id = $this->settings->yelp_business_id;

		if ( '' === $business_id || null === $business_id ) {
			return;
		}

		$url = 'https://api.yelp.com/v3/businesses/' . $business_id . '/reviews';

		$url = esc_url_raw( $url );

		$yelp_api_key = $this->get_yelp_api_key( $this->settings );

		if ( '' === $yelp_api_key || null === $yelp_api_key ) {
			return;
		}

		$reviews = '';

		$transient_name = 'uabb_reviews_' . $business_id;

		$expire_time = $settings->set_transient_time;

		$expire_time = apply_filters( 'uabb_reviews_expire_time', $expire_time, $this->settings );

		$result = get_transient( $transient_name );

		if ( false === $result ) {
			$result = wp_remote_get(
				$url,
				array(
					'method'      => 'GET',
					'timeout'     => 60,
					'httpversion' => '1.0',
					'sslverify'   => false,
					'user-agent'  => '',
					'headers'     => array(
						'Authorization' => 'Bearer ' . $yelp_api_key,
					),
				)
			);
			set_transient( $transient_name, $result, $expire_time );
		}

		// Status code of API returns.
		$result_status = $result['response']['code'];

		$review = json_decode( $result['body'] );

		if ( $is_editor ) {
			// Check the response code.
			$response_code    = wp_remote_retrieve_response_code( $result );
			$response_message = wp_remote_retrieve_response_message( $result );

			$reviews = $review;

			if ( 200 !== $response_code && ! empty( $response_message ) ) {
				if ( $is_editor ) {

					$error_code = $reviews->error->code;

					if ( 'VALIDATION_ERROR' === $error_code ) {

						echo '<span class="uabb-reviews-notice-message"><span class="uabb-reviews-error-message">' . __( 'Yelp Error Message:', 'uabb' ) . '</span>' . __( 'Incorrect Yelp API key. Please set up the API key from UABB settings', 'uabb' ) . '</span>';
					} elseif ( 'BUSINESS_NOT_FOUND' === $error_code ) {

						echo '<span class="uabb-reviews-notice-message"><span class="uabb-reviews-error-message">' . __( 'Yelp Error Message :', 'uabb' ) . '</span>' . __( ' Incorrect Business ID.', 'uabb' ) . '</span>';
					}
				}
				delete_transient( $transient_name );
				return;
			} elseif ( 200 !== $response_code ) {
				if ( $is_editor ) {
					/* translators: %1$s doc link */
					echo sprintf( '<span class="uabb-reviews-notice-message"> %1$s' . __( 'Unknown error occurred.', 'uabb' ) . '</span>', $response_code );
				}
				delete_transient( $transient_name );
				return;
			}
		}

		if ( ! isset( $reviews ) ) {
			return;
		}
		if ( isset( $review->reviews ) ) {
			$reviews = $review->reviews;
		}

		return $reviews;
	}

	/**
	 * Get sorted array of reviews by rating.
	 *
	 * @since 1.18.0
	 * @access public
	 * @param string $review1 represents review1 to compare.
	 * @param string $review2 represents review2 to compare.
	 * @return string of compared reviews.
	 */
	function filter_by_rating( $review1, $review2 ) {
		return strcmp( $review2['rating'], $review1['rating'] );
	}

	/**
	 * Get sorted array of reviews by date.
	 *
	 * @since 1.18.0
	 * @access public
	 * @param string $review1 represents review1 to compare.
	 * @param string $review2 represents review2 to compare.
	 * @return string of compared reviews.
	 */
	function filter_by_date( $review1, $review2 ) {
		return strcmp( $review2['time'], $review1['time'] );
	}

	/**
	 * Retrieves Yelp API key from UABB save options
	 *
	 * @since 1.18.0
	 * @param array $settings The settings object.
	 * @access public
	 */
	public function get_yelp_api_key( $settings ) {

		$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

		if ( is_array( $uabb_setting_options ) && array_key_exists( 'uabb-yelp-api-key', $uabb_setting_options ) && '' !== $uabb_setting_options['uabb-yelp-api-key'] ) {

			return $uabb_setting_options['uabb-yelp-api-key'];
		} else {
			?>
			<div class="uabb-module-content uabb-yelp-api-key-wrapper" id="uabb-yelp-api-key">
				<?php if ( current_user_can( 'delete_users' ) ) { ?>
				<div>
					<span > <?php _e( 'It seems that you have not yet configured Yelp API key. To display Yelp Reviews, please set up API key in', 'uabb' ); ?>
						<a href="<?php echo admin_url( 'options-general.php?page=uabb-builder-settings#uabb' ); ?>" class="uabb-yelp-notice" target="_blank" rel="noopener">
							<span class="uabb-yelp-key-ref-link"><?php _e( 'General Settings', 'uabb' ); ?></span>
						</a>
					</span>
				</div>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Gets the layout of five star.
	 *
	 * @since 1.18.0
	 *
	 * @param array $total_rating total_rating.
	 * @param array $review data of single review.
	 * @param array $settings The settings object.
	 * @return the layout of Google reviews star rating.
	 * @access public
	 */
	public function render_stars( $total_rating, $review, $settings ) {
		$rating     = $total_rating;
		$stars_html = '';
		$flag       = 0;

		if ( 'default' === $this->settings->select_star_style ) {

			if ( 'google' === $review['source'] ) {
				$marked_icon_html   = '<i class="fas fa-star uabb-star-full uabb-star-default" aria-hidden="true"></i>';
				$unmarked_icon_html = '<i class="fas fa-star uabb-star-empty uabb-star-default" aria-hidden="true"></i>';
				$flag               = 1;
			} else {
				$stars_html = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="100px" height="18px" viewBox="0 0 30 5.75" enable-background="new 0 0 30 5.75" xml:space="preserve" class="uabb-yelp-rating-svg-' . $rating . '">
				<g>
					<path fill="#D6D6D6" d="M5.075,0.055H0.564C0.256,0.055,0,0.307,0,0.626v4.497c0,0.314,0.256,0.572,0.564,0.572h4.511
						c0.308,0,0.557-0.258,0.557-0.572V0.626C5.632,0.307,5.383,0.055,5.075,0.055z M4.973,2.487L3.889,3.434L4.211,4.83
						C4.241,4.928,4.13,5.005,4.05,4.947L2.82,4.215l-1.23,0.732C1.501,5.001,1.399,4.928,1.42,4.83l0.33-1.396L0.664,2.487
						c-0.08-0.06-0.041-0.186,0.062-0.191l1.432-0.123l0.56-1.327c0.03-0.088,0.161-0.088,0.205,0l0.557,1.327l1.433,0.123
						C5.003,2.302,5.046,2.428,4.973,2.487z" class="uabb-yelp-rating-1"/>
					<path fill="#D6D6D6" d="M11.162,0.055H6.658c-0.311,0-0.571,0.252-0.571,0.571v4.497c0,0.314,0.26,0.572,0.571,0.572h4.504
						c0.315,0,0.564-0.258,0.564-0.572V0.626C11.726,0.307,11.477,0.055,11.162,0.055z M11.067,2.487L9.983,3.434l0.322,1.396
						c0.025,0.098-0.088,0.175-0.165,0.117L8.914,4.215l-1.23,0.732c-0.088,0.054-0.19-0.02-0.176-0.117l0.329-1.396L6.75,2.487
						c-0.078-0.06-0.034-0.186,0.069-0.191l1.425-0.123l0.565-1.327c0.032-0.088,0.164-0.088,0.208,0l0.557,1.327l1.426,0.123
						C11.096,2.302,11.14,2.428,11.067,2.487z" class="uabb-yelp-rating-2"/>
					<path fill="#D6D6D6" d="M17.248,0.055h-4.497c-0.318,0-0.571,0.252-0.571,0.571v4.497c0,0.314,0.253,0.572,0.571,0.572h4.497
						c0.32,0,0.572-0.258,0.572-0.572V0.626C17.82,0.307,17.568,0.055,17.248,0.055z M17.16,2.487l-1.084,0.946l0.322,1.396
						c0.018,0.098-0.088,0.175-0.172,0.117L15,4.215l-1.225,0.732c-0.086,0.054-0.191-0.02-0.174-0.117l0.322-1.396l-1.084-0.946
						c-0.073-0.06-0.029-0.186,0.073-0.191l1.421-0.123l0.562-1.327c0.039-0.088,0.171-0.088,0.21,0l0.561,1.327l1.422,0.123
						C17.189,2.302,17.234,2.428,17.16,2.487z" class="uabb-yelp-rating-3"/>
					<path fill="#D6D6D6" d="M23.342,0.055h-4.503c-0.315,0-0.565,0.252-0.565,0.571v4.497c0,0.314,0.25,0.572,0.565,0.572h4.503
						c0.315,0,0.572-0.258,0.572-0.572V0.626C23.914,0.307,23.657,0.055,23.342,0.055z M23.246,2.487l-1.083,0.946l0.323,1.396
						c0.027,0.098-0.082,0.175-0.17,0.117l-1.229-0.732l-1.226,0.732c-0.078,0.054-0.189-0.02-0.166-0.117l0.322-1.396l-1.084-0.946
						c-0.074-0.06-0.029-0.186,0.068-0.191l1.426-0.123l0.563-1.327c0.037-0.088,0.17-0.088,0.205,0l0.558,1.327l1.436,0.123
						C23.277,2.302,23.328,2.428,23.246,2.487z" class="uabb-yelp-rating-4"/>
					<path fill="#D6D6D6" d="M29.43,0.055h-4.505c-0.3,0-0.564,0.252-0.564,0.571v4.497c0,0.314,0.265,0.572,0.564,0.572h4.505
						c0.321,0,0.57-0.258,0.57-0.572V0.626C30,0.307,29.751,0.055,29.43,0.055z M29.34,2.487l-1.083,0.946L28.58,4.83
						c0.027,0.098-0.09,0.175-0.176,0.117l-1.227-0.732l-1.229,0.732c-0.079,0.054-0.183-0.02-0.156-0.117l0.326-1.396l-1.086-0.946
						c-0.087-0.06-0.035-0.186,0.059-0.191l1.436-0.123l0.557-1.327c0.031-0.088,0.169-0.088,0.207,0l0.557,1.327l1.434,0.123
						C29.371,2.302,29.416,2.428,29.34,2.487z" class="uabb-yelp-rating-5"/>
				</g>
				</svg>';
			}
		} else {
			$marked_icon_html   = '<i class="fas fa-star uabb-star-full uabb-star-custom"></i>';
			$unmarked_icon_html = '<i class="fas fa-star uabb-star-empty uabb-star-custom"></i>';
			$flag               = 1;
		}

		if ( $flag ) {
			for ( $stars = 1; $stars <= 5; $stars++ ) {
				if ( $stars <= $rating ) {
					$stars_html .= $marked_icon_html;
				} else {
					$stars_html .= $unmarked_icon_html;
				}
			}
		}

		return $stars_html;
	}

	/**
	 * Render Business Reviews output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.18.0
	 * @access protected
	 * @access public
	 */
	public function render() {
		$skin               = str_replace( '-', '_', $this->settings->_skin );
		$reviews            = '';
		$reviews_max        = 8;
		$disply_num_reviews = 8;
		$overall_align      = '';
		$image_align        = '';

		$reviews = $this->get_review_data( $this->settings );

		if ( ! isset( $reviews ) ) {
			return;
		}

		$layout_class = ( 'carousel' == $this->settings->review_layout ) ? 'uabb-review-layout-carousel' : 'uabb-reviews-layout-grid';

		if ( 'card' === $this->settings->_skin || 'default' === $this->settings->_skin ) {

			$image_align = ( 'yes' === $this->settings->reviewer_image ) ? 'uabb-review-image-' . $this->settings->image_align : '';
		}
		if ( 'card' === $this->settings->_skin || 'default' === $this->settings->_skin ) {

			if ( 'top' === $this->settings->image_align ) {

				$overall_align = $this->settings->overall_align;

			}
		}
		?>
		<div class="uabb-reviews-grid__column-<?php echo $this->settings->gallery_columns; ?> uabb-reviews-grid-tablet__column-<?php echo $this->settings->gallery_columns_medium; ?> uabb-reviews-grid-mobile__column-<?php echo $this->settings->gallery_columns_responsive; ?> <?php echo $layout_class; ?> uabb-reviews-align-<?php echo $overall_align; ?> <?php echo $image_align; ?> uabb-reviews-skin-<?php echo $skin; ?>">
			<div class="uabb-reviews-module-wrap" >

				<?php
				if ( 'rating' == $this->settings->reviews_filter_by ) {
					usort( $reviews, array( $this, 'filter_by_rating' ) );
				} elseif ( 'date' == $this->settings->reviews_filter_by ) {
					usort( $reviews, array( $this, 'filter_by_date' ) );
				}

				if ( 'google' == $this->settings->review_source ) {
					$reviews_max        = 5;
					$disply_num_reviews = $this->settings->google_reviews_count;
				} elseif ( 'yelp' == $this->settings->review_source ) {
					$reviews_max        = 3;
					$disply_num_reviews = $this->settings->yelp_reviews_number;
				} elseif ( 'all' == $this->settings->review_source ) {
					$reviews_max        = 8;
					$disply_num_reviews = $this->settings->total_reviews_number;
				}

				$disply_num_reviews = ( '' !== $disply_num_reviews ) ? $disply_num_reviews : $reviews_max;

				if ( $reviews_max !== $disply_num_reviews ) {
					$display_number = (int) $disply_num_reviews;
					$reviews        = array_slice( $reviews, 0, $display_number );
				}

				foreach ( $reviews as $key => $review ) {

					$this->get_reviews( $review, $this->settings );
				}

				?>
			</div>
		</div>

		<?php
	}
	/**
	 * Render Business Reviews output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.18.0
	 * @access protected
	 * @access public
	 */
	public function get_reviewer_source_icon() {

		$icon = array();

		if ( isset( $this->settings->review_source_icon ) && 'yes' === $this->settings->review_source_icon ) {

			$icon['google'] = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" height="18px" xml:space="preserve" class="uabb_google_icon" > <path style="fill:#FBBB00;" d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256 c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456 C103.821,274.792,107.225,292.797,113.47,309.408z"/> <path style="fill:#518EF8;" d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451 c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535 c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"/> <path style="fill:#28B446;" d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512 c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771 c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"/> <path style="fill:#F14336;" d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012 c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0 C318.115,0,375.068,22.126,419.404,58.936z"/> </svg>';

			$icon ['yelp'] = 'fab fa-yelp';

		}
		return $icon;
	}
	/**
	 * Get HTML structure for each reviewer name.
	 *
	 * @since 1.18.0
	 * @access public
	 * @param string $review represents review.
	 * @param string $settings represents settings.
	 */
	public function get_reviewer_name( $review, $settings ) {

			$icon        = $this->get_reviewer_source_icon();
			$google_icon = '';
			$yelp_icon   = '';

		if ( is_array( $icon ) ) {

			$google_icon = ( array_key_exists( 'google', $icon ) ? $icon['google'] : '' );

			$yelp_icon = ( array_key_exists( 'yelp', $icon ) ? $icon['yelp'] : '' );

		}
		if ( 'yes' === $this->settings->reviewer_name ) {
			?>
			<?php if ( 'yes' === $this->settings->reviewer_name_link ) { ?>
				<span class="uabb-reviewer-name-wrapper">
					<span class="uabb-reviewer-name"><?php echo "<a class='uabb-reviewer-link' href={$review['author_url']} target='_blank'>{$review['author_name']}</a>"; ?></span>
					<?php if ( 'default' === $this->settings->_skin && ( 'all_left' == $this->settings->image_align || 'left' == $this->settings->image_align ) ) { ?>
						<?php if ( 'yelp' == $review['source'] ) { ?>
							<i class="<?php echo $yelp_icon; ?>" aria-hidden="true"></i>
							<?php
} else {
							echo $google_icon;
}
						?>
					<?php } ?>
				</span>
			<?php } else { ?>
				<span class="uabb-reviewer-name-wrapper">
					<span class="uabb-reviewer-name"><?php echo "{$review['author_name']}"; ?></span>
					<?php if ( 'default' === $this->settings->_skin && ( 'all_left' == $this->settings->image_align || 'left' == $this->settings->image_align ) ) { ?>
						<?php if ( 'yelp' == $review['source'] ) { ?>
							<i class="<?php echo $yelp_icon; ?>" aria-hidden="true"></i>
							<?php
} else {
							echo $google_icon;
}
						?>
					<?php } ?>
				</span>
			<?php } ?>
			<?php
		}

	}

	/**
	 * Get HTML structure for each reviewer header.
	 *
	 * @since 1.18.0
	 * @access public
	 * @param string $review represents review.
	 * @param string $photolink represents review photo link.
	 * @param string $settings represents settings object.
	 */
	public function get_reviews_header( $review, $photolink, $settings ) {

		$total_rating      = $review['rating'];
		$date              = $review['time'];
		$review_sorce_date = '';
		$icon              = $this->get_reviewer_source_icon();
		$google_icon       = '';
		$yelp_icon         = '';

		if ( is_array( $icon ) ) {

			$google_icon = ( array_key_exists( 'google', $icon ) ? $icon['google'] : '' );

			$yelp_icon = ( array_key_exists( 'yelp', $icon ) ? $icon['yelp'] : '' );

		}

		$timestamp = ( 'google' == $review['source'] ) ? $review['time'] : strtotime( $review['time'] );

		$date = date( 'd-m-Y', $timestamp );

		if ( ( isset( $settings->review_source_icon ) && 'no' === $settings->review_source_icon ) || 'top' === $settings->image_align ) {

			$review_sorce_date = ' via ' . ucwords( $review['source'] );

		}
		if ( 'yes' == $settings->review_date ) {

			if ( 'google' == $settings->review_source ) {

				$date_value = ( 'default' == $settings->review_date_type ) ? $date : $review['relative_time_description'];

			} else {
				$date_value = $date;
			}
		}
		?>
		<div class="uabb-review-header">

			<?php if ( 'yes' === $settings->reviewer_image && ( 'all_left' !== $settings->image_align || 'bubble' === $settings->_skin ) ) { ?>
				<div class="uabb-review-image" style="background-image:url( <?php echo $photolink; ?> ); ">
				</div>
			<?php } ?>
			<div class="uabb-review-details">
				<?php
				if ( 'default' === $settings->_skin || 'business' === $settings->_skin ) {
					$this->get_reviewer_name( $review, $settings );
				}
				?>
				<?php if ( 'yes' === $settings->review_rating ) { ?>
					<span class="uabb-star-rating__wrapper">
						<span class="uabb-star-rating"><?php echo $this->render_stars( $total_rating, $review, $settings ); ?></span>
					</span>
				<?php } ?>
				<?php if ( 'yes' === $settings->review_date ) { ?>
					<div class="uabb-review-time"> <?php echo $date_value . $review_sorce_date; ?> </div>
				<?php } ?>
				<?php
				if ( 'bubble' === $settings->_skin || 'card' === $settings->_skin ) {
					$this->get_reviewer_name( $review, $settings );
				}
				?>
			</div>
			<?php if ( 'card' === $settings->_skin && ( 'left' === $settings->image_align || 'all_left' === $settings->image_align ) ) { ?>
				<div class="uabb-review-icon-wrap">
					<?php if ( 'yelp' == $review['source'] ) { ?>
						<i class="<?php echo $yelp_icon; ?>" aria-hidden="true"></i>
						<?php
} elseif ( 'google' == $review['source'] ) {
							echo $google_icon;
}
					?>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	/**
	 * Get HTML structure for each review.
	 *
	 * @since 1.18.0
	 * @access public
	 * @param string $review The current google review.
	 * @param array  $settings The settings object.
	 */
	public function get_reviews( $review, $settings ) {
		$photolink = ( null !== $review['profile_photo_url'] ) ? $review['profile_photo_url'] : '';

		$date         = date( 'd/m/Y', strtotime( $review['time'] ) );
		$total_rating = $review['rating'];
		$content      = '';
		if ( 'default' === $settings->_skin ) {
			?>
			<div class="uabb-review-wrap">
				<div class="uabb-review uabb-review-type-<?php echo $review['source']; ?>">
					<?php if ( 'yes' === $settings->reviewer_image && 'all_left' === $settings->image_align ) { ?>
						<div class="uabb-review-image">
							<img src="<?php echo $photolink; ?>" alt="profile image">
						</div>
					<?php } ?>
					<div class="uabb-review-inner-wrap">
						<?php $this->get_reviews_header( $review, $photolink, $settings ); ?>
						<?php if ( 'yes' === $settings->review_content ) { ?>
							<?php
							$the_content = $review['text'];
							if ( '' !== $settings->review_content_length ) {
								$the_content    = strip_tags( $review['text'] ); // Strips tags.
								$content_length = $settings->review_content_length; // Sets content length by word count.
								$words          = explode( ' ', $the_content, $content_length + 1 );
								if ( count( $words ) > $content_length ) {
									array_pop( $words );
									$the_content  = implode( ' ', $words ); // put in content only the number of word that is set in $content_length.
									$the_content .= '...';
									if ( '' !== $settings->read_more ) {
										$content = '<a href="' . $review['review_url'] . '"  target="_blank" rel="noopener noreferrer" class="uabb-reviews-read-more">' . $settings->read_more . '</a>';
									}
								}
							}
							?>
							<div class="uabb-review-content"><?php echo $the_content; ?></div>
							<div class="uabb-reviews-read-more_wrap"> <?php echo $content; ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php

		} elseif ( 'card' === $settings->_skin ) {
			?>
			<div class="uabb-review-wrap">
				<div class="uabb-review uabb-review-type-<?php echo $review['source']; ?>">
						<?php if ( 'yes' === $settings->reviewer_image && 'all_left' === $settings->image_align ) { ?>
						<div class="uabb-review-image">
							<img src="<?php echo $photolink; ?>" alt="profile image">
						</div>
					<?php } ?>
					<div class="uabb-review-inner-wrap">
						<?php if ( 'yes' === $settings->review_content ) { ?>
							<?php
							$the_content = $review['text'];
							if ( '' !== $settings->review_content_length ) {
								$the_content    = strip_tags( $review['text'] ); // Strips tags.
								$content_length = $settings->review_content_length; // Sets content length by word count.
								$words          = explode( ' ', $the_content, $content_length + 1 );
								if ( count( $words ) > $content_length ) {
									array_pop( $words );
									$the_content  = implode( ' ', $words ); // put in content only the number of word that is set in $content_length.
									$the_content .= '...';
									if ( '' !== $settings->read_more ) {
										$content = '<a href="' . $review['review_url'] . '"  target="_blank" rel="noopener noreferrer" class="uabb-reviews-read-more">' . $settings->read_more . '</a>';
									}
								}
							}
							?>
							<div class="uabb-review-content"><?php echo $the_content; ?></div>
							<div class="uabb-reviews-read-more_wrap"> <?php echo $content; ?></div>
							<?php $this->get_reviews_header( $review, $photolink, $settings ); ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		} elseif ( 'bubble' === $settings->_skin ) {
			$icon        = $this->get_reviewer_source_icon();
			$google_icon = '';
			$yelp_icon   = '';

			if ( is_array( $icon ) ) {

				$google_icon = ( array_key_exists( 'google', $icon ) ? $icon['google'] : '' );

				$yelp_icon = ( array_key_exists( 'yelp', $icon ) ? $icon['yelp'] : '' );

			}
			?>
			<div class="uabb-review-wrap">
				<div class="uabb-review uabb-review-type-<?php echo $review['source']; ?>">
					<div class="uabb-review-inner-wrap">
						<?php if ( 'yes' === $settings->review_content ) { ?>
							<?php
							$the_content = $review['text'];
							if ( '' !== $settings->review_content_length ) {
								$the_content    = strip_tags( $review['text'] ); // Strips tags.
								$content_length = $settings->review_content_length; // Sets content length by word count.
								$words          = explode( ' ', $the_content, $content_length + 1 );
								if ( count( $words ) > $content_length ) {
									array_pop( $words );
									$the_content  = implode( ' ', $words ); // put in content only the number of word that is set in $content_length.
									$the_content .= '...';
									if ( '' !== $settings->read_more ) {
										$content = '<a href="' . $review['review_url'] . '"  target="_blank" rel="noopener noreferrer" class="uabb-reviews-read-more">' . $settings->read_more . '</a>';
									}
								}
							}
							?>
							<div class="uabb-review-content-wrap">
								<div class="uabb-review-content"><?php echo $the_content; ?>
									<div class="uabb-review-content-arrow-wrap">
										<div class="uabb-review-arrow-border"></div>
										<div class="uabb-review-arrow"></div>
									</div>
									<div class="uabb-reviews-read-more_wrap"> <?php echo $content; ?></div>
									<?php if ( 'yelp' == $review['source'] || 'google' == $review['source'] ) { ?>
										<div class="uabb-review-icon-wrap">
											<?php if ( 'yelp' == $review['source'] ) { ?>
												<i class="<?php echo $yelp_icon; ?>" aria-hidden="true"></i>
												<?php
} elseif ( 'google' == $review['source'] ) {
												echo $google_icon;
}
											?>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php $this->get_reviews_header( $review, $photolink, $settings ); ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		} elseif ( 'business' === $settings->_skin ) {
			?>
			<div class="uabb-review-wrap">
				<div class="uabb-review uabb-review-type-<?php echo $review['source']; ?>">
						<?php if ( 'yes' === $settings->reviewer_image && 'all_left' === $settings->image_align ) { ?>
						<div class="uabb-review-image">
							<img src="<?php echo $photolink; ?>" alt="profile image">
						</div>
					<?php } ?>
					<div class="uabb-review-inner-wrap">
						<?php $this->get_reviews_header( $review, $photolink, $settings ); ?>
						<?php if ( 'yes' === $settings->review_content ) { ?>
							<?php
							$the_content = $review['text'];
							if ( '' !== $settings->review_content_length ) {
								$the_content    = strip_tags( $review['text'] ); // Strips tags.
								$content_length = $settings->review_content_length; // Sets content length by word count.
								$words          = explode( ' ', $the_content, $content_length + 1 );
								if ( count( $words ) > $content_length ) {
									array_pop( $words );
									$the_content  = implode( ' ', $words ); // put in content only the number of word that is set in $content_length.
									$the_content .= '...';
									if ( '' !== $settings->read_more ) {
										$the_content .= '<a href="' . $review['review_url'] . '"  target="_blank" rel="noopener noreferrer" class="uabb-reviews-read-more">' . $settings->read_more . '</a>';
									}
								}
							}
							?>
							<div class="uabb-review-content"><?php echo $the_content; ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
		}
	}


}

$notice = '';
$style1 = 'line-height: 1.45em; color: #a94442;';
$style2 = 'font-weight:bold;color: #a94442;';

$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

$google_api_key = '';

$uabb_yelp_api_key = '';

if ( is_array( $uabb_setting_options ) ) {

	$uabb_yelp_api_key = ( array_key_exists( 'uabb-yelp-api-key', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-yelp-api-key'] : '';

	$google_api_key = ( array_key_exists( 'uabb-google-place-api', $uabb_setting_options ) ) ? $uabb_setting_options['uabb-google-place-api'] : '';
}
if ( ! empty( $google_api_key ) ) {
	$notice .= sprintf( /* translators: %1$s: search term */
		__( '<span class="google__notice" style="%1$s"> If you are facing issues while fetching the reviews, make sure you have entered the correct Google Places API key and Google Place ID. </span>', 'uabb' ),
		$style1
	);
} else {
	$notice .= sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
		__( '<span class="google__notice" style="%1$s">To display Google Places reviews, you need to configure the Google Places API key. Please configure API key from <a href="%3$s" class="uabb-google-map-notice" target="_blank" rel="noopener"> here. </a> </span> ', 'uabb' ),
		$style1,
		$style2,
		admin_url( 'options-general.php?page=uabb-builder-settings#uabb' )
	);
}
if ( ! empty( $uabb_yelp_api_key ) ) {
	$notice .= sprintf( /* translators: %1$s: search term */
		__( '<span class="yelp__notice" style="%1$s">If you are facing issues while fetching the reviews make sure you have entered the correct Yelp API key and Yelp Business ID. </span>', 'uabb' ),
		$style1
	);
} else {
	$notice .= sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
		__( '<span class="yelp__notice" style="%1$s"> To display Yelp reviews, you need to configure the Yelp API key. Please configure API key from <a href="%3$s" class="uabb-google-map-notice" target="_blank" rel="noopener"> here. </a></span>', 'uabb' ),
		$style1,
		$style2,
		admin_url( 'options-general.php?page=uabb-builder-settings#uabb' )
	);

}
if ( ! empty( $google_api_key ) && ! empty( $uabb_yelp_api_key ) ) {
	$notice .= sprintf( /* translators: %1$s: search term */
		__( '<span class="all__notice" style="%1$s"> If you are facing issues while fetching the reviews make sure you have entered the correct Google Places API key, Yelp API key, Goggle Place ID and Yelp Business ID. </span>', 'uabb' ),
		$style1
	);
} else {
	$notice .= sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
		__( '<span class="all__notice" style="%1$s"> To display Google Places reviews & Yelp reviews, you need to configure the Google Places & Yelp API key. Please configure API key from <a href="%3$s" class="uabb-google-map-notice" target="_blank" rel="noopener"> here. </a></span>', 'uabb' ),
		$style1,
		$style2,
		admin_url( 'options-general.php?page=uabb-builder-settings#uabb' )
	);
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( uabb_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-reviews/uabb-business-reviews-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-business-reviews/uabb-business-reviews-bb-less-than-2-2-compatibility.php';
}
