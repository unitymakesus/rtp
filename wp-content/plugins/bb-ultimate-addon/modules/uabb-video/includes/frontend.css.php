<?php
/**
 *  Frontend CSS php file for Video module.
 *
 *  @package Video Module's Frontend.css.php file.
 */

$version_bb_check                     = UABB_Compatibility::$version_bb_check;
$settings->play_icon_color            = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_color', true );
$settings->play_icon_hover_color      = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_hover_color', true );
$settings->image_overlay_color        = UABB_Helper::uabb_colorpicker( $settings, 'image_overlay_color', true );
$settings->subscribe_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'subscribe_text_color', true );
$settings->subscribe_text_bg_color    = UABB_Helper::uabb_colorpicker( $settings, 'subscribe_text_bg_color', true );
$settings->play_default_icon_bg       = UABB_Helper::uabb_colorpicker( $settings, 'play_default_icon_bg', true );
$settings->play_default_icon_bg_hover = UABB_Helper::uabb_colorpicker( $settings, 'play_default_icon_bg_hover', true );
$settings->sticky_video_color         = UABB_Helper::uabb_colorpicker( $settings, 'sticky_video_color', true );
$settings->sticky_close_icon_bgcolor  = UABB_Helper::uabb_colorpicker( $settings, 'sticky_close_icon_bgcolor', true );
$settings->sticky_close_icon_color    = UABB_Helper::uabb_colorpicker( $settings, 'sticky_close_icon_color', true );
$settings->sticky_info_bar_color      = UABB_Helper::uabb_colorpicker( $settings, 'sticky_info_bar_color', true );
$settings->sticky_info_bar_bgcolor    = UABB_Helper::uabb_colorpicker( $settings, 'sticky_info_bar_bgcolor', true );
?>
<?php if ( isset( $settings->play_icon_size ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__play-icon:before {
		font-size:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
		line-height:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__play-icon {
		width:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
		height:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__play-icon > img {
		width:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
	}
	<?php if ( 'wistia' === $settings->video_type ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video-wistia-play {
			width:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
			height:<?php echo esc_attr( ( '' !== $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;' ); ?>
		}
<?php	} ?>
<?php } ?>
<?php if ( isset( $settings->play_icon_color ) && '' !== $settings->play_icon_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__play-icon {
		color:<?php echo esc_attr( $settings->play_icon_color ); ?>
	}
<?php } ?>
<?php if ( isset( $settings->play_icon_hover_color ) && '' !== $settings->play_icon_hover_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon{
		color:<?php echo esc_attr( $settings->play_icon_hover_color ); ?>
	}
<?php } ?>
<?php if ( isset( $settings->image_overlay_color ) && '' !== $settings->image_overlay_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap:before {
		background:<?php echo esc_attr( $settings->image_overlay_color ); ?>;
	}
<?php } ?>
<?php if ( isset( $settings->yt_subscribe_text ) && '' !== $settings->yt_subscribe_text && '' !== $settings->subscribe_text_bg_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar {
		background-color:<?php echo esc_attr( $settings->subscribe_text_bg_color ); ?>;
	}
<?php } ?>
<?php if ( isset( $settings->yt_subscribe_text ) && '' !== $settings->yt_subscribe_text && '' !== $settings->subscribe_text_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar-prefix {
		color:<?php echo esc_attr( $settings->subscribe_text_color ); ?>;
	}
<?php } ?>

<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar-prefix {
		<?php if ( 'default' !== $settings->subscribe_text_font['family'] && 'default' !== $settings->subscribe_text_font['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->subscribe_text_font ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->subscribe_text_font_size ) ) {
			echo ( '' !== $settings->subscribe_text_font_size ) ? 'font-size:' . esc_attr( $settings->subscribe_text_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->subscribe_text_line_height ) ) {
				echo ( '' !== $settings->subscribe_text_line_height ) ? 'line-height:' . esc_attr( $settings->subscribe_text_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->subscribe_text_letter_spacing ) ) {
			echo ( '' !== $settings->subscribe_text_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->subscribe_text_letter_spacing ) . 'px;' : '';
		}
		if ( isset( $settings->subscribe_text_transform ) ) {
			echo ( '' !== $settings->subscribe_text_transform ) ? 'text-transform:' . esc_attr( $settings->subscribe_text_transform ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'subscribe_font_typo',
				'selector'     => ".fl-node-$id .uabb-subscribe-bar-prefix",
			)
		);
	}
}
?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video-sticky-infobar {
		<?php if ( 'default' !== $settings->sticky_text_font['family'] && 'default' !== $settings->sticky_text_font['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->sticky_text_font ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->sticky_text_font_size ) ) {
			echo ( '' !== $settings->sticky_text_font_size ) ? 'font-size:' . esc_attr( $settings->sticky_text_font_size ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_text_line_height ) ) {
				echo ( '' !== $settings->sticky_text_line_height ) ? 'line-height:' . esc_attr( $settings->sticky_text_line_height ) . 'em;' : '';
		}
		if ( isset( $settings->sticky_text_letter_spacing ) ) {
			echo ( '' !== $settings->sticky_text_letter_spacing ) ? 'letter-spacing:' . esc_attr( $settings->sticky_text_letter_spacing ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_text_transform ) ) {
			echo ( '' !== $settings->sticky_text_transform ) ? 'text-transform:' . esc_attr( $settings->sticky_text_transform ) . ';' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'sticky_field_options',
				'selector'     => ".fl-node-$id .uabb-video-sticky-infobar",
			)
		);
	}
}
?>
<?php if ( isset( $settings->subscribe_padding_top ) && isset( $settings->subscribe_padding_right ) && isset( $settings->subscribe_padding_bottom ) && isset( $settings->subscribe_padding_left ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar{
			<?php
			if ( isset( $settings->subscribe_padding_top ) ) {
				echo ( '' !== $settings->subscribe_padding_top ) ? 'padding-top:' . esc_attr( $settings->subscribe_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_right ) ) {
				echo ( '' !== $settings->subscribe_padding_right ) ? 'padding-right:' . esc_attr( $settings->subscribe_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_bottom ) ) {
				echo ( '' !== $settings->subscribe_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->subscribe_padding_bottom ) . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_left ) ) {
				echo ( '' !== $settings->subscribe_padding_left ) ? 'padding-left:' . esc_attr( $settings->subscribe_padding_left ) . 'px;' : '';
			}
			?>
		}
	<?php
}
?>
<?php if ( isset( $settings->sticky_video_margin_top ) && isset( $settings->sticky_video_margin_right ) && isset( $settings->sticky_video_margin_bottom ) && isset( $settings->sticky_video_margin_left ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap {

	<?php
	if ( 'top_left' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_top ) ) {
			echo ( '' !== $settings->sticky_video_margin_top ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_video_margin_left ) ) {
			echo ( '' !== $settings->sticky_video_margin_left ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left ) . 'px;' : '';
		}
	} elseif ( 'top_right' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_top ) ) {
				echo ( '' !== $settings->sticky_video_margin_top ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_video_margin_right ) ) {
				echo ( '' !== $settings->sticky_video_margin_right ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right ) . 'px;' : '';
		}
	} elseif ( 'center_left' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_left ) ) {
			echo ( '' !== $settings->sticky_video_margin_left ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left ) . 'px;' : '';
		}
	} elseif ( 'center_right' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_right ) ) {
			echo ( '' !== $settings->sticky_video_margin_right ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right ) . 'px;' : '';
		}
	} elseif ( 'bottom_left' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_left ) ) {
			echo ( '' !== $settings->sticky_video_margin_left ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_video_margin_bottom ) ) {
			echo ( '' !== $settings->sticky_video_margin_bottom ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom ) . 'px;' : '';
		}
	} elseif ( 'bottom_right' === $settings->sticky_alignment ) {
		if ( isset( $settings->sticky_video_margin_right ) ) {
			echo ( '' !== $settings->sticky_video_margin_right ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right ) . 'px;' : '';
		}
		if ( isset( $settings->sticky_video_margin_bottom ) ) {
			echo ( '' !== $settings->sticky_video_margin_bottom ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom ) . 'px;' : '';
		}
	}
	?>
	}
	<?php
}
?>
<?php if ( isset( $settings->sticky_video_padding_top ) && isset( $settings->sticky_video_padding_right ) && isset( $settings->sticky_video_padding_bottom ) && isset( $settings->subscribe_padding_left ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply iframe,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video__thumb {
			<?php
			if ( isset( $settings->sticky_video_padding_top ) ) {
				echo ( '' !== $settings->sticky_video_padding_top ) ? 'padding-top:' . esc_attr( $settings->sticky_video_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_video_padding_right ) ) {
				echo ( '' !== $settings->sticky_video_padding_right ) ? 'padding-right:' . esc_attr( $settings->sticky_video_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_video_padding_bottom ) ) {
				echo ( '' !== $settings->sticky_video_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->sticky_video_padding_bottom ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_video_padding_left ) ) {
				echo ( '' !== $settings->sticky_video_padding_left ) ? 'padding-left:' . esc_attr( $settings->sticky_video_padding_left ) . 'px;' : '';
			}
			?>
		}
	<?php
}
?>
<?php if ( isset( $settings->sticky_info_bar_padding_top ) && isset( $settings->sticky_info_bar_padding_right ) && isset( $settings->sticky_info_bar_padding_bottom ) && isset( $settings->sticky_info_bar_padding_left ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-infobar {
			<?php
			if ( isset( $settings->sticky_info_bar_padding_top ) ) {
				echo ( '' !== $settings->sticky_info_bar_padding_top ) ? 'padding-top:' . esc_attr( $settings->sticky_info_bar_padding_top ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_info_bar_padding_right ) ) {
				echo ( '' !== $settings->sticky_info_bar_padding_right ) ? 'padding-right:' . esc_attr( $settings->sticky_info_bar_padding_right ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_info_bar_padding_bottom ) ) {
				echo ( '' !== $settings->sticky_info_bar_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->sticky_info_bar_padding_bottom ) . 'px;' : '';
			}
			if ( isset( $settings->sticky_info_bar_padding_left ) ) {
				echo ( '' !== $settings->sticky_info_bar_padding_left ) ? 'padding-left:' . esc_attr( $settings->sticky_info_bar_padding_left ) . 'px;' : '';
			}
			?>
		}
	<?php
}
?>
	<?php
	if ( isset( $settings->sticky_video_width ) && '' !== $settings->sticky_video_width ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-sticky-apply .uabb-video__thumb {
				<?php echo 'width: ' . esc_attr( $settings->sticky_video_width ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width ) . 'px * 0.5625 )'; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-4_3 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-4_3 .uabb-sticky-apply .uabb-video__thumb {
				<?php echo 'width: ' . esc_attr( $settings->sticky_video_width ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width ) . 'px * 0.75 )'; ?>
			}
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-3_2 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
			.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-3_2 .uabb-sticky-apply .uabb-video__thumb {
				<?php echo 'width: ' . esc_attr( $settings->sticky_video_width ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width ) . 'px * 0.6666666666666667 )'; ?>
			}
		<?php
	}
	?>

<?php /* CSS For Responsive */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?>
	<?php /* CSS For Tab */ ?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar-prefix {
				<?php
				if ( isset( $settings->subscribe_text_font_size_medium ) ) {
					echo ( '' !== $settings->subscribe_text_font_size_medium ) ? 'font-size:' . esc_attr( $settings->subscribe_text_font_size_medium ) . 'px;' : '';
				}
				if ( isset( $settings->subscribe_text_line_height_medium ) ) {
					echo ( '' !== $settings->subscribe_text_line_height_medium ) ? 'line-height:' . esc_attr( $settings->subscribe_text_line_height_medium ) . 'em;' : '';
				}
				if ( isset( $settings->subscribe_text_letter_spacing_medium ) ) {
					echo ( '' !== $settings->subscribe_text_letter_spacing_medium ) ? 'letter-spacing:' . esc_attr( $settings->subscribe_text_letter_spacing_medium ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>

		<?php if ( isset( $settings->subscribe_padding_top_medium ) && isset( $settings->subscribe_padding_right_medium ) && isset( $settings->subscribe_padding_bottom_medium ) && isset( $settings->subscribe_padding_left_medium ) ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar {
					<?php
					if ( isset( $settings->subscribe_padding_top_medium ) ) {
						echo ( '' !== $settings->subscribe_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->subscribe_padding_top_medium ) . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_right_medium ) ) {
						echo ( '' !== $settings->subscribe_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->subscribe_padding_right_medium ) . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_bottom_medium ) ) {
						echo ( '' !== $settings->subscribe_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->subscribe_padding_bottom_medium ) . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_left_medium ) ) {
						echo ( '' !== $settings->subscribe_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->subscribe_padding_left_medium ) . 'px;' : '';
					}
					?>
				}

		<?php } ?>
		<?php if ( isset( $settings->sticky_video_padding_top_medium ) && isset( $settings->sticky_video_padding_right_medium ) && isset( $settings->sticky_video_padding_bottom_medium ) && isset( $settings->sticky_video_padding_left_medium ) ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply iframe, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video__thumb {
					<?php
					if ( isset( $settings->sticky_video_padding_top_medium ) ) {
						echo ( '' !== $settings->sticky_video_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->sticky_video_padding_top_medium ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_padding_right_medium ) ) {
						echo ( '' !== $settings->sticky_video_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->sticky_video_padding_right_medium ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_padding_bottom_medium_responsive ) ) {
						echo ( '' !== $settings->sticky_video_padding_bottom_medium_responsive ) ? 'padding-bottom:' . esc_attr( $settings->sticky_video_padding_bottom_medium_responsive ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_padding_left_medium ) ) {
						echo ( '' !== $settings->sticky_video_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->sticky_video_padding_left_medium ) . 'px;' : '';
					}
					?>
			}
		<?php } ?>
		<?php if ( isset( $settings->sticky_video_margin_top_medium ) && isset( $settings->sticky_video_margin_right_medium ) && isset( $settings->sticky_video_margin_bottom_medium ) && isset( $settings->sticky_video_margin_left_medium ) ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap {
				<?php
				if ( 'top_left' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_top_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_top_medium ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top_medium ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_margin_left_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_left_medium ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left_medium ) . 'px;' : '';
					}
				} elseif ( 'top_right' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_top_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_top_medium ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top_medium ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_margin_right_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_right_medium ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right_medium ) . 'px;' : '';
					}
				} elseif ( 'center_left' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_left_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_left_medium ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left_medium ) . 'px;' : '';
					}
				} elseif ( 'center_right' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_right_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_right_medium ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right_medium ) . 'px;' : '';
					}
				} elseif ( 'bottom_left' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_left_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_left_medium ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_margin_bottom_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_bottom_medium ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom ) . 'px;' : '';
					}
				} elseif ( 'bottom_right' === $settings->sticky_alignment ) {
					if ( isset( $settings->sticky_video_margin_right_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_right_medium ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right ) . 'px;' : '';
					}
					if ( isset( $settings->sticky_video_margin_bottom_medium ) ) {
						echo ( '' !== $settings->sticky_video_margin_bottom_medium ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom_medium ) . 'px;' : '';
					}
				}
				?>
				}
	<?php } ?>
		<?php if ( isset( $settings->sticky_info_bar_padding_top_medium ) && isset( $settings->sticky_info_bar_padding_right_medium ) && isset( $settings->sticky_info_bar_padding_bottom_medium ) && isset( $settings->sticky_info_bar_padding_left_medium ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-infobar {
				<?php
				if ( isset( $settings->sticky_info_bar_padding_top_medium ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_top_medium ) ? 'padding-top:' . esc_attr( $settings->sticky_info_bar_padding_top_medium ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_right_medium ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_right_medium ) ? 'padding-right:' . esc_attr( $settings->sticky_info_bar_padding_right_medium ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_bottom_medium ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_bottom_medium ) ? 'padding-bottom:' . esc_attr( $settings->sticky_info_bar_padding_bottom_medium ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_left_medium ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_left_medium ) ? 'padding-left:' . esc_attr( $settings->sticky_info_bar_padding_left_medium ) . 'px;' : '';
				}
				?>
			}
	<?php } ?>
		<?php if ( isset( $settings->sticky_video_width_medium ) && '' !== $settings->sticky_video_width_medium ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_medium ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_medium ) . 'px * 0.5625 )'; ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-4_3 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-4_3 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_medium ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_medium ) . 'px * 0.75 )'; ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-3_2 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-3_2 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_medium ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_medium ) . 'px * 0.6666666666666667 )'; ?>
		}

		<?php } ?>
		<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-responsive-tablet .uabb-subscribe-bar-prefix{
				<?php echo 'margin-bottom:' . esc_attr( $settings->subscribe_bar_spacing ) . 'px;'; ?>
				margin-right: 0;
			}
		<?php } ?>
	}
	<?php /* CSS For Mobile */ ?>
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar-prefix {
				<?php
				if ( isset( $settings->subscribe_text_font_size_respnsive ) ) {
					echo ( '' !== $settings->subscribe_text_font_size_respnsive ) ? 'font-size:' . esc_attr( $settings->subscribe_text_font_size_respnsive ) . 'px;' : '';
				}
				if ( isset( $settings->subscribe_text_line_height_responsive ) ) {
					echo ( '' !== $settings->subscribe_text_line_height_responsive ) ? 'line-height:' . esc_attr( $settings->subscribe_text_line_height_responsive ) . 'em;' : '';
				}
				if ( isset( $settings->subscribe_text_letter_spacing_responsive ) ) {
					echo ( '' !== $settings->subscribe_text_letter_spacing_responsive ) ? 'letter-spacing:' . esc_attr( $settings->subscribe_text_letter_spacing_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->subscribe_padding_top_responsive ) && isset( $settings->subscribe_padding_right_responsive ) && isset( $settings->subscribe_padding_bottom_responsive ) && isset( $settings->subscribe_padding_left_responsive ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar {
				<?php
				if ( isset( $settings->subscribe_padding_top_responsive ) ) {
					echo ( '' !== $settings->subscribe_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->subscribe_padding_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_right_responsive ) ) {
					echo ( '' !== $settings->subscribe_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->subscribe_padding_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->subscribe_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->subscribe_padding_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_left_responsive ) ) {
					echo ( '' !== $settings->subscribe_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->subscribe_padding_left_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->sticky_video_padding_top_responsive ) && isset( $settings->sticky_video_padding_right_responsive ) && isset( $settings->sticky_video_padding_bottom_responsive ) && isset( $settings->subscribe_padding_left_responsive ) ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply iframe, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video__thumb {
				<?php
				if ( isset( $settings->sticky_video_padding_top_responsive ) ) {
					echo ( '' !== $settings->sticky_video_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->sticky_video_padding_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_padding_right_responsive ) ) {
					echo ( '' !== $settings->sticky_video_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->sticky_video_padding_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->sticky_video_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->sticky_video_padding_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_padding_left_responsive ) ) {
					echo ( '' !== $settings->sticky_video_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->sticky_video_padding_left_responsive ) . 'px;' : '';
				}
				?>
			}
			<?php
		}
		if ( isset( $settings->sticky_video_margin_top_responsive ) && isset( $settings->sticky_video_margin_right_responsive ) && isset( $settings->sticky_video_margin_bottom_responsive ) && isset( $settings->sticky_video_margin_left_responsive ) ) {
			?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap {
			<?php
			if ( 'top_left' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_top_responsive ) ) {
					echo ( '' !== $settings->sticky_video_margin_top_responsive ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_margin_left_responsive ) ) {
					echo ( '' !== $settings->sticky_video_margin_left_responsive ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left_responsive ) . 'px;' : '';
				}
			} elseif ( 'top_right' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_top_responsive ) ) {
								echo ( '' !== $settings->sticky_video_margin_top_responsive ) ? 'top:' . esc_attr( $settings->sticky_video_margin_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_margin_right_responsive ) ) {
					echo ( '' !== $settings->sticky_video_margin_right_responsive ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right_responsive ) . 'px;' : '';
				}
			} elseif ( 'center_left' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_left_responsive ) ) {
								echo ( '' !== $settings->sticky_video_margin_left_responsive ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left_responsive ) . 'px;' : '';
				}
			} elseif ( 'center_right' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_right_responsive ) ) {
								echo ( '' !== $settings->sticky_video_margin_right_responsive ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right_responsive ) . 'px;' : '';
				}
			} elseif ( 'bottom_left' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_left_responsive ) ) {
								echo ( '' !== $settings->sticky_video_margin_left_responsive ) ? 'left:' . esc_attr( $settings->sticky_video_margin_left_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_margin_bottom_responsive ) ) {
					echo ( '' !== $settings->sticky_video_margin_bottom_responsive ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom_responsive ) . 'px;' : '';
				}
			} elseif ( 'bottom_right' === $settings->sticky_alignment ) {
				if ( isset( $settings->sticky_video_margin_right_responsive ) ) {
								echo ( '' !== $settings->sticky_video_margin_right_responsive ) ? 'right:' . esc_attr( $settings->sticky_video_margin_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_video_margin_bottom_responsive ) ) {
					echo ( '' !== $settings->sticky_video_margin_bottom_responsive ) ? 'bottom:' . esc_attr( $settings->sticky_video_margin_bottom_responsive ) . 'px;' : '';
				}
			}
			?>
	}
