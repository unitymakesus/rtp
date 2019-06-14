<?php
/**
 *  UABB Team Module front-end CSS php file
 *
 *   @package UABB Team Module
 */

?>
<?php

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->img_bg_color  = UABB_Helper::uabb_colorpicker( $settings, 'img_bg_color', true );
$settings->text_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'text_bg_color', true );

$settings->separator_color = UABB_Helper::uabb_colorpicker( $settings, 'separator_color' );
$settings->color           = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->desg_color      = UABB_Helper::uabb_colorpicker( $settings, 'desg_color' );
$settings->desc_color      = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );

$settings->module_border_radius = ( '' !== trim( $settings->module_border_radius ) ) ? $settings->module_border_radius : '0';
$settings->separator_height     = ( '' !== trim( $settings->separator_height ) ) ? $settings->separator_height : '1';
$settings->separator_width      = ( '' !== trim( $settings->separator_width ) ) ? $settings->separator_width : '100';
?>
/* Alignment */

.fl-node-<?php echo $id; ?> .uabb-team-content,
.fl-node-<?php echo $id; ?> .uabb-team-social {
	text-align: <?php echo $settings->text_alignment; ?>;
}

/* Image Section Spacing */
.fl-node-<?php echo $id; ?> .uabb-team-image {
	<?php

	if ( 'yes' === $converted || '' != $settings->img_spacing_dimension_top && isset( $settings->img_spacing_dimension_top ) && isset( $settings->img_spacing_dimension_bottom ) && '' != $settings->img_spacing_dimension_bottom && isset( $settings->img_spacing_dimension_left ) && '' != $settings->img_spacing_dimension_left && isset( $settings->img_spacing_dimension_right ) && '' != $settings->img_spacing_dimension_right ) {
		if ( isset( $settings->img_spacing_dimension_top ) ) {
			echo ( '' != $settings->img_spacing_dimension_top ) ? 'padding-top:' . $settings->img_spacing_dimension_top . 'px;' : '';
		}
		if ( isset( $settings->img_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->img_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->img_spacing_dimension_bottom . 'px;' : '';
		}
		if ( isset( $settings->img_spacing_dimension_left ) ) {
			echo ( '' != $settings->img_spacing_dimension_left ) ? 'padding-left:' . $settings->img_spacing_dimension_left . 'px;' : '';
		}
		if ( isset( $settings->img_spacing_dimension_right ) ) {
			echo ( '' != $settings->img_spacing_dimension_right ) ? 'padding-right:' . $settings->img_spacing_dimension_right . 'px;' : '';
		}
	} elseif ( isset( $settings->img_spacing ) && '' != $settings->img_spacing && isset( $settings->img_spacing_dimension_top ) && '' == $settings->img_spacing_dimension_top && isset( $settings->img_spacing_dimension_bottom ) && '' == $settings->img_spacing_dimension_bottom && isset( $settings->img_spacing_dimension_left ) && '' == $settings->img_spacing_dimension_left && isset( $settings->img_spacing_dimension_right ) && '' == $settings->img_spacing_dimension_right ) {
		?>
			<?php echo $settings->img_spacing; ?>;
		<?php } ?>


	<?php if ( ! empty( $settings->img_bg_color ) ) { ?>
		background: <?php echo $settings->img_bg_color; ?>;
	<?php } ?>
}

/* Module Border Radius */
<?php if ( '' != $settings->module_border_radius ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-team-wrap {
		border-radius: <?php echo $settings->module_border_radius; ?>px;
	}
	.fl-node-<?php echo $id; ?> .uabb-image .uabb-photo-img {
		border-top-left-radius: <?php echo $settings->module_border_radius; ?>px;
		border-top-right-radius: <?php echo $settings->module_border_radius; ?>px;
	}
<?php } ?>

/* Text BG Color and Spacing */
.fl-node-<?php echo $id; ?> .uabb-team-content {

	<?php
	if ( 'yes' === $converted || isset( $settings->text_spacing_dimension_top ) && isset( $settings->text_spacing_dimension_bottom ) && isset( $settings->text_spacing_dimension_left ) && isset( $settings->text_spacing_dimension_right ) ) {
		if ( isset( $settings->text_spacing_dimension_top ) ) {
			echo ( '' != $settings->text_spacing_dimension_top ) ? 'padding-top:' . $settings->text_spacing_dimension_top . 'px;' : 'padding-top:15px;';
		}
		if ( isset( $settings->text_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->text_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->text_spacing_dimension_bottom . 'px;' : 'padding-bottom:15px;';
		}
		if ( isset( $settings->text_spacing_dimension_left ) ) {
			echo ( '' != $settings->text_spacing_dimension_left ) ? 'padding-left:' . $settings->text_spacing_dimension_left . 'px;' : 'padding-left:15px;';
		}
		if ( isset( $settings->text_spacing_dimension_right ) ) {
			echo ( '' != $settings->text_spacing_dimension_right ) ? 'padding-right:' . $settings->text_spacing_dimension_right . 'px;' : 'padding-right:15px;';
		}
	} elseif ( isset( $settings->text_spacing ) && '' != $settings->text_spacing && isset( $settings->text_spacing_dimension_top ) && '' == $settings->text_spacing_dimension_top && isset( $settings->text_spacing_dimension_bottom ) && '' == $settings->text_spacing_dimension_bottom && isset( $settings->text_spacing_dimension_left ) && '' == $settings->text_spacing_dimension_left && isset( $settings->text_spacing_dimension_right ) && '' == $settings->text_spacing_dimension_right ) {
		?>
				<?php echo $settings->text_spacing; ?>;
			<?php } ?>

	<?php if ( ! empty( $settings->text_bg_color ) ) { ?>
		background: <?php echo $settings->text_bg_color; ?>;
	<?php } ?>
}

<?php

/* Render Separator */

if ( 'block' == $settings->enable_separator ) {
	FLBuilder::render_module_css(
		'uabb-separator', $id, array(
			'color'     => $settings->separator_color,
			'height'    => $settings->separator_height,
			'width'     => $settings->separator_width,
			'alignment' => $settings->separator_alignment,
			'style'     => $settings->separator_style,
		)
	);
	?>

.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-separator {
	margin-top: <?php echo ( '' != $settings->separator_margin_top ) ? $settings->separator_margin_top : '10'; ?>px;
	margin-bottom: <?php echo ( '' != $settings->separator_margin_bottom ) ? $settings->separator_margin_bottom : '10'; ?>px;
}
	<?php
}

/* CSS "$settings" Array */
$imageicon_array = array(

	/* General Section */
	'image_type'              => 'photo',

	/* Icon Basics */
	'icon'                    => '',
	'icon_size'               => '',
	'icon_align'              => '',

	/* Image Basics */
	'photo_source'            => $settings->photo_source,
	'photo'                   => $settings->photo,
	'photo_url'               => $settings->photo_url,
	'img_size'                => $settings->img_size,
	'img_align'               => 'center',
	'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

	/* Icon Style */
	'icon_style'              => '',
	'icon_bg_size'            => '',
	'icon_border_style'       => '',
	'icon_border_width'       => '',
	'icon_bg_border_radius'   => '',

	/* Image Style */
	'image_style'             => $settings->image_style,
	'img_bg_size'             => '',
	'img_border_style'        => '',
	'img_border_width'        => '',
	'img_bg_border_radius'    => '',

	/* Preset Color variable new */
	'icon_color_preset'       => 'preset1',

	/* Icon Colors */
	'icon_color'              => '',
	'icon_hover_color'        => '',
	'icon_bg_color'           => '',
	'icon_bg_hover_color'     => '',
	'icon_border_color'       => '',
	'icon_border_hover_color' => '',
	'icon_three_d'            => '',

	/* Image Colors */
	'img_bg_color'            => '' == $settings->img_bg_color ? '#ffffff' : $settings->img_bg_color,
	'img_bg_hover_color'      => '',
	'img_border_color'        => '',
	'img_border_hover_color'  => '',
);

/* CSS Render Function */
FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
if ( '' != $settings->img_size && '' != $settings->photo ) {
	?>
.fl-node-<?php echo $id; ?> .uabb-image-content {
	width: <?php echo $settings->img_size; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-image .uabb-photo-img {
	width: <?php echo $settings->img_size; ?>px;
}
	<?php
}
?>
<?php
if ( 'simple' == $settings->photo_style ) {
	if ( 'yes' != $settings->img_grayscale_simple ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
			-webkit-filter: grayscale(100%);
			-webkit-filter: grayscale(1);
			filter: grayscale(100%);
		}
		<?php
	}
} elseif ( 'grayscale' == $settings->photo_style ) {
	if ( 'yes' != $settings->img_grayscale_grayscale ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-team-wrap:hover img {
			-webkit-filter: grayscale(0);
			filter: none;
		}
		<?php
	}
}
?>

/* Spacing */
.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
	margin-top: <?php echo ( '' != $settings->name_margin_top ) ? $settings->name_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( '' != $settings->name_margin_bottom ) ? $settings->name_margin_bottom : 0; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
	margin-top: <?php echo ( '' != $settings->desg_margin_top ) ? $settings->desg_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( '' != $settings->desg_margin_bottom ) ? $settings->desg_margin_bottom : 0; ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
	margin-top: <?php echo ( '' != $settings->desc_margin_top ) ? $settings->desc_margin_top : 0; ?>px;
	margin-bottom: <?php echo ( '' != $settings->desc_margin_bottom ) ? $settings->desc_margin_bottom : 15; ?>px;
}

/* Render Social Icons */

<?php
if ( 'yes' == $settings->enable_social_icons ) {
	$icon_count = 1;
	foreach ( $settings->icons as $i => $icon ) :
		$icon->icobg_color           = UABB_Helper::uabb_colorpicker( $icon, 'icobg_color', true );
		$icon->icobg_hover_color     = UABB_Helper::uabb_colorpicker( $icon, 'icobg_hover_color', true );
		$icon->icoborder_color       = UABB_Helper::uabb_colorpicker( $icon, 'icoborder_color' );
		$icon->icoborder_hover_color = UABB_Helper::uabb_colorpicker( $icon, 'icoborder_hover_color' );
		$icon->icocolor              = UABB_Helper::uabb_colorpicker( $icon, 'icocolor' );
		$icon->icohover_color        = UABB_Helper::uabb_colorpicker( $icon, 'icohover_color' );

		$imageicon_array = array(

			/* General Section */
			'image_type'              => 'icon',

			/* Icon Basics */
			'icon'                    => $icon->icon,
			'icon_size'               => $settings->icon_size,
			'icon_align'              => 'center',

			/* Image Basics */
			'photo_source'            => '',
			'photo'                   => '',
			'photo_url'               => '',
			'img_size'                => '',
			'img_align'               => '',
			'photo_src'               => '',

			/* Icon Style */
			'icon_style'              => $settings->icon_style,
			'icon_bg_size'            => ( trim( $settings->icon_bg_size ) !== '' ) ? $settings->icon_bg_size : '30',
			'icon_border_style'       => $settings->icon_border_style,
			'icon_border_width'       => $settings->icon_border_width,
			'icon_bg_border_radius'   => ( trim( $settings->icon_bg_border_radius ) !== '' ) ? $settings->icon_bg_border_radius : '20',

			/* Image Style */
			'image_style'             => '',
			'img_bg_size'             => '',
			'img_border_style'        => '',
			'img_border_width'        => '',
			'img_bg_border_radius'    => '',

			/* Preset Color variable new */
			'icon_color_preset'       => $settings->icon_color_preset,

			/* Icon Colors */
			'icon_color'              => ( ! empty( $icon->icocolor ) ) ? $icon->icocolor : $settings->icon_color,
			'icon_hover_color'        => ( ! empty( $icon->icohover_color ) ) ? $icon->icohover_color : $settings->icon_hover_color,
			'icon_bg_color'           => ( ! empty( $icon->icobg_color ) ) ? $icon->icobg_color : $settings->icon_bg_color,
			'icon_bg_color_opc'       => ( ! empty( $icon->icobg_color_opc ) ) ? $icon->icobg_color_opc : $settings->icon_bg_color_opc,
			'icon_bg_hover_color'     => ( ! empty( $icon->icobg_hover_color ) ) ? $icon->icobg_hover_color : $settings->icon_bg_hover_color,
			'icon_bg_hover_color_opc' => ( ! empty( $icon->icobg_hover_color_opc ) ) ? $icon->icobg_hover_color_opc : $settings->icon_bg_hover_color_opc,
			'icon_border_color'       => ( ! empty( $icon->icoborder_color ) ) ? $icon->icoborder_color : $settings->icon_border_color,
			'icon_border_hover_color' => ( ! empty( $icon->icoborder_hover_color ) ) ? $icon->icoborder_hover_color : $settings->icon_border_hover_color,
			'icon_three_d'            => $settings->icon_three_d,

			/* Image Colors */
			'img_bg_color'            => '',
			'img_bg_hover_color'      => '',
			'img_border_color'        => '',
			'img_border_hover_color'  => '',
		);
		FLBuilder::render_module_css( 'image-icon', $id . ' .uabb-team-icon-' . $icon_count, $imageicon_array );
		$icon_count = $icon_count + 1;
	endforeach;
	?>

	<?php if ( 'left' == $settings->text_alignment ) { ?>
		<?php $social_margin = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10'; ?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 <?php echo $social_margin; ?>px <?php echo $social_margin; ?>px 0;
		}
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link:last-child {
			margin-right: 0px;
		}
	<?php } elseif ( 'right' == $settings->text_alignment ) { ?>
		<?php $social_margin = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10'; ?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 0 <?php echo $social_margin; ?>px <?php echo $social_margin; ?>px;  
		}
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link:first-child {
			margin-left: 0px;
		}
	<?php } else { ?>
		<?php
		$social_margin        = ( trim( $settings->spacing ) !== '' ) ? $settings->spacing : '10';
			$social_margin_lr = ( intval( $social_margin ) !== 0 ) ? intval( $social_margin ) / 2 : $social_margin;
		?>
		.fl-node-<?php echo $id; ?> .uabb-team-icon-link {
			margin: 0 <?php echo $social_margin_lr; ?>px <?php echo $social_margin; ?>px <?php echo $social_margin_lr; ?>px;  
		}
	<?php } ?>

