<?php
/**
 * Intializes row's js files
 *
 * @package Row settings
 */

/**
 * Function that renders row's javascript file
 *
 * @since 1.4.6
 */
function uabb_row_render_js() {

	add_filter( 'fl_builder_render_js', 'uabb_row_dependency_js', 10, 3 );
}
/**
 * Function that renders row's javascript file
 *
 * @since 1.17.0
 */
function uabb_row_particle_render_js() {

	add_filter( 'fl_builder_render_js', 'uabb_particle_row_dependency_js', 10, 3 );
	add_filter( 'fl_builder_render_js', 'uabb_particle_row_settings_dependency_js', 10, 3 );
}
/**
 * Function that renders row's javascript file
 *
 * @since 1.17.0
 * @param string $js gets the javascript for the row.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_particle_row_settings_dependency_js( $js, $nodes, $global_settings ) {

	$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
	$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );
	$branding            = '';
	if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
		$branding = 'no';
	} else {
		$branding = 'yes';
	}
	if ( FLBuilderModel::is_builder_active() ) {
		ob_start();
		?>
		;(function($){
			$( document ).on( 'change', 'select[name=uabb_row_particles_style]', function() {
				_hideFields();
			});
			$( document ).on( 'change', 'select[name=enable_particles]', function() {
				_hideFields();
			});
			$( document ).on( 'change', 'select[name=uabb_row_particles_settings]', function() {
				_hideFields();
			});

			$( document ).on( 'init', '.fl-builder-settings', function() {
				_hideFields();
			});
			function _hideFields() { 

				var form = $('.fl-builder-settings');

				var branding = '<?php echo esc_attr( $branding ); ?>';

				if ( form.length > 0 ) {

					enable_particle = form.find( 'select[name=enable_particles]' ).val();

					if ( 'no' === enable_particle ) {

						form.find('#fl-field-uabb_particles_direction').hide();
						form.find('#fl-field-uabb_particles_custom_code').hide();
						form.find('#fl-field-uabb_row_particles_style').hide();
						form.find('#fl-field-uabb_row_particles_color').hide();
						form.find('#fl-field-uabb_row_particles_color_opacity').hide();
						form.find('#fl-field-uabb_row_particles_settings').hide();
						form.find('#fl-field-uabb_row_particles_interactive_settings').hide();
						form.find('#fl-field-uabb_row_particles_size').hide();
						form.find('#fl-field-uabb_row_particles_speed').hide();
						form.find('#fl-field-uabb_row_number_particles').hide();

					} else {
						if ( 'snow' === form.find('select[name=uabb_row_particles_style]').val() ) {
							form.find('#fl-field-uabb_row_particles_style').show();
							form.find('#fl-field-uabb_row_particles_color').show();
							form.find('#fl-field-uabb_row_particles_color_opacity').show();
							form.find('#fl-field-uabb_row_particles_settings').show();
							form.find('#fl-field-uabb_particles_direction').show();
							form.find('#fl-field-uabb_particles_custom_code').hide();
							if (  'yes' === form.find('select[name=uabb_row_particles_settings]').val() ) {
								form.find('#fl-field-uabb_row_particles_size').show();
								form.find('#fl-field-uabb_row_particles_speed').show();
								form.find('#fl-field-uabb_row_number_particles').show();
								form.find('#fl-field-uabb_row_particles_interactive_settings').show();
							} else {
								form.find('#fl-field-uabb_row_particles_size').hide();
								form.find('#fl-field-uabb_row_particles_speed').hide();
								form.find('#fl-field-uabb_row_particles_interactive_settings').hide();
								form.find('#fl-field-uabb_row_number_particles').hide();
							}
						}
						if ( 'custom' === form.find('select[name=uabb_row_particles_style]').val() ) {

							form.find('#fl-field-uabb_particles_custom_code').show();
							form.find('#fl-field-uabb_particles_direction').hide();
							form.find('#fl-field-uabb_row_particles_style').show();
							form.find('#fl-field-uabb_row_particles_color').hide();
							form.find('#fl-field-uabb_row_particles_color_opacity').hide();
							form.find('#fl-field-uabb_row_particles_settings').hide();
							form.find('#fl-field-uabb_row_particles_interactive_settings').hide();
							form.find('#fl-field-uabb_row_particles_size').hide();
							form.find('#fl-field-uabb_row_particles_speed').hide();
							form.find('#fl-field-uabb_row_number_particles').hide();
						}
						if ( 'nasa' === form.find('select[name=uabb_row_particles_style]').val() || 'default' === form.find('select[name=uabb_row_particles_style]').val() ) {
							form.find('#fl-field-uabb_row_particles_style').show();
							form.find('#fl-field-uabb_row_particles_color').show();
							form.find('#fl-field-uabb_row_particles_color_opacity').show();
							form.find('#fl-field-uabb_row_particles_settings').show();
							form.find('#fl-field-uabb_row_particles_interactive_settings').show();
							form.find('#fl-field-uabb_particles_custom_code').hide();
							form.find('#fl-field-uabb_particles_direction').hide();

							if (  'yes' === form.find('select[name=uabb_row_particles_settings]').val() ) {
								form.find('#fl-field-uabb_row_particles_size').show();
								form.find('#fl-field-uabb_row_particles_speed').show();
								form.find('#fl-field-uabb_row_number_particles').show();
								form.find('#fl-field-uabb_row_particles_interactive_settings').show();
							} else {
								form.find('#fl-field-uabb_row_particles_size').hide();
								form.find('#fl-field-uabb_row_particles_speed').hide();
								form.find('#fl-field-uabb_row_number_particles').hide();
								form.find('#fl-field-uabb_row_particles_interactive_settings').hide();
							}
						}
						if ( 'custom' === form.find('select[name=uabb_row_particles_style]').val() ) {

							style_selector = form.find( '#fl-field-uabb_row_particles_style' );

							wrapper =	style_selector.find( '.fl-field-control-wrapper' );

							if ( wrapper.find( '.fl-field-description' ).length === 0 ) {

								if ( 'no' === branding ) {

									style_selector.find( '.fl-field-control-wrapper' ).append( '<span class="fl-field-description uabb-particle-docs-list"><div class="uabb-docs-particle"> <?php esc_html_e( 'Add custom JSON for the Particles Background below. To generate a completely customized background style follow steps below -', 'uabb' ); ?> </div><div class="uabb-docs-particle"><?php echo( sprintf( /* translators: %s: custom JS link */ wp_kses_post( __( '1. Visit a link %1$s here %2$s and choose required attributes for particles', 'uabb' ) ), '<a class="uabb-docs-particle-link" href="https://vincentgarreau.com/particles.js/" target="_blank">', '</a>' ) ); ?></div><div class="uabb-docs-particle"><?php esc_html_e( '2. Once a custom style is created, download JSON from "Download current config (json)" link', 'uabb' ); ?></div><div class="uabb-docs-particle"><?php esc_html_e( '3. Copy JSON code from the above file and paste it below', 'uabb' ); ?></div><div class="uabb-docs-particle"><?php echo ( sprintf( /* translators: %s: doc link */ wp_kses_post( __( 'To know more about creating a custom style, refer to a document %1$s here. %2$s', 'uabb' ) ), '<a class="uabb-docs-particle-link" href="https://www.ultimatebeaver.com/docs/custom-particle-backgrounds/?utm_source=uabb-pro-backend&utm_medium=row-editor-screen&utm_campaign=particle-backgrounds-row" target="_blank" rel="noopener">', '</a>' ) ); ?></div></span>' );

								} else {

									style_selector.find( '.fl-field-control-wrapper' ).append( '<span class="fl-field-description uabb-particle-docs-list"><div class="uabb-docs-particle"> <?php esc_html_e( 'Add custom JSON for the Particles Background below. To generate a completely customized background style follow steps below -', 'uabb' ); ?> </div><div class="uabb-docs-particle"><?php esc_html_e( '1. Visit a link', 'uabb' ); ?> <a class="uabb-docs-particle-link" href="https://vincentgarreau.com/particles.js/" target="_blank"> <<?php esc_html_e( 'here', 'uabb' ); ?> </a> <?php esc_html_e( 'and choose required attributes for particles', 'uabb' ); ?></div><div class="uabb-docs-particle"><?php esc_html_e( '2. Once a custom style is created, download JSON from "Download current config (json)" link', 'uabb' ); ?></div><div class="uabb-docs-particle"><?php esc_html_e( '3. Copy JSON code from the above file and paste it below', 'uabb' ); ?></div></span>' );
								}

							} else {
								wrapper.find( '.fl-field-description' ).show();
							}
						} else {

							style_selector = form.find( '#fl-field-uabb_row_particles_style' );

							wrapper =	style_selector.find( '.fl-field-control-wrapper' );

							wrapper.find( '.fl-field-description' ).hide();
						}
					}
				}
			}
		})(jQuery);
		<?php
		$js .= ob_get_clean();
	}
	return $js;
}
/**
 * Function that renders row's javascript file
 *
 * @since 1.4.6
 * @param string $js gets the javascript for the row.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_row_dependency_js( $js, $nodes, $global_settings ) {

	$flag = false;

	foreach ( $nodes['rows'] as $row ) {

		if ( 'uabb_gradient' === $row->settings->bg_type ) {

			$flag = true;

			break;
		}
	}

	if ( false === $flag ) {

		return $js;
	}

	ob_start();
	?>
		;(function($){
			var form = $('.fl-builder-settings'),
				gradient_type = form.find( 'input[name=uabb_row_gradient_type]' );

			$( document ).on( 'change', 'input[name=uabb_row_radial_advance_options], input[name=uabb_row_linear_advance_options], input[name=uabb_row_gradient_type], select[name=bg_type]', function() {
				var form        = $('.fl-builder-settings'),
					background_type       = form.find( 'select[name=bg_type]' ).val(),
					linear_direction      = form.find( 'select[name=uabb_row_uabb_direction]' ).val(),
					linear_advance_option = form.find( 'input[name=uabb_row_linear_advance_options]:checked' ).val(),
					radial_advance_option = form.find( 'input[name=uabb_row_radial_advance_options]:checked' ).val(),
					gradient_type         = form.find( 'input[name=uabb_row_gradient_type]:checked' ).val();				
				if( background_type == 'uabb_gradient' ) {

					if( gradient_type == 'radial' ) {

						setTimeout( function() { 
							form.find('#fl-field-uabb_row_linear_direction').hide();
							form.find('#fl-field-uabb_row_linear_gradient_primary_loc').hide();
							form.find('#fl-field-uabb_row_linear_gradient_secondary_loc').hide();
						}, 1);

						if( radial_advance_option == 'yes' ) {
							form.find('#fl-field-uabb_row_radial_gradient_primary_loc').show();
							form.find('#fl-field-uabb_row_radial_gradient_secondary_loc').show();
						}
					}

					if( gradient_type == 'linear' ) {

						setTimeout( function() { 
							form.find('#fl-field-uabb_row_radial_gradient_primary_loc').hide();
							form.find('#fl-field-uabb_row_radial_gradient_secondary_loc').hide();
						}, 1);

						if( linear_direction == 'custom' ) {
							form.find('#fl-field-uabb_row_linear_direction').show();
						}

						if( linear_advance_option == 'yes' ) {
							form.find('#fl-field-uabb_row_linear_gradient_primary_loc').show();
							form.find('#fl-field-uabb_row_linear_gradient_secondary_loc').show();
						}
					}   
				}
			});
		})(jQuery);	

	<?php
	$js .= ob_get_clean();
	return $js;
}
/**
 * Function that renders row's javascript file
 *
 * @since 1.17.0
 * @param string $js gets the javascript for the row.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_particle_row_dependency_js( $js, $nodes, $global_settings ) {

	$flag = false;

	foreach ( $nodes['rows'] as $row ) {

		if ( 'yes' === $row->settings->enable_particles ) {

			$flag = true;

			break;
		}
	}

	if ( false === $flag ) {

		return $js;
	}

	ob_start();
	?>
	;(function($) {

				var url ='<?php echo esc_url( BB_ULTIMATE_ADDON_URL . 'assets/js/particles.js' ); ?>';
				window.particle_js_loaded = 0;

				jQuery.cachedScript = function( url, options ) {

					// Allow user to set any option except for dataType, cache, and url.
					options = jQuery.extend( options || {}, {
						dataType: "script",
						cache: true,
						url: url
					});
					// Return the jqXHR object so we can chain callbacks.
					return jQuery.ajax( options );
				};

				if (  jQuery( '.uabb-row-particles-background' ).length ) {

					jQuery.cachedScript( url ).done( function( script, textStatus ) {
						window.particle_js_loaded = 1;
						init_particles_row_background_script();

					});
				}
			function init_particles_row_background_script() {

				<?php
				foreach ( $nodes['rows'] as $row ) {

					if ( 'no' === $row->settings->enable_particles ) {

						continue;
					}

					$json_particles_custom = wp_strip_all_tags( $row->settings->uabb_particles_custom_code );
					?>
					row_id = '<?php echo esc_attr( $row->node ); ?>';

					nodeclass = '.fl-node-' + row_id;

					var nodeClass  	= jQuery( '.fl-node-' + row_id );

					particle_selector = nodeClass.find( '.uabb-row-particles-background' );

					if ( particle_selector.length > 0 ) {

						data_particles = particle_selector.data( 'particle' );
						enable_particles = data_particles.enable_particles;
						particles_style =  data_particles.particles_style;
						particles_dot_color = data_particles.particles_dot_color;
						number_particles = data_particles.number_particles;
						particles_size = data_particles.particles_size;
						particles_speed = data_particles.particles_speed;
						interactive_settings = data_particles.interactive_settings;
						advanced_settings = data_particles.advanced_settings;
						particles_opacity = data_particles.particles_opacity;
						particles_direction = data_particles.particles_direction;

						if ( 'yes' === enable_particles ){
							if ( 'custom' === particles_style ) {
							<?php
							if ( '' !== $json_particles_custom ) {
								?>
								tsParticles.load( 'uabb-particle-' + row_id, <?php echo $json_particles_custom; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> );
								<?php
							}
							?>
						} else {
								var number_value = 150,
									shape_type = 'circle',
									shape_nb_sides = 5,
									opacity_value = 0.6,
									opacity_random = true,
									opacity_anim_enable  = false,
									line_linked = false,
									move_speed = 4,
									move_random = true,
									size_value = 2,
									size_random = true,
									size_anim_enable  = false,
									onhover = 'repulse',
									move_direction = 'none',
									interactive = false;
								if ( 'default' === particles_style ) {
									line_linked = true;
									opacity_random = false;
									move_random = false;
									move_speed = 6;
								} else if( 'nasa' == particles_style ) {
									number_value = 160;
									shape_type = 'circle';
									opacity_value = 1;
									opacity_anim_enable  = true;
									move_speed = 1;
									size_value = 3;
									onhover = 'bubble';
								} else if ( 'snow' == particles_style ) {
									opacity_value = 0.5;
									size_value = 4;
									move_speed = 3;
									move_direction = particles_direction;
									number_value = 200;
									opacity_random = false;
								}  else if ( 'flow' == particles_style ) {
									number_value = 14;
									shape_type = 'polygon';
									shape_nb_sides = 6;
									opacity_value = 0.3;
									move_speed = 5;
									size_value = 40;
									size_random = false;
									size_anim_enable  = true;

								} else if( 'bubble' == particles_style ) {
									move_speed = 5;
									move_direction = 'top';
									number_value = 500;
									size_value = 1;
									size_random = false;
									opacity_value = 0.6;
									opacity_random = false;
								}
								if( particles_dot_color == '' ) {
									particles_dot_color = '#bdbdbd';
								}
								if( particles_opacity != '' || particles_opacity == '0' ) {
									opacity_value = particles_opacity;
								}
								if ( 'yes' === advanced_settings ) {

									if( number_particles != '' ) {
										number_value = number_particles;
									}

									if( particles_size !== '' ) {
										size_value = particles_size;
									}

									if( particles_speed !== '' ) {
										move_speed = particles_speed;
									}
								}
								if ( interactive_settings == 'yes' ) {
									interactive = true;
								}
								var config = {
									"particles": {
										"number": {
											"value": number_value,
											"density": {
												"enable": true,
												"value_area": 800
											}
										},
										"color": {
											"value": particles_dot_color
										},
										"shape": {
											"type": shape_type,
											"stroke": {
												"width": 0,
												"color": "#ffffff"
											},
											"polygon": {
												"nb_sides": shape_nb_sides
											},
										},
										"opacity": {
											"value": opacity_value,
											"random": opacity_random,
											"anim": {
												"enable": opacity_anim_enable,
												"speed": 1,
												"opacity_min": 0.1,
												"sync": false
											}
										},
										"size": {
											"value": size_value,
											"random": size_random,
											"anim": {
												"enable": size_anim_enable,
												"speed": 5,
												"size_min": 35,
												"sync": false
											}
										},
										"line_linked": {
											"enable": line_linked,
											"distance": 150,
											"color": particles_dot_color,
											"opacity": 0.4,
											"width": 1
										},
										"move": {
											"enable": true,
											"speed": move_speed,
											"direction": move_direction,
											"random": move_random,
											"straight": false,
											"out_mode": "out",
											"attract": {
											"enable": false,
											"rotateX": 600,
											"rotateY": 1200
											}
										}
									},
									"interactivity": {
										"detect_on": "canvas",
										"events": {
											"onhover": {
												"enable": interactive,
												"mode": onhover,
											},
											"onclick": {
												"enable": false,
												"mode": "push"
											},
											"resize": true
										},
										"modes": {
											"grab": {
												"distance": 400,
												"line_linked": {
													"opacity": 1
												}
											},
											"bubble": {
												"distance": 200,
												"size": 0,
												"duration": 2,
												"opacity": 0,
												"speed": 2
											},
											"repulse": {
												"distance": 150
											},
											"push": {
												"particles_nb": 4
											},
											"remove": {
												"particles_nb": 2
											}
										}
									},
								"retina_detect": true
								}
								tsParticles.load( 'uabb-particle-' + row_id, config );
							}
						}
					}
			<?php } ?>
			}
		})(jQuery);
	<?php
	$js .= ob_get_clean();
	return $js;
}