<?php } ?>

		<?php if ( isset( $settings->sticky_info_bar_padding_top_responsive ) && isset( $settings->sticky_info_bar_padding_right_responsive ) && isset( $settings->sticky_info_bar_padding_bottom_responsive ) && isset( $settings->sticky_info_bar_padding_left_responsive ) ) { ?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-infobar {
				<?php
				if ( isset( $settings->sticky_info_bar_padding_top_responsive ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_top_responsive ) ? 'padding-top:' . esc_attr( $settings->sticky_info_bar_padding_top_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_right_responsive ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_right_responsive ) ? 'padding-right:' . esc_attr( $settings->sticky_info_bar_padding_right_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_bottom_responsive ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_bottom_responsive ) ? 'padding-bottom:' . esc_attr( $settings->sticky_info_bar_padding_bottom_responsive ) . 'px;' : '';
				}
				if ( isset( $settings->sticky_info_bar_padding_left_responsive ) ) {
					echo ( '' !== $settings->sticky_info_bar_padding_left_responsive ) ? 'padding-left:' . esc_attr( $settings->sticky_info_bar_padding_left_responsive ) . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->sticky_video_width_responsive ) && '' !== $settings->sticky_video_width_responsive ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-16_9 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px * 0.5625 )'; ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-4_3 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-4_3 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px * 0.75 )'; ?>
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-aspect-ratio-3_2 .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap,
		.fl-node-<?php echo esc_attr( $id ); ?> uabb-aspect-ratio-3_2 .uabb-sticky-apply .uabb-video__thumb{
			<?php echo 'width: ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px; height: calc( ' . esc_attr( $settings->sticky_video_width_responsive ) . 'px * 0.6666666666666667 )'; ?>
		}
		<?php } ?>
		<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-responsive-mobile .uabb-subscribe-bar-prefix {
				<?php echo 'margin-bottom:' . esc_attr( $settings->subscribe_bar_spacing ) . 'px;'; ?>
				margin-right: 0;
			}
		<?php } ?>
	}
