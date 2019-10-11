(function($){

	FLBuilder.registerModuleHelper('uabb-contact-form7', {

		init: function()
		{

			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]'),
				hover_attribute = form.find('select[name=hover_attribute]'),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]');

			// Init validation events.
			this._btn_styleChanged();
			this._hideDocs();
			// Validation events.
			btn_style.on('change',  $.proxy( this._btn_styleChanged, this ) );
			btn_style_opt.on('change',  $.proxy( this._btn_styleChanged, this ) );
			hover_attribute.on( 'change', $.proxy( this._btn_styleChanged, this ) );
			
		},

		_btn_styleChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]').val(),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]').val(),
				hover_attribute = form.find('select[name=hover_attribute]').val(),
				icon       = form.find('input[name=btn_icon]');
            if( btn_style == '3d' ) {
				form.find("#fl-field-hover_attribute").hide();
				form.find('#fl-field-btn_background_color th label').text('Background Color');
				form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
				form.find("#fl-field-btn_background_hover_color").show();
				form.find("#fl-field-btn_border_size").hide();
            } else if( btn_style == 'flat' ) {
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-btn_background_color th label').text('Background Color');
	            form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
            	form.find("#fl-field-btn_border_size").hide();
            } else if( btn_style == 'transparent' ) {
            	form.find("#fl-field-btn_border_size").show();
            	form.find('#fl-field-btn_background_color th label').text('Border Color');
            	form.find("#fl-field-hover_attribute").show();
            	if( hover_attribute == 'bg' ) {
            		form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
                } else {
            		form.find('#fl-field-btn_background_hover_color th label').text('Border Hover Color');
                }
            } else {
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-btn_background_color th label').text('Background Color');
	            form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
            	form.find("#fl-field-btn_border_size").hide();
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