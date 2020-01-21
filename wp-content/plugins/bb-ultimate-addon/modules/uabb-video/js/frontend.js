(function($) {
  UABBVideo = function( settings ) {
    this.nodeClass         = '.fl-node-' + settings.id;
    this.id                = settings.id;
    
    var outer_wrap = jQuery(this.nodeClass).find( '.uabb-video__outer-wrap' );
    var inner_wrap = jQuery(this.nodeClass).find( '.uabb-video-inner-wrap' );
    var sticky_margin_bottom = settings.stickybottom;

     outer_wrap.off( 'click' ).on( 'click', function( e ) {
      var sticky_target = e.target.parentNode.className;
      if ( typeof sticky_target === 'string' || sticky_target instanceof String ) {
         if( ( sticky_target.indexOf( 'uabb-sticky-close-icon' ) >= 0 ) || ( sticky_target.indexOf( 'uabb-video-sticky-close' ) >= 0 ) ) {
          return false;
         }
    }
    var selector  = $( this ).find( '.uabb-video__play' );
      UABBVideos._play( selector );
    });


		if( '1' == outer_wrap.data( 'autoplay' ) || true == outer_wrap.data( 'device' ) ) {
      UABBVideos._play( jQuery(this.nodeClass).find( '.uabb-video__play' ) );
    }

    /* Sticky video function start  */
    if( '1' === settings.vsticky || true === settings.vsticky ) {
        /**Start js function */
         if( 'undefined' !==  typeof jQuery.fn.waypoint ) {
            var wrapClass = jQuery(this.nodeClass );
            var uabb_waypoint = new Waypoint({
            element: wrapClass ,
            handler: function(direction) {
                if (  "down" === direction) {
                    outer_wrap.removeClass( 'uabb-sticky-hide' );
                    outer_wrap.addClass( 'uabb-sticky-apply' );
                     $( document ).trigger( 'uabb_after_sticky_applied', wrapClass );
                } else  {
                    outer_wrap.removeClass( 'uabb-sticky-apply' );
                    outer_wrap.addClass( 'uabb-sticky-hide' );
               }
            },
              offset: '0px',triggerOnce: false
            });
         }
         //Close the sticky video.
          var close_button = wrapClass.find( '.uabb-video-sticky-close' );
          close_button.off( 'click.closetrigger' ).on( 'click.closetrigger', function(e) {
              uabb_waypoint.destroy();
              outer_wrap.removeClass( 'uabb-sticky-apply' );
              outer_wrap.removeClass( 'uabb-sticky-hide' );
          });
          checkResize( uabb_waypoint );
          checkScroll();
          window.addEventListener( "scroll", checkScroll );
          $( window ).resize( function( e ) {
                  checkResize( uabb_waypoint );
           } );

          //sticky hide on function
          function checkResize( uabb_waypoint ) {
              var width = $( window ).width();
              if (  width <= settings.small_breakpoint  && 'mobile'=== settings.sticky_hide_on ){
                  disableSticky( uabb_waypoint );
               }
              else if ( ( width >= settings.small_breakpoint && width <= settings.medium_breakpoint ) && 'tablet' === settings.sticky_hide_on ){
                  disableSticky( uabb_waypoint );
              }
              else if ( ( width <=  settings.medium_breakpoint ) && 'both' === settings.sticky_hide_on  ){
                  disableSticky( uabb_waypoint );
              }
              else if (  width >= settings.medium_breakpoint  && 'desktop' === settings.sticky_hide_on ){
                 disableSticky( uabb_waypoint );
              }
              else
              {
                uabb_waypoint.enable();
              }
          }
          // Disable the sticky video.
          function disableSticky( uabb_waypoint ) {
            uabb_waypoint.destroy();
            outer_wrap.removeClass( 'uabb-sticky-apply' );
            outer_wrap.removeClass( 'uabb-sticky-hide' );
          }
          // Draggable Function.
          function checkScroll() {
            if(  outer_wrap.hasClass( 'uabb-sticky-apply' ) ){
              inner_wrap.draggable({ start: function() {
                $( this ).css({ transform: "none", top: $( this ).offset().top + "px", left: $( this ).offset().left + "px" });
              },
              containment: 'window'
              });
            }
          }
          // Sticky applly.
          $( document ).on( 'uabb_after_sticky_applied', function( e , wrapClass) {
          var infobar      =  $( wrapClass ).find( '.uabb-video-sticky-infobar' );
          var bottom_left  =  $( wrapClass ).find( '.uabb-video-sticky-bottom_left' );
          var bottom_right =  $( wrapClass ).find( '.uabb-video-sticky-bottom_right' );
          var center_left  =  $( wrapClass ).find( '.uabb-video-sticky-center_left' );
          var center_right =  $( wrapClass ).find( '.uabb-video-sticky-center_right' );
          // If Sticky on center viewport then caluated the posion with infobaar .
          if( 0 !== infobar.length ) {
             if( 1 == center_left.length || 1 == center_right.length )  {
                  var center_infobar_height =  infobar.outerHeight();
                  center_infobar_height     =  Math.ceil( center_infobar_height / 2 );
                  inner_wrap.css( 'top', 'calc( 50% - ' + center_infobar_height + 'px )' );
              }
          }
          // If Sticky on Butoom viewport then caluated the bottom margin.
          if( 0 !== infobar.length && '' !== sticky_margin_bottom ) {
            if( 1 == bottom_left.length || 1 == bottom_right.length )  {
              var infobar_height =  infobar.outerHeight();
              infobar_height     =  Math.ceil( infobar_height );
              var stick_bottom   =  infobar_height + sticky_margin_bottom;
              inner_wrap.css( 'bottom', stick_bottom );
            }
          }
        });
     }
      /* Sticky video function End */
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
  	},

  }
})(jQuery);