<?php } ?>
<?php
if ( 'default' === $settings->play_source ) {
	if ( 'youtube' === $settings->video_type ) {
		if ( isset( $settings->play_default_icon_bg ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-youtube-icon-bg {
				<?php echo ( '' !== $settings->play_default_icon_bg ) ? 'fill:' . esc_attr( $settings->play_default_icon_bg ) . ';' : 'fill: rgba(31,31,31,0.81);'; ?>
			}
			<?php
		}
		if ( isset( $settings->play_default_icon_bg_hover ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon .uabb-youtube-icon-bg {
			<?php	echo ( '' !== $settings->play_default_icon_bg_hover ) ? 'fill:' . esc_attr( $settings->play_default_icon_bg_hover ) . ';' : 'fill:#cc181e;'; ?>
			}
			<?php
		}
	}
	?>
	<?php
	if ( 'vimeo' === $settings->video_type ) {
		if ( isset( $settings->play_default_icon_bg ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-vimeo-icon-bg {
				<?php echo ( '' !== $settings->play_default_icon_bg ) ? 'fill:' . esc_attr( $settings->play_default_icon_bg ) . ';' : 'fill: rgba(0, 0, 0, 0.7);'; ?>
			}
			<?php
		}
		if ( isset( $settings->play_default_icon_bg_hover ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon .uabb-vimeo-icon-bg {
			<?php
			echo ( '' !== $settings->play_default_icon_bg_hover ) ? 'fill:' . esc_attr( $settings->play_default_icon_bg_hover ) . ';' : 'fill: rgba(0, 173, 239, 0.9);'
			?>
			}
		<?php } ?>
	<?php } ?>
	<?php
	if ( 'wistia' === $settings->video_type ) {
		if ( isset( $settings->play_default_icon_bg ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video-wistia-play {
				<?php echo ( '' !== $settings->play_default_icon_bg ) ? 'background-color:' . esc_attr( $settings->play_default_icon_bg ) . ';' : 'background-color: rgba(84, 187, 255, 0.8);'; ?>
			}
			<?php
		}
		if ( isset( $settings->play_default_icon_bg_hover ) ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon .uabb-video-wistia-play {
			<?php
			echo ( '' !== $settings->play_default_icon_bg_hover ) ? 'background-color:' . esc_attr( $settings->play_default_icon_bg_hover ) . ';' : 'background-color: rgba(0, 0, 0, 0.7);'
			?>
			}
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-bar-prefix {
		<?php echo 'margin-right:' . esc_attr( $settings->subscribe_bar_spacing ) . 'px;'; ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-subscribe-responsive-desktop .uabb-subscribe-bar-prefix{
		<?php echo 'margin-bottom:' . esc_attr( $settings->subscribe_bar_spacing ) . 'px;'; ?>
		margin-right: 0;
	}
<?php } ?>

<?php /* CSS For Sticky video  */ ?>
<?php if ( isset( $settings->sticky_video_color ) && '' !== $settings->sticky_video_color ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-video__outer-wrap.uabb-sticky-apply .uabb-video-inner-wrap {
		background:<?php echo esc_attr( $settings->sticky_video_color ); ?>;
	}
<?php } ?>

<?php /* CSS For Sticky video  close button  */ ?>
<?php if ( isset( $settings->enable_sticky_close_button ) && 'none' !== $settings->enable_sticky_close_button ) { ?>
	<?php if ( isset( $settings->sticky_close_icon_color ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-close {
			color: <?php echo esc_attr( $settings->sticky_close_icon_color ); ?>;
			}
	<?php } ?>
	<?php if ( isset( $settings->sticky_close_icon_bgcolor ) ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-close {
		background:<?php echo esc_attr( $settings->sticky_close_icon_bgcolor ); ?>;
	}
		<?php
	}
}
?>
<?php /* CSS For Call to Action Bar */ ?>
<?php if ( isset( $settings->sticky_info_bar_enable ) && 'yes' === $settings->sticky_info_bar_enable ) { ?>
	<?php if ( isset( $settings->sticky_info_bar_color ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-infobar {
		color: <?php echo esc_attr( $settings->sticky_info_bar_color ); ?>;
		}
	<?php } ?>
	<?php if ( isset( $settings->sticky_info_bar_bgcolor ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-sticky-apply .uabb-video-sticky-infobar {
		background: <?php echo esc_attr( $settings->sticky_info_bar_bgcolor ); ?>;
		}
		<?php
	}
}
