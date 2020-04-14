(function($){

	FLBuilder.registerModuleHelper('uabb-beforeafterslider', {

		rules: {
			title: {
				required: true
			}
		},
		
		init: function()
		{
			var form    	= $('.fl-builder-settings'),
			    advance_option = form.find('select[name=advance_opt]');

			advance_option.on('change', this.check_dependency );
			this.check_dependency();
		},
		check_dependency: function()
		{
			var form		= $('.fl-builder-settings'),
				advance_option 	= form.find('select[name=advance_opt]').val(),
				shadow_option 	= form.find('select[name=shadow_opt]').val();
			
			if ( advance_option == "" && shadow_option == "Y") {
				$("#fl-field-handle_shadow").css({"display":"none"});
				$("#fl-field-handle_shadow_color").css({"display":"none"});
			}
			if ( advance_option == "Y" && shadow_option == "Y") {
				$("#fl-field-handle_shadow").css({"display":"table-row"});
				$("#fl-field-handle_shadow_color").css({"display":"table-row"});
			}
		}
		
	});
})(jQuery);