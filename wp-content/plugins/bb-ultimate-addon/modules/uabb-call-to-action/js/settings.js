(function($){

	FLBuilder.registerModuleHelper('uabb-call-to-action', {

		rules: {
			title: {
				required: true
			},
			btn_text: {
				required: true
			}
		},
		init: function()
		{
			var form      = $( '.fl-builder-settings' ),
				layout    = form.find( 'select[name=layout]' );

			this._layoutChanged();
			
			layout.on( 'change', this._layoutChanged );
			setTimeout(function(){
				layout.trigger( 'change' );	
			},500);

			UABBButton.init();
			
		},

		_layoutChanged: function(){  }
	});

	jQuery(document).ready(function() {

		jQuery(document).on('keyup focus', 'input[name="btn_border_radius"]', function() {
			jQuery( 'input[name="btn_border_radius"]' ).val( jQuery(this).val() );
		});

		jQuery(document).on('keyup focus', 'input[name="btn_padding"]', function() {
			jQuery( 'input[name="btn_padding"]' ).val( jQuery(this).val() );
		});
	});

})(jQuery);