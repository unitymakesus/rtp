<?php
/**
 *  User Interface File type file
 *
 *  @package UI Field File
 */

?>
<#

var file = null;

if ( FLBuilderSettingsConfig.attachments[ data.value ] ) {
	file = FLBuilderSettingsConfig.attachments[ data.value ];
} else if ( ! _.isEmpty( data.value ) ) {
	file = {
		id: data.value,
		url: data.value,
		filename: data.value
	};
}

var className = data.field.className ? ' ' + data.field.className : '';

if ( ! data.value || ! file ) {
	className += ' fl-file-empty';
}

#>
<div class="fl-file-field fl-builder-custom-field{{className}}">
	<a class="fl-file-select" href="javascript:void(0);" onclick="return false;"><?php esc_attr_e( 'Select File', 'uabb' ); ?></a>
	<div class="fl-file-preview">
		<# if ( data.value && file ) { #>
		<div class="fl-file-preview-img">
		</div>
		<span class="fl-file-preview-filename">{{{file.filename}}}</span>
		<# } else { #>
		<div class="fl-file-preview-img">
		</div>
		<span class="fl-file-preview-filename"></span>
		<# } #>
		<br />
		<a class="fl-file-replace" href="javascript:void(0);" onclick="return false;"><?php esc_attr_e( 'Replace File', 'uabb' ); ?></a>
		<# if ( data.field.show_remove ) { #>
		<a class="fl-file-remove" href="javascript:void(0);" onclick="return false;"><?php esc_attr_e( 'Remove File', 'uabb' ); ?></a>
		<# } #>
		<div class="fl-clear"></div>
	</div>
	<input name="{{data.name}}" type="hidden" value='{{{data.value}}}' />
</div>
