UABB_Admin_Notice = {

	_init : function() {
		
		var scope = jQuery( document ).find('.uabb-admin-dismiss-notice');
		var dismissed = scope.find('.notice-dismiss');

		dismissed.on('click',function () {

			UABB_Admin_Notice._callAjax();

		});
	},
	_callAjax: function(){
		jQuery.ajax({
            url: self.ajaxurl,
			data: {
				action: 'dismissed_notice_handler',
				dismissed: true,
			}
		});
	}
}

jQuery(document).ready(function( $ ) {

	UABB_Admin_Notice._init();

});
