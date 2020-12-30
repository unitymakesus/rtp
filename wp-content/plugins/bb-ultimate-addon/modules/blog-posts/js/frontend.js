
var UABBBlogPosts;

(function($) {
    
    /**
     * Class for Blog Posts Module
     *
     * @since 1.6.1
     */
    UABBBlogPosts = function( settings ){
        
        // set params
        this.nodeClass           = '.fl-node-' + settings.id;
        this.id                 = settings.id;
        this.wrapperClass        = this.nodeClass + ' .uabb-blog-posts';
        this.postClass          = this.nodeClass + ' .uabb-post-wrapper';
        this.pagination         = settings.pagination;
        this.is_carousel         = settings.is_carousel;
        this.infinite         = settings.infinite;
        this.arrows         = settings.arrows;
        this.desktop         = settings.desktop;
        this.moduleUrl  = settings.moduleUrl;
        this.loaderUrl  = settings.loaderUrl;
        this.prevArrow  = settings.prevArrow;
        this.nextArrow  = settings.nextArrow;
        this.medium         = settings.medium;
        this.small         = settings.small;
        this.slidesToScroll         = settings.slidesToScroll;
        this.autoplay         = settings.autoplay;
        this.autoplaySpeed         = settings.autoplaySpeed;
        this.dots = settings.dots;
        this.small_breakpoint         = settings.small_breakpoint;
        this.medium_breakpoint         = settings.medium_breakpoint;
        this.equal_height_box         = settings.equal_height_box;
        this.mesonry_equal_height      = settings.mesonry_equal_height;
        this.uabb_masonary_filter_type = settings.uabb_masonary_filter_type;
        this.element_space = settings.element_space;

        if( this.is_carousel == 'carousel' ) {
            this._uabbBlogPostCarousel();
            if( this.equal_height_box == 'yes' ) {
                jQuery( this.nodeClass ).find( '.uabb-blog-posts-carousel' ).on('afterChange', this._uabbBlogPostCarouselHeight );
                jQuery( this.nodeClass ).find( '.uabb-blog-posts-carousel' ).on('init', $.proxy( this._uabbBlogPostCarouselEqualHeight, this ) );
            }
        } else if ( this.is_carousel == 'masonary' ) {
            this._uabbBlogPostMasonary();
        } else if ( this.is_carousel == 'grid' ) {
            this._uabbBlogPostGrid();
        }

        if( settings.blog_image_position == 'background' ) {
            this._uabbBlogPostImageResize();
        }

        if(this._hasPosts()) {
               this._initInfiniteScroll();
        }

        this._openOnLink();
    };

    UABBBlogPosts.prototype = {
        nodeClass               : '',
        wrapperClass            : '',
        is_carousel             : 'grid',
        infinite                : '',
        arrows                  : '',
        desktop                 : '',
        medium                  : '',
        small                   : '',
        slidesToScroll          : '',
        autoplay                : '',
        autoplaySpeed           : '',
        small_breakpoint        : '',
        medium_breakpoint       : '',
        equal_height_box        : 'yes',
        mesonry_equal_height    : 'no',
        uabb_masonary_filter_type : 'buttons',

        _hasPosts: function()
        {
            return $(this.postClass).length > 0;
        },

        _initInfiniteScroll: function()
        {
            if(this.pagination == 'scroll' && typeof FLBuilder === 'undefined') {
                var $this = this;
                setTimeout(function(){
                   $this._infiniteScroll();
                }, 500);
            }
        },

        _infiniteScroll: function(settings)
        {
            var path        = $(this.nodeClass + ' .uabb-blogs-pagination a.next').attr('href');
                pagePattern = /(.*?(\/|\&|\?)paged-[0-9]{1,}(\/|=))([0-9]{1,})+(.*)/;
                wpPattern   = /^(.*?\/?page\/?)(?:\d+)(.*?$)/;
                pageMatched = null;

                scrollData = {
                    navSelector     : this.nodeClass + ' .uabb-blogs-pagination',
                    nextSelector    : this.nodeClass + ' .uabb-blogs-pagination a.next',
                    itemSelector    : this.postClass,
                    prefill         : true,
                    bufferPx        : 200,
                    loading         : {
                        msgText         : 'Loading',
                        finishedMsg     : '',
                        img             : this.moduleUrl + '/img/ajax-loader-grey.gif',
                        speed           : 10,
                    }
                };
            if ( pagePattern.test( path ) ) {
                scrollData.path = function( currPage ){
                    pageMatched = path.match( pagePattern );
                    path = pageMatched[1] + currPage + pageMatched[5];
                    return path;
                }
            }
            else if ( wpPattern.test( path ) ) {
                scrollData.path = path.match( wpPattern ).slice( 1 );
            }

            $(this.wrapperClass).infinitescroll( scrollData, $.proxy(this._infiniteScrollComplete, this) );
            setTimeout(function(){
                $(window).trigger('resize');
            }, 100);
        },

        _infiniteScrollComplete: function(elements)
        {
            var wrap = $(this.wrapperClass);
            elements = $(elements);
            if( this.is_carousel == 'masonary' ) {
                wrap.isotope('appended', elements);
            } else if ( this.is_carousel == 'grid' ) {
                wrap.imagesLoaded( $.proxy( function() {
                if( this.equal_height_box == 'yes' ) {
                    this._uabbBlogPostMesonryHeight();
                }
                wrap.isotope('appended', elements);
                wrap.isotope('layout');
                }, this ) );
            }
        },

        _uabbBlogPostCarousel: function() {
            if( this.equal_height_box == 'yes' ) {
                this._uabbBlogPostCarouselEqualHeight();
            }

            var grid = jQuery( this.nodeClass ).find( '.uabb-blog-posts-carousel' );

            jQuery( this.nodeClass ).find( '.uabb-blog-posts-carousel' ).uabbslick({
                dots: this.dots,
                infinite: this.infinite,
                arrows: this.arrows,
                lazyLoad: 'ondemand',
                slidesToShow: this.desktop,
                slidesToScroll: this.slidesToScroll,
                autoplay: this.autoplay,
                prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class=" '+ this.prevArrow +' "></i></button>',
                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="'+ this.nextArrow +' "></i></button>',
                autoplaySpeed: this.autoplaySpeed,
                adaptiveHeight: false,
                responsive: [
                    {
                        breakpoint: this.medium_breakpoint,
                        settings: {
                            slidesToShow: this.medium,
                            slidesToScroll: this.medium,
                        }
                    },
                    {
                        breakpoint: this.small_breakpoint,
                        settings: {
                            slidesToShow: this.small,
                            slidesToScroll: this.small,
                        }
                    }
                ]
            });
        },

        _uabbBlogPostMasonary: function() {

            var id = this.id,
                nodeClass = this.nodeClass;

            if( this.mesonry_equal_height == 'yes' ) {
                LayoutMode = 'fitRows';
            }
            else {
                LayoutMode = 'masonry';
            }

            $grid = jQuery( nodeClass ).find('.uabb-blog-posts-masonary').isotope({
                layoutMode: LayoutMode,
                itemSelector: '.uabb-blog-posts-masonary-item-' + this.id,
                masonry: {
                    columnWidth: '.uabb-blog-posts-masonary-item-' + this.id
                }
            });

            if( this.uabb_masonary_filter_type == 'drop-down' ) {

                jQuery( nodeClass ).find('.uabb-masonary-filters').on('change', function() {
                    value = jQuery( nodeClass ).find('.uabb-masonary-filters option:selected').data('filter');
                    jQuery( nodeClass + ' .uabb-blog-posts-masonary' ).isotope( { filter: value } )
                });
            }
            else {
                jQuery( nodeClass ).find('.uabb-masonary-filters .uabb-masonary-filter-' + id).on('click', function(){
                    jQuery( this ).siblings().removeClass( 'uabb-masonary-current' );
                    jQuery( this ).addClass( 'uabb-masonary-current' );
                    var value = jQuery( this ).data( 'filter' );
                    jQuery( nodeClass + ' .uabb-blog-posts-masonary' ).isotope( { filter: value } )
                });
            }


            if( this.mesonry_equal_height == 'yes' ) {
                this._uabbBlogPostMesonryHeight();
            }

            // remove mesonry instance
            /*jQuery( nodeClass + ' .uabb-blog-posts-masonary' ).masonry({
                columnWidth: '.uabb-blog-posts-masonary-item-' + id,
                itemSelector: '.uabb-blog-posts-masonary-item-' + id
            });*/
        },

        _uabbBlogPostGrid: function() {

            var id = this.id,
                nodeClass = this.nodeClass,
                LayoutMode = 'fitRows';

            $grid = jQuery( nodeClass ).find('.uabb-blog-posts-grid').isotope({
                layoutMode: LayoutMode,
                itemSelector: '.uabb-blog-posts-grid-item-' + this.id,
                gutter: parseInt(this.element_space),
                isFitWidth          : true,
                transitionDuration  : 0,
                masonry: {
                    columnWidth: this.nodeClass + ' .uabb-post-grid-sizer'
                }
            });


            if( this.uabb_masonary_filter_type == 'drop-down' ) {

                jQuery( nodeClass ).find('.uabb-masonary-filters').on('change', function() {
                    value = jQuery( nodeClass ).find('.uabb-masonary-filters option:selected').data('filter');
                    jQuery( nodeClass + ' .uabb-blog-posts-grid' ).isotope( { filter: value } )
                });
            }
            else {
                jQuery( nodeClass ).find('.uabb-masonary-filters .uabb-masonary-filter-' + id).on('click', function(){
                    jQuery( this ).siblings().removeClass( 'uabb-masonary-current' );
                    jQuery( this ).addClass( 'uabb-masonary-current' );
                    var value = jQuery( this ).data( 'filter' );
                    jQuery( nodeClass + ' .uabb-blog-posts-grid' ).isotope( { filter: value } )
                });
            }
            if( this.equal_height_box == 'yes' ) {
                jQuery( nodeClass + ' .uabb-blog-posts-grid' ).imagesLoaded( $.proxy( function() {
                    this._uabbBlogPostMesonryHeight();
                    jQuery( nodeClass + ' .uabb-blog-posts-grid' ).isotope('layout');
                }, this ) );
            }
            $(window).scroll($.debounce( 25, function(){
                jQuery( nodeClass + ' .uabb-blog-posts-grid' ).isotope('layout');
            }));
        },

        _openOnLink : function() {
            var nodeClass       = jQuery(this.nodeClass);
            if ( this.is_carousel == 'masonary' ) {
                var layoutClass = '.uabb-blog-posts-masonary';
            } else if ( this.is_carousel == 'grid' ) {
                var layoutClass = '.uabb-blog-posts-grid';
            }
            
            // Regexp for validating user input as ID : https://regex101.com/r/KGj6I6/1
            var pattern = new RegExp('^[\\w\\-]+$');

                var id = window.location.hash.substring(1);

            if ( pattern.test( id ) ) {

                $( this.nodeClass + layoutClass ).each( function() {
                var selector    = $(this);

                    var filters = nodeClass.find( '.uabb-masonary-filters' );

                    if ( filters.length > 0 ) {

                        if ( '' !== id ) {

                            id = '.' + id.toLowerCase();
                            def_cat = id;

                            def_cat_sel = filters.find( '[data-filter="' + id + '"]' );

                            if ( 0 === def_cat_sel.length ) {
                                return;
                            }

                            if ( def_cat_sel.length > 0 ) {

                                def_cat_sel.siblings().removeClass( 'uabb-masonary-current' );

                                def_cat_sel.addClass( 'uabb-masonary-current' );
                            }
                        }
                    }

                        selector.isotope({
                            filter: def_cat,
                        });

                });
            }
        },

        _uabbBlogPostCarouselEqualHeight: function() {
            
            var id = this.id,
                nodeClass = this.nodeClass,
                small_breakpoint = this.small_breakpoint,
                medium_breakpoint = this.medium_breakpoint,
                desktop = this.desktop,
                medium = this.medium,
                small = this.small,
                node = jQuery( nodeClass ),
                grid = node.find( '.uabb-blog-posts' ),
                post_wrapper = grid.find('.uabb-post-wrapper'),
                post_active = grid.find('.uabb-post-wrapper.slick-active'),
                max_height = -1,
                wrapper_height = -1,
                i = 1,
                counter = parseInt( desktop ),
                childEleCount = post_wrapper.length,
                remainingNodes = ( childEleCount % counter );

                if( window.innerWidth <= small_breakpoint ) {
                    counter = parseInt( small );
                } else if( window.innerWidth > medium_breakpoint ) {
                    counter = parseInt( desktop );
                } else {
                    counter = parseInt( medium );
                }

                post_active.each(function() {
                    var $this = jQuery( this ),
                        this_height = $this.outerHeight(),
                        selector = $this.find( '.uabb-blog-posts-shadow' ),
                        blog_post = $this.find( '.uabb-blog-post-inner-wrap' ),
                        selector_height = selector.outerHeight(),
                        blog_post_height = blog_post.outerHeight();

                    if( max_height < blog_post_height ) {
                        max_height = blog_post_height;
                    }

                    if ( wrapper_height < this_height ) {
                        wrapper_height = this_height
                    }
                });

                post_active.each(function() {
                    var $this = jQuery( this );

                    $this.find( '.uabb-blog-posts-shadow' ).css( 'height', max_height );
                });     

                grid.find('.slick-list.draggable').animate({ height: max_height }, { duration: 200, easing: 'linear' });
                //grid.find('.slick-list.draggable').css( 'height', wrapper_height );
                
                max_height = -1;
                wrapper_height = -1;

                post_wrapper.each(function() {
                    $this = jQuery( this ),
                    selector = $this.find( '.uabb-blog-posts-shadow' ),
                    selector_height = selector.outerHeight();

                    if ( $this.hasClass('slick-active') ) {
                        return true;
                    }

                    selector.css( 'height', selector_height );
                });
        },

        _uabbBlogPostCarouselHeight: function( slick, currentSlide ) {
                
            var id = $( this ).parents( '.fl-module-blog-posts' ).data( 'node' ),
                nodeClass = '.fl-node-' + id,
                grid = $( nodeClass ).find( '.uabb-blog-posts-carousel' ),
                post_wrapper = grid.find('.uabb-post-wrapper'),
                post_active = grid.find('.uabb-post-wrapper.slick-active'),
                max_height = -1,
                wrapper_height = -1;
            
            post_active.each(function( i ) {
                var this_height = $( this ).outerHeight(),
                    blog_post = $( this ).find( '.uabb-blog-post-inner-wrap' ),
                    blog_post_height = blog_post.outerHeight();

                if( max_height < blog_post_height ) {
                    max_height = blog_post_height;
                }

                if ( wrapper_height < this_height ) {
                    wrapper_height = this_height
                }
            });

            post_active.each( function( i ) {
                var selector = jQuery( this ).find( '.uabb-blog-posts-shadow' );
                selector.css( "height", max_height );
            });

            grid.find('.slick-list.draggable').animate({ height: max_height }, { duration: 200, easing: 'linear' });
           
            max_height = -1;
            wrapper_height = -1;
            
            post_wrapper.each(function() {
                var $this = jQuery( this ),
                    selector = $this.find( '.uabb-blog-posts-shadow' ),
                    blog_post = $this.find( '.uabb-blog-post-inner-wrap' ),
                    blog_post_height = blog_post.outerHeight();

                if ( $this.hasClass('slick-active') ) {
                    return true;
                }

                selector.css( 'height', blog_post_height );
            });
        },

        _uabbBlogPostMesonryHeight: function() {

            var id = this.id,
                nodeClass = '.fl-node-' + id,
                max_height = -1,
                wrapper_height = -1;

            if ( this.is_carousel == 'masonary' ) {
                var grid = $( nodeClass ).find( '.uabb-blog-posts-masonary' );
            } else if ( this.is_carousel == 'grid' ) {
                var grid = $( nodeClass ).find( '.uabb-blog-posts-grid' );
            }
            var post_wrapper = grid.find('.uabb-post-wrapper');

            post_wrapper.each(function( i ) {
                var this_height = $( this ).outerHeight(),
                    blog_post = $( this ).find( '.uabb-blog-post-inner-wrap' ),
                    blog_post_height = blog_post.outerHeight();

                if( max_height < blog_post_height ) {
                    max_height = blog_post_height;
                }

                if ( wrapper_height < this_height ) {
                    wrapper_height = this_height
                }

            });

            post_wrapper.each( function( i ) {
                var selector = jQuery( this ).find( '.uabb-blog-posts-shadow' );
                selector.css( "height", max_height );
            });
        },

        _uabbBlogPostImageResize: function() {
            var id = this.id,
                nodeClass = this.nodeClass,
                small_breakpoint = this.small_breakpoint,
                medium_breakpoint = this.medium_breakpoint,
                node = jQuery( nodeClass ),
                grid = node.find( '.uabb-blog-posts' );
            
            grid.find( '.uabb-post-wrapper' ).each(function() {
                var img_selector = jQuery(this).find('.uabb-post-thumbnail'),
                    img_wrap_height = parseInt( img_selector.height() ),
                    img_height = parseInt( img_selector.find('img').height() );
                    
                if( !isNaN( img_wrap_height ) && !isNaN( img_height ) ) {
                    if( img_wrap_height >= img_height ) {
                        img_selector.find('img').css( 'min-height', '100%' );

                    } else {
                        img_selector.find('img').css( 'min-height', '' );
                    }
                }
            });
        }
    };

})(jQuery);
