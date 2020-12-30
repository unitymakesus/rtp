<?php
/**
 * Register the module's CSS file for Dual Color Heading module
 *
 * @package UABB Dual Color Heading Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->first_heading_color    = UABB_Helper::uabb_colorpicker( $settings, 'first_heading_color' );
$settings->second_heading_color   = UABB_Helper::uabb_colorpicker( $settings, 'second_heading_color' );
$settings->first_heading_bg_color = UABB_Helper::uabb_colorpicker( $settings, 'first_heading_bg_color' );
$settings->second_head_bg_color   = UABB_Helper::uabb_colorpicker( $settings, 'second_head_bg_color' );
$settings->bg_heading_color       = UABB_Helper::uabb_colorpicker( $settings, 'bg_heading_color' );
$settings->after_heading_color    = UABB_Helper::uabb_colorpicker( $settings, 'after_heading_color' );
$settings->after_head_bg_color    = UABB_Helper::uabb_colorpicker( $settings, 'after_head_bg_color' );


?>

<?php
if ( class_exists( 'FLBuilderCSS' ) ) {

	if ( isset( $settings->dual_head_alignment ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'dual_head_alignment',
				'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading",
				'prop'         => 'text-align',
			)
		);
	}
	if ( isset( $settings->vertical_position ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'vertical_position',
				'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading .uabb-bg-heading-wrap::before",
				'prop'         => 'top',
				'unit'         => 'px',
			)
		);
	}
	if ( isset( $settings->horizental_position ) ) {
		FLBuilderCSS::responsive_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'horizental_position',
				'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading .uabb-bg-heading-wrap::before",
				'prop'         => 'left',
				'unit'         => 'px',
			)
		);
	}
	if ( 'yes' === $settings->add_spacing_option ) {
		if ( 'inline' === $settings->layout_option ) {
			if ( isset( $settings->heading_margin ) ) {
				FLBuilderCSS::responsive_rule(
					array(
						'settings'     => $settings,
						'setting_name' => 'heading_margin',
						'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-first-heading-text",
						'prop'         => 'margin-right',
						'unit'         => 'px',
					)
				);
			}
		} else {
			if ( isset( $settings->heading_margin ) ) {
				FLBuilderCSS::responsive_rule(
					array(
						'settings'     => $settings,
						'setting_name' => 'heading_margin',
						'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-first-heading-text",
						'prop'         => 'margin-bottom',
						'unit'         => 'px',
					)
				);
			}
		}
	}
	if ( 'inline' === $settings->layout_option ) {
		if ( isset( $settings->heading_spacing ) ) {
			FLBuilderCSS::responsive_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'heading_spacing',
					'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-after-heading-text",
					'prop'         => 'margin-left',
					'unit'         => 'px',
				)
			);
		}
	} else {
		if ( isset( $settings->heading_spacing ) ) {
			FLBuilderCSS::responsive_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'heading_spacing',
					'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-after-heading-text",
					'prop'         => 'margin-top',
					'unit'         => 'px',
				)
			);
		}
	}
}

?>
/* First heading styling */
<?php if ( '' !== $settings->first_heading_color || 'yes' === $settings->add_spacing_option ) { ?>

.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text {
	<?php if ( ! empty( $settings->first_heading_color ) ) { ?>
		color: <?php echo esc_attr( $settings->first_heading_color ); ?>;	<?php } ?>
}
<?php } ?>

<?php if ( 'yes' === $settings->add_spacing_option ) { ?>
	[dir="rtl"] .fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-first-heading-text {
		margin-left:<?php echo ( isset( $settings->heading_margin ) && '' !== $settings->heading_margin ) ? esc_attr( $settings->heading_margin ) . 'px' : ''; ?>;
		margin-right: 0;
	}
<?php } ?>

[dir="rtl"] .fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-after-heading-text {
		margin-right:<?php echo ( isset( $settings->heading_spacing ) && '' !== $settings->heading_spacing ) ? esc_attr( $settings->heading_spacing ) . 'px' : ''; ?>;
		margin-left: 0;
	}

