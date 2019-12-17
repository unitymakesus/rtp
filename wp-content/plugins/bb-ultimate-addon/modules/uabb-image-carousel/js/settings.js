(function($){

	FLBuilder.registerModuleHelper('uabb-image-carousel', {

		init: function() {
			this._hideDocs();
		},

		/**
	 	 * When Branding is enabled, hide the Docs Tab in the Modules editor.
	 	 *
	 	 * @since 1.16.0
	 	 */
		_hideDocs: function() {
			var form            = $('.fl-builder-settings'),
            branding_selector   = form.find('#fl-field-uabb_helpful_information .uabb-docs-list');
            settings_tab        = form.find('.fl-builder-settings-tabs');
            get_anchor          = settings_tab.find('a');

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