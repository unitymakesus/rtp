<?php
/**
 *  UABB Registration Form Module file
 *
 *  @package UABB Registration Form Module
 */

/**
 * Function that initializes UABB Registration Form Module
 *
 * @class UABBRegistrationFormModule
 */
class UABBRegistrationFormModule extends FLBuilderModule {
	/**
	 * Holds Email Content.
	 *
	 * @since 1.22.0
	 * @var $email_content
	 */
	static $email_content = array();

	/**
	 * Constructor function that constructs default values for the Button Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'User Registration Form', 'uabb' ),
				'description'     => __( 'User Registration Form.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-registration-form/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-registration-form/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'editor-table.svg',
			)
		);

		add_action( 'wp_ajax_uabb_registration_form', array( $this, 'register_user' ) );
		add_action( 'wp_ajax_nopriv_uabb_registration_form', array( $this, 'register_user' ) );
		add_filter( 'wp_new_user_notification_email', array( $this, 'uabb_custom_wp_new_user_notification_email' ), 10, 3 );
		add_filter( 'script_loader_tag', array( $this, 'uabb_rf_add_async_attribute' ), 10, 2 );
	}
	/**
	 * Function that enqueue's the scripts
	 *
	 * @since 1.22.0
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		$settings = $this->settings;
		if ( isset( $settings->uabb_recaptcha_toggle ) && 'show' == $settings->uabb_recaptcha_toggle ) {

			$site_lang = substr( get_locale(), 0, 2 );
			$post_id   = FLBuilderModel::get_post_id();

			$this->add_js(
				'uabb-g-recaptcha',
				'https://www.google.com/recaptcha/api.js?onload=onLoadUABBReCaptcha&render=explicit&hl=' . $site_lang,
				array(),
				'2.0',
				true
			);
		}
		if ( isset( $settings->check_password_strength ) && 'yes' === $settings->check_password_strength ) {
			$this->add_js( 'password-strength-meter' );
		}
	}
	/**
	 * Function that adds async attribute
	 *
	 * @since 1.22.0
	 * @method  uabb_add_async_attribute for the enqueued `uabb-g-recaptcha` script
	 * @param string $tag    Script tag.
	 * @param string $handle Registered script handle.
	 */
	public function uabb_rf_add_async_attribute( $tag, $handle ) {
		if ( ( 'uabb-g-recaptcha' !== $handle ) || ( 'uabb-g-recaptcha' === $handle && strpos( $tag, 'uabb-g-recaptcha-api' ) !== false ) ) {
			return $tag;
		}

		return str_replace( ' src', ' id="uabb-g-recaptcha-api" async="async" defer="defer" src', $tag );
	}
	/**
	 * Function that adds async attribute
	 *
	 * @since 1.22.0
	 * @method  get_client_ip for the enqueued return IP
	 */
	public static function get_client_ip() {
		$server_ip_keys = array(
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
		);

		foreach ( $server_ip_keys as $key ) {
			if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
				return $_SERVER[ $key ];
			}
		}

