<?php
/**
 *  Frontend CSS php file for Devices Module.
 *
 *  @package UABB Devices Module Frontend.css.php file.
 */

$settings->arrow_color            = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color' );
$settings->arrow_background_color = UABB_Helper::uabb_colorpicker( $settings, 'arrow_background_color', true );
$settings->arrow_color_border     = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_border' );

if ( 'video' === $settings->media_type && 'self_hosted' !== $settings->video_src ) {
	$video_settings = array(
		'video_type'        => $settings->video_src,
		'youtube_link'      => $settings->youtube_url,
		'vimeo_link'        => $settings->vimeo_url,
		'wistia_link'       => $settings->wistia_url,
		'start'             => $settings->start_time,
		'end'               => $settings->end_time,
		'aspect_ratio'      => $settings->aspect_ratio,
		'yt_autoplay'       => $settings->auto_play,
		'yt_suggested'      => $settings->rel,
		'yt_controls'       => $settings->controls,
		'yt_mute'           => $settings->mute,
		'yt_modestbranding' => $settings->modestbranding,
		'yt_privacy'        => $settings->yt_privacy,
		'vimeo_autoplay'    => $settings->auto_play,
		'vimeo_loop'        => $settings->loop,
		'vimeo_title'       => $settings->vimeo_title,
		'vimeo_portrait'    => $settings->vimeo_portrait,
		'vimeo_byline'      => $settings->vimeo_byline,
		'wistia_autoplay'   => $settings->auto_play,
	);
	FLBuilder::render_module_css( 'uabb-video', $id, $video_settings );
}

if ( class_exists( 'FLBuilderCSS' ) ) {

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'max_width',
			'selector'     => ".fl-node-$id .uabb-device-wrap",
			'prop'         => 'width',
			'unit'         => $settings->max_width_unit,
		)
	);

	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_border',
			'selector'     => ".fl-node-$id .uabb-video-button",
		)
	);

	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'hover_button_border',
			'selector'     => ".fl-node-$id .uabb-video-button:hover",
		)
	);

	FLBuilderCSS::dimension_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_padding',
			'selector'     => ".fl-node-$id .uabb-video-button",
			'unit'         => 'px',
			'props'        => array(
				'padding-top'    => 'button_padding_top',
				'padding-right'  => 'button_padding_right',
				'padding-bottom' => 'button_padding_bottom',
				'padding-left'   => 'button_padding_left',
			),
		)
	);

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'alignment',
			'selector'     => ".fl-node-$id .uabb-devices-content .uabb-devices-wrapper",
			'prop'         => 'text-align',
		)
	);

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'orientation_control_size',
			'selector'     => ".fl-node-$id .uabb-devices-content .uabb-device-orientation .fa-mobile",
			'prop'         => 'font-size',
			'unit'         => 'px',
		)
	);

	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'device_control_size',
			'selector'     => ".fl-node-$id .uabb-device-switch-control i",
			'prop'         => 'font-size',
			'unit'         => 'px',
		)
	);
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-wrap {
	<?php if ( '' !== ( $settings->max_width ) ) { ?>
		width: <?php echo esc_attr( $settings->max_width ) . esc_attr( $settings->max_width_unit ); ?>;
	<?php } ?>

}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-media-screen .uabb-device-media-screen-inner {
	background-position: <?php echo esc_attr( $settings->vertical_alignment ); ?>;

	<?php if ( 'image' === $settings->media_type && 'custom' === $settings->vertical_alignment && 'no' === $settings->scroll_on_hover ) { ?>
		top : <?php echo ( '' !== $settings->top_offset ) ? esc_attr( $settings->top_offset ) . '%' : ''; ?>;
	<?php } ?>
}

	<?php

	if ( 'yes' === $settings->scroll_on_hover ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-media-screen.uabb-scrollable .uabb-device-media-screen-inner:hover {
			background-position: center bottom;
			background-size: cover;
		}
		<?php
		if ( isset( $settings->transition_duration ) && '' !== $settings->transition_duration ) {
			?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-media-screen.uabb-scrollable .uabb-device-media-screen-inner {
				transition: all ease-in-out <?php echo esc_attr( $settings->transition_duration ); ?>s;
				background-size: cover;
			}
			<?php
		}
	}
	?>

<?php
if ( '' !== $settings->orientation_control_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-orientation .fa-mobile {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->orientation_control_color ) ); ?>;
	}
	<?php
}
?>

<?php
if ( '' !== $settings->orientation_hover_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-orientation .fa-mobile:hover {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->orientation_hover_color ) ); ?>;
	}
	<?php
}
?>

<?php
if ( '' !== $settings->device_control_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-device-switch-control i {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->device_control_color ) ); ?>;
	}
	<?php
}
?>

<?php
if ( '' !== $settings->device_control_hover_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-device-switch-control i:hover, 
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-device-switch-control i:focus {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->device_control_hover_color ) ); ?>;
	}
	<?php
}
?>

