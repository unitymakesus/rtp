(function($) {
	/**
	 * Class for hotspot Module
	 *
	 * @since 1.16.0
	 */
	UABB_Hotspot = function( settings ) {
		this.form              = $('.fl-builder-settings');
		this.nodeClass         = '.fl-node-' + settings.node;
		this.hotspotInterval   = null;
		this.hoverFlag         = false;
		this.scrolling         = false;  
		this.node_id           = settings.node;
		this.hotspot_tour      = settings.hotspot_tour;
		this.repeat            = settings.repeat;
		this.action_autoplay   = settings.action_autoplay;
		this.autoplay          = settings.autoplay;
		this.length            = settings.length;
		this.overlay_id        = settings.overlay_id;
		this.button_id         = settings.button_id;
		this.isElEditMode      = settings.isElEditMode;
		this.tour_interval     = settings.tour_interval;
		this.overlay           = settings.overlay;
		this.marker_count      = this.length - 1;
		this._init();
	}


	UABB_Hotspot.prototype = {
		// Start of hotspot functionality.
		_init: function() {
			var marker_id = 0 ;
		    clearInterval( this.hotspotInterval );

			if ( 'yes' ===  this.hotspot_tour && 'yes' === this.autoplay && 'click' ===  this.action_autoplay )
			 {
			 	var bselector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item');
				if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
					bselector.removeClass( 'uabb-hotspot-hover' );
				}	
			 	this._overlayInit( marker_id );
			} 
			else
			{
				//Initialy open first tooltip by default.
				if ( 'yes' === this.autoplay ) {
					jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + this.marker_id ).css( "pointer-events", "none" );
					this._tooltipNav( marker_id );
					this._showtiooltips( marker_id );
					this._buttonOverlay( marker_id );
				} 
				if ( 'no' === this.autoplay ) {
					jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + this.marker_id ).css( "pointer-events", "none" );
					clearInterval( this.hotspotInterval );
					this._tooltipNav( marker_id );
					this._showtiooltips( marker_id );		
				} 

			}
			// Next , Prevoius and End Tour function intialisation with click.
			var outer_wrap_nav_item = jQuery(this.nodeClass).find( '.uabb-tour' );
			var outer_wrap_end_tour = jQuery(this.nodeClass).find( '.uabb-hotspot-end' );
			var self = this;
			outer_wrap_nav_item.off( 'click' ).on( 'click', function( event ) {
				 event.preventDefault();
				if ( jQuery(event.target).hasClass( 'uabb-next' ) ) {
                   self._next( event );
				}	
				if ( jQuery(event.target).hasClass( 'uabb-prev' ) ) {
                   self._previous( event );
				}	
			});
			outer_wrap_end_tour.off( 'click' ).on( 'click', function( event ) {
				event.preventDefault();
				if ( jQuery(event.target).hasClass( 'uabb-tour-end' ) ) {
                   self._endTour( event );
				}
			});


		},

		// If overlay init funtion. 
		_overlayInit : function( marker_id ) {
			var selector = jQuery( '.fl-node-' + this.node_id + ' .uabb-overlay-button a ');
			selector.removeAttr( 'href' );
			var self = this ;
			selector.click( function( event ) {
				self.overlay_id = self.form.find( '.uabb-hotspot-overlay' );
				self.button_id 	= self.form.find( '.uabb-overlay-button' );
				var bselector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' );
				if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
					bselector.removeClass( 'uabb-hotspot-hover' );
				}	
				self._buttonOverlay( marker_id );	
			} );
		},

		// Disable prev & next nav for 1st & last tooltip.
		_tooltipNav : function( marker_id ) {
			if ( 'yes' !== this.repeat ) {
				$( '.fl-node-'+ this.node_id + ' .uabb-hotspot-items .uabb-prev-' + marker_id + '[data-tooltips-id="1"]' ).addClass( "inactive" );
				$( '.fl-node-'+ this.node_id + ' .uabb-hotspot-items .uabb-next-' + marker_id + '[data-tooltips-id="' + this.length + '"]' ).addClass( "inactive" );
			}
		},

		// Tooltip execution for tour functionality with interval.
		_sectionInterval : function( marker_id ) {
       		var self = this;
			var sid = 0 ;
			if ( marker_id == length - 1 ) {
			   marker_id = 0 ;
		    }
       		this.hotspotInterval = setInterval( function() {

				var bselector = jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-item-' + marker_id );			
				if (  bselector.hasClass( 'uabb-hotspot-hover' ) ) {
					sid = jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-item ' ).data('name');
				}
				if ( ! self.hoverFlag ) {
			
				   self._showtiooltips( sid );
					if ( 'yes' === self.repeat ) {
						if ( ! self.isElEditMode ) {
							if ( sid == self.marker_count ) {
								sid = 0;
							} else {
								sid = sid + 1;
							}

							self._showtiooltips( sid );
							$(window).scroll(function (event) {
								self._checkScroll( marker_id, self ); 
							});
						
						} else {
							if ( sid < this.length ) {
								if ( sid == self.marker_count ) {
									sid = 0 ;
								} else {
									sid = sid + 1 ;
								}
		                   		self._showtiooltips( sid );
							} else if ( sid === this.length ) {
								if ( 'click' === this.action_autoplay ) {
									this.bselector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' );
									if ( this.bselector.hasClass( 'uabb-hotspot-hover' ) ) {
										this.bselector.removeClass( 'uabb-hotspot-hover' );
									}	
									clearInterval( this.hotspotInterval );
									self._buttonOverlay( marker_id );
									$( '.uabb-hotspot-overlay' ).css({ 'display' : '', 'block' : '' });	
								} 		
							}
						}
					} else if ( 'no' === self.repeat ) {
						if ( sid < self.length - 1 ) {
							sid = sid + 1;	
							self._showtiooltips( sid );
						} else if ( sid === self.marker_count ) {
							if ( 'click' === self.action_autoplay )
							{
								var bselector = jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-item' );
								if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
									bselector.removeClass( 'uabb-hotspot-hover' );
								}	
								clearInterval( self.hotspotInterval );
								self._buttonOverlay( marker_id );
								$( '.uabb-hotspot-overlay' ).css({ 'display' : '', 'block' : '' });
							} 						
						}
					}
				}	
			}, self.tour_interval );
		},

		// Show tooltip on marker id 
	    _showtiooltips:function( marker_id ) {
	    	
	    	var bselector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' );
			if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
				bselector.removeClass('uabb-hotspot-hover');
			}	
			var selector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + marker_id );
			if ( selector.hasClass( 'uabb-hotspot-hover' ) ) {
				selector.removeClass( 'uabb-hotspot-hover' );
			} else {
				selector.addClass( 'uabb-hotspot-hover' );
			}
		},

		// Add button overlay when tour ends.
		_buttonOverlay : function( marker_id ) {
			var self = this;
            var bselector = jQuery( '.fl-node-'+ self.node_id +' .uabb-hotspot-item' );
			if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
				bselector.removeClass( 'uabb-hotspot-hover' );
			}	
		    clearInterval( this.hotspotInterval );
			if ( 'click' === self.action_autoplay ) {
		    	
				if ( 'yes' === this.overlay ) {

					if ( 'yes' == this.autoplay ) {
						jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-container .uabb-hotspot-overlay .uabb-overlay-button').click(function(event) {
							event.stopPropagation();
							jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-container .uabb-hotspot-overlay').hide();
							self._tourPlay( marker_id );							
						});
					}
			   }
			} else if ( 'auto' === self.action_autoplay && 'yes' === self.autoplay ) {
				if( ! self.isElEditMode ) {
					var selector = jQuery( '.fl-node-'+ self.node_id +' .uabb-hotspot' );

					if( 'undefined' !==  typeof jQuery.fn.waypoint ) {
						jQuery( '.fl-node-'+ self.node_id +' .uabb-hotspot' ).waypoint({
							offset: '10%',
							triggerOnce: true,
							handler: function( e ) {
								self._tourPlay(0);
							}
						});
					}
				}
			} else {
				this._tourPlay(0);
			}
		},

		// Execute Tooltip execution for tour functionality
		_tourPlay: function( marker_id ) {
		clearInterval( this.hotspotInterval );
			//Initialy open first tooltip by default.
			if ( 'yes' === this.autoplay ) {
				jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + marker_id ).css( "pointer-events", "none" );
				this._tooltipNav( marker_id );
				this._showtiooltips( marker_id );
				this._sectionInterval( marker_id );
			} else if ( 'no' === this.autoplay ) {
				jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + id ).css( "pointer-events", "none" );
				this.tooltipNav( marker_id );
				this.showtiooltips( 0 );
			}
		},

		// Open next tooltip on trigger.
		_next: function( event ) {
			var self = this;
			if ( !jQuery(event.target).is( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' ) ) {

				var currentnode = jQuery(event.target).data('tooltips-id') - 1 ;
				var sid = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + currentnode ).data('name');
				if ( sid <= this.length ) {
					if ( 'yes' === this.repeat ) {
						 if ( sid === this.marker_count ) {
							sid = 0;
						} else {
							sid = sid + 1;
						}					
					} else {
						sid = sid + 1;
					}
					self._showtiooltips( sid );
				}			
			self._tooltipNav(sid)
			}
		},

		// Open prev tooltip on trigger.
		_previous: function( event ) {
			var self = this;
			if ( !jQuery(event.target).is('.fl-node-'+ this.node_id +' .uabb-hotspot-item') ) {
				var currentnode = jQuery(event.target).data('tooltips-id') - 1 ;
				var sid = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item-' + currentnode).data('name');
				if ( sid <= this.length ) {
					if ( 'yes' === this.repeat ) {
						if (sid === 0) {
							sid = this.marker_count ; 
						} else {
							sid = sid - 1;		
					    }
					} else {
						sid = sid - 1;		
					}
					self._showtiooltips( sid );
				}		
				self._tooltipNav( sid )
			}
		},

		// End tour tooltip on trigger.
		_endTour: function( event ) {
			if ( !jQuery(event.target).is( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' ) ) {
          		var id = jQuery(event.target).data( 'itemid' ) ;
				var bselector = jQuery( '.fl-node-' + this.node_id + ' .uabb-hotspot-item' );
				if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
					bselector.removeClass( 'uabb-hotspot-hover' );
				}		
				clearInterval( this.hotspotInterval );	
				if ( 'auto' === this.action_autoplay && 'yes' === this.autoplay ) {
					$( '.fl-node-'+ this.node_id +' .uabb-hotspot-item-'+ id ).css( "pointer-events", "none" );
				} else {
					this._buttonOverlay( id );
					$( '.fl-node-'+ this.node_id +' .uabb-hotspot-overlay' ).css({ 'display' : '' });
				}						
			}
		},

		// On page scroll update overlay. 
		_updateSections : function( marker_id ) {
			var self = this ;
			var halfWindowHeight = $(window).height()/2;
			var scrollTop = $(document).scrollTop();
			var section = self.form.find( '.uabb-hotspot-container' );
			var divsection = $( '.uabb-hotspot-container' ).offset();
	        if ( ! (divsection.top - halfWindowHeight < scrollTop ) && ( divsection.top + section.height() - halfWindowHeight > scrollTop) ) {
			} else {
				if ( 'yes' === self.hotspot_tour && 'yes' === self.autoplay && 'click' === self.action_autoplay ) {
					var bselector = jQuery( '.fl-node-' + self.node_id + ' .uabb-hotspot-item' );
					if ( bselector.hasClass( 'uabb-hotspot-hover' ) ) {
						bselector.removeClass( 'uabb-hotspot-hover' );
					}	
					clearInterval( self.hotspotInterval );
					self._buttonOverlay();
					$( '.fl-node-'+ self.node_id +' .uabb-hotspot-overlay' ).css({ 'display' : '' });	
				}
			} 
		  scrolling = false;
		},

       // On page scroll check. 
		_checkScroll : function( marker_id , self ) {
			if ( ! self.scrolling ) {
 				self.scrolling = true;
				(!window.requestAnimationFrame) ? setTimeout( self._updateSections( marker_id ), 300) : window.requestAnimationFrame = self._updateSections( marker_id ) ;
			}
		},
	}
})(jQuery);
