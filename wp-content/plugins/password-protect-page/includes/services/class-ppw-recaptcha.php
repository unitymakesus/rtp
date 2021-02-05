<?php

/**
 *
 * Class PPW_Recaptcha
 */
class PPW_Recaptcha {
	const TYPE_PARAM = 'ppwp_type';
	const TYPE_VALUE = 'recaptcha';

	const RECAPTCHA_V3_TYPE = 'recaptcha_v3';
	const RECAPTCHA_V2_CHECKBOX_TYPE = 'recaptcha_v2_checkbox';
	const RECAPTCHA_V2_INVISIBLE_TYPE = 'recaptcha_v2_invisible';

	private $show_message = false;

	/**
	 * @var PPW_Recaptcha
	 */
	protected static $instance;

	/**
	 * @return PPW_Recaptcha
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Recaptcha error message.
	 *
	 * @return string
	 */
	public function get_error_message() {
		$message = get_theme_mod( 'ppwp_form_error_recaptcha_message_text', PPW_Constants::DEFAULT_ERROR_RECAPTCHA_MESSAGE );
		$message = wp_kses_post( $message );

		return _x( $message, PPW_Constants::CONTEXT_PASSWORD_FORM, 'password-protect-page' );
	}

	/**
	 * Register hooks.
	 * @since 1.0.0
	 */
	public function register() {
		add_filter( 'ppwp_customize_ppf', array( $this, 'maybe_customize_error_message' ), 25 );
		add_filter( 'ppwp_ppf_redirect_url', array( $this, 'maybe_add_blocked_message' ), 20, 2 );
		add_filter( 'ppwp_ppf_referrer_url', array( $this, 'maybe_remove_recaptcha_query' ), 10, 2 );
		add_filter( 'ppwpea_recaptcha_v2_site_key', array( $this, 'get_ppwpea_recaptcha_v2_api_key' ), 10 );
		add_filter( 'ppwpea_recaptcha_v2_secret', array( $this, 'get_ppwpea_recaptcha_v2_api_secret' ), 10 );
	}

	/**
	 * Remove blocked query if user enter right password.
	 *
	 * @param string $referrer_url Referrer URL.
	 *
	 * @return string
	 */
	public function maybe_remove_recaptcha_query( $referrer_url ) {
		if ( ! $this->using_recaptcha() ) {
			return $referrer_url;
		}

		if ( $this->has_recaptcha_parameter( $referrer_url ) ) {
			$referrer_url = add_query_arg( self::TYPE_PARAM, false, $referrer_url );
		}

		return $referrer_url;
	}

	public function using_recaptcha() {
		return ppw_core_get_setting_type_bool_by_option_name( PPW_Constants::USING_RECAPTCHA, PPW_Constants::EXTERNAL_OPTIONS );
	}

	/**
	 * Add blocked message if user turn on option.
	 *
	 * @param string $redirect_url Redirect URL.
	 * @param array  $params       Parameters.
	 *
	 * @return string
	 */
	public function maybe_add_blocked_message( $redirect_url, $params ) {
		if ( ! $this->using_recaptcha() ) {
			return $redirect_url;
		}
		if ( $params['is_valid'] ) {
			return $redirect_url;
		}

		if ( ! $this->show_message ) {
			// Remove blocked parameter if URL has it.
			if ( $this->has_recaptcha_parameter( $redirect_url ) ) {
				$redirect_url = add_query_arg( self::TYPE_PARAM, false, $redirect_url );
			}

			return $redirect_url;
		}

		$redirect_url = add_query_arg( self::TYPE_PARAM, self::TYPE_VALUE, $redirect_url );

		return $redirect_url;
	}

	/**
	 * Has recaptcha parameter on URL.
	 *
	 * @param string $url         $url URL.
	 * @param string $query_value Query value.
	 *
	 * @return bool
	 */
	private function has_recaptcha_parameter( $url = '', $query_value = self::TYPE_VALUE ) {
		if ( empty( $url ) ) {
			$query_params = ppw_core_get_query_param();
		} else {
			$query_params = ppw_core_get_param_in_url( $url );
		}

		if ( ! isset( $query_params[ self::TYPE_PARAM ] ) ) {
			return false;
		}

		return $query_value === $query_params[ self::TYPE_PARAM ];
	}

	/**
	 * Customize error message.
	 *
	 * @param array $params Parameters.
	 *
	 * @return array
	 */
	public function maybe_customize_error_message( $params ) {
		if ( ! $this->using_recaptcha() ) {
			return $params;
		}

		if ( $this->has_recaptcha_parameter() ) {
			$message             = $this->get_error_message();
			$params['error_msg'] = apply_filters( 'ppw_recaptcha_error_message', $message, $params );
		}

		return $params;
	}

	/**
	 * Validate recaptcha.
	 *
	 * @return bool
	 */
	public function is_valid_recaptcha() {
		if ( ! isset( $_POST['g-recaptcha-response'] ) ) {
			$this->show_message = true;

			return false;
		}

		$result = $this->verify_recaptcha( $_POST['g-recaptcha-response'] );
		if ( ! $result['success'] ) {
			$this->show_message = true;

			return false;
		}

		return true;
	}

	/**
	 * Get limit score.
	 *
	 * @return double
	 */
	public function get_limit_score() {
		$score = ppw_core_get_settings_by_option_name( PPW_Constants::RECAPTCHA_SCORE, PPW_Constants::EXTERNAL_OPTIONS );
		if ( is_null( $score ) ) {
			return (double) 0.5;
		}

		return (double) $score;
	}

