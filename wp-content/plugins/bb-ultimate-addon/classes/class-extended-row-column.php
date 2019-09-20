<?php
/**
 * UABB_Extend_RowColumn setup
 *
 * @since 1.1.0.4
 * @package UABB Extend Row Column
 */

/**
 * This class initializes UABB Extend RowColumn
 *
 * @class UABB_Extend_RowColumn
 */
class UABB_Extend_RowColumn {
	/**
	 * Function to initialize Row Column Settings.
	 *
	 * @since x.x.x
	 */
	public function init() {

		// Register column setting.
		add_filter( 'fl_builder_register_settings_form', array( $this, 'column_settings' ), 10, 2 );

		$uabb_options         = UABB_Init::$uabb_options['fl_builder_uabb'];
		$enable_row_separator = true;

		if ( ! empty( $uabb_options ) && array_key_exists( 'uabb-row-separator', $uabb_options ) ) {
			if ( 1 == $uabb_options['uabb-row-separator'] ) {
				$enable_row_separator = true;
			} else {
				$enable_row_separator = false;
			}
		}

		if ( $enable_row_separator ) {

			add_filter( 'fl_builder_register_settings_form', array( $this, 'row_settings' ), 10, 2 );
			add_filter( 'fl_builder_row_custom_class', array( $this, 'row_class' ), 10, 2 );
			add_action( 'fl_builder_before_render_row_bg', array( $this, 'row_top_html' ), 10, 1 );
			add_action( 'fl_builder_after_render_row_bg', array( $this, 'row_bottom_html' ), 10, 1 );
		}

		/* Extended Settings CSS */
		add_filter( 'fl_builder_render_css', array( $this, 'uabb_extended_setting_css' ), 10, 3 );

		/* Add Responsive div after all content */
		add_action( 'fl_builder_after_render_content', array( $this, 'uabb_responsive_div_html' ), 10, 1 );

	}

	/**
	 * Function to append Custom CSS of extended settings
	 *
	 * @since x.x.x
	 * @param CSS    $css gets the CSS for the extended settings.
	 * @param string $nodes gets the nodes for the settings.
	 * @param object $global_settings gets the global settings.
	 */
	function uabb_extended_setting_css( $css, $nodes, $global_settings ) {

		ob_start();
		include BB_ULTIMATE_ADDON_DIR . 'assets/dynamic-css/uabb-extended-setting-css.php';
		$css .= ob_get_clean();
		return $css;
	}

	/**
	 * Function to extend row settings for row separator
	 *
	 * @since x.x.x
	 * @param object $content gets the content for the Row Separator.
	 */
	function uabb_responsive_div_html( $content ) {
		echo '<div class="uabb-js-breakpoint" style="display: none;"></div>';
	}

