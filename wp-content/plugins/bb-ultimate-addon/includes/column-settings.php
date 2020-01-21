<?php
/**
 * Intializes column settings' files
 *
 * @package Column's settings
 */

/**
 * Function that registers necessary column's settings file
 *
 * @since 1.4.6
 */
function uabb_column_register_settings() {

	$module  = UABB_Init::$uabb_options['fl_builder_uabb'];
	$colgrad = isset( $module['uabb-col-gradient'] ) ? $module['uabb-col-gradient'] : true;
	if ( $colgrad ) {
		add_filter( 'fl_builder_register_settings_form', 'uabb_column_gradient', 10, 2 );
	}

	$colshadow = isset( $module['uabb-col-shadow'] ) ? $module['uabb-col-shadow'] : true;
	if ( $colshadow ) {
		add_filter( 'fl_builder_register_settings_form', 'uabb_column_shadow', 10, 2 );
	}

	if ( isset( $module['uabb-col-particle'] ) && ! empty( $module['uabb-col-particle'] ) ) {

		add_filter( 'fl_builder_register_settings_form', 'uabb_column_particle', 10, 2 );
		add_action( 'fl_builder_before_render_modules', 'uabb_output_before_module', 20, 2 );
	}
}
/**
 * Function that inserts UABB's particle Tab in the Row's settings
 *
 * @since 1.17.0
 * @param array $form an array to get the form.
 * @param int   $id an integer to get the form's id.
 */
