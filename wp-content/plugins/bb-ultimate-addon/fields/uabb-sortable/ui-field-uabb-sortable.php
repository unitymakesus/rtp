<?php
/**
 *  User Interface Field Sortable
 *
 *  @package UI Field Sortable
 */

?>
<# 
var field   = data.field,
	name    = data.name,
	value   = data.value,
	custom_class = ( typeof field.class != 'undefined' && field.class != '' ) ? field.class : '',
	default_val = ( typeof field.default != 'undefined' && field.default != '' ) ? field.default : '',
	assign_val = ( value != '' ) ? value : default_val,
	old_val = assign_val.split( "," ),
	msg_content = '',
	opts = [];

if( typeof field.options != 'undefined' && field.options != '' ) {
#>
<div class="uabb-sortable-wrap fl-field" data-type="text" data-preview="{{field.preview}}">
	<ul class="uabb-sortable {{custom_class}}">
		<#
		var options = field.options;
		for ( var i in old_val ) {
			var ind = old_val[i]
			if( '' != options[ind] ) {
			#>
				<li class="{{old_val[i]}}"><span>{{options[ind]}}</span></li>
			<#
			} else {
				opts.push( old_val[i] );
			}
		}
		for ( var key in opts ) {
		#>
			<li class="{{key}}"><span>{{options[key]}}</span></li>
		<#
		}
		#>
	</ul>
	<input type="hidden" value="{{assign_val}}" name="{{name}}"/></div>
<#
}
#>
