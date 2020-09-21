(function($) {

	UABBDevices = function( settings )
	{
		this.settings 	= settings;
		this.nodeClass  = '.fl-node-' + settings.id;
		this.infinite          = settings.infinite;
        this.arrows            = settings.arrows;
        this.autoplay          = settings.autoplay;
        this.next_arrow = settings.next_arrow;
        this.prev_arrow = settings.prev_arrow;
        this.medium_breakpoint = settings.medium_breakpoint;
        this.small_breakpoint  = settings.small_breakpoint;
        this.media_type = settings.media_type;
        this.device_type = settings.device_type;

		var outer_wrap = jQuery(this.nodeClass).find( '.uabb-video__outer-wrap' );

		$( this.nodeClass ).find( '.uabb-device-media-slider .uabb-device-media-screen-inner' ).on('init', $.proxy( this._adaptiveImageHeight, this ) );
		this._init();
		if( '1' == outer_wrap.data( 'autoplay' ) || true == outer_wrap.data( 'device' ) ) {
      			this._playVideo( jQuery(this.nodeClass).find( '.uabb-video__play' ) );
    	}
	};

	UABBDevices.prototype = {

		settings	: {},
		nodeClass   : '',

		_init: function()
		{

            $( this.nodeClass + ' .uabb-video__play' ).on('click', $.proxy( this._playVideo, this ) );

			if ( 'slider' === this.media_type ) {
			var node = $( this.nodeClass ),
                img_carousel = node.find( '.uabb-device-media-slider .uabb-device-media-screen-inner' );

            img_carousel.uabbslick({
                dots: false,
                infinite: this.infinite,
                arrows: this.arrows,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: this.autoplay,
                adaptiveHeight: true,
                prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class=" '+ this.prev_arrow +' "></i></button>',
                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="'+ this.next_arrow +' "></i></button>',
                responsive: [
                    {
                        breakpoint: this.medium_breakpoint,
                        settings: {
                            slidesToShow: this.medium
                        }
                    },
                    {
                        breakpoint: this.small_breakpoint,
                        settings: {
                            slidesToShow: this.small
                        }
                    }
                ]
            });
            img_carousel.on('afterChange', $.proxy( this._adaptiveImageHeight, this ) );
       		}

            if ( 'iframe' === this.media_type ) {

                var node = $( this.nodeClass );

                    if( node.find( '.uabb-device-media-screen-inner iframe' ).length === 0 ) {

                        var src = node.find( '.uabb-content-type-iframe' ).data( 'src' );

                        var iframe = document.createElement( "iframe" );
                                    iframe.setAttribute( "src", src );
                                    iframe.setAttribute( "style", "display:none;" );
                                    iframe.setAttribute( "frameborder", "0" );
                                    iframe.setAttribute( "allowfullscreen", "1" );
                                    iframe.setAttribute( "width", "100%" );
                                    iframe.setAttribute( "height", "100%" );
                                    iframe.setAttribute( "class", "uabb-content-iframe" );

                                    node.find( '.uabb-device-media-screen-inner' ).html( iframe );
                                    node.find( '.uabb-device-media-screen-inner' ).append( '<div class="uabb-loader"></div>' );

                        var id = this.node;

                        iframe.onload = function() {
                           node.find( 'uabb-devices-content .uabb-loader' ).fadeOut();
                            this.style.display='block';
                        };

                    }
                }

		},
		_playVideo: function( e )
		{
			var selector  = $( this ).find( '.uabb-video__play-icon' );
			var iframe 	  = $( "<iframe/>" );
			var vurl 	  = $(this.nodeClass).find('.uabb-video__play').data( 'src' );
			if ( 0 == selector.find( 'iframe' ).length ) {
				iframe.attr( 'src', vurl );
				iframe.attr( 'frameborder', '0' );
				iframe.attr( 'allowfullscreen', '1' );
				iframe.attr( 'allow', 'autoplay;encrypted-media;' );
				$(this.nodeClass).find('.uabb-video__play').html( iframe );
				$(this.nodeClass).find('.uabb-video__play').closest( '.uabb-video__outer-wrap' ).find( '.uabb-vimeo-wrap' ).hide();
				$(this.nodeClass).find('.uabb-video-player-cover.uabb-player-cover' ).css("opacity","0");
			}
		},
		_adaptiveImageHeight: function() {

            var node = $( this.nodeClass ),
                post_active = node.find('.uabb-image-carousel-item.slick-active'),
                max_height = -1;

            post_active.each(function( i ) {

                var $this = $( this ),
                    this_height = $this.innerHeight();

                if( max_height < this_height ) {
                    max_height = this_height;
                }
            });

            node.find('.slick-list.draggable').animate({ height: max_height }, { duration: 200, easing: 'linear' });
            max_height = -1;
        }

	};

})(jQuery);
