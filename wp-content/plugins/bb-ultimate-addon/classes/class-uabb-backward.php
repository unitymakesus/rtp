<?php
/**
 * Backward compatibility.
 *
 * @since 1.7.0
 * @package BAckward Compatibility
 */

if ( ! class_exists( 'UABB_Plugin_Backward' ) ) {

	/**
	 * UABB_Plugin_Backward initial setup
	 *
	 * @since 1.7.0
	 */
	class UABB_Plugin_Backward {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// UABB Updates.
			add_action( 'wp', array( $this, 'update_data' ) );

			add_action( 'transition_post_status', array( $this, 'post_status' ), 10, 3 );
		}

		/**
		 * Set UABB version for new page.
		 *
		 * @since 1.7.2
		 * @param var $new_status Checks the value if user is new.
		 * @param var $old_status Checks the value if user is old.
		 * @param var $post Checks the value of the post.
		 * @return void
		 */
		public function post_status( $new_status, $old_status, $post ) {

			if ( 'new' === $old_status && 'auto-draft' === $new_status ) {
				/* Update Version */
				update_post_meta( $post->ID, '_uabb_version', BB_ULTIMATE_ADDON_VER );
			}
		}

		/**
		 * Execute Layout Data.
		 *
		 * @since 1.7.2
		 * @param var $post_id Gets the post ID.
		 * @return void
		 */
		public function layout_data_execute( $post_id ) {

			/* Layout Data */
			$layout_data = get_post_meta( $post_id, '_fl_builder_data', true );
			update_post_meta( $post_id, '_fl_builder_data_back', $layout_data );

			if ( is_array( $layout_data ) ) {
				foreach ( $layout_data as $id => $data ) {
					if ( isset( $layout_data[ $id ]->settings->type ) ) {

						switch ( $layout_data[ $id ]->settings->type ) {
							case 'uabb-heading':
								$this->uabb_heading( $layout_data[ $id ]->settings );
								break;
							case 'uabb-image-carousel':
								$this->uabb_image_carousel( $layout_data[ $id ]->settings );
								break;
							case 'uabb-numbers':
								$this->uabb_numbers( $layout_data[ $id ]->settings );
								break;
							case 'adv-testimonials':
								$this->uabb_adv_testimonials( $layout_data[ $id ]->settings );
								break;
							case 'uabb-hotspot':
								$this->uabb_hotspot( $layout_data[ $id ]->settings );
								break;
							case 'advanced-accordion':
								$this->uabb_advanced_accordion( $layout_data[ $id ]->settings );
								break;
							case 'advanced-separator':
								$this->uabb_advanced_separator( $layout_data[ $id ]->settings );
								break;
							case 'uabb-gravity-form':
								$this->uabb_gravity_form( $layout_data[ $id ]->settings );
								break;
							case 'advanced-tabs':
								$this->uabb_advanced_tabs( $layout_data[ $id ]->settings );
								break;
							case 'blog-posts':
								$this->uabb_advanced_posts( $layout_data[ $id ]->settings );
								break;
							case 'creative-link':
								$this->uabb_creative_link( $layout_data[ $id ]->settings );
								break;
							case 'dual-button':
								$this->uabb_dual_button( $layout_data[ $id ]->settings );
								break;
							case 'uabb-countdown':
								$this->uabb_countdown( $layout_data[ $id ]->settings );
								break;
							case 'dual-color-heading':
								$this->uabb_dual_color_heading( $layout_data[ $id ]->settings );
								break;
							case 'fancy-text':
								$this->uabb_fancy_text( $layout_data[ $id ]->settings );
								break;
							case 'flip-box':
								$this->uabb_flip_box( $layout_data[ $id ]->settings );
								break;
							case 'ihover':
								$this->uabb_ihover( $layout_data[ $id ]->settings );
								break;
							case 'info-banner':
								$this->uabb_info_banner( $layout_data[ $id ]->settings );
								break;
							case 'info-box':
								$this->uabb_info_box( $layout_data[ $id ]->settings );
								break;
							case 'info-circle':
								$this->uabb_info_circle( $layout_data[ $id ]->settings );
								break;
							case 'info-list':
								$this->uabb_info_list( $layout_data[ $id ]->settings );
								break;
							case 'info-table':
								$this->uabb_info_table( $layout_data[ $id ]->settings );
								break;
							case 'interactive-banner-1':
								$this->uabb_interactive_banner_one( $layout_data[ $id ]->settings );
								break;
							case 'interactive-banner-2':
								$this->uabb_interactive_banner_two( $layout_data[ $id ]->settings );
								break;
							case 'list-icon':
								$this->uabb_list_icon( $layout_data[ $id ]->settings );
								break;
							case 'mailchimp-subscribe-form':
								$this->uabb_mailchimp_subscribe_form( $layout_data[ $id ]->settings );
								break;
							case 'modal-popup':
								$this->uabb_modal_popup( $layout_data[ $id ]->settings );
								break;
							case 'photo-gallery':
								$this->uabb_photo_gallery( $layout_data[ $id ]->settings );
								break;
							case 'pricing-box':
								$this->uabb_pricing_box( $layout_data[ $id ]->settings );
								break;
							case 'uabb-contact-form7':
								$this->uabb_contact_form7( $layout_data[ $id ]->settings );
								break;
							case 'uabb-contact-form':
								$this->uabb_contact_form( $layout_data[ $id ]->settings );
								break;
							case 'uabb-call-to-action':
								$this->uabb_call_to_action( $layout_data[ $id ]->settings );
								break;
							case 'uabb-button':
								$this->uabb_button( $layout_data[ $id ]->settings );
								break;
							case 'uabb-beforeafterslider':
								$this->uabb_beforeafterslider( $layout_data[ $id ]->settings );
								break;
							case 'uabb-advanced-menu':
								$this->uabb_advanced_menu( $layout_data[ $id ]->settings );
								break;
							case 'team':
								$this->team( $layout_data[ $id ]->settings );
								break;
							case 'slide-box':
								$this->slide_box( $layout_data[ $id ]->settings );
								break;
							case 'ribbon':
								$this->ribbon( $layout_data[ $id ]->settings );
								break;
							case 'progress-bar':
								$this->progress_bar( $layout_data[ $id ]->settings );
								break;

							default:
								break;
						}
					}
				}

				update_post_meta( $post_id, '_fl_builder_data', $layout_data );

				$layout_data = null;
				unset( $layout_data );
			}
		}

		/**
		 * Execute Layout Draft.
		 *
		 * @since 1.7.2
		 * @param var $post_id gets the Post ID of the layout draft execute.
		 * @return void
		 */
		public function layout_draft_execute( $post_id ) {

			/* Layout Draft */
			$layout_draft = get_post_meta( $post_id, '_fl_builder_draft', true );
			update_post_meta( $post_id, '_fl_builder_draft_back', $layout_draft );

			if ( is_array( $layout_draft ) ) {
				foreach ( $layout_draft as $id => $data ) {
					if ( isset( $layout_draft[ $id ]->settings->type ) ) {

						switch ( $layout_draft[ $id ]->settings->type ) {
							case 'uabb-heading':
								$this->uabb_heading( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-image-carousel':
								$this->uabb_image_carousel( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-numbers':
								$this->uabb_numbers( $layout_draft[ $id ]->settings );
								break;
							case 'adv-testimonials':
								$this->uabb_adv_testimonials( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-hotspot':
								$this->uabb_hotspot( $layout_draft[ $id ]->settings );
								break;
							case 'advanced-accordion':
								$this->uabb_advanced_accordion( $layout_draft[ $id ]->settings );
								break;
							case 'advanced-separator':
								$this->uabb_advanced_separator( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-gravity-form':
								$this->uabb_gravity_form( $layout_draft[ $id ]->settings );
								break;
							case 'advanced-tabs':
								$this->uabb_advanced_tabs( $layout_draft[ $id ]->settings );
								break;
							case 'blog-posts':
								$this->uabb_advanced_posts( $layout_draft[ $id ]->settings );
								break;
							case 'creative-link':
								$this->uabb_creative_link( $layout_draft[ $id ]->settings );
								break;
							case 'dual-button':
								$this->uabb_dual_button( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-countdown':
								$this->uabb_countdown( $layout_draft[ $id ]->settings );
								break;
							case 'dual-color-heading':
								$this->uabb_dual_color_heading( $layout_draft[ $id ]->settings );
								break;
							case 'fancy-text':
								$this->uabb_fancy_text( $layout_draft[ $id ]->settings );
								break;
							case 'flip-box':
								$this->uabb_flip_box( $layout_draft[ $id ]->settings );
								break;
							case 'ihover':
								$this->uabb_ihover( $layout_draft[ $id ]->settings );
								break;
							case 'info-banner':
								$this->uabb_info_banner( $layout_draft[ $id ]->settings );
								break;
							case 'info-box':
								$this->uabb_info_box( $layout_draft[ $id ]->settings );
								break;
							case 'info-circle':
								$this->uabb_info_circle( $layout_draft[ $id ]->settings );
								break;
							case 'info-list':
								$this->uabb_info_list( $layout_draft[ $id ]->settings );
								break;
							case 'info-table':
								$this->uabb_info_table( $layout_draft[ $id ]->settings );
								break;
							case 'interactive-banner-1':
								$this->uabb_interactive_banner_one( $layout_draft[ $id ]->settings );
								break;
							case 'interactive-banner-2':
								$this->uabb_interactive_banner_two( $layout_draft[ $id ]->settings );
								break;
							case 'list-icon':
								$this->uabb_list_icon( $layout_draft[ $id ]->settings );
								break;
							case 'mailchimp-subscribe-form':
								$this->uabb_mailchimp_subscribe_form( $layout_draft[ $id ]->settings );
								break;
							case 'modal-popup':
								$this->uabb_modal_popup( $layout_draft[ $id ]->settings );
								break;
							case 'photo-gallery':
								$this->uabb_photo_gallery( $layout_draft[ $id ]->settings );
								break;
							case 'pricing-box':
								$this->uabb_pricing_box( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-contact-form7':
								$this->uabb_contact_form7( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-contact-form':
								$this->uabb_contact_form( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-call-to-action':
								$this->uabb_call_to_action( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-button':
								$this->uabb_button( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-beforeafterslider':
								$this->uabb_beforeafterslider( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-advanced-menu':
								$this->uabb_advanced_menu( $layout_draft[ $id ]->settings );
								break;
							case 'team':
								$this->team( $layout_draft[ $id ]->settings );
								break;
							case 'slide-box':
								$this->slide_box( $layout_draft[ $id ]->settings );
								break;
							case 'ribbon':
								$this->ribbon( $layout_draft[ $id ]->settings );
								break;
							case 'progress-bar':
								$this->progress_bar( $layout_draft[ $id ]->settings );
								break;

							default:
								break;
						}
					}
				}

				update_post_meta( $post_id, '_fl_builder_draft', $layout_draft );

				$layout_draft = null;
				unset( $layout_draft );
			}
		}

		/**
		 * Implement UABB update logic.
		 *
		 * @since 1.7.2
		 * @return void
		 */
		public function update_data() {
			// Enable editing if the builder is active.
			if ( UABB_Compatibility::check_bb_version() ) {
				return;
			}

			if ( ! FLBuilderModel::is_builder_active() && FLBuilderAJAX::doing_ajax() ) {
				return;
			}

			$update_journey = get_option( '_journey_details', '0' );

			$new_user = get_option( '_uabb_1_7_2_ver', '0' );

			if ( 'yes' == $new_user ) {
				return;
			}

			$post_id = get_the_ID();

			$new_page = get_post_meta( $post_id, '_uabb_version', true );

			if ( '' !== $new_page ) {
				return;
			}

			$flag = get_post_meta( $post_id, '_uabb_converted', true );

			if ( 'yes' === $flag ) {
				return;
			}

			$this->layout_data_execute( $post_id );

			$this->layout_draft_execute( $post_id );

			/* Update Flag */
			update_post_meta( $post_id, '_uabb_converted', 'yes' );
		}

		/**
		 * UABB Heading.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_heading( &$settings ) {

			if ( isset( $settings->new_font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->new_font_size['small'];
			}
			if ( isset( $settings->new_font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->new_font_size['medium'];
			}
			if ( isset( $settings->new_font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->new_font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->new_font_size['small'] ) && 0 != $settings->new_font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {

				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->new_font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->new_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->new_font_size['medium'] ) && 0 != $settings->new_font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->new_font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->new_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->new_font_size['desktop'] ) && 0 != $settings->new_font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->new_font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->new_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_size_unit_responsive = $settings->desc_font_size['small'];
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_size_unit_medium = $settings->desc_font_size['medium'];
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_size_unit = $settings->desc_font_size['desktop'];
			}

			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_line_height_unit_responsive = round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_line_height_unit_medium = round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_line_height_unit = round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->separator_text_font_size['small'] ) && ! isset( $settings->separator_text_font_size_unit_responsive ) ) {
				$settings->separator_text_font_size_unit_responsive = $settings->separator_text_font_size['small'];
			}
			if ( isset( $settings->separator_text_font_size['medium'] ) && ! isset( $settings->separator_text_font_size_unit_medium ) ) {
				$settings->separator_text_font_size_unit_medium = $settings->separator_text_font_size['medium'];
			}
			if ( isset( $settings->separator_text_font_size['desktop'] ) && ! isset( $settings->separator_text_font_size_unit ) ) {
				$settings->separator_text_font_size_unit = $settings->separator_text_font_size['desktop'];
			}

			if ( isset( $settings->separator_text_line_height['small'] ) && isset( $settings->separator_text_font_size['small'] ) && 0 != $settings->separator_text_font_size['small'] && ! isset( $settings->separator_text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->separator_text_line_height['small'] ) && is_numeric( $settings->separator_text_font_size['small'] ) ) {
					$settings->separator_text_line_height_unit_responsive = round( $settings->separator_text_line_height['small'] / $settings->separator_text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->separator_text_line_height['medium'] ) && isset( $settings->separator_text_font_size['medium'] ) && 0 != $settings->separator_text_font_size['medium'] && ! isset( $settings->separator_text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->separator_text_line_height['medium'] ) && is_numeric( $settings->separator_text_font_size['medium'] ) ) {
					$settings->separator_text_line_height_unit_medium = round( $settings->separator_text_line_height['medium'] / $settings->separator_text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->separator_text_line_height['desktop'] ) && isset( $settings->separator_text_font_size['desktop'] ) && 0 != $settings->separator_text_font_size['desktop'] && ! isset( $settings->separator_text_line_height_unit ) ) {
				if ( is_numeric( $settings->separator_text_line_height['desktop'] ) && is_numeric( $settings->separator_text_font_size['desktop'] ) ) {
					$settings->separator_text_line_height_unit = round( $settings->separator_text_line_height['desktop'] / $settings->separator_text_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Image Carousel.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_image_carousel( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Numbers.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_numbers( &$settings ) {

			if ( isset( $settings->num_font_size['small'] ) && ! isset( $settings->num_font_size_unit_responsive ) ) {
				$settings->num_font_size_unit_responsive = $settings->num_font_size['small'];
			}
			if ( isset( $settings->num_font_size['medium'] ) && ! isset( $settings->num_font_size_unit_medium ) ) {
				$settings->num_font_size_unit_medium = $settings->num_font_size['medium'];
			}
			if ( isset( $settings->num_font_size['desktop'] ) && ! isset( $settings->num_font_size_unit ) ) {
				$settings->num_font_size_unit = $settings->num_font_size['desktop'];
			}

			if ( isset( $settings->num_line_height['small'] ) && isset( $settings->num_font_size['small'] ) && 0 != $settings->num_font_size['small'] && ! isset( $settings->num_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->num_line_height['small'] ) && is_numeric( $settings->num_font_size['small'] ) ) {
					$settings->num_line_height_unit_responsive = round( $settings->num_line_height['small'] / $settings->num_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->num_line_height['medium'] ) && isset( $settings->num_font_size['medium'] ) && 0 != $settings->num_font_size['medium'] && ! isset( $settings->num_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->num_line_height['medium'] ) && is_numeric( $settings->num_font_size['medium'] ) ) {
					$settings->num_line_height_unit_medium = round( $settings->num_line_height['medium'] / $settings->num_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->num_line_height['desktop'] ) && isset( $settings->num_font_size['desktop'] ) && 0 != $settings->num_font_size['desktop'] && ! isset( $settings->num_line_height_unit ) ) {
				if ( is_numeric( $settings->num_line_height['desktop'] ) && is_numeric( $settings->num_font_size['desktop'] ) ) {
					$settings->num_line_height_unit = round( $settings->num_line_height['desktop'] / $settings->num_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->ba_font_size['small'] ) && ! isset( $settings->ba_font_size_unit_responsive ) ) {
				$settings->ba_font_size_unit_responsive = $settings->ba_font_size['small'];
			}
			if ( isset( $settings->ba_font_size['medium'] ) && ! isset( $settings->ba_font_size_unit_medium ) ) {
				$settings->ba_font_size_unit_medium = $settings->ba_font_size['medium'];
			}
			if ( isset( $settings->ba_font_size['desktop'] ) && ! isset( $settings->ba_font_size_unit ) ) {
				$settings->ba_font_size_unit = $settings->ba_font_size['desktop'];
			}

			if ( isset( $settings->ba_line_height['small'] ) && isset( $settings->ba_font_size['small'] ) && 0 != $settings->ba_font_size['small'] && ! isset( $settings->ba_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->ba_line_height['small'] ) && is_numeric( $settings->ba_font_size['small'] ) ) {
					$settings->ba_line_height_unit_responsive = round( $settings->ba_line_height['small'] / $settings->ba_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->ba_line_height['medium'] ) && isset( $settings->ba_font_size['medium'] ) && 0 != $settings->ba_font_size['medium'] && ! isset( $settings->ba_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->ba_line_height['medium'] ) && is_numeric( $settings->ba_font_size['medium'] ) ) {
					$settings->ba_line_height_unit_medium = round( $settings->ba_line_height['medium'] / $settings->ba_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->ba_line_height['desktop'] ) && isset( $settings->ba_font_size['desktop'] ) && 0 != $settings->ba_font_size['desktop'] && ! isset( $settings->ba_line_height_unit ) ) {
				if ( is_numeric( $settings->ba_line_height['desktop'] ) && is_numeric( $settings->ba_font_size['desktop'] ) ) {
					$settings->ba_line_height_unit = round( $settings->ba_line_height['desktop'] / $settings->ba_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Advanced Testimonials.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_adv_testimonials( &$settings ) {

			if ( isset( $settings->testimonial_heading_font_size['small'] ) && ! isset( $settings->testimonial_heading_font_size_unit_responsive ) ) {
				$settings->testimonial_heading_font_size_unit_responsive = $settings->testimonial_heading_font_size['small'];
			}
			if ( isset( $settings->testimonial_heading_font_size['medium'] ) && ! isset( $settings->testimonial_heading_font_size_unit_medium ) ) {
				$settings->testimonial_heading_font_size_unit_medium = $settings->testimonial_heading_font_size['medium'];
			}
			if ( isset( $settings->testimonial_heading_font_size['desktop'] ) && ! isset( $settings->testimonial_heading_font_size_unit ) ) {
				$settings->testimonial_heading_font_size_unit = $settings->testimonial_heading_font_size['desktop'];
			}

			if ( isset( $settings->testimonial_heading_line_height['small'] ) && isset( $settings->testimonial_heading_font_size['small'] ) && 0 != $settings->testimonial_heading_font_size['small'] && ! isset( $settings->testimonial_heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['small'] ) && is_numeric( $settings->testimonial_heading_font_size['small'] ) ) {
					$settings->testimonial_heading_line_height_unit_responsive = round( $settings->testimonial_heading_line_height['small'] / $settings->testimonial_heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->testimonial_heading_line_height['medium'] ) && isset( $settings->testimonial_heading_font_size['medium'] ) && 0 != $settings->testimonial_heading_font_size['medium'] && ! isset( $settings->testimonial_heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['medium'] ) && is_numeric( $settings->testimonial_heading_font_size['medium'] ) ) {
					$settings->testimonial_heading_line_height_unit_medium = round( $settings->testimonial_heading_line_height['medium'] / $settings->testimonial_heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->testimonial_heading_line_height['desktop'] ) && isset( $settings->testimonial_heading_font_size['desktop'] ) && 0 != $settings->testimonial_heading_font_size['desktop'] && ! isset( $settings->testimonial_heading_line_height_unit ) ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['desktop'] ) && is_numeric( $settings->testimonial_heading_font_size['desktop'] ) ) {
					$settings->testimonial_heading_line_height_unit = round( $settings->testimonial_heading_line_height['desktop'] / $settings->testimonial_heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->testimonial_designation_font_size['small'] ) && ! isset( $settings->testimonial_designation_font_size_unit_responsive ) ) {
				$settings->testimonial_designation_font_size_unit_responsive = $settings->testimonial_designation_font_size['small'];
			}
			if ( isset( $settings->testimonial_designation_font_size['medium'] ) && ! isset( $settings->testimonial_designation_font_size_unit_medium ) ) {
				$settings->testimonial_designation_font_size_unit_medium = $settings->testimonial_designation_font_size['medium'];
			}
			if ( isset( $settings->testimonial_designation_font_size['desktop'] ) && ! isset( $settings->testimonial_designation_font_size_unit ) ) {
				$settings->testimonial_designation_font_size_unit = $settings->testimonial_designation_font_size['desktop'];
			}

			if ( isset( $settings->testimonial_designation_line_height['small'] ) && isset( $settings->testimonial_designation_font_size['small'] ) && 0 != $settings->testimonial_designation_font_size['small'] && ! isset( $settings->testimonial_designation_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['small'] ) && is_numeric( $settings->testimonial_designation_font_size['small'] ) ) {
					$settings->testimonial_designation_line_height_unit_responsive = round( $settings->testimonial_designation_line_height['small'] / $settings->testimonial_designation_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->testimonial_designation_line_height['medium'] ) && isset( $settings->testimonial_designation_font_size['medium'] ) && 0 != $settings->testimonial_designation_font_size['medium'] && ! isset( $settings->testimonial_designation_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['medium'] ) && is_numeric( $settings->testimonial_designation_font_size['medium'] ) ) {
					$settings->testimonial_designation_line_height_unit_medium = round( $settings->testimonial_designation_line_height['medium'] / $settings->testimonial_designation_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->testimonial_designation_line_height['desktop'] ) && isset( $settings->testimonial_designation_font_size['desktop'] ) && 0 != $settings->testimonial_designation_font_size['desktop'] && ! isset( $settings->testimonial_designation_line_height_unit ) ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['desktop'] ) && is_numeric( $settings->testimonial_designation_font_size['desktop'] ) ) {
					$settings->testimonial_designation_line_height_unit = round( $settings->testimonial_designation_line_height['desktop'] / $settings->testimonial_designation_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->testimonial_description_opt_font_size['small'] ) && ! isset( $settings->testimonial_description_opt_font_size_unit_responsive ) ) {
				$settings->testimonial_description_opt_font_size_unit_responsive = $settings->testimonial_description_opt_font_size['small'];
			}
			if ( isset( $settings->testimonial_description_opt_font_size['medium'] ) && ! isset( $settings->testimonial_description_opt_font_size_unit_medium ) ) {
				$settings->testimonial_description_opt_font_size_unit_medium = $settings->testimonial_description_opt_font_size['medium'];
			}
			if ( isset( $settings->testimonial_description_opt_font_size['desktop'] ) && ! isset( $settings->testimonial_description_opt_font_size_unit ) ) {
				$settings->testimonial_description_opt_font_size_unit = $settings->testimonial_description_opt_font_size['desktop'];
			}

			if ( isset( $settings->testimonial_description_opt_line_height['small'] ) && isset( $settings->testimonial_description_opt_font_size['small'] ) && 0 != $settings->testimonial_description_opt_font_size['small'] && ! isset( $settings->testimonial_description_opt_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->testimonial_description_opt_line_height['small'] ) && is_numeric( $settings->testimonial_description_opt_font_size['small'] ) ) {
					$settings->testimonial_description_opt_line_height_unit_responsive = round( $settings->testimonial_description_opt_line_height['small'] / $settings->testimonial_description_opt_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->testimonial_description_opt_line_height['medium'] ) && isset( $settings->testimonial_description_opt_font_size['medium'] ) && 0 != $settings->testimonial_description_opt_font_size['medium'] && ! isset( $settings->testimonial_description_opt_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->testimonial_description_opt_line_height['medium'] ) && is_numeric( $settings->testimonial_description_opt_font_size['medium'] ) ) {
					$settings->testimonial_description_opt_line_height_unit_medium = round( $settings->testimonial_description_opt_line_height['medium'] / $settings->testimonial_description_opt_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->testimonial_description_opt_line_height['desktop'] ) && isset( $settings->testimonial_description_opt_font_size['desktop'] ) && 0 != $settings->testimonial_description_opt_font_size['desktop'] && ! isset( $settings->testimonial_description_opt_line_height_unit ) ) {
				if ( is_numeric( $settings->testimonial_description_opt_line_height['desktop'] ) && is_numeric( $settings->testimonial_description_opt_font_size['desktop'] ) ) {
					$settings->testimonial_description_opt_line_height_unit = round( $settings->testimonial_description_opt_line_height['desktop'] / $settings->testimonial_description_opt_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->rating_font_size['small'] ) && ! isset( $settings->rating_font_size_unit_responsive ) ) {
				$settings->rating_font_size_unit_responsive = $settings->rating_font_size['small'];
			}
			if ( isset( $settings->rating_font_size['medium'] ) && ! isset( $settings->rating_font_size_unit_medium ) ) {
				$settings->rating_font_size_unit_medium = $settings->rating_font_size['medium'];
			}
			if ( isset( $settings->rating_font_size['desktop'] ) && ! isset( $settings->rating_font_size_unit ) ) {
				$settings->rating_font_size_unit = $settings->rating_font_size['desktop'];
			}
		}

		/**
		 * UABB Hotspot.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_hotspot( &$settings ) {

			$count_marker = count( $settings->hotspot_marker );

			for ( $i = 0; $i < $count_marker; $i++ ) {

				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive = $settings->hotspot_marker[ $i ]->text_typography_font_size->small;
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ) ) {
					$settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium = $settings->hotspot_marker[ $i ]->text_typography_font_size->medium;
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ) ) {
					$settings->hotspot_marker[ $i ]->text_typography_font_size_unit = $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop;
				}

				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->small ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) && 0 != $settings->hotspot_marker[ $i ]->text_typography_font_size->small && ! isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->small ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) ) {
						$settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive = round( $settings->hotspot_marker[ $i ]->text_typography_line_height->small / $settings->hotspot_marker[ $i ]->text_typography_font_size->small );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) && 0 != $settings->hotspot_marker[ $i ]->text_typography_font_size->medium && ! isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) ) {
						$settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium = round( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium / $settings->hotspot_marker[ $i ]->text_typography_font_size->medium );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) && 0 != $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop && ! isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) ) {
						$settings->hotspot_marker[ $i ]->text_typography_line_height_unit = round( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop / $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop );
					}
				}

				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive = $settings->hotspot_marker[ $i ]->tooltip_font_size->small;
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium = $settings->hotspot_marker[ $i ]->tooltip_font_size->medium;
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_size_unit = $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop;
				}

				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->small ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) && 0 != $settings->hotspot_marker[ $i ]->tooltip_font_size->small && ! isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->small ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive = round( $settings->hotspot_marker[ $i ]->tooltip_line_height->small / $settings->hotspot_marker[ $i ]->tooltip_font_size->small );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) && 0 != $settings->hotspot_marker[ $i ]->tooltip_font_size->medium && ! isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium = round( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium / $settings->hotspot_marker[ $i ]->tooltip_font_size->medium );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) && 0 != $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop && ! isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_line_height_unit = round( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop / $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop );
					}
				}

				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) && ! isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->hotspot_marker[ $i ]->tooltip_padding );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}

					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top    = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left   = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right  = '';

					for ( $j = 0; $j < count( $output ); $j++ ) {

						switch ( $output[ $j ][0] ) {
							case 'padding-top':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-bottom':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-right':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-left':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top    = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left   = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right  = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
						}
					}
				}

				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) && ! isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->hotspot_marker[ $i ]->text_typography_padding );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}

					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top    = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left   = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right  = '';

					for ( $j = 0; $j < count( $output ); $j++ ) {

						switch ( $output[ $j ][0] ) {
							case 'padding-top':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-bottom':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-right':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-left':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top    = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left   = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right  = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
						}
					}
				}
			}
		}

		/**
		 * UABB Advanced Accordion.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_advanced_accordion( &$settings ) {

			if ( isset( $settings->title_spacing ) && ! isset( $settings->title_spacing_dimension_top ) && ! isset( $settings->title_spacing_dimension_bottom ) && ! isset( $settings->title_spacing_dimension_left ) && ! isset( $settings->title_spacing_dimension_right ) ) {

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
			}

			if ( isset( $settings->content_spacing ) && ! isset( $settings->content_spacing_dimension_top ) && ! isset( $settings->content_spacing_dimension_bottom ) && ! isset( $settings->content_spacing_dimension_left ) && ! isset( $settings->content_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_spacing_dimension_top    = '';
				$settings->content_spacing_dimension_bottom = '';
				$settings->content_spacing_dimension_left   = '';
				$settings->content_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->content_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->content_font_size['small'] ) && ! isset( $settings->content_font_size_unit_responsive ) ) {
				$settings->content_font_size_unit_responsive = $settings->content_font_size['small'];
			}
			if ( isset( $settings->content_font_size['medium'] ) && ! isset( $settings->content_font_size_unit_medium ) ) {
				$settings->content_font_size_unit_medium = $settings->content_font_size['medium'];
			}
			if ( isset( $settings->content_font_size['desktop'] ) && ! isset( $settings->content_font_size_unit ) ) {
				$settings->content_font_size_unit = $settings->content_font_size['desktop'];
			}

			if ( isset( $settings->content_line_height['small'] ) && isset( $settings->content_font_size['small'] ) && 0 != $settings->content_font_size['small'] && ! isset( $settings->content_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->content_line_height['small'] ) && is_numeric( $settings->content_font_size['small'] ) ) {
					$settings->content_line_height_unit_responsive = round( $settings->content_line_height['small'] / $settings->content_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->content_line_height['medium'] ) && isset( $settings->content_font_size['medium'] ) && 0 != $settings->content_font_size['medium'] && ! isset( $settings->content_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->content_line_height['medium'] ) && is_numeric( $settings->content_font_size['medium'] ) ) {
					$settings->content_line_height_unit_medium = round( $settings->content_line_height['medium'] / $settings->content_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->content_line_height['desktop'] ) && isset( $settings->content_font_size['desktop'] ) && 0 != $settings->content_font_size['desktop'] && ! isset( $settings->content_line_height_unit ) ) {
				if ( is_numeric( $settings->content_line_height['desktop'] ) && is_numeric( $settings->content_font_size['desktop'] ) ) {
					$settings->content_line_height_unit = round( $settings->content_line_height['desktop'] / $settings->content_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Advanced Separator.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_advanced_separator( &$settings ) {

			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_size_unit_responsive = $settings->text_font_size['small'];
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_size_unit_medium = $settings->text_font_size['medium'];
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_size_unit = $settings->text_font_size['desktop'];
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_line_height_unit_responsive = round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_line_height_unit_medium = round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_line_height_unit = round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Gravity Form.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_gravity_form( &$settings ) {

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->form_title_font_size['small'] ) && ! isset( $settings->form_title_font_size_unit_responsive ) ) {
				$settings->form_title_font_size_unit_responsive = $settings->form_title_font_size['small'];
			}
			if ( isset( $settings->form_title_font_size['medium'] ) && ! isset( $settings->form_title_font_size_unit_medium ) ) {
				$settings->form_title_font_size_unit_medium = $settings->form_title_font_size['medium'];
			}
			if ( isset( $settings->form_title_font_size['desktop'] ) && ! isset( $settings->form_title_font_size_unit ) ) {
				$settings->form_title_font_size_unit = $settings->form_title_font_size['desktop'];
			}

			if ( isset( $settings->form_title_line_height['small'] ) && isset( $settings->form_title_font_size['small'] ) && 0 != $settings->form_title_font_size['small'] && ! isset( $settings->form_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_title_line_height['small'] ) && is_numeric( $settings->form_title_font_size['small'] ) ) {
					$settings->form_title_line_height_unit_responsive = round( $settings->form_title_line_height['small'] / $settings->form_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->form_title_line_height['medium'] ) && isset( $settings->form_title_font_size['medium'] ) && 0 != $settings->form_title_font_size['medium'] && ! isset( $settings->form_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_title_line_height['medium'] ) && is_numeric( $settings->form_title_font_size['medium'] ) ) {
					$settings->form_title_line_height_unit_medium = round( $settings->form_title_line_height['medium'] / $settings->form_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->form_title_line_height['desktop'] ) && isset( $settings->form_title_font_size['desktop'] ) && 0 != $settings->form_title_font_size['desktop'] && ! isset( $settings->form_title_line_height_unit ) ) {
				if ( is_numeric( $settings->form_title_line_height['desktop'] ) && is_numeric( $settings->form_title_font_size['desktop'] ) ) {
					$settings->form_title_line_height_unit = round( $settings->form_title_line_height['desktop'] / $settings->form_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->form_desc_font_size['small'] ) && ! isset( $settings->form_desc_font_size_unit_responsive ) ) {
				$settings->form_desc_font_size_unit_responsive = $settings->form_desc_font_size['small'];
			}
			if ( isset( $settings->form_desc_font_size['medium'] ) && ! isset( $settings->form_desc_font_size_unit_medium ) ) {
				$settings->form_desc_font_size_unit_medium = $settings->form_desc_font_size['medium'];
			}
			if ( isset( $settings->form_desc_font_size['desktop'] ) && ! isset( $settings->form_desc_font_size_unit ) ) {
				$settings->form_desc_font_size_unit = $settings->form_desc_font_size['desktop'];
			}

			if ( isset( $settings->form_desc_line_height['small'] ) && isset( $settings->form_desc_font_size['small'] ) && 0 != $settings->form_desc_font_size['small'] && ! isset( $settings->form_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_desc_line_height['small'] ) && is_numeric( $settings->form_desc_font_size['small'] ) ) {
					$settings->form_desc_line_height_unit_responsive = round( $settings->form_desc_line_height['small'] / $settings->form_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->form_desc_line_height['medium'] ) && isset( $settings->form_desc_font_size['medium'] ) && 0 != $settings->form_desc_font_size['medium'] && ! isset( $settings->form_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_desc_line_height['medium'] ) && is_numeric( $settings->form_desc_font_size['medium'] ) ) {
					$settings->form_desc_line_height_unit_medium = round( $settings->form_desc_line_height['medium'] / $settings->form_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->form_desc_line_height['desktop'] ) && isset( $settings->form_desc_font_size['desktop'] ) && 0 != $settings->form_desc_font_size['desktop'] && ! isset( $settings->form_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->form_desc_line_height['desktop'] ) && is_numeric( $settings->form_desc_font_size['desktop'] ) ) {
					$settings->form_desc_line_height_unit = round( $settings->form_desc_line_height['desktop'] / $settings->form_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->label_font_size['small'] ) && ! isset( $settings->label_font_size_unit_responsive ) ) {
				$settings->label_font_size_unit_responsive = $settings->label_font_size['small'];
			}
			if ( isset( $settings->label_font_size['medium'] ) && ! isset( $settings->label_font_size_unit_medium ) ) {
				$settings->label_font_size_unit_medium = $settings->label_font_size['medium'];
			}
			if ( isset( $settings->label_font_size['desktop'] ) && ! isset( $settings->label_font_size_unit ) ) {
				$settings->label_font_size_unit = $settings->label_font_size['desktop'];
			}

			if ( isset( $settings->label_line_height['small'] ) && isset( $settings->label_font_size['small'] ) && 0 != $settings->label_font_size['small'] && ! isset( $settings->label_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->label_line_height['small'] ) && is_numeric( $settings->label_font_size['small'] ) ) {
					$settings->label_line_height_unit_responsive = round( $settings->label_line_height['small'] / $settings->label_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['medium'] ) && isset( $settings->label_font_size['medium'] ) && 0 != $settings->label_font_size['medium'] && ! isset( $settings->label_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->label_line_height['medium'] ) && is_numeric( $settings->label_font_size['medium'] ) ) {
					$settings->label_line_height_unit_medium = round( $settings->label_line_height['medium'] / $settings->label_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['desktop'] ) && isset( $settings->label_font_size['desktop'] ) && 0 != $settings->label_font_size['desktop'] && ! isset( $settings->label_line_height_unit ) ) {
				if ( is_numeric( $settings->label_line_height['desktop'] ) && is_numeric( $settings->label_font_size['desktop'] ) ) {
					$settings->label_line_height_unit = round( $settings->label_line_height['desktop'] / $settings->label_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->radio_checkbox_font_size['small'] ) && ! isset( $settings->radio_checkbox_font_size_unit_responsive ) ) {
				$settings->radio_checkbox_font_size_unit_responsive = $settings->radio_checkbox_font_size['small'];
			}
			if ( isset( $settings->radio_checkbox_font_size['medium'] ) && ! isset( $settings->radio_checkbox_font_size_unit_medium ) ) {
				$settings->radio_checkbox_font_size_unit_medium = $settings->radio_checkbox_font_size['medium'];
			}
			if ( isset( $settings->radio_checkbox_font_size['desktop'] ) && ! isset( $settings->radio_checkbox_font_size_unit ) ) {
				$settings->radio_checkbox_font_size_unit = $settings->radio_checkbox_font_size['desktop'];
			}

			if ( isset( $settings->form_spacing ) && ! isset( $settings->form_spacing_dimension_top ) && ! isset( $settings->form_spacing_dimension_bottom ) && ! isset( $settings->form_spacing_dimension_left ) && ! isset( $settings->form_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->form_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->form_spacing_dimension_top    = '';
				$settings->form_spacing_dimension_bottom = '';
				$settings->form_spacing_dimension_left   = '';
				$settings->form_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->form_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->form_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->form_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->form_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->input_padding ) && ! isset( $settings->input_padding_dimension_top ) && ! isset( $settings->input_padding_dimension_bottom ) && ! isset( $settings->input_padding_dimension_left ) && ! isset( $settings->input_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_padding_dimension_top    = '';
				$settings->input_padding_dimension_bottom = '';
				$settings->input_padding_dimension_left   = '';
				$settings->input_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->input_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->input_border_width ) && ! isset( $settings->input_border_width_dimension_top ) && ! isset( $settings->input_border_width_dimension_bottom ) && ! isset( $settings->input_border_width_dimension_left ) && ! isset( $settings->input_border_width_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_border_width );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_border_width_dimension_top    = '';
				$settings->input_border_width_dimension_bottom = '';
				$settings->input_border_width_dimension_left   = '';
				$settings->input_border_width_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_border_width_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_border_width_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_border_width_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_border_width_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_border_width_dimension_top    = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_left   = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->validation_spacing ) && ! isset( $settings->validation_spacing_dimension_top ) && ! isset( $settings->validation_spacing_dimension_bottom ) && ! isset( $settings->validation_spacing_dimension_left ) && ! isset( $settings->validation_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->validation_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->validation_spacing_dimension_top    = '';
				$settings->validation_spacing_dimension_bottom = '';
				$settings->validation_spacing_dimension_left   = '';
				$settings->validation_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->validation_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->validation_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->validation_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->validation_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB Advanced Tabs.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_advanced_tabs( &$settings ) {

			if ( isset( $settings->tab_padding ) && ! isset( $settings->tab_padding_dimension_top ) && ! isset( $settings->tab_padding_dimension_bottom ) && ! isset( $settings->tab_padding_dimension_left ) && ! isset( $settings->tab_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->tab_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->tab_padding_dimension_top    = '';
				$settings->tab_padding_dimension_bottom = '';
				$settings->tab_padding_dimension_left   = '';
				$settings->tab_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->tab_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->tab_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->tab_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->tab_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->tab_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->tab_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->content_padding ) && ! isset( $settings->content_padding_dimension_top ) && ! isset( $settings->content_padding_dimension_bottom ) && ! isset( $settings->content_padding_dimension_left ) && ! isset( $settings->content_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_size_unit_responsive = $settings->title_font_size['small'];
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_size_unit_medium = $settings->title_font_size['medium'];
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_size_unit = $settings->title_font_size['desktop'];
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_line_height_unit_responsive = round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_line_height_unit_medium = round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->title_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_line_height_unit = round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->content_font_size['small'] ) && ! isset( $settings->content_font_size_unit_responsive ) ) {
				$settings->content_font_size_unit_responsive = $settings->content_font_size['small'];
			}
			if ( isset( $settings->content_font_size['medium'] ) && ! isset( $settings->content_font_size_unit_medium ) ) {
				$settings->content_font_size_unit_medium = $settings->content_font_size['medium'];
			}
			if ( isset( $settings->content_font_size['desktop'] ) && ! isset( $settings->content_font_size_unit ) ) {
				$settings->content_font_size_unit = $settings->content_font_size['desktop'];
			}

			if ( isset( $settings->content_line_height['small'] ) && isset( $settings->content_font_size['small'] ) && 0 != $settings->content_font_size['small'] && ! isset( $settings->content_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->content_line_height['small'] ) && is_numeric( $settings->content_font_size['small'] ) ) {
					$settings->content_line_height_unit_responsive = round( $settings->content_line_height['small'] / $settings->content_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->content_line_height['medium'] ) && isset( $settings->content_font_size['medium'] ) && 0 != $settings->content_font_size['medium'] && ! isset( $settings->content_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->content_line_height['medium'] ) && is_numeric( $settings->content_font_size['medium'] ) ) {
					$settings->content_line_height_unit_medium = round( $settings->content_line_height['medium'] / $settings->content_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->content_line_height['desktop'] ) && isset( $settings->content_font_size['desktop'] ) && 0 != $settings->content_font_size['desktop'] && ! isset( $settings->content_line_height_unit ) ) {
				if ( is_numeric( $settings->content_line_height['desktop'] ) && is_numeric( $settings->content_font_size['desktop'] ) ) {
					$settings->content_line_height_unit = round( $settings->content_line_height['desktop'] / $settings->content_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Advanced Posts.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_advanced_posts( &$settings ) {

			if ( isset( $settings->overall_padding ) && ! isset( $settings->overall_padding_dimension_top ) && ! isset( $settings->overall_padding_dimension_bottom ) && ! isset( $settings->overall_padding_dimension_left ) && ! isset( $settings->overall_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->overall_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->overall_padding_dimension_top    = '';
				$settings->overall_padding_dimension_bottom = '';
				$settings->overall_padding_dimension_left   = '';
				$settings->overall_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->overall_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->overall_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->overall_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->overall_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->overall_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->content_padding ) && ! isset( $settings->content_padding_dimension_top ) && ! isset( $settings->content_padding_dimension_bottom ) && ! isset( $settings->content_padding_dimension_left ) && ! isset( $settings->content_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->masonary_padding ) && ! isset( $settings->masonary_padding_dimension_top ) && ! isset( $settings->masonary_padding_dimension_bottom ) && ! isset( $settings->masonary_padding_dimension_left ) && ! isset( $settings->masonary_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->masonary_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->masonary_padding_dimension_top    = '';
				$settings->masonary_padding_dimension_bottom = '';
				$settings->masonary_padding_dimension_left   = '';
				$settings->masonary_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->masonary_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->masonary_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->masonary_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->masonary_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->masonary_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_size_unit_responsive = $settings->title_font_size['small'];
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_size_unit_medium = $settings->title_font_size['medium'];
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_size_unit = $settings->title_font_size['desktop'];
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_line_height_unit_responsive = round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_line_height_unit_medium = round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->title_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_line_height_unit = round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_size_unit_responsive = $settings->desc_font_size['small'];
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_size_unit_medium = $settings->desc_font_size['medium'];
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_size_unit = $settings->desc_font_size['desktop'];
			}

			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_line_height_unit_responsive = round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_line_height_unit_medium = round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_line_height_unit = round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->meta_font_size['small'] ) && ! isset( $settings->meta_font_size_unit_responsive ) ) {
				$settings->meta_font_size_unit_responsive = $settings->meta_font_size['small'];
			}
			if ( isset( $settings->meta_font_size['medium'] ) && ! isset( $settings->meta_font_size_unit_medium ) ) {
				$settings->meta_font_size_unit_medium = $settings->meta_font_size['medium'];
			}
			if ( isset( $settings->meta_font_size['desktop'] ) && ! isset( $settings->meta_font_size_unit ) ) {
				$settings->meta_font_size_unit = $settings->meta_font_size['desktop'];
			}

			if ( isset( $settings->meta_line_height['small'] ) && isset( $settings->meta_font_size['small'] ) && 0 != $settings->meta_font_size['small'] && ! isset( $settings->meta_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->meta_line_height['small'] ) && is_numeric( $settings->meta_font_size['small'] ) ) {
					$settings->meta_line_height_unit_responsive = round( $settings->meta_line_height['small'] / $settings->meta_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->meta_line_height['medium'] ) && isset( $settings->meta_font_size['medium'] ) && 0 != $settings->meta_font_size['medium'] && ! isset( $settings->meta_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->meta_line_height['medium'] ) && is_numeric( $settings->meta_font_size['medium'] ) ) {
					$settings->meta_line_height_unit_medium = round( $settings->meta_line_height['medium'] / $settings->meta_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->meta_line_height['desktop'] ) && isset( $settings->meta_font_size['desktop'] ) && 0 != $settings->meta_font_size['desktop'] && ! isset( $settings->meta_line_height_unit ) ) {
				if ( is_numeric( $settings->meta_line_height['desktop'] ) && is_numeric( $settings->meta_font_size['desktop'] ) ) {
					$settings->meta_line_height_unit = round( $settings->meta_line_height['desktop'] / $settings->meta_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->date_font_size['small'] ) && ! isset( $settings->date_font_size_unit_responsive ) ) {
				$settings->date_font_size_unit_responsive = $settings->date_font_size['small'];
			}
			if ( isset( $settings->date_font_size['medium'] ) && ! isset( $settings->date_font_size_unit_medium ) ) {
				$settings->date_font_size_unit_medium = $settings->date_font_size['medium'];
			}
			if ( isset( $settings->date_font_size['desktop'] ) && ! isset( $settings->date_font_size_unit ) ) {
				$settings->date_font_size_unit = $settings->date_font_size['desktop'];
			}

			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_size_unit_responsive = $settings->link_font_size['small'];
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_size_unit_medium = $settings->link_font_size['medium'];
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_size_unit = $settings->link_font_size['desktop'];
			}

			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_line_height_unit_responsive = round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_line_height_unit_medium = round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_line_height_unit = round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->taxonomy_filter_select_font_size['small'] ) && ! isset( $settings->taxonomy_filter_select_font_size_unit_responsive ) ) {
				$settings->taxonomy_filter_select_font_size_unit_responsive = $settings->taxonomy_filter_select_font_size['small'];
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['medium'] ) && ! isset( $settings->taxonomy_filter_select_font_size_unit_medium ) ) {
				$settings->taxonomy_filter_select_font_size_unit_medium = $settings->taxonomy_filter_select_font_size['medium'];
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['desktop'] ) && ! isset( $settings->taxonomy_filter_select_font_size_unit ) ) {
				$settings->taxonomy_filter_select_font_size_unit = $settings->taxonomy_filter_select_font_size['desktop'];
			}
		}

		/**
		 * UABB Creative Link.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_creative_link( &$settings ) {

			if ( isset( $settings->link_typography_font_size['small'] ) && ! isset( $settings->link_typography_font_size_unit_responsive ) ) {
				$settings->link_typography_font_size_unit_responsive = $settings->link_typography_font_size['small'];
			}
			if ( isset( $settings->link_typography_font_size['medium'] ) && ! isset( $settings->link_typography_font_size_unit_medium ) ) {
				$settings->link_typography_font_size_unit_medium = $settings->link_typography_font_size['medium'];
			}
			if ( isset( $settings->link_typography_font_size['desktop'] ) && ! isset( $settings->link_typography_font_size_unit ) ) {
				$settings->link_typography_font_size_unit = $settings->link_typography_font_size['desktop'];
			}

			if ( isset( $settings->link_typography_line_height['small'] ) && isset( $settings->link_typography_font_size['small'] ) && 0 != $settings->link_typography_font_size['small'] && ! isset( $settings->link_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_typography_line_height['small'] ) && is_numeric( $settings->link_typography_font_size['small'] ) ) {
					$settings->link_typography_line_height_unit_responsive = round( $settings->link_typography_line_height['small'] / $settings->link_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_typography_line_height['medium'] ) && isset( $settings->link_typography_font_size['medium'] ) && 0 != $settings->link_typography_font_size['medium'] && ! isset( $settings->link_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_typography_line_height['medium'] ) && is_numeric( $settings->link_typography_font_size['medium'] ) ) {
					$settings->link_typography_line_height_unit_medium = round( $settings->link_typography_line_height['medium'] / $settings->link_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_typography_line_height['desktop'] ) && isset( $settings->link_typography_font_size['desktop'] ) && 0 != $settings->link_typography_font_size['desktop'] && ! isset( $settings->link_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->link_typography_line_height['desktop'] ) && is_numeric( $settings->link_typography_font_size['desktop'] ) ) {
					$settings->link_typography_line_height_unit = round( $settings->link_typography_line_height['desktop'] / $settings->link_typography_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Countdown.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_countdown( &$settings ) {
			if ( isset( $settings->message_font_size['small'] ) && ! isset( $settings->message_font_size_unit_responsive ) ) {
				$settings->message_font_size_unit_responsive = $settings->message_font_size['small'];
			}
			if ( isset( $settings->message_font_size['medium'] ) && ! isset( $settings->message_font_size_unit_medium ) ) {
				$settings->message_font_size_unit_medium = $settings->message_font_size['medium'];
			}
			if ( isset( $settings->message_font_size['desktop'] ) && ! isset( $settings->message_font_size_unit ) ) {
				$settings->message_font_size_unit = $settings->message_font_size['desktop'];
			}

			if ( isset( $settings->message_line_height['small'] ) && isset( $settings->message_font_size['small'] ) && 0 != $settings->message_font_size['small'] && ! isset( $settings->message_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->message_line_height['small'] ) && is_numeric( $settings->message_font_size['small'] ) ) {
					$settings->message_line_height_unit_responsive = round( $settings->message_line_height['small'] / $settings->message_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->message_line_height['medium'] ) && isset( $settings->message_font_size['medium'] ) && 0 != $settings->message_font_size['medium'] && ! isset( $settings->message_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->message_line_height['medium'] ) && is_numeric( $settings->message_font_size['medium'] ) ) {
					$settings->message_line_height_unit_medium = round( $settings->message_line_height['medium'] / $settings->message_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->message_line_height['desktop'] ) && isset( $settings->message_font_size['desktop'] ) && 0 != $settings->message_font_size['desktop'] && ! isset( $settings->message_line_height_unit ) ) {
				if ( is_numeric( $settings->message_line_height['desktop'] ) && is_numeric( $settings->message_font_size['desktop'] ) ) {
					$settings->message_line_height_unit = round( $settings->message_line_height['desktop'] / $settings->message_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->digit_font_size['small'] ) && ! isset( $settings->digit_font_size_unit_responsive ) ) {
				$settings->digit_font_size_unit_responsive = $settings->digit_font_size['small'];
			}
			if ( isset( $settings->digit_font_size['medium'] ) && ! isset( $settings->digit_font_size_unit_medium ) ) {
				$settings->digit_font_size_unit_medium = $settings->digit_font_size['medium'];
			}
			if ( isset( $settings->digit_font_size['desktop'] ) && ! isset( $settings->digit_font_size_unit ) ) {
				$settings->digit_font_size_unit = $settings->digit_font_size['desktop'];
			}

			if ( isset( $settings->digit_line_height['small'] ) && isset( $settings->digit_font_size['small'] ) && 0 != $settings->digit_font_size['small'] && ! isset( $settings->digit_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->digit_line_height['small'] ) && is_numeric( $settings->digit_font_size['small'] ) ) {
					$settings->digit_line_height_unit_responsive = round( $settings->digit_line_height['small'] / $settings->digit_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->digit_line_height['medium'] ) && isset( $settings->digit_font_size['medium'] ) && 0 != $settings->digit_font_size['medium'] && ! isset( $settings->digit_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->digit_line_height['medium'] ) && is_numeric( $settings->digit_font_size['medium'] ) ) {
					$settings->digit_line_height_unit_medium = round( $settings->digit_line_height['medium'] / $settings->digit_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->digit_line_height['desktop'] ) && isset( $settings->digit_font_size['desktop'] ) && 0 != $settings->digit_font_size['desktop'] && ! isset( $settings->digit_line_height_unit ) ) {
				if ( is_numeric( $settings->digit_line_height['desktop'] ) && is_numeric( $settings->digit_font_size['desktop'] ) ) {
					$settings->digit_line_height_unit = round( $settings->digit_line_height['desktop'] / $settings->digit_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->unit_font_size['small'] ) && ! isset( $settings->unit_font_size_new_responsive ) ) {
				$settings->unit_font_size_new_responsive = $settings->unit_font_size['small'];
			}
			if ( isset( $settings->unit_font_size['medium'] ) && ! isset( $settings->unit_font_size_new_medium ) ) {
				$settings->unit_font_size_new_medium = $settings->unit_font_size['medium'];
			}
			if ( isset( $settings->unit_font_size['desktop'] ) && ! isset( $settings->unit_font_size_new ) ) {
				$settings->unit_font_size_new = $settings->unit_font_size['desktop'];
			}

			if ( isset( $settings->unit_line_height['small'] ) && isset( $settings->unit_font_size['small'] ) && 0 != $settings->unit_font_size['small'] && ! isset( $settings->unit_line_height_new_responsive ) ) {
				if ( is_numeric( $settings->unit_line_height['small'] ) && is_numeric( $settings->unit_font_size['small'] ) ) {
					$settings->unit_line_height_new_responsive = round( $settings->unit_line_height['small'] / $settings->unit_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->unit_line_height['medium'] ) && isset( $settings->unit_font_size['medium'] ) && 0 != $settings->unit_font_size['medium'] && ! isset( $settings->unit_line_height_new_medium ) ) {
				if ( is_numeric( $settings->unit_line_height['medium'] ) && is_numeric( $settings->unit_font_size['medium'] ) ) {
					$settings->unit_line_height_new_medium = round( $settings->unit_line_height['medium'] / $settings->unit_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->unit_line_height['desktop'] ) && isset( $settings->unit_font_size['desktop'] ) && 0 != $settings->unit_font_size['desktop'] && ! isset( $settings->unit_line_height_new ) ) {
				if ( is_numeric( $settings->unit_line_height['desktop'] ) && is_numeric( $settings->unit_font_size['desktop'] ) ) {
					$settings->unit_line_height_new = round( $settings->unit_line_height['desktop'] / $settings->unit_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Contact form7.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_contact_form7( &$settings ) {

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->form_title_font_size['small'] ) && ! isset( $settings->form_title_font_size_unit_responsive ) ) {
				$settings->form_title_font_size_unit_responsive = $settings->form_title_font_size['small'];
			}
			if ( isset( $settings->form_title_font_size['medium'] ) && ! isset( $settings->form_title_font_size_unit_medium ) ) {
				$settings->form_title_font_size_unit_medium = $settings->form_title_font_size['medium'];
			}
			if ( isset( $settings->form_title_font_size['desktop'] ) && ! isset( $settings->form_title_font_size_unit ) ) {
				$settings->form_title_font_size_unit = $settings->form_title_font_size['desktop'];
			}

			if ( isset( $settings->form_title_line_height['small'] ) && isset( $settings->form_title_font_size['small'] ) && 0 != $settings->form_title_font_size['small'] && ! isset( $settings->form_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_title_line_height['small'] ) && is_numeric( $settings->form_title_font_size['small'] ) ) {
					$settings->form_title_line_height_unit_responsive = round( $settings->form_title_line_height['small'] / $settings->form_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->form_title_line_height['medium'] ) && isset( $settings->form_title_font_size['medium'] ) && 0 != $settings->form_title_font_size['medium'] && ! isset( $settings->form_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_title_line_height['medium'] ) && is_numeric( $settings->form_title_font_size['medium'] ) ) {
					$settings->form_title_line_height_unit_medium = round( $settings->form_title_line_height['medium'] / $settings->form_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->form_title_line_height['desktop'] ) && isset( $settings->form_title_font_size['desktop'] ) && 0 != $settings->form_title_font_size['desktop'] && ! isset( $settings->form_title_line_height_unit ) ) {
				if ( is_numeric( $settings->form_title_line_height['desktop'] ) && is_numeric( $settings->form_title_font_size['desktop'] ) ) {
					$settings->form_title_line_height_unit = round( $settings->form_title_line_height['desktop'] / $settings->form_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->form_desc_font_size['small'] ) && ! isset( $settings->form_desc_font_size_unit_responsive ) ) {
				$settings->form_desc_font_size_unit_responsive = $settings->form_desc_font_size['small'];
			}
			if ( isset( $settings->form_desc_font_size['medium'] ) && ! isset( $settings->form_desc_font_size_unit_medium ) ) {
				$settings->form_desc_font_size_unit_medium = $settings->form_desc_font_size['medium'];
			}
			if ( isset( $settings->form_desc_font_size['desktop'] ) && ! isset( $settings->form_desc_font_size_unit ) ) {
				$settings->form_desc_font_size_unit = $settings->form_desc_font_size['desktop'];
			}

			if ( isset( $settings->form_desc_line_height['small'] ) && isset( $settings->form_desc_font_size['small'] ) && 0 != $settings->form_desc_font_size['small'] && ! isset( $settings->form_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->form_desc_line_height['small'] ) && is_numeric( $settings->form_desc_font_size['small'] ) ) {
					$settings->form_desc_line_height_unit_responsive = round( $settings->form_desc_line_height['small'] / $settings->form_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->form_desc_line_height['medium'] ) && isset( $settings->form_desc_font_size['medium'] ) && 0 != $settings->form_desc_font_size['medium'] && ! isset( $settings->form_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->form_desc_line_height['medium'] ) && is_numeric( $settings->form_desc_font_size['medium'] ) ) {
					$settings->form_desc_line_height_unit_medium = round( $settings->form_desc_line_height['medium'] / $settings->form_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->form_desc_line_height['desktop'] ) && isset( $settings->form_desc_font_size['desktop'] ) && 0 != $settings->form_desc_font_size['desktop'] && ! isset( $settings->form_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->form_desc_line_height['desktop'] ) && is_numeric( $settings->form_desc_font_size['desktop'] ) ) {
					$settings->form_desc_line_height_unit = round( $settings->form_desc_line_height['desktop'] / $settings->form_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->label_font_size['small'] ) && ! isset( $settings->label_font_size_unit_responsive ) ) {
				$settings->label_font_size_unit_responsive = $settings->label_font_size['small'];
			}
			if ( isset( $settings->label_font_size['medium'] ) && ! isset( $settings->label_font_size_unit_medium ) ) {
				$settings->label_font_size_unit_medium = $settings->label_font_size['medium'];
			}
			if ( isset( $settings->label_font_size['desktop'] ) && ! isset( $settings->label_font_size_unit ) ) {
				$settings->label_font_size_unit = $settings->label_font_size['desktop'];
			}

			if ( isset( $settings->label_line_height['small'] ) && isset( $settings->label_font_size['small'] ) && 0 != $settings->label_font_size['small'] && ! isset( $settings->label_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->label_line_height['small'] ) && is_numeric( $settings->label_font_size['small'] ) ) {
					$settings->label_line_height_unit_responsive = round( $settings->label_line_height['small'] / $settings->label_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['medium'] ) && isset( $settings->label_font_size['medium'] ) && 0 != $settings->label_font_size['medium'] && ! isset( $settings->label_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->label_line_height['medium'] ) && is_numeric( $settings->label_font_size['medium'] ) ) {
					$settings->label_line_height_unit_medium = round( $settings->label_line_height['medium'] / $settings->label_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['desktop'] ) && isset( $settings->label_font_size['desktop'] ) && 0 != $settings->label_font_size['desktop'] && ! isset( $settings->label_line_height_unit ) ) {
				if ( is_numeric( $settings->label_line_height['desktop'] ) && is_numeric( $settings->label_font_size['desktop'] ) ) {
					$settings->label_line_height_unit = round( $settings->label_line_height['desktop'] / $settings->label_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->radio_checkbox_font_size['small'] ) && ! isset( $settings->radio_checkbox_font_size_unit_responsive ) ) {
				$settings->radio_checkbox_font_size_unit_responsive = $settings->radio_checkbox_font_size['small'];
			}
			if ( isset( $settings->radio_checkbox_font_size['medium'] ) && ! isset( $settings->radio_checkbox_font_size_unit_medium ) ) {
				$settings->radio_checkbox_font_size_unit_medium = $settings->radio_checkbox_font_size['medium'];
			}
			if ( isset( $settings->radio_checkbox_font_size['desktop'] ) && ! isset( $settings->radio_checkbox_font_size_unit ) ) {
				$settings->radio_checkbox_font_size_unit = $settings->radio_checkbox_font_size['desktop'];
			}

			if ( isset( $settings->form_spacing ) && ! isset( $settings->form_spacing_dimension_top ) && ! isset( $settings->form_spacing_dimension_bottom ) && ! isset( $settings->form_spacing_dimension_left ) && ! isset( $settings->form_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->form_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->form_spacing_dimension_top    = '';
				$settings->form_spacing_dimension_bottom = '';
				$settings->form_spacing_dimension_left   = '';
				$settings->form_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->form_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->form_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->form_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->form_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->input_padding ) && ! isset( $settings->input_padding_dimension_top ) && ! isset( $settings->input_padding_dimension_bottom ) && ! isset( $settings->input_padding_dimension_left ) && ! isset( $settings->input_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_padding_dimension_top    = '';
				$settings->input_padding_dimension_bottom = '';
				$settings->input_padding_dimension_left   = '';
				$settings->input_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->input_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->input_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->input_border_width ) && ! isset( $settings->input_border_width_dimension_top ) && ! isset( $settings->input_border_width_dimension_bottom ) && ! isset( $settings->input_border_width_dimension_left ) && ! isset( $settings->input_border_width_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->input_border_width );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->input_border_width_dimension_top    = '';
				$settings->input_border_width_dimension_bottom = '';
				$settings->input_border_width_dimension_left   = '';
				$settings->input_border_width_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->input_border_width_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->input_border_width_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->input_border_width_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->input_border_width_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->input_border_width_dimension_top    = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_bottom = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_left   = (int) $output[ $i ][1];
							$settings->input_border_width_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->validation_spacing ) && ! isset( $settings->validation_spacing_dimension_top ) && ! isset( $settings->validation_spacing_dimension_bottom ) && ! isset( $settings->validation_spacing_dimension_left ) && ! isset( $settings->validation_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->validation_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->validation_spacing_dimension_top    = '';
				$settings->validation_spacing_dimension_bottom = '';
				$settings->validation_spacing_dimension_left   = '';
				$settings->validation_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->validation_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->validation_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->validation_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->validation_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->validation_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB Dual Button.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_dual_button( &$settings ) {

			if ( isset( $settings->_btn_one_font_size['small'] ) && ! isset( $settings->_btn_one_font_size_unit_responsive ) ) {
				$settings->_btn_one_font_size_unit_responsive = $settings->_btn_one_font_size['small'];
			}
			if ( isset( $settings->_btn_one_font_size['medium'] ) && ! isset( $settings->_btn_one_font_size_unit_medium ) ) {
				$settings->_btn_one_font_size_unit_medium = $settings->_btn_one_font_size['medium'];
			}
			if ( isset( $settings->_btn_one_font_size['desktop'] ) && ! isset( $settings->_btn_one_font_size_unit ) ) {
				$settings->_btn_one_font_size_unit = $settings->_btn_one_font_size['desktop'];
			}

			if ( isset( $settings->_btn_one_line_height['small'] ) && isset( $settings->_btn_one_font_size['small'] ) && 0 != $settings->_btn_one_font_size['small'] && ! isset( $settings->_btn_one_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->_btn_one_line_height['small'] ) && is_numeric( $settings->_btn_one_font_size['small'] ) ) {
					$settings->_btn_one_line_height_unit_responsive = round( $settings->_btn_one_line_height['small'] / $settings->_btn_one_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->_btn_one_line_height['medium'] ) && isset( $settings->_btn_one_font_size['medium'] ) && 0 != $settings->_btn_one_font_size['medium'] && ! isset( $settings->_btn_one_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->_btn_one_line_height['medium'] ) && is_numeric( $settings->_btn_one_font_size['medium'] ) ) {
					$settings->_btn_one_line_height_unit_medium = round( $settings->_btn_one_line_height['medium'] / $settings->_btn_one_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->_btn_one_line_height['desktop'] ) && isset( $settings->_btn_one_font_size['desktop'] ) && 0 != $settings->_btn_one_font_size['desktop'] && ! isset( $settings->_btn_one_line_height_unit ) ) {
				if ( is_numeric( $settings->_btn_one_line_height['desktop'] ) && is_numeric( $settings->_btn_one_font_size['desktop'] ) ) {
					$settings->_btn_one_line_height_unit = round( $settings->_btn_one_line_height['desktop'] / $settings->_btn_one_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->_btn_two_font_size['small'] ) && ! isset( $settings->_btn_two_font_size_unit_responsive ) ) {
				$settings->_btn_two_font_size_unit_responsive = $settings->_btn_two_font_size['small'];
			}
			if ( isset( $settings->_btn_two_font_size['medium'] ) && ! isset( $settings->_btn_two_font_size_unit_medium ) ) {
				$settings->_btn_two_font_size_unit_medium = $settings->_btn_two_font_size['medium'];
			}
			if ( isset( $settings->_btn_two_font_size['desktop'] ) && ! isset( $settings->_btn_two_font_size_unit ) ) {
				$settings->_btn_two_font_size_unit = $settings->_btn_two_font_size['desktop'];
			}

			if ( isset( $settings->_btn_two_line_height['small'] ) && isset( $settings->_btn_two_font_size['small'] ) && 0 != $settings->_btn_two_font_size['small'] && ! isset( $settings->_btn_two_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->_btn_two_line_height['small'] ) && is_numeric( $settings->_btn_two_font_size['small'] ) ) {
					$settings->_btn_two_line_height_unit_responsive = round( $settings->_btn_two_line_height['small'] / $settings->_btn_two_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->_btn_two_line_height['medium'] ) && isset( $settings->_btn_two_font_size['medium'] ) && 0 != $settings->_btn_two_font_size['medium'] && ! isset( $settings->_btn_two_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->_btn_two_line_height['medium'] ) && is_numeric( $settings->_btn_two_font_size['medium'] ) ) {
					$settings->_btn_two_line_height_unit_medium = round( $settings->_btn_two_line_height['medium'] / $settings->_btn_two_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->_btn_two_line_height['desktop'] ) && isset( $settings->_btn_two_font_size['desktop'] ) && 0 != $settings->_btn_two_font_size['desktop'] && ! isset( $settings->_btn_two_line_height_unit ) ) {
				if ( is_numeric( $settings->_btn_two_line_height['desktop'] ) && is_numeric( $settings->_btn_two_font_size['desktop'] ) ) {
					$settings->_btn_two_line_height_unit = round( $settings->_btn_two_line_height['desktop'] / $settings->_btn_two_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->_divider_font_size['small'] ) && ! isset( $settings->_divider_font_size_unit_responsive ) ) {
				$settings->_divider_font_size_unit_responsive = $settings->_divider_font_size['small'];
			}
			if ( isset( $settings->_divider_font_size['medium'] ) && ! isset( $settings->_divider_font_size_unit_medium ) ) {
				$settings->_divider_font_size_unit_medium = $settings->_divider_font_size['medium'];
			}
			if ( isset( $settings->_divider_font_size['desktop'] ) && ! isset( $settings->_divider_font_size_unit ) ) {
				$settings->_divider_font_size_unit = $settings->_divider_font_size['desktop'];
			}
		}

		/**
		 * UABB Dual Color Heading.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_dual_color_heading( &$settings ) {

			if ( isset( $settings->dual_font_size['small'] ) && ! isset( $settings->dual_font_size_unit_responsive ) ) {
				$settings->dual_font_size_unit_responsive = $settings->dual_font_size['small'];
			}
			if ( isset( $settings->dual_font_size['medium'] ) && ! isset( $settings->dual_font_size_unit_medium ) ) {
				$settings->dual_font_size_unit_medium = $settings->dual_font_size['medium'];
			}
			if ( isset( $settings->dual_font_size['desktop'] ) && ! isset( $settings->dual_font_size_unit ) ) {
				$settings->dual_font_size_unit = $settings->dual_font_size['desktop'];
			}

			if ( isset( $settings->dual_line_height['small'] ) && isset( $settings->dual_font_size['small'] ) && 0 != $settings->dual_font_size['small'] && ! isset( $settings->dual_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->dual_line_height['small'] ) && is_numeric( $settings->dual_font_size['small'] ) ) {
					$settings->dual_line_height_unit_responsive = round( $settings->dual_line_height['small'] / $settings->dual_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->dual_line_height['medium'] ) && isset( $settings->dual_font_size['medium'] ) && 0 != $settings->dual_font_size['medium'] && ! isset( $settings->dual_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->dual_line_height['medium'] ) && is_numeric( $settings->dual_font_size['medium'] ) ) {
					$settings->dual_line_height_unit_medium = round( $settings->dual_line_height['medium'] / $settings->dual_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->dual_line_height['desktop'] ) && isset( $settings->dual_font_size['desktop'] ) && 0 != $settings->dual_font_size['desktop'] && ! isset( $settings->dual_line_height_unit ) ) {
				if ( is_numeric( $settings->dual_line_height['desktop'] ) && is_numeric( $settings->dual_font_size['desktop'] ) ) {
					$settings->dual_line_height_unit = round( $settings->dual_line_height['desktop'] / $settings->dual_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Fancy Text.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_fancy_text( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->fancy_font_size['small'] ) && ! isset( $settings->fancy_font_size_unit_responsive ) ) {
				$settings->fancy_font_size_unit_responsive = $settings->fancy_font_size['small'];
			}
			if ( isset( $settings->fancy_font_size['medium'] ) && ! isset( $settings->fancy_font_size_unit_medium ) ) {
				$settings->fancy_font_size_unit_medium = $settings->fancy_font_size['medium'];
			}
			if ( isset( $settings->fancy_font_size['desktop'] ) && ! isset( $settings->fancy_font_size_unit ) ) {
				$settings->fancy_font_size_unit = $settings->fancy_font_size['desktop'];
			}

			if ( isset( $settings->fancy_line_height['small'] ) && isset( $settings->fancy_font_size['small'] ) && 0 != $settings->fancy_font_size['small'] && ! isset( $settings->fancy_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->fancy_line_height['small'] ) && is_numeric( $settings->fancy_font_size['small'] ) ) {
					$settings->fancy_line_height_unit_responsive = round( $settings->fancy_line_height['small'] / $settings->fancy_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->fancy_line_height['medium'] ) && isset( $settings->fancy_font_size['small'] ) && 0 != $settings->fancy_font_size['medium'] && ! isset( $settings->fancy_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->fancy_line_height['medium'] ) && is_numeric( $settings->fancy_font_size['small'] ) ) {
					$settings->fancy_line_height_unit_medium = round( $settings->fancy_line_height['medium'] / $settings->fancy_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->fancy_line_height['desktop'] ) && isset( $settings->fancy_font_size['small'] ) && 0 != $settings->fancy_font_size['desktop'] && ! isset( $settings->fancy_line_height_unit ) ) {
				if ( is_numeric( $settings->fancy_line_height['desktop'] ) && is_numeric( $settings->fancy_font_size['small'] ) ) {
					$settings->fancy_line_height_unit = round( $settings->fancy_line_height['desktop'] / $settings->fancy_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Flip Box.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_flip_box( &$settings ) {

			if ( isset( $settings->inner_padding ) && ! isset( $settings->inner_padding_dimension_top ) && ! isset( $settings->inner_padding_dimension_bottom ) && ! isset( $settings->inner_padding_dimension_left ) && ! isset( $settings->inner_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->inner_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->inner_padding_dimension_top    = '';
				$settings->inner_padding_dimension_bottom = '';
				$settings->inner_padding_dimension_left   = '';
				$settings->inner_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->inner_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->inner_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->inner_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->inner_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->inner_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->front_title_typography_font_size['small'] ) && ! isset( $settings->front_title_typography_font_size_unit_responsive ) ) {
				$settings->front_title_typography_font_size_unit_responsive = $settings->front_title_typography_font_size['small'];
			}
			if ( isset( $settings->front_title_typography_font_size['medium'] ) && ! isset( $settings->front_title_typography_font_size_unit_medium ) ) {
				$settings->front_title_typography_font_size_unit_medium = $settings->front_title_typography_font_size['medium'];
			}
			if ( isset( $settings->front_title_typography_font_size['desktop'] ) && ! isset( $settings->front_title_typography_font_size_unit ) ) {
				$settings->front_title_typography_font_size_unit = $settings->front_title_typography_font_size['desktop'];
			}

			if ( isset( $settings->front_title_typography_line_height['small'] ) && isset( $settings->front_title_typography_font_size['small'] ) && 0 != $settings->front_title_typography_font_size['small'] && ! isset( $settings->front_title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['small'] ) && is_numeric( $settings->front_title_typography_font_size['small'] ) ) {
					$settings->front_title_typography_line_height_unit_responsive = round( $settings->front_title_typography_line_height['small'] / $settings->front_title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_title_typography_line_height['medium'] ) && isset( $settings->front_title_typography_font_size['medium'] ) && 0 != $settings->front_title_typography_font_size['medium'] && ! isset( $settings->front_title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['medium'] ) && is_numeric( $settings->front_title_typography_font_size['medium'] ) ) {
					$settings->front_title_typography_line_height_unit_medium = round( $settings->front_title_typography_line_height['medium'] / $settings->front_title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_title_typography_line_height['desktop'] ) && isset( $settings->front_title_typography_font_size['desktop'] ) && 0 != $settings->front_title_typography_font_size['desktop'] && ! isset( $settings->front_title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['desktop'] ) && is_numeric( $settings->front_title_typography_font_size['desktop'] ) ) {
					$settings->front_title_typography_line_height_unit = round( $settings->front_title_typography_line_height['desktop'] / $settings->front_title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->front_desc_typography_font_size['small'] ) && ! isset( $settings->front_desc_typography_font_size_unit_responsive ) ) {
				$settings->front_desc_typography_font_size_unit_responsive = $settings->front_desc_typography_font_size['small'];
			}
			if ( isset( $settings->front_desc_typography_font_size['medium'] ) && ! isset( $settings->front_desc_typography_font_size_unit_medium ) ) {
				$settings->front_desc_typography_font_size_unit_medium = $settings->front_desc_typography_font_size['medium'];
			}
			if ( isset( $settings->front_desc_typography_font_size['desktop'] ) && ! isset( $settings->front_desc_typography_font_size_unit ) ) {
				$settings->front_desc_typography_font_size_unit = $settings->front_desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->front_desc_typography_line_height['small'] ) && isset( $settings->front_desc_typography_font_size['small'] ) && 0 != $settings->front_desc_typography_font_size['small'] && ! isset( $settings->front_desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['small'] ) && is_numeric( $settings->front_desc_typography_font_size['small'] ) ) {
					$settings->front_desc_typography_line_height_unit_responsive = round( $settings->front_desc_typography_line_height['small'] / $settings->front_desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_desc_typography_line_height['medium'] ) && isset( $settings->front_desc_typography_font_size['medium'] ) && 0 != $settings->front_desc_typography_font_size['medium'] && ! isset( $settings->front_desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['medium'] ) && is_numeric( $settings->front_desc_typography_font_size['medium'] ) ) {
					$settings->front_desc_typography_line_height_unit_medium = round( $settings->front_desc_typography_line_height['medium'] / $settings->front_desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_desc_typography_line_height['desktop'] ) && isset( $settings->front_desc_typography_font_size['desktop'] ) && 0 != $settings->front_desc_typography_font_size['desktop'] && ! isset( $settings->front_desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['desktop'] ) && is_numeric( $settings->front_desc_typography_font_size['desktop'] ) ) {
					$settings->front_desc_typography_line_height_unit = round( $settings->front_desc_typography_line_height['desktop'] / $settings->front_desc_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_title_typography_font_size['small'] ) && ! isset( $settings->back_title_typography_font_size_unit_responsive ) ) {
				$settings->back_title_typography_font_size_unit_responsive = $settings->back_title_typography_font_size['small'];
			}
			if ( isset( $settings->back_title_typography_font_size['medium'] ) && ! isset( $settings->back_title_typography_font_size_unit_medium ) ) {
				$settings->back_title_typography_font_size_unit_medium = $settings->back_title_typography_font_size['medium'];
			}
			if ( isset( $settings->back_title_typography_font_size['desktop'] ) && ! isset( $settings->back_title_typography_font_size_unit ) ) {
				$settings->back_title_typography_font_size_unit = $settings->back_title_typography_font_size['desktop'];
			}

			if ( isset( $settings->back_title_typography_line_height['small'] ) && isset( $settings->back_title_typography_font_size['small'] ) && 0 != $settings->back_title_typography_font_size['small'] && ! isset( $settings->back_title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['small'] ) && is_numeric( $settings->back_title_typography_font_size['small'] ) ) {
					$settings->back_title_typography_line_height_unit_responsive = round( $settings->back_title_typography_line_height['small'] / $settings->back_title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_title_typography_line_height['medium'] ) && isset( $settings->back_title_typography_font_size['small'] ) && 0 != $settings->back_title_typography_font_size['medium'] && ! isset( $settings->back_title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['medium'] ) && is_numeric( $settings->back_title_typography_font_size['small'] ) ) {
					$settings->back_title_typography_line_height_unit_medium = round( $settings->back_title_typography_line_height['medium'] / $settings->back_title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_title_typography_line_height['desktop'] ) && isset( $settings->back_title_typography_font_size['small'] ) && 0 != $settings->back_title_typography_font_size['desktop'] && ! isset( $settings->back_title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['desktop'] ) && is_numeric( $settings->back_title_typography_font_size['small'] ) ) {
					$settings->back_title_typography_line_height_unit = round( $settings->back_title_typography_line_height['desktop'] / $settings->back_title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_desc_typography_font_size['small'] ) && ! isset( $settings->back_desc_typography_font_size_unit_responsive ) ) {
				$settings->back_desc_typography_font_size_unit_responsive = $settings->back_desc_typography_font_size['small'];
			}
			if ( isset( $settings->back_desc_typography_font_size['medium'] ) && ! isset( $settings->back_desc_typography_font_size_unit_medium ) ) {
				$settings->back_desc_typography_font_size_unit_medium = $settings->back_desc_typography_font_size['medium'];
			}
			if ( isset( $settings->back_desc_typography_font_size['desktop'] ) && ! isset( $settings->back_desc_typography_font_size_unit ) ) {
				$settings->back_desc_typography_font_size_unit = $settings->back_desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->back_desc_typography_line_height['small'] ) && isset( $settings->back_desc_typography_font_size['small'] ) && 0 != $settings->back_desc_typography_font_size['small'] && ! isset( $settings->back_desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['small'] ) && is_numeric( $settings->back_desc_typography_font_size['small'] ) ) {
					$settings->back_desc_typography_line_height_unit_responsive = round( $settings->back_desc_typography_line_height['small'] / $settings->back_desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_desc_typography_line_height['medium'] ) && isset( $settings->back_desc_typography_font_size['small'] ) && 0 != $settings->back_desc_typography_font_size['medium'] && ! isset( $settings->back_desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['medium'] ) && is_numeric( $settings->back_desc_typography_font_size['small'] ) ) {
					$settings->back_desc_typography_line_height_unit_medium = round( $settings->back_desc_typography_line_height['medium'] / $settings->back_desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_desc_typography_line_height['desktop'] ) && isset( $settings->back_desc_typography_font_size['small'] ) && 0 != $settings->back_desc_typography_font_size['desktop'] && ! isset( $settings->back_desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['desktop'] ) && is_numeric( $settings->back_desc_typography_font_size['small'] ) ) {
					$settings->back_desc_typography_line_height_unit = round( $settings->back_desc_typography_line_height['desktop'] / $settings->back_desc_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->button->font_size->small ) && ! isset( $settings->button->font_size_unit_responsive ) ) {
				$settings->button->font_size_unit_responsive = $settings->button->font_size->small;
			}
			if ( isset( $settings->button->font_size->medium ) && ! isset( $settings->button->font_size_unit_medium ) ) {
				$settings->button->font_size_unit_medium = $settings->button->font_size->medium;
			}
			if ( isset( $settings->button->font_size->desktop ) && ! isset( $settings->button->font_size_unit ) ) {
				$settings->button->font_size_unit = $settings->button->font_size->desktop;
			}

			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 != $settings->button->font_size->small && ! isset( $settings->button->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->line_height_unit_responsive = round( $settings->button->line_height->small / $settings->button->font_size->small, 2 );
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 != $settings->button->font_size->medium && ! isset( $settings->button->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->line_height_unit_medium = round( $settings->button->line_height->medium / $settings->button->font_size->medium, 2 );
				}
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 != $settings->button->font_size->desktop && ! isset( $settings->button->line_height_unit ) ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->line_height_unit = round( $settings->button->line_height->desktop / $settings->button->font_size->desktop, 2 );
				}
			}
		}

		/**
		 * UABB iHover.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_ihover( &$settings ) {

			if ( isset( $settings->content_padding ) && ! isset( $settings->content_padding_dimension_top ) && ! isset( $settings->content_padding_dimension_bottom ) && ! isset( $settings->content_padding_dimension_left ) && ! isset( $settings->content_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->title_typography_font_size['small'] ) && ! isset( $settings->title_typography_font_size_unit_responsive ) ) {
				$settings->title_typography_font_size_unit_responsive = $settings->title_typography_font_size['small'];
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) && ! isset( $settings->title_typography_font_size_unit_medium ) ) {
				$settings->title_typography_font_size_unit_medium = $settings->title_typography_font_size['medium'];
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) && ! isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_typography_font_size_unit = $settings->title_typography_font_size['desktop'];
			}

			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] && ! isset( $settings->title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_typography_line_height_unit_responsive = round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] && ! isset( $settings->title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_typography_line_height_unit_medium = round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] && ! isset( $settings->title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_typography_line_height_unit = round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_typography_font_size['small'] ) && ! isset( $settings->desc_typography_font_size_unit_responsive ) ) {
				$settings->desc_typography_font_size_unit_responsive = $settings->desc_typography_font_size['small'];
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) && ! isset( $settings->desc_typography_font_size_unit_medium ) ) {
				$settings->desc_typography_font_size_unit_medium = $settings->desc_typography_font_size['medium'];
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) && ! isset( $settings->desc_typography_font_size_unit ) ) {
				$settings->desc_typography_font_size_unit = $settings->desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 != $settings->desc_typography_font_size['small'] && ! isset( $settings->desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_typography_line_height_unit_responsive = round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 != $settings->desc_typography_font_size['medium'] && ! isset( $settings->desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_typography_line_height_unit_medium = round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 != $settings->desc_typography_font_size['desktop'] && ! isset( $settings->desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_typography_line_height_unit = round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Info Banner.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_banner( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_size_unit_responsive = $settings->desc_font_size['small'];
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_size_unit_medium = $settings->desc_font_size['medium'];
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_size_unit = $settings->desc_font_size['desktop'];
			}

			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_line_height_unit_responsive = round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_line_height_unit_medium = round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_line_height_unit = round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->tbtn_font_size['small'] ) && ! isset( $settings->tbtn_font_size_unit_responsive ) ) {
				$settings->tbtn_font_size_unit_responsive = $settings->tbtn_font_size['small'];
			}
			if ( isset( $settings->tbtn_font_size['medium'] ) && ! isset( $settings->tbtn_font_size_unit_medium ) ) {
				$settings->tbtn_font_size_unit_medium = $settings->tbtn_font_size['medium'];
			}
			if ( isset( $settings->tbtn_font_size['desktop'] ) && ! isset( $settings->tbtn_font_size_unit ) ) {
				$settings->tbtn_font_size_unit = $settings->tbtn_font_size['desktop'];
			}

			if ( isset( $settings->tbtn_line_height['small'] ) && isset( $settings->tbtn_font_size['small'] ) && 0 != $settings->tbtn_font_size['small'] && ! isset( $settings->tbtn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->tbtn_line_height['small'] ) && is_numeric( $settings->tbtn_font_size['small'] ) ) {
					$settings->tbtn_line_height_unit_responsive = round( $settings->tbtn_line_height['small'] / $settings->tbtn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->tbtn_line_height['medium'] ) && isset( $settings->tbtn_font_size['medium'] ) && 0 != $settings->tbtn_font_size['medium'] && ! isset( $settings->tbtn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->tbtn_line_height['medium'] ) && is_numeric( $settings->tbtn_font_size['medium'] ) ) {
					$settings->tbtn_line_height_unit_medium = round( $settings->tbtn_line_height['medium'] / $settings->tbtn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->tbtn_line_height['desktop'] ) && isset( $settings->tbtn_font_size['desktop'] ) && 0 != $settings->tbtn_font_size['desktop'] && ! isset( $settings->tbtn_line_height_unit ) ) {
				if ( is_numeric( $settings->tbtn_line_height['desktop'] ) && is_numeric( $settings->tbtn_font_size['desktop'] ) ) {
					$settings->tbtn_line_height_unit = round( $settings->tbtn_line_height['desktop'] / $settings->tbtn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_size_unit_responsive = $settings->link_font_size['small'];
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_size_unit_medium = $settings->link_font_size['medium'];
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_size_unit = $settings->link_font_size['desktop'];
			}

			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_line_height_unit_responsive = round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_line_height_unit_medium = round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_line_height_unit = round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Info Box.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_box( &$settings ) {

			if ( isset( $settings->info_box_padding ) && ! isset( $settings->info_box_padding_dimension_top ) && ! isset( $settings->info_box_padding_dimension_bottom ) && ! isset( $settings->info_box_padding_dimension_left ) && ! isset( $settings->info_box_padding_dimension_right ) ) {

						$value = '';
						$value = str_replace( 'px', '', $settings->info_box_padding );

						$output       = array();
						$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

						$settings->info_box_padding_dimension_top    = '';
						$settings->info_box_padding_dimension_bottom = '';
						$settings->info_box_padding_dimension_left   = '';
						$settings->info_box_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->info_box_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->info_box_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->info_box_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->info_box_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->info_box_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->info_box_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->prefix_font_size['small'] ) && ! isset( $settings->prefix_font_size_unit_responsive ) ) {
				$settings->prefix_font_size_unit_responsive = $settings->prefix_font_size['small'];
			}
			if ( isset( $settings->prefix_font_size['medium'] ) && ! isset( $settings->prefix_font_size_unit_medium ) ) {
				$settings->prefix_font_size_unit_medium = $settings->prefix_font_size['medium'];
			}
			if ( isset( $settings->prefix_font_size['desktop'] ) && ! isset( $settings->prefix_font_size_unit ) ) {
				$settings->prefix_font_size_unit = $settings->prefix_font_size['desktop'];
			}

			if ( isset( $settings->prefix_line_height['small'] ) && isset( $settings->prefix_font_size['small'] ) && 0 != $settings->prefix_font_size['small'] && ! isset( $settings->prefix_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->prefix_line_height['small'] ) && is_numeric( $settings->prefix_font_size['small'] ) ) {
					$settings->prefix_line_height_unit_responsive = round( $settings->prefix_line_height['small'] / $settings->prefix_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->prefix_line_height['medium'] ) && isset( $settings->prefix_font_size['medium'] ) && 0 != $settings->prefix_font_size['medium'] && ! isset( $settings->prefix_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->prefix_line_height['medium'] ) && is_numeric( $settings->prefix_font_size['medium'] ) ) {
					$settings->prefix_line_height_unit_medium = round( $settings->prefix_line_height['medium'] / $settings->prefix_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->prefix_line_height['desktop'] ) && isset( $settings->prefix_font_size['desktop'] ) && 0 != $settings->prefix_font_size['desktop'] && ! isset( $settings->prefix_line_height_unit ) ) {
				if ( is_numeric( $settings->prefix_line_height['desktop'] ) && is_numeric( $settings->prefix_font_size['desktop'] ) ) {
					$settings->prefix_line_height_unit = round( $settings->prefix_line_height['desktop'] / $settings->prefix_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_size_unit_responsive = $settings->title_font_size['small'];
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_size_unit_medium = $settings->title_font_size['medium'];
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_size_unit = $settings->title_font_size['desktop'];
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_line_height_unit_responsive = round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_line_height_unit_medium = round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->title_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_line_height_unit = round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->subhead_font_size['small'] ) && ! isset( $settings->subhead_font_size_unit_responsive ) ) {
				$settings->subhead_font_size_unit_responsive = $settings->subhead_font_size['small'];
			}
			if ( isset( $settings->subhead_font_size['medium'] ) && ! isset( $settings->subhead_font_size_unit_medium ) ) {
				$settings->subhead_font_size_unit_medium = $settings->subhead_font_size['medium'];
			}
			if ( isset( $settings->subhead_font_size['desktop'] ) && ! isset( $settings->subhead_font_size_unit ) ) {
				$settings->subhead_font_size_unit = $settings->subhead_font_size['desktop'];
			}

			if ( isset( $settings->subhead_line_height['small'] ) && isset( $settings->subhead_font_size['small'] ) && 0 != $settings->subhead_font_size['small'] && ! isset( $settings->subhead_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->subhead_line_height['small'] ) && is_numeric( $settings->subhead_font_size['small'] ) ) {
					$settings->subhead_line_height_unit_responsive = round( $settings->subhead_line_height['small'] / $settings->subhead_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->subhead_line_height['medium'] ) && isset( $settings->subhead_font_size['medium'] ) && 0 != $settings->subhead_font_size['medium'] && ! isset( $settings->subhead_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->subhead_line_height['medium'] ) && is_numeric( $settings->subhead_font_size['medium'] ) ) {
					$settings->subhead_line_height_unit_medium = round( $settings->subhead_line_height['medium'] / $settings->subhead_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->subhead_line_height['desktop'] ) && isset( $settings->subhead_font_size['desktop'] ) && 0 != $settings->subhead_font_size['desktop'] && ! isset( $settings->subhead_line_height_unit ) ) {
				if ( is_numeric( $settings->subhead_line_height['desktop'] ) && is_numeric( $settings->subhead_font_size['desktop'] ) ) {
					$settings->subhead_line_height_unit = round( $settings->subhead_line_height['desktop'] / $settings->subhead_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_size_unit_responsive = $settings->link_font_size['small'];
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_size_unit_medium = $settings->link_font_size['medium'];
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_size_unit = $settings->link_font_size['desktop'];
			}

			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_line_height_unit_responsive = round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_line_height_unit_medium = round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_line_height_unit = round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Info Circle.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_circle( &$settings ) {

			if ( isset( $settings->info_area_spacing ) && ! isset( $settings->info_area_spacing_dimension_top ) && ! isset( $settings->info_area_spacing_dimension_bottom ) && ! isset( $settings->info_area_spacing_dimension_left ) && ! isset( $settings->info_area_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->info_area_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->info_area_spacing_dimension_top    = '';
				$settings->info_area_spacing_dimension_bottom = '';
				$settings->info_area_spacing_dimension_left   = '';
				$settings->info_area_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->info_area_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->info_area_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->info_area_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->info_area_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->info_area_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->info_area_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->info_area_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->info_area_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_size_unit_responsive = $settings->desc_font_size['small'];
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_size_unit_medium = $settings->desc_font_size['medium'];
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_size_unit = $settings->desc_font_size['desktop'];
			}

			if ( isset( $settings->desc_line_height ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_line_height_unit_responsive = round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_line_height_unit_medium = round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_line_height_unit = round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 );
				}
			}

			for ( $i = 0; $i < count( $settings->add_circle_item ); $i++ ) {

				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->small ) && ! isset( $settings->add_circle_item[ $i ]->btn_font_size_unit_responsive ) ) {
					$settings->add_circle_item[ $i ]->btn_font_size_unit_responsive = $settings->add_circle_item[ $i ]->btn_font_size->small;
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->medium ) && ! isset( $settings->add_circle_item[ $i ]->btn_font_size_unit_medium ) ) {
					$settings->add_circle_item[ $i ]->btn_font_size_unit_medium = $settings->add_circle_item[ $i ]->btn_font_size->medium;
				}
				if ( isset( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) && ! isset( $settings->add_circle_item[ $i ]->btn_font_size_unit ) ) {
					$settings->add_circle_item[ $i ]->btn_font_size_unit = $settings->add_circle_item[ $i ]->btn_font_size->desktop;
				}

				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->small ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->small ) && 0 != $settings->add_circle_item[ $i ]->btn_font_size->small && ! isset( $settings->add_circle_item[ $i ]->btn_line_height_unit_responsive ) ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->small ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->small ) ) {
						$settings->add_circle_item[ $i ]->btn_line_height_unit_responsive = round( $settings->add_circle_item[ $i ]->btn_line_height->small / $settings->add_circle_item[ $i ]->btn_font_size->small, 2 );
					}
				}

				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->medium ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->medium ) && 0 != $settings->add_circle_item[ $i ]->btn_font_size->medium && ! isset( $settings->add_circle_item[ $i ]->btn_line_height_unit_medium ) ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->medium ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->medium ) ) {
						$settings->add_circle_item[ $i ]->btn_line_height_unit_medium = round( $settings->add_circle_item[ $i ]->btn_line_height->medium / $settings->add_circle_item[ $i ]->btn_font_size->medium, 2 );
					}
				}

				if ( isset( $settings->add_circle_item[ $i ]->btn_line_height->desktop ) && isset( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) && 0 != $settings->add_circle_item[ $i ]->btn_font_size->desktop && ! isset( $settings->add_circle_item[ $i ]->btn_line_height_unit ) ) {
					if ( is_numeric( $settings->add_circle_item[ $i ]->btn_line_height->desktop ) && is_numeric( $settings->add_circle_item[ $i ]->btn_font_size->desktop ) ) {
						$settings->add_circle_item[ $i ]->btn_line_height_unit = round( $settings->add_circle_item[ $i ]->btn_line_height->desktop / $settings->add_circle_item[ $i ]->btn_font_size->desktop, 2 );
					}
				}
			}
		}

		/**
		 * UABB Info List.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_list( &$settings ) {

			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_size_unit_responsive = $settings->heading_font_size['small'];
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_size_unit_medium = $settings->heading_font_size['medium'];
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_size_unit ) ) {
				$settings->heading_font_size_unit = $settings->heading_font_size['desktop'];
			}

			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_line_height_unit_responsive = round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_line_height_unit_medium = round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_line_height_unit = round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->description_font_size['small'] ) && ! isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_size_unit_responsive = $settings->description_font_size['small'];
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_size_unit_medium = $settings->description_font_size['medium'];
			}
			if ( isset( $settings->description_font_size['desktop'] ) && ! isset( $settings->description_font_size_unit ) ) {
				$settings->description_font_size_unit = $settings->description_font_size['desktop'];
			}

			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 != $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_line_height_unit_responsive = round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 != $settings->description_font_size['medium'] && ! isset( $settings->description_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_line_height_unit_medium = round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 != $settings->description_font_size['desktop'] && ! isset( $settings->description_line_height_unit ) ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_line_height_unit = round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Info Table.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_table( &$settings ) {

			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_size_unit_responsive = $settings->heading_font_size['small'];
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_size_unit_medium = $settings->heading_font_size['medium'];
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_size_unit ) ) {
				$settings->heading_font_size_unit = $settings->heading_font_size['desktop'];
			}

			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_line_height_unit_responsive = round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_line_height_unit_medium = round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_line_height_unit = round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->description_font_size['small'] ) && ! isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_size_unit_responsive = $settings->description_font_size['small'];
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_size_unit_medium = $settings->description_font_size['medium'];
			}
			if ( isset( $settings->description_font_size['desktop'] ) && ! isset( $settings->description_font_size_unit ) ) {
				$settings->description_font_size_unit = $settings->description_font_size['desktop'];
			}

			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 != $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_line_height_unit_responsive = round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 != $settings->description_font_size['medium'] && ! isset( $settings->description_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_line_height_unit_medium = round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 != $settings->description_font_size['desktop'] && ! isset( $settings->description_line_height_unit ) ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_line_height_unit = round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->sub_heading_font_size['small'] ) && ! isset( $settings->sub_heading_font_size_unit_responsive ) ) {
				$settings->sub_heading_font_size_unit_responsive = $settings->sub_heading_font_size['small'];
			}
			if ( isset( $settings->sub_heading_font_size['medium'] ) && ! isset( $settings->sub_heading_font_size_unit_medium ) ) {
				$settings->sub_heading_font_size_unit_medium = $settings->sub_heading_font_size['medium'];
			}
			if ( isset( $settings->sub_heading_font_size['desktop'] ) && ! isset( $settings->sub_heading_font_size_unit ) ) {
				$settings->sub_heading_font_size_unit = $settings->sub_heading_font_size['desktop'];
			}

			if ( isset( $settings->sub_heading_line_height['small'] ) && isset( $settings->sub_heading_font_size['small'] ) && 0 != $settings->sub_heading_font_size['small'] && ! isset( $settings->sub_heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['small'] ) && is_numeric( $settings->sub_heading_font_size['small'] ) ) {
					$settings->sub_heading_line_height_unit_responsive = round( $settings->sub_heading_line_height['small'] / $settings->sub_heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->sub_heading_line_height['medium'] ) && isset( $settings->sub_heading_font_size['medium'] ) && 0 != $settings->sub_heading_font_size['medium'] && ! isset( $settings->sub_heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['medium'] ) && is_numeric( $settings->sub_heading_font_size['medium'] ) ) {
					$settings->sub_heading_line_height_unit_medium = round( $settings->sub_heading_line_height['medium'] / $settings->sub_heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->sub_heading_line_height['desktop'] ) && isset( $settings->sub_heading_font_size['desktop'] ) && 0 != $settings->sub_heading_font_size['desktop'] && ! isset( $settings->sub_heading_line_height_unit ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['desktop'] ) && is_numeric( $settings->sub_heading_font_size['desktop'] ) ) {
					$settings->sub_heading_line_height_unit = round( $settings->sub_heading_line_height['desktop'] / $settings->sub_heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->sub_heading_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Interactive Banner 1.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_interactive_banner_one( &$settings ) {

			if ( isset( $settings->title_typography_font_size['small'] ) && ! isset( $settings->title_typography_font_size_unit_responsive ) ) {
				$settings->title_typography_font_size_unit_responsive = $settings->title_typography_font_size['small'];
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) && ! isset( $settings->title_typography_font_size_unit_medium ) ) {
				$settings->title_typography_font_size_unit_medium = $settings->title_typography_font_size['medium'];
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) && ! isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_typography_font_size_unit = $settings->title_typography_font_size['desktop'];
			}

			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] && ! isset( $settings->title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_typography_line_height_unit_responsive = round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] && ! isset( $settings->title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_typography_line_height_unit_medium = round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] && ! isset( $settings->title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_typography_line_height_unit = round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_typography_font_size['small'] ) && ! isset( $settings->desc_typography_font_size_unit_responsive ) ) {
				$settings->desc_typography_font_size_unit_responsive = $settings->desc_typography_font_size['small'];
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) && ! isset( $settings->desc_typography_font_size_unit_medium ) ) {
				$settings->desc_typography_font_size_unit_medium = $settings->desc_typography_font_size['medium'];
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) && ! isset( $settings->desc_typography_font_size_unit ) ) {
				$settings->desc_typography_font_size_unit = $settings->desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 != $settings->desc_typography_font_size['small'] && ! isset( $settings->desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_typography_line_height_unit_responsive = round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 != $settings->desc_typography_font_size['medium'] && ! isset( $settings->desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_typography_line_height_unit_medium = round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 != $settings->desc_typography_font_size['desktop'] && ! isset( $settings->desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_typography_line_height_unit = round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->button->font_size->small ) && ! isset( $settings->button->font_size_unit_responsive ) ) {
				$settings->button->font_size_unit_responsive = $settings->button->font_size->small;
			}
			if ( isset( $settings->button->font_size->medium ) && ! isset( $settings->button->font_size_unit_medium ) ) {
				$settings->button->font_size_unit_medium = $settings->button->font_size->medium;
			}
			if ( isset( $settings->button->font_size->desktop ) && ! isset( $settings->button->font_size_unit ) ) {
				$settings->button->font_size_unit = $settings->button->font_size->desktop;
			}

			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 != $settings->button->font_size->small && ! isset( $settings->button->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->line_height_unit_responsive = round( $settings->button->line_height->small / $settings->button->font_size->small, 2 );
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 != $settings->button->font_size->medium && ! isset( $settings->button->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->line_height_unit_medium = round( $settings->button->line_height->medium / $settings->button->font_size->medium, 2 );
				}
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 != $settings->button->font_size->desktop && ! isset( $settings->button->line_height_unit ) ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->line_height_unit = round( $settings->button->line_height->desktop / $settings->button->font_size->desktop, 2 );
				}
			}

		}

		/**
		 * UABB Interactive Banner 2.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_interactive_banner_two( &$settings ) {

			if ( isset( $settings->title_typography_font_size['small'] ) && ! isset( $settings->title_typography_font_size_unit_responsive ) ) {
				$settings->title_typography_font_size_unit_responsive = $settings->title_typography_font_size['small'];
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) && ! isset( $settings->title_typography_font_size_unit_medium ) ) {
				$settings->title_typography_font_size_unit_medium = $settings->title_typography_font_size['medium'];
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) && ! isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_typography_font_size_unit = $settings->title_typography_font_size['desktop'];
			}

			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] && ! isset( $settings->title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_typography_line_height_unit_responsive = round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] && ! isset( $settings->title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_typography_line_height_unit_medium = round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] && ! isset( $settings->title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_typography_line_height_unit = round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_typography_font_size['small'] ) && ! isset( $settings->desc_typography_font_size_unit_responsive ) ) {
				$settings->desc_typography_font_size_unit_responsive = $settings->desc_typography_font_size['small'];
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) && ! isset( $settings->desc_typography_font_size_unit_medium ) ) {
				$settings->desc_typography_font_size_unit_medium = $settings->desc_typography_font_size['medium'];
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) && ! isset( $settings->desc_typography_font_size_unit ) ) {
				$settings->desc_typography_font_size_unit = $settings->desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 != $settings->desc_typography_font_size['small'] && ! isset( $settings->desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_typography_line_height_unit_responsive = round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 != $settings->desc_typography_font_size['medium'] && ! isset( $settings->desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_typography_line_height_unit_medium = round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 != $settings->desc_typography_font_size['desktop'] && ! isset( $settings->desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_typography_line_height_unit = round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB List Icon.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_list_icon( &$settings ) {

			if ( isset( $settings->typography_font_size['small'] ) && ! isset( $settings->typography_font_size_unit_responsive ) ) {
				$settings->typography_font_size_unit_responsive = $settings->typography_font_size['small'];
			}
			if ( isset( $settings->typography_font_size['medium'] ) && ! isset( $settings->typography_font_size_unit_medium ) ) {
				$settings->typography_font_size_unit_medium = $settings->typography_font_size['medium'];
			}
			if ( isset( $settings->typography_font_size['desktop'] ) && ! isset( $settings->typography_font_size_unit ) ) {
				$settings->typography_font_size_unit = $settings->typography_font_size['desktop'];
			}

			if ( isset( $settings->typography_line_height['small'] ) && isset( $settings->typography_font_size['small'] ) && 0 != $settings->typography_font_size['small'] && ! isset( $settings->typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->typography_line_height['small'] ) && is_numeric( $settings->typography_font_size['small'] ) ) {
					$settings->typography_line_height_unit_responsive = round( $settings->typography_line_height['small'] / $settings->typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->typography_line_height['medium'] ) && isset( $settings->typography_font_size['medium'] ) && 0 != $settings->typography_font_size['medium'] && ! isset( $settings->typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->typography_line_height['medium'] ) && is_numeric( $settings->typography_font_size['medium'] ) ) {
					$settings->typography_line_height_unit_medium = round( $settings->typography_line_height['medium'] / $settings->typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->typography_line_height['desktop'] ) && isset( $settings->typography_font_size['desktop'] ) && 0 != $settings->typography_font_size['desktop'] && ! isset( $settings->typography_line_height_unit ) ) {
				if ( is_numeric( $settings->typography_line_height['desktop'] ) && is_numeric( $settings->typography_font_size['desktop'] ) ) {
					$settings->typography_line_height_unit = round( $settings->typography_line_height['desktop'] / $settings->typography_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Subscription Form.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_mailchimp_subscribe_form( &$settings ) {

			if ( isset( $settings->padding ) && ! isset( $settings->padding_dimension_top ) && ! isset( $settings->padding_dimension_bottom ) && ! isset( $settings->padding_dimension_left ) && ! isset( $settings->padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->padding_dimension_top    = '';
				$settings->padding_dimension_bottom = '';
				$settings->padding_dimension_left   = '';
				$settings->padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->padding_dimension_top    = (int) $output[ $i ][1];
							$settings->padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->padding_dimension_left   = (int) $output[ $i ][1];
							$settings->padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_size_unit_responsive = $settings->heading_font_size['small'];
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_size_unit_medium = $settings->heading_font_size['medium'];
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_size_unit ) ) {
				$settings->heading_font_size_unit = $settings->heading_font_size['desktop'];
			}

			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_line_height_unit_responsive = round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_line_height_unit_medium = round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_line_height_unit = round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->subheading_font_size['small'] ) && ! isset( $settings->subheading_font_size_unit_responsive ) ) {
				$settings->subheading_font_size_unit_responsive = $settings->subheading_font_size['small'];
			}
			if ( isset( $settings->subheading_font_size['medium'] ) && ! isset( $settings->subheading_font_size_unit_medium ) ) {
				$settings->subheading_font_size_unit_medium = $settings->subheading_font_size['medium'];
			}
			if ( isset( $settings->subheading_font_size['desktop'] ) && ! isset( $settings->subheading_font_size_unit ) ) {
				$settings->subheading_font_size_unit = $settings->subheading_font_size['desktop'];
			}

			if ( isset( $settings->subheading_line_height['small'] ) && isset( $settings->subheading_font_size['small'] ) && 0 != $settings->subheading_font_size['small'] && ! isset( $settings->subheading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->subheading_line_height['small'] ) && is_numeric( $settings->subheading_font_size['small'] ) ) {
					$settings->subheading_line_height_unit_responsive = round( $settings->subheading_line_height['small'] / $settings->subheading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->subheading_line_height['medium'] ) && isset( $settings->subheading_font_size['medium'] ) && 0 != $settings->subheading_font_size['medium'] && ! isset( $settings->subheading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->subheading_line_height['medium'] ) && is_numeric( $settings->subheading_font_size['medium'] ) ) {
					$settings->subheading_line_height_unit_medium = round( $settings->subheading_line_height['medium'] / $settings->subheading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->subheading_line_height['desktop'] ) && isset( $settings->subheading_font_size['desktop'] ) && 0 != $settings->subheading_font_size['desktop'] && ! isset( $settings->subheading_line_height_unit ) ) {
				if ( is_numeric( $settings->subheading_line_height['desktop'] ) && is_numeric( $settings->subheading_font_size['desktop'] ) ) {
					$settings->subheading_line_height_unit = round( $settings->subheading_line_height['desktop'] / $settings->subheading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_size_unit_responsive = $settings->text_font_size['small'];
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_size_unit_medium = $settings->text_font_size['medium'];
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_size_unit = $settings->text_font_size['desktop'];
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_line_height_unit_responsive = round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_line_height_unit_medium = round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_line_height_unit = round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->input_font_size['small'] ) && ! isset( $settings->input_font_size_unit_responsive ) ) {
				$settings->input_font_size_unit_responsive = $settings->input_font_size['small'];
			}
			if ( isset( $settings->input_font_size['medium'] ) && ! isset( $settings->input_font_size_unit_medium ) ) {
				$settings->input_font_size_unit_medium = $settings->input_font_size['medium'];
			}
			if ( isset( $settings->input_font_size['desktop'] ) && ! isset( $settings->input_font_size_unit ) ) {
				$settings->input_font_size_unit = $settings->input_font_size['desktop'];
			}

			if ( isset( $settings->input_line_height['small'] ) && isset( $settings->input_font_size['small'] ) && 0 != $settings->input_font_size['small'] && ! isset( $settings->input_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->input_line_height['small'] ) && is_numeric( $settings->input_font_size['small'] ) ) {
					$settings->input_line_height_unit_responsive = round( $settings->input_line_height['small'] / $settings->input_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->input_line_height['medium'] ) && isset( $settings->input_font_size['medium'] ) && 0 != $settings->input_font_size['medium'] && ! isset( $settings->input_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->input_line_height['medium'] ) && is_numeric( $settings->input_font_size['medium'] ) ) {
					$settings->input_line_height_unit_medium = round( $settings->input_line_height['medium'] / $settings->input_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->input_line_height['desktop'] ) && isset( $settings->input_font_size['desktop'] ) && 0 != $settings->input_font_size['desktop'] && ! isset( $settings->input_line_height_unit ) ) {
				if ( is_numeric( $settings->input_line_height['desktop'] ) && is_numeric( $settings->input_font_size['desktop'] ) ) {
					$settings->input_line_height_unit = round( $settings->input_line_height['desktop'] / $settings->input_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Modal Popup.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_modal_popup( &$settings ) {

			if ( isset( $settings->title_spacing ) && ! isset( $settings->title_spacing_dimension_top ) && ! isset( $settings->title_spacing_dimension_bottom ) && ! isset( $settings->title_spacing_dimension_left ) && ! isset( $settings->title_spacing_dimension_right ) ) {

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
			}

			if ( isset( $settings->modal_spacing ) && ! isset( $settings->modal_spacing_dimension_top ) && ! isset( $settings->modal_spacing_dimension_bottom ) && ! isset( $settings->modal_spacing_dimension_left ) && ! isset( $settings->modal_spacing_dimension_right ) ) {

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
			}

			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_size_unit_responsive = $settings->title_font_size['small'];
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_size_unit_medium = $settings->title_font_size['medium'];
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_size_unit = $settings->title_font_size['desktop'];
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_line_height_unit_responsive = round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_line_height_unit_medium = round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->title_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_line_height_unit = round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->ct_content_font_size['small'] ) && ! isset( $ct_content_font_size_unit_responsive ) ) {
				$settings->ct_content_font_size_unit_responsive = $settings->ct_content_font_size['small'];
			}
			if ( isset( $settings->ct_content_font_size['medium'] ) && ! isset( $settings->ct_content_font_size_unit_medium ) ) {
				$settings->ct_content_font_size_unit_medium = $settings->ct_content_font_size['medium'];
			}
			if ( isset( $settings->ct_content_font_size['desktop'] ) && ! isset( $settings->ct_content_font_size_unit ) ) {
				$settings->ct_content_font_size_unit = $settings->ct_content_font_size['desktop'];
			}

			if ( isset( $settings->ct_content_line_height['small'] ) && isset( $settings->ct_content_font_size['small'] ) && 0 != $settings->ct_content_font_size['small'] && ! isset( $settings->ct_content_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->ct_content_line_height['small'] ) && is_numeric( $settings->ct_content_font_size['small'] ) ) {
					$settings->ct_content_line_height_unit_responsive = round( $settings->ct_content_line_height['small'] / $settings->ct_content_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->ct_content_line_height['medium'] ) && isset( $settings->ct_content_font_size['medium'] ) && 0 != $settings->ct_content_font_size['medium'] && ! isset( $settings->ct_content_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->ct_content_line_height['medium'] ) && is_numeric( $settings->ct_content_font_size['medium'] ) ) {
					$settings->ct_content_line_height_unit_medium = round( $settings->ct_content_line_height['medium'] / $settings->ct_content_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->ct_content_line_height['desktop'] ) && isset( $settings->ct_content_font_size['desktop'] ) && 0 != $settings->ct_content_font_size['desktop'] && ! isset( $settings->ct_content_line_height_unit ) ) {
				if ( is_numeric( $settings->ct_content_line_height['desktop'] ) && is_numeric( $settings->ct_content_font_size['desktop'] ) ) {
					$settings->ct_content_line_height_unit = round( $settings->ct_content_line_height['desktop'] / $settings->ct_content_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Photo Gallery.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_photo_gallery( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Price Box.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_pricing_box( &$settings ) {

			if ( isset( $settings->title_typography_font_size['small'] ) && ! isset( $settings->title_typography_font_size_unit_responsive ) ) {
				$settings->title_typography_font_size_unit_responsive = $settings->title_typography_font_size['small'];
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) && ! isset( $settings->title_typography_font_size_unit_medium ) ) {
				$settings->title_typography_font_size_unit_medium = $settings->title_typography_font_size['medium'];
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) && ! isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_typography_font_size_unit = $settings->title_typography_font_size['desktop'];
			}

			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 != $settings->title_typography_font_size['small'] && ! isset( $settings->title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_typography_line_height_unit_responsive = round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 != $settings->title_typography_font_size['medium'] && ! isset( $settings->title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_typography_line_height_unit_medium = round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 != $settings->title_typography_font_size['desktop'] && ! isset( $settings->title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_typography_line_height_unit = round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->price_typography_font_size['small'] ) && ! isset( $settings->price_typography_font_size_unit_responsive ) ) {
				$settings->price_typography_font_size_unit_responsive = $settings->price_typography_font_size['small'];
			}
			if ( isset( $settings->price_typography_font_size['medium'] ) && ! isset( $settings->price_typography_font_size_unit_medium ) ) {
				$settings->price_typography_font_size_unit_medium = $settings->price_typography_font_size['medium'];
			}
			if ( isset( $settings->price_typography_font_size['desktop'] ) && ! isset( $settings->price_typography_font_size_unit ) ) {
				$settings->price_typography_font_size_unit = $settings->price_typography_font_size['desktop'];
			}

			if ( isset( $settings->price_typography_line_height['small'] ) && isset( $settings->price_typography_font_size['small'] ) && 0 != $settings->price_typography_font_size['small'] && ! isset( $settings->price_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->price_typography_line_height['small'] ) && is_numeric( $settings->price_typography_font_size['small'] ) ) {
					$settings->price_typography_line_height_unit_responsive = round( $settings->price_typography_line_height['small'] / $settings->price_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->price_typography_line_height['medium'] ) && isset( $settings->price_typography_font_size['medium'] ) && 0 != $settings->price_typography_font_size['medium'] && ! isset( $settings->price_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->price_typography_line_height['medium'] ) && is_numeric( $settings->price_typography_font_size['medium'] ) ) {
					$settings->price_typography_line_height_unit_medium = round( $settings->price_typography_line_height['medium'] / $settings->price_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->price_typography_line_height['desktop'] ) && isset( $settings->price_typography_font_size['desktop'] ) && 0 != $settings->price_typography_font_size['desktop'] && ! isset( $settings->price_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->price_typography_line_height['desktop'] ) && is_numeric( $settings->price_typography_font_size['desktop'] ) ) {
					$settings->price_typography_line_height_unit = round( $settings->price_typography_line_height['desktop'] / $settings->price_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->duration_typography_font_size['small'] ) && ! isset( $settings->duration_typography_font_size_unit_responsive ) ) {
				$settings->duration_typography_font_size_unit_responsive = $settings->duration_typography_font_size['small'];
			}
			if ( isset( $settings->duration_typography_font_size['medium'] ) && ! isset( $settings->duration_typography_font_size_unit_medium ) ) {
				$settings->duration_typography_font_size_unit_medium = $settings->duration_typography_font_size['medium'];
			}
			if ( isset( $settings->duration_typography_font_size['desktop'] ) && ! isset( $settings->duration_typography_font_size_unit ) ) {
				$settings->duration_typography_font_size_unit = $settings->duration_typography_font_size['desktop'];
			}

			if ( isset( $settings->duration_typography_line_height['small'] ) && isset( $settings->duration_typography_font_size['small'] ) && 0 != $settings->duration_typography_font_size['small'] && ! isset( $settings->duration_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->duration_typography_line_height['small'] ) && is_numeric( $settings->duration_typography_font_size['small'] ) ) {
					$settings->duration_typography_line_height_unit_responsive = round( $settings->duration_typography_line_height['small'] / $settings->duration_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->duration_typography_line_height['medium'] ) && isset( $settings->duration_typography_font_size['medium'] ) && 0 != $settings->duration_typography_font_size['medium'] && ! isset( $settings->duration_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->duration_typography_line_height['medium'] ) && is_numeric( $settings->duration_typography_font_size['medium'] ) ) {
					$settings->duration_typography_line_height_unit_medium = round( $settings->duration_typography_line_height['medium'] / $settings->duration_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->duration_typography_line_height['desktop'] ) && isset( $settings->duration_typography_font_size['desktop'] ) && 0 != $settings->duration_typography_font_size['desktop'] && ! isset( $settings->duration_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->duration_typography_line_height['desktop'] ) && is_numeric( $settings->duration_typography_font_size['desktop'] ) ) {
					$settings->duration_typography_line_height_unit = round( $settings->duration_typography_line_height['desktop'] / $settings->duration_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->feature_typography_font_size['small'] ) && ! isset( $settings->feature_typography_font_size_unit_responsive ) ) {
				$settings->feature_typography_font_size_unit_responsive = $settings->feature_typography_font_size['small'];
			}
			if ( isset( $settings->feature_typography_font_size['medium'] ) && ! isset( $settings->feature_typography_font_size_unit_medium ) ) {
				$settings->feature_typography_font_size_unit_medium = $settings->feature_typography_font_size['medium'];
			}
			if ( isset( $settings->feature_typography_font_size['desktop'] ) && ! isset( $settings->feature_typography_font_size_unit ) ) {
				$settings->feature_typography_font_size_unit = $settings->feature_typography_font_size['desktop'];
			}

			if ( isset( $settings->feature_typography_line_height['small'] ) && isset( $settings->feature_typography_font_size['small'] ) && 0 != $settings->feature_typography_font_size['small'] && ! isset( $settings->feature_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->feature_typography_line_height['small'] ) && is_numeric( $settings->feature_typography_font_size['small'] ) ) {
					$settings->feature_typography_line_height_unit_responsive = round( $settings->feature_typography_line_height['small'] / $settings->feature_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->feature_typography_line_height['medium'] ) && isset( $settings->feature_typography_font_size['medium'] ) && 0 != $settings->feature_typography_font_size['medium'] && ! isset( $settings->feature_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->feature_typography_line_height['medium'] ) && is_numeric( $settings->feature_typography_font_size['medium'] ) ) {
					$settings->feature_typography_line_height_unit_medium = round( $settings->feature_typography_line_height['medium'] / $settings->feature_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->feature_typography_line_height['desktop'] ) && isset( $settings->feature_typography_font_size['desktop'] ) && 0 != $settings->feature_typography_font_size['desktop'] && ! isset( $settings->feature_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->feature_typography_line_height['desktop'] ) && is_numeric( $settings->feature_typography_font_size['desktop'] ) ) {
					$settings->feature_typography_line_height_unit = round( $settings->feature_typography_line_height['desktop'] / $settings->feature_typography_font_size['desktop'], 2 );
				}
			}

			for ( $i = 0; $i < count( $settings->pricing_columns ); $i++ ) {
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) && ! isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive ) ) {
					$settings->pricing_columns[ $i ]->button_typography_font_size_unit_responsive = $settings->pricing_columns[ $i ]->button_typography_font_size->small;
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) && ! isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium ) ) {
					$settings->pricing_columns[ $i ]->button_typography_font_size_unit_medium = $settings->pricing_columns[ $i ]->button_typography_font_size->medium;
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) && ! isset( $settings->pricing_columns[ $i ]->button_typography_font_size_unit ) ) {
					$settings->pricing_columns[ $i ]->button_typography_font_size_unit = $settings->pricing_columns[ $i ]->button_typography_font_size->desktop;
				}

				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->small ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->small && ! isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->small ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->small ) ) {
						$settings->pricing_columns[ $i ]->button_typography_line_height_unit_responsive = round( $settings->pricing_columns[ $i ]->button_typography_line_height->small / $settings->pricing_columns[ $i ]->button_typography_font_size->small, 2 );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->medium ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->medium && ! isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->medium ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->medium ) ) {
						$settings->pricing_columns[ $i ]->button_typography_line_height_unit_medium = round( $settings->pricing_columns[ $i ]->button_typography_line_height->medium / $settings->pricing_columns[ $i ]->button_typography_font_size->medium, 2 );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop ) && isset( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) && 0 != $settings->pricing_columns[ $i ]->button_typography_font_size->desktop && ! isset( $settings->pricing_columns[ $i ]->button_typography_line_height_unit ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop ) && is_numeric( $settings->pricing_columns[ $i ]->button_typography_font_size->desktop ) ) {
						$settings->pricing_columns[ $i ]->button_typography_line_height_unit = round( $settings->pricing_columns[ $i ]->button_typography_line_height->desktop / $settings->pricing_columns[ $i ]->button_typography_font_size->desktop, 2 );
					}
				}

				if ( isset( $settings->legend_column->legend_font_size->small ) && isset( $settings->legend_column->legend_font_size->small ) && 0 != $settings->legend_column->legend_font_size->small && ! isset( $settings->legend_column->legend_font_size_unit_responsive ) ) {
					if ( is_numeric( $settings->legend_column->legend_font_size->small ) && is_numeric( $settings->legend_column->legend_font_size->small ) ) {
						$settings->legend_column->legend_font_size_unit_responsive = round( $settings->legend_column->legend_font_size->small / $settings->legend_column->legend_font_size->small, 2 );
					}
				}
				if ( isset( $settings->legend_column->legend_font_size->medium ) && isset( $settings->legend_column->legend_font_size->medium ) && 0 != $settings->legend_column->legend_font_size->medium && ! isset( $settings->legend_column->legend_font_size_unit_medium ) ) {
					if ( is_numeric( $settings->legend_column->legend_font_size->medium ) && is_numeric( $settings->legend_column->legend_font_size->medium ) ) {
						$settings->legend_column->legend_font_size_unit_medium = round( $settings->legend_column->legend_font_size->medium / $settings->legend_column->legend_font_size->medium, 2 );
					}
				}
				if ( isset( $settings->legend_column->legend_font_size->desktop ) && isset( $settings->legend_column->legend_font_size->desktop ) && 0 != $settings->legend_column->legend_font_size->desktop && ! isset( $settings->legend_column->legend_font_size_unit ) ) {
					if ( is_numeric( $settings->legend_column->legend_font_size->desktop ) && is_numeric( $settings->legend_column->legend_font_size->desktop ) ) {
						$settings->legend_column->legend_font_size_unit = round( $settings->legend_column->legend_font_size->desktop / $settings->legend_column->legend_font_size->desktop, 2 );
					}
				}

				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) && ! isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_responsive ) ) {
					$settings->pricing_columns[ $i ]->featured_font_size_unit_responsive = $settings->pricing_columns[ $i ]->featured_font_size->small;
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && ! isset( $settings->pricing_columns[ $i ]->featured_font_size_unit_medium ) ) {
					$settings->pricing_columns[ $i ]->featured_font_size_unit_medium = $settings->pricing_columns[ $i ]->featured_font_size->medium;
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && ! isset( $settings->pricing_columns[ $i ]->featured_font_size_unit ) ) {
					$settings->pricing_columns[ $i ]->featured_font_size_unit = $settings->pricing_columns[ $i ]->featured_font_size->desktop;
				}

				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->small ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->small ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->small && ! isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_responsive ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->small ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->small ) ) {
						$settings->pricing_columns[ $i ]->featured_line_height_unit_responsive = round( $settings->pricing_columns[ $i ]->featured_line_height->small / $settings->pricing_columns[ $i ]->featured_font_size->small, 2 );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->medium ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->medium && ! isset( $settings->pricing_columns[ $i ]->featured_line_height_unit_medium ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->medium ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->medium ) ) {
						$settings->pricing_columns[ $i ]->featured_line_height_unit_medium = round( $settings->pricing_columns[ $i ]->featured_line_height->medium / $settings->pricing_columns[ $i ]->featured_font_size->medium, 2 );
					}
				}
				if ( isset( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && isset( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) && 0 != $settings->pricing_columns[ $i ]->featured_font_size->desktop && ! isset( $settings->pricing_columns[ $i ]->featured_line_height_unit ) ) {
					if ( is_numeric( $settings->pricing_columns[ $i ]->featured_line_height->desktop ) && is_numeric( $settings->pricing_columns[ $i ]->featured_font_size->desktop ) ) {
						$settings->pricing_columns[ $i ]->featured_line_height_unit = round( $settings->pricing_columns[ $i ]->featured_line_height->desktop / $settings->pricing_columns[ $i ]->featured_font_size->desktop, 2 );
					}
				}
			}
		}

		/**
		 * UABB Contact form.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_contact_form( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->label_font_size['small'] ) && ! isset( $settings->label_font_size_unit_responsive ) ) {
				$settings->label_font_size_unit_responsive = $settings->label_font_size['small'];
			}
			if ( isset( $settings->label_font_size['medium'] ) && ! isset( $settings->label_font_size_unit_medium ) ) {
				$settings->label_font_size_unit_medium = $settings->label_font_size['medium'];
			}
			if ( isset( $settings->label_font_size['desktop'] ) && ! isset( $settings->label_font_size_unit ) ) {
				$settings->label_font_size_unit = $settings->label_font_size['desktop'];
			}

			if ( isset( $settings->label_line_height['small'] ) && isset( $settings->label_font_size['small'] ) && 0 != $settings->label_font_size['small'] && ! isset( $settings->label_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->label_line_height['small'] ) && is_numeric( $settings->label_font_size['small'] ) ) {
					$settings->label_line_height_unit_responsive = round( $settings->label_line_height['small'] / $settings->label_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['medium'] ) && isset( $settings->label_font_size['medium'] ) && 0 != $settings->label_font_size['medium'] && ! isset( $settings->label_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->label_line_height['medium'] ) && is_numeric( $settings->label_font_size['medium'] ) ) {
					$settings->label_line_height_unit_medium = round( $settings->label_line_height['medium'] / $settings->label_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->label_line_height['desktop'] ) && isset( $settings->label_font_size['desktop'] ) && 0 != $settings->label_font_size['desktop'] && ! isset( $settings->label_line_height_unit ) ) {
				if ( is_numeric( $settings->label_line_height['desktop'] ) && is_numeric( $settings->label_font_size['desktop'] ) ) {
					$settings->label_line_height_unit = round( $settings->label_line_height['desktop'] / $settings->label_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->form_spacing ) && ! isset( $settings->form_spacing_dimension_top ) && ! isset( $settings->form_spacing_dimension_bottom ) && ! isset( $settings->form_spacing_dimension_left ) && ! isset( $settings->form_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->form_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->form_spacing_dimension_top    = '';
				$settings->form_spacing_dimension_bottom = '';
				$settings->form_spacing_dimension_left   = '';
				$settings->form_spacing_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->form_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->form_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->form_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->form_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->form_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB Call to action.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_call_to_action( &$settings ) {

			if ( isset( $settings->title_font_size['small'] ) && ! isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_size_unit_responsive = $settings->title_font_size['small'];
			}
			if ( isset( $settings->title_font_size['medium'] ) && ! isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_size_unit_medium = $settings->title_font_size['medium'];
			}
			if ( isset( $settings->title_font_size['desktop'] ) && ! isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_size_unit = $settings->title_font_size['desktop'];
			}

			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_line_height_unit_responsive = round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] && ! isset( $settings->title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_line_height_unit_medium = round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] && ! isset( $settings->title_line_height_unit ) ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_line_height_unit = round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->subhead_font_size['small'] ) && ! isset( $settings->subhead_font_size_unit_responsive ) ) {
				$settings->subhead_font_size_unit_responsive = $settings->subhead_font_size['small'];
			}
			if ( isset( $settings->subhead_font_size['medium'] ) && ! isset( $settings->subhead_font_size_unit_medium ) ) {
				$settings->subhead_font_size_unit_medium = $settings->subhead_font_size['medium'];
			}
			if ( isset( $settings->subhead_font_size['desktop'] ) && ! isset( $settings->subhead_font_size_unit ) ) {
				$settings->subhead_font_size_unit = $settings->subhead_font_size['desktop'];
			}

			if ( isset( $settings->subhead_line_height['small'] ) && isset( $settings->subhead_font_size['small'] ) && 0 != $settings->subhead_font_size['small'] && ! isset( $settings->subhead_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->subhead_line_height['small'] ) && is_numeric( $settings->subhead_font_size['small'] ) ) {
					$settings->subhead_line_height_unit_responsive = round( $settings->subhead_line_height['small'] / $settings->subhead_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->subhead_line_height['medium'] ) && isset( $settings->subhead_font_size['medium'] ) && 0 != $settings->subhead_font_size['medium'] && ! isset( $settings->subhead_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->subhead_line_height['medium'] ) && is_numeric( $settings->subhead_font_size['medium'] ) ) {
					$settings->subhead_line_height_unit_medium = round( $settings->subhead_line_height['medium'] / $settings->subhead_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->subhead_line_height['desktop'] ) && isset( $settings->subhead_font_size['desktop'] ) && 0 != $settings->subhead_font_size['desktop'] && ! isset( $settings->subhead_line_height_unit ) ) {
				if ( is_numeric( $settings->subhead_line_height['desktop'] ) && is_numeric( $settings->subhead_font_size['desktop'] ) ) {
					$settings->subhead_line_height_unit = round( $settings->subhead_line_height['desktop'] / $settings->subhead_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB Button.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_button( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Before after slider.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_beforeafterslider( &$settings ) {

			if ( isset( $settings->slider_font_size['small'] ) && ! isset( $settings->slider_font_size_unit_responsive ) ) {
				$settings->slider_font_size_unit_responsive = $settings->slider_font_size['small'];
			}
			if ( isset( $settings->slider_font_size['medium'] ) && ! isset( $settings->slider_font_size_unit_medium ) ) {
				$settings->slider_font_size_unit_medium = $settings->slider_font_size['medium'];
			}
			if ( isset( $settings->slider_font_size['desktop'] ) && ! isset( $settings->slider_font_size_unit ) ) {
				$settings->slider_font_size_unit = $settings->slider_font_size['desktop'];
			}

			if ( isset( $settings->slider_line_height['small'] ) && isset( $settings->slider_font_size['small'] ) && 0 != $settings->slider_font_size['small'] && ! isset( $settings->slider_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->slider_line_height['small'] ) && is_numeric( $settings->slider_font_size['small'] ) ) {
					$settings->slider_line_height_unit_responsive = round( $settings->slider_line_height['small'] / $settings->slider_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->slider_line_height['medium'] ) && isset( $settings->slider_font_size['medium'] ) && 0 != $settings->slider_font_size['medium'] && ! isset( $settings->slider_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->slider_line_height['medium'] ) && is_numeric( $settings->slider_font_size['medium'] ) ) {
					$settings->slider_line_height_unit_medium = round( $settings->slider_line_height['medium'] / $settings->slider_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->slider_line_height['desktop'] ) && isset( $settings->slider_font_size['desktop'] ) && 0 != $settings->slider_font_size['desktop'] && ! isset( $settings->slider_line_height_unit ) ) {
				if ( is_numeric( $settings->slider_line_height['desktop'] ) && is_numeric( $settings->slider_font_size['desktop'] ) ) {
					$settings->slider_line_height_unit = round( $settings->slider_line_height['desktop'] / $settings->slider_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Advanced Menu.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_advanced_menu( &$settings ) {

			if ( isset( $settings->creative_menu_link_margin ) && ! isset( $settings->creative_menu_link_margin_dimension_top ) && ! isset( $settings->creative_menu_link_margin_dimension_bottom ) && ! isset( $settings->creative_menu_link_margin_dimension_left ) && ! isset( $settings->creative_menu_link_margin_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_link_margin );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->creative_menu_link_margin_dimension_top    = '';
				$settings->creative_menu_link_margin_dimension_bottom = '';
				$settings->creative_menu_link_margin_dimension_left   = '';
				$settings->creative_menu_link_margin_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'margin-top':
							$settings->creative_menu_link_margin_dimension_top = (int) $output[ $i ][1];
							break;
						case 'margin-bottom':
							$settings->creative_menu_link_margin_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'margin-right':
							$settings->creative_menu_link_margin_dimension_right = (int) $output[ $i ][1];
							break;
						case 'margin-left':
							$settings->creative_menu_link_margin_dimension_left = (int) $output[ $i ][1];
							break;
						case 'margin':
							$settings->creative_menu_link_margin_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_link_margin_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->creative_menu_link_spacing ) && ! isset( $settings->creative_menu_link_spacing_dimension_top ) && ! isset( $settings->creative_menu_link_spacing_dimension_bottom ) && ! isset( $settings->creative_menu_link_spacing_dimension_left ) && ! isset( $settings->creative_menu_link_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_link_spacing );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_link_spacing_dimension_top    = '';
				$settings->creative_menu_link_spacing_dimension_bottom = '';
				$settings->creative_menu_link_spacing_dimension_right  = '';
				$settings->creative_menu_link_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_link_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_link_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_link_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_link_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_link_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_link_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->creative_menu_border_width ) && ! isset( $settings->creative_menu_border_width_dimension_top ) && ! isset( $settings->creative_menu_border_width_dimension_bottom ) && ! isset( $settings->creative_menu_border_width_dimension_left ) && ! isset( $settings->creative_menu_border_width_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_border_width );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_border_width_dimension_top    = '';
				$settings->creative_menu_border_width_dimension_bottom = '';
				$settings->creative_menu_border_width_dimension_right  = '';
				$settings->creative_menu_border_width_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_border_width_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_border_width_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_border_width_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_border_width_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_border_width_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_border_width_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_border_width_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_border_width_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->creative_submenu_link_padding ) && ! isset( $settings->creative_submenu_link_padding_dimension_top ) && ! isset( $settings->creative_submenu_link_padding_dimension_bottom ) && ! isset( $settings->creative_submenu_link_padding_dimension_left ) && ! isset( $settings->creative_submenu_link_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_submenu_link_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_submenu_link_padding_dimension_top    = '';
				$settings->creative_submenu_link_padding_dimension_bottom = '';
				$settings->creative_submenu_link_padding_dimension_right  = '';
				$settings->creative_submenu_link_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_submenu_link_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_submenu_link_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_submenu_link_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_submenu_link_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_submenu_link_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->creative_submenu_border_width ) && ! isset( $settings->creative_submenu_border_width_dimension_top ) && ! isset( $settings->creative_submenu_border_width_dimension_bottom ) && ! isset( $settings->creative_submenu_border_width_dimension_left ) && ! isset( $settings->creative_submenu_border_width_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_submenu_border_width );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_submenu_border_width_dimension_top    = '';
				$settings->creative_submenu_border_width_dimension_bottom = '';
				$settings->creative_submenu_border_width_dimension_right  = '';
				$settings->creative_submenu_border_width_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_submenu_border_width_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_submenu_border_width_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_submenu_border_width_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_submenu_border_width_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_submenu_border_width_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_submenu_border_width_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->creative_menu_responsive_overlay_padding ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_top ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_left ) && ! isset( $settings->creative_menu_responsive_overlay_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->creative_menu_responsive_overlay_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->creative_menu_responsive_overlay_padding_dimension_top    = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_bottom = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_right  = '';
				$settings->creative_menu_responsive_overlay_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->creative_menu_responsive_overlay_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->creative_menu_responsive_overlay_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->creative_menu_responsive_overlay_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->creative_menu_responsive_overlay_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->creative_menu_responsive_overlay_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB team.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function team( &$settings ) {

			if ( isset( $settings->img_spacing ) && ! isset( $settings->img_spacing_dimension_top ) && ! isset( $settings->img_spacing_dimension_bottom ) && ! isset( $settings->img_spacing_dimension_left ) && ! isset( $settings->img_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->img_spacing );

				$output                                 = array();
				$uabb_default                           = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->img_spacing_dimension_top    = '';
				$settings->img_spacing_dimension_bottom = '';
				$settings->img_spacing_dimension_right  = '';
				$settings->img_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {

					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->img_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->img_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->img_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->img_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->img_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->img_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->text_spacing ) && ! isset( $settings->text_spacing_dimension_top ) && ! isset( $settings->text_spacing_dimension_bottom ) && ! isset( $settings->text_spacing_dimension_left ) && ! isset( $settings->text_spacing_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->text_spacing );

				$output                                  = array();
				$uabb_default                            = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->text_spacing_dimension_top    = '';
				$settings->text_spacing_dimension_bottom = '';
				$settings->text_spacing_dimension_right  = '';
				$settings->text_spacing_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->text_spacing_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->text_spacing_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->text_spacing_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->text_spacing_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->text_spacing_dimension_top    = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_bottom = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_left   = (int) $output[ $i ][1];
							$settings->text_spacing_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desg_font_size['small'] ) && ! isset( $settings->desg_font_size_unit_responsive ) ) {
				$settings->desg_font_size_unit_responsive = $settings->desg_font_size['small'];
			}
			if ( isset( $settings->desg_font_size['medium'] ) && ! isset( $settings->desg_font_size_unit_medium ) ) {
				$settings->desg_font_size_unit_medium = $settings->desg_font_size['medium'];
			}
			if ( isset( $settings->desg_font_size['desktop'] ) && ! isset( $settings->desg_font_size_unit ) ) {
				$settings->desg_font_size_unit = $settings->desg_font_size['desktop'];
			}

			if ( isset( $settings->desg_line_height['small'] ) && isset( $settings->desg_font_size['small'] ) && 0 != $settings->desg_font_size['small'] && ! isset( $settings->desg_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desg_line_height['small'] ) && is_numeric( $settings->desg_font_size['small'] ) ) {
					$settings->desg_line_height_unit_responsive = round( $settings->desg_line_height['small'] / $settings->desg_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desg_line_height['medium'] ) && isset( $settings->desg_font_size['medium'] ) && 0 != $settings->desg_font_size['medium'] && ! isset( $settings->desg_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desg_line_height['medium'] ) && is_numeric( $settings->desg_font_size['medium'] ) ) {
					$settings->desg_line_height_unit_medium = round( $settings->desg_line_height['medium'] / $settings->desg_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desg_line_height['desktop'] ) && isset( $settings->desg_font_size['desktop'] ) && 0 != $settings->desg_font_size['desktop'] && ! isset( $settings->desg_line_height_unit ) ) {
				if ( is_numeric( $settings->desg_line_height['desktop'] ) && is_numeric( $settings->desg_font_size['desktop'] ) ) {
					$settings->desg_line_height_unit = round( $settings->desg_line_height['desktop'] / $settings->desg_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_size_unit_responsive = $settings->desc_font_size['small'];
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_size_unit_medium = $settings->desc_font_size['medium'];
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_size_unit = $settings->desc_font_size['desktop'];
			}

			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_line_height_unit_responsive = round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_line_height_unit_medium = round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_line_height_unit = round( $settings->desg_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Slide Box.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function slide_box( &$settings ) {

			if ( isset( $settings->front_padding ) && ! isset( $settings->front_padding_dimension_top ) && ! isset( $settings->front_padding_dimension_bottom ) && ! isset( $settings->front_padding_dimension_left ) && ! isset( $settings->front_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->front_padding );

				$output                                   = array();
				$uabb_default                             = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->front_padding_dimension_top    = '';
				$settings->front_padding_dimension_bottom = '';
				$settings->front_padding_dimension_right  = '';
				$settings->front_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {

					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->front_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->front_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->front_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->front_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->front_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->front_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->front_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->front_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->back_padding ) && ! isset( $settings->back_padding_dimension_top ) && ! isset( $settings->back_padding_dimension_bottom ) && ! isset( $settings->back_padding_dimension_left ) && ! isset( $settings->back_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->back_padding );

				$output                                  = array();
				$uabb_default                            = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->back_padding_dimension_top    = '';
				$settings->back_padding_dimension_bottom = '';
				$settings->back_padding_dimension_right  = '';
				$settings->back_padding_dimension_left   = '';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->back_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->back_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->back_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->back_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->back_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->back_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->back_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->back_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->front_title_font_size['small'] ) && ! isset( $settings->front_title_font_size_unit_responsive ) ) {
				$settings->front_title_font_size_unit_responsive = $settings->front_title_font_size['small'];
			}
			if ( isset( $settings->front_title_font_size['medium'] ) && ! isset( $settings->front_title_font_size_unit_medium ) ) {
				$settings->front_title_font_size_unit_medium = $settings->front_title_font_size['medium'];
			}
			if ( isset( $settings->front_title_font_size['desktop'] ) && ! isset( $settings->front_title_font_size_unit ) ) {
				$settings->front_title_font_size_unit = $settings->front_title_font_size['desktop'];
			}

			if ( isset( $settings->front_title_line_height['small'] ) && isset( $settings->front_title_font_size['small'] ) && 0 != $settings->front_title_font_size['small'] && ! isset( $settings->front_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_title_line_height['small'] ) && is_numeric( $settings->front_title_font_size['small'] ) ) {
					$settings->front_title_line_height_unit_responsive = round( $settings->front_title_line_height['small'] / $settings->front_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_title_line_height['medium'] ) && isset( $settings->front_title_font_size['medium'] ) && 0 != $settings->front_title_font_size['medium'] && ! isset( $settings->front_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_title_line_height['medium'] ) && is_numeric( $settings->front_title_font_size['medium'] ) ) {
					$settings->front_title_line_height_unit_medium = round( $settings->front_title_line_height['medium'] / $settings->front_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_title_line_height['desktop'] ) && isset( $settings->front_title_font_size['desktop'] ) && 0 != $settings->front_title_font_size['desktop'] && ! isset( $settings->front_title_line_height_unit ) ) {
				if ( is_numeric( $settings->front_title_line_height['desktop'] ) && is_numeric( $settings->front_title_font_size['desktop'] ) ) {
					$settings->front_title_line_height_unit = round( $settings->front_title_line_height['desktop'] / $settings->front_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->front_desc_font_size['small'] ) && ! isset( $settings->front_desc_font_size_unit_responsive ) ) {
				$settings->front_desc_font_size_unit_responsive = $settings->front_desc_font_size['small'];
			}
			if ( isset( $settings->front_desc_font_size['medium'] ) && ! isset( $settings->front_desc_font_size_unit_medium ) ) {
				$settings->front_desc_font_size_unit_medium = $settings->front_desc_font_size['medium'];
			}
			if ( isset( $settings->front_desc_font_size['desktop'] ) && ! isset( $settings->front_desc_font_size_unit ) ) {
				$settings->front_desc_font_size_unit = $settings->front_desc_font_size['desktop'];
			}

			if ( isset( $settings->front_desc_line_height['small'] ) && isset( $settings->front_desc_font_size['small'] ) && 0 != $settings->front_desc_font_size['small'] && ! isset( $settings->front_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_desc_line_height['small'] ) && is_numeric( $settings->front_desc_font_size['small'] ) ) {
					$settings->front_desc_line_height_unit_responsive = round( $settings->front_desc_line_height['small'] / $settings->front_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_desc_line_height['medium'] ) && isset( $settings->front_desc_font_size['medium'] ) && 0 != $settings->front_desc_font_size['medium'] && ! isset( $settings->front_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_desc_line_height['medium'] ) && is_numeric( $settings->front_desc_font_size['medium'] ) ) {
					$settings->front_desc_line_height_unit_medium = round( $settings->front_desc_line_height['medium'] / $settings->front_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_desc_line_height['desktop'] ) && isset( $settings->front_desc_font_size['desktop'] ) && 0 != $settings->front_desc_font_size['desktop'] && ! isset( $settings->front_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->front_desc_line_height['desktop'] ) && is_numeric( $settings->front_desc_font_size['desktop'] ) ) {
					$settings->front_desc_line_height_unit = round( $settings->front_desc_line_height['desktop'] / $settings->front_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_title_font_size['small'] ) && ! isset( $settings->back_title_font_size_unit_responsive ) ) {
				$settings->back_title_font_size_unit_responsive = $settings->back_title_font_size['small'];
			}
			if ( isset( $settings->back_title_font_size['medium'] ) && ! isset( $settings->back_title_font_size_unit_medium ) ) {
				$settings->back_title_font_size_unit_medium = $settings->back_title_font_size['medium'];
			}
			if ( isset( $settings->back_title_font_size['desktop'] ) && ! isset( $settings->back_title_font_size_unit ) ) {
				$settings->back_title_font_size_unit = $settings->back_title_font_size['desktop'];
			}

			if ( isset( $settings->back_title_line_height['small'] ) && isset( $settings->back_title_font_size['small'] ) && 0 != $settings->back_title_font_size['small'] && ! isset( $settings->back_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_title_line_height['small'] ) && is_numeric( $settings->back_title_font_size['small'] ) ) {
					$settings->back_title_line_height_unit_responsive = round( $settings->back_title_line_height['small'] / $settings->back_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_title_line_height['medium'] ) && isset( $settings->back_title_font_size['medium'] ) && 0 != $settings->back_title_font_size['medium'] && ! isset( $settings->back_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_title_line_height['medium'] ) && is_numeric( $settings->back_title_font_size['medium'] ) ) {
					$settings->back_title_line_height_unit_medium = round( $settings->back_title_line_height['medium'] / $settings->back_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_title_line_height['desktop'] ) && isset( $settings->back_title_font_size['desktop'] ) && 0 != $settings->back_title_font_size['desktop'] && ! isset( $settings->back_title_line_height_unit ) ) {
				if ( is_numeric( $settings->back_title_line_height['desktop'] ) && is_numeric( $settings->back_title_font_size['desktop'] ) ) {
					$settings->back_title_line_height_unit = round( $settings->back_title_line_height['desktop'] / $settings->back_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_desc_font_size['small'] ) && ! isset( $settings->back_desc_font_size_unit_responsive ) ) {
				$settings->back_desc_font_size_unit_responsive = $settings->back_desc_font_size['small'];
			}
			if ( isset( $settings->back_desc_font_size['medium'] ) && ! isset( $settings->back_desc_font_size_unit_medium ) ) {
				$settings->back_desc_font_size_unit_medium = $settings->back_desc_font_size['medium'];
			}
			if ( isset( $settings->back_desc_font_size['desktop'] ) && ! isset( $settings->back_desc_font_size_unit ) ) {
				$settings->back_desc_font_size_unit = $settings->back_desc_font_size['desktop'];
			}

			if ( isset( $settings->back_desc_line_height['small'] ) && isset( $settings->back_desc_font_size['small'] ) && 0 != $settings->back_desc_font_size['small'] && ! isset( $settings->back_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_desc_line_height['small'] ) && is_numeric( $settings->back_desc_font_size['small'] ) ) {
					$settings->back_desc_line_height_unit_responsive = round( $settings->back_desc_line_height['small'] / $settings->back_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_desc_line_height['medium'] ) && isset( $settings->back_desc_font_size['medium'] ) && 0 != $settings->back_desc_font_size['medium'] && ! isset( $settings->back_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_desc_line_height['medium'] ) && is_numeric( $settings->back_desc_font_size['medium'] ) ) {
					$settings->back_desc_line_height_unit_medium = round( $settings->back_desc_line_height['medium'] / $settings->back_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_desc_line_height['desktop'] ) && isset( $settings->back_desc_font_size['desktop'] ) && 0 != $settings->back_desc_font_size['desktop'] && ! isset( $settings->back_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->back_desc_line_height['desktop'] ) && is_numeric( $settings->back_desc_font_size['desktop'] ) ) {
					$settings->back_desc_line_height_unit = round( $settings->back_desc_line_height['desktop'] / $settings->back_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_size_unit_responsive = $settings->link_font_size['small'];
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_size_unit_medium = $settings->link_font_size['medium'];
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_size_unit = $settings->link_font_size['desktop'];
			}

			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_line_height_unit_responsive = round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_line_height_unit_medium = round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_line_height_unit = round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->button->font_size->small ) && ! isset( $settings->button->font_size_unit_responsive ) ) {
				$settings->button->font_size_unit_responsive = $settings->button->font_size->small;
			}
			if ( isset( $settings->button->font_size->medium ) && ! isset( $settings->button->font_size_unit_medium ) ) {
				$settings->button->font_size_unit_medium = $settings->button->font_size->medium;
			}
			if ( isset( $settings->button->font_size->desktop ) && ! isset( $settings->button->font_size_unit ) ) {
				$settings->button->font_size_unit = $settings->button->font_size->desktop;
			}

			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 != $settings->button->font_size->small && ! isset( $settings->button->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->line_height_unit_responsive = round( $settings->button->line_height->small / $settings->button->font_size->small, 2 );
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 != $settings->button->font_size->medium && ! isset( $settings->button->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->line_height_unit_medium = round( $settings->button->line_height->medium / $settings->button->font_size->medium, 2 );
				}
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 != $settings->button->font_size->desktop && ! isset( $settings->button->line_height_unit ) ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->line_height_unit = round( $settings->button->line_height->desktop / $settings->button->font_size->desktop, 2 );
				}
			}
		}

		/**
		 * UABB ribbon.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function ribbon( &$settings ) {

			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_size_unit_responsive = $settings->text_font_size['small'];
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_size_unit_medium = $settings->text_font_size['medium'];
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_size_unit = $settings->text_font_size['desktop'];
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_line_height_unit_responsive = round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_line_height_unit_medium = round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_line_height_unit = round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 );
				}
			}

		}

		/**
		 * UABB progress Bar.
		 *
		 * @since 1.7.2
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function progress_bar( &$settings ) {

			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_size_unit_responsive = $settings->text_font_size['small'];
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_size_unit_medium = $settings->text_font_size['medium'];
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_size_unit = $settings->text_font_size['desktop'];
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 != $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_line_height_unit_responsive = round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 != $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_line_height_unit_medium = round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 != $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_line_height_unit = round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->before_after_font_size['small'] ) && ! isset( $settings->before_after_font_size_unit_responsive ) ) {
				$settings->before_after_font_size_unit_responsive = $settings->before_after_font_size['small'];
			}
			if ( isset( $settings->before_after_font_size['medium'] ) && ! isset( $settings->before_after_font_size_unit_medium ) ) {
				$settings->before_after_font_size_unit_medium = $settings->before_after_font_size['medium'];
			}
			if ( isset( $settings->before_after_font_size['desktop'] ) && ! isset( $settings->before_after_font_size_unit ) ) {
				$settings->before_after_font_size_unit = $settings->before_after_font_size['desktop'];
			}

			if ( isset( $settings->before_after_line_height['small'] ) && isset( $settings->before_after_font_size['small'] ) && 0 != $settings->before_after_font_size['small'] && ! isset( $settings->before_after_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->before_after_line_height['small'] ) && is_numeric( $settings->before_after_font_size['small'] ) ) {
					$settings->before_after_line_height_unit_responsive = round( $settings->before_after_line_height['small'] / $settings->before_after_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->before_after_line_height['medium'] ) && isset( $settings->before_after_font_size['medium'] ) && 0 != $settings->before_after_font_size['medium'] && ! isset( $settings->before_after_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->before_after_line_height['medium'] ) && is_numeric( $settings->before_after_font_size['medium'] ) ) {
					$settings->before_after_line_height_unit_medium = round( $settings->before_after_line_height['medium'] / $settings->before_after_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->before_after_line_height['desktop'] ) && isset( $settings->before_after_font_size['desktop'] ) && 0 != $settings->before_after_font_size['desktop'] && ! isset( $settings->before_after_line_height_unit ) ) {
				if ( is_numeric( $settings->before_after_line_height['desktop'] ) && is_numeric( $settings->before_after_font_size['desktop'] ) ) {
					$settings->before_after_line_height_unit = round( $settings->before_after_line_height['desktop'] / $settings->before_after_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->number_font_size['small'] ) && ! isset( $settings->number_font_size_unit_responsive ) ) {
				$settings->number_font_size_unit_responsive = $settings->number_font_size['small'];
			}
			if ( isset( $settings->number_font_size['medium'] ) && ! isset( $settings->number_font_size_unit_medium ) ) {
				$settings->number_font_size_unit_medium = $settings->number_font_size['medium'];
			}
			if ( isset( $settings->number_font_size['desktop'] ) && ! isset( $settings->number_font_size_unit ) ) {
				$settings->number_font_size_unit = $settings->number_font_size['desktop'];
			}

			if ( isset( $settings->number_line_height['small'] ) && isset( $settings->number_font_size['small'] ) && 0 != $settings->number_font_size['small'] && ! isset( $settings->number_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->number_line_height['small'] ) && is_numeric( $settings->number_font_size['small'] ) ) {
					$settings->number_line_height_unit_responsive = round( $settings->number_line_height['small'] / $settings->number_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->number_line_height['medium'] ) && isset( $settings->number_font_size['medium'] ) && 0 != $settings->number_font_size['medium'] && ! isset( $settings->number_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->number_line_height['medium'] ) && is_numeric( $settings->number_font_size['medium'] ) ) {
					$settings->number_line_height_unit_medium = round( $settings->number_line_height['medium'] / $settings->number_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->number_line_height['desktop'] ) && isset( $settings->number_font_size['desktop'] ) && 0 != $settings->number_font_size['desktop'] && ! isset( $settings->number_line_height_unit ) ) {
				if ( is_numeric( $settings->number_line_height['desktop'] ) && is_numeric( $settings->number_font_size['desktop'] ) ) {
					$settings->number_line_height_unit = round( $settings->number_line_height['desktop'] / $settings->number_font_size['desktop'], 2 );
				}
			}
		}

	}
}
UABB_Plugin_Backward::get_instance();