<?php if ( 'yes' === $settings->add_spacing_option ) { ?>
	<?php if ( 'inline' === $settings->layout_option ) { ?>
	[dir="ltr"] .fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-first-heading-text {
		margin-right:<?php echo ( isset( $settings->heading_margin ) && '' !== $settings->heading_margin ) ? esc_attr( $settings->heading_margin ) . 'px' : ''; ?>;
		margin-left: 0;
	}
<?php } else { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-first-heading-text {
		margin-bottom:<?php echo ( isset( $settings->heading_margin ) && '' !== $settings->heading_margin ) ? esc_attr( $settings->heading_margin ) . 'px' : ''; ?>;
	}
<?php } ?>
<?php } ?>

	<?php if ( 'inline' === $settings->layout_option ) { ?>
	[dir="ltr"] .fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-after-heading-text {
		margin-left:<?php echo ( isset( $settings->heading_spacing ) && '' !== $settings->heading_spacing ) ? esc_attr( $settings->heading_spacing ) . 'px' : ''; ?>;
		margin-right: 0;
	}
<?php } else { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading .uabb-after-heading-text {
		margin-top:<?php echo ( isset( $settings->heading_spacing ) && '' !== $settings->heading_spacing ) ? esc_attr( $settings->heading_spacing ) . 'px' : ''; ?>;		
	}
<?php } ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text  {

	<?php if ( 'color' === $settings->first_heading_bg_type ) { ?>
		background-color: <?php echo esc_attr( $settings->first_heading_bg_color ); ?>;
	<?php } elseif ( 'image' === $settings->first_heading_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->first_heading_bg_img )->url ) ) { ?>
		background-image: url(<?php echo esc_attr( FLBuilderPhoto::get_attachment_data( $settings->first_heading_bg_img )->url ); ?>);
		background-position: <?php echo esc_attr( $settings->first_heading_bg_img_pos ); ?>;
		background-size: <?php echo esc_attr( $settings->first_heading_bg_img_size ); ?>;
		background-repeat: <?php echo esc_attr( $settings->first_heading_bg_img_repeat ); ?>;
		background-attachment: <?php echo esc_attr( $settings->first_bg_attachment ); ?>;
		-webkit-background-clip: text;
		background-clip: text;
		-webkit-text-fill-color: transparent;
		<?php
	} elseif ( $version_bb_check ) {
		if ( 'gradient' === $settings->first_heading_bg_type ) {
			?>
		background:<?php echo esc_attr( FLBuilderColor::gradient( $settings->first_heading_gradient ) ); ?>;
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
			<?php
		}
	}

	?>
	<?php if ( ! $version_bb_check ) { ?>

		<?php
		if ( isset( $settings->first_heading_padding_top ) ) {
			echo ( '' !== $settings->first_heading_padding_top ) ? 'padding-top:' . esc_attr( $settings->first_heading_padding_top ) . 'px;' : '';
		}
		if ( isset( $settings->first_heading_padding_bottom ) ) {
			echo ( '' !== $settings->first_heading_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->first_heading_padding_bottom ) . 'px;' : '';
		}
		if ( isset( $settings->first_heading_padding_left ) ) {
			echo ( '' !== $settings->first_heading_padding_left ) ? 'padding-left:' . esc_attr( $settings->first_heading_padding_left ) . 'px;' : '';
		}
		if ( isset( $settings->first_heading_padding_right ) ) {
			echo ( '' !== $settings->first_heading_padding_right ) ? 'padding-right:' . esc_attr( $settings->first_heading_padding_right ) . 'px;' : '';
		}
		?>
			<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::dimension_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'first_heading_padding',
					'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text",
					'unit'         => 'px',
					'props'        => array(
						'padding-top'    => 'first_heading_padding_top',
						'padding-right'  => 'first_heading_padding_right',
						'padding-bottom' => 'first_heading_padding_bottom',
						'padding-left'   => 'first_heading_padding_left',
					),
				)
			);
		}
	}
	?>
}

/* Second heading styling */
.fl-node-<?php echo esc_attr( $id ); ?> .fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text {
	color: <?php echo esc_attr( uabb_theme_base_color( $settings->second_heading_color ) ); ?>;
}

