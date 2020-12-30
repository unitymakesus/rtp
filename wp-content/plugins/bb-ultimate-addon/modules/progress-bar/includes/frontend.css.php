<?php
/**
 *  UABB Progress Bar Module front-end CSS php file
 *
 *  @package UABB Progress Bar Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->text_color         = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );
$settings->number_color       = UABB_Helper::uabb_colorpicker( $settings, 'number_color' );
$settings->before_after_color = UABB_Helper::uabb_colorpicker( $settings, 'before_after_color' );
?>

<?php if ( 'vertical' === $settings->layout || 'circular' === $settings->layout || 'semi-circular' === $settings->layout ) { ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list{
	text-align: <?php echo esc_attr( $settings->overall_alignment ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li {
	display: inline-block;

	<?php if ( 'left' === $settings->overall_alignment ) : ?>
		margin: 0 <?php echo ( '' !== $settings->spacing ) ? esc_attr( $settings->spacing ) : '10'; ?>px 30px 0;

	<?php elseif ( 'right' === $settings->overall_alignment ) : ?>
		margin: 0 0 30px <?php echo ( '' !== $settings->spacing ) ? esc_attr( $settings->spacing ) : '10'; ?>px;

	<?php else : ?>
		margin: 0 <?php echo ( '' !== $settings->spacing ) ? esc_attr( $settings->spacing / 2 ) : '5'; ?>px 30px <?php echo ( '' !== $settings->spacing ) ? esc_attr( $settings->spacing / 2 ) : '5'; ?>px;
		<?php
	endif;

	if ( 'circular' === $settings->layout ) {
		?>
		width: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
		height: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
		max-width: 100%;

	<?php } elseif ( 'semi-circular' === $settings->layout ) { ?>
		width: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
		height: auto;
		max-width: 100%;
		<?php } else { ?>
		width: <?php echo ! empty( $settings->vertical_width ) ? esc_attr( $settings->vertical_width ) : '300'; ?>px;
		max-width: 100%;
	<?php } ?>
}

	<?php
} elseif ( 'horizontal' === $settings->layout ) {
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li {
	display: block;
	margin: 0 0 <?php echo ( '' !== $settings->spacing ) ? esc_attr( $settings->spacing ) : '10'; ?>px 0;
}
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li:last-of-type {
	margin-bottom: 0;
}
	<?php
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-wrap {
	overflow: hidden;
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-wrap {
		<?php
		if ( 'none' !== $settings->border_style ) {
			$settings->border_color = UABB_Helper::uabb_colorpicker( $settings, 'border_color' );
			$border_size            = ( '' !== $settings->border_size ) ? $settings->border_size : '1';
			echo 'border: ' . esc_attr( $border_size ) . 'px ' . esc_attr( $settings->border_style ) . ' ' . esc_attr( $settings->border_color ) . ';';
		} else {
			echo ( '' !== $settings->border_radius ) ? 'border-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : '';
		}

		?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-bar {
		<?php
		if ( 'none' === $settings->border_style ) {
			echo ( '' !== $settings->border_radius ) ? 'border-radius: ' . esc_attr( $settings->border_radius ) . 'px;' : '';
		}
		?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Item Border.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'progress_border',
				'selector'     => ".fl-node-$id .uabb-progress-wrap",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-title {
	color: <?php echo esc_attr( $settings->text_color ); ?>;
	<?php
	if ( 'horizontal' === $settings->layout ) {

		if ( 'style1' === $settings->horizontal_style ) {

			echo ( '' !== $settings->horizontal_space_below ) ? 'padding-bottom: ' . esc_attr( $settings->horizontal_space_below ) . 'px;' : 'padding-bottom: 5px;';

		} elseif ( 'style2' === $settings->horizontal_style ) {

			echo ( '' !== $settings->horizontal_space_above ) ? 'padding-top: ' . esc_attr( $settings->horizontal_space_above ) . 'px;' : 'padding-top: 5px;';

		} elseif ( 'style3' === $settings->horizontal_style ) {
			$horizontal_vert_padding = ( '' !== $settings->horizontal_vert_padding ) ? $settings->horizontal_vert_padding : '5';

			$horizontal_horz_padding = ( '' !== $settings->horizontal_horz_padding ) ? $settings->horizontal_horz_padding : '10';

			echo 'padding: ' . esc_attr( $horizontal_vert_padding ) . 'px ' . esc_attr( $horizontal_horz_padding ) . 'px;';
		} elseif ( 'style4' === $settings->horizontal_style ) {

			if ( 'below' === $settings->text_position ) {

				echo ( '' !== $settings->horizontal_space_above ) ? 'padding-top: ' . esc_attr( $settings->horizontal_space_above ) . 'px;' : 'padding-top: 5px;';
			} else {

				echo ( '' !== $settings->horizontal_space_below ) ? 'padding-bottom: ' . esc_attr( $settings->horizontal_space_below ) . 'px;' : 'padding-bottom: 5px;';
			}
		}
	} elseif ( 'vertical' === $settings->layout ) {
		echo esc_attr( ( 'style1' === $settings->vertical_style ) ? 'padding-bottom: 10px;' : ( ( 'style2' === $settings->vertical_style ) ? 'padding-top: 10px;' : 'padding: 10px 0;' ) );
	}
	?>
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-title {

		<?php
		if ( 'Default' !== $settings->text_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->text_font_family );
		}
		?>
		<?php
		if ( 'yes' === $converted || isset( $settings->text_font_size_unit ) && '' !== $settings->text_font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->text_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->text_font_size_unit ) && '' === $settings->text_font_size_unit && isset( $settings->text_font_size['desktop'] ) && '' !== $settings->text_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->text_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->text_font_size['desktop'] ) && '' === $settings->text_font_size['desktop'] && isset( $settings->text_line_height['desktop'] ) && '' !== $settings->text_line_height['desktop'] && '' === $settings->text_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->text_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit ) && '' !== $settings->text_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->text_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->text_line_height_unit ) && '' === $settings->text_line_height_unit && isset( $settings->text_line_height['desktop'] ) && '' !== $settings->text_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->text_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->text_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->text_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->text_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->text_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'text_typo',
				'selector'     => ".fl-node-$id .uabb-progress-title",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ba-text {
	color: <?php echo esc_attr( uabb_theme_text_color( $settings->before_after_color ) ); ?>;
}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ba-text {

		<?php
		if ( 'Default' !== $settings->before_after_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->before_after_font_family );
		}
		?>
		<?php
		if ( 'yes' === $converted || isset( $settings->before_after_font_size_unit ) && '' !== $settings->before_after_font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->before_after_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->before_after_font_size_unit ) && '' === $settings->before_after_font_size_unit && isset( $settings->before_after_font_size['desktop'] ) && '' !== $settings->before_after_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->before_after_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->before_after_font_size['desktop'] ) && '' === $settings->before_after_font_size['desktop'] && isset( $settings->before_after_line_height['desktop'] ) && '' !== $settings->before_after_line_height['desktop'] && '' === $settings->before_after_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->before_after_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->before_after_line_height_unit ) && '' !== $settings->before_after_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->before_after_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->before_after_line_height_unit ) && '' === $settings->before_after_line_height_unit && isset( $settings->before_after_line_height['desktop'] ) && '' !== $settings->before_after_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->before_after_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->before_after_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->before_after_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->before_after_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->before_after_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'before_after_typo',
				'selector'     => ".fl-node-$id .uabb-ba-text",
			)
		);
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-value,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-percent-counter {
	color: <?php echo esc_attr( uabb_theme_text_color( $settings->number_color ) ); ?>;
	<?php
	if ( 'horizontal' === $settings->layout ) {
		if ( 'style1' === $settings->horizontal_style ) {
			echo ( '' !== $settings->horizontal_space_below ) ? 'padding-bottom: ' . esc_attr( $settings->horizontal_space_below ) . 'px;' : 'padding-bottom: 5px;';
		} elseif ( 'style2' === $settings->horizontal_style ) {
			echo ( '' !== $settings->horizontal_space_above ) ? 'padding-top: ' . esc_attr( $settings->horizontal_space_above ) . 'px;' : 'padding-top: 5px;';
		} elseif ( 'style3' === $settings->horizontal_style || 'style4' === $settings->horizontal_style ) {
			$horizontal_vert_padding = ( '' !== $settings->horizontal_vert_padding ) ? $settings->horizontal_vert_padding : '5';
			$horizontal_horz_padding = ( '' !== $settings->horizontal_horz_padding ) ? $settings->horizontal_horz_padding : '10';
			echo 'padding: ' . esc_attr( $horizontal_vert_padding ) . 'px ' . esc_attr( $horizontal_horz_padding ) . 'px;';
		}
	} elseif ( 'vertical' === $settings->layout ) {
		echo esc_attr( ( 'style1' === $settings->vertical_style ) ? 'padding-bottom: 10px;' : ( ( 'style2' === $settings->vertical_style ) ? 'padding-top: 10px;' : 'padding: 10px;' ) );
	}
	?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-value,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-percent-counter {
		<?php
		if ( 'Default' !== $settings->number_font_family['family'] ) {
			UABB_Helper::uabb_font_css( $settings->number_font_family );
		}
		?>
		<?php
		if ( 'yes' === $converted || isset( $settings->number_font_size_unit ) && '' !== $settings->number_font_size_unit ) {
			?>
			font-size: <?php echo esc_attr( $settings->number_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->number_font_size_unit ) && '' === $settings->number_font_size_unit && isset( $settings->number_font_size['desktop'] ) && '' !== $settings->number_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->number_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->number_font_size['desktop'] ) && '' === $settings->number_font_size['desktop'] && isset( $settings->number_line_height['desktop'] ) && '' !== $settings->number_line_height['desktop'] && '' === $settings->number_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->number_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->number_line_height_unit ) && '' !== $settings->number_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->number_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->number_line_height_unit ) && '' === $settings->number_line_height_unit && isset( $settings->number_line_height['desktop'] ) && '' !== $settings->number_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->number_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( '' !== $settings->number_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->number_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'number_typo',
				'selector'     => ".fl-node-$id .uabb-progress-value, .fl-node-$id .uabb-percent-counter",
			)
		);
	}
}
?>

<?php
if ( count( $settings->horizontal ) > 0 ) {
	$count = count( $settings->horizontal );
	for ( $i = 0; $i < $count; $i++ ) {
		$tmp = $settings->horizontal;
		if ( is_object( $tmp[ $i ] ) ) {

			$tmp[ $i ]->background_color = UABB_Helper::uabb_colorpicker( $tmp[ $i ], 'background_color', true );
			$tmp[ $i ]->gradient_color   = UABB_Helper::uabb_colorpicker( $tmp[ $i ], 'gradient_color', true );
			?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-progress-wrap {
	background: <?php echo esc_attr( $tmp[ $i ]->background_color ); ?>;
}

			<?php
			if ( 'horizontal' === $settings->layout ) {
				?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-horizontal.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-progress-bar {
				<?php if ( 'image' === $tmp[ $i ]->progress_bg_type && '' !== trim( FLBuilderPhoto::get_attachment_data( $tmp[ $i ]->progress_bg_img )->url ) ) : ?>
		background-image: url(<?php echo esc_url( FLBuilderPhoto::get_attachment_data( $tmp[ $i ]->progress_bg_img )->url ); ?> );
		background-position: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_pos ); ?>;
		background-size: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_size ); ?>;
		background-repeat: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_repeat ); ?>;
					<?php
	elseif ( 'gradient' === $tmp[ $i ]->progress_bg_type ) :
		$tmp[ $i ]->gradient_field = (array) $tmp[ $i ]->gradient_field;
		UABB_Helper::uabb_gradient_css( $tmp[ $i ]->gradient_field );
	elseif ( 'yes' === $settings->stripped ) :
		?>
		background-color: <?php echo esc_attr( uabb_theme_base_color( $tmp[ $i ]->gradient_color ) ); ?>;
		background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		-webkit-background-size: 40px 40px;

		background-size: 40px 40px;
	<?php else : ?>
		background: <?php echo esc_attr( uabb_theme_base_color( $tmp[ $i ]->gradient_color ) ); ?>;
	<?php endif; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-horizontal.uabb-progress-bar-style-style4.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-progress-box .uabb-progress-info {
	width: 0%;
}
				<?php
			} elseif ( 'vertical' === $settings->layout ) {
				?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-vertical.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-progress-bar {
	width: 100%;
				<?php if ( 'image' === $tmp[ $i ]->progress_bg_type && '' !== trim( FLBuilderPhoto::get_attachment_data( $tmp[ $i ]->progress_bg_img )->url ) ) : ?>
		background-image: url(<?php echo esc_url( FLBuilderPhoto::get_attachment_data( $tmp[ $i ]->progress_bg_img )->url ); ?>);
		background-position: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_pos ); ?>;
		background-size: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_size ); ?>;
		background-repeat: <?php echo esc_attr( $tmp[ $i ]->progress_bg_img_repeat ); ?>;
					<?php
	elseif ( 'gradient' === $tmp[ $i ]->progress_bg_type ) :
		$tmp[ $i ]->gradient_field = (array) $tmp[ $i ]->gradient_field;
		UABB_Helper::uabb_gradient_css( $tmp[ $i ]->gradient_field );
	elseif ( 'yes' === $settings->stripped ) :
		?>
		background-color: <?php echo esc_attr( uabb_theme_base_color( $tmp[ $i ]->gradient_color ) ); ?>;
		background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);

		-webkit-background-size: 40px 40px;

		background-size: 40px 40px;

	<?php else : ?>
		background: <?php echo esc_attr( uabb_theme_base_color( $tmp[ $i ]->gradient_color ) ); ?>;

	<?php endif; ?>
}

				<?php
			} elseif ( 'circular' === $settings->layout || 'semi-circular' === $settings->layout ) {
				?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-<?php echo esc_attr( $settings->layout ); ?>.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-svg-wrap svg circle {
				<?php
				$stroke_thickness = ( '' !== $settings->stroke_thickness ) ? $settings->stroke_thickness : '10';
				echo 'stroke-width: ' . esc_attr( $stroke_thickness ) . 'px;';
				?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-<?php echo esc_attr( $settings->layout ); ?>.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-svg-wrap svg .uabb-bar {
				<?php echo 'stroke: ' . esc_attr( uabb_theme_base_color( $tmp[ $i ]->gradient_color ) ) . ';'; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-<?php echo esc_attr( $settings->layout ); ?>.uabb-progress-bar-<?php echo esc_attr( $i ); ?> .uabb-svg-wrap svg .uabb-bar-bg {
				<?php
				if ( ! empty( $tmp[ $i ]->background_color ) ) {
					echo 'stroke: ' . esc_attr( $tmp[ $i ]->background_color ) . ';';
				} else {
					echo 'stroke: transparent;';
				}
				?>
}
				<?php
			}
		}
	}
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-bar-wrapper.uabb-layout-circular {
	max-width: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
	max-height: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-bar-wrapper.uabb-layout-semi-circular {
	max-width: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness ) : '300'; ?>px;
	max-height: <?php echo ! empty( $settings->circular_thickness ) ? esc_attr( $settings->circular_thickness / 2 ) : '150'; ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-vertical.uabb-progress-bar-style-style3 .uabb-progress-title {
	text-align: <?php echo esc_attr( $settings->title_alignment ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-vertical .uabb-progress-wrap {
	height: <?php echo ( '' !== $settings->vertical_thickness ) ? esc_attr( $settings->vertical_thickness ) : '200'; ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-horizontal.uabb-progress-bar-style-style2 .uabb-progress-box,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-horizontal.uabb-progress-bar-style-style1 .uabb-progress-box {
	height: <?php echo ( '' !== $settings->horizontal_thickness ) ? esc_attr( $settings->horizontal_thickness ) : '20'; ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-horizontal.uabb-progress-bar-style-style4 .uabb-progress-box .uabb-progress-info {
	width: 100%;
}

<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-title {

			<?php if ( 'yes' === $converted || isset( $settings->text_font_size_unit_medium ) && '' !== $settings->text_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->text_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->text_font_size_unit_medium ) && '' === $settings->text_font_size_unit_medium && isset( $settings->text_font_size['medium'] ) && '' !== $settings->text_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->text_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->text_font_size['medium'] ) && '' === $settings->text_font_size['medium'] && isset( $settings->text_line_height['medium'] ) && '' !== $settings->text_line_height['medium'] && '' === $settings->text_line_height_unit_medium && '' === $settings->text_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height['medium'] ); ?>px;
			<?php } ?>


			<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit_medium ) && '' !== $settings->text_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->text_line_height_unit_medium ) && '' === $settings->text_line_height_unit_medium && isset( $settings->text_line_height['medium'] ) && '' !== $settings->text_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-value,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-percent-counter {

			<?php if ( 'yes' === $converted || isset( $settings->number_font_size_unit_medium ) && '' !== $settings->number_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->number_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->number_font_size_unit_medium ) && '' === $settings->number_font_size_unit_medium && isset( $settings->number_font_size['medium'] ) && '' !== $settings->number_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->number_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->number_font_size['medium'] ) && '' === $settings->number_font_size['medium'] && isset( $settings->number_line_height['medium'] ) && '' !== $settings->number_line_height['medium'] && '' === $settings->number_line_height_unit_medium && '' === $settings->number_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height['medium'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->number_line_height_unit_medium ) && '' !== $settings->number_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->number_line_height_unit_medium ) && '' === $settings->number_line_height_unit_medium && isset( $settings->number_line_height['medium'] ) && '' !== $settings->number_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ba-text {

			<?php if ( 'yes' === $converted || isset( $settings->before_after_font_size_unit_medium ) && '' !== $settings->before_after_font_size_unit_medium ) { ?>
				font-size: <?php echo esc_attr( $settings->before_after_font_size_unit_medium ); ?>px;
			<?php } elseif ( isset( $settings->before_after_font_size_unit_medium ) && '' === $settings->before_after_font_size_unit_medium && isset( $settings->before_after_font_size['medium'] ) && '' !== $settings->before_after_font_size['medium'] ) { ?>
				font-size: <?php echo esc_attr( $settings->before_after_font_size['medium'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->before_after_font_size['medium'] ) && '' === $settings->before_after_font_size['medium'] && isset( $settings->before_after_line_height['medium'] ) && '' !== $settings->before_after_line_height['medium'] && '' === $settings->before_after_line_height_unit_medium && '' === $settings->before_after_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height['medium'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->before_after_line_height_unit_medium ) && '' !== $settings->before_after_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->before_after_line_height_unit_medium ) && '' === $settings->before_after_line_height_unit_medium && isset( $settings->before_after_line_height['medium'] ) && '' !== $settings->before_after_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height['medium'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

		<?php
		if ( 'circular' === $settings->layout ) {
			if ( 'yes' === $settings->circular_responsive ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li {
					height: <?php echo ( '' !== $settings->circular_responsive_width ) ? esc_attr( $settings->circular_responsive_width ) : '200'; ?>px;
					width: <?php echo ( '' !== $settings->circular_responsive_width ) ? esc_attr( $settings->circular_responsive_width ) : '200'; ?>px;
					max-width: 100%;
				}
				<?php
			}
		} elseif ( 'semi-circular' === $settings->layout ) {
			if ( 'yes' === $settings->circular_responsive ) {
				?>
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li {
					height: auto;
					width: <?php echo ( '' !== $settings->circular_responsive_width ) ? esc_attr( $settings->circular_responsive_width ) : '200'; ?>px;
				}
				<?php
			}
		} elseif ( 'vertical' === $settings->layout ) {
			if ( 'yes' === $settings->vertical_responsive ) {
				?>

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-pb-list li {
			width: <?php echo ( '' !== $settings->vertical_responsive_width ) ? esc_attr( $settings->vertical_responsive_width ) : '150'; ?>px;
		}
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-layout-vertical .uabb-progress-wrap {
			height: <?php echo ( '' !== $settings->vertical_responsive_thickness ) ? esc_attr( $settings->vertical_responsive_thickness ) : '200'; ?>px;
		}

				<?php
				if ( 'style1' === $settings->vertical_style || 'style2' === $settings->vertical_style ) {
					?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list li {
			position: relative;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list .uabb-progress-info {
			position: relative;
			transform: translateX(-50%);
			left: 50%;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list .uabb-progress-title {
			display: block;
			text-align: center;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list .uabb-progress-value {
			display: block;
			width: auto;
			text-align: center;
			padding-left: 0;
		}
					<?php
				} else {
					?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list li {
			position: relative;
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-list .uabb-progress-bar-style-style3 .uabb-progress-title {
			position: relative;
			left: 50%;
			transform: translateX(-50%);
		}
					<?php
				}
				?>
				<?php
			}
		}
		?>
	}

	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-title {
			<?php if ( 'yes' === $converted || isset( $settings->text_font_size_unit_responsive ) && '' !== $settings->text_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->text_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->text_font_size_unit_responsive ) && '' === $settings->text_font_size_unit_responsive && isset( $settings->text_font_size['small'] ) && '' !== $settings->text_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->text_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->text_font_size['small'] ) && '' === $settings->text_font_size['small'] && isset( $settings->text_line_height['small'] ) && '' !== $settings->text_line_height['small'] && '' === $settings->text_line_height_unit_responsive && '' === $settings->text_line_height_unit_medium && '' === $settings->text_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit_responsive ) && '' !== $settings->text_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->text_line_height_unit_responsive ) && '' === $settings->text_line_height_unit_responsive && isset( $settings->text_line_height['small'] ) && '' !== $settings->text_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->text_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-progress-value,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-percent-counter {

			<?php if ( 'yes' === $converted || isset( $settings->number_font_size_unit_responsive ) && '' !== $settings->number_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->number_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->number_font_size_unit_responsive ) && '' === $settings->number_font_size_unit_responsive && isset( $settings->number_font_size['small'] ) && '' !== $settings->number_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->number_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->number_font_size['small'] ) && '' === $settings->number_font_size['small'] && isset( $settings->number_line_height['small'] ) && '' !== $settings->number_line_height['small'] && '' === $settings->number_line_height_unit_responsive && '' === $settings->number_line_height_unit_medium && '' === $settings->number_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->number_line_height_unit_responsive ) && '' !== $settings->number_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->number_line_height_unit_responsive ) && '' === $settings->number_line_height_unit_responsive && isset( $settings->number_line_height['small'] ) && '' !== $settings->number_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->number_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ba-text {

			<?php if ( 'yes' === $converted || isset( $settings->before_after_font_size_unit_responsive ) && '' !== $settings->before_after_font_size_unit_responsive ) { ?>
				font-size: <?php echo esc_attr( $settings->before_after_font_size_unit_responsive ); ?>px;
			<?php } elseif ( isset( $settings->before_after_font_size_unit_responsive ) && '' === $settings->before_after_font_size_unit_responsive && isset( $settings->before_after_font_size['small'] ) && '' !== $settings->before_after_font_size['small'] ) { ?>
				font-size: <?php echo esc_attr( $settings->before_after_font_size['small'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->before_after_font_size['small'] ) && '' === $settings->before_after_font_size['small'] && isset( $settings->before_after_line_height['small'] ) && '' !== $settings->before_after_line_height['small'] && '' === $settings->before_after_line_height_unit_responsive && '' === $settings->before_after_line_height_unit_medium && '' === $settings->before_after_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height['small'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->before_after_line_height_unit_responsive ) && '' !== $settings->before_after_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->before_after_line_height_unit_responsive ) && '' === $settings->before_after_line_height_unit_responsive && isset( $settings->before_after_line_height['small'] ) && '' !== $settings->before_after_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->before_after_line_height['small'] ); ?>px;
			<?php } ?>
		}
	<?php } ?>
	}
	<?php
}
?>
