(function($){

    FLBuilder.registerModuleHelper('ihover', {

        init: function()
        {
            var a = $('.fl-builder-ihover-settings').find('.fl-builder-settings-tabs a');
            a.on('click', this._toggleHoverAndTypographyTabs);
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._toggleAfterRender );
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
    });

    FLBuilder.registerModuleHelper('ihover_item_form', {
        
        rules: {
            photo: {
                required: true
            }
        },  
    });

})(jQuery);
