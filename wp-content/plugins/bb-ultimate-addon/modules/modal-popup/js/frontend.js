jQuery(document).ready(function( $ ) {
	if (  ! $('html').hasClass('fl-builder-edit') ){

		$('.uabb-modal-parent-wrapper').each(function(){
			$(this).appendTo(document.body);
		});
	}
});

(function($) {
	UABBModalPopup = function( settings )
	{	
		this.settings       = settings;
		this.node           = settings.id;
		this.modal_on       = settings.modal_on;
		this.modal_custom   = settings.modal_custom;
		this.modal_content  = settings.modal_content;
		this.video_autoplay  = settings.video_autoplay;
		this.enable_cookies = settings.enable_cookies;
		this.expire_cookie  = settings.expire_cookie;
		this.esc_keypress   = settings.esc_keypress;
		this.overlay_click  = settings.overlay_click;
		this.responsive_display = settings.responsive_display;
		this.medium_device = settings.medium_device;
		this.small_device = settings.small_device;
	
		this._initModalPopup();
		this._initModalPopupVideo();

		var modal_resize = this;

		$( window ).resize(function() {
			modal_resize._centerModal();
			modal_resize._resizeModalPopup();
		});

	};

	UABBModalPopup.prototype = {
		
			settings		: {},
			node   			: '',
			modal_trigger   : '',
			overlay         : '',
			modal_popup		: '',
			modal_on   		: '',
			modal_custom 	: '',
			modal_content 	: '',
			enable_cookies  : '',
			expire_cookie   : '',
			esc_keypress    : '',
			overlay_click   : '',
			video_autoplay  : 'no',
			responsive_display : '',
			medium_device : '',
			small_device : '',
			
			/**
			 * Initiate animation.
			 *
			 * @since 1.1.0.2
			 * @access private
			 * @method _initAnimations
			 */ 

			_initModalPopup: function() {

				$this = this;
				$node_module = $( '.fl-node-'+$this.node );
				$popup_id = $( '.uamodal-'+$this.node );
				
				if ( ( $('html').hasClass('uabb-active-live-preview') || ! $('html').hasClass('fl-builder-edit') ) && this.modal_on == 'custom' && this.modal_custom != '' ) {
					var custom_wrap = $(this.modal_custom);
					
					if ( custom_wrap.length ) {
						custom_wrap.addClass("uabb-modal-action uabb-trigger");
						var data_modal = 'modal-'+this.node;
						custom_wrap.attr( 'data-modal', data_modal );

						$this.modal_trigger = custom_wrap;
						$this.modal_popup   = $( '#modal-' + $this.node );
					 	var	modal_trigger = custom_wrap,
						    modal_close   = $popup_id.find( '.uabb-modal-close' ),
						    modal_popup   = $( '#modal-' + $this.node );
						

						modal_trigger.bind("click", function(){return false;});
						modal_trigger.on( "click", $.proxy( $this._showModalPopup, $this ) );

						modal_close.on( "click", $.proxy( $this._removeModalHandler, $this ) );

						$popup_id.find('.uabb-modal').on( "click", function( e ) {
							if( e.target == this ){
								modal_close.trigger( "click" );
							}
						} );
					} 
				}else if( this.modal_on == 'automatic' ) {
					this.modal_popup = $('#modal-' + this.node );

					var refresh_cookies_name = 'refresh-modal-' + this.node,
						cookies_status = this.enable_cookies;

						if ( cookies_status != 1 && Cookies.get( refresh_cookies_name ) == 'true' ) {
					    	Cookies.remove( refresh_cookies_name );
						}
				}
					
				this.overlay        = $popup_id.find( '.uabb-overlay' );

				$node_module.find( '.uabb-trigger' ).each(function( index ) {
				 	$this.modal_trigger = $(this);
					$this.modal_popup   = $( '#modal-' + $this.node );
				 	var	modal_trigger = $(this),
					    modal_close   = $popup_id.find( '.uabb-modal-close' ),
					    modal_popup   = $( '#modal-' + $this.node );
					

					modal_trigger.bind("click", function(){return false;});
					modal_trigger.on( "click", $.proxy( $this._showModalPopup, $this ) );

					modal_close.on( "click", $.proxy( $this._removeModalHandler, $this ) )

					$popup_id.find('.uabb-modal').on( "click", function( e ) {
						if( e.target == this ){
							modal_close.trigger( "click" );
						}
					} );
						/*function() {
						$this._showModalPopup( this );
					});
					*/

				});

				this._centerModal();
				this._iphonecursorfix();			
			},
			_showAutomaticModalPopup: function() {

				if( ! this._isShowModal() ) {
					return;
				}
				
				jQuery(".uabb-modal-parent-wrapper.uabb-module-content").find(".uabb-modal.uabb-modal-custom").css("pointer-events", "none");
				
				var cookies_name = 'modal-' + this.node,
					refresh_cookies_name = 'refresh-modal-' + this.node,
					cookies_status = this.enable_cookies,
					show_modal = true;

				if ( cookies_status == 1 ) {
					if ( Cookies.get( cookies_name ) == 'true' ) {
						show_modal = false;
					}		
				}else{
					if ( Cookies.get( refresh_cookies_name ) == 'true' ) {
						show_modal = false;
					}	
			    	if ( Cookies.get( cookies_name ) == 'true' ) {
			    		Cookies.remove( cookies_name );
					}
				}		
				
				if ( show_modal == true ) {

					var parent_wrap = $('.fl-node-' + this.node ),
						popup_wrap = $('.uamodal-' + this.node ),
						trigger_args = '.uamodal-' + this.node + ' .uabb-modal-content-data',
						close = popup_wrap.find('.uabb-modal-close' ),
						cookies_days = parseInt( $this.expire_cookie ),
						current_this = this;

					if ( popup_wrap.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
						$('html').addClass('uabb-html-modal');
						popup_wrap.find('.uabb-modal').addClass('uabb-modal-scroll');
					}

					var modal = this.modal_popup;

					if( this.modal_content == 'youtube' || this.modal_content == 'vimeo' ) {
						setTimeout( function() { modal.addClass('uabb-show' ); }, 300 );
					} else {
						modal.addClass('uabb-show' );
					}

					this._videoAutoplay();

				    if ( this.esc_keypress == 1 ) {
						$(document).on('keyup.uabb-modal',function(e) {
							if (e.keyCode == 27) { 
								current_this.modal_popup.removeClass( 'uabb-show' );
								$('html').removeClass('uabb-html-modal');
								current_this._stopVideo();
								$(document).unbind('keyup.uabb-modal');
								if ( cookies_status == 1 ) {
									Cookies.set( cookies_name, 'true', { expires: cookies_days });
								}else{
									Cookies.set( refresh_cookies_name, 'true' );
								}

								UABBTrigger.triggerHook( 'uabb-modal-after-close', popup_wrap );
							}
						});

				    }


				    if ( this.overlay_click == 1 ) {

						this.overlay.on( 'click', function( ev ) {
							current_this.modal_popup.removeClass( 'uabb-show' );
							$('html').removeClass('uabb-html-modal');
							current_this._stopVideo();
							if ( cookies_status == 1 ) {
								Cookies.set( cookies_name, 'true', { expires: cookies_days });
							}else{
								Cookies.set( refresh_cookies_name, 'true' );
							}
							
							UABBTrigger.triggerHook( 'uabb-modal-after-close', popup_wrap );
						} );

					}
					/*$this.overlay.addEventListener( 'click', function( ev ) {
						classie.remove( $this.modal_popup, 'uabb-show' );
					});*/
					
					close.on( 'click', function( ev ) {
						ev.preventDefault();
						current_this.modal_popup.removeClass( 'uabb-show' );
						current_this._stopVideo();

						if ( popup_wrap.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
							setTimeout(function() {
								$('html').removeClass('uabb-html-modal');
								popup_wrap.find('.uabb-modal').removeClass('uabb-modal-scroll');
							}, 300);
						}
						if ( cookies_status == 1 ) {
							Cookies.set( cookies_name, 'true', { expires: cookies_days });
						}else{
							Cookies.set( refresh_cookies_name, 'true' );
						}

						UABBTrigger.triggerHook( 'uabb-modal-after-close', popup_wrap );
					} );

					inner_content_close = popup_wrap.find( '.uabb-close-modal' );
					if ( inner_content_close.length  ) {
						inner_content_close.on( 'click',function(){
							current_this.modal_popup.removeClass( 'uabb-show' );
							current_this._stopVideo();
							if ( cookies_status == 1 ) {
								Cookies.set( cookies_name, 'true', { expires: cookies_days });
							}else{
								Cookies.set( refresh_cookies_name, 'true' );
							}

							UABBTrigger.triggerHook( 'uabb-modal-after-close', popup_wrap );
						});
					}

					/*close.addEventListener( 'click', function( ev ) {
						//console.log( hasPerspective );
						
						classie.remove( $this.modal_popup, 'uabb-show' );
						// console.log( 'Close frontend' );
						
					
					});*/
					UABBTrigger.triggerHook( 'uabb-modal-click', trigger_args );
				}
			},
			_showModalPopup: function() {

				if ( $('html').hasClass('fl-builder-edit') && !$('html').hasClass('uabb-active-live-preview') ) {
					return;
				}

				if( ! this._isShowModal() ) {
					return;
				}

				this._videoAutoplay();

				var active_modal = $('.fl-node-' + this.node ),
				    active_popup = $('.uamodal-' + this.node ),
				    trigger_args = '.uamodal-' + this.node + ' .uabb-modal-content-data';

				if ( active_popup.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
					$('html').addClass('uabb-html-modal');					
					active_popup.find('.uabb-modal').addClass('uabb-modal-scroll');
				}

				jQuery(".uabb-modal-title-wrap").siblings(".uabb-modal-close").css("top", "0");

				var modal = $( '#modal-' + this.node );

				if( this.modal_content == 'youtube' || this.modal_content == 'vimeo' ) {
					setTimeout( function() { modal.addClass('uabb-show' ); }, 300 );
				} else {
					modal.addClass('uabb-show' );
				}

				if ( this.overlay_click == 1) {
					this.overlay.on( 'click',$.proxy( this._removeModalHandler, this ) );
				}
				//this.overlay.addEventListener( 'click', this._removeModalHandler );
				current_this = this;
				if( this.modal_trigger.hasClass('uabb-setperspective' ) ) {
					setTimeout( function() {
						current_this.modal_trigger.addClass('uabb-perspective' );
					}, 25 );
				}
				if ( this.esc_keypress == 1 ) {
					$(document).on('keyup.uabb-modal',function(e) {

						if ( e.keyCode == 27) { 
							current_this._removeModalHandler();
						}
					});
				}

				inner_content_close = active_popup.find( '.uabb-close-modal' );
				if ( inner_content_close.length  ) {
					inner_content_close.on( 'click',$.proxy( this._removeModalHandler, this ) );
				}

				UABBTrigger.triggerHook( 'uabb-modal-click', trigger_args );
			},
			_removeModal: function( hasPerspective ) {
				var active_modal = $('.fl-node-' + this.node ),
				    active_popup = $('.uamodal-' + this.node ) ;
				
				this.modal_popup.removeClass('uabb-show' );

				this._stopVideo();
				/*if ( this.modal_content == 'youtube' || this.modal_content == 'vimeo' || this.modal_content == 'video' ) {

					var modal_iframe 		= active_popup.find( 'iframe' ),
						modal_src 			= modal_iframe.attr( "src" ).replace("&autoplay=1", "");
						
					    modal_iframe.attr( "src", '' );
					    modal_iframe.attr( "src", modal_src );
				}*/
				
				if( hasPerspective ) {
					this.modal_trigger.removeClass( 'uabb-perspective' );
				}
				
				setTimeout(function() {
					$('html').removeClass('uabb-html-modal');
					active_popup.find('.uabb-modal').removeClass('uabb-modal-scroll');
				}, 300);

				$(document).unbind('keyup.uabb-modal');

				UABBTrigger.triggerHook( 'uabb-modal-after-close', active_popup );

			},
			_removeModalHandler: function( ev ) {
				this._removeModal( this.modal_trigger.hasClass('uabb-setperspective' ) ); 
			},
			_resizeModalPopup: function() {
				var active_modal = $('.fl-node-' + this.node ),
				    active_popup = $('.uamodal-' + this.node );
				if (  active_popup.find('.uabb-modal').hasClass('uabb-show') ) {
					if ( active_popup.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
						$('html').addClass('uabb-html-modal');						
						active_popup.find('.uabb-modal').addClass('uabb-modal-scroll');
					}else{
						$('html').removeClass('uabb-html-modal');
						active_popup.find('.uabb-modal').removeClass('uabb-modal-scroll');
					}
				}
			},
			_videoAutoplay: function() {
				var active_modal = $('.fl-node-' + this.node ),
				    active_popup = $('.uamodal-' + this.node );

				if ( this.video_autoplay === 'yes' && ( this.modal_content === 'youtube' || this.modal_content === 'vimeo' ) ) {

					var vid_id = $( '#modal-' + this.node ).find( '.uabb-video-player' ).data( 'id' );

					if( 0 === $( '#modal-' + this.node ).find( '.uabb-video-player iframe' ).length ) {

						$( '#modal-' + this.node ).find( '.uabb-video-player div[data-id=' + vid_id + ']' ).trigger( 'click' );

					}
					else{
						var modal_iframe 		= active_popup.find( 'iframe' ),
						modal_src 				= modal_iframe.attr( "src" ) + '&autoplay=1';

						modal_iframe.attr( "src",  modal_src );
					}
					
				}
				if ( 'iframe' === this.modal_content ) {

					if( active_popup.find( '.uabb-modal-content-data iframe' ).length === 0 ) {

						var src = active_popup.find( '.uabb-modal-content-type-iframe' ).data( 'src' );

						var iframe = document.createElement( "iframe" );
									iframe.setAttribute( "src", src );
									iframe.setAttribute( "style", "display:none;" );
									iframe.setAttribute( "frameborder", "0" );
									iframe.setAttribute( "allowfullscreen", "1" );
									iframe.setAttribute( "width", "100%" );
									iframe.setAttribute( "height", "100%" );
									iframe.setAttribute( "class", "uael-content-iframe" );

									active_popup.find( '.uabb-modal-content-data' ).html( iframe );
									active_popup.find( '.uabb-modal-content-data' ).append( '<div class="uabb-loader"><div class="uabb-loader-1"></div><div class="uabb-loader-2"></div><div class="uabb-loader-3"></div></div>' );

						var id = this.node;

						iframe.onload = function() {
							window.parent.jQuery( document ).find('#modal-' + id + ' .uabb-loader' ).fadeOut();
							this.style.display='block';
						};

					}
				}
			},
			_stopVideo: function() {
				var active_modal = $('.fl-node-' + this.node ),
				    active_popup = $('.uamodal-' + this.node );

				if ( this.modal_content != 'photo' ) {

					var modal_iframe 		= active_popup.find( 'iframe' ),
						modal_video_tag 	= active_popup.find( 'video' );

						if ( modal_iframe.length ) {
							var modal_src 			= modal_iframe.attr( "src" ).replace("&autoplay=1", "");
							modal_iframe.attr( "src", '' );
						    modal_iframe.attr( "src", modal_src );
						}else if ( modal_video_tag.length ) {
				        	modal_video_tag[0].pause();
							modal_video_tag[0].currentTime = 0;
						}
				}
			},
			_isShowModal: function() {

				if ( this.responsive_display != '' ) {

					var current_window_size = $(window).width(),
                        medium_device = parseInt( this.medium_device ),
                        small_device = parseInt( this.small_device );

					if ( this.responsive_display == 'desktop' && current_window_size > medium_device ) {
						
						return true;
					}else if( this.responsive_display == 'desktop-medium' && current_window_size > small_device ){
						
						return true;
					}else if( this.responsive_display == 'medium' && current_window_size < medium_device && current_window_size > small_device ){

						return true;
					}else if( this.responsive_display == 'medium-mobile' && current_window_size < medium_device ){

						return true;
					}else if( this.responsive_display == 'mobile' && current_window_size < small_device ){

						return true;
					}else{

						return false;
					}
				}

				return true;
			},
			_centerModal: function () {

				$this 		 = this;
				popup_wrap = $('.uamodal-' + this.node );
				modal_popup  = '#modal-' + $this.node;
				node 		 = '.uamodal-' + $this.node;

				if ( $( '#modal-' + this.node ).hasClass('uabb-center-modal') ) {
		        	$( '#modal-' + this.node ).removeClass('uabb-center-modal');

				}

				if( $( '#modal-' + this.node + '.uabb-show' ).outerHeight() != null ) {

					var top_pos  = (($(window).height() - $( '#modal-' + this.node + '.uabb-show' ).outerHeight()) / 2);
					
					if ( popup_wrap.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
	   		            $(node).find( modal_popup ).css( 'top', '0' );
						$(node).find( modal_popup ).css( 'transform', 'none' );
					} else {
						$(node).find( modal_popup ).css( 'top', + top_pos +'px' );
						$(node).find( modal_popup ).css( 'transform', 'none' );
					}
					
				} else {
					
					if ( popup_wrap.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
	   		            $(node).find( modal_popup ).css( 'top', '0' );
						$(node).find( modal_popup ).css( 'transform', 'none' );
					} else {
						$(node).find( modal_popup ).css( 'top', '50%' );
						$(node).find( modal_popup ).css( 'transform', 'translateY(-50%)' );
					}
				}

			},
			_iphonecursorfix: function () {

				$this 		 = this;
				popup_wrap = $('.uamodal-' + this.node );
				modal_popup  = '#modal-' + $this.node;
				node 		 = '.uamodal-' + $this.node;

				iphone = (( navigator.userAgent.match(/iPhone/i) == 'iPhone' ) ? 'iphone' : '' );
				ipod = (( navigator.userAgent.match(/iPod/i) == 'iPod' ) ? 'ipod' : '' );

				jQuery('html').addClass(iphone).addClass(ipod);
				jQuery( 'html.iphone .uabb-modal-action-wrap .uabb-module-content .uabb-button.uabb-trigger, html.ipod .uabb-modal-action-wrap .uabb-module-content .uabb-button.uabb-trigger' ).click ( function() {
				    jQuery('body').css( 'position', 'fixed' );
				});

				if( this.overlay_click == 1 ) {
					jQuery(document).on('click', '.uabb-overlay', function() {  
					   if( jQuery('html').hasClass('iphone') || jQuery('html').hasClass('ipod') ) {
					      jQuery('body').css( 'position', 'relative' );
					   }
					});
				}

				jQuery(document).on('click', '.uabb-modal-close', function() {  
				   if( jQuery('html').hasClass('iphone') || jQuery('html').hasClass('ipod') ) {
				      jQuery('body').css( 'position', 'relative' );
				   }
				});
			},
			_initModalPopupVideo : function(){

				var play_icon = 'far fa-play-circle';

				if ( this.modal_content === 'youtube' || this.modal_content === 'vimeo' ) {

					if( 0 === $( '.uabb-video-player iframe' ).length ){

						$( '.uabb-video-player' ).each( function( index, value ) {

							var div = $( "<div/>" );
								div.attr( 'data-id', $( this ).data( 'id' ) );
								div.attr( 'data-src', $( this ).data( 'src' ) );
								div.attr( 'data-append', $( this ).data( 'append' ) );
								div.html( '<img src="' + $( this ).data( 'thumb' ) + '"><div class="play ' + play_icon + '"></div>' );

								div.on( "click",function(){

									var iframe 	= document.createElement( "iframe" );
									var src 	= this.dataset.src;
									var append 	= this.dataset.append;
        							var url 	= '';

									 if ( 'youtube' === src ) {
        								url = 'https://www.youtube.com/embed/' + this.dataset.id + this.dataset.append + '&autoplay=1';
        							} else {
        								url = 'https://player.vimeo.com/video/' + this.dataset.id + this.dataset.append + '&autoplay=1';
        							}
									iframe.setAttribute( "src", url );
									iframe.setAttribute( "frameborder", "0" );
									iframe.setAttribute( "allowfullscreen", "1" );
									this.parentNode.replaceChild( iframe, this );
								});
								$( this ).html( div );
						});
					}	
				}
			}
	}

})(jQuery);
