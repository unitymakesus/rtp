(function($){

	FLBuilder.registerModuleHelper('uabb-wp-forms-styler', {

		init: function()
		{

			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]'),
				hover_attribute = form.find('select[name=hover_attribute]'),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]');
                content_type = form.find('select[name=wp_form_id]');

			// Init validation events.
			this._btn_styleChanged();
			this._hideDocs();
			// Validation events.
			btn_style.on('change',  $.proxy( this._btn_styleChanged, this ) );
			btn_style_opt.on('change',  $.proxy( this._btn_styleChanged, this ) );
			hover_attribute.on( 'change', $.proxy( this._btn_styleChanged, this ) );

            this._contentTypeChange();

		},

		_btn_styleChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]').val(),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]').val(),
				hover_attribute = form.find('select[name=hover_attribute]').val(),
				icon       = form.find('input[name=btn_icon]');
             if( 'flat' === btn_style) {
            	form.find("#fl-field-hover_attribute").hide();
							form.find("#fl-field-btn_background_color").show();
            	form.find('#fl-field-btn_background_color th label').text('Background Color');
	            form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
							form.find("#fl-field-border_color").hide();
            	form.find("#fl-field-btn_border_size").hide();
            } else if( 'transparent' === btn_style  ) {
            	form.find("#fl-field-btn_border_size").show();
							form.find('#fl-field-btn_background_color th label').text('Border Color');
            	form.find("#fl-field-hover_attribute").show();

            	if( 'bg' === hover_attribute ) {
            		form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
                } else {
            		form.find('#fl-field-btn_background_hover_color th label').text('Border Hover Color');
                }
            } else if( 'default' === btn_style ) {
                form.find("#fl-field-btn_background_color").show();
            } else {
            	form.find("#fl-field-hover_attribute").hide();
							form.find("#fl-field-btn_background_color").hide();
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
        },
        _getTemplates: function( callback ) {

            $.post(
                ajaxurl,
                {
                    action: 'uabb_get_saved_wpform',
                },
                function( response ) {
                    callback(response);
                }
            );

        },
        _contentTypeChange: function() {

            var form = $('.fl-builder-settings');
            select = form.find( 'select[name="wp_form_id"]' );
            value = ''; self = this;

            if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {
                if ( "uabb-wp-forms-styler" === FLBuilderSettingsForms.config.id ) {
                    value = FLBuilderSettingsForms.config.settings['wp_form_id'];
                }
            }

            select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

            this._getTemplates( function(data) {
                var response = JSON.parse( data );

                if ( response.success ) {

                    select.html( response.data );

                    if ( '' !== value ) {

                        select.find( 'option[value="' + value + '"]').attr( 'selected', 'selected' );

                    } else {

                        option_val = select.find( 'option:first' ).val();

                        select.find("option[value=" + option_val +"]").attr('selected', true);
                    }
                }
            });
        }
	});

})(jQuery);
