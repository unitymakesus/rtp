(function($) {

	UABBSpacerGap = function( settings )
	{   
		this.settings 	= settings;
		this.node  		= settings.id;
		this.desktop_space = settings.desktop_space;
		this.medium_device = settings.medium_device;
		this.small_device  = settings.small_device;
		this.nodeClass  = '.fl-node-' + settings.id;
		this._init();

			
	};

	UABBSpacerGap.prototype = {

		settings	: {},
		node 		: '',
		nodeClass   : '',
		
		_init: function()
		{	
			this._spacerGapHeightHandler();
		},

		/**
		 * Initializes all anchor links on the page for smooth scrolling.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _initAnchorLinks
		 */
		_spacerGapHeightHandler: function()
		{   
			var nodeClass  		= jQuery(this.nodeClass);
			var node_id 		= nodeClass.data( 'node' );
			var node            = '.fl-node-'+node_id+' ';
			
			if( jQuery('body').hasClass('fl-builder-edit') && this.desktop_space < 30 ) {
				jQuery('body').find(node).addClass("uabb-desktop-spacer-height-adjustment");
			} 
			if( jQuery('body').hasClass('fl-builder-edit') && this.medium_device < 30 ) {
				jQuery('body').find( node ).addClass('uabb-tab-spacer-height-adjustment');
			} 
			if( jQuery('body').hasClass('fl-builder-edit') && this.small_device < 30 ) {
				jQuery('body').find( node ).addClass('uabb-mobile-spacer-height-adjustment');
			} 
		},		
	};
	
})(jQuery);