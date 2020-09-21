(function($) {
	UABBPhotoGallery = function( settings ) {
		
		this.settings       = settings;
		this.node           = settings.id;
		this.uabb_ajaxurl   = settings.uabb_ajaxurl;
		this.nodeClass      = '.fl-node-' + settings.id;
		this.layout 		= settings.layout;
		this.pagination     = settings.pagination;
		if ( 'grid' === this.layout ){
			this.wrapperClass   = this.nodeClass + ' .uabb-photo-gallery';
			this.itemClass  = this.wrapperClass + ' .uabb-photo-gallery-item';
		} else {
			this.wrapperClass   = this.nodeClass + ' .uabb-masonary-content';
			this.itemClass  = this.wrapperClass + ' .uabb-photo-item';
		}
		_nonce = $(this.wrapperClass).data( 'nonce' );
		this.cachedItems		= false;
		this.cachedIds			= [];
		this.isBuilderActive 	= settings.isBuilderActive;
		this.imgPerPage         = settings.imgPerPage;
		this.total_img_count    = settings.total_img_count;
		this._initFilter();
		if ( this.pagination && 'none' !== this.pagination ) {
			this._initPagination();
		}
	};
	UABBPhotoGallery.prototype = {
		settings	: {},
		node        :'',
		nodeClass   : '',
		wrapperClass    : '',
		itemClass       : '',
		cachedItems		: false,
		cachedIds		: [],
		isBuilderActive : false,

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

			var id = window.location.hash.substring( 1 );
			var pattern = new RegExp( "^[\\w\\-]+$" );
			var sanitize_input = pattern.test( id );

				if ( selector.length < 1 ) {
					return;
				}

				if ( selector.hasClass( 'uabb-photo-gallery-filter-grid' ) ) {
				
				var filters = nodeClass.find( '.uabb-photo__gallery-filters' );
			
				var def_cat = '*';

				if( '' !== id && sanitize_input ) {
					var select_filter = filters.find("[data-filter='" + '.' + id.toLowerCase() + "']");

					if ( select_filter.length > 0 ) {
						def_cat 	= '.' + id.toLowerCase();
						select_filter.siblings().removeClass('uabb-filter__current');
						select_filter.addClass('uabb-filter__current');
					}
				}

				if ( filters.length > 0 ) {
					var def_filter = filters.data( 'default' );
					def_filter = def_filter.trim();

					if ( '' !== def_filter ) {

						def_cat 	= def_filter;

						def_cat_sel = filters.find( '[data-filter="' + def_filter + '"]' );

						if ( 0 === def_cat_sel.length ) {
								return;
						}

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

			var id = window.location.hash.substring( 1 );
			var pattern = new RegExp( "^[\\w\\-]+$" );
			var sanitize_input = pattern.test( id );

			if ( selector.length < 1 ) {
				return;
			}

			if ( selector.hasClass( 'uabb-photo-gallery-filter' ) ) {
				
				var filters = nodeClass.find( '.uabb-photo__gallery-filters' );
			
				var def_cat = '*';

				if( '' !== id && sanitize_input ) {
					var select_filter = filters.find("[data-filter='" + '.' + id.toLowerCase() + "']");

					if ( select_filter.length > 0 ) {
						def_cat 	= '.' + id.toLowerCase();
						select_filter.siblings().removeClass('uabb-filter__current');
						select_filter.addClass('uabb-filter__current');
					}
				}

				if ( filters.length > 0 ) {
					var def_filter = filters.data( 'default' );
					def_filter = def_filter.trim();

					if ( '' !== def_filter ) {

						def_cat 	= def_filter;

						def_cat_sel = filters.find( '[data-filter="' + def_filter + '"]' );

						if ( 0 === def_cat_sel.length ) {
								return;
						}

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
		},
		_initPagination: function()
		{
			var self = this;
			
			$(this.itemClass).each(function() {
				self.cachedIds.push( $(this).data('item-id') );
			});

			if ( 'masonary' === this.settings.layout ) {
				var wrap = $(this.wrapperClass);

				var isotopeData = {
					layoutMode: 'masonry',
					itemSelector: '.uabb-photo-item',
				};

				wrap.imagesLoaded( $.proxy( function() {
					wrap.isotope(isotopeData);
				}, this ) );
			}

			if ( 'load_more' === this.settings.pagination ) {
				this._initLoadMore();
			}
			if ( 'scroll' === this.settings.pagination && ! this.isBuilderActive ) {
				this._initScroll();
			}
		},
		_initLoadMore: function()
		{
			var self = this;

			$(this.nodeClass).find( '.uabb-gallery-load-more' ).on('click', function(e) {
				e.preventDefault();

				var $this = $(this);
				$this.addClass('disabled loading');

				$this.append( '<span class="uabb-form-loader"></span>' );

				if ( self.cachedItems ) {
					self._renderItems();
				} else {
					self._getAjaxPhotos();
				}
			});
		},

		_initScroll: function() {
			var self 			= this,
				galleryOffset 	= $(this.wrapperClass).offset(),
				galleryHeight 	= $(this.wrapperClass).height(),
				winHeight		= $(window).height(),
				loaded			= false;

			$(window).on('scroll', function() {
				if ( loaded ) {
					return;
				}
				var scrollPos = $(window).scrollTop();

				if ( scrollPos >= galleryOffset.top - ( winHeight - galleryHeight ) ) {
					if ( $(self.nodeClass).find('.uabb-gallery-pagination.loaded').length > 0 ) {
						loaded = true;
						$(self.nodeClass).find('.uabb-gallery-loader').hide();
					} else {
						loaded = true;
						$(self.wrapperClass).imagesLoaded(function() {
							setTimeout(function() {
								if ( self.cachedItems ) {
									self._renderItems();
									galleryHeight = $(self.wrapperClass).height();
								} else {
									self._getAjaxPhotos(function() {
										galleryHeight = $(self.wrapperClass).height();
									});
								}
							}, 600);
						});
					}
				}
			});

			$(this.wrapperClass).on('gallery.rendered', function() {
				if ( $(self.nodeClass).find('.uabb-gallery-pagination.loaded').length === 0 ) {
					loaded = false;
					galleryHeight = $(self.wrapperClass).height();
				}
			});
		},
		_getAjaxPhotos: function(callback) {
			var self = this;
			var _nonce = $(self.wrapperClass).data( 'nonce' );
			var ajaxurl = this.uabb_ajaxurl;
			
			var data = {
				action: 'uabb_get_photos',
				node_id: self.settings.id,
				images_per_page: self.settings.imgPerPage,
				settings: self.settings.settings,
				security: _nonce
			};

			$(this.nodeClass).find('.uabb-gallery-loader').show();

			$.ajax({
				type: 'post',
				url: ajaxurl,
				data: data,
				dataType: 'json',
				async: true,
				success: function(response) {
					response = JSON.parse(JSON.stringify(response));
					
						self.cachedItems = response.data;
						self._renderItems();
						if ( 'function' === typeof callback ) {
							callback();
						}
						$(self.nodeClass).find('.uabb-gallery-loader').hide();
				}
			});
		},

		_renderItems: function()
		{
			$(this.nodeClass).find( '.uabb-form-loader' ).remove();
			$(this.nodeClass).find( '.uabb-gallery-load-more' ).removeClass('disabled loading');
			$(this.nodeClass).find('.uabb-gallery-loader').show();
			
			var self = this,
				wrap = $(self.wrapperClass);

			if ( self.cachedItems ) {
				var count = 1;
				var items = [];

				$(self.cachedItems).each(function() {
					var id = $(this).data('item-id');

					if ( -1 === $.inArray( id, self.cachedIds ) && undefined !== id ) {
						if ( count <= self.imgPerPage ) {
							self.cachedIds.push( id );
							items.push( this );
							count++;
						}
					}
				});

				if ( items.length > 0 ) {
					items = $(items).hide();
					
					// Grid layout.
					if ( self.layout === 'grid' ) {
						wrap.append( items.fadeIn() );
					}
					
					// Masonry layout.
					if ( self.layout === 'masonary' ) {
						items = items.show();
						wrap.isotope('insert', items);
						wrap.imagesLoaded($.proxy(function () {
							setTimeout(function () {
								wrap.isotope('layout');
							}, 500);
						}, this));
					}

					wrap.trigger('gallery.rendered');
				}

				if ( self.total_img_count === self.cachedIds.length ) {
					$(self.nodeClass).find('.uabb-gallery-pagination').addClass('loaded').hide();
					$(self.nodeClass).find('.uabb-gallery-loader').hide();
				}
			}
		}
	};
})(jQuery);