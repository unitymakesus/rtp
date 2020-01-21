<?php
/**
 * Intializes row settings' file
 *
 * @package Row settings
 */

/**
 * Function that registers necessary row's settings file
 *
 * @since 1.4.6
 */
function uabb_row_settings_init() {

	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-settings.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-css.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-js.php';

	uabb_row_register_settings();
	uabb_row_render_css();
	uabb_row_render_js();
}

$module      = UABB_Init::$uabb_options['fl_builder_uabb'];
$rowgrad     = isset( $module['uabb-row-gradient'] ) ? $module['uabb-row-gradient'] : true;
$rowparticle = isset( $module['uabb-row-particle'] ) ? $module['uabb-row-particle'] : true;

if ( $rowgrad ) {
	uabb_row_settings_init();
}
if ( $rowparticle ) {
	uabb_row_particle_settings_init();
}
/**
 * Function that registers necessary row's settings file
 *
 * @since 1.17.0
 */
function uabb_row_particle_settings_init() {

	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-settings.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-css.php';
	require_once BB_ULTIMATE_ADDON_DIR . 'includes/row-js.php';

	uabb_row_particle_register_settings();
	uabb_row_particle_render_css();
	uabb_row_particle_render_js();

	add_action( 'fl_builder_before_render_row_bg', 'uabb_output_before_row_bg' );
}
/**
 * Function that render necessary HTML for row's
 *
 * @param string $row gets the row data.
 * @since 1.17.0
 */
function uabb_output_before_row_bg( $row ) {

	$data = array(
		'enable_particles'     => isset( $row->settings->enable_particles ) ? $row->settings->enable_particles : '',
		'particles_style'      => isset( $row->settings->uabb_row_particles_style ) ? $row->settings->uabb_row_particles_style : '',
		'particles_dot_color'  => isset( $row->settings->uabb_row_particles_color ) ? $row->settings->uabb_row_particles_color : '',
		'number_particles'     => isset( $row->settings->uabb_row_number_particles ) ? $row->settings->uabb_row_number_particles : '',
		'particles_size'       => isset( $row->settings->uabb_row_particles_size ) ? $row->settings->uabb_row_particles_size : '',
		'particles_speed'      => isset( $row->settings->uabb_row_particles_speed ) ? $row->settings->uabb_row_particles_speed : '',
		'interactive_settings' => isset( $row->settings->uabb_row_particles_interactive_settings ) ? $row->settings->uabb_row_particles_interactive_settings : '',
		'advanced_settings'    => isset( $row->settings->uabb_row_particles_settings ) ? $row->settings->uabb_row_particles_settings : '',
		'particles_opacity'    => isset( $row->settings->uabb_row_particles_color_opacity ) ? $row->settings->uabb_row_particles_color_opacity : '',
		'particles_direction'  => isset( $row->settings->uabb_particles_direction ) ? $row->settings->uabb_particles_direction : '',
		'id'                   => isset( $row->node ) ? $row->node : '',
	);
	$data = json_encode( $data );

	if ( isset( $row->settings->enable_particles ) && 'yes' === $row->settings->enable_particles ) { ?>

		<div class="uabb-row-particles-background" id="uabb-particle-<?php echo $row->node; ?>" data-particle=<?php echo $data; ?>></div>

	<?php } ?>
	<?php
	if ( FLBuilderModel::is_builder_active() && isset( $row->settings->enable_particles ) && 'yes' === $row->settings->enable_particles ) {

		?>
		<script>
			var url ='<?php echo BB_ULTIMATE_ADDON_URL . 'assets/js/particles.min.js'; ?>';

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

			if ( jQuery( '.uabb-row-particles-background' ).length ) {

				jQuery.cachedScript( url ).done( function( script, textStatus ) {
					window.particle_js_loaded = 1;
					particles_row_background_script();

				});
			}
			function particles_row_background_script() {

				var row_id ='<?php echo $row->node; ?>';
				var nodeClass  	= jQuery( '.fl-node-' + row_id );
				<?php $json_custom_particles = wp_strip_all_tags( $row->settings->uabb_particles_custom_code ); ?>

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

					if ( 'yes' === enable_particles ) {

						if ( 'custom' === particles_style ) {
							<?php
							if ( isset( $json_particles_custom ) && '' !== $json_particles_custom ) {
								?>
								particlesJS( 'uabb-particle-' + row_id, <?php echo $json_particles_custom; ?> );
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
							} else if ( 'flow' == particles_style ) {
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
							if( interactive_settings == 'yes' ) {
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
							particlesJS( 'uabb-particle-' + row_id, config );
						}
					}
				}
			}
		</script>
	<?php } ?>
	<?php
}

