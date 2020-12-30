<?php
/**
 * Register the module's CSS file for Info Banner module
 *
 * @package UABB Info Banner Module
 */

$version_bb_check = UABB_Compatibility::$version_bb_check;
$converted        = UABB_Compatibility::$uabb_migration;

$settings->background_color = UABB_Helper::uabb_colorpicker( $settings, 'background_color', true );
$settings->overlay_color    = UABB_Helper::uabb_colorpicker( $settings, 'overlay_color', true );

$settings->color      = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->desc_color = UABB_Helper::uabb_colorpicker( $settings, 'desc_color' );
$settings->link_color = UABB_Helper::uabb_colorpicker( $settings, 'link_color' );

?>

/* Min height */
<?php
if ( 'custom' === $settings->min_height_switch && '' !== $settings->min_height ) {
	$vertical_align        = 'center';
	$prefix_vertical_align = 'center';
	if ( 'middle' !== $settings->vertical_align ) {
		$vertical_align        = ( 'top' === $settings->vertical_align ) ? 'flex-start' : 'flex-end';
		$prefix_vertical_align = ( 'top' === $settings->vertical_align ) ? 'start' : 'end';
	}
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box {

	min-height: <?php echo esc_attr( $settings->min_height ); ?>px;
	-ms-grid-row-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
	-webkit-box-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
	-ms-flex-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
	align-items: <?php echo esc_attr( $vertical_align ); ?>;
}

.internet-explorer .fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box {
	height: <?php echo esc_attr( $settings->min_height ); ?>px;
}

/*.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-info {
	position: absolute;
	<?php if ( 'top' === $settings->vertical_align ) { ?>
	top: 0;
	<?php } elseif ( 'middle' === $settings->vertical_align ) { ?>
	top: 50%;
	-webkit-transform: translateY(-50%);
	-moz-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-o-transform: translateY(-50%);
			transform: translateY(-50%)
	<?php } elseif ( 'bottom' === $settings->vertical_align ) { ?>
	bottom: 0;
	<?php } ?>
}*/
	<?php
}
if ( '' !== $settings->background_color ) {
	?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box {
	background: <?php echo esc_attr( $settings->background_color ); ?>;
}
	<?php
}
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box .uabb-ultb3-title {
	<?php if ( '' !== $settings->color ) { ?>
		color: <?php echo esc_attr( $settings->color ); ?>;
	<?php } ?>

	<?php if ( '' !== $settings->title_margin_top ) { ?>
		margin-top: <?php echo esc_attr( $settings->title_margin_top ); ?>px;
	<?php } ?>

	<?php if ( '' !== $settings->title_margin_bottom ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->title_margin_bottom ); ?>px;
	<?php } ?>
}
/* Title Typography and Color */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box .uabb-ultb3-title {
		<?php if ( 'Default' !== $settings->font_family['family'] ) { ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' !== $settings->font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->font_size_unit ) && '' === $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' !== $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->font_size['desktop'] ) && '' === $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] && '' === $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' !== $settings->line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->line_height_unit ) && '' === $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' !== $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'none' !== $settings->transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->letter_spacing ); ?>px;
		<?php endif; ?>
	}
	<?php
} else {

	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'title_font_typo',
				'selector'     => ".fl-node-$id .uabb-ultb3-box .uabb-ultb3-title",
			)
		);
	}
}
?>
/* Description Typography and Color */
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-text-editor {
	<?php if ( '' !== $settings->desc_color ) { ?>
		color: <?php echo esc_attr( $settings->desc_color ); ?>;
	<?php } ?>

	<?php if ( '' !== $settings->desc_margin_top ) { ?>
		margin-top: <?php echo esc_attr( $settings->desc_margin_top ); ?>px;
	<?php } ?>

	<?php if ( '' !== $settings->desc_margin_bottom ) { ?>
		margin-bottom: <?php echo esc_attr( $settings->desc_margin_bottom ); ?>px;
	<?php } ?>
}
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-text-editor {
	<?php if ( 'Default' !== $settings->desc_font_family['family'] ) { ?>
		<?php UABB_Helper::uabb_font_css( $settings->desc_font_family ); ?>
	<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit ) && '' !== $settings->desc_font_size_unit ) { ?>
		font-size: <?php echo esc_attr( $settings->desc_font_size_unit ); ?>px;
	<?php } elseif ( isset( $settings->desc_font_size_unit ) && '' === $settings->desc_font_size_unit && isset( $settings->desc_font_size['desktop'] ) && '' !== $settings->desc_font_size['desktop'] ) { ?>
		font-size: <?php echo esc_attr( $settings->desc_font_size['desktop'] ); ?>px;
		<?php } ?>

	<?php if ( isset( $settings->desc_font_size['desktop'] ) && '' === $settings->desc_font_size['desktop'] && isset( $settings->desc_line_height['desktop'] ) && '' !== $settings->desc_line_height['desktop'] && '' === $settings->desc_line_height_unit ) { ?>
		line-height: <?php echo esc_attr( $settings->desc_line_height['desktop'] ); ?>px;
		<?php } ?>

	<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit ) && '' !== $settings->desc_line_height_unit ) { ?>
		line-height: <?php echo esc_attr( $settings->desc_line_height_unit ); ?>em;
	<?php } elseif ( isset( $settings->desc_line_height_unit ) && '' === $settings->desc_line_height_unit && isset( $settings->desc_line_height['desktop'] ) && '' !== $settings->desc_line_height['desktop'] ) { ?>
		line-height: <?php echo esc_attr( $settings->desc_line_height['desktop'] ); ?>px;
		<?php } ?>
	<?php if ( 'none' !== $settings->desc_transform ) : ?>
		text-transform: <?php echo esc_attr( $settings->desc_transform ); ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->desc_letter_spacing ) : ?>
		letter-spacing: <?php echo esc_attr( $settings->desc_letter_spacing ); ?>px;
	<?php endif; ?>
}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'desc_font_typo',
				'selector'     => ".fl-node-$id .uabb-text-editor",
			)
		);
	}
}
?>

