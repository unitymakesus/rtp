(function($){

	FLBuilder.registerModuleHelper('advanced-tabs', {

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

	});

})(jQuery);