<?php
if ( '' !== $settings->device_control_active_color ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-device-switch-control i.active {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->device_control_active_color ) ); ?>;
	}
	<?php
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-shape .overlay-shape {
	fill: #fff;
	fill-opacity:0.4;
}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-shape img {
		<?php
		if ( 'gold' === $settings->style ) {
			?>
			filter: invert(1) sepia(29%) saturate(331%) hue-rotate(323deg) brightness(100%) contrast(93%);
			<?php
		} elseif ( 'silver' === $settings->style ) {
			?>
			filter: invert(1) sepia(7%) saturate(54%) hue-rotate(156deg) brightness(114%) contrast(84%);
			<?php
		} elseif ( 'black' === $settings->style ) {
			?>
			filter: sepia(6%) saturate(190%) hue-rotate(131deg) brightness(94%) contrast(93%);
			<?php
		} elseif ( 'white' === $settings->style ) {
			?>
			filter: invert(1) sepia(7%) saturate(1870%) hue-rotate(187deg) brightness(107%) contrast(108%);
			<?php
		} elseif ( 'space_grey' === $settings->style ) {
			?>
			filter: invert(1) sepia(7%) saturate(146%) hue-rotate(336deg) brightness(96%) contrast(87%);
			<?php
		} elseif ( 'rose_gold' === $settings->style ) {
			?>
			filter: invert(1) sepia(12%) saturate(1188%) hue-rotate(316deg) brightness(104%) contrast(96%);
			<?php
		}
		?>
	}

	<?php

	if ( 'no' === $settings->show_bar ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar-wrapper{
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_buttons ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-buttons{
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_rewind ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-rewind {
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_time ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-time{
		display:none;
	}
		<?php
	}
	if ( 'no' === $settings->show_progress ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-control-progress{
		display:none;
	}
		<?php
	}
	if ( 'no' === $settings->show_duration ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-duration{
		display:none;
	}
		<?php
	}
	if ( 'no' === $settings->show_fullscreen ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-fs {
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_volume ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-volume {
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_volume_icon ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-volume-icon {
		display:none;
	}
		<?php
	}

	if ( 'no' === $settings->show_volume_bar ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar .uabb-player-controls-volume-bar {
		display:none;
	}
		<?php
	}

	if ( '' !== ( $settings->controls_color ) ) {
		?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->controls_color ) ); ?>;
	}
		<?php
	}
	?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-control-progress-outer,.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-control-progress-inner{
<?php
if ( '' !== ( $settings->controls_color ) ) {
	?>
		background: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->controls_color ) ); ?>;
	<?php
}

if ( '' !== ( $settings->bar_border_radius ) ) {
	?>
		border-radius: <?php echo esc_attr( $settings->bar_border_radius ); ?>px;
	<?php
}
?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar {

	<?php
	if ( '' !== ( $settings->controls_opacity ) ) {
		?>
	opacity: <?php echo esc_attr( $settings->controls_opacity ); ?>;
		<?php
	}
	?>

	<?php
	if ( '' !== ( $settings->controls_bg_color ) ) {
		?>
	background: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->controls_bg_color ) ); ?>;
		<?php
	}
	?>

}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:hover, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-player-controls-bar:hover {
<?php

if ( '' !== ( $settings->hover_controls_color ) ) {
	?>
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->hover_controls_color ) ); ?>;
	<?php
}

if ( '' !== ( $settings->hover_controls_opacity ) ) {
	?>
	opacity: <?php echo esc_attr( $settings->hover_controls_opacity ); ?>;
	<?php
}

if ( '' !== ( $settings->hover_controls_bg_color ) ) {
	?>
	background: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->hover_controls_bg_color ) ); ?>;
	<?php
}
?>
}

<?php
if ( '' !== ( $settings->button_controls_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->button_controls_color ) ); ?>;
	}
	<?php
}

if ( '' !== ( $settings->button_controls_bg_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
		background: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->button_controls_bg_color ) ); ?>;
	}
	<?php
}

if ( '' !== ( $settings->hover_button_controls_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:hover {
		color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->hover_button_controls_color ) ); ?>;
	}
	<?php
}

if ( '' !== ( $settings->hover_button_controls_bg_color ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:hover {
		background: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->hover_button_controls_bg_color ) ); ?>;
	}
	<?php
}

