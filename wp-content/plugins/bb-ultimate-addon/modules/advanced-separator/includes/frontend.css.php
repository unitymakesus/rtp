<?php
/**
 *  UABB Advanced Separator Module front-end CSS php file
 *
 *  @package UABB Advanced Separator Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->color      = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->text_color = UABB_Helper::uabb_colorpicker( $settings, 'text_color' );

$settings->img_size            = ( '' !== trim( $settings->img_size ) ) ? $settings->img_size : '50';
$settings->icon_photo_position = ( '' !== trim( $settings->icon_photo_position ) ) ? $settings->icon_photo_position : '50';
$settings->icon_spacing        = ( '' !== trim( $settings->icon_spacing ) ) ? $settings->icon_spacing : '10';
$settings->height              = ( '' !== trim( $settings->height ) ) ? $settings->height : '1';
$settings->width               = ( '' !== trim( $settings->width ) ) ? $settings->width : '100';
?>
.fl-node-<?php echo $id; ?> .uabb-separator-parent {
	line-height: 0;
	text-align: <?php echo ( 100 != $settings->width ) ? $settings->alignment : 'center'; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-image-outter-wrap {
	width: <?php echo ( 2 * ( (int) $settings->img_border_width ) ) + ( 2 * ( (int) $settings->img_bg_size ) ) + ( (int) $settings->img_size ); ?>px;
}

<?php if ( 'line' == $settings->separator ) { ?>
.fl-node-<?php echo $id; ?> .uabb-separator {
	border-top:<?php echo $settings->height; ?>px <?php echo $settings->style; ?> <?php echo uabb_theme_base_color( $settings->color ); ?>;
	width: <?php echo $settings->width; ?>%;
	display: inline-block;
}
<?php } ?>

<?php if ( 'line_icon' == $settings->separator || 'line_image' == $settings->separator || 'line_text' == $settings->separator ) { ?>

	<?php
	if ( 'line_image' == $settings->separator || 'line_icon' == $settings->separator ) {

		/* Render CSS */

		/* CSS "$settings" Array */

		$imageicon_array = array(

			/* General Section */
			'image_type'              => ( 'line_image' == $settings->separator ) ? 'photo' : ( ( 'line_icon' == $settings->separator ) ? 'icon' : '' ),
			/* Icon Basics */
			'icon'                    => $settings->icon,
			'icon_size'               => $settings->icon_size,
			'icon_align'              => 'center',

			/* Image Basics */
			'photo_source'            => $settings->photo_source,
			'photo'                   => $settings->photo,
			'photo_url'               => $settings->photo_url,
			'img_size'                => $settings->img_size,
			'responsive_img_size'     => $settings->responsive_img_size,
			'img_align'               => 'center',
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
		?>
	<?php } ?>


	<?php if ( 'line_icon' == $settings->separator && 'simple' == $settings->icon_style ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-icon i,
	.fl-node-<?php echo $id; ?> .uabb-imgicon-wrap .uabb-icon i:before {
		width: 1.3em;
		height: 1.3em;
		line-height: 1.3em;
	}
<?php } ?>



	<?php if ( 'line_text' == $settings->separator ) { ?>
	.fl-node-<?php echo $id; ?> <?php echo $settings->text_tag_selection; ?>.uabb-divider-text{
		<?php echo ( ! empty( $settings->text_color ) ) ? 'color: ' . $settings->text_color . ';' : ''; ?>
	}
	.fl-node-<?php echo $id; ?> <?php echo $settings->text_tag_selection; ?>.uabb-divider-text {
		white-space: nowrap;
		margin: 0;
	}
		<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> <?php echo $settings->text_tag_selection; ?>.uabb-divider-text{
			white-space: nowrap;
			margin: 0;

			<?php if ( 'Default' != $settings->text_font_family['family'] ) { ?>
				<?php UABB_Helper::uabb_font_css( $settings->text_font_family ); ?>
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->text_font_size_unit ) && '' != $settings->text_font_size_unit ) { ?>
				font-size: <?php echo $settings->text_font_size_unit; ?>px;
			<?php } elseif ( isset( $settings->text_font_size_unit ) && '' == $settings->text_font_size_unit && isset( $settings->text_font_size['desktop'] ) && '' != $settings->text_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->text_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->text_font_size['desktop'] ) && '' == $settings->text_font_size['desktop'] && isset( $settings->text_line_height['desktop'] ) && '' != $settings->text_line_height['desktop'] && '' == $settings->text_line_height_unit ) { ?>
				line-height: <?php echo $settings->text_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit ) && '' != $settings->text_line_height_unit ) { ?>
				line-height: <?php echo $settings->text_line_height_unit; ?>em;
			<?php } elseif ( isset( $settings->text_line_height_unit ) && '' == $settings->text_line_height_unit && isset( $settings->text_line_height['desktop'] ) && '' != $settings->text_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->text_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->text_transform ) : ?>
				text-transform: <?php echo $settings->text_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->text_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->text_letter_spacing; ?>px;
			<?php endif; ?>

		}
			<?php
} else {
	if ( isset( $settings->text_tag_selection ) ) {
		$tag = $settings->text_tag_selection;
	}
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'text_font_typo',
				'selector'     => ".fl-node-$id $tag.uabb-divider-text",
			)
		);
	}
}
?>
<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-separator-wrap {
	width: <?php echo $settings->width; ?>%;
	display: table;
}

	<?php if ( 'center' == $settings->alignment ) { ?>
.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-center {
	margin-left: auto;
	margin-right: auto;
}
	<?php } ?>

	<?php if ( 'left' == $settings->alignment ) { ?>
.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-left {
	margin-left: 0;
	margin-right: auto;
}
	<?php } ?>

	<?php if ( 'right' == $settings->alignment ) { ?>
.fl-node-<?php echo $id; ?> .uabb-separator-wrap.uabb-separator-right {
	margin-left: auto;
	margin-right: 0;
}
	<?php } ?>

