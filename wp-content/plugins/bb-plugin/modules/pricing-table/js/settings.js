(function($){

	FLBuilder.registerModuleHelper('pricing_column_form', {

		init: function() {
			var form = $( '.fl-builder-settings' ),
				icon = form.find( 'input[name=btn_icon]' )

			icon.on( 'change', this._flipSettings );
			this._flipSettings()
		},

		_flipSettings: function() {
			var form  = $( '.fl-builder-settings' ),
					icon = form.find( 'input[name=btn_icon]' );
			if ( -1 !== icon.val().indexOf( 'fad fa') ) {
				$('#fl-field-btn_duo_color1').show();
				$('#fl-field-btn_duo_color2').show();
			} else {
				$('#fl-field-btn_duo_color1').hide();
				$('#fl-field-btn_duo_color2').hide();
			}
		}
	});

})(jQuery);
