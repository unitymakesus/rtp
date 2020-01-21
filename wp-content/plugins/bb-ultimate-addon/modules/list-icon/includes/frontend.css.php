<?php
/**
 *  UABB Icon List Module front-end CSS php file
 *
 *  @package UABB Icon List Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->typography_color = UABB_Helper::uabb_colorpicker( $settings, 'typography_color' );

$settings->icon_text_spacing     = ( '' != $settings->icon_text_spacing ) ? $settings->icon_text_spacing : '10';
$settings->img_size              = ( '' != $settings->img_size ) ? $settings->img_size : '50';
$settings->icon_size             = ( '' != $settings->icon_size ) ? $settings->icon_size : '30';
$settings->icon_bg_size          = ( '' != $settings->icon_bg_size ) ? $settings->icon_bg_size : '10';
$settings->icon_bg_border_radius = ( '' != $settings->icon_bg_border_radius ) ? $settings->icon_bg_border_radius : '0';
$settings->img_border_width      = ( '' != $settings->img_border_width ) ? $settings->img_border_width : '1';
$settings->icon_border_width     = ( '' != $settings->icon_border_width ) ? $settings->icon_border_width : '1';

/* Render CSS */

/* CSS "$settings" Array */

if ( $version_bb_check ) {
	$imageicon_array = array(

		/* General Section */
		'image_type'              => $settings->image_type,

		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => '',

		/* Image Basics */
		'photo_source'            => $settings->photo_source,
		'photo'                   => $settings->photo,
		'photo_url'               => $settings->photo_url,
		'img_size'                => $settings->img_size,
		'img_align'               => '',
		'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

		/* Icon Style */
		'icon_style'              => $settings->icon_style,
		'icon_bg_size'            => $settings->icon_bg_size,
		'icon_border_style'       => $settings->icon_border_style,
		'icon_border_width'       => $settings->icon_border_width,
		'icon_bg_border_radius'   => $settings->icon_bg_border_radius,

		/* Image Style */
		'image_style'             => $settings->image_style,
		'img_bg_size'             => $settings->img_bg_size,
		'img_border_style'        => $settings->img_border_style,
		'img_border_width'        => $settings->img_border_width,
		'img_bg_border_radius'    => $settings->img_bg_border_radius,

		/* Preset Color variable new */
		'icon_color_preset'       => 'preset1',

		/* Icon Colors */
		'icon_color'              => $settings->icon_color,
		'icon_hover_color'        => $settings->icon_hover_color,
		'icon_bg_color'           => $settings->icon_bg_color,
		'icon_bg_hover_color'     => $settings->icon_bg_hover_color,
		'icon_border_color'       => $settings->icon_border_color,
		'icon_border_hover_color' => $settings->icon_border_hover_color,
		'icon_three_d'            => $settings->icon_three_d,

		/* Image Colors */
		'img_bg_color'            => $settings->img_bg_color,
		'img_bg_hover_color'      => $settings->img_bg_hover_color,
		'img_border_color'        => $settings->img_border_color,
		'img_border_hover_color'  => $settings->img_border_hover_color,
	);
} else {
	$imageicon_array = array(

		/* General Section */
		'image_type'              => $settings->image_type,

		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => '',

		/* Image Basics */
		'photo_source'            => $settings->photo_source,
		'photo'                   => $settings->photo,
		'photo_url'               => $settings->photo_url,
		'img_size'                => $settings->img_size,
		'img_align'               => '',
		'photo_src'               => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

		/* Icon Style */
		'icon_style'              => $settings->icon_style,
		'icon_bg_size'            => $settings->icon_bg_size,
		'icon_border_style'       => $settings->icon_border_style,
		'icon_border_width'       => $settings->icon_border_width,
		'icon_bg_border_radius'   => $settings->icon_bg_border_radius,

		/* Image Style */
		'image_style'             => $settings->image_style,
		'img_bg_size'             => $settings->img_bg_size,
		'img_border_style'        => $settings->img_border_style,
		'img_border_width'        => $settings->img_border_width,
		'img_bg_border_radius'    => $settings->img_bg_border_radius,

		/* Preset Color variable new */
		'icon_color_preset'       => 'preset1',

		/* Icon Colors */
		'icon_color'              => $settings->icon_color,
		'icon_hover_color'        => $settings->icon_hover_color,
		'icon_bg_color'           => $settings->icon_bg_color,
		'icon_bg_color_opc'       => $settings->icon_bg_color_opc,
		'icon_bg_hover_color'     => $settings->icon_bg_hover_color,
		'icon_bg_hover_color_opc' => $settings->icon_bg_hover_color_opc,
		'icon_border_color'       => $settings->icon_border_color,
		'icon_border_hover_color' => $settings->icon_border_hover_color,
		'icon_three_d'            => $settings->icon_three_d,

		/* Image Colors */
		'img_bg_color'            => $settings->img_bg_color,
		'img_bg_color_opc'        => $settings->img_bg_color_opc,
		'img_bg_hover_color'      => $settings->img_bg_hover_color,
		'img_bg_hover_color_opc'  => $settings->img_bg_hover_color_opc,
		'img_border_color'        => $settings->img_border_color,
		'img_border_hover_color'  => $settings->img_border_hover_color,
	);
}