<?php
if ( 'button' === $settings->cta_type ) {
	/* Button Render Css */
	if ( ! $version_bb_check ) {
		FLBuilder::render_module_css(
			'uabb-button',
			$id,
			array(

				/* General Section */
				'text'                                     => $settings->btn_text,

				/* Link Section */
				'link'                                     => $settings->btn_link,
				'link_target'                              => $settings->btn_link_target,

				/* Style Section */
				'style'                                    => $settings->btn_style,
				'border_size'                              => $settings->btn_border_size,
				'transparent_button_options'               => $settings->btn_transparent_button_options,
				'threed_button_options'                    => $settings->btn_threed_button_options,
				'flat_button_options'                      => $settings->btn_flat_button_options,

				/* Colors */
				'bg_color'                                 => $settings->btn_bg_color,
				'bg_color_opc'                             => $settings->btn_bg_color_opc,
				'bg_hover_color'                           => $settings->btn_bg_hover_color,
				'bg_hover_color_opc'                       => $settings->btn_bg_hover_color_opc,
				'text_color'                               => $settings->btn_text_color,
				'text_hover_color'                         => $settings->btn_text_hover_color,
				'hover_attribute'                          => $settings->hover_attribute,

				/* Icon */
				'icon'                                     => $settings->btn_icon,
				'icon_position'                            => $settings->btn_icon_position,

				/* Structure */
				'width'                                    => $settings->btn_width,
				'custom_width'                             => $settings->btn_custom_width,
				'custom_height'                            => $settings->btn_custom_height,
				'padding_top_bottom'                       => $settings->btn_padding_top_bottom,
				'padding_left_right'                       => $settings->btn_padding_left_right,
				'border_radius'                            => $settings->btn_border_radius,
				'align'                                    => $settings->banner_alignemnt,
				'mob_align'                                => '',

				/* Typography */

				'font_family'                              => $settings->tbtn_font_family,
				'font_size'                                => ( isset( $settings->tbtn_font_size ) ) ? $settings->tbtn_font_size : '',
				'line_height'                              => ( isset( $settings->tbtn_line_height ) ) ? $settings->tbtn_line_height : '',
				'font_size_unit_responsive'                => $settings->tbtn_font_size_unit_responsive,
				'line_height_unit_responsive'              => $settings->tbtn_line_height_unit_responsive,
				'font_size_unit_medium'                    => $settings->tbtn_font_size_unit_medium,
				'line_height_unit_medium'                  => $settings->tbtn_line_height_unit_medium,
				'font_size_unit'                           => $settings->tbtn_font_size_unit,
				'line_height_unit'                         => $settings->tbtn_line_height_unit,
				'transform'                                => $settings->tbtn_content_transform,
				'letter_spacing'                           => $settings->tbtn_content_letter_spacing,
				'button_padding_dimension_top'             => ( isset( $settings->button_padding_dimension_top ) ) ? $settings->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $settings->button_padding_dimension_left ) ) ? $settings->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $settings->button_padding_dimension_bottom ) ) ? $settings->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $settings->button_padding_dimension_right ) ) ? $settings->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $settings->button_padding_dimension_top_medium ) ) ? $settings->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $settings->button_padding_dimension_left_medium ) ) ? $settings->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $settings->button_padding_dimension_bottom_medium ) ) ? $settings->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $settings->button_padding_dimension_right_medium ) ) ? $settings->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $settings->button_padding_dimension_top_responsive ) ) ? $settings->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $settings->button_padding_dimension_left_responsive ) ) ? $settings->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $settings->button_padding_dimension_bottom_responsive ) ) ? $settings->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $settings->button_padding_dimension_right_responsive ) ) ? $settings->button_padding_dimension_right_responsive : '',
				'button_border_style'                      => ( isset( $settings->button_border_style ) ) ? $settings->button_border_style : '',
				'button_border_width'                      => ( isset( $settings->button_border_width ) ) ? $settings->button_border_width : '',
				'button_border_radius'                     => ( isset( $settings->button_border_radius ) ) ? $settings->button_border_radius : '',
				'button_border_color'                      => ( isset( $settings->button_border_color ) ) ? $settings->button_border_color : '',
				'border_hover_color'                       => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',

			)
		);
	} else {
		FLBuilder::render_module_css(
			'uabb-button',
			$id,
			array(

				/* General Section */
				'text'                                     => $settings->btn_text,

				/* Link Section */
				'link'                                     => $settings->btn_link,
				'link_target'                              => $settings->btn_link_target,

				/* Style Section */
				'style'                                    => $settings->btn_style,
				'border_size'                              => $settings->btn_border_size,
				'transparent_button_options'               => $settings->btn_transparent_button_options,
				'threed_button_options'                    => $settings->btn_threed_button_options,
				'flat_button_options'                      => $settings->btn_flat_button_options,

				/* Colors */
				'bg_color'                                 => $settings->btn_bg_color,
				'bg_hover_color'                           => $settings->btn_bg_hover_color,
				'text_color'                               => $settings->btn_text_color,
				'text_hover_color'                         => $settings->btn_text_hover_color,
				'hover_attribute'                          => $settings->hover_attribute,

				/* Icon */
				'icon'                                     => $settings->btn_icon,
				'icon_position'                            => $settings->btn_icon_position,

				/* Structure */
				'width'                                    => $settings->btn_width,
				'custom_width'                             => $settings->btn_custom_width,
				'custom_height'                            => $settings->btn_custom_height,
				'padding_top_bottom'                       => $settings->btn_padding_top_bottom,
				'padding_left_right'                       => $settings->btn_padding_left_right,
				'border_radius'                            => $settings->btn_border_radius,
				'align'                                    => $settings->banner_alignemnt,
				'mob_align'                                => '',

				/* Typography */
				'font_size'                                => ( isset( $settings->tbtn_font_size ) ) ? $settings->tbtn_font_size : '',
				'line_height'                              => ( isset( $settings->tbtn_line_height ) ) ? $settings->tbtn_line_height : '',
				'button_typo'                              => ( isset( $settings->btn_font_typo ) ) ? $settings->btn_font_typo : '',
				'button_typo_medium'                       => ( isset( $settings->btn_font_typo_medium ) ) ? $settings->btn_font_typo_medium : '',
				'button_typo_responsive'                   => ( isset( $settings->btn_font_typo_responsive ) ) ? $settings->btn_font_typo_responsive : '',
				'button_padding_dimension_top'             => ( isset( $settings->button_padding_dimension_top ) ) ? $settings->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $settings->button_padding_dimension_left ) ) ? $settings->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $settings->button_padding_dimension_bottom ) ) ? $settings->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $settings->button_padding_dimension_right ) ) ? $settings->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $settings->button_padding_dimension_top_medium ) ) ? $settings->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $settings->button_padding_dimension_left_medium ) ) ? $settings->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $settings->button_padding_dimension_bottom_medium ) ) ? $settings->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $settings->button_padding_dimension_right_medium ) ) ? $settings->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $settings->button_padding_dimension_top_responsive ) ) ? $settings->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $settings->button_padding_dimension_left_responsive ) ) ? $settings->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $settings->button_padding_dimension_bottom_responsive ) ) ? $settings->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $settings->button_padding_dimension_right_responsive ) ) ? $settings->button_padding_dimension_right_responsive : '',
				'button_border'                            => ( isset( $settings->button_border ) ) ? $settings->button_border : '',
				'border_hover_color'                       => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',

			)
		);
	}
}
?>


