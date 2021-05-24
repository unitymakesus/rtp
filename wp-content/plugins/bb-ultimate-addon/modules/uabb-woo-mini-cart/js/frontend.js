var UABBWooMiniCart;

(function($) {

	UABBWooMiniCart = function( settings ){

		// set params
		this.settings        = settings;
		this.node            = settings.id;
		this.node_module     = $( '.fl-node-' + this.node ); 
		this.preview_cart    = settings.preview_cart;
		this.cart_style      = settings.cart_style;
		this.open_cart_on    = settings.open_cart_on;
		this.esc_keypress    = settings.esc_keypress;
		this.overlay_click   = settings.overlay_click;
		this.isBuilderActive = settings.isBuilderActive;

		// initialize
		if ( !this.isBuilderActive ) {
			this._initWooMiniCart();
		}
	};

	UABBWooMiniCart.prototype = {

		_initWooMiniCart: function(){

			var self = this,
			dropdown_cart_wrap = self.node_module.find( '.uabb-cart-style-dropdown' )[0],
			modal_cart_wrap = self.node_module.find( '.uabb-cart-style-modal' )[0],
			offcanvas_cart_wrap = self.node_module.find( '.uabb-cart-style-off-canvas' )[0],
			modal_open = self.node_module.find( '.uabb-cart-modal-wrap' ),
			modal_close = self.node_module.find( '.uabb-cart-modal__close-btn' ),
			offcanvas_open = self.node_module.find( '.uabb-cart-off-canvas-wrap' ),
			offcanvas_close = self.node_module.find( '.uabb-cart-off-canvas__close-btn' ),
			dropdown_main = self.node_module.find( '.uabb-cart-style-dropdown' ),
			modal_main = self.node_module.find( '.uabb-cart-style-modal' ),
			offcanvas_main = self.node_module.find( '.uabb-cart-style-off-canvas' ),
			cart_style = self.cart_style,
			overlay_click = self.overlay_click,
			esc_keypress = self.esc_keypress,
			overlay = self.node_module.find( '.uabb-overlay' );

			var uabbMiniCartButton = self.node_module.find( '.uabb-cart-btn-contents' );
			
			uabbMiniCartButton.on( 'click', function(e) {

				e.preventDefault();
			
				if( 'click' == self.open_cart_on ) {
			
					if ( dropdown_cart_wrap ) {
			
						dropdown_main.toggleClass( 'uabb-cart-dropdown-close' );
						e.stopPropagation();
					}

				}
			
				if( modal_cart_wrap ) {
			
					modal_open.removeClass( 'uabb-cart-modal-wrap-close' );
					modal_main.removeClass( 'uabb-cart-modal-close' );
					self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'visible' );
					self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );
			
					modal_close.on( 'click', function(e) {
			
						e.preventDefault();
			
						modal_open.addClass( 'uabb-cart-modal-wrap-close' );
						modal_main.addClass( 'uabb-cart-modal-close' );
			
						e.stopPropagation();
					} );
				}
			
				if( offcanvas_cart_wrap ) {
			
					offcanvas_open.removeClass( 'uabb-cart-off-canvas-wrap-close' );
					offcanvas_main.removeClass( 'uabb-cart-off-canvas-close' );
					self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'visible' );
					self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );

					offcanvas_close.on( 'click', function(e) {
			
						e.preventDefault();
			
						offcanvas_open.addClass( 'uabb-cart-off-canvas-wrap-close' );
						offcanvas_main.addClass( 'uabb-cart-off-canvas-close' );
						
						e.stopPropagation();
					} );
				}
			});

			dropdown_main.on( 'click', function( e ) {

				if( 'A' == e.target.nodeName && 'remove remove_from_cart_button' == $( e.target ).attr( 'class' ) ){
	
					$( this ).removeClass( 'uabb-cart-dropdown-close' );
					
					return;
				}
	
				e.stopPropagation();
			});
	
			$( document ).on( 'click', function( e ) {
	
				if( 'A' != e.target.nodeName && 'remove remove_from_cart_button' != $( e.target ).attr( 'class' ) ){
	
					dropdown_main.addClass( 'uabb-cart-dropdown-close' );
	
					e.stopPropagation();
				}
			})

			if( 'hover' == self.open_cart_on ) {
			
				uabbMiniCartButton.hover( function( e ) {
			
					e.preventDefault();
			
					if( dropdown_cart_wrap ) {
			
						dropdown_main.removeClass( 'uabb-cart-dropdown-close' );
					}
				});

				dropdown_main.on( 'mouseleave', function (e) {
					e.preventDefault();
					dropdown_main.addClass( 'uabb-cart-dropdown-close' );
				});
		
			}

			if ( overlay_click == 1 ) {

				overlay.on( 'click', function( ev ) {
					if ( modal_cart_wrap ) {
						modal_main.addClass( 'uabb-cart-modal-close' );
						modal_open.addClass( 'uabb-cart-modal-wrap-close' );
						self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'hidden' );
						self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );
						self.node_module.find( '.uabb-mini-cart-content' ).css( 'z-index', '' );
						$( 'body' ).css( 'overflow','' );
					}
					if (self.node_module.find( '.uabb-cart-off-canvas-wrap' )[0]) {
						offcanvas_main.addClass( 'uabb-cart-off-canvas-close' );
						offcanvas_open.addClass( 'uabb-cart-off-canvas-wrap-close' );
						self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'hidden' );
						self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );
						self.node_module.find( '.uabb-mini-cart-content' ).css( 'z-index', '' );
						$( 'body' ).css( 'overflow','' );
					}
				} );

			}

			if ( esc_keypress == 1 ) {
				$(document).on('keyup.uabb-mini-cart-content',function(e) {

					if ( e.keyCode == 27) { 
						if (self.node_module.find( '.uabb-cart-modal-wrap' )[0]) {
							modal_main.addClass( 'uabb-cart-modal-close' );
							modal_open.addClass( 'uabb-cart-modal-wrap-close' );
							self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'hidden' );
							self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );
							self.node_module.find( '.uabb-mini-cart-content' ).css( 'z-index', '' );
							$( 'body' ).css( 'overflow','' );
						}
						if (self.node_module.find( '.uabb-cart-off-canvas-wrap' )[0]) {
							offcanvas_main.addClass( 'uabb-cart-off-canvas-close' );
							offcanvas_open.addClass( 'uabb-cart-off-canvas-wrap-close' );
							self.node_module.find( '.uabb-overlay' ).css( 'visibility', 'hidden' );
							self.node_module.find( '.uabb-overlay' ).css( 'opacity', '0' );
							self.node_module.find( '.uabb-mini-cart-content' ).css( 'z-index', '' );
							$( 'body' ).css( 'overflow','' );
						}
					}
				});
			}
		},
	};
})(jQuery);
