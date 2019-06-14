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
