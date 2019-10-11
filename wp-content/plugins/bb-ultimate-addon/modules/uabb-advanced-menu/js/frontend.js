(function($) {

	/**
	 * Class for Menu Module
	 *
	 * @since 1.6.0
	 */
	UABBCreativeMenu = function( settings ) {

		// set params
		this.settingsId 		 = settings.id;
		this.nodeClass           = '.fl-node-' + settings.id;
		this.wrapperClass        = this.nodeClass + ' .uabb-creative-menu';
		this.type				 = settings.type;
		this.mobileToggle		 = settings.mobile;
		this.mobileBelowRow		 = settings.mobileBelowRow;
		this.breakPoints         = settings.breakPoints;
		this.mobileBreakpoint	 = settings.mobileBreakpoint;
		this.mediaBreakpoint	 = settings.mediaBreakpoint;
		this.mobileMenuType	 	 = settings.mobileMenuType;
		this.isBuilderActive	 = settings.isBuilderActive;
		this.currentBrowserWidth = $( window ).width();

		// initialize the menu
		this._initMenu();

		// check if viewport is resizing
		$( window ).on( 'resize', $.proxy( function( e ) {

			var width = $( window ).width();

			// if screen width is resized, reload the menu
		    if( width != this.currentBrowserWidth ) {

				this._initMenu();
 				this._clickOrHover();
		    	this.currentBrowserWidth = width;
			}

		}, this ) );

	};

	UABBCreativeMenu.prototype = {
		nodeClass               : '',
		wrapperClass            : '',
		type 	                : '',
		breakPoints 			: {},
		$submenus				: null,

		/**
		 * Check if the screen size fits a mobile viewport.
		 *
		 * @since  1.6.0
		 * @return bool
		 */
		_isMobile: function() {
			return $( window ).width() <= this.breakPoints.small ? true : false;
		},

		/**
		 * Check if the screen size fits a medium viewport.
		 *
		 * @since  1.6.0
		 * @return bool
		 */
		_isMedium: function() {
			return $( window ).width() <= this.breakPoints.medium ? true : false;
		},

		/**
		 * Check if the screen size fits a custom viewport.
		 *
		 * @since  1.6.0
		 * @return bool
		 */
		_isCustom: function() {
			return $( window ).width() <= this.breakPoints.custom ? true : false;
		},

		/**
		 * Check if the menu should toggle for the current viewport base on the selected breakpoint
		 *
		 * @see 	this._isMobile()
		 * @see 	this._isMedium()
		 * @since  	1.6.0
		 * @return bool
		 */
		_isMenuToggle: function() {
			if ( 'always' == this.mobileBreakpoint
				|| ( this._isMobile() && 'mobile' == this.mobileBreakpoint )
				|| ( this._isMedium() && 'medium-mobile' == this.mobileBreakpoint )
				|| ( this._isCustom() && 'custom' == this.mobileBreakpoint )
				) {
				return true;
			}

			return false;
		},

		/**
		 * Initialize the toggle logic for the menu.
		 *
		 * @see    this._isMenuToggle()
		 * @see    this._menuOnCLick()
		 * @see    this._clickOrHover()
		 * @see    this._submenuOnRight()
		 * @see    this._toggleForMobile()
		 * @see    this._initBelowRowMenu()
		 * @since  1.6.0
		 * @return void
		 */
		_initMenu: function() {
			this._menuOnFocus();

			if ( $( this.nodeClass ).length ) {
				this._initMegaMenus();
			}

			if( this._isMenuToggle() || this.type == 'accordion' ) {

				$( this.wrapperClass ).off( 'mouseenter mouseleave' );
				this._menuOnClick();
				this._clickOrHover();

			} else {
				$( this.wrapperClass ).off( 'click' );
				this._submenuOnRight();
			}

			if( this.mobileToggle != 'expanded' ) {
				this._toggleForMobile();
				this._initBelowRowMenu();

				if( this.mobileMenuType === 'off-canvas' ) {
					this._initializeCanvas();
				}

				if( this.mobileMenuType === 'full-screen' ) {
					this.__initializeFullScreen();
				}
			}
		},

		/**
		 * Adds a focus class to menu elements similar to be used similar to CSS :hover psuedo event
		 *
		 * @since  1.6.0
		 * @return void
		 */
		_menuOnFocus: function() {
			$( this.nodeClass ).off('focus').on( 'focus', 'a', $.proxy( function( e ) {
				var $menuItem	= $( e.target ).parents( '.menu-item' ).first(),
					$parents	= $( e.target ).parentsUntil( this.wrapperClass );

				$('.uabb-creative-menu .focus').removeClass('focus');

				$menuItem.addClass('focus');
				$parents.addClass('focus');

			}, this ) ).on( 'focusout', 'a', $.proxy( function( e ) {
				$( e.target ).parentsUntil( this.wrapperClass ).removeClass( 'focus' );
			}, this ) );
		},

		/**
		 * Logic for submenu toggling on accordions or mobile menus (vertical, horizontal)
		 *
		 * @since  1.6.0
		 * @return void
		 */
		_menuOnClick: function() {
			$( '.uabb-has-submenu-container' ).off().click( $.proxy( function( e ) {

				var $link			= $( e.target ).parents( '.uabb-has-submenu' ).first(),
					$subMenu 		= $link.children( '.sub-menu' ).first(),
					$href	 		= $link.children('.uabb-has-submenu-container').first().find('> a').attr('href'),
					$subMenuParents = $( e.target ).parents( '.sub-menu' ),
					$activeParent 	= $( e.target ).closest( '.uabb-has-submenu.uabb-active' );

				if( !$subMenu.is(':visible') || $(e.target).hasClass('uabb-menu-toggle')
					|| ($subMenu.is(':visible') && (typeof $href === 'undefined' || $href == '#')) ) {
					e.preventDefault();
				}
				else {
					window.location.href = $href;
					return;
				}

				if ($(this.wrapperClass).hasClass('uabb-creative-menu-accordion-collapse')) {

					if ( !$link.parents('.menu-item').hasClass('uabb-active') ) {
						$('.uabb-active', this.wrapperClass).not($link).removeClass('uabb-active');
					}
					else if ($link.parents('.menu-item').hasClass('uabb-active') && $link.parent('.sub-menu').length) {
						$('.uabb-active', this.wrapperClass).not($link).not($activeParent).removeClass('uabb-active');
					}

					$('.sub-menu', this.wrapperClass).not($subMenu).not($subMenuParents).slideUp('normal');
				}

				$subMenu.slideToggle();
				$link.toggleClass( 'uabb-active' );
			}, this ) );

		},

		/**
		 * Changes general styling and behavior of menus based on mobile / desktop viewport.
		 *
		 * @see    this._isMobile()
		 * @since  1.6.0
		 * @return void
		 */
		_clickOrHover: function() {
			this.$submenus = this.$submenus || $( this.wrapperClass ).find( '.sub-menu' );
			var $wrapper   = $( this.wrapperClass ),
				$menu      = $wrapper.find( '.menu' );
				$li        = $wrapper.find( '.uabb-has-submenu' );

			if( this._isMenuToggle() ) {
				$li.each( function( el ) {
					if( !$(this).hasClass('uabb-active') ) {
						$(this).find( '.sub-menu' ).fadeOut();
					}
				} );
			} else {
				$li.each( function( el ) {
					if( !$(this).hasClass('uabb-active') ) {
						$(this).find( '.sub-menu' ).css( {
							'display' : '',
							'opacity' : ''
						} );
					}
				} );
			}
		},

		/**
		 * Logic to prevent submenus to go outside viewport boundaries.
		 *
		 * @since  1.6.0
		 * @return void
		 */
		_submenuOnRight: function() {

			$( this.wrapperClass )
				.on( 'mouseenter', '.uabb-has-submenu', $.proxy( function( e ) {

					if( $ ( e.currentTarget ).find('.sub-menu').length === 0 ) {
						return;
					}

					var $link           = $( e.currentTarget ),
						$parent         = $link.parent(),
						$subMenu        = $link.find( '.sub-menu' ),
						subMenuWidth    = $subMenu.width(),
						subMenuPos      = 0,
						winWidth        = $( window ).width();

					if( $link.closest( '.uabb-menu-submenu-right' ).length !== 0) {

						$link.addClass( 'uabb-menu-submenu-right' );

					} else if( $( 'body' ).hasClass( 'rtl' ) ) {

						subMenuPos = $parent.is( '.sub-menu' ) ?
									 $parent.offset().left - subMenuWidth:
									 $link.offset().left - subMenuWidth;

						if( subMenuPos <= 0 ) {
							$link.addClass( 'uabb-menu-submenu-right' );
						}

					} else {

						subMenuPos = $parent.is( '.sub-menu' ) ?
									 $parent.offset().left + $parent.width() + subMenuWidth :
									 $link.offset().left + subMenuWidth;

						if( subMenuPos > winWidth ) {
							$link.addClass('uabb-menu-submenu-right');
						}
					}
				}, this ) )
				.on( 'mouseleave', '.uabb-has-submenu', $.proxy( function( e ) {
					$( e.currentTarget ).removeClass( 'uabb-menu-submenu-right' );
				}, this ) );

		},

		/**
		 * Logic for the mobile menu button.
		 *
		 * @since  1.6.0
		 * @return void
		 */
		_toggleForMobile: function() {

			var $wrapper = null,
				$menu    = null;

			if( this._isMenuToggle() ) {

				$wrapper = $( this.wrapperClass );
				$menu    = $wrapper.children( '.menu' );

				if( !$wrapper.find( '.uabb-creative-menu-mobile-toggle' ).hasClass( 'uabb-active' ) ) {
					if( window.innerWidth <= this.mediaBreakpoint ) {
						$menu.css({ display: 'none' });
					} else {
						if( !this.mobileBelowRow == 'below-row' ) {
							$menu.css({ display: 'block' });
						}
					}
				}

				$wrapper.off().on( 'click', '.uabb-creative-menu-mobile-toggle', function( e ) {
					$( this ).toggleClass( 'uabb-active' );
					$menu.slideToggle();
				} );

				$menu.on( 'click', '.menu-item > a[href*="#"]', function(e) {
					var $href = $(this).attr('href'),
						$targetID = '';

					if ( $href !== '#' ) {
						$targetID = $href.split('#')[1];

						if ( $('body').find('#'+  $targetID).length > 0 ) {
							e.preventDefault();
							$( this ).toggleClass( 'uabb-active' );
							$menu.slideToggle('fast', function() {
								setTimeout(function() {
									$('html, body').animate({
								        scrollTop: $('#'+ $targetID).offset().top
								    }, 1000, function() {
								        window.location.hash = $targetID;
								    });
								}, 500);
							});
						}
					}
				});
			}
			else {

				$wrapper = $( this.wrapperClass ),
				$menu    = $wrapper.children( '.menu' );
				$wrapper.find( '.uabb-creative-menu-mobile-toggle' ).removeClass( 'uabb-active' );
				$menu.css({ display: '' });
			}
		},

		/**
		 * Logic for the Below Row menu.
		 *
		 * @since  1.11.0
		 * @return void
		 */
		_initBelowRowMenu: function() {

			var $wrapper = null,
				$menu    = null;

			if( this._isMenuToggle() && (window.innerWidth <= this.mediaBreakpoint || this.mediaBreakpoint == 'always' )) {
				if ( this._isMobileBelowRowEnabled() ) {
					this._placeMobileMenuBelowRow();
					$wrapper = $( this.wrapperClass );
					$menu    = $( this.nodeClass + '-clone' );
					$menu.find( 'ul.menu' ).show();
				} else {
					$wrapper = $( this.wrapperClass );
					$menu    = $wrapper.children( '.menu' );
				}

				if( false != this.mobileBelowRow && !$wrapper.find( '.uabb-creative-menu-mobile-toggle' ).hasClass( 'uabb-active' ) ) {
					if( window.innerWidth <= this.mediaBreakpoint || this.mediaBreakpoint == 'always' )  {
						$menu.css({ display: 'none' });
					} else {
						$menu.css({ display: 'block' });
					}
				}

				$wrapper.off().on( 'click', '.uabb-creative-menu-mobile-toggle', function( e ) {
					$( this ).toggleClass( 'uabb-active' );
					$menu.slideToggle();
				} );

			} else {
				if ( this._isMobileBelowRowEnabled() ) {
					this._removeMenuFromBelowRow();
				}

				$wrapper = $( this.wrapperClass ),
				$menu    = $wrapper.children( '.menu' );
				$wrapper.find( '.uabb-creative-menu-mobile-toggle' ).removeClass( 'uabb-active' );
				$menu.css({ display: '' });
			}
		},

		/**
		 * Initialize Off Canvas Menu.
		 *
		 * @since  	1.6.0
		 * @return void
		 */
		_initializeCanvas: function() {
			if ( this.isBuilderActive ) {
				this._toggleMenu();
				return;
			}
			if ( 'always' === this.mediaBreakpoint || this.mediaBreakpoint >= this.currentBrowserWidth ) {
				$(this.nodeClass).find('.uabb-creative-menu.off-canvas').appendTo('body').wrap('<div class="fl-node-'+this.settingsId+'">');
			}
			this._toggleMenu();
		},

		/**
		 * Initialize Overlay Menu.
		 *
		 * @since  	1.6.0
		 * @return void
		 */
		__initializeFullScreen: function() {
			if ( this.isBuilderActive ) {
				this._toggleMenu();
				return;
			}
			if ( 'always' === this.mediaBreakpoint || this.mediaBreakpoint >= this.currentBrowserWidth ) {
				$(this.nodeClass).find('.uabb-creative-menu.full-screen').appendTo('body').wrap('<div class="fl-node-'+this.settingsId+'">');
			}
			this._toggleMenu();
		},

		/**
		 * Trigger the toggle event for off-canvas.
		 * and full-screen overlay menus.
		 *
		 * @since  	1.6.0
		 * @return void
		 */
		_toggleMenu: function() {
			var self = this;
			// Toggle Click
			$(self.nodeClass).find('.uabb-creative-menu-mobile-toggle' ).off('click').on( 'click', function() {
				if( $(self.nodeClass).find('.uabb-creative-menu').hasClass('menu-open') ) {
					$(self.nodeClass).find('.uabb-creative-menu').addClass('menu-close');
					$(self.nodeClass).find('.uabb-creative-menu').removeClass('menu-open');
				} else {
					$(self.nodeClass).find('.uabb-creative-menu').addClass('menu-open');
				}
			} );

			// Close button click
			$(self.nodeClass).find('.uabb-creative-menu .uabb-menu-close-btn, .uabb-clear' ).on( 'click', function() {
				$(self.nodeClass).find('.uabb-creative-menu').addClass('menu-close');
				$(self.nodeClass).find('.uabb-creative-menu').removeClass('menu-open');

			} );

			if ( this.isBuilderActive ) {
				setTimeout(function() {
					if ( $('.fl-builder-settings[data-node="'+self.settingsId+'"]').length > 0 ) {
						$('.uabb-creative-menu').removeClass('menu-open');
						$(self.nodeClass).find('.uabb-creative-menu-mobile-toggle').trigger('click');
					}
				}, 600);

				FLBuilder.addHook('settings-form-init', function() {
					if ( ! $('.fl-builder-settings[data-node="'+self.settingsId+'"]').length > 0 ) {
						return;
					}
					if ( ! $(self.nodeClass).find('.uabb-creative-menu').hasClass('uabb-menu-overlay') ) {
						$('.fl-builder-panel').css('z-index', '999999');
					}
					if ( ! $(self.nodeClass).find('.uabb-creative-menu').hasClass('menu-open') ) {
						$('.uabb-creative-menu').removeClass('menu-open');
						$('.uabb-creative-menu-mobile-toggle').removeClass('uabb-active');

						$(self.nodeClass).find('.uabb-creative-menu-mobile-toggle').trigger('click');
					}
				});
			}
		},

		/**
		 * Check to see if Below Row should be enabled.
		 *
		 * @since  	1.11.0
		 * @return boolean
		 */
		_isMobileBelowRowEnabled: function() {
			return this.mobileBelowRow && $( this.nodeClass ).closest( '.fl-col' ).length;
		},

		/**
		 * Logic for putting the mobile menu below the menu's
		 * column so it spans the full width of the page.
		 *
		 * @since  1.11.0
		 * @return void
		 */
		_placeMobileMenuBelowRow: function() {

			if ( $( this.nodeClass + '-clone' ).length ) {
				return;
			}

			var module = $( this.nodeClass ),
				clone  = module.clone(),
				col    = module.closest( '.fl-row-content' );
			module.find( 'ul.menu' ).css('display','none');
			clone.addClass( ( this.nodeClass + '-clone' ).replace( '.', '' ) );
			clone.find( '.uabb-creative-menu-mobile-toggle' ).remove();
			col.after( clone );

			this._menuOnClick();
		},

		/**
		 * Logic for removing the mobile menu from below the menu's
		 * column and putting it back in the main wrapper.
		 *
		 * @since  1.11.0
		 * @return void
		 */
		_removeMenuFromBelowRow: function(){
			if ( ! $( this.nodeClass + '-clone' ).length ) {
				return;
			}
			var module = $( this.nodeClass );
			module.find( 'ul.menu' ).css('display','none'),
				clone  = $( this.nodeClass + '-clone' );
				menu   = clone.find( 'ul.menu' );
			module.find( 'ul.menu' ).after( menu );

			clone.remove();
		},

		/**
		 * Init any mega menus that exist.
		 *
		 * @see 	this._isMenuToggle()
		 * @since  	1.6.0
		 * @return void
		 */
		_initMegaMenus: function() {

			var module     = $( this.nodeClass ),
				rowContent = module.closest( '.fl-row-content' ),
				rowWidth   = rowContent.width(),
				rowOffset  = ( rowContent.offset.left != undefined ) ? rowContent.offset().left : '',
				megas      = module.find( '.mega-menu' ),
				disabled   = module.find( '.mega-menu-disabled' ),
				isToggle   = this._isMenuToggle();

			if ( isToggle ) {
				megas.removeClass( 'mega-menu' ).addClass( 'mega-menu-disabled' );
				module.find( 'li.mega-menu-disabled > ul.sub-menu' ).css( 'width', '' );
				rowContent.css( 'position', '' );
			} else {
				disabled.removeClass( 'mega-menu-disabled' ).addClass( 'mega-menu' );
				module.find( 'li.mega-menu > ul.sub-menu' ).css( 'width', rowWidth + 'px' );
				rowContent.css( 'position', 'relative' );
			}
		},

	};

})(jQuery);
