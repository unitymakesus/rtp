(function($){
	FLBuilder.registerModuleHelper('dual-button', {
		rules: {
			button_one_link: {
				required: true
			},
			button_two_link: {
				required: true
			},
		},

		init: function()
		{
			var form        = $('.fl-builder-settings'),
				image_type   = form.find('select[name=image_type_btn_one]'),
				photo_soruce_type   = form.find('select[name=photo_source_btn_one]'),
				image_type_btn_two   = form.find('select[name=image_type_btn_two]'),
				photo_soruce_type_btn_two   = form.find('select[name=photo_source_btn_two]'),
				divider_image_option   = form.find('select[name=divider_options]'),
				button_style   = form.find('select[name=dual_button_style]'),
				button_sub_style   = form.find('select[name=flat_button_options]'),
				join_buttons = form.find('select[name=join_buttons]'),
				dual_button_type = form.find('select[name=dual_button_type]');
				
				

			if ( image_type.val() == "none" ) {
				jQuery("#fl-field-photo_url_btn_one").hide();
				jQuery("#fl-field-photo_btn_one").hide();
			}
			if ( image_type_btn_two.val() == "none" ) {
				jQuery("#fl-field-photo_url_btn_two").hide();
				jQuery("#fl-field-photo_btn_two").hide();
			}
			if ( divider_image_option.val() != "photo" ) {
				jQuery("#fl-field-divider_photo").hide();
				jQuery("#fl-field-divider_photo_url").hide();	
			}

			this.imgicon_postion();
			this.btnTypeChanged();

			// Validation events.
			image_type.on('change', $.proxy( this.photo_type_changed, this ) );
			image_type_btn_two.on('change', $.proxy( this.photo_type_changed_btn_two, this ) );
			divider_image_option.on('change', $.proxy( this.divider_photo_type_changed, this ) );
			button_style.on('change', $.proxy( this.button_style_changed, this ) );
			button_sub_style.on('change', $.proxy( this.button_style_changed, this ) );
			join_buttons.on('change', $.proxy( this.btnTypeChanged, this ) );
			dual_button_type.on('change', $.proxy( this.btnTypeChanged, this ) );
			
		},
		btnTypeChanged: function() {
			var form        = $('.fl-builder-settings'),
				join_buttons = form.find('select[name=join_buttons]').val(),
				dual_button_type = form.find('select[name=dual_button_type]').val(),
				divider_options = form.find('select[name=divider_options]').val();

			if( dual_button_type == 'horizontal' ) {
				if( join_buttons == 'no' ) {
					form.find('#fl-field-spacing_between_buttons').show();
					form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-dual_button_divider"]').hide();
					form.find('#fl-builder-settings-section-divider_text').hide();
				} else {
					form.find('#fl-field-spacing_between_buttons').hide();
					form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-dual_button_divider"]').show();
					if( divider_options == 'text' ) {
						form.find('#fl-builder-settings-section-divider_text').show();
					} else {
						form.find('#fl-builder-settings-section-divider_text').hide();
					}
				}
			} else {
				form.find('#fl-field-spacing_between_buttons').hide();
				form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-dual_button_divider"]').show();
				if( divider_options == 'text' ) {
					form.find('#fl-builder-settings-section-divider_text').show();
				} else {
					form.find('#fl-builder-settings-section-divider_text').hide();
				}
			}
				
		},
		imgicon_postion: function () {
			var form        = $('.fl-builder-settings'),
				image_type   = form.find('select[name=image_type_btn_one]').val(),
				image_type_btn_two   = form.find('select[name=image_type_btn_two]').val(),
				dual_button_style 	= form.find('select[name=dual_button_style]').val(),
				flat_button_options 	= form.find('select[name=flat_button_options]').val();

				if ( dual_button_style == 'flat' && flat_button_options != 'none' ) {
					setTimeout(function(){
						jQuery("#fl-field-icon_position_btn_one").hide();
						jQuery("#fl-field-icon_position_btn_two").hide();
					},100);
				}else{
					if( image_type != 'none' ){
							jQuery("#fl-field-icon_position_btn_one").show();
					}
					if ( image_type_btn_two != 'none' ){
							jQuery("#fl-field-icon_position_btn_two").show();
					}
				} 
		},
		photo_type_changed: function()
		{

			var form        = $('.fl-builder-settings'),
				image_type   = form.find('select[name=image_type_btn_one]').val(),
				photo_soruce_type   = form.find('select[name=photo_source_btn_one]').val();
	
	
			if( photo_soruce_type == 'library' ) {
				setTimeout(function(){
					jQuery("#fl-field-photo_url_btn_one").hide();
				},100);
				jQuery("#fl-field-photo_btn_one").show();
			}
			else if( photo_soruce_type == 'url' ) {
				jQuery("#fl-field-photo_url_btn_one").show();
				setTimeout(function(){
					jQuery("#fl-field-photo_btn_one").hide();
				},100);
			}
			this.imgicon_postion();
		},
		photo_type_changed_btn_two: function()
		{

			var form        = $('.fl-builder-settings'),
				image_type_btn_two   = form.find('select[name=image_type_btn_two]').val(),
				photo_soruce_type_btn_two   = form.find('select[name=photo_source_btn_two]').val();
	
	
			if( photo_soruce_type_btn_two == 'library' ) {
				setTimeout(function(){
					jQuery("#fl-field-photo_url_btn_two").hide();
				},100);
				jQuery("#fl-field-photo_btn_two").show();
			}
			else if( photo_soruce_type_btn_two == 'url' ) {
				jQuery("#fl-field-photo_url_btn_two").show();
				setTimeout(function(){
					jQuery("#fl-field-photo_btn_two").hide();
				},100);
			}
			this.imgicon_postion();
		},
		divider_photo_type_changed: function()
		{
			var form        = $('.fl-builder-settings'),
				divider_image_option   = form.find('select[name=divider_options]').val(),
				divider_photo_source   = form.find('select[name=divider_photo_source]').val();
	
	
			if( divider_photo_source == 'library' ) {
				setTimeout(function(){
					jQuery("#fl-field-divider_photo_url").hide();
				},100);
				jQuery("#fl-field-divider_photo").show();
			}
			else if( divider_photo_source == 'url' ) {
				jQuery("#fl-field-divider_photo_url").show();
				setTimeout(function(){
					jQuery("#fl-field-divider_photo").hide();
				},100);
			}
		},
		button_style_changed: function()
		{
			var form        = $('.fl-builder-settings'),
			button_style   = form.find('select[name=dual_button_style]').val(),
			button_sub_style   = form.find('select[name=flat_button_options]').val(),
			button_one_img_type   = form.find('select[name=image_type_btn_one]'),
			button_two_img_type   = form.find('select[name=image_type_btn_two]');
			
				
			button_one_img_type.rules('remove');
			button_two_img_type.rules('remove');

			
			if(button_style == 'flat' && button_sub_style != 'none' ) {
				button_one_img_type.rules('add', { required: true });
				button_two_img_type.rules('add', { required: true });

			}

			this.imgicon_postion();
		},
	});

})(jQuery);