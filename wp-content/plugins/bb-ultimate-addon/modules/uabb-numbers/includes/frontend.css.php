<?php
/**
 *  UABB Counter Module front-end CSS php file
 *
 *  @package UABB Counter Module
 */

?>
/* Global Number Counter CSS */
<?php

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->separator_color = UABB_Helper::uabb_colorpicker( $settings, 'separator_color' );
$settings->circle_color    = UABB_Helper::uabb_colorpicker( $settings, 'circle_color', true );
$settings->circle_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'circle_bg_color', true );
$settings->bar_color       = UABB_Helper::uabb_colorpicker( $settings, 'bar_color', true );
$settings->bar_bg_color    = UABB_Helper::uabb_colorpicker( $settings, 'bar_bg_color', true );
$settings->num_color       = UABB_Helper::uabb_colorpicker( $settings, 'num_color' );
$settings->ba_color        = UABB_Helper::uabb_colorpicker( $settings, 'ba_color' );

$settings->icon_size         = ( '' !== trim( $settings->icon_size ) ) ? $settings->icon_size : '30';
$settings->icon_bg_size      = ( '' !== trim( $settings->icon_bg_size ) ) ? $settings->icon_bg_size : '30';
$settings->icon_border_width = ( '' !== trim( $settings->icon_border_width ) ) ? $settings->icon_border_width : '1';
$settings->img_size          = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '150';
$settings->img_border_width  = ( '' !== trim( $settings->img_border_width ) ) ? $settings->img_border_width : '1';
$settings->circle_width      = ( '' !== trim( $settings->circle_width ) ) ? $settings->circle_width : '300';
$settings->circle_dash_width = ( '' !== trim( $settings->circle_dash_width ) ) ? $settings->circle_dash_width : '10';
?>
/* Alignment */
<?php
if ( 'default' === $settings->layout ) {

	if ( 'none' !== $settings->image_type ) {
		if ( 'above-title' === $settings->img_icon_position || 'below-title' === $settings->img_icon_position ) {
			?>
		.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
			text-align: <?php echo esc_attr( $settings->align ); ?>;
		}
	<?php } elseif ( 'left-title' === $settings->img_icon_position || 'left' === $settings->img_icon_position ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
			text-align: left;
		}
	<?php } elseif ( 'right-title' === $settings->img_icon_position || 'right' === $settings->img_icon_position ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
			text-align: right;
		}
		<?php
	}
	} else {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
			text-align: <?php echo esc_attr( $settings->align ); ?>;
		}
		<?php
	}
} else {
	?>
	.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content {
		text-align: center; ?>;
	}
<?php } ?>


/* Number Text Typography */

<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {
		<?php if ( 'Default' !== $settings->num_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->num_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->num_font_size_unit ) && '' !== $settings->num_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->num_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->num_font_size_unit ) && '' === $settings->num_font_size_unit && isset( $settings->num_font_size['desktop'] ) && '' !== $settings->num_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->num_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->num_font_size['desktop'] ) && '' === $settings->num_font_size['desktop'] && isset( $settings->num_line_height['desktop'] ) && '' !== $settings->num_line_height['desktop'] && '' === $settings->num_line_height_unit ) : ?>
			line-height: <?php echo esc_attr( $settings->num_line_height['desktop'] ); ?>px;
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->num_line_height_unit ) && '' !== $settings->num_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->num_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->num_line_height_unit ) && '' === $settings->num_line_height_unit && isset( $settings->num_line_height['desktop'] ) && '' !== $settings->num_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->num_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( '' !== $settings->letter_spacing ) { ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'num_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-number-string",
			)
		);
	}
}
?>

	.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {
		<?php if ( '' !== $settings->num_color ) : ?>
			color: <?php echo esc_attr( $settings->num_color ); ?>;
		<?php endif; ?>
	}

/* Before After Text Typography */