/* Alignment styling */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading.left {	text-align: left; }
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading.right { text-align: right; }
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading.center { text-align: center; }

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text {

<?php if ( 'color' === $settings->second_head_bg_type ) { ?>
	background-color: <?php echo esc_attr( $settings->second_head_bg_color ); ?>;
<?php } elseif ( 'image' === $settings->second_head_bg_type && isset( FLBuilderPhoto::get_attachment_data( $settings->second_head_bg_img )->url ) ) { ?>
	background-image: url(<?php echo esc_attr( FLBuilderPhoto::get_attachment_data( $settings->second_head_bg_img )->url ); ?>);
	background-position: <?php echo esc_attr( $settings->second_head_bg_img_pos ); ?>;
	background-size: <?php echo esc_attr( $settings->second_head_bg_img_size ); ?>;
	background-repeat: <?php echo esc_attr( $settings->second_head_bg_img_repeat ); ?>;
	background-attachment: <?php echo esc_attr( $settings->second_bg_attachment ); ?>;
	-webkit-background-clip: text;
		background-clip: text;
		-webkit-text-fill-color: transparent;
	<?php
} elseif ( $version_bb_check ) {
	if ( 'gradient' === $settings->second_head_bg_type ) {
		?>
	background:<?php echo esc_attr( FLBuilderColor::gradient( $settings->second_head_gradient ) ); ?>;
	-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		<?php
	}
}

?>
<?php if ( ! $version_bb_check ) { ?>

	<?php
	if ( isset( $settings->second_heading_padding_top ) ) {
		echo ( '' !== $settings->second_heading_padding_top ) ? 'padding-top:' . esc_attr( $settings->second_heading_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->second_heading_padding_bottom ) ) {
		echo ( '' !== $settings->second_heading_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->second_heading_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->second_heading_padding_left ) ) {
		echo ( '' !== $settings->second_heading_padding_left ) ? 'padding-left:' . esc_attr( $settings->second_heading_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->second_heading_padding_right ) ) {
		echo ( '' !== $settings->second_heading_padding_right ) ? 'padding-right:' . esc_attr( $settings->second_heading_padding_right ) . 'px;' : '';
	}
	?>
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'second_heading_padding',
				'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text",
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'second_heading_padding_top',
					'padding-right'  => 'second_heading_padding_right',
					'padding-bottom' => 'second_heading_padding_bottom',
					'padding-left'   => 'second_heading_padding_left',
				),
			)
		);
	}
}
?>
}
/* after heading styling */

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-dual-color-heading .uabb-after-heading-text  {
	color: <?php echo esc_attr( $settings->after_heading_color ); ?>;
	background-color: <?php echo esc_attr( $settings->after_head_bg_color ); ?>;

?>
<?php if ( ! $version_bb_check ) { ?>

	<?php
	if ( isset( $settings->after_heading_padding_top ) ) {
		echo ( '' !== $settings->after_heading_padding_top ) ? 'padding-top:' . esc_attr( $settings->after_heading_padding_top ) . 'px;' : '';
	}
	if ( isset( $settings->after_heading_padding_bottom ) ) {
		echo ( '' !== $settings->after_heading_padding_bottom ) ? 'padding-bottom:' . esc_attr( $settings->after_heading_padding_bottom ) . 'px;' : '';
	}
	if ( isset( $settings->after_heading_padding_left ) ) {
		echo ( '' !== $settings->after_heading_padding_left ) ? 'padding-left:' . esc_attr( $settings->after_heading_padding_left ) . 'px;' : '';
	}
	if ( isset( $settings->after_heading_padding_right ) ) {
		echo ( '' !== $settings->after_heading_padding_right ) ? 'padding-right:' . esc_attr( $settings->after_heading_padding_right ) . 'px;' : '';
	}
	?>
		<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::dimension_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'after_heading_padding',
				'selector'     => ".fl-node-$id .uabb-module-content.uabb-dual-color-heading .uabb-after-heading-text",
				'unit'         => 'px',
				'props'        => array(
					'padding-top'    => 'after_heading_padding_top',
					'padding-right'  => 'after_heading_padding_right',
					'padding-bottom' => 'after_heading_padding_bottom',
					'padding-left'   => 'after_heading_padding_left',
				),
			)
		);
	}
}
?>
}
/* Background text styling */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-module-content.uabb-dual-color-heading .uabb-bg-heading-wrap::before{
	color: <?php echo esc_attr( $settings->bg_heading_color ); ?>;

}

