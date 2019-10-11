(function( $ ){

	UABBInfoCircle = function( settings )
	{
		this.settings	= settings;
		this.node_IC	= settings.id;
		this.autoplay	= settings.autoplay;
		this.interval_time	= settings.interval;
		this.initial_animation = settings.initial_animation;
		this.responsive_nature = settings.responsive_nature;
		this.breakpoint = settings.breakpoint;
		this._initInfoCircle();
	};

	UABBInfoCircle.prototype = {

		infoCircle : '',

		_initInfoCircle : function() {
			this.infoCircle = $('.fl-node-'+this.node_IC).find('.uabb-info-circle-wrap');
			
			if ( this.initial_animation != 'no' ) {
				this._setInitialAnimation();
			}

			if(this.autoplay == 'yes') {
				this._setInfoCircleAutoPlay();
			}
			this._disableActiveAnimation();
		},

		/**
		 * Set Initial Animation to Thumbnail Image/Icon
		 */
		_setInitialAnimation : function() {
			var initial_animation = this.initial_animation,
				infoCircle = this.infoCircle;
			
			this.infoCircle.find('.uabb-info-circle-small > div').addClass('animated '+initial_animation);

			setTimeout(function(){
				infoCircle.find('.uabb-info-circle-small > div').attr('class','');
			}, 1500);
		},

		/**
		 * Disable Animation on mouseleave when Autopaly is disabled 
		 */
		_disableActiveAnimation : function() {
			var infoCircle = this.infoCircle;

			infoCircle.on( 'mouseleave', '.uabb-info-circle-small', function() {
				$(this).children('div').attr('class','');
			});
		},

		/**
		 * Start Autoplay
		 */
		_setInfoCircleAutoPlay : function () {

			var Screen_Size = $(window).outerWidth();
			if( this.responsive_nature != 'true' || ( this.responsive_nature == 'true' && Screen_Size > this.breakpoint ) ) {

				var infoCircle = this.infoCircle,
					interval_time = this.interval_time;

				var _interval = setInterval(function() {
					autoPlaySelector( 1, infoCircle );
				}, interval_time * 1000 );

				infoCircle.on('mouseenter click', '.uabb-info-circle-small .uabb-icon-wrap, .uabb-info-circle-small .uabb-image, .uabb-info-circle-in', function() {
					clearInterval( _interval );
				}).on( 'mouseleave', '.uabb-info-circle-small .uabb-icon-wrap, .uabb-info-circle-small .uabb-image, .uabb-info-circle-in', function() {
					_interval = setInterval(function() {
						autoPlaySelector( 1, infoCircle );
					}, interval_time * 1000 );
				});
			}
		}
	}

	function autoPlaySelector( autoplay, infoCircle ) {
		if( autoplay ) {
			
			var removefrom = infoCircle.find('.uabb-info-circle-icon-content.active'),
				addto = removefrom.next('.uabb-info-circle-icon-content');

			if(addto.length == 0) {
				addto = infoCircle.find('.uabb-info-circle-icon-content').first();;
			}

			updateActiveInfoCircle( removefrom, addto );
		}
	}

	/* Function to Update active class */
	function updateActiveInfoCircle( removefrom, addto ) {
		
		

		removefrom.find('.uabb-info-circle-in').fadeOut(300);
		addto.find('.uabb-info-circle-in').fadeIn(300);

		removefrom.removeClass('active');
		addto.addClass('active');

		/* Add/Remove Active Animation Classes */
		removefrom.find('.uabb-info-circle-small > div').attr('class','');
		addto.find('.uabb-info-circle-small > div').attr('class','');

		var ThumbActiveAnimation = addto.closest('.uabb-info-circle-wrap').data('active-animation');
		if( ThumbActiveAnimation != 'no' ) {
			addto.find('.uabb-info-circle-small > div').addClass('animated ' + ThumbActiveAnimation);
		}
	}
	
	/* Implement Height on Initially */
	$(document).ready(function(){
		resize_info_cirlce();
		
		/* On Hover trigger */
		$('.uabb-info-circle-wrap.on-hover').on('mouseenter', '.uabb-info-circle-small .uabb-icon-wrap, .uabb-info-circle-small .uabb-image', function() {

			var current_parent = $(this).closest('.uabb-info-circle-icon-content'),
				removeActiveFrom = current_parent.siblings('.uabb-info-circle-icon-content');

			updateActiveInfoCircle(removeActiveFrom , current_parent );

		});

		/* On Click trigger */
		$('.uabb-info-circle-wrap.on-click').on('click', '.uabb-info-circle-small .uabb-icon-wrap, .uabb-info-circle-small .uabb-image', function() {

			var current_parent = $(this).closest('.uabb-info-circle-icon-content'),
				removeActiveFrom = current_parent.siblings('.uabb-info-circle-icon-content');

			updateActiveInfoCircle(removeActiveFrom , current_parent );

		});

		/* FLBuilder Resize */
		if( jQuery('html').hasClass('fl-builder-edit') ) {
			FLBuilder.addHook( 'col-resize-drag', resize_info_cirlce );
			FLBuilder.addHook( 'col-resize-stop', resize_info_cirlce );
		}

		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			var info_circle_wrap = $( selector ).find('.uabb-info-circle-wrap');
			resize_info_cirlce_callback( info_circle_wrap );
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			var info_circle_wrap = $( selector ).find('.uabb-info-circle-wrap');
			resize_info_cirlce_callback( info_circle_wrap );
		});

	});

	/* Change Height on Resize */
	$(window).on('resize', resize_info_cirlce);

	/* Function to Update Info Cirlce height as Info Circle Width */
	function resize_info_cirlce() {
		var info_circle_wrap = $('.uabb-info-circle-wrap');
		resize_info_cirlce_callback( info_circle_wrap );
	}

	function resize_info_cirlce_callback( info_circle_wrap ) {
		
		info_circle_wrap.each(function(i,e) {
			var info_circle_width = $(this).outerWidth();
			$(this).css('height',info_circle_width);
		});
	}

})(jQuery);