<?php if ( ! $version_bb_check ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-before-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-after-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-before-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-after-text {
		<?php if ( 'Default' !== $settings->ba_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->ba_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->ba_font_size_unit ) && '' !== $settings->ba_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->ba_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->ba_font_size_unit ) && '' === $settings->ba_font_size_unit && isset( $settings->ba_font_size['desktop'] ) && '' !== $settings->ba_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->ba_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->ba_font_size['Desktop'] ) && '' === $settings->ba_font_size['Desktop'] && isset( $settings->ba_line_height['Desktop'] ) && '' !== $settings->ba_line_height['Desktop'] && '' === $settings->ba_line_height_unit ) : ?>
			line-height: <?php echo esc_attr( $settings->ba_line_height['Desktop'] ); ?>px;
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->ba_line_height_unit ) && '' !== $settings->ba_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->ba_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->ba_line_height_unit ) && '' === $settings->ba_line_height_unit && isset( $settings->ba_line_height['desktop'] ) && '' !== $settings->ba_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->ba_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->ba_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->ba_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->ba_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->ba_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'ba_typo',
				'selector'     => ".fl-node-$id .fl-module-content.fl-node-content .uabb-number-before-text, .fl-node-$id .fl-module-content.fl-node-content .uabb-number-after-text, .fl-node-$id .fl-module-content.fl-node-content .uabb-counter-before-text, .fl-node-$id .fl-module-content.fl-node-content .uabb-counter-after-text",
			)
		);
	}
}
?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-before-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-after-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-before-text,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-after-text {
		<?php if ( '' !== $settings->ba_color ) : ?>
			color: <?php echo esc_attr( $settings->ba_color ); ?>;
		<?php endif; ?>
	}

