(function($) {
    UABBBusinessReview = function( settings ) {
        
        this.settings           = settings;
        this.node               = settings.id;
        this.layout             = settings.review_layout;
        this.slidesToShow       = settings.slidesToShow;
        this.slidesToScroll     = settings.slidesToScroll;
        this.autoplaySpeed      = settings.autoplaySpeed;
        this.autoplay           = settings.autoplay;
        this.infinite           = settings.infinite;
        this.pauseOnHover       = settings.pauseOnHover;
        this.speed              = settings.speed;
        this.arrows             = settings.arrows;
        this.small_breakpoint   = settings.small_breakpoint;
        this.medium_breakpoint  = settings.medium_breakpoint;
        this.medium             = settings.medium;
        this.small              = settings.small;
        this.equal_height_box         = settings.equal_height_box;
        this.slidesToScroll_medium = settings.slidesToScroll_medium;
        this.slidesToScroll_small = settings.slidesToScroll_small;
        this.dots = settings.dots;
        this.skin_type = settings.skin_type;
        this.next_arrow = settings.next_arrow;
        this.prev_arrow = settings.prev_arrow;
        this.nodeClass      = '.fl-node-' + this.node;
        this._init();

    };
    UABBBusinessReview.prototype = {
        settings    : {},
        node        :'',
        nodeClass   : '',

        _init:function() {
            var nodeClass       = $( this.nodeClass );

            if( this.layout == 'carousel' ) {

                if( this.equal_height_box == 'yes' ) {
                 
                    jQuery( this.nodeClass ).find( '.uabb-review-layout-carousel' ).on( 'init', this._uabbReviewCarouselHeight );
                    $( this.nodeClass ).find( '.uabb-review-layout-carousel' ).on('init', $.proxy( this._uabbReviewsCarouselEqualHeight, this ) );
               
                }
                    this._uabbReviewCarousel();

            } 
        },

        _uabbReviewCarousel:function() {

            var nodeClass   = jQuery(this.nodeClass);
            self = this;
            
            nodeClass.find('.uabb-reviews-module-wrap').uabbslick({
                dots: self.dots,
                infinite: self.infinite,
                arrows: self.arrows,
                lazyLoad: 'ondemand',
                slidesToShow: self.slidesToShow,
                slidesToScroll: self.slidesToScroll,
                autoplay: self.autoplay,
                autoplaySpeed: self.autoplaySpeed,
                easing:'linear',
                pauseOnHover:true,
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
        },

        _uabbReviewCarouselHeight: function( slick, currentSlide ) {


            var id = $( this ).parents( '.fl-module-uabb-business-reviews' ).data( 'node' ),
                nodeClass = '.fl-node-' + id,
                grid = $( nodeClass ).find( '.uabb-review-layout-carousel' ),
                reviews_wrapper = grid.find('.uabb-reviews-module-wrapper'),
                reviews_active = grid.find('.uabb-review-wrap'),

                max_height = -1,
                wrapper_height = -1;

            reviews_active.each(function( i ) {

                var this_height = $( this ).outerHeight(),
                    review = $( this ).find( '.uabb-review' ),
                    review_height = review.outerHeight();

                if( max_height < review_height ) {
                    max_height = review_height;
                }

                if ( wrapper_height < this_height ) {
                    wrapper_height = this_height
                }
            });

            reviews_active.each( function( i ) {
                var selector = jQuery( this ).find( '.uabb-review' );
                selector.css( "height", max_height );
            });

            grid.find('.slick-list.draggable').animate({ height: max_height }, { duration: 200, easing: 'linear' });
           
            max_height = -1;
            wrapper_height = -1;
            
            reviews_wrapper.each(function() {
                var $this = jQuery( this ),
                    selector = $this.find( '.uabb-review-wrap' ),
                    review = $this.find( '.uabb-review-inner-wrap' ),
                    review_height = review.outerHeight();

                if ( $this.hasClass('slick-active') ) {
                    return true;
                }

                selector.css( 'height', review_height );
            });
        },

        _uabbReviewsCarouselEqualHeight: function() {
        
            var id = $( this ).parents( '.fl-module-uabb-business-reviews' ).data( 'node' );
                nodeClass = $( '.fl-node-' + this.node );
                grid = $( nodeClass ).find( '.uabb-review-layout-carousel' );
                reviews_wrapper = grid.find('uabb-reviews-module-wrapper');
                reviews_active = nodeClass.find('.uabb-review-layout-carousel');
                max_height = -1,
                wrapper_height = -1;

                if( 'bubble' === this.skin_type ) {
                    reviews_wrapper = grid.find('.uabb-review-content-wrap');
                    reviews_active = nodeClass.find('.uabb-review-content');
                }
                self = this;
            reviews_active.each(function( i ) {

                var this_height = $( this ).outerHeight();

                    if ( 'bubble' === self.skin_type ) {
                        review_height = this_height;

                    } else {
                        review = $( this ).find( '.uabb-review-wrap' );
                        review_height = review.outerHeight(); 
                    }
                   
                if( max_height < review_height ) {
                    max_height = review_height;
                }

                if ( wrapper_height < this_height ) {
                    wrapper_height = this_height
                }
            });


            reviews_active.each( function( i ) {
                if ( 'bubble' === self.skin_type ) {
                    var selector = jQuery( this );
                } else {
                    var selector = jQuery( this ).find( '.uabb-review' );
                }
                selector.css( "height", max_height-15 );
            });
            if ( 'bubble' !== self.skin_type ) {

                grid.find('.slick-list.draggable').animate({ height: max_height }, { duration: 200, easing: 'linear' });

            }
           
            max_height = -1;
            wrapper_height = -1;
            
            reviews_wrapper.each(function() {
                var $this = jQuery( this ),
                    selector = $this.find( '.uabb-review-wrap' ),
                    review = $this.find( '.uabb-review-inner-wrap' ),
                    review_height = review.outerHeight();

                if ( $this.hasClass('slick-active') ) {
                    return true;
                }

                selector.css( 'height', review_height );
            });

       },

    };
})(jQuery);