UABB_Admin_Notice = {

	_init : function() {
		
		var scope = jQuery( document ).find('.uabb-admin-dismiss-notice');
		var dismissed = scope.find('.notice-dismiss');
		var login_scope = jQuery( document ).find('.uabb-admin-login-dismiss-notice');
		var login_dismissed = login_scope.find('.notice-dismiss');
		var dismiss_nonce = scope.data('nonce');
		var dismiss_login_nonce = login_scope.data('nonce');
		dismissed.on('click',function () {

			UABB_Admin_Notice._callAjax( dismiss_nonce );

		});

		login_dismissed.on('click',function () {

			UABB_Admin_Notice._callLoginAjax( dismiss_login_nonce );

		});
	},
	_callAjax: function( dismiss_nonce ){
		jQuery.ajax({
            url: self.ajaxurl,
			data: {
				action: 'dismissed_notice_handler',
				dismissed: true,
				dismiss_nonce: dismiss_nonce,
			}
		});
	},
	_callLoginAjax: function( dismiss_login_nonce ){
		jQuery.ajax({
            url: self.ajaxurl,
			data: {
				action: 'dismissed_login_notice_handler',
				dismissed: true,
				dismiss_login_nonce:dismiss_login_nonce,
			}
		});
	}
}

jQuery(document).ready(function( $ ) {

	UABB_Admin_Notice._init();

});
