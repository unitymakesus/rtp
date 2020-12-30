(function($){

	FLBuilder.registerModuleHelper('info-box', {

		init: function()
		{
			var form    		= $('.fl-builder-settings'),
				image_type 		= form.find('select[name=image_type]'),
				icon_style		= form.find('select[name=icon_style]'),
				image_style		= form.find('select[name=image_style]'),
				photoSource     = form.find('select[name=photo_source]'),
				librarySource   = form.find('select[name=photo_src]'),
				urlSource       = form.find('input[name=photo_url]'),
				ctaType     	= form.find('select[name=cta_type]'),
				align       	= form.find('select[name=align]'),
				mobile_align    = form.find('select[name=mobile_align]'),
				icon_position 	= form.find('select[name=img_icon_position]'),
				btn_flat_button_options = form.find('select[name=btn_flat_button_options]'),
				btn_style 			= form.find('select[name=btn_style]'),
				enable_separator 	= form.find('select[name=enable_separator]'),
				separator_width 	= form.find('input[name=separator_width]'),
				mobile_view 		= form.find('select[name=mobile_view]'),
				
				border_top 			= form.find('input[name=uabb_border_top]'),
				border_bottom 		= form.find('input[name=uabb_border_bottom]'),
				border_left 		= form.find('input[name=uabb_border_left]'),
				border_right 		= form.find('input[name=uabb_border_right]'),
				bg_color 			= form.find('input[name=bg_color]'),
				bg_gradient_one 	= form.find('input[name="bg_gradient[][color_one]"]'),
				bg_gradient_two 	= form.find('input[name="bg_gradient[][color_two]"]'),
				border_type 		= form.find('select[name=uabb_border_type]'),
				bg_type 			= form.find('select[name=bg_type]');
				info_title			= form.find('input[name=title]');
				info_title_perfix	= form.find('input[name=heading_prefix]');


			// Init validation events.
			/*this._imageTypeChanged();*/
			this._ctaTypeChanged();
			this._toggleImageIcon();
			//this._mobileViewChange();
			this._flatBtnOption();
			this._widthToggle();
			this._InfoBoxPadding();

			
			// Validation events.
			/*imageType.on('change', this._imageTypeChanged);*/
			ctaType.on('change', this._ctaTypeChanged);
			photoSource.on('change', $.proxy( this._photoSourceChanged, this ) );
			image_type.on('change', $.proxy( this._toggleImageIcon, this ) );
			icon_position.on('change', $.proxy( this._toggleImageIcon, this ) );
			icon_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			image_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			mobile_view.on('change', this._toggleImageIcon);
			btn_flat_button_options.on('change', this._flatBtnOption);
			btn_style.on('change', this._flatBtnOption);

			enable_separator.on('change', this._widthToggle);
			separator_width.on('keyup', this._widthToggle);
			// Preview events.
			align.on('change', this._previewAlign);

			// Padding option toggle
			border_top.on('change', this._InfoBoxPadding);
			border_bottom.on('change', this._InfoBoxPadding);
			border_left.on('change', this._InfoBoxPadding);
			border_right.on('change', this._InfoBoxPadding);
			bg_color.on('change', this._InfoBoxPadding);
			bg_gradient_one.on('change', this._InfoBoxPadding);
			bg_gradient_two.on('change', this._InfoBoxPadding);
			border_type.on('change', this._InfoBoxPadding);
			bg_type.on('change', this._InfoBoxPadding);
			info_title.on('change',this._InfoBoxTitle);
			info_title_perfix.on('change',this._InfoBoxTitlePerfix);

			UABBButton.init();
			
		},
		_InfoBoxPadding: function() {
			window.setTimeout(function(){
				var form    			= $('.fl-builder-settings'),
					border_top 			= form.find('input[name=uabb_border_top]').val(),
					border_bottom 		= form.find('input[name=uabb_border_bottom]').val(),
					border_left 		= form.find('input[name=uabb_border_left]').val(),
					border_right 		= form.find('input[name=uabb_border_right]').val(),
					bg_color 			= form.find('input[name=bg_color]').val(),
					bg_gradient_one 	= form.find('input[name="bg_gradient[][color_one]"]').val(),
					bg_gradient_two 	= form.find('input[name="bg_gradient[][color_two]"]').val(),
					border_type 		= form.find('select[name=uabb_border_type]').val(),
					infoBoxPadding 		= form.find('#fl-field-info_box_padding_dimension'),
					bg_type 			= form.find('select[name=bg_type]').val();
				
				infoBoxPadding.hide();
	
				var border = (border_type != 'none' && ( border_top > 0 || border_left > 0 || border_bottom > 0 || border_right > 0 ));
				
				var bg = ( bg_type == 'color' ? bg_color != '' : ( bg_type == 'gradient' ? (bg_gradient_one != '' && bg_gradient_two != '') : false ) ) ;
	
				if( border || bg ) {
					infoBoxPadding.show();
				}
			}, 100);
		},

		_widthToggle: function() {
			
			var form        = $('.fl-builder-settings'),
				enable_separator 	= form.find('select[name=enable_separator]').val(),
				separator_width = form.find('input[name=separator_width]').val();
				
			if( enable_separator == 'block' ) {
				form.find('#fl-field-separator_color').show();
				form.find('#fl-field-separator_height').show();
				form.find('#fl-field-separator_style').show();
				form.find('#fl-field-separator_width').show();
				form.find('#fl-builder-settings-section-separator_margins').show();
				if( separator_width != '' && parseInt( separator_width ) < 100 ) {
					form.find('#fl-field-separator_alignment').show();
				} else {
					form.find('#fl-field-separator_alignment').hide();
				}
			} else {
				form.find('#fl-field-separator_color').hide();
				form.find('#fl-field-separator_height').hide();
				form.find('#fl-field-separator_style').hide();
				form.find('#fl-field-separator_width').hide();
				form.find('#fl-field-separator_alignment').hide();
				form.find('#fl-builder-settings-section-separator_margins').hide();
			}
		},

		_flatBtnOption: function() {

			var form        = $('.fl-builder-settings'),
				cta_type 	= form.find('select[name=cta_type]').val(),
				btn_style = form.find('select[name=btn_style]').val(),
				btn_flat_button_options = form.find('select[name=btn_flat_button_options]').val();

			if( cta_type == 'button' ) {
				if( btn_style == 'flat' ) {
					if( btn_flat_button_options != 'none' ) {
						form.find('#fl-field-btn_icon_position').hide();
					} else {
						form.find('#fl-field-btn_icon_position').show();
					}
				} else {
					form.find('#fl-field-btn_icon_position').show();
				}
			}

		},

		_mobileViewChange: function() {
			var form        = $('.fl-builder-settings'),
				image_type 	= form.find('select[name=image_type]').val(),
				position = form.find('#fl-field-img_icon_position').find('select[name=img_icon_position]').val(),
				mobile_view = form.find('select[name=mobile_view]').val();

			

			if( image_type != 'none' ) {
				if( position == 'right' ) {
					if( mobile_view == 'stack' ) {
						form.find('#fl-field-stacking_order').show();
					} else {
						form.find('#fl-field-stacking_order').hide();
					}
					
				} else {
					form.find('#fl-field-stacking_order').hide();
				}
			} else {
				form.find('#fl-field-stacking_order').hide();
			}
		},
		
		_toggleBorderOptions: function() {
			var form		= $('.fl-builder-settings'),
				show_border = false
				image_type 	= form.find('select[name=image_type]').val(),
				icon_style 	= form.find('select[name=icon_style]').val(),
				border_style 	= form.find('select[name=icon_border_style]').val(),
				image_style 	= form.find('select[name=image_style]').val(),
				img_border_style 	= form.find('select[name=img_border_style]').val();

			
			if( image_type == 'icon' ){
				if( icon_style == 'custom'  ){
					show_border = true;
				}

				if( show_border == false ){
					form.find('#fl-field-icon_border_width').hide();
					form.find('#fl-field-icon_border_color').hide();
					form.find('#fl-field-icon_border_hover_color').hide();
				}else if( show_border ){
					if ( border_style != 'none' ) {
						form.find('#fl-field-icon_border_width').show();
						form.find('#fl-field-icon_border_color').show();
						form.find('#fl-field-icon_border_hover_color').show();
					}
				}
			}else if( image_type == 'photo' ){
				if( image_style == 'custom' ){
					show_border = true;
				}

				if( show_border == false ){
					form.find('#fl-field-img_border_width').hide();
					form.find('#fl-field-img_border_color').hide();
					form.find('#fl-field-img_border_hover_color').hide();
				}else if( show_border ){
					if ( img_border_style != 'none' ) {
						form.find('#fl-field-img_border_width').show();
						form.find('#fl-field-img_border_color').show();
						form.find('#fl-field-img_border_hover_color').show();
					}
				}
			}
		},
		_toggleImageIcon: function() {
			var form        = $('.fl-builder-settings'),
				show_color 	= false,
				image_type 	= form.find('select[name=image_type]').val(),
				position = form.find('#fl-field-img_icon_position').find('select[name=img_icon_position]').val(),
				mobile_view = form.find('#fl-field-mobile_view').find('select[name=mobile_view]').val(),
				image_style = form.find('select[name=image_style]').val();

			form.find('#fl-builder-settings-section-img_icon_margins').hide();
			
			if( image_type == 'photo' && image_style == 'custom' ){
				show_color = true;
			}

			if( image_type != 'none' ) {
				if( position == 'right' ) {
					if( mobile_view == 'stack' ) {
						form.find('#fl-field-stacking_order').show();
					} else {
						form.find('#fl-field-stacking_order').hide();
					}
				} else {
					form.find('#fl-field-stacking_order').hide();
				}
			} else {
				form.find('#fl-field-stacking_order').hide();
			}

			if( show_color == false ){
				form.find('#fl-builder-settings-section-img_colors').hide();
			}else if( show_color ){
				form.find('#fl-builder-settings-section-img_colors').show();
			}
			if( image_type == 'icon' ) {
				form.find('#fl-builder-settings-section-icon_basic').show();
				form.find('#fl-builder-settings-section-icon_style').show();
				form.find('#fl-builder-settings-section-icon_colors').show();
				//form.find('#fl-builder-settings-section-img_icon_margins').show();

				form.find('#fl-builder-settings-section-img_basic').hide();
				form.find('#fl-builder-settings-section-img_style').hide();
				
				form.find('#fl-field-img_icon_position').show();
				//form.find('#fl-field-align_items').show();
				//form.find('#fl-field-mobile_view').show();

				
				//console.log( position );
				if( position == 'above-title' || position == 'below-title' || position == 'left' || position == 'right' ) {
					form.find('#fl-builder-settings-section-img_icon_margins').show();
				}else{
					form.find('#fl-builder-settings-section-img_icon_margins').hide();
				}

				if( position == 'above-title' || position == 'below-title' ) {
					form.find('#fl-field-align').show();
					form.find('#fl-field-mobile_align').show();
				}else {
					form.find('#fl-field-align').hide();
					form.find('#fl-field-mobile_align').hide();
				}
				if( position == 'left' || position == 'right' ) {
					form.find('#fl-field-align_items').show();
					form.find('#fl-field-mobile_view').show();
					if( position == 'right' ) {
						if( mobile_view == 'stack' ) {
							form.find('#fl-field-stacking_order').show();
						} else {
							form.find('#fl-field-stacking_order').hide();
						}
					} else {
						form.find('#fl-field-stacking_order').hide();
					}
				} else if( position == 'left-title' || position == 'right-title' ) {
					form.find('#fl-field-align_items').show();
					form.find('#fl-field-mobile_view').hide();
					form.find('#fl-field-stacking_order').hide();
				} else {
					form.find('#fl-field-align_items').hide();
					form.find('#fl-field-mobile_view').hide();
					form.find('#fl-field-stacking_order').hide();
				}

			} else if( image_type == 'photo' ) {

				form.find('#fl-builder-settings-section-img_basic').show();
				form.find('#fl-builder-settings-section-img_style').show();

				form.find('#fl-builder-settings-section-icon_basic').hide();
				form.find('#fl-builder-settings-section-icon_style').hide();
				form.find('#fl-builder-settings-section-icon_colors').hide();

				form.find('#fl-field-img_icon_position').show();
				//form.find('#fl-field-align_items').show();
				//form.find('#fl-field-mobile_view').show();
				form.find('#fl-field-stacking_order').hide();

				form.find('#fl-builder-settings-section-img_icon_margins').show();
				
				
				if( position == 'above-title' || position == 'below-title' || position == 'left' || position == 'right' ) {
					form.find('#fl-builder-settings-section-img_icon_margins').show();
				}else{
					form.find('#fl-builder-settings-section-img_icon_margins').hide();
				}

				if( position == 'above-title' || position == 'below-title' ) {
					form.find('#fl-field-align').show();
					form.find('#fl-field-mobile_align').show();
				}else {
					form.find('#fl-field-align').hide();
					form.find('#fl-field-mobile_align').hide();
				}
				if( position == 'left' || position == 'right' ) {
					form.find('#fl-field-align_items').show();
					form.find('#fl-field-mobile_view').show();
					if( position == 'right' ) {
						if( mobile_view == 'stack' ) {
							form.find('#fl-field-stacking_order').show();
						} else {
							form.find('#fl-field-stacking_order').hide();
						}
					} else {
						form.find('#fl-field-stacking_order').hide();
					}
				} else if( position == 'left-title' || position == 'right-title' ) {
					form.find('#fl-field-align_items').show();
					form.find('#fl-field-mobile_view').hide();
					form.find('#fl-field-stacking_order').hide();
				} else {
					form.find('#fl-field-align_items').hide();
					form.find('#fl-field-mobile_view').hide();
					form.find('#fl-field-stacking_order').hide();
				}
			} else {

				form.find('#fl-builder-settings-section-icon_basic').hide();
				form.find('#fl-builder-settings-section-icon_style').hide();
				form.find('#fl-builder-settings-section-icon_colors').hide();
				form.find('#fl-builder-settings-section-img_basic').hide();
				form.find('#fl-builder-settings-section-img_style').hide();
				form.find('#fl-field-img_icon_position').hide();
				form.find('#fl-field-align_items').hide();
				form.find('#fl-field-mobile_view').hide();
				form.find('#fl-field-stacking_order').hide();
				form.find('#fl-field-align').show();
				form.find('#fl-field-mobile_align').show();
			}

			this._toggleBorderOptions();
			this._photoSourceChanged();
		},
		_photoSourceChanged: function()
		{
			var form            = $('.fl-builder-settings'),
				image_type	 	= form.find('select[name=image_type]').val(),
				photoSource     = form.find('select[name=photo_source]').val(),
				photo           = form.find('input[name=photo]'),
				photoUrl        = form.find('input[name=photo_url]'),
				iconSize        = form.find('input[name=icon_size]'),
				imgSize        	= form.find('input[name=img_size]');


			photo.rules('remove');
			photoUrl.rules('remove');
			iconSize.rules('remove');
			imgSize.rules('remove');
			if ( image_type == 'photo' ) {
				if(photoSource == 'library') {
					photo.rules('add', { required: true });
				}
				else {
					photoUrl.rules('add', { required: true });
				}
				imgSize.rules('add', { number:true });
			}else if ( image_type == 'icon' ) {
				iconSize.rules('add', { number:true });
			}
		},
		/*_imageTypeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				imageType   = form.find('select[name=image_type]').val(),
				photo       = form.find('input[name=photo]'),
				icon       = form.find('input[name=icon]');
				
			photo.rules('remove');
			icon.rules('remove');
			
			if(imageType == 'photo') {
				photo.rules('add', { required: true });
			}
			else if(imageType == 'icon') {
				icon.rules('add', { required: true });
			}
		},*/
		
		_ctaTypeChanged: function()
		{
			var form    = $('.fl-builder-settings'),
				ctaType = form.find('select[name=cta_type]').val(),
				ctaText = form.find('input[name=cta_text]');
				
			ctaText.rules('remove');
			
			if(ctaType != 'none') {
				ctaText.rules('add', {
					required: true
				});
			}
		},
		
		_previewAlign: function()
		{
			var form   = $('.fl-builder-settings'),
				align  = form.find('select[name=align]').val(),
				wrap   = FLBuilder.preview.elements.node.find('.infobox');
				
			wrap.removeClass('infobox-left');
			wrap.removeClass('infobox-center');
			wrap.removeClass('infobox-right');
			wrap.addClass('infobox-' + align);
		},
		_InfoBoxTitle: function(){
			var form  	= $('.fl-builder-settings');
				title 	= form.find('input[name=title]').val();
				node 	= jQuery(this).closest( 'form' ).attr( 'data-node' );
			if(title==''){
				jQuery('.fl-node-' + node).find('.uabb-infobox-title').hide();
			}
			else{
				jQuery('.fl-node-' + node).find('.uabb-infobox-title').show();
			}	
		},
		_InfoBoxTitlePerfix:function(){
			var form  			= $('.fl-builder-settings');
				title_perfix	= form.find('input[name=heading_prefix]').val();
				node 			= jQuery(this).closest( 'form' ).attr( 'data-node' );
			if(title_perfix==''){
				jQuery('.fl-node-' + node).find('.uabb-infobox-title-prefix').hide();
			}
			else{
				jQuery('.fl-node-' + node).find('.uabb-infobox-title-prefix').show();
			}
		}
	});

})(jQuery);