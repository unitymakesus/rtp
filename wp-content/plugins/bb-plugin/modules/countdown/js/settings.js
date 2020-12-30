(function($){

	FLBuilder.registerModuleHelper('countdown', {

		submit: function(){

			var self = this;
			var form   = $('.fl-builder-settings'),
				hour   = parseInt( form.find('select[name="time[][hours]"]').val() ),
				minute = parseInt( form.find('select[name="time[][minutes]"]').val() ),
				period = form.find('select[name="time[][day_period]"]').val(),
				date   = form.find('select[name="ui_date"]').val();

				if( Date.parse( date ) <= Date.now() ) {
				FLBuilder.alert( FLBuilderStrings.countdownDateisInThePast );
				return false;
			}
			return true;
		}
	});
})(jQuery);
