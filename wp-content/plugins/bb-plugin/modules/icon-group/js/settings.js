( function( $ ) {

	FLBuilder.registerModuleHelper( 'icon_group_form', {
		init: function() {
			var form  = $( '.fl-builder-settings' ),
			icon = form.find( 'input[name=icon]' );

			icon.on( 'change', this._flipSettings );

			this._flipSettings();
		},
		_flipSettings: function() {
			var form  = $( '.fl-builder-settings' ),
					icon = form.find( 'input[name=icon]' );
			if ( -1 !== icon.val().indexOf( 'fad fa') ) {
				form.find('#fl-field-duo_color1').show();
				form.find('#fl-field-duo_color2').show();
				form.find('#fl-field-color').hide();
				form.find('#fl-field-hover_color').hide()
			} else {
				form.find('#fl-field-duo_color1').hide();
				form.find('#fl-field-duo_color2').hide();
				form.find('#fl-field-color').show();
				form.find('#fl-field-hover_color').show()
			}
		}
	});

	FLBuilder.registerModuleHelper( 'icon-group', {

		init: function() {
			var form  = $( '.fl-builder-settings' ),
				size = form.find( '#fl-field-size input[type=number]' ),
				align = form.find( 'input[name=align]' );

			size.on( 'input', this._previewSize );
		},

		_previewSize: function() {
			var preview = FLBuilder.preview,
				wrapSelector = preview._getPreviewSelector( preview.classes.node, '.fl-icon' ),
				iconSelector = preview._getPreviewSelector( preview.classes.node, '.fl-icon i' ),
				beforeSelector = preview._getPreviewSelector( preview.classes.node, '.fl-icon i::before' ),
				form = $( '.fl-builder-settings' ),
				field = form.find( '#fl-field-size .fl-field-responsive-setting:visible' ),
				size = field.find( 'input[type=number]' ).val(),
				unit = field.find( 'select' ).val(),
				icons = form.find( '#fl-field-icons .fl-form-field input' ),
				value = '' === size ? '' : size + unit + ' !important',
				height = '' === size ? '' : ( size * 1.75 ) + unit + ' !important',
				index = 0,
				settings = null,
				bgColor = '';

			preview.updateCSSRule( iconSelector, 'font-size', value, true );
			preview.updateCSSRule( beforeSelector, 'font-size', value, true );

			icons.each( function( i ) {
				index = i + 1;
				settings = JSON.parse( $( this ).val() )

				if ( '' === settings.bg_color ) {
					preview.updateCSSRule( wrapSelector + ':nth-child(' + ( index ) +') i', {
						'line-height': '1',
						'height': 'auto !important',
						'width': 'auto !important',
					}, undefined, true );
				} else {
					preview.updateCSSRule( wrapSelector + ':nth-child(' + ( index ) +') i', {
						'line-height': height,
						'height': height,
						'width': height,
					}, undefined, true );
				}
			} );
		},
		
	});

} )( jQuery );