function uabb_column_particle( $form, $id ) {

	if ( 'col' != $id ) {
		return $form;
	}

	$col_setting_particles = array(
		'title'    => __( 'Particle Backgrounds', 'uabb' ),
		'sections' => array(
			'particles_background' => array(
				'title'  => __( 'General', 'uabb' ),
				'fields' => array(
					'enable_particles_col'             => array(
						'type'    => 'select',
						'label'   => __( 'Enable Particle Backgrounds', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
					'uabb_col_particles_style'         => array(
						'type'    => 'select',
						'label'   => __( 'Style', 'uabb' ),
						'default' => 'none',
						'options' => array(
							'default' => __( 'Polygon', 'uabb' ),
							'nasa'    => __( 'NASA', 'uabb' ),
							'snow'    => __( 'Snow', 'uabb' ),
							'custom'  => __( 'Custom', 'uabb' ),
						),
					),
					'uabb_particles_custom_code_col'   => array(
						'type'        => 'editor',
						'label'       => __( 'Add Particles Json', 'uabb' ),
						'connections' => array( 'html', 'string', 'url' ),
					),
					'uabb_particles_direction_col'     => array(
						'type'    => 'select',
						'label'   => __( 'Flow direction', 'uabb' ),
						'default' => 'bottom',
						'options' => array(
							'top'          => __( 'Top', 'uabb' ),
							'bottom'       => __( 'Bottom', 'uabb' ),
							'left'         => __( 'Left', 'uabb' ),
							'right'        => __( 'Right', 'uabb' ),
							'top-left'     => __( 'Top Left', 'uabb' ),
							'top-right'    => __( 'Top Right', 'uabb' ),
							'bottom-left'  => __( 'Bottom Left', 'uabb' ),
							'bottom-right' => __( 'Bottom Right', 'uabb' ),

						),
					),
					'uabb_col_particles_color'         => array(
						'type'       => 'color',
						'label'      => __( 'Particle Color', 'uabb' ),
						'show_reset' => true,
						'connection' => ( 'color' ),
					),
					'uabb_col_particles_color_opacity' => array(
						'type'   => 'unit',
						'label'  => __( 'Particle Color opacity ( 0.1 to 1 ) ', 'uabb' ),
						'slider' => array(
							'step' => .1,
							'max'  => 1,
						),
					),
					'uabb_col_particles_settings'      => array(
						'type'    => 'select',
						'label'   => __( 'Advanced Settings', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
					'uabb_col_number_particles'        => array(
						'type'   => 'unit',
						'label'  => __( 'Number of Particles', 'uabb' ),
						'slider' => true,
					),
					'uabb_col_particles_size'          => array(
						'type'   => 'unit',
						'label'  => __( 'Particle Size', 'uabb' ),
						'slider' => true,
					),
					'uabb_col_particles_speed'         => array(
						'type'   => 'unit',
						'label'  => __( 'Move Speed', 'uabb' ),
						'slider' => true,
					),
					'uabb_col_particles_interactive_settings' => array(
						'type'    => 'select',
						'label'   => __( 'Enable Hover Effect', 'uabb' ),
						'default' => 'no',
						'help'    => __( 'Note: Enable Hover Effect settings will work on the frontend only', 'uabb' ),
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
				),
			),
		),
	);

	$form['tabs'] = array_merge(
		array_slice( $form['tabs'], 0, 2 ),
		array( 'Particles' => $col_setting_particles ),
		array_slice( $form['tabs'], 2 )
	);
	return $form;
}
/**
 * Function that inserts UABB's Tab in the Row's settings
 *
 * @since 1.4.6
 * @param array $form an array to get the form.
 * @param int   $id an integer to get the form's id.
 */
function uabb_column_gradient( $form, $id ) {

	if ( 'col' != $id ) {
		return $form;
	}

	$border_section = $form['tabs']['style']['sections']['border'];
	unset( $form['tabs']['style']['sections']['border'] );

	$form['tabs']['style']['sections']['background']['fields']['bg_type']['options']['uabb_gradient'] = esc_html__( 'Ultimate Gradient', 'uabb' );
	$form['tabs']['style']['sections']['background']['fields']['bg_type']['toggle']['uabb_gradient']  = array(
		'sections' => array( 'uabb_col_gradient' ),
	);

	$form['tabs']['style']['sections']['uabb_col_gradient'] = array(
		'title'  => __( 'Gradient', 'uabb' ),
		'fields' => array(
			'uabb_col_gradient_type'                 => array(
				'type'    => 'select',
				'label'   => __( 'Type', 'uabb' ),
				'default' => 'linear',
				'options' => array(
					'linear' => __( 'Linear', 'uabb' ),
					'radial' => __( 'Radial', 'uabb' ),
				),
				'toggle'  => array(
					'linear' => array(
						'fields' => array( 'uabb_col_uabb_direction', 'uabb_col_linear_advance_options' ),
					),
					'radial' => array(
						'fields' => array( 'uabb_col_radial_direction', 'uabb_col_radial_advance_options' ),
					),
				),
			),
			'uabb_col_gradient_primary_color'        => array(
				'type'       => 'color',
				'label'      => __( 'First Color', 'uabb' ),
				'show_reset' => true,
				'default'    => '',
			),
			'uabb_col_gradient_secondary_color'      => array(
				'type'       => 'color',
				'label'      => __( 'Second Color', 'uabb' ),
				'show_reset' => true,
				'default'    => '',
			),
			'uabb_col_radial_direction'              => array(
				'type'    => 'select',
				'label'   => __( 'Gradient Direction', 'uabb' ),
				'default' => 'center_center',
				'options' => array(
					'center_center' => __( 'Center Center', 'uabb' ),
					'center_left'   => __( 'Center Left', 'uabb' ),
					'center_right'  => __( 'Center Right', 'uabb' ),
					'top_center'    => __( 'Top Center', 'uabb' ),
					'top_left'      => __( 'Top Left', 'uabb' ),
					'top_right'     => __( 'Top Right', 'uabb' ),
					'bottom_center' => __( 'Bottom Center', 'uabb' ),
					'bottom_left'   => __( 'Bottom Left', 'uabb' ),
					'bottom_right'  => __( 'Bottom Right', 'uabb' ),
				),
			),
			'uabb_col_uabb_direction'                => array(
				'type'    => 'select',
				'label'   => __( 'Gradient Direction', 'uabb' ),
				'default' => 'bottom',
				'options' => array(
					'top'                   => __( 'Bottom to Top', 'uabb' ),
					'bottom'                => __( 'Top to Bottom', 'uabb' ),
					'left'                  => __( 'Left to Right', 'uabb' ),
					'right'                 => __( 'Right to Left', 'uabb' ),
					'top_right_diagonal'    => __( 'Bottom Left to Top Right', 'uabb' ),
					'top_left_diagonal'     => __( 'Bottom Right to Top Left', 'uabb' ),
					'bottom_right_diagonal' => __( 'Top Left to Bottom Right', 'uabb' ),
					'bottom_left_diagonal'  => __( 'Top Right to Bottom Left', 'uabb' ),
					'custom'                => __( 'Custom', 'uabb' ),
				),
				'toggle'  => array(
					'custom' => array(
						'fields' => array( 'uabb_col_linear_direction' ),
					),
				),
			),
			'uabb_col_linear_direction'              => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Angle', 'uabb' ),
				'default'     => '24',
				'placeholder' => '',
				'description' => 'deg',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_col_linear_advance_options'        => array(
				'type'    => 'select',
				'label'   => __( 'Advanced Options', 'uabb' ),
				'default' => 'no',
				'options' => array(
					'yes' => __( 'Yes', 'uabb' ),
					'no'  => __( 'No', 'uabb' ),
				),
				'toggle'  => array(
					'yes' => array(
						'fields' => array( 'uabb_col_linear_gradient_primary_loc', 'uabb_col_linear_gradient_secondary_loc' ),
					),
					'no'  => array(
						'fields' => array(),
					),
				),
			),
			'uabb_col_linear_gradient_primary_loc'   => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Start Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '0',
				'placeholder' => '0',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_col_linear_gradient_secondary_loc' => array(
				'type'        => 'text',
				'label'       => __( 'Gradient End Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '100',
				'placeholder' => '100',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_col_radial_advance_options'        => array(
				'type'    => 'select',
				'label'   => __( 'Advanced Options', 'uabb' ),
				'default' => 'no',
				'options' => array(
					'yes' => __( 'Yes', 'uabb' ),
					'no'  => __( 'No', 'uabb' ),
				),
				'toggle'  => array(
					'yes' => array(
						'fields' => array( 'uabb_col_radial_gradient_primary_loc', 'uabb_col_radial_gradient_secondary_loc' ),
					),
					'no'  => array(
						'fields' => array(),
					),
				),
			),
			'uabb_col_radial_gradient_primary_loc'   => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Start Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '0',
				'placeholder' => '0',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_col_radial_gradient_secondary_loc' => array(
				'type'        => 'text',
				'label'       => __( 'Gradient End Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '100',
				'placeholder' => '100',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
		),
	);

	$form['tabs']['style']['sections']['border'] = $border_section;

	return $form;

}

/**
 * Function that inserts UABB's Box Shadow option in the Row's settings
 *
 * @since 1.4.6
 * @param array $form an array to get the form.
 * @param int   $id an integer to get the form's id.
 */
function uabb_column_shadow( $form, $id ) {

	if ( 'col' != $id ) {
		return $form;
	}

	$branding_name = UABB_PREFIX;
	$notice        = /* Translators: %1$s: search term */ sprintf(
		__( 'Note: If Column Shadow Settings for Beaver Builder are enabled then %1$s Shadow tab settings will not apply', 'uabb' ),
		$branding_name
	);
	$advanced      = $form['tabs']['advanced'];
	unset( $form['tabs']['advanced'] );

	$form['tabs']['col_shadow'] = array(
		'title'    => __( 'Shadow', 'uabb' ),
		'sections' => array(
			'box_shadow'                  => array(
				'title'  => __( 'Box Shadow', 'uabb' ),
				'fields' => array(
					'col_drop_shadow'       => array(
						'type'    => 'select',
						'label'   => __( 'Box Shadow', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
						'help'    => $notice,
						'toggle'  => array(
							'yes' => array(
								'fields'   => array( 'col_shadow_color_hor', 'col_shadow_color_ver', 'col_shadow_color_blur', 'col_shadow_color_spr', 'col_shadow_color', 'col_shadow_color_opc' ),
								'sections' => array( 'col_drop_shadow_responsive' ),
							),
						),
					),
					'col_shadow_color_hor'  => array(
						'type'        => 'text',
						'label'       => __( 'Horizontal Length', 'uabb' ),
						'default'     => '0',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_ver'  => array(
						'type'        => 'text',
						'label'       => __( 'Vertical Length', 'uabb' ),
						'default'     => '0',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_blur' => array(
						'type'        => 'text',
						'label'       => __( 'Blur Radius', 'uabb' ),
						'default'     => '7',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_spr'  => array(
						'type'        => 'text',
						'label'       => __( 'Spread Radius', 'uabb' ),
						'default'     => '0',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color'      => array(
						'type'       => 'color',
						'label'      => __( 'Shadow Color', 'uabb' ),
						'default'    => 'rgba(168,168,168,0.5)',
						'show_reset' => true,
						'show_alpha' => true,
					),
				),
			),
			'col_drop_shadow_color_hover' => array(
				'title'  => __( 'Hover Style', 'uabb' ),
				'fields' => array(
					'col_hover_shadow'            => array(
						'type'    => 'select',
						'label'   => __( 'Change On Hover', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
						'toggle'  => array(
							'yes' => array(
								'fields' => array( 'col_shadow_color_hor_hover', 'col_shadow_color_ver_hover', 'col_shadow_color_blur_hover', 'col_shadow_color_spr_hover', 'col_shadow_color_hover', 'col_shadow_hover_transition' ),
							),
						),
					),
					'col_shadow_color_hor_hover'  => array(
						'type'        => 'text',
						'label'       => __( 'Horizontal Length', 'uabb' ),
						'default'     => '0',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_ver_hover'  => array(
						'type'        => 'text',
						'label'       => __( 'Vertical Length', 'uabb' ),
						'default'     => '0',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_blur_hover' => array(
						'type'        => 'text',
						'label'       => __( 'Blur Radius', 'uabb' ),
						'default'     => '10',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_spr_hover'  => array(
						'type'        => 'text',
						'label'       => __( 'Spread Radius', 'uabb' ),
						'default'     => '1',
						'size'        => '5',
						'description' => 'px',
					),
					'col_shadow_color_hover'      => array(
						'type'       => 'color',
						'label'      => __( 'Shadow Color', 'uabb' ),
						'default'    => 'rgba(168,168,168,0.9)',
						'show_reset' => true,
						'show_alpha' => true,
					),
					'col_shadow_hover_transition' => array(
						'type'        => 'text',
						'label'       => __( 'Transition Speed', 'uabb' ),
						'default'     => 200,
						'description' => 'ms',
						'size'        => 5,
						'maxlength'   => 5,
						'help'        => __( 'Enter value in milliseconds.', 'uabb' ),
						'preview'     => array(
							'type' => 'none',
						),
					),
				),
			),
			'col_drop_shadow_responsive'  => array(
				'title'  => __( 'Responsive', 'uabb' ),
				'fields' => array(
					'col_responsive_shadow' => array(
						'type'    => 'select',
						'label'   => __( 'Hide on Medium & Small Devices', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
						'toggle'  => array(
							'no' => array(
								'fields' => array( 'col_small_shadow' ),
							),
						),
					),
					'col_small_shadow'      => array(
						'type'    => 'select',
						'label'   => __( 'Hide on Small Devices', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
				),
			),
		),
	);
	$form['tabs']['advanced']   = $advanced;

	return $form;
}
/**
 * Function that render necessary HTML for row's
 *
 * @param string $modules gets the column data.
 * @param string $col_id gets the column data.
 * @since 1.17.0
 */
function uabb_output_before_module( $modules, $col_id ) {

	$column = is_object( $col_id ) ? $col_id : FLBuilderModel::get_node( $col_id );

	$data = array(
		'enable_particles'     => isset( $column->settings->enable_particles_col ) ? $column->settings->enable_particles_col : '',
		'particles_style'      => isset( $column->settings->uabb_col_particles_style ) ? $column->settings->uabb_col_particles_style : '',
		'particles_dot_color'  => isset( $column->settings->uabb_col_particles_color ) ? $column->settings->uabb_col_particles_color : '',
		'number_particles'     => isset( $column->settings->uabb_col_number_particles ) ? $column->settings->uabb_col_number_particles : '',
		'particles_size'       => isset( $column->settings->uabb_col_particles_size ) ? $column->settings->uabb_col_particles_size : '',
		'particles_speed'      => isset( $column->settings->uabb_col_particles_speed ) ? $column->settings->uabb_col_particles_speed : '',
		'interactive_settings' => isset( $column->settings->uabb_col_particles_interactive_settings ) ? $column->settings->uabb_col_particles_interactive_settings : '',
		'advanced_settings'    => isset( $column->settings->uabb_col_particles_settings ) ? $column->settings->uabb_col_particles_settings : '',
		'particles_opacity'    => isset( $column->settings->uabb_col_particles_color_opacity ) ? $column->settings->uabb_col_particles_color_opacity : '',
		'particles_direction'  => isset( $column->settings->uabb_particles_direction_col ) ? $column->settings->uabb_particles_direction_col : '',
		'id'                   => isset( $column->node ) ? $column->node : '',
	);
	$data = json_encode( $data );

	if ( isset( $column->settings->enable_particles_col ) && 'yes' === $column->settings->enable_particles_col ) { ?>

		<div class="uabb-col-particles-background" id="uabb-particle-<?php echo $column->node; ?>" data-particle=<?php echo $data; ?>></div>

	<?php } ?>
	<?php
	if ( FLBuilderModel::is_builder_active() && isset( $column->settings->enable_particles_col ) && 'yes' === $column->settings->enable_particles_col ) {
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
			if ( jQuery( '.uabb-col-particles-background' ).length ) {

				jQuery.cachedScript( url ).done( function( script, textStatus ) {
					window.particle_js_loaded = 1;
					particles_col_background_script();

				});
			}
			function particles_col_background_script() {

			var row_id ='<?php echo $column->node; ?>';
			var nodeClass  	= jQuery( '.fl-node-' + row_id );
			<?php $json_custom_particles = wp_strip_all_tags( $column->settings->uabb_particles_custom_code_col ); ?>

			particle_selector = nodeClass.find( '.uabb-col-particles-background' );

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
								particlesJS( 'uabb-particle-' + row_id, <?php echo $json_custom_particles; ?> );
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