	/**
	 * Get setting api key of recaptcha with current type.
	 *
	 * @param string $type Recaptcha type.
	 * @param string $default Default value.
	 *
	 * @return string
	 */
	public function get_setting_api_key( $type = '', $default = '' ) {
		if ( empty( $type ) ) {
			$type = $this->get_recaptcha_type();
		}

		switch ( $type ) {
			case self::RECAPTCHA_V3_TYPE:
				return $this->get_recaptcha_v3_api_key();
			case self::RECAPTCHA_V2_CHECKBOX_TYPE:
				return $this->get_recaptcha_v2_api_key();
			default:
				return $default;
		}
	}

	/**
	 * Get setting api secret of recaptcha with current type.
	 *
	 * @param string $type Recaptcha type.
	 * @param string $default Default value.
	 *
	 * @return string
	 */
	public function get_setting_api_secret( $type = '', $default = '' ) {
		if ( empty( $type ) ) {
			$type = $this->get_recaptcha_type();
		}

		switch ( $type ) {
			case self::RECAPTCHA_V3_TYPE:
				return $this->get_recaptcha_v3_api_secret();
			case self::RECAPTCHA_V2_CHECKBOX_TYPE:
				return $this->get_recaptcha_v2_api_secret();
			default:
				return $default;
		}
	}

	/**
	 * Get recaptcha v3 API key.
	 *
	 * @return string
	 */
	public function get_recaptcha_v3_api_key() {
		return ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_API_KEY, PPW_Constants::EXTERNAL_OPTIONS );
	}

	/**
	 * Get recaptcha v3 API secret.
	 *
	 * @return string
	 */
	public function get_recaptcha_v3_api_secret() {
		return ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_API_SECRET, PPW_Constants::EXTERNAL_OPTIONS );
	}

	/**
	 * Get recaptcha v2 API key.
	 *
	 * @return string
	 */
	public function get_recaptcha_v2_api_key() {
		return ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_V2_CHECKBOX_API_KEY, PPW_Constants::EXTERNAL_OPTIONS );
	}

	/**
	 * Get recaptcha v2 API secret.
	 *
	 * @return string
	 */
	public function get_recaptcha_v2_api_secret() {
		return ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_V2_CHECKBOX_API_SECRET, PPW_Constants::EXTERNAL_OPTIONS );
	}

	/**
	 * Get recaptcha type.
	 *
	 * @return string
	 */
	public function get_recaptcha_type() {
		$recaptcha_type = ppw_core_get_setting_type_string_by_option_name( PPW_Constants::RECAPTCHA_TYPE, PPW_Constants::EXTERNAL_OPTIONS );

		return $recaptcha_type ? $recaptcha_type : self::RECAPTCHA_V3_TYPE;
	}

	/**
	 * Load recaptcha v2 javascript.
	 */
	public function load_recaptcha_v2_js() {
		ob_start();
		?>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<?php

		echo ob_get_clean();
	}

	/**
	 * Load recaptcha v3 javascript.
	 */
	public function load_recaptcha_v3_js() {
		$recaptcha_key = $this->get_recaptcha_v3_api_key();

		ob_start();
		?>
		<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $recaptcha_key; ?>"></script>
		<script>
		  grecaptcha.ready(function () {
			grecaptcha.execute('<?php echo $recaptcha_key; ?>', {action: 'enter_password'}).then(function (token) {
			  var recaptchaResponse = document.getElementById('ppwRecaptchaResponse');
			  recaptchaResponse.value = token;
			});
		  });
		</script>
		<?php

		echo ob_get_clean();
	}

	/**
	 * Verify google recaptcha V3.
	 *
	 * @param string $recaptcha_response Recaptcha response.
	 *
	 * @return array
	 */
	public function verify_recaptcha( $recaptcha_response ) {
		$default = array(
			'success' => false,
			'message' => '',
		);
		if ( ! $recaptcha_response ) {
			return $default;
		}
		$secret = $this->get_setting_api_secret();
		if ( ! $secret ) {
			return $default;
		}

		$response = wp_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
			array(
				'method'      => 'POST',
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array(
					'secret'   => $secret,
					'response' => $recaptcha_response,
				),
				'cookies'     => array(),
			)
		);

		if ( is_wp_error( $response ) ) {
			return $default;
		}

		$body = wp_remote_retrieve_body( $response );
		$body = json_decode( $body );

		// Whether this request was a valid reCAPTCHA token for your site.
		$success = isset( $body->success ) && $body->success;

		$external = true;
		if ( $this->get_recaptcha_type() === self::RECAPTCHA_V3_TYPE ) {
			$limit_score = $this->get_limit_score();

			// The score for this request (0.0 - 1.0) 1.0 is very likely a good interaction, 0.0 is very likely a bot.
			$score    = isset( $body->score ) ? (double) $body->score : 0;
			$external = $score > $limit_score;
		}
		$default['success'] = $success && $external;

		return $default;
	}

	/**
	 * Load PPWPEA api key.
	 *
	 * @param string $key Recaptcha API key.
	 *
	 * @return string
	 */
	public function get_ppwpea_recaptcha_v2_api_key( $key ) {
		return $this->get_recaptcha_v2_api_key();
	}

	/**
	 * Load PPWPEA api secret.
	 *
	 * @param string $secret Recaptcha API secret.
	 *
	 * @return string
	 */
	public function get_ppwpea_recaptcha_v2_api_secret( $secret ) {
		return $this->get_recaptcha_v2_api_secret();
	}

}
