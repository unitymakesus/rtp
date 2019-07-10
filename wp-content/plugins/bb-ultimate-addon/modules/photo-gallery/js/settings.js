(function($){
    FLBuilder.registerModuleHelper('photo-gallery', {
        init: function(){
            var form        = $( '.fl-builder-settings' ),
            filterable      = form.find( 'select[name=filterable_gallery_enable]' );

            this._hideDocs();
            this._changeFilterable();

            filterable.on( 'change', this._changeFilterable );
        },
        /**
         * On change of filterable hide and show flieds.
         *
         * @since 1.16.5
        */
        _changeFilterable : function() {
            var form        = $('.fl-builder-settings');

            if( form.find('select[name=filterable_gallery_enable]').val() === 'yes' ) {

                 if( form.find('select[name=default_filter_switch]' ).val() === 'yes' ){

                    form.find('#fl-field-default_filter').show();

                 } else{

                    form.find('#fl-field-default_filter').hide();

                 }
                  if( form.find('select[name=show_filter_title]' ).val() === 'yes' ){

                        form.find('#fl-field-filters_heading_text').show();

                  } else {

                        form.find('#fl-field-filters_heading_text').hide();
                  }
            } else {

                form.find('#fl-field-default_filter').hide();
                form.find('#fl-field-filters_heading_text').hide();
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