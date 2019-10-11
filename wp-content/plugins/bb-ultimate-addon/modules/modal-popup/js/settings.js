(function($){
	FLBuilder.registerModuleHelper('modal-popup', {
		_templates: {
            saved_modules: '',
            saved_rows: '',
            page_templates: '',
        },
		init: function()
		{	
			var form    		= $('.fl-builder-settings'),
				node_id     	= form.attr('data-node'),
				preview_modal 	= form.find('select[name=preview_modal]'),
				modal_effect 	= form.find('select[name=modal_effect]'),
				modal_effect_style 	= form.find('select[name=modal_effect]').val(),
				form_button  	= form.find('.fl-builder-button'); 
				content_type	= form.find('select[name=content_type]');

			UABBButton.init();
				
			form.attr('data-modaleffect', modal_effect_style );
			
			this._showModalPreview();
			this._toggleTypography();
			this._hideDocs();
			this._contentTypeChange();
			$( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', $.proxy( this._showModalPreview, this ) );

			// Validation events
			preview_modal.on('change', $.proxy( this._showModalPreview, this ) );
			modal_effect.on('change', $.proxy( this._showModalPreview, this ) );
			form_button.on('click', $.proxy( this._closeModal, this ) );
			content_type.on('change', $.proxy( this._toggleTypography, this ) );
			content_type.on('change',this._videoPlaceholder);
			content_type.on('change', $.proxy( this._contentTypeChange, this ) );
			$(this._videoPlaceholder,this);
		},
		
		_toggleTypography: function() {
			var form			= $('.fl-builder-settings'),
				content_type     	= form.find('select[name=content_type]').val();

			if( content_type == 'content' ) {
				form.find('#fl-builder-settings-section-ct_content_typo').show();
			} else {
				form.find('#fl-builder-settings-section-ct_content_typo').hide();
			}
		},
		
		_showModalPreview: function() {
			var form			= $('.fl-builder-settings'),
				node_id     	= form.attr('data-node'),
				preview_modal 	= form.find('select[name=preview_modal]').val(),
				old_modal_effect_style 	= form.attr('data-modaleffect'),
				modal_effect_style 	= form.find('select[name=modal_effect]').val(),
				modal_node 		= $('#modal-'+node_id );

				// console.log( old_modal_effect_style );
				// console.log( modal_effect_style );
				
			if ( preview_modal == 1 ) {
				
				modal_node.removeClass('uabb-drag-fix');

				if ( modal_node.hasClass('uabb-show') ) {
					if( old_modal_effect_style != modal_effect_style ){ 
						modal_node.removeClass('uabb-show');
						modal_node.removeClass( old_modal_effect_style );
						modal_node.addClass( modal_effect_style );

						setTimeout(function(){
							modal_node.addClass('uabb-show');
						}, 500);

						form.attr('data-modaleffect', modal_effect_style );
					}
				}else{
					modal_node.addClass('uabb-show');

					var active_popup = $('.uamodal-' + node_id );
					if ( active_popup.find( '.uabb-content' ).outerHeight() > $(window).height() ) {
						$('html').addClass('uabb-html-modal');
						active_popup.find('.uabb-modal').addClass('uabb-modal-scroll');
					} else {
						$('html').removeClass('uabb-html-modal');
						active_popup.find('.uabb-modal').removeClass('uabb-modal-scroll');
					}
				}
			}else{
				modal_node.removeClass('uabb-show');
				modal_node.addClass('uabb-drag-fix');
			}
		},
		_closeModal: function() {
			var form		= $('.fl-builder-settings'),
				node_id     = form.attr('data-node');

			if ( $('#modal-'+ node_id ).hasClass('uabb-show') ) {
				$('#modal-'+ node_id ).removeClass('uabb-show');
				$('#modal-'+ node_id ).addClass('uabb-drag-fix');
			}
		},
		_videoPlaceholder: function(){
			var form			= $('.fl-builder-settings');
				content_type	= form.find('select[name=content_type]').val();
				placeholder 	= form.find('input[name=video_url]');
				if(content_type=='youtube'){
					placeholder.removeAttr("placeholder").attr('placeholder','https://www.youtube.com/watch?v=HJRzUQMhJMQ');
				} else if(content_type=='vimeo'){
					placeholder.removeAttr("placeholder").attr('placeholder','https://vimeo.com/274860274');
				}
		},
		/**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.14.0
        */
        _hideDocs: function() {
            var form            = $('.fl-builder-settings'),
            branding_selector   = form.find('#fl-field-uabb_helpful_information .uabb-docs-list');
            settings_tab        = form.find('.fl-builder-settings-tabs');
            get_anchor          =  settings_tab.find('a');

            $( get_anchor ).each(function() {

                if ( '#fl-builder-settings-tab-uabb_docs' === $(this) .attr('href') ) {

                    if ( 'yes' === branding_selector.data('branding') ) {
                        $( this ).hide();
                    } else {
                        $( this ).show();
                    }
                }
            });
        },
        _contentTypeChange: function()
        {

            var form            = $('.fl-builder-settings');

            var type = form.find('select[name=content_type]').val();

            if ( 'saved_modules' === type ) {
                this._setTemplates('saved_modules');
            }
            if ( 'saved_rows' === type ) {
                this._setTemplates('saved_rows');
            }
            if ( 'saved_page_templates' === type ) {
                this._setTemplates('page_templates');
            }
        },
        _getTemplates: function(type, callback)
        {
            if ( 'undefined' === typeof type ) {
                return;
            }

            if ( 'undefined' === typeof callback ) {
                return;
            }
            if ( 'saved_modules' === type ) {
                type = 'module';
            } else if ( 'saved_rows' === type ) {
                type = 'row';
            } else if ( 'page_templates' === type ) {
                type = 'layout';
            }
            var self = this;

            $.post(
                ajaxurl,
                {
                    action: 'uabb_get_saved_templates',
                    type: type
                },
                function( response ) {
                    callback(response);
                }
            );
        },
        _setTemplates: function(type)
        {
            var form = $('.fl-builder-settings'),       
                select = form.find( 'select[name="ct_' + type + '"]' ),
                value = '', self = this;
                
            if ( 'undefined' !== typeof FLBuilderSettingsForms && 'undefined' !== typeof FLBuilderSettingsForms.config ) {
                if ( "modal-popup" === FLBuilderSettingsForms.config.id ) {
                    value = FLBuilderSettingsForms.config.settings['ct_' + type];
                }
            }
            if ( this._templates[type] !== '' ) {
                select.html( this._templates[type] );
                select.find( 'option[value="' + value + '"]').attr('selected', 'selected');

                return;
            }

            this._getTemplates(type, function(data) {
                var response = JSON.parse( data );

                if ( response.success ) {
                    self._templates[type] = response.data;
                    select.html( response.data );
                    if ( '' !== value ) {
                        select.find( 'option[value="' + value + '"]').attr('selected', 'selected');
                    }
                }
            });
        },
	});
})(jQuery);