/* CSS Render Function */
FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );

?>

.fl-node-<?php echo $id; ?> .uabb-callout-outter,
.fl-node-<?php echo $id; ?> .uabb-list-icon-text {
	display: inline-block;
	vertical-align: middle;
}

<?php
if ( 'center' == $settings->align ) {
	if ( 'photo' == $settings->image_type ) {
		?>
.fl-node-<?php echo $id; ?> .uabb-image .uabb-image-content {
		<?php
		$width = $settings->img_size;
		if ( 'custom' == $settings->image_style ) {
			$width = $width + ( 2 * $settings->img_bg_size ) + ( 2 * $settings->img_border_width );
		}
		?>
	width: <?php echo $width; ?>px;
}
		<?php
	}
}
?>


/* Left */
<?php if ( 'horizontal' == $settings->icon_struc_align ) { ?>
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap  {
	margin-bottom: 15px;
	<?php
	if ( 'flex-start' == $settings->align ) {
		?>
	margin-right: <?php echo ( '' != $settings->spacing ) ? $settings->spacing : '10'; ?>px;
	margin-left:0;
		<?php
	} elseif ( 'flex-end' == $settings->align ) {
		?>
	margin-left: <?php echo ( '' != $settings->spacing ) ? $settings->spacing : '10'; ?>px;
	margin-right:0;
		<?php
	} else {
		?>
	margin-left: <?php echo ( '' != $settings->spacing ) ? ( $settings->spacing / 2 ) : '5'; ?>px;
	margin-right: <?php echo ( '' != $settings->spacing ) ? ( $settings->spacing / 2 ) : '5'; ?>px;
		<?php
	}
	?>
}
<?php } else { ?>
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap:not(:last-child)  {
	margin-bottom: <?php echo ( '' != $settings->spacing ) ? $settings->spacing : '10'; ?>px;
}
<?php } ?>
<?php if ( 'flex-end' == $settings->align ) { ?>
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap {
	direction: rtl;  
	text-align: right;  
}
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap .uabb-list-icon-text {
	direction: ltr;  
}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap .uabb-callout-outter {
	<?php if ( 'flex-end' == $settings->align ) { ?>
	margin-left: <?php echo ( '' !== $settings->icon_text_spacing ) ? $settings->icon_text_spacing : '10'; ?>px;    
	<?php } else { ?>
	margin-right: <?php echo ( '' !== $settings->icon_text_spacing ) ? $settings->icon_text_spacing : '10'; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap .uabb-list-icon-text {
	<?php
	if ( 'icon' == $settings->image_type ) {
		$im_icon_backside = 0;
		$im_icon_size     = 0;
		if ( '' != $settings->icon && 'custom' == $settings->icon_style ) {
			$im_icon_backside = $settings->icon_bg_size + ( $settings->icon_border_width * 2 );
			$im_icon_size     = $settings->icon_size;
		} elseif ( '' != $settings->icon && 'circle' == $settings->icon_style || 'square' == $settings->icon_style ) {
			$im_icon_size = $settings->icon_size * 2;
		} elseif ( '' != $settings->icon && 'simple' == $settings->icon_style ) {
			$im_icon_size = $settings->icon_size;
		} else {
			$im_icon_backside = 0;
			$im_icon_size     = 0;
		}

		$get_icon_img_width = $im_icon_size + $im_icon_backside + $settings->icon_text_spacing;
	} elseif ( 'photo' == $settings->image_type ) {
		if ( 'custom' == $settings->image_style ) {
			$im_backside = ( $settings->img_bg_size * 2 ) + ( $settings->img_border_width * 2 );
		} else {
			$im_backside = 0;
		}

		$get_icon_img_width = $settings->img_size + $im_backside + $settings->icon_text_spacing;
	} else {
		$get_icon_img_width = 0;
	}
	?>

	<?php if ( 'horizontal' == $settings->icon_struc_align || ( 'vertical' == $settings->icon_struc_align && 'center' != $settings->align ) ) { ?>

	width: calc( 100% - <?php echo $get_icon_img_width; ?>px  );
	<?php } ?>
}

<?php
	$flex_align = $settings->align;
	$v_align    = ( 'center' != $flex_align ) ? str_replace( 'flex-', '', $flex_align ) : $flex_align;
?>

<?php if ( 'horizontal' == $settings->icon_struc_align ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-list-icon {
		-webkit-flex-wrap: wrap;
			-ms-flex-wrap: wrap;
				flex-wrap: wrap;

		-webkit-box-orient: horizontal;
		-webkit-box-direction: normal;
		-webkit-flex-direction: row;
			-ms-flex-direction: row;
				flex-direction: row;

		-webkit-box-pack: <?php echo $v_align; ?>;
		-webkit-justify-content: <?php echo $flex_align; ?>;
		-ms-flex-pack: <?php echo $v_align; ?>;
				justify-content: <?php echo $flex_align; ?>;
	}
<?php } ?>

?>

.fl-node-<?php echo $id; ?> .uabb-list-icon {
	-webkit-box-align: <?php echo $flex_align; ?>;
	-webkit-align-items: <?php echo $v_align; ?>;
	-ms-flex-align: <?php echo $v_align; ?>;
	align-items: <?php echo $flex_align; ?>;
}

<?php if ( 'vertical' == $settings->icon_struc_align ) { ?>
.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap {
	-webkit-justify-content: <?php echo $flex_align; ?>;
			justify-content: <?php echo $flex_align; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-list-icon .uabb-list-icon-text .uabb-list-icon-text-heading {
	<?php if ( ! empty( $settings->typography_color ) ) : ?>
		color : <?php echo $settings->typography_color; ?>;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-list-icon .uabb-list-icon-text .uabb-list-icon-text-heading {

		<?php
		if ( 'Default' != $settings->typography_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->typography_font_family );
		}
		?>

		<?php if ( 'yes' === $converted || isset( $settings->typography_font_size_unit ) && '' != $settings->typography_font_size_unit ) { ?>
			font-size: <?php echo $settings->typography_font_size_unit; ?>px;
		<?php } elseif ( isset( $settings->typography_font_size_unit ) && '' == $settings->typography_font_size_unit && isset( $settings->typography_font_size['desktop'] ) && '' != $settings->typography_font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->typography_font_size['desktop']; ?>px;
			<?php } ?>

		<?php if ( isset( $settings->typography_font_size['desktop'] ) && '' == $settings->typography_font_size['desktop'] && isset( $settings->typography_line_height['desktop'] ) && '' != $settings->typography_line_height['desktop'] && '' == $settings->typography_line_height_unit ) { ?>
			line-height: <?php echo $settings->typography_line_height['desktop']; ?>px;
		<?php } ?>  

		<?php if ( 'yes' === $converted || isset( $settings->typography_line_height_unit ) && '' != $settings->typography_line_height_unit ) { ?>
			line-height: <?php echo $settings->typography_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->typography_line_height_unit ) && '' == $settings->typography_line_height_unit && isset( $settings->typography_line_height['desktop'] ) && '' != $settings->typography_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->typography_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'none' != $settings->typography_transform ) : ?>
			text-transform: <?php echo $settings->typography_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->typography_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->typography_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'font_typo',
				'selector'     => ".fl-node-$id .uabb-list-icon .uabb-list-icon-text .uabb-list-icon-text-heading",
			)
		);
	}
}
?>

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.

	if ( ! $version_bb_check ) {
		?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

			.fl-node-<?php echo $id; ?> .uabb-list-icon .uabb-list-icon-text .uabb-list-icon-text-heading {

				<?php if ( 'yes' === $converted || isset( $settings->typography_font_size_unit_medium ) && '' != $settings->typography_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->typography_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->typography_font_size_unit_medium ) && '' == $settings->typography_font_size_unit_medium && isset( $settings->typography_font_size['medium'] ) && '' != $settings->typography_font_size['medium'] ) { ?> 
					font-size: <?php echo $settings->typography_font_size['medium']; ?>px;
				<?php } ?> 

				<?php if ( isset( $settings->typography_font_size['medium'] ) && '' == $settings->typography_font_size['medium'] && isset( $settings->typography_line_height['medium'] ) && '' != $settings->typography_line_height['medium'] && '' == $settings->typography_line_height_unit_medium && '' == $settings->typography_line_height_unit ) : ?>
					line-height: <?php echo $settings->typography_line_height['medium']; ?>px;
				<?php endif; ?>

				<?php if ( 'yes' === $converted || isset( $settings->typography_line_height_unit_medium ) && '' != $settings->typography_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->typography_line_height_unit_medium; ?>em;
				<?php } elseif ( isset( $settings->typography_line_height_unit_medium ) && '' == $settings->typography_line_height_unit_medium && isset( $settings->typography_line_height['medium'] ) && '' != $settings->typography_line_height['medium'] ) { ?> 
					line-height: <?php echo $settings->typography_line_height['medium']; ?>px;
				<?php } ?>
			}
		}

		@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

			.fl-node-<?php echo $id; ?> .uabb-list-icon .uabb-list-icon-text .uabb-list-icon-text-heading {

				<?php if ( 'yes' === $converted || isset( $settings->typography_font_size_unit_responsive ) && '' != $settings->typography_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->typography_font_size_unit_responsive; ?>px;
					<?php if ( '' == $settings->typography_line_height_unit_responsive && '' != $settings->typography_font_size_unit_responsive ) { ?>
						line-height: <?php echo $settings->typography_font_size_unit_responsive + 2; ?>px;
					<?php } ?>    
				<?php } elseif ( isset( $settings->typography_font_size_unit_responsive ) && '' == $settings->typography_font_size_unit_responsive && isset( $settings->typography_font_size['small'] ) && '' != $settings->typography_font_size['small'] ) { ?>
					font-size: <?php echo $settings->typography_font_size['small']; ?>px;
					line-height: <?php echo $settings->typography_font_size['small'] + 2; ?>px;
					<?php } ?>

				<?php if ( isset( $settings->typography_font_size['small'] ) && '' == $settings->typography_font_size['small'] && isset( $settings->typography_line_height['small'] ) && '' != $settings->typography_line_height['small'] && '' == $settings->typography_line_height_unit_responsive && '' == $settings->typography_line_height_unit_medium && '' == $settings->typography_line_height_unit ) : ?>
					line-height: <?php echo $settings->typography_line_height['small']; ?>px;
				<?php endif; ?>

				<?php if ( 'yes' === $converted || isset( $settings->typography_line_height_unit_responsive ) && '' != $settings->typography_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->typography_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->typography_line_height_unit_responsive ) && '' == $settings->typography_line_height_unit_responsive && isset( $settings->typography_line_height['small'] ) && '' != $settings->typography_line_height['small'] ) { ?> 
					line-height: <?php echo $settings->typography_line_height['small']; ?>px;
				<?php } ?>
			}
			.fl-node-<?php echo $id; ?> .uabb-list-icon-wrap  {
				margin-bottom: <?php echo ( '' !== $settings->mobile_spacing ) ? $settings->mobile_spacing : '10'; ?>px;
			}
		}
<?php }
} ?>
