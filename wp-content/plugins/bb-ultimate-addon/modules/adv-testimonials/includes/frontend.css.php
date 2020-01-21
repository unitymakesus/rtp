<?php
/**
 * Register the module's CSS file for Advanced Testimonials module
 *
 * @package UABB Advanced Testimonials Module
 */

	$version_bb_check = UABB_Compatibility::check_bb_version();
	$converted        = UABB_Compatibility::check_old_page_migration();

	$settings->dot_color          = uabb_theme_base_color( $settings->dot_color );
	$settings->arrow_color        = uabb_theme_base_color( $settings->arrow_color );
	$settings->arrow_color_back   = uabb_theme_base_color( $settings->arrow_color_back );
	$settings->arrow_color_border = uabb_theme_base_color( $settings->arrow_color_border );
	$settings->layout_background  = uabb_theme_base_color( $settings->layout_background );
	$settings->rating_color       = uabb_theme_base_color( $settings->rating_color );

	$settings->arrow_color                        = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color' );
	$settings->arrow_color_back                   = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_back', true );
	$settings->arrow_color_border                 = UABB_Helper::uabb_colorpicker( $settings, 'arrow_color_border' );
	$settings->dot_color                          = UABB_Helper::uabb_colorpicker( $settings, 'dot_color' );
	$settings->icon_color_noslider                = UABB_Helper::uabb_colorpicker( $settings, 'icon_color_noslider' );
	$settings->testimonial_icon_bg_color_noslider = UABB_Helper::uabb_colorpicker( $settings, 'testimonial_icon_bg_color_noslider', true );
	$settings->layout_background                  = UABB_Helper::uabb_colorpicker( $settings, 'layout_background', true );
	$settings->rating_color                       = UABB_Helper::uabb_colorpicker( $settings, 'rating_color' );

	$settings->testimonial_icon_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'testimonial_icon_bg_color', true );

	$settings->testimonial_heading_color         = UABB_Helper::uabb_colorpicker( $settings, 'testimonial_heading_color' );
	$settings->testimonial_designation_color     = UABB_Helper::uabb_colorpicker( $settings, 'testimonial_designation_color' );
	$settings->testimonial_description_opt_color = UABB_Helper::uabb_colorpicker( $settings, 'testimonial_description_opt_color' );

	$settings->testimonial_icon_image_size       = ( '' !== $settings->testimonial_icon_image_size ) ? $settings->testimonial_icon_image_size : '75';
	$settings->testimonial_icon_bg_border_radius = ( '' !== $settings->testimonial_icon_bg_border_radius ) ? $settings->testimonial_icon_bg_border_radius : '0';
	$settings->testimonial_icon_bg_size          = ( '' != $settings->testimonial_icon_bg_size ) ? $settings->testimonial_icon_bg_size : '10';

	$settings->testimonial_icon_image_size_noslider       = ( '' !== $settings->testimonial_icon_image_size_noslider ) ? $settings->testimonial_icon_image_size_noslider : '75';
	$settings->testimonial_icon_bg_border_radius_noslider = ( '' !== $settings->testimonial_icon_bg_border_radius_noslider ) ? $settings->testimonial_icon_bg_border_radius_noslider : '0';
	$settings->testimonial_icon_bg_size_noslider          = ( '' !== $settings->testimonial_icon_bg_size_noslider ) ? $settings->testimonial_icon_bg_size_noslider : '10';
	$settings->arrow_border_size                          = ( '' !== $settings->arrow_border_size ) ? $settings->arrow_border_size : '1';
	$settings->testimonial_heading_margin_bottom          = ( '' !== $settings->testimonial_heading_margin_bottom ) ? $settings->testimonial_heading_margin_bottom : '5';
	$settings->testimonial_designation_margin_top         = ( '' !== $settings->testimonial_designation_margin_top ) ? $settings->testimonial_designation_margin_top : '5';
	$settings->testimonial_description_opt_margin_top     = ( '' !== $settings->testimonial_description_opt_margin_top ) ? $settings->testimonial_description_opt_margin_top : '10';
