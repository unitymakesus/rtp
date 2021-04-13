(function( $, as3cfModal ) {

	as3cfpro.Tools = as3cfpro.Tools ? as3cfpro.Tools : {};

	/**
	 * The object that handles the Elementor analyze and repair tool
	 */
	as3cfpro.Tools.Elementor_Analyze_And_Repair = {
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
		if ( null != as3cfpro.Sidebar.tools.media.elementor_analyze_and_repair ) {
			as3cfpro.Tools.Elementor_Analyze_And_Repair.toggleMediaSettings( as3cfpro.Sidebar.tools.media.downloader, 'elementor_analyze_and_repair' );
		}

		// Toggle settings lock on sidebar status change
		$( '#elementor_analyze_and_repair' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.Elementor_Analyze_And_Repair.toggleMediaSettings( status, 'elementor_analyze_and_repair' );
		} );
	} );

})( jQuery, as3cfModal );
