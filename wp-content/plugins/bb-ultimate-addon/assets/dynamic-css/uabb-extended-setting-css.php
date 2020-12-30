<?php
/**
 *  Extended setting CSS file
 *
 *  @package UABB Extended Settings
 */

$uabb_options         = UABB_Init::$uabb_options['fl_builder_uabb'];
$enable_row_separator = true;

if ( ! empty( $uabb_options ) && array_key_exists( 'uabb-row-separator', $uabb_options ) ) {
	if ( 1 === (int) $uabb_options['uabb-row-separator'] ) {
		$enable_row_separator = true;
	} else {
		$enable_row_separator = false;
	}
}

if ( $enable_row_separator ) {
	/* Row Extended Setting CSS */
	$rows_object = $nodes['rows'];

	foreach ( $nodes['rows'] as $row_object ) {

		$row_id = $row_object->node;
		$row    = $row_object->settings;

		if ( ( 'none' === $row->separator_shape && 'none' === $row->bot_separator_shape ) ) {

			continue;
		}
		?>
		.fl-node-<?php echo esc_attr( $row_id ); ?> .fl-row-content {
			position: inherit;
		}
		<?php
		if ( isset( $row->separator_shape_height_responsive ) && '' !== $row->separator_shape_height_responsive ) {
			$row->separator_shape_height_small = $row->separator_shape_height_responsive;
		}
		if ( isset( $row->bot_separator_shape_height_responsive ) && '' !== $row->bot_separator_shape_height_responsive ) {
			$row->bot_separator_shape_height_small = $row->bot_separator_shape_height_responsive;
		}

		if ( isset( $row->uabb_row_separator_color ) && '' !== $row->uabb_row_separator_color ) {
			$row->uabb_row_separator_color = UABB_Helper::uabb_colorpicker( $row, 'uabb_row_separator_color', true );
		} else {
			if ( isset( $row->separator_color ) && '' !== $row->separator_color && 'ffffff' === $row->separator_color ) {
				$row->uabb_row_separator_color = UABB_Helper::uabb_colorpicker( $row, 'separator_color', true );
			}
		}

		if ( ! isset( $row->uabb_row_separator_color ) || '' === $row->uabb_row_separator_color ) {
			$row->uabb_row_separator_color = '#ffffff';
		}

		if ( ! isset( $row->bot_separator_color ) || '' === $row->bot_separator_color ) {
			$row->bot_separator_color = '#ffffff';
		}

		$row->bot_separator_color = UABB_Helper::uabb_colorpicker( $row, 'bot_separator_color', true );

		if ( 'round_split' === $row->separator_shape ) {
			?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:before {
				background-color: <?php echo esc_attr( $row->uabb_row_separator_color ); ?>;
				height: <?php echo esc_attr( $row->separator_shape_height ); ?>px;
				top: 0px;
				bottom: auto;
				border-radius: 0 0 50px 0 !important;
				<?php if ( 'yes' === $row->uabb_row_separator_z_index ) { ?>
					z-index: 10;
				<?php } ?>
			}
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:after {
				background-color: <?php echo esc_attr( $row->uabb_row_separator_color ); ?>;
				height: <?php echo esc_attr( $row->separator_shape_height ); ?>px;
				left: 50%;
				top: 0px;
				bottom: auto;
				border-radius: 0 0 0 50px !important;
				<?php if ( 'yes' === $row->uabb_row_separator_z_index ) { ?>
					z-index: 10;
				<?php } ?>
			}
		<?php } ?>

		<?php if ( 'round_split' === $row->bot_separator_shape ) { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:before {
				background-color: <?php echo esc_attr( $row->bot_separator_color ); ?>;
				height: <?php echo esc_attr( $row->bot_separator_shape_height ); ?>px;
				top: auto;
				bottom: -1px;
				border-radius: 0 50px 0 0 !important;
				<?php if ( 'yes' === $row->bot_separator_z_index ) { ?>
					z-index: 10;
				<?php } ?>
			}

			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:after {
				background-color: <?php echo esc_attr( $row->bot_separator_color ); ?>;
				height: <?php echo esc_attr( $row->bot_separator_shape_height ); ?>px;
				left: 50%;
				top: auto;
				bottom: -1px;
				border-radius: 50px 0 0 0 !important;
				<?php if ( 'yes' === $row->bot_separator_z_index ) { ?>
					z-index: 10;
				<?php } ?>
			}
		<?php } ?>
		<?php if ( 'xlarge_circle' === $row->separator_shape || 'circle_svg' === $row->separator_shape || 'triangle_svg' === $row->separator_shape || 'pine_tree' === $row->separator_shape || 'pine_tree_bend' === $row->separator_shape || 'round_split' === $row->separator_shape || 'tilt_left' === $row->separator_shape || 'tilt_right' === $row->separator_shape ) { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
					width: calc( 100% + 1.5px );
			}
		<?php } else { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
				<?php if ( '' === $row->separator_shape_width ) { ?>
					width: calc( 100% + 1.5px );
				<?php } else { ?>
					width: calc( <?php echo esc_attr( $row->separator_shape_width ); ?>% + 1.5px );
				<?php } ?>
			}
		<?php } ?>

		<?php if ( 'xlarge_circle' === $row->bot_separator_shape || 'triangle_svg' === $row->bot_separator_shape || 'circle_svg' === $row->bot_separator_shape || 'pine_tree' === $row->bot_separator_shape || 'pine_tree_bend' === $row->bot_separator_shape || 'round_split' === $row->bot_separator_shape || 'tilt_left' === $row->bot_separator_shape || 'tilt_right' === $row->bot_separator_shape ) { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
					width: calc( 100% + 1.5px );
			}
		<?php } else { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
				<?php if ( '' === $row->bot_separator_shape_width ) { ?>
					width: calc( 100% + 1.5px );
				<?php } else { ?>
					width: calc( <?php echo esc_attr( $row->bot_separator_shape_width ); ?>% + 1.5px ) ;
				<?php } ?>
			}
		<?php } ?>

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-slit2,
		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-slit3 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->uabb_row_separator_color ) ), 80, 'darken' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-slit2,
		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-slit3 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->bot_separator_color ) ), 80, 'darken' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-pine-tree-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->uabb_row_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-pine-tree-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->bot_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-pine-tree-bend-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->uabb_row_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-pine-tree-bend-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->bot_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-slime-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->uabb_row_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-slime-separator2 {
			<?php $dark_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->bot_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $dark_color ); ?>;
			stroke: <?php echo esc_attr( $dark_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-top-wave-slide-separator2 {
			<?php $lighten_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->uabb_row_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $lighten_color ); ?>;
			stroke: <?php echo esc_attr( $lighten_color ); ?>;
		}

		.fl-node-<?php echo esc_attr( $row_id ); ?> #uabb-bottom-wave-slide-separator2 {
			<?php $lighten_color = '#' . FLBuilderColor::adjust_brightness( uabb_parse_color_to_hex( uabb_theme_base_color( $row->bot_separator_color ) ), 80, 'lighten' ); ?>
			fill: <?php echo esc_attr( $lighten_color ); ?>;
			stroke: <?php echo esc_attr( $lighten_color ); ?>;
		}


		<?php if ( 'yes' === $row->uabb_row_separator_z_index ) { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator {
			z-index: 9;
		}
		<?php } ?>
		<?php if ( 'yes' === $row->bot_separator_z_index ) { ?>
			.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator {
			z-index: 9;
		}
		<?php } ?>

		/* Responsive Sizes */
		<?php if ( $global_settings->responsive_enabled ) { // Responsive Sizes. ?>
			@media(max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px) {
				<?php if ( isset( $row->separator_shape_height_medium ) && '' !== $row->separator_shape_height_medium ) { ?>
					<?php if ( 'round_split' === $row->separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:before,
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:after {
						height: <?php echo esc_attr( $row->separator_shape_height_medium ); ?>px;
					}
					<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator svg {
						height: <?php echo esc_attr( $row->separator_shape_height_medium ); ?>px;
					}
					<?php } ?>
				<?php } ?>
				<?php if ( isset( $row->bot_separator_shape_height_medium ) && '' !== $row->bot_separator_shape_height_medium ) { ?>
					<?php if ( 'round_split' === $row->bot_separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:before,
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:after {
						height: <?php echo esc_attr( $row->bot_separator_shape_height_medium ); ?>px;
					}
					<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator svg {
						height: <?php echo esc_attr( $row->bot_separator_shape_height_medium ); ?>px;
					}
					<?php } ?>
				<?php } ?>
				<?php if ( 'xlarge_circle' === $row->separator_shape || 'circle_svg' === $row->separator_shape || 'triangle_svg' === $row->separator_shape || 'pine_tree' === $row->separator_shape || 'pine_tree_bend' === $row->separator_shape || 'film' === $row->separator_shape || 'round_split' === $row->separator_shape || 'tilt_left' === $row->separator_shape || 'tilt_right' === $row->separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
							width: 100%;
					}
				<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
						<?php if ( ! isset( $row->separator_shape_width_medium ) || '' === $row->separator_shape_width_medium ) { ?>
							width: 100%;
						<?php } else { ?>
							width: <?php echo esc_attr( $row->separator_shape_width_medium ); ?>%;
						<?php } ?>
					}
				<?php } ?>

				<?php if ( 'xlarge_circle' === $row->bot_separator_shape || 'triangle_svg' === $row->bot_separator_shape || 'circle_svg' === $row->bot_separator_shape || 'pine_tree' === $row->bot_separator_shape || 'pine_tree_bend' === $row->bot_separator_shape || 'film' === $row->bot_separator_shape || 'round_split' === $row->bot_separator_shape || 'tilt_left' === $row->bot_separator_shape || 'tilt_right' === $row->bot_separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
							width: 100%;
					}
				<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
						<?php if ( ! isset( $row->bot_separator_shape_width_medium ) || '' === $row->bot_separator_shape_width_medium ) { ?>
							width: 100%;
						<?php } else { ?>
							width: <?php echo esc_attr( $row->bot_separator_shape_width_medium ); ?>%;
						<?php } ?>
					}
				<?php } ?>

			}

			@media(max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px) {

				<?php if ( isset( $row->separator_shape_height_small ) && '' !== $row->separator_shape_height_small ) { ?>
					<?php if ( 'round_split' === $row->separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:before,
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-round-split:after {
						height: <?php echo esc_attr( $row->separator_shape_height_small ); ?>px;
					}
					<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator svg {
						height: <?php echo esc_attr( $row->separator_shape_height_small ); ?>px;
					}
					<?php } ?>
				<?php } ?>
				<?php if ( isset( $row->bot_separator_shape_height_small ) && '' !== $row->bot_separator_shape_height_small ) { ?>
					<?php if ( 'round_split' === $row->bot_separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:before,
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-round-split:after {
						height: <?php echo esc_attr( $row->bot_separator_shape_height_small ); ?>px;
					}
					<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator svg {
						height: <?php echo esc_attr( $row->bot_separator_shape_height_small ); ?>px;
					}
					<?php } ?>
				<?php } ?>

				<?php if ( 'xlarge_circle' === $row->separator_shape || 'circle_svg' === $row->separator_shape || 'triangle_svg' === $row->separator_shape || 'pine_tree' === $row->separator_shape || 'pine_tree_bend' === $row->separator_shape || 'film' === $row->separator_shape || 'round_split' === $row->separator_shape || 'tilt_left' === $row->separator_shape || 'tilt_right' === $row->separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
							width: 100%;
					}
				<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-top-row-separator.uabb-has-svg svg {
						<?php if ( ! isset( $row->separator_shape_width_responsive ) || '' === $row->separator_shape_width_responsive ) { ?>
							width: 100%;
						<?php } else { ?>
							width: <?php echo esc_attr( $row->separator_shape_width_responsive ); ?>%;
						<?php } ?>
					}
				<?php } ?>

				<?php if ( 'xlarge_circle' === $row->bot_separator_shape || 'triangle_svg' === $row->bot_separator_shape || 'circle_svg' === $row->bot_separator_shape || 'pine_tree' === $row->bot_separator_shape || 'pine_tree_bend' === $row->bot_separator_shape || 'film' === $row->bot_separator_shape || 'round_split' === $row->bot_separator_shape || 'tilt_left' === $row->bot_separator_shape || 'tilt_right' === $row->bot_separator_shape ) { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
							width: 100%;
					}
				<?php } else { ?>
					.fl-node-<?php echo esc_attr( $row_id ); ?> .uabb-bottom-row-separator.uabb-has-svg svg {
						<?php if ( ! isset( $row->bot_separator_shape_width_responsive ) || '' === $row->bot_separator_shape_width_responsive ) { ?>
							width: 100%;
						<?php } else { ?>
							width: <?php echo esc_attr( $row->bot_separator_shape_width_responsive ); ?>%;
						<?php } ?>
					}
				<?php } ?>

			}
			<?php
		}
	}
}
?>
