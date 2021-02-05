(function( $, as3cfModal ) {

	as3cfpro.Tools = as3cfpro.Tools ? as3cfpro.Tools : {};

	/**
	 * The object that handles the analyze_and_repair tool.
	 */
	as3cfpro.Tools.AnalyzeAndRepair = {
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
		if ( null != as3cfpro.Sidebar.tools.media.analyze_and_repair ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( as3cfpro.Sidebar.tools.media.analyze_and_repair, 'analyze_and_repair' );
		}
		if ( null != as3cfpro.Sidebar.tools.media.reverse_add_metadata ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( as3cfpro.Sidebar.tools.media.reverse_add_metadata, 'reverse_add_metadata' );
		}
		if ( null != as3cfpro.Sidebar.tools.media.verify_add_metadata ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( as3cfpro.Sidebar.tools.media.verify_add_metadata, 'verify_add_metadata' );
		}

		// Toggle settings lock on sidebar status change
		$( '#analyze_and_repair' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( status, 'analyze_and_repair' );
		} );
		$( '#reverse_add_metadata' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( status, 'reverse_add_metadata' );
		} );
		$( '#verify_add_metadata' ).on( 'status-change', function( event, status ) {
			as3cfpro.Tools.AnalyzeAndRepair.toggleMediaSettings( status, 'verify_add_metadata' );
		} );
	} );

})( jQuery, as3cfModal );