	/**
	 * Function to extend row settings for row separator
	 *
	 * @since x.x.x
	 * @param string $form gets the form for the Row Separator.
	 * @param string $id gets the row's name.
	 */
	function row_settings( $form, $id ) {
		if ( 'row' == $id ) {

			$top_sep_option = apply_filters(
				'uabb_row_separator_top_options',
				array(
					'none'                  => __( 'None', 'uabb' ),
					'arrow_outward'         => __( 'Arrow Inward', 'uabb' ),
					'arrow_inward'          => __( 'Arrow Outward', 'uabb' ),
					'xlarge_triangle'       => __( 'Big Triangle', 'uabb' ),
					'big_triangle'          => __( 'Big Triangle Reverse', 'uabb' ),
					'xlarge_triangle_left'  => __( 'Big Triangle Left', 'uabb' ),
					'xlarge_triangle_right' => __( 'Big Triangle Right', 'uabb' ),
					'clouds'                => __( 'Clouds', 'uabb' ),
					'xlarge_circle'         => __( 'Curve Center', 'uabb' ),
					'curve_up'              => __( 'Curve Left', 'uabb' ),
					'curve_down'            => __( 'Curve Right', 'uabb' ),
					'grass'                 => __( 'Grass', 'uabb' ),
					'grass_bend'            => __( 'Grass Bend', 'uabb' ),
					'circle_svg'            => __( 'Half Circle', 'uabb' ),
					'multi_triangle'        => __( 'Multi Triangle', 'uabb' ),
					'mul_triangles'         => __( 'Multiple Triangles', 'uabb' ),
					'pine_tree'             => __( 'Pine Tree', 'uabb' ),
					'pine_tree_bend'        => __( 'Pine Tree Bend', 'uabb' ),
					'round_split'           => __( 'Round Split', 'uabb' ),
					'slime'                 => __( 'Slime', 'uabb' ),
					'stamp'                 => __( 'Stamp', 'uabb' ),
					'tilt_left'             => __( 'Tilt Left', 'uabb' ),
					'tilt_right'            => __( 'Tilt Right', 'uabb' ),
					'triangle_svg'          => __( 'Triangle', 'uabb' ),
					'waves'                 => __( 'Waves', 'uabb' ),
					'wave_slide'            => __( 'Wave Slide', 'uabb' ),
				),
				10,
				1
			);

			$bot_sep_options = apply_filters(
				'uabb_row_separator_bot_options',
				array(
					'none'                  => __( 'None', 'uabb' ),
					'arrow_outward'         => __( 'Arrow Inward', 'uabb' ),
					'arrow_inward'          => __( 'Arrow Outward', 'uabb' ),
					'xlarge_triangle'       => __( 'Big Triangle', 'uabb' ),
					'big_triangle'          => __( 'Big Triangle Reverse', 'uabb' ),
					'xlarge_triangle_left'  => __( 'Big Triangle Left', 'uabb' ),
					'xlarge_triangle_right' => __( 'Big Triangle Right', 'uabb' ),
					'clouds'                => __( 'Clouds', 'uabb' ),
					'xlarge_circle'         => __( 'Curve Center', 'uabb' ),
					'curve_up'              => __( 'Curve Left', 'uabb' ),
					'curve_down'            => __( 'Curve Right', 'uabb' ),
					'grass'                 => __( 'Grass', 'uabb' ),
					'grass_bend'            => __( 'Grass Bend', 'uabb' ),
					'circle_svg'            => __( 'Half Circle', 'uabb' ),
					'multi_triangle'        => __( 'Multi Triangle', 'uabb' ),
					'mul_triangles'         => __( 'Multiple Triangles', 'uabb' ),
					'pine_tree'             => __( 'Pine Tree', 'uabb' ),
					'pine_tree_bend'        => __( 'Pine Tree Bend', 'uabb' ),
					'round_split'           => __( 'Round Split', 'uabb' ),
					'slime'                 => __( 'Slime', 'uabb' ),
					'stamp'                 => __( 'Stamp', 'uabb' ),
					'tilt_left'             => __( 'Tilt Left', 'uabb' ),
					'tilt_right'            => __( 'Tilt Right', 'uabb' ),
					'triangle_svg'          => __( 'Triangle', 'uabb' ),
					'waves'                 => __( 'Waves', 'uabb' ),
					'wave_slide'            => __( 'Wave Slide', 'uabb' ),
				),
				10,
				1
			);

			$row_setting_arr = array(
				'title'    => __( 'Effects', 'uabb' ),
				'sections' => array(
					'general'        => array(
						'title'  => __( 'Top Row Separator', 'uabb' ),
						'fields' => array(
							'separator_shape'              => array(
								'type'    => 'select',
								'label'   => __( 'Type', 'uabb' ),
								'default' => 'none',
								'options' => $top_sep_option,
								'toggle'  => array(
									'triangle_svg'         => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'xlarge_triangle'      => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'xlarge_triangle_left' => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'xlarge_triangle_right' => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'circle_svg'           => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'xlarge_circle'        => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'curve_up'             => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'curve_down'           => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'tilt_left'            => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'tilt_right'           => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'round_split'          => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'waves'                => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'clouds'               => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'multi_triangle'       => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color' ),
									),
									'stamp'                => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'big_triangle'         => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'arrow_inward'         => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'arrow_outward'        => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'grass'                => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'grass_bend'           => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'pine_tree'            => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'pine_tree_bend'       => array(
										'fields' => array( 'separator_shape_height', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'slime'                => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'mul_triangles'        => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
									'wave_slide'           => array(
										'fields' => array( 'separator_shape_height', 'separator_shape_width', 'uabb_row_separator_color', 'uabb_row_separator_color_opc', 'uabb_row_separator_z_index' ),
									),
								),
							),
							'separator_shape_width'        => array(
								'type'        => 'unit',
								'label'       => __( 'Width', 'uabb' ),
								'description' => '%',
								'responsive'  => array(
									'placeholder' => array(
										'default' => '100',
										'medium'  => '100',
										'small'   => '100',
									),
									'default'     => array(
										'default' => '100',
										'medium'  => '100',
										'small'   => '100',
									),
								),
							),
							'separator_shape_height'       => array(
								'type'        => 'unit',
								'label'       => __( 'Height', 'uabb' ),
								'description' => 'px',
								'responsive'  => array(
									'placeholder' => array(
										'default' => '60',
										'medium'  => '',
										'small'   => '',
									),
									'default'     => array(
										'default' => '60',
										'medium'  => '',
										'small'   => '',
									),
								),
							),
							'uabb_row_separator_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'help'       => __( 'Mostly, this should be background color of your adjacent row section.', 'uabb' ),
							),
							'uabb_row_separator_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '100',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
								'placeholder' => '100',
							),
							'uabb_row_separator_z_index'   => array(
								'type'    => 'select',
								'label'   => __( 'Bring to Front', 'uabb' ),
								'default' => 'yes',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
							),
						),
					),
					'general_bottom' => array(
						'title'  => __( 'Bottom Row Separator', 'uabb' ),
						'fields' => array(
							'bot_separator_shape'        => array(
								'type'    => 'select',
								'label'   => __( 'Type', 'uabb' ),
								'default' => 'none',
								'options' => $bot_sep_options,
								'toggle'  => array(
									'triangle_svg'         => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'xlarge_triangle'      => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'xlarge_triangle_left' => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'xlarge_triangle_right' => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'circle_svg'           => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'xlarge_circle'        => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'curve_up'             => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'curve_down'           => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'tilt_left'            => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'tilt_right'           => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'round_split'          => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'waves'                => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'clouds'               => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'multi_triangle'       => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color' ),
									),
									'stamp'                => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'big_triangle'         => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'arrow_inward'         => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'arrow_outward'        => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),
									),
									'grass'                => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'grass_bend'           => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'pine_tree'            => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'pine_tree_bend'       => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'slime'                => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'mul_triangles'        => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
									'wave_slide'           => array(
										'fields' => array( 'bot_separator_shape_height', 'bot_separator_shape_width', 'bot_separator_color', 'bot_separator_color_opc', 'bot_separator_z_index' ),

									),
								),
							),
							'bot_separator_shape_width'  => array(
								'type'        => 'unit',
								'label'       => __( 'Width', 'uabb' ),
								'description' => '%',
								'responsive'  => array(
									'placeholder' => array(
										'default' => '100',
										'medium'  => '100',
										'small'   => '100',
									),
									'default'     => array(
										'default' => '100',
										'medium'  => '100',
										'small'   => '100',
									),
								),
							),
							'bot_separator_shape_height' => array(
								'type'        => 'unit',
								'label'       => __( 'Height', 'uabb' ),
								'description' => 'px',
								'responsive'  => array(
									'placeholder' => array(
										'default' => '60',
										'medium'  => '',
										'small'   => '',
									),
									'default'     => array(
										'default' => '60',
										'medium'  => '',
										'small'   => '',
									),
								),
							),
							'bot_separator_color'        => array(
								'type'       => 'color',
								'label'      => __( 'Background', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'help'       => __( 'Mostly, this should be background color of your adjacent row section.', 'uabb' ),
							),
							'bot_separator_color_opc'    => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '100',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
								'placeholder' => '100',
							),
							'bot_separator_z_index'      => array(
								'type'    => 'select',
								'label'   => __( 'Bring to Front', 'uabb' ),
								'default' => 'yes',
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
				array_slice( $form['tabs'], 0, 1 ),
				array( 'effect' => $row_setting_arr ),
				array_slice( $form['tabs'], 1 )
			);
		}
		return $form;
	}

