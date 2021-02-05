(function( $, as3cfModal ) {

	as3cfpro.Tools = as3cfpro.Tools ? as3cfpro.Tools : {};

	/**
	 * The object that handles the woocommerce product urls tool.
	 */
	as3cfpro.Tools.Woocommerce_Product_Urls = {
		/**
		 * Maybe lock/unlock settings.
		 */
		toggleMediaSettings: function( status, tool ) {
			if ( status.is_queued || status.is_paused || status.is_cancelled ) {
				as3cf.Settings.Media.lock( tool );

				return;
			}

			as3cf.Settings.Media.unlock( tool );
		}
	};

	// Event Handlers
	$( document ).ready( function() {
		// Toggle settings lock on page load
		if ( null != as3cfpro.Sidebar.tools.media.woocommerce_product_urls ) {
			as3cfpro.Tools.Woocommerce_Product_Urls.toggleMediaSettings( as3cfpro.Sidebar.tools.media.downloader, 'woocommerce_product_urls' );
		}

		// Toggle settings lock on sidebar status change
		$( '#woocommerce_product_urls' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.Woocommerce_Product_Urls.toggleMediaSettings( status, 'woocommerce_product_urls' );
		} );
	} );

})( jQuery, as3cfModal );
