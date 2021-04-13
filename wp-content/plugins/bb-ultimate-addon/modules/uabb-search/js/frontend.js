(function($) {

	UABBSearchModule = function(settings) {
		this.settings   = settings;
		this.nodeClass  = '.fl-node-' + settings.id;
		this.searchForm = $(this.nodeClass + ' .uabb-search-form');
		this.form       = this.searchForm.find('form');
		this.input      = this.form.find('input[type=search]');
		this.button     = this.searchForm.find('a.uabb-button');
		this.resultsEl  = $(this.nodeClass + ' .uabb-search-results-content');
		this.overlay    = this.searchForm.find( '.uabb-search-overlay' );

		this._init();
	};

	UABBSearchModule.prototype = {

		settings: {},
		nodeClass: '',
		searchForm: '',
		form: null,
		input: null,
		button: null,
		resultsEl: '',
		searching: false,
		prevSearchData: {},
		request: null,

		_init: function() {
			this._bindEvents();
			this._popupSearch();
		},

		_bindEvents: function(){
			var $this        = this,
				keyCode      = null,
				keyType      = null,
			    enterPressed = false,
				t, et;

			this.button.on('click', $.proxy(this._buttonClick, this));

			if ( 'yes' == this.settings.enable_ajax ) {
				$(document).on('click touchend', function(e){
					if( $(e.target).is('input') ) return;

					$this._hideResults();
				} );

				$this.resultsEl.bind("click touchend", function (e) {
	                e.stopImmediatePropagation();
	            });

				// Disable form submit.
				$this.form.on( 'submit', function (e) {
                    e.preventDefault();
	            });

				this.input.on('keyup', function(e) {
                    if (window.event) {
						keyCode = window.event.keyCode;
                        keyType = window.event.type;
                    } else if (e) {
						keyCode = e.which;
                        keyType = e.type;
                    }

					// Prevent rapid enter
	                if ( 13 == keyCode ) {
	                    clearTimeout(et);
	                    et = setTimeout(function(){
	                        enterPressed = false;
	                    }, 300);
	                    if ( enterPressed ) {
					        return false;
	                    } else {
	                        enterPressed = true;
	                    }
	                }

					if ( $this.input.val().length >= 3 && 'keyup' == keyType && 13 == keyCode ) {
						$this._search(e);
						return false;
					}
                });

				this.input.on('click input', function(e) {
					if (window.event) {
						keyCode = window.event.keyCode;
                        keyType = window.event.type;
                    } else if (e) {
                        keyCode = e.which;
                        keyType = e.type;
                    }

					// F1 to F12
					if ( (keyCode >= 37 && keyCode <= 40) || (keyCode >= 112 && keyCode <= 123) ) {
						return;
					}

					if ($this.input.val().length < 3) {
	                    $this._hideLoader();
	                    $this._hideResults();
	                    if ($this.post != null) $this.post.abort();
	                    clearTimeout(t);
	                    return;
	                }

	                if ( 'click' == keyType || keyCode == 32 ) {
						if ( $this.resultsEl.html().length != 0 ) {
							clearTimeout(t);
							if( $this.resultsEl.hasClass('uabb-search-open') ) return;
							$this._showResults();
						}
						else {
							$this._hideResults();
						}
						return;
	                }

	                if ($this.request != null) $this.request.abort();
	                $this._hideLoader();

					clearTimeout(t);
					t = setTimeout(function() {
						$this._search(e);
					}, 100);
				});
			}
		},

		_search: function(e) {
			e.preventDefault();

			if ($.trim(this.input.val()).length < 1) {
				return;
			}

			if ( 'yes' == this.settings.enable_ajax ) {
				this._doAjaxSearch();
			}
			else {
				this.form.submit();
			}

			return false;
		},

		_doAjaxSearch: function() {
			var searchText     = this.input.val(),
				postId         = this.searchForm.closest( '.fl-builder-content' ).data( 'post-id' ),
				templateId     = this.searchForm.data( 'template-id' ),
				templateNodeId = this.searchForm.data( 'template-node-id' ),
				_nonce         = $(this.nodeClass).find( '.uabb-search-form-input-wrap form' ).data('nonce'),
				ajaxData       = {},
				self           = this;

			if ( this.searching && 0 ) return;
            if ( searchText.length < 1 ) return;

			this.searching = true;

			// Show loader
			this._showLoader();

			ajaxData = {
				action           : 'uabb_search_query',
				keyword          : searchText,
				post_id          : postId,
				template_id      : templateId,
				template_node_id : templateNodeId,
				node_id          : this.settings.id,
				security         : _nonce,
			}

			// Check to see if searching the same keywords.
			if ( JSON.stringify(ajaxData) === JSON.stringify(this.prevSearchData) ) {
				if ( ! this.resultsEl.hasClass('uabb-search-open') ) {
					this._showResults();
				}
                this._hideLoader();
                return false;
            }

			// Send server request.
			this.request = $.post( FLBuilderLayoutConfig.paths.wpAjaxUrl, ajaxData, function(response){
				self._hideLoader();

				self.resultsEl.html("");
				self.resultsEl.html(response);
				self._showResults();

				self.prevSearchData = ajaxData;
			});
		},

		_popupSearch: function() {
			var inputWrap = this.searchForm.find('.uabb-search-form-input-wrap'),
				$this     = this;

			if ('button' != this.settings.display || 'fullscreen' != this.settings.btnAction) {
				return;
			}

			$( this.searchForm ).find('.uabb-search-close').click( function(){
				$this.searchForm.removeClass('search-active');
			});

			$(document).on('keyup.uabb-search-form-input-wrap form',function(e) {
				if (e.keyCode == 27) { 
					$this.searchForm.removeClass('search-active');
				}
			});

			this.overlay.on( 'click', function( ev ) {
				$this.searchForm.removeClass('search-active');
			} );

			this.resultsEl.appendTo( inputWrap );
		},

		_buttonClick: function(e) {
			e.stopImmediatePropagation();
			if (this.searchForm.hasClass('uabb-search-button-expand')) {
				this.searchForm.find('.uabb-search-form-wrap').toggleClass('uabb-search-expanded');

				if (this.searchForm.find('.uabb-search-form-wrap').hasClass('uabb-search-expanded')) {
					this.input.focus();
				}
				else {
					this._hideResults();
				}

				return false;
			} else {
				this._search(e);
			}
			if ('button' == this.settings.display && 'fullscreen' == this.settings.btnAction) {
				this.searchForm.addClass('search-active');
				this.searchForm.find('.uabb-search-text').focus();
			}
		},

		_showResults: function(){
			// Close any search results in a page.
			this._hideResults();
			this.resultsEl.addClass('uabb-search-open');

			if ('button' == this.settings.display && 'expand' == this.settings.btnAction) {
				this.searchForm.find('.uabb-search-form-input-wrap').css('overflow', 'visible');
			}
		},

		_hideResults: function(){
			$('.uabb-search-results-content').removeClass('uabb-search-open');

			if ('button' == this.settings.display && 'expand' == this.settings.btnAction) {
				this.searchForm.find('.uabb-search-form-input-wrap').removeAttr('style');
			}
		},

		_showLoader: function(){
			$(this.nodeClass + ' .uabb-search-loader-wrap').show();
		},

		_hideLoader: function(){
			this.searching = false;
			$(this.nodeClass + ' .uabb-search-loader-wrap').hide();
		},

		_cleanInput: function(s) {
	        return encodeURIComponent(s).replace(/\%20/g, '+');
	    }

	}

})(jQuery);
