(function($){

	FLBuilder.registerModuleHelper('team', {

		init: function()
		{
			var form    	= $('.fl-builder-settings'),
				separator_width	= form.find('input[name=separator_width]'),
				icon_style	= form.find('select[name=icon_style]');
				

			// Init validation events.
			this._toggleBorderOptions();
			this._toggleSeparatorAlignment();

			icon_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			separator_width.on('keyup', $.proxy( this._toggleSeparatorAlignment, this ) );
		},

		_toggleSeparatorAlignment: function() {
			var form    	= $('.fl-builder-settings'),
				separator_width	= form.find('input[name=separator_width]').val(),
				separator_alignment	= form.find('#fl-field-separator_alignment');

			if( separator_width != '' && separator_width < 100 ) {
				separator_alignment.show();				
			} else {
				separator_alignment.hide();
			}
		},
		
		_toggleBorderOptions: function() {
			var form		= $('.fl-builder-settings'),
				show_border = false
				image_type 	= form.find('select[name=image_type]').val(),
				icon_style 	= form.find('select[name=icon_style]').val(),
				border_style 	= form.find('select[name=icon_border_style]').val();

			if( icon_style != 'custom'  ) {
				form.find('#fl-field-icon_border_width').hide();
				form.find('#fl-field-icon_border_color').hide();
				form.find('#fl-field-icon_border_hover_color').hide();
			}else{
				form.find('#fl-field-icon_border_width').hide();
				form.find('#fl-field-icon_border_color').hide();
				form.find('#fl-field-icon_border_hover_color').hide();
				if ( border_style != 'none' ) {
					form.find('#fl-field-icon_border_width').show();
					form.find('#fl-field-icon_border_color').show();
					form.find('#fl-field-icon_border_hover_color').show();
				}
			}
		},
	});

})(jQuery);