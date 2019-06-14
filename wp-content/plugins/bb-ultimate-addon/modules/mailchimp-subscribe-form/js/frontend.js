( function( $ ) {

	UABBSubscribeFormModule = function( settings )
	{
		this.settings	= settings;
		this.nodeClass	= '.fl-node-' + settings.id;
		this.form 		= $( this.nodeClass + ' .uabb-subscribe-form' );
		this.button		= this.form.find( 'a.uabb-button' );
		this.btn_width	= settings.btn_width;
		this.btn_padding = settings.btn_padding;
		this.layout = settings.layout;
		this._init();
	};

	UABBSubscribeFormModule.prototype = {
	
		settings	: {},
		nodeClass	: '',
		form		: null,
		button		: null,
		
		_init: function()
		{
			this.button.on( 'click', $.proxy( this._submitForm, this ) );
			var form = $( '.uabb-form-wrap' ),
				inputFName = form.find( 'input[name=uabb-subscribe-form-fname]' ),
				inputLName = form.find( 'input[name=uabb-subscribe-form-lname]' ),
				inputEmail = form.find( 'input[name=uabb-subscribe-form-email]' );

				inputFName.on('focusout', this._focusOut);
				inputLName.on('focusout', this._focusOut);
				inputEmail.on('focusout', this._focusOut);

				inputFName.on('focus', this._removeErrorClass);
				inputLName.on('focus', this._removeErrorClass);
				inputEmail.on('focus', this._removeErrorClass);

			if( this.btn_width != 'custom' && this.layout == 'inline' ) {
				var height = $( this.nodeClass + ' .uabb-form-field input[type=text]' ).outerHeight(true),
					line_height = ( height - ( 2 * this.btn_padding ) );
				$( this.nodeClass + ' .uabb-form-button a' ).css( 'height', height );
				$( this.nodeClass + ' .uabb-form-button a' ).css( 'line-height', line_height + 'px' );
			}
		},

		_focusOut: function( e ) {
			if( $( this ).val().length !== 0 ) {
				$( this ).parent().addClass( 'open' );
			} else {
				$( this ).parent().removeClass( 'open' );
			}
		},
		
		_removeErrorClass: function(){
			$( this ).removeClass('uabb-form-error');
		},

		_submitForm: function( e )
		{
			var postId      	= this.form.closest( '.fl-builder-content' ).data( 'post-id' ),
				templateId		= this.form.data( 'template-id' ),
				templateNodeId	= this.form.data( 'template-node-id' ),
				nodeId      	= this.form.closest( '.fl-module' ).data( 'node' ),
				buttonText  	= this.button.find( '.uabb-button-text' ).text(),
				waitText    	= this.button.closest( '.uabb-form-button' ).data( 'wait-text' ),
				fname        	= this.form.find( 'input[name=uabb-subscribe-form-fname]' ),
				lname        	= this.form.find( 'input[name=uabb-subscribe-form-lname]' ),
				email       	= this.form.find( 'input[name=uabb-subscribe-form-email]' ),
				termsCheckbox   = this.form.find( 'input[name=uabb-terms-checkbox]'),
				re          	= /\S+@\S+\.\S+/,
				valid       	= true;
				
			e.preventDefault();

			if ( this.button.hasClass( 'uabb-form-button-disabled' ) ) {
				return; // Already submitting
			}
			/*if ( name.length > 0 && name.val() == '' ) {
				name.addClass( 'uabb-form-error' );
				name.siblings( '.uabb-form-error-message' ).show();
				valid = false;
			}*/
			if ( '' == email.val() || ! re.test( email.val() ) ) {
				email.addClass( 'uabb-form-error' );
				email.siblings( '.uabb-form-error-message' ).show();
				valid = false;
			}

			if ( termsCheckbox.val() ) {
				if ( ! termsCheckbox.is(':checked') ) {
					valid = false;
					termsCheckbox.closest('.uabb-terms-wrap').addClass( 'uabb-form-error' );
					termsCheckbox.parent().siblings( '.uabb-form-error-message' ).show();
				}
				else {
					termsCheckbox.removeClass( 'uabb-form-error-message' );
					termsCheckbox.parent().siblings( '.uabb-form-error-message' ).hide();
				}
			}
			
			if ( valid ) {
				
				this.form.find( '> .uabb-form-error-message' ).hide();
				this.button.find( '.uabb-button-text' ).text( waitText );
				this.button.data( 'original-text', buttonText );
				this.button.addClass( 'uabb-form-button-disabled' );
				
				$.post( FLBuilderLayoutConfig.paths.wpAjaxUrl, {
					action  			: 'uabb_subscribe_form_submit',
					lname    			: lname.val(),
					fname    			: fname.val(),
					email   			: email.val(),
					post_id 			: postId,
					template_id 		: templateId,
					template_node_id 	: templateNodeId,
					node_id 			: nodeId
				}, $.proxy( this._submitFormComplete, this ) );
			}
		},
		
		_submitFormComplete: function( response )
		{
			var data        = JSON.parse( response ),
				buttonText  = this.button.data( 'original-text' );
				
			if ( data.error ) {
				
				this.form.find( '> .uabb-form-error-message' ).text( data.error );
				this.form.find( '> .uabb-form-error-message' ).show();
				this.button.removeClass( 'uabb-form-button-disabled' );
				this.button.find( '.uabb-button-text' ).text( buttonText );
			} else {
				
				this.button.removeClass( 'uabb-form-button-disabled' );
				this.button.find( '.uabb-button-text' ).text( buttonText );				
				
				if ( 'message' == data.action ) {
					this.form.find( '> *' ).hide();
					this.form.append( '<div class="uabb-form-success-message">' + data.message + '</div>' );
				}
				else if ( 'redirect' == data.action ) {
					window.location.href = data.url;
				}
			}

		}
	}
	
})( jQuery );