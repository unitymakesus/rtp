(function($){

	FLBuilder.registerModuleHelper('uabb-caldera-form-styler', {

		init: function()
		{
            var form = $('.fl-builder-settings');
            this._hideSettings();
			this._calderaForms();
            this._hideDocs();
            form.find("#fl-field-caf_form_raw_nonce").hide();
            form.find( 'select[name="caf_form_id"]' ).on('change',this._hideSettings);
		},
		_getTemplates: function( callback ) {

            var form = $('.fl-builder-settings');
            nonce = form.find( '#fl-field-caf_form_raw .uabb-module-raw' ).data( 'uabb-module-nonce' );

            if ( 'undefined' === typeof nonce ) {
                nonce     = form.find('input[name=caf_form_raw_nonce]').val();
            }
            $.post(
                ajaxurl,
                {
                    action: 'uabb_get_saved_caf',
                    nonce: nonce,
                },
                function( response ) {
                    callback(response);
                }
            );

        },
		_calderaForms: function()
		{
			 var form = $('.fl-builder-settings');
             select = form.find( 'select[name="caf_form_id"]' );
             value = ''; self = this;

            if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {
                if ( "uabb-caldera-form-styler" === FLBuilderSettingsForms.config.id ) {
                    value = FLBuilderSettingsForms.config.settings['caf_form_id'];
                }
            }

            select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

            this._getTemplates( function(data) {

            	var response =  data;

	            if ( response.success ) {

	                select.html( response.data );

	                if ( '' !== value && '0' !== value ) {

                        select.find( 'option[value="' + value + '"]').attr( 'selected', 'selected' );
                        form.find( '#fl-builder-settings-section-form_section' ).show();

                        if ( 'yes' === form.find( 'select[name="caf_custom_desc"]' ).val() ) {
                            form.find( '#fl-field-caf_title_desc_align' ).show();
                            form.find( '#fl-builder-settings-section-form_title_typography' ).show();
                            form.find( '#fl-builder-settings-section-form_desc_typography' ).show();
                        }
	                } else {

	                    option_val = select.find( 'option:first' ).val();

	                    select.find("option[value=" + option_val +"]").attr('selected', true);
	                }
	            }
        	});

		},
        _hideSettings: function() {
            var form            = $('.fl-builder-settings'),
                value = form.find( 'select[name="caf_form_id"]' ).val();

            if ( '0' === value || null === value ) {
                form.find( '#fl-builder-settings-section-form_section' ).hide();
                form.find( '#fl-field-caf_title_desc_align' ).hide();
                form.find( '#fl-builder-settings-section-form_title_typography' ).hide();
                form.find( '#fl-builder-settings-section-form_desc_typography' ).hide();
            } else {
                form.find( '#fl-builder-settings-section-form_section' ).show();

                if ( 'yes' === form.find( 'select[name="caf_custom_desc"]' ).val() ) {
                    form.find( '#fl-field-caf_title_desc_align' ).show();
                    form.find( '#fl-builder-settings-section-form_title_typography' ).show();
                    form.find( '#fl-builder-settings-section-form_desc_typography' ).show();
                }
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