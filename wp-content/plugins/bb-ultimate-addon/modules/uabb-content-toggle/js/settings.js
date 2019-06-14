(function($){

    var styleToggleClass = '';
    
    FLBuilder.registerModuleHelper('uabb-content-toggle', {
        
        init: function()
        {
            var form        = $('.fl-builder-settings'),
                advanced    = form.find('select[name=advanced]'),
                border_type = form.find('select[name=border_type]'),
                border_width_head = form.find('select[name=border_width_head]'),
                border_color_head = form.find('select[name=border_color_head]'),
                advanced_sec = form.find('select[name=advanced_sec]'),
                border_type_sec = form.find('select[name=border_type_sec]'),
                border_width_sec = form.find('select[name=border_width_sec]'),
                border_color_sec = form.find('select[name=border_color_sec]'),
                cont1_section = form.find('select[name=cont1_section]'),
                cont1_section_type = form.find('select[name=cont1_section]').val(),
                select_switch_style = form.find('select[name=select_switch_style]').val(),
                cont2_section = form.find('select[name=cont2_section]'),
                cont2_section_type = form.find('select[name=cont2_section]').val();

            advanced.on('change', $.proxy( this._advanceOptionsStyleClick, this ) );
            advanced_sec.on('change', $.proxy( this._advanceOptionsStyleClick, this ) );
            cont1_section.on('change', $.proxy( this._contentTypoSections, this ) );
            cont2_section.on('change', $.proxy( this._contentTypoSections, this ) );

            $( this._advanceOptionsStyleClick, this );
            $( this._contentTypoSections, this );

            var toggle_settings = $('.fl-builder-uabb-content-toggle-settings').find('.fl-builder-settings-tabs a');
            toggle_settings.on('click', this._contentTabsClick);

            var colorTwo =$('.fl-builder-uabb-content-toggle-settings').find('#fl-field-color2 .fl-color-picker-color'); 
            colorTwo.on('click', this._secondColorPickerClick);

            var colorOne =$('.fl-builder-uabb-content-toggle-settings').find('#fl-field-color1 .fl-color-picker-color'); 
            colorOne.on('click', this._firstColorPickerClick);

            switch ( select_switch_style ) {
                case 'round1':
                    styleToggleClass = ' .switch1';
                    break;

                case 'round2':
                    styleToggleClass = ' .switch2';
                    break;

                case 'rectangle':
                    styleToggleClass = ' .switch3';
                    break;

                case 'label_box':
                    styleToggleClass = ' .switch4';
                    break;

                default:
                    break;
            }
        },

        _secondColorPickerClick: function()
        {
             var form           = $('.fl-builder-settings'),
                node_id         = form.attr('data-node'),
                select_switch_style = form.find('select[name=select_switch_style]').val(),
                cont1_section_type = form.find('select[name=cont1_section]').val(),
                cont2_section_type = form.find('select[name=cont2_section]').val();

             if(!($('.fl-node-' + node_id + ' .uabb-clickable').is(":checked")))
                {
                    $('.fl-node-' + node_id + styleToggleClass).trigger("click");

                    if ( 'content' === cont1_section_type || 'content_head2' === cont2_section_type ) {
                        
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-1').css('display', 'none');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-2').css('display', 'block');
                    }
                    else {
                        
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-1').css('display', 'none');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-2').css('display', 'block');
                    }

                } 
        },
        _firstColorPickerClick: function()
        {       var form           = $('.fl-builder-settings'),
                node_id         = form.attr('data-node'),
                cont1_section_type = form.find('select[name=cont1_section]').val(),
                cont2_section_type = form.find('select[name=cont2_section]').val();

                if(($('.fl-node-' + node_id + ' .uabb-clickable').is(":checked")))
                {
                    $('.fl-node-' + node_id + styleToggleClass).trigger("click");

                    if ( 'content' === cont1_section_type || 'content_head2' === cont2_section_type ) {

                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-1').css('display', 'block');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-2').css('display', 'none');
                    }
                    else {
                        
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-1').css('display', 'block');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-2').css('display', 'none');
                    }
                }
        },
       _contentTabsClick: function() {
            var anchorHref = $(this).attr('href');
            var form           = $('.fl-builder-settings'),
                node_id         = form.attr('data-node'),
                cont1_section_type = form.find('select[name=cont1_section]').val(),
                cont2_section_type = form.find('select[name=cont2_section]').val();

            if( anchorHref == '#fl-builder-settings-tab-general_content2' ){
                 if(!($('.fl-node-' + node_id + ' .uabb-clickable').is(":checked")))
                {
                    $('.fl-node-' + node_id + styleToggleClass).trigger("click");

                    if ( 'content' === cont1_section_type || 'content_head2' === cont2_section_type ) {

                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-1').css('display', 'none');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-2').css('display', 'block');
                    }
                    else {

                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-1').css('display', 'none');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-2').css('display', 'block');
                    }
                }
            } 
            if( anchorHref == '#fl-builder-settings-tab-general_content1' ){
                 if(($('.fl-node-' + node_id + ' .uabb-clickable').is(":checked")))
                {
                    $('.fl-node-' + node_id + styleToggleClass).trigger("click");

                    if ( 'content' === cont1_section_type || 'content_head2' === cont2_section_type ) {

                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-1').css('display', 'block');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-content-2').css('display', 'none');
                    }
                    else {
                        
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-1').css('display', 'block');
                        jQuery('.fl-node-' + node_id + ' .uabb-rbs-section-2').css('display', 'none');
                    }
                }
            }     
        },
        
        _advanceOptionsStyleClick: function() {
            var form        = $('.fl-builder-settings'),
                advanced = form.find('select[name=advanced]').val(),
                border_type = form.find('select[name=border_type]').val(),
                advanced_sec = form.find('select[name=advanced_sec]').val(),
                border_type_sec = form.find('select[name=border_type_sec]').val();

            if( advanced == 'off' ) {
                form.find('#fl-field-border_width_head').hide();
                form.find('#fl-field-border_color_head').hide();
            } else if(advanced == 'on' && border_type != 'none'){
                form.find('#fl-field-border_width_head').show();
                form.find('#fl-field-border_color_head').show();
            }

            if( advanced_sec == 'off' ) {
                form.find('#fl-field-border_width_sec').hide();
                form.find('#fl-field-border_color_sec').hide();
            } else if(advanced_sec == 'on' && border_type_sec != 'none') {
                form.find('#fl-field-border_width_sec').show();
                form.find('#fl-field-border_color_sec').show();
            }
        },

        _contentTypoSections: function() {
            var form        = $('.fl-builder-settings'),
                cont1_section = form.find('select[name=cont1_section]').val(),
                cont2_section = form.find('select[name=cont2_section]').val();
                
            if( cont1_section == 'content' ) {
                form.find('#fl-builder-settings-section-content1_typo').show();
            } else {
                form.find('#fl-builder-settings-section-content1_typo').hide();
            }

            if( cont2_section == 'content_head2' ) {
                form.find('#fl-builder-settings-section-content2_typo').show();
            } else {
                form.find('#fl-builder-settings-section-content2_typo').hide();
            }
        }
    });

})(jQuery);