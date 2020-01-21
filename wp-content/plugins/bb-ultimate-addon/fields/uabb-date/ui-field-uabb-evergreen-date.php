<?php
/**
 *  User Interface Evergreen Date file
 *
 *  @package UI Field Evergreen Date
 */

?>
<#
var field   = data.field,
	name    = data.name,
	settings = data.settings,
	preview = data.preview,
	selected = '',
	sel = '',
	yr = parseInt( '<?php echo date( 'Y' ); ?>' );
#>

<div class="fl-field uabb-evergreen-wrap" data-type="select" data-preview="{{preview}}"><div class="uabb-countdown-custom-fields">
	<select class="text text-full" name="{{name}}_days" >
	<option value="0"><?php _e( 'Days', 'uabb' ); ?></option>
	<#
	for ( var i=0; i <= 31; i++ ) {
		if ( '' != settings.evergreen_date_days ) {
			if ( i == settings.evergreen_date_days ) {
				selected = "selected";
			} else {
				selected = "";
			}
		} else if( i == 30 ) {
			selected = "selected";
		}
		if( i <= 9 ) {
		#>
		<option value="{{i}}" {{selected}}>0{{i}}</option>
		<#
		} else {
		#>
		<option value="{{i}}" {{selected}}>{{i}}</option>
		<#
		}
	}
	#>
	</select>
	</br>
	<label><?php _e( 'Days', 'uabb' ); ?></label>
</div>

<div class="uabb-countdown-custom-fields">
	<select class="text text-full" name="{{name}}_hour" >
	<option value="0"><?php _e( 'Hours', 'uabb' ); ?></option>
	<#
	for ( i = 0; i < 24; i++ ) {
		if ( '' != settings.evergreen_date_hour ) {
			if ( i == settings.evergreen_date_hour ) {
				selected = "selected";
			} else {
				selected = "";
			}
		} else if( i == 23 ) {
			selected = "selected";
		}
		if( i <= 9 ) {
		#>
		<option value="{{i}}" {{selected}}>0{{i}}</option>
		<#
		} else {
		#>
		<option value="{{i}}" {{selected}}>{{i}}</option>
		<#
		}
	}
	#>
	</select>
	</br>
	<label><?php _e( 'Hours', 'uabb' ); ?></label>
</div>

<div class="uabb-countdown-custom-fields">
	<select class="text text-full" name="{{name}}_minutes" >
	<option value="0"><?php _e( 'Minutes', 'uabb' ); ?></option>
	<#
	for ( i = 0; i < 60; i++ ) {
		if ( '' != settings.evergreen_date_minutes ) {
			if ( i == settings.evergreen_date_minutes ) {
				selected = "selected";
			} else {
				selected = "";
			}
		} else if( i == 59 ) {
			selected = "selected";
	}

		if( i <= 9 ) {
		#>
		<option value="{{i}}" {{selected}}>0{{i}}</option>
		<#
		} else {
		#>
		<option value="{{i}}" {{selected}}>{{i}}</option>
		<#
		}
	}
	#>
	</select>
	</br>
	<label><?php _e( 'Minutes', 'uabb' ); ?></label>
</div>

<div class="uabb-countdown-custom-fields">
	<select class="text text-full" name="{{name}}_seconds" >
	<option value="0"><?php _e( 'Seconds', 'uabb' ); ?></option>
	<#
	for ( i = 0; i < 60; i++ ) {
		if ( '' != settings.evergreen_date_seconds ) {
			if ( i == settings.evergreen_date_seconds ) {
				selected = "selected";
			} else {
				selected = "";
			}
		} else if ( i == 59 ) {
			selected = "selected";
		}
		if( i <= 9 ) {
		#>
		<option value="{{i}}" {{selected}}>0{{i}}</option>
		<#
		} else {
		#>
		<option value="{{i}}" {{selected}}>{{i}}</option>
		<#
		}
	}
	#>
	</select>
	</br>
	<label><?php _e( 'Seconds', 'uabb' ); ?></label>
</div>
