(function($) {
  
  /**
   * Fancy Text Prototype
   *
   */
  UABBFancyText = function( settings ){

    this.settings           = settings;
    this.viewport_position  =  90;
    this.animation          = settings.animation;
    this.nodeClass          = '.fl-node-' + settings.id;

    /* Type Var */
    if ( settings.animation == 'type' ) {
      this.strings     = settings.strings;
      this.typeSpeed   = settings.typeSpeed;
      this.startDelay  = settings.startDelay;
      this.backSpeed   = settings.backSpeed;
      this.backDelay   = settings.backDelay;
      this.loop        = settings.loop;
      // this.loopCount   = settings.loopCount;
      this.showCursor  = settings.showCursor;
      this.cursorChar  = settings.cursorChar;
    }else{
      this.speed       = settings.speed;
      this.pause       = settings.pause;
      this.mousePause  = settings.mousePause;
      this.suffix      = settings.suffix;
      this.prefix      = settings.prefix;
      this.alignment   = settings.alignment;
    }

    /* Slide Up Var */

    /* Initialize Animation */ 
    this._initFancyText();
    
  };

  UABBFancyText.prototype = {
    settings        : {},
    nodeClass       : '',
    viewport_position : 90,
    animation       : 'type',

    /* Type Var */
    strings     : '',
    typeSpeed   : '',
    startDelay  : '',
    backSpeed   : '',
    backDelay   : '',
    loop        : '',
    loopCount   : '',
    showCursor  : '',
    cursorChar  : '',

    /* SLide Up var */
    speed       : '',
    pause       : '',
    mousePause  : '',

    _initFancyText: function(){

      if( typeof jQuery.fn.waypoint !== 'undefined' ) {
        $(this.nodeClass).waypoint({
          offset: this.viewport_position + '%',
          handler: $.proxy( this._triggerAnimation, this )
        });
      }
    },

    _triggerAnimation: function(){
      if ( this.animation == 'type' ) {
       /*var newclass =*/
       // this.strings = "'"+ this.strings +"'";
       $( this.nodeClass + " .uabb-typed-main" ).typed({
          strings: this.strings,
          typeSpeed: this.typeSpeed,
          startDelay: this.startDelay,
          backSpeed: this.backSpeed,
          backDelay: this.backDelay,
          loop: this.loop,
          // loopCount: this.loopCount,
          showCursor: this.showCursor,
          cursorChar: this.cursorChar,
        });
      }else if ( this.animation == 'slide_up' ) { 

        if( ( this.suffix.trim() == '' && this.alignment == 'left' ) || ( this.suffix.trim() == '' && this.prefix.trim() == '' ) ) {

          var max = 0;
          jQuery( '.uabb-slide-block' ).each(function(){
            var c_width = jQuery(this).outerWidth();
            if (c_width > max) {
                  max = c_width;
              }
          });
          jQuery( this.nodeClass + " .uabb-slide-main" ).css('min-width', max +'px');
        } else {
          jQuery( this.nodeClass + " .uabb-slide-main" ).removeAttr('style');          
        }

        $( this.nodeClass + " .uabb-slide-main")
              .vTicker('init', {
                  speed       : this.speed, 
                  pause       : this.pause,
                  mousePause  : this.mousePause,
                    /*showItems: <?php echo ( !empty($settings->show_items) ) ? $settings->show_items : 1; ?>,*/
              });

        /*$( window ).resize(function() {
            $( this.nodeClass + " .uabb-slide-main")
              .vTicker('init', {
                  speed       : this.speed, 
                  pause       : this.pause,
                  mousePause  : this.mousePause,
              });
        });*/
      }
      
    }
  };
})(jQuery);