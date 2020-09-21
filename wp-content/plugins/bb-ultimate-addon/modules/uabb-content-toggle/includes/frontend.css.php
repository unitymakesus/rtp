<?php
/**
 *  UABB Content Toggle Module front-end CSS php file
 *
 *   @package UABB Content Toggle Module
 */

?>

<?php
	$version_bb_check = UABB_Compatibility::$version_bb_check;
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-slider {
	background-color:<?php echo esc_attr( ( false === strpos( $settings->color1, 'rgb' ) ) ? '#' . $settings->color1 : $settings->color1 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle input[type="checkbox"] + label:before {
	background-color:<?php echo esc_attr( ( false === strpos( $settings->color1, 'rgb' ) ) ? '#' . $settings->color1 : $settings->color1 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle input[type="checkbox"]:not(:checked) + label:after {
	border-color: <?php echo esc_attr( ( false === strpos( $settings->color1, 'rgb' ) ) ? '#' . $settings->color1 : $settings->color1 ); ?>;
	border-width: 0.3em;
	border-style: solid;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle .uabb-rbs-switch-2.checked + label:after {
	border-color: <?php echo esc_attr( ( false === strpos( $settings->color2, 'rgb' ) ) ? '#' . $settings->color2 : $settings->color2 ); ?>;
	border-width: 0.3em;
	border-style: solid;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-label-box-active .uabb-label-box-switch {
	background:<?php echo esc_attr( ( false === strpos( $settings->color1, 'rgb' ) ) ? '#' . $settings->color1 : $settings->color1 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-switch.checked + .uabb-rbs-slider {
	background-color:<?php echo esc_attr( ( false === strpos( $settings->color2, 'rgb' ) ) ? '#' . $settings->color2 : $settings->color2 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-switch:focus + .uabb-rbs-slider {
	-webkit-box-shadow: 0 0 1px <?php echo esc_attr( $settings->color2 ); ?>;
	box-shadow: 0 0 1px <?php echo '#' . esc_attr( $settings->color2 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle .uabb-rbs-switch-2.checked + label:before {
	background-color:<?php echo esc_attr( ( false === strpos( $settings->color2, 'rgb' ) ) ? '#' . $settings->color2 : $settings->color2 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle .uabb-rbs-switch-2.checked + label:after {
	-webkit-transform: translateX(2.5em);
	-ms-transform: translateX(2.5em);transform: translateX(2.5em);
	border: 0.3em solid <?php echo esc_attr( $settings->color2 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-label-box-inactive .uabb-label-box-switch {
	background:<?php echo esc_attr( ( false === strpos( $settings->color2, 'rgb' ) ) ? '#' . $settings->color2 : $settings->color2 ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-slider:before,
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-slider:after {
	background-color: <?php echo esc_attr( ( false === strpos( $settings->controller_color, 'rgb' ) ) ? '#' . $settings->controller_color : $settings->controller_color ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-toggle input[type="checkbox"] + label:after {
	background-color: <?php echo esc_attr( ( false === strpos( $settings->controller_color, 'rgb' ) ) ? '#' . $settings->controller_color : $settings->controller_color ); ?>;
}

<?php if ( '' !== $settings->controller_color && isset( $settings->controller_color ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> span.uabb-label-box-switch {
		color: <?php echo esc_attr( ( false === strpos( $settings->controller_color, 'rgb' ) ) ? '#' . $settings->controller_color : $settings->controller_color ); ?>;
	}
<?php endif; ?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-main-btn {
	font-size: <?php echo esc_attr( $settings->switch_size ); ?>px;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-1 {
	<?php if ( '' !== $settings->head1_color && isset( $settings->head1_color ) ) : ?>
		color: <?php echo esc_attr( ( false === strpos( $settings->head1_color, 'rgb' ) ) ? '#' . $settings->head1_color : $settings->head1_color ); ?>;
	<?php endif; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-2 {
	<?php if ( '' !== $settings->head2_color && isset( $settings->head2_color ) ) : ?>
		color: <?php echo esc_attr( ( false === strpos( $settings->head2_color, 'rgb' ) ) ? '#' . $settings->head2_color : $settings->head2_color ); ?>;
	<?php endif; ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-1 {
		<?php if ( 'default' !== $settings->head1_font_family['family'] && 'default' !== $settings->head1_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->head1_font_family ); ?>
		<?php endif; ?>
		<?php if ( '' !== $settings->head1_size && isset( $settings->head1_size ) ) : ?>
			font-size: <?php echo esc_attr( $settings->head1_size ); ?>px;
		<?php endif; ?>
		<?php if ( '' !== $settings->head1_transform && isset( $settings->head1_transform ) ) : ?>
			text-transform: <?php echo esc_attr( $settings->head1_transform ); ?>;
		<?php endif; ?>
		<?php if ( '' !== $settings->head1_line_height && isset( $settings->head1_line_height ) ) : ?>
			line-height: <?php echo esc_attr( $settings->head1_line_height ); ?>em;
		<?php endif; ?>
		<?php if ( '' !== $settings->head1_letter_spacing && isset( $settings->head1_letter_spacing ) ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->head1_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'head1_font_typo',
				'selector'     => ".fl-node-$id .uabb-rbs-head-1",
			)
		);
	}
}
?>

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-2 {
		<?php if ( 'default' !== $settings->head2_font_family['family'] && 'default' !== $settings->head2_font_family['weight'] ) : ?>
			<?php FLBuilderFonts::font_css( $settings->head2_font_family ); ?>
		<?php endif; ?>
		<?php if ( '' !== $settings->head2_size && isset( $settings->head2_size ) ) : ?>
			font-size: <?php echo esc_attr( $settings->head2_size ); ?>px;
		<?php endif; ?>
		<?php if ( '' !== $settings->head2_transform && isset( $settings->head2_transform ) ) : ?>
			text-transform: <?php echo esc_attr( $settings->head2_transform ); ?>;
		<?php endif; ?>
		<?php if ( '' !== $settings->head2_line_height && isset( $settings->head2_line_height ) ) : ?>
			line-height: <?php echo esc_attr( $settings->head2_line_height ); ?>em;
		<?php endif; ?>
		<?php if ( '' !== $settings->head2_letter_spacing && isset( $settings->head2_letter_spacing ) ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->head2_letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'head2_font_typo',
				'selector'     => ".fl-node-$id .uabb-rbs-head-2",
			)
		);
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
	justify-content: <?php echo esc_attr( $settings->alignment ); ?>;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-rbs-toggle {
	<?php if ( '' !== $settings->alignment && isset( $settings->alignment ) ) : ?>
		align-items: <?php echo esc_attr( $settings->alignment ); ?>;
	<?php endif; ?>
	<?php if ( '' !== $settings->alignment && isset( $settings->alignment ) ) : ?>
		justify-content: <?php echo esc_attr( $settings->alignment ); ?>;
	<?php endif; ?>
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
	<?php if ( 'on' === $settings->advanced ) { ?>

		<?php if ( '' !== $settings->background_color && isset( $settings->background_color ) ) { ?>
			background-color:<?php echo esc_attr( ( false === strpos( $settings->background_color, 'rgb' ) ) ? '#' . $settings->background_color : $settings->background_color ); ?>;
		<?php } ?>

		<?php if ( ! $version_bb_check ) { ?>
			<?php if ( '' !== $settings->border_type && isset( $settings->border_type ) ) { ?>
				border-style: <?php echo esc_attr( $settings->border_type ); ?>;
			<?php } ?>
			<?php if ( '' !== $settings->border_width_head && isset( $settings->border_width_head ) ) { ?>
				border-width: <?php echo esc_attr( $settings->border_width_head ); ?>px;
			<?php } ?>
			<?php if ( '' !== $settings->border_color_head && isset( $settings->border_color_head ) ) { ?>
				border-color: <?php echo '#' . esc_attr( $settings->border_color_head ); ?>;
			<?php } ?>
			<?php if ( '' !== $settings->border_radius && isset( $settings->border_radius ) ) { ?>
				border-radius: <?php echo esc_attr( $settings->border_radius ); ?>px;
			<?php } ?>
			<?php
		} else {
			if ( class_exists( 'FLBuilderCSS' ) ) {
				// Border - Settings.
				FLBuilderCSS::border_field_rule(
					array(
						'settings'     => $settings,
						'setting_name' => 'head_border',
						'selector'     => ".fl-node-$id .uabb-rbs-toggle",
					)
				);
			}
		}
		?>

		<?php if ( isset( $settings->padding_top ) && '' !== $settings->padding_top ) : ?>
			padding-top:   <?php echo ( '' !== $settings->padding_top ) ? esc_attr( $settings->padding_top ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_bottom ) && '' !== $settings->padding_bottom ) : ?>
			padding-bottom:<?php echo ( '' !== $settings->padding_bottom ) ? esc_attr( $settings->padding_bottom ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_left ) && '' !== $settings->padding_left ) : ?>
			padding-left:  <?php echo ( '' !== $settings->padding_left ) ? esc_attr( $settings->padding_left ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_right ) && '' !== $settings->padding_right ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_right ) ? esc_attr( $settings->padding_right ) : ''; ?>px;
		<?php endif; ?>
	<?php } ?>
}

<?php if ( 'content' === $settings->cont1_section ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-1,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-1 {
		<?php if ( '' !== $settings->section1_color && isset( $settings->section1_color ) ) : ?>
			color:<?php echo esc_attr( ( false === strpos( $settings->section1_color, 'rgb' ) ) ? '#' . $settings->section1_color : $settings->section1_color ); ?>;
		<?php endif; ?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-1,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-1 {
			<?php if ( 'default' !== $settings->section1_font_family['family'] && 'default' !== $settings->section1_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->section1_font_family ); ?>
			<?php endif; ?>
			<?php if ( '' !== $settings->section1_size && isset( $settings->section1_size ) ) : ?>
				font-size: <?php echo esc_attr( $settings->section1_size ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->section1_transform && isset( $settings->section1_transform ) ) : ?>
				text-transform: <?php echo esc_attr( $settings->section1_transform ); ?>;
			<?php endif; ?>
			<?php if ( '' !== $settings->section1_line_height && isset( $settings->section1_line_height ) ) : ?>
				line-height: <?php echo esc_attr( $settings->section1_line_height ); ?>em;
			<?php endif; ?>
			<?php if ( '' !== $settings->section1_letter_spacing && isset( $settings->section1_letter_spacing ) ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->section1_letter_spacing ); ?>px;
			<?php endif; ?>
		}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'desc1_font_typo',
					'selector'     => ".fl-node-$id .uabb-rbs-content-1, .fl-node-$id .uabb-rbs-section-1",
				)
			);
		}
	}
	?>
<?php } ?>

<?php if ( 'content_head2' === $settings->cont2_section ) { ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-2,
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-2 {
		<?php if ( '' !== $settings->section2_color && isset( $settings->section2_color ) ) : ?>
			color: <?php echo esc_attr( ( false === strpos( $settings->section2_color, 'rgb' ) ) ? '#' . $settings->section2_color : $settings->section2_color ); ?>;
		<?php endif; ?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-2,
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-2 {
			<?php if ( 'default' !== $settings->section2_font_family['family'] && 'default' !== $settings->section2_font_family['weight'] ) : ?>
				<?php FLBuilderFonts::font_css( $settings->section2_font_family ); ?>
			<?php endif; ?>
			<?php if ( '' !== $settings->section2_size && isset( $settings->section2_size ) ) : ?>
				font-size: <?php echo esc_attr( $settings->section2_size ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->section2_transform && isset( $settings->section2_transform ) ) : ?>
				text-transform: <?php echo esc_attr( $settings->section2_transform ); ?>;
			<?php endif; ?>
			<?php if ( '' !== $settings->section2_line_height && isset( $settings->section2_line_height ) ) : ?>
				line-height: <?php echo esc_attr( $settings->section2_line_height ); ?>em;
			<?php endif; ?>
			<?php if ( '' !== $settings->section2_letter_spacing && isset( $settings->section2_letter_spacing ) ) : ?>
				letter-spacing: <?php echo esc_attr( $settings->section2_letter_spacing ); ?>px;
			<?php endif; ?>
			}
		<?php
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'desc2_font_typo',
					'selector'     => ".fl-node-$id .uabb-rbs-content-2, .fl-node-$id .uabb-rbs-section-2",
				)
			);
		}
	}
}
?>

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle-sections {
	<?php if ( 'on' === $settings->advanced_sec ) { ?>

		<?php if ( '' !== $settings->background_color_sec && isset( $settings->background_color_sec ) ) : ?>
			background-color: <?php echo esc_attr( ( false === strpos( $settings->background_color_sec, 'rgb' ) ) ? '#' . $settings->background_color_sec : $settings->background_color_sec ); ?>;
		<?php endif; ?>

		<?php if ( ! $version_bb_check ) { ?>

			<?php if ( '' !== $settings->border_type_sec && isset( $settings->border_type_sec ) ) : ?>
				border-style:<?php echo esc_attr( $settings->border_type_sec ); ?>;
			<?php endif; ?>
			<?php if ( '' !== $settings->border_width_sec && isset( $settings->border_width_sec ) ) : ?>
				border-width:<?php echo esc_attr( $settings->border_width_sec ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->border_color_sec && isset( $settings->border_color_sec ) ) : ?>
				border-color: <?php echo esc_attr( ( false === strpos( $settings->border_color_sec, 'rgb' ) ) ? '#' . $settings->border_color_sec : $settings->border_color_sec ); ?>;
			<?php endif; ?>
			<?php if ( '' !== $settings->border_radius_sec && isset( $settings->border_radius_sec ) ) : ?>
				border-radius:<?php echo esc_attr( $settings->border_radius_sec ); ?>px;
			<?php endif; ?>
			<?php
		} else {
			if ( class_exists( 'FLBuilderCSS' ) ) {
				// Border - Settings.
				FLBuilderCSS::border_field_rule(
					array(
						'settings'     => $settings,
						'setting_name' => 'border',
						'selector'     => ".fl-node-$id .uabb-rbs-toggle-sections",
					)
				);
			}
		}
		?>

		<?php if ( isset( $settings->padding_sec_top ) && '' !== $settings->padding_sec_top ) : ?>
			padding-top: <?php echo ( '' !== $settings->padding_sec_top ) ? esc_attr( $settings->padding_sec_top ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_bottom ) && '' !== $settings->padding_sec_bottom ) : ?>
			padding-bottom:<?php echo ( '' !== $settings->padding_sec_bottom ) ? esc_attr( $settings->padding_sec_bottom ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_left ) && '' !== $settings->padding_sec_left ) : ?>
			padding-left:  <?php echo ( '' !== $settings->padding_sec_left ) ? esc_attr( $settings->padding_sec_left ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_right ) && '' !== $settings->padding_sec_right ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_sec_right ) ? esc_attr( $settings->padding_sec_right ) : ''; ?>px;
		<?php endif; ?>

		<?php if ( '' !== $settings->background_color_sec && isset( $settings->background_color_sec ) ) : ?>
			background-color: <?php echo esc_attr( ( false === strpos( $settings->background_color_sec, 'rgb' ) ) ? '#' . $settings->background_color_sec : $settings->background_color_sec ); ?>;
		<?php endif; ?>
	<?php } ?>
	overflow: hidden;
}

<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-1 {
		margin-right: <?php echo esc_attr( $settings->button_heading_size ); ?>px;
	}
<?php endif; ?>

<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-2 {
		margin-left: <?php echo esc_attr( $settings->button_heading_size ); ?>px;
	}
<?php endif; ?>

<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-1 {
		margin-bottom: <?php echo esc_attr( $settings->button_heading_size ); ?>px;
	}
<?php endif; ?>

<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-2 {
		margin-top: <?php echo esc_attr( $settings->button_heading_size ); ?>px;
	}
<?php endif; ?>

<?php if ( '' !== $settings->content_headings && isset( $settings->content_headings ) ) : ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
		margin-bottom: <?php echo esc_attr( $settings->content_headings ); ?>px;
	}
<?php endif; ?>

@media only screen and ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>px ) {

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-1 {
			<?php if ( '' !== $settings->head1_size_medium && isset( $settings->head1_size_medium ) ) : ?>
				font-size: <?php echo esc_attr( $settings->head1_size_medium ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->head1_line_height_medium && isset( $settings->head1_line_height_medium ) ) : ?>
				line-height: <?php echo esc_attr( $settings->head1_line_height_medium ); ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-2 {
			<?php if ( '' !== $settings->head2_size_medium && isset( $settings->head2_size_medium ) ) : ?>
				font-size: <?php echo esc_attr( $settings->head2_size_medium ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->head2_line_height_medium && isset( $settings->head2_line_height_medium ) ) : ?>
				line-height: <?php echo esc_attr( $settings->head2_line_height_medium ); ?>em;
			<?php endif; ?>
		}

		<?php if ( 'content' === $settings->cont1_section ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-1,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-1 {
				<?php if ( '' !== $settings->section1_size_medium && isset( $settings->section1_size_medium ) ) : ?>
					font-size: <?php echo esc_attr( $settings->section1_size_medium ); ?>px;
				<?php endif; ?>
				<?php if ( '' !== $settings->section1_line_height_medium && isset( $settings->section1_line_height_medium ) ) : ?>
					line-height: <?php echo esc_attr( $settings->section1_line_height_medium ); ?>em;
				<?php endif; ?>
			}
		<?php } ?>
		<?php if ( 'content' === $settings->cont2_section ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-2,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-2 {
				<?php if ( '' !== $settings->section2_size_medium && isset( $settings->section2_size_medium ) ) : ?>
					font-size: <?php echo esc_attr( $settings->section2_size_medium ); ?>px;
				<?php endif; ?>
				<?php if ( '' !== $settings->section2_line_height_medium && isset( $settings->section2_line_height_medium ) ) : ?>
					line-height: <?php echo esc_attr( $settings->section2_line_height_medium ); ?>em;
				<?php endif; ?>
			}
		<?php } ?>
	<?php } ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-main-btn {
		font-size: <?php echo esc_attr( $settings->switch_size_medium ); ?>px;
	}

	<?php if ( '' !== $settings->button_heading_size_medium && isset( $settings->button_heading_size_medium ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-1 {
			margin-right: <?php echo esc_attr( $settings->button_heading_size_medium ); ?>px;
		}
	<?php endif; ?>

	<?php if ( '' !== $settings->button_heading_size_medium && isset( $settings->button_heading_size_medium ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-2 {
			margin-left: <?php echo esc_attr( $settings->button_heading_size_medium ); ?>px;
		}
	<?php endif; ?>

	<?php if ( '' !== $settings->content_headings_medium && isset( $settings->content_headings_medium ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
			margin-bottom: <?php echo esc_attr( $settings->content_headings_medium ); ?>px;
		}
	<?php endif; ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
		<?php if ( isset( $settings->padding_top_medium ) && '' !== $settings->padding_top_medium ) : ?>
			padding-top: <?php echo ( '' !== $settings->padding_top_medium ) ? esc_attr( $settings->padding_top_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_bottom_medium ) && '' !== $settings->padding_bottom_medium ) : ?>
			padding-bottom: <?php echo ( '' !== $settings->padding_bottom_medium ) ? esc_attr( $settings->padding_bottom_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_left_medium ) && '' !== $settings->padding_left_medium ) : ?>
			padding-left: <?php echo ( '' !== $settings->padding_left_medium ) ? esc_attr( $settings->padding_left_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_right_medium ) && '' !== $settings->padding_right_medium ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_right_medium ) ? esc_attr( $settings->padding_right_medium ) : ''; ?>px;
		<?php endif; ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle-sections {
		<?php if ( isset( $settings->padding_sec_top_medium ) && '' !== $settings->padding_sec_top_medium ) : ?>
			padding-top: <?php echo ( '' !== $settings->padding_sec_top_medium ) ? esc_attr( $settings->padding_sec_top_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_bottom_medium ) && '' !== $settings->padding_sec_bottom_medium ) : ?>
			padding-bottom: <?php echo ( '' !== $settings->padding_sec_bottom_medium ) ? esc_attr( $settings->padding_sec_bottom_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_left_medium ) && '' !== $settings->padding_sec_left_medium ) : ?>
			padding-left: <?php echo ( '' !== $settings->padding_sec_left_medium ) ? esc_attr( $settings->padding_sec_left_medium ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_right_medium ) ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_sec_right_medium ) ? esc_attr( $settings->padding_sec_right_medium ) : ''; ?>px;
		<?php endif; ?>
	}

	<?php if ( '' !== $settings->button_heading_size_medium && isset( $settings->button_heading_size_medium ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-1 {
			margin-bottom: <?php echo esc_attr( $settings->button_heading_size_medium ); ?>px;
		}
	<?php endif; ?>

	<?php if ( '' !== $settings->button_heading_size_medium && isset( $settings->button_heading_size_medium ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-2 {
			margin-top: <?php echo esc_attr( $settings->button_heading_size_medium ); ?>px;
		}
	<?php endif; ?>
}

@media only screen and ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>px ) {
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-responsive-stack--yes .uabb-rbs-toggle {
	-webkit-box-orient: vertical;
	-webkit-box-direction: normal;
	-webkit-flex-direction: column;
	-moz-box-orient: vertical;
	-moz-box-direction: normal;
	-ms-flex-direction: column;
	flex-direction: column;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-responsive-stack--no .uabb-rbs-toggle {
	-webkit-box-orient: horizontal;
	-webkit-box-direction: normal;
	-webkit-flex-direction: row;
	-moz-box-orient: horizontal;
	-moz-box-direction: normal;
	-ms-flex-direction: row;
	flex-direction: row;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-main-btn {
		font-size: <?php echo esc_attr( $settings->switch_size_responsive ); ?>px;
	}

	<?php if ( '' !== $settings->content_headings_responsive && isset( $settings->content_headings_responsive ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
			margin-bottom: <?php echo esc_attr( $settings->content_headings_responsive ); ?>px;
		}
	<?php endif; ?>

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-1 {
			<?php if ( '' !== $settings->head1_size_responsive && isset( $settings->head1_size_responsive ) ) : ?>
			font-size: <?php echo esc_attr( $settings->head1_size_responsive ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->head1_line_height_responsive && isset( $settings->head1_line_height_responsive ) ) : ?>
			line-height: <?php echo esc_attr( $settings->head1_line_height_responsive ); ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-head-2 {
			<?php if ( '' !== $settings->head2_size_responsive && isset( $settings->head2_size_responsive ) ) : ?>
				font-size: <?php echo esc_attr( $settings->head2_size_responsive ); ?>px;
			<?php endif; ?>
			<?php if ( '' !== $settings->head2_line_height_responsive && isset( $settings->head2_line_height_responsive ) ) : ?>
				line-height: <?php echo esc_attr( $settings->head2_line_height_responsive ); ?>em;
			<?php endif; ?>
		}

		<?php if ( 'content' === $settings->cont1_section ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-1,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-1 {
				<?php if ( '' !== $settings->section1_size_responsive && isset( $settings->section1_size_responsive ) ) : ?>
					font-size: <?php echo esc_attr( $settings->section1_size_responsive ); ?>px;
				<?php endif; ?>
				<?php if ( '' !== $settings->section1_line_height_responsive && isset( $settings->section1_line_height_responsive ) ) : ?>
					line-height: <?php echo esc_attr( $settings->section1_line_height_responsive ); ?>em;
				<?php endif; ?>
			}
		<?php } ?>

		<?php if ( 'content' === $settings->cont2_section ) { ?>
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-content-2,
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-section-2 {
				<?php if ( '' !== $settings->section2_size_responsive && isset( $settings->section2_size_responsive ) ) : ?>
					font-size: <?php echo esc_attr( $settings->section2_size_responsive ); ?>px;
				<?php endif; ?>
				<?php if ( '' !== $settings->section2_line_height_responsive && isset( $settings->section2_line_height_responsive ) ) : ?>
					line-height: <?php echo esc_attr( $settings->section2_line_height_responsive ); ?>em;
				<?php endif; ?>
			}
			<?php
		}
	}
	?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle {
		<?php if ( isset( $settings->padding_top_responsive ) && '' !== $settings->padding_top_responsive ) : ?>
			padding-top: <?php echo ( '' !== $settings->padding_top_responsive ) ? esc_attr( $settings->padding_top_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_bottom_responsive ) && '' !== $settings->padding_bottom_responsive ) : ?>
			padding-bottom: <?php echo ( '' !== $settings->padding_bottom_responsive ) ? esc_attr( $settings->padding_bottom_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_left_responsive ) && '' !== $settings->padding_left_responsive ) : ?>
			padding-left: <?php echo ( '' !== $settings->padding_left_responsive ) ? esc_attr( $settings->padding_left_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_right_responsive ) && '' !== $settings->padding_right_responsive ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_right_responsive ) ? esc_attr( $settings->padding_right_responsive ) : ''; ?>px;
		<?php endif; ?>
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-rbs-toggle-sections {
		<?php if ( isset( $settings->padding_sec_top_responsive ) && '' !== $settings->padding_sec_top_responsive ) : ?>
			padding-top: <?php echo ( '' !== $settings->padding_sec_top_responsive ) ? esc_attr( $settings->padding_sec_top_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_bottom_responsive ) && '' !== $settings->padding_sec_bottom_responsive ) : ?>
			padding-bottom: <?php echo ( '' !== $settings->padding_sec_bottom_responsive ) ? esc_attr( $settings->padding_sec_bottom_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_left_responsive ) && '' !== $settings->padding_sec_left_responsive ) : ?>
			padding-left: <?php echo ( '' !== $settings->padding_sec_left_responsive ) ? esc_attr( $settings->padding_sec_left_responsive ) : ''; ?>px;
		<?php endif; ?>
		<?php if ( isset( $settings->padding_sec_right_responsive ) && '' !== $settings->padding_sec_right_responsive ) : ?>
			padding-right: <?php echo ( '' !== $settings->padding_sec_right_responsive ) ? esc_attr( $settings->padding_sec_right_responsive ) : ''; ?>px;
		<?php endif; ?>
	}

	<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-1 {
			margin-bottom: <?php echo esc_attr( $settings->button_heading_size_responsive ); ?>px;
			margin-right: 0;
		}
	<?php endif; ?>

	<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--yes .uabb-sec-2 {
			margin-top: <?php echo esc_attr( $settings->button_heading_size_responsive ); ?>px;
			margin-left: 0;
		}
	<?php endif; ?>

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-responsive-stack--yes .uabb-rbs-toggle {
		flex-direction: column;
	}

	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-responsive-stack--yes .uabb-rbs-toggle {
		align-items: <?php echo esc_attr( $settings->alignment ); ?>;
	}

	<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-1 {
			margin-right: <?php echo esc_attr( $settings->button_heading_size_responsive ); ?>px;
			margin-bottom: 0;
		}
	<?php endif; ?>

	<?php if ( '' !== $settings->button_heading_size && isset( $settings->button_heading_size ) ) : ?>
		.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ct-desktop-stack--no .uabb-sec-2 {
			margin-left: <?php echo esc_attr( $settings->button_heading_size_responsive ); ?>px;
			margin-top: 0;
		}
	<?php endif; ?>
}