.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box-overlay {
	<?php if ( '' !== $settings->overlay_color ) { ?>
		background-color: <?php echo esc_attr( $settings->overlay_color ); ?>;
	<?php } ?>
}

/* Typography Options for Link Text */
<?php if ( ! $version_bb_check ) { ?>
	.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-infobanner-cta-link {
		<?php if ( 'Default' !== $settings->link_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->link_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit ) && '' !== $settings->link_font_size_unit ) { ?>
			font-size: <?php echo esc_attr( $settings->link_font_size_unit ); ?>px;
		<?php } elseif ( isset( $settings->link_font_size_unit ) && '' === $settings->link_font_size_unit && isset( $settings->link_font_size['desktop'] ) && '' !== $settings->link_font_size['desktop'] ) { ?>
			font-size: <?php echo esc_attr( $settings->link_font_size['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( isset( $settings->link_font_size['desktop'] ) && '' === $settings->link_font_size['desktop'] && isset( $settings->link_line_height['desktop'] ) && '' !== $settings->link_line_height['desktop'] && '' === $settings->link_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height['desktop'] ); ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit ) && '' !== $settings->link_line_height_unit ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height_unit ); ?>em;
		<?php } elseif ( isset( $settings->link_line_height_unit ) && '' === $settings->link_line_height_unit && isset( $settings->link_line_height['desktop'] ) && '' !== $settings->link_line_height['desktop'] ) { ?>
			line-height: <?php echo esc_attr( $settings->link_line_height['desktop'] ); ?>px;
		<?php } ?>


		<?php if ( 'none' !== $settings->link_transform ) : ?>
			text-transform: <?php echo esc_attr( $settings->link_transform ); ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->link_letter_spacing ) : ?>
			letter-spacing: <?php echo esc_attr( $settings->link_letter_spacing ); ?>px;
		<?php endif; ?>

	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'link_font_typo',
				'selector'     => ".fl-node-$id .uabb-infobanner-cta-link",
			)
		);
	}
}
?>

