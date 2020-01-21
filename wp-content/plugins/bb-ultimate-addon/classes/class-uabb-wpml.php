<?php
/**
 * UABB WPML Translatable File
 *
 * @since 1.6.7
 * @package UABB WPML Tranlatable
 */

if ( ! class_exists( 'UABB_WPML_Translatable' ) ) {

	/**
	 * This class initializes UABB WPML Translatable files.
	 *
	 * @class UABB_WPML_Translatable
	 */
	final class UABB_WPML_Translatable {

		/**
		 * Call nodes.
		 *
		 * @since 1.6.7
		 * @return void
		 */
		static public function init() {
			add_filter( 'wpml_beaver_builder_modules_to_translate', __CLASS__ . '::wpml_uabb_modules_translate' );
			UABB_WPML_Translatable::load_files();
		}

		/**
		 * Load files.
		 *
		 * @since 1.6.7
		 */
		static public function load_files() {

			if ( class_exists( 'WPML_Page_Builders_Defined' ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-progress-bar.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-info-circle.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-ihover.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-creative-link.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-accordion.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-tabs.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-hotspot.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-testimonials.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-googlemap.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-infolist.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-advanced-icon.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-list-icon.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-video-gallery.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-price-list.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-business-hours.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-pricing-box.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-slide-box.php';
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/wpml/class-wpml-uabb-how-to.php';
			}

		}
		/**
		 * Initialize nodes to translate
		 *
		 * @since 1.6.7
		 * @param array $form gets the forms array to be resolved.
		 * @return array
		 */
		static public function wpml_uabb_modules_translate( $form ) {

			// Heading Module.
			$form['uabb-heading'] = array(
				'conditions' => array( 'type' => 'uabb-heading' ),
				'fields'     => array(
					array(
						'field'       => 'heading',
						'type'        => __( 'Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'text_inline',
						'type'        => __( 'Heading : Separator Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Button Module.
			$form['uabb-button'] = array(
				'conditions' => array( 'type' => 'uabb-button' ),
				'fields'     => array(
					array(
						'field'       => 'text',
						'type'        => __( 'Button', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Call to Action Module.
			$form['uabb-call-to-action'] = array(
				'conditions' => array( 'type' => 'uabb-call-to-action' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Call to Action: Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'text',
						'type'        => __( 'Call to Action: Text', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Call to Action: Button text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_link',
						'type'        => __( 'Call to Action: Button link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Countdown Module.
			$form['uabb-countdown'] = array(
				'conditions' => array( 'type' => 'uabb-countdown' ),
				'fields'     => array(
					array(
						'field'       => 'expire_message',
						'type'        => __( 'Countdown: Timer expiry message', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Advanced Accordion Module.
			$form['advanced-accordion'] = array(
				'conditions'        => array( 'type' => 'advanced-accordion' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Accordion',
			);

			// Advanced Tabs.
			$form['advanced-tabs'] = array(
				'conditions'        => array( 'type' => 'advanced-tabs' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Tabs',
			);

			// Info Box.
			$form['info-box'] = array(
				'conditions' => array( 'type' => 'info-box' ),
				'fields'     => array(
					array(
						'field'       => 'heading_prefix',
						'type'        => __( 'Info Box: Title Prefix', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'title',
						'type'        => __( 'Info Box: Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'text',
						'type'        => __( 'Info Box: Desciption', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'cta_text',
						'type'        => __( 'Info Box: Call to action text ', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Info Box: Button text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_link',
						'type'        => __( 'Info Box: Button link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Info Box: Entire Module link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Ribbon.
			$form['ribbon'] = array(
				'conditions' => array( 'type' => 'ribbon' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Ribbon Message', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Modal.
			$form['modal-popup'] = array(
				'conditions' => array( 'type' => 'modal-popup' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Modal Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'modal_text',
						'type'        => __( 'Display Modal Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Modal Button Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'ct_content',
						'type'        => __( 'Modal Content', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Subscription Form.
			$form['mailchimp-subscribe-form'] = array(
				'conditions' => array( 'type' => 'mailchimp-subscribe-form' ),
				'fields'     => array(
					array(
						'field'       => 'heading',
						'type'        => __( 'Subscription Form Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'subheading',
						'type'        => __( 'Subscription Form Subheading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'fname_label',
						'type'        => __( 'First Name Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'lname_label',
						'type'        => __( 'Last Name Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'email_placeholder',
						'type'        => __( 'Email Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Email Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'bottom_text',
						'type'        => __( 'Subscription Form : Bottom text', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'success_message',
						'type'        => __( 'Subscription Form : Success Message', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'success_url',
						'type'        => __( 'Subscription Form : Success URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'terms_checkbox_text',
						'type'        => __( 'Subscription Form : Checkbox Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'terms_text',
						'type'        => __( 'Subscription Form : Terms Text', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Gravity Form Styler.
			$form['uabb-gravity-form'] = array(
				'conditions' => array( 'type' => 'uabb-gravity-form' ),
				'fields'     => array(
					array(
						'field'       => 'form_title',
						'type'        => __( 'Gravity Form Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'form_desc',
						'type'        => __( 'Gravity Form Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// CF7 Styler.
			$form['uabb-contact-form7'] = array(
				'conditions' => array( 'type' => 'uabb-contact-form7' ),
				'fields'     => array(
					array(
						'field'       => 'form_title',
						'type'        => __( 'Gravity Form Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'form_desc',
						'type'        => __( 'Gravity Form Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Contact Form.
			$form['uabb-contact-form'] = array(
				'conditions' => array( 'type' => 'uabb-contact-form' ),
				'fields'     => array(
					array(
						'field'       => 'name_label',
						'type'        => __( 'Contact Form : Name Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'name_placeholder',
						'type'        => __( 'Contact Form : Name Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'email_label',
						'type'        => __( 'Contact Form : Email Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'email_placeholder',
						'type'        => __( 'Contact Form : Email Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'subject_label',
						'type'        => __( 'Contact Form : Subject Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'subject_placeholder',
						'type'        => __( 'Contact Form : Subject Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'phone_label',
						'type'        => __( 'Contact Form : Phone Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'phone_placeholder',
						'type'        => __( 'Contact Form : Phone Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'msg_label',
						'type'        => __( 'Contact Form : Message Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'msg_placeholder',
						'type'        => __( 'Contact Form : Message Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'success_message',
						'type'        => __( 'Contact Form : Success Message', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'success_url',
						'type'        => __( 'Contact Form : Success URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Contact Form : Button Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'terms_checkbox_text',
						'type'        => __( 'Contact Form : Checkbox Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'terms_text',
						'type'        => __( 'Contact Form : Terms Text', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// hotspot module.
			$form['uabb-hotspot'] = array(
				'conditions'        => array( 'type' => 'uabb-hotspot' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Hotspot',
			);

			// Countdown.
			$form['uabb-countdown'] = array(
				'conditions' => array( 'type' => 'uabb-countdown' ),
				'fields'     => array(
					array(
						'field'       => 'expire_message',
						'type'        => __( 'Countdown : Expire Message', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'redirect_link',
						'type'        => __( 'Countdown : Redirect Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'year_plural_label',
						'type'        => __( 'Countdown : Years Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'year_singular_label',
						'type'        => __( 'Countdown : Year Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'month_plural_label',
						'type'        => __( 'Countdown : Months Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'month_singular_label',
						'type'        => __( 'Countdown : Month Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'day_plural_label',
						'type'        => __( 'Countdown : Days Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'day_singular_label',
						'type'        => __( 'Countdown : Day Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'hour_plural_label',
						'type'        => __( 'Countdown : Hours Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'hour_singular_label',
						'type'        => __( 'Countdown : Hour Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'minute_plural_label',
						'type'        => __( 'Countdown : Minutes Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'minute_singular_label',
						'type'        => __( 'Countdown : Minute Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'second_plural_label',
						'type'        => __( 'Countdown : Seconds Label ( Plural )', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'second_singular_label',
						'type'        => __( 'Countdown : Second Label ( Singular )', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Before After Slider.
			$form['uabb-beforeafterslider'] = array(
				'conditions' => array( 'type' => 'uabb-beforeafterslider' ),
				'fields'     => array(
					array(
						'field'       => 'before_label_text',
						'type'        => __( 'Before After Slider : Before text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'after_label_text',
						'type'        => __( 'Before After Slider : After text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Advanced Testimonials.
			$form['adv-testimonials'] = array(
				'conditions'        => array( 'type' => 'adv-testimonials' ),
				'fields'            => array(
					array(
						'field'       => 'testimonial_author_no_slider',
						'type'        => __( 'Testimonials : Author Name', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'testimonial_designation_no_slider',
						'type'        => __( 'Testimonials : Designation', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'testimonial_description',
						'type'        => __( 'Testimonials : Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
				'integration-class' => 'WPML_UABB_Testimonials',
			);

			// Team.
			$form['team'] = array(
				'conditions' => array( 'type' => 'team' ),
				'fields'     => array(
					array(
						'field'       => 'name',
						'type'        => __( 'Team : Name', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'designation',
						'type'        => __( 'Team : Designation', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'description',
						'type'        => __( 'Team : Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'custom_link',
						'type'        => __( 'Team : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Counter Module.
			$form['uabb-numbers'] = array(
				'conditions' => array( 'type' => 'uabb-numbers' ),
				'fields'     => array(
					array(
						'field'       => 'before_number_text',
						'type'        => __( 'Counter : Text Above Number', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'before_counter_text',
						'type'        => __( 'Counter : Text Before Counter', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'after_number_text',
						'type'        => __( 'Counter : Text Below Number', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'after_counter_text',
						'type'        => __( 'Counter : Text After Counter', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'number_prefix',
						'type'        => __( 'Counter :  Number Prefix', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'number_suffix',
						'type'        => __( 'Counter :  Number Suffix', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Dual Button Module.
			$form['dual-button'] = array(
				'conditions' => array( 'type' => 'dual-button' ),
				'fields'     => array(
					array(
						'field'       => 'button_one_title',
						'type'        => __( 'Dual Button : Button One Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_one_link',
						'type'        => __( 'Dual Button : Button One Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'button_two_title',
						'type'        => __( 'Dual Button : Button Two Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_two_link',
						'type'        => __( 'Dual Button : Button Two Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'divider_text',
						'type'        => __( 'Dual Button : Divider Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Dual Color Heading Module.
			$form['dual-color-heading'] = array(
				'conditions' => array( 'type' => 'dual-color-heading' ),
				'fields'     => array(
					array(
						'field'       => 'first_heading_text',
						'type'        => __( 'Dual Color Heading : First Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'first_heading_link',
						'type'        => __( 'Dual Color Heading : First Heading Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'second_heading_text',
						'type'        => __( 'Dual Color Heading : Second Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'second_heading_link',
						'type'        => __( 'Dual Color Heading : Second Heading Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Fancy Text Module.
			$form['fancy-text'] = array(
				'conditions' => array( 'type' => 'fancy-text' ),
				'fields'     => array(
					array(
						'field'       => 'prefix',
						'type'        => __( 'Fancy Text : Prefix', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'fancy_text',
						'type'        => __( 'Fancy Text : Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'suffix',
						'type'        => __( 'Fancy Text : Suffix', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'cursor_text',
						'type'        => __( 'Fancy Text : Cursor Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Flip Box Module.
			$form['flip-box'] = array(
				'conditions' => array( 'type' => 'flip-box' ),
				'fields'     => array(
					array(
						'field'       => 'title_front',
						'type'        => __( 'Flip Box : Title on Front', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_front',
						'type'        => __( 'Flip Box : Description on Front', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'title_back',
						'type'        => __( 'Flip Box : Title on Back', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_back',
						'type'        => __( 'Flip Box : Description on Back', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Image Separator Module.
			$form['image-separator'] = array(
				'conditions' => array( 'type' => 'image-separator' ),
				'fields'     => array(
					array(
						'field'       => 'link',
						'type'        => __( 'Image Separator : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Interactive Banner 2 Module.
			$form['interactive-banner-2'] = array(
				'conditions' => array( 'type' => 'interactive-banner-2' ),
				'fields'     => array(
					array(
						'field'       => 'link_url',
						'type'        => __( 'Interactive Banner 2 : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'banner_title',
						'type'        => __( 'Interactive Banner 2 : Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'banner_desc',
						'type'        => __( 'Interactive Banner 2 : Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
				),
			);

			// Slide Box Module.
			$form['slide-box'] = array(
				'conditions'        => array( 'type' => 'slide-box' ),
				'fields'            => array(
					array(
						'field'       => 'title_front',
						'type'        => __( 'Slide Box : Title on Front', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_front',
						'type'        => __( 'Slide Box : Description on Front', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'title_back',
						'type'        => __( 'Slide Box : Title on Back', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'desc_back',
						'type'        => __( 'Slide Box : Description on Back', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Slide Box : CTA Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'cta_text',
						'type'        => __( 'Slide Box : CTA Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
				'integration-class' => 'WPML_UABB_Slide_Box',
			);

			// Advanced Separator Module.
			$form['advanced-separator'] = array(
				'conditions' => array( 'type' => 'advanced-separator' ),
				'fields'     => array(
					array(
						'field'       => 'text_inline',
						'type'        => __( 'Advanced Separator : Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Creative Link Module.
			$form['creative-link'] = array(
				'conditions'        => array( 'type' => 'creative-link' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Creative_Link',
			);

			// iHover Module.
			$form['ihover'] = array(
				'conditions'        => array( 'type' => 'ihover' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Ihover',
			);

			// Info Circle Module.
			$form['info-circle'] = array(
				'conditions'        => array( 'type' => 'info-circle' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Info_Circle',
			);

			// Progress Bar Module.
			$form['progress-bar'] = array(
				'conditions'        => array( 'type' => 'progress-bar' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Progres_Bar',
			);

			// Google Map Module.
			$form['google-map'] = array(
				'conditions'        => array( 'type' => 'google-map' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Googlemap',
			);

			// Info Banner.
			$form['info-banner'] = array(
				'conditions' => array( 'type' => 'info-banner' ),
				'fields'     => array(
					array(
						'field'       => 'banner_title',
						'type'        => __( 'Info Banner: Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'banner_desc',
						'type'        => __( 'Info Banner: Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'cta_text',
						'type'        => __( 'Info Banner: Call to action text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Info Banner: Button text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_link',
						'type'        => __( 'Info Banner : Call to action button link', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Info Banner: Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Info list Module.
			$form['info-list'] = array(
				'conditions'        => array( 'type' => 'info-list' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Infolist',
			);

			// Photo.
			$form['uabb-photo'] = array(
				'conditions' => array( 'type' => 'uabb-photo' ),
				'fields'     => array(
					array(
						'field'       => 'link_url',
						'type'        => __( 'Photo : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Advanced icon.
			$form['advanced-icon'] = array(
				'conditions'        => array( 'type' => 'advanced-icon' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_AdvanceIcons',
			);

			// Advanced posts.
			$form['blog-posts'] = array(
				'conditions' => array( 'type' => 'blog-posts' ),
				'fields'     => array(
					array(
						'field'       => 'cta_text',
						'type'        => __( 'Advanced Posts : Call to action text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Advanced Posts : Button Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'no_results_message',
						'type'        => __( 'Advanced Posts : No Results Message', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Info Table.
			$form['info-table'] = array(
				'conditions' => array( 'type' => 'info-table' ),
				'fields'     => array(
					array(
						'field'       => 'it_title',
						'type'        => __( 'Info Table : Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'sub_heading',
						'type'        => __( 'Info Table : Sub Heading', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'it_long_desc',
						'type'        => __( 'Info Table : Description', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'button_text',
						'type'        => __( 'Info Table : Call to action button text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'it_link',
						'type'        => __( 'Info Table : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Interactive banner 1.
			$form['interactive-banner-1'] = array(
				'conditions' => array( 'type' => 'interactive-banner-1' ),
				'fields'     => array(
					array(
						'field'       => 'banner_title',
						'type'        => __( 'Interactive Banner : Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'banner_desc',
						'type'        => __( 'Interactive Banner : Description', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'cta_link',
						'type'        => __( 'Interactive Banner : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// List icon.
			$form['list-icon'] = array(
				'conditions'        => array( 'type' => 'list-icon' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Listicon',
			);

			// Content Toggle.
			$form['uabb-content-toggle'] = array(
				'conditions' => array( 'type' => 'uabb-content-toggle' ),
				'fields'     => array(
					array(
						'field'       => 'cont1_heading',
						'type'        => __( 'Content Toggle : Heading 1', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'content_editor',
						'type'        => __( 'Content Toggle : Content 1', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'cont2_heading',
						'type'        => __( 'Content Toggle : Heading 2', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'content2_editor',
						'type'        => __( 'Content Toggle : Content 2', 'uabb' ),
						'editor_type' => 'VISUAL',
					),

				),
			);

			// Business Hours.
			$form['uabb-business-hours'] = array(
				'conditions'        => array( 'type' => 'uabb-business-hours' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Business_Hours',
			);

			// Woo - Add to Cart.
			$form['uabb-woo-add-to-cart'] = array(
				'conditions' => array( 'type' => 'uabb-woo-add-to-cart' ),
				'fields'     => array(
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Button: Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Woo - Products.
			$form['uabb-woo-products'] = array(
				'conditions' => array( 'type' => 'uabb-woo-products' ),
				'fields'     => array(
					array(
						'field'       => 'sale_flash_content',
						'type'        => __( 'Sale Flash: Flash Content', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'featured_flash_content',
						'type'        => __( 'Featured Flash: Flash Content', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Video.
			$form['uabb-video'] = array(
				'conditions' => array(
					'type' => 'uabb-video',
				),
				array(
					'field'       => 'youtube_link',
					'type'        => __( 'Video : YouTube Link', 'uabb' ),
					'editor_type' => 'LINK',
				),
				array(
					'field'       => 'vimeo_link',
					'type'        => __( 'Video : Vimeo Link', 'uabb' ),
					'editor_type' => 'LINK',
				),
				array(
					'field'       => 'yt_subscribe_text',
					'type'        => __( 'Video : Subscribe to channel text', 'uabb' ),
					'editor_type' => 'LINE',
				),
				array(
					'field'       => 'sticky_info_bar_text',
					'type'        => __( 'Video : This is info bar', 'uabb' ),
					'editor_type' => 'LINE',
				),
			);

			// Video Gallery module.
			$form['uabb-video-gallery'] = array(
				'conditions'        => array( 'type' => 'uabb-video-gallery' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_VideoGallery',
			);

			// Price List module.
			$form['uabb-price-list'] = array(
				'conditions'        => array( 'type' => 'uabb-price-list' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Pricelist',
			);

			// Marketing Button Module.
			$form['uabb-marketing-button'] = array(
				'conditions' => array( 'type' => 'uabb-marketing-button' ),
				'fields'     => array(
					array(
						'field'       => 'title',
						'type'        => __( 'Marketing Button : Title', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'sub_title',
						'type'        => __( 'Marketing Button : Description', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'link',
						'type'        => __( 'Marketing Button : Link', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// Photo Gallery Module.
			$form['photo-gallery'] = array(
				'conditions' => array( 'type' => 'photo-gallery' ),
				'fields'     => array(
					array(
						'field'       => 'filters_all_text',
						'type'        => __( 'Photo Gallery : "All" Tab Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'default_filter',
						'type'        => __( 'Photo Gallery : Enter Default Category Name', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'filters_heading_text',
						'type'        => __( 'Photo Gallery : Title Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Business Reviews Module.
			$form['uabb-business-reviews'] = array(
				'conditions' => array( 'type' => 'uabb-business-reviews' ),
				'fields'     => array(
					array(
						'field'       => 'read_more',
						'type'        => __( 'Business Reviews : Read More Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Off Canvas Module.
			$form['uabb-off-canvas'] = array(
				'conditions' => array( 'type' => 'uabb-off-canvas' ),
				'fields'     => array(
					array(
						'field'       => 'ct_content',
						'type'        => __( 'Off Canvas : Content', 'uabb' ),
						'editor_type' => 'VISUAL',
					),
					array(
						'field'       => 'btn_text',
						'type'        => __( 'Off Canvas : Button Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Retina Image Module.
			$form['uabb-retina-image'] = array(
				'conditions' => array( 'type' => 'uabb-retina-image' ),
				'fields'     => array(
					array(
						'field'       => 'custom_caption',
						'type'        => __( 'Retina Image : Custom Caption', 'uabb' ),
						'editor_type' => 'LINE',
					),
				),
			);

			// Pricing Box.
			$form['pricing-box'] = array(
				'conditions'        => array( 'type' => 'pricing-box' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_Pricing_Box',
			);

			// Login Form Module.
			$form['uabb-login-form'] = array(
				'conditions' => array( 'type' => 'uabb-login-form' ),
				'fields'     => array(
					array(
						'field'       => 'username_label',
						'type'        => __( 'UABB Login : Username Field Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'username_placeholder',
						'type'        => __( 'UABB Login : Username Field Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'password_label',
						'type'        => __( 'UABB Login : Password Field Label', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'password_placeholder',
						'type'        => __( 'UABB Login : Password Field Placeholder', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'lost_your_password_text',
						'type'        => __( 'UABB Login : Lost your Password Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'lost_your_password_url',
						'type'        => __( 'UABB Login : Lost Your Password URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'custom_link_text',
						'type'        => __( 'UABB Login : Custom Link Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'custom_link_url',
						'type'        => __( 'UABB Login : Custom Link URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'rememberme_text',
						'type'        => __( 'UABB Login : Remember me Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'wp_login_btn_text',
						'type'        => __( 'UABB Login : WP Login Button Text', 'uabb' ),
						'editor_type' => 'LINE',
					),
					array(
						'field'       => 'login_redirect_url',
						'type'        => __( 'UABB Login : Custom Redirect URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
					array(
						'field'       => 'logout_redirect_url',
						'type'        => __( 'UABB Login : Custom Redirect URL', 'uabb' ),
						'editor_type' => 'LINK',
					),
				),
			);

			// UABB How To.
			$form['uabb-how-to'] = array(
				'conditions'        => array( 'type' => 'uabb-how-to' ),
				'fields'            => array(),
				'integration-class' => 'WPML_UABB_How_To',
			);

			return $form;
		}
	}
	UABB_WPML_Translatable::init();
}
