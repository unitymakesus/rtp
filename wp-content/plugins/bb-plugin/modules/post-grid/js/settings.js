( function( $ ) {

	FLBuilder.registerModuleHelper( 'post-grid', {

		resizeTimeout: null,

		init: function() {
			var form = $( '.fl-builder-settings' ),
				resizeFields = form.find( '#fl-field-border, #fl-field-title_typography, #fl-field-info_typography, #fl-field-content_typography' ),
				buttonBgColor = form.find( 'input[name=more_btn_bg_color]' ),
				icon = form.find( 'input[name=icon]' );

			resizeFields.find( 'input' ).on( 'input', this._resizeLayout.bind( this ) );
			resizeFields.find( 'select' ).on( 'change', this._resizeLayout.bind( this ) );
			buttonBgColor.on( 'change', this._previewButtonBackground );
			icon.on( 'change', this._flipSettings );
			this._flipSettings()
		},

		_flipSettings: function() {
			var form  = $( '.fl-builder-settings' ),
					icon = form.find( 'input[name=icon]' );
			if ( -1 !== icon.val().indexOf( 'fad fa') ) {
				$('#fl-field-duo_color1').show();
				$('#fl-field-duo_color2').show();
				$('#fl-field-icon_color').hide();
				$('#fl-field-hover_color').hide()
			} else {
				$('#fl-field-duo_color1').hide();
				$('#fl-field-duo_color2').hide();
				$('#fl-field-icon_color').show();
				$('#fl-field-hover_color').show()
			}
		},

		_resizeLayout: function( e ) {
			clearTimeout( this.resizeTimeout );
			this.resizeTimeout = setTimeout( this._doResizeLayout.bind( this ), 250 );
		},

		_doResizeLayout: function( e ) {
			var form = $( '.fl-builder-settings' ),
				layout = form.find( 'select[name=layout]' ).val(),
				preview = FLBuilder.preview;

			if ( 'grid' !== layout || ! preview ) {
				return;
			}

			var masonry = preview.elements.node.find( '.fl-post-grid.masonry' ).data( 'masonry' );

			if ( masonry && masonry.layout ) {
				masonry.layout();
			}
		},

		_previewButtonBackground: function( e ) {
			var preview	= FLBuilder.preview,
				selector = preview.classes.node + ' a.fl-button, ' + preview.classes.node + ' a.fl-button:visited',
				form = $( '.fl-builder-settings:visible' ),
				style = form.find( 'select[name=more_btn_style]' ).val(),
				bgColor = form.find( 'input[name=more_btn_bg_color]' ).val();

			if ( 'flat' === style ) {
				if ( '' !== bgColor && bgColor.indexOf( 'rgb' ) < 0 ) {
					bgColor = '#' + bgColor;
				}
				preview.updateCSSRule( selector, 'background-color', bgColor );
				preview.updateCSSRule( selector, 'border-color', bgColor );
			} else {
				preview.delayPreview( e );
			}
		},
	} );

} )( jQuery );
