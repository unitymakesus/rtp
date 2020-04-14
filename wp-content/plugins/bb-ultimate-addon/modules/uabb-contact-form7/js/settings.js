(function($){

	FLBuilder.registerModuleHelper('uabb-contact-form7', {

		init: function()
		{

			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]'),
				hover_attribute = form.find('select[name=hover_attribute]'),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]');
                content_type = form.find('select[name=form_id]');

			// Init validation events.
			this._btn_styleChanged();
			this._hideDocs();
			// Validation events.
			btn_style.on('change',  $.proxy( this._btn_styleChanged, this ) );
			btn_style_opt.on('change',  $.proxy( this._btn_styleChanged, this ) );
			hover_attribute.on( 'change', $.proxy( this._btn_styleChanged, this ) );
            //content_type.on('change', $.proxy( this._contentTypeChange, this ) );
            this._contentTypeChange();

            form.find("#fl-field-cf_form_raw_nonce").hide();
			
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
        },
        _getTemplates: function( callback ) {
            var form = $('.fl-builder-settings');
            nonce = form.find( '#fl-field-cf7_form_raw .uabb-module-raw' ).data( 'uabb-module-nonce' );
            if ( 'undefined' === typeof nonce ) {
                nonce     = form.find('input[name=cf_form_raw_nonce]').val();
            }
            $.post(
                ajaxurl,
                {
                    action: 'uabb_get_saved_cf7',
                    nonce:nonce,
                },
                function( response ) {
                    callback(response);
                }
            );

        },
        _contentTypeChange: function() {

            var form = $('.fl-builder-settings');
            select = form.find( 'select[name="form_id"]' );
            value = ''; self = this;

            if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {
                if ( "uabb-contact-form7" === FLBuilderSettingsForms.config.id ) {
                    value = FLBuilderSettingsForms.config.settings['form_id'];
                }
            }

            select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

            this._getTemplates( function(data) {
                var response = data;

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