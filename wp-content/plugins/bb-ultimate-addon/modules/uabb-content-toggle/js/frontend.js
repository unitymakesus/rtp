(function($) {

	UABBContentToggle = function( settings )
	{   
		this.settings 	= settings;
		this.nodeClass  = '.fl-node-' + settings.id;
		this.select_switch_style = settings.select_switch_style;
		this.content1 = settings.content1_section;
		this.content2 = settings.content2_section;
		this._init();	
	};

	UABBContentToggle.prototype = {

		settings	: {},
		node 		: '',
		nodeClass   : '',
		select_switch_style  : '',
		
		_init: function()
		{	
			this._contentToggleHandler();

			var hashval = window.location.hash,
				id = hashval.split( '#' ).pop();

			if ( id === 'content-1' || id === 'content-2' ) {

				this._openOnLink();
			}
		},

		/**
		 * Initializes all anchor links on the page for smooth scrolling.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _initAnchorLinks
		 */
		_contentToggleHandler: function()
		{   
			var nodeClass  		= jQuery(this.nodeClass);
			var node_id 		= nodeClass.data( 'node' );
			var node          	= '.fl-node-' + node_id;
			var rbs_wrapper     = nodeClass.find( '.uabb-rbs-wrapper' );
			var rbs_section_1   = nodeClass.find( '.uabb-rbs-content-1' );
			var rbs_section_2   = nodeClass.find( '.uabb-rbs-content-2' );
			var main_btn        = nodeClass.find( '.uabb-main-btn' );
			var switch_type 	= this.select_switch_style;
			var current_class 	= '';
			var content1 		= this.content1;
			var content2 		= this.content2;
			

			switch ( switch_type ) {
				case 'round1':
					current_class = '.uabb-switch-round-1';
					break;
				case 'round2':
					current_class = '.uabb-switch-round-2';
					break;
				case 'rectangle':
					current_class = '.uabb-switch-rectangle';
					break;
				case 'label_box':
					current_class = '.uabb-switch-label-box';
					break;
				default:
					current_class = 'No Class Selected';
					break;
			}

			var rbs_switch      = nodeClass.find( current_class );
				if( rbs_switch.is( ':checked' ) ) {
					if( content1 === 'content' ) {
						rbs_section_1.hide();
					}
					if( content2 === 'content_head2' ) {
						rbs_section_2.show();
					}
					if( content1 !== 'content' ) {
						nodeClass.find( ".uabb-rbs-section-1" ).hide();
					}
					if( content2 !== 'content_head2' ) {
						nodeClass.find( ".uabb-rbs-section-2" ).show();
					}
				}
				else{
					if( content1 === 'content' ) {
						rbs_section_1.show();
					}
					if( content2 === 'content_head2' ) {
						rbs_section_2.hide();
					}
					if(content1 !== 'content'){
						nodeClass.find( ".uabb-rbs-section-1" ).show();
					}
					if( content2 !== 'content_head2' ) {
						nodeClass.find( ".uabb-rbs-section-2" ).hide();
					}
				}

			$( this.nodeClass + ' .uabb-clickable' ).on( 'click', function(e) {
				e.preventDefault();

				if( content1 === 'content' ) {
                	$( node +' .uabb-rbs-content-1' ).toggle();
				}

				if( content2 === 'content_head2' ) {
                	$( node +' .uabb-rbs-content-2' ).toggle();
				}

				if( content1 !== 'content' ) {
                	$( node +' .uabb-rbs-section-1' ).toggle();
				}

				if( content2 !== 'content_head2' ) {
                	$( node +' .uabb-rbs-section-2' ).toggle();
				}

	        	if( $( this ).parent().find( '.uabb-checkbox-clickable' )[0].hasAttribute('checked') ) {
	        		$( this ).parent().find( '.uabb-checkbox-clickable' ).removeAttr( 'checked' );
	        	} else {
	        		$( this ).parent().find( '.uabb-checkbox-clickable' ).attr( 'checked', 'checked' );
	        	}

	        	$(window).resize();
		    });
		},
		_openOnLink: function(){

			var nodeClass  		= jQuery(this.nodeClass);
			var node_id 		= nodeClass.data( 'node' );
			var node          	= '.fl-node-' + node_id;
			var node_toggle     = '#uabb-toggle-init' + ' ' + node;
			var hashval = window.location.hash,
				id = hashval.split( '#' ).pop();

			$( 'html, body' ).animate( {
		        scrollTop: $( '#uabb-toggle-init' ).find( ' .fl-module-uabb-content-toggle' ).offset().top
		    }, 500 );

			if( id === 'content-1' ) {

				$( node_toggle +' .uabb-rbs-content-1' ).show();
				$( node_toggle +' .uabb-rbs-content-2' ).hide();
				$( node_toggle +' .uabb-rbs-section-1' ).show();
				$( node_toggle +' .uabb-rbs-section-2' ).hide();
				$( node_toggle + ' .uabb-checkbox-clickable' ).removeAttr( 'checked' );

			} else {
				$( node_toggle +' .uabb-rbs-content-2' ).show();
				$( node_toggle +' .uabb-rbs-content-1' ).hide();
				$( node_toggle +' .uabb-rbs-section-2' ).show();
				$( node_toggle +' .uabb-rbs-section-1' ).hide();
				$( node_toggle + ' .uabb-checkbox-clickable' ).attr( 'checked', 'checked' );
			}
		},	
	};
	
})(jQuery);