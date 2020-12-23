<?php
/**
 *  UABB Hotspot Module front-end CSS php file
 *
 *   @package UABB Hotspot Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;
FLBuilder::render_module_css( 'uabb-button', $id, $settings->button );
$photo_src = ( 'url' !== $settings->photo_source ) ? ( ( isset( $settings->photo_src ) && '' !== $settings->photo_src ) ? $settings->photo_src : '' ) : ( ( '' !== $settings->photo_url ) ? $settings->photo_url : '' );

if ( isset( $settings->content_color ) ) {
	$settings->content_color = UABB_Helper::uabb_colorpicker( $settings, 'content_color' );
}
if ( isset( $settings->hotspot_hover_bgcolor ) ) {
	$settings->hotspot_hover_bgcolor = UABB_Helper::uabb_colorpicker( $settings, 'hotspot_hover_bgcolor' );
}
if ( isset( $settings->hotspot_color ) ) {
	$settings->hotspot_color = UABB_Helper::uabb_colorpicker( $settings, 'hotspot_color' );

}
if ( isset( $settings->hotspot_background_color ) ) {
	$settings->hotspot_background_color = UABB_Helper::uabb_colorpicker( $settings, 'hotspot_background_color' );
}

if ( 'click' === $settings->autoplay_options ) {
	( '' !== $settings->button ) ? FLBuilder::render_module_css( 'uabb-button', $id, $settings->button ) : '';
}

if ( '' !== $photo_src ) {
	if ( count( $settings->hotspot_marker ) > 0 ) {
		$count = count( $settings->hotspot_marker );
		for ( $i = 0; $i < $count; $i++ ) {

			$coordinate   = explode( ',', $settings->hotspot_marker[ $i ]->co_ordinates );
			$x_coordinate = ( isset( $coordinate[1] ) ) ? $coordinate[1] : '0';
			$y_coordinate = ( isset( $coordinate[0] ) ) ? $coordinate[0] : '0';

			$settings->hotspot_marker[ $i ]->tooltip_color                   = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'tooltip_color' );
			$settings->hotspot_marker[ $i ]->text_typography_color           = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'text_typography_color' );
			$settings->hotspot_marker[ $i ]->text_typography_active_color    = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'text_typography_active_color' );
			$settings->hotspot_marker[ $i ]->tooltip_bg_color                = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'tooltip_bg_color' );
			$settings->hotspot_marker[ $i ]->text_typography_bg_color        = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'text_typography_bg_color', true );
			$settings->hotspot_marker[ $i ]->text_typography_bg_active_color = UABB_Helper::uabb_colorpicker( $settings->hotspot_marker[ $i ], 'text_typography_bg_active_color', true );
			$settings->hotspot_marker[ $i ]->icon_size                       = ( '' !== $settings->hotspot_marker[ $i ]->icon_size ) ? $settings->hotspot_marker[ $i ]->icon_size : '30';
			if ( ! $version_bb_check ) {
				$settings->hotspot_marker[ $i ]->text_typography_line_height = ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height ) ) ? (array) $settings->hotspot_marker[ $i ]->text_typography_line_height : '';
				$settings->hotspot_marker[ $i ]->text_typography_font_size   = ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size ) ) ? (array) $settings->hotspot_marker[ $i ]->text_typography_font_size : '';
				$settings->hotspot_marker[ $i ]->text_typography_font_family = (array) $settings->hotspot_marker[ $i ]->text_typography_font_family;

				$settings->hotspot_marker[ $i ]->tooltip_line_height = ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height ) ) ? (array) $settings->hotspot_marker[ $i ]->tooltip_line_height : '';
				$settings->hotspot_marker[ $i ]->tooltip_font_size   = ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size ) ) ? (array) $settings->hotspot_marker[ $i ]->tooltip_font_size : '';
				$settings->hotspot_marker[ $i ]->tooltip_font_family = (array) $settings->hotspot_marker[ $i ]->tooltip_font_family;
			}
			if ( 'text' !== $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
				$imageicon_array = array(

					/* General Section */
					'image_type'              => $settings->hotspot_marker[ $i ]->hotspot_marker_type,

					/* Icon Basics */
					'icon'                    => $settings->hotspot_marker[ $i ]->icon,
					'icon_size'               => $settings->hotspot_marker[ $i ]->icon_size,
					'icon_align'              => '',

					/* Image Basics */
					'photo_source'            => $settings->hotspot_marker[ $i ]->photo_source,
					'photo'                   => $settings->hotspot_marker[ $i ]->photo,
					'photo_url'               => $settings->hotspot_marker[ $i ]->photo_url,
					'img_size'                => $settings->hotspot_marker[ $i ]->img_size,
					'img_align'               => '',
					'photo_src'               => ( isset( $settings->hotspot_marker[ $i ]->photo_src ) ) ? $settings->hotspot_marker[ $i ]->photo_src : '',

					/* Icon Style */
					'icon_style'              => $settings->hotspot_marker[ $i ]->icon_style,
					'icon_bg_size'            => $settings->hotspot_marker[ $i ]->icon_bg_size,
					'icon_border_style'       => $settings->hotspot_marker[ $i ]->icon_border_style,
					'icon_border_width'       => $settings->hotspot_marker[ $i ]->icon_border_width,
					'icon_bg_border_radius'   => $settings->hotspot_marker[ $i ]->icon_bg_border_radius,

					/* Image Style */
					'image_style'             => $settings->hotspot_marker[ $i ]->image_style,
					'img_bg_size'             => $settings->hotspot_marker[ $i ]->img_bg_size,
					'img_border_style'        => $settings->hotspot_marker[ $i ]->img_border_style,
					'img_border_width'        => $settings->hotspot_marker[ $i ]->img_border_width,
					'img_bg_border_radius'    => $settings->hotspot_marker[ $i ]->img_bg_border_radius,

					/* Preset Color variable new */
					'icon_color_preset'       => $settings->hotspot_marker[ $i ]->icon_color_preset,

					/* Icon Colors */
					'icon_color'              => $settings->hotspot_marker[ $i ]->icon_color,
					'icon_hover_color'        => $settings->hotspot_marker[ $i ]->icon_hover_color,
					'icon_bg_color'           => $settings->hotspot_marker[ $i ]->icon_bg_color,
					'icon_bg_hover_color'     => $settings->hotspot_marker[ $i ]->icon_bg_hover_color,
					'icon_bg_color_opc'       => $settings->hotspot_marker[ $i ]->icon_bg_color_opc,
					'icon_bg_hover_color_opc' => $settings->hotspot_marker[ $i ]->icon_bg_hover_color_opc,
					'icon_border_color'       => $settings->hotspot_marker[ $i ]->icon_border_color,
					'icon_border_hover_color' => $settings->hotspot_marker[ $i ]->icon_border_hover_color,
					'icon_three_d'            => $settings->hotspot_marker[ $i ]->icon_three_d,

					/* Image Colors */
					'img_bg_color'            => $settings->hotspot_marker[ $i ]->img_bg_color,
					'img_bg_color_opc'        => $settings->hotspot_marker[ $i ]->img_bg_color_opc,
					'img_bg_hover_color'      => $settings->hotspot_marker[ $i ]->img_bg_hover_color,
					'img_bg_hover_color_opc'  => $settings->hotspot_marker[ $i ]->img_bg_hover_color_opc,
					'img_border_color'        => $settings->hotspot_marker[ $i ]->img_border_color,
					'img_border_hover_color'  => $settings->hotspot_marker[ $i ]->img_border_hover_color,
				);

				/* CSS Render Function */

				FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-hotspot-item-' . $i, $imageicon_array );

				if ( 'yes' === $settings->hotspot_marker[ $i ]->show_animation ) {
					?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot .uabb-hotspot-hover .uabb-hotspot-wrap .uabb-imgicon-wrap {
					position: relative;
					z-index: 2;
				}
					<?php
				}
			}

			if ( 'text' === $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?>.uabb-hotspot-hover .uabb-hotspot-text {
					color: <?php echo esc_attr( uabb_theme_text_color( $settings->hotspot_marker[ $i ]->text_typography_active_color ) ); ?>;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?>:hover .uabb-hotspot-text {
					background: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->text_typography_bg_active_color ) ); ?>;
				}
				<?php
				if ( 'click' === $settings->hotspot_marker[ $i ]->tooltip_trigger_on ) {
					?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?>.uabb-hotspot-hover .uabb-hotspot-text {
					<?php
					$color = ( '' !== $settings->hotspot_marker[ $i ]->text_typography_active_color ) ? $settings->hotspot_marker[ $i ]->text_typography_active_color : $settings->hotspot_marker[ $i ]->text_typography_color;
					echo 'color: ' . esc_attr( uabb_theme_text_color( $color ) ) . ';';
					?>
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?>.uabb-hotspot-hover .uabb-hotspot-text {
					<?php
					$bg_color = ( '' !== $settings->hotspot_marker[ $i ]->text_typography_bg_active_color ) ? $settings->hotspot_marker[ $i ]->text_typography_bg_active_color : $settings->hotspot_marker[ $i ]->text_typography_bg_color;
					?>
					background: <?php echo esc_attr( uabb_theme_base_color( $bg_color ) ); ?>;
				}
					<?php
				}
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {
					<?php
						echo 'color: ' . esc_attr( uabb_theme_text_color( $settings->hotspot_marker[ $i ]->text_typography_color ) ) . ';';
					?>
				}
				<?php if ( ! $version_bb_check ) { ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {

						<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ) { ?>
							font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ); ?>px;	
						<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size_unit && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size['desktop'] ) { ?>
							font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size['desktop'] ); ?>px;
						<?php } ?>

						<?php if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['desktop'] ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size['desktop'] && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) { ?>
							line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] ); ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) { ?>
							line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ); ?>em;	
						<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] ) { ?>
							line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['desktop'] ); ?>px;
						<?php } ?>	

						<?php
						if ( 'Default' !== $settings->hotspot_marker[ $i ]->text_typography_font_family['family'] ) {
							UABB_Helper::uabb_font_css( $settings->hotspot_marker[ $i ]->text_typography_font_family );
						}
						?>

						<?php if ( 'none' !== $settings->hotspot_marker[ $i ]->text_typography_transform ) : ?>
							text-transform: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_transform ); ?>;
						<?php endif; ?>

						<?php if ( '' !== $settings->hotspot_marker[ $i ]->text_typography_letter_spacing ) : ?>
							letter-spacing: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_letter_spacing ); ?>px;
						<?php endif; ?>
					}
					<?php
				} else {
					if ( class_exists( 'FLBuilderCSS' ) ) {
						FLBuilderCSS::typography_field_rule(
							array(
								'settings'     => $settings->hotspot_marker[ $i ],
								'setting_name' => 'text_font_typo',
								'selector'     => ".fl-node-$id .uabb-hotspot-item-$i .uabb-hotspot-text",
							)
						);
					}
				}
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {
					background: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->text_typography_bg_color ) ); ?>;

					<?php
					if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) ) {
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) . 'px;' : 'padding-top: 10px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) . 'px;' : 'padding-bottom: 10px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) . 'px;' : 'padding-left: 10px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) . 'px;' : 'padding-right: 10px;';
						}
					} elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_padding && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top ) && '' === $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom ) && '' === $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left ) && '' === $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left && isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) && '' === $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right ) {
						?>
							<?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding ); ?>;
					<?php } ?>
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-container .uabb-hotspot-items .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> {
					-webkit-transform: translate(-50%, 5px);
					transform: translate(-50%, 5px);
				}
				<?php
			}
			?>

			<?php

			if ( 'icon' === $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
				$im_icon_backside = 0;
				$im_icon_size     = 0;
				if ( '' !== $settings->hotspot_marker[ $i ]->icon && 'custom' === $settings->hotspot_marker[ $i ]->icon_style ) {
					$im_icon_backside = (int) $settings->hotspot_marker[ $i ]->icon_bg_size + ( $settings->hotspot_marker[ $i ]->icon_border_width * 2 );
					$im_icon_size     = $settings->hotspot_marker[ $i ]->icon_size;
				} elseif ( '' !== $settings->hotspot_marker[ $i ]->icon && 'circle' === $settings->hotspot_marker[ $i ]->icon_style || 'square' === $settings->hotspot_marker[ $i ]->icon_style ) {
					$im_icon_size = $settings->hotspot_marker[ $i ]->icon_size * 2;
				} elseif ( '' !== $settings->hotspot_marker[ $i ]->icon && 'simple' === $settings->hotspot_marker[ $i ]->icon_style ) {
					$im_icon_size = $settings->hotspot_marker[ $i ]->icon_size;
				} else {
					$im_icon_backside = 0;
					$im_icon_size     = 0;
				}

				$element_width = $im_icon_size + $im_icon_backside;
			} elseif ( 'photo' === $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
				if ( 'custom' === $settings->hotspot_marker[ $i ]->image_style ) {
					$im_backside = ( $settings->hotspot_marker[ $i ]->img_bg_size * 2 ) + ( $settings->hotspot_marker[ $i ]->img_border_width * 2 );
				} else {
					$im_backside = 0;
				}

				$element_width = $settings->hotspot_marker[ $i ]->img_size + $im_backside;
			} else {
				$element_width = 0;
			}
			if ( 'always' === $settings->hotspot_marker[ $i ]->show_animation ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hspot-sonar g {
					-webkit-transform: scale(0);
					transform: scale(0);
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hspot-sonar g {
					opacity: 0;
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
					-webkit-animation-name: hotspot-sonar;
					animation-name: hotspot-sonar;
					-webkit-animation-duration: 1.8s;
					animation-duration: 1.8s;
					-webkit-animation-timing-function: linear;
					animation-timing-function: linear;
					-webkit-animation-iteration-count: infinite;
					animation-iteration-count: infinite;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hspot-sonar g:nth-child(2) {
					-webkit-animation-delay: .6s;
					animation-delay: .6s;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hspot-sonar g:nth-child(3) {
					-webkit-animation-delay: 1.2s;
					animation-delay: 1.2s;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hspot-sonar g:nth-child(4) {
					-webkit-animation-delay: 1.8s;
					animation-delay: 1.8s;
				}
				<?php
			}
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> {
				top:calc( <?php echo esc_attr( $x_coordinate ); ?>% - <?php echo esc_attr( ( $element_width / 2 ) ); ?>px);
				left: calc( <?php echo esc_attr( $y_coordinate ); ?>% - <?php echo esc_attr( ( $element_width / 2 ) ); ?>px);
				<?php
				if ( 'text' !== $settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
					echo 'width: ' . esc_attr( $element_width ) . 'px;';
				}
				?>
			}

			<?php
			if ( 'tooltip' === $settings->hotspot_marker[ $i ]->on_click_action ) {
				?>
				<?php if ( ! $version_bb_check ) { ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ); ?>px;		
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size_unit && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size['desktop'] ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size['desktop'] ); ?>px;
							<?php } ?>
							<?php if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['desktop'] ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size['desktop'] && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ); ?>em;	
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['desktop'] ); ?>px;
							<?php } ?>
							<?php if ( 'none' !== $settings->hotspot_marker[ $i ]->tooltip_transform ) : ?>
								text-transform: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_transform ); ?>;
							<?php endif; ?>

							<?php if ( '' !== $settings->hotspot_marker[ $i ]->tooltip_letter_spacing ) : ?>
								letter-spacing: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_letter_spacing ); ?>px;
							<?php endif; ?>

							<?php
							if ( 'Default' !== $settings->hotspot_marker[ $i ]->tooltip_font_family['family'] ) {
								UABB_Helper::uabb_font_css( $settings->hotspot_marker[ $i ]->tooltip_font_family );
							}
							?>
					}
					<?php
				} else {
					if ( class_exists( 'FLBuilderCSS' ) ) {
						FLBuilderCSS::typography_field_rule(
							array(
								'settings'     => $settings->hotspot_marker[ $i ],
								'setting_name' => 'tooltip_font_typo',
								'selector'     => ".fl-node-$id .uabb-hotspot-item-$i .uabb-hotspot-tooltip-content",
							)
						);
					}
				}
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tour .uabb-hotspot-tour-tooltip-list-group .uabb-hotspot-tour-tooltip-list-group-item .uabb-next,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tour .uabb-hotspot-tour-tooltip-list-group .uabb-hotspot-tour-tooltip-list-group-item .uabb-prev,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-end .uabb-tour-end {
					color: <?php echo esc_attr( uabb_theme_text_color( $settings->hotspot_marker[ $i ]->tooltip_color ) ); ?>;
				}
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
					background: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>;

					<?php
					if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) ) {
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) . 'px;' : 'padding-top: 15px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) . 'px;' : 'padding-bottom: 15px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) . 'px;' : 'padding-left: 15px;';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) . 'px;' : 'padding-right: 15px;';
						}
					} elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_padding && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top ) && '' === $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom ) && '' === $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left ) && '' === $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left && isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) && '' === $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right ) {
						?>
												<?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding ); ?>;
											<?php } ?>
				}


				/* Curved Tooltip Style */

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-curved.uabb-tooltip-right .uabb-hotspot-tooltip-content {
					left: <?php echo esc_attr( ( 'text' !== $settings->hotspot_marker[ $i ]->hotspot_marker_type ) ? ( $element_width + 10 ) . 'px' : 'calc( 100% + 20px )' ); ?>;
					-webkit-transform-origin: -2em 50%;
					transform-origin: -2em 50%;
					-webkit-transform: translate3d(0,50%,0) rotate3d(1,1,1,30deg);
					transform: translate3d(0,50%,0) rotate3d(1,1,1,30deg);
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-curved.uabb-tooltip-left .uabb-hotspot-tooltip-content {
					right: <?php echo esc_attr( ( 'text' !== $settings->hotspot_marker[ $i ]->hotspot_marker_type ) ? ( $element_width + 10 ) . 'px' : 'calc( 100% + 20px )' ); ?>;
					-webkit-transform-origin: calc(100% + 2em) 50%;
					transform-origin: calc(100% + 2em) 50%;
					-webkit-transform: translate3d(0,50%,0) rotate3d(1,1,1,-30deg);
					transform: translate3d(0,50%,0) rotate3d(1,1,1,-30deg);
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-curved.uabb-tooltip-left .uabb-hotspot-svg {
					transform: scale3d(-1,1,1) translateY(-50%);
					left: calc( 100% - 2px );
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-curved.uabb-tooltip-right .uabb-hotspot-svg {
					transform: translateY(-50%);
					right: calc( 100% - 2px );
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?>.uabb-hotspot-hover .uabb-tooltip-style-curved .uabb-hotspot-tooltip-content {
					opacity: 1;
					-webkit-transform: translate3d(0,50%,0) rotate3d(0,0,0,0);
					transform: translate3d(0,50%,0) rotate3d(0,0,0,0);
					pointer-events: auto;
				}

				/* Classic Tooltip Style */

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content::after {
					border-left-color: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content::after {
					border-right-color: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>;
				}


				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content::after {
					border-top-color: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content::after {
					border-bottom-color: <?php echo esc_attr( uabb_theme_base_color( $settings->hotspot_marker[ $i ]->tooltip_bg_color ) ); ?>;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content {
					right: 100%;
					top: 50%;
					transform: translateY(-50%) !important;
					margin-right: 10px;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content {
					bottom: 100%;
					margin-bottom: 10px;
					left: 50%;
					transform: translateX(-50%)!important;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content {
					left: 100%;
					top: 50%;
					transform: translateY(-50%) !important;
					margin-left: 10px;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content {
					top: 100%;
					margin-top: 10px;
					left: 50%;
					transform: translateX(-50%)!important;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-top .uabb-hotspot-tooltip-content::after {
					top: 100%;
					left: 50%;
					margin-left: -10px;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-bottom .uabb-hotspot-tooltip-content::after {
					bottom: 100%;
					left: 50%;
					margin-left: -10px;
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-left .uabb-hotspot-tooltip-content::after {
					top: 50%;
					left: 100%;
					margin-top: -10px;
				}


				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-tooltip-style-classic.uabb-tooltip-right .uabb-hotspot-tooltip-content::after {
					top: 50%;
					right: 100%;
					margin-top: -10px;
				}

				/* Sharp Tooltip Style */

				<?php
			}
			?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-overlay-button {
			<?php
			if ( isset( $settings->overlay_pos_horizontal ) ) {
				echo esc_attr( ( '' !== $settings->overlay_pos_horizontal ) ? 'left:' . $settings->overlay_pos_horizontal . '%;' : '' );
				echo esc_attr( ( '' !== $settings->overlay_pos_horizontal ) ? 'transform:translate( -' . $settings->overlay_pos_horizontal . '%, 0);' : '' );
			}
			if ( isset( $settings->overlay_pos_vertical ) ) {
				echo esc_attr( ( '' !== $settings->overlay_pos_vertical ) ? 'top:' . $settings->overlay_pos_vertical . '%;' : '' );
				echo esc_attr( ( '' !== $settings->overlay_pos_vertical ) ? 'transform:translate( 0, -' . $settings->overlay_pos_vertical . '%);' : '' );
			}
			?>
}
			<?php
			if ( $global_settings->responsive_enabled ) {
				// Global Setting If started.
				?>
				@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {
							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ); ?>px;
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size['medium'] ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size['medium'] ); ?>px;
							<?php } ?>

							<?php if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['medium'] ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size['medium'] && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ); ?>em;
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ) && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['medium'] ); ?>px;
							<?php } ?>
						}
					<?php } ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {

						<?php
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_medium ) . 'px;' : '';
						}
						?>
					}
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ); ?>px;	
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size['medium'] ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size['medium'] ); ?>px;
							<?php } ?> 

							<?php if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['medium'] ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size['medium'] && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ); ?>em;	
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ) && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['medium'] ); ?>px;
							<?php } ?>
						}
						<?php } ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
						<?php
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_medium ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_medium ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_medium ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_medium ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_medium ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_medium ) . 'px;' : '';
						}
						?>

					}
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {

					}
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-hover .uabb-hspot-sonar {
						width: 100px;
						height: 100px;
					}
				}

				@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {
							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ); ?>px;	
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['small'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_font_size['small'] ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_font_size['small'] ); ?>px;
							<?php } ?>

							<?php if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size['small'] ) && '' === $settings->hotspot_marker[ $i ]->text_typography_font_size['small'] && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) { ?>
									line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ); ?>em;
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ) && '' === $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive && isset( $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] ) && '' !== $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->text_typography_line_height['small'] ); ?>px;
							<?php } ?>	
						}
					<?php } ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-text {
						<?php
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right_responsive ) . 'px;' : '';
						}
						?>

					}
					<?php if ( ! $version_bb_check ) { ?>
						.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ); ?>px;	
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['small'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_font_size['small'] ) { ?>
								font-size: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_font_size['small'] ); ?>px;
							<?php } ?>

							<?php if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size['small'] ) && '' === $settings->hotspot_marker[ $i ]->tooltip_font_size['small'] && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) { ?>
									line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] ); ?>px;
							<?php } ?>

							<?php if ( 'yes' === $converted || isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ); ?>em;
							<?php } elseif ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ) && '' === $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive && isset( $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] ) && '' !== $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] ) { ?>
								line-height: <?php echo esc_attr( $settings->hotspot_marker[ $i ]->tooltip_line_height['small'] ); ?>px;
							<?php } ?>
						}
					<?php } ?>
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-item-<?php echo esc_attr( $i ); ?> .uabb-hotspot-tooltip-content {
						<?php
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_responsive ) ? 'padding-top:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_responsive ) ? 'padding-left:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left_responsive ) . 'px;' : '';
						}
						if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_responsive ) ) {
							echo ( '' !== $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_responsive ) ? 'padding-right:' . esc_attr( $settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right_responsive ) . 'px;' : '';
						}
						?>

					}
				}
				<?php
			}
		}
	}
	if ( '' !== $settings->photo_size ) {
		if ( ! $version_bb_check ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-hotspot-container {
				width: <?php echo esc_attr( $settings->photo_size ); ?>px;
			} <?php
		} else {
			FLBuilderCSS::responsive_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'photo_size',
					'selector'     => ".fl-node-$id .uabb-hotspot-container",
					'prop'         => 'width',
				)
			);
		}
	}
}
?>