if ( '' !== ( $settings->button_size ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:before {
		font-size: <?php echo esc_attr( $settings->button_size ); ?>px;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
		width: <?php echo esc_attr( $settings->button_size + ( $settings->button_size / 2.5 ) ); ?>px;
	}
	<?php
}

if ( '' !== ( $settings->button_spacing ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
		margin: 0px <?php echo esc_attr( $settings->button_spacing ); ?>px;
	}
	<?php
}

if ( isset( $settings->image_fit ) && '' !== $settings->image_fit ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-media-screen .uabb-device-media-screen-inner {
		background-size: <?php echo esc_attr( $settings->image_fit ); ?>;
		background-repeat: no-repeat;
	}

	<?php
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-buttons{
	<?php if ( 'self_hosted' !== $settings->video_src && '' === $settings->embed_cover_image_src ) { ?>
		display: none !important;
	<?php } elseif ( 'self_hosted' !== $settings->video_src && '' !== $settings->embed_cover_image_src ) { ?>
		display: inline-table !important;
	<?php } ?>
}

<?php
if ( 'b_color' === $settings->video_overlay || 'both_image_color' === $settings->video_overlay && '' !== ( $settings->overlay_background ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-player-cover.uabb-player-cover:after {
		background-color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->overlay_background ) ); ?>;
	}
	<?php
}

if ( 'none' !== $settings->video_overlay && '' !== ( $settings->overlay_opacity ) ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-player-cover.uabb-player-cover {
		opacity: <?php echo esc_attr( $settings->overlay_opacity ); ?>;
	}
	<?php
}

if ( 'image' === $settings->video_overlay || 'both_image_color' === $settings->video_overlay && '' !== $settings->embed_cover_image_src ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-player-cover {
		background-image: url(<?php echo esc_url( $settings->embed_cover_image_src ); ?>);
	}
	<?php

} elseif ( 'none' === $settings->video_overlay ) {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-player-cover {
		display: none;
	}
	<?php
}
?>

<?php if ( 'slider' === $settings->media_type && 'yes' === $settings->enable_arrows ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> div.uabb-image-carousel .slick-prev,
	.fl-node-<?php echo esc_attr( $id ); ?> [dir='rtl'] div.uabb-image-carousel .slick-next {
		left: 0px;

	}
	.fl-node-<?php echo esc_attr( $id ); ?> div.uabb-image-carousel .slick-next,
	.fl-node-<?php echo esc_attr( $id ); ?> [dir='rtl'] div.uabb-image-carousel .slick-prev
	{
		right: 0px;
		transform: translate(50%, -50%);
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-prev i,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-next i,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-prev i:hover,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-prev i:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-next i:focus,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-image-carousel .slick-next i:hover {
		width: 28px;
		height: 28px;
		line-height: 28px;
	}

.fl-node-<?php echo esc_attr( $id ); ?> .slick-prev i,
.fl-node-<?php echo esc_attr( $id ); ?> .slick-next i,
.fl-node-<?php echo esc_attr( $id ); ?> .slick-prev i:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .slick-next i:hover,
.fl-node-<?php echo esc_attr( $id ); ?> .slick-prev i:focus,
.fl-node-<?php echo esc_attr( $id ); ?> .slick-next i:focus {
	outline: none;
	<?php
	$color               = uabb_theme_base_color( $settings->arrow_color );
			$arrow_color = ( '' !== $color ) ? $color : '#fff';
	?>
	color: <?php echo esc_attr( $arrow_color ); ?>;
	<?php
	switch ( $settings->arrow_style ) {
		case 'square':
			?>
				background: <?php echo esc_attr( ( '' !== $settings->arrow_background_color ) ? $settings->arrow_background_color : '#efefef' ); ?>;
			<?php
			break;

		case 'circle':
			?>
				border-radius: 50%;
				background: <?php echo esc_attr( ( '' !== $settings->arrow_background_color ) ? $settings->arrow_background_color : '#efefef' ); ?>;
			<?php
			break;

		case 'square-border':
			?>
				border: <?php echo esc_attr( $settings->arrow_border_size ); ?>px solid <?php echo esc_attr( $settings->arrow_color_border ); ?>;
			<?php
			break;

		case 'circle-border':
			?>
				border: <?php echo esc_attr( $settings->arrow_border_size ); ?>px solid <?php echo esc_attr( $settings->arrow_color_border ); ?>;
				border-radius: 50%;
			<?php
			break;
	}
	?>
}
<?php } ?>


@media only screen and (max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px) {
	<?php
	if ( '' !== ( $settings->button_size_medium ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:before {
				font-size: <?php echo esc_attr( $settings->button_size_medium ); ?>px;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
				width: <?php echo esc_attr( $settings->button_size_medium + ( $settings->button_size_medium / 2.5 ) ); ?>px;
			}
			<?php
	}

	if ( '' !== ( $settings->button_spacing_medium ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
				margin: 0px <?php echo esc_attr( $settings->button_spacing_medium ); ?>px;
			}
			<?php
	}

	if ( '' !== ( $settings->max_width_medium ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-wrap {
				width:  <?php echo esc_attr( $settings->max_width_medium . $settings->max_width_unit ); ?>;
			}
			<?php
	}
	?>
}

@media only screen and (max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px) {
	<?php
	if ( '' !== ( $settings->button_size_responsive ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button:before {
				font-size: <?php echo esc_attr( $settings->button_size_responsive ); ?>px;
			}

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
				width: <?php echo esc_attr( $settings->button_size_responsive + ( $settings->button_size_responsive / 2.5 ) ); ?>px;
			}
			<?php
	}

	if ( '' !== ( $settings->button_spacing_responsive ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-video-button {
				margin: 0px <?php echo esc_attr( $settings->button_spacing_responsive ); ?>px;
			}
			<?php
	}

	if ( '' !== ( $settings->max_width_responsive ) ) {
		?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-devices-content .uabb-device-wrap {
				width:  <?php echo esc_attr( $settings->max_width_responsive . $settings->max_width_unit ); ?>;
			}
			<?php
	}
	?>
}
