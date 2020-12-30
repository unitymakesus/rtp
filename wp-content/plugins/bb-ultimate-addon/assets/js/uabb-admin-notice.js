UABB_Admin_Notice = {

	_init : function() {
		
		var scope = jQuery( document ).find('.uabb-admin-dismiss-notice');
		var dismissed = scope.find('.notice-dismiss');
		var login_scope = jQuery( document ).find('.uabb-admin-login-dismiss-notice');
		var login_dismissed = login_scope.find('.notice-dismiss');
		var dismiss_nonce = scope.data('nonce');
		var dismiss_login_nonce = login_scope.data('nonce');

		/* All the selector of the Batch Process start */
		var batch_process_id = jQuery( document ).find('#uabb-batch-process-start');
		var batch_notice_dismissed = batch_process_id.find( '.notice-dismiss' );
		var batch_process_nonce = batch_process_id.find( '.notice-content' ).data('batch-nonce');

		/* All the selector of the Batch Process Complete */
		var batch_process_complete_id = jQuery( document ).find( '#uabb-batch-process-complete' );
		var batch_complete_dismissed = batch_process_complete_id.find( '.notice-dismiss' ); 
		var batch_complete_nonce = batch_process_complete_id.find( '.notice-content' ).data('batch-complete-nonce');

		dismissed.on('click',function () {

			UABB_Admin_Notice._callAjax( dismiss_nonce );

		});

		login_dismissed.on('click',function () {

			UABB_Admin_Notice._callLoginAjax( dismiss_login_nonce );

		});

		/* On Click Event for Batch Process start */
		batch_notice_dismissed.on('click',function () {
			UABB_Admin_Notice._callBatchProcessAjax( batch_process_nonce );

		});

		/* On Click Event for Batch Process when Completed */
		batch_complete_dismissed.on('click',function () {
			UABB_Admin_Notice._callBatchCompleteAjax( batch_complete_nonce );
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
	},
	/**
	 * Ajax call for the dismiss start Batch Process Notice.
	 *
	 * @since 1.25.0
	*/
	_callBatchProcessAjax: function( batch_process_nonce ) {
		jQuery.ajax({
            url: self.ajaxurl,
			data: {
				action: 'uabb_batch_dismiss_notice',
				dismissed: 'yes',
				batch_process_nonce:batch_process_nonce,
			}
		});	
	},
	/**
	 * Ajax call for the dismiss Complete Batch Process Notice.
	 *
	 * @since 1.25.0
	*/
	_callBatchCompleteAjax: function( batch_complete_nonce ) {

		jQuery.ajax({
            url: self.ajaxurl,
			data: {
				action: 'uabb_batch_dismiss_complete_notice',
				dismissed: 'yes',
				batch_complete_nonce:batch_complete_nonce,
			}
		});
	}
}

jQuery(document).ready(function( $ ) {

	UABB_Admin_Notice._init();

});
