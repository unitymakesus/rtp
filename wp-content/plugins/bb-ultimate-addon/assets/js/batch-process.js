/**
 * JS FILE
 */
(function($){

    UABB_Batch_Process = {

        /**
         * Init
         */
        init: function()
        {
            this._bind();
        },

        /**
         * Binds events
         */
        _bind: function()
        {
            $( document ).on('click', '.uabb-replace-hotlink-images',  UABB_Batch_Process._process_ajax);
        },

        /**
         * Import
         */
        _process_ajax: function( event )
        {
            event.preventDefault();

            var btn = $(this);

            btn.addClass('updating-message');

            $.ajax({
                url  : ajaxurl,
                type : 'POST',
                data : {
                    action   : 'uabb_update_hotlink_images',
                    security : UABB_Batch_Process_Vars._nonce
                },
            })
            .done(function( data, status, XHR ) {
            	btn.parents('.notice-content').html( UABB_Batch_Process_Vars.started_notice );
                $( '#uabb-batch-process-start' ).addClass('uabb-batch-start');
            });
        }

    };

    /**
     * Initialization
     */
    $(function(){
        UABB_Batch_Process.init();
    });

})(jQuery); 