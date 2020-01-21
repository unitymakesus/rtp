(function($){

	FLBuilder.registerModuleHelper('uabb-countdown', {

		rules: {
			title: {
				required: true
			}
		},
		submit: function(){

			var self = this;
			var form   = $('.fl-builder-settings'),

				timer_type    = form.find('select[name=timer_type]').val(),
				day    = parseInt( form.find('select[name=fixed_date_days]').val() ),
				month  = parseInt( form.find('select[name=fixed_date_month]').val() ),
				year   = parseInt( form.find('select[name=fixed_date_year]').val() ),
				hour   = parseInt( form.find('select[name="fixed_date_hour"]').val() ),
				minute = parseInt( form.find('select[name="fixed_date_minutes"]').val() ),
				date   = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':00 ';

			if( timer_type == "fixed" && Date.parse( date ) <= Date.now() ) {
				FLBuilder.alert( "Error! You should select date in the future." );
				return false;
			}

			return true;

		},
		init: function()
		{
			var form    	= $('.fl-builder-settings'),
			    timer_type = form.find('select[name=timer_type]'),
			    timer_style = form.find('select[name=timer_style]'),
				fixed_date_day = form.find('select[name=fixed_date_days]'),
				fixed_date_month = form.find('select[name=fixed_date_month]'),
				fixed_date_year = form.find('select[name=fixed_date_year]'),
				fixed_date_hour = form.find('select[name=fixed_date_hour]'),
				fixed_date_minutes = form.find('select[name=fixed_date_minutes]'),

				evergreen_date_days = form.find('select[name=evergreen_date_days]'),
				evergreen_date_hours = form.find('select[name=evergreen_date_hour]'),
				evergreen_date_minutes = form.find('select[name=evergreen_date_minutes]'),
				evergreen_date_seconds = form.find('select[name=evergreen_date_seconds]'),

				year_string = form.find('select[name=year_string]'),
				month_string = form.find('select[name=month_string]'),
				day_string = form.find('select[name=day_string]'),
				hour_string = form.find('select[name=hour_string]'),
				minute_string = form.find('select[name=minute_string]'),
				second_string = form.find('select[name=second_string]'),


				unit_position = form.find('select[name=unit_position]'),
				evergreen_timer_action = form.find('select[name=evergreen_timer_action]'),
				fixed_timer_action = form.find('select[name=fixed_timer_action]'),
				year_string_custom	= form.find('select[name=year_custom_label]'),
				month_string_custom	= form.find('select[name=month_custom_label]'),
				day_custom_label	= form.find('select[name=day_custom_label]'),
				hour_custom_label	= form.find('select[name=hour_custom_label]'),
				minute_custom_label	= form.find('select[name=minute_custom_label]'),
				second_custom_label	= form.find('select[name=second_custom_label]');

			year_string.on('change', this.hide_fields );
			month_string.on('change', this.hide_fields );
			day_string.on('change', this.hide_fields );
			hour_string.on('change', this.hide_fields );
			minute_string.on('change', this.hide_fields );
			second_string.on('change', this.hide_fields );

			year_string_custom.on('change', this.hide_fields );
			month_string_custom.on('change', this.hide_fields );
			day_custom_label.on('change', this.hide_fields );
			hour_custom_label.on('change', this.hide_fields );
			minute_custom_label.on('change', this.hide_fields );
			second_custom_label.on('change', this.hide_fields );

			timer_type.on('change', this.hide_timer_type );
			timer_type.on('change', this.hide_fields );
			evergreen_timer_action.on('change', this.hide_timer_type );
			fixed_timer_action.on('change', this.hide_timer_type );
			timer_style.on('change', this.hide_margin_fields );
			unit_position.on('change', this.hide_margin_fields );
			this.hide_timer_type();
			this.hide_fields();
			this.hide_margin_fields();
		},

		hide_fields: function()
		{
			var form		= $('.fl-builder-settings'),
				timer_type = form.find('select[name=timer_type]').val(),
				year_string	= form.find('select[name=year_string]').val(),
				year_string_custom	= form.find('select[name=year_custom_label]').val(),
				month_string	= form.find('select[name=month_string]').val(),
				month_string_custom	= form.find('select[name=month_custom_label]').val(),
				day_string	= form.find('select[name=day_string]').val(),
				day_string_custom	= form.find('select[name=day_custom_label]').val(),
				hour_string	= form.find('select[name=hour_string]').val(),
				hour_string_custom	= form.find('select[name=hour_custom_label]').val(),
				minute_string	= form.find('select[name=minute_string]').val(),
				minute_string_custom	= form.find('select[name=minute_custom_label]').val(),
				second_string	= form.find('select[name=second_string]').val(),
				second_string_custom	= form.find('select[name=second_custom_label]').val();

			if( timer_type == 'fixed' ) {
				$("#fl-field-year_string").show();
				if ( year_string == "" ) {
					$("#fl-field-year_plural_label").hide();
					$("#fl-field-year_singular_label").hide();
					$("#fl-field-year_custom_label").hide();
				} else {
					$("#fl-field-year_custom_label").show();
					if( year_string_custom == "no" ){
						$("#fl-field-year_plural_label").hide();
						$("#fl-field-year_singular_label").hide();
					} else {
						$("#fl-field-year_plural_label").show();
						$("#fl-field-year_singular_label").show();
					}
				}
			} else {
				$("#fl-field-year_plural_label").hide();
				$("#fl-field-year_singular_label").hide();
				$("#fl-field-year_string").hide();
				$("#fl-field-year_custom_label").hide();
			}

			/*if( timer_type == 'fixed' ) {
				$("#fl-field-month_string").show();
				if ( month_string == "" ) {
					$("#fl-field-month_plural_label").hide();
					$("#fl-field-month_singular_label").hide();
					$("#fl-field-month_custom_label").hide();
				} else {
					$("#fl-field-month_custom_label").show();
					if( month_string_custom == "no" ){
						$("#fl-field-month_plural_label").hide();
						$("#fl-field-month_singular_label").hide();
					} else {
						$("#fl-field-month_plural_label").show();
						$("#fl-field-month_singular_label").show();
					}
				}
			} else {
				$("#fl-field-month_plural_label").hide();
				$("#fl-field-month_singular_label").hide();
				$("#fl-field-month_string").hide();
				$("#fl-field-month_custom_label").hide();
			}*/


			if ( month_string == "" ) {
				$("#fl-field-month_plural_label").hide();
				$("#fl-field-month_singular_label").hide();
				$("#fl-field-month_custom_label").hide();
			} else {
				$("#fl-field-month_custom_label").show();
				if( month_string_custom == "no" ){
					$("#fl-field-month_plural_label").hide();
					$("#fl-field-month_singular_label").hide();
				} else {
					$("#fl-field-month_plural_label").show();
					$("#fl-field-month_singular_label").show();
				}
			}

			if ( day_string != "D" ) {
				$("#fl-field-day_plural_label").hide();
				$("#fl-field-day_singular_label").hide();
				$("#fl-field-day_custom_label").hide();
			} else {
				$("#fl-field-day_custom_label").show();
				if( day_string_custom == "no" ){
					$("#fl-field-day_plural_label").hide();
					$("#fl-field-day_singular_label").hide();
				} else {
					$("#fl-field-day_plural_label").show();
					$("#fl-field-day_singular_label").show();
				}
			}

			if ( hour_string == "" ) {
				$("#fl-field-hour_plural_label").hide();
				$("#fl-field-hour_singular_label").hide();
				$("#fl-field-hour_custom_label").hide();
			} else {
				$("#fl-field-hour_custom_label").show();
				if( hour_string_custom == "no" ){
					$("#fl-field-hour_plural_label").hide();
					$("#fl-field-hour_singular_label").hide();
				} else {
					$("#fl-field-hour_plural_label").show();
					$("#fl-field-hour_singular_label").show();
				}
			}

			if ( minute_string == "" ) {
				$("#fl-field-minute_plural_label").hide();
				$("#fl-field-minute_singular_label").hide();
				$("#fl-field-minute_custom_label").hide();
			} else {
				$("#fl-field-minute_custom_label").show();
				if( minute_string_custom == "no" ){
					$("#fl-field-minute_plural_label").hide();
					$("#fl-field-minute_singular_label").hide();
				} else {
					$("#fl-field-minute_plural_label").show();
					$("#fl-field-minute_singular_label").show();
				}
			}

			if ( second_string == "" ) {
				$("#fl-field-second_plural_label").hide();
				$("#fl-field-second_singular_label").hide();
				$("#fl-field-second_custom_label").hide();
			} else {
				$("#fl-field-second_custom_label").show();
				if( second_string_custom == "no" ) {
					$("#fl-field-second_plural_label").hide();
					$("#fl-field-second_singular_label").hide();
				} else {
					$("#fl-field-second_plural_label").show();
					$("#fl-field-second_singular_label").show();
				}
			}
		},
		hide_timer_type: function()
		{
			var form		= $('.fl-builder-settings'),
			    timer_type = form.find('select[name=timer_type]').val(),
				year_string	= form.find('select[name=year_string]').val(),
				year_string_custom	= form.find('select[name=year_custom_label]').val(),
				month_string	= form.find('select[name=month_string]').val(),
				month_string_custom	= form.find('select[name=month_custom_label]').val(),
				evergreen_timer_action = form.find('select[name=evergreen_timer_action]').val(),
				fixed_timer_action = form.find('select[name=fixed_timer_action]').val();

			/*if ( timer_type == "evergreen" ) {
				$("#fl-field-year_custom_label").hide();
				$("#fl-field-month_custom_label").hide();
				
				$("#fl-field-year_plural_label").hide();
				$("#fl-field-year_singular_label").hide();
				$("#fl-field-month_plural_label").hide();
				$("#fl-field-month_singular_label").hide();
			} else {
				if( $("#year_custom_label_uabb_toggle_1").is(":checked") == true ){
					$("#fl-field-year_plural_label").show();
					$("#fl-field-year_singular_label").show();
				}
				if( $("#month_custom_label_uabb_toggle_1").is(":checked") == true ){
					$("#fl-field-month_plural_label").show();
					$("#fl-field-month_singular_label").show();
				}
			}*/

			if( $("#year_custom_label_uabb_toggle_1").is(":checked") == true ){
				$("#fl-field-year_plural_label").show();
				$("#fl-field-year_singular_label").show();
			}
			if( $("#month_custom_label_uabb_toggle_1").is(":checked") == true ){
				$("#fl-field-month_plural_label").show();
				$("#fl-field-month_singular_label").show();
			}

			if ( timer_type == "evergreen" ) {
				if( evergreen_timer_action == 'msg' ) {
					$("#fl-field-redirect_link").hide();
					$("#fl-field-redirect_link_target").hide();
					$("#fl-field-expire_message").show();
					$("#fl-builder-settings-section-message").show();
				} else if( evergreen_timer_action == 'redirect' ) {
					$("#fl-field-redirect_link").show();
					$("#fl-field-redirect_link_target").show();
					$("#fl-field-expire_message").hide();
					$("#fl-builder-settings-section-message").hide();
				} else {
					$("#fl-field-redirect_link").hide();
					$("#fl-field-redirect_link_target").hide();
					$("#fl-field-expire_message").hide();
					$("#fl-builder-settings-section-message").hide();
				}
			} else {
				if( fixed_timer_action == 'msg' ) {
					$("#fl-field-redirect_link").hide();
					$("#fl-field-redirect_link_target").hide();
					$("#fl-field-expire_message").show();
					$("#fl-builder-settings-section-message").show();
				} else if( fixed_timer_action == 'redirect' ) {
					$("#fl-field-redirect_link").show();
					$("#fl-field-redirect_link_target").show();
					$("#fl-field-expire_message").hide();
					$("#fl-builder-settings-section-message").hide();
				} else {
					$("#fl-field-redirect_link").hide();
					$("#fl-field-redirect_link_target").hide();
					$("#fl-field-expire_message").hide();
					$("#fl-builder-settings-section-message").hide();
				}
			}
		},
		hide_margin_fields:function()
		{
			
			var form		= $('.fl-builder-settings'),
			    unit_position = form.find('select[name=unit_position]').val(),
			    timer_style = form.find('select[name=timer_style]').val(),
			    inside_options = form.find('select[name=inside_options]').val(),
			    outside_options = form.find('select[name=outside_options]').val(),
			    normal_options = form.find('select[name=normal_options]').val();
			    
			
			if ( unit_position == "inside" && ( inside_options == "in_below" || inside_options == "in_above" ) ) {
				$("#fl-field-normal_options").hide();
				$("#fl-field-inside_options").show();
				
			}

			if ( unit_position == "outside" && ( outside_options == "out_below" || outside_options == "out_above" || outside_options == "out_right" || outside_options == "out_left" )  ) {
				$("#fl-field-normal_options").hide();
				$("#fl-field-outside_options").show();
			}


			if ( timer_style == "normal" && normal_options == "normal_below" ) {
				$("#fl-field-inside_options").hide();
				$("#fl-field-outside_options").hide();
				$("#fl-field-normal_options").show();
			}
			if ( timer_style == "normal" && normal_options == "normal_above" ) {
				$("#fl-field-inside_options").hide();
				$("#fl-field-outside_options").hide();
				$("#fl-field-normal_options").show();
			}

		}
	});
})(jQuery);