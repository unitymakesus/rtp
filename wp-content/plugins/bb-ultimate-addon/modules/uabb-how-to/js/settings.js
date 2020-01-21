( function( $ ){
	FLBuilder.registerModuleHelper( 'uabb-how-to', {

		init: function()
		{	
			var form    	= $( '.fl-builder-settings' );
			save_button = form.find( '.fl-builder-settings-save' );
			save_button.off( 'click' ).on( 'click', this._submit );
			this._hideDocs();
		},
		
		_submit: function() {
			var form		= $( '.fl-builder-settings' );
			title   = form.find( 'input[ name=uabb_how_to_title ]' ).val();

			if ( 0 === title.length ) {
				FLBuilder.alert( 'Title field is required' );
				return false;
			}
			
		},
		/**
	 	 * Branding is on hide the Docs Tab.
	 	 *
	 	 * @since 1.16.0
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