/* Typography styling for desktop */


<?php
if ( ! $version_bb_check ) {
	if ( 'Default' !== $settings->dual_font_family['family'] || isset( $settings->dual_font_size['desktop'] ) || isset( $settings->dual_line_height['desktop'] ) || isset( $settings->dual_font_size_unit ) || isset( $settings->dual_line_height_unit ) || isset( $settings->dual_transform ) || isset( $settings->dual_letter_spacing ) ) {
		?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading * {
				<?php if ( 'Default' !== $settings->dual_font_family['family'] ) : ?>
					<?php UABB_Helper::uabb_font_css( $settings->dual_font_family ); ?>
				<?php endif; ?>
			<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit ) && '' !== $settings->dual_font_size_unit ) { ?>
				font-size: <?php echo esc_attr( $settings->dual_font_size_unit ); ?>px;	
			<?php } elseif ( isset( $settings->dual_font_size_unit ) && '' === $settings->dual_font_size_unit && isset( $settings->dual_font_size['desktop'] ) && '' !== $settings->dual_font_size['desktop'] ) { ?>
				font-size: <?php echo esc_attr( $settings->dual_font_size['desktop'] ); ?>px;
			<?php } ?>

			<?php if ( isset( $settings->dual_font_size['desktop'] ) && '' === $settings->dual_font_size['desktop'] && isset( $settings->dual_line_height['desktop'] ) && '' !== $settings->dual_line_height['desktop'] && '' === $settings->dual_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->dual_line_height['desktop'] ); ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit ) && '' !== $settings->dual_line_height_unit ) { ?>
				line-height: <?php echo esc_attr( $settings->dual_line_height_unit ); ?>em;
			<?php } elseif ( isset( $settings->dual_line_height_unit ) && '' === $settings->dual_line_height_unit && isset( $settings->dual_line_height['desktop'] ) && '' !== $settings->dual_line_height['desktop'] ) { ?>
				line-height: <?php echo esc_attr( $settings->dual_line_height['desktop'] ); ?>px;
			<?php } ?>

			<?php if ( 'none' !== $settings->dual_transform ) : ?>
				text-transform: <?php echo esc_attr( $settings->dual_transform ); ?>;
			<?php endif; ?>

			<?php if ( '' !== $settings->dual_letter_spacing ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->dual_letter_spacing ); ?>px;
			<?php endif; ?>
		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'dual_typo',
				'selector'     => ".fl-node-$id .uabb-dual-color-heading *, .fl-node-$id .uabb-dual-color-heading .uabb-first-heading-text",
			)
		);
	}
}
if ( class_exists( 'FLBuilderCSS' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'second_typo',
			'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-second-heading-text",
		)
	);
}
if ( class_exists( 'FLBuilderCSS' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'bg_text_typo',
			'selector'     => ".fl-node-$id .uabb-bg-heading-wrap::before",
		)
	);
}
if ( class_exists( 'FLBuilderCSS' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'after_text_typo',
			'selector'     => ".fl-node-$id .uabb-dual-color-heading .uabb-after-heading-text",
		)
	);
}
?>
/* Typography responsive layout starts here */ 


