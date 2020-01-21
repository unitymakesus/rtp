<?php
/**
 *  UABB CTA Module front-end CSS php file
 *
 * @package UABB CTA Module
 */

?>
<?php

	$version_bb_check = UABB_Compatibility::check_bb_version();
	$converted        = UABB_Compatibility::check_old_page_migration();

	$settings->bg_color      = UABB_Helper::uabb_colorpicker( $settings, 'bg_color', true );
	$settings->title_color   = UABB_Helper::uabb_colorpicker( $settings, 'title_color' );
	$settings->subhead_color = UABB_Helper::uabb_colorpicker( $settings, 'subhead_color' );

	$settings->spacing = ( '' != $settings->spacing ) ? $settings->spacing : '0';
?>
<?php if ( ! empty( $settings->bg_color ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-module-content {
	background-color: <?php echo $settings->bg_color; ?>;
}
<?php endif; ?>
<?php if ( is_numeric( $settings->spacing ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-module-content {
	padding: <?php echo $settings->spacing; ?>px;
}
<?php endif; ?>
<?php

if ( $version_bb_check ) {


	$button_array = array(

		/* General Section */
		'text'                       => $settings->btn_text,

		/* Link Section */
		'link'                       => $settings->btn_link,
		'link_target'                => $settings->btn_link_target,
		'link_nofollow'              => $settings->btn_link_nofollow,

		/* Style Section */
		'style'                      => $settings->btn_style,
		'border_size'                => $settings->btn_border_size,
		'transparent_button_options' => $settings->btn_transparent_button_options,
		'threed_button_options'      => $settings->btn_threed_button_options,
		'flat_button_options'        => $settings->btn_flat_button_options,

		/* Colors */
		'bg_color'                   => $settings->btn_bg_color,
		'bg_hover_color'             => $settings->btn_bg_hover_color,
		'text_color'                 => $settings->btn_text_color,
		'text_hover_color'           => $settings->btn_text_hover_color,

		/* Icon */
		'icon'                       => $settings->btn_icon,
		'icon_position'              => $settings->btn_icon_position,

		/* Structure */
		'width'                      => $settings->btn_width,
		'custom_width'               => $settings->btn_custom_width,
		'custom_height'              => $settings->btn_custom_height,
		'padding_top_bottom'         => $settings->btn_padding_top_bottom,
		'padding_left_right'         => $settings->btn_padding_left_right,
		'border_radius'              => $settings->btn_border_radius,
		'align'                      => '',
		'mob_align'                  => '',

		/* Typography */
		'font_size'                  => ( isset( $settings->btn_font_size ) ) ? $settings->btn_font_size : '',
		'line_height'                => ( isset( $settings->btn_line_height ) ) ? $settings->btn_line_height : '',
		'button_typo'                => ( isset( $settings->btn_typo ) ) ? $settings->btn_typo : '',
		'button_typo_medium'         => ( isset( $settings->btn_typo_medium ) ) ? $settings->btn_typo_medium : '',
		'button_typo_responsive'     => ( isset( $settings->btn_typo_responsive ) ) ? $settings->btn_typo_responsive : '',
		'button_padding_dimension'   => ( isset( $settings->button_padding_dimension ) ) ? $settings->button_padding_dimension : '',
		'button_border'              => ( isset( $settings->button_border ) ) ? $settings->button_border : '',
		'border_hover_color'         => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',
	);

} else {

	$button_array = array(

		/* General Section */
		'text'                        => $settings->btn_text,

		/* Link Section */
		'link'                        => $settings->btn_link,
		'link_target'                 => $settings->btn_link_target,
		'link_nofollow'               => $settings->btn_link_nofollow,

		/* Style Section */
		'style'                       => $settings->btn_style,
		'border_size'                 => $settings->btn_border_size,
		'transparent_button_options'  => $settings->btn_transparent_button_options,
		'threed_button_options'       => $settings->btn_threed_button_options,
		'flat_button_options'         => $settings->btn_flat_button_options,

		/* Colors */
		'bg_color'                    => $settings->btn_bg_color,
		'bg_hover_color'              => $settings->btn_bg_hover_color,
		'text_color'                  => $settings->btn_text_color,
		'text_hover_color'            => $settings->btn_text_hover_color,

		/* Icon */
		'icon'                        => $settings->btn_icon,
		'icon_position'               => $settings->btn_icon_position,

		/* Structure */
		'width'                       => $settings->btn_width,
		'custom_width'                => $settings->btn_custom_width,
		'custom_height'               => $settings->btn_custom_height,
		'padding_top_bottom'          => $settings->btn_padding_top_bottom,
		'padding_left_right'          => $settings->btn_padding_left_right,
		'border_radius'               => $settings->btn_border_radius,
		'align'                       => '',
		'mob_align'                   => '',

		/* Typography */
		'font_size'                   => ( isset( $settings->btn_font_size ) ) ? $settings->btn_font_size : '',
		'line_height'                 => ( isset( $settings->btn_line_height ) ) ? $settings->btn_line_height : '',
		'font_size_unit'              => $settings->btn_font_size_unit,
		'line_height_unit'            => $settings->btn_line_height_unit,
		'font_size_unit_medium'       => $settings->btn_font_size_unit_medium,
		'line_height_unit_medium'     => $settings->btn_line_height_unit_medium,
		'font_size_unit_responsive'   => $settings->btn_font_size_unit_responsive,
		'line_height_unit_responsive' => $settings->btn_line_height_unit_responsive,
		'font_family'                 => $settings->btn_font_family,
		'transform'                   => $settings->btn_transform,
		'letter_spacing'              => $settings->btn_letter_spacing,
		'button_padding_dimension'    => ( isset( $settings->button_padding_dimension ) ) ? $settings->button_padding_dimension : '',
		'button_border_style'         => ( isset( $settings->button_border_style ) ) ? $settings->button_border_style : '',
		'button_border_width'         => ( isset( $settings->button_border_width ) ) ? $settings->button_border_width : '',
		'button_border_radius'        => ( isset( $settings->button_border_radius ) ) ? $settings->button_border_radius : '',
		'button_border_color'         => ( isset( $settings->button_border_color ) ) ? $settings->button_border_color : '',

		'border_hover_color'          => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',
	);
}

/* CSS Render Function */
FLBuilder::render_module_css( 'uabb-button', $id, $button_array );
?>

<?php if ( 'inline' == $settings->layout ) { ?>
	@media ( min-width: <?php echo ( $global_settings->responsive_breakpoint + 1 ); ?>px ) {
		<?php if ( 'auto' == $settings->btn_width || 'full' == $settings->btn_width ) : ?>
		.fl-node-<?php echo $id; ?> .uabb-cta-inline .uabb-cta-text {
			width: 70%;
		}
		.fl-node-<?php echo $id; ?> .uabb-cta-inline .uabb-cta-button {
			width: 30%;
		}
		<?php endif; ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap {
			text-align: right;
		}
	}
<?php } ?>

<?php if ( 'auto' == $settings->btn_width ) { ?>
	<?php if ( 'inline' == $settings->layout ) { ?>
	@media ( min-width: <?php echo ( $global_settings->responsive_breakpoint + 1 ); ?>px ) {
		.fl-node-<?php echo $id; ?> .uabb-creative-button-wrap {
			text-align: right;
		}
	}
	<?php } ?>
<?php } ?>
<?php if ( 'custom' == $settings->btn_width ) { ?>
	@media ( min-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> .fl-module-content .uabb-button {
			margin-right: 0;
			margin-left: auto;
		}
	}
<?php } ?>

<?php
if ( '' != $settings->title_color ) {
	?>
	.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-cta-title {
		color: <?php echo $settings->title_color; ?>;
	}
	<?php
}
?>

<?php
if ( '' != $settings->subhead_color ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-text-editor {
		color: <?php echo uabb_theme_text_color( $settings->subhead_color ); ?>;
	}
	<?php
}
?>

/* Typography Options for Title */

<?php if ( ! $version_bb_check ) { ?>

	<?php if ( 'Default' != $settings->title_font_family['family'] || isset( $settings->title_font_size['desktop'] ) || isset( $settings->title_line_height['desktop'] ) || isset( $settings->title_font_size_unit ) || isset( $settings->title_line_height_unit ) || isset( $settings->title_transform ) || isset( $settings->title_letter_spacing ) ) { ?>

				.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-cta-title {

					<?php if ( 'Default' != $settings->title_font_family['family'] ) : ?>
						<?php UABB_Helper::uabb_font_css( $settings->title_font_family ); ?>
					<?php endif; ?>

					<?php if ( 'yes' === $converted || isset( $settings->title_font_size_unit ) && '' != $settings->title_font_size_unit ) { ?>
						font-size: <?php echo $settings->title_font_size_unit; ?>px;
						<?php if ( '' == $settings->title_line_height_unit && '' != $settings->title_font_size_unit ) { ?>
							line-height: <?php echo $settings->title_font_size_unit + 2; ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->title_font_size_unit ) && '' == $settings->title_font_size_unit && isset( $settings->title_font_size['desktop'] ) && '' != $settings->title_font_size['desktop'] ) { ?>
						font-size: <?php echo $settings->title_font_size['desktop']; ?>px;
						line-height: <?php echo $settings->title_font_size['desktop'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->title_font_size['desktop'] ) && '' == $settings->title_font_size['desktop'] && isset( $settings->title_line_height['desktop'] ) && '' != $settings->title_line_height['desktop'] && '' == $settings->title_line_height_unit ) { ?>
						line-height: <?php echo $settings->title_line_height['desktop']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->title_line_height_unit ) && '' != $settings->title_line_height_unit ) { ?>
						line-height: <?php echo $settings->title_line_height_unit; ?>em;
					<?php } elseif ( isset( $settings->title_line_height_unit ) && '' == $settings->title_line_height_unit && isset( $settings->title_line_height['desktop'] ) && '' != $settings->title_line_height['desktop'] ) { ?>
						line-height: <?php echo $settings->title_line_height['desktop']; ?>px;
					<?php } ?>

					<?php if ( 'none' != $settings->title_transform ) : ?>
						text-transform: <?php echo $settings->title_transform; ?>;
					<?php endif; ?>

					<?php if ( '' != $settings->title_letter_spacing ) : ?>
						letter-spacing: <?php echo $settings->title_letter_spacing; ?>px;
					<?php endif; ?>
				}
	<?php } ?>
	<?php
} else {
	$title_font_typo = $settings->title_tag_selection;
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_typo',
				'selector'     => ".fl-node-$id $title_font_typo.uabb-cta-title",
			)
		);
	}
}
?>

