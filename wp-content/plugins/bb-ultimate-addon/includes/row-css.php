<?php
/**
 * Intializes row's CSS files
 *
 * @package Row settings
 */

/**
 * Function that renders row's CSS
 *
 * @since 1.4.6
 */
function uabb_row_render_css() {

	add_filter( 'fl_builder_render_css', 'uabb_row_gradient_css', 10, 3 );
}
/**
 * Function that renders particle row's CSS
 *
 * @since 1.17.0
 */
function uabb_row_particle_render_css() {

	add_filter( 'fl_builder_render_css', 'uabb_row_particle_css', 10, 3 );
}
/**
 * Function that renders particle row's CSS
 *
 * @since 1.17.0
 * @param CSS    $css gets the CSS for the row gradient.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_row_particle_css( $css, $nodes, $global_settings ) {
	foreach ( $nodes['rows'] as $row ) {
		ob_start();
		if ( 'yes' === $row->settings->enable_particles && ! FLBuilderModel::is_builder_active() ) {
			?>
			.fl-node-<?php echo esc_attr( $row->node ); ?> .fl-row-content {
				position: inherit;
			}
			<?php
		}
		$css .= ob_get_clean();
	}
	return $css;
}
/**
 * Function that renders row's CSS
 *
 * @since 1.4.6
 * @param CSS    $css gets the CSS for the row gradient.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_row_gradient_css( $css, $nodes, $global_settings ) {
	foreach ( $nodes['rows'] as $row ) {

		$row->settings->uabb_row_linear_gradient_primary_loc   = ( isset( $row->settings->uabb_row_linear_gradient_primary_loc ) && '' !== $row->settings->uabb_row_linear_gradient_primary_loc ) ? $row->settings->uabb_row_linear_gradient_primary_loc : 0;
		$row->settings->uabb_row_linear_gradient_secondary_loc = ( isset( $row->settings->uabb_row_linear_gradient_secondary_loc ) && '' !== $row->settings->uabb_row_linear_gradient_secondary_loc ) ? $row->settings->uabb_row_linear_gradient_secondary_loc : 100;
		$row->settings->uabb_row_radial_gradient_primary_loc   = ( isset( $row->settings->uabb_row_radial_gradient_primary_loc ) && '' !== $row->settings->uabb_row_radial_gradient_primary_loc ) ? $row->settings->uabb_row_radial_gradient_primary_loc : 0;
		$row->settings->uabb_row_radial_gradient_secondary_loc = ( isset( $row->settings->uabb_row_radial_gradient_secondary_loc ) && '' !== $row->settings->uabb_row_radial_gradient_secondary_loc ) ? $row->settings->uabb_row_radial_gradient_secondary_loc : 100;

		ob_start();

		if ( isset( $row->settings->uabb_row_radial_direction ) ) {
			$row->settings->uabb_row_radial_direction = str_replace( '_', ' ', $row->settings->uabb_row_radial_direction );
		}

		switch ( $row->settings->uabb_row_uabb_direction ) {
			case 'top':
				$row->settings->uabb_row_linear_direction = '0';
				break;
			case 'bottom':
				$row->settings->uabb_row_linear_direction = '180';
				break;
			case 'left':
				$row->settings->uabb_row_linear_direction = '90';
				break;
			case 'right':
				$row->settings->uabb_row_linear_direction = '270';
				break;
			case 'top_right_diagonal':
				$row->settings->uabb_row_linear_direction = '45';
				break;
			case 'top_left_diagonal':
				$row->settings->uabb_row_linear_direction = '135';
				break;
			case 'bottom_right_diagonal':
				$row->settings->uabb_row_linear_direction = '315';
				break;
			case 'bottom_left_diagonal':
				$row->settings->uabb_row_linear_direction = '255';
				break;
		}

		if ( 'no' === $row->settings->uabb_row_linear_advance_options ) {
			$row->settings->uabb_row_linear_gradient_primary_loc   = '0';
			$row->settings->uabb_row_linear_gradient_secondary_loc = '100';
		}
		if ( 'no' === $row->settings->uabb_row_radial_advance_options ) {
			$row->settings->uabb_row_radial_gradient_primary_loc   = '0';
			$row->settings->uabb_row_radial_gradient_secondary_loc = '100';
		}

		if ( '' === $row->settings->uabb_row_linear_direction ) {
			$row->settings->uabb_row_linear_direction = '0';
		}

		if ( isset( $row->settings->bg_type ) && 'uabb_gradient' === $row->settings->bg_type ) {
			?>

			<?php if ( 'linear' === $row->settings->uabb_row_gradient_type ) { ?>
					.fl-node-<?php echo esc_attr( $row->node ); ?> > .fl-row-content-wrap {
						background-color: #<?php echo esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?>;
						background-image: -webkit-linear-gradient( <?php echo esc_attr( $row->settings->uabb_row_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_secondary_loc ) . '%'; ?>);
						background-image: -moz-linear-gradient( <?php echo esc_attr( $row->settings->uabb_row_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_secondary_loc ) . '%'; ?>);
						background-image: -o-linear-gradient( <?php echo esc_attr( $row->settings->uabb_row_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_secondary_loc ) . '%'; ?>);
						background-image: -ms-linear-gradient( <?php echo esc_attr( $row->settings->uabb_row_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_secondary_loc ) . '%'; ?>);
						background-image: linear-gradient( <?php echo esc_attr( $row->settings->uabb_row_linear_direction ) . 'deg'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_linear_gradient_secondary_loc ) . '%'; ?>);
					}
			<?php } ?>
			<?php if ( 'radial' === $row->settings->uabb_row_gradient_type ) { ?>
				.fl-node-<?php echo esc_attr( $row->node ); ?> > .fl-row-content-wrap {
					background-color: #<?php echo esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?>;
					background-image: -webkit-radial-gradient(<?php echo 'at ' . esc_attr( $row->settings->uabb_row_radial_direction ); ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -moz-radial-gradient(<?php echo 'at ' . esc_attr( $row->settings->uabb_row_radial_direction ); ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -o-radial-gradient(<?php echo 'at ' . esc_attr( $row->settings->uabb_row_radial_direction ); ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: -ms-radial-gradient(<?php echo 'at ' . esc_attr( $row->settings->uabb_row_radial_direction ); ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_secondary_loc ) . '%'; ?>);
					background-image: radial-gradient(<?php echo 'at ' . esc_attr( $row->settings->uabb_row_radial_direction ); ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_primary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_primary_loc ) . '%'; ?>, <?php echo '#' . esc_attr( $row->settings->uabb_row_gradient_secondary_color ); ?> <?php echo esc_attr( $row->settings->uabb_row_radial_gradient_secondary_loc ) . '%'; ?>);
				}
			<?php } ?>

			<?php
		}
		?>
		<?php
		$css .= ob_get_clean();
	}

	return $css;
}
