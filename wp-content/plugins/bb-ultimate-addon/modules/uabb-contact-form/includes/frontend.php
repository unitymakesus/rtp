<?php
/**
 *  UABB Contact Form Module front-end file
 *
 *  @package UABB Contact Form Module
 */

?>

<?php
	$count         = 0;
	$name_class    = '';
	$email_class   = '';
	$subject_class = '';
	$phone_class   = '';
	$msg_class     = '';
	$message       = __( 'Please accept the Terms and Conditions to proceed.', 'uabb' );

if ( 'show' == $settings->name_toggle && '50' == $settings->name_width ) {
	$count      = ++$count;
	$name_class = ' uabb-name-inline uabb-inline-group';
	if ( 0 == $count % 2 ) {
		$name_class .= ' uabb-io-padding-left';
	} else {
		$name_class .= ' uabb-io-padding-right';
	}
}

if ( 'show' == $settings->email_toggle && '50' == $settings->email_width ) {
	$count       = ++$count;
	$email_class = ' uabb-email-inline uabb-inline-group';
	if ( 0 == $count % 2 ) {
		$email_class .= ' uabb-io-padding-left';
	} else {
		$email_class .= ' uabb-io-padding-right';
	}
}

if ( 'show' == $settings->subject_toggle && '50' == $settings->subject_width ) {
	$count         = ++$count;
	$subject_class = ' uabb-subject-inline uabb-inline-group';
	if ( 0 == $count % 2 ) {
		$subject_class .= ' uabb-io-padding-left';
	} else {
		$subject_class .= ' uabb-io-padding-right';
	}
}

if ( 'show' == $settings->phone_toggle && '50' == $settings->phone_width ) {
	$count       = ++$count;
	$phone_class = ' uabb-phone-inline uabb-inline-group';
	if ( 0 == $count % 2 ) {
		$phone_class .= ' uabb-io-padding-left';
	} else {
		$phone_class .= ' uabb-io-padding-right';
	}
}

if ( 'show' == $settings->msg_toggle && '50' == $settings->msg_width ) {
	$count     = ++$count;
	$msg_class = ' uabb-message-inline uabb-inline-group';
	if ( 0 == $count % 2 ) {
		$msg_class .= ' uabb-io-padding-left';
	} else {
		$msg_class .= ' uabb-io-padding-right';
	}
}
?>

<form class="uabb-module-content uabb-contact-form <?php echo 'uabb-form-' . $settings->form_style; ?>"
	<?php
	if ( isset( $module->template_id ) ) {
		echo 'data-template-id="' . $module->template_id . '" data-template-node-id="' . $module->template_node_id . '"';}
	?>
