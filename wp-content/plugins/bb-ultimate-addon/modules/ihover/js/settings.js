(function($){

    FLBuilder.registerModuleHelper('ihover', {

        init: function()
        {
            var a = $('.fl-builder-ihover-settings').find('.fl-builder-settings-tabs a');
            a.on('click', this._toggleHoverAndTypographyTabs);
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._toggleAfterRender );

            this._hideDocs();
        },

        _toggleHoverAndTypographyTabs: function() {
            var anchorHref = $(this).attr('href');
            var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-hover' || anchorHref == '#fl-builder-settings-tab-typography' ){
                jQuery('.fl-node-' + node + ' .uabb-ih-item').addClass('uabb-ih-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-ih-item').removeClass('uabb-ih-hover');
            }
        },

        _toggleAfterRender: function() {
            
            var anchorHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );
            var node = jQuery( '.fl-builder-settings-tabs a' ).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-hover' || anchorHref == '#fl-builder-settings-tab-typography' ){
                jQuery('.fl-node-' + node + ' .uabb-ih-item').addClass('uabb-ih-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-ih-item').removeClass('uabb-ih-hover');
            }
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

    FLBuilder.registerModuleHelper('ihover_item_form', {
        
        rules: {
            photo: {
                required: true
            }
        },  
    });

})(jQuery);
