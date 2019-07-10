(function($){

	FLBuilder.registerModuleHelper('advanced-accordion', {
		_templates: {
			saved_modules: '',
			saved_rows: '',
			page_templates: ''
		},
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
			$('body').delegate( '.fl-builder-settings select[name="content_type"]', 'change', $.proxy(this._contentTypeChange, this) );
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
		_contentTypeChange: function(e)
		{
			var type = $(e.target).val();

			if ( 'saved_modules' === type ) {
				this._setTemplates('saved_modules');
			}
			if ( 'saved_rows' === type ) {
				this._setTemplates('saved_rows');
			}
			if ( 'saved_page_templates' === type ) {
				this._setTemplates('page_templates');
			}
		},
		_getTemplates: function(type, callback)
		{
			if ( 'undefined' === typeof type ) {
				return;
			}

			if ( 'undefined' === typeof callback ) {
				return;
			}
			if ( 'saved_modules' === type ) {
				type = 'module';
			} else if ( 'saved_rows' === type ) {
				type = 'row';
			} else if ( 'page_templates' === type ) {
				type = 'layout';
			}
			var self = this;

			$.post(
				ajaxurl,
				{
					action: 'uabb_get_saved_templates',
					type: type
				},
				function( response ) {
					callback(response);
				}
			);
		},
		_setTemplates: function(type)
		{
			var form = $('.fl-builder-settings'),
					
				select = form.find( 'select[name="ct_' + type + '"]' ),
				value = '', self = this;

			if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {

				if ( "uabb_advAccordion_items_form" === FLBuilderSettingsForms.config.id ) {
					value = FLBuilderSettingsForms.config.settings['ct_' + type];
				}
			}
			if ( this._templates[type] !== '' ) {
				select.html( this._templates[type] );
				select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

				return;
			}

			this._getTemplates(type, function(data) {
				var response = JSON.parse( data );

				if ( response.success ) {
					self._templates[type] = response.data;
					select.html( response.data );
					if ( '' !== value ) {
						select.find( 'option[value="' + value + '"]').attr('selected', 'selected');
					}
				}
			});
		}

	});
})(jQuery);