/* Typography Options for Description */

<?php if ( ! $version_bb_check ) { ?>
	<?php
	if ( 'Default' != $settings->subhead_font_family['family'] || isset( $settings->subhead_font_size['desktop'] ) && '' != $settings->subhead_font_size['desktop'] || isset( $settings->subhead_line_height['desktop'] ) && '' != $settings->subhead_line_height['desktop'] || isset( $settings->subhead_font_size_unit ) || isset( $settings->subhead_line_height_unit ) || isset( $settings->subhead_transform ) || isset( $settings->subhead_letter_spacing ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-text-editor {
			<?php if ( 'Default' != $settings->subhead_font_family['family'] ) : ?>
				<?php UABB_Helper::uabb_font_css( $settings->subhead_font_family ); ?>
			<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->subhead_font_size_unit ) && '' != $settings->subhead_font_size_unit ) { ?>
				font-size: <?php echo $settings->subhead_font_size_unit; ?>px;
				<?php if ( '' == $settings->subhead_line_height_unit && '' != $settings->subhead_font_size_unit ) { ?>
					line-height: <?php echo $settings->subhead_font_size_unit + 2; ?>px;
				<?php } ?>
			<?php } elseif ( isset( $settings->subhead_font_size_unit ) && '' == $settings->subhead_font_size_unit && isset( $settings->subhead_font_size['desktop'] ) && '' != $settings->subhead_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->subhead_font_size['desktop']; ?>px;
				line-height: <?php echo $settings->subhead_font_size['desktop'] + 2; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->subhead_font_size['desktop'] ) && '' == $settings->subhead_font_size['desktop'] && isset( $settings->subhead_line_height['desktop'] ) && '' != $settings->subhead_line_height['desktop'] && '' == $settings->subhead_line_height_unit ) { ?>
				line-height: <?php echo $settings->subhead_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->subhead_line_height_unit ) && '' != $settings->subhead_line_height_unit ) { ?>
				line-height: <?php echo $settings->subhead_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->subhead_line_height_unit ) && '' == $settings->subhead_line_height_unit && isset( $settings->subhead_line_height['desktop'] ) && '' != $settings->subhead_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->subhead_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->subhead_transform ) : ?>
				text-transform: <?php echo $settings->subhead_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->subhead_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->subhead_letter_spacing; ?>px;
			<?php endif; ?>
		}
	<?php } ?>
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'subhead_typo',
				'selector'     => ".fl-node-$id .uabb-text-editor",
			)
		);
	}
}
?>


