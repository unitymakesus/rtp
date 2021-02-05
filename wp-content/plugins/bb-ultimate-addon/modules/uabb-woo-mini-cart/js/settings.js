(function($){

	FLBuilder.registerModuleHelper( 'uabb-woo-mini-cart', {
		init: function()
		{
            var form	  = $('.fl-builder-settings'),
            preview_cart  = form.find('select[name=preview_cart]'),
            save_button   = form.find('.fl-builder-settings-save'),
            cancel_button = form.find('.fl-builder-settings-cancel'),
            form_button   = form.find('.fl-builder-button'),
            cart_style    = form.find('select[name=cart_style]');

            this._showCartPreview();
            this._toggleSettings();
            this._hideDocs();

            cart_style.on('change', $.proxy( this._toggleSettings, this ) );
            save_button.off( 'click' ).on( 'click', this._closeCartPreview );
            cancel_button.off( 'click' ).on( 'click', this._closeCartPreview );

            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', $.proxy( this._showCartPreview, this ) );
            form_button.on('click', $.proxy( this._closeCartPreview, this ) );

        },
        _toggleSettings: function() {
            var form         = $('.fl-builder-settings'),
            cart_style       = form.find('select[name=cart_style]').val(),
            display_position = form.find('select[name=display_position]').val();

            if ( ( 'modal' == cart_style || 'off-canvas' == cart_style ) && 'floating' == display_position ) {
                form.find('#fl-field-floating_align').show();
                form.find('#fl-field-ver_floating_position').show();
                form.find('#fl-field-hor_floating_position').show();
            } else {
                form.find('#fl-field-floating_align').hide();
                form.find('#fl-field-ver_floating_position').hide();
                form.find('#fl-field-hor_floating_position').hide();
            }
        },
        _showCartPreview: function() {
            var form     = $('.fl-builder-settings');
            preview_cart = form.find('select[name=preview_cart]').val();
            cart_style   = form.find('select[name=cart_style]').val();
            node_id      = form.attr('data-node');
            node_module  = $( '.fl-node-' + node_id );
            modal_node   = $( '.fl-node-' + node_id + ' uabb-mini-cart-content' );

            if ( '1' === preview_cart ) {

                if( 'dropdown' == cart_style ) {
                    node_module.find( '.uabb-cart-style-dropdown' ).removeClass( 'uabb-cart-dropdown-close' );
                }

                if ( 'modal' == cart_style ) {
                    node_module.find( '.uabb-cart-modal-wrap' ).removeClass( 'uabb-cart-modal-wrap-close' );
                    node_module.find( '.uabb-cart-style-modal' ).removeClass( 'uabb-cart-modal-close' );
                    $( 'body' ).css( 'overflow','hidden' );
                }

                if ( 'off-canvas' == cart_style ) {
                    node_module.find( '.uabb-cart-off-canvas-wrap' ).removeClass( 'uabb-cart-off-canvas-wrap-close' );
                    node_module.find( '.uabb-cart-style-off-canvas' ).removeClass( 'uabb-cart-off-canvas-close' );
                    $( 'body' ).css( 'overflow','hidden' );
                }
            } else {

                if( 'dropdown' == cart_style ) {
                    node_module.find( '.uabb-cart-style-dropdown' ).addClass( 'uabb-cart-dropdown-close' );
                }

                if ( 'modal' == cart_style ) {
                    node_module.find( '.uabb-cart-style-modal' ).addClass( 'uabb-cart-modal-close' );
                    node_module.find( '.uabb-cart-modal-wrap' ).addClass( 'uabb-cart-modal-wrap-close' );
                    $( 'body' ).css( 'overflow','' );
                }

                if ( 'off-canvas' == cart_style ) {
                    node_module.find( '.uabb-cart-style-off-canvas' ).addClass( 'uabb-cart-off-canvas-close' );
                    node_module.find( '.uabb-cart-off-canvas-wrap' ).addClass( 'uabb-cart-off-canvas-wrap-close' );
                    $( 'body' ).css( 'overflow','' );
                }

            }
        },
        _closeCartPreview: function() {
            var form    = $('.fl-builder-settings');
            preview_cart = form.find('select[name=preview_cart]').val();
            cart_style = form.find('select[name=cart_style]').val();
            node_id         = form.attr('data-node');
            node_module = $( '.fl-node-' + node_id );
            modal_node       = $( '.fl-node-' + node_id + 'uabb-mini-cart-content' );

            if( 'dropdown' == cart_style ) {
                node_module.find( '.uabb-cart-style-dropdown' ).addClass( 'uabb-cart-dropdown-close' );
            }

            if ( 'modal' == cart_style ) {
                node_module.find( '.uabb-cart-style-modal' ).addClass( 'uabb-cart-modal-close' );
                node_module.find( '.uabb-cart-modal-wrap' ).addClass( 'uabb-cart-modal-wrap-close' );
                $( 'body' ).css( 'overflow','' );
            }

            if ( 'off-canvas' == cart_style ) {
                node_module.find( '.uabb-cart-style-off-canvas' ).addClass( 'uabb-cart-off-canvas-close' );
                node_module.find( '.uabb-cart-off-canvas-wrap' ).addClass( 'uabb-cart-off-canvas-wrap-close' );
                $( 'body' ).css( 'overflow','' );
            }

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