?>
<?php if ( 'slider' == $settings->tetimonial_layout ) { ?>

/* Default variables */

	/* Change navigation dot color */
	<?php if ( '' != $settings->dot_color ) { ?>
	.fl-node-<?php echo $id; ?> .bx-pager.bx-default-pager a,
	.fl-node-<?php echo $id; ?> .bx-pager.bx-default-pager a.active {
		background: <?php echo $settings->dot_color; ?>;
		opacity: 1;
	}
	<?php } ?>
	.fl-node-<?php echo $id; ?> .bx-pager.bx-default-pager a {
		opacity: 0.2;
	}


/* Style Navigations */

	<?php if ( 'compact' == $settings->navigation || 'compact-wide' == $settings->navigation ) { ?>

		<?php if ( 'square' == $settings->arrow_style ) { ?>
	.fl-node-<?php echo $id; ?> .bx-prev i,
	.fl-node-<?php echo $id; ?> .bx-next i {
		background: <?php echo $settings->arrow_color_back; ?>;
		color: <?php echo $settings->arrow_color; ?>;
	}
<?php } ?>
		<?php if ( 'circle' == $settings->arrow_style ) { ?>
	.fl-node-<?php echo $id; ?> .bx-prev i,
	.fl-node-<?php echo $id; ?> .bx-next i {
		border-radius: 50%;
		background: <?php echo $settings->arrow_color_back; ?>;
		color: <?php echo $settings->arrow_color; ?>;
	}
<?php } ?>
		<?php if ( 'circle-border' == $settings->arrow_style ) { ?>
	.fl-node-<?php echo $id; ?> .bx-prev i,
	.fl-node-<?php echo $id; ?> .bx-next i {
		background: none;
		border-radius: 50%;
		border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border; ?>;
		color: <?php echo $settings->arrow_color; ?>;
	}
<?php } ?>
		<?php if ( 'square-border' == $settings->arrow_style ) { ?>
	.fl-node-<?php echo $id; ?> .bx-prev i,
	.fl-node-<?php echo $id; ?> .bx-next i {
		background: none;
		border: <?php echo $settings->arrow_border_size; ?>px solid <?php echo $settings->arrow_color_border; ?>;
		color: <?php echo $settings->arrow_color; ?>;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-testimonials-wrap.compact {
	padding: 0 45px;
}
.fl-node-<?php echo $id; ?> .uabb-slider-next:before,
.fl-node-<?php echo $id; ?> .uabb-slider-prev:before {
	width: 26px;
	display: inline-block;
}
<?php } ?>


/* When Overall position top */
	<?php if ( 'top' == $settings->testimonial_image_position ) { ?>
.fl-node-<?php echo $id; ?> .uabb-testimonials.uabb-testimonial-top .uabb-testimonial{
	flex-direction: column;
}
<?php } ?>

	<?php
	/* Assign Style to inner Items*/
	$testimonial_list_counter = 0;
	foreach ( $settings->testimonials as $item ) {
		if ( 'circle' == $settings->testimonial_icon_style ) {
			$testimonial_icon_size = $settings->testimonial_icon_image_size / 2;
		} elseif ( 'square' == $settings->testimonial_icon_style ) {
			$testimonial_icon_size = $settings->testimonial_icon_image_size / 2;
		} elseif ( 'custom' == $settings->testimonial_icon_style ) {
			$testimonial_icon_size = $settings->testimonial_icon_image_size;
		} else {
			$testimonial_icon_size = $settings->testimonial_icon_image_size;
		}


		$imageicon_array = array(
			/* General Section */
			'image_type'              => $item->image_type,

			/* Icon Basics */
			'icon'                    => $item->icon,
			'icon_size'               => $testimonial_icon_size,
			'icon_align'              => 'center',

			/* Image Basics */
			'photo_source'            => $item->photo_source,
			'photo'                   => $item->photo,
			'photo_url'               => $item->photo_url,
			'img_size'                => $settings->testimonial_icon_image_size,
			'img_align'               => 'center',
			'photo_src'               => ( isset( $item->photo_src ) ) ? $item->photo_src : '',

			/* Icon Style */
			'icon_style'              => $settings->testimonial_icon_style,
			'icon_bg_size'            => $settings->testimonial_icon_bg_size * 2,
			'icon_border_style'       => 'none',
			'icon_border_width'       => '',
			'icon_bg_border_radius'   => $settings->testimonial_icon_bg_border_radius,

			/* Image Style */
			'image_style'             => $settings->testimonial_icon_style,
			'img_bg_size'             => $settings->testimonial_icon_bg_size,
			'img_border_style'        => 'none',
			'img_border_width'        => '',
			'img_bg_border_radius'    => $settings->testimonial_icon_bg_border_radius,
			'responsive_img_size'     => $settings->responsive_img_size_slider,

			/* Preset Color variable new */
			'icon_color_preset'       => 'preset1',

			/* Icon Colors */
			'icon_color'              => $item->icon_color,
			'icon_hover_color'        => '',
			'icon_bg_color'           => $settings->testimonial_icon_bg_color,
			'icon_bg_color_opc'       => $settings->testimonial_icon_bg_color_opc,
			'icon_bg_hover_color'     => '',
			'icon_border_color'       => '',
			'icon_border_hover_color' => '',
			'icon_three_d'            => '',

			/* Image Colors */
			'img_bg_color'            => $settings->testimonial_icon_bg_color,
			'img_bg_color_opc'        => $settings->testimonial_icon_bg_color_opc,
			'img_bg_hover_color'      => '',
			'img_border_color'        => '',
			'img_border_hover_color'  => '',
		);
		/* Render HTML Function */
		FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-testimonial.uabb-testimonial' . $testimonial_list_counter, $imageicon_array );

		if ( 'none' != $item->image_type && ( '' != $item->icon || ( isset( $item->photo_src ) && '' != $item->photo_src ) || ( isset( $item->photo_url ) && '' != $item->photo_url ) ) ) {
			?>
			<?php if ( 'top' != $settings->testimonial_image_position ) : ?>
				.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-testimonial-photo .uabb-imgicon-wrap {
					<?php
						$extra_padding = 0;
					if ( 'custom' == $settings->testimonial_icon_style ) {
						$extra_padding = $settings->testimonial_icon_bg_size * 2;
					}
					?>
					width: <?php echo $settings->testimonial_icon_image_size + $extra_padding; ?>px;
				}
				.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-testimonial-photo {
					<?php if ( 'center' == $settings->content_alignment ) : ?>
						vertical-align: middle;
					<?php endif; ?>
				}
			<?php endif; ?>

			.fl-node-<?php echo $id; ?> .uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-testimonial-info {
				<?php if ( 'top' == $settings->testimonial_image_position ) { ?>
					width: 100%;
				<?php } else { ?>
					<?php
					if ( 'custom' == $settings->testimonial_icon_style ) {
						$extra_padding = $settings->testimonial_icon_bg_size * 2 + 5;
					} else {
						$extra_padding = 0;
					}
}
?>

				width: 100%;
				<?php if ( 'center' == $settings->content_alignment ) : ?>
					vertical-align: middle;
				<?php endif; ?>
			}
			<?php
		} else {
			?>
		.fl-node-<?php echo $id; ?> .uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-testimonial-info {
			width: 100%;
		}
			<?php
		}

		?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			<?php
			if ( '' != $settings->responsive_img_size_slider ) {
				?>

				.fl-node-<?php echo $id; ?> .uabb-testimonial.uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-icon-wrap .uabb-icon i,
				.fl-node-<?php echo $id; ?> .uabb-testimonial.uabb-testimonial<?php echo $testimonial_list_counter; ?> .uabb-icon-wrap .uabb-icon i:before {
					font-size: <?php echo ( $settings->responsive_img_size_slider / 2 ); ?>px;
					line-height: <?php echo $settings->responsive_img_size_slider; ?>px;
					height: <?php echo $settings->responsive_img_size_slider; ?>px;
					width: <?php echo $settings->responsive_img_size_slider; ?>px;
				}
				<?php
			}
			?>
		}
		<?php
		$testimonial_list_counter = $testimonial_list_counter + 1;
	}
	?>
<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {
		color: <?php echo $settings->rating_color; ?>;

		<?php
		if ( 'yes' === $converted || isset( $settings->rating_font_size_unit ) && '' != $settings->rating_font_size_unit ) {
			?>
			font-size: <?php echo $settings->rating_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->rating_font_size_unit ) && '' == $settings->rating_font_size_unit && isset( $settings->rating_font_size['desktop'] ) && '' != $settings->rating_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->rating_font_size['desktop']; ?>px;
		<?php } ?>

	}
<?php } else { ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {
		color: <?php echo $settings->rating_color; ?>;
		<?php if ( isset( $settings->rating_font_size_unit ) && '' != $settings->rating_font_size_unit ) { ?>
			font-size: <?php echo $settings->rating_font_size_unit; ?>px;
		<?php } ?>
	}
<?php } ?>

