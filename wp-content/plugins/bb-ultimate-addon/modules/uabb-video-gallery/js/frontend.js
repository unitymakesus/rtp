(function($) {
	UABBVideoGallery = function( settings ) {

		this.settings       = settings;
		this.node           = settings.id;
		this.layout         = settings.layout;
		this.slidesToShow   = settings.slidesToShow;
		this.slidesToScroll = settings.slidesToScroll;
		this.autoplaySpeed  = settings.autoplaySpeed;
		this.autoplay       = settings.autoplay;
		this.infinite       = settings.infinite;
		this.pauseOnHover   = settings.pauseOnHover;
		this.speed          = settings.speed;
		this.arrows         = settings.arrows;
		this.small_breakpoint = settings.small_breakpoint;
		this.medium_breakpoint = settings.medium_breakpoint;
		this.medium          = settings.medium;
		this.small           = settings.small;
		this.slidesToScroll_medium = settings.slidesToScroll_medium,
		this.slidesToScroll_small = settings.slidesToScroll_small,
		this.dots = settings.dots,
		this.nodeClass      = '.fl-node-' + settings.id;
		this.next_arrow = settings.next_arrow;
    this.prev_arrow = settings.prev_arrow;

		this._init();
		this._initIframe();
		this._openOnLink();
	};
	UABBVideoGallery.prototype = {
		settings	: {},
		node        :'',
		nodeClass   : '',

		_init:function() {
			var nodeClass  		= jQuery(this.nodeClass);

			$( this.nodeClass + ' .uabb-video-gallery-wrap' ).each( function() {
				var selector 	= $(this);

				if ( ! selector.hasClass( 'uabb-video-gallery-filter' ) ) {
						return;
				}

				var filters = nodeClass.find( '.uabb-video__gallery-filters' );
				var def_cat = '*';

				if ( filters.length > 0 ) {

					var def_filter = filters.data( 'default' );
					def_filter = def_filter.trim();
					if ( '' !== def_filter ) {

						def_cat = def_filter;

						def_cat_sel = filters.find( '[data-filter="' + def_filter + '"]' );

						if ( def_cat_sel.length > 0 ) {

							def_cat_sel.siblings().removeClass( 'uabb-filter__current' );

							def_cat_sel.addClass( 'uabb-filter__current' );
						}
					}
				}
				var $obj = {};

				selector.imagesLoaded( function( e ) {

					$obj = selector.isotope({
						filter: def_cat,
						layoutMode: 'masonry',
						itemSelector: '.uabb-video__gallery-item',
					});

					selector.find( '.uabb-video__gallery-item' ).resize( function() {
						$obj.isotope( 'layout' );
					});

				});

			});
		},

		_initIframe:function() {

			var nodeClass  	= jQuery(this.nodeClass);
				selector 	= nodeClass.find( '.uabb-video-gallery-wrap' );
			 	layout 		= selector.data( 'layout' );
				action 		= selector.data( 'action' );
				all_filters = selector.data( 'all-filters' );
				carousel	= selector.find('.uabb-vg__layout-carousel');
				if ( selector.length < 1 ) {
					return;
				}


				if ( 'inline' === action ) {

					nodeClass.find( '.uabb-vg__play_full' ).on( 'click', function( e ) {


						e.preventDefault();
						var iframe 		= $( "<iframe/>" );
						var vurl 		= $( this ).data( 'url' );
						var overlay		= $( this ).closest( '.uabb-video__gallery-item' ).find( '.uabb-vg__overlay' );
						var wrap_outer  = $( this ).closest( '.uabb-video__gallery-iframe' );

							iframe.attr( 'src', vurl );
							iframe.attr( 'frameborder', '0' );
							iframe.attr( 'allowfullscreen', '1' );
							iframe.attr( 'allow', 'autoplay;encrypted-media;' );

							wrap_outer.html( iframe );
							wrap_outer.attr( 'style', 'background:#000;' );
							overlay.hide();
					});

				}

				if('lightbox' === action ) {
					nodeClass.find('.uabb-video-gallery-fancybox').magnificPopup({
						type: 'iframe',
						mainClass: 'mfp-fade',
						removalDelay: 160,
						preloader: true,
						closeBtnInside: false,
						fixedContentPos: false,
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							},
						});
				}

				if( 'carousel' === layout && selector.hasClass( 'uabb-vg__layout-carousel' )) {
						self = this;
					nodeClass.find('.uabb-video-gallery-wrap').find( '.uabb-video__gallery-iframe' )
						.imagesLoaded( { background: true } )
						.done( function( e ) {
							nodeClass.find('.uabb-video-gallery-wrap').uabbslick({
								dots: self.dots,
			                	infinite: self.infinite,
			                	arrows: self.arrows,
			                	lazyLoad: 'ondemand',
			                	slidesToShow: self.slidesToShow,
			                	slidesToScroll: self.slidesToScroll,
			                	autoplay: self.autoplay,
			                	autoplaySpeed: self.autoplaySpeed,
			                	pauseOnHover:self.pauseOnHover,
			                	speed:self.speed,
												prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class=" '+ self.prev_arrow +' "></i></button>',
				                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="'+ self.next_arrow +' "></i></button>',
			                	responsive: [
			                    {
			                        breakpoint:self.medium_breakpoint,
			                        settings: {
			                            slidesToShow: self.medium,
			                             slidesToScroll:self.slidesToScroll_medium
			                        }
			                    },
			                    {
			                        breakpoint:self.small_breakpoint,
			                        settings: {
			                            slidesToShow: self.small,
			                            slidesToScroll:self.slidesToScroll_small
			                        }
			                    }
			                ]
							});
					} );
				}
				// If Filters is the layout.
			if( selector.hasClass( 'uabb-video-gallery-filter' ) ) {

				var filters = nodeClass.find( '.uabb-video__gallery-filters' );

				var def_cat = '*';

				if(filters.length > 0){

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

				nodeClass.find('.uabb-video-gallery-wrap').imagesLoaded( { background: '.item' }, function( e ) {

					$obj = nodeClass.find('.uabb-video-gallery-wrap').isotope({
						filter: def_cat,
						layoutMode: 'masonry',
						itemSelector: '.uabb-video__gallery-item',
					});

					nodeClass.find('.uabb-video-gallery-wrap').find( '.uabb-video__gallery-item' ).resize( function() {
					$obj.isotope( 'layout' );
					});
				});
				nodeClass.find( '.uabb-video__gallery-filter' ).on( 'click', function() {

					$( this ).siblings().removeClass( 'uabb-filter__current' );
					$( this ).addClass( 'uabb-filter__current' );
					var value = $( this ).data( 'filter' );
					nodeClass.find('.uabb-video-gallery-wrap').isotope( { filter: value } );
				} );
			}
		},
		_openOnLink : function() {
			var nodeClass  		= jQuery(this.nodeClass);
			var hashval = window.location.hash,
				id = hashval.split( '#' ).pop();

			if( ! id ) {
				return;
			}

			$( this.nodeClass + ' .uabb-video-gallery-wrap' ).each( function() {
				var selector 	= $(this);

				if ( ! selector.hasClass( 'uabb-video-gallery-filter' ) ) {
						return;
				}

				var filters = nodeClass.find( '.uabb-video__gallery-filters' );

				if ( filters.length > 0 ) {

					if ( '' !== id ) {

						id = '.' + id.toLowerCase();
						def_cat = id;

						def_cat_sel = filters.find( '[data-filter="' + id + '"]' );

						if ( def_cat_sel.length > 0 ) {

							def_cat_sel.siblings().removeClass( 'uabb-filter__current' );

							def_cat_sel.addClass( 'uabb-filter__current' );
						}
					}
				}
				var $obj = {};

				selector.imagesLoaded( function( e ) {

					$obj = selector.isotope({
						filter: def_cat,
						layoutMode: 'masonry',
						itemSelector: '.uabb-video__gallery-item',
					});

					selector.find( '.uabb-video__gallery-item' ).resize( function() {
						$obj.isotope( 'layout' );
					});
				});
			});
		}
	};
})(jQuery);
