(function($){

	FLBuilder.registerModuleHelper('interactive-banner-1', {
		
		rules: {
			banner_image: {
				required: true
			}
		},
        init: function()
        {
            var a = $('.fl-builder-interactive-banner-1-settings').find('.fl-builder-settings-tabs a');

            a.on('click', this._toggleHoverAndTypographyTabs);
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._toggleAfterRender );
        },
        _toggleHoverAndTypographyTabs: function() {
            var anchorHref = $(this).attr('href');
            var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-hover' || anchorHref == '#fl-builder-settings-tab-typography' ){
                jQuery('.fl-node-' + node + ' .uabb-ib1-block').addClass('uabb-ib1-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-ib1-block').removeClass('uabb-ib1-hover');
            }
        },

        _toggleAfterRender: function() {

            jQuery('.uabb-ib1-block').each(function(index, value){
                if( jQuery( this ).hasClass( "uabb-banner-block-custom-height" ) ) {
                    var heading_ht = jQuery(this).find('.uabb-ib1-title').outerHeight();
                    var custom_ht = jQuery(this).outerHeight();
                    var ht = ( custom_ht - heading_ht );
                    jQuery(this).find(".uabb-background").css('height', ht);
                    if( jQuery( this ).width() > jQuery( this ).height() ) {
                        jQuery( this ).find('.uabb-image-wrap img').css( 'width', '100%' );
                        jQuery( this ).find('.uabb-image-wrap img').css( 'height', 'auto' );
                    }
                }
            });
            
            var anchorHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );
            var node = jQuery( '.fl-builder-settings-tabs a' ).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-hover' || anchorHref == '#fl-builder-settings-tab-typography' ){
                jQuery('.fl-node-' + node + ' .uabb-ib1-block').addClass('uabb-ib1-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-ib1-block').removeClass('uabb-ib1-hover');
            }
        },
	});

    FLBuilder.registerModuleHelper('button_form_field', {

        init: function()
        {
            var form        = $('.fl-builder-settings'),
                flat_button_options = form.find('select[name=flat_button_options]'),
                transparent_button_options = form.find('select[name=transparent_button_options]'),
                hover_attribute = form.find('select[name=hover_attribute]'),
                style = form.find('select[name=style]');
            
            this._flatBtnOption();

            transparent_button_options.on( 'change', $.proxy( this._flatBtnOption, this ) );
            flat_button_options.on('change', this._flatBtnOption);
            style.on('change', this._flatBtnOption);
            hover_attribute.on( 'change', $.proxy( this._flatBtnOption, this ) );
        },

        _flatBtnOption: function() {
            var form        = $('.fl-builder-settings'),
                style = form.find('select[name=style]').val(),
                transparent_button_options = form.find('select[name=transparent_button_options]').val(),
                hover_attribute = form.find('select[name=hover_attribute]').val(),
                flat_button_options = form.find('select[name=flat_button_options]').val();

            // console.log(style);

            // console.log(flat_button_options);

            if( style == 'flat' ) {
                if( flat_button_options != 'none' ) {
                    form.find('#fl-field-icon_position').hide();
                } else {
                    form.find('#fl-field-icon_position').show();
                }
            } else {
                form.find('#fl-field-icon_position').show();
            }

            if( style == 'threed' ) {
                form.find('#fl-field-threed_button_options').show();
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find("#fl-field-border_size").hide();
                form.find("#fl-field-transparent_button_options").hide();
                form.find('#fl-field-flat_button_options').hide();
            } else if( style == 'flat' ) {
                form.find('#fl-field-flat_button_options').show();
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find("#fl-field-border_size").hide();
                form.find("#fl-field-transparent_button_options").hide();
            } else if( style == 'transparent' ) {
                form.find("#fl-field-border_size").show();
                form.find("#fl-field-transparent_button_options").show();
                form.find('#fl-field-threed_button_options').hide();
                form.find('#fl-field-flat_button_options').hide();
                form.find('#fl-field-bg_color th label').text('Border Color');
                if( transparent_button_options == 'none' ) {
                    form.find("#fl-field-hover_attribute").show();
                    if( hover_attribute == 'bg' ) {
                        form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                    } else {
                        form.find('#fl-field-bg_hover_color th label').text('Border Hover Color');
                    }
                } else {
                    form.find("#fl-field-hover_attribute").hide();
                    form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                }
            } else {
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find("#fl-field-border_size").hide();
                form.find("#fl-field-transparent_button_options").hide();
                form.find('#fl-field-threed_button_options').hide();
                form.find('#fl-field-flat_button_options').hide();
            }
        }

    });

})(jQuery);