<?php
/**
 *  UABB Social share Module front-end CSS php file
 *
 *  @package UABB Social share Module
 */

$version_bb_check                = UABB_Compatibility::$version_bb_check;
$settings->primary_color         = UABB_Helper::uabb_colorpicker( $settings, 'primary_color', true );
$settings->secondary_color       = UABB_Helper::uabb_colorpicker( $settings, 'secondary_color', true );
$settings->primary_hover_color   = UABB_Helper::uabb_colorpicker( $settings, 'primary_hover_color', true );
$settings->secondary_hover_color = UABB_Helper::uabb_colorpicker( $settings, 'secondary_hover_color', true );
?>
<?php
	$settings->size    = ( '' !== $settings->size ) ? $settings->size : '40';
	$settings->spacing = ( '' !== $settings->spacing ) ? $settings->spacing : '10';
?>
<?php
// Text Typography.
if ( class_exists( 'FLBuilderCSS' ) ) {

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'width_border',
			'selector'     => ".fl-node-$id .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-grid-button, .fl-node-$id .uabb-social-share-wrap .uabb-ss-framed .uabb-ss-grid-button ",
			'prop'         => 'border-width',
			'unit'         => 'px',
		)
	);

	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'title_typography',
			'selector'     => ".fl-node-$id .uabb-ss-grid-button .uabb-ss-button-title",
		)
	);

	// Text Padding Left.
	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'title_padding_left',
			'selector'     => ".fl-node-$id .uabb-ss-grid-button .uabb-ss-button-text",
			'prop'         => 'padding-left',
			'unit'         => 'px',
		)
	);

	// Text Padding.
	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'title_padding_right',
			'selector'     => ".fl-node-$id .uabb-ss-grid-button .uabb-ss-button-text",
			'prop'         => 'padding-right',
			'unit'         => 'px',
		)
	);
}
?>
<?php
if ( isset( $settings->skins ) && 'default' !== $settings->skins ) {
	if ( isset( $settings->column_gap ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
			<?php
			echo ( '' !== $settings->column_gap ) ? 'margin-right:calc(' . esc_attr( $settings->column_gap ) / 2 . 'px);' : 'margin-right:calc( 10px/2 );';
			echo ( '' !== $settings->column_gap ) ? 'margin-left:calc(' . esc_attr( $settings->column_gap ) / 2 . 'px);' : 'margin-left:calc( 10px/2 );';
			?>
		}
		<?php
	}
	if ( isset( $settings->row_gap ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
			<?php
			if ( isset( $settings->row_gap ) ) {
				echo ( '' !== $settings->row_gap ) ? 'margin-bottom:' . esc_attr( $settings->row_gap ) . 'px;' : '';
			}
			?>
		}
		<?php
	}
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ss-icon i {
		<?php
		if ( isset( $settings->icon_img_size ) ) {
			echo ( '' !== $settings->icon_img_size ) ? 'font-size:' . esc_attr( $settings->icon_img_size ) . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button {
		<?php
		if ( isset( $settings->button_height ) ) {
			echo ( '' !== $settings->button_height ) ? 'height:' . esc_attr( $settings->button_height ) . 'px;' : '';
		}
		?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-style-floating {
		<?php
		if ( isset( $settings->floating_position ) ) {
			echo ( '' !== $settings->floating_position ) ? 'top:' . esc_attr( $settings->floating_position ) . '%;' : '';
		}
		?>
	}
	<?php if ( 'custom' === $settings->color_style ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-flat .uabb-ss-grid-button,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-gradient .uabb-ss-grid-button,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-icon {
			<?php
			if ( isset( $settings->primary_color ) ) {
				echo ( '' !== $settings->primary_color ) ? 'background:' . esc_attr( $settings->primary_color ) . ';' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-minimal .uabb-ss-icon i {
			<?php
			if ( isset( $settings->primary_color ) ) {
				echo ( '' !== $settings->primary_color ) ? 'color:' . esc_attr( $settings->primary_color ) . ';' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-grid-button,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-framed .uabb-ss-grid-button {
			<?php
			if ( isset( $settings->primary_color ) ) {
				echo ( '' !== $settings->primary_color ) ? 'border-color:' . esc_attr( $settings->primary_color ) . ';' : '';
			}
			?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-grid-item:hover .uabb-ss-grid-button,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-framed .uabb-ss-grid-item:hover .uabb-ss-grid-button {			
							<?php
							if ( isset( $settings->primary_hover_color ) ) {
								echo ( '' !== $settings->primary_hover_color ) ? 'border-color:' . esc_attr( $settings->primary_hover_color ) . ';' : '';
							}
							?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-button-text,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button .uabb-ss-grid-button-link,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-minimal .uabb-ss-button-text .uabb-ss-button-title {

			<?php
			if ( isset( $settings->secondary_color ) ) {
				echo ( '' !== $settings->secondary_color ) ? 'color:' . esc_attr( $settings->secondary_color ) . ';' : '';
			}
			?>
		}
		<?php if ( isset( $settings->primary_hover_color ) && ! empty( $settings->primary_hover_color ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ss-flat .uabb-ss-grid-button:hover,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-grid-button:hover .uabb-ss-icon,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-gradient .uabb-ss-grid-button:hover,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-minimal .uabb-ss-grid-button:hover .uabb-ss-icon {
				background:<?php echo esc_attr( $settings->primary_hover_color ); ?>;
			}
		<?php } ?>
		<?php if ( isset( $settings->secondary_hover_color ) && ! empty( $settings->secondary_hover_color ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-boxed .uabb-ss-button-text:hover,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button-link:hover,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-minimal .uabb-ss-grid-button:hover .uabb-ss-button-title {
				color:<?php echo esc_attr( $settings->secondary_hover_color ); ?>;
			}
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ( 'horizontal' === $settings->icon_struc_align ) { ?>


.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-horizontal .uabb-social-share-link-wrap {
	margin-bottom: <?php echo esc_attr( $settings->spacing ); ?>px;
	<?php
	if ( 'left' === $settings->align ) {
		?>
	margin-right: <?php echo esc_attr( $settings->spacing ); ?>px;
		<?php
	} elseif ( 'right' === $settings->align ) {
		?>
	margin-left: <?php echo esc_attr( $settings->spacing ); ?>px;
		<?php
	} else {
		?>
	margin-left: <?php echo intval( $settings->spacing ) / 2; ?>px;
	margin-right: <?php echo intval( $settings->spacing ) / 2; ?>px;
		<?php
	}
	?>
}

<?php } ?>

<?php if ( 'vertical' === $settings->icon_struc_align ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-vertical .uabb-social-share-link-wrap {
		margin-bottom: <?php echo esc_attr( $settings->spacing ); ?>px;
	}
<?php } ?>

<?php
$icon_count                 = 1;
$settings->bg_border_radius = ( '' !== $settings->bg_border_radius ) ? $settings->bg_border_radius : '0';
foreach ( $settings->social_icons as $i => $icon ) :

	$icon->bg_color       = uabb_theme_base_color( UABB_Helper::uabb_colorpicker( $icon, 'bg_color', true ) );
	$icon->bg_hover_color = uabb_theme_base_color( UABB_Helper::uabb_colorpicker( $icon, 'bg_hover_color', true ) );

	if ( ! $version_bb_check ) {
		$imageicon_array = array(

			/* General Section */
			'image_type'              => $icon->image_type,

			/* Icon Basics */
			'icon'                    => $icon->icon,
			'icon_size'               => $settings->size,
			'icon_align'              => $settings->align,

			/* Image Basics */
			'photo_source'            => 'library',
			'photo'                   => $icon->photo,
			'photo_url'               => '',
			'img_size'                => ( 'custom' === $settings->icoimage_style || 'simple' === $settings->icoimage_style ) ? $settings->size : ( $settings->size * 2 ),
			'img_align'               => $settings->align,
			'photo_src'               => ( isset( $icon->photo_src ) ) ? $icon->photo_src : '',


			/* Icon Style */
			'icon_style'              => $settings->icoimage_style,
			'icon_bg_size'            => ( (int) $settings->bg_size * 2 ),
			'icon_border_style'       => $settings->border_style,
			'icon_border_width'       => $settings->border_width,
			'icon_bg_border_radius'   => $settings->bg_border_radius,

			/* Image Style */
			'image_style'             => $settings->icoimage_style,
			'img_bg_size'             => $settings->bg_size,
			'img_border_style'        => $settings->border_style,
			'img_border_width'        => $settings->border_width,
			'img_bg_border_radius'    => $settings->bg_border_radius,

			/* Preset Color variable new */
			'icon_color_preset'       => 'preset1',

			/* Icon Colors */
			'icon_color'              => $icon->icocolor,
			'icon_hover_color'        => $icon->icohover_color,
			'icon_bg_color'           => $icon->bg_color,
			'icon_bg_color_opc'       => $icon->bg_color_opc,
			'icon_bg_hover_color_opc' => $icon->bg_hover_color_opc,
			'icon_bg_hover_color'     => $icon->bg_hover_color,
			'icon_border_color'       => $icon->border_color,
			'icon_border_hover_color' => $icon->border_hover_color,
			'icon_three_d'            => $settings->three_d,

			/* Image Colors */
			'img_bg_color'            => $icon->bg_color,
			'img_bg_color_opc'        => $icon->bg_color_opc,
			'img_bg_hover_color_opc'  => $icon->bg_hover_color_opc,
			'img_bg_hover_color'      => $icon->bg_hover_color,
			'img_border_color'        => $icon->border_color,
			'img_border_hover_color'  => $icon->border_hover_color,
		);
	} else {
		$imageicon_array = array(

			/* General Section */
			'image_type'              => $icon->image_type,

			/* Icon Basics */
			'icon'                    => $icon->icon,
			'icon_size'               => $settings->size,
			'icon_align'              => $settings->align,

			/* Image Basics */
			'photo_source'            => 'library',
			'photo'                   => $icon->photo,
			'photo_url'               => '',
			'img_size'                => ( 'custom' === $settings->icoimage_style || 'simple' === $settings->icoimage_style ) ? $settings->size : ( $settings->size * 2 ),
			'img_align'               => $settings->align,
			'photo_src'               => ( isset( $icon->photo_src ) ) ? $icon->photo_src : '',


			/* Icon Style */
			'icon_style'              => $settings->icoimage_style,
			'icon_bg_size'            => ( (int) $settings->bg_size * 2 ),
			'icon_border_style'       => $settings->border_style,
			'icon_border_width'       => $settings->border_width,
			'icon_bg_border_radius'   => $settings->bg_border_radius,

			/* Image Style */
			'image_style'             => $settings->icoimage_style,
			'img_bg_size'             => $settings->bg_size,
			'img_border_style'        => $settings->border_style,
			'img_border_width'        => $settings->border_width,
			'img_bg_border_radius'    => $settings->bg_border_radius,

			/* Preset Color variable new */
			'icon_color_preset'       => 'preset1',

			/* Icon Colors */
			'icon_color'              => $icon->icocolor,
			'icon_hover_color'        => $icon->icohover_color,
			'icon_bg_color'           => $icon->bg_color,
			'icon_bg_hover_color'     => $icon->bg_hover_color,
			'icon_border_color'       => $icon->border_color,
			'icon_border_hover_color' => $icon->border_hover_color,
			'icon_three_d'            => $settings->three_d,

			/* Image Colors */
			'img_bg_color'            => $icon->bg_color,
			'img_bg_hover_color'      => $icon->bg_hover_color,
			'img_border_color'        => $icon->border_color,
			'img_border_hover_color'  => $icon->border_hover_color,
		);
	}

	FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-social-share-' . $icon_count, $imageicon_array );
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-<?php echo esc_attr( $icon_count ); ?> .uabb-imgicon-wrap .uabb-image-content {
		<?php
		echo ( 'simple' !== $settings->icoimage_style ) ? 'background: ' . wp_kses_post( uabb_theme_base_color( $icon->bg_color ) ) . ';' : '';
		echo ( 'circle' === $settings->icoimage_style ) ? 'border-radius: 100%;' : '';

		/* Gradient Color */
		if ( $settings->three_d && 'simple' !== $settings->icoimage_style ) {

			$bg_color      = $icon->bg_color;
			$bg_grad_start = '#' . FLBuilderColor::adjust_brightness( $bg_color, 40, 'lighten' );
			?>

			background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $icon->bg_color ); ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $icon->bg_color ); ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_color ); ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_color ); ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_color ); ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $icon->bg_color ); ?>',GradientType=0 ); /* IE6-9 */

		<?php } ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-<?php echo esc_attr( $icon_count ); ?> .uabb-imgicon-wrap .uabb-image-content:hover {
	<?php
		echo ( 'simple' !== $settings->icoimage_style ) ? 'background: ' . wp_kses_post( uabb_theme_base_color( $icon->bg_hover_color ) ) . ';' : '';
	if ( $settings->three_d && ! empty( $icon->bg_hover_color ) && 'simple' !== $settings->icoimage_style ) {
		$bg_hover_color = ( ! empty( $icon->bg_hover_color ) ) ? uabb_parse_color_to_hex( $icon->bg_hover_color ) : '';

		$bg_hover_grad_start = '#' . FLBuilderColor::adjust_brightness( $bg_hover_color, 40, 'lighten' );
		?>
			background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_hover_color ); ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_hover_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $icon->bg_hover_color ); ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_hover_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_hover_color ); ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_hover_color ); ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_hover_grad_start ); ?> 0%,<?php echo esc_attr( $icon->bg_hover_color ); ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_hover_grad_start ); ?>', endColorstr='<?php echo esc_attr( $icon->bg_hover_color ); ?>',GradientType=0 ); /* IE6-9 */
		<?php } ?>
	}

	<?php
	if ( isset( $settings->responsive_align ) ) {
		if ( '' !== $settings->responsive_align && 'default' !== $settings->responsive_align ) {
			?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-<?php echo esc_attr( $icon_count ); ?> .uabb-imgicon-wrap {
				text-align: <?php echo esc_attr( $settings->responsive_align ); ?>;
			}
		}
			<?php
		}
	}
	$icon_count++;
endforeach;
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap {
	text-align: <?php echo esc_attr( $settings->align ); ?>;
}

<?php
if ( isset( $settings->responsive_align ) ) {
	if ( '' !== $settings->responsive_align && 'default' !== $settings->responsive_align ) {
		?>
@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap {
		text-align: <?php echo esc_attr( $settings->responsive_align ); ?>;
	}

		<?php
		if ( 'center' !== $settings->responsive_align ) {
			?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-<?php echo esc_attr( $settings->align ); ?> .uabb-social-share-link-wrap {
			<?php
			if ( 'left' === $settings->responsive_align ) {
				?>
		margin-right: <?php echo esc_attr( $settings->spacing ); ?>px;
		margin-left: 0;
				<?php
			} elseif ( 'right' === $settings->responsive_align ) {
				?>
		margin-left: <?php echo esc_attr( $settings->spacing ); ?>px;
		margin-right: 0;
				<?php
			} else {
				?>
		margin-left: <?php echo esc_attr( intval( $settings->spacing ) / 2 ); ?>px;
		margin-right: <?php echo esc_attr( intval( $settings->spacing ) / 2 ); ?>px;
				<?php
			}
			?>
	}
			<?php
		}
		?>
}
		<?php
	}
}
?>
<?php
if ( isset( $settings->skins ) && 'default' !== $settings->skins ) {
	if ( $global_settings->responsive_enabled ) {
		?>
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
			<?php
			if ( isset( $settings->column_gap_medium ) ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
					<?php
					echo ( '' !== $settings->column_gap_medium ) ? 'margin-right:calc(' . esc_attr( $settings->column_gap_medium ) / 2 . 'px);' : 'margin-right:calc( 10px/2 );';
					echo ( '' !== $settings->column_gap_medium ) ? 'margin-left:calc(' . esc_attr( $settings->column_gap_medium ) / 2 . 'px);' : 'margin-left:calc( 10px/2 );';
					?>
				}
				<?php
			}
			if ( isset( $settings->row_gap_medium ) ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
					<?php
					if ( isset( $settings->row_gap_medium ) ) {
						echo ( '' !== $settings->row_gap_medium ) ? 'margin-bottom:' . esc_attr( $settings->row_gap_medium ) . 'px;' : '';
					}
					?>
				}
				<?php
			}
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ss-icon i {
				<?php
				if ( isset( $settings->icon_img_size_medium ) ) {
					echo ( '' !== $settings->icon_img_size_medium ) ? 'font-size:' . esc_attr( $settings->icon_img_size_medium ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button {
				<?php
				if ( isset( $settings->button_height_medium ) ) {
					echo ( '' !== $settings->button_height_medium ) ? 'height:' . esc_attr( $settings->button_height_medium ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-style-floating {
				<?php
				if ( isset( $settings->floating_position_medium ) ) {
					echo ( '' !== $settings->floating_position_medium ) ? 'top:' . esc_attr( $settings->floating_position_medium ) . '%;' : '';
				}
				?>
			}
			.uabb-ss-column-medium-1 .uabb-ss-wrap {
				grid-template-columns: repeat(1,1fr);
				display: grid;
			}
			.uabb-ss-column-medium-2 .uabb-ss-wrap {
				grid-template-columns: repeat(2,1fr);
				display: grid;
			}
			.uabb-ss-column-medium-3 .uabb-ss-wrap {
				grid-template-columns: repeat(3,1fr);
				display: grid;
			}
			.uabb-ss-column-medium-4 .uabb-ss-wrap {
				grid-template-columns: repeat(4,1fr);
				display: grid;
			}
			.uabb-ss-column-medium-5 .uabb-ss-wrap {
				grid-template-columns: repeat(5,1fr);
				display: grid;
			}
			.uabb-ss-column-medium-6 .uabb-ss-wrap {
				grid-template-columns: repeat(6,1fr);
				display: grid;
			} 
			.uabb-ss-wrap.uabb-ss-medium-align-right {
				-webkit-box-pack: end;
					-ms-flex-pack: end;
						justify-content: flex-end;
			}

			.uabb-ss-wrap.uabb-ss-medium-align-left {
				-webkit-box-pack: start;
					-ms-flex-pack: start;
						justify-content: flex-start;
			}

			.uabb-ss-wrap.uabb-ss-medium-align-center {
				-webkit-box-pack: center;
					-ms-flex-pack: center;
						justify-content: center;
			}
		}
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
			<?php
			if ( isset( $settings->column_gap_responsive ) ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
					<?php
					echo ( '' !== $settings->column_gap_responsive ) ? 'margin-right:calc(' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px);' : 'margin-right:calc( 10px/2 );';
					echo ( '' !== $settings->column_gap_responsive ) ? 'margin-left:calc(' . esc_attr( $settings->column_gap_responsive ) / 2 . 'px);' : 'margin-left:calc( 10px/2 );';
					?>
				}
				<?php
			}
			if ( isset( $settings->row_gap_responsive ) ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-item {
					<?php
					if ( isset( $settings->row_gap_responsive ) ) {
						echo ( '' !== $settings->row_gap_responsive ) ? 'margin-bottom:' . esc_attr( $settings->row_gap_responsive ) . 'px;' : '';
					}
					?>
				}
				<?php
			}
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ss-icon i {
				<?php
				if ( isset( $settings->icon_img_size_responsive ) ) {
					echo ( '' !== $settings->icon_img_size_responsive ) ? 'font-size:' . esc_attr( $settings->icon_img_size_responsive ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button {
				<?php
				if ( isset( $settings->button_height_responsive ) ) {
					echo ( '' !== $settings->button_height_responsive ) ? 'height:' . esc_attr( $settings->button_height_responsive ) . 'px;' : '';
				}
				?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-style-floating {
				<?php
				if ( isset( $settings->floating_position_responsive ) ) {
					echo ( '' !== $settings->floating_position_responsive ) ? 'top:' . esc_attr( $settings->floating_position_responsive ) . '%;' : '';
				}
				?>
			}
			<?php if ( isset( $settings->text_hide_mobile ) && 'yes' === $settings->text_hide_mobile && 'icon-text' === $settings->share_view ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-social-share-wrap .uabb-ss-grid-button .uabb-ss-button-text {
				display: none;
			}
			<?php } ?>
			.uabb-ss-column-responsive-1 .uabb-ss-wrap {
				grid-template-columns: repeat(1,1fr);
				display: grid;
			}
			.uabb-ss-column-responsive-2 .uabb-ss-wrap {
				grid-template-columns: repeat(2,1fr);
				display: grid;
			}
			.uabb-ss-column-responsive-3 .uabb-ss-wrap {
				grid-template-columns: repeat(3,1fr);
				display: grid;
			}
			.uabb-ss-column-responsive-4 .uabb-ss-wrap {
				grid-template-columns: repeat(4,1fr);
				display: grid;
			}
			.uabb-ss-column-responsive-5 .uabb-ss-wrap {
				grid-template-columns: repeat(5,1fr);
				display: grid;
			}
			.uabb-ss-column-responsive-6 .uabb-ss-wrap {
				grid-template-columns: repeat(6,1fr);
				display: grid;
			}
			.uabb-ss-wrap.uabb-ss-responsive-align-right {
				-webkit-box-pack: end;
					-ms-flex-pack: end;
						justify-content: flex-end;
			}

			.uabb-ss-wrap.uabb-ss-responsive-align-left {
				-webkit-box-pack: start;
					-ms-flex-pack: start;
						justify-content: flex-start;
			}

			.uabb-ss-wrap.uabb-ss-responsive-align-center {
				-webkit-box-pack: center;
					-ms-flex-pack: center;
						justify-content: center;
			}
		}
	<?php }
} ?>
