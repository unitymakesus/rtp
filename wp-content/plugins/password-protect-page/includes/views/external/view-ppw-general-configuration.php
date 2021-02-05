<?php
$api_key       = PPW_Recaptcha::get_instance()->get_recaptcha_v3_api_key();
$api_key_v2    = PPW_Recaptcha::get_instance()->get_recaptcha_v2_api_key();
$api_secret    = PPW_Recaptcha::get_instance()->get_recaptcha_v3_api_secret();
$api_secret_v2 = PPW_Recaptcha::get_instance()->get_recaptcha_v2_api_secret();
$score         = PPW_Recaptcha::get_instance()->get_limit_score();

?>
<div class="ppw_main_container" id="ppw_shortcodes_form">
	<form id="wpp_external_form" method="post">
		<input type="hidden" id="ppw_general_form_nonce"
		       value="<?php echo wp_create_nonce( PPW_Constants::GENERAL_FORM_NONCE ); ?>"/>
		<table class="ppwp_settings_table" cellpadding="4">
			<td colspan="2">
				<div style="margin-bottom: 1rem">
					<h3 style="text-transform: none; margin-bottom: 0.5rem">Configure reCAPTCHA key</h3>
					<a rel="noopener" target="_blank" href="https://g.co/recaptcha/v3">Get the Site Key and Secret Key</a> from Google
				</div>
			</td>
			<tr id="wpp_recaptcha_configs">
				<td class="feature-input">
					<span class="feature-input"></span>
				</td>
				<td>
					<p>
						<label><?php echo __( 'reCAPTCHA v3', 'password-protect-page' ) ?></label>
					</p>
					<span>
					<p>
						<label><?php echo __( 'Site Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_API_KEY; ?>" type="text"
                               value="<?php echo esc_attr( $api_key ); ?>"/>
					</span>
					<p>
						<label><?php echo __( 'Secret Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_API_SECRET; ?>" type="text"
                               value="<?php echo esc_attr( $api_secret ); ?>"/>
					</span>
					<p id="recaptcha-score-container">
						<label><?php echo esc_html__( 'Threshold', 'password-protect-page' ) ?></label>
							Define users' score that will pass reCAPTCHA protection
						<span class="ppw-recaptcha-score">
							<select class="ppw_main_container select"
							        id="<?php echo PPW_Constants::RECAPTCHA_SCORE; ?>">
							  <?php
							  for ( $i = 0; $i <= 10; $i ++ ) {
								  $s        = number_format( ( $i / 10 ), 1 );
								  $selected = (double) $s === $score ? 'selected="selected"' : '';
								  echo '<option value="' . $s . '"' . $selected . '>' . $s . '</option>';
							  }
							  ?>
							</select>
						</span>
					</p>

				</td>
			</tr>
			<tr id="wpp_recaptcha_configs">
				<td class="feature-input">
					<span class="feature-input"></span>
				</td>
				<td>
					<p>
						<label><?php echo __( 'reCAPTCHA v2 - Checkbox', 'password-protect-page' ); ?></label>
					</p>
					<span>
					<p>
						<label><?php echo __( 'Site Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_V2_CHECKBOX_API_KEY; ?>" type="text"
                               value="<?php echo esc_attr( $api_key_v2 ); ?>"/>
					</span>
					<p>
						<label><?php echo esc_html__( 'Secret Key', 'password-protect-page' ) ?></label>
					</p>
					<span>
                        <input id="<?php echo PPW_Constants::RECAPTCHA_V2_CHECKBOX_API_SECRET; ?>" type="text"
                               value="<?php echo esc_attr( $api_secret_v2 ); ?>"/>
					</span>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
				</td>
			</tr>
		</table>
	</form>
</div>
