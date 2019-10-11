(function($){

	FLBuilder.registerModuleHelper('uabb-contact-form', {
    
		init: function() {
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ),
				form_style = form.find( 'select[name=form_style]' ),
				name_toggle 	= form.find( 'select[name=name_toggle]' ),
				email_toggle 	= form.find( 'select[name=email_toggle]' ),
				subject_toggle 	= form.find( 'select[name=subject_toggle]' ),
				phone_toggle 	= form.find( 'select[name=phone_toggle]' ),
				msg_toggle 		= form.find( 'select[name=msg_toggle]' ),
				hover_attribute = form.find('select[name=hover_attribute]'),
				enable_label = form.find( 'select[name=enable_label]' ),
				btn_style   = form.find('select[name=btn_style]');

			this._actionChanged();
			this._labelTypography();
			this._updateMailTags();
			this._btn_styleChanged();
			
			action.on( 'change', this._actionChanged );
			form_style.on( 'change', this._labelTypography );
			enable_label.on( 'change', this._labelTypography );
			
			name_toggle.on( 'change', this._updateMailTags );
			email_toggle.on( 'change', this._updateMailTags );
			subject_toggle.on( 'change', this._updateMailTags );
			phone_toggle.on( 'change', this._updateMailTags );
			msg_toggle.on( 'change', this._updateMailTags );
			hover_attribute.on( 'change', $.proxy( this._btn_styleChanged, this ) );
			btn_style.on( 'change', $.proxy( this._btn_styleChanged, this ) );

			// Toggle reCAPTCHA display
			
			this._uabbToggleReCaptcha();

			$( 'input[name=recaptcha_site_key]' ).on( 'change', $.proxy( this._uabbToggleReCaptcha, this ) );
			$( 'select[name=recaptcha_toggle]' ).on( 'change', $.proxy( this._uabbToggleReCaptcha, this ) );

			// Render reCAPTCHA after layout rendered via AJAX
			if ( window.onLoadUABBReCaptcha ) {
				$( FLBuilder._contentClass ).on( 'fl-builder.layout-rendered', onLoadUABBReCaptcha );
			}
			this._hideDocs();
		},

		/**
		 * Preview Method for reCAPTCHA settings
		 *
		 * @param  object event  The event type of where this method been called
		 * @since 1.9.5
		 */
		_uabbToggleReCaptcha: function(event)
		{
			var form      			= $( '.fl-builder-settings' ),
				nodeId    			= form.attr( 'data-node' ),
				toggle    			= form.find( 'select[name=uabb_recaptcha_toggle]' ),
				recaptcha_theme		= form.find( 'select[name=uabb_recaptcha_theme]' ), 
				captchaKey			= form.find( 'input[name=uabb_recaptcha_site_key]' ).val(),
				reCaptcha 			= $( '.fl-node-'+ nodeId ).find( '.uabb-grecaptcha' ),
				reCaptchaId 		= nodeId +'-uabb-grecaptcha',
				target				= typeof event !== 'undefined' ? $(event.currentTarget) : null,
				inputEvent			= target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'uabb_recaptcha_site_key',
				selectEvent			= target != null && typeof target.attr('name') !== typeof undefined && target.attr('name') === 'uabb_recaptcha_toggle',
				scriptTag 			= $('<script>');

			if ( $( 'script#uabb-g-recaptcha-api' ).length === 0 ) {
				scriptTag
					.attr('src', 'https://www.google.com/recaptcha/api.js?onload=onLoadUABBReCaptcha&render=explicit')
					.attr('type', 'text/javascript')
					.attr('id', 'uabb-g-recaptcha-api')
					.attr('async', 'async')
					.attr('defer', 'defer')
					.appendTo('body');
			}

			if ( 'show' === toggle.val() && captchaKey.length ) {

				if ( reCaptcha.length === 0 ) {
					this._uabbRenderReCaptcha( nodeId, reCaptchaId, captchaKey, recaptcha_theme );
				}
				else if ( ( inputEvent || selectEvent ) && reCaptcha.data('sitekey') != captchaKey ) {
					reCaptcha.parent().remove();
					this._uabbRenderReCaptcha( nodeId, reCaptchaId, captchaKey, recaptcha_theme );
				}
				else {
					reCaptcha.parent().show();
				}
			}
			else if ( 'show' === toggle.val() && captchaKey.length === 0 && reCaptcha.length > 0 ) {
				reCaptcha.parent().remove();
			}
			else if ( 'hide' === toggle.val() && reCaptcha.length > 0 ) {
				reCaptcha.parent().hide();
			}
		},

		/**
		 * Render Google reCAPTCHA
		 *
		 * @param  string nodeId  		The current node ID
		 * @param  string reCaptchaId  	The element ID to render reCAPTCHA
		 * @param  string reCaptchaKey  The reCAPTCHA Key
		 * @since 1.9.5
		 */
		_uabbRenderReCaptcha: function( nodeId, reCaptchaId, reCaptchaKey, recaptcha_theme )
		{
			var captchaField	= $( '<div class="uabb-input-group uabb-recaptcha">' ),
				captchaElement 	= $( '<div id="'+ reCaptchaId +'" class="uabb-grecaptcha">' ),
				widgetID;

			// Append recaptcha element
			captchaElement.attr('data-sitekey', reCaptchaKey);
			captchaField
				.html(captchaElement)
				.insertAfter( $('.fl-node-'+ nodeId ).find('.uabb-contact-form > .uabb-message') );

			// to an appended element
			widgetID = grecaptcha.render( reCaptchaId, {
				sitekey : reCaptchaKey,
				theme	: recaptcha_theme
			});
			captchaElement.attr('data-widgetid', widgetID);
		},

		_btn_styleChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=btn_style]').val(),
				hover_attribute = form.find('select[name=hover_attribute]').val();
				

            if( btn_style == 'transparent' ) {
            	form.find("#fl-field-hover_attribute").show();
        		if( hover_attribute == 'bg' ) {
        			form.find('#fl-field-btn_background_color th label').text('Background Color');
            		form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
                } else {
                	form.find('#fl-field-btn_background_color th label').text('Border Color');
            		form.find('#fl-field-btn_background_hover_color th label').text('Border Hover Color');
                }
            } else {
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-btn_background_color th label').text('Background Color');
            	form.find('#fl-field-btn_background_hover_color th label').text('Background Hover Color');
            }
		},

		_updateMailTags: function() {
			var form      		= $( '.fl-builder-settings' ),
				name_toggle 	= form.find( 'select[name=name_toggle]' ).val(),
				email_toggle 	= form.find( 'select[name=email_toggle]' ).val(),
				subject_toggle 	= form.find( 'select[name=subject_toggle]' ).val(),
				phone_toggle 	= form.find( 'select[name=phone_toggle]' ).val(),
				msg_toggle 		= form.find( 'select[name=msg_toggle]' ).val(),
				cf_mail_tags 	= form.find( '#fl-field-email_template_info .uabb-msg-field .uabb_cf_mail_tags' );

			var tags = Array();

			( name_toggle 	 == 'show' ) ? tags.push('[NAME]') : '';
			( email_toggle 	 == 'show' ) ? tags.push('[EMAIL]') : '';
			( subject_toggle == 'show' ) ? tags.push('[SUBJECT]') : '';
			( phone_toggle 	 == 'show' ) ? tags.push('[PHONE]') : '';
			( msg_toggle 	 == 'show' ) ? tags.push('[MESSAGE]') : '';

			cf_mail_tags.html( tags.join(', ') );
		},
    
		_actionChanged: function() {
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ).val(),
				url       = form.find( 'input[name=success_url]' );
				
			url.rules('remove');
				
			if ( 'redirect' == action ) {
				url.rules( 'add', { required: true } );
			}
		},
		
		_labelTypography: function() {
			var form      = $( '.fl-builder-settings' ),
				form_style = form.find( 'select[name=form_style]' ).val(),
				enable_label = form.find( 'select[name=enable_label]' ).val(),
				label_Section = form.find( '#fl-builder-settings-section-label_typography' );
				

			label_Section.hide();
			if ( form_style == 'style1' && enable_label == 'yes' ) {
				label_Section.show();
			}
						
		},

		/**
	 	 * When Branding is enabled, hide the Docs Tab in the Modules editor.
	 	 *
	 	 * @since 1.16.0
	 	 */
		_hideDocs: function() {
			var form            = $('.fl-builder-settings'),
            branding_selector   = form.find('#fl-field-uabb_helpful_information .uabb-docs-list');
            settings_tab        = form.find('.fl-builder-settings-tabs');
            get_anchor          =  settings_tab.find('a');

            $( get_anchor ).each(function() {

                if ( '#fl-builder-settings-tab-uabb_docs' === $(this) .attr('href') ) {

                    if ( 'yes' === branding_selector.data('branding') ) {
                        $( this ).hide();
                    } else {
                        $( this ).show();
                    }
                }
            });
		}
	});

})(jQuery);