.fl-node-<?php echo $id; ?> .uabb-separator-line {
	display: table-cell;
	vertical-align:middle;
}

.fl-node-<?php echo $id; ?> .uabb-separator-line > span {
	border-top:<?php echo $settings->height; ?>px <?php echo $settings->style; ?> <?php echo uabb_theme_base_color( $settings->color ); ?>;
	display: block;
	margin-top: 0 !important;
}

.fl-node-<?php echo $id; ?> .uabb-divider-content{
		<?php if ( $settings->icon_photo_position > 0 ) { ?>
			padding-left: <?php echo $settings->icon_spacing; ?>px;
		<?php } ?>
		<?php if ( $settings->icon_photo_position < 100 ) { ?>
		padding-right: <?php echo $settings->icon_spacing; ?>px;
		<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-side-left{
	width: <?php echo $settings->icon_photo_position; ?>%;
}
.fl-node-<?php echo $id; ?> .uabb-side-right{
	width: <?php echo ( 100 - $settings->icon_photo_position ); ?>%;
}

.fl-node-<?php echo $id; ?> .uabb-divider-content {
	display: table-cell;
}
.fl-node-<?php echo $id; ?> .uabb-divider-content .uabb-icon-wrap{
	display: block;
}
	<?php
}

if ( 'line_text' == $settings->separator || 'line_image' == $settings->separator ) {

	if ( $global_settings->responsive_enabled ) { // Global Setting If started.
		?>
		@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

			<?php if ( ! $version_bb_check ) { ?>
				<?php
				if ( isset( $settings->text_font_size['medium'] ) && '' != $settings->text_font_size['medium'] || isset( $settings->text_line_height['medium'] ) && '' != $settings->text_line_height['medium'] || isset( $settings->text_font_size_unit_medium ) || isset( $settings->text_line_height_unit_medium ) || isset( $settings->text_line_height_unit ) ) {
					?>
				.fl-node-<?php echo $id; ?> <?php echo $settings->text_tag_selection; ?>.uabb-divider-text {

					<?php if ( 'yes' === $converted || isset( $settings->text_font_size_unit_medium ) && '' != $settings->text_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->text_font_size_unit_medium; ?>px;
					<?php } elseif ( isset( $settings->text_font_size_unit_medium ) && '' == $settings->text_font_size_unit_medium && isset( $settings->text_font_size['medium'] ) && '' != $settings->text_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->text_font_size['medium']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->text_font_size['medium'] ) && '' == $settings->text_font_size['medium'] && isset( $settings->text_line_height['medium'] ) && '' != $settings->text_line_height['medium'] && '' == $settings->text_line_height_unit_medium && '' == $settings->text_line_height_unit ) { ?>
						line-height: <?php echo $settings->text_line_height['medium']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit_medium ) && '' != $settings->text_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->text_line_height_unit_medium; ?>em;
					<?php } elseif ( isset( $settings->text_line_height_unit_medium ) && '' == $settings->text_line_height_unit_medium && isset( $settings->text_line_height['medium'] ) && '' != $settings->text_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->text_line_height['medium']; ?>px;
					<?php } ?>
				}
					<?php
				}
				?>
			<?php } ?>


			/* For Medium Device */
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left {
				width: <?php echo ( $settings->icon_photo_position * 40 / 100 ); ?>%;
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: <?php echo 40 - ( $settings->icon_photo_position * 40 / 100 ); ?>%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-divider-content <?php echo $settings->text_tag_selection; ?> {
				white-space: normal;
			}
		}

		@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

		<?php if ( ! $version_bb_check ) { ?>

			<?php
			if ( isset( $settings->text_font_size['small'] ) && '' != $settings->text_font_size['small'] || isset( $settings->text_line_height['small'] ) && '' != $settings->text_line_height['small'] || isset( $settings->text_font_size_unit_responsive ) || isset( $settings->text_line_height_unit_responsive ) || isset( $settings->text_line_height_unit_medium ) || isset( $settings->text_line_height_unit ) ) {
				?>
			.fl-node-<?php echo $id; ?> <?php echo $settings->text_tag_selection; ?>.uabb-divider-text {

				<?php if ( 'yes' === $converted || isset( $settings->text_font_size_unit_responsive ) && '' != $settings->text_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->text_font_size_unit_responsive; ?>px;
				<?php } elseif ( $settings->text_font_size_unit_responsive && '' == $settings->text_font_size_unit_responsive && isset( $settings->text_font_size['small'] ) && '' != $settings->text_font_size['small'] ) { ?>
					font-size: <?php echo $settings->text_font_size['small']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->text_font_size['small'] ) && '' == $settings->text_font_size['small'] && isset( $settings->text_line_height['small'] ) && '' != $settings->text_line_height['small'] && '' == $settings->text_line_height_unit_responsive && '' == $settings->text_line_height_unit_medium && '' == $settings->text_line_height_unit ) { ?>
					line-height: <?php echo $settings->text_line_height['small']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->text_line_height_unit_responsive ) && '' != $settings->text_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->text_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->text_line_height_unit_responsive ) && '' == $settings->text_line_height_unit_responsive && isset( $settings->text_line_height['small'] ) && '' != $settings->text_line_height['small'] ) { ?>
					line-height: <?php echo $settings->text_line_height['small']; ?>px;
				<?php } ?>

			}
				<?php
			}
			?>
		<?php } ?>

			<?php if ( '' != $settings->responsive_img_size ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-image-outter-wrap {
				width: <?php echo ( 2 * ( (int) $settings->img_border_width ) ) + ( 2 * ( (int) $settings->img_bg_size ) ) + ( (int) $settings->responsive_img_size ); ?>px;
			}
			<?php } ?>

			/* For Small Device */
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-left,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-left {
				width: <?php echo ( $settings->icon_photo_position * 20 / 100 ); ?>%;
			}
			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-side-right,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-side-right {
				width: <?php echo 20 - ( $settings->icon_photo_position * 20 / 100 ); ?>%;
			}

			.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-divider-content <?php echo $settings->text_tag_selection; ?> {
				white-space: normal;
			}
		}
		<?php
	}
}
?>
