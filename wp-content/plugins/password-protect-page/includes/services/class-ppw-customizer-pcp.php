<?php

if ( ! class_exists( 'PPW_Customizer_PCP' ) ) {
	class PPW_Customizer_PCP {

		/**
		 * Instance of PPW_Pro_Shortcode class.
		 *
		 * @var PPW_Customizer_PCP
		 */
		protected static $instance = null;

		const PANEL = 'ppwp_pcp';
		const GENERAL_SECTION = 'ppwp_pcp_form';
		const FORM_SECTION = 'ppwp_pcp_form';
		const ERR_MSG_SECTION = 'ppwp_pcp_err_msg';
		const BUTTON_SECTION = 'ppwp_pcp_button';

		/**
		 * Get instance of PPW_Customizer
		 *
		 * @return PPW_Customizer_PCP
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				// Use static instead of self due to the inheritance later.
				// For example: ChildSC extends this class, when we call get_instance
				// it will return the object of child class. On the other hand, self function
				// will return the object of base class.
				self::$instance = new static();
			}

			return self::$instance;
		}

		public function register() {
			add_action( 'customize_register', array( $this, 'customize_register' ), 15 );
			add_action( 'wp_head', array( $this, 'dynamic_styles' ) );
			add_filter( 'ppw_pcp_attributes', array( $this, 'load_customizer_attributes' ) );
			add_filter( 'ppw_validated_pcp_password', array( $this, 'load_customizer_err_msg' ), 10, 3 );
		}

		/**
		 * Load customizer attributes.
		 *
		 * @param array $attrs Attributes
		 *
		 * @return array
		 */
		public function load_customizer_attributes( $attrs ) {
			$attrs['headline']           = get_theme_mod( 'ppwp_pcp_form_headline', PPW_Constants::DEFAULT_SHORTCODE_HEADLINE );
			$attrs['description']        = get_theme_mod( 'ppwp_pcp_form_description', PPW_Constants::DEFAULT_SHORTCODE_DESCRIPTION );
			$attrs['label']              = get_theme_mod( 'ppwp_pcp_form_label', PPW_Constants::DEFAULT_SHORTCODE_LABEL );
			$attrs['placeholder']        = get_theme_mod( 'ppwp_pcp_form_placeholder', '' );
			$attrs['error_msg']          = get_theme_mod( 'ppwp_pcp_err_msg_text', PPW_Constants::DEFAULT_SHORTCODE_ERROR_MSG );
			$attrs['button']             = get_theme_mod( 'ppwp_pcp_button_text', PPW_Constants::DEFAULT_SHORTCODE_BUTTON );
			$attrs['loading']            = get_theme_mod( 'ppwp_pcp_button_loading_text', PPW_Constants::DEFAULT_SHORTCODE_LOADING );
			$attrs['show_password']      = get_theme_mod( 'ppwp_pcp_form_is_show_password', PPW_Constants::DEFAULT_SHORTCODE_SHOW_PASSWORD );
			$attrs['show_password_text'] = get_theme_mod( 'ppwp_pcp_form_show_password_text', PPW_Constants::DEFAULT_SHORTCODE_SHOW_PASSWORD_TEXT );

			return $attrs;
		}

		/**
		 * Load customizer error message.
		 *
		 * @param array  $attrs        Attributes.
		 * @param string $password     Password.
		 * @param array  $parsed_attrs Parsed attributes.
		 *
		 * @return array
		 */
		public function load_customizer_err_msg( $attrs, $password, $parsed_attrs ) {
			if ( isset( $parsed_attrs['error_msg'] ) ) {
				return $attrs;
			}
			if ( isset( $attrs['is_valid_password'] ) && ! $attrs['is_valid_password'] ) {
				$attrs['message'] = get_theme_mod( 'ppwp_pcp_err_msg_text', PPW_Constants::DEFAULT_SHORTCODE_ERROR_MSG );
			}

			return $attrs;
		}

		/**
		 * Register customizer.
		 *
		 * @param WP_Customize $wp_customize WP Customize class.
		 */
		public function customize_register( $wp_customize ) {
			if ( ! class_exists( 'PPW_Title_Group_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-title-group-control.php';
			}
			if ( ! class_exists( 'PPW_Toggle_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-toggle-control.php';
			}
			if ( ! class_exists( 'PPW_Text_Editor_Custom_Control' ) ) {
				include PPW_DIR_PATH . 'includes/customizers/class-ppw-text-editor-control.php';
			}

			$wp_customize->add_panel(
				self::PANEL,
				array(
					'priority'       => 1010,
					'capability'     => 'edit_theme_options',
					'theme_supports' => '',
					'title'          => __( 'PPWP Partial Protection Form', 'password-protect-page' ),
				)
			);

			$this->append_form_section( $wp_customize );
			$this->append_err_msg_section( $wp_customize );
			$this->append_button_section( $wp_customize );
		}

		/**
		 * Append form section.
		 *
		 * @param WP_Customize $wp_customize WP Customize class.
		 */
		public function append_form_section( $wp_customize ) {
			$wp_customize->add_section(
				self::FORM_SECTION,
				array(
					'title'    => __( 'Password Form', 'password-protect-page' ),
					'panel'    => self::PANEL,
					'priority' => 10,
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_background_title' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pcp_form_background_title', array(
					'label'    => __( 'Background', 'password-protect-page' ),
					'section'  => self::FORM_SECTION,
					'settings' => 'ppwp_pcp_form_background_title',
					'type'     => 'control_title',
					'priority' => 0,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_background_color' );
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_form_background_color_control',
					array(
						'label'    => __( 'Form Background Color', 'password-protect-page' ),
						'section'  => self::FORM_SECTION,
						'settings' => 'ppwp_pcp_form_background_color',
						'priority' => 10,
					)
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_padding' );
			$wp_customize->add_control(
				'ppwp_pcp_form_padding_control',
				array(
					'label'       => __( 'Padding', 'password-protect-page' ),
					'description' => __( 'Padding in px', 'password-protect-page' ),
					'section'     => self::FORM_SECTION,
					'settings'    => 'ppwp_pcp_form_padding',
					'type'        => 'number',
					'priority'    => 20,
				)
			);

			/* form background border radius */
			$wp_customize->add_setting( 'ppwp_pcp_form_border_radius', array(
				'default' => PPW_Constants::DEFAULT_FORM_BORDER_RADIUS,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_border_radius_control', array(
				'label'       => __( 'Border Radius', 'password-protect-page' ),
				'section'     => self::GENERAL_SECTION,
				'description' => 'Border Radius in px',
				'settings'    => 'ppwp_pcp_form_border_radius',
				'type'        => 'number',
				'priority'    => 40,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_headline_title' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pcp_form_headline_title', array(
					'label'    => __( 'Headline', 'password-protect-page' ),
					'section'  => self::GENERAL_SECTION,
					'settings' => 'ppwp_pcp_form_headline_title',
					'type'     => 'control_title',
					'priority' => 50,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_headline', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_HEADLINE,
			) );
			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_pcp_form_headline',
					array(
						'label'    => __( 'Headline', 'password-protect-page' ),
						'section'  => self::GENERAL_SECTION,
						'settings' => 'ppwp_pcp_form_headline',
						'type'     => 'textarea',
						'priority' => 60,
					)
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_headline_font_size', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_headline_font_size_control', array(
				'label'       => __( 'Headline Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => self::GENERAL_SECTION,
				'settings'    => 'ppwp_pcp_form_headline_font_size',
				'type'        => 'number',
				'priority'    => 70,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_headline_font_weight', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_headline_font_weight_control', array(
				'label'    => __( 'Headline Font Weight', 'password-protect-page' ),
				'section'  => self::GENERAL_SECTION,
				'settings' => 'ppwp_pcp_form_headline_font_weight',
				'type'     => 'number',
				'priority' => 80,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_headline_color', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_form_headline_color_control', array(
					'label'    => __( 'Headline Color', 'password-protect-page' ),
					'section'  => self::GENERAL_SECTION,
					'settings' => 'ppwp_pcp_form_headline_color',
					'priority' => 90,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_description_title' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pcp_form_description_title', array(
					'label'    => __( 'Description Above Form', 'password-protect-page' ),
					'section'  => self::GENERAL_SECTION,
					'settings' => 'ppwp_pcp_form_description_title',
					'type'     => 'control_title',
					'priority' => 100,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_description', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_DESCRIPTION,
			) );
			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_pcp_form_description',
					array(
						'label'    => __( 'Description', 'password-protect-page' ),
						'section'  => self::GENERAL_SECTION,
						'settings' => 'ppwp_pcp_form_description',
						'type'     => 'textarea',
						'priority' => 110,
					)
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_description_font_size', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_description_font_size_control', array(
				'label'       => __( 'Description Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => self::GENERAL_SECTION,
				'settings'    => 'ppwp_pcp_form_description_font_size',
				'type'        => 'number',
				'priority'    => 120,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_description_font_weight', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_description_font_weight_control', array(
				'label'    => __( 'Description Font Weight', 'password-protect-page' ),
				'section'  => self::GENERAL_SECTION,
				'settings' => 'ppwp_pcp_form_description_font_weight',
				'type'     => 'number',
				'priority' => 130,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_description_color', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_form_description_color_control', array(
					'label'    => __( 'Description Text Color', 'password-protect-page' ),
					'section'  => self::GENERAL_SECTION,
					'settings' => 'ppwp_pcp_form_description_color',
					'priority' => 140,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_label_title' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pcp_form_label_title',
					array(
						'label'    => __( 'Password Field', 'password-protect-page' ),
						'section'  => 'ppwp_pcp_form',
						'settings' => 'ppwp_pcp_form_label_title',
						'type'     => 'control_title',
						'priority' => 150,
					)
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_label', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_LABEL,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_label_control', array(
				'label'    => __( 'Password Label', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_form',
				'settings' => 'ppwp_pcp_form_label',
				'type'     => 'text',
				'priority' => 160,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_label_font_size', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_label_font_size_control', array(
				'label'       => __( 'Label Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => 'ppwp_pcp_form',
				'settings'    => 'ppwp_pcp_form_label_font_size',
				'type'        => 'number',
				'priority'    => 170,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_label_font_weight', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_label_font_weight_control', array(
				'label'    => __( 'Label Font Weight', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_form',
				'settings' => 'ppwp_pcp_form_label_font_weight',
				'type'     => 'number',
				'priority' => 180,

			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_label_color', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_form_label_color_control', array(
					'label'    => __( 'Label Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_form',
					'settings' => 'ppwp_pcp_form_label_color',
					'priority' => 190,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_placeholder', array(
				'default' => PPW_Constants::DEFAULT_PLACEHOLDER,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_placeholder_control', array(
				'label'    => __( 'Placeholder', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_form',
				'settings' => 'ppwp_pcp_form_placeholder',
				'type'     => 'text',
				'priority' => 200,

			) );

			$wp_customize->add_setting( 'ppwp_pcp_form_show_password_title' );
			$wp_customize->add_control(
				new PPW_Title_Group_Control(
					$wp_customize,
					'ppwp_pcp_form_show_password_title', array(
					'label'    => __( 'Show Password', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_form',
					'settings' => 'ppwp_pcp_form_show_password_title',
					'type'     => 'control_title',
					'priority' => 210,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_is_show_password', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_SHOW_PASSWORD,
			) );
			$wp_customize->add_control(
				new PPW_Toggle_Control(
					$wp_customize,
					'ppwp_pcp_form_is_show_password_control', array(
					'label'    => __( 'Show Password Reveal Button', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_form',
					'type'     => 'toggle',
					'settings' => 'ppwp_pcp_form_is_show_password',
					'priority' => 220,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_form_show_password_text', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_SHOW_PASSWORD_TEXT,
			) );
			$wp_customize->add_control( 'ppwp_pcp_form_show_password_text_control', array(
				'label'    => __( 'Button Text', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_form',
				'settings' => 'ppwp_pcp_form_show_password_text',
				'type'     => 'text',
				'priority' => 230,
			) );
		}

		/**
		 * Append error message section.
		 *
		 * @param WP_Customize $wp_customize WP Customize class.
		 */
		public function append_err_msg_section( $wp_customize ) {
			/* form error message section */
			$wp_customize->add_section( self::ERR_MSG_SECTION, array(
				'title'    => __( 'Error Message', 'password-protect-page' ),
				'panel'    => self::PANEL,
				'priority' => 20,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_err_msg_text', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_ERROR_MSG,
			) );
			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_pcp_err_msg_text',
					array(
						'label'    => __( 'Error Message', 'password-protect-page' ),
						'section'  => self::ERR_MSG_SECTION,
						'settings' => 'ppwp_pcp_err_msg_text',
						'type'     => 'textarea',
						'priority' => 10,
					)
				)
			);

			$wp_customize->add_setting( 'ppwp_pcp_err_msg_text_font_size', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_pcp_err_msg_text_font_size_control', array(
				'label'       => __( 'Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => self::ERR_MSG_SECTION,
				'settings'    => 'ppwp_pcp_err_msg_text_font_size',
				'type'        => 'number',
				'priority'    => 20,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_err_msg_text_font_weight', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_pcp_err_msg_text_font_weight_control', array(
				'label'    => __( 'Font Weight', 'password-protect-page' ),
				'section'  => self::ERR_MSG_SECTION,
				'settings' => 'ppwp_pcp_err_msg_text_font_weight',
				'type'     => 'number',
				'priority' => 25,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_err_msg_text_color', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_err_msg_text_color_control', array(
					'label'    => __( 'Text Color', 'password-protect-page' ),
					'section'  => self::ERR_MSG_SECTION,
					'settings' => 'ppwp_pcp_err_msg_text_color',
					'priority' => 30,
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_err_msg_background_color', array(
				'default' => '#ffffff',
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_err_msg_background_color_control', array(
					'label'    => __( 'Background Color', 'password-protect-page' ),
					'section'  => self::ERR_MSG_SECTION,
					'settings' => 'ppwp_pcp_err_msg_background_color',
					'priority' => 35,
				) )
			);
		}

		/**
		 * Append button section.
		 *
		 * @param WP_Customize $wp_customize WP Customize class.
		 */
		public function append_button_section( $wp_customize ) {
			$wp_customize->add_section( self::BUTTON_SECTION, array(
				'title'    => __( 'Button', 'password-protect-page' ),
				'panel'    => self::PANEL,
				'priority' => 300,
			) );

			$wp_customize->add_setting( 'ppwp_pcp_button_text', array(
				'default' => PPW_Constants::DEFAULT_SHORTCODE_BUTTON,
			) );
			$wp_customize->add_control( 'ppwp_pcp_button_text_control', array(
				'label'    => __( 'Button Label', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_button',
				'settings' => 'ppwp_pcp_button_text',
				'type'     => 'text',
			) );

			$wp_customize->add_setting( 'ppwp_pcp_button_loading_text', array(
				'default' => __( PPW_Constants::DEFAULT_SHORTCODE_LOADING, 'password-protect-page' ),
			) );
			$wp_customize->add_control( 'ppwp_pcp_button_loading_text_control', array(
				'label'    => __( 'Button Loading Label', 'password-protect-page' ),
				'section'  => 'ppwp_pcp_button',
				'settings' => 'ppwp_pcp_button_loading_text',
				'type'     => 'text',
			) );


			$wp_customize->add_setting( 'ppwp_pcp_button_text_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_TEXT_FONT_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_button_text_color_control', array(
					'label'    => __( 'Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_button',
					'settings' => 'ppwp_pcp_button_text_color',
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_button_text_hover_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_TEXT_HOVER_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_button_text_hover_color_control', array(
					'label'    => __( 'Text Color (Hover)', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_button',
					'settings' => 'ppwp_pcp_button_text_hover_color',
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_button_background_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_BACKGROUND_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_button_background_color_control', array(
					'label'    => __( 'Background Color', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_button',
					'settings' => 'ppwp_pcp_button_background_color',
				) )
			);

			$wp_customize->add_setting( 'ppwp_pcp_button_background_hover_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_BACKGROUND_HOVER_COLOR,
			) );
			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_pcp_button_background_hover_color_control', array(
					'label'    => __( 'Background Color (Hover)', 'password-protect-page' ),
					'section'  => 'ppwp_pcp_button',
					'settings' => 'ppwp_pcp_button_background_hover_color',
				) )
			);
		}


		/**
		 * Add dynamic styles
		 *
		 * @return void
		 */
		public function dynamic_styles() {
			$ppw_custom_css = "
			<style>
			.ppw-form {
				background-color: " . get_theme_mod( 'ppwp_pcp_form_background_color', PPW_Constants::DEFAULT_FORM_BACKGROUND_COLOR ) . "!important;
				padding: " . get_theme_mod( 'ppwp_pcp_form_padding', PPW_Constants::DEFAULT_FORM_PADDING ) . "px!important;
				border-radius: " . get_theme_mod( 'ppwp_pcp_form_border_radius', PPW_Constants::DEFAULT_FORM_BORDER_RADIUS ) . "px!important;
			}

			.ppw-headline.ppw-pcp-pf-headline {
				font-size: " . get_theme_mod( 'ppwp_pcp_form_headline_font_size', PPW_Constants::DEFAULT_HEADLINE_FONT_SIZE ) . "px!important;
				font-weight: " . get_theme_mod( 'ppwp_pcp_form_headline_font_weight', PPW_Constants::DEFAULT_HEADLINE_FONT_WEIGHT ) . "!important;
				color: " . get_theme_mod( 'ppwp_pcp_form_headline_color', PPW_Constants::DEFAULT_HEADLINE_FONT_COLOR ) . "!important;
			}

			.ppw-description.ppw-pcp-pf-desc {
				font-size: " . get_theme_mod( 'ppwp_pcp_form_description_font_size', PPW_Constants::DEFAULT_TEXT_FONT_SIZE ) . "px!important;
				font-weight: " . get_theme_mod( 'ppwp_pcp_form_description_font_weight', PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT ) . "!important;
				color: " . get_theme_mod( 'ppwp_pcp_form_description_color', PPW_Constants::DEFAULT_TEXT_FONT_COLOR ) . "!important;
			}

			.ppw-input label.ppw-pcp-password-label {
				font-size: " . get_theme_mod( 'ppwp_pcp_form_label_font_size', PPW_Constants::DEFAULT_TEXT_FONT_SIZE ) . "px!important;
				font-weight: " . get_theme_mod( 'ppwp_pcp_form_label_font_weight', PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT ) . "!important;
				color: " . get_theme_mod( 'ppwp_pcp_form_label_color', PPW_Constants::DEFAULT_TEXT_FONT_COLOR ) . "!important;
			}

			.ppw-form input[type='submit'] {
				color: " . get_theme_mod( 'ppwp_pcp_button_text_color', PPW_Constants::DEFAULT_BUTTON_TEXT_FONT_COLOR ) . "!important;
				background: " . get_theme_mod( 'ppwp_pcp_button_background_color', PPW_Constants::DEFAULT_BUTTON_BACKGROUND_COLOR ) . "!important;
			}

			.ppw-form input[type='submit']:hover {
				color: " . get_theme_mod( 'ppwp_pcp_button_text_hover_color', PPW_Constants::DEFAULT_BUTTON_TEXT_HOVER_COLOR ) . "!important;
				background: " . get_theme_mod( 'ppwp_pcp_button_background_hover_color', PPW_Constants::DEFAULT_BUTTON_BACKGROUND_HOVER_COLOR ) . "!important;
			}
			
			div.ppw-error.ppw-pcp-pf-error-msg {
				font-size: " . get_theme_mod( 'ppwp_pcp_err_msg_text_font_size', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_SIZE ) . "px!important;
				font-weight: " . get_theme_mod( 'ppwp_pcp_err_msg_text_font_weight', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_WEIGHT ) . "!important;
				color: " . get_theme_mod( 'ppwp_pcp_err_msg_text_color', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_COLOR ) . "!important;
				background: " . get_theme_mod( 'ppwp_pcp_err_msg_background_color', PPW_Constants::DEFAULT_ERROR_TEXT_BACKGROUND_COLOR ) . "!important;
			}
			
			</style>
			";

			// compress $ppw_custom_css.
			$ppw_custom_css = preg_replace( "/\s{2,}/", " ", str_replace( "\n", "", str_replace( ', ', ",", $ppw_custom_css ) ) );

			echo $ppw_custom_css;
		}

		/*
		 * Optimize css.
		 */
		public function optimize_css( $sw_custom_css ) {
			return preg_replace( "/\s{2,}/", " ", str_replace( "\n", "", str_replace( ', ', ",", $sw_custom_css ) ) );
		}
	}
}
