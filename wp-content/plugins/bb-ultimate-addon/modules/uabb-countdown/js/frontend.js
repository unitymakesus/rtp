(function($) {
	UABBCountdown = function( settings )
	{
		this.timer_exp_text	= "";
		this.settings 	  = settings;
		this.nodeClass  = '.fl-node-' + settings.id;
        this.id         = settings.id;
		this.timertype	= settings.timertype;
		this.timerid	= '#countdown-' + settings.id;
		this.timer_date	= settings.timer_date;
		this.timer_format	= settings.timer_format;
		this.timer_layout	= settings.timer_layout;
		this.timer_labels	= settings.timer_labels;
		this.timer_labels_singular	= settings.timer_labels_singular;
		this.redirect_link = settings.redirect_link;
		this.redirect_link_target = settings.redirect_link_target;
		this.fixed_timer_action = settings.fixed_timer_action;
		this.evergreen_timer_action = settings.evergreen_timer_action;
		this.evergreen_date_days = settings.evergreen_date_days;
		this.evergreen_date_hour = settings.evergreen_date_hour;
		this.evergreen_date_minutes = settings.evergreen_date_minutes;
		this.evergreen_date_seconds = settings.evergreen_date_seconds;
		this.timezone = settings.time_zone;

		if( this.timezone == 'NULL') {
			this.timezone = null;
		}

		if ( settings.timer_exp_text ) {
			this.timer_exp_text	= settings.timer_exp_text;
		}

		if( this.timertype == "fixed" ) {
			this._initFixedTimer();
		}

		if( this.timertype == "evergreen" ) {

			var currdate = '';
			var timevar = 0;

			if( $.cookie( "countdown-" + settings.id) == undefined ) {
				$.cookie( "countdown-" + settings.id, true);
				$.cookie( "countdown-" + settings.id + "-currdate", new Date());
				$.cookie( "countdown-" + settings.id + "-day", this.evergreen_date_days);
				$.cookie( "countdown-" + settings.id + "-hour", this.evergreen_date_hour);
				$.cookie( "countdown-" + settings.id + "-min", this.evergreen_date_minutes);
				$.cookie( "countdown-" + settings.id + "-sec", this.evergreen_date_seconds);

			}

			currdate = new Date( $.cookie( "countdown-" + settings.id + "-currdate") );

			timevar = ( parseFloat(this.evergreen_date_days*24*60*60) + parseFloat(this.evergreen_date_hour*60*60) + parseFloat(this.evergreen_date_minutes*60) + parseFloat( this.evergreen_date_seconds ) ) * 1000;

			currdate.setTime(currdate.getTime() + timevar);

			this.timer_date = currdate;

			this._initEverGreenTimer();
		}

		this._initCountdown();
	};
	UABBCountdown.prototype = {

		_initCountdown: function() {
			fixed_timer_action = this.fixed_timer_action;
			settings = this.settings;
			var action = '';

			if( this.timertype == "fixed" ) {
				action = this.fixed_timer_action;
			} else {
				action = this.evergreen_timer_action;
			}

			$.cookie( "countdown-" + settings.id + "expiremsg", null);
			$.cookie( "countdown-" + settings.id + "redirect", null);
			$.cookie( "countdown-" + settings.id + "redirectwindow", null);
			$.cookie( "countdown-" + settings.id + "hide", null);
			$.cookie( "countdown-" + settings.id + "reset", null);

			$.removeCookie( "countdown-" + settings.id + "expiremsg");
			$.removeCookie( "countdown-" + settings.id + "redirect");
			$.removeCookie( "countdown-" + settings.id + "redirectwindow");
			$.removeCookie( "countdown-" + settings.id + "hide");
			$.removeCookie( "countdown-" + settings.id + "reset");

			
			if( action == "msg") {

				$.cookie( "countdown-" + settings.id + "expiremsg", settings.expire_message, { expires: 365 } );

			} else if( action == "redirect") {

				$.cookie( "countdown-" + settings.id + "redirect", settings.redirect_link, { expires: 365 } );
				$.cookie( "countdown-" + settings.id + "redirectwindow", settings.redirect_link_target, { expires: 365 } );

			} else if( action == "hide") {

				$.cookie( "countdown-" + settings.id + "hide", "yes", { expires: 365 } );

			} else if( action == 'reset' ) {
				$.cookie( "countdown-" + settings.id + "reset", "yes", { expires: 365 } );
			}
		},
	
		_initFixedTimer: function() {

			var dateNow = new Date();

			if( ( dateNow.getTime() - this.timer_date.getTime() ) > 0 ) {
				if( this.fixed_timer_action == 'msg' ) {
					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).append(this.timer_exp_text);
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				        	expiryText: this.timer_exp_text
						});
					}

				} else if( this.fixed_timer_action == 'redirect' ) {

					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						window.open( this.redirect_link, this.redirect_link_target );
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				        	expiryText: this.timer_exp_text
						});
					}

				} else if( this.fixed_timer_action == 'hide' ) {
					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).countdown('destroy');
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				        	expiryText: this.timer_exp_text
						});
					}

				} else {
					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
					});
				}
			} else {
				if( this.fixed_timer_action == 'msg' ) {
					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				        	expiryText: this.timer_exp_text,
						});
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
						});
					}
				} else if( this.fixed_timer_action == 'redirect' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	expiryText: this.timer_exp_text,
			        	onExpiry: this._redirectCounter
					});

				} else if( this.fixed_timer_action == 'hide' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	expiryText: this.timer_exp_text,
			        	onExpiry: this._destroyCounter
					});

				} else {
					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	expiryText: this.timer_exp_text
					});
				}
			}
		},

		_destroyCounter: function() {
			if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
				jQuery( this ).countdown('destroy');
			}
		},

		_redirectCounter: function() {

			redirect_link = jQuery.cookie( jQuery(this)[0].id + "redirect" );
			redirect_link_target = jQuery.cookie( jQuery(this)[0].id + "redirectwindow" );

			if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
				window.open( redirect_link, redirect_link_target );
			} else {
				return;
			}
		},

		_initEverGreenTimer: function() {
			var dateNow = new Date();
			if( ( dateNow.getTime() - this.timer_date.getTime() ) > 0 ) {

				if( this.evergreen_timer_action == 'msg' ) {


					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).append($.cookie( "countdown-" + this.settings.id + "expiremsg" ));
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				    		expiryText: $.cookie( "countdown-" + this.settings.id + "expiremsg" ),
						});
					}

				} else if( this.evergreen_timer_action == 'redirect' ) {

					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						window.open( this.redirect_link, this.redirect_link_target );
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				    		onExpiry: this._redirectCounter
						});
					}

				} else if( this.evergreen_timer_action == 'hide' ) {
					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).countdown('destroy');
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				    		onExpiry: this._destroyCounter
						});
					}

				} else if( this.evergreen_timer_action == 'reset' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	onExpiry: this._restartCountdown
					});

				} else {
					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
					});
				}
			} else {
				if( this.evergreen_timer_action == 'msg' ) {
					if( parseInt(window.location.href.toLowerCase().indexOf("?fl_builder")) === parseInt(-1) ) {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
				        	expiryText: $.cookie( "countdown-" + this.settings.id + "expiremsg" ),
						});
					} else {
						$( this.timerid ).countdown({
							until: this.timer_date,
							format: this.timer_format,
							layout: this.timer_layout,
							labels: this.timer_labels.split(","),
							timezone: this.timezone,
				    		labels1: this.timer_labels_singular.split(","),
						});
					}

				} else if( this.evergreen_timer_action == 'redirect' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	onExpiry: this._redirectCounter
					});

				} else if( this.evergreen_timer_action == 'hide' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	onExpiry: this._destroyCounter
					});

				} else if( this.evergreen_timer_action == 'reset' ) {

					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
			        	onExpiry: this._restartCountdown
					});

				} else {
					$( this.timerid ).countdown({
						until: this.timer_date,
						format: this.timer_format,
						layout: this.timer_layout,
						labels: this.timer_labels.split(","),
						timezone: this.timezone,
			    		labels1: this.timer_labels_singular.split(","),
					});
				}
			}

		},

		_restartCountdown: function() {
			
			$.cookie( this.id + "-currdate", new Date() );

			currdate = new Date( $.cookie( this.id + "-currdate") );

			var evergreen_date_days = $.cookie( this.id + "-day" );
			var evergreen_date_hour = $.cookie( this.id + "-hour" );
			var evergreen_date_minutes = $.cookie( this.id + "-min" );
			var evergreen_date_seconds = $.cookie( this.id + "-sec" );

			var timevar = ( parseFloat(evergreen_date_days*24*60*60) + parseFloat(evergreen_date_hour*60*60) + parseFloat(evergreen_date_minutes*60) + parseFloat( evergreen_date_seconds ) ) * 1000;
			currdate.setTime(currdate.getTime() + timevar);

			this.timer_date = currdate;

			jQuery(this).countdown('option', {until: this.timer_date} );
		},
	};

})(jQuery);