(function($){
	var enable_rating_global = '';

	FLBuilder.registerModuleHelper('adv-testimonials', {

		rules: {
			'testimonials[]': {
				required: true
			}
		},

		init: function() {
			var form        = $('.fl-builder-settings'),
				testimonial_layout   = form.find('select[name=tetimonial_layout]'),
				navigation_opt   = form.find('select[name=navigation]'),
				testimonial_icon_style_noslider = form.find('select[name=testimonial_icon_style_noslider]'),
				image_type_noslider = form.find('select[name=image_type_noslider]'),
				enable_rating = form.find('select[name=enable_rating]');

			enable_rating_global = enable_rating.val();
			
			// Init validation events.
			this._testimonial_layoutChanged();
			this.navigation_changed();
			this._iconStyleChanged();
			
			// Validation events.
			testimonial_icon_style_noslider.on('change', this._iconStyleChanged);
			image_type_noslider.on('change', this._iconStyleChanged);
			testimonial_layout.on('change', this._testimonial_layoutChanged);
			enable_rating.on('change', this._testimonial_layoutChanged);
			testimonial_layout.on('change', this.navigation_changed);
			//navigation_opt.on('change', this.navigation_changed);

			setTimeout(function(){
				testimonial_layout.trigger('change');
			},500);
		},

		_iconStyleChanged: function() {
			var form        = $('.fl-builder-settings'),
				testimonial_icon_style_noslider   = form.find('select[name=testimonial_icon_style_noslider]').val(),
				image_type_noslider = form.find('select[name=image_type_noslider]').val();

			if( image_type_noslider != 'icon' ) {
				if( testimonial_icon_style_noslider != 'custom' ) {
					form.find('#fl-field-testimonial_icon_bg_color_noslider').hide();
				} else {
					form.find('#fl-field-testimonial_icon_bg_color_noslider').show();
				}
			} else {
				form.find('#fl-field-testimonial_icon_bg_color_noslider').show();
			}
		},

		_testimonial_layoutChanged: function() {

			var form        = $('.fl-builder-settings'),
			testimonial_layout   = form.find('select[name=tetimonial_layout]').val(),
			testimonial_img_icon   = form.find('select[name=image_type]').val(),
			imagetype_noslider = form.find('select[name=image_type_noslider]').val(),
			enable_rating = form.find('select[name=enable_rating]').val();

			enable_rating_global = enable_rating;

			if( enable_rating == 'yes' ) {
				$("#fl-builder-settings-section-rating_typography").show();
			} else {
				$("#fl-builder-settings-section-rating_typography").hide();
			}

			if ( testimonial_layout == "slider" ) {
				form.find('#fl-field-box_rating').hide();
			} else {
				if( enable_rating == 'yes' ) {
					form.find('#fl-field-box_rating').show();
				} else {
					form.find('#fl-field-box_rating').hide();
				}
			}

			if ( testimonial_layout == "slider" ) {
				$("#fl-builder-settings-section-testimonial_image_icon_width").css({"display" : "block"});
				$("#fl-builder-settings-section-testimonial_image_icon_width_noslider").css({"display" : "none"});
				
				// Hide Other image icon upload fields
				jQuery("#fl-builder-settings-section-img_basic_noslider").css({ "display" : "none" });
				jQuery("#fl-builder-settings-section-icon_basic_noslider").css({ "display" : "none" });
			}else if ( testimonial_layout == "box" && testimonial_img_icon != "none" ) {
				$("#fl-builder-settings-section-testimonial_image_icon_width_noslider").css({"display" : "block"});
				$("#fl-builder-settings-section-testimonial_image_icon_width").css({"display" : "none"});


				// check for Other image icon upload fields
				if ( imagetype_noslider == "photo" ) {
					jQuery("#fl-builder-settings-section-img_basic_noslider").css({ "display" : "block" });
					jQuery("#fl-builder-settings-section-icon_basic_noslider").css({ "display" : "none" });
				}
				else if ( imagetype_noslider == "icon" ) {
					jQuery("#fl-builder-settings-section-img_basic_noslider").css({ "display" : "none" });
					jQuery("#fl-builder-settings-section-icon_basic_noslider").css({ "display" : "block" });
				}
			}else{
				$("#fl-builder-settings-section-testimonial_image_icon_width").css({"display" : "none"});
				$("#fl-builder-settings-section-testimonial_image_icon_width_noslider").css({"display" : "none"});
			}
		},

		navigation_changed:function() {
			var form        = $('.fl-builder-settings'),
			testimonial_layout   = form.find('select[name=tetimonial_layout]').val(),
			navigation   = form.find('select[name=navigation]').val();
			if ( testimonial_layout == "slider" ) {
				if ( navigation == "compact" ) {
					$("#fl-builder-settings-section-slider_arrow").css({"display":"block"});
					$("#fl-builder-settings-section-slider_dots").css({"display":"none"});
				}else if ( navigation == "wide" ) {
					$("#fl-builder-settings-section-slider_arrow").css({"display":"none"});
					$("#fl-builder-settings-section-slider_dots").css({"display":"block"});
				}else if ( navigation == "compact-wide" ) {
					$("#fl-builder-settings-section-slider_arrow").css({"display":"block"});
					$("#fl-builder-settings-section-slider_dots").css({"display":"block"});
				}
			}else{
				$("#fl-builder-settings-section-slider_arrow").css({"display":"none"});
				$("#fl-builder-settings-section-slider_dots").css({"display":"none"});
			}
		},
	});

	FLBuilder.registerModuleHelper('uabb_testimonials_form', {

        init: function()
        {
            var form = $('.fl-builder-settings ');

            if( enable_rating_global == 'yes' ) {
            	form.find('#fl-field-slider_rating').show();
            } else {
            	form.find('#fl-field-slider_rating').hide();
            }
        }

    });

})(jQuery);

jQuery(document).on( 'change' , '.testimonial_over_all_position', function(){
	if ( jQuery(this).val() == "top" && jQuery(".uabb-testimonial-layout-selection").val() == "box" ) {
		jQuery(".testimonial_half_outside_opt").closest('.fl-field').css({"display" : "table-row"});
	}else{
		jQuery(".testimonial_half_outside_opt").closest('.fl-field').css({"display" : "none"});
	}
});

jQuery(document).on( 'change' , '.uabb-testimonial-layout-selection', function(){
	if ( jQuery(this).val() == "box" && jQuery(".testimonial_over_all_position").val() == "top" ) {
		jQuery(".testimonial_half_outside_opt").closest('.fl-field').css({"display" : "table-row"});
	}else{
		jQuery(".testimonial_half_outside_opt").closest('.fl-field').css({"display" : "none"});
	}
});