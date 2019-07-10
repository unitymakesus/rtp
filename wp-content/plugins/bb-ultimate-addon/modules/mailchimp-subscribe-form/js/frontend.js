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
			var submitButton		= $( e.currentTarget ),
				currentForm     	= submitButton.closest( '.uabb-subscribe-form' ),
				postId      		= currentForm.closest( '.fl-builder-content' ).data( 'post-id' ),
				templateId 	        = currentForm.data( 'template-id' ),
				templateNodeId		= currentForm.data( 'template-node-id' ),
				nodeId      		= currentForm.closest( '.fl-module' ).data( 'node' ),
				buttonText  		= submitButton.find( '.uabb-button-text' ).text(),
				waitText    		= submitButton.closest( '.uabb-form-button' ).data( 'wait-text' ),
				fname        		= currentForm.find( 'input[name=uabb-subscribe-form-fname]' ),
				lname        		= currentForm.find( 'input[name=uabb-subscribe-form-lname]' ),
				email       		= currentForm.find( 'input[name=uabb-subscribe-form-email]' ),
				termsCheckbox   	= currentForm.find( 'input[name=uabb-terms-checkbox]'),
				re          		= /\S+@\S+\.\S+/,
				valid       		= true;

			e.preventDefault();

			if ( submitButton.hasClass( 'uabb-form-button-disabled' ) ) {
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
				
				currentForm.find( '> .uabb-form-error-message' ).hide();
				submitButton.find( '.uabb-button-text' ).text( waitText );
				submitButton.data( 'original-text', buttonText );
				submitButton.addClass( 'uabb-form-button-disabled' );
				
					ajaxData = {
					action  			: 'uabb_subscribe_form_submit',
					lname    			: lname.val(),
					fname    			: fname.val(),
					email   			: email.val(),
					post_id 			: postId,
					template_id 		: templateId,
					template_node_id 	: templateNodeId,
					node_id 			: nodeId
				};

				$.post( FLBuilderLayoutConfig.paths.wpAjaxUrl, ajaxData, $.proxy( function( response ){
					this._submitFormComplete( response, submitButton );
				}, this ));

			}
		},
		
		_submitFormComplete: function( response , button )
		{

			var data        = JSON.parse( response ),
				buttonText  = button.data( 'original-text' ),
				form        = button.closest( '.uabb-subscribe-form' );
			if ( data.error ) {
				
				form.find( '> .uabb-form-error-message' ).text( data.error );
				form.find( '> .uabb-form-error-message' ).show();
				button.removeClass( 'uabb-form-button-disabled' );
				button.find( '.uabb-button-text' ).text( buttonText );
			} else {
				
				button.removeClass( 'uabb-form-button-disabled' );
				button.find( '.uabb-button-text' ).text( buttonText );
				if ( 'message' == data.action ) {
					form.find( '> *' ).hide();
					form.append( '<div class="fl-form-success-message">' + data.message + '</div>' );
				}
				else if ( 'redirect' == data.action ) {
					window.location.href = data.url;
				}
			}

		}
	}
	
})( jQuery );