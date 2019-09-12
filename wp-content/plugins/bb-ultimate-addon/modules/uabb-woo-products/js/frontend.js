var UABBWooProducts;
var key_array = new Array();

(function($) {

	/**
	 * Class for Number Counter Module
	 *
	 * @since 1.6.1
	 */
	UABBWooProducts = function( settings ){

		// set params
		this.nodeID			= settings.id;
		this.nodeClass		= '.fl-node-' + settings.id;
		this.nodeScope		= $( '.fl-node-' + settings.id );
		this.ajaxurl		= settings.ajaxurl;
		this.layout			= settings.layout;
		this.skin			= settings.skin;

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


		key_array.push({'id' : settings.id, 'set' : settings.module_settings});

		// initialize
		this._initWooProducts();

		$( document )
		.off( 'click', '.uabb-woocommerce-pagination a.page-numbers' )
		.on( 'click', '.uabb-woocommerce-pagination a.page-numbers',  function( e ) {

			e.preventDefault();

			$scope = $( this ).closest( '.fl-module-uabb-woo-products' );

			$scope.find( 'ul.products' ).after( '<div class="uabb-woo-loader"><div class="uabb-loader"></div><div class="uabb-loader-overlay"></div></div>' );

			if ( 'undefined' == typeof $scope ) {
				return;
			}

			var node = $scope.data( 'node' );
			var page_number = 1;
			var module_settings = '';
			for ( var i = 0; i < key_array.length; i++ ) {
				if ( key_array[i].id == node ) {
					module_settings = key_array[i].set;
				}
			}
			var curr = parseInt( $scope.find( '.uabb-woocommerce-pagination .page-numbers.current' ).html() );

			if ( $( this ).hasClass( 'next' ) ) {
				page_number = curr + 1;
			} else if ( $( this ).hasClass( 'prev' ) ) {
				page_number = curr - 1;
			} else {
				page_number = $( this ).html();
			}

			$.ajax({
				url: uabb.ajax_url,
				data: {
					action: 'uabb_get_products',
					settings: module_settings,
					node_id : settings.id,
					page_number : page_number
				},
				dataType: 'json',
				type: 'POST',
				success: function ( data ) {

					var selector = $scope.find( '.uabb-woo-products-inner ul.products' );

					$scope.find( '.uabb-woo-loader' ).remove();

					selector.replaceWith( data.data.html );
					$scope.find( '.uabb-woocommerce-pagination' ).replaceWith( data.data.pagination );
				}
			});

		} );
	};

	UABBWooProducts.prototype = {

		nodeID				: '',
		nodeClass			: '',
		nodeScope			: '',
		ajaxurl 			: '',
		layout 				: '',
		skin 				: '',
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

			//self._initCount();

			// if ( 'undefined' == typeof $scope ) {
			// 	return;
			// }

			/* Slider */
			if ( 'carousel' === self.layout ) {
				var slider_wrapper 	= self.nodeScope.find('.uabb-woo-products-carousel');
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

			   			/*console.log( self.desktop );
			   			console.log( self.slidesToScroll );

			   			slider_selector.uabbslick({
			                dots: true,
			                slidesToShow: self.desktop,
			                slidesToScroll: self.slidesToScroll,
			            });*/
					});
				}
			}

			/* Common */
			self._registerQuickView();
			/* Style specific cart button */
			self._registerAddCart();
		},

		_registerQuickView: function() {
			var self 			= this;
			var $scope 			= self.nodeScope;
			var quick_view_btn 	= $scope.find('.uabb-quick-view-btn');
			var modal_wrap 		= $scope.find('.uabb-quick-view-' + self.nodeID );

			modal_wrap.appendTo( document.body );

			var uabb_quick_view_bg    	= modal_wrap.find( '.uabb-quick-view-bg' ),
				uabb_qv_modal    		= modal_wrap.find( '#uabb-quick-view-modal' ),
				uabb_qv_content  		= uabb_qv_modal.find( '#uabb-quick-view-content' ),
				uabb_qv_close_btn 		= uabb_qv_modal.find( '#uabb-quick-view-close' ),
				uabb_qv_wrapper  		= uabb_qv_modal.find( '.uabb-content-main-wrapper'),
				uabb_qv_wrapper_w 		= uabb_qv_wrapper.width(),
				uabb_qv_wrapper_h 		= uabb_qv_wrapper.height();

			$scope
				.off( 'click', '.uabb-quick-view-btn' )
				.on( 'click', '.uabb-quick-view-btn', function(e){
					e.preventDefault();

					var $this       = $(this);
					var	wrap 		= $this.closest('li.product');
					var product_id  = $this.data( 'product_id' );

					if( ! uabb_qv_modal.hasClass( 'loading' ) ) {
						uabb_qv_modal.addClass('loading');
					}

					if ( ! uabb_quick_view_bg.hasClass( 'uabb-quick-view-bg-ready' ) ) {
						uabb_quick_view_bg.addClass( 'uabb-quick-view-bg-ready' );
					}

					$(document).trigger( 'uabb_quick_view_loading' );

					uabb_qv_ajax_call( $this, product_id );
				});

			var uabb_qv_ajax_call = function( t, product_id ) {

				uabb_qv_modal.css( 'opacity', 0 );

				$.ajax({
		            url: self.ajaxurl,
					data: {
						action: 'uabb_woo_quick_view',
						product_id: product_id
					},
					dataType: 'html',
					type: 'POST',
					success: function (data) {
						uabb_qv_content.html(data);
						uabb_qv_content_height();
					}
				});
			};

			var uabb_qv_content_height = function() {

				// Variation Form
				var form_variation = uabb_qv_content.find('.variations_form');

				form_variation.trigger( 'check_variations' );
				form_variation.trigger( 'reset_image' );

				if (!uabb_qv_modal.hasClass('open')) {

					uabb_qv_modal.removeClass('loading').addClass('open');

					var scrollbar_width = uabb_get_scrollbar_width();
					var $html = $('html');

					$html.css( 'margin-right', scrollbar_width );
					$html.addClass('uabb-quick-view-is-open');
				}

				var var_form = uabb_qv_modal.find('.variations_form');
				if ( var_form.length > 0 && 'function' === typeof var_form.wc_variation_form) {
					var_form.wc_variation_form();
					var_form.find('select').change();
				}

				uabb_qv_content.imagesLoaded( function(e) {

					var image_slider_wrap = uabb_qv_modal.find('.uabb-qv-image-slider');

					if ( image_slider_wrap.find('li').length > 1 ) {
						image_slider_wrap.flexslider({
							animation: "slide",
							start: function( slider ){
								setTimeout(function() {
									uabb_update_summary_height( true );
								}, 300);
							},
						});
					}else{
						setTimeout(function() {
							uabb_update_summary_height( true );
						}, 300);
					}
				});

				// stop loader
				$(document).trigger('uabb_quick_view_loader_stop');
			};

			var uabb_qv_close_modal = function() {

				// Close box by click overlay
				uabb_qv_wrapper.on( 'click', function(e){

					if ( this === e.target ) {
						uabb_qv_close();
					}
				});

				// Close box with esc key
				$(document).keyup(function(e){
					if( e.keyCode === 27 ) {
						uabb_qv_close();
					}
				});

				// Close box by click close button
				uabb_qv_close_btn.on( 'click', function(e) {
					e.preventDefault();
					uabb_qv_close();
				});

				var uabb_qv_close = function() {
					uabb_quick_view_bg.removeClass( 'uabb-quick-view-bg-ready' );
					uabb_qv_modal.removeClass('open').removeClass('loading');
					$('html').removeClass('uabb-quick-view-is-open');
					$('html').css( 'margin-right', '' );

					setTimeout(function () {
						uabb_qv_content.html('');
					}, 600);
				}
			};


			/*var	ast_qv_center_modal = function() {

				ast_qv_wrapper.css({
					'width'     : '',
					'height'    : ''
				});

				ast_qv_wrapper_w 	= ast_qv_wrapper.width(),
				ast_qv_wrapper_h 	= ast_qv_wrapper.height();

				var window_w = $(window).width(),
					window_h = $(window).height(),
					width    = ( ( window_w - 60 ) > ast_qv_wrapper_w ) ? ast_qv_wrapper_w : ( window_w - 60 ),
					height   = ( ( window_h - 120 ) > ast_qv_wrapper_h ) ? ast_qv_wrapper_h : ( window_h - 120 );

				ast_qv_wrapper.css({
					'left' : (( window_w/2 ) - ( width/2 )),
					'top' : (( window_h/2 ) - ( height/2 )),
					'width'     : width + 'px',
					'height'    : height + 'px'
				});
			};

			*/
			var uabb_update_summary_height = function( update_css ) {
				var quick_view = uabb_qv_content,
					img_height = quick_view.find( '.product .uabb-qv-image-slider' ).first().height(),
					summary    = quick_view.find('.product .summary.entry-summary'),
					content    = summary.css('content');

				if ( 'undefined' != typeof content && 544 == content.replace( /[^0-9]/g, '' ) && 0 != img_height && null !== img_height ) {
					summary.css('height', img_height );
				} else {
					summary.css('height', '' );
				}

				if ( true === update_css ) {
					uabb_qv_modal.css( 'opacity', 1 );
				}
			};

			var uabb_get_scrollbar_width = function () {

				var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
				// Append our div, do our calculation and then remove it
				$('body').append(div);
				var w1 = $('div', div).innerWidth();
				div.css('overflow-y', 'scroll');
				var w2 = $('div', div).innerWidth();
				$(div).remove();

				return (w1 - w2);
			}


			uabb_qv_close_modal();
			//uabb_update_summary_height();

			window.addEventListener("resize", function(event) {
				uabb_update_summary_height();
			});

			/* Add to cart ajax */
			/**
			 * uabb_add_to_cart_ajax class.
			 */
			var uabb_add_to_cart_ajax = function() {

				modal_wrap
					.off( 'click', '#uabb-quick-view-content .single_add_to_cart_button' )
					.off( 'uabb_added_to_cart' )
					.on( 'click', '#uabb-quick-view-content .single_add_to_cart_button', this.onAddToCart )
					.on( 'uabb_added_to_cart', this.updateButton );
			};

			/**
			 * Handle the add to cart event.
			 */
			uabb_add_to_cart_ajax.prototype.onAddToCart = function( e ) {

				e.preventDefault();

				var $thisbutton = $( this ),
					product_id = $(this).val(),
					variation_id = $('input[name="variation_id"]').val() || '',
					quantity = $('input[name="quantity"]').val();

				if ( $thisbutton.is( '.single_add_to_cart_button' ) ) {

					$thisbutton.removeClass( 'added' );
					$thisbutton.addClass( 'loading' );

					// Ajax action.
					if ( variation_id != '') {
						jQuery.ajax ({
							url: self.ajaxurl,
							type:'POST',
							data:'action=uabb_add_cart_single_product&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,

							success:function(results) {
								// Trigger event so themes can refresh other areas.
								$( document.body ).trigger( 'wc_fragment_refresh' );
								$( document.body ).trigger( 'uabb_added_to_cart', [ $thisbutton ] );
							}
						});
					} else {
						jQuery.ajax ({
							url: uabb.ajax_url,
							type:'POST',
							data:'action=uabb_add_cart_single_product&product_id=' + product_id + '&quantity=' + quantity,

							success:function(results) {
								// Trigger event so themes can refresh other areas.
								$( document.body ).trigger( 'wc_fragment_refresh' );
								modal_wrap.trigger( 'uabb_added_to_cart', [ $thisbutton ] );
							}
						});
					}
				}
			};

			/**
			 * Update cart page elements after add to cart events.
			 */
			uabb_add_to_cart_ajax.prototype.updateButton = function( e, button ) {
				button = typeof button === 'undefined' ? false : button;

				if ( $(button) ) {
					$(button).removeClass( 'loading' );
					$(button).addClass( 'added' );

					// View cart text.
					if ( ! uabb.is_cart && $(button).parent().find( '.added_to_cart' ).length === 0  && uabb.is_single_product) {
						$(button).after( ' <a href="' + uabb.cart_url + '" class="added_to_cart wc-forward" title="' +
							uabb.view_cart + '">' + uabb.view_cart + '</a>' );
					}


				}
			};

			/**
			 * Init uabb_add_to_cart_ajax.
			 */
			new uabb_add_to_cart_ajax();
		},

		_registerAddCart: function() {

			var self 	= this;
			var $scope 	= self.nodeScope;

			if ( 'modern' !== self.skin ) {
				return;
			}

			/* Add to cart for styles */
			var style_add_to_cart = function() {

				//fa-spinner

				$( document.body )
					.off( 'click', '.uabb-product-actions .uabb-add-to-cart-btn.product_type_simple' )
					.off( 'uabb_product_actions_added_to_cart' )
					.on( 'click', '.uabb-product-actions .uabb-add-to-cart-btn.product_type_simple', this.onAddToCart )
					.on( 'uabb_product_actions_added_to_cart', this.updateButton );
			};

			/**
			 * Handle the add to cart event.
			 */
			style_add_to_cart.prototype.onAddToCart = function( e ) {

				e.preventDefault();

				var $thisbutton = $(this),
					product_id 	= $thisbutton.data('product_id'),
					quantity 	= 1,
					cart_icon 	= $thisbutton.find('uabb-action-item');

				$thisbutton.removeClass( 'added' );
				$thisbutton.addClass( 'loading' );

				jQuery.ajax ({
					url: uabb.ajax_url,
					type:'POST',
					data:'action=uabb_add_cart_single_product&product_id=' + product_id + '&quantity=' + quantity,

					success:function(results) {
						// Trigger event so themes can refresh other areas.
						$( document.body ).trigger( 'wc_fragment_refresh' );
						$( document.body ).trigger( 'uabb_product_actions_added_to_cart', [ $thisbutton ] );
					}
				});
			};

			/**
			 * Update cart page elements after add to cart events.
			 */
			style_add_to_cart.prototype.updateButton = function( e, button ) {
				button = typeof button === 'undefined' ? false : button;

				if ( $(button) ) {
					$(button).removeClass( 'loading' );
					$(button).addClass( 'added' );

					// Show view cart notice.
					/*if ( ! uabb.is_cart && $(button).parent().find( '.added_to_cart' ).length === 0  && uabb.is_single_product) {
						$(button).after( ' <a href="' + uabb.cart_url + '" class="added_to_cart wc-forward" title="' +
							uabb.view_cart + '">' + uabb.view_cart + '</a>' );
					}*/
				}
			};

			/**
			 * Init style_add_to_cart.
			 */
			new style_add_to_cart();
		},

		_initCount: function(){

			var $number = $( this.wrapperClass ).find( '.uabb-number-string' );

			if( !isNaN( this.delay ) && this.delay > 0 ) {
				setTimeout( function(){
					if( this.layout == 'circle' ){
						this._triggerCircle();
					} else if( this.layout == 'bars' ){
						this._triggerBar();
					} else if( this.layout == 'semi-circle' ){
						this._triggerSemiCircle();
					}
					this._countNumber();
				}.bind( this ), this.delay * 1000 );
			}
			else {
				if( this.layout == 'circle' ){
					this._triggerCircle();
				} else if( this.layout == 'bars' ){
					this._triggerBar();
				} else if( this.layout == 'semi-circle' ){
						this._triggerSemiCircle();
				}
				this._countNumber();
			}
		},

		_countNumber: function(){

			var $number = $( this.wrapperClass ).find( '.uabb-number-string' ),
				$string = $number.find( '.uabb-number-int' ),
				$counter_number = this.number;
				current = 0;

			var sAgent = window.navigator.userAgent;
			var Idx = sAgent.indexOf("MSIE");

		 	if (Idx > 0 || !!navigator.userAgent.match(/Trident\/7\./) ) {
				Number.isInteger = Number.isInteger || function(value) {
					return typeof value === "number" &&
					isFinite(value) &&
					Math.floor(value) === value;
				};
		  	}

			if( Number.isInteger( $counter_number ) ) {
				var digits = 0;
			} else {
				var digits = $counter_number.toString().split(".")[1].length;
			}

			if ( ! $number.hasClass( 'uabb-number-animated') ) {

	        	var $numFormat = this.numberFormat;
    			var $locale = this.locale.replace(/_/,'-');

			    $string.prop( 'Counter',0 ).animate({
			        Counter: this.number
			    }, {
			        duration: this.speed,
			        easing: 'swing',
			        step: function ( now ) {

			        	if($numFormat == 'locale') {
			        		var $counter = now.toLocaleString($locale, { minimumFractionDigits: digits, maximumFractionDigits:digits });
			        	} else if($numFormat == 'none') {
			        		var $counter = now.toFixed(digits);
			        	} else {
			        		var $counter = UABBWooProducts.addCommas( now.toFixed(digits) );
			        	}
		            	$string.text( $counter );
			        }
			    });
			    $number.addClass('uabb-number-animated');
			}

		},

		_triggerCircle: function(){

			var $bar   = $( this.wrapperClass ).find( '.uabb-bar' ),
				r      = $bar.attr('r'),
				circle = Math.PI*(r*2),
				val    = this.number,
				max    = this.type == 'percent' ? 100 : this.max;

			if (val < 0) { val = 0;}
			if (val > max) { val = max;}

			if( this.type == 'percent' ){
				var pct = ( ( 100 - val ) /100) * circle;
			} else {
				var pct = ( 1 - ( val / max ) ) * circle;
			}

		    $bar.animate({
		        strokeDashoffset: pct
		    }, {
		        duration: this.speed,
		        easing: 'swing'
		    });

		},

		_triggerSemiCircle: function(){

			var $bar   = $( this.wrapperClass ).find( '.uabb-bar' ),
				r      = $bar.attr('r'),
				circle = Math.PI*(r*2)/2,
				val    = this.number,
				max    = this.type == 'percent' ? 100 : this.max;

			if (val < 0) { val = 0;}
			if (val > max) { val = max;}

			if( this.type == 'percent' ){
				var pct = ( ( 100 - val ) /100) * circle;
			} else {
				var pct = ( 1 - ( val / max ) ) * circle;
			}

		    $bar.animate({
		        strokeDashoffset: pct
		    }, {
		        duration: this.speed,
		        easing: 'swing'
		    });

		},

		_triggerBar: function(){

			var $bar = $( this.wrapperClass ).find( '.uabb-number-bar' );

			if( this.type == 'percent' ){
				var number = this.number > 100 ? 100 : this.number;
			} else {
				var number = ( ( this.number / this.max ) * 100 );
			}

		    $bar.animate({
		        width: number + '%'
		    }, {
		        duration: this.speed,
		        easing: 'swing'
		    });

		}

	};

})(jQuery);
