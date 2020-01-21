(function($){

	FLBuilder.registerModuleHelper('info-banner', {

		rules: {
			title: {
				required: true
			}
		},
		
		init: function()
		{
			UABBButton.init();
		},

	});

})(jQuery);