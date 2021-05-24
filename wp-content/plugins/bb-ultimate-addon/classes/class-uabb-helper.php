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
		public static $creative_modules = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $content_modules Category Strings
		 */
		public static $content_modules = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $lead_generation Category Strings
		 */
		public static $lead_generation = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $extra_additions Category Strings
		 */
		public static $extra_additions = '';
		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.3.0
		 * @var $woo_modules Category Strings
		 */
		public static $woo_modules = '';
		/**
		 * Holds UABB branding short-name.
		 *
		 * @since 1.14.0
		 * @var $uabb_brand_short_name Category Strings
		 */
		public static $uabb_brand_short_name = '';
		/**
		 * Checks UABB branding is enabled or not
		 *
		 * @since 1.24.0
		 * @var $is_branding_enabled
		 */
		public static $is_branding_enabled;

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Branding Name
		 *
		 * @var branding_name
		 */
		private static $branding_name;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		public function __construct() {

			$this->set_constants();

			if ( is_admin() ) {

				global $pagenow;

				if ( false !== self::uabb_branding_name() && 'update-core.php' === $pagenow ) {
					add_filter( 'gettext', array( $this, 'get_plugin_branding_name' ), 20, 3 );
				}
				add_filter( 'bsf_product_name_uabb', array( $this, 'uabb_branding_name' ) );
				add_filter( 'bsf_product_author_uabb', array( $this, 'uabb_branding_author_name' ) );
				add_filter( 'bsf_product_description_uabb', array( $this, 'uabb_branding_desc' ) );
				add_filter( 'bsf_product_homepage_uabb', array( $this, 'uabb_branding_url' ) );
				add_filter( 'bsf_product_icons_uabb', array( $this, 'uabb_plugin_icon_url' ) );
			}
			add_action( 'init', __CLASS__ . '::uabb_get_branding_for_docs' );
			add_action( 'wp_head', __CLASS__ . '::uabb_render_faq_schema' );
			add_action( 'wp_footer', __CLASS__ . '::uabb_force_render_faq_schema' );

			if ( ! self::$branding_name ) {
				self::$branding_name = self::get_uabb_whitelabel_string( 'name', false );
			}

			if ( self::$branding_name && '' !== self::$branding_name ) {
				add_filter( 'bsf_white_label_options', array( $this, 'uabb_bsf_analytics_white_label' ) );
			}

		}

		/**
		 * Renders FAQ schema
		 *
		 * @param boolean $force gets if schema is force rendered.
		 */
		public static function uabb_render_faq_schema( $force = false ) {

			$enabled_modules = self::get_builder_uabb_modules();

			if ( array_key_exists( 'uabb-faq', $enabled_modules ) ) {
				if ( ! is_callable( 'FLBuilderModel::get_nodes' ) ) {
					return;
				}

				$schema_data = array(
					'@context'   => 'https://schema.org',
					'@type'      => 'FAQPage',
					'mainEntity' => array(),
				);

				if ( ! $force ) {
					$nodes   = FLBuilderModel::get_nodes();
					$modules = array();

					foreach ( $nodes as $node ) {
						if ( ! is_object( $node ) ) {
							continue;
						}

						if ( 'module' === $node->type ) {
							if ( 'uabb-faq' === $node->settings->type ) {
								$modules[] = $node;
							}
						}

						if ( 'module' !== $node->type && isset( $node->template_id ) ) {
							$template_id      = $node->template_id;
							$template_node_id = $node->template_node_id;
							$post_id          = FLBuilderModel::get_node_template_post_id( $template_id );
							$data             = FLBuilderModel::get_layout_data( 'published', $post_id );

							foreach ( $data as $global_node ) {
								if ( 'module' === $global_node->type && 'uabb-faq' === $global_node->settings->type ) {
									$modules[] = $global_node;
								}
							}
						}
					}

					if ( empty( $modules ) ) {
						return;
					}

					foreach ( $modules as $node ) {
						$settings = $node->settings;

						if ( isset( $settings->enable_schema ) && 'no' === $settings->enable_schema ) {
							continue;
						}

						if ( ! is_callable( 'FLBuilderModel::get_module' ) ) {
							continue;
						}

						$module = FLBuilderModel::get_module( $node );

						$items = $module->get_faq_items();

						$count = count( $items );

						for ( $i = 0; $i < $count; $i++ ) {
							if ( ! is_object( $items[ $i ] ) ) {
								continue;
							}

							$item = (object) array(
								'@type'          => 'Question',
								'name'           => $items[ $i ]->faq_question,
								'acceptedAnswer' => (object) array(
									'@type' => 'Answer',
									'text'  => $items[ $i ]->faq_answer,
								),
							);

							$schema_data['mainEntity'][] = $item;
						}
					}
				} else {
					global $uabb_faq_schema_items;

					$schema_data['mainEntity'] = $uabb_faq_schema_items;
				}

				if ( ! empty( $schema_data['mainEntity'] ) ) {
					echo '<script type="application/ld+json">';
					echo wp_json_encode( $schema_data );
					echo '</script>';
				}
			}
		}

		/**
		 * Renders FAQ schema when module is rendered through
		 * shortcode inside other module.
		 *
		 * @return void
		 */
		public static function uabb_force_render_faq_schema() {
			/**
			 * Hook to determine whether the schema should render
			 * forcefully or not.
			 *
			 * @param bool
			 */
			if ( apply_filters( 'uabb_faq_schema_force_render', false ) ) {
				self::uabb_render_faq_schema( true );
			}
		}

		/**
		 * Return White Label status to BSF Analytics.
		 * Return true if the White Label is enabled from UABB to the BSF Analytics library.
		 *
		 * @since 1.26.7
		 * @param array $bsf_analytics_wl_arr array of white labeled products.
		 * @return array product name with white label status.
		 */
		public function uabb_bsf_analytics_white_label( $bsf_analytics_wl_arr ) {
			if ( ! isset( $bsf_analytics_wl_arr['uabb'] ) ) {
				$bsf_analytics_wl_arr['uabb'] = true;
			}

			return $bsf_analytics_wl_arr;
		}

		/**
		 * Function that set constants for UABB
		 *
		 * @since x.x.x
		 */
		public function set_constants() {

			self::$creative_modules = __( 'Creative Modules', 'uabb' );
			self::$content_modules  = __( 'Content Modules', 'uabb' );
			self::$lead_generation  = __( 'Lead Generation', 'uabb' );
			self::$extra_additions  = __( 'Extra Additions', 'uabb' );
			self::$woo_modules      = __( 'Woo Modules', 'uabb' );

			$branding         = self::get_builder_uabb_branding();
			$branding_name    = 'UABB';
			$branding_modules = __( 'UABB Modules', 'uabb' );

			// Branding - %s.
			if (
				is_array( $branding ) &&
				array_key_exists( 'uabb-plugin-short-name', $branding ) && '' !== $branding['uabb-plugin-short-name'] ) {
				$branding_name = $branding['uabb-plugin-short-name'];
			}

			// Branding - %s Modules.
			if ( 'UABB' !== $branding_name ) { /* translators: %s: search term */
				$branding_modules = sprintf( __( '%s', 'uabb' ), $branding_name ); //phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
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
		public static function module_cat( $cat ) {
			return class_exists( 'FLBuilderUIContentPanel' ) ? $cat : UABB_CAT;
		}
		/**
		 * Function that renders builder UABB Google and Yelp API key status
		 *
		 * @since 1.18.0
		 */
		public static function api_key_status() {

			$status = array();

			$google_status = get_option( 'google_status_code' );

			$yelp_status = get_option( 'yelp_status_code' );

			if ( isset( $google_status ) && ! empty( $google_status ) ) {
				$status ['google_status_code'] = $google_status;
			}
			if ( isset( $yelp_status ) && ! empty( $yelp_status ) ) {
				$status ['yelp_status_code'] = $yelp_status;
			}
			return $status;
		}
		/**
		 * Function that renders builder UABB
		 *
		 * @since x.x.x
		 */
		public static function get_builder_uabb() {
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
		public static function get_builder_uabb_branding( $request_key = '' ) {
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
		public static function get_all_modules() {
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
				'uabb-business-hours'      => 'Business Hours',
				'uabb-video'               => 'Video',
				'uabb-table'               => 'Table',
				'uabb-video-gallery'       => 'Video Gallery',
				'uabb-price-list'          => 'Price List',
				'uabb-marketing-button'    => 'Marketing Button',
				'uabb-business-reviews'    => 'Business Reviews',
				'uabb-off-canvas'          => 'Off Canvas',
				'uabb-retina-image'        => 'Retina Image',
				'uabb-registration-form'   => 'User Registration Form',
				'uabb-table-of-contents'   => 'Table Of Contents',
				'uabb-login-form'          => 'Login Form',
				'uabb-how-to'              => 'How To',
				'uabb-faq'                 => 'FAQ Schema',
				'uabb-devices'             => 'Devices',
				'uabb-search'              => 'Search',
			);

			/* Include Contact form styler */
			if ( class_exists( 'WPCF7_ContactForm' ) ) {
				$modules_array['uabb-contact-form7'] = 'CF7 Styler';
			}
			/* Include Gravity form styler */
			if ( class_exists( 'GFForms' ) ) {
				$modules_array['uabb-gravity-form'] = 'Gravity Forms Styler';
			}
			/* Include WP form styler */
			if ( class_exists( 'WPForms_Pro' ) || class_exists( 'WPForms_Lite' ) ) {
				$modules_array['uabb-wp-forms-styler'] = 'WPForms Styler';
			}
			if ( function_exists( 'wpFluentForm' ) ) {
				$modules_array['uabb-fluent-form-styler'] = 'WP Fluent Forms Styler';
			}
			/* Include WooCommerce modules*/
			if ( class_exists( 'WooCommerce' ) ) {
				$modules_array['uabb-woo-products']    = 'Woo - Products';
				$modules_array['uabb-woo-categories']  = 'Woo - Categories';
				$modules_array['uabb-woo-add-to-cart'] = 'Woo - Add To Cart';
				$modules_array['uabb-woo-mini-cart']   = 'Woo - Mini Cart';
			}
			/* Include Caldera Forms Styler */
			if ( class_exists( 'Caldera_Forms' ) || class_exists( 'Caldera_Forms_Forms' ) ) {
				$forms = \Caldera_Forms_Forms::get_forms( true );
				if ( ! empty( $forms ) ) {
					$modules_array['uabb-caldera-form-styler'] = 'Caldera Forms Styler';
				}
			}
			natcasesort( $modules_array );
			return $modules_array;
		}

		/**
		 * Function that renders extensions for the UABB
		 *
		 * @since x.x.x
		 */
		public static function get_all_extenstions() {
			$extenstions_array = array(
				'uabb-row-separator' => 'Row Separator',
				'uabb-row-gradient'  => 'Row Gradient Background',
				'uabb-col-gradient'  => 'Column Gradient Background',
				'uabb-col-shadow'    => 'Column Shadow',
				'uabb-col-particle'  => 'Column Particle Backgrounds',
				'uabb-row-particle'  => 'Row Particle Backgrounds',
			);
			return $extenstions_array;
		}

		/**
		 * Function that renders UABB's modules
		 *
		 * @since x.x.x
		 */
		public static function get_builder_uabb_modules() {
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

			if ( false === $is_all_modules && isset( $uabb['all'] ) ) {
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

							if ( isset( $template_data['status'] ) && true == $template_data['status'] && isset( $template_data['dat_url_local'] ) && ! empty( $template_data['dat_url_local'] ) ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

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
		public static function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

			$attr = '';
			if ( '_blank' === $target ) {
				$attr .= 'noopener';
			}

			if ( 1 === $is_nofollow || 'yes' === $is_nofollow ) {
				$attr .= ' nofollow';
			}

			if ( '' === $attr ) {
				return;
			}

			$attr = trim( $attr );
			if ( ! $echo ) {
				return 'rel="' . $attr . '"';
			}
			echo 'rel="' . $attr . '"'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Function that renders UABB's branding short-name
		 *
		 * @param String $short_name whitelabel key to be received from the database.
		 * @since 1.14.0
		 */
		public static function get_uabb_branding( $short_name = false ) {
			return self::get_uabb_whitelabel_string( 'short-name', $short_name );
		}
		/**
		 * Function that renders UABB's branding Plugin name
		 *
		 * @param String $name whitelabel key to be received from the database.
		 * @since 1.16.1
		 */
		public function uabb_branding_name( $name = false ) {
			return self::get_uabb_whitelabel_string( 'name', $name );
		}
		/**
		 * Get individual whitelabel setting.
		 *
		 * @since 1.24.3
		 * @param String $key whitelabel key to be received from the database.
		 * @param mixed  $default default value to be retturned if the whitelabel value is not aset by user.
		 *
		 * @return mixed.
		 */
		public static function get_uabb_whitelabel_string( $key, $default = false ) {

			$label_key = 'uabb-plugin-' . $key;

			$branding_name = self::get_builder_uabb_branding( $label_key );

			if ( ! empty( $branding_name ) ) {
				return $branding_name;
			}

			return $default;
		}
		/**
		 * Function that checks if UABB's branding is enabled
		 *
		 * @since 1.24.0
		 */
		public static function uabb_get_branding_for_docs() {

			if ( null === self::$is_branding_enabled ) {

				$branding_name       = self::get_uabb_whitelabel_string( 'name', false );
				$branding_short_name = self::get_uabb_whitelabel_string( 'short-name', false );

				if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
					self::$is_branding_enabled = 'no';
				} else {
					self::$is_branding_enabled = 'yes';
				}
			}
		}
		/**
		 * Function that renders UABB's branding Plugin Author name
		 *
		 * @param String $author_name whitelabel key to be received from the database.
		 * @since 1.16.1
		 */
		public function uabb_branding_author_name( $author_name = false ) {
			return self::get_uabb_whitelabel_string( 'author-name', $author_name );
		}
		/**
		 * Function that renders UABB's branding Plugin description
		 *
		 * @param String $desc whitelabel key to be received from the database.
		 * @since 1.16.1
		 */
		public function uabb_branding_desc( $desc = false ) {
			return self::get_uabb_whitelabel_string( 'desc', $desc );
		}
		/**
		 * Function that renders UABB's branding Plugin URL
		 *
		 * @param String $url whitelabel key to be received from the database.
		 * @since 1.16.1
		 */
		public function uabb_branding_url( $url = false ) {
			return self::get_uabb_whitelabel_string( 'url', $url );
		}
		/**
		 *  Function that renders UABB's branding Plugin Name
		 *
		 *  @since 1.16.1
		 *  @param string $text gets an string for is plugin name.
		 *  @param string $original an string for the translatable.
		 *  @param string $domain gets an plugin domain.
		 *  @return string
		 */
		public function get_plugin_branding_name( $text, $original, $domain ) {

			if ( 'Ultimate Addons for Beaver Builder' === $original ) {
				$text = self::uabb_whitelabel_name();
			}
			return $text;
		}
		/**
		 * Get UABB whitelabelled name.
		 *
		 * @since 1.24.3
		 * @param String $name Original Product name from Graupi.
		 *
		 * @return String UABB whitelabelled name.
		 */
		public static function uabb_whitelabel_name( $name = false ) {
			return self::get_uabb_whitelabel_string( 'name', $name );
		}
		/**
		 * Function that renders UABB's branding Plugin Icon URL
		 *
		 * @since 1.16.1
		 */
		public function uabb_plugin_icon_url() {

			$icon_url = ( false !== self::get_uabb_whitelabel_string( 'icon-url' ) ) ? self::get_uabb_whitelabel_string( 'icon-url' ) : BB_ULTIMATE_ADDON_URL . 'assets/images/uabb.svg';
			return array(
				'default' => $icon_url,
			);
		}
	}
}
BB_Ultimate_Addon_Helper::get_instance();
