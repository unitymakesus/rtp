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
    } else if ( settings.animation == 'slide_up' ) {
      this.speed       = settings.speed;
      this.pause       = settings.pause;
      this.mousePause  = settings.mousePause;
      this.suffix      = settings.suffix;
      this.prefix      = settings.prefix;
      this.alignment   = settings.alignment;
    } else {
      this.headline			= this.nodeClass + ' .uabb-fancy-heading';
	  this.dynamicWrapper		= this.nodeClass + ' .uabb-fancy-text-dynamic-wrapper';
      this.animationDelay       = settings.animation_speed;
      // letters effect
      this.lettersDelay		= settings.letter_delay;
      // clip effect
      this.revealDuration		= settings.duration_reveal;
      this.revealAnimationDelay = settings.animation_revel;

      this.classes			= {
        dynamicText: 			'uabb-fancy-dynamic-text',
        dynamicLetter:			'uabb-fancy-dynamic-letter',
        textActive: 			'uabb-fancy-text-active',
        textInactive: 			'uabb-fancy-text-inactive',
        letters: 				'uabb-fancy-letters',
        animationIn: 			'uabb-fancy-animation-in',
        typeSelected: 			'uabb-fancy-typing-selected'
      };

      this.elements			= {};

      this._fillWords();

      $( window ).on( 'load', $.proxy( this._initHeadlines, this ) );
      
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

    /* Other efftecs var */
    headline				: '',
		dynamicWrapper			: '',
		animationDelay			: '',
		lettersDelay			: '',
		revealDuration			: '',
		revealAnimationDelay	: '',

    _initFancyText: function(){

      if( typeof jQuery.fn.waypoint !== 'undefined' ) {
        $(this.nodeClass).waypoint({
          offset: this.viewport_position + '%',
          handler: $.proxy( this._triggerAnimation, this )
        });
      }
    },
    
    _fillWords: function()
		{
			var classes 		= this.classes,
				dynamicWrapper 	= $(this.dynamicWrapper),
				settings		= this.settings;

				var fancytext = this.settings.fancy_text.split('|');

				fancytext.forEach( function( word, index ) {
					var dynamicText = $('<span>', { 'class': classes.dynamicText }).html( word.replace( / /g, '&nbsp;' ) );

					if ( ! index ) {
						dynamicText.addClass( classes.textActive );
					}

					dynamicWrapper.append( dynamicText );
				} );

			this.elements.dynamicText = dynamicWrapper.children( '.' + classes.dynamicText );
    },

    _initHeadlines: function()
		{
				this._rotateHeadline();
		},

		_rotateHeadline: function() {

			//insert <span> element for each letter of a changing word
			if ( $(this.headline).hasClass( this.classes.letters ) ) {
				this._singleLetters();
			}

			//initialise headline animation
			this._animateHeadline();
    },

    _singleLetters: function() {
			var classes = this.classes;

			this.elements.dynamicText.each( function() {
				var $word = $( this ),
					letters = $word.text().split( '' ),
					isActive = $word.hasClass( classes.textActive );

				$word.empty();

				letters.forEach( function( letter ) {
					var $letter = jQuery( '<span>', { 'class': classes.dynamicLetter } ).text( letter );

					if ( isActive ) {
						$letter.addClass( classes.animationIn );
					}

					$word.append( $letter );
				} );

				$word.css( 'opacity', 1 );
			} );
    },
    
    _animateHeadline: function() {
			var self 			= this,
				animationType 	= self.settings.animation,
				dynamicWrapper 	= $(self.dynamicWrapper);

			if ( 'clip' === animationType ) {
				dynamicWrapper.width( dynamicWrapper.width() + 10 );
			} else {
				//assign to .uabb-headline-dynamic-wrapper the width of its longest word
				var width = 0;

				self.elements.dynamicText.each( function() {
					var wordWidth = $( this ).width();

					if ( wordWidth > width ) {
						width = wordWidth;
					}
				} );

				dynamicWrapper.css( 'width', width );
			}

			//trigger animation
			setTimeout( function() {
				self._hideWord( self.elements.dynamicText.eq( 0 ) );
			}, self.animationDelay );
		},

		_showLetter: function( $letter, $word, bool, duration ) {
			var self 			= this,
				classes 		= self.classes,
				animationType 	= self.settings.animation;

			$letter.addClass( classes.animationIn );

			if ( ! $letter.is( ':last-child' ) ) {
				setTimeout( function() {
					self._showLetter( $letter.next(), $word, bool, duration );
				}, duration );
			} else {
				if ( ! bool ) {
					setTimeout( function() {
						self._hideWord( $word );
					}, self.animationDelay );
				}
			}
		},

		_hideLetter: function( $letter, $word, bool, duration ) {
			var self = this;

			$letter.removeClass( self.classes.animationIn );

			if ( ! $letter.is( ':last-child' ) ) {
				setTimeout( function() {
					self._hideLetter( $letter.next(), $word, bool, duration );
				}, duration );
			} else if ( bool ) {
				setTimeout( function() {
					self._hideWord( self._getNextWord( $word ) );
				}, self.animationDelay );
			}
		},

		_showWord: function( $word, duration ) {
			var self 			= this,
				animationType 	= self.settings.animation;

			 if ( 'clip' === animationType ) {
				$(self.dynamicWrapper).animate( { 'width': $word.width() + 10 }, self.revealDuration, function() {
					setTimeout( function() {
						self._hideWord( $word );
					}, self.revealAnimationDelay );
				} );
			}
		},

		_hideWord: function( $word ) {
			var self 			= this,
				classes 		= self.classes,
				letterSelector 	= '.' + classes.dynamicLetter,
				animationType 	= self.settings.animation,
        nextWord 		= self._getNextWord( $word );
        
			 if ( $(self.headline).hasClass( classes.letters ) ) {
				var bool = $word.children( letterSelector ).length >= nextWord.children( letterSelector ).length;

				self._hideLetter( $word.find( letterSelector ).eq( 0 ), $word, bool, self.lettersDelay );

				$word.removeClass( classes.textActive );

				self._showLetter( nextWord.find( letterSelector ).eq( 0 ), nextWord, bool, self.lettersDelay );

				nextWord.addClass( classes.textActive );

			} else if ( 'clip' === animationType ) {
				$(self.dynamicWrapper).animate( { width: '2px' }, self.revealDuration, function() {
					self._switchWord( $word, nextWord );
					self._showWord( nextWord );
				} );
			} else {
				self._switchWord( $word, nextWord );

				setTimeout( function() {
					self._hideWord( nextWord );
				}, self.animationDelay );
			}
		},

		_getNextWord: function( $word )
		{
			return $word.is( ':last-child' ) ? $word.parent().children().eq( 0 ) : $word.next();
		},

		_switchWord: function( $oldWord, $newWord )
		{
			$oldWord
				.removeClass( 'uabb-fancy-text-active' )
				.addClass( 'uabb-fancy-text-inactive' );

			$newWord
				.removeClass( 'uabb-fancy-text-inactive' )
				.addClass( 'uabb-fancy-text-active' );
		},

		_getSvgPaths: function( pathName ) {
			var pathsInfo = this.svgPaths[ pathName ],
				$paths = jQuery();

			pathsInfo.forEach( function( pathInfo ) {
				$paths = $paths.add( $( '<path>', { d: pathInfo } ) );
			} );

			return $paths;
		},

    _triggerAnimation: function(){
      if ( this.animation == 'type' ) {
       $( this.nodeClass + " .uabb-typed-main" ).typed({
          strings: this.strings,
          typeSpeed: this.typeSpeed,
          startDelay: this.startDelay,
          backSpeed: this.backSpeed,
          backDelay: this.backDelay,
          loop: this.loop,
          showCursor: this.showCursor,
          cursorChar: this.cursorChar,
        });
      } else if ( this.animation == 'slide_up' ) { 

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
              });
      }
      
    }
  };
})(jQuery);