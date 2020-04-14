<?php
/**
 * Intializes column's CSS files
 *
 * @package Column settings
 */

/**
 * Function that renders column's CSS
 *
 * @since 1.4.6
 */
function uabb_column_render_css() {

	$module   = UABB_Init::$uabb_options['fl_builder_uabb'];
	$col_grad = isset( $module['uabb-col-gradient'] ) ? $module['uabb-col-gradient'] : true;
	if ( $col_grad ) {
		add_filter( 'fl_builder_render_css', 'uabb_column_gradient_css', 10, 3 );
	}

	$col_shadow = isset( $module['uabb-col-shadow'] ) ? $module['uabb-col-shadow'] : true;
	if ( $col_shadow ) {
		add_filter( 'fl_builder_render_css', 'uabb_column_shadow_css', 10, 3 );
	}
	if ( isset( $module['uabb-col-particle'] ) && ! empty( $module['uabb-col-particle'] ) ) {

		add_filter( 'fl_builder_render_css', 'uabb_column_particle_css', 10, 3 );
	}
}
/**
 * Function that renders column's CSS
 *
 * @since 1.17.0
 * @param CSS    $css gets the CSS for the column gradient.
 * @param array  $nodes an array to get the nodes of the column.
 * @param object $global_settings an object to get various settings.
 */
function uabb_column_particle_css( $css, $nodes, $global_settings ) {
	foreach ( $nodes['columns'] as $column ) {
		ob_start();
		if ( isset( $column->settings->enable_particles_col ) && 'yes' === $column->settings->enable_particles_col ) { ?>
			.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-col-content {
				position: relative;
			}
			.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-module {
				position: inherit;
			}
			<?php
		}
		$css .= ob_get_clean();
	}

	return $css;
}
/**
 * Function that renders column's CSS
 *
 * @since 1.4.6
 * @param CSS    $css gets the CSS for the column gradient.
 * @param array  $nodes an array to get the nodes of the column.
 * @param object $global_settings an object to get various settings.
 */
