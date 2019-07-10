<?php if ( ! empty( $settings->text_color ) ) : // Text Color ?>
.fl-node-<?php echo $id; ?> {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_color ); ?>;
}
.fl-builder-content .fl-node-<?php echo $id; ?> *:not(input):not(textarea):not(select):not(a):not(h1):not(h2):not(h3):not(h4):not(h5):not(h6):not(.fl-menu-mobile-toggle) {
	color: inherit;
}
<?php endif; ?>

<?php if ( ! empty( $settings->link_color ) ) : // Link Color ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->link_color ); ?>;
}
<?php elseif ( ! empty( $settings->text_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_color ); ?>;
}
<?php endif; ?>

<?php if ( ! empty( $settings->hover_color ) ) : // Link Hover Color ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a:hover {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->hover_color ); ?>;
}
<?php elseif ( ! empty( $settings->text_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> a:hover {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_color ); ?>;
}
<?php endif; ?>

<?php if ( ! empty( $settings->heading_color ) ) : // Heading Color ?>
.fl-builder-content .fl-node-<?php echo $id; ?> h1,
.fl-builder-content .fl-node-<?php echo $id; ?> h2,
.fl-builder-content .fl-node-<?php echo $id; ?> h3,
.fl-builder-content .fl-node-<?php echo $id; ?> h4,
.fl-builder-content .fl-node-<?php echo $id; ?> h5,
.fl-builder-content .fl-node-<?php echo $id; ?> h6,
.fl-builder-content .fl-node-<?php echo $id; ?> h1 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h2 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h3 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h4 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h5 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h6 a {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->heading_color ); ?>;
}
<?php elseif ( ! empty( $settings->text_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo $id; ?> h1,
.fl-builder-content .fl-node-<?php echo $id; ?> h2,
.fl-builder-content .fl-node-<?php echo $id; ?> h3,
.fl-builder-content .fl-node-<?php echo $id; ?> h4,
.fl-builder-content .fl-node-<?php echo $id; ?> h5,
.fl-builder-content .fl-node-<?php echo $id; ?> h6,
.fl-builder-content .fl-node-<?php echo $id; ?> h1 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h2 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h3 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h4 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h5 a,
.fl-builder-content .fl-node-<?php echo $id; ?> h6 a {
	color: <?php echo FLBuilderColor::hex_or_rgb( $settings->text_color ); ?>;
}
<?php endif; ?>

<?php if ( $row->settings->bg_video_audio ) : ?>
.fl-node-<?php echo $row->node; ?> .fl-bg-video-audio {
	display: none;
	cursor: pointer;
	position: absolute;
	bottom: 20px;
	right: 20px;
	z-index: 5;
	width: 20px;
}
.fl-node-<?php echo $row->node; ?> .fl-bg-video-audio .fl-audio-control {
	font-size: 20px;
}
.fl-node-<?php echo $row->node; ?> .fl-bg-video-audio .fa-times {
	font-size: 10px;
	vertical-align: middle;
	position: absolute;
	top: 5px;
	left: 11px;
	bottom: 0;
}
<?php endif; ?>

<?php

// Background Color
FLBuilderCSS::rule( array(
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => in_array( $settings->bg_type, array( 'color', 'photo', 'parallax', 'slideshow', 'video' ) ),
	'props'    => array(
		'background-color' => $settings->bg_color,
	),
) );

// Background Gradient
FLBuilderCSS::rule( array(
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'gradient' === $settings->bg_type,
	'props'    => array(
		'background-image' => FLBuilderColor::gradient( $settings->bg_gradient ),
	),
) );

// Background Overlay
FLBuilderCSS::rule( array(
	'selector' => ".fl-node-$id > .fl-row-content-wrap:after",
	'enabled'  => 'none' !== $settings->bg_overlay_type && in_array( $settings->bg_type, array( 'photo', 'parallax', 'slideshow', 'video' ) ),
	'props'    => array(
		'background-color' => 'color' === $settings->bg_overlay_type ? $settings->bg_overlay_color : '',
		'background-image' => 'gradient' === $settings->bg_overlay_type ? FLBuilderColor::gradient( $settings->bg_overlay_gradient ) : '',
	),
) );

// Background Photo - Desktop
FLBuilderCSS::rule( array(
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'photo' === $settings->bg_type,
	'props'    => array(
		'background-image'      => $settings->bg_image_src,
		'background-repeat'     => $settings->bg_repeat,
		'background-position'   => $settings->bg_position,
		'background-attachment' => $settings->bg_attachment,
		'background-size'       => $settings->bg_size,
	),
) );

// Background Photo - Medium
FLBuilderCSS::rule( array(
	'media'    => 'medium',
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'photo' === $settings->bg_type,
	'props'    => array(
		'background-image'      => $settings->bg_image_medium_src,
		'background-repeat'     => $settings->bg_repeat_medium,
		'background-position'   => $settings->bg_position_medium,
		'background-attachment' => $settings->bg_attachment_medium,
		'background-size'       => $settings->bg_size_medium,
	),
) );

// Background Photo - Responsive
FLBuilderCSS::rule( array(
	'media'    => 'responsive',
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'photo' === $settings->bg_type,
	'props'    => array(
		'background-image'      => $settings->bg_image_responsive_src,
		'background-repeat'     => $settings->bg_repeat_responsive,
		'background-position'   => $settings->bg_position_responsive,
		'background-attachment' => $settings->bg_attachment_responsive,
		'background-size'       => $settings->bg_size_responsive,
	),
) );

// Background Parallax
FLBuilderCSS::rule( array(
	'selector' => ".fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'parallax' === $settings->bg_type,
	'props'    => array(
		'background-repeat'     => 'no-repeat',
		'background-position'   => 'center center',
		'background-attachment' => 'fixed',
		'background-size'       => 'cover',
	),
) );

FLBuilderCSS::rule( array(
	'selector' => ".fl-builder-mobile .fl-node-$id > .fl-row-content-wrap",
	'enabled'  => 'parallax' === $settings->bg_type,
	'props'    => array(
		'background-image'      => $settings->bg_parallax_image_src,
		'background-position'   => 'center center',
		'background-attachment' => 'scroll',
	),
) );

// Border
FLBuilderCSS::border_field_rule( array(
	'settings'     => $settings,
	'setting_name' => 'border',
	'selector'     => ".fl-node-$id > .fl-row-content-wrap",
) );

// Min Height
FLBuilderCSS::responsive_rule( array(
	'settings'     => $settings,
	'setting_name' => 'min_height',
	'selector'     => ".fl-node-$id > .fl-row-content-wrap",
	'prop'         => 'min-height',
	'enabled'      => 'custom' === $settings->full_height,
) );

// Row Resize - Max Width
if ( isset( $settings->max_content_width ) ) {
	$has_max_width        = ! FLBuilderCSS::is_empty( $settings->max_content_width );
	$is_row_fixed         = ( 'fixed' === $settings->width );
	$is_row_content_fixed = ( 'fixed' === $settings->content_width );
	$are_both_full_width  = ( ! $is_row_fixed && ! $is_row_content_fixed );
	$max_width_selector   = '';

	if ( $is_row_fixed ) {
		$max_width_selector = ".fl-node-$id.fl-row-fixed-width, .fl-node-$id .fl-row-fixed-width";
	} else {
		$max_width_selector = ".fl-node-$id .fl-row-content";
	}

	FLBuilderCSS::rule( array(
		'selector' => $max_width_selector,
		'enabled'  => $has_max_width && ! $are_both_full_width,
		'props'    => array(
			'max-width' => array(
				'value' => $settings->max_content_width,
				'unit'  => FLBuilderCSS::get_unit( 'max_content_width', $settings ),
			),
		),
	) );
}

FLBuilderArt::render_shape_layers_css( $row );
