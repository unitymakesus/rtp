(function($) {
  UABBVideo = function( settings ) {
    this.nodeClass         = '.fl-node-' + settings.id;
  	this.id                = settings.id;
		var outer_wrap = jQuery(this.nodeClass).find( '.uabb-video__outer-wrap' );

		outer_wrap.off( 'click' ).on( 'click', function( e ) {
			var selector 	= $( this ).find( '.uabb-video__play' );
			UABBVideos._play( selector );
		});

		if( '1' == outer_wrap.data( 'autoplay' ) || true == outer_wrap.data( 'device' ) ) {
      UABBVideos._play( jQuery(this.nodeClass).find( '.uabb-video__play' ) );
    }
  };
  UABBVideos = {
  	_play: function( selector ) {

  		var iframe 		= $( "<iframe/>" );
      var vurl 		= selector.data( 'src' );

      if ( 0 == selector.find( 'iframe' ).length ) {

      	iframe.attr( 'src', vurl );
		    iframe.attr( 'frameborder', '0' );
		    iframe.attr( 'allowfullscreen', '1' );
		    iframe.attr( 'allow', 'autoplay;encrypted-media;' );

		    selector.html( iframe );
      }
      selector.closest( '.uabb-video__outer-wrap' ).find( '.uabb-vimeo-wrap' ).hide();
  	}
  }
})(jQuery);
