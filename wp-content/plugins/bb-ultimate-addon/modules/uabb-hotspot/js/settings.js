(function($){

	FLBuilder.registerModuleHelper('uabb-hotspot', {

		rules: {
			'photo': {
				required: true
			}
		},

		init: function() {

            this._hideDocs();
        },
         /**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.16.1
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

	FLBuilder.registerModuleHelper('hotspot_coordinates_form', {

        init: function()
        {
            var form                    = $('.fl-form-field-settings'),
                hotspot_marker_type		= form.find('select[name=hotspot_marker_type]'),
                on_click_action         = form.find('select[name=on_click_action]'),
                tooltip_style           = form.find('select[name=tooltip_style]'),
                icon_style              = form.find('select[name=icon_style]'),
                image_style             = form.find('select[name=image_style]'),
                photo_source            = form.find('select[name=photo_source]'),
                img_border_style        = form.find('select[name=img_border_style]'),
                icon_border_style        = form.find('select[name=icon_border_style]'),
                img_src = $('.fl-builder-uabb-hotspot-settings').find('#fl-field-photo .fl-photo-preview .fl-photo-preview-controls select').val();
            
            form.find('.uabb-hotspot-draggable').append('<img src="'+img_src+'" />');

            this._imageTypeChange();

            tooltip_style.on('change',  $.proxy( this._imageTypeChange, this ) );
            hotspot_marker_type.on('change',  $.proxy( this._imageTypeChange, this ) );
            on_click_action.on('change',  $.proxy( this._imageTypeChange, this ) );
            icon_style.on('change',  $.proxy( this._imageTypeChange, this ) );
            image_style.on('change',  $.proxy( this._imageTypeChange, this ) );
            photo_source.on('change',  $.proxy( this._imageTypeChange, this ) );
            img_border_style.on('change',  $.proxy( this._imageTypeChange, this ) );
            icon_border_style.on('change',  $.proxy( this._imageTypeChange, this ) );

           
        },

        _imageTypeChange: function() {
        	var form          	= $('.fl-form-field-settings'),
                hotspot_marker_type		= form.find('select[name=hotspot_marker_type]').val(),
                on_click_action         = form.find('select[name=on_click_action]').val(),
                tooltip_style           = form.find('select[name=tooltip_style]').val(),
                image_style             = form.find('select[name=image_style]').val(),
                icon_style              = form.find('select[name=icon_style]').val(),
                tooltip_content_position = form.find('select[name=tooltip_content_position]').val(),
                photo_source            = form.find('select[name=photo_source]').val(),
                icon_border_style       = form.find('select[name=icon_border_style]').val(),
                img_border_style        = form.find('select[name=img_border_style]').val();

            if( hotspot_marker_type == 'photo' ) {
            	form.find('#fl-builder-settings-section-img_basic').show();
            	form.find('#fl-builder-settings-section-image_style').show();

                if( image_style != 'custom' ) {
                    form.find('#fl-builder-settings-section-img_colors').hide();
                    form.find('#fl-field-img_bg_size').hide();
                    form.find('#fl-field-img_border_style').hide();
                    form.find('#fl-field-img_border_width').hide();
                    form.find('#fl-field-img_bg_border_radius').hide();
                } else {
                    form.find('#fl-builder-settings-section-img_colors').show();
                    form.find('#fl-field-img_bg_size').show();
                    form.find('#fl-field-img_border_style').show();
                    if( img_border_style != 'none' ) {
                        form.find('#fl-field-img_border_width').show();
                    } else {
                        form.find('#fl-field-img_border_width').hide();
                    }
                    form.find('#fl-field-img_bg_border_radius').show();
                }

                if( photo_source == 'library' ) {
                    form.find('#fl-field-photo').show();
                    form.find('#fl-field-photo_url').hide();
                } else {
                    form.find('#fl-field-photo_url').show();
                    form.find('#fl-field-photo').hide();
                }

            	form.find('#fl-builder-settings-section-icon_basic').hide();
            	form.find('#fl-builder-settings-section-icon_style').hide();
            	form.find('#fl-builder-settings-section-icon_colors').hide();

                form.find('#fl-builder-settings-section-text_typography').hide();
            } else if( hotspot_marker_type == 'icon' ) {
            	form.find('#fl-builder-settings-section-img_basic').hide();
            	form.find('#fl-builder-settings-section-image_style').hide();
            	form.find('#fl-builder-settings-section-img_colors').hide();

            	form.find('#fl-builder-settings-section-icon_basic').show();
            	form.find('#fl-builder-settings-section-icon_style').show();
            	form.find('#fl-builder-settings-section-icon_colors').show();

                form.find('#fl-builder-settings-section-text_typography').hide();
                if( icon_style == 'simple' ) {
                    form.find('#fl-field-icon_border_color').hide();
                    form.find('#fl-field-icon_border_hover_color').hide();
                    form.find('#fl-field-icon_bg_color').hide();
                    form.find('#fl-field-icon_bg_color_opc').hide();
                    form.find('#fl-field-icon_bg_hover_color').hide();
                    form.find('#fl-field-icon_bg_hover_color_opc').hide();
                    form.find('#fl-field-icon_three_d').hide();
                    form.find('#fl-field-icon_border_width').hide();
                    form.find('#fl-field-icon_border_style').hide();
                    form.find('#fl-field-icon_bg_size').hide();
                    form.find('#fl-field-icon_bg_border_radius').hide();
                    form.find('#fl-field-icon_color_preset').hide();
                } else if( icon_style == 'circle' || icon_style == 'square' ) {
                    form.find('#fl-field-icon_bg_color').show();
                    form.find('#fl-field-icon_bg_color_opc').show();
                    form.find('#fl-field-icon_bg_hover_color').show();
                    form.find('#fl-field-icon_bg_hover_color_opc').show();
                    form.find('#fl-field-icon_three_d').show();
                    form.find('#fl-field-icon_border_width').hide();
                    form.find('#fl-field-icon_border_style').hide();
                    form.find('#fl-field-icon_bg_size').hide();
                    form.find('#fl-field-icon_bg_border_radius').hide();
                    form.find('#fl-field-icon_border_color').hide();
                    form.find('#fl-field-icon_border_hover_color').hide();
                    form.find('#fl-field-icon_color_preset').show();

                } else {
                    form.find('#fl-field-icon_bg_color').show();
                    form.find('#fl-field-icon_bg_color_opc').show();
                    form.find('#fl-field-icon_bg_hover_color').show();
                    form.find('#fl-field-icon_bg_hover_color_opc').show();
                    form.find('#fl-field-icon_three_d').show();
                    form.find('#fl-field-icon_border_style').show();
                    form.find('#fl-field-icon_color_preset').show();
                    if( icon_border_style != 'none' ) {
                        form.find('#fl-field-icon_border_width').show();
                        form.find('#fl-field-icon_border_color').show();
                        form.find('#fl-field-icon_border_hover_color').show();
                    } else {
                        form.find('#fl-field-icon_border_width').hide();
                        form.find('#fl-field-icon_border_color').hide();
                        form.find('#fl-field-icon_border_hover_color').hide();
                    }
                    form.find('#fl-field-icon_bg_size').show();
                    form.find('#fl-field-icon_bg_border_radius').show();
                }
                form.find('#fl-field-img_bg_size').hide();
                form.find('#fl-field-img_border_style').hide();
                form.find('#fl-field-img_border_width').hide();
                form.find('#fl-field-img_bg_border_radius').hide();
            } else {
                form.find('#fl-builder-settings-section-img_basic').hide();
                form.find('#fl-builder-settings-section-image_style').hide();
                form.find('#fl-builder-settings-section-img_colors').hide();
                form.find('#fl-builder-settings-section-icon_basic').hide();
                form.find('#fl-builder-settings-section-icon_style').hide();
                form.find('#fl-builder-settings-section-icon_colors').hide();
                
                form.find('#fl-builder-settings-section-text_typography').show();

                form.find('#fl-field-img_bg_size').hide();
                form.find('#fl-field-img_border_style').hide();
                form.find('#fl-field-img_border_width').hide();
                form.find('#fl-field-img_bg_border_radius').hide();
            }

            if( on_click_action != 'tooltip' && hotspot_marker_type != 'text' ) {
                form.find('a[href=#fl-builder-settings-tab-typography]').hide();
            } else {
                form.find('a[href=#fl-builder-settings-tab-typography]').show();
            }

            if( on_click_action == 'tooltip' ) {
                if( tooltip_style == 'classic' ) {
                    form.find('#fl-field-tooltip_content_position').show();
                    form.find("#fl-field-tooltip_content_position option[value='top']").remove();
                    form.find("#fl-field-tooltip_content_position option[value='bottom']").remove();
                    form.find("select[name=tooltip_content_position]").append( new Option("Top", "top") );
                    form.find("select[name=tooltip_content_position]").append( new Option("Bottom", "bottom") );
                    form.find("select[name=tooltip_content_position] option[value=" + tooltip_content_position + "]").prop("selected", true);
                } else if( tooltip_style == 'curved' ){
                    form.find('#fl-field-tooltip_content_position').show();
                    form.find("#fl-field-tooltip_content_position option[value='top']").remove();
                    form.find("#fl-field-tooltip_content_position option[value='bottom']").remove();
                    form.find("select[name=tooltip_content_position] option[value=" + tooltip_content_position + "]").prop("selected", true);
                } else if( tooltip_style == 'round' ) {
                    form.find('#fl-field-tooltip_content_position').hide();
                }
            }
        }
       
    });

})(jQuery);
