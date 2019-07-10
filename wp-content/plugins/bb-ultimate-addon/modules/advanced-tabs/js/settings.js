(function($){

	FLBuilder.registerModuleHelper('advanced-tabs', {
		_templates: {
			saved_modules: '',
			saved_rows: '',
			page_templates: ''
		},
		init: function()
		{
			var form    	= $('.fl-builder-settings'),
				icon_style = form.find('select[name=show_icon]'),
				style 	= form.find('select[name=style]'),
				tab_style = form.find('select[name=tab_style]');


			this._styleChanged();
			this._equalWidthOption();
			style.on('change', $.proxy( this._styleChanged, this ) ) ;

			tab_style.on('change', $.proxy( this._equalWidthOption, this ) ) ;

			this._iconStyleChanged();
			icon_style.on('change', $.proxy( this._iconStyleChanged, this ) ) ;

			$('body').delegate( '.fl-builder-settings select[name="content_type"]', 'change', $.proxy(this._contentTypeChange, this) );
		},
		
		_styleChanged: function() {
			var form		= $('.fl-builder-settings'),
				style 	= form.find('select[name=style]').val(),
				tab_style 	= form.find('select[name=tab_style]').val();

			
			if( style != 'linebox' && style != 'iconfall' ){
				form.find('#fl-field-tab_style').show();
				if( tab_style == 'inline'  ){
					form.find('#fl-field-tab_style_alignment').show();
				} else {
					form.find('#fl-field-tab_style_alignment').hide();
				}

			} else {
				form.find('#fl-field-tab_style').hide();
				form.find('#fl-field-tab_style_alignment').hide();
			}

			//if( style == 'iconfall' || style == 'topline' ) {
				//form.find('#fl-builder-settings-section-underline_settings').show();
				if( style == 'topline' ) {
					form.find('#fl-field-line_position').show();
				} else {
					form.find('#fl-field-line_position').hide();
				}
			//}

			if( style == 'iconfall' ) {
				form.find('#fl-field-show_icon').hide();
				form.find('#fl-field-icon_position').hide();
				form.find('#fl-field-icon_hover_color').hide();
				form.find('#fl-field-icon_active_color').hide();
				form.find('#fl-field-icon_size').hide();
				form.find('#fl-field-icon_color').show();
			} else if( style == 'linebox' ) {
				form.find('#fl-field-show_icon').show();
				var val = form.find('select[name=show_icon]').val();
				form.find('#fl-field-icon_hover_color').hide();
				if( val == 'yes' ) {
					form.find('#fl-field-icon_position').show();
					form.find('#fl-field-icon_color').show();
					form.find('#fl-field-icon_active_color').show();
					form.find('#fl-field-icon_size').show();
				} else {
					form.find('#fl-field-icon_position').hide();
					form.find('#fl-field-icon_color').hide();
					form.find('#fl-field-icon_active_color').hide();
					form.find('#fl-field-icon_size').hide();
				}
			} else {
				form.find('#fl-field-show_icon').show();
				var val = form.find('select[name=show_icon]').val();
				if( val == 'yes' ) {
					form.find('#fl-field-icon_position').show();
					form.find('#fl-field-icon_color').show();
					form.find('#fl-field-icon_hover_color').show();
					form.find('#fl-field-icon_active_color').show();
					form.find('#fl-field-icon_size').show();
				} else {
					form.find('#fl-field-icon_position').hide();
					form.find('#fl-field-icon_color').hide();
					form.find('#fl-field-icon_hover_color').hide();
					form.find('#fl-field-icon_active_color').hide();
					form.find('#fl-field-icon_size').hide();
				}
			}

			this._equalWidthOption();
		},

		_iconStyleChanged: function() {
			var form		= $('.fl-builder-settings'),
				val = form.find('select[name=show_icon]').val(),
				style 	= form.find('select[name=style]').val();
			if( val == 'yes' ) {
				if( style == 'iconfall' ) {
					form.find('#fl-field-icon_color').show();
					form.find('#fl-field-icon_position').hide();
					form.find('#fl-field-icon_hover_color').hide();
					form.find('#fl-field-icon_active_color').hide();
					form.find('#fl-field-icon_size').hide();
				} else if( style == 'linebox' ) {
					form.find('#fl-field-icon_position').show();
					form.find('#fl-field-icon_color').show();
					form.find('#fl-field-icon_hover_color').hide();
					form.find('#fl-field-icon_active_color').show();
					form.find('#fl-field-icon_size').show();
				} else {
					form.find('#fl-field-icon_position').show();
					form.find('#fl-field-icon_color').show();
					form.find('#fl-field-icon_hover_color').show();
					form.find('#fl-field-icon_active_color').show();
					form.find('#fl-field-icon_size').show();
				}
			} else {
				form.find('#fl-field-icon_position').hide();
				form.find('#fl-field-icon_color').hide();
				form.find('#fl-field-icon_hover_color').hide();
				form.find('#fl-field-icon_active_color').hide();
				form.find('#fl-field-icon_size').hide();
			}
		},

		_equalWidthOption: function() {
			var form		= $('.fl-builder-settings'),
				/* Overall Style */
				style 	= form.find('select[name=style]').val(),
				/* Individul Tab Style */
				tab_style = form.find('select[name=tab_style]').val();

 
				if ( style == 'simple' || style == 'bar' || style == 'topline' || style == 'linebox' ) {
					if ( style != 'linebox' && tab_style == 'full' ) {
						form.find('#fl-field-tab_style_width').show();
					}else if ( style == 'linebox' ) {
						form.find('#fl-field-tab_style_width').show();
					}else{
						form.find('#fl-field-tab_style_width').hide();
					}
				}else if(  style == 'iconfall' ){
					form.find('#fl-field-tab_style_width').show();
				}else {
					form.find('#fl-field-tab_style_width').hide();
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

				if ( "uabb_tab_items_form" === FLBuilderSettingsForms.config.id ) {
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