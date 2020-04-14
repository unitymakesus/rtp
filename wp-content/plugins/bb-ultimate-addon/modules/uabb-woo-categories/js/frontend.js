var UABBWooCategories;

(function($) {

	/**
	 * Class for Number Counter Module
	 *
	 * @since 1.6.1
	 */
	UABBWooCategories = function( settings ){

		// set params
		this.nodeID			= settings.id;
		this.nodeClass		= '.fl-node-' + settings.id;
		this.nodeScope		= $( '.fl-node-' + settings.id );
		this.layout			= settings.layout;

		this.infinite			= settings.infinite;
		this.dots				= settings.dots;
		this.arrows				= settings.arrows;
		this.desktop			= settings.desktop;
		this.slidesToScroll		= settings.slidesToScroll;
		this.autoplay			= settings.autoplay;
		this.autoplaySpeed		= settings.autoplaySpeed;
		this.medium_breakpoint	= settings.medium_breakpoint;
		this.medium				= settings.medium;
		this.small_breakpoint	= settings.small_breakpoint;
		this.small				= settings.small;
		this.next_arrow = settings.next_arrow;
    this.prev_arrow = settings.prev_arrow;

		// initialize
		this._initWooProducts();
	};

	UABBWooCategories.prototype = {

		nodeID				: '',
		nodeClass			: '',
		nodeScope			: '',
		layout 				: '',
		infinite			: '',
		dots				: '',
		arrows				: '',
		desktop				: '',
		slidesToScroll		: '',
		autoplay 			: '',
		autoplaySpeed 		: '',
		medium_breakpoint 	: '',
		medium 				: '',
		small_breakpoint	: '',
		small 				: '',

		_initWooProducts: function(){
			//alert();
			var self = this;

			/* Slider */
			if ( 'carousel' === self.layout ) {
				var slider_wrapper 	= self.nodeScope.find('.uabb-woo-categories-carousel');

				if ( slider_wrapper.length > 0 ) {

					var slider_selector = slider_wrapper.find('ul.products');

					slider_selector.imagesLoaded( function(e) {
						slider_selector.uabbslick({
			                dots: self.dots,
			                infinite: self.infinite,
			                arrows: self.arrows,
			                lazyLoad: 'ondemand',
			                slidesToShow: self.desktop,
			                slidesToScroll: self.slidesToScroll,
			                autoplay: self.autoplay,
			                autoplaySpeed: self.autoplaySpeed,
											prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><i class=" '+ self.prev_arrow +' "></i></button>',
											nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><i class="'+ self.next_arrow +' "></i></button>',
			                responsive: [
			                    {
			                        breakpoint: self.medium_breakpoint,
			                        settings: {
			                            slidesToShow: self.medium
			                        }
			                    },
			                    {
			                        breakpoint: self.small_breakpoint,
			                        settings: {
			                            slidesToShow: self.small
			                        }
			                    }
			                ]
			            });
					});
				}
			}
		},
	};
})(jQuery);