	/**
	 * Function to append Custom Vertical Alignment Setting in Column
	 *
	 * @since x.x.x
	 * @param string $form gets the form class for the Row Separator.
	 * @param string $id gets the column's name.
	 */
	function column_settings( $form, $id ) {

		if ( 'col' == $id ) {
			$column_form = array(
				'tabs' => array(
					'style' => array(
						'sections' => array(
							'general' => array(
								'fields' => array(
									'content_alignment' => array(
										'options' => array(
											'bottom' => __( 'Bottom', 'uabb' ),
										),
									),
								),
							),
							'border'  => array(
								'title'  => __( 'Border', 'uabb' ),
								'fields' => array(
									'border_type' => array(
										'toggle'  => array(
											''       => array(
												'fields' => array(),
											),
											'solid'  => array(
												'fields' => array( 'border_color', 'border_opacity', 'border' ),
											),
											'dashed' => array(
												'fields' => array( 'border_color', 'border_opacity', 'border' ),
											),
											'dotted' => array(
												'fields' => array( 'border_color', 'border_opacity', 'border' ),
											),
											'double' => array(
												'fields' => array( 'border_color', 'border_opacity', 'border' ),
											),
										),
										'preview' => array(
											'type' => 'none',
										),
									),
								),
							),
						),
					),
				),
			);
			$form        = array_replace_recursive( (array) $form, (array) $column_form );
		}
		return $form;
	}

