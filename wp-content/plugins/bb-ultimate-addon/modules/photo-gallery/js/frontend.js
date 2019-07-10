(function($) {
	UABBPhotoGallery = function( settings ) {
		
		this.settings       = settings;
		this.node           = settings.id;
		this.nodeClass      = '.fl-node-' + settings.id;
		this.layout 		= settings.layout;
		this._initFilter();
	};
	UABBPhotoGallery.prototype = {
		settings	: {},
		node        :'',
		nodeClass   : '',

		/**
		 * Intaialize the Filterable Tabs.
		 *
		 * @since  1.16.5
		 * 
		 */
		_initFilter:function() {

			if( 'grid' === this.layout ) {
				this._grid_layout();
			} else {
				this._masonary_layout();
			}
		},
        // Grid Layout load with filterable gallery.
		_grid_layout:function(){
			var nodeClass  	= jQuery( this.nodeClass );
				selector 	= nodeClass.find( '.uabb-module-content' );
				all_filters = selector.data( 'all-filters' );

				if ( selector.length < 1 ) {
					return;
				}

				if ( selector.hasClass( 'uabb-photo-gallery-filter-grid' ) ) {
				
				var filters = nodeClass.find( '.uabb-photo__gallery-filters' );
			
				var def_cat = '*';

				if ( filters.length > 0 ) {
					var def_filter = filters.data( 'default' );
					def_filter = def_filter.trim();

					if ( '' !== def_filter ) {

						def_cat 	= def_filter;

						def_cat_sel = filters.find( '[data-filter="' + def_filter + '"]' );

						if ( def_cat_sel.length > 0 ) {

							def_cat_sel.siblings().removeClass( 'uabb-filter__current' );
							def_cat_sel.addClass( 'uabb-filter__current' );
						}
						if ( -1 == all_filters.indexOf( def_cat.replace('.', "") ) ) {
							def_cat = '*';
						}
					}
				}
				var $obj = {};
				nodeClass.find( '.uabb-module-content' ).imagesLoaded( { background: '.item' }, function( e ) {
					$obj = nodeClass.find('.uabb-module-content').isotope({
						filter: def_cat,
						layoutMode: 'fitRows',
						itemSelector: '.uabb-photo-item-grid',
					});
					nodeClass.find('.uabb-module-content').find( '.uabb-photo-item-grid' ).resize( function() {
						$obj.isotope( 'layout' );
					});
				});
				nodeClass.find( '.uabb-photo__gallery-filter' ).on( 'click', function() {
					$( this ).siblings().removeClass( 'uabb-filter__current' );
					$( this ).addClass( 'uabb-filter__current' );
					var value = $( this ).data( 'filter' );
					nodeClass.find( '.uabb-module-content' ).isotope({ filter: value } );
				} );
			}
		},
		// Masonary Layout load with filterable gallery.
		_masonary_layout:function(){
			var nodeClass  	= jQuery(this.nodeClass);
				selector 	= nodeClass.find( '.uabb-masonary-content' );
				all_filters = selector.data( 'all-filters' );
			if ( selector.length < 1 ) {
				return;
			}

			if ( selector.hasClass( 'uabb-photo-gallery-filter' ) ) {
				
				var filters = nodeClass.find( '.uabb-photo__gallery-filters' );
			
				var def_cat = '*';

				if ( filters.length > 0 ) {
					var def_filter = filters.data( 'default' );
					def_filter = def_filter.trim();

					if ( '' !== def_filter ) {

						def_cat 	= def_filter;

						def_cat_sel = filters.find( '[data-filter="' + def_filter + '"]' );

						if ( def_cat_sel.length > 0 ) {

							def_cat_sel.siblings().removeClass( 'uabb-filter__current' );
							def_cat_sel.addClass( 'uabb-filter__current' );
						}
						if ( -1 == all_filters.indexOf( def_cat.replace('.', "") ) ) {
							def_cat = '*';
						}
					}
				}
				var $obj = {};
				nodeClass.find( '.uabb-masonary-content' ).imagesLoaded( { background: '.item' }, function( e ) {
					$obj = nodeClass.find('.uabb-masonary-content').isotope({
						filter: def_cat,
						layoutMode: 'masonry',
						itemSelector: '.uabb-photo-item',
					});
					nodeClass.find( '.uabb-masonary-content' ).find( '.uabb-photo-item' ).resize( function() {
						$obj.isotope( 'layout' );
					});
				});
				nodeClass.find( '.uabb-photo__gallery-filter' ).on( 'click', function() {
				
					$( this ).siblings().removeClass( 'uabb-filter__current' );
					$( this ).addClass( 'uabb-filter__current' );
					var value = $( this ).data( 'filter' );
					nodeClass.find( '.uabb-masonary-content' ).isotope( { filter: value } );
				} );
			}
		}
	};
})(jQuery);