<?php } ?>

/* Typography */
/* Name Text Typography */

.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {
	<?php if ( '' != $settings->color ) : ?>
		color: <?php echo $settings->color; ?>;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {

		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
		font-family: <?php echo $settings->font_family['family']; ?>;
				<?php if ( 'regular' != $settings->font_family['weight'] ) : ?>
				font-weight: <?php echo $settings->font_family['weight']; ?>;
				<?php endif; ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) {
			?>
			font-size: <?php echo $settings->font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
		<?php } ?>	

		<?php if ( isset( $settings->font_size['desktop'] ) && '' == $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] && '' == $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' != $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' == $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->transform ) : ?>
			text-transform: <?php echo $settings->transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'name_typo',
				'selector'     => ".fl-node-$id .uabb-team-name-text",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
	<?php if ( '' != $settings->desg_color ) : ?>
		color: <?php echo $settings->desg_color; ?>;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	/* Designation Text Typography */
	.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {
		<?php if ( 'Default' != $settings->desg_font_family['family'] ) : ?>
		font-family: <?php echo $settings->desg_font_family['family']; ?>;
				<?php if ( 'regular' != $settings->desg_font_family['weight'] ) : ?>
				font-weight: <?php echo $settings->desg_font_family['weight']; ?>;
				<?php endif; ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->desg_font_size_unit ) && '' != $settings->desg_font_size_unit ) {
			?>
			font-size: <?php echo $settings->desg_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->desg_font_size_unit ) && '' == $settings->desg_font_size_unit && isset( $settings->desg_font_size['desktop'] ) && '' != $settings->desg_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->desg_font_size['desktop']; ?>px;
		<?php } ?>	

		<?php if ( isset( $settings->desg_font_size['desktop'] ) && '' == $settings->desg_font_size['desktop'] && isset( $settings->desg_line_height['desktop'] ) && '' != $settings->desg_line_height['desktop'] && '' == $settings->desg_line_height_unit ) { ?>
			line-height: <?php echo $settings->desg_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desg_line_height_unit ) && '' != $settings->desg_line_height_unit ) { ?>
			line-height: <?php echo $settings->desg_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->desg_line_height_unit ) && '' == $settings->desg_line_height_unit && isset( $settings->desg_line_height['desktop'] ) && '' != $settings->desg_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->desg_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->desg_transform ) : ?>
			text-transform: <?php echo $settings->desg_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->desg_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->desg_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desg_typo',
				'selector'     => ".fl-node-$id .uabb-team-desgn-text",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
	<?php if ( '' != $settings->desc_color ) : ?>
		color: <?php echo $settings->desc_color; ?>;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	/* Description Text Typography */
	.fl-node-<?php echo $id; ?> .uabb-team-desc-text {
		<?php if ( 'Default' != $settings->desc_font_family['family'] ) : ?>
		font-family: <?php echo $settings->desc_font_family['family']; ?>;
				<?php if ( 'regular' != $settings->desc_font_family['weight'] ) : ?>
				font-weight: <?php echo $settings->desc_font_family['weight']; ?>;
				<?php endif; ?>
		<?php endif; ?>

		<?php
		if ( 'yes' === $converted || isset( $settings->desc_font_size_unit ) && '' != $settings->desc_font_size_unit ) {
			?>
			font-size: <?php echo $settings->desc_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->desc_font_size_unit ) && '' == $settings->desc_font_size_unit && isset( $settings->desc_font_size['desktop'] ) && '' != $settings->desc_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->desc_font_size['desktop']; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->desc_font_size['desktop'] ) && '' == $settings->desc_font_size['desktop'] && isset( $settings->desc_line_height['desktop'] ) && '' != $settings->desc_line_height['desktop'] && '' == $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit ) && '' != $settings->desc_line_height_unit ) { ?>
			line-height: <?php echo $settings->desc_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->desc_line_height_unit ) && '' == $settings->desc_line_height_unit && isset( $settings->desc_line_height['desktop'] ) && '' != $settings->desc_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->desc_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->desc_transform ) : ?>
			text-transform: <?php echo $settings->desc_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->desc_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->desc_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_typo',
				'selector'     => ".fl-node-$id .uabb-team-desc-text",
			)
		);
	}
}
?>


