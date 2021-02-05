<?php
/**
 *  UABB Subscribe Form Module front-end file
 *
 *  @package UABB Subscribe Form Module
 */

if ( defined( 'FL_BUILDER_VERSION' ) ) {
	$p    = '#(\.0+)+($|-)#';
	$ver1 = preg_replace( $p, '', FL_BUILDER_VERSION );
	$ver2 = preg_replace( $p, '', '1.8.4' );

	// This is created to generate random numbers in the saved module.
	$random_id = $id . '_' . wp_rand();

	if ( version_compare( $ver1, $ver2 ) < 0 ) {
		?>
	<div class='uabb-mailchimp-version-error'>
		<span><?php esc_attr_e( 'Subscribe Form requires Beaver Builder versions above 1.8.4. Make sure you use latest Beaver Builder to view best results.', 'uabb' ); ?></span>.
	</div>
		<?php
	} else {
		?>
		<div class="uabb-module-content uabb-subscribe-form uabb-subscribe-form-<?php echo esc_attr( $settings->layout ); ?> uabb-sf-style-<?php echo esc_attr( $settings->form_style ); ?> uabb-form fl-clearfix" 
																					<?php
																					if ( isset( $module->template_id ) ) {
																						echo 'data-template-id="' . esc_attr( $module->template_id ) . '" data-template-node-id="' . esc_attr( $module->template_node_id ) . '"';}
																					?>
		>

			<div class="uabb-head-wrap">
			<?php if ( ! empty( $settings->heading ) ) { ?>
				<<?php echo esc_attr( $settings->heading_tag_selection ); ?> class="uabb-sf-heading"><?php echo $settings->heading; ?></<?php echo esc_attr( $settings->heading_tag_selection ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<?php } if ( ! empty( $settings->subheading ) ) { ?>
				<<?php echo esc_attr( $settings->subheading_tag_selection ); ?> class="uabb-sf-subheading"><?php echo $settings->subheading; ?></<?php echo esc_attr( $settings->subheading_tag_selection ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<?php } ?>
			</div>

			<div class="uabb-form-wrap fl-clearfix" data-nonce=<?php echo wp_kses_post( wp_create_nonce( 'uabb-sub-form-nonce' ) ); ?>>

				<?php
				if ( 'yes' === $settings->show_fname ) :
					?>
					<div class="uabb-form-field">
					<input type="text" name="uabb-subscribe-form-fname"  id="uabb-subscribe-form-fname" aria-label="fname" placeholder="<?php echo ( 'style2' !== $settings->form_style ) ? ( ( '' !== $settings->fname_label ) ? $settings->fname_label : __( 'Your Name', 'uabb' ) ) : '';  //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
					<?php
					if ( 'style2' === $settings->form_style ) {
						?>
					<label for="uabb-subscribe-form-fname"><?php echo ( '' !== $settings->fname_label ) ? $settings->fname_label : __( 'Your Name', 'uabb' ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label>
						<?php
					}
					?>
					<div class="uabb-form-error-message">!</div>
				</div><?php endif; ?><!-- Inline Block Space Fix 

				-->
				<?php
				if ( 'yes' === $settings->show_lname ) :
					?>
					<div class="uabb-form-field">
					<input type="text" name="uabb-subscribe-form-lname" id="uabb-subscribe-form-lname" aria-label="lname" placeholder="<?php echo ( 'style2' !== $settings->form_style ) ? ( ( '' !== $settings->lname_label ) ? $settings->lname_label : __( 'Last Name', 'uabb' ) ) : '';  //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
					<?php
					if ( 'style2' === $settings->form_style ) {
						?>
					<label for="uabb-subscribe-form-lname"><?php echo ( '' !== $settings->lname_label ) ? $settings->lname_label : __( 'Last Name', 'uabb' ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label>
						<?php
					}
					?>
					<div class="uabb-form-error-message">!</div>
				</div><?php endif; ?><!-- Inline Block Space Fix

				--><div class="uabb-form-field">
					<input type="email" name="uabb-subscribe-form-email" aria-label="email" placeholder="<?php echo ( 'style2' !== $settings->form_style ) ? ( ( '' !== $settings->email_placeholder ) ? $settings->email_placeholder : __( 'Your Email', 'uabb' ) ) : '';  //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
					<?php
					if ( 'style2' === $settings->form_style ) {
						?>
					<label for="uabb-subscribe-form-email"><?php echo ( '' !== $settings->email_placeholder ) ? $settings->email_placeholder : __( 'Your Email', 'uabb' ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label>
						<?php
					}
					?>
					<div class="uabb-form-error-message">!</div>
				</div><!-- Inline Block Space Fix	
				--><?php if ( 'stacked' === $settings->layout ) : ?>
					<?php if ( 'show' === $settings->terms_checkbox ) : ?>
						<div class="uabb-form-field uabb-input-group uabb-terms-checkbox">
							<?php if ( isset( $settings->terms_text ) && ! empty( $settings->terms_text ) ) : ?>
								<div class="uabb-terms-text"><?php echo $settings->terms_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
							<?php endif; ?>
							<div class="uabb-terms-wrap">
								<label class="uabb-terms-label" for="uabb-terms-checkbox-<?php echo esc_attr( $random_id ); ?>">
									<input type="checkbox" id="uabb-terms-checkbox-<?php echo esc_attr( $random_id ); ?>" aria-label="checkbox" name="uabb-terms-checkbox" value="1" />
									<span class="terms-checkbox">
										<?php echo $settings->terms_checkbox_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</span>
								</label>
								<span class="uabb-form-error-message"><?php esc_html_e( 'Terms and Conditions checkbox is required.', 'uabb' ); ?></span>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?><!-- Inline Block Space Fix	
				--><div class="uabb-form-button" data-wait-text="<?php echo $settings->btn_processing_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
				<?php
				$resp_overall_alignment = 'default' !== $settings->resp_overall_alignment ? $settings->resp_overall_alignment : $settings->overall_alignment;
				$btn_settings           = array(

					'text'                       => $settings->btn_text,
					'icon'                       => $settings->btn_icon,
					'icon_position'              => $settings->btn_icon_position,
					'style'                      => $settings->btn_style,
					'transparent_button_options' => $settings->btn_transparent_button_options,
					'threed_button_options'      => $settings->btn_threed_button_options,
					'flat_button_options'        => $settings->btn_flat_button_options,
					'width'                      => $settings->btn_width,
					'custom_width'               => $settings->btn_custom_width,
					'custom_height'              => $settings->btn_custom_height,
					'align'                      => $settings->overall_alignment,
					'mob_align'                  => $resp_overall_alignment,
				);
				FLBuilder::render_module_html( 'uabb-button', $btn_settings );
				?>
				</div>

			</div>
			<?php if ( 'inline' === $settings->layout ) : ?>
				<?php if ( 'show' === $settings->terms_checkbox ) : ?>
					<div class="uabb-form-field uabb-input-group uabb-terms-checkbox">
						<?php if ( isset( $settings->terms_text ) && ! empty( $settings->terms_text ) ) : ?>
							<div class="uabb-terms-text"><?php echo $settings->terms_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<?php endif; ?>
						<div class="uabb-terms-wrap">
							<label class="uabb-terms-label" for="uabb-terms-checkbox-<?php echo esc_attr( $random_id ); ?>">
								<input type="checkbox" id="uabb-terms-checkbox-<?php echo esc_attr( $random_id ); ?>" aria-label="checkbox" name="uabb-terms-checkbox" value="1" />
								<span class="terms-checkbox">
									<?php echo $settings->terms_checkbox_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							</label>
							<span class="uabb-form-error-message"><?php esc_html_e( 'Terms and Conditions checkbox is required.', 'uabb' ); ?></span>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			if ( '' !== $settings->bottom_text ) {
				?>
			<div class="uabb-sf-bottom-text uabb-text-editor"><?php echo $settings->bottom_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<?php
			}
			?>
			<div class="uabb-form-error-message"><?php esc_html_e( 'Something went wrong. Please check your entries and try again.', 'uabb' ); ?></div>
		</div>
		<?php
	}
}
?>
