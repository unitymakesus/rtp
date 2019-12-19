jQuery(document).on( 'change', '.dual-color-spacing-option', function(){
	if ( jQuery(this).val() === "no" ) {
		jQuery(".uabb-add-spacing").val('');
	}
});