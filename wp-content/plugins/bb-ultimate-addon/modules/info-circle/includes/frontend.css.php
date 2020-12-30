<?php
/**
 * Register the module's CSS file for Info Circle module
 *
 * @package UABB Info Circle Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->connector_border_color     = UABB_Helper::uabb_colorpicker( $settings, 'connector_border_color' );
$settings->outer_bg_color             = UABB_Helper::uabb_colorpicker( $settings, 'outer_bg_color', true );
$settings->thumb_border_color         = UABB_Helper::uabb_colorpicker( $settings, 'thumb_border_color' );
$settings->thumb_active_border_color  = UABB_Helper::uabb_colorpicker( $settings, 'thumb_active_border_color' );
$settings->info_icon_img_border_color = UABB_Helper::uabb_colorpicker( $settings, 'info_icon_img_border_color' );
$settings->info_bg_color              = UABB_Helper::uabb_colorpicker( $settings, 'info_bg_color', true );
$settings->thumb_active_border_color  = UABB_Helper::uabb_colorpicker( $settings, 'thumb_active_border_color' );
$settings->info_separator_color       = UABB_Helper::uabb_colorpicker( $settings, 'info_separator_color' );

$settings->color      = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );


/* Set default color */
$settings->connector_border_color = uabb_theme_base_color( $settings->connector_border_color );
$settings->info_separator_color   = uabb_theme_base_color( $settings->info_separator_color );

$settings->thumb_border_color         = ( '' !== $settings->thumb_border_color ) ? $settings->thumb_border_color : '#EFEFEF';
$settings->thumb_active_border_color  = ( '' !== $settings->thumb_active_border_color ) ? $settings->thumb_active_border_color : '#EFEFEF';
$settings->icon_img_size              = ( '' !== trim( $settings->icon_img_size ) ) ? $settings->icon_img_size : '60';
$settings->thumbnail_size             = ( '' !== trim( $settings->thumbnail_size ) ) ? $settings->thumbnail_size : '80';
$settings->thumb_custom_radius        = '' !== trim( $settings->thumb_custom_radius ) ? $settings->thumb_custom_radius : '0';
$settings->info_icon_img_border_width = '' !== trim( $settings->info_icon_img_border_width ) ? $settings->info_icon_img_border_width : '1';
$responsive_breakpoint                = '' !== trim( $settings->breakpoint ) ? $settings->breakpoint : $global_settings->medium_breakpoint;

$circle_item_count = 0;
$total_circle      = count( $settings->add_circle_item );

$angle_init = trim( $settings->first_thumb_pos ) > 0 ? $settings->first_thumb_pos : 0;
$angle_gap  = 360 / $total_circle;

