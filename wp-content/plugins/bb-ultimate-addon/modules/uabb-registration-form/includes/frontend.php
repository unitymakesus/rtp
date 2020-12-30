<?php
/**
 *  Registration Form Module file
 *
 *  @package Registration Form Module
 */

/**
 * Function that adds async attribute
 *
 * @since 1.22.0
 * @method  uabb_add_async_attribute for the enqueued `uabb-g-recaptcha` script
 * @param string $tag    Script tag.
 * @param string $handle Registered script handle.
 */
add_filter(
	'script_loader_tag',
	function( $tag, $handle ) {
		if ( ( 'uabb-g-recaptcha' !== $handle ) || ( 'uabb-g-recaptcha' === $handle && strpos( $tag, 'uabb-g-recaptcha-api' ) !== false ) ) {
			return $tag;
		}
		return str_replace( ' src', ' id="uabb-g-recaptcha-api" async="async" defer="defer" src', $tag );
	},
	10,
	2
);
$message = __( 'Please accept the Terms and Conditions to proceed.', 'uabb' );
?>

<?php
$users_can_register = get_option( 'users_can_register' );
if ( 'default' === $settings->login_link_to ) {
	$login_link = wp_login_url();
} else {
	$login_link = $settings->login_link_url;
}
if ( 'default' === $settings->lost_link_to ) {
	$lost_link = wp_lostpassword_url();
} else {
	$lost_link = $settings->lost_link_url;
}
if ( 'yes' === $settings->hide_form_logged && is_user_logged_in() && ! FLBuilderModel::is_builder_active() ) {
	?>
	<div class="uabb-logged_registration-form">
		<div class="uabb-registration-loggedin-message">
			<?php
			if ( '' !== $settings->logged_in_text ) {
				echo '<span>' . $settings->logged_in_text . '</span>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	</div>
	<?php
} else {
	if ( $users_can_register ) {
		?>
		<?php
		$confirm_pass_field = false;
		$valid_pass_field   = false;
		$user_email_field   = '';
		$error_string       = '';

		$fields_array = array(
			'user_login'   => 'Username',
			'user_pass'    => 'Password',
			'confirm_pass' => 'Confirm Password',
			'user_email'   => 'User Email',
			'first_name'   => 'First Name',
			'last_name'    => 'Last Name',
			'phone'        => 'Phone',
		);
		$form_field   = $settings->form_field;
		foreach ( $form_field as $key => $item ) {

			if ( 'user_email' === $item->field_type ) {
				$user_email_field = 'yes';
			}
			if ( 'confirm_pass' === $item->field_type ) {

				$confirm_pass_field = true;
			}
			if ( 'user_pass' === $item->field_type ) {
				$valid_pass_field = true;
			}
			if ( isset( ${ 'is_' . $item->field_type . '_exists' } ) && ! empty( ${ 'is_' . $item->field_type . '_exists' } ) ) {
				${ 'is_' . $item->field_type . '_exists' }++;

			} else {
				${ 'is_' . $item->field_type . '_exists' } = 0;
				${ 'is_' . $item->field_type . '_exists' }++;
			}
		}
		foreach ( $fields_array as $key => $value ) {

			$is_repeated = ( isset( ${ 'is_' . $key . '_exists' } ) ) ? ${ 'is_' . $key . '_exists' } : '';
			if ( isset( $is_repeated ) && 1 < $is_repeated ) {
				$error_string .= $value . ', ';
			}
		}
		if ( isset( $error_string ) && ! empty( $error_string ) ) {
			$error_string = rtrim( $error_string, ', ' );
			?>
				<span class='uabb-register-error-message'>
					<?php
					echo wp_kses_post( __( 'Error! It seems like you have added <b>' . $error_string . '</b> field in the form more than once.', 'uabb' ) ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
					?>
				</span>
			<?php } elseif ( $confirm_pass_field && ! $valid_pass_field ) { ?>
				<span class='uabb-register-error-message'>
					<?php
					esc_attr_e( 'Password field should be added to the form to use the Confirm Password field.', 'uabb' );
					?>
				</span>
			<?php } elseif ( 'yes' !== $user_email_field ) { ?>
				<span class='uabb-register-error-message'>
					<?php
					esc_attr_e( 'For Registration Form E-mail field is required!', 'uabb' );
					?>
				</span>
			<?php } else { ?>
				<form class="uabb-module-content uabb-registration-form" method="post" data-nonce=<?php echo wp_kses_post( wp_create_nonce( 'uabb-rf-nonce' ) ); ?> >
					<div class="uabb-input-group-wrap">
						<?php echo $module->form_field_data(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php
						if ( 'show' === $settings->uabb_recaptcha_toggle ) {
							?>
							<div class="uabb-input-group uabb-recaptcha">
								<div class="uabb-form-outter">
									<?php if ( 'v3' === $settings->uabb_recaptcha_version && ! empty( $settings->uabb_v3_recaptcha_site_key ) && ! empty( $settings->uabb_v3_recaptcha_secret_key ) ) { ?>
										<div id="<?php echo esc_attr( $id ); ?>-uabb-grecaptcha" class="uabb-grecaptcha" data-sitekey="<?php echo esc_attr( $settings->uabb_v3_recaptcha_site_key ); ?>" data-theme="<?php echo esc_attr( $settings->uabb_recaptcha_theme ); ?>"  data-type="v3" data-action="Form" data-badge="<?php echo esc_attr( $settings->uabb_badge_position ); ?>" data-size="invisible"></div>
									<?php } elseif ( 'v2' === $settings->uabb_recaptcha_version && ! empty( $settings->uabb_recaptcha_site_key ) && ! empty( $settings->uabb_recaptcha_secret_key ) ) { ?>
										<div id="<?php echo esc_attr( $id ); ?>-uabb-grecaptcha" class="uabb-grecaptcha" data-sitekey="<?php echo esc_attr( $settings->uabb_recaptcha_site_key ); ?>" data-theme="<?php echo esc_attr( $settings->uabb_recaptcha_theme ); ?>"></div>
									<?php } ?>
									<span class="uabb-registration-error uabb-registration_form-error-message-required "><?php esc_attr_e( 'Please check the reCAPTCHA to verify you are not a robot.', 'uabb' ); ?></span>
								</div>
							</div>
							<?php
						}

						if ( ( 'yes' === $settings->login_link || 'yes' === $settings->lost_your_pass ) && 'above' === $settings->login_text_position ) {
							?>
							<div class=" uabb-input-group uabb-rform-exteral-link-wrap" >
									<?php if ( 'yes' === $settings->login_link ) { ?>
									<a class="uabb-rform-exteral-link" href="<?php echo $login_link; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
										<span> <?php echo $settings->login_link_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>
									</a>
								<?php } ?>
									<?php if ( 'yes' === $settings->lost_your_pass ) { ?>
									<a class="uabb-rform-exteral-link" href="<?php echo $lost_link; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
										<span> <?php echo $settings->lost_link_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>
									</a>
								<?php } ?>
							</div>
							<?php
						}
						if ( 'show' === $settings->terms_checkbox ) {
							?>
							<div class="uabb-input-group uabb-terms-checkbox">
									<?php if ( isset( $settings->terms_text ) && ! empty( $settings->terms_text ) ) : ?>
									<div class="uabb-terms-text"><?php echo $settings->terms_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
								<?php endif; ?>
								<div class="uabb-form-outter">
									<label class="uabb-terms-label" for="uabb-terms-checkbox-<?php echo esc_attr( $id ); ?>">
										<input aria-label="checkbox" type="checkbox" class="checkbox-inline" id="uabb-terms-checkbox-<?php echo esc_attr( $id ); ?>" name="uabb-terms-checkbox" value="1" />
										<span class="checkbox-label">
												<?php echo $settings->terms_checkbox_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</span>
									</label>
								</div>
								<label class="uabb-registration-error"><?php echo wp_kses_post( apply_filters( 'uabb_registration_form_error_message', $message ) ); ?></label>
							</div>
					<?php } if ( 'yes' === $settings->honeypot_check ) { ?>
						<div class="uabb-input-group-honeypot">
							<input size="1" type="text" style="display:none;" name="input_text">
						</div>
					<?php } ?>
								<button type="submit" class="uabb-submit-btn uabb-registration-form-submit uabb-submit-btn-align-<?php echo esc_attr( $settings->btn_align ); ?> uabb-rf-btn-col_<?php echo esc_attr( $settings->btn_col_width ); ?> uabb-rf-btn-medium-col_<?php echo esc_attr( $settings->btn_col_width_medium ); ?> uabb-rf-btn-responsive-col_<?php echo esc_attr( $settings->btn_col_width_responsive ); ?>" ><span class="uabb-registration-form-button-text"><?php echo ( $settings->btn_text ) ? $settings->btn_text : 'Submit'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></button>
						<?php if ( ( 'yes' === $settings->login_link || 'yes' === $settings->lost_your_pass ) && 'below' === $settings->login_text_position ) { ?>
							<div class=" uabb-input-group uabb-rform-exteral-link-wrap" >
								<?php if ( 'yes' === $settings->login_link ) { ?>
									<a class="uabb-rform-exteral-link" href="<?php echo $login_link; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
										<span> <?php echo $settings->login_link_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>
									</a>
								<?php } ?>
								<?php if ( 'yes' === $settings->lost_your_pass ) { ?>
									<a class="uabb-rform-exteral-link" href="<?php echo $lost_link; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
										<span> <?php echo $settings->lost_link_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
						<div class=" uabb-input-group uabb-rf-success-message-wrap">
							<div class="uabb-rf-success-message"><?php echo $settings->success_message; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						</div>
						<div class=" uabb-input-group uabb-registration_form-error-message-required">
							<div class="uabb-rf-honeypot"><?php echo $settings->error_message; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						</div>
					</div>
				</form>
				<?php
			}
			?>
	<?php } else {
		if ( is_multisite() ) {
			echo '<div class="uabb-registration-form-error uabb-register-error-message">' . esc_attr_e( 'To use the Registration Form on your site, you must set the "Allow new registrations" to "User accounts may be registered" setting from Network Admin -> Dashboard -> Settings.', 'uabb' ) . '</div>';
		} else {

			echo '<div class="uabb-registration-form-error uabb-register-error-message">' . esc_attr_e( 'To use the Registration Form on your site, you must enable the "Anyone can register" setting from Dashboard -> Settings -> General -> Membership.', 'uabb' ) . '</div>';
		}
	}
}
?>
