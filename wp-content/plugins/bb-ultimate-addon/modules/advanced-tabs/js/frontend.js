jQuery(document).ready(function() {
	
	// Regexp for validating user input as ID : https://regex101.com/r/KGj6I6/1
	var pattern = new RegExp('^[\\w\\-]+$');

	var hashval = window.location.hash.substring(1);

	if ( pattern.test( hashval ) ) {

		var hashval_last_index = hashval.lastIndexOf('-');

		var tab_id = hashval.slice(0,hashval_last_index);

		var dataindex = hashval.slice(hashval_last_index+1 , hashval.length);

		if( tab_id != '' ) {

			var tab_id = "#" + tab_id;

			if( jQuery( tab_id ).length > 0 ) {

				if( jQuery( tab_id ).find('.uabb-tabs').find( ' > .uabb-tabs-nav > ul > li[data-index="' + dataindex + '"]' ) ) {
					var current_li = jQuery( tab_id ).find('.uabb-tabs').find( ' > .uabb-tabs-nav > ul > li[data-index="' + dataindex + '"]' ).first(),
						current_li_index = current_li.index(),
						adv_node = current_li.closest('.fl-module').attr('data-node'),
						parent_uabb_tabs = current_li.closest('.uabb-tabs');

					current_li.siblings().removeClass('uabb-tab-current');
					current_li.addClass('uabb-tab-current');

					parent_uabb_tabs.find(' > .uabb-content-wrap > .section').removeClass('uabb-content-current').first();
					parent_uabb_tabs.find(' > .uabb-content-wrap > .section:eq('+ current_li_index +')').addClass('uabb-content-current').first();

					parent_uabb_tabs.find(' > .uabb-content-wrap > .uabb-content-current > .uabb-tab-acc-title.uabb-acc-'+ current_li_index ).trigger('click');
					
					var trigger_args = '.fl-node-'+ adv_node + ' .uabb-content-current';
					// Trigger the Adv Tab Click trigger.
					UABBTrigger.triggerHook( 'uabb-tab-click', trigger_args );

					
					jQuery('html, body').animate({
						scrollTop: jQuery( tab_id ).offset().top - 250
					}, 250);
				}
			}
		}
	}

	jQuery('.uabb-tabs').find( ' > .uabb-tabs-nav > ul > li' ).on( 'click keypress ', function(e) {

		e.preventDefault();
		var current_li = jQuery(this),
			current_li_index = current_li.index(),
			adv_node = current_li.closest('.fl-module').attr('data-node'),
			parent_uabb_tabs = current_li.closest('.uabb-tabs');

		current_li.siblings().removeClass('uabb-tab-current').attr('aria-current', 'false').attr('aria-expanded', 'false');
		current_li.addClass('uabb-tab-current').attr('aria-current', 'true').attr('aria-expanded', 'true');

		parent_uabb_tabs.find(' > .uabb-content-wrap > .section').removeClass('uabb-content-current').attr('aria-current', 'false').attr('aria-expanded', 'false');	
		parent_uabb_tabs.find(' > .uabb-content-wrap > .section:eq('+ current_li_index +')').addClass('uabb-content-current').attr('aria-current', 'true').attr('aria-expanded', 'true');

		parent_uabb_tabs.find(' > .uabb-content-wrap > .uabb-content-current > .uabb-tab-acc-title.uabb-acc-'+ current_li_index ).trigger('click');
		
		var trigger_args = '.fl-node-'+ adv_node + ' .uabb-content-current';
		// Trigger the Adv Tab Click trigger.
		UABBTrigger.triggerHook( 'uabb-tab-click', trigger_args );
	});


	/* Click for Accordion on Responsive */
	jQuery( '.uabb-tabs' ).find( ' > .uabb-content-wrap > .section > .uabb-tab-acc-title' ).on( 'click keypress', function( e ) {

		var current_tab_acc = jQuery(this),
			adv_node = current_tab_acc.closest('.fl-module').attr('data-node'),
			current_tab_acc_index = current_tab_acc.parent().index(),
			parent_uabb_tabs = current_tab_acc.closest('.uabb-tabs'),
			win  		= jQuery( window );
		

		parent_uabb_tabs.find(' > .uabb-tabs-nav > ul > li').removeClass('uabb-tab-current').attr('aria-current', 'false').attr('aria-expanded', 'false');
		parent_uabb_tabs.find(' > .uabb-tabs-nav > ul > li:eq(' + current_tab_acc_index + ')').addClass( 'uabb-tab-current' ).attr('aria-current', 'true').attr('aria-expanded', 'true');

		if ( e.originalEvent !== undefined ) {
			current_tab_acc.parent().siblings().find(' > .uabb-tab-acc-content:lt(1)').slideUp(300);
			if ( current_tab_acc.siblings( '.uabb-tab-acc-content' ).css( 'display' ).toLowerCase() === 'none' ){
				current_tab_acc.siblings('.uabb-tab-acc-content').slideDown(300, function() {

					if ( current_tab_acc.offset().top < win.scrollTop() + 100 ) {
						jQuery( 'html, body' ).animate({ 
							scrollTop: current_tab_acc.offset().top - 100 
						}, 500, 'swing');
					}
				});
			} else {
				current_tab_acc.siblings('.uabb-tab-acc-content').slideUp(300);
			}
		} else {
			current_tab_acc.parent().siblings().find(' > .uabb-tab-acc-content:lt(1)').css('display','none');
			current_tab_acc.siblings('.uabb-tab-acc-content').css('display','block');
		}

		current_tab_acc.parent().siblings().removeClass('uabb-content-current').attr('aria-current', 'false').attr('aria-expanded', 'false');
		current_tab_acc.parent().addClass('uabb-content-current').attr('aria-current', 'true').attr('aria-expanded', 'true');

		var trigger_args = '.fl-node-'+ adv_node + ' .uabb-content-current';
		// Trigger the Adv Tab Click trigger.
		UABBTrigger.triggerHook( 'uabb-tab-click', trigger_args );
        
    });

});