/* Typography responsive css */
<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		<?php if ( ! $version_bb_check ) { ?>
			<?php if ( isset( $settings->title_font_size_unit_medium ) || isset( $settings->title_line_height_unit_medium ) || isset( $settings->title_font_size['medium'] ) || isset( $settings->title_line_height['medium'] ) ) { ?>
				.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-cta-title {

					<?php if ( 'yes' === $converted || isset( $settings->title_font_size_unit_medium ) && '' != $settings->title_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->title_font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->title_line_height_unit_medium && '' != $settings->title_font_size_unit_medium ) { ?>
							line-height: <?php $settings->title_font_size_unit_medium + 2; ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->title_font_size_unit_medium ) && '' == $settings->title_font_size_unit_medium && isset( $settings->title_font_size['medium'] ) && '' != $settings->title_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->title_font_size['medium']; ?>px;
						line-height: <?php $settings->title_font_size['medium'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->title_font_size['medium'] ) && '' == $settings->title_font_size['medium'] && isset( $settings->title_line_height['medium'] ) && '' != $settings->title_line_height['medium'] && '' == $settings->title_line_height_unit_medium && '' == $settings->title_line_height_unit ) { ?>
						line-height: <?php echo $settings->title_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->title_line_height_unit_medium ) && '' != $settings->title_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->title_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->title_line_height_unit_medium ) && '' == $settings->title_line_height_unit_medium && isset( $settings->title_line_height['medium'] ) && '' != $settings->title_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->title_line_height['medium']; ?>px;
					<?php } ?>

				}
			<?php } ?>
		<?php } ?>

			.fl-node-<?php echo $id; ?> .uabb-button-wrap .uabb-button {
				<?php
				if ( 'custom' == $settings->btn_width ) {
					?>
				margin: 0 auto;
					<?php
				}
				?>
			}

			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->subhead_font_size_unit_medium ) || isset( $settings->subhead_line_height_unit_medium ) || isset( $settings->subhead_font_size['medium'] ) || isset( $settings->subhead_line_height['medium'] ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-text-editor {

						<?php if ( 'yes' === $converted || isset( $settings->subhead_font_size_unit_medium ) && '' != $settings->subhead_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->subhead_font_size_unit_medium; ?>px;
							<?php if ( '' == $settings->subhead_line_height_unit_medium && '' != $settings->subhead_font_size_unit_medium ) { ?>
								line-height: <?php $settings->subhead_font_size_unit_medium + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->subhead_font_size_unit_medium ) && '' == $settings->subhead_font_size_unit_medium && isset( $settings->subhead_font_size['medium'] ) && '' != $settings->subhead_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->subhead_font_size['medium']; ?>px;
							line-height: <?php $settings->subhead_font_size['medium'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->subhead_font_size['medium'] ) && '' == $settings->subhead_font_size['medium'] && isset( $settings->subhead_line_height['medium'] ) && '' != $settings->subhead_line_height['medium'] && '' == $settings->subhead_line_height_unit_medium && '' == $settings->subhead_line_height_unit ) { ?>
							line-height: <?php echo $settings->subhead_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->subhead_line_height_unit_medium ) && '' != $settings->subhead_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->subhead_line_height_unit_medium; ?>em;
						<?php } elseif ( isset( $settings->subhead_line_height_unit_medium ) && '' == $settings->subhead_line_height_unit_medium && isset( $settings->subhead_line_height['medium'] ) && '' != $settings->subhead_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->subhead_line_height['medium']; ?>px;
						<?php } ?>

					}
				<?php } ?>
			<?php } ?>
		}

		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			<?php if ( isset( $settings->title_font_size_unit_responsive ) || isset( $settings->title_line_height_unit_responsive ) || isset( $settings->title_font_size['small'] ) || isset( $settings->title_line_height['small'] ) ) { ?>
				<?php if ( ! $version_bb_check ) { ?>
					.fl-node-<?php echo $id; ?> <?php echo $settings->title_tag_selection; ?>.uabb-cta-title {

						<?php if ( 'yes' === $converted || isset( $settings->title_font_size_unit_responsive ) && '' != $settings->title_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->title_font_size_unit_responsive; ?>px;
							<?php if ( '' == $settings->title_line_height_unit_responsive && '' != $settings->title_font_size_unit_responsive ) { ?>
								line-height: <?php echo $settings->title_font_size_unit_responsive + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->title_font_size_unit_responsive ) && '' == $settings->title_font_size_unit_responsive && isset( $settings->title_font_size['small'] ) && '' != $settings->title_font_size['small'] ) { ?>
							font-size: <?php echo $settings->title_font_size['small']; ?>px;
							line-height: <?php echo $settings->title_font_size['small'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->title_font_size['small'] ) && '' == $settings->title_font_size['small'] && isset( $settings->title_line_height['small'] ) && '' != $settings->title_line_height['small'] && '' == $settings->title_line_height_unit_responsive && '' == $settings->title_line_height_unit_medium && '' == $settings->title_line_height_unit ) { ?>
							line-height: <?php echo $settings->title_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->title_line_height_unit_responsive ) && '' != $settings->title_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->title_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->title_line_height_unit_responsive ) && '' == $settings->title_line_height_unit_responsive && isset( $settings->title_line_height['small'] ) && '' != $settings->title_line_height['small'] ) { ?>
							line-height: <?php echo $settings->title_line_height['small']; ?>px;
						<?php } ?>
					}
				<?php } ?>
			<?php } ?>

			.fl-node-<?php echo $id; ?> .uabb-button-wrap .uabb-button {
				<?php
				if ( 'custom' == $settings->btn_width ) {
					?>
				margin: 0 auto;
					<?php
				}
				?>
			}

			<?php if ( ! $version_bb_check ) { ?>
				<?php if ( isset( $settings->subhead_font_size_unit_responsive ) || isset( $settings->subhead_line_height_unit_responsive ) || isset( $settings->subhead_font_size['small'] ) || isset( $settings->subhead_line_height['small'] ) ) { ?>
					.fl-node-<?php echo $id; ?> .uabb-text-editor {

						<?php if ( 'yes' === $converted || isset( $settings->subhead_font_size_unit_responsive ) && '' != $settings->subhead_font_size_unit_responsive ) { ?>
							font-size: <?php echo $settings->subhead_font_size_unit_responsive; ?>px;
							<?php if ( '' == $settings->subhead_line_height_unit_responsive && '' != $settings->subhead_font_size_unit_responsive ) { ?>
								line-height: <?php echo $settings->subhead_font_size_unit_responsive + 2; ?>px;
							<?php } ?>
						<?php } elseif ( isset( $settings->subhead_font_size_unit_responsive ) && '' == $settings->subhead_font_size_unit_responsive && isset( $settings->subhead_font_size['small'] ) && '' != $settings->subhead_font_size['small'] ) { ?>
							font-size: <?php echo $settings->subhead_font_size['small']; ?>px;
							line-height: <?php echo $settings->subhead_font_size['small'] + 2; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->subhead_font_size['small'] ) && '' == $settings->subhead_font_size['small'] && isset( $settings->subhead_line_height['small'] ) && '' != $settings->subhead_line_height['small'] && '' == $settings->subhead_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->subhead_line_height['small']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->subhead_line_height_unit_responsive ) && '' != $settings->subhead_line_height_unit_responsive ) { ?>
							line-height: <?php echo $settings->subhead_line_height_unit_responsive; ?>em;
						<?php } elseif ( isset( $settings->subhead_line_height_unit_responsive ) && '' == $settings->subhead_line_height_unit_responsive && isset( $settings->subhead_line_height['small'] ) && '' != $settings->subhead_line_height['small'] ) { ?>
							line-height: <?php echo $settings->subhead_line_height['small']; ?>px;
						<?php } ?>

					}
				<?php } ?>
			<?php } ?>
		}
	<?php
}
?>
