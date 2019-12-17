(function($){

	FLBuilder.registerModuleHelper('uabb-table', {

        init: function()
		{
			var form 			= $('.fl-builder-settings'),
				file_edit		= form.find('#fl-builder-settings-tab-headrow #fl-field-file_src a.fl-video-select'),
				form_edit 		= form.find('#fl-builder-settings-tab-bodyrows .fl-form-field-edit'),
				form_file_img_preview = form.find('#fl-builder-settings-tab-headrow #fl-field-file_src div.fl-video-preview-img'),
				file_type = form.find('select[name=table_type]'),
				entries_dropdown = form.find('select[name=show_entries]'),
				replace_file = form.find('#fl-builder-settings-tab-headrow #fl-field-file_src a.fl-video-replace'),
				remove_file = form.find('#fl-builder-settings-tab-headrow #fl-field-file_src a.fl-video-remove'),
				search_field = form.find('select[name=show_search]');

			file_type.on('change', this._hideImageSettings);

			entries_dropdown.on('change', this._hideFeaturesStyles);
			search_field.on('change', this._hideFeaturesStyles);
			
			file_edit.text('Select CSV File');
			form_edit.text('Edit Row / Cell');
			replace_file.text('Replace File');
			remove_file.text('Remove File');
			form_file_img_preview.css('display', 'none');
			this._hideDocs();
		},

		_hideImageSettings: function() {
			var form 			= $('.fl-builder-settings'),
				file_type_val	= form.find('select[name=table_type]').val();
	
			if ( 'file' == file_type_val ) {
				form.find('#fl-builder-settings-section-body_image_styles').hide();
				form.find('#fl-builder-settings-section-head_image_styles').hide();
			}
			else {
				form.find('#fl-builder-settings-section-body_image_styles').show();
				form.find('#fl-builder-settings-section-head_image_styles').show();
			}
		},

		_hideFeaturesStyles: function() {
			var form 			= $('.fl-builder-settings'),
				entries_dropdown_val	= form.find('select[name=show_entries]').val(),
				search_field_val	= form.find('select[name=show_search]').val();

			if ( 'yes' == entries_dropdown_val || 'yes' == search_field_val ) {
				form.find('#fl-builder-settings-section-features_styles').show();
			}
			else {
				form.find('#fl-builder-settings-section-features_styles').hide();
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