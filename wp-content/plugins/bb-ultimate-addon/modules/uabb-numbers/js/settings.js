(function($){

	FLBuilder.registerModuleHelper('uabb-numbers', {
		
		init: function()
		{	
			var form    			= $('.fl-builder-uabb-numbers-settings'),
				image_type 			= form.find('select[name=image_type]'),
				icon_style			= form.find('select[name=icon_style]'),
				image_style			= form.find('select[name=image_style]'),
				photoSource     	= form.find('select[name=photo_source]'),
				librarySource   	= form.find('select[name=photo_src]'),
				urlSource       	= form.find('input[name=photo_url]'),
				layout       		= form.find('select[name=layout]'),
				show_separator  	= form.find('select[name=show_separator]'),
				separator_width		= form.find('input[name=separator_width]'),
				default_position 	= form.find('select[name=img_icon_position]'),
				circle_position 	= form.find('select[name=circle_position]');
			
			this._toggleImageIcon();
			this._toggleMaxNumber();
			this._toggleSeparatorAlignment();
			
			photoSource.on('change', $.proxy( this._photoSourceChanged, this ) );
			image_type.on('change', $.proxy( this._toggleImageIcon, this ) );
			image_type.on('change', $.proxy( this._toggleMaxNumber, this ) );
			default_position.on('change', $.proxy( this._toggleImageIcon, this ) );
			circle_position.on('change', $.proxy( this._toggleImageIcon, this ) );
			icon_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			image_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			form.find('select[name=layout]').on('change', this._toggleMaxNumber);
			form.find('select[name=number_type]').on('change', this._toggleMaxNumber);

			separator_width.on('keyup', $.proxy( this._toggleSeparatorAlignment, this ) );
			show_separator.on('change', $.proxy( this._toggleSeparatorAlignment, this ) );
		},

		_toggleSeparatorAlignment: function() {
			
			var form    			= $('.fl-builder-settings'),
				separator_width		= form.find('input[name=separator_width]').val(),
				show_separator  	= form.find('select[name=show_separator]').val(),
				separator_alignment	= form.find('#fl-field-separator_alignment');

			if( show_separator == 'yes' && separator_width != '' && separator_width < 100 ) {
				separator_alignment.show();				
			} else {
				separator_alignment.hide();
			}
		},


		/*_toggleStructureOptions: function() {
			var form    	= $('.fl-builder-settings'),
			layout       = form.find('select[name=layout]').val();
			if( layout == 'bars' ){
				form.find('#fl-builder-settings-section-overall_structure').hide();
			} else {
				form.find('#fl-builder-settings-section-overall_structure').show();
				if( layout == 'circle' ) {
					form.find('#fl-field-img_icon_position').hide();
				}
			}
		},*/
		
		_toggleMaxNumber: function()
		{	

			var form        = $('.fl-builder-settings'),
				layout  	= form.find('select[name=layout]').val(),
				image_type 	= form.find('select[name=image_type]').val(),
				numberType  = form.find('select[name=number_type]').val(),
				maxNumber   = form.find('#fl-field-max_number'),
				position 	= form.find('select[name=img_icon_position]').val(),
				show_separator = form.find('select[name=show_separator]').val(); 
			
			/* Hide Alignment */

			if( image_type == 'none' ){
				form.find('#fl-field-img_icon_position').hide();
				form.find('#fl-field-circle_position').hide();
				form.find('#fl-field-align').show();
			} else {
				if ( layout == 'default' ) {
					form.find('#fl-field-img_icon_position').show();
					form.find('#fl-field-circle_position').hide();
					form.find('#fl-field-align').show();
				}else if ( layout == 'circle' ) {
					form.find('#fl-field-img_icon_position').hide();
					form.find('#fl-field-circle_position').show();
					form.find('#fl-field-align').show();
				}else if ( layout == 'bars') {
					form.find('#fl-field-align').hide();
					form.find('#fl-field-img_icon_position').hide();
					form.find('#fl-field-circle_position').hide();
				}else if ( layout == 'semi-circle') {
					form.find('#fl-field-align').show();
					form.find('#fl-field-img_icon_position').hide();
					form.find('#fl-field-circle_position').hide();
				}
			}

			if ( layout == 'bars') {
				form.find('#fl-builder-settings-section-overall_structure').hide();
				form.find('#fl-builder-settings-section-seprator_margin_style').hide();
			}else{
				form.find('#fl-builder-settings-section-overall_structure').show();
				if( show_separator == 'yes' ){
					form.find('#fl-builder-settings-section-seprator_margin_style').show();
				}else{
					form.find('#fl-builder-settings-section-seprator_margin_style').hide();
				}

			}
			/*if( layout == 'default' ){
				form.find('#fl-field-img_icon_position').show();
			} else if( layout == 'circle' ) {
				if( layout == 'circle' ) {
					form.find('#fl-field-img_icon_position').hide();
				}
			}*/

			if ( 'default' == layout ) {
				if( position == 'right-title' || position == 'left-title' || position == 'left' || position == 'right' ) {
						form.find('#fl-builder-settings-section-overall_structure').hide();
				}
				else {
					form.find('#fl-builder-settings-section-overall_structure').show();
				}
				maxNumber.hide();
			}
			else if ( 'standard' == numberType ) {
				maxNumber.show();
			}
			else {
				maxNumber.hide();
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
				layout  	= form.find('select[name=layout]').val(),
				image_type 	= form.find('select[name=image_type]').val(),
				image_style = form.find('select[name=image_style]').val();
			
			
			form.find('#fl-builder-settings-section-img_icon_margins').show();
			if ( image_type == 'photo' || image_type == 'icon' ) {
				if ( layout == 'default' ) {
					var position = form.find('select[name=img_icon_position]').val();

					if( position == 'right-title' || position == 'left-title' || position == 'left' || position == 'right' ) {
						form.find('#fl-builder-settings-section-overall_structure').hide();
					}
					else {
						form.find('#fl-builder-settings-section-overall_structure').show();
					}

					if( position == 'above-title' || position == 'below-title' || position == 'left' || position == 'right' ) {
						form.find('#fl-builder-settings-section-img_icon_margins').show();
					}else{
						form.find('#fl-builder-settings-section-img_icon_margins').hide();
					}
				}else if( layout == 'circle'  ) {
					var position = form.find('select[name=circle_position]').val();
					if( position == 'above-title' || position == 'below-title' ) {
						form.find('#fl-builder-settings-section-img_icon_margins').show();
					}else{
						form.find('#fl-builder-settings-section-img_icon_margins').hide();
					}
				}else{
					form.find('#fl-builder-settings-section-img_icon_margins').hide();
				}
			}else{
				form.find('#fl-builder-settings-section-img_icon_margins').hide();
			}

			if( image_type == 'photo' && image_style == 'custom' ){
				show_color = true;
			}

			if( show_color == false ){
				form.find('#fl-builder-settings-section-img_colors').hide();
			}else if( show_color ){
				form.find('#fl-builder-settings-section-img_colors').show();
			}

			if( image_type == 'none' ){
				form.find('#fl-field-img_icon_position').hide();
				form.find('#fl-field-circle_position').hide();
			} else {
				if ( layout == 'default' ) {
					form.find('#fl-field-img_icon_position').show();
					form.find('#fl-field-circle_position').hide();
				}else if ( layout == 'circle' ) {
					form.find('#fl-field-img_icon_position').hide();
					form.find('#fl-field-circle_position').show();
				} else if ( layout == 'semi-circle' ) {
					form.find('#fl-field-img_icon_position').hide();
					form.find('#fl-field-circle_position').hide();
				}
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
				imgSize	        = form.find('input[name=img_size]');
				iconSize        = form.find('input[name=icon_size]');


			photo.rules('remove');
			photoUrl.rules('remove');
			imgSize.rules('remove');
			iconSize.rules('remove');

			if ( image_type == 'photo' ) {
				imgSize.rules('add', { number: true });
				if(photoSource == 'library') {
					photo.rules('add', { required: true });
				}
				else {
					photoUrl.rules('add', { required: true });
				}
			}else if ( image_type == 'icon' ) {
				iconSize.rules('add', { number:true });
			}
		}

	});

})(jQuery);