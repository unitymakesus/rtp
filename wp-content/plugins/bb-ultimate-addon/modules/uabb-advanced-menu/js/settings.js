(function($){

    FLBuilder.registerModuleHelper('uabb-advanced-menu', {
        init: function()
        {
            var form = $('.fl-builder-settings'),
                a = $('.fl-builder-uabb-advanced-menu-settings').find('.fl-builder-settings-tabs a'),
                mobile_menu_type = form.find('select[name=creative_mobile_menu_type]'),
                menu_mobile_breakpoint = form.find('select[name=creative_menu_mobile_breakpoint]');

                $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this.callbackRenderFunction );
                a.on('click', this._openSubmenu);

                mobile_menu_type.on('change', $.proxy( this._hideWidth, this ) );
                menu_mobile_breakpoint.on('change', $.proxy( this._hideWidth, this ) );

                $( this._hideWidth, this );
                this._hideDocs();
		},

		callbackRenderFunction: function() {
            var a    = $('.fl-builder-uabb-advanced-menu-settings').find('.fl-builder-settings-tabs a'),
                form = $('.fl-builder-settings'),
                id   = form.data('node');

            if( $( '.fl-active' ).attr('href') == '#fl-builder-settings-tab-submenu' ) {
            	jQuery( '.fl-node-' + id + ' .uabb-creative-menu .menu .sub-menu' ).first().css({ 'display': 'block', 'visibility': 'visible', 'opacity': '1' });
            } else {
                jQuery( '.fl-node-' + id + ' .uabb-creative-menu .menu:not(.uabb-creative-menu-expanded) .sub-menu' ).first().css({ 'display': 'none', 'visibility': 'hidden', 'opacity': '0' });
            }
        },

        _hideWidth: function() {
            var form = $('.fl-builder-settings'),
                mobile_menu_type = form.find('select[name=creative_mobile_menu_type]').val(),
                menu_mobile_breakpoint = form.find('select[name=creative_menu_mobile_breakpoint]').val();

            if( mobile_menu_type != 'default' && menu_mobile_breakpoint == 'always' ) {
                    form.find('#fl-field-submenu_width').hide();
            } else {
                form.find('#fl-field-submenu_width').show();
            }
        },

        _openSubmenu: function() {
            var form = $('.fl-builder-settings'),
                id   = form.data('node'),
                anchorHref = $(this).attr('href');
                
            if( anchorHref == '#fl-builder-settings-tab-submenu' ){
                jQuery( '.fl-node-' + id + ' .uabb-creative-menu .menu .sub-menu' ).first().css({ 'display': 'block', 'visibility': 'visible', 'opacity': '1' });
            } else {
                jQuery( '.fl-node-' + id + ' .uabb-creative-menu .menu:not(.uabb-creative-menu-expanded) .sub-menu' ).first().css({ 'display': 'none', 'visibility': 'hidden', 'opacity': '0' });
            }
        },
        /**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.14.0
        */
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