<?php
if ( isset( $settings->rating_align ) && $version_bb_check ) {
	FLBuilderCSS::responsive_rule( array(
		'settings'     => $settings,
		'setting_name' => 'rating_align',
		'selector'     => ".fl-node-$id .uabb-testimonial .uabb-rating",
		'prop'         => 'text-align',
	) );
}
?>

/* Box Layout starts Here */
<?php if ( 'slider-no' == $settings->tetimonial_layout || 'box' == $settings->tetimonial_layout ) { ?>

	<?php
	/* Image Icon Object CSS Render */
	if ( 'circle' == $settings->testimonial_icon_style_noslider ) {
		$testimonial_icon_size_noslider = $settings->testimonial_icon_image_size_noslider / 2;
	} elseif ( 'square' == $settings->testimonial_icon_style_noslider ) {
		$testimonial_icon_size_noslider = $settings->testimonial_icon_image_size_noslider / 2;
	} elseif ( 'custom' == $settings->testimonial_icon_style_noslider ) {
		$testimonial_icon_size_noslider = $settings->testimonial_icon_image_size_noslider;
	} else {
		$testimonial_icon_size_noslider = $settings->testimonial_icon_image_size_noslider;
	}
	$imageicon_array = array(
		/* General Section */
		'image_type'              => $settings->image_type_noslider,

		/* Icon Basics */
		'icon'                    => $settings->icon_noslider,
		'icon_size'               => $testimonial_icon_size_noslider,
		'icon_align'              => 'center',

		/* Image Basics */
		'photo_source'            => $settings->photo_source_noslider,
		'photo'                   => $settings->photo_noslider,
		'photo_url'               => $settings->photo_url_noslider,
		'img_size'                => $settings->testimonial_icon_image_size_noslider,
		'img_align'               => 'center',
		'photo_src'               => ( isset( $settings->photo_noslider_src ) ) ? $settings->photo_noslider_src : '',

		/* Icon Style */
		'icon_style'              => $settings->testimonial_icon_style_noslider,
		'icon_bg_size'            => $settings->testimonial_icon_bg_size_noslider * 2,
		'icon_border_style'       => 'none',
		'icon_border_width'       => '',
		'icon_bg_border_radius'   => $settings->testimonial_icon_bg_border_radius_noslider,

		/* Image Style */
		'image_style'             => $settings->testimonial_icon_style_noslider,
		'img_bg_size'             => $settings->testimonial_icon_bg_size_noslider,
		'img_border_style'        => 'none',
		'img_border_width'        => '',
		'img_bg_border_radius'    => $settings->testimonial_icon_bg_border_radius_noslider,
		'responsive_img_size'     => $settings->responsive_img_size,

		/* Icon Colors */
		'icon_color'              => $settings->icon_color_noslider,
		'icon_hover_color'        => '',
		'icon_bg_color'           => $settings->testimonial_icon_bg_color_noslider,
		'icon_bg_color_opc'       => $settings->testimonial_icon_bg_color_noslider_opc,
		'icon_bg_hover_color'     => '',
		'icon_border_color'       => '',
		'icon_border_hover_color' => '',
		'icon_three_d'            => '',

		/* Image Colors */
		'img_bg_color'            => $settings->testimonial_icon_bg_color_noslider,
		'img_bg_color_opc'        => $settings->testimonial_icon_bg_color_noslider_opc,
		'img_bg_hover_color'      => '',
		'img_border_color'        => '',
		'img_border_hover_color'  => '',
	);
	/* Render HTML Function */
	FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
	/* Image Icon Object CSS Render Ends */
	?>

.fl-node-<?php echo $id; ?> .uabb-testimonial-info {
	width: 100%;
	<?php if ( 'center' == $settings->content_alignment ) : ?>
		vertical-align: middle;
	<?php endif; ?>
}

	<?php if ( 'top' != $settings->testimonial_image_position ) : ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial-photo .uabb-imgicon-wrap {
		<?php
			$extra_padding = 0;
		if ( 'custom' == $settings->testimonial_icon_style_noslider ) {
			$extra_padding = $settings->testimonial_icon_bg_size_noslider * 2;
		}
		?>
		width: <?php echo $settings->testimonial_icon_image_size_noslider + $extra_padding; ?>px;
	}
		<?php if ( 'center' == $settings->content_alignment ) : ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial-photo.uabb-testimonial-<?php echo $settings->testimonial_image_position; ?> {
			vertical-align: middle;
	}
	<?php endif; ?>
	<?php endif; ?>


/* Layout style Box */
	<?php if ( 'box' == $settings->tetimonial_layout ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonial {
		background: <?php echo $settings->layout_background; ?>;
		padding: 20px 40px;
	}

	.fl-node-<?php echo $id; ?> .testimonial-arrow-down{
		border-top: 40px solid <?php echo $settings->layout_background; ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-testimonials.box{
		position: relative;
	}
	<?php } else { ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonial {
		background: none;
	}
	<?php } ?>

	<?php if ( isset( $settings->icon_position_half_box ) && 'yes' == $settings->icon_position_half_box && 'top' == $settings->testimonial_image_position && ( ( 'photo' == $settings->image_type_noslider || 'icon' == $settings->image_type_noslider ) && ( ( isset( $settings->photo_noslider_src ) && '' != $settings->photo_noslider_src ) || ( isset( $settings->photo_url_noslider ) && '' != $settings->photo_url_noslider ) || ( isset( $settings->icon_noslider ) && '' != $settings->icon_noslider ) ) ) ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-testimonial-photo.uabb-testimonial-top.uabb_half_top {
		position: absolute;
		transform: translate(-50%,-50%);
		left: 50%;
	}
	.fl-node-<?php echo $id; ?> .uabb-testimonial-info {
		padding-top: <?php echo $settings->testimonial_icon_image_size_noslider / 2 + 20; ?>px;
	}
	.fl-node-<?php echo $id; ?> .uabb-testimonial.uabb_half_top{
		padding-top: 0;
	}
	<?php } ?>



/* When Overall position top */
	<?php if ( 'top' == $settings->testimonial_image_position ) { ?>
.uabb-testimonials.uabb-testimonial-top .uabb-testimonial{
	flex-direction: column;
}
	<?php } ?>

<?php } ?>



/* Typography */
.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-name<?php echo $id; ?> {
	<?php if ( '' != $settings->testimonial_heading_color ) : ?>
		color: <?php echo $settings->testimonial_heading_color; ?>;
	<?php endif; ?>
	<?php if ( '' != $settings->testimonial_heading_margin_top ) : ?>
		margin-top: <?php echo $settings->testimonial_heading_margin_top . 'px'; ?>;
	<?php endif; ?>
	margin-bottom: <?php echo $settings->testimonial_heading_margin_bottom . 'px'; ?>;
}
<?php if ( ! $version_bb_check ) { ?>
	<?php if ( isset( $settings->testimonial_heading_line_height_unit ) || isset( $settings->testimonial_heading_font_size_unit ) || 'Default' != $settings->testimonial_heading_font_family['family'] || isset( $settings->testimonial_heading_font_size['desktop'] ) || isset( $settings->testimonial_heading_line_height['desktop'] ) || isset( $settings->testimonial_heading_color ) || isset( $settings->testimonial_heading_margin_top ) || isset( $settings->testimonial_heading_margin_bottom ) || isset( $settings->testimonial_transform ) || isset( $settings->testimonial_letter_spacing ) ) { // Class for heading section. ?>

		.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-name<?php echo $id; ?> {
			<?php if ( 'Default' != $settings->testimonial_heading_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->testimonial_heading_font_family ); ?>
			<?php endif; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->testimonial_heading_font_size_unit ) && '' != $settings->testimonial_heading_font_size_unit ) {
				?>
				font-size: <?php echo $settings->testimonial_heading_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->testimonial_heading_font_size_unit ) && '' == $settings->testimonial_heading_font_size_unit && isset( $settings->testimonial_heading_font_size['desktop'] ) && '' != $settings->testimonial_heading_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->testimonial_heading_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->testimonial_heading_font_size['desktop'] ) && '' == $settings->testimonial_heading_font_size['desktop'] && isset( $settings->testimonial_heading_line_height['desktop'] ) && '' != $settings->testimonial_heading_line_height['desktop'] && '' == $settings->testimonial_heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_heading_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->testimonial_heading_line_height_unit ) && '' != $settings->testimonial_heading_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_heading_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->testimonial_heading_line_height_unit ) && '' == $settings->testimonial_heading_line_height_unit && isset( $settings->testimonial_heading_line_height['desktop'] ) && '' != $settings->testimonial_heading_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->testimonial_heading_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->testimonial_transform ) : ?>
				text-transform: <?php echo $settings->testimonial_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->testimonial_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->testimonial_letter_spacing; ?>px;
			<?php endif; ?>
		}
	<?php } ?>
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'testimonial_heading_font_typo',
				'selector'     => ".fl-node-$id .uabb-testimonial-info .testimonial-author-name$id ",
			)
		);
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-designation<?php echo $id; ?> {
	<?php if ( '' != $settings->testimonial_designation_color ) : ?>
		color: <?php echo $settings->testimonial_designation_color; ?>;
	<?php endif; ?>
	margin-top: <?php echo $settings->testimonial_designation_margin_top . 'px'; ?>;
	<?php if ( '' != $settings->testimonial_designation_margin_bottom ) : ?>
		margin-bottom: <?php echo $settings->testimonial_designation_margin_bottom . 'px'; ?>;
	<?php endif; ?>
}
<?php if ( ! $version_bb_check ) { ?>
	<?php if ( isset( $settings->testimonial_designation_font_size_unit ) || isset( $settings->testimonial_designation_line_height_unit ) || 'Default' != $settings->testimonial_designation_font_family['family'] || isset( $settings->testimonial_designation_font_size['desktop'] ) || isset( $settings->testimonial_designation_line_height['desktop'] ) || isset( $settings->testimonial_designation_color ) || isset( $settings->testimonial_designation_margin_top ) || isset( $settings->testimonial_designation_margin_bottom ) || isset( $settings->testimonial_designation_transform ) || isset( $settings->testimonial_designation_letter_spacing ) ) { // Class for designation section. ?>

		.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-designation<?php echo $id; ?> {

			<?php if ( 'Default' != $settings->testimonial_designation_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->testimonial_designation_font_family ); ?>
			<?php endif; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->testimonial_designation_font_size_unit ) && '' != $settings->testimonial_designation_font_size_unit ) {
				?>
				font-size: <?php echo $settings->testimonial_designation_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->testimonial_designation_font_size_unit ) && '' == $settings->testimonial_designation_font_size_unit && isset( $settings->testimonial_designation_font_size['desktop'] ) && '' != $settings->testimonial_designation_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->testimonial_designation_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->testimonial_designation_font_size['desktop'] ) && '' == $settings->testimonial_designation_font_size['desktop'] && isset( $settings->testimonial_designation_line_height['desktop'] ) && '' != $settings->testimonial_designation_line_height['desktop'] && '' == $settings->testimonial_designation_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_designation_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->testimonial_designation_line_height_unit ) && '' != $settings->testimonial_designation_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_designation_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->testimonial_designation_line_height_unit ) && '' == $settings->testimonial_designation_line_height_unit && isset( $settings->testimonial_designation_line_height['desktop'] ) && '' != $settings->testimonial_designation_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->testimonial_designation_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->testimonial_designation_transform ) : ?>
				text-transform: <?php echo $settings->testimonial_designation_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->testimonial_designation_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->testimonial_designation_letter_spacing; ?>px;
			<?php endif; ?>
		}
	<?php } ?>
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'testimonial_designation_font_typo',
				'selector'     => ".fl-node-$id .uabb-testimonial-info .testimonial-author-designation$id ",
			)
		);
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> {
	<?php if ( '' != $settings->testimonial_description_opt_color ) : ?>
		color: <?php echo $settings->testimonial_description_opt_color; ?>;
	<?php endif; ?>
	padding-top: <?php echo $settings->testimonial_description_opt_margin_top . 'px'; ?>;
	<?php if ( '' != $settings->testimonial_description_opt_margin_bottom ) : ?>
		padding-bottom: <?php echo $settings->testimonial_description_opt_margin_bottom . 'px'; ?>;
	<?php endif; ?>
}
<?php if ( ! $version_bb_check ) { ?>
	<?php if ( isset( $settings->testimonial_description_opt_font_size_unit ) || isset( $settings->testimonial_description_opt_line_height_unit ) || 'Default' != $settings->testimonial_description_opt_font_family['family'] || isset( $settings->testimonial_description_opt_font_size['desktop'] ) || isset( $settings->testimonial_description_opt_line_height['desktop'] ) || isset( $settings->testimonial_description_opt_color ) || isset( $settings->testimonial_description_opt_margin_top ) || isset( $settings->testimonial_description_opt_margin_bottom ) ) { // Class for Description section. ?>
		.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> {
			<?php if ( 'Default' != $settings->testimonial_description_opt_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->testimonial_description_opt_font_family ); ?>
			<?php endif; ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_font_size_unit ) && '' != $settings->testimonial_description_opt_font_size_unit ) {
				?>
				font-size: <?php echo $settings->testimonial_description_opt_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->testimonial_description_opt_font_size_unit ) && '' == $settings->testimonial_description_opt_font_size_unit && isset( $settings->testimonial_description_opt_font_size['desktop'] ) && '' != $settings->testimonial_description_opt_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->testimonial_description_opt_font_size['desktop']; ?>px;
			<?php } ?>

				<?php if ( isset( $settings->testimonial_description_opt_font_size['desktop'] ) && '' == $settings->testimonial_description_opt_font_size['desktop'] && isset( $settings->testimonial_description_opt_line_height['desktop'] ) && '' != $settings->testimonial_description_opt_line_height['desktop'] && '' == $settings->testimonial_description_opt_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_description_opt_line_height['desktop']; ?>px;
			<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_line_height_unit ) && '' != $settings->testimonial_description_opt_line_height_unit ) { ?>
				line-height: <?php echo $settings->testimonial_description_opt_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->testimonial_description_opt_line_height_unit ) && '' == $settings->testimonial_description_opt_line_height_unit && isset( $settings->testimonial_description_opt_line_height['desktop'] ) && '' != $settings->testimonial_description_opt_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->testimonial_description_opt_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->testimonial_description_transform ) : ?>
				text-transform: <?php echo $settings->testimonial_description_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->testimonial_description_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->testimonial_description_letter_spacing; ?>px;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> *{
				<?php if ( 'Default' != $settings->testimonial_description_opt_font_family['family'] ) : ?>
				font-family: inherit;
				font-weight: inherit;
			<?php endif; ?>
				<?php if ( isset( $settings->testimonial_description_opt_font_size['desktop'] ) && '' != $settings->testimonial_description_opt_font_size['desktop'] || isset( $settings->testimonial_description_opt_font_size_unit ) && '' != $settings->testimonial_description_opt_font_size_unit ) : ?>
				font-size: inherit;
			<?php endif; ?>
				<?php if ( isset( $settings->testimonial_description_opt_line_height['desktop'] ) && '' != $settings->testimonial_description_opt_line_height['desktop'] || isset( $settings->testimonial_description_opt_line_height_unit ) && '' != $settings->testimonial_description_opt_line_height_unit ) : ?>
				line-height: inherit;
			<?php endif; ?>
				<?php if ( '' != $settings->testimonial_description_opt_color ) : ?>
				color: inherit;
			<?php endif; ?>
		}
		<?php } ?>
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'testimonial_description_font_typo',
				'selector'     => ".fl-node-$id .uabb-testimonial-info .testimonial-author-description$id",
			)
		);
	}
}
?>