	/**
	 * Function to add row class according to setting
	 *
	 * @since x.x.x
	 * @param string $class gets the class for the Row Separator.
	 * @param object $row_object gets the row's settings.
	 */
	function row_class( $class, $row_object ) {
		$row = $row_object->settings;
		if ( 'none' != $row->separator_shape ) {
			$class = $class . ' uabb-top-row uabb-' . $row->separator_shape;
		}
		if ( 'none' != $row->bot_separator_shape ) {
			$class = $class . ' uabb-bottom-row uabb-' . $row->bot_separator_shape;
		}
		return $class;
	}

	/**
	 * Function to add Custom html of extended setting
	 *
	 * @since x.x.x
	 * @param object $row_object gets the row's settings.
	 */
	function row_top_html( $row_object ) {
		$row = $row_object->settings;
		if ( ( isset( $row->separator_position ) && ( 'top' == $row->separator_position || 'top_bottom' == $row->separator_position ) ) || 'none' != $row->separator_shape ) {
			$row->separator_flag = 'top';
			include BB_ULTIMATE_ADDON_DIR . 'classes/class-extended-row-html.php';
		}
	}

	/**
	 * Function that renders row's separator position
	 *
	 * @since x.x.x
	 * @param object $row_object gets the row's settings.
	 */
	function row_bottom_html( $row_object ) {
		$row = $row_object->settings;
		if ( ( isset( $row->separator_position ) && ( 'bottom' == $row->separator_position || 'top_bottom' == $row->separator_position ) ) || 'none' != $row->bot_separator_shape ) {
			$row->separator_flag = 'bottom';
			include BB_ULTIMATE_ADDON_DIR . 'classes/class-extended-row-html.php';
		}
	}
}

$uabb_extend_rowcolumn = new UABB_Extend_RowColumn();
$uabb_extend_rowcolumn->init();

