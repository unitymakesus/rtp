(function($){
	FLBuilder.registerModuleHelper('uabb-woo-add-to-cart', {

		init: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=style]');

			// Init validation events.
			this._btn_styleChanges();
			this._hideDocs();
			// Validation events.
			btn_style.on('change',  $.proxy( this._btn_styleChanges, this ) );
		},

		_btn_styleChanges: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=style]').val();
				
			if( btn_style == 'transparent' ) {
            	form.find('#fl-field-bg_color th label').text('Border Color');
            } else {
            	form.find('#fl-field-bg_color th label').text('Background Color');
            }
		},
		/**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.14.0
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