>
	<div class="uabb-input-group-wrap">
	<?php if ( 'show' == $settings->name_toggle ) : ?>
	<div class="uabb-input-group uabb-name <?php echo $name_class; ?>">
		<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
		<label for="uabb-name"><?php echo $settings->name_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="text" name="uabb-name" value=""
			<?php
			if ( 'yes' == $settings->enable_placeholder ) {
				?>
				placeholder="<?php echo $settings->name_placeholder; ?>" <?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( 'show' == $settings->email_toggle ) : ?>
	<div class="uabb-input-group uabb-email <?php echo $email_class; ?>">
		<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
		<label for="uabb-email"><?php echo $settings->email_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="email" name="uabb-email" value=""
			<?php
			if ( 'yes' == $settings->enable_placeholder ) {
				?>
				placeholder="<?php echo $settings->email_placeholder; ?>"<?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"><span><?php _e( 'Invalid Email', 'uabb' ); ?></span></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( 'show' == $settings->subject_toggle ) : ?>
	<div class="uabb-input-group uabb-subject <?php echo $subject_class; ?>">
		<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
		<label for="uabb-subject"><?php echo $settings->subject_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="text" name="uabb-subject" value=""
			<?php
			if ( 'yes' == $settings->enable_placeholder ) {
				?>
				placeholder="<?php echo $settings->subject_placeholder; ?>"<?php } ?>/>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>


	<?php if ( 'show' == $settings->phone_toggle ) : ?>
	<div class="uabb-input-group uabb-phone <?php echo $phone_class; ?>">
		<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
		<label for="uabb-phone"><?php echo $settings->phone_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter">
			<input type="tel" name="uabb-phone" value=""
			<?php
			if ( 'yes' == $settings->enable_placeholder ) {
				?>
				placeholder="<?php echo $settings->phone_placeholder; ?>"<?php } ?> />
			<div class="uabb-form-error-message uabb-form-error-message-required"><span><?php _e( 'Invalid Number', 'uabb' ); ?></span></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( 'show' == $settings->msg_toggle ) : ?>
	<div class="uabb-input-group uabb-message <?php echo $msg_class; ?>">
		<?php if ( 'style1' == $settings->form_style && 'yes' == $settings->enable_label ) { ?>
		<label for="uabb-message"><?php echo $settings->msg_label; ?></label>
		<?php } ?>
		<div class="uabb-form-outter-textarea">
			<textarea name="uabb-message"
			<?php
			if ( 'yes' == $settings->enable_placeholder ) {
				?>
				placeholder="<?php echo $settings->msg_placeholder; ?>"<?php } ?>></textarea>
			<div class="uabb-form-error-message uabb-form-error-message-required"></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ( 'show' == $settings->terms_checkbox ) : ?>
		<div class="uabb-input-group uabb-terms-checkbox">
			<?php if ( isset( $settings->terms_text ) && ! empty( $settings->terms_text ) ) : ?>
				<div class="uabb-terms-text"><?php echo $settings->terms_text; ?></div>
			<?php endif; ?>
			<div class="uabb-form-outter">
				<label class="uabb-terms-label" for="uabb-terms-checkbox-<?php echo $id; ?>">
					<input type="checkbox" class="checkbox-inline" id="uabb-terms-checkbox-<?php echo $id; ?>" name="uabb-terms-checkbox" value="1" />
					<span class="checkbox-label">
						<?php echo $settings->terms_checkbox_text; ?>
					</span>
				</label>
			</div>
			<label class="uabb-contact-error"><?php echo apply_filters( 'uabb_contact_form_error_message', $message ); ?></label>
		</div>
	<?php endif; ?>

	<?php
	if ( 'show' == $settings->uabb_recaptcha_toggle && ( isset( $settings->uabb_recaptcha_site_key ) && ! empty( $settings->uabb_recaptcha_site_key ) ) ) :
		?>
	<div class="uabb-input-group uabb-recaptcha">
		<span class="uabb-contact-error"><?php _e( 'Please check the captcha to verify you are not a robot.', 'uabb' ); ?></span>
		<div id="<?php echo $id; ?>-uabb-grecaptcha" class="uabb-grecaptcha" data-sitekey="<?php echo $settings->uabb_recaptcha_site_key; ?>" data-theme="<?php echo $settings->uabb_recaptcha_theme; ?>"></div>
	</div>
	<?php endif; ?>

	</div>

	<div class="uabb-submit-btn">
		<div class="uabb-contact-form-button" data-wait-text="<?php echo $settings->btn_processing_text; ?>">
			<button type="submit" class="uabb-contact-form-submit">
			<?php
			if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
				echo ( '' != $settings->btn_icon && 'before' == $settings->btn_icon_position ) ? '<i class="' . $settings->btn_icon . '"></i>' : ''; }
			?>
			<span class="uabb-contact-form-button-text"><?php echo $settings->btn_text; ?></span>
			<?php
			if ( isset( $settings->btn_icon ) && isset( $settings->btn_icon_position ) ) {
				echo ( '' != $settings->btn_icon && 'after' == $settings->btn_icon_position ) ? '<i class="' . $settings->btn_icon . '"></i>' : ''; }
			?>
</button>
		</div>
	</div>
	<?php if ( 'redirect' == $settings->success_action ) : ?>
		<input type="text" value="<?php echo $settings->success_url; ?>" style="display: none;" class="uabb-success-url">
	<?php elseif ( 'none' == $settings->success_action ) : ?>
		<span class="uabb-success-none" style="display:none;"><?php echo $settings->email_sccess; ?></span>
	<?php endif; ?>
	<span class="uabb-send-error" style="display:none;"><?php echo $settings->email_error; ?></span>

</form>
<?php if ( 'show_message' == $settings->success_action ) : ?>
	<span class="uabb-success-msg uabb-text-editor" style="display:none;"><?php echo $settings->success_message; ?></span>
<?php endif; ?>