<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	if ( ! $version_bb_check ) {
		if ( isset( $settings->dual_font_size['medium'] ) || isset( $settings->dual_line_height['medium'] ) || isset( $settings->dual_font_size_unit_medium ) || isset( $settings->dual_line_height_unit_medium ) || 'uabb-responsive-medsmall' === $settings->responsive_compatibility || isset( $settings->dual_line_height_unit ) ) {
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading * {

				<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit_medium ) && '' !== $settings->dual_font_size_unit_medium ) { ?>
					font-size: <?php echo esc_attr( $settings->dual_font_size_unit_medium ); ?>px;
				<?php } elseif ( isset( $settings->dual_font_size_unit_medium ) && '' === $settings->dual_font_size_unit_medium && isset( $settings->dual_font_size['medium'] ) && '' !== $settings->dual_font_size['medium'] ) { ?>
					font-size: <?php echo esc_attr( $settings->dual_font_size['medium'] ); ?>px;
				<?php } ?>

				<?php if ( isset( $settings->dual_font_size['medium'] ) && '' === $settings->dual_font_size['medium'] && isset( $settings->dual_line_height['medium'] ) && '' !== $settings->dual_line_height['medium'] && '' === $settings->dual_line_height_unit_medium && '' === $settings->dual_line_height_unit ) { ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height['medium'] ); ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit_medium ) && '' !== $settings->dual_line_height_unit_medium ) { ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height_unit_medium ); ?>em;
				<?php } elseif ( isset( $settings->dual_line_height_unit_medium ) && '' === $settings->dual_line_height_unit_medium && isset( $settings->dual_line_height['medium'] ) && '' !== $settings->dual_line_height['medium'] ) { ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height['medium'] ); ?>px;
				<?php } ?>
				}
			}
			<?php
		}
	} else {
		?>
	@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
		<?php if ( 'uabb-responsive-medsmall' === $settings->responsive_compatibility ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-medsmall .uabb-first-heading-text,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-medsmall .uabb-second-heading-text {
				display: inline-block;
			}
		<?php } ?>
	}
<?php } ?>
	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->dual_font_size['small'] ) || isset( $settings->dual_line_height['small'] ) || isset( $settings->dual_font_size_unit_responsive ) || isset( $settings->dual_line_height_unit_responsive ) || isset( $settings->dual_line_height_unit_medium ) || isset( $settings->dual_line_height_unit ) || 'uabb-responsive-mobile' === $settings->responsive_compatibility ) {
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-dual-color-heading * {

			<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit_responsive ) && '' !== $settings->dual_font_size_unit_responsive ) { ?>
					font-size: <?php echo esc_attr( $settings->dual_font_size_unit_responsive ); ?>px;
				<?php } elseif ( $settings->dual_font_size_unit_responsive && '' === $settings->dual_font_size_unit_responsive && isset( $settings->dual_font_size['small'] ) && '' !== $settings->dual_font_size['small'] ) { ?>
					font-size: <?php echo esc_attr( $settings->dual_font_size['small'] ); ?>px;
				<?php } ?>  

			<?php if ( isset( $settings->dual_font_size['small'] ) && '' === $settings->dual_font_size['small'] && isset( $settings->dual_line_height['small'] ) && '' !== $settings->dual_line_height['small'] && '' === $settings->dual_line_height_unit_responsive && '' === $settings->dual_line_height_unit_medium && '' === $settings->dual_line_height_unit ) : ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height['small'] ); ?>px;
				<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit_responsive ) && '' !== $settings->dual_line_height_unit_responsive ) { ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height_unit_responsive ); ?>em;
				<?php } elseif ( isset( $settings->dual_line_height_unit_responsive ) && '' === $settings->dual_line_height_unit_responsive && isset( $settings->dual_line_height['small'] ) && '' !== $settings->dual_line_height['small'] ) { ?>
					line-height: <?php echo esc_attr( $settings->dual_line_height['small'] ); ?>px;
				<?php } ?>

			}
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-mobile .uabb-first-heading-text,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-mobile .uabb-second-heading-text {
					display: inline-block;
				}
			}
			<?php
		}
	} else {
		?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
			<?php if ( 'uabb-responsive-mobile' === $settings->responsive_compatibility ) { ?>
				fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-mobile .uabb-first-heading-text,
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-responsive-mobile .uabb-second-heading-text {
					display: inline-block;
				}
			<?php } ?>
		}
		<?php } ?>
	<?php
}
?>

/* Typography responsive layout Ends here */
