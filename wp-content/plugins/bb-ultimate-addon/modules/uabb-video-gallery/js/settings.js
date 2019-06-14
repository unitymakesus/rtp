(function($){
	FLBuilder.registerModuleHelper('uabb-video-gallery', {

		init: function(){
			var form 		= $('.fl-builder-settings'),
			layout 			= form.find('select[name=layout]');
			show_filter   	= form.find('select[name=show_filter]');
			show_filter_title = form.find('select[name=show_filter_title]');
			video_type 		  = form.find('select[name=video_type]');
			show_caption		= form.find('select[name=show_caption]');
			show_tag			= form.find('select[name=show_tag]');
			show_arrow			= form.find('select[name=enable_arrow]');
			


			this._changeLayoutGrid();
			this._changeCategory();
			this._hideDocs();
			layout.on( 'change', this._changeLayoutGrid );
			show_filter.on( 'change', this._changeLayoutGrid );
			show_filter_title.on( 'change', this._changeLayoutGrid );
			show_caption.on( 'change', this._changeLayoutGrid );
			show_tag.on( 'change', this._changeLayoutGrid );
			show_filter.on('change',this._changeCategory);
			
		},
		_changeLayoutGrid :function() {

			var form 			= $('.fl-builder-settings'),
			layout_data 		= form.find('select[name=layout]').val();
			var settings_tab	= form.find('.fl-builder-settings-tabs');
			var href            = settings_tab.find('a');
			show_filter_val			= form.find('select[name=show_filter]').val();
			show_filter_title_val 	= form.find('select[name=show_filter_title]').val();
			show_caption_val		= form.find('select[name=show_caption]').val();
			show_tag_val			= form.find('select[name=show_tag]').val();


			if( 'grid' === layout_data ) {
				
				form.find('#fl-builder-settings-section-section_style_navigation').hide();
				form.find('#fl-field-row_gap').show();

				if( form.find('select[name=show_filter]').val() === 'yes' ) {
					form.find('#fl-builder-settings-section-section_style_cat_filters').show();
				} else {
					form.find('#fl-builder-settings-section-section_style_cat_filters').hide();
					
				}
				if( form.find('select[name=show_filter_title]').val() === 'yes' ) {
					form.find('#fl-builder-settings-section-section_style_title_filters').show();
					form.find('#fl-field-cat_filter_align').hide();
					form.find('#fl-field-filters_heading_text').show();
				} else {
					form.find('#fl-builder-settings-section-section_style_title_filters').hide();
					form.find('#fl-field-cat_filter_align').show();
					form.find('#fl-field-filters_heading_text').hide();
				}

			} else {
				form.find('#fl-builder-settings-section-section_style_navigation').show();
				form.find('#fl-builder-settings-section-section_style_title_filters').hide();
				form.find('#fl-builder-settings-section-section_style_cat_filters').hide();
				form.find('#fl-field-row_gap').hide();

				if( 'yes' === form.find('select[name=enable_arrow]').val() ) {
				
					form.find('#fl-builder-settings-section-section_style_navigation').show();
				}
				else {

					form.find('#fl-builder-settings-section-section_style_navigation').hide();
				}
			}
			if( 'no' === show_filter_val && 'no' === show_filter_title_val && 'no' === show_caption_val && 'no' === show_tag_val ) {
				settings_tab.find('a').eq( 2 ).hide();
			}
			else{
				settings_tab.find('a').eq( 2 ).show();
			}
		},
		_changeCategory: function() {

			var form 			= $('.fl-builder-settings');

			if( form.find('select[name=show_filter]').val() === 'yes' ) {

				 if( form.find('select[name=default_filter_switch]' ).val() === 'yes' ){

				 	form.find('#fl-field-default_filter').show();

				 } else{

				 	form.find('#fl-field-default_filter').hide();

				 }
				  if( form.find('select[name=show_filter_title]' ).val() === 'yes' ){

				  		form.find('#fl-field-filters_heading_text').show();

				  } else {

				  		form.find('#fl-field-filters_heading_text').hide();
				  }
					
			} else {

				form.find('#fl-field-default_filter').hide();
				form.find('#fl-field-filters_heading_text').hide();
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