(function( $, as3cfModal ) {

	as3cfpro.Tools = as3cfpro.Tools ? as3cfpro.Tools : {};

	/**
	 * The object that handles the add_metadata tool.
	 */
	as3cfpro.Tools.AddMetadata = {
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
		if ( null != as3cfpro.Sidebar.tools.media.add_metadata ) {
			as3cfpro.Tools.AddMetadata.toggleMediaSettings( as3cfpro.Sidebar.tools.media.add_metadata, 'add_metadata' );
		}

		// Toggle settings lock on sidebar status change
		$( '#add_metadata' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.AddMetadata.toggleMediaSettings( status, 'add_metadata' );
		} );
	} );

})( jQuery, as3cfModal );
