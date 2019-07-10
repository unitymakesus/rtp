<?php
/**
 * Intializes row settings' file
 *
 * @package Row settings
 */

/**
 * Function that registers row's settings file
 *
 * @since 1.4.6
 */
function uabb_row_register_settings() {

	add_filter( 'fl_builder_register_settings_form', 'uabb_row_gradient', 10, 2 );
}
/**
 * Function that registers particle row's settings file
 *
 * @since 1.17.0
 */
function uabb_row_particle_register_settings() {

	add_filter( 'fl_builder_register_settings_form', 'uabb_row_particle', 10, 2 );
}
/**
 * Function that inserts UABB's particle Tab in the Row's settings
 *
 * @since 1.17.0
 * @param array $form an array to get the form.
 * @param int   $id an integer to get the form's id.
 */
function uabb_row_particle( $form, $id ) {

	if ( 'row' != $id ) {
		return $form;
	}

	$row_setting_particles = array(
		'title'    => __( 'Particle Backgrounds', 'uabb' ),
		'sections' => array(
			'particles_background' => array(
				'title'  => __( 'General', 'uabb' ),
				'fields' => array(
					'enable_particles'                 => array(
						'type'    => 'select',
						'label'   => __( 'Enable Particle Backgrounds', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
					'uabb_row_particles_style'         => array(
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
					'uabb_particles_custom_code'       => array(
						'type'        => 'editor',
						'label'       => __( 'Add Particles Json', 'uabb' ),
						'connections' => array( 'html', 'string', 'url' ),
					),
					'uabb_particles_direction'         => array(
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
					'uabb_row_particles_color'         => array(
						'type'       => 'color',
						'label'      => __( 'Particle Color', 'uabb' ),
						'show_reset' => true,
						'connection' => ( 'color' ),
					),
					'uabb_row_particles_color_opacity' => array(
						'type'   => 'unit',
						'label'  => __( 'Particle Color opacity ( 0.1 to 1 ) ', 'uabb' ),
						'slider' => array(
							'step' => .1,
							'max'  => 1,
						),
					),
					'uabb_row_particles_settings'      => array(
						'type'    => 'select',
						'label'   => __( 'Advanced Settings', 'uabb' ),
						'default' => 'no',
						'options' => array(
							'yes' => __( 'Yes', 'uabb' ),
							'no'  => __( 'No', 'uabb' ),
						),
					),
					'uabb_row_number_particles'        => array(
						'type'   => 'unit',
						'label'  => __( 'Number of Particles', 'uabb' ),
						'slider' => true,
					),
					'uabb_row_particles_size'          => array(
						'type'   => 'unit',
						'label'  => __( 'Particle Size', 'uabb' ),
						'slider' => true,
					),
					'uabb_row_particles_speed'         => array(
						'type'   => 'unit',
						'label'  => __( 'Move Speed', 'uabb' ),
						'slider' => true,
					),
					'uabb_row_particles_interactive_settings' => array(
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
		array( 'Particles' => $row_setting_particles ),
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
function uabb_row_gradient( $form, $id ) {

	if ( 'row' != $id ) {
		return $form;
	}

	$form['tabs']['style']['sections']['background']['fields']['bg_type']['options']['uabb_gradient'] = __( 'Ultimate Gradient', 'uabb' );
	$form['tabs']['style']['sections']['background']['fields']['bg_type']['toggle']['uabb_gradient']  = array(
		'sections' => array( 'uabb_row_gradient' ),
	);
	$form['tabs']['style']['sections']['uabb_row_gradient'] = array(
		'title'  => __( 'Gradient', 'uabb' ),
		'fields' => array(
			'uabb_row_gradient_type'                 => array(
				'type'    => 'select',
				'label'   => __( 'Type', 'uabb' ),
				'default' => 'linear',
				'options' => array(
					'linear' => __( 'Linear', 'uabb' ),
					'radial' => __( 'Radial', 'uabb' ),
				),
				'toggle'  => array(
					'linear' => array(
						'fields' => array( 'uabb_row_uabb_direction', 'uabb_row_linear_advance_options' ),
					),
					'radial' => array(
						'fields' => array( 'uabb_row_radial_direction', 'uabb_row_radial_advance_options' ),
					),
				),
			),
			'uabb_row_gradient_primary_color'        => array(
				'type'       => 'color',
				'label'      => __( 'First Color', 'uabb' ),
				'show_reset' => true,
				'default'    => '',
			),
			'uabb_row_gradient_secondary_color'      => array(
				'type'       => 'color',
				'label'      => __( 'Second Color', 'uabb' ),
				'show_reset' => true,
				'default'    => '',
			),
			'uabb_row_radial_direction'              => array(
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
			'uabb_row_uabb_direction'                => array(
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
						'fields' => array( 'uabb_row_linear_direction' ),
					),
				),
			),
			'uabb_row_linear_direction'              => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Angle', 'uabb' ),
				'default'     => '90',
				'placeholder' => '90',
				'description' => 'deg',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_row_linear_advance_options'        => array(
				'type'    => 'select',
				'label'   => __( 'Advanced Options', 'uabb' ),
				'default' => 'no',
				'options' => array(
					'yes' => __( 'Yes', 'uabb' ),
					'no'  => __( 'No', 'uabb' ),
				),
				'toggle'  => array(
					'yes' => array(
						'fields' => array( 'uabb_row_linear_gradient_primary_loc', 'uabb_row_linear_gradient_secondary_loc' ),
					),
					'no'  => array(
						'fields' => array(),
					),
				),
			),
			'uabb_row_linear_gradient_primary_loc'   => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Start Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '0',
				'placeholder' => '0',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_row_linear_gradient_secondary_loc' => array(
				'type'        => 'text',
				'label'       => __( 'Gradient End Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '100',
				'placeholder' => '100',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_row_radial_advance_options'        => array(
				'type'    => 'select',
				'label'   => __( 'Advanced Options', 'uabb' ),
				'default' => 'no',
				'options' => array(
					'yes' => __( 'Yes', 'uabb' ),
					'no'  => __( 'No', 'uabb' ),
				),
				'toggle'  => array(
					'yes' => array(
						'fields' => array( 'uabb_row_radial_gradient_primary_loc', 'uabb_row_radial_gradient_secondary_loc' ),
					),
					'no'  => array(
						'fields' => array(),
					),
				),
			),
			'uabb_row_radial_gradient_primary_loc'   => array(
				'type'        => 'text',
				'label'       => __( 'Gradient Start Location', 'uabb' ),
				'show_reset'  => true,
				'default'     => '0',
				'placeholder' => '0',
				'description' => '%',
				'maxlength'   => '3',
				'size'        => '3',
			),
			'uabb_row_radial_gradient_secondary_loc' => array(
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
	return $form;
}
