(function($){
	FLBuilder.registerModuleHelper('uabb-login-form', {

		init: function()
		{	
			var form    	= $('.fl-builder-settings'),
			google_login_select	= form.find('select[name="google_login_select"]');
			facebook_login_select	= form.find('select[name="facebook_login_select"]');
			this._socialSelectStyling();
			google_login_select.on('change', $.proxy( this._socialSelectStyling, this ) ) ;
			facebook_login_select.on('change', $.proxy( this._socialSelectStyling, this ) ) ;
			this._hideDocs();
		},
		
		_socialSelectStyling: function() {
			var form		= $('.fl-builder-settings'),
			facebook_login_select	= form.find('select[name="facebook_login_select"]');
			google_login_select	= form.find('select[name="google_login_select"]');
			social_styling_section = form.find('#fl-builder-settings-section-socail_styling');
			if ( typeof google_login_select.val() !== 'undefined' && typeof facebook_login_select.val() !== 'undefined' ) {
				social_styling_section.show();
				if ( 'no' === google_login_select.val() && 'no' === facebook_login_select.val() ) {
					social_styling_section.hide();
				} 
			}
		},
		/**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.24.0
        */
        _hideDocs: function() {
            var form            = $('.fl-builder-settings'),
            branding_selector   = form.find('#fl-field-uabb_helpful_information .uabb-docs-list');
            settings_tab        = form.find('.fl-builder-settings-tabs');
            get_anchor          =  settings_tab.find('a');

            $( get_anchor ).each(function() {

                if ( '#fl-builder-settings-tab-uabb_docs' === $(this) .attr('href') ) {

                    if ( 'yes' === branding_selector.data('branding') ) {
                        $( this ).hide();
                    } else {
                        $( this ).show();
                    }
                }
            });
        }
	});
})(jQuery);
