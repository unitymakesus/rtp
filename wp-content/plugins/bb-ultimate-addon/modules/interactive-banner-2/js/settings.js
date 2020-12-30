(function($){

	FLBuilder.registerModuleHelper('interactive-banner-2', {
		
		rules: {
			banner_image: {
				required: true
			}
		},

        init: function()
        {
            var a = $('.fl-builder-interactive-banner-2-settings').find('.fl-builder-settings-tabs a');
            a.on('click', this._toggleHoverAndTypographyTabs);
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._toggleAfterRender );
        },
        _toggleHoverAndTypographyTabs: function() {
            var anchorHref = $(this).attr('href');
            var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-description' ){
                jQuery('.fl-node-' + node + ' .uabb-new-ib').addClass('uabb-ib2-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-new-ib').removeClass('uabb-ib2-hover');
            }
        },

        _toggleAfterRender: function() {
            
            var anchorHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );
            var node = jQuery( '.fl-builder-settings-tabs a' ).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-description' ){
                jQuery('.fl-node-' + node + ' .uabb-new-ib').addClass('uabb-ib2-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-new-ib').removeClass('uabb-ib2-hover');
            }
        },
	});

})(jQuery);