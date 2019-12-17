(function($){

    var layout_var = '';
    FLBuilder.registerModuleHelper('progress-bar', {

        init: function()
        {
            var form        = $('.fl-builder-settings'),
                layout = form.find('select[name=layout]'),
                horizontal_style = form.find('select[name=horizontal_style]'),
                text_position = form.find('select[name=text_position]');

            layout_var = layout;

            layout.on('change', $.proxy( this._toggleLayout, this ) );
            horizontal_style.on('change', $.proxy( this._toggleStyle, this ) );
            text_position.on('change', $.proxy( this._togglePosition, this ) );

            $( this._toggleLayout, this );
            $( this._toggleStyle, this );
            $( this._togglePosition, this );
        },

        _toggleLayout: function() {
            var form        = $('.fl-builder-settings'),
                layout    = form.find('select[name=layout]').val(),
                horizontal_style = form.find('select[name=horizontal_style]').val(),
                text_position = form.find('select[name=text_position]').val();

            if( layout == 'horizontal' ) {
                if( horizontal_style == 'style1' ) {

                    form.find('#fl-field-horizontal_thickness').show();
                    form.find('#fl-field-horizontal_space_below').show();

                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_vert_padding').hide();
                    form.find('#fl-field-horizontal_horz_padding').hide();
                    form.find('#fl-field-horizontal_space_above').hide();

                } else if( horizontal_style == 'style2' ) {

                    form.find('#fl-field-horizontal_thickness').show();
                    form.find('#fl-field-horizontal_space_above').show();

                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_vert_padding').hide();
                    form.find('#fl-field-horizontal_horz_padding').hide();
                    form.find('#fl-field-horizontal_space_below').hide();

                } else if( horizontal_style == 'style3' ) {

                    form.find('#fl-field-horizontal_vert_padding').show();
                    form.find('#fl-field-horizontal_horz_padding').show();

                    form.find('#fl-field-horizontal_thickness').hide();
                    form.find('#fl-field-horizontal_space_above').hide();
                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_space_below').hide();

                } else if( horizontal_style == 'style4' ) {
                    form.find('#fl-field-text_position').show();
                    form.find('#fl-field-horizontal_vert_padding').show();
                    form.find('#fl-field-horizontal_horz_padding').show();

                    if( text_position == 'above' ) {
                        form.find('#fl-field-horizontal_space_above').hide();
                        form.find('#fl-field-horizontal_space_below').show();
                    } else {
                        form.find('#fl-field-horizontal_space_above').show();
                        form.find('#fl-field-horizontal_space_below').hide();
                    }
                    form.find('#fl-field-horizontal_thickness').hide();
                }
            }
        },

        _toggleStyle: function() {
            var form        = $('.fl-builder-settings'),
                layout = form.find('select[name=layout]').val(),
                horizontal_style = form.find('select[name=horizontal_style]').val(),
                text_position = form.find('select[name=text_position]').val();
                // console.log(horizontal_style);
            
            if( layout == 'horizontal' ) {
                if( horizontal_style == 'style1' ) {

                    form.find('#fl-field-horizontal_thickness').show();
                    form.find('#fl-field-horizontal_space_below').show();

                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_vert_padding').hide();
                    form.find('#fl-field-horizontal_horz_padding').hide();
                    form.find('#fl-field-horizontal_space_above').hide();

                } else if( horizontal_style == 'style2' ) {
                    
                    form.find('#fl-field-horizontal_thickness').show();
                    form.find('#fl-field-horizontal_space_above').show();

                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_vert_padding').hide();
                    form.find('#fl-field-horizontal_horz_padding').hide();
                    form.find('#fl-field-horizontal_space_below').hide();

                } else if( horizontal_style == 'style3' ) {

                    form.find('#fl-field-horizontal_vert_padding').show();
                    form.find('#fl-field-horizontal_horz_padding').show();

                    form.find('#fl-field-horizontal_thickness').hide();
                    form.find('#fl-field-horizontal_space_above').hide();
                    form.find('#fl-field-text_position').hide();
                    form.find('#fl-field-horizontal_space_below').hide();

                } else if( horizontal_style == 'style4' ) {
                    form.find('#fl-field-text_position').show();
                    form.find('#fl-field-horizontal_vert_padding').show();
                    form.find('#fl-field-horizontal_horz_padding').hide();

                    if( text_position == 'above' ) {
                        form.find('#fl-field-horizontal_space_above').hide();
                        form.find('#fl-field-horizontal_space_below').show();
                    } else {
                        form.find('#fl-field-horizontal_space_above').show();
                        form.find('#fl-field-horizontal_space_below').hide();
                    }
                    form.find('#fl-field-horizontal_thickness').hide();

                }
            }

        },

        _togglePosition: function() {
            var form        = $('.fl-builder-settings'),
                layout = form.find('select[name=layout]').val(),
                horizontal_style = form.find('select[name=horizontal_style]').val(),
                text_position = form.find('select[name=text_position]').val();

            if( layout == 'horizontal' ) {
                if( horizontal_style == 'style4' ) {
                    if( text_position == 'above' ) {
                        form.find('#fl-field-horizontal_space_above').hide();
                        form.find('#fl-field-horizontal_space_below').show();
                    } else {
                        form.find('#fl-field-horizontal_space_above').show();
                        form.find('#fl-field-horizontal_space_below').hide();
                    }
                }
            }
        },

    });

    FLBuilder.registerModuleHelper('progress_bar_horizontal_item_form', { 
        init: function()
        {
            this._toggleLayoutOptions();
        },

        _toggleLayoutOptions: function() {

            var form = $('.fl-builder-settings'),
                circular_before_number   = form.find('#fl-field-circular_before_number'),
                circular_after_number    = form.find('#fl-field-circular_after_number'),
                horizontal_before_number = form.find('#fl-field-horizontal_before_number'),

                progress_bar_type_val    = form.find('select[name=progress_bg_type]').val(),
                progress_bar_type        = form.find('#fl-field-progress_bg_type'),
                progress_bg_img          = form.find('#fl-field-progress_bg_img'),
                progress_bg_img_pos      = form.find('#fl-field-progress_bg_img_pos'),
                progress_bg_img_repeat   = form.find('#fl-field-progress_bg_img_repeat'),
                progress_bg_img_size     = form.find('#fl-field-progress_bg_img_size'),
                gradient_color           = form.find('#fl-field-gradient_color'),
                gradient_color_opc       = form.find('#fl-field-gradient_color_opc'),
                gradient_feild          = form.find('#fl-field-gradient_field');
                
                layout = layout_var.val();
            
            progress_bar_type.css('display', 'none');
            progress_bg_img.css('display', 'none');
            progress_bg_img_pos.css('display', 'none');
            progress_bg_img_repeat.css('display', 'none');
            progress_bg_img_size.css('display', 'none');
            gradient_color.css('display', 'none');
            gradient_color_opc.css('display', 'none');
            if( layout == 'circular' || layout == 'semi-circular' ) {
                horizontal_before_number.css('display', 'none');
                
                gradient_color.css('display', 'table-row');
                gradient_color_opc.css('display', 'table-row');

            } else {
                circular_before_number.css('display', 'none');
                circular_after_number.css('display', 'none');
                
                progress_bar_type.css('display', 'table-row');

                if( progress_bar_type_val == 'image' ) {
                    progress_bg_img.css('display', 'table-row');
                    progress_bg_img_pos.css('display', 'table-row');
                    progress_bg_img_repeat.css('display', 'table-row');
                    progress_bg_img_size.css('display', 'table-row');

                } else if( progress_bar_type_val == 'gradient' ) {
                    gradient_feild.css('display', 'table-row');
                } else {
                    gradient_color.css('display', 'table-row');
                    gradient_color_opc.css('display', 'table-row');
                }
            }
        },
    });

})(jQuery);