foreach ( $settings->add_circle_item as $item ) {

	if ( ! is_object( $item ) ) {
		continue; }

	$circle_item_count++;
	$item->btn_color = UABB_Helper::uabb_colorpicker( $item, 'btn_color' );

	$imageicon_array = array(

		/* General Section */
		'image_type'              => $item->image_type,

		/* Icon Basics */
		'icon'                    => $item->icon,
		'icon_align'              => 'center',
		'icon_style'              => $settings->thumb_style,
		'icon_bg_border_radius'   => $settings->thumb_custom_radius,
		'icon_size'               => $settings->thumbnail_size / 2,

		/* Image Basics */
		'photo_source'            => $item->photo_source,
		'photo'                   => $item->photo,
		'photo_url'               => $item->photo_url,
		'img_align'               => 'center',
		'img_size'                => $settings->thumbnail_size,
		'image_style'             => $settings->thumb_style,
		'img_bg_border_radius'    => $settings->thumb_custom_radius,
		'img_bg_color'            => '',
		'img_border_style'        => 'none',
		'photo_src'               => ( isset( $item->photo_src ) ) ? $item->photo_src : '',

		/* Icon Colors */
		'icon_color'              => $item->icon_color,
		'icon_hover_color'        => $item->icon_hover_color,
		'icon_bg_color'           => $item->icon_bg_color,
		'icon_bg_color_opc'       => '',
		'icon_bg_hover_color'     => $item->icon_bg_hover_color,
		'icon_bg_hover_color_opc' => '',
		'icon_three_d'            => $item->icon_gradient,
		'icon_border_style'       => 'none',
	);

	/* CSS Render Function */
	FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-circle-' . $circle_item_count, $imageicon_array );


	/* Render Info Icon CSS Info Area Icon/Image */
	if ( 'no' !== $settings->info_area_icon ) {
		$settings->icon_img_border_radius = ( '' !== $settings->icon_img_border_radius ) ? $settings->icon_img_border_radius : '0';
		$info_imageicon_array             = array(

			/* General Section */
			'image_type'              => $item->image_type,

			/* Icon Basics */
			'icon'                    => $item->icon,
			'icon_align'              => 'center',
			'icon_style'              => $settings->info_area_icon,
			'icon_size'               => $settings->icon_img_size,

			/* Image Basics */
			'photo_source'            => $item->photo_source,
			'photo'                   => $item->photo,
			'photo_url'               => $item->photo_url,
			'img_align'               => 'center',
			'img_size'                => $settings->icon_img_size,
			'image_style'             => $settings->info_area_icon,
			'img_bg_color'            => $settings->icon_img_bg_color,
			'img_bg_size'             => $settings->icon_img_bg_padding,
			'img_border_style'        => $settings->info_icon_img_border_style,
			'img_border_width'        => $settings->info_icon_img_border_width,
			'img_border_color'        => $settings->info_icon_img_border_color,
			'img_bg_border_radius'    => $settings->icon_img_border_radius,
			'photo_src'               => ( isset( $item->photo_src ) ) ? $item->photo_src : '',

			/* Icon Colors */
			'icon_color'              => $settings->icon_img_color,
			'icon_hover_color'        => $settings->icon_img_color, // Hover color same as normal.
			'icon_bg_color'           => $settings->icon_img_bg_color,
			'icon_bg_color_opc'       => ( isset( $settings->icon_img_bg_color_opc ) ) ? $settings->icon_img_bg_color_opc : '',
			'icon_bg_hover_color'     => $settings->icon_img_bg_color,  // Hover bg color same as normal.
			'icon_bg_hover_color_opc' => ( isset( $settings->icon_img_bg_color_opc ) ) ? $settings->icon_img_bg_color_opc : '',  // Hover bg color same as normal.
			'icon_bg_size'            => $settings->icon_img_bg_padding,
			'icon_bg_border_radius'   => $settings->icon_img_border_radius,
			'icon_border_style'       => $settings->info_icon_img_border_style,
			'icon_border_width'       => $settings->info_icon_img_border_width,
			'icon_border_color'       => $settings->info_icon_img_border_color,
		);

		/* CSS Render Function */
		FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-info-circle-in-' . $circle_item_count, $info_imageicon_array );
	}

	if ( 'desc' === $item->cta || 'both' === $item->cta ) :
		/* Render Button Style */
		if ( 'button' === $item->desc_cta_type ) {
			if ( ! $version_bb_check ) {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $item->cta_text,

					/* Link Section */
					'link'                                 => $item->cta_link,
					'link_target'                          => $item->cta_link_target,

					/* Style Section */
					'style'                                => $item->btn_style,
					'border_size'                          => $item->btn_border_size,
					'transparent_button_options'           => $item->btn_transparent_button_options,
					'threed_button_options'                => $item->btn_threed_button_options,
					'flat_button_options'                  => $item->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $item->btn_bg_color,
					'bg_hover_color'                       => $item->btn_bg_hover_color,
					'bg_color_opc'                         => $item->btn_bg_color_opc,
					'bg_hover_color_opc'                   => $item->btn_bg_hover_color_opc,
					'text_color'                           => $item->btn_text_color,
					'text_hover_color'                     => $item->btn_text_hover_color,
					'hover_attribute'                      => $item->hover_attribute,

					/* Icon */
					'icon'                                 => $item->btn_icon,
					'icon_position'                        => $item->btn_icon_position,

					/* Structure */
					'width'                                => $item->btn_width,
					'custom_width'                         => $item->btn_custom_width,
					'custom_height'                        => $item->btn_custom_height,
					'padding_top_bottom'                   => $item->btn_padding_top_bottom,
					'padding_left_right'                   => $item->btn_padding_left_right,
					'border_radius'                        => $item->btn_border_radius,
					'align'                                => 'center',
					'mob_align'                            => 'center',

					/* Typography */
					'font_size'                            => ( isset( $item->btn_font_size ) ) ? $item->btn_font_size : '',
					'line_height'                          => ( isset( $item->btn_line_height ) ) ? $item->btn_line_height : '',
					'font_size_unit'                       => $item->btn_font_size_unit,
					'line_height_unit'                     => $item->btn_line_height_unit,
					'font_size_unit_medium'                => $item->btn_font_size_unit_medium,
					'line_height_unit_medium'              => $item->btn_line_height_unit_medium,
					'font_size_unit_responsive'            => $item->btn_font_size_unit_responsive,
					'line_height_unit_responsive'          => $item->btn_line_height_unit_responsive,
					'font_family'                          => $item->btn_font_family,
					'transform'                            => $item->btn_transform,
					'letter_spacing'                       => $item->btn_letter_spacing,

					'button_padding_dimension_top'         => ( isset( $item->button_padding_dimension_top ) ) ? $item->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $item->button_padding_dimension_left ) ) ? $item->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $item->button_padding_dimension_bottom ) ) ? $item->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $item->button_padding_dimension_right ) ) ? $item->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $item->button_padding_dimension_top_medium ) ) ? $item->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $item->button_padding_dimension_left_medium ) ) ? $item->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $item->button_padding_dimension_bottom_medium ) ) ? $item->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $item->button_padding_dimension_right_medium ) ) ? $item->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $item->button_padding_dimension_top_responsive ) ) ? $item->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $item->button_padding_dimension_left_responsive ) ) ? $item->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $item->button_padding_dimension_bottom_responsive ) ) ? $item->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $item->button_padding_dimension_right_responsive ) ) ? $item->button_padding_dimension_right_responsive : '',
					'button_border_style'                  => ( isset( $item->button_border_style ) ) ? $item->button_border_style : '',
					'button_border_width'                  => ( isset( $item->button_border_width ) ) ? $item->button_border_width : '',
					'button_border_radius'                 => ( isset( $item->button_border_radius ) ) ? $item->button_border_radius : '',
					'button_border_color'                  => ( isset( $item->button_border_color ) ) ? $item->button_border_color : '',

					'border_hover_color'                   => ( isset( $item->border_hover_color ) ) ? $item->border_hover_color : '',
				);
			} else {
				$btn_settings = array(

					/* General Section */
					'text'                                 => $item->cta_text,

					/* Link Section */
					'link'                                 => $item->cta_link,
					'link_target'                          => $item->cta_link_target,

					/* Style Section */
					'style'                                => $item->btn_style,
					'border_size'                          => $item->btn_border_size,
					'transparent_button_options'           => $item->btn_transparent_button_options,
					'threed_button_options'                => $item->btn_threed_button_options,
					'flat_button_options'                  => $item->btn_flat_button_options,

					/* Colors */
					'bg_color'                             => $item->btn_bg_color,
					'bg_hover_color'                       => $item->btn_bg_hover_color,
					'text_color'                           => $item->btn_text_color,
					'text_hover_color'                     => $item->btn_text_hover_color,
					'hover_attribute'                      => $item->hover_attribute,

					/* Icon */
					'icon'                                 => $item->btn_icon,
					'icon_position'                        => $item->btn_icon_position,

					/* Structure */
					'width'                                => $item->btn_width,
					'custom_width'                         => $item->btn_custom_width,
					'custom_height'                        => $item->btn_custom_height,
					'padding_top_bottom'                   => $item->btn_padding_top_bottom,
					'padding_left_right'                   => $item->btn_padding_left_right,
					'border_radius'                        => $item->btn_border_radius,
					'align'                                => 'center',
					'mob_align'                            => 'center',

					/* Typography */
					'font_size'                            => ( isset( $item->btn_font_size ) ) ? $item->btn_font_size : '',
					'line_height'                          => ( isset( $item->btn_line_height ) ) ? $item->btn_line_height : '',
					'button_typo'                          => ( isset( $item->btn_font_typo ) ) ? $item->btn_font_typo : '',
					'button_typo_medium'                   => ( isset( $item->btn_font_typo_medium ) ) ? $item->btn_font_typo_medium : '',
					'button_typo_responsive'               => ( isset( $item->btn_font_typo_responsive ) ) ? $item->btn_font_typo_responsive : '',
					'button_padding_dimension_top'         => ( isset( $item->button_padding_dimension_top ) ) ? $item->button_padding_dimension_top : '',
					'button_padding_dimension_left'        => ( isset( $item->button_padding_dimension_left ) ) ? $item->button_padding_dimension_left : '',
					'button_padding_dimension_bottom'      => ( isset( $item->button_padding_dimension_bottom ) ) ? $item->button_padding_dimension_bottom : '',
					'button_padding_dimension_right'       => ( isset( $item->button_padding_dimension_right ) ) ? $item->button_padding_dimension_right : '',
					'button_padding_dimension_top_medium'  => ( isset( $item->button_padding_dimension_top_medium ) ) ? $item->button_padding_dimension_top_medium : '',
					'button_padding_dimension_left_medium' => ( isset( $item->button_padding_dimension_left_medium ) ) ? $item->button_padding_dimension_left_medium : '',
					'button_padding_dimension_bottom_medium' => ( isset( $item->button_padding_dimension_bottom_medium ) ) ? $item->button_padding_dimension_bottom_medium : '',
					'button_padding_dimension_right_medium' => ( isset( $item->button_padding_dimension_right_medium ) ) ? $item->button_padding_dimension_right_medium : '',
					'button_padding_dimension_top_responsive' => ( isset( $item->button_padding_dimension_top_responsive ) ) ? $item->button_padding_dimension_top_responsive : '',
					'button_padding_dimension_left_responsive' => ( isset( $item->button_padding_dimension_left_responsive ) ) ? $item->button_padding_dimension_left_responsive : '',
					'button_padding_dimension_bottom_responsive' => ( isset( $item->button_padding_dimension_bottom_responsive ) ) ? $item->button_padding_dimension_bottom_responsive : '',
					'button_padding_dimension_right_responsive' => ( isset( $item->button_padding_dimension_right_responsive ) ) ? $item->button_padding_dimension_right_responsive : '',
					'button_border'                        => ( isset( $item->button_border ) ) ? $item->button_border : '',
					'border_hover_color'                   => ( isset( $item->border_hover_color ) ) ? $item->border_hover_color : '',
				);
			}
			FLBuilder::render_module_css( 'uabb-button', $id . ' .uabb-info-circle-in-' . $circle_item_count, $btn_settings );
		} else { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> .uabb-info-circle-cta-text .uabb-infoc-link {
				<?php if ( '' !== $item->btn_color ) : ?>
					color: <?php echo esc_attr( $item->btn_color ); ?>;
				<?php endif; ?>
			}
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> .uabb-info-circle-cta-text .uabb-infoc-link {
					<?php if ( 'Default' !== $item->btn_font_family->family ) : ?>
					font-family: <?php echo esc_attr( $item->btn_font_family->family ); ?>;
							<?php if ( 'regular' !== $item->btn_font_family->weight ) : ?>
							font-weight: <?php echo esc_attr( $item->btn_font_family->weight ); ?>;
							<?php endif; ?>
					<?php endif; ?>
					<?php if ( 'yes' === $converted || isset( $item->btn_font_size_unit ) && '' !== $item->btn_font_size_unit ) { ?>
						font-size: <?php echo esc_attr( $item->btn_font_size_unit ); ?>px;
					<?php } elseif ( isset( $item->btn_font_size_unit ) && '' === $item->btn_font_size_unit && isset( $item->btn_font_size->desktop ) && '' !== $item->btn_font_size->desktop ) { ?>
						font-size: <?php echo esc_attr( $item->btn_font_size->desktop ); ?>px;
					<?php } ?>

					<?php if ( isset( $item->btn_font_size->desktop ) && '' === $item->btn_font_size->desktop && isset( $item->btn_line_height->desktop ) && '' !== $item->btn_line_height->desktop && '' === $item->btn_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $item->btn_line_height->desktop ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $item->btn_line_height_unit ) && '' !== $item->btn_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $item->btn_line_height_unit ); ?>em;
					<?php } elseif ( isset( $item->btn_line_height_unit ) && '' === $item->btn_line_height_unit && isset( $item->btn_line_height->desktop ) && '' !== $item->btn_line_height->desktop ) { ?>
						line-height: <?php echo esc_attr( $item->btn_line_height->desktop ); ?>px;
					<?php } ?>

					<?php if ( 'none' !== $item->btn_transform ) : ?>
						text-transform: <?php echo esc_attr( $item->btn_transform ); ?>;
					<?php endif; ?>

					<?php if ( '' !== $item->btn_letter_spacing ) : ?>
						letter-spacing: <?php echo esc_attr( $item->btn_letter_spacing ); ?>px;
					<?php endif; ?>
				}
				<?php
			} else {
				if ( class_exists( 'FLBuilderCSS' ) ) {
					FLBuilderCSS::typography_field_rule(
						array(
							'settings'     => $item,
							'setting_name' => 'btn_font_typo',
							'selector'     => ".fl-node-$id .uabb-info-circle-cta-text .uabb-infoc-link",
						)
					);

				}
			}
			?>
			/* Responsive CSS for CTA Text */
			<?php if ( $global_settings->responsive_enabled ) { ?>

				@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> .uabb-info-circle-cta-text .uabb-infoc-link {

							<?php if ( 'yes' === $converted || isset( $item->btn_font_size_unit_medium ) && '' !== $item->btn_font_size_unit_medium ) { ?>
								font-size: <?php echo esc_attr( $item->btn_font_size_unit_medium ); ?>px;
								<?php if ( '' !== $item->btn_line_height_unit_medium && '' !== $item->btn_font_size_unit_medium ) { ?>
									line-height: <?php $item->btn_font_size_unit_medium + 2; ?>px;
								<?php } ?>
							<?php } elseif ( isset( $item->btn_font_size_unit_medium ) && '' === $item->btn_font_size_unit_medium && isset( $item->btn_font_size->medium ) && '' !== $item->btn_font_size->medium ) { ?>
								font-size: <?php echo esc_attr( $item->btn_font_size->medium ); ?>px;
								line-height: <?php $item->btn_font_size->medium + 2; ?>px;
							<?php } ?>

							<?php if ( isset( $item->btn_font_size->medium ) && '' === $item->btn_font_size->medium && isset( $item->btn_line_height->medium ) && '' !== $item->btn_line_height->medium && '' === $item->btn_line_height_unit && '' === $item->btn_line_height_unit_medium ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height->medium ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $item->btn_line_height_unit_medium ) && '' !== $item->btn_line_height_unit_medium ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height_unit_medium ); ?>em;
							<?php } elseif ( isset( $item->btn_line_height_unit_medium ) && '' === $item->btn_line_height_unit_medium && isset( $item->btn_line_height->medium ) && '' !== $item->btn_line_height->medium ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height->medium ); ?>px;
							<?php } ?>
						}
					<?php } ?>
				}

				@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> .uabb-info-circle-cta-text .uabb-infoc-link {

							<?php if ( 'yes' === $converted || isset( $item->btn_font_size_unit_responsive ) && '' !== $item->btn_font_size_unit_responsive ) { ?>
								font-size: <?php echo esc_attr( $item->btn_font_size_unit_responsive ); ?>px;
								<?php if ( '' === $item->btn_line_height_unit_responsive && '' !== $item->btn_font_size_unit_responsive ) { ?>
									line-height: <?php echo esc_attr( $item->btn_font_size_unit_responsive + 2 ); ?>px;
								<?php } ?>
							<?php } elseif ( isset( $item->btn_font_size_unit_responsive ) && '' === $item->btn_font_size_unit_responsive && isset( $item->btn_font_size->small ) && '' !== $item->btn_font_size->small ) { ?>
								font-size: <?php echo esc_attr( $item->btn_font_size->small ); ?>px;
								line-height: <?php echo esc_attr( $item->btn_font_size->small + 2 ); ?>px;
							<?php } ?>

							<?php if ( isset( $item->btn_font_size->small ) && '' === $item->btn_font_size->small && isset( $item->btn_line_height->small ) && '' !== $item->btn_line_height->small && '' === $item->btn_line_height_unit && '' === $item->btn_line_height_unit_medium && '' === $item->btn_line_height_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height->small ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $item->btn_line_height_unit_responsive ) && '' !== $item->btn_line_height_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height_unit_responsive ); ?>em;
							<?php } elseif ( isset( $item->btn_line_height_unit_responsive ) && '' === $item->btn_line_height_unit_responsive && isset( $item->btn_line_height->small ) && '' !== $item->btn_line_height->small ) { ?>
								line-height: <?php echo esc_attr( $item->btn_line_height->small ); ?>px;
							<?php } ?>
						}
				<?php } ?>
				}
				<?php
			}
		}

	endif;

	$item->inner_circle_bg_color   = UABB_Helper::uabb_colorpicker( $item, 'inner_circle_bg_color', true );
	$item->icon_hover_color        = UABB_Helper::uabb_colorpicker( $item, 'icon_hover_color' );
	$item->icon_bg_hover_color     = UABB_Helper::uabb_colorpicker( $item, 'icon_bg_hover_color' );
	$item->separator_color         = UABB_Helper::uabb_colorpicker( $item, 'separator_color' );
	$item->inner_circle_bg_overlay = UABB_Helper::uabb_colorpicker( $item, 'inner_circle_bg_overlay' );


	/* Calculate & Set Info Circle Coordinates */
	$angle = ( $angle_init - 90 ) * M_PI / 180;

	$x = 50 + ( 40 * cos( $angle ) );
	$y = 50 + ( 40 * sin( $angle ) );

	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .active .uabb-circle-<?php echo esc_attr( $circle_item_count ); ?> .uabb-icon i,
	.fl-node-<?php echo esc_attr( $id ); ?> .active .uabb-circle-<?php echo esc_attr( $circle_item_count ); ?> .uabb-icon i:before {
		<?php if ( $item->icon_gradient ) { ?>
			<?php

			$bg_hover_color = ( ! empty( $item->icon_bg_hover_color ) ) ? uabb_parse_color_to_hex( $item->icon_bg_hover_color ) : uabb_parse_color_to_hex( $item->icon_bg_hover_color );
			$bg_grad_start  = '#' . FLBuilderColor::adjust_brightness( $bg_hover_color, 40, 'lighten' );
			?>

		/* Gradient Style */
		background: -moz-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%, <?php echo esc_attr( $item->icon_bg_hover_color ); ?> 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr( $bg_grad_start ); ?>), color-stop(100%,<?php echo esc_attr( $item->icon_bg_hover_color ); ?>)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $item->icon_bg_hover_color ); ?> 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $item->icon_bg_hover_color ); ?> 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $item->icon_bg_hover_color ); ?> 100%); /* IE10+ */
		background: linear-gradient(to bottom,  <?php echo esc_attr( $bg_grad_start ); ?> 0%,<?php echo esc_attr( $item->icon_bg_hover_color ); ?> 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo esc_attr( $bg_grad_start ); ?>', endColorstr='<?php echo esc_attr( $item->icon_bg_hover_color ); ?>',GradientType=0 ); /* IE6-9 */
		<?php } else { ?>
		background: <?php echo esc_attr( $item->icon_bg_hover_color ); ?>;
		<?php } ?>
		color: <?php echo esc_attr( $item->icon_hover_color ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-circle-<?php echo esc_attr( $circle_item_count ); ?> {
		left: <?php echo esc_attr( $x ); ?>%;
		top: <?php echo esc_attr( $y ); ?>%;
	}
	<?php /* Information Circle Background Color */ ?>
	<?php if ( 'none' !== $settings->info_separator_style ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> .uabb-ic-separator {
		border-color: <?php echo esc_attr( $item->separator_color ); ?>;
	}
	<?php endif; ?>

	<?php
	/* Information Circle Background Color for Responsive from Outer Background Options for fallback */
	if ( 'true' === $settings->responsive_nature ) :
		?>
		<?php $responsive_bg_set = false; ?>
	@media ( max-width: <?php echo esc_attr( $responsive_breakpoint ) . 'px'; ?> ) {
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-<?php echo esc_attr( $circle_item_count ); ?> {

			<?php
			if ( 'custom' === $settings->content_width ) : // If Inner global Color not exists.
				if ( 'color' === $settings->outer_bg_type ) :
					?>
					background-color: <?php echo esc_attr( $settings->outer_bg_color ); ?>;
				<?php elseif ( 'image' === $settings->outer_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->outer_bg_img )->url ) ) : ?>
					background-image: url(
					<?php echo esc_url( FLBuilderPhoto::get_attachment_data( $settings->outer_bg_img )->url ); ?>
					);
					background-position: <?php echo esc_attr( $settings->outer_bg_img_pos ); ?>;
					background-size: <?php echo esc_attr( $settings->outer_bg_img_size ); ?>;
					background-repeat: <?php echo esc_attr( $settings->outer_bg_img_repeat ); ?>;
				<?php endif; ?>
			<?php endif; ?>
		}
	}
	<?php endif; ?>

	<?php
	/* Information Circle Background Color */
	if ( 'color' === $item->inner_circle_bg_type && '' !== $item->inner_circle_bg_color ) :
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> {
			background-color: <?php echo esc_attr( $item->inner_circle_bg_color ); ?>;
		}

		<?php
		/* Information Circle Background Color for Responsive */
		if ( 'true' === $settings->responsive_nature ) :
			?>
			@media ( max-width: <?php echo esc_attr( $responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-<?php echo esc_attr( $circle_item_count ); ?> {
					background: <?php echo esc_attr( $item->inner_circle_bg_color ); ?>;
				}
			}
		<?php endif; ?>

		<?php
		/* Information Circle Background Image */
		elseif ( 'image' === $item->inner_circle_bg_type && '' !== FLBuilderPhoto::get_attachment_data( $item->inner_circle_bg_img )->url ) :
			?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> {
			background-image: url(
			<?php echo esc_url( FLBuilderPhoto::get_attachment_data( $item->inner_circle_bg_img )->url ); ?>);
			background-position: <?php echo esc_attr( $item->inner_circle_bg_img_pos ); ?>;
			background-size: <?php echo esc_attr( $item->inner_circle_bg_img_size ); ?>;
			background-repeat: <?php echo esc_attr( $item->inner_circle_bg_img_repeat ); ?>;
		}

			<?php if ( isset( $item->inner_circle_bg_overlay ) && '' !== $item->inner_circle_bg_overlay ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle.uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?>:before{
				content: '';
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				background:<?php echo esc_attr( $item->inner_circle_bg_overlay ); ?>;
			}
		<?php endif; ?>
			<?php
			/* Information Circle Background Image for Responsive */
			if ( 'true' === $settings->responsive_nature ) :
				?>
			@media ( max-width: <?php echo esc_attr( $responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-<?php echo esc_attr( $circle_item_count ); ?> {
					background: url( <?php echo esc_url( FLBuilderPhoto::get_attachment_data( $item->inner_circle_bg_img )->url ); ?> );
					background-position: <?php echo esc_attr( $item->inner_circle_bg_img_pos ); ?>;
					background-size: <?php echo esc_attr( $item->inner_circle_bg_img_size ); ?>;
					background-repeat: <?php echo esc_attr( $item->inner_circle_bg_img_repeat ); ?>;
					position:relative;
				}
				<?php if ( isset( $item->inner_circle_bg_overlay ) && '' !== $item->inner_circle_bg_overlay ) : ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-<?php echo esc_attr( $circle_item_count ); ?>:before{
						content: '';
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						background:<?php echo esc_attr( $item->inner_circle_bg_overlay ); ?>;
					}
				<?php endif; ?>
			}
		<?php endif; ?>
			<?php
			/* Information Circle Background Global Color */
		elseif ( '' !== $settings->info_bg_color ) :
			?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in-<?php echo esc_attr( $circle_item_count ); ?> {
			background-color: <?php echo esc_attr( $settings->info_bg_color ); ?>;
		}
			<?php
			/* Information Circle Background Image for Responsive */
			if ( 'true' === $settings->responsive_nature ) :
				?>
			@media ( max-width: <?php echo esc_attr( $responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-<?php echo esc_attr( $circle_item_count ); ?> {
					background: <?php echo esc_attr( $settings->info_bg_color ); ?>;
				}
			}
		<?php endif; ?>

	<?php endif; ?>


	<?php
	$angle_init += $angle_gap;
} /* End Foreach */
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap .uabb-info-circle-content {

	<?php
	if ( 'yes' === $converted || isset( $settings->info_area_spacing_dimension_top ) && isset( $settings->info_area_spacing_dimension_bottom ) && isset( $settings->info_area_spacing_dimension_left ) && isset( $settings->info_area_spacing_dimension_right ) ) {
		if ( isset( $settings->info_area_spacing_dimension_top ) ) {
			echo ( '' !== $settings->info_area_spacing_dimension_top ) ? 'padding-top:' . esc_attr( $settings->info_area_spacing_dimension_top ) . 'px;' : 'padding-top: 25px;';
		}
		if ( isset( $settings->info_area_spacing_dimension_bottom ) ) {
			echo ( '' !== $settings->info_area_spacing_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->info_area_spacing_dimension_bottom ) . 'px;' : 'padding-bottom: 25px;';
		}
		if ( isset( $settings->info_area_spacing_dimension_left ) ) {
			echo ( '' !== $settings->info_area_spacing_dimension_left ) ? 'padding-left:' . esc_attr( $settings->info_area_spacing_dimension_left ) . 'px;' : 'padding-left: 25px;';
		}
		if ( isset( $settings->info_area_spacing_dimension_right ) ) {
			echo ( '' !== $settings->info_area_spacing_dimension_right ) ? 'padding-right:' . esc_attr( $settings->info_area_spacing_dimension_right ) . 'px;' : 'padding-right: 25px;';
		}
	} elseif ( isset( $settings->info_area_spacing ) && '' !== $settings->info_area_spacing && isset( $settings->info_area_spacing_dimension_top ) && '' === $settings->info_area_spacing_dimension_top && isset( $settings->info_area_spacing_dimension_bottom ) && '' === $settings->info_area_spacing_dimension_bottom && isset( $settings->info_area_spacing_dimension_left ) && '' === $settings->info_area_spacing_dimension_left && isset( $settings->info_area_spacing_dimension_right ) && '' === $settings->info_area_spacing_dimension_right ) {
		?>
			<?php echo esc_attr( $settings->info_area_spacing ); ?>;
		<?php } ?>
}

<?php
/* Thumbnail Custom Style */
if ( 'custom' === $settings->thumb_style ) :
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i:before {
	line-height: <?php echo esc_attr( $settings->thumbnail_size ); ?>px;
	width: <?php echo esc_attr( $settings->thumbnail_size ); ?>px;
	height: <?php echo esc_attr( $settings->thumbnail_size ); ?>px;
}
<?php endif; ?>

<?php
/* Thumbnail Icon/Image Border Style */
if ( 'none' !== $settings->thumb_border_style ) :
	?>
	<?php $thumb_border_width = ( '' !== $settings->thumb_border_width ) ? $settings->thumb_border_width : '1'; ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-icon-wrap i,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
		box-sizing: content-box;
		border: <?php echo esc_attr( $thumb_border_width ) . 'px ' . esc_attr( $settings->thumb_border_style ) . ' ' . esc_attr( $settings->thumb_border_color ); ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .active .uabb-info-circle-small .uabb-icon-wrap i,
	.fl-node-<?php echo esc_attr( $id ); ?> .active .uabb-info-circle-small .uabb-image .uabb-photo-img {
		border-color: <?php echo esc_attr( $settings->thumb_active_border_color ); ?>;
	}

	<?php if ( 'solid' === $settings->thumb_border_style ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
		background-color: <?php echo esc_attr( $settings->thumb_border_color ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .active .uabb-info-circle-small .uabb-image .uabb-photo-img {
		background-color: <?php echo esc_attr( $settings->thumb_active_border_color ); ?>;
	}
	<?php endif; ?>

<?php endif; ?>

<?php
/* Connector Border Style */
if ( 'none' !== $settings->connector_border_style ) :
	$conn_border_width = ( '' !== $settings->connector_border_width ) ? $settings->connector_border_width : '1';
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap:before {
		border: <?php echo esc_attr( $conn_border_width ) . 'px ' . esc_attr( $settings->connector_border_style ) . ' ' . esc_attr( $settings->connector_border_color ); ?>;
	}
<?php endif; ?>

<?php
/* Outer Circle Background Color */
if ( 'custom' === $settings->content_width && 'color' === $settings->outer_bg_type ) :
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-out {
		background-color: <?php echo esc_attr( $settings->outer_bg_color ); ?>;
	}
	<?php
	/* Outer Circle Background Image */
	elseif ( 'image' === $settings->outer_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->outer_bg_img )->url ) ) :
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-out {
		background-image: url(
		<?php echo esc_url( FLBuilderPhoto::get_attachment_data( $settings->outer_bg_img )->url ); ?>);
		background-position: <?php echo esc_attr( $settings->outer_bg_img_pos ); ?>;
		background-size: <?php echo esc_attr( $settings->outer_bg_img_size ); ?>;
		background-repeat: <?php echo esc_attr( $settings->outer_bg_img_repeat ); ?>;
	}
<?php endif; ?>

<?php /* Information Circle Size */ ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in {
	<?php
		$inner_width = 80;
	if ( 'custom' === $settings->content_width ) {
		$inner_width  = ( trim( $settings->inner_area_size ) !== '' ) ? $settings->inner_area_size : '80';
		$inner_width  = ( $inner_width < 100 ) ? $inner_width : 100;
		$inner_width  = ( $inner_width >= 0 ) ? $inner_width : 80;
		$inner_width -= 20;
	}
	?>
	width: <?php echo esc_attr( $inner_width ); ?>%;
	height: <?php echo esc_attr( $inner_width ); ?>%;
}
<?php /* Information Separator */ ?>
<?php
if ( 'none' !== $settings->info_separator_style ) :
	$info_separator_height = ( trim( $settings->info_separator_height ) !== '' ) ? $settings->info_separator_height : '3';
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ic-separator {
		width: <?php echo ( trim( $settings->info_separator_width ) !== '' ) ? esc_attr( $settings->info_separator_width ) : '12'; ?>%;
		display: inline-block;
		border: 0;
		border-bottom: <?php echo esc_attr( $info_separator_height ) . 'px ' . esc_attr( $settings->info_separator_style ) . ' ' . esc_attr( $settings->info_separator_color ); ?>;
	}
<?php endif; ?>

<?php /* Information Circle Responsive Enabled */ ?>
<?php if ( 'true' === $settings->responsive_nature ) : ?>
	@media ( max-width: <?php echo esc_attr( $responsive_breakpoint ) . 'px'; ?> ) {

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle .uabb-imgicon-wrap .uabb-image {
			display: inline-block;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap {
			height: auto !important;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in {
			background: none;
			display: block !important;
			opacity: 1 !important;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in .uabb-info-circle-content {
			padding: 0;
		}

		<?php $responsive_width = trim( $settings->thumbnail_size_mobile ) !== '' ? $settings->thumbnail_size_mobile : '60'; ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-icon-wrap .uabb-icon i:before,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small .uabb-image .uabb-photo-img {
			font-size: <?php echo esc_attr( $responsive_width / 2 ); ?>px;
			line-height: <?php echo esc_attr( $responsive_width ); ?>px;
			height: <?php echo esc_attr( $responsive_width ); ?>px;
			width: <?php echo esc_attr( $responsive_width ); ?>px;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-icon-content {
			padding: 20px;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-icon-content:not(:last-child) {
			margin-bottom: 20px
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-content .uabb-imgicon-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-out,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap:before {
			display: none;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-in .uabb-info-circle-content {
			position: static;
			-webkit-transform: none;
			-ms-transform: none;
				transform: none;
			width: 100%;
			border-radius: 0;
			opacity: 1;
			-webkit-transition: none;
			transition: none;
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-small {
			margin-bottom: 15px;
		}
	}
<?php endif; ?>

<?php /* Typography for Info Circle Title */ ?>
.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->tag_selection ); ?>.uabb-info-circle-title {
	<?php if ( '' !== $settings->color ) : ?>
	color: <?php echo esc_attr( $settings->color ); ?>;
	<?php endif; ?>
	margin-top: <?php echo ( '' !== $settings->title_margin_top ) ? esc_attr( $settings->title_margin_top ) : 0; ?>px;
	margin-bottom: <?php echo ( '' !== $settings->title_margin_bottom ) ? esc_attr( $settings->title_margin_bottom ) : 20; ?>px;
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->tag_selection ); ?>.uabb-info-circle-title {
		<?php if ( 'Default' !== $settings->font_family['family'] ) : ?>
		font-family: <?php echo esc_attr( $settings->font_family['family'] ); ?>;
			<?php if ( 'regular' !== $settings->font_family['weight'] ) : ?>
				font-weight: <?php echo esc_attr( $settings->font_family['weight'] ); ?>;
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' === $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' !== $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->font_size['desktop'] ) && '' === $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] && '' === $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' === $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {

	$title_tag = '';
	if ( isset( $settings->tag_selection ) ) {
		$title_tag = $settings->tag_selection;
	}

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_font_typo',
				'selector'     => ".fl-node-$id $title_tag.uabb-info-circle-title",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-desc {
	<?php if ( '' !== $settings->desc_color ) : ?>
		color: <?php echo esc_attr( $settings->desc_color ); ?>;
	<?php endif; ?>
	margin-top: <?php echo ( '' !== $settings->desc_margin_top ) ? esc_attr( $settings->desc_margin_top ) : 20; ?>px;
	margin-bottom: <?php echo ( '' !== $settings->desc_margin_bottom ) ? esc_attr( $settings->desc_margin_bottom ) : 0; ?>px;
}
<?php /* Typography for Info Circle Description */ ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-desc {
		<?php if ( 'Default' !== $settings->desc_font_family['family'] ) : ?>
		font-family: <?php echo esc_attr( $settings->desc_font_family['family'] ); ?>;
			<?php if ( 'regular' !== $settings->desc_font_family['weight'] ) : ?>
				font-weight: <?php echo esc_attr( $settings->desc_font_family['weight'] ); ?>;
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit ) && '' !== $settings->desc_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->desc_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->desc_font_size_unit ) && '' === $settings->desc_font_size_unit && isset( $settings->desc_font_size['desktop'] ) && '' !== $settings->desc_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->desc_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->desc_font_size['desktop'] ) && '' === $settings->desc_font_size['desktop'] && isset( $settings->desc_line_height['desktop'] ) && '' !== $settings->desc_line_height['desktop'] && '' === $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit ) && '' !== $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->desc_line_height_unit ) && '' === $settings->desc_line_height_unit && isset( $settings->desc_line_height['desktop'] ) && '' !== $settings->desc_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->desc_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->desc_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->desc_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->desc_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->desc_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-info-circle-desc",
			)
		);
	}
}
?>
<?php /* Global Setting If started */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?>

		<?php /* Medium Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap .uabb-info-circle-content {
				<?php
				if ( isset( $settings->info_area_spacing_dimension_top_medium ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->info_area_spacing_dimension_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_bottom_medium ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->info_area_spacing_dimension_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_left_medium ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->info_area_spacing_dimension_left_medium ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_right_medium ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->info_area_spacing_dimension_right_medium ) . 'px;' : '';
				}
				?>
			}

			/* Info Circle Title */
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->tag_selection ); ?>.uabb-info-circle-title {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
						<?php if ( '' === $settings->line_height_unit_medium && '' !== $settings->font_size_unit_medium ) { ?>
							line-height: <?php $settings->font_size_unit_medium + 2; ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' === $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' !== $settings->font_size['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['medium'] ); ?>px;
						line-height: <?php $settings->font_size['medium'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size['medium'] ) && '' === $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] && '' === $settings->line_height_unit && '' === $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
					<?php } ?>

				}
			<?php } ?>
			/* Info Circle Description */
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-desc {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_medium ) && '' !== $settings->desc_font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_medium ) && '' === $settings->desc_font_size_unit_medium && isset( $settings->desc_font_size['medium'] ) && '' !== $settings->desc_font_size['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size['medium'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_font_size['medium'] ) && '' === $settings->desc_font_size['medium'] && isset( $settings->desc_line_height['medium'] ) && '' !== $settings->desc_line_height['medium'] && '' === $settings->desc_line_height_unit && '' === $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['medium'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_medium ) && '' !== $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height_unit_medium ); ?>em;
					<?php } elseif ( isset( $settings->desc_line_height_unit_medium ) && '' === $settings->desc_line_height_unit_medium && isset( $settings->desc_line_height['medium'] ) && '' !== $settings->desc_line_height['medium'] ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['medium'] ); ?>px;
					<?php } ?>
				}
			<?php } ?>
		}

		<?php /* Small Breakpoint media query */ ?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-wrap .uabb-info-circle-content {
				<?php
				if ( isset( $settings->info_area_spacing_dimension_top_responsive ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->info_area_spacing_dimension_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_bottom_responsive ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->info_area_spacing_dimension_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_left_responsive ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->info_area_spacing_dimension_left_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->info_area_spacing_dimension_right_responsive ) ) {
					echo ( '' !== $settings->info_area_spacing_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->info_area_spacing_dimension_right_responsive ) . 'px;' : '';
				}
				?>
			}

			/* Info Circle Title */
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->tag_selection ); ?>.uabb-info-circle-title {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
						<?php if ( '' === $settings->line_height_unit_responsive && '' !== $settings->font_size_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->font_size_unit_responsive + 2 ); ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' === $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' !== $settings->font_size['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['small'] ); ?>px;
						line-height: <?php echo esc_attr( $settings->font_size['small'] + 2 ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size['small'] ) && '' === $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] && '' === $settings->line_height_unit && '' !== $settings->line_height_unit_medium && '' === $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
					<?php } ?>
				}
			<?php } ?>

			/* Info Circle Description */
			<?php if ( ! $version_bb_check ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-info-circle-desc {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_responsive ) && '' !== $settings->desc_font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size_unit_responsive ); ?>px;
					<?php } elseif ( $settings->desc_font_size_unit_responsive && '' === $settings->desc_font_size_unit_responsive && isset( $settings->desc_font_size['small'] ) && '' !== $settings->desc_font_size['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size['small'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_font_size['small'] ) && '' === $settings->desc_font_size['small'] && isset( $settings->desc_line_height['small'] ) && '' !== $settings->desc_line_height['small'] && '' === $settings->desc_line_height_unit && '' === $settings->desc_line_height_unit_medium && '' === $settings->desc_line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['small'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_responsive ) && '' !== $settings->desc_line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->desc_line_height_unit_responsive ) && '' === $settings->desc_line_height_unit_responsive && isset( $settings->desc_line_height['small'] ) && '' !== $settings->desc_line_height['small'] ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['small'] ); ?>px;
					<?php } ?>

				}
		<?php } ?>
		}
	<?php
}
