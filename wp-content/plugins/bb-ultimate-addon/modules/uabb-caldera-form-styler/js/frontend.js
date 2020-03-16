
(function($) {

	UABBCalderaFormsStyler = function( settings )
	{   
		this.settings 	= settings;
		this.error_msg_position = settings.error_msg_position;
		this.nodeClass  = '.fl-node-' + settings.id;
		this._init();	
	};

	UABBCalderaFormsStyler.prototype = {
		
		_init: function()
		{	
			var scope = $( this.nodeClass );
			
			var	cafSelectFields = $( this.nodeClass ).find('select');
			cafSelectFields.wrap( "<div class='uabb-caf-select-custom'></div>" );

			this._checkRadioField(scope);
			this._errorMsgPosition(scope);

			$( document ).on( 'cf.add', function(){
				this._checkRadioField(scope);
			});
		},
		_checkRadioField: function(scope)
		{	
			scope.find('input:radio').each(function() {

				var radioField = $( this ).next().hasClass('uabb-caf-radio-custom');
				if( radioField ) {
					return;
				} else {
					$( this ).after( "<span class='uabb-caf-radio-custom'></span>" );
				}

			});

		},
		_errorMsgPosition: function(scope)
		{
			if ( 'bottom_right' === this.error_msg_position ) {
				scope.find('.uabb-caf-form').addClass('uabb-caf-error-style-bottom_right')
			}
		}
		
	};
	
})(jQuery);