		// Fallback local ip.
		return '127.0.0.1';
	}
	/**
	 * Function that sends the Email
	 *
	 * @since 1.22.0
	 * @param array  $wp_new_user_notification_email returns email content array.
	 * @param String $user current user name $user.
	 * @param String $blogname site URL.
	 * @method custom_wp_new_user_notification_email
	 */
	public function uabb_custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {

		if ( array_key_exists( 'email_template', self::$email_content ) && 'custom' === self::$email_content['email_template'] ) {

			$wp_new_user_notification_email['headers'] = self::$email_content['headers'];

			$wp_new_user_notification_email['subject'] = self::$email_content['subject'];

			$wp_new_user_notification_email['message'] = self::$email_content['message'];
		}

		return $wp_new_user_notification_email;
	}
	/**
	 * Function that Create a user
	 *
	 * @since 1.22.0
	 * @method register_user
	 */
	static public function register_user() {

		check_ajax_referer( 'uabb-rf-nonce', 'security' );

		$data               = array();
		$error              = array();
		$error_flag         = '';
		$password_generated = '';

			$node_id          = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
			$template_id      = isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
			$template_node_id = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		if ( $node_id ) {
			// Get the module settings.
			if ( $template_id ) {

				$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
				$data     = FLBuilderModel::get_layout_data( 'published', $post_id );
				$settings = $data[ $template_node_id ]->settings;

			} else {

				$module   = FLBuilderModel::get_module( $node_id );
				$settings = $module->settings;
			}
		}

		if ( isset( $_POST['data'] ) ) {

			$data = $_POST['data'];

			if ( 'v3' === $settings->uabb_recaptcha_version ) {

				$recaptcha_response = $data['recaptcha_response'];

				$recaptcha_secret = $settings->uabb_v3_recaptcha_secret_key;

				$client_ip = UABBRegistrationFormModule::get_client_ip();

				if ( 0 > $settings->uabb_v3_recaptcha_score || 1 < $settings->uabb_v3_recaptcha_score ) {
					$recaptcha_score = 0.5;
				}
				$request  = array(
					'body' => array(
						'secret'   => $recaptcha_secret,
						'response' => $recaptcha_response,
						'remoteip' => $client_ip,
					),
				);
				$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', $request );

				$response_code = wp_remote_retrieve_response_code( $response );

				if ( 200 !== (int) $response_code ) {
					/* translators: %d admin link */
					$error['recaptcha'] = sprintf( __( 'Can not connect to the reCAPTCHA server (%d).', 'uabb' ), $response_code );
				} else {
					$body   = wp_remote_retrieve_body( $response );
					$result = json_decode( $body, true );

					$action = ( ( isset( $result['action'] ) && 'Form' === $result['action'] ) && ( $result['score'] > $recaptcha_score ) );

					if ( ! $result['success'] ) {
						if ( ! $action ) {
							$message = __( 'Invalid Form - reCAPTCHA validation failed', 'uabb' );

							if ( isset( $result['error-codes'] ) ) {
								$result_errors = array_flip( $result['error-codes'] );

								foreach ( $recaptcha_errors as $error_key => $error_desc ) {
									if ( isset( $result_errors[ $error_key ] ) ) {
										$message = $recaptcha_errors[ $error_key ];
										break;
									}
								}
							}
							$error['recaptcha'] = $message;
						}
					}
				}
			}

			$illegal_register = (array) apply_filters( 'uabb_illegal_user_register', array() );

			if ( empty( $data['user_pass'] ) ) {

				$data['user_pass']  = wp_generate_password();
				$password_generated = true;

			} else {

				if ( false !== strpos( wp_unslash( $data['user_pass'] ), '\\' ) ) {

					$error['user_pass'] = __( 'Passwords may not contain the character "\\"', 'uabb' );
					$error_flag         = true;
				}
			}
			if ( ! is_email( $data['user_email'] ) ) {

				$error['user_email'] = __( 'The email address isn&#8217;t correct.', 'uabb' );
				$error_flag          = true;

			} elseif ( email_exists( $data['user_email'] ) ) {

				$error['user_email'] = __( 'This email is already registered, please choose another one.', 'uabb' );
				$error_flag          = true;
			}

			if ( empty( $data['user_login'] ) ) {

				$data['user_login'] = $this->uabb_create_username( $data['user_email'], '' );

			} elseif ( ! validate_username( $data['user_login'] ) ) {
				$error['user_login'] = __( 'This username is invalid because it uses illegal characters. Please enter a valid username.', 'uabb' );
				$error_flag          = true;

			} elseif ( username_exists( $data['user_login'] ) ) {
				$error['user_login'] = __( 'This username is already registered. Please choose another one.', 'uabb' );

				$error_flag = true;

			} elseif ( in_array( strtolower( $data['user_login'] ), array_map( 'strtolower', $illegal_register ) ) ) {

				$error['user_login'] = __( 'Sorry, that username is not allowed.', 'uabb' );
				$error_flag          = true;
			}

			$user_login = ( isset( $data['user_login'] ) && ! empty( $data['user_login'] ) ) ? sanitize_user( $data['user_login'], true ) : '';

			$user_email = ( isset( $data['user_email'] ) && ! empty( $data['user_email'] ) ) ? sanitize_text_field( wp_unslash( $data['user_email'] ) ) : '';

			$first_name = ( isset( $data['first_name'] ) && ! empty( $data['first_name'] ) ) ? sanitize_user( $data['first_name'], true ) : '';

			$last_name = ( isset( $data['last_name'] ) && ! empty( $data['last_name'] ) ) ? sanitize_user( $data['last_name'], true ) : '';

			if ( true === $error_flag ) {

				$response['success'] = false;
				$response['error']   = $error;

			} else {

				$user_role = ( 'default' !== $settings->new_user_role && ! empty( $settings->new_user_role ) ) ? $settings->new_user_role : get_option( 'default_role' );

				$user_args = apply_filters(
					'uabb_register_insert_user_args',
					array(
						'user_login'      => isset( $user_login ) ? $user_login : '',
						'user_pass'       => isset( $data['user_pass'] ) ? $data['user_pass'] : '',
						'user_email'      => isset( $user_email ) ? $user_email : '',
						'first_name'      => isset( $first_name ) ? $first_name : '',
						'last_name'       => isset( $last_name ) ? $last_name : '',
						'user_registered' => date( 'Y-m-d H:i:s' ),
						'role'            => $user_role,
					)
				);

				$result = wp_insert_user( $user_args );

				if ( ! is_wp_error( $result ) ) {

					$response['success'] = true;

					$response['message'] = __( 'successfully registered', 'uabb' );

					/* Login user after registration and redirect to home page if not currently logged in */
					if ( ! is_user_logged_in() && 'yes' === $settings->auto_login ) {
						$creds                  = array();
						$creds['user_login']    = $user_login;
						$creds['user_password'] = $data['user_pass'];
						$creds['remember']      = true;
						$login_user             = wp_signon( $creds, false );
					}

					/* Send an email to user with password after registration */
					$site_title = get_bloginfo( 'name' );
					if ( true === $password_generated ) {
						if ( $result ) {
							$notify                      = 'both';
							self::$email_content['pass'] = $data['user_pass'];
						}
					}

					/**
					 * Fires after a new user has been created.
					 *
					 * @since 1.22.0
					 *
					 * @param int    $user_id ID of the newly created user.
					 * @param string $notify  Type of notification that should happen. See wp_send_new_user_notifications()
					 *                        for more information on possible values.
					 */
					if ( true === $password_generated || 'yes' === $settings->send_mail_after_register ) {

						$template = $settings->email_template_reg;

						if ( isset( $user_login ) ) {
							$template = str_replace( '[USERNAME]', $user_login, $template );
						}
						if ( isset( $data['user_pass'] ) ) {
							$template = str_replace( '[PASSWORD]', $data['user_pass'], $template );
						}
						self::$email_content['headers']        = 'Content-Type: text/' . $settings->email_content_type . '; charset=UTF-8' . "\r\n";
						self::$email_content['message']        = $template;
						self::$email_content['subject']        = $settings->email_subject;
						self::$email_content['email_template'] = $settings->email_template;

						do_action( 'edit_user_created_user', $result, 'both' );

					}
				} else {
					$response['error'] = wp_send_json_error();
				}
			}
			echo wp_send_json( $response );
		} else {
			wp_die();
		}
	}
	/**
	 * Function that Create a Input Field
	 *
	 * @since 1.22.0
	 * @param String $field_name Input Field name.
	 * @param String $type Input Field Type.
	 * @param String $label Input Field label.
	 * @param String $error_class Input Field error class.
	 * @param String $field_width Input Field width.
	 * @param String $placeholder Input Field placeholder.
	 * @method create_field
	 */
	public function create_field( $field_name, $type, $label, $error_class, $field_width, $placeholder ) {

		$required_class = '';

		if ( 'yes' === $this->settings->required_mark_label ) {
			$required_class = 'uabb-rform-requried-' . $error_class;
		}

		$label = ( 'yes' === $this->settings->enabled_label ) ? $label : '';

		?>
		<div class="uabb-input-group uabb-<?php echo $field_name; ?> uabb-rf-column-desktop_<?php echo $field_width['desktop']; ?> uabb-rf-column-medium_<?php echo $field_width['medium']; ?> uabb-rf-column-responsive_<?php echo $field_width['responsive']; ?> <?php echo $required_class; ?>" >
			<?php if ( '' !== $label ) { ?>
				<label for="uabb-name" class="uabb-label-mark"> <?php echo $label; ?></label>
			<?php } ?>
			<div class="uabb-form-outter">
				<input type="<?php echo $type; ?>" name="uabb_<?php echo $field_name; ?>" value="" class="uabb-registration-form-requried-<?php echo $error_class; ?>" placeholder="<?php echo $placeholder; ?>">
				<?php if ( 'email' === $type ) { ?>
					<div class="uabb-registration_form-error-message uabb-registration_form-error-message-required"><span class="uabb-registration-form-invalid-field"></div>
				<?php } else { ?>
					<div class="uabb-registration_form-error-message uabb-registration_form-error-message-required"></div>
				<?php } ?>
				<?php if ( 'password' === $type && 'confirm_password' !== $field_name ) { ?>
					<div class="uabb-registration-form-pass-verify"></div>
				<?php } ?>	
			</div>	
		</div>
		<?php
	}
	/**
	 * Function that call to the create_field function
	 *
	 * @since 1.22.0
	 * @method form_field_data
	 */
	public function form_field_data() {

		$form_field = $this->settings->form_field;

		foreach ( $form_field as $key => $item ) {

			switch ( $item->field_type ) {

				case 'user_login':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);

					$this->create_field( $item->field_type, 'text', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				case 'user_pass':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);
					$this->create_field( $item->field_type, 'password', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				case 'confirm_pass':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);
					$this->create_field( $item->field_type, 'password', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				case 'user_email':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);
					$this->create_field( $item->field_type, 'email', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				case 'first_name':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);
					$this->create_field( $item->field_type, 'text', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				case 'last_name':
					$field_width = array(
						'desktop'    => $item->field_width,
						'medium'     => $item->field_width_medium,
						'responsive' => $item->field_width_responsive,
					);
					$this->create_field( $item->field_type, 'text', $item->field_label, $item->field_required, $field_width, $item->field_placeholder );
					break;
				default:
					break;

			}
		}
	}
	/**
	 * Function that Generated New User Name
	 *
	 * @since 1.22.0
	 * @param String $email User Email.
	 * @param String $suffix User suffix.
	 * @method uabb_create_username
	 */
	public function uabb_create_username( $email, $suffix ) {
		$username_parts = array();

		// If there are no parts, e.g. name had unicode chars, or was not provided, fallback to email.
		if ( empty( $username_parts ) ) {
			$email_parts    = explode( '@', $email );
			$email_username = $email_parts[0];

			// Exclude common prefixes.
			if ( in_array(
				$email_username,
				array(
					'sales',
					'hello',
					'mail',
					'contact',
					'info',
				),
				true
			) ) {
				// Get the domain part.
				$email_username = $email_parts[1];
			}

			$username_parts[] = sanitize_user( $email_username, true );
		}

		$username = mb_strtolower( implode( '', $username_parts ) );

		if ( $suffix ) {
			$username .= $suffix;
		}

		if ( username_exists( $username ) ) {
			// Generate something unique to append to the username in case of a conflict with another user.
			$suffix = '-' . zeroise( wp_rand( 0, 9999 ), 4 );
			return $this->uabb_create_username( $email, $suffix );
		}

		return $email_username;
	}
	/**
	 * Retrieve User Roles.
	 *
	 * @since 1.22.0
	 * @access public
	 *
	 * @return array User Roles.
	 */
	public static function get_user_roles() {

		global $wp_roles;

		if ( ! class_exists( 'WP_Roles' ) ) {
			return;
		}

		if ( ! isset( $wp_roles ) ) {

			$wp_roles = get_editable_roles();
		}

		$roles      = isset( $wp_roles->roles ) ? $wp_roles->roles : array();
		$user_roles = array();

		$user_roles['default'] = __( 'Default', 'uabb' );

		foreach ( $roles as $role_key => $role ) {
			$user_roles[ $role_key ] = $role['name'];
		}

		return apply_filters( 'uabb_user_default_roles', $user_roles );
	}
	/**
	 * Retrieve Default Email Template.
	 *
	 * @since 1.22.0
	 * @access public
	 */
	static public function default_email_template() {
		$host = 'localhost';
		if ( isset( $_SERVER['HTTP_HOST'] ) ) {
			$host = $_SERVER['HTTP_HOST'];
		}

		$current_url = 'http://' . $host . strtok( $_SERVER['REQUEST_URI'], '?' );

		$default_template_reg = sprintf(
			/* translators: %1$s: search term, translators: %2$s: search term */ __(
				'Dear User,

You have successfully created your "%1$s" account. Thank you for registering with us!
Get the most of our service benefits with your registered account.Please click the link below to access your account.%2$s
And here\'s the password [PASSWORD] to log in to the account.

Regards,
Team
----
You have received a new submission from %1$s
			(%2$s)',
				'uabb'
			),
			get_bloginfo( 'name' ),
			$current_url
		);

		return $default_template_reg;
	}
}



/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::Check_BB_Version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-registration-form/uabb-registration-form-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-registration-form/uabb-registration-form-bb-less-than-2-2-compatibility.php';
}
