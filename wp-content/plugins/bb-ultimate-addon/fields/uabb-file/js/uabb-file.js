(function($){

	UABB_File = {

		_singleFileSelector : null,

		_init: function()
		{
			UABB_File._bindEvents();
		},

		_bindEvents: function()
		{
			/* File Fields */
			$('body').delegate('.fl-file-field .fl-file-select', 'click', UABB_File._selectSingleFile);
			$('body').delegate('.fl-file-field .fl-file-replace', 'click', UABB_File._selectSingleFile);
			$('body').delegate('.fl-file-field .fl-file-remove', 'click', UABB_File._singleFileRemoved);
		},

		_selectSingleFile: function()
		{
			UABB_File._initSingleFileSelector();
			UABB_File._singleFileSelector.once('select', $.proxy(UABB_File._singleFileSelected, this));
			UABB_File._singleFileSelector.open();
		},

		_initSingleFileSelector: function()
		{
			if(UABB_File._singleFileSelector === null) {

				UABB_File._singleFileSelector = wp.media({
					title: 'Select File',
					button: { text: 'Select File' },
					library : { type: 'text/csv' },
					multiple: false
				});

				UABB_File._singleFileSelector.on( 'open', UABB_File._wpmedia_reset_errors );
				_wpPluploadSettings['defaults']['multipart_params']['uabb_upload_type']= 'uabb-file';
			}
		},

		_wpmedia_reset_errors: function() {
			$('.upload-error').remove();
			$('.media-uploader-status' ).removeClass( 'errors' ).hide();
		},

		_singleFileSelected: function()
		{
			var file      = UABB_File._singleFileSelector.state().get('selection').first().toJSON(),
				wrap       = $(this).closest('.fl-file-field'),
				filename   = wrap.find('.fl-file-preview-filename'),
				fileField = wrap.find('input[type=hidden]');

			filename.html(file.filename);
			wrap.removeClass('fl-file-empty');
			wrap.find('label.error').remove();
			fileField.val(file.id).trigger('change');
			FLBuilderSettingsConfig.attachments[ file.id ] = file;
		},

		_singleFileRemoved: function()
		{
			UABB_File._initSingleFileSelector();
			var state       = UABB_File._singleFileSelector.state(),
				selection   = 'undefined' != typeof state ? state.get('selection') : null,
				wrap        = $(this).closest('.fl-file-field'),
				filename   	= wrap.find('.fl-file-preview-filename'),
				fileField   = wrap.find('input[type=hidden]');

			if ( selection ) {
				selection.reset();
			}

			filename.html('');
			wrap.addClass('fl-file-empty');
			fileField.val('').trigger('change');
		},
	},

	/* Start the party!!! */
	$(function(){
		UABB_File._init();
	});

})(jQuery);