/* Typography Media queries*/

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	if ( ! $version_bb_check ) {
		if ( isset( $settings->rating_font_size_unit_medium ) || isset( $settings->testimonial_description_opt_font_size_unit_medium ) || isset( $settings->testimonial_description_opt_line_height_unit_medium ) || isset( $settings->testimonial_description_opt_line_height_unit ) || isset( $settings->testimonial_designation_font_size_unit_medium ) || isset( $settings->testimonial_designation_line_height_unit_medium ) || isset( $settings->testimonial_designation_line_height_unit ) || isset( $settings->testimonial_heading_font_size_unit_medium ) || isset( $settings->testimonial_heading_line_height_unit_medium ) || isset( $settings->testimonial_heading_line_height_unit ) || isset( $settings->testimonial_heading_font_size['medium'] ) || isset( $settings->testimonial_heading_line_height['medium'] ) || isset( $settings->testimonial_designation_font_size['medium'] ) || isset( $settings->testimonial_designation_line_height['medium'] ) || isset( $settings->testimonial_description_opt_font_size['medium'] ) || isset( $settings->testimonial_description_opt_line_height['medium'] ) || isset( $settings->rating_font_size['medium'] ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
				/* Heading section class */

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-name<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_heading_font_size_unit_medium ) && '' != $settings->testimonial_heading_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->testimonial_heading_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->testimonial_heading_font_size_unit_medium ) && '' == $settings->testimonial_heading_font_size_unit_medium && isset( $settings->testimonial_heading_font_size['medium'] ) && '' != $settings->testimonial_heading_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->testimonial_heading_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_heading_font_size['medium'] ) && '' == $settings->testimonial_heading_font_size['medium'] && isset( $settings->testimonial_heading_line_height['medium'] ) && '' != $settings->testimonial_heading_line_height['medium'] && '' == $settings->testimonial_heading_line_height_unit && '' == $settings->testimonial_heading_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_heading_line_height_unit_medium ) && '' != $settings->testimonial_heading_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height_unit_medium; ?>em;
					<?php } elseif ( $settings->testimonial_heading_line_height_unit_medium && '' == $settings->testimonial_heading_line_height_unit_medium && isset( $settings->testimonial_heading_line_height['medium'] ) && '' != $settings->testimonial_heading_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height['medium']; ?>px;
					<?php } ?>
				}

				.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {

					<?php if ( 'yes' === $converted || isset( $settings->rating_font_size_unit_medium ) && '' != $settings->rating_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->rating_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->rating_font_size_unit_medium ) && '' == $settings->rating_font_size_unit_medium && isset( $settings->rating_font_size['medium'] ) && '' != $settings->rating_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->rating_font_size['medium']; ?>px;
					<?php } ?>
				}

				/* Designation section class */

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-designation<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_designation_font_size_unit_medium ) && '' != $settings->testimonial_designation_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->testimonial_designation_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->testimonial_designation_font_size_unit_medium ) && '' == $settings->testimonial_designation_font_size_unit_medium && isset( $settings->testimonial_designation_font_size['medium'] ) && '' != $settings->testimonial_designation_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->testimonial_designation_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_designation_font_size['medium'] ) && '' == $settings->testimonial_designation_font_size['medium'] && isset( $settings->testimonial_designation_line_height['medium'] ) && '' != $settings->testimonial_designation_line_height['medium'] && '' == $settings->testimonial_designation_line_height_unit && '' == $settings->testimonial_designation_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_designation_line_height_unit_medium ) && '' != $settings->testimonial_designation_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->testimonial_designation_line_height_unit_medium ) && '' == $settings->testimonial_designation_line_height_unit_medium && isset( $settings->testimonial_designation_line_height['medium'] ) && '' != $settings->testimonial_designation_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height['medium']; ?>px;
					<?php } ?>
				}


				/* Description section class */

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_font_size_unit_medium ) && '' != $settings->testimonial_description_opt_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->testimonial_description_opt_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->testimonial_description_opt_font_size_unit_medium ) && '' == $settings->testimonial_description_opt_font_size_unit_medium && isset( $settings->testimonial_description_opt_font_size['medium'] ) && '' != $settings->testimonial_description_opt_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->testimonial_description_opt_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_description_opt_font_size['medium'] ) && '' == $settings->testimonial_description_opt_font_size['medium'] && isset( $settings->testimonial_description_opt_line_height['medium'] ) && '' != $settings->testimonial_description_opt_line_height['medium'] && '' == $settings->testimonial_description_opt_line_height_unit_medium && '' == $settings->testimonial_description_opt_line_height_unit ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_line_height_unit_medium ) && '' != $settings->testimonial_description_opt_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->testimonial_description_opt_line_height_unit_medium ) && '' == $settings->testimonial_description_opt_line_height_unit_medium && isset( $settings->testimonial_description_opt_line_height['medium'] ) && '' != $settings->testimonial_description_opt_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height['medium']; ?>px;
					<?php } ?>

				}
				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> *{
					<?php if ( isset( $settings->testimonial_description_opt_font_size['medium'] ) && '' != $settings->testimonial_description_opt_font_size['medium'] || isset( $settings->testimonial_description_opt_font_size_unit_medium ) && '' != $settings->testimonial_description_opt_font_size_unit_medium ) : ?>
					font-size: inherit;
					<?php endif; ?>
					<?php if ( isset( $settings->testimonial_description_opt_line_height['medium'] ) && '' != $settings->testimonial_description_opt_line_height['medium'] || isset( $settings->testimonial_description_opt_line_height_unit_medium ) && '' != $settings->testimonial_description_opt_line_height_unit_medium ) : ?>
					line-height: inherit;
					<?php endif; ?>
				}

			}
			<?php
		}
	}
	?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {
			<?php if ( 'yes' === $converted || isset( $settings->rating_font_size_unit_medium ) && '' != $settings->rating_font_size_unit_medium ) { ?>
				font-size: <?php echo $settings->rating_font_size_unit_medium; ?>px;
			<?php } ?>
		}
	}
	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->rating_font_size_unit_responsive ) || isset( $settings->testimonial_description_opt_font_size_unit_responsive ) || isset( $settings->testimonial_description_opt_line_height_unit_responsive ) || isset( $settings->testimonial_description_opt_line_height_unit_medium ) || isset( $settings->testimonial_description_opt_line_height_unit ) || isset( $settings->testimonial_designation_font_size_unit_responsive ) || isset( $settings->testimonial_designation_line_height_unit_responsive ) || isset( $settings->testimonial_designation_line_height_unit_medium ) || isset( $settings->testimonial_designation_line_height_unit ) || isset( $settings->testimonial_heading_font_size_unit_responsive ) || isset( $settings->testimonial_heading_line_height_unit_responsive ) || isset( $settings->testimonial_heading_line_height_unit_medium ) || isset( $settings->testimonial_heading_line_height_unit ) || isset( $settings->testimonial_heading_font_size['small'] ) || isset( $settings->testimonial_heading_line_height['small'] ) || isset( $settings->testimonial_designation_font_size['small'] ) || isset( $settings->testimonial_designation_line_height['small'] ) || isset( $settings->testimonial_description_opt_font_size['small'] ) || isset( $settings->testimonial_description_opt_line_height['small'] ) || 'top' != $settings->testimonial_image_position || '' != $settings->rating_font_size['small'] || 'stack' == $settings->mobile_view ) {
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				/* Heading section class */
				<?php
				if ( '' != $settings->responsive_img_size ) {
					?>
					.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i,
					.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:before {
						font-size: <?php echo ( $settings->responsive_img_size / 2 ); ?>px;
						line-height: <?php echo $settings->responsive_img_size; ?>px;
						height: <?php echo $settings->responsive_img_size; ?>px;
						width: <?php echo $settings->responsive_img_size; ?>px;
					}
					<?php
				}
				?>

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-name<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_heading_font_size_unit_responsive ) && '' != $settings->testimonial_heading_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->testimonial_heading_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->testimonial_heading_font_size_unit_responsive ) && '' == $settings->testimonial_heading_font_size_unit_responsive && isset( $settings->testimonial_heading_font_size['small'] ) && '' != $settings->testimonial_heading_font_size['small'] ) { ?>
						font-size: <?php echo $settings->testimonial_heading_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_heading_font_size['small'] ) && '' == $settings->testimonial_heading_font_size['small'] && isset( $settings->testimonial_heading_line_height['small'] ) && '' != $settings->testimonial_heading_line_height['small'] && '' == $settings->testimonial_heading_line_height_unit_responsive && '' == $settings->testimonial_heading_line_height_unit_medium && '' == $settings->testimonial_heading_line_height_unit ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_heading_line_height_unit_responsive ) && '' != $settings->testimonial_heading_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->testimonial_heading_line_height_unit_responsive ) && '' == $settings->testimonial_heading_line_height_unit_responsive && isset( $settings->testimonial_heading_line_height['small'] ) && '' != $settings->testimonial_heading_line_height['small'] ) { ?>
						line-height: <?php echo $settings->testimonial_heading_line_height['small']; ?>px;
					<?php } ?>
				}

				/* Designation section class */

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-designation<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_designation_font_size_unit_responsive ) && '' != $settings->testimonial_designation_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->testimonial_designation_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->testimonial_designation_font_size_unit_responsive ) && '' == $settings->testimonial_designation_font_size_unit_responsive && isset( $settings->testimonial_designation_font_size['small'] ) && '' != $settings->testimonial_designation_font_size['small'] ) { ?>
						font-size: <?php echo $settings->testimonial_designation_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_designation_font_size['small'] ) && '' == $settings->testimonial_designation_font_size['small'] && isset( $settings->testimonial_designation_line_height['small'] ) && '' != $settings->testimonial_designation_line_height['small'] && '' == $settings->testimonial_designation_line_height_unit_responsive && '' == $settings->testimonial_designation_line_height_unit_medium && '' == $settings->testimonial_designation_line_height_unit ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_designation_line_height_unit_responsive ) && '' != $settings->testimonial_designation_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->testimonial_designation_line_height_unit_responsive ) && '' == $settings->testimonial_designation_line_height_unit_responsive && isset( $settings->testimonial_designation_line_height['small'] ) && '' != $settings->testimonial_designation_line_height['small'] ) { ?>
						line-height: <?php echo $settings->testimonial_designation_line_height['small']; ?>px;
					<?php } ?>
				}


				/* Description section class */

				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> {

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_font_size_unit_responsive ) && '' != $settings->testimonial_description_opt_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->testimonial_description_opt_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->testimonial_description_opt_font_size_unit_responsive ) && '' == $settings->testimonial_description_opt_font_size_unit_responsive && isset( $settings->testimonial_description_opt_font_size['small'] ) && '' != $settings->testimonial_description_opt_font_size['small'] ) { ?>
						font-size: <?php echo $settings->testimonial_description_opt_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->testimonial_description_opt_font_size['small'] ) && '' == $settings->testimonial_description_opt_font_size['small'] && isset( $settings->testimonial_description_opt_line_height['small'] ) && '' != $settings->testimonial_description_opt_line_height['small'] && '' == $settings->testimonial_description_opt_line_height_unit_responsive && '' == $settings->testimonial_description_opt_line_height_unit_medium && '' == $settings->testimonial_description_opt_line_height_unit ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->testimonial_description_opt_line_height_unit_responsive ) && '' != $settings->testimonial_description_opt_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->testimonial_description_opt_line_height_unit_responsive ) && '' == $settings->testimonial_description_opt_line_height_unit_responsive && isset( $settings->testimonial_description_opt_line_height['small'] ) && '' != $settings->testimonial_description_opt_line_height['small'] ) { ?>
						line-height: <?php echo $settings->testimonial_description_opt_line_height['small']; ?>px;
					<?php } ?>
				}
				.fl-node-<?php echo $id; ?> .uabb-testimonial-info .testimonial-author-description<?php echo $id; ?> *{
					<?php if ( isset( $settings->testimonial_description_opt_font_size['small'] ) && '' != $settings->testimonial_description_opt_font_size['small'] || isset( $settings->testimonial_description_opt_font_size_unit_responsive ) && '' != $settings->testimonial_description_opt_font_size_unit_responsive ) : ?>
					font-size: inherit;
					<?php endif; ?>
					<?php if ( isset( $settings->testimonial_description_opt_line_height['small'] ) && '' != $settings->testimonial_description_opt_line_height['small'] || isset( $settings->testimonial_description_opt_line_height_unit_responsive ) && '' != $settings->testimonial_description_opt_line_height_unit_responsive ) : ?>
					line-height: inherit;
					<?php endif; ?>

				}


				.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {

					<?php if ( 'yes' === $converted || isset( $settings->rating_font_size_unit_responsive ) && '' != $settings->rating_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->rating_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->rating_font_size_unit_responsive ) && '' == $settings->rating_font_size_unit_responsive && isset( $settings->rating_font_size['small'] ) && '' != $settings->rating_font_size['small'] ) { ?>
						font-size: <?php echo $settings->rating_font_size['small']; ?>px;
					<?php } ?>
				}
			}
			<?php
		}
	}
	?>
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		<?php
		if ( '' != $settings->responsive_img_size ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i,
			.fl-node-<?php echo $id; ?> .uabb-icon-wrap .uabb-icon i:before {
				font-size: <?php echo ( $settings->responsive_img_size / 2 ); ?>px;
				line-height: <?php echo $settings->responsive_img_size; ?>px;
				height: <?php echo $settings->responsive_img_size; ?>px;
				width: <?php echo $settings->responsive_img_size; ?>px;
			}
			<?php
		}
		?>
		.fl-node-<?php echo $id; ?> .uabb-testimonial .uabb-rating .uabb-rating__ico {
			<?php if ( isset( $settings->rating_font_size_unit_responsive ) && '' != $settings->rating_font_size_unit_responsive ) { ?>
				font-size: <?php echo $settings->rating_font_size_unit_responsive; ?>px;
			<?php } ?>
		}
		<?php if ( 'stack' == $settings->mobile_view ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial-photo.testimonial-photo<?php echo $id; ?>{
				display: block;
			}
			.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial-info.testimonial-info<?php echo $id; ?> {
				display: block;
			}
			.fl-node-<?php echo $id; ?> .uabb-testimonials .uabb-testimonial-photo.testimonial-photo<?php echo $id; ?> .uabb-module-content {
				width: 100%;
			}
			.fl-node-<?php echo $id; ?> .uabb-testimonial-author.testimonial-author<?php echo $id; ?>,
			.fl-node-<?php echo $id; ?> .uabb-testimonial-author-description.testimonial-author-description<?php echo $id; ?> {
				text-align: center;
			}

		<?php } ?>
	}
	<?php
}
?>
