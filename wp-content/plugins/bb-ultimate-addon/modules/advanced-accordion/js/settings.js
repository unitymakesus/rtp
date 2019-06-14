(function($){

	FLBuilder.registerModuleHelper('advanced-accordion', {

		init: function()
		{
			var form            = $('.fl-builder-settings'),
				node			= '.fl-node-' + form.data('node'),
				contentTab      = form.find('.fl-builder-settings-tabs a'),
				formButton		= form.find('.fl-lightbox-footer span'),
				flag 			= false,
				enable_first_data = $(node + ' .uabb-adv-accordion').data('enable_first');

			if ( enable_first_data == 'no' ) {
				contentTab.on( 'click', this._previewContentTab );
				formButton.on( 'click', this._formButton );
				$( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._previewRenderContentTab );
			}
		},
		
		_previewContentTab: function()
		{	
			var form    = $('.fl-builder-settings'),
				node	= '.fl-node-' + form.data('node'),
				button 	= $(  node + ' .uabb-adv-accordion-button'),
				flag	= button.eq(0).parent('.uabb-adv-accordion-item').hasClass('uabb-adv-accordion-item-active');

				//console.log( flag );
			if ( $(this).attr("href") == '#fl-builder-settings-tab-acc_content_style') {
				if ( !flag ) {
					button[0].click();
				}
			}else{
				if ( flag ) {
					button[0].click();
				}
			};
		},
		_previewRenderContentTab: function() 
		{
			var active_tab = jQuery('.fl-builder-settings-tabs a.fl-active');

		    var form    = $('.fl-builder-settings'),
			node	= '.fl-node-' + form.data('node'),
			button 	= $(  node + ' .uabb-adv-accordion-button'),
			flag	= button.eq(0).parent('.uabb-adv-accordion-item').hasClass('uabb-adv-accordion-item-active');

			if( active_tab.attr('href') == '#fl-builder-settings-tab-acc_content_style' ) {
				if ( !flag ) {
					//button.eq(0).trigger('click');
					//alert();
					setTimeout(function() {
                    	button[0].click();
                    	//console.log( button[0].click() );
                    }, 500);
					//console.log( 'in d flag' + flag );
				}
			}else{
				if ( flag ) {
					button[0].click();
				}
			};
		},
		_formButton: function() 
		{
		    var form    = $('.fl-builder-settings'),
				node	= '.fl-node-' + form.data('node'),
				button 	= $(  node + ' .uabb-adv-accordion-button'),
				flag	= button.eq(0).parent('.uabb-adv-accordion-item').hasClass('uabb-adv-accordion-item-active');

		    if( $(this).hasClass('fl-builder-settings-cancel') ){
		        
		        if ( flag ) {
					button[0].click();
				}
		    }
		},

	});
})(jQuery);