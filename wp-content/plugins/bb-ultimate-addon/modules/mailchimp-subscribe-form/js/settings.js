( function( $ ) {

	FLBuilder.registerModuleHelper( 'mailchimp-subscribe-form', {

		rules: {
			service: {
				required: true
			}
		},
		
		init: function()
		{
			var form      = $( '.fl-builder-settings' ),
				btn_flat_button_options = form.find('select[name=btn_flat_button_options]'),
				btn_style = form.find('select[name=btn_style]'),
				action    = form.find( 'select[name=success_action]' ),
				msg_box = form.find('#fl-field-mailchimp_warning_msg td').html();
				if( msg_box.trim() == '' ) {
					form.find('#fl-builder-settings-section-service_msg').hide();
				} else {
					form.find('#fl-builder-settings-section-service_msg').show();
				}

			this._actionChanged();
			this._flatBtnOption();
			
			action.on( 'change', this._actionChanged );

			// Button background color change
			$( 'input[name=btn_bg_color]' ).on( 'change', this._bgColorChange );			
			this._bgColorChange();

			btn_flat_button_options.on('change', this._flatBtnOption);
			btn_style.on('change', this._flatBtnOption);

			// Responsive Spacing Toggle on 3rd dependency
			this._layoutChange();
			form.find('select[name=layout]').on( 'change', this._layoutChange );

			UABBButton.init();
		},

		_layoutChange: function() {
			var form      	= $( '.fl-builder-settings' ),
				layout 		= form.find('select[name=layout]').val(),
				responsive 	= form.find('select[name=responsive]').val(),
				res_spacing = form.find('#fl-field-res_spacing');

			res_spacing.css( 'display', 'none' );
			if( layout == 'inline' && responsive != 'none' ) {
				res_spacing.css('display', 'table-row');
			}
		},
		
		submit: function()
		{
			var form       = $( '.fl-builder-settings' ),
				service    = form.find( '.fl-builder-service-select' ),
				serviceVal = service.val(),
				account    = form.find( '.fl-builder-service-account-select' ),
				list       = form.find( '.fl-builder-service-list-select' );
				
			/*if ( 0 === account.length ) {
				FLBuilder.alert( FLBuilderStrings.subscriptionModuleConnectError );
				return false;
			}
			else if ( '' == account.val() || 'add_new_account' == account.val() ) {
				FLBuilder.alert( FLBuilderStrings.subscriptionModuleAccountError );
				return false;
			}
			else if ( ( 0 === list.length || '' == list.val() ) && 'email-address' != serviceVal && 'sendy' != serviceVal ) {
				
				if ( 'drip' == serviceVal || 'hatchbuck' == serviceVal ) {
					FLBuilder.alert( FLBuilderStrings.subscriptionModuleTagsError );	
				}
				else {
					FLBuilder.alert( FLBuilderStrings.subscriptionModuleListError );
				}
				
				return false;
			}*/
			
			return true;
		},
		
		_actionChanged: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ).val(),
				url       = form.find( 'input[name=success_url]' );
				
			url.rules('remove');
				
			if ( 'redirect' == action ) {
				url.rules( 'add', { required: true } );
			}
		},

		_flatBtnOption: function() {

			var form        = $('.fl-builder-settings'),
				btn_style = form.find('select[name=btn_style]').val(),
				btn_flat_button_options = form.find('select[name=btn_flat_button_options]').val();

			if( btn_style == 'flat' ) {
				if( btn_flat_button_options != 'none' ) {
					form.find('#fl-field-btn_icon_position').hide();
				} else {
					form.find('#fl-field-btn_icon_position').show();
				}
			} else {
				form.find('#fl-field-btn_icon_position').show();
			}

		},

		_bgColorChange: function()
		{
			var bgColor = $( 'input[name=btn_bg_color]' ),
				style   = $( '#fl-builder-settings-section-btn_style' );
			

			if ( '' == bgColor.val() ) {
				style.hide();
			}
			else {
				style.show();
			}
		}
	});

})(jQuery);