<?php

if ( ! class_exists( 'PPW_Customizer_Service' ) ) {
	class PPW_Customizer_Service {

		/**
		 * Instance of PPW_Pro_Shortcode class.
		 *
		 * @var PPW_Customizer_Service
		 */
		protected static $instance = null;

		/**
		 * Constructor for PPW_Customizer
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'wp_head', array( $this, 'dynamic_styles' ) );
		}

		/**
		 * Get instance of PPW_Customizer
		 *
		 * @return PPW_Customizer_Service
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

		/**
		 * Register customizer fields
		 *
		 * @param object $wp_customize customizer object.
		 *
		 * @return void
		 */
		public function customize_register( $wp_customize ) {

			$wp_customize->add_panel( 'ppwp',
				array(
					'priority'       => 999,
					'capability'     => 'edit_theme_options',
					'theme_supports' => '',
					'title'          => __( 'Password Protect WordPress', 'password-protect-page' ),
				)
			);


//			TODO: --- Comment this function to develop later.---
//          /* general section */
//			$wp_customize->add_section( 'ppwp_form_general',
//				array(
//					'title' => __( 'General', 'password-protect-page' ),
//					'panel' => 'ppwp',
//				) );
//
//			/* background color - form container */
//			$wp_customize->add_setting( 'ppwp_form_general_background_color',
//				array(
//					'default' => PPW_Constants::DEFAULT_FORM_BACKGROUND_COLOR,
//				) );
//
//			$wp_customize->add_control(
//				new \WP_Customize_Color_Control(
//					$wp_customize,
//					'ppwp_form_general_background_color_control',
//					array(
//						'label'       => __( 'Background Color', 'password-protect-page' ),
//						'description' => __( 'Change the background color of the form', 'password-protect-page' ),
//						'section'     => 'ppwp_form_general',
//						'settings'    => 'ppwp_form_general_background_color',
//					)
//				)
//			);
//
//			// padding - form container
//			$wp_customize->add_setting( 'ppwp_form_general_padding', array(
//				'default' => PPW_Constants::DEFAULT_FORM_PADDING,
//			) );

//			$wp_customize->add_control( 'ppwp_form_general_padding_control', array(
//				'label'       => __( 'Padding', 'password-protect-page' ),
//				'description' => __( 'Padding in PX', 'password-protect-page' ),
//				'section'     => 'ppwp_form_general',
//				'settings'    => 'ppwp_form_general_padding',
//				'type'        => 'text',
//			) );
//
//			// margin - form container
//			$wp_customize->add_setting( 'ppwp_form_general_margin', array(
//				'default' => PPW_Constants::DEFAULT_FORM_MARGIN,
//			) );
//
//			$wp_customize->add_control( 'ppwp_form_general_margin_control', array(
//				'label'       => __( 'Margin', 'password-protect-page' ),
//				'description' => __( 'Margin in PX', 'password-protect-page' ),
//				'section'     => 'ppwp_form_general',
//				'settings'    => 'ppwp_form_general_margin',
//				'type'        => 'text',
//			) );

			/* form instructions section */
			$wp_customize->add_section( 'ppwp_form_instructions', array(
				'title'    => __( 'Password Form', 'password-protect-page' ),
				'panel'    => 'ppwp',
				'priority' => 100,
			) );

			/* instructions headline */
			$wp_customize->add_setting( 'ppwp_form_instructions_headline', array(
				'default' => __( PPW_Constants::DEFAULT_HEADLINE_TEXT, 'password-protect-page' ),
			) );
			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_form_instructions_headline',
					array(
						'label'    => __( 'Headline', 'password-protect-page' ),
						'section'  => 'ppwp_form_instructions',
						'settings' => 'ppwp_form_instructions_headline',
						'type'     => 'textarea',
					)
				)
			);

			/* headline font size */
			$wp_customize->add_setting( 'ppwp_form_instructions_headline_font_size', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_form_instructions_headline_font_size_control', array(
				'label'       => __( 'Headline Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => 'ppwp_form_instructions',
				'settings'    => 'ppwp_form_instructions_headline_font_size',
				'type'        => 'number',
			) );

			/* headline font weight */
			$wp_customize->add_setting( 'ppwp_form_instructions_headline_font_weight', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_form_instructions_headline_font_weight_control', array(
				'label'    => __( 'Headline Font Weight', 'password-protect-page' ),
				'section'  => 'ppwp_form_instructions',
				'settings' => 'ppwp_form_instructions_headline_font_weight',
				'type'     => 'number',
			) );

			/* headline color */
			$wp_customize->add_setting( 'ppwp_form_instructions_headline_color', array(
				'default' => PPW_Constants::DEFAULT_HEADLINE_FONT_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_instructions_headline_color_control', array(
					'label'    => __( 'Headline Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_instructions',
					'settings' => 'ppwp_form_instructions_headline_color',
				) )
			);

			/* placeholder text */
			$wp_customize->add_setting( 'ppwp_form_instructions_placeholder', array(
				'default' => __( PPW_Constants::DEFAULT_PLACEHOLDER, 'password-protect-page' ),
			) );
			$wp_customize->add_control( 'ppwp_form_instructions_placeholder_control', array(
				'label'    => __( 'Placholder', 'password-protect-page' ),
				'section'  => 'ppwp_form_instructions',
				'settings' => 'ppwp_form_instructions_placeholder',
				'type'     => 'text',
			) );

			/* instructions text */
			$wp_customize->add_setting( 'ppwp_form_instructions_text', array(
				'default' => __( apply_filters( PPW_Constants::HOOK_MESSAGE_PASSWORD_FORM, PPW_Constants::DEFAULT_FORM_MESSAGE ), 'password-protect-page' ),
			) );

			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_form_instructions_text',
					array(
						'label'    => __( 'Description', 'password-protect-page' ),
						'section'  => 'ppwp_form_instructions',
						'settings' => 'ppwp_form_instructions_text',
						'type'     => 'textarea',
					)
				)
			);

			/* instructions font size */
			$wp_customize->add_setting( 'ppwp_form_instructions_text_font_size', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_SIZE,
			) );
			$wp_customize->add_control( 'ppwp_form_instructions_text_font_size_control', array(
				'label'       => __( 'Description Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => 'ppwp_form_instructions',
				'settings'    => 'ppwp_form_instructions_text_font_size',
				'type'        => 'number',
			) );

			/* instructions font weight */
			$wp_customize->add_setting( 'ppwp_form_instructions_text_font_weight', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_form_instructions_text_font_weight_control', array(
				'label'    => __( 'Description Font Weight', 'password-protect-page' ),
				'section'  => 'ppwp_form_instructions',
				'settings' => 'ppwp_form_instructions_text_font_weight',
				'type'     => 'number',
			) );

			/* text color - form instructions */
			$wp_customize->add_setting( 'ppwp_form_instructions_text_color', array(
				'default' => PPW_Constants::DEFAULT_TEXT_FONT_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_instructions_text_color_control', array(
					'label'    => __( 'Description Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_instructions',
					'settings' => 'ppwp_form_instructions_text_color',
				) )
			);

			/* password typing - form instructions */

			$wp_customize->add_setting( 'ppwp_form_instructions_password_label', array(
				'default' => PPW_Constants::DEFAULT_PASSWORD_LABEL,
			) );

			$wp_customize->add_control( 'ppwp_form_instructions_password_label_control', array(
				'label'    => __( 'Password Label', 'password-protect-page' ),
				'section'  => 'ppwp_form_instructions',
				'settings' => 'ppwp_form_instructions_password_label',
				'type'     => 'text',
			) );

			/* password typing - form instructions */

			$wp_customize->add_setting( 'ppwp_form_instructions_is_show_password', array(
				'default' => PPW_Constants::DEFAULT_IS_SHOW_PASSWORD,
			) );

			$wp_customize->add_control( 'ppwp_form_instructions_is_show_password_control', array(
				'label'    => __( 'Password Reveal Button', 'password-protect-page' ),
				'section'  => 'ppwp_form_instructions',
				'settings' => 'ppwp_form_instructions_is_show_password',
				'type'     => 'checkbox',
			) );

			/* form error message section */
			$wp_customize->add_section( 'ppwp_form_error_message', array(
				'title'    => __( 'Error Message', 'password-protect-page' ),
				'panel'    => 'ppwp',
				'priority' => 200,
			) );

			/* error message text */
			$wp_customize->add_setting( 'ppwp_form_error_message_text', array(
				'default' => __( apply_filters( PPW_Constants::HOOK_MESSAGE_ENTERING_WRONG_PASSWORD, PPW_Constants::DEFAULT_WRONG_PASSWORD_MESSAGE ), 'password-protect-page' ),
			) );

			$wp_customize->add_control(
				new PPW_Text_Editor_Custom_Control(
					$wp_customize,
					'ppwp_form_error_message_text',
					array(
						'label'    => __( 'Error Message', 'password-protect-page' ),
						'section'  => 'ppwp_form_error_message',
						'settings' => 'ppwp_form_error_message_text',
						'type'     => 'editor',
					)
				)
			);

			/* error message font size */
			$wp_customize->add_setting( 'ppwp_form_error_message_text_font_size', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_SIZE,
			) );

			$wp_customize->add_control( 'ppwp_form_error_message_text_font_size_control', array(
				'label'       => __( 'Font Size', 'password-protect-page' ),
				'description' => __( 'Font size in px', 'password-protect-page' ),
				'section'     => 'ppwp_form_error_message',
				'settings'    => 'ppwp_form_error_message_text_font_size',
				'type'        => 'number',
			) );

			/* error message font weight */
			$wp_customize->add_setting( 'ppwp_form_error_message_text_font_weight', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_WEIGHT,
			) );
			$wp_customize->add_control( 'ppwp_form_error_message_text_font_weight_control', array(
				'label'    => __( 'Font Weight', 'password-protect-page' ),
				'section'  => 'ppwp_form_error_message',
				'settings' => 'ppwp_form_error_message_text_font_weight',
				'type'     => 'number',
			) );

			/* error message text color */
			$wp_customize->add_setting( 'ppwp_form_error_message_text_color', array(
				'default' => PPW_Constants::DEFAULT_ERROR_TEXT_FONT_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_error_message_text_color_control', array(
					'label'    => __( 'Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_error_message',
					'settings' => 'ppwp_form_error_message_text_color',
				) )
			);

			/* error message background color */
			$wp_customize->add_setting( 'ppwp_form_error_message_background_color', array(
				'default' => '#ffffff',
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_error_message_background_color_control', array(
					'label'    => __( 'Background Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_error_message',
					'settings' => 'ppwp_form_error_message_background_color',
				) )
			);

			/* form button */
			$wp_customize->add_section( 'ppwp_form_button', array(
				'title'    => __( 'Button', 'password-protect-page' ),
				'panel'    => 'ppwp',
				'priority' => 300,
			) );

			/* button label */
			$wp_customize->add_setting( 'ppwp_form_button_label', array(
				'default' => __( PPW_Constants::DEFAULT_SUBMIT_LABEL, 'password-protect-page' ),
			) );
			$wp_customize->add_control( 'ppwp_form_button_label_control', array(
				'label'    => __( 'Button Label', 'password-protect-page' ),
				'section'  => 'ppwp_form_button',
				'settings' => 'ppwp_form_button_label',
				'type'     => 'text',
			) );

			/* button text color */
			$wp_customize->add_setting( 'ppwp_form_button_text_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_TEXT_FONT_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_button_text_color_control', array(
					'label'    => __( 'Text Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_button',
					'settings' => 'ppwp_form_button_text_color',
				) )
			);

			/* button text hover color */
			$wp_customize->add_setting( 'ppwp_form_button_text_hover_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_TEXT_HOVER_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_button_text_hover_color_control', array(
					'label'    => __( 'Text Color (Hover)', 'password-protect-page' ),
					'section'  => 'ppwp_form_button',
					'settings' => 'ppwp_form_button_text_hover_color',
				) )
			);

			/* button background color */
			$wp_customize->add_setting( 'ppwp_form_button_background_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_BACKGROUND_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_button_background_color_control', array(
					'label'    => __( 'Background Color', 'password-protect-page' ),
					'section'  => 'ppwp_form_button',
					'settings' => 'ppwp_form_button_background_color',
				) )
			);

			/* button background hover color */
			$wp_customize->add_setting( 'ppwp_form_button_background_hover_color', array(
				'default' => PPW_Constants::DEFAULT_BUTTON_BACKGROUND_HOVER_COLOR,
			) );

			$wp_customize->add_control(
				new \WP_Customize_Color_Control(
					$wp_customize,
					'ppwp_form_button_background_hover_color_control', array(
					'label'    => __( 'Background Color (Hover)', 'password-protect-page' ),
					'section'  => 'ppwp_form_button',
					'settings' => 'ppwp_form_button_background_hover_color',
				) )
			);

		}

		/**
		 * Add dynamic styles
		 *
		 * @return void
		 */
		public function dynamic_styles() {
			?>
			<style>
				/*.ppw-individual-page {*/
				/*	background: */<?php //echo get_theme_mod( 'ppwp_form_general_background_color', 'transparent' ); ?>/*;*/
				/*	padding: */<?php //echo get_theme_mod( 'ppwp_form_general_padding', PPW_Constants::DEFAULT_FORM_PADDING ); ?>/*px;*/
				/*	margin: */<?php //echo get_theme_mod( 'ppwp_form_general_margin', PPW_Constants::DEFAULT_FORM_MARGIN ); ?>/*px;*/
				/*}*/

				.ppw-ppf-input-container h3.ppw-ppf-headline {
					font-size: <?php echo get_theme_mod( 'ppwp_form_instructions_headline_font_size', PPW_Constants::DEFAULT_HEADLINE_FONT_SIZE ); ?>px;
					font-weight: <?php echo get_theme_mod( 'ppwp_form_instructions_headline_font_weight', PPW_Constants::DEFAULT_HEADLINE_FONT_WEIGHT ); ?>;
					color: <?php echo get_theme_mod( 'ppwp_form_instructions_headline_color', PPW_Constants::DEFAULT_HEADLINE_FONT_COLOR ); ?>;
				}

				.ppw-ppf-input-container div.ppw-ppf-desc {
					font-size: <?php echo get_theme_mod( 'ppwp_form_instructions_text_font_size', PPW_Constants::DEFAULT_TEXT_FONT_SIZE ); ?>px;
					font-weight: <?php echo get_theme_mod( 'ppwp_form_instructions_text_font_weight', PPW_Constants::DEFAULT_TEXT_FONT_WEIGHT ); ?>;
					color: <?php echo get_theme_mod( 'ppwp_form_instructions_text_color', PPW_Constants::DEFAULT_TEXT_FONT_COLOR ); ?>;
				}

				div.ppwp-wrong-pw-error {
					font-size: <?php echo get_theme_mod( 'ppwp_form_error_message_text_font_size', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_SIZE ); ?>px;
					font-weight: <?php echo get_theme_mod( 'ppwp_form_error_message_text_font_weight', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_WEIGHT ); ?>;
					color: <?php echo get_theme_mod( 'ppwp_form_error_message_text_color', PPW_Constants::DEFAULT_ERROR_TEXT_FONT_COLOR ); ?>;
					background: <?php echo get_theme_mod( 'ppwp_form_error_message_background_color', PPW_Constants::DEFAULT_ERROR_TEXT_BACKGROUND_COLOR ); ?>;
				}

				.ppw-ppf-input-container input[type="submit"] {
					color: <?php echo get_theme_mod( 'ppwp_form_button_text_color', PPW_Constants::DEFAULT_BUTTON_TEXT_FONT_COLOR ); ?>;
					background: <?php echo get_theme_mod( 'ppwp_form_button_background_color', PPW_Constants::DEFAULT_BUTTON_BACKGROUND_COLOR ); ?>;
				}

				.ppw-ppf-input-container input[type="submit"]:hover {
					color: <?php echo get_theme_mod( 'ppwp_form_button_text_hover_color', PPW_Constants::DEFAULT_BUTTON_TEXT_HOVER_COLOR ); ?>;
					background: <?php echo get_theme_mod( 'ppwp_form_button_background_hover_color', PPW_Constants::DEFAULT_BUTTON_BACKGROUND_HOVER_COLOR ); ?>;
				}
			</style>
			<?php
		}

		/**
		 * Enqueue script for customizer control
		 */
		public function enqueue() {
			wp_enqueue_script( 'ppwp-customizer', PPW_DIR_URL . 'admin/js/customizer.js', array( 'jquery' ) );
		}

	}
}

