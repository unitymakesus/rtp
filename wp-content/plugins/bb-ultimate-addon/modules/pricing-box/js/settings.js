(function($){

	FLBuilder.registerModuleHelper('pricing_table_column_form', {

        init: function()
		{
			UABBButton.init();

			var form	= $('.fl-builder-settings');
			is_featured = form.find('select[name=set_featured]');
			is_ribbon = form.find('select[name=ribbon_style]');
			this.typo_toggle();
			is_featured.on('change',this.typo_toggle );
			is_ribbon.on('change',this.typo_toggle );
		},
		typo_toggle: function()
		{
			var form = $( '.fl-builder-settings' );
			is_featured = form.find('select[name=set_featured]');
			is_ribbon = form.find('select[name=ribbon_style]');

			if ( 'yes' === is_featured.val() ) {
				form.find('#fl-builder-settings-section-featured_text_typography').show();
			} else {
				form.find('#fl-builder-settings-section-featured_text_typography').hide();
			}

			if ( 'none' === is_ribbon.val() ) {
				form.find('#fl-builder-settings-section-ribbon_typography').hide();
			} else {
				form.find('#fl-builder-settings-section-ribbon_typography').show();
			}
		},
    });
})(jQuery);