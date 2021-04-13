(function($){

	FLBuilder.registerModuleHelper('cbb-figure-card', {

		init: function()
		{
			var form    		= $('.fl-builder-settings'),
        structure     = form.find('select[name=structure]'),
        enable_cta    = form.find('select[name=enable_cta]');

      // Init options
      this._structureToggle();
      this._ctaToggle();

			// // Option toggles
      structure.on('change', this._structureToggle);
			enable_cta.on('change', this._ctaToggle);
		},

    _structureToggle: function() {
      var form = $('.fl-builder-settings'),
          structure = form.find('select[name=structure]').val();

      if (structure == 'default') {
        form.find('#fl-field-image').hide();
        form.find('#fl-field-image_alt').hide();
				form.find('#fl-field-image_align').hide();
      } else {
				form.find('#fl-field-image').show();
        form.find('#fl-field-image_alt').show();

				if (structure == 'horizontal') {
					form.find('#fl-field-image_align').show();
				} else {
					form.find('#fl-field-image_align').hide();
				}
      }
    },

    _ctaToggle: function() {
      var form = $('.fl-builder-settings'),
          enable_cta = form.find('select[name=enable_cta]').val();

      if (enable_cta == 'block') {
        form.find('#fl-field-cta_text').show();
        form.find('#fl-field-cta_link').show();
      } else {
        form.find('#fl-field-cta_text').hide();
        form.find('#fl-field-cta_link').hide();
      }
    },

	});

})(jQuery);
