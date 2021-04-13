( function( $ ) {

	FLBuilder.registerModuleHelper( 'uabb-search', {

		init: function()
		{
			var form = $( '.fl-builder-settings' ),
				btn_style   = form.find('select[name=btn_style]'),
				display     = form.find('select[name=display]');

			UABBButton.init();
			this._hideDocs();
			btn_style.on('change', this._btn_style_changed );
			display.on('change', this._display_changed );
			this._btn_style_changed();
			this._display_changed();
		},
		_display_changed: function() {

            var form    = $('.fl-builder-settings');
			display = form.find( 'select[name=display]' ).val();
			btn_action = form.find( 'select[name=btn_action]' ).val();

			if ( 'button' === display ) {
				if ( 'expand' === btn_action ) {
					form.find("#fl-field-expand_position").show();
					form.find("#fl-builder-settings-section-fullscreen_style").hide();
				} else if ( 'fullscreen' === btn_action ) {
					form.find("#fl-field-expand_position").hide();
					form.find("#fl-builder-settings-section-fullscreen_style").show();
				}
			} else if ( 'button' !== display ) {
				form.find("#fl-field-expand_position").hide();
				form.find("#fl-builder-settings-section-fullscreen_style").hide();
			}
            
		},
		_btn_style_changed: function() {

            var form    = $('.fl-builder-settings');
            icon = form.find( 'input[name=btn_icon]' );
            btn_icon = form.find( 'input[name=btn_icon]' ).val();


            if ( 0 === btn_icon.length ) {
                icon.rules('remove');
            }
		},
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
