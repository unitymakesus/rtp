<?php
/**
 *  User Interface Field Draggable file
 *
 *  @package UI Field draggable
 */

?>
<#
var field   = data.field,
	name    = data.name,
	value   = data.value,
	val = ( 'undefined' != typeof value && '' != value ) ? value : '0,0',
	coord = val.split( ',' ),
	top = coord[1],
	left = coord[0];
#>

<div class='uabb-hotspot-draggable-wrap fl-field' data-type='text' data-preview="{{field.preview}}">
	<div class='uabb-hotspot-draggable'></div>
	<div class='uabb-hotspot-draggable-point' style='top:{{top}}%;left:{{left}}%;'></div>
</div>
<input type='hidden' value="{{val}}" name="{{name}}" />
