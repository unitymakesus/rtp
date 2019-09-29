(function($){
    FLBuilder.registerModuleHelper('uabb-business-reviews', {
        init: function(){
            var form        = $( '.fl-builder-settings' ),

            review_source      = form.find( 'select[name=review_source]' );
            star_rating       = form.find( 'select[name=review_rating]' );
            star_style        = form.find( 'select[name=select_star_style]' );
            review_source        = form.find( 'select[name=review_source]' );
            skin_type        = form.find( 'select[name=_skin]' );
            image_align        = form.find( 'select[name=image_align]' );
            review_date        = form.find( 'select[name=review_date]' );

		    this._changeReviewsType();
            this._hideDocs();
            this._changeRatingType();
            this._hideDescription();
            this._hide_reviewer_source_icon();
            this._hide_date();

            review_source.on( 'change', this._changeReviewsType );
            star_rating.on( 'change', this._changeRatingType );
            star_style.on( 'change', this._changeRatingType );
            review_source.on( 'change', this._hideDescription );
            skin_type.on( 'change', this._hide_reviewer_source_icon );
            image_align.on( 'change', this._hide_reviewer_source_icon );
            review_source.on( 'change', this._hide_date );
            review_date.on( 'change', this._hide_date );
        },
        _hide_date: function() {

            var form        = $('.fl-builder-settings');

            if ( 'google' === form.find( 'select[name=review_source]' ).val() && 'yes' === form.find( 'select[name=review_date]' ).val() ) {

                form.find( '#fl-field-review_date_type' ).show();

            } else {

                form.find( '#fl-field-review_date_type' ).hide();
            }
        },
        _hide_reviewer_source_icon: function() {

            var form        = $('.fl-builder-settings');

            if ( 'default' === form.find('select[name=_skin]' ).val() || 'card' === form.find('select[name=_skin]' ).val() ) {

                if ( 'top' === form.find('select[name=image_align]' ).val() ) {
                    form.find('#fl-field-review_source_icon').hide();
                } else {
                    form.find('#fl-field-review_source_icon').show();
                }
            } else if ( 'bubble' === form.find('select[name=_skin]' ).val() ) {

                form.find('#fl-field-review_source_icon').show();
            }
        },
        _changeReviewsType : function() {
            var form        = $('.fl-builder-settings');
            form.find('.all__notice').hide();
            form.find('.google__notice').hide();
            form.find('.yelp__notice').hide();

			if ( form.find('select[name=review_source]' ).val() === 'google' ) {

				form.find('.google__notice').show();
				form.find('.all__notice').hide();
				form.find('.yelp__notice').hide();

			} else if ( form.find('select[name=review_source]' ).val() === 'all' ){

				form.find('.all__notice').show();
				form.find('.google__notice').hide();
				form.find('.yelp__notice').hide();

			} else if ( form.find('select[name=review_source]' ).val() === 'yelp' ){

				form.find('.all__notice').hide();
				form.find('.google__notice').hide();
				form.find('.yelp__notice').show();

			}
        },
        _hideDescription: function() {

            var form        = $('.fl-builder-settings');

            form.find( 'select[name=review_source]' ).val();

            if ( 'google' !== form.find( 'select[name=review_source]' ).val() ) {

                form.find( '#fl-field-review_content_length .fl-field-description' ).show();
            } else {
                form.find( '#fl-field-review_content_length .fl-field-description' ).hide();                
            }
        },
        _changeRatingType: function() {
            var form        = $('.fl-builder-settings');
            star_rating_val       = form.find( 'select[name=review_rating]' ).val();

            if ( 'no' === star_rating_val ) {
                form.find( '#fl-field-select_star_style' ).hide();
                form.find( '#fl-field-icon_size' ).hide();
                form.find( '#fl-field-rating_icon_color' ).hide();
                form.find( '#fl-field-stars_unmarked_color' ).hide();                                
            } else {

                if ( 'custom' === form.find( 'select[name=select_star_style]' ).val() ) {
                    form.find( '#fl-field-select_star_style' ).show();
                    form.find( '#fl-field-icon_size' ).show();
                    form.find( '#fl-field-rating_icon_color' ).show();
                    form.find( '#fl-field-stars_unmarked_color' ).show();
                } else {
                    form.find( '#fl-field-select_star_style' ).show();
                    form.find( '#fl-field-icon_size' ).hide();
                    form.find( '#fl-field-rating_icon_color' ).hide();
                    form.find( '#fl-field-stars_unmarked_color' ).hide();
                }

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