function uabb_column_gradient_css( $css, $nodes, $global_settings ) {

	$flag = false;

	foreach ( $nodes['columns'] as $column ) {

		if ( 'uabb_gradient' === $column->settings->bg_type ) {

			$flag = true;

			break;
		}
	}

	if ( false === $flag ) {

		return $css;
	}

	foreach ( $nodes['columns'] as $column ) {

		if ( 'uabb_gradient' !== $column->settings->bg_type ) {

			continue;
		}

		$column->settings->uabb_col_linear_gradient_primary_loc   = ( isset( $column->settings->uabb_col_linear_gradient_primary_loc ) && '' !== $column->settings->uabb_col_linear_gradient_primary_loc ) ? $column->settings->uabb_col_linear_gradient_primary_loc : 0;
		$column->settings->uabb_col_linear_gradient_secondary_loc = ( isset( $column->settings->uabb_col_linear_gradient_secondary_loc ) && '' !== $column->settings->uabb_col_linear_gradient_secondary_loc ) ? $column->settings->uabb_col_linear_gradient_secondary_loc : 100;
		$column->settings->uabb_col_radial_gradient_primary_loc   = ( isset( $column->settings->uabb_col_radial_gradient_primary_loc ) && '' !== $column->settings->uabb_col_radial_gradient_primary_loc ) ? $column->settings->uabb_col_radial_gradient_primary_loc : 0;
		$column->settings->uabb_col_radial_gradient_secondary_loc = ( isset( $column->settings->uabb_col_radial_gradient_secondary_loc ) && '' !== $column->settings->uabb_col_radial_gradient_secondary_loc ) ? $column->settings->uabb_col_radial_gradient_secondary_loc : 100;
		ob_start();

		if ( isset( $column->settings->uabb_col_radial_direction ) ) {
			$column->settings->uabb_col_radial_direction = str_replace( '_', ' ', $column->settings->uabb_col_radial_direction );
		}

		switch ( $column->settings->uabb_col_uabb_direction ) {
			case 'top':
				$column->settings->uabb_col_linear_direction = '0';
				break;
			case 'bottom':
				$column->settings->uabb_col_linear_direction = '180';
				break;
			case 'left':
				$column->settings->uabb_col_linear_direction = '90';
				break;
			case 'right':
				$column->settings->uabb_col_linear_direction = '270';
				break;
			case 'top_right_diagonal':
				$column->settings->uabb_col_linear_direction = '45';
				break;
			case 'top_left_diagonal':
				$column->settings->uabb_col_linear_direction = '315';
				break;
			case 'bottom_right_diagonal':
				$column->settings->uabb_col_linear_direction = '135';
				break;
			case 'bottom_left_diagonal':
				$column->settings->uabb_col_linear_direction = '255';
				break;
		}

		if ( 'no' === $column->settings->uabb_col_linear_advance_options ) {
			$column->settings->uabb_col_linear_gradient_primary_loc   = '0';
			$column->settings->uabb_col_linear_gradient_secondary_loc = '100';
		}
		if ( 'no' === $column->settings->uabb_col_radial_advance_options ) {
			$column->settings->uabb_col_radial_gradient_primary_loc   = '0';
			$column->settings->uabb_col_radial_gradient_secondary_loc = '100';
		}
		if ( '' === $column->settings->uabb_col_linear_direction ) {
			$column->settings->uabb_col_linear_direction = '0';
		}

		if ( isset( $column->settings->bg_type ) && 'uabb_gradient' === $column->settings->bg_type ) {
			?>

			<?php if ( 'linear' === $column->settings->uabb_col_gradient_type ) { ?>
				.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content {
					background-color: #<?php echo esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?>;
					background-image: -webkit-linear-gradient(<?php echo esc_attr( $column->settings->uabb_col_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_secondary_loc ) . '%'; ?>);
					background-image: -moz-linear-gradient(<?php echo esc_attr( $column->settings->uabb_col_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_secondary_loc ) . '%'; ?>);
					background-image: -o-linear-gradient(<?php echo esc_attr( $column->settings->uabb_col_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_secondary_loc ) . '%'; ?>);
					background-image: -ms-linear-gradient(<?php echo esc_attr( $column->settings->uabb_col_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_secondary_loc ) . '%'; ?>);
					background-image: linear-gradient(<?php echo esc_attr( $column->settings->uabb_col_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_linear_gradient_secondary_loc ) . '%'; ?>);
				}
			<?php } ?>
			<?php if ( 'radial' === $column->settings->uabb_col_gradient_type ) { ?>
				.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content {
					background-color: #<?php echo esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?>;
					background-image: -webkit-radial-gradient(<?php echo 'at ' . esc_attr( $column->settings->uabb_col_radial_direction ); ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -moz-radial-gradient(<?php echo 'at ' . esc_attr( $column->settings->uabb_col_radial_direction ); ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -o-radial-gradient(<?php echo 'at ' . esc_attr( $column->settings->uabb_col_radial_direction ); ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -ms-radial-gradient(<?php echo 'at ' . esc_attr( $column->settings->uabb_col_radial_direction ); ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: radial-gradient(<?php echo 'at ' . esc_attr( $column->settings->uabb_col_radial_direction ); ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_primary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $column->settings->uabb_col_gradient_secondary_color ); ?> <?php echo esc_attr( $column->settings->uabb_col_radial_gradient_secondary_loc ) . '%'; ?>);
				}
			<?php } ?>
		<?php } ?>
		<?php
		$css .= ob_get_clean();
	}

	return $css;
}

/**
 * Function that renders column's CSS
 *
 * @since 1.4.6
 * @param CSS    $css gets the CSS for the column gradient.
 * @param array  $nodes an array to get the nodes of the column.
 * @param object $global_settings an object to get various settings.
 */
function uabb_column_shadow_css( $css, $nodes, $global_settings ) {

	$version_bb_check = UABB_Compatibility::$version_bb_check;
	if ( $version_bb_check ) {
		foreach ( $nodes['columns'] as $column ) {
			ob_start();
			?>
				<?php if ( isset( $column->settings->border['shadow']['color'] ) && empty( $column->settings->border['shadow']['color'] ) ) { ?>

					<?php if ( 'yes' === $column->settings->col_drop_shadow ) { ?>
						.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content.fl-node-content {
							-webkit-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
							-moz-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
							-o-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
							box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
							<?php if ( isset( $column->settings->col_shadow_hover_transition ) && 'yes' === $column->settings->col_hover_shadow ) { ?>
								-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								-moz-transition: -moz-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								transition: box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								will-change: box-shadow;
							<?php } ?>
						}
					<?php } ?>

					<?php if ( 'yes' === $column->settings->col_hover_shadow ) { ?>
						.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content.fl-node-content:hover {
							-webkit-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
							-moz-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
							-o-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
							box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
							<?php if ( isset( $column->settings->col_shadow_hover_transition ) && 'yes' === $column->settings->col_hover_shadow ) { ?>
								-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								-moz-transition: -moz-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								transition: box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
								will-change: box-shadow;
							<?php } ?>
						}
					<?php } ?>

					<?php if ( 'yes' === $column->settings->col_responsive_shadow && 'yes' === $column->settings->col_drop_shadow ) { ?>
						@media only screen and (max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px) {
							.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-col-content.fl-node-content {
								box-shadow: none;
							}
						}
					<?php } ?>

					<?php if ( 'no' === $column->settings->col_responsive_shadow && 'yes' === $column->settings->col_small_shadow && 'yes' === $column->settings->col_drop_shadow ) { ?>
						@media only screen and (max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px) {
							.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-col-content.fl-node-content {
								box-shadow: none;
							}
						}
					<?php } ?>
				<?php } ?>
			<?php
			$css .= ob_get_clean();
		}
	} else {
		foreach ( $nodes['columns'] as $column ) {

			ob_start();
			?>
			<?php if ( 'yes' === $column->settings->col_drop_shadow ) { ?>
				.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content.fl-node-content {
					-webkit-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
					-moz-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
					-o-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
					box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color : $column->settings->col_shadow_color ); ?>;
					<?php if ( isset( $column->settings->col_shadow_hover_transition ) && 'yes' === $column->settings->col_hover_shadow ) { ?>
						-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						-moz-transition: -moz-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						transition: box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						will-change: box-shadow;
					<?php } ?>
				}
			<?php } ?>

			<?php if ( 'yes' === $column->settings->col_hover_shadow ) { ?>
				.fl-node-<?php echo esc_attr( $column->node ); ?> > .fl-col-content.fl-node-content:hover {
					-webkit-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
					-moz-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
					-o-box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
					box-shadow: <?php echo esc_attr( $column->settings->col_shadow_color_hor_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_ver_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_blur_hover ); ?>px <?php echo esc_attr( $column->settings->col_shadow_color_spr_hover ); ?>px <?php echo esc_attr( ( false === strpos( $column->settings->col_shadow_color_hover, 'rgb' ) ) ? '#' . $column->settings->col_shadow_color_hover : $column->settings->col_shadow_color_hover ); ?>;
					<?php if ( isset( $column->settings->col_shadow_hover_transition ) && 'yes' === $column->settings->col_hover_shadow ) { ?>
						-webkit-transition: -webkit-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -webkit-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						-moz-transition: -moz-box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, -moz-transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						transition: box-shadow <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out, transform <?php echo esc_attr( $column->settings->col_shadow_hover_transition ); ?>ms ease-in-out;
						will-change: box-shadow;
					<?php } ?>
				}
			<?php } ?>

			<?php if ( 'yes' === $column->settings->col_responsive_shadow && 'yes' === $column->settings->col_drop_shadow ) { ?>
				@media only screen and (max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px) {
					.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-col-content.fl-node-content {
						box-shadow: none;
					}
				}
			<?php } ?>

			<?php if ( 'no' === $column->settings->col_responsive_shadow && 'yes' === $column->settings->col_small_shadow && 'yes' === $column->settings->col_drop_shadow ) { ?>
				@media only screen and (max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px) {
					.fl-node-<?php echo esc_attr( $column->node ); ?> .fl-col-content.fl-node-content {
						box-shadow: none;
					}
				}
			<?php } ?>

			<?php
			$css .= ob_get_clean();
		}
	}
	return $css;
}