// scroll to tab link

(function($) {
	UABBTabs = function( settings )
	{
		this.settings 	= settings;
		this.nodeClass  = '.fl-node-' + settings.id;
		this._init();
	};

	UABBTabs.prototype = {

		settings	: {},
		nodeClass	: '',

		_init: function()
		{
			this._initAnchorLinks();
			this._resizeContent();
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

						element = $( '.' + id );
						if ( element.length > 0 ) {
							if ( element.hasClass( 'section' ) ) {
								jQuery( link ).on( 'click', UABBTabs.prototype._scrollToTabOnLink );

							}
						}
					}
					catch( e ) {}
				}
			}
		},
		_resizeContent: function()
		{
			$(this.nodeClass + ' .uabb-tabs-layout-vertical').each($.proxy(this._resizeVertical, this));
		},
		_resizeVertical: function(e)
		{
			var wrap    = $(this.nodeClass + ' .uabb-tabs-layout-vertical'),
				labels  = wrap.find('.uabb-tabs-nav'),
				panels  = wrap.find('.uabb-tab-acc-content');

			panels.css('min-height', labels.height() + 'px');
		},

		/**
		 * Scrolls to a tab when a link is clicked.
		 *
		 * @since 1.6.7
		 * @access private
		 * @method _scrollToTabOnLink
		 * @param {Object} e An event object.
		 */
		_scrollToTabOnLink: function() {

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

					if( jQuery( tab_id ).find('.uabb-tabs').find( ' > .uabb-tabs-nav > ul > li[data-index="' + dataindex + '"]' ) ) {
						var current_li = jQuery( tab_id ).find('.uabb-tabs').find( ' > .uabb-tabs-nav > ul > li[data-index="' + dataindex + '"]' ).first(),
							current_li_index = current_li.index(),
							adv_node = current_li.closest('.fl-module').attr('data-node'),
							parent_uabb_tabs = current_li.closest('.uabb-tabs');


						current_li.siblings().removeClass('uabb-tab-current');
						current_li.addClass('uabb-tab-current');

						parent_uabb_tabs.find(' > .uabb-content-wrap > .section').first().removeClass('uabb-content-current');
						parent_uabb_tabs.find(' > .uabb-content-wrap > .section:eq('+ current_li_index +')').first().addClass('uabb-content-current');

						parent_uabb_tabs.find(' > .uabb-content-wrap > .uabb-content-current > .uabb-tab-acc-title.uabb-acc-'+ current_li_index ).trigger('click');
						var trigger_args = '.fl-node-'+ adv_node + ' .uabb-content-current';
						// Trigger the Adv Tab Click trigger.
						UABBTrigger.triggerHook( 'uabb-tab-click', trigger_args );

						jQuery('html, body').animate({
							scrollTop: jQuery( tab_id ).offset().top - 250
						}, 250);
					}
				}
			}
		},
	};

})(jQuery);