<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	/* Medium Breakpoint media query */
	?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

		.fl-node-<?php echo $id; ?> .uabb-team-image {
			<?php
			if ( isset( $settings->img_spacing_dimension_top_medium ) ) {
				echo ( '' != $settings->img_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->img_spacing_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->img_spacing_dimension_bottom_medium ) ) {
				echo ( '' != $settings->img_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->img_spacing_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->img_spacing_dimension_left_medium ) ) {
				echo ( '' != $settings->img_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->img_spacing_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->img_spacing_dimension_right_medium ) ) {
				echo ( '' != $settings->img_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->img_spacing_dimension_right_medium . 'px;' : '';
			}
			?>
		}

		.fl-node-<?php echo $id; ?> .uabb-team-content {

			<?php
			if ( isset( $settings->text_spacing_dimension_top_medium ) ) {
				echo ( '' != $settings->text_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->text_spacing_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->text_spacing_dimension_bottom_medium ) ) {
				echo ( '' != $settings->text_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->text_spacing_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->text_spacing_dimension_left_medium ) ) {
				echo ( '' != $settings->text_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->text_spacing_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->text_spacing_dimension_right_medium ) ) {
				echo ( '' != $settings->text_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->text_spacing_dimension_right_medium . 'px;' : '';
			}
			?>
		}

		<?php
		if ( ! $version_bb_check ) {
			if ( isset( $settings->font_size['medium'] ) || isset( $settings->line_height['medium'] ) ||
			isset( $settings->desg_font_size['medium'] ) || isset( $settings->desg_line_height['medium'] )
			|| isset( $settings->desc_font_size['medium'] ) || isset(
				$settings->desc_line_height['medium']
			) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) ||
			isset( $settings->desg_font_size_unit_medium ) || isset(
				$settings->desg_line_height_unit_medium
			) || isset( $settings->desc_font_size_unit_medium ) || isset( $settings->desc_line_height_unit_medium ) || isset( $settings->desg_line_height_unit ) ) {
				?>

				/* Name Text Typography */
				.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->line_height_unit_medium && '' != $settings->font_size_unit_medium ) { ?>
							line-height: <?php $settings->font_size_unit_medium + 2; ?>px;
						<?php } ?>	
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
						font-size: <?php echo $settings->font_size['medium']; ?>px;
						line-height: <?php $settings->font_size['medium'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size['medium'] ) && '' == $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height_unit_medium; ?>em;	
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>
				}

				/* Desg Text */
				.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {

					<?php if ( 'yes' === $converted || isset( $settings->desg_font_size_unit_medium ) && '' != $settings->desg_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->desg_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->desg_font_size_unit_medium ) && '' == $settings->desg_font_size_unit_medium && isset( $settings->desg_font_size['medium'] ) && '' != $settings->desg_font_size['medium'] ) { ?> 
						font-size: <?php echo $settings->desg_font_size['medium']; ?>px;
					<?php } ?> 

					<?php if ( isset( $settings->desg_font_size['medium'] ) && '' == $settings->desg_font_size['medium'] && isset( $settings->desg_line_height['medium'] ) && '' != $settings->desg_line_height['medium'] && '' == $settings->desg_line_height_unit_medium && '' == $settings->desg_line_height_unit ) { ?>
							line-height: <?php echo $settings->desg_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desg_line_height_unit_medium ) && '' != $settings->desg_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->desg_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->desg_line_height_unit_medium ) && '' == $settings->desg_line_height_unit_medium && isset( $settings->desg_line_height['medium'] ) && '' != $settings->desg_line_height['medium'] ) { ?> 
						line-height: <?php echo $settings->desg_line_height['medium']; ?>px;
					<?php } ?> 
				}

				/* Desc Text */
				.fl-node-<?php echo $id; ?> .uabb-team-desc-text {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_medium ) && '' != $settings->desc_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->desc_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_medium ) && '' == $settings->desc_font_size_unit_medium && isset( $settings->desc_font_size['medium'] ) && '' != $settings->desc_font_size['medium'] ) { ?> 
						font-size: <?php echo $settings->desc_font_size['medium']; ?>px;
					<?php } ?> 

					<?php if ( isset( $settings->desc_font_size['medium'] ) && '' == $settings->desc_font_size['medium'] && isset( $settings->desc_line_height['medium'] ) && '' != $settings->desc_line_height['medium'] && '' == $settings->desc_line_height_unit_medium && '' == $settings->desc_line_height_unit ) { ?>
							line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_medium ) && '' != $settings->desc_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->desc_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->desc_line_height_unit_medium ) && '' == $settings->desc_line_height_unit_medium && isset( $settings->desc_line_height['medium'] ) && '' != $settings->desc_line_height['medium'] ) { ?> 
						line-height: <?php echo $settings->desc_line_height['medium']; ?>px;
					<?php } ?>  
				}
				<?php
			}
		}
		?>
	}		
	<?php
		/* Small Breakpoint media query */
	?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			.fl-node-<?php echo $id; ?> .uabb-team-content {

				<?php
				if ( isset( $settings->text_spacing_dimension_top_responsive ) ) {
					echo ( '' != $settings->text_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->text_spacing_dimension_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->text_spacing_dimension_bottom_responsive ) ) {
					echo ( '' != $settings->text_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->text_spacing_dimension_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->text_spacing_dimension_left_responsive ) ) {
					echo ( '' != $settings->text_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->text_spacing_dimension_left_responsive . 'px;' : '';
				}
				if ( isset( $settings->text_spacing_dimension_right_responsive ) ) {
					echo ( '' != $settings->text_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->text_spacing_dimension_right_responsive . 'px;' : '';
				}
				?>
			}

			.fl-node-<?php echo $id; ?> .uabb-team-image {
				<?php
				if ( isset( $settings->img_spacing_dimension_top_responsive ) ) {
					echo ( '' != $settings->img_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->img_spacing_dimension_top_responsive . 'px;' : '';
				}
				if ( isset( $settings->img_spacing_dimension_bottom_responsive ) ) {
					echo ( '' != $settings->img_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->img_spacing_dimension_bottom_responsive . 'px;' : '';
				}
				if ( isset( $settings->img_spacing_dimension_left_responsive ) ) {
					echo ( '' != $settings->img_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->img_spacing_dimension_left_responsive . 'px;' : '';
				}
				if ( isset( $settings->img_spacing_dimension_right_responsive ) ) {
					echo ( '' != $settings->img_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->img_spacing_dimension_right_responsive . 'px;' : '';
				}
				?>
			}

			<?php
			if ( ! $version_bb_check ) {
				if ( isset( $settings->font_size['small'] ) || isset( $settings->line_height['small'] ) ||
					isset( $settings->desg_font_size['small'] ) || isset( $settings->desg_line_height['small'] ) ||
					isset( $settings->desc_font_size['small'] ) || isset( $settings->desc_line_height['small'] ) ||
					isset( $settings->font_size_unit_responsive ) || isset( $settings->line_height_unit_responsive )
					|| isset( $settings->desg_font_size_unit_responsive ) || isset( $settings->desg_line_height_unit_responsive ) || isset( $settings->desc_font_size_unit_responsive ) || '' != $settings->desc_line_height_unit_responsive ) {
					?>
					/* Name Text Typography */
					.fl-node-<?php echo $id; ?> <?php echo $settings->tag_selection; ?>.uabb-team-name-text {

						<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
							<?php if ( '' == $settings->line_height_unit_responsive && '' != $settings->font_size_unit_responsive ) { ?>
								line-height: <?php echo $settings->font_size_unit_responsive + 2; ?>px;
							<?php } ?>	
						<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
							font-size: <?php echo $settings->font_size['small']; ?>px;
							line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
							<?php } ?>		
					   
						<?php if ( isset( $settings->font_size['small'] ) && '' == $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
								line-height: <?php echo $settings->line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
							line-height: <?php echo $settings->line_height['small']; ?>px;
						<?php } ?>
					}

					/* Desg Text */
					.fl-node-<?php echo $id; ?> .uabb-team-desgn-text {

						<?php if ( 'yes' === $converted || isset( $settings->desg_font_size_unit_responsive ) && '' != $settings->desg_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->desg_font_size_unit_responsive; ?>px;
							<?php if ( '' == $settings->desg_line_height_unit_responsive && '' != $settings->desg_font_size_unit_responsive ) { ?>
								line-height: <?php $settings->desg_font_size_unit_responsive + 2; ?>px;
							<?php } ?>	
						<?php } elseif ( isset( $settings->desg_font_size_unit_responsive ) && '' == $settings->desg_font_size_unit_responsive && isset( $settings->desg_font_size['small'] ) && '' != $settings->desg_font_size['small'] ) { ?> 
							font-size: <?php echo $settings->desg_font_size['small']; ?>px;
							line-height: <?php $settings->desg_font_size['small'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->desg_font_size['small'] ) && '' == $settings->desg_font_size['small'] && isset( $settings->desg_line_height['small'] ) && '' != $settings->desg_line_height['small'] && '' == $settings->desg_line_height_unit_responsive && '' == $settings->desg_line_height_unit_medium && '' == $settings->desg_line_height_unit ) { ?>
								line-height: <?php echo $settings->desg_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->desg_line_height_unit_responsive ) && '' != $settings->desg_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->desg_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->desg_line_height_unit_responsive ) && '' == $settings->desg_line_height_unit_responsive && isset( $settings->desg_line_height['small'] ) && '' != $settings->desg_line_height['small'] ) { ?> 
							line-height: <?php echo $settings->desg_line_height['small']; ?>px;
						<?php } ?>
					}

					/* Desc Text */
					.fl-node-<?php echo $id; ?> .uabb-team-desc-text {

						<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_responsive ) && '' != $settings->desc_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->desc_font_size_unit_responsive; ?>px;
							<?php if ( '' == $settings->desc_line_height_unit_responsive && '' != $settings->desc_font_size_unit_responsive ) { ?>
								line-height: <?php echo $settings->desc_font_size_unit_responsive + 2; ?>px;
							<?php } ?>	
						<?php } elseif ( isset( $settings->desc_font_size_unit_responsive ) && '' == $settings->desc_font_size_unit_responsive && isset( $settings->desc_font_size['small'] ) && '' != $settings->desc_font_size['small'] ) { ?> 
							font-size: <?php echo $settings->desc_font_size['small']; ?>px;
							line-height: <?php $settings->desc_font_size['small'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->desc_font_size['small'] ) && '' == $settings->desc_font_size['small'] && isset( $settings->desc_line_height['small'] ) && '' != $settings->desc_line_height['small'] && '' == $settings->desc_line_height_unit_responsive && '' == $settings->desc_line_height_unit_medium && '' == $settings->desc_line_height_unit ) { ?>
								line-height: <?php echo $settings->desc_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_responsive ) && '' != $settings->desc_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->desc_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->desc_line_height_unit_responsive ) && '' == $settings->desc_line_height_unit_responsive && isset( $settings->desc_line_height['small'] ) && '' != $settings->desc_line_height['small'] ) { ?> 
							line-height: <?php echo $settings->desc_line_height['small']; ?>px;
						<?php } ?>
					}
					<?php
				}
			}
			?>
		}		
	<?php
}
