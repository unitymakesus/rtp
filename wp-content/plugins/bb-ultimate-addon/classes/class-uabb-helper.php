<?php
/**
 * Custom modules
 *
 * @package UABB Helper
 */
if ( ! class_exists( 'BB_Ultimate_Addon_Helper' ) ) {

	/**
	 * This class initializes BB Ultiamte Addon Helper
	 *
	 * @class BB_Ultimate_Addon_Helper
	 */
	class BB_Ultimate_Addon_Helper {

		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $creative_modules Category Strings
		 */
		static public $creative_modules = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $content_modules Category Strings
		 */
		static public $content_modules = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $lead_generation Category Strings
		 */
		static public $lead_generation = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $extra_additions Category Strings
		 */
		static public $extra_additions = '';
		static public $woo_modules = '';
		/**
		 * Holds UABB branding short-name.
		 *
		 * @since 1.14.0
		 */
		static public $uabb_brand_short_name = '';

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		function __construct() {

			$this->set_constants();
		}

		/**
		 * Function that set constants for UABB
		 *
		 * @since x.x.x
		 */
		function set_constants() {

			self::$creative_modules	= __( 'Creative Modules', 'uabb' );
			self::$content_modules	= __( 'Content Modules', 'uabb' );
			self::$lead_generation	= __( 'Lead Generation', 'uabb' );
			self::$extra_additions	= __( 'Extra Additions', 'uabb' );
			self::$woo_modules		= __( 'Woo Modules', 'uabb' );
	
			$branding         = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
			$branding_name    = 'UABB';
			$branding_modules = __( 'UABB Modules', 'uabb' );

			// Branding - %s.
			if (
				is_array( $branding ) &&
				array_key_exists( 'uabb-plugin-short-name', $branding ) && '' != $branding['uabb-plugin-short-name'] ) {
				$branding_name = $branding['uabb-plugin-short-name'];
			}

			// Branding - %s Modules.
			if ( 'UABB' != $branding_name ) { /* translators: %s: search term */
				$branding_modules = sprintf( __( '%s', 'uabb' ), $branding_name );
			}

			if ( isset( $branding['uabb-global-module-listing'] ) && $branding['uabb-global-module-listing'] ) {

				$branding_modules = '';
				if ( version_compare( '2.0', FL_BUILDER_VERSION, '>' ) ) {
					$branding_modules = 'Advanced Modules';
				}
			}

			define( 'UABB_PREFIX', $branding_name );
			define( 'UABB_CAT', $branding_modules );
		}

		/**
		 * Function that renders BB's modules category
		 *
		 * @since x.x.x
		 * @param array $cat gets the BB's UI ControlPanel Category.
		 */
		static public function module_cat( $cat ) {
			return class_exists( 'FLBuilderUIContentPanel' ) ? $cat : UABB_CAT;
		}

		/**
		 * Function that renders builder UABB
		 *
		 * @since x.x.x
		 */
		static public function get_builder_uabb() {
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];

			$defaults = array(
				'load_panels'              => 1,
				'uabb-live-preview'        => 1,
				'load_templates'           => 1,
				'uabb-google-map-api'      => '',
				'uabb-colorpicker'         => 1,
				'uabb-row-separator'       => 1,
				'uabb-enable-beta-updates' => 0,
			);

			// if empty add all defaults.
			if ( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				// add new key.
				foreach ( $defaults as $key => $value ) {
					if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
						$uabb[ $key ] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			return apply_filters( 'uabb_get_builder_uabb', $uabb );
		}
		/**
		 * Function that renders extensions for the UABB
		 *
		 * @since x.x.x
		 * @param string $request_key gets the request key's value.
		 */
		static public function get_builder_uabb_branding( $request_key = '' ) {
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb_branding'];

			$defaults = array(
				'uabb-enable-template-cloud' => 1,
			);

			// if empty add all defaults.
			if ( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				// add new key.
				foreach ( $defaults as $key => $value ) {
					if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
						$uabb[ $key ] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			$uabb = apply_filters( 'uabb_get_builder_uabb_branding', $uabb );

			/**
			 * Return specific requested branding value
			 */
			if ( ! empty( $request_key ) ) {
				if ( is_array( $uabb ) ) {
					$uabb = ( array_key_exists( $request_key, $uabb ) ) ? $uabb[ $request_key ] : '';
				}
			}

			return $uabb;
		}

		/**
		 * Function that renders all the UABB modules
		 *
		 * @since x.x.x
		 */
		static public function get_all_modules() {
			$modules_array = array(
				'advanced-accordion'       => 'Advanced Accordion',
				'advanced-icon'            => 'Advanced Icons',
				'uabb-advanced-menu'       => 'Advanced Menu',
				'blog-posts'               => 'Advanced Posts',
				'advanced-separator'       => 'Advanced Separator',
				'advanced-tabs'            => 'Advanced Tabs',
				'uabb-beforeafterslider'   => 'Before After Slider',
				'uabb-button'              => 'Button',
				'uabb-call-to-action'      => 'Call to Action',
				'uabb-contact-form'        => 'Contact Form',
				'uabb-countdown'           => 'Countdown',
				'uabb-numbers'             => 'Counter',
				'creative-link'            => 'Creative Link',
				'dual-button'              => 'Dual Button',
				'dual-color-heading'       => 'Dual Color Heading',
				'fancy-text'               => 'Fancy Text',
				'flip-box'                 => 'Flip Box',
				'google-map'               => 'Google Map',
				'uabb-heading'             => 'Heading',
				'uabb-hotspot'             => 'Hotspot',
				'ihover'                   => 'iHover',
				'image-icon'               => 'Image / Icon',
				'image-separator'          => 'Image Separator',
				'uabb-image-carousel'      => 'Image Carousel',
				'info-banner'              => 'Info Banner',
				'info-box'                 => 'Info Box',
				'info-circle'              => 'Info Circle',
				'info-list'                => 'Info List',
				'info-table'               => 'Info Table',
				'interactive-banner-1'     => 'Interactive Banner 1',
				'interactive-banner-2'     => 'Interactive Banner 2',
				'list-icon'                => 'List Icon',
				'mailchimp-subscribe-form' => 'MailChimp Subscription Form',
				'modal-popup'              => 'Modal Popup',
				'uabb-photo'               => 'Photo',
				'photo-gallery'            => 'Photo Gallery',
				'pricing-box'              => 'Price Box',
				'progress-bar'             => 'Progress Bar',
				'ribbon'                   => 'Ribbon',
				'uabb-separator'           => 'Simple Separator',
				'slide-box'                => 'Slide Box',
				'uabb-social-share'        => 'Social Share',
				'spacer-gap'               => 'Spacer / Gap',
				'team'                     => 'Team',
				'adv-testimonials'         => 'Testimonials',
				'uabb-content-toggle'      => 'Content Toggle',
				'uabb-business-hours'	   => 'Business Hours',
                'uabb-video'               => 'Video',
				'uabb-table'			   => 'Table',
                'uabb-video-gallery'        => 'Video Gallery',
			);

			/* Include Contact form styler */
			if ( class_exists( 'WPCF7_ContactForm' ) ) {
				$modules_array['uabb-contact-form7'] = 'CF7 Styler';
			}
			/* Include Gravity form styler */
			if ( class_exists( 'GFForms' ) ) {
				$modules_array['uabb-gravity-form'] = 'Gravity Forms Styler';
			}
			/* Include WooCommerce modules*/
			if ( class_exists( 'WooCommerce' ) ) {
				$modules_array['uabb-woo-products'] = 'Woo - Products';
				$modules_array['uabb-woo-categories'] = 'Woo - Categories';
				$modules_array['uabb-woo-add-to-cart'] = 'Woo - Add To Cart';
			}
			natcasesort( $modules_array );
			return $modules_array;
		}

		/**
		 * Function that renders extensions for the UABB
		 *
		 * @since x.x.x
		 */
		static public function get_all_extenstions() {
			$extenstions_array = array(
				'uabb-row-separator' => 'Row Separator',
				'uabb-row-gradient'  => 'Row Gradient Background',
				'uabb-col-gradient'  => 'Column Gradient Background',
				'uabb-col-shadow'    => 'Column Shadow',
			);
			return $extenstions_array;
		}

		/**
		 * Function that renders UABB's modules
		 *
		 * @since x.x.x
		 */
		static public function get_builder_uabb_modules() {
			$uabb           = UABB_Init::$uabb_options['fl_builder_uabb_modules'];
			$all_modules    = self::get_all_modules();
			$is_all_modules = true;

			if ( empty( $uabb ) ) {
				$uabb        = self::get_all_modules();
				$uabb['all'] = 'all';
			} else {
				if ( ! isset( $uabb['unset_all'] ) ) {
					// add new key.
					foreach ( $all_modules as $key => $value ) {
						if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
							$uabb[ $key ] = $key;
						}
					}
				}
			}

			if ( false == $is_all_modules && isset( $uabb['all'] ) ) {
				unset( $uabb['all'] );
			}

			$uabb['image-icon']         = 'image-icon';
			$uabb['advanced-separator'] = 'advanced-separator';
			$uabb['uabb-separator']     = 'uabb-separator';
			$uabb['uabb-button']        = 'uabb-button';

			return apply_filters( 'uabb_get_builder_uabb_modules', $uabb );
		}

		/**
		 *  Template status
		 *
		 *  Return the status of pages, sections, presets or all templates. Default: all
		 *
		 *  @param string $templates_type gets the templates type.
		 *  @return boolean
		 */
		public static function is_templates_exist( $templates_type = 'all' ) {

			$templates       = get_site_option( '_uabb_cloud_templats', false );
			$exist_templates = array(
				'page-templates' => 0,
				'sections'       => 0,
				'presets'        => 0,
			);

			if ( is_array( $templates ) && count( $templates ) > 0 ) {
				foreach ( $templates as $type => $type_templates ) {

					// Individual type array - [page-templates], [layout] or [row].
					if ( $type_templates ) {
						foreach ( $type_templates as $template_id => $template_data ) {

							if ( isset( $template_data['status'] ) && true == $template_data['status'] && isset( $template_data['dat_url_local'] ) && ! empty( $template_data['dat_url_local'] ) ) {

								$exist_templates[ $type ] = ( count( ( is_array( $exist_templates[ $type ] ) || is_object( $exist_templates[ $type ] ) ) ? $exist_templates[ $type ] : array() ) + 1 );
							}
						}
					}
				}
			}

			switch ( $templates_type ) {
				case 'page-templates':
								$_templates_exist = ( $exist_templates['page-templates'] >= 1 ) ? true : false;
					break;

				case 'sections':
								$_templates_exist = ( $exist_templates['sections'] >= 1 ) ? true : false;
					break;

				case 'presets':
								$_templates_exist = ( $exist_templates['presets'] >= 1 ) ? true : false;
					break;

				case 'all':
				default:
							$_templates_exist = ( $exist_templates['page-templates'] >= 1 || $exist_templates['sections'] >= 1 || $exist_templates['presets'] >= 1 ) ? true : false;
					break;
			}

			return $_templates_exist;
		}

		/**
		 *  Get link rel attribute
		 *
		 *  @since 1.6.1
		 *  @param string $target gets an string for the link.
		 *  @param string $is_nofollow gets an string for is no follow.
		 *  @param string $echo gets an string for echo.
		 *  @return string
		 */
		static public function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

			$attr = '';
			if ( '_blank' == $target ) {
				$attr .= 'noopener';
			}

			if ( 1 == $is_nofollow || 'yes' == $is_nofollow ) {
				$attr .= ' nofollow';
			}

			if ( '' == $attr ) {
				return;
			}

			$attr = trim( $attr );
			if ( ! $echo ) {
				return 'rel="' . $attr . '"';
			}
			echo 'rel="' . $attr . '"';
		}

		/**
		 * Function that renders UABB's branding short-name
		 *
		 * @since 1.14.0
		 */
		static public function get_uabb_branding() {
			
			$uabb_brand_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

			if ( '' === $uabb_brand_short_name ) {
				$uabb_brand_short_name = __( 'UABB', 'uabb' );
			}

			return $uabb_brand_short_name;
		}
	}	

	new BB_Ultimate_Addon_Helper();
}