/* Custom Spacing Style Css */
<?php if ( 'default' === $settings->layout ) { ?>
	<?php if ( '' !== $settings->number_bottom_margin || '' !== $settings->number_top_margin ) { ?>
		<?php if ( 'left-title' === $settings->img_icon_position || 'right-title' === $settings->img_icon_position ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-default-<?php echo esc_attr( $settings->img_icon_position ); ?>-wrap {
		<?php } else { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {
		<?php } ?>
		<?php

		if ( isset( $settings->number_bottom_margin ) && '' !== $settings->number_bottom_margin ) {
			echo 'margin-bottom: ' . esc_attr( $settings->number_bottom_margin ) . 'px;';
		}
		if ( isset( $settings->number_top_margin ) && '' !== $settings->number_top_margin ) {
			echo 'margin-top: ' . esc_attr( $settings->number_top_margin ) . 'px;';
		}
		?>
		}
	<?php } ?>
<?php } else { ?>
	<?php if ( ( '' !== $settings->number_bottom_margin ) || ( '' !== $settings->number_top_margin ) ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string{
		<?php

		if ( isset( $settings->number_bottom_margin ) && '' !== $settings->number_bottom_margin ) {
			echo 'margin-bottom: ' . esc_attr( $settings->number_bottom_margin ) . 'px;';
		}
		if ( isset( $settings->number_top_margin ) && '' !== $settings->number_top_margin ) {
			echo 'margin-top: ' . esc_attr( $settings->number_top_margin ) . 'px;';
		}
		?>
		}
	<?php } ?>
<?php } ?>

/* Icon Margin */
<?php if ( 'icon' === $settings->image_type ) { ?>
	<?php
		$pos = '';
	if ( 'circle' === $settings->layout || 'semi-circle' === $settings->layout ) {
		$pos = $settings->circle_position;
	} elseif ( 'default' === $settings->layout ) {
		$pos = $settings->img_icon_position;
	}
	if ( 'above-title' === $pos || 'below-title' === $pos || 'left' === $pos || 'right' === $pos ) {
		?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-imgicon-wrap {
		margin-top: <?php echo esc_attr( ( '' !== $settings->img_icon_margin_top ) ? $settings->img_icon_margin_top : '' ); ?>px;
		margin-bottom: <?php echo esc_attr( ( '' !== $settings->img_icon_margin_bottom ) ? $settings->img_icon_margin_bottom : '' ); ?>px;
	}
	<?php } ?>
<?php } ?>
/* Image Margin */
<?php if ( 'photo' === $settings->image_type ) { ?>
	<?php
		$pos = '';
	if ( 'circle' === $settings->layout || 'semi-circle' === $settings->layout ) {
		$pos = $settings->circle_position;
	} elseif ( 'default' === $settings->layout ) {
		$pos = $settings->img_icon_position;
	}
	if ( 'above-title' === $pos || 'below-title' === $pos || 'left' === $pos || 'right' === $pos ) {
		?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-imgicon-wrap {
		margin-top: <?php echo esc_attr( ( '' !== $settings->img_icon_margin_top ) ? $settings->img_icon_margin_top : '5' ); ?>px;
		margin-bottom: <?php echo esc_attr( ( '' !== $settings->img_icon_margin_bottom ) ? $settings->img_icon_margin_bottom : '0' ); ?>px;
	}
	<?php } ?>
<?php } ?>


/* Icon Image Render */
<?php
if ( 'bars' !== $settings->layout && 'none' !== $settings->image_type ) {

	/* CSS "$settings" Array */
	$imageicon_array = array(

		/* General Section */
		'image_type'              => $settings->image_type,

		/* Icon Basics */
		'icon'                    => $settings->icon,
		'icon_size'               => $settings->icon_size,
		'icon_align'              => ( 'default' === $settings->layout ) ? $settings->align : 'center',

		/* Image Basics */
		'photo_source'            => $settings->photo_source,
		'photo'                   => $settings->photo,
		'photo_url'               => $settings->photo_url,
		'img_size'                => $settings->img_size,
		'img_align'               => ( 'default' === $settings->layout ) ? $settings->align : 'center',
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
		'icon_color_preset'       => $settings->icon_color_preset,

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

	/* CSS Render Function */
	FLBuilder::render_module_css( 'image-icon', $id, $imageicon_array );
}
?>


/* Render Seperator */
<?php
if ( 'yes' === $settings->show_separator ) {
	FLBuilder::render_module_css(
		'uabb-separator',
		$id,
		array(
			'color'                => $settings->separator_color,
			'height'               => $settings->separator_height,
			'width'                => $settings->separator_width,
			'alignment'            => ( isset( $settings->separator_alignment ) ) ? $settings->separator_alignment : '',
			'alignment_medium'     => ( isset( $settings->separator_alignment_medium ) ) ? $settings->separator_alignment_medium : '',
			'alignment_responsive' => ( isset( $settings->separator_alignment_responsive ) ) ? $settings->separator_alignment_responsive : '',
			'style'                => $settings->separator_style,
		)
	);
	?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-separator {
		<?php
		if ( '' !== $settings->separator_top_margin ) {
			?>
		margin-top: <?php echo esc_attr( $settings->separator_top_margin ); ?>px;
			<?php
		}
		if ( '' !== $settings->separator_bottom_margin ) {
			?>
		margin-bottom: <?php echo esc_attr( $settings->separator_bottom_margin ); ?>px;
			<?php
		}
		?>
	}
<?php } ?>

<?php if ( isset( $settings->layout ) && 'circle' === $settings->layout || 'semi-circle' === $settings->layout ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-text {
		position: absolute;
		left: 50%;
		<?php
		if ( 'semi-circle' === $settings->layout ) {
			?>
		top: 100%;
		-webkit-transform: translate(-50%,-100%);
		-moz-transform: translate(-50%,-100%);
		-ms-transform: translate(-50%,-100%);
				transform: translate(-50%,-100%);
			<?php
		} else {
			?>
		top: 50%;
		-webkit-transform: translate(-50%,-50%);
		-moz-transform: translate(-50%,-50%);
		-ms-transform: translate(-50%,-50%);
				transform: translate(-50%,-50%);
		<?php } ?>
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-circle-container, .fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-semi-circle-container {
		<?php
		if ( ! empty( $settings->circle_width ) ) {
			echo 'max-width: ' . esc_attr( $settings->circle_width ) . 'px;';
		} else {
			echo 'max-width: 100px;';
		}
		?>
		text-align: <?php echo esc_attr( $settings->align ); ?>;
		margin-top: 0;
		margin-bottom: 0;
		margin-left: <?php echo ( 'left' !== $settings->align ) ? 'auto' : '0'; ?>;
		margin-right: <?php echo ( 'right' !== $settings->align ) ? 'auto' : '0'; ?>;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-circle-container {
		<?php
		if ( ! empty( $settings->circle_width ) ) {
			echo 'max-height: ' . esc_attr( $settings->circle_width ) . 'px;';
		} else {
			echo 'max-height: 100px;';
		}
		?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-semi-circle-container {
		<?php
		if ( ! empty( $settings->circle_width ) ) {
			$circle_height = $settings->circle_width / 2;
			echo 'max-height: ' . esc_attr( $circle_height ) . 'px;';
		} else {
			echo 'max-height: 50px;';
		}
		?>
	}

	.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-semi-circle-container {
			overflow: hidden;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .svg circle, .fl-node-<?php echo esc_attr( $id ); ?> .semi-circle-svg circle {
	<?php
	if ( ! empty( $settings->circle_dash_width ) ) {
		echo 'stroke-width: ' . esc_attr( $settings->circle_dash_width ) . 'px;';
	}
	?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .svg .uabb-bar-bg, .fl-node-<?php echo esc_attr( $id ); ?> .semi-circle-svg .uabb-bar-bg {
	<?php
	if ( ! empty( $settings->circle_bg_color ) ) {
		echo 'stroke: ' . esc_attr( $settings->circle_bg_color ) . ';';
	} else {
		echo 'stroke: transparent;';
	}
	?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .svg .uabb-bar, .fl-node-<?php echo esc_attr( $id ); ?> .semi-circle-svg .uabb-bar {
	<?php
			echo 'stroke: ' . wp_kses_post( uabb_theme_base_color( $settings->circle_color ) ) . ';';
	?>
	}
<?php elseif ( isset( $settings->layout ) && 'bars' === $settings->layout ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-bars-container{
		width: 100%;
		background-color: <?php echo esc_attr( $settings->bar_bg_color ); ?>;
	}
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-bar{
		width: 0;
		background-color: <?php echo wp_kses_post( uabb_theme_base_color( $settings->bar_color ) ); ?>;
	}
<?php endif; ?>


/* Calculation Width */
<?php
$class             = '';
		$pos       = '';
		$cal_width = '';
if ( 'icon' === $settings->image_type && 'default' === $settings->layout ) {
	$class = 'uabb-number-' . $settings->image_type . '-' . $settings->img_icon_position;
	$pos   = $settings->img_icon_position;
	if ( 'left' === $pos || 'right' === $pos || 'left-title' === $pos || 'right-title' === $pos ) {
		$cal_width = $settings->icon_size;
		if ( 'simple' !== $settings->icon_style ) {
			$cal_width = $settings->icon_size * 2;
			if ( 'custom' === $settings->icon_style ) {
				$cal_width = $settings->icon_size + intval( $settings->icon_bg_size );
				if ( 'none' !== $settings->icon_border_style ) {
					$cal_width = $cal_width + ( intval( $settings->icon_border_width ) * 2 );
				}
			}
		}
		$cal_width = $cal_width + 20;
	}
} elseif ( 'photo' === $settings->image_type && 'default' === $settings->layout ) {
	$class = 'uabb-number-' . $settings->image_type . '-' . $settings->img_icon_position;
	$pos   = $settings->img_icon_position;
	if ( 'left' === $pos || 'right' === $pos || 'left-title' === $pos || 'right-title' === $pos ) {
		$cal_width = $settings->img_size;
		if ( 'custom' === $settings->image_style ) {
			$cal_width = $cal_width + intval( $settings->img_bg_size ) * 2;
			if ( 'none' !== $settings->img_border_style ) {
				$cal_width = $cal_width + ( intval( $settings->img_border_width ) * 2 );
			}
		}
		$cal_width = $cal_width + 20;
	}
}
?>

<?php if ( 'default' === $settings->layout && '' !== $cal_width ) { ?>
	<?php if ( 'left-title' === $pos || 'right-title' === $pos ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ) . ' .' . esc_attr( $class ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {
		width: calc(100% - <?php echo esc_attr( $cal_width ); ?>px);
	}
	<?php } ?>
	<?php if ( 'left' === $pos || 'right' === $pos ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ) . ' .' . esc_attr( $class ); ?> .uabb-number-text {
		width: calc(100% - <?php echo esc_attr( $cal_width ); ?>px);
	}
	<?php } ?>
<?php } ?>

/* Responsive Typography */

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.

	/* Medium Breakpoint media query */
	if ( ! $version_bb_check ) {
		if ( isset( $settings->num_font_size['medium'] ) || isset( $settings->num_line_height['medium'] ) || isset( $settings->ba_font_size['medium'] ) || isset( $settings->ba_line_height['medium'] ) || isset( $settings->num_font_size_unit_medium ) || isset( $settings->num_line_height_unit_medium ) || isset( $settings->ba_font_size_unit_medium ) || isset( $settings->ba_line_height_unit_medium ) || isset( $settings->num_tag_selection ) || isset( $settings->num_line_height_unit ) || isset( $settings->ba_line_height_unit ) ) {
			?>

			@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {

				/* Number Text Typography */


					.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {

						<?php if ( 'yes' === $converted || isset( $settings->num_font_size_unit_medium ) && '' !== $settings->num_font_size_unit_medium ) { ?>
							font-size: <?php echo esc_attr( $settings->num_font_size_unit_medium ); ?>px;
							<?php if ( '' === $settings->num_line_height_unit_medium && '' !== $settings->num_font_size_unit_medium ) { ?>
								line-height: <?php $settings->num_font_size_unit_medium + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->num_font_size_unit_medium ) && '' === $settings->num_font_size_unit_medium && isset( $settings->num_font_size['medium'] ) && '' !== $settings->num_font_size['medium'] ) { ?>
							font-size: <?php echo esc_attr( $settings->num_font_size['medium'] ); ?>px;
							line-height: <?php $settings->num_font_size['medium'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->num_font_size['medium'] ) && '' === $settings->num_font_size['medium'] && isset( $settings->num_line_height['medium'] ) && '' !== $settings->num_line_height['medium'] && '' === $settings->num_line_height_unit && '' === $settings->num_line_height_unit_medium ) : ?>
							line-height: <?php echo esc_attr( $settings->num_line_height['medium'] ); ?>px;
						<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->num_line_height_unit_medium ) && '' !== $settings->num_line_height_unit_medium ) { ?>
							line-height: <?php echo esc_attr( $settings->num_line_height_unit_medium ); ?>em;
						<?php } elseif ( isset( $settings->num_line_height_unit_medium ) && '' === $settings->num_line_height_unit_medium && isset( $settings->num_line_height['medium'] ) && '' !== $settings->num_line_height['medium'] ) { ?>
							line-height: <?php echo esc_attr( $settings->num_line_height['medium'] ); ?>px;
						<?php } ?>

					}

				/* Before After Text */

				<?php if ( ! $version_bb_check ) { ?>

					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-before-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-after-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-before-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-after-text {

						<?php if ( 'yes' === $converted || isset( $settings->ba_font_size_unit_medium ) && '' !== $settings->ba_font_size_unit_medium ) { ?>
							font-size: <?php echo esc_attr( $settings->ba_font_size_unit_medium ); ?>px;
							<?php if ( '' === $settings->ba_line_height_unit_medium && '' !== $settings->ba_font_size_unit_medium ) { ?>
								line-height: <?php $settings->ba_font_size_unit_medium + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->ba_font_size_unit_medium ) && '' === $settings->ba_font_size_unit_medium && isset( $settings->ba_font_size['medium'] ) && '' !== $settings->ba_font_size['medium'] ) { ?>
							font-size: <?php echo esc_attr( $settings->ba_font_size['medium'] ); ?>px;
							line-height: <?php $settings->ba_font_size['medium'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->ba_font_size['medium'] ) && '' === $settings->ba_font_size['medium'] && isset( $settings->ba_line_height['medium'] ) && '' !== $settings->ba_line_height['medium'] && '' === $settings->ba_line_height_unit && '' === $settings->ba_line_height_unit_medium ) : ?>
							line-height: <?php echo esc_attr( $settings->ba_line_height['medium'] ); ?>px;
						<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->ba_line_height_unit_medium ) && '' !== $settings->ba_line_height_unit_medium ) { ?>
							line-height: <?php echo esc_attr( $settings->ba_line_height_unit_medium ); ?>em;
						<?php } elseif ( isset( $settings->ba_line_height_unit_medium ) && '' === $settings->ba_line_height_unit_medium && isset( $settings->ba_line_height['medium'] ) && '' !== $settings->ba_line_height['medium'] ) { ?>
							line-height: <?php echo esc_attr( $settings->ba_line_height['medium'] ); ?>px;
						<?php } ?>
					}

				<?php } ?>
			}

		<?php } ?>
<?php } ?>
	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->num_font_size['small'] ) || isset( $settings->num_line_height['small'] ) || isset( $settings->ba_font_size['small'] ) || isset( $settings->ba_line_height['small'] ) || isset( $settings->num_font_size_unit_responsive ) || isset( $settings->num_line_height_unit_responsive ) || isset( $settings->num_line_height_unit_medium ) || isset( $settings->num_line_height_unit ) || isset( $settings->ba_font_size_unit_responsive ) || isset( $settings->ba_line_height_unit_responsive ) || isset( $settings->ba_line_height_unit_medium ) || isset( $settings->ba_line_height_unit ) || isset( $settings->num_tag_selection ) || isset( $settings->num_line_height_unit ) || isset( $settings->ba_line_height_unit ) ) { /* Small Breakpoint media query */
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

				/* Number Text Typography */


					.fl-node-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $settings->num_tag_selection ); ?>.uabb-number-string {

						<?php if ( 'yes' === $converted || isset( $settings->num_font_size_unit_responsive ) && '' !== $settings->num_font_size_unit_responsive ) { ?>
							font-size: <?php echo esc_attr( $settings->num_font_size_unit_responsive ); ?>px;
							<?php if ( '' === $settings->num_line_height_unit_responsive && '' !== $settings->num_font_size_unit_responsive ) { ?>
								line-height: <?php echo esc_attr( $settings->num_font_size_unit_responsive ) + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->num_font_size_unit_responsive ) && '' === $settings->num_font_size_unit_responsive && isset( $settings->num_font_size['small'] ) && '' !== $settings->num_font_size['small'] ) { ?>
							font-size: <?php echo esc_attr( $settings->num_font_size['small'] ); ?>px;
							line-height: <?php echo esc_attr( $settings->num_font_size['small'] ) + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->num_font_size['small'] ) && '' === $settings->num_font_size['small'] && isset( $settings->num_line_height['small'] ) && '' !== $settings->num_line_height['small'] && '' === $settings->num_line_height_unit_responsive && '' === $settings->num_line_height_unit_medium && '' === $settings->num_line_height_unit ) : ?>
								line-height: <?php echo esc_attr( $settings->num_line_height['small'] ); ?>px;
						<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->num_line_height_unit_responsive ) && '' !== $settings->num_line_height_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->num_line_height_unit_responsive ); ?>em;
						<?php } elseif ( isset( $settings->num_line_height_unit_responsive ) && '' === $settings->num_line_height_unit_responsive && isset( $settings->num_line_height['small'] ) && '' !== $settings->num_line_height['small'] ) { ?>
							line-height: <?php echo esc_attr( $settings->num_line_height['small'] ); ?>px;
						<?php } ?>

					}


				/* Before After Text */
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-before-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-number-after-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-before-text,
					.fl-node-<?php echo esc_attr( $id ); ?> .uabb-counter-after-text {

						<?php if ( 'yes' === $converted || isset( $settings->ba_font_size_unit_responsive ) && '' !== $settings->ba_font_size_unit_responsive ) { ?>
							font-size: <?php echo esc_attr( $settings->ba_font_size_unit_responsive ); ?>px;
						<?php } elseif ( $settings->ba_font_size_unit_responsive && '' === $settings->ba_font_size_unit_responsive && isset( $settings->ba_font_size['small'] ) && '' !== $settings->ba_font_size['small'] ) { ?>
							font-size: <?php echo esc_attr( $settings->ba_font_size['small'] ); ?>px;
						<?php } ?>

						<?php if ( isset( $settings->ba_font_size['small'] ) && '' === $settings->ba_font_size['small'] && isset( $settings->ba_line_height['small'] ) && '' !== $settings->ba_line_height['small'] && '' === $settings->ba_line_height_unit_responsive && '' === $settings->ba_line_height_unit_medium && '' === $settings->ba_line_height_unit ) : ?>
								line-height: <?php echo esc_attr( $settings->ba_line_height['small'] ); ?>px;
							<?php endif; ?>

						<?php if ( 'yes' === $converted || isset( $settings->ba_line_height_unit_responsive ) && '' !== $settings->ba_line_height_unit_responsive ) { ?>
							line-height: <?php echo esc_attr( $settings->ba_line_height_unit_responsive ); ?>em;
						<?php } elseif ( isset( $settings->ba_line_height_unit_responsive ) && '' === $settings->ba_line_height_unit_responsive && isset( $settings->ba_line_height['small'] ) && '' !== $settings->ba_line_height['small'] ) { ?>
							line-height: <?php echo esc_attr( $settings->ba_line_height['small'] ); ?>px;
						<?php } ?>

					}
			}
			<?php
		}
	}
} /* Typography responsive layout Ends here*/ ?>
