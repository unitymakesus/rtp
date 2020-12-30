(function($){

	FLBuilder.registerModuleHelper('fancy-text', {

		init: function()
		{
			var form = $('.fl-builder-settings');
			
			// Init hide function.
			this._toggleTypeOptions();
			
			// Validation events.
			form.find('select[name=effect_type]').on('change', this._toggleTypeOptions);
		},
	
		_toggleTypeOptions: function()
		{
			var form       			= $('.fl-builder-settings'),
				effect_type   		= form.find('select[name=effect_type]').val(),
				show_cursor_data 	= form.find('select[name=show_cursor]').data( 'toggle' ),
				show_cursor 		= form.find('select[name=show_cursor]').val(),
				i 					= 0;
				
			if(effect_type === 'slide_up') {
				for(i in show_cursor_data) {
					FLBuilder._settingsSelectToggle(show_cursor_data[i].fields, 'hide', '#fl-field-');
				}
			}
			if( effect_type !== 'type' ) {
				form.find('#fl-field-cursor_text').hide();
				form.find('#fl-field-cursor_blink').hide();
			}
			
			if( effect_type === 'type' || effect_type === 'slide_up'  ) {
				form.find('#fl-field-animation_delay').hide();		
			} else {
				form.find('#fl-field-animation_delay').show();
			}

		},
	});

})(jQuery);