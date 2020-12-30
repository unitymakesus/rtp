(function($) {

	UABBFAQModule = function( settings )
	{
		this.settings 	= settings;
		this.node  		= settings.id;
		this.nodeClass  = '.fl-node-' + settings.id;
		this.close_icon	= settings.close_icon;
		this.open_icon	= settings.open_icon;
		this._init();
	};

  UABBFAQModule.prototype = {
    settings	: {},
		node 		: '',
		nodeClass   : '',
		close_icon	: 'fa fa-plus',
		open_icon	: 'fa fa-minus',


    _init: function()
	{
		var button_level = $( this.nodeClass ).find('.uabb-faq-questions').first().closest('.uabb-faq-module');
		button_level.children('.uabb-faq-item').children('.uabb-faq-questions').on( 'click keypress', $.proxy( this._buttonClick, this ) );

		this._enableFirst();
	},
    _buttonClick: function( e ) {

		e.preventDefault();
		var button      = $( e.target ).closest( '.uabb-faq-questions' ),
			accordion   = button.closest( '.uabb-faq-module' ),
			item	    = button.closest( '.uabb-faq-item' ),
			allContent  = accordion.find( '.uabb-faq-content' ),
			allIcons    = accordion.find( '.uabb-faq-questions-button i.uabb-faq-button-icon' ),
			content     = button.siblings( '.uabb-faq-content' ),
			icon        = button.find( 'i.uabb-faq-button-icon' );
			icon_animation = 'none';
		if ( accordion.hasClass( 'uabb-faq-collapse' ) ) {
			accordion.find( '.uabb-faq-item-active' ).removeClass( 'uabb-faq-item-active' );
			allContent.slideUp( 'normal' );
			accordion.find( '.uabb-faq-questions-button' ).attr('aria-expanded', 'false');
			accordion.find( '.uabb-faq-content' ).attr('aria-hidden', 'true');

			if ( 'none' === icon_animation ) {
				allIcons.removeClass( this.open_icon );
				allIcons.addClass( this.close_icon );
			}
		}

		if ( content.is( ':hidden' ) ) {
			button.attr('aria-expanded', 'true');
			item.find( '.uabb-faq-content' ).attr('aria-hidden', 'false');
			item.addClass( 'uabb-faq-item-active' );
			content.slideDown( 'normal', this._slideDownComplete );

			if ( 'none' === icon_animation ) {
				icon.removeClass( this.close_icon );
				icon.addClass( this.open_icon );
			}
		} else {
			button.attr('aria-expanded', 'false');
			item.find( '.uabb-faq-content' ).attr('aria-hidden', 'true');
			item.removeClass( 'uabb-faq-item-active' );
			content.slideUp( 'normal', this._slideUpComplete );
			if( 'none' === icon_animation ) {
				icon.removeClass( this.open_icon );
				icon.addClass( this.close_icon );
			}
		}

	},

	_focusIn: function( e )
	{
		if ( undefined !== e.target ) {
			var button      = $( e.target ).closest('.uabb-faq-questions-button');
			if ( undefined !== button ) {
				button.attr('aria-selected', 'true');
			}
		}
	},

	_focusOut: function( e )
	{
		if ( undefined !== e.target ) {
			var button      = $( e.target ).closest('.uabb-faq-questions-button');
			if ( undefined !== button ) {
				button.attr('aria-selected', 'false');
			}
		}
	},

	_slideUpComplete: function()
	{
		var content 	= $( this ),
			accordion 	= content.closest( '.uabb-faq-module' );

		accordion.trigger( 'fl-builder.uabb-faq-complete' );
	},

	_slideDownComplete: function()
	{
		var content 	= $( this ),
			accordion 	= content.closest( '.uabb-faq-module' ),
			item 		= content.parent(),
			win  		= $( window );

		if ( ! accordion.hasClass( 'uabb-faq-edit' ) ) {
			if ( item.offset().top < win.scrollTop() + 100 ) {
				$( 'html, body' ).animate({
					scrollTop: item.offset().top - 100
				}, 500, 'swing');
			}
		}
	},

	_enableFirst: function()
	{
		if ( 'undefined' !== typeof this.settings.enable_first ) {
			var firstitem = this.settings.enable_first;
			if ( 'yes' === firstitem ) {
				$( this.nodeClass + ' .uabb-faq-questions-button' ).eq(0).trigger('click');
			}
		}
	}
};

})(jQuery);;
