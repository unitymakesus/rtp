(function($){
	FLBuilder.registerModuleHelper('uabb-video', {


		init: function(){
			var form 		= $('.fl-builder-settings'),
			subscribe_bar	= form.find('select[name=yt_subscribe_enable]');
			video_type		= form.find('select[name=video_type]');

			subscribe_bar.on( 'change', this._subscribeBar);
			video_type.on('change',this._VideoTypeThumbnail);
			$(this._subscribeBar,this);
			$(this._VideoTypeThumbnail,this);
			this._hideDocs();
		},

		_subscribeBar: function(){
			var form 			= $('.fl-builder-settings');
			subscribe_bar_val	= form.find('select[name=yt_subscribe_enable]').val();
			subscribe_channel	= form.find('select[name=select_options]').val();

			if('no'== subscribe_bar_val){
				form.find('#fl-field-yt_channel_id').hide();
				form.find('#fl-field-yt_channel_name').hide();
			}
			else{
				if('channel_id'==subscribe_channel){
					form.find('#fl-field-yt_channel_id').show();
				}
				else if('channel_name'==subscribe_channel){
					form.find('#fl-field-yt_channel_name').show();
				}
			} 
		},
		_VideoTypeThumbnail:function(){
			var form 	= $('.fl-builder-settings');

			if(form.find('select[name=video_type]').val()== 'vimeo'){
				form.find('#fl-field-yt_thumbnail_size').hide();
			}
			else{
				form.find('#fl-field-yt_thumbnail_size').show();
			}
		},
		/**
	 	 * Branding is on hide the Docs Tab.
	 	 *
	 	 * @since 1.14.0
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