/* Link Color */
<?php if ( ! empty( $settings->link_color ) ) : ?>
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a *,
.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> a:visited {
	color: 
	<?php echo esc_attr( uabb_theme_text_color( $settings->link_color ) ); ?>;
}
<?php endif; ?>


<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	if ( ! $version_bb_check ) {
		if ( isset( $settings->desc_font_size['medium'] ) || isset( $settings->desc_line_height['medium'] ) || isset( $settings->font_size['medium'] ) || isset( $settings->line_height['medium'] ) || isset( $settings->desc_font_size_unit_medium ) || isset( $settings->desc_line_height_unit_medium ) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) || isset( $settings->link_font_size_unit_medium ) || isset( $settings->link_line_height_unit_medium ) || isset( $settings->line_height_unit ) ) {
			?>

			@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box .uabb-ultb3-title {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' !== $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' === $settings->font_size_unit_medium && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['medium'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size['medium'] ) && '' === $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
					<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' !== $settings->line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' === $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' !== $settings->line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->line_height['medium'] ); ?>px;
				<?php } ?>

				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-text-editor {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_medium ) && '' !== $settings->desc_font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_medium ) && '' === $settings->desc_font_size_unit_medium && isset( $settings->desc_font_size['medium'] ) && '' !== $settings->desc_font_size['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size['medium'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->desc_font_size['medium'] ) && '' === $settings->desc_font_size['medium'] && isset( $settings->desc_line_height['medium'] ) && '' !== $settings->desc_line_height['medium'] && '' === $settings->desc_line_height_unit_medium && '' === $settings->desc_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['medium'] ); ?>px;
					<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_medium ) && '' !== $settings->desc_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->desc_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->desc_line_height_unit_medium ) && '' === $settings->desc_line_height_unit_medium && isset( $settings->desc_line_height['medium'] ) && '' !== $settings->desc_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->desc_line_height['medium'] ); ?>px;
				<?php } ?>
				}

				.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?> .uabb-infobanner-cta-link {

					<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit_medium ) && '' !== $settings->link_font_size_unit_medium ) { ?>
						font-size: <?php echo esc_attr( $settings->link_font_size_unit_medium ); ?>px;
					<?php } elseif ( isset( $settings->link_font_size_unit_medium ) && '' === $settings->link_font_size_unit_medium && isset( $settings->link_font_size['medium'] ) && '' !== $settings->link_font_size['medium'] ) { ?>
						font-size: <?php echo esc_attr( $settings->link_font_size['medium'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->link_font_size['medium'] ) && '' === $settings->link_font_size['medium'] && isset( $settings->link_line_height['medium'] ) && '' !== $settings->link_line_height['medium'] && '' === $settings->link_line_height_unit_medium && '' === $settings->link_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->link_line_height['medium'] ); ?>px;
					<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit_medium ) && '' !== $settings->link_line_height_unit_medium ) { ?>
				line-height: <?php echo esc_attr( $settings->link_line_height_unit_medium ); ?>em;
			<?php } elseif ( isset( $settings->link_line_height_unit_medium ) && '' === $settings->link_line_height_unit_medium && isset( $settings->link_line_height['medium'] ) && '' !== $settings->link_line_height['medium'] ) { ?>
				line-height: <?php echo esc_attr( $settings->link_line_height['medium'] ); ?>px;
				<?php } ?>
				}
			}
			<?php
		}
	}
	if ( ! $version_bb_check ) {
		if ( isset( $settings->desc_font_size['small'] ) || isset( $settings->desc_line_height['small'] ) || isset( $settings->font_size['small'] ) || isset( $settings->line_height['small'] ) || isset( $settings->desc_font_size_unit_responsive ) || isset( $settings->desc_line_height_unit_responsive ) || isset( $settings->font_size_unit_responsive ) || isset( $settings->line_height_unit_responsive ) || isset( $settings->link_font_size_unit_responsive ) || isset( $settings->link_line_height_unit_responsive ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height_unit ) || $settings->desc_line_height_unit_medium || $settings->desc_line_height_unit || 'custom' === $settings->responsive_min_height_switch ) {
			?>
			@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box .uabb-ultb3-title {

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' !== $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size_unit_responsive ); ?>px;
					<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' === $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' !== $settings->font_size['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->font_size['small'] ); ?>px;
					<?php } ?>

					<?php if ( isset( $settings->font_size['small'] ) && '' === $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] && '' === $settings->line_height_unit_responsive && '' === $settings->line_height_unit_medium && '' === $settings->line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' !== $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' === $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' !== $settings->line_height['small'] ) { ?>
						line-height: <?php echo esc_attr( $settings->line_height['small'] ); ?>px;
					<?php } ?>
				}

				.fl-node-<?php echo esc_attr( $id ); ?> .uabb-text-editor {

					<?php if ( 'yes' === $converted || isset( $settings->desc_font_size_unit_responsive ) && '' !== $settings->desc_font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size_unit_responsive ); ?>px;
					<?php } elseif ( isset( $settings->desc_font_size_unit_responsive ) && '' === $settings->desc_font_size_unit_responsive && isset( $settings->desc_font_size['small'] ) && '' !== $settings->desc_font_size['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->desc_font_size['small'] ); ?>px;
						<?php } ?>

					<?php if ( isset( $settings->desc_font_size['small'] ) && '' === $settings->desc_font_size['small'] && isset( $settings->desc_line_height['small'] ) && '' !== $settings->desc_line_height['small'] && '' === $settings->desc_line_height_unit_responsive && '' === $settings->desc_line_height_unit_medium && '' === $settings->desc_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['small'] ); ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->desc_line_height_unit_responsive ) && '' !== $settings->desc_line_height_unit_responsive ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height_unit_responsive ); ?>em;
					<?php } elseif ( isset( $settings->desc_line_height_unit_responsive ) && '' === $settings->desc_line_height_unit_responsive && isset( $settings->desc_line_height['small'] ) && '' !== $settings->desc_line_height['small'] ) { ?>
						line-height: <?php echo esc_attr( $settings->desc_line_height['small'] ); ?>px;
						<?php } ?>
				}

				.fl-builder-content .fl-node-<?php echo esc_attr( $id ); ?>	.uabb-infobanner-cta-link {

					<?php if ( 'yes' === $converted || isset( $settings->link_font_size_unit_responsive ) && '' !== $settings->link_font_size_unit_responsive ) { ?>
						font-size: <?php echo esc_attr( $settings->link_font_size_unit_responsive ); ?>px;
					<?php } elseif ( isset( $settings->link_font_size_unit_responsive ) && '' === $settings->link_font_size_unit_responsive && isset( $settings->link_font_size['small'] ) && '' !== $settings->link_font_size['small'] ) { ?>
						font-size: <?php echo esc_attr( $settings->link_font_size['small'] ); ?>px;
						<?php } ?>

					<?php if ( isset( $settings->link_font_size['small'] ) && '' === $settings->link_font_size['small'] && isset( $settings->link_line_height['small'] ) && '' !== $settings->link_line_height['small'] && '' === $settings->link_height_unit_responsive && '' === $settings->link_line_height_unit_medium && '' === $settings->link_line_height_unit ) { ?>
						line-height: <?php echo esc_attr( $settings->link_line_height['small'] ); ?>px;
					<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->link_line_height_unit_responsive ) && '' !== $settings->link_line_height_unit_responsive ) { ?>
				line-height: <?php echo esc_attr( $settings->link_line_height_unit_responsive ); ?>em;
			<?php } elseif ( isset( $settings->link_line_height_unit_responsive ) && '' === $settings->link_line_height_unit_responsive && isset( $settings->link_line_height['small'] ) && '' !== $settings->link_line_height['small'] ) { ?>
				line-height: <?php echo esc_attr( $settings->link_line_height['small'] ); ?>px;
				<?php } ?>

				}
			}
			<?php
		}
	}
	?>
	@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {

		<?php
		if ( 'custom' === $settings->responsive_min_height_switch ) {

			$vertical_align        = 'center';
			$prefix_vertical_align = 'center';
			if ( 'middle' !== $settings->responsive_vertical_align ) {
				$vertical_align        = ( 'top' === $settings->responsive_vertical_align ) ? 'flex-start' : 'flex-end';
				$prefix_vertical_align = ( 'top' === $settings->responsive_vertical_align ) ? 'start' : 'end';
			}
			?>

			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-box {
				min-height: <?php echo esc_attr( $settings->responsive_min_height ); ?>px;
				-ms-grid-row-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
				-webkit-box-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
				-ms-flex-align: <?php echo esc_attr( $prefix_vertical_align ); ?>;
				align-items: <?php echo esc_attr( $vertical_align ); ?>;
			}
		<?php } ?>
	}
	/* Responsive Nature */
	<?php
	if ( 'custom' === $settings->responsive_nature ) :
		if ( '' !== $settings->res_medium_width ) :
			?>
		@media ( max-width: <?php echo esc_attr( $global_settings->medium_breakpoint ) . 'px'; ?> ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-img {
				width: <?php echo esc_attr( $settings->res_medium_width ); ?>px !important;
			}
		}
			<?php
		endif;

		if ( '' !== $settings->res_small_width ) :
			?>
		@media ( max-width: <?php echo esc_attr( $global_settings->responsive_breakpoint ) . 'px'; ?> ) {
			.fl-node-<?php echo esc_attr( $id ); ?> .uabb-ultb3-img {
				width: <?php echo esc_attr( $settings->res_small_width ); ?>px !important;
			}
		}
		<?php endif;
	endif;
}
?>
