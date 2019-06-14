<?php
/**
 *  Frontend CSS php file for Video module
 *
 *  @package Video Module's Frontend.css.php file
 */

$version_bb_check = UABB_Compatibility::check_bb_version();

$settings->play_icon_color            = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_color', true );
$settings->play_icon_hover_color      = UABB_Helper::uabb_colorpicker( $settings, 'play_icon_hover_color', true );
$settings->image_overlay_color        = UABB_Helper::uabb_colorpicker( $settings, 'image_overlay_color', true );
$settings->subscribe_text_color       = UABB_Helper::uabb_colorpicker( $settings, 'subscribe_text_color', true );
$settings->subscribe_text_bg_color    = UABB_Helper::uabb_colorpicker( $settings, 'subscribe_text_bg_color', true );
$settings->play_default_icon_bg       = UABB_Helper::uabb_colorpicker( $settings, 'play_default_icon_bg', true );
$settings->play_default_icon_bg_hover = UABB_Helper::uabb_colorpicker( $settings, 'play_default_icon_bg_hover', true );

?>
<?php if ( isset( $settings->play_icon_size ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__play-icon:before {
		font-size:<?php echo ( '' != $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;'; ?>
		line-height:<?php echo ( '' != $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;'; ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-video__play-icon {
		width:<?php echo( '' != $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;'; ?>
		height:<?php echo( '' != $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;'; ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-video__play-icon > img {
		width:<?php echo( '' != $settings->play_icon_size ) ? $settings->play_icon_size . 'px;' : '75px;'; ?>
	}
<?php } ?>
<?php if ( isset( $settings->play_icon_color ) && '' != $settings->play_icon_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__play-icon {
		color:<?php echo $settings->play_icon_color; ?>
	}
<?php } ?>
<?php if ( isset( $settings->play_icon_hover_color ) && '' != $settings->play_icon_hover_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon{
		color:<?php echo $settings->play_icon_hover_color; ?>
	}
<?php } ?>
<?php if ( isset( $settings->image_overlay_color ) && '' != $settings->image_overlay_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-video__outer-wrap:before {
		background:<?php echo $settings->image_overlay_color; ?>;
	}
<?php } ?>
<?php if ( isset( $settings->yt_subscribe_text ) && '' != $settings->yt_subscribe_text && '' != $settings->subscribe_text_bg_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-subscribe-bar {
		background-color:<?php echo $settings->subscribe_text_bg_color; ?>;
	}
<?php } ?>
<?php if ( isset( $settings->yt_subscribe_text ) && '' != $settings->yt_subscribe_text && '' != $settings->subscribe_text_color ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-subscribe-bar-prefix {
		color:<?php echo $settings->subscribe_text_color; ?>;
	}
<?php } ?>

<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo $id; ?> .uabb-subscribe-bar-prefix {
		<?php if ( 'default' != $settings->subscribe_text_font['family'] && 'default' != $settings->subscribe_text_font['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->subscribe_text_font ); ?>
		<?php endif; ?>
		<?php
		if ( isset( $settings->subscribe_text_font_size ) ) {
			echo ( '' != $settings->subscribe_text_font_size ) ? 'font-size:' . $settings->subscribe_text_font_size . 'px;' : '';
		}
		if ( isset( $settings->subscribe_text_line_height ) ) {
				echo ( '' != $settings->subscribe_text_line_height ) ? 'line-height:' . $settings->subscribe_text_line_height . 'em;' : '';
		}
		if ( isset( $settings->subscribe_text_letter_spacing ) ) {
			echo ( '' != $settings->subscribe_text_letter_spacing ) ? 'letter-spacing:' . $settings->subscribe_text_letter_spacing . 'px;' : '';
		}
		if ( isset( $settings->subscribe_text_transform ) ) {
			echo ( '' != $settings->subscribe_text_transform ) ? 'text-transform:' . $settings->subscribe_text_transform . ';' : '';
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

<?php if ( isset( $settings->subscribe_padding_top ) && isset( $settings->subscribe_padding_right ) && isset( $settings->subscribe_padding_bottom ) && isset( $settings->subscribe_padding_left ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-subscribe-bar{
			<?php
			if ( isset( $settings->subscribe_padding_top ) ) {
				echo ( '' != $settings->subscribe_padding_top ) ? 'padding-top:' . $settings->subscribe_padding_top . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_right ) ) {
				echo ( '' != $settings->subscribe_padding_right ) ? 'padding-right:' . $settings->subscribe_padding_right . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_bottom ) ) {
				echo ( '' != $settings->subscribe_padding_bottom ) ? 'padding-bottom:' . $settings->subscribe_padding_bottom . 'px;' : '';
			}
			if ( isset( $settings->subscribe_padding_left ) ) {
				echo ( '' != $settings->subscribe_padding_left ) ? 'padding-left:' . $settings->subscribe_padding_left . 'px;' : '';
			}
			?>
		}
	<?php
}
?>
<?php /* CSS For Responsive */ ?>
<?php if ( $global_settings->responsive_enabled ) { ?>
	<?php /* CSS For Tab */ ?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-subscribe-bar-prefix {
				<?php
				if ( isset( $settings->subscribe_text_font_size_medium ) ) {
					echo ( '' != $settings->subscribe_text_font_size_medium ) ? 'font-size:' . $settings->subscribe_text_font_size_medium . 'px;' : '';
				}
				if ( isset( $settings->subscribe_text_line_height_medium ) ) {
					echo ( '' != $settings->subscribe_text_line_height_medium ) ? 'line-height:' . $settings->subscribe_text_line_height_medium . 'em;' : '';
				}
				if ( isset( $settings->subscribe_text_letter_spacing_medium ) ) {
					echo ( '' != $settings->subscribe_text_letter_spacing_medium ) ? 'letter-spacing:' . $settings->subscribe_text_letter_spacing_medium . 'px;' : '';
				}
				?>
			}
		<?php } ?>

		<?php if ( isset( $settings->subscribe_padding_top_medium ) && isset( $settings->subscribe_padding_right_medium ) && isset( $settings->subscribe_padding_bottom_medium ) && isset( $settings->subscribe_padding_left_medium ) ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-subscribe-bar{
					<?php
					if ( isset( $settings->subscribe_padding_top_medium ) ) {
						echo ( '' != $settings->subscribe_padding_top_medium ) ? 'padding-top:' . $settings->subscribe_padding_top_medium . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_right_medium ) ) {
						echo ( '' != $settings->subscribe_padding_right_medium ) ? 'padding-right:' . $settings->subscribe_padding_right_medium . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_bottom_medium ) ) {
						echo ( '' != $settings->subscribe_padding_bottom_medium ) ? 'padding-bottom:' . $settings->subscribe_padding_bottom_medium . 'px;' : '';
					}
					if ( isset( $settings->subscribe_padding_left_medium ) ) {
						echo ( '' != $settings->subscribe_padding_left_medium ) ? 'padding-left:' . $settings->subscribe_padding_left_medium . 'px;' : '';
					}
					?>
				}

		<?php } ?>
		<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-subscribe-responsive-tablet .uabb-subscribe-bar-prefix{
				<?php echo 'margin-bottom:' . $settings->subscribe_bar_spacing . 'px;'; ?>
				margin-right: 0;
			}
		<?php } ?>		
	}
	<?php /* CSS For Mobile */ ?>
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

		<?php if ( ! $version_bb_check ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-subscribe-bar-prefix {
				<?php
				if ( isset( $settings->subscribe_text_font_size_respnsive ) ) {
						echo ( '' != $settings->subscribe_text_font_size_respnsive ) ? 'font-size:' . $settings->subscribe_text_font_size_respnsive . 'px;' : '';
				}
				if ( isset( $settings->subscribe_text_line_height_responsive ) ) {
						echo ( '' != $settings->subscribe_text_line_height_responsive ) ? 'line-height:' . $settings->subscribe_text_line_height_responsive . 'em;' : '';
				}
				if ( isset( $settings->subscribe_text_letter_spacing_responsive ) ) {
					echo ( '' != $settings->subscribe_text_letter_spacing_responsive ) ? 'letter-spacing:' . $settings->subscribe_text_letter_spacing_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>

		<?php if ( isset( $settings->subscribe_padding_top_responsive ) && isset( $settings->subscribe_padding_right_responsive ) && isset( $settings->subscribe_padding_bottom_responsive ) && isset( $settings->subscribe_padding_left_responsive ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-subscribe-bar {
				<?php
				if ( isset( $settings->subscribe_padding_top_responsive ) ) {
					echo ( '' != $settings->subscribe_padding_top_responsive ) ? 'padding-top:' . $settings->subscribe_padding_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_right_responsive ) ) {
					echo ( '' != $settings->subscribe_padding_right_responsive ) ? 'padding-right:' . $settings->subscribe_padding_right_responsive . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_bottom_responsive ) ) {
					echo ( '' != $settings->subscribe_padding_bottom_responsive ) ? 'padding-bottom:' . $settings->subscribe_padding_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->subscribe_padding_left_responsive ) ) {
					echo ( '' != $settings->subscribe_padding_left_responsive ) ? 'padding-left:' . $settings->subscribe_padding_left_responsive . 'px;' : '';
				}
				?>
			}
		<?php } ?>
		<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-subscribe-responsive-mobile .uabb-subscribe-bar-prefix {
				<?php echo 'margin-bottom:' . $settings->subscribe_bar_spacing . 'px;'; ?>
				margin-right: 0;
			}
		<?php } ?>
	}
<?php } ?>
<?php
if ( 'default' == $settings->play_source ) {
	if ( 'youtube' === $settings->video_type ) {
		if ( isset( $settings->play_default_icon_bg ) ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-youtube-icon-bg {
				<?php echo ( '' != $settings->play_default_icon_bg ) ? 'fill:' . $settings->play_default_icon_bg . ';' : 'fill: rgba(31,31,31,0.81);'; ?>
			}
			<?php
		}
		if ( isset( $settings->play_default_icon_bg_hover ) ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon .uabb-youtube-icon-bg {
			<?php	echo ( '' != $settings->play_default_icon_bg_hover ) ? 'fill:' . $settings->play_default_icon_bg_hover . ';' : 'fill:#cc181e;'; ?>
			}
			<?php
		}
	}
	?>
	<?php
	if ( 'vimeo' === $settings->video_type ) {
		if ( isset( $settings->play_default_icon_bg ) ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-vimeo-icon-bg {
				<?php echo ( '' != $settings->play_default_icon_bg ) ? 'fill:' . $settings->play_default_icon_bg . ';' : 'fill: rgba(0, 0, 0, 0.7);'; ?>
			}
			<?php
		}
		if ( isset( $settings->play_default_icon_bg_hover ) ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-video__outer-wrap:hover .uabb-video__play-icon .uabb-vimeo-icon-bg {
			<?php
			echo ( '' != $settings->play_default_icon_bg_hover ) ? 'fill:' . $settings->play_default_icon_bg_hover . ';' : 'fill: rgba(0, 173, 239, 0.9);'
			?>
			}
		<?php } ?>
	<?php } ?>	
<?php } ?>
<?php if ( isset( $settings->subscribe_bar_spacing ) && '' !== $settings->subscribe_bar_spacing ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-subscribe-bar-prefix {
		<?php echo 'margin-right:' . $settings->subscribe_bar_spacing . 'px;'; ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-subscribe-responsive-desktop .uabb-subscribe-bar-prefix{
		<?php echo 'margin-bottom:' . $settings->subscribe_bar_spacing . 'px;'; ?>
		margin-right: 0;
	} 
<?php } ?>
