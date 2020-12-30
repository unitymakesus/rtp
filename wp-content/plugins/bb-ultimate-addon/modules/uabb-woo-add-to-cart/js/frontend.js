var UABBWooAddToCart;

(function($) {
	
	/**
	 * Class for Number Counter Module
	 *
	 * @since 1.6.1
	 */
	UABBWooAddToCart = function( settings ){

		// set params
		this.nodeID			= settings.id;
		this.nodeClass		= '.fl-node-' + settings.id;
		this.nodeScope		= $( '.fl-node-' + settings.id );
		this.cart_redirect	= settings.cart_redirect;
		this.is_cart	    = settings.is_cart;
		this.cart_url	    = settings.cart_url;

		// initialize 
		this._addToCart();
	};
	
	UABBWooAddToCart.prototype = {
		
		nodeID			: '',
		nodeClass		: '',
		nodeScope		: '',
		cart_redirect	: '',
		
		/**
		 * Function for Product Grid.
		 *
		 */
		_addToCart: function() {
			
			var uabb_cart_url = this.cart_url;

			if ( 'yes' === this.cart_redirect ) {
				$('body').off('added_to_cart.uabb_cart' ).on( 'added_to_cart.uabb_cart', function(e, fragments, cart_hash, btn){
					
					if ( btn.closest('.uabb-woo-add-to-cart').length > 0 ) {
						
						
						if ( btn.hasClass('uabb-redirect') ) {
							
							setTimeout(function() {
								// View cart text.
								if ( ! this.is_cart && btn.hasClass( 'added' ) ) {
									//console.log( btn.hasClass('uabb-redirect') );
									window.location = uabb_cart_url;
								}
							}, 200);
						}
					}
				});
			}
		},
	};
})(jQuery);