(function($){

	FLBuilder.registerModuleHelper( 'uabb-off-canvas', {
		_templates: {
            saved_modules: '',
            saved_rows: '',
            page_templates: '',
        },
		init: function()
		{
			var form	= $('.fl-builder-settings');
			content_type	= form.find('select[name=content_type]'); 
            preview_off_canvas = form.find('select[name=preview_off_canvas]');
            btn_style   = form.find('select[name=btn_style]');
            save_button = form.find('.fl-builder-settings-save');
            cancel_button = form.find('.fl-builder-settings-cancel');

            UABBButton.init();
			this._contentTypeChange();
            this._showCanavsPreview();
            this._hideDocs();

			content_type.on('change', $.proxy( this._contentTypeChange, this ) );
            btn_style.on('change', this._btn_style_changed );
            save_button.off( 'click' ).on( 'click', this._btn_style_changed);
            save_button.off( 'click' ).on( 'click', this._closeCanavsPreview );
            cancel_button.off( 'click' ).on( 'click', this._closeCanavsPreview );

            this._btn_style_changed();
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', $.proxy( this._showCanavsPreview, this ) );
		},
        _btn_style_changed: function() {

            var form    = $('.fl-builder-settings');
            icon = form.find( 'input[name=btn_icon]' );
            btn_icon = form.find( 'input[name=btn_icon]' ).val();


            if ( 0 === btn_icon.length ) {
                icon.rules('remove');
            }
        },
        _showCanavsPreview: function() {
            var form    = $('.fl-builder-settings');
            preview_off_canvas = form.find('select[name=preview_off_canvas]').val();
            node_id         = form.attr('data-node');
            modal_node       = $( '#offcanvas-' + node_id );

            if ( '1' === preview_off_canvas ) {

                modal_node.removeClass( 'uabb-drag-fix' );

                if ( modal_node.hasClass( 'uabb-offcanvas-position-at-left' ) ) {

                    $( 'body' ).css( 'margin-left' , '0' );

                    modal_node.css( 'left', '0' );

                    modal_node.addClass( 'uabb-off-canvas-show' );

                } else if( modal_node.hasClass( 'uabb-offcanvas-position-at-right' ) ) {

                    $( 'body' ).css( 'margin-right', '0' );

                    modal_node.css( 'right', '0' );

                    modal_node.addClass( 'uabb-off-canvas-show' );
                }
            } else {

                modal_node.removeClass( 'uabb-off-canvas-show' );

                modal_node.addClass( 'uabb-drag-fix' );
            }
        },
        _closeCanavsPreview: function() {
            var form    = $('.fl-builder-settings');
            node_id         = form.attr('data-node');
            modal_node       = $( '#offcanvas-' + node_id );

            var wrap_width = modal_node.width() + 'px';

            if (  modal_node.hasClass( 'uabb-offcanvas-position-at-left' ) ) {

                 modal_node.css( 'left', '-' + wrap_width );

                /* If Push Transition  is enabled*/
                if(  modal_node.hasClass( 'uabb-offcanvas-type-push' ) ) {

                    $( 'body' ).css({ 
                        position: '',
                        'margin-left' : '',
                        'margin-right' : '',
                    });

                    setTimeout( function() {
                        $( 'body' ).removeClass( 'uabb-offcanvas-animating' ).css({ 
                            width: '',
                        });
                    }, 300 );
                }

                 modal_node.removeClass( 'uabb-off-canvas-show' );

            } else if (  modal_node.hasClass( 'uabb-offcanvas-position-at-right' ) ) {

                 modal_node.css( 'right', '-' + wrap_width );

                /* If Push Transition is enabled */
                if(  modal_node.hasClass( 'uabb-offcanvas-type-push' ) ) {

                    $( 'body' ).css({
                        position: '',
                        'margin-right' : '',
                        'margin-left' : '',
                    });

                    setTimeout( function() {
                        $( 'body' ).removeClass( 'uabb-offcanvas-animating' ).css({ 
                            width: '',
                        });
                    }, 300 );
                }

                 modal_node.removeClass( 'uabb-off-canvas-show' );
            }

        },
		_contentTypeChange: function()
        {

            var form            = $('.fl-builder-settings');

            var type = form.find('select[name=content_type]').val();

            if ( 'saved_modules' === type ) {
                this._setTemplates('saved_modules');
            }
            if ( 'saved_rows' === type ) {
                this._setTemplates('saved_rows');
            }
            if ( 'saved_page_templates' === type ) {
                this._setTemplates('page_templates');
            }
        },
        _getTemplates: function( type, callback )
        {
            if ( 'undefined' === typeof type ) {
                return;
            }

            if ( 'undefined' === typeof callback ) {
                return;
            }
            if ( 'saved_modules' === type ) {
                type = 'module';
            } else if ( 'saved_rows' === type ) {
                type = 'row';
            } else if ( 'page_templates' === type ) {
                type = 'layout';
            }
            var self = this;

            $.post(
                ajaxurl,
                {
                    action: 'uabb_get_saved_templates',
                    type: type
                },
                function( response ) {
                    callback(response);
                }
            );
        },
        _setTemplates: function( type )
        {
            var form = $('.fl-builder-settings'),       
                select = form.find( 'select[name="ct_' + type + '"]' ),
                value = '', self = this;

            if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {
                if ( "uabb-off-canvas" === FLBuilderSettingsForms.config.id ) {
                    value = FLBuilderSettingsForms.config.settings['ct_' + type];
                }
            }
            if ( this._templates[type] !== '' ) {
                select.html( this._templates[type] );
                select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

                return;
            }

            this._getTemplates(type, function( data ) {
                var response = JSON.parse( data );

                if ( response.success ) {
                    self._templates[type] = response.data;
                    select.html( response.data );
                    if ( '' !== value ) {
                        select.find( 'option[value="' + value + '"]').attr('selected', 'selected');
                    }
                }
            });
        },
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