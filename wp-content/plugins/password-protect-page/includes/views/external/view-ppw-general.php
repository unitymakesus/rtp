<?php
$using_recaptcha = PPW_Recaptcha::get_instance()->using_recaptcha() ? 'checked' : '';
$recaptcha_type  = PPW_Recaptcha::get_instance()->get_recaptcha_type();
$type_options    = array(
	PPW_Recaptcha::RECAPTCHA_V3_TYPE          => __( 'reCAPTCHA v3', 'password-protect-page' ),
	PPW_Recaptcha::RECAPTCHA_V2_CHECKBOX_TYPE => __( 'reCAPTCHA v2 - Checkbox', 'password-protect-page' ),
);

?>
<div class="ppw_main_container" id="ppw_shortcodes_form">
	<form id="wpp_external_form" method="post">
		<input type="hidden" id="ppw_general_form_nonce"
		       value="<?php echo wp_create_nonce( PPW_Constants::GENERAL_FORM_NONCE ); ?>"/>
		<table class="ppwp_settings_table" cellpadding="4">
			<tr>
				<td>
					<label class="pda_switch" for="<?php echo PPW_Constants::USING_RECAPTCHA; ?>">
						<input type="checkbox"
						       id="<?php echo PPW_Constants::USING_RECAPTCHA; ?>" <?php echo $using_recaptcha; ?>>
						<span class="pda-slider round"></span>
					</label>
				</td>
				<td>
					<p style="margin-bottom: 6px;">
						<label><?php _e( 'Enable Google reCAPTCHA Protection', 'password-protect-page' ) ?></label>
						<a rel="noopener" target="_blank" href="https://passwordprotectwp.com/docs/add-google-recaptcha-wordpress-password-form/">Protect
							your password form</a> from abuse and spam while allowing real user access only
					</p>
					<select
							class="ppw_main_container select"
							id="wpp_recaptcha_type"
						<?php echo $using_recaptcha ? '' : 'style="display: none"'; ?>
					>
						<?php
						foreach ( $type_options as $key => $value ) {
							$selected = $key === $recaptcha_type ? 'selected="selected"' : '';
							echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
						}
						?>
						<option value="recaptcha_v2_invisible"
						        disabled><?php echo __( 'reCAPTCHA v2 - Invisible', 'password-protect-page' ); ?></option>
					</select>
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
