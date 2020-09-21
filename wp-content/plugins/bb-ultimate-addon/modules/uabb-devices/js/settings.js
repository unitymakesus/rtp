(function($) {
	FLBuilder.registerModuleHelper(
		'uabb-devices',
		{
			init: function() {
				var form = $( '.fl-builder-settings' );
				var self = this;

				self._toggleDeviceType();
				form.find( '#fl-field-device_type select[name=device_type]' ).on(
					'change',
					function() {
						self._toggleDeviceType();
					}
				);

				self._toggleVideoType();
				form.find( '#fl-field-video_type select[name=video_type] :selected' ).on(
					'change',
					function() {
						self._toggleVideoType();
					}
				);

				self._toggleScrollable();
				form.find( '#fl-field-scroll_on_hover select[name=scroll_on_hover]' ).on(
					'change',
					function () {
						self._toggleScrollable();
					}
				);

				self._toggleMediaType();
				form.find( '#fl-field-media_type select[name=media_type]' ).on(
					'change',
					function () {
						self._toggleMediaType();
					}
				);

				form.find( '#fl-field-video_src select[name=video_src]' ).on(
					'change',
					function () {
						self._toggleVideoSrc();
					}
				);

			},
			_toggleDeviceType: function () {
				var form       = $( '.fl-builder-settings' );
				var device_type = form.find( '#fl-field-device_type select[name=device_type]' ).val();
				if ( 'phone' === device_type || 'tablet' === device_type ) {
					var orientation  = form.find( '#fl-field-orientation_control select[name=orientation_control] :selected' ).val();
					if ( 'show' === orientation ) {
						$( '#fl-field-orientation_control_color' ).show();
						$( '#fl-field-orientation_hover_color' ).show();
						$( '#fl-field-orientation_control_size' ).show();
					}
				} else if ( 'laptop' === device_type || 'desktop' === device_type || 'window' === device_type ) {
					$( '#fl-field-orientation_control_color' ).hide();
					$( '#fl-field-orientation_hover_color' ).hide();
					$( '#fl-field-orientation_control_size' ).hide();
				}
				if ( 'phone' === device_type || 'tablet' === device_type || 'desktop' === device_type ) {
					var device_control  = form.find( '#fl-field-device_control select[name=device_control] :selected' ).val();
					if ( 'show' === device_control ) {
						$( '#fl-field-device_control_color' ).show();
						$( '#fl-field-device_control_hover_color' ).show();
						$( '#fl-field-device_control_active_color' ).show();
						$( '#fl-field-device_control_size' ).show();
					}
				} else if ( 'laptop' === device_type || 'window' === device_type ) {
					$( '#fl-field-device_control_color' ).hide();
						$( '#fl-field-device_control_hover_color' ).hide();
						$( '#fl-field-device_control_active_color' ).hide();
						$( '#fl-field-device_control_size' ).hide();
				}
			},
			_toggleVideoType: function () {
				$( 'tr[id^=fl-field-mp4_]' ).hide();
				$( 'tr[id^=fl-field-m4v_]' ).hide();
				$( 'tr[id^=fl-field-ogg_]' ).hide();
				$( 'tr[id^=fl-field-webm_]' ).hide();
				var form       = $( '.fl-builder-settings' );
				var video_type = form.find( '#fl-field-video_type select[name=video_type] :selected' ).val();
				var video_src  = form.find( '#fl-field-video_src select[name=video_src] :selected' ).val();

				if ( 'self_hosted' === video_src ){
					if ('' === video_type || 'mp4' === video_type) {
						$( 'tr[id^=fl-field-mp4_video_source]' ).show();
						var video_source = form.find( '#fl-field-mp4_video_source select[name=mp4_video_source] :selected' ).val();
						if ( 'file' === video_source ) {
							$( 'tr[id^=fl-field-mp4_video]' ).show();
							$( 'tr[id^=fl-field-mp4_video_url]' ).hide();
						} else {
							$( 'tr[id^=fl-field-mp4_video]' ).hide();
							$( 'tr[id^=fl-field-mp4_video_url]' ).show();
						}
					} else if ('m4v' === video_type) {
						$( 'tr[id^=fl-field-m4v_video_source]' ).show();
						var video_source = form.find( '#fl-field-m4v_video_source select[name=m4v_video_source] :selected' ).val();
						if ( 'file' === video_source ) {
							$( 'tr[id^=fl-field-m4v_video]' ).show();
							$( 'tr[id^=fl-field-m4v_video_url]' ).hide();
						} else {
							$( 'tr[id^=fl-field-m4v_video]' ).hide();
							$( 'tr[id^=fl-field-m4v_video_url]' ).show();
						}
					} else if ('ogg' === video_type) {
						$( 'tr[id^=fl-field-ogg_video_source]' ).show();
						var video_source = form.find( '#fl-field-ogg_video_source select[name=ogg_video_source] :selected' ).val();
						if ( 'file' === video_source ) {
							$( 'tr[id^=fl-field-ogg_video]' ).show();
							$( 'tr[id^=fl-field-ogg_video_url]' ).hide();
						} else {
							$( 'tr[id^=fl-field-ogg_video]' ).hide();
							$( 'tr[id^=fl-field-ogg_video_url]' ).show();
						}
					} else if ('webm' === video_type) {
						$( 'tr[id^=fl-field-webm_video_source]' ).show();
						var video_source = form.find( '#fl-field-webm_video_source select[name=webm_video_source] :selected' ).val();
						if ( 'file' === video_source ) {
							$( 'tr[id^=fl-field-webm_video]' ).show();
							$( 'tr[id^=fl-field-webm_video_url]' ).hide();
						} else {
							$( 'tr[id^=fl-field-webm_video]' ).hide();
							$( 'tr[id^=fl-field-webm_video_url]' ).show();
						}
					}
				}
			},
			_toggleVideoSrc: function() {
				this._toggleVideoType();
			},
			_toggleMediaType: function() {
				var form       = $( '.fl-builder-settings' );
				var media_type = form.find( '#fl-field-media_type select[name=media_type]' ).val();
				var video_src  = form.find( '#fl-field-video_src select[name=video_src] :selected' ).val();
				var enable_arrows = form.find( '#fl-field-enable_arrows select[name=enable_arrows]' ).val();

				if ( 'image' === media_type ) {
					$( '#fl-builder-settings-section-video, #fl-builder-settings-section-embed_video,#fl-builder-settings-section-behaviour' ).hide();
					$( '#fl-builder-settings-section-display, #fl-builder-settings-section-volume,#fl-builder-settings-section-video_overlay' ).hide();
					$( '#fl-builder-settings-section-video_interface, #fl-builder-settings-section-video_buttons' ).hide();
					$( '#fl-builder-settings-section-arrow_section,#fl-field-enable_arrows' ).hide();
				} else if ('video' === media_type) {
					$( '#fl-builder-settings-section-arrow_section,#fl-field-enable_arrows' ).hide();
					form.find( '#fl-field-video_src select[name=video_src]' ).trigger( 'change' );
					if ( 'self_hosted' === video_src ) {
						$( '#fl-builder-settings-section-display, #fl-builder-settings-section-volume,#fl-builder-settings-section-video_overlay' ).show();
					}
					$( '#fl-builder-settings-section-video_overlay' ).show();
				} else if ( 'iframe' === media_type ){
					$( '#fl-builder-settings-section-arrow_section,#fl-field-enable_arrows' ).hide();
				} else if ( 'slider' === media_type ){
					$( '#fl-field-enable_arrows' ).show();
					if( 'yes' === enable_arrows ){
						$( '#fl-builder-settings-section-arrow_section' ).show();
					} else{
						$( '#fl-builder-settings-section-arrow_section' ).hide();
					}
				}
			},
			_toggleScrollable: function() {
				var form       = $( '.fl-builder-settings' );
				var scrollable = form.find( '#fl-field-scroll_on_hover select[name=scroll_on_hover] :selected' ).val();
				if ( 'yes' === scrollable ) {
					$( '#fl-field-vertical_alignment' ).hide();
					$( '#fl-field-top_offset' ).hide();
				} else if ( 'no' === scrollable ){
					var vertical_alignment = form.find( '#fl-field-vertical_alignment select[name=vertical_alignment] :selected' ).val();
					if ('custom' === vertical_alignment ) {
						$( '#fl-field-top_offset' ).show();
					}
				}
			}
		}
	);
})( jQuery );
