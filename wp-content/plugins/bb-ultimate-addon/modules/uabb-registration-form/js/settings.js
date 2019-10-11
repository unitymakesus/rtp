(function($){

	FLBuilder.registerModuleHelper('uabb-registration-form', {

		init: function()
		{
			var form	= $('.fl-builder-settings');
			enable_recaptcha = form.find('select[name=uabb_recaptcha_toggle]');
			enable_recaptcha.on('change',this.enable_recaptcha );
			form.find('select[name=uabb_recaptcha_version]').on('change',this.enable_recaptcha );
			this.enable_recaptcha();		
		},
		enable_recaptcha: function() {

			var form	= $( '.fl-builder-settings' );

			if ( 'show' === form.find('select[name=uabb_recaptcha_toggle]').val() ) {

				form.find('#fl-field-uabb_recaptcha_version').show();

				if ( 'v2' === form.find( 'select[name=uabb_recaptcha_version]' ).val() ) {

					form.find( '#fl-field-uabb_recaptcha_site_key' ).show();
					form.find( '#fl-field-uabb_recaptcha_secret_key' ).show();
					form.find( '#fl-field-uabb_recaptcha_theme' ).show();
					form.find( '#fl-field-uabb_badge_position' ).hide();
					form.find( '#fl-field-uabb_v3_recaptcha_site_key' ).hide();
					form.find( '#fl-field-uabb_v3_recaptcha_secret_key' ).hide();
					form.find( '#fl-field-uabb_v3_recaptcha_score' ).hide();
				}
				else {

					form.find( '#fl-field-uabb_badge_position' ).show();
					form.find( '#fl-field-uabb_v3_recaptcha_site_key' ).show();
					form.find( '#fl-field-uabb_v3_recaptcha_secret_key' ).show();
					form.find( '#fl-field-uabb_v3_recaptcha_score' ).show();
					form.find( '#fl-field-uabb_recaptcha_theme' ).show();
					form.find( '#fl-field-uabb_recaptcha_site_key' ).hide();
					form.find( '#fl-field-uabb_recaptcha_secret_key' ).hide();
					form.find( '#fl-field-uabb_recaptcha_theme' ).show();

				}
			} else {
				form.find('#fl-field-uabb_recaptcha_version').hide();
				form.find( '#fl-field-uabb_badge_position' ).hide();
				form.find( '#fl-field-uabb_v3_recaptcha_site_key' ).hide();
				form.find( '#fl-field-uabb_v3_recaptcha_secret_key' ).hide();
				form.find( '#fl-field-uabb_v3_recaptcha_score' ).hide();
				form.find( '#fl-field-uabb_recaptcha_theme' ).hide();
				form.find( '#fl-field-uabb_recaptcha_site_key' ).hide();
				form.find( '#fl-field-uabb_recaptcha_secret_key' ).hide();
				form.find( '#fl-field-uabb_recaptcha_theme' ).hide();
			}
		}
	});
})(jQuery);