(function($) {

	window.onLoadUABBReCaptcha = function() {
		var reCaptchaFields = $( '.uabb-grecaptcha' ),
			widgetID;
		if ( reCaptchaFields.length > 0 ) {
			reCaptchaFields.each( function(){
				var self 		= $( this ),
				 	attrWidget 	= self.attr( 'data-widgetid' );

				// Avoid re-rendering as it's throwing API error
				if ( ( typeof attrWidget !== typeof undefined && attrWidget !== false ) ) {
					return;
				}
				else {
					widgetID = grecaptcha.render( $( this ).attr( 'id' ), { 
						sitekey : self.data( 'sitekey' ),
						theme	: self.data( 'theme' ),
						callback: function( response ){
							if ( response != '' ) {
								self.attr( 'data-uabb-grecaptcha-response', response );
							}
						}
					});
					self.attr( 'data-widgetid', widgetID );					
				}
			});
		}
	};

	UABBContactForm = function( settings )
	{
		this.settings	= settings;
		this.nodeClass	= '.fl-node-' + settings.id;
		this.ajaxurl  	= settings.uabb_ajaxurl;
		this.name_required = settings.name_required;
		this.email_required = settings.email_required;
		this.subject_required = settings.subject_required;
		this.phone_required = settings.phone_required;
		this.msg_required = settings.msg_required;		
		this.button_text = settings.button_text;
		this.form 		= $( this.nodeClass + ' .uabb-contact-form' );
		this.button		= this.form.find( '.uabb-contact-form-submit' );

		this._init();
	};

	UABBContactForm.prototype = {
	
		settings	: {},
		nodeClass	: '',
		ajaxurl 	: '',
		name_required : 'no',
		email_required : 'yes',
		subject_required : 'no',
		phone_required : 'no',
		msg_required : 'no',
		
		_init: function()
		{
			var phone		= $( this.nodeClass + ' .uabb-phone input' );
			phone.on( 'keyup', this._removeExtraSpaces );
			$( this.nodeClass + ' .uabb-contact-form-submit' ).click( $.proxy( this._submit, this ) );
		},
		
		_submit: function( e )
		{
			var theForm	  	= $( this.nodeClass + ' .uabb-contact-form' ),
				submit	  	= $( this.nodeClass + ' .uabb-contact-form-submit' ),
				name	  	= $( this.nodeClass + ' .uabb-name input' ),
				email		= $( this.nodeClass + ' .uabb-email input' ),
				phone		= $( this.nodeClass + ' .uabb-phone input' ),
				subject	  	= $( this.nodeClass + ' .uabb-subject input' ),
				message	  	= $( this.nodeClass + ' .uabb-message textarea' ),
				reCaptchaField  = $( '#'+ this.settings.id + '-uabb-grecaptcha' ),
				reCaptchaValue	= reCaptchaField.data( 'uabb-grecaptcha-response' ),
				mailto	  	= $( this.nodeClass + ' .uabb-mailto' ),
				ajaxurl	  	= this.ajaxurl, //FLBuilderLayoutConfig.paths.wpAjaxUrl,
				email_regex = /\S+@\S+\.\S+/,
				phone_regex = /^[ 0-9.()\[\]+-]*$/,
				isValid	  	= true;
				termsCheckbox 	= $( this.nodeClass + ' .uabb-terms-checkbox input' ),
				postId      	= theForm.closest( '.fl-builder-content' ).data( 'post-id' ),
				templateId		= theForm.data( 'template-id' ),
				templateNodeId	= theForm.data( 'template-node-id' ),
				nodeId      	= theForm.closest( '.fl-module' ).data( 'node' );
			e.preventDefault();

			name.on( 'focus', this._removeErrorClass );
			email.on( 'focus', this._removeErrorClass );
			phone.on( 'focus', this._removeErrorClass );
			phone.on( 'keyup', this._removeExtraSpaces );
			subject.on( 'focus', this._removeErrorClass );
			message.on( 'focus', this._removeErrorClass );

			// End if button is disabled (sent already)
			if ( submit.hasClass( 'uabb-disabled' ) ) {
				return;
			}
			
			// validate the name
			if( this.name_required == 'yes' ) {
				if( name.length ) {
					if ( name.val().trim() === '' ) {
						isValid = false;
						name.parent().addClass( 'uabb-error' );
						name.addClass( 'uabb-form-error' );
						name.siblings( '.uabb-form-error-message' ).show();
					} 
					else if ( name.parent().hasClass( 'uabb-error' ) ) {
						name.parent().removeClass( 'uabb-error' );
						name.siblings( '.uabb-form-error-message' ).hide();
					}
				}
			}
			
			// validate the email
			if( this.email_required == 'yes' ) {
				if( email.length ) {
					if ( email.val().trim() === '' ) {
						isValid = false;
						email.parent().addClass( 'uabb-error' );
						email.siblings( '.uabb-form-error-message' ).show();
						email.siblings().addClass( 'uabb-form-error-message-required' );
					} 
					else {
						email.siblings().removeClass( 'uabb-form-error-message-required' );
						email.parent().removeClass( 'uabb-error' );
						email.siblings( '.uabb-form-error-message' ).hide();
					}
				}
			} else {
				email.siblings().removeClass( 'uabb-form-error-message-required' );
			}

			if( email.length ) {
				if ( email.val().trim() !== '' ) {
					if( email_regex.test( email.val().trim() ) ) {
						email.parent().removeClass( 'uabb-error' );
						email.siblings( '.uabb-form-error-message' ).hide();
					} else {
						isValid = false;
						email.parent().addClass( 'uabb-error' );
						email.siblings( '.uabb-form-error-message' ).show();
					}
				}
			}

			// validate the subject..just make sure it's there
			if( this.subject_required == 'yes' ) {
				if( subject.length ) {
					if ( subject.val().trim() === '' ) {
						isValid = false;
						subject.parent().addClass( 'uabb-error' );
						subject.siblings( '.uabb-form-error-message' ).show();
					} 
					else if ( subject.parent().hasClass( 'uabb-error' ) ) {
						subject.parent().removeClass( 'uabb-error' );
						subject.siblings( '.uabb-form-error-message' ).hide();
					}
				}
			}
			
			// validate the phone..just make sure it's there
			if( this.phone_required == 'yes' ) {
				if( phone.length ) {
    				if( phone.val().trim() === '' ) {
    					isValid = false;
						phone.parent().addClass( 'uabb-error' );
						phone.siblings( '.uabb-form-error-message' ).show();
						phone.siblings().addClass( 'uabb-form-error-message-required' );
    				} else {
    					phone.siblings().removeClass( 'uabb-form-error-message-required' );
						phone.parent().removeClass( 'uabb-error' );
						phone.siblings( '.uabb-form-error-message' ).hide();
    				}
				}
			} else {
				phone.siblings().removeClass( 'uabb-form-error-message-required' );
			}

			if( phone.length ) {
				if ( phone.val().trim() !== '' ) {
					if( phone_regex.test( phone.val().trim() ) ) {
						phone.parent().removeClass( 'uabb-error' );
						phone.siblings( '.uabb-form-error-message' ).hide();
					} else {
						isValid = false;
						phone.parent().addClass( 'uabb-error' );
						phone.siblings( '.uabb-form-error-message' ).show();
					}
				}
			}
			
			// validate the message..just make sure it's there
			if( this.msg_required == 'yes' ) {
				if ( message.val().trim() === '' ) {
					isValid = false;
					message.parent().addClass( 'uabb-error' );
					message.siblings( '.uabb-form-error-message' ).show();
				} 
				else if ( message.parent().hasClass( 'uabb-error' ) ) {
					message.parent().removeClass( 'uabb-error' );
					message.siblings( '.uabb-form-error-message' ).hide();
				}
			}

			if ( termsCheckbox.length ) {
				if ( ! termsCheckbox.is(':checked') ) {
					isValid = false;
					termsCheckbox.closest( '.uabb-contact-form .uabb-terms-checkbox' ).addClass( 'uabb-error' );
				}
				else if ( termsCheckbox.closest( '.uabb-contact-form .uabb-terms-checkbox' ).hasClass( 'uabb-error' ) ) {
					termsCheckbox.closest( '.uabb-contact-form .uabb-terms-checkbox' ).removeClass( 'uabb-error' );
				}
			}

			// validate if reCAPTCHA is enabled and checked
			if ( reCaptchaField.length > 0 ) {
				if ( 'undefined' === typeof reCaptchaValue || reCaptchaValue === false ) {
					isValid = false;
					reCaptchaField.parent().addClass( 'uabb-error' );
				} else {
					reCaptchaField.parent().removeClass('uabb-error');
				}
			}
			
			// end if we're invalid, otherwise go on..
			if ( !isValid ) {
				return false;
			} 
			else {
			
				// disable send button
				submit.addClass( 'uabb-disabled' );
				submit.html( '<span>'+this.button.closest( '.uabb-contact-form-button' ).data( 'wait-text' )+'</span>' );
				
				// post the form data
				$.post(ajaxurl, {
					action	: 'uabb_builder_email',
					name	: name.val(),
					subject	: subject.val(),
					email	: email.val(),
					phone	: phone.val(),
					mailto	: mailto.val(),
					message	: message.val(),
					terms_checked		: termsCheckbox.is( ':checked' ) ? '1' : '0',
					post_id 			: postId,
					node_id 			: nodeId,
					template_id 		: templateId,
					template_node_id 	: templateNodeId
				}, $.proxy( this._submitComplete, this ) );
			}
		},

		_removeExtraSpaces: function() {
			var textValue = $( this ).val();
		    textValue = textValue.replace( / /g,"" );
			$( this ).val( textValue )
		},
		
		_removeErrorClass: function(){
			$( this ).parent().removeClass( 'uabb-error' );
			$( this ).siblings( '.uabb-form-error-message' ).hide();
		},

		_submitComplete: function( response ) {
			var urlField 	= $( this.nodeClass + ' .uabb-success-url' ),
				submit	  	= $( this.nodeClass + ' .uabb-contact-form-submit' ),
				noMessage 	= $( this.nodeClass + ' .uabb-success-none' );

			submit.html( '<span>'+this.button_text+'</span>' );
			
			// On success show the success message
			if( response === '1' || response == 1 || response == '1' ) {

				$( this.nodeClass + ' .uabb-send-error' ).fadeOut();
				
				if ( urlField.length > 0 ) {
					window.location.href = urlField.val();
				} 
				else if ( noMessage.length > 0 ) {
					noMessage.fadeIn();
				}
				else {
					$( this.nodeClass + ' .uabb-contact-form' ).hide();
					$( this.nodeClass + ' .uabb-success-msg' ).fadeIn();
				}
			} 
			// On failure show fail message and re-enable the send button
			else {
				$( this.nodeClass + ' .uabb-contact-form-submit' ).removeClass( 'uabb-disabled' );
				$( this.nodeClass + ' .uabb-send-error' ).fadeIn();
				return false;
			}
		}
	};
	
})(jQuery);