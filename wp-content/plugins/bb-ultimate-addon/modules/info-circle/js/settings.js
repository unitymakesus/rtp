(function($){

	FLBuilder.registerModuleHelper('info-circle', {
		
		init: function()
		{
			var form = $('.fl-builder-settings');
			
			// Init validation events.
			this._toggleIconBorderOptions();
			
			// Validation events.
			form.find('select[name=info_area_icon]').on('change', this._toggleIconBorderOptions);
			
		},
		
		_toggleIconBorderOptions: function()
		{
			var form            = $('.fl-builder-settings'),
				infoAreaIcon    = form.find('select[name=info_area_icon]').val(),
				iconBorderStyle = form.find('select[name=info_icon_img_border_style]').val(),
				iconBorderWidth = form.find('#fl-field-info_icon_img_border_width'),
				iconBorderColor = form.find('#fl-field-info_icon_img_border_color');
				
			if(infoAreaIcon == 'no' || infoAreaIcon == 'simple') {
				iconBorderWidth.css('display','none');
				iconBorderColor.css('display','none');
			} else if( iconBorderStyle != 'none' ) {
				iconBorderWidth.css('display','table-row');
				iconBorderColor.css('display','table-row');
			}
		},
	});

	FLBuilder.registerModuleHelper('info_circle_items_form', {
		
		init: function()
		{
			var form = $('.fl-builder-settings'),
				cta_select = form.find('select[name=cta]'),
				btn_style   = form.find('select[name=btn_style]'),
				btn_style_opt   = form.find('select[name=btn_flat_button_options]');
			
			// Init validation events.
			this._toggleActivePhotoOptions();
			this._toggleCTAOptions();
			
			//Button Validation events.
			this.buttonicon_postion();
			btn_style.on('change',  $.proxy( this.buttonicon_postion, this ) );
			btn_style_opt.on('change',  $.proxy( this.buttonicon_postion, this ) );
			

			// Validation events.
			form.find('select[name=photo_active_type]').on('change', this._toggleActivePhotoOptions);
			cta_select.on('change', this._toggleCTAOptions);

			var current_trigger = form.find('select[name=info_trigger_type]').val();
			
			if( current_trigger == 'click' ) {
				var cta_val = cta_select.val();
				var cta_html = none_selected = desc_selected = '';
				
				if( cta_val == 'none' || cta_val == 'icon' ) {
					none_selected = 'selected="selected"';
				} else {
					desc_selected = 'selected="selected"';
				}

				cta_html += '<option ' + none_selected + ' value="none">None</option>';
				cta_html += '<option ' + desc_selected + ' value="desc">In Description</option>';

				cta_select.html(cta_html);
				cta_select.trigger('change');
			}

			// Separator Color Dependency
			var separator_enabled = form.find('select[name=info_separator_style]').val();
			if( separator_enabled == 'none' ) {
				form.find('#fl-field-separator_color').css('display','none');
			}

			// Remove Full Width option from CTA Button Width
			form.find('select[name=btn_width]').find('option[value="full"]').remove();

			UABBButton.init();
		},

		buttonicon_postion: function () {
            var form        = $('.fl-builder-settings'),
                creative_button_styles     = form.find('select[name=btn_style]').val();
                flat_button_options     = form.find('select[name=btn_flat_button_options]').val();

                if ( creative_button_styles == 'flat' && flat_button_options != 'none' ) {
                    setTimeout(function(){
                        jQuery("#fl-field-btn_icon_position").hide();
                    },100);
                }else{
                    jQuery("#fl-field-btn_icon_position").show();
                } 
        },

		_toggleActivePhotoOptions: function()
		{
			var form            = $('.fl-builder-settings'),
				activeEffect    = form.find('select[name=photo_active_type]').val(),
				activePhotoSrc 	= form.find('select[name=active_photo_source]').val(),
				activePhoto 	= form.find('#fl-field-active_photo'),
				activePhotoUrl 	= form.find('#fl-field-active_photo_url');
				
			if( activeEffect != 'change-img' ) {
				activePhoto.css('display','none');
				activePhotoUrl.css('display','none');

			} else if( activePhotoSrc == 'library' ) {
				activePhoto.css('display','table-row');
				activePhotoUrl.css('display','none');

			} else if( activePhotoSrc == 'url' ) {
				activePhoto.css('display','none');
				activePhotoUrl.css('display','table-row');

			}
		},

		_toggleCTAOptions: function() {
			var form            = $('.fl-builder-settings'),
				cta    			= form.find('select[name=cta]').val(),
				cta_type 		= form.find('select[name=desc_cta_type]').val(),
				cta_btn_tab 	= form.find('a[href="#fl-builder-settings-tab-cta_button"]');
			
			if( cta == 'none' || cta == 'icon' ) {
				// console.log(cta_btn_tab);
				cta_btn_tab.css( 'display', 'none' );

			} else if( cta_type == 'button' ) {
				cta_btn_tab.css( 'display', 'inline-block' );

			}
		},

	});

})(jQuery);