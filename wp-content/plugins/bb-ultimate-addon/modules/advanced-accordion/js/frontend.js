(function($) {

	UABBAdvAccordion = function( settings )
	{
		this.settings 	= settings;
		this.node  		= settings.id;
		this.nodeClass  = '.fl-node-' + settings.id;
		this.close_icon	= settings.close_icon;
		this.open_icon	= settings.open_icon;
		this._init();
	};


	UABBAdvAccordion.prototype = {

		settings	: {},
		node 		: '',
		nodeClass   : '',
		close_icon	: 'fa fa-plus',
		open_icon	: 'fa fa-minus',
		
		_init: function()
		{	
			var button_level = $( this.nodeClass ).find('.uabb-adv-accordion-button').first().closest('.uabb-adv-accordion');

			button_level.children('.uabb-adv-accordion-item').children('.uabb-adv-accordion-button').click( $.proxy( this._buttonClick, this ) );

			this._enableFirst();
			this._initAnchorLinks();
		},

		/**
		 * Initializes all anchor links on the page for smooth scrolling.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _initAnchorLinks
		 */
		_initAnchorLinks: function()
		{
			$( 'a' ).each( this._initAnchorLink );
		},

		/**
		 * Initializes a single anchor link for smooth scrolling.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _initAnchorLink
		 */
		_initAnchorLink: function()
		{
			var link    = $( this ),
				href    = link.attr( 'href' ),
				loc     = window.location,
				id      = null,
				element = null;

			if ( 'undefined' != typeof href && href.indexOf( '#' ) > -1 ) {

				if ( loc.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && loc.hostname == this.hostname ) {

					try {

						id = href.split( '#' ).pop();

						// If there is no ID then we have nowhere to look
						if( ! id ) {
							return;
						}

						element = $( '#' + id );
						if ( element.length > 0 ) {
							if ( element.hasClass( 'uabb-adv-accordion-item' ) ) {
								jQuery( link ).on( 'click', UABBAdvAccordion.prototype._scrollToAccordionLink );

							}
						}
					}
					catch( e ) {}
				}
			}
		},

		/**
		 * Scrolls to a tab when a link is clicked.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _scrollToAccordionLink
		 * @param {Object} e An event object.
		 */
		_scrollToAccordionLink: function() {

			var hashval = $( this ).attr( 'href' );
			if (/^(f|ht)tps?:\/\//i.test(hashval)) {
				hashvalarr = hashval.split( "/" );
				hashval = hashvalarr[hashvalarr.length-1];
			}

			var	hashvalarr = hashval.split( "-" ),
				dataindex = hashvalarr[hashvalarr.length-1],
				tab_id = hashval.replace( '-' + dataindex, '' );

			if( tab_id != '' ) {
				if( jQuery( tab_id ).length > 0 ) {
					if( jQuery(tab_id).find( '.uabb-adv-accordion > .uabb-adv-accordion-item[data-index="' + dataindex + '"]' ) ) {

						jQuery('html, body').animate({
						    scrollTop: jQuery( tab_id ).offset().top - 250
						}, 1000);
						var enable_first = '<?php echo $settings->enable_first; ?>';
						if( !( parseInt( dataindex ) == 0 && enable_first == 'yes' ) ) {
							setTimeout(function(){
								jQuery( tab_id + ' .uabb-adv-accordion-button' ).eq(dataindex).trigger('click');
							}, 1000);
						}
					}
				}
			}
		},

		_multiInstance: function( e )
		{
			// call to static variable
			if( this._multiInstance.staticVar == undefined ) {
				this._multiInstance.staticVar = 0;
			}
			this._multiInstance.staticVar++;
		},

		_buttonClick: function( e )
		{
			// initialize value of static variable

			var firstitem = this.settings.enable_first;
			this._multiInstance();
			if( firstitem != 'yes' ) {
				if( e.originalEvent == undefined && this._multiInstance.staticVar > 1 ) {
					var totalAcc = $('.uabb-adv-accordion').length;
					if( this._multiInstance.staticVar == totalAcc ) {
						this._multiInstance.staticVar = 0;
					}
					return;
				}
			} 

			var button      = $( e.target ).closest('.uabb-adv-accordion-button'),
				accordion   = button.closest('.uabb-adv-accordion'),
				item	    = button.closest('.uabb-adv-accordion-item'),
				allContent  = accordion.find('.uabb-adv-accordion-content'),
				allIcons    = accordion.find('.uabb-adv-accordion-button i.uabb-adv-accordion-button-icon'),
				content     = button.siblings('.uabb-adv-accordion-content'),
				icon        = button.find('i.uabb-adv-accordion-button-icon');
			
			if(accordion.hasClass('uabb-adv-accordion-collapse')) {
				accordion.find( '.uabb-adv-accordion-item-active' ).removeClass( 'uabb-adv-accordion-item-active' );
				allContent.slideUp('normal');   
				if( this.settings.icon_animation == 'none' ) {
					allIcons.removeClass( this.open_icon );
					allIcons.addClass( this.close_icon );
				}
			}
			
			if( content.is(':hidden') ) {
				item.addClass( 'uabb-adv-accordion-item-active' );
				content.slideDown('normal', this._slideDownComplete);
				if( this.settings.icon_animation == 'none' ) {
					//console.log( this.open_icon );
					icon.removeClass( this.close_icon );
					icon.addClass( this.open_icon );
				}
			} else {
				item.removeClass( 'uabb-adv-accordion-item-active' );
				content.slideUp('normal', this._slideUpComplete);
				if( this.settings.icon_animation == 'none' ) {
					icon.removeClass( this.open_icon );
					icon.addClass( this.close_icon );
				}
			}

			var trigger_args = '.fl-node-'+ this.node + ' .uabb-adv-accordion-item-active';
			// Trigger the Adv Tab Click trigger.
			UABBTrigger.triggerHook( 'uabb-accordion-click', trigger_args );
		},
		
		_slideUpComplete: function()
		{
			var content 	= $( this ),
				accordion 	= content.closest( '.uabb-adv-accordion' );
			
			accordion.trigger( 'fl-builder.uabb-adv-accordion-toggle-complete' );
		},
		
		_slideDownComplete: function()
		{
			var content 	= $( this ),
				accordion 	= content.closest( '.uabb-adv-accordion' ),
				item 		= content.parent(),
				win  		= $( window );
			
			FLBuilderLayout.refreshGalleries( content );
			
			if ( !accordion.hasClass( 'uabb-accordion-edit' ) ) {
				if ( item.offset().top < win.scrollTop() + 100 ) {
					$( 'html, body' ).animate({ 
						scrollTop: item.offset().top - 100 
					}, 500, 'swing');
				}
			}
			
			accordion.trigger( 'fl-builder.uabb-adv-accordion-toggle-complete' );

			//window.dispatchEvent(new Event('resize'));
			var fireRefreshEventOnWindow = function () {
				var evt = document.createEvent("uabbAccordionCreate");
				evt.initEvent('resize', true, false);
				window.dispatchEvent(evt);
			};
		},

		_enableFirst: function()
		{	
			if(typeof this.settings.enable_first !== 'undefined') {
				var firstitem = this.settings.enable_first;
				if( firstitem == 'yes' ) {
					$( this.nodeClass + ' .uabb-adv-accordion-button' ).eq(0).trigger('click');
				}
			}
		}
	};
	
})(jQuery);;